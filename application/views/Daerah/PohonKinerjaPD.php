<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="data-table-list">

            <!-- FILTER WILAYAH -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div class="form-example-wrap mb-4">
                <div class="form-group row">
                  <div class="col-md-3">
                    <label><b>Provinsi</b></label>
                    <select class="form-control" id="Provinsi">
                      <option value="">Pilih Provinsi</option>
                      <?php foreach ($Provinsi as $prov) { ?>
                        <option value="<?= html_escape($prov['Kode']) ?>">
                          <?= html_escape($prov['Nama']) ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label><b>Kab/Kota</b></label>
                    <select class="form-control" id="KabKota">
                      <option value="">Pilih Kab/Kota</option>
                    </select>
                  </div>
                  <div class="col-md-2 mt-4">
                    <button class="btn btn-primary btn-block" id="Filter"><b>Filter</b></button>
                  </div>
                </div>
              </div>
              <?php if (!empty($NamaWilayah)) { ?>
                <div class="alert alert-info">
                  <strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah) ?>
                </div>
              <?php } ?>
            <?php } ?>

            <!-- TOMBOL TAMBAH LEVEL 1 -->
            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              <div class="basic-tb-hd mb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#ModalPKPDLevel1">
                  <i class="fa fa-plus"></i> Tambah ULTIMATE OUTCOME PD (Level 1)
                </button>
              </div>
            <?php } ?>

            <!-- TABEL UTAMA -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="60" class="text-center">NO</th>
                    <th>ULTIMATE OUTCOME PD<br><small>(Level 1)</small></th>
                    <th>INTERMEDIATE OUTCOME PD<br><small>(Level 2)</small></th>
                    <th>IMMEDIATE OUTCOME PD<br><small>(Level 3)</small></th>
                    <th>OUTPUT PD<br><small>(Level 4)</small></th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th width="120" class="text-center">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($PohonKinerja)) { $no = 1; foreach($PohonKinerja as $row){ ?>
                    <tr data-id="<?= (int)$row['id'] ?>">
                      <td class="text-center align-middle"><?= $no++ ?></td>

                      <!-- LEVEL 1 -->
                      <td style="vertical-align:top;">
                        <div style="display:flex; flex-direction:column; height:100%;">
                          <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                              <?php if (!empty(trim($row['ultimate_outcome'] ?? ''))) { ?>
                                <button class="btn btn-sm btn-primary BtnEditLevel" data-level="1" data-id="<?= $row['id'] ?>" style="width:30px;height:30px;padding:0;">
                                  <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger BtnHapusLevel" data-level="1" data-id="<?= $row['id'] ?>" style="width:30px;height:30px;padding:0;">
                                  <i class="fa fa-trash"></i>
                                </button>
                              <?php } ?>
                            <?php } ?>
                          </div>
                          <div style="flex-grow:1; padding:8px 5px; line-height:1.6;">
                            <?= nl2br(html_escape($row['ultimate_outcome'] ?? '—')) ?>
                          </div>
                        </div>
                      </td>

                      <?php
                      $levels = [
                        2 => ['field' => 'intermediate_outcome'],
                        3 => ['field' => 'immediate_outcome'],
                        4 => ['field' => 'output']
                      ];
                      foreach ($levels as $lvl => $info) { ?>
                        <td style="vertical-align:top;">
                          <div style="display:flex; flex-direction:column; height:100%;">
                            <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                              <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button class="btn btn-sm btn-success BtnTambahLevel" data-level="<?= $lvl ?>" data-id="<?= $row['id'] ?>" style="width:30px;height:30px;padding:0;">
                                  <i class="fa fa-plus"></i>
                                </button>
                                <?php if (!empty(trim($row[$info['field']] ?? ''))) { ?>
                                  <button class="btn btn-sm btn-primary BtnEditLevel" data-level="<?= $lvl ?>" data-id="<?= $row['id'] ?>" style="width:30px;height:30px;padding:0;">
                                    <i class="fa fa-edit"></i>
                                  </button>
                                  <button class="btn btn-sm btn-danger BtnHapusLevel" data-level="<?= $lvl ?>" data-id="<?= $row['id'] ?>" style="width:30px;height:30px;padding:0;">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                <?php } ?>
                              <?php } ?>
                            </div>
                            <div style="flex-grow:1; padding:8px 5px; line-height:1.6;">
                              <?= nl2br(html_escape($row[$info['field']] ?? '—')) ?>
                            </div>
                          </div>
                        </td>
                      <?php } ?>

                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <td class="text-center align-middle">
                          <button class="btn btn-danger btn-sm BtnHapusFull" data-id="<?= (int)$row['id'] ?>" style="width:30px;height:30px;padding:0;">
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php } } else { ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3)?6:5 ?>" class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x fa-3x mb-3 d-block opacity-50"></i>
                        Belum ada data Pohon Kinerja Perangkat Daerah<br>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <button class="btn btn-success mt-3" data-toggle="modal" data-target="#ModalPKPDLevel1">
                            <i class="fa fa-plus"></i> Tambah Data Pertama (ULTIMATE OUTCOME PD Level 1)
                          </button>
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

