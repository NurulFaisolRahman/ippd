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
                                    <th>Isu KLHS Nasional</th>
                                    <th>Kementerian</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($IsuKLHS as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaIsuKLHS'] ?></td>
                                    <td style="vertical-align: middle;">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="Accrodion<?=$No?>" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#Accrodion<?=$No?>" href="#_Accrodion<?=$No?>" aria-expanded="true">Lihat Isu</a></b>
                                                    </div>
                                                    <div id="_Accrodion<?=$No?>" class="collapse" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px;">
                                                            <?php $_Id = explode("$",$key['_Id']); foreach ($_Id as $x) { ?>
                                                                <div class="nk-int-st text-justify"><?= $Isu[$x] ?></div>
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
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['Id'] ?>" 
                                                    data-nama="<?= $key['NamaIsuKLHS'] ?>" 
                                                    data-tahunmulai="<?= $key['TahunMulai'] ?>" 
                                                    data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                    data-periode="<?= $key['TahunMulai'] . '-' . $key['TahunAkhir'] ?>"
                                                    data-kementerian="<?= explode("$",$key['_Id'])[0] ?>"
                                                    data-isu="<?= $key['_Id'] ?>">
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
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode </b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodeIsuKLHSNasional"data-style="btn-default" style="color: #000 !important;">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($PeriodeIsuKLHSNasional as $key) { ?>
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
                                    <label class="hrzn-fm"><b>Isu Pokok Nasional</b></label>
                                </div>
                                <div style="margin-top: 3px;" class="col-lg-9">
                                    <div class="accordion-stn">
                                        <div class="panel-group" data-collapse-color="nk-green" id="AccrodionIsuKLHSNasional" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-collapse notika-accrodion-cus">
                                                <div class="panel-heading" role="tab">
                                                    <b><a data-toggle="collapse" data-parent="#AccrodionIsuKLHSNasional" href="#PilihIsuKLHSNasional" aria-expanded="true">Pilih Isu</a></b>
                                                </div>
                                                <div id="PilihIsuKLHSNasional" class="collapse in" role="tabpanel">
                                                    <div class="panel-body" style="padding-top: 0px;">
                                                        <div class="nk-int-st text-justify" id="ListIsuKLHSNasional"></div>
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
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode Nasional</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditPeriodeIsuKLHSNasional" style="color: #000 !important;">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($PeriodeIsuKLHSNasional as $key) { ?>
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
                                                <select class="form-control" id="EditKementerian" style="color: #000 !important;">
                                                    <option value="">-- Pilih Kementerian --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="hrzn-fm"><b>Isu Pokok Nasional</b></label>
                                </div>
                                <div style="margin-top: 3px;" class="col-lg-9">
                                    <div class="accordion-stn">
                                        <div class="panel-group" data-collapse-color="nk-green" id="EditAccrodionIsuKLHSNasional" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-collapse notika-accrodion-cus">
                                                <div class="panel-heading" role="tab">
                                                    <b><a data-toggle="collapse" data-parent="#EditAccrodionIsuKLHSNasional" href="#EditPilihIsuKLHSNasional" aria-expanded="true">Pilih Isu</a></b>
                                                </div>
                                                <div id="EditPilihIsuKLHSNasional" class="collapse in" role="tabpanel">
                                                    <div class="panel-body" style="padding-top: 0px;">
                                                        <div class="nk-int-st text-justify" id="EditListIsuKLHSNasional"></div>
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

    // Input Form Functions
    $("#PeriodeIsuKLHSNasional").change(function(){
        if ($("#PeriodeIsuKLHSNasional").val() == "") {
            alert("Mohon Input Periode")
        } else {
            $.post(BaseURL+"Daerah/GetKementerianIsu", {TahunMulai : $("#PeriodeIsuKLHSNasional").val()}).done(function(Respon) {
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
            alert("Mohon Input Kementerian")
        } else {
            $.post(BaseURL+"Daerah/GetIsuKLHSNasional", {Id : $("#Kementerian").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Isu = ''
                for (let i = 0; i < Data.length; i++) {
                    Isu += '<label><input style="margin-top: 10px;" type="checkbox" name="Isu" value="'+Data[i].Id+'"> '+Data[i].NamaIsuKLHS+'</label><br>'
                }
                $("#ListIsuKLHSNasional").html(Isu)
            })                         
        }
    });
    
    // Edit Form Functions
    $("#EditPeriodeIsuKLHSNasional").change(function(){
        if ($(this).val() == "") {
            $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $("#EditListIsuKLHSNasional").html('');
        } else {
            $.post(BaseURL+"Daerah/GetKementerianIsu", {TahunMulai: $(this).val()}).done(function(Respon) {
                var Data = JSON.parse(Respon);
                var Kementerian = '<option value="">-- Pilih Kementerian --</option>';
                for (let i = 0; i < Data.length; i++) {
                    Kementerian += '<option value="'+Data[i].Id+'">'+Data[i].NamaKementerian+'</option>';
                }
                $("#EditKementerian").html(Kementerian);
            });                         
        }
    });

    $("#EditKementerian").change(function(){
        if ($(this).val() == "") {
            $("#EditListIsuKLHSNasional").html('');
        } else {
            $.post(BaseURL+"Daerah/GetIsuKLHSNasional", {Id: $(this).val()}).done(function(Respon) {
                var Data = JSON.parse(Respon);
                var Isu = '';
                for (let i = 0; i < Data.length; i++) {
                    Isu += '<label><input style="margin-top: 10px;" type="checkbox" name="EditIsu" value="'+Data[i].Id+'"> '+Data[i].NamaIsuKLHS+'</label><br>';
                }
                $("#EditListIsuKLHSNasional").html(Isu);
                
                // Check previously selected items
                var selectedIsu = $("#EditIsuData").val().split("$");
                $("input[name='EditIsu']").each(function() {
                    if(selectedIsu.includes($(this).val())) {
                        $(this).prop('checked', true);
                    }
                });
            });                         
        }
    });

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
        var IsuKLHSNasional = []
        $.each($("input[name='Isu']:checked"), function(){
            IsuKLHSNasional.push($(this).val())
        })
        if ($("#PeriodeRPJMD").val() === "") {
            alert('Pilih Periode RPJMD terlebih dahulu!');
            return;
        } else if ($("#NamaIsuKLHS").val() === "") {
            alert('Nama Isu KLHS harus diisi!');
            return;
        } else if (!IsuKLHSNasional.length) {
            alert("Pilih minimal satu Isu KLHS Nasional!")
        } else {
            var Data = {
                PeriodeRPJMD: $("#PeriodeRPJMD").val(),
                NamaIsuKLHS: $("#NamaIsuKLHS").val(),
                _Id: IsuKLHSNasional.join("$"),
            };
            $.post(BaseURL + "Daerah/InputIsuKLHS", Data).done(function(Respon) {
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
        // Get all data attributes
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var tahunmulai = $(this).data('tahunmulai');
        var tahunakhir = $(this).data('tahunakhir');
        var periode = $(this).data('periode');
        var kementerian = $(this).data('kementerian');
        var isu = $(this).data('isu');
        
        // Set basic form values
        $("#EditId").val(id);
        $("#EditNamaIsuKLHS").val(nama);
        $("#EditPeriodeRPJMD").val(periode);
        $("#EditTahunMulai").val(tahunmulai);
        $("#EditTahunAkhir").val(tahunakhir);
        
        // Store the isu data in a hidden field for later use
        $('<input>').attr({
            type: 'hidden',
            id: 'EditIsuData',
            value: isu
        }).appendTo('body');
        
        // Get additional data for Kementerian and Isu
        $.post(BaseURL + "Daerah/GetPeriodeIsuKLHSNasional", {Id: kementerian}).done(function(Respon) {
            var Data = JSON.parse(Respon)[0];
            if(Data) {
                // Set periode nasional
                $("#EditPeriodeIsuKLHSNasional").val(Data.TahunMulai).trigger('change');
                
                // After Kementerian loads, set the value
                setTimeout(function() {
                    $("#EditKementerian").val(kementerian).trigger('change');
                }, 500);
            }
        });
        
        $('#ModalEditIsuKLHS').modal("show");
    });

    // Update Isu KLHS
    $("#UpdateIsuKLHS").click(function() {
        var IsuKLHSNasional = [];
        $.each($("input[name='EditIsu']:checked"), function(){
            IsuKLHSNasional.push($(this).val());
        });
        
        if ($("#EditPeriodeRPJMD").val() === "") {
            alert('Pilih Periode RPJMD terlebih dahulu!');
            return;
        } else if ($("#EditNamaIsuKLHS").val() === "") {
            alert('Nama Isu KLHS harus diisi!');
            return;
        } else if (!IsuKLHSNasional.length) {
            alert("Pilih minimal satu Isu KLHS Nasional!");
            return;
        }
        
        var Data = {
            Id: $("#EditId").val(),
            EditPeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
            NamaIsuKLHS: $("#EditNamaIsuKLHS").val(),
            _Id: IsuKLHSNasional.join("$")
        };
        
        $.post(BaseURL + "Daerah/UpdateIsuKLHS", Data).done(function(Respon) {
            if (Respon == '1') {
                $('#ModalEditIsuKLHS').modal('hide');
                window.location.reload();
            } else {
                alert(Respon);
            }
        });
    });

    // Hapus Isu KLHS
    $(".Hapus").click(function() {
        if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            var Id = { Id: $(this).attr('Hapus') };
            $.post(BaseURL + "Daerah/DeleteIsuKLHS", Id).done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            });
        }
    });

    // Reset form saat modal ditutup
    $('#ModalInputIsuKLHS').on('hidden.bs.modal', function () {
        $("#PeriodeRPJMD").val('').trigger('change');
        $("#NamaIsuKLHS").val('');
        $("#PeriodeIsuKLHSNasional").val('');
        $("#Kementerian").html('');
        $("#ListIsuKLHSNasional").html('');
    });

    $('#ModalEditIsuKLHS').on('hidden.bs.modal', function () {
        $("#EditPeriodeRPJMD").val('').trigger('change');
        $("#EditNamaIsuKLHS").val('');
        $("#EditPeriodeIsuKLHSNasional").val('');
        $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
        $("#EditListIsuKLHSNasional").html('');
        $("#EditIsuData").remove();
    });
</script>

<style>
    .form-control, .form-control option {
        color: #000 !important;
    }
    .modal-content {
        color: #000;
    }
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin-left: 10px;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>