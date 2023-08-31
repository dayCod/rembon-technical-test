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
    <title>Order Data</title>
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
                                        <th class="text-center align-middle">Kode Pesanan</th>
                                        <th class="text-center align-middle">Tanggal Pesanan</th>
                                        <th class="text-center align-middle">Nama Lengkap Pembeli</th>
                                        <th class="text-center align-middle">Total Harga</th>
                                        <th class="text-center align-middle">Jumlah Produk</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center align-middle">Id</th>
                                        <th class="text-center align-middle">Nomor Pesanan</th>
                                        <th class="text-center align-middle">Tanggal Pesanan</th>
                                        <th class="text-center align-middle">Nama Lengkap Pembeli</th>
                                        <th class="text-center align-middle">Total Harga</th>
                                        <th class="text-center align-middle">Jumlah Produk</th>
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
                url: 'http://localhost:8000/api/backside/order',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization',
                        'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTIwMzkzYWUyZDZjYzFlYzIxODQzYmY5YjA0ZDQwYjZmN2E2MzhiOTMzNjcxY2I0NmEzNmRmYjUzZjEyNWE4ODEwMTFhYzc3ZmM4NjZmOWMiLCJpYXQiOjE2OTM0NTUxMTIuNDU2NzY2LCJuYmYiOjE2OTM0NTUxMTIuNDU2NzY2LCJleHAiOjE3MjUwNzc1MTIuMjAzNzUxLCJzdWIiOiI1Iiwic2NvcGVzIjpbXX0.FPB584-qxxg02KUSlKpYKEjgAl-UbMjA1Loq6OfgO-KDOTrenIeZBAsW8SlLY97FLbDN4uHF4iAbaMAioLRD2yzYE8gPw7uuJjqvfaCZjC0VORsPHGXWcfYztx0vJN9IzDQugc53XbnkcwcMUkHGrkRzSg2KmfnX9IH8JlySYg72kHI1ceJpLSmnQqQ8-cxeCFnMc4KInmSjdQ5hL1mQQx11g01N1crYzT9cP97OUk_M8N025M34yZIW0vKMcy_rmLJPteMVNmtmoFUR3Dda5vEHiyGtt2DeqTzr1awQoLnZFKIpYnv1GHK0IZEuEotG52uw9sVIKaV3HLFYFDB3K2D9ovRqDZ0938A0aV1JKrwh9STzJXWd32a25yy8_3NUP-zr9-12sBvpL6euOuWjjb5vw_NJo0EgLY2odscdibkQl3FRZOHSmxElGBxoJQOKiw2xnvGLWgiiwOok1a_3nk9HF9HdGEC73m4BL4e4A6gW3CXQc7BLHTjCbc3ePebo2PeYvm9C6JpayMiHAe5KYKwKC7DYYaCMLIjhKMnUFrmX6-sGF6BlrQS1ziCMFi-BCXfz6is8W9-FPfFwMhOZBBaeVBfhFJlB7syiz1wGXXBzxXU5T3bgYZahjvYqQVHZJYasXp-uSjWpNtehjziRvVsxxaL8pSkHNFna_YdWcg8'
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
                                "data": "kode_pesanan"
                            },
                            {
                                "data": "tgl_pesanan"
                            },
                            {
                                "data": "nama_lengkap_pembeli"
                            },
                            {
                                "data": "total_harga"
                            },
                            {
                                "data": "jumlah_produk"
                            },
                        ]
                    });
                }
            });
        })
    </script>
</body>

</html>
