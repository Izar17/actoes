<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard.index') }}"
                    class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}"
                                    class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}"
                                    class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('team_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.teams.index') }}"
                                    class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-users nav-icon">

                                    </i>
                                    {{ trans('cruds.team.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('hospital_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.hospitals.index') }}"
                                    class="nav-link {{ request()->is('admin/hospitals') || request()->is('admin/hospitals/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    {{ trans('cruds.hospital.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('asset_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.assetManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('isotope_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.assets.index') }}"
                                    class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    {{ trans('cruds.asset.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('product_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.stocks.index') }}"
                                    class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-cogs nav-icon">

                                    </i>
                                    {{ trans('cruds.stock.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('asset_orders_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.assetOrder.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('order_create')
                            <li class="nav-item">
                                <a href="{{ route('admin.transactions.create') }}"
                                    class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-shopping-cart nav-icon"></i>
                                    {{ trans('global.create') }} {{ trans('cruds.transaction.order_title_singular') }}
                                </a>
                            </li>
                        @endcan
                        @can('order_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.transactions.index') }}"
                                    class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-shopping-cart nav-icon"></i>
                                    {{ trans('global.view') }} {{ trans('cruds.transaction.order_title') }}
                                </a>
                            </li>
                        @endcan
                        @can('cancelled_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.cancelled.index') }}"
                                    class="nav-link {{ request()->is('admin/cancelled') || request()->is('admin/cancelled/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-file nav-icon"></i>
                                    {{ trans('cruds.cancel.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('production_access')
                <li class="nav-item">
                    <a href="{{ route('admin.productions.index') }}"
                        class="nav-link {{ request()->is('admin/productions') || request()->is('admin/productions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-file nav-icon"></i>
                        {{ trans('cruds.production.title') }}
                    </a>
                </li>
            @endcan
            @can('drsi_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-file nav-icon"></i>
                        {{ trans('cruds.drsi.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route('admin.drsis.index') }}"
                                class="nav-link {{ request()->is('admin/drsis') || request()->is('admin/drsis/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file nav-icon"></i>
                                {{ trans('cruds.drsi.hospital') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.printdrsi.index') }}"
                                class="nav-link {{ request()->is('admin/printdrsi') || request()->is('admin/printdrsi/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file nav-icon"></i>
                                {{ trans('cruds.drsi.print') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.drsis.index') }}"
                                class="nav-link {{ request()->is('admin/drsis') || request()->is('admin/drsis/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file nav-icon"></i>
                                {{ trans('cruds.drsi.dr') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.drsis.index') }}"
                                class="nav-link {{ request()->is('admin/drsis') || request()->is('admin/drsis/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file nav-icon"></i>
                                {{ trans('cruds.drsi.si') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('report_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-file nav-icon"></i>
                        {{ trans('cruds.report.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route('admin.reports.index') }}"
                                class="nav-link {{ request()->is('admin/reports') || request()->is('admin/reports/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file nav-icon"></i>
                                {{ trans('cruds.report.title_print') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.records.index') }}"
                                class="nav-link {{ request()->is('admin/reports/records') || request()->is('admin/reports/records/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-file nav-icon"></i>
                                {{ trans('cruds.report.title_record') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                            href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
