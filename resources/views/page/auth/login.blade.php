@extends('layout.auth.app')

@section('page-title', 'AZ Product - Login Page')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-6">
                <div class="card border border-0 shadow p-4">
                    <h3 class="text-uppercase mb-4 text-center">az product - login</h3>
                    @if (session()->has('errors'))
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('auth.authenticate-user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info text-white">Login</button>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div></div>
                                <a href="{{ route('auth.register-view') }}">Don't Have an Account? Register Here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
