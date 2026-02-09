<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">
        <!-- FILTER PROVINSI & KAB/KOTA (MUNCUL SAAT BELUM SET KodeWilayah) -->
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

      <!-- ================= BUTTON TAMBAH MASTER ================= -->
      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
        <button type="button"
          class="btn btn-success"
          data-toggle="modal"
          data-target="#ModalTambahMaster">
          <i class="notika-icon bi-plus-lg"></i>
          <b>Tambah Rumusan Renstra (Header)</b>
        </button>
        <br><br>
      <?php } ?>

      <!-- ================= TABLE ================= -->
      <div class="table-responsive">
        <table id="data-table-basic" class="table table-striped">

          <thead>
            <tr>
              <th>No</th>
              <th>NSPK + Sasaran RPJMD</th>
              <th>Tujuan</th>
              <th>Sasaran</th>
              <th>Outcome</th>
              <th>Output</th>
              <th>Indikator</th>
              <th>Program/Kegiatan <br>/Sub Kegiatan</th>
              <th>Keterangan</th>

              <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                <th class="text-center">Aksi <br> Header</th>
                <th class="text-center">Aksi Detail</th>
              <?php } ?>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($RumusanRenstra)) { ?>
              <?php $no = 1; foreach ($RumusanRenstra as $m) { ?>

                <?php
                  $details = $m['details'] ?? [];
                  $rowspan = max(1, count($details));
                ?>

                <?php if (!empty($details)) { ?>
                  <?php $d0 = $details[0]; ?>

                  <!-- MASTER + DETAIL PERTAMA -->
                  <tr>
                    <td rowspan="<?= $rowspan ?>" class="text-center"><?= $no++ ?></td>

                    <td rowspan="<?= $rowspan ?>">
                        <strong>NSPK:</strong><br>
                        <?= html_escape($m['nspk_text']) ?>

                        <br><br>

                        <strong>Sasaran RPJMD yang Relevan:</strong><br>
                        <?= html_escape($m['sasaran_relevan_text']) ?>
                        </td>


                    <td rowspan="<?= $rowspan ?>"><?= html_escape($m['tujuan_text']) ?></td>
                    <td rowspan="<?= $rowspan ?>"><?= html_escape($m['sasaran_text']) ?></td>

                    <td><?= html_escape($d0['outcome']) ?></td>
                    <td><?= html_escape($d0['output']) ?></td>
                    <td><?= html_escape($d0['indikator']) ?></td>
                    <td><?= html_escape($d0['program']) ?></td>
                    <td><?= html_escape($d0['keterangan']) ?></td>

                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <!-- AKSI HEADER -->
                      <td rowspan="<?= $rowspan ?>" class="text-center" >
                        
                        <button class="btn btn-info btn-sm BtnEditMaster"
                          data-id="<?= $m['id'] ?>"
                          data-master="<?= $m['tujuansasaranpd_master_id'] ?>"
                          data-tujuan="<?= $m['tujuan_id'] ?>"
                          data-sasaran="<?= $m['sasaran_id'] ?>">
                          <i class="notika-icon notika-edit"></i>
                        </button>

                        <button class="btn btn-danger btn-sm BtnHapusMaster"
                          data-id="<?= $m['id'] ?>">
                          <i class="notika-icon notika-trash"></i>
                        </button>
                       
                      </td>

                      <!-- AKSI DETAIL -->
                      <td class="text-center">
                        
                        <button class="btn btn-success btn-sm BtnAddDetail"
                          data-master-id="<?= $m['id'] ?>"> <i class="notika-icon bi-plus-lg"></i></button>

                        <button class="btn btn-warning btn-sm BtnEditDetail"
                          data-id="<?= $d0['id'] ?>"
                          data-outcome="<?= html_escape($d0['outcome']) ?>"
                          data-output="<?= html_escape($d0['output']) ?>"
                          data-indikator="<?= html_escape($d0['indikator']) ?>"
                          data-program="<?= html_escape($d0['program']) ?>"
                          data-keterangan="<?= html_escape($d0['keterangan']) ?>"><i class="notika-icon notika-edit"></i></button>

                        <button class="btn btn-danger btn-sm BtnHapusDetail"
                          data-id="<?= $d0['id'] ?>"><i class="notika-icon notika-trash"></i></button>
                        
                      </td>
                    <?php } ?>
                  </tr>

                  <!-- DETAIL LANJUTAN -->
                  <?php for ($i=1; $i<count($details); $i++) {
                    $d = $details[$i];
                  ?>
                    <tr>
                      <td><?= html_escape($d['outcome']) ?></td>
                      <td><?= html_escape($d['output']) ?></td>
                      <td><?= html_escape($d['indikator']) ?></td>
                      <td><?= html_escape($d['program']) ?></td>
                      <td><?= html_escape($d['keterangan']) ?></td>

                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <td class="text-center">
                          <button class="btn btn-warning btn-sm BtnEditDetail"
                            data-id="<?= $d['id'] ?>"
                            data-outcome="<?= html_escape($d['outcome']) ?>"
                            data-output="<?= html_escape($d['output']) ?>"
                            data-indikator="<?= html_escape($d['indikator']) ?>"
                            data-program="<?= html_escape($d['program']) ?>"
                            data-keterangan="<?= html_escape($d['keterangan']) ?>"><i class="notika-icon notika-edit"></i></button>

                          <button class="btn btn-danger btn-sm BtnHapusDetail"
                            data-id="<?= $d['id'] ?>"><i class="notika-icon notika-trash"></i></button>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php } ?>

                    <!-- ================== ELSE DISINI ================== -->
                    <?php } else { ?>

                    <tr>
                    <td class="text-center"><?= $no++ ?></td>

                    <td rowspan="<?= $rowspan ?>">
                        <strong>NSPK:</strong><br>
                        <?= html_escape($m['nspk_text']) ?>

                        <br><br>

                        <strong>Sasaran RPJMD yang Relevan:</strong><br>
                        <?= html_escape($m['sasaran_relevan_text']) ?>
                        </td>


                    <td><?= html_escape($m['tujuan_text']) ?></td>
                    <td><?= html_escape($m['sasaran_text']) ?></td>

                    <td colspan="5" class="text-center">
                        <i>Belum ada detail</i>
                    </td>

                    <?php if ($_SESSION['Level']==3){ ?>

                        <!-- AKSI HEADER -->
                        <td class="text-center">

                        <button class="btn btn-info btn-sm BtnEditMaster"
                            data-id="<?= $m['id'] ?>"
                            data-master="<?= $m['tujuansasaranpd_master_id'] ?>"
                            data-tujuan="<?= $m['tujuan_id'] ?>"
                            data-sasaran="<?= $m['sasaran_id'] ?>">
                            <i class="notika-icon notika-edit"></i>
                        </button>

                        <button class="btn btn-danger btn-sm BtnHapusMaster"
                            data-id="<?= $m['id'] ?>">
                            <i class="notika-icon notika-trash"></i>
                        </button>

                        </td>

                        <!-- AKSI DETAIL -->
                        <td class="text-center">
                        <button class="btn btn-success btn-sm BtnAddDetail"
                            data-master-id="<?= $m['id'] ?>">
                            <i class="notika-icon bi-plus-lg"></i>
                        </button>
                        </td>

                    <?php } ?>

                    </tr>

                    <?php } ?>

                    <!-- ================== END IF DETAILS ================== -->

              <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<!-- ===================================================== -->
<!-- ================= MODAL TAMBAH MASTER ================= -->
<div class="modal fade" id="ModalTambahMaster" role="dialog">>
   <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Tambah Header Rumusan Renstra</b></h4>
      </div>

      <div class="modal-body">
        <label>NSPK</label>
        <select id="MasterId" class="form-control">
          <?php foreach($ListMasterNSPK as $m){ ?>
            <option value="<?= $m['id'] ?>"><?= $m['nspk'] ?></option>
          <?php } ?>
        </select>

        <br>

        <label>Tujuan</label>
        <select id="TujuanId" class="form-control">
          <?php foreach($ListTujuan as $t){ ?>
            <option value="<?= $t['id'] ?>"><?= $t['tujuan_pd'] ?></option>
          <?php } ?>
        </select>

        <br>

        <label>Sasaran</label>
        <select id="SasaranId" class="form-control">
          <?php foreach($ListSasaran as $s){ ?>
            <option value="<?= $s['id'] ?>"><?= $s['sasaran_pd'] ?></option>
          <?php } ?>
        </select>

        <br>

        <button class="btn btn-success" id="BtnSimpanMaster">SIMPAN</button>
      </div>

    </div>
  </div>
</div>

<!-- ================= MODAL TAMBAH DETAIL ================= -->
<div class="modal fade" id="ModalTambahDetail"role="dialog">>
   <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Tambah Detail</b></h4>
      </div>

      <div class="modal-body">

        <input type="hidden" id="DetailMasterId">

        <textarea id="Outcome" class="form-control" placeholder="Outcome"></textarea><br>
        <textarea id="Output" class="form-control" placeholder="Output"></textarea><br>
        <textarea id="Indikator" class="form-control" placeholder="Indikator"></textarea><br>
        <textarea id="Program" class="form-control" placeholder="Program"></textarea><br>
        <textarea id="Keterangan" class="form-control" placeholder="Keterangan"></textarea><br>

        <button class="btn btn-success" id="BtnSimpanDetail">SIMPAN DETAIL</button>
      </div>

    </div>
  </div>
</div>

<!-- ================= MODAL EDIT MASTER ================= -->
<div class="modal fade" id="ModalEditMaster"role="dialog">
   <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Edit Header</b></h4>
      </div>

      <div class="modal-body">

        <input type="hidden" id="EditMasterRowId">

        <select id="EditMasterId" class="form-control">
          <?php foreach($ListMasterNSPK as $m){ ?>
            <option value="<?= $m['id'] ?>"><?= $m['nspk'] ?></option>
          <?php } ?>
        </select><br>

        <select id="EditTujuanId" class="form-control">
          <?php foreach($ListTujuan as $t){ ?>
            <option value="<?= $t['id'] ?>"><?= $t['tujuan_pd'] ?></option>
          <?php } ?>
        </select><br>

        <select id="EditSasaranId" class="form-control">
          <?php foreach($ListSasaran as $s){ ?>
            <option value="<?= $s['id'] ?>"><?= $s['sasaran_pd'] ?></option>
          <?php } ?>
        </select><br>

        <button class="btn btn-primary" id="BtnUpdateMaster">UPDATE</button>

      </div>
    </div>
  </div>
</div>

<!-- ================= MODAL EDIT DETAIL ================= -->
<div class="modal fade" id="ModalEditDetail"role="dialog">
   <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">

      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Edit Detail</b></h4>
      </div>

      <div class="modal-body">

        <input type="hidden" id="EditDetailId">

        <textarea id="EditOutcome" class="form-control"></textarea><br>
        <textarea id="EditOutput" class="form-control"></textarea><br>
        <textarea id="EditIndikator" class="form-control"></textarea><br>
        <textarea id="EditProgram" class="form-control"></textarea><br>
        <textarea id="EditKeterangan" class="form-control"></textarea><br>

        <button class="btn btn-primary" id="BtnUpdateDetail">UPDATE DETAIL</button>

      </div>
    </div>
  </div>
</div>


<style>
    td.text-center .btn {
    margin: 1px;
}

td.text-center {
    white-space: nowrap;
    vertical-align: middle;
}

</style>

<!-- ================= SCRIPT CRUD ================= -->
 <script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script>

var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";

jQuery(document).ready(function($){


    // =========================
    // FILTER PROVINSI & KAB/KOTA
    // =========================
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
    // =========================
    // END FILTER
    // =========================

/* ================= TAMBAH MASTER ================= */
$("#BtnSimpanMaster").click(function(){
  $.post(BaseURL+"Daerah/InputRumusanRenstraPD_Master", {
    tujuansasaranpd_master_id: $("#MasterId").val(),
    tujuan_id: $("#TujuanId").val(),
    sasaran_id: $("#SasaranId").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res);
  });
});

/* ================= TAMBAH DETAIL ================= */
$(document).on("click",".BtnAddDetail",function(){
  $("#DetailMasterId").val($(this).data("master-id"));
  $("#ModalTambahDetail").modal("show");
});

$("#BtnSimpanDetail").click(function(){
  $.post(BaseURL+"Daerah/InputRumusanRenstraPD_Detail", {
    rumusanrenstra_pd_id: $("#DetailMasterId").val(),
    outcome: $("#Outcome").val(),
    output: $("#Output").val(),
    indikator: $("#Indikator").val(),
    program: $("#Program").val(),
    keterangan: $("#Keterangan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert(res);
  });
});

/* ================= EDIT MASTER ================= */
$(document).on("click",".BtnEditMaster",function(){
  $("#EditMasterRowId").val($(this).data("id"));
  $("#EditMasterId").val($(this).data("master"));
  $("#EditTujuanId").val($(this).data("tujuan"));
  $("#EditSasaranId").val($(this).data("sasaran"));
  $("#ModalEditMaster").modal("show");
});

$("#BtnUpdateMaster").click(function(){
  $.post(BaseURL+"Daerah/EditRumusanRenstraPD_Master", {
    id: $("#EditMasterRowId").val(),
    tujuansasaranpd_master_id: $("#EditMasterId").val(),
    tujuan_id: $("#EditTujuanId").val(),
    sasaran_id: $("#EditSasaranId").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert("Gagal update master!");
  });
});

/* ================= EDIT DETAIL ================= */
$(document).on("click",".BtnEditDetail",function(){
  $("#EditDetailId").val($(this).data("id"));
  $("#EditOutcome").val($(this).data("outcome"));
  $("#EditOutput").val($(this).data("output"));
  $("#EditIndikator").val($(this).data("indikator"));
  $("#EditProgram").val($(this).data("program"));
  $("#EditKeterangan").val($(this).data("keterangan"));
  $("#ModalEditDetail").modal("show");
});

$("#BtnUpdateDetail").click(function(){
  $.post(BaseURL+"Daerah/EditRumusanRenstraPD_Detail", {
    id: $("#EditDetailId").val(),
    outcome: $("#EditOutcome").val(),
    output: $("#EditOutput").val(),
    indikator: $("#EditIndikator").val(),
    program: $("#EditProgram").val(),
    keterangan: $("#EditKeterangan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
    else alert("Gagal update detail!");
  });
});

/* ================= HAPUS MASTER ================= */
$(document).on("click",".BtnHapusMaster",function(){
  if(!confirm("Hapus header + semua detail?")) return;
  $.post(BaseURL+"Daerah/HapusRumusanRenstraPD_Master", {
    id: $(this).data("id"),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
  });
});

/* ================= HAPUS DETAIL ================= */
$(document).on("click",".BtnHapusDetail",function(){
  if(!confirm("Hapus detail ini?")) return;
  $.post(BaseURL+"Daerah/HapusRumusanRenstraPD_Detail", {
    id: $(this).data("id"),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res=="1") location.reload();
  });
});
});
</script>