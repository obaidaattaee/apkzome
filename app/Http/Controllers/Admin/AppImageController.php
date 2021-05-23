<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class AppImageController
 * @package App\Http\Controllers\Admin
 */
class AppImageController extends Controller
{
    const IMAGE_WIDTH = null;
    const IMAGE_HIGHT = 355 ;

    /**
     * @param App $app
     * @return View
     */
    public function create(App $app): View
    {
        return view('admin.apps.images.create')
            ->with('app', $app);
    }

    /**
     * @param App $app
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(App $app, Request $request): RedirectResponse
    {
        $request->validate([
            'logoFile' => ['required', 'image'],
            'image_title' => ['required'],
            'image_title.*' => ['required'],
            'image_alt' => ['required'],
            'image_alt.*' => ['required'],
        ]);
        $imagePath = Image::PATH;
        try {
            $file = $request->file('logoFile');
            $fileName = Storage::disk('uploads')->put(basename($file), $file);
            $file = \Intervention\Image\Facades\Image::make($file)->resize(self::IMAGE_WIDTH, self::IMAGE_HIGHT)->encode('jpg');
            $logo = $request->input('on_server') ?
                Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file) :
                Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
            $request->merge(['image' => $fileName]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $request['on_server'] = $request['on_server'] ? true : false;
        $app->images()->create($request->merge(['created_by' => auth()->id()])->only([
            'image', 'image_title', 'image_alt', 'on_server', 'created_by'
        ]));
        return redirect()->route('apps.show', ['app' => $app->id])->with('message', __('common.image') . ' ' . __('common.create_successfully'));
    }

    /**
     * @param App $app
     * @param Image $image
     * @return RedirectResponse
     */
    public function destroy(App $app, Image $image): RedirectResponse
    {
        $image->delete();
        return redirect()->route('apps.show', ['app' => $app->id]);
    }


    /**
     * @param App $app
     * @param Image $image
     * @return View
     */
    public function edit(App $app, Image $image): View
    {
        return view('admin.apps.images.edit')->with('image', $image);
    }

    /**
     * @param App $app
     * @param Image $image
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(App $app, Image $image, Request $request): RedirectResponse
    {
        $request->validate([
            'image_title' => ['required'],
            'image_title.*' => ['required'],
            'image_alt' => ['required'],
            'image_alt.*' => ['required'],
        ]);
        $imagePath = Image::PATH;
        if ($request->has('logoFile')) {
            try {
                $file = $request->file('logoFile');
                $fileName = Storage::disk('uploads')->put(basename($file), $file);
                $file = \Intervention\Image\Facades\Image::make($file)->resize(self::IMAGE_WIDTH, self::IMAGE_HIGHT)->encode('jpg');
                $logo = $request->input('on_server') ?
                    Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file) :
                    Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
                $request->merge(['image' => $fileName, 'on_server' => $request->has('on_server')]);
            } catch (\Exception $exception) {
                return redirect()->back()->with('message', __('common.cannot_upload_file'));
            }
        } else {
            $request['on_server'] = $image->on_server;
        }
        $image->update($request->except('logoFile'));
        return redirect()->route('apps.show', ['app' => $app->id])->with('message', __('common.update_successfully'));
    }
}
