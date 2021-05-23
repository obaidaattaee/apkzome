<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOSTypeRequest;
use App\Http\Requests\UpdateOSTypeRequest;
use App\Models\OSType;
use Illuminate\Support\Facades\Storage;

class OSTypeController extends Controller
{
    public function index()
    {
        $osTypes = OSType::all();
        return view('admin.os_types.index')->with('osTypes', $osTypes);
    }

    public function create()
    {
        return view('admin.os_types.create');
    }

    public function store(StoreOSTypeRequest $request)
    {
        $path = OSType::PATH;
        try {
            $file = $request->file('logoFile');
            $fileName = Storage::disk('uploads')->put(basename($file), $file);
            $file = \Intervention\Image\Facades\Image::make($file)->resize(1000, 1000)->encode('jpg');
            $logo = $request->input('on_server') ? Storage::disk('uploads')->put($path . $fileName, $file) : Storage::disk('b2')->put('uploads/'.$path.'/' . $fileName, $file);
            $request->merge(['logo' => $fileName]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $request['on_server'] = $request['on_server'] ? true : false;
        OSType::create($request->only(['title', 'logo', 'on_server']));
        return redirect()->route('os-types.index')->with('message', __('common.created_successfully'));
    }

    public function destroy(OSType $type)
    {
        $type->delete();
        return redirect()->route('os_types.index')->with('message', __('common.delete_successfully'));
    }

    public function edit(OSType $osType)
    {
        return view('admin.os_types.edit')->with('type', $osType);
    }

    public function update(UpdateOSTypeRequest $request, OSType $osType)
    {
        $path = OSType::PATH;

        $request['on_server'] = $request['on_server'] ? true : false;
        if ($request->has('logoFile')) {
            try {
                $file = $request->file('logoFile');
                $fileName = Storage::disk('uploads')->put(basename($file), $file);
                $file = \Intervention\Image\Facades\Image::make($file)->resize(1000, 1000)->encode('jpg');
                $logo = $request->input('on_server') ? Storage::disk('uploads')->put($path . $fileName, $file) : Storage::disk('b2')->put('uploads/'.$path.'/' . $fileName, $file);
                $request->merge(['logo' => $fileName]);
            } catch (\Exception $exception) {
                return redirect()->back()->with('message', __('common.cannot_upload_file'));
            }
        } else {
            $request['on_server'] = $osType->on_server;
        }
        $request['is_active'] = $request['is_active'] ? true : false;
        $osType->update($request->except('logoFile'));
        return redirect()->route('os-types.index')->with('message', __('common.update_successfully'));
    }

    public function search()
    {
        $types = OSType::query();
        if (request()->has('type')) {
            $search = request()->input('type');
            $types = $types->where(function ($query) use ($search) {
                foreach (\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    $query->orWhere('title->' . $localeCode, "like", "%{$search}%");
                }
                return $query;
            });
        }
        $types = $types->get(['id', 'title']);
        return \response()->json(json_decode($types));
    }
}
