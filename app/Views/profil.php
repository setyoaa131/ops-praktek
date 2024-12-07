<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
                    <a href="<?= base_url('dashboard') ?>" class="nav-link text-white text-sm d-flex align-items-center py-2">
                        <img src="<?= base_url('assets/package.png') ?>" alt="Produk" class="me-2">
                        Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('profil') ?>" class="nav-link text-white text-sm d-flex align-items-center py-2 active">
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
            <div class="container mt-4">
                <h2 class="text-lg font-bold mb-4">Profil</h2>
                <div class="d-flex align-items-center mb-4">
                    <img src="<?= base_url('assets/IMG.JPG') ?>" alt="Foto Profil" class="rounded-circle profile-img">
                </div>
                <form>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="namaKandidat" class="form-label">Nama Kandidat</label>
                            <input type="text" class="form-control" id="namaKandidat" value="Setyo Arie Anggara" readonly>
                        </div>
                        <div class="col">
                            <label for="posisiKandidat" class="form-label">Posisi Kandidat</label>
                            <input type="text" class="form-control" id="posisiKandidat" value="Web Programmer" readonly>
                        </div>
                    </div>
                </form>
            </div>
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
    </script>
</body>

</html>