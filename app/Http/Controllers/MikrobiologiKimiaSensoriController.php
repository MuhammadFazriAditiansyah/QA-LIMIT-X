<?php

namespace App\Http\Controllers;

use App\Models\Mikrobiologi_kimia_sensori;
use Illuminate\Http\Request;
use App\Models\Sampel_mikrobiologi_kimia_sensori;
use App\Models\Parameter_pengujian;
use App\Models\Satuan_parameter_pengujian;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MikrobiologiKimiaSensoriExport;


class MikrobiologiKimiaSensoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Operator Function
    public function mikrobiologi_kimia_sensori(Request $request)
    {
        // $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 0)->get();

        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 0);

        if ($request->has('tgl_produksi_awal') && $request->has('tgl_produksi_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_produksi_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_produksi_akhir)->toDateTimeString();
            $mikrobiologi_kimia_sensori->whereBetween('tgl_produksi', [$tgl_mulai, $tgl_selesai]);
        }

        $mikrobiologi_kimia_sensori = $mikrobiologi_kimia_sensori->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_kimia_sensori.operator.mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori'))->with('no', ($mikrobiologi_kimia_sensori->currentPage() - 1) * $mikrobiologi_kimia_sensori->perPage() + 1);

        // return view('mikrobiologi_kimia_sensori.operator.mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori'))->with('no');
    }

    public function add_mikrobiologi_kimia_sensori(Request $request)
    {
        $parameter = Parameter_pengujian::all();
        $input_satuan = Satuan_parameter_pengujian::all();
        return view('mikrobiologi_kimia_sensori.operator.add_mikrobiologi_kimia_sensori', compact('parameter', 'input_satuan'));
    }

    public function input_mikrobiologi_kimia_sensori(Request $request)
    {
        $request->validate([
            'tgl_produksi' => 'required',
            'nama_produk' => 'required',
            'jumlah_batch' => 'required',
            'nodokumen' => 'required',
        ],[
            'tgl_produksi.required' => 'Kolom tanggal produksi harus di isi',
            'nama_produk.required' => 'Kolom nama produk harus di isi',
            'jumlah_batch.required' => 'Kolom jumlah batch harus di isi',
            'nodokumen.required' => 'Kolom No dokumen harus di isi',
        ]);

        // $get_now = Carbon::now()->translatedFormat('d-m-y h:i:s');
        // $get_tahun = Carbon::now()->translatedFormat('y');
        // $get_bulan = Carbon::now()->translatedFormat('m');
        // $get_menit = Carbon::now()->translatedFormat('i');

        // function numberToRoman($num)
        // {
        //     // Be sure to convert the given parameter into an integer
        //     $n = intval($num);
        //     $result = '';

        //     // Declare a lookup array that we will use to traverse the number:
        //     $lookup = array(
        //         'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
        //         'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
        //         'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        //     );

        //     foreach ($lookup as $roman => $value)
        //     {
        //         // Look for number of matches
        //         $matches = intval($n / $value);

        //         // Concatenate characters
        //         $result .= str_repeat($roman, $matches);

        //         // Substract that from the number
        //         $n = $n % $value;
        //     }

        //     return $result;
        // }

        // $get_last_no_dokumen = Mikrobiologi_kimia_sensori::latest()->first();

        // if(is_null($get_last_no_dokumen) || $get_last_no_dokumen->created_at->format('y') !== $get_tahun) {
        //     $get_last_no_dokumen = 0;
        // } else {
        //     $get_last_no_dokumen = $get_last_no_dokumen->nodokumen;
        // }

        // $nodokumen_get_num = explode("/", $get_last_no_dokumen)[0]+1; //membagi angka dengan axplode
        // $nodokumen = $nodokumen_get_num."/PKS/".numberToRoman($get_bulan)."/".$get_tahun;


        // dd($nodokumen);

        //get tahun "sudah"
        //get bulan -> setelah get bulan konversi bulan ke romawi ""sudah
        //get nomor dokumen terakhir dengan cara
        //get nomor dokumen dari database dari record paling terakhir,
        // $get_last_no_dokumen = Futami::latest()->first()->nodokumen;
        //setelah dapat nomor dokumen parsing hanya nomor saja
        //setelah dapat nomornya saja + 1
        //setelah dapat semua formatnya gabung jadi 1 variable nodokumen

        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::create([
            'nodokumen' => $request->nodokumen,
            'tgl_produksi' => $request->tgl_produksi,
            'nama_produk' => $request->nama_produk,
            'jumlah_batch' => $request->jumlah_batch,
            'keterangan' => $request->keterangan,
            // 'nodokumen' => $request->nodokumen,

            'parameter_c1' => $request->parameter_c1,
            'parameter_c2' => $request->parameter_c2,
            'parameter_c3' => $request->parameter_c3,
            'parameter_c4' => $request->parameter_c4,
            'parameter_c5' => $request->parameter_c5,
            'parameter_c6' => $request->parameter_c6,
            'parameter_c7' => $request->parameter_c7,
            'parameter_c8' => $request->parameter_c8,
            'parameter_c9' => $request->parameter_c9,
            'parameter_c10' => $request->parameter_c10,
            'satuan_c1' => $request->satuan_c1,
            'satuan_c2' => $request->satuan_c2,
            'satuan_c3' => $request->satuan_c3,
            'satuan_c4' => $request->satuan_c4,
            'satuan_c5' => $request->satuan_c5,
            'satuan_c6' => $request->satuan_c6,
            'satuan_c7' => $request->satuan_c7,
            'satuan_c8' => $request->satuan_c8,
            'satuan_c9' => $request->satuan_c9,
            'satuan_c10' => $request->satuan_c10,


            'statusOP' => 0,
            'statusST' => 0,
            'statusSP' => 0,
            'delete' => 0,
        ]);

        // dd($mikrobiologiProdukPercobaan);
        return redirect('/operator/sampel_mikrobiologi_kimia_sensori/' .$mikrobiologi_kimia_sensori->id)->with('successAdd', 'Berhasil membuat Dokumen Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }

    public function sampel_mikrobiologi_kimia_sensori(Request $request, $id)
    {
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::Where('id', $id)->first();
        $parameter = Parameter_pengujian::all();
        // $dataSatuan = Satuan_parameter_pengujian::all();

        return view('mikrobiologi_kimia_sensori.operator.sampel_mikrobiologi_kimia_sensori', compact('id', 'mikrobiologi_kimia_sensori', 'parameter'));
    }

    public function input_sampel_mikrobiologi_kimia_sensori(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'inputSampel' => 'required|array|min:1',

            'inputSampel.*.kode_sampling' => 'required',
            'inputSampel.*.waktu' => 'required',
            'inputSampel.*.exp_date' => 'required',
        ],[
            'inputSampel.required' => 'Kolom Kode Sampling harus di isi',
            'inputSampel.array' => 'Kolom Kode Sampling harus berupa array',
            'inputSampel.min' => 'Minimal satu Kode Sampling harus diisi',

            'inputSampel.*.kode_sampling.required' => 'Kolom Kode Sampling harus di isi',
            'inputSampel.*.waktu.required' => 'Kolom Waktu harus di isi',
            'inputSampel.*.exp_date.required' => 'Kolom Exp Date harus di isi',
        ]);

        foreach($request->inputSampel as $key => $value){
            DB::table('sampel_mikrobiologi_kimia_sensoris')->insert([
                'kode_sampling' => $value['kode_sampling'],
                'waktu' => $value['waktu'],
                'exp_date' => $value['exp_date'],
                'parameter_c1' => $value['parameter_c1'],
                'parameter_c2' => $value['parameter_c2'],
                'parameter_c3' => $value['parameter_c3'],
                'parameter_c4' => $value['parameter_c4'],
                'parameter_c5' => $value['parameter_c5'],
                'parameter_c6' => $value['parameter_c6'],
                'parameter_c7' => $value['parameter_c7'],
                'parameter_c8' => $value['parameter_c8'],
                'parameter_c9' => $value['parameter_c9'],
                'parameter_c10' => $value['parameter_c10'],

                // 'keterangan' => $value['keterangan'],
                'id_kimia_sensori' => $id,
            ]);
        }

        return redirect('/operator/mikrobiologi_kimia_sensori')->with('successAddSampel', 'Berhasil membuat Data Mikrobiologi Kimia Dan Sensori Baru!');
    }

    public function mikrobiologi_kimia_sensori_operatorttd(Request $request, $id)
    {
        $request->validate([
            'ttd_operator' => 'required',
        ],[
           'ttd_operator' => 'Kolom TTD harus di isi!',
        ]);

        Mikrobiologi_kimia_sensori::where('id', $id)->update([
            'statusOP' => 1,
            'user_id_OP' => auth::user()->id,
            'name_id_OP' => auth::user()->nama,
            // 'created_at_OP' => Carbon::now()->format('d F Y'),
            'created_at_OP' => $request->ttd_operator,
        ]);

        return redirect()->route('mikrobiologi_kimia_sensori')->with('operatorttd', 'Data telah ditandatangani oleh Operator!');
   }

    public function mikrobiologi_kimia_sensori_Destroy($id)
    {
        Mikrobiologi_kimia_sensori::where('id',$id)->update([
            'delete' => 1,
        ]);

        return redirect()->route('mikrobiologi_kimia_sensori')->with('successDelete', 'Berhasil menghapus dokumen!');
    }


    public function mikrobiologi_kimia_sensori_history(Request $request)
    {
        // $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 1)->get();

        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 1);

        if ($request->has('tgl_produksi_awal') && $request->has('tgl_produksi_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_produksi_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_produksi_akhir)->toDateTimeString();
            $mikrobiologi_kimia_sensori->whereBetween('tgl_produksi', [$tgl_mulai, $tgl_selesai]);
        }

        $mikrobiologi_kimia_sensori = $mikrobiologi_kimia_sensori->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_kimia_sensori.operator.history', compact('mikrobiologi_kimia_sensori'))->with('no', ($mikrobiologi_kimia_sensori->currentPage() - 1) * $mikrobiologi_kimia_sensori->perPage() + 1);

        // return view('mikrobiologi_kimia_sensori.operator.history', compact('mikrobiologi_kimia_sensori'))->with('no');
    }

    public function mikrobiologi_kimia_sensori_sampel(Request $request, $id)
    {
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::Where('id', $id)->first();
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', '=', $id)->get();

        return view('mikrobiologi_kimia_sensori.operator.dataSampel_mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori', 'sampel_mikrobiologi_kimia_sensori'))->with('no');
    }

    public function sampel_mikrobiologi_kimia_sensori_Destroy(Request $request, $id)
    {
        Sampel_mikrobiologi_kimia_sensori::where('id', '=', $id)->delete();
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data mikrobiologi kimia dan sensori!');
    }

    public function edit_mikrobiologi_kimia_sensori($id)
    {
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::Where('id', $id)->first();
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', '=', $id)->get();
        $parameter = Parameter_pengujian::all();
        $input_satuan = Satuan_parameter_pengujian::all();

        return view('mikrobiologi_kimia_sensori.operator.edit_mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori', 'sampel_mikrobiologi_kimia_sensori', 'parameter', 'input_satuan'));
    }

    public function update_mikrobiologi_kimia_sensori(Request $request, $id)
    {
        //validasi
        $request->validate([
            'tgl_produksi' => 'required',
            'nama_produk' => 'required',
            'jumlah_batch' => 'required',
        ],[
            'tgl_produksi.required' => 'Kolom tanggal produksi harus di isi',
            'nama_produk.required' => 'Kolom nama produk harus di isi',
            'jumlah_batch.required' => 'Kolom jumlah batch harus di isi',
        ]);
        $validasiData = Mikrobiologi_kimia_sensori::where('id', $id)->update([
            'tgl_produksi' => $request->tgl_produksi,
            'nama_produk' => $request->nama_produk,
            'jumlah_batch' => $request->jumlah_batch,
            'keterangan' => $request->keterangan,
            'nodokumen' => $request->nodokumen,

            'parameter_c1' => $request->parameter_c1,
            'parameter_c2' => $request->parameter_c2,
            'parameter_c3' => $request->parameter_c3,
            'parameter_c4' => $request->parameter_c4,
            'parameter_c5' => $request->parameter_c5,
            'parameter_c6' => $request->parameter_c6,
            'parameter_c7' => $request->parameter_c7,
            'parameter_c8' => $request->parameter_c8,
            'parameter_c9' => $request->parameter_c9,
            'parameter_c10' => $request->parameter_c10,
            'satuan_c1' => $request->satuan_c1,
            'satuan_c2' => $request->satuan_c2,
            'satuan_c3' => $request->satuan_c3,
            'satuan_c4' => $request->satuan_c4,
            'satuan_c5' => $request->satuan_c5,
            'satuan_c6' => $request->satuan_c6,
            'satuan_c7' => $request->satuan_c7,
            'satuan_c8' => $request->satuan_c8,
            'satuan_c9' => $request->satuan_c9,
            'satuan_c10' => $request->satuan_c10,
        ]);


        //Validasi edit sampel kimia
        $validasiSampel = $request->validate([
            'inputSampel.*.kode_sampling' => 'required',
            'inputSampel.*.waktu' => 'required',
            'inputSampel.*.exp_date' => 'required',
        ],[
            'inputSampel.*.kode_sampling.required' => 'Kolom Kode Sampling harus di isi',
            'inputSampel.*.waktu.required' => 'Kolom Waktu harus di isi',
            'inputSampel.*.exp_date.required' => 'Kolom Exp Date harus di isi',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            // 'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);

        $sampel_data = [];
        foreach ($request->inputSampel as $input) {
            $sampel = new Sampel_mikrobiologi_kimia_sensori();
            $sampel->kode_sampling = $input['kode_sampling'];
            $sampel->waktu = $input['waktu'];
            $sampel->exp_date = $input['exp_date'];

            $sampel->parameter_c1 = $input['parameter_c1'];
            $sampel->parameter_c2 = $input['parameter_c2'];
            $sampel->parameter_c3 = $input['parameter_c3'];
            $sampel->parameter_c4 = $input['parameter_c4'];
            $sampel->parameter_c5 = $input['parameter_c5'];
            $sampel->parameter_c6 = $input['parameter_c6'];
            $sampel->parameter_c7 = $input['parameter_c7'];
            $sampel->parameter_c8 = $input['parameter_c8'];
            $sampel->parameter_c9 = $input['parameter_c9'];
            $sampel->parameter_c10 = $input['parameter_c10'];

            // $sampel->penampakan = $input['penampakan'];
            // $sampel->endapan = $input['endapan'];
            // $sampel->warna = $input['warna'];
            // $sampel->rasa = $input['rasa'];
            // $sampel->aroma = $input['aroma'];
            // $sampel->brix = $input['brix'];
            // $sampel->acidity = $input['acidity'];
            // $sampel->ph = $input['ph'];
            // $sampel->density = $input['density'];
            // $sampel->volume = $input['volume'];

            // $sampel->keterangan = $input['keterangan'];
            $sampel_data[] = $sampel;
        }
        // dd($sampel_data);

        Mikrobiologi_kimia_sensori::find($id)->Sampel_mikrobiologi_kimia_sensori()->delete();
        Mikrobiologi_kimia_sensori::find($id)->Sampel_mikrobiologi_kimia_sensori()->saveMany($sampel_data);

        return redirect('/operator/mikrobiologi_kimia_sensori')->with('successUpdate','Berhasil mengupdate data Dokumen!');
    }

    public function OP_mikrobiologi_kimia_sensori_pdf($id)
    {
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_kimia_sensori_pdf', array('mikrobiologi_kimia_sensori' => $mikrobiologi_kimia_sensori, 'sampel_mikrobiologi_kimia_sensori'=>$sampel_mikrobiologi_kimia_sensori))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);

        // return $pdf->stream();



        $filename = 'Laporan Pemeriksaan Kimia Dan Sensori ' . $mikrobiologi_kimia_sensori->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }



    // public function OP_mikrobiologi_kimia_sensori_pdf($id)
    // {
    //     $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
    //     $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

    //     $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    //     $pdf = PDF::loadView('pdf.mikrobiologi_kimia_sensori_pdf', array('mikrobiologi_kimia_sensori' => $mikrobiologi_kimia_sensori, 'sampel_mikrobiologi_kimia_sensori'=>$sampel_mikrobiologi_kimia_sensori))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);

    //     $filename = 'laporan Analisa Mikrobiologi Kimia Dan Sensori ' . $mikrobiologi_kimia_sensori->nodokumen . '.pdf';
    //     return $pdf->download($filename);

    // }




    // Excel
    public function mikrobiologi_kimia_sensori_excel($id)
    {
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

        return view('Excel.mikrobiologi_kimia_sensori.show_mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori', 'sampel_mikrobiologi_kimia_sensori'));
    }
    public function mikrobiologi_kimia_sensori_excel_show($id)
    {
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

        return view('Excel.mikrobiologi_kimia_sensori.show_mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori', 'sampel_mikrobiologi_kimia_sensori'));
    }
    public function mikrobiologi_kimia_sensori_exportExcel($id)
    {
        // set_time_limit(300);

        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();
        $nodokumen = explode('/', $mikrobiologi_kimia_sensori->nodokumen);
        $dokumen = implode('_', $nodokumen);

        return Excel::download(new MikrobiologiKimiaSensoriExport($id), ''.$dokumen.'.xlsx');
    }

















    ///////Function Staff
    public function staff_mikrobiologi_kimia_sensori(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 0);

        if ($request->has('tgl_produksi_awal') && $request->has('tgl_produksi_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_produksi_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_produksi_akhir)->toDateTimeString();
            $mikrobiologi_kimia_sensori->whereBetween('tgl_produksi', [$tgl_mulai, $tgl_selesai]);
        }

        $mikrobiologi_kimia_sensori = $mikrobiologi_kimia_sensori->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_kimia_sensori.staff.mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori'))->with('no', ($mikrobiologi_kimia_sensori->currentPage() - 1) * $mikrobiologi_kimia_sensori->perPage() + 1);

        // return view('mikrobiologi_kimia_sensori.staff.mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori'))->with('no');
    }

    public function mikrobiologi_kimia_sensori_staffttd(Request $request, $id)
    {
        $request->validate([
            'ttd_staff' => 'required',
        ],[
           'ttd_staff' => 'Kolom TTD harus di isi!',
        ]);

        Mikrobiologi_kimia_sensori::where('id', $id)->update([
            'statusST' => 1,
            'user_id_ST' => auth::user()->id,
            'name_id_ST' => auth::user()->nama,
            // 'created_at_ST' => Carbon::now()->format('d F Y'),
            'created_at_ST' => $request->ttd_staff,
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        return redirect()->route('staff_mikrobiologi_kimia_sensori')->with('staffttd', 'Data Mikrobiologi Kimia Dan Sensori telah ditandatangani oleh Staff!');
    }

    public function mikrobiologi_kimia_sensori_declinettd($id)
    {
        Mikrobiologi_kimia_sensori::where('id', $id)->update([
            'statusST' => 2,
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        return redirect()->route('staff_mikrobiologi_kimia_sensori')->with('declinettd', 'Data Mikrobiologi Kimia Dan Sensori telah ditolak oleh Staff!');
    }


    public function ST_mikrobiologi_kimia_sensori_pdf($id)
    {
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_kimia_sensori_pdf', array('mikrobiologi_kimia_sensori' => $mikrobiologi_kimia_sensori, 'sampel_mikrobiologi_kimia_sensori'=>$sampel_mikrobiologi_kimia_sensori))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Pemeriksaan Kimia Dan Sensori ' . $mikrobiologi_kimia_sensori->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }











     ////Function Supervisor
    public function supervisor_mikrobiologi_kimia_sensori(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_produk::all();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 0);

        if ($request->has('tgl_produksi_awal') && $request->has('tgl_produksi_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_produksi_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_produksi_akhir)->toDateTimeString();
            $mikrobiologi_kimia_sensori->whereBetween('tgl_produksi', [$tgl_mulai, $tgl_selesai]);
        }

        $mikrobiologi_kimia_sensori = $mikrobiologi_kimia_sensori->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_kimia_sensori.supervisor.mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori'))->with('no', ($mikrobiologi_kimia_sensori->currentPage() - 1) * $mikrobiologi_kimia_sensori->perPage() + 1);

        // return view('mikrobiologi_kimia_sensori.supervisor.mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori'))->with('no');
    }
    public function mikrobiologi_kimia_sensori_supervisorttd(Request $request, $id)
    {
        $request->validate([
            'ttd_qaleader' => 'required',
        ],[
           'ttd_qaleader' => 'Kolom TTD harus di isi!',
        ]);

        Mikrobiologi_kimia_sensori::where('id', $id)->update([
            'statusSP' => 1,
            'user_id_SP' => auth::user()->id,
            'name_id_SP' => auth::user()->nama,
            // 'created_at_SP' => Carbon::now()->format('d F Y'),
            'created_at_SP' => $request->ttd_qaleader,
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        return redirect()->route('supervisor_mikrobiologi_kimia_sensori')->with('supervisorttd', 'Data Mikrobiologi Kimia Dan Sensori telah ditandatangani oleh Qa Product Leader!');
    }

    public function SP_mikrobiologi_kimia_sensori_pdf($id)
    {
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_kimia_sensori_pdf', array('mikrobiologi_kimia_sensori' => $mikrobiologi_kimia_sensori, 'sampel_mikrobiologi_kimia_sensori'=>$sampel_mikrobiologi_kimia_sensori))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);

        // return $pdf->stream();



        $filename = 'Laporan Pemeriksaan Kimia Dan Sensori ' . $mikrobiologi_kimia_sensori->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }
    // public function SP_mikrobiologi_kimia_sensori_pdf($id)
    // {
    //     $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
    //     $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

    //     $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    //     $pdf = PDF::loadView('pdf.mikrobiologi_kimia_sensori_pdf', array('mikrobiologi_kimia_sensori' => $mikrobiologi_kimia_sensori, 'sampel_mikrobiologi_kimia_sensori'=>$sampel_mikrobiologi_kimia_sensori))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
    //     // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
    //     return $pdf->stream();
    // }












    ////Function Superadmin

    public function superadmin_mikrobiologi_kimia_sensori(Request $request)
    {
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 0)->get();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);

        return view('mikrobiologi_kimia_sensori.superadmin.mikrobiologi_kimia_sensori_info', compact('mikrobiologi_kimia_sensori'))->with('no');
    }

    public function superadmin_mikrobiologi_kimia_sensori_sampel(Request $request, $id)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::all();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);

        return view('mikrobiologi_kimia_sensori.superadmin.mikrobiologi_kimia_sensori_sampel', compact('sampel_mikrobiologi_kimia_sensori', 'mikrobiologi_kimia_sensori'))->with('no');
    }


    public function superadmin_mikrobiologi_kimia_sensori_history(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('delete', 1)->get();
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::all();
        return view('mikrobiologi_kimia_sensori.superadmin.history', compact('mikrobiologi_kimia_sensori'))->with('no');
    }




    public function SA_mikrobiologi_kimia_sensori_pdf($id)
    {
        $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_kimia_sensori_pdf', array('mikrobiologi_kimia_sensori' => $mikrobiologi_kimia_sensori, 'sampel_mikrobiologi_kimia_sensori'=>$sampel_mikrobiologi_kimia_sensori))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);

        // return $pdf->stream();



        $filename = 'Laporan Pemeriksaan Kimia Dan Sensori ' . $mikrobiologi_kimia_sensori->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }

    // public function SA_mikrobiologi_kimia_sensori_pdf($id)
    // {
    //     $sampel_mikrobiologi_kimia_sensori = Sampel_mikrobiologi_kimia_sensori::where('id_kimia_sensori', $id)->get();
    //     $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::where('id', $id)->first();

    //     $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    //     $pdf = PDF::loadView('pdf.mikrobiologi_kimia_sensori_pdf', array('mikrobiologi_kimia_sensori' => $mikrobiologi_kimia_sensori, 'sampel_mikrobiologi_kimia_sensori'=>$sampel_mikrobiologi_kimia_sensori))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
    //     // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
    //     return $pdf->stream();
    // }
































    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mikrobiologi_kimia_sensori  $mikrobiologi_kimia_sensori
     * @return \Illuminate\Http\Response
     */
    public function show(Mikrobiologi_kimia_sensori $mikrobiologi_kimia_sensori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mikrobiologi_kimia_sensori  $mikrobiologi_kimia_sensori
     * @return \Illuminate\Http\Response
     */
    public function edit(Mikrobiologi_kimia_sensori $mikrobiologi_kimia_sensori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mikrobiologi_kimia_sensori  $mikrobiologi_kimia_sensori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mikrobiologi_kimia_sensori $mikrobiologi_kimia_sensori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mikrobiologi_kimia_sensori  $mikrobiologi_kimia_sensori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mikrobiologi_kimia_sensori $mikrobiologi_kimia_sensori)
    {
        //
    }
}
