<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputProyek">
                                <i class="notika-icon notika-edit"></i> <b>Input Proyek Strategis</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kementerian</th>
                                    <th>Program Strategis</th>
                                    <th>Proyek Strategis</th>
                                    <th>Provinsi</th>
                                    <th>Kota/Kabupaten</th>
                                    <th class="text-center">Periode</th>
                                    <th class="text-center">Target <br><small>Tahun 1</small></th>
                                    <th class="text-center">Target <br><small>Tahun 2</small></th>
                                    <th class="text-center">Target <br><small>Tahun 3</small></th>
                                    <th class="text-center">Target <br><small>Tahun 4</small></th>
                                    <th class="text-center">Target <br><small>Tahun 5</small></th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Proyek as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaProgram'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaProyek'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaProvinsi'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaKota'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun1'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun2'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun3'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun4'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun5'] ?></td>
                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['Id'] ?>"
                                                    data-kementerian="<?= $key['IdKementerian'] ?>"
                                                    data-program="<?= $key['IdProgramStrategis'] ?>"
                                                    data-proyek="<?= $key['NamaProyek'] ?>"
                                                    data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                    data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                    data-target1="<?= $key['TargetTahun1'] ?>"
                                                    data-target2="<?= $key['TargetTahun2'] ?>"
                                                    data-target3="<?= $key['TargetTahun3'] ?>"
                                                    data-target4="<?= $key['TargetTahun4'] ?>"
                                                    data-target5="<?= $key['TargetTahun5'] ?>"
                                                    data-provinsi="<?= $key['KodeWilayah'] ?? '' ?>"
                                                    data-kota="<?= $key['KodeKota'] ?? '' ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-id="<?= $key['Id'] ?>">
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

