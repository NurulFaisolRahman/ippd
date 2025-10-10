<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaranPembangunanDaerah"><i class="notika-icon notika-edit"></i> <b>Input Sasaran Pembangunan Daerah</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 10%;">Provinsi</th>
                                        <th style="width: 10%;">LPE</th>
                                        <th style="width: 10%;">Kemiskinan</th>
                                        <th style="width: 10%;">TPT</th>
                                        <th style="width: 10%;">IMM</th>
                                        <th style="width: 10%;">Rasio GINI</th>
                                        <th style="width: 10%;">Intensitas Emisi GRK</th>
                                        <th style="width: 10%;">Tahun</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($SasaranPembangunanDaerah as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Nama']?></td>
                                        <td style="vertical-align: middle;"><?=$key['LPE']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Kemiskinan']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TPT']?></td>
                                        <td style="vertical-align: middle;"><?=$key['IMM']?></td>
                                        <td style="vertical-align: middle;"><?=$key['RasioGINI']?></td>
                                        <td style="vertical-align: middle;"><?=$key['IntensitasEmisiGRK']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Tahun']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['LPE'].'|'.$key['Kemiskinan'].'|'.$key['TPT'].'|'.$key['IMM'].'|'.$key['RasioGINI'].'|'.$key['IntensitasEmisiGRK'].'|'.$key['Tahun'].'|'.$key['Kode']?>"><i class="notika-icon notika-edit"></i></button>
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
    <div class="modal fade" id="ModalInputSasaranPembangunanDaerah" role="dialog">
        <div class="modal-dialog modals-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="Tahun">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-8">
                                            <select class="form-control" id="Provinsi">
                                            <?php foreach ($Provinsi as $key) { ?>
                                                <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>LPE</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="LPE">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Kemiskinan</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="Kemiskinan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>TPT</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TPT">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>IMM</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="IMM">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Rasio GINI</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="RasioGINI">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Intensitas Emisi GRK</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="IntensitasEmisiGRK">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-8">
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
    <div class="modal fade" id="ModalEditSasaranPembangunanDaerah" role="dialog">
        <div class="modal-dialog modals-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                                <input type="text" class="form-control input-sm" id="_Tahun">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-8">
                                            <select class="form-control" id="_Provinsi">
                                            <?php foreach ($Provinsi as $key) { ?>
                                                <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>LPE</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_LPE">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Kemiskinan</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_Kemiskinan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>TPT</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_TPT">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>IMM</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_IMM">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Rasio GINI</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_RasioGINI">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Intensitas Emisi GRK</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="_IntensitasEmisiGRK">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-8">
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

            $("#Input").click(function() {
                if (isNaN($("#Tahun").val()) || $("#Tahun").val() == "" || $("#Tahun").val().length != 4) {
                    alert("Input Tahun Belum Benar!")
                } else if ($("#LPE").val() == "") {
                    alert('Input LPE Belum Benar!')
                } else if ($("#Kemiskinan").val() == "") {
                    alert('Input Kemiskinan Belum Benar!')
                } else if ($("#TPT").val() == "") {
                    alert('Input TPT Belum Benar!')
                } else if ($("#IMM").val() == "") {
                    alert('Input IMM Belum Benar!')
                } else if ($("#RasioGINI").val() == "") {
                    alert('Input Rasio GINI Belum Benar!')
                } else if ($("#IntensitasEmisiGRK").val() == "") {
                    alert('Input Intensitas Emisi GRK Belum Benar!')
                } else {
                    var SasaranPembangunanDaerah = { Provinsi           : $("#Provinsi").val(),
                                                     LPE                : $("#LPE").val(),
                                                     Kemiskinan         : $("#Kemiskinan").val(),
                                                     TPT                : $("#TPT").val(),
                                                     IMM                : $("#IMM").val(),
                                                     RasioGINI          : $("#RasioGINI").val(),
                                                     IntensitasEmisiGRK : $("#IntensitasEmisiGRK").val(),
                                                     Tahun              : $("#Tahun").val() }
                    $.post(BaseURL+"Nasional/InputSasaranPembangunanDaerah", SasaranPembangunanDaerah).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/SasaranPembangunanDaerah"
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
                $("#_LPE").val(Pisah[1])
                $("#_Kemiskinan").val(Pisah[2])
                $("#_TPT").val(Pisah[3])
                $("#_IMM").val(Pisah[4])
                $("#_RasioGINI").val(Pisah[5])
                $("#_IntensitasEmisiGRK").val(Pisah[6])
                $("#_Tahun").val(Pisah[7])
                $("#_Provinsi").val(Pisah[8])
                $('#ModalEditSasaranPembangunanDaerah').modal("show")
            })

            $("#Edit").click(function() {
                if (isNaN($("#_Tahun").val()) || $("#_Tahun").val() == "" || $("#_Tahun").val().length != 4) {
                    alert("Input Tahun Belum Benar!")
                } else if ($("#_LPE").val() == "") {
                    alert('Input LPE Belum Benar!')
                } else if ($("#_Kemiskinan").val() == "") {
                    alert('Input Kemiskinan Belum Benar!')
                } else if ($("#_TPT").val() == "") {
                    alert('Input TPT Belum Benar!')
                } else if ($("#_IMM").val() == "") {
                    alert('Input IMM Belum Benar!')
                } else if ($("#_RasioGINI").val() == "") {
                    alert('Input Rasio GINI Belum Benar!')
                } else if ($("#_IntensitasEmisiGRK").val() == "") {
                    alert('Input Intensitas Emisi GRK Belum Benar!')
                } else {
                    var SasaranPembangunanDaerah = { Id                 : $("#Id").val(),
                                                     Provinsi           : $("#_Provinsi").val(),
                                                     LPE                : $("#_LPE").val(),
                                                     Kemiskinan         : $("#_Kemiskinan").val(),
                                                     TPT                : $("#_TPT").val(),
                                                     IMM                : $("#_IMM").val(),
                                                     RasioGINI          : $("#_RasioGINI").val(),
                                                     IntensitasEmisiGRK : $("#_IntensitasEmisiGRK").val(),
                                                     Tahun              : $("#_Tahun").val() }
                    $.post(BaseURL+"Nasional/EditSasaranPembangunanDaerah", SasaranPembangunanDaerah).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/SasaranPembangunanDaerah"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var SasaranPembangunanDaerah = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusSasaranPembangunanDaerah", SasaranPembangunanDaerah).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanDaerah"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>