@extends('layouts.admin')
@section('title' , __('common.os_types'))
@section('page-title' , __('common.os_types'))

@section('tool-bar')
    <div class="card-tools flex">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('os-types.create') }}">{{ __('common.add_new') }}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    @include('layouts.admin_components.message')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('os-types.update' , ['os_type' => $type->id]) }}" method="post"
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
                                       value="{{old('title.'.$localeCode) ?? $type->translation('title' , $localeCode)}}"
                                       placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>
                                @error('title.'.$localeCode)
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.file') }}</label>
                            <input type="file" class="form-control" id="customFile"
                                   name="logoFile"
                                   placeholder="{{__('common.title')}}  ( {{  $properties['native'] }} )"/>
                            @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.old_file') }}</label>
                            <br>
                            <img src="{{ $type->image }}" alt="" style="width: 100px">
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                       {{ $type->on_server ? 'checked' : "" }} name="on_server" id="customSwitch1">
                                <label class="custom-control-label"
                                       for="customSwitch1">{{ __('common.on_server') }}</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                       {{ $type->is_active ? 'checked' : "" }} name="is_active" id="is_active">
                                <label class="custom-control-label"
                                       for="is_active">{{ __('common.is_active') }}</label>
                            </div>
                        </div>
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
