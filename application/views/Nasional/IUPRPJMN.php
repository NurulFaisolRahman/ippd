<style>
    /* CSS Modal Vertical Center */
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
        color: #555;
    }
    #data-table-basic > tbody > tr:hover {
        background-color: #f1f8e9 !important; /* Efek hover baris hijau muda */
        transition: background-color 0.3s ease;
    }

    /* CSS Button & Badge Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0 2px;
        transition: all 0.3s;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .badge-periode {
        background-color: #00c292;
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="margin: 0; color: #333; font-weight: 600;">Indikator Utama Pembangunan (IUP) RPJMN</h3>
                        <div class="button-icon-btn">
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputIUP" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input IUP RPJMN</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Tambahkan class table-hover -->
                        <table id="data-table-basic" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 35%;">IUP RPJMN</th>
                                    <th style="width: 12%;" class="text-center">Baseline</th>
                                    <th style="width: 12%;" class="text-center">Target Awal</th>
                                    <th style="width: 12%;" class="text-center">Target Akhir</th>
                                    <th style="width: 12%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 12%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                /* Asumsi Variabel Data Controller: $IUP */
                                if(isset($IUP)) {
                                    $no = 1;
                                    foreach ($IUP as $value) { 
                                ?>
                                    <tr>
                                        <td class="text-center"><b><?= $no++ ?></b></td>
                                        <td><?= $value['IUP'] ?></td>
                                        <td class="text-center"><?= $value['Baseline'] ?></td>
                                        <td class="text-center"><b><?= $value['TargetAwal'] ?></b></td>
                                        <td class="text-center"><b><?= $value['TargetAkhir'] ?></b></td>
                                        <td class="text-center">
                                            <span class="badge-periode"><?= $value['TahunMulai'].' - '.$value['TahunAkhir'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center">
                                            <!-- Tombol Edit & Hapus dengan UI yang dipercantik namun tetap mempertahankan custom Attribute Edit="" dan Hapus="" untuk trigger JS -->
                                            <button class="btn btn-sm btn-info btn-action Edit" Edit="<?= $value['Id'].'_'.$value['_Id'].'_'.$value['IUP'].'_'.$value['Baseline'].'_'.$value['TargetAwal'].'_'.$value['TargetAkhir'] ?>" title="Edit IUP">
                                                <i class="fa fa-edit"></i> 
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-action Hapus" Hapus="<?= $value['Id'] ?>" title="Hapus IUP">
                                                <i class="fa fa-trash"></i> 
                                            </button>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php 
                                    } 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT IUP -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputIUP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah IUP RPJMN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-flag"></i>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select class="selectpicker form-control" data-live-search="true" id="IdVisi">
                                    <option value="">Pilih Periode RPJMN</option>
                                    <?php 
                                    if(isset($Visi)) {
                                        foreach ($Visi as $cv) {
                                            echo "<option value='".$cv['Id']."'>".$cv['TahunMulai']." - ".$cv['TahunAkhir']."</option>";
                                        }
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="IUP" placeholder="Uraian IUP RPJMN">
                            </div>
                        </div>
                    </div>
                </div>
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
                                <input type="text" class="form-control" id="TargetAwal" placeholder="Target Awal">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-flag-checkered"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="TargetAkhir" placeholder="Target Akhir">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanIUP"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT IUP -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditIUP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit IUP RPJMN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="Id">
                <input type="hidden" id="_IdVisi">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_IUP" placeholder="Uraian IUP RPJMN">
                            </div>
                        </div>
                    </div>
                </div>
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
                                <input type="text" class="form-control" id="_TargetAwal" placeholder="Target Awal">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-flag-checkered"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_TargetAkhir" placeholder="Target Akhir">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="Edit"><i class="fa fa-save"></i> Simpan Perubahan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Batal</button>
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
    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>'; // Pastikan base_url terdefinisi

        // ==============================================
        // LOGIKA AJAX
        // ==============================================
        $("#SimpanIUP").click(function() {
            if ($("#IdVisi").val() == "") {
                alert("Mohon Pilih Periode RPJMN")
            } else if ($("#IUP").val() == "") {
                alert('Input IUP Belum Benar!')
            } else if ($("#Baseline").val() == "") {
                alert('Input Baseline Belum Benar!')
            } else if ($("#TargetAwal").val() == "") {
                alert('Input Target Awal Belum Benar!')
            } else if ($("#TargetAkhir").val() == "") {
                alert('Input Target Akhir Belum Benar!')
            } else {
                var IUP = { _Id          : $("#IdVisi").val(),
                            IUP         : $("#IUP").val(),
                            Baseline    : $("#Baseline").val(),
                            TargetAwal  : $("#TargetAwal").val(),
                            TargetAkhir : $("#TargetAkhir").val() }
                $.post(BaseURL+"Nasional/InputIUPRPJMN", IUP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/IUPRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        });

        $('#data-table-basic tbody').on('click', '.Edit', function () {
            // Memecah parameter yang digabung di attribute Edit=""
            var Pisah = $(this).attr('Edit').split('_')
            $("#Id").val(Pisah[0])
            $("#_IdVisi").val(Pisah[1])
            $("#_IUP").val(Pisah[2])
            $("#_Baseline").val(Pisah[3])
            $("#_TargetAwal").val(Pisah[4])
            $("#_TargetAkhir").val(Pisah[5])
            $('#ModalEditIUP').modal("show")
        });

        $("#Edit").click(function() {
            if ($("#_IUP").val() == "") {
                alert('Input IUP Belum Benar!')
            } else if ($("#_Baseline").val() == "") {
                alert('Input Baseline Belum Benar!')
            } else if ($("#_TargetAwal").val() == "") {
                alert('Input Target Awal Belum Benar!')
            } else if ($("#_TargetAkhir").val() == "") {
                alert('Input Target Akhir Belum Benar!')
            } else {
                var IUP = { Id          : $("#Id").val(),
                            _Id         : $("#_IdVisi").val(),
                            IUP         : $("#_IUP").val(),
                            Baseline    : $("#_Baseline").val(),
                            TargetAwal  : $("#_TargetAwal").val(),
                            TargetAkhir : $("#_TargetAkhir").val() }
                $.post(BaseURL+"Nasional/EditIUPRPJMN", IUP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/IUPRPJMN"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        });

        $('#data-table-basic tbody').on('click', '.Hapus', function () {
            if(confirm("Apakah Anda yakin ingin menghapus data IUP ini?")) {
                var IUP = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusIUPRPJMN", IUP).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/IUPRPJMN"
                    } else {
                        alert(Respon)
                    }
                }) 
            }
        });
    });
</script>