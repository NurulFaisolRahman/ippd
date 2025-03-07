<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Data Akun Instansi</title>
    <!-- CSS Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        /* Custom CSS */
        .btn-restore, .btn-tabel {
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: 500;
            min-width: 140px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-tabel {
            padding: 5px 20px;
            min-width: 100px;
        }

        .btn-restore:hover, .btn-tabel:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-restore:active, .btn-tabel:active {
            transform: translateY(0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 1.5rem;
        }

        .table th, .table td {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .table code {
            padding: 0.2rem 0.4rem;
            font-size: 0.875em;
            background-color: #f8f9fa;
            border-radius: 4px;
            font-family: monospace;
            word-break: break-all;
        }

        .table-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .table-empty-state {
            padding: 2rem 1rem;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .table-empty-state i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #6c757d;
        }

        .table-empty-state p {
            margin-bottom: 0;
            color: #6c757d;
        }

        .search-container .input-group {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-container input {
            border-radius: 20px 0 0 20px;
            border: 1px solid #ced4da;
            padding-left: 15px;
        }

        .search-container .input-group-text {
            border-radius: 0 20px 20px 0;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-left: none;
        }

        /* Responsive Styles */
        @media (max-width: 991px) {
            .page-header {
                flex-wrap: wrap;
                gap: 10px;
            }

            .page-header h2 {
                font-size: 1.6rem;
                margin-bottom: 10px;
            }

            .search-container {
                max-width: 100%;
                margin: 15px 0;
            }

            .card {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 767px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header h2 {
                font-size: 1.4rem;
                margin-bottom: 15px;
            }

            .btn-restore {
                width: 100%;
                font-size: 0.8rem;
            }

            .btn-tabel {
                width: 100%;
                font-size: 0.75rem;
                margin-bottom: 5px;
            }

            .table th, .table td {
                padding: 0.625rem 0.5rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Header Section -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="page-header d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-trash-restore me-2"></i>Restore Data Akun Instansi</h2>
                    <div>
                        <a href="<?= base_url('KelolaInstansi/'); ?>" class="btn btn-danger btn-restore">
                            <i class="fas fa-arrow-right me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div id="content" class="mt-4 mb-3">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Halaman ini menampilkan data akun Instansi yang telah dihapus (soft delete).
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card">
            <div class="card-body">
                <h3><i class="fas fa-trash me-2"></i>Daftar Akun Instansi Yang Dihapus</h3>
                <div class="table-responsive mt-3">
                    <table id="deletedAkunTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">No</th>
                                <th scope="col" width="25%">Nama</th>
                                <th scope="col" width="40%">Password (hashed)</th>
                                <th scope="col" width="30%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat oleh DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.4.8/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            const table = $('#deletedAkunTable').DataTable({
                lengthMenu: [10, 25, 50, 100], // Opsi "Show Entries"
                pageLength: 10, // Default jumlah entri per halaman
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                ajax: {
                    url: "<?= base_url('KelolaInstansi/get_deleted_akun'); ?>",
                    type: "GET",
                    dataSrc: "" // Data langsung dari response
                },
                columns: [
                    { data: null, render: (data, type, row, meta) => meta.row + 1 }, // Nomor urut
                    { data: "nama" }, // Kolom Nama
                    { data: "password", render: (data) => `<code>${data || '*****'}</code>` }, // Kolom Password
                    { data: null, render: (data) => `
                        <button class="btn btn-success btn-tabel" onclick="restoreAkun(${data.id})">
                            <i class="fas fa-undo"></i> Restore
                        </button>
                        <button class="btn btn-danger btn-tabel" onclick="hapusPermanen(${data.id})">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    `} // Kolom Aksi
                ]
            });

            // Fungsi untuk merestore akun
            window.restoreAkun = function(id) {
                Swal.fire({
                    title: "Restore Akun?",
                    text: "Akun ini akan dikembalikan ke daftar aktif.",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "<i class='fas fa-undo me-1'></i> Restore",
                    cancelButtonText: "<i class='fas fa-times me-1'></i> Batal",
                    confirmButtonColor: "#198754",
                    cancelButtonColor: "#6c757d"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Memproses...",
                            html: "Mohon tunggu sebentar",
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });

                        setTimeout(() => {
                            $.ajax({
                                url: "<?= base_url('KelolaInstansi/restore_akun'); ?>",
                                type: "POST",
                                data: { id: id },
                                dataType: "json",
                                success: (response) => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Berhasil!",
                                        text: response.message,
                                        confirmButtonColor: "#198754"
                                    });
                                    table.ajax.reload(); // Muat ulang tabel setelah restore
                                },
                                error: () => {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Gagal!",
                                        text: "Terjadi kesalahan saat memulihkan akun.",
                                        confirmButtonColor: "#dc3545"
                                    });
                                }
                            });
                        }, 800); // Delay 800 ms
                    }
                });
            };

            // Fungsi untuk menghapus permanen
            window.hapusPermanen = function(id) {
                Swal.fire({
                    title: "Hapus Permanen?",
                    text: "Data ini akan dihapus secara permanen dan tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "<i class='fas fa-trash me-1'></i> Hapus Permanen",
                    cancelButtonText: "<i class='fas fa-times me-1'></i> Batal",
                    confirmButtonColor: "#dc3545",
                    cancelButtonColor: "#6c757d",
                    footer: '<span class="text-muted"><i class="fas fa-info-circle me-1"></i> Tindakan ini tidak dapat dibatalkan</span>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Memproses...",
                            html: "Mohon tunggu sebentar",
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });

                        setTimeout(() => {
                            $.ajax({
                                url: "<?= base_url('KelolaInstansi/hapus_permanen'); ?>",
                                type: "POST",
                                data: { id: id },
                                dataType: "json",
                                success: (response) => {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Berhasil!",
                                        text: response.message,
                                        confirmButtonColor: "#198754"
                                    });
                                    table.ajax.reload(); // Muat ulang tabel setelah penghapusan
                                },
                                error: () => {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Gagal!",
                                        text: "Terjadi kesalahan saat menghapus data.",
                                        confirmButtonColor: "#dc3545"
                                    });
                                }
                            });
                        }, 800); // Delay 800 ms
                    }
                });
            };
        });
    </script>
</body>
</html>