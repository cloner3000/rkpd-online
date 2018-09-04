<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark"
     data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item {{ in_array(request()->route()->getName(), ['home']) ? 'm-menu__item--active' : '' }}"
            aria-haspopup="true">
            <a href="{{ route('home') }}" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Dashboard</span>
                    </span>
                </span>
            </a>
        </li>
        <li class="m-menu__item {{ in_array(request()->route()->getName(), ['profile']) ? 'm-menu__item--active' : '' }}"
            aria-haspopup="true">
            <a href="{{ route('profile') }}" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-profile-1"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Akun Saya</span>
                    </span>
                </span>
            </a>
        </li>
        @include('layouts._menu')
        @role('Administrator')
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Pengaturan</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @include('layouts.admin._sidebar')
        @endrole

    </ul>
</div>
