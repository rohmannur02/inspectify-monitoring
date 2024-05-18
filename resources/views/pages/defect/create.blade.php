@extends('layouts.app')

@section('title', 'Create Defect')

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
                <h1>Create a new Defect</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">New Forms</a></div>
                    <div class="breadcrumb-item">Defect</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Defect</h2>
                <div class="card">
                    <form action="{{ route('defect.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input a new Defect</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <select class="form-control" name="size">
                                            <option value="Size 1">Size 1</option>
                                            <option value="Size 2">Size 2</option>
                                            <option value="Size 3">Size 3</option>
                                        </select>
                                        @error('size')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Pattern</label>
                                        <select class="form-control" name="pattern">
                                            <option value="Pattern 1">Pattern 1</option>
                                            <option value="Pattern 2">Pattern 2</option>
                                            <option value="Pattern 3">Pattern 3</option>
                                        </select>
                                        @error('pattern')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>No Serial</label>
                                        <select class="form-control" name="serial">
                                            <option value="No Serial 1">No Serial 1</option>
                                            <option value="No Serial 2">No Serial 2</option>
                                            <option value="No Serial 3">No Serial 3</option>
                                        </select>
                                        @error('serial')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Defect</label>
                                        <select class="form-control" name="defect">
                                            <option value="Defect 1">Defect 1</option>
                                            <option value="Defect 2">Defect 2</option>
                                            <option value="Defect 3">Defect 3</option>
                                        </select>
                                        @error('defect')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Area</label>
                                        <select class="form-control" name="area">
                                            <option value="Area 1">Area 1</option>
                                            <option value="Area 2">Area 2</option>
                                            <option value="Area 3">Area 3</option>
                                        </select>
                                        @error('area')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>No Mold</label>
                                        <select class="form-control" name="mold">
                                            <option value="No Mold 1">No Mold 1</option>
                                            <option value="No Mold 2">No Mold 2</option>
                                            <option value="No Mold 3">No Mold 3</option>
                                        </select>
                                        @error('mold')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <select class="form-control" name="position">
                                            <option value="Position 1">Position 1</option>
                                            <option value="Position 2">Position 2</option>
                                            <option value="Position 3">Position 3</option>
                                        </select>
                                        @error('position')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text"
                                            class="form-control @error('status')
                                        is-invalid
                                    @enderror"
                                            name="status">
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file"
                                    class="form-control @error('image')
                                is-invalid
                            @enderror"
                                    name="image">
                                <small class="form-text text-muted">Upload Defect image.</small>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
