@foreach (list_menu() as $menu)
    @if(has_access_menu($menu->nama))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--open" aria-haspopup="true"
            data-menu-submenu-toggle="hover">
            <a href="{{ has_access_menu($menu->nama) ? url($menu->url) : '#' }}" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon {{ $menu->icon ?? ' flaticon-grid-menu-v2' }} "></i>
                <span class="m-menu__link-text">
                {{ $menu->nama }}
            </span>
                @if($menu->isHaveChildren())
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                @endif
            </a>
            @foreach ($menu->children as $submenu)
                @if(auth()->user()->hasPermissionTo(create_permission_name($submenu->nama)))
                    <div class="m-menu__submenu" style="display: block;">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                                data-menu-submenu-toggle="hover">
                                <a href="{{ !$submenu->isHaveChildren() ? url($submenu->url) : '#' }}"
                                   class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon  {{ $submenu->icon ?? ' flaticon-grid-menu-v2' }}">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                {{ $submenu->nama }}
                            </span>
                                    @if($submenu->isHaveChildren())
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    @endif
                                </a>
                                @foreach ($submenu->children as $sub)
                                    @if(auth()->user()->hasPermissionTo(create_permission_name($sub->nama)))
                                        <div class="m-menu__submenu" style="display: none;">
                                            <span class="m-menu__arrow"></span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item " aria-haspopup="true">
                                                    <a href="{{ !$sub->isHaveChildren() ? url($sub->url) : '#' }}"
                                                       class="m-menu__link ">
                                                        <i class="m-menu__link-icon {{ $sub->icon ?? ' flaticon-grid-menu-v2' }} ">
                                                            <span></span>
                                                        </i>
                                                        <span class="m-menu__link-text">
                                                {{ $sub->nama }}
                                            </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                    </div>
                @endif
            @endforeach
        </li>
    @endif
@endforeach

<li class="m-menu__item m-menu__item--submenu {{ active_class(if_route_pattern('laporan.*'), 'm-menu__item--active') }} "
    aria-haspopup="true"
    data-menu-submenu-toggle="hover">
    <a href="{{ has_access_menu($menu->nama) ? url($menu->url) : '#' }}" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon flaticon-interface-2"></i>
        <span class="m-menu__link-text">Laporan</span>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>

    @can('laporan-desa')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.desa') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Desa/ Kelurahan</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-kecamatan')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.kecamatan') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Kecamatan</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-dewan')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.dewan') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Pokok Pikiran Dewan</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-awal')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.awal') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Rancangan Awal</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-renja')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.renja') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Rancangan Renja</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-kabupaten')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.kabupaten') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Kabupaten</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-akhir')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.akhir') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Akhir</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-rancangankuappas')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.rancangankuappas') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">Rancangan KUA PPAS</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

    @can('laporan-kuappas')
        <div class="m-menu__submenu" style="display: block;">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"
                    data-menu-submenu-toggle="hover">
                    <a href="{{ route('laporan.kuappas') }}"
                       class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1">
                            <span></span>
                        </i>
                        <span class="m-menu__link-text">KUA PPAS</span>
                    </a>
                </li>
            </ul>
        </div>
    @endcan

</li>
