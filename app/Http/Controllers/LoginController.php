<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function lending()
    {
        return view('lending');
    }


    //Route Register
    public function register()
    {
        $roles = Role::all();
        return view('halaman.register', compact('roles'));
    }

    public function inputRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:25',
            'nohp' => 'required|min:8|max:13|unique:users,nohp',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:4|max:13',
            'jabatan' => 'required',
            'alamat' => 'required',
        ],[
            'nama.required' => 'Kolom nama harus di isi',
            'nohp.unique' => 'no handphone ini telah ada!',
            'nohp.required' => 'no handphone ini harus di isi!',
            'email.unique' => 'enail ini telah ada!',
            'email.required' => 'enail ini harus di isi!',
            'password.required' => 'Kolom password harus di isi',
            'jabatan.required' => 'Kolom jabatan harus di isi',
            'alamat.required' => 'Kolom alamat harus di isi',
        ]);
        // tambah data ke db bagian table users
        User::create([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'password' => Hash::make($request->password), //request password itu adalah password
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'status' => 0,
            'role_id' => $request->jabatan,
        ]);
        return redirect('/login')->with('success', 'Anda berhasil membuat akun!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }


    //Route Login
    public function login()
    {
        return view('halaman.login');
    }


    public function auth(Request $request)
    {
        $request->validate([
            'nohp' => 'required|exists:users,nohp',
            'password' => 'required',
        ],[
            'nohp.exists' => "This no.handphone doesn't exists",
        ]);



        $user = $request->only('nohp', 'password');
        if (Auth::attempt($user) &&  Auth::user()->role->name == 'operator') {
            return redirect('/operator')->with('successLogin', "Welcome!");
        } elseif (Auth::attempt($user) && Auth::user()->role->name == 'staff') {
            return redirect('/staff')->with('successLogin', "Welcome!");
        }elseif (Auth::attempt($user) && Auth::user()->role->name == 'supervisor') {
            return redirect('/supervisor')->with('successLogin', "Welcome!");
        }

        elseif (Auth::attempt($user) && Auth::user()->role->name == 'qa_product_release') {
            return redirect('/supervisor')->with('successLogin', "Welcome!");
        }

        elseif (Auth::attempt($user) && Auth::user()->role->name == 'superadmin') {
            // return redirect('/admin')->with('successLogin', "Welcome!");
            // $user = Auth::user();
            // Alert::success('Selamat datang, ' . $user->name . '!', 'Login berhasil');
            // Alert::success('Success Title', 'Success Message');
            // return redirect('/admin');

            $user = Auth::user()->nama;
            $message = 'Welcome, ' . $user . '!';
            // dd($message);
            return redirect('/admin')->with('successLogin', $message);
        }else {
            // db('salah');
            return redirect('/login')->with('loginFail', "Email-Address And Password Are Wrong.");
        }
    }




    public function logout()
    {
        // menghapus history login
        Auth::logout();
        // mengarahkan ke halaman login lagi
        return redirect('/')->with('successLogout', 'Berhasil logout dari account!');
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
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }
}
