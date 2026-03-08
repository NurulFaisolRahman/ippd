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
        width: 800px; /* Diperlebar agar form grid terlihat rapi */
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

    /* ========================================================================= */
    /* CSS FIX: Memastikan dropdown select konservatif tidak terpotong teksnya   */
    /* ========================================================================= */
    select.form-control {
        width: 100% !important;
        height: auto !important;
        padding-top: 8px;
        padding-bottom: 8px;
        white-space: normal !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
    }
    
    select.form-control option {
        white-space: normal !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        padding: 5px;
        max-width: 100%;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Penyesuaian Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Data Sasaran Prioritas Nasional RKP</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputSasaranPembangunan" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Sasaran Pembangunan RKP</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 32%; text-align: left;">Prioritas Nasional RKP</th>
                                    <th style="width: 32%; text-align: left;">Sasaran Pembangunan RKP</th>
                                    <th style="width: 7%;">Baseline</th>
                                    <th style="width: 7%;">Target</th>
                                    <th style="width: 7%;">Tahun</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 10%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($SasaranPembangunan as $key) { ?>
                                <tr>
                                    <td class="text-center"><b><?=$No++?></b></td>
                                    <td><?=$key['PrioritasNasional']?></td>
                                    <td><?=$key['SasaranPembangunan']?></td>
                                    <td class="text-center"><?=$key['Baseline']?></td>
                                    <td class="text-center"><b><?=$key['Target']?></b></td>
                                    <td class="text-center"><b><?=$key['Tahun']?></b></td>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info btn-action Edit" Edit="<?=$key['Id'].'|'.$key['SasaranPembangunan'].'|'.$key['IdVisi'].'|'.$key['IdPrioritasNasional'].'|'.$key['Baseline'].'|'.$key['Target'].'|'.$key['Tahun']?>" title="Edit Data"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action Hapus" Hapus="<?=$key['Id']?>" title="Hapus Data"><i class="fa fa-trash"></i></button>
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

<!-- ============================================== -->
<!-- MODAL INPUT SASARAN PEMBANGUNAN                -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSasaranPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Sasaran Pembangunan RKP</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <!-- Baris 1: Periode -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <!-- Kembali menggunakan select form-control bawaan template -->
                            <div class="nk-int-st">
                                <select class="form-control" id="Periode">
                                    <option value="">Pilih Periode</option>
                                    <?php foreach ($Visi as $key) { ?>
                                        <option value="<?=$key['Id']?>" title="<?=$key['TahunMulai'].' - '.$key['TahunAkhir']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 2: Prioritas Nasional -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <!-- Kembali menggunakan select form-control bawaan template -->
                            <div class="nk-int-st">
                                <select class="form-control" id="IdPrioritasNasional">
                                    <option value="">Pilih Prioritas Nasional</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 3: Sasaran Pembangunan -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" rows="3" id="SasaranPembangunan" placeholder="Input Sasaran Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 4: Baseline, Target, Tahun -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-bar-chart"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Baseline" placeholder="Baseline">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-bullseye"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Target" placeholder="Target">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Tahun" placeholder="Tahun (Contoh: 2024)">
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
<div class="modal fade" id="ModalEditSasaranPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Sasaran Pembangunan RKP</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="Id">
                
                <!-- Baris 1: Periode -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <!-- Kembali menggunakan select form-control bawaan template -->
                            <div class="nk-int-st">
                                <select class="form-control" id="_Periode">
                                    <option value="">Pilih Periode</option>
                                    <?php foreach ($Visi as $key) { ?>
                                        <option value="<?=$key['Id']?>" title="<?=$key['TahunMulai'].' - '.$key['TahunAkhir']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 2: Prioritas Nasional -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <!-- Kembali menggunakan select form-control bawaan template -->
                            <div class="nk-int-st">
                                <select class="form-control" id="_IdPrioritasNasional">
                                    <option value="">Pilih Prioritas Nasional</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 3: Sasaran Pembangunan -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" rows="3" id="_SasaranPembangunan" placeholder="Edit Sasaran Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Baris 4: Baseline, Target, Tahun -->
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-bar-chart"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Baseline" placeholder="Baseline">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-bullseye"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Target" placeholder="Target">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Tahun" placeholder="Tahun (Contoh: 2024)">
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
<!-- Hapus pemanggilan bootstrap-select.js -->
<script src="../js/main.js"></script>
<script>
    var BaseURL = '<?=base_url()?>'
    jQuery(document).ready(function($) {

        $("#Periode").change(function(){
            if ($("#Periode").val() == "") {
                alert("Mohon Input Periode")
                $("#IdPrioritasNasional").html('<option value="">Pilih Prioritas Nasional</option>');
            } else {
                $.post(BaseURL+"Nasional/GetPrioritasNasional", {Id : $("#Periode").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var PrioritasNasional = '<option value="">Pilih Prioritas Nasional</option>'
                    for (let i = 0; i < Data.length; i++) {
                        PrioritasNasional += '<option value="'+Data[i].Id+'" title="'+Data[i].PrioritasNasional+'">'+Data[i].PrioritasNasional+'</option>'
                    }
                    $("#IdPrioritasNasional").html(PrioritasNasional)
                })                         
            }
        });

        $("#_Periode").change(function(){
            if ($("#_Periode").val() == "") {
                alert("Mohon Input Periode")
                $("#_IdPrioritasNasional").html('<option value="">Pilih Prioritas Nasional</option>');
            } else {
                $.post(BaseURL+"Nasional/GetPrioritasNasional", {Id : $("#_Periode").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var PrioritasNasional = '<option value="">Pilih Prioritas Nasional</option>'
                    for (let i = 0; i < Data.length; i++) {
                        PrioritasNasional += '<option value="'+Data[i].Id+'" title="'+Data[i].PrioritasNasional+'">'+Data[i].PrioritasNasional+'</option>'
                    }
                    $("#_IdPrioritasNasional").html(PrioritasNasional)
                })                         
            }
        });

        $("#Input").click(function() {
            if ($("#Periode").val() == "") {
                alert("Mohon Input Periode")
            } else if ($("#IdPrioritasNasional").val() == "") {
                alert("Mohon Pilih Prioritas Nasional")
            } else if ($("#SasaranPembangunan").val() == "") {
                alert('Input Sasaran Pembangunan Belum Benar!')
            } else if ($("#Baseline").val() == "") {
                alert('Input Baseline Belum Benar!')
            } else if ($("#Target").val() == "") {
                alert('Input Target Belum Benar!')
            } else if ($("#Tahun").val() == "") {
                alert('Input Tahun Belum Benar!')
            } else {
                var SasaranPembangunan = { _Id                  : $("#IdPrioritasNasional").val(),
                                           SasaranPembangunan   : $("#SasaranPembangunan").val(),
                                           Baseline             : $("#Baseline").val(),
                                           Target               : $("#Target").val(),
                                           Tahun                : $("#Tahun").val() }
                $.post(BaseURL+"Nasional/InputSasaranPrioritasNasional", SasaranPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPrioritasNasional"
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
            $("#_SasaranPembangunan").val(Pisah[1])
            $("#_Periode").val(Pisah[2])

            $.post(BaseURL+"Nasional/GetPrioritasNasional", {Id : $("#_Periode").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var PrioritasNasional = '<option value="">Pilih Prioritas Nasional</option>'
                for (let i = 0; i < Data.length; i++) {
                    PrioritasNasional += '<option value="'+Data[i].Id+'" title="'+Data[i].PrioritasNasional+'">'+Data[i].PrioritasNasional+'</option>'
                }
                $("#_IdPrioritasNasional").html(PrioritasNasional)
                $("#_IdPrioritasNasional").val(Pisah[3])
            })
            
            $("#_Baseline").val(Pisah[4])
            $("#_Target").val(Pisah[5])
            $("#_Tahun").val(Pisah[6])
            $('#ModalEditSasaranPembangunan').modal("show")
        })

        $("#Edit").click(function() {
            if ($("#_Periode").val() == "") {
                alert("Mohon Input Periode")
            } else if ($("#_IdPrioritasNasional").val() == "") {
                alert("Mohon Pilih Prioritas Nasional")
            } else if ($("#_SasaranPembangunan").val() == "") {
                alert('Input Sasaran Pembangunan Belum Benar!')
            } else if ($("#_Baseline").val() == "") {
                alert('Input Baseline Belum Benar!')
            } else if ($("#_Target").val() == "") {
                alert('Input Target Belum Benar!')
            } else if ($("#_Tahun").val() == "") {
                alert('Input Tahun Belum Benar!')
            } else {
                var SasaranPembangunan = { Id                   : $("#Id").val(),
                                           _Id                  : $("#_IdPrioritasNasional").val(),
                                           SasaranPembangunan   : $("#_SasaranPembangunan").val(),
                                           Baseline             : $("#_Baseline").val(),
                                           Target               : $("#_Target").val(),
                                           Tahun                : $("#_Tahun").val() }
                $.post(BaseURL+"Nasional/EditSasaranPrioritasNasional", SasaranPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPrioritasNasional"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        })

        $('#data-table-basic tbody').on('click', '.Hapus', function () {
            if(confirm("Yakin ingin menghapus Sasaran Pembangunan ini?")) { // Penambahan konfirmasi keamanan
                var SasaranPembangunan = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusSasaranPrioritasNasional", SasaranPembangunan).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPrioritasNasional"
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