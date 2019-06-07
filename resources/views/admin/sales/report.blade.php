@extends('admin.layouts.master')

@section('title')
    Report Sales
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-pie-chart"></span> Report Sales                     <a data-toggle="tooltip" data-placement="top" title="Refresh Reports" href="{{route('sales.report')}}" class="btn btn-link"><i class="fa fa-refresh"></i></a>

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-pie-chart"></i> Admin Panel</a></li>
                <li class="active">Report Sales</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                @include('admin.layouts.success')
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <form id="fidForm" method="get" action="{{route('report.id')}}">
                        <label for="f_id" style="font-size: 11px"><i class="fa fa-id-badge"></i> Filter Sale ID</label>
                        <input required type="number" name="f_id" class="form-control" id="f_id">
                    </form>
                </div>
                <div class="col-sm-2">
                  <form id="fdForm" method="get" action="{{route('report.date')}}">
                      <label for="f_d" style="font-size: 11px"><i class="fa fa-calendar"></i> Filter By Date</label>
                      <input type="date" name="f_d" class="form-control" id="f_d">
                  </form>
                </div>
                <div class="col-sm-2">
                    <form id="fmForm" method="get" action="{{route('report.month')}}">
                        <label for="f_m" style="font-size: 11px"><i class="fa fa-calendar"></i> Filter By Month</label>
                        <input type="month" name="f_m" class="form-control" id="f_m">
                    </form>
                </div>
                <div class="col-sm-6">
                    <?php $myTotal=0;
                    foreach ($sales as $s){
                        $myTotal+=$s->totalAmount;
                    }
                    ?>
                    <table class="table table-bordered" style="margin:0; padding: 0;">
                        <tr style="font-size: 11px">
                            <th>Date / Month</th>
                            <th>Total</th>
                            <th>Com Tax (5%)</th>
                            <th>Grand Total</th>
                        </tr>
                        <tr>
                            <td>
                                @if($sale_date !=null){{date('(D) d-m-Y', strtotime($sale_date))}}@endif
                                    @if($sale_month !=null){{date('(M) m-Y', strtotime($sale_month))}}@endif
                            </td>
                            <td><span class="badge">{{$myTotal}}</span></td>
                            <td> <span class="badge">{{$myTotal * 0.05}}</span></td>
                            <td><span class="badge">{{$myTotal * 0.05 + $myTotal}}</span></td>
                        </tr>
                    </table>


                </div>
            </div>
            <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px; margin-bottom: 10px"></div>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($sales) >0)
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($sales as $s)

                        <div class="panel panel-default">
                            <div class="panel-body" role="tab" id="headingTwo">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <a data-toggle="collapse" href="#c{{$s->id}}" data-parent="#accordion" style="display: block; text-align: center">
                                            <i class="fa fa-caret-down"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="fa fa-id-badge"></i> Sale ID : <span class="badge">{{$s->id}}</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="fa fa-user-circle"></i> Cashier : <b>{{$s->user->name}}</b>
                                    </div>
                                    <div class="col-sm-4">
                                        <i class="fa fa-clock-o"></i> Date : <b>{{date('D (d)-m-Y / h:i A', strtotime($s->created_at))}}</b>
                                    </div>
                                    <div class="col-sm-1">
                                        <a style="display: block; text-align: center" target="_blank" data-toggle="tooltip" data-placement="top" title="Print this item."  href="{{route('print',['id'=>$s->id])}}"><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="c{{$s->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <table class="table table-hover table-bordered">
                                                <tr class="text-primary">
                                                    <th>Item Name</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Amount</th>
                                                </tr>
                                                @foreach($s->saleitem as $item)
                                                    <tr class="text-info">
                                                        <td>{{$item->item_name}}</td>
                                                        <td>{{$item->sale_price}}</td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>{{$item->amount}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="text-primary">
                                                    <td class="text-right" colspan="3">Total</td>
                                                    <td>{{$s->totalAmount}}</td>
                                                </tr>
                                                <tr class="text-primary">
                                                    <td class="text-right" colspan="3">Commercial Tax</td>
                                                    <td>{{$s->totalAmount * 0.05}}</td>
                                                </tr>
                                                <tr class="text-primary">
                                                    <td class="text-right" colspan="3">Grand Total</td>
                                                    <td>{{$s->totalAmount * 0.05 + $s->totalAmount}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                        @else
                        <p class="text-center"><i class="fa fa-warning"></i> No sales item found.</p>
                    @endif
            </div>


        </section>



    </div>
@stop

@section('script')

@stop