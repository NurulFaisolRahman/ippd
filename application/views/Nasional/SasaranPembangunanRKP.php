<style>
    /* CSS untuk membuat Modal persis di tengah (Vertical Center) */
    .modal {
        text-align: center;
        padding: 0!important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        width: 800px; /* Diperlebar agar form grid 3 kolom terlihat rapi */
        max-width: 95%; 
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /* CSS Card Container Enhancement */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    /* CSS Table Enhancement */
    #data-table-basic > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
        text-align: center;
    }
    #data-table-basic > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
        text-align: center;
        font-size: 13px;
    }
    
    #data-table-basic > tbody > tr {
        transition: filter 0.2s ease, background-color 0.2s ease;
    }
    #data-table-basic > tbody > tr:hover {
        background-color: #f1f8e9; /* Efek hover baris */
    }

    /* CSS Button Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0 2px;
        transition: all 0.3s ease;
        padding: 6px 12px;
        font-weight: 600;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Penyesuaian Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Data Sasaran Pembangunan Nasional</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputSasaranPembangunanRKP" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Sasaran Pembangunan</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Pertumbuhan<br>Ekonomi</th>
                                    <th>Tingkat<br>Kemiskinan</th>
                                    <th>Tingkat<br>Pengangguran Terbuka</th>
                                    <th>Indeks<br>Modal Manusia</th>
                                    <th>Rasio<br>GINI</th>
                                    <th>Intensitas<br>Emisi GRK</th>
                                    <th>Nilai Tukar<br>Petani</th>
                                    <th>Nilai Tukar<br>Nelayan</th>
                                    <th>Tahun</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 12%;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; if(isset($SasaranPembangunanRKP)){ foreach ($SasaranPembangunanRKP as $key) { ?>
                                <tr>
                                    <td><b><?=$No++?></b></td>
                                    <td><?=$key['LPE']?></td>
                                    <td><?=$key['Kemiskinan']?></td>
                                    <td><?=$key['TPT']?></td>
                                    <td><?=$key['IMM']?></td>
                                    <td><?=$key['RasioGINI']?></td>
                                    <td><?=$key['IntensitasEmisiGRK']?></td>
                                    <td><?=$key['NTP']?></td>
                                    <td><?=$key['NTN']?></td>
                                    <td><b><?=$key['Tahun']?></b></td>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-action Edit" Edit="<?=$key['Id'].'|'.$key['LPE'].'|'.$key['Kemiskinan'].'|'.$key['TPT'].'|'.$key['IMM'].'|'.$key['RasioGINI'].'|'.$key['IntensitasEmisiGRK'].'|'.$key['NTP'].'|'.$key['NTN'].'|'.$key['Tahun']?>" title="Edit Data"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action Hapus" Hapus="<?=$key['Id']?>" title="Hapus Data"><i class="fa fa-trash"></i></button>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT SASARAN PEMBANGUNAN                -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSasaranPembangunanRKP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Sasaran Pembangunan Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <!-- Baris 1: Tahun -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Tahun" placeholder="Tahun (Contoh: 2024)">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 2: LPE, Kemiskinan, TPT -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="LPE" placeholder="Pertumbuhan Ekonomi">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-arrow-down"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Kemiskinan" placeholder="Tingkat Kemiskinan">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="TPT" placeholder="Tingkat Pengangguran (TPT)">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 3: IMM, GINI, Emisi GRK -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="IMM" placeholder="Indeks Modal Manusia">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-balance-scale"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="RasioGINI" placeholder="Rasio GINI">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-cloud"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="IntensitasEmisiGRK" placeholder="Intensitas Emisi GRK">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 4: NTP, NTN -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-leaf"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="NTP" placeholder="Nilai Tukar Petani (NTP)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-ship"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="NTN" placeholder="Nilai Tukar Nelayan (NTN)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="Input"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT SASARAN PEMBANGUNAN                 -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditSasaranPembangunanRKP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Sasaran Pembangunan Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="Id">                
                <!-- Baris 1: Tahun -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Tahun" placeholder="Tahun (Contoh: 2024)">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 2: LPE, Kemiskinan, TPT -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_LPE" placeholder="Pertumbuhan Ekonomi">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-arrow-down"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Kemiskinan" placeholder="Tingkat Kemiskinan">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_TPT" placeholder="Tingkat Pengangguran (TPT)">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 3: IMM, GINI, Emisi GRK -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_IMM" placeholder="Indeks Modal Manusia">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-balance-scale"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_RasioGINI" placeholder="Rasio GINI">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-cloud"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_IntensitasEmisiGRK" placeholder="Intensitas Emisi GRK">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 4: NTP, NTN -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-leaf"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_NTP" placeholder="Nilai Tukar Petani (NTP)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-ship"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_NTN" placeholder="Nilai Tukar Nelayan (NTN)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="Edit"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
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
                alert('Input Pertumbuhan Ekonomi Belum Benar!')
            } else if ($("#Kemiskinan").val() == "") {
                alert('Input Tingkat Kemiskinan Belum Benar!')
            } else if ($("#TPT").val() == "") {
                alert('Input Tingkat Pengangguran Terbuka Belum Benar!')
            } else if ($("#IMM").val() == "") {
                alert('Input Indeks Modal Manusia Belum Benar!')
            } else if ($("#RasioGINI").val() == "") {
                alert('Input Rasio GINI Belum Benar!')
            } else if ($("#IntensitasEmisiGRK").val() == "") {
                alert('Input Intensitas Emisi GRK Belum Benar!')
            } else if ($("#NTP").val() == "") {
                alert('Input Nilai Tukar Petani Belum Benar!')
            } else if ($("#NTN").val() == "") {
                alert('Input Nilai Tukar Nelayan Belum Benar!')
            } else {
                var SasaranPembangunanRKP = { LPE                : $("#LPE").val(),
                                              Kemiskinan         : $("#Kemiskinan").val(),
                                              TPT                : $("#TPT").val(),
                                              IMM                : $("#IMM").val(),
                                              RasioGINI          : $("#RasioGINI").val(),
                                              IntensitasEmisiGRK : $("#IntensitasEmisiGRK").val(),
                                              NTP                : $("#NTP").val(),
                                              NTN                : $("#NTN").val(),
                                              Tahun              : $("#Tahun").val() }
                $.post(BaseURL+"Nasional/InputSasaranPembangunanRKP", SasaranPembangunanRKP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanRKP"
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
            $("#_NTP").val(Pisah[7])
            $("#_NTN").val(Pisah[8])
            $("#_Tahun").val(Pisah[9])
            $('#ModalEditSasaranPembangunanRKP').modal("show")
        })

        $("#Edit").click(function() {
            if (isNaN($("#_Tahun").val()) || $("#_Tahun").val() == "" || $("#_Tahun").val().length != 4) {
                alert("Input Tahun Belum Benar!")
            } else if ($("#_LPE").val() == "") {
                alert('Input Pertumbuhan Ekonomi Belum Benar!')
            } else if ($("#_Kemiskinan").val() == "") {
                alert('Input Tingkat Kemiskinan Belum Benar!')
            } else if ($("#_TPT").val() == "") {
                alert('Input Tingkat Pengangguran Terbuka Belum Benar!')
            } else if ($("#_IMM").val() == "") {
                alert('Input Indeks Modal Manusia Belum Benar!')
            } else if ($("#_RasioGINI").val() == "") {
                alert('Input Rasio GINI Belum Benar!')
            } else if ($("#_IntensitasEmisiGRK").val() == "") {
                alert('Input Intensitas Emisi GRK Belum Benar!')
            } else if ($("#_NTP").val() == "") {
                alert('Input Nilai Tukar Petani Belum Benar!')
            } else if ($("#_NTN").val() == "") {
                alert('Input Nilai Tukar Nelayan Belum Benar!')
            } else {
                var SasaranPembangunanRKP = { Id                 : $("#Id").val(),
                                              LPE                : $("#_LPE").val(),
                                              Kemiskinan         : $("#_Kemiskinan").val(),
                                              TPT                : $("#_TPT").val(),
                                              IMM                : $("#_IMM").val(),
                                              RasioGINI          : $("#_RasioGINI").val(),
                                              IntensitasEmisiGRK : $("#_IntensitasEmisiGRK").val(),
                                              NTP                : $("#_NTP").val(),
                                              NTN                : $("#_NTN").val(),
                                              Tahun              : $("#_Tahun").val() }
                $.post(BaseURL+"Nasional/EditSasaranPembangunanRKP", SasaranPembangunanRKP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanRKP"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        })

        $('#data-table-basic tbody').on('click', '.Hapus', function () {
            if(confirm("Yakin ingin menghapus Sasaran Pembangunan ini?")) { // Ditambahkan konfirmasi dialog keamanan
                var SasaranPembangunanRKP = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusSasaranPembangunanRKP", SasaranPembangunanRKP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanRKP"
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