@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Pesanan', 'breadcrumb_sections' => ['Informasi Pesanan', 'Atur Pesanan', 'Ubah']])

@section('page-title', 'AZ Product - Ubah Pesanan')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Ubah Pesanan</h4>
                        <a href="{{ route('backside.order.index-view') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back') }}
                        </a>
                    </div>
                    @if (session()->has('errors'))
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row answer-section mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Pilih Produk <span class="text-danger">*</span> </label>
                                    <div class="form-group mb-3">
                                        <select class="form-control" name="produk_id">
                                            <option value="" selected hidden>Pilih Produk</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" @selected(old('produk_id') == $product->id)>
                                                    {{ $product->nama.' - Sisa Stok: '.$product->stokProduk->stok }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Yang Ingin Dipesan <span class="text-danger">*</span> </label>
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <input type="number" placeholder="Jumlah Yang Ingin Dipesan" class="form-control" placeholder="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="answer-section-divider"></div>
                            <div class="my-3" id="btn-actions-group">
                                <button type="button" class="btn btn-success rounded-circle btn-actions" id="increase">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-warning text-white rounded-circle btn-actions" id="decrease">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-actions">
                                <p class="text-danger">* Jumlah yang Ingin Dipesan Tidak dapat melebihi Sisa Stok dari Produk yang Dipilih *</p>
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
