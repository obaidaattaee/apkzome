@extends('layouts.admin')

@section('title' , __('common.add_new') . ' ' . __('common.tag'))
@section('page-title' , __('common.add_new') . ' ' . __('common.tag'))
@section('content')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <!-- /.card-header -->
            <form action="{{ route('tags.store') }}" method="post">
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

                        <div class="form-group col-md-12">
                            <label for="description">{{__('common.description')}}</label>
                            <textarea type="text" class="form-control" name="description"
                                      id="description"
                                      placeholder="{{__('common.description')}}"></textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success">{{ __('common.save') }}</button>
                    <a href="{{ route('tags.index') }}" class="btn btn-outline-danger">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
