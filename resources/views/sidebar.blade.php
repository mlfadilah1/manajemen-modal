<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('template') }}/assets/images/logos/mrhoyy.png" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @if (Auth::user()->role == 'Admin')
                <li class="nav-small-cap">
                    <i class="ti ti-home nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="home" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-settings nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Fitur</span>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="user" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Manajemen User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="pendapatan" aria-expanded="false">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">Pencatatan Pendapatan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="operasional" aria-expanded="false">
                        <span>
                            <i class="ti ti-building"></i>
                        </span>
                        <span class="hide-menu">Manajemen Operasional</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="modal" aria-expanded="false">
                        <span>
                            <i class="ti ti-wallet"></i>
                        </span>
                        <span class="hide-menu">Manajemen Modal</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="produk" aria-expanded="false">
                        <span>
                            <i class="ti ti-package"></i>
                        </span>
                        <span class="hide-menu">Manajemen Produk</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="analisis" aria-expanded="false">
                        <span>
                            <i class="ti ti-chart-line"></i>
                        </span>
                        <span class="hide-menu">Analisis BEP & ROI</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="laporan" aria-expanded="false">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Laporan Keuangan</span>
                    </a>
                </li>
                @else
                
                @endif
                @if (Auth::user()->role == 'Staff')
                <li class="nav-small-cap">
                    <i class="ti ti-home nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-settings nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Fitur</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="pendapatan" aria-expanded="false">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">Pencatatan Pendapatan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="operasional" aria-expanded="false">
                        <span>
                            <i class="ti ti-building"></i>
                        </span>
                        <span class="hide-menu">Manajemen Operasional</span>
                    </a>
                </li>
                @else
                    
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
