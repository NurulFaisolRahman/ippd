<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>
<?php 
// Hanya pengguna yang login sebagai Daerah (Level 3) yang dapat melakukan aksi CRUD
$isDaerah = isset($IsDaerah) ? $IsDaerah : (isset($_SESSION['Level']) && $_SESSION['Level'] == 3); 

// Helper fungsi penghitung baris (rowspan) untuk hierarki
function calcKegiatanRows($keg) {
    return max(1, count(!empty($keg['sub_list']) ? $keg['sub_list'] : []));
}

function calcProgramRows($prg) {
    $rows = 0;
    if (empty($prg['kegiatan_list'])) return 1;
    foreach ($prg['kegiatan_list'] as $keg) {
        $rows += calcKegiatanRows($keg);
    }
    return max(1, $rows);
}

function calcArahRows($arah) {
    $rows = 0;
    if (empty($arah['program_list'])) return 1;
    foreach ($arah['program_list'] as $prg) {
        $rows += calcProgramRows($prg);
    }
    return max(1, $rows);
}

function calcPrioritasRows($pd) {
    $rows = 0;
    if (empty($pd['arah_list'])) return 1;
    foreach ($pd['arah_list'] as $arah) {
        $rows += calcArahRows($arah);
    }
    return max(1, $rows);
}
?>

