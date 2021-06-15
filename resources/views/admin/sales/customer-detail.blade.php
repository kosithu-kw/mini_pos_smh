@extends('admin.layouts.master')

@section('title')
    Customer Detail
@stop

@section('style')

@stop

@section('content')

        @php
        $total_amount=$credits->sum('total_amount');
        $credit_amount=$credits->sum('credit_amount');
        $paid_cash=$credits->sum('paid_cash');
        $discount=$credits->sum('discount');
        $re_paid=$credits->sum('re_paid');
           
            $totalCredit=($total_amount)-($paid_cash + $discount + $re_paid);

            $totalPaid=0;
            foreach($paids as $tPaid){
                if(!$tPaid->ready_use){
                    $totalPaid += $tPaid->amount;
                }
            }
        @endphp   


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
                <div class="col-sm-3">
                    <a href="{{route('customers')}}" class="btn btn-default  btn-block">  Back</a>
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
                            <form action="{{route('cash.paid')}}" method="post">
                                @csrf
                                <div class="form-group">
                                <input type="hidden" name="customer_id" value="{{$c->id}}">
                                    <label for="amount">Enter amount of paid</label>
                                    <input @if($totalCredit - $totalPaid <= 0) disabled @endif type="number" name="amount" id="amount" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit"  @if($totalCredit - $totalPaid <= 0) disabled @endif class="btn btn-primary btn-block">Paid</button>
                                </div>
                            </form>

                            
                       </div>
                   </div>
                </div>
                <div class="col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table">
                                
                                <tr class="bg-danger">
                                    <td>က်န္ေငြ</td>
                                    <td>
                                      
                                            {{$totalCredit}}
                                       
                                    </td>
                                </tr>
                                <tr class="bg-success">
                                    <td>ျပန္ဆပ္ေငြ</td>
                                    <td>
                                       
                                            {{$totalPaid}}
                                      
                                    </td>
                                </tr>
                                <tr class="bg-info">
                                    <td>စုစုေပါင္းက်န္ေငြ</td>
                                    <td>
                                      
                                            {{$totalCredit - $totalPaid}}
                                      
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5" style="border-right: 1px solid">
                                    <h4>Repaid History</h4>
                                    <div class="table-responsive">
                                        <table class="table" id="repaid_table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Recipient </th>
                                                <th>Use</th>                                                
                                            </tr>
                                        </thead>
                                            @php $total=0; @endphp
                                            @foreach($paids as $p)
                                                <tr class="@if(!$p->ready_use) text-primary @endif">
                                                    <td>{{$p->id}}</td>
                                                    <td>{{date("d-m-Y", strtotime($p->created_at))}}</td>
                                                    <td>{{$p->amount}}</td>
                                                    <td>{{$p->user->name}}</td>
                                                    <td>@if($p->ready_use) Yes @else <span class="badge"> No </span> @endif</td>
                                                    
                                                </tr>
                                            @endforeach
                                            
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <h4>Credit history</h4>
                                    <div class="table-responsive">
                                        <table class="table" id="credit_table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Sale ID</th>
                                                <th>Date</th>
                                                <td>Total Amount</td>
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
