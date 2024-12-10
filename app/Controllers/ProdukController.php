<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use CodeIgniter\Controller;

class ProdukController extends BaseController
{
    public function tampilProduk()
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->findAll();
        return view('dashboard', ['produk' => $produk]);
    }

    public function simpan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kategori_produk' => 'required',
            'nama_produk'     => 'required|max_length[100]',
            'harga_barang'    => 'required|decimal',
            'harga_jual'      => 'required|decimal',
            'stok_produk'     => 'required|integer',
            'upload_image'    => 'uploaded[upload_image]|is_image[upload_image]|max_size[upload_image,2048]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('upload_image');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar');
        }

        $model = new ProdukModel();
        $data = [
            'kategori_produk' => $this->request->getPost('kategori_produk'),
            'nama_produk'     => $this->request->getPost('nama_produk'),
            'harga_barang'    => (float) str_replace('.', '', $this->request->getPost('harga_barang')),
            'harga_jual'      => (float) str_replace('.', '', $this->request->getPost('harga_jual')),
            'stok_produk'     => (int) $this->request->getPost('stok_produk'),
            'image'           => $newName,
        ];

        $model->insert($data);

        return redirect()->to('dashboard')->with('success', 'Produk berhasil disimpan');
    }

    public function delete($id_product)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id_product);

        if ($produk) {
            $produkModel->delete($id_product);
            return redirect()->to('dashboard')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->to('dashboard')->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function edit_produk($id_product)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id_product);

        if (!$produk) {
            return redirect()->to('/dashboard')->with('error', 'Produk tidak ditemukan.');
        }

        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM products WHERE Field = 'kategori_produk'");
        $result = $query->getRow();
        preg_match("/^enum\((.*)\)$/", $result->Type, $matches);
        $enumValues = array_map(function ($value) {
            return trim($value, "'");
        }, explode(",", $matches[1]));

        return view('edit_produk', [
            'produk' => $produk,
            'kategori_produk' => $enumValues
        ]);
    }

    public function search()
    {
        $kategori = $this->request->getGet('kategori_produk');
        $namaProduk = $this->request->getGet('nama_produk');
        $produkModel = new ProdukModel();

        $query = $produkModel;

        if ($kategori && $kategori !== 'Semua') {
            $query = $query->where('kategori_produk', $kategori);
        }

        if ($namaProduk) {
            $query = $query->like('nama_produk', $namaProduk);
        }

        $produk = $query->findAll();

        return view('dashboard', [
            'produk' => $produk,
            'kategori_produk' => $kategori,
            'nama_produk' => $namaProduk
        ]);
    }
}
