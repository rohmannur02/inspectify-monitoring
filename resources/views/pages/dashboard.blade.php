@extends('layouts.app')

@section('title', 'General Dashboard')

{{-- @push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush --}}

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard - Inspectify</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-box"></i>
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
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Defects</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalDefects . " Defects" }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Product Productions</h4>
                            <div class="card-header-action">
                                <a href="{{ route('production.index') }}"
                                    class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Production ID</th>
                                            <th>Schedule Production</th>
                                            <th>Actual Production</th>
                                            <th>Shift</th>
                                            <th>Group</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestProductions as $production)
                                            @php
                                                $date_transaction = \Carbon\Carbon::parse($production->transaction_time)->timezone('Asia/Jakarta')->format('H:i:s l, d M Y');

                                                $createdAt = \Carbon\Carbon::parse($production->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                                                $updatedAt = \Carbon\Carbon::parse($production->updated_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
                                            @endphp

                                            <tr>
                                                <td>{{ $production->id }}</td>
                                                <td>{{ $production->schedule }}</td>
                                                <td>{{ $production->actual }}</td>
                                                <td>{{ $production->shift }}</td>
                                                <td>{{ $production->group }}</td>
                                                <td>
                                                    {{ $createdAt}}
                                                </td>
                                                <td>
                                                    {{ $updatedAt == $createdAt ? "-" : $updatedAt }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
             </div>

        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script> --}}
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    {{-- <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script> --}}
    {{-- <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script> --}}

    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('js/page/index-0.js') }}"></script> --}}


@endpush
