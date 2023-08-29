@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Produk', 'breadcrumb_sections' => ['Informasi Produk', 'Atur Produk', 'Tambah']])

@section('page-title', 'AZ Product - Tambah Produk')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Tambah Produk</h4>
                    <a href="{{ route('backside.product.index-view') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                @if(session()->has('errors'))
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Nama Produk <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nama Produk" name="nama" value="{{ old('nama') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Brand Produk <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Brand Produk" name="brand" value="{{ old('brand') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Harga Produk <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="number" class="form-control" placeholder="Harga Produk" name="harga" value="{{ old('harga') }}" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Stok Produk <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="number" class="form-control" placeholder="Stok Produk" name="stok" value="{{ old('stok') }}" min="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
