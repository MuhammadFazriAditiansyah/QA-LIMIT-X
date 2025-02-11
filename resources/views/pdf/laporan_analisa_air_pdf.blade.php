<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <title>Laporan Analisa Air {{ $laporan_analisa_air->nodokumen }}</title>
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

        td.left-col {
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <table cellpadding="3" style="border:solid; width:100%;">
        {{-- table kop surat --}}
        <table width="98%" style="border:solid; margin:10px auto;">
            <tr>
                <td rowspan="4" colspan="" align="center">
                    {{-- logo futami  --}}
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/futami bg.png'))) }}" style="width: 4cm; ">
                </td>
                <td colspan="" align="center">PT FUTAMI FOOD & BEVERAGES</td>
                <td colspan="" align="left">Document No.</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">FFB/FRM/QA/18/15</td>
            </tr>
            <tr>
                <td colspan="" rowspan="2" align="center" style="border-bottom-style:hidden;">FORMULIR</td>
                <td colspan="" align="left">Issued Date</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">18/05/2022</td>
            </tr>
            <tr>
                <td colspan="" align="left">Revission No.</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">000</td>
            </tr>
            <tr>
                <td colspan="" align="center" style="width:;">LAPORAN ANALISA AIR</td>
                <td colspan="" align="left">Page</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">1 of 1</td>
            </tr>
        </table>


        <table class="table-none" style="border:hidden; width:90%;">
            <tr>
                <td style="border-right-style:hidden;">
                    <table class="table-none" style="border:hidden; border-style:hidden; margin-left:1%;">
                        <tr style="border-style:none;">
                            <td style="border-style:none;">Nomor</td>
                            <td style="border-style:none;"> : {{ $laporan_analisa_air->nodokumen }}</td>
                        </tr>
                        <tr>
                            <td style="border-style:none;">Tanggal Sampling</td>
                            <td style="border-style:none;"> :
                                {{ Carbon\carbon::parse($laporan_analisa_air->tgl_sampling)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>



        <table class="table" border="0" width="99%" style="margin:3px auto; margin-top:10px;border:solid; font-size:12px;">
            <tr style="">
                <td align="center" style="font-weight: bold;">No</td>
                <td align="center" style="font-weight: bold;">Sampel</td>
                <td align="center" style="font-weight: bold;">Pengujian</td>
                <td align="center" style="font-weight: bold;">Shift 1</td>
                <td align="center" style="font-weight: bold;">Shift 2</td>
                <td align="center" style="font-weight: bold;">keterangan</td>
            </tr>

            @foreach ($sampel_null as $sampel)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $sampel->sampel }}</td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->pengujian }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->shift_1 }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </table>
                    </td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->shift_2 }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->keterangan }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </table>
                    </td>
                </tr>
            @endforeach

            @foreach ($sampel_laporan_analisa_air as $sampel)
                <tr>
                    <td align="center">{{ $no=$no+1 }}</td>
                    <td align="center">{{ $sampel->sampel }}</td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->pengujian }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </table>
                    </td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->shift_1 }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </table>
                    </td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->shift_2 }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </table>
                    </td>
                    <td>
                        <table style="height: 10%; width:100%;">
                            @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                @if ($pengujian->sampel_id == $sampel->id)
                                    <tr style="height:20px; border-style:none;">
                                        <td align="center" style="height:20px;">{{ $pengujian->keterangan }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </table>
                    </td>
                </tr>
            @endforeach

        </table>



        <table border="0" width="auto" cellpadding="0" cellspacing="0" style=" margin:0 5px 10px auto; font-size:13px; border:solid; margin-top:10%; align:right;">
            <tr align="center" style="">
                <td style="border-top-style:hidden; border-left-style:hidden;"></td>
                <td style="border-left:solid; width:35mm;">Dibuat oleh</td>
                <td style="width:35mm;">Diperiksa oleh</td>
                <td style="width:35mm;">Disetujui oleh</td>
            </tr>
            <tr align="center">
                <td class="left-col" style="border-top:solid; height:12mm; width:18mm;" cellpadding="5">Tanda tangan</td>
                <td cellpadding="5">
                    @if ($laporan_analisa_air['statusOP'] == 0)
                        Belum ditandatangani
                    @elseif($laporan_analisa_air['statusOP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($laporan_analisa_air->user_id_OP . '_' . $laporan_analisa_air->name_id_OP),
                        ) !!}" alt="">
                    @endif
                </td>
                <td>
                    @if ($laporan_analisa_air['statusST'] == 0)
                        Belum ditandatangani
                    @elseif($laporan_analisa_air['statusST'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($laporan_analisa_air->user_id_ST . '_' . $laporan_analisa_air->name_id_ST),
                        ) !!}" alt="">
                    @elseif ($laporan_analisa_air['statusST'] == 2)
                        Ditolak
                    @endif
                </td>
                <td>
                    @if ($laporan_analisa_air['statusSP'] == 0)
                        Belum ditandatangani
                    @elseif($laporan_analisa_air['statusSP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($laporan_analisa_air->user_id_SP . '_' . $laporan_analisa_air->name_id_SP),
                        ) !!}" alt="">
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Jabatan</td>
                <td colspan="" align="center">QA Lab. Technician</td>
                <td colspan="" align="center">QA Staff</td>
                <td colspan="" align="center">QA Supervisor</td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Nama</td>
                <td colspan="" align="center">
                    @if ($laporan_analisa_air->name_id_OP == null)
                        Belum dibaca
                    @elseif($laporan_analisa_air->name_id_OP)
                        {{ $laporan_analisa_air->name_id_OP }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($laporan_analisa_air->statusST == 2)
                        Ditolak
                    @elseif($laporan_analisa_air->name_id_ST == null)
                        Belum dibaca
                    @elseif($laporan_analisa_air->name_id_ST)
                        {{ $laporan_analisa_air->name_id_ST }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($laporan_analisa_air->name_id_SP == null)
                        Belum dibaca
                    @elseif($laporan_analisa_air->name_id_SP)
                        {{ $laporan_analisa_air->name_id_SP }}
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Tanggal</td>
                <td colspan="" align="center">
                    @if ($laporan_analisa_air->created_at_OP == null)
                        Data kosong
                    @else
                        {{ Carbon\Carbon::parse($laporan_analisa_air->created_at_OP)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($laporan_analisa_air->statusST == 2)
                        Ditolak
                    @elseif ($laporan_analisa_air->created_at_ST == null)
                        Data kosong
                    @elseif ($laporan_analisa_air->statusST == 1)
                        {{ Carbon\Carbon::parse($laporan_analisa_air->created_at_ST)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($laporan_analisa_air->created_at_SP == null)
                        Data kosong
                    @else
                        {{ Carbon\Carbon::parse($laporan_analisa_air->created_at_SP)->translatedFormat('d F Y') }}
                    @endif
                </td>
            </tr>
        </table>


    </table>

</body>
</html>
