@extends('layout.backside.app', ['breadcrumb_heading' => 'Informasi Produk', 'breadcrumb_sections' => ['Informasi Produk', 'Atur Produk', 'Tong Sampah']])

@section('page-title', 'AZ Product - Tong Sampah')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Tong Sampah</h4>
                        <a href="{{ route('backside.product.index-view') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back') }}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Uuid</th>
                                    <th class="text-center align-middle">Nama Produk</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Uuid</th>
                                    <th class="text-center align-middle">Nama Produk</th>
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
