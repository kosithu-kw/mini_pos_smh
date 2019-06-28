<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="{{asset('bst/css/bootstrap.css')}}">
    <style>
        @font-face {
            font-family: zg;
            src: url("bst/zg.ttf");

        }
        body{
            font-family: zg;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="text-center">
                <div>Mini Store</div>
                <div>Mawlamyine.</div>
            </div>
            <div class="my-3" style="font-size: 13px">
                <div class="row">
                    <div class="col-sm-2">
                        SALE ID
                    </div>
                    <div class="col-sm-10" style="font-weight: bold;">
                        : {{$sale->id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        CASHIER
                    </div>
                    <div class="col-sm-10">
                        : {{$sale->user->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                       PRN ON
                    </div>
                    <div class="col-sm-10">
                        : {{date("d/m Y / h:i A")}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        DATE
                    </div>
                    <div class="col-sm-10">
                        : {{date("d/m Y / h:i A", strtotime($sale->created_at))}}
                    </div>
                </div>
            </div>
            <table class="table table-hover table-borderless" style="font-size: 13px">
                <tr style="border-top: dashed rgba(100,100,100,0.5); border-bottom: dashed rgba(100,100,100,0.5);">
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
                @foreach($sale->saleitem as $item)
                    <tr>
                        <td>{{$item->item_name}}</td>
                        <td>{{$item->sale_price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->amount}}</td>
                    </tr>
                @endforeach
                <tfoot style="border-top: dashed rgba(100,100,100,0.5); border-bottom: dashed rgba(100,100,100,0.5);">

                <tr>
                    <td class="text-right" colspan="3">Sub Total</td>
                    <td>{{$sale->totalAmount}}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3">Commercial Tax (5%)</td>
                    <td>{{$sale->totalAmount * 0.05}}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3">Net Total</td>
                    <td>{{$sale->totalAmount * 0.05 + $sale->totalAmount}}</td>
                </tr>
                </tfoot>
            </table>

            <div class="mt-5 text-center" style="font-size: 13px">၀ယ္ယူအားေပးမႈအတြက္ အထူးေက်းဇူးတင္ရွိပါသည္။</div>
        </div>
    </div>
</div>


</body>
</html>