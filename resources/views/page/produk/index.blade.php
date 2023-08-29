@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Produk', 'breadcrumb_sections' => ['Informasi Produk', 'Atur Produk']])

@section('page-title', 'AZ Product - Atur Produk')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="{{ route('backside.product.create-view') }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                        </a>
                        <a href="{{ route('backside.product.trash-view') }}" class="btn btn-secondary">
                            Tong Sampah
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Produk</th>
                                    <th class="text-center align-middle">Stok Tersedia</th>
                                    <th class="text-center align-middle">Stok Terjual</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $product->nama }}</td>
                                    <td class="text-center">{{ $product->stokProduk->stok }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">
                                        <a href="{{ route('backside.product.edit-view', ['uuid' => $product->uuid]) }}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('backside.product.soft-delete', ['uuid' => $product->uuid]) }}" class="btn btn-danger btn-sm btn-delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">{{ __('Data Kosong') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Produk</th>
                                    <th class="text-center align-middle">Stok Tersedia</th>
                                    <th class="text-center align-middle">Stok Terjual</th>
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
