<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcode</title>
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">

</head>
<body>

<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-2 offset-5">
            <button type="button" class="btn btn-primary btn-block" id="btnPrintBarcode"><i class="fa fa-print"></i> Print</button>

        </div>
    </div>
</div>

<div class="container-fluid mt-5" id="barcodePage">
    <div class="row">
       @foreach($pds as $pd)
           @for($i=0; $i<$barcode_item; $i++)
           <div class="col-sm-3">
               <div class="thumbnail" style="padding: 5px">
                    <div class="text-center" style="font-size: 11px">{{$pd->item_name}}</div>
                    <div class="text-center"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($pd->barcode, 'C93')}}" alt="barcode" /></div>
                   <div class="text-center" style="font-size: 11px">{{$pd->sale_price}} Ks</div>
               </div>
           </div>
            @endfor
           @endforeach
    </div>
</div>



<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/printThis.js')}}"></script>
<script>
    $(function () {
        $("#btnPrintBarcode").on('click', function () {
            $("#barcodePage").printThis();
        })
    })
</script>

</body>
</html>
