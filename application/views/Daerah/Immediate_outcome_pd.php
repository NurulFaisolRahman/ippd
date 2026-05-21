<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<style>
    .nav-link {
        color: #6c757d;
        text-decoration: none;
        padding: 5px 15px;
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease;
        font-weight: 500;
        display: inline-block;
    }
    .nav-link:hover {
        color: #007bff;
        border-bottom-color: #007bff;
    }
    .nav-link.active {
        color: #007bff;
        border-bottom: 2px solid #007bff;
    }
    .field-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }
    .field-row .form-control {
        flex: 1;
    }
    .table td { 
        padding: 12px !important; 
        vertical-align: middle !important; 
    }
    .modal {
        padding-top: 70px;
    }
    .modal-loading {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.9);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-radius: 8px;
    }
    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
        padding-left: 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    /* Tambahan CSS untuk Filter Instansi */
.filter-instansi-section {
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #dee2e6;
}
.filter-instansi-title {
    margin-bottom: 12px;
    font-weight: bold;
    color: #495057;
    font-size: 14px;
}
.filter-instansi-title i {
    margin-right: 8px;
    color: #007bff;
}
.filter-instansi-row {
    display: flex;
    gap: 15px;
    align-items: flex-end;
    flex-wrap: wrap;
}
.filter-instansi-group {
    flex: 2;
    min-width: 250px;
}
.filter-instansi-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    font-size: 12px;
    color: #495057;
}
.btn-group-instansi {
    display: flex;
    gap: 10px;
    flex: 1;
    min-width: 200px;
}
.btn-instansi {
    padding: 8px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}
