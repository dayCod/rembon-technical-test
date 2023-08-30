@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Pesanan', 'breadcrumb_sections' => ['Informasi Pesanan', 'Atur Pesanan']])

@section('page-title', 'AZ Product - Atur Pesanan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="{{ route('backside.order.create-view') }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Kode Pesanan</th>
                                    <th class="text-center align-middle">Tanggal Pesanan</th>
                                    <th class="text-center align-middle">Nama Lengkap Pembeli</th>
                                    <th class="text-center align-middle">Total Harga</th>
                                    <th class="text-center align-middle">Jumlah Produk</th>
                                    <th class="text-center align-middle">Status Pesanan</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $order->kode_pesanan }}</td>
                                    <td class="text-center">{{ $order->tgl_pesanan }}</td>
                                    <td class="text-center">{{ $order->user->getFullName() }}</td>
                                    <td class="text-center">{{ $order->getTotalPriceOfProductOrder() }}</td>
                                    <td class="text-center">{{ $order->countTotalOrderedProduct() }}</td>
                                    <td class="text-center">{{ $order->getOrderStatus() }}</td>
                                    <td class="text-center">
                                        @if($order->getOrderStatus() == 'Pending')
                                        <a href="{{ route('backside.order.paid-off-action', ['uuid' => $order->uuid]) }}" class="btn btn-sm btn-primary">Bayar Lunas</a>
                                        <a href="{{ route('backside.order.cancel-action', ['uuid' => $order->uuid]) }}" class="btn btn-sm btn-danger">Batalkan</a>
                                        <a href="" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('backside.order.delete-action', ['uuid' => $order->uuid]) }}" class="btn btn-sm btn-danger btn-delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="8">{{ __('Data Kosong') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nomor Pesanan</th>
                                    <th class="text-center align-middle">Tanggal Pesanan</th>
                                    <th class="text-center align-middle">Nama Lengkap Pembeli</th>
                                    <th class="text-center align-middle">Total Harga</th>
                                    <th class="text-center align-middle">Jumlah Produk</th>
                                    <th class="text-center align-middle">Status Pesanan</th>
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
