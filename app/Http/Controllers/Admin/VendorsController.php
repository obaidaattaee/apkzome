<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VendorDataTable;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Storage;

class VendorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VendorDataTable $dataTable)
    {
        return $dataTable->render('admin.vendors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'logoFile' => ['required', 'image'],
            'name' => ['required', 'string'],
            'rate' => ['required', 'max:5']
        ]);
        $request['on_server'] = $request['on_server'] ? true : false;
        $imagePath = Vendor::PATH;
        try {
            $file = $request->file('logoFile');
            $fileName = Storage::disk('uploads')->put($imagePath . basename($file), $file);
            $file = \Intervention\Image\Facades\Image::make($file)->resize(200, 200)->encode('jpg');
            $logo = $request->input('on_server') ?
                Storage::disk('uploads')->put($imagePath . $fileName, $file) :
                Storage::disk('b2')->put('uploads/' . $imagePath . $fileName, $file);
            $request->merge(['image' => $fileName, 'created_by' => auth()->id()]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $slider = Vendor::create($request->except('logoFile'));
        return redirect()->route('vendors.index')->with('message', __('common.create_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit')->with('vendor', $vendor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'rate' => ['required', 'max:5']
        ]);
        $request['on_server'] = $request['on_server'] ? true : false;
        $imagePath = Vendor::PATH;
        if ($request->has('logoFile')) {
            try {
                $file = $request->file('logoFile');
                $fileName = Storage::disk('uploads')->put($imagePath . basename($file), $file);
                $file = \Intervention\Image\Facades\Image::make($file)->resize(200, 200)->encode('jpg');
                $logo = $request->input('on_server') ?
                    Storage::disk('uploads')->put($imagePath . $fileName, $file) :
                    Storage::disk('b2')->put('uploads/' . $imagePath . $fileName, $file);
                $request->merge(['image' => $fileName, 'created_by' => auth()->id() , 'on_server' => $request->has('on_server')]);
            } catch (\Exception $exception) {
                return redirect()->back()->with('message', __('common.cannot_upload_file'));
            }
        }else{
            $request['on_server'] = $vendor->on_server;
        }
        $vendor->update($request->except('logoFile'));
        return redirect()->route('vendors.index')->with('message', __('common.update_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('message', __('common.delete_successfully'));
    }

    public function vendors(Request $request)
    {
        $vendors = Vendor::query();
        if ($request->has('venodr')){
            $vendor = $request->input('venodr');
            $vendors = $vendors->where('name' , 'like' , "%{$vendor}%");
        }
        $vendors = $vendors->limit(4)->get(['id' , 'name']);
        return response()->json($vendors);
    }
}
