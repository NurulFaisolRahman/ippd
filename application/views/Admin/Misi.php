    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputMisi"><i class="notika-icon notika-form"></i> <b>Input Misi</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Misi</th>
                                        <th>Tahun</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Misi as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Misi']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Tahun']?></td>
                                        <td>
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['Tahun'].'|'.$key['Misi'].'|'.$key['_Misi']?>"><i class="notika-icon notika-next"></i></button>
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
        <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-y: auto;max-height: 600px;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tahun</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="Tahun" placeholder="Input Hanya Angka">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Jumlah Misi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="number" class="form-control input-sm" id="JumlahMisi" min="1" max="9" value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <?php $Misi = explode("<br/>",$VMTS[0]['Misi']); ?>
                                <div id="ListInputMisi">
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Misi</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <textarea class="form-control" rows="3" id="Misi" placeholder="Input Disini"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Misi RPJPN</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <?php foreach ($Misi as $key => $value) { ?>
                                                            <label><input style="margin-top: 10px;" type="checkbox" name="_Misi" value="<?=$value?>"> <?=$value?></label><br>
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
        <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                                                <label class="hrzn-fm"><b>Tahun</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="hidden" class="form-control input-sm" id="Id">
                                                    <input type="text" class="form-control input-sm" id="_Tahun">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Misi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="_Misi" wrap="off"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Misi RPJPN</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <?php foreach ($Misi as $key => $value) { ?>
                                                        <label><input style="margin-top: 10px;" type="checkbox" name="Misi_" value="<?=$value?>"> <?=$value?></label><br>
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

            // $("#JumlahMisi").change(function (){
            //     var JumlahMisi = $("#JumlahMisi").val()
            //     var ListMisi = ''
            //     for (let i = 1; i <= JumlahMisi; i++) {
            //         ListMisi += '<div class="form-example-int form-horizental"><div class="form-group"><div class="row"><div class="col-lg-2"><label class="hrzn-fm"><b>Misi '+i+'</b></label></div><div class="col-lg-9"><div class="nk-int-st"><textarea class="form-control" rows="3" id="Misi'+i+'" placeholder="Input Disini"></textarea></div></div></div></div></div><div class="form-example-int form-horizental"><div class="form-group"><div class="row"><div class="col-lg-2"><label class="hrzn-fm"><b>Misi RPJPN</b></label></div><div class="col-lg-9"><div class="nk-int-st"><?php foreach ($Misi as $key => $value) { ?><label><input style="margin-top: 10px;" type="checkbox" name="_Misi'+i+'"> <?=$value?></label><br><?php } ?></div></div></div></div></div>'
            //     }
            //     $("#ListInputMisi").html(ListMisi)
            // })

            $("#Input").click(function() {
                var Tampung = []
                $.each($("input[name='_Misi']:checked"), function(){
                    Tampung.push($(this).val())
                })
                if (isNaN($("#Tahun").val()) || $("#Tahun").val() == "") {
                    alert('Input Tahun Belum Benar!')
                } else if ($("#Misi").val() == "") {
                    alert('Input Misi Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Misi RPJPN!")
                } else {
                    var Misi = { Misi: $("#Misi").val(),
                                 _Misi: Tampung.join("$"),
                                 Tahun: $("#Tahun").val() }
                    $.post(BaseURL+"Admin/InputMisi", Misi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/Misi"
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
                $("#_Tahun").val(Pisah[1])
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
                if (isNaN($("#_Tahun").val()) || $("#_Tahun").val() == "") {
                    alert('Input Tahun Belum Benar!')
                } else if ($("#_Misi").val() == "") {
                    alert('Input Misi Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Misi RPJPN!")
                } else {
                    var Misi = { Id: $("#Id").val(),
                                 Misi: $("#_Misi").val(),
                                 _Misi: Tampung.join("$"),
                                 Tahun: $("#_Tahun").val() }
                    $.post(BaseURL+"Admin/EditMisi", Misi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/Misi"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $(".Hapus").click(function() {
                var Misi = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Admin/HapusMisi", Misi).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Admin/Misi"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>