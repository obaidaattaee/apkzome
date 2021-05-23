<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OSTypeController;
use App\Http\Controllers\Admin\OSVersionController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SitemapController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorsController;
use App\Http\Controllers\Site\SiteController;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use SebastianBergmann\LinesOfCode\Counter;

Route::prefix(LaravelLocalization::setLocale())->group(function () {

    Route::get('/', [SiteController::class, 'index']);
    Route::get('search-{type}-{id}-{title}', [SiteController::class, 'search'])->name('search');
    Route::get('download/{version}/{title?}', [SiteController::class, 'download'])->name('download');
    Route::get('details/{app}/{title?}', [SiteController::class, 'details'])->name('apps.details');
    Route::get('category-{category}-{category_name}' , [SiteController::class , 'categorySearch'])->name('categorySearch');
    Route::get('section-{section}-{section_name}' , [SiteController::class , 'categorySearch'])->name('sectionSearch');
    Auth::routes();


    Route::get('users/json', [UserController::class, 'users'])->name('users.json');
    Route::get('apps/json', [AppController::class, 'apps'])->name('apps.json');
    Route::get('vendors/json', [VendorsController::class, 'vendors'])->name('vendors.json');
    Route::get('roles/json', [UserController::class, 'roles'])->name('roles');
    Route::get('category/json', [CategoryController::class, 'categories'])->name('category');
    Route::get('subCategories/json', [CategoryController::class, 'subCategories'])->name('subCategories');
    Route::get('tags/json', [TagController::class, 'tags'])->name('tags');
    Route::get('os_versions/json', [OSVersionController::class, 'versions'])->name('os_versions');
    Route::get('os-types/search', [OSTypeController::class, 'search'])->name('os_types.search');


    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('sections/', [SectionController::class, 'index'])->name('sections.index');
        Route::get('sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
        Route::put('sections/{section}/edit', [SectionController::class, 'update'])->name('sections.update');

        Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::get('generate-sitemap', [SitemapController::class, 'generateSitemap'])->name('sitemap.generate');
        Route::get('users/{user}/change-password' , [UserController::class , 'changePassword'])->name('users.change-password');
        Route::put('users/{user}/change-password' , [UserController::class , 'updatePassword'])->name('post.users.change-password');
        Route::put('users/{user}/change-password' , [UserController::class , 'updatePassword'])->name('post.users.change-password');


        Route::get('/', [AdminBaseController::class, 'index']);
        Route::resource('users', 'UserController')->middleware('role:super_admin');
        Route::resource('categories', 'CategoryController');
        Route::resource('tags', 'TagController');
        Route::resource('os-types', 'OSTypeController');
        Route::resource('sliders', 'SliderController');
        Route::resource('versions', 'OSVersionController');
        Route::resource('apps', 'AppController');
        Route::resource('vendors', 'VendorsController');
        Route::resource('apps/{app}/images', 'AppImageController');
        Route::resource('apps/{app}/app-versions', 'AppVersionController');
        Route::resource('footers', 'FooterController');
    });
});
