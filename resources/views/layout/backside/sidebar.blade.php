<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                @role('admin')
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="hide-menu">Dashboard Admin</span>
                    </a>
                </li>
                @endrole

                @role('member')
                <!-- Member-->
                <li class="sidebar-item {{ request()->routeIs('member.dashboard') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('member.dashboard') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="hide-menu">Dashboard Member</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('member.user-profile') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('member.user-profile') }}" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span class="hide-menu">User Profile</span>
                    </a>
                </li>
                <!-- End Member-->
                @endrole

                @role('customer')
                <!-- Customer -->
                <li class="sidebar-item {{ request()->routeIs('customer.dashboard') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('customer.dashboard') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="hide-menu">Dashboard Customer</span>
                    </a>
                </li>
                <!-- End Customer -->
                @endrole

                @role('member')
                <!-- Member-->
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Product Link Information</span></li>

                <li class="sidebar-item {{ request()->routeIs('member.product-link.*') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('member.product-link.index-view') }}" aria-expanded="false">
                        <i class="fas fa-link"></i>
                        <span class="hide-menu">Product Link</span>
                    </a>
                </li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">User Finance Information</span></li>

                <li class="sidebar-item {{ request()->routeIs('member.member-finance.my-money.*') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('member.member-finance.my-money.index-view') }}" aria-expanded="false">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="hide-menu">My Money</span>
                    </a>
                </li>
                <!-- End Member-->
                @endrole

                @role('customer')
                <!-- Customer -->
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Customer Feature</span></li>

                <li class="sidebar-item {{ request()->routeIs('customer.order-transaction-history-view') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('customer.order-transaction-history-view') }}" aria-expanded="false">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="hide-menu">Order Transaction History</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('customer.contact-us-view') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('customer.contact-us-view') }}" aria-expanded="false">
                        <i class="fas fa-phone"></i>
                        <span class="hide-menu">Contact Us</span>
                    </a>
                </li>
                <!-- End Customer -->
                @endrole

                @role('admin')
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Member Information</span></li>

                <li class="sidebar-item {{ request()->routeIs('admin.manage-member.index-view') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.manage-member.index-view') }}" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="hide-menu">Manage Member</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.manage-member.withdrawal-request-view') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.manage-member.withdrawal-request-view') }}" aria-expanded="false">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="hide-menu">Withdrawal Request</span>
                    </a>
                </li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Product Information</span></li>

                <li class="sidebar-item {{ request()->routeIs('admin.manage-product.*') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.manage-product.index-view') }}" aria-expanded="false">
                        <i class="fas fa-box"></i>
                        <span class="hide-menu">Manage Product</span>
                    </a>
                </li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Leads Information</span></li>

                <li class="sidebar-item {{ request()->routeIs('admin.manage-lead.*') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.manage-lead.index-view') }}" aria-expanded="false">
                        <i class="fas fa-assistive-listening-systems"></i>
                        <span class="hide-menu">Manage Leads</span>
                    </a>
                </li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">System Setting</span></li>

                <li class="sidebar-item {{ request()->routeIs('admin.system-setting.contact-us-setting.edit-view') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.system-setting.contact-us-setting.edit-view') }}" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        <span class="hide-menu">Contact Us Setting</span>
                    </a>
                </li>
                @endrole

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
