@extends('layouts.app')

@section('content')
    <center>
        <div class="login-box mt-5">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ route('home') }}" class="h1">{{ env('APP_NAME' , 'APK_ZOM') }}</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">{{ __('auth.start_session') }}</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mt-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="{{ __('auth.email') }}" value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="input-group mt-3">
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="{{ __('auth.password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="row">
                            <div class="col-8 mt-3">
                                <div class="icheck-primary">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        {{ __('auth.remember_me') }}
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4 mt-3">
                                <button type="submit"
                                        class="btn btn-primary btn-block">{{ __('auth.sign_in') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>


                    <p class="mb-1">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </p>

                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">{{ __('auth.register') }}</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </center>
@endsection
