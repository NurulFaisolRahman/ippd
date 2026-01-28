<?php $this->load->view('Daerah/sidebar'); ?>

<!-- Main Content -->
<div class="main-content">
  <div class="data-table-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">
            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                  <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputInstansi">
                    <i class="notika-icon notika-edit"></i> <b>Tambah Instansi</b>
                  </button>
                <?php } ?>
                <button type="button" class="btn btn-info notika-btn-info" id="toggleFilter">
                  <i class="notika-icon notika-filter"></i> <b>Filter Tahun</b>
                </button>
              </div>

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
                        <td style="vertical-align:middle;" data-tahun-mulai="<?=$key['tahun_mulai']?>"><?=$key['tahun_mulai']?></td>
                        <td style="vertical-align:middle;" data-tahun-akhir="<?=$key['tahun_akhir']?>"><?=$key['tahun_akhir']?></td>
                        <td class="text-center">
                          <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                            <!-- IMPORTANT: jangan kirim password hash ke frontend -->
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
    // unique
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

    // init dropdown urusan di modal tambah
    initUrusanContainer('urusanContainerAdd', 'urusan_ids', []);

    // Toggle filter section
    $('#toggleFilter').click(function() {
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

    // Generate opsi tahun
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

    // Apply filter
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

    // Clear filter
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
        urusan_ids: urusan
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
      $("#_Password").val(""); // kosongkan agar tidak double-hash
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
        password: $("#_Password").val(), // kosong => controller tidak hash ulang
        tahun_mulai: $("#_TahunMulai").val(),
        tahun_akhir: $("#_TahunAkhir").val(),
        urusan_ids: urusan
      };

      $.post(BaseURL+"Daerah/EditInstansi", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

    // Hapus
    $(document).on('click', '.Hapus', function () {
      var payload = { id: $(this).data('id') };
      $.post(BaseURL+"Daerah/HapusInstansi", payload).done(function(res){
        if (res == '1') window.location.reload();
        else alert(res);
      });
    });

  });
</script>

</body>
</html>
