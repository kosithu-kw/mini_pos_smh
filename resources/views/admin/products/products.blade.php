@extends('admin.layouts.master')

@section('title')
     Products
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-database"></span>  Products
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-database"></i> Admin Panel</a></li>
                <li class="active"> Products</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                @include('admin.layouts.success')
            </div>
            <a data-toggle="tooltip" data-placement="top" title="Add New Item" class="btn btn-link" href="{{route('product.new')}}"><i class="fa fa-plus-circle"></i> New Item </a>
            <button data-toggle="tooltip" data-placement="top" title="Printing Barcode" id="printBarcode" type="button" class="btn btn-link btnPrintBarcode"><i class="fa fa-barcode"></i> Print Barcode</button>
            <a data-toggle="tooltip" data-placement="top" title="Refresh Products Item" href="{{route('product.all')}}" class="btn btn-link"><i class="fa fa-refresh"></i></a>
            <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px; margin-bottom: 10px"></div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <form id="productTableForm" target="_blank" method="get" action="{{route('print.barcode')}}">
                    <table class="table" id="productTable">
                       <thead>
                            <tr style="background: gray; color:#fff">
                                <th><input type="checkbox" id="checkAllItems"></th>
                                <td>Barcode</td>
                                <th>Item Name</th>
                                <th>Buying Price</th>
                                <th>Sale Price</th>
                                <th>Available Qty</th>
                                <th>Actions</th>
                            </tr>

                       </thead>
                        @foreach($pds as $pd)
                            <tr>
                                <td><input type="checkbox" name="id[]" value="{{$pd->id}}"></td>
                                <td>{{$pd->barcode}}</td>
                                <td>{{$pd->item_name}}</td>
                                <td>{{$pd->buying_price}}</td>
                                <td>{{$pd->sale_price}}</td>
                                <td>
                                    <span class="@if($pd->quantity <=5) text-danger  @endif">{{$pd->quantity}}</span>
                                </td>
                                <td>
                                    <a href="{{route('update.old.item',['id'=>$pd->id])}}">
                                        <span data-toggle="tooltip" data-placement="top" title="Update Buying Item"><i class="fa fa-plus-circle"></i></span>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#s{{$pd->id}}">
                                        <span data-toggle="tooltip" data-placement="top" title="Show Item Detail"><i class="fa fa-eye"></i></span>
                                    </a>
                                    <a href="{{route('get.edit.item',['id'=>$pd->id])}}">
                                        <span data-toggle="tooltip" data-placement="top" title="Edit Item"><i class="fa fa-edit"></i></span>
                                    </a>
                                    <a data-toggle="modal" data-target="#d{{$pd->id}}" href="#" class="text-danger">
                                        <span data-toggle="tooltip" data-placement="top" title="Delete Item"><i class="fa fa-trash"></i></span>
                                    </a>

                                    <div id="s{{$pd->id}}" data-keyboard="static" data-backdrop="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Item Name : <b>{{$pd->item_name}}</b>
                                                    <button class="btn btn-link close" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
                                                </div>
                                               <div class="modal-body">
                                                   <div class="panel panel-default">
                                                       <div class="panel-heading"><i class="fa fa-area-chart"></i> Stock Item</div>
                                                       <div class="panel-body">
                                                           <div class="table-responsive">
                                                               <table class="table">
                                                                   <tr>

                                                                       <th>Item Name</th>
                                                                       <th>Buying Price</th>
                                                                       <th>Sale Price</th>
                                                                       <th>Available Qty</th>

                                                                   </tr>
                                                                   <tr>
                                                                       <td>{{$pd->item_name}}</td>
                                                                       <td>{{$pd->buying_price}}</td>
                                                                       <td>{{$pd->sale_price}}</td>
                                                                       <td>{{$pd->quantity}}</td>

                                                                   </tr>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="panel panel-default">
                                                       <div class="panel-heading"><a href="#c{{$pd->id}}" data-toggle="collapse"><i class="fa fa-history"></i> Buying History</a></div>
                                                       <div class="panel-collapse collapse" id="c{{$pd->id}}">
                                                           <div class="table-responsive">
                                                               <table class="table">
                                                                   <tr>
                                                                       <th>Process ID</th>
                                                                       <th>Buying Price</th>
                                                                       <th>Sale Price</th>
                                                                       <th>Qty</th>
                                                                       <th>Data Input</th>
                                                                       <th>Input Date</th>
                                                                       <th>Buying Date</th>
                                                                   </tr>
                                                                    @foreach($pd->buyinghistory as $h)
                                                                       <tr>
                                                                           <td>{{$h->id}}</td>
                                                                           <td>{{$h->buying_price}}</td>
                                                                           <td>{{$h->sale_price}}</td>
                                                                           <td>{{$h->quantity}}</td>
                                                                           <td>{{$h->user->name}}</td>
                                                                           <td>{{date("(D) d-m-Y h:i A", strtotime($h->created_at))}}</td>
                                                                           <td>{{date("(D) d-m-Y", strtotime($h->buying_date))}}</td>
                                                                       </tr>
                                                                        @endforeach
                                                               </table>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="panel panel-default">
                                                       <div class="panel-heading"><a href="#si{{$pd->id}}" data-toggle="collapse"><i class="fa fa-history"></i> Sale History</a></div>
                                                       <div class="panel-collapse collapse" id="si{{$pd->id}}">
                                                           <div class="table-responsive">
                                                               <table class="table">
                                                                   <tr>
                                                                       <th>Process ID</th>
                                                                       <th>Sale ID</th>
                                                                       <th>Sale Price</th>
                                                                       <th>Qty</th>
                                                                       <th>Amount</th>
                                                                       <th>Cashier</th>
                                                                       <th>Sale Date</th>
                                                                   </tr>
                                                                   @foreach($pd->saleitem as $h)
                                                                       <tr>
                                                                           <td>{{$h->id}}</td>
                                                                           <td><a href="{{route('report.sale.id',['id'=>$h->sale_id])}}">{{$h->sale_id}}</a></td>
                                                                           <td>{{$h->sale_price}}</td>
                                                                           <td>{{$h->quantity}}</td>
                                                                           <td>{{$h->amount}}</td>
                                                                           <td>{{$h->user->name}}</td>
                                                                           <td>{{date("(D) d-m-Y h:i A", strtotime($h->created_at))}}</td>

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


                                    <!-- Delete item modal -->
                                    <div id="d{{$pd->id}}" data-keyboard="static" data-backdrop="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"><i class="fa fa-warning"></i> Confirm</div>
                                                <div class="modal-body text-danger">
                                                    <p>
                                                        Are you sure want to remove this item "<b>{{$pd->item_name}}</b>" ?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <a href="{{route('item.remove',['id'=>$pd->id])}}" class="btn btn-primary">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete item modal -->
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    </form>
                </div>
            </div>

        </section>


        <div id="alertModal" data-keyboard="static" data-backdrop="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header text-warning"><i class="fa fa-warning"></i> Warning</div>
                    <div class="modal-body text-warning">
                        <p>
                            You should make check your products first to print.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

