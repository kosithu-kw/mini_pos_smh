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

                <!--
                <div data-keyboard="static" data-backdrop="false" id="aleModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <i class="fa fa-qrcode"></i> Scan barcode from item or enter ID or Name of product item to sale.
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                            </div>
                            <div class="modal-body">
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
                </div> model close -->
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <i class="fa fa-qrcode"></i> Scan barcode from item or enter ID or Name of product item to sale.

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

            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><i class="fa fa-shopping-cart"></i> Items on Cart</div>
                    <div class="box-body">
                        @if(Session::has('cart'))
                                <table class="table">
                                    <tr style="background: gray; color: #fff">
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Amount</th>

                                    </tr>
                                    @foreach($carts->items as $item)
                                        <tr >
                                            <td>
                                                <a href="{{route('remove.item',['id'=>$item['item']['id']])}}" class="text-danger"><i class="fa fa-times-circle"></i></a>
                                                {{$item['item']['item_name']}}</td>
                                            <td>{{$item['item']['sale_price']}}</td>
                                            <td>
                                                <a href="{{route('decrease.cart',['id'=>$item['item']['id']])}}"><i class="fa fa-minus-circle"></i></a>
                                                {{$item['qty']}}
                                                <a href="{{route('increase.cart',['id'=>$item['item']['id']])}}"><i class="fa fa-plus-circle"></i></a>
                                            </td>
                                            <td>{{$item['amount']}}</td>

                                        </tr>
                                        @endforeach

                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td>{{$carts->totalAmount}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Commercial Tax</td>
                                        <td>{{$carts->totalAmount * 0.05}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Grand Total</td>
                                        <td>{{$carts->totalAmount * 0.05 + $carts->totalAmount}}</td>
                                    </tr>
                                </table>


                            <div class="row">
                                <div class="col-sm-8">
                                    <a data-toggle="tooltip" data-placement="top" title="Cancel sale session." href="{{route('cart.cancel')}}" class="btn btn-danger"><i class="fa fa-times-circle"></i></a>
                                </div>
                               <div class="col-sm-4">
                                   <div class="col-sm-6">
                                       <a data-toggle="tooltip" data-placement="top" title="Checkout Sale"  href="{{route('checkout')}}" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i></a>
                                   </div>
                                   <div class="col-sm-6">
                                       <a id="btnCheckout" data-toggle="tooltip" data-placement="top" title="Checkout sale and print" target="_blank" href="{{route('checkout.print')}}" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <i class="fa fa-print"></i></a>
                                   </div>
                               </div>
                            </div>


                        @else
                            <p class="text-center text-info"><i class="fa fa-shopping-bag"></i> Do your sale first.</p>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </section>



    </div>
@stop
