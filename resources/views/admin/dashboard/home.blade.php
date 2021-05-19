@extends('admin.layouts.master')

@section('title')
    Dashboard
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-dashboard"></span> Dashboard
                <a data-toggle="tooltip" data-placement="top" title="Refresh Dashboard" href="{{route('dashboard')}}" class="btn btn-link"><i class="fa fa-refresh"></i></a>

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin Panel</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">


            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-8 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Sale</h3>
                            <p>Cashier</p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <a href="{{route('sale')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{count($sales)}} <sup style="font-size: 20px">sales items </sup></h3>
                            <p>Today Report</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('sales.report')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{count($users)}}</h3>

                            <p>Employees</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue-gradient">
                        <div class="inner">
                            <h3>{{count($items)}} <sup style="font-size: 20px">items </sup></h3>

                            <p>Product Items</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-database"></i>
                        </div>
                        <a href="{{route('product.all')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-sm-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{count($cus)}}</h3>

                            <p>Customers</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('customers')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->


                    <div class="col-sm-6">
                        <!-- BAR CHART -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sales Graph</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="barChart" style="height:230px"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                <div class="col-sm-6">
                    <!-- BAR CHART -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Buying Graph</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="areaChart" style="height:230px"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                @if( (Auth::User()->hasRole('Admin')) || (Auth::User()->hasRole('Manager')))
                <div class="col-sm-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Users Login Status.</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    @foreach($users as $u)
                                        @if($u->roles()->first()->name != "Admin")
                                        <div class="panel panel-default">
                                            <div class="panel-body" role="tab" id="headingTwo">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <a data-toggle="collapse" href="#c{{$u->id}}" data-parent="#accordion" style="display: block; text-align: center">
                                                            <i class="fa fa-caret-down"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-id-badge"></i> Username : <span>{{$u->name}}</span>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fa fa-envelope"></i> Email : <b>{{$u->email}}</b>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <i class="fa fa-clock-o"></i> Role : <b>{{$u->roles->first()->name}}</b>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="c{{$u->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-10 col-sm-offset-1">
                                                            <table class="table table-hover table-bordered">
                                                                <tr class="text-primary">
                                                                    <th>Login / Logout</th>
                                                                    <th>Date / Time</th>
                                                                </tr>
                                                                @foreach($u->userlogin as $login)
                                                                    <tr class="text-info">
                                                                        <td>{{$login->user_state}}</td>
                                                                        <td>{{date('(D) d-m-Y h:i A', strtotime($login->created_at))}}</td>

                                                                    </tr>
                                                                @endforeach

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

                @endif

            </div>


        </section>
    </div>
@stop

