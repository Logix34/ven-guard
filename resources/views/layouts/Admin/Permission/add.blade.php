@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset("assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")  }}">
    <!-- Toaster -->
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header col-sm-12">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ isset($detail)?"Edit Permissions":"Add Permissions" }}</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url("/admin/dashboard") }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ isset($detail)?"Edit Permissions":"Add Permissions" }}</li>
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
                <form role="form" id="quickForm" class="quickForm" method="post" action="{{ url("/create_permissions") }}" enctype="multipart/form-data">
                    <input  type="hidden" name="id"  value="{{ isset($detail->id)?$detail->id:"" }}">
                    <div class="card-body row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Permission Name</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="permission_name" id="permission_name" value="{{ isset($detail->permission_name)?$detail->permission_name:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Diplay Name</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="display_name" id="display_name" value="{{ isset($detail->display_name)?$detail->display_name:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="phone">Description</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="description"  id="description" value="{{ isset($detail->description)?$detail->description:"" }}">
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
@endsection
@section('script')
    <script src="{{ asset("assets/plugins/jquery-validation/jquery.validate.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/jquery-validation/additional-methods.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
    <!-- SweetAlert2 -->
    <!-- Toastr -->
    <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
    <script>
        function  getCustomerData(id){
            $.ajax({
                url:"{{ url("permissions/edit") }}"+"/"+id,
                success:function (data) {
                    $("#edit_user_name").val(data.success.user.user_name);
                    $("#edit_user_id").val(data.success.user.id);
                    var  options='';
                    if(data.success.company.status===1){
                        options+="<option selected value='1'> Enable </option>";
                        options+="<option value='0'> Disable </option>"
                    }else{
                        options+="<option value='1'> Enable </option>";
                        options+="<option selected value='0'> Disable </option>"
                    }
                    $("#status").html(options);
                    $("#edit_user").modal("show")
                }
            })
        }
    </script>
@endsection
