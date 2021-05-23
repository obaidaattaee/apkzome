@extends('layouts.admin')

@section('title' , __('common.edit') . ' ' . __('common.app'))
@section('page-title' , __('common.edit') . ' ' . __('common.app'))

@section('header-css')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
    {{--    @include('layouts.admin_components.message')--}}
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            @include('layouts.admin_components.message')
            <form action="{{ route('apps.update' , ['app' => $app->id]) }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('PUT')
{{--                    <div class="row">--}}
{{--                        @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label for="title">{{__('common.title') }} ( {{  $properties['native'] }} )</label>--}}
{{--                                <input type="text" class="form-control" id="title-{{ $localeCode }}"--}}
{{--                                       name="app[{{$localeCode}}][title]"--}}
{{--                                       value="{{old('app.'.$localeCode.'.title' , $app->translation('title' , $localeCode))}}"--}}
{{--                                       placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>--}}
{{--                                @error('title.'.$localeCode)--}}
{{--                                <div class="text-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label for="title">{{__('common.description') }} ( {{  $properties['native'] }}--}}
{{--                                    )</label>--}}
{{--                                <textarea class="form-control" id="description-{{ $localeCode }}"--}}
{{--                                          name="app[{{$localeCode}}][description]"--}}
{{--                                          placeholder="{{__('common.description')}}  ( {{  $properties['native'] }} )">{{old('app.'.$localeCode.'.description' , $app->translation('description' , $localeCode))}}</textarea>--}}
{{--                                @error('description.'.$localeCode)--}}
{{--                                <div class="text-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.title') }}</label>
                            <input type="text" class="form-control" id="title"
                                   name="title"
                                   value="{{old('title' , $app->translation('title'))}}"
                                   placeholder="{{__('common.title')}}"/>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.description') }}</label>
                            <textarea class="form-control" id="description"
                                      name="description"
                                      placeholder="{{__('common.description')}}">{{old('description' , $app->translation('description'))}}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="extention">{{ __('common.extension') }}</label>
                            <input type="text" required name="extension" id="extension" class="form-control"
                                   placeholder="{{ __('common.extension' ) }}"
                                   value="{{ old('extension', $app->extension) }}">
                            @error('extension')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="published_at">{{ __('common.published_at') }}</label>
                            <input type="date" required name="published_at" id="published_at" class="form-control"
                                   placeholder="{{ __('common.published_at') }}"
                                   value="{{ old('published_at' , $app->published_at) }}">
                            @error('published_at')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group required col-md-6">
                            <label for="category_id">{{ __('common.category') }}</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="{{ object_get($app , 'category.id') }}" selected> {{ object_get($app , 'category')->translation('title' , app()->getLocale()) }}</option>
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.tags') }}</label>
                            <select class="form-control" required multiple name="tags[]" id="tags">
                                @if($app->has('tags'))
                                    @foreach(object_get($app , 'tags') as $tag)
                                        <option value="{{ $tag->id }}" selected> {{ $tag->translation('title' , app()->getLocale())  }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="os_type_id">{{ __('common.os_type') }}</label>
                            <select required name="os_type_id" id="os_type_id" class="form-control">
                                <option value="{{ object_get($app , 'osType.id') }}" selected> {{ object_get($app , 'osType')->translation('title' , app()->getLocale()) }}</option>

                            </select>
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="os_version_id">{{ __('common.os_version') }}</label>
                            <select required name="os_version_id" id="os_version_id" class="form-control">
                                <option value="{{ object_get($app , 'osVersion.id') }}" selected> {{ object_get($app , 'osVersion.version')}}</option>

                            </select>
                            @error('os_version_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="owner_id">{{ __('common.vendor') }}</label>
                            <select name="owner_id" required id="owner_id" class="form-control">
                                <option value="{{ object_get($app , 'owner.id') }}" selected> {{ object_get($app , 'owner.name')}}</option>
                            </select>
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="rate">{{ __('common.rate') }}</label>
                            <input type="number" class="form-control" id="rate" value="{{ old('rate' , $app->rate) }}" name="rate" max="5" required>
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.file') }}</label>
                            <input type="file" class="form-control" id="customFile"
                                   name="logoFile"
                                   placeholder="{{__('common.title')}} "/>
                            @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.imageUrl') }}</label>
                            <input type="url" class="form-control" value="{{ old('imageUrl' , $app->image_file) }}"  id="imageUrl"
                                   name="imageUrl"
                                   placeholder="{{__('common.imageUrl')}}"/>
                            @error('imageUrl')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.old_file') }}</label>
                            <br>
                            <img src="{{ $app->image_file }}" class="image" style="width: 150px">
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" {{ $app->on_server ? "checked" : "" }} class="custom-control-input" name="on_server" id="customSwitch1">
                                <label class="custom-control-label"
                                       for="customSwitch1">{{ __('common.on_server') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('apps.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

@endsection

@section('footer-js')
    <script src="{{ asset('bower_components/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script !src="">
        $('#category_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.category') }}",
            ajax: {
                url: '{{route('category')}}',
                dataType: 'json',
                data: function (params) {
                    return {category: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title.{{app()->getLocale()}},
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#tags').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.tags') }}",
            ajax: {
                url: '{{route('tags')}}',
                dataType: 'json',
                data: function (params) {
                    return {tag: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title.{{app()->getLocale()}},
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#os_type_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.os_type') }}",
            ajax: {
                url: '{{route('os_types.search')}}',
                dataType: 'json',
                data: function (params) {
                    return {type: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.title.{{app()->getLocale()}},
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#owner_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.owner') }}",
            ajax: {
                url: '{{route('vendors.json')}}',
                dataType: 'json',
                data: function (params) {
                    return {vendor: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
        $('#os_version_id').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.os_version') }}",
            ajax: {
                url: '{{route('os_versions')}}',
                dataType: 'json',
                data: function (params) {
                    return {version: params.term, type: $('#os_type_id').val()}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.version,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
    </script>
    <script src="{{ asset('bower_components/jquery.repeater/jquery-1.11.1.js') }}"></script>

    <script src="{{ asset('bower_components/jquery.repeater/jquery.repeater.js') }}"></script>
    <script>
        'use strict';

        $('.parts').repeater({
            defaultValues: {
                'textarea-input': 'foo',
                'text-input': 'bar',
                'select-input': 'B',
                'checkbox-input': ['A', 'B'],
                'radio-input': 'B'
            },
            show: function () {
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
