    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputMisi"><i class="notika-icon notika-edit"></i> <b>Input Misi</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 70%;">Misi</th>
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
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Misi'].'|'.$key['Id_']?>"><i class="notika-icon notika-next"></i></button>
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
                                                <label class="hrzn-fm"><b>Visi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="IdVisi">
                                                        <?php foreach ($Visi as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['Visi']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Misi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="Misi" placeholder="Input Misi"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Misi RPJMN</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st text-justify">
                                                        <?php foreach ($_Misi as $key) { ?>
                                                            <label><input style="margin-top: 10px;" type="checkbox" name="_Misi" value="<?=$key['Id']?>"> <?=$key['Misi']?></label><br>
                                                        <?php } ?>
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
                                                <label class="hrzn-fm"><b>Visi</b></label>
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="_IdVisi">
                                                        <?php foreach ($Visi as $key) { ?>
                                                            <option value="<?=$key['Id']?>"><?=$key['Visi']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 9px;">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Misi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="_Misi" placeholder="Input Misi"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Misi RPJMN</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st text-justify">
                                                    <?php foreach ($_Misi as $key) { ?>
                                                        <label><input style="margin-top: 10px;" type="checkbox" name="Misi_" value="<?=$key['Id']?>"> <?=$key['Misi']?></label><br>
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
                $.each($("input[name='_Misi']:checked"), function(){
                    Tampung.push($(this).val())
                })
                if ($("#Misi").val() == "") {
                    alert('Input Misi Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Misi RPJMN!")
                } else {
                    var Misi = { _Id    : $("#IdVisi").val(),
                                 Id_    : Tampung.join("$"),
                                 Misi   : $("#Misi").val() }
                    $.post(BaseURL+"Admin/InputMisiRPJMD", Misi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/MisiRPJMD"
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
                $("#_IdVisi").val(Pisah[1])
                $("#_Misi").val(Pisah[2])
                $("input[name='Misi_']").prop('checked', false);
                Pisah[3].split("$").forEach(function(m) {
                    $("input[name='Misi_'][value='" + m + "']").prop('checked', true);
                });
                $('#ModalEditMisi').modal("show")
            })

            $("#Edit").click(function() {
                var Tampung = []
                $.each($("input[name='Misi_']:checked"), function(){
                    Tampung.push($(this).val())
                })
                if ($("#_Misi").val() == "") {
                    alert('Input Misi Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Misi RPJMN!")
                } else {
                    var Misi = { Id     : $("#Id").val(),
                                 _Id    : $("#_IdVisi").val(),
                                 Id_    : Tampung.join("$"),
                                 Misi   : $("#_Misi").val() }
                    $.post(BaseURL+"Admin/EditMisiRPJMD", Misi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/MisiRPJMD"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $(".Hapus").click(function() {
                var Misi = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Admin/HapusMisiRPJMD", Misi).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Admin/MisiRPJMD"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>