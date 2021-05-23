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
                                        {{ __('common.logo') }}
                                    </th>
                                    <th>
                                        {{ __('common.status') }}
                                    </th>
                                    <th>
                                        {{ __('common.actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($osTypes as $type)
                                        <tr>
                                            <td>{{ $type->id }}</td>
                                            <td>{{ $type->translation('title' , app()->getLocale())}}
                                            </td>
                                            <td>
                                                <img src="{{ $type->image }}" alt="{{ $type->translation('title' , app()->getLocale()) }}" class="img-fluid img-circle" style="max-width: 100px">
                                            </td>
                                            <td>
                                                <div
                                                    class="btn btn-sm btn-{{ $type->is_active ? "success" : 'warning' }}">
                                                    {{ $type->is_active ? __('common.active') : __('common.in_active') }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('os-types.edit' , $type->id) }}"
                                                   class="btn btn-info">
                                                    {{ __('common.edit') }}
                                                </a>
                                                <a onclick="deleteConfirmation({{$type->id}})"
                                                   class="btn btn-danger">
                                                    {{ __('common.destroy') }}
                                                </a>
                                                <form action="{{ route('tags.destroy' , $type->id) }}"
                                                      class="deleted_form_{{$type->id}}" method="post">
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
