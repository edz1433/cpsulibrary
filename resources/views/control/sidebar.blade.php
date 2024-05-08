@php
    $current_route=request()->route()->getName();
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column bg-none" style="margin-left: -20px;" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item mt-1">
            <a href="{{ route('dashboard') }}" class="nav-link pt-2 {{ request()->is('*dashboard*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item mt-1">
            <a href="{{ route('monitorRead') }}" class="nav-link pt-2  {{ request()->is('*monitoring*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Monitoring
                </p>
            </a>
        </li>

        <li class="nav-item mt-1">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-file-lines"></i>
                <p>
                    Reports
                </p>
            </a>
        </li>

        <li class="nav-item mt-1">
            <a href="{{ route('userRead') }}" class="nav-link pt-2 {{ request()->is('*user*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Users
                </p>
            </a>
        </li>

        <li class="nav-item mt-1">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Settings
                </p>
            </a>
        </li>
    </ul>
</nav>