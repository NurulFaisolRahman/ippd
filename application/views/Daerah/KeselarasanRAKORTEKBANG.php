<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Keselarasan Kesepakatan RAKORTEKBANG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('Daerah/Cssumum'); ?>
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <style>
        /* ============================================================
           STYLE UTAMA
           ============================================================ */
        .table-keselarasan th, .table-keselarasan td { 
            vertical-align: middle; 
            text-align: center; 
            border: 1px solid #dee2e6; 
            padding: 6px; 
            font-size: 12px;
        }
        .table-keselarasan .uraian { 
            text-align: left !important; 
            padding-left: 10px !important; 
        }
        .table-keselarasan .target-numeric { 
            white-space: nowrap; 
            font-weight: 500; 
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        .table-keselarasan .target-numeric.text-left {
            text-align: left !important;
        }
        
        /* ===== HEADER ROW ===== */
        .header-row {
            background-color: #f8f9fa !important;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .header-row:hover {
            background-color: #e9ecef !important;
        }
        .header-row.status-normal {
            border-left: 4px solid #28a745;
        }
        .header-row .no-column {
            font-weight: 700;
            color: #495057;
            width: 50px;
            min-width: 50px;
        }
        
        /* ===== DETAIL ROW ===== */
        .detail-row {
            background-color: #ffffff;
            transition: background-color 0.2s ease;
        }
        .detail-row:hover {
            background-color: #f5f5f5;
        }
        .detail-row.detail-hidden {
            display: none !important;
        }
        .detail-container {
            padding: 5px 5px 5px 30px;
            overflow-x: auto;
        }
        .detail-container .table {
            min-width: 1200px;
        }
        
        /* ===== BADGE ===== */
        .badge-detail {
            background-color: #17a2b8;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
        }
        .badge-level {
            font-size: 9px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 600;
            margin-right: 5px;
        }
        .badge-urusan { background: #cce5ff; color: #004085; }
        .badge-bidang { background: #d1ecf1; color: #0c5460; }
        .badge-program { background: #d4edda; color: #155724; }
        
        /* ===== FILTER ===== */
        .filter-section {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        .filter-section .filter-label {
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 5px;
            color: #495057;
        }
        .filter-section select {
            height: 38px;
            font-size: 13px;
        }
        
        /* ===== TOMBOL ===== */
        .btn-aksi { padding: 3px 6px; font-size: 0.8rem; margin: 0 1px; }
        .btn-group-aksi {
            display: flex;
            justify-content: center;
            gap: 3px;
            flex-wrap: wrap;
        }
        .btn-add-detail {
            padding: 2px 10px;
            font-size: 11px;
        }
        .no-data {
            padding: 30px 0;
            color: #999;
        }
        
        /* ===== LOADING ===== */
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
        
        /* ===== MODAL ===== */
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding: 15px 20px;
        }
        .modal-content {
            max-height: 95vh;
            overflow: hidden;
        }
        .modal-lg-custom {
            max-width: 95%;
            width: 95%;
        }
        .modal.fixed-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            overflow-y: auto;
            background: rgba(0,0,0,0.5);
        }
        .modal.fixed-modal .modal-dialog {
            margin: 20px auto;
            position: relative;
            top: 0;
            left: 0;
            transform: none !important;
        }
        
        /* ===== NOMENKLATUR ===== */
        .nomenklatur-container {
            margin-bottom: 15px;
        }
        .breadcrumb-nomenklatur {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
        }
        .breadcrumb-nomenklatur .badge {
            background: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 8px;
        }
        .breadcrumb-nomenklatur .path-display {
            font-weight: 500;
            color: #2c3e50;
        }
        .cascading-select {
            margin-bottom: 10px;
        }
        .cascading-select select {
            height: 38px;
            font-size: 13px;
        }
        .cascading-select label {
            font-weight: 600;
            font-size: 12px;
            color: #495057;
            margin-bottom: 3px;
        }
        .info-nomenklatur {
            background: #e8f0fe;
            padding: 10px 15px;
            border-radius: 4px;
            margin-top: 10px;
            border-left: 3px solid #007bff;
            display: none;
        }
        .info-nomenklatur strong {
            color: #1a5276;
        }
        
        /* ===== PREVIEW FIELD ===== */
        .preview-field {
            margin-top: 10px;
            padding: 10px 15px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        .preview-field .preview-item {
            display: inline-block;
            margin-right: 15px;
            font-size: 12px;
        }
        .preview-field .preview-item .label {
            font-weight: 600;
            color: #495057;
        }
        .preview-field .preview-item .value {
            color: #007bff;
            font-weight: 500;
        }
        
        /* ===== MANUAL INPUT ===== */
        .manual-input-group {
            margin-top: 15px;
            padding: 15px;
            background: #fafafa;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }
        
        /* ===== TABS ===== */
        .nav-tabs > li > a {
            font-weight: 600;
            color: #555;
            padding: 8px 15px;
            font-size: 13px;
        }
        .nav-tabs > li.active > a {
            color: #007bff;
            border-bottom-color: #007bff;
        }
        .tab-content {
            padding: 15px 0;
        }
        
        /* ===== PANEL ===== */
        .panel-heading h4 {
            margin: 0;
            font-size: 14px;
        }
        
        /* ===== INDIKATOR OTOMATIS ===== */
        .indikator-otomatis {
            background: #f0f8ff;
            padding: 10px 15px;
            border-radius: 4px;
            border-left: 3px solid #17a2b8;
            margin-top: 10px;
            display: none;
        }
        .indikator-otomatis .indikator-item {
            padding: 5px 0;
            border-bottom: 1px dashed #e9ecef;
        }
        .indikator-otomatis .indikator-item:last-child {
            border-bottom: none;
        }
        .indikator-otomatis .badge-indikator {
            background: #17a2b8;
            color: #fff;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            margin-right: 5px;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .table-keselarasan {
                font-size: 10px;
            }
            .table-keselarasan th, .table-keselarasan td {
                padding: 4px;
            }
            .btn-aksi {
                font-size: 0.7rem;
                padding: 2px 4px;
            }
            .modal-body {
                max-height: 60vh;
                padding: 10px 15px;
            }
            .modal-lg-custom {
                max-width: 98%;
                width: 98%;
            }
            .modal.fixed-modal .modal-dialog {
                margin: 10px auto;
            }
            .cascading-select {
                padding: 0 5px;
            }
            .preview-field .preview-item {
                display: block;
                margin-bottom: 5px;
            }
        }
        
        /* ===== STYLE UNTUK FORMAT ANGKA ===== */
        .format-angka-target {
            font-family: 'Courier New', monospace;
            font-weight: 500;
        }
        .format-angka-target:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        .text-muted small {
            font-size: 10px;
        }
        .target-preview {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>

<body>

<?php $this->load->view('Daerah/sidebar'); ?>

<!-- LOADING OVERLAY -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner">
        <i class="notika-icon notika-refresh"></i>
        <h4>Memuat data...</h4>
    </div>
</div>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- ============================================================ -->
                        <!-- FILTER WILAYAH                                               -->
                        <!-- ============================================================ -->
                    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div class="filter-section">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="filter-group">
                                        <label class="filter-label" for="Provinsi"><b>Provinsi</b></label>
                                        <select class="form-control" id="Provinsi">
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
                                <div class="col-lg-4 col-md-6">
                                    <div class="filter-group">
                                        <label class="filter-label" for="KabKota"><b>Kab/Kota</b></label>
                                        <select class="form-control" id="KabKota">
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
                                <div class="col-lg-4 col-md-6">
                                    <div class="filter-group" style="margin-top: 28px;">
                                        <button class="btn btn-primary btn-block" id="Filter">
                                            <b>Filter</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                        <?php if (!empty($KodeWilayah)) { ?>
                            <?php
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                            ?>
                            <div class="alert alert-info" style="margin-bottom: 20px;">
                                <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                <br><strong>Tahun:</strong> <?= htmlspecialchars($TahunAktif ?? date('Y')) ?>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TOMBOL TAMBAH HEADER - HANYA ROLE 3                          -->
                        <!-- ============================================================ -->
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                            <div style="margin-bottom: 20px;">
                                <button class="btn btn-success" id="BtnTambahHeader">
                                    <i class="notika-icon notika-plus"></i> <b>Tambah Header RAKORTEKBANG</b>
                                </button>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TABEL KESELARASAN                                            -->
                        <!-- ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-keselarasan">
                                <thead>
                                    <tr>
                                        <th style="width:50px; min-width:50px;">NO</th>
                                        <th style="min-width:120px;">KODE BIDANG</th>
                                        <th style="min-width:250px;">BIDANG URUSAN</th>
                                        <th style="min-width:150px;">ASTA CITA</th>
                                        <th style="min-width:200px;">OUTCOME PRIORITAS</th>
                                        <th style="min-width:120px;">KODE PROGRAM</th>
                                        <th style="min-width:250px;">PROGRAM</th>
                                        <th style="width:80px;">Jml Sub Kegiatan</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width:120px;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($KeselarasanData)) { ?>
                                        <?php 
                                        $no = 1;
                                        foreach ($KeselarasanData as $row) { 
                                        ?>
                                            <!-- HEADER ROW -->
                                            <tr class="header-row status-normal" 
                                                data-header-id="<?= $row['id'] ?>" 
                                                data-kode-bidang="<?= html_escape($row['kode_bidang'] ?? '') ?>"
                                                data-bidang-urusan="<?= html_escape($row['bidang_urusan'] ?? '') ?>"
                                                data-kode-program="<?= html_escape($row['kode_program'] ?? '') ?>"
                                                data-program="<?= html_escape($row['program'] ?? '') ?>"
                                                data-expanded="false">
                                                <td class="text-center header-clickable no-column" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?= $no++ ?>
                                                </td>
                                                <td class="text-center header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?= html_escape($row['kode_bidang'] ?? '-') ?>
                                                </td>
                                                <td class="uraian header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?= nl2br(html_escape($row['bidang_urusan'] ?? '-')) ?>
                                                </td>
                                                <td class="uraian header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?= nl2br(html_escape($row['asta_cita'] ?? '-')) ?>
                                                </td>
                                                <td class="uraian header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?= nl2br(html_escape($row['outcome_prioritas'] ?? '-')) ?>
                                                </td>
                                                <td class="text-center header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?= html_escape($row['kode_program'] ?? '-') ?>
                                                </td>
                                                <td class="uraian header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?= nl2br(html_escape($row['program'] ?? '-')) ?>
                                                </td>
                                                <td class="text-center header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <span class="badge badge-detail">
                                                        <i class="fa fa-list"></i> <?= $row['sub_kegiatan_count'] ?? 0 ?>
                                                    </span>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <td class="text-center">
                                                        <div class="btn-group-aksi">
                                                            <button class="btn btn-warning btn-sm BtnEditHeader"
                                                                data-id="<?= $row['id'] ?>"
                                                                data-kode-bidang="<?= html_escape($row['kode_bidang'] ?? '') ?>"
                                                                data-bidang-urusan="<?= html_escape($row['bidang_urusan'] ?? '') ?>"
                                                                data-asta-cita="<?= html_escape($row['asta_cita'] ?? '') ?>"
                                                                data-outcome-prioritas="<?= html_escape($row['outcome_prioritas'] ?? '') ?>"
                                                                data-kode-program="<?= html_escape($row['kode_program'] ?? '') ?>"
                                                                data-program="<?= html_escape($row['program'] ?? '') ?>"
                                                                data-tahun="<?= $row['tahun'] ?? date('Y') ?>"
                                                                title="Edit Header"
                                                                type="button">
                                                                <i class="notika-icon notika-edit"></i>
                                                            </button>
                                                            <button class="btn btn-danger btn-sm BtnHapusHeader"
                                                                data-id="<?= $row['id'] ?>"
                                                                title="Hapus Header"
                                                                type="button">
                                                                <i class="notika-icon notika-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                            
                                            <!-- DETAIL ROW - SUB KEGIATAN -->
                                            <?php if (!empty($row['sub_kegiatan'])) { ?>
                                                <tr class="detail-row detail-hidden" data-header-id="<?= $row['id'] ?>">
                                                    <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '9' : '8' ?>" style="padding:0;">
                                                        <div class="detail-container">
                                                            <table class="table table-bordered table-condensed" style="margin:0; font-size:10px; min-width:1200px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:12%;vertical-align:middle;">KODE SUB KEGIATAN</th>
                                                                        <th style="width:15%;vertical-align:middle;">SUB KEGIATAN</th>
                                                                        <th style="width:20%;vertical-align:middle;">INDIKATOR SUB KEGIATAN</th>
                                                                        <th style="width:8%;vertical-align:middle;">SATUAN</th>
                                                                        <th style="width:12%;vertical-align:middle;">TARGET RAKORTEKBANG</th>
                                                                        <th style="width:12%;vertical-align:middle;">TARGET RKPD</th>
                                                                        <th style="width:15%;vertical-align:middle;">KETERANGAN</th>
                                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                            <th style="width:6%;vertical-align:middle;">AKSI</th>
                                                                        <?php } ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($row['sub_kegiatan'] as $index => $detail) { 
                                                                        // Format target RAKORTEKBANG
                                                                        $targetRakortekbang = '-';
                                                                        if ($detail['target_rakortekbang'] !== null && $detail['target_rakortekbang'] !== '') {
                                                                            $angka = (float)$detail['target_rakortekbang'];
                                                                            if (floor($angka) == $angka) {
                                                                                $targetRakortekbang = number_format($angka, 0, ',', '.');
                                                                            } else {
                                                                                $targetRakortekbang = number_format($angka, 2, ',', '.');
                                                                            }
                                                                        }
                                                                        
                                                                        // Format target RKPD
                                                                        $targetRkpd = '-';
                                                                        if ($detail['target_rkpd'] !== null && $detail['target_rkpd'] !== '') {
                                                                            $angka = (float)$detail['target_rkpd'];
                                                                            if (floor($angka) == $angka) {
                                                                                $targetRkpd = number_format($angka, 0, ',', '.');
                                                                            } else {
                                                                                $targetRkpd = number_format($angka, 2, ',', '.');
                                                                            }
                                                                        }
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= html_escape($detail['kode_sub_kegiatan'] ?? '-') ?></td>
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['sub_kegiatan'] ?? '-')) ?></td>
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['indikator_sub_kegiatan'] ?? '-')) ?></td>
                                                                            <td><?= html_escape($detail['satuan'] ?? '-') ?></td>
                                                                            <td class="text-left"><?= $targetRakortekbang ?></td>
                                                                            <td class="text-left"><?= $targetRkpd ?></td>
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['keterangan'] ?? '-')) ?></td>
                                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                                <td>
                                                                                    <div class="btn-group-aksi">
                                                                                        <button class="btn btn-warning btn-xs BtnEditSubKegiatan"
                                                                                            data-id="<?= $detail['id'] ?>"
                                                                                            data-header-id="<?= $row['id'] ?>"
                                                                                            title="Edit Sub Kegiatan"
                                                                                            type="button">
                                                                                            <i class="notika-icon notika-edit"></i>
                                                                                        </button>
                                                                                        <button class="btn btn-danger btn-xs BtnHapusSubKegiatan"
                                                                                            data-id="<?= $detail['id'] ?>"
                                                                                            title="Hapus Sub Kegiatan"
                                                                                            type="button">
                                                                                            <i class="notika-icon notika-trash"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            <?php } ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                            <!-- BARIS TAMBAH SUB KEGIATAN - HANYA ROLE 3 -->
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <tr class="detail-row detail-hidden" data-header-id="<?= $row['id'] ?>" style="background:#fafafa;">
                                                    <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '9' : '8' ?>" class="text-center" style="padding:5px;">
                                                        <button class="btn btn-success btn-sm btn-add-sub-kegiatan"
                                                            data-header-id="<?= $row['id'] ?>"
                                                            title="Tambah Sub Kegiatan"
                                                            type="button">
                                                            <i class="notika-icon notika-plus"></i> Tambah Sub Kegiatan
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '9' : '8' ?>" class="text-center no-data">
                                                <i class="fa fa-inbox" style="font-size: 40px; display: block; color: #ddd;"></i>
                                                <strong>Belum ada data Keselarasan RAKORTEKBANG</strong>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <br>
                                                    <small class="text-muted">Klik tombol <strong>"Tambah Header RAKORTEKBANG"</strong> untuk mulai mengisi data.</small>
                                                <?php } ?>
                                            </td>
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
</div>

