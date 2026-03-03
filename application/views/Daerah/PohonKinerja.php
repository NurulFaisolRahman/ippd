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
              <div class="basic-tb-hd">
                <button class="btn btn-success" data-toggle="modal" data-target="#ModalLevel1">
                  <i class="fa fa-plus"></i> Tambah KINERJA STRATEGIS DAERAH (Ultimate Outcome / Level 1)
                </button>
              </div>
            <?php } ?>

            <!-- TABEL -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="60" class="text-center">NO</th>
                    <th>KINERJA STRATEGIS DAERAH<br><small>(Ultimate Outcome / Level 1)</small></th>
                    <th>Kinerja Strategis Sektor/Bidang Urusan<br><small>(Intermediate Outcome / Level 2)</small></th>
                    <th>KINERJA TAKTIKAL<br><small>(Intermediate Outcome/ Level 3)</small></th>
                    <th>KINERJA TAKTIKAL<br><small>(Immediate Outcome/ Level 4)</small></th>
                    <th>KINERJA OPERASIONAL<br><small>(Output / Level 5)</small></th>
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
                          <div style="flex-grow:1; padding:8px 5px; ; line-height:1.6;">
                            <?= nl2br(html_escape($row['ultimate_outcome'] ?? '—')) ?>
                          </div>
                        </div>
                      </td>

                      <?php
                      $levels = [
                        2 => ['field' => 'intermediate_outcome_sektor'],
                        3 => ['field' => 'taktikal_intermediate'],
                        4 => ['field' => 'taktikal_immediate'],
                        5 => ['field' => 'output']
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
                            <div style="flex-grow:1; padding:8px 5px; ; line-height:1.6;">
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
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3)?7:6 ?>" class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x fa-3x mb-3 d-block opacity-50"></i>
                        Belum ada data Pohon Kinerja<br>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <button class="btn btn-success mt-3" data-toggle="modal" data-target="#ModalLevel1">
                            <i class="fa fa-plus"></i> Tambah Data Pertama (Level 1)
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

<!-- ================================================ -->
<!-- MODAL KHUSUS LEVEL 1 – TANPA CROSSCUTTING -->
<!-- ================================================ -->
<div class="modal fade" id="ModalLevel1" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-info-circle-fill"></i> KINERJA STRATEGIS DAERAH (Ultimate Outcome / Level 1)<button type="button" class="close" data-dismiss="modal">×</button></h5>
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

<!-- ================================================ -->
<!-- MODAL LEVEL 2–5 – SEMUA LEVEL SAMA -->
<!-- ================================================ -->
<div class="modal fade" id="ModalLevelDetail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header bg-light">
        <h3 class="modal-title" id="ModalLevelTitle">
             <button type="button" class="close" data-dismiss="modal">×</button>
          Immediate Outcome / Level <span id="LevelNumberText"></span>
        </h3>
      </div>

      <div class="modal-body">

        <input type="hidden" id="DetailId">
        <input type="hidden" id="DetailLevel">

        <!-- ================= INFO INDIKATOR ================= -->
        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">

          <!-- Tautan -->
          <div class="form-group">
            <label><b>Tautan kinerja yang lebih tinggi</b></label>
            <select id="TautanLevel" class="form-control"></select>
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja</b></label>
            <textarea id="KinerjaValue" class="form-control" rows="3"></textarea>
          </div>

          <!-- Indikator -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div id="IndikatorContainer"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddIndikator">
              <i class="fa fa-plus"></i> Add
            </button>
          </div>

          <!-- 2 KOLOM -->
         <div class="row mt-3">

  <!-- KIRI -->
  <div class="col-md-6">

    <div class="form-group">
      <label><b>Pelaksana / Urusan</b></label>
      <select id="PelaksanaUrutan" class="form-control">
        <option value="Tinggi">Tinggi</option>
        <option value="Sedang">Sedang</option>
        <option value="Rendah">Rendah</option>
      </select>
    </div>

  </div>

  <!-- KANAN -->
  <div class="col-md-6">

    <!-- Inovasi -->
    <div class="form-group">
      <label><b>Inovasi Daerah</b></label>
      <div id="InovasiList"></div>
      <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddInovasi">
        <i class="fa fa-plus"></i> Add
      </button>
    </div>

    <!-- Outcome -->
    <div class="form-group mt-3">
      <label><b>Outcome Inovasi Daerah</b></label>
      <div id="OutcomeInovasiList"></div>
      <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddOutcomeInovasi">
        <i class="fa fa-plus"></i> Add
      </button>
    </div>

    <!-- Output -->
    <div class="form-group mt-3">
      <label><b>Output Inovasi Daerah</b></label>
      <div id="OutputInovasiList"></div>
      <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddOutputInovasi">
        <i class="fa fa-plus"></i> Add
      </button>
    </div>

  </div>

