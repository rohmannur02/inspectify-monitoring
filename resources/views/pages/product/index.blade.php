@extends('layouts.app')

@section('title', 'product')

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
                    <a href="{{ route('product.create') }}"
                        class="btn btn-primary {{ Auth::user()->status == 'HOS' || Auth::user()->status == 'TL' ? "" : "disabled" }}">Add New product</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Product</a></div>
                    <div class="breadcrumb-item">All Products</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Products</h2>
                <p class="section-lead">
                    You can manage all Products, such as editing, deleting and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Products</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <form method="GET" action="{{ route('product.index') }}">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search By Schedule" name="size">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>


                                </div>

                                <div class="btn flex mt-10">
                                    <a href="{{ route('product.index') }}"
                                        class="btn btn-primary">Reset Search</a>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        @php
                                            $no = ($products->currentPage() - 1) * $products->perPage() + 1;
                                        @endphp
                                        <tr>
                                            <th>No</th>
                                            <th>Size</th>
                                            <th>Pattern</th>
                                            <th>Item Code</th>
                                            <th>Marking Line</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($products as $product)
                                            @php
                                                $createdAt = \Carbon\Carbon::parse($product->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                                                $updatedAt = \Carbon\Carbon::parse($product->updated_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s')
                                            @endphp

                                            <tr>
                                                <td>
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    {{ $product->size }}
                                                </td>
                                                <td>
                                                    {{ $product->pattern }}
                                                </td>
                                                <td>
                                                    {{ $product->item_code }}

                                                </td>
                                                <td>
                                                    {{ $product->marking_line }}
                                                </td>
                                                <td>
                                                    {{ $createdAt }}
                                                </td>
                                                <td>
                                                    {{ $updatedAt == $createdAt ? "-" : $updatedAt }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <a href='{{ route('product.edit', $product->id) }}'
                                                            class="btn btn-sm btn-info btn-icon {{ Auth::user()->status == 'HOS' || Auth::user()->status == 'TL' ? '' : 'disabled' }}" >
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST"
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
                                    {{ $products->withQueryString()->links() }}
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

