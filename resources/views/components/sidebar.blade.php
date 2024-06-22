<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Inspectify</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">GT</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="nav-item dropdown ">

                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('dashboard.index') }}">General Dashboard</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item dropdown ">

                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('user.index') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('user.index') }}">All Users</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">

                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-exclamation-triangle"></i><span>Defects</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('defect.index') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('defect.index') }}">All Defects</a>
                    </li>

                </ul>
            </li>

             <li class="nav-item dropdown ">

                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-industry"></i><span>Productions</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('production.index') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('production.index') }}">All Productions</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">

                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-box-open"></i><span>Products</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('product.index') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('product.index') }}">All Products</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown ">

                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-calculator"></i><span>Manage Report</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('report') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('report.report_by_defect') }}">Report Data Defect</a>
                    </li>

                    <li class='{{ Request::is('report') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('report.customize_defect') }}">Customize Data Defect</a>
                    </li>
                </ul>
            </li>

        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="{{ route('home') }}"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Inspectify
            </a>
        </div>
    </aside>
</div>
