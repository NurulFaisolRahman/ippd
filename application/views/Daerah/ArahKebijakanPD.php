<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* ========== UKURAN FONT TABEL SAJA ========== */
/* Judul tabel (th) - ukuran 12px dan BOLD */
#data-table-arah th {
    font-size: 12px;
    font-weight: bold;
}

/* Isi tabel (td) - ukuran 12px, normal (tidak bold) */
#data-table-arah td {
    font-size: 12px;
    font-weight: normal;
}

#data-table-arah {
    font-size: 12px;
}
</style>


<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 4px 18px rgba(0,0,0,0.06); padding: 25px 25px 30px; background: #fff; border: 1px solid #e2e8f0;">

            <!-- FILTER WILAYAH (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div class="filter-wrapper" style="background: #f8fafc; padding: 18px 20px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 25px;">
                <div style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 15px;">

                  <div style="flex: 1 1 200px; min-width: 180px;">
                    <label for="Provinsi" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block;">Provinsi</label>
                    <select class="form-control" id="Provinsi" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; width: 100%;">
                      <option value="">Pilih Provinsi</option>
                      <?php foreach ($Provinsi as $prov) { ?>
                        <option value="<?= html_escape($prov['Kode']) ?>"
                          <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                          <?= html_escape($prov['Nama']) ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div style="flex: 1 1 200px; min-width: 180px;">
                    <label for="KabKota" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block;">Kab/Kota</label>
                    <select class="form-control" id="KabKota" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; width: 100%;">
                      <option value="">Pilih Kab/Kota</option>
                    </select>
                  </div>

                  <!-- FILTER INSTANSI -->
                  <div id="FilterInstansiGroup" style="flex: 1 1 220px; min-width: 180px; display: none;">
                    <label for="FilterInstansiBeforeLogin" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block;">Filter Instansi</label>
                    <select class="form-control" id="FilterInstansiBeforeLogin" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; width: 100%;">
                      <option value="">-- Semua Instansi --</option>
                    </select>
                  </div>

                  <div style="flex: 0 0 auto;">
                    <button class="btn btn-primary notika-btn-primary" id="Filter" style="height: 38px; padding: 0 22px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 2px 4px rgba(0,102,204,0.2);">
                      <i class="notika-icon bi bi-filter"></i> <span>Filter</span>
                    </button>
                  </div>

                </div>
              </div>

              <?php if (!empty($KodeWilayah)) { ?>
                <?php
                  $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                  $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                ?>
                <div class="alert alert-info" style="border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #00c292; background: #e8f9f5; color: #007a5c; border-top: none; border-right: none; border-bottom: none; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                  <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                  <?php 
                  $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                  if (!empty($filter_instansi_id)) { 
                    $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                  ?>
                    <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                  <?php } ?>
                </div>
              <?php } ?>
            <?php } ?>
            <!-- END FILTER WILAYAH -->

            <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
            <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
              <div class="filter-wrapper" style="background: #f8fafc; padding: 18px 20px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 25px;">
                <div style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 15px;">
                  <div style="flex: 1 1 300px; min-width: 200px;">
                    <label for="FilterInstansi" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block;">Filter Instansi</label>
                    <select class="form-control" id="FilterInstansi" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; width: 100%;">
                      <option value="">-- Semua Instansi --</option>
                      <?php foreach ($ListInstansi as $ins) { ?>
                        <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                          <?= html_escape($ins['nama']) ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div style="flex: 0 0 auto; display: flex; gap: 10px;">
                    <button class="btn btn-info notika-btn-info" id="FilterInstansiBtn" style="height: 38px; padding: 0 20px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                      <i class="notika-icon bi bi-funnel"></i> <span>Tampilkan</span>
                    </button>
                    <button class="btn btn-default notika-btn-default" id="ResetFilterBtn" style="height: 38px; padding: 0 20px; border-radius: 6px; font-weight: 600; background: #fff; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                      <i class="notika-icon bi bi-arrow-clockwise"></i> <span>Reset</span>
                    </button>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- END FILTER INSTANSI -->

            <?php if ($IsRole4) { ?>
              <div class="basic-tb-hd" style="margin-bottom: 20px;">
                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInput" style="height: 38px; padding: 0 20px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 2px 5px rgba(0,194,146,0.25);">
                  <i class="notika-icon bi bi-plus-lg" style="font-size: 15px;"></i> <span>Tambah Arah Kebijakan</span>
                </button>
              </div>
            <?php } ?>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive">
              <table id="data-table-arah" class="table table-striped">
                <thead>
                  <tr>
                    <th style="width:60px;">NO</th>
                    <th>PERMASALAHAN</th>
                    <th>ISU STRATEGIS</th>
                    <th>TUJUAN PD</th>
                    <th>SASARAN PD</th>
                    <th>STRATEGI</th>
                    <th>ARAH KEBIJAKAN</th>
                    <?php if ($IsRole4) { ?>
                      <th class="text-center" style="width:120px;">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($ArahKebijakanPD)) { ?>
                    <?php $no=1; foreach ($ArahKebijakanPD as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['masalah'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['isu_strategis'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['tujuan_pd'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['sasaran_pd'] ?? '-') ?></td>
                        <td><?= nl2br(htmlspecialchars($row['strategi'] ?? '-')) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['arah_kebijakan'] ?? '-')) ?></td>

                        <?php if ($IsRole4) { ?>
                          <td class="text-center" style="vertical-align: middle;">
                            <?php if ($InstansiId == ($row['id_instansi'] ?? null)) { ?>
                              <div class="btn-action-group">
                                <button class="btn btn-warning btn-sm btn-action-edit BtnEdit"
                                  data-id="<?= $row['id'] ?>"
                                  data-permasalahan_id="<?= $row['permasalahan_id'] ?>"
                                  data-isu_id="<?= $row['isu_strategis_id'] ?>"
                                  data-tujuan_id="<?= $row['tujuan_id'] ?>"
                                  data-sasaran_id="<?= $row['sasaran_id'] ?>"
                                  data-strategi="<?= html_escape($row['strategi']) ?>"
                                  data-arah="<?= html_escape($row['arah_kebijakan']) ?>"
                                  title="Edit Data">
                                  <i class="notika-icon notika-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm btn-action-delete BtnHapus"
                                  data-id="<?= $row['id'] ?>"
                                  title="Hapus Data">
                                  <i class="notika-icon notika-trash"></i>
                                </button>
                              </div>
                            <?php } else { ?>
                              <span class="text-muted">-</span>
                            <?php } ?>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="<?= $IsRole4 ? '8' : '7' ?>" class="text-center">
                        <i>Belum ada data Arah Kebijakan PD</i>
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

<!-- ================= MODAL INPUT ================= -->
<div class="modal fade" id="ModalInput">
  <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Tambah Arah Kebijakan PD</b></h4>
      </div>

      <div class="modal-body">
        <?php if (!empty($NamaInstansi)) { ?>
          <div class="alert alert-info">
            <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
          </div>
        <?php } ?>

        <div class="form-group">
          <label><b>Permasalahan</b></label>
          <select id="PermasalahanId" class="form-control">
            <option value="">Pilih Permasalahan</option>
            <?php foreach($ListPermasalahan as $p){ ?>
              <option value="<?= $p['id'] ?>"><?= html_escape($p['masalah']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Isu Strategis</b></label>
          <select id="IsuStrategisId" class="form-control">
            <option value="">Pilih Isu Strategis</option>
            <?php foreach($ListIsuStrategis as $i){ ?>
              <option value="<?= $i['id'] ?>"><?= html_escape($i['isu_strategis']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Tujuan PD</b></label>
          <select id="TujuanId" class="form-control">
            <option value="">Pilih Tujuan</option>
            <?php foreach($ListTujuanPD as $t){ ?>
              <option value="<?= $t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Sasaran PD</b></label>
          <select id="SasaranId" class="form-control">
            <option value="">Pilih Sasaran</option>
            <?php foreach($ListSasaranPD as $s){ ?>
              <option value="<?= $s['id'] ?>"><?= html_escape($s['sasaran_pd']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Strategi</b> <span class="text-danger">*</span></label>
          <textarea id="Strategi" class="form-control" rows="2"></textarea>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan</b> <span class="text-danger">*</span></label>
          <textarea id="ArahKebijakan" class="form-control" rows="2"></textarea>
        </div>

        <button class="btn btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
      </div>
    </div>
  </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="ModalEdit">
  <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Edit Arah Kebijakan PD</b></h4>
      </div>

      <div class="modal-body">
        <input type="hidden" id="EditId">

        <div class="form-group">
          <label><b>Permasalahan</b></label>
          <select id="EditPermasalahanId" class="form-control">
            <option value="">Pilih Permasalahan</option>
            <?php foreach($ListPermasalahan as $p){ ?>
              <option value="<?= $p['id'] ?>"><?= html_escape($p['masalah']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Isu Strategis</b></label>
          <select id="EditIsuStrategisId" class="form-control">
            <option value="">Pilih Isu Strategis</option>
            <?php foreach($ListIsuStrategis as $i){ ?>
              <option value="<?= $i['id'] ?>"><?= html_escape($i['isu_strategis']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Tujuan PD</b></label>
          <select id="EditTujuanId" class="form-control">
            <option value="">Pilih Tujuan</option>
            <?php foreach($ListTujuanPD as $t){ ?>
              <option value="<?= $t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Sasaran PD</b></label>
          <select id="EditSasaranId" class="form-control">
            <option value="">Pilih Sasaran</option>
            <?php foreach($ListSasaranPD as $s){ ?>
              <option value="<?= $s['id'] ?>"><?= html_escape($s['sasaran_pd']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Strategi</b> <span class="text-danger">*</span></label>
          <textarea id="EditStrategi" class="form-control" rows="2"></textarea>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan</b> <span class="text-danger">*</span></label>
          <textarea id="EditArahKebijakan" class="form-control" rows="2"></textarea>
        </div>

        <button class="btn btn-success" id="BtnUpdate"><b>SIMPAN</b></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
      </div>
    </div>
  </div>
</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

jQuery(document).ready(function($){

  // Inisialisasi DataTable
  if ($('#data-table-arah').length > 0) {
    try {
      if ($.fn.DataTable.isDataTable('#data-table-arah')) {
        $('#data-table-arah').DataTable().destroy();
      }
      $('#data-table-arah').DataTable({
        "pageLength": 10,
        "ordering": false,
        "language": {
          "emptyTable": "Tidak ada数据",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "infoEmpty": "Tidak ada数据",
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

  // =========================
  // FILTER WILAYAH SEBELUM LOGIN
  // =========================
  <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

    $("#Provinsi").change(function() {
      var provinsiKode = $(this).val();
      if (provinsiKode === "") {
        $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
        $("#FilterInstansiGroup").hide();
        return;
      }

      $.ajax({
        url: BaseURL + "Instansi/GetListKabKota",
        type: "POST",
        data: { Kode: provinsiKode, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        beforeSend: function() { 
          $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
          $("#FilterInstansiGroup").hide();
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
        error: function() { alert("Gagal memuat data Kab/Kota"); }
      });
    });

    $("#KabKota").change(function() {
      var kabKotaKode = $(this).val();
      if (kabKotaKode === "") {
        $("#FilterInstansiGroup").hide();
        return;
      }

      $.ajax({
        url: BaseURL + "Instansi/GetListInstansiLevel4",
        type: "POST",
        data: { kode_wilayah: kabKotaKode, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        beforeSend: function() {
          $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
          $("#FilterInstansiGroup").show();
        },
        success: function(Data) {
          var options = '<option value="">-- Semua Instansi --</option>';
          if (Data && Data.length > 0) {
            for (let i = 0; i < Data.length; i++) {
              var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
              options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
            }
          }
          $("#FilterInstansiBeforeLogin").html(options);
          $("#FilterInstansiGroup").show();
        },
        error: function() { alert("Gagal memuat data Instansi"); }
      });
    });

    $("#Filter").click(function() {
      if ($("#Provinsi").val() === "") { alert("Mohon Pilih Provinsi"); return; }
      if ($("#KabKota").val() === "") { alert("Mohon Pilih Kab/Kota"); return; }

      var kodeWilayah = $("#KabKota").val();
      var instansiId = $("#FilterInstansiBeforeLogin").val();
      
      $.ajax({
        url: BaseURL + "Instansi/SetTempKodeWilayah",
        type: "POST",
        data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
        beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
        success: function(res) {
          if (res === '1') {
            var redirectUrl = BaseURL + "Instansi/ArahKebijakanPD";
            if (instansiId && instansiId != '') {
              redirectUrl += "?instansi_id=" + instansiId;
            }
            window.location.href = redirectUrl;
          } else {
            alert(res || "Gagal menyimpan filter wilayah!");
            $("#Filter").prop('disabled', false).text('Filter');
          }
        },
        error: function() { alert("Gagal menghubungi server!"); }
      });
    });

    <?php if (!empty($KodeWilayah)) { ?>
      var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
      var kodeKab  = "<?= $KodeWilayah ?>";
      $("#Provinsi").val(kodeProv).trigger('change');
      setTimeout(function() {
        $("#KabKota").val(kodeKab).trigger('change');
        <?php if (!empty($FilterInstansiId)) { ?>
          setTimeout(function() {
            if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
              $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
            }
          }, 800);
        <?php } ?>
      }, 500);
    <?php } ?>

  <?php } ?>

  // =========================
  // FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4)
  // =========================
  <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    $("#FilterInstansiBtn").click(function() {
      var instansiId = $("#FilterInstansi").val();
      var url = BaseURL + "Instansi/ArahKebijakanPD";
      if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
      window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/ArahKebijakanPD"; });
  <?php } ?>

  // =========================
  // CRUD OPERATIONS (HANYA UNTUK ROLE 4)
  // =========================
  <?php if ($IsRole4) { ?>

  // SIMPAN
  $("#BtnSimpan").click(function(){
    var strategi = $("#Strategi").val().trim();
    var arah = $("#ArahKebijakan").val().trim();

    if(!strategi){ alert("Strategi harus diisi!"); return; }
    if(!arah){ alert("Arah Kebijakan harus diisi!"); return; }

    $.ajax({
      url: BaseURL + "Instansi/InputArahKebijakanPD",
      type: "POST",
      data: {
        permasalahan_id: $("#PermasalahanId").val(),
        isu_strategis_id: $("#IsuStrategisId").val(),
        tujuan_id: $("#TujuanId").val(),
        sasaran_id: $("#SasaranId").val(),
        strategi: strategi,
        arah_kebijakan: arah,
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res == "1") window.location.reload();
        else alert(res || "Gagal simpan!");
      },
      error: function(){ alert("Gagal request!"); }
    });
  });

  // BUKA MODAL EDIT
  $(document).on("click", ".BtnEdit", function(){
    $("#EditId").val($(this).data("id"));
    $("#EditPermasalahanId").val($(this).data("permasalahan_id"));
    $("#EditIsuStrategisId").val($(this).data("isu_id"));
    $("#EditTujuanId").val($(this).data("tujuan_id"));
    $("#EditSasaranId").val($(this).data("sasaran_id"));
    $("#EditStrategi").val($(this).data("strategi"));
    $("#EditArahKebijakan").val($(this).data("arah"));
    $("#ModalEdit").modal("show");
  });

  // UPDATE
  $("#BtnUpdate").click(function(){
    var strategi = $("#EditStrategi").val().trim();
    var arah = $("#EditArahKebijakan").val().trim();

    if(!strategi){ alert("Strategi harus diisi!"); return; }
    if(!arah){ alert("Arah Kebijakan harus diisi!"); return; }

    $.ajax({
      url: BaseURL + "Instansi/EditArahKebijakanPD",
      type: "POST",
      data: {
        id: $("#EditId").val(),
        permasalahan_id: $("#EditPermasalahanId").val(),
        isu_strategis_id: $("#EditIsuStrategisId").val(),
        tujuan_id: $("#EditTujuanId").val(),
        sasaran_id: $("#EditSasaranId").val(),
        strategi: strategi,
        arah_kebijakan: arah,
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res == "1") window.location.reload();
        else alert(res || "Gagal update!");
      },
      error: function(){ alert("Gagal request!"); }
    });
  });

  // HAPUS
  $(document).on("click", ".BtnHapus", function(){
    if(!confirm("Yakin hapus data ini?")) return;

    $.ajax({
      url: BaseURL + "Instansi/HapusArahKebijakanPD",
      type: "POST",
      data: {
        id: $(this).data("id"),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res == "1") window.location.reload();
        else alert(res || "Gagal hapus!");
      },
      error: function(){ alert("Gagal request!"); }
    });
  });

  <?php } ?>

});
</script>

</body>
</html>