<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsuKLHS">
                                <i class="notika-icon notika-edit"></i> <b>Input Isu KLHS</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Isu KLHS</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($IsuKLHS as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaIsuKLHS'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?= $key['Id'] . '|' . $key['NamaIsuKLHS'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] ?>"><i class="notika-icon notika-next"></i></button>
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

<!-- Modal Input Isu KLHS -->
<div class="modal fade" id="ModalInputIsuKLHS" role="dialog">
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
                                                <select class="form-control" id="PeriodeRPJMD">
                                                    <option value="">-- Pilih Periode RPJMD --</option>
                                                    <?php foreach ($Periods as $period) { ?>
                                                        <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                            <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" id="TahunMulai">
                                                <input type="hidden" id="TahunAkhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Isu KLHS</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <br>
                                                <input type="text" class="form-control input-sm" id="NamaIsuKLHS" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="InputIsuKLHS"><b>SIMPAN</b></button>
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

<!-- Modal Edit Isu KLHS -->
<div class="modal fade" id="ModalEditIsuKLHS" role="dialog">
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
                                                <select class="form-control" id="EditPeriodeRPJMD">
                                                    <option value="">-- Pilih Periode RPJMD --</option>
                                                    <?php foreach ($Periods as $period) { ?>
                                                        <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                            <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" id="EditTahunMulai">
                                                <input type="hidden" id="EditTahunAkhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Isu KLHS</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" id="EditId">
                                                <input type="text" class="form-control input-sm" id="EditNamaIsuKLHS" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="UpdateIsuKLHS"><b>UPDATE</b></button>
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
    
    // Set tahun saat periode dipilih (Input)
    $("#PeriodeRPJMD").change(function() {
        if ($(this).val()) {
            var years = $(this).val().split('-');
            $("#TahunMulai").val(years[0]);
            $("#TahunAkhir").val(years[1]);
        }
    });

    // Set tahun saat periode dipilih (Edit)
    $("#EditPeriodeRPJMD").change(function() {
        if ($(this).val()) {
            var years = $(this).val().split('-');
            $("#EditTahunMulai").val(years[0]);
            $("#EditTahunAkhir").val(years[1]);
        }
    });

    // Input Isu KLHS
$("#InputIsuKLHS").click(function() {
    if ($("#PeriodeRPJMD").val() === "") {
        alert('Pilih Periode RPJMD terlebih dahulu!');
        return;
    } else if ($("#NamaIsuKLHS").val() === "") {
        alert('Nama Isu KLHS harus diisi!');
        return;
    } else {
        var Data = {
            PeriodeRPJMD: $("#PeriodeRPJMD").val(),
            NamaIsuKLHS: $("#NamaIsuKLHS").val()
        };
        $.post(BaseURL + "Admin/InputIsuKLHS", Data).done(function(Respon) {
            if (Respon == '1') {
                // Reset form input
                $("#PeriodeRPJMD").val('').trigger('change');
                $("#NamaIsuKLHS").val('');
                $("#TahunMulai").val('');
                $("#TahunAkhir").val('');
                
                // Tutup modal
                $('#ModalInputIsuKLHS').modal('hide');
                
                // Reload data
                window.location.reload();
            } else {
                alert(Respon);
            }
        });
    }
});

    // Edit Isu KLHS
    $(document).on("click", ".Edit", function() {
        var Data = $(this).attr('Edit').split("|");
        $("#EditId").val(Data[0]);
        $("#EditNamaIsuKLHS").val(Data[1]);
        $("#EditPeriodeRPJMD").val(Data[2] + '-' + Data[3]);
        $("#EditTahunMulai").val(Data[2]);
        $("#EditTahunAkhir").val(Data[3]);
        $('#ModalEditIsuKLHS').modal("show");
    });

    // Update Isu KLHS
$("#UpdateIsuKLHS").click(function() {
    if ($("#EditPeriodeRPJMD").val() === "") {
        alert('Pilih Periode RPJMD terlebih dahulu!');
        return;
    } else if ($("#EditNamaIsuKLHS").val() === "") {
        alert('Nama Isu KLHS harus diisi!');
        return;
    } else {
        var Data = {
            Id: $("#EditId").val(),
            EditPeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
            NamaIsuKLHS: $("#EditNamaIsuKLHS").val()
        };
        $.post(BaseURL + "Admin/UpdateIsuKLHS", Data).done(function(Respon) {
            if (Respon == '1') {
                // Reset form edit
                $("#EditPeriodeRPJMD").val('').trigger('change');
                $("#EditNamaIsuKLHS").val('');
                $("#EditTahunMulai").val('');
                $("#EditTahunAkhir").val('');
                
                // Tutup modal
                $('#ModalEditIsuKLHS').modal('hide');
                
                // Reload data
                window.location.reload();
            } else {
                alert(Respon);
            }
        });
    }
});

    // Hapus Isu KLHS
    $(".Hapus").click(function() {
        
            var Id = { Id: $(this).attr('Hapus') };
            $.post(BaseURL + "Admin/DeleteIsuKLHS", Id).done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            });
        }
    );

    // Reset form saat modal ditutup
    $('#ModalInputIsuKLHS').on('hidden.bs.modal', function () {
    $("#PeriodeRPJMD").val('').trigger('change');
    $("#NamaIsuKLHS").val('');
});

$('#ModalEditIsuKLHS').on('hidden.bs.modal', function () {
    $("#EditPeriodeRPJMD").val('').trigger('change');
    $("#EditNamaIsuKLHS").val('');
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