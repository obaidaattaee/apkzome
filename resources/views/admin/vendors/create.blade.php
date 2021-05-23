@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.vendor'))
@section('page-title' , __('common.add_new') . ' ' . __('common.vendor'))

@section('content')
        @include('layouts.admin_components.message')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('vendors.store') }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">{{__('common.name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}"
                                   placeholder="{{__('common.name') }}">
                            @error('os_type_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rate">{{__('common.rate') }}</label>
                            <input type="number" max="5" name="rate" value="{{ old('rate') }}" id="rate"
                                   class="form-control" placeholder="{{__('common.rate') }}">
                            @error('rate')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">{{__('common.file') }}</label>
                            <input type="file" class="form-control" required id="customFile"
                                   name="logoFile"/>
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" {{ old('on_server') ? "checked" : "" }} name="on_server" id="customSwitch1">
                                <label class="custom-control-label"
                                       for="customSwitch1">{{ __('common.on_server') }}</label>
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

