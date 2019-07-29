<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
   <!-- <link rel="stylesheet" href="{{asset('bst/css/bootstrap.css')}}"> -->
    <link href="{{asset('css/print.css')}}" rel="stylesheet"></link>
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
        #top .info h2{
            font-family: lit;

        }
        button[type=button]{
            width: 150px;
            height: 40px;
            background: #0c5460;
            color: #fff;
            text-align: center;
            border-radius: 10px;

        }
        button[type=button]:hover{
            background: #0d6aad;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>



<div>
    <div id="invoice-POS">

    <center id="top">
        <div class="info">
            <h2>LAND MARK</h2>
        </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid">
        <div class="info1">
            <p>No. 62-A, Main Road, Nan Khal Quarter, Thaton, Front AYA BANK</p>
            <p>
                <i class="fa fa-phone"></i> 09409405770 ,09796000056

            </p>
        </div>

        <div class="info">
            <p>
                Sale ID : {{$sale->id}} <br>
                Cashier : {{$sale->user->name}} <br>
                PRN ON : {{date("d/m Y / h:i A")}}
            </p>
        </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle" >
                    <td><h2>Item</h2></td>
                    <td ><h2>Price (Ks)</h2></td>
                    <td ><h2>Qty</h2></td>
                    <td ><h2>Amount (Ks)</h2></td>
                </tr>
                @foreach($sale->saleitem as $item)
                <tr class="service">
                    <td ><p class="itemtext">{{$item->item_name}}</p></td>
                    <td ><p class="itemtext">{{$item->sale_price}}</p></td>
                    <td ><p class="itemtext">{{$item->quantity}}</p></td>
                    <td ><p class="itemtext">{{$item->amount}}</p></td>
                </tr>
                @endforeach



                <tr class="tabletitle" >
                    <td></td>
                    <td colspan="2"><h2>Total (Ks) :</h2></td>
                    <td ><h2>{{$sale->totalAmount}}</h2></td>
                </tr>

                <tr class="tabletitle" >
                    <td></td>
                    <td  colspan="2"><h2>Paid By : Cash (Ks)</h2></td>
                    <td ><h2>{{$sale->paid_cash}}</h2></td>
                </tr>
                <tr class="tabletitle" >
                    <td></td>
                    <td colspan="2"><h2>Changed (Ks) : </h2></td>
                    <td ><h2>{{$sale->paid_cash - $sale->totalAmount}}</h2></td>
                </tr>

            </table>
        </div><!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Thank You.</strong>
            </p>
        </div>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
</div>

<div class="container">
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
            $("#invoice-POS").printThis();
        })
    })
</script>

</body>
</html>