</div>

        <!-- ================= CROSSCUTTING ================= -->
        <div class="form-group">
          <label><b>Crosscutting Dengan:</b></label>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style=" color:white;">
                <tr>
                  <th class="text-center">PD/UPT/Lembaga/Desa</th>
                  <th class="text-center">Pohon Kinerja</th>
                  <th class="text-center">Informasi Kegiatan</th>
                  <th width="60"></th>
                </tr>
              </thead>
              <tbody id="CrosscuttingBody"></tbody>
            </table>
          </div>

          <button type="button" class="btn btn-success btn-sm" id="BtnAddCrosscutting">
            <i class="fa fa-plus"></i> Add
          </button>
        </div>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer">
        <button class="btn btn-danger" id="BtnHapusLevel">Delete</button>
        <button class="btn btn-primary" id="BtnSimpanLevelDetail">
          Simpan Perubahan
        </button>
      </div>

    </div>
  </div>
</div>

<!-- STYLE -->
<style>
  .table td { padding: 12px !important; vertical-align: top !important; }
  .input-group { margin-bottom: 8px !important; }
  textarea.form-control { resize: vertical; min-height: 120px; }
  .w-50 { width: 50% !important; }

  .modal-content {
  border-radius: 8px;
}

.modal-header {
  border-bottom: 1px solid #ddd;
}

.modal-footer {
  border-top: 1px solid #ddd;
}

.table thead th {
  vertical-align: middle !important;
}

textarea.form-control {
  resize: vertical;
}

.field-row {
  display: flex;
  align-items: center;
  gap: 8px;
}

.field-row .form-control {
  flex: 1;
}

.field-row .btn {
  white-space: nowrap;
}

.modal {
  padding-top: 70px; /* sesuaikan tinggi navbar kamu */
}

</style>

<!-- JAVASCRIPT LENGKAP -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script>
var AllPohon = <?= json_encode($PohonKinerja ?? []) ?>;
function buildTautanDropdown(level) {

  let opt = '<option value="">-- Tidak ada tautan --</option>';

  let fieldMap = {
    2: { field: 'ultimate_outcome', label: 'Ultimate Outcome (Level 1)' },
    3: { field: 'intermediate_outcome_sektor', label: 'Intermediate Outcome (Level 2)' },
    4: { field: 'taktikal_intermediate', label: 'Taktikal Intermediate (Level 3)' },
    5: { field: 'taktikal_immediate', label: 'Immediate Outcome (Level 4)' }
  };

  let sameLevelMap = {
  2: { field: 'intermediate_outcome_sektor', label: 'Intermediate Outcome (Level 2)' },
  3: { field: 'taktikal_intermediate', label: 'Taktikal Intermediate (Level 3)' },
  4: { field: 'taktikal_immediate', label: 'Immediate Outcome (Level 4)' },
  5: { field: 'output', label: 'Output (Level 5)' }
};

  let parentConfig = fieldMap[level];
  let sameConfig = sameLevelMap[level];

  let hasData = false;

  AllPohon.forEach(function(row) {

    // 🔹 LEVEL DI ATASNYA
    if (parentConfig && row[parentConfig.field] && row[parentConfig.field].trim() !== '') {

      hasData = true;

      let text = row[parentConfig.field].trim();
      let shortText = text.length > 120 ? text.substring(0,120) + '...' : text;

      opt += `
        <option value="${parentConfig.field}|${row.id}">
          ${parentConfig.label} → ${shortText}
        </option>
      `;
    }


    // 🔹 LEVEL YANG SAMA
      if (sameConfig && row[sameConfig.field] && row[sameConfig.field].trim() !== '') {

        hasData = true;

        let text = row[sameConfig.field].trim();
        let shortText = text.length > 120 ? text.substring(0,120) + '...' : text;

        opt += `
          <option value="${sameConfig.field}|${row.id}">
            ${sameConfig.label} → ${shortText}
          </option>
        `;
      }

  });

  if (!hasData) {
    opt += `<option disabled>-- Tidak ada data tersedia --</option>`;
  }

  return opt;
}
</script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";


