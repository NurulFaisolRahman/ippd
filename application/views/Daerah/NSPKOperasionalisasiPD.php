<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="data-table-list">

            <!-- ================= FILTER WILAYAH SEBELUM LOGIN ================= -->
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
                                <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
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

                      <!-- FILTER INSTANSI (SEBELUM LOGIN) -->
                      <div class="col-lg-3 col-md-6" id="FilterInstansiGroup" style="display: none;">
                        <div class="filter-group">
                          <label for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                          <select class="form-control filter-select" id="FilterInstansiBeforeLogin">
                            <option value="">-- Semua Instansi --</option>
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
            <!-- ================= END FILTER WILAYAH ================= -->

            <!-- ================= FILTER INSTANSI (UNTUK LOGIN BUKAN ROLE 4) ================= -->
            <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
              <div class="form-example-wrap" style="margin-bottom: 20px;">
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row filter-row">
                      <div class="col-lg-4 col-md-6">
                        <div class="filter-group">
                          <label for="FilterInstansi"><b>Filter Instansi</b></label>
                          <select class="form-control filter-select" id="FilterInstansi">
                            <option value="">-- Semua Instansi --</option>
                            <?php foreach ($ListInstansi as $ins) { ?>
                              <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                <?= html_escape($ins['nama']) ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-6">
                        <div class="filter-group" style="margin-top: 38px;">
                          <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                            <b>Tampilkan</b>
                          </button>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-6">
                        <div class="filter-group" style="margin-top: 38px;">
                          <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn">
                            <b>Reset</b>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- ================= END FILTER INSTANSI ================= -->

            <!-- TOMBOL TAMBAH (HANYA UNTUK ROLE 4) -->
            <?php if ($IsRole4) { ?>
              <div class="basic-tb-hd">
                <div class="button-icon-btn sm-res-mg-t-30">
                  <button class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInput">
                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Data</b>
                  </button>
                </div>
              </div>
              <br>
            <?php } ?>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive">
              <table id="data-table-nspk" class="table table-striped">
                <thead>
                  <tr>
                    <th style="width:60px;">NO</th>
                    <th>OPERASIONALISASI NSPK</th>
                    <th>ARAH KEBIJAKAN RPJMD</th>
                    <th>ARAH KEBIJAKAN RENSTRA PD</th>
                    <th>KETERANGAN</th>
                    <?php if ($IsRole4) { ?>
                      <th class="text-center" style="width:120px;">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($NSPKOperasionalisasiPD)) { ?>
                    <?php $no = 1; foreach ($NSPKOperasionalisasiPD as $row) { ?>
                      <?php if ($IsRole4 && ($row['id_instansi'] ?? null) != $InstansiId && empty($FilterInstansiId)) continue; ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td>
                          <?php if (!empty($row['nspk_text'])) { ?>
                              <?php if (!empty($row['nspk_text']['norma'])) { ?>
                                  <?php foreach ($row['nspk_text']['norma'] as $v) { ?>
                                      • <?= html_escape($v) ?><br>
                                  <?php } ?>
                              <?php } ?>
                              <?php if (!empty($row['nspk_text']['standar'])) { ?>
                                  <?php foreach ($row['nspk_text']['standar'] as $v) { ?>
                                      • <?= html_escape($v) ?><br>
                                  <?php } ?>
                              <?php } ?>
                              <?php if (!empty($row['nspk_text']['prosedur'])) { ?>
                                  <?php foreach ($row['nspk_text']['prosedur'] as $v) { ?>
                                      • <?= html_escape($v) ?><br>
                                  <?php } ?>
                              <?php } ?>
                              <?php if (!empty($row['nspk_text']['kriteria'])) { ?>
                                  <?php foreach ($row['nspk_text']['kriteria'] as $v) { ?>
                                      • <?= html_escape($v) ?><br>
                                  <?php } ?>
                              <?php } ?>
                          <?php } else { ?>
                              -
                          <?php } ?>
                        </td>
                        <td>
                          <?php if (!empty($row['arah_rpjmd_text']) && is_array($row['arah_rpjmd_text'])) { ?>
                              <?php foreach ($row['arah_rpjmd_text'] as $v) { ?>
                                  • <?= html_escape($v) ?><br>
                              <?php } ?>
                          <?php } else { ?>
                              -
                          <?php } ?>
                        </td>
                        <td>
                          <?php if (!empty($row['arah_renstra_text']) && is_array($row['arah_renstra_text'])) { ?>
                              <?php foreach ($row['arah_renstra_text'] as $v) { ?>
                                  • <?= html_escape($v) ?><br>
                              <?php } ?>
                          <?php } else { ?>
                              -
                          <?php } ?>
                        </td>
                        <td><?= nl2br(htmlspecialchars($row['keterangan'] ?? '')) ?></td>

                        <?php if ($IsRole4) { ?>
                          <td class="text-center">
                            <?php if (($row['id_instansi'] ?? null) == $InstansiId) { ?>
                              <button class="btn btn-warning btn-sm BtnEdit"
                                data-id="<?= (int)$row['id'] ?>"
                                data-tujuansasaran="<?= (int)$row['tujuansasaranpd_master_id'] ?>"
                                data-rpjmd="<?= html_escape($row['arah_kebijakan_rpjmd_id'] ?? '') ?>"
                                data-renstra="<?= html_escape($row['arah_kebijakan_renstra_pd_id'] ?? '') ?>"
                                data-keterangan="<?= html_escape($row['keterangan'] ?? '') ?>">
                                <i class="notika-icon notika-edit"></i>
                              </button>
                              <button class="btn btn-danger btn-sm BtnHapus"
                                data-id="<?= (int)$row['id'] ?>">
                                <i class="notika-icon notika-trash"></i>
                              </button>
                            <?php } else { ?>
                              <span class="text-muted">-</span>
                            <?php } ?>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="<?= $IsRole4 ? '6' : '5' ?>" class="text-center">
                        <i>Belum ada data NSPK Operasionalisasi PD</i>
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
<div class="modal fade" id="ModalInput" role="dialog">
  <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Tambah NSPK Operasionalisasi PD</b></h4>
      </div>

      <div class="modal-body">
        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
          <div class="alert alert-info">
            <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
          </div>
        <?php } ?>

        <div class="form-group">
          <label><b>Operasionalisasi NSPK</b> <span class="text-danger">*</span></label>
          <select id="TujuanSasaranPDId" class="form-control">
            <option value="">Pilih NSPK</option>
            <?php foreach($ListNSPK as $n){ ?>
              <option value="<?= (int)$n['id'] ?>"><?= html_escape($n['nama_nspk']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan RPJMD</b> <span class="text-danger">*</span></label>
          <div id="ContainerRPJMD">
            <div class="row mb-2 item-rpjmd" style="margin-bottom:10px;">
              <div class="col-md-10">
                <select name="arah_kebijakan_rpjmd_id[]" class="form-control">
                  <option value="">Pilih Arah Kebijakan</option>
                  <?php foreach($ListArahKebijakanRPJMD as $r){ ?>
                    <option value="<?= $r['id'] ?>">
                      <?= html_escape($r['arah_kebijakan']) ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-success BtnTambahRPJMD">+</button>
                <button type="button" class="btn btn-danger BtnHapusRPJMD">×</button>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan Renstra PD</b> <span class="text-danger">*</span></label>
          <div id="ContainerRenstra">
            <div class="row mb-2 item-renstra" style="margin-bottom:10px;">
              <div class="col-md-10">
                <select name="arah_kebijakan_renstra_pd_id[]" class="form-control">
                  <option value="">Pilih Arah Kebijakan Renstra PD</option>
                  <?php foreach($ListArahKebijakanRenstraPD as $r){ ?>
                    <option value="<?= $r['id'] ?>">
                      <?= html_escape($r['arah_kebijakan']) ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-success BtnTambahRenstra">+</button>
                <button type="button" class="btn btn-danger BtnHapusRenstra">×</button>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label><b>Keterangan (Opsional)</b></label>
          <textarea id="Keterangan" class="form-control" rows="2" placeholder="Boleh dikosongkan"></textarea>
        </div>

        <button class="btn btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
      </div>
    </div>
  </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="ModalEdit" role="dialog">
  <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Edit NSPK Operasionalisasi PD</b></h4>
      </div>

      <div class="modal-body">
        <input type="hidden" id="EditId">

        <div class="form-group">
          <label><b>Operasionalisasi NSPK</b> <span class="text-danger">*</span></label>
          <select id="EditTujuanSasaranPDId" class="form-control">
            <?php foreach($ListNSPK as $n){ ?>
              <option value="<?= (int)$n['id'] ?>"><?= html_escape($n['nama_nspk']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan RPJMD</b> <span class="text-danger">*</span></label>
          <div id="EditContainerRPJMD"></div>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan Renstra PD</b> <span class="text-danger">*</span></label>
          <div id="EditContainerRenstra"></div>
        </div>

        <div class="form-group">
          <label><b>Keterangan (Opsional)</b></label>
          <textarea id="EditKeterangan" class="form-control" rows="2"></textarea>
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
  if ($('#data-table-nspk').length > 0) {
    try {
      if ($.fn.DataTable.isDataTable('#data-table-nspk')) {
        $('#data-table-nspk').DataTable().destroy();
      }
      $('#data-table-nspk').DataTable({
        "pageLength": 10,
        "ordering": false,
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
        $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
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
            var redirectUrl = BaseURL + "Instansi/NSPKOperasionalisasiPD";
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
      var url = BaseURL + "Instansi/NSPKOperasionalisasiPD";
      if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
      window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/NSPKOperasionalisasiPD"; });
  <?php } ?>

  // =========================
  // CRUD OPERATIONS (HANYA UNTUK ROLE 4)
  // =========================
  <?php if ($IsRole4) { ?>

  // Tambah dropdown RPJMD
  $(document).on("click", ".BtnTambahRPJMD", function () {
    var newItem = $(this).closest(".item-rpjmd").clone();
    newItem.find("select").val("");
    $(this).closest(".item-rpjmd").after(newItem);
  });

  // Hapus dropdown RPJMD
  $(document).on("click", ".BtnHapusRPJMD", function () {
    if ($("#ContainerRPJMD .item-rpjmd").length == 1) {
      alert("Minimal harus ada 1 dropdown");
      return;
    }
    $(this).closest(".item-rpjmd").remove();
  });

  // Tambah dropdown Renstra
  $(document).on("click", ".BtnTambahRenstra", function () {
    var newItem = $(this).closest(".item-renstra").clone();
    newItem.find("select").val("");
    $(this).closest(".item-renstra").after(newItem);
  });

  // Hapus dropdown Renstra
  $(document).on("click", ".BtnHapusRenstra", function () {
    if ($("#ContainerRenstra .item-renstra").length == 1) {
      alert("Minimal harus ada 1 dropdown");
      return;
    }
    $(this).closest(".item-renstra").remove();
  });

  // SIMPAN
  $("#BtnSimpan").click(function(){
    var tujuansasaran = $("#TujuanSasaranPDId").val();
    if (!tujuansasaran) {
      alert("Operasionalisasi NSPK wajib dipilih!");
      return;
    }

    var rpjmd = [];
    $("select[name='arah_kebijakan_rpjmd_id[]']").each(function(){
      if($(this).val()) rpjmd.push($(this).val());
    });

    var renstra = [];
    $("select[name='arah_kebijakan_renstra_pd_id[]']").each(function(){
      if($(this).val()) renstra.push($(this).val());
    });

    if (rpjmd.length == 0) {
      alert("Minimal pilih 1 Arah Kebijakan RPJMD!");
      return;
    }

    if (renstra.length == 0) {
      alert("Minimal pilih 1 Arah Kebijakan Renstra PD!");
      return;
    }

    $.ajax({
      url: BaseURL + "Instansi/InputNSPKOperasionalisasiPD",
      type: "POST",
      data: {
        tujuansasaran_pd_id: tujuansasaran,
        arah_kebijakan_rpjmd_id: rpjmd,
        arah_kebijakan_renstra_pd_id: renstra,
        keterangan: $("#Keterangan").val(),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res == "1") window.location.reload();
        else alert(res);
      },
      error: function(){ alert("Gagal request!"); }
    });
  });

  // BUKA MODAL EDIT
  $(document).on("click", ".BtnEdit", function(){
    $("#EditId").val($(this).data("id"));
    $("#EditTujuanSasaranPDId").val($(this).data("tujuansasaran"));
    $("#EditKeterangan").val($(this).data("keterangan"));

    var rpjmd_ids   = ($(this).data("rpjmd") || "").toString().split("|||");
    var renstra_ids = ($(this).data("renstra") || "").toString().split("|||");

    // Template untuk edit
    var templateRPJMD = $(
      '<div class="row mb-2 item-rpjmd-edit" style="margin-bottom:10px;">' +
      '<div class="col-md-10">' +
      '<select name="edit_arah_kebijakan_rpjmd_id[]" class="form-control">' +
      '<option value="">Pilih Arah Kebijakan</option>' +
      <?php foreach($ListArahKebijakanRPJMD as $r){ ?>
      '<option value="<?= $r['id'] ?>"><?= html_escape($r['arah_kebijakan']) ?></option>' +
      <?php } ?>
      '</select>' +
      '</div>' +
      '<div class="col-md-2">' +
      '<button type="button" class="btn btn-success BtnTambahRPJMD_Edit">+</button>' +
      '<button type="button" class="btn btn-danger BtnHapusRPJMD_Edit">×</button>' +
      '</div>' +
      '</div>'
    );

    var templateRenstra = $(
      '<div class="row mb-2 item-renstra-edit" style="margin-bottom:10px;">' +
      '<div class="col-md-10">' +
      '<select name="edit_arah_kebijakan_renstra_pd_id[]" class="form-control">' +
      '<option value="">Pilih Arah Kebijakan Renstra PD</option>' +
      <?php foreach($ListArahKebijakanRenstraPD as $r){ ?>
      '<option value="<?= $r['id'] ?>"><?= html_escape($r['arah_kebijakan']) ?></option>' +
      <?php } ?>
      '</select>' +
      '</div>' +
      '<div class="col-md-2">' +
      '<button type="button" class="btn btn-success BtnTambahRenstra_Edit">+</button>' +
      '<button type="button" class="btn btn-danger BtnHapusRenstra_Edit">×</button>' +
      '</div>' +
      '</div>'
    );

    $("#EditContainerRPJMD").empty();
    $("#EditContainerRenstra").empty();

    if (rpjmd_ids.length > 0 && rpjmd_ids[0] !== "") {
      rpjmd_ids.forEach(function(val){
        var item = templateRPJMD.clone();
        item.find("select").val(val);
        $("#EditContainerRPJMD").append(item);
      });
    } else {
      $("#EditContainerRPJMD").append(templateRPJMD.clone());
    }

    if (renstra_ids.length > 0 && renstra_ids[0] !== "") {
      renstra_ids.forEach(function(val){
        var item = templateRenstra.clone();
        item.find("select").val(val);
        $("#EditContainerRenstra").append(item);
      });
    } else {
      $("#EditContainerRenstra").append(templateRenstra.clone());
    }

    $("#ModalEdit").modal("show");
  });

  // Tambah RPJMD Edit
  $(document).on("click", ".BtnTambahRPJMD_Edit", function () {
    var newItem = $(this).closest(".item-rpjmd-edit").clone();
    newItem.find("select").val("");
    $(this).closest(".item-rpjmd-edit").after(newItem);
  });

  // Hapus RPJMD Edit
  $(document).on("click", ".BtnHapusRPJMD_Edit", function () {
    if ($("#EditContainerRPJMD .item-rpjmd-edit").length == 1) {
      alert("Minimal 1 dropdown");
      return;
    }
    $(this).closest(".item-rpjmd-edit").remove();
  });

  // Tambah Renstra Edit
  $(document).on("click", ".BtnTambahRenstra_Edit", function () {
    var newItem = $(this).closest(".item-renstra-edit").clone();
    newItem.find("select").val("");
    $(this).closest(".item-renstra-edit").after(newItem);
  });

  // Hapus Renstra Edit
  $(document).on("click", ".BtnHapusRenstra_Edit", function () {
    if ($("#EditContainerRenstra .item-renstra-edit").length == 1) {
      alert("Minimal 1 dropdown");
      return;
    }
    $(this).closest(".item-renstra-edit").remove();
  });

  // UPDATE
  $("#BtnUpdate").click(function(){
    var tujuansasaran = $("#EditTujuanSasaranPDId").val();
    if (!tujuansasaran) {
      alert("Operasionalisasi NSPK wajib dipilih!");
      return;
    }

    var rpjmd = [];
    $("select[name='edit_arah_kebijakan_rpjmd_id[]']").each(function(){
      if($(this).val()) rpjmd.push($(this).val());
    });

    var renstra = [];
    $("select[name='edit_arah_kebijakan_renstra_pd_id[]']").each(function(){
      if($(this).val()) renstra.push($(this).val());
    });

    if (rpjmd.length == 0) {
      alert("Minimal pilih 1 Arah Kebijakan RPJMD!");
      return;
    }

    if (renstra.length == 0) {
      alert("Minimal pilih 1 Arah Kebijakan Renstra PD!");
      return;
    }

    $.ajax({
      url: BaseURL + "Instansi/EditNSPKOperasionalisasiPD",
      type: "POST",
      data: {
        id: $("#EditId").val(),
        tujuansasaran_pd_id: tujuansasaran,
        arah_kebijakan_rpjmd_id: rpjmd,
        arah_kebijakan_renstra_pd_id: renstra,
        keterangan: $("#EditKeterangan").val(),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res == "1") window.location.reload();
        else alert(res);
      },
      error: function(){ alert("Gagal request!"); }
    });
  });

  // HAPUS
  $(document).on("click", ".BtnHapus", function(){
    if(!confirm("Yakin hapus data ini?")) return;

    $.ajax({
      url: BaseURL + "Instansi/HapusNSPKOperasionalisasiPD",
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