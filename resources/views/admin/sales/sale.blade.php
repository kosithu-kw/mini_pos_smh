@extends('admin.layouts.master')

@section('title')
    Sale
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-shopping-bag"></span> Sale
                <a data-toggle="tooltip" data-placement="top" title="Refresh Sales" href="{{route('sale')}}" class="btn btn-link"><i class="fa fa-refresh"></i></a>

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> Admin Panel</a></li>
                <li class="active">Sale</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.4); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                @include('admin.layouts.success')
            </div>

            <div>
                @if(Session::has('ready_sale'))
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="alert alert-info">
                                Customer : <b>@if(Session::get('ready_sale')=="normal") Normal @elseif(Session::get('ready_sale')=="level_1") Level 1 @else Level 2 @endif</b>
                                <a href="{{route("cancel_sale_to")}}" class="pull-right"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                @else
                  <div class="row">                
                      <div class="col-md-4 col-md-offset-4">
                           <form method="post" action={{route("sale_to")}}>
                            @csrf
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select name="sale_to" class="form-control">
                                        <option value="normal">Normal</option>    
                                        <option value="level_1">Level 1</option>
                                        <option value="level_2">Level 2</option>
                                    </select>    
                                </div>   
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Start Sale</button>
                                </div>
                            
                            </form> 
                      </div>
                </div> 
                @endif
            </div>
          

            @if(Session::has("ready_sale"))
            <div>              


            <div class="col-md-6 hidden-xs hidden-sm">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <i class="fa fa-qrcode"></i> Scan barcode from item to sale.

                    </div>
                    <div class="box-body">
                        <form id="saleForm" method="post" action="{{route('add.cart')}}">
                            <div class="form-group">

                                <input list="pds"  autofocus type="search" name="sale_item" id="sale_item" class="form-control">
                                <datalist id="pds">
                                    @foreach($pds as $pd)
                                        <option value="{{$pd->barcode}}">{{$pd->item_name}}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>

            </div>

                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <i class="fa fa-product-hunt"></i> Enter item name to sale.

                        </div>
                        <div class="box-body">
                            <form id="saleForm2" method="post" action="{{route('add.cart2')}}">

                                        <div class="form-group">
                                            <div class="input-group">

                                            <input list="pds2" required type="search" name="sale_item2" id="sale_item2" class="form-control">
                                            <datalist id="pds2">
                                                @foreach($pds as $pd)
                                                    <option value="{{$pd->item_name}}">{{$pd->item_name}}</option>
                                                @endforeach
                                            </datalist>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary">Add Sale</button>
                                                </span>
                                            </div>
                                        </div>

                                {{csrf_field()}}
                            </form>
                        </div>
                    </div>

                </div>

            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><i class="fa fa-shopping-cart"></i> Items on Cart</div>
                    <div class="box-body">
                        @if(Session::has('cart'))
                                <table class="table">
                                    <tr style="border-top: dashed rgba(100,100,100,0.2); border-bottom: dashed rgba(100,100,100,0.2);">
                                        <th>Item Name</th>
                                        <th>Price (Ks)</th>
                                        <th>Qty</th>
                                        <th>Amount (Ks)</th>

                                    </tr>
                                    @foreach($carts->items as $item)
                                        <tr >
                                            <td>
                                                <a href="{{route('remove.item',['id'=>$item['item']['id']])}}" class="text-danger"><i class="fa fa-times-circle"></i></a>
                                                {{$item['item']['item_name']}}</td>
                                            <td> {{$item['item']['sale_price']}}</td>
                                            <td>
                                                <a href="{{route('decrease.cart',['id'=>$item['item']['id']])}}"><i class="fa fa-minus-circle"></i></a>
                                                {{$item['qty']}}
                                                <a href="{{route('increase.cart',['id'=>$item['item']['id']])}}"><i class="fa fa-plus-circle"></i></a>
                                            </td>
                                            <td> {{$item['amount']}}</td>

                                        </tr>
                                        @endforeach
                                    <tfoot style="border-top: dashed rgba(100,100,100,0.2); border-bottom: dashed rgba(100,100,100,0.2);">


                                    <tr>
                                        <td colspan="3" class="text-right">Total (Ks) :</td>
                                        <td> {{$carts->totalAmount}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"> Cash (Ks) :</td>
                                        <td><form method="post" action="{{route('paid.cash')}}">
                                                <div class="input-group">
                                                    <input  @if(Session::has('paid_cash')) value="{{Session::get('paid_cash')}}" @endif  name="paid_cash" type="number" class="form-control">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary">Paid</button>
                                                    </span>
                                                </div>
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="3">Changed (Ks) :</td>
                                        <td>
                                             @if(Session::has('paid_cash')) 
                                                @if((Session::get('paid_cash') - $carts->totalAmount) > 0)
                                                    {{Session::get('paid_cash') - $carts->totalAmount }}
                                                @endif
                                            
                                             @endif
                                            </td>
                                    </tr>

                                    <tr>
                                        <td class="text-right" colspan="3">Credit (Ks) :</td>
                                        <td>
                                             @if(Session::has('paid_cash'))
                                                @if((Session::get('paid_cash') - $carts->totalAmount) < 0)
                                                    @php echo abs(Session::get('paid_cash') - $carts->totalAmount) @endphp
                                                @endif
                                             @endif
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="3">Customer :</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    @if(Session::has('customer')) {{Session::get('customer')}} @endif

                                                </div>
                                                <div class="col-sm-5">
                                                    <form method="post" action="{{route("change.customer")}}">
                                                        <div class="input-group">
                                                            <input list="cus"  name="customer" type="text" class="form-control">
                                                            <datalist id="cus">
                                                                @foreach($cus as $c)
                                                                    <option>{{$c->name}}</option>
                                                                @endforeach
                                                            </datalist>
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-primary">Add</button>
                                                            </span>
                                                        </div>
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        
                                            
                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>


                            <div class="row" style="margin-top: 20px">
                                <div class="col-sm-8">
                                    <a data-toggle="tooltip" data-placement="top" title="Cancel sale session." href="{{route('cart.cancel')}}" class="text-danger"><i class="fa fa-times-circle"></i></a>
                                </div>
                              @if(Session::has('paid_cash') && Session::has('customer'))
                                    <div class="col-sm-4">
                                        <div class="col-sm-6">
                                            <a data-toggle="tooltip" data-placement="top" title="Checkout Sale"  href="{{route('checkout')}}" class="btn btn-link pull-right"><i class="fa fa-check-circle"></i></a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a data-toggle="tooltip" data-placement="top" title="Checkout sale and print"  href="{{route('checkout.print')}}" class="btn btn-link pull-right"> <i class="fa fa-print"></i></a>
                                        </div>
                                    </div>
                                  @endif
                            </div>


                        @else
                            <p class="text-center text-info"><i class="fa fa-shopping-bag"></i> Do your sale first.</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            </div>
        </section>



    </div>
@stop
