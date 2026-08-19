<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Keselarasan Kegiatan Prioritas Utama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('Daerah/Cssumum'); ?>
    
    <style>
        .table-prioritas th, .table-prioritas td {
            vertical-align: middle;
            text-align: center;
            border: 1px solid #dee2e6;
            padding: 8px 6px;
            font-size: 12px;
        }
        .table-prioritas .text-left { text-align: left !important; }
        .table-prioritas .text-wrap { white-space: normal; word-wrap: break-word; max-width: 200px; }
        
        .header-dukungan {
            background-color: #17a2b8 !important;
            color: #fff !important;
            text-align: center !important;
            font-weight: bold;
            font-size: 13px;
        }
        .sub-header-dukungan {
            background-color: #e9ecef !important;
            font-weight: 600;
            font-size: 11px;
        }
        .sub-header-dukungan th {
            background-color: #e9ecef !important;
            font-weight: 600;
            font-size: 11px;
            text-align: center !important;
        }
        
        /* ✅ GANTI BADGE DENGAN KODE NOMENKLATUR */
        .badge-kode {
            background: #17a2b8;
            color: #fff;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 2px;
            font-family: monospace;
        }
        .badge-kode.badge-sub { background: #17a2b8; }
        .badge-kode.badge-keg { background: #6c757d; }
        .badge-kode.badge-prog { background: #28a745; }
        
        .btn-aksi { padding: 3px 8px; font-size: 11px; margin: 1px; }
        
        .filter-section {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        
        .modal-lg-custom { max-width: 95%; width: 95%; }
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
        
        .detail-row-template {
            background: #f8f9fa;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .detail-row-template:hover {
            border-color: #17a2b8;
            box-shadow: 0 2px 8px rgba(23,162,184,0.15);
        }
        .detail-row-template .row-actions {
            text-align: right;
            padding-top: 5px;
        }
        .detail-row-template .breadcrumb-nomenklatur {
            background: #e9ecef;
            padding: 8px 12px;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .detail-row-template .breadcrumb-nomenklatur .badge {
            background: #007bff;
            color: #fff;
            padding: 3px 8px;
            border-radius: 3px;
            margin-right: 5px;
        }
        
        .btn-add-detail { margin-top: 10px; }
        
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
        
        .detail-counter-badge {
            display: inline-block;
            background: #17a2b8;
            color: #fff;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
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
        
        /* Highlight untuk row yang dihapus sementara */
        .detail-row-template.deleting {
            opacity: 0.5;
            border-color: #dc3545;
            background: #f8d7da;
        }
        
        .btn-remove-detail {
            transition: all 0.3s ease;
        }
        .btn-remove-detail:hover {
            transform: scale(1.05);
        }
        
        .text-nomenklatur {
            font-weight: 500;
            font-size: 11px;
        }
        
        @media (max-width: 768px) {
            .table-prioritas { font-size: 10px; }
            .table-prioritas th, .table-prioritas td { padding: 4px; }
            .modal-lg-custom { max-width: 98%; width: 98%; }
            .detail-row-template { padding: 10px; }
        }
    </style>
</head>
<body>

<?php $this->load->view('Daerah/sidebar'); ?>

<!-- LOADING OVERLAY -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner">
        <i class="notika-icon notika-refresh"></i>
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
                            <h2><b>Keselarasan Kegiatan Prioritas Utama</b></h2>
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
                                            <i class="notika-icon notika-search"></i> <b>Filter</b>
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
                                    <strong><i class="notika-icon notika-map"></i> Wilayah terpilih:</strong> 
                                    <?= html_escape($NamaWilayah) ?>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- TOMBOL TAMBAH -->
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3 && !empty($KodeWilayah)) { ?>
                            <div style="margin-bottom: 20px;">
                                <button class="btn btn-success" id="BtnTambah">
                                    <i class="notika-icon notika-plus"></i> <b>Tambah Data</b>
                                </button>
                                <span class="text-muted" style="margin-left:10px; font-size:12px;">
                                    <i class="notika-icon notika-info"></i> Tambahkan Kegiatan Prioritas Utama beserta dukungan RKPD 2026
                                </span>
                            </div>
                        <?php } ?>

                        <!-- TABEL -->
                        <div class="table-responsive">
                            <table id="data-table-prioritas" class="table table-striped table-prioritas">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width:50px; vertical-align:middle; text-align:center;">NO</th>
                                        <th rowspan="2" style="min-width:200px; vertical-align:middle; text-align:center;">PRIORITAS NASIONAL</th>
                                        <th rowspan="2" style="min-width:200px; vertical-align:middle; text-align:center;">KEGIATAN PRIORITAS UTAMA</th>
                                        <th colspan="3" class="header-dukungan" style="text-align:center; vertical-align:middle;">
                                            DUKUNGAN PADA RKPD 2026
                                        </th>
                                        <th rowspan="2" style="min-width:180px; vertical-align:middle; text-align:center;">PERANGKAT DAERAH</th>
                                        <th rowspan="2" style="min-width:150px; vertical-align:middle; text-align:center;">KETERANGAN</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th rowspan="2" style="width:120px; vertical-align:middle; text-align:center;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="sub-header-dukungan" style="min-width:150px;">SUB KEGIATAN</th>
                                        <th class="sub-header-dukungan" style="min-width:150px;">KEGIATAN</th>
                                        <th class="sub-header-dukungan" style="min-width:150px;">PROGRAM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ListData)) { 
                                        $no = 1;
                                        $grouped = [];
                                        foreach ($ListData as $row) {
                                            $masterId = $row['master_id'];
                                            if (!isset($grouped[$masterId])) {
                                                $grouped[$masterId] = [
                                                    'master' => [
                                                        'master_id' => $row['master_id'],
                                                        'id_prioritas_nasional' => $row['id_prioritas_nasional'],
                                                        'prioritas_nasional_nama' => $row['prioritas_nasional_nama'],
                                                        'kegiatan_prioritas' => $row['kegiatan_prioritas']
                                                    ],
                                                    'details' => []
                                                ];
                                            }
                                            if (!empty($row['detail_id'])) {
                                                $grouped[$masterId]['details'][] = $row;
                                            }
                                        }
                                        
                                        foreach ($grouped as $masterId => $data) {
                                            $master = $data['master'];
                                            $details = $data['details'];
                                            $totalDetails = count($details);
                                            $rowspan = max(1, $totalDetails);
                                            
                                            if ($totalDetails == 0) {
                                                ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td class="text-left"><?= html_escape($master['prioritas_nasional_nama'] ?? '-') ?></td>
                                                    <td class="text-left"><?= nl2br(html_escape($master['kegiatan_prioritas'] ?? '-')) ?></td>
                                                    <td class="text-center" colspan="3">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm btn-aksi BtnEdit" data-id="<?= $master['master_id'] ?>" title="Edit">
                                                                <i class="notika-icon notika-edit"></i>
                                                            </button>
                                                            <button class="btn btn-danger btn-sm btn-aksi BtnHapus" data-id="<?= $master['master_id'] ?>" title="Hapus">
                                                                <i class="notika-icon notika-trash"></i>
                                                            </button>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            } else {
                                                $first = true;
                                                foreach ($details as $index => $detail) {
                                                    ?>
                                                    <tr>
                                                        <?php if ($first) { ?>
                                                            <td rowspan="<?= $rowspan ?>"><?= $no++ ?></td>
                                                            <td rowspan="<?= $rowspan ?>" class="text-left"><?= html_escape($master['prioritas_nasional_nama'] ?? '-') ?></td>
                                                            <td rowspan="<?= $rowspan ?>" class="text-left"><?= nl2br(html_escape($master['kegiatan_prioritas'] ?? '-')) ?></td>
                                                        <?php } ?>
                                                        
                                                        <!-- ✅ SUB KEGIATAN - TAMPILKAN KODE NOMENKLATUR DI ATAS, NAMA DI BAWAH -->
                                                        <td class="text-left">
                                                            <?php if (!empty($detail['kode_sub_kegiatan'])) { ?>
                                                                <span class="badge-kode badge-sub"><?= html_escape($detail['kode_sub_kegiatan']) ?></span><br>
                                                            <?php } ?>
                                                            <span class="text-nomenklatur"><?= html_escape($detail['sub_kegiatan'] ?? '-') ?></span>
                                                        </td>
                                                        
                                                        <!-- ✅ KEGIATAN - TAMPILKAN KODE NOMENKLATUR DI ATAS, NAMA DI BAWAH -->
                                                        <td class="text-left">
                                                            <?php if (!empty($detail['kode_kegiatan'])) { ?>
                                                                <span class="badge-kode badge-keg"><?= html_escape($detail['kode_kegiatan']) ?></span><br>
                                                            <?php } ?>
                                                            <span class="text-nomenklatur"><?= html_escape($detail['kegiatan'] ?? '-') ?></span>
                                                        </td>
                                                        
                                                        <!-- ✅ PROGRAM - TAMPILKAN KODE NOMENKLATUR DI ATAS, NAMA DI BAWAH -->
                                                        <td class="text-left">
                                                            <?php if (!empty($detail['kode_program'])) { ?>
                                                                <span class="badge-kode badge-prog"><?= html_escape($detail['kode_program']) ?></span><br>
                                                            <?php } ?>
                                                            <span class="text-nomenklatur"><?= html_escape($detail['program'] ?? '-') ?></span>
                                                        </td>
                                                        
                                                        <td><?= html_escape($detail['perangkat_daerah_nama'] ?? '-') ?></td>
                                                        <td class="text-left text-wrap"><?= nl2br(html_escape($detail['keterangan'] ?? '-')) ?></td>
                                                        
                                                        <?php if ($first && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <td rowspan="<?= $rowspan ?>">
                                                                <button class="btn btn-warning btn-sm btn-aksi BtnEdit" data-id="<?= $master['master_id'] ?>" title="Edit">
                                                                    <i class="notika-icon notika-edit"></i>
                                                                </button>
                                                                <button class="btn btn-danger btn-sm btn-aksi BtnHapus" data-id="<?= $master['master_id'] ?>" title="Hapus">
                                                                    <i class="notika-icon notika-trash"></i>
                                                                </button>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php
                                                    $first = false;
                                                }
                                            }
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '9' : '8' ?>" class="text-center" style="padding:40px 0;">
                                                <div class="empty-state">
                                                    <i class="notika-icon notika-file"></i>
                                                    <h4><b>Belum ada data</b></h4>
                                                    <p class="text-muted">
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3 && !empty($KodeWilayah)) { ?>
                                                            Klik tombol <strong>"Tambah Data"</strong> untuk mulai mengisi Keselarasan Kegiatan Prioritas Utama.
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
<!-- MODAL FORM -->
<!-- ============================================================ -->
<div class="modal fade fixed-modal" id="ModalForm" role="dialog">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header" style="background:#28a745; color:#fff; border-radius: 6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:1;">&times;</button>
                <h4><b id="ModalTitle">Tambah Data</b></h4>
                <span id="DetailCounterBadge" class="detail-counter-badge">0 Dukungan</span>
            </div>
            <div class="modal-body">
                <input type="hidden" id="MasterId" value="0">
                
                <!-- MASTER -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>PRIORITAS NASIONAL</b> <span class="text-danger">*</span></label>
                            <select class="form-control" id="PrioritasNasional">
                                <option value="">-- Pilih Prioritas Nasional --</option>
                                <?php foreach ($PrioritasNasional as $pn) { ?>
                                    <option value="<?= $pn['Id'] ?>"><?= html_escape($pn['PrioritasNasional']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>KEGIATAN PRIORITAS UTAMA</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="KegiatanPrioritas" rows="2" placeholder="Isi Kegiatan Prioritas Utama..."></textarea>
                            <small class="text-muted">Contoh: Penurunan Stunting, Peningkatan Investasi, dll.</small>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- DETAIL (DUKUNGAN RKPD) -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h5><b>DUKUNGAN PADA RKPD 2026</b></h5>
                    <span class="text-muted small">Minimal 1 dukungan</span>
                </div>
                <p class="text-muted small">
                    <i class="notika-icon notika-info"></i> 
                    Pilih Program → Kegiatan → Sub Kegiatan dari hierarki nomenklatur.
                </p>
                
                <div id="DetailContainer">
                    <!-- Detail rows akan ditambahkan di sini -->
                </div>
                
                <button class="btn btn-sm btn-info" id="BtnTambahDetail">
                    <i class="notika-icon notika-plus"></i> Tambah Dukungan RKPD
                </button>
                
                <hr>
                
                <div class="text-right" style="padding-top:10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
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
var detailCounter = 0;

// ✅ Array untuk menyimpan ID detail yang dihapus
var deletedDetailIds = [];

// ================================================================
// LOADING
// ================================================================
function showLoading() { 
    $('#loadingOverlay').css('display', 'flex'); 
}

function hideLoading() { 
    $('#loadingOverlay').css('display', 'none'); 
}

// ================================================================
// NOMENKLATUR CACHE
// ================================================================
var nomenklaturCache = {};

// ================================================================
// FUNGSI LOAD DROPDOWN - PROGRAM → KEGIATAN → SUB KEGIATAN
// ================================================================

/**
 * Load Program (Level 3)
 */
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
            console.log('Program loaded:', res);
            nomenklaturCache[cacheKey] = res;
            populateSelect(selectId, res, 'Pilih Program', selectedValue);
            if (callback) callback();
        },
        error: function(xhr, status, error) {
            console.error('Error loading Program:', error);
            populateSelect(selectId, [], 'Pilih Program', selectedValue);
            if (callback) callback();
        }
    });
}

/**
 * Load Kegiatan berdasarkan Program (Level 4)
 */
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
            console.log('Kegiatan loaded for program ' + kodeProgram + ':', res);
            nomenklaturCache[cacheKey] = res;
            populateSelect(selectId, res, 'Pilih Kegiatan', selectedValue);
            if (callback) callback();
        },
        error: function(xhr, status, error) {
            console.error('Error loading Kegiatan:', error);
            populateSelect(selectId, [], 'Pilih Kegiatan', selectedValue);
            if (callback) callback();
        }
    });
}

