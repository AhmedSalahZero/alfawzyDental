<?php

namespace App\Http\Controllers\Api\AppStore;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreAdminResource;
use App\Http\Resources\UserResource;
use App\Http\Traits\Api_Trait;
use App\Models\StoreAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    use Api_Trait;
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'user_name' => 'required|exists:store_admins,user_name',
                'password' => 'required',
            ], []);
        if ($validator->fails()) {
           return $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }


// Attempt to authenticate the user
             $check=$this->checkUserCredentials($request->user_name,$request->password);

        if (!$check)
            return $this->returnErrorNotFound(['Admin Not Found'],401);



        $admin = StoreAdmin::where('user_name', $request->user_name)->with(['client','store'])->first();


        return $this->returnData(StoreAdminResource::make($admin),['done'],200);


    }



    public function checkUserCredentials($username, $password)
    {
        // Find the user by username
        $user = StoreAdmin::where('user_name', $username)->first();

        // If no user found with the given username, return false
        if (!$user) {
            return false;
        }

        // Check if the provided password matches the hashed password in the database
        if (password_verify($password, $user->password)) {
            return true;
        }

        return false;
    }





}
