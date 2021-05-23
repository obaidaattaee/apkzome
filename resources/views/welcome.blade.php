@extends('layouts.site')

@section('title')
    {{ ucwords(__('common.home')) }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="slider mt-30">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    @foreach($sliders as $key => $slider)
                                        <li data-target="#myCarousel" data-slide-to="{{ $key }}"
                                            class="{{ $key == 0 ? "active" : "" }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($sliders as $key => $slider)
                                        <div class="item {{ $key == 0 ? "active" : "" }}">
                                            <img src="{{  $slider->image_file }}"
                                                 alt="{{ $slider->translation('image_alt' , app()->getLocale()) }}"
                                                 title="{{ $slider->translation('image_title' , app()->getLocale()) }}"
                                                 class="img-responsive center-all">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
                @php
                    $section = section(\App\Models\Section::SECTIONS[0]['id'])->load(['apps'])
                @endphp
                @if(($apps = $section->apps()->with(['translations'])->limit(9)->get())->count() > 0)
                    <div class="row mt-40">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">
                                        <a href="{{ route('sectionSearch' , ['section' => $section->id , 'section_name' => str_replace('/' , '-' ,$section->translation('title' , app()->getLocale()))]) }}">
                                            {{ $section->translation('title' , app()->getLocale()) }}
                                            <span class="text-right">more >></span>
                                        </a>
                                    </h2>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        @component('site.components.section' , ['apps' => $apps])
                                        @endcomponent
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @php
                    $section = section(\App\Models\Section::SECTIONS[1]['id'])->load(['apps'])
                @endphp
                <div class="row mt-40">
                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-container">
                                <h2 class="panel-title p-title">
                                    <a href="{{ route('sectionSearch' , ['section' => $section->id , 'section_name' => str_replace('/' , '-' ,$section->translation('title' , app()->getLocale()))]) }}">
                                        {{ $section->translation('title' , app()->getLocale()) }}
                                        <span class="text-right">more >></span>
                                    </a>
                                </h2>
                            </div>
                            <div class="panel-body">

                                <!--  -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab"
                                                          href="#p01">{{ section(\App\Models\Section::SECTIONS[2]['id'])->translation('title' , app()->getLocale()) }}</a>
                                    </li>
                                    <li><a data-toggle="tab"
                                           href="#p02">{{ section(\App\Models\Section::SECTIONS[1]['id'])->translation('title' , app()->getLocale()) }}</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-20">
                                    @php
                                        $section = section(\App\Models\Section::SECTIONS[2]['id'])->load(['apps'])
                                    @endphp
                                    @if(($apps = $section->apps)->count() > 0)
                                        <div id="p01" class="tab-pane fade in active">
                                            <div class="row">

                                                @component('site.components.section' , ['apps' => $apps])

                                                @endcomponent
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $section = section(\App\Models\Section::SECTIONS[1]['id'])->load(['apps'])
                                    @endphp
                                    @if(($apps = $section->apps)->count() > 0)

                                        <div id="p02" class="tab-pane fade">
                                            <div class="row">

                                                @component('site.components.section' , ['apps' => $apps])

                                                @endcomponent
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!--  -->


                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $section = section(\App\Models\Section::SECTIONS[3]['id'])->load(['apps'])
                @endphp
                @if(($apps = $section->apps)->count() > 0)
                    <div class="row mt-40">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading panel-container">
                                    <h2 class="panel-title p-title">
                                        <a href="{{ route('sectionSearch' , ['section' => $section->id , 'section_name' => str_replace('/' , '-' ,$section->translation('title' , app()->getLocale()))]) }}">
                                            {{ $section->translation('title' , app()->getLocale()) }}
                                            <span class="text-right">more >></span>
                                        </a>
                                    </h2>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        @component('site.components.comming_soon' , ['apps' => $apps])
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @component('site.components.sidebar_site')
            @endcomponent
        </div>
    </div>


@endsection
