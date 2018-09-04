<?php

if (!function_exists('format_number')) {
    function format_number($number, $decimalPlace = 0)
    {
        return number_format($number, $decimalPlace, ',', '.');
    }
}

if (!function_exists('format_money')) {
    function format_money($number, $decimalPlace = 0, $prefix = 'Rp.')
    {
        $output = format_number($number, $decimalPlace);
        if ($prefix) {
            $output = $prefix . ' ' . $output;
        }

        return $output;
    }
}

if (!function_exists('error_pages')) {
    function error_pages($status, $message)
    {
        return response(view('errors.404', compact('status', 'message')), $status ?? 404);
    }
}

if (!function_exists('list_menu')) {
    function list_menu()
    {
        return \App\Admin\Menu::tree();
    }
}

if (!function_exists('create_permission_name')) {
    function create_permission_name($string)
    {
        return 'menu ' . strtolower(str_replace(' ', '-', $string));
    }
}

if (!function_exists('nice_permission_name')) {
    function nice_permission_name($string)
    {
        return strtolower(str_replace(' ', '-', $string));
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission)
    {
        if ((!auth()->user()->hasPermissionTo($permission))) {
            return error_pages(401, 'Anda tidak berhak mengakses halaman ini!');
        }
    }
}

if (!function_exists('has_access_menu')) {
    function has_access_menu($menu)
    {
        return auth()->user()->hasPermissionTo(create_permission_name($menu));
    }
}

if (!function_exists('set_input_rupiah')) {
    function set_input_rupiah($input)
    {
        $rupiah = str_replace('_', '', $input);
        $rupiah = str_replace('.', '', $rupiah);
        $rupiah = str_replace('Rp', '', $rupiah);
        $rupiah = str_replace(',', '', $rupiah);

        return $rupiah;
    }
}

if (!function_exists('csvToArray')) {
    function csvToArray($filename = '', $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}

if (!function_exists('tahun_anggaran')) {
    function tahun_anggaran()
    {
        $visi = \App\Admin\Visi::active();
        $result = [];
        if ($visi) {
            for ($i = $visi->mulai ?? 0; $i <= $visi->selesai ?? 0; $i++) {
                array_push($result, $i);
            }
        }
        return $result;
    }
}

if (!function_exists('get_district')) {
    function get_district($id)
    {
        return \App\location\Districts::find($id);
        $villages = \App\location\Villages::find($id);
    }
}

if (!function_exists('get_village')) {
    function get_village($id)
    {
        return \App\location\Villages::find($id);
    }
}

if (!function_exists('m_datatable_format')) {
    function m_datatable_format($data, $params) {
        $result = [
            'meta' => json_decode(json_encode(
                [
                    'page' => $params->current_page ?? 1,
                    'pages' => 1,
                    'perpage' => $params->per_page ?? 2,
                    'total' => $params->total ?? 4,
                    'sort' => 'asc',
                    'field' => ''
                ])
            ),
            'data' => $data
        ];
        return $result;
    }
}

if (!function_exists ('can_entry')) {
    function can_entry($tahapanName) {
        $tahapan = new \App\Tahapan();
        return $tahapan->canEntry($tahapanName);
    }
}

if (!function_exists ('can_transfer')) {
    function can_transfer($tahapanName) {
        $tahapan = new \App\Tahapan();
        return $tahapan->canTransfer($tahapanName);
    }
}

if (!function_exists ('get_name_tahapan')) {
    function get_name_tahapan($id) {
        $tahapan = \App\Tahapan::find($id);
        $tahapanName = "";

        if ($tahapan) {
            $tahapanName = $tahapan->nama;
        }

        return $tahapanName;
    }
}

if (!function_exists ('get_percent')) {
    function get_percent($total, $number) {
        if ($total > 0) {
            return round($number / ($total / 100),2).'%';
        } else {
            return '0%';
        }
    }
}

if (!function_exists ('get_format_currency')) {
    function get_format_currency($number) {
        return number_format($number,0,".",".");
    }
}

if (!function_exists('get_kecamatan_from_location')) {
    function get_kecamatan_from_location ($location) {
        return substr($location, strpos($location, ':') + 1, strpos($location, ',') - strpos($location, ':') - 1);
    }
}

if (!function_exists('get_desa_from_location')) {
    function get_desa_from_location ($location) {
        $start = strpos($location, 'Kelurahan:') + 11;
        $end = strpos($location, '.') - $start;
        return substr($location, $start, $end);
    }
}

