<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Van Guard</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Admin panel-->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="user-image img-circle elevation-2" src={{ asset("assets/dist/img/v_letter_project.png")  }} class="logo-lg" height="100px" alt="Vanguard">
            </div>
            <span class="brand-text font-weight-light" style="color: white; margin-left: 20px; margin-top: 5px;">Van Guard</span>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{--<li class="nav-item">
                <a href="{{ route("dashboard") }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>--}}
            <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}" class=" nav-link {{Request::is('admin/dashboard') ? 'active' : ''}}">
                        <i class="fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('users')}}"   class=" nav-link {{Request::is('users')||Request::is('add/new_user')||Request::is('user/edit{id}') ? 'active' : ''}}">
                        <i class="far fa-user"></i>
                        <p>
                           users
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('activity_log')}}"   class=" nav-link {{Request::is('activity_log') ? 'active' : ''}}">
                        <i class="fas fa-server"></i>
                        <p>
                            activity Log
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link collapsed" href="#roles-dropdown" data-toggle="collapse" aria-expanded="false" >
                        <i class="fas fa-users-cog"></i>
                        <span>Roles &amp; Permissions</span>
                    </a>

                    <ul class="collapse list-unstyled  {{Request::is('roles')||Request::is('permissions')||Request::is('add_roles') ? 'show' : ''}} " id="roles-dropdown">
                        <li class="nav-item">
                            <a  href="{{url('roles')}}"  class="nav-link {{Request::is('roles')||Request::is('add_roles') ? 'active' : ''}}" >
                                <p>
                                    Roles
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  href="{{url('permissions')}}"  class=" nav-link {{Request::is('permissions')||Request::is('add_permissions') ? 'active' : ''}}">
                                <span>Permissions</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#settings-dropdown" data-toggle="collapse" aria-expanded="false">

                        <i class="fas fa-cogs"></i>
                        <span>Settings</span>

                    </a>

                    <ul class="collapse list-unstyled sub-menu" id="settings-dropdown">
                        <li class="nav-item">
                            <a class="nav-link " href="{{('#')}}">

                                <span>General</span>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">

                                <span>Auth &amp; Registration</span>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{('#')}}">

                                <span>Notifications</span>
                            </a>

                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{('#')}}">
                        <i class="fas fa-bullhorn"></i>

                        <span>Announcements</span>
                    </a>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>

