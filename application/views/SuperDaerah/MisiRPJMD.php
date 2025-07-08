<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputMisi"><i class="notika-icon notika-edit"></i> <b>Input Misi RPJMD</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 70%;">Misi RPJMD</th>
                                        <th style="width: 10%;">Periode</th>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Misi as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Misi']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Misi'].'|'.$key['Id_'].'|'.$key['IdP']?>"><i class="notika-icon notika-edit"></i></button>
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
    <div class="modal fade" id="ModalInputMisi" role="dialog">
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
                                                <label class="hrzn-fm"><b>Visi RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="IdVisi"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Misi RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="Misi" placeholder="Input Misi RPJMD"></textarea>
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
                                                <label class="hrzn-fm"><b>Misi RPJMD Provinsi</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJMDP" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJMDP" href="#MisiRPJMDP-one" aria-expanded="true">Pilih Misi RPJMD</a></b>
                                                            </div>
                                                            <div id="MisiRPJMDP-one" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="MisiRPJMDP"></div>
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
                                                <label class="hrzn-fm"><b>Misi RPJMN</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJMN" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJMN" href="#MisiRPJMN-one" aria-expanded="true">Pilih Misi RPJMN</a></b>
                                                            </div>
                                                            <div id="MisiRPJMN-one" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="MisiRPJMN"></div>
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
    <div class="modal fade" id="ModalEditMisi" role="dialog">
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
                                                <label class="hrzn-fm"><b>Visi RPJMD</b></label>
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="_IdVisi"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Misi RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="_Misi" placeholder="Input Misi RPJMD"></textarea>
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
                                                <label class="hrzn-fm"><b>Misi RPJMD Provinsi</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJMDP_" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJMDP_" href="#_MisiRPJMDP" aria-expanded="true">Pilih Misi RPJMD</a></b>
                                                            </div>
                                                            <div id="_MisiRPJMDP" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="MisiRPJMDP_"></div>
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
                                                <label class="hrzn-fm"><b>Misi RPJMN</b></label>
                                            </div>
                                            <div style="margin-top: 3px;" class="col-lg-9">
                                                <div class="accordion-stn">
                                                    <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJMN_" role="tablist" aria-multiselectable="true">
                                                        <div class="panel panel-collapse notika-accrodion-cus">
                                                            <div class="panel-heading" role="tab">
                                                                <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJMN_" href="#_MisiRPJMN" aria-expanded="true">Pilih Misi RPJMN</a></b>
                                                            </div>
                                                            <div id="_MisiRPJMN" class="collapse in" role="tabpanel">
                                                                <div class="panel-body" style="padding-top: 0px;">
                                                                    <div class="nk-int-st text-justify" id="MisiRPJMN_"></div>
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
                    $.post(BaseURL+"SuperDaerah/GetVisiRPJMD", {Id : $("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Visi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>'
                        }
                        $("#IdVisi").html(Visi)
                    })                         
                }
            });

            $("#_Periode").change(function(){
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"SuperDaerah/GetVisiRPJMD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Visi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>'
                        }
                        $("#_IdVisi").html(Visi)
                    })                         
                }
            });

            $("#PeriodeRPJMN").change(function(){
                if ($("#PeriodeRPJMN").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else {
                    $.post(BaseURL+"SuperDaerah/GetMisiRPJMN", {Id : $("#PeriodeRPJMN").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="_Misi" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                        }
                        $("#MisiRPJMN").html(Misi)
                    })                         
                }
            });

            $("#PeriodeRPJMN_").change(function(){
                if ($("#PeriodeRPJMN_").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else {
                    $.post(BaseURL+"SuperDaerah/GetMisiRPJMN", {Id : $("#PeriodeRPJMN_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="Misi_" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                        }
                        $("#MisiRPJMN_").html(Misi)
                    })                         
                }
            });

            $("#PeriodeRPJMDP").change(function(){
                if ($("#PeriodeRPJMDP").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else {
                    $.post(BaseURL+"SuperDaerah/GetMisiRPJMDP", {Id : $("#PeriodeRPJMDP").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="_MisiRPJMDP" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                        }
                        $("#MisiRPJMDP").html(Misi)
                    })                         
                }
            });

            $("#PeriodeRPJMDP_").change(function(){
                if ($("#PeriodeRPJMDP_").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else {
                    $.post(BaseURL+"SuperDaerah/GetMisiRPJMDP", {Id : $("#PeriodeRPJMDP_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="Misi_RPJMDP" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                        }
                        $("#MisiRPJMDP_").html(Misi)
                    })                         
                }
            });

            $("#Input").click(function() {
                var RPJMDP = []
                $.each($("input[name='_MisiRPJMDP']:checked"), function(){
                    RPJMDP.push($(this).val())
                })
                var RPJMN = []
                $.each($("input[name='_Misi']:checked"), function(){
                    RPJMN.push($(this).val())
                })
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#Misi").val() == "") {
                    alert('Input Misi Belum Benar!')
                } else if ($("#PeriodeRPJMDP").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else if (!RPJMDP.length) {
                    alert("Mohon Checklist Misi RPJMN!")
                } else if ($("#PeriodeRPJMN").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else if (!RPJMN.length) {
                    alert("Mohon Checklist Misi RPJMN!")
                } else {
                    var Misi = { _Id    : $("#IdVisi").val(),
                                 Id_    : RPJMN.join("$"),
                                 IdP    : RPJMDP.join("$"),
                                 Misi   : $("#Misi").val() }
                    $.post(BaseURL+"SuperDaerah/InputMisiRPJMD", Misi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"SuperDaerah/MisiRPJMD"
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
                $.post(BaseURL+"SuperDaerah/GetVisiRPJMD", {Id : $("#_Periode").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var Visi = ''
                    for (let i = 0; i < Data.length; i++) {
                        Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>'
                    }
                    $("#_IdVisi").html(Visi)
                    $("#_IdVisi").val(Pisah[1])
                })
                $("#_Misi").val(Pisah[2])
                $.post(BaseURL+"SuperDaerah/GetVisiRPJMN", {Id : Pisah[3].split("$")[0]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#PeriodeRPJMN_").val(Data[0].IdVisi)
                    $.post(BaseURL+"SuperDaerah/GetMisiRPJMN", {Id : $("#PeriodeRPJMN_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="Misi_" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                        }
                        $("#MisiRPJMN_").html(Misi)
                        $("input[name='Misi_']").prop('checked', false);
                        Pisah[3].split("$").forEach(function(m) {
                            $("input[name='Misi_'][value='" + m + "']").prop('checked', true)
                        })
                    })
                }) 
                $.post(BaseURL+"SuperDaerah/GetVisiRPJMDP", {Id : Pisah[4].split("$")[0]}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    $("#PeriodeRPJMDP_").val(Data[0].IdVisi)
                    $.post(BaseURL+"SuperDaerah/GetMisiRPJMDP", {Id : $("#PeriodeRPJMDP_").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Misi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="Misi_RPJMDP" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                        }
                        $("#MisiRPJMDP_").html(Misi)
                        $("input[name='Misi_RPJMDP']").prop('checked', false);
                        Pisah[4].split("$").forEach(function(m) {
                            $("input[name='Misi_RPJMDP'][value='" + m + "']").prop('checked', true)
                        })
                    })
                })                         
                $('#ModalEditMisi').modal("show")
            })

            $("#Edit").click(function() {
                var RPJMDP = []
                $.each($("input[name='Misi_RPJMDP']:checked"), function(){
                    RPJMDP.push($(this).val())
                })
                var RPJMN = []
                $.each($("input[name='Misi_']:checked"), function(){
                    RPJMN.push($(this).val())
                })
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_Misi").val() == "") {
                    alert('Input Misi Belum Benar!')
                } else if ($("#PeriodeRPJMDP_").val() == "") {
                    alert("Mohon Input Periode RPJMD Provinsi")
                } else if (!RPJMDP.length) {
                    alert("Mohon Checklist Misi RPJMN!")
                } else if ($("#PeriodeRPJMN_").val() == "") {
                    alert("Mohon Input Periode RPJMN")
                } else if (!RPJMN.length) {
                    alert("Mohon Checklist Misi RPJMN!")
                } else {
                    var Misi = { Id     : $("#Id").val(),
                                 _Id    : $("#_IdVisi").val(),
                                 Id_    : RPJMN.join("$"),
                                 IdP    : RPJMDP.join("$"),
                                 Misi   : $("#_Misi").val() }
                    $.post(BaseURL+"SuperDaerah/EditMisiRPJMD", Misi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"SuperDaerah/MisiRPJMD"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var Misi = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"SuperDaerah/HapusMisiRPJMD", Misi).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"SuperDaerah/MisiRPJMD"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>