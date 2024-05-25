@extends('layouts.app')

@section('title', 'Create Production')

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
                <h1>Create a new Production Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">New Forms</a></div>
                    <div class="breadcrumb-item">Production Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Production Product</h2>
                <div class="card">
                    <form action="{{ route('production.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input a new Production Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Schedule Production</label>
                                <input type="text"
                                    class="form-control @error('schedule')
                                is-invalid
                            @enderror"
                                    name="schedule">
                                @error('schedule')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Actual Production</label>
                                <input type="text"
                                    class="form-control @error('actual')
                                is-invalid
                            @enderror"
                                    name="actual">
                                @error('actual')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Shift</label>
                                <input type="text"
                                    class="form-control @error('shift')
                                is-invalid
                            @enderror"
                                    name="shift">
                                @error('shift')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Group</label>
                                <input type="text"
                                    class="form-control @error('group')
                                is-invalid
                            @enderror"
                                    name="group">
                                @error('group')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Create Production Product</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
