<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Keselarasan Intervensi Pembangunan Kewilayahan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('Daerah/Cssumum'); ?>
    
    <!-- Tambahkan Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        /* ============================================================ */
        /* STYLE DASAR TABEL */
        /* ============================================================ */
        .table-intervensi th, .table-intervensi td {
            vertical-align: middle;
            text-align: center;
            border: 1px solid #dee2e6;
            padding: 6px 4px;
            font-size: 11px;
        }
        .table-intervensi .text-left { text-align: left !important; }
        .table-intervensi .text-wrap { white-space: normal; word-wrap: break-word; max-width: 150px; }
        
        /* Header Tabel */
        .header-lokasi {
            background-color: #007bff !important;
            color: #fff !important;
            text-align: center !important;
            font-weight: bold;
            font-size: 12px;
        }
        .header-highlight {
            background-color: #28a745 !important;
            color: #fff !important;
            text-align: center !important;
            font-weight: bold;
            font-size: 12px;
        }
        .header-dukungan {
            background-color: #17a2b8 !important;
            color: #fff !important;
            text-align: center !important;
            font-weight: bold;
            font-size: 12px;
        }
        
        /* Badge kode nomenklatur */
        .badge-kode {
            color: #fff;
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 8px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 2px;
            font-family: monospace;
        }
        .badge-kode.badge-sub { background: #17a2b8; }
        .badge-kode.badge-keg { background: #6c757d; }
        .badge-kode.badge-prog { background: #28a745; }
        
        /* ============================================================ */
        /* MODAL LIST WILAYAH - TOMBOL HAPUS DI SEBELAH KANAN */
        /* ============================================================ */
        .selected-wilayah-list .list-group {
            margin-bottom: 0;
        }
        .selected-wilayah-list .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            font-size: 13px;
            border-bottom: 1px solid #e9ecef;
            gap: 10px;
            background: #fff;
        }
        .selected-wilayah-list .list-group-item:last-child {
            border-bottom: none;
        }
        .selected-wilayah-list .list-group-item .wilayah-info {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }
        .selected-wilayah-list .list-group-item .badge-level {
            background: #17a2b8;
            color: #fff;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: 600;
            flex-shrink: 0;
        }
        .selected-wilayah-list .list-group-item .wilayah-nama {
            font-weight: 500;
            color: #212529;
        }
        .selected-wilayah-list .list-group-item .wilayah-nama[title] {
            cursor: help;
            border-bottom: 1px dashed #dee2e6;
        }
        .selected-wilayah-list .list-group-item .btn-hapus-wilayah-modal {
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 3px 12px;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            min-height: 28px;
        }
        .selected-wilayah-list .list-group-item .btn-hapus-wilayah-modal:hover {
            background: #c82333;
            transform: scale(1.03);
        }
        .selected-wilayah-list .list-group-item .btn-hapus-wilayah-modal i {
            font-size: 11px;
        }
        
        /* ============================================================ */
        /* TOMBOL AKSI - DI ATAS TEKS */
        /* ============================================================ */
        
        .btn-aksi-group {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 3px;
            align-items: center;
            justify-content: center;
            padding: 3px 4px;
            border-radius: 3px;
            min-height: 28px;
        }
        
        .btn-aksi-group.btn-aksi-atas {
            margin-top: 0 !important;
            margin-bottom: 4px !important;
        }
        
        .btn-aksi-group .btn-aksi {
            padding: 2px 6px;
            font-size: 9px;
            border-radius: 3px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 2px;
            line-height: 1.3;
            min-height: 22px;
            min-width: 28px;
            white-space: nowrap;
        }
        .btn-aksi-group .btn-aksi i {
            font-size: 11px;
        }
        .btn-aksi-group .btn-aksi .btn-label {
            font-size: 7px;
        }
        .btn-aksi-group .btn-aksi:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .btn-aksi-group .btn-aksi:active {
            transform: translateY(0px);
        }
        
        /* Variasi Tombol */
        .btn-edit {
            background: #ffc107;
            color: #212529;
            border: 1px solid #ffc107;
        }
        .btn-edit:hover {
            background: #e0a800;
            color: #212529;
            border-color: #e0a800;
        }
        
        .btn-delete {
            background: #dc3545;
            color: #fff;
            border: 1px solid #dc3545;
        }
        .btn-delete:hover {
            background: #c82333;
            color: #fff;
            border-color: #c82333;
        }
        
        .btn-add {
            background: #28a745;
            color: #fff;
            border: 1px solid #28a745;
        }
        .btn-add:hover {
            background: #218838;
            color: #fff;
            border-color: #218838;
        }
        
        .btn-add-highlight {
            background: #17a2b8;
            color: #fff;
            border: 1px solid #17a2b8;
        }
        .btn-add-highlight:hover {
            background: #138496;
            color: #fff;
            border-color: #138496;
        }
        
        .btn-add-dukungan {
            background: #0d6efd;
            color: #fff;
            border: 1px solid #0d6efd;
        }
        .btn-add-dukungan:hover {
            background: #0b5ed7;
            color: #fff;
            border-color: #0b5ed7;
        }
        
        /* Background per level */
        .btn-aksi-lokasi {
            background: #e7f3ff;
            border: 1px solid #b8d4f0;
            border-radius: 4px;
        }
        .btn-aksi-highlight {
            background: #e8f5e9;
            border: 1px solid #a5d6a7;
            border-radius: 4px;
        }
        .btn-aksi-dukungan {
            background: #e0f7fa;
            border: 1px solid #80deea;
            border-radius: 4px;
        }
        
        /* ============================================================ */
        /* STYLE LAINNYA */
        /* ============================================================ */
        .filter-section {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
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
        
        .cascading-select { margin-bottom: 12px; }
        .cascading-select select { height: 38px; font-size: 13px; }
        .cascading-select label { font-weight: 600; font-size: 12px; color: #495057; margin-bottom: 3px; }
        
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
        
        .empty-state {
            text-align: center;
            padding: 40px 0;
            color: #6c757d;
        }
        .empty-state i {
            font-size: 48px;
            display: block;
            color: #dee2e6;
            margin-bottom: 15px;
        }
        
        .text-nomenklatur { font-weight: 500; font-size: 10px; }
        .wilayah-text { font-size: 10px; color: #6c757d; display: block; margin-top: 2px; }
        
        .wilayah-row {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            border: 1px solid #dee2e6;
        }
        .wilayah-row select { font-size: 12px; height: 34px; }
        
        .label-wilayah {
            font-weight: 600;
            font-size: 12px;
            color: #495057;
            margin-bottom: 3px;
            display: block;
        }
        
        .legend-buttons {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px 12px;
            align-items: center;
        }
        .legend-buttons .legend-item {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 10px;
            color: #495057;
        }
        .legend-buttons .legend-item .color-box {
            width: 14px;
            height: 14px;
            border-radius: 3px;
            border: 1px solid #ced4da;
        }
        
        /* Kolom LOKASI dengan aksi di dalamnya */
        .td-lokasi {
            min-width: 200px;
            vertical-align: middle;
        }
        .td-lokasi .lokasi-wrapper {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 4px;
        }
        .td-lokasi .lokasi-wrapper .lokasi-list-wrapper {
            text-align: left;
        }
        .td-lokasi .lokasi-wrapper .aksi-dukungan-wrapper {
            border-top: 1px dashed #dee2e6;
            padding-top: 4px;
            margin-top: 2px;
        }
        
        /* ============================================================ */
        /* RESPONSIVE */
        /* ============================================================ */
        @media (max-width: 992px) {
            .table-intervensi { font-size: 10px; }
            .table-intervensi th, .table-intervensi td { padding: 4px 3px; }
            
            .btn-aksi-group .btn-aksi {
                font-size: 8px;
                padding: 1px 4px;
                min-height: 18px;
                min-width: 24px;
            }
            .btn-aksi-group .btn-aksi i {
                font-size: 9px;
            }
            .btn-aksi-group .btn-aksi .btn-label {
                font-size: 6px;
            }
            .td-lokasi {
                min-width: 150px;
            }
            .selected-wilayah-list .list-group-item {
                font-size: 11px;
                padding: 6px 10px;
            }
            .selected-wilayah-list .list-group-item .btn-hapus-wilayah-modal {
                font-size: 9px;
                padding: 2px 8px;
                min-height: 24px;
            }
        }
        
        @media (max-width: 768px) {
            .table-intervensi { font-size: 9px; }
            .table-intervensi th, .table-intervensi td { padding: 3px 2px; }
            .modal.fixed-modal .modal-dialog { margin: 10px; }
            
            .btn-aksi-group {
                flex-wrap: wrap;
                gap: 2px;
                padding: 2px;
            }
            .btn-aksi-group .btn-aksi {
                font-size: 7px;
                padding: 1px 3px;
                min-height: 16px;
                min-width: 20px;
                flex: 1 1 30%;
            }
            .btn-aksi-group .btn-aksi i {
                font-size: 8px;
            }
            .btn-aksi-group .btn-aksi .btn-label {
                font-size: 5px;
            }
            .td-lokasi {
                min-width: 120px;
            }
            .selected-wilayah-list .list-group-item {
                font-size: 10px;
                padding: 5px 8px;
                flex-wrap: wrap;
                gap: 5px;
            }
            .selected-wilayah-list .list-group-item .wilayah-info {
                flex-wrap: wrap;
                gap: 4px;
            }
            .selected-wilayah-list .list-group-item .btn-hapus-wilayah-modal {
                font-size: 8px;
                padding: 2px 6px;
                min-height: 20px;
            }
            .selected-wilayah-list .list-group-item .btn-hapus-wilayah-modal i {
                font-size: 8px;
            }
        }
    </style>
</head>
<body>

<?php $this->load->view('Daerah/sidebar'); ?>

<!-- LOADING OVERLAY -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner">
        <i class="fa fa-refresh fa-spin"></i>
        <h4 style="margin-top:15px;">Memuat data...</h4>
    </div>
</div>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- HEADER -->
                        <div class="basic-tb-hd">
                            <h2><b>Keselarasan Intervensi Pembangunan Kewilayahan</b></h2>
                        </div>

                        <!-- FILTER WILAYAH -->
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
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="filter-group" style="margin-top: 28px;">
                                        <button class="btn btn-primary btn-block" id="Filter">
                                            <i class="fa fa-search"></i> <b>Filter</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- INFO WILAYAH -->
                        <?php if (!empty($KodeWilayah)) { ?>
                            <div class="alert alert-info" style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <strong><i class="fa fa-map-marker"></i> Wilayah terpilih:</strong> 
                                    <?= html_escape($NamaWilayah) ?>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- TOMBOL TAMBAH LOKASI PRIORITAS -->
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3 && !empty($KodeWilayah)) { ?>
                            <div style="margin-bottom: 20px;">
                                <button class="btn btn-success" id="BtnTambahLokasiPrioritas">
                                    <i class="fa fa-plus"></i> <b>Tambah Lokasi Prioritas</b>
                                </button>
                                <span class="text-muted" style="margin-left:10px; font-size:12px;">
                                    <i class="fa fa-info-circle"></i> Tambahkan Lokasi Prioritas, Highlight Intervensi, dan Dukungan RKPD
                                </span>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TABEL - AKSI DUKUNGAN BERADA DI KOLOM LOKASI -->
                        <!-- ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-intervensi" class="table table-striped table-intervensi">
                                <thead>
                                    <tr>
                                        <th style="width:30px; vertical-align:middle; text-align:center; background:#007bff; color:#fff;" rowspan="2">NO</th>
                                        <th style="min-width:180px; vertical-align:middle; text-align:center; background:#007bff; color:#fff;" rowspan="2">LOKASI PRIORITAS</th>
                                        <th style="min-width:180px; vertical-align:middle; text-align:center; background:#28a745; color:#fff;" rowspan="2">HIGHLIGHT INTERVENSI</th>
                                        <th style="min-width:200px; vertical-align:middle; text-align:center; background:#17a2b8; color:#fff;" rowspan="2">LOKASI</th>
                                        <th style="min-width:120px; vertical-align:middle; text-align:center; background:#17a2b8; color:#fff;" colspan="3">DUKUNGAN PEMERINTAH DAERAH (RKPD 2026)</th>
                                        <th style="min-width:120px; vertical-align:middle; text-align:center; background:#17a2b8; color:#fff;" rowspan="2">PERANGKAT DAERAH</th>
                                        <th style="min-width:120px; vertical-align:middle; text-align:center; background:#17a2b8; color:#fff;" rowspan="2">KETERANGAN</th>
                                    </tr>
                                    <tr>
                                        <th style="min-width:120px; text-align:center; background:#17a2b8; color:#fff;">SUB KEGIATAN</th>
                                        <th style="min-width:120px; text-align:center; background:#17a2b8; color:#fff;">KEGIATAN</th>
                                        <th style="min-width:120px; text-align:center; background:#17a2b8; color:#fff;">PROGRAM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ListData)) { 
                                        $no = 1;
                                        foreach ($ListData as $lokasi) {
                                            $highlightCount = count($lokasi['highlight']);
                                            
                                            // Hitung total baris untuk rowspan
                                            $totalRows = 0;
                                            foreach ($lokasi['highlight'] as $h) {
                                                $totalRows += max(1, count($h['detail']));
                                            }
                                            if ($highlightCount == 0) $totalRows = 1;
                                            
                                            if ($highlightCount == 0) {
                                                ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $no++ ?></td>
                                                    <td class="text-left" style="vertical-align: middle; min-width:180px;">
                                                        <!-- AKSI LOKASI PRIORITAS - DI ATAS TEKS -->
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <div class="btn-aksi-group btn-aksi-lokasi btn-aksi-atas">
                                                                <button class="btn btn-aksi btn-edit BtnEditLokasiPrioritas" 
                                                                        data-id="<?= $lokasi['id'] ?>" 
                                                                        title="Edit data Lokasi Prioritas">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-aksi btn-delete BtnHapusLokasiPrioritas" 
                                                                        data-id="<?= $lokasi['id'] ?>" 
                                                                        title="Hapus Lokasi Prioritas beserta semua data turunannya">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                        <strong><?= html_escape($lokasi['nama_lokasi']) ?></strong>
                                                        <?php if (!empty($lokasi['wilayah_text'])) { ?>
                                                            <span class="wilayah-text"><i class="fa fa-map-marker"></i> <?= html_escape($lokasi['wilayah_text']) ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-left" style="vertical-align: middle; min-width:180px;">
                                                        <span class="text-muted">-</span>
                                                        <!-- AKSI HIGHLIGHT INTERVENSI - TAMBAH HIGHLIGHT DI ATAS TEKS -->
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <div class="btn-aksi-group btn-aksi-highlight btn-aksi-atas">
                                                                <button class="btn btn-aksi btn-add-highlight BtnTambahHighlight" 
                                                                        data-lokasi="<?= $lokasi['id'] ?>" 
                                                                        title="Tambah Highlight Intervensi baru untuk Lokasi Prioritas ini">
                                                                    <i class="fa fa-plus"></i>
                                                                    <span class="btn-label"> Highlight</span>
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="td-lokasi" style="vertical-align: middle;">
                                                        <span class="text-muted">-</span>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;" colspan="4">-</td>
                                                    <td style="vertical-align: middle;">-</td>
                                                </tr>
                                                <?php
                                            } else {
                                                $firstHighlight = true;
                                                
                                                foreach ($lokasi['highlight'] as $hIndex => $highlight) {
                                                    $detailCount = count($highlight['detail']);
                                                    $highlightRowspan = max(1, $detailCount);
                                                    
                                                    if ($detailCount == 0) {
                                                        ?>
                                                        <tr>
                                                            <?php if ($firstHighlight) { ?>
                                                                <td rowspan="<?= $totalRows ?>" style="vertical-align: middle;"><?= $no++ ?></td>
                                                                <td rowspan="<?= $totalRows ?>" class="text-left" style="vertical-align: middle; min-width:180px;">
                                                                    <!-- AKSI LOKASI PRIORITAS - DI ATAS TEKS -->
                                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                        <div class="btn-aksi-group btn-aksi-lokasi btn-aksi-atas">
                                                                            <button class="btn btn-aksi btn-edit BtnEditLokasiPrioritas" 
                                                                                    data-id="<?= $lokasi['id'] ?>" 
                                                                                    title="Edit data Lokasi Prioritas">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>
                                                                            <button class="btn btn-aksi btn-delete BtnHapusLokasiPrioritas" 
                                                                                    data-id="<?= $lokasi['id'] ?>" 
                                                                                    title="Hapus Lokasi Prioritas beserta semua data turunannya">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <strong><?= html_escape($lokasi['nama_lokasi']) ?></strong>
                                                                    <?php if (!empty($lokasi['wilayah_text'])) { ?>
                                                                        <span class="wilayah-text"><i class="fa fa-map-marker"></i> <?= html_escape($lokasi['wilayah_text']) ?></span>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td class="text-left" rowspan="<?= $highlightRowspan ?>" style="vertical-align: middle; min-width:180px;">
                                                                <!-- AKSI HIGHLIGHT INTERVENSI - DI ATAS TEKS -->
                                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                    <div class="btn-aksi-group btn-aksi-highlight btn-aksi-atas">
                                                                        <button class="btn btn-aksi btn-edit BtnEditHighlight" 
                                                                                data-id="<?= $highlight['id'] ?>" 
                                                                                title="Edit data Highlight Intervensi">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                        <button class="btn btn-aksi btn-delete BtnHapusHighlight" 
                                                                                data-id="<?= $highlight['id'] ?>" 
                                                                                title="Hapus Highlight Intervensi beserta semua Dukungan RKPD terkait">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                        <button class="btn btn-aksi btn-add-highlight BtnTambahHighlight" 
                                                                                data-lokasi="<?= $lokasi['id'] ?>" 
                                                                                title="Tambah Highlight Intervensi baru untuk Lokasi Prioritas ini">
                                                                            <i class="fa fa-plus"></i>
                                                                            <span class="btn-label">Intervensi</span>
                                                                        </button>
                                                                    </div>
                                                                <?php } ?>
                                                                <strong><?= html_escape($highlight['nama_highlight']) ?></strong>
                                                                <?php if (!empty($highlight['wilayah_text'])) { ?>
                                                                    <span class="wilayah-text"><i class="fa fa-map-marker"></i> <?= html_escape($highlight['wilayah_text']) ?></span>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="td-lokasi" style="vertical-align: middle;">
                                                                <span class="text-muted">-</span>
                                                                <!-- AKSI DUKUNGAN - TAMBAH DUKUNGAN DI ATAS TEKS -->
                                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                    <div class="btn-aksi-group btn-aksi-dukungan btn-aksi-atas">
                                                                        <button class="btn btn-aksi btn-add-dukungan BtnTambahDetail" 
                                                                                data-highlight="<?= $highlight['id'] ?>" 
                                                                                title="Tambah Dukungan RKPD baru untuk Highlight Intervensi ini">
                                                                            <i class="fa fa-plus"></i>
                                                                            <span class="btn-label"> Dukungan</span>
                                                                        </button>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="text-center" style="vertical-align: middle;" colspan="4">-</td>
                                                            <td style="vertical-align: middle;">-</td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        $firstDetail = true;
                                                        
                                                        foreach ($highlight['detail'] as $dIndex => $detail) {
                                                            // Parse wilayah IDs menjadi array untuk list
                                                            $wilayahList = [];
                                                            if (!empty($detail['lokasi_wilayah_ids'])) {
                                                                $wilayahIds = explode(',', $detail['lokasi_wilayah_ids']);
                                                                foreach ($wilayahIds as $kode) {
                                                                    $kode = trim($kode);
                                                                    if (!empty($kode)) {
                                                                        $w = $this->db->select('Nama')->where('Kode', $kode)->get('kodewilayah')->row_array();
                                                                        if ($w) {
                                                                            $wilayahList[] = $w['Nama'];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <?php if ($firstHighlight && $firstDetail) { ?>
                                                                    <td rowspan="<?= $totalRows ?>" style="vertical-align: middle;"><?= $no++ ?></td>
                                                                    <td rowspan="<?= $totalRows ?>" class="text-left" style="vertical-align: middle; min-width:180px;">
                                                                        <!-- AKSI LOKASI PRIORITAS - DI ATAS TEKS -->
                                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                            <div class="btn-aksi-group btn-aksi-lokasi btn-aksi-atas">
                                                                                <button class="btn btn-aksi btn-edit BtnEditLokasiPrioritas" 
                                                                                        data-id="<?= $lokasi['id'] ?>" 
                                                                                        title="Edit data Lokasi Prioritas">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </button>
                                                                                <button class="btn btn-aksi btn-delete BtnHapusLokasiPrioritas" 
                                                                                        data-id="<?= $lokasi['id'] ?>" 
                                                                                        title="Hapus Lokasi Prioritas beserta semua data turunannya">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <strong><?= html_escape($lokasi['nama_lokasi']) ?></strong>
                                                                        <?php if (!empty($lokasi['wilayah_text'])) { ?>
                                                                            <span class="wilayah-text"><i class="fa fa-map-marker"></i> <?= html_escape($lokasi['wilayah_text']) ?></span>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <?php if ($firstDetail) { ?>
                                                                    <td rowspan="<?= $highlightRowspan ?>" class="text-left" style="vertical-align: middle; min-width:180px;">
                                                                        <!-- AKSI HIGHLIGHT INTERVENSI - DI ATAS TEKS -->
                                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                            <div class="btn-aksi-group btn-aksi-highlight btn-aksi-atas">
                                                                                <button class="btn btn-aksi btn-edit BtnEditHighlight" 
                                                                                        data-id="<?= $highlight['id'] ?>" 
                                                                                        title="Edit data Highlight Intervensi">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </button>
                                                                                <button class="btn btn-aksi btn-delete BtnHapusHighlight" 
                                                                                        data-id="<?= $highlight['id'] ?>" 
                                                                                        title="Hapus Highlight Intervensi beserta semua Dukungan RKPD terkait">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                                <button class="btn btn-aksi btn-add-highlight BtnTambahHighlight" 
                                                                                        data-lokasi="<?= $lokasi['id'] ?>" 
                                                                                        title="Tambah Highlight Intervensi baru untuk Lokasi Prioritas ini">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    <span class="btn-label">Intervensi</span>
                                                                                </button>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <strong><?= html_escape($highlight['nama_highlight']) ?></strong>
                                                                        <?php if (!empty($highlight['wilayah_text'])) { ?>
                                                                            <span class="wilayah-text"><i class="fa fa-map-marker"></i> <?= html_escape($highlight['wilayah_text']) ?></span>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <!-- ============================================================ -->
                                                                <!-- KOLOM LOKASI - DENGAN AKSI DUKUNGAN DI ATAS TEKS -->
                                                                <!-- ============================================================ -->
                                                                <td class="td-lokasi" style="vertical-align: middle;">
                                                                    <div class="lokasi-wrapper">
                                                                        <!-- AKSI DUKUNGAN - DI ATAS TEKS -->
                                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                            <div class="btn-aksi-group btn-aksi-dukungan btn-aksi-atas" style="margin-top:0; margin-bottom:4px;">
                                                                                <button class="btn btn-aksi btn-edit BtnEditDetail" 
                                                                                        data-id="<?= $detail['id'] ?>" 
                                                                                        title="Edit data Dukungan RKPD">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </button>
                                                                                <button class="btn btn-aksi btn-delete BtnHapusDetail" 
                                                                                        data-id="<?= $detail['id'] ?>" 
                                                                                        title="Hapus Dukungan RKPD ini">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                                <?php if ($firstDetail && $dIndex == 0) { ?>
                                                                                    <button class="btn btn-aksi btn-add-dukungan BtnTambahDetail" 
                                                                                            data-highlight="<?= $highlight['id'] ?>" 
                                                                                            title="Tambah Dukungan RKPD baru untuk Highlight Intervensi ini">
                                                                                        <i class="fa fa-plus"></i>
                                                                                        <span class="btn-label">Dukungan</span>
                                                                                    </button>
                                                                                <?php } ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                        
                                                                        <!-- DAFTAR LOKASI -->
                                                                        <div class="lokasi-list-wrapper">
                                                                            <?php if (!empty($wilayahList)) { ?>
                                                                                <ul class="lokasi-list">
                                                                                    <?php foreach ($wilayahList as $namaWilayah) { ?>
                                                                                        <li>
                                                                                            <span class="lokasi-nama">
                                                                                                <span class="lokasi-kode">•</span> <?= html_escape($namaWilayah) ?>
                                                                                            </span>
                                                                                        </li>
                                                                                    <?php } ?>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <span class="text-muted">-</span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                
                                                                <!-- SUB KEGIATAN -->
                                                                <td class="text-left" style="vertical-align: middle;">
                                                                    <?php if (!empty($detail['kode_sub_kegiatan'])) { ?>
                                                                        <span class="badge-kode badge-sub"><?= html_escape($detail['kode_sub_kegiatan']) ?></span><br>
                                                                    <?php } ?>
                                                                    <span class="text-nomenklatur"><?= html_escape($detail['sub_kegiatan'] ?? '-') ?></span>
                                                                </td>
                                                                
                                                                <!-- KEGIATAN -->
                                                                <td class="text-left" style="vertical-align: middle;">
                                                                    <?php if (!empty($detail['kode_kegiatan'])) { ?>
                                                                        <span class="badge-kode badge-keg"><?= html_escape($detail['kode_kegiatan']) ?></span><br>
                                                                    <?php } ?>
                                                                    <span class="text-nomenklatur"><?= html_escape($detail['kegiatan'] ?? '-') ?></span>
                                                                </td>
                                                                
                                                                <!-- PROGRAM -->
                                                                <td class="text-left" style="vertical-align: middle;">
                                                                    <?php if (!empty($detail['kode_program'])) { ?>
                                                                        <span class="badge-kode badge-prog"><?= html_escape($detail['kode_program']) ?></span><br>
                                                                    <?php } ?>
                                                                    <span class="text-nomenklatur"><?= html_escape($detail['program'] ?? '-') ?></span>
                                                                </td>
                                                                
                                                                <!-- PERANGKAT DAERAH -->
                                                                <td class="text-left" style="vertical-align: middle;">
                                                                    <strong><?= html_escape($detail['perangkat_daerah_nama'] ?? '-') ?></strong>
                                                                </td>
                                                                
                                                                <!-- KETERANGAN -->
                                                                <td class="text-left text-wrap" style="vertical-align: middle;">
                                                                    <?= nl2br(html_escape($detail['keterangan'] ?? '-')) ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $firstDetail = false;
                                                        }
                                                    }
                                                    $firstHighlight = false;
                                                }
                                            }
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="9" class="text-center" style="padding:40px 0;">
                                                <div class="empty-state">
                                                    <i class="fa fa-file-o"></i>
                                                    <h4><b>Belum ada data</b></h4>
                                                    <p class="text-muted">
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3 && !empty($KodeWilayah)) { ?>
                                                            Klik tombol <strong>"Tambah Lokasi Prioritas"</strong> untuk mulai mengisi.
                                                        <?php } else { ?>
                                                            Pilih wilayah terlebih dahulu untuk melihat data.
                                                        <?php } ?>
                                                    </p>
                                                </div>
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
<!-- MODAL LOKASI PRIORITAS (Level 1) -->
<!-- ============================================================ -->
<div class="modal fade fixed-modal" id="ModalLokasiPrioritas" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#007bff; color:#fff; border-radius: 6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:1;">&times;</button>
                <h4><b id="ModalLokasiPrioritasTitle">Tambah Lokasi Prioritas</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="LokasiPrioritasId" value="0">
                
                <div class="form-group">
                    <label><b>NAMA LOKASI PRIORITAS</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="NamaLokasiPrioritas" placeholder="Contoh: Kawasan Swasembada Pangan, Air, dan Energi Tapal Kuda">
                </div>
                
                <hr>
                <h5><b>PILIH WILAYAH</b></h5>
                <p class="text-muted small">Pilih wilayah di level manapun (Provinsi, Kab/Kota, Kecamatan, atau Desa). Klik <strong>Tambah</strong> untuk memasukkan ke daftar.</p>
                
                <div id="wilayahContainer_lokasi">
                    <div class="wilayah-rows-container"></div>
                    <button class="btn btn-primary btn-sm btn-tambah-row-wilayah" data-container="wilayahContainer_lokasi">
                        <i class="fa fa-plus"></i> Tambah Pilihan Wilayah
                    </button>
                    
                    <div id="selectedWilayah_wilayahContainer_lokasi" class="selected-wilayah-list" style="margin-top:10px;">
                        <p class="text-muted">Belum ada wilayah yang dipilih</p>
                    </div>
                </div>
                
                <div class="text-right" style="margin-top:20px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-primary" id="BtnSimpanLokasiPrioritas"><b>SIMPAN</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL HIGHLIGHT INTERVENSI (Level 2) -->
<!-- ============================================================ -->
<div class="modal fade fixed-modal" id="ModalHighlightIntervensi" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#28a745; color:#fff; border-radius: 6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:1;">&times;</button>
                <h4><b id="ModalHighlightTitle">Tambah Highlight Intervensi</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="HighlightId" value="0">
                <input type="hidden" id="HighlightLokasiId" value="0">
                
                <div class="form-group">
                    <label><b>NAMA HIGHLIGHT INTERVENSI</b> <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="NamaHighlight" rows="3" placeholder="Contoh: Rehabilitasi dan peningkatan jaringan irigasi..."></textarea>
                </div>
                
                <hr>
                <h5><b>PILIH WILAYAH</b></h5>
                <p class="text-muted small">Pilih wilayah di level manapun (Provinsi, Kab/Kota, Kecamatan, atau Desa). Klik <strong>Tambah</strong> untuk memasukkan ke daftar.</p>
                
                <div id="wilayahContainer_highlight">
                    <div class="wilayah-rows-container"></div>
                    <button class="btn btn-primary btn-sm btn-tambah-row-wilayah" data-container="wilayahContainer_highlight">
                        <i class="fa fa-plus"></i> Tambah Pilihan Wilayah
                    </button>
                    
                    <div id="selectedWilayah_wilayahContainer_highlight" class="selected-wilayah-list" style="margin-top:10px;">
                        <p class="text-muted">Belum ada wilayah yang dipilih</p>
                    </div>
                </div>
                
                <div class="text-right" style="margin-top:20px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-success" id="BtnSimpanHighlight"><b>SIMPAN</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL DETAIL INTERVENSI (Level 3 - Gabungan Lokasi + Dukungan) -->
<!-- ============================================================ -->
<div class="modal fade fixed-modal" id="ModalDetailIntervensi" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#17a2b8; color:#fff; border-radius: 6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:1;">&times;</button>
                <h4><b id="ModalDetailTitle">Tambah Dukungan RKPD</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="DetailId" value="0">
                <input type="hidden" id="DetailHighlightId" value="0">
                
                <!-- LOKASI - HANYA WILAYAH (Multi-Select) -->
                <div class="form-group">
                    <label><b>LOKASI</b> <span class="text-danger">*</span></label>
                    <p class="text-muted small">Pilih wilayah di level manapun (Provinsi, Kab/Kota, Kecamatan, atau Desa).</p>
                    
                    <div id="wilayahContainer_detail">
                        <div class="wilayah-rows-container"></div>
                        <button class="btn btn-primary btn-sm btn-tambah-row-wilayah" data-container="wilayahContainer_detail">
                            <i class="fa fa-plus"></i> Tambah Pilihan Wilayah
                        </button>
                        
                        <div id="selectedWilayah_wilayahContainer_detail" class="selected-wilayah-list" style="margin-top:10px;">
                            <p class="text-muted">Belum ada wilayah yang dipilih</p>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- DUKUNGAN RKPD - HIRARKI PROGRAM → KEGIATAN → SUB KEGIATAN -->
                <div class="row">
                    <div class="col-md-4 cascading-select">
                        <label><b>PROGRAM</b></label>
                        <select class="form-control select-program" id="DetailProgram">
                            <option value="">-- Pilih Program --</option>
                        </select>
                    </div>
                    <div class="col-md-4 cascading-select">
                        <label><b>KEGIATAN</b></label>
                        <select class="form-control select-kegiatan" id="DetailKegiatan" disabled>
                            <option value="">-- Pilih Kegiatan --</option>
                        </select>
                    </div>
                    <div class="col-md-4 cascading-select">
                        <label><b>SUB KEGIATAN</b></label>
                        <select class="form-control select-sub" id="DetailSubKegiatan" disabled>
                            <option value="">-- Pilih Sub Kegiatan --</option>
                        </select>
                    </div>
                </div>
                
                <input type="hidden" id="DetailKodeProgram" value="">
                <input type="hidden" id="DetailKodeKegiatan" value="">
                <input type="hidden" id="DetailKodeSubKegiatan" value="">
                
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>PERANGKAT DAERAH</b></label>
                            <select class="form-control" id="DetailPerangkatDaerah">
                                <option value="">-- Pilih Perangkat Daerah --</option>
                                <?php foreach ($PerangkatDaerah as $pd) { ?>
                                    <option value="<?= $pd['id'] ?>"><?= html_escape($pd['nama']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>KETERANGAN</b></label>
                            <input type="text" class="form-control" id="DetailKeterangan" placeholder="Keterangan...">
                        </div>
                    </div>
                </div>
                
                <div class="text-right" style="margin-top:20px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-info" id="BtnSimpanDetail"><b>SIMPAN</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- JAVASCRIPT -->
<!-- ============================================================ -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js') ?>"></script>

<script>
// ================================================================
// KONFIGURASI
// ================================================================
var BaseURL    = "<?= base_url() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_3  = '<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '1' : '0' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

// ================================================================
// LOADING
// ================================================================
function showLoading() { $('#loadingOverlay').css('display', 'flex'); }
function hideLoading() { $('#loadingOverlay').css('display', 'none'); }

// ================================================================
// NOMENKLATUR CACHE
// ================================================================
var nomenklaturCache = {};

// ================================================================
// FUNGSI LOAD DROPDOWN - PROGRAM → KEGIATAN → SUB KEGIATAN
// ================================================================

function loadProgram(selectId, selectedValue, callback) {
    var cacheKey = 'programs';
    
    if (nomenklaturCache[cacheKey]) {
        populateSelect(selectId, nomenklaturCache[cacheKey], 'Pilih Program', selectedValue);
        if (callback) callback();
        return;
    }
    
    $.ajax({
        url: BaseURL + "Daerah/getProgramList",
        type: "POST",
        data: { [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res) {
            nomenklaturCache[cacheKey] = res;
            populateSelect(selectId, res, 'Pilih Program', selectedValue);
            if (callback) callback();
        },
        error: function() {
            populateSelect(selectId, [], 'Pilih Program', selectedValue);
            if (callback) callback();
        }
    });
}

function loadKegiatan(selectId, kodeProgram, selectedValue, callback) {
    if (!kodeProgram) {
        populateSelect(selectId, [], 'Pilih Kegiatan', '');
        if (callback) callback();
        return;
    }
    
    var cacheKey = 'kegiatan_' + kodeProgram;
    
    if (nomenklaturCache[cacheKey]) {
        populateSelect(selectId, nomenklaturCache[cacheKey], 'Pilih Kegiatan', selectedValue);
        if (callback) callback();
        return;
    }
    
    $.ajax({
        url: BaseURL + "Daerah/getKegiatanByProgram",
        type: "POST",
        data: { kode_program: kodeProgram, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res) {
            nomenklaturCache[cacheKey] = res;
            populateSelect(selectId, res, 'Pilih Kegiatan', selectedValue);
            if (callback) callback();
        },
        error: function() {
            populateSelect(selectId, [], 'Pilih Kegiatan', selectedValue);
            if (callback) callback();
        }
    });
}

function loadSubKegiatan(selectId, kodeKegiatan, selectedValue, callback) {
    if (!kodeKegiatan) {
        populateSelect(selectId, [], 'Pilih Sub Kegiatan', '');
        if (callback) callback();
        return;
    }
    
    var cacheKey = 'subkegiatan_' + kodeKegiatan;
    
    if (nomenklaturCache[cacheKey]) {
        populateSelect(selectId, nomenklaturCache[cacheKey], 'Pilih Sub Kegiatan', selectedValue);
        if (callback) callback();
        return;
    }
    
    $.ajax({
        url: BaseURL + "Daerah/getSubKegiatanByKegiatan",
        type: "POST",
        data: { kode_kegiatan: kodeKegiatan, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res) {
            nomenklaturCache[cacheKey] = res;
            populateSelect(selectId, res, 'Pilih Sub Kegiatan', selectedValue);
            if (callback) callback();
        },
        error: function() {
            populateSelect(selectId, [], 'Pilih Sub Kegiatan', selectedValue);
            if (callback) callback();
        }
    });
}

function populateSelect(selectId, data, placeholder, selectedValue) {
    var options = '<option value="">-- ' + placeholder + ' --</option>';
    
    if (data && data.length > 0) {
        for (var i = 0; i < data.length; i++) {
            var selected = (data[i].Kode == selectedValue) ? ' selected' : '';
            options += '<option value="' + data[i].Kode + '"' + selected + '>' + 
                       data[i].Nomenklatur + '</option>';
        }
    }
    
    $('#' + selectId).html(options);
}

// ================================================================
// EVENT DROPDOWN DETAIL
// ================================================================
$(document).on('change', '#DetailProgram', function() {
    var kodeProgram = $(this).val();
    $('#DetailKodeProgram').val(kodeProgram);
    
    populateSelect('DetailKegiatan', [], 'Pilih Kegiatan', '');
    $('#DetailKegiatan').prop('disabled', true);
    populateSelect('DetailSubKegiatan', [], 'Pilih Sub Kegiatan', '');
    $('#DetailSubKegiatan').prop('disabled', true);
    $('#DetailKodeKegiatan').val('');
    $('#DetailKodeSubKegiatan').val('');
    
    if (kodeProgram) {
        loadKegiatan('DetailKegiatan', kodeProgram, '', function() {
            $('#DetailKegiatan').prop('disabled', false);
        });
    }
});

$(document).on('change', '#DetailKegiatan', function() {
    var kodeKegiatan = $(this).val();
    $('#DetailKodeKegiatan').val(kodeKegiatan);
    
    populateSelect('DetailSubKegiatan', [], 'Pilih Sub Kegiatan', '');
    $('#DetailSubKegiatan').prop('disabled', true);
    $('#DetailKodeSubKegiatan').val('');
    
    if (kodeKegiatan) {
        loadSubKegiatan('DetailSubKegiatan', kodeKegiatan, '', function() {
            $('#DetailSubKegiatan').prop('disabled', false);
        });
    }
});

$(document).on('change', '#DetailSubKegiatan', function() {
    $('#DetailKodeSubKegiatan').val($(this).val());
});

// ================================================================
// KOMPONEN PEMILIHAN WILAYAH
// ================================================================

var selectedWilayahMap = {};

function renderSelectedWilayah(containerId) {
    var container = $('#selectedWilayah_' + containerId);
    
    if (!selectedWilayahMap[containerId]) {
        selectedWilayahMap[containerId] = [];
    }
    
    var data = selectedWilayahMap[containerId];
    container.empty();
    
    if (data.length === 0) {
        container.html('<p class="text-muted">Belum ada wilayah yang dipilih</p>');
        return;
    }
    
    var html = '<ul class="list-group">';
    for (var i = 0; i < data.length; i++) {
        var w = data[i];
        var dotCount = (w.kode.match(/\./g) || []).length;
        var levelLabel = '';
        if (dotCount === 0) levelLabel = 'Provinsi';
        else if (dotCount === 1) levelLabel = 'Kab/Kota';
        else if (dotCount === 2) levelLabel = 'Kecamatan';
        else if (dotCount === 3) levelLabel = 'Desa';
        
        html += '<li class="list-group-item">';
        html += '  <div class="wilayah-info">';
        html += '    <span class="badge-level">' + levelLabel + '</span>';
        html += '    <span class="wilayah-nama" title="Kode: ' + w.kode + '">' + w.nama + '</span>';
        html += '  </div>';
        html += '  <button class="btn-hapus-wilayah-modal" data-container="' + containerId + '" data-index="' + i + '">';
        html += '    <i class="fa fa-trash"></i> Hapus';
        html += '  </button>';
        html += '</li>';
    }
    html += '</ul>';
    container.html(html);
}

function tambahWilayah(containerId, kode, nama) {
    if (!kode || !nama) {
        alert('Pilih wilayah terlebih dahulu!');
        return;
    }
    
    if (!selectedWilayahMap[containerId]) {
        selectedWilayahMap[containerId] = [];
    }
    
    var exists = selectedWilayahMap[containerId].some(function(w) {
        return w.kode === kode;
    });
    
    if (exists) {
        alert('Wilayah dengan kode ' + kode + ' sudah dipilih!');
        return;
    }
    
    selectedWilayahMap[containerId].push({ kode: kode, nama: nama });
    renderSelectedWilayah(containerId);
}

function hapusWilayah(containerId, index) {
    if (selectedWilayahMap[containerId]) {
        selectedWilayahMap[containerId].splice(index, 1);
        renderSelectedWilayah(containerId);
    }
}

function resetWilayahContainer(containerId) {
    selectedWilayahMap[containerId] = [];
    renderSelectedWilayah(containerId);
    $('#' + containerId + ' .wilayah-rows-container').empty();
}

// ================================================================
// LOAD PROVINSI - HANYA NAMA
// ================================================================
function loadProvinsi(selectId) {
    $.ajax({
        url: BaseURL + "Daerah/getProvinsiWilayah",
        type: "POST",
        data: { [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res) {
            var options = '<option value="">-- Pilih Provinsi --</option>';
            for (var i = 0; i < res.length; i++) {
                options += '<option value="' + res[i].Kode + '">' + res[i].Nama + '</option>';
            }
            $('#' + selectId).html(options);
        }
    });
}

// ================================================================
// EVENT WILAYAH HIERARKI
// ================================================================
$(document).on('change', '.select-provinsi', function() {
    var rowId = $(this).closest('.wilayah-row').attr('id');
    var kode = $(this).val();
    
    var kabSelectId = 'kab_' + rowId;
    var kecSelectId = 'kec_' + rowId;
    var desaSelectId = 'desa_' + rowId;
    
    $('#' + kabSelectId).html('<option value="">-- Pilih Kab/Kota --</option>').prop('disabled', true);
    $('#' + kecSelectId).html('<option value="">-- Pilih Kecamatan --</option>').prop('disabled', true);
    $('#' + desaSelectId).html('<option value="">-- Pilih Desa --</option>').prop('disabled', true);
    
    if (kode) {
        $.ajax({
            url: BaseURL + "Daerah/getKabKotaWilayah",
            type: "POST",
            data: { kode: kode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                var options = '<option value="">-- Pilih Kab/Kota --</option>';
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Nama + '</option>';
                }
                $('#' + kabSelectId).html(options).prop('disabled', false);
            }
        });
    }
});

$(document).on('change', '.select-kabkota', function() {
    var rowId = $(this).closest('.wilayah-row').attr('id');
    var kode = $(this).val();
    
    var kecSelectId = 'kec_' + rowId;
    var desaSelectId = 'desa_' + rowId;
    
    $('#' + kecSelectId).html('<option value="">-- Pilih Kecamatan --</option>').prop('disabled', true);
    $('#' + desaSelectId).html('<option value="">-- Pilih Desa --</option>').prop('disabled', true);
    
    if (kode) {
        $.ajax({
            url: BaseURL + "Daerah/getKecamatanWilayah",
            type: "POST",
            data: { kode: kode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                var options = '<option value="">-- Pilih Kecamatan --</option>';
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Nama + '</option>';
                }
                $('#' + kecSelectId).html(options).prop('disabled', false);
            }
        });
    }
});

$(document).on('change', '.select-kecamatan', function() {
    var rowId = $(this).closest('.wilayah-row').attr('id');
    var kode = $(this).val();
    
    var desaSelectId = 'desa_' + rowId;
    
    $('#' + desaSelectId).html('<option value="">-- Pilih Desa --</option>').prop('disabled', true);
    
    if (kode) {
        $.ajax({
            url: BaseURL + "Daerah/getDesaWilayah",
            type: "POST",
            data: { kode: kode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                var options = '<option value="">-- Pilih Desa --</option>';
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Nama + '</option>';
                }
                $('#' + desaSelectId).html(options).prop('disabled', false);
            }
        });
    }
});

// ================================================================
// TAMBAH ROW WILAYAH
// ================================================================
var wilayahCounter = 0;

function tambahRowWilayah(containerId) {
    wilayahCounter++;
    var rowId = 'wilayah_' + wilayahCounter;
    
    var html = '<div class="wilayah-row" id="' + rowId + '">';
    html += '  <div class="row">';
    html += '    <div class="col-md-3">';
    html += '      <label class="label-wilayah">Provinsi</label>';
    html += '      <select class="form-control select-provinsi" id="prov_' + rowId + '">';
    html += '        <option value="">-- Pilih Provinsi --</option>';
    html += '      </select>';
    html += '    </div>';
    html += '    <div class="col-md-3">';
    html += '      <label class="label-wilayah">Kab/Kota</label>';
    html += '      <select class="form-control select-kabkota" id="kab_' + rowId + '" disabled>';
    html += '        <option value="">-- Pilih Kab/Kota --</option>';
    html += '      </select>';
    html += '    </div>';
    html += '    <div class="col-md-2">';
    html += '      <label class="label-wilayah">Kecamatan</label>';
    html += '      <select class="form-control select-kecamatan" id="kec_' + rowId + '" disabled>';
    html += '        <option value="">-- Pilih Kecamatan --</option>';
    html += '      </select>';
    html += '    </div>';
    html += '    <div class="col-md-2">';
    html += '      <label class="label-wilayah">Desa</label>';
    html += '      <select class="form-control select-desa" id="desa_' + rowId + '" disabled>';
    html += '        <option value="">-- Pilih Desa --</option>';
    html += '      </select>';
    html += '    </div>';
    html += '    <div class="col-md-2" style="padding-top:23px;">';
    html += '      <button class="btn btn-success btn-sm btn-tambah-wilayah" data-row="' + rowId + '" data-container="' + containerId + '">';
    html += '        <i class="fa fa-plus"></i> Tambah';
    html += '      </button>';
    html += '    </div>';
    html += '  </div>';
    html += '  <div class="row" style="margin-top:5px;">';
    html += '    <div class="col-md-12">';
    html += '      <small class="text-muted">Pilih wilayah di level manapun (Provinsi, Kab/Kota, Kecamatan, atau Desa), tidak harus sampai desa.</small>';
    html += '    </div>';
    html += '  </div>';
    html += '</div>';
    
    $('#' + containerId + ' .wilayah-rows-container').append(html);
    loadProvinsi('prov_' + rowId);
}

$(document).on('click', '.btn-tambah-row-wilayah', function() {
    var containerId = $(this).data('container');
    tambahRowWilayah(containerId);
});

// ================================================================
// EVENT TAMBAH WILAYAH DARI ROW
// ================================================================
$(document).on('click', '.btn-tambah-wilayah', function() {
    var rowId = $(this).data('row');
    var containerId = $(this).data('container');
    
    var provKode = $('#prov_' + rowId).val();
    var provNama = $('#prov_' + rowId).find('option:selected').text();
    var kabKode = $('#kab_' + rowId).val();
    var kabNama = $('#kab_' + rowId).find('option:selected').text();
    var kecKode = $('#kec_' + rowId).val();
    var kecNama = $('#kec_' + rowId).find('option:selected').text();
    var desaKode = $('#desa_' + rowId).val();
    var desaNama = $('#desa_' + rowId).find('option:selected').text();
    
    var kode = '';
    var nama = '';
    
    if (desaKode && desaKode !== '') {
        kode = desaKode;
        nama = desaNama;
    } else if (kecKode && kecKode !== '') {
        kode = kecKode;
        nama = kecNama;
    } else if (kabKode && kabKode !== '') {
        kode = kabKode;
        nama = kabNama;
    } else if (provKode && provKode !== '') {
        kode = provKode;
        nama = provNama;
    } else {
        alert('Pilih wilayah terlebih dahulu (minimal Provinsi)!');
        return;
    }
    
    tambahWilayah(containerId, kode, nama);
    
    $('#prov_' + rowId).val('');
    $('#kab_' + rowId).html('<option value="">-- Pilih Kab/Kota --</option>').prop('disabled', true);
    $('#kec_' + rowId).html('<option value="">-- Pilih Kecamatan --</option>').prop('disabled', true);
    $('#desa_' + rowId).html('<option value="">-- Pilih Desa --</option>').prop('disabled', true);
});

$(document).on('click', '.btn-hapus-wilayah-modal', function() {
    var containerId = $(this).data('container');
    var index = $(this).data('index');
    hapusWilayah(containerId, index);
});

// ================================================================
// FILTER WILAYAH
// ================================================================
$(document).ready(function() {
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
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
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
        setTimeout(function() { $("#KabKota").val(kodeKab); }, 300);
    <?php } ?>

    $("#Filter").on('click', function(e) {
        e.preventDefault();
        var provinsi = $("#Provinsi").val();
        var kabKota = $("#KabKota").val();
        
        if (!provinsi || provinsi === "") {
            var firstProv = $("#Provinsi option:eq(1)").val();
            if (firstProv) { $("#Provinsi").val(firstProv); provinsi = firstProv; }
            else { window.location.href = window.location.pathname; return; }
        }
        
        if (!kabKota || kabKota === "") {
            var firstKab = $("#KabKota option:eq(1)").val();
            if (firstKab) { $("#KabKota").val(firstKab); kabKota = firstKab; }
            else { kabKota = provinsi; $("#KabKota").val(kabKota); }
        }
        
        $("#Filter").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');
        
        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kabKota, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            success: function(res) { window.location.href = window.location.pathname; },
            error: function() { window.location.href = window.location.pathname; }
        });
    });
});

// ================================================================
// CRUD - LOKASI PRIORITAS (Level 1)
// ================================================================
if (IS_ROLE_3 == '1' && KODE_WILAYAH) {

    $('#BtnTambahLokasiPrioritas').on('click', function(e) {
        e.preventDefault();
        $('#LokasiPrioritasId').val(0);
        $('#ModalLokasiPrioritasTitle').text('Tambah Lokasi Prioritas');
        $('#NamaLokasiPrioritas').val('');
        resetWilayahContainer('wilayahContainer_lokasi');
        
        $('#ModalLokasiPrioritas').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    $(document).on('click', '.BtnEditLokasiPrioritas', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        showLoading();
        $.ajax({
            url: BaseURL + "Daerah/GetLokasiPrioritasById",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success" && res.data) {
                    var d = res.data;
                    $('#LokasiPrioritasId').val(d.id);
                    $('#ModalLokasiPrioritasTitle').text('Edit Lokasi Prioritas');
                    $('#NamaLokasiPrioritas').val(d.nama_lokasi);
                    
                    resetWilayahContainer('wilayahContainer_lokasi');
                    
                    if (d.wilayah_ids_array && d.wilayah_ids_array.length > 0) {
                        var ids = d.wilayah_ids_array;
                        for (var i = 0; i < ids.length; i++) {
                            var kode = ids[i];
                            $.ajax({
                                url: BaseURL + "Daerah/getNamaWilayahByKode",
                                type: "POST",
                                data: { kode: kode, [CSRF_NAME]: CSRF_TOKEN },
                                dataType: "json",
                                async: false,
                                success: function(res2) {
                                    if (res2.status === "success") {
                                        tambahWilayah('wilayahContainer_lokasi', kode, res2.nama);
                                    }
                                }
                            });
                        }
                    }
                    
                    $('#ModalLokasiPrioritas').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).css('display', 'block').addClass('in');
                    $('body').addClass('modal-open');
                } else {
                    alert(res.message || 'Gagal memuat data');
                }
            },
            error: function() {
                hideLoading();
                alert('Terjadi kesalahan saat memuat data');
            }
        });
    });

    $('#BtnSimpanLokasiPrioritas').on('click', function(e) {
        e.preventDefault();
        
        var id = parseInt($('#LokasiPrioritasId').val()) || 0;
        var namaLokasi = $('#NamaLokasiPrioritas').val().trim();
        var wilayahData = selectedWilayahMap['wilayahContainer_lokasi'] || [];
        
        if (!namaLokasi) {
            alert('Nama Lokasi Prioritas harus diisi!');
            $('#NamaLokasiPrioritas').focus();
            return;
        }
        
        if (wilayahData.length === 0) {
            alert('Pilih minimal 1 wilayah!');
            return;
        }
        
        var wilayahIds = wilayahData.map(function(w) { return w.kode; });
        
        showLoading();
        
        var data = {
            id: id,
            nama_lokasi: namaLokasi,
            wilayah_ids: wilayahIds,
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = (id > 0) ? BaseURL + "Daerah/UpdateLokasiPrioritas" : BaseURL + "Daerah/InputLokasiPrioritas";
        
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
                    alert(res.message || "Gagal menyimpan data");
                }
            },
            error: function(xhr) {
                hideLoading();
                alert("Terjadi kesalahan: " + xhr.responseText);
            }
        });
    });

    $(document).on('click', '.BtnHapusLokasiPrioritas', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (!confirm("Yakin hapus data ini? Semua Highlight Intervensi dan Dukungan RKPD terkait juga akan dihapus.")) return;
        
        showLoading();
        $.ajax({
            url: BaseURL + "Daerah/HapusLokasiPrioritas",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal hapus data!");
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
// CRUD - HIGHLIGHT INTERVENSI (Level 2)
// ================================================================
if (IS_ROLE_3 == '1' && KODE_WILAYAH) {

    $(document).on('click', '.BtnTambahHighlight', function(e) {
        e.preventDefault();
        var lokasiId = $(this).data('lokasi');
        $('#HighlightId').val(0);
        $('#HighlightLokasiId').val(lokasiId);
        $('#ModalHighlightTitle').text('Tambah Highlight Intervensi');
        $('#NamaHighlight').val('');
        resetWilayahContainer('wilayahContainer_highlight');
        
        $('#ModalHighlightIntervensi').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    $(document).on('click', '.BtnEditHighlight', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        showLoading();
        $.ajax({
            url: BaseURL + "Daerah/GetHighlightIntervensiById",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success" && res.data) {
                    var d = res.data;
                    $('#HighlightId').val(d.id);
                    $('#HighlightLokasiId').val(d.lokasi_prioritas_id);
                    $('#ModalHighlightTitle').text('Edit Highlight Intervensi');
                    $('#NamaHighlight').val(d.nama_highlight);
                    
                    resetWilayahContainer('wilayahContainer_highlight');
                    
                    if (d.wilayah_ids_array && d.wilayah_ids_array.length > 0) {
                        var ids = d.wilayah_ids_array;
                        for (var i = 0; i < ids.length; i++) {
                            var kode = ids[i];
                            $.ajax({
                                url: BaseURL + "Daerah/getNamaWilayahByKode",
                                type: "POST",
                                data: { kode: kode, [CSRF_NAME]: CSRF_TOKEN },
                                dataType: "json",
                                async: false,
                                success: function(res2) {
                                    if (res2.status === "success") {
                                        tambahWilayah('wilayahContainer_highlight', kode, res2.nama);
                                    }
                                }
                            });
                        }
                    }
                    
                    $('#ModalHighlightIntervensi').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).css('display', 'block').addClass('in');
                    $('body').addClass('modal-open');
                } else {
                    alert(res.message || 'Gagal memuat data');
                }
            },
            error: function() {
                hideLoading();
                alert('Terjadi kesalahan saat memuat data');
            }
        });
    });

    $('#BtnSimpanHighlight').on('click', function(e) {
        e.preventDefault();
        
        var id = parseInt($('#HighlightId').val()) || 0;
        var lokasiId = parseInt($('#HighlightLokasiId').val()) || 0;
        var namaHighlight = $('#NamaHighlight').val().trim();
        var wilayahData = selectedWilayahMap['wilayahContainer_highlight'] || [];
        
        if (!namaHighlight) {
            alert('Nama Highlight Intervensi harus diisi!');
            $('#NamaHighlight').focus();
            return;
        }
        
        var wilayahIds = wilayahData.map(function(w) { return w.kode; });
        
        showLoading();
        
        var data = {
            id: id,
            lokasi_id: lokasiId,
            nama_highlight: namaHighlight,
            wilayah_ids: wilayahIds,
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = (id > 0) ? BaseURL + "Daerah/UpdateHighlightIntervensi" : BaseURL + "Daerah/InputHighlightIntervensi";
        
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
                    alert(res.message || "Gagal menyimpan data");
                }
            },
            error: function(xhr) {
                hideLoading();
                alert("Terjadi kesalahan: " + xhr.responseText);
            }
        });
    });

    $(document).on('click', '.BtnHapusHighlight', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (!confirm("Yakin hapus Highlight Intervensi ini? Semua Dukungan RKPD terkait juga akan dihapus.")) return;
        
        showLoading();
        $.ajax({
            url: BaseURL + "Daerah/HapusHighlightIntervensi",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal hapus data!");
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
// CRUD - DETAIL INTERVENSI (Level 3 - Gabungan)
// ================================================================
if (IS_ROLE_3 == '1' && KODE_WILAYAH) {

    $(document).on('click', '.BtnTambahDetail', function(e) {
        e.preventDefault();
        var highlightId = $(this).data('highlight');
        $('#DetailId').val(0);
        $('#DetailHighlightId').val(highlightId);
        $('#ModalDetailTitle').text('Tambah Dukungan RKPD');
        
        resetWilayahContainer('wilayahContainer_detail');
        
        $('#DetailProgram').val('');
        $('#DetailKodeProgram').val('');
        populateSelect('DetailKegiatan', [], 'Pilih Kegiatan', '');
        $('#DetailKegiatan').prop('disabled', true);
        populateSelect('DetailSubKegiatan', [], 'Pilih Sub Kegiatan', '');
        $('#DetailSubKegiatan').prop('disabled', true);
        $('#DetailKodeKegiatan').val('');
        $('#DetailKodeSubKegiatan').val('');
        $('#DetailPerangkatDaerah').val('');
        $('#DetailKeterangan').val('');
        
        loadProgram('DetailProgram', '');
        
        $('#ModalDetailIntervensi').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    $(document).on('click', '.BtnEditDetail', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        showLoading();
        $.ajax({
            url: BaseURL + "Daerah/GetDetailIntervensiById",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success" && res.data) {
                    var d = res.data;
                    $('#DetailId').val(d.id);
                    $('#DetailHighlightId').val(d.highlight_id);
                    $('#ModalDetailTitle').text('Edit Dukungan RKPD');
                    
                    resetWilayahContainer('wilayahContainer_detail');
                    
                    if (d.lokasi_wilayah_ids_array && d.lokasi_wilayah_ids_array.length > 0) {
                        var ids = d.lokasi_wilayah_ids_array;
                        for (var i = 0; i < ids.length; i++) {
                            var kode = ids[i];
                            $.ajax({
                                url: BaseURL + "Daerah/getNamaWilayahByKode",
                                type: "POST",
                                data: { kode: kode, [CSRF_NAME]: CSRF_TOKEN },
                                dataType: "json",
                                async: false,
                                success: function(res2) {
                                    if (res2.status === "success") {
                                        tambahWilayah('wilayahContainer_detail', kode, res2.nama);
                                    }
                                }
                            });
                        }
                    }
                    
                    loadProgram('DetailProgram', d.kode_program, function() {
                        loadKegiatan('DetailKegiatan', d.kode_program, d.kode_kegiatan, function() {
                            $('#DetailKegiatan').prop('disabled', false);
                            loadSubKegiatan('DetailSubKegiatan', d.kode_kegiatan, d.kode_sub_kegiatan, function() {
                                $('#DetailSubKegiatan').prop('disabled', false);
                            });
                        });
                    });
                    
                    $('#DetailKodeProgram').val(d.kode_program);
                    $('#DetailKodeKegiatan').val(d.kode_kegiatan);
                    $('#DetailKodeSubKegiatan').val(d.kode_sub_kegiatan);
                    $('#DetailPerangkatDaerah').val(d.id_perangkat_daerah);
                    $('#DetailKeterangan').val(d.keterangan);
                    
                    $('#ModalDetailIntervensi').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).css('display', 'block').addClass('in');
                    $('body').addClass('modal-open');
                } else {
                    alert(res.message || 'Gagal memuat data');
                }
            },
            error: function() {
                hideLoading();
                alert('Terjadi kesalahan saat memuat data');
            }
        });
    });

    $('#BtnSimpanDetail').on('click', function(e) {
        e.preventDefault();
        
        var id = parseInt($('#DetailId').val()) || 0;
        var highlightId = parseInt($('#DetailHighlightId').val()) || 0;
        
        // LOKASI - Hanya wilayah
        var wilayahData = selectedWilayahMap['wilayahContainer_detail'] || [];
        var lokasiWilayahIds = wilayahData.map(function(w) { return w.kode; });
        
        // DUKUNGAN
        var kodeProgram = $('#DetailKodeProgram').val();
        var kodeKegiatan = $('#DetailKodeKegiatan').val();
        var kodeSubKegiatan = $('#DetailKodeSubKegiatan').val();
        var idPerangkatDaerah = $('#DetailPerangkatDaerah').val();
        var keterangan = $('#DetailKeterangan').val().trim();
        
        if (lokasiWilayahIds.length === 0) {
            alert('Pilih minimal 1 wilayah untuk Lokasi!');
            return;
        }
        
        showLoading();
        
        var data = {
            id: id,
            highlight_id: highlightId,
            lokasi_wilayah_ids: lokasiWilayahIds,
            kode_program: kodeProgram,
            kode_kegiatan: kodeKegiatan,
            kode_sub_kegiatan: kodeSubKegiatan,
            id_perangkat_daerah: idPerangkatDaerah,
            keterangan: keterangan,
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = (id > 0) ? BaseURL + "Daerah/UpdateDetailIntervensi" : BaseURL + "Daerah/InputDetailIntervensi";
        
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
                    alert(res.message || "Gagal menyimpan data");
                }
            },
            error: function(xhr) {
                hideLoading();
                alert("Terjadi kesalahan: " + xhr.responseText);
            }
        });
    });

    $(document).on('click', '.BtnHapusDetail', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (!confirm("Yakin hapus Dukungan RKPD ini?")) return;
        
        showLoading();
        $.ajax({
            url: BaseURL + "Daerah/HapusDetailIntervensi",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal hapus data!");
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
// MODAL CLOSE
// ================================================================
$('.modal').on('hidden.bs.modal', function() {
    $('body').removeClass('modal-open');
    $(this).removeClass('in').css('display', 'none');
});

// ================================================================
// DATATABLE
// ================================================================
$(document).ready(function() {
    if ($('#data-table-intervensi').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-intervensi')) {
                $('#data-table-intervensi').DataTable().destroy();
            }
            
            $('#data-table-intervensi').DataTable({
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

console.log('=== Keselarasan Intervensi Debug ===');
console.log('BaseURL:', BaseURL);
console.log('KODE_WILAYAH:', KODE_WILAYAH);
console.log('IS_ROLE_3:', IS_ROLE_3);
</script>

</body>
</html>