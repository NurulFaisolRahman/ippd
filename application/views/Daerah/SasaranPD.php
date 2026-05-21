<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* ========== UKURAN FONT TABEL SAJA ========== */
/* Judul tabel (th) - ukuran 12px dan BOLD */
#data-table-sasaran th {
    font-size: 12px;
    font-weight: bold;
}

/* Isi tabel (td) - ukuran 12px, normal (tidak bold) */
#data-table-sasaran td {
    font-size: 12px;
    font-weight: normal;
}

#data-table-sasaran {
    font-size: 12px;
}
</style>

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

                      <!-- FILTER INSTANSI -->
                      <div class="col-lg-3 col-md-6" id="FilterInstansiGroup" style="display: none;">
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
                  <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaranPD">
                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Sasaran PD</b>
                  </button>
                </div>
              </div>
              <br>
            <?php } ?>

            <div class="table-responsive">
              <table id="data-table-sasaran" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center" style="width:70px;">No</th>
                    <th>Sasaran Perangkat Daerah</th>
                    <th class="text-center" style="width:120px;">Tahun Mulai</th>
                    <th class="text-center" style="width:120px;">Tahun Akhir</th>
                    <?php if ($IsRole4) { ?>
                      <th class="text-center" style="width:120px;">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($SasaranPD)) { ?>
                    <?php $no = 1; foreach ($SasaranPD as $row) { ?>
                      <tr>
                        <td class="text-center" style="vertical-align: middle;"><?= $no++ ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($row['sasaran_pd'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center" style="vertical-align: middle;"><?= htmlspecialchars($row['tahun_mulai'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center" style="vertical-align: middle;"><?= htmlspecialchars($row['tahun_akhir'], ENT_QUOTES, 'UTF-8') ?></td>
                        <?php if ($IsRole4) { ?>
                          <td class="text-center" style="vertical-align: middle;">
                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                              <?php if ($InstansiId == ($row['id_instansi'] ?? null)) { ?>
                                <button
                                  class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg BtnEdit"
                                  data-id="<?= $row['id'] ?>"
                                  data-tujuan="<?= isset($row['tujuan_pd_id']) ? $row['tujuan_pd_id'] : '' ?>"
                                  data-sasaran="<?= htmlspecialchars($row['sasaran_pd'], ENT_QUOTES, 'UTF-8') ?>"
                                  data-tahunmulai="<?= htmlspecialchars($row['tahun_mulai'], ENT_QUOTES, 'UTF-8') ?>"
                                  data-tahunakhir="<?= htmlspecialchars($row['tahun_akhir'], ENT_QUOTES, 'UTF-8') ?>"
                                >
                                  <i class="notika-icon notika-edit"></i>
                                </button>

                                <button
                                  class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg BtnHapus"
                                  data-id="<?= $row['id'] ?>"
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
                      <td colspan="<?= $IsRole4 ? '5' : '4' ?>" class="text-center">Belum ada data Sasaran PD</td>
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

  <!-- Modal Input Sasaran PD -->
  <div class="modal fade" id="ModalInputSasaranPD" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Sasaran PD</h4>
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

                <!-- Tujuan PD (hanya menampilkan data milik instansi sendiri) -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tujuan PD</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="TujuanPD">
                            <option value="">-- Pilih Tujuan PD --</option>
                            <?php if (!empty($ListTujuanPD)) { ?>
                              <?php foreach ($ListTujuanPD as $t) { ?>
                                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
                              <?php } ?>
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
                        <label class="hrzn-fm"><b>Sasaran PD</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="SasaranPD" placeholder="Contoh: Meningkatkan kualitas layanan pendidikan">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Mulai</b></label>
                      </div>
                      <div class="col-lg-4">
                        <div class="nk-int-st">
                          <input type="number" class="form-control input-sm" id="TahunMulai" placeholder="2025">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Akhir</b></label>
                      </div>
                      <div class="col-lg-4">
                        <div class="nk-int-st">
                          <input type="number" class="form-control input-sm" id="TahunAkhir" placeholder="2029">
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

              </div><!-- /.form-example-wrap -->
            </div>
          </div>
        </div><!-- /.modal-body -->
      </div>
    </div>
  </div>

  <!-- Modal Edit Sasaran PD -->
  <div class="modal fade" id="ModalEditSasaranPD" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Sasaran PD</h4>
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
                        <label class="hrzn-fm"><b>Tujuan PD</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="EditTujuanPD">
                            <option value="">-- Pilih Tujuan PD --</option>
                            <?php if (!empty($ListTujuanPD)) { ?>
                              <?php foreach ($ListTujuanPD as $t) { ?>
                                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
                              <?php } ?>
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
                        <label class="hrzn-fm"><b>Sasaran PD</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="EditSasaranPD">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Mulai</b></label>
                      </div>
                      <div class="col-lg-4">
                        <div class="nk-int-st">
                          <input type="number" class="form-control input-sm" id="EditTahunMulai">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Akhir</b></label>
                      </div>
                      <div class="col-lg-4">
                        <div class="nk-int-st">
                          <input type="number" class="form-control input-sm" id="EditTahunAkhir">
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

              </div><!-- /.form-example-wrap -->
            </div>
          </div>
        </div><!-- /.modal-body -->
      </div>
    </div>
  </div>

</div><!-- /.main-content -->

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

    // Inisialisasi DataTable
    if ($('#data-table-sasaran').length > 0) {
      try {
        if ($.fn.DataTable.isDataTable('#data-table-sasaran')) {
          $('#data-table-sasaran').DataTable().destroy();
        }
        $('#data-table-sasaran').DataTable({
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
          }
        });
      } catch(e) {
        console.log("DataTable error:", e);
      }
    }

    // =========================
    // FILTER WILAYAH SEBELUM LOGIN
    // =========================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

      $("#Provinsi").change(function() {
        var provinsiKode = $(this).val();
        
        if (provinsiKode === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
          $("#FilterInstansiGroup").hide();
          return;
        }

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
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
              }
            }
            
            $("#KabKota").html(KabKota).prop('disabled', false);
          },
          error: function() {
            alert("Gagal memuat data Kab/Kota");
            $("#KabKota").html('<option value="">Error</option>').prop('disabled', false);
          }
        });
      });

      $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        
        if (kabKotaKode === "") {
          $("#FilterInstansiGroup").hide();
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
            $("#FilterInstansiGroup").show();
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
            $("#FilterInstansiGroup").show();
          },
          error: function() {
            alert("Gagal memuat data Instansi");
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Error --</option>');
          }
        });
      });

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
        
        $.ajax({
          url: BaseURL + "Instansi/SetTempKodeWilayah",
          type: "POST",
          data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
          success: function(res) {
            if (res === '1') {
              var redirectUrl = BaseURL + "Instansi/SasaranPD";
              if (instansiId && instansiId != '') {
                redirectUrl += "?instansi_id=" + instansiId;
              }
              window.location.href = redirectUrl;
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
        var url = BaseURL + "Instansi/SasaranPD";
        
        if (instansiId && instansiId != '') {
          url += "?instansi_id=" + instansiId;
        }
        
        window.location.href = url;
      });
      
      $("#ResetFilterBtn").click(function() {
        window.location.href = BaseURL + "Instansi/SasaranPD";
      });
      
    <?php } ?>

    // =========================
    // CRUD OPERATIONS (HANYA UNTUK ROLE 4)
    // =========================
    <?php if ($IsRole4) { ?>

    // Tambah
    $("#BtnSimpan").click(function(){
      var tujuan = $("#TujuanPD").val();
      var sasaran = $("#SasaranPD").val().trim();
      var mulai  = $("#TahunMulai").val().trim();
      var akhir  = $("#TahunAkhir").val().trim();

      if(!tujuan){ alert('Tujuan PD wajib dipilih!'); return; }
      if(!sasaran){ alert('Sasaran PD harus diisi!'); return; }
      if(!mulai){  alert('Tahun mulai harus diisi!'); return; }
      if(!akhir){  alert('Tahun akhir harus diisi!'); return; }

      if(parseInt(akhir) < parseInt(mulai)){
        alert('Tahun akhir tidak boleh lebih kecil dari tahun mulai!');
        return;
      }

      $.ajax({
        url: BaseURL + "Instansi/InputSasaranPD",
        type: "POST",
        data: {
          tujuan_pd_id: tujuan,
          sasaran_pd: sasaran,
          tahun_mulai: mulai,
          tahun_akhir: akhir,
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
          alert('Gagal request (Tambah Sasaran PD)');
        }
      });
    });

    // Buka modal edit
    $(document).on("click", ".BtnEdit", function(){
      $("#EditId").val($(this).data('id'));
      $("#EditTujuanPD").val($(this).data('tujuan'));
      $("#EditSasaranPD").val($(this).data('sasaran'));
      $("#EditTahunMulai").val($(this).data('tahunmulai'));
      $("#EditTahunAkhir").val($(this).data('tahunakhir'));
      $("#ModalEditSasaranPD").modal("show");
    });

    // Update
    $("#BtnUpdate").click(function(){
      var id     = $("#EditId").val();
      var tujuan = $("#EditTujuanPD").val();
      var sasaran = $("#EditSasaranPD").val().trim();
      var mulai  = $("#EditTahunMulai").val().trim();
      var akhir  = $("#EditTahunAkhir").val().trim();

      if(!id){     alert('ID tidak valid!'); return; }
      if(!tujuan){ alert('Tujuan PD wajib dipilih!'); return; }
      if(!sasaran){ alert('Sasaran PD harus diisi!'); return; }
      if(!mulai){  alert('Tahun mulai harus diisi!'); return; }
      if(!akhir){  alert('Tahun akhir harus diisi!'); return; }

      if(parseInt(akhir) < parseInt(mulai)){
        alert('Tahun akhir tidak boleh lebih kecil dari tahun mulai!');
        return;
      }

      $.ajax({
        url: BaseURL + "Instansi/EditSasaranPD",
        type: "POST",
        data: {
          id: id,
          tujuan_pd_id: tujuan,
          sasaran_pd: sasaran,
          tahun_mulai: mulai,
          tahun_akhir: akhir,
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
          alert('Gagal request (Edit Sasaran PD)');
        }
      });
    });

    // Hapus
    $(document).on("click", ".BtnHapus", function(){
      var id = $(this).data('id');
      if(!id){ alert('ID tidak valid!'); return; }

      if(!confirm('Yakin hapus sasaran PD ini?')) return;

      $.ajax({
        url: BaseURL + "Instansi/HapusSasaranPD",
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
          alert('Gagal request (Hapus Sasaran PD)');
        }
      });
    });

    <?php } ?>

  });
</script>

</body>
</html>