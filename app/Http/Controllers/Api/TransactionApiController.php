<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointResource;
use App\Http\Resources\StoreResource;
use App\Http\Resources\TransactionResource;
use App\Http\Traits\Api_Trait;
use App\Models\Point;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionApiController extends Controller
{
    //
    use Api_Trait;
    //
    public function index(Request $request){


        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',
                'user_type_id' => 'required|exists:user_types,id',
                'app_id' => 'required',


            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }

        $user=User::where('client_id',$request->client_id)->where('type_id',$request->user_type_id)->where('app_id',$request->app_id)->first();

        if (!$user)
            return $this->returnErrorNotFound(['user not found'],401);

        $rows=Transaction::where('user_id',$user->id)->orderBy('id','DESC')->get();

        return $this->returnData(TransactionResource::collection($rows),['done'],200);
    }
}