<!-- ============================================================ -->
<!-- MODAL HEADER - HANYA ROLE 3                                   -->
<!-- ============================================================ -->
<div class="modal fade fixed-modal" id="ModalHeader" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#28a745; color:#fff;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="ModalHeaderTitle">Tambah/Edit Header RAKORTEKBANG</b></h4>
                <small style="color:#fff;">Pilih dari nomenklatur atau isi manual</small>
            </div>
            <div class="modal-body">
                <input type="hidden" id="HeaderId" value="0">
                <input type="hidden" id="IsEditMode" value="0">
                
                <!-- ============================================================ -->
                <!-- TAB NOMENKLATUR / MANUAL                                      -->
                <!-- ============================================================ -->
                <ul class="nav nav-tabs" id="headerTab">
                    <li class="active"><a href="#tab_nomenklatur" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_manual" data-toggle="tab">✏️ Isi Manual</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <!-- ============================================================ -->
                    <!-- TAB NOMENKLATUR                                              -->
                    <!-- ============================================================ -->
                    <div class="tab-pane fade in active" id="tab_nomenklatur">
                        <div class="nomenklatur-container">
                            <div class="breadcrumb-nomenklatur" style="margin-top:10px;">
                                <span class="badge">📁 Jalur Pilihan</span>
                                <span class="path-display" id="path_display_header">Belum ada yang dipilih</span>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 cascading-select">
                                    <label><b>1. Urusan (Level 1)</b></label>
                                    <select class="form-control" id="header_select_urusan">
                                        <option value="">-- Pilih Urusan --</option>
                                    </select>
                                    <small class="text-muted">Pilih urusan terlebih dahulu</small>
                                </div>
                                <div class="col-md-4 cascading-select">
                                    <label><b>2. Bidang Urusan (Level 2)</b></label>
                                    <select class="form-control" id="header_select_bidang_urusan" disabled>
                                        <option value="">-- Pilih Bidang Urusan --</option>
                                    </select>
                                    <small class="text-muted">Pilih bidang urusan untuk KODE BIDANG dan BIDANG URUSAN</small>
                                </div>
                                <div class="col-md-4 cascading-select">
                                    <label><b>3. Program (Level 3)</b></label>
                                    <select class="form-control" id="header_select_program" disabled>
                                        <option value="">-- Pilih Program --</option>
                                    </select>
                                    <small class="text-muted">Pilih program untuk KODE PROGRAM dan PROGRAM</small>
                                </div>
                            </div>
                            
                            <div class="info-nomenklatur" id="info_nomenklatur_header">
                                <strong>📌 Terpilih:</strong>
                                <span id="selected_nomenklatur_header"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ============================================================ -->
                    <!-- TAB MANUAL                                                   -->
                    <!-- ============================================================ -->
                    <div class="tab-pane fade" id="tab_manual">
                        <div class="manual-input-group" style="margin-top:10px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>KODE URUSAN</b></label>
                                        <input type="text" class="form-control" id="manual_kode_urusan" placeholder="Contoh: 1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>KODE BIDANG</b></label>
                                        <input type="text" class="form-control" id="manual_kode_bidang" placeholder="Contoh: 1.01">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>KODE PROGRAM</b></label>
                                        <input type="text" class="form-control" id="manual_kode_program" placeholder="Contoh: 1.01.02">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>URUSAN</b></label>
                                        <textarea class="form-control" id="manual_urusan" rows="2" placeholder="Isi urusan manual..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>BIDANG URUSAN</b> <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="manual_bidang_urusan" rows="2" placeholder="Isi bidang urusan manual..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>PROGRAM</b> <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="manual_program" rows="2" placeholder="Isi program manual..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- FORM HEADER                                                   -->
                <!-- ============================================================ -->
                <div class="row" style="margin-top:15px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>TAHUN</b></label>
                            <select class="form-control" id="TahunHeader">
                                <?php for ($thn = 2025; $thn <= 2030; $thn++) { ?>
                                    <option value="<?= $thn ?>" <?= ($thn == date('Y')) ? 'selected' : '' ?>>
                                        <?= $thn ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>OUTCOME PRIORITAS</b></label>
                            <textarea class="form-control" id="OutcomePrioritas" rows="2" placeholder="Outcome Prioritas..."></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>ASTA CITA</b></label>
                            <textarea class="form-control" id="AstaCita" rows="2" placeholder="Asta Cita..."></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- PREVIEW FIELD                                                 -->
                <!-- ============================================================ -->
                <div class="preview-field">
                    <span class="preview-item">
                        <span class="label">KODE BIDANG:</span>
                        <span class="value" id="preview_kode_bidang">-</span>
                    </span>
                    <span class="preview-item">
                        <span class="label">BIDANG URUSAN:</span>
                        <span class="value" id="preview_bidang_urusan">-</span>
                    </span>
                    <span class="preview-item">
                        <span class="label">KODE PROGRAM:</span>
                        <span class="value" id="preview_kode_program">-</span>
                    </span>
                    <span class="preview-item">
                        <span class="label">PROGRAM:</span>
                        <span class="value" id="preview_program">-</span>
                    </span>
                </div>
                
                <hr>
                <div class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-success" id="BtnSimpanHeader"><b>SIMPAN HEADER</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL SUB KEGIATAN - HANYA ROLE 3                             -->
<!-- ============================================================ -->
<div class="modal fade fixed-modal" id="ModalSubKegiatan" role="dialog">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header" style="background:#28a745; color:#fff;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="ModalSubKegiatanTitle">Tambah/Edit Sub Kegiatan</b></h4>
                <small id="DetailHeaderInfo" class="text-muted" style="color:#fff;">Pilih sub kegiatan dari nomenklatur</small>
            </div>
            <div class="modal-body">
                <input type="hidden" id="SubKegiatanId" value="0">
                <input type="hidden" id="SubKegiatanHeaderId" value="0">
                
                <!-- ============================================================ -->
                <!-- DROPDOWN SUB KEGIATAN DARI NOMENKLATUR                        -->
                <!-- ============================================================ -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>KODE SUB KEGIATAN</b> <span class="text-danger">*</span></label>
                            <select class="form-control select2-sub-kegiatan" id="KodeSubKegiatan" style="width:100%;">
                                <option value="">-- Pilih Sub Kegiatan --</option>
                            </select>
                            <small class="text-muted">Sub kegiatan akan difilter berdasarkan Bidang Urusan yang dipilih</small>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- INDIKATOR OTOMATIS                                           -->
                <!-- ============================================================ -->
                <div class="indikator-otomatis" id="IndikatorOtomatis">
                    <strong><i class="fa fa-list"></i> Indikator Sub Kegiatan:</strong>
                    <div id="IndikatorList">
                        <div class="indikator-item text-muted">Belum ada indikator untuk sub kegiatan ini</div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- FORM SUB KEGIATAN                                            -->
                <!-- ============================================================ -->
                <div class="row" style="margin-top:15px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>SUB KEGIATAN</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="SubKegiatan" rows="2" placeholder="Sub Kegiatan akan otomatis terisi" readonly style="background:#f5f5f5;"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label><b>INDIKATOR SUB KEGIATAN</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="IndikatorSubKegiatan" rows="2" placeholder="Indikator akan otomatis muncul"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>SATUAN</b></label>
                            <input type="text" class="form-control" id="Satuan" placeholder="Satuan...">
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- TARGET RAKORTEKBANG & RKPD                                    -->
                <!-- ============================================================ -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>TARGET RAKORTEKBANG</b></label>
                            <input type="text" class="form-control format-angka-target" id="TargetRAKORTEKBANG" placeholder="Contoh: 1,5 atau 100" />
                            <small class="text-muted">Gunakan koma untuk desimal (contoh: 1,5)</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>TARGET RKPD</b></label>
                            <input type="text" class="form-control format-angka-target" id="TargetRKPD" placeholder="Contoh: 2,75 atau 200" />
                            <small class="text-muted">Gunakan koma untuk desimal (contoh: 2,75)</small>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>KETERANGAN</b></label>
                            <textarea class="form-control" id="Keterangan" rows="2" placeholder="Keterangan..."></textarea>
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-success" id="BtnSimpanSubKegiatan"><b>SIMPAN SUB KEGIATAN</b></button>
                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_3 = '<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '1' : '0' ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?? '0' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var CURRENT_YEAR = '<?= date('Y') ?>';

// Cache nomenklatur
var nomenklaturCache = {};
var subKegiatanCache = {};

// ================================================================
// FORMAT ANGKA TARGET
// ================================================================

function formatAngkaTarget(value) {
    if (!value && value !== 0 && value !== '0') return '';
    var cleaned = String(value).replace(/[^0-9,.]/g, '');
    
    var parts = cleaned.split('.');
    if (parts.length > 2) {
        var last = parts.pop();
        cleaned = parts.join('') + '.' + last;
    }
    
    cleaned = cleaned.replace(/\./g, ',');
    
    var commaParts = cleaned.split(',');
    if (commaParts.length > 2) {
        cleaned = commaParts[0] + ',' + commaParts.slice(1).join('');
    }
    
    return cleaned;
}

function parseAngkaTarget(value) {
    if (!value || value === '-') return null;
    
    var clean = String(value).trim();
    clean = clean.replace(/[^0-9,.]/g, '');
    
    if (clean.indexOf(',') !== -1) {
        clean = clean.replace(',', '.');
        var dotParts = clean.split('.');
        if (dotParts.length > 2) {
            var last = dotParts.pop();
            clean = dotParts.join('') + '.' + last;
        }
    } else {
        if (clean.indexOf('.') !== -1) {
            var parts = clean.split('.');
            if (parts.length == 2) {
                if (parts[1].length <= 2) {
                    // desimal, biarkan
                } else {
                    clean = clean.replace(/\./g, '');
                }
            } else {
                clean = clean.replace(/\./g, '');
            }
        }
    }
    
    var num = parseFloat(clean);
    return isNaN(num) ? null : num;
}

function displayAngkaTarget(value) {
    if (value === null || value === undefined || value === '' || value === '-') {
        return '';
    }
    
    var num = parseFloat(value);
    if (isNaN(num)) return '';
    
    if (Number.isInteger(num)) {
        return num.toString();
    } else {
        return num.toFixed(2).replace('.', ',');
    }
}

// ================================================================
// LOADING
// ================================================================
function showLoading() {
    $('#loadingOverlay').css('display', 'flex');
}

function hideLoading() {
    $('#loadingOverlay').css('display', 'none');
}

function escapeHtml(text) {
    if (!text) return '';
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
}

// ================================================================
// TOGGLE DETAILS
// ================================================================
function toggleDetails(headerId, element) {
    var $headerRow = $('tr.header-row[data-header-id="' + headerId + '"]');
    var $detailRows = $('tr.detail-row[data-header-id="' + headerId + '"]');
    
    var isExpanded = $headerRow.data('expanded') === true;
    
    if (isExpanded) {
        $detailRows.addClass('detail-hidden');
        $headerRow.data('expanded', false);
    } else {
        $detailRows.removeClass('detail-hidden');
        $headerRow.data('expanded', true);
    }
}

// ================================================================
// GET NOMENKLATUR PROGRAM PD (UNTUK HEADER)
// ================================================================
function getNomenklaturProgramPD(level, parentKode, callback) {
    var cacheKey = 'level' + level + '_' + (parentKode || 'root');
    
    if (nomenklaturCache[cacheKey]) {
        if (callback) callback(nomenklaturCache[cacheKey]);
        return;
    }

    $.ajax({
        url: BaseURL + "Daerah/getNomenklaturProgramPD",
        type: "POST",
        data: {
            level: level,
            parent_kode: parentKode || '',
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res) {
            nomenklaturCache[cacheKey] = res;
            if (callback) callback(res);
        },
        error: function(xhr, status, error) {
            console.error('Error getNomenklaturProgramPD:', error);
            if (callback) callback([]);
        }
    });
}

// ================================================================
// GET SUB KEGIATAN (LEVEL 5)
// ================================================================
function getSubKegiatanList(parentKode, callback) {
    var cacheKey = 'sub_kegiatan_' + (parentKode || 'root');
    
    if (subKegiatanCache[cacheKey]) {
        if (callback) callback(subKegiatanCache[cacheKey]);
        return;
    }

    $.ajax({
        url: BaseURL + "Daerah/getNomenklaturSubKegiatan",
        type: "POST",
        data: {
            level: 5,
            parent_kode: parentKode || '',
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res) {
            var filtered = [];
            if (res && res.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    var dotCount = (res[i].Kode.match(/\./g) || []).length;
                    if (dotCount === 5) {
                        filtered.push(res[i]);
                    }
                }
            }
            subKegiatanCache[cacheKey] = filtered;
            if (callback) callback(filtered);
        },
        error: function(xhr, status, error) {
            console.error('Error getSubKegiatanList:', error);
            if (callback) callback([]);
        }
    });
}

