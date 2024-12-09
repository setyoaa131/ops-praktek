<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMS Web App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen w-screen flex overflow-hidden">
    <div class="flex-1 bg-white flex flex-col justify-center items-center p-8">
        <div class="flex items-center mb-6">
            <img src="<?= base_url('assets/Handbag.png') ?>" alt="Icon" class="h-8 w-8 mr-2">
            <h1 class="text-3xl font-bold">SIMS Web App</h1>
        </div>
        <p class="text-gray-600 mb-8 text-center">Masuk atau buat akun untuk memulai</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger w-full max-w-sm">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/process') ?>" method="post" class="w-full max-w-sm space-y-4">
            <div>
                <input
                    type="email"
                    name="email"
                    placeholder="Masukan email anda"
                    class="form-control p-3 border rounded w-full"
                    required>
            </div>
            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukan password anda"
                    class="form-control p-3 border rounded w-full"
                    required>
            </div>
            <button
                type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded w-full hover:bg-red-600">
                Masuk
            </button>
        </form>
    </div>

    <div
        class="flex-1 right-section"
        style="background-image: url('<?= base_url('assets/Frame 98699.png') ?>');">
    </div>
</body>

</html>