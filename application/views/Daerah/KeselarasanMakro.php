<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Keselarasan Target Makro Ekonomi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('Daerah/Cssumum'); ?>
    
    <style>
        /* ============================================================
           STYLE UTAMA
           ============================================================ */
        .table-makro th, .table-makro td {
            vertical-align: middle;
            text-align: center;
            padding: 10px 8px;
            font-size: 13px;
        }
        .table-makro .indikator {
            text-align: left !important;
            padding-left: 15px !important;
        }
        .table-makro .target-numeric {
            font-weight: 600;
            color: #2c3e50;
        }
        .table-makro thead th {
            background-color: #f8f9fa;
            font-weight: 700;
            border-bottom: 2px solid #dee2e6;
        }
        
        /* ===== FILTER ===== */
        .filter-section {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        .filter-section .filter-label {
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 5px;
            color: #495057;
        }
        .filter-section select {
            height: 38px;
            font-size: 13px;
        }
        
        /* ===== TOMBOL ===== */
        .btn-aksi {
            padding: 3px 8px;
            font-size: 0.75rem;
            margin: 0 2px;
        }
        .btn-group-aksi {
            display: flex;
            justify-content: center;
            gap: 4px;
            flex-wrap: wrap;
        }
        .no-data {
            padding: 30px 0;
            color: #999;
        }
        
        /* ===== LOADING ===== */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
        }
        .loading-overlay .spinner {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            text-align: center;
        }
        .loading-overlay .spinner i {
            font-size: 40px;
            color: #007bff;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* ===== MODAL ===== */
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding: 15px 20px;
        }
        .modal-content {
            max-height: 95vh;
            overflow: hidden;
        }
        .modal-lg-custom {
            max-width: 90%;
            width: 90%;
        }
        .modal.fixed-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            overflow-y: auto;
            background: rgba(0,0,0,0.5);
        }
        .modal.fixed-modal .modal-dialog {
            margin: 20px auto;
            position: relative;
            top: 0;
            left: 0;
            transform: none !important;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .table-makro {
                font-size: 11px;
            }
            .table-makro th, .table-makro td {
                padding: 6px 4px;
            }
            .modal-body {
                max-height: 60vh;
                padding: 10px 15px;
            }
            .modal-lg-custom {
                max-width: 98%;
                width: 98%;
            }
        }
        
        /* ===== ALERT ===== */
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php $this->load->view('Daerah/sidebar'); ?>

<!-- LOADING OVERLAY -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner">
        <i class="notika-icon notika-refresh"></i>
        <h4>Memuat data...</h4>
    </div>
