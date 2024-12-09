<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id_product';
    protected $allowedFields = [
        'kategori_produk',
        'nama_produk',
        'harga_barang',
        'harga_jual',
        'stok_produk',
        'image'
    ];

    protected $useTimestamps = false;
}
