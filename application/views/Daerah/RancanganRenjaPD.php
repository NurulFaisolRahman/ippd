<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rancangan Renja PD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSS umum -->
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

        /* Pastikan dropdown Select2 tetap terlihat di dalam modal */
        .select2-container--open .select2-dropdown {
            position: fixed !important;
            z-index: 9999999 !important;
            max-height: 300px !important;
            overflow-y: auto !important;
        }

        /* Mencegah overlay menutupi dropdown */
        .modal-backdrop {
            z-index: 999998 !important;
        }

        /* Perbaikan untuk modal body saat scroll */
        .modal-body {
            overflow-y: auto !important;
            max-height: 70vh !important;
            padding-right: 15px !important;
        }

        /* Mencegah dropdown tertutup saat scroll di dalam modal */
        .select2-container--open .select2-dropdown {
            position: fixed !important;
            top: auto !important;
            bottom: auto !important;
            left: auto !important;
            right: auto !important;
        }

        /* ===== CSS LAINNYA ===== */
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
        
        .no-data {
            padding: 30px 0;
            color: #999;
        }
        
        .nav-tabs {
            margin-bottom: 20px;
        }
        
        .nav-tabs > li > a {
            font-weight: 500;
        }
        
        .btn-group-aksi .btn {
            min-width: 30px;
            padding: 4px 8px;
            cursor: pointer !important;
            pointer-events: auto !important;
            z-index: 10 !important;
            position: relative !important;
        }
        
        .btn-group-aksi .btn i {
            font-size: 14px;
        }
        
        .BtnEditDetail, .BtnHapusDetail {
            cursor: pointer !important;
            pointer-events: auto !important;
            z-index: 10 !important;
            position: relative !important;
        }
        
        .BtnEditDetail:hover, .BtnHapusDetail:hover {
            opacity: 0.8 !important;
            transform: scale(1.05) !important;
            transition: all 0.2s ease !important;
        }
        
        .btn-group-aksi {
            position: relative !important;
            z-index: 5 !important;
        }
        
        .table-detail-indikator .btn {
            padding: 2px 5px;
            font-size: 10px;
        }
        
        .table-detail-indikator td {
            vertical-align: middle;
            padding: 4px;
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

        .detail-container {
            padding: 5px 5px 5px 30px;
            overflow-x: auto;
        }
        
        .detail-container .table {
            min-width: 1500px;
        }

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
        }

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
            z-index: 9999999 !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff !important;
        }

        .header-row .header-clickable {
            cursor: pointer;
            user-select: none;
        }
        
        .header-row .header-clickable:hover {
            background-color: rgba(0,0,0,0.02);
        }

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
        
        .table-detail-indikator thead th.header-indikator small {
            font-size: 8px;
        }
        
        .row-indikator-detail {
            transition: background-color 0.2s ease;
        }
        
        .row-indikator-detail:hover {
            background-color: #f0f8ff;
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
        
        .row-indikator-detail .col-indikator-kinerja-item .indikator-item {
            display: block;
            line-height: 1.3;
        }
        
        .row-indikator-detail .col-indikator-kinerja-item .indikator-item .text-indikator {
            display: block;
            line-height: 1.3;
        }
        
        .row-indikator-detail .col-indikator-kinerja-item .indikator-item .text-indikator .satuan-label {
            font-size: 8px;
            color: #6c757d;
            background: #e9ecef;
            padding: 1px 5px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 1px;
        }
        
        .table-detail-indikator td {
            font-size: 9px;
            padding: 3px 4px;
        }
        
        .table-detail-indikator td.rp {
            font-size: 9px;
            white-space: nowrap;
        }

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

        .select2-container--open {
            z-index: 9999999 !important;
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

        .badge-edit-sm {
            display: block;
            text-align: center;
            background: #ffc107;
            color: #856404;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }

        .badge-edit-sm i {
            margin-right: 2px;
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
        .sync-info-text {
            font-size: 12px;
            color: #666;
            margin-left: 10px;
        }
        .sync-info-text i {
            color: #17a2b8;
        }

        .source-data-info {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .source-data-info i {
            color: #1565c0;
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

                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
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
                                            
                                            <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display: <?= !empty($KodeWilayah) ? 'block' : 'none' ?>;">
                                                <div class="filter-group">
                                                    <label for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansiBeforeLogin">
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

                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="filter-group">
                                                    <label for="FilterInstansi"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansi">
                                                        <option value="">-- Semua Instansi --</option>
                                                        <?php foreach ($ListInstansi as $ins) { ?>
                                                            <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                                <?= html_escape($ins['nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                                                        <b>Tampilkan</b>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn">
                                                        <b>Reset</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php 
                        $has_daerah_edit = false;
                        $total_daerah_edit = 0;
                        $daerah_edit_details = [];
                        foreach ($RancanganData as $row) {
                            foreach ($row['details'] as $detail) {
                                if (!empty($detail['edited_by_daerah']) && $detail['edited_by_daerah'] == 1) {
                                    $has_daerah_edit = true;
                                    $total_daerah_edit++;
                                    $daerah_edit_details[] = [
                                        'id' => $detail['id'],
                                        'indikator' => $detail['indikator_kinerja'] ?? '-',
                                        'time' => $detail['daerah_edit_time'] ?? '-'
                                    ];
                                }
                            }
                        }
                        ?>

                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                            </div>
                        <?php } ?>

                        <?php if ($IsRole4) { ?>
                            <div class="basic-tb-hd">
                                <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                                    <button class="btn btn-sync-rancangan" id="BtnSyncRancangan">
                                        <i class="fa fa-refresh"></i> <b>Sinkronisasi dari Renja PD</b>
                                    </button>
                                    <span class="sync-info-text">
                                        <i class="fa fa-info-circle"></i> Ambil data terbaru dari Renja PD ke Rancangan Renja
                                    </span>
                                </div>
                            </div>
                            <br>
                        <?php } ?>

                        <?php if (!empty($RancanganData)) { ?>
                            <div class="source-data-info">
                                <i class="fa fa-info-circle"></i> 
                                <strong>Data Rancangan:</strong> Data ini adalah hasil sinkronisasi otomatis dari Renja PD. 
                                Edit/Hapus hanya mempengaruhi data rancangan ini, <strong>TIDAK</strong> mengubah data Renja PD asli.
                            </div>
                        <?php } ?>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-renja">
                                <thead>
                                    <tr>
                                        <th style="min-width:120px;">Kode Rekening</th>
                                        <th style="min-width:200px;">Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan Perangkat Daerah</th>
                                        <th style="width:80px;">Jumlah Indikator</th>
                                        <?php if ($IsRole4) { ?>
                                            <th style="width:80px;">Status</th>
                                            <th style="width:80px;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($RancanganData)) { ?>
                                        <?php foreach ($RancanganData as $row) { 
                                            $has_daerah_edit_row = false;
                                            foreach ($row['details'] as $det) {
                                                if (!empty($det['edited_by_daerah']) && $det['edited_by_daerah'] == 1) {
                                                    $has_daerah_edit_row = true;
                                                    break;
                                                }
                                            }
                                        ?>
                                            <tr class="header-row <?= $has_daerah_edit_row ? 'has-daerah-edit' : '' ?>" 
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
                                                    }
                                                    echo nl2br(html_escape($display_text ?: '-'));
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
                                                            <span class="badge" style="background: #ffc107; color: #fff;">
                                                                Diedit Daerah
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
                                            
                                            <?php if (!empty($row['details'])) { ?>
                                                <tr class="detail-row detail-hidden" data-header-id="<?= $row['id'] ?>">
                                                    <td colspan="6" style="padding:0;">
                                                        <div class="detail-container">
                                                            <table class="table table-bordered table-condensed table-detail-indikator" style="margin:0; font-size:10px; min-width:1500px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th rowspan="2" class="header-indikator" style="width:14%; vertical-align:middle; min-width:140px;">
                                                                            <span style="font-size:10px; font-weight:800;">INDIKATOR KINERJA</span>
                                                                            <br><small style="font-weight:400; color:#6c757d;">(Klik untuk edit)</small>
                                                                        </th>
                                                                        <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">Satuan</th>
                                                                        <th rowspan="2" style="width:7%;vertical-align:middle; font-size:9px;">Lokasi</th>
                                                                        <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">Prioritas Daerah</th>
                                                                        <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">Prioritas Nasional</th>
                                                                        
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Ranwal Renja</th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Rancangan Renja</th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Ranhir Renja</th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">Renja </th>
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">DPA Murni </th>
                                                                        
                                                                        <th rowspan="2" style="width:4%;vertical-align:middle; font-size:9px;">Sumber</th>
                                                                        
                                                                        <th colspan="2" style="width:7%;text-align:center;background:#e9ecef; font-size:9px;">DPA Perubahan </th>
                                                                        
                                                                        <!-- ===== KOLOM BIDANG & PENGAMPU DIPERLEBAR ===== -->
                                                                        <th rowspan="2" style="width:12%;vertical-align:middle; font-size:9px; min-width:180px;">
                                                                            Bidang &amp; Pengampu
                                                                            <br><small style="font-weight:400; font-size:7px; color:#6c757d;">(Jabatan - Nama)</small>
                                                                        </th>
                                                                        
                                                                        <?php if ($IsRole4) { ?>
                                                                            <th rowspan="2" style="width:5%;vertical-align:middle; font-size:9px;">Status</th>
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
                                                                                <td>
                                                                                    <?php if ($is_edited_by_daerah) { ?>
                                                                                        <span class="badge-edit-sm">
                                                                                            <i class="fa fa-edit"></i> Diedit Daerah
                                                                                        </span>
                                                                                        <?php if ($old_data) { ?>
                                                                                            <button class="btn-view-old-data" 
                                                                                                    onclick="showOldData('<?= htmlspecialchars($detail['daerah_edit_old_data']) ?>')">
                                                                                                <i class="fa fa-history"></i> Data Lama
                                                                                            </button>
                                                                                        <?php } ?>
                                                                                    <?php } else { ?>
                                                                                        <span class="badge" style="background:#28a745; color:#fff; padding:2px 6px; border-radius:4px; font-size:8px; display:block; text-align:center;">
                                                                                            <i class="fa fa-check"></i> Normal
                                                                                        </span>
                                                                                    <?php } ?>
                                                                                </td>
                                                                                
                                                                                <td>
                                                                                    <div class="btn-group-aksi">
                                                                                        <button class="btn btn-warning btn-xs BtnEditDetail"
                                                                                            data-id="<?= $detail['id'] ?>"
                                                                                            data-header-id="<?= $row['id'] ?>"
                                                                                            title="Edit Indikator Rancangan"
                                                                                            type="button">
                                                                                            <i class="notika-icon notika-edit"></i>
                                                                                        </button>
                                                                                        <button class="btn btn-danger btn-xs BtnHapusDetail"
                                                                                            data-id="<?= $detail['id'] ?>"
                                                                                            title="Hapus Indikator Rancangan"
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
                                                <i>Belum ada data Rancangan Renja</i>
                                                <?php if ($IsRole4) { ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        Data akan otomatis muncul saat data Renja PD dibuat/diubah.
                                                        <br>
                                                        <i class="fa fa-info-circle"></i> 
                                                        Sistem akan mensinkronisasi secara otomatis.
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
<!-- MODAL EDIT DETAIL RANCANGAN                                  -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalDetail" role="dialog" style="z-index: 999999 !important;">
    <div class="modal-dialog modal-lg" style="position: relative; margin: 30px auto !important; max-width: 900px;">
        <div class="modal-content" style="max-height: 100vh; overflow: hidden; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="flex-shrink: 0; background: #f8f9fa; border-bottom: 2px solid #e9ecef; border-radius: 8px 8px 0 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b id="ModalDetailTitle">Edit Indikator Rancangan</b></h4>
                <small id="DetailHeaderInfo" class="text-muted"></small>
                <div class="alert alert-warning" style="margin-top: 10px; padding: 8px 12px; font-size: 12px;">
                    <i class="fa fa-info-circle"></i> Perubahan hanya mempengaruhi data Rancangan Renja
                </div>
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
                
                <!-- Row 2 -->
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
                
                <!-- Row 3 -->
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
                
                <h5><b>RENJA </b></h5>
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
                
                <h5><b>DPA MURNI </b></h5>
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
                
                <h5><b>DPA PERUBAHAN </b></h5>
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
                
                <!-- BIDANG PENGAMPU & PENGAMPU -->
                <hr>
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
                            <small class="text-muted" style="display: block; margin-top: 5px; font-size: 11px; color: #6c757d;">
                                Pilih bidang pengampu terlebih dahulu
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="flex-shrink: 0; border-top: 1px solid #e5e5e5; padding: 10px 20px; background: #fafafa; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                <button class="btn btn-success" id="BtnSimpanDetail"><b>SIMPAN PERUBAHAN</b></button>
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
<!-- MODAL DATA LAMA                                              -->
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
var TAHUN_AKTIF = '<?= $TahunAktif ?? date('Y') ?>';

var lokasiCache = {
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
        $('#ModalDetail .modal-body').scrollTop(0);
    }, 100);
}

function removeSelectedLokasi() {
    $('#LokasiKode').val('');
    $('#LokasiNama').val('');
    $('#SelectedLokasiText').hide().text('');
    $('#RemoveLokasiBtn').hide();
    $('#LokasiPlaceholder').show();
    
    setTimeout(function() {
        $(window).trigger('resize');
    }, 100);
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
// SCROLL FIX
// ================================================================
$('#ModalLokasi').on('hidden.bs.modal', function() {
    $(window).trigger('resize');
    $('body').removeClass('modal-open');
    $('body').css('overflow', 'auto');
    $('html').css('overflow', 'auto');
    
    var $modalDetail = $('#ModalDetail');
    if ($modalDetail.hasClass('in')) {
        $modalDetail.find('.modal-body').scrollTop(0);
    }
});

$('#ModalDetail').on('shown.bs.modal', function() {
    var $body = $(this).find('.modal-body');
    $body.css('max-height', '70vh');
    $body.css('overflow-y', 'auto');
    $('body').css('overflow', 'auto');
    $('html').css('overflow', 'auto');
    
    // Re-inisialisasi Select2
    if (!$('#BidangPengampu').hasClass('select2-hidden-accessible')) {
        $('#BidangPengampu').select2({
            placeholder: 'Pilih Bidang Pengampu...',
            dropdownParent: $('#ModalDetail'),
            width: '100%',
            allowClear: true,
            dropdownCssClass: 'select2-modal-dropdown'
        });
    }
    if (!$('#Pengampu').hasClass('select2-hidden-accessible')) {
        $('#Pengampu').select2({
            placeholder: 'Pilih Pengampu...',
            dropdownParent: $('#ModalDetail'),
            width: '100%',
            allowClear: true,
            dropdownCssClass: 'select2-modal-dropdown'
        });
    }
    
    let bidangValue = $('#BidangPengampu').val();
    if (bidangValue && bidangValue !== '') {
        loadPengampuByBidang(bidangValue, $('#Pengampu').val());
    } else {
        $('#PengampuGroup').removeClass('show').hide();
        $('.pengampu-container .text-muted').text('Pilih bidang pengampu terlebih dahulu');
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

// Mencegah dropdown Select2 tertutup saat scroll
$(document).on('select2:open', function(e) {
    var $select = $(e.target);
    var $modal = $select.closest('.modal');
    if ($modal.length) {
        $modal.css('overflow-y', 'auto');
        // Pastikan dropdown tetap terbuka
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
                    var redirectUrl = BaseURL + "Instansi/RancanganRenjaPD";
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
        var url = BaseURL + "Instansi/RancanganRenjaPD";
        if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
        window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() { 
        window.location.href = BaseURL + "Instansi/RancanganRenjaPD"; 
    });
<?php } ?>

// ================================================================
// DROPDOWN BIDANG PENGAMPU & PENGAMPU
// ================================================================

function loadBidangPengampuOptions(selectedId = '', callback = null) {
    $('#PengampuGroup').removeClass('show').hide();
    $('#Pengampu').val('').trigger('change');
    $('#PengampuLoading').hide();
    
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
                allowClear: true,
                dropdownCssClass: 'select2-modal-dropdown'
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
                allowClear: true,
                dropdownCssClass: 'select2-modal-dropdown'
            });
            if (typeof callback === 'function') callback();
        }
    });
}

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
            allowClear: true,
            dropdownCssClass: 'select2-modal-dropdown'
        });
        $('.pengampu-container .text-muted').text('Pilih bidang pengampu terlebih dahulu');
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
                    options += `<option value="${item.id}" ${selected}>${escapeHtml(displayText)}</option>`;
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
                allowClear: true,
                dropdownCssClass: 'select2-modal-dropdown'
            });
            
            if (selectedPelaksanaId) {
                setTimeout(function() {
                    $('#Pengampu').val(selectedPelaksanaId).trigger('change');
                }, 100);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading pengampu:', error);
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
                allowClear: true,
                dropdownCssClass: 'select2-modal-dropdown'
            });
            $('.pengampu-container .text-muted').text('Gagal memuat data pengampu');
            alert('Gagal memuat data pengampu. Silakan coba lagi.');
        }
    });
}

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
            allowClear: true,
            dropdownCssClass: 'select2-modal-dropdown'
        });
        $('.pengampu-container .text-muted').text('Pilih bidang pengampu terlebih dahulu');
    }
});

