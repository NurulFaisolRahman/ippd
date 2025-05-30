    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputAkun"><i class="notika-icon notika-edit"></i> <b>Buat Akun</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th style="width: 15%;">Username</th>
                                        <th>Password (Hashed)</th>
                                        <th>Level</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Akun as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Username']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Password']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Level'] == 1 ? 'Kementerian' : ($key['Level'] == 2 ? 'Provinsi': 'Kab/kota');?></td>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <!-- <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Username']?>"><i class="notika-icon notika-edit"></i></button> -->
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['Username']?>"><i class="notika-icon notika-trash"></i></button>
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
    <div class="modal fade" id="ModalInputAkun" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Akun</b></label>
                                            </div>
                                            <div style="margin-bottom: 5px;" class="col-lg-9">
                                                <select class="form-control" id="User">
                                                    <option value="">Pilih Akun</option>
                                                    <option value="1">Kementerian</option>
                                                    <option value="2">Provinsi</option>
                                                    <option value="3">Kab/Kota</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="ListPeriode" style="display: none;">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div style="margin-bottom: 5px;" class="col-lg-9">
                                                <select class="form-control" id="Periode"></select>
                                            </div>
                                        </div>
                                        <div class="row" id="ListKementerian" style="display: none;">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Kementerian</b></label>
                                            </div>
                                            <div style="margin-bottom: 5px;" class="col-lg-9">
                                                <select class="form-control" id="Kementrian"></select>
                                            </div>
                                        </div>
                                        <div class="row" id="ListProvinsi" style="display: none;">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Provinsi</b></label>
                                            </div>
                                            <div style="margin-bottom: 5px;" class="col-lg-9">
                                                <select class="form-control" id="Provinsi"></select>
                                            </div>
                                        </div>
                                        <div class="row" id="ListKabKota" style="display: none;">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Kab/Kota</b></label>
                                            </div>
                                            <div style="margin-bottom: 5px;" class="col-lg-9">
                                                <select class="form-control" id="KabKota"></select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px;">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Username</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control input-sm" id="Username" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px;">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Password</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control input-sm" id="Password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
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

            $("#User").change(function(){
                if ($("#User").val() == "") {
                    alert("Mohon Pilih Akun")
                } else if ($("#User").val() == "1") {
                    $.post(BaseURL+"Super/GetPeriodeKementerian").done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Periode = '<option value="">Pilih Periode</option>'
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                Periode += '<option value="'+Data[i].TahunMulai+'">'+Data[i].TahunMulai+' - '+Data[i].TahunAkhir+'</option>'
                            }    
                        } else {
                            alert("Belum Ada Data")
                        }
                        $("#Periode").html(Periode)
                        $("#ListPeriode").css("display", "block");
                        var Kementerian = '<option value="">Pilih Kementerian</option>'
                        $("#Kementrian").html(Kementerian)
                        $("#ListKementerian").css("display", "block");
                        $("#ListProvinsi").css("display", "none");
                        $("#ListKabKota").css("display", "none");
                    })                         
                } else {
                    $.post(BaseURL+"Super/GetListProvinsi").done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Provinsi = '<option value="">Pilih Provinsi</option>'
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                Provinsi += '<option value="'+Data[i].Kode+'">'+Data[i].Nama+'</option>'
                            }   
                            $("#Provinsi").html(Provinsi)
                            $("#ListKementerian").css("display", "none");
                            $("#ListPeriode").css("display", "none");
                            $("#ListProvinsi").css("display", "block");
                            if ($("#User").val() == "2") {    
                                $("#ListKabKota").css("display", "none");
                            } else {
                                var KabKota = '<option value="">Pilih Kab/Kota</option>'
                                $("#KabKota").html(KabKota)
                                $("#ListKabKota").css("display", "block");
                            }
                        } else {
                            alert("Belum Ada Data")
                        }
                    })                         
                } 
            });

            $("#Periode").change(function(){
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else {
                    $.post(BaseURL+"Super/GetListKementerian", {TahunMulai:$("#Periode").val()}).done(function(Respon) {
                        var Data = JSON.parse(Respon)
                        var Kementerian = '<option value="">Pilih Kementerian</option>'
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                Kementerian += '<option value="'+Data[i].Id+'">'+Data[i].NamaKementerian+'</option>'
                            }    
                        } else {
                            alert("Belum Ada Data")
                        }
                        $("#Kementrian").html(Kementerian)
                    })                     
                }
            });

            $("#Provinsi").change(function(){
                $.post(BaseURL+"Super/GetListKabKota", { Kode : $("#Provinsi").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var KabKota = '<option value="">Pilih Kab/Kota</option>'
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            KabKota += '<option value="'+Data[i].Kode+'">'+Data[i].Nama+'</option>'
                        }    
                    } else {
                        alert("Belum Ada Data")
                    }
                    $("#KabKota").html(KabKota)
                })
            }); 

            $("#Input").click(function() {
                if ($("#User").val() == "") {
                    alert('Input Akun Belum Benar!')
                    return false
                } else if ($("#User").val() == "1") {
                    if ($("#Periode").val() == "") {
                        alert("Mohon Input Periode")
                        return false
                    } else if ($("#Kementrian").val() == "") {
                        alert("Mohon Input Kementerian")
                        return false
                    }
                } else if ($("#User").val() == "2") {
                    if ($("#Provinsi").val() == "") {
                        alert("Mohon Input Provinsi")
                        return false
                    }
                } else if ($("#User").val() == "3") {
                    if ($("#KabKota").val() == "") {
                        alert("Mohon Input Kab/Kota")
                        return false
                    }
                } 
                if ($("#Username").val() == "") {
                    alert('Input Username Belum Benar!')
                } else if ($("#Password").val() == "") {
                    alert('Input Password Belum Benar!')
                } else {
                    var Akun = { Level: $("#User").val(),
                                 Username: $("#Username").val(),
                                 Password: $("#Password").val() }
                    if ($("#User").val() == "1") {
                        Akun['IdKementerian'] = $("#Kementrian").val()
                    } else if ($("#User").val() == "2") {
                        Akun['KodeWilayah'] = $("#Provinsi").val()
                    } else if ($("#User").val() == "3") {
                        Akun['KodeWilayah'] = $("#KabKota").val()
                    }  
                    $.post(BaseURL+"Super/InputAkun", Akun).done(function(Respon) {
                        if (Respon == '1') {
                            window.location.reload()
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
                $("#_Username").val(Pisah[1])
                $('#ModalEditAkun').modal("show")
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var Akun = { Username: $(this).attr('Hapus') }
                $.post(BaseURL+"Super/HapusAkun", Akun).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload()
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })  
    </script>

</body>
</html>