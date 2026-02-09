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

<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
<button class="btn btn-success" data-toggle="modal" data-target="#ModalTambah">
    <i class="notika-icon bi-plus-lg"></i>
  Tambah Data
</button>
<br><br>
<?php } ?>

<!-- ================= TABLE ================= -->
<div class="table-responsive">
<table id="data-table-basic" class="table table-striped">

<thead>
<tr>
  <th rowspan="3">BIDANG URUSAN PROGRAM/OUTCOME <br>KEGIATAN SUB KEGIATAN</th>
  <th rowspan="3">INDIKATOR OUTCOME/OUTPUT</th>
  <th rowspan="3">BASELINE 2024</th>
  <th class="text-center" colspan="10">TARGET DAN PAGU INDIKATIF TAHUN</th>
  <th rowspan="3">KET.</th>
  <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
    <th class="text-center" rowspan="3">AKSI</th>
  <?php } ?>
</tr>

<tr>
  <th class="text-center" colspan="2">2026</th>
  <th class="text-center" colspan="2">2027</th>
  <th class="text-center" colspan="2">2028</th>
  <th class="text-center" colspan="2">2029</th>
  <th class="text-center" colspan="2">2030</th>
</tr>

<tr>
  <th class="text-center">TARGET</th><th class="text-center">PAGU</th>
  <th class="text-center">TARGET</th><th class="text-center">PAGU</th>
  <th class="text-center">TARGET</th><th class="text-center">PAGU</th>
  <th class="text-center">TARGET</th><th class="text-center">PAGU</th>
  <th class="text-center">TARGET</th><th class="text-center">PAGU</th>
</tr>
</thead>