<!-- Modal Input Proyek Strategis -->
<div class="modal fade" id="ModalInputProyek" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Input Proyek Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formInputProyek">
                    <div class="form-example-wrap" style="padding: 5px;">
                        <!-- Periode Dropdown -->
                        <div class="form-group">
                            <label>Periode</label>
                            <select class="form-control" id="Periode" required>
                                <option value="">-- Pilih Periode --</option>
                                <?php foreach ($Periode as $periode) { ?>
                                    <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>">
                                        <?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Kementerian Dropdown -->
                        <div class="form-group">
                            <label>Kementerian</label>
                            <select class="form-control" id="IdKementerian" required>
                                <option value="">-- Pilih Kementerian --</option>
                            </select>
                        </div>

                        <!-- Program Strategis Dropdown -->
                        <div class="form-group">
                            <label>Program Strategis</label>
                            <select class="form-control" id="IdProgramStrategis" required>
                                <option value="">-- Pilih Program Strategis --</option>
                            </select>
                        </div>

                        <!-- Location Information (Readonly) -->
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control" id="ProvinsiInfo" readonly>
                        </div>

                        <div class="form-group">
                            <label>Kota/Kabupaten</label>
                            <input type="text" class="form-control" id="KotaInfo" readonly>
                        </div>

                        <!-- Proyek Name -->
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <input type="text" class="form-control" id="NamaProyek" required>
                        </div>

                        <!-- Target Inputs -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 1</label>
                                    <input type="number" class="form-control" id="TargetTahun1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 2</label>
                                    <input type="number" class="form-control" id="TargetTahun2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 3</label>
                                    <input type="number" class="form-control" id="TargetTahun3">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 4</label>
                                    <input type="number" class="form-control" id="TargetTahun4">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 5</label>
                                    <input type="number" class="form-control" id="TargetTahun5">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="InputProyek">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Proyek Strategis -->
<div class="modal fade" id="ModalEditProyek" role="dialog">
    <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit Proyek Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formEditProyek">
                    <input type="hidden" id="EditId">
                    <div class="form-example-wrap" style="padding: 5px;">
                        <!-- Periode Dropdown -->
                        <div class="form-group">
                            <label>Periode</label>
                            <select class="form-control" id="EditPeriode" required>
                                <option value="">-- Pilih Periode --</option>
                                <?php foreach ($Periode as $periode) { ?>
                                    <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>">
                                        <?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Kementerian Dropdown -->
                        <div class="form-group">
                            <label>Kementerian</label>
                            <select class="form-control" id="EditIdKementerian" required>
                                <option value="">-- Pilih Kementerian --</option>
                            </select>
                        </div>

                        <!-- Program Strategis Dropdown -->
                        <div class="form-group">
                            <label>Program Strategis</label>
                            <select class="form-control" id="EditIdProgramStrategis" required>
                                <option value="">-- Pilih Program Strategis --</option>
                            </select>
                        </div>

                        <!-- Location Information (Readonly) -->
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control" id="EditProvinsiInfo" readonly>
                        </div>

                        <div class="form-group">
                            <label>Kota/Kabupaten</label>
                            <input type="text" class="form-control" id="EditKotaInfo" readonly>
                        </div>

                        <!-- Proyek Name -->
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <input type="text" class="form-control" id="EditNamaProyek" required>
                        </div>

                        <!-- Target Inputs -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 1</label>
                                    <input type="number" class="form-control" id="EditTargetTahun1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 2</label>
                                    <input type="number" class="form-control" id="EditTargetTahun2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 3</label>
                                    <input type="number" class="form-control" id="EditTargetTahun3">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 4</label>
                                    <input type="number" class="form-control" id="EditTargetTahun4">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Target Tahun 5</label>
                                    <input type="number" class="form-control" id="EditTargetTahun5">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="UpdateProyek">Update</button>
            </div>
        </div>
    </div>
</div>

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
$(document).ready(function() {
    var BaseURL = '<?= base_url() ?>';
    
    // Function to populate Kementerian dropdown based on selected Periode
    function populateKementerian(selectElement, tahunMulai, tahunAkhir, selectedId = '') {
        if (tahunMulai && tahunAkhir) {
            $.post(BaseURL + "Super/GetKementerianByPeriode", {
                TahunMulai: tahunMulai,
                TahunAkhir: tahunAkhir
            }, function(response) {
                var kementerian = JSON.parse(response);
                selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
                $.each(kementerian, function(index, item) {
                    var isSelected = (item.Id == selectedId) ? 'selected' : '';
                    selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                });
            });
        } else {
            selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
        }
    }

    // Function to populate Program Strategis dropdown and location info
    function populateProgramStrategis(selectElement, idKementerian, tahunMulai, tahunAkhir, selectedId = '') {
        if (idKementerian && tahunMulai && tahunAkhir) {
            $.post(BaseURL + "Super/GetProgramByKementerianAndPeriode", {
                IdKementerian: idKementerian,
                TahunMulai: tahunMulai,
                TahunAkhir: tahunAkhir
            }, function(response) {
                var program = JSON.parse(response);
                selectElement.empty().append('<option value="">-- Pilih Program Strategis --</option>');
                
                // For input modal
                $('#ProvinsiInfo').val('');
                $('#KotaInfo').val('');
                
                // For edit modal
                $('#EditProvinsiInfo').val('');
                $('#EditKotaInfo').val('');
                
                $.each(program, function(index, item) {
                    var isSelected = (item.Id == selectedId) ? 'selected' : '';
                    selectElement.append('<option value="' + item.Id + '" ' + isSelected + 
                                        ' data-provinsi="' + (item.KodeWilayah || '') + '"' +
                                        ' data-kota="' + (item.KodeKota || '') + '"' +
                                        ' data-namaprovinsi="' + (item.NamaProvinsi || '') + '"' +
                                        ' data-namakota="' + (item.NamaKota || '') + '">' + 
                                        item.NamaProgram + '</option>');
                });
            });
        } else {
            selectElement.empty().append('<option value="">-- Pilih Program Strategis --</option>');
        }
    }

    // Program Strategis change handler for Input modal
    $("#IdProgramStrategis").change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#ProvinsiInfo').val(selectedOption.data('namaprovinsi') || '-');
        $('#KotaInfo').val(selectedOption.data('namakota') || '-');
    });

    // Program Strategis change handler for Edit modal
    $("#EditIdProgramStrategis").change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#EditProvinsiInfo').val(selectedOption.data('namaprovinsi') || '-');
        $('#EditKotaInfo').val(selectedOption.data('namakota') || '-');
    });

    // Periode change handler for Input modal
    $("#Periode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [tahunMulai, tahunAkhir] = periode.split('|');
            populateKementerian($("#IdKementerian"), tahunMulai, tahunAkhir);
            $("#IdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>');
            $('#ProvinsiInfo').val('');
            $('#KotaInfo').val('');
        } else {
            $("#IdKementerian").empty().append('<option value="">-- Pilih Kementerian --</option>');
            $("#IdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>');
            $('#ProvinsiInfo').val('');
            $('#KotaInfo').val('');
        }
    });

    // Kementerian change handler for Input modal
    $("#IdKementerian").change(function() {
        var idKementerian = $(this).val();
        var periode = $("#Periode").val();
        if (idKementerian && periode) {
            var [tahunMulai, tahunAkhir] = periode.split('|');
            populateProgramStrategis($("#IdProgramStrategis"), idKementerian, tahunMulai, tahunAkhir);
        } else {
            $("#IdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>');
            $('#ProvinsiInfo').val('');
            $('#KotaInfo').val('');
        }
    });

    // Periode change handler for Edit modal
    $("#EditPeriode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [tahunMulai, tahunAkhir] = periode.split('|');
            populateKementerian($("#EditIdKementerian"), tahunMulai, tahunAkhir);
            $("#EditIdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>');
            $('#EditProvinsiInfo').val('');
            $('#EditKotaInfo').val('');
        } else {
            $("#EditIdKementerian").empty().append('<option value="">-- Pilih Kementerian --</option>');
            $("#EditIdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>');
            $('#EditProvinsiInfo').val('');
            $('#EditKotaInfo').val('');
        }
    });

    // Kementerian change handler for Edit modal
    $("#EditIdKementerian").change(function() {
        var idKementerian = $(this).val();
        var periode = $("#EditPeriode").val();
        if (idKementerian && periode) {
            var [tahunMulai, tahunAkhir] = periode.split('|');
            populateProgramStrategis($("#EditIdProgramStrategis"), idKementerian, tahunMulai, tahunAkhir);
        } else {
            $("#EditIdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>');
            $('#EditProvinsiInfo').val('');
            $('#EditKotaInfo').val('');
        }
    });

    // Input Proyek Strategis
    $("#InputProyek").click(function() {
        var formValid = true;
        $("#formInputProyek [required]").each(function() {
            if (!$(this).val()) {
                $(this).addClass("is-invalid");
                formValid = false;
            } else {
                $(this).removeClass("is-invalid");
            }
        });

        if (!formValid) {
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        var [TahunMulai, TahunAkhir] = $("#Periode").val().split('|');
        var Data = {
            IdKementerian: $("#IdKementerian").val(),
            IdProgramStrategis: $("#IdProgramStrategis").val(),
            NamaProyek: $("#NamaProyek").val(),
            TahunMulai: TahunMulai,
            TahunAkhir: TahunAkhir,
            TargetTahun1: $("#TargetTahun1").val() || null,
            TargetTahun2: $("#TargetTahun2").val() || null,
            TargetTahun3: $("#TargetTahun3").val() || null,
            TargetTahun4: $("#TargetTahun4").val() || null,
            TargetTahun5: $("#TargetTahun5").val() || null
        };

        $.post(BaseURL + "Super/InputProyek", Data)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert("Terjadi kesalahan saat mengirim data");
            });
    });

    // Edit Proyek Strategis
    $(document).on("click", ".Edit", function() {
        var data = $(this).data();
        
        $("#EditId").val(data.id);
        $("#EditNamaProyek").val(data.proyek);
        $("#EditPeriode").val(data.tahunmulai + '|' + data.tahunakhir);
        $("#EditTargetTahun1").val(data.target1);
        $("#EditTargetTahun2").val(data.target2);
        $("#EditTargetTahun3").val(data.target3);
        $("#EditTargetTahun4").val(data.target4);
        $("#EditTargetTahun5").val(data.target5);

        // Populate Kementerian based on Periode
        populateKementerian($("#EditIdKementerian"), data.tahunmulai, data.tahunakhir, data.kementerian);

        // Populate Program Strategis based on Kementerian and Periode
        populateProgramStrategis($("#EditIdProgramStrategis"), data.kementerian, data.tahunmulai, data.tahunakhir, data.program);

        // Set location info
        $('#EditProvinsiInfo').val($(this).data('namaprovinsi') || '-');
        $('#EditKotaInfo').val($(this).data('namakota') || '-');

        $('#ModalEditProyek').modal("show");
    });

    // Update Proyek Strategis
    $("#UpdateProyek").click(function() {
        var formValid = true;
        $("#formEditProyek [required]").each(function() {
            if (!$(this).val()) {
                $(this).addClass("is-invalid");
                formValid = false;
            } else {
                $(this).removeClass("is-invalid");
            }
        });

        if (!formValid) {
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        var [TahunMulai, TahunAkhir] = $("#EditPeriode").val().split('|');
        var Data = {
            Id: $("#EditId").val(),
            IdKementerian: $("#EditIdKementerian").val(),
            IdProgramStrategis: $("#EditIdProgramStrategis").val(),
            NamaProyek: $("#EditNamaProyek").val(),
            TahunMulai: TahunMulai,
            TahunAkhir: TahunAkhir,
            TargetTahun1: $("#EditTargetTahun1").val() || null,
            TargetTahun2: $("#EditTargetTahun2").val() || null,
            TargetTahun3: $("#EditTargetTahun3").val() || null,
            TargetTahun4: $("#EditTargetTahun4").val() || null,
            TargetTahun5: $("#EditTargetTahun5").val() || null
        };

        $.post(BaseURL + "Super/UpdateProyek", Data)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert("Terjadi kesalahan saat mengirim data");
            });
    });

    // Delete Proyek Strategis
    $(document).on("click", ".Hapus", function() {
        if (confirm('Apakah Anda yakin ingin menghapus proyek ini?')) {
            var Proyek = { 
                Id: $(this).data('id') 
            };
            
            $.post(BaseURL + "Super/DeleteProyek", Proyek)
                .done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                })
                .fail(function() {
                    alert("Terjadi kesalahan saat menghapus data");
                });
        }
    });
});
</script>