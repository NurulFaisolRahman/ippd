<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
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
.modal {
        padding-top: 70px;
    }
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            
            <!-- HEADER NAVIGASI -->
            <div style="background: white; padding: 12px 20px; margin-bottom: 25px; border: 1px solid #dee2e6; border-radius: 5px;">
                <div style="display: flex; gap: 25px; flex-wrap: wrap;">
                    <a href="<?=base_url('Instansi/Ultimate_outcome_pd')?>" class="nav-link active">ULTIMATE OUTCOME PD (Level 1)</a>
                    <a href="<?=base_url('Instansi/Intermediate_outcome_pd')?>" class="nav-link">INTERMEDIATE OUTCOME PD (Level 2)</a>
                    <a href="<?=base_url('Instansi/Immediate_outcome_pd')?>" class="nav-link">IMMEDIATE OUTCOME PD (Level 3)</a>
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
                                <button class="btn btn-success" data-toggle="modal" data-target="#modalLevel1" id="btn-tambah">
                                    <i class="fa fa-plus"></i> Tambah ULTIMATE OUTCOME PD (Level 1)
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
                                        <th>Kinerja</th>
                                        <th>Indikator Kinerja</th>
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
                                                <td class="align-middle kinerja-cell">
                                                    <strong><?= nl2br(html_escape($row['kinerja'] ?? '—')) ?></strong>
                                                </td>
                                                <td class="align-middle indikator-cell">
                                                    <?php 
                                                    // Parse indikator yang disimpan dalam format: kategori1|||sumber_id1|||kategori2|||sumber_id2
                                                    if (!empty($row['indikator'])) {
                                                        $indikator_parts = explode('|||', $row['indikator']);
                                                        $display_indikator = [];
                                                        
                                                        for ($i = 0; $i < count($indikator_parts); $i += 2) {
                                                            if (isset($indikator_parts[$i + 1])) {
                                                                $kategori = $indikator_parts[$i];
                                                                $sumber_id = $indikator_parts[$i + 1];
                                                                
                                                                // Cari teks sumber dari data yang ada
                                                                $sumber_text = '';
                                                                if ($kategori == 'sektor') {
                                                                    foreach ($intermediate_sektor as $s) {
                                                                        if ($s['id'] == $sumber_id) {
                                                                            $sumber_text = $s['kinerja'];
                                                                            break;
                                                                        }
                                                                    }
                                                                } elseif ($kategori == 'taktikal') {
                                                                    foreach ($intermediate_taktikal as $t) {
                                                                        if ($t['id'] == $sumber_id) {
                                                                            $sumber_text = $t['kinerja'];
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                
                                                                if ($sumber_text) {
                                                                    $display_indikator[] = '• ' . html_escape($sumber_text);
                                                                }
                                                            }
                                                        }
                                                        
                                                        if (!empty($display_indikator)) {
                                                            echo implode('<br>', $display_indikator);
                                                        } else {
                                                            echo '—';
                                                        }
                                                    } else {
                                                        echo '—';
                                                    }
                                                    ?>
                                                </td>
                                                <?php if ($IsRole4): ?>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group-aksi">
                                                            <button class="btn btn-sm btn-warning btn-edit-level1"
                                                                    data-id="<?= $row['id'] ?>"
                                                                    data-kinerja="<?= htmlspecialchars($row['kinerja'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                                                    data-indikator="<?= htmlspecialchars($row['indikator'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger btn-hapus-level1" data-id="<?= $row['id'] ?>">
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
                                                <i class="bi bi-folder-x fa-3x mb-3 d-block opacity-50"></i>
                                                Belum ada data Ultimate Outcome Perangkat Daerah<br>
                                                <?php if ($IsRole4): ?>
                                                    <button class="btn btn-success mt-3" data-toggle="modal" data-target="#modalLevel1">
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

<!-- MODAL ULTIMATE OUTCOME (LEVEL 1) - HANYA UNTUK ROLE 4 -->
<?php if ($IsRole4) { ?>
<div class="modal fade" id="modalLevel1" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
        <div class="modal-content">

            <div class="modal-header bg-light">
                <h3 class="modal-title">
                    Ultimate Outcome / Level 1
                </h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="id_level1">
                <input type="hidden" id="edit_mode" value="0">

                <!-- Info Instansi -->
                <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                    <div class="alert alert-info mb-3">
                        <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                    </div>
                <?php } ?>

                <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
                    
                    <!-- KINERJA - TEXTFIELD UTAMA -->
                    <div class="form-group">
                        <label><b>Kinerja</b> <span class="text-danger">*</span></label>
                        <div class="mb-2 text-muted small">
                            <em>Ultimate Outcome Level 1 - Kinerja Strategis</em>
                        </div>
                        <textarea id="kinerja" class="form-control" rows="4" placeholder="Masukkan kinerja strategis..."></textarea>
                    </div>

                    <!-- DATA SUMBER (INDIKATOR) -->
                    <div class="form-group">
                        <label><b>Data Sumber (Indikator Kinerja)</b> <span class="text-danger">*</span></label>
                        <div class="mb-2 text-muted small">
                            <em>Pilih data dari Intermediate Outcome Sektor yang akan menjadi indikator kinerja</em>
                        </div>
                        <div id="sumber-container"></div>
                        <button type="button" class="btn btn-success btn-sm mt-2" id="btn-tambah-sumber">
                            <i class="fa fa-plus"></i> Tambah Data Sumber
                        </button>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-simpan-level1">
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

// Data dari server untuk dropdown
var sektorData = <?= json_encode($intermediate_sektor) ?>;
var taktikalData = <?= json_encode($intermediate_taktikal) ?>;
var sumberCounter = 0;
var isEditMode = false;
var editDataId = null;

$(document).ready(function() {
    
    // Setup AJAX CSRF
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (settings.type.toUpperCase() === 'POST') {
                settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
            }
        }
    });

    // Inisialisasi DataTable
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
        $btn.prop('disabled', true).html('Memuat...');

        $.ajax({
            url: BaseURL + "Instansi/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kodeWilayah },
            success: function(res) {
                if (res === '1') {
                    var url = BaseURL + "Instansi/Ultimate_outcome_pd";
                    if (instansiId && instansiId != '') {
                        url += "?instansi_id=" + instansiId;
                    }
                    window.location.href = url;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $btn.prop('disabled', false).html('Filter');
                }
            },
            error: function() {
                alert("Gagal menghubungi server!");
                $btn.prop('disabled', false).html('Filter');
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
            var url = BaseURL + "Instansi/Ultimate_outcome_pd";
            if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
            window.location.href = url;
        });
        $("#ResetFilterBtn").click(function() { 
            window.location.href = BaseURL + "Instansi/Ultimate_outcome_pd"; 
        });
    <?php } ?>

    <?php if ($IsRole4) { ?>
    // ================= FUNGSI TAMBAH BARIS DATA SUMBER =================
    function addSumberRow(kategori = '', sumberId = '') {
        sumberCounter++;
        let rowId = 'sumber_row_' + sumberCounter;
        
        let kategoriOptions = `
            <option value="">-- Pilih Kategori --</option>
            <option value="sektor" ${kategori === 'sektor' ? 'selected' : ''}>Intermediate Outcome Sektor</option>
        `;
        
        let sumberOptions = '<option value="">-- Pilih Kategori Terlebih Dahulu --</option>';
        
        // Jika kategori sudah dipilih, load data sumber
        if (kategori) {
            sumberOptions = getSumberOptions(kategori, sumberId);
        }
        
        let html = `
            <div class="sumber-row" id="${rowId}" style="margin-bottom: 15px; padding: 10px; background: #fff; border-radius: 5px; border: 1px solid #ddd;">
                <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: end;">
                    <div>
                        <label style="margin-bottom: 5px; font-weight: bold; display: block;">Kategori Data Sumber <span style="color: red;">*</span></label>
                        <select class="form-control kategori-select" data-rowid="${rowId}" required style="width: 100%;">
                            ${kategoriOptions}
                        </select>
                    </div>
                    <div>
                        <label style="margin-bottom: 5px; font-weight: bold; display: block;">Data Sumber (Indikator) <span style="color: red;">*</span></label>
                        <select class="form-control sumber-select" id="sumber_${rowId}" data-rowid="${rowId}" required ${!kategori ? 'disabled' : ''} style="width: 100%;">
                            ${sumberOptions}
                        </select>
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger btn-sm btn-remove-sumber" data-rowid="${rowId}" style="width: 100%; white-space: nowrap;">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        $('#sumber-container').append(html);
        
        // Bind event untuk kategori select
        $('.kategori-select[data-rowid="' + rowId + '"]').on('change', function() {
            let selectedKategori = $(this).val();
            let $sumberSelect = $(`#sumber_${rowId}`);
            
            if (!selectedKategori) {
                $sumberSelect.prop('disabled', true);
                $sumberSelect.html('<option value="">-- Pilih Kategori Terlebih Dahulu --</option>');
                return;
            }
            
            $sumberSelect.prop('disabled', false);
            $sumberSelect.html(getSumberOptions(selectedKategori));
        });
    }
    
    // Fungsi untuk mendapatkan options sumber berdasarkan kategori
    function getSumberOptions(kategori, selectedId = null) {
        let options = '<option value="">-- Pilih Data Sumber --</option>';
        
        if (kategori === 'sektor') {
            if (sektorData && sektorData.length > 0) {
                $.each(sektorData, function(index, item) {
                    let selected = (selectedId == item.id) ? 'selected' : '';
                    let text = item.kinerja.length > 100 ? item.kinerja.substring(0, 100) + '...' : item.kinerja;
                    options += `<option value="${item.id}" ${selected}>${escapeHtml(text)}</option>`;
                });
            } else {
                options += '<option value="" disabled>-- Tidak ada data sektor --</option>';
            }
        }
        
        return options;
    }
    
    // Hapus baris sumber
    $(document).on('click', '.btn-remove-sumber', function() {
        let rowId = $(this).data('rowid');
        $(`#${rowId}`).remove();
    });
    
    // Helper function untuk escape HTML
    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // ================= BUTTON TAMBAH DATA SUMBER =================
    $("#btn-tambah-sumber").click(function() {
        addSumberRow();
    });

    // ================= RESET FORM UNTUK TAMBAH DATA =================
    function resetForm() {
        $('#id_level1').val('');
        $('#kinerja').val('');
        $('#sumber-container').empty();
        isEditMode = false;
        editDataId = null;
        // Tambah 1 baris default untuk tambah baru
        addSumberRow();
    }

    // ================= EVENT UNTUK TAMBAH DATA =================
    $('#btn-tambah').on('click', function() {
        resetForm();
    });

    // ================= EDIT DATA =================
    $(document).on('click', '.btn-edit-level1', function(e) {
        e.preventDefault();
        
        let id = $(this).data('id');
        let kinerja = $(this).data('kinerja') || '';
        let indikator = $(this).data('indikator') || '';
        
        // Reset form terlebih dahulu
        $('#id_level1').val('');
        $('#kinerja').val('');
        $('#sumber-container').empty();
        
        // Set nilai ke form
        $('#id_level1').val(id);
        $('#kinerja').val(kinerja);
        isEditMode = true;
        editDataId = id;
        
        // Proses indikator untuk edit
        if (indikator && indikator.trim() !== '' && indikator !== 'null') {
            let indikatorArray = indikator.split('|||');
            
            for (let i = 0; i < indikatorArray.length; i += 2) {
                if (i + 1 < indikatorArray.length) {
                    let kategori = indikatorArray[i];
                    let sumberId = indikatorArray[i + 1];
                    addSumberRow(kategori, sumberId);
                }
            }
        }
        
        // Jika tidak ada data, tambah 1 baris kosong
        if ($('#sumber-container .sumber-row').length === 0) {
            addSumberRow();
        }

        // Tampilkan modal
        $('#modalLevel1').modal('show');
    });

    // ================= SIMPAN DATA =================
    $('#btn-simpan-level1').click(function() {
        let id = $('#id_level1').val();
        let kinerja = $('#kinerja').val().trim();

        if (!kinerja) {
            alert('Kinerja wajib diisi!');
            $('#kinerja').focus();
            return;
        }
        
        // Kumpulkan data sumber
        let indikatorList = [];
        let isValid = true;
        
        $('.sumber-row').each(function() {
            let $row = $(this);
            let kategori = $row.find('.kategori-select').val();
            let sumberId = $row.find('.sumber-select').val();
            
            if (!kategori) {
                alert('Kategori data sumber wajib dipilih!');
                isValid = false;
                return false;
            }
            
            if (!sumberId) {
                alert('Data sumber wajib dipilih!');
                isValid = false;
                return false;
            }
            
            indikatorList.push(kategori);
            indikatorList.push(sumberId);
        });
        
        if (!isValid) return;
        
        if (indikatorList.length === 0) {
            alert('Minimal satu data sumber harus ditambahkan!');
            return;
        }
        
        let indikator = indikatorList.join('|||');
        
        $.ajax({
            url: BaseURL + 'Instansi/Ultimate_outcome_pd_simpan',
            type: 'POST',
            data: {
                id: id,
                kinerja: kinerja,
                indikator: indikator
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan');
                }
            },
            error: function(jqXHR) {
                alert('Koneksi bermasalah: ' + jqXHR.status);
            }
        });
    });

    // ================= HAPUS DATA =================
    $(document).on('click', '.btn-hapus-level1', function() {
        if (!confirm('Yakin menghapus data ini?')) return;
        
        let id = $(this).data('id');
        
        $.ajax({
            url: BaseURL + 'Instansi/Ultimate_outcome_pd_hapus',
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
            error: function(jqXHR) {
                alert('Koneksi bermasalah: ' + jqXHR.status);
            }
        });
    });
    <?php } ?>
});
</script>

</body>
</html>