<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Renja Perangkat Daerah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('Daerah/Cssumum'); ?>
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <style>
        /* ===== STYLE UTAMA ===== */
        .table-renja th, .table-renja td { 
            vertical-align: middle; 
            text-align: center; 
            border: 1px solid #dee2e6; 
            padding: 6px; 
            font-size: 12px;
        }
        .table-renja .uraian { 
            text-align: left !important; 
            padding-left: 10px !important; 
        }
        .table-renja .rp { white-space: nowrap; font-weight: 500; text-align: right; }
        
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
        .header-row.status-edited {
            background-color: #fff3cd !important;
            border-left: 4px solid #f39c12;
        }
        .header-row.status-edited:hover {
            background-color: #ffeaa7 !important;
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
            min-width: 1500px;
        }
        
        /* ===== BADGE ===== */
        .badge-detail {
            background-color: #17a2b8;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
        }
        .badge-status {
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-status-normal {
            background: #d4edda;
            color: #155724;
        }
        .badge-status-edited {
            background: #ffc107;
            color: #856404;
        }
        
        /* ===== BADGE DI INDIKATOR ===== */
        .badge-daerah-edit {
            background-color: #f39c12;
            color: #fff;
            font-size: 9px;
            padding: 4px 8px;
            border-radius: 4px;
            margin-top: 4px;
            display: block;
            width: 100%;
            font-weight: 600;
            text-align: center;
            line-height: 1.4;
            box-sizing: border-box;
        }
        .badge-daerah-edit i {
            margin-right: 3px;
        }
        .badge-edit-time {
            font-size: 8px;
            font-weight: 400;
            opacity: 0.9;
            display: inline-block;
            margin-top: 1px;
        }
        
        /* ===== ROW INDIKATOR ===== */
        .row-indikator-detail.status-normal {
            background-color: #ffffff !important;
        }
        .row-indikator-detail.status-edited {
            background-color: #fff3cd !important;
            border-left: 4px solid #f39c12 !important;
        }
        .row-indikator-detail.status-edited td {
            background-color: #fff3cd !important;
        }
        .row-indikator-detail .col-indikator-kinerja-item {
            text-align: left;
            padding-left: 8px !important;
            padding-right: 8px !important;
            font-size: 10px;
            background-color: #fafafa !important;
        }
        .row-indikator-detail .col-indikator-kinerja-item .indikator-item {
            display: block;
            line-height: 1.3;
        }
        .row-indikator-detail .col-indikator-kinerja-item .indikator-item .text-indikator {
            display: block;
            line-height: 1.3;
        }
        
        /* ===== TABEL DETAIL INDIKATOR ===== */
        .table-detail-indikator thead th {
            background-color: #f8f9fa;
            font-size: 9px;
            padding: 3px 4px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }
        .table-detail-indikator thead th.rowspan-header {
            background-color: #e9ecef;
            font-weight: 700;
            font-size: 9px;
        }
        .table-detail-indikator thead th.sub-header {
            background-color: #f1f3f5;
            font-weight: 600;
            font-size: 8px;
        }
        .table-detail-indikator thead th.header-indikator {
            background-color: #d4e6f1;
            font-weight: 700;
            font-size: 9px;
            color: #1a5276;
            padding: 3px 4px;
        }
        .table-detail-indikator td {
            padding: 4px 3px;
            font-size: 10px;
        }
        .table-detail-indikator td.rp {
            font-size: 9px;
            white-space: nowrap;
        }
        
        /* ===== CSS UNTUK KOLOM BIDANG & PENGAMPU ===== */
.bidang-pengampu-cell {
    font-size: 9px;
    min-width: 180px;
    max-width: 250px;
    white-space: normal;
    word-wrap: break-word;
    line-height: 1.4;
}

.bidang-pengampu-cell .bidang-label {
    font-weight: 700;
    color: #1a5276;
    display: block;
}

.bidang-pengampu-cell .pengampu-label {
    font-weight: 700;
    color: #8e44ad;
    display: block;
    margin-top: 3px;
}

.bidang-pengampu-cell .pengampu-detail {
    display: block;
    padding-left: 8px;
}

.bidang-pengampu-cell .jabatan-text {
    font-weight: 600;
    color: #2c3e50;
}

.bidang-pengampu-cell .nama-text {
    font-weight: 400;
    color: #34495e;
}

.bidang-pengampu-cell .pengampu-simple {
    display: block;
    padding-left: 8px;
    color: #34495e;
}
        
        /* ===== PENGAMPU INFO MODAL ===== */
        .pengampu-info-modal {
            margin-top: 8px;
            padding: 8px 12px;
            background: #f0f8ff;
            border-radius: 4px;
            border-left: 3px solid #007bff;
            display: none;
            font-size: 12px;
        }
        .pengampu-info-modal .label {
            font-weight: 600;
            color: #495057;
        }
        .pengampu-info-modal .nama {
            font-weight: 600;
            color: #2c3e50;
        }
        .pengampu-info-modal .jabatan {
            color: #6c757d;
            margin-left: 5px;
        }
        .pengampu-info-modal .nip {
            color: #999;
            font-size: 10px;
            margin-left: 5px;
        }
        
        /* ===== LOKASI ===== */
        .lokasi-container {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            padding: 4px 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            background: #fff;
            min-height: 34px;
            height: auto;
            max-height: 80px;
            overflow-y: auto;
        }
        .lokasi-container .btn-select-lokasi {
            padding: 2px 10px;
            font-size: 11px;
            white-space: nowrap;
            height: 26px;
            line-height: 22px;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .lokasi-container #SelectedLokasiText {
            font-size: 12px;
            color: #2c3e50;
            font-weight: 500;
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
            line-height: 1.5;
            padding: 3px 0;
            flex: 1;
            max-height: 60px;
            overflow-y: auto;
        }
        .lokasi-container #RemoveLokasiBtn {
            cursor: pointer;
            color: #e74c3c;
            font-size: 16px;
            font-weight: bold;
            line-height: 1;
            padding: 2px 4px;
            flex-shrink: 0;
            margin-top: 2px;
            transition: transform 0.2s ease;
        }
        .lokasi-container #RemoveLokasiBtn:hover {
            color: #c0392b;
            transform: scale(1.2);
        }
        .lokasi-container .text-muted {
            font-size: 12px;
            color: #999;
            padding: 3px 0;
        }
        
        /* ===== SELECT2 ===== */
        .select2-container--default .select2-selection--single {
            height: 38px !important;
            border: 1px solid #ced4da !important;
            border-radius: 4px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }
        .select2-dropdown {
            z-index: 9999 !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important;
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
        .modal-open {
            overflow: auto !important;
        }
        .modal-open .modal {
            overflow-y: auto !important;
        }
        .modal-header {
            flex-shrink: 0;
        }
        .modal-footer {
            flex-shrink: 0;
            border-top: 1px solid #e5e5e5;
            padding: 10px 20px;
            background: #fafafa;
            border-radius: 0 0 4px 4px;
        }
        .modal-lg-custom {
            max-width: 95%;
            width: 95%;
        }
        
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
        .info-badge {
            background: #17a2b8;
            color: white;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            margin-left: 5px;
        }
        
        /* ===== LAINNYA ===== */
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
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .table-renja {
                font-size: 10px;
            }
            .table-renja th, .table-renja td {
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
            .badge-status {
                font-size: 8px;
                padding: 2px 6px;
            }
            .bidang-pengampu-cell {
                font-size: 8px;
            }
            .bidang-pengampu-cell .text-jabatan {
                font-size: 7px;
            }
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
                        <!-- FILTER WILAYAH (Sebelum Login)                               -->
                        <!-- ============================================================ -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="filter-section">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
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
                                    <div class="col-lg-3 col-md-6">
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
                                    <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display: <?= !empty($KodeWilayah) ? 'block' : 'none' ?>;">
                                        <div class="filter-group">
                                            <label class="filter-label" for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                                            <select class="form-control" id="FilterInstansiBeforeLogin">
                                                <option value="">-- Semua Instansi --</option>
                                                <?php 
                                                if (!empty($KodeWilayah)) {
                                                    $instansi_list = $this->db->select('id, nama')
                                                        ->from('akun_instansi')
                                                        ->where('kodewilayah', $KodeWilayah)
                                                        ->where('Level', 4)
                                                        ->where('deleted_at IS NULL')
                                                        ->order_by('nama', 'ASC')
                                                        ->get()
                                                        ->result_array();
                                                    
                                                    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                                    foreach ($instansi_list as $ins) {
                                                        $selected = ($filter_instansi_id == $ins['id']) ? 'selected' : '';
                                                        echo '<option value="' . html_escape($ins['id']) . '" ' . $selected . '>' . html_escape($ins['nama']) . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="filter-group" style="margin-top: 28px;">
                                            <button class="btn btn-primary btn-block" id="Filter">
                                                <b>Filter</b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                    <?php 
                                    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                    if (!empty($filter_instansi_id)) { 
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                                    ?>
                                        <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- FILTER INSTANSI (Sudah Login, Bukan Role 4)                  -->
                        <!-- ============================================================ -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="filter-section">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="filter-group">
                                            <label class="filter-label" for="FilterInstansi">
                                                <b>Filter Instansi</b>
                                                
                                            </label>
                                            <select class="form-control" id="FilterInstansi">
                                                <option value="">-- Semua Instansi --</option>
                                                <?php foreach ($ListInstansi as $ins) { ?>
                                                    <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                        <?= html_escape($ins['nama']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="filter-group" style="margin-top: 28px;">
                                            <button class="btn btn-primary btn-block" id="FilterInstansiBtn">
                                                <i class="fa fa-search"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="filter-group" style="margin-top: 28px;">
                                            <button class="btn btn-default btn-block" id="ResetFilterBtn">
                                                <i class="fa fa-times"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- INFO INSTANSI (Role 4)                                       -->
                        <!-- ============================================================ -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TOMBOL TAMBAH HEADER                                         -->
                        <!-- ============================================================ -->
                        <?php if ($IsRole4) { ?>
                            <div style="margin-bottom: 20px;">
                                <button class="btn btn-success" id="BtnTambahHeader">
                                    <i class="notika-icon notika-plus"></i> <b>Tambah Header Renja</b>
                                </button>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TABEL RENJA DENGAN KOLOM STATUS                              -->
                        <!-- ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-renja">
                                <thead>
                                    <tr>
                                        <th style="min-width:120px;">Kode Rekening</th>
                                        <th style="min-width:200px;">Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan Perangkat Daerah</th>
                                        <th style="width:80px;">Jumlah Indikator</th>
                                        <?php if ($IsRole4) { ?>
                                            <th style="width:80px;">STATUS</th>
                                            <th style="width:120px;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($RenjaData)) { ?>
                                        <?php foreach ($RenjaData as $row) { 
                                            $hasNotif = false;
                                            $statusClass = 'status-normal';
                                            if (!empty($row['details'])) {
                                                foreach ($row['details'] as $det) {
                                                    if (!empty($det['edited_by_daerah']) && $det['edited_by_daerah'] == 1) {
                                                        $hasNotif = true;
                                                        $statusClass = 'status-edited';
                                                        break;
                                                    }
                                                }
                                            }
                                        ?>
                                            <!-- HEADER ROW -->
                                            <tr class="header-row <?= $statusClass ?>" 
                                                data-header-id="<?= $row['id'] ?>" 
                                                data-expanded="false">
                                                <td class="text-left header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <strong><?= html_escape($row['kode_rekening'] ?: '-') ?></strong>
                                                </td>
                                                <td class="uraian header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?php 
                                                    $display_text = '';
                                                    if (!empty($row['sub_kegiatan'])) {
                                                        $display_text = $row['sub_kegiatan'];
                                                    } elseif (!empty($row['kegiatan'])) {
                                                        $display_text = $row['kegiatan'];
                                                    } elseif (!empty($row['program'])) {
                                                        $display_text = $row['program'];
                                                    } elseif (!empty($row['sasaran'])) {
                                                        $display_text = $row['sasaran'];
                                                    } elseif (!empty($row['tujuan'])) {
                                                        $display_text = $row['tujuan'];
                                                    } else {
                                                        $display_text = '-';
                                                    }
                                                    echo nl2br(html_escape($display_text));
                                                    ?>
                                                </td>
                                                <td class="text-center header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <span class="badge badge-detail">
                                                        <i class="fa fa-list"></i> <?= $row['detail_count'] ?? 0 ?>
                                                    </span>
                                                </td>
                                                <?php if ($IsRole4) { ?>
                                                    <!-- KOLOM STATUS HEADER -->
                                                    <td class="text-center">
                                                        <?php if ($hasNotif) { ?>
                                                            <span class="badge-status badge-status-edited">
                                                                <i class="fa fa-edit"></i> Diedit Daerah
                                                            </span>
                                                        <?php } else { ?>
                                                            <span class="badge-status badge-status-normal">
                                                                <i class="fa fa-check-circle"></i> Normal
                                                            </span>
                                                        <?php } ?>
                                                    </td>
                                                    <!-- KOLOM AKSI HEADER -->
                                                    <td class="text-center">
                                                        <div class="btn-group-aksi">
                                                            <button class="btn btn-warning btn-sm BtnEditHeader"
                                                                data-id="<?= $row['id'] ?>"
                                                                data-kode-rekening="<?= html_escape($row['kode_rekening'] ?? '') ?>"
                                                                data-tujuan="<?= html_escape($row['tujuan'] ?? '') ?>"
                                                                data-sasaran="<?= html_escape($row['sasaran'] ?? '') ?>"
                                                                data-program="<?= html_escape($row['program'] ?? '') ?>"
                                                                data-kegiatan="<?= html_escape($row['kegiatan'] ?? '') ?>"
                                                                data-sub-kegiatan="<?= html_escape($row['sub_kegiatan'] ?? '') ?>"
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
                                            
                                            <!-- DETAIL ROW - INDIKATOR -->
                                            <?php if (!empty($row['details'])) { ?>
                                                <tr class="detail-row detail-hidden" data-header-id="<?= $row['id'] ?>">
                                                    <td colspan="6" style="padding:0;">
                                                        <div class="detail-container">
                                                            <table class="table table-bordered table-condensed table-detail-indikator" style="margin:0; font-size:10px; min-width:1500px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th rowspan="2" class="header-indikator" style="width:12%; vertical-align:middle; min-width:120px;">
                                                                            <span style="font-size:10px; font-weight:800;">INDIKATOR KINERJA</span>
                                                                        </th>
                                                                        <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">Satuan</th>
                                                                        <th rowspan="2" style="width:8%;vertical-align:middle; font-size:9px;">Lokasi</th>
                                                                        <th rowspan="2" style="width:6%;vertical-align:middle; font-size:9px;">Prioritas Daerah</th>
                                                                        <th rowspan="2" style="width:6%;vertical-align:middle; font-size:9px;">Prioritas Nasional</th>
                                                                        
                                                                        <th colspan="2" style="width:8%;text-align:center;background:#e9ecef; font-size:9px;">Ranwal Renja</th>
                                                                        <th colspan="2" style="width:8%;text-align:center;background:#e9ecef; font-size:9px;">Rancangan Renja</th>
                                                                        <th colspan="2" style="width:8%;text-align:center;background:#e9ecef; font-size:9px;">Ranhir Renja</th>
                                                                        <th colspan="2" style="width:8%;text-align:center;background:#e9ecef; font-size:9px;">Renja</th>
                                                                        <th colspan="2" style="width:8%;text-align:center;background:#e9ecef; font-size:9px;">DPA Murni</th>
                                                                        
                                                                        <th rowspan="2" style="width:4%;vertical-align:middle; font-size:9px;">Sumber</th>
                                                                        
                                                                        <th colspan="2" style="width:8%;text-align:center;background:#e9ecef; font-size:9px;">DPA Perubahan</th>
                                                                        
                                                                        <th rowspan="2" style="width:10%;vertical-align:middle; font-size:9px; min-width:120px;">Bidang & Pengampu</th>
                                                                        
                                                                        <?php if ($IsRole4) { ?>
                                                                            <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">STATUS</th>
                                                                            <th rowspan="2" style="width:4%;vertical-align:middle; font-size:9px;">AKSI</th>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:4%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($row['details'] as $index => $detail) { 
                                                                        $isEdited = !empty($detail['edited_by_daerah']) && $detail['edited_by_daerah'] == 1;
                                                                        $statusClassRow = $isEdited ? 'status-edited' : 'status-normal';
                                                                        
                                                                        // Format lokasi
                                                                        $lokasi_text = '-';
                                                                        if (!empty($detail['lokasi'])) {
                                                                            if (strpos($detail['lokasi'], 'manual_') === 0) {
                                                                                $lokasi_text = $detail['lokasi_nama'] ?? $detail['lokasi'];
                                                                            } else {
                                                                                $lokasi_data = $this->db->select('Nama')->from('kodewilayah')->where('Kode', $detail['lokasi'])->get()->row_array();
                                                                                $lokasi_text = $lokasi_data ? $lokasi_data['Nama'] : $detail['lokasi'];
                                                                            }
                                                                        }
                                                                    ?>
                                                                        <tr class="row-indikator-detail <?= $statusClassRow ?>" 
                                                                            data-detail-id="<?= $detail['id'] ?>" 
                                                                            data-edited="<?= $isEdited ? '1' : '0' ?>">
                                                                            
                                                                            <!-- INDIKATOR KINERJA -->
                                                                            <td class="col-indikator-kinerja-item">
                                                                                <div class="indikator-item">
                                                                                    <span class="text-indikator">
                                                                                        <?= nl2br(html_escape($detail['indikator_kinerja'] ?? '-')) ?>
                                                                                        <?php if (!empty($detail['sumber_data_id'])) { ?>
                                                                                            <span class="badge badge-info" style="font-size:7px; background:#17a2b8; color:#fff;" 
                                                                                                title="ID sumber dari Renja PD: <?= $detail['sumber_data_id'] ?>">
                                                                                                <i class="fa fa-link"></i>
                                                                                            </span>
                                                                                        <?php } ?>
                                                                                    </span>
                                                                                    <?php if ($isEdited) { ?>
                                                                                        <div class="badge-daerah-edit">
                                                                                            <i class="fa fa-edit"></i> Diedit Daerah
                                                                                            <br>
                                                                                            <span class="badge-edit-time"><?= date('d/m/Y H:i', strtotime($detail['daerah_edit_time'])) ?></span>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td><?= html_escape($detail['satuan'] ?? '-') ?></td>
                                                                            <td><?= html_escape($lokasi_text) ?></td>
                                                                            <td><?= html_escape($detail['prioritas_daerah'] ?? '-') ?></td>
                                                                            <td><?= html_escape($detail['prioritas_nasional'] ?? '-') ?></td>
                                                                            
                                                                            <!-- RANWAL RENJA -->
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['ranwal_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['ranwal_rp']) ? 'Rp ' . number_format($detail['ranwal_rp'], 0, ',', '.') : '-' ?></td>
                                                                            
                                                                            <!-- RANCANGAN RENJA -->
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['rancangan_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['rancangan_rp']) ? 'Rp ' . number_format($detail['rancangan_rp'], 0, ',', '.') : '-' ?></td>
                                                                            
                                                                            <!-- RANHIR RENJA -->
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['ranhir_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['ranhir_rp']) ? 'Rp ' . number_format($detail['ranhir_rp'], 0, ',', '.') : '-' ?></td>
                                                                            
                                                                            <!-- RENJA -->
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['renja_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['renja_rp']) ? 'Rp ' . number_format($detail['renja_rp'], 0, ',', '.') : '-' ?></td>
                                                                            
                                                                            <!-- DPA MURNI -->
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['dpa_murni_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['dpa_murni_rp']) ? 'Rp ' . number_format($detail['dpa_murni_rp'], 0, ',', '.') : '-' ?></td>
                                                                            
                                                                            <!-- SUMBER DANA -->
                                                                            <td><?= html_escape($detail['sumber_dana'] ?? '-') ?></td>
                                                                            
                                                                            <!-- DPA PERUBAHAN -->
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['dpa_perubahan_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['dpa_perubahan_rp']) ? 'Rp ' . number_format($detail['dpa_perubahan_rp'], 0, ',', '.') : '-' ?></td>
                                                                            
                                                                            <!-- ===== BIDANG & PENGAMPU - TAMPILKAN JABATAN DAN NAMA ===== -->
                                                                            <td class="bidang-pengampu-cell">
                                                                                <?php 
                                                                                $bidang_text = '';
                                                                                $jabatan_text = '';
                                                                                $nama_text = '';
                                                                                
                                                                                // Data Bidang
                                                                                if (!empty($detail['bidang_pengampu_nama'])) {
                                                                                    $bidang_text = html_escape($detail['bidang_pengampu_nama']);
                                                                                }
                                                                                
                                                                                // Data Pengampu - TAMPILKAN JABATAN DAN NAMA
                                                                                $pengampu_nama = $detail['pengampu_nama'] ?? '';
                                                                                $pengampu_jabatan = $detail['pengampu_jabatan'] ?? '';
                                                                                
                                                                                if (!empty($pengampu_nama) && !empty($pengampu_jabatan)) {
                                                                                    // Ada jabatan dan nama
                                                                                    $jabatan_text = html_escape($pengampu_jabatan);
                                                                                    $nama_text = html_escape($pengampu_nama);
                                                                                } elseif (!empty($pengampu_nama)) {
                                                                                    // Hanya nama
                                                                                    $nama_text = html_escape($pengampu_nama);
                                                                                }
                                                                                
                                                                                // Output
                                                                                if ($bidang_text) {
                                                                                    echo '<span class="bidang-label">Bidang: ' . $bidang_text . '</span>';
                                                                                }
                                                                                
                                                                                if ($jabatan_text && $nama_text) {
                                                                                    echo '<span class="pengampu-label">Pengampu:</span>';
                                                                                    echo '<span class="pengampu-detail">';
                                                                                    echo '<span class="jabatan-text">' . $jabatan_text . '</span>';
                                                                                    echo '<span class="nama-text"> - ' . $nama_text . '</span>';
                                                                                    echo '</span>';
                                                                                } elseif ($nama_text) {
                                                                                    echo '<span class="pengampu-label">Pengampu:</span>';
                                                                                    echo '<span class="pengampu-simple">' . $nama_text . '</span>';
                                                                                }
                                                                                
                                                                                if (empty($bidang_text) && empty($nama_text)) {
                                                                                    echo '-';
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            
                                                                            <?php if ($IsRole4) { ?>
                                                                                <!-- STATUS DETAIL -->
                                                                                <td>
                                                                                    <?php if ($isEdited) { ?>
                                                                                        <span class="badge-status badge-status-edited">
                                                                                            <i class="fa fa-edit"></i> Diedit Daerah
                                                                                        </span>
                                                                                    <?php } else { ?>
                                                                                        <span class="badge-status badge-status-normal">
                                                                                            <i class="fa fa-check-circle"></i> Normal
                                                                                        </span>
                                                                                    <?php } ?>
                                                                                </td>
                                                                                
                                                                                <!-- AKSI DETAIL -->
                                                                                <td>
                                                                                    <div class="btn-group-aksi">
                                                                                        <button class="btn btn-warning btn-xs BtnEditDetail"
                                                                                            data-id="<?= $detail['id'] ?>"
                                                                                            data-header-id="<?= $row['id'] ?>"
                                                                                            data-edited="<?= $isEdited ? '1' : '0' ?>"
                                                                                            title="Edit Indikator"
                                                                                            type="button">
                                                                                            <i class="notika-icon notika-edit"></i>
                                                                                        </button>
                                                                                        <button class="btn btn-danger btn-xs BtnHapusDetail"
                                                                                            data-id="<?= $detail['id'] ?>"
                                                                                            title="Hapus Indikator"
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
                                            
                                            <!-- BARIS TAMBAH INDIKATOR -->
                                            <?php if ($IsRole4) { ?>
                                                <tr class="detail-row detail-hidden" data-header-id="<?= $row['id'] ?>" style="background:#fafafa;">
                                                    <td colspan="6" class="text-center" style="padding:5px;">
                                                        <button class="btn btn-success btn-sm btn-add-detail"
                                                            data-header-id="<?= $row['id'] ?>"
                                                            data-kode-rekening="<?= html_escape($row['kode_rekening'] ?? '-') ?>"
                                                            title="Tambah Indikator"
                                                            type="button">
                                                            <i class="notika-icon notika-plus"></i> Tambah Indikator
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="6" class="text-center no-data">
                                                <i class="fa fa-inbox" style="font-size: 40px; display: block; color: #ddd;"></i>
                                                <strong>Belum ada data Renja</strong>
                                                <?php if ($IsRole4) { ?>
                                                    <br>
                                                    <small class="text-muted">Klik tombol <strong>"Tambah Header Renja"</strong> untuk mulai mengisi data.</small>
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
<!-- MODAL HEADER                                                  -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalHeader" role="dialog">
    <div class="modal-dialog modal-lg" style="position: absolute;left: 50%;top: 45%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>
                    <b id="ModalHeaderTitle">Tambah Header Renja PD</b>
                    <span class="mode-indicator mode-tambah" id="ModeIndicator">TAMBAH</span>
                </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="HeaderId" value="0">
                <input type="hidden" id="IsEditMode" value="0">
                
                <ul class="nav nav-tabs" id="headerTab">
                    <li class="active"><a href="#tab_nomenklatur_header" data-toggle="tab">📋 Pilih dari Nomenklatur</a></li>
                    <li><a href="#tab_manual_header" data-toggle="tab">✏️ Isi Manual</a></li>
                </ul>
                
                <div class="tab-content" style="margin-top: 20px;">
                    
                    <!-- TAB NOMENKLATUR -->
                    <div class="tab-pane fade in active" id="tab_nomenklatur_header">
                        <div class="nomenklatur-container">
                            <div class="panel-heading">
                                <b>📋 Pilih dari Nomenklatur (Berjenjang)</b>
                            </div>
                            <div class="panel-body">
                                
                                <div class="breadcrumb-nomenklatur" id="breadcrumb_nomenklatur_header">
                                    <span class="badge">📁 Jalur Pilihan</span>
                                    <span id="path_display_header">Belum ada yang dipilih</span>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 cascading-select">
                                        <label><b>1. Urusan</b></label>
                                        <select class="form-control" id="header_select_urusan">
                                            <option value="">-- Pilih Urusan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 cascading-select">
                                        <label><b>2. Bidang Urusan</b></label>
                                        <select class="form-control" id="header_select_bidang_urusan" disabled>
                                            <option value="">-- Pilih Bidang Urusan --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 cascading-select">
                                        <label><b>3. Program</b></label>
                                        <select class="form-control" id="header_select_program" disabled>
                                            <option value="">-- Pilih Program --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 cascading-select">
                                        <label><b>4. Kegiatan</b></label>
                                        <select class="form-control" id="header_select_kegiatan" disabled>
                                            <option value="">-- Pilih Kegiatan --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 cascading-select">
                                        <label><b>5. Sub Kegiatan</b></label>
                                        <select class="form-control" id="header_select_sub_kegiatan" disabled>
                                            <option value="">-- Pilih Sub Kegiatan --</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="info-nomenklatur" id="info_nomenklatur_header" style="display:none;">
                                    <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_text_header"></span>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="panel panel-default preview-panel">
                            <div class="panel-heading">
                                <b>📝 Preview Hasil Pilihan</b>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><b>Kode Rekening (NO)</b></label>
                                    <input type="text" class="form-control" id="preview_kode_header" readonly style="background:#f1f8e9; font-family: monospace;">
                                </div>
                                <div class="form-group">
                                    <label><b>Uraian Lengkap</b></label>
                                    <textarea class="form-control" id="preview_uraian_header" rows="4" readonly style="background:#f1f8e9;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TAB MANUAL -->
                    <div class="tab-pane fade" id="tab_manual_header">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>✏️ Isi Manual</b>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><b>Kode Rekening (NO)</b></label>
                                    <input type="text" class="form-control" id="KodeRekeningManual" placeholder="Isi kode rekening manual...">
                                </div>
                                <div class="form-group">
                                    <label><b>TUJUAN</b></label>
                                    <textarea class="form-control" id="TujuanManual" rows="2" placeholder="Isi tujuan..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>SASARAN</b></label>
                                    <textarea class="form-control" id="SasaranManual" rows="2" placeholder="Isi sasaran..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>PROGRAM</b></label>
                                    <textarea class="form-control" id="ProgramManual" rows="2" placeholder="Isi program..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>KEGIATAN</b></label>
                                    <textarea class="form-control" id="KegiatanManual" rows="2" placeholder="Isi kegiatan..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>SUB KEGIATAN</b></label>
                                    <textarea class="form-control" id="SubKegiatanManual" rows="2" placeholder="Isi sub kegiatan..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Tahun</b></label>
                            <select class="form-control" id="TahunHeader">
                                <?php for ($thn = 2025; $thn <= 2030; $thn++) { ?>
                                    <option value="<?= $thn ?>" <?= ($thn == date('Y')) ? 'selected' : '' ?>>
                                        <?= $thn ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
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
<!-- MODAL DETAIL                                                  -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalDetail" role="dialog">
    <div class="modal-dialog modal-lg-custom" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content" style="max-height: 95vh; overflow: hidden;">
            <div class="modal-header" style="flex-shrink: 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b id="ModalDetailTitle">Tambah Indikator</b></h4>
                <small id="DetailHeaderInfo" class="text-muted"></small>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 15px 20px;">
                <input type="hidden" id="DetailId" value="0">
                <input type="hidden" id="DetailHeaderId" value="0">
                
                <!-- INDIKATOR KINERJA -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Indikator Kinerja</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="IndikatorKinerja" rows="3" placeholder="Masukkan indikator kinerja..."></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- SATUAN & LOKASI & PRIORITAS -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Satuan</b></label>
                            <input type="text" class="form-control" id="Satuan" placeholder="%" style="height: 34px;">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><b>Lokasi</b></label>
                            <div class="lokasi-container">
                                <button type="button" class="btn btn-info btn-xs btn-select-lokasi" 
                                        data-toggle="modal" data-target="#ModalLokasi" 
                                        style="padding: 2px 10px; font-size: 11px; white-space: nowrap; height: 26px; line-height: 22px; flex-shrink: 0; margin-top: 2px;">
                                    <i class="fa fa-map-marker"></i> Pilih
                                </button>
                                
                                <span id="LokasiPlaceholder" class="text-muted" style="font-size: 12px; color: #999; padding: 3px 0;">Belum ada</span>
                                <span id="SelectedLokasiText" style="display: none; font-size: 12px; color: #2c3e50; font-weight: 500; white-space: normal; word-wrap: break-word; word-break: break-word; line-height: 1.5; padding: 3px 0; flex: 1; max-height: 60px; overflow-y: auto;"></span>
                                <span id="RemoveLokasiBtn" style="display: none; cursor: pointer; color: #e74c3c; font-size: 16px; font-weight: bold; line-height: 1; padding: 2px 4px; flex-shrink: 0; margin-top: 2px;" onclick="removeSelectedLokasi()">✖</span>
                                
                                <input type="hidden" id="LokasiKode" value="">
                                <input type="hidden" id="LokasiNama" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Prioritas Daerah</b></label>
                            <input type="text" class="form-control" id="PrioritasDaerah" placeholder="Prioritas daerah..." style="height: 34px;">
                        </div>
                    </div>
                </div>
                
                <!-- PRIORITAS NASIONAL & SUMBER DANA -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Prioritas Nasional</b></label>
                            <input type="text" class="form-control" id="PrioritasNasional" placeholder="Prioritas nasional..." style="height: 34px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Sumber Dana</b></label>
                            <input type="text" class="form-control" id="SumberDana" placeholder="APBD / APBN / dll" style="height: 34px;">
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- RANWAL RENJA -->
                <h5><b>RANWAL RENJA</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="RanwalKinerja" rows="2" placeholder="Kinerja Ranwal..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="RanwalRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- RANCANGAN RENJA -->
                <h5><b>RANCANGAN RENJA</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="RancanganKinerja" rows="2" placeholder="Kinerja Rancangan..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="RancanganRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- RANHIR RENJA -->
                <h5><b>RANHIR RENJA</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="RanhirKinerja" rows="2" placeholder="Kinerja Ranhir..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="RanhirRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- RENJA -->
                <h5><b>RENJA</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="RenjaKinerja" rows="2" placeholder="Kinerja Renja..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="RenjaRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- DPA MURNI -->
                <h5><b>DPA MURNI</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="DpaMurniKinerja" rows="2" placeholder="Kinerja DPA Murni..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="DpaMurniRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- DPA PERUBAHAN -->
                <h5><b>DPA PERUBAHAN</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="DpaPerubahanKinerja" rows="2" placeholder="Kinerja DPA Perubahan..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="DpaPerubahanRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- ============================================================ -->
                <!-- BIDANG PENGAMPU & PENGAMPU - DENGAN INFO JABATAN              -->
                <!-- ============================================================ -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Bidang Pengampu</b></label>
                            <select class="form-control select2-bidang" id="BidangPengampu" style="width: 100%;">
                                <option value="">-- Pilih Bidang Pengampu --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="PengampuGroup" style="display: none;">
                            <label><b>Pengampu</b></label>
                            <select class="form-control select2-pengampu" id="Pengampu" style="width: 100%;">
                                <option value="">-- Pilih Pengampu --</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- INFO PENGAMPU - MENAMPILKAN JABATAN & NIP                     -->
                <!-- ============================================================ -->
                <div class="pengampu-info-modal" id="PengampuInfoModal">
                    <span class="label">Pengampu:</span>
                    <span class="nama" id="PengampuModalNama"></span>
                    <span class="jabatan" id="PengampuModalJabatan"></span>
                    <span class="nip" id="PengampuModalNip"></span>
                </div>
                
            </div>
            <div class="modal-footer" style="flex-shrink: 0; border-top: 1px solid #e5e5e5; padding: 10px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                <button class="btn btn-success" id="BtnSimpanDetail"><b>SIMPAN INDIKATOR</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL LOKASI                                                  -->
<!-- ============================================================ -->
<div class="modal fade modal-lokasi" id="ModalLokasi" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="max-height: 90vh; overflow: hidden;">
            <div class="modal-header" style="flex-shrink: 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b><i class="fa fa-map-marker"></i> Pilih Lokasi</b></h4>
                <small>Pilih Provinsi dan Kab/Kota</small>
            </div>
            <div class="modal-body" style="max-height: 60vh; overflow-y: auto; padding: 20px 25px;">
                <div class="lokasi-tab">
                    <ul class="nav nav-tabs" id="lokasiTab">
                        <li class="active"><a href="#tab_pilih_lokasi" data-toggle="tab">📋 Pilih dari Daftar</a></li>
                        <li><a href="#tab_manual_lokasi" data-toggle="tab">✏️ Isi Manual</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <!-- TAB PILIH DARI DAFTAR -->
                        <div class="tab-pane fade in active" id="tab_pilih_lokasi">
                            <div style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Provinsi</b></label>
                                            <select class="form-control" id="LokasiProvinsi">
                                                <option value="">-- Pilih Provinsi --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Kab/Kota</b></label>
                                            <select class="form-control" id="LokasiKabKota" disabled>
                                                <option value="">-- Pilih Kab/Kota --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="LokasiInfo" style="display:none; margin-top: 10px; padding: 10px; background: #e8f0fe; border-radius: 4px;">
                                    <strong>Lokasi Terpilih:</strong><br>
                                    <span id="LokasiInfoText">-</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- TAB MANUAL -->
                        <div class="tab-pane fade" id="tab_manual_lokasi">
                            <div class="panel panel-default" style="margin-top: 15px;">
                                <div class="panel-heading">
                                    <b>✏️ Isi Lokasi Manual</b>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label><b>Nama Lokasi</b></label>
                                        <input type="text" class="form-control" id="LokasiManualInput" 
                                               placeholder="Contoh: Kabupaten Bandung, Provinsi Jawa Barat">
                                        <small class="text-muted">Isi manual jika lokasi tidak tersedia di daftar</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="flex-shrink: 0; border-top: 1px solid #e5e5e5; padding: 10px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
                <button type="button" class="btn btn-success" id="BtnPilihLokasi">
                    <b><i class="fa fa-check"></i> PILIH LOKASI</b>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

var __editHeaderId = 0;

// Cache data nomenklatur
var nomenklaturCache = {
    level1: null,
    level2: null,
    level3: null,
    level4: null,
    level5: null
};

// Cache data lokasi
var lokasiCache = {
    provinsi: null,
    kabkota: {}
};

var isLoadingNomenklatur = false;

function countDots(str) {
    if (typeof str !== 'string') return 0;
    return (str.match(/\./g) || []).length;
}

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
// FUNGSI LOKASI
// ================================================================

function loadProvinsi(selectedKode) {
    $('#LokasiProvinsi').html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.ajax({
        url: BaseURL + "Instansi/getProvinsiList",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var options = '<option value="">-- Pilih Provinsi --</option>';
            
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    var selected = (item.Kode === selectedKode) ? 'selected' : '';
                    options += `<option value="${item.Kode}" ${selected}>${escapeHtml(item.Nama)}</option>`;
                });
                lokasiCache.provinsi = data;
            }
            
            $('#LokasiProvinsi').html(options).prop('disabled', false);
            
            if (selectedKode) {
                $('#LokasiProvinsi').val(selectedKode).trigger('change');
            }
        },
        error: function() {
            $('#LokasiProvinsi').html('<option value="">Gagal memuat data provinsi</option>').prop('disabled', false);
        }
    });
}

function loadKabKota(kodeProvinsi, selectedKode) {
    if (!kodeProvinsi) {
        $('#LokasiKabKota').html('<option value="">-- Pilih Kab/Kota --</option>').prop('disabled', true);
        $('#LokasiInfo').hide();
        return;
    }
    
    if (lokasiCache.kabkota[kodeProvinsi]) {
        populateKabKota(lokasiCache.kabkota[kodeProvinsi], selectedKode);
        return;
    }
    
    $('#LokasiKabKota').html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.ajax({
        url: BaseURL + "Instansi/getKabKotaByProvinsi",
        type: "POST",
        data: { 
            kode_provinsi: kodeProvinsi,
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: "json",
        success: function(data) {
            lokasiCache.kabkota[kodeProvinsi] = data;
            populateKabKota(data, selectedKode);
        },
        error: function() {
            $('#LokasiKabKota').html('<option value="">Gagal memuat data kab/kota</option>').prop('disabled', false);
        }
    });
}

function populateKabKota(data, selectedKode) {
    var options = '<option value="">-- Pilih Kab/Kota --</option>';
    
    if (data && data.length > 0) {
        $.each(data, function(index, item) {
            var selected = (item.Kode === selectedKode) ? 'selected' : '';
            options += `<option value="${item.Kode}" ${selected}>${escapeHtml(item.Nama)}</option>`;
        });
    } else {
        options += '<option value="" disabled>Tidak ada Kab/Kota</option>';
    }
    
    $('#LokasiKabKota').html(options).prop('disabled', false);
    
    if (selectedKode) {
        $('#LokasiKabKota').val(selectedKode).trigger('change');
    }
    
    updateLokasiInfo();
}

function updateLokasiInfo() {
    var provinsiKode = $('#LokasiProvinsi').val();
    var provinsiNama = $('#LokasiProvinsi option:selected').text();
    var kabKotaKode = $('#LokasiKabKota').val();
    var kabKotaNama = $('#LokasiKabKota option:selected').text();
    
    if (provinsiKode && provinsiKode !== '' && kabKotaKode && kabKotaKode !== '') {
        var infoText = kabKotaNama + ', ' + provinsiNama;
        $('#LokasiInfoText').text(infoText);
        $('#LokasiInfo').show();
    } else if (provinsiKode && provinsiKode !== '') {
        $('#LokasiInfoText').text(provinsiNama + ' (Pilih Kab/Kota)');
        $('#LokasiInfo').show();
    } else {
        $('#LokasiInfo').hide();
    }
}

function setSelectedLokasi(kode, nama) {
    $('#LokasiKode').val(kode);
    $('#LokasiNama').val(nama);
    
    $('#LokasiPlaceholder').hide();
    $('#SelectedLokasiText').text(nama).show();
    $('#RemoveLokasiBtn').show();
    
    setTimeout(function() {
        $(window).trigger('resize');
    }, 100);
}

function removeSelectedLokasi() {
    $('#LokasiKode').val('');
    $('#LokasiNama').val('');
    $('#SelectedLokasiText').hide().text('');
    $('#RemoveLokasiBtn').hide();
    $('#LokasiPlaceholder').show();
}

$('#LokasiProvinsi').change(function() {
    var kodeProvinsi = $(this).val();
    loadKabKota(kodeProvinsi, '');
});

$('#LokasiKabKota').change(function() {
    updateLokasiInfo();
});

$('#BtnPilihLokasi').click(function() {
    var activeTab = $('#lokasiTab .active a').attr('href');
    
    if (activeTab === '#tab_pilih_lokasi') {
        var provinsiKode = $('#LokasiProvinsi').val();
        var provinsiNama = $('#LokasiProvinsi option:selected').text();
        var kabKotaKode = $('#LokasiKabKota').val();
        var kabKotaNama = $('#LokasiKabKota option:selected').text();
        
        if (!provinsiKode || provinsiKode === '' || !kabKotaKode || kabKotaKode === '') {
            alert('Silakan pilih Provinsi dan Kab/Kota terlebih dahulu!');
            return;
        }
        
        var fullName = kabKotaNama + ', ' + provinsiNama;
        setSelectedLokasi(kabKotaKode, fullName);
        
    } else if (activeTab === '#tab_manual_lokasi') {
        var manualInput = $('#LokasiManualInput').val().trim();
        
        if (!manualInput) {
            alert('Silakan isi nama lokasi!');
            return;
        }
        
        setSelectedLokasi('manual_' + Date.now(), manualInput);
    }
    
    $('#ModalLokasi').modal('hide');
});

$('#ModalLokasi').on('shown.bs.modal', function() {
    if ($('#LokasiProvinsi option').length <= 1) {
        loadProvinsi('');
    }
});

// ================================================================
// FUNGSI NOMENKLATUR
// ================================================================
function getNomenklatur(level, callback) {
    if (nomenklaturCache['level' + level]) {
        if (callback) callback(nomenklaturCache['level' + level]);
        return;
    }
    
    if (isLoadingNomenklatur) {
        var checkInterval = setInterval(function() {
            if (!isLoadingNomenklatur) {
                clearInterval(checkInterval);
                if (nomenklaturCache['level' + level]) {
                    if (callback) callback(nomenklaturCache['level' + level]);
                } else {
                    getNomenklatur(level, callback);
                }
            }
        }, 200);
        return;
    }
    
    isLoadingNomenklatur = true;
    
    $.ajax({
        url: BaseURL + "Instansi/getNomenklaturByLevelRenja",
        type: "POST",
        data: { 
            level: level, 
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: 'json',
        success: function(res) {
            nomenklaturCache['level' + level] = res;
            isLoadingNomenklatur = false;
            if (callback) callback(res);
        },
        error: function() {
            isLoadingNomenklatur = false;
            if (callback) callback([]);
        }
    });
}

function loadHeaderUrusan(callback) {
    getNomenklatur(1, function(res) {
        var options = '<option value="">-- Pilih Urusan --</option>';
        for (var i = 0; i < res.length; i++) {
            if (countDots(res[i].Kode) === 0) {
                options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            }
        }
        $('#header_select_urusan').html(options).prop('disabled', false);
        if (callback) callback();
    });
}

function loadHeaderBidangUrusan(kodeUrusan, callback) {
    if (!kodeUrusan) {
        $('#header_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        if (callback) callback();
        return;
    }
    getNomenklatur(2, function(res) {
        var options = '<option value="">-- Pilih Bidang Urusan --</option>';
        for (var i = 0; i < res.length; i++) {
            if (res[i].Kode.indexOf(kodeUrusan + '.') === 0 && countDots(res[i].Kode) === 1) {
                options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            }
        }
        $('#header_select_bidang_urusan').html(options).prop('disabled', options === '<option value="">-- Pilih Bidang Urusan --</option>');
        if (callback) callback();
    });
}

function loadHeaderProgram(kodeBidang, callback) {
    if (!kodeBidang) {
        $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        if (callback) callback();
        return;
    }
    getNomenklatur(3, function(res) {
        var options = '<option value="">-- Pilih Program --</option>';
        for (var i = 0; i < res.length; i++) {
            if (res[i].Kode.indexOf(kodeBidang + '.') === 0 && countDots(res[i].Kode) === 2) {
                options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            }
        }
        $('#header_select_program').html(options).prop('disabled', options === '<option value="">-- Pilih Program --</option>');
        if (callback) callback();
    });
}

function loadHeaderKegiatan(kodeProgram, callback) {
    if (!kodeProgram) {
        $('#header_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        if (callback) callback();
        return;
    }
    getNomenklatur(4, function(res) {
        var options = '<option value="">-- Pilih Kegiatan --</option>';
        for (var i = 0; i < res.length; i++) {
            if (res[i].Kode.indexOf(kodeProgram + '.') === 0 && countDots(res[i].Kode) === 4) {
                options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            }
        }
        $('#header_select_kegiatan').html(options).prop('disabled', options === '<option value="">-- Pilih Kegiatan --</option>');
        if (callback) callback();
    });
}

function loadHeaderSubKegiatan(kodeKegiatan, callback) {
    if (!kodeKegiatan) {
        $('#header_select_sub_kegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        if (callback) callback();
        return;
    }
    getNomenklatur(5, function(res) {
        var options = '<option value="">-- Pilih Sub Kegiatan --</option>';
        for (var i = 0; i < res.length; i++) {
            if (res[i].Kode.indexOf(kodeKegiatan + '.') === 0 && countDots(res[i].Kode) === 5) {
                options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            }
        }
        $('#header_select_sub_kegiatan').html(options).prop('disabled', options === '<option value="">-- Pilih Sub Kegiatan --</option>');
        updateHeaderPreview();
        if (callback) callback();
    });
}

function resetHeaderLowerLevels(startLevel) {
    if (startLevel <= 2) {
        $('#header_select_bidang_urusan').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
    }
    if (startLevel <= 3) {
        $('#header_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    }
    if (startLevel <= 4) {
        $('#header_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
    }
    if (startLevel <= 5) {
        $('#header_select_sub_kegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
    }
    updateHeaderPreview();
}

function updateHeaderPreview() {
    var kode = $('#header_select_sub_kegiatan').val();
    var text = $('#header_select_sub_kegiatan option:selected').text();
    
    if (!kode || kode === "") {
        kode = $('#header_select_kegiatan').val();
        text = $('#header_select_kegiatan option:selected').text();
    }
    if (!kode || kode === "") {
        kode = $('#header_select_program').val();
        text = $('#header_select_program option:selected').text();
    }
    if (!kode || kode === "") {
        kode = $('#header_select_bidang_urusan').val();
        text = $('#header_select_bidang_urusan option:selected').text();
    }
    if (!kode || kode === "") {
        kode = $('#header_select_urusan').val();
        text = $('#header_select_urusan option:selected').text();
    }
    
    if (kode && text) {
        var nomenklatur = text.split(' - ').slice(1).join(' - ');
        $('#preview_kode_header').val(kode);
        $('#preview_uraian_header').val(nomenklatur);
        
        var path = [];
        var urusanText = $('#header_select_urusan option:selected').text().split(' - ')[1];
        if (urusanText) path.push('Urusan: ' + urusanText);
        var bidangText = $('#header_select_bidang_urusan option:selected').text().split(' - ')[1];
        if (bidangText) path.push('Bidang: ' + bidangText);
        var programText = $('#header_select_program option:selected').text().split(' - ')[1];
        if (programText) path.push('Program: ' + programText);
        var kegiatanText = $('#header_select_kegiatan option:selected').text().split(' - ')[1];
        if (kegiatanText) path.push('Kegiatan: ' + kegiatanText);
        var subText = $('#header_select_sub_kegiatan option:selected').text().split(' - ')[1];
        if (subText) path.push('Sub Kegiatan: ' + subText);
        
        $('#path_display_header').html(path.join(' → ') || 'Belum ada yang dipilih');
        $('#info_nomenklatur_header').show();
        $('#selected_nomenklatur_text_header').html(
            '<strong>Kode:</strong> ' + kode + '<br><strong>Uraian:</strong> ' + nomenklatur
        );
    } else {
        $('#preview_kode_header, #preview_uraian_header').val('');
        $('#info_nomenklatur_header').hide();
        $('#path_display_header').html('Belum ada yang dipilih');
    }
}

$('#header_select_urusan').change(function() {
    var kode = $(this).val();
    resetHeaderLowerLevels(2);
    if (kode) loadHeaderBidangUrusan(kode);
});

$('#header_select_bidang_urusan').change(function() {
    var kode = $(this).val();
    resetHeaderLowerLevels(3);
    if (kode) loadHeaderProgram(kode);
});

$('#header_select_program').change(function() {
    var kode = $(this).val();
    resetHeaderLowerLevels(4);
    if (kode) loadHeaderKegiatan(kode);
});

$('#header_select_kegiatan').change(function() {
    var kode = $(this).val();
    resetHeaderLowerLevels(5);
    if (kode) loadHeaderSubKegiatan(kode);
});

$('#header_select_sub_kegiatan').change(function() {
    updateHeaderPreview();
});

function loadEditNomenklatur(kodeRekening, callback) {
    if (kodeRekening === null || kodeRekening === undefined || kodeRekening === '') {
        if (callback) callback();
        return;
    }
    
    var kodeStr = String(kodeRekening).trim();
    if (kodeStr === '') {
        if (callback) callback();
        return;
    }
    
    resetHeaderLowerLevels(1);
    
    var parts = kodeStr.split('.');
    var dotCount = countDots(kodeStr);
    
    function waitForSelect(selector, cb, maxAttempts) {
        var attempts = 0;
        var interval = setInterval(function() {
            attempts++;
            var $select = $(selector);
            var hasOptions = $select.find('option').length > 1;
            
            if (hasOptions || attempts >= maxAttempts) {
                clearInterval(interval);
                if (cb) cb();
            }
        }, 100);
    }
    
    function setSelectValue(selector, value, cb) {
        var $select = $(selector);
        var found = false;
        
        $select.find('option').each(function() {
            if ($(this).val() === value) {
                $(this).prop('selected', true);
                found = true;
            }
        });
        
        if (found) {
            $select.trigger('change');
            if (cb) cb();
        } else {
            if (cb) cb();
        }
    }
    
    if (parts.length === 1 && dotCount === 0) {
        loadHeaderUrusan(function() {
            waitForSelect('#header_select_urusan', function() {
                setSelectValue('#header_select_urusan', kodeStr, function() {
                    setTimeout(function() {
                        updateHeaderPreview();
                        if (callback) callback();
                    }, 300);
                });
            }, 20);
        });
        return;
    }
    
    loadHeaderUrusan(function() {
        waitForSelect('#header_select_urusan', function() {
            if (dotCount === 0) {
                setSelectValue('#header_select_urusan', kodeStr, function() {
                    setTimeout(function() {
                        updateHeaderPreview();
                        if (callback) callback();
                    }, 300);
                });
            } else if (dotCount === 1) {
                setSelectValue('#header_select_urusan', parts[0], function() {
                    setTimeout(function() {
                        loadHeaderBidangUrusan(parts[0], function() {
                            waitForSelect('#header_select_bidang_urusan', function() {
                                setSelectValue('#header_select_bidang_urusan', kodeStr, function() {
                                    setTimeout(function() {
                                        updateHeaderPreview();
                                        if (callback) callback();
                                    }, 300);
                                });
                            }, 20);
                        });
                    }, 300);
                });
            } else if (dotCount === 2) {
                var kodeBidang = parts[0] + '.' + parts[1];
                setSelectValue('#header_select_urusan', parts[0], function() {
                    setTimeout(function() {
                        loadHeaderBidangUrusan(parts[0], function() {
                            waitForSelect('#header_select_bidang_urusan', function() {
                                setSelectValue('#header_select_bidang_urusan', kodeBidang, function() {
                                    setTimeout(function() {
                                        loadHeaderProgram(kodeBidang, function() {
                                            waitForSelect('#header_select_program', function() {
                                                setSelectValue('#header_select_program', kodeStr, function() {
                                                    setTimeout(function() {
                                                        updateHeaderPreview();
                                                        if (callback) callback();
                                                    }, 300);
                                                });
                                            }, 20);
                                        });
                                    }, 300);
                                });
                            }, 20);
                        });
                    }, 300);
                });
            } else if (dotCount === 4) {
                var kodeBidang = parts[0] + '.' + parts[1];
                var kodeProgram = parts[0] + '.' + parts[1] + '.' + parts[2];
                setSelectValue('#header_select_urusan', parts[0], function() {
                    setTimeout(function() {
                        loadHeaderBidangUrusan(parts[0], function() {
                            waitForSelect('#header_select_bidang_urusan', function() {
                                setSelectValue('#header_select_bidang_urusan', kodeBidang, function() {
                                    setTimeout(function() {
                                        loadHeaderProgram(kodeBidang, function() {
                                            waitForSelect('#header_select_program', function() {
                                                setSelectValue('#header_select_program', kodeProgram, function() {
                                                    setTimeout(function() {
                                                        loadHeaderKegiatan(kodeProgram, function() {
                                                            waitForSelect('#header_select_kegiatan', function() {
                                                                setSelectValue('#header_select_kegiatan', kodeStr, function() {
                                                                    setTimeout(function() {
                                                                        updateHeaderPreview();
                                                                        if (callback) callback();
                                                                    }, 300);
                                                                });
                                                            }, 20);
                                                        });
                                                    }, 300);
                                                });
                                            }, 20);
                                        });
                                    }, 300);
                                });
                            }, 20);
                        });
                    }, 300);
                });
            } else if (dotCount === 5) {
                var kodeBidang = parts[0] + '.' + parts[1];
                var kodeProgram = parts[0] + '.' + parts[1] + '.' + parts[2];
                var kodeKegiatan = parts.slice(0, 5).join('.');
                setSelectValue('#header_select_urusan', parts[0], function() {
                    setTimeout(function() {
                        loadHeaderBidangUrusan(parts[0], function() {
                            waitForSelect('#header_select_bidang_urusan', function() {
                                setSelectValue('#header_select_bidang_urusan', kodeBidang, function() {
                                    setTimeout(function() {
                                        loadHeaderProgram(kodeBidang, function() {
                                            waitForSelect('#header_select_program', function() {
                                                setSelectValue('#header_select_program', kodeProgram, function() {
                                                    setTimeout(function() {
                                                        loadHeaderKegiatan(kodeProgram, function() {
                                                            waitForSelect('#header_select_kegiatan', function() {
                                                                setSelectValue('#header_select_kegiatan', kodeKegiatan, function() {
                                                                    setTimeout(function() {
                                                                        loadHeaderSubKegiatan(kodeKegiatan, function() {
                                                                            waitForSelect('#header_select_sub_kegiatan', function() {
                                                                                setSelectValue('#header_select_sub_kegiatan', kodeStr, function() {
                                                                                    setTimeout(function() {
                                                                                        updateHeaderPreview();
                                                                                        if (callback) callback();
                                                                                    }, 300);
                                                                                });
                                                                            }, 20);
                                                                        });
                                                                    }, 300);
                                                                });
                                                            }, 20);
                                                        });
                                                    }, 300);
                                                });
                                            }, 20);
                                        });
                                    }, 300);
                                });
                            }, 20);
                        });
                    }, 300);
                });
            }
        }, 20);
    });
}

// ================================================================
// FILTER WILAYAH
// ================================================================
<?php if (!isset($_SESSION['KodeWilayah'])) { ?>
    
    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiGroupBefore").hide();
            return;
        }
        
        $.ajax({
            url: BaseURL + "Instansi/GetListKabKota",
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
                alert("Gagal memuat data Kab/Kota");
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
            url: BaseURL + "Instansi/GetListInstansiLevel4",
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
            <?php if (!empty($FilterInstansiId)) { ?>
                setTimeout(function() {
                    if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
                        $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
                    }
                }, 500);
            <?php } ?>
        }, 300);
    <?php } ?>

    $("#Filter").click(function() {
        var provinsi = $("#Provinsi").val();
        var kabKota = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        if (provinsi === "") { 
            alert("Mohon Pilih Provinsi"); 
            return; 
        }
        if (kabKota === "") { 
            alert("Mohon Pilih Kab/Kota"); 
            return; 
        }

        $("#Filter").prop('disabled', true).text('Memuat...');
        
        $.ajax({
            url: BaseURL + "Instansi/SetTempKodeWilayah",
            type: "POST",
            data: { 
                KodeWilayah: kabKota,
                InstansiId: instansiId || '',
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: 'json',
            success: function(res) {
                if (res === '1' || res === 1) {
                    var redirectUrl = BaseURL + "Instansi/RenjaPD";
                    if (instansiId && instansiId != '') {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert("Gagal menghubungi server! Status: " + status);
                $("#Filter").prop('disabled', false).text('Filter');
            }
        });
    });

<?php } ?>

<?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    $("#FilterInstansiBtn").click(function() {
        var instansiId = $("#FilterInstansi").val();
        var url = BaseURL + "Instansi/RenjaPD";
        if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
        window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() { 
        window.location.href = BaseURL + "Instansi/RenjaPD"; 
    });
<?php } ?>

// ================================================================
// TOMBOL TAMBAH HEADER
// ================================================================
$(document).off('click', '#BtnTambahHeader').on('click', '#BtnTambahHeader', function(e) {
    e.preventDefault();
    
    __editHeaderId = 0;
    $('#HeaderId').val(0);
    $('#IsEditMode').val(0);
    $('#ModalHeaderTitle').text('Tambah Header Renja PD');
    $('#ModeIndicator').removeClass('mode-edit').addClass('mode-tambah').text('TAMBAH');
    
    $('#KodeRekeningManual, #TujuanManual, #SasaranManual, #ProgramManual, #KegiatanManual, #SubKegiatanManual').val('');
    $('#preview_kode_header, #preview_uraian_header').val('');
    $('#info_nomenklatur_header').hide();
    $('#path_display_header').html('Belum ada yang dipilih');
    resetHeaderLowerLevels(1);
    $('#TahunHeader').val('<?= date('Y') ?>');
    
    nomenklaturCache = {
        level1: null,
        level2: null,
        level3: null,
        level4: null,
        level5: null
    };
    
    loadHeaderUrusan(function() {
        $('a[href="#tab_nomenklatur_header"]').tab('show');
        $('#ModalHeader').modal('show');
    });
});

// ================================================================
// TOMBOL EDIT HEADER
// ================================================================
$(document).off('click', '.BtnEditHeader').on('click', '.BtnEditHeader', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    showLoading();
    
    var $btn = $(this);
    var id = $btn.data('id') || 0;
    var kodeRekening = String($btn.data('kode-rekening') || '').trim();
    var tujuan = $btn.data('tujuan') || '';
    var sasaran = $btn.data('sasaran') || '';
    var program = $btn.data('program') || '';
    var kegiatan = $btn.data('kegiatan') || '';
    var subKegiatan = $btn.data('sub-kegiatan') || '';
    var tahun = $btn.data('tahun') || '<?= date('Y') ?>';
    
    __editHeaderId = id;
    $('#HeaderId').val(id);
    $('#IsEditMode').val(1);
    
    $('.BtnEditHeader').removeClass('active-edit');
    $btn.addClass('active-edit');
    
    $('#ModalHeaderTitle').text('Edit Header Renja PD');
    $('#ModeIndicator').removeClass('mode-tambah').addClass('mode-edit').text('EDIT');
    
    $('#KodeRekeningManual').val(kodeRekening);
    $('#TujuanManual').val(tujuan);
    $('#SasaranManual').val(sasaran);
    $('#ProgramManual').val(program);
    $('#KegiatanManual').val(kegiatan);
    $('#SubKegiatanManual').val(subKegiatan);
    $('#TahunHeader').val(tahun);
    
    $('#preview_kode_header, #preview_uraian_header').val('');
    $('#info_nomenklatur_header').hide();
    $('#path_display_header').html('Belum ada yang dipilih');
    resetHeaderLowerLevels(1);
    
    nomenklaturCache = {
        level1: null,
        level2: null,
        level3: null,
        level4: null,
        level5: null
    };
    
    if (kodeRekening && kodeRekening !== '') {
        loadHeaderUrusan(function() {
            loadEditNomenklatur(kodeRekening, function() {
                var hasSelection = false;
                $('#header_select_urusan option:selected').each(function() {
                    if ($(this).val() && $(this).val() !== '') hasSelection = true;
                });
                $('#header_select_bidang_urusan option:selected').each(function() {
                    if ($(this).val() && $(this).val() !== '') hasSelection = true;
                });
                $('#header_select_program option:selected').each(function() {
                    if ($(this).val() && $(this).val() !== '') hasSelection = true;
                });
                $('#header_select_kegiatan option:selected').each(function() {
                    if ($(this).val() && $(this).val() !== '') hasSelection = true;
                });
                $('#header_select_sub_kegiatan option:selected').each(function() {
                    if ($(this).val() && $(this).val() !== '') hasSelection = true;
                });
                
                if (hasSelection) {
                    $('a[href="#tab_nomenklatur_header"]').tab('show');
                } else if (tujuan || sasaran || program || kegiatan || subKegiatan) {
                    $('a[href="#tab_manual_header"]').tab('show');
                } else {
                    $('a[href="#tab_nomenklatur_header"]').tab('show');
                }
                
                hideLoading();
                $('#ModalHeader').modal('show');
            });
        });
    } else if (tujuan || sasaran || program || kegiatan || subKegiatan) {
        $('a[href="#tab_manual_header"]').tab('show');
        hideLoading();
        $('#ModalHeader').modal('show');
    } else {
        loadHeaderUrusan(function() {
            $('a[href="#tab_nomenklatur_header"]').tab('show');
            hideLoading();
            $('#ModalHeader').modal('show');
        });
    }
});

// ================================================================
// TOMBOL HAPUS HEADER
// ================================================================
$(document).off('click', '.BtnHapusHeader').on('click', '.BtnHapusHeader', function(e) {
    e.preventDefault();
    e.stopPropagation();
    
    var id = $(this).data('id');
    
    if (!id) {
        alert('ID tidak valid!');
        return;
    }
    
    if (!confirm("Yakin hapus header dan semua indikatornya?")) return;
    
    showLoading();
    
    $.ajax({
        url: BaseURL + "Instansi/hapusRenjaHeader",
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
// TOMBOL TAMBAH DETAIL
// ================================================================
$(document).off('click', '.btn-add-detail').on('click', '.btn-add-detail', function(e) {
    e.preventDefault();
    var headerId = $(this).data('header-id');
    var kodeRekening = $(this).data('kode-rekening') || '-';
    
    $('#DetailId').val(0);
    $('#DetailHeaderId').val(headerId);
    $('#DetailHeaderInfo').text('Kode Rekening: ' + kodeRekening);
    $('#ModalDetailTitle').text('Tambah Indikator');
    
    $('#IndikatorKinerja, #Satuan, #PrioritasDaerah, #PrioritasNasional, #RanwalKinerja, #RanwalRp, #RancanganKinerja, #RancanganRp, #RanhirKinerja, #RanhirRp, #RenjaKinerja, #RenjaRp, #DpaMurniKinerja, #DpaMurniRp, #SumberDana, #DpaPerubahanKinerja, #DpaPerubahanRp').val('');
    removeSelectedLokasi();
    $('#BidangPengampu').val('').trigger('change');
    $('#PengampuGroup').hide();
    $('#Pengampu').val('').trigger('change');
    $('#PengampuInfoModal').hide();
    loadBidangPengampuOptions('');
    
    $('#ModalDetail').modal('show');
});

// ================================================================
// TOMBOL EDIT DETAIL
// ================================================================
$(document).off('click', '.BtnEditDetail').on('click', '.BtnEditDetail', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var headerId = $(this).data('header-id') || 0;
    
    if (!id) {
        alert('ID tidak valid!');
        return;
    }
    
    showLoading();
    $('#DetailHeaderId').val(headerId);
    $('#ModalDetailTitle').text('Edit Indikator');
    
    $.ajax({
        url: BaseURL + "Instansi/getRenjaDetail",
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
                $('#DetailId').val(d.id);
                $('#DetailHeaderInfo').text('Kode Rekening: ' + (d.kode_rekening || '-'));
                $('#IndikatorKinerja').val(d.indikator_kinerja || '');
                $('#Satuan').val(d.satuan || '');
                
                if (d.lokasi) {
                    if (d.lokasi.indexOf('manual_') === 0) {
                        setSelectedLokasi(d.lokasi, d.lokasi_nama || d.lokasi);
                    } else {
                        $.ajax({
                            url: BaseURL + "Instansi/getLokasiDetail",
                            type: "POST",
                            data: { kode: d.lokasi, [CSRF_NAME]: CSRF_TOKEN },
                            dataType: "json",
                            async: false,
                            success: function(lokasiData) {
                                if (lokasiData && lokasiData.Nama) {
                                    setSelectedLokasi(d.lokasi, lokasiData.Nama);
                                } else {
                                    setSelectedLokasi(d.lokasi, d.lokasi);
                                }
                            },
                            error: function() {
                                setSelectedLokasi(d.lokasi, d.lokasi);
                            }
                        });
                    }
                } else {
                    removeSelectedLokasi();
                }
                
                $('#PrioritasDaerah').val(d.prioritas_daerah || '');
                $('#PrioritasNasional').val(d.prioritas_nasional || '');
                $('#RanwalKinerja').val(d.ranwal_kinerja || '');
                $('#RanwalRp').val(d.ranwal_rp ? new Intl.NumberFormat('id-ID').format(d.ranwal_rp) : '');
                $('#RancanganKinerja').val(d.rancangan_kinerja || '');
                $('#RancanganRp').val(d.rancangan_rp ? new Intl.NumberFormat('id-ID').format(d.rancangan_rp) : '');
                $('#RanhirKinerja').val(d.ranhir_kinerja || '');
                $('#RanhirRp').val(d.ranhir_rp ? new Intl.NumberFormat('id-ID').format(d.ranhir_rp) : '');
                $('#RenjaKinerja').val(d.renja_kinerja || '');
                $('#RenjaRp').val(d.renja_rp ? new Intl.NumberFormat('id-ID').format(d.renja_rp) : '');
                $('#DpaMurniKinerja').val(d.dpa_murni_kinerja || '');
                $('#DpaMurniRp').val(d.dpa_murni_rp ? new Intl.NumberFormat('id-ID').format(d.dpa_murni_rp) : '');
                $('#SumberDana').val(d.sumber_dana || '');
                $('#DpaPerubahanKinerja').val(d.dpa_perubahan_kinerja || '');
                $('#DpaPerubahanRp').val(d.dpa_perubahan_rp ? new Intl.NumberFormat('id-ID').format(d.dpa_perubahan_rp) : '');
                
                var bidangPengampu = d.bidang_pengampu || '';
                var pengampu = d.pengampu || '';
                
                if (bidangPengampu) {
                    loadBidangPengampuOptions(bidangPengampu);
                    setTimeout(function() {
                        if (pengampu) {
                            loadPengampuByBidang(bidangPengampu, pengampu);
                        }
                    }, 500);
                } else {
                    loadBidangPengampuOptions('');
                    $('#PengampuGroup').hide();
                    $('#Pengampu').val('').trigger('change');
                    $('#PengampuInfoModal').hide();
                }
                
                $('#ModalDetail').modal('show');
            } else {
                alert(res.message || 'Gagal memuat data indikator');
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan saat memuat data");
        }
    });
});

// ================================================================
// TOMBOL HAPUS DETAIL
// ================================================================
$(document).off('click', '.BtnHapusDetail').on('click', '.BtnHapusDetail', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    
    if (!id) {
        alert('ID tidak valid!');
        return;
    }
    
    if (!confirm("Yakin hapus indikator ini?")) return;
    
    showLoading();
    
    $.ajax({
        url: BaseURL + "Instansi/hapusRenjaDetail",
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
// SIMPAN HEADER
// ================================================================
$(document).off('click', '#BtnSimpanHeader').on('click', '#BtnSimpanHeader', function(e) {
    e.preventDefault();
    
    var id = parseInt($('#HeaderId').val()) || __editHeaderId || 0;
    var isEdit = (id > 0);
    
    if ($('#tab_nomenklatur_header').hasClass('active')) {
        var kode = $('#header_select_sub_kegiatan').val();
        if (!kode || kode === "") {
            kode = $('#header_select_kegiatan').val();
        }
        if (!kode || kode === "") {
            kode = $('#header_select_program').val();
        }
        if (!kode || kode === "") {
            kode = $('#header_select_bidang_urusan').val();
        }
        if (!kode || kode === "") {
            kode = $('#header_select_urusan').val();
        }
        
        if (!kode) {
            alert('Silakan pilih data dari nomenklatur terlebih dahulu!');
            return;
        }
    } else {
        var kodeRekening = $('#KodeRekeningManual').val().trim();
        var tujuan = $('#TujuanManual').val().trim();
        var sasaran = $('#SasaranManual').val().trim();
        var program = $('#ProgramManual').val().trim();
        var kegiatan = $('#KegiatanManual').val().trim();
        var subKegiatan = $('#SubKegiatanManual').val().trim();
        
        if (!kodeRekening && !tujuan && !sasaran && !program && !kegiatan && !subKegiatan) {
            alert('Minimal isi Kode Rekening atau salah satu field!');
            return;
        }
    }
    
    showLoading();
    
    var data = {
        id: id,
        mode_nomenklatur: $('#tab_nomenklatur_header').hasClass('active') ? 1 : 0,
        tahun: $('#TahunHeader').val(),
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    if ($('#tab_nomenklatur_header').hasClass('active')) {
        data.urusan_kode = $('#header_select_urusan').val() || '';
        data.bidang_kode = $('#header_select_bidang_urusan').val() || '';
        data.program_kode = $('#header_select_program').val() || '';
        data.kegiatan_kode = $('#header_select_kegiatan').val() || '';
        data.sub_kegiatan_kode = $('#header_select_sub_kegiatan').val() || '';
    } else {
        data.kode_rekening = $('#KodeRekeningManual').val().trim();
        data.tujuan_manual = $('#TujuanManual').val().trim();
        data.sasaran_manual = $('#SasaranManual').val().trim();
        data.program_manual = $('#ProgramManual').val().trim();
        data.kegiatan_manual = $('#KegiatanManual').val().trim();
        data.sub_kegiatan_manual = $('#SubKegiatanManual').val().trim();
    }
    
    var url = isEdit ? BaseURL + "Instansi/editRenjaHeader" : BaseURL + "Instansi/tambahRenjaHeader";
    
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                __editHeaderId = 0;
                $('#HeaderId').val(0);
                $('#IsEditMode').val(0);
                $('.BtnEditHeader').removeClass('active-edit');
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
// SIMPAN DETAIL
// ================================================================
$(document).off('click', '#BtnSimpanDetail').on('click', '#BtnSimpanDetail', function(e) {
    e.preventDefault();
    
    var indikator = $('#IndikatorKinerja').val().trim();
    if (!indikator) {
        alert('Indikator Kinerja wajib diisi!');
        $('#IndikatorKinerja').focus();
        return;
    }
    
    showLoading();
    
    var data = {
        id: $('#DetailId').val(),
        header_id: $('#DetailHeaderId').val(),
        indikator_kinerja: indikator,
        satuan: $('#Satuan').val(),
        lokasi: $('#LokasiKode').val(),
        lokasi_nama: $('#LokasiNama').val(),
        prioritas_daerah: $('#PrioritasDaerah').val(),
        prioritas_nasional: $('#PrioritasNasional').val(),
        ranwal_kinerja: $('#RanwalKinerja').val(),
        ranwal_rp: $('#RanwalRp').val().replace(/[^0-9]/g, ''),
        rancangan_kinerja: $('#RancanganKinerja').val(),
        rancangan_rp: $('#RancanganRp').val().replace(/[^0-9]/g, ''),
        ranhir_kinerja: $('#RanhirKinerja').val(),
        ranhir_rp: $('#RanhirRp').val().replace(/[^0-9]/g, ''),
        renja_kinerja: $('#RenjaKinerja').val(),
        renja_rp: $('#RenjaRp').val().replace(/[^0-9]/g, ''),
        dpa_murni_kinerja: $('#DpaMurniKinerja').val(),
        dpa_murni_rp: $('#DpaMurniRp').val().replace(/[^0-9]/g, ''),
        sumber_dana: $('#SumberDana').val(),
        dpa_perubahan_kinerja: $('#DpaPerubahanKinerja').val(),
        dpa_perubahan_rp: $('#DpaPerubahanRp').val().replace(/[^0-9]/g, ''),
        bidang_pengampu: $('#BidangPengampu').val() || '',
        pengampu: $('#Pengampu').val() || '',
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $.ajax({
        url: BaseURL + "Instansi/simpanRenjaDetail",
        type: "POST",
        data: data,
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                location.reload();
            } else {
                alert(res.message || "Gagal menyimpan indikator");
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan saat menyimpan indikator");
        }
    });
});

// ================================================================
// SELECT2 - BIDANG PENGAMPU & PENGAMPU DENGAN JABATAN
// ================================================================
function initSelect2(selector, placeholder) {
    if ($(selector).hasClass('select2-hidden-accessible')) {
        $(selector).select2('destroy');
    }
    $(selector).select2({
        placeholder: placeholder || 'Pilih...',
        dropdownParent: $('#ModalDetail'),
        width: '100%',
        allowClear: true
    });
}

function loadBidangPengampuOptions(selectedId) {
    $('#BidangPengampu').html('<option value="">Loading...</option>');
    
    $.ajax({
        url: BaseURL + 'Instansi/getDaftarDinasRenja',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var options = '<option value="">-- Pilih Bidang Pengampu --</option>';
            
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    var selected = (String(item.id) === String(selectedId)) ? 'selected' : '';
                    options += '<option value="' + item.id + '" ' + selected + '>' + escapeHtml(item.nama) + '</option>';
                });
            } else {
                options += '<option value="" disabled>Tidak ada data Dinas</option>';
            }
            
            $('#BidangPengampu').html(options);
            initSelect2('#BidangPengampu', 'Pilih Bidang Pengampu...');
            
            if (selectedId) {
                $('#BidangPengampu').val(selectedId).trigger('change');
            } else {
                $('#PengampuGroup').hide();
                $('#Pengampu').val('').trigger('change');
                $('#PengampuInfoModal').hide();
            }
        },
        error: function() {
            $('#BidangPengampu').html('<option value="">Gagal memuat data</option>');
            initSelect2('#BidangPengampu', 'Pilih Bidang Pengampu...');
        }
    });
}

function loadPengampuByBidang(dinasId, selectedPelaksanaId) {
    if (!dinasId) {
        $('#PengampuGroup').hide();
        $('#Pengampu').html('<option value="">-- Pilih Pengampu --</option>');
        $('#PengampuInfoModal').hide();
        initSelect2('#Pengampu', 'Pilih Pengampu...');
        return;
    }
    
    $('#PengampuGroup').show();
    
    $.ajax({
        url: BaseURL + 'Instansi/getPelaksanaByDinasRenja',
        type: 'POST',
        data: { 
            dinas_id: dinasId,
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: 'json',
        beforeSend: function() {
            $('#Pengampu').html('<option value="">Loading...</option>');
        },
        success: function(data) {
            var options = '<option value="">-- Pilih Pengampu --</option>';
            
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    var selected = (String(item.id) === String(selectedPelaksanaId)) ? 'selected' : '';
                    var displayText = item.nama;
                    if (item.jabatan) {
                        displayText += ' - ' + item.jabatan;
                    }
                    if (item.nip) {
                        displayText += ' (' + item.nip + ')';
                    }
                    if (item.nama_dinas) {
                        displayText += ' - ' + item.nama_dinas;
                    }
                    options += '<option value="' + item.id + '" ' + selected + 
                               ' data-nama="' + escapeHtml(item.nama) + '"' +
                               ' data-jabatan="' + escapeHtml(item.jabatan || '') + '"' +
                               ' data-nip="' + escapeHtml(item.nip || '') + '">' + 
                               escapeHtml(displayText) + '</option>';
                });
            } else {
                options += '<option value="" disabled>Tidak ada pelaksana</option>';
            }
            
            $('#Pengampu').html(options);
            initSelect2('#Pengampu', 'Pilih Pengampu...');
            
            if (selectedPelaksanaId) {
                $('#Pengampu').val(selectedPelaksanaId).trigger('change');
            }
            
            // Tampilkan info jika ada pengampu terpilih
            if (selectedPelaksanaId) {
                var $selected = $('#Pengampu option[value="' + selectedPelaksanaId + '"]');
                var nama = $selected.data('nama') || '';
                var jabatan = $selected.data('jabatan') || '';
                var nip = $selected.data('nip') || '';
                
                if (nama) {
                    $('#PengampuInfoModal').show();
                    $('#PengampuModalNama').text(nama);
                    $('#PengampuModalJabatan').text(jabatan ? ' - ' + jabatan : '');
                    $('#PengampuModalNip').text(nip ? ' (NIP: ' + nip + ')' : '');
                }
            }
        },
        error: function() {
            $('#Pengampu').html('<option value="">Gagal memuat data</option>');
            $('#PengampuInfoModal').hide();
            initSelect2('#Pengampu', 'Pilih Pengampu...');
        }
    });
}

// ================================================================
// EVENT CHANGE BIDANG PENGAMPU
// ================================================================
$(document).off('change', '#BidangPengampu').on('change', '#BidangPengampu', function() {
    var dinasId = $(this).val();
    loadPengampuByBidang(dinasId, '');
});

// ================================================================
// EVENT CHANGE PENGAMPU - TAMPILKAN JABATAN DI MODAL
// ================================================================
$(document).off('change', '#Pengampu').on('change', '#Pengampu', function() {
    var selected = $(this).find('option:selected');
    var nama = selected.data('nama') || '';
    var jabatan = selected.data('jabatan') || '';
    var nip = selected.data('nip') || '';
    
    if (nama) {
        $('#PengampuInfoModal').show();
        $('#PengampuModalNama').text(nama);
        $('#PengampuModalJabatan').text(jabatan ? ' - ' + jabatan : '');
        $('#PengampuModalNip').text(nip ? ' (NIP: ' + nip + ')' : '');
    } else {
        $('#PengampuInfoModal').hide();
    }
});

// ================================================================
// FORMAT RUPIAH
// ================================================================
$(document).on('input', '.format-rupiah', function() {
    var value = $(this).val().replace(/[^0-9]/g, '');
    if (value) {
        var formatted = new Intl.NumberFormat('id-ID').format(value);
        $(this).val(formatted);
    }
});

// ================================================================
// DATATABLE
// ================================================================
$(document).ready(function() {
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
                    $('.btn-add-detail, .BtnEditHeader, .BtnHapusHeader, .BtnEditDetail, .BtnHapusDetail').css({
                        'cursor': 'pointer',
                        'pointer-events': 'auto'
                    });
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }
    
    // Inisialisasi modal lokasi
    $('#ModalLokasi').on('shown.bs.modal', function() {
        if ($('#LokasiProvinsi option').length <= 1) {
            loadProvinsi('');
        }
    });
});
</script>

</body>
</html>