<?php


namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\AppVersion;
use App\Models\Category;
use App\Models\Section;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{

    public function index()
    {
        Cache::forget('sliders');
        Cache::forget('tags');
        Cache::forget('categories');
        // Cache::forget('sliders');

        $sliders = Cache::remember('sliders', 3600, function () {
            return Slider::where('is_active', true)->get();
        });
        return view('welcome')
            ->with('sliders', $sliders);
    }

    public function download(AppVersion $version)
    {
        $version->load(['app', 'app.translations']);
        $version->app->increment('download_counter');
        return view('site.download')->with('version', $version);
    }

    public function search(Request $request, $type = null, $id = null, $title = null)
    {
        $apps = App::query();
        if ($type == 'vendor') {
            $apps = $apps->where('owner_id', $id);
        }
        if ($type == 'tag') {
            $apps = $apps->has('tags')->whereHas('tags' , function ($query) use ($id){
                 $query->where('tag_id' , $id);
            });
        }
        if ($request->has('search')) {
            $apps = $apps->where('title', 'like', "%{$request->input('search')}%");
        }

        if ($request->has('sort')) {
            if (similar_text($request->input('sort'), __('search.download')) > 3) {
                $apps = $apps->orderBy('download_counter', 'desc');
            }
            if (similar_text($request->input('sort'), __('search.rating')) > 3) {
                $apps = $apps->orderBy('rate', 'desc');
            }
            if (similar_text($request->input('sort'), __('search.arical')) > 3) {
                $apps = $apps->orderBy('created_at', 'desc');
            }
        }else{
            $apps = $apps->orderBy('rate' , 'desc');
        }
//        dd($apps->get());

        $apps = $apps->simplePaginate(52)->appends([
            'ci' => $request->input('ci'),
            'vi' => $request->input('vi'),
            'ti' => $request->input('ti'),
            'sort' => $request->input('sort'),
            'title' => $request->input('title'),
            'tag' => $request->input('tag'),
            'vendor_name' => $request->input('vendor_name'),
        ]);
        return $request->wantsJson() ? $apps : view('site.search')->with('apps', $apps);
    }

    public function details(App $app)
    {
        return view('site.app_details')->with('app', $app);
    }

    public function categorySearch($searchType, Request $request)
    {
        $minAppsCount = 4;
        $urlArray = explode('/', $request->getRequestUri());
        $urlType = explode('-', $urlArray[array_key_last($urlArray)]);
        $searchType = $urlType[0] == "category" ? Category::findOrFail($searchType) : Section::findOrFail($searchType);
        $apps = $searchType->apps();
        if ($apps->count() % $minAppsCount != 0 && object_get($searchType, 'parentCategory.id')) {
            $apps = $apps->orWhere('category_id', object_get($searchType, 'parentCategory.id'));
        } else if ($apps->count() % $minAppsCount != 0 && object_get($searchType, 'chlidrens')) {
            $apps = $apps->orWhereIn('category_id', object_get($searchType, 'chlidrens')->pluck('id')->toArray());
        }

        if ($request->has('sort')) {
            if (similar_text($request->input('sort'), __('search.download')) > 3) {
                $apps = $apps->orderBy('download_counter', 'desc');
            }
            if (similar_text($request->input('sort'), __('search.rating')) > 3) {
                $apps = $apps->orderBy('rate', 'desc');
            }
            if (similar_text($request->input('sort'), __('search.arical')) > 3) {
                $apps = $apps->orderBy('created_at', 'desc');
            }
        } else {
            $apps = $apps->orderBy('published_at', 'desc');
        }
        $apps = $apps->with(['owner'])->simplePaginate(5)->appends([
            'ci' => $request->input('ci'),
            'vi' => $request->input('vi'),
            'ti' => $request->input('ti'),
            'sort' => $request->input('sort'),
            'title' => $request->input('title'),
            'tag' => $request->input('tag'),
            'vendor_name' => $request->input('vendor_name'),
        ]);
        return $request->wantsJson() ? $apps : view('site.category_apps')->with('apps', $apps)->with('searchType', $searchType);
    }
}
