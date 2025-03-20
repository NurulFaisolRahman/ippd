<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambahCascading">
                                <i class="notika-icon notika-form"></i> <b>Tambah Cascading</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Misi</th>
                                    <th>Indikator Tujuan (IKU)</th>
                                    <th>Indikator Sasaran (IKD)</th>
                                    <th>PD Penanggung Jawab</th>
                                    <th>PD Penunjang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Cascading as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;">
                                        <?= $key['Misi'] ?> Tahun: <?= $key['tahun'] ?> <!-- Gabungkan Misi dan Tahun -->
                                    </td>
                                    <td style="vertical-align: middle;"><?= $key['indikator_tujuan'] ?></td>
                                    <td style="vertical-align: middle;"><?= str_replace("\n", ", ", $key['indikator_sasaran']) ?></td>
                                    <td style="vertical-align: middle;"><?= $key['pd_penanggung_jawab'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['pd_penunjang'] ?></td>
                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">

                                            <!-- Tombol Edit -->
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['id'] ?>" 
                                                    data-indikator-tujuan="<?= $key['indikator_tujuan'] ?>" 
                                                    data-indikator-sasaran="<?= $key['indikator_sasaran'] ?>" 
                                                    data-pd-penanggung-jawab="<?= $key['pd_penanggung_jawab'] ?>" 
                                                    data-pd-penunjang="<?= $key['pd_penunjang'] ?>">
                                                <i class="notika-icon notika-edit"></i> <!-- Ikon Edit -->
                                            </button><br><br>
                                            

                                            <!-- Tombol Hapus -->
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-id="<?= $key['id'] ?>">
                                                <i class="notika-icon notika-trash"></i> <!-- Ikon Hapus -->
                                            </button>
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

<!-- Modal Tambah Cascading -->
<div class="modal fade" id="ModalTambahCascading" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Cascading</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahCascading">
                <div class="form-group">
                    <label for="Misi">Misi</label>
                    <select class="form-control" id="Misi" name="misi" required>
                        <option value="">Pilih Misi</option>
                        <?php foreach ($Misi as $misi) { ?>
                            <option value="<?= $misi['Misi'] ?>"><?= $misi['Misi'] ?> Tahun: <?= $misi['Tahun'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="IndikatorTujuan">Indikator Tujuan (IKU)</label>
                        <textarea class="form-control" id="IndikatorTujuan" name="indikator_tujuan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="IndikatorSasaran">Indikator Sasaran (IKD)</label>
                        <textarea class="form-control" id="IndikatorSasaran" name="indikator_sasaran" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>PD Penanggung Jawab</label>
                        <?php foreach ($Instansi as $instansi) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pd_penanggung_jawab[]" value="<?= $instansi['nama'] ?>" id="PenanggungJawab<?= $instansi['id'] ?>">
                            <label class="form-check-label" for="PenanggungJawab<?= $instansi['id'] ?>"><?= $instansi['nama'] ?></label>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>PD Penunjang</label>
                        <?php foreach ($Instansi as $instansi) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pd_penunjang[]" value="<?= $instansi['nama'] ?>" id="Penunjang<?= $instansi['id'] ?>">
                            <label class="form-check-label" for="Penunjang<?= $instansi['id'] ?>"><?= $instansi['nama'] ?></label>
                        </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Cascading -->
<div class="modal fade" id="ModalEditCascading" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Cascading</h4>
            </div>
            <div class="modal-body">
                <form id="FormEditCascading">
                    <input type="hidden" id="EditId" name="id">
                    <div class="form-group">
                        <label for="EditMisi">Misi</label>
                        <select class="form-control" id="EditMisi" name="misi" required>
                            <option value="">Pilih Misi</option>
                            <?php foreach ($Misi as $misi) { ?>
                                <option value="<?= $misi['Misi'] ?>"><?= $misi['Misi'] ?> Tahun: <?= $misi['Tahun'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="EditIndikatorTujuan">Indikator Tujuan (IKU)</label>
                        <textarea class="form-control" id="EditIndikatorTujuan" name="indikator_tujuan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="EditIndikatorSasaran">Indikator Sasaran (IKD)</label>
                        <textarea class="form-control" id="EditIndikatorSasaran" name="indikator_sasaran" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>PD Penanggung Jawab</label>
                        <?php foreach ($Instansi as $instansi) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pd_penanggung_jawab[]" value="<?= $instansi['nama'] ?>" id="EditPenanggungJawab<?= $instansi['id'] ?>">
                            <label class="form-check-label" for="EditPenanggungJawab<?= $instansi['id'] ?>"><?= $instansi['nama'] ?></label>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>PD Penunjang</label>
                        <?php foreach ($Instansi as $instansi) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pd_penunjang[]" value="<?= $instansi['nama'] ?>" id="EditPenunjang<?= $instansi['id'] ?>">
                            <label class="form-check-label" for="EditPenunjang<?= $instansi['id'] ?>"><?= $instansi['nama'] ?></label>
                        </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
    <script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('js/wow.min.js'); ?>"></script>
    <script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
    <script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
    <script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
    <script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
    <script src="<?= base_url('js/main.js'); ?>"></script>

<script>
    var BaseURL = '<?= base_url() ?>';
    

    $(document).ready(function() {
        // Tambah Cascading
        $("#FormTambahCascading").submit(function(e) {
            e.preventDefault();
            $.post(BaseURL + "Admin/TambahCascading", $(this).serialize()).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    // alert("Gagal menyimpan data!");
                    alert(res);
                }
            });
        });

        // Edit Cascading
        $(".Edit").click(function() {
    var id = $(this).data('id');
    var indikatorTujuan = $(this).data('indikator-tujuan');
    var indikatorSasaran = $(this).data('indikator-sasaran');
    var misiId = $(this).data('misi-id'); // Ambil data misi_id
    var pdPenanggungJawab = $(this).data('pd-penanggung-jawab').split(',');
    var pdPenunjang = $(this).data('pd-penunjang').split(',');

    $("#EditId").val(id);
    $("#EditIndikatorTujuan").val(indikatorTujuan);
    $("#EditIndikatorSasaran").val(indikatorSasaran);
    $("#EditMisi").val(misiId); // Set nilai dropdown misi

    // Reset checkbox
    $("input[name='pd_penanggung_jawab[]']").prop('checked', false);
    $("input[name='pd_penunjang[]']").prop('checked', false);

    // Set checkbox PD Penanggung Jawab
    pdPenanggungJawab.forEach(function(pd) {
        $("input[name='pd_penanggung_jawab[]'][value='" + pd.trim() + "']").prop('checked', true);
    });

    // Set checkbox PD Penunjang
    pdPenunjang.forEach(function(pd) {
        $("input[name='pd_penunjang[]'][value='" + pd.trim() + "']").prop('checked', true);
    });

    $("#ModalEditCascading").modal('show');
});

        // Submit Edit Cascading
        $("#FormEditCascading").submit(function(e) {
                e.preventDefault();
                $.post(BaseURL + "Admin/EditCascading", $(this).serialize()).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal mengupdate data!");
                    }
                });
            });

        // Hapus Cascading
        $(".Hapus").click(function() {
                var id = $(this).data('id');
                $.post(BaseURL + "Admin/HapusCascading", { id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menghapus data!");
                    }
                });
            
        });
    });
</script>