@extends('admin.layouts.master')

@section('title')
    Users
@stop

@section('style')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <span class="fa fa-users"></span> Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-users"></i> Admin Panel</a></li>
                <li class="active">Users</li>
            </ol>
        </section>
        <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px "></div>

        <!-- Main content -->
        <section class="content" style=" padding-bottom: 100%;">
            <div>
                <a data-toggle="tooltip" data-placement="top" title="Add New User" href="{{route('user.new')}}" class="btn btn-link"><i class="fa fa-plus-circle"></i> Add User</a>
            </div>
            <div style="border: 1px solid rgba(100, 100, 100, 0.1); margin-top: 10px; margin-bottom: 10px"></div>


            <div>
                @include('admin.layouts.success')
            </div>


            <div class="table-responsive">
            <table class="table table-hover" id="user_table">
                <thead>
                <tr style="background: grey ;color:#fff; font-weight: bold">
                    <td>ID</td>
                    <td>Username</td>
                    <td>Full Name</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Member Since</td>
                    <td>Actions</td>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tr >
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->full_name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="text-primary">
                               {{$user->roles->first()->name}}
                        </td>
                        <td>{{date("d-M-Y", strtotime($user->created_at))}}</td>
                        <td>
                            <a  href="#" data-toggle="modal" data-target="#e{{$user->id}}" class="text-primary">
                                <span data-toggle="tooltip" data-placement="top" title="Update User Account"><i class="fa fa-edit"></i></span>
                            </a>

                            <!-- Edit Modal -->
                            <div data-keyboard="static" data-backdrop="false" class="modal fade" id="e{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('user.update')}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Edit user account info for <b>"{{$user->full_name}}"</b></h4>
                                            </div>
                                            <div class="modal-body text-left">
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <div class="form-group has-feedback @if($errors->has('full_name')) has-error @endif">
                                                    <label for="full_name" class="control-label">Full Name</label>
                                                    <input value="{{$user->full_name}}" type="text" name="full_name" id="full_name" class="form-control">
                                                    <span class="glyphicon glyphicon-book form-control-feedback"></span>
                                                    @if($errors->has('full_name')) <span class="help-block">{{$errors->first('full_name')}}</span> @endif
                                                </div>
                                                <div class="form-group has-feedback @if($errors->has('name')) has-error @endif">
                                                    <label for="name" class="control-label">Username</label>
                                                    <input value="{{$user->name}}" type="text" name="name" id="name" class="form-control">
                                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                    @if($errors->has('name')) <span class="help-block">{{$errors->first('name')}}</span> @endif
                                                </div>
                                                <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
                                                    <label for="email" class="control-label">Email Address</label>
                                                    <input value="{{$user->email}}" type="email" name="email" id="email" class="form-control">
                                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                                    @if($errors->has('email')) <span class="help-block">{{$errors->first('email')}}</span> @endif
                                                </div>
                                                <div class="form-group has-feedback @if($errors->has('role')) has-error @endif">
                                                    <label for="role" class="control-label">Roles</label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option value="">Select Role</option>
                                                        @foreach($roles as $role)
                                                            <option @if($user->roles->first()->id == $role->id) selected  @endif>{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="fa fa-user-md form-control-feedback"></span>
                                                    @if($errors->has('role')) <span class="help-block">{{$errors->first('role')}}</span> @endif
                                                </div>
                                                <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
                                                    <label for="password" class="control-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                    @if($errors->has('password')) <span class="help-block">{{$errors->first('password')}}</span> @endif
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                            </div>

                                        </div>
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>



                            <a href="#" data-toggle="modal" data-target="#d{{$user->id}}" class="text-danger">
                                <span data-toggle="tooltip" data-placement="top" title="Delete User Account"><i class="fa fa-trash"></i></span>
                            </a>
                            <!-- Delete Modal -->
                            <div data-keyboard="static" data-backdrop="false" class="modal fade" id="d{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('user.delete')}}">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> confirm delete user account</h4>
                                        </div>
                                        <div class="modal-body text-danger">
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            Are you sure want to delete this user account name of <b>"{{$user->full_name}}"</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </div>

                                    </div>
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </table>
            </div>

        </section>

    </div>
@stop

