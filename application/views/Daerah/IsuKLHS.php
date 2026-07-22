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
                            <!-- Filter untuk pengguna yang belum login -->
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
                                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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
                                <!-- Menampilkan Wilayah setelah filter -->
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <?php 
                                        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                        $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                        if (empty($IsuKLHS)) {
                                            $pesan_error = "Tidak ada data untuk wilayah: $nama_wilayah";
                                        }
                                    ?>
                                    <div class="alert <?= empty($IsuKLHS) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                        <?php if (!empty($pesan_error)) { ?>
                                            <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsuKLHS">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Isu KLHS</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%;">No</th>
                                        <th style="width:20%;">Nama Isu KLHS</th>
                                        <th style="width:30%;">Isu KLHS Nasional</th>
                                        <th style="width:20%;">Kementerian</th>
                                        <th style="width:15%;" class="text-center">Periode</th>
                                        <th style="width:10%;" class="text-center"><?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>Aksi<?php } ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($IsuKLHS as $key) { 
                                        $isuIds = explode("$", $key['_Id']);
                                        $firstKementerianId = isset($isuIds[0]) ? $isuIds[0] : '';
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                        <td style="vertical-align: middle;"><?= html_escape($key['NamaIsuKLHS']) ?></td>
                                        <td style="vertical-align: middle;">
                                            <div class="accordion-stn">
                                                <div class="panel-group" data-collapse-color="nk-green" id="Accrodion<?=$No?>" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse notika-accrodion-cus">
                                                        <div class="panel-heading" role="tab">
                                                            <b><a data-toggle="collapse" data-parent="#Accrodion<?=$No?>" href="#_Accrodion<?=$No?>" aria-expanded="false">Lihat Isu <i class="fa fa-chevron-down"></i></a></b>
                                                        </div>
                                                        <div id="_Accrodion<?=$No?>" class="collapse" role="tabpanel">
                                                            <div class="panel-body" style="padding-top: 0px; max-height: 200px; overflow-y: auto;">
                                                                <?php foreach ($isuIds as $x) { 
                                                                    if (isset($Isu[$x])) { ?>
                                                                    <div class="nk-int-st text-justify" style="padding: 5px 0; border-bottom: 1px solid #eee;">
                                                                        <small>• <?= html_escape($Isu[$x]) ?></small>
                                                                    </div>
                                                                <?php } } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <?php 
                                                $firstKementerianId = isset($isuIds[0]) ? $isuIds[0] : '';
                                                echo isset($Kementerian[$firstKementerianId]) ? html_escape($Kementerian[$firstKementerianId]) : '-';
                                            ?>
                                        </td>
                                        <td style="vertical-align: middle;" class="text-center"><?= html_escape($key['TahunMulai']) . ' - ' . html_escape($key['TahunAkhir']) ?></td>
                                        <td class="text-center align-middle">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                        data-id="<?= $key['Id'] ?>">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-id="<?= $key['Id'] ?>">
                                                    <i class="notika-icon notika-trash"></i>
                                                </button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if (empty($IsuKLHS)) { ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data Isu KLHS</td>
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

    <!-- ============================================================ -->
    <!-- MODAL INPUT ISU KLHS                                          -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalInputIsuKLHS" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);max-height: 90vh;overflow-y: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Isu KLHS</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Periode RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJMD">
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" id="TahunMulai">
                                                    <input type="hidden" id="TahunAkhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Nama Isu KLHS</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="2" id="NamaIsuKLHS" placeholder="Input Nama Isu KLHS"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Periode Nasional</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeIsuKLHSNasional">
                                                        <option value="">-- Pilih Periode --</option>
                                                        <?php foreach ($PeriodeIsuKLHSNasional as $key) { ?>
                                                            <option value="<?= $key['TahunMulai'] ?>">
                                                                <?=$key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
                                                            </option>
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Kementerian</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="Kementerian">
                                                        <option value="">-- Pilih Kementerian --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Isu KLHS Nasional</b></label>
                                    </div>
                                    <div style="margin-top: 3px;" class="col-lg-9">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="AccrodionIsuKLHSNasional" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#AccrodionIsuKLHSNasional" href="#PilihIsuKLHSNasional" aria-expanded="true">Pilih Isu KLHS Nasional (Bisa lebih dari 1)</a></b>
                                                    </div>
                                                    <div id="PilihIsuKLHSNasional" class="collapse in" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px; max-height: 250px; overflow-y: auto;">
                                                            <div class="nk-int-st text-justify" id="ListIsuKLHSNasional">
                                                                <p class="text-muted">Pilih periode dan kementerian terlebih dahulu</p>
                                                            </div>
                                                            <div class="text-muted" style="margin-top: 5px; font-size: 12px;">
                                                                <i class="fa fa-info-circle"></i> Centang lebih dari satu untuk multi-pilih
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="InputIsuKLHS"><b>SIMPAN</b></button>
                                            <button class="btn btn-default notika-btn-default" data-dismiss="modal"><b>BATAL</b></button>
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

    <!-- ============================================================ -->
    <!-- MODAL EDIT ISU KLHS                                           -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalEditIsuKLHS" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);max-height: 90vh;overflow-y: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Isu KLHS</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Periode RPJMD</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPeriodeRPJMD">
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" id="EditId">
                                                    <input type="hidden" id="EditTahunMulai">
                                                    <input type="hidden" id="EditTahunAkhir">
                                                    <input type="hidden" id="EditIsuData" value="">
                                                    <input type="hidden" id="EditSelectedPeriode" value="">
                                                    <input type="hidden" id="EditSelectedKementerian" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Nama Isu KLHS</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" rows="2" id="EditNamaIsuKLHS" placeholder="Input Nama Isu KLHS"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Periode Nasional</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPeriodeIsuKLHSNasional">
                                                        <option value="">-- Pilih Periode --</option>
                                                        <?php foreach ($PeriodeIsuKLHSNasional as $key) { ?>
                                                            <option value="<?= $key['TahunMulai'] ?>">
                                                                <?=$key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
                                                            </option>
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Kementerian</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditKementerian">
                                                        <option value="">-- Pilih Kementerian --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Isu KLHS Nasional</b></label>
                                    </div>
                                    <div style="margin-top: 3px;" class="col-lg-9">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="EditAccrodionIsuKLHSNasional" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#EditAccrodionIsuKLHSNasional" href="#EditPilihIsuKLHSNasional" aria-expanded="true">Pilih Isu KLHS Nasional (Bisa lebih dari 1)</a></b>
                                                    </div>
                                                    <div id="EditPilihIsuKLHSNasional" class="collapse in" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px; max-height: 250px; overflow-y: auto;">
                                                            <div class="nk-int-st text-justify" id="EditListIsuKLHSNasional">
                                                                <p class="text-muted">Pilih periode dan kementerian terlebih dahulu</p>
                                                            </div>
                                                            <div class="text-muted" style="margin-top: 5px; font-size: 12px;">
                                                                <i class="fa fa-info-circle"></i> Centang lebih dari satu untuk multi-pilih
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int" style="margin-top: 15px;">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="UpdateIsuKLHS"><b>UPDATE</b></button>
                                            <button class="btn btn-default notika-btn-default" data-dismiss="modal"><b>BATAL</b></button>
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
</div>

<style>
    .form-control, .form-control option {
        color: #000 !important;
    }
    .modal-content {
        color: #000;
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
    .panel-body label {
        display: block !important;
        padding: 5px 0 !important;
        margin-bottom: 3px !important;
        cursor: pointer !important;
    }
    .panel-body label:hover {
        background-color: #f5f5f5 !important;
    }
    .panel-body label input[type="checkbox"] {
        margin-right: 10px !important;
        margin-top: 2px !important;
        vertical-align: middle !important;
    }
    .panel-body label.checked {
        background-color: #d4edda !important;
        border-left: 3px solid #28a745 !important;
        padding-left: 10px !important;
    }
    @media (max-width: 768px) {
        .filter-row {
            flex-direction: column;
            gap: 15px;
        }
        .filter-select {
            width: 100%;
        }
    }
    .spinner-border {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #fff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 0.8s linear infinite;
        margin-right: 5px;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    .btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
</style>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

jQuery(document).ready(function($) {
    'use strict';

    // ==============================================
    // FILTER WILAYAH UNTUK PENGGUNA BELUM LOGIN
    // ==============================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
        $("#Provinsi").change(function() {
            if ($(this).val() === "") {
                $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                return;
            }
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
                beforeSend: function() { 
                    $("#KabKota").prop('disabled', true);
                    $("#KabKota").html('<option value="">Memuat...</option>');
                },
                success: function(Respon) {
                    var Data = JSON.parse(Respon);
                    var KabKota = '<option value="">Pilih Kab/Kota</option>';
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                        }
                    }
                    $("#KabKota").html(KabKota).prop('disabled', false);
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
            $("#Filter").prop('disabled', true).html('<span class="spinner-border"></span> Memuat...');
            
            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: { 
                    KodeWilayah: kodeWilayah, 
                    [CSRF_NAME]: CSRF_TOKEN 
                },
                success: function(Respon) {
                    if (Respon.trim() === '1' || Respon.trim() === 'success') {
                        window.location.href = BaseURL + "Daerah/IsuKLHS";
                    } else {
                        alert(Respon || "Gagal menyimpan filter wilayah!");
                        $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
                    $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                }
            });
        });

        <?php if (!empty($KodeWilayah)) { ?>
            var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
            var kodeKab = "<?= $KodeWilayah ?>";
            $("#Provinsi").val(kodeProv);
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
                success: function(Respon) {
                    var Data = JSON.parse(Respon);
                    var KabKota = '<option value="">Pilih Kab/Kota</option>';
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                            KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                        }
                    }
                    $("#KabKota").html(KabKota);
                }
            });
        <?php } ?>
    <?php } ?>

    // ==============================================
    // INPUT FORM FUNCTIONS
    // ==============================================
    
    // Set tahun saat periode dipilih (Input)
    $("#PeriodeRPJMD").change(function() {
        if ($(this).val()) {
            var years = $(this).val().split('-');
            $("#TahunMulai").val(years[0]);
            $("#TahunAkhir").val(years[1]);
        }
    });

    // Load Kementerian berdasarkan Periode (Input)
    $("#PeriodeIsuKLHSNasional").change(function() {
        var tahunMulai = $(this).val();
        if (tahunMulai == "") {
            $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $("#ListIsuKLHSNasional").html('<p class="text-muted">Pilih periode dan kementerian terlebih dahulu</p>');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetKementerianIsu",
            type: "POST",
            data: { 
                TahunMulai: tahunMulai,
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                var Kementerian = '<option value="">-- Pilih Kementerian --</option>';
                for (let i = 0; i < Data.length; i++) {
                    Kementerian += '<option value="' + Data[i].Id + '">' + Data[i].NamaKementerian + '</option>';
                }
                $("#Kementerian").html(Kementerian);
                $("#ListIsuKLHSNasional").html('<p class="text-muted">Pilih kementerian terlebih dahulu</p>');
            },
            error: function() {
                alert('Gagal memuat data kementerian!');
            }
        });
    });

    // Load Isu KLHS Nasional berdasarkan Kementerian (Input)
    $("#Kementerian").change(function() {
        var kementerianId = $(this).val();
        if (kementerianId == "") {
            $("#ListIsuKLHSNasional").html('<p class="text-muted">Pilih kementerian terlebih dahulu</p>');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetIsuKLHSNasional",
            type: "POST",
            data: { 
                Id: kementerianId,
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                var Isu = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        Isu += '<label>';
                        Isu += '<input type="checkbox" name="Isu" value="' + Data[i].Id + '"> ';
                        Isu += Data[i].NamaIsuKLHS;
                        Isu += '</label>';
                    }
                } else {
                    Isu = '<p class="text-muted">Tidak ada data Isu KLHS</p>';
                }
                $("#ListIsuKLHSNasional").html(Isu);
            },
            error: function() {
                alert('Gagal memuat data isu!');
            }
        });
    });

    // ==============================================
    // INPUT ISU KLHS
    // ==============================================
    $("#InputIsuKLHS").click(function() {
        var IsuKLHSNasional = [];
        $("input[name='Isu']:checked").each(function() {
            IsuKLHSNasional.push($(this).val());
        });
        
        if ($("#PeriodeRPJMD").val() === "") {
            alert('Pilih Periode RPJMD terlebih dahulu!');
            return;
        }
        if ($("#NamaIsuKLHS").val().trim() === "") {
            alert('Nama Isu KLHS harus diisi!');
            return;
        }
        if (IsuKLHSNasional.length === 0) {
            alert("Pilih minimal satu Isu KLHS Nasional!");
            return;
        }
        
        // Disable button
        $("#InputIsuKLHS").prop('disabled', true).html('<span class="spinner-border"></span> Menyimpan...');
        
        var Data = {
            PeriodeRPJMD: $("#PeriodeRPJMD").val(),
            NamaIsuKLHS: $("#NamaIsuKLHS").val().trim(),
            _Id: IsuKLHSNasional.join("$"),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        console.log('Sending data:', Data);
        
        $.ajax({
            url: BaseURL + "Daerah/InputIsuKLHS",
            type: "POST",
            data: Data,
            dataType: "json",
            success: function(response) {
                console.log('Response:', response);
                if (response.status === 'success') {
                    // Reset form
                    $("#PeriodeRPJMD").val('');
                    $("#NamaIsuKLHS").val('');
                    $("#TahunMulai").val('');
                    $("#TahunAkhir").val('');
                    $("#PeriodeIsuKLHSNasional").val('');
                    $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>');
                    $("#ListIsuKLHSNasional").html('<p class="text-muted">Pilih periode dan kementerian terlebih dahulu</p>');
                    
                    // Tutup modal
                    $('#ModalInputIsuKLHS').modal('hide');
                    
                    alert(response.message || 'Data berhasil disimpan!');
                    
                    // Reload data
                    window.location.reload();
                } else {
                    alert(response.message || 'Gagal menyimpan data!');
                    $("#InputIsuKLHS").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
                alert('Terjadi kesalahan server. Silakan cek console untuk detail.');
                $("#InputIsuKLHS").prop('disabled', false).html('<b>SIMPAN</b>');
            }
        });
    });

    // ==============================================
    // EDIT FORM FUNCTIONS
    // ==============================================
    
    // Set tahun saat periode dipilih (Edit)
    $("#EditPeriodeRPJMD").change(function() {
        if ($(this).val()) {
            var years = $(this).val().split('-');
            $("#EditTahunMulai").val(years[0]);
            $("#EditTahunAkhir").val(years[1]);
        }
    });

    // Load Kementerian berdasarkan Periode (Edit)
    $("#EditPeriodeIsuKLHSNasional").change(function() {
        var tahunMulai = $(this).val();
        var selectedKementerian = $("#EditSelectedKementerian").val();
        var selectedIsu = $("#EditIsuData").val() ? $("#EditIsuData").val().split('$') : [];
        
        if (tahunMulai == "") {
            $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $("#EditListIsuKLHSNasional").html('<p class="text-muted">Pilih periode dan kementerian terlebih dahulu</p>');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetKementerianIsu",
            type: "POST",
            data: { 
                TahunMulai: tahunMulai,
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                var Kementerian = '<option value="">-- Pilih Kementerian --</option>';
                for (let i = 0; i < Data.length; i++) {
                    var selected = (Data[i].Id == selectedKementerian) ? 'selected' : '';
                    Kementerian += '<option value="' + Data[i].Id + '" ' + selected + '>' + Data[i].NamaKementerian + '</option>';
                }
                $("#EditKementerian").html(Kementerian);
                
                // Jika ada selected kementerian, trigger change untuk load isu
                if (selectedKementerian) {
                    setTimeout(function() {
                        $("#EditKementerian").trigger('change');
                    }, 300);
                } else {
                    $("#EditListIsuKLHSNasional").html('<p class="text-muted">Pilih kementerian terlebih dahulu</p>');
                }
            },
            error: function() {
                alert('Gagal memuat data kementerian!');
            }
        });
    });

    // Load Isu KLHS Nasional berdasarkan Kementerian (Edit)
    $("#EditKementerian").change(function() {
        var kementerianId = $(this).val();
        var selectedIsu = $("#EditIsuData").val() ? $("#EditIsuData").val().split('$') : [];
        
        if (kementerianId == "") {
            $("#EditListIsuKLHSNasional").html('<p class="text-muted">Pilih kementerian terlebih dahulu</p>');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetIsuKLHSNasional",
            type: "POST",
            data: { 
                Id: kementerianId,
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                var Isu = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var checked = selectedIsu.includes(String(Data[i].Id)) ? 'checked' : '';
                        var checkedClass = checked ? 'checked' : '';
                        Isu += '<label class="' + checkedClass + '" style="display:block; padding:5px 0; cursor:pointer;">';
                        Isu += '<input type="checkbox" name="EditIsu" value="' + Data[i].Id + '" ' + checked + '> ';
                        Isu += Data[i].NamaIsuKLHS;
                        Isu += '</label>';
                    }
                } else {
                    Isu = '<p class="text-muted">Tidak ada data Isu KLHS</p>';
                }
                $("#EditListIsuKLHSNasional").html(Isu);
            },
            error: function() {
                alert('Gagal memuat data isu!');
            }
        });
    });

    // ==============================================
    // EDIT BUTTON - AMBIL DATA DARI SERVER
    // ==============================================
    $(document).on("click", ".Edit", function() {
        var id = $(this).data('id');
        
        if (!id) {
            alert('ID tidak ditemukan!');
            return;
        }
        
        console.log('Edit ID:', id);
        
        // Reset form
        $("#EditId").val('');
        $("#EditNamaIsuKLHS").val('');
        $("#EditPeriodeRPJMD").val('');
        $("#EditTahunMulai").val('');
        $("#EditTahunAkhir").val('');
        $("#EditIsuData").val('');
        $("#EditSelectedPeriode").val('');
        $("#EditSelectedKementerian").val('');
        $("#EditPeriodeIsuKLHSNasional").val('');
        $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
        $("#EditListIsuKLHSNasional").html('<p class="text-muted">Memuat data...</p>');
        
        // Ambil data dari server
        $.ajax({
            url: BaseURL + "Daerah/GetIsuKLHSById",
            type: "POST",
            data: { 
                id: id,
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(response) {
                console.log('Data response:', response);
                
                if (response && response.Id) {
                    // Set basic data
                    $("#EditId").val(response.Id);
                    $("#EditNamaIsuKLHS").val(response.NamaIsuKLHS);
                    $("#EditPeriodeRPJMD").val(response.TahunMulai + '-' + response.TahunAkhir);
                    $("#EditTahunMulai").val(response.TahunMulai);
                    $("#EditTahunAkhir").val(response.TahunAkhir);
                    
                    // Simpan data isu yang dipilih
                    if (response._Id_array) {
                        $("#EditIsuData").val(response._Id);
                    }
                    
                    // Set periode nasional dan kementerian jika ada
                    if (response.periode_nasional) {
                        $("#EditSelectedPeriode").val(response.periode_nasional);
                        $("#EditPeriodeIsuKLHSNasional").val(response.periode_nasional);
                        
                        // Trigger change untuk load kementerian
                        $("#EditPeriodeIsuKLHSNasional").trigger('change');
                        
                        // Setelah kementerian load, set selected
                        setTimeout(function() {
                            if (response.kementerian_id) {
                                $("#EditSelectedKementerian").val(response.kementerian_id);
                                $("#EditKementerian").val(response.kementerian_id);
                                $("#EditKementerian").trigger('change');
                            }
                        }, 500);
                    }
                    
                    // Show modal
                    $('#ModalEditIsuKLHS').modal("show");
                    
                } else {
                    alert('Gagal memuat data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
                alert('Terjadi kesalahan saat memuat data!');
            }
        });
    });

    // ==============================================
    // UPDATE ISU KLHS
    // ==============================================
    $("#UpdateIsuKLHS").click(function() {
        var IsuKLHSNasional = [];
        $("input[name='EditIsu']:checked").each(function() {
            IsuKLHSNasional.push($(this).val());
        });
        
        if ($("#EditPeriodeRPJMD").val() === "") {
            alert('Pilih Periode RPJMD terlebih dahulu!');
            return;
        }
        if ($("#EditNamaIsuKLHS").val().trim() === "") {
            alert('Nama Isu KLHS harus diisi!');
            return;
        }
        if (IsuKLHSNasional.length === 0) {
            alert("Pilih minimal satu Isu KLHS Nasional!");
            return;
        }
        
        // Disable button
        $("#UpdateIsuKLHS").prop('disabled', true).html('<span class="spinner-border"></span> Mengupdate...');
        
        var Data = {
            Id: $("#EditId").val(),
            EditPeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
            NamaIsuKLHS: $("#EditNamaIsuKLHS").val().trim(),
            _Id: IsuKLHSNasional.join("$"),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        console.log('Update data:', Data);
        
        $.ajax({
            url: BaseURL + "Daerah/UpdateIsuKLHS",
            type: "POST",
            data: Data,
            dataType: "json",
            success: function(response) {
                console.log('Update response:', response);
                if (response.status === 'success') {
                    $('#ModalEditIsuKLHS').modal('hide');
                    alert(response.message || 'Data berhasil diupdate!');
                    window.location.reload();
                } else {
                    alert(response.message || 'Gagal mengupdate data!');
                    $("#UpdateIsuKLHS").prop('disabled', false).html('<b>UPDATE</b>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
                alert('Terjadi kesalahan server. Silakan cek console untuk detail.');
                $("#UpdateIsuKLHS").prop('disabled', false).html('<b>UPDATE</b>');
            }
        });
    });

    // ==============================================
    // HAPUS ISU KLHS
    // ==============================================
    $(document).on("click", ".Hapus", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak ditemukan!');
            return;
        }
        
        if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            return;
        }
        
        var data = { 
            Id: id,
            [CSRF_NAME]: CSRF_TOKEN 
        };
        
        console.log('Delete data:', data);
        
        $.ajax({
            url: BaseURL + "Daerah/DeleteIsuKLHS",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                console.log('Delete response:', response);
                if (response.status === 'success') {
                    alert(response.message || 'Data berhasil dihapus!');
                    window.location.reload();
                } else {
                    alert(response.message || 'Gagal menghapus data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
                alert('Terjadi kesalahan server. Silakan cek console untuk detail.');
            }
        });
    });

    // ==============================================
    // RESET FORM SAAT MODAL DITUTUP
    // ==============================================
    $('#ModalInputIsuKLHS').on('hidden.bs.modal', function() {
        $("#PeriodeRPJMD").val('');
        $("#NamaIsuKLHS").val('');
        $("#TahunMulai").val('');
        $("#TahunAkhir").val('');
        $("#PeriodeIsuKLHSNasional").val('');
        $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>');
        $("#ListIsuKLHSNasional").html('<p class="text-muted">Pilih periode dan kementerian terlebih dahulu</p>');
        $("#InputIsuKLHS").prop('disabled', false).html('<b>SIMPAN</b>');
    });

    $('#ModalEditIsuKLHS').on('hidden.bs.modal', function() {
        $("#EditId").val('');
        $("#EditNamaIsuKLHS").val('');
        $("#EditPeriodeRPJMD").val('');
        $("#EditTahunMulai").val('');
        $("#EditTahunAkhir").val('');
        $("#EditIsuData").val('');
        $("#EditSelectedPeriode").val('');
        $("#EditSelectedKementerian").val('');
        $("#EditPeriodeIsuKLHSNasional").val('');
        $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
        $("#EditListIsuKLHSNasional").html('<p class="text-muted">Pilih periode dan kementerian terlebih dahulu</p>');
        $("#UpdateIsuKLHS").prop('disabled', false).html('<b>UPDATE</b>');
    });

});
</script>

</body>
</html>