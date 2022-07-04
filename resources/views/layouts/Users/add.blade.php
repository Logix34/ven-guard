@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset("assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")  }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset("assets/plugins/toastr/toastr.min.css")  }}">
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header col-sm-12">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ isset($detail)?"Edit User":"Add User" }}</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url("/admin/dashboard") }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ isset($detail)?"Edit User":"Add User" }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <se class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Info</h3>
                            </div>
                        </se>
                    </div>
                </div>
                <form role="form" id="quickForm" class="quickForm" method="Post" action="{{ url("/submit-Users/form") }}" enctype="multipart/form-data">
                    <input  type="hidden" name="id"  value="{{ isset($detail->id)?$detail->id:"" }}">
                    <div class="card-body row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="user_name" id="user_name" value="{{ isset($detail->user_name)?$detail->user_name:"" }}" placeholder="Enter User Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="company_id">Role</label>
                                <div class="control">
                                    <select class="form-control" name="role_id" id="role_id">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="email" id="email" value="{{ isset($detail->email)?$detail->email:"" }}" placeholder="Enter your Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="control">
                                    <select class="form-control" name="status" id="status" required=""> >
                                        <option {{ isset($detail->status)&&$detail->status=='Baned'?'selected':"" }} value="Baned"> Baned</option>
                                        <option {{ isset($detail->status)&&$detail->status=='UnConfirmed'?'selected':"" }} value="UnConfirmed"> UnConfirmed</option>
                                        <option {{ isset($detail->status)&&$detail->status=='Active'?'selected':"" }} value="Active"> Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Date Of Birth</label>
                                <div class="control">
                                    <input class="form-control"  type="date" name="dob" id="dob" value="{{ isset($detail->dob)? \Carbon\Carbon::create($detail->dob)->format('yy-m-d'): "N/A"}}" placeholder="Enter your Date Of Birth">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Address</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="address" id="address" value="{{ isset($detail->address)?$detail->address:"" }}" placeholder="Enter your address">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="control">
                                    <select type="text" class="form-control" name="gender" id="gender" required=""  value="{{ isset($detail->gender)?$detail->gender:"" }}">
                                        <option {{ isset($detail->gender)&&$detail->gender=='Male'?'selected':"" }} value="Male">Male</option>
                                        <option {{ isset($detail->gender)&&$detail->gender=='Female'?'selected':"" }} value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone_number">phone Number</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="phone_number" id="phone_number" value="{{ isset($detail->phone_number)?$detail->phone_number:"" }}" placeholder="Enter PhoneNumber">
                                </div>
                            </div>
                        </div>
                        <div class=" col-6">
                            <label for="profile_">Profile Picture</label>
                            <div class="control">
                                <input class="form-control" type="file" name="profile_picture" id="profile_picture" required value="">
                            </div>
                            @if(isset($detail->profile_picture)&& !empty($detail->profile_picture))<img src="{{ asset($detail->profile_picture)}}" id="preview_picture" height="150px" width="150px">@endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Password</label>
                                <div class="control">
                                    <input class="form-control" required="" type="password" name="password" id="password" placeholder="Enter password">
                                </div>
                            </div>
                        </div>
                        @csrf
                        <input name="id" value="{{ isset($detail->id)?$detail->id:"" }}" type="hidden">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </section>
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

            $('#example2').validate({
                /*rules:{
                    custom_instruction: {
                        maxlength: 100,
                    },collection_option_text: {
                        maxlength: 100,
                    },
                },*/
                submitHandler: function (form) {

                    $.ajax({
                        url:"{{ url("submit-Users/form") }}",
                        type: 'POST',
                        data: new FormData($('#example2')[0]),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function (data) {
                            if(data.success){
                                Toast.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'User add successfully',
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                                setTimeout(function () {
                                    window.location="{{ url("vanguard/users") }}"
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
@endsection
