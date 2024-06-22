@extends('layouts.app')

@section('title', 'Report Defects')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Report Data Defect by Date Range</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Report</a></div>
                    <div class="breadcrumb-item">Report Defects</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Report Defects</h2>
                <p class="section-lead">
                    You can view Report All Data Defect or selected date range.
                </p>

                <form action="{{ route('report.report_by_defect') }}" method="GET" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate ?? '' }}">
                        </div>
                        <div class="col">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate ?? '' }}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary mt-4">Filter</button>

                            @if ($startDate != '' && $endDate != '')
                                <a href="{{ route('report.report_by_defect') }}" class="btn btn-danger mt-4">Clear Filter</a>
                            @endif
                        </div>
                    </div>
                </form>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if ($startDate != '' && $endDate != '')
                                    <h4>Report by Data Defect {{ \Carbon\Carbon::parse($startDate)->isoFormat('DD MMMM YYYY') }} - {{ \Carbon\Carbon::parse($endDate)->isoFormat('DD MMMM YYYY') }}</h4>
                                    <form action="{{ route('export.defects') }}" method="GET" class="d-inline">
                                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                                        <button type="submit" class="btn btn-success">Export to Excel</button>
                                    </form>
                                @else
                                    <h4>Report All Data Defects</h4>
                                    <form action="{{ route('export.defects') }}" method="GET" class="d-inline">
                                        <input type="hidden" name="start_date" value="">
                                        <input type="hidden" name="end_date" value="">
                                        <button type="submit" class="btn btn-success">Export to Excel</button>
                                    </form>
                                @endif
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Author</th>
                                                <th>Size</th>
                                                <th>Pattern</th>
                                                <th>Item Code</th>
                                                <th>Serial</th>
                                                <th>Defect</th>
                                                <th>Area</th>
                                                <th>Mold</th>
                                                <th>Position</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = ($defects->currentPage() - 1) * $defects->perPage() + 1;
                                            @endphp

                                            @foreach ($defects as $defect)
                                                @php
                                                    $createdAt = \Carbon\Carbon::parse($defect->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                                                    $updatedAt = \Carbon\Carbon::parse($defect->updated_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ $no++ }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->author }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->size }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->pattern }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->item_code }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->serial }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->defect }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->area }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->mold }}
                                                    </td>
                                                    <td>
                                                        {{ $defect->position }}
                                                    </td>
                                                    <td>
                                                        @if ($defect->image)
                                                            <img src="{{ asset('storage/defect/'.$defect->image) }}" alt=""
                                                                width="80px" height="80px" class="img-polaroid mb-2 mt-2">
                                                        @else
                                                            <span class="badge badge-danger">No Image</span>

                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $defect->status }}
                                                    </td>
                                                    <td>
                                                        {{ $createdAt }}
                                                    </td>
                                                    <td>
                                                        {{ $updatedAt == $createdAt ? "-" : $updatedAt }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $defects->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>

    <script>
        function validateForm() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            if (!startDate || !endDate) {
                alert('Please enter a date range');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
@endpush