// ================================================================
// LOAD SUB KEGIATAN DROPDOWN
// ================================================================
function loadSubKegiatanDropdown(selectedKode, parentKode) {
    if (!parentKode) {
        parentKode = $('#header_select_bidang_urusan').val() || '';
    }
    
    if (!parentKode) {
        $('#KodeSubKegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>');
        $('#KodeSubKegiatan').prop('disabled', true);
        $('#KodeSubKegiatan').trigger('change.select2');
        return;
    }
    
    getSubKegiatanList(parentKode, function(data) {
        var options = '<option value="">-- Pilih Sub Kegiatan --</option>';
        if (data && data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                var selected = (data[i].Kode === selectedKode) ? 'selected' : '';
                options += '<option value="' + data[i].Kode + '" ' + selected + '>' + 
                           data[i].Kode + ' - ' + data[i].Nomenklatur + '</option>';
            }
        } else {
            options += '<option value="" disabled>Tidak ada Sub Kegiatan untuk bidang ini</option>';
        }
        $('#KodeSubKegiatan').html(options);
        $('#KodeSubKegiatan').prop('disabled', false);
        $('#KodeSubKegiatan').trigger('change.select2');
    });
}

// ================================================================
// GET INDIKATOR BY SUB KEGIATAN
// ================================================================
function getIndikatorBySubKegiatan(kodeSubKegiatan, callback) {
    $.ajax({
        url: BaseURL + "Daerah/GetSubKegiatanByKode",
        type: "POST",
        data: {
            kode_sub_kegiatan: kodeSubKegiatan,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res) {
            if (callback) callback(res);
        },
        error: function(xhr, status, error) {
            console.error('Error getIndikatorBySubKegiatan:', error);
            if (callback) callback({status: 'error', data: null});
        }
    });
}

