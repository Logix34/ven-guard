
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>
    <form class="form-inline ml-3 form-control" style="border: none">

    </form>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ !empty(Auth::user()->profile_picture)?asset(Auth::user()->profile_picture):asset("assets/dist/img/avatar5.png") }}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-default">
                    <img src="{{ !empty(Auth::user()->profile_picture)?asset(Auth::user()->profile_picture):asset("assets/dist/img/avatar5.png") }}" class="user-image img-circle elevation-2" alt="User Image">
                    <br>
                    <span class="font-weight-bold">
                        User Title :
                        <span class="text-black-50">
                            {{ Auth::user()->user_name}}
                          </span>
                    </span><br>

                      <span class="text-black-50">
                        {{ Auth::user()->email}}
                      </span>

                    <span>
                    </span>
                </li>

                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">

                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ url("User/profile") }}" class="btn btn-default btn-flat">Profile</a>

                    <form action="{{url('/logout')}}" method="POST" id="logout-form">
                        @csrf
                        <a  onclick="document.getElementById('logout-form').submit()" class="btn btn-default btn-flat" type="submit">Sign out</a>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