$(document).ready(function() {
    /* ================= FILTER ================= */
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
            } else {
              alert("Belum Ada Data Kab/Kota");
            }

            $("#KabKota").html(KabKota).prop('disabled', false);
          },
          error: function() {
            alert("Gagal memuat data Kab/Kota");
            $("#KabKota").prop('disabled', false);
          }
        });
      });

      $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") return alert("Mohon Pilih Provinsi");
        if ($("#KabKota").val() === "") return alert("Mohon Pilih Kab/Kota");

        var kodeWilayah = $("#KabKota").val();

        $.ajax({
          url: BaseURL + "Daerah/SetTempKodeWilayah",
          type: "POST",
          data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
          success: function(res) {
            if (res === '1') {
              window.location.reload();
            } else {
              alert(res || "Gagal menyimpan filter wilayah!");
              $("#Filter").prop('disabled', false).text('Filter');
            }
          },
          error: function() {
            alert("Gagal menghubungi server!");
            $("#Filter").prop('disabled', false).text('Filter');
          }
        });
      });

      // Populate kab/kota on page load jika KodeWilayah sudah ada
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
      });
      
function handleAjaxResponse(res) {
  if (typeof res === 'string') res = JSON.parse(res);

  if (res.status === 'success') {
    location.reload(); // sukses → reload tanpa alert
  } else {
    alert(res.message || "Terjadi kesalahan!"); // gagal → tetap tampil pesan
  }
}

$.ajaxSetup({
  beforeSend: function(xhr, settings) {
    if (settings.type.toUpperCase() === 'POST') {
      settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
    }
  }
});

// ────────────────────────────────────────────────
// FUNGSI TAMBAH BARIS
// ────────────────────────────────────────────────
function addIndikator(container, val = '') {
  $(container).append(`
    <div class="d-flex align-items-center mb-2 gap-2 field-row">
      <input type="text" class="form-control flex-fill" 
             value="${val}" placeholder="Indikator Kinerja">
      <button type="button" class="btn btn-danger btn-sm remove-row">
        <i class="fa fa-trash"></i>
      </button>
    </div>
  `);
}

function addInovasi(val = '') {
  $("#InovasiList").append(`
    <div class="d-flex align-items-center mb-2 gap-2 field-row">
      <input type="text" class="form-control flex-fill"
             value="${val}" placeholder="Inovasi Daerah">
      <button type="button" class="btn btn-danger btn-sm remove-row">
        <i class="fa fa-trash"></i>
      </button>
    </div>
  `);
}

function addOutcomeInovasi(val = '') {
  $("#OutcomeInovasiList").append(`
    <div class="d-flex align-items-center mb-2 gap-2 field-row">
      <input type="text" class="form-control flex-fill"
             value="${val}" placeholder="Outcome Inovasi Daerah">
      <button type="button" class="btn btn-danger btn-sm remove-row">
        <i class="fa fa-trash"></i>
      </button>
    </div>
  `);
}

