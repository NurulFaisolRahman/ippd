<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIndikasiIntervensi"><i class="notika-icon notika-edit"></i> <b>Input Indikasi Intervensi</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 10%;">Provinsi</th>
                                        <th style="width: 30%;">Prioritas Nasional</th>
                                        <th style="width: 30%;">Indikasi Intervensi</th>
                                        <th style="width: 10%;">Tahun</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($IndikasiIntervensi as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Nama']?></td>
                                        <td style="vertical-align: middle;"><?=$key['PrioritasNasional']?></td>
                                        <td style="vertical-align: middle;"><?=$key['IndikasiIntervensi']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Tahun']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Provinsi'].'|'.$key['_IdPN'].'|'.$key['IndikasiIntervensi'].'|'.$key['Tahun']?>"><i class="notika-icon notika-edit"></i></button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['Id']?>"><i class="notika-icon notika-trash"></i></button>
                                            </div>
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
    <div class="modal fade" id="ModalInputIndikasiIntervensi" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
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
                                        <div class="col-lg-9" style="margin-top: 9px;">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="IdPrioritasNasional"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <select class="form-control" id="Provinsi">
                                            <?php foreach ($Provinsi as $key) { ?>
                                                <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Indikasi Intervensi</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="IndikasiIntervensi" placeholder="Input Indikasi Intervensi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahun</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="Tahun">
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
    <div class="modal fade" id="ModalEditIndikasiIntervensi" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Periode">
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
                                            <input type="hidden" class="form-control input-sm" id="Id">
                                        </div>
                                        <div class="col-lg-9" style="margin-top: 9px;">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_IdPrioritasNasional"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <select class="form-control" id="_Provinsi">
                                            <?php foreach ($Provinsi as $key) { ?>
                                                <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Indikasi Intervensi</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="_IndikasiIntervensi" placeholder="Input Indikasi Intervensi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahun</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_Tahun">
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
                                        <button class="btn btn-success notika-btn-success" id="Edit"><b>Update</b></button>
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
                    $.post(BaseURL+"Nasional/GetPrioritasNasional", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var PrioritasNasional = ''
                        for (let i = 0; i < Data.length; i++) {
                            PrioritasNasional += '<option value="'+Data[i].Id+'">'+Data[i].PrioritasNasional+'</option>'
                        }
                        $("#IdPrioritasNasional").html(PrioritasNasional)
                    })                         
                }
            });

            $("#_Periode").change(function(){
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Nasional/GetPrioritasNasional", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var PrioritasNasional = ''
                        for (let i = 0; i < Data.length; i++) {
                            PrioritasNasional += '<option value="'+Data[i].Id+'">'+Data[i].PrioritasNasional+'</option>'
                        }
                        $("#_IdPrioritasNasional").html(PrioritasNasional)
                    })                         
                }
            });

            $("#Input").click(function() {
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#IndikasiIntervensi").val() == "") {
                    alert('Input Indikasi Intervensi Belum Benar!')
                } else if (isNaN($("#Tahun").val()) || $("#Tahun").val() == "" || $("#Tahun").val().length != 4) {
                    alert("Input Tahun Belum Benar!")
                } else {
                    var IndikasiIntervensi = { _Id   : $("#IdPrioritasNasional").val(),
                                            Provinsi : $("#Provinsi").val(),
                                  IndikasiIntervensi : $("#IndikasiIntervensi").val(),
                                               Tahun : $("#Tahun").val() }
                    $.post(BaseURL+"Nasional/InputIndikasiIntervensi", IndikasiIntervensi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/IndikasiIntervensi"
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
                $("#_Periode").val(Pisah[3])
                $.post(BaseURL+"Nasional/GetPrioritasNasional", {Id : $("#_Periode").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var PrioritasNasional = ''
                    for (let i = 0; i < Data.length; i++) {
                        PrioritasNasional += '<option value="'+Data[i].Id+'">'+Data[i].PrioritasNasional+'</option>'
                    }
                    $("#_IdPrioritasNasional").html(PrioritasNasional)
                    $("#_IdPrioritasNasional").val(Pisah[1])
                })                         
                $("#_Provinsi").val(Pisah[2])
                $("#_IndikasiIntervensi").val(Pisah[4])
                $("#_Tahun").val(Pisah[5])
                $('#ModalEditIndikasiIntervensi').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_IndikasiIntervensi").val() == "") {
                    alert('Input Indikasi Intervensi Belum Benar!')
                } else if (isNaN($("#_Tahun").val()) || $("#_Tahun").val() == "" || $("#_Tahun").val().length != 4) {
                    alert("Input Tahun Belum Benar!")
                }else {
                    var IndikasiIntervensi = {    Id : $("#Id").val(),
                                                 _Id : $("#_IdPrioritasNasional").val(),
                                            Provinsi : $("#_Provinsi").val(),
                                  IndikasiIntervensi : $("#_IndikasiIntervensi").val(),
                                               Tahun : $("_Tahun").val() }
                    $.post(BaseURL+"Nasional/EditIndikasiIntervensi", IndikasiIntervensi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/IndikasiIntervensi"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var IndikasiIntervensi = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusIndikasiIntervensi", IndikasiIntervensi).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/IndikasiIntervensi"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>