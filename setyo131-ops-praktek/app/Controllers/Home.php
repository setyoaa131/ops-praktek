<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Verifikasi password tanpa hashing
            if ($password === $user['password']) {
                $session->set([
                    'user_id' => $user['id_user'],
                    'email' => $user['email'],
                    'is_logged_in' => true,
                ]);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }
    }

    private function checkLogin()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu!');
        }
    }

    public function menuUtama()
    {
        $this->checkLogin();

        $produkModel = new ProdukModel();
        $produk = $produkModel->findAll();
        return view('dashboard', ['produk' => $produk]);
    }

    public function tambahProduk()
    {
        $this->checkLogin();
        return view('tambah_produk');
    }

    public function profil()
    {
        $this->checkLogin();
        return view('profil');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
