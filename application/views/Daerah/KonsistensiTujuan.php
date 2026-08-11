<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    /* ============================================================
       FILTER STYLE
       ============================================================ */
    .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
    .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
    .filter-group label { font-size:14px; margin-bottom:5px; }
    .filter-select { width:260px; font-size:14px; padding:5px 8px; }
    
    /* ============================================================
       TABEL KONSISTENSI TUJUAN/SASARAN - MULTIPLE ROWS INDIKATOR
       ============================================================ */
    .table-konsistensi-tujuan th {
        background: #f8f9fa;
        font-weight: 700;
        font-size: 10px;
        text-align: center;
        vertical-align: middle;
        padding: 6px 4px;
        border: 1px solid #dee2e6;
    }
    .table-konsistensi-tujuan td {
        vertical-align: middle;
        font-size: 11px;
        padding: 6px 8px;
        border: 1px solid #dee2e6;
    }
    
    /* ============================================================
       HIRARKI LEVEL
       ============================================================ */
    .level-tujuan {
        background-color: #e8f0fe !important;
        font-weight: 700;
        font-size: 13px;
    }
    .level-tujuan .row-label {
        font-weight: 700;
        color: #1a5276;
        padding-left: 5px;
    }
    .level-tujuan .no-display {
        font-weight: 700;
        color: #1a5276;
        font-size: 13px;
    }
    
    .level-sasaran {
        background-color: #f0f8ff !important;
        font-weight: 600;
        font-size: 12px;
    }
    .level-sasaran .row-label {
        font-weight: 600;
        color: #0c5460;
        padding-left: 30px !important;
    }
    .level-sasaran .no-display {
        font-weight: 600;
        color: #0c5460;
        font-size: 12px;
        padding-left: 15px;
    }
    
    .badge-tujuan {
        background: #007bff;
        color: #fff;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 600;
        margin-right: 5px;
    }
    .badge-sasaran {
        background: #28a745;
        color: #fff;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 600;
        margin-right: 5px;
    }
    
    /* ============================================================
       INDIKATOR ITEM - PER BARIS
       ============================================================ */
    .indikator-item {
        padding: 3px 0;
    }
    .indikator-item:not(:last-child) {
        border-bottom: 1px dashed #f0f0f0;
    }
    .indikator-item .ind-nama {
        display: block;
        font-size: 11px;
        color: #333;
    }
    
    .satuan-item {
        padding: 3px 0;
        font-size: 11px;
    }
    .satuan-item:not(:last-child) {
        border-bottom: 1px dashed #f0f0f0;
    }
    
    .target-item {
        padding: 3px 0;
        font-size: 11px;
        font-weight: 600;
    }
    .target-item:not(:last-child) {
        border-bottom: 1px dashed #f0f0f0;
    }
    
    /* ============================================================
       INDIKATOR ROW DI MODAL
       ============================================================ */
    .indikator-row {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        border: 1px solid #e9ecef;
        position: relative;
        transition: all 0.3s ease;
    }
    .indikator-row:hover {
        border-color: #17a2b8;
        box-shadow: 0 2px 8px rgba(23,162,184,0.15);
    }
    .indikator-row .btn { margin-top: 5px; }
    
    .indikator-counter-badge {
        display: inline-block;
        background: #17a2b8;
        color: #fff;
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        margin-left: 10px;
    }
    
    /* ============================================================
       MODAL
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
    .modal-lg-custom { max-width: 95%; width: 95%; }
    
    /* ============================================================
       TOMBOL AKSI
       ============================================================ */
    .btn-aksi-group {
        display: flex;
        flex-wrap: wrap;
        gap: 3px;
        justify-content: center;
        align-items: center;
    }
    .btn-aksi-group .btn {
        padding: 3px 6px;
        font-size: 11px;
        margin: 1px;
    }
    .btn-aksi-group .btn i {
        margin-right: 2px;
    }
    
    /* ============================================================
       PANEL RPJMD & RKPD
       ============================================================ */
    .panel-rpjmd .panel-heading {
        background: #007bff;
        color: #fff;
    }
    .panel-rkpd .panel-heading {
        background: #ffc107;
        color: #333;
    }
    
    /* ============================================================
       DROPDOWN FILTER
       ============================================================ */
    .filter-tujuan-sasaran {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    .filter-tujuan-sasaran label {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 0;
        color: #495057;
    }
    .filter-tujuan-sasaran select {
        width: 150px;
        height: 34px;
        font-size: 13px;
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid #ced4da;
    }
    
    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media (max-width: 768px) {
        .filter-row { flex-direction: column; gap: 15px; }
        .filter-select { width: 100%; }
        .table-konsistensi-tujuan td { font-size: 9px; padding: 4px 4px; }
        .level-sasaran .row-label { padding-left: 15px !important; }
        .btn-aksi-group { flex-direction: column; }
        .btn-aksi-group .btn { width: 100%; }
        .modal-lg-custom .modal-body .row .col-md-6 { margin-bottom: 15px; }
        .filter-tujuan-sasaran { flex-direction: column; align-items: stretch; }
        .filter-tujuan-sasaran select { width: 100%; }
        .indikator-row .row .col-md-6 { margin-bottom: 8px; }
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
                <br><strong>Tahun:</strong> <?= htmlspecialchars($TahunAktif) ?>
              </div>
            <?php } ?>

            <!-- ============================================================
            TOMBOL TAMBAH TUJUAN
            ============================================================ -->
            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                <button type="button" class="btn btn-success notika-btn-success" id="BtnTambahTujuan">
                  <i class="notika-icon bi-plus-lg"></i> <b>Tambah Tujuan</b>
                </button>
                <?php } ?>
              </div>
            </div>
            <br>

            <!-- ============================================================
            TABEL DATA - MULTIPLE ROWS INDIKATOR
            ============================================================ -->
            <div class="table-responsive">
              <table id="data-table" class="table table-striped table-bordered table-konsistensi-tujuan">
                <thead>
                  <tr>
                    <th style="width:50px; text-align:center;">NO.</th>
                    <th style="width:170px; text-align:center;">TUJUAN/SASARAN</th>
                    <th style="width:150px; text-align:center;">INDIKATOR</th>
                    <th style="width:70px; text-align:center;">SATUAN</th>
                    <th style="width:90px; text-align:center;">TARGET</th>
                    <th style="width:170px; text-align:center;">TUJUAN/SASARAN</th>
                    <th style="width:150px; text-align:center;">INDIKATOR</th>
                    <th style="width:70px; text-align:center;">SATUAN</th>
                    <th style="width:90px; text-align:center;">TARGET</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                    <th style="width:130px; text-align:center;">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($KonsistensiData)) { 
                    // ============================================================
                    // PENOMORAN HIERARKI: 1, 1.1, 1.2, 2, 2.1, 2.2, dst
                    // ============================================================
                    
                    // STEP 1: Pisahkan Tujuan dan Sasaran
                    $tujuanList = [];
                    $sasaranList = [];
                    $tujuanCounter = 0;
                    $tujuanMap = [];
                    
                    foreach ($KonsistensiData as $row) {
                        if ($row['level'] == 1) {
                            $tujuanCounter++;
                            $row['no_display'] = $tujuanCounter;
                            $row['tujuan_id'] = $row['id'];
                            $row['tujuan_rpjmd_id'] = $row['tujuan_rpjmd_id'] ?? null;
                            $tujuanList[] = $row;
                            $tujuanMap[$row['id']] = $tujuanCounter;
                        } else {
                            $sasaranList[] = $row;
                        }
                    }
                    
                    // STEP 2: Kelompokkan Sasaran berdasarkan Tujuan
                    $sasaranGrouped = [];
                    foreach ($sasaranList as $sasaran) {
                        $parentTujuanId = null;
                        $tujuanNomor = 0;
                        
                        // PRIORITAS 1: parent_tujuan_id
                        if (!empty($sasaran['parent_tujuan_id'])) {
                            $parentTujuanId = $sasaran['parent_tujuan_id'];
                        }
                        
                        // PRIORITAS 2: tujuan_rpjmd_id
                        if (!$parentTujuanId && !empty($sasaran['tujuan_rpjmd_id'])) {
                            foreach ($tujuanList as $tujuan) {
                                if ($tujuan['tujuan_rpjmd_id'] == $sasaran['tujuan_rpjmd_id']) {
                                    $parentTujuanId = $tujuan['id'];
                                    break;
                                }
                            }
                        }
                        
                        // PRIORITAS 3: sasaran_rpjmd_id
                        if (!$parentTujuanId && !empty($sasaran['sasaran_rpjmd_id'])) {
                            $sasaranData = $this->db
                                ->select('_Id as tujuan_id')
                                ->where('Id', $sasaran['sasaran_rpjmd_id'])
                                ->where('deleted_at IS NULL')
                                ->get('sasaranrpjmd')
                                ->row_array();
                            if ($sasaranData && !empty($sasaranData['tujuan_id'])) {
                                foreach ($tujuanList as $tujuan) {
                                    if ($tujuan['tujuan_rpjmd_id'] == $sasaranData['tujuan_id']) {
                                        $parentTujuanId = $tujuan['id'];
                                        break;
                                    }
                                }
                            }
                        }
                        
                        // Dapatkan nomor tujuan dari map
                        if ($parentTujuanId && isset($tujuanMap[$parentTujuanId])) {
                            $tujuanNomor = $tujuanMap[$parentTujuanId];
                        }
                        
                        // Skip jika tidak valid
                        if ($tujuanNomor == 0) continue;
                        
                        if (!isset($sasaranGrouped[$tujuanNomor])) {
                            $sasaranGrouped[$tujuanNomor] = [];
                        }
                        $sasaran['tujuan_nomor'] = $tujuanNomor;
                        $sasaranGrouped[$tujuanNomor][] = $sasaran;
                    }
                    
                    // STEP 3: Gabungkan data dengan multiple rows untuk indikator
                    $sortedData = [];
                    foreach ($tujuanList as $row) {
                        $row['is_tujuan'] = true;
                        
                        // Dapatkan detail indikator
                        $rpjmdDetails = $row['rpjmd_details'] ?? [];
                        $rkpdDetails = $row['rkpd_details'] ?? [];
                        $maxRows = max(count($rpjmdDetails), count($rkpdDetails), 1);
                        
                        // Tambahkan baris untuk setiap indikator
                        for ($i = 0; $i < $maxRows; $i++) {
                            $newRow = $row;
                            $newRow['rpjmd_detail'] = isset($rpjmdDetails[$i]) ? $rpjmdDetails[$i] : null;
                            $newRow['rkpd_detail'] = isset($rkpdDetails[$i]) ? $rkpdDetails[$i] : null;
                            $newRow['is_first'] = ($i == 0);
                            $newRow['rowspan'] = $maxRows;
                            $sortedData[] = $newRow;
                        }
                        
                        // Tambahkan sasaran di bawah tujuan
                        $tujuanNomor = $row['no_display'];
                        if (isset($sasaranGrouped[$tujuanNomor])) {
                            $sasaranCounter = 0;
                            foreach ($sasaranGrouped[$tujuanNomor] as $sasaran) {
                                $sasaranCounter++;
                                $sasaran['no_display'] = $tujuanNomor . '.' . $sasaranCounter;
                                $sasaran['is_tujuan'] = false;
                                
                                // Dapatkan detail indikator sasaran
                                $rpjmdDetailsS = $sasaran['rpjmd_details'] ?? [];
                                $rkpdDetailsS = $sasaran['rkpd_details'] ?? [];
                                $maxRowsS = max(count($rpjmdDetailsS), count($rkpdDetailsS), 1);
                                
                                for ($i = 0; $i < $maxRowsS; $i++) {
                                    $newSasaran = $sasaran;
                                    $newSasaran['rpjmd_detail'] = isset($rpjmdDetailsS[$i]) ? $rpjmdDetailsS[$i] : null;
                                    $newSasaran['rkpd_detail'] = isset($rkpdDetailsS[$i]) ? $rkpdDetailsS[$i] : null;
                                    $newSasaran['is_first'] = ($i == 0);
                                    $newSasaran['rowspan'] = $maxRowsS;
                                    $sortedData[] = $newSasaran;
                                }
                            }
                        }
                    }
                    
                    // STEP 4: Tampilkan data
                    foreach ($sortedData as $row) { 
                        $isTujuan = ($row['level'] == 1);
                        $levelClass = $isTujuan ? 'level-tujuan' : 'level-sasaran';
                        $badgeLevel = $isTujuan ? 'TUJUAN' : 'SASARAN';
                        $isFirst = $row['is_first'] ?? true;
                        $rowspan = $row['rowspan'] ?? 1;
                        
                        // Ambil teks RPJMD
                        $rpjmdText = '';
                        if ($isTujuan) {
                            if (!empty($row['tujuan_rpjmd_id'])) {
                                $tujuan = $this->db->where('Id', $row['tujuan_rpjmd_id'])->get('tujuanrpjmd')->row_array();
                                $rpjmdText = $tujuan ? $tujuan['Tujuan'] : $row['tujuan_rpjmd_text'];
                            } else {
                                $rpjmdText = $row['tujuan_rpjmd_text'] ?? '';
                            }
                        } else {
                            if (!empty($row['sasaran_rpjmd_id'])) {
                                $sasaran = $this->db->where('Id', $row['sasaran_rpjmd_id'])->get('sasaranrpjmd')->row_array();
                                $rpjmdText = $sasaran ? $sasaran['Sasaran'] : $row['sasaran_rpjmd_text'];
                            } else {
                                $rpjmdText = $row['sasaran_rpjmd_text'] ?? '';
                            }
                        }
                        
                        $rkpdText = $isTujuan ? ($row['tujuan_rkpd_text'] ?? '') : ($row['sasaran_rkpd_text'] ?? '');
                        
                        // Ambil detail indikator per baris
                        $rpjmdDetail = $row['rpjmd_detail'] ?? null;
                        $rkpdDetail = $row['rkpd_detail'] ?? null;
                    ?>
                      <tr class="<?= $levelClass ?>" data-id="<?= $row['id'] ?>" data-level="<?= $row['level'] ?>">
                        <!-- NO - hanya di baris pertama -->
                        <?php if ($isFirst) { ?>
                          <td rowspan="<?= $rowspan ?>" class="text-center no-display"><?= $row['no_display'] ?></td>
                        <?php } ?>
                        
                        <!-- RPJMD - hanya di baris pertama -->
                        <?php if ($isFirst) { ?>
                          <td rowspan="<?= $rowspan ?>" class="row-label">
                            <span class="badge-<?= $isTujuan ? 'tujuan' : 'sasaran' ?>"><?= $badgeLevel ?></span>
                            <?= nl2br(html_escape($rpjmdText)) ?>
                          </td>
                        <?php } ?>
                        
                        <!-- INDIKATOR RPJMD - per baris -->
                        <td class="text-indikator">
                          <?php if ($rpjmdDetail && !empty($rpjmdDetail['indikator'])): ?>
                            <div class="indikator-item">
                              <span class="ind-nama"><?= html_escape($rpjmdDetail['indikator']) ?></span>
                            </div>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                        
                        <!-- SATUAN RPJMD - per baris -->
                        <td>
                          <?php if ($rpjmdDetail && !empty($rpjmdDetail['satuan'])): ?>
                            <div class="satuan-item"><?= html_escape($rpjmdDetail['satuan']) ?></div>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                        
                        <!-- TARGET RPJMD - per baris -->
                        <td>
                          <?php if ($rpjmdDetail && !empty($rpjmdDetail['target'])): ?>
                            <div class="target-item"><?= html_escape($rpjmdDetail['target']) ?></div>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                        
                        <!-- RKPD - hanya di baris pertama -->
                        <?php if ($isFirst) { ?>
                          <td rowspan="<?= $rowspan ?>" class="row-label"><?= nl2br(html_escape($rkpdText)) ?></td>
                        <?php } ?>
                        
                        <!-- INDIKATOR RKPD - per baris -->
                        <td class="text-indikator">
                          <?php if ($rkpdDetail && !empty($rkpdDetail['indikator'])): ?>
                            <div class="indikator-item">
                              <span class="ind-nama"><?= html_escape($rkpdDetail['indikator']) ?></span>
                            </div>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                        
                        <!-- SATUAN RKPD - per baris -->
                        <td>
                          <?php if ($rkpdDetail && !empty($rkpdDetail['satuan'])): ?>
                            <div class="satuan-item"><?= html_escape($rkpdDetail['satuan']) ?></div>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                        
                        <!-- TARGET RKPD - per baris -->
                        <td>
                          <?php if ($rkpdDetail && !empty($rkpdDetail['target'])): ?>
                            <div class="target-item"><?= html_escape($rkpdDetail['target']) ?></div>
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                        
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <!-- AKSI - hanya di baris pertama -->
                        <?php if ($isFirst) { ?>
                          <td rowspan="<?= $rowspan ?>" class="text-center">
                            <div class="btn-aksi-group">
                              <?php if ($isTujuan) { ?>
                              <button class="btn btn-success btn-sm BtnTambahSasaran" 
                                      data-id="<?= $row['id'] ?>"
                                      data-no="<?= $row['no_display'] ?>"
                                      data-tujuan="<?= html_escape($rpjmdText) ?>"
                                      title="Tambah Sasaran">
                                <i class="fa fa-plus"></i> Sasaran
                              </button>
                              <?php } ?>
                              <button class="btn btn-warning btn-sm BtnEdit" 
                                      data-id="<?= $row['id'] ?>"
                                      title="Edit">
                                <i class="fa fa-edit"></i>
                              </button>
                              <button class="btn btn-danger btn-sm BtnHapus" 
                                      data-id="<?= $row['id'] ?>"
                                      title="Hapus">
                                <i class="fa fa-trash"></i>
                              </button>
                            </div>
                          </td>
                        <?php } ?>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td colspan="10" class="text-center" style="padding:30px;">
                      <i class="notika-icon notika-info" style="font-size:24px; display:block;"></i>
                      <span style="font-size:16px; color:#999;">Belum ada data</span>
                      <br><small class="text-muted">Klik tombol "Tambah Tujuan" untuk menambahkan data</small>
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
MODAL TAMBAH TUJUAN - 2 KOLOM (RPJMD KIRI | RKPD KANAN)
================================================================ -->
<div class="modal fade fixed-modal" id="ModalTambahTujuan" role="dialog">
  <div class="modal-dialog modal-lg-custom">
    <div class="modal-content">
      <div class="modal-header" style="background:#28a745; color:#fff;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        <h4><b><i class="notika-icon bi-plus-lg"></i> Tambah Tujuan</b></h4>
        <span id="TujuanIndikatorCounter" class="indikator-counter-badge">0 Indikator</span>
      </div>

      <div class="modal-body">
        <form id="FormTambahTujuan">

          <!-- Header: Tahun -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label><b>Tahun</b></label>
                <select name="tahun" class="form-control" id="TujuanTahun">
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

          <!-- 2 KOLOM: KIRI RPJMD | KANAN RKPD -->
          <div class="row">
            
            <!-- KOLOM KIRI: RPJMD -->
            <div class="col-md-6">
              <div class="panel panel-primary panel-rpjmd">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 RPJMD</b></h4>
                </div>
                <div class="panel-body">
                  
                  <!-- Dropdown Pilih dari Data RPJMD -->
                  <div class="form-group">
                    <label><b>Pilih dari Data RPJMD</b></label>
                    <select class="form-control" id="TujuanRpjmdDropdown">
                      <option value="">-- Pilih Tujuan --</option>
                      <?php foreach ($ListTujuan as $tujuan) { ?>
                        <option value="<?= $tujuan['Id'] ?>"><?= html_escape($tujuan['Tujuan']) ?></option>
                      <?php } ?>
                    </select>
                    <small class="text-muted">Atau isi manual di bawah</small>
                  </div>
                  
                  <!-- Manual -->
                  <div class="form-group">
                    <label><b>Atau Isi Manual</b></label>
                    <textarea id="TujuanRpjmdText" class="form-control" rows="2" placeholder="Isi Tujuan RPJMD"></textarea>
                  </div>
                  
                  <!-- Indikator RPJMD - MULTIPLE ROWS -->
                  <div class="form-group" style="margin-top:10px;">
                    <label><b>Indikator, Satuan, dan Target</b></label>
                    <div id="TujuanIndikatorWrapperRpjmd">
                      <div class="indikator-row">
                        <input type="text" name="indikator_rpjmd[]" class="form-control" placeholder="Indikator" style="margin-bottom:5px;">
                        <div class="row" style="margin-top:5px;">
                          <div class="col-md-6">
                            <input type="text" name="satuan_rpjmd[]" class="form-control" placeholder="Satuan">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="target_rpjmd[]" class="form-control" placeholder="Target">
                          </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                          <i class="fa fa-trash"></i> Hapus
                        </button>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorTujuanRpjmd" style="margin-top:5px;">
                      <i class="fa fa-plus"></i> Tambah Indikator RPJMD
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- KOLOM KANAN: RKPD -->
            <div class="col-md-6">
              <div class="panel panel-warning panel-rkpd">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 RKPD</b></h4>
                </div>
                <div class="panel-body">
                  
                  <!-- Tujuan RKPD -->
                  <div class="form-group">
                    <label><b>Tujuan RKPD</b></label>
                    <textarea id="TujuanRkpdText" class="form-control" rows="2" placeholder="Isi Tujuan RKPD"></textarea>
                  </div>
                  
                  <!-- Indikator RKPD - MULTIPLE ROWS -->
                  <div class="form-group" style="margin-top:10px;">
                    <label><b>Indikator, Satuan, dan Target</b></label>
                    <div id="TujuanIndikatorWrapperRkpd">
                      <div class="indikator-row">
                        <input type="text" name="indikator_rkpd[]" class="form-control" placeholder="Indikator" style="margin-bottom:5px;">
                        <div class="row" style="margin-top:5px;">
                          <div class="col-md-6">
                            <input type="text" name="satuan_rkpd[]" class="form-control" placeholder="Satuan">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="target_rkpd[]" class="form-control" placeholder="Target">
                          </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                          <i class="fa fa-trash"></i> Hapus
                        </button>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorTujuanRkpd" style="margin-top:5px;">
                      <i class="fa fa-plus"></i> Tambah Indikator RKPD
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- KETERANGAN -->
          <div class="form-group" style="margin-top:10px;">
            <label><b>Keterangan</b></label>
            <textarea id="TujuanKeterangan" class="form-control" rows="2" placeholder="Keterangan..."></textarea>
          </div>

          <!-- TOMBOL -->
          <div style="display:flex; justify-content:center; gap:10px; margin-top:15px;">
            <button type="button" class="btn btn-success" id="BtnSimpanTujuan"><b>SIMPAN</b></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- ================================================================
MODAL TAMBAH SASARAN - 2 KOLOM (RPJMD KIRI | RKPD KANAN)
================================================================ -->
<div class="modal fade fixed-modal" id="ModalTambahSasaran" role="dialog">
  <div class="modal-dialog modal-lg-custom">
    <div class="modal-content">
      <div class="modal-header" style="background:#28a745; color:#fff;">
        <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
        <h4><b><i class="notika-icon bi-plus-lg"></i> Tambah Sasaran</b></h4>
        <span id="SasaranIndikatorCounter" class="indikator-counter-badge">0 Indikator</span>
        <small style="color:#fff; display:block; margin-top:5px;" id="SasaranParentInfo">Untuk Tujuan: </small>
      </div>

      <div class="modal-body">
        <form id="FormTambahSasaran">
          <input type="hidden" id="SasaranParentId" value="">

          <!-- Header: Tahun -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label><b>Tahun</b></label>
                <select name="tahun" class="form-control" id="SasaranTahun">
                  <?php for ($y = date('Y'); $y >= date('Y')-10; $y--) { ?>
                    <option value="<?= $y ?>" <?= ($TahunAktif == $y) ? 'selected' : '' ?>>
                      <?= $y ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- 2 KOLOM: KIRI RPJMD | KANAN RKPD -->
          <div class="row">
            
            <!-- KOLOM KIRI: RPJMD -->
            <div class="col-md-6">
              <div class="panel panel-primary panel-rpjmd">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 RPJMD</b></h4>
                </div>
                <div class="panel-body">
                  
                  <!-- Dropdown Filter - Disabled karena hanya Sasaran -->
                  <div class="filter-tujuan-sasaran">
                    <label><b>Filter:</b></label>
                    <select id="SasaranFilterRpjmd" class="form-control" disabled>
                      <option value="2" selected>Sasaran</option>
                    </select>
                    <small class="text-muted" style="margin-left:5px;">Hanya menampilkan data Sasaran</small>
                  </div>
                  
                  <!-- Dropdown Pilih dari Data RPJMD -->
                  <div class="form-group">
                    <label><b>Pilih dari Data RPJMD</b></label>
                    <select class="form-control" id="SasaranRpjmdDropdown">
                      <option value="">-- Pilih Sasaran --</option>
                      <?php foreach ($ListSasaran as $sasaran) { ?>
                        <option value="<?= $sasaran['Id'] ?>">
                          <?= html_escape($sasaran['Sasaran']) ?>
                        </option>
                      <?php } ?>
                    </select>
                    <small class="text-muted">Pilih sasaran dari daftar atau isi manual di bawah</small>
                  </div>
                  
                  <!-- Manual -->
                  <div class="form-group">
                    <label><b>Atau Isi Manual</b></label>
                    <textarea id="SasaranRpjmdText" class="form-control" rows="2" placeholder="Isi Sasaran RPJMD"></textarea>
                  </div>
                  
                  <!-- Indikator RPJMD - MULTIPLE ROWS -->
                  <div class="form-group" style="margin-top:10px;">
                    <label><b>Indikator, Satuan, dan Target</b></label>
                    <div id="SasaranIndikatorWrapperRpjmd">
                      <div class="indikator-row">
                        <input type="text" name="indikator_rpjmd[]" class="form-control" placeholder="Indikator" style="margin-bottom:5px;">
                        <div class="row" style="margin-top:5px;">
                          <div class="col-md-6">
                            <input type="text" name="satuan_rpjmd[]" class="form-control" placeholder="Satuan">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="target_rpjmd[]" class="form-control" placeholder="Target">
                          </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                          <i class="fa fa-trash"></i> Hapus
                        </button>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorSasaranRpjmd" style="margin-top:5px;">
                      <i class="fa fa-plus"></i> Tambah Indikator RPJMD
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- KOLOM KANAN: RKPD -->
            <div class="col-md-6">
              <div class="panel panel-warning panel-rkpd">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 RKPD</b></h4>
                </div>
                <div class="panel-body">
                  
                  <!-- Sasaran RKPD -->
                  <div class="form-group">
                    <label><b>Sasaran RKPD</b></label>
                    <textarea id="SasaranRkpdText" class="form-control" rows="2" placeholder="Isi Sasaran RKPD"></textarea>
                  </div>
                  
                  <!-- Indikator RKPD - MULTIPLE ROWS -->
                  <div class="form-group" style="margin-top:10px;">
                    <label><b>Indikator, Satuan, dan Target</b></label>
                    <div id="SasaranIndikatorWrapperRkpd">
                      <div class="indikator-row">
                        <input type="text" name="indikator_rkpd[]" class="form-control" placeholder="Indikator" style="margin-bottom:5px;">
                        <div class="row" style="margin-top:5px;">
                          <div class="col-md-6">
                            <input type="text" name="satuan_rkpd[]" class="form-control" placeholder="Satuan">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="target_rkpd[]" class="form-control" placeholder="Target">
                          </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                          <i class="fa fa-trash"></i> Hapus
                        </button>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorSasaranRkpd" style="margin-top:5px;">
                      <i class="fa fa-plus"></i> Tambah Indikator RKPD
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- KETERANGAN -->
          <div class="form-group" style="margin-top:10px;">
            <label><b>Keterangan</b></label>
            <textarea id="SasaranKeterangan" class="form-control" rows="2" placeholder="Keterangan..."></textarea>
          </div>

          <!-- TOMBOL -->
          <div style="display:flex; justify-content:center; gap:10px; margin-top:15px;">
            <button type="button" class="btn btn-success" id="BtnSimpanSasaran"><b>SIMPAN</b></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- ================================================================
MODAL EDIT - 2 KOLOM (RPJMD KIRI | RKPD KANAN)
================================================================ -->
<div class="modal fade fixed-modal" id="ModalEdit" role="dialog">
  <div class="modal-dialog modal-lg-custom">
    <div class="modal-content">
      <div class="modal-header" style="background:#ffc107; color:#333;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b><i class="notika-icon notika-edit"></i> Edit Konsistensi</b></h4>
        <span id="EditIndikatorCounter" class="indikator-counter-badge">0 Indikator</span>
      </div>

      <div class="modal-body">
        <form id="FormEdit">
          <input type="hidden" name="id" id="EditId">
          <input type="hidden" name="level" id="EditLevel">
          <input type="hidden" name="parent_tujuan_id" id="EditParentTujuanId">

          <!-- Header: Tahun -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label><b>Tahun</b></label>
                <select name="tahun" class="form-control" id="EditTahun">
                  <?php for ($y = date('Y'); $y >= date('Y')-10; $y--) { ?>
                    <option value="<?= $y ?>"><?= $y ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- 2 KOLOM: KIRI RPJMD | KANAN RKPD -->
          <div class="row">
            
            <!-- KOLOM KIRI: RPJMD -->
            <div class="col-md-6">
              <div class="panel panel-primary panel-rpjmd">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 RPJMD</b></h4>
                </div>
                <div class="panel-body">
                  
                  <!-- Dropdown Filter Tujuan/Sasaran -->
                  <div class="filter-tujuan-sasaran">
                    <label><b>Filter:</b></label>
                    <select id="EditFilterRpjmd" class="form-control">
                      <option value="1">Tujuan</option>
                      <option value="2">Sasaran</option>
                    </select>
                    <small class="text-muted" style="margin-left:5px;">Pilih jenis data RPJMD</small>
                  </div>
                  
                  <!-- Dropdown Pilih dari Data RPJMD -->
                  <div class="form-group">
                    <label><b>Pilih dari Data RPJMD</b></label>
                    <select class="form-control" id="EditRpjmdDropdown">
                      <option value="">-- Pilih --</option>
                    </select>
                    <small class="text-muted">Data akan berubah sesuai filter</small>
                  </div>
                  
                  <!-- Manual -->
                  <div class="form-group">
                    <label><b>Atau Isi Manual</b></label>
                    <textarea id="EditRpjmdText" class="form-control" rows="2" placeholder="Isi Tujuan/Sasaran RPJMD"></textarea>
                  </div>
                  
                  <!-- Indikator RPJMD - DENGAN TOMBOL TAMBAH -->
                  <div class="form-group" style="margin-top:10px;">
                    <label><b>Indikator, Satuan, dan Target</b></label>
                    <div id="EditIndikatorWrapperRpjmd">
                      <!-- Indikator rows akan diisi oleh JavaScript -->
                    </div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorEditRpjmd" style="margin-top:5px;">
                      <i class="fa fa-plus"></i> Tambah Indikator RPJMD
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- KOLOM KANAN: RKPD -->
            <div class="col-md-6">
              <div class="panel panel-warning panel-rkpd">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>📋 RKPD</b></h4>
                </div>
                <div class="panel-body">
                  
                  <!-- Tujuan/Sasaran RKPD -->
                  <div class="form-group">
                    <label><b>Tujuan/Sasaran RKPD</b></label>
                    <textarea id="EditRkpdText" class="form-control" rows="2" placeholder="Isi Tujuan/Sasaran RKPD"></textarea>
                  </div>
                  
                  <!-- Indikator RKPD - DENGAN TOMBOL TAMBAH -->
                  <div class="form-group" style="margin-top:10px;">
                    <label><b>Indikator, Satuan, dan Target</b></label>
                    <div id="EditIndikatorWrapperRkpd">
                      <!-- Indikator rows akan diisi oleh JavaScript -->
                    </div>
                    <button type="button" class="btn btn-success btn-sm BtnAddIndikatorEditRkpd" style="margin-top:5px;">
                      <i class="fa fa-plus"></i> Tambah Indikator RKPD
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- KETERANGAN -->
          <div class="form-group" style="margin-top:10px;">
            <label><b>Keterangan</b></label>
            <textarea id="EditKeterangan" class="form-control" rows="2"></textarea>
          </div>

          <!-- TOMBOL -->
          <div style="display:flex; justify-content:center; gap:10px; margin-top:15px;">
            <button type="button" class="btn btn-success" id="BtnUpdate"><b>UPDATE</b></button>
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
// KONFIGURASI
// ============================================================
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var KODE_WILAYAH = '<?= addslashes($KodeWilayah ?? '') ?>';
var LIST_TUJUAN = <?= json_encode($ListTujuan ?? []) ?>;
var LIST_SASARAN = <?= json_encode($ListSasaran ?? []) ?>;

// ============================================================
// HELPERS
// ============================================================
function escapeHtml(text) {
    if (!text) return '';
    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// ============================================================
// FUNGSI CREATE INDIKATOR ROW
// ============================================================
function createIndikatorRow(type, data) {
    data = data || {};
    
    var row = `
        <div class="indikator-row">
            <input type="text" name="indikator_${type}[]" class="form-control" 
                   value="${escapeHtml(data.indikator || '')}" 
                   placeholder="Indikator" style="margin-bottom:5px;">
            <div class="row" style="margin-top:5px;">
                <div class="col-md-6">
                    <input type="text" name="satuan_${type}[]" class="form-control" 
                           value="${escapeHtml(data.satuan || '')}" placeholder="Satuan">
                </div>
                <div class="col-md-6">
                    <input type="text" name="target_${type}[]" class="form-control" 
                           value="${escapeHtml(data.target || '')}" placeholder="Target">
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm BtnRemoveIndikator" style="margin-top:5px;">
                <i class="fa fa-trash"></i> Hapus
            </button>
        </div>
    `;
    return row;
}

// ============================================================
// UPDATE COUNTER BADGE
// ============================================================
function updateIndikatorCounter(containerSelector, counterSelector) {
    var count = $(containerSelector + ' .indikator-row').length;
    $(counterSelector).text(count + ' Indikator');
}

// ============================================================
// INDIKATOR ROW MANAGEMENT - TUJUAN TAMBAH
// ============================================================
$(document).on('click', '.BtnAddIndikatorTujuanRpjmd', function() {
    var wrapper = '#TujuanIndikatorWrapperRpjmd';
    var newRow = createIndikatorRow('rpjmd');
    $(wrapper).append(newRow);
    updateIndikatorCounter('#TujuanIndikatorWrapperRpjmd', '#TujuanIndikatorCounter');
});

$(document).on('click', '.BtnAddIndikatorTujuanRkpd', function() {
    var wrapper = '#TujuanIndikatorWrapperRkpd';
    var newRow = createIndikatorRow('rkpd');
    $(wrapper).append(newRow);
    updateIndikatorCounter('#TujuanIndikatorWrapperRkpd', '#TujuanIndikatorCounter');
});

// ============================================================
// INDIKATOR ROW MANAGEMENT - SASARAN TAMBAH
// ============================================================
$(document).on('click', '.BtnAddIndikatorSasaranRpjmd', function() {
    var wrapper = '#SasaranIndikatorWrapperRpjmd';
    var newRow = createIndikatorRow('rpjmd');
    $(wrapper).append(newRow);
    updateIndikatorCounter('#SasaranIndikatorWrapperRpjmd', '#SasaranIndikatorCounter');
});

$(document).on('click', '.BtnAddIndikatorSasaranRkpd', function() {
    var wrapper = '#SasaranIndikatorWrapperRkpd';
    var newRow = createIndikatorRow('rkpd');
    $(wrapper).append(newRow);
    updateIndikatorCounter('#SasaranIndikatorWrapperRkpd', '#SasaranIndikatorCounter');
});

// ============================================================
// INDIKATOR ROW MANAGEMENT - EDIT TAMBAH
// ============================================================
$(document).on('click', '.BtnAddIndikatorEditRpjmd', function() {
    var wrapper = '#EditIndikatorWrapperRpjmd';
    var newRow = createIndikatorRow('rpjmd');
    $(wrapper).append(newRow);
    updateIndikatorCounter('#EditIndikatorWrapperRpjmd', '#EditIndikatorCounter');
});

$(document).on('click', '.BtnAddIndikatorEditRkpd', function() {
    var wrapper = '#EditIndikatorWrapperRkpd';
    var newRow = createIndikatorRow('rkpd');
    $(wrapper).append(newRow);
    updateIndikatorCounter('#EditIndikatorWrapperRkpd', '#EditIndikatorCounter');
});

// ============================================================
// INDIKATOR ROW MANAGEMENT - HAPUS
// ============================================================
$(document).on('click', '.BtnRemoveIndikator', function() {
    var row = $(this).closest('.indikator-row');
    var container = row.closest('div[id$="IndikatorWrapperRpjmd"], div[id$="IndikatorWrapperRkpd"]');
    row.remove();
    var counterSelector = container.closest('.modal-body').find('.indikator-counter-badge');
    updateIndikatorCounter('#' + container.attr('id'), counterSelector);
});

// ============================================================
// DROPDOWN TUJUAN - ISI MANUAL TEXT
// ============================================================
$('#TujuanRpjmdDropdown').change(function() {
    var val = $(this).val();
    if (val) {
        var found = $.grep(LIST_TUJUAN, function(item) { return item.Id == val; });
        if (found.length > 0) {
            $('#TujuanRpjmdText').val(found[0].Tujuan);
        }
    }
});

// ============================================================
// DROPDOWN SASARAN - ISI MANUAL TEXT
// ============================================================
$('#SasaranRpjmdDropdown').change(function() {
    var val = $(this).val();
    if (val) {
        var found = $.grep(LIST_SASARAN, function(item) { return item.Id == val; });
        if (found.length > 0) {
            $('#SasaranRpjmdText').val(found[0].Sasaran);
        }
    }
});

// ============================================================
// TAMBAH TUJUAN - OPEN MODAL
// ============================================================
$('#BtnTambahTujuan').click(function() {
    // Reset form
    $('#TujuanTahun').val('<?= $TahunAktif ?>');
    $('#TujuanRpjmdDropdown').val('');
    $('#TujuanRpjmdText').val('');
    $('#TujuanRkpdText').val('');
    $('#TujuanKeterangan').val('');
    
    // Reset indikator wrapper - 1 row default
    $('#TujuanIndikatorWrapperRpjmd').html(createIndikatorRow('rpjmd'));
    $('#TujuanIndikatorWrapperRkpd').html(createIndikatorRow('rkpd'));
    updateIndikatorCounter('#TujuanIndikatorWrapperRpjmd', '#TujuanIndikatorCounter');
    updateIndikatorCounter('#TujuanIndikatorWrapperRkpd', '#TujuanIndikatorCounter');
    
    $('#ModalTambahTujuan').modal({
        backdrop: 'static',
        keyboard: false
    });
});

// ============================================================
// SIMPAN TUJUAN
// ============================================================
$('#BtnSimpanTujuan').click(function() {
    var btn = $(this);
    btn.prop('disabled', true).text('Menyimpan...');
    
    var idRpjmd = $('#TujuanRpjmdDropdown').val();
    var rpjmdText = $('#TujuanRpjmdText').val().trim();
    var rkpdText = $('#TujuanRkpdText').val().trim();
    var tahun = $('#TujuanTahun').val();
    var keterangan = $('#TujuanKeterangan').val();
    
    if (!rpjmdText && !idRpjmd) {
        alert('Tujuan RPJMD harus diisi!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    if (!rkpdText) {
        alert('Tujuan RKPD harus diisi!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    
    // Kumpulkan indikator RPJMD
    var indikatorRpjmd = [], satuanRpjmd = [], targetRpjmd = [];
    $('#TujuanIndikatorWrapperRpjmd .indikator-row').each(function() {
        var ind = $(this).find('input[name="indikator_rpjmd[]"]').val();
        if (ind && ind.trim() !== '') {
            indikatorRpjmd.push(ind.trim());
            satuanRpjmd.push($(this).find('input[name="satuan_rpjmd[]"]').val() || '');
            targetRpjmd.push($(this).find('input[name="target_rpjmd[]"]').val() || '');
        }
    });
    
    // Kumpulkan indikator RKPD
    var indikatorRkpd = [], satuanRkpd = [], targetRkpd = [];
    $('#TujuanIndikatorWrapperRkpd .indikator-row').each(function() {
        var ind = $(this).find('input[name="indikator_rkpd[]"]').val();
        if (ind && ind.trim() !== '') {
            indikatorRkpd.push(ind.trim());
            satuanRkpd.push($(this).find('input[name="satuan_rkpd[]"]').val() || '');
            targetRkpd.push($(this).find('input[name="target_rkpd[]"]').val() || '');
        }
    });
    
    if (indikatorRpjmd.length === 0 && indikatorRkpd.length === 0) {
        alert('Minimal tambahkan 1 indikator!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    
    var payload = {
        id_rpjmd: idRpjmd || 0,
        rpjmd_text: rpjmdText,
        rkpd_text: rkpdText,
        tahun: tahun,
        keterangan: keterangan,
        indikator_rpjmd: indikatorRpjmd,
        satuan_rpjmd: satuanRpjmd,
        target_rpjmd: targetRpjmd,
        indikator_rkpd: indikatorRkpd,
        satuan_rkpd: satuanRkpd,
        target_rkpd: targetRkpd,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $.ajax({
        url: BaseURL + "Daerah/InputTujuanKonsistensi",
        type: "POST",
        data: payload,
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                alert(res.message);
                window.location.reload();
            } else {
                alert(res.message || 'Gagal menyimpan!');
            }
            btn.prop('disabled', false).text('SIMPAN');
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
            btn.prop('disabled', false).text('SIMPAN');
        }
    });
});

// ============================================================
// TAMBAH SASARAN - OPEN MODAL
// ============================================================
$(document).on('click', '.BtnTambahSasaran', function() {
    var parentId = $(this).data('id');
    var parentNo = $(this).data('no');
    var parentTujuan = $(this).data('tujuan');
    
    $('#SasaranParentId').val(parentId);
    $('#SasaranParentInfo').html('Untuk Tujuan: <strong>' + parentNo + '. ' + escapeHtml(parentTujuan) + '</strong>');
    
    $('#SasaranTahun').val('<?= $TahunAktif ?>');
    $('#SasaranRpjmdDropdown').val('');
    $('#SasaranRpjmdText').val('');
    $('#SasaranRkpdText').val('');
    $('#SasaranKeterangan').val('');
    
    $('#SasaranIndikatorWrapperRpjmd').html(createIndikatorRow('rpjmd'));
    $('#SasaranIndikatorWrapperRkpd').html(createIndikatorRow('rkpd'));
    updateIndikatorCounter('#SasaranIndikatorWrapperRpjmd', '#SasaranIndikatorCounter');
    updateIndikatorCounter('#SasaranIndikatorWrapperRkpd', '#SasaranIndikatorCounter');
    
    $('#ModalTambahSasaran').modal({
        backdrop: 'static',
        keyboard: false
    });
});

// ============================================================
// SIMPAN SASARAN
// ============================================================
$('#BtnSimpanSasaran').click(function() {
    var btn = $(this);
    btn.prop('disabled', true).text('Menyimpan...');
    
    var parentId = $('#SasaranParentId').val();
    var idRpjmd = $('#SasaranRpjmdDropdown').val();
    var rpjmdText = $('#SasaranRpjmdText').val().trim();
    var rkpdText = $('#SasaranRkpdText').val().trim();
    var tahun = $('#SasaranTahun').val();
    var keterangan = $('#SasaranKeterangan').val();
    
    if (!parentId) {
        alert('Tujuan induk tidak valid!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    if (!rpjmdText && !idRpjmd) {
        alert('Sasaran RPJMD harus diisi!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    if (!rkpdText) {
        alert('Sasaran RKPD harus diisi!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    
    var indikatorRpjmd = [], satuanRpjmd = [], targetRpjmd = [];
    $('#SasaranIndikatorWrapperRpjmd .indikator-row').each(function() {
        var ind = $(this).find('input[name="indikator_rpjmd[]"]').val();
        if (ind && ind.trim() !== '') {
            indikatorRpjmd.push(ind.trim());
            satuanRpjmd.push($(this).find('input[name="satuan_rpjmd[]"]').val() || '');
            targetRpjmd.push($(this).find('input[name="target_rpjmd[]"]').val() || '');
        }
    });
    
    var indikatorRkpd = [], satuanRkpd = [], targetRkpd = [];
    $('#SasaranIndikatorWrapperRkpd .indikator-row').each(function() {
        var ind = $(this).find('input[name="indikator_rkpd[]"]').val();
        if (ind && ind.trim() !== '') {
            indikatorRkpd.push(ind.trim());
            satuanRkpd.push($(this).find('input[name="satuan_rkpd[]"]').val() || '');
            targetRkpd.push($(this).find('input[name="target_rkpd[]"]').val() || '');
        }
    });
    
    if (indikatorRpjmd.length === 0 && indikatorRkpd.length === 0) {
        alert('Minimal tambahkan 1 indikator!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    
    var payload = {
        parent_tujuan_id: parentId,
        id_rpjmd: idRpjmd || 0,
        rpjmd_text: rpjmdText,
        rkpd_text: rkpdText,
        tahun: tahun,
        keterangan: keterangan,
        indikator_rpjmd: indikatorRpjmd,
        satuan_rpjmd: satuanRpjmd,
        target_rpjmd: targetRpjmd,
        indikator_rkpd: indikatorRkpd,
        satuan_rkpd: satuanRkpd,
        target_rkpd: targetRkpd,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $.ajax({
        url: BaseURL + "Daerah/InputSasaranKonsistensi",
        type: "POST",
        data: payload,
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                alert(res.message);
                window.location.reload();
            } else {
                alert(res.message || 'Gagal menyimpan!');
            }
            btn.prop('disabled', false).text('SIMPAN');
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
            btn.prop('disabled', false).text('SIMPAN');
        }
    });
});

// ============================================================
// FUNGSI UPDATE DROPDOWN EDIT
// ============================================================
function updateEditDropdown(level, selectedId) {
    var dropdown = $('#EditRpjmdDropdown');
    var data = (level == 1) ? LIST_TUJUAN : LIST_SASARAN;
    
    dropdown.html('<option value="">-- Pilih --</option>');
    
    if (data && data.length > 0) {
        if (level == 1) {
            $.each(data, function(i, item) {
                var selected = (item.Id == selectedId) ? 'selected' : '';
                dropdown.append('<option value="' + item.Id + '" ' + selected + '>' + escapeHtml(item.Tujuan) + '</option>');
            });
        } else {
            $.each(data, function(i, item) {
                var selected = (item.Id == selectedId) ? 'selected' : '';
                dropdown.append('<option value="' + item.Id + '" ' + selected + '>' + escapeHtml(item.Sasaran) + '</option>');
            });
        }
    }
    
    var labelText = (level == 1) ? 'Pilih dari Data RPJMD (Tujuan)' : 'Pilih dari Data RPJMD (Sasaran)';
    dropdown.closest('.form-group').find('label').html('<b>' + labelText + '</b>');
}

// ============================================================
// EDIT - OPEN MODAL
// ============================================================
$(document).on('click', '.BtnEdit', function() {
    var id = $(this).data('id');
    if (!id) return;
    
    $('#EditId').val('');
    $('#EditLevel').val('');
    $('#EditParentTujuanId').val('');
    $('#EditTahun').val('<?= $TahunAktif ?>');
    $('#EditRpjmdText').val('');
    $('#EditRkpdText').val('');
    $('#EditKeterangan').val('');
    $('#EditFilterRpjmd').val(1);
    
    $('#EditIndikatorWrapperRpjmd').html('');
    $('#EditIndikatorWrapperRkpd').html('');
    
    $.ajax({
        url: BaseURL + "Daerah/GetKonsistensiTujuanById",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success' && res.data) {
                var d = res.data;
                
                $('#EditId').val(d.id);
                $('#EditLevel').val(d.level);
                $('#EditParentTujuanId').val(d.parent_tujuan_id || '');
                $('#EditTahun').val(d.tahun || '');
                $('#EditRpjmdText').val(d.rpjmd_text || '');
                $('#EditRkpdText').val(d.rkpd_text || '');
                $('#EditKeterangan').val(d.keterangan || '');
                
                $('#EditFilterRpjmd').val(d.level);
                updateEditDropdown(d.level, d.rpjmd_id);
                
                // RENDER INDIKATOR RPJMD
                var rpjmdDetails = d.rpjmd_details || [];
                if (rpjmdDetails.length > 0) {
                    $('#EditIndikatorWrapperRpjmd').html('');
                    $.each(rpjmdDetails, function(i, item) {
                        var row = createIndikatorRow('rpjmd', {
                            indikator: item.indikator || '',
                            satuan: item.satuan || '',
                            target: item.target || ''
                        });
                        $('#EditIndikatorWrapperRpjmd').append(row);
                    });
                } else {
                    $('#EditIndikatorWrapperRpjmd').html(createIndikatorRow('rpjmd'));
                }
                
                // RENDER INDIKATOR RKPD
                var rkpdDetails = d.rkpd_details || [];
                if (rkpdDetails.length > 0) {
                    $('#EditIndikatorWrapperRkpd').html('');
                    $.each(rkpdDetails, function(i, item) {
                        var row = createIndikatorRow('rkpd', {
                            indikator: item.indikator || '',
                            satuan: item.satuan || '',
                            target: item.target || ''
                        });
                        $('#EditIndikatorWrapperRkpd').append(row);
                    });
                } else {
                    $('#EditIndikatorWrapperRkpd').html(createIndikatorRow('rkpd'));
                }
                
                updateIndikatorCounter('#EditIndikatorWrapperRpjmd', '#EditIndikatorCounter');
                updateIndikatorCounter('#EditIndikatorWrapperRkpd', '#EditIndikatorCounter');
                
                $('#ModalEdit').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                
            } else {
                alert(res.message || 'Gagal mengambil data!');
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

// ============================================================
// EVENT FILTER CHANGE DI EDIT
// ============================================================
$('#EditFilterRpjmd').change(function() {
    var level = $(this).val();
    var selectedId = $('#EditRpjmdDropdown').val();
    updateEditDropdown(level, selectedId);
    $('#EditRpjmdText').val('');
});

// ============================================================
// DROPDOWN SELECT - ISI MANUAL TEXT DI EDIT
// ============================================================
$('#EditRpjmdDropdown').change(function() {
    var val = $(this).val();
    var level = parseInt($('#EditFilterRpjmd').val());
    if (val) {
        var data = (level == 1) ? LIST_TUJUAN : LIST_SASARAN;
        var found = $.grep(data, function(item) { return item.Id == val; });
        if (found.length > 0) {
            var text = (level == 1) ? found[0].Tujuan : found[0].Sasaran;
            $('#EditRpjmdText').val(text);
        }
    }
});

// ============================================================
// UPDATE
// ============================================================
$('#BtnUpdate').click(function() {
    var id = $('#EditId').val();
    if (!id) { alert('ID tidak valid!'); return; }
    
    var btn = $(this);
    btn.prop('disabled', true).text('Menyimpan...');
    
    var level = parseInt($('#EditLevel').val());
    var idRpjmd = $('#EditRpjmdDropdown').val();
    var rpjmdText = $('#EditRpjmdText').val().trim();
    var rkpdText = $('#EditRkpdText').val().trim();
    var tahun = $('#EditTahun').val();
    var keterangan = $('#EditKeterangan').val();
    var parentTujuanId = $('#EditParentTujuanId').val();
    
    if (idRpjmd) {
        var data = (level == 1) ? LIST_TUJUAN : LIST_SASARAN;
        var found = $.grep(data, function(item) { return item.Id == idRpjmd; });
        if (found.length > 0) {
            rpjmdText = (level == 1) ? found[0].Tujuan : found[0].Sasaran;
        }
    }
    
    if (!rpjmdText) {
        alert('Tujuan/Sasaran RPJMD harus diisi!');
        btn.prop('disabled', false).text('UPDATE');
        return;
    }
    if (!rkpdText) {
        alert('Tujuan/Sasaran RKPD harus diisi!');
        btn.prop('disabled', false).text('UPDATE');
        return;
    }
    
    var indikatorRpjmd = [], satuanRpjmd = [], targetRpjmd = [];
    $('#EditIndikatorWrapperRpjmd .indikator-row').each(function() {
        var ind = $(this).find('input[name="indikator_rpjmd[]"]').val();
        if (ind && ind.trim() !== '') {
            indikatorRpjmd.push(ind.trim());
            satuanRpjmd.push($(this).find('input[name="satuan_rpjmd[]"]').val() || '');
            targetRpjmd.push($(this).find('input[name="target_rpjmd[]"]').val() || '');
        }
    });
    
    var indikatorRkpd = [], satuanRkpd = [], targetRkpd = [];
    $('#EditIndikatorWrapperRkpd .indikator-row').each(function() {
        var ind = $(this).find('input[name="indikator_rkpd[]"]').val();
        if (ind && ind.trim() !== '') {
            indikatorRkpd.push(ind.trim());
            satuanRkpd.push($(this).find('input[name="satuan_rkpd[]"]').val() || '');
            targetRkpd.push($(this).find('input[name="target_rkpd[]"]').val() || '');
        }
    });
    
    if (indikatorRpjmd.length === 0 && indikatorRkpd.length === 0) {
        alert('Minimal tambahkan 1 indikator!');
        btn.prop('disabled', false).text('UPDATE');
        return;
    }
    
    var payload = {
        id: id,
        id_rpjmd: idRpjmd || 0,
        rpjmd_text: rpjmdText,
        rkpd_text: rkpdText,
        tahun: tahun,
        keterangan: keterangan,
        parent_tujuan_id: parentTujuanId,
        indikator_rpjmd: indikatorRpjmd,
        satuan_rpjmd: satuanRpjmd,
        target_rpjmd: targetRpjmd,
        indikator_rkpd: indikatorRkpd,
        satuan_rkpd: satuanRkpd,
        target_rkpd: targetRkpd,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $.ajax({
        url: BaseURL + "Daerah/UpdateKonsistensiTujuan",
        type: "POST",
        data: payload,
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                alert(res.message);
                window.location.reload();
            } else {
                alert(res.message || 'Gagal update!');
            }
            btn.prop('disabled', false).text('UPDATE');
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
            btn.prop('disabled', false).text('UPDATE');
        }
    });
});

// ============================================================
// HAPUS
// ============================================================
$(document).on('click', '.BtnHapus', function() {
    var id = $(this).data('id');
    if (!id) return;
    if (!confirm('Yakin hapus data ini?')) return;
    
    $.ajax({
        url: BaseURL + "Daerah/HapusKonsistensiTujuan",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                alert(res.message);
                window.location.reload();
            } else {
                alert(res.message || 'Gagal hapus!');
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

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

        var redirectUrl = BaseURL + "Daerah/KonsistensiTujuan";
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
// DATA TABLE
// ============================================================
$(document).ready(function() {
    if ($('#data-table').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table')) {
                $('#data-table').DataTable().destroy();
            }
            $('#data-table').DataTable({
                "pageLength": 10,
                "ordering": true,
                "columnDefs": [{ "orderable": false, "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] }]
            });
        } catch(e) { console.log(e); }
    }
});
</script>

</body>
</html>