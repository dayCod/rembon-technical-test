<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backside/assets/images/favicon.png') }}">
    <title>Product Data</title>
    <link href="{{ asset('backend/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backside/assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backside/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backside/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="{{ asset('backside/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backside/assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <link href="{{ asset('backside/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backside/dist/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontside/vendor/iziToast/dist/css/iziToast.min.css') }}">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 100vh">
            <div class="col-12">
                <div class="card">
                    <h3 class="text-center">Product Data</h3>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">Id</th>
                                        <th class="text-center align-middle">Nama Produk</th>
                                        <th class="text-center align-middle">Stok Tersedia</th>
                                        <th class="text-center align-middle">Stok Terjual</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center align-middle">Id</th>
                                        <th class="text-center align-middle">Nama Produk</th>
                                        <th class="text-center align-middle">Stok Tersedia</th>
                                        <th class="text-center align-middle">Stok Terjual</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('backside/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backside/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backside/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('backside/dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('backside/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('backside/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('backside/dist/js/custom-app.js') }}"></script>
    <script src="{{ asset('backside/assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('backside/assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('backside/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('backside/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}">
    </script>
    <script src="{{ asset('backside/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('backside/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('backside/dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
    <script src="{{ asset('backside/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backside/assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backside/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
    <script src="{{ asset('backside/assets/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('backside/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('backside/dist/js/pages/calendar/cal-init.js') }}"></script>
    <script src="{{ asset('frontside/vendor/iziToast/dist/js/iziToast.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'http://localhost:8000/api/backside/product',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization',
                        'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTExZDY0YzkyY2I2MmZjN2JiZGEwODEzNTYzMWNkYjE0ZDYyY2RiMWE1YjEzNzNmMTUwNjE0YTI4NmE5NDU5ZTFlY2IzZjNhZmUwZTc2MzEiLCJpYXQiOjE2OTM0NTQ2MDguMTY4OTIyLCJuYmYiOjE2OTM0NTQ2MDguMTY4OTIyLCJleHAiOjE3MjUwNzcwMDcuNjY0ODk0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.z65TcCpPc8hDaqJRp5sQkGydGETlTDWEgfCHAasGMzJpTd_xdXvwjKNLaF2CQEj4cymCltqHL_7Wg1ohshGbymRXW3PZ7u4w1bJycxjh1EP5OxdAtny4w0DsHPf7IAbjbym8rYQhUV8soaJHtDvF0FTDhzHgtl0iAB9JetCeN15y3Zpsoi0s8ATkHt6pla4w3ua_jzby75sRn7_0tEyQNRHwu_rvw4l1aDDd8dsUSkc9uLECb_9CLVynxXRo34iUDQ8TA6s0Z-5T8l2HKj-WsnHnTYDlFaU1YQQsj0jWZ8wcmEyqjM0Z6UbwDUY55iqbMxosVWNOhBe5uTpTRcDkERN6zKSX62vf00zZJHLU9ibWd9LIvbdMpAWhdgng1-lQWjxlpqxqVwa096P3ShGCV9zRHAhW4lbb6ozzCLjzKot3lB6fg6EP6tMY2hyjRCgNZ0MC6OtbZMzNi0zDBofsqfLh8klvCD-zhtHOO66gW448lILqi-6fVVuWhqm3vAkae55Pum1kUQWjeeQ1mAOqrprW7L1Gg3gOVJNhGpjaa6zBtVEE3-vhTVqj3scdfdc9qsEV6jxud4cvWbuogm4W3YVXDav9qj9VHFxS7UYadz1qGWVSpgzhVNlGkPDuuMGQzsBEScK3DXLIiAUepyyyuM6WWSnGzirBADOD9HvAWBU'
                    )
                },
                success: function(res) {
                    $('#myTable').DataTable({
                        "processing": true,
                        "dataSrc": 'data',
                        "data": res.data,
                        "dataType": 'json',
                        "columns": [
                            {
                                "data": "id"
                            },
                            {
                                "data": "nama"
                            },
                            {
                                "data": "stok_produk.stok"
                            },
                            {
                                "data": "produk_pesanan_sum_jumlah",
                                "defaultContent": "0",
                            },
                        ]
                    });
                }
            });
        })
    </script>
</body>

</html>
