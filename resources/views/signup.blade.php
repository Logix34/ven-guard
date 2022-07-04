<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign-Up</title>
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
            <form role="form" action="{{url('/submit-signup/form')}}" method="POST" id="login-form" autocomplete="off" class="mt-3">
                @csrf
                {{-----------------project Logo----------------------------------}}
                <div class="login-logo">
                    <img class="user-image img-circle elevation-2" src={{ asset("assets/dist/img/v_letter_project.png")  }} class="logo-lg" height="40px" alt="Vanguard">
                    <span style="font-size: 25px;color: #0c84ff;">Project Name</span><br>
                    <span class="text-center" style="font-size: 20px;">
                        Register
                    </span>
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
                    <label for="user_name" class="sr-only">Username</label>
                    <input type="text" name="user_name" id="user_name" class="form-control input-solid" placeholder="Enter your Username" value="" >
                    @error('user_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" class="form-control input-solid" placeholder="Enter your Email" value="" >

                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group password-field">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password"  class="form-control input-solid" placeholder="Enter your Password">

                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group password-field">
                    <label for="password_confirmation" class="sr-only">Password</label>
                    <input type="password" name="password_confirmation"  class="form-control input-solid" placeholder="conform_password">

                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" >
                    <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="https://www.iubenda.com/en/terms-and-conditions-generator?utm_source=adwords&utm_medium=ppc&utm_campaign=aw_competitors_global_exact&utm_term=term%20and%20condition&utm_content=226000093097&gclid=Cj0KCQiA_JWOBhDRARIsANymNOYkywuK9_qtzadLE3gHMg4-48iP5-TllHKhyidmSdy-U6Biz1_dV_kaArAdEALw_wcB">terms of service</a>.</label>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-signup">
                        Signup
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
</script>
@if(Session::has('success'))
    <script>
        Toast.fire({
            type: 'success',
            title: '{{ Session::get("success") }}'
        })
    </script>

@endif
</body>
</html>
