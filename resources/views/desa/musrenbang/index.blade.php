@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Musrenbang Desa</h3>
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
                        <a href="{{ route('musrenbang-desa.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">MUSRENBANG</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ route('musrenbang-desa.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">Musrenbang Desa</span>
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
                        <h3 class="m-portlet__head-text">Hasil Musrenbang Desa</h3>
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
                                       'action' => route('musrenbang-desa.index', ['url'=>'items']),
                                       'search' => $search ?? ""
                                   ])
                                </div>
                            </div>
                        </div>
                        @if ($canEntry)
                            <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                <a href="{{ route('musrenbang-desa.create') }}"
                                   class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span><i class="la la-plus"></i>
                                    <span>Tambah Musrenbang</span>
                                </span>
                                </a>
                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                            </div>
                        @else
                            <div class="m-alert m-alert--outline alert alert-warning fade show col-lg-12">
                                <strong>
                                    Peringatan!
                                </strong>
                                {{ \App\Enum\ErrorMessages::CLOSED_ENTRY }}
                            </div>
                        @endif
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                    <table width="100%" class="table table-hover">
                    <thead>
                    <tr>
                        <th title="Field #0">
                            No.
                        </th>
                        <th title="Field #1">
                            Nama Kegiatan
                        </th>
                        <th title="Field #2">
                            Lokasi
                        </th>
                        <th title="Field #4">
                            Transfer
                        </th>
                        <th title="Field #5">
                            Status | Catatan
                        </th>
                        <th title="Field #6">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $key => $item)
                        <tr>
                            <td>
                                {{ $items->firstItem() + $key }}
                            </td>
                            <td>
                                {{ $item->kegiatan->nama }}
                            </td>
                            <td>
                                {{$item->lokasi }}
                            </td>
                            <td>
                                {{ $item->is_transfer ? 'Sudah' : 'Belum' }}
                            </td>
                            <td>
                                @if ($item->is_transfer == 1 && $item->is_verifikasi == 1)
                                    <span class="label label-sm label-success">Diterima | </span>
                                @elseif($item->is_transfer == 0 && $item->is_verifikasi == 2)
                                    <span class="label label-danger">Ditolak | </span>
                                @elseif($item->is_transfer == 1 && $item->is_verifikasi == 0)
                                    <label class="label label-sm label-danger">Diterima</label>
                                @else
                                    <label class="label label-sm label-danger">Menunggu tindakan</label>
                                @endif
                                {{ $item->catatan }}
                            </td>
                            <td>
                                @include('global.table_action', [
                                    'action' => route('musrenbang-desa.destroy', ['id' => $item->id]),
                                    'url'    => route('musrenbang-desa.edit', ['id' => $item->id]),
                                    'id'     => $item->id,
                                    'show'   => route('musrenbang-desa.show', $item->id),
                                    'transfer' => route('musrenbang-desa.transfer.view', $item->id),
                                    'isViewTransfer' => true,
                                    'is_verifikasi' => $item->is_verifikasi
                                ])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="m-datatable--error" style=" text-align: center;vertical-align: middle;padding: 5px;position: relative;" height="100">
                                Data Tidak Ditemukan
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
                    {{ $items->appends(['search' => request()->input('search') ])->links() }}
                </div>
            </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection