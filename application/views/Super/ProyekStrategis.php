
<!-- Breadcrumb -->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <ul class="breadcomb-menu" style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: inline-block; margin-right: 5px;">
                            <a href="<?= base_url('Super') ?>">Beranda</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block; margin-right: 5px;">
                            <a href="<?= base_url('Super/Kementerian') ?>">Kementerian</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block;">
                            <span class="bread-blk">Proyek Strategis</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-primary notika-btn-primary" id="FilterProyek">
                                <i class="notika-icon notika-search"></i> 
                                <b>Filter Data</b>
                                <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                    <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                <?php endif; ?>
                            </button>
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputProyek">
                                <i class="notika-icon notika-edit"></i> <b>Input Proyek Strategis</b>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Filter -->
                    <div class="modal fade" id="ModalFilter" role="dialog">
                        <div class="modal-dialog modals-default">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Filter Data Proyek Strategis</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-example-wrap">
                                                <div class="form-example-int">
                                                    <div class="form-group">
                                                        <label>Periode</label>
                                                        <select class="form-control" id="FilterPeriode">
                                                            <option value="">Semua Periode</option>
                                                            <?php foreach ($Periode as $periode): ?>
                                                                <?php 
                                                                    $periodeValue = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                                    $selected = ($CurrentPeriode == $periodeValue) ? 'selected' : '';
                                                                ?>
                                                                <option value="<?= $periodeValue ?>" <?= $selected ?>>
                                                                    <?= $periode['TahunMulai'] ?> - <?= $periode['TahunAkhir'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-example-int">
                                                    <div class="form-group">
                                                        <label>Kementerian</label>
                                                        <select class="form-control" id="FilterKementerianSelect" <?= empty($Kementerian) && !$CurrentKementerian ? 'disabled' : '' ?>>
                                                            <option value="">Semua Kementerian</option>
                                                            <?php if (!empty($Kementerian)): ?>
                                                                <?php foreach ($Kementerian as $kementerian): ?>
                                                                    <?php $selected = ($CurrentKementerian == $kementerian['Id']) ? 'selected' : ''; ?>
                                                                    <option value="<?= $kementerian['Id'] ?>" <?= $selected ?>>
                                                                        <?= $kementerian['NamaKementerian'] ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-example-int mg-t-15">
                                                    <button class="btn btn-success notika-btn-success" id="ApplyFilter">Terapkan Filter</button>
                                                    <button class="btn btn-danger notika-btn-danger" id="ResetFilter">Reset Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <td class="text-center"><?= $No++ ?></td>
                                    <td><?= $key['NamaKementerian'] ?></td>
                                    <td><?= $key['NamaProgram'] ?></td>
                                    <td><?= $key['NamaProyek'] ?></td>
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
                                                    data-program="<?= $key['IdProgramStrategis'] ?>"
                                                    data-proyek="<?= $key['NamaProyek'] ?>"
                                                    data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                    data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                    data-target1="<?= $key['TargetTahun1'] ?>"
                                                    data-target2="<?= $key['TargetTahun2'] ?>"
                                                    data-target3="<?= $key['TargetTahun3'] ?>"
                                                    data-target4="<?= $key['TargetTahun4'] ?>"
                                                    data-target5="<?= $key['TargetTahun5'] ?>"
                                                    data-namaprovinsi="<?= $key['NamaProvinsi'] ?>"
                                                    data-namakota="<?= $key['NamaKota'] ?>">
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
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Input Proyek Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formInputProyek">
                    <div class="form-example-wrap">
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
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Proyek Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formEditProyek">
                    <input type="hidden" id="EditId">
                    <input type="hidden" id="EditIdKementerian">
                    <input type="hidden" id="EditTahunMulai">
                    <input type="hidden" id="EditTahunAkhir">
                    <div class="form-example-wrap">
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
$(document).ready(function() {
    var BaseURL = '<?= base_url() ?>';
    var CurrentPeriode = '<?= $CurrentPeriode ?>';
    var CurrentKementerian = '<?= $CurrentKementerian ?>';

    // Function to populate Kementerian dropdown for filter modal
    function populateKementerian(periode, selectElement, selectedId = '') {
        if (periode) {
            $.post(BaseURL + "Super/GetKementerianByPeriode", {
                periode: periode
            }, function(response) {
                var kementerian = JSON.parse(response);
                selectElement.empty().append('<option value="">Semua Kementerian</option>');
                if (kementerian.length > 0) {
                    $.each(kementerian, function(index, item) {
                        var isSelected = (item.Id == selectedId) ? 'selected' : '';
                        selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                    });
                    selectElement.prop('disabled', false);
                } else {
                    selectElement.append('<option value="">Tidak ada kementerian</option>');
                    selectElement.prop('disabled', true);
                }
            });
        } else {
            selectElement.empty().append('<option value="">Semua Kementerian</option>');
            selectElement.prop('disabled', true);
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
                $.each(program, function(index, item) {
                    var isSelected = (item.Id == selectedId) ? 'selected' : '';
                    selectElement.append('<option value="' + item.Id + '" ' + isSelected + 
                                        ' data-provinsi="' + (item.KodeWilayah || '') + '"' +
                                        ' data-kota="' + (item.KodeKota || '') + '"' +
                                        ' data-namaprovinsi="' + (item.NamaProvinsi || '-') + '"' +
                                        ' data-namakota="' + (item.NamaKota || '-') + '">' + 
                                        item.NamaProgram + '</option>');
                });
                // Trigger change to set location info for edit modal
                if (selectedId) {
                    selectElement.trigger('change');
                }
            });
        } else {
            selectElement.empty().append('<option value="">-- Pilih Program Strategis --</option>');
        }
    }

    // Show filter modal
    $("#FilterProyek").click(function() {
        $('#ModalFilter').modal("show");
    });

    // Load Kementerian when Periode filter changes
    $("#FilterPeriode").change(function() {
        var periode = $(this).val();
        populateKementerian(periode, $("#FilterKementerianSelect"));
    });

    // Apply filter
    $("#ApplyFilter").click(function() {
        var periode = $("#FilterPeriode").val();
        var kementerian = $("#FilterKementerianSelect").val();
        var url = BaseURL + "Super/ProyekStrategis?";
        
        if (periode) url += "periode=" + encodeURIComponent(periode) + "&";
        if (kementerian) url += "kementerian=" + encodeURIComponent(kementerian);
        
        window.location.href = url;
    });

    // Reset filter
    $("#ResetFilter").click(function() {
        window.location.href = BaseURL + "Super/ProyekStrategis";
    });

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

    // Populate Program Strategis for input modal on page load if filter is active
    if (CurrentPeriode && CurrentKementerian) {
        var [tahunMulai, tahunAkhir] = CurrentPeriode.split('|');
        populateProgramStrategis($("#IdProgramStrategis"), CurrentKementerian, tahunMulai, tahunAkhir);
    }

    // Input Proyek Strategis
    $("#InputProyek").click(function() {
        if (!CurrentPeriode || !CurrentKementerian) {
            alert('Pilih Periode dan Kementerian terlebih dahulu di filter!');
            return;
        }
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

        var [TahunMulai, TahunAkhir] = CurrentPeriode.split('|');
        var Data = {
            IdKementerian: CurrentKementerian,
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
        $("#EditIdKementerian").val(data.kementerian);
        $("#EditTahunMulai").val(data.tahunmulai);
        $("#EditTahunAkhir").val(data.tahunakhir);
        $("#EditNamaProyek").val(data.proyek);
        $("#EditTargetTahun1").val(data.target1);
        $("#EditTargetTahun2").val(data.target2);
        $("#EditTargetTahun3").val(data.target3);
        $("#EditTargetTahun4").val(data.target4);
        $("#EditTargetTahun5").val(data.target5);

        // Set initial location info
        $('#EditProvinsiInfo').val(data.namaprovinsi || '-');
        $('#EditKotaInfo').val(data.namakota || '-');

        // Populate Program Strategis
        populateProgramStrategis($("#EditIdProgramStrategis"), data.kementerian, data.tahunmulai, data.tahunakhir, data.program);

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

        var Data = {
            Id: $("#EditId").val(),
            IdKementerian: $("#EditIdKementerian").val(),
            IdProgramStrategis: $("#EditIdProgramStrategis").val(),
            NamaProyek: $("#EditNamaProyek").val(),
            TahunMulai: $("#EditTahunMulai").val(),
            TahunAkhir: $("#EditTahunAkhir").val(),
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