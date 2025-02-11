<?php

namespace App\Http\Controllers;

use App\Models\Pengujian_database;
use App\Models\Laporan_analisa_air;
use App\Models\Sampel_laporan_analisa_air;
use App\Models\Pengujian_laporan_analisa_air;
use Illuminate\Http\Request;
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
use App\Exports\LaporanAnalisaAirExport;


class LaporanAnalisaAirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporan_analisa_air(Request $request)
    {
        // $laporan_analisa_air = Laporan_analisa_air::where('delete', 0)->get();

        $laporan_analisa_air = Laporan_analisa_air::where('delete', 0);

        if ($request->has('tgl_awal') && $request->has('tgl_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_akhir)->toDateTimeString();
            $laporan_analisa_air->whereBetween('tgl_sampling', [$tgl_mulai, $tgl_selesai]);
        }

        // $laporan_analisa_air = $laporan_analisa_air->orderBy('updated_at', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        $laporan_analisa_air = $laporan_analisa_air->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('laporan_analisa_air.operator.laporan_analisa_air', compact('laporan_analisa_air'))->with('no', ($laporan_analisa_air->currentPage() - 1) * $laporan_analisa_air->perPage() + 1);

        // return view('laporan_analisa_air.operator.laporan_analisa_air', compact('laporan_analisa_air'))->with('no');
    }

    public function add_laporan_analisa_air(Request $request)
    {
        $parameter = Parameter_pengujian::all();
        $input_satuan = Satuan_parameter_pengujian::all();
        return view('laporan_analisa_air.operator.add_laporan_analisa_air', compact('parameter', 'input_satuan'));
    }

    public function input_laporan_analisa_air(Request $request)
    {
        $request->validate([
            'tgl_sampling' => 'required',
            'nodokumen' => 'required',
        ],[
            'tgl_sampling.required' => 'Kolom tanggal produksi harus di isi',
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

        $laporan_analisa_air = Laporan_analisa_air::create([
            'nodokumen' => $request->nodokumen,
            'tgl_sampling' => $request->tgl_sampling,

            'statusOP' => 0,
            'statusST' => 0,
            'statusSP' => 0,
            'delete' => 0,
        ]);


        $request->validate([
            'inputSampel' => 'required|array|min:1',

            'inputSampel.*.sampel' => 'required',
        ],[
            'inputSampel.required' => 'Kolom Kode Sampling harus di isi',
            'inputSampel.array' => 'Kolom Kode Sampling harus berupa array',
            'inputSampel.min' => 'Minimal satu Kode Sampling harus diisi',

            'inputSampel.*.sampel.required' => 'Kolom Sampel harus di isi',
        ]);

        $laporan_analisa_air = Laporan_analisa_air::where('nodokumen', $request->nodokumen)->first();

        foreach($request->inputSampel as $key => $value){
            DB::table('sampel_laporan_analisa_airs')->insert([
                'sampel' => $value['sampel'],
                'id_dokumen' => $laporan_analisa_air->id,
            ]);
        }

        // dd($request->inputSampel);
        return redirect('/operator/sampel_laporan_analisa_air/' .$laporan_analisa_air->id)->with('successAdd', 'Berhasil membuat Dokumen Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }


    public function sampel_laporan_analisa_air(Request $request, $id)
    {
        // $dataSatuan = Satuan_parameter_pengujian::all();
        $parameter = Parameter_pengujian::all();
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $laporan_analisa_air->id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();

        // dd($sampel_null);
        return view('laporan_analisa_air.operator.sampel_laporan_analisa_air', compact('id', 'laporan_analisa_air', 'parameter', 'data_laporan_analisa_air', 'sampel_null'));
    }

    public function option_sampel_laporan_analisa_air(Request $request, $id, $sampel_id)
    {
        $parameter = Parameter_pengujian::all();
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where([['id_dokumen', $laporan_analisa_air->id],['id', $sampel_id]])->first();
        $sampel_null = Sampel_laporan_analisa_air::where('id', $sampel_id)->first();
        $pengujian = Pengujian_database::where('pengujian_id', $sampel_id)->get();
        // dd($pengujian);


        return view('laporan_analisa_air.operator.option_sampel_laporan_analisa_air', compact('id','sampel_id', 'laporan_analisa_air', 'parameter', 'data_laporan_analisa_air', 'sampel_null', 'pengujian'));
    }


    public function input_sampel_laporan_analisa_air(Request $request, $id, $sampel_id)
    {
        // dd($request->inputSampel);
        $request->validate([
            'inputSampel' => 'required|array|min:1',
            'inputSampel.*.pengujian' => 'required',
            'inputSampel.*.keterangan' => 'required',
        ], [
            'inputSampel.required' => 'Kolom Kode Sampling harus di isi',
            'inputSampel.array' => 'Kolom Kode Sampling harus berupa array',
            'inputSampel.min' => 'Minimal satu Kode Sampling harus diisi',
            'inputSampel.*.pengujian.required' => 'Kolom Pengujian harus di isi',
            'inputSampel.*.keterangan.required' => 'Kolom Keterangan harus di isi',
        ]);


        foreach($request->inputSampel as $key => $value){
            DB::table('pengujian_laporan_analisa_airs')->insert([
                'pengujian' => $value['pengujian'],
                'shift_1' => $value['shift_1'],
                'shift_2' => $value['shift_2'],
                'keterangan' => $value['keterangan'],
                'created_at'=> now(),
                'updated_at'=> now(),
                'id_analisa_air' => $id,
                'sampel_id' => $sampel_id,
            ]);
        }

        // return redirect()->route('sampel_laporan_analisa_air', $id)->with('successAddSampel', 'Berhasil membuat Data Sampel!');

        $prevPage = url()->previous(); // URL sebelumnya

        if (strpos($prevPage, '/operator/sampel_laporan_analisa_air/') !== false) {
            return redirect()->route('sampel_laporan_analisa_air', $id)->with('successAddSampel', 'Berhasil membuat Data Sampel!');
        } elseif (strpos($prevPage, '/operator/laporan_analisa_air/edit/') !== false) {
            return redirect('/operator/laporan_analisa_air/edit/' . $id)->with('successAdd', 'Berhasil mengupdate Data Sampel!');
        }
    }

    public function laporan_analisa_air_operatorttd(Request $request, $id)
    {
        $request->validate([
            'ttd_operator' => 'required',
        ],[
           'ttd_operator' => 'Kolom TTD harus di isi!',
        ]);

        Laporan_analisa_air::where('id', $id)->update([
            'statusOP' => 1,
            'user_id_OP' => auth::user()->id,
            'name_id_OP' => auth::user()->nama,
            // 'created_at_OP' => Carbon::now()->format('d F Y'),
            'created_at_OP' => $request->ttd_operator,
        ]);

        return redirect()->route('laporan_analisa_air')->with('operatorttd', 'Data telah ditandatangani oleh Operator!');
    }

    public function laporan_analisa_air_Destroy($id)
    {
        Laporan_analisa_air::where('id',$id)->update([
            'delete' => 1,
        ]);

        return redirect()->route('laporan_analisa_air')->with('successDelete', 'Berhasil menghapus dokumen!');
    }

    public function laporan_analisa_air_restore($id)
    {
        Laporan_analisa_air::where('id',$id)->update([
            'delete' => 0,
        ]);

        return redirect()->route('laporan_analisa_air')->with('successRestore', 'Berhasil merestore dokumen!');
    }

    public function laporan_analisa_air_delete_permanent($id)
    {
        Laporan_analisa_air::where('id', $id)->delete();

        return redirect()->route('laporan_analisa_air')->with('successDelete', 'Berhasil menghapus permanen!');
    }


    public function laporan_analisa_air_history(Request $request)
    {
        // $laporan_analisa_air = Laporan_analisa_air::where('delete', 1)->get();

        $laporan_analisa_air = laporan_analisa_air::where('delete', 1);

        if ($request->has('tgl_awal') && $request->has('tgl_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_akhir)->toDateTimeString();
            $laporan_analisa_air->whereBetween('tgl_sampling', [$tgl_mulai, $tgl_selesai]);
        }

        $laporan_analisa_air = $laporan_analisa_air->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('laporan_analisa_air.operator.history', compact('laporan_analisa_air'))->with('no', ($laporan_analisa_air->currentPage() - 1) * $laporan_analisa_air->perPage() + 1);

        // return view('laporan_analisa_air.operator.history', compact('laporan_analisa_air'))->with('no');
    }

    public function laporan_analisa_air_sampel(Request $request, $id)
    {
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        // $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();

        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $laporan_analisa_air->id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();

        return view('laporan_analisa_air.operator.dataSampel_laporan_analisa_air', compact('laporan_analisa_air', 'data_laporan_analisa_air', 'sampel_null'))->with('no');
    }

    public function show_laporan_analisa_air_sampel(Request $request, $id, $sampel_id)
    {
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where([['id_dokumen', $laporan_analisa_air->id],['id', $sampel_id]])->first();
        $sampel_null = Sampel_laporan_analisa_air::where('id', $sampel_id)->first(); //ngambil sampel nya yg null
        $pengujian = Pengujian_database::where('pengujian_id', $sampel_id)->get();
        $sampel_laporan_analisa_air = Pengujian_laporan_analisa_air::where('sampel_id', $sampel_id)->get();
        // dd($sampel_laporan_analisa_air);

        return view('laporan_analisa_air.operator.showSampel_laporan_analisa_air', compact('id','sampel_id', 'laporan_analisa_air', 'data_laporan_analisa_air', 'sampel_null', 'pengujian', 'sampel_laporan_analisa_air'));
    }

    public function show_sampel_laporan_analisa_air_Delete(Request $request, $id, $sampel_id, $pengujian_id)
    {
        Pengujian_laporan_analisa_air::where('id', $pengujian_id)->delete();
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data laporan analisa air!');
    }


    public function edit_laporan_analisa_air($id)
    {
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $laporan_analisa_air->id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();

        return view('laporan_analisa_air.operator.edit_laporan_analisa_air', compact('laporan_analisa_air', 'data_laporan_analisa_air', 'sampel_null'))->with('no');
    }

    public function edit_sampel_laporan_analisa_air(Request $request, $id, $sampel_id)
    {
        $parameter = Parameter_pengujian::all();
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where([['id_dokumen', $laporan_analisa_air->id],['id', $sampel_id]])->first();
        $sampel_null = Sampel_laporan_analisa_air::where('id', $sampel_id)->first();
        $pengujian = Pengujian_database::where('pengujian_id', $sampel_id)->get();
        $sampel_laporan_analisa_air = Pengujian_laporan_analisa_air::where([['sampel_id', $sampel_id], ['id_analisa_air', $id]])->get();
        // dd($sampel_laporan_analisa_air);

        return view('laporan_analisa_air.operator.edit_sampel_laporan_analisa_air', compact('id','sampel_id', 'parameter','laporan_analisa_air', 'data_laporan_analisa_air', 'sampel_null', 'pengujian', 'sampel_laporan_analisa_air'));
    }


    public function update_laporan_analisa_air(Request $request, $id, $sampel_id)
    {
        $request->validate([
            'inputSampel' => 'required|array|min:1',
            'inputSampel.*.pengujian' => 'required',
            'inputSampel.*.keterangan' => 'required',
        ],[
            'inputSampel.required' => 'Kolom Kode Sampling harus di isi',
            'inputSampel.array' => 'Kolom Kode Sampling harus berupa array',
            'inputSampel.min' => 'Minimal satu Kode Sampling harus diisi',
            'inputSampel.*.pengujian.required' => 'Kolom Pengujian harus di isi',
            'inputSampel.*.keterangan.required' => 'Kolom Keterangan harus di isi',
        ]);


        $sampel_data = [];
        foreach ($request->inputSampel as $input) {
            // if ($id == null) {
            //     $sampel = new Pengujian_laporan_analisa_air();
            //     $sampel->pengujian = $input['pengujian'];
            //     $sampel->shift_1 = $input['shift_1'];
            //     $sampel->shift_2 = $input['shift_2'];
            //     $sampel->keterangan = $input['keterangan'];
            //     $sampel->created_at = now();
            //     $sampel->updated_at = now();
            //     // $sampel->id_analisa_air = $id;

            //     $sampel_data[] = $sampel;
            // }else{
            //     $sampel = new Pengujian_laporan_analisa_air();
            //     $sampel->pengujian = $input['pengujian'];
            //     $sampel->shift_1 = $input['shift_1'];
            //     $sampel->shift_2 = $input['shift_2'];
            //     $sampel->keterangan = $input['keterangan'];
            //     $sampel->created_at = now();
            //     $sampel->updated_at = now();
            //     $sampel->id_analisa_air = $id;

            //     $sampel_data[] = $sampel;
            // }
            $sampel = new Pengujian_laporan_analisa_air();
            $sampel->pengujian = $input['pengujian'];
            $sampel->shift_1 = $input['shift_1'];
            $sampel->shift_2 = $input['shift_2'];
            $sampel->keterangan = $input['keterangan'];
            $sampel->created_at = now();
            $sampel->updated_at = now();
            $sampel->id_analisa_air = $id;

            $sampel_data[] = $sampel;
        }

        Sampel_laporan_analisa_air::find($sampel_id)->Pengujian_laporan_analisa_air()->delete();
        Sampel_laporan_analisa_air::find($sampel_id)->Pengujian_laporan_analisa_air()->saveMany($sampel_data);



        return redirect('/operator/laporan_analisa_air/edit/' . $id)->with('successAdd', 'Berhasil mengupdate Dokumen!');
    }


    public function OP_laporan_analisa_air_pdf($id)
    {
        $no = 8;
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();
        $pengujian_laporan_analisa_air = Pengujian_laporan_analisa_air::where('id_analisa_air', $id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();
        // dd($sampel_null);

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.laporan_analisa_air_pdf', array('laporan_analisa_air' => $laporan_analisa_air, 'sampel_laporan_analisa_air' => $sampel_laporan_analisa_air, 'pengujian_laporan_analisa_air'=>$pengujian_laporan_analisa_air, 'sampel_null'=>$sampel_null, 'no'=>$no))->setOptions(['defaultFont' => 'sans-serif']);

        // return $pdf->stream();



        $filename = 'Laporan Analisa Air ' . $laporan_analisa_air->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }



    // excel
    public function laporan_analisa_air_excel($id)
    {
        $no = 8;
        $laporan_analisa_air = laporan_analisa_air::where('id', $id)->first();
        $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();
        $pengujian_laporan_analisa_air = Pengujian_laporan_analisa_air::where('id_analisa_air', $id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();

        return view('Excel.laporan_analisa_air.show_laporan_analisa_air', compact('no', 'laporan_analisa_air', 'sampel_laporan_analisa_air', 'pengujian_laporan_analisa_air', 'sampel_null'));
    }
    public function laporan_analisa_air_excel_show($id)
    {
        $no = 8;
        $laporan_analisa_air = laporan_analisa_air::where('id', $id)->first();
        $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();
        $pengujian_laporan_analisa_air = Pengujian_laporan_analisa_air::where('id_analisa_air', $id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();

        return view('Excel.laporan_analisa_air.show_laporan_analisa_air', compact('no', 'laporan_analisa_air', 'sampel_laporan_analisa_air', 'pengujian_laporan_analisa_air', 'sampel_null'));
    }
    public function laporan_analisa_air_exportExcel($id)
    {
        // set_time_limit(300);

        $laporan_analisa_air = laporan_analisa_air::where('id', $id)->first();
        $nodokumen = explode('/', $laporan_analisa_air->nodokumen);
        $dokumen = implode('_', $nodokumen);

        return Excel::download(new LaporanAnalisaAirExport($id), ''.$dokumen.'.xlsx');
    }

















    ///////Function Staff
    public function staff_laporan_analisa_air(Request $request)
    {
        $laporan_analisa_air = Laporan_analisa_air::where('delete', 0);

        if ($request->has('tgl_awal') && $request->has('tgl_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_akhir)->toDateTimeString();
            $laporan_analisa_air->whereBetween('tgl_sampling', [$tgl_mulai, $tgl_selesai]);
        }

        $laporan_analisa_air = $laporan_analisa_air->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('laporan_analisa_air.staff.laporan_analisa_air', compact('laporan_analisa_air'))->with('no', ($laporan_analisa_air->currentPage() - 1) * $laporan_analisa_air->perPage() + 1);

        // return view('laporan_analisa_air.staff.laporan_analisa_air', compact('laporan_analisa_air'))->with('no');
    }

    public function laporan_analisa_air_staffttd(Request $request, $id)
    {
        $request->validate([
            'ttd_staff' => 'required',
        ],[
           'ttd_staff' => 'Kolom TTD harus di isi!',
        ]);

        Laporan_analisa_air::where('id', $id)->update([
            'statusST' => 1,
            'user_id_ST' => auth::user()->id,
            'name_id_ST' => auth::user()->nama,
            'created_at_ST' => $request->ttd_staff,
            // 'created_at_ST' => Carbon::now()->format(' d F Y'),
        ]);
        return redirect()->route('staff_laporan_analisa_air')->with('staffttd', 'Data Laporan Analisa Air telah ditandatangani oleh Staff!');
    }

    public function laporan_analisa_air_declinettd($id)
    {
        laporan_analisa_air::where('id', $id)->update([
            'statusST' => 2,
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        return redirect()->route('staff_laporan_analisa_air')->with('declinettd', 'Data Laporan Analisa Air telah ditolak oleh Staff!');
    }


    public function ST_laporan_analisa_air_pdf($id)
    {
        $no = 8;
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();
        $pengujian_laporan_analisa_air = Pengujian_laporan_analisa_air::where('id_analisa_air', $id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();
        // dd($sampel_null);

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.laporan_analisa_air_pdf', array('laporan_analisa_air' => $laporan_analisa_air, 'sampel_laporan_analisa_air' => $sampel_laporan_analisa_air, 'pengujian_laporan_analisa_air'=>$pengujian_laporan_analisa_air, 'sampel_null'=>$sampel_null, 'no'=>$no))->setOptions(['defaultFont' => 'sans-serif']);

        // return $pdf->stream();



        $filename = 'Laporan Analisa Air ' . $laporan_analisa_air->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }












     ////Function Supervisor
    public function supervisor_laporan_analisa_air(Request $request)
    {
        $laporan_analisa_air = Laporan_analisa_air::where('delete', 0);

        if ($request->has('tgl_awal') && $request->has('tgl_akhir')) {
            $tgl_mulai = Carbon::parse($request->tgl_awal)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_akhir)->toDateTimeString();
            $laporan_analisa_air->whereBetween('tgl_sampling', [$tgl_mulai, $tgl_selesai]);
        }

        $laporan_analisa_air = $laporan_analisa_air->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('laporan_analisa_air.supervisor.laporan_analisa_air', compact('laporan_analisa_air'))->with('no', ($laporan_analisa_air->currentPage() - 1) * $laporan_analisa_air->perPage() + 1);

        // return view('mikrobiologi_kimia_sensori.supervisor.mikrobiologi_kimia_sensori', compact('mikrobiologi_kimia_sensori'))->with('no');
    }
    public function laporan_analisa_air_supervisorttd(Request $request, $id)
    {
        $request->validate([
            'ttd_supervisor' => 'required',
        ],[
           'ttd_supervisor' => 'Kolom TTD harus di isi!',
        ]);

        Laporan_analisa_air::where('id', $id)->update([
            'statusSP' => 1,
            'user_id_SP' => auth::user()->id,
            'name_id_SP' => auth::user()->nama,
            'created_at_SP' => $request->ttd_supervisor,
            // 'created_at_SP' => Carbon::now()->format('d F Y'),
        ]);
        return redirect()->route('supervisor_laporan_analisa_air')->with('supervisorttd', 'Data Laporan Analisa Air telah ditandatangani oleh Supervisor!');
    }

    public function SP_laporan_analisa_air_pdf($id)
    {
        $no = 8;
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();
        $pengujian_laporan_analisa_air = Pengujian_laporan_analisa_air::where('id_analisa_air', $id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();
        // dd($sampel_null);

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.laporan_analisa_air_pdf', array('laporan_analisa_air' => $laporan_analisa_air, 'sampel_laporan_analisa_air' => $sampel_laporan_analisa_air, 'pengujian_laporan_analisa_air'=>$pengujian_laporan_analisa_air, 'sampel_null'=>$sampel_null, 'no'=>$no))->setOptions(['defaultFont' => 'sans-serif']);

        // return $pdf->stream();


        $filename = 'Laporan Analisa Air ' . $laporan_analisa_air->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }













    ////Function Superadmin

    public function superadmin_laporan_analisa_air(Request $request)
    {
        $laporan_analisa_air = Laporan_analisa_air::where('delete', 0)->get();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);

        return view('laporan_analisa_air.superadmin.laporan_analisa_air_info', compact('laporan_analisa_air'))->with('no');
    }

    public function superadmin_laporan_analisa_air_history(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $laporan_analisa_air = Laporan_analisa_air::where('delete', 1)->get();
        return view('laporan_analisa_air.superadmin.history', compact('laporan_analisa_air'))->with('no');
    }

    public function superadmin_laporan_analisa_air_sampel(Request $request, $id)
    {
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        // $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();

        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $laporan_analisa_air->id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();

        return view('laporan_analisa_air.superadmin.dataSampel_laporan_analisa_air', compact('laporan_analisa_air', 'data_laporan_analisa_air', 'sampel_null'))->with('no');
    }

    public function superadmin_laporan_analisa_air_sampelShow(Request $request, $id, $sampel_id)
    {
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $data_laporan_analisa_air = Sampel_laporan_analisa_air::where([['id_dokumen', $laporan_analisa_air->id],['id', $sampel_id]])->first();
        $sampel_null = Sampel_laporan_analisa_air::where('id', $sampel_id)->first();
        $pengujian = Pengujian_database::where('pengujian_id', $sampel_id)->get();
        $sampel_laporan_analisa_air = Pengujian_laporan_analisa_air::where('sampel_id', $sampel_id)->get();
        // dd($sampel_laporan_analisa_air);

        return view('laporan_analisa_air.superadmin.showSampel_laporan_analisa_air', compact('id','sampel_id', 'laporan_analisa_air', 'data_laporan_analisa_air', 'sampel_null', 'pengujian', 'sampel_laporan_analisa_air'));
    }

    public function SA_laporan_analisa_air_pdf($id)
    {
        $no = 8;
        $laporan_analisa_air = Laporan_analisa_air::Where('id', $id)->first();
        $sampel_laporan_analisa_air = Sampel_laporan_analisa_air::where('id_dokumen', $id)->get();
        $pengujian_laporan_analisa_air = Pengujian_laporan_analisa_air::where('id_analisa_air', $id)->get();
        $sampel_null = Sampel_laporan_analisa_air::where('id_dokumen', null)->get();
        // dd($sampel_null);

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.laporan_analisa_air_pdf', array('laporan_analisa_air' => $laporan_analisa_air, 'sampel_laporan_analisa_air' => $sampel_laporan_analisa_air, 'pengujian_laporan_analisa_air'=>$pengujian_laporan_analisa_air, 'sampel_null'=>$sampel_null, 'no'=>$no))->setOptions(['defaultFont' => 'sans-serif']);

        // return $pdf->stream();


        $filename = 'Laporan Analisa Air ' . $laporan_analisa_air->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }


































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
     * @param  \App\Models\Laporan_analisa_air  $laporan_analisa_air
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan_analisa_air $laporan_analisa_air)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan_analisa_air  $laporan_analisa_air
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan_analisa_air $laporan_analisa_air)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan_analisa_air  $laporan_analisa_air
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan_analisa_air $laporan_analisa_air)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan_analisa_air  $laporan_analisa_air
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan_analisa_air $laporan_analisa_air)
    {
        //
    }
}
