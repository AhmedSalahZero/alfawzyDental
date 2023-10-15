<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsHomeController extends Controller
{
    //

    use  Upload_Files;
    public function index(){
        $row=AboutUs::firstOrCreate();

        return view('Admin.aboutUs.home',compact('row'));
    }

    public function store(Request $request){

        $data = $request->validate([
            'image2' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'title_home'=>'nullable',
            'desc_home'=>'nullable',
            'our_goal_title_home'=>'nullable',
            'our_goal_desc_home'=>'nullable',
            'our_mission_title_home'=>'nullable',
            'our_mission_desc_home'=>'nullable',


        ]);


        if ($request->image2)
            $data["image2"] = $this->uploadFiles('aboutUs', $request->file('image2'), null);






        AboutUs::firstOrCreate()->update($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);


    }
}
