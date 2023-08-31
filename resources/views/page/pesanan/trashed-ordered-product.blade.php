@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Pesanan', 'breadcrumb_sections' => ['Informasi Pesanan', 'Atur Pesanan', 'Detail Produk Pesanan', 'Tong Sampah']])

@section('page-title', 'AZ Product - Tong Sampah')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title">Tong Sampah</h4>
                        <a href="{{ route('backside.order.show-related-product-view', ['uuid' => $uuid]) }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back') }}
                        </a>
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
                                @forelse($trashed_ordered_products as $product)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $product->produk->nama }}</td>
                                    <td class="text-center">{{ $product->jumlah }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('backside.order.restore-action', ['order_uuid' => $uuid, 'order_product_uuid' => $product->uuid]) }}" class="btn btn-primary btn-sm">
                                            Pulihkan
                                        </a>
                                        <a href="{{ route('backside.order.force-delete', ['order_uuid' => $uuid, 'order_product_uuid' => $product->uuid]) }}" class="btn btn-danger btn-sm btn-delete">
                                            Hapus Permanen
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
