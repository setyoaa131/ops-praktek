<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar bg-red text-white p-3" id="sidebar">
            <div class="header-icons text-center mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="<?= base_url('assets/handbag.png') ?>" alt="Handbag" class="mb-2 me-4" style="width: 20px;">
                    <h4 class="mb-2">SIMS Web App</h4>
                </div>
            </div>
            <hr class="bg-light">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link text-white text-sm d-flex align-items-center py-2 active">
                        <img src="<?= base_url('assets/package.png') ?>" alt="Produk" class="me-2">
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('profil') ?>" class="nav-link text-white text-sm d-flex align-items-center py-2">
                        <img src="<?= base_url('assets/user.png') ?>" alt="Profil" class="me-2">
                        Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="nav-link text-white text-sm d-flex align-items-center py-2">
                        <img src="<?= base_url('assets/signout.png') ?>" alt="Logout" class="me-2">
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <div class="content w-full" id="content">
            <h2 class="text-lg font-bold mb-4 text-gray-400">
                Daftar Produk
                <span class="text-lg font-bold">&gt; Edit Produk</span>
            </h2>

            <form action="<?= base_url('update-produk/') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_product" value="<?= $produk['id_product'] ?>">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="kategori_produk">
                            Kategori
                        </label>
                        <select name="kategori_produk" id="kategori_produk" required class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($kategori_produk as $kategori): ?>
                                <option value="<?= $kategori ?>" <?= $produk['kategori_produk'] == $kategori ? 'selected' : '' ?>><?= $kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="nama_produk">
                            Nama Barang
                        </label>
                        <input type="text" name="nama_produk" id="nama_produk" required value="<?= $produk['nama_produk'] ?>"
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Masukan nama barang" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="harga_barang">
                            Harga Beli
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm flex items-center">
                            <span class="text-gray-500">Rp</span>
                            <input type="text" id="harga_barang" name="harga_barang" required value="<?= $produk['harga_barang'] ?>"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="0" oninput="formatRupiah(this); calculateHargaJual();" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="harga_jual">
                            Harga Jual
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm flex items-center">
                            <span class="text-gray-500">Rp</span>
                            <input type="text" id="harga_jual" name="harga_jual" required readonly value="<?= $produk['harga_jual'] ?>"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-100 py-2 pl-3 pr-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="0" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="stok_produk">
                            Stok Barang
                        </label>
                        <input type="number" name="stok_produk" id="stok_produk" min="1" required value="<?= $produk['stok_produk'] ?>"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="0" />
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700" for="upload_image">
                        Upload Gambar
                    </label>
                    <input type="file" name="upload_image" id="upload_image" accept="image/*" required
                        class="hidden" onchange="previewImage(event)">
                    <div class="border-dashed border-2 border-blue-500 rounded-md p-4 flex flex-col items-center justify-center cursor-pointer"
                        onclick="document.getElementById('upload_image').click()">
                        <img id="preview_image" src="<?= base_url('uploads/' . $produk['image']) ?>" alt="Upload Preview"
                            class="mb-2 max-h-40" />
                        <span id="preview_text">Upload Gambar Disini</span>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="window.location.href='<?= base_url('dashboard') ?>'"
                        class="bg-white border border-blue-500 text-blue-500 py-2 px-4 rounded-md mr-2">
                        Batalkan
                    </button>
                    <button type="submit" class="bg-blue-500 border border-blue-500 text-white py-2 px-4 rounded-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidebar a').click(function() {
                $('.sidebar a').removeClass('active');
                $(this).addClass('active');
            });
        });

        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Jika ada ribuan, tambahkan titik di antaranya
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            // Tambahkan bagian setelah koma jika ada
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            return rupiah;
        }

        // Format input saat pengguna mengetik
        function formatInputRupiah(input) {
            input.value = formatRupiah(input.value);
        }

        function calculateHargaJual() {
            const hargaBeliInput = document.getElementById('harga_barang');
            const hargaJualElement = document.getElementById('harga_jual');
            const hargaBeli = hargaBeliInput.value.replace(/\./g, ''); // Ambil angka murni tanpa titik

            if (hargaBeli && !isNaN(hargaBeli)) {
                const hargaJual = Math.round(parseFloat(hargaBeli) * 1.3); // Hitung harga jual (30% lebih tinggi)
                hargaJualElement.value = new Intl.NumberFormat('id-ID').format(hargaJual); // Tampilkan sebagai rupiah
            } else {
                hargaJualElement.value = '0'; // Kosongkan jika input tidak valid
            }
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview_image');
            const previewText = document.getElementById('preview_text');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewText.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>