function addOutputInovasi(val = '') {
  $("#OutputInovasiList").append(`
    <div class="d-flex align-items-center mb-2 gap-2 field-row">
      <input type="text" class="form-control flex-fill"
             value="${val}" placeholder="Output Inovasi Daerah">
      <button type="button" class="btn btn-danger btn-sm remove-row">
        <i class="fa fa-trash"></i>
      </button>
    </div>
  `);
}

function addCrosscutting(pd='', pohon='', info='') {
  $("#CrosscuttingBody").append(`
    <tr>
      <td><input type="text" class="form-control" value="${pd}" placeholder="PD/UPTD/Lembaga/Desa"></td>
      <td><input type="text" class="form-control" value="${pohon}" placeholder="Pohon Kinerja"></td>
      <td><input type="text" class="form-control" value="${info}" placeholder="Informasi Kegiatan"></td>
      <td><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>
    </tr>
  `);
}

$(document).on("click", ".remove-row", function() {
  $(this).closest(".input-group, tr").remove();
});

// ────────────────────────────────────────────────
// LEVEL 1 – MODAL KHUSUS
// ────────────────────────────────────────────────
$("#ModalLevel1").on("show.bs.modal", function() {
  $("#KinerjaLevel1").val('');
  $("#IndikatorLevel1List").empty();
  addIndikator("#IndikatorLevel1List");
  $(this).data("edit-id", null);
});

$(document).on("click", ".BtnTambahLevel[data-level='1'], .BtnEditLevel[data-level='1']", function() {
  const isEdit = $(this).hasClass("BtnEditLevel");
  const id = $(this).data("id");

  $("#Level1Id").val(isEdit ? id : '');

  if (isEdit) {
    $.post(BaseURL + "Daerah/GetPohonKinerjaById", { id: id }, function(res) {
      $("#KinerjaLevel1").val(res.ultimate_outcome || '');
      $("#IndikatorLevel1List").empty();
      if (res.indikator_level1) {
        res.indikator_level1.split('|||').filter(v=>v.trim()).forEach(v => addIndikator("#IndikatorLevel1List", v.trim()));
      }
      if ($("#IndikatorLevel1List .input-group").length === 0) addIndikator("#IndikatorLevel1List");
    }, "json");
  } else {
    $("#KinerjaLevel1").val('');
    $("#IndikatorLevel1List").empty();
    addIndikator("#IndikatorLevel1List");
  }

  $("#ModalLevel1").modal("show");
});

$("#BtnAddIndikatorLevel1").click(() => addIndikator("#IndikatorLevel1List"));

$("#BtnSimpanLevel1").click(function() {
 const id = $("#Level1Id").val();
  const kinerja = $("#KinerjaLevel1").val().trim();

  if (!kinerja) return alert("Kinerja wajib diisi!");

  let ind = [];
  $("#IndikatorLevel1List input").each(function(){ let v=$(this).val().trim(); if(v) ind.push(v); });

  let data = {
    level: 1,
    kinerja: kinerja,
    indikator_kinerja: ind.length ? ind.join("|||") : null
  };
  if (id) data.id = id;

  $.post(BaseURL + "Daerah/SimpanPohonKinerja", data, handleAjaxResponse)
    .fail(function(jqXHR) {
      alert("Simpan Level 1 gagal: " + (jqXHR.responseText || "Server error"));
      console.error(jqXHR);
    });
});

