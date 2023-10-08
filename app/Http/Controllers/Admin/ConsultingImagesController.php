<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineConsulting;
use Illuminate\Http\Request;

class ConsultingImagesController extends Controller
{
    //
    public function index($id){
        $row=OnlineConsulting::findOrFail($id);

        return view('Admin.onlineConsulting.Images.index',compact('row'));
    }
}
