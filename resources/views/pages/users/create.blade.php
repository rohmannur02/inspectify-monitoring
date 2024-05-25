@extends('layouts.app')

@section('title', 'Create User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create a New User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">New Forms</a></div>
                    <div class="breadcrumb-item">User</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">User</h2>
                <div class="card">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input a New User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control @error('email')
                                is-invalid
                            @enderror"
                                    name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password"
                                        class="form-control @error('password')
                                is-invalid
                            @enderror"
                                        name="password">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="number" class="form-control" name="nik">
                            </div>
                            <div class="form-group">
                                <label>Group</label>
                                <input type="text" class="form-control" name="group">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="selectgroup w-100">
                                    @if(Auth::user()->status === 'HOS')
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="HOS" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Head Of Section</span>
                                    </label>
                                    @endif
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="TL" class="selectgroup-input">
                                        <span class="selectgroup-button">Team Leader</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="OP" class="selectgroup-input">
                                        <span class="selectgroup-button">Operator</span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Create User</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
