@extends('admin.layouts.master')

@section('title')
    Customers
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-users"></span> Customers
                <a data-toggle="tooltip" data-placement="top" title="Refresh Sales" href="{{route('customers')}}" class="btn btn-link"><i class="fa fa-refresh"></i></a>

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-users"></i> Admin Panel</a></li>
                <li class="active">Customers</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.4); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                @include('admin.layouts.success')
            </div>

            <div class="row">
                <div class="col-sm-8">
                    <table class="table"  id="customers">
                        <thead>
                            <tr style="background: gray; color:#fff">
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cus as $c)
                               <tr>
                                   <td>{{$c->name}}</td>
                                   <td>{{$c->phone}}</td>
                                   <td>{{$c->address}}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#e{{$c->id}}">
                                            <span data-toggle="tooltip" data-placement="top" title="Edit Customer"><i class="fa fa-edit"></i></span>
                                        </a>
                                        <a data-toggle="modal" data-target="#d{{$c->id}}" href="#" class="text-danger">
                                            <span data-toggle="tooltip" data-placement="top" title="Delete Customer"><i class="fa fa-trash"></i></span>
                                        </a>

                                         <!-- Edit Customer modal -->
                                    <div id="e{{$c->id}}" data-keyboard="static" data-backdrop="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <form method="post" action="{{route('customer.update')}}">
                                                    <input type="hidden" name="id" value={{$c->id}}>
                                                <div class="modal-header"><i class="fa fa-edit"></i> Edit Customer</div>
                                                <div class="modal-body">
                                                    <div class="form-group @if($errors->has('name')) has-error @endif">
                                                        <label for="name">Name</label>
                                                        <input type="text" value="{{$c->name}}" id="name" name="name" required class="form-control">
                                                        @if($errors->has('name')) <span class="help-block">{{$errors->first('name')}}</span> @endif
                    
                                                    </div>
                                                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                                                        <label for="phone">Phone</label>
                                                        <input type="tel" value="{{$c->phone}}" id="phone" name="phone" required class="form-control">
                                                        @if($errors->has('phone')) <span class="help-block">{{$errors->first('phone')}}</span> @endif
                    
                                                    </div>
                                                    <div class="form-group @if($errors->has('address')) has-error @endif">
                                                        <label for="address">Address</label>
                                                        <textarea name="address" required id="address"  class="form-control">{{$c->address}}</textarea>
                                                        @if($errors->has('address')) <span class="help-block">{{$errors->first('address')}}</span> @endif
                    
                                                    </div>
                                                   
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                                </div>
                                                @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit customer modal -->
                                         <!-- Delete Customer modal -->
                                    <div id="d{{$c->id}}" data-keyboard="static" data-backdrop="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"><i class="fa fa-warning"></i> Confirm</div>
                                                <div class="modal-body text-danger">
                                                    <p>
                                                        Are you sure want to remove this customer "<b>{{$c->name}}</b>" ?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <a href="{{route('customer.delete',['id'=>$c->id])}}" class="btn btn-primary">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete item modal -->
                                    </td>
                               </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <i class="fa fa-plus-circle"></i>  Add customer
                        </div>
                        <div class="panel-body">
                            <form action="{{route("customer.add")}}" method="post">
                                <div class="form-group @if($errors->has('name')) has-error @endif">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" required class="form-control">
                                    @if($errors->has('name')) <span class="help-block">{{$errors->first('name')}}</span> @endif

                                </div>
                                <div class="form-group @if($errors->has('phone')) has-error @endif">
                                    <label for="phone">Phone</label>
                                    <input type="tel" id="phone" name="phone" required class="form-control">
                                    @if($errors->has('phone')) <span class="help-block">{{$errors->first('phone')}}</span> @endif

                                </div>
                                <div class="form-group @if($errors->has('address')) has-error @endif">
                                    <label for="address">Address</label>
                                    <textarea name="address" required id="address"  class="form-control"></textarea>
                                    @if($errors->has('address')) <span class="help-block">{{$errors->first('address')}}</span> @endif

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">Save</button>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

           
        </section>



    </div>
@stop
