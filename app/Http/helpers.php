<?php

use App\Models\Category;
use App\Models\Footer;
use App\Models\Section;
use App\Models\Tag;
use App\Models\Vendor;
use Illuminate\Support\Facades\Cache;

if (!function_exists('section')) {
    function section($id)
    {
        $sections = sections();
        return $sections->find($id);
    }
}
if (!function_exists('vendors')) {
    function vendors()
    {
        $vendors = Cache::remember('vendors', 3600, function () {
            return Vendor::get()->take(10);
        });
        return $vendors;
    }
}
if (!function_exists('categories')) {
    function categories()
    {
        $categories = Cache::remember('categories', 3600, function () {
            return Category::where('is_active', true)->get();
        });
        return $categories;
    }
}

if (!function_exists('tags')) {
    function tags()
    {
        $tags = Cache::remember('tags', 3600, function () {
            return Tag::where('is_active', true)->get();
        });
        return $tags;
    }
}
if (!function_exists('footer')) {
    function footer()
    {
        $footer = Cache::remember('footer', 3600, function () {
            return Footer::get();
        });
        return Footer::has('children')->with('children')->get();
    }
}
if (!function_exists('sections')) {
    function sections()
    {
        $sections = Cache::remember('sections' , 3600 , function () {
            return Section::with(['apps' , 'apps.translations'])->get();
        });
        return $sections;
    }
}
