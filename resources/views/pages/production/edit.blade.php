@extends('layouts.app')

@section('title', 'Edit Production')

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
                <h1>Update Production</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Update Production</a></div>
                    <div class="breadcrumb-item">Production</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Production</h2>



                <div class="card">
                    <form action="{{ route('production.update', $productions) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Update Production</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Schedule Production</label>
                                <input type="text"
                                    class="form-control @error('schedule')
                                is-invalid
                            @enderror"
                                    name="schedule" value="{{ $productions->schedule }}">
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
                                    name="actual" value="{{ $productions->actual }}">
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
                                    name="shift" value="{{ $productions->shift }}">
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
                                    name="group" value="{{ $productions->group }}">
                                @error('group')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                           {{-- <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                    class="form-control @error('price')
                                is-invalid
                            @enderror"
                                    name="price" value="{{ $product->price }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number"
                                    class="form-control @error('stock')
                                is-invalid
                            @enderror"
                                    name="stock" value="{{ $product->stock }}">
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="mr-5">Image</label>
                                <img src="{{ asset('storage/products/'.$product->image) }}" class="img-thumbnail" alt="{{ $product->name }}" width="300" height="300">
                            </div>

                            <div class="form-group">
                                <label>Update Image</label>
                                <input type="file"
                                    class="form-control @error('image')
                                is-invalid
                            @enderror"
                                    name="image" value="{{ 'storage/products/'.$product->image }}">
                                <small class="form-text text-muted">Update product image.</small>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="drink" class="selectgroup-input"
                                            @if ($product->category == 'drink') checked @endif>
                                        <span class="selectgroup-button">Drink</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="food" class="selectgroup-input" @if ($product->category == 'food') checked @endif>
                                        <span class="selectgroup-button">Food</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="snack" class="selectgroup-input" @if ($product->category == 'snack') checked @endif>
                                        <span class="selectgroup-button">Snack</span>
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Favorite</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_best_seller" value="0" class="selectgroup-input"
                                            @if ($product->is_best_seller == '0') checked @endif>
                                        <span class="selectgroup-button">No</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_best_seller" value="1" class="selectgroup-input" @if ($product->is_best_seller == '1') checked @endif>
                                        <span class="selectgroup-button">Yes</span>
                                    </label>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
