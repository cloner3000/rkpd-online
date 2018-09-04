@php($canEntry = true)
@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Role OPD</h3>
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
                        <span class="m-nav__link-text">Program Kegiatan</span>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <span class="m-nav__link-text">Role OPD</span>
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
                        <h3 class="m-portlet__head-text">Daftar Role OPD</h3>
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
            @if ($errors->has('role'))
                <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    {{ $errors->first('role') }}
                </div>
            @endif
            <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <form action="{{ route('role-opd.index') }}" method="GET" id="form_jenis_opd">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-6">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label class="m-label">Role</label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-select2" id="role_id" name="role_id">
                                                <option disabled selected>-- Silahkan Pilih --</option>
                                                @forelse($roles as $key => $value)
                                                    <option value="{{ $key }}" {{ $q_role == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @empty
                                                    <option disabled>-- Tidak ada data --</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label class="m-label m-label--single">Jenis OPD </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-select2" id="jenis_opd" name="jenis_opd">
                                                <option disabled selected>-- Silahkan Pilih --</option>
                                                @forelse($jenis_opd as $key => $value)
                                                    <option value="{{ $key }}" {{ $q_jenis == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @empty
                                                    <option disabled>-- Tidak ada data --</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <form action="{{ route('role-opd.store') }}" method="POST">
                    {{ csrf_field() }}
                    <table class="table table-hover" id="" width="100%">
                        <thead>
                        <tr>
                            <th title="Nama">
                                Nama
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
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    <span class="m-switch m-switch--icon">
                                    <label>
                                        <input class="toggle-menu" name="{{ $item->id }}" type="checkbox" id="{{ $item->id }}" disabled>
                                        <span></span>
                                    </label>
                                </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="m-datatable--error" style=" text-align: center;vertical-align: middle;padding: 5px;position: relative;" height="100">
                                    Jenis OPD belum dipilih !
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <input type="hidden" name="jenis_opd" value="{{ Request::get('jenis_opd') }}">
                    <input type="hidden" name="role" id="role" value="{{ Request::get('role_id') }}">
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-default">Batal</button>
                    </div>
                </form>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection

@push('footer.javascript')
    <script>
        $('#jenis_opd').select2({
            placeholder: "Pilih Visi"
        });
        $('#role_id').select2({
            placeholder: "Pilih Visi"
        });

        $(document).ready(function() {
            let role = $('#role_id');

            if (role !== undefined) {
                setToogleAction(role);
            }

            $('#jenis_opd').on('change', function() {
                document.getElementById("form_jenis_opd").submit();
            });

            role.on('change', function() {
                setToogleAction(role);
            });
        });
        
        function setToogleAction(e) {
            $('.toggle-menu').attr('disabled', false);
            let roleId = e.val();
            $('#role').val(roleId);
            axios.post("{{ route('api.role-opd.opd') }}", {'roleId': roleId})
                .then(function (response) {
                    setToggle(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        function setToggle(data) {
            resetToggle();
            for (let i = 0; i < data.length; i++) {
                $('#' + data[i]).prop('checked', true);
            }
        }

        function resetToggle() {
            $('.toggle-menu').prop('checked', false);
        }
    </script>
@endpush
