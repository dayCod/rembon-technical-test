@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Pesanan', 'breadcrumb_sections' => ['Informasi Pesanan', 'Atur Pesanan', 'Detail Produk Pesanan']])

@section('page-title', 'AZ Product - Detail Produk Pesanan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title">Detail Produk Pesanan</h4>
                        <div>
                            <a href="{{ route('backside.order.trash-view', ['uuid' => $uuid]) }}" class="btn btn-secondary">
                                Tong Sampah
                            </a>
                            <a href="{{ route('backside.order.index-view') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Produk</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ordered_products as $product)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $product->produk->nama }}</td>
                                    <td class="text-center">{{ $product->jumlah }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('backside.order.soft-delete', ['order_uuid' => $uuid, 'order_product_uuid' => $product->uuid]) }}" class="btn btn-danger btn-sm btn-delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4">{{ __('Data Kosong') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Produk</th>
                                    <th class="text-center align-middle">Jumlah</th>
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
