<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $allowedFields = [
        'nama_produk',
        'kategori_produk',
        'harga_barang',
        'harga_jual',
        'stok_produk',
        'image',
    ];

    protected $useTimestamps = true;

    protected $validationRules = [
        'nama_produk'     => 'required|max_length[100]',
        'kategori_produk' => 'required|in_list[Alat Olahraga,Alat Musik]',
        'harga_barang'    => 'required|decimal',
        'harga_jual'      => 'required|decimal',
        'stok_produk'     => 'required|integer|min_length[1]',
        'image'           => 'permit_empty|max_length[255]|ext_in[jpg,jpeg,png]',
    ];

    protected $validationMessages = [
        'harga_barang' => [
            'decimal' => 'Harga barang harus berupa angka valid!',
        ],
        'harga_jual' => [
            'decimal' => 'Harga jual harus berupa angka valid!',
        ],
        'stok_produk' => [
            'min_length' => 'Stok produk tidak boleh kosong!',
        ],
        'image' => [
            'ext_in' => 'Hanya file dengan ekstensi jpg, jpeg, atau png yang diperbolehkan!',
        ]
    ];
}
