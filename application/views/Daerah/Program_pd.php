  <?php $this->load->view('Daerah/sidebar'); ?>
  <?php $this->load->view('Daerah/Cssumum'); ?>

  <style>
      /* ============================================================
        STYLE PROGRAM PD - TABEL SEPERTI GAMBAR
      ============================================================ */
      .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
      .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
      .filter-group label { font-size:14px; margin-bottom:5px; }
      .filter-select { width:260px; font-size:14px; padding:5px 8px; }
      
      /* ============================================================
        TABEL UTAMA SEPERTI GAMBAR
        - Urusan, Bidang, Program, dan Indikator dalam satu baris
      ============================================================ */
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
      .program-table .text-left {
          text-align: left;
          padding-left: 8px;
      }
      
      /* Warna berdasarkan level */
      .program-table .row-urusan {
          background: #f8f9fa;
          font-weight: 600;
      }
      .program-table .row-urusan td {
          border-bottom: 2px solid #007bff;
      }
      .program-table .row-urusan .badge-urusan {
          background: #007bff;
          color: #fff;
          padding: 2px 8px;
          border-radius: 10px;
          font-size: 10px;
      }
      
      .program-table .row-bidang {
          background: #fafbfc;
      }
      .program-table .row-bidang .badge-bidang {
          background: #28a745;
          color: #fff;
          padding: 2px 6px;
          border-radius: 8px;
          font-size: 9px;
      }
      .program-table .row-bidang .nama-bidang {
          font-weight: 500;
          color: #2c3e50;
      }
      
      .program-table .row-program {
          background: #fff;
          border-left: 3px solid #17a2b8;
      }
      .program-table .row-program .badge-program {
          background: #17a2b8;
          color: #fff;
          padding: 2px 6px;
          border-radius: 8px;
          font-size: 9px;
      }
      .program-table .row-program .nama-program {
          font-weight: 500;
          color: #1a5276;
      }
      
      .program-table .row-indikator {
          background: #fafafa;
          border-left: 3px solid #ffc107;
      }
      .program-table .row-indikator .indikator-text {
          font-weight: 400;
          color: #2c3e50;
          padding-left: 8px;
      }
      .program-table .row-indikator .arrow-indikator {
          color: #6c757d;
          font-size: 10px;
          margin-right: 3px;
      }
      
      /* Pagu */
      .program-table .pagu-col {
          color: #1a5276;
          font-weight: 500;
          font-size: 10px;
      }
      
      /* Badge PD */
      .program-table .badge-pd {
          background: #e9ecef;
          color: #495057;
          padding: 2px 6px;
          border-radius: 4px;
          font-size: 9px;
          display: inline-block;
      }
      .program-table .badge-empty {
          color: #adb5bd;
          font-size: 9px;
      }
      
      /* Aksi - di kolom terakhir */
      .program-table .col-aksi {
          text-align: center;
          vertical-align: middle;
          min-width: 80px;
      }
      .program-table .btn-aksi {
          padding: 1px 4px;
          font-size: 9px;
          margin: 1px;
          border: none;
          border-radius: 3px;
      }
      .program-table .btn-aksi-sm {
          padding: 1px 3px;
          font-size: 8px;
      }
      .program-table .btn-group-aksi {
          display: inline-flex;
          gap: 1px;
          flex-wrap: wrap;
          justify-content: center;
      }
      
      /* Level indent */
      .level-urusan { padding-left: 5px; }
      .level-bidang { padding-left: 25px; }
      .level-program { padding-left: 45px; }
      .level-indikator { padding-left: 65px; }
      
      /* Warna border kiri */
      .border-urusan { border-left: 4px solid #007bff !important; }
      .border-bidang { border-left: 4px solid #28a745 !important; }
      .border-program { border-left: 4px solid #17a2b8 !important; }
      .border-indikator { border-left: 4px solid #ffc107 !important; }
      
      /* ============================================================
        MODAL FIXED - MENIMPA DI ATAS HEADER & BISA DI-SCROLL
      ============================================================ */
      .modal.fixed-modal {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 99999;
          background: rgba(0,0,0,0.6);
          display: none !important;
          padding: 20px;
          overflow-y: auto;
      }

      .modal.fixed-modal.show {
          display: flex !important;
          align-items: center;
          justify-content: center;
      }

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

      .modal.fixed-modal .modal-header .close:hover {
          opacity: 1;
      }

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

      /* Modal sizes */
      .modal.fixed-modal .modal-dialog.modal-md { max-width: 600px; }
      .modal.fixed-modal .modal-dialog.modal-lg-custom { max-width: 95%; width: 95%; }
      .modal.fixed-modal .modal-dialog.modal-xl-custom { max-width: 98%; width: 98%; }

      /* Animasi */
      .modal.fixed-modal.show .modal-dialog {
          animation: modalSlideIn 0.3s ease;
      }

      @keyframes modalSlideIn {
          from {
              transform: translateY(-30px) scale(0.95);
              opacity: 0;
          }
          to {
              transform: translateY(0) scale(1);
              opacity: 1;
          }
      }

      /* Scrollbar */
      .modal.fixed-modal .modal-body::-webkit-scrollbar {
          width: 6px;
      }
      .modal.fixed-modal .modal-body::-webkit-scrollbar-track {
          background: #f1f1f1;
          border-radius: 3px;
      }
      .modal.fixed-modal .modal-body::-webkit-scrollbar-thumb {
          background: #c1c1c1;
          border-radius: 3px;
      }
      .modal.fixed-modal .modal-body::-webkit-scrollbar-thumb:hover {
          background: #a8a8a8;
      }

      /* ============================================================
        NOMENKLATUR STYLE
      ============================================================ */
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
          background: #007bff;
          color: #fff;
          padding: 3px 10px;
          border-radius: 4px;
          margin-right: 8px;
          font-size: 11px;
      }
      .cascading-select { margin-bottom: 10px; }
      .cascading-select select { height: 38px; font-size: 13px; }
      .cascading-select label { font-weight: 600; font-size: 12px; color: #495057; margin-bottom: 3px; }
      .nomenklatur-info {
          background: #e8f0fe;
          padding: 10px 15px;
          border-radius: 4px;
          margin-top: 10px;
          border-left: 3px solid #007bff;
          display: none;
      }
      .nomenklatur-info strong { color: #1a5276; }

      /* ============================================================
        INDIKATOR ROW
      ============================================================ */
      .indikator-row {
          background: #f8f9fa;
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

      .indikator-row .row:first-child {
          margin-right: 50px;
      }

      .indikator-row .form-group { margin-bottom: 5px; }
      .indikator-row .form-control-sm { font-size: 12px; height: 30px; padding: 2px 8px; }
      .indikator-row textarea.form-control-sm { height: 38px; resize: vertical; }

      /* ============================================================
        BUTTON GROUP & EMPTY STATE
      ============================================================ */
      .btn-group-center {
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 15px;
          margin-top: 20px;
          padding: 10px 0;
      }
      .btn-group-center .btn { min-width: 120px; }

      .empty-state {
          text-align: center;
          padding: 40px 20px;
          color: #6c757d;
      }
      .empty-state .icon { font-size: 48px; margin-bottom: 15px; color: #dee2e6; }
      .empty-state h5 { color: #495057; }

      .table-scroll { overflow-x: auto; margin-top: 5px; }
      .table-scroll .program-table { min-width: 1200px; }

      /* ============================================================
        RESPONSIVE
      ============================================================ */
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
          .level-indikator { padding-left: 45px; }
          .modal.fixed-modal { padding: 10px; }
          .modal.fixed-modal .modal-dialog { max-height: calc(100vh - 20px); }
          .modal.fixed-modal .modal-content { max-height: calc(100vh - 20px); }
          .modal.fixed-modal .modal-body { max-height: calc(100vh - 160px); padding: 15px; }
          .indikator-row .btn-remove-indikator {
              padding: 4px 10px;
              font-size: 14px;
              min-width: 30px;
              min-height: 30px;
          }
          .indikator-row .row:first-child {
              margin-right: 40px;
          }
      }
  </style>

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
                  </div>
                <?php } ?>
              <?php } ?>
              <!-- END FILTER -->

              <!-- ============================================================
                  TOMBOL TAMBAH URUSAN
              ============================================================ -->
              <div class="basic-tb-hd">
                <div class="button-icon-btn sm-res-mg-t-30">
                  <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                  <button type="button" class="btn btn-primary notika-btn-primary" id="BtnTambahUrusan">
                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Urusan</b>
                  </button>
                  <?php } ?>
                </div>
              </div>

              <!-- ============================================================
                  TABEL DATA - INDIKATOR DI SAMPING PROGRAM
              ============================================================ -->
              <div id="ListDataContainer">
                <?php if (empty($ListData)) { ?>
                  <div class="empty-state">
                    <div class="icon">📋</div>
                    <h5>Belum ada data Urusan</h5>
                    <p>Silakan tambahkan Urusan terlebih dahulu</p>
                  </div>
                <?php } else { ?>
                  <div class="table-scroll">
                    <table class="program-table">
                      <thead>
                        <tr>
                          <th style="width:18%;">BIDANG URUSAN / PROGRAM / OUTCOME</th>
                          <th style="width:14%;">INDIKATOR OUTCOME</th>
                          <th style="width:6%;">SATUAN</th>
                          <th style="width:8%;">KONDISI AWAL</th>
                          <th colspan="2" style="width:8%;">2026</th>
                          <th colspan="2" style="width:8%;">2027</th>
                          <th colspan="2" style="width:8%;">2028</th>
                          <th colspan="2" style="width:8%;">2029</th>
                          <th colspan="2" style="width:8%;">2030</th>
                          <th style="width:10%;">PERANGKAT DAERAH</th>
                          <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                            <th style="width:5%;" class="col-aksi">AKSI</th>
                          <?php } ?>
                        </tr>
                        <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>TARGET</th>
                          <th>PAGU</th>
                          <th>TARGET</th>
                          <th>PAGU</th>
                          <th>TARGET</th>
                          <th>PAGU</th>
                          <th>TARGET</th>
                          <th>PAGU</th>
                          <th>TARGET</th>
                          <th>PAGU</th>
                          <th></th>
                          <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                            <th class="col-aksi"></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $rowNum = 0;
                        foreach ($ListData as $urusan) { 
                          $rowNum++;
                          $hasBidang = !empty($urusan['bidang']);
                        ?>
                          <!-- ============================================================
                              ROW URUSAN (Level 1)
                          ============================================================ -->
                          <tr class="row-urusan border-urusan">
                            <td class="text-left level-urusan">
                              <span class="badge-urusan"><?= html_escape($urusan['kode_urusan']) ?></span>
                              <strong><?= html_escape($urusan['nama_urusan']) ?></strong>
                            </td>
                            <td colspan="14" style="text-align:left; font-size:10px; color:#6c757d;">
                              <?php if (!empty($urusan[''])) { ?>
                                <?php 
                                $bidangNames = array_column($urusan['bidang'], 'nama_bidang');
                                echo implode('; ', array_slice($bidangNames, 0, 3));
                                if (count($bidangNames) > 3) echo '...';
                                ?>
                              <?php } else { ?>
                              <?php } ?>
                            </td>
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                              <td class="col-aksi">
                                <div class="btn-group-aksi">
                                  <button class="btn btn-sm btn-success btn-aksi BtnTambahBidang" 
                                          data-urusan-id="<?= $urusan['id'] ?>"
                                          data-kode-urusan="<?= html_escape($urusan['kode_urusan']) ?>"
                                          data-nama-urusan="<?= html_escape($urusan['nama_urusan']) ?>"
                                          title="Tambah Bidang">
                                    <i class="notika-icon bi-plus-lg"></i>
                                  </button>
                                  <button class="btn btn-sm btn-warning btn-aksi BtnEditUrusan" 
                                          data-id="<?= $urusan['id'] ?>"
                                          data-kode="<?= html_escape($urusan['kode_urusan']) ?>"
                                          data-nama="<?= html_escape($urusan['nama_urusan']) ?>"
                                          title="Edit Urusan">
                                    <i class="notika-icon notika-edit"></i>
                                  </button>
                                  <button class="btn btn-sm btn-danger btn-aksi BtnHapusUrusan" 
                                          data-id="<?= $urusan['id'] ?>"
                                          title="Hapus Urusan">
                                    <i class="notika-icon notika-trash"></i>
                                  </button>
                                </div>
                              </td>
                            <?php } ?>
                          </tr>

                          <!-- ============================================================
                              BIDANG URUSAN (Level 2)
                          ============================================================ -->
                          <?php if ($hasBidang) { ?>
                            <?php foreach ($urusan['bidang'] as $bidang) { ?>
                              <?php 
                              $hasProgram = !empty($bidang['program']);
                              ?>
                              <tr class="row-bidang border-bidang">
                                <td class="text-left level-bidang">
                                  <span class="badge-bidang"><?= html_escape($bidang['kode_bidang']) ?></span>
                                  <span class="nama-bidang"><?= html_escape($bidang['nama_bidang']) ?></span>
                                </td>
                                <td colspan="14" style="text-align:left; font-size:10px; color:#6c757d;">
                                  <?php if (!empty($bidang[''])) { ?>
                                    <?php 
                                    $progNames = array_column($bidang['program'], 'nama_program');
                                    echo implode('; ', array_slice($progNames, 0, 3));
                                    if (count($progNames) > 3) echo '...';
                                    ?>
                                  <?php } else { ?>
                                    
                                  <?php } ?>
                                </td>
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                  <td class="col-aksi">
                                    <div class="btn-group-aksi">
                                      <button class="btn btn-sm btn-info btn-aksi BtnTambahProgram" 
                                              data-bidang-id="<?= $bidang['id'] ?>"
                                              data-kode-bidang="<?= html_escape($bidang['kode_bidang']) ?>"
                                              data-nama-bidang="<?= html_escape($bidang['nama_bidang']) ?>"
                                              data-urusan-id="<?= $urusan['id'] ?>"
                                              title="Tambah Program">
                                        <i class="notika-icon bi-plus-lg"></i>
                                      </button>
                                      <button class="btn btn-sm btn-warning btn-aksi BtnEditBidang" 
                                              data-id="<?= $bidang['id'] ?>"
                                              data-urusan-id="<?= $urusan['id'] ?>"
                                              data-kode="<?= html_escape($bidang['kode_bidang']) ?>"
                                              data-nama="<?= html_escape($bidang['nama_bidang']) ?>"
                                              title="Edit Bidang">
                                        <i class="notika-icon notika-edit"></i>
                                      </button>
                                      <button class="btn btn-sm btn-danger btn-aksi BtnHapusBidang" 
                                              data-id="<?= $bidang['id'] ?>"
                                              title="Hapus Bidang">
                                        <i class="notika-icon notika-trash"></i>
                                      </button>
                                    </div>
                                  </td>
                                <?php } ?>
                              </tr>

                              <!-- ============================================================
                                  PROGRAM (Level 3) - ROWSPAN UNTUK PROGRAM
                                  INDIKATOR DI BAWAHNYA
                              ============================================================ -->
                              <?php if ($hasProgram) { ?>
                                <?php foreach ($bidang['program'] as $program) { ?>
                                  <?php 
                                  $indikatorList = $program['indikator'] ?? [];
                                  $indikatorCount = count($indikatorList);
                                  $rowspan = max($indikatorCount, 1);
                                  
                                  // Jika ada indikator, tampilkan program dengan rowspan
                                  if ($indikatorCount > 0) {
                                    $firstIndikator = $indikatorList[0];
                                  ?>
                                    <!-- PROGRAM + INDIKATOR PERTAMA dalam satu baris -->
                                    <tr class="row-program border-program">
                                      <!-- Kolom 1: BIDANG URUSAN / PROGRAM / OUTCOME - ROWSPAN -->
                                      <td class="text-left level-program" style="padding-left:45px;" rowspan="<?= $rowspan ?>">
                                        <?php if (!empty($program['kode_program'])) { ?>
                                          <span class="badge-program"><?= html_escape($program['kode_program']) ?></span>
                                        <?php } ?>
                                        <span class="nama-program"><?= html_escape($program['nama_program']) ?></span>
                                      </td>
                                      
                                      <!-- Kolom 2: INDIKATOR OUTCOME -->
                                      <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                        <?= html_escape($firstIndikator['indikator'] ?? '-') ?>
                                      </td>
                                      
                                      <!-- Kolom 3: SATUAN -->
                                      <td><?= html_escape($firstIndikator['satuan'] ?? '-') ?></td>
                                      
                                      <!-- Kolom 4: KONDISI AWAL -->
                                      <td><?= html_escape($firstIndikator['kondisi_awal'] ?? '-') ?></td>
                                      
                                      <!-- 2026 -->
                                      <td><?= html_escape($firstIndikator['target_2026'] ?? '-') ?></td>
                                      <td class="pagu-col"><?= !empty($firstIndikator['pagu_2026']) ? number_format($firstIndikator['pagu_2026'], 0, ',', '.') : '-' ?></td>
                                      
                                      <!-- 2027 -->
                                      <td><?= html_escape($firstIndikator['target_2027'] ?? '-') ?></td>
                                      <td class="pagu-col"><?= !empty($firstIndikator['pagu_2027']) ? number_format($firstIndikator['pagu_2027'], 0, ',', '.') : '-' ?></td>
                                      
                                      <!-- 2028 -->
                                      <td><?= html_escape($firstIndikator['target_2028'] ?? '-') ?></td>
                                      <td class="pagu-col"><?= !empty($firstIndikator['pagu_2028']) ? number_format($firstIndikator['pagu_2028'], 0, ',', '.') : '-' ?></td>
                                      
                                      <!-- 2029 -->
                                      <td><?= html_escape($firstIndikator['target_2029'] ?? '-') ?></td>
                                      <td class="pagu-col"><?= !empty($firstIndikator['pagu_2029']) ? number_format($firstIndikator['pagu_2029'], 0, ',', '.') : '-' ?></td>
                                      
                                      <!-- 2030 -->
                                      <td><?= html_escape($firstIndikator['target_2030'] ?? '-') ?></td>
                                      <td class="pagu-col"><?= !empty($firstIndikator['pagu_2030']) ? number_format($firstIndikator['pagu_2030'], 0, ',', '.') : '-' ?></td>
                                      
                                      <!-- PERANGKAT DAERAH - ROWSPAN -->
                                      <td class="pd-col" rowspan="<?= $rowspan ?>">
                                        <?php if (!empty($firstIndikator['perangkat_daerah_nama'])) { ?>
                                          <span class="badge-pd"><?= html_escape($firstIndikator['perangkat_daerah_nama']) ?></span>
                                        <?php } else { ?>
                                          <span class="badge-empty">-</span>
                                        <?php } ?>
                                      </td>
                                      
                                      <!-- KOLOM AKSI - ROWSPAN -->
                                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="col-aksi" rowspan="<?= $rowspan ?>">
                                          <div class="btn-group-aksi">
                                            <button class="btn btn-sm btn-success btn-aksi BtnEditProgram" 
                                                    data-id="<?= $program['id'] ?>"
                                                    data-bidang-id="<?= $bidang['id'] ?>"
                                                    data-kode="<?= html_escape($program['kode_program'] ?? '') ?>"
                                                    data-nama="<?= html_escape($program['nama_program']) ?>"
                                                    title="Edit Program">
                                              <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-aksi BtnHapusProgram" 
                                                    data-id="<?= $program['id'] ?>"
                                                    title="Hapus Program">
                                              <i class="notika-icon notika-trash"></i>
                                            </button>
                                          </div>
                                        </td>
                                      <?php } ?>
                                    </tr>
                                    
                                    <!-- INDIKATOR SELANJUTNYA (baris ke-2, ke-3, dst) -->
                                    <?php for ($i = 1; $i < $indikatorCount; $i++) { 
                                      $ind = $indikatorList[$i];
                                    ?>
                                      <tr class="row-indikator border-indikator">
                                        <!-- Kolom 2: INDIKATOR OUTCOME -->
                                        <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                          <?= html_escape($ind['indikator'] ?? '-') ?>
                                        </td>
                                        
                                        <!-- Kolom 3: SATUAN -->
                                        <td><?= html_escape($ind['satuan'] ?? '-') ?></td>
                                        
                                        <!-- Kolom 4: KONDISI AWAL -->
                                        <td><?= html_escape($ind['kondisi_awal'] ?? '-') ?></td>
                                        
                                        <!-- 2026 -->
                                        <td><?= html_escape($ind['target_2026'] ?? '-') ?></td>
                                        <td class="pagu-col"><?= !empty($ind['pagu_2026']) ? number_format($ind['pagu_2026'], 0, ',', '.') : '-' ?></td>
                                        
                                        <!-- 2027 -->
                                        <td><?= html_escape($ind['target_2027'] ?? '-') ?></td>
                                        <td class="pagu-col"><?= !empty($ind['pagu_2027']) ? number_format($ind['pagu_2027'], 0, ',', '.') : '-' ?></td>
                                        
                                        <!-- 2028 -->
                                        <td><?= html_escape($ind['target_2028'] ?? '-') ?></td>
                                        <td class="pagu-col"><?= !empty($ind['pagu_2028']) ? number_format($ind['pagu_2028'], 0, ',', '.') : '-' ?></td>
                                        
                                        <!-- 2029 -->
                                        <td><?= html_escape($ind['target_2029'] ?? '-') ?></td>
                                        <td class="pagu-col"><?= !empty($ind['pagu_2029']) ? number_format($ind['pagu_2029'], 0, ',', '.') : '-' ?></td>
                                        
                                        <!-- 2030 -->
                                        <td><?= html_escape($ind['target_2030'] ?? '-') ?></td>
                                        <td class="pagu-col"><?= !empty($ind['pagu_2030']) ? number_format($ind['pagu_2030'], 0, ',', '.') : '-' ?></td>
                                      </tr>
                                    <?php } ?>
                                    
                                  <?php } else { 
                                    // PROGRAM TANPA INDIKATOR - 1 baris saja
                                  ?>
                                    <tr class="row-program border-program">
                                      <td class="text-left level-program" style="padding-left:45px;">
                                        <?php if (!empty($program['kode_program'])) { ?>
                                          <span class="badge-program"><?= html_escape($program['kode_program']) ?></span>
                                        <?php } ?>
                                        <span class="nama-program"><?= html_escape($program['nama_program']) ?></span>
                                      </td>
                                      <td colspan="14" style="text-align:left; font-size:10px; color:#6c757d; font-style:italic;">
                                        
                                      </td>
                                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="col-aksi">
                                          <div class="btn-group-aksi">
                                            <button class="btn btn-sm btn-success btn-aksi BtnEditProgram" 
                                                    data-id="<?= $program['id'] ?>"
                                                    data-bidang-id="<?= $bidang['id'] ?>"
                                                    data-kode="<?= html_escape($program['kode_program'] ?? '') ?>"
                                                    data-nama="<?= html_escape($program['nama_program']) ?>"
                                                    title="Edit Program">
                                              <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-aksi BtnHapusProgram" 
                                                    data-id="<?= $program['id'] ?>"
                                                    title="Hapus Program">
                                              <i class="notika-icon notika-trash"></i>
                                            </button>
                                          </div>
                                        </td>
                                      <?php } ?>
                                    </tr>
                                  <?php } ?>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
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

    <!-- ============================================================
        MODAL URUSAN - FIXED MODAL
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
        MODAL BIDANG URUSAN - FIXED MODAL
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
        MODAL PROGRAM + INDIKATOR - FIXED MODAL
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
              <label><b>INDIKATOR OUTCOME</b></label>
              <div id="IndikatorContainer"></div>
              <button type="button" class="btn btn-sm btn-info" id="BtnTambahIndikator">
                <i class="notika-icon bi-plus-lg"></i> Tambah Indikator
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
          error: function(xhr, status, error) {
              console.error('Error getNomenklatur:', error);
              if (callback) callback([]);
          }
      });
  }

  // ============================================================
  // LOAD LEVEL NOMENKLATUR
  // ============================================================

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

  // ============================================================
  // UPDATE PATH DISPLAY
  // ============================================================

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

  $(document).on('change', '#UrusanKodeSelect', function() { updatePathDisplayUrusan(); });
  $(document).on('change', '#BidangKodeSelect', function() { updatePathDisplayBidang(); });
  $(document).on('change', '#ProgramKodeSelect', function() { updatePathDisplayProgram(); });

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
          error: function() { console.error("Gagal memuat data Kab/Kota"); $("#KabKota").prop('disabled', false); }
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
      
      // Hapus backdrop yang mungkin ada
      $('.modal-backdrop').remove();
      
      // Tampilkan modal
      $modal.css('display', 'flex !important');
      $modal.addClass('show');
      
      // Tambahkan backdrop
      var $backdrop = $('<div class="modal-backdrop fade in"></div>');
      $('body').append($backdrop);
      $('body').addClass('modal-open');
      
      // Set scroll ke atas
      $modal.scrollTop(0);
  }

  function hideFixedModal(selector) {
      var $modal = $(selector);
      
      $modal.removeClass('show');
      $modal.css('display', 'none !important');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
  }

  // ============================================================
  // EVENT HANDLER UNTUK MODAL
  // ============================================================

  // Tombol close (×)
  $(document).on('click', '.modal.fixed-modal .close', function(e) {
      e.preventDefault();
      var $modal = $(this).closest('.modal.fixed-modal');
      if ($modal.length) {
          hideFixedModal('#' + $modal.attr('id'));
      }
  });

  // Klik di luar modal (background)
  $(document).on('click', '.modal.fixed-modal', function(e) {
      if ($(e.target).hasClass('modal.fixed-modal')) {
          hideFixedModal('#' + $(this).attr('id'));
      }
  });

  // Tombol Batal
  $(document).on('click', '.modal.fixed-modal .btn-batal', function(e) {
      e.preventDefault();
      var $modal = $(this).closest('.modal.fixed-modal');
      if ($modal.length) {
          hideFixedModal('#' + $modal.attr('id'));
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
          if (kode) {
              $('#UrusanKodeSelect').val(kode);
              updatePathDisplayUrusan();
          }
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
              if (result.status === 'success') { window.location.reload(); }
              else { alert(result.message || 'Gagal menghapus!'); }
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
      
      var urusanNama = '';
      var urusanKode = '';
      
      $.ajax({
          url: BaseURL + "Daerah/program_get_urusan_by_id",
          type: "POST",
          data: { id: urusanId, [CSRF_NAME]: CSRF_TOKEN },
          dataType: 'json',
          success: function(res) {
              if (res.status === 'success' && res.data) {
                  urusanKode = res.data.kode_urusan || '';
                  urusanNama = res.data.nama_urusan || '';
                  $('#BidangUrusanNama').val(urusanKode + ' - ' + urusanNama);
                  
                  nomenklaturCache = {};
                  loadLevelBidang(urusanKode);
                  
                  setTimeout(function() {
                      if (kode) {
                          $('#BidangKodeSelect').val(kode);
                          updatePathDisplayBidang();
                      }
                  }, 500);
              }
          },
          error: function() {
              alert('Gagal memuat data Urusan!');
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
              if (result.status === 'success') { window.location.reload(); }
              else { alert(result.message || 'Gagal menghapus!'); }
          })
          .fail(function() { alert('Terjadi kesalahan!'); });
  });

  // ============================================================
  // CRUD PROGRAM + INDIKATOR
  // ============================================================

  var indikatorCounter = 0;

function addIndikatorRow(data) {
    var counter = indikatorCounter++;
    var html = '<div class="indikator-row" id="indikator_row_' + counter + '">';
    
    // ✅ HIDDEN INPUT UNTUK ID INDIKATOR (untuk update)
    html += '<input type="hidden" class="indikator-id" id="indikator_id_' + counter + '" value="' + (data ? (data.id || '') : '') + '">';
    
    html += '<button type="button" class="btn btn-danger btn-sm btn-remove-indikator" data-row="' + counter + '" title="Hapus Indikator">×</button>';
    html += '<div class="row">';
    html += '<div class="col-md-6"><div class="form-group"><label>Indikator Outcome</label><textarea class="form-control form-control-sm" id="indikator_' + counter + '" rows="2">' + (data ? escapeHtml(data.indikator || '') : '') + '</textarea></div></div>';
    html += '<div class="col-md-3"><div class="form-group"><label>Satuan</label><input type="text" class="form-control form-control-sm" id="satuan_' + counter + '" value="' + (data ? escapeHtml(data.satuan || '') : '') + '"></div></div>';
    html += '<div class="col-md-3"><div class="form-group"><label>Kondisi Awal</label><input type="text" class="form-control form-control-sm" id="kondisi_awal_' + counter + '" value="' + (data ? escapeHtml(data.kondisi_awal || '') : '') + '"></div></div>';
    html += '</div>';
    
    var years = ['2026', '2027', '2028', '2029', '2030'];
    html += '<div class="row">';
    for (var i = 0; i < years.length; i++) {
        var y = years[i];
        var targetVal = data ? escapeHtml(data['target_' + y] || '') : '';
        var paguVal = data ? (data['pagu_' + y] || '') : '';
        
        var paguFormatted = '';
        if (paguVal) {
            var num = parseFloat(paguVal);
            if (!isNaN(num)) {
                paguFormatted = num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }
        
        html += '<div class="col-md-2"><div class="form-group"><label style="font-size:11px; color:#007bff;">' + y + '</label><div class="row"><div class="col-xs-6" style="padding-right:3px;"><input type="text" class="form-control form-control-sm" id="target_' + y + '_' + counter + '" placeholder="Target" value="' + targetVal + '"></div><div class="col-xs-6" style="padding-left:3px;"><input type="text" class="form-control form-control-sm pagu-input" id="pagu_' + y + '_' + counter + '" placeholder="Pagu" value="' + paguFormatted + '"></div></div></div></div>';
    }
    html += '</div>';
    
    html += '<div class="row"><div class="col-md-6"><div class="form-group"><label>Perangkat Daerah</label><select class="form-control form-control-sm" id="perangkat_daerah_' + counter + '"><option value="">-- Pilih Perangkat Daerah --</option>';
    <?php foreach ($PerangkatDaerah as $pd) { ?>
    html += '<option value="<?= $pd['id'] ?>" ' + (data && data.perangkat_daerah_id == <?= $pd['id'] ?> ? 'selected' : '') + '><?= html_escape($pd['nama']) ?></option>';
    <?php } ?>
    html += '</select></div></div></div></div>';
    
    $('#IndikatorContainer').append(html);
    
    // Format Pagu
    $('.pagu-input').off('keyup').on('keyup', function() {
        var val = $(this).val().replace(/[^0-9]/g, '');
        if (val) {
            $(this).val(val.replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        }
    });
}

  $('#BtnTambahIndikator').click(function() { addIndikatorRow(null); });
  $(document).on('click', '.btn-remove-indikator', function() {
      if (!confirm('Hapus indikator ini?')) return;
      var row = $(this).data('row');
      $('#indikator_row_' + row).remove();
  });

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
      $('#IndikatorContainer').html('');
      indikatorCounter = 0;
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
    
    // Load Bidang Info
    $.ajax({
        url: BaseURL + "Daerah/program_get_bidang_by_id",
        type: "POST",
        data: { id: bidangId, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success' && res.data) {
                var kodeBidang = res.data.kode_bidang || '';
                var namaBidang = res.data.nama_bidang || '';
                $('#ProgramBidangInfo').text(kodeBidang + ' - ' + namaBidang);
                
                nomenklaturCache = {};
                loadLevelProgram(kodeBidang);
                
                setTimeout(function() {
                    if (kode) {
                        $('#ProgramKodeSelect').val(kode);
                        updatePathDisplayProgram();
                    }
                }, 500);
            }
        },
        error: function() {
            alert('Gagal memuat data Bidang!');
        }
    });

    // Reset indikator
    $('#IndikatorContainer').html('');
    indikatorCounter = 0;
    
    // Load data program + indikator
    $.ajax({
        url: BaseURL + "Daerah/program_get_by_id",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success' && res.data) {
                var data = res.data;
                if (data.indikator && data.indikator.length > 0) {
                    for (var i = 0; i < data.indikator.length; i++) {
                        // ✅ Data indikator sudah include ID
                        addIndikatorRow(data.indikator[i]);
                    }
                }
            }
        },
        error: function() {
            console.error('Gagal load data program');
        }
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
    
    var indikatorData = [];
    var rows = $('#IndikatorContainer .indikator-row');
    
    if (rows.length === 0) {
        alert('Minimal tambahkan 1 Indikator Outcome!');
        return;
    }
    
    rows.each(function() {
        var rowId = $(this).attr('id').replace('indikator_row_', '');
        var indikator = $('#indikator_' + rowId).val().trim();
        if (!indikator) return;
        
        // ✅ Ambil ID indikator (untuk update)
        var indikatorId = $('#indikator_id_' + rowId).val() || '';
        
        var pagu2026 = $('#pagu_2026_' + rowId).val().replace(/\./g, '');
        var pagu2027 = $('#pagu_2027_' + rowId).val().replace(/\./g, '');
        var pagu2028 = $('#pagu_2028_' + rowId).val().replace(/\./g, '');
        var pagu2029 = $('#pagu_2029_' + rowId).val().replace(/\./g, '');
        var pagu2030 = $('#pagu_2030_' + rowId).val().replace(/\./g, '');
        
        var data = {
            id: indikatorId, // ✅ Kirim ID
            indikator: indikator,
            satuan: $('#satuan_' + rowId).val().trim(),
            kondisi_awal: $('#kondisi_awal_' + rowId).val().trim(),
            target_2026: $('#target_2026_' + rowId).val().trim(),
            pagu_2026: pagu2026 || null,
            target_2027: $('#target_2027_' + rowId).val().trim(),
            pagu_2027: pagu2027 || null,
            target_2028: $('#target_2028_' + rowId).val().trim(),
            pagu_2028: pagu2028 || null,
            target_2029: $('#target_2029_' + rowId).val().trim(),
            pagu_2029: pagu2029 || null,
            target_2030: $('#target_2030_' + rowId).val().trim(),
            pagu_2030: pagu2030 || null,
            perangkat_daerah_id: $('#perangkat_daerah_' + rowId).val()
        };
        indikatorData.push(data);
    });
    
    if (indikatorData.length === 0) {
        alert('Minimal 1 Indikator dengan data lengkap!');
        return;
    }
    
    var url = id ? BaseURL + "Daerah/program_edit_program" : BaseURL + "Daerah/program_input_program";
    var data = {
        id: id,
        bidang_urusan_id: bidangId,
        kode_program: kode,
        nama_program: nama,
        
        // ✅ Kirim ID indikator
        indikator_id: indikatorData.map(function(d) { return d.id; }),
        indikator: indikatorData.map(function(d) { return d.indikator; }),
        satuan: indikatorData.map(function(d) { return d.satuan; }),
        kondisi_awal: indikatorData.map(function(d) { return d.kondisi_awal; }),
        target_2026: indikatorData.map(function(d) { return d.target_2026; }),
        pagu_2026: indikatorData.map(function(d) { return d.pagu_2026; }),
        target_2027: indikatorData.map(function(d) { return d.target_2027; }),
        pagu_2027: indikatorData.map(function(d) { return d.pagu_2027; }),
        target_2028: indikatorData.map(function(d) { return d.target_2028; }),
        pagu_2028: indikatorData.map(function(d) { return d.pagu_2028; }),
        target_2029: indikatorData.map(function(d) { return d.target_2029; }),
        pagu_2029: indikatorData.map(function(d) { return d.pagu_2029; }),
        target_2030: indikatorData.map(function(d) { return d.target_2030; }),
        pagu_2030: indikatorData.map(function(d) { return d.pagu_2030; }),
        perangkat_daerah_id: indikatorData.map(function(d) { return d.perangkat_daerah_id; }),
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    $('#BtnSimpanProgram').prop('disabled', true).text('MENYIMPAN...');
    
    $.post(url, data)
        .done(function(res) {
            try { 
                var result = typeof res === 'string' ? JSON.parse(res) : res; 
            } catch(e) { 
                var result = res; 
            }
            
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
  // HAPUS PROGRAM & INDIKATOR
  // ============================================================

  $(document).on('click', '.BtnHapusProgram', function() {
      if (!confirm('Yakin ingin menghapus Program ini?')) return;
      var id = $(this).data('id');
      $.post(BaseURL + "Daerah/program_hapus_program", { id: id, [CSRF_NAME]: CSRF_TOKEN })
          .done(function(res) {
              try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
              if (result.status === 'success') { window.location.reload(); }
              else { alert(result.message || 'Gagal menghapus!'); }
          })
          .fail(function() { alert('Terjadi kesalahan!'); });
  });

  $(document).on('click', '.BtnHapusIndikator', function() {
      if (!confirm('Yakin ingin menghapus Indikator ini?')) return;
      var id = $(this).data('id');
      var row = $(this).closest('tr');
      $.post(BaseURL + "Daerah/program_hapus_indikator", { id: id, [CSRF_NAME]: CSRF_TOKEN })
          .done(function(res) {
              try { var result = typeof res === 'string' ? JSON.parse(res) : res; } catch(e) { var result = res; }
              if (result.status === 'success') {
                  row.remove();
                  if ($('.program-table tbody tr.row-indikator').length === 0) {
                      window.location.reload();
                  }
              } else { alert(result.message || 'Gagal menghapus!'); }
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
      console.log('ProgramPD ready - Fixed Modal with Scroll!');
  });
  </script>

  </body>
  </html>