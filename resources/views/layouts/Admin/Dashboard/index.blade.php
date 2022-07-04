@include('layouts.includes.header')
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
@include('layouts.includes.nav_bar')
@include('layouts.includes.side_bar')
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="margin-left: 250px">Dashboard</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard")}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="margin-left: 250px;">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row" >
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info" >
                        <div class="inner">
                            <h3>{{$users}}</h3>

                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success" >
                        <div class="inner">
                            <h3> {{$latest_user}}<sup style="font-size: 20px"></sup> </h3>

                            <p>New Users </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                             <h3>{{$unconfirmed_user}}</h3>

                            <p>Unconfermed Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-synagogue"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger"`>
                        <div class="inner">
                            <h3>{{$bane_users}}</h3>

                        <p>Baned Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
        <div class="col-md-4" style="float: right;">
            <div class="card overflow-hidden">
                <h6 class="card-header d-flex align-items-center justify-content-between">
                    Latest Registrations
                    <small class="float-right">
                        <a href="{{url('/users')}}">View All</a>
                    </small>
                </h6>
                <div class="card-body">
                    @foreach($latest_registers as $latest_register)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action px-4 py-3">
                                <a href="{{url('/user/detail/'.$latest_register->id)}}" class="d-flex text-dark no-decoration">
                                            <img src="{{asset($latest_register->profile_picture)}}" class="rounded-circle" width="40" height="40"/>
                                    <div class="ml-2" style="line-height: 1.2;">
                                        <span class="d-block p-0"> {{$latest_register->email}}</span>
                                        <small class="text-muted">{{$latest_register->created_at->diffForHumans()}}</small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <h6 class="card-header">Registration History</h6>
                <div class="card-body">
                    <div class="pt-4 px-3"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                </div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0">

                                </div>
                            </div>
                        </div>
                        <canvas id="myChart" height="365" width="972" style="display: block; width: 972px; height: 365px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    @include('layouts.includes.footer')
    <script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
    <!-- Toastr -->
    <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
    <script src="{{ asset("assets/dist/js/chart.min.js") }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script>
        @if(Session::has('success'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{Session::get('success')}}',
            showConfirmButton: false,
            timer: 3000,
        });
        @endif

            @if(Session::has('success_signUp'))
        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        Toast.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{Session::get('success_signUp')}}',
            showConfirmButton: false,
            timer: 3000,
        });
        @endif
    </script>
         <script>
             let months=[]
            const labels=@json($months);
            const data = {
                labels: labels,
                datasets: [{
                    label: 'New Users',
                    backgroundColor: 'rgb(23, 153, 112)',
                    borderColor: 'rgb(23, 153, 112)',
                    data: @json($monthsCount),
                }]
            };
            const config = {
                type: 'line',
                data: data,
                options: {}
            };
        </script>
        <script>
            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
    </body>
