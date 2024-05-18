@extends('layouts.app')

@section('title', 'Edit Defect')

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
                <h1>Update Defect</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Update Defect</a></div>
                    <div class="breadcrumb-item">Defect</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Defect</h2>

                <div class="card">
                    <form action="{{ route('defect.update', $defect) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Update Defect</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <input type="text"
                                            class="form-control @error('size')
                                        is-invalid
                                    @enderror"
                                            name="size" value="{{ $defect->size }}">
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
                                        <input type="text"
                                            class="form-control @error('pattern')
                                        is-invalid
                                    @enderror"
                                            name="pattern" value="{{ $defect->pattern }}">
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
                                        <input type="text"
                                            class="form-control @error('serial')
                                        is-invalid
                                    @enderror"
                                            name="serial" value="{{ $defect->serial }}">
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
                                        <input type="text"
                                            class="form-control @error('defect')
                                        is-invalid
                                    @enderror"
                                            name="defect" value="{{ $defect->defect }}">
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
                                        <input type="text"
                                            class="form-control @error('area')
                                        is-invalid
                                    @enderror"
                                            name="area" value="{{ $defect->area }}">
                                        @error('area')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Mold</label>
                                        <input type="text"
                                            class="form-control @error('mold')
                                        is-invalid
                                    @enderror"
                                            name="mold" value="{{ $defect->mold }}">
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
                                        <input type="text"
                                            class="form-control @error('position')
                                        is-invalid
                                    @enderror"
                                            name="position" value="{{ $defect->position }}">
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
                                            name="status" value="{{ $defect->status }}">
                                        @error('status')
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
                                        <label class="mr-5">Image</label>
                                        <img src="{{ asset('storage/defect/'.$defect->image) }}" class="img-thumbnail" alt="{{ $defect->size }}" width="300" height="300">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Update Image</label>
                                        <input type="file"
                                            class="form-control @error('image')
                                        is-invalid
                                    @enderror"
                                            name="image" value="{{ 'storage/defect/'.$defect->image }}">
                                        <small class="form-text text-muted">Update defect image.</small>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" >Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
