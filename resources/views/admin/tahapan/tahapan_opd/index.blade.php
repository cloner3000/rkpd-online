@php($canEntry = true)
@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Tahapan OPD</h3>
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
                        <span class="m-nav__link-text">Data Umum Pemda</span>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <span class="m-nav__link-text">Tahapan OPD</span>
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
                        <h3 class="m-portlet__head-text">Tahapan : {{ $tahapan->nama }}</h3>
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
                        <div class="col-xl-7 order-2 order-xl-1">
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
                        <div class="col-xl-5 order-1 order-xl-2 m--align-right">
                            <a href="{{ route('tahapan.index') }}" class="btn btn-default m-btn--hover-info m-btn m-btn--icon m-btn--air m-btn--pill">
                                <span><i class="la la-backward"></i>
                                    <span>Kembali</span>
                                </span>
                            </a>
                            <a href="{{ route('tahapan.opd.create', $id) }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
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
                        <th title="OPD">
                            OPD
                        </th>
                        <th title="Aksi">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                {{ $item->opd ? $item->opd->nama : '-' }}
                            </td>
                            <td>
                                @include('global.table_action_admin', [
                                    'action' => route('tahapan.opd.destroy', ['id' => $item->id, 'tahapan_id' => $id]),
                                    'url'    => route('tahapan.opd.edit', ['id' => $item->id, 'tahapan_id' => $id]),
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
    <script src="{{ asset('/metronic/assets/demo/default/custom/components/datatables/base/html-table.js') }}" type="text/javascript"></script>
@endpush
