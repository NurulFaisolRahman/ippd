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
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaProgram'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun1'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun2'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun3'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun4'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun5'] ?></td>
                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?= $key['Id'] . '|' . $key['IdKementerian'] . '|' . $key['NamaProgram'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] . '|' . $key['TargetTahun1'] . '|' . $key['TargetTahun2'] . '|' . $key['TargetTahun3'] . '|' . $key['TargetTahun4'] . '|' . $key['TargetTahun5'] ?>"><i class="notika-icon notika-next"></i></button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?= $key['Id'] ?>"><i class="notika-icon notika-trash"></i></button>
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
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
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
                                                <select class="form-control" id="Periode">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($Periode as $periode) { ?>
                                                        <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>"><?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?></option>
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
                                            <label class="hrzn-fm"><b>Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="IdKementerian">
                                                    <option value="">-- Pilih Kementerian --</option>
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
                                            <label class="hrzn-fm"><b>Nama Program</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="NamaProgram">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 1</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TargetTahun1" placeholder="Target Tahun 1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 2</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TargetTahun2" placeholder="Target Tahun 2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 3</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TargetTahun3" placeholder="Target Tahun 3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 4</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TargetTahun4" placeholder="Target Tahun 4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 5</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TargetTahun5" placeholder="Target Tahun 5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="InputProgram"><b>SIMPAN</b></button>
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

<!-- Modal Edit Program Strategis -->
<div class="modal fade" id="ModalEditProgram" role="dialog">
    <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
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
                                                <select class="form-control" id="EditPeriode">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($Periode as $periode) { ?>
                                                        <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>"><?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?></option>
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
                                            <label class="hrzn-fm"><b>Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditIdKementerian">
                                                    <option value="">-- Pilih Kementerian --</option>
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
                                            <label class="hrzn-fm"><b>Nama Program</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" id="EditId">
                                                <input type="text" class="form-control input-sm" id="EditNamaProgram">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 1</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditTargetTahun1" placeholder="Target Tahun 1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 2</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditTargetTahun2" placeholder="Target Tahun 2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 3</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditTargetTahun3" placeholder="Target Tahun 3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 4</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditTargetTahun4" placeholder="Target Tahun 4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Tahun 5</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditTargetTahun5" placeholder="Target Tahun 5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="UpdateProgram"><b>UPDATE</b></button>
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
    jQuery(document).ready(function($) {
        // Function to populate Kementerian dropdown
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

        // Input Program Strategis
        $("#InputProgram").click(function() {
            if ($("#Periode").val() === "") {
                alert('Pilih Periode terlebih dahulu!');
                return;
            } else if ($("#IdKementerian").val() === "") {
                alert('Pilih Kementerian terlebih dahulu!');
                return;
            } else if ($("#NamaProgram").val() === "") {
                alert('Input Nama Program Belum Benar!');
                return;
            } else {
                var [TahunMulai, TahunAkhir] = $("#Periode").val().split('|');
                var Data = {
                    IdKementerian: $("#IdKementerian").val(),
                    NamaProgram: $("#NamaProgram").val(),
                    TahunMulai: TahunMulai,
                    TahunAkhir: TahunAkhir,
                    TargetTahun1: $("#TargetTahun1").val(),
                    TargetTahun2: $("#TargetTahun2").val(),
                    TargetTahun3: $("#TargetTahun3").val(),
                    TargetTahun4: $("#TargetTahun4").val(),
                    TargetTahun5: $("#TargetTahun5").val()
                };
                $.post(BaseURL + "Super/InputProgram", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            }
        });

        // Edit Program Strategis
        $(document).on("click", ".Edit", function() {
            var Data = $(this).attr('Edit');
            var Pisah = Data.split("|");
            $("#EditId").val(Pisah[0]);
            $("#EditNamaProgram").val(Pisah[2]);
            $("#EditTargetTahun1").val(Pisah[5]);
            $("#EditTargetTahun2").val(Pisah[6]);
            $("#EditTargetTahun3").val(Pisah[7]);
            $("#EditTargetTahun4").val(Pisah[8]);
            $("#EditTargetTahun5").val(Pisah[9]);
            var periode = Pisah[3] + '|' + Pisah[4];
            $("#EditPeriode").val(periode);
            populateKementerian($("#EditIdKementerian"), Pisah[3], Pisah[4], Pisah[1]);
            $('#ModalEditProgram').modal("show");
        });

        // Update Program Strategis
        $("#UpdateProgram").click(function() {
            if ($("#EditPeriode").val() === "") {
                alert('Pilih Periode terlebih dahulu!');
                return;
            } else if ($("#EditIdKementerian").val() === "") {
                alert('Pilih Kementerian terlebih dahulu!');
                return;
            } else if ($("#EditNamaProgram").val() === "") {
                alert('Input Nama Program Belum Benar!');
                return;
            } else {
                var [TahunMulai, TahunAkhir] = $("#EditPeriode").val().split('|');
                var Data = {
                    Id: $("#EditId").val(),
                    IdKementerian: $("#EditIdKementerian").val(),
                    NamaProgram: $("#EditNamaProgram").val(),
                    TahunMulai: TahunMulai,
                    TahunAkhir: TahunAkhir,
                    TargetTahun1: $("#EditTargetTahun1").val(),
                    TargetTahun2: $("#EditTargetTahun2").val(),
                    TargetTahun3: $("#EditTargetTahun3").val(),
                    TargetTahun4: $("#EditTargetTahun4").val(),
                    TargetTahun5: $("#EditTargetTahun5").val()
                };
                $.post(BaseURL + "Super/UpdateProgram", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            }
        });

        // Delete Program Strategis
        $(".Hapus").click(function() {
                var Misi = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Super/DeleteProgramStrategis", Misi).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Super/ProgramStrategis"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
    });
</script>