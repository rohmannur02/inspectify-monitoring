@extends('layouts.app')

@section('title', 'Product Defects')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Input Defect</h1>
            <div class="section-header-button">
                <a href="{{ route('defect.create') }}"
                    class="btn btn-primary {{ Auth::user()->status == 'HOS' || Auth::user()->status == 'TL' ? "" : "
                    disabled" }}">Add New Product Defect</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Product Defect</a></div>
                <div class="breadcrumb-item">All Product Defect</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <h2 class="section-title">Manage Defect</h2>
            <p class="section-lead">
                You can manage all Product Defects, such as editing, deleting and more.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Product Defect</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                <form method="GET" action="{{ route('defect.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search By Size"
                                            name="size">
                                        <input type="text" class="form-control" placeholder="Search By Defect"
                                            name="defect">

                                        <input type="text" class="form-control" placeholder="Search By Pattern"
                                            name="pattern">

                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    @php
                                    $no = ($defects->currentPage() - 1) * $defects->perPage() + 1;
                                    @endphp
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
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($defects as $defect)
                                    @php
                                    $createdAt =
                                    \Carbon\Carbon::parse($defect->created_at)->timezone('Asia/Jakarta')->format('Y-m-d
                                    H:i:s');
                                    $updatedAt =
                                    \Carbon\Carbon::parse($defect->updated_at)->timezone('Asia/Jakarta')->format('Y-m-d
                                    H:i:s')
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
                                            <img src="{{ asset('storage/defect/'.$defect->image) }}" alt="" width="80px"
                                                height="80px" class="img-polaroid mb-2 mt-2">
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
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <a href='{{ route('defect.edit', $defect->id) }}'
                                                    class="btn btn-sm btn-info btn-icon {{ Auth::user()->status == 'HOS'
                                                    || Auth::user()->status == 'TL' ? '' : 'disabled' }}" >
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>

                                                <form action="{{ route('defect.destroy', $defect->id) }}" method="POST"
                                                    class="ml-2">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <button class="btn btn-sm btn-danger btn-icon confirm-delete" {{
                                                        Auth::user()->status !== 'HOS' ? "disabled" : null }}>
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
                                {{ $defects->withQueryString()->links() }}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
<script src="{{ asset('js/confirm-delete.js') }}"></script>

@endpush