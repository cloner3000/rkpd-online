@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Rancangan KUA PPAS</h3>
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
                        <a href="{{ route('musrenbang-kabupaten.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">MUSRENBANG</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ route('musrenbang-kabupaten.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">Rancangan KUA PPAS</span>
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
                        <h3 class="m-portlet__head-text">Hasil Rancangan KUA PPAS</h3>
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


            @role(\App\Enum\Roles::BIDANG)
                <!-- Filter -->
                <form action="{{ route('rancangan-kuappas.filter') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        
                        <!-- edited form -->
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    Perangkat Daerah
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <select name="selected_opd" class="form-control m-select2" id="m_select2_1">
                                    @foreach ($opd_bidang as $opd)
                                        <option value="{{ $opd->id }}" @if($opd->id == $dropdown1) selected @endif>{{ $opd->nama }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="old_dropdown1" value="{{ $dropdown1 }}">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-primary" name="button_1" value="Pilih">
                            </div>
                        </div>
                        <!-- edited form -->
                        
                        <!-- original form -->
                        {{-- <div class="col-md-8">
                            <div class="form-group m-form__group">
                                <label>
                                    Perangkat Daerah
                                </label>
                                <select name="selected_opd" class="form-control m-select2" id="m_select2_1">
                                    @foreach ($opd_bidang as $opd)
                                        <option value="{{ $opd->id }}" @if($opd->id == $dropdown1) selected @endif>{{ $opd->nama }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="old_dropdown1" value="{{ $dropdown1 }}">
                            </div>
                        </div> --}}
                        <!-- original form -->
                        
                    </div>

                    @if (!empty($dropdown1))
                        <div class="form-group">

                            <!-- edited form -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        Program
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <select name="selected_program" class="form-control m-select2" id="m_select2_1">
                                        @forelse ($program as $prog)
                                            <option value="{{ $prog->id }}">{{ $prog->nama }}</option>
                                        @empty
                                            <option value="">Tidak ada data program</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" class="btn btn-primary" name="button_1" value="Pilih">
                                </div>
                            </div>
                            <!-- edited form -->

                            <!-- original form -->
                            {{-- <div class="col-md-12">
                                <div class="form-group m-form__group">
                                    <label>
                                        Program
                                    </label>
                                    <select name="selected_program" class="form-control m-select2" id="m_select2_1">
                                        @forelse ($program as $prog)
                                            <option value="{{ $prog->id }}">{{ $prog->nama }}</option>
                                        @empty
                                            <option value="">Tidak ada data program</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div> --}}
                            <!-- original form -->

                        </div>
                    @endif

                    {{-- <div class="form-group">
                        <div class="col-12">
                            <label></label>
                            <button type="submit" class="btn btn-primary">Pilih</button>
                        </div>
                    </div> --}}

                </form>
            @endrole

            @if ($bidang_nama[0] == 'Administrator' or (!empty($items)))
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-7">
                                    @include('global.table_search', [
                                       'action' => route('rancangan-kuappas.index', ['url'=>'items']),
                                       'search' => $search ?? "",
                                       'selected_opd' => $dropdown1 ?? "",
                                       'selected_program' => $dropdown2 ?? "",
                                       'old_dropdown1' => $old_dropdown1 ?? ""
                                   ])
                                </div>
                            </div>
                        </div>
                        @if (!$canEntry)
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
                            Nomor
                        </th>
                        <th title="Field #1">
                            Nama Kegiatan
                        </th>
                        <th title="Field #2">
                            Lokasi
                        </th>
                        @role(\App\Enum\Roles::BIDANG)
                            <th title="Field #3">
                                Prioritas
                            </th>
                        @endrole
                        <th title="Field #4">
                            Transfer
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
                                {{ $bidang_nama[0] == 'Administrator' ? $item->kegiatan->nama : $item->nama }}
                            </td>
                            <td>
                                {{ $item->lokasi }}
                            </td>
                            @role(\App\Enum\Roles::BIDANG)
                                <td>
                                    {{ $item->prioritas }}
                                </td>
                            @endrole
                            <td>
                                {{ $item->is_transfer ? 'Sudah' : 'Belum' }}
                            </td>
                            <td>
                                @include('global.table_action', [
                                    'action' => route('rancangan-kuappas.destroy', ['id' => $item->id]),
                                    'url'    => route('rancangan-kuappas.edit', ['id' => $item->id]),
                                    'id'     => $item->id,
                                    'show'   => route('rancangan-kuappas.show', $item->id),
                                    'transfer' => route('rancangan-kuappas.transfer.view', ['id' => $item->id]),
                                    'isViewTransfer' => true
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
                        {{ $bidang_nama[0] == 'Administrator' ? $items->appends(['search' => request()->input('search') ])->links() : $items->appends(['search' => request()->input('search'), 'selected_opd' => request()->input('selected_opd'), 'selected_program' => request()->input('selected_program'), 'old_dropdown1' => request()->input('old_dropdown1'),])->links() }}
                    </div>
                </div>
                <!--end: Datatable -->
            @endif
            </div>
        </div>
    </div>
@endsection

@push('footer.javascript')
    <script src="{{ asset('/metronic/assets/demo/default/custom/components/datatables/base/html-table.js') }}"
            type="text/javascript"></script>
@endpush
