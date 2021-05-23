@extends('layouts.site')
@section('title')
    {{ ucwords(__('common.search')) }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @php
                $gameAppCategories = Cache::remember('gameAppCategories', 3600, function (){
                        return App\Models\Category::find([App\Models\Category::CATEGORIES[0]['id'] , App\Models\Category::CATEGORIES[1]['id']]);
                    });
            @endphp
            <div class="col-md-4 col-sm-4">

                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="r-box p-0">
                            <div class="panel panel-primary p-0">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">Popular Categories</h2>
                                </div>
                                @foreach($gameAppCategories as $category)

                                    <div class="p-secondary-head">
                                        <p>
                                            <a href="{{ route('categorySearch' , ['category' => $category->id , 'category_name' => str_replace(' ' , '-' , $category->translation('title' , app()->getLocale()))]) }}">
                                                <i class="{{ $category->icon }} menu-icons"></i>
                                                {{ $category->translation('title' , app()->getLocale()) }}
                                            </a>
                                        </p>
                                    </div>
                                    <div class="panel-body c-columns">
                                        <div class="row">

                                            @foreach ($category->chlidrens()->where('is_active' , true)->get() as $child)
                                                <div class="col-md-6 col-sm-12 col-xs-6">
                                                    <p>
                                                        <a
                                                            href="{{ route('categorySearch', ['category' => $child->id, 'category_name' => str_replace(' ', '-', $child->translation('title', app()->getLocale()))]) }}">
                                                            <i class="{{ $child->icon }}"></i>
                                                            <span>
                                                {{ $child->translation('title', app()->getLocale()) }}
                                            </span>
                                                        </a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-8 col-sm-8" x-data="searchApps()">
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                <h2 class="panel-title p-title">{{ $searchType->translation('title' , app()->getLocale()) }}</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="btn-group">
                                            <a href="{{ url()->current() . "?sort=" . __('search.download')  }}"
                                               type="button" class="btn {{ request()->input('sort') == __('search.download') ? 'btn-info' : 'btn-default' }} ">{{ __('search.download') }}</a>
                                            <a href="{{ url()->current() . "?sort=" .  __('search.arival') }}"
                                               type="button"
                                               class="btn {{ request()->input('sort') == __('search.arival') ? 'btn-info' : 'btn-default' }} ">{{ __('search.arival') }}</a>
                                            <a href="{{ url()->current() . "?sort=" .  __('search.rating')  }}"
                                               type="button"
                                               class="btn {{ request()->input('sort') == __('search.rating') ? 'btn-info' : 'btn-default' }} ">{{ __('search.rating') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach ($apps as $app)
                                        <a href="{{ route('apps.details', ['app' => $app->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()))]) }}">
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="row">
                                                    <div class="p-panel text-center c-games">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <a href="">
                                                                <img src="{{ $app->image_file }}" class="img-responsive"
                                                                     alt="{{ $app->translation('title', app()->getLocale()) }}"/>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="download-details-container">
                                                                <a href="{{ route('apps.details', ['app' => $app->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()))]) }}"
                                                                   class="download-details">
                                                                    <div>
                                                                        <h4 class="p-head-details text-overflow">
                                                                            {{ $app->translation('title', app()->getLocale()) }}
                                                                        </h4>
                                                                        <div class="ratings">
                                                                            @component('admin.vendors.rate', ['rate' =>
                                                                                $app->rate])

                                                                            @endcomponent
                                                                        </div>
                                                                        <span
                                                                            class="btn btn-info p-btn">Download APK</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <template x-for="app in apps" :key="app.id">
                                        <div>
                                            <a x-bind:href="'{{ url('details/') . '/' }}'+ app.id + '/' +app.title_translation">
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="row">
                                                        <div class="p-panel text-center c-games">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <img x-bind:src="app.image_file"
                                                                     class="img-responsive"/>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="download-details-container">
                                                                    <a x-bind:href="'{{ url('details/') . '/' }}'+ app.id + '/' +app.title_translation"
                                                                       class="download-details">
                                                                        <div>
                                                                            <h4 class="p-head-details text-overflow"
                                                                                x-text="app.title_translation">
                                                                            </h4>
                                                                            <div class="ratings">
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="fa fa-star"></i>
                                                                                <i class="far fa-star"></i>

                                                                            </div>
                                                                            <a x-bind:href="'{{ url('details/') . '/' }}'+ app.id + '/' +app.title_translation"
                                                                               class="btn btn-info p-btn">Download
                                                                                APK</a>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </template>

                                </div>
                                <div class="row">
                                    <template x-if="showLoadMore">
                                        <button class="btn btn-info p-btn "
                                                style="display: flex;justify-content: center;margin: auto"
                                                x-on:click="getApps()">{{ ucwords(__('common.load_more')) }}</button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script>
        function searchApps() {
            return {
                apps: [],
                nextPage: {{ $apps->currentPage() }} + 1,
                showLoadMore: true,
                getApps: function () {
                    axios.get('{{ $apps->path() }}', {
                        params: {
                            page: this.nextPage
                        }
                    }).then((response) => {
                        this.nextPage = response.data.current_page + 1;
                        this.showLoadMore = response.data.next_page_url ? true : false;
                        this.apps = this.apps.concat(response.data.data);
                    });
                }
            }
        }

    </script>
@endsection
