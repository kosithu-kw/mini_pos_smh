@extends('admin.layouts.master')

@section('title')
    Edit Item
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-edit"></span> Edit Item
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Admin Panel</a></li>
                <li class="active">Edit Item</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                @include('admin.layouts.success')
            </div>

            <div class="col-md-6 col-md-offset-3">
                <form method="post" action="{{route('update.item')}}">
                    <input type="hidden" name="id" value="{{$pd->id}}">
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

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save</button>
                        <a href="{{route('product.all')}}" class="btn btn-default btn-lg"><i class="fa fa-times-circle"></i> Close</a>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>

        </section>



    </div>
@stop

@section('script')

@stop