<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$sessionLevel = isset($_SESSION['Level']) ? $_SESSION['Level'] : (isset($this->session) ? $this->session->userdata('Level') : null);
$canEdit = ($sessionLevel === null) || ((string)$sessionLevel === '0') || (!empty($_SESSION['Admin']) && (string)$sessionLevel === '0');

// Helper function untuk menerjemahkan kode JSON kementerian menjadi string / badge nama
if (!function_exists('renderPengampuMatriks')) {
    function renderPengampuMatriks($jsonString, $map) {
        if (empty($jsonString)) return '<span style="color:#aaa;">-</span>';
        $arr = json_decode($jsonString, true);
        if (!is_array($arr)) {
            $arr = explode(',', $jsonString);
        }
        $badges = [];
        foreach ($arr as $kd) {
            $kd = trim($kd);
            if ($kd === '') continue;
            $name = isset($map[$kd]) ? $map[$kd] : $kd;
            $badges[] = '<span class="badge-pengampu" title="' . htmlspecialchars($name, ENT_QUOTES) . '">' . htmlspecialchars($name) . '</span>';
        }
        return empty($badges) ? '<span style="color:#aaa;">-</span>' : '<div class="pengampu-container">' . implode('', $badges) . '</div>';
    }
}

$dataMatriksList = isset($DataMatriks) ? $DataMatriks : (isset($ProyekStrategis) ? $ProyekStrategis : (isset($DataPN) ? $DataPN : []));
$mapKemen = isset($MapKementerian) ? $MapKementerian : [];
?>

