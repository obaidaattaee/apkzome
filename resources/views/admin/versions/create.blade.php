@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.os_version'))
@section('page-title' , __('common.add_new') . ' ' . __('common.os_version'))

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
            <form action="{{ route('versions.store') }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.os_type') }}</label>
                            <select name="os_type_id" id="os_type_id" class="form-control">
                                <option value="" selected
                                        disabled>{{ __('common.select') . ' ' . __('common.os_types') }}</option>
                                @foreach($types as $type)
                                    <option
                                        value="{{ $type->id }}" {{ old('os_type_id') == $type->id ? "selected" : ""}}>
                                        {{ $type->translation('title' , app()->getLocale() )}}
                                    </option>
                                @endforeach
                            </select>
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.os_version') }}</label>
                            <input type="text" name="version" value="{{ old('version') }}" id="version"
                                   class="form-control" placeholder="{{__('common.os_version') }}">
                            @error('version')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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

