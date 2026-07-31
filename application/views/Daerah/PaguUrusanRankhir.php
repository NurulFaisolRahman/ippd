<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagu Urusan Rankhir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSS umum -->
    <?php $this->load->view('Daerah/Cssumum'); ?>
    
    <style>
        .table-pagu-rankhir th, .table-pagu-rankhir td { 
            vertical-align: middle; 
            text-align: center; 
            border: 1px solid #dee2e6; 
            padding: 8px; 
            font-size: 13px;
        }
        .table-pagu-rankhir .text-left { text-align: left !important; padding-left: 12px !important; }
        .table-pagu-rankhir .rp { white-space: nowrap; font-weight: 500; text-align: right; }
        
        .btn-aksi { padding: 4px 10px; font-size: 12px; margin: 0 2px; border-radius: 3px; }
        .btn-group-aksi {
            display: flex;
            justify-content: center;
            gap: 4px;
            flex-wrap: wrap;
        }
        
        .filter-row .form-control { height: 38px; }
        
        .badge-rankhir {
            background: #1976d2;
            color: white;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            margin-left: 10px;
        }
        
        .badge-edited {
            background-color: #ffc107;
            color: #212529;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
            margin-left: 5px;
        }
        
        .edited-row {
            background-color: #fff3cd !important;
            border-left: 4px solid #ffc107 !important;
        }
        
        .edited-row td:first-child {
            border-left: 4px solid #ffc107;
        }
        
        .deleted-row {
            background-color: #f8d7da !important;
            opacity: 0.7;
        }
        
        .source-data-info {
            background: #e3f2fd;
            border-left: 4px solid #1976d2;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 15px;
        }
        
        .modal-lg-custom {
            max-width: 85%;
            width: 85%;
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
        }
        .loading-overlay .spinner {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            text-align: center;
        }
        .loading-overlay .spinner i {
            font-size: 40px;
            color: #007bff;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        .toast {
            padding: 12px 20px;
            border-radius: 5px;
            color: #fff;
            margin-bottom: 10px;
            min-width: 250px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            animation: slideIn 0.3s ease;
        }
        .toast-success { background-color: #28a745; }
        .toast-error { background-color: #dc3545; }
        .toast-warning { background-color: #ffc107; color: #212529; }
        .toast-info { background-color: #17a2b8; }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .alert-info-catatan {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .alert-info-catatan i {
            margin-right: 5px;
        }
        
        .filter-active-badge {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-left: 10px;
        }
        
        .remove-filter {
            color: #dc3545;
            cursor: pointer;
            margin-left: 5px;
            font-weight: bold;
        }
        
        .remove-filter:hover {
            color: #c82333;
        }

        @media (max-width: 768px) {
            .table-pagu-rankhir { font-size: 11px; }
            .table-pagu-rankhir th, .table-pagu-rankhir td { padding: 4px; }
            .btn-aksi { font-size: 10px; padding: 2px 6px; }
            .modal-lg-custom { max-width: 98%; width: 98%; }
        }
    </style>
</head>
<body>

<?php $this->load->view('Daerah/sidebar'); ?>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- LOADING OVERLAY -->
                        <div class="loading-overlay" id="loadingOverlay">
                            <div class="spinner">
                                <i class="notika-icon notika-refresh"></i>
                                <h4>Memuat data...</h4>
                            </div>
                        </div>

                        <!-- ============================================================ -->
                        <!-- FILTER WILAYAH (Sebelum Login / Role != 3)                   -->
                        <!-- ============================================================ -->
                        <?php if (!isset($_SESSION['KodeWilayah']) || (isset($_SESSION['Level']) && $_SESSION['Level'] != 3)) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>"
                                                                <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                                <?= html_escape($prov['Nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="KabKota"><b>Kab/Kota</b></label>
                                                    <select class="form-control filter-select" id="KabKota">
                                                        <option value="">Pilih Kab/Kota</option>
                                                        <?php if (!empty($KodeWilayah)) { 
                                                            $selected_kab = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                                        ?>
                                                            <option value="<?= html_escape($KodeWilayah) ?>" selected>
                                                                <?= html_escape($selected_kab['Nama'] ?? $KodeWilayah) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                    $filter_instansi_nama = '';
                                    if (!empty($filter_instansi_id)) {
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                                        $filter_instansi_nama = $instansi_terpilih['nama'] ?? '';
                                    }
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                    <?php if (!empty($filter_instansi_id)) { ?>
                                        <br>
                                        <strong><i class="fa fa-building"></i> Filter Instansi:</strong> 
                                        <span class="filter-active-badge">
                                            <?= htmlspecialchars($filter_instansi_nama ?: $filter_instansi_id) ?>
                                            <a href="<?= base_url('Daerah/PaguUrusanRankhir') ?>" class="remove-filter" title="Hapus filter">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </span>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- END FILTER WILAYAH -->

                        <!-- ============================================================ -->
                        <!-- JUDUL HALAMAN                                               -->
                        <!-- ============================================================ -->
                        <div class="basic-tb-hd">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="fa fa-file-text"></i> Pagu Urusan Rankhir</h2>
                                    <p class="text-muted">
                                        <i class="fa fa-info-circle"></i> 
                                        Data Pagu Urusan Rankhir diambil dari menu <strong>Input Pagu Anggaran Per Urusan (Definitif)</strong>.
                                        <span class="badge-rankhir">
                                            <i class="fa fa-flag-checkered"></i> Pagu Urusan Rankhir
                                        </span>
                                        <?php 
                                        $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                        if (!empty($filter_instansi_id)) { 
                                            $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                                        ?>
                                            <span class="badge-rankhir" style="background: #28a745;">
                                                <i class="fa fa-filter"></i> Filter: <?= htmlspecialchars($instansi_terpilih['nama'] ?? $filter_instansi_id) ?>
                                            </span>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <!-- ============================================================ -->
                        <!-- SOURCE DATA INFO                                            -->
                        <!-- ============================================================ -->
                        <?php if (!empty($PaguUrusan)) { ?>
                            <div class="source-data-info">
                                <i class="fa fa-info-circle"></i> 
                                <strong>Data Pagu Urusan Rankhir:</strong> 
                                Data ini adalah hasil sinkronisasi dari Pagu Anggaran Per Urusan (Definitif).
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <span class="text-warning" style="font-weight: 500;">
                                        <i class="fa fa-edit"></i> Anda dapat mengedit data pada kolom Aksi.
                                    </span>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TOMBOL SINKRONISASI (HANYA ROLE 3)                          -->
                        <!-- ============================================================ -->
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                            <div style="margin-bottom: 15px;">
                                <button class="btn btn-info" id="SyncRankhir">
                                    <i class="fa fa-sync"></i> Sinkronisasi Data
                                </button>
                                <span class="text-muted" style="margin-left: 10px; font-size: 12px;">
                                    <i class="fa fa-info-circle"></i> 
                                    Sinkronisasi akan menambahkan data baru dari Pagu Urusan ke tabel Rankhir
                                </span>
                            </div>
                        <?php } ?>
                        
                        <!-- ============================================================ -->
                        <!-- TABEL PAGU URUSAN RANKHIR                                   -->
                        <!-- ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-pagu" class="table table-striped table-bordered table-pagu-rankhir">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">No</th>
                                        <th style="width:12%;">Kode Urusan</th>
                                        <th style="width:35%;">Urusan</th>
                                        <th style="width:15%;">Pagu Anggaran</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width:10%;">Status</th>
                                        <th style="width:10%;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyPaguRankhir">
                                    <?php if (empty($PaguUrusan)) { ?>
                                        <tr id="emptyRow">
                                            <td colspan="7" class="text-center" style="padding: 40px 0;">
                                                <i class="fa fa-info-circle fa-2x d-block mb-2" style="color: #999;"></i>
                                                <p style="color: #666;">Belum ada data Pagu Urusan Rankhir</p>
                                                <small class="text-muted">
                                                    Silakan sinkronisasi data dari Pagu Urusan atau tambahkan data di menu Pagu Urusan
                                                </small>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <br>
                                                    <button class="btn btn-sm btn-info" id="SyncRankhir" style="margin-top: 10px;">
                                                        <i class="fa fa-sync"></i> Sinkronisasi Sekarang
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php $no = 1; foreach ($PaguUrusan as $row) { 
                                            $isEdited = isset($row['edited_by_daerah']) && $row['edited_by_daerah'] == 1;
                                            $isDeleted = isset($row['deleted_at']) && !empty($row['deleted_at']);
                                            $rowClass = '';
                                            if ($isDeleted) $rowClass = 'deleted-row';
                                            elseif ($isEdited) $rowClass = 'edited-row';
                                        ?>
                                            <tr class="<?= $rowClass ?>" data-id="<?= $row['id'] ?>">
                                                <td class="row-number"><?= $no++ ?></td>
                                                <td class="kode-cell">
                                                    <?php if (!empty($row['kode_urusan'])) { ?>
                                                        <span class="kode-urusan"><?= html_escape($row['kode_urusan']) ?></span>
                                                    <?php } else { ?>
                                                        <span class="text-muted">-</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="urusan-cell text-left">
                                                    <?= html_escape($row['urusan']); ?>
                                                    <?php if ($isEdited) { ?>
                                                        <span class="badge-edited">✏️ Diedit</span>
                                                    <?php } ?>
                                                    <?php if ($isDeleted) { ?>
                                                        <span class="badge badge-danger" style="background-color: #dc3545; font-size: 8px; padding: 1px 6px;">
                                                            <i class="fa fa-trash"></i> Dihapus
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                                <td class="pagu-cell text-right">
                                                    <?php if (!empty($row['pagu'])) { ?>
                                                        <strong>Rp <?= number_format($row['pagu'], 0, ',', '.') ?></strong>
                                                    <?php } else { ?>
                                                        <span class="text-muted">-</span>
                                                    <?php } ?>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td class="status-cell">
                                                    <?php if ($isDeleted) { ?>
                                                        <span class="badge badge-danger" style="background-color: #6c757d;">
                                                            <i class="fa fa-trash"></i> Dihapus
                                                        </span>
                                                    <?php } elseif ($isEdited) { ?>
                                                        <span class="badge badge-warning" style="background-color: #ffc107; color: #212529;">
                                                            <i class="fa fa-edit"></i> Diedit
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-success" style="background-color: #28a745;">
                                                            <i class="fa fa-check"></i> Original
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                                    <td class="aksi-cell">
                                                        <div class="btn-group-aksi">
                                                            <?php if (!$isDeleted) { ?>
                                                                <button class="btn btn-warning btn-sm btn-aksi EditPaguRankhir" 
                                                                        data-id="<?= $row['id'] ?>"
                                                                        data-urusan="<?= html_escape($row['urusan']) ?>"
                                                                        data-pagu="<?= html_escape($row['pagu']) ?>"
                                                                        data-kode="<?= html_escape($row['kode_urusan'] ?? '') ?>"
                                                                        title="Edit Data"
                                                                        type="button">
                                                                    <i class="notika-icon notika-edit"></i> Edit
                                                                </button>
                                                                
                                                                <button class="btn btn-danger btn-sm btn-aksi HapusPaguRankhir" 
                                                                        data-id="<?= $row['id'] ?>"
                                                                        data-urusan="<?= html_escape($row['urusan']) ?>"
                                                                        title="Hapus Data"
                                                                        type="button">
                                                                    <i class="notika-icon notika-trash"></i> Hapus
                                                                </button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success btn-sm btn-aksi RestorePaguRankhir" 
                                                                        data-id="<?= $row['id'] ?>"
                                                                        data-urusan="<?= html_escape($row['urusan']) ?>"
                                                                        title="Pulihkan Data"
                                                                        type="button">
                                                                    <i class="fa fa-undo"></i> Pulihkan
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer Info -->
                        <div class="text-muted" style="margin-top: 15px; font-size: 12px; border-top: 1px solid #ddd; padding-top: 10px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-info-circle"></i> 
                                    <strong>Database:</strong> Data diambil dari tabel <code>pagu_urusan_rankhir</code>
                                    <span class="text-muted">(terpisah dari <code>pagu_urusan</code>)</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <span class="text-warning">
                                            <i class="fa fa-edit"></i> Mode Edit & Hapus: Daerah (Role 3)
                                        </span>
                                    <?php } else { ?>
                                        <span class="text-muted">
                                            <i class="fa fa-lock"></i> Login sebagai Daerah (Role 3) untuk mengedit
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div class="toast-container" id="ToastContainer"></div>

<!-- MODAL EDIT PAGU URUSAN RANKHIR -->
<div class="modal fade" id="ModalEditPaguRankhir" role="dialog">
    <div class="modal-dialog modal-lg-custom" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content" style="max-height: 95vh; overflow: hidden;">
            <div class="modal-header" style="flex-shrink: 0; background: #f8f9fa; border-bottom: 2px solid #ffc107;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b><i class="notika-icon notika-edit"></i> Edit Pagu Urusan Rankhir</b></h4>
                <div class="alert alert-warning" style="margin-top: 10px; padding: 8px 12px; font-size: 12px;">
                    <i class="fa fa-info-circle"></i> 
                    Perubahan hanya berlaku di tabel <strong>pagu_urusan_rankhir</strong> dan tidak mempengaruhi data Pagu Urusan asli.
                </div>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 20px 25px;">
                <input type="hidden" id="EditIdRankhir" value="0">
                <input type="hidden" id="EditKodeUrusanRankhir" value="">
                <input type="hidden" id="EditNamaUrusanRankhir" value="">
                
                <!-- Catatan -->
                <div class="alert-info-catatan">
                    <i class="fa fa-info-circle"></i> 
                    <strong>Catatan:</strong> Field <b>Pagu Anggaran</b> dan <b>Kode Urusan</b> bersifat opsional.
                    Hanya field <b>Urusan</b> yang wajib diisi.
                </div>
                
                <!-- Form Edit -->
                <div class="form-group">
                    <label><b>Kode Urusan</b> <span class="text-muted">(opsional)</span></label>
                    <input type="text" class="form-control" id="EditManualKodeUrusanRankhir" 
                           placeholder="Contoh: 1 atau 1.1 atau 2.3 (kosongkan jika tidak ada)" style="color: #000;">
                    <small class="text-muted">Tidak wajib diisi, kosongkan jika tidak ada kode</small>
                </div>
                
                <div class="form-group">
                    <label><b>Nama Urusan</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="EditManualNamaUrusanRankhir" 
                           placeholder="Masukkan nama urusan secara manual..." style="color: #000;">
                    <small class="text-danger">Wajib diisi</small>
                </div>
                
                <hr>
                
                <!-- PAGU ANGGARAN - OPSIONAL -->
                <div class="form-group">
                    <label><b>Pagu Anggaran Indikatif</b> <span class="text-muted">(opsional)</span></label>
                    <input type="text" class="form-control format-rupiah" id="EditPaguRankhir" 
                           placeholder="Contoh: 1.000.000.000 (kosongkan jika tidak ada)" style="color: #000;">
                    <small class="text-muted" style="display: block; margin-top: 4px;">
                        <i class="fa fa-info-circle"></i> Tidak wajib diisi, kosongkan jika tidak ada anggaran
                    </small>
                </div>

                <div class="form-example-int" style="margin-top: 15px;">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 10px;">
                                Batal
                            </button>
                            <button class="btn btn-warning" id="BtnSimpanEditPaguRankhir">
                                <b><i class="notika-icon notika-edit"></i> SIMPAN PERUBAHAN</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
<div class="modal fade" id="ModalHapusPaguRankhir" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background: #dc3545; color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h4><b><i class="fa fa-trash"></i> Konfirmasi Hapus</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="HapusIdRankhir" value="0">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <p><strong id="HapusUrusanText"></strong></p>
                <div class="alert alert-warning" style="font-size: 12px;">
                    <i class="fa fa-info-circle"></i> 
                    Data akan dihapus secara <strong>soft delete</strong> dan dapat dipulihkan kembali.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="BtnKonfirmasiHapusPaguRankhir">
                    <b><i class="fa fa-trash"></i> HAPUS</b>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- JAVASCRIPT                                                    -->
<!-- ============================================================ -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js') ?>"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var USER_LEVEL = '<?= $_SESSION['Level'] ?? '' ?>';
var CURRENT_FILTER_INSTANSI = '<?= $this->input->get('instansi_id', TRUE) ?? '' ?>';

// TOAST NOTIFICATION
function showToast(message, type = 'success') {
    var toastContainer = $('#ToastContainer');
    var toast = $('<div class="toast toast-' + type + '">' + message + '</div>');
    toastContainer.append(toast);
    setTimeout(function() {
        toast.fadeOut(300, function() { $(this).remove(); });
    }, 3500);
}

// LOADING OVERLAY
function showLoading() { $('#loadingOverlay').css('display', 'flex'); }
function hideLoading() { $('#loadingOverlay').css('display', 'none'); }

// FORMAT RUPIAH
$(document).on('input', '.format-rupiah', function() {
    var value = $(this).val().replace(/[^0-9]/g, '');
    if (value) {
        $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    }
});

function formatNumber(num) {
    if (!num || num === '' || num === 'null' || num === 'undefined') return '';
    var str = String(num).replace(/\./g, '');
    if (isNaN(str) || str === '') return '';
    return str.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function escapeHtml(text) {
    if (!text) return '';
    return String(text).replace(/[&<>"']/g, function(m) {
        var map = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'};
        return map[m];
    });
}

// ================================================================
// FILTER WILAYAH (HANYA UNTUK BELUM LOGIN ATAU ROLE != 3)
// ================================================================
<?php if (!isset($_SESSION['KodeWilayah']) || (isset($_SESSION['Level']) && $_SESSION['Level'] != 3)) { ?>
    
    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiGroupBefore").hide();
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
                $("#FilterInstansiGroupBefore").hide();
            },
            success: function(Data) {
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
                
                <?php if (!empty($KodeWilayah)) { ?>
                    $("#KabKota").val("<?= $KodeWilayah ?>").trigger('change');
                <?php } ?>
            },
            error: function() { 
                showToast("Gagal memuat data Kab/Kota", 'error');
                $("#KabKota").prop('disabled', false).html('<option value="">Pilih Kab/Kota</option>');
            }
        });
    });

    $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
            $("#FilterInstansiGroupBefore").hide();
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
            return;
        }

        $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
        $("#FilterInstansiGroupBefore").show();

        $.ajax({
            url: BaseURL + "Daerah/GetListInstansiLevel4",
            type: "POST",
            data: { 
                kode_wilayah: kabKotaKode, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: 'json',
            success: function(Data) {
                var options = '<option value="">-- Semua Instansi --</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var urlParams = new URLSearchParams(window.location.search);
                        var instansiParam = urlParams.get('instansi_id');
                        var selected = (instansiParam == Data[i].id) ? 'selected' : '';
                        if (!selected && CURRENT_FILTER_INSTANSI == Data[i].id) {
                            selected = 'selected';
                        }
                        options += '<option value="' + Data[i].id + '" ' + selected + '>' + 
                                   escapeHtml(Data[i].nama) + '</option>';
                    }
                } else {
                    options += '<option value="" disabled>Tidak ada Instansi</option>';
                }
                $("#FilterInstansiBeforeLogin").html(options);
                $("#FilterInstansiGroupBefore").show();
            },
            error: function() {
                $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
                $("#FilterInstansiGroupBefore").show();
            }
        });
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
            $("#KabKota").val(kodeKab).trigger('change');
            <?php if (!empty($this->input->get('instansi_id'))) { ?>
                setTimeout(function() {
                    if ($("#FilterInstansiBeforeLogin option[value='<?= $this->input->get('instansi_id') ?>']").length > 0) {
                        $("#FilterInstansiBeforeLogin").val("<?= $this->input->get('instansi_id') ?>");
                    }
                }, 500);
            <?php } ?>
        }, 300);
    <?php } ?>

    $("#Filter").click(function() {
        var provinsi = $("#Provinsi").val();
        var kabKota = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        if (provinsi === "") { showToast("Mohon Pilih Provinsi", 'warning'); return; }
        if (kabKota === "") { showToast("Mohon Pilih Kab/Kota", 'warning'); return; }

        $("#Filter").prop('disabled', true).text('Memuat...');
        
        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { 
                KodeWilayah: kabKota,
                InstansiId: instansiId || '',
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: 'json',
            success: function(res) {
                if (res === '1' || res === 1) {
                    var redirectUrl = BaseURL + "Daerah/PaguUrusanRankhir";
                    if (instansiId && instansiId != '') {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    showToast(res || "Gagal menyimpan filter wilayah!", 'error');
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() {
                showToast("Gagal menghubungi server!", 'error');
                $("#Filter").prop('disabled', false).text('Filter');
            }
        });
    });

<?php } ?>

// ================================================================
// EDIT PAGU URUSAN RANKHIR
// ================================================================
$(document).off('click', '.EditPaguRankhir').on('click', '.EditPaguRankhir', function() {
    var id = $(this).data('id');
    var kode = $(this).data('kode') || '';
    var urusan = $(this).data('urusan') || '';
    var pagu = $(this).data('pagu') || '';
    
    $('#EditIdRankhir').val(id);
    $('#EditKodeUrusanRankhir').val(kode);
    $('#EditNamaUrusanRankhir').val(urusan);
    $('#EditPaguRankhir').val(pagu ? formatNumber(String(pagu)) : '');
    $('#EditManualKodeUrusanRankhir').val(kode || '');
    $('#EditManualNamaUrusanRankhir').val(urusan || '');
    
    $('#ModalEditPaguRankhir').modal('show');
});

// ================================================================
// SIMPAN EDIT PAGU URUSAN RANKHIR
// ================================================================
$(document).off('click', '#BtnSimpanEditPaguRankhir').on('click', '#BtnSimpanEditPaguRankhir', function() {
    var id = $('#EditIdRankhir').val();
    var kode = $('#EditManualKodeUrusanRankhir').val().trim();
    var urusan = $('#EditManualNamaUrusanRankhir').val().trim();
    
    if (!urusan) {
        showToast('Nama Urusan harus diisi!', 'error');
        $('#EditManualNamaUrusanRankhir').focus();
        return;
    }
    
    var pagu = $('#EditPaguRankhir').val().trim();
    var paguClean = '';
    if (pagu !== "") {
        paguClean = pagu.replace(/\./g, '');
        if (isNaN(paguClean)) {
            showToast('Pagu Anggaran harus berupa angka!', 'error');
            return;
        }
    }
    
    if (!confirm("Anda akan mengubah data Pagu Urusan Rankhir.\n\nPerubahan hanya berlaku di tabel pagu_urusan_rankhir.\n\nLanjutkan?")) {
        return;
    }
    
    showLoading();
    var btn = $(this);
    btn.prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
    
    $.ajax({
        url: BaseURL + "Daerah/UpdatePaguUrusanRankhir",
        type: "POST",
        data: {
            id: id,
            kode_urusan: kode,
            urusan: urusan,
            pagu: paguClean,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            btn.prop('disabled', false).html('<b><i class="notika-icon notika-edit"></i> SIMPAN PERUBAHAN</b>');
            
            if (res.status === "success") {
                showToast(res.message || 'Data berhasil diperbarui!', 'success');
                $('#ModalEditPaguRankhir').modal('hide');
                location.reload();
            } else {
                showToast(res.message || 'Gagal update data!', 'error');
            }
        },
        error: function(xhr) {
            hideLoading();
            btn.prop('disabled', false).html('<b><i class="notika-icon notika-edit"></i> SIMPAN PERUBAHAN</b>');
            showToast('Terjadi kesalahan: ' + xhr.statusText, 'error');
        }
    });
});

// ================================================================
// HAPUS PAGU URUSAN RANKHIR
// ================================================================
$(document).off('click', '.HapusPaguRankhir').on('click', '.HapusPaguRankhir', function() {
    var id = $(this).data('id');
    var urusan = $(this).data('urusan') || '';
    
    $('#HapusIdRankhir').val(id);
    $('#HapusUrusanText').text('Urusan: ' + urusan);
    $('#ModalHapusPaguRankhir').modal('show');
});

$(document).off('click', '#BtnKonfirmasiHapusPaguRankhir').on('click', '#BtnKonfirmasiHapusPaguRankhir', function() {
    var id = $('#HapusIdRankhir').val();
    
    showLoading();
    var btn = $(this);
    btn.prop('disabled', true).html('<span class="spinner-border-sm"></span> Menghapus...');
    
    $.ajax({
        url: BaseURL + "Daerah/HapusPaguUrusanRankhir",
        type: "POST",
        data: {
            id: id,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            btn.prop('disabled', false).html('<b><i class="fa fa-trash"></i> HAPUS</b>');
            
            if (res.status === "success") {
                showToast('Data berhasil dihapus!', 'success');
                $('#ModalHapusPaguRankhir').modal('hide');
                location.reload();
            } else {
                showToast(res.message || 'Gagal hapus data!', 'error');
            }
        },
        error: function(xhr) {
            hideLoading();
            btn.prop('disabled', false).html('<b><i class="fa fa-trash"></i> HAPUS</b>');
            showToast('Terjadi kesalahan: ' + xhr.statusText, 'error');
        }
    });
});

// ================================================================
// RESTORE PAGU URUSAN RANKHIR
// ================================================================
$(document).off('click', '.RestorePaguRankhir').on('click', '.RestorePaguRankhir', function() {
    var id = $(this).data('id');
    var urusan = $(this).data('urusan') || '';
    
    if (!confirm("Pulihkan data ini?\n\nUrusan: " + urusan)) {
        return;
    }
    
    showLoading();
    var btn = $(this);
    btn.prop('disabled', true).html('<span class="spinner-border-sm"></span> Memulihkan...');
    
    $.ajax({
        url: BaseURL + "Daerah/RestorePaguUrusanRankhir",
        type: "POST",
        data: {
            id: id,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            btn.prop('disabled', false).html('<i class="fa fa-undo"></i> Pulihkan');
            
            if (res.status === "success") {
                showToast('Data berhasil dipulihkan!', 'success');
                location.reload();
            } else {
                showToast(res.message || 'Gagal memulihkan data!', 'error');
            }
        },
        error: function(xhr) {
            hideLoading();
            btn.prop('disabled', false).html('<i class="fa fa-undo"></i> Pulihkan');
            showToast('Terjadi kesalahan: ' + xhr.statusText, 'error');
        }
    });
});

// ================================================================
// SINKRONISASI DATA
// ================================================================
$(document).off('click', '#SyncRankhir').on('click', '#SyncRankhir', function() {
    var btn = $(this);
    var instansiId = new URLSearchParams(window.location.search).get('instansi_id') || '';
    
    var confirmMsg = "Sinkronisasi akan menambahkan data baru dari Pagu Urusan ke Rankhir.\n\nData yang sudah diedit atau dihapus tidak akan diubah.";
    if (instansiId) {
        confirmMsg += "\n\n📌 Filter Instansi: Instansi terpilih";
    } else {
        confirmMsg += "\n\n📌 Filter: Semua Instansi";
    }
    
    if (!confirm(confirmMsg)) {
        return;
    }
    
    showLoading();
    btn.prop('disabled', true).html('<span class="spinner-border-sm"></span> Sinkronisasi...');
    
    $.ajax({
        url: BaseURL + "Daerah/SyncPaguUrusanRankhir",
        type: "POST",
        data: { 
            instansi_id: instansiId,
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                showToast(res.message, 'success');
                location.reload();
            } else {
                showToast(res.message || 'Gagal sinkronisasi!', 'error');
                btn.prop('disabled', false).html('<i class="fa fa-sync"></i> Sinkronisasi');
            }
        },
        error: function(xhr) {
            hideLoading();
            showToast('Terjadi kesalahan: ' + xhr.statusText, 'error');
            btn.prop('disabled', false).html('<i class="fa fa-sync"></i> Sinkronisasi');
        }
    });
});

// ================================================================
// CLEAN MODAL
// ================================================================
$(document).on("hidden.bs.modal", ".modal", function() {
    $(".modal-backdrop").remove();
    $("body").removeClass("modal-open");
    $("body").css("overflow", "auto");
    $("html").css("overflow", "auto");
});

// ================================================================
// INIT DATATABLE
// ================================================================
$(document).ready(function() {
    if ($('#data-table-pagu').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-pagu')) {
                $('#data-table-pagu').DataTable().destroy();
            }
            $('#data-table-pagu').DataTable({
                "pageLength": 10,
                "ordering": false,
                "stateSave": false,
                "scrollX": true,
                "language": {
                    "emptyTable": "Tidak ada data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }
});
</script>

</body>
</html>