<!-- MODAL LEVEL 1 -->
<div class="modal fade" id="ModalPKPDLevel1" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <button type="button" class="close" data-dismiss="modal">×</button>
          ULTIMATE OUTCOME PERANGKAT DAERAH (Level 1)
        </h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="Level1Id">
        <div class="form-group">
          <label><b>Kinerja</b> <span class="text-danger">*</span></label>
          <textarea id="KinerjaLevel1" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
          <label><b>Indikator Kinerja</b></label>
          <div id="IndikatorLevel1List" class="mb-3"></div>
          <button type="button" class="btn btn-success btn-sm" id="BtnAddIndikatorLevel1">
            <i class="fa fa-plus"></i> Tambah Indikator
          </button>
        </div>
        <div class="text-right mt-4">
          <button class="btn btn-primary" id="BtnSimpanLevel1">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL LEVEL 2–4 -->
<div class="modal fade" id="ModalPKPDLevelDetail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title" id="ModalLevelTitle">Detail Level Perangkat Daerah</h4>
      </div>

      <div class="modal-body">

        <input type="hidden" id="DetailId">
        <input type="hidden" id="DetailLevel">

        <div class="form-group">
          <label><b>Tautan kinerja yang lebih tinggi</b></label>
          <select id="TautanLevel" class="form-control"></select>
        </div>

        <div class="form-group">
          <label><b>Kinerja</b> <span class="text-danger">*</span></label>
          <textarea id="KinerjaValue" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
          <label><b>Indikator Kinerja</b></label>
          <div id="IndikatorContainer"></div>
          <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddIndikator">
            <i class="fa fa-plus"></i> Tambah Indikator
          </button>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label><b>Pelaksana / Urusan</b></label>
              <select id="PelaksanaUrutan" class="form-control">
                <option value="Tinggi">Tinggi</option>
                <option value="Sedang" selected>Sedang</option>
                <option value="Rendah">Rendah</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label><b>Inovasi Daerah</b></label>
              <div id="InovasiList"></div>
              <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddInovasi">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>

            <div class="form-group mt-3">
              <label><b>Outcome Inovasi Daerah</b></label>
              <div id="OutcomeInovasiList"></div>
              <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddOutcomeInovasi">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>

            <div class="form-group mt-3">
              <label><b>Output Inovasi Daerah</b></label>
              <div id="OutputInovasiList"></div>
              <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddOutputInovasi">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
          </div>
        </div>

        <!-- CROSSCUTTING -->
        <div class="form-group">
          <label><b>Usulan Crosscutting</b></label>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background:#337ab7; color:white;">
                <tr>
                  <th class="text-center">Perangkat Daerah</th>
                  <th class="text-center">Keterangan Pengusul</th>
                  <th width="80" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody id="CrosscuttingBody"></tbody>
            </table>
          </div>
          <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddCrosscutting">
            <i class="fa fa-plus"></i> Tambah Usulan Crosscutting
          </button>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-danger" id="BtnHapusLevel">Hapus Isi Level Ini</button>
        <button class="btn btn-primary" id="BtnSimpanLevelDetail">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- STYLE TAMBAHAN -->