// ================================================================
// LOAD LEVEL UNTUK HEADER
// ================================================================
function loadLevel(level, parentKode, callback) {
    var selectId = '';
    var label = '';
    
    if (level == 1) {
        selectId = 'header_select_urusan';
        label = 'Urusan';
        $('#header_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    } else if (level == 2) {
        selectId = 'header_select_bidang_urusan';
        label = 'Bidang Urusan';
        $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    } else if (level == 3) {
        selectId = 'header_select_program';
        label = 'Program';
    }
    
    if (!parentKode && level > 1) {
        $('#' + selectId).html('<option value="">-- Pilih ' + label + ' --</option>').prop('disabled', true);
        updatePathDisplay();
        if (callback) callback();
        return;
    }
    
    var actualParent = (level == 1) ? '' : parentKode;
    
    getNomenklaturProgramPD(level, actualParent, function(res) {
        var options = '<option value="">-- Pilih ' + label + ' --</option>';
        var hasItems = false;
        
        if (res && res.length > 0) {
            var expectedDots = level - 1;
            for (var i = 0; i < res.length; i++) {
                var dotCount = (res[i].Kode.match(/\./g) || []).length;
                if (dotCount == expectedDots) {
                    options += '<option value="' + res[i].Kode + '">' + 
                               res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                    hasItems = true;
                }
            }
        }
        
        if (!hasItems) {
            options += '<option value="" disabled>-- Tidak ada data --</option>';
        }
        
        $('#' + selectId).html(options).prop('disabled', false);
        updatePathDisplay();
        if (callback) callback();
    });
}

// ================================================================
// UPDATE PATH DISPLAY HEADER
// ================================================================
function updatePathDisplay() {
    var urusanKode = $('#header_select_urusan').val() || '';
    var urusanText = $('#header_select_urusan option:selected').text() || '';
    var bidangKode = $('#header_select_bidang_urusan').val() || '';
    var bidangText = $('#header_select_bidang_urusan option:selected').text() || '';
    var programKode = $('#header_select_program').val() || '';
    var programText = $('#header_select_program option:selected').text() || '';
    
    if (urusanKode) {
        $('#manual_kode_urusan').val(urusanKode);
        var urusanName = urusanText.replace(urusanKode + ' - ', '');
        $('#manual_urusan').val(urusanName || urusanText);
    }
    
    if (bidangKode) {
        $('#manual_kode_bidang').val(bidangKode);
        var bidangName = bidangText.replace(bidangKode + ' - ', '');
        $('#manual_bidang_urusan').val(bidangName || bidangText);
        $('#preview_kode_bidang').text(bidangKode);
        $('#preview_bidang_urusan').text(bidangName || bidangText);
    } else {
        $('#preview_kode_bidang').text('-');
        $('#preview_bidang_urusan').text('-');
    }
    
    if (programKode) {
        $('#manual_kode_program').val(programKode);
        var programName = programText.replace(programKode + ' - ', '');
        $('#manual_program').val(programName || programText);
        $('#preview_kode_program').text(programKode);
        $('#preview_program').text(programName || programText);
    } else {
        $('#preview_kode_program').text('-');
        $('#preview_program').text('-');
    }
    
    var path = [];
    if (urusanText) path.push(urusanText);
    if (bidangText) path.push(bidangText);
    if (programText) path.push(programText);
    
    if (path.length > 0) {
        $('#path_display_header').html(path.join(' → '));
        $('#info_nomenklatur_header').show();
        $('#selected_nomenklatur_header').html(
            (urusanKode ? '<br><strong>URUSAN:</strong> ' + (urusanText.replace(urusanKode + ' - ', '') || urusanText) : '') +
            (bidangKode ? '<br><strong>KODE BIDANG:</strong> ' + bidangKode + ' | <strong>BIDANG URUSAN:</strong> ' + (bidangText.replace(bidangKode + ' - ', '') || bidangText) : '') +
            (programKode ? '<br><strong>KODE PROGRAM:</strong> ' + programKode + ' | <strong>PROGRAM:</strong> ' + (programText.replace(programKode + ' - ', '') || programText) : '')
        );
    } else {
        $('#path_display_header').html('Belum ada yang dipilih');
        $('#info_nomenklatur_header').hide();
    }
}

// ================================================================
// EVENT FORMAT ANGKA TARGET
// ================================================================
$(document).on('input', '.format-angka-target', function() {
    var value = $(this).val();
    var cursorPos = this.selectionStart;
    
    value = value.replace(/[^0-9,.]/g, '');
    
    var parts = value.split('.');
    if (parts.length > 2) {
        var last = parts.pop();
        value = parts.join('') + '.' + last;
    }
    
    value = value.replace(/\./g, ',');
    
    var commaParts = value.split(',');
    if (commaParts.length > 2) {
        value = commaParts[0] + ',' + commaParts.slice(1).join('');
    }
    
    $(this).val(value);
    
    var newPos = Math.min(cursorPos, value.length);
    this.setSelectionRange(newPos, newPos);
});

// ================================================================
// FILTER - LANGSUNG REFRESH TANPA POPUP
// ================================================================
$(document).ready(function() {
    
    // ================================================================
    // LOAD KAB/KOTA SAAT PROVINSI BERUBAH
    // ================================================================
    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
            },
            success: function(Data) {
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                var firstKode = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (i === 0 && Data.length === 1) ? 'selected' : '';
                        KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                    }
                    if (Data.length === 1) {
                        firstKode = Data[0].Kode;
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
                
                if (firstKode) {
                    $("#Filter").click();
                }
            },
            error: function() { 
                $("#KabKota").prop('disabled', false).html('<option value="">Pilih Kab/Kota</option>');
            }
        });
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
            $("#KabKota").val(kodeKab);
        }, 300);
    <?php } ?>

    // ================================================================
    // FILTER - LANGSUNG REFRESH TANPA POPUP
    // ================================================================
    $("#Filter").off('click').on('click', function(e) {
        e.preventDefault();
        
        var provinsi = $("#Provinsi").val();
        var kabKota = $("#KabKota").val();
        
        // Auto-select provinsi pertama jika kosong
        if (!provinsi || provinsi === "") {
            var firstProv = $("#Provinsi option:eq(1)").val();
            if (firstProv) {
                $("#Provinsi").val(firstProv);
                provinsi = firstProv;
            } else {
                window.location.href = window.location.pathname;
                return;
            }
        }
        
        // Auto-select kab/kota pertama jika kosong
        if (!kabKota || kabKota === "") {
            var firstKab = $("#KabKota option:eq(1)").val();
            if (firstKab) {
                $("#KabKota").val(firstKab);
                kabKota = firstKab;
            } else {
                kabKota = provinsi;
                $("#KabKota").val(kabKota);
            }
        }
        
        // Tampilkan loading di tombol
        $("#Filter").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');
        
        // Simpan ke session via AJAX
        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { 
                KodeWilayah: kabKota,
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: 'json',
            success: function(res) {
                // Refresh halaman
                window.location.href = window.location.pathname;
            },
            error: function() {
                // Refresh meskipun error
                window.location.href = window.location.pathname;
            }
        });
    });
    
    // ================================================================
    // INIT NOMENKLATUR
    // ================================================================
    <?php if (!empty($KodeWilayah)) { ?>
        loadLevel(1, '');
        
        $('#header_select_urusan').change(function() {
            var kode = $(this).val();
            if (kode && kode !== '') {
                loadLevel(2, kode);
            } else {
                $('#header_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
                $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
                updatePathDisplay();
            }
        });
        
        $('#header_select_bidang_urusan').change(function() {
            var kode = $(this).val();
            if (kode && kode !== '') {
                loadLevel(3, kode);
            } else {
                $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
                updatePathDisplay();
            }
        });
        
        $('#header_select_program').change(function() {
            updatePathDisplay();
        });
    <?php } ?>
});

