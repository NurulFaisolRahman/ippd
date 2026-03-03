<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    .table-renstra th, .table-renstra td { 
        vertical-align: middle; 
        text-align: center; 
        border: 1px solid #dee2e6; 
        padding: 8px; 
    }
    .uraian { 
        text-align: left !important; 
        padding-left: 15px !important; 
        white-space: pre-wrap; 
        word-break: break-word; 
    }
    .rp { white-space: nowrap; font-weight: 500; }
    .btn-aksi { padding: 5px 8px; font-size: 0.9rem; margin: 0 2px; }
    .form-horizental .form-group { margin-bottom: 15px; }
    .filter-row .form-control { height: 38px; }
    /* Tombol sejajar */
    .btn-group-aksi {
        display: flex;
        justify-content: center;
        gap: 5px; /* jarak antar tombol */
    }
</style>

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
               <i class="notika-icon bi-plus-lg"></i> Tambah Data
              </button>
              <br><br>
            <?php } ?>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-renstra">
                <thead>
                  <tr>
                    <th style="width:60px;">NO</th>
                    <th>Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan Perangkat Daerah</th>
                    <th>Indikator Kinerja</th>
                    <th>Satuan</th>
                    <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                      <th colspan="2"><?= $thn ?></th>
                    <?php endfor; ?>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th class="text-center" style="width:120px;">AKSI</th>
                    <?php } ?>
                  </tr>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                      <th>Target</th>
                      <th>Rp</th>
                    <?php endfor; ?>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($anggaran)) { ?>
                    <?php foreach ($anggaran as $row) { ?>
                      <tr>
                        <td class="text-center"><?= html_escape($row['NoManual'] ?: '-') ?></td>
                        <td class="uraian"><?= html_escape($row['Uraian']) ?></td>
                        <td><?= html_escape($row['IndikatorKinerja'] ?? '-') ?></td>
                        <td><?= html_escape($row['Satuan'] ?: '-') ?></td>

                        <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
                          <td class="text-right">
                            <?= number_format($row["Target$thn"] ?? 0, 2, ',', '.') ?>
                          </td>
                          <td class="text-right rp">
                            <?= $row["Rp$thn"] ? 'Rp ' . number_format($row["Rp$thn"], 0, ',', '.') : '-' ?>
                          </td>
                        <?php endfor; ?>

                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <td class="text-center">
                            <div class="btn-group-aksi">
                              <button class="btn btn-warning btn-sm BtnEdit"
                                data-id="<?= (int)$row['Id'] ?>"
                                data-nomanual="<?= html_escape($row['NoManual'] ?? '') ?>"
                                data-uraian="<?= html_escape($row['Uraian']) ?>"
                                data-indikator="<?= html_escape($row['IndikatorKinerja'] ?? '') ?>"
                                data-satuan="<?= html_escape($row['Satuan'] ?? '') ?>"
                                data-target2025="<?= $row['Target2025'] ?? '' ?>"
                                data-rp2025="<?= $row['Rp2025'] ?? '' ?>"
                                data-target2026="<?= $row['Target2026'] ?? '' ?>"
                                data-rp2026="<?= $row['Rp2026'] ?? '' ?>"
                                data-target2027="<?= $row['Target2027'] ?? '' ?>"
                                data-rp2027="<?= $row['Rp2027'] ?? '' ?>"
                                data-target2028="<?= $row['Target2028'] ?? '' ?>"
                                data-rp2028="<?= $row['Rp2028'] ?? '' ?>"
                                data-target2029="<?= $row['Target2029'] ?? '' ?>"
                                data-rp2029="<?= $row['Rp2029'] ?? '' ?>"
                                data-target2030="<?= $row['Target2030'] ?? '' ?>"
                                data-rp2030="<?= $row['Rp2030'] ?? '' ?>"
                                data-keterangan="<?= html_escape($row['Keterangan'] ?? '') ?>"
                                title="Edit">
                                <i class="notika-icon notika-edit"></i>
                              </button>

                              <button class="btn btn-danger btn-sm BtnHapus"
                                data-id="<?= (int)$row['Id'] ?>"
                                title="Hapus">
                                <i class="notika-icon notika-trash"></i>
                              </button>
                            </div>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level']==3) ? 17 : 16 ?>" class="text-center">
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
        <h4><b>Tambah Anggaran Renstra PD</b></h4>
      </div>

      <div class="modal-body">

        <div class="form-group">
          <label><b>NO (diisi manual)</b></label>
          <input type="text" class="form-control" id="NoManual" placeholder="contoh: 1. atau A atau 1.1 atau Lampiran 2">
        </div>

        <div class="form-group">
          <label><b>Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan Perangkat Daerah</b></label>
          <textarea class="form-control" id="Uraian" rows="3" required></textarea>
        </div>

        <div class="form-group">
          <label><b>Indikator Kinerja</b></label>
          <textarea class="form-control" id="IndikatorKinerja" rows="2"></textarea>
        </div>

        <div class="form-group">
          <label><b>Satuan</b></label>
          <input type="text" class="form-control" id="Satuan" placeholder="contoh: %, Orang, Dokumen, Miliar Rp">
        </div>

        <div class="row">
          <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Target <?= $thn ?></b></label>
                <input type="number" step="0.0001" class="form-control" id="Target<?= $thn ?>">
              </div>
              <div class="form-group">
                <label><b>Rp <?= $thn ?></b></label>
                <input type="number" step="0.01" class="form-control" id="Rp<?= $thn ?>">
              </div>
            </div>
          <?php endfor; ?>
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
        <h4><b>Edit Anggaran Renstra PD</b></h4>
      </div>

      <div class="modal-body">
        <input type="hidden" id="EditId">

        <div class="form-group">
          <label><b>NO (diisi manual)</b></label>
          <input type="text" class="form-control" id="EditNoManual" placeholder="contoh: 1. atau A atau 1.1 atau Lampiran 2">
        </div>

        <div class="form-group">
          <label><b>Tujuan/Sasaran/Program/Kegiatan/Sub Kegiatan Perangkat Daerah</b></label>
          <textarea class="form-control" id="EditUraian" rows="3" required></textarea>
        </div>

        <div class="form-group">
          <label><b>Indikator Kinerja</b></label>
          <textarea class="form-control" id="EditIndikatorKinerja" rows="2"></textarea>
        </div>

        <div class="form-group">
          <label><b>Satuan</b></label>
          <input type="text" class="form-control" id="EditSatuan">
        </div>

        <div class="row">
          <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Target <?= $thn ?></b></label>
                <input type="number" step="0.0001" class="form-control" id="EditTarget<?= $thn ?>">
              </div>
              <div class="form-group">
                <label><b>Rp <?= $thn ?></b></label>
                <input type="number" step="0.01" class="form-control" id="EditRp<?= $thn ?>">
              </div>
            </div>
          <?php endfor; ?>
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
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js') ?>"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
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

/* ================= SIMPAN ================= */
$("#BtnSimpan").click(function(){

  var data = {
    NoManual: $("#NoManual").val(),
    Uraian: $("#Uraian").val(),
    IndikatorKinerja: $("#IndikatorKinerja").val(),
    Satuan: $("#Satuan").val(),
    Keterangan: $("#Keterangan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  };

  <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
    data["Target<?= $thn ?>"] = $("#Target<?= $thn ?>").val() || null;
    data["Rp<?= $thn ?>"] = $("#Rp<?= $thn ?>").val() || null;
  <?php endfor; ?>

  $.post(BaseURL + "Daerah/simpanAnggaranRenstra", data, function(res){
    if(res.status === "success") {
      alert("Data berhasil disimpan");
      location.reload();
    } else {
      alert(res.message || "Gagal menyimpan");
    }
  }, "json");
});


/* ================= OPEN EDIT ================= */
$(document).on("click", ".BtnEdit", function(){
  var btn = $(this);

  $("#EditId").val(btn.data("id"));
  $("#EditNoManual").val(btn.data("nomanual") || "");
  $("#EditUraian").val(btn.data("uraian"));
  $("#EditIndikatorKinerja").val(btn.data("indikator") || "");
  $("#EditSatuan").val(btn.data("satuan") || "");
  $("#EditKeterangan").val(btn.data("keterangan") || "");

  <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
    $("#EditTarget<?= $thn ?>").val(btn.data("target<?= $thn ?>") || "");
    $("#EditRp<?= $thn ?>").val(btn.data("rp<?= $thn ?>") || "");
  <?php endfor; ?>

  $("#ModalEdit").modal("show");
});


/* ================= UPDATE ================= */
$("#BtnUpdate").click(function(){

  var data = {
    Id: $("#EditId").val(),
    NoManual: $("#EditNoManual").val(),
    Uraian: $("#EditUraian").val(),
    IndikatorKinerja: $("#EditIndikatorKinerja").val(),
    Satuan: $("#EditSatuan").val(),
    Keterangan: $("#EditKeterangan").val(),
    [CSRF_NAME]: CSRF_TOKEN
  };

  <?php for ($thn = 2025; $thn <= 2030; $thn++): ?>
    data["Target<?= $thn ?>"] = $("#EditTarget<?= $thn ?>").val() || null;
    data["Rp<?= $thn ?>"] = $("#EditRp<?= $thn ?>").val() || null;
  <?php endfor; ?>

  $.post(BaseURL + "Daerah/simpanAnggaranRenstra", data, function(res){
    if(res.status === "success") {
      alert("Data berhasil diupdate");
      location.reload();
    } else {
      alert(res.message || "Gagal update");
    }
  }, "json");
});

// Hapus
$(document).on("click",".BtnHapus",function(){
  if(!confirm("Yakin hapus data ini?")) return;

  $.post(BaseURL + "Daerah/hapusAnggaranRenstra", {
    Id: $(this).data("id"),
    [CSRF_NAME]: CSRF_TOKEN
  }, function(res){
    if(res.status === "success") {
      alert("Data berhasil dihapus");
      location.reload();
    } else {
      alert(res.message || "Gagal hapus!");
    }
  }, "json");
});
</script>

</body>
</html>