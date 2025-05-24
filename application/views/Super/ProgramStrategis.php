<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputProgram">
                                <i class="notika-icon notika-edit"></i> <b>Input Program Strategis</b>
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
                                <?php $No = 1; foreach ($Program as $key) { ?>
                                <tr>
                                    <td class="text-center"><?= $No++ ?></td>
                                    <td><?= $key['NamaKementerian'] ?></td>
                                    <td><?= $key['NamaProgram'] ?></td>
                                    <td><?= $key['NamaProvinsi'] ?></td>
                                    <td><?= $key['NamaKota'] ?></td>
                                    <td class="text-center"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td class="text-center"><?= $key['TargetTahun1'] ?? '-' ?></td>
                                    <td class="text-center"><?= $key['TargetTahun2'] ?? '-' ?></td>
                                    <td class="text-center"><?= $key['TargetTahun3'] ?? '-' ?></td>
                                    <td class="text-center"><?= $key['TargetTahun4'] ?? '-' ?></td>
                                    <td class="text-center"><?= $key['TargetTahun5'] ?? '-' ?></td>
                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['Id'] ?>"
                                                    data-kementerian="<?= $key['IdKementerian'] ?>"
                                                    data-program="<?= $key['NamaProgram'] ?>"
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

<!-- Modal Input Program Strategis -->
<div class="modal fade" id="ModalInputProgram" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Input Program Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formInputProgram">
                    <div class="form-example-wrap">
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

                        <!-- Location Selection -->
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select class="form-control" id="Provinsi">
                                <option value="">Pilih Provinsi (Opsional)</option>
                                <?php foreach ($Provinsi as $prov) { ?>
                                    <option value="<?= $prov['Kode'] ?>"><?= $prov['Nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kota/Kabupaten</label>
                            <select class="form-control" id="Kota" disabled>
                                <option value="">Pilih Kota/Kabupaten (Opsional)</option>
                            </select>
                        </div>

                        <!-- Program Name -->
                        <div class="form-group">
                            <label>Nama Program</label>
                            <input type="text" class="form-control" id="NamaProgram" required>
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
                <button type="button" class="btn btn-success" id="InputProgram">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Program Strategis -->
<div class="modal fade" id="ModalEditProgram" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Program Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formEditProgram">
                    <input type="hidden" id="EditId">
                    <div class="form-example-wrap">
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

                        <!-- Location Selection -->
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select class="form-control" id="EditProvinsi">
                                <option value="">Pilih Provinsi (Opsional)</option>
                                <?php foreach ($Provinsi as $prov) { ?>
                                    <option value="<?= $prov['Kode'] ?>"><?= $prov['Nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kota/Kabupaten</label>
                            <select class="form-control" id="EditKota" disabled>
                                <option value="">Pilih Kota/Kabupaten (Opsional)</option>
                            </select>
                        </div>

                        <!-- Program Name -->
                        <div class="form-group">
                            <label>Nama Program</label>
                            <input type="text" class="form-control" id="EditNamaProgram" required>
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
                <button type="button" class="btn btn-success" id="UpdateProgram">Update</button>
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

    // Function to populate Kota dropdown based on selected Provinsi
    function populateKota(provinsiKode, selectElement, selectedKota = '') {
        if (provinsiKode) {
            $.post(BaseURL + "Super/GetKotaByProvinsi", { 
                kode_provinsi: provinsiKode 
            }, function(response) {
                var kotaData = JSON.parse(response);
                selectElement.empty().append('<option value="">Pilih Kota/Kabupaten (Opsional)</option>');
                $.each(kotaData, function(index, item) {
                    var isSelected = (item.Kode == selectedKota) ? 'selected' : '';
                    selectElement.append('<option value="' + item.Kode + '" ' + isSelected + '>' + item.Nama + '</option>');
                });
                selectElement.prop('disabled', false);
            });
        } else {
            selectElement.empty().append('<option value="">Pilih Kota/Kabupaten (Opsional)</option>').prop('disabled', true);
        }
    }

    // Periode change handler for Input modal
    $("#Periode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [tahunMulai, tahunAkhir] = periode.split('|');
            populateKementerian($("#IdKementerian"), tahunMulai, tahunAkhir);
        } else {
            $("#IdKementerian").empty().append('<option value="">-- Pilih Kementerian --</option>');
        }
    });

    // Periode change handler for Edit modal
    $("#EditPeriode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [tahunMulai, tahunAkhir] = periode.split('|');
            populateKementerian($("#EditIdKementerian"), tahunMulai, tahunAkhir);
        } else {
            $("#EditIdKementerian").empty().append('<option value="">-- Pilih Kementerian --</option>');
        }
    });

    // Provinsi change handler for Input modal
    $("#Provinsi").change(function() {
        var provinsiKode = $(this).val();
        populateKota(provinsiKode, $("#Kota"));
    });

    // Provinsi change handler for Edit modal
    $("#EditProvinsi").change(function() {
        var provinsiKode = $(this).val();
        populateKota(provinsiKode, $("#EditKota"));
    });

    // Edit Program Strategis
    $(document).on("click", ".Edit", function() {
        var data = $(this).data();
        
        $("#EditId").val(data.id);
        $("#EditNamaProgram").val(data.program);
        $("#EditPeriode").val(data.tahunmulai + '|' + data.tahunakhir);
        $("#EditTargetTahun1").val(data.target1);
        $("#EditTargetTahun2").val(data.target2);
        $("#EditTargetTahun3").val(data.target3);
        $("#EditTargetTahun4").val(data.target4);
        $("#EditTargetTahun5").val(data.target5);
        $("#EditProvinsi").val(data.provinsi);

        // Populate Kementerian based on Periode
        populateKementerian($("#EditIdKementerian"), data.tahunmulai, data.tahunakhir, data.kementerian);

        // Populate Kota based on Provinsi
        populateKota(data.provinsi, $("#EditKota"), data.kota);

        $('#ModalEditProgram').modal("show");
    });

    // Input Program Strategis
    $("#InputProgram").click(function() {
        var formValid = true;
        $("#formInputProgram [required]").each(function() {
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
            KodeWilayah: $("#Provinsi").val() || null,
            KodeKota: $("#Kota").val() || null,
            NamaProgram: $("#NamaProgram").val(),
            TahunMulai: TahunMulai,
            TahunAkhir: TahunAkhir,
            TargetTahun1: $("#TargetTahun1").val() || null,
            TargetTahun2: $("#TargetTahun2").val() || null,
            TargetTahun3: $("#TargetTahun3").val() || null,
            TargetTahun4: $("#TargetTahun4").val() || null,
            TargetTahun5: $("#TargetTahun5").val() || null
        };

        $.post(BaseURL + "Super/InputProgram", Data)
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

    // Update Program Strategis
    $("#UpdateProgram").click(function() {
        var formValid = true;
        $("#formEditProgram [required]").each(function() {
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
            KodeWilayah: $("#EditProvinsi").val() || null,
            KodeKota: $("#EditKota").val() || null,
            NamaProgram: $("#EditNamaProgram").val(),
            TahunMulai: TahunMulai,
            TahunAkhir: TahunAkhir,
            TargetTahun1: $("#EditTargetTahun1").val() || null,
            TargetTahun2: $("#EditTargetTahun2").val() || null,
            TargetTahun3: $("#EditTargetTahun3").val() || null,
            TargetTahun4: $("#EditTargetTahun4").val() || null,
            TargetTahun5: $("#EditTargetTahun5").val() || null
        };

        $.post(BaseURL + "Super/UpdateProgram", Data)
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

    // Delete Program Strategis
    $(document).on("click", ".Hapus", function() {
        if (confirm('Apakah Anda yakin ingin menghapus program ini?')) {
            var Program = { 
                Id: $(this).data('id') 
            };
            
            $.post(BaseURL + "Super/DeleteProgram", Program)
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




