<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>
<?php 
// Hanya pengguna yang login sebagai Daerah (Level 3) yang dapat melakukan aksi CRUD
$isDaerah = isset($IsDaerah) ? $IsDaerah : (isset($_SESSION['Level']) && $_SESSION['Level'] == 3); 
?>

<!-- Dependencies: Font Awesome & Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .cascading-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .cascading-card-header {
        background: #ffffff;
        padding: 20px 24px;
        border-bottom: 1.5px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }
    .cascading-title h3 {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
        letter-spacing: -0.3px;
    }
    .cascading-title p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Tabel Cascading Permasalahan */
    .table-cascading {
        width: 100%;
        border-collapse: separate !important;
        border-spacing: 0;
        font-size: 13px;
        margin-bottom: 0;
    }
    .table-cascading thead th {
        background: #0f172a !important;
        color: #ffffff !important;
        text-align: center;
        vertical-align: middle !important;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 12.5px;
        padding: 14px 12px !important;
        border: 1px solid #334155 !important;
    }
    .table-cascading tbody td {
        vertical-align: top !important;
        padding: 14px 14px !important;
        border: 1px solid #e2e8f0 !important;
        line-height: 1.6;
        color: #1e293b;
    }
    .table-cascading tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Badges & Tags */
    .badge-masalah {
        background: #fee2e2;
        color: #991b1b;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 6px;
        border: 1px solid #fecaca;
        text-transform: uppercase;
    }
    .badge-isu {
        background: #fef3c7;
        color: #92400e;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 6px;
        border: 1px solid #fde68a;
        text-transform: uppercase;
    }
    .badge-prioritas {
        background: #e0f2fe;
        color: #0369a1;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 6px;
        border: 1px solid #bae6fd;
        text-transform: uppercase;
    }

    /* Buttons */
    .btn-action-custom {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        font-size: 11.5px;
        font-weight: 700;
        border-radius: 5px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-edit-act {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .btn-edit-act:hover {
        background: #fde68a;
        color: #78350f;
    }
    .btn-del-act {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .btn-del-act:hover {
        background: #fecaca;
        color: #7f1d1d;
    }

    /* Filter Bar */
    .filter-wrapper {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 20px;
    }

    /* Modal Styling */
    .form-group-custom {
        margin-bottom: 18px;
    }
    .form-group-custom label {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
        display: block;
    }
    .form-group-custom .field-hint {
        font-size: 11.5px;
        color: #64748b;
        margin-top: 4px;
        display: block;
    }

    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single {
        height: 40px !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding-top: 5px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px !important;
        font-size: 13px !important;
        color: #1e293b !important;
    }
</style>

<div class="main-content" style="padding: 20px 24px; min-height: 100vh; background: #f8fafc;">
    <div class="container-fluid" style="padding: 0;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- Filter Bar: Wilayah & Tahun RKPD -->
                <div class="filter-wrapper">
                    <form method="GET" action="<?= base_url('Daerah/CascadingPermasalahan') ?>" id="FormFilterCascading">
                        <div class="row" style="display: flex; align-items: flex-end; flex-wrap: wrap;">
                            
                            <?php if (!$isDaerah) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155;">Pilih Provinsi</label>
                                    <select class="form-control" id="FilterProvinsi" style="height: 40px; border-radius: 6px;">
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php foreach ($Provinsi as $prov) { ?>
                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                <?= html_escape($prov['Nama']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155;">Pilih Kabupaten / Kota</label>
                                    <select class="form-control" name="KodeWilayah" id="FilterKabKota" style="height: 40px; border-radius: 6px;">
                                        <option value="">-- Pilih Kabupaten / Kota --</option>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">
                            <?php } ?>

                            <!-- Filter Tahun Perencanaan RKPD -->
                            <div class="col-lg-3 col-md-3 col-sm-6" style="margin-bottom: 10px;">
                                <label style="font-weight: 700; font-size: 13px; color: #334155;">
                                    <i class="fa fa-calendar" style="color: #0284c7;"></i> Tahun Perencanaan RKPD
                                </label>
                                <select class="form-control" name="tahun" id="FilterTahun" style="height: 40px; border-radius: 6px; font-weight: 600;">
                                    <?php foreach ($ListTahun as $th) { ?>
                                        <option value="<?= html_escape($th) ?>" <?= ($SelectedTahun == $th) ? 'selected' : '' ?>>
                                            Tahun <?= html_escape($th) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6" style="margin-bottom: 10px;">
                                <button type="submit" class="btn btn-primary notika-btn-primary btn-block" style="height: 40px; font-weight: 700; border-radius: 6px;">
                                    <i class="fa fa-filter"></i> Tampilkan
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Info Banner -->
                <?php if (!empty($KodeWilayah)) { ?>
                    <div class="alert alert-info" style="border-radius: 8px; font-size: 13px; background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; margin-bottom: 20px;">
                        <i class="fa fa-info-circle"></i> 
                        <strong>Wilayah:</strong> <?= html_escape($NamaWilayah) ?> (Kode: <?= html_escape($KodeWilayah) ?>) | 
                        <strong>Tahun Perencanaan:</strong> <?= html_escape($SelectedTahun) ?> | 
                        <strong>Prioritas Daerah Tersedia:</strong> <?= count($PrioritasDaerah) ?> item dari Tema Pembangunan
                    </div>
                <?php } ?>

                <!-- Card Utama: Tabel Cascading Permasalahan -->
                <div class="cascading-card">
                    <div class="cascading-card-header">
                        <div class="cascading-title">
                            <h3>
                                <i class="fa fa-sitemap" style="color: #0284c7; margin-right: 8px;"></i> CASCADING PERMASALAHAN RKPD
                            </h3>
                            <p>Penyelarasan Permasalahan &rarr; Isu Strategis &rarr; Program Prioritas Daerah (Rancangan Awal RKPD Tahun <?= html_escape($SelectedTahun) ?>)</p>
                        </div>
                        <?php if ($isDaerah) { ?>
                            <div>
                                <button type="button" class="btn btn-primary notika-btn-primary" id="BtnBukaModalInput" style="border-radius: 6px; font-weight: 700; padding: 9px 18px;">
                                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Cascading Permasalahan
                                </button>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="table-responsive">
                        <!-- Tabel Sesuai Gambar User: Permasalahan | Isu Strategis | Program Prioritas -->
                        <table class="table table-bordered table-cascading" id="TableCascadingPermasalahan">
                            <thead>
                                <tr>
                                    <th style="width: 32%;">Permasalahan</th>
                                    <th style="width: 32%;">Isu Strategis</th>
                                    <th style="width: 26%;">Program Prioritas</th>
                                    <?php if ($isDaerah) { ?>
                                        <th style="width: 10%;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($CascadingGrouped)) { ?>
                                    <tr>
                                        <td colspan="<?= $isDaerah ? '4' : '3' ?>" class="text-center" style="padding: 40px !important; color: #64748b;">
                                            <div style="font-size: 38px; color: #cbd5e1; margin-bottom: 12px;">
                                                <i class="fa fa-folder-open"></i>
                                            </div>
                                            <div style="font-weight: 700; font-size: 15px; color: #334155; margin-bottom: 6px;">
                                                Belum Ada Data Cascading Permasalahan Tahun <?= html_escape($SelectedTahun) ?>
                                            </div>
                                            <div style="font-size: 13px; max-width: 500px; margin: 0 auto; color: #94a3b8;">
                                                Klik tombol <strong>"Tambah Cascading Permasalahan"</strong> di atas untuk menambahkan data penyelarasan permasalahan, isu strategis, dan program prioritas daerah.
                                            </div>
                                        </td>
                                    </tr>
                                <?php } else { 
                                    $noMasalah = 1;
                                    foreach ($CascadingGrouped as $masalahKey => $group) {
                                        // Hitung total baris untuk Permasalahan ini
                                        $totalMasalahRows = 0;
                                        foreach ($group['IsuList'] as $isuItem) {
                                            $totalMasalahRows += max(1, count($isuItem['Programs']));
                                        }

                                        $isFirstMasalahRow = true;

                                        foreach ($group['IsuList'] as $isuKey => $isuItem) {
                                            $totalIsuRows = max(1, count($isuItem['Programs']));
                                            $isFirstIsuRow = true;

                                            foreach ($isuItem['Programs'] as $progRow) {
                                                ?>
                                                <tr>
                                                    <!-- Kolom 1: Permasalahan (Hierarchical Rowspan) -->
                                                    <?php if ($isFirstMasalahRow) { ?>
                                                        <td rowspan="<?= $totalMasalahRows ?>">
                                                            <div style="font-weight: 600; color: #0f172a;">
                                                                <?= nl2br(html_escape($masalahKey)) ?>
                                                            </div>
                                                        </td>
                                                    <?php $isFirstMasalahRow = false; } ?>

                                                    <!-- Kolom 2: Isu Strategis (Hierarchical Rowspan) -->
                                                    <?php if ($isFirstIsuRow) { ?>
                                                        <td rowspan="<?= $totalIsuRows ?>">
                                                            <div style="font-weight: 500; color: #334155;">
                                                                <?= nl2br(html_escape($isuKey)) ?>
                                                            </div>
                                                        </td>
                                                    <?php $isFirstIsuRow = false; } ?>

                                                    <!-- Kolom 3: Program Prioritas (dari Prioritas Daerah Tema Pembangunan) -->
                                                    <td>
                                                        <div style="font-weight: 600; color: #0369a1;">
                                                            <?= nl2br(html_escape($progRow['ProgramPrioritas'])) ?>
                                                        </div>
                                                    </td>

                                                    <!-- Kolom 4: Aksi (Edit & Hapus) -->
                                                    <?php if ($isDaerah) { ?>
                                                        <td class="text-center" style="vertical-align: middle !important;">
                                                            <div style="display: flex; gap: 6px; justify-content: center;">
                                                                <button type="button" class="btn-action-custom btn-edit-act btn-edit-cascading" 
                                                                        data-id="<?= $progRow['Id'] ?>" 
                                                                        title="Edit Data">
                                                                    <i class="fa fa-pencil"></i> Edit
                                                                </button>
                                                                <button type="button" class="btn-action-custom btn-del-act btn-hapus-cascading" 
                                                                        data-id="<?= $progRow['Id'] ?>" 
                                                                        title="Hapus Data">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        $noMasalah++;
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?php if ($isDaerah) { ?>
<!-- ============================================================ -->
<!-- MODAL INPUT CASCADING PERMASALAHAN -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalInputCascading" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #0284c7; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Cascading Permasalahan RKPD
                </h4>
            </div>
            <div class="modal-body" style="padding: 25px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <div id="AlertInput" class="alert alert-warning" style="display:none; padding: 12px 16px; border-radius: 6px; font-size: 13px;"></div>

                <form id="FormInputCascading">
                    <input type="hidden" id="Input_KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">

                    <!-- Tahun Perencanaan -->
                    <div class="form-group-custom">
                        <label for="Input_Tahun">
                            Tahun Perencanaan RKPD <span class="text-danger">*</span>
                        </label>
                        <select id="Input_Tahun" class="form-control" style="height: 40px; border-radius: 6px; font-weight: 600;">
                            <?php foreach ($ListTahun as $th) { ?>
                                <option value="<?= html_escape($th) ?>" <?= ($SelectedTahun == $th) ? 'selected' : '' ?>>
                                    Tahun <?= html_escape($th) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- 1. Permasalahan (Input Manual) -->
                    <div class="form-group-custom">
                        <label for="Input_Permasalahan">
                            1. Permasalahan Pembangunan <span class="text-danger">*</span>
                        </label>
                        <textarea id="Input_Permasalahan" class="form-control" rows="3" placeholder="Tuliskan uraian permasalahan pembangunan daerah..." style="border-radius: 6px; font-size: 13px; border: 1.5px solid #cbd5e1;"></textarea>
                        <span class="field-hint">Uraian permasalahan pokok/mendasar pembangunan daerah yang dihadapi (input manual).</span>
                    </div>

                    <!-- 2. Isu Strategis (Input Manual) -->
                    <div class="form-group-custom">
                        <label for="Input_IsuStrategis">
                            2. Isu Strategis Daerah <span class="text-danger">*</span>
                        </label>
                        <textarea id="Input_IsuStrategis" class="form-control" rows="3" placeholder="Tuliskan uraian isu strategis yang berkaitan..." style="border-radius: 6px; font-size: 13px; border: 1.5px solid #cbd5e1;"></textarea>
                        <span class="field-hint">Isu strategis yang timbul atau relevan dengan permasalahan di atas (input manual).</span>
                    </div>

                    <!-- 3. Program Prioritas (Dropdown Mengambil dari Prioritas Daerah Tema Pembangunan) -->
                    <div class="form-group-custom">
                        <label for="Input_IdPrioritasDaerah">
                            3. Program Prioritas (Dari Prioritas Daerah Tema Pembangunan) <span class="text-danger">*</span>
                        </label>
                        <select id="Input_IdPrioritasDaerah" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Program Prioritas --</option>
                            <?php if (!empty($PrioritasDaerah)) { 
                                foreach ($PrioritasDaerah as $pd) { ?>
                                    <option value="<?= $pd['id'] ?>" data-prioritas="<?= html_escape($pd['prioritas']) ?>">
                                        <?= html_escape($pd['prioritas']) ?>
                                    </option>
                                <?php } 
                            } ?>
                        </select>

                        <!-- Notifikasi jika Prioritas Daerah di Tema Pembangunan belum ada -->
                        <div id="AlertPrioritasKosong" class="alert alert-warning" style="<?= !empty($PrioritasDaerah) ? 'display:none;' : '' ?> margin-top: 10px; font-size: 12.5px; padding: 10px 14px; border-radius: 6px;">
                            <i class="fa fa-exclamation-triangle"></i> 
                            Belum ada data <strong>Prioritas Daerah</strong> pada <strong>Tema Pembangunan</strong> untuk tahun ini. 
                            Silakan input terlebih dahulu pada menu <a href="<?= base_url('Daerah/TemaPembangunan') ?>" target="_blank" style="font-weight: 700; text-decoration: underline;">Tema Pembangunan</a>.
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer" style="padding: 15px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-primary notika-btn-primary" id="BtnSimpanCascading" style="border-radius: 6px; font-weight: 700; padding: 8px 22px;">
                    <i class="fa fa-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT CASCADING PERMASALAHAN -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditCascading" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #f59e0b; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Cascading Permasalahan RKPD
                </h4>
            </div>
            <div class="modal-body" style="padding: 25px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <div id="AlertEdit" class="alert alert-warning" style="display:none; padding: 12px 16px; border-radius: 6px; font-size: 13px;"></div>

                <form id="FormEditCascading">
                    <input type="hidden" id="Edit_Id">

                    <!-- Permasalahan (Input Manual) -->
                    <div class="form-group-custom">
                        <label for="Edit_Permasalahan">
                            1. Permasalahan Pembangunan <span class="text-danger">*</span>
                        </label>
                        <textarea id="Edit_Permasalahan" class="form-control" rows="3" style="border-radius: 6px; font-size: 13px; border: 1.5px solid #cbd5e1;"></textarea>
                    </div>

                    <!-- Isu Strategis (Input Manual) -->
                    <div class="form-group-custom">
                        <label for="Edit_IsuStrategis">
                            2. Isu Strategis Daerah <span class="text-danger">*</span>
                        </label>
                        <textarea id="Edit_IsuStrategis" class="form-control" rows="3" style="border-radius: 6px; font-size: 13px; border: 1.5px solid #cbd5e1;"></textarea>
                    </div>

                    <!-- Program Prioritas (Dropdown dari Prioritas Daerah Tema Pembangunan) -->
                    <div class="form-group-custom">
                        <label for="Edit_IdPrioritasDaerah">
                            3. Program Prioritas (Dari Prioritas Daerah Tema Pembangunan) <span class="text-danger">*</span>
                        </label>
                        <select id="Edit_IdPrioritasDaerah" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Program Prioritas --</option>
                            <?php if (!empty($PrioritasDaerah)) { 
                                foreach ($PrioritasDaerah as $pd) { ?>
                                    <option value="<?= $pd['id'] ?>" data-prioritas="<?= html_escape($pd['prioritas']) ?>">
                                        <?= html_escape($pd['prioritas']) ?>
                                    </option>
                                <?php } 
                            } ?>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer" style="padding: 15px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-warning" id="BtnUpdateCascading" style="border-radius: 6px; font-weight: 700; padding: 8px 22px; background: #f59e0b; border-color: #d97706; color: #fff;">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Scripts -->
<script>
var BaseURL = '<?= base_url() ?>';

$(document).ready(function() {

    // Inisialisasi Select2 di modal
    $('.select2-modal').select2({
        dropdownParent: $('body')
    });

    $('#ModalInputCascading, #ModalEditCascading').on('shown.bs.modal', function () {
        $(this).find('.select2-modal').select2({
            dropdownParent: $(this)
        });
    });

    // Saat tahun di modal input berganti, muat ulang opsi Prioritas Daerah untuk tahun tersebut
    $('#Input_Tahun').on('change', function() {
        var tahun = $(this).val();
        var kodeWilayah = $('#Input_KodeWilayah').val();
        
        $.ajax({
            url: BaseURL + 'Daerah/GetPrioritasDaerahByTahun',
            type: 'POST',
            dataType: 'json',
            data: {
                Tahun: tahun,
                KodeWilayah: kodeWilayah
            },
            success: function(list) {
                var optHtml = '<option value="">-- Pilih Program Prioritas --</option>';
                if (list && list.length > 0) {
                    $('#AlertPrioritasKosong').hide();
                    for (var i = 0; i < list.length; i++) {
                        var item = list[i];
                        optHtml += '<option value="' + item.id + '" data-prioritas="' + $('<div>').text(item.prioritas).html() + '">' +
                            $('<div>').text(item.prioritas).html() +
                        '</option>';
                    }
                } else {
                    $('#AlertPrioritasKosong').show();
                }
                $('#Input_IdPrioritasDaerah').html(optHtml).val('').trigger('change');
            }
        });
    });

    // Buka Modal Input
    $('#BtnBukaModalInput').on('click', function() {
        $('#FormInputCascading')[0].reset();
        $('#Input_Tahun').val('<?= html_escape($SelectedTahun) ?>').trigger('change');
        $('#Input_Permasalahan').val('');
        $('#Input_IsuStrategis').val('');
        $('#Input_IdPrioritasDaerah').val('').trigger('change');
        $('#AlertInput').hide();
        $('#ModalInputCascading').modal('show');
    });

    // Simpan Data Baru (AJAX)
    $('#BtnSimpanCascading').on('click', function() {
        var kodeWilayah = $('#Input_KodeWilayah').val();
        var tahun = $('#Input_Tahun').val();
        var permasalahan = $.trim($('#Input_Permasalahan').val());
        var isuStrategis = $.trim($('#Input_IsuStrategis').val());
        var idPrioritas = $('#Input_IdPrioritasDaerah').val();
        var selectedOpt = $('#Input_IdPrioritasDaerah option:selected');
        var programPrioritas = selectedOpt.data('prioritas') || selectedOpt.text();

        if (!permasalahan) {
            $('#AlertInput').html('Uraian Permasalahan pembangunan wajib diisi!').show();
            $('#Input_Permasalahan').focus();
            return;
        }
        if (!isuStrategis) {
            $('#AlertInput').html('Uraian Isu Strategis daerah wajib diisi!').show();
            $('#Input_IsuStrategis').focus();
            return;
        }
        if (!idPrioritas) {
            $('#AlertInput').html('Program Prioritas wajib dipilih!').show();
            $('#Input_IdPrioritasDaerah').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/InputCascadingPermasalahan',
            type: 'POST',
            dataType: 'json',
            data: {
                KodeWilayah: kodeWilayah,
                Tahun: tahun,
                Permasalahan: permasalahan,
                IsuStrategis: isuStrategis,
                IdPrioritasDaerah: idPrioritas,
                ProgramPrioritas: programPrioritas
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Data');
                if (res.status === 'success') {
                    $('#ModalInputCascading').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertInput').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Data');
                $('#AlertInput').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    // Buka Modal Edit
    $(document).on('click', '.btn-edit-cascading', function() {
        var id = $(this).data('id');
        $('#AlertEdit').hide();

        $.ajax({
            url: BaseURL + 'Daerah/GetCascadingPermasalahanById',
            type: 'POST',
            dataType: 'json',
            data: { Id: id },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    var d = res.data;
                    $('#Edit_Id').val(d.Id);
                    $('#Edit_Permasalahan').val(d.Permasalahan);
                    $('#Edit_IsuStrategis').val(d.IsuStrategis);
                    $('#Edit_IdPrioritasDaerah').val(d.IdPrioritasDaerah || '').trigger('change');

                    $('#ModalEditCascading').modal('show');
                } else {
                    alert('Gagal mengambil data: ' + (res.message || 'Data tidak ditemukan'));
                }
            },
            error: function(xhr, status, err) {
                alert('Terjadi kesalahan: ' + err);
            }
        });
    });

    // Simpan Perubahan (Update AJAX)
    $('#BtnUpdateCascading').on('click', function() {
        var id = $('#Edit_Id').val();
        var permasalahan = $.trim($('#Edit_Permasalahan').val());
        var isuStrategis = $.trim($('#Edit_IsuStrategis').val());
        var idPrioritas = $('#Edit_IdPrioritasDaerah').val();
        var selectedOpt = $('#Edit_IdPrioritasDaerah option:selected');
        var programPrioritas = selectedOpt.data('prioritas') || selectedOpt.text();

        if (!permasalahan) {
            $('#AlertEdit').html('Uraian Permasalahan wajib diisi!').show();
            $('#Edit_Permasalahan').focus();
            return;
        }
        if (!isuStrategis) {
            $('#AlertEdit').html('Uraian Isu Strategis wajib diisi!').show();
            $('#Edit_IsuStrategis').focus();
            return;
        }
        if (!idPrioritas) {
            $('#AlertEdit').html('Program Prioritas wajib dipilih!').show();
            $('#Edit_IdPrioritasDaerah').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditCascadingPermasalahan',
            type: 'POST',
            dataType: 'json',
            data: {
                Id: id,
                Permasalahan: permasalahan,
                IsuStrategis: isuStrategis,
                IdPrioritasDaerah: idPrioritas,
                ProgramPrioritas: programPrioritas
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                if (res.status === 'success') {
                    $('#ModalEditCascading').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertEdit').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                $('#AlertEdit').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    // Hapus Data (Soft Delete AJAX)
    $(document).on('click', '.btn-hapus-cascading', function() {
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus data Cascading Permasalahan ini?')) {
            $.ajax({
                url: BaseURL + 'Daerah/DeleteCascadingPermasalahan',
                type: 'POST',
                dataType: 'json',
                data: { Id: id },
                success: function(res) {
                    if (res.status === 'success') {
                        alert(res.message);
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus: ' + res.message);
                    }
                },
                error: function(xhr, status, err) {
                    alert('Terjadi kesalahan pada server: ' + err);
                }
            });
        }
    });

    // Filter Provinsi/KabKota untuk admin
    $('#FilterProvinsi').on('change', function() {
        var provKode = $(this).val();
        if (!provKode) {
            $('#FilterKabKota').html('<option value="">-- Pilih Kabupaten / Kota --</option>');
            return;
        }
        $.ajax({
            url: BaseURL + 'Daerah/GetKabKotaByProvinsi',
            type: 'POST',
            dataType: 'json',
            data: { KodeProvinsi: provKode },
            success: function(kabList) {
                var opt = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                if (kabList) {
                    for (var i = 0; i < kabList.length; i++) {
                        var k = kabList[i];
                        opt += '<option value="' + k.Kode + '">' + $('<div>').text(k.Nama).html() + '</option>';
                    }
                }
                $('#FilterKabKota').html(opt);
            }
        });
    });

});
</script>
