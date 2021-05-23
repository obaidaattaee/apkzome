<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOSVersionRequest;
use App\Models\OSType;
use App\Models\OSVersion;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class OSVersionController
 * @package App\Http\Controllers\Admin
 */
class OSVersionController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $versions = OSVersion::all();
        return view('admin.versions.index')->with('versions', $versions);
    }

    /**
     * show create OS Version page
     * @return View
     */
    public function create(): View
    {
        $types = OSType::where('is_active', 1)->get();
        return view('admin.versions.create')->with('types', $types);
    }

    /**
     * @param StoreOSVersionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOSVersionRequest $request): RedirectResponse
    {
        OSVersion::create($request->all());
        return redirect()->route('versions.index')->with('message', __('common.created_successfully'));
    }


    /**
     * @param OSVersion $version
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(OSVersion $version)
    {
        $version->delete();
        return redirect()->route('versions.index')->with('message', __('common.delete_successfully'));
    }

    /**
     * @param OSVersion $version
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(OSVersion $version)
    {
        $types = OSType::where('is_active', 1)->get();
        return view('admin.versions.edit')->with('version', $version)->with('types', $types);
    }

    /**
     * @param StoreOSVersionRequest $request
     * @param OSVersion $version
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreOSVersionRequest $request, OSVersion $version)
    {
        $version->update($request->all());
        return redirect()->route('versions.index')->with('message', __('common.update_successfully'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function versions()
    {
        $versions = OSVersion::query();
        if (request()->has('type')) {
            $type = request()->input('type');
            $versions = $versions->where('os_type_id', $type);
        }
        if (request()->has('version')) {
            $search = request()->input('version');
            $versions = $versions->where('version', 'like', "%{$search}%");
        }
        $versions = $versions->get(['id', 'version']);
        return $versions;
    }
}