</div>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- ============================================================ -->
                        <!-- FILTER WILAYAH                                               -->
                        <!-- ============================================================ -->
                    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div class="filter-section">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="filter-group">
                                        <label class="filter-label" for="Provinsi"><b>Provinsi</b></label>
                                        <select class="form-control" id="Provinsi">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>"
                                                    <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="filter-group">
                                        <label class="filter-label" for="KabKota"><b>Kab/Kota</b></label>
                                        <select class="form-control" id="KabKota">
                                            <option value="">Pilih Kab/Kota</option>
                                            <?php if (!empty($KodeWilayah)) { 
                                                $selected_kab = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                            ?>
                                                <option value="<?= html_escape($KodeWilayah) ?>" selected>
                                                    <?= html_escape($selected_kab['Nama'] ?? $KodeWilayah) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="filter-group">
                                        <label class="filter-label" for="FilterTahun"><b>Tahun</b></label>
                                        <select class="form-control" id="FilterTahun">
                                            <?php foreach ($ListTahun as $thn) { ?>
                                                <option value="<?= $thn ?>" <?= ($thn == $TahunAktif) ? 'selected' : '' ?>>
                                                    <?= $thn ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="filter-group" style="margin-top: 28px;">
                                        <button class="btn btn-primary btn-block" id="Filter">
                                            <b>Filter</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                        <!-- INFORMASI WILAYAH -->
                        <?php if (!empty($KodeWilayah)) { ?>
                            <?php
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                            ?>
                            <div class="alert alert-info">
                                <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                &nbsp;|&nbsp; <strong>Tahun:</strong> <?= htmlspecialchars($TahunAktif ?? date('Y')) ?>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TOMBOL TAMBAH - HANYA ROLE 3                                -->
                        <!-- ============================================================ -->
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                            <div style="margin-bottom: 20px;">
                                <button class="btn btn-success" id="BtnTambah">
                                    <i class="notika-icon notika-plus"></i> <b>Tambah Target Makro</b>
                                </button>
                            </div>
                        <?php } ?>

                        <!-- ============================================================ -->
                        <!-- TABEL TARGET MAKRO EKONOMI - SESUAI GAMBAR                  -->
                        <!-- ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-makro" class="table table-striped table-bordered table-makro">
                                <thead>
                                    <tr>
                                        <th style="width:50px; min-width:50px;">NO.</th>
                                        <th style="min-width:250px;">INDIKATOR PEMBANGUNAN</th>
                                        <th style="min-width:200px;">TARGET KABUPATEN/KOTA TAHUN <?= $TahunAktif ?></th>
                                        <th style="min-width:200px;">TARGET RKPD KABUPATEN/KOTA TAHUN <?= $TahunAktif ?></th>
                                        <th style="min-width:150px;">KETERANGAN</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width:100px;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($TargetMakro)) { ?>
                                        <?php 
                                        $no = 1;
                                        foreach ($TargetMakro as $row) { 
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="indikator"><?= nl2br(html_escape($row['indikator'])) ?></td>
                                                <td class="target-numeric"><?= html_escape($row['target_rkpd_provinsi'] ?? '-') ?></td>
                                                <td class="target-numeric"><?= html_escape($row['target_rkpd_kabkota'] ?? '-') ?></td>
                                                <td><?= html_escape($row['keterangan'] ?? '-') ?></td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <td>
                                                        <div class="btn-group-aksi">
                                                            <button class="btn btn-warning btn-sm BtnEdit"
                                                                data-id="<?= $row['id'] ?>"
                                                                data-indikator="<?= html_escape($row['indikator']) ?>"
                                                                data-target-provinsi="<?= html_escape($row['target_rkpd_provinsi']) ?>"
                                                                data-target-kabkota="<?= html_escape($row['target_rkpd_kabkota']) ?>"
                                                                data-keterangan="<?= html_escape($row['keterangan']) ?>"
                                                                data-tahun="<?= $row['tahun'] ?>"
                                                                title="Edit Data"
                                                                type="button">
                                                                <i class="notika-icon notika-edit"></i>
                                                            </button>
                                                            <button class="btn btn-danger btn-sm BtnHapus"
                                                                data-id="<?= $row['id'] ?>"
                                                                title="Hapus Data"
                                                                type="button">
                                                                <i class="notika-icon notika-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '6' : '5' ?>" class="text-center no-data">
                                                <i class="fa fa-inbox" style="font-size: 40px; display: block; color: #ddd;"></i>
                                                <strong>Belum ada data Target Makro Ekonomi</strong>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <br>
                                                    <small class="text-muted">Klik tombol <strong>"Tambah Target Makro"</strong> untuk mulai mengisi data.</small>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- ============================================================ -->
                        <!-- FOOTER DATATABLE (INFO JUMLAH DATA)                         -->
                        <!-- ============================================================ -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-12" style="text-align: left; font-size: 13px; color: #666;">
                                <i class="fa fa-info-circle"></i> 
                                Menampilkan <strong><?= count($TargetMakro) ?></strong> data
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL TAMBAH/EDIT - HANYA ROLE 3                             -->
<!-- ============================================================ -->
<div class="modal fade fixed-modal" id="ModalMakro" role="dialog">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header" style="background:#28a745; color:#fff;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="ModalTitle">Tambah/Edit Target Makro Ekonomi</b></h4>
                <small style="color:#fff;">Isi data target makro ekonomi</small>
            </div>
            <div class="modal-body">
                <input type="hidden" id="MakroId" value="0">
                <input type="hidden" id="IsEditMode" value="0">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>INDIKATOR PEMBANGUNAN</b> <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="Indikator" rows="2" placeholder="Masukkan indikator pembangunan..."></textarea>
                            <small class="text-muted">Contoh: Laju Pertumbuhan Ekonomi (%), Tingkat Kemiskinan (%), IPM, dll.</small>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>TARGET KABUPATEN/KOTA TAHUN <?= $TahunAktif ?></b></label>
                            <input type="text" class="form-control" id="TargetProvinsi" placeholder="Contoh: 4,56 - 5,13 atau 22790,08" />
                            <small class="text-muted">Gunakan koma untuk desimal, gunakan tanda pisah (-) untuk rentang</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>TARGET RKPD KABUPATEN/KOTA TAHUN <?= $TahunAktif ?></b></label>
                            <input type="text" class="form-control" id="TargetKabKota" placeholder="Contoh: 5,00 atau 75,88" />
                            <small class="text-muted">Gunakan koma untuk desimal</small>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>TAHUN</b></label>
                            <select class="form-control" id="Tahun">
                                <?php foreach ($ListTahun as $thn) { ?>
                                    <option value="<?= $thn ?>" <?= ($thn == $TahunAktif) ? 'selected' : '' ?>>
                                        <?= $thn ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>KETERANGAN</b></label>
                            <input type="text" class="form-control" id="Keterangan" placeholder="Keterangan (opsional)" />
                            <small class="text-muted">Contoh: A, B, atau catatan tambahan</small>
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
                    <button class="btn btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- JAVASCRIPT                                                    -->
<!-- ============================================================ -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js') ?>"></script>

<script>
var BaseURL    = "<?= base_url() ?>";
var CSRF_NAME  = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_3 = '<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '1' : '0' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var CURRENT_YEAR = '<?= date('Y') ?>';

// ================================================================
// LOADING
// ================================================================
function showLoading() {
    $('#loadingOverlay').css('display', 'flex');
}

function hideLoading() {
    $('#loadingOverlay').css('display', 'none');
}

// ================================================================
// FILTER - LANGSUNG REFRESH TANPA POPUP
// ================================================================
$(document).ready(function() {
    
    // LOAD KAB/KOTA
    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
            },
            success: function(Data) {
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                var firstKode = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (i === 0 && Data.length === 1) ? 'selected' : '';
                        KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                    }
                    if (Data.length === 1) {
                        firstKode = Data[0].Kode;
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
                
                if (firstKode) {
                    $("#Filter").click();
                }
            },
            error: function() { 
                $("#KabKota").prop('disabled', false).html('<option value="">Pilih Kab/Kota</option>');
            }
        });
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
            $("#KabKota").val(kodeKab);
        }, 300);
    <?php } ?>

    // FILTER - REFRESH TANPA POPUP
    $("#Filter").off('click').on('click', function(e) {
        e.preventDefault();
        
        var provinsi = $("#Provinsi").val();
        var kabKota = $("#KabKota").val();
        var tahun = $("#FilterTahun").val();
        
        // Auto-select provinsi pertama jika kosong
        if (!provinsi || provinsi === "") {
            var firstProv = $("#Provinsi option:eq(1)").val();
            if (firstProv) {
                $("#Provinsi").val(firstProv);
                provinsi = firstProv;
            } else {
                window.location.href = window.location.pathname;
                return;
            }
        }
        
        // Auto-select kab/kota pertama jika kosong
        if (!kabKota || kabKota === "") {
            var firstKab = $("#KabKota option:eq(1)").val();
            if (firstKab) {
                $("#KabKota").val(firstKab);
                kabKota = firstKab;
            } else {
                kabKota = provinsi;
                $("#KabKota").val(kabKota);
            }
        }
        
        // Tampilkan loading di tombol
        $("#Filter").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');
        
        // Simpan ke session
        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { 
                KodeWilayah: kabKota,
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: 'json',
            success: function(res) {
                var url = window.location.pathname;
                if (tahun) {
                    url += '?tahun=' + encodeURIComponent(tahun);
                }
                window.location.href = url;
            },
            error: function() {
                var url = window.location.pathname;
                if (tahun) {
                    url += '?tahun=' + encodeURIComponent(tahun);
                }
                window.location.href = url;
            }
        });
    });
});

