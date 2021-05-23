@extends('layouts.admin')
@section('title' , __('common.users'))
@section('page-title' , __('common.users'))
@section('title' , __('common.users'))
@section('header-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="card card-default">
        <div class="card-body">
            <form id="form" action="{{ route('post.users.change-password' , ['user' => $user->id]) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="name">{{ __('common.current_password') }}</lable>
                            <input type="password" class="form-control" name="current_password" required
                                   value="{{ old('current_password') }}"
                                   id="name" placeholder="{{ __('common.current_password') }}" autocomplete="off">
                            @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="email">{{ __('auth.password') }}</lable>
                            <input type="password" class="form-control" name="password" required
                                   value="{{ old('password') }}"
                                   id="email" placeholder="{{ __('auth.password') }}" autocomplete="">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-outline-success" form="form">{{ __('common.save') }}</button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>

        </div>
    </div>

@endsection
