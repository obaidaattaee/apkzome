<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\AppDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppRequest;
use App\Http\Requests\UpdateAppRequest;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use PragmaRX\Tracker\Vendor\Laravel\Facade;

/**
 * Class AppController
 * @package App\Http\Controllers\Admin
 */
class AppController extends Controller
{
    /**
     *  define default image width
     */
    const IMAGE_WIDTH = null;
    /**
     *  define default image height
     */
    const IMAGE_HIGHT = 355;


    /**
     * @param AppDataTable $dataTable
     * @return mixed
     */
    public function index(AppDataTable $dataTable)
    {
        return $dataTable->render('admin.apps.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.apps.create');
    }

    /**
     * @param StoreAppRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAppRequest $request)
    {
        $imagePath = App::APP_LOGO_PATH;
        try {
            if ($request->file('logoFile')) {
                $file = $request->file('logoFile');
                $fileName = Storage::disk('uploads')->put(basename($file), $file);
                $file = Image::make($file)->resize(200, 200)->encode('jpg');
                if ($request->input('on_server')) {
                    Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file);
                    $fileName = asset('uploads/' . $imagePath . '/' . $fileName);
                } else {
                    Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
                    $fileName = config()->get('backblaze.base_image_url') . 'uploads/' . $imagePath . '/' . $fileName;

                }
                $request->merge(['image' => $fileName]);
            } else {
                $request->merge(['image' => $request->input('imageUrl')]);
            }
            $request['on_server'] = $request['on_server'] ? true : false;

            $appImagePath = \App\Models\Image::PATH;
            $images = [];
            foreach ($request['images'] as $key => $image) {
                if (isset($image['imageFile']) || isset($image['imageUrl'])) {
                    $image['on_server'] = isset($image['on_server']) ? true : false;

                    if (isset($image['imageFile']) && !is_null($image['imageFile'])) {
                        $file = $image['imageFile'];
                        $fileName = Storage::disk('uploads')->put($appImagePath . basename($file), $file);
                        $file = \Intervention\Image\Facades\Image::make($file)->resize(self::IMAGE_WIDTH, self::IMAGE_HIGHT)->encode('jpg');
                        if ($image['on_server']) {
                            Storage::disk('uploads')->put($appImagePath . '/' . $fileName, $file);
                            $fileName = asset('uploads/' . $appImagePath . $fileName);
                        } else {
                            Storage::disk('b2')->put('uploads/' . $appImagePath . $fileName, $file);
                            $fileName = config()->get('backblaze.base_image_url') . 'uploads/' . $appImagePath . $fileName;
                        }
                        $imageUrl = $fileName;
                    } else {
                        $imageUrl = $image['imageUrl'];
                    }
                    array_push($images, [
                        'image' => $imageUrl,
                        'image_title' => $request->input('title'),
                        'image_alt' => $request->input('title'),
                        'on_server' => $image['on_server'],
                        'created_by' => auth()->id(),
                    ]);
                }
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $app = App::create($request->only([
            'extension', 'rate', 'published_at', 'title', 'description', 'owner_id', 'category_id', 'os_type_id', 'os_version_id', 'on_server', 'image'
        ]));
        foreach ($images as $image) {
            $app->images()->create($image);
        }
//        $app->translations()->create([
//            'locale' => 'en',
//            'title' => $request->input('title'),
//            'description' => $request->input('description'),
//        ]);
        $app->versions()->create($request->input('version'));
        $app->tags()->sync($request->input('tags'));
        return redirect()->route('apps.show', ['app' => $app->id])->with('message', __('common.create_successfully'));
    }

    /**
     * @param App $app
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(App $app)
    {
        $app->delete();
        return redirect()->route('apps.index')->with('message', __('common.delete_successfully'));
    }

    /**
     * @param App $app
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function show(App $app)
    {
        $app->load(['versions', 'images']);
        return view('admin.apps.show')->with('app', $app);
    }

    /**
     * @param App $app
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(App $app)
    {
        return view('admin.apps.edit')->with('app', $app);
    }


    /**
     * @param App $app
     * @param UpdateAppRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(App $app, UpdateAppRequest $request)
    {
        $imagePath = App::APP_LOGO_PATH;
        if ($request->has('logoFile')) {
            try {
                $file = $request->file('logoFile');
                $fileName = Storage::disk('uploads')->put(basename($file), $file);
                $file = Image::make($file)->resize(200, 200)->encode('jpg');
                if ($request->input('on_server')) {
                    Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file);
                    $fileName = asset('uploads/' . $imagePath . '/' . $fileName);
                } else {
                    Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
                    $fileName = asset('uploads/' . $imagePath . '/' . $fileName);
                }
                $request->merge(['image' => $fileName]);

                $request->merge(['on_server' => $request->has('on_server')]);
            } catch (\Exception $exception) {
                return redirect()->back()->with('message', __('common.cannot_upload_file'));
            }
        } else {
            $request['on_server'] = $app->on_server;
            $request['image'] = $app->image;
            $request->merge(['image' => $request->input('imageUrl')]);

        }
//        $app->update($request->only([
//            'extension', 'rate', 'title' , 'description',  'published_at', 'owner_id', 'category_id', 'os_type_id', 'os_version_id', 'on_server', 'image'
//        ]));
        $app->update($request->except(['tags', 'imageUrl', 'logoFile']));
//        $trans = $app->translations()->first();
//        $trans->update([
//            'title' => $request->input('title'),
//            'description' => $request->input('description')
//        ]);
        $app->tags()->sync($request->input('tags'));
        return redirect()->route('apps.show', ['app' => $app->id])->with('message', __('common.create_successfully'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function apps(Request $request)
    {
        $apps = App::query();
        if ($request->has('title')) {
            $title = $request->input('title');
//            $apps = $apps->whereHas('translations', function ($translation) use ($request) {
//                return $translation->where('title', 'like', "%{$request->input('title')}%");
//            });
            $apps = $apps->where('title', 'like', "%{$title}%");
        }
        $apps = $apps->limit(20)->get();
        return $apps;
    }
}
