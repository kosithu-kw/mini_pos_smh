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
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('sales.report')}}"><i class="fa fa-dashboard"></i> Admin Panel</a></li>
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
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{count($users)-1}}</h3>

                            <p>Employees</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-8 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
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
                    <div class="box box-success">
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



            </div>


        </section>
    </div>
@stop

