<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Traits\Api_Trait;
use App\Models\HowToRedeem;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){
        $rows=Offer::with(['offerLevelPoints.level','governorate','client','store','type'])->get();




        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',
                'user_type_id' => 'required|exists:user_types,id',
                'governorate_id' => 'nullable|exists:governorates,id',
                'store_id' => 'nullable|exists:stores,id',


            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }
        $data=Offer::query()->where('client_id',$request->client_id)->whereHas('types',function ($query) use ($request){
            $query->where('user_type_id',$request->user_type_id);
        })->where('fromDate','<=',date('Y-m-d'))->where('toDate','>=',date('Y-m-d'));

        if ($request->governorate_id){
            $data->where('governorate_id',$request->governorate_id);
        }
        if ($request->store_id){
            $data->where('store_id',$request->store_id);
        }

       if ($request->fromDate){
            $data->where('fromDate','<=',$request->fromDate);
        }

        if ($request->toDate){
            $data->where('toDate','>=',$request->toDate);
        }

        $rows=$data->get();





        return $this->returnData(OfferResource::collection($rows),['done'],200);
    }
}
