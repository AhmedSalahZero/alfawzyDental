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
            'image11' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'image12' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'image13' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
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


        if ($request->image11)
            $data["image11"] = $this->uploadFiles('aboutUs', $request->file('image11'), null);

        if ($request->image12)
            $data["image12"] = $this->uploadFiles('aboutUs', $request->file('image12'), null);

        if ($request->image13)
            $data["image13"] = $this->uploadFiles('aboutUs', $request->file('image13'), null);




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
