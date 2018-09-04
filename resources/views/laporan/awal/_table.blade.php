<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
    <title>LAPORAN Rancangan Awal</title>
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

        .right_colom {
            padding-left: 400px;
        }

        .data_colom {
            padding-left: 30px;
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

        .data_table1 {
            border-collapse: collapse;
        }

        .data_table1 td {
            vertical-align: middle;
            text-align: left;
            font-size: 12px;
            height: 13px;
            padding-left: 5px;
        }

        .specialy {
            text-align: center;
        }

        #catatan {
            float: left;
            width: 400px;
            height: 60px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            border: 1px #999 solid;
            text-align: left;
            font-weight: bold;
            color: #666;
            padding: 5px;
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
    <script src="//code.jquery.com/jquery.min.js"></script>
    <link href="{{ asset('/js/table2excel.js') }}" rel="stylesheet" type="text/css" />

    <script>
      var table2excel = new Table2Excel();

      document.getElementById('export').addEventListener('click', function() {
        table2excel.export(document.querySelectorAll('table'));
      });
    </script>

</head>

<body>


<div class="">
  <input type="button" id="export" value="export">
</div>
<!-- baru tabel -->
<table width="1400" height="550" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper" id="testTable">

<tr>
	<td colspan="3"  align="center">
	   DAFTAR RENCANA PROGRAM DAN KEGIATAN RANCANGAN AWAL TAHUN 2019
  </td>
</tr>
<tr>
	<td colspan="3"  align="center">
	   {{$anggaran->user->nama_lengkap }}
  </td>
</tr>
<tr>
	<td colspan="3"  align="center">
	   KABUPATEN SUKABUMI
  </td>
</tr>
<tr>
	<td colspan="3">
	<table width="100%" border="1" cellspacing="0" cellpadding="3" class="data_table">
    <tr style="border-bottom:#999 solid 2px;">
  		<th rowspan="3" width="50"><center>Nomor</center></th>
  		<th rowspan="3" width="70">Uraian Urusan, Organisasi, Program, dan Kegiatan</th>
  		<th rowspan="3" width="40">Indikator Sasaran</th>
  		<th rowspan="3" width="40">Sasaran Daerah</th>
  		<th rowspan="3" width="30">Lokasi</th>
  		<th colspan="9">Indikator Kerja tahun 2019</th>
      <th colspan="7">Usulan Pagu 2019</th>
    </tr>

    <tr style="border-bottom:#999 solid 2px;">
  		<th colspan="3">Hasil Program</th>
  		<th colspan="3">Keluaran Kegiatan</th>
  		<th colspan="3">Hasil Kegiatan</th>
      <th colspan="4">APBD Kabupaten</th>
      <th rowspan="2">APBD Provinsi</th>
      <th rowspan="2">APBN</th>
      <th rowspan="2">Total Usulan Pagu</th>
    </tr>

    <tr style="border-bottom:#999 solid 2px;">
  		<th width="50">Tolak Ukur</th>
  		<th width="30">Target</th>
  		<th width="30">Satuan</th>
  		<th width="50">Tolak Ukur</th>
  		<th width="30">Target</th>
  		<th width="30">Satuan</th>
  		<th width="50">Tolak Ukur</th>
  		<th width="30">Target</th>
  		<th width="30">Satuan</th>

      <th width="30">PIK P3K</th>
  		<th width="30">PIK Sektoral</th>
  		<th width="50">Pagu Indikatif</th>
      <th width="50">Jumlah</th>
    </tr>

   	<tr>
		    <td align="center"><center>1</center></td>
        <td align="center"><center>2</center></td>
        <td align="center"><center>4</center></td>
        <td align="center"><center>5</center></td>
        <td align="center"><center>6</center></td>
        <td align="center"><center>7</center></td>
        <td align="center"><center>8</center></td>
        <td align="center"><center>9</center></td>
        <td align="center"><center>10</center></td>
        <td align="center"><center>11</center></td>
        <td align="center"><center>12</center></td>
        <td align="center"><center>13</center></td>
        <td align="center"><center>14</center></td>
        <td align="center"><center>15</center></td>
        <td align="center"><center>16</center></td>
        <td align="center"><center>17</center></td>
        <td align="center"><center>18</center></td>
        <td align="center"><center>19</center></td>
        <td align="center"><center>20</center></td>
        <td align="center"><center>21</center></td>
        <td align="center"><center>22</center></td>
    </tr>

    <tr>
        <td style="background-color:#FF0; text-align:left;">

        </td>
        <td colspan="20" style="background-color:#FF0"></td>
    </tr>
    <tr>
        <td style="background-color:#FF0"></td>
        <td colspan="20" style="background-color:#FF0; text-align:left">
                <!-- @php($user = auth()->user())
                @php ($judul="1") -->
                {{$anggaran->user->nama_lengkap }}
        </td>
            @php ($nom="0")
            @php ($no="0")
            @foreach($program as $test2 => $nam)
                @foreach (json_decode($items) as $idx => $anggaran)
                    {{--{{ dd($anggaran) }}--}}
                    @if($nam->id == $anggaran->kegiatan->program_id)
                        @php(++$nom)
                        @php(++$no)
                        @if($nom == 1)
                        <tr>
                            <td style="background-color:#90EE90">{{$no}}</td>
                            <td colspan="20" style="background-color:#90EE90"> {{ $nam->nama }} </td>

                        </tr>
                        @endif
                        <tr>
                            <td align="left">{{$anggaran->prioritas}}</td>
                            <!-- <td align="center">2.09.23.{{ $nam->id }}.{{ ++$idx }}</td> -->
                            <td>{{ $anggaran->kegiatan->nama }}</td>
                            @foreach ($indikatorsasaran as $insan)
                                @if($insan->id==$anggaran->kegiatan->indikator_sasaran_id)
                                <td style="text-align:left;">
                                @php($indikator_program = $insan->nama)
                                {{$insan->nama}}
                                </td>
                                @foreach($sasaran as $new)
                                @if($new->id == $insan->sasaran_id)
                                <td style="text-align:left;">
                                {{$new->nama}}
                                </td>
                                @endif
                                @endforeach
                                @endif
                            @endforeach

                            <td style="text-align:left;">
                            @if($anggaran->jenis_lokasi_id === 3)
                                {{ $anggaran->lokasi }}
                            @elseif($anggaran->jenis_lokasi_id === 1)
                                [{{"Kantor OPD"}}]
                            @else
                                [{{"Tersebar"}}]
                            @endif
                            </td>

                            <td colspan="3" style="text-align:left;">
                            {{$indikator_program}}
                            </td>

                            <td colspan="3" style="text-align:left;">
                            @foreach ($anggaran->target_anggaran as $target)
                            @if ($target->indikator_kegiatan->indikator_hasil_id == 2)
                                    {{ $target->indikator_kegiatan->tolak_ukur.' '.$target->target.' '.$target->indikator_kegiatan->satuan->nama.'; ' }}
                            @endif
                            @endforeach
                            </td>

                            <td colspan="3" style="text-align:left;">
                            @foreach ($anggaran->target_anggaran as $target)
                            @if ($target->indikator_kegiatan->indikator_hasil_id == 3)
                                    {{ $target->indikator_kegiatan->tolak_ukur.' '.$target->target.' '.$target->indikator_kegiatan->satuan->nama.'; ' }}
                            @endif
                            @endforeach
                            </td>

                            <td style="text-align:left;">
                              @if($anggaran->sumber_anggaran_id==1)
                                {{number_format($anggaran->pagu, 2)}}
                              @endif
                            </td>
                            <td style="text-align:left;">
                              @if($anggaran->sumber_anggaran_id==2)
                                {{number_format($anggaran->pagu, 2)}}
                              @endif
                            </td>
                            <td style="text-align:left;">
                              @if($anggaran->sumber_anggaran_id==3)
                                {{number_format($anggaran->pagu, 2)}}
                              @endif
                            </td>
                            <td style="text-align:left;">{{number_format($anggaran->pagu, 2)}}</td>
                            <td style="text-align:left;">
                              @if($anggaran->sumber_anggaran_id==4)
                                {{number_format($anggaran->pagu, 2)}}
                              @endif
                            </td>
                            <td style="text-align:left;">
                              @if($anggaran->sumber_anggaran_id==5)
                                {{number_format($anggaran->pagu, 2)}}
                              @endif
                            </td>
                            <td style="text-align:left;">{{number_format($anggaran->pagu, 2)}}</td>
                        </tr>
                    @endif
                @endforeach
                @php($nom="0")
            @endforeach
</table>
</body>


</html>
