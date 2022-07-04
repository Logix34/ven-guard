@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")  }}">
    <link rel="stylesheet" href="{{ asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")  }}">
    {{--Toaster--}}
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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

    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
{{--    @if(Session::get('error_msg'))--}}
{{--        <div class="alert alert-danger alert-dismissable">--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--            <h4><i class="icon fa fa-ban"></i> Error!</h4>--}}
{{--            {{Session::get('error_msg')}}--}}
{{--        </div>--}}
{{--    @elseif(Session::get('success_msg'))--}}
{{--        <div class="alert alert-success alert-dismissable" style="margin-left: 259px;height: 72px;">--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--            <h4><i class="icon fa fa-check"></i> Success !</h4>--}}
{{--            {{Session::get('success_msg')}}--}}
{{--        </div>--}}
{{--    @endif--}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Permission's</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url("admin/dashboard")}}">Home</a></li>
                            <li class="breadcrumb-item active">Permission's</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">List</h1>
                            <div class="header-right" style="float: right">
                                <a class="btn btn-dark btn-xs " href="{{ url("/add_permissions") }}">Add New</a>
                            </div>
                        </div>
                    <!-- /.card-header -->
                    <div class="card-body col-12">
                        @if(Session::get('error_msg'))
                            <div class="alert alert-danger alert-dismissable fade">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                {{Session::get('error_msg')}}
                            </div>
                        @elseif(Session::get('success_msg'))
                            <div class="alert alert-success alert-dismissable fadde-zoom-out show" style="height: 72px;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success !</h4>
                                {{Session::get('success_msg')}}
                            </div>
                        @endif
                        <form role="form" id="quickForm" class="quickForm" method="post" action="{{ url("/store_permissions") }}" enctype="multipart/form-data">
                            @csrf
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    @foreach($roles as $role)
                                         <th>{{$role->role_title}}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $p=>$permission)
                                        <tr>
                                            <td>{{$permission->permission_name}}</td>

                                            @foreach($roles as $k=>$role)
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" id="{{$p.$k}}" {{$role->permissions()->pluck('id')->contains($permission->id)?'checked': ''}} name="roles[{{$role->id}}][]" type="checkbox" value="{{$permission->id}}">
                                                        <label class="custom-control-label d-inline" for="{{$p.$k}}"></label>
                                                    </div>
                                                </td>
                                            @endforeach
                                            <td>
                                                <a class="btn  btn-sm" href="{{url('/permissions/edit'.$permission->id)}}"><i class="fas fa-edit"></i></a>
                                                <a class="btn  delete btn-sm" href=""><i class="fas fa-trash-alt"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    </div>
@endsection
    @section('script')
        <script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
        <!-- Toastr -->
        <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
        <script>
            setTimeout(() => {
                $('.alert').alert('close');
            }, 2000);

            @if(Session::has('success_permission_edit'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            })
            Toast.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{Session::get('success_permission_edit')}}',
                showConfirmButton: false,
                timer: 3000,
            });
            @endif
            @if(Session::has('success_permission_create'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            })
            Toast.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{Session::get('success_permission_create')}}',
                showConfirmButton: false,
                timer: 3000,
            });
            @endif

        </script>
<@endsection


