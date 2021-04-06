@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            
            @can('users_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span class="title">IT BA</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'billpayment' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.billpayment.index') }}">
                            <i class="fa fa-cc-visa"></i>
                            <span class="title">Other Bill & Payment List</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'pks' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.pks.index') }}">
                            <i class="fa fa-barcode"></i>
                            <span class="title">
                                PKS List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'po' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.po.index') }}">
                            <i class="fa fa-clipboard"></i>
                            <span class="title">
                                PO List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'vendors_non_app' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.vendors_non_app.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Vendor Non Application List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-desktop"></i>
                    <span class="title">IT Development</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'applications' ? 'active active-sub' : '' }}">
                        <a href="{{ route('dev.applications.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Application List
                            </span>
                        </a>
                    </li>
                    <!-- <li class="{{ $request->segment(2) == 'applications' ? 'active active-sub' : '' }}">
                        <a href="{{ route('dev.applications.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Architecture
                            </span>
                        </a>
                    </li> -->
                    <li class="{{ $request->segment(2) == 'applications_enhancement' ? 'active active-sub' : '' }}">
                        <a href="{{ route('dev.applications_enhancement.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Application Enhancement List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-headphones"></i>
                    <span class="title">IT Helpdesk</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'hardware' ? 'active active-sub' : '' }}">
                        <a href="{{ route('helpdesk.hardware.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Hardware List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'recap' ? 'active active-sub' : '' }}">
                        <a href="{{ route('helpdesk.recap.index') }}">
                            <i class="fa fa-archive"></i>
                            <span class="title">
                                IT Helpdesk App Recap
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'server' ? 'active active-sub' : '' }}">
                        <a href="{{ route('helpdesk.server.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Server List
                            </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-plug"></i>
                    <span class="title">IT Network & Security</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'branch' ? 'active active-sub' : '' }}">
                        <a href="{{ route('sec.branch.index') }}">
                            <i class="fa fa-building"></i>
                            <span class="title">
                                Branch of Bank Index List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'license' ? 'active active-sub' : '' }}">
                        <a href="{{ route('sec.license.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                License List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Parameter</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'dc' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.dc.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Data Center List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'hardwares' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.hardwares.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Hardware List
                            </span>
                        </a>
                    </li>
                    <!-- <li class="{{ $request->segment(2) == 'pic' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pic.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                PIC List
                            </span>
                        </a>
                    </li> -->
                    <li class="{{ $request->segment(2) == 'pkstype' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pkstype.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                PKS Type List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'status' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.status.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Status Parameter List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'vendor' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.vendor.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Vendor List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            @endcan

            @can('users_ba')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span class="title">IT BA</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'billpayment' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.billpayment.index') }}">
                            <i class="fa fa-cc-visa"></i>
                            <span class="title">Other Bill & Payment List</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'pks' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.pks.index') }}">
                            <i class="fa fa-barcode"></i>
                            <span class="title">
                                PKS List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'po' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.po.index') }}">
                            <i class="fa fa-clipboard"></i>
                            <span class="title">
                                PO List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'vendors_non_app' ? 'active active-sub' : '' }}">
                        <a href="{{ route('ba.vendors_non_app.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Vendor Non Application List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Parameter</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'pkstype' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pkstype.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                PKS Type List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'status' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.status.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Status Parameter List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            @endcan

            @can('users_helpdesk')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-headphones"></i>
                    <span class="title">IT Helpdesk</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'hardware' ? 'active active-sub' : '' }}">
                        <a href="{{ route('helpdesk.hardware.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Hardware List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'recap' ? 'active active-sub' : '' }}">
                        <a href="{{ route('helpdesk.recap.index') }}">
                            <i class="fa fa-archive"></i>
                            <span class="title">
                                IT Helpdesk App Recap
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'server' ? 'active active-sub' : '' }}">
                        <a href="{{ route('helpdesk.server.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Server List
                            </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Parameter</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'dc' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.dc.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Data Center List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'hardwares' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.hardwares.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Hardware List
                            </span>
                        </a>
                    </li>
                    <!-- <li class="{{ $request->segment(2) == 'pic' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pic.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                PIC List
                            </span>
                        </a>
                    </li> -->
                    <li class="{{ $request->segment(2) == 'pkstype' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pkstype.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                PKS Type List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'status' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.status.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Status Parameter List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'vendor' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.vendor.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Vendor List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            @endcan

            @can('users_development')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-desktop"></i>
                    <span class="title">IT Development</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'applications' ? 'active active-sub' : '' }}">
                        <a href="{{ route('dev.applications.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Application List
                            </span>
                        </a>
                    </li>
                    <!-- <li class="{{ $request->segment(2) == 'applications' ? 'active active-sub' : '' }}">
                        <a href="{{ route('dev.applications.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Architecture
                            </span>
                        </a>
                    </li> -->
                    <li class="{{ $request->segment(2) == 'applications_enhancement' ? 'active active-sub' : '' }}">
                        <a href="{{ route('dev.applications_enhancement.index') }}">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Application Enhancement List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Parameter</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'dc' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.dc.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Data Center List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'hardware' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.hardwares.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Hardware List
                            </span>
                        </a>
                    </li>
                    <!-- <li class="{{ $request->segment(2) == 'pic' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pic.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                PIC List
                            </span>
                        </a>
                    </li> -->
                    <li class="{{ $request->segment(2) == 'pkstype' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pkstype.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                PKS Type List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'status' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.status.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Status Parameter List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'vendor' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.vendor.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Vendor List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            @endcan

            @can('users_security')

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-plug"></i>
                    <span class="title">IT Network & Security</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'branch' ? 'active active-sub' : '' }}">
                        <a href="{{ route('sec.branch.index') }}">
                            <i class="fa fa-building"></i>
                            <span class="title">
                                Branch of Bank Index List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'license' ? 'active active-sub' : '' }}">
                        <a href="{{ route('sec.license.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                License List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Parameter</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'dc' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.dc.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Data Center List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'hardwares' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.hardwares.index') }}">
                            <i class="fa fa-server"></i>
                            <span class="title">
                                Hardware List
                            </span>
                        </a>
                    </li>
                    <!-- <li class="{{ $request->segment(2) == 'pic' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pic.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                PIC List
                            </span>
                        </a>
                    </li> -->
                    <li class="{{ $request->segment(2) == 'pkstype' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.pkstype.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                PKS Type List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'status' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.status.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Status Parameter List
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'vendor' ? 'active active-sub' : '' }}">
                        <a href="{{ route('param.vendor.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                                Vendor List
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            @endcan        

            <li class="{{ $request->segment(1) == 'guidancedoc' ? 'active' : '' }}">
                <a href="{{ route('guidancedoc.guidancedoc.index') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">Guidance Document</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>

        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
