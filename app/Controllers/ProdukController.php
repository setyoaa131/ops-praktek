<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    public function tampilProduk()
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->findAll();
        return view('dashboard', ['produk' => $produk]);
    }

    public function simpanProduk()
    {
        $produkModel = new ProdukModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_barang'     => 'required|max_length[100]',
            'kategori_produk' => 'required|in_list[Alat Olahraga,Alat Musik]',
            'harga_beli'      => 'required|decimal',
            'harga_jual'      => 'required|decimal',
            'stok_produk'     => 'required|integer|min_length[1]',
            'upload_image'    => 'uploaded[upload_image]|mime_in[upload_image,image/jpg,image/jpeg]|max_size[upload_image,102400]', // Validasi file gambar
        ], [
            'upload_image' => [
                'uploaded' => 'File gambar harus diunggah!',
                'mime_in'  => 'Format file gambar harus berupa JPG atau JPEG!',
                'max_size' => 'Ukuran file gambar tidak boleh lebih dari 100 MB!',
            ]
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input.');
        }

        $hargaBeli = (float) str_replace('.', '', $this->request->getPost('harga_beli'));
        $hargaJual = $this->request->getPost('harga_jual')
            ? (float) str_replace('.', '', $this->request->getPost('harga_jual'))
            : ($hargaBeli * 1.3);

        $data = [
            'nama_produk'     => $this->request->getPost('nama_barang'),
            'kategori_produk' => $this->request->getPost('kategori_produk'),
            'stok_produk'     => (int) $this->request->getPost('stok_produk'),
            'harga_barang'    => $hargaBeli,
            'harga_jual'      => round($hargaJual, 2),
        ];

        $file = $this->request->getFile('upload_image');
        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
            $data['image'] = $fileName;
        }

        if ($produkModel->insert($data)) {
            return redirect()->to('dashboard')->with('success', 'Produk berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan produk!');
        }
    }

    public function editProduk($id)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if (!$produk) {
            return redirect()->to('dashboard')->with('error', 'Produk tidak ditemukan!');
        }

        return view('edit_produk', ['produk' => $produk]);
    }

    public function updateProduk($id)
    {
        $produkModel = new ProdukModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_barang'     => 'required|max_length[100]',
            'kategori_produk' => 'required|in_list[Alat Olahraga,Alat Musik]',
            'harga_beli'      => 'required|decimal',
            'harga_jual'      => 'required|decimal',
            'stok_produk'     => 'required|integer|min_length[1]',
            'upload_image'    => 'permit_empty|mime_in[upload_image,image/jpg,image/jpeg]|max_size[upload_image,102400]',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('error', 'Ada kesalahan pada input.');
        }

        $data = [
            'nama_produk'     => $this->request->getPost('nama_barang'),
            'kategori_produk' => $this->request->getPost('kategori_produk'),
            'stok_produk'     => (int) $this->request->getPost('stok_produk'),
            'harga_barang'    => (float) str_replace('.', '', $this->request->getPost('harga_beli')),
            'harga_jual'      => (float) str_replace('.', '', $this->request->getPost('harga_jual')),
        ];

        $file = $this->request->getFile('upload_image');
        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
            $data['image'] = $fileName;
        }

        if ($produkModel->update($id, $data)) {
            return redirect()->to('dashboard')->with('success', 'Produk berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui produk!');
        }
    }
}
