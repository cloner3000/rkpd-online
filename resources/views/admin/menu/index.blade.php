@php($canEntry = true)
@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Admin</h3>
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
                        <a href="{{ route('menu.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">Menu</span>
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
                        <h3 class="m-portlet__head-text">Manajemen Menu</h3>
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
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
									<span><i class="la la-search"></i></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a href="{{ route('menu.create') }}"
                               class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                <span><i class="la la-plus"></i>
                                    <span>Tambah Menu</span>
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
                        <th title="Field #1">
                            Nama
                        </th>
                        <th title="Field #2">
                            URL
                        </th>
                        <th title="Field #3">
                            Icon
                        </th>
                        <th title="Field #4">
                            Urutan
                        </th>
                        <th title="Field #5">
                            Aktif
                        </th>
                        <th title="Field #6">
                            Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                {{ $item->nama }}
                            </td>
                            <td>
                                <a href="{{ env('APP_URL') . '/' .  $item->url }}">{{ $item->url }}</a>
                            </td>
                            <td>
                                <div class="m-demo-icon">
                                    <div class="m-demo-icon__preview">
                                        <i class="{{ $item->icon }}"></i>
                                    </div>
                                    <div class="m-demo-icon__class">
                                        {{ $item->icon }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $item->urutan }}
                            </td>
                            <td>
                                <span class="m-switch m-switch--icon">
                                    <label><input disabled type="checkbox"
                                                  {{ $item->aktif == true ? 'checked' : '' }} name="aktif"><span></span></label>
                                </span>
                            </td>
                            <td>
                                @include('global.table_action_admin', [
                                    'action' => route('menu.destroy', ['id' => $item->id]),
                                    'url'    => route('menu.edit', ['id' => $item->id]),
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
