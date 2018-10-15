<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ URL::asset('admin-lte') }}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{ \Session::get("HAS_SESSION")["nama_lengkap"] }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                    
                        <img src="{{ URL::asset('admin-lte') }}/dist/img/avatar5.png" class="img-circle" alt="User Image">

                        {{--<p>--}}
                            {{--Admin--}}
                            {{--<small></small>--}}
                        {{--</p>--}}
                    </li>
                    <!-- Menu Body -->
                    {{--<li class="user-body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-4 text-center">--}}
                                {{--<a href="#">Followers</a>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-4 text-center">--}}
                                {{--<a href="#">Sales</a>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-4 text-center">--}}
                                {{--<a href="#">Friends</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- /.row -->--}}
                    {{--</li>--}}
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        {{--<div class="pull-left">--}}
                            {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                        {{--</div>--}}
                        <div class="pull-right">
                            <a href="/do-logout" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>