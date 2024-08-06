@extends('layouts.app')

@section('title', 'Profile')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
<!-- Custom CSS -->
<style>
    .info-group {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        /* Light grey background for better separation */
    }

    .info-group strong {
        display: block;
        font-weight: 700;
        font-size: 1.1rem;
        /* Adjusted font size */
        color: #333;
        /* Darker color for titles */
    }

    .info-group p {
        font-size: 1.1rem;
        /* Adjusted font size */
        margin: 0;
        color: #371aa9;
        /* Lighter color for content */
    }

    .alert-custom {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 8;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Profile</a></div>
                <div class="breadcrumb-item active">Dashboard</div>
            </div>
        </div>
        <div class="row mt-sm-4 justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header d-flex justify-content-center">
                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                            class="rounded-circle profile-widget-picture ">
                    </div>
                    <div class="card-body">
                        <div class="profile-info">
                            <div class="info-group">
                                <strong>Nama:</strong>
                                <p>{{ auth()->user()->name }}</p>
                            </div>
                            <div class="info-group">
                                <strong>NIK:</strong>
                                <p>{{ auth()->user()->nik }}</p>
                            </div>
                            <div class="info-group">
                                <strong>Email:</strong>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                            <div class="info-group">
                                <strong>Status:</strong>
                                <p>{{ auth()->user()->status }}</p>
                            </div>
                            <div class="info-group">
                                <strong>Group:</strong>
                                <p>{{ auth()->user()->group }}</p>
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
<script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
@endpush