<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsuStrategis">
                                <i class="notika-icon notika-edit"></i> <b>Input Isu Strategis</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="20%">Nama Isu Strategis</th>
                                    <th width="10%" class="text-center">Periode</th>
                                    <th width="25%" class="text-center">Permasalahan Pokok Daerah</th>
                                    <th width="25%" class="text-center">Isu KLHS Daerah</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($IsuStrategis as $key) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: top;"><?= $No++ ?></td>
                                    <td style="vertical-align: top;"><?= $key['NamaIsuStrategis'] ?></td>
                                    <td class="text-center" style="vertical-align: top;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    
                                    <!-- Kolom Permasalahan Pokok Daerah -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahPP" 
                                                        title="Tambah Permasalahan Pokok"
                                                        data-id="<?= $key['Id'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['permasalahan_pokok'])): ?>
                                                <button class="btn btn-sm btn-primary EditPP" 
                                                        title="Edit Permasalahan Pokok"
                                                        data-pp="<?= $key['Id'] . '|' . $key['permasalahan_pokok'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['permasalahan_pokok'])): ?>
                                                    <?php 
                                                    $permasalahanPokok = explode(',', $key['permasalahan_pokok']);
                                                    foreach ($permasalahanPokok as $pp): 
                                                    ?>
                                                        <div style="padding: 2px 0; white-space: nowrap;"><?= htmlspecialchars($pp) ?></div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Kolom Isu KLHS Daerah -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahKLHS" 
                                                        title="Tambah Isu KLHS"
                                                        data-id="<?= $key['Id'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['isu_klhs'])): ?>
                                                <button class="btn btn-sm btn-primary EditKLHS" 
                                                        title="Edit Isu KLHS"
                                                        data-klhs="<?= $key['Id'] . '|' . $key['isu_klhs'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['isu_klhs'])): ?>
                                                    <?php 
                                                    $isuKLHS = explode(',', $key['isu_klhs']);
                                                    foreach ($isuKLHS as $klhs): 
                                                    ?>
                                                        <div style="padding: 2px 0; white-space: nowrap;"><?= htmlspecialchars($klhs) ?></div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Kolom Aksi -->
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div style="display: flex; justify-content: center; gap: 5px;">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['Id'] ?>" 
                                                    data-nama="<?= htmlspecialchars($key['NamaIsuStrategis']) ?>" 
                                                    data-tahunmulai="<?= $key['TahunMulai'] ?>" 
                                                    data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                <i class="notika-icon notika-next" style="font-size: 15px;"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-id="<?= $key['Id'] ?>"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                <i class="notika-icon notika-trash" style="font-size: 15px;"></i>
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

