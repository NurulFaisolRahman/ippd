    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTujuan"><i class="notika-icon notika-edit"></i> <b>Input Tujuan</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 35%;">Misi</th>
                                        <th style="width: 35%;">Tujuan</th>
                                        <th style="width: 10%;">Periode</th>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Tujuan as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Misi']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Tujuan']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Tujuan'].'|'.$key['Id_']?>"><i class="notika-icon notika-next"></i></button>
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
                                                <label class="hrzn-fm"><b>Misi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="IdMisi">
                                                        <?php foreach ($Misi as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['Misi']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="Tujuan" placeholder="Input Tujuan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPN</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st text-justify">
                                                    <?php foreach ($_Tujuan as $key) { ?>
                                                        <label><input style="margin-top: 10px;" type="checkbox" name="_Tujuan" value="<?=$key['Id']?>"> <?=$key['Tujuan']?></label><br>
                                                    <?php } ?>
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
                                                <label class="hrzn-fm"><b>Misi</b></label>
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="_IdMisi">
                                                        <?php foreach ($Misi as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['Misi']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="_Tujuan" placeholder="Input Tujuan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan RPJPN</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st text-justify">
                                                    <?php foreach ($_Tujuan as $key) { ?>
                                                        <label><input style="margin-top: 10px;" type="checkbox" name="Tujuan_" value="<?=$key['Id']?>"> <?=$key['Tujuan']?></label><br>
                                                    <?php } ?>
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

            $("#Input").click(function() {
                var Tampung = []
                $.each($("input[name='_Tujuan']:checked"), function(){
                    Tampung.push($(this).val())
                })
                if ($("#Tujuan").val() == "") {
                    alert('Input Tujuan Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Tujuan RPJPN!")
                } else {
                    var Tujuan = { _Id      : $("#IdMisi").val(),
                                   Id_      : Tampung.join("$"),
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
                $("#_IdMisi").val(Pisah[1])
                $("#_Tujuan").val(Pisah[2])
                $("input[name='Tujuan_']").prop('checked', false);
                Pisah[3].split("$").forEach(function(m) {
                    $("input[name='Tujuan_'][value='" + m + "']").prop('checked', true);
                });
                $('#ModalEditTujuan').modal("show")
            })

            $("#Edit").click(function() {
                var Tampung = []
                $.each($("input[name='Tujuan_']:checked"), function(){
                    Tampung.push($(this).val())
                })
                if ($("#_Tujuan").val() == "") {
                    alert('Input Tujuan Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Tujuan RPJPN!")
                } else {
                    var Tujuan = { Id       : $("#Id").val(),
                                   _Id      : $("#_IdMisi").val(),
                                   Id_      : Tampung.join("$"),
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

            $(".Hapus").click(function() {
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