/**
 * Load Sub Kegiatan berdasarkan Kegiatan (Level 5)
 */
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
            console.log('Sub Kegiatan loaded for kegiatan ' + kodeKegiatan + ':', res);
            nomenklaturCache[cacheKey] = res;
            populateSelect(selectId, res, 'Pilih Sub Kegiatan', selectedValue);
            if (callback) callback();
        },
        error: function(xhr, status, error) {
            console.error('Error loading Sub Kegiatan:', error);
            populateSelect(selectId, [], 'Pilih Sub Kegiatan', selectedValue);
            if (callback) callback();
        }
    });
}

/**
 * Populate select dengan data
 */
function populateSelect(selectId, data, placeholder, selectedValue) {
    var options = '<option value="">-- ' + placeholder + ' --</option>';
    
    if (data && data.length > 0) {
        for (var i = 0; i < data.length; i++) {
            var selected = (data[i].Kode == selectedValue) ? ' selected' : '';
            options += '<option value="' + data[i].Kode + '"' + selected + '>' + 
                       data[i].Kode + ' - ' + data[i].Nomenklatur + '</option>';
        }
    }
    
    $('#' + selectId).html(options);
    console.log('Populated select ' + selectId + ' with ' + (data ? data.length : 0) + ' items');
}

// ================================================================
// UPDATE COUNTER BADGE
// ================================================================
function updateDetailCounter() {
    var count = $('.detail-row-template').length;
    $('#DetailCounterBadge').text(count + ' Dukungan');
}

