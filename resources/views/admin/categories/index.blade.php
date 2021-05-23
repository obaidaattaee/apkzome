@extends('layouts.admin')
@section('title' , __('common.categories'))
@section('page-title' , __('common.categories'))

@section('tool-bar')
    <div class="card-tools flex">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('categories.create') }}">{{ __('common.add_new') }}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <section class="content">
        @include('layouts.admin_components.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        {{ __('common.title') }}
                                    </th>
                                    <th>
                                        {{ __('common.description') }}
                                    </th>
                                    <th>
                                        {{ __('common.icon') }}
                                    </th>
                                    <th>
                                        {{ __('common.status') }}
                                    </th>
                                    <th>
                                        {{ __('common.parent_category') }}
                                    </th>
                                    <th>
                                        {{ __('common.actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->translation('title' , app()->getLocale()) }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td><i class="{{$category->icon}}"></i></td>
                                            <td>
                                                <div
                                                    class="btn btn-sm btn-{{ $category->is_active ? "success" : 'warning' }}">
                                                    {{ $category->is_active ? __('common.active') : __('common.in_active') }}
                                                </div>
                                            </td>
                                            <td>{{ $category->parentCategory ? $category->parentCategory->translation('title' , app()->getLocale()) : '-' }}</td>
                                            <td>
                                                <a href="{{ route('categories.edit' , $category->id) }}"
                                                   class="btn btn-info">
                                                    {{ __('common.edit') }}
                                                </a>
                                                <a onclick="deleteConfirmation({{$category->id}})"
                                                   class="btn btn-danger">
                                                    {{ __('common.destroy') }}
                                                </a>
                                                <form action="{{ route('categories.destroy' , $category->id) }}"
                                                      class="deleted_form_{{$category->id}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer-js')
    <script src="{{ asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.js')}}"></script>

    <script>
        function deleteConfirmation(id) {
            Swal.fire({
                title: "{{__('common.are_you_sure')}}?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{__('common.yes')}}, {{__('common.delete_it')}}!",
                cancelButtonText: "{{__('common.no')}}, {{__('common.cancel')}}!",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('.deleted_form_' + id).submit();
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
