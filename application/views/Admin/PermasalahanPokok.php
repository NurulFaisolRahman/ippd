<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputPermasalahanPokok">
                                <i class="notika-icon notika-edit"></i> <b>Input Permasalahan Pokok</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Permasalahan Pokok</th>
                                    <th>Permasalahan Pokok Nasional</th>
                                    <th>Kemeneterian</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($PermasalahanPokok as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaPermasalahanPokok'] ?></td>
                                    <td style="vertical-align: middle;">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="Accrodion<?=$No?>" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#Accrodion<?=$No?>" href="#_Accrodion<?=$No?>" aria-expanded="true">Lihat Permasalahan</a></b>
                                                    </div>
                                                    <div id="_Accrodion<?=$No?>" class="collapse" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px;">
                                                            <?php $_Id = explode("$",$key['_Id']); foreach ($_Id as $x) { ?>
                                                                <div class="nk-int-st text-justify"><?= $Permasalahan[$x] ?></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $Kementerian[explode("$",$key['_Id'])[0]] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?= $key['Id'] . '|' . $key['NamaPermasalahanPokok'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] . '|' . $key['_Id'] ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?= $key['Id'] ?>">
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

<!-- Modal Input Permasalahan Pokok -->
<div class="modal fade" id="ModalInputPermasalahanPokok" role="dialog">
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
                                            <label class="hrzn-fm"><b>Periode </b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodeRPJMD"data-style="btn-default" style="color: #000 !important;">
                                                    <option value="">-- Pilih Periode --</option>
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
                                            <label class="hrzn-fm"><b>Nama Permasalahan Pokok</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <br>
                                            <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="NamaPermasalahanPokok" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode </b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodePermasalahanPokokNasional"data-style="btn-default" style="color: #000 !important;">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($PeriodePermasalahanPokokNasional as $key) { ?>
                                                        <option value="<?= $key['TahunMulai'] ?>">
                                                            <?=$key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
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
                                            <label class="hrzn-fm"><b>Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Kementerian" data-style="btn-default" style="color: #000 !important;">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="hrzn-fm"><b>Permasalahan Pokok Nasional</b></label>
                                </div>
                                <div style="margin-top: 3px;" class="col-lg-9">
                                    <div class="accordion-stn">
                                        <div class="panel-group" data-collapse-color="nk-green" id="AccrodionPermasalahanPokokNasional" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-collapse notika-accrodion-cus">
                                                <div class="panel-heading" role="tab">
                                                    <b><a data-toggle="collapse" data-parent="#AccrodionPermasalahanPokokNasional" href="#PilihPermasalahanPokokNasional" aria-expanded="true">Pilih Permasalahan</a></b>
                                                </div>
                                                <div id="PilihPermasalahanPokokNasional" class="collapse in" role="tabpanel">
                                                    <div class="panel-body" style="padding-top: 0px;">
                                                        <div class="nk-int-st text-justify" id="ListPermasalahanPokokNasional"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="InputPermasalahanPokok"><b>SIMPAN</b></button>
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

<!-- Modal Edit Permasalahan Pokok -->
<div class="modal fade" id="ModalEditPermasalahanPokok" role="dialog">
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
                                                <select class="form-control" id="EditPeriodeRPJMD" data-style="btn-default" style="color: #000 !important;">
                                                    <option value="">-- Pilih Periode  --</option>
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
                                            <label class="hrzn-fm"><b>Nama Permasalahan Pokok</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" id="EditId">
                                                <br>
                                                <input type="text" class="form-control input-sm" id="EditNamaPermasalahanPokok" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode </b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditPeriodePermasalahanPokokNasional"data-style="btn-default" style="color: #000 !important;">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($PeriodePermasalahanPokokNasional as $key) { ?>
                                                        <option value="<?= $key['TahunMulai'] ?>">
                                                            <?=$key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
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
                                            <label class="hrzn-fm"><b>Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditKementerian" data-style="btn-default" style="color: #000 !important;">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="hrzn-fm"><b>Permasalahan Pokok Nasional</b></label>
                                </div>
                                <div style="margin-top: 3px;" class="col-lg-9">
                                    <div class="accordion-stn">
                                        <div class="panel-group" data-collapse-color="nk-green" id="EditAccrodionPermasalahanPokokNasional" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-collapse notika-accrodion-cus">
                                                <div class="panel-heading" role="tab">
                                                    <b><a data-toggle="collapse" data-parent="#EditAccrodionPermasalahanPokokNasional" href="#EditPilihPermasalahanPokokNasional" aria-expanded="true">Pilih Permasalahan</a></b>
                                                </div>
                                                <div id="EditPilihPermasalahanPokokNasional" class="collapse in" role="tabpanel">
                                                    <div class="panel-body" style="padding-top: 0px;">
                                                        <div class="nk-int-st text-justify" id="EditListPermasalahanPokokNasional"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="UpdatePermasalahanPokok"><b>UPDATE</b></button>
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
    
    $("#PeriodePermasalahanPokokNasional").change(function(){
        if ($("#PeriodePermasalahanPokokNasional").val() == "") {
            alert("Mohon Input Periode")
        } else {
            $.post(BaseURL+"Admin/GetKementerian", {TahunMulai : $("#PeriodePermasalahanPokokNasional").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Kementerian = '<option value=""> --Pilih Kementerian-- </option>'
                for (let i = 0; i < Data.length; i++) {
                    Kementerian += '<option value="'+Data[i].Id+'">'+Data[i].NamaKementerian+'</option>'
                }
                $("#Kementerian").html(Kementerian)
            })                         
        }
    });

    $("#Kementerian").change(function(){
        if ($("#Kementerian").val() == "") {
            alert("Mohon Input Periode")
        } else {
            $.post(BaseURL+"Admin/GetPermasalahanPokokNasional", {Id : $("#Kementerian").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Permasalahan = ''
                for (let i = 0; i < Data.length; i++) {
                    Permasalahan += '<label><input style="margin-top: 10px;" type="checkbox" name="Permasalahan" value="'+Data[i].Id+'"> '+Data[i].NamaPermasalahanPokok+'</label><br>'
                }
                $("#ListPermasalahanPokokNasional").html(Permasalahan)
            })                         
        }
    });

    // Set tahun saat memilih periode
    $("#PeriodeRPJMD").change(function() {
        if ($(this).val()) {
            var years = $(this).val().split('-');
            $("#TahunMulai").val(years[0]);
            $("#TahunAkhir").val(years[1]);
        } else {
            $("#TahunMulai").val('');
            $("#TahunAkhir").val('');
        }
    });

    // Set tahun saat edit periode dipilih
    $("#EditPeriodeRPJMD").change(function() {
        if ($(this).val()) {
            var years = $(this).val().split('-');
            $("#EditTahunMulai").val(years[0]);
            $("#EditTahunAkhir").val(years[1]);
        } else {
            $("#EditTahunMulai").val('');
            $("#EditTahunAkhir").val('');
        }
    });

    // Input Permasalahan Pokok
    $("#InputPermasalahanPokok").click(function() {
        var PermasalahanPokokNasional = []
        $.each($("input[name='Permasalahan']:checked"), function(){
            PermasalahanPokokNasional.push($(this).val())
        })
        if ($("#PeriodeRPJMD").val() === "") {
            alert('Pilih Periode RPJMD terlebih dahulu!');
            return;
        } else if ($("#NamaPermasalahanPokok").val() === "") {
            alert('Nama Permasalahan Pokok harus diisi!');
            return;
        } else if ($("#PeriodePermasalahanPokokNasional").val() === "") {
            alert('Pilih Periode Kementerian!');
            return;
        } else if ($("#Kementerian").val() === "") {
            alert('Pilih Kementerian!');
            return;
        } else if (!PermasalahanPokokNasional.length) {
            alert("Mohon Checklist Permasalahan Pokok Nasional!")
        } else {
            var Data = {
                PeriodeRPJMD: $("#PeriodeRPJMD").val(),
                NamaPermasalahanPokok: $("#NamaPermasalahanPokok").val(),
                _Id    : PermasalahanPokokNasional.join("$"),
            };
            $.post(BaseURL + "Admin/InputPermasalahanPokok", Data).done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            });
        }
    });

    // Edit Permasalahan Pokok
    $(document).on("click", ".Edit", function() {
        var Data = $(this).attr('Edit');
        var Pisah = Data.split("|");
        $("#EditId").val(Pisah[0]);
        $("#EditNamaPermasalahanPokok").val(Pisah[1]);
        $("#EditPeriodeRPJMD").val(Pisah[2] + '-' + Pisah[3]);
        $("#EditTahunMulai").val(Pisah[2]);
        $("#EditTahunAkhir").val(Pisah[3]);
        console.log(Pisah[4])
        $.post(BaseURL+"Admin/GetPeriodePermasalahanPokokNasional", {Id : Pisah[4].split("$")[0]}).done(function(Respon) {
            var Data = JSON.parse(Respon)
            $("#EditPeriodePermasalahanPokokNasional").val(Data[0].TahunMulai);
            $.post(BaseURL+"Admin/GetKementerian", {TahunMulai : $("#EditPeriodePermasalahanPokokNasional").val()}).done(function(Respon) {
                var _Data = JSON.parse(Respon)
                var Kementerian = '<option value=""> --Pilih Kementerian-- </option>'
                for (let i = 0; i < _Data.length; i++) {
                    Kementerian += '<option value="'+_Data[i].Id+'">'+_Data[i].NamaKementerian+'</option>'
                }
                $("#EditKementerian").html(Kementerian)
                $("#EditKementerian").val(Data[0].Id)
                $.post(BaseURL+"Admin/GetPermasalahanPokokNasional", {Id : $("#EditKementerian").val()}).done(function(Respon) {
                    var Data_ = JSON.parse(Respon)
                    var Permasalahan = ''
                    for (let i = 0; i < Data_.length; i++) {
                        Permasalahan += '<label><input style="margin-top: 10px;" type="checkbox" name="EditPermasalahan" value="'+Data_[i].Id+'"> '+Data_[i].NamaPermasalahanPokok+'</label><br>'
                    }
                    $("#EditListPermasalahanPokokNasional").html(Permasalahan)
                    Pisah[4].split("$").forEach(function(m) {
                        $("input[name='EditPermasalahan'][value='" + m + "']").prop('checked', true)
                    })
                })     
            })     
        }) 
        $('#ModalEditPermasalahanPokok').modal("show");
    });

    // Update Permasalahan Pokok
    $("#UpdatePermasalahanPokok").click(function() {
    if ($("#EditPeriodeRPJMD").val() === "") {
        alert('Pilih Periode RPJMD terlebih dahulu!');
        return;
    } else if ($("#EditNamaPermasalahanPokok").val() === "") {
        alert('Nama Permasalahan Pokok harus diisi!');
        return;
    } else {
        var Data = {
            Id: $("#EditId").val(),
            EditPeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
            NamaPermasalahanPokok: $("#EditNamaPermasalahanPokok").val()
        };
        $.post(BaseURL + "Admin/UpdatePermasalahanPokok", Data).done(function(Respon) {
            if (Respon == '1') {
                // Reset form edit
                $("#EditPeriodeRPJMD").val('').trigger('change');
                $("#EditNamaPermasalahanPokok").val('');
                $("#EditTahunMulai").val('');
                $("#EditTahunAkhir").val('');
                
                // Tutup modal edit
                $('#ModalEditPermasalahanPokok').modal('hide');
                
                // Reload data tabel (opsi 1)
                window.location.reload();
                } else {
                    alert(Respon);
                }
            });
        }
    });

    // Hapus Permasalahan Pokok
    $(document).on("click", ".Hapus", function() {
            var Id = { Id: $(this).attr('Hapus') };
            $.post(BaseURL + "Admin/DeletePermasalahanPokok", Id).done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            });
        });
</script>