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

            <!-- Tombol Tambah MASTER -->
            <?php if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) { ?>
              <div class="basic-tb-hd">
                <div class="button-icon-btn sm-res-mg-t-30">
                  <button type="button"
                          class="btn btn-success notika-btn-success"
                          data-toggle="modal"
                          data-target="#ModalInputMaster">
                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah NSPK & Sasaran (Header)</b>
                  </button>
                </div>
              </div>
              <br>
            <?php } ?>

            <!-- TABLE (MASTER-DETAIL) -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th rowspan="2" style="width:60px;">No</th>
                    <th rowspan="2" style="width:420px; text-align:center;">NSPK DAN SASARAN RPJMD YANG RELEVAN</th>
                    <th rowspan="2" style="width:180px; text-align:center;">TUJUAN</th>
                    <th rowspan="2" style="width:180px; text-align:center;">SASARAN</th>
                    <th rowspan="2" style="width:220px; text-align:center;">INDIKATOR</th>
                    <th colspan="6" style="text-align:center;">TARGET TAHUN</th>
                    <th rowspan="2" style="width:220px; text-align:center;">KETERANGAN</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th rowspan="2" style="width:120px; text-align:center;">AKSI</th>
                      <th rowspan="2" style="width:120px; text-align:center;">AKSI <br>INDIKATOR</th>
                    <?php } ?>
                  </tr>
                  <tr>
                    <th style="width:90px; text-align:center;">2025</th>
                    <th style="width:90px; text-align:center;">2026</th>
                    <th style="width:90px; text-align:center;">2027</th>
                    <th style="width:90px; text-align:center;">2028</th>
                    <th style="width:90px; text-align:center;">2029</th>
                    <th style="width:90px; text-align:center;">2030</th>
                  </tr>
                </thead>

                <tbody>
