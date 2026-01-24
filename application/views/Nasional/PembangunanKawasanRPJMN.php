<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputKawasanProvinsi"><i class="notika-icon notika-edit"></i> <b>Input Kawasan Provinsi</b></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="text-center">No</th>
                                        <th style="width: 35%;">Nama Provinsi / <br> Nama Kawasan</th>
                                        <th style="width: 10%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <th style="width: 10%;" class="text-center">Edit</th>
                                        <th style="width: 10%;" class="text-center">Kawasan</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $groupedData = [];
                                        foreach ($NamaKawasan as $row) {
                                            $id = $row['_Id'];
                                            // Jika ID sasaran belum ada di array grouped, buat induknya
                                            if (!isset($groupedData[$id])) {
                                                $groupedData[$id] = [];
                                            }
                                            // Masukkan sub-data (indikator) jika ada
                                            if ($row['Id'] != null) {
                                                $groupedData[$id][] = [
                                                    'Id' => $row['Id'],
                                                    '_Id' => $row['_Id'],
                                                    'NamaProvinsi' => $row['Nama'],
                                                    'NamaKawasan' => $row['NamaKawasan'],
                                                ];
                                            }
                                        } 
                                        $No = 1; foreach ($WilayahKawasan as $key) { ?>
                                    <tr style="cursor: pointer; font-weight: bold;">
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td onclick="toggleRows('group<?=$key['Id']?>')" style="vertical-align: middle;"><?=$key['Nama']?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Provinsi']?>"><i class="notika-icon notika-edit"></i></button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['Id']?>"><i class="notika-icon notika-trash"></i></button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary amber-icon-notika btn-reco-mg btn-button-mg InputNamaKawasan" InputNamaKawasan="<?=$key['Id'].'|'.$key['Nama']?>"><i class="notika-icon notika-edit"></i></button>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php if (!empty($groupedData)) { foreach ($groupedData[$key['Id']] as $ind) { ?>
                                        <tr class="group<?=$key['Id']?>" style="display: none;">
                                            <td></td>
                                            <td>↳ <?=$ind['NamaKawasan']?></td>
                                            <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg _Edit" _Edit="<?=$ind['Id'].'|'.$ind['NamaProvinsi'].'|'.$ind['NamaKawasan']?>"><i class="notika-icon notika-edit"></i></button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg _Hapus" _Hapus="<?=$ind['Id']?>"><i class="notika-icon notika-trash"></i></button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php } } } ?>
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalInputKawasanProvinsi" role="dialog">
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
                                            <label class="hrzn-fm"><b>Periode RPJMN</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Periode">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-8">
                                            <select class="form-control" id="Provinsi">
                                                <option value="">Pilih Provinsi</option>
                                            <?php foreach ($Provinsi as $key) { ?>
                                                <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                            <?php } ?>
                                            </select>
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
    <div class="modal fade" id="ModalEditKawasanProvinsi" role="dialog">
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
                                            <label class="hrzn-fm"><b>Periode RPJMN</b></label>
                                            <input type="hidden" id="Id">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Periode">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-8">
                                            <select class="form-control" id="_Provinsi">
                                                <option value="">Pilih Provinsi</option>
                                            <?php foreach ($Provinsi as $key) { ?>
                                                <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="Edit"><b>SIMPAN</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalInputNamaKawasan" role="dialog">
        <div class="modal-dialog modals-small" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="hidden" id="IdProvinsi">
                                            <input type="text" class="form-control input-sm" placeholder="input disini" id="NamaProvinsi" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Nama Kawasan</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control input-sm" placeholder="input disini" id="NamaKawasan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="_Input"><b>SIMPAN</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEditNamaKawasan" role="dialog">
        <div class="modal-dialog modals-small" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Provinsi</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="hidden" id="Id_">
                                            <input type="text" class="form-control input-sm" placeholder="input disini" id="_NamaProvinsi" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Nama Kawasan</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control input-sm" placeholder="input disini" id="_NamaKawasan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="_Edit"><b>SIMPAN</b></button>
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
                if ($("#Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#Provinsi").val() == "") {
                    alert('Input Provinsi Belum Benar!')
                } else {
                    var KawasanProvinsi = { _Id   : $("#Periode").val(),
                                       Provinsi   : $("#Provinsi").val() }
                    $.post(BaseURL+"Nasional/InputKawasanProvinsiRPJMN", KawasanProvinsi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/PembangunanKawasanRPJMN"
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
                $("#_Periode").val(Pisah[1])
                $("#_Provinsi").val(Pisah[2])
                $('#ModalEditKawasanProvinsi').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Periode").val() == "") {
                    alert("Mohon Input Periode")
                } else if ($("#_Provinsi").val() == "") {
                    alert('Input Provinsi Belum Benar!')
                } else {
                    var KawasanProvinsi = { Id   : $("#Id").val(),
                                 _Id   : $("#_Periode").val(),
                                 Provinsi   : $("#_Provinsi").val() }
                    $.post(BaseURL+"Nasional/EditKawasanProvinsiRPJMN", KawasanProvinsi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/PembangunanKawasanRPJMN"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var KawasanProvinsi = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusKawasanProvinsiRPJMN", KawasanProvinsi).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/PembangunanKawasanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            })

            $(document).on("click",".InputNamaKawasan",function(){
                var Data = $(this).attr('InputNamaKawasan')
                var Pisah = Data.split("|");
                $("#IdProvinsi").val(Pisah[0])
                $("#NamaProvinsi").val(Pisah[1])
                $('#ModalInputNamaKawasan').modal("show")
            })

            $("#_Input").click(function() {
                if ($("#NamaKawasan").val() == "") {
                    alert('Input Nama Kawasan Belum Benar!')
                } else {
                    var PembangunanKawasan = { _Id   : $("#IdProvinsi").val(),
                                         NamaKawasan   : $("#NamaKawasan").val() }
                    $.post(BaseURL+"Nasional/InputNamaKawasanRPJMN", PembangunanKawasan).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/PembangunanKawasanRPJMN"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })
            
            $(document).on("click","._Edit",function(){
                var Data = $(this).attr('_Edit')
                var Pisah = Data.split("|");
                $("#Id_").val(Pisah[0])
                $("#_NamaProvinsi").val(Pisah[1])
                $("#_NamaKawasan").val(Pisah[2])
                $('#ModalEditNamaKawasan').modal("show")
            })

            $("#_Edit").click(function() {
                if ($("#_NamaKawasan").val() == "") {
                    alert('Input Nama Kawasan Belum Benar!')
                } else {
                    var PembangunanKawasan = { Id    : $("#Id_").val(),
                                         NamaKawasan : $("#_NamaKawasan").val() }
                    $.post(BaseURL+"Nasional/EditNamaKawasanRPJMN", PembangunanKawasan).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Nasional/PembangunanKawasanRPJMN"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '._Hapus', function () {
                var IndikatorPembangunan = { Id: $(this).attr('_Hapus') }
                $.post(BaseURL+"Nasional/HapusNamaKawasanRPJMN", IndikatorPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/PembangunanKawasanRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })
    </script>
    <script>
        function toggleRows(className) {
            // Mencari semua elemen yang memiliki class yang sama
            var rows = document.querySelectorAll('.' + className);
            
            rows.forEach(function(row) {
                if (row.style.display === "none" || row.style.display === "") {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</body>

</html>