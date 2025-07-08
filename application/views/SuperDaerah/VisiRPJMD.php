<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputVisi"><i class="notika-icon notika-edit"></i> <b>Input Visi RPJMD</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 70%;">Visi RPJMD</th>
                                        <th style="width: 10%;">Periode</th>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Visi as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Visi']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['Visi'].'|'.$key['TahunMulai'].'|'.$key['TahunAkhir']?>"><i class="notika-icon notika-edit"></i></button>
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
    <div class="modal fade" id="ModalInputVisi" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                                                <label class="hrzn-fm"><b>Periode RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TahunMulai" placeholder="Tahun Mulai">
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TahunAkhir" placeholder="Tahun Akhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Visi RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="Visi" placeholder="Input Visi RPJMD"></textarea>
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
    <div class="modal fade" id="ModalEditVisi" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode RPJMD</b></label>
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="_TahunMulai" placeholder="Tahun Mulai">
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="_TahunAkhir" placeholder="Tahun Akhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Visi RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="_Visi"></textarea>
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
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>>
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
                if (isNaN($("#TahunMulai").val()) || $("#TahunMulai").val() == "" || $("#TahunMulai").val().length != 4) {
                    alert('Input Tahun Mulai Belum Benar!')
                } else if (isNaN($("#TahunAkhir").val()) || $("#TahunAkhir").val() == "" || $("#TahunAkhir").val().length != 4) {
                    alert('Input Tahun Akhir Belum Benar!')
                } else if ($("#Visi").val() == "") {
                    alert('Input Visi Belum Benar!')
                } else {
                    var Visi = { Visi       : $("#Visi").val(),
                                 TahunMulai : $("#TahunMulai").val(),
                                 TahunAkhir : $("#TahunAkhir").val() }
                    $.post(BaseURL+"SuperDaerah/InputVisiRPJMD", Visi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"SuperDaerah/VisiRPJMD"
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
                $("#_Visi").val(Pisah[1])
                $("#_TahunMulai").val(Pisah[2])
                $("#_TahunAkhir").val(Pisah[3])
                $('#ModalEditVisi').modal("show")
            })

            $("#Edit").click(function() {
                if (isNaN($("#_TahunMulai").val()) || $("#_TahunMulai").val() == "" || $("#_TahunMulai").val().length != 4) {
                    alert('Input Tahun Mulai Belum Benar!')
                } else if (isNaN($("#_TahunAkhir").val()) || $("#_TahunAkhir").val() == "" || $("#_TahunAkhir").val().length != 4) {
                    alert('Input Tahun Akhir Belum Benar!')
                } else if ($("#_Visi").val() == "") {
                    alert('Input Visi Belum Benar!')
                } else {
                    var Visi = { Id         : $("#Id").val(),
                                 Visi       : $("#_Visi").val(),
                                 TahunMulai : $("#_TahunMulai").val(),
                                 TahunAkhir : $("#_TahunAkhir").val() }
                    $.post(BaseURL+"SuperDaerah/EditVisiRPJMD", Visi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"SuperDaerah/VisiRPJMD"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var Visi = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"SuperDaerah/HapusVisiRPJMD", Visi).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"SuperDaerah/VisiRPJMD"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })  
    </script>
</body>

</html>