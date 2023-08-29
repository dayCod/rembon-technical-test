@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Pesanan', 'breadcrumb_sections' => ['Informasi Pesanan', 'Atur Pesanan']])

@section('page-title', 'AZ Product - Atur Pesanan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="{{ route('backside.product.create-view') }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nomor Pesanan</th>
                                    <th class="text-center align-middle">Tanggal Pesanan</th>
                                    <th class="text-center align-middle">Nama Lengkap Pembeli</th>
                                    <th class="text-center align-middle">Total Harga</th>
                                    <th class="text-center align-middle">Jumlah Produk</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nomor Pesanan</th>
                                    <th class="text-center align-middle">Tanggal Pesanan</th>
                                    <th class="text-center align-middle">Nama Lengkap Pembeli</th>
                                    <th class="text-center align-middle">Total Harga</th>
                                    <th class="text-center align-middle">Jumlah Produk</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
