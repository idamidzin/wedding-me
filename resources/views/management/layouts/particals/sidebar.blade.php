<aside class="main-sidebar sidebar-dark-blue elevation-4">
    <a href="{{ route('mgt.dashboard') }}" class="brand-link navbar-blue">
        <strong>Wedding</strong>
        <span class="brand-text font-weight-light text-light">Administrator</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            @php $adminPrefix = 'mgt' @endphp
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Menu Utama</li>
                <li class="nav-item">
                    <a href="{{ route('mgt.dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mgt.gift.index') }}" class="nav-link {{ request()->is($adminPrefix.'/gift*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-microchip"></i>
                        <p>Hadiah</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>