<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index')->with('tags', $tags);
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('message', __('common.created_successfully'));
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('message', __('common.delete_successfully'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit')->with('tag', $tag);
    }

    public function update(StoreTagRequest $request, Tag $tag)
    {
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('message', __('common.update_successfully'));
    }

    public function tags()
    {
        $tags = Tag::query();

        if (request()->has('tag')) {
            $tag = request()->input('tag');
            $tags = $tags->where(function ($query) use ($tag) {
                foreach (\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    $query->orWhere('title->' . $localeCode, "like", "%{$tag}%");
                }
                return $query;
            });
        }
        $tags = $tags->get(['id', 'title']);
        return $tags;
    }
}
