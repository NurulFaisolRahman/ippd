<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 4px 18px rgba(0,0,0,0.06); padding: 25px 25px 30px; background: #fff; border: 1px solid #e2e8f0;">

            <!-- FILTER PROVINSI & KAB/KOTA (MUNCUL SAAT BELUM SET KodeWilayah) -->
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

                  <!-- FILTER INSTANSI SEBELUM LOGIN -->
                  <div id="FilterInstansiGroupBefore" style="flex: 1 1 220px; min-width: 180px; display: none;">
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

            <!-- TOMBOL TAMBAH (HANYA UNTUK ROLE 4) -->
            <?php if ($IsRole4) { ?>
              <div class="basic-tb-hd" style="margin-bottom: 20px;">
                <button class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambah" style="height: 38px; padding: 0 20px; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 2px 5px rgba(0,194,146,0.25);">
                  <i class="fa fa-plus" style="font-size: 14px; font-weight: 900; color: #ffffff !important;"></i> <span>Tambah Data</span>
                </button>
              </div>
            <?php } ?>


            <!-- ================= TABLE ================= -->
            <div class="table-ikk-wrapper">
              <div class="table-responsive">
                <table id="data-table-basic" class="table table-striped table-ikk-custom">
                <thead>
                  <tr>
                    <th rowspan="3">BIDANG URUSAN PROGRAM/OUTCOME <br>KEGIATAN SUB KEGIATAN</th>
                    <th rowspan="3">INDIKATOR OUTCOME/OUTPUT</th>
                    <th rowspan="3">BASELINE 2024</th>
                    <th class="text-center" colspan="10">TARGET DAN PAGU INDIKATIF TAHUN</th>
                    <th rowspan="3">KET.</th>
                    <?php if ($IsRole4) { ?>
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
                  <?php if (!empty($list)) { ?>
                    <?php foreach($list as $r){ ?>
                      <tr>
                        <td>
                          <?php if($r['sumber_tipe'] == 'urusan'){ ?>
                            <?= html_escape(str_replace("Urusan PD: ", "", $r['sumber_nilai'])) ?>
                          <?php } else { ?>
                            <?= html_escape($r['sumber_nilai']) ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if(!empty($r['indikator_text']) && $r['indikator_text'] != '-- Pilih Indikator --'){ ?>
                            <?= html_escape($r['indikator_text']) ?>
                          <?php } ?>
                        </td>
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
                        <?php if ($IsRole4) { ?>
                          <td class="text-center" style="vertical-align: middle;">
                            <div class="btn-action-group">
                              <button class="btn btn-sm btn-warning btn-action-edit BtnEdit"
                                data-id="<?= $r['id'] ?>"
                                data-sumber_tipe="<?= $r['sumber_tipe'] ?>"
                                data-sumber_id="<?= $r['sumber_id'] ?>"
                                data-indikator_id="<?= $r['indikator_id'] ?>"
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
                                data-ket="<?= html_escape($r['keterangan']) ?>"
                                title="Edit Data">
                                <i class="notika-icon notika-edit"></i>
                              </button>
                              <button class="btn btn-sm btn-danger btn-action-delete BtnHapus" data-id="<?= $r['id'] ?>" title="Hapus Data">
                                <i class="notika-icon notika-trash"></i>
                              </button>
                            </div>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="<?= $IsRole4 ? '17' : '16' ?>" class="text-center">Belum ada data Rencana Program Pendanaan</td>
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
        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
          <div class="alert alert-info">
            <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
          </div>
        <?php } ?>

        <div class="label-mini">
          BIDANG URUSAN PROGRAM/OUTCOME KEGIATAN SUB KEGIATAN <span style="color:red">*</span>
        </div>
        
        <div class="label-mini">PILIH SUMBER DATA <span style="color:red">*</span></div>
        <select id="SumberTipe" class="form-control">
          <option value="">-- Pilih Tipe --</option>
          <option value="urusan">Urusan PD</option>
          <option value="outcome">Outcome</option>
          <option value="output">Output</option>
          <option value="program">Program</option>
          <option value="kegiatan">Kegiatan</option>
          <option value="sub_kegiatan">Sub Kegiatan</option>
        </select>
        <br>

        <select id="SumberId" class="form-control">
          <option value="">-- Pilih Data --</option>
        </select>
        <br>

        <div class="label-mini">INDIKATOR OUTCOME/OUTPUT</div>
        <select id="IndikatorId" class="form-control">
          <option value="">-- Pilih Indikator --</option>
          <?php foreach($listIndikator as $i){ ?>
            <option value="<?= $i['id'] ?>">
              <?= html_escape($i['text']) ?>
            </option>
          <?php } ?>
        </select>
        <br>

        <div class="label-mini">BASELINE 2024</div>
        <input type="text" id="Baseline" class="form-control">
        <br>

        <div class="label-mini">TARGET & PAGU INDIKATIF</div>
        <div class="tahun-grid">
          <?php $years = [2026,2027,2028,2029,2030]; ?>
          <?php for($i=0;$i<count($years);$i+=2){ ?>
            <div class="tahun-row">
              <?php for($j=$i;$j<$i+2 && $j<count($years);$j++){ $t = $years[$j]; ?>
                <div class="tahun-box">
                  <div class="label-mini">TAHUN <?= $t ?></div>
                  <div class="tp-header">
                    <div class="tp-col">TARGET</div>
                    <div class="tp-col">PAGU</div>
                  </div>
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

        <div class="label-mini">KETERANGAN</div>
        <textarea id="Keterangan" class="form-control"></textarea>
        <br>

        <button class="btn btn-success" id="BtnSimpan">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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

        <div class="label-mini">
          BIDANG URUSAN PROGRAM/OUTCOME KEGIATAN SUB KEGIATAN <span style="color:red">*</span>
        </div>
        <select id="EditSumberTipe" class="form-control">
          <option value="">-- Pilih Tipe --</option>
          <option value="urusan">Urusan PD</option>
          <option value="outcome">Outcome</option>
          <option value="output">Output</option>
          <option value="program">Program</option>
          <option value="kegiatan">Kegiatan</option>
          <option value="sub_kegiatan">Sub Kegiatan</option>
        </select>
        <br>

        <select id="EditSumberId" class="form-control">
          <option value="">-- Pilih Data --</option>
        </select>
        <br>

        <div class="label-mini">INDIKATOR OUTCOME/OUTPUT</div>
        <select id="EditIndikatorId" class="form-control">
          <option value="">-- Pilih Indikator --</option>
          <?php foreach($listIndikator as $i){ ?>
            <option value="<?= $i['id'] ?>">
              <?= html_escape($i['text']) ?>
            </option>
          <?php } ?>
        </select>
        <br>

        <div class="label-mini">BASELINE 2024</div>
        <input type="text" id="EditBaseline" class="form-control">
        <br>

        <div class="label-mini">TARGET & PAGU INDIKATIF</div>
        <div class="tahun-grid">
          <?php for($i=0;$i<count($years);$i+=2){ ?>
            <div class="tahun-row">
              <?php for($j=$i;$j<$i+2 && $j<count($years);$j++){ $t = $years[$j]; ?>
                <div class="tahun-box">
                  <div class="label-mini">TAHUN <?= $t ?></div>
                  <div class="tp-header">
                    <div class="tp-col">TARGET</div>
                    <div class="tp-col">PAGU</div>
                  </div>
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

        <div class="label-mini">KETERANGAN</div>
        <textarea id="EditKeterangan" class="form-control"></textarea>
        <br>

        <button class="btn btn-primary" id="BtnUpdate">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<style>
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
  .tp-input {
    display: flex;
    gap: 5px;
  }
  .modal-body textarea {
    height: 50px;
  }
  .tahun-row {
    display: flex;
    gap: 12px;
    margin-bottom: 8px;
  }
  .tahun-box {
    flex: 0 0 48%;
  }
  .input-target, .input-pagu {
    height: 28px;
    font-size: 11px;
    padding: 3px 5px;
  }
  .input-target { width: 50%; }
  .input-pagu   { width: 50%; }
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
  .btn-sm {
    margin: 2px;
  }
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

jQuery(document).ready(function($){

  // Inisialisasi DataTable
  // Inisialisasi DataTable - tanpa sorting, dengan pagination berjarak
if ($('#data-table-basic').length > 0) {
  try {
    if ($.fn.DataTable.isDataTable('#data-table-basic')) {
      $('#data-table-basic').DataTable().destroy();
    }
    $('#data-table-basic').DataTable({
      "pageLength": 10,
      "ordering": false,  // Menonaktifkan sorting
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
      // Memberi jarak antar tombol pagination
      "drawCallback": function(settings) {
        var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
        pagination.find('a').css('margin', '0 5px');
      }
    });
  } catch(e) {
    console.log("DataTable error:", e);
  }
}

// Memberikan jarak pada pagination setelah DataTable diinisialisasi
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
          var redirectUrl = BaseURL + "Instansi/RencanaProgramPendanaan";
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
      var url = BaseURL + "Instansi/RencanaProgramPendanaan";
      if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
      window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/RencanaProgramPendanaan"; });
  <?php } ?>

  /* ================= CRUD OPERATIONS (HANYA UNTUK ROLE 4) ================= */
  <?php if ($IsRole4) { ?>

  var listUrusan = <?= json_encode($listUrusan) ?>;
  var listRenstra = <?= json_encode($listRenstra) ?>;

  function loadSumber(tipe, targetSelect){
    var html = '<option value="">-- Pilih Data --</option>';
    if(tipe == 'urusan'){
      listUrusan.forEach(function(item){
        html += '<option value="'+item.id+'">'+item.nama_urusan+'</option>';
      });
    } else {
      listRenstra.forEach(function(item){
        if(item[tipe]){
          var values = item[tipe].split('|||');
          values.forEach(function(val){
            val = val.trim();
            if(val !== ''){
              html += '<option value="'+item.id+'">'+val+'</option>';
            }
          });
        }
      });
    }
    $(targetSelect).html(html);
  }

  $("#SumberTipe").change(function(){
    loadSumber($(this).val(), "#SumberId");
  });

  $("#EditSumberTipe").change(function(){
    loadSumber($(this).val(), "#EditSumberId");
  });

  function loadSumberEdit(tipe, selectedId){
    loadSumber(tipe, "#EditSumberId");
    setTimeout(function(){
      $("#EditSumberId").val(selectedId);
    },200);
  }

  // SIMPAN
  $("#BtnSimpan").click(function(){
    if($("#SumberTipe").val()=="" || $("#SumberId").val()==""){
      alert("Sumber data wajib dipilih!");
      return;
    }

    $.ajax({
      url: BaseURL + "Instansi/InputRencanaProgramPendanaan",
      type: "POST",
      data: {
        sumber_tipe: $("#SumberTipe").val(),
        sumber_id: $("#SumberId").val(),
        sumber_nilai: $("#SumberTipe option:selected").text() + ": " + $("#SumberId option:selected").text(),
        indikator_id: $("#IndikatorId").val(),
        indikator_text: $("#IndikatorId option:selected").text(),
        baseline: $("#Baseline").val(),
        target_2026: $("#Target2026").val(),
        pagu_2026: $("#Pagu2026").val(),
        target_2027: $("#Target2027").val(),
        pagu_2027: $("#Pagu2027").val(),
        target_2028: $("#Target2028").val(),
        pagu_2028: $("#Pagu2028").val(),
        target_2029: $("#Target2029").val(),
        pagu_2029: $("#Pagu2029").val(),
        target_2030: $("#Target2030").val(),
        pagu_2030: $("#Pagu2030").val(),
        keterangan: $("#Keterangan").val(),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") location.reload();
        else alert(res);
      },
      error: function() { alert("Gagal request!"); }
    });
  });

  // EDIT OPEN
  $(".BtnEdit").click(function(){
    $("#EditId").val($(this).data("id"));
    $("#EditSumberTipe").val($(this).data("sumber_tipe"));
    loadSumberEdit($(this).data("sumber_tipe"), $(this).data("sumber_id"));
    $("#EditIndikatorId").val($(this).data("indikator_id"));
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

  // UPDATE
  $("#BtnUpdate").click(function(){
    $.ajax({
      url: BaseURL + "Instansi/EditRencanaProgramPendanaan",
      type: "POST",
      data: {
        id: $("#EditId").val(),
        sumber_tipe: $("#EditSumberTipe").val(),
        sumber_id: $("#EditSumberId").val(),
        sumber_nilai: $("#EditSumberTipe option:selected").text() + ": " + $("#EditSumberId option:selected").text(),
        indikator_id: $("#EditIndikatorId").val(),
        indikator_text: $("#EditIndikatorId option:selected").text(),
        baseline: $("#EditBaseline").val(),
        target_2026: $("#EditTarget2026").val(),
        pagu_2026: $("#EditPagu2026").val(),
        target_2027: $("#EditTarget2027").val(),
        pagu_2027: $("#EditPagu2027").val(),
        target_2028: $("#EditTarget2028").val(),
        pagu_2028: $("#EditPagu2028").val(),
        target_2029: $("#EditTarget2029").val(),
        pagu_2029: $("#EditPagu2029").val(),
        target_2030: $("#EditTarget2030").val(),
        pagu_2030: $("#EditPagu2030").val(),
        keterangan: $("#EditKeterangan").val(),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") location.reload();
        else alert(res);
      },
      error: function() { alert("Gagal request!"); }
    });
  });

  // HAPUS
  $(".BtnHapus").click(function(){
    if(!confirm("Hapus data ini?")) return;
    $.ajax({
      url: BaseURL + "Instansi/HapusRencanaProgramPendanaan",
      type: "POST",
      data: {
        id: $(this).data("id"),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") location.reload();
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