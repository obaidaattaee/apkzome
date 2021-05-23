@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.app'))
@section('page-title' , __('common.add_new') . ' ' . __('common.app'))

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
            <form action="{{ route('app-versions.update' , ['app' => $app->id , 'app_version' => $appVersion->id]) }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="extention">{{ __('common.title') }}</label>
                            <input type="text" required name="title" id="title" class="form-control"
                                   placeholder="{{ __('common.title') }}"
                                   value="{{ old('title'  ,$appVersion->title) }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="published_at">{{ __('common.published_at') }}</label>
                            <input type="date" required name="published_at" id="published_at" class="form-control"
                                   placeholder="{{ __('common.published_at') }}"
                                   value="{{ old('published_at' , $appVersion->published_at) }}">
                            @error('published_at')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group required col-md-6">
                            <label for="category_id">{{ __('common.version_number') }}</label>
                            <input type="text" required name="version_number" id="version_number" class="form-control"
                                   placeholder="{{ __('common.version_number') }}"
                                   value="{{ old('version_number' , $appVersion->version_number) }}">
                            @error('version_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.original_link') }}</label>
                            <input type="url" required name="original_link" id="original_link" class="form-control"
                                   placeholder="{{ __('common.original_link') }}"
                                   value="{{ old('original_link' , $appVersion->original_link) }}">
                            @error('original_link')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.extension') }}</label>
                            <input type="text" required name="extension" id="extension" class="form-control"
                                   placeholder="{{ __('common.extension') }}"
                                   value="{{ old('extension' , $appVersion->extension) }}">
                            @error('extension')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.size') }}</label>
                            <input type="text" required name="size" id="size" class="form-control"
                                   placeholder="{{ __('common.size') }}"
                                   value="{{ old('size' , $appVersion->size) }}">
                            @error('size')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.sort_position') }}</label>
                            <input type="number" required name="sort_number" id="sort_number" class="form-control"
                                   placeholder="{{ __('common.sort_position') }}"
                                   value="{{ old('sort_number' , $appVersion->sort_number) }}">
                            @error('sort_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.signature') }}</label>
                            <input type="text" required name="signature" id="signature" class="form-control"
                                   placeholder="{{ __('common.signature') }}"
                                   value="{{ old('signature' , $appVersion->signature) }}">
                            @error('signature')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.screen_dpi') }}</label>
                            <input type="text" required name="screen_dpi" id="screen_dpi" class="form-control"
                                   placeholder="{{ __('common.screen_dpi') }}"
                                   value="{{ old('screen_dpi' , $appVersion->screen_dpi) }}">
                            @error('screen_dpi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.architecture') }}</label>
                            <input type="text" required name="architecture" id="architecture" class="form-control"
                                   placeholder="{{ __('common.architecture') }}"
                                   value="{{ old('architecture' , $appVersion->architecture) }}">
                            @error('architecture')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tags">{{ __('common.file_hash') }}</label>
                            <input type="text" required name="file_hash" id="file_hash" class="form-control"
                                   placeholder="{{ __('common.file_hash') }}"
                                   value="{{ old('file_hash' , $appVersion->file_hash) }}">
                            @error('file_hash')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="os_version_id">{{ __('common.os_version') }}</label>
                            <select required name="os_version_id" id="os_version_id" class="form-control">
                                <option value="{{ object_get($appVersion , 'OSVersion.id') }}" selected>{{ object_get($appVersion , 'OSVersion.version') }}</option>
                            </select>
                            @error('os_version_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
