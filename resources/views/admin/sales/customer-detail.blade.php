@extends('admin.layouts.master')

@section('title')
    Customer Detail
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-users"></span> Customer Detail
                <a data-toggle="tooltip" data-placement="top" title="Refresh Customer Detail" href="#" class="btn btn-link"><i class="fa fa-refresh"></i></a>

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-users"></i> Admin Panel</a></li>
                <li class="active">Customer Detail</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.4); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                @include('admin.layouts.success')
            </div>

            <div class="row">
                <div class="col-sm-4">
                   <div class="panel panel-default">
                       <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Name : <strong>{{$c->name}}</strong>
                                </li>
                                <li class="list-group-item">
                                    Phone : <a href="tel:{{$c->phone}}">{{$c->phone}}</a>
                                </li>
                                <li class="list-group-item">
                                    Address : {{$c->address}}
                                </li>
                                <li class="list-group-item">
                                    Member Since : {{date("d (D) m/Y", strtotime($c->created_at))}}
                                </li>
                            </ul>

                            <hr>
                            <form action="{{route('cash.paid')}}" method="post" class="hide">
                                @csrf
                                <div class="form-group">
                                <input type="hidden" name="customer_id" value="{{$c->id}}">
                                    <label for="amount">Enter amount of paid</label>
                                    <input type="number" name="amount" id="amount" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Paid</button>
                                </div>
                            </form>

                            <a href="{{route('customers')}}" class="btn btn-default  btn-block">  Back</a>
                       </div>
                   </div>
                </div>
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table">
                                <tr class="bg-warning">
                                    <td>Total Amount (Ks)</td>
                                    <td>
                                        {{$c->credits->sum('total_amount')}}
                                    </td>
                                </tr>
                                <tr class="bg-success">
                                    <td>Paid (Ks)</td>
                                    <td>{{$c->credits->sum('paid_cash')}}</td>
                                </tr>
                                <tr class="bg-success">
                                    <td>Discount (Ks)</td>
                                    <td>{{$c->credits->sum('discount')}}</td>
                                </tr>
                                <tr class="bg-danger">
                                    <td>Credit (Ks)</td>
                                    <td>
                                        @php
                                            $total_amount=$credits->sum('total_amount');
                                            $credit_amount=$credits->sum('credit_amount');
                                            $paid_cash=$credits->sum('paid_cash');
                                            $discount=$credits->sum('discount');
                                        @endphp
                                        @if(($total_amount)-($paid_cash + $discount) > 0)
                                                @php echo ($total_amount)-($paid_cash + $discount) @endphp
                                            @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Credit history</h4>
                                    <div class="table-responsive">
                                        <table class="table" id="credit_table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sale ID</th>
                                                <th>Date</th>
                                                <th>Total Amount</th>
                                                <th>Paid</td>
                                                <th>Discount</th>
                                                <th>Credit</th>
                                            </tr>
                                        </thead>
                                            @php $total=0; @endphp
                                            @foreach($credits as $credit)
                                                @php $total += $credit->amount @endphp
                                                <tr>
                                                    <td>{{$credit->id}}</td>
                                                    <td><a href="{{route('report.sale.id',['id'=>$credit->sale_id])}}">{{$credit->sale_id}}</a></td>
                                                    <td>{{date("d-m-Y", strtotime($credit->created_at))}}</td>
                                                    <td>{{$credit->total_amount}}</td>
                                                    <td>{{$credit->paid_cash}}</td>
                                                    <td>{{$credit->discount}}</td>
                                                    <td>{{$credit->credit_amount}}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </table>
                                    </div>

                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
           
        </section>



    </div>
@stop