<!-- Dependencies: Font Awesome & Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .prog-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .prog-card-header {
        background: #ffffff;
        padding: 20px 24px;
        border-bottom: 1.5px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }
    .prog-title h3 {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
        letter-spacing: -0.3px;
    }
    .prog-title p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Tabel Program dan Kegiatan Prioritas Sesuai Gambar User */
    .table-prog-prioritas {
        width: 100%;
        border-collapse: separate !important;
        border-spacing: 0;
        font-size: 13px;
        margin-bottom: 0;
    }
    .table-prog-prioritas thead th {
        background: #d9ead3 !important;
        color: #1b4d21 !important;
        text-align: center;
        vertical-align: middle !important;
        font-weight: 700;
        font-size: 12.5px;
        padding: 13px 10px !important;
        border: 1px solid #b7d7b0 !important;
        line-height: 1.4;
    }
    .table-prog-prioritas tbody td {
        vertical-align: top !important;
        padding: 12px 12px !important;
        border: 1px solid #e2e8f0 !important;
        line-height: 1.55;
        color: #1e293b;
    }
    .table-prog-prioritas tbody tr:hover td {
        background-color: #fbfdfb;
    }
    .table-prog-prioritas tfoot th {
        background: #f1f5f9 !important;
        color: #0f172a !important;
        padding: 13px 12px !important;
        border: 1px solid #cbd5e1 !important;
        font-weight: 800;
    }

    /* Small contextual action buttons */
    .btn-xs-custom {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 4px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        text-decoration: none !important;
        margin-top: 6px;
    }
    .btn-add-level {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .btn-add-level:hover {
        background: #10b981;
        color: #ffffff;
    }
    .btn-edit-level {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .btn-edit-level:hover {
        background: #f59e0b;
        color: #ffffff;
    }
    .btn-del-level {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .btn-del-level:hover {
        background: #ef4444;
        color: #ffffff;
    }

    .level-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-top: 6px;
    }

    /* Filter Bar */
    .filter-wrapper {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 20px;
    }

    /* Modal Form Styling */
    .form-group-custom {
        margin-bottom: 16px;
    }
    .form-group-custom label {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
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
    .select2-container--default .select2-selection--multiple {
        min-height: 40px !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 4px 8px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #ecfdf5 !important;
        border: 1px solid #a7f3d0 !important;
        color: #065f46 !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        border-radius: 4px !important;
        padding: 2px 7px !important;
        margin-top: 3px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #047857 !important;
        margin-right: 5px !important;
    }
</style>

<div class="main-content" style="padding: 20px 24px; min-height: 100vh; background: #f8fafc;">
    <div class="container-fluid" style="padding: 0;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- Filter Bar: Wilayah & Tahun RKPD -->
                <div class="filter-card-custom">
                    <div class="filter-header-title">
                        <i class="fa fa-filter"></i> Filter Wilayah &amp; Tahun
                    </div>
                    <form method="GET" action="<?= base_url('Daerah/ProgramKegiatanPrioritas') ?>" id="FormFilterProgPrioritas">
                        <div class="row" style="display: flex; align-items: flex-end; flex-wrap: wrap;">
                            
                            <?php if (empty($_SESSION['KodeWilayah'])) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 600; font-size: 12px; color: #475569; margin-bottom: 6px; display: block;">Provinsi</label>
                                    <select class="form-control filter-select-custom" id="FilterProvinsi">
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                <?= html_escape($prov['Nama']) ?>
                                            </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 600; font-size: 12px; color: #475569; margin-bottom: 6px; display: block;">Kabupaten / Kota</label>
                                    <select class="form-control filter-select-custom" name="KodeWilayah" id="FilterKabKota">
                                        <option value="">-- Pilih Kabupaten / Kota --</option>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="KodeWilayah" id="FilterKabKota" value="<?= html_escape($KodeWilayah) ?>">
                            <?php } ?>

                            <!-- Filter Tahun Perencanaan RKPD -->
                            <div class="col-lg-2 col-md-2 col-sm-6" style="margin-bottom: 10px;">
                                <label style="font-weight: 600; font-size: 12px; color: #475569; margin-bottom: 6px; display: block;">
                                    <i class="fa fa-calendar" style="color: #2d6a4f;"></i> Tahun RKPD
                                </label>
                                <select class="form-control filter-select-custom" name="tahun" id="FilterTahun">
                                    <?php foreach ($ListTahun as $th) { ?>
                                        <option value="<?= html_escape($th) ?>" <?= ($SelectedTahun == $th) ? 'selected' : '' ?>>
                                            Tahun <?= html_escape($th) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6" style="margin-bottom: 10px;">
                                <button type="submit" class="btn btn-primary-custom" style="height: 38px; width: 100%; font-size: 13px;">
                                    <i class="fa fa-search"></i> Filter
                                </button>
                            </div>

                        </div>
                    </form>
                    <?php if (!empty($NamaWilayah)) { ?>
                        <div class="wilayah-terpilih-badge">
                            <i class="fa fa-map-marker"></i> Wilayah Terpilih: <strong><?= html_escape($NamaWilayah) ?></strong>
                        </div>
                    <?php } ?>
                </div>      

                <!-- Card Utama: Tabel Program dan Kegiatan Prioritas -->
                <div class="prog-card">
                    <div class="prog-card-header">
                        <div class="prog-title">
                            <h3>
                                <i class="fa fa-tasks" style="color: #15803d; margin-right: 8px;"></i> PROGRAM DAN KEGIATAN PRIORITAS RKPD
                            </h3>
                            <p>Hierarki Berjenjang: Prioritas Pembangunan &rarr; Arah Kebijakan &rarr; Program &rarr; Kegiatan &rarr; Subkegiatan Prioritas (RKPD Tahun <?= html_escape($SelectedTahun) ?>)</p>
                        </div>
                        <?php if ($isDaerah) { ?>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <button type="button" class="btn btn-success" id="BtnBukaModalPrioritas" style="border-radius: 6px; font-weight: 700; padding: 9px 16px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Tambah Prioritas Pembangunan
                                </button>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="table-responsive">
                        <!-- Tabel Sesuai Gambar User: Prioritas pembangunan | Arah kebijakan | Program | Kegiatan | Subkegiatan Prioritas | Pagu Indikatif (Rp) | OPD -->
                        <table class="table table-bordered table-prog-prioritas" id="TableProgramKegiatanPrioritas">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Prioritas pembangunan</th>
                                    <th style="width: 15%;">Arah kebijakan <?= ($IsProvinsi ? 'Provinsi' : 'Kabupaten') ?> <?= html_escape($SelectedTahun) ?></th>
                                    <th style="width: 17%;">Program</th>
                                    <th style="width: 17%;">Kegiatan</th>
                                    <th style="width: 17%;">Subkegiatan Prioritas</th>
                                    <th style="width: 10%;">Pagu Indikatif<br>(Rp)</th>
                                    <th style="width: 11%;">OPD</th>
                                    <?php if ($isDaerah) { ?>
                                        <th style="width: 8%;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($HierarkiData)) { ?>
                                    <tr>
                                        <td colspan="<?= $isDaerah ? '8' : '7' ?>" class="text-center" style="padding: 40px !important; color: #64748b;">
                                            <div style="font-size: 38px; color: #cbd5e1; margin-bottom: 12px;">
                                                <i class="fa fa-folder-open"></i>
                                            </div>
                                            <div style="font-weight: 700; font-size: 15px; color: #334155; margin-bottom: 6px;">
                                                Belum Ada Data Prioritas Pembangunan RKPD Tahun <?= html_escape($SelectedTahun) ?>
                                            </div>
                                            <div style="font-size: 13px; max-width: 520px; margin: 0 auto; color: #94a3b8;">
                                                Belum ada prioritas pembangunan yang ditambahkan pada menu ini untuk Tahun <?= html_escape($SelectedTahun) ?>.
                                            </div>
                                            <?php if ($isDaerah) { ?>
                                                <div style="margin-top: 14px;">
                                                    <button type="button" class="btn btn-success btn-sm" id="BtnBukaModalPrioritasEmpty" style="font-weight: 700; border-radius: 6px; background: #15803d; border-color: #166534; padding: 7px 16px;">
                                                        <i class="fa fa-plus-circle"></i> Tambah Prioritas Pembangunan
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } else { 
                                    foreach ($HierarkiData as $pd) {
                                        $prioritasRows = calcPrioritasRows($pd);
                                        $isFirstPrioritasRow = true;
                                        $arahList = $pd['arah_list'];

                                        // KASUS 1: Prioritas belum memiliki Arah Kebijakan
                                        if (empty($arahList)) {
                                            ?>
                                            <tr>
                                                <!-- Kolom 1: Prioritas Pembangunan -->
                                                <td>
                                                    <div style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                                        <?= nl2br(html_escape($pd['prioritas'])) ?>
                                                    </div>
                                                    <?php if ($isDaerah) { ?>
                                                        <div class="level-actions">
                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-arah-di-row" 
                                                                    data-id-prioritas="<?= $pd['id'] ?>" 
                                                                    data-nama-prioritas="<?= html_escape($pd['prioritas']) ?>"
                                                                    title="Tambah Arah Kebijakan">
                                                                <i class="fa fa-plus"></i> Arah
                                                            </button>
                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prioritas" 
                                                                    data-id="<?= $pd['id'] ?>" 
                                                                    data-id-prioritas-daerah="<?= $pd['id_prioritas_daerah'] ?>"
                                                                    title="Edit Prioritas Pembangunan">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prioritas" 
                                                                    data-id="<?= $pd['id'] ?>"
                                                                    title="Hapus Prioritas Pembangunan">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </td>

                                                <!-- Kolom 2-7: Kosong -->
                                                <td colspan="<?= $isDaerah ? '7' : '6' ?>" class="text-center" style="background: #fafafa; color: #94a3b8; font-style: italic; vertical-align: middle !important; padding: 18px !important;">
                                                    Belum ada Arah Kebijakan pada Prioritas ini.
                                                    <?php if ($isDaerah) { ?>
                                                        <button type="button" class="btn-xs-custom btn-add-level btn-tambah-arah-di-row" style="margin-left: 8px;"
                                                                data-id-prioritas="<?= $pd['id'] ?>" 
                                                                data-nama-prioritas="<?= html_escape($pd['prioritas']) ?>">
                                                            <i class="fa fa-plus"></i> Tambah Arah Kebijakan
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            continue;
                                        }

                                        // KASUS 2: Prioritas memiliki Arah Kebijakan
                                        foreach ($arahList as $arah) {
                                            $arahRows = calcArahRows($arah);
                                            $isFirstArahRow = true;
                                            $prgList = $arah['program_list'];

                                            // KASUS 2A: Arah belum memiliki Program
                                            if (empty($prgList)) {
                                                ?>
                                                <tr>
                                                    <?php if ($isFirstPrioritasRow) { ?>
                                                        <td rowspan="<?= $prioritasRows ?>">
                                                            <div style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                                                <?= nl2br(html_escape($pd['prioritas'])) ?>
                                                            </div>
                                                            <?php if ($isDaerah) { ?>
                                                                <div class="level-actions">
                                                                    <button type="button" class="btn-xs-custom btn-add-level btn-tambah-arah-di-row" 
                                                                            data-id-prioritas="<?= $pd['id'] ?>" 
                                                                            data-nama-prioritas="<?= html_escape($pd['prioritas']) ?>"
                                                                            title="Tambah Arah Kebijakan">
                                                                        <i class="fa fa-plus"></i> Arah
                                                                    </button>
                                                                    <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prioritas" 
                                                                            data-id="<?= $pd['id'] ?>" 
                                                                            data-id-prioritas-daerah="<?= $pd['id_prioritas_daerah'] ?>"
                                                                            title="Edit Prioritas Pembangunan">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
                                                                    <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prioritas" 
                                                                            data-id="<?= $pd['id'] ?>"
                                                                            title="Hapus Prioritas Pembangunan">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                    <?php $isFirstPrioritasRow = false; } ?>

                                                    <td>
                                                        <div style="font-weight: 600; color: #334155; margin-bottom: 6px;">
                                                            <?= nl2br(html_escape($arah['arah_kebijakan'])) ?>
                                                        </div>
                                                        <?php if ($isDaerah) { ?>
                                                            <div class="level-actions">
                                                                <button type="button" class="btn-xs-custom btn-add-level btn-tambah-prog-di-row" 
                                                                        data-id-arah="<?= $arah['id'] ?>" 
                                                                        data-nama-arah="<?= html_escape($arah['arah_kebijakan']) ?>">
                                                                    <i class="fa fa-plus"></i> Program
                                                                </button>
                                                                <button type="button" class="btn-xs-custom btn-edit-level btn-edit-arah" 
                                                                        data-id="<?= $arah['id'] ?>">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                                <button type="button" class="btn-xs-custom btn-del-level btn-hapus-arah" 
                                                                        data-id="<?= $arah['id'] ?>">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                    </td>

                                                    <td colspan="<?= $isDaerah ? '6' : '5' ?>" class="text-center" style="background: #fafafa; color: #94a3b8; font-style: italic; vertical-align: middle !important; padding: 18px !important;">
                                                        Belum ada Program pada Arah Kebijakan ini.
                                                        <?php if ($isDaerah) { ?>
                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-prog-di-row" style="margin-left: 8px;"
                                                                    data-id-arah="<?= $arah['id'] ?>" 
                                                                    data-nama-arah="<?= html_escape($arah['arah_kebijakan']) ?>">
                                                                <i class="fa fa-plus"></i> Tambah Program
                                                            </button>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                continue;
                                            }

                                            // KASUS 2B: Arah memiliki Program
                                            foreach ($prgList as $prg) {
                                                $prgRows = calcProgramRows($prg);
                                                $isFirstProgramRow = true;
                                                $kegList = $prg['kegiatan_list'];

                                                // KASUS 2B-1: Program belum memiliki Kegiatan
                                                if (empty($kegList)) {
                                                    ?>
                                                    <tr>
                                                        <?php if ($isFirstPrioritasRow) { ?>
                                                            <td rowspan="<?= $prioritasRows ?>">
                                                                <div style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                                                    <?= nl2br(html_escape($pd['prioritas'])) ?>
                                                                </div>
                                                                <?php if ($isDaerah) { ?>
                                                                    <div class="level-actions">
                                                                        <button type="button" class="btn-xs-custom btn-add-level btn-tambah-arah-di-row" 
                                                                                data-id-prioritas="<?= $pd['id'] ?>" 
                                                                                data-nama-prioritas="<?= html_escape($pd['prioritas']) ?>"
                                                                                title="Tambah Arah Kebijakan">
                                                                            <i class="fa fa-plus"></i> Arah
                                                                        </button>
                                                                        <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prioritas" 
                                                                                data-id="<?= $pd['id'] ?>" 
                                                                                data-id-prioritas-daerah="<?= $pd['id_prioritas_daerah'] ?>"
                                                                                title="Edit Prioritas Pembangunan">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                        <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prioritas" 
                                                                                data-id="<?= $pd['id'] ?>"
                                                                                title="Hapus Prioritas Pembangunan">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                        <?php $isFirstPrioritasRow = false; } ?>

                                                        <?php if ($isFirstArahRow) { ?>
                                                            <td rowspan="<?= $arahRows ?>">
                                                                <div style="font-weight: 600; color: #334155; margin-bottom: 6px;">
                                                                    <?= nl2br(html_escape($arah['arah_kebijakan'])) ?>
                                                                </div>
                                                                <?php if ($isDaerah) { ?>
                                                                    <div class="level-actions">
                                                                        <button type="button" class="btn-xs-custom btn-add-level btn-tambah-prog-di-row" 
                                                                                data-id-arah="<?= $arah['id'] ?>" 
                                                                                data-nama-arah="<?= html_escape($arah['arah_kebijakan']) ?>">
                                                                            <i class="fa fa-plus"></i> Program
                                                                        </button>
                                                                        <button type="button" class="btn-xs-custom btn-edit-level btn-edit-arah" 
                                                                                data-id="<?= $arah['id'] ?>">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                        <button type="button" class="btn-xs-custom btn-del-level btn-hapus-arah" 
                                                                                data-id="<?= $arah['id'] ?>">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                        <?php $isFirstArahRow = false; } ?>

                                                        <td>
                                                            <div style="font-weight: 600; color: #1e293b; margin-bottom: 6px;">
                                                                <span style="color: #15803d; font-weight: 800;">[<?= html_escape($prg['kode_program']) ?>]</span> 
                                                                <?= html_escape($prg['nama_program']) ?>
                                                            </div>
                                                            <?php if ($isDaerah) { ?>
                                                                <div class="level-actions">
                                                                    <button type="button" class="btn-xs-custom btn-add-level btn-tambah-keg-di-row" 
                                                                            data-id-program="<?= $prg['id'] ?>" 
                                                                            data-kode-program="<?= html_escape($prg['kode_program']) ?>" 
                                                                            data-nama-program="<?= html_escape($prg['nama_program']) ?>">
                                                                        <i class="fa fa-plus"></i> Kegiatan
                                                                    </button>
                                                                    <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prog" 
                                                                            data-id="<?= $prg['id'] ?>">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
                                                                    <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prog" 
                                                                            data-id="<?= $prg['id'] ?>">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </td>

                                                        <td colspan="<?= $isDaerah ? '5' : '4' ?>" class="text-center" style="background: #fafafa; color: #94a3b8; font-style: italic; vertical-align: middle !important; padding: 18px !important;">
                                                            Belum ada Kegiatan pada Program ini.
                                                            <?php if ($isDaerah) { ?>
                                                                <button type="button" class="btn-xs-custom btn-add-level btn-tambah-keg-di-row" style="margin-left: 8px;"
                                                                        data-id-program="<?= $prg['id'] ?>" 
                                                                        data-kode-program="<?= html_escape($prg['kode_program']) ?>" 
                                                                        data-nama-program="<?= html_escape($prg['nama_program']) ?>">
                                                                    <i class="fa fa-plus"></i> Tambah Kegiatan
                                                                </button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    continue;
                                                }

                                                // KASUS 2B-2: Program memiliki Kegiatan
                                                foreach ($kegList as $keg) {
                                                    $kegRows = calcKegiatanRows($keg);
                                                    $isFirstKegiatanRow = true;
                                                    $subList = $keg['sub_list'];

                                                    // KASUS 2B-2A: Kegiatan belum memiliki Subkegiatan
                                                    if (empty($subList)) {
                                                        ?>
                                                        <tr>
                                                            <?php if ($isFirstPrioritasRow) { ?>
                                                                <td rowspan="<?= $prioritasRows ?>">
                                                                    <div style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                                                        <?= nl2br(html_escape($pd['prioritas'])) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <div class="level-actions">
                                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-arah-di-row" 
                                                                                    data-id-prioritas="<?= $pd['id'] ?>" 
                                                                                    data-nama-prioritas="<?= html_escape($pd['prioritas']) ?>"
                                                                                    title="Tambah Arah Kebijakan">
                                                                                <i class="fa fa-plus"></i> Arah
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prioritas" 
                                                                                    data-id="<?= $pd['id'] ?>" 
                                                                                    data-id-prioritas-daerah="<?= $pd['id_prioritas_daerah'] ?>"
                                                                                    title="Edit Prioritas Pembangunan">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prioritas" 
                                                                                    data-id="<?= $pd['id'] ?>"
                                                                                    title="Hapus Prioritas Pembangunan">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php $isFirstPrioritasRow = false; } ?>

                                                            <?php if ($isFirstArahRow) { ?>
                                                                <td rowspan="<?= $arahRows ?>">
                                                                    <div style="font-weight: 600; color: #334155; margin-bottom: 6px;">
                                                                        <?= nl2br(html_escape($arah['arah_kebijakan'])) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <div class="level-actions">
                                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-prog-di-row" 
                                                                                    data-id-arah="<?= $arah['id'] ?>" 
                                                                                    data-nama-arah="<?= html_escape($arah['arah_kebijakan']) ?>">
                                                                                <i class="fa fa-plus"></i> Program
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-arah" 
                                                                                    data-id="<?= $arah['id'] ?>">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-arah" 
                                                                                    data-id="<?= $arah['id'] ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php $isFirstArahRow = false; } ?>

                                                            <?php if ($isFirstProgramRow) { ?>
                                                                <td rowspan="<?= $prgRows ?>">
                                                                    <div style="font-weight: 600; color: #1e293b; margin-bottom: 6px;">
                                                                        <span style="color: #15803d; font-weight: 800;">[<?= html_escape($prg['kode_program']) ?>]</span> 
                                                                        <?= html_escape($prg['nama_program']) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <div class="level-actions">
                                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-keg-di-row" 
                                                                                    data-id-program="<?= $prg['id'] ?>" 
                                                                                    data-kode-program="<?= html_escape($prg['kode_program']) ?>" 
                                                                                    data-nama-program="<?= html_escape($prg['nama_program']) ?>">
                                                                                <i class="fa fa-plus"></i> Kegiatan
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prog" 
                                                                                    data-id="<?= $prg['id'] ?>">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prog" 
                                                                                    data-id="<?= $prg['id'] ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php $isFirstProgramRow = false; } ?>

                                                            <td>
                                                                <div style="font-weight: 500; color: #334155; margin-bottom: 6px;">
                                                                    <span style="color: #0284c7; font-weight: 700;">[<?= html_escape($keg['kode_kegiatan']) ?>]</span> 
                                                                    <?= html_escape($keg['nama_kegiatan']) ?>
                                                                </div>
                                                                <?php if ($isDaerah) { ?>
                                                                    <div class="level-actions">
                                                                        <button type="button" class="btn-xs-custom btn-add-level btn-tambah-sub-di-row" 
                                                                                data-id-kegiatan="<?= $keg['id'] ?>" 
                                                                                data-kode-kegiatan="<?= html_escape($keg['kode_kegiatan']) ?>" 
                                                                                data-nama-kegiatan="<?= html_escape($keg['nama_kegiatan']) ?>">
                                                                            <i class="fa fa-plus"></i> Subkegiatan &amp; Pagu
                                                                        </button>
                                                                        <button type="button" class="btn-xs-custom btn-edit-level btn-edit-keg" 
                                                                                data-id="<?= $keg['id'] ?>">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                        <button type="button" class="btn-xs-custom btn-del-level btn-hapus-keg" 
                                                                                data-id="<?= $keg['id'] ?>">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>

                                                            <td colspan="<?= $isDaerah ? '4' : '3' ?>" class="text-center" style="background: #fafafa; color: #94a3b8; font-style: italic; vertical-align: middle !important; padding: 18px !important;">
                                                                Belum ada Subkegiatan & Pagu pada Kegiatan ini.
                                                                <?php if ($isDaerah) { ?>
                                                                    <button type="button" class="btn-xs-custom btn-add-level btn-tambah-sub-di-row" style="margin-left: 8px;"
                                                                            data-id-kegiatan="<?= $keg['id'] ?>" 
                                                                            data-kode-kegiatan="<?= html_escape($keg['kode_kegiatan']) ?>" 
                                                                            data-nama-kegiatan="<?= html_escape($keg['nama_kegiatan']) ?>">
                                                                        <i class="fa fa-plus"></i> Tambah Subkegiatan &amp; Pagu
                                                                    </button>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        continue;
                                                    }

                                                    // KASUS 2B-2B: Kegiatan memiliki Subkegiatan
                                                    foreach ($subList as $sub) {
                                                        ?>
                                                        <tr>
                                                            <!-- Kolom 1: Prioritas Pembangunan (Rowspan) -->
                                                            <?php if ($isFirstPrioritasRow) { ?>
                                                                <td rowspan="<?= $prioritasRows ?>">
                                                                    <div style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                                                        <?= nl2br(html_escape($pd['prioritas'])) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <div class="level-actions">
                                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-arah-di-row" 
                                                                                    data-id-prioritas="<?= $pd['id'] ?>" 
                                                                                    data-nama-prioritas="<?= html_escape($pd['prioritas']) ?>"
                                                                                    title="Tambah Arah Kebijakan">
                                                                                <i class="fa fa-plus"></i> Arah
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prioritas" 
                                                                                    data-id="<?= $pd['id'] ?>" 
                                                                                    data-id-prioritas-daerah="<?= $pd['id_prioritas_daerah'] ?>"
                                                                                    title="Edit Prioritas Pembangunan">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prioritas" 
                                                                                    data-id="<?= $pd['id'] ?>"
                                                                                    title="Hapus Prioritas Pembangunan">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php $isFirstPrioritasRow = false; } ?>

                                                            <!-- Kolom 2: Arah Kebijakan (Rowspan) -->
                                                            <?php if ($isFirstArahRow) { ?>
                                                                <td rowspan="<?= $arahRows ?>">
                                                                    <div style="font-weight: 600; color: #334155; margin-bottom: 6px;">
                                                                        <?= nl2br(html_escape($arah['arah_kebijakan'])) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <div class="level-actions">
                                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-prog-di-row" 
                                                                                    data-id-arah="<?= $arah['id'] ?>" 
                                                                                    data-nama-arah="<?= html_escape($arah['arah_kebijakan']) ?>">
                                                                                <i class="fa fa-plus"></i> Program
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-arah" 
                                                                                    data-id="<?= $arah['id'] ?>">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-arah" 
                                                                                    data-id="<?= $arah['id'] ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php $isFirstArahRow = false; } ?>

                                                            <!-- Kolom 3: Program (Rowspan) -->
                                                            <?php if ($isFirstProgramRow) { ?>
                                                                <td rowspan="<?= $prgRows ?>">
                                                                    <div style="font-weight: 600; color: #1e293b; margin-bottom: 6px;">
                                                                        <span style="color: #15803d; font-weight: 800;">[<?= html_escape($prg['kode_program']) ?>]</span> 
                                                                        <?= html_escape($prg['nama_program']) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <div class="level-actions">
                                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-keg-di-row" 
                                                                                    data-id-program="<?= $prg['id'] ?>" 
                                                                                    data-kode-program="<?= html_escape($prg['kode_program']) ?>" 
                                                                                    data-nama-program="<?= html_escape($prg['nama_program']) ?>">
                                                                                <i class="fa fa-plus"></i> Kegiatan
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-prog" 
                                                                                    data-id="<?= $prg['id'] ?>">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-prog" 
                                                                                    data-id="<?= $prg['id'] ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php $isFirstProgramRow = false; } ?>

                                                            <!-- Kolom 4: Kegiatan (Rowspan) -->
                                                            <?php if ($isFirstKegiatanRow) { ?>
                                                                <td rowspan="<?= $kegRows ?>">
                                                                    <div style="font-weight: 500; color: #334155; margin-bottom: 6px;">
                                                                        <span style="color: #0284c7; font-weight: 700;">[<?= html_escape($keg['kode_kegiatan']) ?>]</span> 
                                                                        <?= html_escape($keg['nama_kegiatan']) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <div class="level-actions">
                                                                            <button type="button" class="btn-xs-custom btn-add-level btn-tambah-sub-di-row" 
                                                                                    data-id-kegiatan="<?= $keg['id'] ?>" 
                                                                                    data-kode-kegiatan="<?= html_escape($keg['kode_kegiatan']) ?>" 
                                                                                    data-nama-kegiatan="<?= html_escape($keg['nama_kegiatan']) ?>">
                                                                                <i class="fa fa-plus"></i> Subkegiatan &amp; Pagu
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-edit-level btn-edit-keg" 
                                                                                    data-id="<?= $keg['id'] ?>">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-xs-custom btn-del-level btn-hapus-keg" 
                                                                                    data-id="<?= $keg['id'] ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php $isFirstKegiatanRow = false; } ?>

                                                            <!-- Kolom 5: Subkegiatan Prioritas -->
                                                            <td>
                                                                <div style="font-weight: 500; color: #334155;">
                                                                    <span style="color: #d97706; font-weight: 700;">[<?= html_escape($sub['kode_subkegiatan']) ?>]</span> 
                                                                    <?= html_escape($sub['nama_subkegiatan']) ?>
                                                                </div>
                                                            </td>

                                                            <!-- Kolom 6: Pagu Indikatif (Rp) -->
                                                            <td class="text-right" style="white-space: nowrap; font-weight: 700; color: #0f172a; text-align: right;">
                                                                Rp <?= number_format((float)$sub['pagu'], 0, ',', '.') ?>
                                                            </td>

                                                            <!-- Kolom 7: OPD -->
                                                            <td>
                                                                <div style="font-weight: 500; color: #334155;">
                                                                    <?php 
                                                                    if (!empty($sub['nama_instansi'])) {
                                                                        $opdArr = array_filter(array_map('trim', explode(',', $sub['nama_instansi'])));
                                                                        if (count($opdArr) > 1) {
                                                                            echo '<ul style="margin: 0; padding-left: 16px; list-style-type: disc;">';
                                                                            foreach ($opdArr as $opdName) {
                                                                                echo '<li style="margin-bottom: 3px;">' . html_escape($opdName) . '</li>';
                                                                            }
                                                                            echo '</ul>';
                                                                        } else {
                                                                            echo html_escape($sub['nama_instansi']);
                                                                        }
                                                                    } else {
                                                                        echo '<span style="color: #94a3b8;">-</span>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>

                                                            <!-- Kolom 8: Aksi Subkegiatan -->
                                                            <?php if ($isDaerah) { ?>
                                                                <td class="text-center" style="vertical-align: middle !important;">
                                                                    <div style="display: flex; gap: 4px; justify-content: center;">
                                                                        <button type="button" class="btn-xs-custom btn-edit-level btn-edit-sub" 
                                                                                data-id="<?= $sub['id'] ?>" 
                                                                                title="Edit Subkegiatan & Pagu">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                        <button type="button" class="btn-xs-custom btn-del-level btn-hapus-sub" 
                                                                                data-id="<?= $sub['id'] ?>" 
                                                                                title="Hapus Subkegiatan">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } ?>
                            </tbody>
                            <?php if (!empty($HierarkiData)) { ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align: right; font-size: 13px;">
                                            TOTAL PAGU INDIKATIF (RP):
                                        </th>
                                        <th style="text-align: right; font-size: 13px; color: #15803d; white-space: nowrap;">
                                            Rp <?= number_format($TotalPaguAll, 0, ',', '.') ?>
                                        </th>
                                        <th colspan="<?= $isDaerah ? '2' : '1' ?>"></th>
                                    </tr>
                                </tfoot>
                            <?php } ?>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?php if ($isDaerah) { ?>
<!-- ============================================================ -->
<!-- MODAL 0: TAMBAH & EDIT PRIORITAS PEMBANGUNAN RKPD -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalPrioritasRKPD" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" id="ModalTitlePrioritasRKPD" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Prioritas Pembangunan
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px;">
                <div id="AlertPrioritasRKPD" class="alert alert-warning" style="display:none; padding: 10px 14px; font-size: 12.5px;"></div>
                <form id="FormPrioritasRKPD">
                    <input type="hidden" id="PrioritasRKPD_IdEdit" value="">
                    <input type="hidden" id="PrioritasRKPD_Tahun" value="<?= html_escape($SelectedTahun) ?>">
                    <input type="hidden" id="PrioritasRKPD_KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">

                    <div class="form-group-custom">
                        <label for="PrioritasRKPD_IdPrioritasDaerah">Pilih Prioritas Pembangunan Daerah <span class="text-danger">*</span></label>
                        <select id="PrioritasRKPD_IdPrioritasDaerah" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Prioritas Pembangunan Daerah --</option>
                            <?php foreach ($PrioritasDaerah as $pd) { ?>
                                <option value="<?= $pd['id'] ?>"><?= html_escape($pd['prioritas']) ?></option>
                            <?php } ?>
                        </select>
                        <span class="field-hint">
                            <i class="fa fa-info-circle" style="color: #15803d; margin-right: 3px;"></i>
                            Mengambil data dari tabel Prioritas Pembangunan Daerah pada menu Cascading Permasalahan RKPD Tahun <?= html_escape($SelectedTahun) ?>.
                        </span>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 14px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnSimpanPrioritasRKPD" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534;">
                    <i class="fa fa-save"></i> Simpan Prioritas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL 1: TAMBAH & EDIT ARAH KEBIJAKAN (1 PRIORITAS -> N ARAH) -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalTambahArah" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Arah Kebijakan
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px;">
                <div id="AlertArah" class="alert alert-warning" style="display:none; padding: 10px 14px; font-size: 12.5px;"></div>
                <form id="FormTambahArah">
                    <input type="hidden" id="Arah_PrioritasId" value="">
                    <input type="hidden" id="Arah_IdEdit" value="">

                    <div class="alert alert-info" style="font-size: 12.5px; border-radius: 6px; margin-bottom: 15px;">
                        <strong>Prioritas Pembangunan:</strong> <span id="Arah_NamaPrioritasDisplay">-</span>
                    </div>

                    <div class="form-group-custom">
                        <label for="Arah_Text">Uraian Arah Kebijakan <span class="text-danger">*</span></label>
                        <textarea id="Arah_Text" class="form-control" rows="3" placeholder="Tuliskan uraian arah kebijakan daerah..." style="border-radius: 6px; font-size: 13px; border: 1.5px solid #cbd5e1;"></textarea>
                        <span class="field-hint">1 Prioritas pembangunan dapat memiliki beberapa arah kebijakan.</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 14px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnSimpanArah" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534;">
                    <i class="fa fa-save"></i> Simpan Arah
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL 2: TAMBAH PROGRAM (1 ARAH -> N PROGRAM) -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalTambahProgram" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Program Nomenklatur
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px;">
                <div id="AlertProgram" class="alert alert-warning" style="display:none; padding: 10px 14px; font-size: 12.5px;"></div>
                <form id="FormTambahProgram">
                    <input type="hidden" id="Prog_ArahId" value="">
                    <input type="hidden" id="Prog_IdEdit" value="">

                    <div class="alert alert-info" style="font-size: 12.5px; border-radius: 6px; margin-bottom: 15px;">
                        <strong>Arah Kebijakan:</strong> <span id="Prog_NamaArahDisplay">-</span>
                    </div>

                    <div class="form-group-custom">
                        <label for="Prog_KodeProgram">Pilih Program (Nomenklatur) <span class="text-danger">*</span></label>
                        <select id="Prog_KodeProgram" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Program Nomenklatur --</option>
                            <?php foreach ($ProgramNomenklatur as $prg) { ?>
                                <option value="<?= html_escape($prg['Kode']) ?>" data-nama="<?= html_escape($prg['Nomenklatur']) ?>">
                                    [<?= html_escape($prg['Kode']) ?>] <?= html_escape($prg['Nomenklatur']) ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span class="field-hint">1 Arah kebijakan dapat memiliki beberapa program nomenklatur.</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 14px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnSimpanProgram" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534;">
                    <i class="fa fa-save"></i> Simpan Program
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL 3: TAMBAH KEGIATAN (1 PROGRAM -> N KEGIATAN) -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalTambahKegiatan" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Kegiatan Nomenklatur
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px;">
                <div id="AlertKegiatan" class="alert alert-warning" style="display:none; padding: 10px 14px; font-size: 12.5px;"></div>
                <form id="FormTambahKegiatan">
                    <input type="hidden" id="Keg_ProgramId" value="">
                    <input type="hidden" id="Keg_KodeProgramParent" value="">
                    <input type="hidden" id="Keg_IdEdit" value="">

                    <div class="alert alert-info" style="font-size: 12.5px; border-radius: 6px; margin-bottom: 15px;">
                        <strong>Program:</strong> <span id="Keg_NamaProgramDisplay">-</span>
                    </div>

                    <div class="form-group-custom">
                        <label for="Keg_KodeKegiatan">Pilih Kegiatan (Nomenklatur) <span class="text-danger">*</span></label>
                        <select id="Keg_KodeKegiatan" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Kegiatan Nomenklatur --</option>
                        </select>
                        <span class="field-hint">1 Program dapat memiliki beberapa kegiatan nomenklatur.</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 14px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnSimpanKegiatan" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534;">
                    <i class="fa fa-save"></i> Simpan Kegiatan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL 4: TAMBAH SUBKEGIATAN & PAGU & OPD (1 KEGIATAN -> N SUBKEGIATAN) -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalTambahSubKegiatan" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="margin-top: 40px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Subkegiatan Prioritas &amp; Pagu Indikatif
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px;">
                <div id="AlertSubKegiatan" class="alert alert-warning" style="display:none; padding: 10px 14px; font-size: 12.5px;"></div>
                <form id="FormTambahSubKegiatan">
                    <input type="hidden" id="Sub_KegiatanId" value="">
                    <input type="hidden" id="Sub_KodeKegiatanParent" value="">
                    <input type="hidden" id="Sub_IdEdit" value="">

                    <div class="alert alert-info" style="font-size: 12.5px; border-radius: 6px; margin-bottom: 15px;">
                        <strong>Kegiatan:</strong> <span id="Sub_NamaKegiatanDisplay">-</span>
                    </div>

                    <div class="form-group-custom">
                        <label for="Sub_KodeSubKegiatan">Pilih Subkegiatan Prioritas (Nomenklatur) <span class="text-danger">*</span></label>
                        <select id="Sub_KodeSubKegiatan" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Subkegiatan Nomenklatur --</option>
                        </select>
                        <span class="field-hint">1 Kegiatan dapat memiliki beberapa subkegiatan prioritas.</span>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group-custom">
                                <label for="Sub_Pagu">Pagu Indikatif (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon" style="background: #f1f5f9; font-weight: 700; border-color: #cbd5e1;">Rp</span>
                                    <input type="text" id="Sub_Pagu" class="form-control input-format-rupiah" placeholder="0" style="height: 40px; border-radius: 0 6px 6px 0; font-size: 13px; font-weight: 600; border: 1.5px solid #cbd5e1;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group-custom">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <label style="margin-bottom: 0; font-weight: 700; color: #1e293b;">
                                        <i class="fa fa-building" style="color: #15803d; margin-right: 4px;"></i> Perangkat Daerah (OPD)
                                    </label>
                                    <button type="button" class="btn btn-xs btn-success" id="BtnTambahRowOpd" style="font-weight: 700; border-radius: 4px; padding: 4px 10px; background: #15803d; border-color: #166534;">
                                        <i class="fa fa-plus"></i> Tambah OPD
                                    </button>
                                </div>
                                <div id="ContainerOpdList">
                                    <!-- Dynamic Rows OPD -->
                                </div>
                                <span class="field-hint">Klik <strong>+ Tambah OPD</strong> jika penanggung jawab lebih dari 1 OPD, atau klik <i class="fa fa-trash text-danger"></i> untuk menghapus.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Template Opsi OPD untuk row dinamis -->
                    <template id="TemplateOpdOptions">
                        <option value="">-- Pilih OPD Penanggung Jawab --</option>
                        <?php foreach ($ListInstansi as $ins) { ?>
                            <option value="<?= $ins['id'] ?>" data-nama="<?= html_escape($ins['nama']) ?>">
                                <?= html_escape($ins['nama']) ?>
                            </option>
                        <?php } ?>
                    </template>

                </form>
            </div>
            <div class="modal-footer" style="padding: 14px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnSimpanSubKegiatan" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534;">
                    <i class="fa fa-save"></i> Simpan Subkegiatan
                </button>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- Scripts -->
<script>
var BaseURL = '<?= base_url() ?>';

function formatRupiah(angka) {
    if (!angka) return '';
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
}

$(document).ready(function() {

    $(document).on('keyup', '.input-format-rupiah', function() {
        $(this).val(formatRupiah($(this).val()));
    });

    $('.select2-modal').select2({
        dropdownParent: $('body')
    });

    $('#ModalPrioritasRKPD, #ModalTambahArah, #ModalTambahProgram, #ModalTambahKegiatan, #ModalTambahSubKegiatan').on('shown.bs.modal', function () {
        $(this).find('.select2-modal').select2({
            dropdownParent: $(this)
        });
    });

    // ============================================================
    // 0. HANDLER PRIORITAS PEMBANGUNAN RKPD (LEVEL 0)
    // ============================================================
    function refreshPrioritasDaerahOptions(selectedId, callback) {
        var tahun = $('#PrioritasRKPD_Tahun').val();
        var kodeWilayah = $('#PrioritasRKPD_KodeWilayah').val();
        $.ajax({
            url: BaseURL + 'Daerah/GetPrioritasDaerahByTahun',
            type: 'POST',
            dataType: 'json',
            data: { Tahun: tahun, KodeWilayah: kodeWilayah },
            success: function(list) {
                var sel = $('#PrioritasRKPD_IdPrioritasDaerah');
                sel.empty();
                sel.append('<option value="">-- Pilih Prioritas Pembangunan Daerah --</option>');
                if (list && list.length > 0) {
                    list.forEach(function(item) {
                        var opt = $('<option></option>').val(item.id).text(item.prioritas);
                        sel.append(opt);
                    });
                }
                if (selectedId) {
                    sel.val(selectedId).trigger('change');
                } else {
                    sel.val('').trigger('change');
                }
                if (typeof callback === 'function') callback(list);
            }
        });
    }

    $('#BtnBukaModalPrioritas, #BtnBukaModalPrioritasEmpty').on('click', function() {
        $('#FormPrioritasRKPD')[0].reset();
        $('#PrioritasRKPD_IdEdit').val('');
        $('#AlertPrioritasRKPD').hide();
        $('#ModalTitlePrioritasRKPD').html('<i class="fa fa-plus-circle"></i> Tambah Prioritas Pembangunan');
        refreshPrioritasDaerahOptions('', function(list) {
            if (!list || list.length === 0) {
                $('#AlertPrioritasRKPD').html('<i class="fa fa-info-circle"></i> Belum ada Prioritas Pembangunan Daerah pada menu <b>Cascading Permasalahan RKPD</b> untuk Tahun ' + $('#PrioritasRKPD_Tahun').val() + '. Silakan tambahkan terlebih dahulu di menu Cascading Permasalahan.').show();
            }
        });
        $('#ModalPrioritasRKPD').modal('show');
    });

    $(document).on('click', '.btn-edit-prioritas', function() {
        var id = $(this).data('id');
        $('#AlertPrioritasRKPD').hide();
        $.ajax({
            url: BaseURL + 'Daerah/GetPrioritasPembangunanRKPDById',
            type: 'POST',
            dataType: 'json',
            data: { Id: id },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    $('#PrioritasRKPD_IdEdit').val(res.data.id);
                    refreshPrioritasDaerahOptions(res.data.id_prioritas_daerah);
                    $('#ModalTitlePrioritasRKPD').html('<i class="fa fa-pencil"></i> Edit Prioritas Pembangunan');
                    $('#ModalPrioritasRKPD').modal('show');
                } else {
                    alert('Gagal mengambil data: ' + (res.message || 'Data tidak ditemukan'));
                }
            }
        });
    });

    $('#BtnSimpanPrioritasRKPD').on('click', function() {
        var idEdit = $('#PrioritasRKPD_IdEdit').val();
        var idPrioritas = $('#PrioritasRKPD_IdPrioritasDaerah').val();
        var tahun = $('#PrioritasRKPD_Tahun').val();
        var kodeWilayah = $('#PrioritasRKPD_KodeWilayah').val();

        if (!idPrioritas) {
            $('#AlertPrioritasRKPD').html('Prioritas Pembangunan wajib dipilih!').show();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var url = idEdit ? (BaseURL + 'Daerah/EditPrioritasPembangunanRKPD') : (BaseURL + 'Daerah/InputPrioritasPembangunanRKPD');
        var postData = idEdit ? { Id: idEdit, IdPrioritasDaerah: idPrioritas } : {
            IdPrioritasDaerah: idPrioritas,
            Tahun: tahun,
            KodeWilayah: kodeWilayah
        };

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: postData,
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Prioritas');
                if (res.status === 'success') {
                    $('#ModalPrioritasRKPD').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertPrioritasRKPD').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Prioritas');
                $('#AlertPrioritasRKPD').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    $(document).on('click', '.btn-hapus-prioritas', function() {
        var id = $(this).data('id');
        if (confirm('PERINGATAN: Menghapus Prioritas Pembangunan ini akan menghapus seluruh Arah Kebijakan, Program, Kegiatan, dan Subkegiatan di bawahnya!\n\nApakah Anda yakin ingin menghapus?')) {
            $.ajax({
                url: BaseURL + 'Daerah/DeletePrioritasPembangunanRKPD',
                type: 'POST',
                dataType: 'json',
                data: { Id: id },
                success: function(res) {
                    if (res.status === 'success') {
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus: ' + res.message);
                    }
                }
            });
        }
    });

    // ============================================================
    // 1. HANDLER ARAH KEBIJAKAN (LEVEL 1)
    // ============================================================
    $(document).on('click', '.btn-tambah-arah-di-row', function() {
        var idPrioritas = $(this).data('id-prioritas');
        var namaPrioritas = $(this).data('nama-prioritas');
        $('#FormTambahArah')[0].reset();
        $('#Arah_IdEdit').val('');
        $('#Arah_PrioritasId').val(idPrioritas);
        $('#Arah_NamaPrioritasDisplay').text(namaPrioritas);
        $('#AlertArah').hide();
        $('#ModalTambahArah .modal-title').html('<i class="fa fa-plus-circle"></i> Tambah Arah Kebijakan');
        $('#ModalTambahArah').modal('show');
    });

    $(document).on('click', '.btn-edit-arah', function() {
        var id = $(this).data('id');
        $('#AlertArah').hide();
        $.ajax({
            url: BaseURL + 'Daerah/GetArahKebijakanById',
            type: 'POST',
            dataType: 'json',
            data: { Id: id },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    $('#Arah_IdEdit').val(res.data.id);
                    $('#Arah_PrioritasId').val(res.data.prioritas_id || res.data.id_prioritas_daerah);
                    $('#Arah_NamaPrioritasDisplay').text(res.data.prioritas_pembangunan || 'Prioritas Pembangunan');
                    $('#Arah_Text').val(res.data.arah_kebijakan);
                    $('#ModalTambahArah .modal-title').html('<i class="fa fa-pencil"></i> Edit Arah Kebijakan');
                    $('#ModalTambahArah').modal('show');
                } else {
                    alert('Gagal mengambil data: ' + (res.message || 'Data tidak ditemukan'));
                }
            }
        });
    });

    $('#BtnSimpanArah').on('click', function() {
        var idEdit = $('#Arah_IdEdit').val();
        var prioritasId = $('#Arah_PrioritasId').val();
        var arahText = $.trim($('#Arah_Text').val());

        if (!prioritasId) {
            $('#AlertArah').html('Prioritas Pembangunan tidak terhubung!').show();
            return;
        }
        if (!arahText) {
            $('#AlertArah').html('Uraian Arah Kebijakan wajib diisi!').show();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var url = idEdit ? (BaseURL + 'Daerah/EditArahKebijakan') : (BaseURL + 'Daerah/InputArahKebijakan');
        var postData = idEdit ? { Id: idEdit, ArahKebijakan: arahText } : {
            PrioritasId: prioritasId,
            ArahKebijakan: arahText
        };

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: postData,
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Arah');
                if (res.status === 'success') {
                    $('#ModalTambahArah').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertArah').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Arah');
                $('#AlertArah').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    $(document).on('click', '.btn-hapus-arah', function() {
        var id = $(this).data('id');
        if (confirm('PERINGATAN: Menghapus Arah Kebijakan ini akan menghapus seluruh Program, Kegiatan, dan Subkegiatan di bawahnya!\n\nApakah Anda yakin ingin melanjutkan?')) {
            $.ajax({
                url: BaseURL + 'Daerah/DeleteArahKebijakan',
                type: 'POST',
                dataType: 'json',
                data: { Id: id },
                success: function(res) {
                    if (res.status === 'success') {
                        window.location.reload();
                    } else {
                        alert('Gagal menghapus: ' + res.message);
                    }
                }
            });
        }
    });

    // ============================================================
    // 2. HANDLER PROGRAM (1 ARAH -> N PROGRAM)
    // ============================================================
    $(document).on('click', '.btn-tambah-prog-di-row', function() {
        var arahId = $(this).data('id-arah');
        var namaArah = $(this).data('nama-arah');
        $('#FormTambahProgram')[0].reset();
        $('#Prog_IdEdit').val('');
        $('#Prog_ArahId').val(arahId);
        $('#Prog_NamaArahDisplay').text(namaArah);
        $('#Prog_KodeProgram').val('').trigger('change');
        $('#AlertProgram').hide();
        $('#ModalTambahProgram .modal-title').html('<i class="fa fa-plus-circle"></i> Tambah Program Nomenklatur');
        $('#ModalTambahProgram').modal('show');
    });

    $(document).on('click', '.btn-edit-prog', function() {
        var id = $(this).data('id');
        $('#AlertProgram').hide();
        $.ajax({
            url: BaseURL + 'Daerah/GetProgramPrioritasById',
            type: 'POST',
            dataType: 'json',
            data: { Id: id },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    $('#Prog_IdEdit').val(res.data.id);
                    $('#Prog_ArahId').val(res.data.arah_id);
                    $('#Prog_NamaArahDisplay').text('Program ID: ' + res.data.id);
                    $('#Prog_KodeProgram').val(res.data.kode_program).trigger('change');
                    $('#ModalTambahProgram .modal-title').html('<i class="fa fa-pencil"></i> Edit Program Nomenklatur');
                    $('#ModalTambahProgram').modal('show');
                } else {
                    alert('Gagal mengambil data: ' + (res.message || 'Data tidak ditemukan'));
                }
            }
        });
    });

    $('#BtnSimpanProgram').on('click', function() {
        var idEdit = $('#Prog_IdEdit').val();
        var arahId = $('#Prog_ArahId').val();
        var kodeProg = $('#Prog_KodeProgram').val();
        var namaProg = $('#Prog_KodeProgram option:selected').data('nama') || '';

        if (!kodeProg) {
            $('#AlertProgram').html('Program Nomenklatur wajib dipilih!').show();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var url = idEdit ? (BaseURL + 'Daerah/EditProgramPrioritas') : (BaseURL + 'Daerah/InputProgramPrioritas');
        var postData = idEdit ? { Id: idEdit, KodeProgram: kodeProg, NamaProgram: namaProg } : {
            ArahId: arahId,
            KodeProgram: kodeProg,
            NamaProgram: namaProg
        };

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: postData,
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Program');
                if (res.status === 'success') {
                    $('#ModalTambahProgram').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertProgram').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Program');
                $('#AlertProgram').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    $(document).on('click', '.btn-hapus-prog', function() {
        var id = $(this).data('id');
        if (confirm('PERINGATAN: Menghapus Program ini akan menghapus seluruh Kegiatan dan Subkegiatan di bawahnya!\n\nApakah Anda yakin?')) {
            $.ajax({
                url: BaseURL + 'Daerah/DeleteProgramPrioritas',
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
                }
            });
        }
    });

    // ============================================================
    // 3. HANDLER KEGIATAN (1 PROGRAM -> N KEGIATAN)
    // ============================================================
    $(document).on('click', '.btn-tambah-keg-di-row', function() {
        var programId = $(this).data('id-program');
        var kodeProgram = $(this).data('kode-program');
        var namaProgram = $(this).data('nama-program');

        $('#FormTambahKegiatan')[0].reset();
        $('#Keg_IdEdit').val('');
        $('#Keg_ProgramId').val(programId);
        $('#Keg_KodeProgramParent').val(kodeProgram);
        $('#Keg_NamaProgramDisplay').text('[' + kodeProgram + '] ' + namaProgram);
        $('#AlertKegiatan').hide();

        // Load kegiatan di bawah program ini
        $('#Keg_KodeKegiatan').html('<option value="">-- Memuat Kegiatan... --</option>').trigger('change');
        $.ajax({
            url: BaseURL + 'Daerah/getKegiatanByProgram',
            type: 'POST',
            dataType: 'json',
            data: { KodeProgram: kodeProgram },
            success: function(list) {
                var html = '<option value="">-- Pilih Kegiatan Nomenklatur --</option>';
                if (list && list.length > 0) {
                    for (var i = 0; i < list.length; i++) {
                        var k = list[i];
                        html += '<option value="' + k.Kode + '" data-nama="' + $('<div>').text(k.Nomenklatur).html() + '">' +
                            '[' + k.Kode + '] ' + $('<div>').text(k.Nomenklatur).html() +
                        '</option>';
                    }
                } else {
                    html = '<option value="">-- Tidak ada kegiatan pada program ini --</option>';
                }
                $('#Keg_KodeKegiatan').html(html).trigger('change');
            }
        });

        $('#ModalTambahKegiatan .modal-title').html('<i class="fa fa-plus-circle"></i> Tambah Kegiatan Nomenklatur');
        $('#ModalTambahKegiatan').modal('show');
    });

    $(document).on('click', '.btn-edit-keg', function() {
        var id = $(this).data('id');
        $('#AlertKegiatan').hide();
        $.ajax({
            url: BaseURL + 'Daerah/GetKegiatanPrioritasById',
            type: 'POST',
            dataType: 'json',
            data: { Id: id },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    var d = res.data;
                    $('#Keg_IdEdit').val(d.id);
                    $('#Keg_ProgramId').val(d.program_id);
                    $('#Keg_NamaProgramDisplay').text('Kegiatan ID: ' + d.id);

                    // Load kegiatan dari parent program
                    var progCodePrefix = d.kode_kegiatan.substring(0, d.kode_kegiatan.lastIndexOf('.', d.kode_kegiatan.lastIndexOf('.') - 1));
                    if (!progCodePrefix) progCodePrefix = d.kode_kegiatan.substring(0, 7);

                    $.ajax({
                        url: BaseURL + 'Daerah/getKegiatanByProgram',
                        type: 'POST',
                        dataType: 'json',
                        data: { KodeProgram: progCodePrefix },
                        success: function(list) {
                            var html = '<option value="">-- Pilih Kegiatan Nomenklatur --</option>';
                            if (list && list.length > 0) {
                                for (var i = 0; i < list.length; i++) {
                                    var k = list[i];
                                    var sel = (k.Kode === d.kode_kegiatan) ? 'selected' : '';
                                    html += '<option value="' + k.Kode + '" data-nama="' + $('<div>').text(k.Nomenklatur).html() + '" ' + sel + '>' +
                                        '[' + k.Kode + '] ' + $('<div>').text(k.Nomenklatur).html() +
                                    '</option>';
                                }
                            }
                            $('#Keg_KodeKegiatan').html(html).trigger('change');
                        }
                    });

                    $('#ModalTambahKegiatan .modal-title').html('<i class="fa fa-pencil"></i> Edit Kegiatan Nomenklatur');
                    $('#ModalTambahKegiatan').modal('show');
                } else {
                    alert('Gagal mengambil data: ' + (res.message || 'Data tidak ditemukan'));
                }
            }
        });
    });

    $('#BtnSimpanKegiatan').on('click', function() {
        var idEdit = $('#Keg_IdEdit').val();
        var programId = $('#Keg_ProgramId').val();
        var kodeKeg = $('#Keg_KodeKegiatan').val();
        var namaKeg = $('#Keg_KodeKegiatan option:selected').data('nama') || '';

        if (!kodeKeg) {
            $('#AlertKegiatan').html('Kegiatan Nomenklatur wajib dipilih!').show();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var url = idEdit ? (BaseURL + 'Daerah/EditKegiatanPrioritas') : (BaseURL + 'Daerah/InputKegiatanPrioritas');
        var postData = idEdit ? { Id: idEdit, KodeKegiatan: kodeKeg, NamaKegiatan: namaKeg } : {
            ProgramId: programId,
            KodeKegiatan: kodeKeg,
            NamaKegiatan: namaKeg
        };

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: postData,
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Kegiatan');
                if (res.status === 'success') {
                    $('#ModalTambahKegiatan').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertKegiatan').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Kegiatan');
                $('#AlertKegiatan').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    $(document).on('click', '.btn-hapus-keg', function() {
        var id = $(this).data('id');
        if (confirm('PERINGATAN: Menghapus Kegiatan ini akan menghapus seluruh Subkegiatan di bawahnya!\n\nApakah Anda yakin?')) {
            $.ajax({
                url: BaseURL + 'Daerah/DeleteKegiatanPrioritas',
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
                }
            });
        }
    });

    // Helper: Render Row OPD Dinamis
    function renderRowOpd(selectedVal) {
        var optionsHtml = $('#TemplateOpdOptions').html();
        var rowId = 'opd_row_' + Math.random().toString(36).substr(2, 9);
        var html = '<div class="row-opd-item" id="' + rowId + '" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">' +
            '<div style="flex: 1;">' +
                '<select class="form-control select2-opd-row" style="width: 100%;">' +
                    optionsHtml +
                '</select>' +
            '</div>' +
            '<div>' +
                '<button type="button" class="btn btn-default btn-hapus-row-opd" style="height: 38px; width: 38px; border-radius: 6px; color: #dc2626; border: 1.5px solid #fecaca; background: #fef2f2; padding: 0;" title="Hapus OPD ini">' +
                    '<i class="fa fa-trash"></i>' +
                '</button>' +
            '</div>' +
        '</div>';

        $('#ContainerOpdList').append(html);
        var $select = $('#' + rowId).find('.select2-opd-row');
        $select.select2({
            dropdownParent: $('#ModalTambahSubKegiatan')
        });
        if (selectedVal) {
            $select.val(selectedVal).trigger('change');
        }
    }

    // Tombol Tambah Baris OPD
    $('#BtnTambahRowOpd').on('click', function() {
        renderRowOpd('');
    });

    // Tombol Hapus Baris OPD
    $(document).on('click', '.btn-hapus-row-opd', function() {
        var $row = $(this).closest('.row-opd-item');
        if ($('#ContainerOpdList .row-opd-item').length > 1) {
            $row.remove();
        } else {
            // Jika tinggal 1 baris, kosongkan pilihan
            $row.find('.select2-opd-row').val('').trigger('change');
        }
    });

    $(document).on('click', '.btn-tambah-sub-di-row', function() {
        var kegiatanId = $(this).data('id-kegiatan');
        var kodeKegiatan = $(this).data('kode-kegiatan');
        var namaKegiatan = $(this).data('nama-kegiatan');

        $('#FormTambahSubKegiatan')[0].reset();
        $('#Sub_IdEdit').val('');
        $('#Sub_KegiatanId').val(kegiatanId);
        $('#Sub_KodeKegiatanParent').val(kodeKegiatan);
        $('#Sub_NamaKegiatanDisplay').text('[' + kodeKegiatan + '] ' + namaKegiatan);
        $('#Sub_Pagu').val('');
        $('#AlertSubKegiatan').hide();

        // Reset dan render 1 row OPD kosong
        $('#ContainerOpdList').empty();
        renderRowOpd('');

        // Load subkegiatan di bawah kegiatan ini
        $('#Sub_KodeSubKegiatan').html('<option value="">-- Memuat Subkegiatan... --</option>').trigger('change');
        $.ajax({
            url: BaseURL + 'Daerah/getSubKegiatanByKegiatan',
            type: 'POST',
            dataType: 'json',
            data: { KodeKegiatan: kodeKegiatan },
            success: function(list) {
                var html = '<option value="">-- Pilih Subkegiatan Nomenklatur --</option>';
                if (list && list.length > 0) {
                    for (var i = 0; i < list.length; i++) {
                        var s = list[i];
                        html += '<option value="' + s.Kode + '" data-nama="' + $('<div>').text(s.Nomenklatur).html() + '">' +
                            '[' + s.Kode + '] ' + $('<div>').text(s.Nomenklatur).html() +
                        '</option>';
                    }
                } else {
                    html = '<option value="">-- Tidak ada subkegiatan pada kegiatan ini --</option>';
                }
                $('#Sub_KodeSubKegiatan').html(html).trigger('change');
            }
        });

        $('#ModalTambahSubKegiatan .modal-title').html('<i class="fa fa-plus-circle"></i> Tambah Subkegiatan Prioritas &amp; Pagu Indikatif');
        $('#ModalTambahSubKegiatan').modal('show');
    });

    $(document).on('click', '.btn-edit-sub', function() {
        var id = $(this).data('id');
        $('#AlertSubKegiatan').hide();
        $.ajax({
            url: BaseURL + 'Daerah/GetSubKegiatanPrioritasById',
            type: 'POST',
            dataType: 'json',
            data: { Id: id },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    var d = res.data;
                    $('#Sub_IdEdit').val(d.id);
                    $('#Sub_KegiatanId').val(d.kegiatan_id);
                    $('#Sub_NamaKegiatanDisplay').text('Subkegiatan ID: ' + d.id);
                    $('#Sub_Pagu').val(formatRupiah(d.pagu || '0'));

                    // Render baris OPD sesuai data yang tersimpan
                    $('#ContainerOpdList').empty();
                    var rawInstansi = d.id_instansi || '';
                    var arrInstansi = [];
                    if (rawInstansi) {
                        if (typeof rawInstansi === 'string') {
                            arrInstansi = rawInstansi.split(',').map(function(item) { return item.trim(); }).filter(Boolean);
                        } else if (Array.isArray(rawInstansi)) {
                            arrInstansi = rawInstansi;
                        }
                    }
                    if (arrInstansi.length > 0) {
                        for (var i = 0; i < arrInstansi.length; i++) {
                            renderRowOpd(arrInstansi[i]);
                        }
                    } else {
                        renderRowOpd('');
                    }

                    // Load subkegiatan pilihan
                    var kegCodePrefix = d.kode_subkegiatan.substring(0, d.kode_subkegiatan.lastIndexOf('.'));
                    $.ajax({
                        url: BaseURL + 'Daerah/getSubKegiatanByKegiatan',
                        type: 'POST',
                        dataType: 'json',
                        data: { KodeKegiatan: kegCodePrefix },
                        success: function(list) {
                            var html = '<option value="">-- Pilih Subkegiatan Nomenklatur --</option>';
                            if (list && list.length > 0) {
                                for (var i = 0; i < list.length; i++) {
                                    var s = list[i];
                                    var sel = (s.Kode === d.kode_subkegiatan) ? 'selected' : '';
                                    html += '<option value="' + s.Kode + '" data-nama="' + $('<div>').text(s.Nomenklatur).html() + '" ' + sel + '>' +
                                        '[' + s.Kode + '] ' + $('<div>').text(s.Nomenklatur).html() +
                                    '</option>';
                                }
                            }
                            $('#Sub_KodeSubKegiatan').html(html).trigger('change');
                        }
                    });

                    $('#ModalTambahSubKegiatan .modal-title').html('<i class="fa fa-pencil"></i> Edit Subkegiatan Prioritas &amp; Pagu Indikatif');
                    $('#ModalTambahSubKegiatan').modal('show');
                } else {
                    alert('Gagal mengambil data: ' + (res.message || 'Data tidak ditemukan'));
                }
            }
        });
    });

    $('#BtnSimpanSubKegiatan').on('click', function() {
        var idEdit = $('#Sub_IdEdit').val();
        var kegiatanId = $('#Sub_KegiatanId').val();
        var kodeSub = $('#Sub_KodeSubKegiatan').val();
        var namaSub = $('#Sub_KodeSubKegiatan option:selected').data('nama') || '';
        var pagu = $.trim($('#Sub_Pagu').val());
        
        // Ambil semua OPD dari baris-baris dinamis
        var selectedInstansiIds = [];
        var selectedInstansiNames = [];
        $('#ContainerOpdList .select2-opd-row').each(function() {
            var v = $(this).val();
            var t = $(this).find('option:selected').data('nama') || $(this).find('option:selected').text().trim();
            if (v && !selectedInstansiIds.includes(v)) {
                selectedInstansiIds.push(v);
                if (t) selectedInstansiNames.push(t);
            }
        });

        if (!kodeSub) {
            $('#AlertSubKegiatan').html('Subkegiatan Prioritas Nomenklatur wajib dipilih!').show();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var url = idEdit ? (BaseURL + 'Daerah/EditSubKegiatanPrioritas') : (BaseURL + 'Daerah/InputSubKegiatanPrioritas');
        var postData = idEdit ? {
            Id: idEdit,
            KodeSubKegiatan: kodeSub,
            NamaSubKegiatan: namaSub,
            Pagu: pagu,
            IdInstansi: selectedInstansiIds,
            NamaInstansi: selectedInstansiNames.join(', ')
        } : {
            KegiatanId: kegiatanId,
            KodeSubKegiatan: kodeSub,
            NamaSubKegiatan: namaSub,
            Pagu: pagu,
            IdInstansi: selectedInstansiIds,
            NamaInstansi: selectedInstansiNames.join(', ')
        };

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: postData,
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Subkegiatan');
                if (res.status === 'success') {
                    $('#ModalTambahSubKegiatan').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertSubKegiatan').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Subkegiatan');
                $('#AlertSubKegiatan').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    $(document).on('click', '.btn-hapus-sub', function() {
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus data Subkegiatan Prioritas ini?')) {
            $.ajax({
                url: BaseURL + 'Daerah/DeleteSubKegiatanPrioritas',
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
                }
            });
        }
    });


    var kodeWilayah = '<?= !empty($KodeWilayah) ? $KodeWilayah : "" ?>';

    // Filter Provinsi/KabKota
    $('#FilterProvinsi').on('change', function() {
        var provKode = $(this).val();
        if (!provKode) {
            $('#FilterKabKota').html('<option value="">-- Pilih Kabupaten / Kota --</option>');
            return;
        }
        $.ajax({
            url: BaseURL + 'Daerah/GetListKabKota',
            type: 'POST',
            dataType: 'json',
            data: { Kode: provKode },
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

    // Populate KabKota saat halaman dibuka jika sudah ada provinsi terpilih
    var initProv = $('#FilterProvinsi').val();
    if (initProv) {
        $.ajax({
            url: BaseURL + 'Daerah/GetListKabKota',
            type: 'POST',
            dataType: 'json',
            data: { Kode: initProv },
            success: function(kabList) {
                var opt = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                if (kabList) {
                    for (var i = 0; i < kabList.length; i++) {
                        var k = kabList[i];
                        var sel = (k.Kode === kodeWilayah) ? 'selected' : '';
                        opt += '<option value="' + k.Kode + '" ' + sel + '>' + $('<div>').text(k.Nama).html() + '</option>';
                    }
                }
                $('#FilterKabKota').html(opt);
            }
        });
    }

    $('#FormFilterProgPrioritas').on('submit', function() {
        var kw = $('#FilterKabKota').val();
        if (kw) {
            $.post(BaseURL + 'Daerah/SetTempKodeWilayah', { KodeWilayah: kw });
        }
    });

});
</script>
