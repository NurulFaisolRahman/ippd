<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambahIku">
                                <i class="notika-icon notika-edit"></i> <b>Tambah IKU</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Tujuan</th>
                                    <th>Indikator Tujuan (IKU)</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Iku as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php
                                        // Fetch Tujuan name from Tujuan table based on IdTujuan
                                        $tujuan = $this->db->where('Id', $key['IdTujuan'])->get('tujuanrpjmd')->row_array();
                                        echo $tujuan ? $tujuan['Tujuan'] : '-';
                                        ?>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $key['indikator_tujuan'] ?></td>
                                    <td class="text-center">
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                                                    data-id="<?= $key['id'] ?>"
                                                    data-tujuan="<?= $key['IdTujuan'] ?>"
                                                    data-indikator-tujuan="<?= $key['indikator_tujuan'] ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <!-- Tombol Hapus -->
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus"
                                                    data-id="<?= $key['id'] ?>">
                                                <i class="notika-icon notika-trash"></i>
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

<!-- Modal Tambah IKU -->
<div class="modal fade" id="ModalTambahIku" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahIku">
                    <!-- Dropdown Tujuan -->
                    <div class="form-group">
                        <label for="Tujuan">Tujuan</label>
                        <select class="form-control" id="Tujuan" name="Tujuan" required>
                            <?php foreach ($Tujuan as $tujuan) { ?>
                                <option value="<?= $tujuan['Id'] ?>"><?= $tujuan['Tujuan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Indikator Tujuan (IKU) -->
                    <div class="form-group">
                        <label for="IndikatorTujuan">Indikator Tujuan (IKU)</label>
                        <textarea class="form-control" id="IndikatorTujuan" name="indikator_tujuan" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit IKU -->
<div class="modal fade" id="ModalEditIku" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormEditIku">
                    <input type="hidden" id="EditId" name="id">

                    <!-- Dropdown Tujuan -->
                    <div class="form-group">
                        <label for="EditTujuan">Tujuan</label>
                        <select class="form-control" id="EditTujuan" name="EditTujuan" required>
                            <?php foreach ($Tujuan as $tujuan) { ?>
                                <option value="<?= $tujuan['Id'] ?>"><?= $tujuan['Tujuan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Indikator Tujuan (IKU) -->
                    <div class="form-group">
                        <label for="EditIndikatorTujuan">Indikator Tujuan (IKU)</label>
                        <textarea class="form-control" id="EditIndikatorTujuan" name="indikator_tujuan" rows="3" required></textarea>
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
        // Tambah IKU
        $("#FormTambahIku").submit(function(e) {
            e.preventDefault();
            $.post(BaseURL + "Admin/TambahIku", $(this).serialize()).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal menyimpan data!");
                }
            });
        });

        // Edit IKU
        $(".Edit").click(function() {
            var id = $(this).data('id');
            var IdTujuan = $(this).data('tujuan');
            var indikatorTujuan = $(this).data('indikator-tujuan');

            // Set nilai form edit
            $("#EditId").val(id);
            $("#EditTujuan").val(IdTujuan);
            $("#EditIndikatorTujuan").val(indikatorTujuan);

            // Tampilkan modal edit
            $("#ModalEditIku").modal('show');
        });

        // Submit Edit IKU
        $("#FormEditIku").submit(function(e) {
            e.preventDefault();
            $.post(BaseURL + "Admin/EditIku", $(this).serialize()).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal mengupdate data!");
                }
            });
        });

        // Hapus IKU
        $(".Hapus").click(function() {
            var id = $(this).data('id');
            $.post(BaseURL + "Admin/HapusIku", { id: id }).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data!");
                }
            });
        });
    });
</script>