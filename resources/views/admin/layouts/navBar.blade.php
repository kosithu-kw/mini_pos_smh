<header class="main-header">

    <!-- Logo -->
    <a href="{{route('dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{{URL::to('ntg/logo.png')}}" class="img-circle" style="width: 40px"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{{URL::to('ntg/logo.png')}}" class="img-circle" style="width: 40px"><b>NTG Mini POS</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                <li><a href="{{route('sale')}}"><i class="fa fa-shopping-bag"></i>  <span>Sale</span> </a></li>

                <li><a href="{{route('product.all')}}"><i class="fa fa-database"></i>  <span>Products</span> </a></li>

                @if( (Auth::User()->hasRole('Admin')) || (Auth::User()->hasRole('Manager')))
                    <li><a href="{{route('sales.report')}}"><i class="fa fa-pie-chart"></i>  <span>Reports</span> </a></li>
                @endif
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-user-circle"></span>
                        <span class="hidden-xs">{{Auth::user()->full_name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <span class="fa fa-user-circle fa-5x" style="color: #ffffff;"></span>
                            <p>
                                {{Auth::user()->full_name}}
                                <small>Member since {{date('d-M-Y', strtotime(Auth::User()->created_at))}}</small>
                                <small>

                                </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">

                                <a href="{{route('account.setting')}}" style="color: black" ><i class="fa fa-cog"></i> Setting</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('logout')}}"
                                    class="btn btn-default btn-flat">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>


                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>