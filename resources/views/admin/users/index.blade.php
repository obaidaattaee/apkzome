@extends('layouts.admin')
@section('title' , __('common.users'))
@section('page-title' , __('common.users'))
@section('title' , __('common.users'))
@section('header-css')
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">--}}
<link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('tool-bar')
    <div class="card-tools flex">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('users.create') }}">{{ __('common.add_new') }}</a>
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
{{--                            {!! $dataTable->table() !!}--}}
                            <div class="table-responsive">
                                <table class="table" id="datatable">

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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/sweetalert2/sweetalert2.js')}}"></script>
    <script !src="">
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                { data: 'id', name: 'id' , title: "#"},
                { data: 'name', name: 'name' ,title: "{{ __('common.name') }}"},
                { data: 'email', name: 'email' ,title: "{{ __('auth.email') }}"},
                { data: 'roles', name: 'roles' ,title: "{{ __('common.roles') }}" , orderable: false},
                { data: 'action', name: 'action' ,title: "{{ __('common.actions') }}"},
            ],
            columnDefs: [
                { "searchable": false, "targets": [3] }  // Disable search on first and last columns
            ]
        });
    </script>

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
