<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset -Password</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
    <!--for validation of form-->
    @if(Session::has('error_msg'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{Session::get('error_msg')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
@endif
<!--end of validation-->
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form role="form" action="{{url('/reset_password')}}" method="POST" id="login-form" autocomplete="off" class="mt-3">
                @csrf
                {{-----------------project Logo----------------------------------}}
                <div class="login-logo">
                    <img class="user-image img-circle elevation-2" src={{ asset("assets/dist/img/v_letter_project.png")  }} class="logo-lg" height="40px" alt="Vanguard">
                    <span style="font-size: 25px;color: #0c84ff;">Project Name</span><br>
                    <span class="text-center" style="font-size: 20px;">
                        Reset Your Password
                    </span>
                </div>
                {{-----------------Input feilds of the Form--------------}}
                <div class="form-group">
                    <label for="code" class="sr-only">Enter Your OTP</label>
                    <input type="number" name="code" id="code" class="form-control input-solid" placeholder="Enter Your OTP" value="" requierd="">
                    @error('code')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group password-field">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password"  class="form-control input-solid" placeholder="Enter your Password" >

                    @error('password')
                    <div class="alert alert-danger">
                        {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group password-field">
                    <label for="password_confirmation" class="sr-only">Password</label>
                    <input type="password" name="password_confirmation"  class="form-control input-solid" placeholder="conform_password">

                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">
                        Reset Password
                    </button>
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
</script>
</body>
</html>
