<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{

public function generateSitemap(){

    $default_sitemap = App::make('sitemap');
    $counter = 0;
    $sitemapCounter = 0;

    $categories = Category::get();
    foreach ($categories as $categoryKey => $category) {
        if ($category->has('apps')) {

            foreach ($category->apps as $appKey => $app) {
                if ($counter == 50000) {
                    // generate new sitemap file
                    $default_sitemap->store('xml', 'sitemap-' . $category->translation('title') . '-' . $sitemapCounter);
                    // add the file to the sitemaps array
                    $default_sitemap->addSitemap(secure_url('sitemap-' . $category->translation('title') . '-' . $sitemapCounter . '.xml'));
                    // reset items array (clear memory)
                    $default_sitemap->model->resetItems();
                    // reset the counter
                    $counter = 0;
                    // count generated sitemap
                    $sitemapCounter++;
                }
                // add product to items array
                $images = $app->images;
                // $images = [];
                if ($app->has('images')) {
                    foreach ($app->images as $imageKey => $image) {
                        $images[$imageKey]['url'] = $image->image_file;
                    }
                }

                // dd($images);
                foreach (LaravelLocalization::getSupportedLocales() as $locale => $language) {
                    $default_sitemap->add(
                        route('apps.details', ['app' => $app->id, 'title' => $app->translation('title', $locale)]),
                        $app->updated_at,
                        9,
                        'daily',
                        [$images]
                    );
                }
                // count number of elements
                $counter++;
            }
        }
    }
    // dd($default_sitemap->model);
    // you need to check for unused items
    if (!empty($default_sitemap->model->getItems())) {
        // generate sitemap with last items
        $default_sitemap->store('xml', 'sitemap-' . $category->translation('title') . '-' . $sitemapCounter);
        // add sitemap to sitemaps array
        $default_sitemap->addSitemap(secure_url('sitemap-' . $category->translation('title') . '-' . $sitemapCounter . '.xml'));
        // reset items array
        $default_sitemap->model->resetItems();
    }

    $default_sitemap->store('sitemapindex', 'sitemap');

    return redirect(URL::to('sitemap.xml'));
}

}
