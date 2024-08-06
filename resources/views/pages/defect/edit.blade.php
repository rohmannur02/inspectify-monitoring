@extends('layouts.app')

@section('title', 'Update Product Defect')

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
                <h1>Update Product Defect</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Update Product Defect</a></div>
                    <div class="breadcrumb-item" Product>Defect</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product Defect</h2>

                <div class="card">
                    <form action="{{ route('defect.update', $defect) }}" method="POST" enctype="multipart/fortm-daa">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Update Product Defect</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <select class="form-control" name="size" id="size">
                                            <option value="" disabled selected hidden>Choose a Size</option>
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->size }}" @if($defect->size == $size->size) selected @endif>{{ $size->size }}</option>
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

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="item_code">Item Code</label>
                                        <input type="text" class="form-control" placeholder="Choose a Size and Auto Update" id="item_code" name="item_code" value="{{ $defect->item_code }}"  readonly>
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
                                        <input type="text" class="form-control" placeholder="Choose a Size and Auto Update" id="marking_line" name="marking_line" value="{{ $defect->marking_line }}"  readonly>
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
                                        <select class="form-control" name="defect">
                                            <option value="" disabled selected hidden>Choose a Defect</option>
                                            <option value="Bare" @if($defect->defect == 'Bare') selected @endif>Bare</option>
                                            <option value="Pinch Air" @if($defect->defect == 'Pinch Air') selected @endif>Pinch Air</option>
                                            <option value="Blown" @if($defect->defect == 'Blown') selected @endif>Blown</option>
                                            <option value="Injury" @if($defect->defect == 'Injury') selected @endif>Injury</option>
                                            <option value="Unloader" @if($defect->defect == 'Unloader') selected @endif>Unloader</option>
                                            <option value="Under Cure" @if($defect->defect == 'Under Cure') selected @endif>Under Cure</option>
                                            <option value="Buckle Bladder" @if($defect->defect == 'Buckle Bladder') selected @endif>Buckle Bladder</option>
                                            <option value="Steam Leak" @if($defect->defect == 'Steam Leak') selected @endif>Steam Leak</option>
                                            <option value="Foreign Material" @if($defect->defect == 'Foreign Material') selected @endif>Foreign Material</option>
                                            <option value="Other" @if($defect->defect == 'Other') selected @endif>Other</option>
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
                                            <option value="Center" @if($defect->area == 'Center') selected @endif>Center</option>
                                            <option value="Shoulder" @if($defect->area == 'Shoulder') selected @endif>Shoulder</option>
                                            <option value="Side" @if($defect->area == 'Side') selected @endif>Side</option>
                                            <option value="Bead" @if($defect->area == 'Bead') selected @endif>Bead</option>
                                            <option value="Toe Bead" @if($defect->area == 'Toe Bead') selected @endif>Toe Bead</option>
                                            <option value="Heel Bead" @if($defect->area == 'Heel Bead') selected @endif>Heel Bead</option>
                                            <option value="Sheet Bead" @if($defect->area == 'Sheet Bead') selected @endif>Sheet Bead</option>
                                            <option value="Inner" @if($defect->area == 'Inner') selected @endif>Inner</option>
                                            <option value="Multiple" @if($defect->area == 'Multiple') selected @endif>Multiple</option>
                                            <option value="Other" @if($defect->area == 'Other') selected @endif>Other</option>
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
                                        <select class="form-control" name="position">
                                            <option value="" disabled selected hidden>Choose a Position</option>
                                            <option value="Upper" @if($defect->position == 'Upper') selected @endif>Upper</option>
                                            <option value="Lower" @if($defect->position == 'Lower') selected @endif>Lower</option>
                                            <option value="Multiple" @if($defect->position == 'Multiple') selected @endif>Multiple</option>
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
                                            <option value="Repair" @if($defect->status == 'Repair') selected @endif>Repair</option>
                                            <option value="Scrap" @if($defect->status == 'Scrap') selected @endif>Scrap</option>
                                            <option value="Hold" @if($defect->status == 'Hold') selected @endif>Hold</option>
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

                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control"  id="author" name="author"  readonly value="{{ $defect->author }}">
                                @error('author')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" >Update Product Defect</button>
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
                    document.getElementById('item_code').value = products[i].item_code;
                    document.getElementById('marking_line').value = products[i].marking_line;

                    break;
                }
            }
        }

        document.getElementById('size').addEventListener('change', function() {
            var selectedSize = this.value;
            updateFields(selectedSize);
        });

        // Saat halaman pertama kali dimuat, perbarui field jika size sudah dipilih
        window.onload = function() {
            var selectedSize = document.getElementById('size').value;
            if (selectedSize) {
                updateFields(selectedSize);
            }
        }

</script>
@endpush
