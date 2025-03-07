    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaran"><i class="notika-icon notika-support"></i> <b>Input Sasaran</b></button>
                            </div>
                            <!-- <h2>Basic Example</h2>
                            <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p> -->
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
                                            <button class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['Sasaran'].'|'.$key['Tahun']?>"><i class="notika-icon notika-next"></i></button>
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
                                <div class="form-example-int form-horizental">
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
                                </div>
                                <?php $Sasaran = explode("<br/>",$VMTS[0]['Sasaran']); ?>
                                <div id="ListInputSasaran">
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Sasaran 1</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <textarea class="form-control" rows="3" id="Sasaran1"></textarea>
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
                                                        <label><input style="margin-top: 10px;" type="checkbox"> <?=$value?></label><br>
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
                                                    <input type="text" class="form-control input-sm" id="tahun">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Sasaran</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="3" id="misi" wrap="off"></textarea>
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
    <!-- jquery
		============================================ -->
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="../js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="../js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="../js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="../js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
		============================================ -->
    <!-- <script src="../js/counterup/jquery.counterup.min.js"></script>
    <script src="../js/counterup/waypoints.min.js"></script>
    <script src="../js/counterup/counterup-active.js"></script> -->
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sparkline JS
		============================================ -->
    <!-- <script src="../js/sparkline/jquery.sparkline.min.js"></script>
    <script src="../js/sparkline/sparkline-active.js"></script> -->
    <!-- flot JS
		============================================ -->
    <!-- <script src="../js/flot/jquery.flot.js"></script>
    <script src="../js/flot/jquery.flot.resize.js"></script>
    <script src="../js/flot/flot-active.js"></script> -->
    <!-- knob JS
		============================================ -->
    <!-- <script src="../js/knob/jquery.knob.js"></script>
    <script src="../js/knob/jquery.appear.js"></script>
    <script src="../js/knob/knob-active.js"></script> -->
    <!--  Chat JS
		============================================ -->
    <!-- <script src="../js/chat/jquery.chat.js"></script> -->
    <!--  todo JS
		============================================ -->
    <!-- <script src="../js/todo/jquery.todo.js"></script> -->
	<!--  wave JS
		============================================ -->
    <!-- <script src="../js/wave/waves.min.js"></script>
    <script src="../js/wave/wave-active.js"></script> -->
    <!-- plugins JS
		============================================ -->
    <!-- <script src="../js/plugins.js"></script> -->
    <!-- Data Table JS
		============================================ -->
    <script src="../js/data-table/jquery.dataTables.min.js"></script>
    <script src="../js/data-table/data-table-act.js"></script>
    <!-- main JS
    ============================================ -->
    <script src="../js/main.js"></script>
    <script>
        var BaseURL = '<?=base_url()?>'
        jQuery(document).ready(function($) {
            $("#JumlahSasaran").change(function (){
                var JumlahSasaran = $("#JumlahSasaran").val()
                var ListSasaran = ''
                for (let i = 1; i <= JumlahSasaran; i++) {
                    ListSasaran += '<div class="form-example-int form-horizental"><div class="form-group"><div class="row"><div class="col-lg-2"><label class="hrzn-fm"><b>Sasaran '+i+'</b></label></div><div class="col-lg-9"><div class="nk-int-st"><textarea class="form-control" rows="3" id="Sasaran'+i+'"></textarea></div></div></div></div></div><div class="form-example-int form-horizental"><div class="form-group"><div class="row"><div class="col-lg-2"><label class="hrzn-fm"><b>Sasaran RPJPN</b></label></div><div class="col-lg-9"><div class="nk-int-st"><?php foreach ($Sasaran as $key => $value) { ?><label><input style="margin-top: 10px;" type="checkbox"> <?=$value?></label><br><?php } ?></div></div></div></div></div>'
                }
                $("#ListInputSasaran").html(ListSasaran)
            })
            $("#Input").click(function() {
                if (isNaN($("#Tahun").val()) || $("#Tahun").val() == "") {
                    alert('Input Tahun Belum Benar!')
                } else if ($("#Sasaran").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else {
                    var Sasaran = { Sasaran: $("#Sasaran").val(),
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
                $("#misi").val(Pisah[1])
                $("#tahun").val(Pisah[2])
                $('#ModalEditSasaran').modal("show")
            })

            $("#Edit").click(function() {
                if (isNaN($("#tahun").val())) {
                    alert('Input Tahun Belum Benar!')
                } else if ($("#visi").val() == "") {
                    alert('Input Sasaran Belum Benar!')
                } else {
                    var Sasaran = { Sasaran: $("#misi").val(),
                                Id: $("#Id").val(), 
                                Tahun: $("#tahun").val() }
                    $.post(BaseURL+"Admin/EditSasaran", Sasaran).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/Sasaran"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })
        })
    </script>
</body>

</html>