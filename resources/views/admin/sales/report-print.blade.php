<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" >
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
       
    <style>
        @font-face {
            font-family: zgPro;
            src: url("/fonts/SmartZawgyiPro.ttf");    
        }
        table tr td strong , table tr th, strong{
            font-family: zgPro;
        }
    </style>


   
</head>
<body>

  
    
    @php
        //Old Credit Calc
        $oldTotalAmount=0;
        $oldPaidAmount=0;
        $oldDiscount=0;
        $oldRepaid=0;
        foreach($credits as $c){
            if($c->sale_id != $sale->id){
                $oldTotalAmount += $c->total_amount;
                $oldPaidAmount +=$c->paid_cash;
                $oldDiscount += $c->discount;
                $oldRepaid += $c->re_paid;
            }
        }     
        
        $oldCredit=$oldTotalAmount - ( $oldPaidAmount + $oldDiscount + $oldRepaid);
        
      
        
        $totalItemQty=0;
        $totalItemAmount=0;
        foreach($sale->saleitem as $i){
        $totalItemQty += $i->quantity;
        $totalItemAmount += $i->amount;
        }
       
    @endphp

<div class="container" id="invoice-POS">
    <div class="row">

    <div class="col-sm-12">
            <h2 class="text-center font-weight-bold" style="margin-bottom: 20px; font-family: zgPro">ေရႊမ်က္မွန္ (၂)</h2>
            <h4 class="text-center" ><strong>အိမ္ေဆာက္ပစၥည္းႏွင့္သံထည္ပစၥည္းအမ်ိဳးမ်ိဳး</strong></h4>
            <div class="text-center">
                <i class="fa fa-phone"></i> <strong>အမွတ္(၁၃/၁၅)၊ ရန္ကုန္-ေမာ္လၿမိဳင္ကားလမ္းမ(မင္းလမ္း)၊ လိပ္အင္းရပ္ကြက္၊ သထုံၿမိဳ႕။</strong>
            </h4>
            <div class="text-center"><strong>09405886881, 09674066674, 097918333570</strong></div>
                   

            </div>
    </div>     

            
            


        <div class="row">
            <div class="col-sm-12">

                <table style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
                    <tr style="padding: 5px;">
                        <th class="text-right" style="width: 15%; padding-bottom: 5px; padding-right: 5px;">အမည္ -</th><th style="width: 40%;">  {{$sale->customer->name}}</th>
                        <th class="text-right" style="width: 25%; padding-right: 5px;"> ေဘာက္ခ်ာနံပါတ္ - </th>
                        <th style="width: 20%;"> {{$sale->id}}</th>

                    </tr>

                    <tr>
                        <th class="text-right" style="width: 15%; padding-bottom: 5px; padding-right: 5px;"> လိပ္စာ - </th><th>{{$sale->customer->address}}</th>
                        <th class="text-right" style="padding-right: 5px;">  ေငြေခ်သည့္ပံုစံ -</th>
                        <th> @if(((($oldCredit) + $sale->totalAmount) - ($sale->paid_cash + $sale->discount)) <= 0) လက္ငင္း @else အေၾကြး @endif</th>
                    </tr>
                    <tr>
                        <th class="text-right" style=" width: 15%;padding-right: 5px;"> ေရာင္းသူ - </th>
                       
                        <th>{{$sale->user->full_name}}</th>
                        <th class="text-right" style="width: 10%; padding-bottom: 5px; padding-right: 5px;"> ေန႕စြဲ - </th><th>{{date("d-m-Y", strtotime($sale->created_at))}}</th>
                    </tr>
                </table>
            <p>
                
               
            </p>
            </div>

          
        </div>


    </div><!--End Invoice Mid-->

    <div class="col-sm-12">

        <div>
            <table class="table table-bordered font-weight-bold">
                <thead>
                <tr>
                    
                    <th class="text-center">အမ်ိဳးအမည္</th>
                    <th class="text-center">အေရအတြက္</th>
                    <th class="text-center">ႏႈန္း</th>
                    <th class="text-center">က်သင့္ေငြ</th>                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach($sale->saleitem as $item)
                                                    <tr >
                                                        <td><strong>{{$item->item_name}}</strong></td>
                                                        
                                                        <td>
                                                            <strong>
                                                            @if($item->quantity > 0)
                                                                {{$item->quantity}}
                                                            @endif
                                                            </strong>
                                                        </td>
                                                       

                                                       
                                                        <td>
                                                            <strong>
                                                            @if($item->sale_price > 0)
                                                            {{$item->sale_price}}
                                                            @endif
                                                            </strong>
                                                        </td>
                                                        
                                                        <td>
                                                            <strong>
                                                            {{$item->quantity * $item->sale_price}}
                                                        </strong>
                                                        </td>
                                                    </tr>
                                                @endforeach

