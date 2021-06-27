<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NTG Mini Store POS | @yield('title')</title>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <link href="{{asset('ntg/logo.ico')}}" rel="icon">

    <!-- Data table-->
    <link rel="stylesheet" href="{{asset('datatable/app.css')}}">

    <style>
        @font-face {
            font-family: myZg;
            src: url("../../bst/zg.ttf");

        }
        @font-face {
            font-family: myDis;
            src: url("../bst/dis.otf");
        }

    </style>

    <!-- Google Font -->


    @yield('style')

</head>
<body  class="hold-transition skin-blue sidebar-mini sidebar-collapse">

    <div class="wrapper">

        @include('admin.layouts.navBar')
        @include('admin.layouts.sideBar')

        @yield('content')


        @include('admin.layouts.footer')
    </div>

    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- ChartJS -->
    <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>


    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

    <script src="{{asset('datatable/app.js')}}"></script>

    <script src="{{asset('js/action.js')}}"></script>

    <script src="{{asset('buying_sale_graph.js')}}"></script>

    <script src="{{asset('js/printThis.js')}}"></script>

    <script>
        $(function () {

            setTimeout(function () {
                $(".tem").fadeOut();
            }, 1000)

            //$("#productTable").dataTable({order:[[2,"desc"]]});
            $("#customers").dataTable({order:[[2,"desc"]]});


            $("#user_table").dataTable({order:[[2,"desc"]]});

            $("#credit_table").dataTable({order:[[1,"desc"]]});
            $("#repaid_table").dataTable({order:[[1,"desc"]]});
            
            

            $('div.dataTables_filter input').focus();

            $("#checkAllItems").on('click', function () {
                if (this.checked) {
                    $("input[type=checkbox]").prop("checked", true);
                } else {
                    $("input[type=checkbox]").prop("checked", false);
                }
            });

            $("#btnPrintBarcode").on('click', function () {
                $("#productTableForm").submit()
                $("#printBarcodeModal").modal("hide");
            })

            $("#printBarcode").on('click', function () {
                var ckBox = $("[name='id[]']:checked").length;
                if (ckBox > 0) {
                   //

                    $("#printBarcodeModal").modal("show");

                } else {
                    $("#alertModal").modal("show");
                }

            })

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $("#btnCheckout").on('click', function () {
                setTimeout(function () {
                    window.location.replace("/sales/sale")
                }, 1000)
            })

            $("#f_d").on('change', function () {
                $("#fdForm").submit();
            });
            $("#f_m").on('change', function () {
                $("#fmForm").submit();
            });
            $("#f_id").on('change', function () {
                $("#fidForm").submit();
            });

            $("#saleModal").modal('show');

            $('#saleModal').on('shown.bs.modal', function () {
                $('#sale_item').focus()
            })

            $("#barcode").focus();

            $("#sale_item").bind('paste', function () {
                setTimeout(function () {
                    $("#saleForm").submit();
                }, 1000)
            })
            $("#search_item").bind('paste', function () {
                setTimeout(function () {
                    $("#product_search_form").submit();
                }, 1000)
            })






        });

    </script>

    @yield('script')

</body>
</html>