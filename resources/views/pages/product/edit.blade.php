@extends('layouts.app')

@section('title', 'Update Product')

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
                <h1>Update Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Update Product</a></div>
                    <div class="breadcrumb-item">Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product</h2>

                <div class="card">
                    <form action="{{ route('product.update', $products) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Update Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Size</label>
                                <input type="text"
                                    class="form-control @error('size')
                                is-invalid
                            @enderror"
                                    name="size" value="{{ $products->size }}">
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
                                    name="pattern" value="{{ $products->pattern }}">
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
                                    name="item_code" value="{{ $products->item_code }}">
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
                                    name="marking_line" value="{{ $products->marking_line }}">
                                @error('marking_line')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
