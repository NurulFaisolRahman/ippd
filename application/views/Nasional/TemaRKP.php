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
        width: 600px; 
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
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #data-table-basic > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    
    #data-table-basic > tbody > tr {
        transition: filter 0.2s ease;
    }
    #data-table-basic > tbody > tr:hover {
        filter: brightness(0.96); 
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
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Data Tema Rencana Kerja Pemerintah (RKP)</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Tema RKP -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputTemaRKP" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Tema RKP</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%;" class="text-center">No</th>
                                    <th style="width: 70%;">Tema Rencana Kerja Pemerintah (RKP)</th>
                                    <th style="width: 10%;" class="text-center">Tahun</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 10%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; if(isset($TemaRKP)){ foreach ($TemaRKP as $key) { ?>
                                <tr>
                                    <td class="text-center" style="font-size: 14px;"><b><?=$No++?></b></td>
                                    <td style="font-size: 14px;"><?=$key['TemaRKP']?></td>
                                    <td class="text-center" style="font-size: 14px;"><b><?=$key['Tahun']?></b></td>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info btn-action Edit" Edit="<?=$key['Id'].'|'.$key['TemaRKP'].'|'.$key['Tahun']?>" title="Edit Tema"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action Hapus" Hapus="<?=$key['Id']?>" title="Hapus Tema"><i class="fa fa-trash"></i></button>
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
<!-- MODAL INPUT TEMA RKP                           -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputTemaRKP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Tema RKP</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="TemaRKP" placeholder="Input Tema RKP">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Tahun" placeholder="Input Tahun (Contoh: 2024)">
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
<!-- MODAL EDIT TEMA RKP                            -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditTemaRKP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Tema RKP</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="Id">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_TemaRKP" placeholder="Input Tema RKP">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Tahun" placeholder="Input Tahun (Contoh: 2024)">
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
            if ($("#TemaRKP").val() == "") {
                alert('Input Tema RKP Belum Benar!')
            } else if (isNaN($("#Tahun").val()) || $("#Tahun").val() == "" || $("#Tahun").val().length != 4) {
                alert("Input Tahun Belum Benar!")
            } else {
                var TemaRKP = { TemaRKP : $("#TemaRKP").val(),
                                Tahun : $("#Tahun").val() }
                $.post(BaseURL+"Nasional/InputTemaRKP", TemaRKP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/TemaRKP"
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
            $("#_TemaRKP").val(Pisah[1])
            $("#_Tahun").val(Pisah[2])
            $('#ModalEditTemaRKP').modal("show")
        })

        $("#Edit").click(function() {
            if ($("#_TemaRKP").val() == "") {
                alert('Input Tema RKP Belum Benar!')
            } else if (isNaN($("#_Tahun").val()) || $("#_Tahun").val() == "" || $("#_Tahun").val().length != 4) {
                alert("Input Tahun Belum Benar!")
            }else {
                var TemaRKP = { Id : $("#Id").val(),
                                TemaRKP : $("#_TemaRKP").val(),
                                Tahun : $("#_Tahun").val() } // Memperbaiki bug kurang '#' pada _Tahun
                $.post(BaseURL+"Nasional/EditTemaRKP", TemaRKP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/TemaRKP"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        })

        $('#data-table-basic tbody').on('click', '.Hapus', function () {
            if(confirm("Yakin ingin menghapus Tema RKP ini?")) { // Ditambahkan konfirmasi keamanan
                var TemaRKP = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusTemaRKP", TemaRKP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/TemaRKP"
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