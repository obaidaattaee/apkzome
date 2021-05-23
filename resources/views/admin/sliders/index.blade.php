@extends('layouts.admin')
@section('title' , __('common.sliders'))
@section('page-title' , __('common.sliders'))

@section('tool-bar')
    <div class="card-tools flex">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
                <a class="nav-link active"
{{--                   data-toggle="modal"--}}
{{--                        data-target="#modal-lg"--}}
                href="{{ route('sliders.create') }}">{{ __('common.add_new') }}</a>
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
                                        {{ __('common.image') }}
                                    </th>
                                    <th>
                                        {{ __('common.status') }}
                                    </th>
                                    <th>
                                        {{ __('common.actions') }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->id }}</td>
                                            <td>
                                                <img src="{{ $slider->image_file }}" class="img-fluid"
                                                     style="max-width: 200px">
                                            </td>
                                            <td>
                                                <div
                                                    class="btn btn-sm btn-{{ $slider->is_active ? "success" : 'warning' }}">
                                                    {{ $slider->is_active ? __('common.active') : __('common.in_active') }}
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('sliders.edit' , ['slider' => $slider->id]) }}"
                                                   class="btn btn-info">
                                                    {{ __('common.edit') }}
                                                </a>
                                                <a onclick="deleteConfirmation({{$slider->id}})"
                                                   class="btn btn-danger">
                                                    {{ __('common.destroy') }}
                                                </a>
                                                <form action="{{ route('sliders.destroy' , $slider->id) }}"
                                                      class="deleted_form_{{$slider->id}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="modal-lg-{{$slider->id}}"
                                             style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('common.edit') . ' ' . __('common.image') }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="updateForm-{{$slider->id}}"
                                                              action="{{ route('sliders.update' , ['slider' => $slider->id]) }}"
                                                              method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input type="file" name="image" id="image" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label
                                                                        for="is_active">{{__('common.status')}}</label>
                                                                    <div class="col-sm-6">
                                                                        <!-- radio -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio"
                                                                                       name="is_active"
                                                                                       value="1"
                                                                                       {{ old('is_active') == 1 ? 'checked' : ($slider->is_active ? "checked" : "") }} id="active">
                                                                                <label for="active">
                                                                                    {{ __('common.active') }}
                                                                                </label>
                                                                            </div>
                                                                            <div class="icheck-danger d-inline">
                                                                                <input type="radio"
                                                                                       name="is_active"
                                                                                       value="0"
                                                                                       {{ old('is_active') == 0 ? 'checked' : ( !$slider->is_active ? "checked" : "") }} id="in_active">
                                                                                <label for="in_active">
                                                                                    {{ __('common.in_active') }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </form>
                                                    </div>
                                                    <img src="{{ asset('uploads/' .$slider->image ) }}"
                                                         class="image" style="width: 100%">
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" form="updateForm-{{$slider->id}}"
                                                                class="btn btn-primary">Save changes
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

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

    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ ucwords(__('common.new_slider')) }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="storeForm" action="{{ route('sliders.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" id="image">
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="storeForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
