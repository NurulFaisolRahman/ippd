<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
    .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
    .filter-group label { font-size:14px; margin-bottom:5px; }
    .filter-select { width:260px; font-size:14px; padding:5px 8px; }
    
    /* Nomenklatur Style */
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
    .breadcrumb-nomenklatur #path_display_add,
    .breadcrumb-nomenklatur #path_display_edit {
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
    .preview-panel {
        margin-top: 15px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
    .preview-panel .panel-heading {
        background: #f8f9fa;
        padding: 10px 15px;
        border-bottom: 1px solid #dee2e6;
        border-radius: 4px 4px 0 0;
        font-weight: 600;
    }
    .preview-panel .panel-body {
        padding: 15px;
    }
    .preview-panel .panel-body .form-group {
        margin-bottom: 10px;
    }
    .preview-panel .panel-body .form-group label {
        font-weight: 600;
        font-size: 12px;
        color: #495057;
    }
    .preview-panel .panel-body .form-group input,
    .preview-panel .panel-body .form-group textarea {
        background: #f1f8e9;
        font-family: monospace;
        font-size: 13px;
        border: 1px solid #d4edda;
    }
    
    /* Manual Input Style */
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
    .manual-input-group textarea {
        font-size: 13px;
        resize: vertical;
    }
    
    .modal-lg-custom {
        max-width: 90%;
        width: 90%;
    }
    
    @media (max-width:768px){
        .filter-row{ flex-direction:column; gap:15px; }
        .filter-select{ width:100%; }
        .modal-lg-custom { max-width: 98%; width: 98%; }
    }

    /* Tab Style */
    .nav-tabs > li > a {
        font-weight: 600;
        color: #555;
    }
    .nav-tabs > li.active > a {
        color: #007bff;
        border-bottom-color: #007bff;
    }
    .tab-content {
        padding: 20px 0;
    }

    /* Info terpilih */
    .selected-info {
        background: #d4edda;
        padding: 10px 15px;
        border-radius: 4px;
        border-left: 4px solid #28a745;
        margin-top: 10px;
        display: none;
    }
    .selected-info .label {
        font-weight: 600;
        color: #155724;
    }
    .selected-info .value {
        font-weight: 500;
        color: #155724;
    }
    
    /* Tabel */
    .table-program-pd th {
        background: #f8f9fa;
        font-weight: 600;
        font-size: 12px;
        text-align: center;
        vertical-align: middle;
    }
    .table-program-pd td {
        vertical-align: middle;
        font-size: 13px;
    }
    .table-program-pd .text-urusan {
        font-size: 12px;
    }
    .table-program-pd .text-bidang {
        font-size: 12px;
        color: #495057;
    }
    .table-program-pd .text-program {
        font-weight: 500;
    }
    
    /* Badge untuk menampilkan kode */
    .badge-kode {
        background: #e9ecef;
        color: #495057;
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 10px;
        font-weight: normal;
    }

    /* Tombol di tengah */
    .btn-group-center {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
    }
    .btn-group-center .btn {
        min-width: 100px;
    }

    /* Preview fields hidden */
    .preview-field {
        display: none;
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

            <!-- TOMBOL TAMBAH -->
            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                <button type="button" class="btn btn-success notika-btn-success" id="BtnTambahProgramPD">
                  <i class="notika-icon bi-plus-lg"></i> <b>Tambah Program PD</b>
                </button>
                <?php } ?>
              </div>
            </div>

            <!-- TABEL DATA -->
            <div class="table-responsive">
                <table id="data-table-basic" class="table table-striped table-program-pd">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:5%;">No</th>
                            <th style="width:15%;">Sasaran</th>
                            <th style="width:20%;">Urusan</th>
                            <th style="width:20%;">Bidang Urusan</th>
                            <th style="width:25%;">Program PD</th>
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <th class="text-center" style="width:10%;">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $No = 1; 
                        foreach ($ProgramPD as $p) { 
                            $urusanNama = $p['nama_urusan'] ?? '-';
                            $bidangNama = $p['nama_bidang_urusan'] ?? '-';
                            $programNama = $p['nama_program'] ?? $p['program_pd'] ?? '-';
                            
                            $kodeUrusan = $p['kode_urusan'] ?? '-';
                            $kodeBidang = $p['kode_bidang_urusan'] ?? '-';
                            $kodeProgram = $p['kode_program'] ?? '-';
                        ?>
                            <tr>
                                <td class="text-center"><?= $No++ ?></td>
                                <td><?= htmlspecialchars($p['Sasaran'] ?? '-') ?></td>
                                <td class="text-urusan">
                                    <strong><?= htmlspecialchars($urusanNama) ?></strong>
                                    <br>
                                </td>
                                <td class="text-bidang">
                                    <strong><?= htmlspecialchars($bidangNama) ?></strong>
                                    <br>
                                </td>
                                <td class="text-program">
                                    <?= nl2br(htmlspecialchars($programNama)) ?>
                                    <?php if ($kodeProgram && $kodeProgram != '-'): ?>
                                        <br>
                                        <span class="badge-kode">Kode Program: <?= htmlspecialchars($kodeProgram) ?></span>
                                    <?php endif; ?>
                                </td>

                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <td class="text-center">
                                    <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                        <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg BtnEdit"
                                            data-id="<?= $p['id'] ?>"
                                            data-sasaran="<?= $p['sasaran_id'] ?? '' ?>"
                                            data-urusan="<?= htmlspecialchars($p['urusan_id'] ?? '', ENT_QUOTES) ?>"
                                            data-bidang="<?= htmlspecialchars($p['bidang_urusan_id'] ?? '', ENT_QUOTES) ?>"
                                            data-program="<?= htmlspecialchars($p['program_pd'] ?? '', ENT_QUOTES) ?>"
                                        >
                                            <i class="notika-icon notika-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg BtnHapus"
                                            data-id="<?= $p['id'] ?>"
                                        >
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
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- ============================================================ -->
  <!-- MODAL INPUT PROGRAM PD                                       -->
  <!-- ============================================================ -->
  <div class="modal fade" id="ModalInputProgramPD" role="dialog">
    <div class="modal-dialog modal-lg-custom" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Tambah Program PD</b></h4>
        </div>
        <div class="modal-body">

          <!-- SASARAN -->
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3"><label class="hrzn-fm"><b>Sasaran</b></label></div>
              <div class="col-lg-8">
                <select class="form-control input-sm" id="SasaranAdd">
                  <option value="">-- Pilih Sasaran --</option>
                  <?php foreach($Sasaran as $s){ ?>
                    <option value="<?= $s['Id'] ?>"><?= htmlspecialchars($s['Sasaran']) ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- TABS: NOMENKLATUR vs MANUAL -->
          <ul class="nav nav-tabs" id="programTabAdd">
            <li class="active"><a href="#tab_nomenklatur_add" data-toggle="tab">📋 Pilih dari Nomenklatur</a></li>
            <li><a href="#tab_manual_add" data-toggle="tab">✏️ Isi Manual</a></li>
          </ul>

          <div class="tab-content">

            <!-- TAB NOMENKLATUR -->
            <div class="tab-pane fade in active" id="tab_nomenklatur_add">
              <div class="nomenklatur-container">
                <div class="breadcrumb-nomenklatur">
                  <span class="badge">📁 Jalur Pilihan</span>
                  <span id="path_display_add">Belum ada yang dipilih</span>
                </div>

                <div class="row">
                  <div class="col-md-4 cascading-select">
                    <label><b>1. Urusan</b></label>
                    <select class="form-control" id="add_select_urusan">
                      <option value="">-- Pilih Urusan --</option>
                    </select>
                  </div>
                  <div class="col-md-4 cascading-select">
                    <label><b>2. Bidang Urusan</b></label>
                    <select class="form-control" id="add_select_bidang" disabled>
                      <option value="">-- Pilih Bidang Urusan --</option>
                    </select>
                  </div>
                  <div class="col-md-4 cascading-select">
                    <label><b>3. Program</b></label>
                    <select class="form-control" id="add_select_program" disabled>
                      <option value="">-- Pilih Program --</option>
                    </select>
                  </div>
                </div>

                <div class="info-nomenklatur" id="info_nomenklatur_add">
                  <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_add"></span>
                </div>

                <div class="selected-info" id="selected_info_add">
                  <span class="label">✅ Akan disimpan:</span><br>
                  <span class="value" id="selected_urusan_add">Urusan: -</span><br>
                  <span class="value" id="selected_bidang_add">Bidang Urusan: -</span><br>
                  <span class="value" id="selected_program_add">Program PD: -</span>
                </div>

                <!-- Preview Fields (hidden) -->
                <div class="preview-field">
                  <input type="hidden" id="preview_kode_urusan_add" value="">
                  <input type="hidden" id="preview_kode_bidang_add" value="">
                  <input type="hidden" id="preview_program_add" value="">
                </div>
              </div>
            </div>

            <!-- TAB MANUAL -->
            <div class="tab-pane fade" id="tab_manual_add">
              <div class="manual-input-group">
                <div class="panel-heading">✏️ Isi Manual Program PD</div>
                <div class="form-group">
                  <label><b>Kode Urusan</b></label>
                  <input type="text" class="form-control" id="urusan_manual_add" placeholder="Isi kode urusan manual...">
                </div>
                <div class="form-group">
                  <label><b>Kode Bidang Urusan</b></label>
                  <input type="text" class="form-control" id="bidang_manual_add" placeholder="Isi kode bidang urusan manual...">
                </div>
                <div class="form-group">
                  <label><b>Program PD</b></label>
                  <textarea class="form-control" id="program_manual_add" rows="3" placeholder="Isi program PD manual..."></textarea>
                </div>
                <div style="margin-top:6px; font-size:12px; color:#888;">
                  * Gunakan ini jika program tidak tersedia di nomenklatur
                </div>
              </div>
            </div>

          </div><!-- end tab-content -->

          <div class="btn-group-center">
            <button class="btn btn-success notika-btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
          </div>

        </div><!-- end modal-body -->
      </div>
    </div>
  </div>

  <!-- ============================================================ -->
  <!-- MODAL EDIT PROGRAM PD                                         -->
  <!-- ============================================================ -->
  <div class="modal fade" id="ModalEditProgramPD" role="dialog">
    <div class="modal-dialog modal-lg-custom" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Edit Program PD</b></h4>
        </div>
        <div class="modal-body">

          <input type="hidden" id="IdEdit">

          <!-- SASARAN -->
          <div class="form-group">
            <div class="row">
              <div class="col-lg-3"><label class="hrzn-fm"><b>Sasaran</b></label></div>
              <div class="col-lg-8">
                <select class="form-control input-sm" id="SasaranEdit">
                  <option value="">-- Pilih Sasaran --</option>
                  <?php foreach($Sasaran as $s){ ?>
                    <option value="<?= $s['Id'] ?>"><?= htmlspecialchars($s['Sasaran']) ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <!-- TABS: NOMENKLATUR vs MANUAL -->
          <ul class="nav nav-tabs" id="programTabEdit">
            <li class="active"><a href="#tab_nomenklatur_edit" data-toggle="tab">📋 Pilih dari Nomenklatur</a></li>
            <li><a href="#tab_manual_edit" data-toggle="tab">✏️ Isi Manual</a></li>
          </ul>

          <div class="tab-content">

            <!-- TAB NOMENKLATUR -->
            <div class="tab-pane fade in active" id="tab_nomenklatur_edit">
              <div class="nomenklatur-container">
                <div class="breadcrumb-nomenklatur">
                  <span class="badge">📁 Jalur Pilihan</span>
                  <span id="path_display_edit">Belum ada yang dipilih</span>
                </div>

                <div class="row">
                  <div class="col-md-4 cascading-select">
                    <label><b>1. Urusan</b></label>
                    <select class="form-control" id="edit_select_urusan">
                      <option value="">-- Pilih Urusan --</option>
                    </select>
                  </div>
                  <div class="col-md-4 cascading-select">
                    <label><b>2. Bidang Urusan</b></label>
                    <select class="form-control" id="edit_select_bidang" disabled>
                      <option value="">-- Pilih Bidang Urusan --</option>
                    </select>
                  </div>
                  <div class="col-md-4 cascading-select">
                    <label><b>3. Program</b></label>
                    <select class="form-control" id="edit_select_program" disabled>
                      <option value="">-- Pilih Program --</option>
                    </select>
                  </div>
                </div>

                <div class="info-nomenklatur" id="info_nomenklatur_edit">
                  <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_edit"></span>
                </div>

                <div class="selected-info" id="selected_info_edit">
                  <span class="label">✅ Akan disimpan:</span><br>
                  <span class="value" id="selected_urusan_edit">Urusan: -</span><br>
                  <span class="value" id="selected_bidang_edit">Bidang Urusan: -</span><br>
                  <span class="value" id="selected_program_edit">Program PD: -</span>
                </div>

                <!-- Preview Fields (hidden) -->
                <div class="preview-field">
                  <input type="hidden" id="preview_kode_urusan_edit" value="">
                  <input type="hidden" id="preview_kode_bidang_edit" value="">
                  <input type="hidden" id="preview_program_edit" value="">
                  <input type="hidden" id="preview_program_nama_edit" value="">
                </div>
              </div>
            </div>

            <!-- TAB MANUAL -->
            <div class="tab-pane fade" id="tab_manual_edit">
              <div class="manual-input-group">
                <div class="panel-heading">✏️ Isi Manual Program PD</div>
                <div class="form-group">
                  <label><b>Kode Urusan</b></label>
                  <input type="text" class="form-control" id="urusan_manual_edit" placeholder="Isi kode urusan manual...">
                </div>
                <div class="form-group">
                  <label><b>Kode Bidang Urusan</b></label>
                  <input type="text" class="form-control" id="bidang_manual_edit" placeholder="Isi kode bidang urusan manual...">
                </div>
                <div class="form-group">
                  <label><b>Program PD</b></label>
                  <textarea class="form-control" id="program_manual_edit" rows="3" placeholder="Isi program PD manual..."></textarea>
                </div>
                <div style="margin-top:6px; font-size:12px; color:#888;">
                  * Gunakan ini jika program tidak tersedia di nomenklatur
                </div>
              </div>
            </div>

          </div><!-- end tab-content -->

          <div class="btn-group-center">
            <button class="btn btn-success notika-btn-success" id="BtnUpdate"><b>UPDATE</b></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
          </div>

        </div><!-- end modal-body -->
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
  var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';

  // Cache nomenklatur
  var nomenklaturCache = {};

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
  // FUNGSI LOAD LEVEL - PERBAIKAN DENGAN CACHE
  // ============================================================

  function loadLevel1(prefix) {
    console.log('loadLevel1 - prefix:', prefix);
    
    var cacheKey = 'level1_root';
    if (nomenklaturCache[cacheKey]) {
      var res = nomenklaturCache[cacheKey];
      var options = '<option value="">-- Pilih Urusan --</option>';
      if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
          options += '<option value="' + res[i].Kode + '">' + 
                     res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
        }
      }
      $('#' + prefix + '_select_urusan').html(options).prop('disabled', false);
      console.log('loadLevel1 - using cache, count:', res.length);
      return;
    }

    getNomenklaturProgramPD(1, '', function(res) {
      var options = '<option value="">-- Pilih Urusan --</option>';
      if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
          options += '<option value="' + res[i].Kode + '">' + 
                     res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
        }
      }
      $('#' + prefix + '_select_urusan').html(options).prop('disabled', false);
      console.log('loadLevel1 - loaded, count:', res.length);
    });
  }

  function loadLevel2(prefix, kodeUrusan) {
    console.log('loadLevel2 - prefix:', prefix, 'kodeUrusan:', kodeUrusan);
    if (!kodeUrusan) {
      $('#' + prefix + '_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
      resetLowerLevels(prefix, 2);
      return;
    }

    var cacheKey = 'level2_' + kodeUrusan;
    if (nomenklaturCache[cacheKey]) {
      var res = nomenklaturCache[cacheKey];
      var options = '<option value="">-- Pilih Bidang Urusan --</option>';
      if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
          var dotCount = (res[i].Kode.match(/\./g) || []).length;
          if (res[i].Kode.indexOf(kodeUrusan + '.') === 0 && dotCount === 1) {
            options += '<option value="' + res[i].Kode + '">' + 
                       res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
          }
        }
      }
      $('#' + prefix + '_select_bidang').html(options).prop('disabled', false);
      console.log('loadLevel2 - using cache, count:', res.length);
      resetLowerLevels(prefix, 3);
      return;
    }

    getNomenklaturProgramPD(2, kodeUrusan, function(res) {
      var options = '<option value="">-- Pilih Bidang Urusan --</option>';
      if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
          var dotCount = (res[i].Kode.match(/\./g) || []).length;
          if (res[i].Kode.indexOf(kodeUrusan + '.') === 0 && dotCount === 1) {
            options += '<option value="' + res[i].Kode + '">' + 
                       res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
          }
        }
      }
      $('#' + prefix + '_select_bidang').html(options).prop('disabled', false);
      console.log('loadLevel2 - loaded, count:', res.length);
      resetLowerLevels(prefix, 3);
    });
  }

  function loadLevel3(prefix, kodeBidang) {
    console.log('loadLevel3 - prefix:', prefix, 'kodeBidang:', kodeBidang);
    if (!kodeBidang) {
      $('#' + prefix + '_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
      resetLowerLevels(prefix, 4);
      return;
    }

    var cacheKey = 'level3_' + kodeBidang;
    if (nomenklaturCache[cacheKey]) {
      var res = nomenklaturCache[cacheKey];
      var options = '<option value="">-- Pilih Program --</option>';
      if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
          var dotCount = (res[i].Kode.match(/\./g) || []).length;
          if (res[i].Kode.indexOf(kodeBidang + '.') === 0 && dotCount === 2) {
            options += '<option value="' + res[i].Kode + '">' + 
                       res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
          }
        }
      }
      $('#' + prefix + '_select_program').html(options).prop('disabled', false);
      console.log('loadLevel3 - using cache, count:', res.length);
      updatePathDisplay(prefix);
      return;
    }

    getNomenklaturProgramPD(3, kodeBidang, function(res) {
      var options = '<option value="">-- Pilih Program --</option>';
      if (res && res.length > 0) {
        for (var i = 0; i < res.length; i++) {
          var dotCount = (res[i].Kode.match(/\./g) || []).length;
          if (res[i].Kode.indexOf(kodeBidang + '.') === 0 && dotCount === 2) {
            options += '<option value="' + res[i].Kode + '">' + 
                       res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
          }
        }
      }
      $('#' + prefix + '_select_program').html(options).prop('disabled', false);
      console.log('loadLevel3 - loaded, count:', res.length);
      updatePathDisplay(prefix);
    });
  }

  function resetLowerLevels(prefix, startLevel) {
    if (startLevel <= 2) {
        var bidangSelect = $('#' + prefix + '_select_bidang');
        bidangSelect.html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
    }
    if (startLevel <= 3) {
        var programSelect = $('#' + prefix + '_select_program');
        programSelect.html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    }
    updatePathDisplay(prefix);
  }

  // ============================================================
  // UPDATE PATH DISPLAY - PERBAIKAN
  // ============================================================
  function updatePathDisplay(prefix) {
    var path = [];
    var kodeUrusan = '';
    var kodeBidang = '';
    var kodeProgram = '';
    var programName = '';

    // Urusan
    var urusanVal = $('#' + prefix + '_select_urusan').val();
    var urusanText = $('#' + prefix + '_select_urusan option:selected').text();
    
    if (urusanText && urusanVal && urusanVal !== '') {
        var urusanParts = urusanText.split(' - ');
        var urusanNomenklatur = urusanParts.length > 1 ? urusanParts.slice(1).join(' - ') : urusanText;
        path.push('Urusan: ' + urusanNomenklatur);
        kodeUrusan = urusanVal;
        programName = urusanNomenklatur;
    }

    // Bidang
    var bidangVal = $('#' + prefix + '_select_bidang').val();
    var bidangText = $('#' + prefix + '_select_bidang option:selected').text();
    
    if (bidangText && bidangVal && bidangVal !== '') {
        var bidangParts = bidangText.split(' - ');
        var bidangNomenklatur = bidangParts.length > 1 ? bidangParts.slice(1).join(' - ') : bidangText;
        path.push('Bidang: ' + bidangNomenklatur);
        kodeBidang = bidangVal;
        programName = bidangNomenklatur;
    }

    // Program
    var programVal = $('#' + prefix + '_select_program').val();
    var programText = $('#' + prefix + '_select_program option:selected').text();
    
    if (programText && programVal && programVal !== '') {
        var programParts = programText.split(' - ');
        var programNomenklatur = programParts.length > 1 ? programParts.slice(1).join(' - ') : programText;
        path.push('Program: ' + programNomenklatur);
        kodeProgram = programVal;
        programName = programNomenklatur;
    }

    // ============================================================
    // PERBAIKAN: Jika program tidak ditemukan, gunakan dari hidden
    // ============================================================
    var programNamaHidden = $('#' + prefix + '_program_nama').val();
    if (!programName && programNamaHidden) {
        programName = programNamaHidden;
        path.push('Program: ' + programName + ' (Manual)');
    }

    // Update breadcrumb
    $('#' + prefix + '_path_display').html(path.join(' → ') || 'Belum ada yang dipilih');

    var selectedKode = kodeProgram || kodeBidang || kodeUrusan;
    
    if (selectedKode && programName) {
        $('#' + prefix + '_info_nomenklatur').show();
        $('#' + prefix + '_selected_nomenklatur').html(
            '<strong>Kode:</strong> ' + selectedKode + '<br><strong>Program:</strong> ' + programName
        );
        
        if (prefix === 'add') {
            $('#preview_kode_urusan_add').val(kodeUrusan || '');
            $('#preview_kode_bidang_add').val(kodeBidang || '');
            $('#preview_program_add').val(programName);
        } else {
            $('#preview_kode_urusan_edit').val(kodeUrusan || '');
            $('#preview_kode_bidang_edit').val(kodeBidang || '');
            $('#preview_program_edit').val(programName);
        }
        
        $('#' + prefix + '_selected_info').show();
        $('#' + prefix + '_selected_urusan').html('Urusan: ' + (kodeUrusan || '-'));
        $('#' + prefix + '_selected_bidang').html('Bidang Urusan: ' + (kodeBidang || '-'));
        $('#' + prefix + '_selected_program').html('Program PD: ' + programName);
    } else {
        $('#' + prefix + '_info_nomenklatur').hide();
        $('#' + prefix + '_selected_info').hide();
        if (prefix === 'add') {
            $('#preview_kode_urusan_add').val('');
            $('#preview_kode_bidang_add').val('');
            $('#preview_program_add').val('');
        } else {
            $('#preview_kode_urusan_edit').val('');
            $('#preview_kode_bidang_edit').val('');
            $('#preview_program_edit').val('');
        }
    }
  }

  // ============================================================
  // FUNGSI LOAD EDIT NOMENKLATUR - PERBAIKAN TOTAL
  // ============================================================
  function loadEditNomenklatur(urusanCsv, bidangCsv, programText, prefix) {
    prefix = prefix || 'edit';
    console.log('=== loadEditNomenklatur ===');
    console.log('urusanCsv:', urusanCsv, 'type:', typeof urusanCsv);
    console.log('bidangCsv:', bidangCsv, 'type:', typeof bidangCsv);
    console.log('programText:', programText, 'type:', typeof programText);
    
    // Konversi ke string dan handle null/undefined
    urusanCsv = urusanCsv !== null && urusanCsv !== undefined ? String(urusanCsv) : '';
    bidangCsv = bidangCsv !== null && bidangCsv !== undefined ? String(bidangCsv) : '';
    programText = programText !== null && programText !== undefined ? String(programText) : '';

    console.log('urusanCsv (string):', urusanCsv);
    console.log('bidangCsv (string):', bidangCsv);
    console.log('programText (string):', programText);
    
    if (!urusanCsv || urusanCsv === '' || urusanCsv === 'null' || urusanCsv === 'undefined') {
        console.log('urusanCsv kosong, keluar');
        return;
    }

    // Parse urusanCsv
    var ids = String(urusanCsv).split(',').map(x => x.trim()).filter(x => x !== '' && x !== 'null' && x !== 'undefined');
    if (ids.length === 0) {
        console.log('ids kosong, keluar');
        return;
    }

    console.log('ids:', ids);

    var kodeUrusan = '';
    var kodeBidang = '';
    var kodeProgram = '';
    var programNama = '';

    // ============================================================
    // 1. TENTUKAN KODE URUSAN DAN BIDANG
    // ============================================================
    
    // Jika bidangCsv adalah string dan tidak kosong
    if (bidangCsv && bidangCsv !== '' && bidangCsv !== 'null' && bidangCsv !== 'undefined') {
        kodeBidang = bidangCsv;
    }

    // Jika bidangCsv kosong, coba cari dari ids
    if (!kodeBidang) {
        for (var i = 0; i < ids.length; i++) {
            var dotCount = (ids[i].match(/\./g) || []).length;
            
            if (dotCount === 0) {
                kodeUrusan = ids[i];
            } else if (dotCount === 1) {
                kodeBidang = ids[i];
                kodeUrusan = ids[i].split('.')[0];
                break;
            } else if (dotCount === 2) {
                kodeProgram = ids[i];
                kodeBidang = ids[i].split('.').slice(0, 2).join('.');
                kodeUrusan = ids[i].split('.')[0];
                break;
            }
        }
    } else {
        // bidangCsv sudah ada
        var dotCountBidang = (kodeBidang.match(/\./g) || []).length;
        
        if (dotCountBidang === 0) {
            kodeUrusan = kodeBidang;
            kodeBidang = '';
        } else if (dotCountBidang === 1) {
            kodeUrusan = kodeBidang.split('.')[0];
        } else if (dotCountBidang === 2) {
            kodeProgram = kodeBidang;
            kodeBidang = kodeBidang.split('.').slice(0, 2).join('.');
            kodeUrusan = kodeBidang.split('.')[0];
        }
    }

    // ============================================================
    // 2. CARI KODE PROGRAM DARI NAMA PROGRAM
    // ============================================================
    // Jika programText ada dan tidak kosong, cari kode program yang sesuai
    if (programText && programText !== '' && programText !== 'null' && programText !== 'undefined') {
        // Simpan nama program untuk referensi
        programNama = programText;
        
        // Coba cari kode program dari nomenklatur berdasarkan nama
        // Ini akan dilakukan setelah dropdown program diisi
    }

    // Jika kodeUrusan masih kosong tapi kodeBidang ada
    if (!kodeUrusan && kodeBidang) {
        kodeUrusan = kodeBidang.split('.')[0];
    }

    console.log('Hasil parsing:');
    console.log('kodeUrusan:', kodeUrusan);
    console.log('kodeBidang:', kodeBidang);
    console.log('kodeProgram:', kodeProgram);
    console.log('programNama:', programNama);

    // ============================================================
    // 3. LOAD DATA KE DROPDOWN
    // ============================================================
    
    if (!kodeUrusan) {
        console.log('kodeUrusan kosong, tidak bisa load');
        return;
    }

    resetLowerLevels(prefix, 1);
    loadLevel1(prefix);
    
    setTimeout(function() {
        console.log('Setting urusan ke:', kodeUrusan);
        $('#' + prefix + '_select_urusan').val(kodeUrusan);
        loadLevel2(prefix, kodeUrusan);
        
        setTimeout(function() {
            if (kodeBidang && kodeBidang !== '') {
                console.log('Setting bidang ke:', kodeBidang);
                $('#' + prefix + '_select_bidang').val(kodeBidang);
                loadLevel3(prefix, kodeBidang);
                
                setTimeout(function() {
                    // ============================================================
                    // 4. CARI PROGRAM BERDASARKAN NAMA ATAU KODE
                    // ============================================================
                    var programSelect = $('#' + prefix + '_select_program');
                    var found = false;
                    
                    // Pertama: coba cari berdasarkan kode program
                    if (kodeProgram && kodeProgram !== '') {
                        console.log('Mencari program dengan kode:', kodeProgram);
                        programSelect.val(kodeProgram);
                        if (programSelect.val() === kodeProgram) {
                            found = true;
                            console.log('Program ditemukan dengan kode:', kodeProgram);
                        }
                    }
                    
                    // Kedua: jika tidak ditemukan, cari berdasarkan nama program
                    if (!found && programNama && programNama !== '') {
                        console.log('Mencari program dengan nama:', programNama);
                        var options = programSelect.find('option');
                        var normalizedNama = programNama.trim().toLowerCase();
                        
                        for (var i = 0; i < options.length; i++) {
                            var optionText = $(options[i]).text().trim();
                            var optionValue = $(options[i]).val();
                            
                            // Cek apakah nama program cocok (case insensitive)
                            if (optionText.toLowerCase().includes(normalizedNama) || 
                                normalizedNama.includes(optionText.toLowerCase())) {
                                console.log('Program ditemukan dengan nama:', optionText, 'value:', optionValue);
                                programSelect.val(optionValue);
                                found = true;
                                break;
                            }
                        }
                    }
                    
                    // Ketiga: jika masih tidak ditemukan, coba set sebagai teks manual
                    if (!found && programNama && programNama !== '') {
                        console.log('Program tidak ditemukan di dropdown, menggunakan teks manual');
                        // Isi manual field dengan program text
                        $('#' + prefix + '_program_manual').val(programNama);
                        // Tandai bahwa program tidak ditemukan
                        console.log('Program tidak ditemukan di nomenklatur');
                    }
                    
                    updatePathDisplay(prefix);
                }, 500);
            } else {
                updatePathDisplay(prefix);
            }
        }, 300);
    }, 300);
  }

  // ============================================================
  // EVENT NOMENKLATUR - ADD
  // ============================================================

  $('#add_select_urusan').change(function() {
    var kode = $(this).val();
    var prefix = 'add';
    resetLowerLevels(prefix, 2);
    if (kode && kode !== '') {
      loadLevel2(prefix, kode);
    }
    updatePathDisplay(prefix);
  });

  $('#add_select_bidang').change(function() {
    var kode = $(this).val();
    var prefix = 'add';
    resetLowerLevels(prefix, 3);
    if (kode && kode !== '') {
      loadLevel3(prefix, kode);
    }
    updatePathDisplay(prefix);
  });

  $('#add_select_program').change(function() {
    updatePathDisplay('add');
  });

  // ============================================================
  // EVENT NOMENKLATUR - EDIT
  // ============================================================

  $('#edit_select_urusan').change(function() {
    var kode = $(this).val();
    var prefix = 'edit';
    resetLowerLevels(prefix, 2);
    if (kode && kode !== '') {
      loadLevel2(prefix, kode);
    }
    updatePathDisplay(prefix);
  });

  $('#edit_select_bidang').change(function() {
    var kode = $(this).val();
    var prefix = 'edit';
    resetLowerLevels(prefix, 3);
    if (kode && kode !== '') {
      loadLevel3(prefix, kode);
    }
    updatePathDisplay(prefix);
  });

  $('#edit_select_program').change(function() {
    updatePathDisplay('edit');
  });

  // ============================================================
  // EVENT BUTTONS
  // ============================================================

  jQuery(document).ready(function($){

    // DataTable
    $('#data-table-basic').DataTable();

    // ============================================================
    // FILTER PROVINSI & KAB/KOTA - LANGSUNG REFRESH TANPA POP UP
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

      $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") {
          console.error("Mohon Pilih Provinsi");
          window.location.reload();
          return;
        }
        if ($("#KabKota").val() === "") {
          console.error("Mohon Pilih Kab/Kota");
          window.location.reload();
          return;
        }

        var kodeWilayah = $("#KabKota").val();

        $.ajax({
          url: BaseURL + "Daerah/SetTempKodeWilayah",
          type: "POST",
          data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { 
            $("#Filter").prop('disabled', true).text('Memuat...'); 
          },
          success: function(res) {
            // LANGSUNG REFRESH TANPA POP UP
            window.location.reload();
          },
          error: function() {
            // TETAP REFRESH WALAUPUN ERROR
            console.error('Gagal menghubungi server!');
            window.location.reload();
          }
        });
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
    // TOMBOL TAMBAH PROGRAM PD
    // ============================================================
    $('#BtnTambahProgramPD').click(function() {
      // Reset form
      $('#SasaranAdd').val('');
      
      // Reset nomenklatur
      resetLowerLevels('add', 1);
      nomenklaturCache = {};
      loadLevel1('add');
      
      // Reset display
      $('#path_display_add').html('Belum ada yang dipilih');
      $('#info_nomenklatur_add').hide();
      $('#selected_info_add').hide();
      $('#preview_kode_urusan_add').val('');
      $('#preview_kode_bidang_add').val('');
      $('#preview_program_add').val('');
      
      // Reset manual fields
      $('#urusan_manual_add').val('');
      $('#bidang_manual_add').val('');
      $('#program_manual_add').val('');
      
      // Aktifkan tab nomenklatur
      $('#programTabAdd a[href="#tab_nomenklatur_add"]').tab('show');
      
      $('#ModalInputProgramPD').modal('show');
    });

    // ============================================================
    // SIMPAN (ADD) - LANGSUNG REFRESH TANPA POP UP
    // ============================================================
    $("#BtnSimpan").click(function(){
      var sasaran_id = $("#SasaranAdd").val();
      
      var activeTab = $('#programTabAdd .active a').attr('href');
      var kodeUrusan = '';
      var kodeBidang = '';
      var programText = '';
      
      if (activeTab === '#tab_nomenklatur_add') {
        // Ambil dari preview fields (yang sudah di-update oleh updatePathDisplay)
        kodeUrusan = $('#preview_kode_urusan_add').val();
        kodeBidang = $('#preview_kode_bidang_add').val();
        programText = $('#preview_program_add').val();
        
        // Jika preview kosong, ambil dari dropdown
        if (!kodeUrusan) {
          var urusanVal = $("#add_select_urusan").val();
          if (urusanVal) {
            kodeUrusan = urusanVal.split('.')[0];
            programText = $("#add_select_urusan option:selected").text().split(' - ').slice(1).join(' - ');
          }
        }
        if (!kodeBidang) {
          var bidangVal = $("#add_select_bidang").val();
          if (bidangVal) {
            kodeBidang = bidangVal;
          }
        }
        if (!programText || programText.trim() === '') {
          var programVal = $("#add_select_program").val();
          if (programVal) {
            programText = $("#add_select_program option:selected").text().split(' - ').slice(1).join(' - ');
          }
        }
        
        if (!kodeUrusan) {
          console.error('Urusan wajib dipilih!');
          $('#ModalInputProgramPD').modal('hide');
          window.location.reload();
          return;
        }
        if (!programText || programText.trim() === '') {
          console.error('Program PD wajib dipilih dari nomenklatur!');
          $('#ModalInputProgramPD').modal('hide');
          window.location.reload();
          return;
        }
      } else {
        // Tab Manual
        kodeUrusan = $("#urusan_manual_add").val().trim();
        kodeBidang = $("#bidang_manual_add").val().trim();
        programText = $("#program_manual_add").val().trim();
        
        if (!kodeUrusan) {
          console.error('Kode Urusan wajib diisi!');
          $('#ModalInputProgramPD').modal('hide');
          window.location.reload();
          return;
        }
        if (!programText) {
          console.error('Program PD wajib diisi!');
          $('#ModalInputProgramPD').modal('hide');
          window.location.reload();
          return;
        }
      }

      if (!sasaran_id) {
        console.error('Sasaran wajib dipilih!');
        $('#ModalInputProgramPD').modal('hide');
        window.location.reload();
        return;
      }

      var bidangArray = kodeBidang ? [kodeBidang] : [];
      
      var payload = {
        sasaran_id: sasaran_id,
        urusan_id: [kodeUrusan],
        bidang_urusan_id: bidangArray,
        program_pd: [programText.trim()],
        [CSRF_NAME]: CSRF_TOKEN
      };

      console.log('Payload SIMPAN:', payload);

      $("#BtnSimpan").prop('disabled', true).text('MENYIMPAN...');

      $.post(BaseURL+"Daerah/InputProgramPD", payload)
        .done(function(res){
          // LANGSUNG TUTUP MODAL DAN REFRESH TANPA POP UP
          $('#ModalInputProgramPD').modal('hide');
          window.location.reload();
        })
        .fail(function(xhr, status, error){
          console.error('Error:', error);
          // TETAP TUTUP MODAL DAN REFRESH WALAUPUN ERROR
          $('#ModalInputProgramPD').modal('hide');
          window.location.reload();
        });
    });

    // ============================================================
    // EDIT - PERBAIKAN DENGAN LOAD EDIT NOMENKLATUR
    // ============================================================
    $(document).on("click", ".BtnEdit", function(){
    var id = $(this).data("id");
    var sasaran = $(this).data("sasaran");
    var urusanCsv = $(this).data("urusan");
    var bidangCsv = $(this).data("bidang");
    var programText = $(this).data("program");

    console.log('=== BtnEdit ===');
    console.log('id:', id);
    console.log('sasaran:', sasaran);
    console.log('urusanCsv:', urusanCsv);
    console.log('bidangCsv:', bidangCsv);
    console.log('programText:', programText);

    // ============================================================
    // PERBAIKAN: Konversi nilai yang mungkin null/undefined
    // ============================================================
    if (urusanCsv === null || urusanCsv === undefined || urusanCsv === '') {
        urusanCsv = '';
    }
    if (bidangCsv === null || bidangCsv === undefined || bidangCsv === '') {
        bidangCsv = '';
    }
    if (programText === null || programText === undefined || programText === '') {
        programText = '';
    }

    $("#IdEdit").val(id);
    $("#SasaranEdit").val(sasaran);

    // ============================================================
    // ISI MANUAL FIELDS SEBAGAI BACKUP
    // ============================================================
    $('#urusan_manual_edit').val(urusanCsv);
    $('#bidang_manual_edit').val(bidangCsv);
    $('#program_manual_edit').val(programText);

    // ============================================================
    // RESET NOMENKLATUR
    // ============================================================
    resetLowerLevels('edit', 1);
    nomenklaturCache = {};
    
    // Reset display
    $('#path_display_edit').html('Belum ada yang dipilih');
    $('#info_nomenklatur_edit').hide();
    $('#selected_info_edit').hide();
    $('#preview_kode_urusan_edit').val('');
    $('#preview_kode_bidang_edit').val('');
    $('#preview_program_edit').val('');
    
    // ============================================================
    // LOAD DATA KE DROPDOWN
    // ============================================================
    if (urusanCsv && urusanCsv !== '') {
        loadEditNomenklatur(urusanCsv, bidangCsv, programText, 'edit');
    } else {
        loadLevel1('edit');
    }

    // Aktifkan tab nomenklatur
    $('#programTabEdit a[href="#tab_nomenklatur_edit"]').tab('show');

    $("#ModalEditProgramPD").modal("show");
});

    // ============================================================
    // UPDATE (EDIT) - LANGSUNG REFRESH TANPA POP UP
    // ============================================================
    $("#BtnUpdate").click(function(){
    var id = $("#IdEdit").val();
    var sasaran_id = $("#SasaranEdit").val();
    
    var activeTab = $('#programTabEdit .active a').attr('href');
    var kodeUrusan = '';
    var kodeBidang = '';
    var programText = '';
    var bidangArray = [];
    
    if (activeTab === '#tab_nomenklatur_edit') {
        // Ambil dari preview fields
        kodeUrusan = $('#preview_kode_urusan_edit').val();
        kodeBidang = $('#preview_kode_bidang_edit').val();
        programText = $('#preview_program_edit').val();
        
        // Jika programText kosong, coba ambil dari hidden program_nama
        if (!programText || programText.trim() === '') {
            programText = $('#preview_program_nama_edit').val();
        }
        
        // Jika masih kosong, ambil dari dropdown
        if (!programText || programText.trim() === '') {
            var programVal = $("#edit_select_program").val();
            if (programVal) {
                programText = $("#edit_select_program option:selected").text().split(' - ').slice(1).join(' - ');
            }
        }
        
        if (!kodeUrusan) {
            console.error('Urusan wajib dipilih!');
            $('#ModalEditProgramPD').modal('hide');
            window.location.reload();
            return;
        }
        if (!programText || programText.trim() === '') {
            console.error('Program PD wajib diisi!');
            $('#ModalEditProgramPD').modal('hide');
            window.location.reload();
            return;
        }
    } else {
        // Tab Manual
        kodeUrusan = $("#urusan_manual_edit").val().trim();
        kodeBidang = $("#bidang_manual_edit").val().trim();
        programText = $("#program_manual_edit").val().trim();
        
        if (!kodeUrusan) {
            console.error('Kode Urusan wajib diisi!');
            $('#ModalEditProgramPD').modal('hide');
            window.location.reload();
            return;
        }
        if (!programText) {
            console.error('Program PD wajib diisi!');
            $('#ModalEditProgramPD').modal('hide');
            window.location.reload();
            return;
        }
    }

      if (!id) {
        console.error('ID tidak valid!');
        $('#ModalEditProgramPD').modal('hide');
        window.location.reload();
        return;
      }
      if (!sasaran_id) {
        console.error('Sasaran wajib dipilih!');
        $('#ModalEditProgramPD').modal('hide');
        window.location.reload();
        return;
      }

      bidangArray = kodeBidang ? [kodeBidang] : [];
      
      console.log('DEBUG UPDATE - Final payload:');
      console.log('  id:', id);
      console.log('  sasaran_id:', sasaran_id);
      console.log('  urusan_id:', [kodeUrusan]);
      console.log('  bidang_urusan_id:', bidangArray);
      console.log('  program_pd:', [programText.trim()]);

      var payload = {
        id: id,
        sasaran_id: sasaran_id,
        urusan_id: [kodeUrusan],
        bidang_urusan_id: bidangArray,
        program_pd: [programText.trim()],
        [CSRF_NAME]: CSRF_TOKEN
      };

      $("#BtnUpdate").prop('disabled', true).text('MENYIMPAN...');

      $.post(BaseURL+"Daerah/EditProgramPD", payload)
        .done(function(res){
          // LANGSUNG TUTUP MODAL DAN REFRESH TANPA POP UP
          $('#ModalEditProgramPD').modal('hide');
          window.location.reload();
        })
        .fail(function(xhr, status, error){
          console.error('Error:', error);
          // TETAP TUTUP MODAL DAN REFRESH WALAUPUN ERROR
          $('#ModalEditProgramPD').modal('hide');
          window.location.reload();
        });
    });

    // ============================================================
    // HAPUS - LANGSUNG REFRESH TANPA POP UP
    // ============================================================
    $(document).on('click', '.BtnHapus', function(){
      if(!confirm("Yakin ingin menghapus data ini?")) return;
      $.post(BaseURL+"Daerah/HapusProgramPD", {
        id: $(this).data('id'),
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        // LANGSUNG REFRESH TANPA POP UP
        window.location.reload();
      }).fail(function(){
        console.error('Terjadi kesalahan pada server!');
        window.location.reload();
      });
    });

    // ============================================================
    // RESET CACHE SAAT MODAL DITUTUP
    // ============================================================
    $('#ModalInputProgramPD').on('hidden.bs.modal', function() {
      // Reset cache untuk memastikan data segar saat modal dibuka lagi
      nomenklaturCache = {};
    });

    $('#ModalEditProgramPD').on('hidden.bs.modal', function() {
      nomenklaturCache = {};
    });

  });
</script>

</body>
</html>