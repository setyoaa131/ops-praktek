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
            'kategori_produk' => 'required|max_length[50]',
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
            $file->move(ROOTPATH . 'public/uploads', $newName);
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

        return redirect()->to('/dashboard')->with('success', 'Produk berhasil disimpan');
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

    public function create()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM products WHERE Field = 'kategori_produk'");
        $result = $query->getRow();

        // Ambil nilai enum dari kolom kategori_produk
        preg_match("/^enum\((.*)\)$/", $result->Type, $matches);
        $enumValues = array_map(function ($value) {
            return trim($value, "'");
        }, explode(",", $matches[1]));

        // Hapus nilai kosong ('')
        $enumValues = array_filter($enumValues, function ($value) {
            return $value !== '';
        });

        // Kirim data ke view
        return view('tambah_produk', ['kategori_produk' => $enumValues]);
    }

    // app/Controllers/ProdukController.php

    public function edit_produk($id_product)
    {
        $produkModel = new ProdukModel();

        // Cari produk berdasarkan ID
        $produk = $produkModel->find($id_product);

        if (!$produk) {
            // Jika produk tidak ditemukan, redirect dengan pesan error
            return redirect()->to('/dashboard')->with('error', 'Produk tidak ditemukan.');
        }

        // Ambil nilai enum kategori_produk
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM products WHERE Field = 'kategori_produk'");
        $result = $query->getRow();
        preg_match("/^enum\((.*)\)$/", $result->Type, $matches);
        $enumValues = array_map(function ($value) {
            return trim($value, "'");
        }, explode(",", $matches[1]));

        // Kirim data ke view untuk ditampilkan di form
        return view('edit_produk', [
            'produk' => $produk,
            'kategori_produk' => $enumValues
        ]);
    }


    public function update_produk($id_product)
    {
        $produkModel = new ProdukModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kategori_produk' => 'required|max_length[50]',
            'nama_produk'     => 'required|max_length[100]',
            'harga_barang'    => 'required|decimal',
            'harga_jual'      => 'required|decimal',
            'stok_produk'     => 'required|integer',
            'upload_image'    => 'is_image[upload_image]|max_size[upload_image,2048]' // opsional
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'kategori_produk' => $this->request->getPost('kategori_produk'),
            'nama_produk'     => $this->request->getPost('nama_produk'),
            'harga_barang'    => (float) str_replace('.', '', $this->request->getPost('harga_barang')),
            'harga_jual'      => (float) str_replace('.', '', $this->request->getPost('harga_jual')),
            'stok_produk'     => (int) $this->request->getPost('stok_produk'),
        ];

        // Proses upload gambar jika ada
        $file = $this->request->getFile('upload_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $data['image'] = $newName;

            // Hapus gambar lama jika ada
            $oldImage = $produkModel->find($id_product)['image'];
            if ($oldImage && file_exists(ROOTPATH . 'public/uploads/' . $oldImage)) {
                unlink(ROOTPATH . 'public/uploads/' . $oldImage);
            }
        }

        $produkModel->update($id_product, $data);

        return redirect()->to('/dashboard')->with('success', 'Produk berhasil diperbarui.');
        // Update data di database
        // if ($produkModel->update($id_product, $data)) {
        //     return redirect()->to('/dashboard')->with('success', 'Produk berhasil diperbarui.');
        // } else {
        //     return redirect()->back()->with('error', 'Gagal memperbarui produk.');
        // }
    }
}
