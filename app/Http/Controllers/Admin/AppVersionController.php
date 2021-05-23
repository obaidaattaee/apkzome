<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppVersionRequest;
use App\Models\App;
use App\Models\AppVersion;
use Illuminate\Http\Request;

class AppVersionController extends Controller
{
    public function create(App $app)
    {
        return view('admin.apps.versions.create')->with('app' , $app);
    }

    public function store(App $app , StoreAppVersionRequest $request)
    {
        $app->versions()->create($request->all());
        return redirect()->route('apps.show' , ['app' => $app->id]);
    }

    public function edit(App $app , AppVersion $appVersion)
    {
        return view('admin.apps.versions.edit')
            ->with('app' , $app)
            ->with('appVersion' , $appVersion);
    }

    public function update(App $app, AppVersion $appVersion, StoreAppVersionRequest $request)
    {
        $appVersion->update($request->all());
        return redirect()->route('apps.show' , ['app' => $app->id])->with('message' , __('update_successfully'));
    }

    public function destroy(App $app, AppVersion $appVersion)
    {
        $message = __('delete_successfully');
        $app->versions()->count() == 1 ? $message = __('common.cannot_delete') : $appVersion->delete();
        return redirect()->route('apps.show' , ['app' => $app->id])->with('message' , ucwords($message));
    }
}
