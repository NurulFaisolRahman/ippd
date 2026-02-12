<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
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
                  <i class="notika-icon bi-plus-lg"></i> <b>Tambah Program PD</b>
                </button>
                <?php } ?>
              </div>
            </div>

            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
               <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>Sasaran</th>
                  <th>Urusan</th>
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
                      <td style="vertical-align:middle;"><?= htmlspecialchars($p['Sasaran']) ?></td>
                      <td style="vertical-align:middle;">
                        <?= strip_tags($p['nama_urusan'], '<br>') ?>
                      </td>
                      <td style="vertical-align:middle;">
                        <?= nl2br(htmlspecialchars($p['program_pd'])) ?>
                      </td>


                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <td class="text-center" style="vertical-align:middle;">
                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                          <button
                            class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg BtnEdit"
                            data-id="<?= $p['id'] ?>"
                              data-sasaran="<?= $p['sasaran_id'] ?>"
                              data-urusan="<?= $p['urusan_id'] ?>"
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

  <!-- ============ MODAL INPUT ============ -->
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

              <!-- SASARAN -->
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

              <!-- URUSAN (MULTI) -->
              <div class="form-example-int form-horizental">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3"><label class="hrzn-fm"><b>Urusan</b></label></div>
                    <div class="col-lg-8">
                      <div id="urusanContainerAdd"></div>
                      <button type="button" class="btn btn-info btn-sm" id="btnTambahUrusanAdd" style="margin-top:8px;">
                        + Tambah Urusan
                      </button>
                      <div style="margin-top:6px; font-size:12px; color:#888;">
                        * Minimal 1 urusan
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- PROGRAM PD (MULTI) -->
              <div class="form-example-int form-horizental">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3"><label class="hrzn-fm"><b>Program PD</b></label></div>
                    <div class="col-lg-8">
                      <div id="programContainerAdd"></div>
                      <button type="button" class="btn btn-info btn-sm" id="btnTambahProgramAdd" style="margin-top:8px;">
                        + Tambah Program
                      </button>
                      <div style="margin-top:6px; font-size:12px; color:#888;">
                        * Minimal 1 program
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

            </div><!-- wrap -->
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


  <!-- ============ MODAL EDIT ============ -->
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

              <!-- SASARAN -->
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

              <!-- URUSAN (MULTI) -->
              <div class="form-example-int form-horizental">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3"><label class="hrzn-fm"><b>Urusan</b></label></div>
                    <div class="col-lg-8">
                      <div id="urusanContainerEdit"></div>
                      <button type="button" class="btn btn-info btn-sm" id="btnTambahUrusanEdit" style="margin-top:8px;">
                        + Tambah Urusan
                      </button>
                      <div style="margin-top:6px; font-size:12px; color:#888;">
                        * Minimal 1 urusan
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- PROGRAM PD (MULTI) -->
              <div class="form-example-int form-horizental">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3"><label class="hrzn-fm"><b>Program PD</b></label></div>
                    <div class="col-lg-8">
                      <div id="programContainerEdit"></div>
                      
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

            </div><!-- wrap -->
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

  .row-pair{
    display:flex;
    gap:8px;
    margin-bottom:8px;
    align-items:flex-start;
  }
  .row-pair select{ width:40%; }
  .row-pair textarea{ width:60%; resize:vertical; }
  .row-pair .btn{ white-space:nowrap; height:34px; }
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

  // list urusan dari PHP
  var URUSAN_LIST = <?= json_encode($Urusan) ?>;

  function escapeHtml(text) {
    if (text === null || text === undefined) return '';
    return String(text)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // ====== URUSAN ROW ======
  function buildUrusanRow(selectedId) {
    var html = '<div class="urusan-row" style="display:flex; gap:8px; margin-bottom:8px;">';
    html += '<select class="form-control input-sm urusan-select" style="flex:1;">';
    html += '<option value="">-- Pilih Urusan --</option>';

    if (Array.isArray(URUSAN_LIST)) {
      URUSAN_LIST.forEach(function(u){
        var id = u.id;
        var name = u.nama_urusan;
        var sel = (selectedId && String(selectedId) === String(id)) ? 'selected' : '';
        html += '<option value="'+ escapeHtml(id) +'" '+sel+'>'+ escapeHtml(name) +'</option>';
      });
    }

    html += '</select>';
    html += '<button type="button" class="btn btn-danger btn-sm btnHapusUrusan" style="white-space:nowrap;">Hapus</button>';
    html += '</div>';
    return html;
  }

  // ====== PROGRAM ROW ======
  function buildProgramRow(value) {
    var html = '<div class="program-row" style="display:flex; gap:8px; margin-bottom:8px;">';
    html += '<textarea class="form-control input-sm program-text" rows="3" style="flex:1;" placeholder="Tulis Program PD...">'+ escapeHtml(value || '') +'</textarea>';
    html += '<button type="button" class="btn btn-danger btn-sm btnHapusProgram" style="white-space:nowrap; height:fit-content;">Hapus</button>';
    html += '</div>';
    return html;
  }

  function initUrusan(containerId, selectedIds) {
    var $c = $('#'+containerId);
    $c.html('');
    if (!selectedIds || selectedIds.length === 0) {
      $c.append(buildUrusanRow(null));
    } else {
      selectedIds.forEach(function(id){
        $c.append(buildUrusanRow(id));
      });
    }
  }

  function initProgram(containerId, values) {
    var $c = $('#'+containerId);
    $c.html('');
    if (!values || values.length === 0) {
      $c.append(buildProgramRow(''));
    } else {
      values.forEach(function(v){
        $c.append(buildProgramRow(v));
      });
    }
  }

  function collectUrusan(containerId) {
    var arr = [];
    $('#'+containerId+' .urusan-select').each(function(){
      var v = $(this).val();
      if (v) arr.push(v);
    });
    // unique
    return arr.filter(function(v, i, a){ return a.indexOf(v) === i; });
  }

  function collectProgram(containerId) {
    var arr = [];
    $('#'+containerId+' .program-text').each(function(){
      var v = $(this).val();
      if (v && v.trim()) arr.push(v.trim());
    });
    return arr;
  }

  jQuery(document).ready(function($){

    // datatable
    $('#data-table-basic').DataTable();

    // =========================
    // FILTER PROVINSI & KAB/KOTA (punyamu tetap)
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
            if (res === '1') window.location.reload();
            else {
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


    // ===== INIT saat modal ADD dibuka =====
    $('#ModalInputProgramPD').on('shown.bs.modal', function(){
      initUrusan('urusanContainerAdd', []);
      initProgram('programContainerAdd', []);
    });

    // ===== INIT saat modal EDIT dibuka (akan diisi saat klik edit) =====
    $('#ModalEditProgramPD').on('shown.bs.modal', function(){
      // kalau kosong, minimal 1 baris tetap muncul
      if ($('#urusanContainerEdit').children().length === 0) initUrusan('urusanContainerEdit', []);
      if ($('#programContainerEdit').children().length === 0) initProgram('programContainerEdit', []);
    });

    // tombol tambah urusan/program (ADD)
    $(document).on('click', '#btnTambahUrusanAdd', function(){
      $('#urusanContainerAdd').append(buildUrusanRow(null));
    });
    $(document).on('click', '#btnTambahProgramAdd', function(){
      $('#programContainerAdd').append(buildProgramRow(''));
    });

    // tombol tambah urusan/program (EDIT)
    $(document).on('click', '#btnTambahUrusanEdit', function(){
      $('#urusanContainerEdit').append(buildUrusanRow(null));
    });
    $(document).on('click', '#btnTambahProgramEdit', function(){
      $('#programContainerEdit').append(buildProgramRow(''));
    });

    // hapus row
    $(document).on('click', '.btnHapusUrusan', function(){
      $(this).closest('.urusan-row').remove();
    });
    $(document).on('click', '.btnHapusProgram', function(){
      $(this).closest('.program-row').remove();
    });

    // ===== SIMPAN (ADD) =====
    $("#BtnSimpan").click(function(){
      var sasaran_id = $("#SasaranAdd").val();
      var urusan_id = collectUrusan('urusanContainerAdd');
      var programs   = collectProgram('programContainerAdd');

      if (!sasaran_id) return alert('Sasaran wajib dipilih!');
if (urusan_id.length < 1) return alert('Minimal 1 urusan wajib dipilih!');
if (programs.length < 1) return alert('Minimal 1 Program PD wajib diisi!');


      var payload = {
        sasaran_id: sasaran_id,
        urusan_id: urusan_id,
        program_pd: programs,
        [CSRF_NAME]: CSRF_TOKEN
      };

      $.post(BaseURL+"Daerah/InputProgramPD", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

    // ===== BUKA EDIT =====
    // Catatan: tombol edit sekarang harus bawa data array.
    // Kalau data kamu belum array, minimal tampilkan 1 baris dulu.
 $(document).on("click",".BtnEdit",function(){

  $("#IdEdit").val($(this).data("id"));
  $("#SasaranEdit").val($(this).data("sasaran"));

  // urusan CSV -> array
  var urusanCsv = $(this).data("urusan");
  var urusanArr = [];

  if (urusanCsv) {
    urusanArr = String(urusanCsv)
      .split(",")
      .map(x => x.trim())
      .filter(x => x !== "");
  }

  // program hanya 1 baris
  var programText = $(this).data("program");

  initUrusan("urusanContainerEdit", urusanArr);
  initProgram("programContainerEdit", [programText]);

  $("#ModalEditProgramPD").modal("show");

});



    // ===== UPDATE (EDIT) =====
    $("#BtnUpdate").click(function(){
      var id = $("#IdEdit").val();
      var sasaran_id = $("#SasaranEdit").val();
      var urusan_id = collectUrusan('urusanContainerEdit');
      var programs   = collectProgram('programContainerEdit');

      if (!id) return alert('ID tidak valid!');
      if (!sasaran_id) return alert('Sasaran wajib dipilih!');
      if (urusan_id.length < 1) return alert('Minimal 1 urusan wajib dipilih!');
      if (programs.length < 1) return alert('Minimal 1 Program PD wajib diisi!');


      var payload = {
        id: id,
        sasaran_id: sasaran_id,
        urusan_id: urusan_id,
        program_pd: programs,
        [CSRF_NAME]: CSRF_TOKEN
      };

      $.post(BaseURL+"Daerah/EditProgramPD", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

    // ===== HAPUS =====
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
