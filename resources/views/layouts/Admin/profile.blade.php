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
    <div class="container rounded bg-white ">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5" >
                    <img  class=" mt-5" width="150px" src="{{ !empty(Auth::user()->profile_picture)?asset(Auth::user()->profile_picture):asset("assets/dist/img/avatar5.png") }}">

                    <span class="font-weight-bold">{{ Auth::user()->user_name}}
                     </span>
                    <span class="text-black-50">{{ Auth::user()->email}}
                      </span>
                    <span>
                    </span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <se class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Profile Setting</h3>
                                </div>
                            </se>
                        </div>
                    </div>
                    @if(Session::get('error_msg'))
                        <div class="alert alert-danger alert-dismissable">
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            {{Session::get('error_msg')}}
                        </div>
                    @elseif(Session::get('success_msg'))
                        <div class="alert alert-success alert-dismissable" style="margin-left: 259px;height: 72px;">
                            <h4><i class="icon fa fa-check"></i> Success !</h4>
                            {{Session::get('success_msg')}}
                        </div>
                    @endif
                    <form role="form" action="{{url("submit-Profile/form")}}" method="post" id="quickForm" autocomplete="on"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ isset($user->id)?$user->id:"" }}">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="first_name" class="labels">User Name</label>
                                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="User name"
                                       value="{{$user->user_name}}">
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-md-6">
                                <label for="phone_number" id="phone_number" class="labels">phone_number</label>
                                <input type="text" name="phone_number" class="form-control" placeholder="enter phone_number"
                                       value="{{$user->phone_number}}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" id="email" class="labels">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="enter Email"
                                       value="{{$user->email}}">
                            </div>
                            <div class="col-12">
                                <label for="profile_">Profile Picture</label>
                                <div class="control">
                                    <input class="form-control" type="file" name="profile_picture" id="profile_picture">
                                </div>
                                @if(isset($user->profile_picture)&& !empty($user->profile_picture))<img src="{{ asset($user->profile_picture)}}" id="preview_picture" height="150px" width="150px">@endif
                            </div>
                            <div class="col-md-12">
                                <label for="gender" id="gender" class="labels">Gender</label>
                                <select type="text" class="form-control" name="gender" >
                                    <option {{ ($user->gender)&&$user->gender=='Male'?'selected':"" }} value="Male">Male</option>
                                    <option {{ ($user->gender)&&$user->gender=='Female'?'selected':"" }} value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit"> Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('script')
        <script src="{{ asset("assets/plugins/jquery-validation/jquery.validate.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/jquery-validation/additional-methods.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
        <!-- SweetAlert2 -->
        <!-- Toastr -->
        <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
        <script>

            $("#profile_picture").on('change' ,function (e){
                $("#preview_picture").attr("src", URL.createObjectURL(e.target.files[0]));
            })

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