<tbody>
<?php foreach($list as $r){ ?>
<tr>
  <td><?= html_escape($r['bidang_urusan']) ?></td>
  <td><?= html_escape($r['indikator']) ?></td>
  <td><?= html_escape($r['baseline']) ?></td>

  <td class="text-center"><?= $r['target_2026'] ?></td>
  <td class="text-center"><?= $r['pagu_2026'] ?></td>

  <td class="text-center"><?= $r['target_2027'] ?></td>
  <td class="text-center"><?= $r['pagu_2027'] ?></td>

  <td class="text-center"><?= $r['target_2028'] ?></td>
  <td class="text-center"><?= $r['pagu_2028'] ?></td>

  <td class="text-center"><?= $r['target_2029'] ?></td>
  <td class="text-center"><?= $r['pagu_2029'] ?></td>

  <td class="text-center"><?= $r['target_2030'] ?></td>
  <td class="text-center"><?= $r['pagu_2030'] ?></td>

  <td><?= html_escape($r['keterangan']) ?></td>

<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
<td class="text-center">

<button class="btn btn-warning BtnEdit"
  data-id="<?= $r['id'] ?>"
  data-bidang="<?= html_escape($r['bidang_urusan']) ?>"
  data-indikator="<?= html_escape($r['indikator']) ?>"
  data-baseline="<?= html_escape($r['baseline']) ?>"
  data-t2026="<?= $r['target_2026'] ?>"
  data-p2026="<?= $r['pagu_2026'] ?>"
  data-t2027="<?= $r['target_2027'] ?>"
  data-p2027="<?= $r['pagu_2027'] ?>"
  data-t2028="<?= $r['target_2028'] ?>"
  data-p2028="<?= $r['pagu_2028'] ?>"
  data-t2029="<?= $r['target_2029'] ?>"
  data-p2029="<?= $r['pagu_2029'] ?>"
  data-t2030="<?= $r['target_2030'] ?>"
  data-p2030="<?= $r['pagu_2030'] ?>"
  data-ket="<?= html_escape($r['keterangan']) ?>">
<i class="notika-icon notika-edit"></i>
</button>

<button class="btn btn-danger BtnHapus"
  data-id="<?= $r['id'] ?>">
<i class="notika-icon notika-trash"></i>
</button>

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

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="ModalTambah" role="dialog">
  <div class="modal-dialog modal-lg" style="top:5%;">
    <div class="modal-content">

      <div class="modal-header">
        <h4>Tambah Data
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </h4>
      </div>

      <div class="modal-body">

        <!-- BIDANG URUSAN -->
        <div class="label-mini">
          BIDANG URUSAN PROGRAM/OUTCOME KEGIATAN SUB KEGIATAN <span style="color:red">*</span>
        </div>
        <textarea id="BidangUrusan" class="form-control"></textarea>
        <br>

        <!-- INDIKATOR -->
        <div class="label-mini">
          INDIKATOR OUTCOME/OUTPUT</span>
        </div>
        <textarea id="Indikator" class="form-control"></textarea>
        <br>

        <!-- BASELINE -->
        <div class="label-mini">BASELINE 2024</div>
        <input type="text" id="Baseline" class="form-control">
        <br>

        <!-- TARGET & PAGU GRID -->
            <div class="label-mini">TARGET & PAGU INDIKATIF</div>

            <div class="tahun-grid">

            <?php 
            $years = [2026,2027,2028,2029,2030];
            for($i=0;$i<count($years);$i+=2){
            ?>
            <div class="tahun-row">

            <?php for($j=$i;$j<$i+2 && $j<count($years);$j++){ 
                $t = $years[$j]; 
            ?>
                <div class="tahun-box">
                <div class="label-mini">TAHUN <?= $t ?></div>

                <!-- HEADER TARGET PAGU -->
                <div class="tp-header">
                    <div class="tp-col">TARGET</div>
                    <div class="tp-col">PAGU</div>
                </div>

                <!-- INPUT TARGET PAGU -->
                <div class="tp-input">
                    <input type="text" id="Target<?= $t ?>" class="form-control input-target">
                    <input type="text" id="Pagu<?= $t ?>" class="form-control input-pagu">
                </div>

                </div>
            <?php } ?>

            </div>
            <?php } ?>

            </div>


        <br>

        <!-- KETERANGAN -->
        <div class="label-mini">KETERANGAN</div>
        <textarea id="Keterangan" class="form-control"></textarea>
        <br>

        <button class="btn btn-success" id="BtnSimpan">Simpan</button>

      </div>
    </div>
  </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="ModalEdit" role="dialog">
  <div class="modal-dialog modal-lg" style="top:5%;">
    <div class="modal-content">

      <div class="modal-header">
        <h4>Edit Data
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </h4>
      </div>

      <div class="modal-body">

        <input type="hidden" id="EditId">

        <!-- BIDANG URUSAN -->
        <div class="label-mini">
          BIDANG URUSAN PROGRAM/OUTCOME KEGIATAN SUB KEGIATAN <span style="color:red">*</span>
        </div>
        <textarea id="EditBidangUrusan" class="form-control"></textarea>
        <br>

        <!-- INDIKATOR -->
        <div class="label-mini">
          INDIKATOR OUTCOME/OUTPUT </span>
        </div>
        <textarea id="EditIndikator" class="form-control"></textarea>
        <br>

        <!-- BASELINE -->
        <div class="label-mini">BASELINE 2024</div>
        <input type="text" id="EditBaseline" class="form-control">
        <br>

        <!-- TARGET & PAGU GRID -->
        <div class="label-mini">TARGET & PAGU INDIKATIF</div>

        <div class="tahun-grid">

        <?php 
        $years = [2026,2027,2028,2029,2030];
        for($i=0;$i<count($years);$i+=2){
        ?>
        <div class="tahun-row">

        <?php for($j=$i;$j<$i+2 && $j<count($years);$j++){ 
            $t = $years[$j]; 
        ?>
            <div class="tahun-box">
            <div class="label-mini">TAHUN <?= $t ?></div>

            <!-- HEADER TARGET PAGU -->
            <div class="tp-header">
                <div class="tp-col">TARGET</div>
                <div class="tp-col">PAGU</div>
            </div>

            <!-- INPUT TARGET PAGU -->
            <div class="tp-input">
                <input type="text" id="EditTarget<?= $t ?>" class="form-control input-target">
                <input type="text" id="EditPagu<?= $t ?>" class="form-control input-pagu">
            </div>

            </div>
        <?php } ?>

        </div>
        <?php } ?>

        </div>

        <br>

        <!-- KETERANGAN -->
        <div class="label-mini">KETERANGAN</div>
        <textarea id="EditKeterangan" class="form-control"></textarea>
        <br>

        <button class="btn btn-primary" id="BtnUpdate">Update</button>

      </div>
    </div>
  </div>
</div>

<!-- ================= CSS COMPACT ================= -->
<style>

    /* header kolom TARGET & PAGU */
.tp-header {
  display: flex;
  gap: 5px;
  font-size: 10px;
  font-weight: bold;
  margin-bottom: 2px;
}

.tp-col {
  width: 50%;
  text-align: left;
}

/* input kolom */
.tp-input {
  display: flex;
  gap: 5px;
}

/* textarea pendek */
.modal-body textarea {
  height: 50px;
}

/* grid tahun */
.tahun-row {
  display: flex;
  gap: 12px;
  margin-bottom: 8px;
}

.tahun-box {
  flex: 0 0 48%; /* FIX ukuran sama */
}


/* target & pagu sejajar kecil */
.input-target-pagu {
  display: flex;
  gap: 5px;
}

.input-target,
.input-pagu {
  height: 28px;
  font-size: 11px;
  padding: 3px 5px;
}

.input-target { width: 50%; }
.input-pagu   { width: 50%; }

/* label kecil */
.label-mini {
  font-size: 10px;
  font-weight: bold;
  margin-bottom: 2px;
}
td.text-center .btn {
  padding: 4px 6px;
  font-size: 12px;
  margin: 1px;
}

td.text-center {
  white-space: nowrap;
  vertical-align: middle;
}
</style>


<!-- ================= SCRIPT ================= -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
        var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

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
/* SIMPAN */
$("#BtnSimpan").click(function(){

if($("#BidangUrusan").val()==""){
  alert("Bidang Urusan wajib diisi!");
  return;
}

$.post(BaseURL+"Daerah/InputRencanaProgramPendanaan",{
  bidang_urusan:$("#BidangUrusan").val(),
  indikator:$("#Indikator").val(),
  baseline:$("#Baseline").val(),

  target_2026:$("#Target2026").val(),
  pagu_2026:$("#Pagu2026").val(),
  target_2027:$("#Target2027").val(),
  pagu_2027:$("#Pagu2027").val(),
  target_2028:$("#Target2028").val(),
  pagu_2028:$("#Pagu2028").val(),
  target_2029:$("#Target2029").val(),
  pagu_2029:$("#Pagu2029").val(),
  target_2030:$("#Target2030").val(),
  pagu_2030:$("#Pagu2030").val(),

  keterangan:$("#Keterangan").val()

},function(res){
  if(res=="1") location.reload();
  else alert(res);
});

});

/* EDIT OPEN */
$(".BtnEdit").click(function(){

$("#EditId").val($(this).data("id"));
$("#EditBidangUrusan").val($(this).data("bidang"));
$("#EditIndikator").val($(this).data("indikator"));
$("#EditBaseline").val($(this).data("baseline"));

$("#EditTarget2026").val($(this).data("t2026"));
$("#EditPagu2026").val($(this).data("p2026"));
$("#EditTarget2027").val($(this).data("t2027"));
$("#EditPagu2027").val($(this).data("p2027"));
$("#EditTarget2028").val($(this).data("t2028"));
$("#EditPagu2028").val($(this).data("p2028"));
$("#EditTarget2029").val($(this).data("t2029"));
$("#EditPagu2029").val($(this).data("p2029"));
$("#EditTarget2030").val($(this).data("t2030"));
$("#EditPagu2030").val($(this).data("p2030"));
$("#EditKeterangan").val($(this).data("ket"));

$("#ModalEdit").modal("show");

});

/* UPDATE */
$("#BtnUpdate").click(function(){

$.post(BaseURL+"Daerah/EditRencanaProgramPendanaan",{
  id:$("#EditId").val(),
  bidang_urusan:$("#EditBidangUrusan").val(),
  indikator:$("#EditIndikator").val(),
  baseline:$("#EditBaseline").val(),

  target_2026:$("#EditTarget2026").val(),
  pagu_2026:$("#EditPagu2026").val(),
  target_2027:$("#EditTarget2027").val(),
  pagu_2027:$("#EditPagu2027").val(),
  target_2028:$("#EditTarget2028").val(),
  pagu_2028:$("#EditPagu2028").val(),
  target_2029:$("#EditTarget2029").val(),
  pagu_2029:$("#EditPagu2029").val(),
  target_2030:$("#EditTarget2030").val(),
  pagu_2030:$("#EditPagu2030").val(),

  keterangan:$("#EditKeterangan").val()

},function(res){
  if(res=="1") location.reload();
  else alert(res);
});

});

/* HAPUS */
$(".BtnHapus").click(function(){
if(!confirm("Hapus data ini?")) return;

$.post(BaseURL+"Daerah/HapusRencanaProgramPendanaan",{
  id:$(this).data("id")
},function(res){
  if(res=="1") location.reload();
});
});
});
</script>
