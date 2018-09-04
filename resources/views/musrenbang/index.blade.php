@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{ $title }}</h3>
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
                        <a href="{{ route('musrenbang-kecamatan.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">{{ $title }}</span>
                        </a>
                    </li>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ $title }}</h3>
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
                                    @include('global.table_search', [
                                       'action' => route('user.index', ['url'=>'items']),
                                       'search' => $search ?? ""
                                   ])
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a href="{{ route($type.'.create') }}"
                               class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span><i class="la la-plus"></i>
                                    <span>Tambah Musrenbang</span>
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
                        <th title="Field #0">
                            Nomor
                        </th>
                        <th title="Field #1">
                            Nama Kegiatan
                        </th>
                        <th title="Field #2">
                            Lokasi
                        </th>
                        <th title="Field #3">
                            SKPD Pelaksana
                        </th>
                        <th title="Field #4">
                            Transfer
                        </th>
                        <th title="Field #6">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key => $item)
                        <tr>
                            <td>
                                {{ $items->firstItem() + $key }}
                            </td>
                            <td>
                                {{ $item->kegiatan->nama }}
                            </td>
                            <td>
                                {{ $item->lokasi }}
                            </td>
                            <td>
                                {{ $item->opd->nama }}
                            <td>
                                {{ $item->is_transfer ? 'Sudah' : 'Belum' }}
                            </td>
                            <td>
                                @include('global.table_action', [
                                    'action' => route($type.'.destroy', ['id' => $item->id]),
                                    'url'    => route($type.'.edit', ['id' => $item->id]),
                                    'id'     => $item->id
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection

@push('footer.javascript')
    <script src="{{ asset('/metronic/assets/demo/default/custom/components/datatables/base/html-table.js') }}"
            type="text/javascript"></script>
@endpush
