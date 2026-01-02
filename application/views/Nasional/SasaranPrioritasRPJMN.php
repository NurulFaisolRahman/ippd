<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaranPrioritasRPJMN"><i class="notika-icon notika-edit"></i> <b>Input Sasaran Prioritas RPJMN</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 30%;">Prioritas Nasional</th>
                                        <th style="width: 30%;">Sasaran Prioritas RPJMN</th>
                                        <th style="width: 10%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                        <th style="width: 10%;" class="text-center">Indikator</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($SasaranPrioritasRPJMN as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['PrioritasNasional']?></td>
                                        <td style="vertical-align: middle;"><?=$key['SasaranPrioritasRPJMN']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td style="vertical-align: middle;" class="text-center">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['IdVisi'].'|'.$key['SasaranPrioritasRPJMN']?>"><i class="notika-icon notika-edit"></i></button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['Id']?>"><i class="notika-icon notika-trash"></i></button>
                                        </td>
                                        <td style="vertical-align: middle;" class="text-center">
                                            <button class="btn btn-sm btn-primary amber-icon-notika btn-reco-mg btn-button-mg Sub"><i class="notika-icon notika-edit"></i></button>
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
    <div class="modal fade" id="ModalInputSasaranPrioritasRPJMN" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h2 class="text-center mt-0 pb-2">Form Input Sasaran Prioritas RPJMN</h2>
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
                                            <label class="hrzn-fm"><b>Prioritas Nasional</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="IdPrioritasRPJMN"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Sasaran Prioritas RPJMN</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="SasaranPrioritasRPJMN" placeholder="Input Sasaran Prioritas RPJMN"></textarea>
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
    <div class="modal fade" id="ModalEditSasaranPrioritasRPJMN" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h2 class="text-center mt-0 pb-2">Form Edit Sasaran Prioritas RPJMN</h2>
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
                                            <label class="hrzn-fm"><b>Sasaran Prioritas RPJMN</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                                <select class="form-control" id="_IdPrioritasRPJMN"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Sasaran Prioritas RPJMN</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="_SasaranPrioritasRPJMN" placeholder="Edit Sasaran Prioritas RPJMN"></textarea>
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
                    $.post(BaseURL+"Nasional/GetPrioritasNasionalRPJMN", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var PrioritasNasional = ''
                        for (let i = 0; i < Data.length; i++) {
                            PrioritasNasional += '<option value="'+Data[i].Id+'">'+Data[i].PrioritasNasional+'</option>'
                        }
                        $("#IdPrioritasRPJMN").html(PrioritasNasional)
                    })                         
                }
            });

            $("#_Periode").change(function(){
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Nasional/GetPrioritasNasionalRPJMN", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var PrioritasNasional = ''
                        for (let i = 0; i < Data.length; i++) {
                            PrioritasNasional += '<option value="'+Data[i].Id+'">'+Data[i].PrioritasNasional+'</option>'
                        }
                        $("#_IdPrioritasRPJMN").html(PrioritasNasional)
                    })                         
                }
            });

            $("#Input").click(function() {
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#SasaranPrioritasRPJMN").val() == "") {
                    alert('Input Sasaran Prioritas RPJMN Belum Benar!')
                } else {
                    var SasaranPrioritasRPJMN = { _Id   : $("#IdPrioritasRPJMN").val(),
                                 SasaranPrioritasRPJMN   : $("#SasaranPrioritasRPJMN").val() }
                    $.post(BaseURL+"Nasional/InputSasaranPrioritasRPJMN", SasaranPrioritasRPJMN).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/SasaranPrioritasRPJMN"
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
                $("#_Periode").val(Pisah[2])
                $.post(BaseURL+"Nasional/GetPrioritasNasionalRPJMN", {Id : $("#_Periode").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var PrioritasNasional = ''
                    for (let i = 0; i < Data.length; i++) {
                        PrioritasNasional += '<option value="'+Data[i].Id+'">'+Data[i].PrioritasNasional+'</option>'
                    }
                    $("#_IdPrioritasRPJMN").html(PrioritasNasional)
                    $("#_IdPrioritasRPJMN").val(Pisah[1])
                })
                $("#_SasaranPrioritasRPJMN").val(Pisah[3])
                $('#ModalEditSasaranPrioritasRPJMN').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_SasaranPrioritasRPJMN").val() == "") {
                    alert('Input SasaranPrioritasRPJMN Belum Benar!')
                } else {
                    var SasaranPrioritasRPJMN = { Id   : $("#Id").val(),
                                 _Id   : $("#_IdPrioritasRPJMN").val(),
                                 SasaranPrioritasRPJMN   : $("#_SasaranPrioritasRPJMN").val() }
                    $.post(BaseURL+"Nasional/EditSasaranPrioritasRPJMN", SasaranPrioritasRPJMN).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/SasaranPrioritasRPJMN"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var SasaranPrioritasRPJMN = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusSasaranPrioritasRPJMN", SasaranPrioritasRPJMN).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPrioritasRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            })

            $('#data-table-basic tbody').on('click', '.Sub', function () {
                window.location = BaseURL+"Nasional/IndikatorSasaranPrioritasRPJMN"                   
            })
        })
    </script>
</body>

</html>