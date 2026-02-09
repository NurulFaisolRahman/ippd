<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="data-table-list">

             <!-- FILTER PROVINSI & KAB/KOTA (MUNCUL SAAT SEBELUM LOGIN / BELUM SET KodeWilayah) -->
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
            <br>

            <?php if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) { ?>
              <button class="btn btn-success" data-toggle="modal" data-target="#ModalInput">
                <i class="notika-icon bi-plus-lg"></i> Tambah Data
              </button>
              <br><br>
            <?php } ?>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th style="width:60px;">NO</th>
                    <th>SASARAN RPJMD</th>
                    <th>STRATEGI</th>
                    <th>ARAH KEBIJAKAN</th>
                    <?php if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) { ?>
                      <th class="text-center" style="width:120px;">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($ArahKebijakanRPJMD)) { ?>
                    <?php $no = 1; foreach ($ArahKebijakanRPJMD as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['Sasaran'] ?? '-') ?></td>
                        <td><?= nl2br(htmlspecialchars($row['strategi'])) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['arah_kebijakan'])) ?></td>

                        <?php if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) { ?>
                          <td class="text-center">
                            <button class="btn btn-warning btn-sm BtnEdit"
                              data-id="<?= (int)$row['id'] ?>"
                              data-sasaran_id="<?= (int)$row['sasaran_rpjmd_id'] ?>"
                              data-strategi="<?= html_escape($row['strategi']) ?>"
                              data-arah="<?= html_escape($row['arah_kebijakan']) ?>">
                              <i class="notika-icon notika-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm BtnHapus"
                              data-id="<?= (int)$row['id'] ?>">
                              <i class="notika-icon notika-trash"></i>
                            </button>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) ? 5 : 4 ?>" class="text-center">
                        <i>Belum ada data Arah Kebijakan RPJMD</i>
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
        <h4><b>Tambah Arah Kebijakan RPJMD</b></h4>
      </div>

      <div class="modal-body">

        <div class="form-group">
          <label><b>Sasaran RPJMD</b></label>
          <select id="SasaranRPJMDId" class="form-control">
            <option value="">Pilih Sasaran RPJMD</option>
            <?php if (!empty($ListSasaranRPJMD)) { foreach($ListSasaranRPJMD as $s) { ?>
              <option value="<?= (int)$s['Id'] ?>"><?= html_escape($s['Sasaran']) ?></option>
            <?php }} ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Strategi</b></label>
          <textarea id="Strategi" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan</b></label>
          <textarea id="ArahKebijakan" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-success" id="BtnSimpan"><b>SIMPAN</b></button>

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
        <h4><b>Edit Arah Kebijakan RPJMD</b></h4>
      </div>

      <div class="modal-body">
        <input type="hidden" id="EditId">

        <div class="form-group">
          <label><b>Sasaran RPJMD</b></label>
          <select id="EditSasaranRPJMDId" class="form-control">
            <?php if (!empty($ListSasaranRPJMD)) { foreach($ListSasaranRPJMD as $s) { ?>
              <option value="<?= (int)$s['Id'] ?>"><?= html_escape($s['Sasaran']) ?></option>
            <?php }} ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Strategi</b></label>
          <textarea id="EditStrategi" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan</b></label>
          <textarea id="EditArahKebijakan" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-success" id="BtnUpdate"><b>SIMPAN</b></button>

      </div>
    </div>
  </div>
</div>

<!-- ================= SCRIPT ================= -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";

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

/* ================= SIMPAN ================= */
$("#BtnSimpan").click(function(){

  if($("#SasaranRPJMDId").val() === "") return alert("Sasaran RPJMD wajib dipilih!");
  if($("#Strategi").val().trim() === "") return alert("Strategi wajib diisi!");
  if($("#ArahKebijakan").val().trim() === "") return alert("Arah Kebijakan wajib diisi!");

  $.post(BaseURL+"Daerah/InputArahKebijakanRPJMD", {
    sasaran_rpjmd_id: $("#SasaranRPJMDId").val(),
    strategi: $("#Strategi").val(),
    arah_kebijakan: $("#ArahKebijakan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res || "Gagal simpan!");
  });
});

/* ================= OPEN EDIT ================= */
$(document).on("click",".BtnEdit",function(){

  $("#EditId").val($(this).data("id"));
  $("#EditSasaranRPJMDId").val(String($(this).data("sasaran_id")));
  $("#EditStrategi").val($(this).data("strategi"));
  $("#EditArahKebijakan").val($(this).data("arah"));

  $("#ModalEdit").modal("show");
});

/* ================= UPDATE ================= */
$("#BtnUpdate").click(function(){

  if($("#EditId").val() === "") return alert("ID tidak valid!");
  if($("#EditSasaranRPJMDId").val() === "") return alert("Sasaran RPJMD wajib dipilih!");
  if($("#EditStrategi").val().trim() === "") return alert("Strategi wajib diisi!");
  if($("#EditArahKebijakan").val().trim() === "") return alert("Arah Kebijakan wajib diisi!");

  $.post(BaseURL+"Daerah/EditArahKebijakanRPJMD", {
    id: $("#EditId").val(),
    sasaran_rpjmd_id: $("#EditSasaranRPJMDId").val(),
    strategi: $("#EditStrategi").val(),
    arah_kebijakan: $("#EditArahKebijakan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res || "Gagal update!");
  });
});

/* ================= SOFT DELETE ================= */
$(document).on("click",".BtnHapus",function(){

  if(!confirm("Yakin hapus data ini?")) return;

  $.post(BaseURL+"Daerah/HapusArahKebijakanRPJMD", {
    id: $(this).data("id"),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res || "Gagal hapus!");
  });
});

/* BONUS: anti backdrop nyangkut (biar sidebar ga kekunci) */
$(".modal").on("hidden.bs.modal", function () {
  $(".modal-backdrop").remove();
  $("body").removeClass("modal-open");
});
</script>

</body>
</html>
