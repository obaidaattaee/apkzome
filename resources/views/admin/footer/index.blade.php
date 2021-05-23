@extends('layouts.admin')
@section('title' , __('common.footer'))
@section('page-title' , __('common.footer'))

@section('tool-bar')
    <div class="card-tools flex">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('footers.create') }}">{{ __('common.new'). ' ' . __('common.footer') }}</a>
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
                                        {{ __('common.link') }}
                                    </th>
                                    <th>
                                        {{ __('common.parent') }}
                                    </th>
                                    <th>
                                        {{ __('common.actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($footers as $footer)
                                        <tr>
                                            <td>{{ $footer->id }}</td>
                                            <td>{{ $footer->title }}
                                            </td>
                                            <td>
                                                <a href="{{ $footer->link }}" class="btn btn-outline-success">{{  __('common.link') }}</a>
                                            </td>
                                            <td>
                                                {{ object_get($footer , 'parent.title') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('footers.edit' , $footer->id) }}"
                                                   class="btn btn-info">
                                                    {{ __('common.edit') }}
                                                </a>
                                                <a onclick="deleteConfirmation({{$footer->id}})"
                                                   class="btn btn-danger">
                                                    {{ __('common.destroy') }}
                                                </a>
                                                <form action="{{ route('footers.destroy' , $footer->id) }}"
                                                      class="deleted_form_{{$footer->id}}" method="post">
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