// ================================================================
// TOMBOL TAMBAH HEADER - HANYA ROLE 3
// ================================================================
if (IS_ROLE_3 == '1') {
    $(document).off('click', '#BtnTambahHeader').on('click', '#BtnTambahHeader', function(e) {
        e.preventDefault();
        
        $('#HeaderId').val(0);
        $('#IsEditMode').val(0);
        $('#ModalHeaderTitle').text('Tambah Header RAKORTEKBANG');
        
        $('#AstaCita, #OutcomePrioritas').val('');
        $('#TahunHeader').val(CURRENT_YEAR);
        
        $('#header_select_urusan').html('<option value="">-- Pilih Urusan --</option>').prop('disabled', false);
        $('#header_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        
        $('#preview_kode_bidang, #preview_bidang_urusan, #preview_kode_program, #preview_program').text('-');
        $('#path_display_header').html('Belum ada yang dipilih');
        $('#info_nomenklatur_header').hide();
        
        $('#manual_kode_urusan, #manual_kode_bidang, #manual_kode_program').val('');
        $('#manual_urusan, #manual_bidang_urusan, #manual_program').val('');
        
        nomenklaturCache = {};
        loadLevel(1, '');
        
        $('#headerTab a[href="#tab_nomenklatur"]').tab('show');
        
        $('#ModalHeader').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    // ================================================================
    // SIMPAN HEADER - HANYA ROLE 3
    // ================================================================
    $(document).off('click', '#BtnSimpanHeader').on('click', '#BtnSimpanHeader', function(e) {
        e.preventDefault();
        
        var id = parseInt($('#HeaderId').val()) || 0;
        var isEdit = (id > 0);
        
        var kodeBidang = $('#preview_kode_bidang').text();
        var bidangUrusan = $('#preview_bidang_urusan').text();
        var kodeProgram = $('#preview_kode_program').text();
        var program = $('#preview_program').text();
        
        if (kodeBidang === '-' || !kodeBidang || kodeBidang === '') {
            kodeBidang = $('#manual_kode_bidang').val().trim();
            bidangUrusan = $('#manual_bidang_urusan').val().trim();
        }
        if (kodeProgram === '-' || !kodeProgram || kodeProgram === '') {
            kodeProgram = $('#manual_kode_program').val().trim();
            program = $('#manual_program').val().trim();
        }
        
        if (!bidangUrusan) {
            alert('Bidang Urusan harus diisi!');
            $('#manual_bidang_urusan').focus();
            return;
        }
        if (!program) {
            alert('Program harus diisi!');
            $('#manual_program').focus();
            return;
        }
        
        showLoading();
        
        var data = {
            id: id,
            kode_bidang: kodeBidang,
            bidang_urusan: bidangUrusan,
            asta_cita: $('#AstaCita').val().trim(),
            outcome_prioritas: $('#OutcomePrioritas').val().trim(),
            kode_program: kodeProgram,
            program: program,
            tahun: $('#TahunHeader').val(),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = isEdit ? BaseURL + "Daerah/EditKeselarasanHeader" : BaseURL + "Daerah/InputKeselarasanHeader";
        
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    $('#HeaderId').val(0);
                    $('#IsEditMode').val(0);
                    location.reload();
                } else {
                    alert(res.message || "Gagal menyimpan header");
                }
            },
            error: function() {
                hideLoading();
                alert("Terjadi kesalahan saat menyimpan header");
            }
        });
    });

    // ================================================================
    // EVENT CHANGE BIDANG URUSAN - LOAD SUB KEGIATAN
    // ================================================================
    $(document).on('change', '#header_select_bidang_urusan', function() {
        var kode = $(this).val();
        
        $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        
        $('#preview_kode_bidang').text(kode || '-');
        var bidangText = $(this).find('option:selected').text() || '';
        var bidangName = bidangText.replace(kode + ' - ', '');
        $('#preview_bidang_urusan').text(bidangName || bidangText);
        
        if (kode && kode !== '') {
            loadLevel(3, kode);
            
            if ($('#ModalSubKegiatan').hasClass('in')) {
                loadSubKegiatanDropdown('', kode);
            }
        } else {
            $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#KodeSubKegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
            $('#IndikatorOtomatis').hide();
            $('#SubKegiatan, #IndikatorSubKegiatan').val('');
        }
        
        updatePathDisplay();
    });

    // ================================================================
    // EVENT CHANGE PROGRAM
    // ================================================================
    $(document).on('change', '#header_select_program', function() {
        var kode = $(this).val();
        var text = $(this).find('option:selected').text() || '';
        
        $('#preview_kode_program').text(kode || '-');
        var programName = text.replace(kode + ' - ', '');
        $('#preview_program').text(programName || text);
        
        if (kode) {
            $('#manual_kode_program').val(kode);
            $('#manual_program').val(programName || text);
        }
        
        updatePathDisplay();
    });

    // ================================================================
    // TOMBOL TAMBAH SUB KEGIATAN
    // ================================================================
    $(document).off('click', '.btn-add-sub-kegiatan').on('click', '.btn-add-sub-kegiatan', function(e) {
        e.preventDefault();
        var headerId = $(this).data('header-id');
        
        $('#SubKegiatanId').val(0);
        $('#SubKegiatanHeaderId').val(headerId);
        $('#ModalSubKegiatanTitle').text('Tambah Sub Kegiatan');
        $('#DetailHeaderInfo').text('Header ID: ' + headerId);
        
        $('#KodeSubKegiatan, #SubKegiatan, #IndikatorSubKegiatan, #Satuan, #TargetRAKORTEKBANG, #TargetRKPD, #Keterangan').val('');
        $('#IndikatorOtomatis').hide();
        
        var $headerRow = $('tr.header-row[data-header-id="' + headerId + '"]');
        var kodeBidang = String($headerRow.data('kode-bidang') || '');
        
        if (!kodeBidang || kodeBidang === '-' || kodeBidang === '') {
            var $firstTd = $headerRow.find('td:nth-child(2)');
            if ($firstTd.length) {
                kodeBidang = String($firstTd.text().trim());
            }
        }
        
        if (kodeBidang && kodeBidang !== '-' && kodeBidang !== '') {
            loadSubKegiatanDropdown('', kodeBidang);
        } else {
            $('#KodeSubKegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', false);
            $('#KodeSubKegiatan').append('<option value="manual">-- Input Manual --</option>');
        }
        
        $('#ModalSubKegiatan').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    // ================================================================
    // EVENT CHANGE SUB KEGIATAN - LOAD INDIKATOR OTOMATIS
    // ================================================================
    $(document).on('change', '#KodeSubKegiatan', function() {
        var kode = $(this).val();
        var text = $(this).find('option:selected').text() || '';
        var subKegiatan = text.replace(kode + ' - ', '');
        
        if (kode === 'manual') {
            $('#SubKegiatan').val('');
            $('#IndikatorOtomatis').hide();
            $('#IndikatorSubKegiatan').val('');
            return;
        }
        
        $('#SubKegiatan').val(subKegiatan);
        
        if (kode && kode !== '' && kode !== 'manual') {
            getIndikatorBySubKegiatan(kode, function(res) {
                if (res.status === 'success' && res.data) {
                    var indikatorList = res.data.indikator || [];
                    var indikatorHtml = '';
                    
                    if (indikatorList.length > 0) {
                        for (var i = 0; i < indikatorList.length; i++) {
                            var item = indikatorList[i];
                            indikatorHtml += '<div class="indikator-item">' +
                                '<span class="badge-indikator">#' + (i+1) + '</span>' +
                                '<strong>' + escapeHtml(item.indikator || '') + '</strong>' +
                                (item.satuan ? ' <span class="text-muted">(' + escapeHtml(item.satuan) + ')</span>' : '') +
                                '</div>';
                        }
                        $('#IndikatorList').html(indikatorHtml);
                        $('#IndikatorOtomatis').show();
                        
                        if (indikatorList.length > 0) {
                            $('#IndikatorSubKegiatan').val(indikatorList[0].indikator || '');
                            if (indikatorList[0].satuan) {
                                $('#Satuan').val(indikatorList[0].satuan);
                            }
                        }
                    } else {
                        $('#IndikatorList').html('<div class="indikator-item text-muted">Belum ada indikator untuk sub kegiatan ini</div>');
                        $('#IndikatorOtomatis').show();
                        $('#IndikatorSubKegiatan').val('');
                    }
                } else {
                    $('#IndikatorList').html('<div class="indikator-item text-muted">Belum ada indikator untuk sub kegiatan ini</div>');
                    $('#IndikatorOtomatis').show();
                }
            });
        } else {
            $('#IndikatorOtomatis').hide();
            $('#IndikatorSubKegiatan').val('');
            $('#SubKegiatan').val('');
        }
    });

    // ================================================================
    // TOMBOL EDIT SUB KEGIATAN
    // ================================================================
    $(document).off('click', '.BtnEditSubKegiatan').on('click', '.BtnEditSubKegiatan', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var headerId = $(this).data('header-id') || 0;
        
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        showLoading();
        $('#SubKegiatanHeaderId').val(headerId);
        $('#ModalSubKegiatanTitle').text('Edit Sub Kegiatan');
        
        var $headerRow = $('tr.header-row[data-header-id="' + headerId + '"]');
        var kodeBidang = String($headerRow.data('kode-bidang') || '');
        
        if (!kodeBidang || kodeBidang === '-') {
            var $secondTd = $headerRow.find('td:nth-child(2)');
            if ($secondTd.length) {
                kodeBidang = String($secondTd.text().trim());
            }
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetKeselarasanDetail",
            type: "POST",
            data: {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success" && res.data) {
                    var d = res.data;
                    $('#SubKegiatanId').val(d.id);
                    
                    if (kodeBidang && kodeBidang !== '-' && kodeBidang !== '') {
                        loadSubKegiatanDropdown(d.kode_sub_kegiatan || '', kodeBidang);
                    } else {
                        loadSubKegiatanDropdown(d.kode_sub_kegiatan || '', '');
                    }
                    
                    $('#SubKegiatan').val(d.sub_kegiatan || '');
                    $('#IndikatorSubKegiatan').val(d.indikator_sub_kegiatan || '');
                    $('#Satuan').val(d.satuan || '');
                    
                    $('#TargetRAKORTEKBANG').val(displayAngkaTarget(d.target_rakortekbang));
                    $('#TargetRKPD').val(displayAngkaTarget(d.target_rkpd));
                    
                    $('#Keterangan').val(d.keterangan || '');
                    
                    if (d.kode_sub_kegiatan) {
                        setTimeout(function() {
                            $('#KodeSubKegiatan').val(d.kode_sub_kegiatan).trigger('change');
                        }, 500);
                    }
                    
                    $('#ModalSubKegiatan').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).css('display', 'block').addClass('in');
                    $('body').addClass('modal-open');
                } else {
                    alert(res.message || 'Gagal memuat data sub kegiatan');
                }
            },
            error: function() {
                hideLoading();
                alert("Terjadi kesalahan saat memuat data");
            }
        });
    });

    // ================================================================
    // TOMBOL HAPUS SUB KEGIATAN
    // ================================================================
    $(document).off('click', '.BtnHapusSubKegiatan').on('click', '.BtnHapusSubKegiatan', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        if (!confirm("Yakin hapus sub kegiatan ini?")) return;
        
        showLoading();
        
        $.ajax({
            url: BaseURL + "Daerah/HapusKeselarasanDetail",
            type: "POST",
            data: {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal hapus!");
                }
            },
            error: function() {
                hideLoading();
                alert("Terjadi kesalahan saat menghapus data");
            }
        });
    });

    // ================================================================
    // SIMPAN SUB KEGIATAN
    // ================================================================
    $(document).off('click', '#BtnSimpanSubKegiatan').on('click', '#BtnSimpanSubKegiatan', function(e) {
        e.preventDefault();
        
        var kodeSubKegiatan = $('#KodeSubKegiatan').val();
        var subKegiatan = $('#SubKegiatan').val().trim();
        var indikator = $('#IndikatorSubKegiatan').val().trim();
        
        if (kodeSubKegiatan === 'manual') {
            subKegiatan = $('#SubKegiatan').val().trim() || prompt('Masukkan Sub Kegiatan:');
            if (!subKegiatan) {
                alert('Sub Kegiatan harus diisi!');
                return;
            }
            kodeSubKegiatan = '';
        }
        
        if (!kodeSubKegiatan && !subKegiatan) {
            alert('Kode Sub Kegiatan atau Sub Kegiatan harus diisi!');
            $('#KodeSubKegiatan').focus();
            return;
        }
        
        if (!subKegiatan) {
            alert('Sub Kegiatan harus diisi!');
            $('#SubKegiatan').focus();
            return;
        }
        
        if (!indikator) {
            alert('Indikator Sub Kegiatan harus diisi!');
            $('#IndikatorSubKegiatan').focus();
            return;
        }
        
        showLoading();
        
        var targetRakortekbangRaw = $('#TargetRAKORTEKBANG').val();
        var targetRkpdRaw = $('#TargetRKPD').val();
        
        var targetRakortekbang = parseAngkaTarget(targetRakortekbangRaw);
        var targetRkpd = parseAngkaTarget(targetRkpdRaw);
        
        var data = {
            id: $('#SubKegiatanId').val(),
            header_id: $('#SubKegiatanHeaderId').val(),
            kode_sub_kegiatan: kodeSubKegiatan,
            sub_kegiatan: subKegiatan,
            indikator_sub_kegiatan: indikator,
            satuan: $('#Satuan').val().trim(),
            target_rakortekbang: targetRakortekbang,
            target_rkpd: targetRkpd,
            keterangan: $('#Keterangan').val().trim(),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = BaseURL + "Daerah/InputKeselarasanDetail";
        if (parseInt($('#SubKegiatanId').val()) > 0) {
            url = BaseURL + "Daerah/EditKeselarasanDetail";
        }
        
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal menyimpan sub kegiatan");
                }
            },
            error: function(xhr, status, error) {
                hideLoading();
                console.error('Error:', xhr.responseText);
                alert("Terjadi kesalahan saat menyimpan sub kegiatan: " + error);
            }
        });
    });
}

