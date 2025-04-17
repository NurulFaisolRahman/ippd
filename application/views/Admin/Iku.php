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
                                    <th class="text-center">Target <br><small>Tahun 1</small></th>
                                    <th class="text-center">Target <br><small>Tahun 2</small></th>
                                    <th class="text-center">Target <br><small>Tahun 3</small></th>
                                    <th class="text-center">Target <br><small>Tahun 4</small></th>
                                    <th class="text-center">Target <br><small>Tahun 5</small></th>
                                    <th style="width: 10%;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Iku as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php
                                        $tujuan = $this->db->where('Id', $key['IdTujuan'])->get('tujuanrpjmd')->row_array();
                                        echo $tujuan ? $tujuan['Tujuan'] : '-';
                                        ?>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $key['indikator_tujuan'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center" align="center">
                                        <?= is_numeric($key['target_1']) && floor($key['target_1']) == $key['target_1'] ? (int)$key['target_1'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center" align="center">
                                        <?= is_numeric($key['target_2']) && floor($key['target_2']) == $key['target_2'] ? (int)$key['target_2'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center" align="center">
                                        <?= is_numeric($key['target_3']) && floor($key['target_3']) == $key['target_3'] ? (int)$key['target_3'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center" align="center">
                                        <?= is_numeric($key['target_4']) && floor($key['target_4']) == $key['target_4'] ? (int)$key['target_4'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center" align="center">
                                        <?= is_numeric($key['target_5']) && floor($key['target_5']) == $key['target_5'] ? (int)$key['target_5'] : '-' ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                                                    data-id="<?= $key['id'] ?>"
                                                    data-tujuan="<?= $key['IdTujuan'] ?>"
                                                    data-indikator-tujuan="<?= $key['indikator_tujuan'] ?>"
                                                    data-target1="<?= $key['target_1'] ?? '' ?>"
                                                    data-target2="<?= $key['target_2'] ?? '' ?>"
                                                    data-target3="<?= $key['target_3'] ?? '' ?>"
                                                    data-target4="<?= $key['target_4'] ?? '' ?>"
                                                    data-target5="<?= $key['target_5'] ?? '' ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
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

                    <!-- Target Inputs -->
                    <div class="form-group">
                        <label>Target Tahunan</label>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Tahun 1</label>
                                <input  class="form-control" name="target_1" placeholder="Angka" >
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2</label>
                                <input  class="form-control" name="target_2" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 3</label>
                                <input  class="form-control" name="target_3" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 4</label>
                                <input class="form-control" name="target_4" placeholder="Angka" >
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 5</label>
                                <input  class="form-control" name="target_5" placeholder="Angka" >
                            </div>
                        </div>
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

                    <!-- Target Inputs -->
                    <div class="form-group">
                        <label>Target Tahunan</label>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Tahun 2023</label>
                                <input  class="form-control" id="EditTarget1" name="target_1" >
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2024</label>
                                <input  class="form-control" id="EditTarget2" name="target_2" >
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2025</label>
                                <input  class="form-control" id="EditTarget3" name="target_3">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2026</label>
                                <input  class="form-control" id="EditTarget4" name="target_4" >
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2027</label>
                                <input  class="form-control" id="EditTarget5" name="target_5" >
                            </div>
                        </div>
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

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Remove commas and convert to number
    function parseNumber(str) {
        return str ? parseFloat(str.replace(/,/g, '')) : null;
    }

    $(document).ready(function() {

        
        // Tambah IKU
        $("#FormTambahIku").submit(function(e) {
            e.preventDefault();
            // Validate all targets are integers
            if(validateIntegerInputs('FormTambahIku')) {
                $.post(BaseURL + "Admin/TambahIku", $(this).serialize()).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menyimpan data!");
                    }
                });
            }
        });

        // Edit IKU
        $(".Edit").click(function() {
            var id = $(this).data('id');
            var IdTujuan = $(this).data('tujuan');
            var indikatorTujuan = $(this).data('indikator-tujuan');
            var target1 = $(this).data('target1');
            var target2 = $(this).data('target2');
            var target3 = $(this).data('target3');
            var target4 = $(this).data('target4');
            var target5 = $(this).data('target5');

            // Set nilai form edit
            $("#EditId").val(id);
            $("#EditTujuan").val(IdTujuan);
            $("#EditIndikatorTujuan").val(indikatorTujuan);
            $("#EditTarget1").val(target1 ? parseInt(target1) : '');
            $("#EditTarget2").val(target2 ? parseInt(target2) : '');
            $("#EditTarget3").val(target3 ? parseInt(target3) : '');
            $("#EditTarget4").val(target4 ? parseInt(target4) : '');
            $("#EditTarget5").val(target5 ? parseInt(target5) : '');

            // Tampilkan modal edit
            $("#ModalEditIku").modal('show');
        });

        // Submit Edit IKU
        $("#FormEditIku").submit(function(e) {
            e.preventDefault();
            // Validate all targets are integers
            if(validateIntegerInputs('FormEditIku')) {
                $.post(BaseURL + "Admin/EditIku", $(this).serialize()).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal mengupdate data!");
                    }
                });
            }
        });

        // Hapus IKU
        $(".Hapus").click(function() {
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var id = $(this).data('id');
                $.post(BaseURL + "Admin/HapusIku", { id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menghapus data!");
                    }
                });
            }
        });

        // Function to validate integer inputs
        function validateIntegerInputs(formId) {
            var isValid = true;
            $('#' + formId + ' input[type="number"]').each(function() {
                if(this.value && !Number.isInteger(parseFloat(this.value))) {
                    alert('Harap masukkan angka bulat untuk semua target!');
                    isValid = false;
                    return false; // break out of loop
                }
            });
            return isValid;
        }
    });
</script>