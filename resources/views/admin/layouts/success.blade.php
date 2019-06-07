


<div class="row" style="position: fixed; top:110px; right:20px;  font-size: 12px">
    <div class="col-sm-12">

        @if(Session('info'))
            <div class="row">
                <div class="text-center">
                    <div class="tem alert alert-success"><span class="glyphicon glyphicon-ok-circle"></span> {{Session('info')}}</div>
                </div>
            </div>
        @endif
            @if(Session('err'))
                <div class="row">
                    <div class="text-center">
                        <div class="tem alert alert-danger"><span class="fa fa-warning"></span> {{Session('err')}}</div>
                    </div>
                </div>
            @endif
            @if(Session('warning'))
                <div class="row">
                    <div class="text-center">
                        <div class="tem alert alert-warning"><span class="glyphicon glyphicon-ok-circle"></span> {{Session('warning')}}</div>
                    </div>
                </div>
            @endif

@if($errors->has('new_password'))
    <div class="tem alert alert-danger text-center "><i class="fa fa-warning"></i> {{$errors->first('new_password')}}</div>
@endif
@if($errors->has('new_password_again'))
    <div class="tem alert alert-danger text-center"><i class="fa fa-warning"></i> {{$errors->first('new_password_again')}}</div>
@endif

    </div>
</div>
