<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">

            <!-- FILTER WILAYAH (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN -->
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

                      <!-- FILTER INSTANSI SEBELUM LOGIN -->
                      <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display: none;">
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
            <!-- END FILTER WILAYAH -->

            <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
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
                        <div class="filter-group" style="margin-top: 28px;">
                          <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                            <b>Tampilkan</b>
                          </button>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-6">
                        <div class="filter-group" style="margin-top: 28px;">
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
            <!-- END FILTER INSTANSI -->

            <!-- TOMBOL TAMBAH (HANYA UNTUK ROLE 4) -->
            <?php if ($IsRole4) { ?>
              <div class="basic-tb-hd">
                <div class="button-icon-btn sm-res-mg-t-30">
                  <button type="button"
                    class="btn btn-success notika-btn-success"
                    data-toggle="modal"
                    data-target="#ModalInputData">
                    <i class="notika-icon bi-plus-lg"></i>
                    <b>Tambah Kegiatan/Sub</b>
                  </button>
                </div>
              </div>
              <br>
            <?php } ?>


            <!-- ================= TABLE ================= -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center" style="width:70px;">No</th>
                    <th>Program Prioritas</th>
                    <th>Outcome</th>
                    <th>Kegiatan / Sub Kegiatan</th>
                    <th>Keterangan</th>
                    <?php if ($IsRole4) { ?>
                    <th class="text-center" style="width:120px;">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($Data)) { ?>
                    <?php $no = 1; foreach ($Data as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= html_escape($row['program_prioritas']) ?></td>
                        <td><?= html_escape($row['outcome']) ?></td>
                        <td style="line-height:1.6;">
                            <b>Kegiatan:</b><br>
                            <?= nl2br(html_escape($row['kegiatan'])) ?>
                            <br><br>
                            <b>Sub Kegiatan:</b><br>
                            <?= nl2br(html_escape($row['sub_kegiatan'])) ?>
                        </td>
                        <td><?= html_escape($row['keterangan']) ?></td>
                        <?php if ($IsRole4) { ?>
                          <td class="text-center">
                            <?php if ($InstansiId == ($row['id_instansi'] ?? null)) { ?>
                              <button
                                class="btn btn-warning btn-sm BtnEdit"
                                data-id="<?= $row['id'] ?>"
                                data-program="<?= html_escape($row['program_prioritas']) ?>"
                                data-outcome="<?= html_escape($row['outcome']) ?>"
                                data-kegiatan="<?= html_escape($row['kegiatan']) ?>"
                                data-sub="<?= html_escape($row['sub_kegiatan']) ?>"
                                data-ket="<?= html_escape($row['keterangan']) ?>">
                                <i class="notika-icon notika-edit"></i>
                              </button>
                              <button
                                class="btn btn-sm btn-danger BtnHapus"
                                data-id="<?= $row['id'] ?>">
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
                        Belum ada data Sub Kegiatan Prioritas
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div><!-- /.data-table-list -->
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL INPUT ================= -->
  <div class="modal fade" id="ModalInputData">
    <div class="modal-dialog modal-md" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <h4><b>Tambah Kegiatan / Sub Kegiatan</b></h4>
          <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
            <div class="alert alert-info">
              <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
            </div>
          <?php } ?>

          <div class="form-group">
            <label><b>Program Prioritas</b> <span class="text-danger">*</span></label>
            <input type="text" id="Program" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Outcome</b> <span class="text-danger">*</span></label>
            <input type="text" id="Outcome" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Kegiatan</b> <span class="text-danger">*</span></label>
            <input type="text" id="Kegiatan" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Sub Kegiatan</b> <span class="text-danger">*</span></label>
            <input type="text" id="SubKegiatan" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea id="Keterangan" class="form-control" rows="3"></textarea>
          </div>

          <div class="text-right">
            <button class="btn btn-success" id="BtnSimpan">
              <b>SIMPAN</b>
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <b>BATAL</b>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT ================= -->
  <div class="modal fade" id="ModalEditData">
    <div class="modal-dialog modal-md" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <h4><b>Edit Kegiatan / Sub Kegiatan</b></h4>
          <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="EditId">

          <div class="form-group">
            <label><b>Program Prioritas</b> <span class="text-danger">*</span></label>
            <input type="text" id="EditProgram" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Outcome</b></label>
            <input type="text" id="EditOutcome" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Kegiatan</b></label>
            <input type="text" id="EditKegiatan" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Sub Kegiatan</b></label>
            <input type="text" id="EditSubKegiatan" class="form-control">
          </div>

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea id="EditKeterangan" class="form-control" rows="3"></textarea>
          </div>

          <div class="text-right">
            <button class="btn btn-success" id="BtnUpdate">
              <b>SIMPAN</b>
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <b>BATAL</b>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

jQuery(document).ready(function($){

  // Inisialisasi DataTable
  if ($('#data-table-subkegiatan').length > 0) {
    try {
      if ($.fn.DataTable.isDataTable('#data-table-subkegiatan')) {
        $('#data-table-subkegiatan').DataTable().destroy();
      }
      $('#data-table-subkegiatan').DataTable({
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
        },
        "drawCallback": function(settings) {
          var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
          pagination.find('a').css('margin', '0 5px');
        }
      });
    } catch(e) {
      console.log("DataTable error:", e);
    }
  }

  setTimeout(function() {
    $('.dataTables_paginate a').css('margin', '0 5px');
    $('.dataTables_paginate span a').css('margin', '0 5px');
    $('.dataTables_paginate').css('margin-top', '10px');
    $('.dataTables_info').css('margin', '10px 0');
  }, 100);

  /* ================= FILTER WILAYAH SEBELUM LOGIN ================= */
  <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

  $("#Provinsi").change(function() {
    if ($(this).val() === "") {
      $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
      $("#FilterInstansiGroupBefore").hide();
      return;
    }

    $.ajax({
      url: BaseURL + "Instansi/GetListKabKota",
      type: "POST",
      data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
      dataType: 'json',
      beforeSend: function() { 
        $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
        $("#FilterInstansiGroupBefore").hide();
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
      $("#FilterInstansiGroupBefore").hide();
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
        $("#FilterInstansiGroupBefore").show();
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
        $("#FilterInstansiGroupBefore").show();
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
          var redirectUrl = BaseURL + "Instansi/SubKegiatanPrioritas";
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

  /* ================= FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) ================= */
  <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    $("#FilterInstansiBtn").click(function() {
      var instansiId = $("#FilterInstansi").val();
      var url = BaseURL + "Instansi/SubKegiatanPrioritas";
      if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
      window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/SubKegiatanPrioritas"; });
  <?php } ?>

  /* ================= CRUD OPERATIONS (HANYA UNTUK ROLE 4) ================= */
  <?php if ($IsRole4) { ?>

  // SIMPAN
  $("#BtnSimpan").click(function(){
    var program = $("#Program").val().trim();
    var outcome = $("#Outcome").val().trim();
    var kegiatan = $("#Kegiatan").val().trim();
    var sub = $("#SubKegiatan").val().trim();

    if(!program){ alert("Program Prioritas harus diisi!"); return; }
    if(!outcome){ alert("Outcome harus diisi!"); return; }
    if(!kegiatan){ alert("Kegiatan harus diisi!"); return; }
    if(!sub){ alert("Sub Kegiatan harus diisi!"); return; }

    $.ajax({
      url: BaseURL + "Instansi/InputSubKegiatanPrioritas",
      type: "POST",
      data: {
        program_prioritas: program,
        outcome: outcome,
        kegiatan: kegiatan,
        sub_kegiatan: sub,
        keterangan: $("#Keterangan").val(),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") window.location.reload();
        else alert(res);
      },
      error: function() { alert("Gagal request!"); }
    });
  });

  // BUKA MODAL EDIT
  $(document).on("click", ".BtnEdit", function(){
    $("#EditId").val($(this).data("id"));
    $("#EditProgram").val($(this).data("program"));
    $("#EditOutcome").val($(this).data("outcome"));
    $("#EditKegiatan").val($(this).data("kegiatan"));
    $("#EditSubKegiatan").val($(this).data("sub"));
    $("#EditKeterangan").val($(this).data("ket"));
    $("#ModalEditData").modal("show");
  });

  // UPDATE
  $("#BtnUpdate").click(function(){
    var program = $("#EditProgram").val().trim();
    
    if(!program){ alert("Program Prioritas harus diisi!"); return; }

    $.ajax({
      url: BaseURL + "Instansi/EditSubKegiatanPrioritas",
      type: "POST",
      data: {
        id: $("#EditId").val(),
        program_prioritas: program,
        outcome: $("#EditOutcome").val(),
        kegiatan: $("#EditKegiatan").val(),
        sub_kegiatan: $("#EditSubKegiatan").val(),
        keterangan: $("#EditKeterangan").val(),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") window.location.reload();
        else alert(res);
      },
      error: function() { alert("Gagal request!"); }
    });
  });

  // HAPUS
  $(document).on("click", ".BtnHapus", function(){
    if(!confirm("Yakin hapus data ini?")) return;

    $.ajax({
      url: BaseURL + "Instansi/HapusSubKegiatanPrioritas",
      type: "POST",
      data: {
        id: $(this).data("id"),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") window.location.reload();
        else alert(res);
      },
      error: function() { alert("Gagal request!"); }
    });
  });

  <?php } ?>
});
</script>
</body>
</html>