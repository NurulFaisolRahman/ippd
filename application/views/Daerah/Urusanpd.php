<?php $this->load->view('Daerah/sidebar'); ?>

<style>
/* Jarak antara Show entries / Search dengan tabel */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 20px;
}
</style>


<div class="main-content">
  <div class="data-table-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">
            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputUrusan">
                  <i class="notika-icon notika-edit"></i> <b>Tambah Urusan</b>
                </button>
              </div>
            </div>
            <br>

            <div class="table-responsive">
              <table id="table-urusan" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center" style="width:80px;">ID</th>
                    <th>Nama Urusan</th>
                    <th class="text-center" style="width:120px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($Urusan)) { ?>
                    <?php foreach ($Urusan as $row) { ?>
                      <tr>
                        <td class="text-center" style="vertical-align: middle;"><?=$row['id']?></td>
                        <td style="vertical-align: middle;"><?=htmlspecialchars($row['nama_urusan'], ENT_QUOTES, 'UTF-8')?></td>
                        <td class="text-center" style="vertical-align: middle;">
                          <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                            <button
                              class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg btn-edit"
                              data-id="<?=$row['id']?>"
                              data-nama="<?=htmlspecialchars($row['nama_urusan'], ENT_QUOTES, 'UTF-8')?>"
                            >
                              <i class="notika-icon notika-edit"></i>
                            </button>
                            <button
                              class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg btn-hapus"
                              data-id="<?=$row['id']?>"
                            >
                              <i class="notika-icon notika-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
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
  <div class="modal fade" id="ModalInputUrusan" role="dialog">
    <div class="modal-dialog modal-md" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding: 5px;">
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Nama Urusan</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="NamaUrusan">
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
  <div class="modal fade" id="ModalEditUrusan" role="dialog">
    <div class="modal-dialog modal-md" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding: 5px;">
                <input type="hidden" id="EditId">

                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Nama Urusan</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="EditNamaUrusan">
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

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
  var BaseURL = '<?=base_url()?>';

  jQuery(document).ready(function($){
    var table = $('#table-urusan').DataTable();

    // Tambah
    $("#BtnSimpan").click(function(){
      var nama = $("#NamaUrusan").val().trim();
      if(!nama){
        alert('Nama Urusan harus diisi!');
        return;
      }

      $.post(BaseURL + "Daerah/InputUrusanPD", { nama_urusan: nama })
        .done(function(res){
          if(res == '1'){
            window.location.reload();
          } else {
            alert(res);
          }
        })
        .fail(function(){
          alert('Gagal request (Tambah Urusan)');
        });
    });

    // Buka modal edit
    $(document).on("click", ".btn-edit", function(){
      $("#EditId").val($(this).data('id'));
      $("#EditNamaUrusan").val($(this).data('nama'));
      $("#ModalEditUrusan").modal("show");
    });

    // Update
    $("#BtnUpdate").click(function(){
      var id = $("#EditId").val();
      var nama = $("#EditNamaUrusan").val().trim();

      if(!id){
        alert('ID tidak valid!');
        return;
      }
      if(!nama){
        alert('Nama Urusan harus diisi!');
        return;
      }

      $.post(BaseURL + "Daerah/EditUrusanPD", { id: id, nama_urusan: nama })
        .done(function(res){
          if(res == '1'){
            window.location.reload();
          } else {
            alert(res);
          }
        })
        .fail(function(){
          alert('Gagal request (Edit Urusan)');
        });
    });

    // Hapus
    $(document).on("click", ".btn-hapus", function(){
      var id = $(this).data('id');
      if(!id){
        alert('ID tidak valid!');
        return;
      }

      if(!confirm('Yakin hapus urusan ini?')){
        return;
      }

      $.post(BaseURL + "Daerah/HapusUrusanPD", { id: id })
        .done(function(res){
          if(res == '1'){
            window.location.reload();
          } else {
            alert(res);
          }
        })
        .fail(function(){
          alert('Gagal request (Hapus Urusan)');
        });
    });
  });
</script>

</body>
</html>
