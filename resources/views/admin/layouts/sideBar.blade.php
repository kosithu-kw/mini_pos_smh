<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <span class="fa fa-user-circle fa-2x" style="color: #ffffff;"></span>
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->full_name}}</p>
                <i class="fa fa-circle text-success"></i> Online
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @if(Auth::user()->hasRole('Admin') || Auth::User()->hasRole('Manager'))
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @endif

            <li><a href="{{route('sale')}}"><i class="fa fa-shopping-bag"></i>  <span>Sale</span> </a></li>

            <li><a href="{{route('product.all')}}"><i class="fa fa-database"></i>  <span>Products</span> </a></li>

            @if((Auth::User()->hasRole('Admin')) || (Auth::User()->hasRole('Manager')))
            <li><a href="{{route('sales.report')}}"><i class="fa fa-pie-chart"></i>  <span>Reports</span> </a></li>
            @endif

            @if(Auth::User()->hasRole('Admin'))
            <li><a href="{{route('users')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
            @endif

            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
