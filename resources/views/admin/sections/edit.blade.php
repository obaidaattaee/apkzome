@extends('layouts.admin')
@section('title' , __('common.sections'))
@section('page-title' , __('common.section'))

@section('header-css')
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
    @include('layouts.admin_components.message')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('sections.update' , ['section' => $section->id ]) }}" method="post"
                  enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group col-md-6">
                                <label for="title">{{__('common.title') }} ( {{  $properties['native'] }} )</label>
                                <input type="text" class="form-control" required id="title-{{$localeCode}}"
                                       name="title[{{$localeCode}}]"
                                       value="{{old('title.'.$localeCode , $section->translation('title' , $localeCode)) }}"
                                       placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>
                                @error('title.'.$localeCode)
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        <div class="form-group col-md-12">
                            <label for="title">{{__('common.apps') }}</label>
                            <select class="form-control" multiple name="apps[]" id="apps">
                                @if(count(object_get($section , 'apps')) > 0)
                                    @foreach(object_get($section , 'apps') as $app)
                                        <option value="{{ $app->id }}" selected>{{ $app->translation('title' , app()->getLocale()) }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('apps')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('sections.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('footer-js')
    <script src="{{ asset('bower_components/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/jquery-ui/jquery-ui.js') }}"></script>

    <script !src="">
        $('#apps').select2({
            placeholder: "{{ __('common.select') . ' ' . __('common.apps') }}",
            templateResult:function ( state , result ){
                if (! state.id){
                    return state.text
                }
                var $state = $(
                    '<span><img src="'+ state.imageFile +'" class="img-flag" style="width: 50px" /> ' + state.text + '</span>'
                );
                return $state;
            },

            ajax: {
                url: '{{route('apps.json')}}',
                dataType: 'json',
                data: function (params) {
                    return {title: params.term}
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                imageFile: item.image_file,
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })

        $("ul.select2-selection__rendered").sortable({
            containment: 'parent'
        });
    </script>
@endsection
