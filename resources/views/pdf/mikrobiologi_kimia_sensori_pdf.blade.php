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
    <title>Laporan Pemeriksaan Kimia Dan Sensori {{ $mikrobiologi_kimia_sensori->nodokumen }}</title>
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
        <table width="98%" style="border:solid; margin:10px auto; font-size:14px;">
            <tr>
                <td rowspan="4" colspan="" align="center">
                    {{-- logo futami  --}}
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/futami bg.png'))) }}" style="width: 4cm; ">
                </td>
                <td colspan="" align="center">PT FUTAMI FOOD & BEVERAGES</td>
                <td colspan="" align="left">Document No.</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">FFB/FRM/QA/18/27</td>
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
                <td colspan="" align="center" style="width:;">PEMERIKSAAN KIMIA DAN SENSORI</td>
                <td colspan="" align="left">Page</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">1 of 1</td>
            </tr>
        </table>


        <table class="table-none" style="border:hidden; width:90%;">
            <tr>
                <td style="border-right-style:hidden;">
                    <table class="table-none" style="border:hidden; border-style:hidden; margin-left:10%; font-size:12px;">
                        <tr style="border-style:none;">
                            <td style="border-style:none;">Nomor</td>
                            <td style="border-style:none;"> : {{ $mikrobiologi_kimia_sensori->nodokumen }}</td>
                        </tr>
                        <tr>
                            <td style="border-style:none;">Tanggal Produksi</td>
                            <td style="border-style:none;"> :
                                {{ Carbon\carbon::parse($mikrobiologi_kimia_sensori->tgl_produksi)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table-none" style="border:hidden; border-style:hidden; margin-left:10%; font-size:12px;">
                        <tr style="border-style:none;">
                            <td style="border-style:none;">Nama Produk</td>
                            <td style="border-style:none;"> : {{ $mikrobiologi_kimia_sensori->nama_produk }}</td>
                        </tr>
                        <tr>
                            <td style="border-style:none;">Jumlah Batch</td>
                            <td style="border-style:none;"> : {{ $mikrobiologi_kimia_sensori->jumlah_batch }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>



        <table class="table" border="0" width="99%" cellpadding="0" cellspacing="0" style="margin:3px auto; margin-top:10px;border:solid; font-size:12px;">
            <tr style="">
                <td align="center">No</td>
                <td align="center">Kode Sampling</td>
                <td align="center">Waktu</td>
                <td align="center">Exp Date</td>

                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c1 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c1 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c1 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c2 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c2 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c2 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c3 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c3 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c3 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c4 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c4 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c4 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c5 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c5 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c5 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c6 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c6 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c6 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c7 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c7 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c7 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c8 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c8 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c8 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c9 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c9 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c9 }})</sup>
                    @endif
                </td>
                <td align="center">
                    {{ $mikrobiologi_kimia_sensori->parameter_c10 }}
                    @if ($mikrobiologi_kimia_sensori->satuan_c10 != null)
                        <sup>({{ $mikrobiologi_kimia_sensori->satuan_c10 }})</sup>
                    @endif
                </td>

            </tr>
            @foreach ($sampel_mikrobiologi_kimia_sensori as $kimia_sensori)
                <tr align="center">
                    <td colspan="" align="center">{{ $loop->iteration }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->kode_sampling }}</td>
                    <td>{{ Carbon\carbon::parse($kimia_sensori->waktu)->translatedFormat('h:i') }}</td>
                    <td>{{ Carbon\carbon::parse($kimia_sensori->exp_date)->translatedFormat('d F Y') }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c1 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c2 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c3 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c4 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c5 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c6 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c7 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c8 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c9 }}</td>
                    <td colspan="" align="center">{{ $kimia_sensori->parameter_c10 }}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="border-right-style: none; width:70px;">Keterangan : </td>
                    <td align="left" colspan="13" style="padding:3px; border-left-style:none;">{{ $mikrobiologi_kimia_sensori->keterangan }}</td>
                </tr>
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
                    @if ($mikrobiologi_kimia_sensori['statusOP'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_kimia_sensori['statusOP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($mikrobiologi_kimia_sensori->user_id_OP . '_' . $mikrobiologi_kimia_sensori->name_id_OP),
                        ) !!}" alt="">
                    @endif
                </td>
                <td>
                    @if ($mikrobiologi_kimia_sensori['statusST'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_kimia_sensori['statusST'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($mikrobiologi_kimia_sensori->user_id_ST . '_' . $mikrobiologi_kimia_sensori->name_id_ST),
                        ) !!}" alt="">
                    @elseif ($mikrobiologi_kimia_sensori['statusST'] == 2)
                        Ditolak
                    @endif
                </td>
                <td>
                    @if ($mikrobiologi_kimia_sensori['statusSP'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_kimia_sensori['statusSP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($mikrobiologi_kimia_sensori->user_id_SP . '_' . $mikrobiologi_kimia_sensori->name_id_SP),
                        ) !!}" alt="">
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Jabatan</td>
                <td colspan="" align="center">QA Lab. Technician</td>
                <td colspan="" align="center">QA Staff</td>
                <td colspan="" align="center">QA Product Release</td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Nama</td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_kimia_sensori->name_id_OP == null)
                        Belum dibaca
                    @elseif($mikrobiologi_kimia_sensori->name_id_OP)
                        {{ $mikrobiologi_kimia_sensori->name_id_OP }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_kimia_sensori->statusST == 2)
                        Ditolak
                    @elseif($mikrobiologi_kimia_sensori->name_id_ST == null)
                        Belum dibaca
                    @elseif($mikrobiologi_kimia_sensori->name_id_ST)
                        {{ $mikrobiologi_kimia_sensori->name_id_ST }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_kimia_sensori->name_id_SP == null)
                        Belum dibaca
                    @elseif($mikrobiologi_kimia_sensori->name_id_SP)
                        {{ $mikrobiologi_kimia_sensori->name_id_SP }}
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Tanggal</td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_kimia_sensori->created_at_OP == null)
                        Data kosong
                    @else
                        {{ Carbon\Carbon::parse($mikrobiologi_kimia_sensori->created_at_OP)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_kimia_sensori->statusST == 2)
                        Ditolak
                    @elseif ($mikrobiologi_kimia_sensori->created_at_ST == null)
                        Data kosong
                    @elseif ($mikrobiologi_kimia_sensori->statusST == 1)
                        {{ Carbon\Carbon::parse($mikrobiologi_kimia_sensori->created_at_ST)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_kimia_sensori->created_at_SP == null)
                        Data kosong
                    @else
                        {{ Carbon\Carbon::parse($mikrobiologi_kimia_sensori->created_at_SP)->translatedFormat('d F Y') }}
                    @endif
                </td>
            </tr>
        </table>


    </table>


</body>

</html>
