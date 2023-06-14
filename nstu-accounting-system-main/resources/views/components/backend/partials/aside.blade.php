<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        {{-- <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">NSTU Accounting System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (($title ?? '') == 'Dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- pages --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('notices.index') }}" class="nav-link {{ (($title ?? '') == 'Notices') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Notices</p>
                    </a>
                </li> --}}

                @php
                    $isApplications = false;
                    if (!empty($title)) {
                        $loanLabels = ['Loan Applications', 'View Loan Application', 'Apply for Loan'];
                        $pensionLabels = ['Pension Applications', 'View Pension Application', 'Apply for Pension'];
                        $payoffLabels = ['Payoff Bill Applications', 'View Payoff Bill Application', 'Apply for Payoff Bill'];
                        $isLoan = in_array($title, $loanLabels);
                        $isPension = in_array($title, $pensionLabels);
                        $isPayoff = in_array($title, $payoffLabels);
                        $isApplications = $isLoan || $isPension || $isPayoff;
                    }
                @endphp

                <li class="nav-item @if ($isApplications) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Applications
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item"> --}}
                        <li class="nav-item">
                            <a href="{{ route('loans.index') }}" class="nav-link @if ($isLoan) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan</p>
                            </a>
                        </li>
                        <li class="nav-item @if ($isPayoff) active @endif">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payoff Bill</p>
                            </a>
                        </li>
                        <li class="nav-item @if ($isPension) active @endif">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pension</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ (($title ?? '') == 'Users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>

                {{-- Dropdown item --}}
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Item</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- single nav item --}}
                {{-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