// ================================================================
// TOMBOL EDIT HEADER - HANYA ROLE 3
// ================================================================
if (IS_ROLE_3 == '1') {
    $(document).on('click', '.BtnEditHeader', function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var kodeBidang = String($(this).data('kode-bidang') || '');
        var bidangUrusan = String($(this).data('bidang-urusan') || '');
        var astaCita = String($(this).data('asta-cita') || '');
        var outcomePrioritas = String($(this).data('outcome-prioritas') || '');
        var kodeProgram = String($(this).data('kode-program') || '');
        var program = String($(this).data('program') || '');
        var tahun = $(this).data('tahun') || CURRENT_YEAR;
        
        $('#HeaderId').val(id);
        $('#IsEditMode').val(1);
        $('#ModalHeaderTitle').text('Edit Header RAKORTEKBANG');
        
        $('#preview_kode_bidang').text(kodeBidang || '-');
        $('#preview_bidang_urusan').text(bidangUrusan || '-');
        $('#preview_kode_program').text(kodeProgram || '-');
        $('#preview_program').text(program || '-');
        
        $('#manual_kode_bidang').val(kodeBidang || '');
        $('#manual_bidang_urusan').val(bidangUrusan || '');
        $('#manual_kode_program').val(kodeProgram || '');
        $('#manual_program').val(program || '');
        
        $('#AstaCita').val(astaCita || '');
        $('#OutcomePrioritas').val(outcomePrioritas || '');
        $('#TahunHeader').val(tahun || CURRENT_YEAR);
        
        var pathText = '';
        if (bidangUrusan) pathText += bidangUrusan;
        if (program) pathText += (pathText ? ' → ' : '') + program;
        $('#path_display_header').html(pathText || 'Belum ada yang dipilih');
        
        if (pathText) {
            $('#info_nomenklatur_header').show();
            $('#selected_nomenklatur_header').html(
                (kodeBidang ? '<br><strong>KODE BIDANG:</strong> ' + kodeBidang + ' | <strong>BIDANG URUSAN:</strong> ' + bidangUrusan : '') +
                (kodeProgram ? '<br><strong>KODE PROGRAM:</strong> ' + kodeProgram + ' | <strong>PROGRAM:</strong> ' + program : '')
            );
        } else {
            $('#info_nomenklatur_header').hide();
        }
        
        $('#header_select_urusan').html('<option value="">-- Pilih Urusan --</option>').prop('disabled', false);
        $('#header_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        
        if (kodeBidang && kodeBidang !== '-' && kodeBidang !== '') {
            var urusanKode = kodeBidang.split('.')[0] || '';
            
            if (urusanKode) {
                loadLevel(1, '', function() {
                    $('#header_select_urusan').val(urusanKode).trigger('change');
                    
                    setTimeout(function() {
                        loadLevel(2, urusanKode, function() {
                            $('#header_select_bidang_urusan').val(kodeBidang).trigger('change');
                            
                            if (kodeProgram && kodeProgram !== '-' && kodeProgram !== '') {
                                setTimeout(function() {
                                    loadLevel(3, kodeBidang, function() {
                                        $('#header_select_program').val(kodeProgram).trigger('change');
                                    });
                                }, 300);
                            }
                        });
                    }, 300);
                });
            }
        }
        
        $('#ModalHeader').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    // ================================================================
    // TOMBOL HAPUS HEADER - HANYA ROLE 3
    // ================================================================
    $(document).on('click', '.BtnHapusHeader', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        if (!confirm("Yakin hapus header ini? Semua sub kegiatan terkait juga akan dihapus.")) return;
        
        showLoading();
        
        $.ajax({
            url: BaseURL + "Daerah/HapusKeselarasanHeader",
            type: "POST",
            data: {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal hapus header!");
                }
            },
            error: function() {
                hideLoading();
                alert("Terjadi kesalahan saat menghapus data");
            }
        });
    });
}