<?php if (!empty($TujuanSasaranPD)) { ?>
<?php $no = 1; foreach ($TujuanSasaranPD as $m) { ?>

<?php
  $details  = isset($m['details']) ? $m['details'] : [];
  $rowspan  = max(1, count($details));

  $nspkText        = $m['nspk'] ?? '';
  $sasaranRelText  = $m['sasaran_relevan_text'] ?? '';
  $tujuanText      = $m['tujuan_text'] ?? '';
  $sasaranText     = $m['sasaran_text'] ?? '';
?>

<?php if (!empty($details)) { ?>
<?php $d0 = $details[0]; ?>

<tr>
  <td rowspan="<?= $rowspan ?>" class="text-center"><?= $no++ ?></td>

  <td rowspan="<?= $rowspan ?>">
    <b>NSPK:</b><br><?= nl2br(html_escape($nspkText)) ?><br><br>
    <b>Sasaran RPJMD yang Relevan:</b><br><?= nl2br(html_escape($sasaranRelText)) ?>
  </td>

  <td rowspan="<?= $rowspan ?>"><?= nl2br(html_escape($tujuanText)) ?></td>
  <td rowspan="<?= $rowspan ?>"><?= nl2br(html_escape($sasaranText)) ?></td>

  <!-- INDIKATOR TEXT -->
  <td><?= nl2br(html_escape($d0['indikator'])) ?></td>

  <!-- TARGET -->
  <td class="text-center"><?= $d0['t2025'] ?></td>
  <td class="text-center"><?= $d0['t2026'] ?></td>
  <td class="text-center"><?= $d0['t2027'] ?></td>
  <td class="text-center"><?= $d0['t2028'] ?></td>
  <td class="text-center"><?= $d0['t2029'] ?></td>
  <td class="text-center"><?= $d0['t2030'] ?></td>

  <td><?= nl2br(html_escape($d0['keterangan'])) ?></td>

  <!-- AKSI HEADER -->
  <td class="text-center">
    <div class="btn-group-flex">
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
      <button class="btn btn-info btn-sm BtnEditMaster"
  data-id="<?= (int)$m['id'] ?>"
  data-nspk="<?= html_escape($nspkText) ?>"
  data-sasaran-relevan-id="<?= (int)($m['sasaran_relevan_id'] ?? 0) ?>"
  data-tujuan-id="<?= (int)($m['tujuan_id'] ?? 0) ?>"
  data-sasaran-id="<?= (int)($m['sasaran_id'] ?? 0) ?>">
  <i class="notika-icon notika-edit"></i>
</button>
      <button class="btn btn-danger btn-sm BtnHapusMaster" data-id="<?= $m['id'] ?>">
        <i class="notika-icon notika-trash"></i>
      </button>
    <?php } ?>
    </div>
  </td>

  <!-- AKSI INDIKATOR -->
  <td class="text-center">
    <div class="btn-group-flex">
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
      <button class="btn btn-success btn-sm BtnAddDetail" data-master-id="<?= $m['id'] ?>">
        <i class="notika-icon bi-plus-lg"></i>
      </button>
      <button class="btn btn-warning btn-sm BtnEditDetail"
  data-id="<?= (int)$d0['id'] ?>"
  data-parent-id="<?= (int)$m['id'] ?>"
  data-indikator="<?= html_escape($d0['indikator']) ?>"
  data-t2025="<?= html_escape($d0['t2025']) ?>"
  data-t2026="<?= html_escape($d0['t2026']) ?>"
  data-t2027="<?= html_escape($d0['t2027']) ?>"
  data-t2028="<?= html_escape($d0['t2028']) ?>"
  data-t2029="<?= html_escape($d0['t2029']) ?>"
  data-t2030="<?= html_escape($d0['t2030']) ?>"
  data-keterangan="<?= html_escape($d0['keterangan']) ?>">
  <i class="notika-icon notika-edit"></i>
</button>

      <button class="btn btn-danger btn-sm BtnHapusDetail" data-id="<?= $d0['id'] ?>">
        <i class="notika-icon notika-trash"></i>
      </button>
    <?php } ?>
    </div>
  </td>
</tr>

<?php for ($i=1; $i<count($details); $i++) { $d=$details[$i]; ?>
<tr>
  <td><?= nl2br(html_escape($d['indikator'])) ?></td>
  <td class="text-center"><?= $d['t2025'] ?></td>
  <td class="text-center"><?= $d['t2026'] ?></td>
  <td class="text-center"><?= $d['t2027'] ?></td>
  <td class="text-center"><?= $d['t2028'] ?></td>
  <td class="text-center"><?= $d['t2029'] ?></td>
  <td class="text-center"><?= $d['t2030'] ?></td>
  <td><?= nl2br(html_escape($d['keterangan'])) ?></td>
  <td></td>
  <td class="text-center">
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
      <button class="btn btn-warning btn-sm BtnEditDetail"
  data-id="<?= (int)$d['id'] ?>"
  data-parent-id="<?= (int)$m['id'] ?>"
  data-indikator="<?= html_escape($d['indikator']) ?>"
  data-t2025="<?= html_escape($d['t2025']) ?>"
  data-t2026="<?= html_escape($d['t2026']) ?>"
  data-t2027="<?= html_escape($d['t2027']) ?>"
  data-t2028="<?= html_escape($d['t2028']) ?>"
  data-t2029="<?= html_escape($d['t2029']) ?>"
  data-t2030="<?= html_escape($d['t2030']) ?>"
  data-keterangan="<?= html_escape($d['keterangan']) ?>">
  <i class="notika-icon notika-edit"></i>
</button>

      <button class="btn btn-danger btn-sm BtnHapusDetail" data-id="<?= $d['id'] ?>">
        <i class="notika-icon notika-trash"></i>
      </button>
    <?php } ?>
  </td>
</tr>
<?php } ?>

<?php } else { ?>
<tr>
  <td class="text-center"><?= $no++ ?></td>
  <td>
    <b>NSPK:</b><br><?= nl2br(html_escape($nspkText)) ?><br><br>
    <b>Sasaran RPJMD yang Relevan:</b><br><?= nl2br(html_escape($sasaranRelText)) ?>
  </td>
  <td><?= nl2br(html_escape($tujuanText)) ?></td>
  <td><?= nl2br(html_escape($sasaranText)) ?></td>

  <td colspan="7" class="text-center"><i>Belum ada indikator</i></td>
  <td>-</td>

  <td class="text-center">
    <div class="btn-group-flex">
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
      <button class="btn btn-info btn-sm BtnEditMaster"
  data-id="<?= (int)$m['id'] ?>"
  data-nspk="<?= html_escape($m['nspk']) ?>"
  data-sasaran-relevan-id="<?= (int)$m['sasaran_relevan_id'] ?>"
  data-tujuan-id="<?= (int)$m['tujuan_id'] ?>"
  data-sasaran-id="<?= (int)$m['sasaran_id'] ?>">
  <i class="notika-icon notika-edit"></i>
</button>

      <button class="btn btn-danger btn-sm BtnHapusMaster" data-id="<?= $m['id'] ?>">
        <i class="notika-icon notika-trash"></i>
      </button>
    <?php } ?>
    </div>
  </td>

  <td class="text-center">
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
      <button class="btn btn-success btn-sm BtnAddDetail" data-master-id="<?= $m['id'] ?>">
        <i class="notika-icon bi-plus-lg"></i>
      </button>
    <?php } ?>
  </td>
