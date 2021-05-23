@extends('layouts.admin')
@section('title' , __('common.sections'))
@section('page-title' , __('common.section'))

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
                                        {{ __('common.title') }}
                                    </th>
                                    <th>
                                        {{ __('common.apps') }}
                                    </th>
                                    <th>
                                        {{ __('common.actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $section)
                                        <tr>
                                            <td>{{ $section->translation('title' , app()->getLocale())}}
                                            </td>
                                            <td>
                                                @foreach(object_get($section , 'apps') as $app)
                                                    <a href="{{ route('apps.show' , ['app' => $app->id]) }}">{{ $app->translation('title' , app()->getLocale()) }}</a> ,
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('sections.edit' , $section->id) }}"
                                                   class="btn btn-info">
                                                    {{ __('common.edit') }}
                                                </a>
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