<style>
  .table td { padding: 12px !important; vertical-align: top !important; }
  .field-row { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
  .field-row .form-control { flex: 1; }
  textarea.form-control { resize: vertical; min-height: 120px; }
  .modal { padding-top: 70px; }
  .perangkat-select { width: 100%; min-width: 300px; }
</style>

<!-- JAVASCRIPT -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
// Variabel global
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var AllPohon = <?= json_encode($PohonKinerja ?? []) ?>;
var isEditMode = false;
var daftarPerangkat = [];

// =============================================
// FUNGSI HELPER
// =============================================

function buildTautanDropdown(level) {
  let opt = '<option value="">-- Tidak ada tautan --</option>';

  let parentMap = {
    2: { field: 'ultimate_outcome', label: 'ULTIMATE OUTCOME (Level 1)' },
    3: { field: 'intermediate_outcome', label: 'INTERMEDIATE OUTCOME (Level 2)' },
    4: { field: 'immediate_outcome', label: 'IMMEDIATE OUTCOME (Level 3)' }
  };

  let sameLevelMap = {
    2: { field: 'intermediate_outcome', label: 'INTERMEDIATE OUTCOME (Level 2)' },
    3: { field: 'immediate_outcome', label: 'IMMEDIATE OUTCOME (Level 3)' },
    4: { field: 'output', label: 'OUTPUT (Level 4)' }
  };

  let parentConfig = parentMap[level];
  let sameField    = sameLevelMap[level];

  AllPohon.forEach(function(row) {
    if (parentConfig && row[parentConfig.field] && row[parentConfig.field].trim() !== '') {
      let text = row[parentConfig.field].trim();
      let shortText = text.length > 100 ? text.substring(0,100) + '...' : text;
      opt += `<option value="${parentConfig.field}|${row.id}">${parentConfig.label} → ${shortText}</option>`;
    }

    if (sameField && row[sameField.field] && row[sameField.field].trim() !== '') {
      let text = row[sameField.field].trim();
      let shortText = text.length > 120 ? text.substring(0,120) + '...' : text;
      opt += `<option value="${sameField.field}|${row.id}">${sameField.label} → ${shortText}</option>`;
    }
  });

  return opt;
}

function addIndikator(container, val = '') {
  $(container).append(`
    <div class="field-row">
      <input type="text" class="form-control" value="${val}" placeholder="Indikator Kinerja">
      <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
    </div>
  `);
}

function addInovasi(val = '') {
  $("#InovasiList").append(`
    <div class="field-row">
      <input type="text" class="form-control" value="${val}" placeholder="Inovasi Daerah">
      <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
    </div>
  `);
}

function addOutcomeInovasi(val = '') {
  $("#OutcomeInovasiList").append(`
    <div class="field-row">
      <input type="text" class="form-control" value="${val}" placeholder="Outcome Inovasi Daerah">
      <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
    </div>
  `);
}

function addOutputInovasi(val = '') {
  $("#OutputInovasiList").append(`
    <div class="field-row">
      <input type="text" class="form-control" value="${val}" placeholder="Output Inovasi Daerah">
      <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
    </div>
  `);
}

function addCrosscutting(perangkat_id = '', keterangan = '') {
  let options = '<option value="">-- Pilih Perangkat Daerah --</option>';
  
  if (daftarPerangkat && daftarPerangkat.length > 0) {
    daftarPerangkat.forEach(item => {
      let selected = (item.id == perangkat_id) ? 'selected' : '';
      options += `<option value="${item.id}" ${selected}>${item.nama}</option>`;
    });
  } else {
    options += '<option value="" disabled>Data Perangkat Daerah tidak tersedia</option>';
  }

  $("#CrosscuttingBody").append(`
    <tr>
      <td>
        <select class="form-control perangkat-select" required>
          ${options}
        </select>
      </td>
      <td>
        <input type="text" class="form-control" 
               value="${keterangan}" 
               placeholder="Keterangan / alasan pengusul (sinergi program, dukungan anggaran, dll)">
      </td>
      <td class="text-center">
        <button class="btn btn-danger btn-sm remove-row">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
  `);
}

function loadPerangkatDaerah(callback = null) {
  if (daftarPerangkat.length > 0) {
    if (callback) callback();
    return;
  }

  $.ajax({
    url: BaseURL + "Daerah/GetPerangkatDaerahLevel2",
    type: "GET",
    dataType: "json",
    cache: false,
    timeout: 10000,
    success: function(res) {
      if (res && res.status === 'success' && Array.isArray(res.data)) {
        daftarPerangkat = res.data;
        if (callback) callback();
      } else {
        alert("Gagal memuat daftar Perangkat Daerah.");
      }
    },
    error: function() {
      alert("Gagal koneksi saat memuat daftar Perangkat Daerah.");
    }
  });
}

$(document).ready(function() {

  loadPerangkatDaerah();

  $(document).on("click", ".remove-row", function() {
    $(this).closest(".field-row, tr").remove();
  });

  // Modal Level 1
  $("#ModalPKPDLevel1").on("show.bs.modal", function() {
    $("#KinerjaLevel1").val('');
    $("#IndikatorLevel1List").empty();
    addIndikator("#IndikatorLevel1List");
  });

  $(document).on("click", ".BtnTambahLevel[data-level='1'], .BtnEditLevel[data-level='1']", function() {
    const isEdit = $(this).hasClass("BtnEditLevel");
    const id = $(this).data("id");
    $("#Level1Id").val(isEdit ? id : '');

    if (isEdit) {
      $.post(BaseURL + "Daerah/GetPohonKinerjaPDById", { id: id }, function(res) {
        $("#KinerjaLevel1").val(res.ultimate_outcome || '');
        $("#IndikatorLevel1List").empty();
        if (res.indikator_level1) {
          res.indikator_level1.split('|||').filter(v=>v.trim()).forEach(v => addIndikator("#IndikatorLevel1List", v.trim()));
        }
        if (!$("#IndikatorLevel1List .field-row").length) addIndikator("#IndikatorLevel1List");
      }, "json");
    }

    $("#ModalPKPDLevel1").modal("show");
  });

  $("#BtnAddIndikatorLevel1").click(() => addIndikator("#IndikatorLevel1List"));

  $("#BtnSimpanLevel1").click(function() {
    const id = $("#Level1Id").val();
    const kinerja = $("#KinerjaLevel1").val().trim();
    if (!kinerja) return alert("Kinerja wajib diisi!");

    let ind = [];
    $("#IndikatorLevel1List input").each(function() {
      let v = $(this).val().trim();
      if (v) ind.push(v);
    });

    let data = {
      level: 1,
      kinerja: kinerja,
      indikator_kinerja: ind.length ? ind.join("|||") : null
    };
    if (id) data.id = id;

    $.post(BaseURL + "Daerah/SimpanPohonKinerjaPD", data, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || "Terjadi kesalahan!");
    }, "json");
  });

  // Modal Level 2-4
  $(document).on("click", ".BtnTambahLevel, .BtnEditLevel", function() {
    if ($(this).data("level") == 1) return;

    const level = parseInt($(this).data("level"));
    const id = $(this).data("id");
    const isEdit = $(this).hasClass("BtnEditLevel");

    isEditMode = isEdit;

    const titleMap = {
      2: "INTERMEDIATE OUTCOME PD (Level 2)",
      3: "IMMEDIATE OUTCOME PD (Level 3)",
      4: "OUTPUT PD (Level 4)"
    };

    $("#ModalLevelTitle").text(titleMap[level]);
    $("#DetailId").val(id);
    $("#DetailLevel").val(level);

    $("#TautanLevel").html(buildTautanDropdown(level));

    $("#KinerjaValue").val('');
    $("#IndikatorContainer").empty();
    $("#InovasiList").empty();
    $("#OutcomeInovasiList").empty();
    $("#OutputInovasiList").empty();
    $("#CrosscuttingBody").empty();
    $("#PelaksanaUrutan").val("Sedang");

    if (isEdit) {
      $.post(BaseURL + "Daerah/GetPohonKinerjaPDById", { id: id }, function(res) {
        const fieldKinerja = {2:'intermediate_outcome',3:'immediate_outcome',4:'output'}[level];
        const fieldInd     = `indikator_level${level}`;
        const fieldPel     = `pelaksana_urutan_level${level}`;
        const fieldInov    = `inovasi_level${level}`;
        const fieldOutcome = `outcome_inovasi_level${level}`;
        const fieldOutput  = `output_inovasi_level${level}`;
        const fieldCrossPD = `crosscutting_pd_level${level}`;
        const fieldCrossKet= `crosscutting_ket_level${level}`;
        const fieldTautan  = `tautan_level${level}`;

        $("#KinerjaValue").val(res[fieldKinerja] || '');
        $("#PelaksanaUrutan").val(res[fieldPel] || "Sedang");
        if (res[fieldTautan]) $("#TautanLevel").val(res[fieldTautan]);

        if (res[fieldInd]) {
          res[fieldInd].split('|||').filter(v=>v.trim()).forEach(v => addIndikator("#IndikatorContainer", v.trim()));
        }
        if (!$("#IndikatorContainer .field-row").length) addIndikator("#IndikatorContainer");

        if (res[fieldInov])    res[fieldInov].split('|||').filter(v=>v.trim()).forEach(v => addInovasi(v.trim()));
        if (res[fieldOutcome]) res[fieldOutcome].split('|||').filter(v=>v.trim()).forEach(v => addOutcomeInovasi(v.trim()));
        if (res[fieldOutput])  res[fieldOutput].split('|||').filter(v=>v.trim()).forEach(v => addOutputInovasi(v.trim()));

        // Crosscutting - load dari dua kolom terpisah
        $("#CrosscuttingBody").empty();

        let pd_list  = res[fieldCrossPD]  ? JSON.parse(res[fieldCrossPD])  : [];
        let ket_list = res[fieldCrossKet] ? JSON.parse(res[fieldCrossKet]) : [];

        const max = Math.max(pd_list.length, ket_list.length);
        for (let i = 0; i < max; i++) {
          addCrosscutting(pd_list[i] || '', ket_list[i] || '');
        }

        $("#ModalPKPDLevelDetail").modal("show");
      }, "json").fail(function() {
        alert("Gagal memuat data untuk edit.");
      });
    } else {
      addIndikator("#IndikatorContainer");
      $("#ModalPKPDLevelDetail").modal("show");
    }
  });

  $("#BtnAddIndikator").click(() => addIndikator("#IndikatorContainer"));
  $("#BtnAddInovasi").click(() => addInovasi());
  $("#BtnAddOutcomeInovasi").click(() => addOutcomeInovasi());
  $("#BtnAddOutputInovasi").click(() => addOutputInovasi());

  $("#BtnAddCrosscutting").click(function() {
    if (daftarPerangkat.length === 0) {
      alert("Data Perangkat Daerah belum dimuat. Tunggu sebentar atau refresh.");
      return;
    }
    addCrosscutting();
  });

  $("#BtnSimpanLevelDetail").click(function() {
    const level = $("#DetailLevel").val();
    const id = $("#DetailId").val();
    const kinerja = $("#KinerjaValue").val().trim();

    if (!kinerja) return alert("Kinerja wajib diisi!");

    let data = {
      id: id,
      level: level,
      kinerja: kinerja,
      is_edit: isEditMode ? 1 : 0,
      pelaksana_urutan: $("#PelaksanaUrutan").val() || null,
      tautan_level: $("#TautanLevel").val() || null
    };

    let ind = [];
    $("#IndikatorContainer input").each(function(){ let v=$(this).val().trim(); if(v) ind.push(v); });
    if (ind.length) data.indikator_kinerja = ind.join("|||");

    let inv = [], oc = [], op = [];
    $("#InovasiList input").each(function(){ let v=$(this).val().trim(); if(v) inv.push(v); });
    $("#OutcomeInovasiList input").each(function(){ let v=$(this).val().trim(); if(v) oc.push(v); });
    $("#OutputInovasiList input").each(function(){ let v=$(this).val().trim(); if(v) op.push(v); });

    if (inv.length) data.inovasi_daerah = inv.join("|||");
    if (oc.length) data.outcome_inovasi = oc.join("|||");
    if (op.length) data.output_inovasi = op.join("|||");

    // CROSSCUTTING - sesuai nama field di controller
    let cross_pd = [];
    let cross_ket = [];

    $("#CrosscuttingBody tr").each(function(){
      let perangkat_id = $(this).find(".perangkat-select").val();
      let keterangan  = $(this).find("td:eq(1) input").val().trim();

      if (perangkat_id && keterangan) {
        cross_pd.push(perangkat_id);
        cross_ket.push(keterangan);
      }
    });

    if (cross_pd.length) {
      data[`crosscutting_pd_level${level}`]  = JSON.stringify(cross_pd);
      data[`crosscutting_ket_level${level}`] = JSON.stringify(cross_ket);
    }

    $.post(BaseURL + "Daerah/SimpanPohonKinerjaPD", data, function(res) {
      if (res.status === 'success') {
        location.reload();
      } else {
        alert(res.message || "Terjadi kesalahan saat menyimpan!");
      }
    }, "json").fail(function() {
      alert("Gagal menyimpan data. Periksa koneksi.");
    });
  });

  // Hapus level
  $(document).on("click", ".BtnHapusLevel", function() {
    if (!confirm("Yakin menghapus isi level ini?")) return;
    const id = $(this).data("id");
    const level = $(this).data("level");
    $.post(BaseURL + "Daerah/HapusPohonKinerjaPDField", { id: id, level: level }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || "Operasi selesai.");
    }, "json");
  });

  $("#BtnHapusLevel").click(function() {
    if (!confirm("Yakin menghapus isi level ini?")) return;
    const id = $("#DetailId").val();
    const level = $("#DetailLevel").val();
    $.post(BaseURL + "Daerah/HapusPohonKinerjaPDField", { id: id, level: level }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || "Operasi selesai.");
    }, "json");
  });

  $(document).on("click", ".BtnHapusFull", function() {
    if (!confirm("Yakin hapus seluruh baris? Data tidak bisa dikembalikan.")) return;
    $.post(BaseURL + "Daerah/HapusPohonKinerjaPD", { id: $(this).data("id") }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || "Operasi selesai.");
    }, "json");
  });
});
</script>