<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="{{asset('bst/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <style>
        @font-face {
            font-family: zg;
            src: url("../../bst/zg.ttf");

        }
        body{
            font-family: zg;
        }
        @font-face {
            font-family: lit;
            src: url("../../bst/lit.otf");
        }
        #client-logo{
            font-family: lit;

        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2" id="myPrint">
            <div class="text-center">
                <div id="client-logo">LAND MARK</div>
                <div style="font-size: 13px">No. 62-A, Main Road, Nan Khal Quarter, Thaton, Front AYA BANK</div>
                <div style="font-size: 13px;"><i class="fa fa-phone"></i> 09409405770, 09796000056</div>
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
                    <div class="col-sm-10" style="font-weight: bold;">
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
                <tr style="border-top: dashed rgba(100,100,100,0.5); border-bottom: dashed rgba(100,100,100,0.2);">
                    <th>Item Name</th>
                    <th>Price (Ks)</th>
                    <th>Qty</th>
                    <th>Amount (Ks)</th>
                </tr>
                @foreach($sale->saleitem as $item)
                    <tr>
                        <td>{{$item->item_name}}</td>
                        <td> {{$item->sale_price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td> {{$item->amount}}</td>
                    </tr>
                @endforeach
                <tfoot style="border-top: dashed rgba(100,100,100,0.2); border-bottom: dashed rgba(100,100,100,0.2);">

                <tr>
                    <td class="text-right" colspan="3">Total (Ks) : </td>
                    <td>{{$sale->totalAmount}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Paid By: Cash (Ks)</td>
                    <td>{{$sale->paid_cash}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Changed (Ks) : </td>
                    <td> {{$sale->paid_cash - $sale->totalAmount}}</td>
                </tr>

                </tfoot>
            </table>

            <div class="mt-5 text-center" style="font-size: 13px">၀ယ္ယူအားေပးမႈအတြက္ အထူးေက်းဇူးတင္ရွိပါသည္။</div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-2 offset-5">
            <button type="button" class="btn btn-primary btn-block" id="btnPrint"><i class="fa fa-print"></i> Print</button>

        </div>
    </div>
</div>

<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/printThis.js')}}"></script>
<script>
    $(function () {
        $("#btnPrint").on('click', function () {
            $("#myPrint").printThis();
        })
    })
</script>

</body>
</html>