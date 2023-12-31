<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li class="sidebar-item {{ request()->routeIs('backside.dashboard') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('backside.dashboard') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="hide-menu">Beranda</span>
                    </a>
                </li>

                @role('seller')
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Informasi Produk</span></li>

                <li class="sidebar-item {{ request()->routeIs('backside.product.*') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('backside.product.index-view') }}" aria-expanded="false">
                        <i class="fas fa-box"></i>
                        <span class="hide-menu">Atur Produk</span>
                    </a>
                </li>
                @endrole

                @role('buyer')
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Informasi Pesanan</span></li>

                <li class="sidebar-item {{ request()->routeIs('backside.order.*') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('backside.order.index-view') }}" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hide-menu">Atur Pesanan</span>
                    </a>
                </li>
                @endrole

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
