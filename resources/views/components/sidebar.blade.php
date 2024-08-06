{{-- @extends('layouts.auth') --}}

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div>
            <a href="{{ route('home') }}">
        </div>
        <!-- Logo Section -->
        <div class="login-brand">
            <img src="{{ asset('img/inspectify-high-resolution-logo-transparent.png') }}" alt="logo" width="200"
                height="200">
            </a>
        </div>
        <!-- End Logo Section -->
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">GT</a>
        </div>


        <ul class="sidebar-menu">
            <li class="menu-header">Halaman Utama</li>

            <li class="nav-item dropdown ">

                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is(' dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('dashboard.index') }}">General Dashboard</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item dropdown ">

                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>User</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is(' user.index') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('user.index') }}">Kelola User</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">

                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-exclamation-triangle"></i><span>Defect</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is(' defect.index') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('defect.index') }}">Kelola Data Defect</a>
                    </li>
                    <li class='{{ Request::is(' standarisasi') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('standarisasi') }}">Standarisasi Defect Produk</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">

                <a href="#" class="nav-link has-dropdown"><i class="fas fa-industry"></i><span>Laporan
                        Produksi</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is(' production.index') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('production.index') }}">Input Laporan Produksi</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">

                <a href="#" class="nav-link has-dropdown"><i class="fas fa-box-open"></i><span>Kelola Produk</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is(' product.index') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('product.index') }}">Semua Produk</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">

                <a href="#" class="nav-link has-dropdown"><i class="fas fa-calculator"></i><span>
                        Laporan Inspeksi</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is(' report') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('report.report_by_defect') }}">Report Data Defect</a>
                    </li>

                    <li class='{{ Request::is(' report') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('report.customize_defect') }}">Customize Report</a>
                    </li>
                </ul>
            </li>

        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="{{ route('defect.create') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-plus"></i> INPUT DEFECT
            </a>
        </div>
    </aside>
</div>