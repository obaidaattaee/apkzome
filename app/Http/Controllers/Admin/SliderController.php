<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class SliderController
 * @package App\Http\Controllers\Admin
 */
class SliderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index')->with('sliders', $sliders);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'logoFile' => ['required', 'image'],
            'image_title' => ['required'],
            'image_title.*' => ['required'],
            'image_alt' => ['required'],
            'image_alt.*' => ['required'],
        ]);
        $imagePath = Slider::PATH;
        try {
            $file = $request->file('logoFile');
            $fileName = Storage::disk('uploads')->put(basename($file), $file);
            $file = \Intervention\Image\Facades\Image::make($file)->resize(1000, 700)->encode('jpg');
            $logo = $request->input('on_server') ?
                Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file) :
                Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
            $request->merge(['image' => $fileName]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $request['on_server'] = $request['on_server'] ? true : false;
        $slider = Slider::create($request->only(['image_title', 'image', 'on_server', 'image_alt']));
        return redirect()->route('sliders.index')->with('message', __('common.create_successfully'));
    }

    /**
     * @param Slider $slider
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Slider $slider, Request $request)
    {
        $request->validate([
            'image_title' => ['required'],
            'image_title.*' => ['required'],
            'image_alt' => ['required'],
            'image_alt.*' => ['required'],
        ]);
        $request['is_active'] = $request->has('is_active');
        $imagePath = Slider::PATH;
        if ($request->has('logoFile')) {
            // try {
                $file = $request->file('logoFile');
                $fileName = Storage::disk('uploads')->put(basename($file), $file);
                $file = \Intervention\Image\Facades\Image::make($file)->resize(1000, 700)->encode('jpg');
                $logo = $request->input('on_server') ?
                    Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file) :
                    Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
                $request->merge(['image' => $fileName , 'on_server' => $request->has('on_server') ]);
            // } catch (\Exception $exception) {
            //     return redirect()->back()->with('message', __('common.cannot_upload_file'));
            // }
        } else {
            $request['on_server'] = $slider->on_server;
        }
        $slider->update($request->except('logoFile'));
        return redirect()->route('sliders.index')->with('message', __('common.update_successfully'));
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('message', __('common.delete_successfully'));
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit')->with('slider', $slider);
    }
}