// ────────────────────────────────────────────────
// LEVEL 2–5 – MODAL UNIVERSAL
// ────────────────────────────────────────────────
$(document).on("click", ".BtnTambahLevel, .BtnEditLevel", function() {

  const level  = parseInt($(this).data("level"));
  let titleMap = {
  2: "Intermediate Outcome / Level 2",
  3: "Intermediate Outcome / Level 3",
  4: "Immediate Outcome / Level 4",
  5: "Output / Level 5"
};

$("#ModalLevelTitle").text(titleMap[level] || "Detail Level");
  const id     = $(this).data("id");
  const isEdit = $(this).hasClass("BtnEditLevel");
  $("#ModalLevelDetail").data("mode", isEdit ? "edit" : "add");

  if (level === 1) return;

  $("#DetailId").val(id);
  $("#DetailLevel").val(level);

  // Build dropdown
  $("#TautanLevel").html(buildTautanDropdown(level));

  // Reset semua field dulu
  $("#KinerjaValue").val('');
  $("#IndikatorContainer").empty();
  $("#InovasiList").empty();
  $("#OutcomeInovasiList").empty();
  $("#OutputInovasiList").empty();
  $("#CrosscuttingBody").empty();

  if (isEdit) {

    $.post(BaseURL + "Daerah/GetPohonKinerjaById", { id: id }, function(res) {

      const fieldKinerja = {
        2: 'intermediate_outcome_sektor',
        3: 'taktikal_intermediate',
        4: 'taktikal_immediate',
        5: 'output'
      }[level];

      const fieldIndikator = `indikator_level${level}`;
      const fieldPelaksana = `pelaksana_urutan_level${level}`;
      const fieldInovasi   = `inovasi_level${level}`;
      const fieldOutcome   = `outcome_inovasi_level${level}`;
      const fieldOutput    = `output_inovasi_level${level}`;
      const fieldCross     = `crosscutting_level${level}`;
      const fieldTautan    = `tautan_level${level}`;

      // 🔥 Ini yang membuat data terakhir muncul
      $("#KinerjaValue").val(res[fieldKinerja] || '');
      $("#PelaksanaUrutan").val(res[fieldPelaksana] || "Sedang");

      if (res[fieldTautan]) {
        $("#TautanLevel").val(res[fieldTautan]);
      }

      // Indikator
      // Indikator
        if (res[fieldIndikator]) {
        res[fieldIndikator].split('|||').forEach(v => {
            if (v.trim()) addIndikator("#IndikatorContainer", v.trim());
        });
        }

        if ($("#IndikatorContainer .input-group").length === 0) {
        addIndikator("#IndikatorContainer");
        }

      // Inovasi
      if (res[fieldInovasi]) {
        res[fieldInovasi].split('|||').forEach(v => {
          if (v.trim()) addInovasi(v.trim());
        });
      }

      if (res[fieldOutcome]) {
        res[fieldOutcome].split('|||').forEach(v => {
          if (v.trim()) addOutcomeInovasi(v.trim());
        });
      }

      if (res[fieldOutput]) {
        res[fieldOutput].split('|||').forEach(v => {
          if (v.trim()) addOutputInovasi(v.trim());
        });
      }

      if (res[fieldCross]) {
        try {
          JSON.parse(res[fieldCross]).forEach(item => {
            addCrosscutting(item.pd || '', item.pohon || '', item.info || '');
          });
        } catch(e){}
      }

      $("#ModalLevelDetail").modal("show");

    }, "json");

  } else {

    // Mode Tambah
    addIndikator("#IndikatorContainer");
    $("#PelaksanaUrutan").val("Sedang");
    $("#ModalLevelDetail").modal("show");
  }

});

// ================================
// BUTTON TAMBAH FIELD
// ================================
$("#BtnAddIndikator").click(function(){
  addIndikator("#IndikatorContainer");
});

$("#BtnAddInovasi").click(function(){
  addInovasi();
});

$("#BtnAddOutcomeInovasi").click(function(){
  addOutcomeInovasi();
});

$("#BtnAddOutputInovasi").click(function(){
  addOutputInovasi();
});

$("#BtnAddCrosscutting").click(function(){
  addCrosscutting();
});


