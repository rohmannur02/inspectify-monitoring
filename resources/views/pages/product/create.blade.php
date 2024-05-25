@extends('layouts.app')

@section('title', 'Create Product')

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
                <h1>Create a new Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">New Forms</a></div>
                    <div class="breadcrumb-item">Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product</h2>
                <div class="card">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input a New Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Size</label>
                                <input type="text"
                                    class="form-control @error('size')
                                is-invalid
                            @enderror"
                                    name="size">
                                @error('size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Pattern</label>
                                <input type="text"
                                    class="form-control @error('pattern')
                                is-invalid
                            @enderror"
                                    name="pattern">
                                @error('pattern')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Item Code</label>
                                <input type="text"
                                    class="form-control @error('item_code')
                                is-invalid
                            @enderror"
                                    name="item_code">
                                @error('item_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Marking Line</label>
                                <input type="text"
                                    class="form-control @error('marking_line')
                                is-invalid
                            @enderror"
                                    name="marking_line">
                                @error('marking_line')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Create Product</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
