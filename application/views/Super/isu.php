<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsu">
                                <i class="notika-icon notika-edit"></i> <b>Input Isu Strategis</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Kementerian</th>
                                        <th>Isu Strategis</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            <tbody>
                <?php $No = 1; foreach ($Isu as $key) { 
                    $isuList = explode("\n", $key['NamaIsu']); 
                    $formattedIsu = "";
                    foreach ($isuList as $index => $isu) {
                        $formattedIsu .= ($index + 1) . ". " . trim($isu) . "<br>"; 
                    }
                ?>
                <tr>
                    <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                    <td style="vertical-align: middle;"><?=$key['NamaKementerian']?></td>
                    <td style="vertical-align: top;"><?=$formattedIsu?></td>
                    <td style="vertical-align: middle;"><?=$key['Tahun']?></td>
                    <td style="vertical-align: middle;"> 
                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                            <button class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id']?>"><i class="notika-icon notika-next"></i></button>
                            <button class="btn btn-danger danger-icon-notika btn-reco-mg btn-button-mg Delete" Delete="<?=$key['Id']?>"><i class="notika-icon notika-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<div class="modal fade" id="ModalInputIsu" role="dialog">
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
                                            <label class="hrzn-fm"><b>Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="KementerianId">
                                                    <?php foreach ($Kementerian as $k) { ?>
                                                        <option value="<?=$k['Id']?>"><?=$k['NamaKementerian']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <label class="hrzn-fm"><b>Isu Strategis</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                            <textarea class="form-control" rows="3" id="NamaIsu"></textarea>
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
<div class="modal fade" id="ModalEditIsu" role="dialog">
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
                                            <label class="hrzn-fm"><b>Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="kementerianId">
                                                    <?php foreach ($Kementerian as $k) { ?>
                                                        <option value="<?=$k['Id']?>"><?=$k['NamaKementerian']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahun</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
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
                                            <label class="hrzn-fm"><b>Isu Strategis</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" class="form-control input-sm" id="Id"> 
                                                <input type="text" class="form-control input-sm" id="namaIsu">
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
    var BaseURL = '<?=base_url()?>';
    jQuery(document).ready(function($) {
        
        $("#Input").click(function() {
            var IsuStrategis = { 
                NamaIsu: $("#NamaIsu").val().split("\n"),
                KementerianId: $("#KementerianId").val(),
                Tahun: $("#Tahun").val()
            };
            $.post(BaseURL + "Super/InputIsu", IsuStrategis).done(function(Respon) {
                if (Respon == '1') {
                    window.location = BaseURL + "Super/Isu";
                } else {
                    alert(Respon);
                }
            });
        });

        $(document).on("click", ".Edit", function() {
            var Id = $(this).attr('Edit');
            $.post(BaseURL + "Super/GetIsu/" + Id).done(function(Respon) {
                var Data = JSON.parse(Respon);
                $("#Id").val(Data.Id);
                $("#namaIsu").val(Data.NamaIsu);
                $("#kementerianId").val(Data.KementerianId);
                $("#tahun").val(Data.Tahun);
                $('#ModalEditIsu').modal("show");
            });
        });

        $("#Edit").click(function() {
            var IsuStrategis = { 
                Id: $("#Id").val(),
                NamaIsu: $("#namaIsu").val(),
                KementerianId: $("#kementerianId").val(),
                Tahun: $("#tahun").val()
            };
            $.post(BaseURL + "Super/EditIsu", IsuStrategis).done(function(Respon) {
                if (Respon == '1') {
                    window.location = BaseURL + "Super/Isu";
                } else {
                    alert(Respon);
                }
            });
        });

        $(document).on("click", ".Delete", function() {
    var Id = $(this).attr('Delete'); 
    $.post(BaseURL + "Super/DeleteIsu/" + Id).done(function(Respon) {
        if (Respon == '1') {
            window.location = BaseURL + "Super/Isu"; 
        } else {
            alert("Gagal menghapus data!"); 
        }
    });
});
    });

</script>
</body>
</html>