<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambahPd">
                                <i class="notika-icon notika-edit"></i> <b>Input PD Penanggung Jawab</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Indikator Sasaran (IKD)</th>
                                    <th>PD Penanggung Jawab</th>
                                    <th style="width: 10%;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                            <?php $No = 1; foreach (explode('|',)$Ikd as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['indikator_sasaran'] ?></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td class="text-center">
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['id']?>"><i class="notika-icon notika-trash"></i></button>
                                        </div>
                                    </td>
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

<!-- Modal Tambah PD -->
<div class="modal fade" id="ModalTambahPd" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahPd">
                    <input type="hidden" id="PdId" name="id">
                    <div class="form-group">
                        <label for="PdPenanggungJawab">PD Penanggung Jawab</label>
                        <select class="form-control" id="PdPenanggungJawab" name="pd_penanggung_jawab">
                            <option value="">Pilih PD Penanggung Jawab</option>
                            <option value="Semua Instansi Terkait">Semua Instansi Terkait</option>
                            <?php foreach ($Instansi as $instansi) { ?>
                                <option value="<?= $instansi['nama'] ?>"><?= $instansi['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
    var BaseURL = '<?= base_url() ?>';

    $(document).ready(function() {
        // Tambah IKD
        $("#FormTambahIkd").submit(function(e) {
            e.preventDefault();
            $.post(BaseURL + "Admin/TambahIkd", $(this).serialize()).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal menyimpan data!");
                }
            });
        });

        // Edit IKD
        $(".Edit").click(function() {
            var id = $(this).data('id');
            var IdSasaran = $(this).data('sasaran');
            var indikatorSasaran = $(this).data('indikator-sasaran');

            $("#EditId").val(id);
            $("#EditSasaran").val(IdSasaran);
            $("#EditIndikatorSasaran").val(indikatorSasaran);
            $("#ModalEditIkd").modal('show');
        });

        $("#FormEditIkd").submit(function(e) {
            e.preventDefault();
            $.post(BaseURL + "Admin/EditIkd", $(this).serialize()).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal mengupdate data!");
                }
            });
        });

        // Hapus IKD
        $(".Hapus").click(function() {
            var id = $(this).data('id');
            $.post(BaseURL + "Admin/HapusIkd", { id: id }).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data!");
                }
            });
        });

        // Tambah PD
        $(".TambahPd").click(function() {
            var id = $(this).data('id');
            var pdPenanggungJawab = $(this).data('pd-penanggung-jawab') ? $(this).data('pd-penanggung-jawab') : '';
            var pdPenunjang = $(this).data('pd-penunjang') ? $(this).data('pd-penunjang') : '';

            $("#PdId").val(id);
            $("#PdPenanggungJawab").val('');
            $("#PdPenunjang").val('');
            $("#ModalTambahPd").modal('show');
        });

        $("#FormTambahPd").submit(function(e) {
            e.preventDefault();
            $.post(BaseURL + "Admin/TambahPd", $(this).serialize()).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal menyimpan data!");
                }
            });
        });
    });
</script>