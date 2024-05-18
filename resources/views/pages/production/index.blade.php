@extends('layouts.app')

@section('title', 'Production')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Products</h1>
                <div class="section-header-button">
                    <a href="{{ route('production.create') }}"
                        class="btn btn-primary {{ Auth::user()->status == 'HOS' || Auth::user()->status == 'TL' ? "" : "disabled" }}">Add New Production</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Production</a></div>
                    <div class="breadcrumb-item">All Productions</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Productions</h2>
                <p class="section-lead">
                    You can manage all Productions, such as editing, deleting and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Production</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <form method="GET" action="{{ route('production.index') }}">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search By Schedule" name="schedule">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>


                                </div>

                                <div class="btn flex mt-10">
                                    <a href="{{ route('production.index') }}"
                                        class="btn btn-primary">Reset Search</a>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        @php
                                            $no = ($productions->currentPage() - 1) * $productions->perPage() + 1;
                                        @endphp
                                        <tr>
                                            <th>No</th>
                                            <th>Schedule Production</th>
                                            <th>Actual Production</th>
                                            <th>Shift</th>
                                            <th>Group</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($productions as $production)
                                            @php
                                                $createdAt = \Carbon\Carbon::parse($production->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                                                $updatedAt = \Carbon\Carbon::parse($production->updated_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
                                            @endphp

                                            <tr>
                                                <td>
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    {{ $production->schedule }}
                                                </td>
                                                <td>
                                                    {{ $production->actual }}
                                                </td>
                                                <td>
                                                    {{ $production->shift }}

                                                </td>
                                                <td>
                                                    {{ $production->group }}
                                                </td>
                                                <td>
                                                    {{ $createdAt }}
                                                </td>
                                                <td>
                                                    {{ $updatedAt == $createdAt ? "-" : $updatedAt }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <a href='{{ route('production.edit', $production->id) }}'
                                                            class="btn btn-sm btn-info btn-icon {{ Auth::user()->status == 'HOS' || Auth::user()->status == 'TL' ? '' : 'disabled' }}" >
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('production.destroy', $production->id) }}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete"
                                                            {{ Auth::user()->status !== 'HOS' ? "disabled" : null }}>
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $productions->withQueryString()->links() }}
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush

