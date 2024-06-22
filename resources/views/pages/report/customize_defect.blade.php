@extends('layouts.app')

@section('title', 'Customize Report Defect')

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
                <h1>Customize Report Defects</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Report</a></div>
                    <div class="breadcrumb-item">Customize Defects</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Report Defect</h2>
                <div class="card">
                    <form action="{{ route('defect.generateCustomizeReport') }}" method="GET">
                        @csrf
                        <div class="card-header">
                            <h4>Input a new Customize Report Defect</h4>
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



                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Generate Customize Report Defects</button>
                        </div>
                    </form>
                </div>

                @if(isset($defects))
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header justify-content-between">
                                    <div class="">
                                        <h4>{{ $headerTable }}</h4>
                                        <form action="{{ route('export.customize_defect') }}" method="GET" class="d-inline">
                                            <input type="hidden" name="size" value="{{ request('size') }}">
                                            <input type="hidden" name="pattern" value="{{ request('pattern') }}">
                                            <input type="hidden" name="item_code" value="{{ request('item_code') }}">
                                            <input type="hidden" name="defect" value="{{ request('defect') }}">
                                            <input type="hidden" name="qty" value="{{ request('qty') }}">
                                            <button type="submit" class="btn btn-success">Export to Excel</button>
                                        </form>
                                    </div>
                                    <form action="{{ route('report.customize_defect') }}" method="GET">
                                        <button type="submit" class="btn btn-danger">Clear Filtered Data</button>
                                    </form>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Size</th>
                                                    <th>Pattern</th>
                                                    <th>Item Code</th>
                                                    <th>Defect</th>
                                                    <th>Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($defects->isEmpty())
                                                    <tr>
                                                        <td colspan="6" class="text-center">No Data Found</td>
                                                    </tr>
                                                @else
                                                    @php $no = 1; @endphp
                                                    @foreach ($defects as $defect)
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $defect->size }}</td>
                                                            <td>{{ $defect->pattern }}</td>
                                                            <td>{{ $defect->item_code }}</td>
                                                            <td>{{ $defect->defect }}</td>
                                                            <td>{{ $defect->qty }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        var sizes = {!! json_encode($sizes) !!};
        var products = {!! json_encode($products) !!};

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
    </script>
@endpush
