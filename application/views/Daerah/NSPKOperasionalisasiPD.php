<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="data-table-list">

            <!-- ================= FILTER WILAYAH ================= -->
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
                        <div style="margin-top: 28px;">
                          <button class="btn btn-primary btn-block" id="Filter">
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
            <!-- ================= END FILTER ================= -->
            <br>

            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              <button class="btn btn-success" data-toggle="modal" data-target="#ModalInput">
                <i class="notika-icon notika-edit"></i> Tambah Data
              </button>
              <br><br>
            <?php } ?>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead >
                  <tr>
                    <th style="width:60px;">NO</th>
                    <th>OPERASIONALISASI NSPK</th>
                    <th>ARAH KEBIJAKAN RPJMD</th>
                    <th>ARAH KEBIJAKAN RENSTRA PD</th>
                    <th>KETERANGAN</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th class="text-center" style="width:120px;">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($NSPKOperasionalisasiPD)) { ?>
                    <?php $no = 1; foreach ($NSPKOperasionalisasiPD as $row) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= nl2br(htmlspecialchars($row['nspk_text'] ?? '-')) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['arah_rpjmd_text'] ?? '-')) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['arah_renstra_text'] ?? '-')) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['keterangan'] ?? '')) ?></td>

                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <td class="text-center">
                            <button class="btn btn-warning btn-sm BtnEdit"
                              data-id="<?= (int)$row['id'] ?>"
                              data-tujuansasaran="<?= (int)$row['tujuansasaranpd_master_id'] ?>"
                              data-rpjmd="<?= (int)$row['arah_kebijakan_rpjmd_id'] ?>"
                              data-renstra="<?= (int)$row['arah_kebijakan_renstra_pd_id'] ?>"
                              data-keterangan="<?= html_escape($row['keterangan'] ?? '') ?>">
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
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level']==3) ? 6 : 5 ?>" class="text-center">
                        <i>Belum ada data</i>
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

        <div class="form-group">
          <label><b>Operasionalisasi NSPK</b></label>
          <select id="TujuanSasaranPDId" class="form-control">
            <option value="">Pilih NSPK</option>
            <?php foreach($ListNSPK as $n){ ?>
              <option value="<?= (int)$n['id'] ?>"><?= html_escape($n['nspk']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan RPJMD</b></label>
          <select id="ArahRPJMDId" class="form-control">
            <option value="">Pilih Arah Kebijakan RPJMD</option>
            <?php foreach($ListArahKebijakanRPJMD as $r){ ?>
              <option value="<?= (int)$r['id'] ?>"><?= html_escape($r['arah_kebijakan']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan Renstra PD</b></label>
          <select id="ArahRenstraId" class="form-control">
            <option value="">Pilih Arah Kebijakan Renstra PD</option>
            <?php foreach($ListArahKebijakanRenstraPD as $r){ ?>
              <option value="<?= (int)$r['id'] ?>"><?= html_escape($r['arah_kebijakan']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Keterangan (Opsional)</b></label>
          <textarea id="Keterangan" class="form-control" rows="2" placeholder="Boleh dikosongkan"></textarea>
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
        <h4><b>Edit NSPK Operasionalisasi PD</b></h4>
      </div>

      <div class="modal-body">
        <input type="hidden" id="EditId">

        <div class="form-group">
          <label><b>Operasionalisasi NSPK</b></label>
          <select id="EditTujuanSasaranPDId" class="form-control">
            <?php foreach($ListNSPK as $n){ ?>
              <option value="<?= (int)$n['id'] ?>"><?= html_escape($n['nspk']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan RPJMD</b></label>
          <select id="EditArahRPJMDId" class="form-control">
            <?php foreach($ListArahKebijakanRPJMD as $r){ ?>
              <option value="<?= (int)$r['id'] ?>"><?= html_escape($r['arah_kebijakan']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Arah Kebijakan Renstra PD</b></label>
          <select id="EditArahRenstraId" class="form-control">
            <?php foreach($ListArahKebijakanRenstraPD as $r){ ?>
              <option value="<?= (int)$r['id'] ?>"><?= html_escape($r['arah_kebijakan']) ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label><b>Keterangan (Opsional)</b></label>
          <textarea id="EditKeterangan" class="form-control" rows="2"></textarea>
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

  $.post(BaseURL+"Daerah/InputNSPKOperasionalisasiPD", {
    tujuansasaran_pd_id: $("#TujuanSasaranPDId").val(),
    arah_kebijakan_rpjmd_id: $("#ArahRPJMDId").val(),
    arah_kebijakan_renstra_pd_id: $("#ArahRenstraId").val(),
    keterangan: $("#Keterangan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res || "Gagal simpan!");
  });

});

/* ================= OPEN EDIT ================= */
$(document).on("click",".BtnEdit",function(){

  $("#EditId").val($(this).data("id"));
  $("#EditTujuanSasaranPDId").val($(this).data("tujuansasaran"));
  $("#EditArahRPJMDId").val($(this).data("rpjmd"));
  $("#EditArahRenstraId").val($(this).data("renstra"));
  $("#EditKeterangan").val($(this).data("keterangan"));

  $("#ModalEdit").modal("show");
});

/* ================= UPDATE ================= */
$("#BtnUpdate").click(function(){

  $.post(BaseURL+"Daerah/EditNSPKOperasionalisasiPD", {
    id: $("#EditId").val(),
    tujuansasaran_pd_id: $("#EditTujuanSasaranPDId").val(),
    arah_kebijakan_rpjmd_id: $("#EditArahRPJMDId").val(),
    arah_kebijakan_renstra_pd_id: $("#EditArahRenstraId").val(),
    keterangan: $("#EditKeterangan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res || "Gagal update!");
  });

});

/* ================= DELETE (SOFT) ================= */
$(document).on("click",".BtnHapus",function(){
  if(!confirm("Yakin hapus data ini?")) return;

  $.post(BaseURL+"Daerah/HapusNSPKOperasionalisasiPD", {
    id: $(this).data("id"),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res || "Gagal hapus!");
  });
});
</script>

</body>
</html>
