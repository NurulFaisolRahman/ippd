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

                      <!-- FILTER INSTANSI - Muncul setelah pilih Kab/Kota -->
                      <div class="col-lg-3 col-md-6" id="FilterInstansiGroup" style="display: none;">
                        <div class="filter-group">
                          <label for="FilterInstansiBeforeLogin"><b>Instansi </b></label>
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
                          <label for="FilterInstansi"><b>Filter Instansi </b></label>
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
            <!-- END FILTER INSTANSI -->

            <!-- Tombol Tambah (HANYA UNTUK ROLE 4) -->
            <?php if ($IsRole4) { ?>
              <div class="basic-tb-hd">
                <div class="button-icon-btn sm-res-mg-t-30">
                  <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputPermasalahanPD">
                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Permasalahan</b>
                  </button>
                </div>
              </div>
              <br>
            <?php } ?>

            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center" style="width:50px;">No</th>
                    <th>Masalah Pokok</th>
                    <th>Masalah</th>
                    <th>Penyebab Masalah</th>
                    <th>Internal</th>
                    <th>External</th>
                    <th>Akar Masalah</th>
                    <?php if ($IsRole4) { ?>
                      <th class="text-center" style="width:120px;">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($PermasalahanPD)) { ?>
                    <?php $no=1; foreach ($PermasalahanPD as $row) { ?>
                      <tr>
                        <td class="text-center" style="vertical-align: middle;"><?= $no++ ?></td>
                        <td style="vertical-align: middle;">
                          <?= htmlspecialchars($row['NamaPermasalahanPokok'] ?? '-', ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['masalah'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['penyebab_masalah'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['faktor_internal'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['faktor_external'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['akar_masalah'], ENT_QUOTES, 'UTF-8')) ?></td>

                        <?php if ($IsRole4) { ?>
                          <td class="text-center" style="vertical-align: middle;">
                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                              <?php if ($InstansiId == $row['instansi_id']) { ?>
                                <button
                                  class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg BtnEdit"
                                  data-id="<?= (int)$row['id'] ?>"
                                  data-masalah="<?= htmlspecialchars($row['masalah'], ENT_QUOTES, 'UTF-8') ?>"
                                  data-masalah_pokok="<?= htmlspecialchars($row['masalah_pokok'], ENT_QUOTES, 'UTF-8') ?>"
                                  data-penyebab_masalah="<?= htmlspecialchars($row['penyebab_masalah'], ENT_QUOTES, 'UTF-8') ?>"
                                  data-faktor_internal="<?= htmlspecialchars($row['faktor_internal'], ENT_QUOTES, 'UTF-8') ?>"
                                  data-faktor_external="<?= htmlspecialchars($row['faktor_external'], ENT_QUOTES, 'UTF-8') ?>"
                                  data-akar_masalah="<?= htmlspecialchars($row['akar_masalah'], ENT_QUOTES, 'UTF-8') ?>"
                                >
                                  <i class="notika-icon notika-edit"></i>
                                </button>

                                <button
                                  class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg BtnHapus"
                                  data-id="<?= (int)$row['id'] ?>"
                                >
                                  <i class="notika-icon notika-trash"></i>
                                </button>
                              <?php } else { ?>
                                <span class="text-muted">-</span>
                              <?php } ?>
                            </div>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="<?= $IsRole4 ? '9' : '8' ?>" class="text-center">Belum ada数据</td>
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

  <!-- Modal Input Permasalahan (HANYA UNTUK ROLE 4) -->
  <?php if ($IsRole4) { ?>
  <div class="modal fade" id="ModalInputPermasalahanPD" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Permasalahan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">

                <?php if (!empty($NamaInstansi)) { ?>
                  <div class="alert alert-info">
                    <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                  </div>
                <?php } ?>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Masalah Pokok</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="MasalahPokok">
                            <option value="">-- Pilih Masalah Pokok --</option>
                            <?php foreach ($MasalahPokok as $mp) { ?>
                              <option value="<?= (int)$mp['Id'] ?>">
                                <?= htmlspecialchars($mp['NamaPermasalahanPokok'], ENT_QUOTES, 'UTF-8') ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Masalah</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="Masalah" rows="3" placeholder="Tulis masalah..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Penyebab Masalah</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="PenyebabMasalah" rows="3" placeholder="Tulis penyebab masalah..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Faktor Internal</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="FaktorInternal" rows="3" placeholder="Tulis faktor internal..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Faktor External</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="FaktorExternal" rows="3" placeholder="Tulis faktor external..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Akar Masalah</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="AkarMasalah" rows="3" placeholder="Tulis akar masalah..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                      <button class="btn btn-success notika-btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Permasalahan (HANYA UNTUK ROLE 4) -->
  <div class="modal fade" id="ModalEditPermasalahanPD" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Permasalahan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">
                <input type="hidden" id="EditId">

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Masalah Pokok</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="EditMasalahPokok">
                            <option value="">-- Pilih Masalah Pokok --</option>
                            <?php foreach ($MasalahPokok as $mp) { ?>
                              <option value="<?= (int)$mp['Id'] ?>">
                                <?= htmlspecialchars($mp['NamaPermasalahanPokok'], ENT_QUOTES, 'UTF-8') ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Masalah</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="EditMasalah" rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Penyebab Masalah</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="EditPenyebabMasalah" rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Faktor Internal</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="EditFaktorInternal" rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Faktor External</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="EditFaktorExternal" rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Akar Masalah</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="EditAkarMasalah" rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                      <button class="btn btn-success notika-btn-success" id="BtnUpdate"><b>UPDATE</b></button>
                      <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
  var BaseURL = '<?= base_url() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';
  var IS_ROLE_4 = '<?= $IsRole4 ?>';
  var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
  var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
  var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

  jQuery(document).ready(function($){
    
    // Inisialisasi DataTable - tanpa sorting, dengan pagination berjarak
    if ($('#data-table-permasalahan').length > 0) {
      try {
        if ($.fn.DataTable.isDataTable('#data-table-permasalahan')) {
          $('#data-table-permasalahan').DataTable().destroy();
        }
       $('#data-table-permasalahan').DataTable({
  "pageLength": 10,
  "ordering": false,  // <----- DITAMBAHKAN (menonaktifkan sorting)
  "language": {
    "emptyTable": "Tidak ada data",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
    "infoEmpty": "Tidak ada data",
    "paginate": {      // <----- DITAMBAHKAN (terjemahan tombol)
      "first": "Pertama",
      "last": "Terakhir",
      "next": "Berikutnya",
      "previous": "Sebelumnya"
    }
  },
  // <----- DITAMBAHKAN (memberi jarak antar tombol pagination)
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

    // =========================
    // FILTER WILAYAH SEBELUM LOGIN
    // =========================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

      // Ketika Provinsi berubah, load Kab/Kota
      $("#Provinsi").change(function() {
        var provinsiKode = $(this).val();
        console.log("Provinsi dipilih:", provinsiKode);
        
        if (provinsiKode === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
          $("#FilterInstansiGroup").hide();
          $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
          return;
        }

        console.log("Mengirim AJAX ke:", BaseURL + "Instansi/GetListKabKota");
        
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
            console.log("Data Kab/Kota diterima:", Data);
            console.log("Jumlah data:", Data ? Data.length : 0);
            
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
              }
            } else {
              KabKota = '<option value="">Tidak ada data untuk provinsi ini</option>';
            }
            
            $("#KabKota").html(KabKota).prop('disabled', false);
            $("#FilterInstansiGroup").hide();
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error - Status:", status);
            console.error("AJAX Error - Error:", error);
            console.error("AJAX Error - Response:", xhr.responseText);
            alert("Gagal memuat data Kab/Kota. Lihat console (F12)");
            $("#KabKota").html('<option value="">Error memuat data</option>').prop('disabled', false);
          }
        });
      });

      // Ketika Kab/Kota berubah, load Instansi Level 4
      $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        console.log("Kab/Kota dipilih:", kabKotaKode);
        
        if (kabKotaKode === "") {
          $("#FilterInstansiGroup").hide();
          $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
          return;
        }

        console.log("Mengirim AJAX ke:", BaseURL + "Instansi/GetListInstansiLevel4");
        
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
            console.log("Data Instansi diterima:", Data);
            console.log("Jumlah instansi:", Data ? Data.length : 0);
            
            var options = '<option value="">-- Semua Instansi --</option>';
            
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
                options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
              }
            } else {
              options = '<option value="">-- Tidak Ada Instansi --</option>';
            }
            
            $("#FilterInstansiBeforeLogin").html(options);
            $("#FilterInstansiGroup").show();
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error - Status:", status);
            console.error("AJAX Error - Error:", error);
            alert("Gagal memuat data Instansi. Lihat console (F12)");
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Gagal Memuat --</option>');
          }
        });
      });

      // Tombol Filter
      $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") {
          alert("Mohon Pilih Provinsi");
          return;
        }
        if ($("#KabKota").val() === "") {
          alert("Mohon Pilih Kab/Kota");
          return;
        }

        var kodeWilayah = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        console.log("Filter - Kode Wilayah:", kodeWilayah);
        console.log("Filter - Instansi ID:", instansiId);
        
        $.ajax({
          url: BaseURL + "Instansi/SetTempKodeWilayah",
          type: "POST",
          data: { 
            KodeWilayah: kodeWilayah, 
            [CSRF_NAME]: CSRF_TOKEN 
          },
          beforeSend: function() { 
            $("#Filter").prop('disabled', true).text('Memuat...'); 
          },
          success: function(res) {
            console.log("SetTempKodeWilayah response:", res);
            if (res === '1') {
              var redirectUrl = BaseURL + "Instansi/PermasalahanPD";
              if (instansiId && instansiId != '') {
                redirectUrl += "?instansi_id=" + instansiId;
              }
              window.location.href = redirectUrl;
            } else {
              alert(res || "Gagal menyimpan filter wilayah!");
              $("#Filter").prop('disabled', false).text('Filter');
            }
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            alert("Gagal menghubungi server!");
            $("#Filter").prop('disabled', false).text('Filter');
          }
        });
      });

      // Jika sudah ada KodeWilayah dari session (setelah filter sebelumnya)
      <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        console.log("Mengisi filter dari session - Prov:", kodeProv, "Kab:", kodeKab);
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
        var url = BaseURL + "Instansi/PermasalahanPD";
        
        if (instansiId && instansiId != '') {
          url += "?instansi_id=" + instansiId;
        }
        
        window.location.href = url;
      });
      
      $("#ResetFilterBtn").click(function() {
        window.location.href = BaseURL + "Instansi/PermasalahanPD";
      });
      
    <?php } ?>

    // =========================
    // TAMBAH DATA (HANYA ROLE 4)
    // =========================
    <?php if ($IsRole4) { ?>
    $("#BtnSimpan").click(function(){
      var masalah = $("#Masalah").val().trim();
      if(!masalah){
        alert('Masalah harus diisi!');
        return;
      }

      $.ajax({
        url: BaseURL + "Instansi/InputPermasalahanPD",
        type: "POST",
        data: {
          masalah: masalah,
          masalah_pokok: $("#MasalahPokok").val(),
          penyebab_masalah: $("#PenyebabMasalah").val().trim(),
          faktor_internal: $("#FaktorInternal").val().trim(),
          faktor_external: $("#FaktorExternal").val().trim(),
          akar_masalah: $("#AkarMasalah").val().trim(),
          [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res){
          if(res == '1'){
            window.location.reload();
          } else {
            alert(res);
          }
        },
        error: function(){
          alert('Gagal request (Tambah Permasalahan)');
        }
      });
    });

    // EDIT DATA
    $(document).on("click", ".BtnEdit", function(){
      $("#EditId").val($(this).data('id'));
      $("#EditMasalah").val($(this).data('masalah'));
      $("#EditMasalahPokok").val($(this).data('masalah_pokok'));
      $("#EditPenyebabMasalah").val($(this).data('penyebab_masalah'));
      $("#EditFaktorInternal").val($(this).data('faktor_internal'));
      $("#EditFaktorExternal").val($(this).data('faktor_external'));
      $("#EditAkarMasalah").val($(this).data('akar_masalah'));
      $("#ModalEditPermasalahanPD").modal("show");
    });

    // UPDATE DATA
    $("#BtnUpdate").click(function(){
      var id = $("#EditId").val();
      var masalah = $("#EditMasalah").val().trim();

      if(!id){
        alert('ID tidak valid!');
        return;
      }
      if(!masalah){
        alert('Masalah harus diisi!');
        return;
      }

      $.ajax({
        url: BaseURL + "Instansi/EditPermasalahanPD",
        type: "POST",
        data: {
          id: id,
          masalah: masalah,
          masalah_pokok: $("#EditMasalahPokok").val().trim(),
          penyebab_masalah: $("#EditPenyebabMasalah").val().trim(),
          faktor_internal: $("#EditFaktorInternal").val().trim(),
          faktor_external: $("#EditFaktorExternal").val().trim(),
          akar_masalah: $("#EditAkarMasalah").val().trim(),
          [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res){
          if(res == '1'){
            window.location.reload();
          } else {
            alert(res);
          }
        },
        error: function(){
          alert('Gagal request (Edit Permasalahan)');
        }
      });
    });

    // HAPUS DATA
    $(document).on("click", ".BtnHapus", function(){
      var id = $(this).data('id');
      if(!id){
        alert('ID tidak valid!');
        return;
      }

      if(!confirm('Yakin hapus permasalahan ini?')){
        return;
      }

      $.ajax({
        url: BaseURL + "Instansi/HapusPermasalahanPD",
        type: "POST",
        data: {
          id: id,
          [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res){
          if(res == '1'){
            window.location.reload();
          } else {
            alert(res);
          }
        },
        error: function(){
          alert('Gagal request (Hapus Permasalahan)');
        }
      });
    });
    <?php } ?>

  });
</script>

</body>
</html>