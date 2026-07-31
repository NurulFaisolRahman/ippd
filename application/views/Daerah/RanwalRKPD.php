<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ranwal RKPD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('Daerah/Cssumum'); ?>
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <style>
        /* ===== OVERRIDE UNTUK POPUP DI ATAS HEADER ===== */
        .modal {
            z-index: 999999 !important;
        }
        
        .modal-backdrop {
            z-index: 999998 !important;
        }
        
        .modal-open .modal {
            overflow-y: auto !important;
        }
        
        .modal-dialog {
            margin: 30px auto !important;
            position: relative !important;
        }
        
        .modal.fade.in {
            display: block !important;
        }
        
        .modal-backdrop.fade.in {
            opacity: 0.5 !important;
        }
        
        .main-content {
            position: relative;
            z-index: 1;
        }
        
        .dataTables_wrapper {
            position: relative;
            z-index: 1;
        }

        /* ===== PERBAIKAN SELECT2 DI DALAM MODAL ===== */
        .select2-container--default .select2-dropdown {
            position: fixed !important;
            top: auto !important;
            bottom: auto !important;
            left: auto !important;
            right: auto !important;
            z-index: 9999999 !important;
            max-height: 300px !important;
            overflow-y: auto !important;
        }

        .select2-container--default .select2-dropdown--above {
            bottom: 100% !important;
            top: auto !important;
        }

        .select2-container--default .select2-dropdown--below {
            top: 100% !important;
            bottom: auto !important;
        }

        .select2-modal-dropdown {
            z-index: 9999999 !important;
        }

        .select2-container--open {
            z-index: 9999999 !important;
        }

        .modal-body .select2-container--open {
            position: relative !important;
            z-index: 9999999 !important;
        }

        .modal.fade.in {
            overflow-y: auto !important;
        }

        .modal-open .modal {
            overflow-y: auto !important;
        }

        .select2-container--open .select2-dropdown {
            position: fixed !important;
            z-index: 9999999 !important;
            max-height: 300px !important;
            overflow-y: auto !important;
        }

        .modal-backdrop {
            z-index: 999998 !important;
        }

        .modal-body {
            overflow-y: auto !important;
            max-height: 70vh !important;
            padding-right: 15px !important;
        }

        .select2-container--open .select2-dropdown {
            position: fixed !important;
            top: auto !important;
            bottom: auto !important;
            left: auto !important;
            right: auto !important;
        }

        /* ===== STYLE UTAMA ===== */
        .table-ranwal th, .table-ranwal td { 
            vertical-align: middle; 
            text-align: center; 
            border: 1px solid #dee2e6; 
            padding: 6px; 
            font-size: 12px;
        }
        .table-ranwal .uraian { 
            text-align: left !important; 
            padding-left: 10px !important; 
        }
        .table-ranwal .rp { white-space: nowrap; font-weight: 500; text-align: right; }
        
        .btn-aksi { padding: 3px 6px; font-size: 0.8rem; margin: 0 1px; }
        .filter-row .form-control { height: 38px; }
        
        .btn-group-aksi {
            display: flex;
            justify-content: center;
            gap: 3px;
            flex-wrap: wrap;
        }
        
        .header-row {
            background-color: #f8f9fa;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        
        .header-row:hover {
            background-color: #e9ecef;
        }
        
        .header-row.has-edit {
            background-color: #fff3cd !important;
            border-left: 4px solid #ffc107;
        }
        
        .header-row.has-edit:hover {
            background-color: #ffeaa7 !important;
        }
        
        .header-row .toggle-icon {
            transition: transform 0.3s ease;
            display: inline-block;
            margin-right: 8px;
            font-size: 14px;
        }
        
        .header-row .toggle-icon.collapsed {
            transform: rotate(-90deg);
        }
        
        .header-row .toggle-icon.expanded {
            transform: rotate(0deg);
        }
        
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
        
        .badge-detail {
            background-color: #17a2b8;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
        }
        
        .badge-edit {
            background-color: #ffc107;
            color: #856404;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .badge-edit i {
            margin-right: 3px;
        }
        
        .no-data {
            padding: 30px 0;
            color: #999;
        }
        
        .modal-lg-custom {
            max-width: 95%;
            width: 95%;
        }
        
        .mode-indicator {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }
        .mode-edit {
            background: #fff3cd;
            color: #856404;
        }
        
        .col-indikator-kinerja-item {
            text-align: left;
            padding-left: 8px !important;
            padding-right: 8px !important;
            font-size: 10px;
            background-color: #fafafa !important;
        }
        
        .indikator-item {
            display: block;
            line-height: 1.3;
        }
        
        .indikator-item .text-indikator {
            display: block;
            line-height: 1.3;
        }
        
        .table-detail-indikator thead th {
            background-color: #f8f9fa;
            font-size: 9px;
            padding: 3px 4px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }
        
        .table-detail-indikator thead th.header-indikator {
            background-color: #d4e6f1;
            font-weight: 700;
            font-size: 9px;
            color: #1a5276;
            padding: 3px 4px;
        }
        
        .table-detail-indikator td {
            font-size: 9px;
            padding: 3px 4px;
        }
        
        .table-detail-indikator td.rp {
            font-size: 9px;
            white-space: nowrap;
        }
        
        .row-indikator-detail:hover {
            background-color: #f0f8ff;
        }
        
        .row-indikator-detail.edited-by-daerah {
            background-color: #fff3cd !important;
        }
        
        .row-indikator-detail.edited-by-daerah:hover {
            background-color: #ffeaa7 !important;
        }
        
        .detail-container {
            padding: 5px 5px 5px 30px;
            overflow-x: auto;
        }
        
        .detail-container .table {
            min-width: 1400px;
        }

        /* ===== CSS UNTUK KOLOM BIDANG & PENGAMPU ===== */
        .bidang-pengampu-cell {
            font-size: 9px;
            min-width: 180px;
            max-width: 250px;
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4;
            text-align: left !important;
            padding: 4px 6px !important;
        }

        .bidang-pengampu-cell .bidang-label {
            font-weight: 700;
            color: #1a5276;
            display: block;
            font-size: 9px;
        }

        .bidang-pengampu-cell .pengampu-label {
            font-weight: 700;
            color: #8e44ad;
            display: block;
            margin-top: 3px;
            font-size: 9px;
        }

        .bidang-pengampu-cell .pengampu-detail {
            display: block;
            padding-left: 8px;
            font-size: 9px;
        }

        .bidang-pengampu-cell .jabatan-text {
            font-weight: 600;
            color: #2c3e50;
            font-size: 9px;
        }

        .bidang-pengampu-cell .nama-text {
            font-weight: 400;
            color: #34495e;
            font-size: 9px;
        }

        .bidang-pengampu-cell .pengampu-simple {
            display: block;
            padding-left: 8px;
            color: #34495e;
            font-size: 9px;
        }

        .bidang-pengampu-cell .text-muted {
            color: #999;
            font-size: 9px;
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

        /* ===== EDIT NOTIFICATION ===== */
        .edit-notification {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 10px 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .edit-notification i {
            color: #856404;
            font-size: 18px;
        }
        
        .edit-notification .text {
            color: #856404;
            font-size: 13px;
        }

        /* ===== MODAL ===== */
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding: 15px 20px;
        }

        #ModalEditRanwal .modal-body {
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

        .select2-container--open {
            z-index: 99999 !important;
        }

        .modal-lokasi .modal-body {
            padding: 20px 25px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .modal-lokasi .modal-header {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            flex-shrink: 0;
        }

        .modal-lokasi .modal-footer {
            flex-shrink: 0;
        }

        .lokasi-tab {
            margin-top: 10px;
        }

        .lokasi-tab .nav-tabs > li > a {
            padding: 8px 15px;
            font-size: 13px;
        }

        .lokasi-tab .tab-content {
            padding: 15px 0;
        }

        #LokasiInfo {
            margin-top: 10px;
            padding: 10px;
            background: #e8f0fe;
            border-radius: 4px;
            display: none;
        }

        #LokasiInfo strong {
            color: #1a5276;
        }

        #LokasiInfoText {
            font-weight: 500;
            color: #2c3e50;
        }

        @media (max-width: 768px) {
            .table-ranwal {
                font-size: 10px;
            }
            .table-ranwal th, .table-ranwal td {
                padding: 4px;
            }
            .btn-aksi {
                font-size: 0.7rem;
                padding: 2px 4px;
            }
            .bidang-pengampu-cell {
                font-size: 8px;
                min-width: 120px;
            }
            .bidang-pengampu-cell .jabatan-text,
            .bidang-pengampu-cell .nama-text {
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
                        <!-- FILTER WILAYAH (Sebelum Login)                                -->
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
                        <?php 
                        $is_role_4 = isset($_SESSION['Level']) && $_SESSION['Level'] == 4;
                        if (isset($_SESSION['KodeWilayah']) && !$is_role_4 && !empty($ListInstansi)) { ?>
                            <div class="filter-section">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="filter-group">
                                            <label class="filter-label" for="FilterInstansi"><b>Filter Instansi</b></label>
                                            <select class="form-control" id="FilterInstansi">
                                                <option value="">-- Semua Instansi --</option>
                                                <?php foreach ($ListInstansi as $ins) { 
                                                    $selected = ($this->input->get('instansi_id') == $ins['id']) ? 'selected' : '';
                                                ?>
                                                    <option value="<?= $ins['id'] ?>" <?= $selected ?>>
                                                        <?= html_escape($ins['nama']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="filter-group" style="margin-top: 28px;">
                                            <button class="btn btn-primary btn-block" id="FilterInstansiBtn">
                                                <i class="fa fa-search"></i> Tampilkan
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
                        <?php if ($is_role_4 && isset($_SESSION['NamaInstansi'])) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($_SESSION['NamaInstansi']) ?>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- NOTIFIKASI EDIT OLEH DAERAH                                 -->
                        <!-- ============================================================ -->
                        <?php 
                        $has_edited = false;
                        $total_edited = 0;
                        foreach ($RenjaData as $row) {
                            if (!empty($row['details'])) {
                                foreach ($row['details'] as $detail) {
                                    if (!empty($detail['edited_by_daerah']) && $detail['edited_by_daerah'] == 1) {
                                        $has_edited = true;
                                        $total_edited++;
                                    }
                                }
                            }
                        }
                        ?>
                        
                        <?php if ($has_edited): ?>
                        <div class="edit-notification">
                            <i class="fa fa-info-circle"></i>
                            <span class="text">
                                <strong>Perhatian:</strong> Terdapat <strong><?= $total_edited ?></strong> indikator yang telah diedit oleh Daerah. 
                                Data yang telah diedit akan ditandai dengan latar belakang <span style="background:#fff3cd; padding:2px 8px; border-radius:4px;">kuning</span> pada tabel di bawah.
                            </span>
                        </div>
                        <?php endif; ?>

                        <!-- ============================================================ -->
                        <!-- JUDUL HALAMAN                                               -->
                        <!-- ============================================================ -->
                        <div class="basic-tb-hd">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="fa fa-file-text"></i> Ranwal RKPD</h2>
                                    <p class="text-muted">
                                        <i class="fa fa-info-circle"></i> 
                                        Data diambil dari menu Renja Perangkat Daerah.
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <!-- ============================================================ -->
                        <!-- TABEL RANWAL RKPD                                            -->
                        <!-- ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-ranwal">
                                <thead>
                                    <tr>
                                        <th style="min-width:120px;">Kode Rekening</th>
                                        <th style="min-width:200px;">Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan</th>
                                        <th style="width:80px;">Jumlah Indikator</th>
                                        <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width:80px;">Status</th>
                                        <th style="width:80px;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($RenjaData)) { ?>
                                        <?php foreach ($RenjaData as $row) { 
                                            $has_edit_header = false;
                                            if (!empty($row['details'])) {
                                                foreach ($row['details'] as $det) {
                                                    if (!empty($det['edited_by_daerah']) && $det['edited_by_daerah'] == 1) {
                                                        $has_edit_header = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        ?>
                                            <tr class="header-row <?= $has_edit_header ? 'has-edit' : '' ?>" 
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
                                                <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td class="text-center">
                                                    <?php if ($has_edit_header) { ?>
                                                        <span class="badge" style="background: #ffc107; color: #856404;">
                                                            <i class="fa fa-edit"></i> Diedit Daerah
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="badge" style="background: #28a745; color: #fff;">
                                                            <i class="fa fa-check"></i> Normal
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted" style="font-size: 9px;">
                                                        <i class="fa fa-arrow-right"></i> Klik indikator
                                                    </span>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            
                                            <!-- DETAIL ROW -->
                                            <?php if (!empty($row['details'])) { ?>
                                                <tr class="detail-row detail-hidden" data-header-id="<?= $row['id'] ?>">
                                                    <td colspan="6" style="padding:0;">
                                                        <div class="detail-container">
                                                            <table class="table table-bordered table-condensed table-detail-indikator" style="margin:0; font-size:10px; min-width:1400px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th rowspan="2" class="header-indikator" style="width:12%; vertical-align:middle; min-width:120px;">
                                                                            <span style="font-size:10px; font-weight:800;">INDIKATOR KINERJA</span>
                                                                            <br><small style="font-weight:400;">(Dengan edit oleh Daerah)</small>
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
                                                                        
                                                                        <!-- ===== KOLOM BIDANG & PENGAMPU DIPERLEBAR ===== -->
                                                                        <th rowspan="2" style="width:12%;vertical-align:middle; font-size:9px; min-width:180px;">
                                                                            Bidang &amp; Pengampu
                                                                            <br><small style="font-weight:400; font-size:7px; color:#6c757d;">(Jabatan - Nama)</small>
                                                                        </th>
                                                                        
                                                                        <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
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
                                                                        $is_edited = !empty($detail['edited_by_daerah']) && $detail['edited_by_daerah'] == 1;
                                                                        
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
                                                                        <tr class="row-indikator-detail <?= $is_edited ? 'edited-by-daerah' : '' ?>" 
                                                                            data-detail-id="<?= $detail['id'] ?>">
                                                                            
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
                                                                                    <?php if ($is_edited) { ?>
                                                                                        <div class="badge-daerah-edit" style="background-color: #f39c12; color: #fff; font-size: 8px; padding: 2px 6px; border-radius: 4px; margin-top: 4px; display: block; text-align: center;">
                                                                                            <i class="fa fa-edit"></i> Diedit Daerah
                                                                                            <?php if (!empty($detail['daerah_edit_time'])) { ?>
                                                                                                <br><small style="font-size: 7px;"><?= date('d/m/Y H:i', strtotime($detail['daerah_edit_time'])) ?></small>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td><?= html_escape($detail['satuan'] ?? '-') ?></td>
                                                                            <td><?= html_escape($lokasi_text) ?></td>
                                                                            <td><?= html_escape($detail['prioritas_daerah'] ?? '-') ?></td>
                                                                            <td><?= html_escape($detail['prioritas_nasional'] ?? '-') ?></td>
                                                                            
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['ranwal_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['ranwal_rp']) ? 'Rp ' . number_format($detail['ranwal_rp'], 0, ',', '.') : '-' ?></td>
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['rancangan_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['rancangan_rp']) ? 'Rp ' . number_format($detail['rancangan_rp'], 0, ',', '.') : '-' ?></td>
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['ranhir_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['ranhir_rp']) ? 'Rp ' . number_format($detail['ranhir_rp'], 0, ',', '.') : '-' ?></td>
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['renja_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['renja_rp']) ? 'Rp ' . number_format($detail['renja_rp'], 0, ',', '.') : '-' ?></td>
                                                                            <td class="text-left"><?= nl2br(html_escape($detail['dpa_murni_kinerja'] ?? '-')) ?></td>
                                                                            <td class="rp"><?= !empty($detail['dpa_murni_rp']) ? 'Rp ' . number_format($detail['dpa_murni_rp'], 0, ',', '.') : '-' ?></td>
                                                                            <td><?= html_escape($detail['sumber_dana'] ?? '-') ?></td>
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
                                                                                    echo '<span class="bidang-label text-center">Bidang: ' . $bidang_text . '</span>';
                                                                                }
                                                                                
                                                                                if ($jabatan_text && $nama_text) {
                                                                                    echo '<span class="pengampu-label text-center">Pengampu:</span>';
                                                                                    echo '<span class="pengampu-detail text-center">';
                                                                                    echo '<span class="jabatan-text text-center">' . $jabatan_text . '</span>';
                                                                                    echo '<span class="nama-text text-center"> - ' . $nama_text . '</span>';
                                                                                    echo '</span>';
                                                                                } elseif ($nama_text) {
                                                                                    echo '<span class="pengampu-label text-center">Pengampu:</span>';
                                                                                    echo '<span class="pengampu-simple text-center">' . $nama_text . '</span>';
                                                                                }
                                                                                
                                                                                if (empty($bidang_text) && empty($nama_text)) {
                                                                                    echo '<span class="text-muted">-</span>';
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            
                                                                            <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                            <td>
                                                                                <div class="btn-group-aksi">
                                                                                    <button class="btn btn-warning btn-xs BtnEditRanwal"
                                                                                        data-id="<?= $detail['id'] ?>"
                                                                                        data-header-id="<?= $row['id'] ?>"
                                                                                        title="Edit Data"
                                                                                        type="button">
                                                                                        <i class="notika-icon notika-edit"></i>
                                                                                    </button>
                                                                                    <button class="btn btn-danger btn-xs BtnHapusRanwal"
                                                                                        data-id="<?= $detail['id'] ?>"
                                                                                        data-indikator="<?= html_escape(substr($detail['indikator_kinerja'] ?? '-', 0, 50)) ?>"
                                                                                        title="Hapus Data"
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
                                            
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="6" class="text-center no-data">
                                                <i class="fa fa-inbox" style="font-size: 40px; display: block; color: #ddd;"></i>
                                                <strong>Belum ada data Renja yang diinput oleh Instansi</strong>
                                                <br>
                                                <small class="text-muted">
                                                    Data akan otomatis muncul saat Instansi membuat Renja.
                                                </small>
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
<!-- MODAL EDIT RANWAL                                              -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditRanwal" role="dialog" style="z-index: 999999 !important;">
    <div class="modal-dialog modal-lg" style="position: relative; margin: 30px auto !important; max-width: 900px;">
        <div class="modal-content" style="max-height: 100vh; overflow: hidden; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="flex-shrink: 0; background: #f8f9fa; border-bottom: 2px solid #dee2e6; border-radius: 8px 8px 0 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b><i class="fa fa-edit" style="color: #ffc107;"></i> Edit Ranwal RKPD</b></h4>
                <small id="EditHeaderInfo" class="text-muted"></small>
                <div class="alert alert-warning" style="margin-top: 10px; padding: 8px 12px; font-size: 12px;">
                    <i class="fa fa-info-circle"></i> 
                    Perubahan akan ditandai dan muncul di menu <strong>Ranwal Renja Perangkat Daerah</strong> sebagai notifikasi.
                </div>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 15px 20px;">
                <input type="hidden" id="EditDetailId" value="0">
                <input type="hidden" id="EditHeaderId" value="0">
                
                <!-- INDIKATOR KINERJA -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Indikator Kinerja</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="EditIndikatorKinerja" rows="3" placeholder="Masukkan indikator kinerja..."></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- SATUAN & LOKASI & PRIORITAS DAERAH -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Satuan</b></label>
                            <input type="text" class="form-control" id="EditSatuan" placeholder="%" style="height: 34px;">
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
                                
                                <span id="EditLokasiPlaceholder" class="text-muted" style="font-size: 12px; color: #999; padding: 3px 0;">Belum ada</span>
                                <span id="EditSelectedLokasiText" style="display: none; font-size: 12px; color: #2c3e50; font-weight: 500; white-space: normal; word-wrap: break-word; word-break: break-word; line-height: 1.5; padding: 3px 0; flex: 1; max-height: 60px; overflow-y: auto;"></span>
                                <span id="EditRemoveLokasiBtn" style="display: none; cursor: pointer; color: #e74c3c; font-size: 16px; font-weight: bold; line-height: 1; padding: 2px 4px; flex-shrink: 0; margin-top: 2px;" onclick="removeEditLokasi()">✖</span>
                                
                                <input type="hidden" id="EditLokasiKode" value="">
                                <input type="hidden" id="EditLokasiNama" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Prioritas Daerah</b></label>
                            <input type="text" class="form-control" id="EditPrioritasDaerah" placeholder="Prioritas daerah..." style="height: 34px;">
                        </div>
                    </div>
                </div>
                
                <!-- PRIORITAS NASIONAL & SUMBER DANA -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Prioritas Nasional</b></label>
                            <input type="text" class="form-control" id="EditPrioritasNasional" placeholder="Prioritas nasional..." style="height: 34px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Sumber Dana</b></label>
                            <input type="text" class="form-control" id="EditSumberDana" placeholder="APBD / APBN / dll" style="height: 34px;">
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
                            <textarea class="form-control" id="EditRanwalKinerja" rows="2" placeholder="Kinerja Ranwal..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="EditRanwalRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- RANCANGAN RENJA -->
                <h5><b>RANCANGAN RENJA</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="EditRancanganKinerja" rows="2" placeholder="Kinerja Rancangan..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="EditRancanganRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- RANHIR RENJA -->
                <h5><b>RANHIR RENJA</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="EditRanhirKinerja" rows="2" placeholder="Kinerja Ranhir..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="EditRanhirRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- RENJA -->
                <h5><b>RENJA</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="EditRenjaKinerja" rows="2" placeholder="Kinerja Renja..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="EditRenjaRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- DPA MURNI -->
                <h5><b>DPA MURNI</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="EditDpaMurniKinerja" rows="2" placeholder="Kinerja DPA Murni..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="EditDpaMurniRp" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- DPA PERUBAHAN -->
                <h5><b>DPA PERUBAHAN</b></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Kinerja</b></label>
                            <textarea class="form-control" id="EditDpaPerubahanKinerja" rows="2" placeholder="Kinerja DPA Perubahan..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Rp</b></label>
                            <input type="text" class="form-control format-rupiah" id="EditDpaPerubahanRp" placeholder="0">
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
                            <select class="form-control select2-bidang" id="EditBidangPengampu" style="width: 100%;">
                                <option value="">-- Pilih Bidang Pengampu --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="EditPengampuGroup" style="display: none;">
                            <label><b>Pengampu</b></label>
                            <select class="form-control select2-pengampu" id="EditPengampu" style="width: 100%;">
                                <option value="">-- Pilih Pengampu --</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- INFO PENGAMPU - MENAMPILKAN JABATAN & NIP                     -->
                <!-- ============================================================ -->
                <div class="pengampu-info-modal" id="EditPengampuInfo">
                    <span class="label">Pengampu:</span>
                    <span class="nama" id="EditPengampuNama"></span>
                    <span class="jabatan" id="EditPengampuJabatan"></span>
                    <span class="nip" id="EditPengampuNip"></span>
                </div>
                
            </div>
            <div class="modal-footer" style="flex-shrink: 0; border-top: 1px solid #e5e5e5; padding: 10px 20px; background: #fafafa; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                <button class="btn btn-warning" id="BtnSimpanEditRanwal"><b><i class="fa fa-save"></i> SIMPAN PERUBAHAN</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL PILIH LOKASI                                            -->
<!-- ============================================================ -->
<div class="modal fade modal-lokasi" id="ModalLokasi" role="dialog" style="z-index: 9999999 !important;">
    <div class="modal-dialog modal-md" style="position: relative; margin: 30px auto !important;">
        <div class="modal-content" style="max-height: 90vh; overflow: hidden; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="flex-shrink: 0; background: #f8f9fa; border-bottom: 2px solid #e9ecef; border-radius: 8px 8px 0 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b><i class="fa fa-map-marker"></i> Pilih Lokasi</b></h4>
                <small>Pilih Provinsi dan Kab/Kota</small>
            </div>
            <div class="modal-body" style="max-height: 60vh; overflow-y: auto; padding: 20px 25px;">
                <div class="lokasi-tab">
                    <ul class="nav nav-tabs" id="lokasiTab">
                        <li class="active"><a href="#tab_pilih_lokasi_edit" data-toggle="tab">📋 Pilih dari Daftar</a></li>
                        <li><a href="#tab_manual_lokasi_edit" data-toggle="tab">✏️ Isi Manual</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <!-- TAB PILIH DARI DAFTAR -->
                        <div class="tab-pane fade in active" id="tab_pilih_lokasi_edit">
                            <div style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Provinsi</b></label>
                                            <select class="form-control" id="EditLokasiProvinsi">
                                                <option value="">-- Pilih Provinsi --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Kab/Kota</b></label>
                                            <select class="form-control" id="EditLokasiKabKota" disabled>
                                                <option value="">-- Pilih Kab/Kota --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="EditLokasiInfo" style="display:none; margin-top: 10px; padding: 10px; background: #e8f0fe; border-radius: 4px;">
                                    <strong>Lokasi Terpilih:</strong><br>
                                    <span id="EditLokasiInfoText">-</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- TAB MANUAL -->
                        <div class="tab-pane fade" id="tab_manual_lokasi_edit">
                            <div class="panel panel-default" style="margin-top: 15px;">
                                <div class="panel-heading">
                                    <b>✏️ Isi Lokasi Manual</b>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label><b>Nama Lokasi</b></label>
                                        <input type="text" class="form-control" id="EditLokasiManualInput" 
                                               placeholder="Contoh: Kabupaten Bandung, Provinsi Jawa Barat">
                                        <small class="text-muted">Isi manual jika lokasi tidak tersedia di daftar</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="flex-shrink: 0; border-top: 1px solid #e5e5e5; padding: 10px 20px; background: #fafafa; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
                <button type="button" class="btn btn-success" id="BtnPilihLokasiEdit">
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
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var IS_ROLE_4 = '<?= $is_role_4 ?? false ?>';

// Cache data lokasi
var editLokasiCache = {
    provinsi: null,
    kabkota: {}
};

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
// FUNGSI LOKASI (EDIT)
// ================================================================

function loadEditProvinsi(selectedKode) {
    $('#EditLokasiProvinsi').html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.ajax({
        url: BaseURL + "Daerah/getProvinsiList",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var options = '<option value="">-- Pilih Provinsi --</option>';
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    var selected = (item.Kode === selectedKode) ? 'selected' : '';
                    options += `<option value="${item.Kode}" ${selected}>${escapeHtml(item.Nama)}</option>`;
                });
                editLokasiCache.provinsi = data;
            }
            $('#EditLokasiProvinsi').html(options).prop('disabled', false);
            if (selectedKode) {
                $('#EditLokasiProvinsi').val(selectedKode).trigger('change');
            }
        },
        error: function() {
            $('#EditLokasiProvinsi').html('<option value="">Gagal memuat data provinsi</option>').prop('disabled', false);
        }
    });
}

function loadEditKabKota(kodeProvinsi, selectedKode) {
    if (!kodeProvinsi) {
        $('#EditLokasiKabKota').html('<option value="">-- Pilih Kab/Kota --</option>').prop('disabled', true);
        $('#EditLokasiInfo').hide();
        return;
    }
    
    if (editLokasiCache.kabkota[kodeProvinsi]) {
        populateEditKabKota(editLokasiCache.kabkota[kodeProvinsi], selectedKode);
        return;
    }
    
    $('#EditLokasiKabKota').html('<option value="">Memuat...</option>').prop('disabled', true);
    
    $.ajax({
        url: BaseURL + "Daerah/getKabKotaByProvinsi",
        type: "POST",
        data: { 
            kode_provinsi: kodeProvinsi,
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: "json",
        success: function(data) {
            editLokasiCache.kabkota[kodeProvinsi] = data;
            populateEditKabKota(data, selectedKode);
        },
        error: function() {
            $('#EditLokasiKabKota').html('<option value="">Gagal memuat data kab/kota</option>').prop('disabled', false);
        }
    });
}

function populateEditKabKota(data, selectedKode) {
    var options = '<option value="">-- Pilih Kab/Kota --</option>';
    if (data && data.length > 0) {
        $.each(data, function(index, item) {
            var selected = (item.Kode === selectedKode) ? 'selected' : '';
            options += `<option value="${item.Kode}" ${selected}>${escapeHtml(item.Nama)}</option>`;
        });
    } else {
        options += '<option value="" disabled>Tidak ada Kab/Kota</option>';
    }
    $('#EditLokasiKabKota').html(options).prop('disabled', false);
    if (selectedKode) {
        $('#EditLokasiKabKota').val(selectedKode).trigger('change');
    }
    updateEditLokasiInfo();
}

function updateEditLokasiInfo() {
    var provinsiKode = $('#EditLokasiProvinsi').val();
    var provinsiNama = $('#EditLokasiProvinsi option:selected').text();
    var kabKotaKode = $('#EditLokasiKabKota').val();
    var kabKotaNama = $('#EditLokasiKabKota option:selected').text();
    
    if (provinsiKode && provinsiKode !== '' && kabKotaKode && kabKotaKode !== '') {
        var infoText = kabKotaNama + ', ' + provinsiNama;
        $('#EditLokasiInfoText').text(infoText);
        $('#EditLokasiInfo').show();
    } else if (provinsiKode && provinsiKode !== '') {
        $('#EditLokasiInfoText').text(provinsiNama + ' (Pilih Kab/Kota)');
        $('#EditLokasiInfo').show();
    } else {
        $('#EditLokasiInfo').hide();
    }
}

function setEditSelectedLokasi(kode, nama) {
    $('#EditLokasiKode').val(kode);
    $('#EditLokasiNama').val(nama);
    $('#EditLokasiPlaceholder').hide();
    $('#EditSelectedLokasiText').text(nama).show();
    $('#EditRemoveLokasiBtn').show();
}

function removeEditLokasi() {
    $('#EditLokasiKode').val('');
    $('#EditLokasiNama').val('');
    $('#EditSelectedLokasiText').hide().text('');
    $('#EditRemoveLokasiBtn').hide();
    $('#EditLokasiPlaceholder').show();
}

// EVENT LOKASI EDIT
$('#EditLokasiProvinsi').change(function() {
    var kodeProvinsi = $(this).val();
    loadEditKabKota(kodeProvinsi, '');
});

$('#EditLokasiKabKota').change(function() {
    updateEditLokasiInfo();
});

$('#BtnPilihLokasiEdit').click(function() {
    var activeTab = $('#lokasiTab .active a').attr('href');
    
    if (activeTab === '#tab_pilih_lokasi_edit') {
        var provinsiKode = $('#EditLokasiProvinsi').val();
        var provinsiNama = $('#EditLokasiProvinsi option:selected').text();
        var kabKotaKode = $('#EditLokasiKabKota').val();
        var kabKotaNama = $('#EditLokasiKabKota option:selected').text();
        
        if (!provinsiKode || provinsiKode === '' || !kabKotaKode || kabKotaKode === '') {
            alert('Silakan pilih Provinsi dan Kab/Kota terlebih dahulu!');
            return;
        }
        
        var fullName = kabKotaNama + ', ' + provinsiNama;
        setEditSelectedLokasi(kabKotaKode, fullName);
        
    } else if (activeTab === '#tab_manual_lokasi_edit') {
        var manualInput = $('#EditLokasiManualInput').val().trim();
        if (!manualInput) {
            alert('Silakan isi nama lokasi!');
            return;
        }
        setEditSelectedLokasi('manual_' + Date.now(), manualInput);
    }
    
    $('#ModalLokasi').modal('hide');
});

$('#ModalLokasi').on('shown.bs.modal', function() {
    if ($('#EditLokasiProvinsi option').length <= 1) {
        loadEditProvinsi('');
    }
});

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
                    var urlParams = new URLSearchParams(window.location.search);
                    var instansiParam = urlParams.get('instansi_id');
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (instansiParam == Data[i].id) ? 'selected' : '';
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
            <?php 
            $filter_instansi_id = $this->input->get('instansi_id', TRUE);
            if (!empty($filter_instansi_id)) { ?>
                setTimeout(function() {
                    if ($("#FilterInstansiBeforeLogin option[value='<?= $filter_instansi_id ?>']").length > 0) {
                        $("#FilterInstansiBeforeLogin").val("<?= $filter_instansi_id ?>");
                    }
                }, 500);
            <?php } ?>
        }, 300);
    <?php } ?>

    $("#Filter").click(function() {
        var provinsi = $("#Provinsi").val();
        var kabKota = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        if (provinsi === "") { alert("Mohon Pilih Provinsi"); return; }
        if (kabKota === "") { alert("Mohon Pilih Kab/Kota"); return; }

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
                    var redirectUrl = BaseURL + "Daerah/RanwalRKPD";
                    if (instansiId && instansiId != '') {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() {
                alert("Gagal menghubungi server!");
                $("#Filter").prop('disabled', false).text('Filter');
            }
        });
    });

<?php } ?>

<?php if (isset($_SESSION['KodeWilayah']) && !$is_role_4 && !empty($ListInstansi)) { ?>
    $("#FilterInstansiBtn").click(function() {
        var instansiId = $("#FilterInstansi").val();
        var url = BaseURL + "Daerah/RanwalRKPD";
        if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
        window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() { 
        window.location.href = BaseURL + "Daerah/RanwalRKPD"; 
    });
<?php } ?>

// ================================================================
// DROPDOWN BIDANG PENGAMPU & PENGAMPU (EDIT) - DENGAN JABATAN
// ================================================================

function initEditSelect2(selector, placeholder = 'Pilih...') {
    if ($(selector).hasClass('select2-hidden-accessible')) {
        $(selector).select2('destroy');
    }
    $(selector).select2({
        placeholder: placeholder,
        dropdownParent: $('#ModalEditRanwal'),
        width: '100%',
        allowClear: true
    });
}

function loadEditBidangPengampuOptions(selectedId = '') {
    $('#EditPengampuGroup').hide();
    $('#EditPengampu').val('').trigger('change');
    $('#EditPengampuInfo').hide();
    
    $.ajax({
        url: BaseURL + 'Instansi/getDaftarDinasRenja',
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {
            $('#EditBidangPengampu').html('<option value="">Loading...</option>');
        },
        success: function(data) {
            let options = '<option value="">-- Pilih Bidang Pengampu --</option>';
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    let selected = (String(item.id) === String(selectedId)) ? 'selected' : '';
                    options += `<option value="${item.id}" ${selected}>${escapeHtml(item.nama)}</option>`;
                });
            } else {
                options += '<option value="" disabled>Tidak ada data Dinas</option>';
            }
            $('#EditBidangPengampu').html(options);
            initEditSelect2('#EditBidangPengampu', 'Pilih Bidang Pengampu...');
            
            if (selectedId) {
                $('#EditBidangPengampu').val(selectedId).trigger('change');
            }
        },
        error: function() {
            $('#EditBidangPengampu').html('<option value="">Gagal memuat data</option>');
            initEditSelect2('#EditBidangPengampu', 'Pilih Bidang Pengampu...');
        }
    });
}

function loadEditPengampuByBidang(dinasId, selectedPelaksanaId = '') {
    if (!dinasId || dinasId === '') {
        $('#EditPengampuGroup').hide();
        $('#EditPengampu').html('<option value="">-- Pilih Pengampu --</option>');
        $('#EditPengampuInfo').hide();
        initEditSelect2('#EditPengampu', 'Pilih Pengampu...');
        return;
    }
    
    $('#EditPengampuGroup').show();
    
    $.ajax({
        url: BaseURL + 'Instansi/getPelaksanaByDinasRenja',
        type: 'POST',
        data: { 
            dinas_id: dinasId,
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: 'json',
        beforeSend: function() {
            $('#EditPengampu').html('<option value="">Loading...</option>');
        },
        success: function(data) {
            let options = '<option value="">-- Pilih Pengampu --</option>';
            
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    let selected = (String(item.id) === String(selectedPelaksanaId)) ? 'selected' : '';
                    let displayText = item.nama;
                    if (item.jabatan) {
                        displayText += ' - ' + item.jabatan;
                    }
                    if (item.nip) {
                        displayText += ' (' + item.nip + ')';
                    }
                    if (item.nama_dinas) {
                        displayText += ' - ' + item.nama_dinas;
                    }
                    options += `<option value="${item.id}" ${selected} 
                                data-nama="${escapeHtml(item.nama)}" 
                                data-jabatan="${escapeHtml(item.jabatan || '')}" 
                                data-nip="${escapeHtml(item.nip || '')}">${escapeHtml(displayText)}</option>`;
                });
            } else {
                options += '<option value="" disabled>Tidak ada pelaksana</option>';
            }
            
            $('#EditPengampu').html(options);
            initEditSelect2('#EditPengampu', 'Pilih Pengampu...');
            
            if (selectedPelaksanaId) {
                $('#EditPengampu').val(selectedPelaksanaId).trigger('change');
            }
            
            // Tampilkan info jika ada pengampu terpilih
            if (selectedPelaksanaId) {
                var $selected = $('#EditPengampu option:selected');
                var nama = $selected.data('nama') || '';
                var jabatan = $selected.data('jabatan') || '';
                var nip = $selected.data('nip') || '';
                
                if (nama) {
                    $('#EditPengampuInfo').show();
                    $('#EditPengampuNama').text(nama);
                    $('#EditPengampuJabatan').text(jabatan ? ' - ' + jabatan : '');
                    $('#EditPengampuNip').text(nip ? ' (NIP: ' + nip + ')' : '');
                }
            }
        },
        error: function() {
            $('#EditPengampu').html('<option value="">Gagal memuat data</option>');
            $('#EditPengampuInfo').hide();
            initEditSelect2('#EditPengampu', 'Pilih Pengampu...');
        }
    });
}

// EVENT CHANGE BIDANG PENGAMPU
$(document).off('change', '#EditBidangPengampu').on('change', '#EditBidangPengampu', function() {
    let dinasId = $(this).val();
    loadEditPengampuByBidang(dinasId, '');
});

// EVENT CHANGE PENGAMPU - TAMPILKAN JABATAN DI MODAL
$(document).off('change', '#EditPengampu').on('change', '#EditPengampu', function() {
    var selected = $(this).find('option:selected');
    var nama = selected.data('nama') || '';
    var jabatan = selected.data('jabatan') || '';
    var nip = selected.data('nip') || '';
    
    if (nama) {
        $('#EditPengampuInfo').show();
        $('#EditPengampuNama').text(nama);
        $('#EditPengampuJabatan').text(jabatan ? ' - ' + jabatan : '');
        $('#EditPengampuNip').text(nip ? ' (NIP: ' + nip + ')' : '');
    } else {
        $('#EditPengampuInfo').hide();
    }
});

// ================================================================
// TOMBOL EDIT RANWAL
// ================================================================
$(document).off('click', '.BtnEditRanwal').on('click', '.BtnEditRanwal', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var headerId = $(this).data('header-id') || 0;
    
    if (!id) {
        alert('ID tidak valid!');
        return;
    }
    
    showLoading();
    $('#EditHeaderId').val(headerId);
    
    $.ajax({
        url: BaseURL + "Daerah/GetRanwalRKPDDetail",
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
                $('#EditDetailId').val(d.id);
                $('#EditHeaderInfo').text('Kode Rekening: ' + (d.kode_rekening || '-'));
                $('#EditIndikatorKinerja').val(d.indikator_kinerja || '');
                $('#EditSatuan').val(d.satuan || '');
                
                // Set lokasi
                if (d.lokasi) {
                    if (d.lokasi.indexOf('manual_') === 0) {
                        setEditSelectedLokasi(d.lokasi, d.lokasi_nama || d.lokasi);
                    } else {
                        $.ajax({
                            url: BaseURL + "Daerah/getLokasiDetailRanwal",
                            type: "POST",
                            data: { kode: d.lokasi, [CSRF_NAME]: CSRF_TOKEN },
                            dataType: "json",
                            async: false,
                            success: function(lokasiData) {
                                if (lokasiData && lokasiData.Nama) {
                                    setEditSelectedLokasi(d.lokasi, lokasiData.Nama);
                                } else {
                                    setEditSelectedLokasi(d.lokasi, d.lokasi);
                                }
                            },
                            error: function() {
                                setEditSelectedLokasi(d.lokasi, d.lokasi);
                            }
                        });
                    }
                } else {
                    removeEditLokasi();
                }
                
                $('#EditPrioritasDaerah').val(d.prioritas_daerah || '');
                $('#EditPrioritasNasional').val(d.prioritas_nasional || '');
                $('#EditRanwalKinerja').val(d.ranwal_kinerja || '');
                $('#EditRanwalRp').val(d.ranwal_rp ? new Intl.NumberFormat('id-ID').format(d.ranwal_rp) : '');
                $('#EditRancanganKinerja').val(d.rancangan_kinerja || '');
                $('#EditRancanganRp').val(d.rancangan_rp ? new Intl.NumberFormat('id-ID').format(d.rancangan_rp) : '');
                $('#EditRanhirKinerja').val(d.ranhir_kinerja || '');
                $('#EditRanhirRp').val(d.ranhir_rp ? new Intl.NumberFormat('id-ID').format(d.ranhir_rp) : '');
                $('#EditRenjaKinerja').val(d.renja_kinerja || '');
                $('#EditRenjaRp').val(d.renja_rp ? new Intl.NumberFormat('id-ID').format(d.renja_rp) : '');
                $('#EditDpaMurniKinerja').val(d.dpa_murni_kinerja || '');
                $('#EditDpaMurniRp').val(d.dpa_murni_rp ? new Intl.NumberFormat('id-ID').format(d.dpa_murni_rp) : '');
                $('#EditSumberDana').val(d.sumber_dana || '');
                $('#EditDpaPerubahanKinerja').val(d.dpa_perubahan_kinerja || '');
                $('#EditDpaPerubahanRp').val(d.dpa_perubahan_rp ? new Intl.NumberFormat('id-ID').format(d.dpa_perubahan_rp) : '');
                
                // LOAD DROPDOWN BIDANG PENGAMPU & PENGAMPU
                var bidangPengampu = d.bidang_pengampu || '';
                var pengampu = d.pengampu || '';
                
                $('#EditPengampuGroup').hide();
                $('#EditPengampu').val('').trigger('change');
                $('#EditPengampuInfo').hide();
                
                if (bidangPengampu) {
                    loadEditBidangPengampuOptions(bidangPengampu);
                    setTimeout(function() {
                        if (pengampu) {
                            loadEditPengampuByBidang(bidangPengampu, pengampu);
                        }
                    }, 500);
                } else {
                    loadEditBidangPengampuOptions('');
                }
                
                $('#ModalEditRanwal').modal('show');
            } else {
                alert(res.message || 'Gagal memuat data');
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan saat memuat data");
        }
    });
});

// ================================================================
// TOMBOL SIMPAN EDIT RANWAL
// ================================================================
$(document).off('click', '#BtnSimpanEditRanwal').on('click', '#BtnSimpanEditRanwal', function(e) {
    e.preventDefault();
    
    var indikator = $('#EditIndikatorKinerja').val().trim();
    if (!indikator) {
        alert('Indikator Kinerja wajib diisi!');
        $('#EditIndikatorKinerja').focus();
        return;
    }
    
    var bidangPengampu = $('#EditBidangPengampu').val();
    if (!bidangPengampu) {
        alert('Bidang Pengampu wajib dipilih!');
        $('#EditBidangPengampu').focus();
        return;
    }
    
    var pengampu = $('#EditPengampu').val();
    if (!pengampu) {
        alert('Pengampu wajib dipilih!');
        $('#EditPengampu').focus();
        return;
    }
    
    // Konfirmasi sebelum menyimpan
    if (!confirm("Anda akan mengubah data Ranwal RKPD.\n\nPerubahan akan ditandai dan muncul sebagai notifikasi di menu Ranwal Renja Perangkat Daerah.\n\nLanjutkan?")) {
        return;
    }
    
    showLoading();
    
    var formatAngka = function(val) {
        if (!val) return '';
        return val.replace(/[^0-9]/g, '');
    };
    
    var data = {
        id: $('#EditDetailId').val(),
        header_id: $('#EditHeaderId').val(),
        indikator_kinerja: indikator,
        satuan: $('#EditSatuan').val(),
        lokasi: $('#EditLokasiKode').val(),
        lokasi_nama: $('#EditLokasiNama').val(),
        prioritas_daerah: $('#EditPrioritasDaerah').val(),
        prioritas_nasional: $('#EditPrioritasNasional').val(),
        ranwal_kinerja: $('#EditRanwalKinerja').val(),
        ranwal_rp: formatAngka($('#EditRanwalRp').val()),
        rancangan_kinerja: $('#EditRancanganKinerja').val(),
        rancangan_rp: formatAngka($('#EditRancanganRp').val()),
        ranhir_kinerja: $('#EditRanhirKinerja').val(),
        ranhir_rp: formatAngka($('#EditRanhirRp').val()),
        renja_kinerja: $('#EditRenjaKinerja').val(),
        renja_rp: formatAngka($('#EditRenjaRp').val()),
        dpa_murni_kinerja: $('#EditDpaMurniKinerja').val(),
        dpa_murni_rp: formatAngka($('#EditDpaMurniRp').val()),
        sumber_dana: $('#EditSumberDana').val(),
        dpa_perubahan_kinerja: $('#EditDpaPerubahanKinerja').val(),
        dpa_perubahan_rp: formatAngka($('#EditDpaPerubahanRp').val()),
        bidang_pengampu: bidangPengampu,
        pengampu: pengampu,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $.ajax({
        url: BaseURL + "Daerah/UpdateRanwalRKPD",
        type: "POST",
        data: data,
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                alert('✓ Data Ranwal RKPD berhasil diperbarui!\n\nNotifikasi akan muncul di menu Ranwal Renja Perangkat Daerah.');
                $('#ModalEditRanwal').modal('hide');
                location.reload();
            } else {
                alert(res.message || "Gagal menyimpan perubahan");
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan saat menyimpan");
        }
    });
});

// ================================================================
// TOMBOL HAPUS RANWAL
// ================================================================
$(document).off('click', '.BtnHapusRanwal').on('click', '.BtnHapusRanwal', function(e) {
    e.preventDefault();
    
    var id = $(this).data('id');
    var indikator = $(this).data('indikator') || 'Data ini';
    
    if (!id) {
        alert('ID tidak valid!');
        return;
    }
    
    if (!confirm("Anda yakin ingin menghapus data berikut?\n\n" + 
                 "Indikator: " + indikator + "\n\n" +
                 "⚠️ Data yang dihapus tidak dapat dikembalikan!")) {
        return;
    }
    
    showLoading();
    
    $.ajax({
        url: BaseURL + "Daerah/HapusRanwalRKPD",
        type: "POST",
        data: {
            id: id,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                alert('✓ Data berhasil dihapus!');
                location.reload();
            } else {
                alert(res.message || "Gagal menghapus data");
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan saat menghapus data");
        }
    });
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
// MODAL SHOWN EVENTS
// ================================================================
$('#ModalEditRanwal').on('shown.bs.modal', function() {
    // Re-inisialisasi Select2 Bidang Pengampu
    if ($('#EditBidangPengampu').hasClass('select2-hidden-accessible')) {
        $('#EditBidangPengampu').select2('destroy');
    }
    $('#EditBidangPengampu').select2({
        placeholder: 'Pilih Bidang Pengampu...',
        dropdownParent: $('#ModalEditRanwal'),
        width: '100%',
        allowClear: true
    });
    
    // Re-inisialisasi Select2 Pengampu
    if ($('#EditPengampu').hasClass('select2-hidden-accessible')) {
        $('#EditPengampu').select2('destroy');
    }
    $('#EditPengampu').select2({
        placeholder: 'Pilih Pengampu...',
        dropdownParent: $('#ModalEditRanwal'),
        width: '100%',
        allowClear: true
    });
    
    // Jika ada nilai Bidang Pengampu, load Pengampu
    let bidangValue = $('#EditBidangPengampu').val();
    if (bidangValue && bidangValue !== '') {
        loadEditPengampuByBidang(bidangValue, $('#EditPengampu').val());
    } else {
        $('#EditPengampuGroup').hide();
        $('#EditPengampuInfo').hide();
    }
});

// Saat modal akan ditutup, destroy Select2 untuk mencegah memory leak
$('#ModalEditRanwal').on('hidden.bs.modal', function() {
    if ($('#EditBidangPengampu').hasClass('select2-hidden-accessible')) {
        $('#EditBidangPengampu').select2('destroy');
    }
    if ($('#EditPengampu').hasClass('select2-hidden-accessible')) {
        $('#EditPengampu').select2('destroy');
    }
});

// Mencegah dropdown Select2 tertutup saat scroll
$(document).on('select2:open', function(e) {
    var $select = $(e.target);
    var $modal = $select.closest('.modal');
    if ($modal.length) {
        $modal.css('overflow-y', 'auto');
        setTimeout(function() {
            $('body').css('overflow', 'auto');
            $('html').css('overflow', 'auto');
        }, 10);
    }
});

// Mencegah dropdown tertutup saat klik di dalam dropdown
$(document).on('mousedown', '.select2-dropdown', function(e) {
    e.stopPropagation();
});

// ================================================================
// INIT DATATABLE
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