<!-- Modal Input Isu Strategis -->
<div class="modal fade" id="ModalInputIsuStrategis" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Isu Strategis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodeRPJMD" name="PeriodeRPJMD" required>
                                                    <option value="">-- Pilih Periode RPJMD --</option>
                                                    <?php foreach ($Periods as $period) { ?>
                                                        <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                            <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
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
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Isu Strategis</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="NamaIsuStrategis" name="NamaIsuStrategis" style="color: #000;" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="InputIsuStrategis"><b>SIMPAN</b></button>
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

<!-- Modal Edit Isu Strategis -->
<div class="modal fade" id="ModalEditIsuStrategis" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Isu Strategis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditPeriodeRPJMD" name="EditPeriodeRPJMD" required>
                                                    <option value="">-- Pilih Periode RPJMD --</option>
                                                    <?php foreach ($Periods as $period) { ?>
                                                        <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                            <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
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
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Isu Strategis</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" id="EditId" name="EditId">
                                                <input type="text" class="form-control input-sm" id="EditNamaIsuStrategis" name="EditNamaIsuStrategis" style="color: #000;" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="UpdateIsuStrategis"><b>UPDATE</b></button>
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

<!-- Modal Tambah Permasalahan Pokok -->
<div class="modal fade" id="ModalTambahPP" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Permasalahan Pokok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahPP">
                    <input type="hidden" id="PPId" name="id">
                    <div id="pp-container">
                        <div class="form-group pp-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <label>Permasalahan Pokok Daerah</label>
                                    <select class="form-control pp-select" name="permasalahan_pokok[]" required>
                                        <option value="">Pilih Permasalahan Pokok</option>
                                        <?php foreach ($PermasalahanPokok as $pp) { ?>
                                            <option value="<?= htmlspecialchars($pp['NamaPermasalahanPokok']) ?>">
                                                <?= htmlspecialchars($pp['NamaPermasalahanPokok']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-pp">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Isu KLHS -->
<div class="modal fade" id="ModalTambahKLHS" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Isu KLHS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahKLHS">
                    <input type="hidden" id="KLHSId" name="id">
                    <div id="klhs-container">
                        <div class="form-group klhs-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <label>Isu KLHS Daerah</label>
                                    <select class="form-control klhs-select" name="isu_klhs[]" required>
                                        <option value="">Pilih Isu KLHS</option>
                                        <?php foreach ($IsuKLHS as $klhs) { ?>
                                            <option value="<?= htmlspecialchars($klhs['NamaIsuKLHS']) ?>">
                                                <?= htmlspecialchars($klhs['NamaIsuKLHS']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-klhs">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Permasalahan Pokok -->
<div class="modal fade" id="ModalEditPP" role="dialog">
    <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Permasalahan Pokok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <div class="form-example-wrap">
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="nk-int-st text-justify">
                                        <input type="hidden" class="form-control input-sm" id="IdPP">
                                        <div id="ListPP"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int">
                        <div class="row">
                            <div class="col-lg-12">
                                <button class="btn btn-success" id="SavePP">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Isu KLHS -->
<div class="modal fade" id="ModalEditKLHS" role="dialog">
    <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Isu KLHS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <div class="form-example-wrap">
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="nk-int-st text-justify">
                                        <input type="hidden" class="form-control input-sm" id="IdKLHS">
                                        <div id="ListKLHS"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int">
                        <div class="row">
                            <div class="col-lg-12">
                                <button class="btn btn-success" id="SaveKLHS">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script>
    var BaseURL = '<?= base_url() ?>';
    var permasalahanPokokOptions = <?php echo json_encode(array_map(function($pp) { return ['nama' => $pp['NamaPermasalahanPokok']]; }, $PermasalahanPokok)); ?>;
    var isuKLHSOptions = <?php echo json_encode(array_map(function($klhs) { return ['nama' => $klhs['NamaIsuKLHS']]; }, $IsuKLHS)); ?>;

    $(document).ready(function() {
        // Function to generate options for Permasalahan Pokok
        function getPermasalahanPokokOptions() {
            var options = '';
            permasalahanPokokOptions.forEach(function(pp) {
                options += '<option value="' + pp.nama + '">' + pp.nama + '</option>';
            });
            return options;
        }

        // Function to generate options for Isu KLHS
        function getIsuKLHSOptions() {
            var options = '';
            isuKLHSOptions.forEach(function(klhs) {
                options += '<option value="' + klhs.nama + '">' + klhs.nama + '</option>';
            });
            return options;
        }

        // Add new Permasalahan Pokok dropdown
        $(document).on('click', '.btn-add-pp', function() {
            var newRow = $('<div class="form-group pp-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<select class="form-control pp-select" name="permasalahan_pokok[]" required>' +
                '<option value="">Pilih Permasalahan Pokok</option>' +
                getPermasalahanPokokOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 7px;">' +
                '<button type="button" class="btn btn-danger btn-remove-pp">' +
                '<i class="notika-icon notika-trash"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            $('#pp-container').append(newRow);
        });

        // Add new Isu KLHS dropdown
        $(document).on('click', '.btn-add-klhs', function() {
            var newRow = $('<div class="form-group klhs-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<select class="form-control klhs-select" name="isu_klhs[]" required>' +
                '<option value="">Pilih Isu KLHS</option>' +
                getIsuKLHSOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 7px;">' +
                '<button type="button" class="btn btn-danger btn-remove-klhs">' +
                '<i class="notika-icon notika-trash"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            $('#klhs-container').append(newRow);
        });

        // Remove Permasalahan Pokok dropdown
        $(document).on('click', '.btn-remove-pp', function() {
            if ($('.pp-row').length > 1) {
                $(this).closest('.pp-row').remove();
            } else {
                alert('Minimal harus ada satu Permasalahan Pokok');
            }
        });

        // Remove Isu KLHS dropdown
        $(document).on('click', '.btn-remove-klhs', function() {
            if ($('.klhs-row').length > 1) {
                $(this).closest('.klhs-row').remove();
            } else {
                alert('Minimal harus ada satu Isu KLHS');
            }
        });

        // Input Isu Strategis
        $("#InputIsuStrategis").click(function() {
            if ($("#PeriodeRPJMD").val() === "") {
                alert('Pilih Periode RPJMD terlebih dahulu!');
                return;
            } else if ($("#NamaIsuStrategis").val() === "") {
                alert('Nama Isu Strategis harus diisi!');
                return;
            } else {
                var Data = {
                    PeriodeRPJMD: $("#PeriodeRPJMD").val(),
                    NamaIsuStrategis: $("#NamaIsuStrategis").val(),
                    '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
                };
                $.post(BaseURL + "Admin/InputIsuStrategis", Data)
                    .done(function(Respon) {
                        if (Respon == '1') {
                            $('#ModalInputIsuStrategis').modal('hide');
                            $("#PeriodeRPJMD").val('');
                            $("#NamaIsuStrategis").val('');
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            }
        });

        // Edit Isu Strategis
        $(document).on("click", ".Edit", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var tahunMulai = $(this).data('tahunmulai');
            var tahunAkhir = $(this).data('tahunakhir');
            $("#EditId").val(id);
            $("#EditNamaIsuStrategis").val(nama);
            $("#EditPeriodeRPJMD").val(tahunMulai + '-' + tahunAkhir);
            $('#ModalEditIsuStrategis').modal("show");
        });

        // Update Isu Strategis
        $("#UpdateIsuStrategis").click(function() {
            if ($("#EditPeriodeRPJMD").val() === "") {
                alert('Pilih Periode RPJMD terlebih dahulu!');
                return;
            } else if ($("#EditNamaIsuStrategis").val() === "") {
                alert('Nama Isu Strategis harus diisi!');
                return;
            } else {
                var Data = {
                    Id: $("#EditId").val(),
                    EditPeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
                    NamaIsuStrategis: $("#EditNamaIsuStrategis").val(),
                    '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
                };
                $.post(BaseURL + "Admin/UpdateIsuStrategis", Data)
                    .done(function(Respon) {
                        if (Respon == '1') {
                            $('#ModalEditIsuStrategis').modal('hide');
                            $("#EditPeriodeRPJMD").val('');
                            $("#EditNamaIsuStrategis").val('');
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    })
                    .fail(function(xhr, status, error) {
                          alert("Terjadi kesalahan: " + error);
                    });
            }
        });

        // Hapus Isu Strategis
        $(document).on("click", ".Hapus", function() {
            if (confirm("Apakah Anda yakin ingin menghapus isu strategis ini?")) {
                var Id = { Id: $(this).data('id'), '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>' };
                $.post(BaseURL + "Admin/DeleteIsuStrategis", Id)
                    .done(function(Respon) {
                        if (Respon == '1') {
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            }
        });

        // Tambah Permasalahan Pokok
        $(document).on("click", ".TambahPP", function() {
            var id = $(this).data('id');
            $("#PPId").val(id);
            $("#pp-container").html('<div class="form-group pp-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<label>Permasalahan Pokok Daerah</label>' +
                '<select class="form-control pp-select" name="permasalahan_pokok[]" required>' +
                '<option value="">Pilih Permasalahan Pokok</option>' +
                getPermasalahanPokokOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 25px;">' +
                '<button type="button" class="btn btn-success btn-add-pp">' +
                '<i class="notika-icon notika-plus-symbol"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            $("#ModalTambahPP").modal('show');
        });

        $("#FormTambahPP").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            var ppValues = [];
            $('select[name="permasalahan_pokok[]"]').each(function() {
                if ($(this).val()) {
                    ppValues.push($(this).val());
                }
            });
            formData = formData.filter(item => item.name !== 'permasalahan_pokok[]');
            formData.push({name: 'permasalahan_pokok', value: ppValues.join(',')});
            formData.push({name: '<?= $this->security->get_csrf_token_name() ?>', value: '<?= $this->security->get_csrf_hash() ?>'});
            $.post(BaseURL + "Admin/TambahPermasalahanPokokIsuStrategis", $.param(formData))
                .done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menambahkan Permasalahan Pokok: " + res);
                    }
                })
                .fail(function(xhr, status, error) {
                    alert("Terjadi kesalahan: " + error);
                });
        });

        // Tambah Isu KLHS
        $(document).on("click", ".TambahKLHS", function() {
            var id = $(this).data('id');
            $("#KLHSId").val(id);
            $("#klhs-container").html('<div class="form-group klhs-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<label>Isu KLHS Daerah</label>' +
                '<select class="form-control klhs-select" name="isu_klhs[]" required>' +
                '<option value="">Pilih Isu KLHS</option>' +
                getIsuKLHSOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 25px;">' +
                '<button type="button" class="btn btn-success btn-add-klhs">' +
                '<i class="notika-icon notika-plus-symbol"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            $("#ModalTambahKLHS").modal('show');
        });

        $("#FormTambahKLHS").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            var klhsValues = [];
            $('select[name="isu_klhs[]"]').each(function() {
                if ($(this).val()) {
                    klhsValues.push($(this).val());
                }
            });
            formData = formData.filter(item => item.name !== 'isu_klhs[]');
            formData.push({name: 'isu_klhs', value: klhsValues.join(',')});
            formData.push({name: '<?= $this->security->get_csrf_token_name() ?>', value: '<?= $this->security->get_csrf_hash() ?>'});
            $.post(BaseURL + "Admin/TambahIsuKLHSIsuStrategis", $.param(formData))
                .done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menambahkan Isu KLHS: " + res);
                    }
                })
                .fail(function(xhr, status, error) {
                    alert("Terjadi kesalahan: " + error);
                });
        });

        // Edit Permasalahan Pokok
        $(document).on("click", ".EditPP", function() {
            var data = $(this).data('pp').split("|");
            $("#IdPP").val(data[0]);
            var ppList = data[1].split(",");
            var list = '';
            ppList.forEach(function(pp) {
                list += '<label><input style="margin-top: 10px;" type="checkbox" checked name="PP" value="' + pp + '"> ' + pp + '</label><br>';
            });
            $("#ListPP").html(list);
            $("#ModalEditPP").modal('show');
        });

        $("#SavePP").click(function() {
            var ppValues = [];
            $.each($("input[name='PP']:checked"), function() {
                ppValues.push($(this).val());
            });
            var data = {
                id: $("#IdPP").val(),
                permasalahan_pokok: ppValues.join(","),
                '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
            };
            $.post(BaseURL + "Admin/EditPermasalahanPokokIsuStrategis", data)
                .done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert(res);
                    }
                })
                .fail(function(xhr, status, error) {
                    alert("Terjadi kesalahan: " + error);
                });
        });

        // Edit Isu KLHS
        $(document).on("click", ".EditKLHS", function() {
            var data = $(this).data('klhs').split("|");
            $("#IdKLHS").val(data[0]);
            var klhsList = data[1].split(",");
            var list = '';
            klhsList.forEach(function(klhs) {
                list += '<label><input style="margin-top: 10px;" type="checkbox" checked name="KLHS" value="' + klhs + '"> ' + klhs + '</label><br>';
            });
            $("#ListKLHS").html(list);
            $("#ModalEditKLHS").modal('show');
        });

        $("#SaveKLHS").click(function() {
            var klhsValues = [];
            $.each($("input[name='KLHS']:checked"), function() {
                klhsValues.push($(this).val());
            });
            var data = {
                id: $("#IdKLHS").val(),
                isu_klhs: klhsValues.join(","),
                '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
            };
            $.post(BaseURL + "Admin/EditIsuKLHSIsuStrategis", data)
                .done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert(res);
                    }
                })
                .fail(function(xhr, status, error) {
                    alert("Terjadi kesalahan: " + error);
                });
        });

        // Reset modals
        $('#ModalInputIsuStrategis').on('hidden.bs.modal', function() {
            $("#PeriodeRPJMD").val('');
            $("#NamaIsuStrategis").val('');
        });

        $('#ModalEditIsuStrategis').on('hidden.bs.modal', function() {
            $("#EditPeriodeRPJMD").val('');
            $("#EditNamaIsuStrategis").val('');
            $("#EditId").val('');
        });

        $('#ModalTambahPP').on('hidden.bs.modal', function() {
            $("#pp-container").html('');
            $("#PPId").val('');
        });

        $('#ModalTambahKLHS').on('hidden.bs.modal', function() {
            $("#klhs-container").html('');
            $("#KLHSId").val('');
        });
    });
</script>

<style>
    .form-control, .form-control option {
        color: #000 !important;
    }
    .modal-content {
        color: #000;
    }
</style>