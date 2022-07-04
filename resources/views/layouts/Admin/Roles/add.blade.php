@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset("assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")  }}">
    <!-- Toaster -->
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header col-sm-12">
                <div class="container-fluid">
                       <div class="col-sm-6">
                            <div class="row mb-2">
                            <h1 class="m-0 text-dark">{{ isset($detail)?"Edit Roles":"Add Roles" }}</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url("/admin/dashboard") }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ isset($detail)?"Edit Roles":"Add Roles" }}</li>
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
                <form role="form" id="quickForm" class="quickForm" method="post" action="{{ url("/submit-roles/form/") }}" enctype="multipart/form-data">
                    <input  type="hidden" name="id"  value="{{ isset($detail->id)?$detail->id:"" }}">
                    <div class="card-body row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="role_title" id="role_title" value="{{ isset($detail->role_title)?$detail->role_title:"" }}">
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
                                    <input class="form-control" required="" type="text" name="description" id="description" value="{{ isset($detail->description)?$detail->description:"" }}">
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
    </body>
@endsection
