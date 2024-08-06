@extends('layouts.app')

@section('title', 'General Dashboard')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard - INSPECTIFY</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Users</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalUsers . " Users" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-industry"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Productions</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalProductions . " Productions" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Defects</h4>
                        </div>
                        <div class="card-body col">
                            {{ $totalDefects . " Defects" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-warning"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Repair & Scrap Defect</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalRepair . " Repair" }},
                            {{ $totalScrap . " Scrap" }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Trend Defect Products</h4>
                        <div class="card-header-action">
                            <a href="{{ route('defect.index') }}" class="btn btn-primary">Lihat Semua Data Defect</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-striped mb-0 table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Size Product</th>
                                        <th>Pattern</th>
                                        <th>Defect</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($trendDefects as $defect)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $defect->size }}</td>
                                        <td>{{ $defect->pattern }}</td>
                                        <td>{{ $defect->defect }}</td>
                                        <td>{{ $defect->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Chart Container -->
                        <div class="mt-4">
                            <div id="chart-data" data-labels="{{ json_encode($trendDefects->pluck('size')) }}"
                                data-data="{{ json_encode($trendDefects->pluck('total')) }}"></div>
                            <canvas id="defectTrendChart"></canvas>
                        </div>
                        <!-- End Chart Container -->
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/dashboard-chart.js') }}"></script>


@endpush