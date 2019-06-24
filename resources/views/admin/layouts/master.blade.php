<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NTG Mini POS | @yield('title')</title>

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

    <!-- Data table-->
    <link rel="stylesheet" href="{{asset('datatable/app.css')}}">

    <!-- Google Font -->


    @yield('style')

</head>
<body  class="hold-transition skin-blue sidebar-mini">

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
    <script>
        $(function () {
            $(".tem").fadeOut(5000);

            $("#productTable").dataTable();
            $("#user_table").dataTable();

            $("#checkAllItems").on('click', function () {
                if (this.checked) {
                    $("input[type=checkbox]").prop("checked", true);
                } else {
                    $("input[type=checkbox]").prop("checked", false);
                }
            });


            $("#printBarcode").on('click', function () {
                var ckBox = $("[name='id[]']:checked").length;
                if (ckBox > 0) {
                    $("#productTableForm").submit()
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



        });

    </script>

    @yield('script')

</body>
</html>