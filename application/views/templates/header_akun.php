<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Instansi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Black&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
       .navbar-custom {
            background-color: #00C292 !important; /* Hijau terang */
            padding: 5px 10px !important; /* Mengurangi padding */
            min-height: 40px !important; /* Mengurangi tinggi navbar */
        }

        .navbar-brand {
            font-family: 'Roboto Black', sans-serif; /* Menggunakan font Roboto Black */
            font-size: 18px !important; /* Perkecil ukuran teks */
            font-weight: 900 !important; /* Superbold */
            text-transform: uppercase;
        }

        /* Perkecil tombol toggle */
        

        /* Menonaktifkan klik pada "Tambah Akun" */
        .disabled-link {
            pointer-events: none;
            cursor: default;
            color: white; /* Pastikan tetap terlihat */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand disabled-link" href="#">Kelola Akun Instansi
        </a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