</tr>
<?php } ?>

<?php } } ?>
</tbody>


              </table>
            </div>

          </div><!-- /.data-table-list -->
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL INPUT MASTER ================= -->
  <div class="modal fade" id="ModalInputMaster" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Tambah NSPK & Sasaran (Header)</b></h4>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label><b>NSPK</b></label>
            <textarea id="NSPK" class="form-control" rows="4" placeholder="Ketik NSPK..."></textarea>
          </div>

          <div class="form-group">
            <label><b>Sasaran RPJMD yang Relevan</b></label>
            <select id="SasaranRelevanId" class="form-control">
              <option value="">Pilih Sasaran RPJMD</option>
              <?php if (!empty($ListSasaranRPJMD)) { foreach ($ListSasaranRPJMD as $s) { ?>
                <option value="<?= (int)$s['id'] ?>"><?= html_escape($s['Sasaran']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Tujuan</b></label>
            <select id="TujuanId" class="form-control">
              <option value="">Pilih Tujuan</option>
              <?php if (!empty($ListTujuanPD)) { foreach ($ListTujuanPD as $t) { ?>
                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Sasaran</b></label>
            <select id="SasaranId" class="form-control">
              <option value="">Pilih Sasaran</option>
              <?php if (!empty($ListSasaranPD)) { foreach ($ListSasaranPD as $sp) { ?>
                <option value="<?= (int)$sp['id'] ?>"><?= html_escape($sp['sasaran_pd']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnSimpanMaster"><b>SIMPAN</b></button>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT MASTER ================= -->
  <div class="modal fade" id="ModalEditMaster" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Edit NSPK & Sasaran (Header)</b></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="EditMasterId">

          <div class="form-group">
            <label><b>NSPK</b></label>
            <textarea id="EditNSPK" class="form-control" rows="4"></textarea>
          </div>

          <div class="form-group">
            <label><b>Sasaran RPJMD yang Relevan</b></label>
            <select id="EditSasaranRelevanId" class="form-control">
              <option value="">Pilih Sasaran RPJMD</option>
              <?php if (!empty($ListSasaranRPJMD)) { foreach ($ListSasaranRPJMD as $s) { ?>
                <option value="<?= (int)$s['id'] ?>"><?= html_escape($s['Sasaran']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Tujuan</b></label>
            <select id="EditTujuanId" class="form-control">
              <option value="">Pilih Tujuan</option>
              <?php if (!empty($ListTujuanPD)) { foreach ($ListTujuanPD as $t) { ?>
                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Sasaran</b></label>
            <select id="EditSasaranId" class="form-control">
              <option value="">Pilih Sasaran</option>
              <?php if (!empty($ListSasaranPD)) { foreach ($ListSasaranPD as $sp) { ?>
                <option value="<?= (int)$sp['id'] ?>"><?= html_escape($sp['sasaran_pd']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnUpdateMaster"><b>SIMPAN</b></button>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL INPUT DETAIL ================= -->
  <div class="modal fade" id="ModalInputDetail" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Tambah Indikator</b></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="DetailMasterId">

          <div class="form-group">
            <label><b>Indikator</b></label>
            <textarea id="Indikator" class="form-control" rows="3" placeholder="Ketik indikator..."></textarea>
          </div>

          <div class="row">
            <div class="col-lg-2"><label><b>2025</b></label><input type="text" id="T2025" class="form-control"></div>
            <div class="col-lg-2"><label><b>2026</b></label><input type="text" id="T2026" class="form-control"></div>
            <div class="col-lg-2"><label><b>2027</b></label><input type="text" id="T2027" class="form-control"></div>
            <div class="col-lg-2"><label><b>2028</b></label><input type="text" id="T2028" class="form-control"></div>
            <div class="col-lg-2"><label><b>2029</b></label><input type="text" id="T2029" class="form-control"></div>
            <div class="col-lg-2"><label><b>2030</b></label><input type="text" id="T2030" class="form-control"></div>
          </div>

          <br>

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea id="Keterangan" class="form-control" rows="2" placeholder="Ketik keterangan..."></textarea>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnSimpanDetail"><b>SIMPAN</b></button>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT DETAIL ================= -->
  <div class="modal fade" id="ModalEditDetail" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Edit Indikator</b></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="EditDetailId">

          <div class="form-group">
            <label><b>Indikator</b></label>
            <textarea id="EditIndikator" class="form-control" rows="3"></textarea>
          </div>

          <div class="row">
            <div class="col-lg-2"><label><b>2025</b></label><input type="text" id="EditT2025" class="form-control"></div>
            <div class="col-lg-2"><label><b>2026</b></label><input type="text" id="EditT2026" class="form-control"></div>
            <div class="col-lg-2"><label><b>2027</b></label><input type="text" id="EditT2027" class="form-control"></div>
            <div class="col-lg-2"><label><b>2028</b></label><input type="text" id="EditT2028" class="form-control"></div>
            <div class="col-lg-2"><label><b>2029</b></label><input type="text" id="EditT2029" class="form-control"></div>
            <div class="col-lg-2"><label><b>2030</b></label><input type="text" id="EditT2030" class="form-control"></div>
          </div>

          <br>

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea id="EditKeterangan" class="form-control" rows="2"></textarea>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnUpdateDetail"><b>SIMPAN</b></button>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.main-content -->

<style>
  .btn-group-flex {
  display: flex;
  justify-content: center; /* tengah */
  align-items: center;
  gap: 6px; /* jarak antar tombol */
  flex-wrap: nowrap;
}

.btn-group-flex .btn {
  margin: 0;
}

</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
  var BaseURL    = '<?= base_url() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';

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

    // =========================
    // MASTER - SIMPAN
    // =========================
   $("#BtnSimpanMaster").click(function(){
  var nspk = $("#NSPK").val().trim();
  if(!nspk){ alert('NSPK harus diisi!'); return; }

  var sasaranRelevanId = $("#SasaranRelevanId").val();
  var tujuanId = $("#TujuanId").val();
  var sasaranId = $("#SasaranId").val();

  if(!sasaranRelevanId){ alert('Sasaran RPJMD harus dipilih!'); return; }
  if(!tujuanId){ alert('Tujuan harus dipilih!'); return; }
  if(!sasaranId){ alert('Sasaran harus dipilih!'); return; }

  $.post(BaseURL + "Daerah/InputTujuanSasaranPD_Master", {
    nspk: nspk,
    sasaran_relevan_id: sasaranRelevanId,
    tujuan_id: tujuanId,
    sasaran_id: sasaranId,
    [CSRF_NAME]: CSRF_TOKEN
  }).done(function(res){
    if(res == '1') window.location.reload();
    else alert(res || 'Gagal simpan!');
  });
});



    // MASTER - BUKA EDIT
    $(document).on("click", ".BtnEditMaster", function(){
  var btn = $(this);

  $("#EditMasterId").val(btn.data('id'));
  $("#EditNSPK").val(btn.data('nspk'));

  // set dropdown by value (id)
  $("#EditSasaranRelevanId").val(String(btn.data('sasaran-relevan-id') || ''));
  $("#EditTujuanId").val(String(btn.data('tujuan-id') || ''));
  $("#EditSasaranId").val(String(btn.data('sasaran-id') || ''));

  $("#ModalEditMaster").modal("show");
});


    // MASTER - UPDATE
    $("#BtnUpdateMaster").click(function(){
  var id = $("#EditMasterId").val();
  var nspk = $("#EditNSPK").val().trim();
  if(!id){ alert('ID tidak valid!'); return; }
  if(!nspk){ alert('NSPK harus diisi!'); return; }

  $.post(BaseURL + "Daerah/EditTujuanSasaranPD_Master", {
  id: id,
  nspk: nspk,
  sasaran_relevan_id: $("#EditSasaranRelevanId").val(),
  tujuan_id: $("#EditTujuanId").val(),
  sasaran_id: $("#EditSasaranId").val(),
  [CSRF_NAME]: CSRF_TOKEN
})
.done(function(res){
    if(res == '1'){ window.location.reload(); }
    else { alert(res || 'Gagal update header!'); }
  }).fail(function(){
    alert('Gagal request (Update Header)');
  });
});


    // MASTER - HAPUS
    $(document).on("click", ".BtnHapusMaster", function(){
      var id = $(this).data('id');
      if(!id){ alert('ID tidak valid!'); return; }
      if(!confirm('Yakin hapus HEADER ini beserta semua indikatornya?')) return;

      $.post(BaseURL + "Daerah/HapusTujuanSasaranPD_Master", {
        id: id,
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        if(res == '1'){ window.location.reload(); }
        else { alert(res || 'Gagal hapus header!'); }
      }).fail(function(){
        alert('Gagal request (Hapus Header)');
      });
    });

    // =========================
    // DETAIL - OPEN ADD
    // =========================
    $(document).on("click", ".BtnAddDetail", function(){
      $("#DetailMasterId").val($(this).data('master-id'));
      $("#Indikator").val('');
      $("#T2025,#T2026,#T2027,#T2028,#T2029,#T2030").val('');
      $("#Keterangan").val('');
      $("#ModalInputDetail").modal("show");
    });

    // DETAIL - SIMPAN
    $("#BtnSimpanDetail").click(function(){
  var masterId  = $("#DetailMasterId").val();
  var indikator = $("#Indikator").val().trim();

  if(!masterId){ alert('Master tidak valid!'); return; }
  if(!indikator){ alert('Indikator harus diisi!'); return; }

  $.post(BaseURL + "Daerah/InputTujuanSasaranPD_Detail", {
    master_id: masterId,
    indikator: indikator,
    t2025: $("#T2025").val().trim(),
    t2026: $("#T2026").val().trim(),
    t2027: $("#T2027").val().trim(),
    t2028: $("#T2028").val().trim(),
    t2029: $("#T2029").val().trim(),
    t2030: $("#T2030").val().trim(),
    keterangan: $("#Keterangan").val().trim(),
    [CSRF_NAME]: CSRF_TOKEN
  }).done(function(res){
    if(res == '1') window.location.reload();
    else alert(res || 'Gagal simpan indikator!');
  }).fail(function(xhr){
    alert('Request gagal: ' + xhr.status);
  });
});


    // DETAIL - OPEN EDIT
    $(document).on("click", ".BtnEditDetail", function(){
  $("#EditDetailId").val($(this).data('id'));
  $("#EditDetailParentId").val($(this).data('parent-id'));
  $("#EditIndikator").val($(this).data('indikator'));
  $("#EditT2025").val($(this).data('t2025'));
  $("#EditT2026").val($(this).data('t2026'));
  $("#EditT2027").val($(this).data('t2027'));
  $("#EditT2028").val($(this).data('t2028'));
  $("#EditT2029").val($(this).data('t2029'));
  $("#EditT2030").val($(this).data('t2030'));
  $("#EditKeterangan").val($(this).data('keterangan'));
  $("#ModalEditDetail").modal("show");
});


    // DETAIL - UPDATE
    $("#BtnUpdateDetail").click(function(){
      var id = $("#EditDetailId").val();
      var indikator = $("#EditIndikator").val().trim();
      if(!id){ alert('ID detail tidak valid!'); return; }
      if(!indikator){ alert('Indikator harus diisi!'); return; }

      $.post(BaseURL + "Daerah/EditTujuanSasaranPD_Detail", {
        id: id,
        indikator: indikator,
        t2025: $("#EditT2025").val().trim(),
        t2026: $("#EditT2026").val().trim(),
        t2027: $("#EditT2027").val().trim(),
        t2028: $("#EditT2028").val().trim(),
        t2029: $("#EditT2029").val().trim(),
        t2030: $("#EditT2030").val().trim(),
        keterangan: $("#EditKeterangan").val().trim(),
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        if(res == '1'){ window.location.reload(); }
        else { alert(res || 'Gagal update indikator!'); }
      }).fail(function(){
        alert('Gagal request (Update Indikator)');
      });
    });

    // DETAIL - HAPUS
    $(document).on("click", ".BtnHapusDetail", function(){
      var id = $(this).data('id');
      if(!id){ alert('ID detail tidak valid!'); return; }
      if(!confirm('Yakin hapus indikator ini?')) return;

      $.post(BaseURL + "Daerah/HapusTujuanSasaranPD_Detail", {
        id: id,
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        if(res == '1'){ window.location.reload(); }
        else { alert(res || 'Gagal hapus indikator!'); }
      }).fail(function(){
        alert('Gagal request (Hapus Indikator)');
      });
    });

  });
</script>

</body>
</html>
