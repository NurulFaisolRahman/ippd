<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            
                            <!-- ============================================================
                            FILTER WILAYAH - HANYA UNTUK YANG BELUM LOGIN
                            ============================================================ -->
                            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>">
                                                                <?= html_escape($prov['Nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="KabKota"><b>Kab/Kota</b></label>
                                                    <select class="form-control filter-select" id="KabKota">
                                                        <option value="">Pilih Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <!-- ============================================================
                            INFO WILAYAH
                            ============================================================ -->
                            <?php if (!empty($KodeWilayah)) { ?>
                            <div class="alert alert-info" style="margin-bottom: 20px;">
                                <strong>Wilayah:</strong> <?= html_escape($NamaWilayah) ?>
                            </div>
                            <?php } ?>

                            <!-- ============================================================
                            TOMBOL TAMBAH - HANYA UNTUK LEVEL 3
                            ============================================================ -->
                            <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIKD">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah IKD Tahun Berjalan</b>
                                </button>
                                <?php } ?>
                            </div>

                            <?php if (empty($IKDData)) { ?>
                            <div class="alert alert-warning" style="margin-bottom: 20px; margin-top: 20px;">
                                <i class="fa fa-info-circle"></i> Belum ada data IKD Tahun Berjalan untuk wilayah ini.
                            </div>
                            <?php } ?>

                        </div>

                        <!-- ============================================================
                        TABEL DATA IKD TAHUN BERJALAN
                        ============================================================ -->
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr style="background-color: #f0f0f0; color: #333; text-align: center;">
                                        <th style="width: 5%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">No</th>
                                        <th style="width: 40%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">Indikator Kinerja Daerah</th>
                                        <th style="width: 20%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">Target</th>
                                        <th style="width: 10%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">Tahun</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width: 25%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody id="IKDTableBody">
                                    <?php if (empty($IKDData)) { ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted" style="padding: 30px 0;">
                                            <i class="fa fa-info-circle"></i> Belum ada data IKD Tahun Berjalan
                                        </td>
                                    </tr>
                                    <?php } else { ?>
                                    <?php $No = 1; foreach ($IKDData as $row) { ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle; border: 1px solid #ddd;"><?= $No++ ?></td>
                                        <td style="vertical-align: middle; padding: 8px; border: 1px solid #ddd;">
                                            <strong><?= html_escape($row['indikator_kinerja_daerah']) ?></strong>
                                        </td>
                                        <td style="vertical-align: middle; padding: 8px; border: 1px solid #ddd; text-align: center;">
                                            <span class="target-badge"><?= html_escape($row['target']) ?></span>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle; border: 1px solid #ddd;">
                                            <span class="label label-primary"><?= html_escape($row['tahun']) ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="text-center" style="vertical-align: middle; border: 1px solid #ddd;">
                                         
                                            <button class="btn btn-sm btn-warning EditIKD" 
                                                    data-id="<?= $row['id'] ?>"
                                                    data-ikd_id="<?= $row['ikd_id'] ?? '' ?>"
                                                    data-indikator="<?= html_escape($row['indikator_kinerja_daerah']) ?>"
                                                    data-target="<?= html_escape($row['target']) ?>"
                                                    data-tahun="<?= html_escape($row['tahun']) ?>"
                                                    title="Edit"
                                                    style="padding: 2px 8px; font-size: 11px; background-color: #f0ad4e; border-color: #eea236; color: #fff; border-radius: 3px;">
                                                <i class="notika-icon notika-settings"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger HapusIKD" 
                                                    data-id="<?= $row['id'] ?>"
                                                    title="Hapus"
                                                    style="padding: 2px 8px; font-size: 11px; border-radius: 3px;">
                                                <i class="notika-icon notika-trash"></i> Hapus
                                            </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL INPUT IKD TAHUN BERJALAN
============================================================ -->
<div class="modal fade" id="ModalInputIKD" role="dialog">
    <div class="modal-dialog" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah IKD Tahun Berjalan</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <!-- PERIODE -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Periode IKD</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="InputPeriode" style="color: #000;">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($PeriodeList as $periode) { ?>
                                                        <option value="<?= html_escape($periode['tahun_mulai']) ?>|<?= html_escape($periode['tahun_akhir']) ?>">
                                                            <?= html_escape($periode['periode']) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- IKD -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Indikator IKD</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="InputIKD" style="color: #000;">
                                                    <option value="">-- Pilih IKD --</option>
                                                </select>
                                                <input type="hidden" id="InputIKDId">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TARGET (INPUT MANUAL) -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Target</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" id="InputTarget" 
                                                       placeholder="Contoh: 5.2%" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAHUN (INPUT MANUAL) -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="number" class="form-control" id="InputTahun" 
                                                       placeholder="Contoh: 2025" min="2000" max="2100" style="color: #000;" value="<?= date('Y') ?>">
                                                <small class="text-muted" style="display: block; margin-top: 4px;">
                                                    <i class="fa fa-info-circle"></i> Tahun 4 digit (contoh: 2025)
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="SimpanIKD">
                                            <b>SIMPAN</b>
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">
                                            Batal
                                        </button>
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

<!-- ============================================================
MODAL EDIT IKD TAHUN BERJALAN
============================================================ -->
<div class="modal fade" id="ModalEditIKD" role="dialog">
    <div class="modal-dialog" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit IKD Tahun Berjalan</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <input type="hidden" id="EditId">
                            <input type="hidden" id="EditIKDIdHidden" value="">
                            
                            <!-- PERIODE -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Periode IKD</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditPeriode" style="color: #000;">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($PeriodeList as $periode) { ?>
                                                        <option value="<?= html_escape($periode['tahun_mulai']) ?>|<?= html_escape($periode['tahun_akhir']) ?>">
                                                            <?= html_escape($periode['periode']) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- IKD -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Indikator IKD</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditIKD" style="color: #000;">
                                                    <option value="">-- Pilih IKD --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TARGET (INPUT MANUAL) -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Target</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" id="EditTarget" 
                                                       placeholder="Contoh: 5.2%" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAHUN (INPUT MANUAL) -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <input type="number" class="form-control" id="EditTahun" 
                                                       placeholder="Contoh: 2025" min="2000" max="2100" style="color: #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="UpdateIKD">
                                            <b>UPDATE</b>
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">
                                            Batal
                                        </button>
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

<!-- Styles -->
<style>
    .form-control, .form-control option {
        color: #000 !important;
    }
    .modal-content {
        color: #000;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    
    .filter-row {
        display: flex;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 10px;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .filter-group label {
        font-size: 14px;
        margin-bottom: 5px;
    }
    .filter-select {
        width: 260px;
        font-size: 14px;
        padding: 5px 8px;
    }
    
    .target-badge {
        display: inline-block;
        background-color: #28a745;
        color: #fff;
        padding: 4px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
    }
    
    .label {
        display: inline-block;
        padding: 3px 10px;
        font-size: 12px;
        font-weight: bold;
        border-radius: 3px;
    }
    .label-primary {
        background-color: #007bff;
        color: #fff;
    }
    
    .btn-warning {
        background-color: #f0ad4e;
        border-color: #eea236;
        color: #fff;
    }
    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #d58512;
        color: #fff;
    }
    
    .form-control-static {
        padding: 6px 12px;
        margin-bottom: 0;
        font-weight: bold;
        color: #333;
    }
    
    .spinner-border-sm {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
        vertical-align: middle;
        margin-right: 5px;
    }
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    
    @media (max-width: 768px) {
        .filter-row {
            flex-direction: column;
            gap: 15px;
        }
        .filter-select {
            width: 100%;
        }
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

jQuery(document).ready(function($) {

    // ============================================================
    // FILTER WILAYAH - HANYA UNTUK YANG BELUM LOGIN
    // ============================================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
        $("#Provinsi").change(function() {
            if ($(this).val() === "") {
                $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                return;
            }
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: $(this).val(), [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $("#KabKota").prop('disabled', true); },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                            }
                        }
                        $("#KabKota").html(KabKota).prop('disabled', false);
                    } catch (e) {
                        alert("Gagal memuat data Kab/Kota");
                        $("#KabKota").prop('disabled', false);
                    }
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                    $("#KabKota").prop('disabled', false);
                }
            });
        });

        $("#Filter").click(function() {
            if ($("#Provinsi").val() === "") {
                alert("Mohon Pilih Provinsi");
                return;
            }
            if ($("#KabKota").val() === "") {
                alert("Mohon Pilih Kab/Kota");
                return;
            }
            var kodeWilayah = $("#KabKota").val();
            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: { KodeWilayah: kodeWilayah, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                success: function(Respon) {
                    try {
                        if (Respon === 'success' || Respon.trim() === 'success') {
                            window.location.href = BaseURL + "Daerah/IKDTahunBerjalan";
                        } else {
                            alert(Respon || "Gagal menyimpan filter wilayah!");
                            $("#Filter").prop('disabled', false).text('Filter');
                        }
                    } catch (e) {
                        alert("Gagal memproses respons server!");
                        $("#Filter").prop('disabled', false).text('Filter');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            });
        });
    <?php } ?>

    // ============================================================
    // LOAD IKD UNTUK MODAL INPUT
    // ============================================================
    $("#InputPeriode").change(function() {
        var value = $(this).val();
        if (value === "") {
            $("#InputIKD").html('<option value="">-- Pilih IKD --</option>');
            $("#InputIKDId").val('');
            return;
        }
        
        var parts = value.split('|');
        var tahunMulai = parts[0];
        var tahunAkhir = parts[1];
        
        $("#InputIKD").html('<option value="">Memuat...</option>').prop('disabled', true);
        
        $.ajax({
            url: BaseURL + "Daerah/GetIKDByPeriode",
            type: "POST",
            data: {
                tahun_mulai: tahunMulai,
                tahun_akhir: tahunAkhir,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var options = '<option value="">-- Pilih IKD --</option>';
                    if (response.data && response.data.length > 0) {
                        for (var i = 0; i < response.data.length; i++) {
                            options += '<option value="' + response.data[i].id + '">' + 
                                       response.data[i].indikator_sasaran + '</option>';
                        }
                    } else {
                        options = '<option value="">Tidak ada data IKD</option>';
                    }
                    $("#InputIKD").html(options).prop('disabled', false);
                } else {
                    alert('Gagal memuat data: ' + response.message);
                    $("#InputIKD").html('<option value="">-- Error --</option>').prop('disabled', false);
                }
            },
            error: function() {
                alert('Gagal menghubungi server!');
                $("#InputIKD").html('<option value="">-- Error --</option>').prop('disabled', false);
            }
        });
    });

    // ============================================================
    // SET IKD ID SAAT DIPILIH (INPUT)
    // ============================================================
    $("#InputIKD").change(function() {
        $("#InputIKDId").val($(this).val());
    });

    // ============================================================
    // SIMPAN IKD TAHUN BERJALAN
    // ============================================================
    $("#SimpanIKD").click(function() {
        var ikdId = $("#InputIKDId").val();
        var indikator = $("#InputIKD option:selected").text();
        var target = $("#InputTarget").val().trim();
        var tahun = $("#InputTahun").val().trim();
        
        if (!ikdId || ikdId === "") {
            alert('Pilih Indikator IKD terlebih dahulu!');
            return;
        }
        
        if (indikator === "Memuat..." || indikator === "-- Pilih IKD --" || indikator === "") {
            alert('Pilih Indikator IKD terlebih dahulu!');
            return;
        }
        
        if (target === "") {
            alert('Target harus diisi!');
            return;
        }
        
        if (tahun === "" || tahun.length !== 4 || isNaN(tahun)) {
            alert('Tahun harus 4 digit angka!');
            return;
        }
        
        var Data = {
            ikd_id: ikdId,
            indikator: indikator,
            target: target,
            tahun: tahun,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
        };
        
        $.ajax({
            url: BaseURL + "Daerah/InputIKDTahunBerjalan",
            type: "POST",
            data: Data,
            beforeSend: function() {
                $("#SimpanIKD").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        $('#ModalInputIKD').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        $("#SimpanIKD").prop('disabled', false).html('<b>SIMPAN</b>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        $('#ModalInputIKD').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + Respon);
                        $("#SimpanIKD").prop('disabled', false).html('<b>SIMPAN</b>');
                    }
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#SimpanIKD").prop('disabled', false).html('<b>SIMPAN</b>');
            }
        });
    });

    // ============================================================
    // EDIT IKD TAHUN BERJALAN
    // ============================================================
    $(document).on("click", ".EditIKD", function() {
        var id = $(this).data('id');
        var ikdId = $(this).data('ikd_id') || '';
        var indikator = $(this).data('indikator');
        var target = $(this).data('target');
        var tahun = $(this).data('tahun');
        
        // Set ID
        $("#EditId").val(id);
        $("#EditIKDIdHidden").val(ikdId);
        $("#EditTarget").val(target);
        $("#EditTahun").val(tahun);
        
        // Reset dropdown
        $("#EditPeriode").val('');
        $("#EditIKD").html('<option value="">-- Pilih IKD --</option>');
        
        // ============================================================
        // CARI PERIODE DARI IKD ID
        // ============================================================
        if (ikdId) {
            $.ajax({
                url: BaseURL + "Daerah/GetPeriodeByIKDId",
                type: "POST",
                data: {
                    ikd_id: ikdId,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success' && response.data) {
                        var periodeValue = response.data.tahun_mulai + '|' + response.data.tahun_akhir;
                        $("#EditPeriode").val(periodeValue);
                        
                        // Trigger change untuk load IKD
                        $("#EditPeriode").trigger('change');
                    } else {
                        // Jika tidak ditemukan, coba load semua IKD
                        loadAllIKDForEdit(ikdId);
                    }
                },
                error: function() {
                    // Fallback: coba load semua IKD
                    loadAllIKDForEdit(ikdId);
                }
            });
        } else {
            // Jika tidak ada ikd_id, reset
            $("#EditPeriode").val('');
            $("#EditIKD").html('<option value="">-- Pilih IKD --</option>');
        }
        
        $('#ModalEditIKD').modal("show");
    });

    // ============================================================
    // FUNGSI LOAD ALL IKD UNTUK EDIT (FALLBACK)
    // ============================================================
    function loadAllIKDForEdit(selectedId) {
        $.ajax({
            url: BaseURL + "Daerah/GetAllIKD",
            type: "POST",
            data: {
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var options = '<option value="">-- Pilih IKD --</option>';
                    if (response.data && response.data.length > 0) {
                        for (var i = 0; i < response.data.length; i++) {
                            var selected = (response.data[i].id == selectedId) ? 'selected' : '';
                            options += '<option value="' + response.data[i].id + '" ' + selected + '>' + 
                                       response.data[i].indikator_sasaran + '</option>';
                        }
                    }
                    $("#EditIKD").html(options);
                }
            }
        });
    }

    // ============================================================
    // LOAD IKD UNTUK MODAL EDIT (SAAT PERIODE BERUBAH)
    // ============================================================
    $("#EditPeriode").change(function() {
        var value = $(this).val();
        if (value === "") {
            $("#EditIKD").html('<option value="">-- Pilih IKD --</option>');
            return;
        }
        
        var parts = value.split('|');
        var tahunMulai = parts[0];
        var tahunAkhir = parts[1];
        
        var selectedId = $("#EditIKDIdHidden").val();
        
        $("#EditIKD").html('<option value="">Memuat...</option>').prop('disabled', true);
        
        $.ajax({
            url: BaseURL + "Daerah/GetIKDByPeriode",
            type: "POST",
            data: {
                tahun_mulai: tahunMulai,
                tahun_akhir: tahunAkhir,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var options = '<option value="">-- Pilih IKD --</option>';
                    if (response.data && response.data.length > 0) {
                        for (var i = 0; i < response.data.length; i++) {
                            var selected = (response.data[i].id == selectedId) ? 'selected' : '';
                            options += '<option value="' + response.data[i].id + '" ' + selected + '>' + 
                                       response.data[i].indikator_sasaran + '</option>';
                        }
                    } else {
                        options = '<option value="">Tidak ada data IKD</option>';
                    }
                    $("#EditIKD").html(options).prop('disabled', false);
                } else {
                    alert('Gagal memuat data: ' + response.message);
                    $("#EditIKD").html('<option value="">-- Error --</option>').prop('disabled', false);
                }
            },
            error: function() {
                alert('Gagal menghubungi server!');
                $("#EditIKD").html('<option value="">-- Error --</option>').prop('disabled', false);
            }
        });
    });

    // ============================================================
    // UPDATE IKD TAHUN BERJALAN
    // ============================================================
    $("#UpdateIKD").click(function() {
        var id = $("#EditId").val();
        var ikdId = $("#EditIKD").val();
        var indikator = $("#EditIKD option:selected").text();
        var target = $("#EditTarget").val().trim();
        var tahun = $("#EditTahun").val().trim();
        
        if (!ikdId || ikdId === "") {
            alert('Pilih Indikator IKD terlebih dahulu!');
            return;
        }
        
        if (indikator === "Memuat..." || indikator === "-- Pilih IKD --" || indikator === "") {
            alert('Pilih Indikator IKD terlebih dahulu!');
            return;
        }
        
        if (target === "") {
            alert('Target harus diisi!');
            return;
        }
        
        if (tahun === "" || tahun.length !== 4 || isNaN(tahun)) {
            alert('Tahun harus 4 digit angka!');
            return;
        }
        
        var Data = {
            id: id,
            ikd_id: ikdId,
            indikator: indikator,
            target: target,
            tahun: tahun,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
        };
        
        $.ajax({
            url: BaseURL + "Daerah/EditIKDTahunBerjalan",
            type: "POST",
            data: Data,
            beforeSend: function() {
                $("#UpdateIKD").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        $('#ModalEditIKD').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        $("#UpdateIKD").prop('disabled', false).html('<b>UPDATE</b>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        $('#ModalEditIKD').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + Respon);
                        $("#UpdateIKD").prop('disabled', false).html('<b>UPDATE</b>');
                    }
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#UpdateIKD").prop('disabled', false).html('<b>UPDATE</b>');
            }
        });
    });

    // ============================================================
    // HAPUS IKD TAHUN BERJALAN
    // ============================================================
    $(document).on("click", ".HapusIKD", function() {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            var id = $(this).data('id');
            var btn = $(this);
            
            $.ajax({
                url: BaseURL + "Daerah/HapusIKDTahunBerjalan",
                type: "POST",
                data: { 
                    id: id,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                },
                beforeSend: function() {
                    btn.prop('disabled', true).html('<span class="spinner-border-sm"></span>');
                },
                success: function(Respon) {
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') {
                            location.reload();
                        } else {
                            alert('✗ ' + result.message);
                            btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i> Hapus');
                        }
                    } catch(e) {
                        if (Respon === '1' || Respon.trim() === '1') {
                            location.reload();
                        } else {
                            alert('✗ ' + Respon);
                            btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i> Hapus');
                        }
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.statusText);
                    btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i> Hapus');
                }
            });
        }
    });

    // ============================================================
    // RESET FORM SAAT MODAL DITUTUP
    // ============================================================
    $('#ModalInputIKD').on('hidden.bs.modal', function() {
        $("#InputPeriode").val('');
        $("#InputIKD").html('<option value="">-- Pilih IKD --</option>');
        $("#InputIKDId").val('');
        $("#InputTarget").val('');
        $("#InputTahun").val('');
        $("#SimpanIKD").prop('disabled', false).html('<b>SIMPAN</b>');
    });

    $('#ModalEditIKD').on('hidden.bs.modal', function() {
        $("#EditId").val('');
        $("#EditIKDIdHidden").val('');
        $("#EditPeriode").val('');
        $("#EditIKD").html('<option value="">-- Pilih IKD --</option>');
        $("#EditTarget").val('');
        $("#EditTahun").val('');
        $("#UpdateIKD").prop('disabled', false).html('<b>UPDATE</b>');
    });

    // ============================================================
    // CLEAN MODAL BACKDROP
    // ============================================================
    $(document).on("hidden.bs.modal", ".modal", function() {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    });

});
</script>