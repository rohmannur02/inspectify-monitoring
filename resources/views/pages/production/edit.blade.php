@extends('layouts.app')

@section('title', 'Update Production')

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
                <h1>Update Production Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Update Production Product</a></div>
                    <div class="breadcrumb-item">Production Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Production Product</h2>



                <div class="card">
                    <form action="{{ route('production.update', $productions) }}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Update Production Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <select class="form-control" name="size" id="size">
                                            <option value="" disabled selected hidden>Choose a Size</option>
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->size }}" @if($productions->size == $size->size) selected @endif>{{ $size->size }}</option>
                                            @endforeach
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
                                        <label for="pattern">Pattern</label>
                                        <input type="text" class="form-control"  id="pattern" name="pattern" readonly>
                                        @error('pattern')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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

                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control"  id="author" name="author"  readonly value="{{ $productions->author }}">
                                @error('author')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update Production Product</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        var products = {!! json_encode($products) !!};

        function updateFields(selectedSize) {
            for (var i = 0; i < products.length; i++) {
                if (products[i].size === selectedSize) {
                    document.getElementById('pattern').value = products[i].pattern;

                    break;
                }
            }
        }

        document.getElementById('size').addEventListener('change', function() {
            var selectedSize = this.value;
            updateFields(selectedSize);
        });

        window.onload = function() {
            var selectedSize = document.getElementById('size').value;
            if (selectedSize) {
                updateFields(selectedSize);
            }
        }
    </script>
@endpush
