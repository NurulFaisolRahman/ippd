<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaran"><i class="notika-icon notika-edit"></i> <b>Input Sasaran RPJPD</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 15%;">Provinsi</th>
                                        <th style="width: 55%;">Sasaran RPJPD</th>
                                        <th style="width: 10%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Sasaran as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Nama']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Sasaran']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Sasaran'].'|'.$key['KodeWilayah']?>"><i class="notika-icon notika-edit"></i></button>
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
    <div class="modal fade" id="ModalInputSasaran" role="dialog">
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
                                            <label class="hrzn-fm"><b>Periode RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Periode"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tujuan RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="IdTujuan"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Sasaran RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="Sasaran" placeholder="Input Sasaran RPJPD"></textarea>
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
    <div class="modal fade" id="ModalEditSasaran" role="dialog">
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
                                            <label class="hrzn-fm"><b>Periode RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Periode"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tujuan RPJPD</b></label>
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
                                            <label class="hrzn-fm"><b>Sasaran RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="_Sasaran" placeholder="Input Sasaran RPJPD"></textarea>
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
                    $.post(BaseURL+"Super/GetProvinsiRPJPD", {Id : $("#Provinsi").val()}).done(function(Respon) {
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
                        $("#IdTujuan").html("")
                    })                         
                }
            });

            $("#_Provinsi").change(function(){
                if ($("#_Provinsi").val() == "") {
                    alert("Mohon Input Provinsi")
                } else {
                    $.post(BaseURL+"Super/GetProvinsiRPJPD", {Id : $("#_Provinsi").val()}).done(function(Respon) {
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
                        $("#_IdTujuan").html("")
                    })                         
                }
            });

            $("#Periode").change(function(){
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Super/GetTujuanRPJPD", {Id : $("#Periode").val()}).done(function(Respon) {
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
                    $.post(BaseURL+"Super/GetTujuanRPJPD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<option value="'+Data[i].Id+'">'+Data[i].Tujuan+'</option>'
                        }
                        $("#_IdTujuan").html(Tujuan)
                    })                         
                }
            });

            $("#Input").click(function() {
                if ($("#Provinsi").val() == "") {
                    alert('Input Provinsi Belum Benar!')
                } else if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#Sasaran").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else {
                    var Sasaran = { _Id   : $("#IdTujuan").val(),
                                 KodeWilayah : $("#Provinsi").val(),
                                 Sasaran   : $("#Sasaran").val() }
                    $.post(BaseURL+"Super/InputSasaranRPJPD", Sasaran).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Super/SasaranRPJPD"
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
                $("#_Provinsi").val(Pisah[3])
                $("#_Sasaran").val(Pisah[2])
                $.post(BaseURL+"Super/GetProvinsiRPJPD", {Id : $("#_Provinsi").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var Periode = ''
                    for (let i = 0; i < Data.length; i++) {
                        var Tujuan = '<option value="">Pilih Periode</option>'
                        Periode += '<option value="'+Data[i].Id+'">'+Data[i].TahunMulai+' - '+Data[i].TahunAkhir+'</option>'
                    }
                    $("#_Periode").html(Periode)   
                    $("#_Periode").val(Pisah[1])
                    $.post(BaseURL+"Super/GetTujuanRPJPD", {Id : $("#_Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Tujuan = ''
                        for (let i = 0; i < Data.length; i++) {
                            Tujuan += '<option value="'+Data[i].Id+'">'+Data[i].Tujuan+'</option>'
                        }
                        $("#_IdTujuan").html(Tujuan)
                        $("#_IdTujuan").val(Pisah[1])
                    })
                })                         
                
                $('#ModalEditSasaran').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Provinsi").val() == "") {
                    alert("Input Provinsi Belum Benar")
                } else if ($("#_Periode").val() == "") {
                    alert("Input Periode Belum Benar")
                } else if ($("#_Sasaran").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else {
                    var Sasaran = { Id   : $("#Id").val(),
                                 _Id   : $("#_IdTujuan").val(),
                                 KodeWilayah : $("#_Provinsi").val(),
                                 Sasaran   : $("#_Sasaran").val() }
                    $.post(BaseURL+"Super/EditSasaranRPJPD", Sasaran).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Super/SasaranRPJPD"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var Sasaran = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Super/HapusSasaranRPJPD", Sasaran).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Super/SasaranRPJPD"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>