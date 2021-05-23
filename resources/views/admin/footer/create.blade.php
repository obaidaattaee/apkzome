@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.footer'))
@section('page-title' , __('common.add_new') . ' ' . __('common.footer'))

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
            <form action="{{ route('footers.store') }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.os_version') }}</label>
                            <input required type="text" name="title" value="{{ old('title') }}" id="title"
                                   class="form-control" placeholder="{{__('common.title') }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link">{{__('common.os_version') }}</label>
                            <input required type="text" name="link" value="{{ old('link') }}" id="link"
                                   class="form-control" placeholder="{{__('common.link') }}">
                            @error('link')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="parent_id">{{__('common.footer') }}</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="" selected>{{ __('common.select') . ' ' . __('common.footer') }}</option>
                                @foreach($footers as $footer)
                                    <option
                                        value="{{ $footer->id }}" {{ old('parent_id') == $footer->id ? "selected" : ""}}>
                                        {{ $footer->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('footers.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection

