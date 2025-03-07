<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Restore Data Kementerian - Admin IPPD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Notika Icon CSS -->
    <link rel="stylesheet" href="<?= base_url('css/notika-custom-icon.css'); ?>">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?= base_url('css/jquery.dataTables.min.css'); ?>">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('css/main.css'); ?>">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?= base_url('css/responsive.css'); ?>">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* Tombol Restore */
        .btn-restore {
            background-color: #28a745; /* Warna hijau */
            border-color: #28a745;
            color: white;
            border-radius: 50%; /* Membuat tombol berbentuk lingkaran */
            width: 40px; /* Lebar tombol */
            height: 40px; /* Tinggi tombol */
            padding: 0; /* Menghilangkan padding */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease; /* Efek transisi saat hover */
        }

        .btn-restore:hover {
            background-color: #218838; /* Warna hijau yang lebih gelap saat hover */
            border-color: #218838;
            transform: scale(1.1); /* Efek zoom kecil saat hover */
        }
    </style>
</head>
<body>
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h3 style="color: white;margin-top: 10px;">Restore Data Kementerian</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->

    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <!-- Tombol Kembali -->
                        <div class="basic-tb-hd">
                            <a href="<?= base_url('Super/Kementerian') ?>" class="btn btn-warning notika-btn-warning">
                                <i class="notika-icon notika-back"></i> Kembali ke Kementerian
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Kementerian</th>
                                        <th>Alamat</th>
                                        <th>Dihapus Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($DeletedKementerian)) { ?>
                                        <?php $No = 1; foreach ($DeletedKementerian as $key) { ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                            <td style="vertical-align: middle;"><?= $key['Alamat'] ?></td>
                                            <td style="vertical-align: middle;"><?= date('d M Y H:i', strtotime($key['deleted_at'])) ?></td>
                                            <td>
                                                <button class="btn btn-restore RestoreKementerian" data-id="<?= $key['Id'] ?>">
                                                    <i class="fas fa-trash-restore"></i> <!-- Ikon restore -->
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data yang dihapus.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->

    <!-- Scripts -->
    <script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
    <script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#data-table-basic').DataTable({
                "lengthMenu": [10, 25, 50, 100], // Opsi show entries
                "pageLength": 10, // Default jumlah data per halaman
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });

        var BaseURL = '<?= base_url() ?>';
        $(document).on("click", ".RestoreKementerian", function() {
            var Id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dikembalikan ke halaman utama.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, restore!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(BaseURL + "Super/RestoreKementerianData/" + Id).done(function(Respon) {
                        if (Respon == '1') {
                            Swal.fire(
                                'Berhasil!',
                                'Data telah dipulihkan.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                Respon,
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>