// ================================
// SIMPAN LEVEL 2-5
// ================================
$("#BtnSimpanLevelDetail").click(function() {

  const level = $("#DetailLevel").val();
  const id = $("#DetailId").val();
  const kinerja = $("#KinerjaValue").val().trim();

  if (!kinerja) {
    alert("Kinerja wajib diisi!");
    return;
  }

let data = {
  id: id,
  level: level,
  kinerja: kinerja,
  is_edit: $("#ModalLevelDetail").data("mode") === "edit" ? 1 : 0,
  pelaksana_urutan: $("#PelaksanaUrutan").val() || null,
  tautan_level: $("#TautanLevel").val() || null
};

  let ind = [];
  $("#IndikatorContainer input").each(function(){
    let v = $(this).val().trim();
    if (v) ind.push(v);
  });
  if (ind.length) data.indikator_kinerja = ind.join("|||");

  let inv = [];
  $("#InovasiList input").each(function(){
    let v = $(this).val().trim();
    if (v) inv.push(v);
  });
  if (inv.length) data.inovasi_daerah = inv.join("|||");

  let oc = [];
  $("#OutcomeInovasiList input").each(function(){
    let v = $(this).val().trim();
    if (v) oc.push(v);
  });
  if (oc.length) data.outcome_inovasi = oc.join("|||");

  let op = [];
  $("#OutputInovasiList input").each(function(){
    let v = $(this).val().trim();
    if (v) op.push(v);
  });
  if (op.length) data.output_inovasi = op.join("|||");

  let cross = [];
  $("#CrosscuttingBody tr").each(function(){
    let pd = $(this).find("td:eq(0) input").val().trim();
    let po = $(this).find("td:eq(1) input").val().trim();
    let info = $(this).find("td:eq(2) input").val().trim();
    if (pd || po || info) cross.push({pd, pohon:po, info});
  });
  if (cross.length) data.crosscutting = JSON.stringify(cross);

  $.post(BaseURL + "Daerah/SimpanPohonKinerja", data, handleAjaxResponse)
    .fail(function(jqXHR){
      alert("Simpan gagal: " + jqXHR.status);
      console.error(jqXHR.responseText);
    });
});

// HAPUS LEVEL DARI TABEL (ICON TRASH)
$(document).on("click", ".BtnHapusLevel", function() {

  if (!confirm("Yakin menghapus isi level ini?")) return;

  const id = $(this).data("id");
  const level = $(this).data("level");

  if (!id || !level) {
    alert("ID atau Level tidak ditemukan");
    return;
  }

  $.post(BaseURL + "Daerah/HapusPohonKinerjaField", {
      id: id,
      level: level
  }, function(res){
      if (typeof res === 'string') res = JSON.parse(res);
      alert(res.message);
      if (res.status === 'success') location.reload();
  }, "json")
  .fail(function(xhr){
      alert("Gagal hapus: " + xhr.responseText);
  });

});

// ────────────────────────────────────────────────
// HAPUS LEVEL
// ────────────────────────────────────────────────
$("#BtnHapusLevel").click(function() {

  if (!confirm("Yakin menghapus isi level ini?")) return;

  const id = $("#DetailId").val();
  const level = $("#DetailLevel").val();

  if (!id || !level) {
    alert("ID atau Level tidak ditemukan");
    return;
  }

  $.post(BaseURL + "Daerah/HapusPohonKinerjaField", {
      id: id,
      level: level
  }, function(res){
      if (typeof res === 'string') res = JSON.parse(res);
      alert(res.message);
      if (res.status === 'success') location.reload();
  }, "json")
  .fail(function(xhr){
      alert("Gagal hapus: " + xhr.responseText);
  });
});

// ────────────────────────────────────────────────
// HAPUS FULL RECORD
// ────────────────────────────────────────────────
$(document).on("click", ".BtnHapusFull", function() {
  if (!confirm("Yakin menghapus seluruh record ini?")) return;
  $.post(BaseURL + "Daerah/HapusPohonKinerja", { id: $(this).data("id") }, handleAjaxResponse)
    .fail(function(jqXHR) {
      alert("Hapus full gagal: " + jqXHR.status);
    });
});

</script>