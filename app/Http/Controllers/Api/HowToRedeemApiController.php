<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HowToRedeemResource;
use App\Http\Traits\Api_Trait;
use App\Models\HowToGetPoint;
use App\Models\HowToRedeem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HowToRedeemApiController extends Controller
{
    //
    use Api_Trait;
    public function index(Request $request){

        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',
                'user_type_id' => 'required|exists:user_types,id',
                'governorate_id' => 'nullable|exists:governorates,id',
                'slug'=>'nullable',


            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }
        $data=HowToRedeem::query()->with(['governorate'])->where('client_id',$request->client_id)->whereHas('types',function ($query) use ($request){
            $query->where('user_type_id',$request->user_type_id);
        });

        if ($request->governorate_id){
            $data->where('governorate_id',$request->governorate_id);
        }

        if ($request->slug){
            $data->where('slug',$request->slug);
        }

        $rows=$data->get();






        return $this->returnData(HowToRedeemResource::collection($rows),['done'],200);

    }
}
