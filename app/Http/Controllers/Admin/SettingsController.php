<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingsRequest;
use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Settings::all();
        return view('admin.general_settings.settings')
            ->with('settings', $settings);
    }

    public function update(StoreSettingsRequest $request)
    {
        $message = __('common.create_successfully');
        $settings = Settings::all();
        $logoPath = $settings->where('key', 'logo')->first()->value ?? "" ;
        try {
            DB::beginTransaction();
            Settings::truncate();
            if ($request->has('logoFile')) {
                $fileFromRequest = $request->file('logoFile');
                $filename =  Storage::disk('uploads')->put('systemLogo/' . basename($fileFromRequest), $fileFromRequest);
                $fileResize = \Intervention\Image\Facades\Image::make($fileFromRequest)->resize(260, 50)->encode('jpg');
                $file = Storage::disk('uploads')->put('systemLogo/' . $filename, $fileResize);
                $logoPath = asset('uploads/systemLogo/' . $filename);
                $request->merge([
                    'logo' => $logoPath
                ]);
            }else {

                $request->merge([
                    'logo' => $logoPath,
                ]);
            }
            unset($request['logoFile']);
            foreach ($request->all() as $columnName => $columnValue) {
                Settings::create([
                    'key' => $columnName,
                    'value' => $columnValue,
                ]);
            }
            DB::commit();
            Cache::forget('settings');
        } catch (Exception $exception) {
            dd($exception->getMessage());
            DB::rollBack();
            $message = __('common.cannot_update');
        }
        return redirect()->back()->with('message', $message);
    }
}
