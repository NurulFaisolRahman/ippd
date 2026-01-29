<?php $this->load->view('Daerah/sidebar'); ?>

<!-- Main Content -->
<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">

            <!-- FILTER PROVINSI & KAB/KOTA (MUNCUL SAAT BELUM LOGIN / BELUM SET KodeWilayah) -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div class="form-example-wrap" style="margin-bottom: 15px;">
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
                          <button class="btn btn-primary notika-btn-primary btn-block" id="FilterWilayah">
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
                  $wil = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                  $nama_wil = $wil ? html_escape($wil['Nama']) : 'Wilayah Tidak Ditemukan';
                ?>
                <div class="alert alert-info" style="margin-bottom: 15px;">
                  <strong>Wilayah terpilih:</strong> <?= $nama_wil ?>
                </div>
              <?php } ?>
            <?php } ?>
            <!-- END FILTER WILAYAH -->

            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                  <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputInstansi">
                    <i class="notika-icon notika-edit"></i> <b>Tambah Instansi</b>
                  </button>
                <?php } ?>

                <!-- Filter Tahun: tampil hanya jika sudah ada KodeWilayah -->
                <div id="filterTahunWrapper" style="display:none;">
                  <button type="button" class="btn btn-info notika-btn-info" id="toggleFilter">
                    <i class="notika-icon notika-filter"></i> <b>Filter Tahun</b>
                  </button>

                  <!-- Filter Tahun -->
                  <div id="filterSection" class="filter-section" style="display:none; margin-top:10px; padding:10px; background-color:#f9f9f9; border-radius:5px;">
                    <div style="display:inline-block; margin-right:20px;">
                      <label style="margin-right:5px;"><b>Tahun Mulai:</b></label>
                      <select id="filterTahunMulai" style="margin-right:10px; padding:5px;">
                        <option value="">Semua Tahun Mulai</option>
                      </select>
                    </div>
                    <div style="display:inline-block; margin-right:20px;">
                      <label style="margin-right:5px;"><b>Tahun Akhir:</b></label>
                      <select id="filterTahunAkhir" style="margin-right:10px; padding:5px;">
                        <option value="">Semua Tahun Akhir</option>
                      </select>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" id="applyFilter" style="padding:5px 10px;"><b>Pilih</b></button>
                    <button type="button" class="btn btn-default btn-sm" id="clearFilter" style="padding:5px 10px; margin-left:5px;"><b>Hapus</b></button>
                  </div>
                </div>
                <!-- END Filter Tahun -->

              </div>
            </div>

            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th>Nama Perangkat Daerah</th>
                    <th>Urusan PD</th>

                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th>Password (Hashed)</th>
                      <th>Tahun Mulai</th>
                      <th>Tahun Akhir</th>
                      <th class="text-center">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php $No = 1; foreach ($Akun as $key) { ?>
                    <tr>
                      <td class="text-center" style="vertical-align:middle;"><?=$No++?></td>
                      <td style="vertical-align:middle;"><?=$key['nama']?></td>
                      <td style="vertical-align:middle;"><?=isset($key['urusan_nama']) ? $key['urusan_nama'] : '-'?></td>

                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <td style="vertical-align: middle;"><?= $key['password'] ?></td>
                        <td style="vertical-align:middle;"><?=$key['tahun_mulai']?></td>
                        <td style="vertical-align:middle;"><?=$key['tahun_akhir']?></td>
                        <td class="text-center">
                          <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                            <button
                              class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                              data-id="<?=$key['id']?>"
                              data-nama="<?=htmlspecialchars($key['nama'], ENT_QUOTES)?>"
                              data-tahun-mulai="<?=$key['tahun_mulai']?>"
                              data-tahun-akhir="<?=$key['tahun_akhir']?>"
                              data-urusan-ids="<?=isset($key['urusan_ids']) ? htmlspecialchars($key['urusan_ids'], ENT_QUOTES) : ''?>"
                            >
                              <i class="notika-icon notika-edit"></i>
                            </button>

                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-id="<?=$key['id']?>">
                              <i class="notika-icon notika-trash"></i>
                            </button>
                          </div>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- /.table-responsive -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Input Instansi -->
  <div class="modal fade" id="ModalInputInstansi" role="dialog">
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
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Nama Instansi</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="Username">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Password</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="Password">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- URUSAN (Tambah) -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Urusan</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div id="urusanContainerAdd"></div>
                        <button type="button" class="btn btn-info btn-sm" id="addUrusanRowAdd" style="margin-top:8px;">
                          + Tambah Urusan
                        </button>
                        <div style="margin-top:6px; font-size:12px; color:#888;">
                          * Wajib pilih minimal 1 urusan
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
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="TahunMulai">
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
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="TahunAkhir">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                      <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
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

  <!-- Modal Edit Instansi -->
  <div class="modal fade" id="ModalEditInstansi" role="dialog">
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
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Nama Instansi</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="hidden" class="form-control input-sm" id="Id">
                          <input type="text" class="form-control input-sm" id="_Username">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Password</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_Password" placeholder="Isi Jika Ganti Password">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- URUSAN (Edit) -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Urusan</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div id="urusanContainerEdit"></div>
                        <button type="button" class="btn btn-info btn-sm" id="addUrusanRowEdit" style="margin-top:8px;">
                          + Tambah Urusan
                        </button>
                        <div style="margin-top:6px; font-size:12px; color:#888;">
                          * Wajib pilih minimal 1 urusan
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
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_TahunMulai">
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
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_TahunAkhir">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                      <button class="btn btn-success notika-btn-success" id="Edit"><b>SIMPAN</b></button>
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
  var BaseURL = '<?=base_url()?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';

  // data urusan dari controller
  var URUSAN_LIST = <?= json_encode($Urusan) ?>;

  function buildUrusanSelect(nameAttr, selectedId) {
    var html = '<div class="urusan-row" style="display:flex; gap:8px; margin-bottom:6px;">';
    html += '<select class="form-control input-sm urusan-select" name="'+nameAttr+'[]" style="flex:1;">';
    html += '<option value="">-- Pilih Urusan --</option>';

    URUSAN_LIST.forEach(function(u){
      var sel = (selectedId && String(selectedId) === String(u.id)) ? 'selected' : '';
      html += '<option value="'+u.id+'" '+sel+'>'+u.nama_urusan+'</option>';
    });

    html += '</select>';
    html += '<button type="button" class="btn btn-danger btn-sm remove-urusan" style="white-space:nowrap;">Hapus</button>';
    html += '</div>';
    return html;
  }

  function initUrusanContainer(containerId, nameAttr, selectedIds) {
    var $c = $('#'+containerId);
    $c.html('');
    if (!selectedIds || selectedIds.length === 0) {
      $c.append(buildUrusanSelect(nameAttr, null));
    } else {
      selectedIds.forEach(function(id){
        $c.append(buildUrusanSelect(nameAttr, id));
      });
    }
  }

  function collectUrusan(containerId) {
    var arr = [];
    $('#'+containerId+' select.urusan-select').each(function(){
      var v = $(this).val();
      if (v) arr.push(v);
    });
    return arr.filter(function(v, i, a){ return a.indexOf(v) === i; });
  }

  function colIndexByText(text) {
    var idx = -1;
    $('#data-table-basic thead th').each(function(i){
      if ($(this).text().trim() === text) idx = i;
    });
    return idx;
  }

  jQuery(document).ready(function($) {

    var table = $('#data-table-basic').DataTable();

    // tampilkan filter tahun hanya jika KodeWilayah sudah ada
    var HAS_WILAYAH = <?= (!empty($KodeWilayah) ? 'true' : 'false') ?>;
    if (HAS_WILAYAH) {
      $("#filterTahunWrapper").show();
    } else {
      $("#filterTahunWrapper").hide();
      $("#filterSection").hide();
    }

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

      $("#FilterWilayah").click(function() {
        if ($("#Provinsi").val() === "") return alert("Mohon Pilih Provinsi");
        if ($("#KabKota").val() === "") return alert("Mohon Pilih Kab/Kota");

        var kodeWilayah = $("#KabKota").val();

        $.ajax({
          url: BaseURL + "Daerah/SetTempKodeWilayah",
          type: "POST",
          data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { $("#FilterWilayah").prop('disabled', true).text('Memuat...'); },
          success: function(res) {
            if (res === '1') {
              window.location.reload();
            } else {
              alert(res || "Gagal menyimpan filter wilayah!");
              $("#FilterWilayah").prop('disabled', false).text('Filter');
            }
          },
          error: function() {
            alert("Gagal menghubungi server!");
            $("#FilterWilayah").prop('disabled', false).text('Filter');
          }
        });
      });

      // populate kab/kota ketika page load (jika $KodeWilayah ada)
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
    // END FILTER WILAYAH
    // =========================

    // init dropdown urusan di modal tambah
    initUrusanContainer('urusanContainerAdd', 'urusan_ids', []);

    // Toggle filter tahun (hanya jika sudah ada wilayah)
    $('#toggleFilter').click(function() {
      if (!HAS_WILAYAH) return;

      $('#filterSection').slideToggle(300);
      var icon = $(this).find('i');
      if (icon.hasClass('notika-filter')) {
        icon.removeClass('notika-filter').addClass('notika-close');
        $(this).html('<i class="notika-icon notika-close"></i> <b>Sembunyikan Filter</b>');
      } else {
        icon.removeClass('notika-close').addClass('notika-filter');
        $(this).html('<i class="notika-icon notika-filter"></i> <b>Filter Tahun</b>');
      }
    });

    // Generate opsi tahun (boleh dibuat walau wrapper hidden)
    var currentYear = new Date().getFullYear();
    var startYear = 2000;
    var endYear = currentYear + 5;
    var tahunMulaiOptions = '<option value="">Semua Tahun Mulai</option>';
    var tahunAkhirOptions = '<option value="">Semua Tahun Akhir</option>';
    for (var y = startYear; y <= endYear; y++) {
      tahunMulaiOptions += '<option value="' + y + '">' + y + '</option>';
      tahunAkhirOptions += '<option value="' + y + '">' + y + '</option>';
    }
    $('#filterTahunMulai').html(tahunMulaiOptions);
    $('#filterTahunAkhir').html(tahunAkhirOptions);

    // Apply filter tahun (berdasarkan index kolom Tahun Mulai/Akhir)
    $('#applyFilter').click(function() {
      var tahunMulai = $('#filterTahunMulai').val();
      var tahunAkhir = $('#filterTahunAkhir').val();

      table.search('').columns().search('');

      var idxMulai = colIndexByText('Tahun Mulai');
      var idxAkhir = colIndexByText('Tahun Akhir');

      if (tahunMulai && idxMulai !== -1) table.column(idxMulai).search('^' + tahunMulai + '$', true, false);
      if (tahunAkhir && idxAkhir !== -1) table.column(idxAkhir).search('^' + tahunAkhir + '$', true, false);

      table.draw();
    });

    // Clear filter tahun
    $('#clearFilter').click(function() {
      $('#filterTahunMulai').val('');
      $('#filterTahunAkhir').val('');
      table.search('').columns().search('').draw();
    });

    // tambah/hapus row urusan
    $(document).on('click', '#addUrusanRowAdd', function(){
      $('#urusanContainerAdd').append(buildUrusanSelect('urusan_ids', null));
    });
    $(document).on('click', '#addUrusanRowEdit', function(){
      $('#urusanContainerEdit').append(buildUrusanSelect('urusan_ids', null));
    });
    $(document).on('click', '.remove-urusan', function(){
      $(this).closest('.urusan-row').remove();
    });

    // SIMPAN (Tambah)
    $("#Input").click(function() {
      var urusan = collectUrusan('urusanContainerAdd');

      if ($("#Username").val() == "") return alert('Input Nama Instansi belum benar!');
      if ($("#Password").val() == "") return alert('Input Password belum benar!');
      if (urusan.length < 1) return alert('Urusan wajib dipilih minimal 1!');
      if ($("#TahunMulai").val() == "") return alert('Input Tahun Mulai belum benar!');
      if ($("#TahunAkhir").val() == "") return alert('Input Tahun Akhir belum benar!');

      var payload = {
        nama: $("#Username").val(),
        password: $("#Password").val(),
        tahun_mulai: $("#TahunMulai").val(),
        tahun_akhir: $("#TahunAkhir").val(),
        urusan_ids: urusan,
        [CSRF_NAME]: CSRF_TOKEN
      };

      $.post(BaseURL+"Daerah/InputInstansi", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

    // buka modal edit
    $(document).on("click",".Edit",function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var tm = $(this).data('tahun-mulai');
      var ta = $(this).data('tahun-akhir');
      var urusanIds = $(this).data('urusan-ids'); // string "1,2,3"

      $("#Id").val(id);
      $("#_Username").val(nama);
      $("#_Password").val("");
      $("#_TahunMulai").val(tm);
      $("#_TahunAkhir").val(ta);

      var selected = [];
      if (urusanIds) {
        selected = String(urusanIds).split(',').map(function(x){ return x.trim(); }).filter(Boolean);
      }
      initUrusanContainer('urusanContainerEdit', 'urusan_ids', selected);

      $('#ModalEditInstansi').modal("show");
    });

    // SIMPAN (Edit)
    $("#Edit").click(function() {
      var urusan = collectUrusan('urusanContainerEdit');

      if ($("#_Username").val() == "") return alert('Input Nama Instansi belum benar!');
      if (urusan.length < 1) return alert('Urusan wajib dipilih minimal 1!');
      if ($("#_TahunMulai").val() == "") return alert('Input Tahun Mulai belum benar!');
      if ($("#_TahunAkhir").val() == "") return alert('Input Tahun Akhir belum benar!');

      var payload = {
        id: $("#Id").val(),
        nama: $("#_Username").val(),
        password: $("#_Password").val(),
        tahun_mulai: $("#_TahunMulai").val(),
        tahun_akhir: $("#_TahunAkhir").val(),
        urusan_ids: urusan,
        [CSRF_NAME]: CSRF_TOKEN
      };

      $.post(BaseURL+"Daerah/EditInstansi", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

    // Hapus
    $(document).on('click', '.Hapus', function () {
      if(!confirm("Yakin ingin menghapus data ini?")) return;
      $.post(BaseURL+"Daerah/HapusInstansi", { id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN }).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

  });
</script>

</body>
</html>
