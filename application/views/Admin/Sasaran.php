    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaran"><i class="notika-icon notika-support"></i> <b>Input Sasaran</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Sasaran</th>
                                        <th>Tahun</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Sasaran as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Sasaran']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Tahun']?></td>
                                        <td>
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['Tahun'].'|'.$key['IdTujuan'].'|'.$key['_Sasaran'].'|'.$key['Sasaran']?>"><i class="notika-icon notika-next"></i></button>
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
                                                    <input type="text" class="form-control input-sm" id="Tahun">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Jumlah Sasaran</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="number" class="form-control input-sm" id="JumlahSasaran" min="1" max="9" value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <?php $Sasaran = explode("<br/>",$VMTS[0]['Sasaran']); ?>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Tujuan</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="IdTujuan">
                                                        <?php foreach ($Tujuan as $k) { ?>
                                                            <option value="<?=$k['Id']?>"><?=$k['Tujuan']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ListInputSasaran">
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Sasaran</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <textarea class="form-control" rows="3" id="Sasaran" placeholder="Input Sasaran dari Tujuan Yang Dipilih"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Sasaran RPJPN</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <?php foreach ($Sasaran as $key => $value) { ?>
                                                        <label><input style="margin-top: 10px;" type="checkbox" name="_Sasaran" value="<?=$value?>"> <?=$value?></label><br>
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
    <div class="modal fade" id="ModalEditSasaran" role="dialog">
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
                                                <label class="hrzn-fm"><b>Tujuan</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="_IdTujuan">
                                                        <?php foreach ($Tujuan as $k) { ?>
                                                            <option value="<?=$k['Id']?>"><?=$k['Tujuan']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ListInputSasaran">
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Sasaran</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <textarea class="form-control" rows="3" id="_Sasaran" placeholder="Input Sasaran dari Tujuan Yang Dipilih"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Sasaran RPJPN</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <?php foreach ($Sasaran as $key => $value) { ?>
                                                        <label><input style="margin-top: 10px;" type="checkbox" name="Sasaran_" value="<?=$value?>"> <?=$value?></label><br>
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
            
            // $("#JumlahSasaran").change(function (){
            //     var JumlahSasaran = $("#JumlahSasaran").val()
            //     var ListSasaran = ''
            //     for (let i = 1; i <= JumlahSasaran; i++) {
            //         ListSasaran += '<div class="form-example-int form-horizental"><div class="form-group"><div class="row"><div class="col-lg-2"><label class="hrzn-fm"><b>Sasaran '+i+'</b></label></div><div class="col-lg-9"><div class="nk-int-st"><textarea class="form-control" rows="3" id="Sasaran'+i+'"></textarea></div></div></div></div></div><div class="form-example-int form-horizental"><div class="form-group"><div class="row"><div class="col-lg-2"><label class="hrzn-fm"><b>Sasaran RPJPN</b></label></div><div class="col-lg-9"><div class="nk-int-st"><?php foreach ($Sasaran as $key => $value) { ?><label><input style="margin-top: 10px;" type="checkbox"> <?=$value?></label><br><?php } ?></div></div></div></div></div>'
            //     }
            //     $("#ListInputSasaran").html(ListSasaran)
            // })

            $("#Input").click(function() {
                var Tampung = []
                $.each($("input[name='_Sasaran']:checked"), function(){
                    Tampung.push($(this).val())
                })
                if (isNaN($("#Tahun").val()) || $("#Tahun").val() == "") {
                    alert('Input Tahun Belum Benar!')
                } else if ($("#Sasaran").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Sasaran RPJPN!")
                } else {
                    var Sasaran = { IdTujuan: $("#IdTujuan").val(),
                                    _Sasaran: Tampung.join("$"),
                                    Sasaran: $("#Sasaran").val(),
                                    Tahun: $("#Tahun").val() }
                    $.post(BaseURL+"Admin/InputSasaran", Sasaran).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/Sasaran"
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
                $("#_IdTujuan").val(Pisah[2])
                $("#_Sasaran").val(Pisah[4])
                $("input[name='Sasaran_']").prop('checked', false);
                Pisah[3].split("$").forEach(function(m) {
                    $("input[name='Sasaran_'][value='" + m + "']").prop('checked', true);
                });
                $('#ModalEditSasaran').modal("show")
            })

            $("#Edit").click(function() {
                var Tampung = []
                $.each($("input[name='Sasaran_']:checked"), function(){
                    Tampung.push($(this).val())
                })
                if (isNaN($("#_Tahun").val()) || $("#_Tahun").val() == "") {
                    alert('Input Tahun Belum Benar!')
                } else if ($("#_Sasaran").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else if (!Tampung.length) {
                    alert("Mohon Checklist Sasaran RPJPN!")
                } else {
                    var Sasaran = { Id: $("#Id").val(),
                                   IdTujuan: $("#_IdTujuan").val(),
                                   Sasaran: $("#_Sasaran").val(),
                                   _Sasaran: Tampung.join("$"),
                                   Tahun: $("#_Tahun").val() }
                    $.post(BaseURL+"Admin/EditSasaran", Sasaran).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/Sasaran"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $(".Hapus").click(function() {
                var Sasaran = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Admin/HapusSasaran", Sasaran).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Admin/Sasaran"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
</body>

</html>