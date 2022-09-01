<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    //
    public function SliderView()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    } //end method 

    public function SliderStore(Request $request)
    {
        $validateData = $request->validate([
            'slider_image' => 'required',


        ], [
            'slider_image.required' => 'Slider Image is required.',

        ]);

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(870, 370)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 

    public function SliderEdit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    } //end method 


    public function SliderUpdate(Request $request)
    {
        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {
            @unlink($old_img);
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(870, 370)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Slider updated Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('manage.slider')->with($notification);
        } else {
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Slider updated Successfully.',
                'alert-type' => 'info',

            );

            return redirect()->route('manage.slider')->with($notification);
        } //end else
    } //end method 

    public function SliderDelete($id)
    {
        $slider = Slider::findOrFail($id);
        $image = $slider->slider_image;
        unlink($image);

        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Slider Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method


    public function SliderInactive($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 0,
        ]);
        $notification = array(
            'message' => 'Slider inactivated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method

    public function SliderActive($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'Slider activated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 
}
