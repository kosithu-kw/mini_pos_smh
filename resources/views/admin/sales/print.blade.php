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
         h2{
            font-family: lit;

        }


    </style>
</head>
<body>



<div class="container" id="invoice-POS">
    <div class="row">

    <div class="col-sm-12">

            <h2 class="text-center">ေရႊမ်က္မွန္ (၂)</h2>
            <h5 class="text-center">အိမ္ေဆာက္ပစၥည္းႏွင့္သံထည္ပစၥည္းအမ်ိဳးမ်ိဳး</h5>

            <p class="text-center">အမွတ္(၁၃/၁၅)၊ ရန္ကုန္-ေမာ္လၿမိဳင္ကားလမ္းမ(မင္းလမ္း)၊ လိပ္အင္းရပ္ကြက္၊ သထုံၿမိဳ႕။</p>
            <p class="text-center">
                <i class="fa fa-phone"></i> 09405886881, 09674066674, 09791833357

            </p>


        <div class="info">
        <div class="row">
            <div class="col-sm-12 table-responsive">

                <table class="table table-borderless">
                    <tr>
                        <td class="text-right">Name -</td><td>  {{$sale->customer->name}}</td>
                        <td class="text-right">
                        
                              Sale ID - </td>
                        
                        <td> {{$sale->id}}</td>
                    </tr>
                    <tr>
                        <td class="text-right"> Address - </td><td>{{$sale->customer->address}}</td>
                        <td class="text-right">  Payment -</td>
                        <td> @if ( ($sale->paid_cash - $sale->totalAmount) >= 0 ) Cash Paid @else Credit @endif</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"> Date - </td><td>{{date("d-m-Y", strtotime($sale->created_at))}}</td>
                    </tr>
                </table>
            <p>
                
               
            </p>
            </div>

          
        </div>
        </div>


    </div><!--End Invoice Mid-->

    <div class="col-sm-12">

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>Item</td>
                    <td >Price (Ks)</td>
                    <td >Qty</td>
                    <td >Amount (Ks)</td>
                </tr>
                @foreach($sale->saleitem as $item)
                <tr>
                    <td ><p>{{$item->item_name}}</p></td>
                    <td ><p>

                    
                        {{$item->sale_price}}
                    
                    </p></td>
                    <td ><p>{{$item->quantity}}</p></td>
                    <td ><p>{{$item->amount}}</p></td>
                </tr>
                @endforeach



                <tr>
                    <td></td>
                    <td colspan="2">Total (Ks) : </td>
                    <td >{{$sale->totalAmount}}</td>
                </tr>

                <tr class="tabletitle" >
                    <td></td>
                    <td  colspan="2">Paid By : Cash (Ks)</td>
                    <td >{{$sale->paid_cash}}</td>
                </tr>
                <tr class="tabletitle" >
                    <td></td>
                    <td colspan="2">Changed (Ks) : </td>
                    <td >
                        @if(($sale->paid_cash - $sale->totalAmount) >= 0)
                             {{$sale->paid_cash - $sale->totalAmount}}
                        @endif
                             
                    </td>
                </tr>
                <tr class="tabletitle" >
                    <td></td>
                    <td colspan="2">Credit (Ks) : </td>
                    <td >
                        @if(($sale->paid_cash - $sale->totalAmount) < 0)
                             @php echo abs($sale->paid_cash - $sale->totalAmount) @endphp
                        @endif
                             
                    </td>
                </tr>

            </table>
        </div><!--End Table-->

        <div>
            <p class="text-center"><strong>Thank You.</strong>
            </p>
        </div>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
</div>



            <div class="container">
                <div class="row">
                    <div class="col-sm-8">

                        <a href="{{route('sale')}}" class="btn btn-link">Sale <i class="fa fa-shopping-cart"></i></a>


                        <a href="{{route('sales.report')}}" class="btn btn-link"> Report <i class="fa fa-area-chart"></i></a>

                    </div>
                    <div class="col-sm-4">
                    <a href="#!"  id="btnPrint" class="btn btn-outline-primary"> Print <i class="fa fa-print"></i></a>

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