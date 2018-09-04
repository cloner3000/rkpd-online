@php($canEntry = true)
@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Hak Akses</h3>
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
                        <a href="{{ route('role.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">Pengaturan - Pengguna Hak Akses</span>
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
                        <h3 class="m-portlet__head-text">Pengaturan Hak Akses</h3>
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
                <form class="m-form" method="POST" action="{{ route('permission.attach') }}">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label class="col-form-label">
                                Kelompok
                            </label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control m-select2" id="m_select2_1" name="role_id">
                                    <option disabled selected>-- Silahkan Pilih --</option>
                                    @forelse($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @empty
                                        <option disabled>-- Tidak ada data --</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--begin: Datatable -->
                    <table class="table table-hover" id="" width="100%">
                        <thead>
                        <tr>
                            <th title="Field #1">
                                Menu
                            </th>
                            <th title="Filed #3" colspan="6">
                                Hak Akses
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(list_menu() as $item)
                            <tr>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                <span class="m-switch m-switch--icon">
                                    <label><input class="toggle-menu" name="{{ nice_permission_name($item->nama) }}"
                                                  type="checkbox" id="{{ nice_permission_name($item->nama) }}"
                                                  name="aktif"><span></span></label>
                                </span>
                                </td>
                            @foreach($item->children as $submenu)
                                <tr>
                                    <td>
                                        <ul>
                                            <li>{{ $submenu->nama }}</li>
                                        </ul>
                                    </td>
                                    <td>
                                <span class="m-switch m-switch--icon">
                                    <label><input class="toggle-menu" name="{{ nice_permission_name($submenu->nama) }}"
                                                  type="checkbox" id="{{ nice_permission_name($submenu->nama) }}"
                                                  name="aktif"><span></span></label>
                                </span>
                                    </td>
                                </tr>
                                @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-default">Batal</button>
                    </div>
                    <!--end: Datatable -->
                </form>
            </div>
        </div>
    </div>

@endsection

@push('footer.javascript')
    <script>
        var permission = $('#m_select2_1');
        permission.on('change', function () {
            let roleId = $(this).val();
            axios.post("{{ route('api.permission.menus') }}", {'roleId': roleId})
                .then(function (response) {
                    setToggle(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        function setToggle(data) {
            resetToggle();
            for (let i = 0; i < data.length; i++) {
                $('#' + data[i].name.replace("menu ", "")).prop('checked', true);
            }
        }

        function resetToggle() {
            $('.toggle-menu').prop('checked', false);
        }
    </script>
@endpush