.btn-instansi-filter {
    background: #007bff;
    color: white;
}
.btn-instansi-filter:hover {
    background: #0056b3;
    transform: translateY(-1px);
}
.btn-instansi-reset {
    background: #6c757d;
    color: white;
}
.btn-instansi-reset:hover {
    background: #545b62;
    transform: translateY(-1px);
}
.info-readonly {
    background-color: #fff3cd;
    padding: 10px 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    border-left: 4px solid #ffc107;
}
.info-readonly i {
    margin-right: 8px;
    color: #856404;
}
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            
            <!-- HEADER NAVIGASI -->
            <div style="background: white; padding: 12px 20px; margin-bottom: 25px; border: 1px solid #dee2e6; border-radius: 5px;">
                <div style="display: flex; gap: 25px; flex-wrap: wrap;">
                    <a href="<?=base_url('Instansi/Ultimate_outcome_pd')?>" class="nav-link">ULTIMATE OUTCOME PD (Level 1)</a>
                    <a href="<?=base_url('Instansi/Intermediate_outcome_pd')?>" class="nav-link">INTERMEDIATE OUTCOME PD (Level 2)</a>
                    <a href="<?=base_url('Instansi/Immediate_outcome_pd')?>" class="nav-link active">IMMEDIATE OUTCOME PD (Level 3)</a>
                    <a href="<?=base_url('Instansi/Output_pd')?>" class="nav-link">OUTPUT PD (Level 4)</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH & INSTANSI (HANYA UNTUK SEBELUM LOGIN) -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <label><b>Provinsi</b></label>
                                                <select class="form-control" id="Provinsi">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($Provinsi as $prov) { ?>
                                                        <option value="<?= html_escape($prov['Kode']) ?>">
                                                            <?= html_escape($prov['Nama']) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <label><b>Kab/Kota</b></label>
                                                <select class="form-control" id="KabKota">
                                                    <option value="">Pilih Kab/Kota</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6" id="FilterInstansiBeforeGroup" style="display: none;">
                                                <label><b>Filter Instansi</b></label>
                                                <select class="form-control" id="FilterInstansiBeforeLogin">
                                                    <option value="">-- Semua Instansi --</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div style="margin-top: 28px;">
                                                    <button class="btn btn-primary btn-block" id="Filter">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                    <?php if (!empty($FilterInstansiId)): 
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $FilterInstansiId)->get()->row_array();
                                    ?>
                                        <span style="margin-left: 16px;"><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- END FILTER WILAYAH & INSTANSI -->

                        <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)): ?>
                            <div class="filter-instansi-section">
                                <div class="filter-instansi-title">
                                    <i class="fa fa-building"></i> Filter Instansi
                                </div>
                                <div class="filter-instansi-row">
                                    <div class="filter-instansi-group">
                                        <select id="FilterInstansi" class="form-control">
                                            <option value="">-- Semua Instansi --</option>
                                            <?php foreach ($ListInstansi as $ins): ?>
                                                <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                    <?= html_escape($ins['nama']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="btn-group-instansi">
                                        <button class="btn-instansi btn-instansi-filter" id="FilterInstansiBtn">
                                            <i class="fa fa-search"></i> Tampilkan
                                        </button>
                                        <button class="btn-instansi btn-instansi-reset" id="ResetFilterBtn">
                                            <i class="fa fa-undo"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- TOMBOL TAMBAH (HANYA UNTUK ROLE 4) -->
                        <?php if ($IsRole4) { ?>
                            <div class="basic-tb-hd mb-3">
                                <button class="btn btn-success" id="btn-tambah">
                                    <i class="fa fa-plus"></i> Tambah IMMEDIATE OUTCOME PD (Level 3)
                                </button>
                            </div>
                            <br>
                        <?php } ?>

                        <!-- TABEL -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="60" class="text-center">NO</th>
                                        <th>Intermediate Outcome (Level 2)</th>
                                        <th>Kinerja Immediate</th>
                                        <?php if ($IsRole4) { ?>
                                            <th width="120" class="text-center">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($items)): ?>
                                        <?php $no = 1; foreach($items as $row): ?>
                                            <tr data-id="<?= (int)$row['id'] ?>">
                                                <td class="text-center align-middle"><?= $no++ ?></td>
                                                <td class="align-middle">
                                                    <?= nl2br(html_escape(substr($row['intermediate_kinerja'] ?? '—', 0, 100))) . (strlen($row['intermediate_kinerja'] ?? '') > 100 ? '...' : '') ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= nl2br(html_escape($row['kinerja'] ?? '—')) ?>
                                                </td>
                                                <?php if ($IsRole4): ?>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group-aksi">
                                                            <button class="btn btn-sm btn-warning btn-edit"
                                                                    data-id="<?= $row['id'] ?>"
                                                                    title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $row['id'] ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="<?= $IsRole4 ? '4' : '3' ?>" class="text-center py-5 text-muted">
                                                <i class="fa fa-folder-open-o fa-3x mb-3 d-block opacity-50"></i>
                                                Belum ada data Immediate Outcome Perangkat Daerah<br>
                                                <?php if ($IsRole4): ?>
                                                    <button class="btn btn-success mt-3" id="btn-tambah-empty">
                                                        <i class="fa fa-plus"></i> Tambah Data Pertama
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL IMMEDIATE OUTCOME (LEVEL 3) - HANYA UNTUK ROLE 4 -->
<?php if ($IsRole4) { ?>
<div class="modal fade" id="modalLevel3" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h3 class="modal-title">
                    Immediate Outcome / Level 3
                </h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_level3">
                <input type="hidden" id="edit_mode" value="0">

                <!-- Info Instansi -->
                <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                    <div class="alert alert-info mb-3">
                        <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                    </div>
                <?php } ?>

                <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
                    
                    <!-- TAUTAN KE INTERMEDIATE OUTCOME -->
                    <div class="form-group">
                        <label><b>Tautan ke Intermediate Outcome (Level 2)</b></label>
                        <select id="IntermediateId" class="form-control select2-intermediate" style="width: 100%;">
                            <option value="">— Pilih Intermediate Outcome —</option>
                            <?php foreach ($intermediate_options as $opt): ?>
                                <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'], 0, 150)) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- KINERJA - TEXTFIELD UTAMA -->
                    <div class="form-group">
                        <label><b>Kinerja Immediate</b> <span class="text-danger">*</span></label>
                        <div class="mb-2 text-muted small">
                            <em>Immediate Outcome Level 3 - Kinerja Immediate</em>
                        </div>
                        <textarea id="kinerja" class="form-control" rows="4" placeholder="Masukkan kinerja immediate..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- INDIKATOR KINERJA -->
                            <div class="form-group">
                                <label><b>Indikator Kinerja</b></label>
                                <div id="indikator-container"></div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-tambah-indikator">
                                    <i class="fa fa-plus"></i> Tambah Indikator
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- DINAS / INSTANSI -->
                            <div class="form-group">
                                <label><b>Pilih Dinas / Instansi</b></label>
                                <select id="DinasFilter" class="form-control select2-dinas" style="width: 100%;">
                                    <option value="">-- Pilih Dinas --</option>
                                </select>
                            </div>

                            <!-- PELAKSANA -->
                            <div class="form-group" id="PelaksanaGroup" style="display: none;">
                                <label><b>Pelaksana / Urusan</b></label>
                                <select id="Pelaksana" class="form-control select2-pelaksana" style="width: 100%;">
                                    <option value="">-- Pilih Pelaksana --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Inovasi Daerah</b></label>
                                <div id="inovasi-container"></div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-tambah-inovasi">
                                    <i class="fa fa-plus"></i> Tambah Inovasi
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Outcome Inovasi</b></label>
                                <div id="outcome-container"></div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-tambah-outcome">
                                    <i class="fa fa-plus"></i> Tambah Outcome
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Output Inovasi</b></label>
                                <div id="output-container"></div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-tambah-output">
                                    <i class="fa fa-plus"></i> Tambah Output
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- CROSSCUTTING -->
                    <div class="form-group">
                        <label><b>Crosscutting Dengan Perangkat Daerah</b></label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Perangkat Daerah</th>
                                        <th>Keterangan</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody id="crosscutting-body"></tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" id="btn-tambah-crosscutting">
                            <i class="fa fa-plus"></i> Tambah Crosscutting
                        </button>
                    </div>

                </div>
            </div>

            <!-- FOOTER - PASTIKAN BUTTON type="button" -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-simpan-level3">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/jquery.dataTables.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var daftarPerangkat = [];

$(document).ready(function() {
    
    // Setup AJAX CSRF
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (settings.type.toUpperCase() === 'POST') {
                settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
            }
        }
    });

    // Inisialisasi DataTable dengan pagination (tanpa sorting)
    if ($('#data-table-basic').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-basic')) {
                $('#data-table-basic').DataTable().destroy();
            }
            $('#data-table-basic').DataTable({
                "pageLength": 10,
                "ordering": false,
                "language": {
                    "emptyTable": "Tidak ada data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "loadingRecords": "Memuat...",
                    "processing": "Memproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ditemukan data yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }

    // ================= FILTER WILAYAH & INSTANSI (HANYA UNTUK BELUM LOGIN) =================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiBeforeGroup").hide();
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val() },
            dataType: 'json',
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
                $("#FilterInstansiBeforeGroup").hide();
            },
            success: function(Data) {
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                if (Data && Data.length > 0) {
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

    // Load instansi saat Kab/Kota dipilih (untuk sebelum login)
    $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
            $("#FilterInstansiBeforeGroup").hide();
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListInstansiLevel4",
            type: "POST",
            data: { kode_wilayah: kabKotaKode },
            dataType: 'json',
            beforeSend: function() {
                $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
                $("#FilterInstansiBeforeGroup").show();
            },
            success: function(Data) {
                var options = '<option value="">-- Semua Instansi --</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
                        options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
                    }
                }
                $("#FilterInstansiBeforeLogin").html(options);
                $("#FilterInstansiBeforeGroup").show();
            },
            error: function() {
                alert("Gagal memuat data Instansi");
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
        var instansiId = $("#FilterInstansiBeforeLogin").val();

        var $btn = $(this);
        $btn.prop('disabled', true).text('Memuat...');

        $.ajax({
            url: BaseURL + "Instansi/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kodeWilayah },
            success: function(res) {
                if (res === '1') {
                    var url = BaseURL + "Instansi/Immediate_outcome_pd";
                    if (instansiId && instansiId != '') {
                        url += "?instansi_id=" + instansiId;
                    }
                    window.location.href = url;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $btn.prop('disabled', false).text('Filter');
                }
            },
            error: function() {
                alert("Gagal menghubungi server!");
                $btn.prop('disabled', false).text('Filter');
            }
        });
    });

    <?php if (!empty($KodeWilayah)): ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
            $("#KabKota").val(kodeKab).trigger('change');
            <?php if (!empty($FilterInstansiId)): ?>
                setTimeout(function() {
                    if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
                        $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
                    }
                }, 800);
            <?php endif; ?>
        }, 500);
    <?php endif; ?>
    <?php } ?>

    // ================= FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) =================
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
        $("#FilterInstansiBtn").click(function() {
            var instansiId = $("#FilterInstansi").val();
            var url = BaseURL + "Instansi/Immediate_outcome_pd";
            if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
            window.location.href = url;
        });
        $("#ResetFilterBtn").click(function() { 
            window.location.href = BaseURL + "Instansi/Immediate_outcome_pd"; 
        });
    <?php } ?>

    <?php if ($IsRole4) { ?>
    
    // ==================== LOAD DROPDOWN DINAS ====================
    function loadDinasOptions(selectedDinasId = '') {
        $.ajax({
            url: BaseURL + 'Instansi/Immediate_outcome_pd_get_daftar_dinas',
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#DinasFilter').html('<option value="">Loading...</option>');
            },
            success: function(data) {
                let options = '<option value="">-- Pilih Dinas --</option>';
                
                if (data.length > 0) {
                    $.each(data, function(index, item) {
                        let selected = (item.id == selectedDinasId) ? 'selected' : '';
                        options += `<option value="${item.id}" ${selected}>${escapeHtml(item.nama)}</option>`;
                    });
                } else {
                    options += '<option value="" disabled>Tidak ada data Dinas</option>';
                }
                
                $('#DinasFilter').html(options);
                
                if ($('#DinasFilter').hasClass('select2-hidden-accessible')) {
                    $('#DinasFilter').select2('destroy');
                }
                $('#DinasFilter').select2({
                    placeholder: 'Pilih Dinas...',
                    dropdownParent: $('#modalLevel3'),
                    width: '100%'
                });
                
                if (selectedDinasId) {
                    $('#PelaksanaGroup').show();
                } else {
                    $('#PelaksanaGroup').hide();
                }
            },
            error: function() {
                $('#DinasFilter').html('<option value="">Gagal memuat data</option>');
            }
        });
    }

    // ==================== LOAD PELAKSANA ====================
    function loadPelaksanaByDinas(dinasId, selectedPelaksanaId = '') {
        if (!dinasId) {
            $('#PelaksanaGroup').hide();
            $('#Pelaksana').html('<option value="">-- Pilih Pelaksana --</option>');
            return;
        }
        
        $('#PelaksanaGroup').show();
        
        $.ajax({
            url: BaseURL + 'Instansi/Immediate_outcome_pd_get_pelaksana_by_dinas',
            type: 'POST',
            data: { dinas_id: dinasId },
            dataType: 'json',
            beforeSend: function() {
                $('#Pelaksana').html('<option value="">Loading...</option>');
            },
            success: function(data) {
                let options = '<option value="">-- Pilih Pelaksana --</option>';
                
                if (data.length > 0) {
                    $.each(data, function(index, item) {
                        let selected = (item.id == selectedPelaksanaId) ? 'selected' : '';
                        let displayText = item.nama;
                        if (item.jabatan) {
                            displayText += ' - ' + item.jabatan;
                        }
                        if (item.nama_dinas) {
                            displayText += ' (' + item.nama_dinas + ')';
                        }
                        options += `<option value="${item.id}" ${selected}>${escapeHtml(displayText)}</option>`;
                    });
                } else {
                    options += '<option value="" disabled>Tidak ada pelaksana</option>';
                }
                
                $('#Pelaksana').html(options);
                
                if ($('#Pelaksana').hasClass('select2-hidden-accessible')) {
                    $('#Pelaksana').select2('destroy');
                }
                $('#Pelaksana').select2({
                    placeholder: 'Pilih Pelaksana...',
                    dropdownParent: $('#modalLevel3'),
                    width: '100%'
                });
                
                if (selectedPelaksanaId) {
                    $('#Pelaksana').val(selectedPelaksanaId).trigger('change');
                }
            },
            error: function() {
                $('#Pelaksana').html('<option value="">Gagal memuat data</option>');
            }
        });
    }

    // ==================== SAAT DINAS BERUBAH ====================
    $('#DinasFilter').on('change', function() {
        let dinasId = $(this).val();
        loadPelaksanaByDinas(dinasId, '');
    });

    // ==================== LOAD PERANGKAT DAERAH ====================
    function loadPerangkatDaerah(callback) {
        $.ajax({
            url: BaseURL + "Instansi/Immediate_outcome_pd_get_perangkat_daerah",
            type: "GET",
            dataType: "json",
            success: function(res) {
                if (res && res.status === 'success') {
                    daftarPerangkat = res.data;
                }
                if (callback) callback();
            },
            error: function() {
                if (callback) callback();
            }
        });
    }
    
    loadPerangkatDaerah();

    // ==================== FUNGSI TAMBAH BARIS ====================
    function addField(container, val = '', placeholder = '') {
        let escapedVal = val.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        $(container).append(`
            <div class="field-row" style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                <input type="text" class="form-control" value="${escapedVal}" placeholder="${placeholder}" style="flex: 1;">
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
            </div>
        `);
    }

    function addCrosscutting(pd_id = '', keterangan = '') {
        let options = '<option value="">-- Pilih Perangkat Daerah --</option>';
        
        if (daftarPerangkat && daftarPerangkat.length > 0) {
            $.each(daftarPerangkat, function(index, item) {
                let selected = (String(item.id) === String(pd_id)) ? 'selected' : '';
                options += `<option value="${item.id}" ${selected}>${escapeHtml(item.nama)}</option>`;
            });
        } else {
            options += '<option value="" disabled>Data perangkat daerah tidak tersedia</option>';
        }
        
        let escapedKet = keterangan.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        
        $("#crosscutting-body").append(`
            <tr>
                <td>
                    <select class="form-control form-control-sm pd-select" style="width: 100%;">
                        ${options}
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm" value="${escapedKet}" placeholder="Keterangan crosscutting" style="width: 100%;">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        `);
        
        $('.pd-select').select2({
            placeholder: 'Pilih Perangkat Daerah',
            dropdownParent: $('#modalLevel3'),
            width: '100%'
        });
    }

    $(document).on("click", ".remove-row", function(e) {
        e.preventDefault();
        $(this).closest(".field-row, tr").remove();
    });

    // ==================== TOMBOL TAMBAH ====================
    $("#btn-tambah-indikator").off('click').on('click', function(e) {
        e.preventDefault();
        addField("#indikator-container", '', 'Indikator Kinerja');
    });
    
    $("#btn-tambah-inovasi").off('click').on('click', function(e) {
        e.preventDefault();
        addField("#inovasi-container", '', 'Inovasi Daerah');
    });
    
    $("#btn-tambah-outcome").off('click').on('click', function(e) {
        e.preventDefault();
        addField("#outcome-container", '', 'Outcome Inovasi');
    });
    
    $("#btn-tambah-output").off('click').on('click', function(e) {
        e.preventDefault();
        addField("#output-container", '', 'Output Inovasi');
    });
    
    $("#btn-tambah-crosscutting").off('click').on('click', function(e) {
        e.preventDefault();
        addCrosscutting();
    });

    // ==================== RESET FORM ====================
    function resetForm() {
        $('#id_level3').val('');
        $('#IntermediateId').val('').trigger('change');
        $('#kinerja').val('');
        $('#DinasFilter').val('').trigger('change');
        $('#PelaksanaGroup').hide();
        $('#indikator-container').empty();
        $('#inovasi-container').empty();
        $('#outcome-container').empty();
        $('#output-container').empty();
        $('#crosscutting-body').empty();
        addField("#indikator-container", '', 'Indikator Kinerja');
    }

    // ==================== EVENT TAMBAH DATA ====================
    $('#btn-tambah, #btn-tambah-empty').off('click').on('click', function(e) {
        e.preventDefault();
        resetForm();
        loadDinasOptions('');
        $('#modalLevel3').modal('show');
    });

    // ==================== EDIT DATA ====================
    $(document).off('click', '.btn-edit').on('click', '.btn-edit', function(e) {
        e.preventDefault();
        
        let id = $(this).data('id');
        
        resetForm();
        
        $('#modalLevel3').modal('show');
        $('.modal-content').css('position', 'relative');
        $('#modalLevel3 .modal-content').append('<div class="modal-loading"><i class="fa fa-spinner fa-spin fa-3x text-primary"></i><br><span>Memuat data...</span></div>');
        
        $.ajax({
            url: BaseURL + 'Instansi/Immediate_outcome_pd_get',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(res) {
                $('.modal-loading').remove();
                
                if (res.status === 'error') {
                    alert(res.message);
                    $('#modalLevel3').modal('hide');
                    return;
                }
                
                let data = res.data;
                
                $('#id_level3').val(data.id);
                $('#IntermediateId').val(data.intermediate_outcome_id || '').trigger('change');
                $('#kinerja').val(data.kinerja || '');
                
                $('#indikator-container').empty();
                $('#inovasi-container').empty();
                $('#outcome-container').empty();
                $('#output-container').empty();
                $('#crosscutting-body').empty();
                
                loadDinasOptions('');
                
                if (data.pelaksana) {
                    $.ajax({
                        url: BaseURL + 'Instansi/Immediate_outcome_pd_get_pelaksana_detail',
                        type: 'POST',
                        data: { id: data.pelaksana },
                        dataType: 'json',
                        success: function(detail) {
                            if (detail && detail.dinas_id) {
                                let dinasIds = detail.dinas_id.split(',');
                                if (dinasIds.length > 0 && dinasIds[0]) {
                                    $('#DinasFilter').val(dinasIds[0]).trigger('change');
                                    setTimeout(function() {
                                        loadPelaksanaByDinas(dinasIds[0], data.pelaksana);
                                    }, 500);
                                }
                            }
                        }
                    });
                }
                
                // Indikator
                if (data.indikator && typeof data.indikator === 'string') {
                    let items = data.indikator.split('|||');
                    $.each(items, function(i, v) {
                        if (v && v.trim()) addField("#indikator-container", v.trim(), 'Indikator Kinerja');
                    });
                }
                if ($('#indikator-container .field-row').length === 0) addField("#indikator-container", '', 'Indikator Kinerja');
                
                // Inovasi Daerah
                if (data.inovasi_daerah && typeof data.inovasi_daerah === 'string') {
                    let items = data.inovasi_daerah.split('|||');
                    $.each(items, function(i, v) {
                        if (v && v.trim()) addField("#inovasi-container", v.trim(), 'Inovasi Daerah');
                    });
                }
                
                // Outcome Inovasi
                if (data.outcome_inovasi && typeof data.outcome_inovasi === 'string') {
                    let items = data.outcome_inovasi.split('|||');
                    $.each(items, function(i, v) {
                        if (v && v.trim()) addField("#outcome-container", v.trim(), 'Outcome Inovasi');
                    });
                }
                
                // Output Inovasi
                if (data.output_inovasi && typeof data.output_inovasi === 'string') {
                    let items = data.output_inovasi.split('|||');
                    $.each(items, function(i, v) {
                        if (v && v.trim()) addField("#output-container", v.trim(), 'Output Inovasi');
                    });
                }
                
                // Crosscutting
                if (data.crosscutting_pd && data.crosscutting_keterangan) {
                    try {
                        let pd_list = (typeof data.crosscutting_pd === 'string') ? JSON.parse(data.crosscutting_pd) : data.crosscutting_pd;
                        let ket_list = (typeof data.crosscutting_keterangan === 'string') ? JSON.parse(data.crosscutting_keterangan) : data.crosscutting_keterangan;
                        
                        if (pd_list && ket_list && Array.isArray(pd_list)) {
                            for (let i = 0; i < pd_list.length; i++) {
                                addCrosscutting(pd_list[i], ket_list[i] || '');
                            }
                        }
                    } catch(e) {
                        console.error('Error parsing crosscutting:', e);
                    }
                }
            },
            error: function(xhr, status, error) {
                $('.modal-loading').remove();
                alert('Error loading data: ' + error);
                $('#modalLevel3').modal('hide');
            }
        });
    });

    // ==================== SIMPAN DATA ====================
    $('#btn-simpan-level3').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        let id = $('#id_level3').val();
        let intermediate_id = $('#IntermediateId').val();
        let kinerja = $('#kinerja').val().trim();
        let pelaksana_id = $('#Pelaksana').val();
        
        if (!kinerja) {
            alert('Kinerja wajib diisi!');
            $('#kinerja').focus();
            return;
        }
        
        let $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        let indikator = [], inovasi = [], outcome = [], output = [];
        
        $('#indikator-container input').each(function() { 
            let v = $(this).val().trim(); 
            if(v) indikator.push(v); 
        });
        
        $('#inovasi-container input').each(function() { 
            let v = $(this).val().trim(); 
            if(v) inovasi.push(v); 
        });
        
        $('#outcome-container input').each(function() { 
            let v = $(this).val().trim(); 
            if(v) outcome.push(v); 
        });
        
        $('#output-container input').each(function() { 
            let v = $(this).val().trim(); 
            if(v) output.push(v); 
        });
        
        let cross_pd = [], cross_ket = [];
        $('#crosscutting-body tr').each(function() {
            let pd = $(this).find('.pd-select').val();
            let ket = $(this).find('td:eq(1) input').val().trim();
            if (pd && ket) {
                cross_pd.push(pd);
                cross_ket.push(ket);
            }
        });
        
        $.ajax({
            url: BaseURL + 'Instansi/Immediate_outcome_pd_simpan',
            type: 'POST',
            data: {
                id: id,
                intermediate_id: intermediate_id,
                kinerja: kinerja,
                pelaksana: pelaksana_id,
                indikator: indikator,
                inovasi_daerah: inovasi,
                outcome_inovasi: outcome,
                output_inovasi: output,
                crosscutting_pd: cross_pd,
                crosscutting_ket: cross_ket
            },
            dataType: 'json',
            success: function(res) {
                $btn.prop('disabled', false).html('Simpan Perubahan');
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan');
                }
            },
            error: function(xhr, status, error) {
                $btn.prop('disabled', false).html('Simpan Perubahan');
                alert('Error: ' + error);
            }
        });
    });

    // ==================== HAPUS DATA ====================
    $(document).off('click', '.btn-hapus').on('click', '.btn-hapus', function(e) {
        e.preventDefault();
        if (!confirm('Yakin menghapus data ini?')) return;
        
        let id = $(this).data('id');
        
        $.ajax({
            url: BaseURL + 'Instansi/Immediate_outcome_pd_hapus',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menghapus');
                }
            },
            error: function() {
                alert('Gagal menghapus data');
            }
        });
    });

    // Helper function escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    <?php } ?>
});
</script>

</body>
</html>