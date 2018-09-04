@php($canEntry = true)
@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Pengguna</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ route('home') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <span class="m-nav__link-text">PENGATURAN</span>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <span class="m-nav__link-text">Hak Akses</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Daftar Pengguna</h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                @if (session('alert'))
                    @include('global.notif_action', [
                        'type'    => session('alert')['type'],
                        'alert'   => session('alert')['alert'],
                        'message' => session('alert')['message']
                    ])
                @endif
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-7">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Cari..." id="generalSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
									<span><i class="la la-search"></i></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a href="{{ route('user.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span><i class="la la-plus"></i>
                                    <span>Tambah Data</span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                    <table class="m-datatable" id="html_table" width="100%">
                    <thead>
                    <tr>
                        <th title="Username">
                            Username
                        </th>
                        <th title="Nama Lengkap">
                            Nama Lengkap
                        </th>
                        <th title="Email">
                            Email
                        </th>
                        <th title="Kelompok">
                            Kelompok
                        </th>
                        <th title="Aksi">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->nama_lengkap }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                @foreach($item->getRoleNames() as $role_name)
                                    <span style="width: 110px;margin: 2px 0px;">
                                        <span class="m-badge  m-badge--success m-badge--wide">{{ $role_name }}</span>
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                @include('global.table_action_admin', [
                                    'action' => route('user.destroy', ['id' => $item->id]),
                                    'url'    => route('user.edit', ['id' => $item->id]),
                                    'id'     => $item->id
                                ])
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="m-datatable--error" style=" text-align: center;vertical-align: middle;padding: 5px;position: relative;" height="100">
                                    Data Tidak Ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection

@push('footer.javascript')
    <script src="{{ asset('/metronic/assets/demo/default/custom/components/datatables/base/html-table.js') }}" type="text/javascript"></script>
@endpush
