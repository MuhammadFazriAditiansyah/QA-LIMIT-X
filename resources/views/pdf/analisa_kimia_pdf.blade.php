<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
    <meta name="author" content="Nur Alief Farhan" />
    <title>Laporan Analisa Kimia {{ $futami->nodokumen }}</title>
</head>

<body>
    <style>
        @page {
            margin-left: 0.1in;
            margin-right: 0.1in;
            margin-top: 0.1in;
            margin-bottom: 0.1in;
        }

        body {
            margin-left: 0.1in;
            margin-right: 0.1in;
            margin-top: 0.1in;
            margin-bottom: 0.1in;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    {{-- table sarang --}}
    <table border="0" width="100%" cellpadding="0" cellspacing="0" style="border:solid;">
        <tr>
            <td colspan="2" align="center">
                {{-- table kop surat --}}
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="4" colspan="" align="center">
                            {{-- logo futami  --}}
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/futami bg.png'))) }}" style="width: 4cm; ">
                        </td>
                        <td colspan="" align="center">PT FUTAMI FOOD & BEVERAGES</td>
                        <td colspan="" align="left">Document No.</td>
                        <td colspan="" align="left">:</td>
                        <td colspan="" align="left" style="border-left-style: hidden;">FFB/FRM/QA/18/17</td>
                    </tr>
                    <tr>
                        <td colspan="" rowspan="2" align="center" style="border-bottom-style: hidden;">FORMULIR</td>
                        <td colspan="" align="left">Issued Date</td>
                        <td colspan="" align="left">:</td>
                        <td colspan="" align="left" style="border-left-style: hidden;">18/05/2022</td>
                    </tr>
                    <tr>
                        <td colspan="" align="left">Revission No.</td>
                        <td colspan="" align="left">:</td>
                        <td colspan="" align="left" style="border-left-style: hidden;">000</td>
                    </tr>
                    <tr>
                        <td colspan="" align="center">LAPORAN ANALISA KIMIA</td>
                        <td colspan="" align="left">Page</td>
                        <td colspan="" align="left">:</td>
                        <td colspan="" align="left" style="border-left-style: hidden;">1 of 1</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-rigth-style:hidden;">
                {{-- table dokumen kiri --}}
                <table style="width:100%; height:90px; border:none; border-style:none; border-right-style:hidden;">
                    <tr style="border:none; border-right-style:none; ">
                        <td style="border:none; border-right-style:none;">No. Dokumen</td>
                        <td style="border:none; border-right-style:none;"> : </td>
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none;">{{ $futami->nodokumen }}</td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;">Pemberi sampel</td>
                        <td style="border:none;"> : </td>
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none;">{{ $futami->pemberi_sampel }}</td>
                    </tr>
                    {{-- <tr style="border:none;">
                        <td style="border:none;">Parameter pengujian</td>
                        <td style="border:none;"> : </td>
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none;">{{ $futami->parameter_pengujian }}</td>
                    </tr> --}}
                    {{-- <tr style="border:none;">
                        <td style="border:none;"> </td>
                        <td style="border:none;"> </td>
                        <td style="border-left-style:none; border-right-style:hidden;"> </td>
                    </tr>  --}}
                    <tr style="border:none;">
                        <td style="border:none;">Parameter Pengujian</td>
                        <td style="border:none;"> : </td>
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none;">{{ $futami->parameter_pengujian }}</td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none; border-bottom-style:none; border-top-style:none;"> </td>
                        <td style="border:none; border-bottom-style:none; border-top-style:none;"> </td>
                        <td style="border:none; border-left-style:none; border-right-style:hidden; border-top-style:none;"> </td>
                    </tr>


                    {{-- <tr style="border:none;">
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;"> </td>
                        <td style="border:none;"> </td>
                        <td style="border:none;"> </td>
                    </tr> --}}
                </table>
            </td>
            <td style="border-left-style:hidden;">
                {{-- table tanggal kanan --}}
                <table style="width:100%; border:none; border-style:none; border-left-style:hidden; border-top-style:none; padding-left:30px;">
                    <tr style="border:none; ">
                        <td style="border:none; border-left-style:hidden; ">Tanggal terima sampel</td>
                        <td style="border:none; border-left-style:none; "> : </td>
                        {{-- <td style="border:none; border-left-style:none; ">{{$futami->tanggal_terima}}</td> --}}
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none; border-left-style:none; ">
                            {{ Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d-m-Y') }}
                        </td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;">Jumlah Sampel</td>
                        <td style="border:none;"> : </td>
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none;">{{ $futami->jumlah_sampel }}</td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;">Tanggal uji</td>
                        <td style="border:none;"> : </td>
                        {{-- <td style="border:none;">{{$futami->tanggal_uji}}</td> --}}
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none;">
                            {{ Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d-m-Y') }}
                        </td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;">Tanggal selesai uji</td>
                        <td style="border:none;"> : </td>
                        {{-- <td style="border:none;">{{$futami->tanggal_selesai}}</td> --}}
                        <td style="border-left-style:none; border-right-style:hidden; border-top-style:none;">
                            {{ Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d-m-Y') }}
                        </td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;"> </td>
                        <td style="border:none;"> </td>
                        <td style="border:none;"> </td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;"> </td>
                        <td style="border:none;"> </td>
                        <td style="border:none;"> </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                {{-- table kop surat --}}
                <table width="100%" cellpadding="0" cellspacing="0"
                    style="border:none; border-style:none; border-left-style:none; border-right-style:none; border-top-style:none; border-bottom-style:none;">
                    <tr style="border-left-style: hidden; border-right-style:hidden; ">
                        <td rowspan="2" align="center">No</td>
                        <td rowspan="2" align="center">Sampel</td>
                        <td colspan="4" align="center">Parameter dan Nilai Uji</td>
                        <td rowspan="2" align="center">Spesifikasi</td>
                        <td rowspan="2" align="center">Keterangan</td>
                    </tr>
                    <tr style="border-left-style: hidden; border-right-style:hidden;">
                        <td colspan="" align="center">{{ $futami['parameter_pengujian'] }}</td>
                        <td colspan="" align="center">{{ $futami['parameter_pengujian_c2'] }}</td>
                        <td colspan="" align="center">{{ $futami['parameter_pengujian_c3'] }}</td>
                        <td colspan="" align="center">{{ $futami['parameter_pengujian_c4'] }}</td>
                    </tr>
                    @foreach ($futami_sampel_kimia as $sampel)
                        <tr style="border-left-style: hidden; border-right-style:hidden;">
                            <td colspan="" align="center">{{ $loop->iteration }}</td>
                            <td colspan="" align="center">{{ $sampel->sampel }}</td>
                            <td colspan="" align="center">{{ $sampel->parameter_nilaiuji }}</td>
                            <td colspan="" align="center">{{ $sampel->parameter_nilaiuji_c2 }}</td>
                            <td colspan="" align="center">{{ $sampel->parameter_nilaiuji_c3 }}</td>
                            <td colspan="" align="center">{{ $sampel->parameter_nilaiuji_c4 }}</td>
                            <td colspan="" align="center">{{ $sampel->spesifikasi }}</td>
                            <td colspan="" align="center">{{ $sampel->keterangan }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">

                <table
                    style="width:100%; height:20px; border:none; border-style:none; border-right-style:none; border-top-style:none; border-bottom-style:none;">
                    <tr style="border:none;">
                        <td style="border:none;"></td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;"> </td>
                    </tr>
                    <tr style="border:none;">
                        <td style="border:none;"></td>
                    </tr>
                </table>



                {{-- table kop surat --}}
                <table align="right" width="60%" cellpadding="0" cellspacing="0" style="border:none; border-style:none; border-left-style:none; border-right-style:none; border-top-style:none; border-bottom-style:none; position:fixed bottom;">
                    <tr style="border-left-style: hidden; border-right-style:hidden;">
                        <td style="border-top-style:none; border-right-style:none; border-left-style:none;" rowspan="6" align="center"></td>
                        <td style="border-top-style:none; border-left-style:none;" colspan="" align="center"> </td>
                        <td colspan="" align="center" style="width: 35mm;">Dibuat oleh</td>
                        <td colspan="" align="center" style="width: 35mm;">Diperiksa oleh</td>
                        <td colspan="" align="center" style="width: 35mm;">Disetujui oleh</td>
                    </tr>
                    <tr style="border-left-style: hidden; border-right-style:hidden;">
                        <td rowspan="2" align="center" style="width: 18mm; height:12mm;">Tanda tangan</td>
                        <td rowspan="2" align="center">
                            @if ($futami['statusOP'] == 0)
                                Belum ditandatangani
                            @elseif($futami['statusOP'] == 1)

                            {{-- {!! (QrCode::size(37/26)->generate($futami->user_id_OP . '_' . $futami->name_id_OP)) !!} --}}
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(37)->generate($futami->user_id_OP .'_'. $futami->name_id_OP)) !!}" alt="">
                            @endif
                        </td>
                        <td rowspan="2" align="center">
                            @if ($futami['statusST'] == 0)
                                Belum ditandatangani
                            @elseif($futami['statusST'] == 1)
                                {{-- {!! QrCode::size(80)->generate($futami->user_id_ST . '_' . $futami->name_id_ST) !!} --}}
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(37)->generate($futami->user_id_ST .'_'. $futami->name_id_ST)) !!}" alt="">
                            @elseif ($futami['statusST'] == 2)
                                Ditolak
                            @endif
                        </td>
                        <td style="border-right-style:hidden;" rowspan="2" align="center">
                            @if ($futami['statusSP'] == 0)
                                Belum ditandatangani
                            @elseif($futami['statusSP'] == 1)
                                {{-- {!! QrCode::size(37)->generate($futami->user_id_SP . '_' . $futami->name_id_SP) !!} --}}
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(37)->generate($futami->user_id_SP .'_'. $futami->name_id_SP)) !!}" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr style="border-left-style: hidden; border-right-style:hidden;">
                        <td></td>
                    </tr>
                    <tr style="border-left-style: hidden; border-right-style:hidden;">
                        <td colspan="" align="center" style="height: 6mm;">Jabatan</td>
                        <td colspan="" align="center">QA Lab. Technician</td>
                        <td colspan="" align="center">QA Staff</td>
                        <td colspan="" align="center">QA Supervisor</td>
                    </tr>
                    <tr style="border-left-style: hidden; border-right-style:hidden;">
                        <td colspan="" align="center" style="height: 6mm;">Nama</td>
                        <td colspan="" align="center">
                            @if ($futami->name_id_OP == null)
                                Belum dibaca
                            @elseif($futami->name_id_OP)
                                {{ $futami->name_id_OP }}
                            @endif
                        </td>
                        <td colspan="" align="center">
                            @if ($futami->statusST == 2)
                                Ditolak
                            @elseif($futami->name_id_ST == null)
                                Belum dibaca
                            @elseif($futami->name_id_ST)
                                {{ $futami->name_id_ST }}
                            @endif
                        </td>
                        {{-- <td colspan="" align="center">{{ $futami->name_id_SP }}</td> --}}
                        <td colspan="" align="center">
                            @if ($futami->name_id_SP == null)
                                Belum dibaca
                            @elseif($futami->name_id_SP)
                                {{ $futami->name_id_SP }}
                            @endif
                        </td>
                    </tr>
                    <tr style="border-left-style: hidden; border-right-style:hidden;">
                        <td colspan="" align="center" style="height:6mm;">Tanggal</td>
                        <td colspan="" align="center">
                            @if ($futami->created_at_OP == null)
                                Data kosong
                            @else
                                {{ Carbon\Carbon::parse($futami->created_at_OP)->translatedFormat('d F Y') }}
                            @endif
                        </td>
                        <td colspan="" align="center">
                            @if ($futami->statusST == 2)
                                Ditolak
                            @elseif ($futami->created_at_ST == null)
                                Data kosong
                            @elseif ($futami->statusST == 1)
                                {{ Carbon\Carbon::parse($futami->created_at_ST)->translatedFormat('d F Y') }}
                            @endif
                        </td>
                        <td colspan="" align="center">
                            @if ($futami->created_at_SP == null)
                                Data kosong
                            @else
                                {{ Carbon\Carbon::parse($futami->created_at_SP)->translatedFormat('d F Y') }}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        {{-- <tr>
          <td>
              <table style="width:100%;" align="center" style=" border-top-style:hidden; border-bottom-style:hidden; ">
                  <tr align="center">
                    <td>.</td>
                    <td>Dibuat oleh</td>
                    <td>Diperiksa oleh</td>
                    <td>Disetujui oleh</td>
                  </tr>
                  <tr align="center">
                    <td>Tanda <br> Tangan</td>
                    <td>ttd</td>
                    <td>ttd</td>
                    <td>ttd</td>
                  </tr>
                  <tr align="center">
                    <td>Jabatan</td>
                    <td>QA Lab. Technician</td>
                    <td>QA Staff</td>
                    <td>QA Supervisor</td>
                  </tr>
                  <tr align="center">
                    <td>Nama</td>
                    <td>operator</td>
                    <td>staff</td>
                    <td>supervisor</td>
                  </tr>
                  <tr align="center">
                    <td>Tanggal</td>
                    <td>1/23/2023</td>
                    <td>1/23/2023</td>
                    <td>1/23/2023</td>
                  </tr>
                  <tr align="center" style="border-style: none; border:none; border-left-style:hidden; border-right-style:hidden;">
                    <td style="border-style: none;"></td>
                    <td style="border-style: none;"></td>
                    <td style="border-style: none;"></td>
                    <td style="border-style: none;"></td>
                  </tr>
              </table>
          </td>
        </tr> --}}
    </table>
</body>

</html>
