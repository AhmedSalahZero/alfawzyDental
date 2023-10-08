<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\OnlineConsultingSetting;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;

class ConsultingSettingController extends Controller
{
    //
    use Upload_Files ,ResponseTrait;
    public function index(){
        $row=OnlineConsultingSetting::firstOrCreate();
        return view('Admin.onlineConsulting.settings.index',compact('row'));
    }
    public function store(Request $request){
        $row=OnlineConsultingSetting::firstOrCreate();

        $data = $request->validate([
            'x_ray' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'front_teeth_image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'side_teeth_image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'upper_teeth_image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'lower_teeth_image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',
            'passport_or_id' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:5000',

        ],
            [
            ]
        );

        if ($request->x_ray)
            $data['x_ray'] =  $this->uploadFiles('consulting',$request->file('x_ray'),null );
        if ($request->front_teeth_image)
            $data['front_teeth_image'] =  $this->uploadFiles('consulting',$request->file('front_teeth_image'),null );
        if ($request->side_teeth_image)
            $data['side_teeth_image'] =  $this->uploadFiles('consulting',$request->file('side_teeth_image'),null );
        if ($request->upper_teeth_image)
            $data['upper_teeth_image'] =  $this->uploadFiles('consulting',$request->file('upper_teeth_image'),null );

        if ($request->lower_teeth_image)
            $data['lower_teeth_image'] =  $this->uploadFiles('consulting',$request->file('lower_teeth_image'),null );
        if ($request->passport_or_id)
            $data['passport_or_id'] =  $this->uploadFiles('consulting',$request->file('passport_or_id'),null );

        $row->update($data);

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);

    }
}
