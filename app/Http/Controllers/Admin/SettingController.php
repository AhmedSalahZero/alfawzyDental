<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Traits\Upload_Files;
use App\Models\Setting;
use App\Models\SiteText;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Upload_Files;
    public function index()
    {

        $settings = Setting::firstOrNew();
        return view('Admin.settings.index', [
            'settings' => $settings,
        ]);
    }


    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        // <input type="hidden" name="form_type" value="family">
        if ($request->form_type == "logo") {
            $data = $this->updateLogo($setting, $request);
        } elseif ($request->form_type == "social") {
            $data =$this->updateSocial($request);
        }
        elseif ($request->form_type == "other") {
            $data =$this->updateOther($request);
        }
        elseif ($request->form_type == "counter") {
            $data =$this->updateCounter($request);
        }
        Setting::updateOrCreate(['id' => 1], $data);
        $settings = Setting::first();
        return response()->json(['settings' => $settings, 'logo' => get_file($settings->logo_header)], 200);
    }//end fun


    private function updateLogo($setting, $request)
    {
        $data['logo_header'] = $setting->logo_header;
        $data['logo_footer'] = $setting->logo_footer;
        $data['fave_icon'] = $setting->fave_icon;
        $data['main_home_image'] = $setting->main_home_image;
        $data['video_footer'] = $setting->video_footer;
        $data['contact_us_image'] = $setting->contact_us_image;

        //--------------------------------------------------
        if ($request->hasFile('logo_header'))
            $data["logo_header"] = $this->uploadFiles('settings', $request->file('logo_header'), null);

        if ($request->hasFile('logo_footer'))
            $data["logo_footer"] = $this->uploadFiles('settings', $request->file('logo_footer'), null);

        if ($request->hasFile('fave_icon'))
            $data["fave_icon"] = $this->uploadFiles('settings', $request->file('fave_icon'), null);

        if ($request->hasFile('main_home_image'))
            $data["main_home_image"] = $this->uploadFiles('settings', $request->file('main_home_image'), null);

        if ($request->hasFile('video_footer'))
            $data["video_footer"] = $this->uploadFiles('settings', $request->file('video_footer'), null);

        if ($request->hasFile('contact_us_image'))
            $data["contact_us_image"] = $this->uploadFiles('settings', $request->file('contact_us_image'), null);

        return $data;
    }


    private function updateSocial($request)
    {
        return [
            "instagram" => $request->instagram,
            "facebook" => $request->facebook,
            "snapchat" => $request->snapchat,
            "gmail" => $request->gmail,
            "email" => $request->email,
            "phone" => $request->phone,
            "whatsapp" => $request->whatsapp,

        ];
    }

    private function updateCounter($request)
    {
        return [
            "counter1" => $request->counter1,
            "counter2" => $request->counter2,
            "counter3" => $request->counter3,
            "counter4" => $request->counter4,
            "counter1_title" => $request->counter1_title,
            "counter2_title" => $request->counter2_title,
            "counter3_title" => $request->counter3_title,
            "counter4_title" => $request->counter4_title,


        ];
    }

    private function updateOther($request)
    {
        return [
            "footer_desc2" => $request->footer_desc2,
            "footer_desc1" => $request->footer_desc1,
            "footer_title2" => $request->footer_title2,
            "footer_title1" => $request->footer_title1,
            "main_home_title" => $request->main_home_title,
            "app_name" => $request->app_name,
            "partner_title" => $request->partner_title,
            "partner_desc" => $request->partner_desc,
            "contact_us_link" => $request->contact_us_link,
            "contact_us_desc" => $request->contact_us_desc,

        ];
    }




}
