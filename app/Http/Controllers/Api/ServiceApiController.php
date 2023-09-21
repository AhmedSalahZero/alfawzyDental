<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Traits\Api_Trait;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceApiController extends Controller
{
    //
    use Api_Trait;
    //
    public function index(Request $request){
        $rows=Service::where('is_active',1)->get();
        return $this->returnData(ServiceResource::collection($rows),['done'],200);
    }
}
