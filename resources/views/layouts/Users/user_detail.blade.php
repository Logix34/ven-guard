@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")  }}">
    <link rel="stylesheet" href="{{ asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")  }}">
    <link rel="stylesheet" href="{{ asset("assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")  }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset("assets/plugins/toastr/toastr.min.css")  }}">
    <style>
        td.details-control {
            background: url('{{ asset("assets/dist/img/details_open.png") }}') no-repeat center center;
            cursor: pointer;
            width: 18px;
        }
        tr.shown td.details-control {
            background: url('{{ asset("assets/dist/img/details_close.png") }}') no-repeat center center;
        }
    </style>
@endsection
@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
    @if(Session::get('error_msg'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{Session::get('error_msg')}}
        </div>
    @elseif(Session::get('success_msg'))
        <div class="alert alert-success alert-dismissable" style="margin-left: 259px;height: 72px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success !</h4>
            {{Session::get('success_msg')}}
        </div>
    @endif

    <div class="content-page">
        <main role="main" class="px-4" style="margin-left: 12%; margin-top: 1%;">

            <div class="row">
                <div class="col-5 col-xl-4 ">
                    <div class="card">
                        <h6 class="card-header d-flex align-items-center justify-content-between">
                            Details
                        </h6>
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-column pt-3">
                                <div>
                                    <img class="rounded-circle img-thumbnail img-responsive mb-4"
                                         width="130"
                                         height="130" src="{{ !empty($detail->profile_picture)?asset($detail->profile_picture):asset("assets/dist/img/avatar5.png") }}">
                                </div>

                                <h5> </h5>

                                <a href="mailto:{{$detail->email}}" class="text-muted font-weight-light mb-2">
                                    <span class="__cf_email__" data-cfemail="af9d9defdc81dc">{{$detail->email}}</span>                                </a>
                            </div>

                            <ul class="list-group list-group-flush mt-3">
                                <li class="list-group-item">
                                    <strong>Phone Number:</strong>
                                    {{$detail->phone_number}}
                                </li>
                                <li class="list-group-item">
                                    <strong>Birthday:</strong>
                                    {{$detail->dob}}
                                </li>
                                <li class="list-group-item">
                                    <strong>Address:</strong>
                                    {{$detail->address}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-xl-8">
                    <div class="card">
                        <h6 class="card-header d-flex align-items-end justify-content-between">
                            Latest Activity

                            <small>
                                <a href="{{url('/activity_log')}}"
                                   class="edit float-right"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Complete Activity Log">
                                    View All                </a>
                            </small>
                        </h6>

                        <div class="card-body">
                            <table class="table table-borderless table-striped">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Log Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($activity_log_latest as $activity_log)
                                        @if(isset($activity_log->message))
                                            <td>{{$activity_log->message}}</td>
                                        @endif
                                        @if(isset($activity_log->created_at))
                                            <td>{{Carbon\Carbon::create($activity_log->created_at)->format('y-m-d').' At ' .Carbon\Carbon::create($activity_log->created_at)->format('g:i A')}}</td>
                                        @endif
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
    @section('script')
        <script src="{{ asset("assets/plugins/jquery-validation/jquery.validate.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/jquery-validation/additional-methods.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- SweetAlert2 -->
        <!-- Toastr -->
        <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $('#quickForm').validate({
                /*rules:{
                    custom_instruction: {
                        maxlength: 100,
                    },collection_option_text: {
                        maxlength: 100,
                    },
                },*/
                submitHandler: function (form) {

                    $.ajax({
                        url:"{{ url("/submit-Profile/form") }}",
                        type: 'POST',
                        data: new FormData(form),
                        mimeType: "multipart/form-data",
                        dataType:'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function (data) {
                            if(data.success){
                                Toast.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'profile add successfully',
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                                setTimeout(function () {
                                    window.location="{{ url("admin/dashboard") }}"
                                },500)
                            }else{
                                Toast.fire({
                                    type: 'error',
                                    title: data.error.message
                                });
                            }
                        }
                    })
                }
            });
        </script>
        @if(Session::has('success'))
            <script>
                Toast.fire({
                    type: 'success',
                    title: '{{ Session::get("success") }}'
                })
            </script>

        @endif
    @endsection
    </body>