<!-- Load Library Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Widescreen Container: Memperluas area agar tabel tidak berhimpitan */
    .data-table-area .container {
        width: 98% !important;
        max-width: 1750px !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    /* Global Font & Container Harmonization dengan Menu Lainnya */
    .data-table-area,
    .data-table-list,
    #hierarki-table,
    .matriks-toolbar,
    .modal {
        font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
    }

    /* CSS Modal Vertical Center */
    .modal {
        text-align: center;
        padding: 0 !important;
        z-index: 105000 !important;
        overflow-y: auto !important;
    }
    .modal-backdrop {
        z-index: 104990 !important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        width: 880px;
        max-width: 95%;
    }
    .modal-header h2 {
        font-size: 22px;
        color: #333;
        font-weight: 700;
        margin-bottom: 0;
        padding-bottom: 12px;
        border-bottom: 1px solid #eee;
    }

    /* Container Card - Ukuran Luas & Nyaman */
    .data-table-list {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 5px 22px rgba(0, 0, 0, 0.06);
        padding: 32px;
        border: none;
        margin-bottom: 30px;
    }

    /* Header Kontainer */
    .basic-tb-hd h3 {
        margin: 0;
        color: #1e293b;
        font-weight: 700;
        font-size: 24px;
        line-height: 1.4;
    }
    .basic-tb-hd small {
        color: #64748b;
        font-size: 14px;
        display: block;
        margin-top: 6px;
        line-height: 1.5;
    }

    /* KPI Stats Badges */
    .kpi-stat-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin: 16px 0 18px;
    }
    .kpi-stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 24px;
        font-size: 13px;
        font-weight: 600;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #334155;
    }
    .kpi-stat-pill b {
        font-size: 13px;
        padding: 3px 10px;
        border-radius: 14px;
        color: #fff;
    }
    .kpi-stat-pill.pill-pn b { background: #00c292; }
    .kpi-stat-pill.pill-pp b { background: #03a9f4; }
    .kpi-stat-pill.pill-kp b { background: #ff9800; }
    .kpi-stat-pill.pill-ind b { background: #673ab7; }

    /* Control Toolbar Lebih Lega & Nyaman */
    .matriks-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        background: #f8fafc;
        padding: 14px 18px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }
    .toolbar-left, .toolbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .matriks-search-box {
        position: relative;
        min-width: 320px;
    }
    .matriks-search-box input {
        width: 100%;
        padding: 10px 40px 10px 42px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        font-size: 14px;
        color: #1e293b;
        outline: none;
        height: 44px;
        transition: all 0.2s;
        background: #fff;
    }
    .matriks-search-box input:focus {
        border-color: #00c292;
        box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
    }
    .matriks-search-box i.search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 16px;
    }
    .matriks-search-box .clear-btn {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 17px;
        cursor: pointer;
        display: none;
        transition: color 0.2s;
    }
    .matriks-search-box .clear-btn:hover {
        color: #ef4444;
    }
    .matriks-filter-select {
        padding: 10px 14px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        font-size: 14px;
        background: #fff;
        color: #1e293b;
        outline: none;
        height: 44px;
        max-width: 380px;
    }
    .matriks-filter-select:focus {
        border-color: #00c292;
        box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
    }

    /* Table Responsive & Layout Anti-Bertabrakan */
    .table-responsive {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    #hierarki-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        min-width: 1350px;
        font-size: 13.5px;
        table-layout: auto;
    }
    #hierarki-table > thead > tr > th {
        background-color: #f1f5f9;
        color: #334155;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12.5px;
        letter-spacing: 0.5px;
        border: 1px solid #cbd5e1;
        vertical-align: middle;
        padding: 12px 10px;
        text-align: center;
        line-height: 1.4;
    }
    #hierarki-table td {
        border: 1px solid #e2e8f0;
        padding: 10px 12px;
        vertical-align: middle;
        color: #1e293b;
        font-size: 13.5px;
        line-height: 1.5;
    }

    /* Row Hover */
    #hierarki-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Hierarchy Left Borders */
    .border-pn { border-left: 6px solid #00c292 !important; }
    .border-pp { border-left: 6px solid #03a9f4 !important; }
    .border-kp { border-left: 6px solid #ff9800 !important; }
    .border-proyek { border-left: 6px solid #9c27b0 !important; }
    .border-sasaran { border-left: 5px solid #607d8b !important; }
    .border-indikator { border-left: 4px solid #cbd5e1 !important; }

    /* Hierarchy Row Colors & Font Sizes */
    tr.row-pn td { font-size: 15px !important; font-weight: 700; color: #0f172a; padding: 13px 12px; }
    tr.row-pn { background-color: #f8fafc !important; cursor: pointer; }
    
    tr.row-pp td { font-size: 14.5px !important; font-weight: 600; color: #1e293b; padding: 12px 12px; }
    tr.row-pp { background-color: #ffffff !important; cursor: pointer; }
    
    tr.row-kp td { font-size: 14px !important; font-weight: 600; color: #334155; padding: 11px 12px; }
    tr.row-kp { background-color: #ffffff !important; cursor: pointer; }
    
    tr.row-proyek td { font-size: 13.5px !important; font-weight: 600; color: #6a1b9a; padding: 11px 12px; }
    tr.row-proyek { background-color: #faf5ff !important; }
    
    tr.row-sasaran td { font-size: 13.5px !important; font-weight: 600; color: #1e293b; padding: 11px 12px; }
    tr.row-sasaran { background-color: #fcfcfd !important; cursor: pointer; }
    
    tr.row-indikator td { font-size: 13px !important; font-weight: 400; color: #334155; padding: 10px 12px; }
    tr.row-indikator { background-color: #ffffff !important; }

    /* Badges Lebih Rapi & Terbaca */
    .tipe-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11.5px;
        font-weight: 700;
        color: #ffffff;
        margin-right: 6px;
        letter-spacing: 0.3px;
        white-space: nowrap;
        vertical-align: middle;
        line-height: 1.3;
    }
    .tipe-pn { background-color: #00c292; }
    .tipe-pp { background-color: #03a9f4; }
    .tipe-kp { background-color: #ff9800; }
    .tipe-proyek { background-color: #9c27b0; }
    .tipe-sasaran { background-color: #607d8b; }
    .tipe-indikator { background-color: #78909c; }

    .badge-periode {
        background-color: #00c292;
        color: #ffffff;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-block;
        vertical-align: middle;
        margin-left: 8px;
    }
    .badge-satuan,
    .badge-baseline,
    .badge-target-awal,
    .badge-target-akhir {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.35;
        word-break: break-word;
        max-width: 100%;
        text-align: center;
    }
    .badge-satuan {
        background-color: #e1f5fe;
        color: #0288d1;
        border: 1px solid #b3e5fc;
    }
    .badge-baseline {
        background-color: #fff3e0;
        color: #e65100;
        border: 1px solid #ffe0b2;
    }
    .badge-target-awal {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
        font-weight: 700;
    }
    .badge-target-akhir {
        background-color: #ede7f6;
        color: #512da8;
        border: 1px solid #d1c4e9;
        font-weight: 700;
    }

    /* Pengampu Container & Badges */
    .pengampu-container {
        display: flex;
        flex-wrap: wrap;
        gap: 4px 6px;
        align-items: center;
        justify-content: flex-start;
    }
    .badge-pengampu {
        background-color: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
        line-height: 1.35;
        white-space: normal;
        word-break: break-word;
        max-width: 100%;
    }

    /* Kolom Aksi & Buttons Anti-Tabrakan */
    .col-aksi {
        white-space: nowrap !important;
        text-align: center !important;
        padding: 8px 10px !important;
        width: 220px;
        min-width: 210px;
    }
    .action-btn-group {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        flex-wrap: nowrap;
    }
    .btn-action {
        border-radius: 5px;
        margin: 0 !important;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        line-height: 1.3;
        vertical-align: middle;
    }
    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    .btn-toolbar {
        border-radius: 6px;
        padding: 8px 18px;
        font-size: 13.5px;
        font-weight: 600;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #334155;
        height: 44px;
        transition: all 0.2s;
    }
    .btn-toolbar:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    /* Form Section Title di Modal */
    .form-section-title {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #334155;
        margin: 16px 0 8px;
        padding-bottom: 6px;
        border-bottom: 1px solid #e2e8f0;
    }
    .modal-body label {
        font-size: 13.5px !important;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }
    .modal-body .form-control {
        font-size: 14px !important;
        border-radius: 6px !important;
        padding: 9px 14px !important;
        height: 44px !important;
        border: 1px solid #cbd5e1;
        color: #1e293b;
    }
    .modal-body textarea.form-control {
        height: auto !important;
        min-height: 90px !important;
        line-height: 1.6;
    }
    .modal-body .form-control:focus {
        border-color: #00c292;
        box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
    }
    .modal-footer .btn-action {
        padding: 9px 22px !important;
        font-size: 14px !important;
        border-radius: 6px !important;
    }

    /* Toggle indicator */
    .toggle-icon {
        display: inline-block;
        width: 24px;
        text-align: center;
        margin-right: 8px;
        color: #64748b;
        font-size: 15px;
        transition: transform 0.2s ease;
    }
    tr[data-expanded="true"] > td > .toggle-icon {
        transform: rotate(90deg);
        color: #00c292;
    }

    /* Select2 Tweaks */
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
        min-height: 44px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 5px 8px;
        font-size: 14px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f1f5f9 !important;
        border: 1px solid #cbd5e1 !important;
        color: #1e293b !important;
        border-radius: 4px;
        padding: 5px 10px;
        margin-top: 3px;
        font-size: 13px;
        font-weight: 600;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">

                    <!-- Header Kontainer Tabel Selaras dengan Halaman Lain -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 18px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 14px;">
                        <div>
                            <h3>
                                <i class="fa fa-table" style="color: #00c292; margin-right: 10px;"></i> Matriks Pembangunan (RKP)
                            </h3>
                            <small>
                                Hierarki Prioritas Nasional (PN) &rarr; Program Prioritas (PP) &rarr; Kegiatan Prioritas (KP) &rarr; Proyek Prioritas, beserta Sasaran dan Indikator Kinerja
                            </small>

                            <!-- KPI Stat Badges -->
                            <div class="kpi-stat-container">
                                <span class="kpi-stat-pill pill-pn"><b><?= $TotalPN ?? count($dataMatriksList) ?></b> Prioritas Nasional</span>
                                <span class="kpi-stat-pill pill-pp"><b><?= $TotalPP ?? 0 ?></b> Program Prioritas</span>
                                <span class="kpi-stat-pill pill-kp"><b><?= $TotalKP ?? 0 ?></b> Kegiatan Prioritas</span>
                                <span class="kpi-stat-pill pill-ind"><b><?= $TotalIndikator ?? 0 ?></b> Indikator Kinerja</span>
                            </div>
                        </div>

                        <?php if ($canEdit) { ?>
                        <div class="button-icon-btn">
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputPN" style="padding: 10px 22px; font-size: 14px;">
                                <i class="fa fa-plus-circle" style="margin-right: 8px;"></i> <b>Input Prioritas Nasional</b>
                            </button>
                        </div>
                        <?php } ?>
                    </div>

                    <!-- Toolbar: Search, Filter PN, Buka/Tutup Semua -->
                    <div class="matriks-toolbar">
                        <div class="toolbar-left">
                            <div class="matriks-search-box">
                                <i class="fa fa-search search-icon"></i>
                                <input type="text" id="searchInput" placeholder="Cari PN, PP, KP, Sasaran, Indikator, Pengampu..." autocomplete="off">
                                <i class="fa fa-times-circle clear-btn" id="clearSearch" title="Hapus pencarian"></i>
                            </div>
                            <select id="filterPN" class="matriks-filter-select">
                                <option value="">Semua Prioritas Nasional (1 - <?= count($dataMatriksList) ?>)</option>
                                <?php 
                                if (!empty($dataMatriksList)) {
                                    $optNo = 1;
                                    foreach ($dataMatriksList as $optPn) {
                                        $labelUraian = mb_strimwidth($optPn['PrioritasNasional'], 0, 50, '...');
                                        echo '<option value="pn-' . $optPn['Id'] . '">PN ' . $optNo . ': ' . htmlspecialchars($labelUraian) . '</option>';
                                        $optNo++;
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="toolbar-right">
                            <button type="button" class="btn btn-toolbar" id="btnExpandAll" title="Buka seluruh hierarki matriks">
                                <i class="fa fa-expand" style="margin-right: 5px; color: #00c292;"></i> Buka Semua
                            </button>
                            <button type="button" class="btn btn-toolbar" id="btnCollapseAll" title="Tutup kembali ke tingkat Prioritas Nasional">
                                <i class="fa fa-compress" style="margin-right: 5px; color: #78909c;"></i> Tutup Semua
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="hierarki-table" class="table">
                            <thead>
                                <tr>
                                    <th style="width: 50px; min-width: 50px; text-align: center;">No</th>
                                    <th style="min-width: 380px; text-align: left;">Hierarki Matriks Pembangunan (PN / PP / KP / Proyek)</th>
                                    <th style="width: 95px; min-width: 90px; text-align: center; white-space: nowrap;">Satuan</th>
                                    <th style="width: 110px; min-width: 105px; text-align: center; white-space: nowrap;">Baseline</th>
                                    <th style="width: 130px; min-width: 125px; text-align: center; white-space: nowrap;">Target 2025 (RKP)</th>
                                    <th style="width: 130px; min-width: 125px; text-align: center; white-space: nowrap;">Target 2029 (RPJMN)</th>
                                    <th style="width: 250px; min-width: 220px; text-align: left;">Pengampu / Koordinator</th>
                                    <?php if ($canEdit) { ?>
                                    <th style="width: 220px; min-width: 210px; text-align: center; white-space: nowrap;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!empty($dataMatriksList)) {
                                    $noPN = 1;
                                    foreach ($dataMatriksList as $pn) {
                                        $pnId = $pn['Id'];
                                        $periodeText = !empty($pn['TahunMulai']) && !empty($pn['TahunAkhir']) ? ($pn['TahunMulai'] . '-' . $pn['TahunAkhir']) : '';
                                ?>
                                    <!-- ============================================== LEVEL 1: PRIORITAS NASIONAL -->
                                    <tr class="row-pn" data-id="pn-<?= $pnId ?>" data-parent="" data-expanded="false" data-root="pn-<?= $pnId ?>">
                                        <td class="text-center font-bold"><b><?= $noPN ?></b></td>
                                        <td colspan="6" class="border-pn" onclick="toggleLevel('pn-<?= $pnId ?>', this)">
                                            <span class="toggle-icon"><i class="fa fa-chevron-right"></i></span>
                                            <span class="tipe-badge tipe-pn">PN <?= $noPN ?></span>
                                            <b><?= htmlspecialchars($pn['PrioritasNasional']) ?></b>
                                            <?php if ($periodeText) { ?>
                                                <span class="badge-periode"><?= htmlspecialchars($periodeText) ?></span>
                                            <?php } ?>
                                        </td>
                                        <?php if ($canEdit) { ?>
                                        <td class="text-center col-aksi">
                                            <div class="action-btn-group">
                                                <button class="btn btn-sm btn-success notika-btn-success TambahSasaran btn-action" data-id="<?= $pnId ?>" data-tipe="PN" title="Tambah Sasaran PN"><i class="fa fa-plus"></i> Sas</button>
                                                <button class="btn btn-sm btn-info notika-btn-info TambahPP btn-action" data-id="<?= $pnId ?>" title="Tambah Program Prioritas"><i class="fa fa-plus"></i> PP</button>
                                                <button class="btn btn-sm btn-warning notika-btn-warning EditPN btn-action" data-id="<?= $pnId ?>" data-idvisi="<?= $pn['_IdVisi'] ?>" data-pn="<?= htmlspecialchars($pn['PrioritasNasional'], ENT_QUOTES) ?>" title="Edit PN"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger notika-btn-danger HapusPN btn-action" data-id="<?= $pnId ?>" title="Hapus PN"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                        <!-- CABANG SASARAN PN -->
                                        <?php if (!empty($pn['Sasaran'])) { 
                                            $noSasPN = 1;
                                            foreach ($pn['Sasaran'] as $sasPN) { 
                                                $sasPNId = $sasPN['Id'];
                                        ?>
                                        <tr class="row-sasaran" data-id="saspn-<?= $sasPNId ?>" data-parent="pn-<?= $pnId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                            <td></td>
                                            <td colspan="6" class="border-sasaran" style="padding-left: 28px;" onclick="toggleLevel('saspn-<?= $sasPNId ?>', this)">
                                                <span class="toggle-icon"><i class="fa fa-chevron-right"></i></span>
                                                <span class="tipe-badge tipe-sasaran">SASARAN</span>
                                                <b><?= htmlspecialchars($sasPN['Sasaran']) ?></b>
                                            </td>
                                            <?php if ($canEdit) { ?>
                                            <td class="text-center col-aksi">
                                                <div class="action-btn-group">
                                                    <button class="btn btn-sm btn-success notika-btn-success TambahIndikator btn-action" data-id="<?= $sasPNId ?>" data-tipe="PN" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                    <button class="btn btn-sm btn-warning notika-btn-warning EditSasaran btn-action" data-id="<?= $sasPNId ?>" data-tipe="PN" data-parentid="<?= $pnId ?>" data-sasaran="<?= htmlspecialchars($sasPN['Sasaran'], ENT_QUOTES) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger notika-btn-danger HapusSasaran btn-action" data-id="<?= $sasPNId ?>" data-tipe="PN" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                            <!-- CABANG INDIKATOR PN -->
                                            <?php if (!empty($sasPN['Indikator'])) { 
                                                $noIndPN = 1;
                                                foreach ($sasPN['Indikator'] as $indPN) { 
                                                    $indPNId = $indPN['Id'];
                                            ?>
                                            <tr class="row-indikator" data-id="indpn-<?= $indPNId ?>" data-parent="saspn-<?= $sasPNId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                                <td></td>
                                                <td class="border-indikator" style="padding-left: 48px;">
                                                    <span class="tipe-badge tipe-indikator">INDIKATOR</span>
                                                    <?= htmlspecialchars($indPN['Indikator']) ?>
                                                </td>
                                                <td class="text-center"><?= !empty($indPN['Satuan']) ? '<span class="badge-satuan">' . htmlspecialchars($indPN['Satuan']) . '</span>' : '-' ?></td>
                                                <td class="text-center"><?= !empty($indPN['Baseline']) ? '<span class="badge-baseline">' . htmlspecialchars($indPN['Baseline']) . '</span>' : '-' ?></td>
                                                <td class="text-center"><?= !empty($indPN['TargetAwal']) ? '<span class="badge-target-awal">' . htmlspecialchars($indPN['TargetAwal']) . '</span>' : '-' ?></td>
                                                <td class="text-center"><?= !empty($indPN['TargetAkhir']) ? '<span class="badge-target-akhir">' . htmlspecialchars($indPN['TargetAkhir']) . '</span>' : '-' ?></td>
                                                <td><?= renderPengampuMatriks($indPN['Pengampu'], $mapKemen) ?></td>
                                                <?php if ($canEdit) { ?>
                                                <td class="text-center col-aksi">
                                                    <div class="action-btn-group">
                                                        <button class="btn btn-sm btn-warning notika-btn-warning EditIndikator btn-action" data-id="<?= $indPNId ?>" data-tipe="PN" data-parentid="<?= $sasPNId ?>" data-indikator="<?= htmlspecialchars($indPN['Indikator'], ENT_QUOTES) ?>" data-satuan="<?= htmlspecialchars($indPN['Satuan'] ?? '', ENT_QUOTES) ?>" data-baseline="<?= htmlspecialchars($indPN['Baseline'] ?? '', ENT_QUOTES) ?>" data-targetawal="<?= htmlspecialchars($indPN['TargetAwal'] ?? '', ENT_QUOTES) ?>" data-targetakhir="<?= htmlspecialchars($indPN['TargetAkhir'] ?? '', ENT_QUOTES) ?>" data-pengampu="<?= htmlspecialchars($indPN['Pengampu'] ?? '[]', ENT_QUOTES) ?>" title="Edit Indikator"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger notika-btn-danger HapusIndikator btn-action" data-id="<?= $indPNId ?>" data-tipe="PN" title="Hapus Indikator"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <?php 
                                                    $noIndPN++;
                                                } 
                                            } ?>
                                        <?php 
                                                $noSasPN++;
                                            } 
                                        } ?>

                                        <!-- ============================================== LEVEL 2: PROGRAM PRIORITAS -->
                                        <?php if (!empty($pn['ProgramPrioritas'])) { 
                                            $noPP = 1;
                                            foreach ($pn['ProgramPrioritas'] as $pp) { 
                                                $ppId = $pp['Id'];
                                                $kodePP = $noPN . '.' . $noPP;
                                        ?>
                                        <tr class="row-pp" data-id="pp-<?= $ppId ?>" data-parent="pn-<?= $pnId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                            <td></td>
                                            <td colspan="6" class="border-pp" style="padding-left: 20px;" onclick="toggleLevel('pp-<?= $ppId ?>', this)">
                                                <span class="toggle-icon"><i class="fa fa-chevron-right"></i></span>
                                                <span class="tipe-badge tipe-pp">PP <?= $kodePP ?></span>
                                                <b><?= htmlspecialchars($pp['ProgramPrioritas']) ?></b>
                                            </td>
                                            <?php if ($canEdit) { ?>
                                            <td class="text-center col-aksi">
                                                <div class="action-btn-group">
                                                    <button class="btn btn-sm btn-success notika-btn-success TambahSasaran btn-action" data-id="<?= $ppId ?>" data-tipe="PP" title="Tambah Sasaran PP"><i class="fa fa-plus"></i> Sas</button>
                                                    <button class="btn btn-sm btn-info notika-btn-info TambahKP btn-action" data-id="<?= $ppId ?>" title="Tambah Kegiatan Prioritas"><i class="fa fa-plus"></i> KP</button>
                                                    <button class="btn btn-sm btn-warning notika-btn-warning EditPP btn-action" data-id="<?= $ppId ?>" data-idpn="<?= $pnId ?>" data-pp="<?= htmlspecialchars($pp['ProgramPrioritas'], ENT_QUOTES) ?>" title="Edit PP"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger notika-btn-danger HapusPP btn-action" data-id="<?= $ppId ?>" title="Hapus PP"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                            <!-- CABANG SASARAN PP -->
                                            <?php if (!empty($pp['Sasaran'])) { 
                                                $noSasPP = 1;
                                                foreach ($pp['Sasaran'] as $sasPP) { 
                                                    $sasPPId = $sasPP['Id'];
                                            ?>
                                            <tr class="row-sasaran" data-id="saspp-<?= $sasPPId ?>" data-parent="pp-<?= $ppId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                                <td></td>
                                                <td colspan="6" class="border-sasaran" style="padding-left: 40px;" onclick="toggleLevel('saspp-<?= $sasPPId ?>', this)">
                                                    <span class="toggle-icon"><i class="fa fa-chevron-right"></i></span>
                                                    <span class="tipe-badge tipe-sasaran">SASARAN</span>
                                                    <b><?= htmlspecialchars($sasPP['Sasaran']) ?></b>
                                                </td>
                                                <?php if ($canEdit) { ?>
                                                <td class="text-center col-aksi">
                                                    <div class="action-btn-group">
                                                        <button class="btn btn-sm btn-success notika-btn-success TambahIndikator btn-action" data-id="<?= $sasPPId ?>" data-tipe="PP" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                        <button class="btn btn-sm btn-warning notika-btn-warning EditSasaran btn-action" data-id="<?= $sasPPId ?>" data-tipe="PP" data-parentid="<?= $ppId ?>" data-sasaran="<?= htmlspecialchars($sasPP['Sasaran'], ENT_QUOTES) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger notika-btn-danger HapusSasaran btn-action" data-id="<?= $sasPPId ?>" data-tipe="PP" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                                <!-- CABANG INDIKATOR PP -->
                                                <?php if (!empty($sasPP['Indikator'])) { 
                                                    $noIndPP = 1;
                                                    foreach ($sasPP['Indikator'] as $indPP) { 
                                                        $indPPId = $indPP['Id'];
                                                ?>
                                                <tr class="row-indikator" data-id="indpp-<?= $indPPId ?>" data-parent="saspp-<?= $sasPPId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                                    <td></td>
                                                    <td class="border-indikator" style="padding-left: 60px;">
                                                        <span class="tipe-badge tipe-indikator">INDIKATOR</span>
                                                        <?= htmlspecialchars($indPP['Indikator']) ?>
                                                    </td>
                                                    <td class="text-center"><?= !empty($indPP['Satuan']) ? '<span class="badge-satuan">' . htmlspecialchars($indPP['Satuan']) . '</span>' : '-' ?></td>
                                                    <td class="text-center"><?= !empty($indPP['Baseline']) ? '<span class="badge-baseline">' . htmlspecialchars($indPP['Baseline']) . '</span>' : '-' ?></td>
                                                    <td class="text-center"><?= !empty($indPP['TargetAwal']) ? '<span class="badge-target-awal">' . htmlspecialchars($indPP['TargetAwal']) . '</span>' : '-' ?></td>
                                                    <td class="text-center"><?= !empty($indPP['TargetAkhir']) ? '<span class="badge-target-akhir">' . htmlspecialchars($indPP['TargetAkhir']) . '</span>' : '-' ?></td>
                                                    <td><?= renderPengampuMatriks($indPP['Pengampu'], $mapKemen) ?></td>
                                                    <?php if ($canEdit) { ?>
                                                    <td class="text-center col-aksi">
                                                        <div class="action-btn-group">
                                                            <button class="btn btn-sm btn-warning notika-btn-warning EditIndikator btn-action" data-id="<?= $indPPId ?>" data-tipe="PP" data-parentid="<?= $sasPPId ?>" data-indikator="<?= htmlspecialchars($indPP['Indikator'], ENT_QUOTES) ?>" data-satuan="<?= htmlspecialchars($indPP['Satuan'] ?? '', ENT_QUOTES) ?>" data-baseline="<?= htmlspecialchars($indPP['Baseline'] ?? '', ENT_QUOTES) ?>" data-targetawal="<?= htmlspecialchars($indPP['TargetAwal'] ?? '', ENT_QUOTES) ?>" data-targetakhir="<?= htmlspecialchars($indPP['TargetAkhir'] ?? '', ENT_QUOTES) ?>" data-pengampu="<?= htmlspecialchars($indPP['Pengampu'] ?? '[]', ENT_QUOTES) ?>" title="Edit Indikator"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-danger notika-btn-danger HapusIndikator btn-action" data-id="<?= $indPPId ?>" data-tipe="PP" title="Hapus Indikator"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php 
                                                        $noIndPP++;
                                                    } 
                                                } ?>
                                            <?php 
                                                    $noSasPP++;
                                                } 
                                            } ?>

                                            <!-- ============================================== LEVEL 3: KEGIATAN PRIORITAS -->
                                            <?php if (!empty($pp['KegiatanPrioritas'])) { 
                                                $noKP = 1;
                                                foreach ($pp['KegiatanPrioritas'] as $kp) { 
                                                    $kpId = $kp['Id'];
                                                    $kodeKP = $kodePP . '.' . $noKP;
                                            ?>
                                            <tr class="row-kp" data-id="kp-<?= $kpId ?>" data-parent="pp-<?= $ppId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                                <td></td>
                                                <td colspan="6" class="border-kp" style="padding-left: 36px;" onclick="toggleLevel('kp-<?= $kpId ?>', this)">
                                                    <span class="toggle-icon"><i class="fa fa-chevron-right"></i></span>
                                                    <span class="tipe-badge tipe-kp">KP <?= $kodeKP ?></span>
                                                    <b><?= htmlspecialchars($kp['KegiatanPrioritas']) ?></b>
                                                </td>
                                                <?php if ($canEdit) { ?>
                                                <td class="text-center col-aksi">
                                                    <div class="action-btn-group">
                                                        <button class="btn btn-sm btn-success notika-btn-success TambahSasaran btn-action" data-id="<?= $kpId ?>" data-tipe="KP" title="Tambah Sasaran KP"><i class="fa fa-plus"></i> Sas</button>
                                                        <button class="btn btn-sm btn-info notika-btn-info TambahProyek btn-action" data-id="<?= $kpId ?>" title="Tambah Proyek Prioritas"><i class="fa fa-plus"></i> Proyek</button>
                                                        <button class="btn btn-sm btn-warning notika-btn-warning EditKP btn-action" data-id="<?= $kpId ?>" data-idpp="<?= $ppId ?>" data-kp="<?= htmlspecialchars($kp['KegiatanPrioritas'], ENT_QUOTES) ?>" title="Edit KP"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger notika-btn-danger HapusKP btn-action" data-id="<?= $kpId ?>" title="Hapus KP"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                                <!-- CABANG SASARAN KP -->
                                                <?php if (!empty($kp['Sasaran'])) { 
                                                    $noSasKP = 1;
                                                    foreach ($kp['Sasaran'] as $sasKP) { 
                                                        $sasKPId = $sasKP['Id'];
                                                ?>
                                                <tr class="row-sasaran" data-id="saskp-<?= $sasKPId ?>" data-parent="kp-<?= $kpId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                                    <td></td>
                                                    <td colspan="6" class="border-sasaran" style="padding-left: 56px;" onclick="toggleLevel('saskp-<?= $sasKPId ?>', this)">
                                                        <span class="toggle-icon"><i class="fa fa-chevron-right"></i></span>
                                                        <span class="tipe-badge tipe-sasaran">SASARAN</span>
                                                        <b><?= htmlspecialchars($sasKP['Sasaran']) ?></b>
                                                    </td>
                                                    <?php if ($canEdit) { ?>
                                                    <td class="text-center col-aksi">
                                                        <div class="action-btn-group">
                                                            <button class="btn btn-sm btn-success notika-btn-success TambahIndikator btn-action" data-id="<?= $sasKPId ?>" data-tipe="KP" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                            <button class="btn btn-sm btn-warning notika-btn-warning EditSasaran btn-action" data-id="<?= $sasKPId ?>" data-tipe="KP" data-parentid="<?= $kpId ?>" data-sasaran="<?= htmlspecialchars($sasKP['Sasaran'], ENT_QUOTES) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-danger notika-btn-danger HapusSasaran btn-action" data-id="<?= $sasKPId ?>" data-tipe="KP" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                </tr>

                                                    <!-- CABANG INDIKATOR KP -->
                                                    <?php if (!empty($sasKP['Indikator'])) { 
                                                        $noIndKP = 1;
                                                        foreach ($sasKP['Indikator'] as $indKP) { 
                                                            $indKPId = $indKP['Id'];
                                                    ?>
                                                    <tr class="row-indikator" data-id="indkp-<?= $indKPId ?>" data-parent="saskp-<?= $sasKPId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                                        <td></td>
                                                        <td class="border-indikator" style="padding-left: 76px;">
                                                            <span class="tipe-badge tipe-indikator">INDIKATOR</span>
                                                            <?= htmlspecialchars($indKP['Indikator']) ?>
                                                        </td>
                                                        <td class="text-center"><?= !empty($indKP['Satuan']) ? '<span class="badge-satuan">' . htmlspecialchars($indKP['Satuan']) . '</span>' : '-' ?></td>
                                                        <td class="text-center"><?= !empty($indKP['Baseline']) ? '<span class="badge-baseline">' . htmlspecialchars($indKP['Baseline']) . '</span>' : '-' ?></td>
                                                        <td class="text-center"><?= !empty($indKP['TargetAwal']) ? '<span class="badge-target-awal">' . htmlspecialchars($indKP['TargetAwal']) . '</span>' : '-' ?></td>
                                                        <td class="text-center"><?= !empty($indKP['TargetAkhir']) ? '<span class="badge-target-akhir">' . htmlspecialchars($indKP['TargetAkhir']) . '</span>' : '-' ?></td>
                                                        <td><?= renderPengampuMatriks($indKP['Pengampu'], $mapKemen) ?></td>
                                                        <?php if ($canEdit) { ?>
                                                        <td class="text-center col-aksi">
                                                            <div class="action-btn-group">
                                                                <button class="btn btn-sm btn-warning notika-btn-warning EditIndikator btn-action" data-id="<?= $indKPId ?>" data-tipe="KP" data-parentid="<?= $sasKPId ?>" data-indikator="<?= htmlspecialchars($indKP['Indikator'], ENT_QUOTES) ?>" data-satuan="<?= htmlspecialchars($indKP['Satuan'] ?? '', ENT_QUOTES) ?>" data-baseline="<?= htmlspecialchars($indKP['Baseline'] ?? '', ENT_QUOTES) ?>" data-targetawal="<?= htmlspecialchars($indKP['TargetAwal'] ?? '', ENT_QUOTES) ?>" data-targetakhir="<?= htmlspecialchars($indKP['TargetAkhir'] ?? '', ENT_QUOTES) ?>" data-pengampu="<?= htmlspecialchars($indKP['Pengampu'] ?? '[]', ENT_QUOTES) ?>" title="Edit Indikator"><i class="fa fa-edit"></i></button>
                                                                <button class="btn btn-sm btn-danger notika-btn-danger HapusIndikator btn-action" data-id="<?= $indKPId ?>" data-tipe="KP" title="Hapus Indikator"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php 
                                                            $noIndKP++;
                                                        } 
                                                    } ?>
                                                <?php 
                                                        $noSasKP++;
                                                    } 
                                                } ?>

                                                <!-- ============================================== LEVEL 4: PROYEK PRIORITAS -->
                                                <?php if (!empty($kp['Proyek'])) { 
                                                    $noProy = 1;
                                                    foreach ($kp['Proyek'] as $proy) { 
                                                        $proyId = $proy['Id'];
                                                        $kodeProy = $kodeKP . '.' . $noProy;
                                                ?>
                                                <tr class="row-proyek" data-id="proy-<?= $proyId ?>" data-parent="kp-<?= $kpId ?>" data-expanded="false" data-root="pn-<?= $pnId ?>" style="display: none;">
                                                    <td></td>
                                                    <td colspan="6" class="border-proyek" style="padding-left: 56px;">
                                                        <span class="tipe-badge tipe-proyek">PROYEK <?= $kodeProy ?></span>
                                                        <b><?= htmlspecialchars($proy['ProyekPrioritas']) ?></b>
                                                    </td>
                                                    <?php if ($canEdit) { ?>
                                                    <td class="text-center col-aksi">
                                                        <div class="action-btn-group">
                                                            <button class="btn btn-sm btn-warning notika-btn-warning EditProyek btn-action" data-id="<?= $proyId ?>" data-idkp="<?= $kpId ?>" data-proyek="<?= htmlspecialchars($proy['ProyekPrioritas'], ENT_QUOTES) ?>" title="Edit Proyek"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-danger notika-btn-danger HapusProyek btn-action" data-id="<?= $proyId ?>" title="Hapus Proyek"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php 
                                                        $noProy++;
                                                    } 
                                                } ?>

                                            <?php 
                                                    $noKP++;
                                                } 
                                            } ?>

                                        <?php 
                                                $noPP++;
                                            } 
                                        } ?>

                                <?php 
                                        $noPN++;
                                    } // End foreach dataMatriksList
                                } else { ?>
                                    <tr>
                                        <td colspan="<?= $canEdit ? '8' : '7' ?>" class="text-center" style="padding: 40px; color: #888;">
                                            <i class="fa fa-folder-open-o" style="font-size: 28px; margin-bottom: 8px; display: block; color: #aaa;"></i>
                                            Belum ada data Matriks Pembangunan. Silakan tambahkan Prioritas Nasional baru.
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

<?php if ($canEdit) { ?>
<!-- ============================================================================================== -->
<!-- MODALS FORM CRUD (PN, PP, KP, PROYEK, SASARAN, INDIKATOR) -->
<!-- ============================================================================================== -->

<!-- 1. MODAL TAMBAH & EDIT PRIORITAS NASIONAL -->
<div class="modal fade" id="ModalInputPN" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-pn">PN</span> Tambah Prioritas Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <div class="form-section-title">Periode RPJMN</div>
                <select class="form-control" id="IdVisiPN" style="border-radius: 4px; height: 38px;">
                    <option value="">-- Pilih Periode RPJMN --</option>
                    <?php if (!empty($ComboVisi)) { foreach ($ComboVisi as $cv) { echo "<option value='".$cv['Id']."'>".$cv['TahunMulai']." - ".$cv['TahunAkhir']."</option>"; } } ?>
                </select>
                <div class="form-section-title">Uraian Prioritas Nasional</div>
                <textarea class="form-control" id="PrioritasNasional" rows="3" placeholder="Masukkan Uraian Prioritas Nasional..." style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success notika-btn-success btn-action" id="SimpanPN" style="padding: 7px 16px;"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditPN" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-pn">PN</span> Edit Prioritas Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdPNForm">
                <div class="form-section-title">Periode RPJMN</div>
                <select class="form-control" id="_IdVisiPN" style="border-radius: 4px; height: 38px;">
                    <option value="">-- Pilih Periode RPJMN --</option>
                    <?php if (!empty($ComboVisi)) { foreach ($ComboVisi as $cv) { echo "<option value='".$cv['Id']."'>".$cv['TahunMulai']." - ".$cv['TahunAkhir']."</option>"; } } ?>
                </select>
                <div class="form-section-title">Uraian Prioritas Nasional</div>
                <textarea class="form-control" id="_PrioritasNasional" rows="3" style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info notika-btn-info btn-action" id="EditBtnPN" style="padding: 7px 16px;"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- 2. MODAL PROGRAM PRIORITAS -->
<div class="modal fade" id="ModalInputPP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-pp">PP</span> Tambah Program Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdPNParent">
                <div class="form-section-title">Uraian Program Prioritas</div>
                <textarea class="form-control" id="ProgramPrioritas" rows="3" placeholder="Masukkan Uraian Program Prioritas..." style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success notika-btn-success btn-action" id="SimpanPP" style="padding: 7px 16px;"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditPP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-pp">PP</span> Edit Program Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdPPForm">
                <input type="hidden" id="_IdPNParent">
                <div class="form-section-title">Uraian Program Prioritas</div>
                <textarea class="form-control" id="_ProgramPrioritas" rows="3" style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info notika-btn-info btn-action" id="EditBtnPP" style="padding: 7px 16px;"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- 3. MODAL KEGIATAN PRIORITAS -->
<div class="modal fade" id="ModalInputKP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-kp">KP</span> Tambah Kegiatan Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdPPParent">
                <div class="form-section-title">Uraian Kegiatan Prioritas</div>
                <textarea class="form-control" id="KegiatanPrioritas" rows="3" placeholder="Masukkan Uraian Kegiatan Prioritas..." style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success notika-btn-success btn-action" id="SimpanKP" style="padding: 7px 16px;"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditKP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-kp">KP</span> Edit Kegiatan Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdKPForm">
                <input type="hidden" id="_IdPPParent">
                <div class="form-section-title">Uraian Kegiatan Prioritas</div>
                <textarea class="form-control" id="_KegiatanPrioritas" rows="3" style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info notika-btn-info btn-action" id="EditBtnKP" style="padding: 7px 16px;"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- 4. MODAL PROYEK PRIORITAS -->
<div class="modal fade" id="ModalInputProyek" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-proyek">PROYEK</span> Tambah Proyek Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdKPParent">
                <div class="form-section-title">Uraian Proyek Prioritas</div>
                <textarea class="form-control" id="ProyekPrioritas" rows="3" placeholder="Masukkan Uraian Proyek Prioritas..." style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success notika-btn-success btn-action" id="SimpanProyek" style="padding: 7px 16px;"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditProyek" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-proyek">PROYEK</span> Edit Proyek Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdProyekForm">
                <input type="hidden" id="_IdKPParent">
                <div class="form-section-title">Uraian Proyek Prioritas</div>
                <textarea class="form-control" id="_ProyekPrioritas" rows="3" style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info notika-btn-info btn-action" id="EditBtnProyek" style="padding: 7px 16px;"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- 5. MODAL UNIVERSAL SASARAN (PN / PP / KP) -->
<div class="modal fade" id="ModalInputSasaran" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-sasaran">SASARAN</span> Tambah Sasaran <span id="LabelTipeSasaran"></span></h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdParentSasaran">
                <input type="hidden" id="TipeLevelSasaran">
                <div class="form-section-title">Uraian Sasaran</div>
                <textarea class="form-control" id="UniversalSasaran" rows="3" placeholder="Masukkan Uraian Sasaran..." style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success notika-btn-success btn-action" id="SimpanSasaran" style="padding: 7px 16px;"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditSasaran" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-sasaran">SASARAN</span> Edit Sasaran</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdSasaranForm">
                <input type="hidden" id="_IdParentSasaran">
                <input type="hidden" id="_TipeLevelSasaran">
                <div class="form-section-title">Uraian Sasaran</div>
                <textarea class="form-control" id="_UniversalSasaran" rows="3" style="border-radius: 4px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info notika-btn-info btn-action" id="EditBtnSasaran" style="padding: 7px 16px;"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- 6. MODAL UNIVERSAL INDIKATOR (PN / PP / KP) -->
<div class="modal fade" id="ModalInputIndikator" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-indikator">INDIKATOR</span> Tambah Indikator Kinerja</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px; max-height: 70vh; overflow-y: auto;">
                <input type="hidden" id="IdSasaranParent">
                <input type="hidden" id="TipeLevelIndikator">
                <div class="form-section-title">Uraian Indikator</div>
                <textarea class="form-control" id="UniversalIndikator" rows="2" placeholder="Masukkan Uraian Indikator..." style="border-radius: 4px;"></textarea>
                
                <div class="form-section-title">Satuan & Target</div>
                <div class="row">
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Satuan</label>
                        <input type="text" class="form-control" id="Satuan" placeholder="cth: %, Indeks" style="border-radius: 4px;">
                    </div>
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Baseline</label>
                        <input type="text" class="form-control" id="Baseline" placeholder="cth: 75.5 (2024)" style="border-radius: 4px;">
                    </div>
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Target 2025 (RKP)</label>
                        <input type="text" class="form-control" id="TargetAwal" placeholder="Target 2025" style="border-radius: 4px;">
                    </div>
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Target 2029 (RPJMN)</label>
                        <input type="text" class="form-control" id="TargetAkhir" placeholder="Target 2029" style="border-radius: 4px;">
                    </div>
                </div>
                
                <div class="form-section-title" style="margin-top: 15px;">Pengampu / Kementerian / Lembaga</div>
                <select class="form-control select2" id="Pengampu" multiple="multiple" style="width: 100%;">
                    <?php 
                    if (!empty($Kementerian)) {
                        foreach ($Kementerian as $k) {
                            echo "<option value='".$k['Id']."'>".$k['NamaKementerian']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success notika-btn-success btn-action" id="SimpanIndikator" style="padding: 7px 16px;"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditIndikator" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-indikator">INDIKATOR</span> Edit Indikator Kinerja</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px; max-height: 70vh; overflow-y: auto;">
                <input type="hidden" id="IdIndikatorForm">
                <input type="hidden" id="_IdSasaranParent">
                <input type="hidden" id="_TipeLevelIndikator">
                <div class="form-section-title">Uraian Indikator</div>
                <textarea class="form-control" id="_UniversalIndikator" rows="2" style="border-radius: 4px;"></textarea>
                
                <div class="form-section-title">Satuan & Target</div>
                <div class="row">
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Satuan</label>
                        <input type="text" class="form-control" id="_Satuan" style="border-radius: 4px;">
                    </div>
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Baseline</label>
                        <input type="text" class="form-control" id="_Baseline" style="border-radius: 4px;">
                    </div>
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Target 2025 (RKP)</label>
                        <input type="text" class="form-control" id="_TargetAwal" style="border-radius: 4px;">
                    </div>
                    <div class="col-xs-3">
                        <label style="font-size: 12px; color: #555;">Target 2029 (RPJMN)</label>
                        <input type="text" class="form-control" id="_TargetAkhir" style="border-radius: 4px;">
                    </div>
                </div>
                
                <div class="form-section-title" style="margin-top: 15px;">Pengampu / Kementerian / Lembaga</div>
                <select class="form-control select2" id="_Pengampu" multiple="multiple" style="width: 100%;">
                    <?php 
                    if (!empty($Kementerian)) {
                        foreach ($Kementerian as $k) {
                            echo "<option value='".$k['Id']."'>".$k['NamaKementerian']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info notika-btn-info btn-action" id="EditBtnIndikator" style="padding: 7px 16px;"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal" style="padding: 7px 16px;">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Load Vendor Core JS (JQuery, Bootstrap, Notika Plugins) -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>
<!-- Load Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    var BaseURL = '<?= base_url() ?>';

    // Hierarchical Tree Toggle
    function toggleLevel(parentId, element) {
        var trs = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        var parentTr = element ? element.closest('tr') : document.querySelector('tr[data-id="' + parentId + '"]');
        if (!parentTr) return;

        var isExpanded = parentTr.getAttribute('data-expanded') === 'true';

        if (isExpanded) {
            parentTr.setAttribute('data-expanded', 'false');
            hideAllChildren(parentId);
        } else {
            parentTr.setAttribute('data-expanded', 'true');
            trs.forEach(function(tr) {
                tr.style.display = 'table-row';
            });
        }
        saveExpandedState();
    }

    function hideAllChildren(parentId) {
        var children = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        children.forEach(function(child) {
            child.style.display = 'none';
            child.setAttribute('data-expanded', 'false');
            var childId = child.getAttribute('data-id');
            hideAllChildren(childId);
        });
    }

    function saveExpandedState() {
        var expanded = [];
        document.querySelectorAll('tr[data-expanded="true"]').forEach(function(tr) {
            expanded.push(tr.getAttribute('data-id'));
        });
        sessionStorage.setItem('expandedRowsMatriksPembangunan', JSON.stringify(expanded));
    }

    $(document).ready(function() {
        // Init Select2
        if ($.fn.select2) {
            $('.select2').select2({ width: '100%' });
        }

        // Explicit modal trigger untuk tombol Tambah Prioritas Nasional
        $(document).on('click', '[data-target="#ModalInputPN"]', function(e) {
            e.preventDefault();
            $('#ModalInputPN').modal('show');
        });

        // Cache semua baris dan petakan ID serta Search Text (index in-memory tanpa pembacaan DOM ulang)
        var allRows = Array.from(document.querySelectorAll('#hierarki-table tbody tr[data-id]'));
        var rowMap = {};
        
        allRows.forEach(function(tr) {
            var id = tr.getAttribute('data-id');
            rowMap[id] = tr;

            // Kumpulkan seluruh teks baris KECUALI tombol aksi
            var cells = tr.querySelectorAll('td');
            var textParts = [];
            cells.forEach(function(td) {
                // Lewati sel aksi yang berisi tombol tambah/edit/hapus
                if (td.querySelector('.btn-action')) return;
                textParts.push(td.textContent || '');
            });

            // Sertakan tooltip nama kementerian/lembaga jika ada
            var badges = tr.querySelectorAll('.badge-pengampu');
            badges.forEach(function(b) {
                var title = b.getAttribute('title');
                if (title) textParts.push(title);
            });

            tr._searchText = textParts.join(' ').replace(/\s+/g, ' ').toLowerCase();
        });

        // Restore State Hierarki dari sessionStorage
        var expandedRows = JSON.parse(sessionStorage.getItem('expandedRowsMatriksPembangunan')) || [];
        expandedRows.forEach(function(id) {
            if (rowMap[id]) {
                rowMap[id].setAttribute('data-expanded', 'true');
            }
        });

        // Helper untuk mengecek apakah seluruh leluhur (ancestor) baris ini berstatus expanded
        function isAncestorsExpanded(tr) {
            var pId = tr.getAttribute('data-parent');
            while (pId) {
                var pTr = rowMap[pId];
                if (!pTr || pTr.getAttribute('data-expanded') !== 'true') {
                    return false;
                }
                pId = pTr.getAttribute('data-parent');
            }
            return true;
        }

        // FUNGSI UTAMA PENCARIAN & FILTER HIERARKI REAL-TIME
        function applyFilterAndSearch() {
            var rawQuery = $('#searchInput').val() || '';
            var query = rawQuery.toLowerCase().trim();
            var selectedPN = $('#filterPN').val() || '';

            // Tampilkan atau sembunyikan tombol clear pencarian
            if (rawQuery.length > 0) {
                $('#clearSearch').show();
            } else {
                $('#clearSearch').hide();
            }

            var noResultRow = document.getElementById('no-search-results');

            // 1. KASUS TIDAK ADA KATA KUNCI (DEFAULT / CLEAR)
            if (query === '') {
                if (noResultRow) noResultRow.style.display = 'none';

                allRows.forEach(function(tr) {
                    var root = tr.getAttribute('data-root');
                    var pId = tr.getAttribute('data-parent');

                    // Filter Prioritas Nasional
                    if (selectedPN && root !== selectedPN) {
                        tr.style.display = 'none';
                        return;
                    }

                    // Baris Level 1 (PN)
                    if (!pId) {
                        tr.style.display = 'table-row';
                        return;
                    }

                    // Baris sub-level (PP, KP, Proyek, Sasaran, Indikator)
                    tr.style.display = isAncestorsExpanded(tr) ? 'table-row' : 'none';
                });
                return;
            }

            // 2. KASUS ADA KATA KUNCI (SEARCHING)
            // Mendukung multi-keyword (misal: "pupr jalan", "stunting balita")
            var keywords = query.split(/\s+/).filter(Boolean);
            var matchedRows = new Set();
            var rowsToShow = new Set();
            var rowsToExpand = new Set();

            allRows.forEach(function(tr) {
                var root = tr.getAttribute('data-root');
                if (selectedPN && root !== selectedPN) {
                    return;
                }

                // Cek apakah seluruh kata kunci ada di dalam baris ini
                var isMatch = keywords.every(function(kw) {
                    return tr._searchText && tr._searchText.indexOf(kw) > -1;
                });

                if (isMatch) {
                    matchedRows.add(tr);
                    rowsToShow.add(tr);

                    // Tampilkan seluruh rantai leluhur ke atas agar struktur hierarki utuh
                    var curParentId = tr.getAttribute('data-parent');
                    while (curParentId) {
                        var pTr = rowMap[curParentId];
                        if (pTr) {
                            rowsToShow.add(pTr);
                            rowsToExpand.add(pTr);
                            curParentId = pTr.getAttribute('data-parent');
                        } else {
                            break;
                        }
                    }
                }
            });

            // Terapkan visibility ke DOM
            allRows.forEach(function(tr) {
                if (rowsToShow.has(tr)) {
                    tr.style.display = 'table-row';
                    if (rowsToExpand.has(tr)) {
                        tr.setAttribute('data-expanded', 'true');
                    }
                } else {
                    tr.style.display = 'none';
                }
            });

            // Tampilkan pesan jika tidak ditemukan hasil
            if (matchedRows.size === 0) {
                if (!noResultRow) {
                    var colCount = $('#hierarki-table thead th').length || 8;
                    var tbody = document.querySelector('#hierarki-table tbody');
                    noResultRow = document.createElement('tr');
                    noResultRow.id = 'no-search-results';
                    noResultRow.innerHTML = '<td colspan="' + colCount + '" class="text-center" style="padding: 40px 20px; color: #64748b; font-size: 14.5px;">' +
                        '<i class="fa fa-search" style="font-size: 28px; color: #94a3b8; display: block; margin-bottom: 12px;"></i>' +
                        'Tidak ditemukan data matriks yang cocok dengan pencarian: <b style="color: #0f172a;">"' + $('<div>').text(rawQuery).html() + '"</b>' +
                        '</td>';
                    tbody.appendChild(noResultRow);
                } else {
                    noResultRow.style.display = 'table-row';
                    noResultRow.querySelector('b').textContent = '"' + rawQuery + '"';
                }
            } else if (noResultRow) {
                noResultRow.style.display = 'none';
            }
        }

        // Jalankan initial render state
        applyFilterAndSearch();

        // Event listener kotak pencarian (input, keyup, paste)
        $('#searchInput').on('input keyup paste', function() {
            applyFilterAndSearch();
        });

        // Tombol hapus pencarian (Clear Button)
        $('#clearSearch').on('click', function() {
            $('#searchInput').val('').focus();
            applyFilterAndSearch();
        });

        // Tombol Escape di input pencarian untuk reset
        $('#searchInput').on('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                $(this).val('');
                applyFilterAndSearch();
            }
        });

        // Filter per-Prioritas Nasional
        $('#filterPN').on('change', function() {
            applyFilterAndSearch();
        });

        // Buka Semua (Expand All)
        $('#btnExpandAll').on('click', function() {
            allRows.forEach(function(tr) {
                tr.setAttribute('data-expanded', 'true');
            });
            saveExpandedState();
            applyFilterAndSearch();
        });

        // Tutup Semua (Collapse All)
        $('#btnCollapseAll').on('click', function() {
            allRows.forEach(function(tr) {
                tr.setAttribute('data-expanded', 'false');
            });
            sessionStorage.removeItem('expandedRowsMatriksPembangunan');
            applyFilterAndSearch();
        });

        // Otomatis Expand saat klik tombol Tambah sub-level
        $(document).on('click', '.TambahPP, .TambahKP, .TambahProyek, .TambahSasaran, .TambahIndikator', function(e) {
            e.stopPropagation();
            var parentRow = $(this).closest('tr')[0];
            if (parentRow && parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }
        });

        <?php if ($canEdit) { ?>
        // ============================================== SCRIPT LEVEL 1 (PN)
        $("#SimpanPN").click(function() {
            if ($("#IdVisiPN").val() == "") return alert('Pilih Periode RPJMN!');
            if ($("#PrioritasNasional").val() == "") return alert('Isi Uraian Prioritas Nasional!');
            $.post(BaseURL + "Nasional/InputRKP_PN", {
                _IdVisi: $("#IdVisiPN").val(),
                PrioritasNasional: $("#PrioritasNasional").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.EditPN', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            $("#IdPNForm").val($btn.data('id'));
            $("#_IdVisiPN").val($btn.data('idvisi'));
            $("#_PrioritasNasional").val($btn.data('pn'));
            $('#ModalEditPN').modal("show");
        });

        $("#EditBtnPN").click(function() {
            $.post(BaseURL + "Nasional/EditRKP_PN", {
                Id: $("#IdPNForm").val(),
                _IdVisi: $("#_IdVisiPN").val(),
                PrioritasNasional: $("#_PrioritasNasional").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.HapusPN', function(e) {
            e.stopPropagation();
            var id = $(this).closest('button').data('id');
            if (confirm("Yakin hapus Prioritas Nasional ini? Seluruh Program, Kegiatan, Sasaran, dan Indikator di bawahnya akan terhapus.")) {
                $.post(BaseURL + "Nasional/HapusRKP_PN", { Id: id }).done(function(r) {
                    if (r.trim() == '1') {
                        location.reload();
                    } else {
                        alert(r);
                    }
                });
            }
        });

        // ============================================== SCRIPT LEVEL 2 (PP)
        $(document).on('click', '.TambahPP', function(e) {
            e.stopPropagation();
            var id = $(this).closest('button').data('id');
            $('#IdPNParent').val(id);
            $('#ProgramPrioritas').val('');
            $('#ModalInputPP').modal('show');
        });

        $("#SimpanPP").click(function() {
            if (!$("#ProgramPrioritas").val()) return alert('Isi Uraian Program Prioritas!');
            $.post(BaseURL + "Nasional/InputRKP_PP", {
                _IdPN: $("#IdPNParent").val(),
                ProgramPrioritas: $("#ProgramPrioritas").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.EditPP', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            $("#IdPPForm").val($btn.data('id'));
            $("#_IdPNParent").val($btn.data('idpn'));
            $("#_ProgramPrioritas").val($btn.data('pp'));
            $('#ModalEditPP').modal("show");
        });

        $("#EditBtnPP").click(function() {
            $.post(BaseURL + "Nasional/EditRKP_PP", {
                Id: $("#IdPPForm").val(),
                _IdPN: $("#_IdPNParent").val(),
                ProgramPrioritas: $("#_ProgramPrioritas").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.HapusPP', function(e) {
            e.stopPropagation();
            var id = $(this).closest('button').data('id');
            if (confirm("Yakin hapus Program Prioritas ini? Seluruh Kegiatan, Sasaran, dan Indikator di bawahnya akan terhapus.")) {
                $.post(BaseURL + "Nasional/HapusRKP_PP", { Id: id }).done(function(r) {
                    if (r.trim() == '1') {
                        location.reload();
                    } else {
                        alert(r);
                    }
                });
            }
        });

        // ============================================== SCRIPT LEVEL 3 (KP)
        $(document).on('click', '.TambahKP', function(e) {
            e.stopPropagation();
            var id = $(this).closest('button').data('id');
            $('#IdPPParent').val(id);
            $('#KegiatanPrioritas').val('');
            $('#ModalInputKP').modal('show');
        });

        $("#SimpanKP").click(function() {
            if (!$("#KegiatanPrioritas").val()) return alert('Isi Uraian Kegiatan Prioritas!');
            $.post(BaseURL + "Nasional/InputRKP_KP", {
                _IdPP: $("#IdPPParent").val(),
                KegiatanPrioritas: $("#KegiatanPrioritas").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.EditKP', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            $("#IdKPForm").val($btn.data('id'));
            $("#_IdPPParent").val($btn.data('idpp'));
            $("#_KegiatanPrioritas").val($btn.data('kp'));
            $('#ModalEditKP').modal("show");
        });

        $("#EditBtnKP").click(function() {
            $.post(BaseURL + "Nasional/EditRKP_KP", {
                Id: $("#IdKPForm").val(),
                _IdPP: $("#_IdPPParent").val(),
                KegiatanPrioritas: $("#_KegiatanPrioritas").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.HapusKP', function(e) {
            e.stopPropagation();
            var id = $(this).closest('button').data('id');
            if (confirm("Yakin hapus Kegiatan Prioritas ini? Seluruh Sasaran, Proyek, dan Indikator di bawahnya akan terhapus.")) {
                $.post(BaseURL + "Nasional/HapusRKP_KP", { Id: id }).done(function(r) {
                    if (r.trim() == '1') {
                        location.reload();
                    } else {
                        alert(r);
                    }
                });
            }
        });

        // ============================================== SCRIPT LEVEL 4 (PROYEK)
        $(document).on('click', '.TambahProyek', function(e) {
            e.stopPropagation();
            var id = $(this).closest('button').data('id');
            $('#IdKPParent').val(id);
            $('#ProyekPrioritas').val('');
            $('#ModalInputProyek').modal('show');
        });

        $("#SimpanProyek").click(function() {
            if (!$("#ProyekPrioritas").val()) return alert('Isi Uraian Proyek Prioritas!');
            $.post(BaseURL + "Nasional/InputRKP_Proyek", {
                _IdKP: $("#IdKPParent").val(),
                ProyekPrioritas: $("#ProyekPrioritas").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.EditProyek', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            $("#IdProyekForm").val($btn.data('id'));
            $("#_IdKPParent").val($btn.data('idkp'));
            $("#_ProyekPrioritas").val($btn.data('proyek'));
            $('#ModalEditProyek').modal("show");
        });

        $("#EditBtnProyek").click(function() {
            $.post(BaseURL + "Nasional/EditRKP_Proyek", {
                Id: $("#IdProyekForm").val(),
                _IdKP: $("#_IdKPParent").val(),
                ProyekPrioritas: $("#_ProyekPrioritas").val()
            }).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.HapusProyek', function(e) {
            e.stopPropagation();
            var id = $(this).closest('button').data('id');
            if (confirm("Yakin hapus Proyek Prioritas ini?")) {
                $.post(BaseURL + "Nasional/HapusRKP_Proyek", { Id: id }).done(function(r) {
                    if (r.trim() == '1') {
                        location.reload();
                    } else {
                        alert(r);
                    }
                });
            }
        });

        // ============================================== SCRIPT UNIVERSAL SASARAN (PN, PP, KP)
        $(document).on('click', '.TambahSasaran', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            var tipe = $btn.data('tipe');
            $('#IdParentSasaran').val($btn.data('id'));
            $('#TipeLevelSasaran').val(tipe);
            $('#LabelTipeSasaran').text('(' + tipe + ')');
            $('#UniversalSasaran').val('');
            $('#ModalInputSasaran').modal('show');
        });

        $("#SimpanSasaran").click(function() {
            var tipe = $("#TipeLevelSasaran").val();
            if (!$("#UniversalSasaran").val()) return alert('Isi Uraian Sasaran!');
            var data = { Sasaran: $("#UniversalSasaran").val() };
            data["_Id" + tipe] = $("#IdParentSasaran").val();

            $.post(BaseURL + "Nasional/InputRKP_Sasaran" + tipe, data).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.EditSasaran', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            $("#IdSasaranForm").val($btn.data('id'));
            $("#_IdParentSasaran").val($btn.data('parentid'));
            $("#_TipeLevelSasaran").val($btn.data('tipe'));
            $("#_UniversalSasaran").val($btn.data('sasaran'));
            $('#ModalEditSasaran').modal("show");
        });

        $("#EditBtnSasaran").click(function() {
            var tipe = $("#_TipeLevelSasaran").val();
            var data = { Id: $("#IdSasaranForm").val(), Sasaran: $("#_UniversalSasaran").val() };
            data["_Id" + tipe] = $("#_IdParentSasaran").val();

            $.post(BaseURL + "Nasional/EditRKP_Sasaran" + tipe, data).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.HapusSasaran', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            if (confirm("Yakin hapus Sasaran ini? Seluruh Indikator di dalamnya akan terhapus.")) {
                var tipe = $btn.data('tipe');
                $.post(BaseURL + "Nasional/HapusRKP_Sasaran" + tipe, { Id: $btn.data('id') }).done(function(r) {
                    if (r.trim() == '1') {
                        location.reload();
                    } else {
                        alert(r);
                    }
                });
            }
        });

        // ============================================== SCRIPT UNIVERSAL INDIKATOR (PN, PP, KP)
        $(document).on('click', '.TambahIndikator', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            $('#IdSasaranParent').val($btn.data('id'));
            $('#TipeLevelIndikator').val($btn.data('tipe'));
            $('#UniversalIndikator').val('');
            $('#Satuan').val('');
            $('#Baseline').val('');
            $('#TargetAwal').val('');
            $('#TargetAkhir').val('');
            $('#Pengampu').val(null).trigger('change');
            $('#ModalInputIndikator').modal('show');
        });

        $("#SimpanIndikator").click(function() {
            var tipe = $("#TipeLevelIndikator").val();
            if (!$("#UniversalIndikator").val()) return alert('Isi Uraian Indikator!');
            var data = {
                Indikator: $("#UniversalIndikator").val(),
                Satuan: $("#Satuan").val(),
                Baseline: $("#Baseline").val(),
                TargetAwal: $("#TargetAwal").val(),
                TargetAkhir: $("#TargetAkhir").val(),
                Pengampu: $("#Pengampu").val() ? JSON.stringify($("#Pengampu").val()) : '[]'
            };
            data["_IdSasaran" + tipe] = $("#IdSasaranParent").val();

            $.post(BaseURL + "Nasional/InputRKP_Indikator" + tipe, data).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.EditIndikator', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            $("#IdIndikatorForm").val($btn.data('id'));
            $("#_IdSasaranParent").val($btn.data('parentid'));
            $("#_TipeLevelIndikator").val($btn.data('tipe'));
            $("#_UniversalIndikator").val($btn.data('indikator'));
            $("#_Satuan").val($btn.data('satuan'));
            $("#_Baseline").val($btn.data('baseline'));
            $("#_TargetAwal").val($btn.data('targetawal'));
            $("#_TargetAkhir").val($btn.data('targetakhir'));

            var pengampuData = $btn.data('pengampu');
            var pengampuArr = [];
            try {
                if (typeof pengampuData === 'string') {
                    pengampuArr = JSON.parse(pengampuData);
                } else if (Array.isArray(pengampuData)) {
                    pengampuArr = pengampuData;
                }
            } catch(err) {
                pengampuArr = pengampuData ? String(pengampuData).split(',') : [];
            }
            $('#_Pengampu').val(pengampuArr).trigger('change');
            $('#ModalEditIndikator').modal("show");
        });

        $("#EditBtnIndikator").click(function() {
            var tipe = $("#_TipeLevelIndikator").val();
            var data = {
                Id: $("#IdIndikatorForm").val(),
                Indikator: $("#_UniversalIndikator").val(),
                Satuan: $("#_Satuan").val(),
                Baseline: $("#_Baseline").val(),
                TargetAwal: $("#_TargetAwal").val(),
                TargetAkhir: $("#_TargetAkhir").val(),
                Pengampu: $("#_Pengampu").val() ? JSON.stringify($("#_Pengampu").val()) : '[]'
            };
            data["_IdSasaran" + tipe] = $("#_IdSasaranParent").val();

            $.post(BaseURL + "Nasional/EditRKP_Indikator" + tipe, data).done(function(r) {
                if (r.trim() == '1') {
                    location.reload();
                } else {
                    alert(r);
                }
            });
        });

        $(document).on('click', '.HapusIndikator', function(e) {
            e.stopPropagation();
            var $btn = $(this).closest('button');
            if (confirm("Yakin hapus Indikator ini?")) {
                var tipe = $btn.data('tipe');
                $.post(BaseURL + "Nasional/HapusRKP_Indikator" + tipe, { Id: $btn.data('id') }).done(function(r) {
                    if (r.trim() == '1') {
                        location.reload();
                    } else {
                        alert(r);
                    }
                });
            }
        });
        <?php } ?>
    });
</script>
