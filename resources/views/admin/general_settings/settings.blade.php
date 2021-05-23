@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('layouts.admin_components.message')
        <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        General Settings
                    </div>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="twitter">twitter link</label>
                            <input  value="{{ old('twitter' , config()->get('settings.twitter')) }}"  required type="text" name="twitter" id="twitter" placeholder="twitter link" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="facebook">facebook link</label>
                            <input  value="{{ old('facebook', config()->get('settings.facebook')) }}"  required type="text" name="facebook" placeholder="facebook link" id="facebook"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="instagram">instagram link</label>
                            <input  value="{{ old('instagram', config()->get('settings.instagram')) }}"  required type="text" name="instagram" id="instagram" placeholder="instagram link" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="linkedin">linkedin link</label>
                            <input  value="{{ old('linkedin', config()->get('settings.linkedin')) }}"  required type="text" name="linkedin" placeholder="linkedin link" id="linkedin"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="telegram">telegram link</label>
                            <input  value="{{ old('telegram', config()->get('settings.telegram')) }}"  required type="text" name="telegram" id="telegram" placeholder="telegram link" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="address">address</label>
                            <input  value="{{ old('address', config()->get('settings.address')) }}"  required type="text" name="address" id="address" placeholder="address link" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="mail">mail</label>
                            <input  value="{{ old('mail', config()->get('settings.mail')) }}"  required type="text" name="mail" placeholder="mail link" id="mail"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="phone">phone</label>
                            <input  value="{{ old('phone', config()->get('settings.phone')) }}"  required type="text" name="phone" id="phone" placeholder="phone link" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="logo">logo</label>
                            <input type="file" name="logoFile" placeholder="logo link" id="logo"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ config()->get('settings.logo') }}" alt="logo image" style="width: 200px">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">{{ ucwords(__('common.save')) }}</button>
                </div>
            </div>
        </form>

    </div>
@endsection
