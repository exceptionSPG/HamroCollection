<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SEOSetting;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    //SiteSetting

    public function SiteSetting()
    {
        $setting = SiteSetting::find(1);
        return view('backend.setting.setting_update', compact('setting'));
    } //end method 


    public function UpdateSiteSetting(Request $request)
    {
        $site_id = $request->id;
        $site = SiteSetting::findOrFail($site_id);
        // logo	phone_one	phone_two	email	company_name	company_address	facebook	twitter	linkedin	youtube
        if ($request->file('logo')) {
            if ($site->logo != null) {
                @unlink($site->logo);
            }
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(139, 36)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;
            SiteSetting::findOrFail($site_id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' =>  $request->email,
                'company_name' => $request->company_name,
                'logo' => $save_url,
                'company_address' =>  $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
            ]);

            $notification = array(
                'message' => 'Site setting updated Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('site.setting')->with($notification);
        } else {
            SiteSetting::findOrFail($site_id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' =>  $request->email,
                'company_name' => $request->company_name,

                'company_address' =>  $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
            ]);

            $notification = array(
                'message' => 'Site Settings updated Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('site.setting')->with($notification);
        } //end else
    } //end method

    public function SEOSetting()
    {
        $seo = SEOSetting::find(1);
        return view('backend.setting.seo_update', compact('seo'));
    } //end method  



    public function UpdateSEOSetting(Request $request)
    {

        $seo_id = $request->id;

        SEOSetting::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,

        ]);

        $notification = array(
            'message' => 'Seo Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end mehtod 
}
