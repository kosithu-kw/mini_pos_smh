@extends('admin.layouts.master')

@section('title')
    Sale
@stop

@section('style')

@stop

@section('content')

    @php
        $total=0;
        $paidAmount=0;
        $discount=0;
        $newCredit=0;
        if(Session::has('cart')){
            $carts=Session::get('cart');
            $items=$carts->items;
            foreach($items as $i){
                $total += round($i['item_amount']);
            }
        }
        if(Session::has('paid_cash')){
            $paidAmount=Session::get('paid_cash');
        }
        if(Session::has('discount')){
            $discount=Session::get('discount');
        }
        
        $oldCredit=($cusOldCredit->sum('total_amount') - ($cusOldCredit->sum('paid_cash') + $cusOldCredit->sum('discount')));
        $grandTotal=$oldCredit + $total;
        if(Session::has('paid_cash') && Session::has('discount') && Session::has('cart')){
            $newCredit= ($grandTotal - $paidAmount) - $discount;
            Session::put('new_credit', $newCredit);
        }
        
        
        
        
    @endphp

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
                    <div class="box-body table-responsive">
                        @if(Session::has('cart'))
                                <table class="table">
                                    <tr style="border-top: dashed rgba(100,100,100,0.2); border-bottom: dashed rgba(100,100,100,0.2);">
                                        <th class="bg-warning">Item Name</th>                                        
                                        <th class="bg-warning">Price (Ks)</th>
                                        <th class="bg-warning">Qty</th>                                        
                                        <th class="bg-warning">Amount (Ks)</th>
                                        <th class="bg-success">Total (Ks)</td>

                                    </tr>
                                    @foreach($carts->items as $item)
                                        <tr >
                                            <td class="bg-warning">
                                                <a href="{{route('remove.item',['id'=>$item['item']['id']])}}" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i></a>
                                                {{$item['item']['item_name']}}
                                            </td>
                                            <td class="bg-info"> 
                                                @if(Session::get('ready_sale')=="normal")
    
                                                        @php echo round($item['item']['sale_price']) @endphp
    
                                                        @elseif(Session::get('ready_sale')=="level_1")
    
                                                        @php echo round($item['item']['sale_price_1'] ) @endphp
    
                                                        @else
    
                                                        @php echo round($item['item']['sale_price_2'] ) @endphp
    
                                                        @endif
                                                </td>
                                           
                                           
                                            <td class="bg-warning">
                                                <form action="{{route('sale.qty.action')}}" method="get" id="sale_qty_form">
                                                    <div class="form-group">
                                                        <input type="hidden" name="item_id" value="{{$item['item']['id']}}">
                                                        <input type="number" name="sale_qty" value="{{$item['item_qty']}}" class="form-control">
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="bg-warning"> @php echo round($item['item_amount']) @endphp</td>
                                            <td class="bg-success">@php echo round($item['item_amount']) @endphp</td>

                                        </tr>
                                        @endforeach
                                    <tfoot style="border-top: dashed rgba(100,100,100,0.2); border-bottom: dashed rgba(100,100,100,0.2);">

 
                                    <tr class="bg-primary">
                                        <td colspan="4" class="text-right">Total  :</td>
                                        <td>
                                            @if($total > 0)
                                                {{$total}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="bg-warning">
                                        <td colspan="2"></td>
                                        <td>
                                            <div>
                                                <form method="post" action="{{route("change.customer")}}">
                                                    <div class="input-group">
                                                        <input list="cus" placeholder="Search customer name" required name="customer" type="text" class="form-control">
                                                        <datalist id="cus">
                                                            @foreach($cus as $c)
                                                                <option>{{$c->name}}</option>
                                                            @endforeach
                                                        </datalist>
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary">Link</button>
                                                        </span>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>
                                        </td>
                                       
                                        <td class="text-right">Customer :</td>
                                        <td>
                                            <div>
                                                <div>
                                                    @if(Session::has('customer')) {{Session::get('customer')}} @endif

                                                </div>
                                                
                                            </div>                                       
                                            
                                        </td>
                                    </tr>
                                    <tr class="bg-success">
                                        <td class="text-right" colspan="4">Old Credit :</td>
                                        <td>
                                            <div>
                                                <div>
                                                    @if($oldCredit > 0)
                                                        {{$oldCredit}}
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        
                                            
                                        </td>
                                    </tr>
                                    <tr class="bg-warning">
                                        <td class="text-right" colspan="4">Grand total :</td>
                                        <td>
                                            <div>
                                                <div>
                                                   @if($grandTotal > 0)
                                                        {{$grandTotal}}
                                                   @endif
                                                </div>
                                                
                                            </div>
                                        
                                            
                                        </td>
                                    </tr>
                                    <tr class="bg-info">
                                        <td colspan="2"></td>
                                        <td>
                                            <div>
                                                <form method="post" action="{{route('paid.cash')}}">
                                                    <div class="input-group">
                                                        <input  @if(Session::has('paid_cash')) required placeholder="Enter paid amount"  @endif  name="paid_cash" type="number" class="form-control">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary">Paid</button>
                                                        </span>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-right"> Cash  :</td>
                                        <td>
                                                <div>
                                                    <div>
                                                       
                                                            @if($paidAmount>0)
                                                                {{$paidAmount}}
                                                            @endif
                                                      
                                                    </div>
                                                    
                                                </div>
                                                
                                        </td>
                                    </tr>
                                    <tr class="bg-success">
                                        <td colspan="2"></td>
                                        <td>
                                            <div>
                                                <form method="post" action="{{route('discount.cash')}}">
                                                    <div class="input-group">
                                                        <input  @if(Session::has('discount')) required placeholder="Enter discount amount"  @endif  name="discount_cash" type="number" class="form-control" @if($paidAmount >= $grandTotal) disabled @endif>
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                        </span>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-right"> Discount  :</td>
                                        <td>
                                                <div>
                                                    <div>
                                                        
                                                            @if($discount > 0)
                                                                {{$discount}}
                                                            @endif
                                                       
                                                    </div>
                                                    
                                                </div>
                                                
                                        </td>
                                    </tr>

                                    <tr class="bg-danger">
                                        <td>

                                        </td>
                                        <td class="text-right" colspan="3"> Credit :</td>
                                        <td>
                                            <div>
                                                <div>
                                                        @if($newCredit > 0)
                                                            {{$newCredit}}
                                                        @endif
                                                </div>
                                                
                                            </div>
                                        
                                            
                                        </td>
                                    </tr>
                                   </tfoot>
                                </table>


                            <div class="row" style="margin-top: 20px">
                                <div class="col-sm-8">
                                    <a data-toggle="tooltip" data-placement="top" title="Cancel sale session." href="{{route('cart.cancel')}}" class="btn btn-danger"><i class="fa fa-times-circle"></i></a>
                                </div>
                                @php
                                    $cus=Session::get('customer');
                                    
                                @endphp
                              @if(Session::has('paid_cash') && Session::has('customer'))                                   
                                        @if(Session::get('total') > 0)

                                            @if($cus == "default_customer")

                                               @if($newCredit <= 0)
                                                <div class="col-sm-4">
                                                    <div class="col-sm-6">
                                                        <a data-toggle="tooltip" data-placement="top" title="Checkout Sale"  href="{{route('checkout')}}" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i></a>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a data-toggle="tooltip" data-placement="top" title="Checkout sale and print"  href="{{route('checkout.print')}}" class="btn btn-primary pull-right"> <i class="fa fa-print"></i></a>
                                                    </div>
                                                </div>
                                               @endif

                                            @else
                                                <div class="col-sm-4">
                                                    <div class="col-sm-6">
                                                        <a data-toggle="tooltip" data-placement="top" title="Checkout Sale"  href="{{route('checkout')}}" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i></a>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a data-toggle="tooltip" data-placement="top" title="Checkout sale and print"  href="{{route('checkout.print')}}" class="btn btn-primary pull-right"> <i class="fa fa-print"></i></a>
                                                    </div>
                                                </div>
                                            @endif

                                        @endif
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