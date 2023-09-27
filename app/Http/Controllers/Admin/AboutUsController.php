<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //

    use  Upload_Files;
    public function index(){
        $row=AboutUs::firstOrCreate();

        return view('Admin.aboutUs.index',compact('row'));
    }

    public function store(Request $request){

        $data = $request->validate([
            'image1' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'image2' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'team_image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'title'=>'nullable',
            'desc'=>'nullable',
            'team_title'=>'nullable',
            'team_desc'=>'nullable',
            'our_vision_title'=>'nullable',
            'our_vision_desc'=>'nullable',
            'our_goal_title'=>'nullable',
            'our_goal_desc'=>'nullable',
            'our_mission_title'=>'nullable',
            'our_mission_desc'=>'nullable',


        ]);


        if ($request->image1)
            $data["image1"] = $this->uploadFiles('aboutUs', $request->file('image1'), null);

        if ($request->image2)
            $data["image2"] = $this->uploadFiles('aboutUs', $request->file('image2'), null);

        if ($request->team_image)
            $data["team_image"] = $this->uploadFiles('aboutUs', $request->file('team_image'), null);


      AboutUs::firstOrCreate()->update($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);


    }
}
