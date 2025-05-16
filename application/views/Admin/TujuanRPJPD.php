<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTujuan"><i class="notika-icon notika-edit"></i> <b>Input Tujuan RPJPD</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 70%;">Tujuan RPJPD</th>
                                        <th style="width: 10%;">Periode</th>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Tujuan as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Tujuan']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Tujuan'].'|'.$key['Id_'].'|'.$key['IdP']?>"><i class="notika-icon notika-next"></i></button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['Id']?>"><i class="notika-icon notika-trash"></i></button>
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
    <div class="modal fade" id="ModalInputTujuan" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 550px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div style="margin-bottom: 5px;" class="col-lg-9">
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
                                                <label class="hrzn-fm"><b>Misi RPJPD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="IdMisi"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="Tujuan" placeholder="Input Tujuan RPJPD"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJPDP">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJPDP as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPD Provinsi</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionTujuanRPJPDP" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionTujuanRPJPDP" href="#TujuanRPJPDP-one" aria-expanded="true">Pilih Tujuan RPJPD</a></b>
                                                            </div>
                                                            <div id="TujuanRPJPDP-one" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="TujuanRPJPDP"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJPN">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJPN as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPN</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionTujuanRPJPN" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionTujuanRPJPN" href="#TujuanRPJPN-one" aria-expanded="true">Pilih Tujuan RPJPN</a></b>
                                                            </div>
                                                            <div id="TujuanRPJPN-one" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="TujuanRPJPN"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
    </div>
    <div class="modal fade" id="ModalEditTujuan" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 550px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div style="margin-bottom: 5px;" class="col-lg-9">
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
                                                <label class="hrzn-fm"><b>Misi RPJPD</b></label>
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="_IdMisi"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="_Tujuan" placeholder="Input Tujuan RPJPD"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJPDP_">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJPDP as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPD Provinsi</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionTujuanRPJPDP_" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionTujuanRPJPDP_" href="#_TujuanRPJPDP" aria-expanded="true">Pilih Tujuan RPJPD</a></b>
                                                            </div>
                                                            <div id="_TujuanRPJPDP" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="TujuanRPJPDP_"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJPN_">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJPN as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPN</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionTujuanRPJPN_" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionTujuanRPJPN_" href="#_TujuanRPJPN" aria-expanded="true">Pilih Tujuan RPJPN</a></b>
                                                            </div>
                                                            <div id="_TujuanRPJPN" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="TujuanRPJPN_"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                    $.post(BaseURL+"Admin/GetMisiRPJPD", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<option value="'+Data[i].Id+'">'+Data[i].Misi+'</option>'
                        }
                        $("#IdMisi").html(Misi)
                    })                         
                }
            });

            $("#_Periode").change(function(){
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Admin/GetMisiRPJPD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<option value="'+Data[i].Id+'">'+Data[i].Misi+'</option>'
                        }
                        $("#_IdMisi").html(Misi)
                    })                         
                }
            });

            $("#PeriodeRPJPN").change(function(){
                if ($("#PeriodeRPJPN").val() == "") {
                    alert("Mohon Input Periode RPJPN")
                } else {
                    $.post(BaseURL+"Admin/GetTujuanRPJPN", {Id : $("#PeriodeRPJPN").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<label><input style="margin-top: 10px;" type="checkbox" name="_Tujuan" value="'+Data[i].Id+'"> '+Data[i].Tujuan+'</label><br>'
                        }
                        $("#TujuanRPJPN").html(Tujuan)
                    })                         
                }
            });

            $("#PeriodeRPJPN_").change(function(){
                if ($("#PeriodeRPJPN_").val() == "") {
                    alert("Mohon Input Periode RPJPN")
                } else {
                    $.post(BaseURL+"Admin/GetTujuanRPJPN", {Id : $("#PeriodeRPJPN_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<label><input style="margin-top: 10px;" type="checkbox" name="Tujuan_" value="'+Data[i].Id+'"> '+Data[i].Tujuan+'</label><br>'
                        }
                        $("#TujuanRPJPN_").html(Tujuan)
                    })                         
                }
            });

            $("#PeriodeRPJPDP").change(function(){
                if ($("#PeriodeRPJPDP").val() == "") {
                    alert("Mohon Input Periode RPJPD Provinsi")
                } else {
                    $.post(BaseURL+"Admin/GetTujuanRPJPDP", {Id : $("#PeriodeRPJPDP").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<label><input style="margin-top: 10px;" type="checkbox" name="_TujuanRPJPDP" value="'+Data[i].Id+'"> '+Data[i].Tujuan+'</label><br>'
                        }
                        $("#TujuanRPJPDP").html(Tujuan)
                    })                         
                }
            });

            $("#PeriodeRPJPDP_").change(function(){
                if ($("#PeriodeRPJPDP_").val() == "") {
                    alert("Mohon Input Periode RPJPD Provinsi")
                } else {
                    $.post(BaseURL+"Admin/GetTujuanRPJPDP", {Id : $("#PeriodeRPJPDP_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<label><input style="margin-top: 10px;" type="checkbox" name="Tujuan_RPJPDP" value="'+Data[i].Id+'"> '+Data[i].Tujuan+'</label><br>'
                        }
                        $("#TujuanRPJPDP_").html(Tujuan)
                    })                         
                }
            });

            $("#Input").click(function() {
                var RPJPDP = []
                $.each($("input[name='_TujuanRPJPDP']:checked"), function(){
                    RPJPDP.push($(this).val())
                })
                var RPJPN = []
                $.each($("input[name='_Tujuan']:checked"), function(){
                    RPJPN.push($(this).val())
                })
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#Tujuan").val() == "") {
                    alert('Input Tujuan Belum Benar!')
                } else if ($("#PeriodeRPJPDP").val() == "") {
                    alert("Mohon Input Periode RPJPD Provinsi")
                } else if (!RPJPDP.length) {
                    alert("Mohon Checklist Tujuan RPJPN!")
                } else if ($("#PeriodeRPJPN").val() == "") {
                    alert("Mohon Input Periode RPJPN")
                } else if (!RPJPN.length) {
                    alert("Mohon Checklist Tujuan RPJPN!")
                } else {
                    var Tujuan = { _Id    : $("#IdMisi").val(),
                                 Id_    : RPJPN.join("$"),
                                 IdP    : RPJPDP.join("$"),
                                 Tujuan   : $("#Tujuan").val() }
                    $.post(BaseURL+"Admin/InputTujuanRPJPD", Tujuan).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/TujuanRPJPD"
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
                $.post(BaseURL+"Admin/GetPeriodeTujuanRPJPD", {Id : Pisah[1]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#_Periode").val(Data[0].IdVisi)
                    $.post(BaseURL+"Admin/GetMisiRPJPD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<option value="'+Data[i].Id+'">'+Data[i].Misi+'</option>'
                        }
                        $("#_IdMisi").html(Misi)
                        $("#_IdMisi").val(Pisah[1])
                    })
                })
                $("#_Tujuan").val(Pisah[2])
                $.post(BaseURL+"Admin/GetVisiRPJPN", {Id : Pisah[3].split("$")[0]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#PeriodeRPJPN_").val(Data[0].IdVisi)
                    $.post(BaseURL+"Admin/GetTujuanRPJPN", {Id : $("#PeriodeRPJPN_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<label><input style="margin-top: 10px;" type="checkbox" name="Tujuan_" value="'+Data[i].Id+'"> '+Data[i].Tujuan+'</label><br>'
                        }
                        $("#TujuanRPJPN_").html(Tujuan)
                        $("input[name='Tujuan_']").prop('checked', false);
                        Pisah[3].split("$").forEach(function(m) {
                            $("input[name='Tujuan_'][value='" + m + "']").prop('checked', true)
                        })
                    })
                }) 
                $.post(BaseURL+"Admin/GetVisiRPJPDP", {Id : Pisah[4].split("$")[0]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#PeriodeRPJPDP_").val(Data[0].IdVisi)
                    $.post(BaseURL+"Admin/GetTujuanRPJPDP", {Id : $("#PeriodeRPJPDP_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<label><input style="margin-top: 10px;" type="checkbox" name="Tujuan_RPJPDP" value="'+Data[i].Id+'"> '+Data[i].Tujuan+'</label><br>'
                        }
                        $("#TujuanRPJPDP_").html(Tujuan)
                        $("input[name='Tujuan_RPJPDP']").prop('checked', false);
                        Pisah[4].split("$").forEach(function(m) {
                            $("input[name='Tujuan_RPJPDP'][value='" + m + "']").prop('checked', true)
                        })
                    })
                })                         
                $('#ModalEditTujuan').modal("show")
            })

            $("#Edit").click(function() {
                var RPJPDP = []
                $.each($("input[name='Tujuan_RPJPDP']:checked"), function(){
                    RPJPDP.push($(this).val())
                })
                var RPJPN = []
                $.each($("input[name='Tujuan_']:checked"), function(){
                    RPJPN.push($(this).val())
                })
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_Tujuan").val() == "") {
                    alert('Input Tujuan Belum Benar!')
                } else if ($("#PeriodeRPJPDP_").val() == "") {
                    alert("Mohon Input Periode RPJPD Provinsi")
                } else if (!RPJPDP.length) {
                    alert("Mohon Checklist Tujuan RPJPN!")
                } else if ($("#PeriodeRPJPN_").val() == "") {
                    alert("Mohon Input Periode RPJPN")
                } else if (!RPJPN.length) {
                    alert("Mohon Checklist Tujuan RPJPN!")
                } else {
                    var Tujuan = { Id     : $("#Id").val(),
                                 _Id    : $("#_IdMisi").val(),
                                 Id_    : RPJPN.join("$"),
                                 IdP    : RPJPDP.join("$"),
                                 Tujuan   : $("#_Tujuan").val() }
                    $.post(BaseURL+"Admin/EditTujuanRPJPD", Tujuan).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/TujuanRPJPD"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var Tujuan = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Admin/HapusTujuanRPJPD", Tujuan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Admin/TujuanRPJPD"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>