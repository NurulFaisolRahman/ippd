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
                    <th class="text-center" style="width:80px;">No</th>
                    <th>Masalah Pokok</th>
                    <th>Masalah</th>
                    <th>Penyebab Masalah</th>
                    <th>Internal</th>
                    <th>External</th>
                    <th>Akar Masalah</th>
                    <th class="text-center" style="width:120px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($PermasalahanPD)) { ?>
                    <?php $no=1; foreach ($PermasalahanPD as $row) { ?>
                      <tr>
                        <td class="text-center" style="vertical-align: middle;"><?= $no++ ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($row['NamaPermasalahanPokok'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($row['masalah'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($row['penyebab_masalah'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($row['faktor_internal'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($row['faktor_external'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($row['akar_masalah'], ENT_QUOTES, 'UTF-8') ?></td>

                        <td class="text-center" style="vertical-align: middle;">
                          <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
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

  <!-- Modal Input Permasalahan -->
  <div class="modal fade" id="ModalInputPermasalahanPD" role="dialog">
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
                        <label class="hrzn-fm"><b>Masalah</b></label>
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

  <!-- Modal Edit Permasalahan -->
  <div class="modal fade" id="ModalEditPermasalahanPD" role="dialog">
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
                        <label class="hrzn-fm"><b>Masalah</b></label>
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

    $('#data-table-permasalahan').DataTable();

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

    // Tambah
    $("#BtnSimpan").click(function(){
      var masalah = $("#Masalah").val().trim();
      if(!masalah){
        alert('Masalah harus diisi!');
        return;
      }

      $.post(BaseURL + "Daerah/InputPermasalahanPD", {
          masalah: masalah,
          masalah_pokok: $("#MasalahPokok").val(), // ID
          penyebab_masalah: $("#PenyebabMasalah").val().trim(),
          faktor_internal: $("#FaktorInternal").val().trim(),
          faktor_external: $("#FaktorExternal").val().trim(),
          akar_masalah: $("#AkarMasalah").val().trim(),
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
        alert('Gagal request (Tambah Permasalahan)');
      });
    });

    // Buka modal edit
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

    // Update
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

      $.post(BaseURL + "Daerah/EditPermasalahanPD", {
        id: id,
        masalah: masalah,
        masalah_pokok: $("#EditMasalahPokok").val().trim(),
        penyebab_masalah: $("#EditPenyebabMasalah").val().trim(),
        faktor_internal: $("#EditFaktorInternal").val().trim(),
        faktor_external: $("#EditFaktorExternal").val().trim(),
        akar_masalah: $("#EditAkarMasalah").val().trim(),
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
        alert('Gagal request (Edit Permasalahan)');
      });
    });

    // Hapus
    $(document).on("click", ".BtnHapus", function(){
      var id = $(this).data('id');
      if(!id){
        alert('ID tidak valid!');
        return;
      }

      if(!confirm('Yakin hapus permasalahan ini?')){
        return;
      }

      $.post(BaseURL + "Daerah/HapusPermasalahanPD", {
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
        alert('Gagal request (Hapus Permasalahan)');
      });
    });

  });
</script>

</body>
</html>
