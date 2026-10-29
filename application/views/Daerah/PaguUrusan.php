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
                            <div class="filter-card-custom" style="background:#fff; border-radius:12px; padding:18px 24px; margin-bottom:20px; box-shadow:0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04); border:1px solid #cbd5e1;">
                                <div class="filter-header-title" style="font-size:14px; font-weight:700; color:#1e293b; margin-bottom:14px; display:flex; align-items:center; gap:8px;">
                                    <i class="fa fa-filter" style="color:#2d6a4f;"></i> Filter Wilayah
                                </div>
                                <div class="row" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
                                    <div class="col-filter" style="flex:1; min-width:200px;">
                                        <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Provinsi</label>
                                        <select class="form-control filter-select-custom" id="Provinsi" style="width:100%; height:38px; border-radius:8px; border:1px solid #cbd5e1; font-size:13px; padding:6px 10px;">
                                            <option value="">Pilih Provinsi</option>
                                            <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php }} ?>
                                        </select>
                                    </div>

                                    <div class="col-filter" style="flex:1; min-width:200px;">
                                        <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Kabupaten / Kota</label>
                                        <select class="form-control filter-select-custom" id="KabKota" style="width:100%; height:38px; border-radius:8px; border:1px solid #cbd5e1; font-size:13px; padding:6px 10px;">
                                            <option value="">Pilih Kab/Kota</option>
                                            <?php if (!empty($KodeWilayah)) { 
                                                $selected_kab = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                            ?>
                                                <option value="<?= html_escape($KodeWilayah) ?>" selected>
                                                    <?= html_escape($selected_kab['Nama'] ?? $NamaWilayah) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-filter" style="width:auto;">
                                        <button type="button" class="btn btn-primary-custom" id="Filter" style="height:38px; padding:0 22px; font-size:13px;">
                                            <i class="fa fa-search"></i> Filter
                                        </button>
                                    </div>
                                </div>

                                <?php if (!empty($KodeWilayah)) { ?>
                                    <div style="margin-top:14px; padding:10px 14px; background:#f2fbf5; border-left:4px solid #2d6a4f; border-radius:6px; font-size:12.5px; color:#334155;">
                                        <strong>Wilayah Terpilih:</strong> <?= html_escape($NamaWilayah) ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php } ?>

                            <!-- Toolbar Atas (Filter Tahun & Tombol Tambah) -->
                            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 15px;">
                                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                    <label for="FilterTahunPagu" style="margin: 0; font-size: 13px; font-weight: bold; color: #333;">Tahun RKPD:</label>
                                    <select id="FilterTahunPagu" class="form-control" style="width: 140px; display: inline-block; height: 34px; padding: 4px 8px; font-size: 13px; color: #000; font-weight: bold;">
                                        <?php foreach ($ListTahun as $th) { ?>
                                            <option value="<?= html_escape($th) ?>" <?= ($th == $SelectedTahun) ? 'selected' : '' ?>>
                                                Tahun <?= html_escape($th) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php if (!empty($NamaWilayah)) { ?>
                                        <span class="label label-primary" style="font-size: 12px; padding: 6px 10px;">
                                            <i class="fa fa-map-marker-alt"></i> <?= html_escape($NamaWilayah) ?>
                                        </span>
                                    <?php } ?>
                                </div>
                                <div class="button-icon-btn" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <?php if (!empty($KodeWilayah) && isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputPaguUrusan">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Pagu Perangkat Daerah</b>
                                    </button>
                                    <?php } ?>
                                </div>
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
                                            <i class="fa fa-info-circle"></i> Belum ada data Pagu Anggaran Perangkat Daerah untuk Tahun <?= html_escape($SelectedTahun) ?>
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
                                            <div class="action-group">
                                                <button type="button" class="btn-action-custom btn-action-edit EditPaguUrusan" 
                                                        data-id="<?= $row['id'] ?>"
                                                        data-pagu="<?= html_escape($row['pagu']) ?>"
                                                        data-instansi="<?= html_escape($row['instansi_id'] ?? '') ?>"
                                                        data-tahun="<?= html_escape($row['tahun'] ?? $SelectedTahun) ?>"
                                                        title="Edit Data">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn-action-custom btn-action-delete HapusPaguUrusan" 
                                                        data-id="<?= $row['id'] ?>"
                                                        title="Hapus Data">
                                                    <i class="fa fa-trash"></i>
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
                
                <!-- TAHUN RKPD -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-size: 13px; font-weight: 600; margin-bottom: 4px;">
                        <b>Tahun RKPD</b> <span class="text-danger">*</span>
                    </label>
                    <select class="form-control" id="InputTahun" style="height: 40px; font-size: 13px; font-weight: bold;">
                        <?php foreach ($ListTahun as $th) { ?>
                            <option value="<?= html_escape($th) ?>" <?= ($th == $SelectedTahun) ? 'selected' : '' ?>>
                                Tahun <?= html_escape($th) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

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
                
                <!-- TAHUN RKPD -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-size: 13px; font-weight: 600; margin-bottom: 4px;">
                        <b>Tahun RKPD</b> <span class="text-danger">*</span>
                    </label>
                    <select class="form-control" id="EditTahun" style="height: 40px; font-size: 13px; font-weight: bold;">
                        <?php foreach ($ListTahun as $th) { ?>
                            <option value="<?= html_escape($th) ?>"><?= html_escape($th) ?></option>
                        <?php } ?>
                    </select>
                </div>

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
            var prov = $("#Provinsi").val();
            var kabKota = $("#KabKota").val();
            if (!prov) {
                alert("Mohon Pilih Provinsi");
                return;
            }
            if (!kabKota) {
                alert("Mohon Pilih Kab/Kota");
                return;
            }

            var $btn = $(this);
            $btn.prop('disabled', true).text('Memuat...');

            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: {
                    KodeWilayah: kabKota,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                success: function(res) {
                    if (res === '1' || res.trim() === '1' || res === 'success' || res.trim() === 'success') {
                        window.location.reload();
                    } else {
                        alert(res || "Gagal menyimpan filter wilayah!");
                        $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Filter');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
                    $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Filter');
                }
            });
        });

        <?php if (!empty($KodeWilayah)) { ?>
            var curKodePagu = "<?= $KodeWilayah ?>";
            var curProvPagu = curKodePagu.substring(0, 2);
            if ($('#Provinsi').val() && $('#KabKota option').length <= 1) {
                $.ajax({
                    url: BaseURL + 'Daerah/GetListKabKota',
                    type: 'POST',
                    data: {
                        Kode: curProvPagu,
                        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                    },
                    dataType: 'json',
                    success: function(res) {
                        var html = '<option value="">Pilih Kab/Kota</option>';
                        if (res && res.length > 0) {
                            $.each(res, function(i, item) {
                                var sel = (item.Kode === curKodePagu) ? 'selected' : '';
                                html += '<option value="' + item.Kode + '" ' + sel + '>' + item.Nama + '</option>';
                            });
                        }
                        $('#KabKota').html(html);
                    }
                });
            }
        <?php } ?>
    <?php } ?>
    
    /* ================= FILTER TAHUN ================= */
    $('#FilterTahunPagu').on('change', function() {
        var tahun = $(this).val();
        var url = new URL(window.location.href);
        url.searchParams.set('tahun', tahun);
        window.location.href = url.toString();
    });

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
        
        var tahun = $('#InputTahun').val() || '<?= $SelectedTahun ?>';
        var Data = {
            pagu: paguClean,
            instansi_id: instansiId,
            tahun: tahun,
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
        var tahun = $(this).data('tahun') || '<?= $SelectedTahun ?>';
        
        $("#EditId").val(id);
        $("#EditTahun").val(tahun);
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
        
        var tahun = $('#EditTahun').val() || '<?= $SelectedTahun ?>';
        var Data = {
            id: id,
            pagu: paguClean,
            instansi_id: instansiId,
            tahun: tahun,
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