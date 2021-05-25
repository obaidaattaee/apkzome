<style>
    .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropbtn:hover,
    .dropbtn:focus {
        background-color: #3e8e41;
    }

    #myInput {
        box-sizing: border-box;
        background-image: url('searchicon.png');
        background-position: 14px 12px;
        background-repeat: no-repeat;
        font-size: 16px;
        padding: 14px 20px 12px 45px;
        border: none;
        border-bottom: 1px solid #ddd;
    }

    #myInput:focus {
        outline: 3px solid #ddd;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        background-color: #f6f6f6;
        min-width: 230px;
        border: 1px solid #ddd;
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }

</style>
<div class="col-md-4 col-sm-4" x-data="data()">
    <div class="row mt-40">
        <div class="col-md-12 col-sm-12">
            <div class="r-box">
                <div class="form-group search-field-container">
                    <div id="myDropdown" class="dropdown-content">
                        <form action="{{ route('search' , ['id' => 'search' , 'type' => 'search' , 'title' => 'search']) }}" id="searchForm" method="get">
                            <input type="text" autocomplete="off" x-on:click.away="showSearchItems = false" class="form-control search-field" x-on:input.debounce="search($event)"
                                   placeholder="Search" name="search">
                        </form>
                            <div x-show="showSearchItems">
                        <template x-for='item in searchItems' :key="item.id">
                            <a x-bind:href="'{{url('details' , '' , '')}}' + '/' + item.id + '/' + item.title_translation">
                                <span>
                                    <img x-bind:src="item.image_file" class="img-flag" style="width: 50px" />
                                    <span x-text="item.title_translation"></span>
                                </span>
                            </a>
                        </template>
                    </div>
                    </div>
                    <i class="fa fa-search s-icon"></i>
                </div>
                <div>
                    @foreach (tags() as $tag)
                        <a href="{{ route('search', ['id' => $tag->id ,'type' => 'tag' , 'title' => str_replace(' ', '-', $tag->translation('title', app()->getLocale()))]) }}"
                            class="btn btn-default btn-links">{{ $tag->translation('title', app()->getLocale()) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-40">
        <div class="col-md-12 col-sm-12">
            <div class="r-box p-0">
                <div class="panel panel-default p-0">
                    <div class="panel-heading panel-container">
                        <h2 class="panel-title p-title">Discover</h2>
                    </div>
                    <div class="panel-body text-center">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <a href="{{ config()->get('settings.facebook') }}">
                                    <i class="fab fa-facebook social-icon icon-fb"></i>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <a href="{{ config()->get('settings.twitter') }}">
                                    <i class="fab fa-twitter social-icon icon-tw"></i>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <a href="{{ config()->get('settings.instagram') }}">
                                    <i class="fab fa-instagram social-icon icon-in"></i>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <a href="{{ config()->get('settings.linkedin') }}">
                                    <i class="fab fa-linkedin social-icon icon-li"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-40">
        <div class="col-md-12 col-sm-12">
            <div class="r-box p-0">
                <div class="panel panel-default p-0">
                    <div class="panel-heading panel-container">
                        <h2 class="panel-title p-title">{{ __('common.developers') }}</h2>
                    </div>
                    <div class="panel-body text-center p-0">
                        <div class="row">
                            @foreach (vendors() as $vendor)
                                <div class="col-md-6 col-sm-12 col-xs-6 py-2">
                                    <p>
                                        <a
                                            href="{{ route('search', ['id' => $vendor->id, 'type' => 'vendor', 'title' => str_replace(' ', '-', $vendor->name)]) }}">
                                            <img src="{{ $vendor->image_file }}" class="img-circle"
                                                width="50px"></img>
                                            <span>
                                                {{ $vendor->name }}
                                            </span>
                                        </a>
                                    </p>
                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $section = section(\App\Models\Section::SECTIONS[4]['id'])->load(['apps']);
    @endphp
    @if (($apps = $section->apps)->count() > 0)

        <div class="row mt-40">
            <div class="col-md-12 col-sm-12">
                <div class="r-box p-0">
                    <div class="panel panel-default p-0">
                        <div class="panel-heading panel-container">
                            <h2 class="panel-title p-title">{{ $section->translation('title', app()->getLocale()) }}
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @foreach ($apps as $app)
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="p-panel">
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                    <img src="{{ $app->image_file }}" class="img-responsive p-img"
                                                        title="{{ $app->translation('title', app()->getLocale()) }}"
                                                        alt="{{ $app->translation('title', app()->getLocale()) }}">
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-8 clr-left">
                                                    <h4 class="p-head">
                                                        {{ $app->translation('title', app()->getLocale()) }}</h4>
                                                    <div class="ratings">
                                                        @component('admin.vendors.rate', ['rate' => $app->rate])
                                                        @endcomponent
                                                    </div>
                                                    <p class="p-date">
                                                        26-08-2018
                                                    </p>
                                                    <p>
                                                        <a href="{{ route('apps.details', ['app' => $app->id, 'title' => str_replace(' ', '-', $app->translation('title', app()->getLocale()))]) }}"
                                                            class="btn btn-info p-btn">{{ ucwords(__('common.download')) }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-40">
        <div class="col-md-12 col-sm-12">
            <div class="r-box p-0">
                <div class="panel panel-default p-0">
                    <div class="panel-heading panel-container">
                        <h2 class="panel-title p-title">{{ ucwords(__('site.popular_categories')) }}</h2>
                    </div>
                    <div class="panel-body c-columns">
                        <div class="row">

                            @foreach (categories() as $category)
                                <div class="col-md-6 col-sm-12 col-xs-6">
                                    <p>
                                        <a
                                            href="{{ route('categorySearch', ['category' => $category->id, 'category_name' => str_replace(' ', '-', $category->translation('title', app()->getLocale()))]) }}">
                                            <i class="{{ $category->icon }}"></i>
                                            <span>
                                                {{ $category->translation('title', app()->getLocale()) }}
                                            </span>
                                        </a>
                                    </p>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script !src="">
    function data() {
        return {
            searchItems: [],
            showSearchItems: true,
            search: function(event) {
                this.showSearchItems = true;
                axios.get('{{ route('apps.json') }}', {
                    params: {
                        title: event.target.value
                    }
                }).then((response) => {
                    this.searchItems = response.data;
                });

            }
        }
    }

</script>
