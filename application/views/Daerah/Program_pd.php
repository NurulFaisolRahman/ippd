<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    /* ============================================================
      STYLE PROGRAM PD - DENGAN OUTCOME & INDIKATOR
    ============================================================ */
    .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
    .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
    .filter-group label { font-size:14px; margin-bottom:5px; }
    .filter-select { width:260px; font-size:14px; padding:5px 8px; }
    
    .program-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }
    .program-table th {
        background: #f1f8e9;
        text-align: center;
        font-weight: 600;
        padding: 6px 4px;
        border: 1px solid #dee2e6;
        font-size: 10px;
        vertical-align: middle;
    }
    .program-table td {
        padding: 4px 3px;
        border: 1px solid #dee2e6;
        vertical-align: middle;
        text-align: center;
    }
    .program-table .text-left { text-align: left; padding-left: 8px; }
    .program-table .text-right { text-align: right; padding-right: 8px; }
    
    /* Warna level */
    .program-table .row-urusan { background: #f8f9fa; font-weight: 600; }
    .program-table .row-urusan td { border-bottom: 2px solid #007bff; }
    .program-table .row-urusan .badge-urusan {
        background: #007bff; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 10px;
    }
    .program-table .row-urusan .total-pagu-urusan {
        color: #007bff; font-weight: 700; font-size: 11px;
    }
    
    .program-table .row-bidang { background: #fafbfc; }
    .program-table .row-bidang .badge-bidang {
        background: #28a745; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px;
    }
    .program-table .row-bidang .nama-bidang { font-weight: 500; color: #2c3e50; }
    .program-table .row-bidang .total-pagu-bidang {
        color: #28a745; font-weight: 700; font-size: 11px;
    }
    
    .program-table .row-program { 
        background: #eef7ff; 
        border-left: 3px solid #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }
    .program-table .row-program .badge-program {
        background: #0d6efd; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px;
    }
    .program-table .row-program .nama-program {
        font-weight: 600; color: #0b2b4a;
    }
    
    .program-table .row-outcome { 
        background: #f0faf0; 
        border-left: 3px solid #198754;
    }
    .program-table .row-outcome .outcome-text {
        font-weight: 500; color: #0a3622;
        padding-left: 20px;
    }
    .program-table .row-outcome .badge-outcome {
        background: #198754; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px;
    }
    
    .program-table .row-indikator { background: #fff; border-left: 3px solid #ffc107; }
    .program-table .row-indikator .indikator-text {
        font-weight: 400; color: #2c3e50; padding-left: 8px;
    }
    
    .program-table .pagu-col { color: #1a5276; font-weight: 500; font-size: 10px; }
    
    .program-table .badge-pd {
        background: #e9ecef; color: #495057; padding: 2px 6px; border-radius: 4px; font-size: 9px;
        display: inline-block;
    }
    .program-table .badge-empty { color: #adb5bd; font-size: 9px; }
    
    .program-table .col-aksi { text-align: center; vertical-align: middle; min-width: 80px; }
    .program-table .btn-aksi { padding: 1px 4px; font-size: 9px; margin: 1px; border: none; border-radius: 3px; }
    .program-table .btn-group-aksi { display: inline-flex; gap: 1px; flex-wrap: wrap; justify-content: center; }
    
    /* Indentasi */
    .level-urusan { padding-left: 5px; }
    .level-bidang { padding-left: 25px; }
    .level-program { padding-left: 45px; }
    .level-outcome { padding-left: 45px; }
    .level-indikator { padding-left: 45px; }
    
    .border-urusan { border-left: 4px solid #007bff !important; }
    .border-bidang { border-left: 4px solid #28a745 !important; }
    .border-program { border-left: 4px solid #0d6efd !important; }
    .border-outcome { border-left: 4px solid #198754 !important; }
    .border-indikator { border-left: 4px solid #ffc107 !important; }

    /* MODAL FIXED */
    .modal.fixed-modal {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 99999;
        background: rgba(0,0,0,0.6);
        display: none !important;
        padding: 20px;
        overflow-y: auto;
        align-items: center;
        justify-content: center;
    }
    .modal.fixed-modal.show { display: flex !important; }
    .modal.fixed-modal .modal-dialog {
        margin: 0 auto;
        position: relative;
        width: 100%;
        max-width: 95%;
        max-height: calc(100vh - 40px);
        display: flex;
        flex-direction: column;
    }
    .modal.fixed-modal .modal-content {
        max-height: calc(100vh - 40px);
        display: flex;
        flex-direction: column;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        background: #fff;
        position: relative;
    }
    .modal.fixed-modal .modal-header {
        flex-shrink: 0;
        border-radius: 8px 8px 0 0;
        padding: 15px 20px;
        background: #28a745;
        color: #fff;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .modal.fixed-modal .modal-header .close {
        color: #fff;
        opacity: 0.8;
        font-size: 28px;
        font-weight: 300;
        text-shadow: none;
        background: transparent;
        border: none;
        padding: 0 10px;
    }
    .modal.fixed-modal .modal-header .close:hover { opacity: 1; }
    .modal.fixed-modal .modal-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        max-height: calc(100vh - 200px);
    }
    .modal.fixed-modal .modal-footer {
        flex-shrink: 0;
        border-radius: 0 0 8px 8px;
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #dee2e6;
        position: sticky;
        bottom: 0;
        z-index: 10;
    }
    .modal.fixed-modal .modal-dialog.modal-md { max-width: 600px; }
    .modal.fixed-modal .modal-dialog.modal-lg-custom { max-width: 95%; width: 95%; }
    .modal.fixed-modal .modal-dialog.modal-xl-custom { max-width: 98%; width: 98%; }
    .modal.fixed-modal.show .modal-dialog { animation: modalSlideIn 0.3s ease; }
    @keyframes modalSlideIn {
        from { transform: translateY(-30px) scale(0.95); opacity: 0; }
        to { transform: translateY(0) scale(1); opacity: 1; }
    }
    .modal.fixed-modal .modal-body::-webkit-scrollbar { width: 6px; }
    .modal.fixed-modal .modal-body::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 3px; }
    .modal.fixed-modal .modal-body::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 3px; }
    .modal.fixed-modal .modal-body::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }

    .nomenklatur-container { padding: 10px 0; }
    .breadcrumb-nomenklatur {
        background: #f8f9fa;
        padding: 8px 15px;
        border-radius: 4px;
        margin-bottom: 12px;
        border: 1px solid #dee2e6;
        font-size: 13px;
    }
    .breadcrumb-nomenklatur .badge-path {
        background: #007bff; color: #fff; padding: 3px 10px; border-radius: 4px; margin-right: 8px; font-size: 11px;
    }
    .cascading-select { margin-bottom: 10px; }
    .cascading-select select { height: 38px; font-size: 13px; }
    .cascading-select label { font-weight: 600; font-size: 12px; color: #495057; margin-bottom: 3px; }
    .nomenklatur-info {
        background: #e8f0fe; padding: 10px 15px; border-radius: 4px; margin-top: 10px;
        border-left: 3px solid #007bff; display: none;
    }
    .nomenklatur-info strong { color: #1a5276; }

    /* OUTCOME & INDIKATOR DI MODAL */
    .outcome-group {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
    }
    .outcome-group .btn-remove-outcome {
        position: absolute;
        top: 8px;
        right: 8px;
        padding: 4px 12px;
        font-size: 16px;
        line-height: 1.2;
        min-width: 30px;
        min-height: 30px;
        border-radius: 5px;
        z-index: 10;
    }
    .outcome-group .btn-remove-outcome:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }
    .indikator-row {
        background: #fff;
        padding: 30px 15px 10px 15px;
        border-radius: 5px;
        margin-bottom: 10px;
        border: 1px solid #dee2e6;
        position: relative;
    }
    .indikator-row .btn-remove-indikator {
        position: absolute;
        top: 8px;
        right: 8px;
        padding: 5px 12px;
        font-size: 16px;
        line-height: 1.2;
        min-width: 34px;
        min-height: 34px;
        border-radius: 5px;
        z-index: 10;
    }
    .indikator-row .btn-remove-indikator:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }
    .indikator-row .row:first-child { margin-right: 50px; }
    .indikator-row .form-group { margin-bottom: 5px; }
    .indikator-row .form-control-sm { font-size: 12px; height: 30px; padding: 2px 8px; }
    .indikator-row textarea.form-control-sm { height: 38px; resize: vertical; }
    .outcome-group .outcome-textarea { resize: vertical; min-height: 50px; }

    .btn-group-center { display: flex; justify-content: center; align-items: center; gap: 15px; margin-top: 20px; padding: 10px 0; }
    .btn-group-center .btn { min-width: 120px; }
    .empty-state { text-align: center; padding: 40px 20px; color: #6c757d; }
    .empty-state .icon { font-size: 48px; margin-bottom: 15px; color: #dee2e6; }
    .empty-state h5 { color: #495057; }
    .table-scroll { overflow-x: auto; margin-top: 5px; }
    .table-scroll .program-table { min-width: 1400px; }

    @media (max-width: 768px) {
        .filter-row { flex-direction:column; gap:15px; }
        .filter-select { width:100%; }
        .modal-lg-custom { max-width: 98%; width: 98%; }
        .modal-xl-custom { max-width: 100%; width: 100%; }
        .program-table { font-size: 9px; }
        .program-table th, .program-table td { padding: 2px 1px; }
        .program-table .col-aksi { min-width: 60px; }
        .program-table .btn-aksi { font-size: 7px; padding: 1px 2px; }
        .level-urusan { padding-left: 3px; }
        .level-bidang { padding-left: 15px; }
        .level-program { padding-left: 30px; }
        .level-outcome { padding-left: 30px; }
        .level-indikator { padding-left: 30px; }
        .modal.fixed-modal { padding: 10px; }
        .modal.fixed-modal .modal-dialog { max-height: calc(100vh - 20px); }
        .modal.fixed-modal .modal-content { max-height: calc(100vh - 20px); }
        .modal.fixed-modal .modal-body { max-height: calc(100vh - 160px); padding: 15px; }
        .indikator-row .btn-remove-indikator {
            padding: 4px 10px; font-size: 14px; min-width: 30px; min-height: 30px;
        }
        .indikator-row .row:first-child { margin-right: 40px; }
        .outcome-group .btn-remove-outcome {
            padding: 4px 10px; font-size: 14px; min-width: 30px; min-height: 30px;
        }
    }
    
    /* Style untuk program dan outcome dalam satu kolom */
    .program-outcome-cell {
        text-align: left;
        padding: 4px 8px;
    }
    .program-name {
        font-weight: 600;
        color: #0b2b4a;
        display: block;
    }
    .outcome-name {
        font-weight: 500;
        color: #0a3622;
        display: block;
        padding-left: 0px;
    }
    .badge-outcome-sm {
        background: #198754; 
        color: #fff; 
        padding: 1px 6px; 
        border-radius: 8px; 
        font-size: 8px;
        margin-right: 4px;
    }
    .badge-program-sm {
        background: #0d6efd; 
        color: #fff; 
        padding: 1px 6px; 
        border-radius: 8px; 
        font-size: 8px;
        margin-right: 4px;
    }
    .badge-indikator-sm {
        background: #ffc107; 
        color: #212529; 
        padding: 1px 6px; 
        border-radius: 8px; 
        font-size: 8px;
        margin-right: 4px;
    }
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH -->
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
                                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>><?= html_escape($prov['Nama']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="KabKota"><b>Kab/Kota</b></label>
                                                    <select class="form-control filter-select" id="KabKota">
                                                        <option value="">Pilih Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter"><b>Filter</b></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array(); ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah terpilih:</strong> <?= html_escape($wilayah['Nama'] ?? 'Wilayah Tidak Ditemukan') ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <!-- TOMBOL TAMBAH URUSAN -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-primary notika-btn-primary" id="BtnTambahUrusan">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Urusan</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- TABEL DATA -->
                        <div id="ListDataContainer">
                            <?php if (empty($ListData)) { ?>
                                <div class="empty-state">
                                    <div class="icon">📋</div>
                                    <h5>Belum ada data</h5>
                                    <p>Silakan tambahkan data terlebih dahulu atau pilih wilayah yang benar.</p>
                                </div>
                            <?php } else { ?>
                                <div class="table-scroll">
                                    <table class="program-table">
                                        <thead>
                                            <tr>
                                                <th style="width:15%;">URUSAN / BIDANG / PROGRAM / OUTCOME</th>
                                                <th style="width:10%;">INDIKATOR</th>
                                                <th style="width:5%;">SATUAN</th>
                                                <th style="width:7%;">KONDISI AWAL</th>
                                                <th colspan="2" style="width:7%;">2026</th>
                                                <th colspan="2" style="width:7%;">2027</th>
                                                <th colspan="2" style="width:7%;">2028</th>
                                                <th colspan="2" style="width:7%;">2029</th>
                                                <th colspan="2" style="width:7%;">2030</th>
                                                <th style="width:8%;">PERANGKAT DAERAH</th>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <th style="width:5%;" class="col-aksi">AKSI</th>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th></th><th></th><th></th><th></th>
                                                <th>TARGET</th><th>PAGU</th>
                                                <th>TARGET</th><th>PAGU</th>
                                                <th>TARGET</th><th>PAGU</th>
                                                <th>TARGET</th><th>PAGU</th>
                                                <th>TARGET</th><th>PAGU</th>
                                                <th></th>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <th class="col-aksi"></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($ListData as $urusan) {
                                                $hasBidang = !empty($urusan['bidang']);
                                                
                                                // Hitung total pagu urusan
                                                $urusanTotal = ['2026'=>0,'2027'=>0,'2028'=>0,'2029'=>0,'2030'=>0];
                                                if ($hasBidang) {
                                                    foreach ($urusan['bidang'] as $bidang) {
                                                        if (!empty($bidang['program'])) {
                                                            foreach ($bidang['program'] as $program) {
                                                                if (!empty($program['outcomes'])) {
                                                                    foreach ($program['outcomes'] as $outcome) {
                                                                        if (!empty($outcome['indikators'])) {
                                                                            foreach ($outcome['indikators'] as $ind) {
                                                                                $urusanTotal['2026'] += (float)($ind['pagu_2026'] ?? 0);
                                                                                $urusanTotal['2027'] += (float)($ind['pagu_2027'] ?? 0);
                                                                                $urusanTotal['2028'] += (float)($ind['pagu_2028'] ?? 0);
                                                                                $urusanTotal['2029'] += (float)($ind['pagu_2029'] ?? 0);
                                                                                $urusanTotal['2030'] += (float)($ind['pagu_2030'] ?? 0);
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                                <!-- ROW URUSAN -->
                                                <tr class="row-urusan border-urusan">
                                                    <td class="text-left level-urusan" colspan="2">
                                                        <span class="badge-urusan"><?= html_escape($urusan['kode_urusan']) ?></span>
                                                        <strong><?= html_escape($urusan['nama_urusan']) ?></strong>
                                                    </td>
                                                    <td></td><td></td>
                                                    <td></td><td class="pagu-col total-pagu-urusan"><?= $urusanTotal['2026'] > 0 ? number_format($urusanTotal['2026'],0,',','.') : '-' ?></td>
                                                    <td></td><td class="pagu-col total-pagu-urusan"><?= $urusanTotal['2027'] > 0 ? number_format($urusanTotal['2027'],0,',','.') : '-' ?></td>
                                                    <td></td><td class="pagu-col total-pagu-urusan"><?= $urusanTotal['2028'] > 0 ? number_format($urusanTotal['2028'],0,',','.') : '-' ?></td>
                                                    <td></td><td class="pagu-col total-pagu-urusan"><?= $urusanTotal['2029'] > 0 ? number_format($urusanTotal['2029'],0,',','.') : '-' ?></td>
                                                    <td></td><td class="pagu-col total-pagu-urusan"><?= $urusanTotal['2030'] > 0 ? number_format($urusanTotal['2030'],0,',','.') : '-' ?></td>
                                                    <td></td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <td class="col-aksi">
                                                            <div class="btn-group-aksi">
                                                                <button class="btn btn-sm btn-success btn-aksi BtnTambahBidang" data-urusan-id="<?= $urusan['id'] ?>" data-kode-urusan="<?= html_escape($urusan['kode_urusan']) ?>" data-nama-urusan="<?= html_escape($urusan['nama_urusan']) ?>" title="Tambah Bidang"><i class="notika-icon bi-plus-lg"></i></button>
                                                                <button class="btn btn-sm btn-warning btn-aksi BtnEditUrusan" data-id="<?= $urusan['id'] ?>" data-kode="<?= html_escape($urusan['kode_urusan']) ?>" data-nama="<?= html_escape($urusan['nama_urusan']) ?>" title="Edit Urusan"><i class="notika-icon notika-edit"></i></button>
                                                                <button class="btn btn-sm btn-danger btn-aksi BtnHapusUrusan" data-id="<?= $urusan['id'] ?>" title="Hapus Urusan"><i class="notika-icon notika-trash"></i></button>
                                                            </div>
                                                        </td>
                                                    <?php } ?>
                                                </tr>

                                                <?php if ($hasBidang) { ?>
                                                    <?php foreach ($urusan['bidang'] as $bidang) { 
                                                        $hasProgram = !empty($bidang['program']);
                                                        $bidangTotal = ['2026'=>0,'2027'=>0,'2028'=>0,'2029'=>0,'2030'=>0];
                                                        if ($hasProgram) {
                                                            foreach ($bidang['program'] as $program) {
                                                                if (!empty($program['outcomes'])) {
                                                                    foreach ($program['outcomes'] as $outcome) {
                                                                        if (!empty($outcome['indikators'])) {
                                                                            foreach ($outcome['indikators'] as $ind) {
                                                                                $bidangTotal['2026'] += (float)($ind['pagu_2026'] ?? 0);
                                                                                $bidangTotal['2027'] += (float)($ind['pagu_2027'] ?? 0);
                                                                                $bidangTotal['2028'] += (float)($ind['pagu_2028'] ?? 0);
                                                                                $bidangTotal['2029'] += (float)($ind['pagu_2029'] ?? 0);
                                                                                $bidangTotal['2030'] += (float)($ind['pagu_2030'] ?? 0);
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                        <!-- ROW BIDANG -->
                                                        <tr class="row-bidang border-bidang">
                                                            <td class="text-left level-bidang" colspan="2">
                                                                <span class="badge-bidang"><?= html_escape($bidang['kode_bidang']) ?></span>
                                                                <span class="nama-bidang"><?= html_escape($bidang['nama_bidang']) ?></span>
                                                            </td>
                                                            <td></td><td></td>
                                                            <td></td><td class="pagu-col total-pagu-bidang"><?= $bidangTotal['2026'] > 0 ? number_format($bidangTotal['2026'],0,',','.') : '-' ?></td>
                                                            <td></td><td class="pagu-col total-pagu-bidang"><?= $bidangTotal['2027'] > 0 ? number_format($bidangTotal['2027'],0,',','.') : '-' ?></td>
                                                            <td></td><td class="pagu-col total-pagu-bidang"><?= $bidangTotal['2028'] > 0 ? number_format($bidangTotal['2028'],0,',','.') : '-' ?></td>
                                                            <td></td><td class="pagu-col total-pagu-bidang"><?= $bidangTotal['2029'] > 0 ? number_format($bidangTotal['2029'],0,',','.') : '-' ?></td>
                                                            <td></td><td class="pagu-col total-pagu-bidang"><?= $bidangTotal['2030'] > 0 ? number_format($bidangTotal['2030'],0,',','.') : '-' ?></td>
                                                            <td></td>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                <td class="col-aksi">
                                                                    <div class="btn-group-aksi">
                                                                        <button class="btn btn-sm btn-info btn-aksi BtnTambahProgram" data-bidang-id="<?= $bidang['id'] ?>" data-kode-bidang="<?= html_escape($bidang['kode_bidang']) ?>" data-nama-bidang="<?= html_escape($bidang['nama_bidang']) ?>" data-urusan-id="<?= $urusan['id'] ?>" title="Tambah Program"><i class="notika-icon bi-plus-lg"></i></button>
                                                                        <button class="btn btn-sm btn-warning btn-aksi BtnEditBidang" data-id="<?= $bidang['id'] ?>" data-urusan-id="<?= $urusan['id'] ?>" data-kode="<?= html_escape($bidang['kode_bidang']) ?>" data-nama="<?= html_escape($bidang['nama_bidang']) ?>" title="Edit Bidang"><i class="notika-icon notika-edit"></i></button>
                                                                        <button class="btn btn-sm btn-danger btn-aksi BtnHapusBidang" data-id="<?= $bidang['id'] ?>" title="Hapus Bidang"><i class="notika-icon notika-trash"></i></button>
                                                                    </div>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>

                                                        <?php if ($hasProgram) { ?>
                                                            <?php foreach ($bidang['program'] as $program) { 
                                                                $outcomes = $program['outcomes'] ?? [];
                                                                
                                                                // Hitung total indikator
                                                                $totalIndikator = 0;
                                                                $firstOutcomePdId = null;
                                                                $firstOutcomePdName = null;
                                                                
                                                                foreach ($outcomes as $out) {
                                                                    $totalIndikator += count($out['indikators'] ?? []);
                                                                }
                                                                
                                                                // Jika tidak ada indikator sama sekali
                                                                if ($totalIndikator == 0) {
                                                                    ?>
                                                                    <tr class="row-program border-program">
                                                                        <td class="text-left level-program" style="padding-left:45px;">
                                                                            <?php if (!empty($program['kode_program'])) { ?>
                                                                                <span class="badge-program"><?= html_escape($program['kode_program']) ?></span>
                                                                            <?php } ?>
                                                                            <span class="nama-program"><?= html_escape($program['nama_program']) ?></span>
                                                                        </td>
                                                                        <td colspan="13" style="text-align:center; color:#999;">Tidak ada outcome/indikator</td>
                                                                        <td><span class="badge-empty">-</span></td>
                                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                            <td class="col-aksi">
                                                                                <div class="btn-group-aksi">
                                                                                    <button class="btn btn-sm btn-success btn-aksi BtnEditProgram" data-id="<?= $program['id'] ?>" data-bidang-id="<?= $bidang['id'] ?>" data-kode="<?= html_escape($program['kode_program'] ?? '') ?>" data-nama="<?= html_escape($program['nama_program']) ?>" title="Edit Program"><i class="notika-icon notika-edit"></i></button>
                                                                                    <button class="btn btn-sm btn-danger btn-aksi BtnHapusProgram" data-id="<?= $program['id'] ?>" title="Hapus Program"><i class="notika-icon notika-trash"></i></button>
                                                                                </div>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php
                                                                    continue;
                                                                }
                                                                
                                                                // Tampilkan PROGRAM hanya sekali (baris pertama)
                                                                $isFirstOutcome = true;
                                                                
                                                                // Looping outcomes
                                                                foreach ($outcomes as $outIndex => $outcome) {
                                                                    $indikators = $outcome['indikators'] ?? [];
                                                                    if (empty($indikators)) continue;
                                                                    
                                                                    // Ambil PD dari indikator pertama di outcome ini
                                                                    $firstIndikator = $indikators[0];
                                                                    $pdNama = !empty($firstIndikator['perangkat_daerah_nama']) ? $firstIndikator['perangkat_daerah_nama'] : '-';
                                                                    $pdId = !empty($firstIndikator['perangkat_daerah_id']) ? $firstIndikator['perangkat_daerah_id'] : '';
                                                                    
                                                                    // Hitung rowspan untuk outcome ini = jumlah indikator dalam outcome ini
                                                                    $outcomeRowspan = count($indikators);
                                                                    
                                                                    // Tampilkan baris OUTCOME + INDIKATOR PERTAMA
                                                                    ?>
                                                                    <tr class="row-outcome border-outcome">
                                                                        <td class="text-left program-outcome-cell" style="padding-left:45px;">
                                                                            <?php if ($isFirstOutcome) { ?>
                                                                                <!-- Tampilkan Program hanya di baris outcome pertama -->
                                                                                <?php if (!empty($program['kode_program'])) { ?>
                                                                                    <span class="badge-program-sm"><?= html_escape($program['kode_program']) ?></span>
                                                                                <?php } ?>
                                                                                <span class="program-name"><?= html_escape($program['nama_program']) ?></span>
                                                                            <?php } ?>
                                                                            <!-- Tampilkan Outcome di bawah Program -->
                                                                            <span class="outcome-name">
                                                                                <span class="badge-outcome-sm">Outcome <?= $outIndex+1 ?></span>
                                                                                <?= html_escape($outcome['outcome_text']) ?>
                                                                            </span>
                                                                        </td>
                                                                        
                                                                        <!-- Kolom INDIKATOR PERTAMA -->
                                                                        <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                            <span class="badge-indikator-sm">Indikator 1</span>
                                                                            <?= html_escape($firstIndikator['indikator'] ?? '-') ?>
                                                                        </td>
                                                                        <td><?= html_escape($firstIndikator['satuan'] ?? '-') ?></td>
                                                                        <td><?= html_escape($firstIndikator['kondisi_awal'] ?? '-') ?></td>
                                                                        <td><?= html_escape($firstIndikator['target_2026'] ?? '-') ?></td>
                                                                        <td class="pagu-col"><?= !empty($firstIndikator['pagu_2026']) ? number_format($firstIndikator['pagu_2026'],0,',','.') : '-' ?></td>
                                                                        <td><?= html_escape($firstIndikator['target_2027'] ?? '-') ?></td>
                                                                        <td class="pagu-col"><?= !empty($firstIndikator['pagu_2027']) ? number_format($firstIndikator['pagu_2027'],0,',','.') : '-' ?></td>
                                                                        <td><?= html_escape($firstIndikator['target_2028'] ?? '-') ?></td>
                                                                        <td class="pagu-col"><?= !empty($firstIndikator['pagu_2028']) ? number_format($firstIndikator['pagu_2028'],0,',','.') : '-' ?></td>
                                                                        <td><?= html_escape($firstIndikator['target_2029'] ?? '-') ?></td>
                                                                        <td class="pagu-col"><?= !empty($firstIndikator['pagu_2029']) ? number_format($firstIndikator['pagu_2029'],0,',','.') : '-' ?></td>
                                                                        <td><?= html_escape($firstIndikator['target_2030'] ?? '-') ?></td>
                                                                        <td class="pagu-col"><?= !empty($firstIndikator['pagu_2030']) ? number_format($firstIndikator['pagu_2030'],0,',','.') : '-' ?></td>
                                                                        
                                                                        <!-- PERANGKAT DAERAH - HANYA 1 PER OUTCOME (ROWSPAN) -->
                                                                        <td class="pd-col" rowspan="<?= $outcomeRowspan ?>">
                                                                            <?php if (!empty($pdNama)) { ?>
                                                                                <span class="badge-pd" data-pd-id="<?= $pdId ?>"><?= html_escape($pdNama) ?></span>
                                                                            <?php } else { ?>
                                                                                <span class="badge-empty">-</span>
                                                                            <?php } ?>
                                                                        </td>
                                                                        
                                                                        <!-- AKSI - HANYA DI OUTCOME PERTAMA (ROWSPAN) -->
                                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                            <?php if ($isFirstOutcome) { ?>
                                                                                <td class="col-aksi" rowspan="<?= $totalIndikator ?>">
                                                                                    <div class="btn-group-aksi">
                                                                                        <button class="btn btn-sm btn-success btn-aksi BtnEditProgram" data-id="<?= $program['id'] ?>" data-bidang-id="<?= $bidang['id'] ?>" data-kode="<?= html_escape($program['kode_program'] ?? '') ?>" data-nama="<?= html_escape($program['nama_program']) ?>" title="Edit Program"><i class="notika-icon notika-edit"></i></button>
                                                                                        <button class="btn btn-sm btn-danger btn-aksi BtnHapusProgram" data-id="<?= $program['id'] ?>" title="Hapus Program"><i class="notika-icon notika-trash"></i></button>
                                                                                    </div>
                                                                                </td>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    
                                                                    <?php
                                                                    // Tampilkan sisa indikator dari outcome ini (jika ada) - TANPA PERANGKAT DAERAH
                                                                    if (count($indikators) > 1) {
                                                                        for ($i = 1; $i < count($indikators); $i++) {
                                                                            $indikator = $indikators[$i];
                                                                            ?>
                                                                            <tr class="row-indikator border-indikator">
                                                                                <td class="text-left" style="padding-left:65px;">
                                                                                    <!-- Kosongkan kolom program/outcome untuk indikator tambahan -->
                                                                                </td>
                                                                                
                                                                                <!-- Kolom INDIKATOR -->
                                                                                <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                                    <span class="badge-indikator-sm">Indikator <?= $i+1 ?></span>
                                                                                    <?= html_escape($indikator['indikator'] ?? '-') ?>
                                                                                </td>
                                                                                <td><?= html_escape($indikator['satuan'] ?? '-') ?></td>
                                                                                <td><?= html_escape($indikator['kondisi_awal'] ?? '-') ?></td>
                                                                                <td><?= html_escape($indikator['target_2026'] ?? '-') ?></td>
                                                                                <td class="pagu-col"><?= !empty($indikator['pagu_2026']) ? number_format($indikator['pagu_2026'],0,',','.') : '-' ?></td>
                                                                                <td><?= html_escape($indikator['target_2027'] ?? '-') ?></td>
                                                                                <td class="pagu-col"><?= !empty($indikator['pagu_2027']) ? number_format($indikator['pagu_2027'],0,',','.') : '-' ?></td>
                                                                                <td><?= html_escape($indikator['target_2028'] ?? '-') ?></td>
                                                                                <td class="pagu-col"><?= !empty($indikator['pagu_2028']) ? number_format($indikator['pagu_2028'],0,',','.') : '-' ?></td>
                                                                                <td><?= html_escape($indikator['target_2029'] ?? '-') ?></td>
                                                                                <td class="pagu-col"><?= !empty($indikator['pagu_2029']) ? number_format($indikator['pagu_2029'],0,',','.') : '-' ?></td>
                                                                                <td><?= html_escape($indikator['target_2030'] ?? '-') ?></td>
                                                                                <td class="pagu-col"><?= !empty($indikator['pagu_2030']) ? number_format($indikator['pagu_2030'],0,',','.') : '-' ?></td>
                                                                                
                                                                                <!-- KOSONGKAN KOLOM PD (karena rowspan per outcome) -->
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                    $isFirstOutcome = false;
                                                                }
                                                            } // end foreach program
                                                        } // end if hasProgram
                                                    } // end foreach bidang
                                                } // end if hasBidang
                                            } // end foreach urusan
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- ============================================================
        MODAL URUSAN
    ============================================================ -->
    <div class="modal fixed-modal" id="ModalUrusan" role="dialog" style="display:none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><b id="ModalUrusanTitle">Tambah Urusan</b></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="UrusanId">
                    <div class="nomenklatur-container">
                        <div class="breadcrumb-nomenklatur">
                            <span class="badge-path">📁 Pilih Urusan</span>
                            <span id="path_display_urusan">Belum ada yang dipilih</span>
                        </div>
                        <div class="form-group">
                            <label><b>Urusan</b></label>
                            <select class="form-control" id="UrusanKodeSelect">
                                <option value="">-- Pilih Urusan --</option>
                            </select>
                        </div>
                        <div class="nomenklatur-info" id="info_nomenklatur_urusan">
                            <strong>✅ Terpilih:</strong> <span id="selected_nomenklatur_urusan"></span>
                        </div>
                    </div>
                    <div class="btn-group-center">
                        <button class="btn btn-success" id="BtnSimpanUrusan"><b>SIMPAN</b></button>
                        <button type="button" class="btn btn-default btn-batal"><b>BATAL</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
        MODAL BIDANG URUSAN
    ============================================================ -->
    <div class="modal fixed-modal" id="ModalBidangUrusan" role="dialog" style="display:none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><b id="ModalBidangTitle">Tambah Bidang Urusan</b></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="BidangId">
                    <input type="hidden" id="BidangUrusanId">
                    <div class="form-group">
                        <label><b>Urusan</b></label>
                        <input type="text" class="form-control" id="BidangUrusanNama" readonly style="background:#f8f9fa;">
                    </div>
                    <div class="nomenklatur-container">
                        <div class="breadcrumb-nomenklatur">
                            <span class="badge-path">📁 Pilih Bidang Urusan</span>
                            <span id="path_display_bidang">Belum ada yang dipilih</span>
                        </div>
                        <div class="form-group">
                            <label><b>Bidang Urusan</b></label>
                            <select class="form-control" id="BidangKodeSelect">
                                <option value="">-- Pilih Bidang Urusan --</option>
                            </select>
                        </div>
                        <div class="nomenklatur-info" id="info_nomenklatur_bidang">
                            <strong>✅ Terpilih:</strong> <span id="selected_nomenklatur_bidang"></span>
                        </div>
                    </div>
                    <div class="btn-group-center">
                        <button class="btn btn-success" id="BtnSimpanBidang"><b>SIMPAN</b></button>
                        <button type="button" class="btn btn-default btn-batal"><b>BATAL</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
        MODAL PROGRAM + OUTCOME + INDIKATOR
    ============================================================ -->
    <div class="modal fixed-modal" id="ModalProgram" role="dialog" style="display:none;">
        <div class="modal-dialog modal-xl-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><b id="ModalProgramTitle">Tambah Program</b></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="ProgramId">
                    <input type="hidden" id="ProgramBidangId">
                    
                    <div class="alert alert-info" style="padding:10px 15px;">
                        <strong>Bidang Urusan:</strong> <span id="ProgramBidangInfo">-</span>
                    </div>
                    
                    <div class="nomenklatur-container">
                        <div class="breadcrumb-nomenklatur">
                            <span class="badge-path">📁 Pilih Program</span>
                            <span id="path_display_program">Belum ada yang dipilih</span>
                        </div>
                        <div class="form-group">
                            <label><b>Program</b></label>
                            <select class="form-control" id="ProgramKodeSelect">
                                <option value="">-- Pilih Program --</option>
                            </select>
                        </div>
                        <div class="nomenklatur-info" id="info_nomenklatur_program">
                            <strong>✅ Terpilih:</strong> <span id="selected_nomenklatur_program"></span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="form-group">
                        <label><b>OUTCOME & INDIKATOR</b></label>
                        <div id="OutcomeContainer">
                            <!-- Outcome groups akan ditambahkan di sini -->
                        </div>
                        <button type="button" class="btn btn-sm btn-success" id="BtnTambahOutcome">
                            <i class="notika-icon bi-plus-lg"></i> Tambah Outcome
                        </button>
                    </div>
                    
                    <div class="btn-group-center">
                        <button class="btn btn-success" id="BtnSimpanProgram"><b>SIMPAN PROGRAM</b></button>
                        <button type="button" class="btn btn-default btn-batal"><b>BATAL</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>
<script src="../js/main.js"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var counterOutcome = 0;
var counterIndikator = 0;

// ============================================================
// FUNGSI BANTUAN
// ============================================================
function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    return String(text).replace(/&/g, "&amp;").replace(/</g, "&lt;")
        .replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}

function formatRupiah(angka) {
    if (!angka) return '-';
    var num = parseFloat(angka);
    if (isNaN(num)) return '-';
    return 'Rp ' + num.toLocaleString('id-ID');
}

// ============================================================
// NOMENKLATUR CACHE
// ============================================================
var nomenklaturCache = {};

function getNomenklatur(level, parentKode, callback) {
    var cacheKey = 'level' + level + '_' + (parentKode || 'root');
    if (nomenklaturCache[cacheKey]) {
        if (callback) callback(nomenklaturCache[cacheKey]);
        return;
    }
    $.ajax({
        url: BaseURL + "Daerah/getNomenklaturProgramPD",
        type: "POST",
        data: { level: level, parent_kode: parentKode || '', [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            nomenklaturCache[cacheKey] = res;
            if (callback) callback(res);
        },
        error: function() { if (callback) callback([]); }
    });
}

function loadLevelUrusan() {
    var cacheKey = 'level1_root';
    if (nomenklaturCache[cacheKey]) {
        renderUrusanOptions(nomenklaturCache[cacheKey]);
        return;
    }
    getNomenklatur(1, '', function(res) { renderUrusanOptions(res); });
}

function renderUrusanOptions(res) {
    var options = '<option value="">-- Pilih Urusan --</option>';
    if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
            options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
        }
    }
    $('#UrusanKodeSelect').html(options);
}

function loadLevelBidang(kodeUrusan) {
    if (!kodeUrusan) {
        $('#BidangKodeSelect').html('<option value="">-- Pilih Bidang Urusan --</option>');
        $('#path_display_bidang').html('Belum ada yang dipilih');
        $('#info_nomenklatur_bidang').hide();
        return;
    }
    var cacheKey = 'level2_' + kodeUrusan;
    if (nomenklaturCache[cacheKey]) {
        renderBidangOptions(nomenklaturCache[cacheKey]);
        return;
    }
    getNomenklatur(2, kodeUrusan, function(res) { renderBidangOptions(res); });
}

function renderBidangOptions(res) {
    var options = '<option value="">-- Pilih Bidang Urusan --</option>';
    if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
            options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
        }
    }
    $('#BidangKodeSelect').html(options);
    updatePathDisplayBidang();
}

function loadLevelProgram(kodeBidang) {
    if (!kodeBidang) {
        $('#ProgramKodeSelect').html('<option value="">-- Pilih Program --</option>');
        $('#path_display_program').html('Belum ada yang dipilih');
        $('#info_nomenklatur_program').hide();
        return;
    }
    var cacheKey = 'level3_' + kodeBidang;
    if (nomenklaturCache[cacheKey]) {
        renderProgramOptions(nomenklaturCache[cacheKey]);
        return;
    }
    getNomenklatur(3, kodeBidang, function(res) { renderProgramOptions(res); });
}

function renderProgramOptions(res) {
    var options = '<option value="">-- Pilih Program --</option>';
    if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
            options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
        }
    }
    $('#ProgramKodeSelect').html(options);
    updatePathDisplayProgram();
}

function updatePathDisplayUrusan() {
    var val = $('#UrusanKodeSelect').val();
    var text = $('#UrusanKodeSelect option:selected').text();
    if (val && text) {
        var parts = text.split(' - ');
        var nama = parts.length > 1 ? parts.slice(1).join(' - ') : text;
        $('#path_display_urusan').html('Urusan: ' + nama);
        $('#info_nomenklatur_urusan').show();
        $('#selected_nomenklatur_urusan').html('<strong>Kode:</strong> ' + val + ' | <strong>Nama:</strong> ' + nama);
    } else {
        $('#path_display_urusan').html('Belum ada yang dipilih');
        $('#info_nomenklatur_urusan').hide();
    }
}

function updatePathDisplayBidang() {
    var val = $('#BidangKodeSelect').val();
    var text = $('#BidangKodeSelect option:selected').text();
    if (val && text) {
        var parts = text.split(' - ');
        var nama = parts.length > 1 ? parts.slice(1).join(' - ') : text;
        $('#path_display_bidang').html('Bidang: ' + nama);
        $('#info_nomenklatur_bidang').show();
        $('#selected_nomenklatur_bidang').html('<strong>Kode:</strong> ' + val + ' | <strong>Nama:</strong> ' + nama);
    } else {
        $('#path_display_bidang').html('Belum ada yang dipilih');
        $('#info_nomenklatur_bidang').hide();
    }
}

function updatePathDisplayProgram() {
    var val = $('#ProgramKodeSelect').val();
    var text = $('#ProgramKodeSelect option:selected').text();
    if (val && text) {
        var parts = text.split(' - ');
        var nama = parts.length > 1 ? parts.slice(1).join(' - ') : text;
        $('#path_display_program').html('Program: ' + nama);
        $('#info_nomenklatur_program').show();
        $('#selected_nomenklatur_program').html('<strong>Kode:</strong> ' + val + ' | <strong>Nama:</strong> ' + nama);
    } else {
        $('#path_display_program').html('Belum ada yang dipilih');
        $('#info_nomenklatur_program').hide();
    }
}

// ============================================================
// EVENT NOMENKLATUR
// ============================================================
$(document).on('change', '#UrusanKodeSelect', updatePathDisplayUrusan);
$(document).on('change', '#BidangKodeSelect', updatePathDisplayBidang);
$(document).on('change', '#ProgramKodeSelect', updatePathDisplayProgram);

// ============================================================
// FILTER WILAYAH
// ============================================================
<?php if (!isset($_SESSION['KodeWilayah'])) { ?>
$("#Provinsi").change(function() {
    if ($(this).val() === "") { $("#KabKota").html('<option value="">Pilih Kab/Kota</option>'); return; }
    $.ajax({
        url: BaseURL + "Daerah/GetListKabKota",
        type: "POST",
        data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
        beforeSend: function() { $("#KabKota").prop('disabled', true); },
        success: function(res) {
            var Data = (typeof res === 'string') ? JSON.parse(res) : res;
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            if (Data.length > 0) {
                for (let i = 0; i < Data.length; i++) {
                    KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                }
            }
            $("#KabKota").html(KabKota).prop('disabled', false);
        },
        error: function() { $("#KabKota").prop('disabled', false); }
    });
});

$("#Filter").click(function() {
    if ($("#Provinsi").val() === "") { alert("Mohon Pilih Provinsi"); return; }
    if ($("#KabKota").val() === "") { alert("Mohon Pilih Kab/Kota"); return; }
    var kodeWilayah = $("#KabKota").val();
    $.ajax({
        url: BaseURL + "Daerah/SetTempKodeWilayah",
        type: "POST",
        data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
        beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
        success: function(res) { window.location.reload(); },
        error: function() { window.location.reload(); }
    });
});

<?php if (!empty($KodeWilayah)) { ?>
var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
var kodeKab = "<?= $KodeWilayah ?>";
$("#Provinsi").val(kodeProv);
$.ajax({
    url: BaseURL + "Daerah/GetListKabKota",
    type: "POST",
    data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
    success: function(res) {
        var Data = (typeof res === 'string') ? JSON.parse(res) : res;
        var KabKota = '<option value="">Pilih Kab/Kota</option>';
        if (Data.length > 0) {
            for (let i = 0; i < Data.length; i++) {
                var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
            }
        }
        $("#KabKota").html(KabKota);
    }
});
<?php } ?>
<?php } ?>

// ============================================================
// FUNGSI SHOW/HIDE FIXED MODAL
// ============================================================
function showFixedModal(selector) {
    var $modal = $(selector);
    $('.modal-backdrop').remove();
    $modal.css('display', 'flex');
    $modal.addClass('show');
    var $backdrop = $('<div class="modal-backdrop fade in"></div>');
    $('body').append($backdrop);
    $('body').addClass('modal-open');
    $modal.scrollTop(0);
}

function hideFixedModal(selector) {
    var $modal = $(selector);
    $modal.removeClass('show');
    $modal.css('display', 'none');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
}

$(document).on('click', '.modal.fixed-modal .close, .modal.fixed-modal .btn-batal', function(e) {
    e.preventDefault();
    var $modal = $(this).closest('.modal.fixed-modal');
    if ($modal.length) hideFixedModal('#' + $modal.attr('id'));
});

$(document).on('click', '.modal.fixed-modal', function(e) {
    if ($(e.target).hasClass('modal.fixed-modal')) {
        hideFixedModal('#' + $(this).attr('id'));
    }
});

// ============================================================
// CRUD URUSAN
// ============================================================
$('#BtnTambahUrusan').click(function() {
    $('#ModalUrusanTitle').text('Tambah Urusan');
    $('#UrusanId').val('');
    $('#UrusanKodeSelect').val('');
    $('#path_display_urusan').html('Belum ada yang dipilih');
    $('#info_nomenklatur_urusan').hide();
    nomenklaturCache = {};
    loadLevelUrusan();
    showFixedModal('#ModalUrusan');
});

$(document).on('click', '.BtnEditUrusan', function() {
    var id = $(this).data('id');
    var kode = $(this).data('kode');
    var nama = $(this).data('nama');
    $('#ModalUrusanTitle').text('Edit Urusan');
    $('#UrusanId').val(id);
    nomenklaturCache = {};
    loadLevelUrusan();
    setTimeout(function() {
        if (kode) { $('#UrusanKodeSelect').val(kode); updatePathDisplayUrusan(); }
    }, 500);
    showFixedModal('#ModalUrusan');
});

$('#BtnSimpanUrusan').click(function() {
    var id = $('#UrusanId').val();
    var kode = $('#UrusanKodeSelect').val();
    var nama = $('#UrusanKodeSelect option:selected').text().split(' - ').slice(1).join(' - ');
    if (!kode) { alert('Urusan harus dipilih!'); return; }
    if (!nama) { alert('Nama Urusan tidak valid!'); return; }
    var url = id ? BaseURL + "Daerah/program_edit_urusan" : BaseURL + "Daerah/program_input_urusan";
    var data = { id: id, kode_urusan: kode, nama_urusan: nama, [CSRF_NAME]: CSRF_TOKEN };
    $('#BtnSimpanUrusan').prop('disabled', true).text('MENYIMPAN...');
    $.post(url, data)
        .done(function(res) {
            try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
            if (result.status === 'success') { hideFixedModal('#ModalUrusan'); window.location.reload(); }
            else { alert(result.message || 'Gagal menyimpan!'); $('#BtnSimpanUrusan').prop('disabled', false).text('SIMPAN'); }
        })
        .fail(function() { alert('Terjadi kesalahan!'); $('#BtnSimpanUrusan').prop('disabled', false).text('SIMPAN'); });
});

$(document).on('click', '.BtnHapusUrusan', function() {
    if (!confirm('Yakin ingin menghapus Urusan ini?')) return;
    var id = $(this).data('id');
    $.post(BaseURL + "Daerah/program_hapus_urusan", { id: id, [CSRF_NAME]: CSRF_TOKEN })
        .done(function(res) {
            try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
            if (result.status === 'success') { window.location.reload(); } else { alert(result.message || 'Gagal menghapus!'); }
        })
        .fail(function() { alert('Terjadi kesalahan!'); });
});

// ============================================================
// CRUD BIDANG URUSAN
// ============================================================
$(document).on('click', '.BtnTambahBidang', function() {
    var urusanId = $(this).data('urusan-id');
    var kodeUrusan = $(this).data('kode-urusan');
    var namaUrusan = $(this).data('nama-urusan');
    $('#ModalBidangTitle').text('Tambah Bidang Urusan');
    $('#BidangId').val('');
    $('#BidangUrusanId').val(urusanId);
    $('#BidangUrusanNama').val(kodeUrusan + ' - ' + namaUrusan);
    $('#BidangKodeSelect').val('');
    $('#path_display_bidang').html('Belum ada yang dipilih');
    $('#info_nomenklatur_bidang').hide();
    nomenklaturCache = {};
    loadLevelBidang(kodeUrusan);
    showFixedModal('#ModalBidangUrusan');
});

$(document).on('click', '.BtnEditBidang', function() {
    var id = $(this).data('id');
    var urusanId = $(this).data('urusan-id');
    var kode = $(this).data('kode');
    var nama = $(this).data('nama');
    $('#ModalBidangTitle').text('Edit Bidang Urusan');
    $('#BidangId').val(id);
    $('#BidangUrusanId').val(urusanId);
    $.ajax({
        url: BaseURL + "Daerah/program_get_urusan_by_id",
        type: "POST",
        data: { id: urusanId, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success' && res.data) {
                var urusanKode = res.data.kode_urusan || '';
                var urusanNama = res.data.nama_urusan || '';
                $('#BidangUrusanNama').val(urusanKode + ' - ' + urusanNama);
                nomenklaturCache = {};
                loadLevelBidang(urusanKode);
                setTimeout(function() {
                    if (kode) { $('#BidangKodeSelect').val(kode); updatePathDisplayBidang(); }
                }, 500);
            }
        }
    });
    showFixedModal('#ModalBidangUrusan');
});

$('#BtnSimpanBidang').click(function() {
    var id = $('#BidangId').val();
    var urusanId = $('#BidangUrusanId').val();
    var kode = $('#BidangKodeSelect').val();
    var nama = $('#BidangKodeSelect option:selected').text().split(' - ').slice(1).join(' - ');
    if (!kode) { alert('Bidang Urusan harus dipilih!'); return; }
    if (!nama) { alert('Nama Bidang tidak valid!'); return; }
    var url = id ? BaseURL + "Daerah/program_edit_bidang_urusan" : BaseURL + "Daerah/program_input_bidang_urusan";
    var data = { id: id, urusan_id: urusanId, kode_bidang: kode, nama_bidang: nama, [CSRF_NAME]: CSRF_TOKEN };
    $('#BtnSimpanBidang').prop('disabled', true).text('MENYIMPAN...');
    $.post(url, data)
        .done(function(res) {
            try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
            if (result.status === 'success') { hideFixedModal('#ModalBidangUrusan'); window.location.reload(); }
            else { alert(result.message || 'Gagal menyimpan!'); $('#BtnSimpanBidang').prop('disabled', false).text('SIMPAN'); }
        })
        .fail(function() { alert('Terjadi kesalahan!'); $('#BtnSimpanBidang').prop('disabled', false).text('SIMPAN'); });
});

$(document).on('click', '.BtnHapusBidang', function() {
    if (!confirm('Yakin ingin menghapus Bidang ini?')) return;
    var id = $(this).data('id');
    $.post(BaseURL + "Daerah/program_hapus_bidang_urusan", { id: id, [CSRF_NAME]: CSRF_TOKEN })
        .done(function(res) {
            try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
            if (result.status === 'success') { window.location.reload(); } else { alert(result.message || 'Gagal menghapus!'); }
        })
        .fail(function() { alert('Terjadi kesalahan!'); });
});

// ============================================================
// FUNGSI OUTCOME & INDIKATOR DI MODAL
// ============================================================

function addOutcome(data) {
    var id = data && data.id ? data.id : '';
    var text = data && data.outcome_text ? escapeHtml(data.outcome_text) : '';
    var indikators = data && data.indikators ? data.indikators : [];
    var counter = counterOutcome++;
    var html = '<div class="outcome-group" id="outcome_group_' + counter + '">';
    html += '<input type="hidden" class="outcome-id" value="' + id + '">';
    html += '<button type="button" class="btn btn-danger btn-sm btn-remove-outcome" data-group="' + counter + '" title="Hapus Outcome">×</button>';
    html += '<div class="form-group">';
    html += '<label><b>Outcome</b></label>';
    html += '<textarea class="form-control outcome-textarea" id="outcome_text_' + counter + '" rows="2" placeholder="Tulis Outcome Program">' + text + '</textarea>';
    html += '</div>';
    html += '<div class="indikator-list" id="indikator_list_' + counter + '">';
    // Tambahkan indikator
    if (indikators.length > 0) {
        for (var i = 0; i < indikators.length; i++) {
            html += generateIndikatorRow(counter, indikators[i]);
        }
    } else {
        html += generateIndikatorRow(counter, null);
    }
    html += '</div>';
    html += '<button type="button" class="btn btn-sm btn-primary tambah-indikator" data-group="' + counter + '"><i class="notika-icon bi-plus-lg"></i> Tambah Indikator</button>';
    html += '</div>';
    $('#OutcomeContainer').append(html);
    initPaguInputs();
}

function generateIndikatorRow(groupId, data) {
    var id = data && data.id ? data.id : '';
    var indikator = data && data.indikator ? escapeHtml(data.indikator) : '';
    var satuan = data && data.satuan ? escapeHtml(data.satuan) : '';
    var kondisiAwal = data && data.kondisi_awal ? escapeHtml(data.kondisi_awal) : '';
    var target2026 = data && data.target_2026 ? escapeHtml(data.target_2026) : '';
    var pagu2026 = data && data.pagu_2026 ? data.pagu_2026 : '';
    var pagu2026Formatted = pagu2026 ? pagu2026.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '';
    var target2027 = data && data.target_2027 ? escapeHtml(data.target_2027) : '';
    var pagu2027 = data && data.pagu_2027 ? data.pagu_2027 : '';
    var pagu2027Formatted = pagu2027 ? pagu2027.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '';
    var target2028 = data && data.target_2028 ? escapeHtml(data.target_2028) : '';
    var pagu2028 = data && data.pagu_2028 ? data.pagu_2028 : '';
    var pagu2028Formatted = pagu2028 ? pagu2028.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '';
    var target2029 = data && data.target_2029 ? escapeHtml(data.target_2029) : '';
    var pagu2029 = data && data.pagu_2029 ? data.pagu_2029 : '';
    var pagu2029Formatted = pagu2029 ? pagu2029.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '';
    var target2030 = data && data.target_2030 ? escapeHtml(data.target_2030) : '';
    var pagu2030 = data && data.pagu_2030 ? data.pagu_2030 : '';
    var pagu2030Formatted = pagu2030 ? pagu2030.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '';
    var pdId = data && data.perangkat_daerah_id ? data.perangkat_daerah_id : '';
    
    var counter = counterIndikator++;
    var html = '<div class="indikator-row" id="indikator_row_' + counter + '">';
    html += '<input type="hidden" class="indikator-id" value="' + id + '">';
    html += '<button type="button" class="btn btn-danger btn-sm btn-remove-indikator" data-row="' + counter + '" title="Hapus Indikator">×</button>';
    html += '<div class="row">';
    html += '<div class="col-md-12"><div class="form-group"><label>Indikator</label><textarea class="form-control form-control-sm indikator-textarea" id="indikator_' + counter + '" rows="2">' + indikator + '</textarea></div></div>';
    html += '</div>';
    html += '<div class="row">';
    html += '<div class="col-md-6"><div class="form-group"><label>Satuan</label><input type="text" class="form-control form-control-sm satuan-input" id="satuan_' + counter + '" value="' + satuan + '"></div></div>';
    html += '<div class="col-md-6"><div class="form-group"><label>Kondisi Awal</label><input type="text" class="form-control form-control-sm kondisi-input" id="kondisi_awal_' + counter + '" value="' + kondisiAwal + '"></div></div>';
    html += '</div>';
    html += '<div class="row">';
    var years = ['2026','2027','2028','2029','2030'];
    var targetVals = [target2026, target2027, target2028, target2029, target2030];
    var paguFormatted = [pagu2026Formatted, pagu2027Formatted, pagu2028Formatted, pagu2029Formatted, pagu2030Formatted];
    for (var y = 0; y < years.length; y++) {
        html += '<div class="col-md-2"><div class="form-group"><label style="font-size:11px; color:#007bff;">' + years[y] + '</label><div class="row"><div class="col-xs-6" style="padding-right:3px;"><input type="text" class="form-control form-control-sm target-input" id="target_' + years[y] + '_' + counter + '" placeholder="Target" value="' + targetVals[y] + '"></div><div class="col-xs-6" style="padding-left:3px;"><input type="text" class="form-control form-control-sm pagu-input" id="pagu_' + years[y] + '_' + counter + '" placeholder="Pagu" value="' + paguFormatted[y] + '"></div></div></div></div>';
    }
    html += '</div>';
    html += '<div class="row">';
    html += '<div class="col-md-6"><div class="form-group"><label>Perangkat Daerah</label><select class="form-control form-control-sm pd-select" id="perangkat_daerah_' + counter + '"><option value="">-- Pilih Perangkat Daerah --</option>';
    <?php foreach ($PerangkatDaerah as $pd) { ?>
    html += '<option value="<?= $pd['id'] ?>" ' + (pdId == <?= $pd['id'] ?> ? 'selected' : '') + '><?= html_escape($pd['nama']) ?></option>';
    <?php } ?>
    html += '</select></div></div></div>';
    html += '</div>';
    return html;
}

function initPaguInputs() {
    $('.pagu-input').off('keyup').on('keyup', function() {
        var val = $(this).val().replace(/[^0-9]/g, '');
        if (val) { $(this).val(val.replace(/\B(?=(\d{3})+(?!\d))/g, ".")); }
    });
}

// Tambah Outcome
$('#BtnTambahOutcome').click(function() {
    addOutcome({ indikators: [] });
});

// Tambah Indikator per Outcome
$(document).on('click', '.tambah-indikator', function() {
    var groupId = $(this).data('group');
    var listId = '#indikator_list_' + groupId;
    $(listId).append(generateIndikatorRow(groupId, null));
    initPaguInputs();
});

// Hapus Outcome
$(document).on('click', '.btn-remove-outcome', function() {
    if (!confirm('Hapus Outcome ini beserta semua indikatornya?')) return;
    var group = $(this).data('group');
    $('#outcome_group_' + group).remove();
});

// Hapus Indikator
$(document).on('click', '.btn-remove-indikator', function() {
    if (!confirm('Hapus indikator ini?')) return;
    var row = $(this).data('row');
    $('#indikator_row_' + row).remove();
});

// ============================================================
// CRUD PROGRAM + OUTCOME + INDIKATOR
// ============================================================

$(document).on('click', '.BtnTambahProgram', function() {
    var bidangId = $(this).data('bidang-id');
    var kodeBidang = $(this).data('kode-bidang');
    var namaBidang = $(this).data('nama-bidang');
    $('#ModalProgramTitle').text('Tambah Program');
    $('#ProgramId').val('');
    $('#ProgramBidangId').val(bidangId);
    $('#ProgramBidangInfo').text(kodeBidang + ' - ' + namaBidang);
    $('#ProgramKodeSelect').val('');
    $('#path_display_program').html('Belum ada yang dipilih');
    $('#info_nomenklatur_program').hide();
    $('#OutcomeContainer').html('');
    counterOutcome = 0;
    counterIndikator = 0;
    nomenklaturCache = {};
    loadLevelProgram(kodeBidang);
    showFixedModal('#ModalProgram');
});

$(document).on('click', '.BtnEditProgram', function() {
    var id = $(this).data('id');
    var bidangId = $(this).data('bidang-id');
    var kode = $(this).data('kode');
    var nama = $(this).data('nama');
    $('#ModalProgramTitle').text('Edit Program');
    $('#ProgramId').val(id);
    $('#ProgramBidangId').val(bidangId);
    $('#OutcomeContainer').html('');
    counterOutcome = 0;
    counterIndikator = 0;
    
    // Ambil data program lengkap
    $.ajax({
        url: BaseURL + "Daerah/program_get_by_id",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success' && res.data) {
                var program = res.data;
                $('#ProgramBidangInfo').text((program.kode_bidang || '') + ' - ' + (program.nama_bidang || ''));
                // Load program select
                nomenklaturCache = {};
                loadLevelProgram(program.kode_bidang || '');
                setTimeout(function() {
                    if (program.kode_program) {
                        $('#ProgramKodeSelect').val(program.kode_program);
                        updatePathDisplayProgram();
                    }
                }, 500);
                // Load outcomes
                if (program.outcomes && program.outcomes.length > 0) {
                    for (var i = 0; i < program.outcomes.length; i++) {
                        addOutcome(program.outcomes[i]);
                    }
                } else {
                    addOutcome({ indikators: [] });
                }
            }
        },
        error: function() { alert('Gagal memuat data program!'); }
    });
    showFixedModal('#ModalProgram');
});

$('#BtnSimpanProgram').click(function() {
    var id = $('#ProgramId').val();
    var bidangId = $('#ProgramBidangId').val();
    var kode = $('#ProgramKodeSelect').val();
    var nama = $('#ProgramKodeSelect option:selected').text().split(' - ').slice(1).join(' - ');
    if (!kode) { alert('Program harus dipilih!'); return; }
    if (!nama) { alert('Nama Program tidak valid!'); return; }
    
    // Kumpulkan data outcomes
    var outcomes = [];
    var hasError = false;
    $('.outcome-group').each(function() {
        var group = $(this);
        var outcomeId = group.find('.outcome-id').val();
        var outcomeText = group.find('.outcome-textarea').val().trim();
        if (!outcomeText) {
            hasError = true;
            alert('Outcome tidak boleh kosong!');
            return false;
        }
        var indikators = [];
        group.find('.indikator-row').each(function() {
            var row = $(this);
            var indId = row.find('.indikator-id').val();
            var indText = row.find('.indikator-textarea').val().trim();
            if (!indText) {
                hasError = true;
                alert('Indikator tidak boleh kosong!');
                return false;
            }
            var satuan = row.find('.satuan-input').val().trim();
            var kondisi = row.find('.kondisi-input').val().trim();
            var target2026 = row.find('#target_2026_' + row.attr('id').replace('indikator_row_', '')).val().trim();
            var pagu2026 = row.find('#pagu_2026_' + row.attr('id').replace('indikator_row_', '')).val().replace(/\./g, '');
            var target2027 = row.find('#target_2027_' + row.attr('id').replace('indikator_row_', '')).val().trim();
            var pagu2027 = row.find('#pagu_2027_' + row.attr('id').replace('indikator_row_', '')).val().replace(/\./g, '');
            var target2028 = row.find('#target_2028_' + row.attr('id').replace('indikator_row_', '')).val().trim();
            var pagu2028 = row.find('#pagu_2028_' + row.attr('id').replace('indikator_row_', '')).val().replace(/\./g, '');
            var target2029 = row.find('#target_2029_' + row.attr('id').replace('indikator_row_', '')).val().trim();
            var pagu2029 = row.find('#pagu_2029_' + row.attr('id').replace('indikator_row_', '')).val().replace(/\./g, '');
            var target2030 = row.find('#target_2030_' + row.attr('id').replace('indikator_row_', '')).val().trim();
            var pagu2030 = row.find('#pagu_2030_' + row.attr('id').replace('indikator_row_', '')).val().replace(/\./g, '');
            var pdId = row.find('.pd-select').val();
            
            indikators.push({
                id: indId,
                indikator: indText,
                satuan: satuan,
                kondisi_awal: kondisi,
                target_2026: target2026,
                pagu_2026: pagu2026 || null,
                target_2027: target2027,
                pagu_2027: pagu2027 || null,
                target_2028: target2028,
                pagu_2028: pagu2028 || null,
                target_2029: target2029,
                pagu_2029: pagu2029 || null,
                target_2030: target2030,
                pagu_2030: pagu2030 || null,
                perangkat_daerah_id: pdId || null
            });
        });
        if (hasError) return false;
        outcomes.push({
            id: outcomeId,
            outcome_text: outcomeText,
            indikators: indikators
        });
    });
    
    if (hasError) return;
    
    // Cek apakah ada outcome dengan indikator
    var totalInd = 0;
    for (var oi = 0; oi < outcomes.length; oi++) {
        totalInd += outcomes[oi].indikators.length;
    }
    if (totalInd === 0) {
        alert('Minimal tambahkan 1 Indikator!');
        return;
    }
    
    var url = id ? BaseURL + "Daerah/program_edit_program" : BaseURL + "Daerah/program_input_program";
    var data = {
        id: id,
        bidang_urusan_id: bidangId,
        kode_program: kode,
        nama_program: nama,
        outcomes: outcomes,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $('#BtnSimpanProgram').prop('disabled', true).text('MENYIMPAN...');
    $.post(url, data)
        .done(function(res) {
            try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
            if (result.status === 'success') {
                hideFixedModal('#ModalProgram');
                window.location.reload();
            } else {
                alert(result.message || 'Gagal menyimpan!');
                $('#BtnSimpanProgram').prop('disabled', false).text('SIMPAN PROGRAM');
            }
        })
        .fail(function() {
            alert('Terjadi kesalahan!');
            $('#BtnSimpanProgram').prop('disabled', false).text('SIMPAN PROGRAM');
        });
});

// ============================================================
// HAPUS PROGRAM
// ============================================================
$(document).on('click', '.BtnHapusProgram', function() {
    if (!confirm('Yakin ingin menghapus Program ini beserta semua Outcome dan Indikator?')) return;
    var id = $(this).data('id');
    $.post(BaseURL + "Daerah/program_hapus_program", { id: id, [CSRF_NAME]: CSRF_TOKEN })
        .done(function(res) {
            try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
            if (result.status === 'success') { window.location.reload(); } else { alert(result.message || 'Gagal menghapus!'); }
        })
        .fail(function() { alert('Terjadi kesalahan!'); });
});

// ============================================================
// RESET MODAL
// ============================================================
$(document).on('hidden.bs.modal', '.modal.fixed-modal', function() {
    $('#BtnSimpanUrusan').prop('disabled', false).text('SIMPAN');
    $('#BtnSimpanBidang').prop('disabled', false).text('SIMPAN');
    $('#BtnSimpanProgram').prop('disabled', false).text('SIMPAN PROGRAM');
    nomenklaturCache = {};
});

$(document).ready(function() {
    console.log('ProgramPD ready - Mendukung Multiple Outcome & Indikator');
});
</script>

</body>
</html>