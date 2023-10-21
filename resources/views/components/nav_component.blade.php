<div>
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Dashboards</h6>
        </li><!-- .nk-menu-item -->
        <li class="nk-menu-item">
            <a href="{{ route('home') }}" class="nk-menu-link">
                <span class="nk-menu-icon"><i class="fa-solid fa-house-chimney me-5"></i></span>
                <span class="nk-menu-text">Home</span>
            </a>
        </li><!-- .nk-menu-item -->

        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">menu Admin</h6>
        </li><!-- .nk-menu-heading -->
        {{-- admin --}}
        <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><i class="icon fa-solid fa-users"></i></span>
                <span class="nk-menu-text">Wisata</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{ route('admin.category.index') }}" class="nk-menu-link"><span
                            class="nk-menu-text">Category</span></a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{ route('admin.wisata.index') }}" class="nk-menu-link"><span
                            class="nk-menu-text">Wisata</span></a>
                </li>

            </ul><!-- .nk-menu-sub -->
        </li><!-- .nk-menu-item -->
        <li class="nk-menu-item">
            <a href="{{ route('admin.notification.index') }}" class="nk-menu-link">
                <span class="nk-menu-icon"><i class="icon fa-solid fa-network-wired"></i></span>
                <span class="nk-menu-text">Notification</span>
            </a>
        </li>

        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Setting</h6>
        </li><!-- .nk-menu-heading -->
        <li class="nk-menu-item">
            <a href="#" class="nk-menu-link">
                <span class="nk-menu-icon"><i class="fa-solid fa-gear"></i></span>
                <span class="nk-menu-text">Setting</span>
            </a>
        </li>

    </ul><!-- .nk-menu -->
</div>
