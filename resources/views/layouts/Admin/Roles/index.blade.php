@extends('layouts.app')
@section('content')
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
    <body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
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
                </div>0
            @endif
<div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Roles</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard")}}">Home</a></li>
                                        <li class="breadcrumb-item active">Roles</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h1 class="card-title">List</h1>
                                            <div class="header-right" style="float: right">
                                                <a class="btn btn-dark btn-xs " href="{{ url("/add_roles") }}">Add New</a>
                                            </div>
                                        </div>
                                        <div class="card-body col-12">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Display Name</th>
                                                    <th>#Users</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <form method="post" action="{{ url("/submit-roles/form/")}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Roles</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
         </div>
    </div>
   <div class="modal fade" id="edit_roles">
        <div class="modal-dialog">
            <form method="post" action="{{ url("/submit-roles/form/") }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Roles</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="">Name</label>
                            <div class="control">
                                <input class="form-control required" name="role_title" id="edit_role_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="">Status</label>
                            <div class="control">
                                <select class="form-control" name="status" id="status">

                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="edit_role_id">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
    @section('script')
        <script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- SweetAlert2 -->
        <!-- Toastr -->
        <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/handlebars.min.js") }}"></script>
        <script>

            var dt = $('#example2').DataTable( {
                "processing": true,
                "responsive": true,
                "ordering": false,
                "searching": false,
                "serverSide": true,
                "ajax": "{{ url('roles/List') }}",
                "columns": [

                    { "data": "role_title"},
                    { "data": "display_name" },
                    {"data" : "count"},
                    { "data": "action",searchable: false,orderable: false }
                ],
                "order": [[1, 'asc']]
            } );
            // var detailRows = [];
            // $('#example2 tbody').on( 'click', 'tr td.details-control', function () {
            //     var tr = $(this).closest('tr');
            //     var row = dt.row( tr );
            //     var idx = $.inArray( tr.attr('id'), detailRows );
            //
            //     if ( row.child.isShown() ) {
            //         tr.removeClass( 'details');
            //         row.child.hide();
            //
            //         // Remove from the 'open' array
            //         detailRows.splice( idx, 1 );
            //     }
            //     else {
            //         tr.addClass( 'details' );
            //         row.child( format( row.data() ) ).show();
            //
            //         // Add to the 'open' array
            //         if ( idx === -1 ) {
            //             detailRows.push( tr.attr('id') );
            //         }
            //     }
            // } );

            // // On each draw, loop over the `detailRows` array and show any child rows
            // dt.on( 'draw', function () {
            //     $.each( detailRows, function ( i, id ) {
            //         $('#'+id+' td.details-control').trigger( 'click' );
            //     } );
            // } );

            function  getOutletData(id){
                $.ajax({
                    url:"{{ url("role/edit") }}"+"/"+id,
                    success:function (data) {
                        $("#edit_role_name").val(data.success.role_title);
                        $("#edit_role_id").val(data.success.role.id);
                        var  options='';
                        if(data.success.company.status===1){
                            options+="<option selected value='1'> Enable </option>";
                            options+="<option value='0'> Disable </option>"
                        }else{
                            options+="<option value='1'> Enable </option>";
                            options+="<option selected value='0'> Disable </option>"
                        }
                        $("#status").html(options);
                        $("#edit_roles").modal("show")
                    }
                })
            }
        </script>

        <script>
            function delete_btn(id) {



                swal({
                    title: "Are you sure?",
                    text: "Sure, you want to delete this Record?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({url: "role/delete/"+id,
                                success: function(result){
                                if( result.status)
                                {
                                    swal({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Role Deleted successfully',
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                }else{
                                    swal({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'This Roles has ' +result.count+ ' Users',
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                }
                                   {{--window.location."href="{{ url("vanguard_role/delete") }}+"/"+id;--}}

                                }});

                        } else {
                            swal({
                                position: 'top-end',
                                icon: 'error',
                                title: 'SomeThing, Wrong here Your Record is not Deleted',
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    });
            }
        </script>
<script>
    @if(Session::has('error_delete'))
    const Toast =  swal({
        position: 'top-end',
        icon: 'error',
        title: 'SomeThing, Wrong here Your Record is not Deleted',
        showConfirmButton: false,
        timer: 3000
    })
    Toast.fire({
        position: 'top-end',
        icon: 'error',
        title: '{{Session::get('error_delete')}}',
        showConfirmButton: false,
        timer: 3000,
    });
    @endif
</script>
        <script>
            @if(Session::has('Role_add'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{Session::get('Role_add')}}',
                showConfirmButton: false,
                timer: 3000,
            });
            @endif

            @if(Session::has('Role_edit'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{Session::get('Role_edit')}}',
                showConfirmButton: false,
                timer: 3000,
            });
            @endif

            @if(Session::has('Role_failed'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{Session::get('Role_failed')}}',
                showConfirmButton: false,
                timer: 3000,
            });
            @endif
        </script>
@endsection

</body>


