// ================================================================
// TOMBOL TAMBAH - HANYA ROLE 3
// ================================================================
if (IS_ROLE_3 == '1') {
    $(document).off('click', '#BtnTambah').on('click', '#BtnTambah', function(e) {
        e.preventDefault();
        
        $('#MakroId').val(0);
        $('#IsEditMode').val(0);
        $('#ModalTitle').text('Tambah Target Makro Ekonomi');
        
        $('#Indikator, #TargetProvinsi, #TargetKabKota, #Keterangan').val('');
        $('#Tahun').val(CURRENT_YEAR);
        
        $('#ModalMakro').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    // ================================================================
    // TOMBOL EDIT - HANYA ROLE 3
    // ================================================================
    $(document).on('click', '.BtnEdit', function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var indikator = $(this).data('indikator') || '';
        var targetProvinsi = $(this).data('target-provinsi') || '';
        var targetKabKota = $(this).data('target-kabkota') || '';
        var keterangan = $(this).data('keterangan') || '';
        var tahun = $(this).data('tahun') || CURRENT_YEAR;
        
        $('#MakroId').val(id);
        $('#IsEditMode').val(1);
        $('#ModalTitle').text('Edit Target Makro Ekonomi');
        
        $('#Indikator').val(indikator);
        $('#TargetProvinsi').val(targetProvinsi);
        $('#TargetKabKota').val(targetKabKota);
        $('#Keterangan').val(keterangan);
        $('#Tahun').val(tahun);
        
        $('#ModalMakro').modal({
            backdrop: 'static',
            keyboard: false
        }).css('display', 'block').addClass('in');
        $('body').addClass('modal-open');
    });

    // ================================================================
    // SIMPAN DATA
    // ================================================================
    $(document).off('click', '#BtnSimpan').on('click', '#BtnSimpan', function(e) {
        e.preventDefault();
        
        var id = parseInt($('#MakroId').val()) || 0;
        var isEdit = (id > 0);
        var indikator = $('#Indikator').val().trim();
        var targetProvinsi = $('#TargetProvinsi').val().trim();
        var targetKabKota = $('#TargetKabKota').val().trim();
        var keterangan = $('#Keterangan').val().trim();
        var tahun = $('#Tahun').val();
        
        // Validasi
        if (!indikator) {
            alert('Indikator Pembangunan harus diisi!');
            $('#Indikator').focus();
            return;
        }
        
        showLoading();
        
        var data = {
            id: id,
            indikator: indikator,
            target_rkpd_provinsi: targetProvinsi,
            target_rkpd_kabkota: targetKabKota,
            keterangan: keterangan,
            tahun: tahun,
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = isEdit ? BaseURL + "Daerah/EditTargetMakro" : BaseURL + "Daerah/InputTargetMakro";
        
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    $('#MakroId').val(0);
                    $('#IsEditMode').val(0);
                    location.reload();
                } else {
                    alert(res.message || "Gagal menyimpan data");
                }
            },
            error: function() {
                hideLoading();
                alert("Terjadi kesalahan saat menyimpan data");
            }
        });
    });

    // ================================================================
    // TOMBOL HAPUS
    // ================================================================
    $(document).on('click', '.BtnHapus', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        if (!confirm("Yakin hapus data ini?")) return;
        
        showLoading();
        
        $.ajax({
            url: BaseURL + "Daerah/HapusTargetMakro",
            type: "POST",
            data: {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            success: function(res) {
                hideLoading();
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal hapus data!");
                }
            },
            error: function() {
                hideLoading();
                alert("Terjadi kesalahan saat menghapus data");
            }
        });
    });
}

// ================================================================
// MODAL CLOSE HANDLER
// ================================================================
$('.modal').on('hidden.bs.modal', function() {
    $('body').removeClass('modal-open');
    $(this).removeClass('in').css('display', 'none');
});

// ================================================================
// DATATABLE INIT
// ================================================================
$(document).ready(function() {
    if ($('#data-table-makro').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-makro')) {
                $('#data-table-makro').DataTable().destroy();
            }
            
            $('#data-table-makro').DataTable({
            pageLength: 10,
            ordering: false,
            stateSave: false,
            autoWidth: false,
            responsive: true,
            language: {
                    "emptyTable": "Tidak ada data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "drawCallback": function() {
                    $('.BtnEdit, .BtnHapus').css({
                        'cursor': 'pointer',
                        'pointer-events': 'auto'
                    });
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }
});
</script>

</body>
</html>