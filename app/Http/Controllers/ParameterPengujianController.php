<?php

namespace App\Http\Controllers;

use App\Models\Parameter_pengujian;
use Illuminate\Http\Request;
use App\Models\Satuan_parameter_pengujian;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Futami_sampel_kimia;
use App\Models\Mikrobiologi_air;
use App\Models\Sampel_mikrobiologi_air;
use App\Models\Mikrobiologi_produk;
use App\Models\Sampel_mikrobiologi_produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ParameterPengujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add(Request $request)
    {
        $parameters = Parameter_pengujian::all();
        $satuan = Satuan_parameter_pengujian::all();
        return view('parameter_pengujian.add', compact('parameters', 'satuan'))->with('no');
    }

    public function inputParameter(Request $request)
    {
        $request->validate([
            // 'nama_parameter' => 'required',
        ],[
            // 'nama_parameter.required' => 'Kolom nama parameter harus di isi',
        ]);
        $parameter_pengujian = Parameter_pengujian::create([
        //    'nama_parameter' => $request->nama_parameter,
           'parameter' => $request->parameter,
        ]);

       return redirect('/operator/parameter_pengujian')->with('successAdd', 'Berhasil membuat Data Parameter Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }

    public function parameterDestroy(Request $request, $id)
    {
        Parameter_pengujian::where('id', '=', $id)->delete();
        // return redirect()->route('data')->with('successDelete', 'Berhasil menghapus data!');
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data parameter!');

    }

    public function editParameter(Request $request, $id)
    {
        $parameter = Parameter_pengujian::where('id', '=', $id)->first();
        return view('parameter_pengujian.edit', compact('parameter'))->with('no');
    }


    public function updateParameter(Request $request, $id)
    {
        $request->validate([
            // 'nama_parameter' => 'required',
        ],[
            // 'nama_parameter.required' => 'Kolom nama parameter harus di isi',
        ]);

        $parameter = Parameter_pengujian::where('id', $id)->update([
           'parameter' => $request->parameter,
        ]);

       return redirect('/operator/parameter_pengujian')->with('successUpdateParameter', 'Berhasil mengupdate Data Parameter!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }
















    public function inputSatuan(Request $request)
    {
        $satuan = Satuan_parameter_pengujian::create([
           'satuan' => $request->satuan,
        ]);

       return redirect('/operator/parameter_pengujian')->with('successAddSatuan', 'Berhasil membuat Data Satuan Parameter Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }

    public function satuanDestroy(Request $request, $id)
    {
        Satuan_parameter_pengujian::where('id', '=', $id)->delete();
        // return redirect()->route('data')->with('successDelete', 'Berhasil menghapus data!');
        return redirect()->back()->with('successDeleteSatuan', 'Berhasil menghapus data satuan!');

    }

    public function editSatuan(Request $request, $id)
    {
        $satuan = Satuan_parameter_pengujian::where('id', '=', $id)->first();
        return view('parameter_pengujian.editSatuan', compact('satuan'))->with('no');
    }

    public function updateSatuan(Request $request, $id)
    {
        $parameter = Satuan_parameter_pengujian::where('id', $id)->update([
            'satuan' => $request->satuan,
        ]);

       return redirect('/operator/parameter_pengujian')->with('successUpdateSatuan', 'Berhasil mengupdate data satuan !'); //mereturn / lewat / , bukan lewat name yang diberikan
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
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter_pengujian $parameter_pengujian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function edit(Parameter_pengujian $parameter_pengujian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter_pengujian $parameter_pengujian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parameter_pengujian  $parameter_pengujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter_pengujian $parameter_pengujian)
    {
        //
    }
}
