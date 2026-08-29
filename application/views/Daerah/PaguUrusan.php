<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    .text-danger { color: #dc3545 !important; }
    .text-muted { color: #6c757d !important; }
    
    .form-control, .form-control option { color: #000 !important; }
    .modal-content { color: #000; }
    
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
    @media (max-width: 768px) {
        .filter-row { flex-direction: column; gap: 15px; }
        .filter-select { width: 100%; }
        .table-responsive { overflow-x: auto; }
    }
    
    .table-bordered td, .table-bordered th {
        border: 1px solid #ddd !important;
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

    .pagu-kosong {
        color: #adb5bd;
        font-style: italic;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            
                            <!-- Filter Wilayah -->
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

                            <?php if (!empty($KodeWilayah)) { ?>
                            <div class="alert alert-info" style="margin-bottom: 20px;">
                                <strong>Wilayah:</strong> <?= html_escape($NamaWilayah) ?>
                            </div>
                            <?php } ?>

                            <!-- Tombol Tambah - HANYA UNTUK LEVEL 3 -->
                            <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputPaguUrusan">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Pagu Perangkat Daerah</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Tabel -->
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead>
                                    <tr style="background-color: #f0f0f0; color: #333; text-align: center;">
                                        <th style="width: 5%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            No
                                        </th>
                                        <th style="width: 55%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            Perangkat Daerah / Dinas
                                        </th>
                                        <th style="width: 25%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            Pagu Anggaran Indikatif
                                        </th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width: 15%; vertical-align: middle; text-align: center; border: 1px solid #ddd;">
                                            Aksi
                                        </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($PaguUrusan)) { ?>
                                    <tr>
                                        <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '4' : '3' ?>" class="text-center text-muted" style="padding: 30px 0;">
                                            <i class="fa fa-info-circle"></i> Belum ada data Pagu Anggaran Perangkat Daerah
                                        </td>
                                    </tr>
                                    <?php } else { ?>
                                    <?php $no = 1; foreach ($PaguUrusan as $row) { ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle; background-color: #f9f9f9; border: 1px solid #ddd;">
                                            <?= $no++ ?>
                                        </td>
                                        <td style="vertical-align: middle; padding: 10px 14px; border: 1px solid #ddd;">
                                            <strong style="color: #0f172a; font-size: 13.5px;">
                                                <i class="fa fa-building-o" style="margin-right: 6px; color: #17a2b8;"></i><?= html_escape($row['nama_dinas'] ?? '-') ?>
                                            </strong>
                                        </td>
                                        <td style="vertical-align: middle; padding: 10px 12px; border: 1px solid #ddd; text-align: center;">
                                            <?php if (!empty($row['pagu'])) { ?>
                                                <strong style="color: #047857; font-size: 14px;">Rp <?= number_format($row['pagu'], 0, ',', '.') ?></strong>
                                            <?php } else { ?>
                                                <span class="pagu-kosong">-</span>
                                            <?php } ?>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="text-center" style="vertical-align: middle; background-color: #f9f9f9; border: 1px solid #ddd;">
                                            <div class="btn-group" style="display: inline-flex; gap: 4px; flex-wrap: wrap; justify-content: center;">
                                                <button class="btn btn-sm btn-warning EditPaguUrusan" 
                                                        data-id="<?= $row['id'] ?>"
                                                        data-pagu="<?= html_escape($row['pagu']) ?>"
                                                        data-instansi="<?= html_escape($row['instansi_id'] ?? '') ?>"
                                                        title="Edit"
                                                        style="padding: 4px 10px; font-size: 12px; background-color: #f0ad4e; border-color: #eea236; color: #fff; border-radius: 4px;">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger HapusPaguUrusan" 
                                                        data-id="<?= $row['id'] ?>"
                                                        title="Hapus"
                                                        style="padding: 4px 10px; font-size: 12px; border-radius: 4px;">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                        <?php } ?>
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

<!-- ============================================================ -->
<!-- MODAL INPUT PAGU ANGGARAN PERANGKAT DAERAH (1 DINAS)        -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalInputPaguUrusan" role="dialog">
    <div class="modal-dialog" style="width: 90%; max-width: 600px; margin: 80px auto;">
        <div class="modal-content" style="border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="background: #f8f9fa; border-bottom: 3px solid #28a745; padding: 14px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="font-size: 28px;">&times;</button>
                <h4 style="margin: 0;"><b><i class="notika-icon notika-plus" style="color: #28a745;"></i> Tambah Pagu Perangkat Daerah</b></h4>
                <small class="text-muted" style="font-size: 12px;">Pilih Perangkat Daerah / Dinas dan masukkan nominal Pagu Anggaran</small>
            </div>
            <div class="modal-body" style="padding: 20px; background: #fafafa;">
                
                <!-- PERANGKAT DAERAH / DINAS (SINGLE) -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-size: 13px; font-weight: 600; margin-bottom: 4px;">
                        <b>Perangkat Daerah / Dinas</b> <span class="text-danger">*</span>
                    </label>
                    <select class="form-control" id="InputInstansiId" style="height: 40px; font-size: 13px;">
                        <option value="">-- Pilih Perangkat Daerah / Dinas --</option>
                        <?php if (!empty($Dinas)) { foreach ($Dinas as $d) { ?>
                            <option value="<?= $d['id'] ?>"><?= html_escape($d['nama']) ?></option>
                        <?php }} ?>
                    </select>
                </div>
                
                <!-- PAGU ANGGARAN -->
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-size: 13px; font-weight: 600; margin-bottom: 4px;">
                        <b>Pagu Anggaran Indikatif (Rp)</b> <span class="text-muted">(opsional)</span>
                    </label>
                    <input type="text" class="form-control" id="InputPagu" 
                           placeholder="Contoh: 1.000.000.000 (kosongkan jika belum ada anggaran)" style="color: #000; height: 40px; font-size: 13.5px; font-weight: 600;">
                    <small class="text-muted" style="font-size: 11px; display: block; margin-top: 3px;">
                        <i class="fa fa-info-circle"></i> Masukkan nominal angka pagu anggaran indikatif
                    </small>
                </div>

            </div>
            <div class="modal-footer" style="border-top: 2px solid #e5e5e5; padding: 12px 20px; background: #f8f9fa; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight: 600; padding: 6px 20px;"><b>BATAL</b></button>
                <button class="btn btn-success" id="SimpanPaguUrusan" style="font-weight: 600; padding: 6px 25px;"><b><i class="notika-icon notika-check"></i> SIMPAN</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT PAGU ANGGARAN PERANGKAT DAERAH (1 DINAS)         -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditPaguUrusan" role="dialog">
    <div class="modal-dialog" style="width: 90%; max-width: 600px; margin: 90px auto;">
        <div class="modal-content" style="border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
            <div class="modal-header" style="background: #f8f9fa; border-bottom: 3px solid #f0ad4e; padding: 14px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="font-size: 28px;">&times;</button>
                <h4 style="margin: 0;"><b><i class="notika-icon notika-settings" style="color: #f0ad4e;"></i> Edit Pagu Perangkat Daerah</b></h4>
                <small class="text-muted" style="font-size: 12px;">Sesuaikan Perangkat Daerah / Dinas atau nominal Pagu Anggaran</small>
            </div>
            <div class="modal-body" style="padding: 20px; background: #fafafa;">
                
                <input type="hidden" id="EditId">
                
                <!-- PERANGKAT DAERAH / DINAS (SINGLE) -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-size: 13px; font-weight: 600; margin-bottom: 4px;">
                        <b>Perangkat Daerah / Dinas</b> <span class="text-danger">*</span>
                    </label>
                    <select class="form-control" id="EditInstansiId" style="height: 40px; font-size: 13px;">
                        <option value="">-- Pilih Perangkat Daerah / Dinas --</option>
                        <?php if (!empty($Dinas)) { foreach ($Dinas as $d) { ?>
                            <option value="<?= $d['id'] ?>"><?= html_escape($d['nama']) ?></option>
                        <?php }} ?>
                    </select>
                </div>
                
                <!-- PAGU ANGGARAN -->
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-size: 13px; font-weight: 600; margin-bottom: 4px;">
                        <b>Pagu Anggaran Indikatif (Rp)</b> <span class="text-muted">(opsional)</span>
                    </label>
                    <input type="text" class="form-control" id="EditPagu" 
                        placeholder="Contoh: 1.000.000.000 (kosongkan jika belum ada anggaran)" style="color: #000; height: 40px; font-size: 13.5px; font-weight: 600;">
                    <small class="text-muted" style="font-size: 11px; display: block; margin-top: 3px;">
                        <i class="fa fa-info-circle"></i> Masukkan nominal angka pagu anggaran indikatif
                    </small>
                </div>

            </div>
            <div class="modal-footer" style="border-top: 2px solid #e5e5e5; padding: 12px 20px; background: #f8f9fa; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight: 600; padding: 6px 20px;"><b>BATAL</b></button>
                <button class="btn btn-success" id="UpdatePaguUrusan" style="font-weight: 600; padding: 6px 25px;"><b><i class="notika-icon notika-check"></i> UPDATE</b></button>
            </div>
        </div>
    </div>
</div>

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

    /* ================= FILTER WILAYAH ================= */
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
                    } catch(e) {
                        $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', false);
                    }
                }
            });
        });

        $("#Filter").click(function() {
            var KabKota = $("#KabKota").val();
            if (KabKota === "") {
                alert("Pilih Provinsi dan Kab/Kota terlebih dahulu!");
                return;
            }
            window.location.href = BaseURL + "Daerah/PaguUrusan?KodeWilayah=" + KabKota;
        });
    <?php } ?>

    /* ================= FORMAT ANGKA ================= */
    function formatNumber(num) {
        if (!num || num === '' || num === 'null' || num === 'undefined') return '';
        var str = String(num).replace(/\./g, '');
        if (isNaN(str) || str === '') return '';
        return str.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#InputPagu, #EditPagu').on('input', function() {
        var value = $(this).val().replace(/\./g, '');
        if (!isNaN(value) && value.length > 0) {
            $(this).val(formatNumber(value));
        }
    });

    // Reset Modal Input
    $('#ModalInputPaguUrusan').on('show.bs.modal', function() {
        $('#InputInstansiId').val('');
        $('#InputPagu').val('');
        $('#SimpanPaguUrusan').prop('disabled', false).html('<b><i class="notika-icon notika-check"></i> SIMPAN</b>');
    });

    /* ================= SIMPAN ================= */
    $("#SimpanPaguUrusan").click(function() {
        var instansiId = $('#InputInstansiId').val();

        if (!instansiId) {
            alert('Silakan pilih Perangkat Daerah / Dinas terlebih dahulu!');
            $('#InputInstansiId').focus();
            return;
        }

        var pagu = $("#InputPagu").val().trim();
        var paguClean = '';
        if (pagu !== "") {
            paguClean = pagu.replace(/\./g, '');
            if (isNaN(paguClean)) {
                alert('Pagu Anggaran harus berupa angka!');
                return;
            }
        }
        
        var Data = {
            pagu: paguClean,
            instansi_id: instansiId,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
        };
        
        $.ajax({
            url: BaseURL + "Daerah/InputPaguUrusan",
            type: "POST",
            data: Data,
            beforeSend: function() {
                $("#SimpanPaguUrusan").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        $('#ModalInputPaguUrusan').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        $("#SimpanPaguUrusan").prop('disabled', false).html('<b>SIMPAN</b>');
                    }
                } catch(e) {
                    $('#ModalInputPaguUrusan').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#SimpanPaguUrusan").prop('disabled', false).html('<b>SIMPAN</b>');
            }
        });
    });

    /* ================= EDIT BUTTON CLICK ================= */
    $(document).on("click", ".EditPaguUrusan", function() {
        var id = $(this).data('id');
        var pagu = $(this).data('pagu');
        var instansi = $(this).data('instansi');
        
        $("#EditId").val(id);
        $("#EditPagu").val(formatNumber(String(pagu || '')));
        
        var singleInstansiId = '';
        if (instansi && String(instansi).trim() !== '') {
            var parts = String(instansi).split(',');
            singleInstansiId = parts[0].trim();
        }
        $('#EditInstansiId').val(singleInstansiId);
        
        $('#UpdatePaguUrusan').prop('disabled', false).html('<b><i class="notika-icon notika-check"></i> UPDATE</b>');
        $('#ModalEditPaguUrusan').modal("show");
    });

    /* ================= UPDATE ================= */
    $("#UpdatePaguUrusan").click(function() {
        var id = $("#EditId").val();
        var instansiId = $('#EditInstansiId').val();

        if (!instansiId) {
            alert('Silakan pilih Perangkat Daerah / Dinas terlebih dahulu!');
            $('#EditInstansiId').focus();
            return;
        }

        var pagu = $("#EditPagu").val().trim();
        var paguClean = '';
        if (pagu !== "") {
            paguClean = pagu.replace(/\./g, '');
            if (isNaN(paguClean)) {
                alert('Pagu Anggaran harus berupa angka!');
                return;
            }
        }
        
        var Data = {
            id: id,
            pagu: paguClean,
            instansi_id: instansiId,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
        };
        
        $.ajax({
            url: BaseURL + "Daerah/EditPaguUrusan",
            type: "POST",
            data: Data,
            beforeSend: function() {
                $("#UpdatePaguUrusan").prop('disabled', true).html('<span class="spinner-border-sm"></span> Mengupdate...');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        $('#ModalEditPaguUrusan').modal('hide');
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        $("#UpdatePaguUrusan").prop('disabled', false).html('<b>UPDATE</b>');
                    }
                } catch(e) {
                    $('#ModalEditPaguUrusan').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#UpdatePaguUrusan").prop('disabled', false).html('<b>UPDATE</b>');
            }
        });
    });

    /* ================= HAPUS ================= */
    $(document).on("click", ".HapusPaguUrusan", function() {
        var id = $(this).data('id');
        if (!confirm("Apakah Anda yakin ingin menghapus data Pagu Anggaran ini?")) {
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/HapusPaguUrusan",
            type: "POST",
            data: { id: id, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                    }
                } catch(e) {
                    location.reload();
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
            }
        });
    });

});
</script>
</body>
</html>