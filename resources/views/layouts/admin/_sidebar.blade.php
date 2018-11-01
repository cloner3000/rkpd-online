<li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern(['menu.*', 'user.*', 'role.*', 'permission.*', 'bidang']), 'm-menu__item--open') }} m-menu__item--expanded"
    aria-haspopup="true" data-menu-submenu-toggle="hover">
    <a href="#" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fa fa-group"></i>
        <span class="m-menu__link-text">Hak Akses</span>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="m-menu__submenu">
        <span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <a href="#" class="m-menu__link ">
                    <span class="m-menu__link-text">`</span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('user.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('user.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Pengguna</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('role.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('role.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon fa fa-users"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Kelompok</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('permission.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('permission.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-lock-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Hak Akses Menu</span>
                    </span>
                </span>
                </a>
            </li>

            <!-- menu tambahan -->
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('bidang'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('bidang') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-lock-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Hak Akses Bidang</span>
                    </span>
                </span>
                </a>
            </li>
            <!-- end menu tambahan -->

            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('menu.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('menu.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-grid-menu-v2"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Menu</span>
                    </span>
                </span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="m-menu__item {{ active_class(if_route_pattern(['home.*', 'pemda.*', 'opd.*', 'tahapan.*']), 'm-menu__item--open') }} m-menu__item--expanded"
    aria-haspopup="true">
    <a href="#" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fa fa-building"></i>
        <span class="m-menu__link-text">Data Umum Pemda</span>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="m-menu__submenu">
        <span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <a href="#" class="m-menu__link ">
                    <span class="m-menu__link-text">`</span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('pemda.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('pemda.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-3"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Data Pemda</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('opd.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('opd.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-3"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Data OPD</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('tahapan.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('tahapan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-3"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Tahapan</span>
                    </span>
                </span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="m-menu__item {{ active_class(if_route_pattern(['home.*', 'urusan.*', 'bidang-urusan.*', 'program.*', 'kegiatan.*', 'capaian-program.*', 'lokasi-kegiatan.*', 'role-opd.*', 'satuan.*']), 'm-menu__item--open') }} m-menu__item--expanded"
    aria-haspopup="true">
    <a href="#" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fa fa-tags"></i>
        <span class="m-menu__link-text">Program Kegiatan</span>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="m-menu__submenu">
        <span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <a href="#" class="m-menu__link ">
                    <span class="m-menu__link-text">`</span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('urusan.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('urusan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Urusan</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('bidang-urusan.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('bidang-urusan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Bidang Urusan</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('program.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('program.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Program</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('capaian-program.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('capaian-program.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Capaian Program</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('kegiatan.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('kegiatan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Kegiatan</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('lokasi-kegiatan.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('lokasi-kegiatan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Lokasi Kegiatan</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('role-opd.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('role-opd.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Role Opd</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('satuan.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('satuan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">Satuan</span>
                    </span>
                </span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern(['home.*', 'visi.*', 'misi.*', 'tujuan.*', 'sasaran.*', 'indikator-sasaran.*']), 'm-menu__item--open') }} m-menu__item--expanded"
    aria-haspopup="true" data-menu-submenu-toggle="hover">
    <a href="#" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fa fa-group"></i>
        <span class="m-menu__link-text">RPJMD Kabupaten</span>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="m-menu__submenu">
        <span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <a href="#" class="m-menu__link ">
                    <span class="m-menu__link-text">`</span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('visi.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('visi.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-1"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Visi</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('misi.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('misi.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-graph"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Misi</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('tujuan.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('tujuan.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-interface-5"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Tujuan</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('sasaran.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('sasaran.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-map-location"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Sasaran</span>
                    </span>
                </span>
                </a>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{ active_class(if_route_pattern('indikator-sasaran.*'), 'm-menu__item--active') }} m-menu__item--expanded"
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('indikator-sasaran.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-warning-2"></i>
                    <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"> Indikator Sasaran</span>
                    </span>
                </span>
                </a>
            </li>
        </ul>
    </div>
</li>