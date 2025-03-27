<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambahIkd">
                                <i class="notika-icon notika-form"></i> <b>Tambah IKD</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Sasaran</th>
                                    <th>Indikator Sasaran (IKD)</th>
                                    <th>PD Penanggung Jawab</th>
                                    <th>PD Penunjang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Ikd as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php
                                        $sasaran = $this->db->where('Id', $key['IdSasaran'])->get('sasaran')->row_array();
                                        echo $sasaran ? $sasaran['Sasaran'] : '-';
                                        ?>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $key['indikator_sasaran'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['pd_penanggung_jawab'] ?? '-' ?></td>
                                    <td style="vertical-align: middle;"><?= $key['pd_penunjang'] ?? '-' ?></td>
                                    <td>
                                        <br>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-primary amber-icon-notika btn-reco-mg btn-button-mg TambahPd" 
                                                    data-id="<?= $key['id'] ?>" 
                                                    data-pd-penanggung-jawab="<?= $key['pd_penanggung_jawab'] ?? '' ?>" 
                                                    data-pd-penunjang="<?= $key['pd_penunjang'] ?? '' ?>">
                                                <i class="notika-icon notika-support"></i> 
                                            </button>
                                            
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['id'] ?>" 
                                                    data-sasaran="<?= $key['IdSasaran'] ?>" 
                                                    data-indikator-sasaran="<?= $key['indikator_sasaran'] ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-id="<?= $key['id'] ?>">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
                                        </div>
                                        <br>
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

<!-- Modal Tambah IKD -->
<div class="modal fade" id="ModalTambahIkd" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah IKD</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahIkd">
                    <div class="form-group">
                        <label for="Sasaran">Sasaran</label>
                        <select class="form-control" id="Sasaran" name="Sasaran" required>
                            <?php foreach ($Sasaran as $sasaran) { ?>
                                <option value="<?= $sasaran['Id'] ?>"><?= $sasaran['Sasaran'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="IndikatorSasaran">Indikator Sasaran (IKD)</label>
                        <textarea class="form-control" id="IndikatorSasaran" name="indikator_sasaran" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit IKD -->
<div class="modal fade" id="ModalEditIkd" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit IKD</h4>
            </div>
            <div class="modal-body">
                <form id="FormEditIkd">
                    <input type="hidden" id="EditId" name="id">
                    <div class="form-group">
                        <label for="EditSasaran">Sasaran</label>
                        <select class="form-control" id="EditSasaran" name="EditSasaran" required>
                            <?php foreach ($Sasaran as $sasaran) { ?>
                                <option value="<?= $sasaran['Id'] ?>"><?= $sasaran['Sasaran'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="EditIndikatorSasaran">Indikator Sasaran (IKD)</label>
                        <textarea class="form-control" id="EditIndikatorSasaran" name="indikator_sasaran" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah PD -->
<div class="modal fade" id="ModalTambahPd" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah PD</h4>
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
                    <div class="form-group">
                        <label for="PdPenunjang">PD Penunjang</label>
                        <select class="form-control" id="PdPenunjang" name="pd_penunjang">
                            <option value="">Pilih PD Penunjang</option>
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