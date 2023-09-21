<?php

namespace App\Http\Controllers\Api\AppStore;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferCodeResource;
use App\Http\Resources\StoreAdminResource;
use App\Http\Traits\Api_Trait;
use App\Http\Traits\Upload_Files;
use App\Models\OfferCode;
use App\Models\StoreAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreOfferController extends Controller
{
    //
    use Api_Trait,Upload_Files;

    public function store_offer_code(Request $request){
        $validator = Validator::make($request->all(),
            [
                'store_id' => 'required|exists:stores,id',
                'user_id'=>'nullable|exists:users,id',
            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }


        $rows=OfferCode::query()->where('store_id',$request->store_id)->where('is_used',0)->with(['offer','user']);


        if ($request->user_id){
            $rows->where('user_id',$request->user_id);
        }

        $offerCodes=$rows->get();

        return $this->returnData(OfferCodeResource::collection($offerCodes),['done'],200);

    }



    public function store_offer_code_used(Request $request){

        $validator = Validator::make($request->all(),
            [
                'store_id' => 'required|exists:stores,id',
                'user_id'=>'nullable|exists:users,id',
            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }


        $rows=OfferCode::query()->where('store_id',$request->store_id)->where('is_used',1)->with(['offer','user']);


        if ($request->user_id){
            $rows->where('user_id',$request->user_id);
        }

        $offerCodes=$rows->get();

        return $this->returnData(OfferCodeResource::collection($offerCodes),['done'],200);


    }


    public function offer_code_details(Request $request){

        $validator = Validator::make($request->all(),
            [
                'offer_code_id' => 'required|exists:offer_codes,id',
            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }

         $row=OfferCode::with(['offer','user'])->where('is_used',0)->find($request->offer_code_id);

        if (!$row)
            return $this->returnErrorNotFound(['not found'],401);

        return $this->returnData(OfferCodeResource::make($row),['done'],200);

    }


    public function confirm_offer_code(Request $request){

        $validator = Validator::make($request->all(),
            [
                'offer_code_id' => 'required|exists:offer_codes,id',
                'promo_code'=>'required',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }

        $row=OfferCode::find($request->offer_code_id);
        if (!$row)
            return $this->returnErrorNotFound(['not found'],401);

        if ($row->is_used==1)
            return $this->returnError(['This Offer Code Is Used'],400);

        if ($row->promo_code!=$request->promo_code)
            return $this->returnError(['The Promo Code Is Wrong'],400);


          $row->update([
              'is_used'=>1,
          ]);


          return  $this->returnData(null,['done'],200);


    }




    public function app_store_update_profile(Request $request){

        $validator = Validator::make($request->all(),
            [
                'store_admin_id' => 'required|exists:store_admins,id',
                'user_name'=>'nullable|unique:store_admins,user_name,'.$request->store_admin_id,
                'password'=>'nullable',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }

        $admin=StoreAdmin::find($request->store_admin_id);
        if (!$admin)
            return $this->returnErrorNotFound(['not found'],401);

        $data=[];

        if ($request->user_name)
            $data['user_name']=$request->user_name;
        else
            $data['user_name']=$admin->user_name;

        if ($request->password) {
            $data['password'] = bcrypt($request->password);

        } else {

            $data['password'] = $admin->password;
        }

        if ($request->image)
            $data["image"] = $this->uploadFiles('storeAdmins', $request->file('image'), null);
        else
            $data["image"]=$admin->image;

        $admin->update($data);

        $admin=StoreAdmin::find($request->store_admin_id);

        return  $this->returnData(StoreAdminResource::make($admin),['done'],200);



    }






}