// ================================================================
// ✅ TAMBAH ROW DETAIL - DENGAN DETAIL ID
// ================================================================
function addDetailRow(data) {
    // ✅ SIMPAN DETAIL ID
    var id = data ? data.id : 0;
    var kodeSub = data ? data.kode_sub_kegiatan : '';
    var subKegiatan = data ? data.sub_kegiatan : '';
    var kodeKegiatan = data ? data.kode_kegiatan : '';
    var kegiatan = data ? data.kegiatan : '';
    var kodeProgram = data ? data.kode_program : '';
    var program = data ? data.program : '';
    var pdId = data ? data.id_perangkat_daerah : '';
    var keterangan = data ? data.keterangan : '';
    
    detailCounter++;
    var rowId = 'detail_' + detailCounter;
    var programSelectId = 'program_' + detailCounter;
    var kegiatanSelectId = 'kegiatan_' + detailCounter;
    var subSelectId = 'sub_' + detailCounter;
    
    var html = '<div class="detail-row-template" id="' + rowId + '">';
    
    // ✅ INPUT HIDDEN DETAIL ID
    html += '<input type="hidden" name="detail_id[]" value="' + id + '">';
    html += '<input type="hidden" name="detail_row_id[]" value="' + detailCounter + '">';
    
    // SIMPAN KODE KEGIATAN DAN PROGRAM UNTUK DIKIRIM KE SERVER
    html += '<input type="hidden" class="hidden-kode-kegiatan" name="kode_kegiatan[]" value="' + html_escape(kodeKegiatan) + '">';
    html += '<input type="hidden" class="hidden-kode-program" name="kode_program[]" value="' + html_escape(kodeProgram) + '">';
    
    // PATH DISPLAY
    html += '<div class="breadcrumb-nomenklatur">';
    html += '  <span class="badge">📁 Pilihan</span>';
    html += '  <span id="path_display_' + detailCounter + '">';
    if (program || kegiatan || subKegiatan) {
        var parts = [];
        if (program) parts.push(program);
        if (kegiatan) parts.push(kegiatan);
        if (subKegiatan) parts.push(subKegiatan);
        html += parts.join(' → ');
    } else {
        html += 'Belum ada yang dipilih';
    }
    html += '</span>';
    html += '</div>';
    
    // 3 DROPDOWN: Program → Kegiatan → Sub Kegiatan
    html += '<div class="row">';
    html += '  <div class="col-md-4 cascading-select">';
    html += '    <label><b>PROGRAM</b> <span class="text-danger">*</span></label>';
    html += '    <select class="form-control select-program" id="' + programSelectId + '" data-row="' + detailCounter + '">';
    html += '      <option value="">-- Pilih Program --</option>';
    html += '    </select>';
    html += '  </div>';
    html += '  <div class="col-md-4 cascading-select">';
    html += '    <label><b>KEGIATAN</b> <span class="text-danger">*</span></label>';
    html += '    <select class="form-control select-kegiatan" id="' + kegiatanSelectId + '" data-row="' + detailCounter + '" disabled>';
    html += '      <option value="">-- Pilih Kegiatan --</option>';
    html += '    </select>';
    html += '  </div>';
    html += '  <div class="col-md-4 cascading-select">';
    html += '    <label><b>SUB KEGIATAN</b> <span class="text-danger">*</span></label>';
    html += '    <select class="form-control select-sub" id="' + subSelectId + '" data-row="' + detailCounter + '" disabled>';
    html += '      <option value="">-- Pilih Sub Kegiatan --</option>';
    html += '    </select>';
    html += '  </div>';
    html += '</div>';
    
    // PERANGKAT DAERAH & KETERANGAN
    html += '<div class="row" style="margin-top:10px;">';
    html += '  <div class="col-md-5">';
    html += '    <label><b>PERANGKAT DAERAH</b> <span class="text-danger">*</span></label>';
    html += '    <select class="form-control" name="id_perangkat_daerah[]">';
    html += '      <option value="">-- Pilih Perangkat Daerah --</option>';
    <?php foreach ($PerangkatDaerah as $pd) { ?>
        html += '      <option value="<?= $pd['id'] ?>"' + ('<?= $pd['id'] ?>' == pdId ? ' selected' : '') + '><?= html_escape($pd['nama']) ?></option>';
    <?php } ?>
    html += '    </select>';
    html += '  </div>';
    html += '  <div class="col-md-5">';
    html += '    <label><b>KETERANGAN</b></label>';
    html += '    <input type="text" class="form-control" name="keterangan[]" value="' + html_escape(keterangan) + '" placeholder="Keterangan...">';
    html += '  </div>';
    html += '  <div class="col-md-2" style="padding-top:25px;">';
    html += '    <button class="btn btn-danger btn-sm btn-remove-detail" data-row="' + rowId + '" title="Hapus Dukungan">';
    html += '      <i class="notika-icon notika-trash"></i> Hapus';
    html += '    </button>';
    html += '  </div>';
    html += '</div>';
    html += '</div>';
    
    $('#DetailContainer').append(html);
    
    // UPDATE COUNTER
    updateDetailCounter();
    
    // ================================================================
    // LOAD DATA KE DROPDOWN - URUTAN: PROGRAM → KEGIATAN → SUB KEGIATAN
    // ================================================================
    
    // 1. Load Program
    console.log('Loading Program with selected: ' + kodeProgram);
    loadProgram(programSelectId, kodeProgram, function() {
        console.log('Program loaded, current value: ' + $('#' + programSelectId).val());
        
        // 2. Jika ada program yang dipilih, load Kegiatan
        var currentProgram = $('#' + programSelectId).val();
        if (kodeProgram || currentProgram) {
            var programToLoad = kodeProgram || currentProgram;
            console.log('Loading Kegiatan for program: ' + programToLoad);
            
            loadKegiatan(kegiatanSelectId, programToLoad, kodeKegiatan, function() {
                console.log('Kegiatan loaded, current value: ' + $('#' + kegiatanSelectId).val());
                $('#' + kegiatanSelectId).prop('disabled', false);
                
                // 3. Jika ada kegiatan yang dipilih, load Sub Kegiatan
                var currentKegiatan = $('#' + kegiatanSelectId).val();
                if (kodeKegiatan || currentKegiatan) {
                    var kegiatanToLoad = kodeKegiatan || currentKegiatan;
                    console.log('Loading Sub Kegiatan for kegiatan: ' + kegiatanToLoad);
                    
                    loadSubKegiatan(subSelectId, kegiatanToLoad, kodeSub, function() {
                        console.log('Sub Kegiatan loaded, current value: ' + $('#' + subSelectId).val());
                        $('#' + subSelectId).prop('disabled', false);
                        updatePath(rowId);
                    });
                } else {
                    updatePath(rowId);
                }
            });
        } else {
            updatePath(rowId);
        }
    });
}

