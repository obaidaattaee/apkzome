@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.image'))
@section('page-title' , $app->translation('title' , app()->getLocale()) . ' : '.__('common.add_new') . ' ' . __('common.image'))
@section('content')
    @include('layouts.admin_components.message')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('images.store' , ['app' => $app->id]) }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    {{--<div class="row">--}}
                        {{--@foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
                            {{--<div class="form-group col-md-6">--}}
                                {{--<label for="title">{{__('common.title') }} ( {{  $properties['native'] }} )</label>--}}
                                {{--<input type="text" class="form-control" required id="image_title-{{$localeCode}}"--}}
                                       {{--name="image_title[{{$localeCode}}]"--}}
                                       {{--value="{{old('title.'.$localeCode)}}"--}}
                                       {{--placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>--}}
                                {{--@error('title.'.$localeCode)--}}
                                {{--<div class="text-danger">{{ $message }}</div>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-6">--}}
                                {{--<label for="title">{{__('common.alt') }} ( {{  $properties['native'] }} )</label>--}}
                                {{--<input type="text" class="form-control" required id="image_alt-{{$localeCode}}"--}}
                                       {{--name="image_alt[{{$localeCode}}]"--}}
                                       {{--value="{{old('title.'.$localeCode)}}"--}}
                                       {{--placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>--}}
                                {{--@error('title.'.$localeCode)--}}
                                {{--<div class="text-danger">{{ $message }}</div>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                        {{--<div class="form-group col-md-6">--}}
                            {{--<label for="title">{{__('common.file') }}</label>--}}
                            {{--<input type="file" class="form-control" required id="customFile"--}}
                                   {{--name="logoFile"--}}
                                   {{--placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>--}}
                            {{--@error('logo')--}}
                            {{--<div class="text-danger">{{ $message }}</div>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-6 mt-4">--}}
                            {{--<div class="custom-control custom-switch">--}}
                                {{--<input type="checkbox" class="custom-control-input" name="on_server" id="customSwitch1">--}}
                                {{--<label class="custom-control-label"--}}
                                       {{--for="customSwitch1">{{ __('common.on_server') }}</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="row images-repeater">
                        <div class="col-md-12">
                            <div data-repeater-list="images">
                                <div data-repeater-item class="outer">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h5 class="font-weight-bold image-title">image #1</h5>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="file" class="form-control"
                                                   name="imageFile"
                                                   placeholder="{{__('common.title')}}"/>
                                            @error('logo')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="url" class="form-control" id="imageUrl"
                                                   name="imageUrl"
                                                   placeholder="{{__('common.imageUrl')}}"/>
                                            @error('imageUrl')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mt-4">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input checkbox1" name="on_server" id="on_server1">
                                                <label class="custom-control-label checkbox-label1" for="on_server1">{{ __('common.on_server') }}</label>
                                                <input data-repeater-delete type="button" value="Delete" class="inner btn btn-danger float-lg-right"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <input data-repeater-create type="button" value="{{ ucwords(__('common.add_new') . ' ' . __('common.image')) }}" class="outer btn btn-success"/>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('os-types.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

@endsection
@section('footer-js')
    <script src="{{ asset('bower_components/jquery.repeater/jquery.repeater.js') }}"></script>

    <script>
        'use strict';
        let repeater_count = 2;
        $('.images-repeater').repeater({
            initEmpty: false,

            show: function () {
                $(this).find('.checkbox1').attr('id' , 'on_server' + repeater_count)
                $(this).find('.checkbox-label1').attr('for' , 'on_server' + repeater_count)
                $(this).find('.image-title').text('image #' + repeater_count)
                repeater_count = repeater_count + 1
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {

            }
        });

    </script>
@endsection
