@extends('layouts.app')

@section('title', 'Create Product Defect')

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
                <h1>Create a new Product Defect</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">New Forms</a></div>
                    <div class="breadcrumb-item">Product Defect</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product Defect</h2>
                <div class="card">
                    <form action="{{ route('defect.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input a new Product Defect</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <select class="form-control" name="size" id="size">
                                            <option value="" disabled selected hidden>Choose a Size</option>
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->size }}">{{ $size->size }}</option>
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
                                        <input type="text" class="form-control" placeholder="Choose a Size and Auto Update" id="pattern" name="pattern" readonly>
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
                                        <label for="item_code">Item Code</label>
                                        <input type="text" placeholder="Choose a Size and Auto Update" class="form-control" id="item_code" name="item_code" readonly>
                                        @error('item_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="marking_line">Marking Line</label>
                                        <input type="text" placeholder="Choose a Size and Auto Update" class="form-control" id="marking_line" name="marking_line" readonly>
                                        @error('marking_line')
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
                                        <label>Serial</label>
                                        <input type="text"
                                        placeholder="Input Serial"
                                            class="form-control @error('serial')
                                        is-invalid
                                    @enderror"
                                            name="serial">
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
                                            <option value="" disabled selected hidden>Choose a Defect</option>
                                            <option value="Bare">Bare</option>
                                            <option value="Pinch Air">Pinch Air</option>
                                            <option value="Blown">Blown</option>
                                            <option value="Injury">Injury</option>
                                            <option value="Unloader">Unloader</option>
                                            <option value="Under Cure">Under Cure</option>
                                            <option value="Buckle Bladder">Buckle Bladder</option>
                                            <option value="Steam Leak">Steam Leak</option>
                                            <option value="Foreign Material">Foreign Material</option>
                                            <option value="Other">Other</option>
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
                                            <option value="" disabled selected hidden>Choose a Area</option>
                                            <option value="Center">Center</option>
                                            <option value="Shoulder">Shoulder</option>
                                            <option value="Side">Side</option>
                                            <option value="Bead">Bead</option>
                                            <option value="Toe Bead">Toe Bead</option>
                                            <option value="Heel Bead">Heel Bead</option>
                                            <option value="Sheet Bead">Sheet Bead</option>
                                            <option value="Inner">Inner</option>
                                            <option value="Multiple">Multiple</option>
                                            <option value="Other">Other</option>
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
                                        <label>Mold</label>
                                        <input type="text" placeholder="Input Mold"
                                            class="form-control @error('mold')
                                        is-invalid
                                    @enderror"
                                            name="mold">
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
                                            <option value="" disabled selected hidden>Choose a Position</option>
                                            <option value="Upper">Upper</option>
                                            <option value="Lower">Lower</option>
                                            <option value="Multiple">Multiple</option>
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
                                        <select class="form-control" name="status">
                                            <option value="" disabled selected hidden>Choose a Status</option>
                                            <option value="Repair">Repair</option>
                                            <option value="Scrap">Scrap</option>
                                            <option value="Hold">Hold</option>
                                        </select>
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
                                <div class="col">
                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="hidden" id="username" value="{{ auth()->user()->name }}">
                                        <input type="text" id="author" name="author" readonly
                                            class="form-control @error('author')
                                        is-invalid
                                    @enderror"
                                            name="author">
                                        @error('author')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Create Product Defect</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        var sizes = {!! json_encode($sizes) !!};
        var products = {!! json_encode($products) !!};

        // Script to handle size dropdown change event
        document.getElementById('size').addEventListener('change', function() {
            var selectedSize = this.value;
            for (var i = 0; i < products.length; i++) {
                if (products[i].size === selectedSize) {
                    document.getElementById('pattern').value = products[i].pattern;
                    document.getElementById('item_code').value = products[i].item_code;
                    document.getElementById('marking_line').value = products[i].marking_line;

                    break;
                }
            }
        });

        window.onload = function() {
            var username = document.getElementById('username').value;
            var authorField = document.getElementById('author');

            if (username) {
                var currentDateTime = new Date();
                var formattedDateTime = currentDateTime.getFullYear() + '-' +
                                        ('0' + (currentDateTime.getMonth() + 1)).slice(-2) + '-' +
                                        ('0' + currentDateTime.getDate()).slice(-2) + ' ' +
                                        ('0' + currentDateTime.getHours()).slice(-2) + ':' +
                                        ('0' + currentDateTime.getMinutes()).slice(-2) + ':' +
                                        ('0' + currentDateTime.getSeconds()).slice(-2);

                var authorValue = username + '/' + formattedDateTime;
                authorField.value = authorValue;
            }
        };
    </script>
@endpush