// ================================================================
// MODAL CLOSE HANDLER
// ================================================================
$('.modal').on('hidden.bs.modal', function() {
    $('body').removeClass('modal-open');
    $(this).removeClass('in').css('display', 'none');
});

// ================================================================
// SELECT2 INITIALIZATION
// ================================================================
$(document).ready(function() {
    $('#KodeSubKegiatan').select2({
        placeholder: 'Cari Sub Kegiatan...',
        allowClear: true,
        dropdownParent: $('#ModalSubKegiatan .modal-body')
    });

    if ($('#data-table-basic').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-basic')) {
                $('#data-table-basic').DataTable().destroy();
            }
            
            $('#data-table-basic').DataTable({
                "pageLength": 10,
                "ordering": false,
                "stateSave": false,
                "scrollX": true,
                "scrollY": "400px",
                "scrollCollapse": true,
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
                },
                "drawCallback": function(settings) {
                    $('.btn-add-sub-kegiatan, .BtnEditHeader, .BtnHapusHeader, .BtnEditSubKegiatan, .BtnHapusSubKegiatan').css({
                        'cursor': 'pointer',
                        'pointer-events': 'auto'
                    });
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }
    
    // ================================================================
    // INISIALISASI FORMAT ANGKA PADA FIELD TARGET
    // ================================================================
    $('.format-angka-target').each(function() {
        var val = $(this).val();
        if (val && val !== '-') {
            var num = parseFloat(val.replace(/\./g, '').replace(',', '.'));
            if (!isNaN(num)) {
                if (Number.isInteger(num)) {
                    $(this).val(num.toString());
                } else {
                    $(this).val(num.toFixed(2).replace('.', ','));
                }
            }
        }
    });
});
</script>

</body>
</html>