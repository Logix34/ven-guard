<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Google Font: Source Sans Pro -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/fontawesome-free/css/all.min.css">
    {{--Toaster--}}
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset("assets")}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets")}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form role="form" action="{{url('/verify-login')}}" method="POST" id="login-form" autocomplete="off" class="mt-3">
                <!--for validation of form-->
                @if(Session::has('error_msg'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{Session::get('error_msg')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            <!--end of validation-->
                @csrf
                                    {{------------ -----project Logo----------------------------------}}
                <div class="login-logo">
                    <img class="user-image img-circle elevation-2" src={{ asset("assets/dist/img/v_letter_project.png")  }} class="logo-lg" height="40px" alt="Vanguard">
                    <span style="font-size: 25px;color: #0c84ff;">Project Name</span>
                </div>
                {{-----------------Social media  Icons----------------------------------}}
                <div class="row pb-3 pt-2">
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <a href="#" class="btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <a href="#" class="btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <a href="#" class="btn-google">
                            <i class="fab fa-google-plus-square"></i>
                        </a>
                    </div>
                </div>
                {{-----------------Input feilds of the Form--------------}}

                <div class="form-group">
                    <label for="email" class="sr-only">Email or UserName</label>
                    <input type="text" name="email" id="email" class="form-control  input-solid" placeholder="Email OR UserName" value="" >
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group password-field">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control  input-solid" placeholder="Enter  your Password" >
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember"  value="1"/>
                    <label class="custom-control-label font-weight-normal" for="remember" >
                        Remember me?
                    </label>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">
                        Log In
                    </button>
                </div>
                <a href="{{url('/forget_password')}}" class="forgot">I forgot my password</a>
                <div class="text-muted">
                    Don't have an account?
                    <a class="font-weight-bold" href="sign_up">Sign Up</a>
                </div>
            </form>
       </div>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset("assets")}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("assets")}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--Validation-->
<script src="{{asset("assets")}}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset("assets")}}/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{asset("assets")}}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{asset("assets")}}/plugins/toastr/toastr.min.js"></script>
<script>
    setTimeout(() => {
        $('.alert').alert('close');
    }, 2000);


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
    @if(Session::has('success_msg'))
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000

    });
    Toast.fire({
        icon: 'success',
        title:'{{Session::get('success_msg')}}',
        showConfirmButton: false,
        timer: 3000,
    });
    @endif
</script>

</body>
</html>
