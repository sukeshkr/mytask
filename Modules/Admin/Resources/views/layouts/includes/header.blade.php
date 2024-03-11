<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('admin-asset/assets/img/logo/ma-logo.jpeg') }}" alt="">
            </span>

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li
            class="menu-item {{ request()->is('admin/companies*') || request()->is('admin/companies*') ? 'active open' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Companies</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/companies/create*') ? 'active' : '' }}">
                    <a href="{{route('admin.companies.create')}}" class="menu-link">
                        <div data-i18n="Without menu">Create</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/companies*') ? 'active' : '' }}">
                    <a href="{{route('admin.companies.index')}}" class="menu-link">
                        <div data-i18n="Without navbar">List</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item {{ request()->is('admin/employees*') || request()->is('admin/roles*') ? 'active open' : '' }} ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Employees</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/employees/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.employees.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Create</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/employees*') ? 'active' : '' }}">
                    <a href="{{ route('admin.employees.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">List</div>
                    </a>
                </li>

            </ul>
        </li>


        <li class="menu-item {{ request()->is('admin/logout*') ? 'active' : '' }}">
            <a href="{{ route('admin.logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">LogOut</div>
            </a>
        </li>

    </ul>
</aside>
