@extends('layout.auth.app')

@section('page-title', 'AZ Product - Register Page')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-5" style="height: 100vh">
            <div class="col-6">
                <div class="card border border-0 shadow p-4">
                    <h3 class="text-uppercase mb-4 text-center">az product - register</h3>
                    @if (session()->has('fail'))
                        <div class="alert alert-danger">
                            {{ session()->pull('fail') }}
                        </div>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Nama Depan</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-6">
                                    <label for="">Nama Belakang</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="">Phone Number</label>
                            <input type="tel" class="form-control" name="phone_number">
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info text-white">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
