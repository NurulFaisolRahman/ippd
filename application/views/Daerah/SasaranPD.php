<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
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
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center" style="width:70px;">No</th>
                    <th>Sasaran Perangkat Daerah</th>
                    <th class="text-center" style="width:120px;">Tahun Mulai</th>
                    <th class="text-center" style="width:120px;">Tahun Akhir</th>
                    <th class="text-center" style="width:120px;">Aksi</th>
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
                        <td class="text-center" style="vertical-align: middle;">
                          <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
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
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
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
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">

                <!-- ✅ Tambahan: Tujuan PD -->
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
                            <?php if (!empty($TujuanPD)) { ?>
                              <?php foreach ($TujuanPD as $t) { ?>
                                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ✅ End Tambahan -->

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Sasaran PD</b></label>
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
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">
                <input type="hidden" id="EditId">

                <!-- ✅ Tambahan: Tujuan PD (Edit) -->
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
                            <?php if (!empty($TujuanPD)) { ?>
                              <?php foreach ($TujuanPD as $t) { ?>
                                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ✅ End Tambahan -->

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Sasaran PD</b></label>
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
                      <button class="btn btn-success notika-btn-success" id="BtnUpdate"><b>SIMPAN</b></button>
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

  jQuery(document).ready(function($){

    // ✅ Perbaikan: ID tabel kamu adalah data-table-basic
    $('#data-table-basic').DataTable();

    // =========================
    // FILTER PROVINSI & KAB/KOTA (SAMA PERSIS SEPERTI URUSANPD)
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

    <?php } ?>
    // =========================
    // END FILTER
    // =========================

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

      $.post(BaseURL + "Daerah/InputSasaranPD", {
        tujuan_pd_id: tujuan,
        sasaran_pd: sasaran,
        tahun_mulai: mulai,
        tahun_akhir: akhir,
        [CSRF_NAME]: CSRF_TOKEN
      })
      .done(function(res){
        if(res == '1'){
          window.location.reload();
        } else {
          alert(res || 'Gagal menyimpan data!');
        }
      })
      .fail(function(){
        alert('Gagal request (Tambah Sasaran PD)');
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

      $.post(BaseURL + "Daerah/EditSasaranPD", {
        id: id,
        tujuan_pd_id: tujuan,
        sasaran_pd: sasaran,
        tahun_mulai: mulai,
        tahun_akhir: akhir,
        [CSRF_NAME]: CSRF_TOKEN
      })
      .done(function(res){
        if(res == '1'){
          window.location.reload();
        } else {
          alert(res || 'Gagal update data!');
        }
      })
      .fail(function(){
        alert('Gagal request (Edit Sasaran PD)');
      });
    });

    // Hapus
    $(document).on("click", ".BtnHapus", function(){
      var id = $(this).data('id');
      if(!id){ alert('ID tidak valid!'); return; }

      if(!confirm('Yakin hapus sasaran PD ini?')) return;

      $.post(BaseURL + "Daerah/HapusSasaranPD", {
        id: id,
        [CSRF_NAME]: CSRF_TOKEN
      })
      .done(function(res){
        if(res == '1'){
          window.location.reload();
        } else {
          alert(res || 'Gagal hapus data!');
        }
      })
      .fail(function(){
        alert('Gagal request (Hapus Sasaran PD)');
      });
    });

  });
</script>

</body>
</html>
