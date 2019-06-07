<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="text-center">
                <h2>Mini Store</h2>
                <div>Ph: 022828278727</div>
                <div>Mawlamyine.</div>
            </div>
            <div style="margin-bottom: 20px; margin-top: 20px;">
            <div>Sale ID : {{$sale->id}}</div>
            <div>Cashier : {{$sale->user->name}}</div>
            <div>Date Time : {{date("(D) d-m-Y / h:i A", strtotime($sale->created_at))}}</div>
            </div>
            <table class="table table-hover table-bordered">
                <tr>
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
                <tr>
                    <td class="text-right" colspan="3">Total</td>
                    <td>{{$sale->totalAmount}}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3">Commercial Tax</td>
                    <td>{{$sale->totalAmount * 0.05}}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3">Grand Total</td>
                    <td>{{$sale->totalAmount * 0.05 + $sale->totalAmount}}</td>
                </tr>
            </table>

            <h5 style="margin-top: 50px;" class="text-center">၀ယ္ယူအားေပးမႈအတြက္ အထူးေက်းဇူးတင္ရွိပါသည္။</h5>
        </div>
    </div>
</div>


</body>
</html>