// ================================================================
// SINKRONISASI DARI RENJA PD
// ================================================================
$(document).off('click', '#BtnSyncRancangan').on('click', '#BtnSyncRancangan', function(e) {
    e.preventDefault();
    
    var tahun = TAHUN_AKTIF;
    
    if (!confirm("Sinkronisasi akan mengambil data terbaru dari Renja PD ke Rancangan Renja.\nData Rancangan yang sudah ada akan diperbarui.\nLanjutkan?")) return;
    
    showLoading();
    
    $.ajax({
        url: BaseURL + "Instansi/SyncRancanganRenja",
        type: "POST",
        data: {
            tahun: tahun,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: "json",
        success: function(res) {
            hideLoading();
            if (res.status === "success") {
                alert(res.message || "Sinkronisasi berhasil!");
                location.reload();
            } else {
                alert(res.message || "Gagal sinkronisasi!");
            }
        },
        error: function(xhr, status, error) {
            hideLoading();
            console.error('Error:', xhr.responseText);
            alert("Terjadi kesalahan saat sinkronisasi: " + error);
        }
    });
});

// ================================================================
// EDIT DETAIL RANCANGAN
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
    $('#ModalDetailTitle').text('Edit Indikator Rancangan');
    
    $.ajax({
        url: BaseURL + "Instansi/getRancanganDetail",
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
                
                $('#PengampuGroup').removeClass('show').hide();
                $('#Pengampu').val('').trigger('change');
                
                if (bidangPengampu) {
                    loadBidangPengampuOptions(bidangPengampu, function() {
                        if (pengampu) {
                            loadPengampuByBidang(bidangPengampu, pengampu);
                        }
                    });
                } else {
                    loadBidangPengampuOptions('');
                }
                
                $('#ModalDetail').modal('show');
            } else {
                alert(res.message || 'Gagal memuat data indikator');
            }
        },
        error: function(xhr, status, error) {
            hideLoading();
            console.error('Error:', xhr.responseText);
            alert("Terjadi kesalahan saat memuat data: " + error);
        }
    });
});

// ================================================================
// HAPUS DETAIL RANCANGAN
// ================================================================
$(document).off('click', '.BtnHapusDetail').on('click', '.BtnHapusDetail', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    
    if (!id) {
        alert('ID tidak valid!');
        return;
    }
    
    if (!confirm("Yakin hapus indikator ini dari Rancangan Renja?")) return;
    
    showLoading();
    
    $.ajax({
        url: BaseURL + "Instansi/HapusRancanganDetail",
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
        error: function(xhr, status, error) {
            hideLoading();
            console.error('Error:', xhr.responseText);
            alert("Terjadi kesalahan saat menghapus data: " + error);
        }
    });
});

// ================================================================
// SIMPAN DETAIL RANCANGAN
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
        bidang_pengampu: bidangPengampu,
        pengampu: pengampu,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $.ajax({
        url: BaseURL + "Instansi/EditRancanganDetail",
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
        error: function(xhr, status, error) {
            hideLoading();
            console.error('Error detail:', xhr.responseText);
            alert("Terjadi kesalahan saat menyimpan indikator: " + error);
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