/**
 * HTML Escape helper
 */
function html_escape(text) {
    if (!text) return '';
    return String(text).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

// ================================================================
// UPDATE PATH DISPLAY - DAN HIDDEN INPUT
// ================================================================
function updatePath(rowId) {
    var container = $('#' + rowId);
    var programSelect = container.find('.select-program');
    var kegiatanSelect = container.find('.select-kegiatan');
    var subSelect = container.find('.select-sub');
    
    var programText = programSelect.find('option:selected').text() || '';
    var kegiatanText = kegiatanSelect.find('option:selected').text() || '';
    var subText = subSelect.find('option:selected').text() || '';
    
    // UPDATE HIDDEN INPUT DENGAN KODE YANG DIPILIH
    var kodeProgram = programSelect.val() || '';
    var kodeKegiatan = kegiatanSelect.val() || '';
    var kodeSub = subSelect.val() || '';
    
    container.find('.hidden-kode-program').val(kodeProgram);
    container.find('.hidden-kode-kegiatan').val(kodeKegiatan);
    
    var path = [];
    if (programText) path.push(programText);
    if (kegiatanText) path.push(kegiatanText);
    if (subText) path.push(subText);
    
    var rowNum = container.find('input[name="detail_row_id[]"]').val();
    var display = path.length > 0 ? path.join(' → ') : 'Belum ada yang dipilih';
    $('#path_display_' + rowNum).text(display);
}

// ================================================================
// EVENT: PROGRAM CHANGE → LOAD KEGIATAN
// ================================================================
$(document).on('change', '.select-program', function() {
    var rowId = $(this).closest('.detail-row-template').attr('id');
    var rowNum = $(this).data('row');
    var kodeProgram = $(this).val();
    
    var kegiatanSelectId = 'kegiatan_' + rowNum;
    var subSelectId = 'sub_' + rowNum;
    
    console.log('Program changed to: ' + kodeProgram);
    
    // Reset kegiatan dan sub kegiatan
    populateSelect(kegiatanSelectId, [], 'Pilih Kegiatan', '');
    $('#' + kegiatanSelectId).prop('disabled', true);
    populateSelect(subSelectId, [], 'Pilih Sub Kegiatan', '');
    $('#' + subSelectId).prop('disabled', true);
    
    // Update hidden kode program
    $('#' + rowId + ' .hidden-kode-program').val(kodeProgram);
    
    if (kodeProgram) {
        loadKegiatan(kegiatanSelectId, kodeProgram, '', function() {
            $('#' + kegiatanSelectId).prop('disabled', false);
            updatePath(rowId);
        });
    } else {
        updatePath(rowId);
    }
});

// ================================================================
// EVENT: KEGIATAN CHANGE → LOAD SUB KEGIATAN
// ================================================================
$(document).on('change', '.select-kegiatan', function() {
    var rowId = $(this).closest('.detail-row-template').attr('id');
    var rowNum = $(this).data('row');
    var kodeKegiatan = $(this).val();
    
    var subSelectId = 'sub_' + rowNum;
    
    console.log('Kegiatan changed to: ' + kodeKegiatan);
    
    // Reset sub kegiatan
    populateSelect(subSelectId, [], 'Pilih Sub Kegiatan', '');
    $('#' + subSelectId).prop('disabled', true);
    
    // Update hidden kode kegiatan
    $('#' + rowId + ' .hidden-kode-kegiatan').val(kodeKegiatan);
    
    if (kodeKegiatan) {
        loadSubKegiatan(subSelectId, kodeKegiatan, '', function() {
            $('#' + subSelectId).prop('disabled', false);
            updatePath(rowId);
        });
    } else {
        updatePath(rowId);
    }
});

// ================================================================
// EVENT: SUB KEGIATAN CHANGE → UPDATE PATH
// ================================================================
$(document).on('change', '.select-sub', function() {
    var rowId = $(this).closest('.detail-row-template').attr('id');
    console.log('Sub Kegiatan changed, updating path');
    updatePath(rowId);
});

// ================================================================
// ✅ TAMBAH DETAIL - DENGAN UPDATE COUNTER
// ================================================================
$(document).on('click', '#BtnTambahDetail', function(e) {
    e.preventDefault();
    addDetailRow(null);
});

// ================================================================
// ✅ HAPUS DETAIL - TRACK DELETED STRATEGY
// ================================================================
$(document).on('click', '.btn-remove-detail', function(e) {
    e.preventDefault();
    var rowId = $(this).data('row');
    var detailId = $('#' + rowId).find('input[name="detail_id[]"]').val();
    
    if (confirm('Hapus dukungan RKPD ini?')) {
        // ✅ SIMPAN ID YANG DIHAPUS
        if (detailId && parseInt(detailId) > 0) {
            if (!deletedDetailIds.includes(detailId)) {
                deletedDetailIds.push(detailId);
            }
            console.log('Deleted IDs:', deletedDetailIds);
        }
        
        // Hapus dari DOM dengan animasi
        $('#' + rowId).fadeOut(300, function() {
            $(this).remove();
            updateDetailCounter();
        });
    }
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
// ✅ CRUD - TRACK DELETED STRATEGY
// ================================================================
if (IS_ROLE_3 == '1' && KODE_WILAYAH) {

    // TOMBOL TAMBAH
    $(document).on('click', '#BtnTambah', function(e) {
        e.preventDefault();
        
        // ✅ RESET deletedDetailIds
        deletedDetailIds = [];
        
        $('#MasterId').val(0);
        $('#ModalTitle').text('Tambah Data');
        $('#PrioritasNasional').val('');
        $('#KegiatanPrioritas').val('');
        $('#DetailContainer').empty();
        detailCounter = 0;
        addDetailRow(null);
        updateDetailCounter();
        
        $('#ModalForm').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    // TOMBOL EDIT
    $(document).on('click', '.BtnEdit', function(e) {
        e.preventDefault();
        var masterId = $(this).data('id');
        
        if (!masterId) {
            alert('ID tidak valid!');
            return;
        }
        
        // ✅ RESET deletedDetailIds
        deletedDetailIds = [];
        
        showLoading();
        
        $.ajax({
            url: BaseURL + "Daerah/GetKeselarasanPrioritasByMasterId",
            type: "POST",
            data: { master_id: masterId, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success" && res.data) {
                    var d = res.data;
                    $('#MasterId').val(d.id);
                    $('#ModalTitle').text('Edit Data');
                    $('#PrioritasNasional').val(d.id_prioritas_nasional);
                    $('#KegiatanPrioritas').val(d.kegiatan_prioritas || '');
                    $('#DetailContainer').empty();
                    detailCounter = 0;
                    
                    if (d.details && d.details.length > 0) {
                        for (var i = 0; i < d.details.length; i++) {
                            addDetailRow(d.details[i]);
                        }
                    } else {
                        addDetailRow(null);
                    }
                    updateDetailCounter();
                    
                    $('#ModalForm').modal({
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

    // ================================================================
    // ✅ SIMPAN - DENGAN detail_id DAN deleted_details
    // ================================================================
    $(document).on('click', '#BtnSimpan', function(e) {
        e.preventDefault();
        
        var masterId = parseInt($('#MasterId').val()) || 0;
        var idPrioritasNasional = $('#PrioritasNasional').val();
        var kegiatanPrioritas = $('#KegiatanPrioritas').val().trim();
        
        if (!idPrioritasNasional || idPrioritasNasional == '') {
            alert('Prioritas Nasional harus dipilih!');
            $('#PrioritasNasional').focus();
            return;
        }
        
        if (!kegiatanPrioritas) {
            alert('Kegiatan Prioritas Utama harus diisi!');
            $('#KegiatanPrioritas').focus();
            return;
        }
        
        // Ambil data detail
        var detailIds = [];
        var kodeSubKegiatan = [];
        var kodeKegiatan = [];
        var kodeProgram = [];
        var idPerangkatDaerah = [];
        var keterangan = [];
        var hasData = false;
        
        $('.detail-row-template').each(function() {
            var id = $(this).find('input[name="detail_id[]"]').val();
            var subKode = $(this).find('.select-sub').val();
            var kegKode = $(this).find('.hidden-kode-kegiatan').val() || '';
            var progKode = $(this).find('.hidden-kode-program').val() || '';
            var pd = $(this).find('select[name="id_perangkat_daerah[]"]').val();
            var ket = $(this).find('input[name="keterangan[]"]').val();
            
            // Cek apakah ada Sub Kegiatan yang dipilih
            var hasSub = subKode && subKode != '';
            
            if (hasSub) {
                hasData = true;
                detailIds.push(id || '');
                kodeSubKegiatan.push(subKode || '');
                kodeKegiatan.push(kegKode);
                kodeProgram.push(progKode);
                idPerangkatDaerah.push(pd || '');
                keterangan.push(ket || '');
            }
        });
        
        if (!hasData) {
            alert('Minimal tambahkan 1 dukungan RKPD 2026 dengan Sub Kegiatan yang valid!');
            return;
        }
        
        showLoading();
        
        // ✅ KIRIM deleted_details
        var data = {
            master_id: masterId,
            id_prioritas_nasional: idPrioritasNasional,
            kegiatan_prioritas: kegiatanPrioritas,
            detail_id: detailIds,
            kode_sub_kegiatan: kodeSubKegiatan,
            kode_kegiatan: kodeKegiatan,
            kode_program: kodeProgram,
            id_perangkat_daerah: idPerangkatDaerah,
            keterangan: keterangan,
            deleted_details: deletedDetailIds.join(','), // ✅ KIRIM ID YANG DIHAPUS
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        console.log('Data to send:', data);
        console.log('Deleted IDs:', deletedDetailIds);
        
        var url = (masterId > 0) ? BaseURL + "Daerah/EditKeselarasanPrioritasFull" : BaseURL + "Daerah/InputKeselarasanPrioritasFull";
        
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
            error: function(xhr, status, error) {
                hideLoading();
                alert("Terjadi kesalahan: " + error + "\n" + xhr.responseText);
                console.log('Error:', xhr);
            }
        });
    });

    // HAPUS MASTER
    $(document).on('click', '.BtnHapus', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        if (!confirm("Yakin hapus data ini? Semua dukungan RKPD terkait juga akan dihapus.")) return;
        
        showLoading();
        
        $.ajax({
            url: BaseURL + "Daerah/HapusKeselarasanPrioritasMaster",
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
// MODAL CLOSE - RESET STATE
// ================================================================
$('.modal').on('hidden.bs.modal', function() {
    $('body').removeClass('modal-open');
    $(this).removeClass('in').css('display', 'none');
    
    // ✅ RESET deletedDetailIds saat modal ditutup
    deletedDetailIds = [];
});

// ================================================================
// DATATABLE
// ================================================================
$(document).ready(function() {
    if ($('#data-table-prioritas').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-prioritas')) {
                $('#data-table-prioritas').DataTable().destroy();
            }
            
            $('#data-table-prioritas').DataTable({
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

console.log('=== Keselarasan Prioritas Debug ===');
console.log('BaseURL:', BaseURL);
console.log('KODE_WILAYAH:', KODE_WILAYAH);
console.log('IS_ROLE_3:', IS_ROLE_3);
console.log('Strategy: TRACK DELETED (detail_id + deleted_details)');
</script>

</body>
</html>