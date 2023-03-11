<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $judul = 'Log In';
    protected $direktori = 'admin.auth';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        $data['judul'] = $this->judul;

        return view($this->direktori . ".login", $data);
    }


    public function postLogin(Request $request)
    {

        // return $request->all();

        $username = strip_tags($request->username);
        $password = strip_tags($request->password);


        if (empty($username)) {

            return redirect()->route('login')
                ->with('status', 'error')
                ->with('message', 'Kolom Username Harus Diisi!');
        }

        if (empty($password)) {

            return redirect()->route('login')
                ->with('status', 'error')
                ->with('message', 'Kolom Password Harus Diisi!');
        }


        $users = Users::where('username', $username)->first();

        if (!empty($users)) {

            $data = [
                'username' => $users->username,
                'password' => $password
            ];

            echo Auth::attempt($data);


            if (Auth::attempt($data)) {

                return redirect()->route('dashboard')
                    ->with('status', 'success')
                    ->with('message', 'Selamat Datang ' . $users->username . '!');
            } else {

                return redirect()->route('login')
                    ->with('status', 'error')
                    ->with('message', 'Tidak Berhasil Untuk Login!');
            }
        } else {

            return redirect()->route('login')
                ->with('status', 'error')
                ->with('message', 'Akun tidak tedaftar pada sistem!');
        }
    }


    public function logout()
    {

        Auth::logout();

        session_start();
        session_destroy();


        return redirect()->route('login')
            ->with('status', 'success')
            ->with('message', 'Berhasil Logout');
    }
}
