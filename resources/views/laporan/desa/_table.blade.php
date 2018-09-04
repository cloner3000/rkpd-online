<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
    <title>LAPORAN MUSRENBANG KECAMATAN</title>
    <style>
        @page {
            margin: 0px;
            width: 330mm;
            height: 215mm;
        }

        body {
            font-family: Verdana, Geneva, sans-serif;
            font-size: 12px;
        }

        h1 {
            padding: 0px;
            margin: 0px;
            font-size: 16px;
            text-align: center;
            font-weight: bold;
            padding-bottom: 10px;
            margin-top: -10px;
            text-transform: uppercase;
        }

        h2 {
            padding: 0px;
            margin: 0px;
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            padding-bottom: 10px;
            margin-top: -10px;
            text-transform: uppercase;
        }

        .wrapper {
            padding: 0px 50px 10px 50px;
        }

        .atasnama td {
            text-align: center;
        }

        .data_table {
            border-collapse: collapse;
        }

        .data_table th {
            vertical-align: middle;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            height: 30px;
            border: 1px solid #999;
            background: #FF0;
        }

        .data_table td {
            vertical-align: middle;
            text-align: left;
            font-size: 11px;
            border: 1px solid #999;
            padding-left: 5px;
            padding-right: 5px;
            font-family: Tahoma, Geneva, sans-serif;
            height: 20px;
        }

        td span {
            text-align: left;
            font-size: 11px;
            height: 20px;
            padding-left: 5px;
            padding-top: 5px;
            text-decoration: underline;
            font-style: italic;
        }

        .data_table1 td {
            vertical-align: middle;
            text-align: left;
            font-size: 12px;
            height: 13px;
            padding-left: 5px;
        }

        @media print {
            .data_table th {
                vertical-align: middle;
                text-align: center;
                font-size: 11px;
                font-weight: bold;
                height: 30px;
                border: 1px solid #999;
                background-color: #FF0;
            }
        }
    </style>
</head>

<body>
<table width="1400" height="550" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper">
    <tbody>
    <tr>
        <td>
            <h2>HASIL MUSRENBANG DESA</h2>
            <h2>
                @if($showKecamatan)
                    KECAMATAN {{ $anggaran->districtOpd->nama ?? '' }}
                    <br>
                @endif
                KABUPATEN SUKABUMI</h2>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="3" class="data_table">
                <tbody>
                <tr style="border-bottom:#999 solid 2px;">
                    <th rowspan="3" width="50">No</th>
                    <th rowspan="3" width="100">Kegiatan</th>
                    <th rowspan="3" width="300">Indikator Keluaran Kegiatan</th>
                    <th rowspan="3" width="100">Sumber Anggaran</th>
                    <th rowspan="3" width="30">Lokasi</th>
                    <th rowspan="3" width="100">SKPD Pelaksana</th>
                    <th rowspan="3" width="100">Kecamatan</th>
                    <th rowspan="3" width="100">Desa</th>
                </tr>
                <tr style="border-bottom:#999 solid 2px;"></tr>
                <tr style="border-bottom:#999 solid 2px;"></tr>

                @foreach (json_decode($items) as $idx => $anggaran)
                    <tr>
                        <td align="center">{{ ++$idx }}</td>
                        <td style="padding-left:25px;">{{ $anggaran->kegiatan->nama }}</td>
                        <td style="text-align:left;">
                            @foreach ($anggaran->target_anggaran as $target)
                                @if ($target->indikator_kegiatan->indikator_hasil_id == 2)
                                <ul class="list-item">
                                    <li>{{ $target->indikator_kegiatan->tolak_ukur }} Target
                                        : {{ $target->target }} {{ $target->indikator_kegiatan->satuan->nama  }}</li>
                                </ul>
                                @endif
                            @endforeach
                        </td>
                        <td style="text-align:right;">{{ $anggaran->sumber_anggaran->nama }}</td>
                        <td style="text-align:left;">{{ $anggaran->lokasi }}</td>
                        <td style="text-align:right;">{{ $anggaran->opd_pelaksana->nama }}</td>
                        <td style="text-align:right;">{{ get_kecamatan_from_location($anggaran->lokasi) }}</td>
                        <td style="text-align:right;">{{ get_desa_from_location($anggaran->lokasi) }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <colgroup>
                    <col style=" width: 10%;">
                    <col style=" width: 23%;">
                    <col style=" width: 34%;">
                    <col style=" width: 30%;">
                </colgroup>
                <tbody>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="23%">&nbsp;</td>
                    <td width="35%">&nbsp;</td>
                    <td width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="3"></td>
                    <td style="text-align:left;">Sukabumi, {{ \Carbon\Carbon::now()->format('d F Y') }} <br>
                    </td>
                </tr>
                <tr style="height:40px;">
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:left;"><strong style="text-decoration:underline;"></strong><br><br>NIP :</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="text-align:center;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <colgroup>
                    <col style=" width: 10%;">
                    <col style=" width: 23%;">
                    <col style=" width: 34%;">
                    <col style=" width: 30%;">
                </colgroup>
                <tbody>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="23%">&nbsp;</td>
                    <td width="35%">&nbsp;</td>
                    <td width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="3">&nbsp;</td>
                    <td style="text-align:center;">&nbsp;</td>
                </tr>
                <tr style="height:40px;">
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="text-align:center;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    </tbody>
</table>


</body>
</html>