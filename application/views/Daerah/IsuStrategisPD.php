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

            <!-- Tombol Tambah -->
            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              <div class="basic-tb-hd">
                <div class="button-icon-btn sm-res-mg-t-30">
                  <button type="button"
                          class="btn btn-success notika-btn-success"
                          data-toggle="modal"
                          data-target="#ModalInputIsu">
                    <i class="notika-icon notika-edit"></i> <b>Tambah Isu Strategis</b>
                  </button>
                </div>
              </div>
              <br>
            <?php } ?>

            <!-- TABLE -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th rowspan="2" style="width:60px;">No</th>
                    <th rowspan="2" style="width:220px;">POTENSI DAERAH<br>YANG MENJADI KEWENANGAN</th>
                    <th rowspan="2" style="width:220px;">PERMASALAHAN PD</th>
                    <th rowspan="2" style="width:220px;">ISU KLHS<br>YANG RELEVAN DENGAN PD</th>
                    <th colspan="3">ISU LINGKUNGAN DINAMIS YANG RELEVAN DENGAN PD</th>
                    <th rowspan="2" style="width:220px;">ISU STRATEGIS</th>
                    <th rowspan="2" style="width:120px;">AKSI</th>
                  </tr>
                  <tr >
                    <th style="width:120px;">GLOBAL</th>
                    <th style="width:120px;">NASIONAL</th>
                    <th style="width:120px;">REGIONAL</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($IsuStrategis)) { ?>
                    <?php $no=1; foreach ($IsuStrategis as $row) { ?>
                      <tr>
                        <td class="text-center" style="vertical-align: middle;"><?= $no++ ?></td>

                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['potensi_daerah'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['permasalahan_pd'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['isu_klhs'], ENT_QUOTES, 'UTF-8')) ?></td>

                        <td class="text-center" style="vertical-align: middle;"><?= htmlspecialchars($row['isu_global'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center" style="vertical-align: middle;"><?= htmlspecialchars($row['isu_nasional'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="text-center" style="vertical-align: middle;"><?= htmlspecialchars($row['isu_regional'], ENT_QUOTES, 'UTF-8') ?></td>

                        <td style="vertical-align: middle;"><?= nl2br(htmlspecialchars($row['isu_strategis'], ENT_QUOTES, 'UTF-8')) ?></td>

                        <td class="text-center" style="vertical-align: middle;">
                          <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                              <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg BtnEdit"
                                      data-id="<?= (int)$row['id'] ?>"
                                      data-potensi="<?= htmlspecialchars($row['potensi_daerah'], ENT_QUOTES, 'UTF-8') ?>"
                                      data-permasalahan="<?= htmlspecialchars($row['permasalahan_pd'], ENT_QUOTES, 'UTF-8') ?>"
                                      data-klhs="<?= htmlspecialchars($row['isu_klhs'], ENT_QUOTES, 'UTF-8') ?>"
                                      data-global="<?= htmlspecialchars($row['isu_global'], ENT_QUOTES, 'UTF-8') ?>"
                                      data-nasional="<?= htmlspecialchars($row['isu_nasional'], ENT_QUOTES, 'UTF-8') ?>"
                                      data-regional="<?= htmlspecialchars($row['isu_regional'], ENT_QUOTES, 'UTF-8') ?>"
                                      data-strategis="<?= htmlspecialchars($row['isu_strategis'], ENT_QUOTES, 'UTF-8') ?>">
                                <i class="notika-icon notika-edit"></i>
                              </button>

                              <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg BtnHapus"
                                      data-id="<?= (int)$row['id'] ?>">
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

  <!-- ================= MODAL INPUT ISU ================= -->
  <div class="modal fade" id="ModalInputIsu" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Tambah Isu Strategis</b></h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label><b>Potensi Daerah</b></label>
            <textarea id="Potensi" class="form-control" rows="2"></textarea>
          </div>

          <div class="form-group">
            <label><b>Permasalahan PD</b></label>
            <textarea id="Permasalahan" class="form-control" rows="2"></textarea>
          </div>

          <div class="form-group">
            <label><b>Isu KLHS</b></label>
            <textarea id="KLHS" class="form-control" rows="2"></textarea>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <label><b>Global</b></label>
              <input type="text" id="Global" class="form-control">
            </div>
            <div class="col-lg-4">
              <label><b>Nasional</b></label>
              <input type="text" id="Nasional" class="form-control">
            </div>
            <div class="col-lg-4">
              <label><b>Regional</b></label>
              <input type="text" id="Regional" class="form-control">
            </div>
          </div>

          <br>

          <div class="form-group">
            <label><b>Isu Strategis Disdagperin</b></label>
            <textarea id="Strategis" class="form-control" rows="2"></textarea>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnSimpanIsu"><b>SIMPAN</b></button>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT ISU ================= -->
  <div class="modal fade" id="ModalEditIsu" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Edit Isu Strategis</b></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="EditId">

          <div class="form-group">
            <label><b>Potensi Daerah</b></label>
            <textarea id="EditPotensi" class="form-control" rows="2"></textarea>
          </div>

          <div class="form-group">
            <label><b>Permasalahan PD</b></label>
            <textarea id="EditPermasalahan" class="form-control" rows="2"></textarea>
          </div>

          <div class="form-group">
            <label><b>Isu KLHS</b></label>
            <textarea id="EditKLHS" class="form-control" rows="2"></textarea>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <label><b>Global</b></label>
              <input type="text" id="EditGlobal" class="form-control">
            </div>
            <div class="col-lg-4">
              <label><b>Nasional</b></label>
              <input type="text" id="EditNasional" class="form-control">
            </div>
            <div class="col-lg-4">
              <label><b>Regional</b></label>
              <input type="text" id="EditRegional" class="form-control">
            </div>
          </div>

          <br>

          <div class="form-group">
            <label><b>Isu Strategis Disdagperin</b></label>
            <textarea id="EditStrategis" class="form-control" rows="2"></textarea>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnUpdateIsu"><b>SIMPAN</b></button>
        </div>
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

    // DataTable (ID harus sama dgn table)
    $('#data-table-isu').DataTable();

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


    // =========================
    // TAMBAH ISU
    // =========================
    $("#BtnSimpanIsu").click(function(){
      var potensi = $("#Potensi").val().trim();
      if(!potensi){
        alert('Potensi Daerah harus diisi!');
        return;
      }

      $.post(BaseURL + "Daerah/InputIsuStrategisPD", {   // <-- sesuaikan endpoint
        potensi_daerah: potensi,
        permasalahan_pd: $("#Permasalahan").val().trim(),
        isu_klhs: $("#KLHS").val().trim(),
        isu_global: $("#Global").val().trim(),
        isu_nasional: $("#Nasional").val().trim(),
        isu_regional: $("#Regional").val().trim(),
        isu_strategis: $("#Strategis").val().trim(),
        [CSRF_NAME]: CSRF_TOKEN
      })
      .done(function(res){
        if(res == '1'){
          window.location.reload();
        } else {
          alert(res);
        }
      })
      .fail(function(){
        alert('Gagal request (Tambah Isu Strategis)');
      });
    });


    // =========================
    // BUKA MODAL EDIT
    // =========================
    $(document).on("click", ".BtnEdit", function(){
      $("#EditId").val($(this).data('id'));
      $("#EditPotensi").val($(this).data('potensi'));
      $("#EditPermasalahan").val($(this).data('permasalahan'));
      $("#EditKLHS").val($(this).data('klhs'));
      $("#EditGlobal").val($(this).data('global'));
      $("#EditNasional").val($(this).data('nasional'));
      $("#EditRegional").val($(this).data('regional'));
      $("#EditStrategis").val($(this).data('strategis'));
      $("#ModalEditIsu").modal("show");
    });


    // =========================
    // UPDATE ISU
    // =========================
    $("#BtnUpdateIsu").click(function(){
      var id = $("#EditId").val();
      var potensi = $("#EditPotensi").val().trim();

      if(!id){
        alert('ID tidak valid!');
        return;
      }
      if(!potensi){
        alert('Potensi Daerah harus diisi!');
        return;
      }

      $.post(BaseURL + "Daerah/EditIsuStrategisPD", {   // <-- sesuaikan endpoint
        id: id,
        potensi_daerah: potensi,
        permasalahan_pd: $("#EditPermasalahan").val().trim(),
        isu_klhs: $("#EditKLHS").val().trim(),
        isu_global: $("#EditGlobal").val().trim(),
        isu_nasional: $("#EditNasional").val().trim(),
        isu_regional: $("#EditRegional").val().trim(),
        isu_strategis: $("#EditStrategis").val().trim(),
        [CSRF_NAME]: CSRF_TOKEN
      })
      .done(function(res){
        if(res == '1'){
          window.location.reload();
        } else {
          alert(res);
        }
      })
      .fail(function(){
        alert('Gagal request (Edit Isu Strategis)');
      });
    });


    // =========================
    // HAPUS ISU
    // =========================
    $(document).on("click", ".BtnHapus", function(){
      var id = $(this).data('id');
      if(!id){
        alert('ID tidak valid!');
        return;
      }

      if(!confirm('Yakin hapus isu strategis ini?')){
        return;
      }

      $.post(BaseURL + "Daerah/HapusIsuStrategis", {  // <-- sesuaikan endpoint
        id: id,
        [CSRF_NAME]: CSRF_TOKEN
      })
      .done(function(res){
        if(res == '1'){
          window.location.reload();
        } else {
          alert(res);
        }
      })
      .fail(function(){
        alert('Gagal request (Hapus Isu Strategis)');
      });
    });

  });
</script>

</body>
</html>
