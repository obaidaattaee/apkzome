<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME' ,'APKZOM') }} | @yield('title')</title>
    <link href="{{ asset('bower_components/web_design/css/custom.css') }}" rel="stylesheet">
    <!-- Bootstrap css -->
    <link href="{{ asset('bower_components/web_design/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Font Awesome Library for icons -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"--}}
{{--          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="--}}
{{--          crossorigin="anonymous"/>--}}
    @php
        $direction = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection();
    @endphp

{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
</head>
<body>
<div >
    <nav class="navbar navbar-default navbar-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ config()->get('settings.logo') }}" class="img-responsive logo-style"
                                 alt="img"/>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        @php
                            $gameAppCategories = Cache::remember('gameAppCategories', 3600, function (){
                                    return App\Models\Category::find([App\Models\Category::CATEGORIES[0]['id'] , App\Models\Category::CATEGORIES[1]['id']]);
                                });
                        @endphp
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('categorySearch' , ['category' => 1 , 'category_name' => str_replace(' ' , '-' , $gameAppCategories->find(App\Models\Category::CATEGORIES[0]['id'])->translation('title' , app()->getLocale()))]) }}">
                                    <i class="{{ $gameAppCategories->find(App\Models\Category::CATEGORIES[0]['id'])->icon }} menu-icons"></i>
                                    {{ $gameAppCategories->find(App\Models\Category::CATEGORIES[0]['id'])->translation('title' , app()->getLocale()) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categorySearch' , ['category' => 2 , 'category_name' => str_replace(' ' , '-' , $gameAppCategories->find(App\Models\Category::CATEGORIES[1]['id'])->translation('title' , app()->getLocale()))]) }}">
                                    <i class="{{ $gameAppCategories->find(App\Models\Category::CATEGORIES[1]['id'])->icon }} menu-icons"></i>
                                    {{ $gameAppCategories->find(App\Models\Category::CATEGORIES[1]['id'])->translation('title' , app()->getLocale()) }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <i class="fas fa-tasks menu-icons"></i>
                                    {{ ucwords(__('common.topics')) }}
                                </a>

                                <div
                                    class="dropdown-menu dropdown-menu-lg {{$direction == "rtl" ? '' : 'dropdown-menu-right'}}"
                                    @if(!$direction == "rtl")  style="left: inherit; right: 0px;" @endif>
                                    @foreach(sections() as $section)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" rel="alternate"
                                           href="{{ route('sectionSearch' , ['section' => $section->id , 'section_name' => str_replace('/' , '-' ,$section->translation('title' , app()->getLocale()))]) }}">
                                            {{ $section->translation('title' , app()->getLocale()) }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                    {{ app() ->getLocale()}}
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-lg {{$direction == "rtl" ? '' : 'dropdown-menu-right'}}"
                                    @if(!$direction == "rtl")  style="left: inherit; right: 0px;" @endif>
                                    @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="clear-div"></div>

    @yield('content')

    <div class="clear-div"></div>
    <div class="footer-container">
        <div class="footer-overlay">
            <div class="container">
                <div class="row">
                    @foreach(footer() as $footer)
                        <div class="col-md-3 col-sm-3">
                            <h3 class="f02">{{ $footer->title }}</h3>
                            <ul class="footer-list">
                                @foreach($footer->children as $children)
                                    <li>
                                        <a href="{{ $children->link }}">
                                            {{ $children->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    <div class="col-md-3 col-sm-3">
                        <h3 class="f02">Contact Us</h3>
                        <ul class="footer-list">

                            <li>
                                {{ config()->get('settings.address') }}
                            </li>
                            <li class="mt-10">
                                <i class="fab fa-envelope"></i>
                                {{ config()->get('settings.mail') }}
                            </li>
                            <li class="mt-10">
                                <i class="fab fa-phone"></i>
                                {{ config()->get('settings.phone') }}
                            </li>
                            <li class="footer-social-list mt-10">
                                <a href="{{ config()->get('settings.facebook') }}">
                                    <i class="fab fa-facebook-square" aria-hidden="true"></i>
                                </a>
                                <a href="{{ config()->get('settings.instagram') }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ config()->get('settings.twitter') }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ config()->get('settings.linkedin') }}">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="{{ config()->get('settings.telegram') }}">
                                    <i class="fab fa-telegram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--JQUERY AND BOOTSTRAP JS REFERENCE LINK-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js"
        integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ=="
        crossorigin="anonymous"></script>

<script src="{{ asset('bower_components/web_design/js/jquery.js') }}"></script>
<script src="{{ asset('bower_components/web_design/js/bootstrap.min.js') }}"></script>
</body>
</html>
