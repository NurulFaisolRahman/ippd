<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rancangan Akhir Renja PD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('Daerah/Cssumum'); ?>
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
        
        /* ===== HEADER READ-ONLY ===== */
        .header-row {
            background-color: #f8f9fa !important;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .header-row:hover {
            background-color: #e9ecef !important;
        }
        .header-readonly {
            background-color: #f1f3f5 !important;
        }
        .header-readonly td {
            color: #495057;
        }
        .header-readonly .header-clickable {
            cursor: pointer;
        }
        .header-lock-icon {
            color: #6c757d;
            margin-right: 5px;
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
            min-width: 1600px;
        }
        
        /* ===== BADGE ===== */
        .badge-detail {
            background-color: #17a2b8;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
        }
        
        /* ===== STATUS EDIT DAERAH ===== */
        .badge-edit-block {
            display: block;
            margin-top: 4px;
            font-size: 9px;
            padding: 2px 8px;
            background: #ffc107;
            color: #856404;
            border-radius: 4px;
            text-align: center;
            width: 100%;
            font-weight: bold;
        }
        .badge-edit-block i {
            margin-right: 3px;
        }
        .badge-edit-block small {
            font-size: 8px;
            display: block;
            margin-top: 1px;
            font-weight: normal;
        }
        
        .badge-status-edit {
            display: block;
            text-align: center;
            background: #ffc107;
            color: #856404;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-status-normal {
            display: block;
            text-align: center;
            background: #28a745;
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }
        
        .btn-view-old-data {
            background: #6c757d;
            color: white;
            border: none;
            padding: 1px 6px;
            font-size: 8px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 2px;
            display: inline-block;
        }
        .btn-view-old-data:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
        }
        
        .row-indikator-detail.edited-by-daerah {
            background-color: #fff3cd !important;
            border-left: 3px solid #ffc107;
        }
        .row-indikator-detail.edited-by-daerah:hover {
            background-color: #ffeaa7 !important;
        }
        
        .header-row.has-daerah-edit {
            background-color: #fff3cd !important;
            border-left: 4px solid #ffc107;
        }
        .header-row.has-daerah-edit:hover {
            background-color: #ffeaa7 !important;
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
        .table-detail-indikator thead th.header-indikator {
            background-color: #d4e6f1;
            font-weight: 700;
            font-size: 9px;
            color: #1a5276;
            padding: 3px 4px;
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
        .row-indikator-detail td {
            padding: 4px 3px;
            font-size: 10px;
        }
        .row-indikator-detail .col-indikator-kinerja-item {
            text-align: left;
            padding-left: 8px !important;
            padding-right: 8px !important;
            font-size: 10px;
            background-color: #fafafa !important;
        }
        .table-detail-indikator td.rp {
            font-size: 9px;
            white-space: nowrap;
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
        .no-data {
            padding: 30px 0;
            color: #999;
        }
        .modal-lg-custom {
            max-width: 92%;
            width: 92%;
        }
        .source-data-info {
            background: #e3f2fd;
            border-left: 4px solid #1976d2;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 15px;
        }
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            z-index: 9999999;
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
        
        .old-data-item {
            padding: 4px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 12px;
        }
        .old-data-item:last-child {
            border-bottom: none;
        }
        .old-data-item .label {
            font-weight: 600;
            color: #495057;
            display: inline-block;
            min-width: 120px;
        }
        .old-data-item .value {
            color: #212529;
        }

        /* ===== LOKASI CONTAINER ===== */
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
        .lokasi-container .text-muted {
            font-size: 12px;
            color: #999;
            padding: 3px 0;
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
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important;
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

        /* ===== BIDANG PENGAMPU & PENGAMPU ===== */
        .bidang-pengampu-container {
            margin-bottom: 15px;
        }

        .pengampu-container {
            margin-bottom: 15px;
            display: none !important;
            transition: all 0.3s ease;
        }

        .pengampu-container.show {
            display: block !important;
        }

        .pengampu-container .select2-container {
            width: 100% !important;
        }

        .pengampu-loading {
            display: none;
            margin-left: 10px;
            color: #6c757d;
            font-size: 12px;
        }

        .pengampu-loading i {
            animation: spin 1s linear infinite;
        }

        .pengampu-container .text-muted {
            display: block;
            margin-top: 5px;
            font-size: 11px;
            color: #6c757d;
        }

        .pengampu-info {
            font-size: 11px;
            margin-top: 5px;
            padding: 5px 10px;
            background: #f0f8ff;
            border-radius: 4px;
            border-left: 3px solid #007bff;
        }
        .pengampu-info .label {
            font-weight: 600;
            color: #495057;
        }
        .pengampu-info .nama {
            font-weight: 600;
            color: #2c3e50;
        }
        .pengampu-info .jabatan {
            color: #6c757d;
        }
        .pengampu-info .nip {
            color: #999;
            font-size: 10px;
        }

        /* ===== FORMAT RUPIAH ===== */
        .format-rupiah {
            text-align: right;
            font-weight: 500;
        }

        /* ===== MODAL HEADER INFO ===== */
        .modal-header-info {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            border-left: 4px solid #17a2b8;
        }
        .modal-header-info strong {
            color: #1a5276;
        }

        /* ===== PERBAIKAN MODAL BODY ===== */
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding: 15px 20px;
        }

        #ModalDetail .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding: 15px 20px;
        }

        #ModalOldData .modal-body {
            max-height: 60vh;
            overflow-y: auto;
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

        /* ===== NOTIFIKASI ===== */
        .alert-daerah-edit {
            background: #fff8e1;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.15);
            position: relative;
        }

        .alert-daerah-edit .close {
            position: absolute;
            top: 12px;
            right: 16px;
            font-size: 22px;
            font-weight: 700;
            color: #856404;
            opacity: 0.6;
            background: transparent;
            border: none;
            padding: 0 5px;
            cursor: pointer;
            line-height: 1;
            transition: opacity 0.2s ease, transform 0.2s ease;
            z-index: 5;
        }

        .alert-daerah-edit .close:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .alert-daerah-edit .alert-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
            flex-wrap: wrap;
        }

        .alert-daerah-edit .alert-header .icon {
            font-size: 20px;
            color: #f39c12;
            flex-shrink: 0;
        }

        .alert-daerah-edit .alert-header .title {
            color: #856404;
            font-weight: 700;
            font-size: 15px;
        }

        .alert-daerah-edit .alert-header .badge-count {
            background: #f39c12;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            padding: 2px 12px;
            border-radius: 20px;
            margin-left: 2px;
        }

        .alert-daerah-edit .alert-desc {
            color: #6c5a2a;
            font-size: 13px;
            margin: 2px 0 4px 30px;
            line-height: 1.5;
        }

        .alert-daerah-edit .alert-detail {
            color: #856404;
            font-size: 12px;
            margin: 2px 0 8px 30px;
            opacity: 0.85;
            line-height: 1.5;
        }

        .alert-daerah-edit .alert-detail i {
            margin-right: 5px;
        }

        .alert-daerah-edit .alert-actions {
            margin-top: 8px;
            padding-left: 30px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .alert-daerah-edit .alert-actions .btn {
            font-size: 12px;
            padding: 5px 14px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .alert-daerah-edit .alert-actions .btn-warning {
            background: #ffc107;
            color: #856404;
        }

        .alert-daerah-edit .alert-actions .btn-warning:hover {
            background: #e0a800;
            color: #856404;
        }

        .btn-sync-rancangan {
            background: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
            padding: 8px 20px;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .btn-sync-rancangan:hover {
            background: #138496;
            border-color: #117a8b;
            color: #fff;
        }
        .btn-sync-rancangan i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .alert-daerah-edit {
                padding: 12px 14px;
            }
            .alert-daerah-edit .alert-header .title {
                font-size: 13px;
            }
            .alert-daerah-edit .alert-desc {
                font-size: 12px;
                margin-left: 0;
            }
            .alert-daerah-edit .alert-detail {
                font-size: 11px;
                margin-left: 0;
            }
            .alert-daerah-edit .alert-actions {
                padding-left: 0;
            }
            .alert-daerah-edit .close {
                font-size: 18px;
                top: 8px;
                right: 10px;
            }
            .alert-daerah-edit .alert-header .badge-count {
                font-size: 11px;
                padding: 1px 8px;
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
                        <!-- FILTER INSTANSI (Setelah Login - Non Role 4)                 -->
                        <!-- ============================================================ -->
                        <?php if (isset($_SESSION['KodeWilayah']) && !$IsRole4 && !empty($ListInstansi)) { ?>
                            <div class="filter-section">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="filter-group">
                                            <label class="filter-label" for="FilterInstansiAfterLogin">
                                                <b>Filter Instansi</b>
                                            </label>
                                            <select class="form-control" id="FilterInstansiAfterLogin">
                                                <option value="">-- Semua Instansi --</option>
                                                <?php 
                                                foreach ($ListInstansi as $ins) {
                                                    $selected = ($FilterInstansiId == $ins['id']) ? 'selected' : '';
                                                    echo '<option value="' . html_escape($ins['id']) . '" ' . $selected . '>' 
                                                         . html_escape($ins['nama']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="filter-group" style="margin-top: 28px;">
                                            <button class="btn btn-primary btn-block" onclick="applyFilterInstansi()">
                                                <i class="fa fa-search"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- INFORMASI INSTANSI (Role 4)                                   -->
                        <!-- ============================================================ -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> 
                                <strong>Instansi Anda:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- SOURCE DATA INFO                                              -->
                        <!-- ============================================================ -->
                        <?php if (!empty($RancanganAkhirData)) { ?>
                            <div class="source-data-info">
                                <i class="fa fa-info-circle"></i> 
                                <strong>Data Rancangan Akhir:</strong> 
                                Hanya indikator yang bisa diedit/dihapus.
                                <?php if (!empty($LastSyncAt)) { ?>
                                    <span class="text-muted" style="font-size: 11px; margin-left: 10px;">
                                        <i class="fa fa-clock-o"></i> Sinkron: <?= date('d/m/Y H:i', strtotime($LastSyncAt)) ?>
                                    </span>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TOMBOL AMBIL DATA (HANYA ROLE 4)                              -->
                        <!-- ============================================================ -->
                        <?php if ($IsRole4) { ?>
                            <div style="margin-bottom: 20px;">
                                <button class="btn btn-sync-rancangan" onclick="ambilDataRancangan()">
                                    <i class="fa fa-refresh"></i> <b>Sinkronisasi dari Rancangan Renja</b>
                                </button>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TABEL RANCANGAN AKHIR RENJA                                  -->
                        <!-- ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-renja">
                                <thead>
                                    <tr>
                                        <th style="min-width:120px;">Kode Rekening</th>
                                        <th style="min-width:200px;">Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan</th>
                                        <th style="width:80px;">Jumlah Indikator</th>
                                        <?php if ($IsRole4) { ?>
                                            <th style="width:80px;">STATUS</th>
                                            <th style="width:80px;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($RancanganAkhirData)) { ?>
                                        <?php foreach ($RancanganAkhirData as $row) { 
                                            $has_daerah_edit_row = false;
                                            foreach ($row['details'] as $det) {
                                                if (!empty($det['edited_by_daerah']) && $det['edited_by_daerah'] == 1) {
                                                    $has_daerah_edit_row = true;
                                                    break;
                                                }
                                            }
                                        ?>
                                            <!-- HEADER ROW - READ-ONLY -->
                                            <tr class="header-row header-readonly <?= $has_daerah_edit_row ? 'has-daerah-edit' : '' ?>" 
                                                data-header-id="<?= $row['id'] ?>" 
                                                data-expanded="false">
                                                <td class="text-left header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <strong><?= html_escape($row['kode_rekening'] ?: '-') ?></strong>
                                                </td>
                                                <td class="uraian header-clickable" onclick="toggleDetails('<?= $row['id'] ?>', this)">
                                                    <?php 
                                                    $display_text = '';
                                                    if (!empty($row['sub_kegiatan'])) {
                                                        $display_text = 'Sub Kegiatan: ' . $row['sub_kegiatan'];
                                                    } elseif (!empty($row['kegiatan'])) {
                                                        $display_text = 'Kegiatan: ' . $row['kegiatan'];
                                                    } elseif (!empty($row['program'])) {
                                                        $display_text = 'Program: ' . $row['program'];
                                                    } elseif (!empty($row['sasaran'])) {
                                                        $display_text = 'Sasaran: ' . $row['sasaran'];
                                                    } elseif (!empty($row['tujuan'])) {
                                                        $display_text = 'Tujuan: ' . $row['tujuan'];
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
                                                    <td class="text-center">
                                                        <?php if ($has_daerah_edit_row) { ?>
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
                                            
                                            <!-- DETAIL ROW - INDIKATOR -->
                                            <?php if (!empty($row['details'])) { ?>
                                                <tr class="detail-row detail-hidden" data-header-id="<?= $row['id'] ?>">
                                                    <td colspan="7" style="padding:0;">
                                                        <div class="detail-container">
                                                            <table class="table table-bordered table-condensed table-detail-indikator" style="margin:0; font-size:10px; min-width:1600px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th rowspan="2" class="header-indikator" style="width:10%; vertical-align:middle; min-width:120px;">
                                                                            <span style="font-size:10px; font-weight:800;">INDIKATOR KINERJA</span>
                                                                            <span class="badge" style="background: #28a745; color: white; font-size: 8px; margin-left: 5px;">
                                                                                <i class="fa fa-edit"></i> Edit
                                                                            </span>
                                                                        </th>
                                                                        <th rowspan="2" style="width:4%;vertical-align:middle; font-size:9px;">Satuan</th>
                                                                        <th rowspan="2" style="width:6%;vertical-align:middle; font-size:9px;">Lokasi</th>
                                                                        <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">Prioritas Daerah</th>
                                                                        <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">Prioritas Nasional</th>
                                                                        
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Ranwal Renja</th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Rancangan Renja</th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Ranhir Renja</th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Renja</th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">DPA Murni</th>
                                                                        
                                                                        <th rowspan="2" style="width:4%;vertical-align:middle; font-size:9px;">Sumber</th>
                                                                        
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">DPA Perubahan</th>
                                                                        
                                                                        <!-- ===== KOLOM BIDANG & PENGAMPU DIPERLEBAR ===== -->
                                                                        <th rowspan="2" style="width:12%;vertical-align:middle; font-size:9px; min-width:180px;">
                                                                            Bidang &amp; Pengampu
                                                                            <br><small style="font-weight:400; font-size:7px; color:#6c757d;">(Jabatan - Nama)</small>
                                                                        </th>
                                                                        
                                                                        <?php if ($IsRole4) { ?>
                                                                            <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">STATUS</th>
                                                                            <th rowspan="2" style="width:4%;vertical-align:middle; font-size:9px;">AKSI</th>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Kinerja</th>
                                                                        <th style="width:3.5%;text-align:center;font-size:7px;background:#f1f3f5;">Rp</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($row['details'] as $index => $detail) { 
                                                                        $is_edited_by_daerah = !empty($detail['edited_by_daerah']) && $detail['edited_by_daerah'] == 1;
                                                                        $old_data = !empty($detail['daerah_edit_old_data']) ? json_decode($detail['daerah_edit_old_data'], true) : null;
                                                                        
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
                                                                        <tr class="row-indikator-detail <?= $is_edited_by_daerah ? 'edited-by-daerah' : '' ?>" 
                                                                            data-detail-id="<?= $detail['id'] ?>">
                                                                            
                                                                            <!-- INDIKATOR KINERJA -->
                                                                            <td class="col-indikator-kinerja-item">
                                                                                <div class="indikator-item">
                                                                                    <span class="text-indikator">
                                                                                        <?= nl2br(html_escape($detail['indikator_kinerja'] ?? '-')) ?>
                                                                                    </span>
                                                                                    <?php if ($is_edited_by_daerah) { ?>
                                                                                        <span class="badge-edit-block">
                                                                                            <i class="fa fa-edit"></i> Diedit Daerah
                                                                                            <?php if (!empty($detail['daerah_edit_time'])) { ?>
                                                                                                <small><?= date('d/m/Y H:i', strtotime($detail['daerah_edit_time'])) ?></small>
                                                                                            <?php } ?>
                                                                                        </span>
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
                                                                            
                                                                            <?php if ($IsRole4) { ?>
                                                                                <!-- STATUS -->
                                                                                <td>
                                                                                    <?php if ($is_edited_by_daerah) { ?>
                                                                                        <span class="badge-status-edit">
                                                                                            <i class="fa fa-edit"></i> Diedit Daerah
                                                                                        </span>
                                                                                        <?php if ($old_data) { ?>
                                                                                            <button class="btn-view-old-data" 
                                                                                                    onclick="showOldData('<?= htmlspecialchars($detail['daerah_edit_old_data']) ?>')">
                                                                                                <i class="fa fa-history"></i> Data Lama
                                                                                            </button>
                                                                                        <?php } ?>
                                                                                    <?php } else { ?>
                                                                                        <span class="badge-status-normal">
                                                                                            <i class="fa fa-check"></i> Normal
                                                                                        </span>
                                                                                    <?php } ?>
                                                                                </td>
                                                                                
                                                                                <!-- AKSI -->
                                                                                <td>
                                                                                    <div class="btn-group-aksi">
                                                                                        <button class="btn btn-warning btn-xs BtnEditDetail"
                                                                                            data-id="<?= $detail['id'] ?>"
                                                                                            data-header-id="<?= $row['id'] ?>"
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
                                            
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="7" class="text-center no-data">
                                                <i class="fa fa-inbox" style="font-size: 40px; display: block; color: #ddd;"></i>
                                                <strong>Belum ada data Rancangan Akhir Renja</strong>
                                                <?php if ($IsRole4) { ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        Klik tombol <strong>"Sinkronisasi dari Rancangan Renja"</strong> untuk mengambil data.
                                                    </small>
                                                <?php } else { ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?php if (!empty($ListInstansi)) { ?>
                                                            Pilih instansi pada filter di atas untuk melihat data.
                                                        <?php } else { ?>
                                                            Tidak ada data yang tersedia.
                                                        <?php } ?>
                                                    </small>
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
<!-- MODAL DATA LAMA                                                -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalOldData" role="dialog" style="z-index: 9999999 !important;">
    <div class="modal-dialog modal-md" style="position: relative; margin: 30px auto !important;">
        <div class="modal-content" style="border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="background: #fff3cd; border-bottom: 2px solid #ffc107; border-radius: 8px 8px 0 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b><i class="fa fa-history" style="color: #856404;"></i> Data Sebelum Diedit oleh Daerah</b></h4>
                <small class="text-muted">Data lama sebelum dilakukan perubahan oleh pengguna Daerah</small>
            </div>
            <div class="modal-body" id="OldDataContainer" style="max-height: 60vh; overflow-y: auto; padding: 15px 20px;">
                <div class="text-center text-muted" style="padding: 30px 0;">
                    <i class="fa fa-spinner fa-spin" style="font-size: 24px;"></i>
                    <br><br>Memuat data...
                </div>
            </div>
            <div class="modal-footer" style="background: #f8f9fa; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT DETAIL - LENGKAP SEMUA FIELD                       -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalDetail" role="dialog" style="z-index: 999999 !important;">
    <div class="modal-dialog modal-lg" style="position: relative; margin: 30px auto !important; max-width: 900px;">
        <div class="modal-content" style="max-height: 100vh; overflow: hidden; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="flex-shrink: 0; background: #f8f9fa; border-bottom: 2px solid #dee2e6; border-radius: 8px 8px 0 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b><i class="fa fa-edit" style="color: #28a745;"></i> Edit Indikator Rancangan Akhir</b></h4>
                <small id="DetailHeaderInfo" class="text-muted"></small>
                <div class="alert alert-warning" style="margin-top: 10px; padding: 8px 12px; font-size: 12px;">
                    <i class="fa fa-info-circle"></i> Perubahan hanya mempengaruhi data Rancangan Akhir Renja
                </div>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 15px 20px;">
                <input type="hidden" id="DetailId" value="0">
                <input type="hidden" id="DetailHeaderId" value="0">
                
                <!-- ============================================================ -->
                <!-- INDIKATOR KINERJA (WAJIB)                                      -->
                <!-- ============================================================ -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Indikator Kinerja</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="IndikatorKinerja" rows="3" placeholder="Masukkan indikator kinerja..."></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- SATUAN & LOKASI & SUMBER DANA                                -->
                <!-- ============================================================ -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Satuan</b></label>
                            <input type="text" class="form-control" id="Satuan" style="height:34px;" placeholder="Contoh: %, Unit, Orang">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><b>Lokasi</b></label>
                            <div class="lokasi-container">
                                <button type="button" class="btn btn-info btn-xs btn-select-lokasi" 
                                        data-toggle="modal" data-target="#ModalLokasi" 
                                        style="padding: 2px 10px; font-size: 11px; white-space: nowrap; height: 26px; line-height: 22px; flex-shrink: 0; margin-top: 2px;">
                                    <i class="fa fa-map-marker"></i> Pilih Lokasi
                                </button>
                                
                                <span id="LokasiPlaceholder" class="text-muted" style="font-size: 12px; color: #999; padding: 3px 0;">Belum ada lokasi</span>
                                <span id="SelectedLokasiText" style="display: none; font-size: 12px; color: #2c3e50; font-weight: 500; white-space: normal; word-wrap: break-word; word-break: break-word; line-height: 1.5; padding: 3px 0; flex: 1; max-height: 60px; overflow-y: auto;"></span>
                                <span id="RemoveLokasiBtn" style="display: none; cursor: pointer; color: #e74c3c; font-size: 16px; font-weight: bold; line-height: 1; padding: 2px 4px; flex-shrink: 0; margin-top: 2px;" onclick="removeSelectedLokasi()">✖</span>
                                
                                <input type="hidden" id="LokasiKode" value="">
                                <input type="hidden" id="LokasiNama" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Sumber Dana</b></label>
                            <input type="text" class="form-control" id="SumberDana" style="height:34px;" placeholder="APBD / APBN / Dana Desa">
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- PRIORITAS DAERAH & NASIONAL                                   -->
                <!-- ============================================================ -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Prioritas Daerah</b></label>
                            <input type="text" class="form-control" id="PrioritasDaerah" style="height:34px;" placeholder="Prioritas daerah...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Prioritas Nasional</b></label>
                            <input type="text" class="form-control" id="PrioritasNasional" style="height:34px;" placeholder="Prioritas nasional...">
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- ============================================================ -->
                <!-- RANWAL RENJA                                                 -->
                <!-- ============================================================ -->
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #e9ecef; font-weight: bold; font-size: 13px;">
                        <i class="fa fa-file-text-o"></i> RANWAL RENJA
                    </div>
                    <div class="panel-body">
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
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- RANCANGAN RENJA                                              -->
                <!-- ============================================================ -->
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #e9ecef; font-weight: bold; font-size: 13px;">
                        <i class="fa fa-file-text-o"></i> RANCANGAN RENJA
                    </div>
                    <div class="panel-body">
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
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- RANHIR RENJA                                                 -->
                <!-- ============================================================ -->
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #e9ecef; font-weight: bold; font-size: 13px;">
                        <i class="fa fa-file-text-o"></i> RANHIR RENJA
                    </div>
                    <div class="panel-body">
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
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- RENJA                                                        -->
                <!-- ============================================================ -->
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #e9ecef; font-weight: bold; font-size: 13px;">
                        <i class="fa fa-file-text-o"></i> RENJA
                    </div>
                    <div class="panel-body">
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
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- DPA MURNI                                                    -->
                <!-- ============================================================ -->
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #e9ecef; font-weight: bold; font-size: 13px;">
                        <i class="fa fa-file-text-o"></i> DPA MURNI
                    </div>
                    <div class="panel-body">
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
                    </div>
                </div>
                
                <!-- ============================================================ -->
                <!-- DPA PERUBAHAN                                                -->
                <!-- ============================================================ -->
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #e9ecef; font-weight: bold; font-size: 13px;">
                        <i class="fa fa-file-text-o"></i> DPA PERUBAHAN
                    </div>
                    <div class="panel-body">
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
                    </div>
                </div>
                
                <hr>
                
                <!-- ============================================================ -->
                <!-- BIDANG PENGAMPU & PENGAMPU                                   -->
                <!-- ============================================================ -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group bidang-pengampu-container">
                            <label><b>Bidang Pengampu</b> <span class="text-danger">*</span></label>
                            <select class="form-control" id="BidangPengampu" style="width: 100%;">
                                <option value="">-- Pilih Bidang Pengampu --</option>
                            </select>
                            <small class="text-muted" style="display: block; margin-top: 5px; font-size: 11px; color: #6c757d;">
                                Pilih bidang pengampu untuk melihat daftar pengampu
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pengampu-container" id="PengampuGroup" style="display: none;">
                            <label><b>Pengampu</b> <span class="text-danger">*</span></label>
                            <select class="form-control" id="Pengampu" style="width: 100%;">
                                <option value="">-- Pilih Pengampu --</option>
                            </select>
                            <span class="pengampu-loading" id="PengampuLoading" style="display: none;">
                                <i class="fa fa-spinner fa-spin"></i> Memuat pengampu...
                            </span>
                            <div class="pengampu-info" id="PengampuInfo" style="display: none;">
                                <span class="label">Pengampu:</span>
                                <span class="nama" id="PengampuNama"></span>
                                <span class="jabatan" id="PengampuJabatan"></span>
                                <span class="nip" id="PengampuNip"></span>
                            </div>
                            <small class="text-muted" style="display: block; margin-top: 5px; font-size: 11px; color: #6c757d;">
                                Pilih bidang pengampu terlebih dahulu
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="flex-shrink: 0; background: #f8f9fa; border-top: 1px solid #dee2e6; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</button>
                <button class="btn btn-success" id="BtnSimpanDetail"><i class="fa fa-save"></i> SIMPAN</button>
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
            <div class="modal-footer" style="flex-shrink: 0; border-top: 1px solid #e5e5e5; padding: 10px 20px; background: #fafafa; border-radius: 0 0 8px 8px;">
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
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var TAHUN_AKTIF = '<?= $TahunAktif ?? date('Y') ?>';

// ================================================================
// FUNGSI UTILITY
// ================================================================
function showLoading() {
    $('#loadingOverlay').css('display', 'flex');
}

function hideLoading() {
    $('#loadingOverlay').css('display', 'none');
}

function escapeHtml(text) {
    if (!text) return '';
    return String(text).replace(/[&<>"']/g, function(m) {
        var map = {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'};
        return map[m];
    });
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
// SHOW OLD DATA
// ================================================================
function showOldData(oldDataJson) {
    try {
        var oldData = JSON.parse(oldDataJson);
        var html = '<div style="margin-bottom: 15px;">';
        html += '<div class="alert alert-info" style="font-size: 12px; padding: 8px 12px;">';
        html += '<i class="fa fa-info-circle"></i> Berikut adalah data sebelum diedit oleh Daerah';
        html += '</div>';
        html += '<div style="background: #f8f9fa; border-radius: 4px; padding: 10px;">';
        
        var fields = {
            'indikator_kinerja': 'Indikator Kinerja',
            'satuan': 'Satuan',
            'prioritas_daerah': 'Prioritas Daerah',
            'prioritas_nasional': 'Prioritas Nasional',
            'ranwal_kinerja': 'Ranwal Kinerja',
            'ranwal_rp': 'Ranwal Rp',
            'rancangan_kinerja': 'Rancangan Kinerja',
            'rancangan_rp': 'Rancangan Rp',
            'ranhir_kinerja': 'Ranhir Kinerja',
            'ranhir_rp': 'Ranhir Rp',
            'renja_kinerja': 'Renja Kinerja',
            'renja_rp': 'Renja Rp',
            'dpa_murni_kinerja': 'DPA Murni Kinerja',
            'dpa_murni_rp': 'DPA Murni Rp',
            'sumber_dana': 'Sumber Dana',
            'dpa_perubahan_kinerja': 'DPA Perubahan Kinerja',
            'dpa_perubahan_rp': 'DPA Perubahan Rp'
        };
        
        var hasData = false;
        for (var key in fields) {
            if (oldData[key] !== undefined && oldData[key] !== null && oldData[key] !== '') {
                hasData = true;
                var value = oldData[key];
                if (key.indexOf('_rp') !== -1 && !isNaN(value) && value !== '') {
                    value = 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                }
                html += '<div class="old-data-item">';
                html += '<span class="label">' + fields[key] + ':</span>';
                html += '<span class="value">' + escapeHtml(String(value)) + '</span>';
                html += '</div>';
            }
        }
        
        if (!hasData) {
            html += '<div class="text-muted text-center" style="padding: 20px 0;">';
            html += '<i class="fa fa-info-circle"></i> Tidak ada data lama yang tersimpan';
            html += '</div>';
        }
        
        html += '</div></div>';
        $('#OldDataContainer').html(html);
        $('#ModalOldData').modal('show');
    } catch(e) {
        console.error('Error showing old data:', e);
        alert('Gagal menampilkan data lama');
    }
}

// ================================================================
// FUNGSI LOKASI
// ================================================================
var lokasiCache = {
    provinsi: null,
    kabkota: {}
};

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
}

function removeSelectedLokasi() {
    $('#LokasiKode').val('');
    $('#LokasiNama').val('');
    $('#SelectedLokasiText').hide().text('');
    $('#RemoveLokasiBtn').hide();
    $('#LokasiPlaceholder').show();
}

// EVENT LOKASI
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

// ================================================================
// SELECT2 INIT
// ================================================================
function initSelect2(selector, placeholder, dropdownParent) {
    if ($(selector).hasClass('select2-hidden-accessible')) {
        $(selector).select2('destroy');
    }
    $(selector).select2({
        placeholder: placeholder || 'Pilih...',
        dropdownParent: dropdownParent || $('#ModalDetail'),
        width: '100%',
        allowClear: true
    });
}

// ================================================================
// DROPDOWN BIDANG PENGAMPU & PENGAMPU
// ================================================================

/**
 * Load data Bidang Pengampu (Dinas)
 */
function loadBidangPengampuOptions(selectedId = '', callback = null) {
    $('#PengampuGroup').removeClass('show').hide();
    $('#Pengampu').val('').trigger('change');
    $('#PengampuLoading').hide();
    $('#PengampuInfo').hide();
    
    $.ajax({
        url: BaseURL + 'Instansi/getDaftarDinasRenja',
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {
            $('#BidangPengampu').html('<option value="">Loading...</option>');
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
            
            $('#BidangPengampu').html(options);
            
            if ($('#BidangPengampu').hasClass('select2-hidden-accessible')) {
                $('#BidangPengampu').select2('destroy');
            }
            $('#BidangPengampu').select2({
                placeholder: 'Pilih Bidang Pengampu...',
                dropdownParent: $('#ModalDetail'),
                width: '100%',
                allowClear: true
            });
            
            if (selectedId) {
                $('#BidangPengampu').val(selectedId).trigger('change');
            }
            
            if (typeof callback === 'function') callback();
        },
        error: function() {
            $('#BidangPengampu').html('<option value="">Gagal memuat data</option>');
            if ($('#BidangPengampu').hasClass('select2-hidden-accessible')) {
                $('#BidangPengampu').select2('destroy');
            }
            $('#BidangPengampu').select2({
                placeholder: 'Pilih Bidang Pengampu...',
                dropdownParent: $('#ModalDetail'),
                width: '100%',
                allowClear: true
            });
            if (typeof callback === 'function') callback();
        }
    });
}

/**
 * Load Pengampu berdasarkan Bidang yang dipilih
 */
function loadPengampuByBidang(dinasId, selectedPelaksanaId = '') {
    if (!dinasId || dinasId === '') {
        $('#PengampuGroup').removeClass('show').hide();
        $('#Pengampu').html('<option value="">-- Pilih Pengampu --</option>');
        if ($('#Pengampu').hasClass('select2-hidden-accessible')) {
            $('#Pengampu').select2('destroy');
        }
        $('#Pengampu').select2({
            placeholder: 'Pilih Pengampu...',
            dropdownParent: $('#ModalDetail'),
            width: '100%',
            allowClear: true
        });
        $('.pengampu-container .text-muted').text('Pilih bidang pengampu terlebih dahulu');
        $('#PengampuInfo').hide();
        return;
    }
    
    $('#PengampuGroup').show().addClass('show');
    $('#PengampuLoading').show();
    $('#Pengampu').prop('disabled', true);
    
    if ($('#Pengampu').hasClass('select2-hidden-accessible')) {
        $('#Pengampu').select2('destroy');
    }
    $('#Pengampu').html('<option value="">Loading...</option>');
    
    $.ajax({
        url: BaseURL + 'Instansi/getPelaksanaByDinasRenja',
        type: 'POST',
        data: { 
            dinas_id: dinasId,
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: 'json',
        success: function(data) {
            $('#PengampuLoading').hide();
            $('#Pengampu').prop('disabled', false);
            
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
                $('.pengampu-container .text-muted').text('Pilih pengampu untuk bidang ini');
            } else {
                options += '<option value="" disabled>Tidak ada pengampu untuk bidang ini</option>';
                $('.pengampu-container .text-muted').text('Tidak ada pengampu tersedia untuk bidang ini');
            }
            
            $('#Pengampu').html(options);
            
            $('#Pengampu').select2({
                placeholder: 'Pilih Pengampu...',
                dropdownParent: $('#ModalDetail'),
                width: '100%',
                allowClear: true
            });
            
            if (selectedPelaksanaId) {
                setTimeout(function() {
                    $('#Pengampu').val(selectedPelaksanaId).trigger('change');
                }, 100);
            }
        },
        error: function() {
            $('#PengampuLoading').hide();
            $('#Pengampu').prop('disabled', false);
            $('#Pengampu').html('<option value="">Gagal memuat data</option>');
            
            if ($('#Pengampu').hasClass('select2-hidden-accessible')) {
                $('#Pengampu').select2('destroy');
            }
            $('#Pengampu').select2({
                placeholder: 'Pilih Pengampu...',
                dropdownParent: $('#ModalDetail'),
                width: '100%',
                allowClear: true
            });
            $('.pengampu-container .text-muted').text('Gagal memuat data pengampu');
            $('#PengampuInfo').hide();
            alert('Gagal memuat data pengampu. Silakan coba lagi.');
        }
    });
}

// ================================================================
// EVENT CHANGE BIDANG PENGAMPU
// ================================================================
$(document).off('change', '#BidangPengampu').on('change', '#BidangPengampu', function() {
    let dinasId = $(this).val();
    
    if (dinasId && dinasId !== '') {
        loadPengampuByBidang(dinasId, '');
    } else {
        $('#PengampuGroup').removeClass('show').hide();
        $('#Pengampu').html('<option value="">-- Pilih Pengampu --</option>');
        if ($('#Pengampu').hasClass('select2-hidden-accessible')) {
            $('#Pengampu').select2('destroy');
        }
        $('#Pengampu').select2({
            placeholder: 'Pilih Pengampu...',
            dropdownParent: $('#ModalDetail'),
            width: '100%',
            allowClear: true
        });
        $('.pengampu-container .text-muted').text('Pilih bidang pengampu terlebih dahulu');
        $('#PengampuInfo').hide();
    }
});

// ================================================================
// EVENT PENGAMPU - TAMPILKAN INFO
// ================================================================
$(document).off('change', '#Pengampu').on('change', '#Pengampu', function() {
    var selected = $(this).find('option:selected');
    var nama = selected.data('nama') || '';
    var jabatan = selected.data('jabatan') || '';
    var nip = selected.data('nip') || '';
    
    if (nama) {
        $('#PengampuInfo').show();
        $('#PengampuNama').text(nama);
        $('#PengampuJabatan').text(jabatan ? ' - ' + jabatan : '');
        $('#PengampuNip').text(nip ? ' (NIP: ' + nip + ')' : '');
    } else {
        $('#PengampuInfo').hide();
    }
});

// ================================================================
// PERBAIKAN - MENCEGAH DROPDOWN TERTUTUP SAAT SCROLL
// ================================================================

// Saat modal ditampilkan, pastikan Select2 berfungsi dengan baik
$('#ModalDetail').on('shown.bs.modal', function() {
    // Re-inisialisasi Select2 Bidang Pengampu
    if ($('#BidangPengampu').hasClass('select2-hidden-accessible')) {
        $('#BidangPengampu').select2('destroy');
    }
    $('#BidangPengampu').select2({
        placeholder: 'Pilih Bidang Pengampu...',
        dropdownParent: $('#ModalDetail'),
        width: '100%',
        allowClear: true
    });
    
    // Re-inisialisasi Select2 Pengampu
    if ($('#Pengampu').hasClass('select2-hidden-accessible')) {
        $('#Pengampu').select2('destroy');
    }
    $('#Pengampu').select2({
        placeholder: 'Pilih Pengampu...',
        dropdownParent: $('#ModalDetail'),
        width: '100%',
        allowClear: true
    });
    
    // Jika ada nilai Bidang Pengampu, load Pengampu
    let bidangValue = $('#BidangPengampu').val();
    if (bidangValue && bidangValue !== '') {
        loadPengampuByBidang(bidangValue, $('#Pengampu').val());
    } else {
        $('#PengampuGroup').removeClass('show').hide();
        $('.pengampu-container .text-muted').text('Pilih bidang pengampu terlebih dahulu');
        $('#PengampuInfo').hide();
    }
});

// Mencegah dropdown Select2 tertutup saat klik di dalam dropdown
$(document).on('mousedown', '.select2-dropdown', function(e) {
    e.stopPropagation();
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

// Saat modal akan ditutup, destroy Select2 untuk mencegah memory leak
$('#ModalDetail').on('hidden.bs.modal', function() {
    if ($('#BidangPengampu').hasClass('select2-hidden-accessible')) {
        $('#BidangPengampu').select2('destroy');
    }
    if ($('#Pengampu').hasClass('select2-hidden-accessible')) {
        $('#Pengampu').select2('destroy');
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
// EDIT DETAIL
// ================================================================
$(document).off('click', '.BtnEditDetail').on('click', '.BtnEditDetail', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var headerId = $(this).data('header-id') || 0;
    
    if (!id) { alert('ID tidak valid!'); return; }
    
    showLoading();
    $('#DetailHeaderId').val(headerId);
    
    $.ajax({
        url: BaseURL + "Instansi/getRancanganAkhirDetail",
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
                
                $('#DetailHeaderInfo').text('Kode Rekening: ' + (d.kode_rekening || '-') + 
                                            ' | Tahun: ' + (d.tahun || '-'));
                
                $('#IndikatorKinerja').val(d.indikator_kinerja || '');
                $('#Satuan').val(d.satuan || '');
                
                if (d.lokasi) {
                    if (d.lokasi.indexOf('manual_') === 0) {
                        setSelectedLokasi(d.lokasi, d.lokasi_nama || d.lokasi);
                    } else {
                        $.ajax({
                            url: BaseURL + "Instansi/getLokasiDetail",
                            type: "POST",
                            data: { 
                                kode: d.lokasi,
                                [CSRF_NAME]: CSRF_TOKEN 
                            },
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
                
                var bidangId = d.bidang_pengampu || '';
                var pengampuId = d.pengampu || '';
                
                $('#PengampuGroup').removeClass('show').hide();
                $('#Pengampu').val('').trigger('change');
                $('#PengampuInfo').hide();
                
                if (bidangId) {
                    loadBidangPengampuOptions(bidangId, function() {
                        if (pengampuId) {
                            setTimeout(function() {
                                loadPengampuByBidang(bidangId, pengampuId);
                            }, 300);
                        } else {
                            setTimeout(function() {
                                loadPengampuByBidang(bidangId, '');
                            }, 300);
                        }
                    });
                } else {
                    loadBidangPengampuOptions('');
                }
                
                $('#ModalDetail').modal('show');
            } else {
                alert(res.message || 'Gagal memuat data');
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan: " + error);
        }
    });
});

// ================================================================
// HAPUS DETAIL
// ================================================================
$(document).off('click', '.BtnHapusDetail').on('click', '.BtnHapusDetail', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    if (!id) { alert('ID tidak valid!'); return; }
    if (!confirm("Yakin hapus indikator ini dari Rancangan Akhir Renja?")) return;
    
    showLoading();
    $.ajax({
        url: BaseURL + "Instansi/HapusRancanganAkhirDetail",
        type: "POST",
        data: { 
            id: id, 
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                alert(res.message);
                location.reload();
            } else {
                alert(res.message || "Gagal hapus!");
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan: " + error);
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
    
    var bidangPengampu = $('#BidangPengampu').val();
    if (!bidangPengampu) {
        alert('Bidang Pengampu wajib dipilih!');
        $('#BidangPengampu').focus();
        return;
    }
    
    var pengampu = $('#Pengampu').val();
    if (!pengampu) {
        alert('Pengampu wajib dipilih!');
        $('#Pengampu').focus();
        return;
    }
    
    showLoading();
    
    var formatAngka = function(val) {
        if (!val) return '';
        return val.replace(/[^0-9]/g, '');
    };
    
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
        ranwal_rp: formatAngka($('#RanwalRp').val()),
        rancangan_kinerja: $('#RancanganKinerja').val(),
        rancangan_rp: formatAngka($('#RancanganRp').val()),
        ranhir_kinerja: $('#RanhirKinerja').val(),
        ranhir_rp: formatAngka($('#RanhirRp').val()),
        renja_kinerja: $('#RenjaKinerja').val(),
        renja_rp: formatAngka($('#RenjaRp').val()),
        dpa_murni_kinerja: $('#DpaMurniKinerja').val(),
        dpa_murni_rp: formatAngka($('#DpaMurniRp').val()),
        sumber_dana: $('#SumberDana').val(),
        dpa_perubahan_kinerja: $('#DpaPerubahanKinerja').val(),
        dpa_perubahan_rp: formatAngka($('#DpaPerubahanRp').val()),
        bidang_pengampu: bidangPengampu,
        pengampu: pengampu,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $.ajax({
        url: BaseURL + "Instansi/EditRancanganAkhirDetail",
        type: "POST",
        data: data,
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                alert(res.message || 'Indikator berhasil diperbarui!');
                location.reload();
            } else {
                alert(res.message || "Gagal menyimpan indikator");
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan: " + error);
        }
    });
});

// ================================================================
// AMBIL DATA RANCANGAN AKHIR
// ================================================================
function ambilDataRancangan() {
    if (!confirm("Yakin ingin mengambil data dari Rancangan Renja?\n\nData Rancangan Akhir yang ada akan dihapus dan diganti dengan data baru.")) {
        return;
    }
    
    showLoading();
    $.ajax({
        url: BaseURL + "Instansi/AmbilDataRancanganAkhir",
        type: "POST",
        data: { 
            tahun: TAHUN_AKTIF,
            [CSRF_NAME]: CSRF_TOKEN 
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                alert(res.message + "\n\nHeader: " + (res.data?.headers || 0) + "\nIndikator: " + (res.data?.details || 0));
                location.reload();
            } else {
                alert(res.message || "Gagal mengambil data!");
            }
        },
        error: function() {
            hideLoading();
            alert("Terjadi kesalahan: " + error);
        }
    });
}

// ================================================================
// FILTER WILAYAH (SEBELUM LOGIN)
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
                    var redirectUrl = BaseURL + "Instansi/RancanganAkhirRenjaPD";
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
                console.error('Error:', error);
                alert("Gagal menghubungi server! Status: " + status);
                $("#Filter").prop('disabled', false).text('Filter');
            }
        });
    });

<?php } ?>

// ================================================================
// FILTER INSTANSI (SETELAH LOGIN)
// ================================================================
<?php if (isset($_SESSION['KodeWilayah']) && !$IsRole4) { ?>
    
    function filterByInstansi(instansiId) {
        var url = new URL(window.location.href);
        if (instansiId && instansiId != '') {
            url.searchParams.set('instansi_id', instansiId);
        } else {
            url.searchParams.delete('instansi_id');
        }
        window.location.href = url.toString();
    }

    function applyFilterInstansi() {
        var instansiId = $('#FilterInstansiAfterLogin').val();
        filterByInstansi(instansiId);
    }

<?php } ?>

// ================================================================
// INIT
// ================================================================
$(document).ready(function() {
    // Init DataTable
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
    
    // Auto filter dari URL parameter
    <?php if (!empty($FilterInstansiId) && isset($_SESSION['KodeWilayah']) && !$IsRole4) { ?>
        $('#FilterInstansiAfterLogin').val('<?= $FilterInstansiId ?>');
    <?php } ?>
    
    // Load Provinsi untuk modal lokasi
    $('#ModalLokasi').on('shown.bs.modal', function() {
        if ($('#LokasiProvinsi option').length <= 1) {
            loadProvinsi('');
        }
    });
});
</script>

</body>
</html>