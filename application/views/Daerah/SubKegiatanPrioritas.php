<!-- SubKegiatanPrioritas.php -->
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">

            <!-- ================= FILTER PROVINSI & KAB/KOTA ================= -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div class="form-example-wrap" style="margin-bottom: 20px;">
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row filter-row">

                      <div class="col-lg-3 col-md-6">
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

                      <div class="col-lg-3 col-md-6">
                        <label><b>Kab/Kota</b></label>
                        <select class="form-control" id="KabKota">
                          <option value="">Pilih Kab/Kota</option>
                        </select>
                      </div>

                      <div class="col-lg-2 col-md-6">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary btn-block" id="Filter">
                          <b>Filter</b>
                        </button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <?php if (!empty($NamaWilayah)) { ?>
                <div class="alert alert-info">
                  <strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah) ?>
                </div>
              <?php } ?>
            <?php } ?>
            <!-- ================= END FILTER ================= -->

            <!-- ================= BUTTON TAMBAH ================= -->
            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              <div class="basic-tb-hd">
                <button type="button"
                  class="btn btn-success notika-btn-success"
                  data-toggle="modal"
                  data-target="#ModalInputData">
                  <i class="notika-icon bi-plus-lg"></i>
                  <b>Tambah Kegiatan/Sub</b>
                </button>
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
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
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

                        <td class="text-center">
                          <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                            <button
                              class="btn btn-warning btn-sm BtnEdit"
                              data-id="<?= $row['id'] ?>"
                              data-program="<?= html_escape($row['program_prioritas']) ?>"
                              data-outcome="<?= html_escape($row['outcome']) ?>"
                              data-kegiatan="<?= html_escape($row['kegiatan']) ?>"
                              data-sub="<?= html_escape($row['sub_kegiatan']) ?>"
                              data-ket="<?= html_escape($row['keterangan']) ?>"
                            >
                              <i class="notika-icon notika-edit"></i>
                            </button>

                            <button
                              class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg BtnHapus"
                              data-id="<?= $row['id'] ?>"
                            >
                              <i class="notika-icon notika-trash"></i>
                            </button>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
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

        <!-- Program Prioritas -->
        <div class="form-group">
          <label><b>Program Prioritas</b></label>
          <input type="text" id="Program" class="form-control">
        </div>

        <!-- Outcome -->
        <div class="form-group">
          <label><b>Outcome</b></label>
          <input type="text" id="Outcome" class="form-control">
        </div>

        <!-- Kegiatan -->
        <div class="form-group">
          <label><b>Kegiatan</b></label>
          <input type="text" id="Kegiatan" class="form-control">
        </div>

        <!-- Sub Kegiatan -->
        <div class="form-group">
          <label><b>Sub Kegiatan</b></label>
          <input type="text" id="SubKegiatan" class="form-control">
        </div>

        <!-- Keterangan -->
        <div class="form-group">
          <label><b>Keterangan</b></label>
          <textarea id="Keterangan" class="form-control" rows="3"></textarea>
        </div>

        <!-- Button -->
        <div class="text-right">
          <button class="btn btn-success" id="BtnSimpan">
            <b>SIMPAN</b>
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
          <label><b>Program Prioritas</b></label>
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
        </div>

      </div>

    </div>
  </div>
</div>



<!-- ================= JS ================= -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";

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

  // SIMPAN
  $("#BtnSimpan").click(function(){
    $.post(BaseURL+"Daerah/InputSubKegiatanPrioritas", {
      program_prioritas: $("#Program").val(),
      outcome: $("#Outcome").val(),
      kegiatan: $("#Kegiatan").val(),
      sub_kegiatan: $("#SubKegiatan").val(),
      keterangan: $("#Keterangan").val(),
      [CSRF_NAME]: CSRF_TOKEN
    }, function(res){
      if(res=="1") location.reload();
      else alert(res);
    });
  });

  // BUKA MODAL EDIT
  $(document).on("click",".BtnEdit", function(){
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
    $.post(BaseURL+"Daerah/EditSubKegiatanPrioritas", {
      id: $("#EditId").val(),
      program_prioritas: $("#EditProgram").val(),
      outcome: $("#EditOutcome").val(),
      kegiatan: $("#EditKegiatan").val(),
      sub_kegiatan: $("#EditSubKegiatan").val(),
      keterangan: $("#EditKeterangan").val(),
      [CSRF_NAME]: CSRF_TOKEN
    }, function(res){
      if(res=="1") location.reload();
      else alert(res);
    });
  });

  // HAPUS
  $(document).on("click",".BtnHapus", function(){
    if(!confirm("Yakin hapus data ini?")) return;

    $.post(BaseURL+"Daerah/HapusSubKegiatanPrioritas", {
      id: $(this).data("id"),
      [CSRF_NAME]: CSRF_TOKEN
    }, function(res){
      if(res=="1") location.reload();
      else alert(res);
    });
  });

</script>
