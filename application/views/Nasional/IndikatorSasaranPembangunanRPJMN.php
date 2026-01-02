<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIndikatorPembangunan"><i class="notika-icon notika-edit"></i> <b>Input Indikator Pembangunan RPJMN</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 20%;">Sasaran</th>
                                        <th style="width: 10%;">Indikator</th>
                                        <th style="width: 10%;">Satuan</th>
                                        <th style="width: 10%;">Baseline</th>
                                        <th style="width: 10%;">Target Awal</th>
                                        <th style="width: 10%;">Target Akhir</th>
                                        <th style="width: 10%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($IndikatorPembangunan as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['SasaranPembangunan']?></td>
                                        <td style="vertical-align: middle;"><?=$key['IndikatorPembangunan']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Satuan']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Baseline']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TargetAwal']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TargetAkhir']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['IdVisi'].'|'.$key['_Id'].'|'.$key['IndikatorPembangunan'].'|'.$key['Satuan'].'|'.$key['Baseline'].'|'.$key['TargetAwal'].'|'.$key['TargetAkhir']?>"><i class="notika-icon notika-edit"></i></button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['Id']?>"><i class="notika-icon notika-trash"></i></button>
                                        </td>
                                        <?php } ?>
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
    <div class="modal fade" id="ModalInputIndikatorPembangunan" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h2 class="text-center mt-0 pb-2">Form Input Indikator Sasaran Pembangunan RPJMN</h2>
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row mb-2">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Periode">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Sasaran Pembangunan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="IdSasaranPembangunan"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Indikator Pembangunan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="IndikatorPembangunan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Satuan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="Satuan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Baseline</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="Baseline">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Awal</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TargetAwal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Akhir</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TargetAkhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEditIndikatorPembangunan" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h2 class="text-center mt-0 pb-2">Form Edit Indikator Sasaran Pembangunan RPJMN</h2>
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row mb-2">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Periode">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Sasaran Pembangunan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_IdSasaranPembangunan"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Indikator Pembangunan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                                <input type="text" class="form-control input-sm" id="_IndikatorPembangunan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Satuan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_Satuan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Baseline</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_Baseline">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Awal</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_TargetAwal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target Akhir</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_TargetAkhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="Edit"><b>SIMPAN</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/jquery-price-slider.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/data-table/jquery.dataTables.min.js"></script>
    <script src="../js/data-table/data-table-act.js"></script>
    <script src="../js/main.js"></script>
    <script>
        var BaseURL = '<?=base_url()?>'
        jQuery(document).ready(function($) {

            $("#Periode").change(function(){
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Nasional/GetSasaranPembangunanRPJMN", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var SasaranPembangunan = ''
                        for (let i = 0; i < Data.length; i++) {
                            SasaranPembangunan += '<option value="'+Data[i].Id+'">'+Data[i].SasaranPembangunan+'</option>'
                        }
                        $("#IdSasaranPembangunan").html(SasaranPembangunan)
                    })                         
                }
            });

            $("#_Periode").change(function(){
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Nasional/GetSasaranPembangunanRPJMN", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var SasaranPembangunan = ''
                        for (let i = 0; i < Data.length; i++) {
                            SasaranPembangunan += '<option value="'+Data[i].Id+'">'+Data[i].SasaranPembangunan+'</option>'
                        }
                        $("#_IdSasaranPembangunan").html(SasaranPembangunan)
                    })                         
                }
            });

            $("#Input").click(function() {
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#IndikatorPembangunan").val() == "") {
                    alert('Input Indikator Pembangunan Belum Benar!')
                } else if ($("#Satuan").val() == "") {
                    alert('Input Satuan Belum Benar!')
                } else if ($("#Baseline").val() == "") {
                    alert('Input Baseline Belum Benar!')
                } else if ($("#TargetAwal").val() == "") {
                    alert('Input Target Awal Belum Benar!')
                } else if ($("#TargetAkhir").val() == "") {
                    alert('Input Target Akhir Belum Benar!')
                } else {
                    var IndikatorPembangunan = { _Id   : $("#IdSasaranPembangunan").val(),
                                 IndikatorPembangunan   : $("#IndikatorPembangunan").val(),
                                 Satuan   : $("#Satuan").val(),
                                 Baseline   : $("#Baseline").val(),
                                 TargetAwal   : $("#TargetAwal").val(),
                                 TargetAkhir   : $("#TargetAkhir").val() }
                    $.post(BaseURL+"Nasional/InputIndikatorSasaranPembangunanRPJMN", IndikatorPembangunan).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/IndikatorSasaranPembangunanRPJMN"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })
            
            $(document).on("click",".Edit",function(){
                var Data = $(this).attr('Edit')
                var Pisah = Data.split("|");
                $("#Id").val(Pisah[0])
                $("#_Periode").val(Pisah[1])
                $.post(BaseURL+"Nasional/GetSasaranPembangunanRPJMN", {Id : $("#_Periode").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var SasaranPembangunan = ''
                    for (let i = 0; i < Data.length; i++) {
                        SasaranPembangunan += '<option value="'+Data[i].Id+'">'+Data[i].SasaranPembangunan+'</option>'
                    }
                    $("#_IdSasaranPembangunan").html(SasaranPembangunan)
                    $("#_IdSasaranPembangunan").val(Pisah[2])
                })
                $("#_IndikatorPembangunan").val(Pisah[3])
                $("#_Satuan").val(Pisah[4])
                $("#_Baseline").val(Pisah[5])
                $("#_TargetAwal").val(Pisah[6])
                $("#_TargetAkhir").val(Pisah[7])
                $('#ModalEditIndikatorPembangunan').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_IndikatorPembangunan").val() == "") {
                    alert('Input Indikator Pembangunan Belum Benar!')
                } else if ($("#_Satuan").val() == "") {
                    alert('Input Satuan Belum Benar!')
                } else if ($("#_Baseline").val() == "") {
                    alert('Input Baseline Belum Benar!')
                } else if ($("#_TargetAwal").val() == "") {
                    alert('Input Target Awal Belum Benar!')
                } else if ($("#_TargetAkhir").val() == "") {
                    alert('Input Target Akhir Belum Benar!')
                } else {
                    var IndikatorPembangunan = { Id   : $("#Id").val(),
                                 _Id   : $("#_IdSasaranPembangunan").val(),
                                 IndikatorPembangunan   : $("#_IndikatorPembangunan").val(),
                                 Satuan   : $("#_Satuan").val(),
                                 Baseline   : $("#_Baseline").val(),
                                 TargetAwal   : $("#_TargetAwal").val(),
                                 TargetAkhir   : $("#_TargetAkhir").val() }
                    $.post(BaseURL+"Nasional/EditIndikatorSasaranPembangunanRPJMN", IndikatorPembangunan).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/IndikatorSasaranPembangunanRPJMN"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var IndikatorPembangunan = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusIndikatorSasaranPembangunanRPJMN", IndikatorPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/IndikatorSasaranPembangunanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>