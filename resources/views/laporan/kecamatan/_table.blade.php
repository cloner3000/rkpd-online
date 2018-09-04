<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
    <title>LAPORAN musrenbang kabupaten</title>
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
</head>

<body>


<!-- baru tabel -->
<table width="1400" height="550" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper">
<tr>
    <td colspan="3">
    <h2>DAFTAR RENCANA PROGRAM DAN KEGIATAN PRIORITAS TAHUN 2018</h2>

    </td>
</tr>

<tr>
    <td colspan="3">
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="data_table">
    <tr style="border-bottom:#999 solid 2px;">
        <th rowspan="3" width="50"><center>Nomer</center></th>
        <th rowspan="3" width="70">Uraian Urusan, Organisasi, Program, dan Kegiatan</th>
       
        <th rowspan="3" width="70">Deskripsi Kegiatan</th>
        <th rowspan="3" width="40">Sasaran Daerah</th>
        <th rowspan="3" width="40">Indikator Sasaran</th>
        <th rowspan="3" width="30">Lokasi</th>
        <th colspan="9">Indikator Kerja tahun 2019</th>
        <th rowspan="3" width="70">Biaya</th>
    
    </tr>
    <tr style="border-bottom:#999 solid 2px;">
        <th colspan="3">Hasil Program</th>
        <th colspan="3">Keluaran Kegiatan</th>
        <th colspan="3">Hasil Kegiatan</th>
       
        
        
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
        <td align="center"><center>
      
        </center></td>
    </tr>   
    <tr>
        <td align="center" style="background-color:#FF0"><center></center></td>
        <td colspan="16" style="background-color:#FF0">
    
        </td>
        </tr>
        <tr>
        <td style="background-color:#FF0"></td>
        <td colspan="16" style="background-color:#FF0">  
                @php($user = auth()->user())
                @php ($judul="1")
               {{$user->nama_lengkap}}
                              
        </td>   
                <tr style="border-bottom:#999 solid 2px;"></tr>
                <tr style="border-bottom:#999 solid 2px;"></tr>
            
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
                            <td colspan="16" style="background-color:#90EE90"> {{ucwords($nam->nama)}} </td>
                            <td> &nbsp; </td>
                            <td> &nbsp; </td> 
                        </tr>
                        @endif
                        <tr>
                            <td align="center">2.09.23.{{ $nam->id }}.{{ ++$idx }}</td>
                            <td>{{ $anggaran->kegiatan->nama }}</td>
                            <td style="text-align:left;">{{ $anggaran->kegiatan->deskripsi }}</td>
                            
                            <td style="text-align:right;">
                            &nbsp;
                            </td>
                            <td style="text-align:right;">
                            &nbsp;
                            </td>
                            <!-- @foreach ($indikatorsasaran as $insan)
                                @if($insan->id==$anggaran->kegiatan->indikator_sasaran_id)
                                <td style="text-align:right;">
                                {{$insan->nama}}
                                </td>
                                @foreach($sasaran as $new)
                                @if($new->id == $insan->sasaran_id)
                                <td style="text-align:right;">
                                {{$new->nama}}
                                </td>
                                @endif
                                @endforeach
                                @endif    
                            @endforeach -->
                    
                            <td style="text-align:left;">
                            @if($anggaran->jenis_lokasi_id === 3)
                                [{{ get_desa_from_location($anggaran->lokasi) }}]
                            @elseif($anggaran->jenis_lokasi_id === 1)
                                [{{"Kantor OPD"}}]
                            @else
                                [{{"Tersebar"}}]
                            @endif
                            </td>
                            <td colspan="3" style="text-align:left;">                   
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
                   
                            <td style="text-align:left;"></td>
                        </tr>
                    @endif
                @endforeach
                @php($nom="0")
            @endforeach
    
              
                  <h2>{{ $anggaran->opd_pelaksana->nama }}</h2>  
                  @php ($judul=$anggaran->opd_pelaksana->nama)   
                   
                    <h2>KABUPATEN SUKABUMI</h2>
    <tr>
        <td colspan="17"="center">Jumlah Keseluruhan</td>
       
    </tr>   
  
</table>
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
</td></tr></table>

</body>
</html>