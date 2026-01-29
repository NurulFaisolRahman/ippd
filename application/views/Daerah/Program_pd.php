<?php $this->load->view('Daerah/sidebar'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="data-table-list">

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
                                <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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

            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputProgramPD">
                  <i class="notika-icon notika-edit"></i> <b>Tambah Program PD</b>
                </button>
                <?php } ?>
              </div>
            </div>

            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Urusan</th>
                    <th>Sasaran</th>
                    <th>Program PD</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                    <th class="text-center">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>

                <tbody>
                  <?php $No=1; foreach($ProgramPD as $p){ ?>
                    <tr>
                      <td class="text-center" style="vertical-align:middle;"><?= $No++ ?></td>
                      <td style="vertical-align:middle;"><?= htmlspecialchars($p['nama_urusan']) ?></td>
                      <td style="vertical-align:middle;"><?= htmlspecialchars($p['Sasaran']) ?></td>
                      <td style="vertical-align:middle;"><?= htmlspecialchars($p['program_pd']) ?></td>

                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <td class="text-center" style="vertical-align:middle;">
                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                          <button
                            class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg BtnEdit"
                            data-id="<?= $p['id'] ?>"
                            data-urusan="<?= $p['urusan_id'] ?>"
                            data-sasaran="<?= $p['sasaran_id'] ?>"
                            data-program="<?= htmlspecialchars($p['program_pd'], ENT_QUOTES) ?>"
                          >
                            <i class="notika-icon notika-edit"></i>
                          </button>

                          <button
                            class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg BtnHapus"
                            data-id="<?= $p['id'] ?>"
                          >
                            <i class="notika-icon notika-trash"></i>
                          </button>
                        </div>
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

  <!-- Modal Input -->
  <div class="modal fade" id="ModalInputProgramPD" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3"><label class="hrzn-fm"><b>Urusan</b></label></div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="UrusanAdd">
                            <option value="">-- Pilih Urusan --</option>
                            <?php foreach($Urusan as $u){ ?>
                              <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nama_urusan']) ?></option>
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
                      <div class="col-lg-3"><label class="hrzn-fm"><b>Sasaran</b></label></div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="SasaranAdd">
                            <option value="">-- Pilih Sasaran --</option>
                            <?php foreach($Sasaran as $s){ ?>
                              <option value="<?= $s['Id'] ?>"><?= htmlspecialchars($s['Sasaran']) ?></option>
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
                      <div class="col-lg-3"><label class="hrzn-fm"><b>Program PD</b></label></div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="ProgramAdd" rows="3" placeholder="Tulis Program PD..."></textarea>
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

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="ModalEditProgramPD" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">

                <input type="hidden" id="IdEdit">

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3"><label class="hrzn-fm"><b>Urusan</b></label></div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="UrusanEdit">
                            <option value="">-- Pilih Urusan --</option>
                            <?php foreach($Urusan as $u){ ?>
                              <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nama_urusan']) ?></option>
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
                      <div class="col-lg-3"><label class="hrzn-fm"><b>Sasaran</b></label></div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <select class="form-control input-sm" id="SasaranEdit">
                            <option value="">-- Pilih Sasaran --</option>
                            <?php foreach($Sasaran as $s){ ?>
                              <option value="<?= $s['Id'] ?>"><?= htmlspecialchars($s['Sasaran']) ?></option>
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
                      <div class="col-lg-3"><label class="hrzn-fm"><b>Program PD</b></label></div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <textarea class="form-control input-sm" id="ProgramEdit" rows="3"></textarea>
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

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>

<style>
  .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
  .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
  .filter-group label { font-size:14px; margin-bottom:5px; }
  .filter-select { width:260px; font-size:14px; padding:5px 8px; }
  @media (max-width:768px){
    .filter-row{ flex-direction:column; gap:15px; }
    .filter-select{ width:100%; }
  }
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery-price-slider.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.scrollUp.min.js"></script>
<script src="../js/meanmenu/jquery.meanmenu.js"></script>
<script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>
<script src="../js/main.js"></script>

<script>
  var BaseURL = '<?= base_url() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';

  jQuery(document).ready(function($){
    $('#data-table-basic').DataTable();

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
              window.location.reload(); // atau: window.location.href = BaseURL+"Daerah/ProgramPD";
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

    $("#BtnSimpan").click(function(){
      var payload = {
        urusan_id: $("#UrusanAdd").val(),
        sasaran_id: $("#SasaranAdd").val(),
        program_pd: $("#ProgramAdd").val(),
        [CSRF_NAME]: CSRF_TOKEN
      };

      if (!payload.urusan_id) return alert('Urusan wajib dipilih!');
      if (!payload.sasaran_id) return alert('Sasaran wajib dipilih!');
      if (!payload.program_pd.trim()) return alert('Program PD wajib diisi!');

      $.post(BaseURL+"Daerah/InputProgramPD", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

    $(document).on("click",".BtnEdit",function(){
      $("#IdEdit").val($(this).data('id'));
      $("#UrusanEdit").val($(this).data('urusan'));
      $("#SasaranEdit").val($(this).data('sasaran'));
      $("#ProgramEdit").val($(this).data('program'));
      $('#ModalEditProgramPD').modal("show");
    });

    $("#BtnUpdate").click(function(){
      var payload = {
        id: $("#IdEdit").val(),
        urusan_id: $("#UrusanEdit").val(),
        sasaran_id: $("#SasaranEdit").val(),
        program_pd: $("#ProgramEdit").val(),
        [CSRF_NAME]: CSRF_TOKEN
      };

      if (!payload.id) return alert('ID tidak valid!');
      if (!payload.urusan_id) return alert('Urusan wajib dipilih!');
      if (!payload.sasaran_id) return alert('Sasaran wajib dipilih!');
      if (!payload.program_pd.trim()) return alert('Program PD wajib diisi!');

      $.post(BaseURL+"Daerah/EditProgramPD", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

    $(document).on('click', '.BtnHapus', function(){
      if(!confirm("Yakin ingin menghapus data ini?")) return;
      $.post(BaseURL+"Daerah/HapusProgramPD", {
        id: $(this).data('id'),
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

  });
</script>

</body>
</html>
