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
       PAGU INPUT
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
       INDIKATOR ROW - DENGAN AUTO-FILL STYLE
       ============================================================ */
    .indikator-detail-row {
        background: #f8f9fa;
        padding: 15px 15px 10px 15px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        position: relative;
    }
    .indikator-detail-row:hover {
        border-color: #17a2b8;
        box-shadow: 0 2px 8px rgba(23,162,184,0.15);
    }
    
    /* Style untuk indikator yang diisi otomatis dari Program PD */
    .indikator-detail-row.auto-filled {
        border-left: 5px solid #28a745;
        background: #f0fff4;
        padding-top: 38px;
    }
    
    .indikator-detail-row.auto-filled .auto-badge {
        position: absolute;
        top: 6px;
        left: 12px;
        font-size: 10px;
        font-weight: 600;
        color: #155724;
        background: #d4edda;
        padding: 3px 14px;
        border-radius: 12px;
        display: inline-block;
        border: 1px solid #b8daff;
        letter-spacing: 0.3px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .indikator-detail-row.auto-filled .auto-source {
        font-size: 10px;
        color: #6c757d;
        display: block;
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px dashed #dee2e6;
        font-style: italic;
    }
    
    .indikator-detail-row:not(.auto-filled) {
        padding-top: 15px;
    }
    
    .indikator-detail-row .btn-remove-detail {
        position: absolute;
        top: 5px;
        right: 8px;
        padding: 3px 10px;
        font-size: 14px;
        line-height: 1.3;
        border-radius: 4px;
        z-index: 5;
        background: transparent;
        border: none;
        color: #dc3545;
        transition: all 0.3s ease;
    }
    .indikator-detail-row .btn-remove-detail:hover {
        background: #dc3545;
        color: #fff;
        transform: scale(1.05);
    }
    
    .indikator-detail-row .row-fields {
        margin-top: 5px;
    }
    .indikator-detail-row .row-fields .form-control {
        font-size: 13px;
        height: 36px;
    }
    .indikator-detail-row .row-fields textarea.form-control {
        height: 38px;
        resize: vertical;
    }
    
    .indikator-detail-row .field-label {
        font-size: 11px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 3px;
        display: block;
    }
    
    /* ============================================================
       TABEL STYLE
       ============================================================ */
    .table-konsistensi th {
        background: #f8f9fa;
        font-weight: 600;
        font-size: 10px;
        text-align: center;
        vertical-align: middle;
        padding: 6px 4px;
        border: 1px solid #dee2e6;
    }
    .table-konsistensi td {
        vertical-align: middle;
        font-size: 11px;
        padding: 6px 8px;
        border: 1px solid #dee2e6;
    }
    
    .header-rpjmd {
        background-color: #28a745 !important;
        color: #fff !important;
        text-align: center !important;
        font-weight: bold;
        font-size: 11px;
    }
    .header-rkpd {
        background-color: #ffc107 !important;
        color: #333 !important;
        text-align: center !important;
        font-weight: bold;
        font-size: 11px;
    }
    .sub-header {
        background-color: #e9ecef !important;
        font-weight: 600;
        font-size: 9px;
    }
    .sub-header th {
        background-color: #e9ecef !important;
        font-weight: 600;
        font-size: 9px;
        text-align: center !important;
    }
    
    .level-1 {
        background-color: #e8f0fe;
        font-weight: 700;
        font-size: 13px;
        color: #1a5276;
    }
    .level-2 {
        background-color: #f0f8ff;
        font-weight: 600;
        font-size: 12px;
        color: #0c5460;
        padding-left: 25px !important;
    }
    .level-3 {
        background-color: #ffffff;
        font-weight: 400;
        font-size: 11px;
        color: #495057;
        padding-left: 45px !important;
    }
    
    .pagu-display {
        padding: 2px 8px;
        border-radius: 4px;
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
    }
    .pagu-display-rpjmd { background: #d4edda; color: #155724; }
    .pagu-display-rkpd { background: #fff3cd; color: #856404; }
    
    .badge-kode {
        background: #e9ecef;
        color: #495057;
        font-size: 9px;
        padding: 2px 8px;
        border-radius: 10px;
        font-weight: normal;
        font-family: monospace;
    }
    .badge-kode.badge-rpjmd { background: #28a745; color: #fff; }
    .badge-kode.badge-rkpd { background: #ffc107; color: #333; }
    
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
    
    .text-wrap {
        white-space: normal;
        word-wrap: break-word;
        max-width: 150px;
    }
    .text-left { text-align: left !important; }
    .text-center { text-align: center !important; }
    
    .btn-group-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        flex-wrap: nowrap;
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
    
    .detail-counter-badge {
        display: inline-block;
        background: #17a2b8;
        color: #fff;
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        margin-left: 10px;
    }
    
    /* Modal */
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
        .table-konsistensi td { font-size: 9px; padding: 4px 4px; }
        .level-2 { padding-left: 15px !important; }
        .level-3 { padding-left: 30px !important; }
        .pagu-input-group .pagu-input { width: 100%; }
        .pagu-input-group .pagu-label { display: block; min-width: auto; }
        .modal.fixed-modal .modal-dialog { margin: 10px auto; }
        .table-konsistensi th { font-size: 8px; padding: 4px 2px; }
        .text-wrap { max-width: 80px; }
        .indikator-detail-row.auto-filled {
            padding-top: 45px;
        }
        .indikator-detail-row.auto-filled .auto-badge {
            font-size: 9px;
            padding: 2px 10px;
            top: 4px;
            left: 8px;
        }
        .indikator-detail-row .btn-remove-detail {
            top: 3px;
            right: 5px;
            font-size: 12px;
            padding: 2px 8px;
        }
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
                            $startYear = $currentYear - 5;
                            $endYear = $currentYear + 5;
                            for ($y = $startYear; $y <= $endYear; $y++) { ?>
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
            TABEL DATA
            ============================================================ -->
            <div class="table-responsive">
              <table id="data-table-konsistensi" class="table table-striped table-bordered table-konsistensi">
                <thead>
                  <tr>
                    <th rowspan="2" style="width:40px; vertical-align:middle; text-align:center;">NO</th>
                    <th rowspan="2" style="min-width:160px; vertical-align:middle; text-align:center;">URUSAN/PROGRAM<br>RPJMD</th>
                    <th colspan="4" class="header-rpjmd" style="text-align:center; vertical-align:middle;">
                        RPJMD
                    </th>
                    <th rowspan="2" style="min-width:160px; vertical-align:middle; text-align:center;">URUSAN/PROGRAM<br>RKPD</th>
                    <th colspan="4" class="header-rkpd" style="text-align:center; vertical-align:middle;">
                        RKPD
                    </th>
                    <th rowspan="2" style="width:70px; vertical-align:middle; text-align:center;">SELISIH</th>
                    <th rowspan="2" style="min-width:100px; vertical-align:middle; text-align:center;">KETERANGAN</th>
                    <th rowspan="2" style="min-width:120px; vertical-align:middle; text-align:center;">PERANGKAT<br>DAERAH</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                    <th rowspan="2" style="width:70px; vertical-align:middle; text-align:center;">AKSI</th>
                    <?php } ?>
                  </tr>
                  <tr>
                    <th class="sub-header" style="min-width:100px;">INDIKATOR</th>
                    <th class="sub-header" style="min-width:80px;">TARGET</th>
                    <th class="sub-header" style="min-width:80px;">SATUAN</th>
                    <th class="sub-header" style="min-width:90px;">PAGU PROGRAM</th>
                    <th class="sub-header" style="min-width:100px;">INDIKATOR</th>
                    <th class="sub-header" style="min-width:80px;">TARGET</th>
                    <th class="sub-header" style="min-width:80px;">SATUAN</th>
                    <th class="sub-header" style="min-width:90px;">PAGU PROGRAM</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($KonsistensiData)) { 
                  $flatData = [];
                  foreach ($KonsistensiData as $row) {
                      $rpjmdDetails = $row['rpjmd_details'] ?? [];
                      $rkpdDetails = $row['rkpd_details'] ?? [];
                      $maxRows = max(count($rpjmdDetails), count($rkpdDetails), 1);
                      
                      for ($i = 0; $i < $maxRows; $i++) {
                          $flatData[] = [
                              'header' => $row,
                              'rpjmd_detail' => isset($rpjmdDetails[$i]) ? $rpjmdDetails[$i] : null,
                              'rkpd_detail' => isset($rkpdDetails[$i]) ? $rkpdDetails[$i] : null,
                              'is_first' => ($i == 0),
                              'rowspan' => $maxRows
                          ];
                      }
                  }
                  
                  $rowNumber = 1;
                  foreach ($flatData as $index => $item) { 
                    $row = $item['header'];
                    $rpjmdDetail = $item['rpjmd_detail'];
                    $rkpdDetail = $item['rkpd_detail'];
                    $isFirst = $item['is_first'];
                    $rowspan = $item['rowspan'];
                    
                    $hasProgram = !empty($row['program_rpjmd_kode']) || !empty($row['program_rpjmd_text']);
                    $hasBidang = !empty($row['bidang_urusan_rpjmd_kode']);
                    $hasUrusan = !empty($row['urusan_rpjmd_kode']);
                    
                    $level = 1;
                    if ($hasProgram) $level = 3;
                    elseif ($hasBidang) $level = 2;
                    
                    $levelClass = 'level-' . $level;
                    
                    if ($level == 1) {
                        $noDisplay = $row['urusan_rpjmd_kode'] ?? '';
                        $rpjmdName = $row['urusan_rpjmd_nama'] ?? '-';
                        $rkpdName = $row['urusan_rkpd_nama'] ?? '-';
                    } elseif ($level == 2) {
                        $noDisplay = $row['bidang_urusan_rpjmd_kode'] ?? '';
                        $rpjmdName = $row['bidang_rpjmd_nama'] ?? '-';
                        $rkpdName = $row['bidang_rkpd_nama'] ?? '-';
                    } else {
                        $noDisplay = $row['program_rpjmd_kode'] ?? '';
                        $rpjmdName = $row['program_rpjmd_nama'] ?? '-';
                        $rkpdName = $row['program_rkpd_nama'] ?? '-';
                    }
                    
                    $paguRpjmd = $row['pagu_program_rpjmd'] ?? 0;
                    $paguRkpd = $row['pagu_program_rkpd'] ?? 0;
                    $selisih = ($paguRpjmd && $paguRkpd) ? $paguRkpd - $paguRpjmd : null;
                    ?>
                    <tr class="data-row <?= $levelClass ?>" data-id="<?= $row['id'] ?>" data-level="<?= $level ?>">
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="text-center" style="font-weight:bold; font-size:12px; vertical-align:middle;">
                          <?= html_escape($noDisplay) ?>
                        </td>
                      <?php } ?>
                      
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="row-label text-left" style="vertical-align:middle;">
                          <?php 
                          $kodeDisplay = '';
                          if (!empty($row['program_rpjmd_kode'])) {
                              $kodeDisplay = $row['program_rpjmd_kode'];
                          } elseif (!empty($row['bidang_urusan_rpjmd_kode'])) {
                              $kodeDisplay = $row['bidang_urusan_rpjmd_kode'];
                          } elseif (!empty($row['urusan_rpjmd_kode'])) {
                              $kodeDisplay = $row['urusan_rpjmd_kode'];
                          }
                          if ($kodeDisplay): ?>
                            <span class="badge-kode badge-rpjmd"><?= html_escape($kodeDisplay) ?></span>
                            <br>
                          <?php endif; ?>
                          <?= nl2br(html_escape($rpjmdName)) ?>
                        </td>
                      <?php } ?>
                      
                      <td class="text-indikator text-left">
                        <?php if ($rpjmdDetail && !empty($rpjmdDetail['indikator'])): ?>
                          <?= html_escape($rpjmdDetail['indikator']) ?>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      
                      <td class="text-left">
                        <?php if ($rpjmdDetail && !empty($rpjmdDetail['target'])): ?>
                          <strong><?= html_escape($rpjmdDetail['target']) ?></strong>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      
                      <td class="text-left">
                        <?php if ($rpjmdDetail && !empty($rpjmdDetail['satuan'])): ?>
                          <?= html_escape($rpjmdDetail['satuan']) ?>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="text-pagu text-center" style="vertical-align:middle;">
                          <?php if ($paguRpjmd > 0): ?>
                            <span class="pagu-display pagu-display-rpjmd">
                              <?= number_format($paguRpjmd, 0, ',', '.') ?>
                            </span>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                      <?php } ?>
                      
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="row-label text-left" style="vertical-align:middle;">
                          <?php 
                          $kodeDisplay = '';
                          if (!empty($row['program_rkpd_kode'])) {
                              $kodeDisplay = $row['program_rkpd_kode'];
                          } elseif (!empty($row['bidang_urusan_rkpd_kode'])) {
                              $kodeDisplay = $row['bidang_urusan_rkpd_kode'];
                          } elseif (!empty($row['urusan_rkpd_kode'])) {
                              $kodeDisplay = $row['urusan_rkpd_kode'];
                          }
                          if ($kodeDisplay): ?>
                            <span class="badge-kode badge-rkpd"><?= html_escape($kodeDisplay) ?></span>
                            <br>
                          <?php endif; ?>
                          <?= nl2br(html_escape($rkpdName)) ?>
                        </td>
                      <?php } ?>
                      
                      <td class="text-indikator text-left">
                        <?php if ($rkpdDetail && !empty($rkpdDetail['indikator'])): ?>
                          <?= html_escape($rkpdDetail['indikator']) ?>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      
                      <td class="text-left">
                        <?php if ($rkpdDetail && !empty($rkpdDetail['target'])): ?>
                          <strong><?= html_escape($rkpdDetail['target']) ?></strong>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      
                      <td class="text-left">
                        <?php if ($rkpdDetail && !empty($rkpdDetail['satuan'])): ?>
                          <?= html_escape($rkpdDetail['satuan']) ?>
                        <?php else: ?>
                          <span class="text-muted">-</span>
                        <?php endif; ?>
                      </td>
                      
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="text-pagu text-center" style="vertical-align:middle;">
                          <?php if ($paguRkpd > 0): ?>
                            <span class="pagu-display pagu-display-rkpd">
                              <?= number_format($paguRkpd, 0, ',', '.') ?>
                            </span>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                      <?php } ?>
                      
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="text-center" style="vertical-align:middle;">
                          <?php if ($selisih !== null): ?>
                            <span class="badge-selisih <?= ($selisih < 0) ? '' : 'badge-selisih-plus' ?>">
                              <?= ($selisih > 0 ? '+' : '') . number_format($selisih, 0, ',', '.') ?>
                            </span>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                      <?php } ?>
                      
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="text-left text-wrap" style="vertical-align:middle;">
                          <?= nl2br(html_escape($row['keterangan'] ?? '')) ?>
                        </td>
                      <?php } ?>
                      
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="text-left" style="vertical-align:middle;">
                          <?= html_escape($row['perangkat_daerah'] ?? $row['instansi_nama'] ?? '') ?>
                        </td>
                      <?php } ?>
                      
                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <?php if ($isFirst) { ?>
                        <td rowspan="<?= $rowspan ?>" class="text-center" style="vertical-align:middle;">
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
                        </td>
                      <?php } ?>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '15' : '14' ?>" class="text-center" style="padding:40px 0;">
                      <div class="empty-state">
                        <i class="notika-icon notika-file"></i>
                        <h4><b>Belum ada data</b></h4>
                        <p class="text-muted">
                          <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3 && !empty($KodeWilayah)) { ?>
                            Klik tombol <strong>"Tambah Konsistensi Program"</strong> untuk mulai mengisi data.
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

<!-- ================================================================
MODAL INPUT
================================================================ -->
<div class="modal fade fixed-modal" id="ModalInput" role="dialog">
  <div class="modal-dialog modal-lg-custom">
    <div class="modal-content">
      <div class="modal-header" style="background:#28a745; color:#fff; border-radius: 6px 6px 0 0;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:1;">&times;</button>
        <h4><b><i class="notika-icon bi-plus-lg"></i> Tambah Konsistensi Program</b></h4>
        <span id="IndikatorCounterBadge" class="detail-counter-badge">0 Indikator</span>
      </div>

      <div class="modal-body">
        <form id="FormInput">

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
                  $startYear = $currentYear - 5;
                  $endYear = $currentYear + 5;
                  for ($y = $startYear; $y <= $endYear; $y++) { ?>
                    <option value="<?= $y ?>" <?= ($TahunAktif == $y) ? 'selected' : '' ?>>
                      <?= $y ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            
            <!-- KOLOM RPJMD -->
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 URUSAN/PROGRAM RPJMD</b></h4>
                  <small style="color:#155724; display:block; font-size:11px; margin-top:3px;">
                    💡 Pilih Program untuk otomatis mengisi Indikator dari Program PD
                  </small>
                </div>
                <div class="panel-body">

                  <ul class="nav nav-tabs" id="rpjmdTab">
                    <li class="active"><a href="#tab_rpjmd_nomenklatur" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rpjmd_manual" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

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

                    <div class="tab-pane fade" id="tab_rpjmd_manual">
                      <div class="manual-input-group" style="margin-top:10px;">
                        <div class="form-group">
                          <label><b>Kode Urusan</b></label>
                          <input type="text" class="form-control" id="urusan_manual_rpjmd" placeholder="Contoh: 1">
                        </div>
                        <div class="form-group">
                          <label><b>Kode Bidang Urusan</b></label>
                          <input type="text" class="form-control" id="bidang_manual_rpjmd" placeholder="Contoh: 1.01">
                        </div>
                        <div class="form-group">
                          <label><b>Program PD</b></label>
                          <textarea class="form-control" id="program_manual_rpjmd" rows="2" placeholder="Isi program PD manual..."></textarea>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="pagu-input-group">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#d4edda; color:#155724; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rpjmd" class="form-control rupiah" id="InputPaguRPJMD" placeholder="0">
                    </div>
                  </div>

                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan RPJMD</b></label>
                    <div id="rpjmdDetailContainer"></div>
                    <button type="button" class="btn btn-success btn-sm" id="BtnTambahRpjmdDetail">
                      <i class="notika-icon bi-plus-lg"></i> Tambah Indikator RPJMD
                    </button>
                  </div>

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
                  <small style="color:#856404; display:block; font-size:11px; margin-top:3px;">
                    💡 Pilih Program untuk otomatis mengisi Indikator dari Program PD
                  </small>
                </div>
                <div class="panel-body">

                  <ul class="nav nav-tabs" id="rkpdTab">
                    <li class="active"><a href="#tab_rkpd_nomenklatur" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rkpd_manual" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

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

                    <div class="tab-pane fade" id="tab_rkpd_manual">
                      <div class="manual-input-group" style="margin-top:10px;">
                        <div class="form-group">
                          <label><b>Kode Urusan</b></label>
                          <input type="text" class="form-control" id="urusan_manual_rkpd" placeholder="Contoh: 1">
                        </div>
                        <div class="form-group">
                          <label><b>Kode Bidang Urusan</b></label>
                          <input type="text" class="form-control" id="bidang_manual_rkpd" placeholder="Contoh: 1.01">
                        </div>
                        <div class="form-group">
                          <label><b>Program PD</b></label>
                          <textarea class="form-control" id="program_manual_rkpd" rows="2" placeholder="Isi program PD manual..."></textarea>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="pagu-input-group" style="border-left-color:#856404;">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#fff3cd; color:#856404; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rkpd" class="form-control rupiah" id="InputPaguRKPD" placeholder="0">
                    </div>
                  </div>

                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan RKPD</b></label>
                    <div id="rkpdDetailContainer"></div>
                    <button type="button" class="btn btn-success btn-sm" id="BtnTambahRkpdDetail">
                      <i class="notika-icon bi-plus-lg"></i> Tambah Indikator RKPD
                    </button>
                  </div>

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

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea name="keterangan" class="form-control" id="InputKeterangan" rows="2" placeholder="Keterangan..."></textarea>
          </div>

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
MODAL EDIT
================================================================ -->
<div class="modal fade fixed-modal" id="ModalEdit" role="dialog">
  <div class="modal-dialog modal-lg-custom">
    <div class="modal-content">
      <div class="modal-header" style="background:#ffc107; color:#333; border-radius: 6px 6px 0 0;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b><i class="notika-icon notika-edit"></i> Edit Konsistensi Program</b></h4>
        <span id="EditIndikatorCounterBadge" class="detail-counter-badge">0 Indikator</span>
      </div>

      <div class="modal-body">
        <form id="FormEdit">
          <input type="hidden" name="id" id="EditId">

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
                  $startYear = $currentYear - 5;
                  $endYear = $currentYear + 5;
                  for ($y = $startYear; $y <= $endYear; $y++) { ?>
                    <option value="<?= $y ?>"><?= $y ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 URUSAN/PROGRAM RPJMD</b></h4>
                  <small style="color:#155724; display:block; font-size:11px; margin-top:3px;">
                    💡 Ganti Program untuk otomatis mengisi Indikator dari Program PD
                  </small>
                </div>
                <div class="panel-body">

                  <ul class="nav nav-tabs" id="rpjmdTabEdit">
                    <li class="active"><a href="#tab_rpjmd_nomenklatur_edit" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rpjmd_manual_edit" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

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

                  <div class="pagu-input-group">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#d4edda; color:#155724; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rpjmd" id="EditPaguRPJMD" class="form-control rupiah" placeholder="0">
                    </div>
                  </div>

                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan RPJMD</b></label>
                    <div id="rpjmdDetailContainerEdit"></div>
                    <button type="button" class="btn btn-success btn-sm" id="BtnTambahRpjmdDetailEdit">
                      <i class="notika-icon bi-plus-lg"></i> Tambah Indikator RPJMD
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

            <div class="col-md-6">
              <div class="panel panel-warning">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 URUSAN/PROGRAM RKPD</b></h4>
                  <small style="color:#856404; display:block; font-size:11px; margin-top:3px;">
                    💡 Ganti Program untuk otomatis mengisi Indikator dari Program PD
                  </small>
                </div>
                <div class="panel-body">

                  <ul class="nav nav-tabs" id="rkpdTabEdit">
                    <li class="active"><a href="#tab_rkpd_nomenklatur_edit" data-toggle="tab">📂 Pilih Nomenklatur</a></li>
                    <li><a href="#tab_rkpd_manual_edit" data-toggle="tab">✏️ Isi Manual</a></li>
                  </ul>

                  <div class="tab-content">

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

                  <div class="pagu-input-group" style="border-left-color:#856404;">
                    <span class="pagu-label">💰 Pagu Program</span>
                    <span class="pagu-level-badge" style="font-size:10px; padding:2px 10px; border-radius:10px; background:#fff3cd; color:#856404; margin-right:10px;">Rp</span>
                    <div class="pagu-input">
                      <input type="text" name="pagu_program_rkpd" id="EditPaguRKPD" class="form-control rupiah" placeholder="0">
                    </div>
                  </div>

                  <div class="form-group" style="margin-top:15px;">
                    <label><b>Indikator, Target, dan Satuan RKPD</b></label>
                    <div id="rkpdDetailContainerEdit"></div>
                    <button type="button" class="btn btn-success btn-sm" id="BtnTambahRkpdDetailEdit">
                      <i class="notika-icon bi-plus-lg"></i> Tambah Indikator RKPD
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

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea name="keterangan" id="EditKeterangan" class="form-control" rows="2"></textarea>
          </div>

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
JAVASCRIPT
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
var TAHUN_AKTIF = '<?= addslashes($TahunAktif ?? date('Y')) ?>';

// Cache nomenklatur
var nomenklaturCache = {};

// ============================================================
// HELPER FUNCTIONS
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

function showNotification(message, type) {
    $('#notification-toast').remove();
    
    var bgColor = '#28a745';
    var icon = '✅';
    if (type === 'error') {
        bgColor = '#dc3545';
        icon = '❌';
    } else if (type === 'info') {
        bgColor = '#17a2b8';
        icon = 'ℹ️';
    } else if (type === 'warning') {
        bgColor = '#ffc107';
        icon = '⚠️';
    }
    
    var html = `
        <div id="notification-toast" style="
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            background: ${bgColor};
            color: #fff;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            font-size: 14px;
            max-width: 450px;
            animation: slideInRight 0.5s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        ">
            <span style="font-size:20px;">${icon}</span>
            <span>${message}</span>
            <button onclick="$('#notification-toast').remove()" style="
                background: none;
                border: none;
                color: #fff;
                font-size: 18px;
                cursor: pointer;
                margin-left: 10px;
            ">&times;</button>
        </div>
    `;
    
    $('body').append(html);
    
    setTimeout(function() {
        $('#notification-toast').fadeOut(500, function() { $(this).remove(); });
    }, 5000);
}

// ============================================================
// GET NOMENKLATUR
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
// LOAD LEVEL NOMENKLATUR
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
// UPDATE PATH DISPLAY
// ============================================================
function updatePathDisplay(prefix) {
    var urusanVal = $('#' + prefix + '_select_urusan').val() || '';
    var bidangVal = $('#' + prefix + '_select_bidang').val() || '';
    var programVal = $('#' + prefix + '_select_program').val() || '';
    var programTextSel = $('#' + prefix + '_select_program option:selected').text() || '';

    var isRpjmd = prefix.indexOf('rpjmd') !== -1;
    var type = isRpjmd ? 'rpjmd' : 'rkpd';
    var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
    
    if (type === 'rpjmd') {
        if (editSuffix) {
            $('#preview_urusan_rpjmd_edit').val(urusanVal);
            $('#preview_bidang_rpjmd_edit').val(bidangVal);
            $('#preview_program_rpjmd_edit').val(programVal);
            if (programVal) {
                $('#preview_program_text_rpjmd_edit').val(programTextSel || '');
            }
        } else {
            $('#preview_urusan_rpjmd').val(urusanVal);
            $('#preview_bidang_rpjmd').val(bidangVal);
            $('#preview_program_rpjmd').val(programVal);
            if (programVal) {
                $('#preview_program_text_rpjmd').val(programTextSel || '');
            }
        }
    }
    
    if (type === 'rkpd') {
        if (editSuffix) {
            $('#preview_urusan_rkpd_edit').val(urusanVal);
            $('#preview_bidang_rkpd_edit').val(bidangVal);
            $('#preview_program_rkpd_edit').val(programVal);
            if (programVal) {
                $('#preview_program_text_rkpd_edit').val(programTextSel || '');
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
}

// ============================================================
// LOAD EDIT NOMENKLATUR
// ============================================================
function loadEditNomenklatur(prefix, kodeUrusan, kodeBidang, kodeProgram, programText) {
    var selectUrusan = $('#' + prefix + '_select_urusan');
    var selectBidang = $('#' + prefix + '_select_bidang');
    var selectProgram = $('#' + prefix + '_select_program');
    
    selectUrusan.html('<option value="">-- Pilih Urusan --</option>');
    selectBidang.html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
    selectProgram.html('<option value="">-- Pilih Program --</option>').prop('disabled', true);

    var isRpjmd = prefix.indexOf('rpjmd') !== -1;
    var type = isRpjmd ? 'rpjmd' : 'rkpd';
    var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
    
    $('#urusan_manual' + editSuffix + '_' + type).val(kodeUrusan || '');
    $('#bidang_manual' + editSuffix + '_' + type).val(kodeBidang || '');
    $('#program_manual' + editSuffix + '_' + type).val(programText || '');

    if (!kodeUrusan) {
        loadLevel(prefix, 1, '');
        return;
    }

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
// FUNGSI TAMBAH INDIKATOR - DENGAN AUTO-FILL
// ============================================================
function addRpjmdDetailRow(data) {
    var id = data ? data.id : 0;
    var indikator = data ? data.indikator : '';
    var target = data ? data.target : '';
    var satuan = data ? data.satuan : '';
    var isAutoFilled = data ? data.auto_filled : false;
    
    var autoClass = isAutoFilled ? 'auto-filled' : '';
    var autoBadge = isAutoFilled ? '<span class="auto-badge">📥 Dari Program PD</span>' : '';
    var autoSource = isAutoFilled ? '<span class="auto-source">📋 Data otomatis dari Program PD</span>' : '';
    
    var html = `
        <div class="indikator-detail-row ${autoClass}">
            <input type="hidden" class="detail-row-id" value="${id}">
            ${autoBadge}
            <button type="button" class="btn btn-danger btn-sm btn-remove-detail btn-remove-rpjmd-detail" title="Hapus Indikator">
                <i class="notika-icon notika-trash"></i>
            </button>
            <div class="row row-fields" style="margin-top: ${isAutoFilled ? '5px' : '0'};">
                <div class="col-md-12">
                    <span class="field-label">Indikator Outcome</span>
                    <input type="text" name="rpjmd_indikator[]" class="form-control" placeholder="Indikator RPJMD" value="${escapeHtml(indikator)}">
                </div>
            </div>
            <div class="row row-fields" style="margin-top:8px;">
                <div class="col-md-6">
                    <span class="field-label">Target</span>
                    <input type="text" name="rpjmd_target[]" class="form-control" placeholder="Target" value="${escapeHtml(target)}">
                </div>
                <div class="col-md-6">
                    <span class="field-label">Satuan</span>
                    <input type="text" name="rpjmd_satuan[]" class="form-control" placeholder="Satuan" value="${escapeHtml(satuan)}">
                </div>
            </div>
            ${autoSource}
        </div>
    `;
    
    $('#rpjmdDetailContainer').append(html);
    updateIndikatorCounter();
}

function addRkpdDetailRow(data) {
    var id = data ? data.id : 0;
    var indikator = data ? data.indikator : '';
    var target = data ? data.target : '';
    var satuan = data ? data.satuan : '';
    var isAutoFilled = data ? data.auto_filled : false;
    
    var autoClass = isAutoFilled ? 'auto-filled' : '';
    var autoBadge = isAutoFilled ? '<span class="auto-badge">📥 Dari Program PD</span>' : '';
    var autoSource = isAutoFilled ? '<span class="auto-source">📋 Data otomatis dari Program PD</span>' : '';
    
    var html = `
        <div class="indikator-detail-row ${autoClass}">
            <input type="hidden" class="detail-row-id" value="${id}">
            ${autoBadge}
            <button type="button" class="btn btn-danger btn-sm btn-remove-detail btn-remove-rkpd-detail" title="Hapus Indikator">
                <i class="notika-icon notika-trash"></i>
            </button>
            <div class="row row-fields" style="margin-top: ${isAutoFilled ? '5px' : '0'};">
                <div class="col-md-12">
                    <span class="field-label">Indikator Outcome</span>
                    <input type="text" name="rkpd_indikator[]" class="form-control" placeholder="Indikator RKPD" value="${escapeHtml(indikator)}">
                </div>
            </div>
            <div class="row row-fields" style="margin-top:8px;">
                <div class="col-md-6">
                    <span class="field-label">Target</span>
                    <input type="text" name="rkpd_target[]" class="form-control" placeholder="Target" value="${escapeHtml(target)}">
                </div>
                <div class="col-md-6">
                    <span class="field-label">Satuan</span>
                    <input type="text" name="rkpd_satuan[]" class="form-control" placeholder="Satuan" value="${escapeHtml(satuan)}">
                </div>
            </div>
            ${autoSource}
        </div>
    `;
    
    $('#rkpdDetailContainer').append(html);
    updateIndikatorCounter();
}

function addRpjmdDetailEditRow(data) {
    var id = data ? data.id : 0;
    var indikator = data ? data.indikator : '';
    var target = data ? data.target : '';
    var satuan = data ? data.satuan : '';
    var isAutoFilled = data ? data.auto_filled : false;
    
    var autoClass = isAutoFilled ? 'auto-filled' : '';
    var autoBadge = isAutoFilled ? '<span class="auto-badge">📥 Dari Program PD</span>' : '';
    var autoSource = isAutoFilled ? '<span class="auto-source">📋 Data otomatis dari Program PD</span>' : '';
    
    var html = `
        <div class="indikator-detail-row ${autoClass}">
            <input type="hidden" class="detail-row-id" value="${id}">
            ${autoBadge}
            <button type="button" class="btn btn-danger btn-sm btn-remove-detail btn-remove-rpjmd-detail-edit" title="Hapus Indikator">
                <i class="notika-icon notika-trash"></i>
            </button>
            <div class="row row-fields" style="margin-top: ${isAutoFilled ? '5px' : '0'};">
                <div class="col-md-12">
                    <span class="field-label">Indikator Outcome</span>
                    <input type="text" name="rpjmd_indikator_edit[]" class="form-control" placeholder="Indikator RPJMD" value="${escapeHtml(indikator)}">
                </div>
            </div>
            <div class="row row-fields" style="margin-top:8px;">
                <div class="col-md-6">
                    <span class="field-label">Target</span>
                    <input type="text" name="rpjmd_target_edit[]" class="form-control" placeholder="Target" value="${escapeHtml(target)}">
                </div>
                <div class="col-md-6">
                    <span class="field-label">Satuan</span>
                    <input type="text" name="rpjmd_satuan_edit[]" class="form-control" placeholder="Satuan" value="${escapeHtml(satuan)}">
                </div>
            </div>
            ${autoSource}
        </div>
    `;
    
    $('#rpjmdDetailContainerEdit').append(html);
    updateEditIndikatorCounter();
}

function addRkpdDetailEditRow(data) {
    var id = data ? data.id : 0;
    var indikator = data ? data.indikator : '';
    var target = data ? data.target : '';
    var satuan = data ? data.satuan : '';
    var isAutoFilled = data ? data.auto_filled : false;
    
    var autoClass = isAutoFilled ? 'auto-filled' : '';
    var autoBadge = isAutoFilled ? '<span class="auto-badge">📥 Dari Program PD</span>' : '';
    var autoSource = isAutoFilled ? '<span class="auto-source">📋 Data otomatis dari Program PD</span>' : '';
    
    var html = `
        <div class="indikator-detail-row ${autoClass}">
            <input type="hidden" class="detail-row-id" value="${id}">
            ${autoBadge}
            <button type="button" class="btn btn-danger btn-sm btn-remove-detail btn-remove-rkpd-detail-edit" title="Hapus Indikator">
                <i class="notika-icon notika-trash"></i>
            </button>
            <div class="row row-fields" style="margin-top: ${isAutoFilled ? '5px' : '0'};">
                <div class="col-md-12">
                    <span class="field-label">Indikator Outcome</span>
                    <input type="text" name="rkpd_indikator_edit[]" class="form-control" placeholder="Indikator RKPD" value="${escapeHtml(indikator)}">
                </div>
            </div>
            <div class="row row-fields" style="margin-top:8px;">
                <div class="col-md-6">
                    <span class="field-label">Target</span>
                    <input type="text" name="rkpd_target_edit[]" class="form-control" placeholder="Target" value="${escapeHtml(target)}">
                </div>
                <div class="col-md-6">
                    <span class="field-label">Satuan</span>
                    <input type="text" name="rkpd_satuan_edit[]" class="form-control" placeholder="Satuan" value="${escapeHtml(satuan)}">
                </div>
            </div>
            ${autoSource}
        </div>
    `;
    
    $('#rkpdDetailContainerEdit').append(html);
    updateEditIndikatorCounter();
}

// ============================================================
// UPDATE COUNTER BADGE
// ============================================================
function updateIndikatorCounter() {
    var count = $('#rpjmdDetailContainer .indikator-detail-row').length;
    $('#IndikatorCounterBadge').text(count + ' Indikator');
}

function updateEditIndikatorCounter() {
    var count = $('#rpjmdDetailContainerEdit .indikator-detail-row').length;
    $('#EditIndikatorCounterBadge').text(count + ' Indikator');
}

// ============================================================
// LOAD INDIKATOR DARI PROGRAM PD - AUTO FILL
// ============================================================
function loadIndikatorFromProgramPD(prefix, kodeProgram) {
    if (!kodeProgram || kodeProgram === '') {
        var containerId = prefix + 'DetailContainer';
        $('#' + containerId).empty();
        if (prefix === 'rpjmd') {
            addRpjmdDetailRow(null);
            updateIndikatorCounter();
        } else {
            addRkpdDetailRow(null);
        }
        return;
    }
    
    var tahun = $('#InputTahun').val() || TAHUN_AKTIF;
    
    var loadingHtml = '<div class="text-center" style="padding:20px;"><i class="fa fa-spinner fa-spin"></i> Memuat indikator dari Program PD...</div>';
    var containerId = prefix + 'DetailContainer';
    $('#' + containerId).html(loadingHtml);
    
    $.ajax({
        url: BaseURL + "Daerah/getIndikatorProgramPD",
        type: "POST",
        data: {
            kode_program: kodeProgram,
            tahun: tahun,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success' && res.data) {
                var indikatorList = res.data.indikator || [];
                $('#' + containerId).empty();
                
                if (indikatorList.length > 0) {
                    for (var i = 0; i < indikatorList.length; i++) {
                        var item = indikatorList[i];
                        var data = {
                            indikator: item.indikator || '',
                            target: item.target || '',
                            satuan: item.satuan || '',
                            auto_filled: true
                        };
                        
                        if (prefix === 'rpjmd') {
                            addRpjmdDetailRow(data);
                        } else {
                            addRkpdDetailRow(data);
                        }
                    }
                    
                    if (prefix === 'rpjmd') {
                        updateIndikatorCounter();
                    }
                    
                    var msg = '✅ ' + indikatorList.length + ' indikator terisi otomatis dari Program PD (Tahun ' + tahun + ')';
                    showNotification(msg, 'success');
                    
                } else {
                    if (prefix === 'rpjmd') {
                        addRpjmdDetailRow(null);
                        updateIndikatorCounter();
                    } else {
                        addRkpdDetailRow(null);
                    }
                    showNotification('ℹ️ Tidak ada indikator untuk Program ini di tahun ' + tahun, 'info');
                }
            } else {
                $('#' + containerId).empty();
                if (prefix === 'rpjmd') {
                    addRpjmdDetailRow(null);
                    updateIndikatorCounter();
                } else {
                    addRkpdDetailRow(null);
                }
                showNotification(res.message || 'Gagal memuat indikator', 'error');
            }
        },
        error: function(xhr) {
            console.error('Error loadIndikatorFromProgramPD:', xhr.responseText);
            $('#' + containerId).empty();
            if (prefix === 'rpjmd') {
                addRpjmdDetailRow(null);
                updateIndikatorCounter();
            } else {
                addRkpdDetailRow(null);
            }
            showNotification('Terjadi kesalahan saat memuat indikator', 'error');
        }
    });
}

// ============================================================
// LOAD INDIKATOR DARI PROGRAM PD UNTUK EDIT
// ============================================================
function loadIndikatorFromProgramPDEdit(prefix, kodeProgram) {
    if (!kodeProgram || kodeProgram === '') {
        var containerId = prefix + 'DetailContainerEdit';
        $('#' + containerId).empty();
        if (prefix === 'rpjmd') {
            addRpjmdDetailEditRow(null);
            updateEditIndikatorCounter();
        } else {
            addRkpdDetailEditRow(null);
        }
        return;
    }
    
    var tahun = $('#EditTahun').val() || TAHUN_AKTIF;
    
    var loadingHtml = '<div class="text-center" style="padding:20px;"><i class="fa fa-spinner fa-spin"></i> Memuat indikator...</div>';
    var containerId = prefix + 'DetailContainerEdit';
    $('#' + containerId).html(loadingHtml);
    
    $.ajax({
        url: BaseURL + "Daerah/getIndikatorProgramPD",
        type: "POST",
        data: {
            kode_program: kodeProgram,
            tahun: tahun,
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success' && res.data) {
                var indikatorList = res.data.indikator || [];
                $('#' + containerId).empty();
                
                if (indikatorList.length > 0) {
                    for (var i = 0; i < indikatorList.length; i++) {
                        var item = indikatorList[i];
                        var data = {
                            indikator: item.indikator || '',
                            target: item.target || '',
                            satuan: item.satuan || '',
                            auto_filled: true
                        };
                        
                        if (prefix === 'rpjmd') {
                            addRpjmdDetailEditRow(data);
                        } else {
                            addRkpdDetailEditRow(data);
                        }
                    }
                    
                    if (prefix === 'rpjmd') {
                        updateEditIndikatorCounter();
                    }
                    
                    showNotification('✅ ' + indikatorList.length + ' indikator terisi (Tahun ' + tahun + ')', 'success');
                } else {
                    if (prefix === 'rpjmd') {
                        addRpjmdDetailEditRow(null);
                        updateEditIndikatorCounter();
                    } else {
                        addRkpdDetailEditRow(null);
                    }
                    showNotification('ℹ️ Tidak ada indikator untuk Program ini di tahun ' + tahun, 'info');
                }
            } else {
                $('#' + containerId).empty();
                if (prefix === 'rpjmd') {
                    addRpjmdDetailEditRow(null);
                    updateEditIndikatorCounter();
                } else {
                    addRkpdDetailEditRow(null);
                }
            }
        },
        error: function(xhr) {
            console.error('Error loadIndikatorFromProgramPDEdit:', xhr.responseText);
            $('#' + containerId).empty();
            if (prefix === 'rpjmd') {
                addRpjmdDetailEditRow(null);
                updateEditIndikatorCounter();
            } else {
                addRkpdDetailEditRow(null);
            }
        }
    });
}

// ============================================================
// FUNGSI RESET FORM
// ============================================================
function resetFormInput() {
    $('#InputInstansi').val('');
    $('#InputTahun').val(TAHUN_AKTIF);
    $('#InputPaguRPJMD').val('');
    $('#InputPaguRKPD').val('');
    $('#InputKeterangan').val('');
    
    $('#preview_urusan_rpjmd').val('');
    $('#preview_bidang_rpjmd').val('');
    $('#preview_program_rpjmd').val('');
    $('#preview_program_text_rpjmd').val('');
    $('#preview_urusan_rkpd').val('');
    $('#preview_bidang_rkpd').val('');
    $('#preview_program_rkpd').val('');
    $('#preview_program_text_rkpd').val('');
    
    $('#urusan_manual_rpjmd').val('');
    $('#bidang_manual_rpjmd').val('');
    $('#program_manual_rpjmd').val('');
    $('#urusan_manual_rkpd').val('');
    $('#bidang_manual_rkpd').val('');
    $('#program_manual_rkpd').val('');
    
    $('#rpjmdDetailContainer').empty();
    addRpjmdDetailRow(null);
    $('#rkpdDetailContainer').empty();
    addRkpdDetailRow(null);
    
    updateIndikatorCounter();
    
    nomenklaturCache = {};
    loadLevel('rpjmd', 1, '');
    loadLevel('rkpd', 1, '');
}

// ============================================================
// CSS ANIMASI
// ============================================================
$('head').append(`
    <style>
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
`);

// ============================================================
// EVENT: TAMBAH INDIKATOR
// ============================================================
$(document).on('click', '#BtnTambahRpjmdDetail', function(e) {
    e.preventDefault();
    addRpjmdDetailRow(null);
});

$(document).on('click', '#BtnTambahRkpdDetail', function(e) {
    e.preventDefault();
    addRkpdDetailRow(null);
});

$(document).on('click', '#BtnTambahRpjmdDetailEdit', function(e) {
    e.preventDefault();
    addRpjmdDetailEditRow(null);
});

$(document).on('click', '#BtnTambahRkpdDetailEdit', function(e) {
    e.preventDefault();
    addRkpdDetailEditRow(null);
});

// ============================================================
// EVENT: HAPUS INDIKATOR
// ============================================================
$(document).on('click', '.btn-remove-rpjmd-detail', function() {
    $(this).closest('.indikator-detail-row').remove();
    updateIndikatorCounter();
});

$(document).on('click', '.btn-remove-rkpd-detail', function() {
    $(this).closest('.indikator-detail-row').remove();
    updateIndikatorCounter();
});

$(document).on('click', '.btn-remove-rpjmd-detail-edit', function() {
    $(this).closest('.indikator-detail-row').remove();
    updateEditIndikatorCounter();
});

$(document).on('click', '.btn-remove-rkpd-detail-edit', function() {
    $(this).closest('.indikator-detail-row').remove();
    updateEditIndikatorCounter();
});

// ============================================================
// EVENT: NOMENKLATUR CHANGE
// ============================================================
$(document).on('change', '[id$="_select_urusan"]', function() {
    var id = $(this).attr('id');
    var prefix = id.replace('_select_urusan', '');
    var kode = $(this).val();
    
    $('#' + prefix + '_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
    $('#' + prefix + '_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    
    if (kode && kode !== '') {
        loadLevel(prefix, 2, kode);
    } else {
        var isRpjmd = prefix.indexOf('rpjmd') !== -1;
        var type = isRpjmd ? 'rpjmd' : 'rkpd';
        var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
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
        var isRpjmd = prefix.indexOf('rpjmd') !== -1;
        var type = isRpjmd ? 'rpjmd' : 'rkpd';
        var editSuffix = prefix.indexOf('_edit') !== -1 ? '_edit' : '';
        $('#preview_program' + editSuffix + '_' + type).val('');
        $('#preview_program_text' + editSuffix + '_' + type).val('');
        updatePathDisplay(prefix);
    }
});

// ============================================================
// EVENT: PROGRAM CHANGED - AUTO FILL INDIKATOR
// ============================================================
$(document).on('change', '#rpjmd_select_program', function() {
    var kodeProgram = $(this).val();
    if (kodeProgram && kodeProgram !== '') {
        var programText = $(this).find('option:selected').text() || '';
        var msg = '📥 Mengambil indikator untuk Program: ' + programText;
        showNotification(msg, 'info');
        loadIndikatorFromProgramPD('rpjmd', kodeProgram);
    } else {
        $('#rpjmdDetailContainer').empty();
        addRpjmdDetailRow(null);
        updateIndikatorCounter();
    }
});

$(document).on('change', '#rkpd_select_program', function() {
    var kodeProgram = $(this).val();
    if (kodeProgram && kodeProgram !== '') {
        var programText = $(this).find('option:selected').text() || '';
        var msg = '📥 Mengambil indikator untuk Program: ' + programText;
        showNotification(msg, 'info');
        loadIndikatorFromProgramPD('rkpd', kodeProgram);
    } else {
        $('#rkpdDetailContainer').empty();
        addRkpdDetailRow(null);
    }
});

// ============================================================
// EVENT: TAHUN CHANGED - RELOAD INDIKATOR
// ============================================================
$(document).on('change', '#InputTahun', function() {
    var tahun = $(this).val();
    
    var rpjmdProgram = $('#rpjmd_select_program').val();
    if (rpjmdProgram && rpjmdProgram !== '') {
        loadIndikatorFromProgramPD('rpjmd', rpjmdProgram);
    }
    
    var rkpdProgram = $('#rkpd_select_program').val();
    if (rkpdProgram && rkpdProgram !== '') {
        loadIndikatorFromProgramPD('rkpd', rkpdProgram);
    }
});

$(document).on('change', '#EditTahun', function() {
    var tahun = $(this).val();
    
    var rpjmdProgram = $('#rpjmd_edit_select_program').val();
    if (rpjmdProgram && rpjmdProgram !== '') {
        loadIndikatorFromProgramPDEdit('rpjmd', rpjmdProgram);
    }
    
    var rkpdProgram = $('#rkpd_edit_select_program').val();
    if (rkpdProgram && rkpdProgram !== '') {
        loadIndikatorFromProgramPDEdit('rkpd', rkpdProgram);
    }
});

// ============================================================
// EVENT: EDIT PROGRAM CHANGED - DENGAN KONFIRMASI
// ============================================================
$(document).on('change', '#rpjmd_edit_select_program', function() {
    var kodeProgram = $(this).val();
    if (kodeProgram && kodeProgram !== '') {
        // Hitung jumlah indikator yang sudah ada
        var existingRows = $('#rpjmdDetailContainerEdit .indikator-detail-row').length;
        var hasData = false;
        
        // Cek apakah ada data yang terisi
        $('#rpjmdDetailContainerEdit .indikator-detail-row').each(function() {
            var indikator = $(this).find('input[name="rpjmd_indikator_edit[]"]').val();
            if (indikator && indikator.trim() !== '') {
                hasData = true;
                return false;
            }
        });
        
        if (hasData) {
            if (!confirm('Mengganti program akan MENGGANTI indikator yang sudah diisi. Lanjutkan?')) {
                $(this).val($(this).data('previous-value') || '');
                return;
            }
        }
        $(this).data('previous-value', kodeProgram);
        loadIndikatorFromProgramPDEdit('rpjmd', kodeProgram);
    }
});

$(document).on('change', '#rkpd_edit_select_program', function() {
    var kodeProgram = $(this).val();
    if (kodeProgram && kodeProgram !== '') {
        var existingRows = $('#rkpdDetailContainerEdit .indikator-detail-row').length;
        var hasData = false;
        
        $('#rkpdDetailContainerEdit .indikator-detail-row').each(function() {
            var indikator = $(this).find('input[name="rkpd_indikator_edit[]"]').val();
            if (indikator && indikator.trim() !== '') {
                hasData = true;
                return false;
            }
        });
        
        if (hasData) {
            if (!confirm('Mengganti program akan MENGGANTI indikator yang sudah diisi. Lanjutkan?')) {
                $(this).val($(this).data('previous-value') || '');
                return;
            }
        }
        $(this).data('previous-value', kodeProgram);
        loadIndikatorFromProgramPDEdit('rkpd', kodeProgram);
    }
});

// ============================================================
// EVENT: FORMAT RUPIAH
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
// FILTER WILAYAH
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
        var tahun = $("#TahunFilter").val();

        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
            async: false
        });

        var redirectUrl = BaseURL + "Daerah/KonsistensiProgram";
        if (tahun && tahun != '') redirectUrl += "?tahun=" + tahun;
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

    // Kumpulkan indikator RPJMD
    var indikatorRpjmd = [], targetRpjmd = [], satuanRpjmd = [];
    $('#rpjmdDetailContainer .indikator-detail-row').each(function() {
        var indikator = $(this).find('input[name="rpjmd_indikator[]"]').val();
        if (indikator && indikator.trim() !== '') {
            indikatorRpjmd.push(indikator.trim());
            targetRpjmd.push($(this).find('input[name="rpjmd_target[]"]').val() || '');
            satuanRpjmd.push($(this).find('input[name="rpjmd_satuan[]"]').val() || '');
        }
    });

    var indikatorRkpd = [], targetRkpd = [], satuanRkpd = [];
    $('#rkpdDetailContainer .indikator-detail-row').each(function() {
        var indikator = $(this).find('input[name="rkpd_indikator[]"]').val();
        if (indikator && indikator.trim() !== '') {
            indikatorRkpd.push(indikator.trim());
            targetRkpd.push($(this).find('input[name="rkpd_target[]"]').val() || '');
            satuanRkpd.push($(this).find('input[name="rkpd_satuan[]"]').val() || '');
        }
    });

    if (indikatorRpjmd.length === 0 && indikatorRkpd.length === 0) {
        alert('Minimal 1 Indikator untuk RPJMD atau RKPD harus diisi!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }

    var payload = {
        urusan_rpjmd_kode: urusanRpjmd,
        bidang_rpjmd_kode: bidangRpjmd,
        program_rpjmd_kode: programRpjmd,
        program_rpjmd_text: programRpjmdText,
        pagu_program_rpjmd: $('#InputPaguRPJMD').val().replace(/[^0-9]/g, ''),
        
        urusan_rkpd_kode: urusanRkpd,
        bidang_rkpd_kode: bidangRkpd,
        program_rkpd_kode: programRkpd,
        program_rkpd_text: programRkpdText,
        pagu_program_rkpd: $('#InputPaguRKPD').val().replace(/[^0-9]/g, ''),
        
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
                showNotification(res.message, 'success');
                setTimeout(function() { window.location.reload(); }, 1500);
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
// EDIT
// ============================================================
$(document).on("click", ".BtnEdit", function() {
    var id = $(this).data('id');
    if (!id) { alert('ID tidak valid!'); return; }

    var btn = $(this);
    btn.prop('disabled', true).html('<i class="notika-icon notika-edit"></i>');

    $('#EditId').val('');
    $('#EditInstansi').val('');
    $('#EditTahun').val('');
    $('#EditKeterangan').val('');
    $('#EditPaguRPJMD').val('');
    $('#EditPaguRKPD').val('');
    
    $('#rpjmdDetailContainerEdit').empty();
    $('#rkpdDetailContainerEdit').empty();
    
    $('#preview_urusan_rpjmd_edit').val('');
    $('#preview_bidang_rpjmd_edit').val('');
    $('#preview_program_rpjmd_edit').val('');
    $('#preview_program_text_rpjmd_edit').val('');
    $('#preview_urusan_rkpd_edit').val('');
    $('#preview_bidang_rkpd_edit').val('');
    $('#preview_program_rkpd_edit').val('');
    $('#preview_program_text_rkpd_edit').val('');
    
    $('#urusan_manual_rpjmd_edit').val('');
    $('#bidang_manual_rpjmd_edit').val('');
    $('#program_manual_rpjmd_edit').val('');
    $('#urusan_manual_rkpd_edit').val('');
    $('#bidang_manual_rkpd_edit').val('');
    $('#program_manual_rkpd_edit').val('');

    $.ajax({
        url: BaseURL + "Daerah/GetKonsistensiProgramById",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success' && res.data) {
                var d = res.data;
                
                $("#EditId").val(d.id);
                $("#EditInstansi").val(d.id_instansi || '');
                $("#EditTahun").val(d.tahun || '');
                $("#EditKeterangan").val(d.keterangan || '');
                $("#EditPaguRPJMD").val(d.pagu_program_rpjmd ? 'Rp ' + parseInt(d.pagu_program_rpjmd).toLocaleString('id-ID') : '');
                $("#EditPaguRKPD").val(d.pagu_program_rkpd ? 'Rp ' + parseInt(d.pagu_program_rkpd).toLocaleString('id-ID') : '');
                
                var rpjmdData = {
                    urusan: d.urusan_rpjmd_kode || '',
                    bidang: d.bidang_urusan_rpjmd_kode || '',
                    program: d.program_rpjmd_kode || '',
                    program_text: d.program_rpjmd_text || ''
                };
                
                var rkpdData = {
                    urusan: d.urusan_rkpd_kode || '',
                    bidang: d.bidang_urusan_rkpd_kode || '',
                    program: d.program_rkpd_kode || '',
                    program_text: d.program_rkpd_text || ''
                };
                
                $('#preview_urusan_rpjmd_edit').val(rpjmdData.urusan);
                $('#preview_bidang_rpjmd_edit').val(rpjmdData.bidang);
                $('#preview_program_rpjmd_edit').val(rpjmdData.program);
                $('#preview_program_text_rpjmd_edit').val(rpjmdData.program_text);
                
                $('#preview_urusan_rkpd_edit').val(rkpdData.urusan);
                $('#preview_bidang_rkpd_edit').val(rkpdData.bidang);
                $('#preview_program_rkpd_edit').val(rkpdData.program);
                $('#preview_program_text_rkpd_edit').val(rkpdData.program_text);
                
                $('#urusan_manual_rpjmd_edit').val(rpjmdData.urusan);
                $('#bidang_manual_rpjmd_edit').val(rpjmdData.bidang);
                $('#program_manual_rpjmd_edit').val(rpjmdData.program_text);
                
                $('#urusan_manual_rkpd_edit').val(rkpdData.urusan);
                $('#bidang_manual_rkpd_edit').val(rkpdData.bidang);
                $('#program_manual_rkpd_edit').val(rkpdData.program_text);

                nomenklaturCache = {};
                
                loadEditNomenklatur('rpjmd_edit', 
                    rpjmdData.urusan, 
                    rpjmdData.bidang, 
                    rpjmdData.program,
                    rpjmdData.program_text
                );
                
                loadEditNomenklatur('rkpd_edit',
                    rkpdData.urusan,
                    rkpdData.bidang,
                    rkpdData.program,
                    rkpdData.program_text
                );

                // ✅ RENDER INDIKATOR RPJMD - TANPA AUTO-FILL
                if (d.rpjmd_details && d.rpjmd_details.length > 0) {
                    $.each(d.rpjmd_details, function(i, item) {
                        addRpjmdDetailEditRow(item);
                    });
                } else {
                    addRpjmdDetailEditRow(null);
                }
                
                // ✅ RENDER INDIKATOR RKPD - TANPA AUTO-FILL
                if (d.rkpd_details && d.rkpd_details.length > 0) {
                    $.each(d.rkpd_details, function(i, item) {
                        addRkpdDetailEditRow(item);
                    });
                } else {
                    addRkpdDetailEditRow(null);
                }
                
                updateEditIndikatorCounter();

                // ✅ HANYA JIKA DATA BERASAL DARI PROGRAM PD, BARU LOAD AUTO-FILL
                // Tapi jangan auto-fill jika data manual
                var isFromProgramPD = d.is_from_program_pd || false;
                
                if (isFromProgramPD && rpjmdData.program) {
                    // Jika data dari Program PD, tawarkan untuk reload
                    if (confirm('Data ini berasal dari Program PD. Apakah Anda ingin memperbarui indikator dari Program PD?')) {
                        loadIndikatorFromProgramPDEdit('rpjmd', rpjmdData.program);
                    }
                }
                
                if (isFromProgramPD && rkpdData.program) {
                    if (confirm('Data ini berasal dari Program PD. Apakah Anda ingin memperbarui indikator dari Program PD?')) {
                        loadIndikatorFromProgramPDEdit('rkpd', rkpdData.program);
                    }
                }

                // Tentukan tab aktif
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
// UPDATE
// ============================================================
$("#BtnUpdate").click(function() {
    var id = $("#EditId").val();
    if (!id) { alert('ID tidak valid!'); return; }

    var btn = $(this);
    btn.prop('disabled', true).text('Menyimpan...');

    var urusanRpjmd = $('#preview_urusan_rpjmd_edit').val() || '';
    var bidangRpjmd = $('#preview_bidang_rpjmd_edit').val() || '';
    var programRpjmd = $('#preview_program_rpjmd_edit').val() || '';
    var programRpjmdText = $('#preview_program_text_rpjmd_edit').val() || '';
    
    var urusanRkpd = $('#preview_urusan_rkpd_edit').val() || '';
    var bidangRkpd = $('#preview_bidang_rkpd_edit').val() || '';
    var programRkpd = $('#preview_program_rkpd_edit').val() || '';
    var programRkpdText = $('#preview_program_text_rkpd_edit').val() || '';

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

    var hasRpjmd = urusanRpjmd || bidangRpjmd || programRpjmd || programRpjmdText;
    var hasRkpd = urusanRkpd || bidangRkpd || programRkpd || programRkpdText;

    if (!hasRpjmd && !hasRkpd) {
        alert('Urusan/Program RPJMD atau RKPD harus diisi!');
        btn.prop('disabled', false).text('UPDATE');
        return;
    }

    var indikatorRpjmd = [], targetRpjmd = [], satuanRpjmd = [];
    $('#rpjmdDetailContainerEdit .indikator-detail-row').each(function() {
        var indikator = $(this).find('input[name="rpjmd_indikator_edit[]"]').val();
        if (indikator && indikator.trim() !== '') {
            indikatorRpjmd.push(indikator.trim());
            targetRpjmd.push($(this).find('input[name="rpjmd_target_edit[]"]').val() || '');
            satuanRpjmd.push($(this).find('input[name="rpjmd_satuan_edit[]"]').val() || '');
        }
    });

    var indikatorRkpd = [], targetRkpd = [], satuanRkpd = [];
    $('#rkpdDetailContainerEdit .indikator-detail-row').each(function() {
        var indikator = $(this).find('input[name="rkpd_indikator_edit[]"]').val();
        if (indikator && indikator.trim() !== '') {
            indikatorRkpd.push(indikator.trim());
            targetRkpd.push($(this).find('input[name="rkpd_target_edit[]"]').val() || '');
            satuanRkpd.push($(this).find('input[name="rkpd_satuan_edit[]"]').val() || '');
        }
    });

    if (indikatorRpjmd.length === 0 && indikatorRkpd.length === 0) {
        alert('Minimal 1 Indikator untuk RPJMD atau RKPD harus diisi!');
        btn.prop('disabled', false).text('UPDATE');
        return;
    }

    var payload = {
        id: id,
        urusan_rpjmd_kode: urusanRpjmd,
        bidang_rpjmd_kode: bidangRpjmd,
        program_rpjmd_kode: programRpjmd,
        program_rpjmd_text: programRpjmdText,
        pagu_program_rpjmd: $('#EditPaguRPJMD').val().replace(/[^0-9]/g, ''),
        
        urusan_rkpd_kode: urusanRkpd,
        bidang_rkpd_kode: bidangRkpd,
        program_rkpd_kode: programRkpd,
        program_rkpd_text: programRkpdText,
        pagu_program_rkpd: $('#EditPaguRKPD').val().replace(/[^0-9]/g, ''),
        
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

    $.ajax({
        url: BaseURL + "Daerah/EditKonsistensiProgram",
        type: "POST",
        data: payload,
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                showNotification(res.message, 'success');
                setTimeout(function() { window.location.reload(); }, 1500);
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
                showNotification(res.message, 'success');
                setTimeout(function() { window.location.reload(); }, 1000);
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
// RESET CACHE ON MODAL CLOSE
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
$(document).ready(function() {
    loadLevel('rpjmd', 1, '');
    loadLevel('rkpd', 1, '');
    
    // DataTable
    if ($('#data-table-konsistensi').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-konsistensi')) {
                $('#data-table-konsistensi').DataTable().destroy();
            }
            $('#data-table-konsistensi').DataTable({
                "pageLength": 10,
                "ordering": false,
                "stateSave": false,
                "scrollX": true,
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
                }
            });
        } catch(e) { console.log("DataTable error:", e); }
    }
});

</script>
</body>
</html>