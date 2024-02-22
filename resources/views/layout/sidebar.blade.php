<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">LAZNUHA</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <li class="sidebar-item @yield('home')">
                <a class="sidebar-link" href=" {{ url('home') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item @yield('donatur')">
                <a class="sidebar-link" href=" {{ route('donaturs.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Donatur</span>
                </a>
            </li>




            <li class="sidebar-header">
                Laporan
            </li>

            <li class="sidebar-item @yield('laporan')">
                <a class="sidebar-link " href=" {{ url('transactions') }} ">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Transaksi</span>
                </a>
            </li>



            <li class="sidebar-header">
                Lainnya
            </li>

            <li class="sidebar-item @yield('donatur-rekap')">
                <a class="sidebar-link" href="{{ route('donatur.rekap', []) }}">
                    <i class="align-middle" data-feather="printer"></i> <span class="align-middle">Export</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
        </div>
    </div>
</nav>
