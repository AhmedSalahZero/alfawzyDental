<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Http\Resources\TypeResource;
use App\Http\Traits\Api_Trait;
use App\Models\Store;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){


        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',
                'user_type_id' => 'nullable|exists:user_types,id',

            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }

        $data=Store::query()->where('client_id',$request->client_id);

           if ($request->user_type_id){
               $data->where('user_type_id',$request->user_type_id);
           }
           $rows=$data->get();
        return $this->returnData(StoreResource::collection($rows),['done'],200);
    }
}