</tbody>

                                                <tfoot>
                                               
                                                    <tr >
                                                       
                                                      <td>
                                                          စုစုေပါင္း
                                                      </td>
                                                      <td>{{$totalItemQty}}</td>
                                                      <td></td>
                                                        <td>
                                                            <strong>
                                                            {{$sale->totalAmount}}
                                                            </strong>
                                                        </td>
                                                    </tr>
                                               

                                                <tr >
                                                    <td class="text-right" colspan="3">
                                                        <strong>
                                                        စုစုေပါင္း 
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        <strong>
                                                        {{$sale->totalAmount}}
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td  class="text-right"><strong> ယခင္ေၾကြးက်န္ေငြ  <strong></td>
                                                        <td>
                                                            <small>ယခင္ေၾကြးက်န္</small>
                                                            <div>
                                                                {{$oldCredit}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <small>ျပန္ဆပ္ေငြ</small>
                                                            <div>
                                                                {{$sale->re_paid}}
                                                            </div>
                                                        </td>
                                                    <td>
                                                        <strong>
                                                            @if(($oldCredit - $sale->re_paid) > 0)
                                                            {{$oldCredit - $sale->re_paid}}
                                                            @endif
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td colspan="3" class="text-right"><strong> စုစုေပါင္း  </strong></td>
                                                    <td>
                                                        <strong>                                                    
                                                            {{($sale->totalAmount + $oldCredit) - $sale->re_paid}}
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-right"><strong> ေပးေငြစုစုေပါင္း  </strong></td>
                                                    <td>
                                                        <strong>
                                                            @if($sale->paid_cash > 0)
                                                            {{$sale->paid_cash}}
                                                            @endif
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-right"><strong> ေလ်ွာ့ေစ်း  </strong></td>
                                                    <td>
                                                        <strong>
                                                            @if($sale->discount > 0)
                                                            {{$sale->discount}}
                                                            @endif
                                                        </strong>
                                                    </td>
                                                </tr>
                                              
                                                <tr >
                                                    <td colspan="3" class="text-right"><strong>က်န္ေငြစုစုေပါင္း  </strong></td>
                                                    <td>
                                                        <strong>
                                                            @if($last_credit->credit_amount > 0)
                                                            {{$last_credit->credit_amount}}
                                                            @endif
                                                        </strong>
                                                    </td>
                                                </tr>

                                                </tfoot>

            </table>
        </div><!--End Table-->

        <div>
            <p class="text-center"><strong></strong>
            </p>
        </div>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
</div>
        <div class="container mb-5">
            <div class="row">

                <div class="col-sm-9">
               

                    <a href="{{route('sale')}}" class="btn btn-primary">Sale <i class="fa fa-shopping-cart"></i></a>


                    <a href="{{route('sales.report')}}" class="btn btn-info"> Report <i class="fa fa-area-chart"></i></a>

                </div>

                    <div class="col-sm-3">
                        <a href="#!"  id="btnPrint" class="btn btn-primary btn-block"> Print <i class="fa fa-print"></i></a>
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
                
        
        setTimeout(function(){
            $("#invoice-POS").printThis({
                afterPrint: function(){
                        window.close();
                    }
            });
            
        },0);
        
        
     
       
    })
</script>

</body>
</html>