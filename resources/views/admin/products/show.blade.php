@extends('admin.layouts.master')

@section('title')
    Stock Item
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-database"></span>  Stock Item
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-database"></i> Admin Panel</a></li>
                <li class="active"> Stock Item</li>
            </ol>
        </section>
        <div style="border: 1px solid; margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                @include('admin.layouts.success')
            </div>
            <a class="btn btn-primary" href="{{route('product.new')}}"><i class="fa fa-plus-circle"></i> New Item </a>
            <button id="printBarcode" type="button" class="btn btn-primary btnPrintBarcode"><i class="fa fa-barcode"></i> Print Barcode</button>
            <div style="border: 1px solid; margin-top: 10px; margin-bottom: 10px"></div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <form id="productTableForm" target="_blank" method="get" action="{{route('print.barcode')}}">
                        <table class="table">
                            <thead>
                            <tr style="background: gray; color:#fff">
                                <th><input type="checkbox" id="checkAllItems"></th>
                                <th>Item Name</th>
                                <th>Buying Price</th>
                                <th>Sale Price</th>
                                <th>Available Qty</th>

                                <th>Data Input</th>
                                <th>Input Date</th>
                                <th>Actions</th>
                            </tr>

                            </thead>

                                <tr style="font-size: 12px">
                                    <td><input type="checkbox" name="id[]" value="{{$pd->id}}"></td>
                                    <td>{{$pd->item_name}}</td>
                                    <td>{{$pd->buying_price}}</td>
                                    <td>{{$pd->sale_price}}</td>
                                    <td>{{$pd->quantity}}</td>

                                    <td>{{$pd->user->name}}</td>
                                    <td>{{date("(D) d-m-Y h:i A", strtotime($pd->created_at))}}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#s{{$pd->id}}"><i class="fa fa-eye"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#e{{$pd->id}}"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="modal" data-target="#d{{$pd->id}}" href="#" class="text-danger"><i class="fa fa-trash"></i></a>

                                        <!-- Delete item modal -->
                                        <div id="d{{$pd->id}}" data-keyboard="static" data-backdrop="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header"><i class="fa fa-warning"></i> Confirm</div>
                                                    <div class="modal-body text-warning">
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


                                        <!-- Edit item Modal -->
                                        <div data-keyboard="static" data-backdrop="false"  class="modal fade" id="e{{$pd->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form>
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Update Product Item</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_type" class="control-label">Edit For</label>
                                                                <div>
                                                                    <input type="radio" name="edit_type" value="buying_item"> Buying Item /
                                                                    <input type="radio" name="edit_type" value="edit_item" checked> Edit Item
                                                                </div>


                                                            </div>
                                                            <div class="form-group @if($errors->has('item_name')) has-error @endif ">
                                                                <label for="item_name">Item Name</label>
                                                                <input  type="text" name="item_name" id="item_name" class="form-control" value="{{$pd->item_name}}">
                                                                @if($errors->has('item_name')) <span class="help-block">{{$errors->first('item_name')}}</span> @endif
                                                            </div>
                                                            <div class="form-group @if($errors->has('buying_price')) has-error @endif ">
                                                                <label for="buying_price">Buying Price</label>
                                                                <input type="number" name="buying_price" id="buying_price" class="form-control" value="{{$pd->buying_price}}">
                                                                @if($errors->has('buying_price')) <span class="help-block">{{$errors->first('buying_price')}}</span> @endif
                                                            </div>
                                                            <div class="form-group @if($errors->has('sale_price')) has-error @endif ">
                                                                <label for="sale_price">Sale Price</label>
                                                                <input type="number" name="sale_price" id="sale_price" class="form-control" value="{{$pd->sale_price}}">
                                                                @if($errors->has('sale_price')) <span class="help-block">{{$errors->first('sale_price')}}</span> @endif
                                                            </div>
                                                            <div class="form-group @if($errors->has('quantity')) has-error @endif ">
                                                                <label for="quantity">Quantity</label>
                                                                <input type="number" name="quantity" id="quantity" class="form-control" value="{{$pd->quantity}}">
                                                                @if($errors->has('quantity')) <span class="help-block">{{$errors->first('quantity')}}</span> @endif
                                                            </div>
                                                            <div class="form-group @if($errors->has('buying_date')) has-error @endif ">
                                                                <label for="buying_date">Buying Date</label>
                                                                <input type="date" name="buying_date" id="buying_date" class="form-control">
                                                                @if($errors->has('buying_date')) <span class="help-block">{{$errors->first('buying_date')}}</span> @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                    {{csrf_field()}}
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Edit item Modal -->
                                    </td>
                                </tr>

                        </table>
                    </form>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-history"></i> Buying History</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Buying Price</th>
                                    <th>Sale Price</th>
                                    <th>Qty</th>
                                    <th>Data Input</th>
                                    <th>Input Date</th>
                                    <th>Buying Date</th>
                                </tr>
                                @foreach($his as $h)
                                    <tr>
                                        <td>{{$h->item_name}}</td>
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

@section('script')

@stop