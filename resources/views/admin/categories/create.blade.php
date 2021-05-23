@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.category'))
@section('page-title' , __('common.add_new') . ' ' . __('common.category'))
@section('header-css')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('categories.store') }}" method="post">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group col-md-6">
                                <label for="title">{{__('common.title') }} ( {{  $properties['native'] }} )</label>
                                <input type="text" class="form-control" required id="title"
                                       name="title[{{$localeCode}}]"
                                       value="{{old('title.'.$localeCode)}}"
                                       placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>
                                @error('title.'.$localeCode)
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        <div class="form-group col-md-6">
                            <label for="icon">{{__('common.icon')}}</label>
                            <input type="text" class="form-control" name="icon"
                                   id="icon"
                                   placeholder="{{__('common.icon')}}"/>
                            <div class="text-info" id="icon_error">pleas select one from
                                <a href="https://fontawesome.com/icons?d=gallery&p=2&m=free" target="_blank">here</a>
                                @error('icon')
                                <div class="text-danger">| {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">{{__('common.description')}}</label>
                            <textarea type="text" class="form-control" name="description"
                                      id="description"
                                      placeholder="{{__('common.description')}}"></textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group required col-md-6">
                            <label for="category_id">{{ __('common.parent_category') }}</label>
                            <select class="form-control" name="parent_category" id="parent_category">

                            </select>
                            @error('parent_category')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('categories.index') }}"
                       class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('footer-js')
    <script src="{{ asset('bower_components/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script !src="">
        $('#parent_category').select2({
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
    </script>
@endsection
