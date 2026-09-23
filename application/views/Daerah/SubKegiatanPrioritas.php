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
            <?php
              // Grouping Data berdasarkan id_instansi, program_prioritas, dan outcome
              $GroupedData = [];
              if (!empty($Data)) {
                  foreach ($Data as $row) {
                      $instansiKey = $row['id_instansi'] ?? 0;
                      $progKey     = trim($row['program_prioritas'] ?? '');
                      $outcomeKey  = trim($row['outcome'] ?? '');
                      $key         = md5($instansiKey . '||' . $progKey . '||' . $outcomeKey);

                      if (!isset($GroupedData[$key])) {
                          $GroupedData[$key] = [
                              'key'               => $key,
                              'id_instansi'       => $row['id_instansi'] ?? null,
                              'program_prioritas' => $row['program_prioritas'] ?? '',
                              'outcome'           => $row['outcome'] ?? '',
                              'keterangan'        => $row['keterangan'] ?? '',
                              'items'             => [],
                              'ids'               => []
                          ];
                      }

                      $GroupedData[$key]['items'][] = [
                          'id'           => $row['id'],
                          'kegiatan'     => $row['kegiatan'] ?? '',
                          'sub_kegiatan' => $row['sub_kegiatan'] ?? '',
                          'keterangan'   => $row['keterangan'] ?? ''
                      ];
                      $GroupedData[$key]['ids'][] = (int)$row['id'];
                  }
              }
            ?>
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-bordered" style="vertical-align: middle;">
                <thead>
                  <tr style="background: #f8fafc;">
                    <th class="text-center" style="width: 50px; vertical-align: middle;">No</th>
                    <th style="width: 22%; vertical-align: middle;">Program Prioritas</th>
                    <th style="width: 25%; vertical-align: middle;">Outcome</th>
                    <th style="vertical-align: middle;">Kegiatan / Sub Kegiatan</th>
                    <th style="width: 12%; vertical-align: middle;">Keterangan</th>
                    <?php if ($IsRole4) { ?>
                    <th class="text-center" style="width: 100px; vertical-align: middle;">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($GroupedData)) { ?>
                    <?php $no = 1; foreach ($GroupedData as $group) { 
                      $itemsJson = htmlspecialchars(json_encode($group['items']), ENT_QUOTES, 'UTF-8');
                      $idsStr    = implode(',', $group['ids']);
                    ?>
                      <tr>
                        <td class="text-center" style="vertical-align: top; font-weight: bold;"><?= $no++ ?></td>
                        <td style="vertical-align: top; font-weight: 600; color: #1e293b;">
                          <?= html_escape($group['program_prioritas']) ?>
                        </td>
                        <td style="vertical-align: top; line-height: 1.6; white-space: pre-line;">
                          <?php
                            $outcomeText = trim($group['outcome'] ?? '');
                            $formattedOutcome = preg_replace('/(?<!^)\s+(\d+[\.\)])/', "\n$1", $outcomeText);
                            echo nl2br(html_escape($formattedOutcome));
                          ?>
                        </td>
                        <td style="vertical-align: top; line-height: 1.6;">
                          <?php foreach ($group['items'] as $idx => $item) { ?>
                            <div style="<?= $idx > 0 ? 'margin-top: 12px; padding-top: 10px; border-top: 1px dashed #cbd5e1;' : '' ?>">
                              <b>Kegiatan:</b><br>
                              <?= !empty($item['kegiatan']) ? nl2br(html_escape($item['kegiatan'])) : '-' ?>
                              <br><br>
                              <b>Sub Kegiatan:</b><br>
                              <?= !empty($item['sub_kegiatan']) ? nl2br(html_escape($item['sub_kegiatan'])) : '-' ?>
                            </div>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: top;"><?= html_escape($group['keterangan']) ?></td>
                        <?php if ($IsRole4) { ?>
                          <td class="text-center" style="vertical-align: top;">
                            <?php if ($InstansiId == ($group['id_instansi'] ?? null)) { ?>
                              <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                                <button
                                  class="btn btn-warning btn-xs BtnEdit"
                                  data-id="<?= $group['ids'][0] ?>"
                                  data-ids="<?= $idsStr ?>"
                                  data-program="<?= html_escape($group['program_prioritas']) ?>"
                                  data-outcome="<?= html_escape($group['outcome']) ?>"
                                  data-ket="<?= html_escape($group['keterangan']) ?>"
                                  data-items='<?= $itemsJson ?>'
                                  title="Edit"
                                  style="padding: 4px 8px;">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button
                                  class="btn btn-danger btn-xs BtnHapusGroup"
                                  data-ids="<?= $idsStr ?>"
                                  title="Hapus"
                                  style="padding: 4px 8px;">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </div>
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
    <div class="modal-dialog modal-lg" style="top:5%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Tambah Kegiatan / Sub Kegiatan Prioritas</b></h4>
        </div>
        <div class="modal-body">
          <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
            <div class="alert alert-info" style="margin-bottom: 15px;">
              <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
            </div>
          <?php } ?>

          <!-- PROGRAM PRIORITAS DARI RENSTRA -->
          <div class="form-group">
            <label><b>Program Prioritas (dari Renstra)</b> <span class="text-danger">*</span></label>
            <select id="SelectProgram" class="form-control">
              <option value="">-- Pilih Program dari Renstra --</option>
              <?php if (!empty($ListProgramRenstra)) { ?>
                <?php foreach ($ListProgramRenstra as $prog) { 
                  $displayProg = (!empty($prog['kode_program']) ? $prog['kode_program'] . ' - ' : '') . $prog['nama'];
                ?>
                  <option value="<?= $prog['id'] ?>" data-nama="<?= html_escape($prog['nama']) ?>" data-kode="<?= html_escape($prog['kode_program']) ?>" data-display="<?= html_escape($displayProg) ?>">
                    <?= html_escape($displayProg) ?>
                  </option>
                <?php } ?>
              <?php } else { ?>
                <option value="" disabled>(Belum ada data Program di Renstra)</option>
              <?php } ?>
            </select>
          </div>

          <!-- OUTCOME RENSTRA (OTOMATIS) -->
          <div class="form-group">
            <label><b>Outcome Program</b> <span class="text-danger">*</span> <small class="text-muted" style="font-weight:normal;">(Otomatis terisi dari Renstra)</small></label>
            <textarea id="Outcome" class="form-control" rows="4" placeholder="Pilih Program di atas untuk memuat Outcome..." readonly style="background-color:#f9f9f9; line-height:1.6; white-space:pre-wrap;"></textarea>
          </div>

          <!-- BAGIAN KEGIATAN & SUB KEGIATAN (REPEATER GABUNG) -->
          <div class="form-group" style="margin-top: 20px; margin-bottom: 5px;">
            <label><b>Kegiatan & Sub Kegiatan (dari Renstra)</b> <span class="text-danger">*</span></label>
            <div id="RepeaterKegiatanContainer">
              <!-- Item Repeater -->
            </div>
            <button type="button" class="btn btn-info btn-xs" id="BtnAddRepeaterItem" disabled style="margin-top: 4px; margin-bottom: 15px;">
              <i class="fa fa-plus"></i> <b>Tambah Kegiatan / Sub Kegiatan</b>
            </button>
          </div>

          <!-- KETERANGAN -->
          <div class="form-group">
            <label><b>Keterangan</b> <small class="text-muted">(Opsional)</small></label>
            <textarea id="Keterangan" class="form-control" rows="2" placeholder="Keterangan tambahan..."></textarea>
          </div>

          <div class="text-right" style="margin-top: 20px;">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <b>BATAL</b>
            </button>
            <button class="btn btn-success" id="BtnSimpan">
              <i class="fa fa-save"></i> <b>SIMPAN SEMUA</b>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT ================= -->
  <div class="modal fade" id="ModalEditData">
    <div class="modal-dialog modal-lg" style="top:5%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit Kegiatan / Sub Kegiatan Prioritas</b></h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="EditId">
          <input type="hidden" id="EditIds">

          <!-- PROGRAM PRIORITAS DARI RENSTRA -->
          <div class="form-group">
            <label><b>Program Prioritas (dari Renstra)</b> <span class="text-danger">*</span></label>
            <select id="EditSelectProgram" class="form-control">
              <option value="">-- Pilih Program dari Renstra --</option>
              <?php if (!empty($ListProgramRenstra)) { ?>
                <?php foreach ($ListProgramRenstra as $prog) { 
                  $displayProg = (!empty($prog['kode_program']) ? $prog['kode_program'] . ' - ' : '') . $prog['nama'];
                ?>
                  <option value="<?= $prog['id'] ?>" data-nama="<?= html_escape($prog['nama']) ?>" data-kode="<?= html_escape($prog['kode_program']) ?>" data-display="<?= html_escape($displayProg) ?>">
                    <?= html_escape($displayProg) ?>
                  </option>
                <?php } ?>
              <?php } else { ?>
                <option value="" disabled>(Belum ada data Program di Renstra)</option>
              <?php } ?>
            </select>
          </div>

          <!-- OUTCOME RENSTRA (OTOMATIS) -->
          <div class="form-group">
            <label><b>Outcome Program</b> <span class="text-danger">*</span> <small class="text-muted" style="font-weight:normal;">(Otomatis terisi dari Renstra)</small></label>
            <textarea id="EditOutcome" class="form-control" rows="4" placeholder="Pilih Program di atas untuk memuat Outcome..." readonly style="background-color:#f9f9f9; line-height:1.6; white-space:pre-wrap;"></textarea>
          </div>

          <!-- BAGIAN KEGIATAN & SUB KEGIATAN (EDIT REPEATER GABUNG) -->
          <div class="form-group" style="margin-top: 20px; margin-bottom: 5px;">
            <label><b>Kegiatan & Sub Kegiatan (dari Renstra)</b> <span class="text-danger">*</span></label>
            <div id="EditRepeaterKegiatanContainer">
              <!-- Item Repeater Edit -->
            </div>
            <button type="button" class="btn btn-info btn-xs" id="BtnEditAddRepeaterItem" disabled style="margin-top: 4px; margin-bottom: 15px;">
              <i class="fa fa-plus"></i> <b>Tambah Kegiatan / Sub Kegiatan</b>
            </button>
          </div>

          <!-- KETERANGAN -->
          <div class="form-group">
            <label><b>Keterangan</b> <small class="text-muted">(Opsional)</small></label>
            <textarea id="EditKeterangan" class="form-control" rows="2" placeholder="Keterangan tambahan..."></textarea>
          </div>

          <div class="text-right" style="margin-top: 20px;">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <b>BATAL</b>
            </button>
            <button class="btn btn-success" id="BtnUpdate">
              <i class="fa fa-save"></i> <b>SIMPAN PERUBAHAN</b>
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

  /* ===== HELPER BUILDER DROPDOWN RENSTRA ===== */
  function buildKegiatanOptionsHtml(kegiatans) {
    if (!kegiatans || kegiatans.length === 0) {
      return '<option value="" disabled>(Tidak ada Kegiatan di Renstra untuk Program ini)</option>';
    }
    var html = '<option value="">-- Pilih Kegiatan dari Renstra --</option>';
    $.each(kegiatans, function(i, keg) {
      var disp = (keg.kode_nomenklatur ? keg.kode_nomenklatur + ' - ' : '') + keg.nama;
      html += '<option value="' + keg.id + '" data-kode="' + (keg.kode_nomenklatur || '') + '" data-nama="' + (keg.nama || '') + '" data-display="' + disp + '">' + disp + '</option>';
    });
    return html;
  }

  function populateSubKegiatanSelect($subSelect, kegId, allSubKegiatans, selectedSubTextOrId) {
    if (!kegId) {
      $subSelect.html('<option value="">-- Pilih Kegiatan di atas terlebih dahulu --</option>').prop('disabled', true);
      return;
    }

    var subs = (allSubKegiatans || []).filter(function(s){ return String(s.kegiatan_id) === String(kegId); });
    if (subs.length === 0) {
      $subSelect.html('<option value="" disabled>(Tidak ada Sub Kegiatan di Renstra untuk Kegiatan ini)</option>').prop('disabled', true);
      return;
    }

    var html = '<option value="">-- Pilih Sub Kegiatan dari Renstra --</option>';
    var matchedVal = '';

    $.each(subs, function(i, s) {
      var disp = (s.kode_nomenklatur ? s.kode_nomenklatur + ' - ' : '') + s.nama;
      var isMatch = false;
      if (selectedSubTextOrId) {
        var targetStr = String(selectedSubTextOrId).trim();
        if (String(s.id) === targetStr || disp.trim() === targetStr || (s.nama || '').trim() === targetStr) {
          isMatch = true;
          matchedVal = s.id;
        }
      }
      var kegFullName = (s.kegiatan_kode ? s.kegiatan_kode + ' - ' : '') + (s.kegiatan_nama || '');
      html += '<option value="' + s.id + '" data-kode="' + (s.kode_nomenklatur || '') + '" data-nama="' + (s.nama || '') + '" data-display="' + disp + '" data-kegiatan="' + kegFullName + '" ' + (isMatch ? 'selected' : '') + '>' + disp + '</option>';
    });

    $subSelect.html(html).prop('disabled', false);
    if (matchedVal) {
      $subSelect.val(matchedVal);
    }
  }

  /* ===== TEMPLATE ITEM REPEATER (KEGIATAN & SUB KEGIATAN ATAS-BAWAH) ===== */
  function createRepeaterItemHtml(itemNumber, kegOptionsHtml) {
    return '<div class="repeater-item panel panel-default" style="margin-bottom: 12px; border: 1px solid #dcdcdc; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">' +
      '<div class="panel-heading" style="padding: 7px 12px; background: #f8f9fa; display: flex; justify-content: space-between; align-items: center;">' +
        '<span class="item-title" style="font-weight: bold; color: #333;"><i class="fa fa-list-check"></i> Kegiatan & Sub Kegiatan #' + itemNumber + '</span>' +
        '<button type="button" class="btn btn-xs btn-danger btn-remove-item" style="' + (itemNumber > 1 ? '' : 'display:none;') + '" title="Hapus"><i class="fa fa-trash"></i> Hapus</button>' +
      '</div>' +
      '<div class="panel-body" style="padding: 12px;">' +
        '<div class="form-group" style="margin-bottom: 10px;">' +
          '<label style="font-size: 13px;"><b>Kegiatan</b> <span class="text-danger">*</span></label>' +
          '<select class="form-control select-kegiatan">' +
            kegOptionsHtml +
          '</select>' +
        '</div>' +
        '<div class="form-group" style="margin-bottom: 0;">' +
          '<label style="font-size: 13px;"><b>Sub Kegiatan</b> <span class="text-danger">*</span></label>' +
          '<select class="form-control select-subkegiatan" disabled>' +
            '<option value="">-- Pilih Kegiatan di atas terlebih dahulu --</option>' +
          '</select>' +
        '</div>' +
      '</div>' +
    '</div>';
  }

  function updateRepeaterIndexes() {
    var items = $("#RepeaterKegiatanContainer .repeater-item");
    var total = items.length;
    items.each(function(index) {
      var num = index + 1;
      $(this).find('.item-title').html('<i class="fa fa-list-check"></i> Kegiatan & Sub Kegiatan #' + num);
      if (total > 1) {
        $(this).find('.btn-remove-item').show();
      } else {
        $(this).find('.btn-remove-item').hide();
      }
    });
  }

  function createEditRepeaterItemHtml(itemNumber, kegOptionsHtml) {
    return '<div class="edit-repeater-item panel panel-default" style="margin-bottom: 12px; border: 1px solid #dcdcdc; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">' +
      '<div class="panel-heading" style="padding: 7px 12px; background: #f8f9fa; display: flex; justify-content: space-between; align-items: center;">' +
        '<span class="edit-item-title" style="font-weight: bold; color: #333;"><i class="fa fa-list-check"></i> Kegiatan & Sub Kegiatan #' + itemNumber + '</span>' +
        '<button type="button" class="btn btn-xs btn-danger btn-edit-remove-item" style="' + (itemNumber > 1 ? '' : 'display:none;') + '" title="Hapus"><i class="fa fa-trash"></i> Hapus</button>' +
      '</div>' +
      '<div class="panel-body" style="padding: 12px;">' +
        '<div class="form-group" style="margin-bottom: 10px;">' +
          '<label style="font-size: 13px;"><b>Kegiatan</b> <span class="text-danger">*</span></label>' +
          '<select class="form-control edit-select-kegiatan">' +
            kegOptionsHtml +
          '</select>' +
        '</div>' +
        '<div class="form-group" style="margin-bottom: 0;">' +
          '<label style="font-size: 13px;"><b>Sub Kegiatan</b> <span class="text-danger">*</span></label>' +
          '<select class="form-control edit-select-subkegiatan" disabled>' +
            '<option value="">-- Pilih Kegiatan di atas terlebih dahulu --</option>' +
          '</select>' +
        '</div>' +
      '</div>' +
    '</div>';
  }

  function updateEditRepeaterIndexes() {
    var items = $("#EditRepeaterKegiatanContainer .edit-repeater-item");
    var total = items.length;
    items.each(function(index) {
      var num = index + 1;
      $(this).find('.edit-item-title').html('<i class="fa fa-list-check"></i> Kegiatan & Sub Kegiatan #' + num);
      if (total > 1) {
        $(this).find('.btn-edit-remove-item').show();
      } else {
        $(this).find('.btn-edit-remove-item').hide();
      }
    });
  }

  /* ===== EVENT HANDLER MODAL TAMBAH ===== */
  var addDataState = { kegiatans: [], all_sub_kegiatans: [] };
  var addKegOptionsHtml = '';

  $('#ModalInputData').on('show.bs.modal', function () {
    $("#SelectProgram").val('');
    $("#Outcome").val('');
    $("#Keterangan").val('');
    addDataState = { kegiatans: [], all_sub_kegiatans: [] };
    addKegOptionsHtml = '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>';
    $("#RepeaterKegiatanContainer").html(createRepeaterItemHtml(1, addKegOptionsHtml));
    $("#RepeaterKegiatanContainer .select-kegiatan").prop('disabled', true);
    $("#BtnAddRepeaterItem").prop('disabled', true);
    updateRepeaterIndexes();
  });

  $("#SelectProgram").change(function(){
    var val = $(this).val();
    addDataState = { kegiatans: [], all_sub_kegiatans: [] };

    if (!val) {
      $("#Outcome").val('');
      addKegOptionsHtml = '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>';
      $("#RepeaterKegiatanContainer").html(createRepeaterItemHtml(1, addKegOptionsHtml));
      $("#RepeaterKegiatanContainer .select-kegiatan").prop('disabled', true);
      $("#BtnAddRepeaterItem").prop('disabled', true);
      updateRepeaterIndexes();
      return;
    }

    $("#Outcome").val('Memuat outcome dari Renstra...');
    $("#BtnAddRepeaterItem").prop('disabled', true);
    $("#RepeaterKegiatanContainer").html('<div class="text-center" style="padding:15px; color:#666;"><i class="fa fa-spinner fa-spin fa-2x"></i><br><small>Memuat kegiatan dari Renstra...</small></div>');

    $.ajax({
      url: BaseURL + "Instansi/GetRenstraProgramDetailForPrioritas",
      type: "POST",
      data: { program_id: val, [CSRF_NAME]: CSRF_TOKEN },
      dataType: "json",
      success: function(res) {
        if (res.status === 'success') {
          $("#Outcome").val(res.outcome_str || '-');
          addDataState = res;
          addKegOptionsHtml = buildKegiatanOptionsHtml(res.kegiatans);

          if (res.kegiatans && res.kegiatans.length > 0) {
            $("#RepeaterKegiatanContainer").html(createRepeaterItemHtml(1, addKegOptionsHtml));
            $("#BtnAddRepeaterItem").prop('disabled', false);
          } else {
            $("#RepeaterKegiatanContainer").html(createRepeaterItemHtml(1, addKegOptionsHtml));
            $("#RepeaterKegiatanContainer .select-kegiatan").prop('disabled', true);
            $("#BtnAddRepeaterItem").prop('disabled', true);
          }
          updateRepeaterIndexes();
        } else {
          alert(res.message || "Gagal mengambil data Renstra");
          $("#Outcome").val('');
          $("#RepeaterKegiatanContainer").html(createRepeaterItemHtml(1, '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>'));
          updateRepeaterIndexes();
        }
      },
      error: function() {
        alert("Gagal menghubungi server untuk memuat detail Renstra!");
        $("#Outcome").val('');
        $("#RepeaterKegiatanContainer").html(createRepeaterItemHtml(1, '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>'));
        updateRepeaterIndexes();
      }
    });
  });

  // Pilih Kegiatan di Tambah: dropdown Sub Kegiatan pada baris yang sama otomatis terisi
  $(document).on("change", ".select-kegiatan", function(){
    var kegId = $(this).val();
    var $subSelect = $(this).closest(".repeater-item").find(".select-subkegiatan");
    populateSubKegiatanSelect($subSelect, kegId, addDataState.all_sub_kegiatans, '');
  });

  // Tambah baris repeater Tambah
  $("#BtnAddRepeaterItem").click(function(){
    var nextNum = $("#RepeaterKegiatanContainer .repeater-item").length + 1;
    $("#RepeaterKegiatanContainer").append(createRepeaterItemHtml(nextNum, addKegOptionsHtml));
    updateRepeaterIndexes();
  });

  // Hapus baris repeater Tambah
  $(document).on("click", ".btn-remove-item", function(){
    $(this).closest(".repeater-item").remove();
    updateRepeaterIndexes();
  });

  // SIMPAN TAMBAH (BATCH ITEMS)
  $("#BtnSimpan").click(function(){
    var progVal = $("#SelectProgram").val();
    if (!progVal) { alert("Silakan pilih Program Prioritas dari Renstra!"); return; }

    var program = $("#SelectProgram option:selected").data("display") || $("#SelectProgram option:selected").text().trim();
    var outcome = $("#Outcome").val().trim();
    var keterangan = $("#Keterangan").val();

    var items = [];
    var isValid = true;
    var errorMsg = "";

    $("#RepeaterKegiatanContainer .repeater-item").each(function(index){
      var rowNum = index + 1;
      var $keg = $(this).find('.select-kegiatan');
      var $sub = $(this).find('.select-subkegiatan');

      var kegVal = $keg.val();
      var subVal = $sub.val();

      if (!kegVal || !subVal) {
        isValid = false;
        errorMsg = "Mohon lengkapi Kegiatan dan Sub Kegiatan pada baris #" + rowNum + "!";
        return false;
      }

      var kegText = $keg.find('option:selected').data('display') || $keg.find('option:selected').text().trim();
      var subText = $sub.find('option:selected').data('display') || $sub.find('option:selected').text().trim();

      items.push({
        kegiatan: kegText,
        sub_kegiatan: subText
      });
    });

    if (!isValid) {
      alert(errorMsg);
      return;
    }

    if (items.length === 0) {
      alert("Minimal satu Kegiatan & Sub Kegiatan harus dipilih!");
      return;
    }

    var $btn = $(this);
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan ' + items.length + ' data...');

    $.ajax({
      url: BaseURL + "Instansi/InputSubKegiatanPrioritas",
      type: "POST",
      data: {
        program_prioritas: program,
        outcome: outcome,
        keterangan: keterangan,
        items: JSON.stringify(items),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") {
          window.location.reload();
        } else {
          alert(res);
          $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>SIMPAN SEMUA</b>');
        }
      },
      error: function() {
        alert("Gagal request ke server!");
        $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>SIMPAN SEMUA</b>');
      }
    });
  });

  /* ===== EVENT HANDLER MODAL EDIT ===== */
  var editDataState = { kegiatans: [], all_sub_kegiatans: [] };
  var editKegOptionsHtml = '';

  $(document).on("click", ".BtnEdit", function(){
    var curId = $(this).data("id");
    var curIds = ($(this).data("ids") || curId).toString();
    var curProgram = ($(this).data("program") || '').toString();
    var curOutcome = ($(this).data("outcome") || '').toString();
    var curKet = ($(this).data("ket") || '').toString();
    var curItems = $(this).data("items") || [];
    if (typeof curItems === 'string') {
      try { curItems = JSON.parse(curItems); } catch(e) { curItems = []; }
    }

    $("#EditId").val(curId);
    $("#EditIds").val(curIds);
    $("#EditOutcome").val(curOutcome);
    $("#EditKeterangan").val(curKet);
    editDataState = { kegiatans: [], all_sub_kegiatans: [] };
    editKegOptionsHtml = '';
    $("#BtnEditAddRepeaterItem").prop('disabled', true);

    // Cari kesesuaian Program dengan Renstra
    var matchedProgId = '';
    $("#EditSelectProgram option").each(function(){
      var optVal = $(this).val();
      if (optVal) {
        var optDisplay = ($(this).data('display') || $(this).text()).trim();
        var optNama = ($(this).data('nama') || '').trim();
        if (optDisplay === curProgram.trim() || optNama === curProgram.trim()) {
          matchedProgId = optVal;
          return false;
        }
      }
    });

    if (matchedProgId) {
      $("#EditSelectProgram").val(matchedProgId);
      $("#EditRepeaterKegiatanContainer").html('<div class="text-center" style="padding:15px; color:#666;"><i class="fa fa-spinner fa-spin fa-2x"></i><br><small>Memuat kegiatan dari Renstra...</small></div>');

      $.ajax({
        url: BaseURL + "Instansi/GetRenstraProgramDetailForPrioritas",
        type: "POST",
        data: { program_id: matchedProgId, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res) {
          if (res.status === 'success') {
            editDataState = res;
            editKegOptionsHtml = buildKegiatanOptionsHtml(res.kegiatans);

            if (res.kegiatans && res.kegiatans.length > 0) {
              $("#EditRepeaterKegiatanContainer").empty();

              if (curItems && curItems.length > 0) {
                $.each(curItems, function(idx, item) {
                  var itemNum = idx + 1;
                  var $card = $(createEditRepeaterItemHtml(itemNum, editKegOptionsHtml));

                  // Cari kegiatan yang cocok
                  var kegText = (item.kegiatan || '').trim();
                  var matchedKegId = '';
                  $.each(res.kegiatans, function(kIdx, keg) {
                    var disp = (keg.kode_nomenklatur ? keg.kode_nomenklatur + ' - ' : '') + keg.nama;
                    if (kegText === disp.trim() || kegText === (keg.nama || '').trim()) {
                      matchedKegId = keg.id;
                      return false;
                    }
                  });

                  if (matchedKegId) {
                    $card.find('.edit-select-kegiatan').val(matchedKegId);
                    populateSubKegiatanSelect($card.find('.edit-select-subkegiatan'), matchedKegId, res.all_sub_kegiatans, item.sub_kegiatan);
                  }

                  $("#EditRepeaterKegiatanContainer").append($card);
                });
              } else {
                $("#EditRepeaterKegiatanContainer").append(createEditRepeaterItemHtml(1, editKegOptionsHtml));
              }

              $("#BtnEditAddRepeaterItem").prop('disabled', false);
              updateEditRepeaterIndexes();
            } else {
              $("#EditRepeaterKegiatanContainer").html(createEditRepeaterItemHtml(1, editKegOptionsHtml));
              $("#EditRepeaterKegiatanContainer .edit-select-kegiatan").prop('disabled', true);
              $("#BtnEditAddRepeaterItem").prop('disabled', true);
              updateEditRepeaterIndexes();
            }
          }
        }
      });
    } else {
      $("#EditSelectProgram").val('');
      $("#EditRepeaterKegiatanContainer").html(createEditRepeaterItemHtml(1, '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>'));
      $("#EditRepeaterKegiatanContainer .edit-select-kegiatan").prop('disabled', true);
      $("#BtnEditAddRepeaterItem").prop('disabled', true);
      updateEditRepeaterIndexes();
    }

    $("#ModalEditData").modal("show");
  });

  $("#EditSelectProgram").change(function(){
    var val = $(this).val();
    editDataState = { kegiatans: [], all_sub_kegiatans: [] };

    if (!val) {
      $("#EditOutcome").val('');
      editKegOptionsHtml = '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>';
      $("#EditRepeaterKegiatanContainer").html(createEditRepeaterItemHtml(1, editKegOptionsHtml));
      $("#EditRepeaterKegiatanContainer .edit-select-kegiatan").prop('disabled', true);
      $("#BtnEditAddRepeaterItem").prop('disabled', true);
      updateEditRepeaterIndexes();
      return;
    }

    $("#EditOutcome").val('Memuat outcome dari Renstra...');
    $("#BtnEditAddRepeaterItem").prop('disabled', true);
    $("#EditRepeaterKegiatanContainer").html('<div class="text-center" style="padding:15px; color:#666;"><i class="fa fa-spinner fa-spin fa-2x"></i><br><small>Memuat kegiatan dari Renstra...</small></div>');

    $.ajax({
      url: BaseURL + "Instansi/GetRenstraProgramDetailForPrioritas",
      type: "POST",
      data: { program_id: val, [CSRF_NAME]: CSRF_TOKEN },
      dataType: "json",
      success: function(res) {
        if (res.status === 'success') {
          $("#EditOutcome").val(res.outcome_str || '-');
          editDataState = res;
          editKegOptionsHtml = buildKegiatanOptionsHtml(res.kegiatans);

          if (res.kegiatans && res.kegiatans.length > 0) {
            $("#EditRepeaterKegiatanContainer").html(createEditRepeaterItemHtml(1, editKegOptionsHtml));
            $("#BtnEditAddRepeaterItem").prop('disabled', false);
          } else {
            $("#EditRepeaterKegiatanContainer").html(createEditRepeaterItemHtml(1, editKegOptionsHtml));
            $("#EditRepeaterKegiatanContainer .edit-select-kegiatan").prop('disabled', true);
            $("#BtnEditAddRepeaterItem").prop('disabled', true);
          }
          updateEditRepeaterIndexes();
        } else {
          alert(res.message || "Gagal mengambil data Renstra");
          $("#EditOutcome").val('');
          $("#EditRepeaterKegiatanContainer").html(createEditRepeaterItemHtml(1, '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>'));
          updateEditRepeaterIndexes();
        }
      },
      error: function() {
        alert("Gagal menghubungi server untuk memuat detail Renstra!");
        $("#EditOutcome").val('');
        $("#EditRepeaterKegiatanContainer").html(createEditRepeaterItemHtml(1, '<option value="">-- Pilih Program Renstra terlebih dahulu --</option>'));
        updateEditRepeaterIndexes();
      }
    });
  });

  // Pilih Kegiatan di Edit
  $(document).on("change", ".edit-select-kegiatan", function(){
    var kegId = $(this).val();
    var $subSelect = $(this).closest(".edit-repeater-item").find(".edit-select-subkegiatan");
    populateSubKegiatanSelect($subSelect, kegId, editDataState.all_sub_kegiatans, '');
  });

  // Tambah baris repeater Edit
  $("#BtnEditAddRepeaterItem").click(function(){
    var nextNum = $("#EditRepeaterKegiatanContainer .edit-repeater-item").length + 1;
    $("#EditRepeaterKegiatanContainer").append(createEditRepeaterItemHtml(nextNum, editKegOptionsHtml));
    updateEditRepeaterIndexes();
  });

  // Hapus baris repeater Edit
  $(document).on("click", ".btn-edit-remove-item", function(){
    $(this).closest(".edit-repeater-item").remove();
    updateEditRepeaterIndexes();
  });

  // SIMPAN PERUBAHAN EDIT (BATCH ITEMS)
  $("#BtnUpdate").click(function(){
    var progVal = $("#EditSelectProgram").val();
    if (!progVal) { alert("Silakan pilih Program Prioritas dari Renstra!"); return; }

    var program = $("#EditSelectProgram option:selected").data("display") || $("#EditSelectProgram option:selected").text().trim();
    var outcome = $("#EditOutcome").val().trim();
    var keterangan = $("#EditKeterangan").val();

    var items = [];
    var isValid = true;
    var errorMsg = "";

    $("#EditRepeaterKegiatanContainer .edit-repeater-item").each(function(index){
      var rowNum = index + 1;
      var $keg = $(this).find('.edit-select-kegiatan');
      var $sub = $(this).find('.edit-select-subkegiatan');

      var kegVal = $keg.val();
      var subVal = $sub.val();

      if (!kegVal || !subVal) {
        isValid = false;
        errorMsg = "Mohon lengkapi Kegiatan dan Sub Kegiatan pada baris #" + rowNum + "!";
        return false;
      }

      var kegText = $keg.find('option:selected').data('display') || $keg.find('option:selected').text().trim();
      var subText = $sub.find('option:selected').data('display') || $sub.find('option:selected').text().trim();

      items.push({
        kegiatan: kegText,
        sub_kegiatan: subText
      });
    });

    if (!isValid) {
      alert(errorMsg);
      return;
    }

    if (items.length === 0) {
      alert("Minimal satu Kegiatan & Sub Kegiatan harus dipilih!");
      return;
    }

    var $btn = $(this);
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan ' + items.length + ' data...');

    $.ajax({
      url: BaseURL + "Instansi/EditSubKegiatanPrioritas",
      type: "POST",
      data: {
        id: $("#EditId").val(),
        ids: $("#EditIds").val() || $("#EditId").val(),
        program_prioritas: program,
        outcome: outcome,
        keterangan: keterangan,
        items: JSON.stringify(items),
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res){
        if(res=="1") {
          window.location.reload();
        } else {
          alert(res);
          $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>SIMPAN PERUBAHAN</b>');
        }
      },
      error: function() {
        alert("Gagal request ke server!");
        $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>SIMPAN PERUBAHAN</b>');
      }
    });
  });

  // HAPUS SATUAN SUB KEGIATAN
  $(document).on("click", ".BtnHapus", function(){
    if(!confirm("Yakin hapus sub kegiatan ini?")) return;

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

  // HAPUS KESELURUHAN PROGRAM & KEGIATAN (GROUP)
  $(document).on("click", ".BtnHapusGroup", function(){
    if(!confirm("Yakin hapus program prioritas ini beserta seluruh kegiatan dan sub kegiatannya?")) return;

    $.ajax({
      url: BaseURL + "Instansi/HapusSubKegiatanPrioritas",
      type: "POST",
      data: {
        ids: $(this).data("ids"),
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