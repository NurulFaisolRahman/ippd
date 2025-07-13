<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaran"><i class="notika-icon notika-edit"></i> <b>Input Sasaran RPJMD</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 70%;">Sasaran RPJMD</th>
                                        <th style="width: 10%;">Periode</th>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Sasaran as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Sasaran']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Sasaran'].'|'.$key['Id_'].'|'.$key['IdP']?>"><i class="notika-icon notika-edit"></i></button>
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
    <div class="modal fade" id="ModalInputSasaran" role="dialog">
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
                                                <label class="hrzn-fm"><b>Tujuan RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="IdTujuan"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Sasaran RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="Sasaran" placeholder="Input Sasaran RPJMD"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJMDP">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJMDP as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Sasaran RPJMD Provinsi</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionSasaranRPJMDP" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionSasaranRPJMDP" href="#SasaranRPJMDP-one" aria-expanded="true">Pilih Sasaran RPJMD</a></b>
                                                            </div>
                                                            <div id="SasaranRPJMDP-one" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="SasaranRPJMDP"></div>
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
                                                    <select class="form-control" id="PeriodeRPJMN">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJMN as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Sasaran RPJMN</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionSasaranRPJMN" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionSasaranRPJMN" href="#SasaranRPJMN-one" aria-expanded="true">Pilih Sasaran RPJMN</a></b>
                                                            </div>
                                                            <div id="SasaranRPJMN-one" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="SasaranRPJMN"></div>
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
    <div class="modal fade" id="ModalEditSasaran" role="dialog">
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
                                                <label class="hrzn-fm"><b>Tujuan RPJMD</b></label>
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="_IdTujuan"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Sasaran RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="_Sasaran" placeholder="Input Sasaran RPJMD"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJMDP_">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJMDP as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Sasaran RPJMD Provinsi</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionSasaranRPJMDP_" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionSasaranRPJMDP_" href="#_SasaranRPJMDP" aria-expanded="true">Pilih Sasaran RPJMD</a></b>
                                                            </div>
                                                            <div id="_SasaranRPJMDP" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="SasaranRPJMDP_"></div>
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
                                                    <select class="form-control" id="PeriodeRPJMN_">
                                                        <option value="">Pilih Periode</option>
                                                        <?php foreach ($VisiRPJMN as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Sasaran RPJMN</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionSasaranRPJMN_" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionSasaranRPJMN_" href="#_SasaranRPJMN" aria-expanded="true">Pilih Sasaran RPJMN</a></b>
                                                            </div>
                                                            <div id="_SasaranRPJMN" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="SasaranRPJMN_"></div>
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
                    $.post(BaseURL+"Daerah/GetTujuanRPJMD", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<option value="'+Data[i].Id+'">'+Data[i].Tujuan+'</option>'
                        }
                        $("#IdTujuan").html(Tujuan)
                    })                         
                }
            });

            $("#_Periode").change(function(){
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Daerah/GetTujuanRPJMD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<option value="'+Data[i].Id+'">'+Data[i].Tujuan+'</option>'
                        }
                        $("#_IdTujuan").html(Tujuan)
                    })                         
                }
            });

            $("#PeriodeRPJMN").change(function(){
                if ($("#PeriodeRPJMN").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else {
                    $.post(BaseURL+"Daerah/GetSasaranRPJMN", {Id : $("#PeriodeRPJMN").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Sasaran = ''
                        for (let i = 0; i < Data.length; i++) {
                            Sasaran += '<label><input style="margin-top: 10px;" type="checkbox" name="_Sasaran" value="'+Data[i].Id+'"> '+Data[i].Sasaran+'</label><br>'
                        }
                        $("#SasaranRPJMN").html(Sasaran)
                    })                         
                }
            });

            $("#PeriodeRPJMN_").change(function(){
                if ($("#PeriodeRPJMN_").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else {
                    $.post(BaseURL+"Daerah/GetSasaranRPJMN", {Id : $("#PeriodeRPJMN_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Sasaran = ''
                        for (let i = 0; i < Data.length; i++) {
                            Sasaran += '<label><input style="margin-top: 10px;" type="checkbox" name="Sasaran_" value="'+Data[i].Id+'"> '+Data[i].Sasaran+'</label><br>'
                        }
                        $("#SasaranRPJMN_").html(Sasaran)
                    })                         
                }
            });

            $("#PeriodeRPJMDP").change(function(){
                if ($("#PeriodeRPJMDP").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else {
                    $.post(BaseURL+"Daerah/GetSasaranRPJMDP", {Id : $("#PeriodeRPJMDP").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Sasaran = ''
                        for (let i = 0; i < Data.length; i++) {
                            Sasaran += '<label><input style="margin-top: 10px;" type="checkbox" name="_SasaranRPJMDP" value="'+Data[i].Id+'"> '+Data[i].Sasaran+'</label><br>'
                        }
                        $("#SasaranRPJMDP").html(Sasaran)
                    })                         
                }
            });

            $("#PeriodeRPJMDP_").change(function(){
                if ($("#PeriodeRPJMDP_").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else {
                    $.post(BaseURL+"Daerah/GetSasaranRPJMDP", {Id : $("#PeriodeRPJMDP_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Sasaran = ''
                        for (let i = 0; i < Data.length; i++) {
                            Sasaran += '<label><input style="margin-top: 10px;" type="checkbox" name="Sasaran_RPJMDP" value="'+Data[i].Id+'"> '+Data[i].Sasaran+'</label><br>'
                        }
                        $("#SasaranRPJMDP_").html(Sasaran)
                    })                         
                }
            });

            $("#Input").click(function() {
                var RPJMDP = []
                $.each($("input[name='_SasaranRPJMDP']:checked"), function(){
                    RPJMDP.push($(this).val())
                })
                var RPJMN = []
                $.each($("input[name='_Sasaran']:checked"), function(){
                    RPJMN.push($(this).val())
                })
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#Sasaran").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else if ($("#PeriodeRPJMDP").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else if (!RPJMDP.length) {
                    alert("Mohon Checklist Sasaran RPJMN!")
                } else if ($("#PeriodeRPJMN").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else if (!RPJMN.length) {
                    alert("Mohon Checklist Sasaran RPJMN!")
                } else {
                    var Sasaran = { _Id    : $("#IdTujuan").val(),
                                 Id_    : RPJMN.join("$"),
                                 IdP    : RPJMDP.join("$"),
                                 Sasaran   : $("#Sasaran").val() }
                    $.post(BaseURL+"Daerah/InputSasaranRPJMD", Sasaran).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Daerah/SasaranRPJMD"
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
                $.post(BaseURL+"Daerah/GetPeriodeSasaranRPJMD", {Id : Pisah[1]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#_Periode").val(Data[0].IdVisi)
                    $.post(BaseURL+"Daerah/GetTujuanRPJMD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<option value="'+Data[i].Id+'">'+Data[i].Tujuan+'</option>'
                        }
                        $("#_IdTujuan").html(Tujuan)
                        $("#_IdTujuan").val(Pisah[1])
                    })
                })
                $("#_Sasaran").val(Pisah[2])
                $.post(BaseURL+"Daerah/GetVisiRPJMN", {Id : Pisah[3].split("$")[0]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#PeriodeRPJMN_").val(Data[0].IdVisi)
                    $.post(BaseURL+"Daerah/GetSasaranRPJMN", {Id : $("#PeriodeRPJMN_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Sasaran = ''
                        for (let i = 0; i < Data.length; i++) {
                            Sasaran += '<label><input style="margin-top: 10px;" type="checkbox" name="Sasaran_" value="'+Data[i].Id+'"> '+Data[i].Sasaran+'</label><br>'
                        }
                        $("#SasaranRPJMN_").html(Sasaran)
                        $("input[name='Sasaran_']").prop('checked', false);
                        Pisah[3].split("$").forEach(function(m) {
                            $("input[name='Sasaran_'][value='" + m + "']").prop('checked', true)
                        })
                    })
                }) 
                $.post(BaseURL+"Daerah/GetVisiRPJMDP", {Id : Pisah[4].split("$")[0]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#PeriodeRPJMDP_").val(Data[0].IdVisi)
                    $.post(BaseURL+"Daerah/GetSasaranRPJMDP", {Id : $("#PeriodeRPJMDP_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Sasaran = ''
                        for (let i = 0; i < Data.length; i++) {
                            Sasaran += '<label><input style="margin-top: 10px;" type="checkbox" name="Sasaran_RPJMDP" value="'+Data[i].Id+'"> '+Data[i].Sasaran+'</label><br>'
                        }
                        $("#SasaranRPJMDP_").html(Sasaran)
                        $("input[name='Sasaran_RPJMDP']").prop('checked', false);
                        Pisah[4].split("$").forEach(function(m) {
                            $("input[name='Sasaran_RPJMDP'][value='" + m + "']").prop('checked', true)
                        })
                    })
                })                         
                $('#ModalEditSasaran').modal("show")
            })

            $("#Edit").click(function() {
                var RPJMDP = []
                $.each($("input[name='Sasaran_RPJMDP']:checked"), function(){
                    RPJMDP.push($(this).val())
                })
                var RPJMN = []
                $.each($("input[name='Sasaran_']:checked"), function(){
                    RPJMN.push($(this).val())
                })
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_Sasaran").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else if ($("#PeriodeRPJMDP_").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else if (!RPJMDP.length) {
                    alert("Mohon Checklist Sasaran RPJMN!")
                } else if ($("#PeriodeRPJMN_").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else if (!RPJMN.length) {
                    alert("Mohon Checklist Sasaran RPJMN!")
                } else {
                    var Sasaran = { Id     : $("#Id").val(),
                                 _Id    : $("#_IdTujuan").val(),
                                 Id_    : RPJMN.join("$"),
                                 IdP    : RPJMDP.join("$"),
                                 Sasaran   : $("#_Sasaran").val() }
                    $.post(BaseURL+"Daerah/EditSasaranRPJMD", Sasaran).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Daerah/SasaranRPJMD"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var Sasaran = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Daerah/HapusSasaranRPJMD", Sasaran).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Daerah/SasaranRPJMD"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>