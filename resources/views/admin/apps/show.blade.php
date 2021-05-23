@extends('layouts.admin')
@section('title' , __('common.apps') . ' ' . $app->translation('title' , app()->getLocale()))
@section('page-title' , __('common.apps'). ' : ' . $app->translation('title' , app()->getLocale()))

@section('tool-bar')

    <link rel="stylesheet" href="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <div class="card-tools flex">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item mx-1">
                <a class="nav-link active"
                   href="{{ route('apps.edit' , ['app' => $app->id]) }}">{{ __('common.edit')  }}</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link active"
                   href="{{ route('apps.create') }}">{{ __('common.new') . ' ' . __('common.app') }}</a>
            </li>
            <li class="nav-item mx-1">
                <a onclick="deleteConfirmation({{$app->id}})" class="nav-link active btn-danger ">
                    {{ __('common.delete') }}
                </a>
                <form action="{{ route('apps.destroy' , $app->id) }}" class="deleted_form_{{$app->id}}" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            @include('layouts.admin_components.message')
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ $app->image_file }}"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $app->translation('title' , app()->getLocale()) }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('common.downloads') }}</b> <a
                                        class="float-right">{{ $app->download_counter }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('common.published_at') }}</b> <a
                                        class="float-right">{{ $app->published_at }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('common.category') }}</b> <a
                                        class="float-right">{{ object_get($app , 'category')->translation('title' , app()->getLocale()) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('common.os_type') }}</b> <a
                                        class="float-right">{{ object_get($app , 'OSType')->translation('title' , app()->getLocale())}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('common.os_version') }}</b> <a
                                        class="float-right">{{ object_get($app , 'OSVersion.version')}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('common.developer') }}</b> <a
                                        class="float-right">{{ object_get($app , 'owner.name')}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">{{ ucwords(__('common.images')) }}</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#app_versions" data-toggle="tab">{{ ucwords(__('common.versions')) }}</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-tools">
                                                <div class="card-tools flex">
                                                    <ul class="nav nav-pills ml-auto">
                                                        <li class="nav-item">
                                                            <a class="nav-link active"
                                                               href="{{ route('images.create' , ['app' => $app->id]) }}">{{ __('common.add') . ' ' . __('common.image') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                @if(object_get($app , 'images')->count() > 0)
                                                    <table class="table" id="datatable">
                                                        <thead>
                                                        <th>
                                                            #
                                                        </th>
                                                        <th>
                                                            {{ __('common.image') }}
                                                        </th>
                                                        <th>
                                                            {{ __('common.status') }}
                                                        </th>
                                                        <th>
                                                        <th>
                                                            {{ __('common.actions') }}
                                                        </th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(object_get($app , 'images') as $image)
                                                            <tr>
                                                                <td>{{ $image->id }}</td>
                                                                <td>
                                                                    <img src="{{ $image->image_file }}"
                                                                         class="img-fluid"
                                                                         style="max-width: 200px">
                                                                </td>
                                                                <td>
                                                                    {{ $image->translation('image_title' , app()->getLocale()) }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('images.edit' , ['image' => $image->id , 'app' => $app->id]) }}"
                                                                       class="btn btn-info">
                                                                        {{ __('common.edit') }}
                                                                    </a>
                                                                    <a onclick="deleteImageConfirmation({{$image->id}} , {{$image->id}})"
                                                                       class="btn btn-danger">
                                                                        {{ __('common.destroy') }}
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('images.destroy' , ['image' => $image->id , 'app' => $app->id]) }}"
                                                                        class="deleted_image_form_{{$app->id}}-{{$image->id}}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </td>
                                                            </tr>

                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="tab-pane" id="app_versions">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-tools">
                                                <div class="card-tools flex">
                                                    <ul class="nav nav-pills ml-auto">
                                                        <li class="nav-item">
                                                            <a class="nav-link active"
                                                               href="{{ route('app-versions.create' , ['app' => $app->id]) }}">{{ ucwords(__('common.add') . ' ' . __('common.version')) }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                @if(object_get($app , 'versions')->count() > 0)
                                                    <table class="table" id="datatable">
                                                        <thead>
                                                        <th>
                                                            #
                                                        </th>
                                                        <th>
                                                            {{ __('common.title') }}
                                                        </th>
                                                        <th>
                                                            {{ __('common.size') }}
                                                        </th>
                                                        <th>
                                                            {{ __('common.published_at') }}
                                                        </th>
                                                        <th>
                                                            {{ __('common.actions') }}
                                                        </th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(object_get($app , 'versions') as $version)
                                                            <tr>
                                                                <td>{{ $version->id }}</td>
                                                                <td>
                                                                   {{ $version->title }}
                                                                </td>
                                                                <td>
                                                                    {{ $version->size }}
                                                                </td>
                                                                <td>
                                                                    {{ $version->published_at->format('Y-m-d') }}
                                                                </td>
                                                                <td class="text-right">
                                                                    <a href="{{ route('app-versions.edit' , ['app_version' => $version->id , 'app' => $app->id]) }}"
                                                                       class="btn btn-info">
                                                                        {{ __('common.edit') }}
                                                                    </a>
                                                                    <a onclick="deleteVersionConfirmation({{$app->id}} , {{$version->id}})"
                                                                       class="btn btn-danger">
                                                                        {{ __('common.destroy') }}
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('app-versions.destroy' , ['app_version' => $version->id , 'app' => $app->id]) }}"
                                                                        class="deleted_version_form_{{$app->id}}-{{$version->id}}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </td>
                                                            </tr>

                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('footer-js')
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.js')}}"></script>

    <script>
        function deleteConfirmation(app ) {
            Swal.fire({
                title: "{{__('common.are_you_sure')}}?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{__('common.yes')}}, {{__('common.delete_it')}}!",
                cancelButtonText: "{{__('common.no')}}, {{__('common.cancel')}}!",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('.deleted_form_' + app ).submit();
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "{{__('common.cancelled')}}",
                        "{{__('common.cancelled')}}",
                        "error"
                    )
                }
            });
        }
        function deleteImageConfirmation(app , image) {
            console.log(app , image)
            Swal.fire({
                title: "{{__('common.are_you_sure')}}?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{__('common.yes')}}, {{__('common.delete_it')}}!",
                cancelButtonText: "{{__('common.no')}}, {{__('common.cancel')}}!",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('.deleted_image_form_' + app + '-' + image).submit();
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "{{__('common.cancelled')}}",
                        "{{__('common.cancelled')}}",
                        "error"
                    )
                }
            });
        }
        function deleteVersionConfirmation(app , version_id) {
            console.log(app , version_id)
            Swal.fire({
                title: "{{__('common.are_you_sure')}}?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{__('common.yes')}}, {{__('common.delete_it')}}!",
                cancelButtonText: "{{__('common.no')}}, {{__('common.cancel')}}!",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('.deleted_version_form_' + app + '-' + version_id).submit();
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "{{__('common.cancelled')}}",
                        "{{__('common.cancelled')}}",
                        "error"
                    )
                }
            });
        }
    </script>
@endsection
