<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcode</title>
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
</head>
<body>

<div class="container-fluid">
    <div class="row">
       @foreach($pds as $pd)
           <div class="col-sm-3">
               <div class="thumbnail" style="padding: 5px">
                    <div class="text-center" style="font-size: 11px">ID : {{$pd->id}}, Item Name : {{$pd->item_name}}</div>
                    <div class="text-center"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($pd->barcode, 'C93')}}" alt="barcode" /></div>
                   <div class="text-center" style="font-size: 11px">Price : {{$pd->sale_price}} MMK</div>
               </div>
           </div>
           @endforeach
    </div>
</div>

</body>
</html>
