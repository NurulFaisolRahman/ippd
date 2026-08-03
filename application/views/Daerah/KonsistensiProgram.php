<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    /* ============================================================
       FILTER & FORM STYLE
       ============================================================ */
    .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
    .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
    .filter-group label { font-size:14px; margin-bottom:5px; }
    .filter-select { width:260px; font-size:14px; padding:5px 8px; }
    
    /* ============================================================
       NOMENKLATUR STYLE
       ============================================================ */
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
    
    /* ============================================================
       PAGU INPUT - HANYA 1
       ============================================================ */
    .pagu-input-group {
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 4px;
        border-left: 3px solid #28a745;
        margin-top: 10px;
    }
    .pagu-input-group .pagu-label {
        font-weight: 600;
        font-size: 13px;
        color: #155724;
        display: inline-block;
        min-width: 130px;
    }
    .pagu-input-group .pagu-input {
        display: inline-block;
        width: 250px;
    }
    .pagu-input-group .pagu-input input {
        height: 34px;
        font-size: 13px;
        padding: 4px 10px;
    }
    
    /* ============================================================
       MANUAL INPUT STYLE
       ============================================================ */
    .manual-input-group {
        margin-top: 15px;
        padding: 15px;
        background: #fafafa;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
    }
    .manual-input-group .panel-heading {
        background: #f8f9fa;
        padding: 8px 15px;
        border-bottom: 1px solid #dee2e6;
        margin: -15px -15px 15px -15px;
        border-radius: 4px 4px 0 0;
        font-weight: 600;
        font-size: 14px;
    }
    
    /* ============================================================
       INDIKATOR ROW
       ============================================================ */
    .indikator-row {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        border: 1px solid #e9ecef;
    }
    .indikator-row .btn {
        margin-top: 5px;
    }
    
    /* ============================================================
       TABEL STYLE - HIRARKI
       ============================================================ */
    .table-konsistensi th {
        background: #f8f9fa;
        font-weight: 600;
        font-size: 11px;
        text-align: center;
        vertical-align: middle;
        padding: 6px 4px;
        border: 1px solid #dee2e6;
    }
    .table-konsistensi td {
        vertical-align: middle;
        font-size: 12px;
        padding: 6px 8px;
        border: 1px solid #dee2e6;
    }
    
    /* Hirarki Level */
    .level-1 {
        background-color: #e8f0fe;
        font-weight: 700;
        font-size: 14px;
        color: #1a5276;
    }
    .level-2 {
        background-color: #f0f8ff;
        font-weight: 600;
        font-size: 13px;
        color: #0c5460;
        padding-left: 30px !important;
    }
    .level-3 {
        background-color: #ffffff;
        font-weight: 400;
        font-size: 12px;
        color: #495057;
        padding-left: 55px !important;
    }
    
    .level-1 .text-pagu { font-weight: 700; font-size: 14px; color: #1a5276; }
    .level-2 .text-pagu { font-weight: 600; font-size: 13px; color: #0c5460; }
    .level-3 .text-pagu { font-weight: 500; font-size: 12px; color: #155724; }
    
    .level-1 .row-label { font-weight: 700; color: #1a5276; }
    .level-2 .row-label { font-weight: 600; color: #0c5460; padding-left: 15px; }
    .level-3 .row-label { font-weight: 400; color: #495057; padding-left: 30px; }
    
    .pagu-display {
        padding: 2px 8px;
        border-radius: 4px;
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
    }
    .pagu-display-rpjmd { background: #d4edda; color: #155724; }
    .pagu-display-rkpd { background: #fff3cd; color: #856404; }
    .pagu-display-total { background: #e8daef; color: #6c3483; }
    
    .text-danger { color: #dc3545; }
    .text-success { color: #28a745; }
    .text-muted { color: #6c757d; }
    
    .badge-kode {
        background: #e9ecef;
        color: #495057;
        font-size: 9px;
        padding: 2px 8px;
        border-radius: 10px;
        font-weight: normal;
    }
    .badge-selisih {
        background: #f8d7da;
        color: #721c24;
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 12px;
        font-weight: 600;
    }
    .badge-selisih-plus {
        background: #d4edda;
        color: #155724;
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
    
    .btn-group-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        flex-wrap: nowrap;
    }
    
    /* ============================================================
       MODAL POSITION - DI ATAS HEADER
       ============================================================ */
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
    .modal-lg-custom {
        max-width: 95%;
        width: 95%;
    }
    
    .preview-field { display: none; }
    
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
    
    /* Expand/Collapse */
    .toggle-detail {
        cursor: pointer;
        color: #007bff;
        font-size: 12px;
        margin-left: 5px;
    }
    .toggle-detail:hover {
        text-decoration: underline;
    }
    .detail-indikator {
        display: none;
        padding: 5px 0 5px 15px;
    }
    .detail-indikator.show {
        display: block;
    }
    .detail-indikator .ind-item {
        padding: 3px 0;
        border-bottom: 1px dashed #e9ecef;
        font-size: 11px;
    }
    .detail-indikator .ind-item:last-child {
        border-bottom: none;
    }
    
    /* No Hirarki */
    .no-hirarki {
        font-weight: 600;
        font-size: 12px;
    }
    .no-hirarki .no-urusan { color: #1a5276; }
    .no-hirarki .no-bidang { color: #0c5460; padding-left: 5px; }
    .no-hirarki .no-program { color: #155724; padding-left: 10px; }
    
    /* Loading */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.8);
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    .loading-overlay.show {
        display: flex;
    }
    .loading-spinner {
        font-size: 24px;
        color: #007bff;
    }
    
    @media (max-width: 768px) {
        .filter-row { flex-direction: column; gap: 15px; }
        .filter-select { width: 100%; }
        .modal-lg-custom { max-width: 98%; width: 98%; }
        .table-konsistensi td { font-size: 10px; padding: 4px 4px; }
        .level-2 { padding-left: 15px !important; }
        .level-3 { padding-left: 30px !important; }
        .pagu-input-group .pagu-input { width: 100%; }
        .pagu-input-group .pagu-label { display: block; min-width: auto; }
        .modal.fixed-modal .modal-dialog { margin: 10px auto; }
    }
</style>

<!-- Loading Overlay -->
<div class="loading-overlay" id="LoadingOverlay">
    <div class="loading-spinner">
        <i class="fa fa-spinner fa-spin fa-3x"></i>
        <p style="margin-top:15px;">Memuat data...</p>
    </div>
</div>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">

            <!-- ============================================================
            FILTER WILAYAH
            ============================================================ -->
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
                                <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                          <label for="TahunFilter"><b>Tahun</b></label>
                          <select class="form-control filter-select" id="TahunFilter">
                            <option value="">-- Semua Tahun --</option>
                            <?php 
                            $currentYear = date('Y');
                            for ($y = $currentYear; $y >= $currentYear - 10; $y--) { ?>
                              <option value="<?= $y ?>" <?= ($TahunAktif == $y) ? 'selected' : '' ?>>
                                <?= $y ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="filter-group" style="margin-top: 28px;">
                          <button class="btn btn-primary notika-btn-primary btn-block" id="FilterBtn">
                            <b>Filter</b>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if (!empty($KodeWilayah)) { ?>
              <div class="alert alert-info" style="margin-bottom: 20px;">
                <strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah) ?>
                <?php 
                $filter_instansi = $this->input->get('instansi_id', TRUE);
                if (!empty($filter_instansi)) { 
                  $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi)->get()->row_array();
                ?>
                  <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                <?php } ?>
                <br><strong>Tahun:</strong> <?= htmlspecialchars($TahunAktif) ?>
              </div>
            <?php } ?>

            <!-- ============================================================
            TOMBOL TAMBAH
            ============================================================ -->
            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                <button type="button"
                        class="btn btn-success notika-btn-success"
                        id="BtnTambahKonsistensi">
                  <i class="notika-icon bi-plus-lg"></i> <b>Tambah Konsistensi Program</b>
                </button>
                <?php } ?>
              </div>
            </div>
            <br>

            <!-- ============================================================
TABEL DATA - HIRARKI 3 LEVEL DENGAN NOMOR ASLI NOMENKLATUR
============================================================ -->
<div class="table-responsive">
  <table id="data-table-konsistensi" class="table table-striped table-bordered table-konsistensi">
    <thead>
      <tr>
        <th style="width:60px; text-align:center;">No</th>
        <th style="width:200px; text-align:center;">URUSAN/PROGRAM RPJMD</th>
        <th style="width:180px; text-align:center;">INDIKATOR</th>
        <th style="width:150px; text-align:center;">TARGET DAN SATUAN</th>
        <th style="width:150px; text-align:center;">PAGU PROGRAM</th>
        <th style="width:200px; text-align:center;">URUSAN/PROGRAM RKPD</th>
        <th style="width:180px; text-align:center;">INDIKATOR</th>
        <th style="width:150px; text-align:center;">PAGU PROGRAM</th>
        <th style="width:130px; text-align:center;">SELISIH</th>
        <th style="width:120px; text-align:center;">KETERANGAN</th>
        <th style="width:140px; text-align:center;">PERANGKAT DAERAH</th>
        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
        <th style="width:80px; text-align:center;">AKSI</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
    <?php if (!empty($KonsistensiData)) { ?>
    <?php 
    // Inisialisasi counter untuk urutan
    $urusanCounter = 0;
    $bidangCounter = [];
    $programCounter = [];
    $currentUrusan = '';
    
    foreach ($KonsistensiData as $row) { 
      // Tentukan level
      $hasProgram = !empty($row['program_rpjmd_kode']) || !empty($row['program_rpjmd_text']);
      $hasBidang = !empty($row['bidang_urusan_rpjmd_kode']);
      $hasUrusan = !empty($row['urusan_rpjmd_kode']);
      
      $level = 1; // Default: Urusan
      if ($hasProgram) $level = 3;
      elseif ($hasBidang) $level = 2;
      
      $levelClass = 'level-' . $level;
      
      // Tentukan no display
      if ($level == 1) {
          $noDisplay = $row['urusan_rpjmd_kode'] ?? '';
          $urusanCounter++;
          $currentUrusan = $row['urusan_rpjmd_kode'] ?? '';
          $bidangCounter[$currentUrusan] = 0;
          $programCounter[$currentUrusan] = [];
      } elseif ($level == 2) {
          $noDisplay = $row['bidang_urusan_rpjmd_kode'] ?? '';
          if (!isset($bidangCounter[$currentUrusan])) {
              $bidangCounter[$currentUrusan] = 0;
          }
          $bidangCounter[$currentUrusan]++;
          $bidangKey = $row['bidang_urusan_rpjmd_kode'] ?? '';
          if (!isset($programCounter[$bidangKey])) {
              $programCounter[$bidangKey] = 0;
          }
      } else {
          $noDisplay = $row['program_rpjmd_kode'] ?? '';
          $bidangKey = $row['bidang_urusan_rpjmd_kode'] ?? '';
          if (!isset($programCounter[$bidangKey])) {
              $programCounter[$bidangKey] = 0;
          }
          $programCounter[$bidangKey]++;
      }
      
      if ($level == 1) {
          $rpjmdName = $row['urusan_rpjmd_nama'] ?? '-';
          $rkpdName = $row['urusan_rkpd_nama'] ?? '-';
          $paguRpjmd = $row['pagu_program_rpjmd'] ?? 0;
          $paguRkpd = $row['pagu_program_rkpd'] ?? 0;
          $badgeLevel = 'urusan';
          $levelText = 'URUSAN';
      } elseif ($level == 2) {
          $rpjmdName = $row['bidang_rpjmd_nama'] ?? '-';
          $rkpdName = $row['bidang_rkpd_nama'] ?? '-';
          $paguRpjmd = $row['pagu_program_rpjmd'] ?? 0;
          $paguRkpd = $row['pagu_program_rkpd'] ?? 0;
          $badgeLevel = 'bidang';
          $levelText = 'BIDANG';
      } else {
          $rpjmdName = $row['program_rpjmd_nama'] ?? '-';
          $rkpdName = $row['program_rkpd_nama'] ?? '-';
          $paguRpjmd = $row['pagu_program_rpjmd'] ?? 0;
          $paguRkpd = $row['pagu_program_rkpd'] ?? 0;
          $badgeLevel = 'program';
          $levelText = 'PROGRAM';
      }
      
      $selisih = ($paguRpjmd && $paguRkpd) ? $paguRkpd - $paguRpjmd : null;
      ?>
      <tr class="data-row <?= $levelClass ?>" data-id="<?= $row['id'] ?>" data-level="<?= $level ?>">
        <td class="text-center no-hirarki" style="font-weight:bold; font-size:13px;">
          <span class="no-<?= $badgeLevel ?>"><?= html_escape($noDisplay) ?></span>
        </td>
        
        <!-- RPJMD -->
        <td class="row-label">
          <span class="badge-level badge-<?= $badgeLevel ?>">
            <?= $levelText ?>
          </span>
          <?= nl2br(html_escape($rpjmdName)) ?>
          <?php if (!empty($row['urusan_rpjmd_kode']) || !empty($row['bidang_urusan_rpjmd_kode']) || !empty($row['program_rpjmd_kode'])): ?>
            <br>
            <?php if (!empty($row['program_rpjmd_kode'])): ?>
              <span class="badge-kode"><?= html_escape($row['program_rpjmd_kode']) ?></span>
            <?php elseif (!empty($row['bidang_urusan_rpjmd_kode'])): ?>
              <span class="badge-kode"><?= html_escape($row['bidang_urusan_rpjmd_kode']) ?></span>
            <?php elseif (!empty($row['urusan_rpjmd_kode'])): ?>
              <span class="badge-kode"><?= html_escape($row['urusan_rpjmd_kode']) ?></span>
            <?php endif; ?>
          <?php endif; ?>
        </td>
        
        <!-- INDIKATOR RPJMD -->
        <td class="text-indikator">
          <?php if (!empty($row['rpjmd_details'])): ?>
            <span class="toggle-detail" data-target="rpjmd-<?= $row['id'] ?>">
              <i class="fa fa-plus-circle"></i> <?= count($row['rpjmd_details']) ?> indikator
            </span>
            <div class="detail-indikator" id="rpjmd-<?= $row['id'] ?>">
              <?php foreach ($row['rpjmd_details'] as $d) { ?>
                <div class="ind-item"><?= html_escape($d['indikator']) ?></div>
              <?php } ?>
            </div>
          <?php else: ?>
            <span class="text-muted">-</span>
          <?php endif; ?>
        </td>
        
        <!-- TARGET DAN SATUAN RPJMD -->
        <td>
          <?php if (!empty($row['rpjmd_details'])): ?>
            <?php foreach ($row['rpjmd_details'] as $d) { ?>
              <div style="margin-bottom:3px; padding-bottom:3px; border-bottom:1px dashed #f0f0f0;">
                <?php if (!empty($d['target']) && !empty($d['satuan'])) { ?>
                  <strong><?= html_escape($d['target']) ?></strong> <?= html_escape($d['satuan']) ?>
                <?php } else { ?>
                  <span class="text-muted">-</span>
                <?php } ?>
              </div>
            <?php } ?>
          <?php else: ?>
            <span class="text-muted">-</span>
          <?php endif; ?>
        </td>
        
        <!-- PAGU RPJMD -->
        <td class="text-pagu text-center">
          <?php if ($paguRpjmd > 0): ?>
            <span class="pagu-display pagu-display-rpjmd">
              <?= number_format($paguRpjmd, 0, ',', '.') ?>
            </span>
          <?php else: ?>
            <span class="text-muted">-</span>
          <?php endif; ?>
        </td>
        
        <!-- RKPD -->
        <td class="row-label">
          <?= nl2br(html_escape($rkpdName)) ?>
          <?php if (!empty($row['urusan_rkpd_kode']) || !empty($row['bidang_urusan_rkpd_kode']) || !empty($row['program_rkpd_kode'])): ?>
            <br>
            <?php if (!empty($row['program_rkpd_kode'])): ?>
              <span class="badge-kode"><?= html_escape($row['program_rkpd_kode']) ?></span>
            <?php elseif (!empty($row['bidang_urusan_rkpd_kode'])): ?>
              <span class="badge-kode"><?= html_escape($row['bidang_urusan_rkpd_kode']) ?></span>
            <?php elseif (!empty($row['urusan_rkpd_kode'])): ?>
              <span class="badge-kode"><?= html_escape($row['urusan_rkpd_kode']) ?></span>
            <?php endif; ?>
          <?php endif; ?>
        </td>
        
        <!-- INDIKATOR RKPD -->
        <td class="text-indikator">
          <?php if (!empty($row['rkpd_details'])): ?>
            <span class="toggle-detail" data-target="rkpd-<?= $row['id'] ?>">
              <i class="fa fa-plus-circle"></i> <?= count($row['rkpd_details']) ?> indikator
            </span>
            <div class="detail-indikator" id="rkpd-<?= $row['id'] ?>">
              <?php foreach ($row['rkpd_details'] as $d) { ?>
                <div class="ind-item"><?= html_escape($d['indikator']) ?></div>
              <?php } ?>
            </div>
          <?php else: ?>
            <span class="text-muted">-</span>
          <?php endif; ?>
        </td>
        
        <!-- PAGU RKPD -->
        <td class="text-pagu text-center">
          <?php if ($paguRkpd > 0): ?>
            <span class="pagu-display pagu-display-rkpd">
              <?= number_format($paguRkpd, 0, ',', '.') ?>
            </span>
          <?php else: ?>
            <span class="text-muted">-</span>
          <?php endif; ?>
        </td>
        
        <!-- SELISIH -->
        <td class="text-center">
          <?php if ($selisih !== null): ?>
            <span class="badge-selisih <?= ($selisih < 0) ? '' : 'badge-selisih-plus' ?>">
              <?= ($selisih > 0 ? '+' : '') . number_format($selisih, 0, ',', '.') ?>
            </span>
          <?php else: ?>
            <span class="text-muted">-</span>
          <?php endif; ?>
        </td>
        
        <!-- KETERANGAN -->
        <td><?= nl2br(html_escape($row['keterangan'] ?? '')) ?></td>
        
        <!-- PERANGKAT DAERAH -->
        <td><?= html_escape($row['perangkat_daerah'] ?? $row['instansi_nama'] ?? '') ?></td>
        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
        <!-- AKSI -->
        <td class="text-center">
          <div class="btn-group-flex">
            <button class="btn btn-warning btn-sm BtnEdit" 
                    data-id="<?= html_escape($row['id']) ?>"
                    data-toggle="tooltip" title="Edit">
              <i class="notika-icon notika-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm BtnHapus" 
                    data-id="<?= html_escape($row['id']) ?>"
                    data-toggle="tooltip" title="Hapus">
              <i class="notika-icon notika-trash"></i>
            </button>
          </div>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
    <?php } else { ?>
      <tr>
        <td colspan="12" class="text-center" style="padding:30px;">
          <i class="notika-icon notika-info" style="font-size:24px; display:block;"></i>
          <span style="font-size:16px; color:#999;">Belum ada data</span>
          <br><small class="text-muted">Klik tombol "Tambah Konsistensi Program" untuk menambahkan data</small>
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

<!-- ================================================================
MODAL INPUT - POSISI FIXED DI ATAS HEADER
================================================================ -->
<div class="modal fade fixed-modal" id="ModalInput" role="dialog">
  <div class="modal-dialog modal-lg-custom">
    <div class="modal-content">
      <div class="modal-header" style="background:#28a745; color:#fff;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        <h4><b><i class="notika-icon bi-plus-lg"></i> Tambah Konsistensi Program</b></h4>
        <small style="color:#fff;">Pagu hanya 1 (untuk level Bidang Urusan atau Program)</small>
      </div>

      <div class="modal-body">
        <form id="FormInput">

          <!-- ============================================================
          HEADER: Instansi & Tahun
          ============================================================ -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Perangkat Daerah</b></label>
                <select name="id_instansi" class="form-control" id="InputInstansi">
                  <option value="">Pilih Perangkat Daerah</option>
                  <?php foreach ($ListInstansi as $ins) { ?>
                    <option value="<?= $ins['id'] ?>"><?= html_escape($ins['nama']) ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Tahun</b></label>
                <select name="tahun" class="form-control" id="InputTahun">
                  <?php 
                  $currentYear = date('Y');
                  for ($y = $currentYear; $y >= $currentYear - 10; $y--) { ?>
                    <option value="<?= $y ?>" <?= ($TahunAktif == $y) ? 'selected' : '' ?>>
                      <?= $y ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- ============================================================
          KOLOM RPJMD & RKPD
          ============================================================ -->
          <div class="row">
            
            <!-- KOLOM RPJMD -->
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 URUSAN/PROGRAM RPJMD</b></h4>
                </div>
                <div class="panel-body">

                  <!-- Tabs: Nomenklatur / Manual -->
                  <ul class="nav nav-tabs" id="rpjmdTab">
                    <li class="active"><a href="#tab_rpjmd_nomenklatur" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rpjmd_manual" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

                    <!-- Tab Nomenklatur RPJMD -->
                    <div class="tab-pane fade in active" id="tab_rpjmd_nomenklatur">
                      <div class="nomenklatur-container">
                        <div class="breadcrumb-nomenklatur" style="margin-top:10px;">
                          <span class="badge">📁 Jalur Pilihan</span>
                          <span class="path-display" id="path_display_rpjmd">Belum ada yang dipilih</span>
                        </div>

                        <div class="row">
                          <div class="col-md-4 cascading-select">
                            <label><b>1. Urusan</b></label>
                            <select class="form-control" id="rpjmd_select_urusan">
                              <option value="">-- Pilih Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>2. Bidang Urusan</b></label>
                            <select class="form-control" id="rpjmd_select_bidang" disabled>
                              <option value="">-- Pilih Bidang Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>3. Program</b></label>
                            <select class="form-control" id="rpjmd_select_program" disabled>
                              <option value="">-- Pilih Program --</option>
                            </select>
                          </div>
                        </div>

                        <div class="info-nomenklatur" id="info_nomenklatur_rpjmd">
                          <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_rpjmd"></span>
                        </div>
                      </div>
                    </div>

                    <!-- Tab Manual RPJMD -->
                    <div class="tab-pane fade" id="tab_rpjmd_manual">
                      <div class="manual-input-group" style="margin-top:10px;">
                        <div class="form-group">
                          <label><b>Kode Urusan</b></label>
                          <input type="text" class="form-control" id="urusan_manual_rpjmd" placeholder="Contoh: 1">
                          <small class="text-muted">Contoh: 1, 2, 3, dst</small>
                        </div>
                        <div class="form-group">
                          <label><b>Kode Bidang Urusan</b></label>
                          <input type="text" class="form-control" id="bidang_manual_rpjmd" placeholder="Contoh: 1.01">
                          <small class="text-muted">Contoh: 1.01, 1.02, 2.01, dst</small>
                        </div>
                        <div class="form-group">
                          <label><b>Program PD</b></label>
                          <textarea class="form-control" id="program_manual_rpjmd" rows="2" placeholder="Isi program PD manual..."></textarea>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- ============================================================
                  PAGU - HANYA 1
                  ============================================================ -->
                  <div class="pagu-input-group">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#d4edda; color:#155724; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rpjmd" class="form-control rupiah" id="InputPaguRPJMD" placeholder="0">
                    </div>
                    <small class="text-muted" style="display:block; margin-top:5px;">Pagu untuk level yang dipilih (Bidang Urusan atau Program)</small>
                  </div>

                  <!-- Indikator RPJMD -->
                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan</b></label>
                    <div class="indikator-wrapper-rpjmd">
                      <div class="indikator-row">
                        <textarea name="indikator_rpjmd[]" class="form-control" placeholder="Indikator" rows="2"></textarea>
                        <div class="row" style="margin-top:5px;">
                          <div class="col-md-6">
                            <input type="text" name="target_rpjmd[]" class="form-control" placeholder="Target">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="satuan_rpjmd[]" class="form-control" placeholder="Satuan">
                          </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm BtnAddIndikator" data-target="rpjmd">
                          <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Hidden Fields -->
                  <div class="preview-field">
                    <input type="hidden" id="preview_urusan_rpjmd" value="">
                    <input type="hidden" id="preview_bidang_rpjmd" value="">
                    <input type="hidden" id="preview_program_rpjmd" value="">
                    <input type="hidden" id="preview_program_text_rpjmd" value="">
                  </div>

                </div>
              </div>
            </div>

            <!-- KOLOM RKPD -->
            <div class="col-md-6">
              <div class="panel panel-warning">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 URUSAN/PROGRAM RKPD</b></h4>
                </div>
                <div class="panel-body">

                  <!-- Tabs: Nomenklatur / Manual -->
                  <ul class="nav nav-tabs" id="rkpdTab">
                    <li class="active"><a href="#tab_rkpd_nomenklatur" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rkpd_manual" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

                    <!-- Tab Nomenklatur RKPD -->
                    <div class="tab-pane fade in active" id="tab_rkpd_nomenklatur">
                      <div class="nomenklatur-container">
                        <div class="breadcrumb-nomenklatur" style="margin-top:10px;">
                          <span class="badge">📁 Jalur Pilihan</span>
                          <span class="path-display" id="path_display_rkpd">Belum ada yang dipilih</span>
                        </div>

                        <div class="row">
                          <div class="col-md-4 cascading-select">
                            <label><b>1. Urusan</b></label>
                            <select class="form-control" id="rkpd_select_urusan">
                              <option value="">-- Pilih Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>2. Bidang Urusan</b></label>
                            <select class="form-control" id="rkpd_select_bidang" disabled>
                              <option value="">-- Pilih Bidang Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>3. Program</b></label>
                            <select class="form-control" id="rkpd_select_program" disabled>
                              <option value="">-- Pilih Program --</option>
                            </select>
                          </div>
                        </div>

                        <div class="info-nomenklatur" id="info_nomenklatur_rkpd">
                          <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_rkpd"></span>
                        </div>
                      </div>
                    </div>

                    <!-- Tab Manual RKPD -->
                    <div class="tab-pane fade" id="tab_rkpd_manual">
                      <div class="manual-input-group" style="margin-top:10px;">
                        <div class="form-group">
                          <label><b>Kode Urusan</b></label>
                          <input type="text" class="form-control" id="urusan_manual_rkpd" placeholder="Contoh: 1">
                          <small class="text-muted">Contoh: 1, 2, 3, dst</small>
                        </div>
                        <div class="form-group">
                          <label><b>Kode Bidang Urusan</b></label>
                          <input type="text" class="form-control" id="bidang_manual_rkpd" placeholder="Contoh: 1.01">
                          <small class="text-muted">Contoh: 1.01, 1.02, 2.01, dst</small>
                        </div>
                        <div class="form-group">
                          <label><b>Program PD</b></label>
                          <textarea class="form-control" id="program_manual_rkpd" rows="2" placeholder="Isi program PD manual..."></textarea>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- ============================================================
                  PAGU - HANYA 1
                  ============================================================ -->
                  <div class="pagu-input-group" style="border-left-color:#856404;">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#fff3cd; color:#856404; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rkpd" class="form-control rupiah" id="InputPaguRKPD" placeholder="0">
                    </div>
                    <small class="text-muted" style="display:block; margin-top:5px;">Pagu untuk level yang dipilih (Bidang Urusan atau Program)</small>
                  </div>

                  <!-- Indikator RKPD -->
                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan</b></label>
                    <div class="indikator-wrapper-rkpd">
                      <div class="indikator-row">
                        <textarea name="indikator_rkpd[]" class="form-control" placeholder="Indikator" rows="2"></textarea>
                        <div class="row" style="margin-top:5px;">
                          <div class="col-md-6">
                            <input type="text" name="target_rkpd[]" class="form-control" placeholder="Target">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="satuan_rkpd[]" class="form-control" placeholder="Satuan">
                          </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm BtnAddIndikator" data-target="rkpd">
                          <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Hidden Fields -->
                  <div class="preview-field">
                    <input type="hidden" id="preview_urusan_rkpd" value="">
                    <input type="hidden" id="preview_bidang_rkpd" value="">
                    <input type="hidden" id="preview_program_rkpd" value="">
                    <input type="hidden" id="preview_program_text_rkpd" value="">
                  </div>

                </div>
              </div>
            </div>

          </div>

          <!-- ============================================================
          KETERANGAN
          ============================================================ -->
          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea name="keterangan" class="form-control" id="InputKeterangan" rows="2" placeholder="Keterangan..."></textarea>
          </div>

          <!-- ============================================================
          TOMBOL
          ============================================================ -->
          <div class="btn-group-center" style="display:flex; justify-content:center; gap:10px; margin-top:15px;">
            <button type="button" class="btn btn-success notika-btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- ================================================================
MODAL EDIT - POSISI FIXED DI ATAS HEADER
================================================================ -->
<div class="modal fade fixed-modal" id="ModalEdit" role="dialog">
  <div class="modal-dialog modal-lg-custom">
    <div class="modal-content">
      <div class="modal-header" style="background:#ffc107; color:#333;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b><i class="notika-icon notika-edit"></i> Edit Konsistensi Program</b></h4>
        <small>Pagu hanya 1 (untuk level Bidang Urusan atau Program)</small>
      </div>

      <div class="modal-body">
        <form id="FormEdit">
          <input type="hidden" name="id" id="EditId">

          <!-- ============================================================
          HEADER: Instansi & Tahun
          ============================================================ -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Perangkat Daerah</b></label>
                <select name="id_instansi" id="EditInstansi" class="form-control">
                  <option value="">Pilih Perangkat Daerah</option>
                  <?php foreach ($ListInstansi as $ins) { ?>
                    <option value="<?= $ins['id'] ?>"><?= html_escape($ins['nama']) ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Tahun</b></label>
                <select name="tahun" id="EditTahun" class="form-control">
                  <?php 
                  $currentYear = date('Y');
                  for ($y = $currentYear; $y >= $currentYear - 10; $y--) { ?>
                    <option value="<?= $y ?>"><?= $y ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- ============================================================
          KOLOM RPJMD & RKPD
          ============================================================ -->
          <div class="row">
            
            <!-- KOLOM RPJMD -->
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 URUSAN/PROGRAM RPJMD</b></h4>
                </div>
                <div class="panel-body">

                  <ul class="nav nav-tabs" id="rpjmdTabEdit">
                    <li class="active"><a href="#tab_rpjmd_nomenklatur_edit" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rpjmd_manual_edit" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

                    <!-- Tab Nomenklatur RPJMD Edit -->
                    <div class="tab-pane fade in active" id="tab_rpjmd_nomenklatur_edit">
                      <div class="nomenklatur-container">
                        <div class="breadcrumb-nomenklatur" style="margin-top:10px;">
                          <span class="badge">📁 Jalur Pilihan</span>
                          <span class="path-display" id="path_display_rpjmd_edit">Belum ada yang dipilih</span>
                        </div>

                        <div class="row">
                          <div class="col-md-4 cascading-select">
                            <label><b>1. Urusan</b></label>
                            <select class="form-control" id="rpjmd_edit_select_urusan">
                              <option value="">-- Pilih Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>2. Bidang Urusan</b></label>
                            <select class="form-control" id="rpjmd_edit_select_bidang" disabled>
                              <option value="">-- Pilih Bidang Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>3. Program</b></label>
                            <select class="form-control" id="rpjmd_edit_select_program" disabled>
                              <option value="">-- Pilih Program --</option>
                            </select>
                          </div>
                        </div>

                        <div class="info-nomenklatur" id="info_nomenklatur_rpjmd_edit">
                          <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_rpjmd_edit"></span>
                        </div>
                      </div>
                    </div>

                    <!-- Tab Manual RPJMD Edit -->
                    <div class="tab-pane fade" id="tab_rpjmd_manual_edit">
                      <div class="manual-input-group" style="margin-top:10px;">
                        <div class="form-group">
                          <label><b>Kode Urusan</b></label>
                          <input type="text" class="form-control" id="urusan_manual_rpjmd_edit" placeholder="Contoh: 1">
                        </div>
                        <div class="form-group">
                          <label><b>Kode Bidang Urusan</b></label>
                          <input type="text" class="form-control" id="bidang_manual_rpjmd_edit" placeholder="Contoh: 1.01">
                        </div>
                        <div class="form-group">
                          <label><b>Program PD</b></label>
                          <textarea class="form-control" id="program_manual_rpjmd_edit" rows="2" placeholder="Isi program PD manual..."></textarea>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- ============================================================
                  PAGU - HANYA 1
                  ============================================================ -->
                  <div class="pagu-input-group">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#d4edda; color:#155724; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rpjmd" id="EditPaguRPJMD" class="form-control rupiah" placeholder="0">
                    </div>
                  </div>

                  <!-- Indikator RPJMD -->
                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan</b></label>
                    <div class="indikator-wrapper-rpjmd-edit"></div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorEdit" data-target="rpjmd">
                      <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
                    </button>
                  </div>

                  <div class="preview-field">
                    <input type="hidden" id="preview_urusan_rpjmd_edit" value="">
                    <input type="hidden" id="preview_bidang_rpjmd_edit" value="">
                    <input type="hidden" id="preview_program_rpjmd_edit" value="">
                    <input type="hidden" id="preview_program_text_rpjmd_edit" value="">
                  </div>

                </div>
              </div>
            </div>

            <!-- KOLOM RKPD -->
            <div class="col-md-6">
              <div class="panel panel-warning">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 URUSAN/PROGRAM RKPD</b></h4>
                </div>
                <div class="panel-body">

                  <ul class="nav nav-tabs" id="rkpdTabEdit">
                    <li class="active"><a href="#tab_rkpd_nomenklatur_edit" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rkpd_manual_edit" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

                    <!-- Tab Nomenklatur RKPD Edit -->
                    <div class="tab-pane fade in active" id="tab_rkpd_nomenklatur_edit">
                      <div class="nomenklatur-container">
                        <div class="breadcrumb-nomenklatur" style="margin-top:10px;">
                          <span class="badge">📁 Jalur Pilihan</span>
                          <span class="path-display" id="path_display_rkpd_edit">Belum ada yang dipilih</span>
                        </div>

                        <div class="row">
                          <div class="col-md-4 cascading-select">
                            <label><b>1. Urusan</b></label>
                            <select class="form-control" id="rkpd_edit_select_urusan">
                              <option value="">-- Pilih Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>2. Bidang Urusan</b></label>
                            <select class="form-control" id="rkpd_edit_select_bidang" disabled>
                              <option value="">-- Pilih Bidang Urusan --</option>
                            </select>
                          </div>
                          <div class="col-md-4 cascading-select">
                            <label><b>3. Program</b></label>
                            <select class="form-control" id="rkpd_edit_select_program" disabled>
                              <option value="">-- Pilih Program --</option>
                            </select>
                          </div>
                        </div>

                        <div class="info-nomenklatur" id="info_nomenklatur_rkpd_edit">
                          <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_rkpd_edit"></span>
                        </div>
                      </div>
                    </div>

                    <!-- Tab Manual RKPD Edit -->
                    <div class="tab-pane fade" id="tab_rkpd_manual_edit">
                      <div class="manual-input-group" style="margin-top:10px;">
                        <div class="form-group">
                          <label><b>Kode Urusan</b></label>
                          <input type="text" class="form-control" id="urusan_manual_rkpd_edit" placeholder="Contoh: 1">
                        </div>
                        <div class="form-group">
                          <label><b>Kode Bidang Urusan</b></label>
                          <input type="text" class="form-control" id="bidang_manual_rkpd_edit" placeholder="Contoh: 1.01">
                        </div>
                        <div class="form-group">
                          <label><b>Program PD</b></label>
                          <textarea class="form-control" id="program_manual_rkpd_edit" rows="2" placeholder="Isi program PD manual..."></textarea>
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- ============================================================
                  PAGU - HANYA 1
                  ============================================================ -->
                  <div class="pagu-input-group" style="border-left-color:#856404;">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#fff3cd; color:#856404; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rkpd" id="EditPaguRKPD" class="form-control rupiah" placeholder="0">
                    </div>
                  </div>

                  <!-- Indikator RKPD -->
                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan</b></label>
                    <div class="indikator-wrapper-rkpd-edit"></div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorEdit" data-target="rkpd">
                      <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
                    </button>
                  </div>

                  <div class="preview-field">
                    <input type="hidden" id="preview_urusan_rkpd_edit" value="">
                    <input type="hidden" id="preview_bidang_rkpd_edit" value="">
                    <input type="hidden" id="preview_program_rkpd_edit" value="">
                    <input type="hidden" id="preview_program_text_rkpd_edit" value="">
                  </div>

                </div>
              </div>
            </div>

          </div>

          <!-- ============================================================
          KETERANGAN
          ============================================================ -->
          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea name="keterangan" id="EditKeterangan" class="form-control" rows="2"></textarea>
          </div>

          <!-- ============================================================
          TOMBOL
          ============================================================ -->
          <div class="btn-group-center" style="display:flex; justify-content:center; gap:10px; margin-top:15px;">
            <button type="button" class="btn btn-success notika-btn-success" id="BtnUpdate"><b>UPDATE</b></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- ================================================================
JAVASCRIPT - VERSION WITH FIXES
================================================================ -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
// ============================================================
// KONFIGURASI GLOBAL
// ============================================================
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var KODE_WILAYAH = '<?= addslashes($KodeWilayah ?? '') ?>';

// Cache nomenklatur
var nomenklaturCache = {};

// ============================================================
// FUNGSI GET NOMENKLATUR
// ============================================================
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

// ============================================================
// ✅ FIX: UPDATE PATH DISPLAY - Dengan pengecekan elemen
// ============================================================
function updatePathDisplay(prefix) {
    // AMBIL DARI DROPDOWN
    var urusanVal = $('#' + prefix + '_select_urusan').val() || '';
    var urusanText = $('#' + prefix + '_select_urusan option:selected').text() || '';
    
    var bidangVal = $('#' + prefix + '_select_bidang').val() || '';
    var bidangText = $('#' + prefix + '_select_bidang option:selected').text() || '';
    
    var programVal = $('#' + prefix + '_select_program').val() || '';
    var programTextSel = $('#' + prefix + '_select_program option:selected').text() || '';

    console.log('🔍 updatePathDisplay - ' + prefix);
    console.log('  urusanVal:', urusanVal);
    console.log('  bidangVal:', bidangVal);
    console.log('  programVal:', programVal);

    // ============================================================
    // TENTUKAN TYPE
    // ============================================================
    var isRpjmd = prefix.indexOf('rpjmd') !== -1;
    var type = isRpjmd ? 'rpjmd' : 'rkpd';
    var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
    
    // ============================================================
    // ✅ FIX: UPDATE PREVIEW FIELDS - CEK ELEMEN EXIST
    // ============================================================
    // RPJMD
    if (type === 'rpjmd') {
        if (editSuffix) {
            // Edit mode - CEK ELEMEN EXIST
            var elUrusan = $('#preview_urusan_rpjmd_edit');
            var elBidang = $('#preview_bidang_rpjmd_edit');
            var elProgram = $('#preview_program_rpjmd_edit');
            var elProgramText = $('#preview_program_text_rpjmd_edit');
            
            if (elUrusan.length > 0) elUrusan.val(urusanVal);
            if (elBidang.length > 0) elBidang.val(bidangVal);
            if (elProgram.length > 0) elProgram.val(programVal);
            if (elProgramText.length > 0 && programVal) {
                elProgramText.val(programTextSel || '');
            }
        } else {
            // Input mode
            $('#preview_urusan_rpjmd').val(urusanVal);
            $('#preview_bidang_rpjmd').val(bidangVal);
            $('#preview_program_rpjmd').val(programVal);
            if (programVal) {
                $('#preview_program_text_rpjmd').val(programTextSel || '');
            }
        }
    }
    
    // RKPD
    if (type === 'rkpd') {
        if (editSuffix) {
            var elUrusan = $('#preview_urusan_rkpd_edit');
            var elBidang = $('#preview_bidang_rkpd_edit');
            var elProgram = $('#preview_program_rkpd_edit');
            var elProgramText = $('#preview_program_text_rkpd_edit');
            
            if (elUrusan.length > 0) elUrusan.val(urusanVal);
            if (elBidang.length > 0) elBidang.val(bidangVal);
            if (elProgram.length > 0) elProgram.val(programVal);
            if (elProgramText.length > 0 && programVal) {
                elProgramText.val(programTextSel || '');
            }
        } else {
            $('#preview_urusan_rkpd').val(urusanVal);
            $('#preview_bidang_rkpd').val(bidangVal);
            $('#preview_program_rkpd').val(programVal);
            if (programVal) {
                $('#preview_program_text_rkpd').val(programTextSel || '');
            }
        }
    }

    console.log('✅ PREVIEW FIELDS - ' + prefix + ':');
    console.log('  preview_urusan:', type === 'rpjmd' ? 
        (editSuffix ? $('#preview_urusan_rpjmd_edit').val() : $('#preview_urusan_rpjmd').val()) : 
        (editSuffix ? $('#preview_urusan_rkpd_edit').val() : $('#preview_urusan_rkpd').val()));
    console.log('  preview_program:', type === 'rpjmd' ? 
        (editSuffix ? $('#preview_program_rpjmd_edit').val() : $('#preview_program_rpjmd').val()) : 
        (editSuffix ? $('#preview_program_rkpd_edit').val() : $('#preview_program_rkpd').val()));
}


// ============================================================
// FUNGSI LOAD LEVEL - FIXED
// ============================================================
function loadLevel(prefix, level, parentKode) {
    var selectId = prefix + '_select_' + 
        (level == 1 ? 'urusan' : (level == 2 ? 'bidang' : 'program'));
    
    if (level == 1) {
        $('#' + prefix + '_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        $('#' + prefix + '_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    } else if (level == 2) {
        $('#' + prefix + '_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    }

    if (!parentKode && level > 1) {
        $('#' + selectId).html('<option value="">-- Pilih --</option>').prop('disabled', true);
        updatePathDisplay(prefix);
        return;
    }

    getNomenklaturProgramPD(level, parentKode, function(res) {
        var options = '<option value="">-- Pilih ' + 
            (level == 1 ? 'Urusan' : (level == 2 ? 'Bidang Urusan' : 'Program')) + 
            ' --</option>';
        
        if (res && res.length > 0) {
            for (var i = 0; i < res.length; i++) {
                options += '<option value="' + res[i].Kode + '">' + 
                           res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            }
        }
        $('#' + selectId).html(options).prop('disabled', false);
        updatePathDisplay(prefix);
    });
}

// ============================================================
// FUNGSI LOAD EDIT NOMENKLATUR - FIXED
// ============================================================
function loadEditNomenklatur(prefix, kodeUrusan, kodeBidang, kodeProgram, programText) {
    console.log('📂 loadEditNomenklatur -', prefix);
    console.log('  kodeUrusan:', kodeUrusan);
    console.log('  kodeBidang:', kodeBidang);
    console.log('  kodeProgram:', kodeProgram);
    console.log('  programText:', programText);
    
    var selectUrusan = $('#' + prefix + '_select_urusan');
    var selectBidang = $('#' + prefix + '_select_bidang');
    var selectProgram = $('#' + prefix + '_select_program');
    
    selectUrusan.html('<option value="">-- Pilih Urusan --</option>');
    selectBidang.html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
    selectProgram.html('<option value="">-- Pilih Program --</option>').prop('disabled', true);

    var isRpjmd = prefix.indexOf('rpjmd') !== -1;
    var type = isRpjmd ? 'rpjmd' : 'rkpd';
    var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
    
    // Set manual fields
    $('#urusan_manual' + editSuffix + '_' + type).val(kodeUrusan || '');
    $('#bidang_manual' + editSuffix + '_' + type).val(kodeBidang || '');
    $('#program_manual' + editSuffix + '_' + type).val(programText || '');

    // Jika tidak ada kode urusan, tampilkan kosong
    if (!kodeUrusan) {
        loadLevel(prefix, 1, '');
        return;
    }

    // Load Urusan
    getNomenklaturProgramPD(1, '', function(res) {
        var options = '<option value="">-- Pilih Urusan --</option>';
        if (res && res.length > 0) {
            for (var i = 0; i < res.length; i++) {
                var selected = (res[i].Kode === kodeUrusan) ? 'selected' : '';
                options += '<option value="' + res[i].Kode + '" ' + selected + '>' + 
                           res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            }
        }
        selectUrusan.html(options).prop('disabled', false);
        updatePathDisplay(prefix);
        
        if (kodeUrusan) {
            getNomenklaturProgramPD(2, kodeUrusan, function(res2) {
                var options2 = '<option value="">-- Pilih Bidang Urusan --</option>';
                if (res2 && res2.length > 0) {
                    for (var i = 0; i < res2.length; i++) {
                        var selected = (res2[i].Kode === kodeBidang) ? 'selected' : '';
                        options2 += '<option value="' + res2[i].Kode + '" ' + selected + '>' + 
                                    res2[i].Kode + ' - ' + res2[i].Nomenklatur + '</option>';
                    }
                }
                selectBidang.html(options2).prop('disabled', false);
                updatePathDisplay(prefix);
                
                if (kodeBidang) {
                    getNomenklaturProgramPD(3, kodeBidang, function(res3) {
                        var options3 = '<option value="">-- Pilih Program --</option>';
                        if (res3 && res3.length > 0) {
                            for (var i = 0; i < res3.length; i++) {
                                var selected = (res3[i].Kode === kodeProgram) ? 'selected' : '';
                                options3 += '<option value="' + res3[i].Kode + '" ' + selected + '>' + 
                                            res3[i].Kode + ' - ' + res3[i].Nomenklatur + '</option>';
                            }
                        }
                        selectProgram.html(options3).prop('disabled', false);
                        updatePathDisplay(prefix);
                    });
                }
            });
        }
    });
}

// ============================================================
// FUNGSI RENDER INDIKATOR EDIT
// ============================================================
function renderIndikatorEdit(jenis, details) {
    var wrapper = jenis == 'rpjmd' ? 
        '.indikator-wrapper-rpjmd-edit' : 
        '.indikator-wrapper-rkpd-edit';
    
    var container = $(wrapper);
    container.html('');
    
    if (details && details.length > 0) {
        $.each(details, function(i, item) {
            var row = `
                <div class="indikator-row">
                    <textarea name="indikator_${jenis}[]" class="form-control" rows="2">${escapeHtml(item.indikator || '')}</textarea>
                    <div class="row" style="margin-top:5px;">
                        <div class="col-md-6">
                            <input type="text" name="target_${jenis}[]" class="form-control" value="${escapeHtml(item.target || '')}" placeholder="Target">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="satuan_${jenis}[]" class="form-control" value="${escapeHtml(item.satuan || '')}" placeholder="Satuan">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                        <i class="notika-icon notika-trash"></i> Hapus
                    </button>
                </div>
            `;
            container.append(row);
        });
    } else {
        container.html(`
            <div class="indikator-row">
                <textarea name="indikator_${jenis}[]" class="form-control" rows="2" placeholder="Indikator"></textarea>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-6">
                        <input type="text" name="target_${jenis}[]" class="form-control" placeholder="Target">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="satuan_${jenis}[]" class="form-control" placeholder="Satuan">
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-sm BtnAddIndikatorEdit" data-target="${jenis}">
                    <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
                </button>
            </div>
        `);
    }
}

// ============================================================
// EVENT NOMENKLATUR
// ============================================================
$(document).on('change', '[id$="_select_urusan"]', function() {
    var id = $(this).attr('id');
    var prefix = id.replace('_select_urusan', '');
    var kode = $(this).val();
    
    // Hapus bidang dan program
    $('#' + prefix + '_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
    $('#' + prefix + '_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    
    if (kode && kode !== '') {
        loadLevel(prefix, 2, kode);
    } else {
        // Kosongkan semua
        var isRpjmd = prefix.indexOf('rpjmd') !== -1;
        var type = isRpjmd ? 'rpjmd' : 'rkpd';
        var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
        
        // Kosongkan preview fields
        $('#preview_urusan' + editSuffix + '_' + type).val('');
        $('#preview_bidang' + editSuffix + '_' + type).val('');
        $('#preview_program' + editSuffix + '_' + type).val('');
        $('#preview_program_text' + editSuffix + '_' + type).val('');
        
        updatePathDisplay(prefix);
    }
});

$(document).on('change', '[id$="_select_bidang"]', function() {
    var id = $(this).attr('id');
    var prefix = id.replace('_select_bidang', '');
    var kode = $(this).val();
    
    $('#' + prefix + '_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    
    if (kode && kode !== '') {
        loadLevel(prefix, 3, kode);
    } else {
        // Kosongkan program
        var isRpjmd = prefix.indexOf('rpjmd') !== -1;
        var type = isRpjmd ? 'rpjmd' : 'rkpd';
        var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
        
        $('#preview_program' + editSuffix + '_' + type).val('');
        $('#preview_program_text' + editSuffix + '_' + type).val('');
        
        updatePathDisplay(prefix);
    }
});

$(document).on('change', '[id$="_select_program"]', function() {
    var id = $(this).attr('id');
    var prefix = id.replace('_select_program', '');
    
    // ✅ UPDATE PREVIEW FIELDS LANGSUNG
    var programVal = $(this).val() || '';
    var programText = $(this).find('option:selected').text() || '';
    
    var isRpjmd = prefix.indexOf('rpjmd') !== -1;
    var type = isRpjmd ? 'rpjmd' : 'rkpd';
    var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
    
    $('#preview_program' + editSuffix + '_' + type).val(programVal);
    if (programVal) {
        $('#preview_program_text' + editSuffix + '_' + type).val(programText);
    } else {
        $('#preview_program_text' + editSuffix + '_' + type).val('');
    }
    
    console.log('📝 Program selected:', programVal, '|', programText);
    
    updatePathDisplay(prefix);
});
// ============================================================
// INDIKATOR ROW MANAGEMENT
// ============================================================
$(document).on('click', '.BtnAddIndikator', function() {
    var target = $(this).data('target');
    var wrapper = target == 'rpjmd' ? '.indikator-wrapper-rpjmd' : '.indikator-wrapper-rkpd';
    var name = target == 'rpjmd' ? 'rpjmd' : 'rkpd';
    
    var newRow = `
        <div class="indikator-row">
            <textarea name="indikator_${name}[]" class="form-control" placeholder="Indikator" rows="2"></textarea>
            <div class="row" style="margin-top:5px;">
                <div class="col-md-6">
                    <input type="text" name="target_${name}[]" class="form-control" placeholder="Target">
                </div>
                <div class="col-md-6">
                    <input type="text" name="satuan_${name}[]" class="form-control" placeholder="Satuan">
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                <i class="notika-icon notika-trash"></i> Hapus
            </button>
        </div>
    `;
    
    $(wrapper).append(newRow);
});

$(document).on('click', '.BtnAddIndikatorEdit', function() {
    var target = $(this).data('target');
    var wrapper = target == 'rpjmd' ? '.indikator-wrapper-rpjmd-edit' : '.indikator-wrapper-rkpd-edit';
    var name = target == 'rpjmd' ? 'rpjmd' : 'rkpd';
    
    var newRow = `
        <div class="indikator-row">
            <textarea name="indikator_${name}[]" class="form-control" placeholder="Indikator" rows="2"></textarea>
            <div class="row" style="margin-top:5px;">
                <div class="col-md-6">
                    <input type="text" name="target_${name}[]" class="form-control" placeholder="Target">
                </div>
                <div class="col-md-6">
                    <input type="text" name="satuan_${name}[]" class="form-control" placeholder="Satuan">
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                <i class="notika-icon notika-trash"></i> Hapus
            </button>
        </div>
    `;
    
    $(wrapper).append(newRow);
});

$(document).on('click', '.BtnRemoveIndikator', function() {
    $(this).closest('.indikator-row').remove();
});

// ============================================================
// FORMAT RUPIAH
// ============================================================
$(document).on('input', '.rupiah', function() {
    var value = $(this).val().replace(/[^0-9]/g, '');
    if (value) {
        $(this).val('Rp ' + parseInt(value).toLocaleString('id-ID'));
    } else {
        $(this).val('');
    }
});

// ============================================================
// TOGGLE DETAIL INDIKATOR
// ============================================================
$(document).on('click', '.toggle-detail', function() {
    var target = $(this).data('target');
    $('#' + target).toggleClass('show');
    var icon = $(this).find('i');
    if (icon.hasClass('fa-plus-circle')) {
        icon.removeClass('fa-plus-circle').addClass('fa-minus-circle');
    } else {
        icon.removeClass('fa-minus-circle').addClass('fa-plus-circle');
    }
});

// ============================================================
// HELPER ESCAPE HTML
// ============================================================
function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// ============================================================
// JQUERY READY
// ============================================================
jQuery(document).ready(function($){

    // DataTable
    if ($('#data-table-konsistensi').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-konsistensi')) {
                $('#data-table-konsistensi').DataTable().destroy();
            }
            $('#data-table-konsistensi').DataTable({
                "pageLength": 10,
                "ordering": true,
                "language": {
                    "emptyTable": "Tidak ada data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": [0, 1, 2, 3, 5, 6, 8, 9, 10, 11] }
                ]
            });
        } catch(e) { console.log("DataTable error:", e); }
    }

    // ============================================================
    // TOMBOL TAMBAH - BUKA MODAL
    // ============================================================
    $('#BtnTambahKonsistensi').click(function() {
        resetFormInput();
        $('#ModalInput').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    // ============================================================
    // FUNGSI RESET FORM
    // ============================================================
    function resetFormInput() {
        $('#InputInstansi').val('');
        $('#InputTahun').val('<?= $TahunAktif ?>');
        $('#InputPaguRPJMD').val('');
        $('#InputPaguRKPD').val('');
        $('#InputKeterangan').val('');
        
        $('.indikator-wrapper-rpjmd').html(`
            <div class="indikator-row">
                <textarea name="indikator_rpjmd[]" class="form-control" placeholder="Indikator" rows="2"></textarea>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-6">
                        <input type="text" name="target_rpjmd[]" class="form-control" placeholder="Target">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="satuan_rpjmd[]" class="form-control" placeholder="Satuan">
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-sm BtnAddIndikator" data-target="rpjmd">
                    <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
                </button>
            </div>
        `);
        
        $('.indikator-wrapper-rkpd').html(`
            <div class="indikator-row">
                <textarea name="indikator_rkpd[]" class="form-control" placeholder="Indikator" rows="2"></textarea>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-6">
                        <input type="text" name="target_rkpd[]" class="form-control" placeholder="Target">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="satuan_rkpd[]" class="form-control" placeholder="Satuan">
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-sm BtnAddIndikator" data-target="rkpd">
                    <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
                </button>
            </div>
        `);
        
        nomenklaturCache = {};
        loadLevel('rpjmd', 1, '');
        loadLevel('rkpd', 1, '');
    }

    // ============================================================
    // FILTER
    // ============================================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
        $("#Provinsi").change(function() {
            if ($(this).val() === "") {
                $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                return;
            }
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
                error: function() {
                    console.error("Gagal memuat data Kab/Kota");
                    $("#KabKota").prop('disabled', false);
                }
            });
        });

        $("#FilterBtn").click(function() {
            if ($("#Provinsi").val() === "") {
                alert("Mohon Pilih Provinsi");
                return;
            }
            if ($("#KabKota").val() === "") {
                alert("Mohon Pilih Kab/Kota");
                return;
            }

            var kodeWilayah = $("#KabKota").val();
            var instansiId = $("#FilterInstansi").val();
            var tahun = $("#TahunFilter").val();

            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
                async: false
            });

            var redirectUrl = BaseURL + "Daerah/KonsistensiProgram";
            var params = [];
            if (instansiId && instansiId != '') params.push("instansi_id=" + instansiId);
            if (tahun && tahun != '') params.push("tahun=" + tahun);
            if (params.length > 0) redirectUrl += "?" + params.join('&');
            
            window.location.href = redirectUrl;
        });

        <?php if (!empty($KodeWilayah)) { ?>
            var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
            var kodeKab  = "<?= $KodeWilayah ?>";
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
    // SIMPAN
    // ============================================================
    $("#BtnSimpan").click(function() {
        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        var urusanRpjmd = $('#preview_urusan_rpjmd').val();
        var bidangRpjmd = $('#preview_bidang_rpjmd').val();
        var programRpjmd = $('#preview_program_rpjmd').val();
        var programRpjmdText = $('#preview_program_text_rpjmd').val();
        
        var urusanRkpd = $('#preview_urusan_rkpd').val();
        var bidangRkpd = $('#preview_bidang_rkpd').val();
        var programRkpd = $('#preview_program_rkpd').val();
        var programRkpdText = $('#preview_program_text_rkpd').val();

        // Cek tab manual
        var rpjmdTab = $('#rpjmdTab .tab-pane.active').attr('id');
        if (rpjmdTab === 'tab_rpjmd_manual') {
            urusanRpjmd = $('#urusan_manual_rpjmd').val().trim();
            bidangRpjmd = $('#bidang_manual_rpjmd').val().trim();
            programRpjmdText = $('#program_manual_rpjmd').val().trim();
            programRpjmd = '';
        }

        var rkpdTab = $('#rkpdTab .tab-pane.active').attr('id');
        if (rkpdTab === 'tab_rkpd_manual') {
            urusanRkpd = $('#urusan_manual_rkpd').val().trim();
            bidangRkpd = $('#bidang_manual_rkpd').val().trim();
            programRkpdText = $('#program_manual_rkpd').val().trim();
            programRkpd = '';
        }

        var hasRpjmd = urusanRpjmd || bidangRpjmd || programRpjmd || programRpjmdText;
        var hasRkpd = urusanRkpd || bidangRkpd || programRkpd || programRkpdText;

        if (!hasRpjmd && !hasRkpd) {
            alert("Urusan/Program RPJMD atau RKPD harus diisi!");
            btn.prop('disabled', false).text('SIMPAN');
            return;
        }

        // Kumpulkan indikator
        var indikatorRpjmd = [], targetRpjmd = [], satuanRpjmd = [];
        $('.indikator-wrapper-rpjmd .indikator-row').each(function() {
            var indikator = $(this).find('textarea[name="indikator_rpjmd[]"]').val();
            if (indikator && indikator.trim() !== '') {
                indikatorRpjmd.push(indikator.trim());
                targetRpjmd.push($(this).find('input[name="target_rpjmd[]"]').val() || '');
                satuanRpjmd.push($(this).find('input[name="satuan_rpjmd[]"]').val() || '');
            }
        });

        var indikatorRkpd = [], targetRkpd = [], satuanRkpd = [];
        $('.indikator-wrapper-rkpd .indikator-row').each(function() {
            var indikator = $(this).find('textarea[name="indikator_rkpd[]"]').val();
            if (indikator && indikator.trim() !== '') {
                indikatorRkpd.push(indikator.trim());
                targetRkpd.push($(this).find('input[name="target_rkpd[]"]').val() || '');
                satuanRkpd.push($(this).find('input[name="satuan_rkpd[]"]').val() || '');
            }
        });

        var payload = {
            urusan_rpjmd_kode: urusanRpjmd,
            bidang_rpjmd_kode: bidangRpjmd,
            program_rpjmd_kode: programRpjmd,
            program_rpjmd_text: programRpjmdText,
            pagu_program_rpjmd: $('#InputPaguRPJMD').val(),
            
            urusan_rkpd_kode: urusanRkpd,
            bidang_rkpd_kode: bidangRkpd,
            program_rkpd_kode: programRkpd,
            program_rkpd_text: programRkpdText,
            pagu_program_rkpd: $('#InputPaguRKPD').val(),
            
            id_instansi: $('#InputInstansi').val(),
            tahun: $('#InputTahun').val(),
            keterangan: $('#InputKeterangan').val(),
            
            indikator_rpjmd: indikatorRpjmd,
            target_rpjmd: targetRpjmd,
            satuan_rpjmd: satuanRpjmd,
            
            indikator_rkpd: indikatorRkpd,
            target_rkpd: targetRkpd,
            satuan_rkpd: satuanRkpd,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $.ajax({
            url: BaseURL + "Daerah/InputKonsistensiProgram",
            type: "POST",
            data: payload,
            dataType: 'json',
            success: function(res) {
                if (res.status == 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan data!');
                    btn.prop('disabled', false).text('SIMPAN');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
                btn.prop('disabled', false).text('SIMPAN');
            }
        });
    });

    // ============================================================
    // EDIT - FIXED VERSION
    // ============================================================
    $(document).on("click", ".BtnEdit", function() {
        var id = $(this).data('id');
        if (!id) { alert('ID tidak valid!'); return; }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="notika-icon notika-edit"></i>');

        // Reset form
        $('#EditId').val('');
        $('#EditInstansi').val('');
        $('#EditTahun').val('');
        $('#EditKeterangan').val('');
        $('#EditPaguRPJMD').val('');
        $('#EditPaguRKPD').val('');
        
        // Reset preview fields
        $('#preview_urusan_rpjmd_edit').val('');
        $('#preview_bidang_rpjmd_edit').val('');
        $('#preview_program_rpjmd_edit').val('');
        $('#preview_program_text_rpjmd_edit').val('');
        $('#preview_urusan_rkpd_edit').val('');
        $('#preview_bidang_rkpd_edit').val('');
        $('#preview_program_rkpd_edit').val('');
        $('#preview_program_text_rkpd_edit').val('');
        
        // Reset manual fields
        $('#urusan_manual_rpjmd_edit').val('');
        $('#bidang_manual_rpjmd_edit').val('');
        $('#program_manual_rpjmd_edit').val('');
        $('#urusan_manual_rkpd_edit').val('');
        $('#bidang_manual_rkpd_edit').val('');
        $('#program_manual_rkpd_edit').val('');

        $.ajax({
            url: BaseURL + "Daerah/GetKonsistensiProgramById",
            type: "POST",
            data: { 
                id: id, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 'success' && res.data) {
                    var d = res.data;
                    
                    // ============================================================
                    // ISI FORM DENGAN DATA
                    // ============================================================
                    $("#EditId").val(d.id);
                    $("#EditInstansi").val(d.id_instansi || '');
                    $("#EditTahun").val(d.tahun || '');
                    $("#EditKeterangan").val(d.keterangan || '');
                    $("#EditPaguRPJMD").val(d.pagu_program_rpjmd ? 'Rp ' + parseInt(d.pagu_program_rpjmd).toLocaleString('id-ID') : '');
                    $("#EditPaguRKPD").val(d.pagu_program_rkpd ? 'Rp ' + parseInt(d.pagu_program_rkpd).toLocaleString('id-ID') : '');
                    
                    // ============================================================
                    // SIMPAN DATA KE PREVIEW FIELDS
                    // ============================================================
                    // RPJMD
                    var rpjmdData = {
                        urusan: d.urusan_rpjmd_kode || '',
                        bidang: d.bidang_urusan_rpjmd_kode || '',
                        program: d.program_rpjmd_kode || '',
                        program_text: d.program_rpjmd_text || ''
                    };
                    
                    // RKPD
                    var rkpdData = {
                        urusan: d.urusan_rkpd_kode || '',
                        bidang: d.bidang_urusan_rkpd_kode || '',
                        program: d.program_rkpd_kode || '',
                        program_text: d.program_rkpd_text || ''
                    };
                    
                    // ============================================================
                    // SET PREVIEW FIELDS
                    // ============================================================
                    $('#preview_urusan_rpjmd_edit').val(rpjmdData.urusan);
                    $('#preview_bidang_rpjmd_edit').val(rpjmdData.bidang);
                    $('#preview_program_rpjmd_edit').val(rpjmdData.program);
                    $('#preview_program_text_rpjmd_edit').val(rpjmdData.program_text);
                    
                    $('#preview_urusan_rkpd_edit').val(rkpdData.urusan);
                    $('#preview_bidang_rkpd_edit').val(rkpdData.bidang);
                    $('#preview_program_rkpd_edit').val(rkpdData.program);
                    $('#preview_program_text_rkpd_edit').val(rkpdData.program_text);
                    
                    // ============================================================
                    // SET MANUAL FIELDS (untuk backup)
                    // ============================================================
                    $('#urusan_manual_rpjmd_edit').val(rpjmdData.urusan);
                    $('#bidang_manual_rpjmd_edit').val(rpjmdData.bidang);
                    $('#program_manual_rpjmd_edit').val(rpjmdData.program_text);
                    
                    $('#urusan_manual_rkpd_edit').val(rkpdData.urusan);
                    $('#bidang_manual_rkpd_edit').val(rkpdData.bidang);
                    $('#program_manual_rkpd_edit').val(rkpdData.program_text);

                    // ============================================================
                    // LOAD NOMENKLATUR DENGAN DATA YANG ADA
                    // ============================================================
                    nomenklaturCache = {};
                    
                    // Load RPJMD dengan data existing
                    loadEditNomenklatur('rpjmd_edit', 
                        rpjmdData.urusan, 
                        rpjmdData.bidang, 
                        rpjmdData.program,
                        rpjmdData.program_text
                    );
                    
                    // Load RKPD dengan data existing
                    loadEditNomenklatur('rkpd_edit',
                        rkpdData.urusan,
                        rkpdData.bidang,
                        rkpdData.program,
                        rkpdData.program_text
                    );

                    // ============================================================
                    // RENDER INDIKATOR
                    // ============================================================
                    renderIndikatorEdit('rpjmd', d.rpjmd_details || []);
                    renderIndikatorEdit('rkpd', d.rkpd_details || []);
                    
                    // ============================================================
                    // Tentukan tab yang aktif berdasarkan data yang ada
                    // ============================================================
                    var hasRpjmdKode = rpjmdData.urusan || rpjmdData.bidang || rpjmdData.program;
                    var hasRpjmdText = rpjmdData.program_text;
                    
                    if (hasRpjmdText && !hasRpjmdKode) {
                        $('#rpjmdTabEdit a[href="#tab_rpjmd_manual_edit"]').tab('show');
                        $('#info_nomenklatur_rpjmd_edit').hide();
                    } else {
                        $('#rpjmdTabEdit a[href="#tab_rpjmd_nomenklatur_edit"]').tab('show');
                    }
                    
                    var hasRkpdKode = rkpdData.urusan || rkpdData.bidang || rkpdData.program;
                    var hasRkpdText = rkpdData.program_text;
                    
                    if (hasRkpdText && !hasRkpdKode) {
                        $('#rkpdTabEdit a[href="#tab_rkpd_manual_edit"]').tab('show');
                        $('#info_nomenklatur_rkpd_edit').hide();
                    } else {
                        $('#rkpdTabEdit a[href="#tab_rkpd_nomenklatur_edit"]').tab('show');
                    }

                    // ============================================================
                    // TAMPILKAN MODAL
                    // ============================================================
                    $('#ModalEdit').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).css('display', 'block').addClass('in');
                    $('body').addClass('modal-open');
                    
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
                btn.prop('disabled', false).html('<i class="notika-icon notika-edit"></i>');
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Terjadi kesalahan: ' + xhr.responseText);
                btn.prop('disabled', false).html('<i class="notika-icon notika-edit"></i>');
            }
        });
    });

    // ============================================================
    // UPDATE - FIXED VERSION
    // ============================================================
    $("#BtnUpdate").click(function() {
    var id = $("#EditId").val();
    if (!id) { alert('ID tidak valid!'); return; }

    var btn = $(this);
    btn.prop('disabled', true).text('Menyimpan...');

    // ============================================================
    // ✅ FIX: AMBIL DARI PREVIEW FIELDS
    // ============================================================
    var urusanRpjmd = $('#preview_urusan_rpjmd_edit').val() || '';
    var bidangRpjmd = $('#preview_bidang_rpjmd_edit').val() || '';
    var programRpjmd = $('#preview_program_rpjmd_edit').val() || '';
    var programRpjmdText = $('#preview_program_text_rpjmd_edit').val() || '';
    
    var urusanRkpd = $('#preview_urusan_rkpd_edit').val() || '';
    var bidangRkpd = $('#preview_bidang_rkpd_edit').val() || '';
    var programRkpd = $('#preview_program_rkpd_edit').val() || '';
    var programRkpdText = $('#preview_program_text_rkpd_edit').val() || '';

    // ============================================================
    // ✅ FIX: CEK TAB MANUAL - Jika manual, ambil dari manual fields
    // ============================================================
    var rpjmdTabActive = $('#rpjmdTabEdit .tab-pane.active').attr('id');
    if (rpjmdTabActive === 'tab_rpjmd_manual_edit') {
        var manualUrusan = $('#urusan_manual_rpjmd_edit').val().trim();
        var manualBidang = $('#bidang_manual_rpjmd_edit').val().trim();
        var manualProgram = $('#program_manual_rpjmd_edit').val().trim();
        
        if (manualUrusan || manualBidang || manualProgram) {
            urusanRpjmd = manualUrusan;
            bidangRpjmd = manualBidang;
            programRpjmd = '';
            programRpjmdText = manualProgram;
        }
    }

    var rkpdTabActive = $('#rkpdTabEdit .tab-pane.active').attr('id');
    if (rkpdTabActive === 'tab_rkpd_manual_edit') {
        var manualUrusan = $('#urusan_manual_rkpd_edit').val().trim();
        var manualBidang = $('#bidang_manual_rkpd_edit').val().trim();
        var manualProgram = $('#program_manual_rkpd_edit').val().trim();
        
        if (manualUrusan || manualBidang || manualProgram) {
            urusanRkpd = manualUrusan;
            bidangRkpd = manualBidang;
            programRkpd = '';
            programRkpdText = manualProgram;
        }
    }

    // ============================================================
    // ✅ FIX: LOG UNTUK DEBUG
    // ============================================================
    console.log('=== UPDATE DATA ===');
    console.log('urusanRpjmd:', urusanRpjmd);
    console.log('bidangRpjmd:', bidangRpjmd);
    console.log('programRpjmd:', programRpjmd);
    console.log('programRpjmdText:', programRpjmdText);
    console.log('urusanRkpd:', urusanRkpd);
    console.log('bidangRkpd:', bidangRkpd);
    console.log('programRkpd:', programRkpd);
    console.log('programRkpdText:', programRkpdText);

    // ============================================================
    // ✅ FIX: VALIDASI - Cek dengan benar
    // ============================================================
var hasRpjmd = urusanRpjmd || bidangRpjmd || programRpjmd || programRpjmdText;
var hasRkpd = urusanRkpd || bidangRkpd || programRkpd || programRkpdText;

console.log('hasRpjmd:', hasRpjmd, '| nilai:', {urusanRpjmd, bidangRpjmd, programRpjmd, programRpjmdText});
console.log('hasRkpd:', hasRkpd, '| nilai:', {urusanRkpd, bidangRkpd, programRkpd, programRkpdText});

// ✅ VALIDASI: Cukup salah satu yang terisi
if (!hasRpjmd && !hasRkpd) {
    alert('Urusan/Program RPJMD atau RKPD harus diisi!');
    btn.prop('disabled', false).text('UPDATE');
    return;
}

    // ============================================================
    // KUMPULKAN INDIKATOR
    // ============================================================
    var indikatorRpjmd = [], targetRpjmd = [], satuanRpjmd = [];
    $('.indikator-wrapper-rpjmd-edit .indikator-row').each(function() {
        var indikator = $(this).find('textarea[name="indikator_rpjmd[]"]').val();
        if (indikator && indikator.trim() !== '') {
            indikatorRpjmd.push(indikator.trim());
            targetRpjmd.push($(this).find('input[name="target_rpjmd[]"]').val() || '');
            satuanRpjmd.push($(this).find('input[name="satuan_rpjmd[]"]').val() || '');
        }
    });

    var indikatorRkpd = [], targetRkpd = [], satuanRkpd = [];
    $('.indikator-wrapper-rkpd-edit .indikator-row').each(function() {
        var indikator = $(this).find('textarea[name="indikator_rkpd[]"]').val();
        if (indikator && indikator.trim() !== '') {
            indikatorRkpd.push(indikator.trim());
            targetRkpd.push($(this).find('input[name="target_rkpd[]"]').val() || '');
            satuanRkpd.push($(this).find('input[name="satuan_rkpd[]"]').val() || '');
        }
    });

    // ============================================================
    // BUAT PAYLOAD
    // ============================================================
    var payload = {
        id: id,
        urusan_rpjmd_kode: urusanRpjmd,
        bidang_rpjmd_kode: bidangRpjmd,
        program_rpjmd_kode: programRpjmd,
        program_rpjmd_text: programRpjmdText,
        pagu_program_rpjmd: $('#EditPaguRPJMD').val(),
        
        urusan_rkpd_kode: urusanRkpd,
        bidang_rkpd_kode: bidangRkpd,
        program_rkpd_kode: programRkpd,
        program_rkpd_text: programRkpdText,
        pagu_program_rkpd: $('#EditPaguRKPD').val(),
        
        id_instansi: $('#EditInstansi').val(),
        tahun: $('#EditTahun').val(),
        keterangan: $('#EditKeterangan').val(),
        
        indikator_rpjmd: indikatorRpjmd,
        target_rpjmd: targetRpjmd,
        satuan_rpjmd: satuanRpjmd,
        
        indikator_rkpd: indikatorRkpd,
        target_rkpd: targetRkpd,
        satuan_rkpd: satuanRkpd,
        [CSRF_NAME]: CSRF_TOKEN
    };

    console.log('Payload dikirim:', payload);

    // ============================================================
    // KIRIM AJAX
    // ============================================================
    $.ajax({
        url: BaseURL + "Daerah/EditKonsistensiProgram",
        type: "POST",
        data: payload,
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                alert(res.message);
                window.location.reload();
            } else {
                alert(res.message || 'Gagal update data!');
                btn.prop('disabled', false).text('UPDATE');
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseText);
            alert('Terjadi kesalahan: ' + xhr.responseText);
            btn.prop('disabled', false).text('UPDATE');
        }
    });
});


    // ============================================================
    // HAPUS
    // ============================================================
    $(document).on("click", ".BtnHapus", function() {
        var id = $(this).data('id');
        if (!id) { alert('ID tidak valid!'); return; }
        if (!confirm('Yakin hapus data ini?')) return;

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="notika-icon notika-trash"></i>');

        $.ajax({
            url: BaseURL + "Daerah/HapusKonsistensiProgram",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            success: function(res) {
                if (res.status == 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || 'Gagal hapus data!');
                    btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
                btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
            }
        });
    });

    // ============================================================
    // RESET CACHE
    // ============================================================
    $('#ModalInput').on('hidden.bs.modal', function() {
        nomenklaturCache = {};
        $('body').removeClass('modal-open');
    });

    $('#ModalEdit').on('hidden.bs.modal', function() {
        nomenklaturCache = {};
        $('body').removeClass('modal-open');
    });

    // ============================================================
    // LOAD INITIAL DATA
    // ============================================================
    loadLevel('rpjmd', 1, '');
    loadLevel('rkpd', 1, '');

}); // End document ready
</script>

</body>
</html>