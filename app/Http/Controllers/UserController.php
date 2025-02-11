<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Futami;
use App\Models\Futami_sampel_kimia;
use App\Models\Mikrobiologi_air;
use App\Models\Sampel_mikrobiologi_air;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $users = User::Where('id', Auth::user()->id)->first();
        return view('profile.profile', compact('users'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:3|max:25',
            'alamat' => 'required',
        ]);
        // tambah data ke db bagian table users
        User::where('id', Auth::user()->id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'status' => 0,
        ]);

        // toast('Signed in successfully','success')->timerProgressBar()->width('350px');
        toast('Signed in successfully','success')->timerProgressBar()->width('auto');
        return redirect('/profile'); //mereturn / lewat / , bukan lewat name yang diberikan
    }

    public function password_verify(Request $request)
    {
        $users = User::Where('id', Auth::user()->id)->first();
        return view('profile.password-verify', compact('users'));
    }

    public function verify(Request $request)
    {
        $user = Auth::user();
        $inputPassword = $request->input('password_verify');

        if (Hash::check($inputPassword, $user->password)) {
            return redirect()->route('password')->with('successVerify', 'Berhasil melakukan verifikasi!');

        } else {
            toast('Password yang anda masukkan salah!','warning')->timerProgressBar();
            return redirect()->back();
        }

    }

    public function password(Request $request)
    {
        $users = User::Where('id', Auth::user()->id)->first();
        return view('profile.ganti_password', compact('users'));
    }


    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:3|max:25',
        ]);

        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->password), //request password itu adalah password
        ]);

        return redirect()->route('profile')->with('successUpdate', 'Password berhasil diperbarui.');
    }


















//Route Super Admin Profile Controller
    public function superadmin_profile(Request $request)
    {
        $users = User::Where('id', Auth::user()->id)->first();
        return view('admin.profile.profile', compact('users'));
    }

    public function superadmin_updateProfile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:3|max:25',
            'alamat' => 'required',
        ]);
        // tambah data ke db bagian table users
        User::where('id', Auth::user()->id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'status' => 0,
        ]);

        // toast('Signed in successfully','success')->timerProgressBar()->width('350px');
        toast('Signed in successfully','success')->timerProgressBar()->width('auto');
        return redirect('/superadmin/profile'); //mereturn / lewat / , bukan lewat name yang diberikan
    }


    public function superadmin_password(Request $request)
    {
        $users = User::Where('id', Auth::user()->id)->first();
        return view('admin.profile.password', compact('users'));
    }



    public function superadmin_updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:3|max:25',
        ],[
            'password.required'=>'kolom ini harus di isi'
        ]);

        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->password), //request password itu adalah password
        ]);

        return redirect()->route('superadmin_profile')->with('successUpdate', 'Password berhasil diperbarui.');
    }





}
