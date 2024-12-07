<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
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
            <h2 class="text-lg font-bold mb-4">Daftar Produk</h2>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" class="form-control w-1/2 me-2" placeholder="Cari barang">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Semua
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Alat Olahraga</a></li>
                        <li><a class="dropdown-item" href="#">Alat Musik</a></li>
                    </ul>
                </div>
                <button class="btn export text-white font-semibold">
                    <img src="<?= base_url('assets/MicrosoftExcelLogo.png') ?>" alt="Excel Logo">Export Excel
                </button>
                <a href="<?= site_url('tambah_produk') ?>" class="btn tambah-produk text-white font-semibold">
                    <img src="<?= base_url('assets/PlusCircle.png') ?>" alt="Plus Circle">Tambah Produk
                </a>
            </div>

            <div class="table-responsive">
                <table id="produkTable" class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Nama Produk</th>
                            <th>Kategori Produk</th>
                            <th>Harga Beli (Rp)</th>
                            <th>Harga Jual (Rp)</th>
                            <th>Stok Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($produk) && is_array($produk)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($produk as $item): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <img src="<?= base_url('uploads/' . $item['image']); ?>" alt="Image" class="img-thumbnail" style="max-height: 80px;">
                                    </td>
                                    <td><?= esc($item['nama_produk']); ?></td>
                                    <td><?= esc($item['kategori_produk']); ?></td>
                                    <td><?= number_format($item['harga_barang'], 2, ',', '.'); ?></td>
                                    <td><?= number_format($item['harga_jual'], 2, ',', '.'); ?></td>
                                    <td><?= esc($item['stok_produk']); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="<?= base_url('edit-produk/' . $item['id_product']); ?>" class="btn btn-default btn-sm me-1">
                                                <img src="<?= base_url('assets/edit.png'); ?>" alt="Edit" class="me-1" style="max-height: 20px;">
                                            </a>
                                            <a href="<?= base_url('produk/delete/' . $item['id_product']); ?>" class="btn btn-default btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                <img src="<?= base_url('assets/delete.png'); ?>" alt="Delete" class="me-1" style="max-height: 20px;">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data produk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#produkTable').DataTable({
                searching: false,
                paging: true,
                info: true
            });
        });

        $('.sidebar a').click(function() {
            $('.sidebar a').removeClass('active');
            $(this).addClass('active');
        });
    </script>
</body>

</html>