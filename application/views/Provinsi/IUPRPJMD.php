<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIUP"><i class="notika-icon notika-edit"></i> <b>Input IUP RPJMD</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 10%;">Provinsi</th>    
                                        <th style="width: 30%;">IUP RPJMD</th>
                                        <th style="width: 10%;">Baseline</th>
                                        <th style="width: 10%;">Target Awal</th>
                                        <th style="width: 10%;">Target Akhir</th>
                                        <th style="width: 10%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($IUP as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Nama']?></td>
                                        <td style="vertical-align: middle;"><?=$key['IUP']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Baseline']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TargetAwal']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TargetAkhir']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['IUP'].'|'.$key['Baseline'].'|'.$key['TargetAwal'].'|'.$key['TargetAkhir'].'|'.$key['KodeWilayah']?>"><i class="notika-icon notika-edit"></i></button>
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
    <div class="modal fade" id="ModalInputIUP" role="dialog">
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
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Provinsi">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($Provinsi as $key) { ?>
                                                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode RPJMD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Periode"></select>
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
                                            <label class="hrzn-fm"><b>IUP RPJMD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="IUP" placeholder="Input IUP RPJMD"></textarea>
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
    <div class="modal fade" id="ModalEditIUP" role="dialog">
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
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Provinsi">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($Provinsi as $key) { ?>
                                                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode RPJMD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Periode"></select>
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
                                            <label class="hrzn-fm"><b>IUP RPJMD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="_IUP" placeholder="Input IUP RPJMD"></textarea>
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

            $("#Provinsi").change(function(){
                if ($("#Provinsi").val() == "") {
                    alert("Mohon Input Provinsi")
                } else {
                    $.post(BaseURL+"Super/GetProvinsiRPJMD", {Id : $("#Provinsi").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Periode = '<option value="">Pilih Periode</option>'
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                Periode += '<option value="'+Data[i].Id+'">'+Data[i].TahunMulai+' - '+Data[i].TahunAkhir+'</option>'
                            }    
                        } else {
                            alert("Belum Ada Data Provinsi Tersebut")
                        }
                        $("#Periode").html(Periode)
                        $("#IdVisi").html("")
                    })                         
                }
            });

            $("#_Provinsi").change(function(){
                if ($("#_Provinsi").val() == "") {
                    alert("Mohon Input Provinsi")
                } else {
                    $.post(BaseURL+"Super/GetProvinsiRPJMD", {Id : $("#_Provinsi").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Periode = '<option value="">Pilih Periode</option>'
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                Periode += '<option value="'+Data[i].Id+'">'+Data[i].TahunMulai+' - '+Data[i].TahunAkhir+'</option>'
                            }    
                        } else {
                            alert("Belum Ada Data Provinsi Tersebut")
                        }
                        $("#_Periode").html(Periode)
                        $("#_IdVisi").html("")
                    })                         
                }
            });

            $("#Periode").change(function(){
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Super/GetVisiRPJMD", {Id : $("#Periode").val()}).done(function(Respon) {
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
                    $.post(BaseURL+"Super/GetVisiRPJMD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Visi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>'
                        }
                        $("#_IdVisi").html(Visi)
                    })                         
                }
            });

            $("#Input").click(function() {
                if ($("#Provinsi").val() == "") {
                    alert('Input Provinsi Belum Benar!')
                } else if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#IUP").val() == "") {
                    alert('Input IUP Belum Benar!')
                } else if ($("#Baseline").val() == "") {
                    alert('Input Baseline Belum Benar!')
                } else if ($("#TargetAwal").val() == "") {
                    alert('Input Target Awal Belum Benar!')
                } else if ($("#TargetAkhir").val() == "") {
                    alert('Input Target Akhir Belum Benar!')
                } else {
                    var IUP = { _Id   : $("#IdVisi").val(),
                                KodeWilayah : $("#Provinsi").val(),
                                IUP   : $("#IUP").val(),
                                Baseline   : $("#Baseline").val(),
                                TargetAwal   : $("#TargetAwal").val(),
                                TargetAkhir   : $("#TargetAkhir").val() }
                    $.post(BaseURL+"Super/InputIUPRPJMD", IUP).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Super/IUPRPJMD"
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
                $("#_Provinsi").val(Pisah[6])
                $.post(BaseURL+"Super/GetProvinsiRPJMD", {Id : $("#_Provinsi").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var Periode = ''
                    for (let i = 0; i < Data.length; i++) {
                        var Visi = '<option value="">Pilih Periode</option>'
                        Periode += '<option value="'+Data[i].Id+'">'+Data[i].TahunMulai+' - '+Data[i].TahunAkhir+'</option>'
                    }
                    $("#_Periode").html(Periode)   
                    $("#_Periode").val(Pisah[1])
                    $.post(BaseURL+"Super/GetVisiRPJMD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Visi = ''
                        for (let i = 0; i < Data.length; i++) {
                            Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>'
                        }
                        $("#_IdVisi").html(Visi)
                        $("#_IdVisi").val(Pisah[1])
                    })
                })
                $("#_IUP").val(Pisah[2])
                $("#_Baseline").val(Pisah[3])
                $("#_TargetAwal").val(Pisah[4])
                $("#_TargetAkhir").val(Pisah[5])
                $('#ModalEditIUP').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Provinsi").val() == "") {
                    alert('Input Provinsi Belum Benar!')
                } else if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_IUP").val() == "") {
                    alert('Input IUP Belum Benar!')
                } else if ($("#_Baseline").val() == "") {
                    alert('Input Baseline Belum Benar!')
                } else if ($("#_TargetAwal").val() == "") {
                    alert('Input Target Awal Belum Benar!')
                } else if ($("#_TargetAkhir").val() == "") {
                    alert('Input Target Akhir Belum Benar!')
                } else {
                    var IUP = { Id   : $("#Id").val(),
                                _Id   : $("#_IdVisi").val(),
                                KodeWilayah : $("#_Provinsi").val(),
                                IUP   : $("#_IUP").val(),
                                Baseline   : $("#_Baseline").val(),
                                TargetAwal   : $("#_TargetAwal").val(),
                                TargetAkhir   : $("#_TargetAkhir").val() }
                    $.post(BaseURL+"Super/EditIUPRPJMD", IUP).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Super/IUPRPJMD"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var IUP = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Super/HapusIUPRPJMD", IUP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Super/IUPRPJMD"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>