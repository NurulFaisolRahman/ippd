<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>
<?php 
// Hanya pengguna yang login sebagai Daerah (Level 3) yang dapat melakukan aksi CRUD
$isDaerah = isset($IsDaerah) ? $IsDaerah : (isset($_SESSION['Level']) && $_SESSION['Level'] == 3); 

// Fungsi bantuan kalkulasi rowspan berhirarki
function calcOutcomeRows($oc) { 
    return (!empty($oc['Indikators'])) ? count($oc['Indikators']) : 1; 
}
function calcSasaranRows($s) {
    if (empty($s['Outcomes'])) return 1;
    $t = 0; 
    foreach ($s['Outcomes'] as $oc) $t += calcOutcomeRows($oc);
    return max(1, $t);
}
function calcTujuanRows($tj) {
    if (empty($tj['Sasaran'])) return 1;
    $t = 0; 
    foreach ($tj['Sasaran'] as $s) $t += calcSasaranRows($s);
    return max(1, $t);
}
function calcMisiRows($mi) {
    if (empty($mi['Tujuan'])) return 1;
    $t = 0; 
    foreach ($mi['Tujuan'] as $tj) $t += calcTujuanRows($tj);
    return max(1, $t);
}


?>

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<style>
    /* Styling Header & Card */
    .prog-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 25px 25px 35px 25px;
        margin-bottom: 30px;
        border-top: 4px solid #5dade2;
    }
    .prog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        border-bottom: 2px solid #f0f4f8;
        padding-bottom: 18px;
        margin-bottom: 22px;
        gap: 15px;
    }
    .prog-title-box h3 {
        margin: 0 0 6px 0;
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.3px;
    }
    .prog-title-box p {
        margin: 0;
        font-size: 13.5px;
        color: #64748b;
    }



    /* Table Styling matching user specification */
    .table-prioritas-rpjmd {
        border-collapse: separate !important;
        border-spacing: 0;
        border: 1.5px solid #60a5fa !important;
        width: 100%;
        background-color: #ffffff;
    }
    .table-prioritas-rpjmd thead th {
        background-color: #70bfe6 !important; /* Warna biru sesuai gambar user */
        color: #000000 !important;
        font-weight: 800 !important;
        font-size: 13.5px !important;
        text-align: center;
        vertical-align: middle !important;
        border: 1px solid #5aa7ce !important;
        padding: 12px 10px !important;
        letter-spacing: 0.3px;
        text-transform: none;
    }
    .table-prioritas-rpjmd tbody td {
        vertical-align: top !important;
        font-size: 13px;
        line-height: 1.55;
        border: 1px solid #cbd5e1 !important;
        padding: 12px 14px !important;
        color: #1e293b;
    }
    .table-prioritas-rpjmd tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Hirarki Badges & Labels */
    .badge-visi {
        display: inline-block;
        background: #0284c7;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 4px;
        margin-bottom: 5px;
        letter-spacing: 0.5px;
    }
    .badge-misi {
        display: inline-block;
        background: #059669;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 4px;
        margin-bottom: 5px;
        letter-spacing: 0.5px;
    }
    .badge-tujuan {
        display: inline-block;
        background: #d97706;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 4px;
        margin-bottom: 5px;
        letter-spacing: 0.5px;
    }
    .badge-sasaran {
        display: inline-block;
        background: #475569;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 4px;
        margin-bottom: 5px;
        letter-spacing: 0.5px;
    }
    .badge-outcome {
        display: inline-block;
        background: #6366f1;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 4px;
        margin-bottom: 5px;
        letter-spacing: 0.5px;
    }
    .badge-indikator {
        display: inline-block;
        background: #0ea5e9;
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 4px;
        margin-bottom: 4px;
    }

    /* Program Container */
    .program-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 8px 10px;
    }
    .badge-prog-kode {
        display: inline-block;
        background: #fef08a;
        color: #854d0e;
        border: 1px solid #fde047;
        font-size: 11px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 4px;
        margin-bottom: 4px;
    }
    .prog-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 12.5px;
    }

    /* Action Buttons */
    .btn-action-group {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }
    .btn-xs-custom {
        padding: 4px 8px;
        font-size: 11.5px;
        font-weight: 600;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: none;
        transition: all 0.2s;
    }
    .btn-xs-custom:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
    .btn-add-sub {
        background: #10b981;
        color: #ffffff;
    }
    .btn-edit-sub {
        background: #f59e0b;
        color: #ffffff;
    }
    .btn-del-sub {
        background: #ef4444;
        color: #ffffff;
    }

    /* Modal Form Styling */
    .form-group-custom {
        margin-bottom: 18px;
    }
    .form-group-custom label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }
    .field-hint {
        font-size: 11.5px;
        color: #64748b;
        margin-top: 4px;
        display: block;
    }
    .repeater-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 14px;
        position: relative;
    }
    .repeater-item .btn-remove-row {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .repeater-header {
        font-weight: 700;
        color: #0f172a;
        font-size: 13px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Hirarki Breadcrumb di Modal */
    .hierarchy-breadcrumb {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 10px 14px;
        font-size: 12.5px;
        color: #334155;
        margin-bottom: 15px;
    }
    .hierarchy-breadcrumb span {
        font-weight: 700;
    }

    /* Select2 Customization */
    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single {
        height: 38px !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding-top: 4px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px !important;
        font-size: 13px !important;
        color: #1e293b !important;
    }
    .select2-dropdown {
        border: 1.5px solid #94a3b8 !important;
        border-radius: 6px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        z-index: 999999 !important;
        font-size: 13px !important;
    }
</style>

<!-- Main Content Area -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <!-- Filter Wilayah (Khusus jika belum login / belum memilih wilayah) -->
                    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px;">
                            <div style="display: flex; align-items: flex-end; gap: 15px; flex-wrap: wrap;">
                                <div style="flex: 1 1 250px; min-width: 200px;">
                                    <label for="Provinsi" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Provinsi</label>
                                    <select class="form-control" id="Provinsi" style="height: 38px; border-radius: 6px;">
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach ($Provinsi as $prov) { ?>
                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                <?= html_escape($prov['Nama']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div style="flex: 1 1 250px; min-width: 200px;">
                                    <label for="KabKota" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Kab/Kota</label>
                                    <select class="form-control" id="KabKota" style="height: 38px; border-radius: 6px;">
                                        <option value="">Pilih Kab/Kota</option>
                                    </select>
                                </div>
                                <div style="flex: 0 0 auto;">
                                    <button class="btn btn-primary notika-btn-primary" id="Filter" style="height: 38px; padding: 0 25px; font-weight: 700; border-radius: 6px;">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($KodeWilayah)) { ?>
                            <div class="alert alert-info" style="margin-bottom: 20px; border-radius: 8px;">
                                <strong>Wilayah:</strong> <?= html_escape($NamaWilayah ?? '') ?> (Kode: <?= html_escape($KodeWilayah) ?>)
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <!-- Card Utama Program Prioritas RPJMD -->
                    <div class="prog-card">
                        
                        <!-- Header Box -->
                        <div class="prog-header">
                            <div class="prog-title-box">
                                <h3><i class="fa fa-sitemap" style="color: #0284c7; margin-right: 8px;"></i> PROGRAM PRIORITAS RPJMD (BERHIRARKI)</h3>
                                <p>Hierarki Berjenjang: Visi/Misi &rarr; Tujuan &rarr; Sasaran &rarr; Outcome &rarr; Indikator &rarr; Program Nomenklatur</p>
                            </div>
                        </div>

                        <!-- Tabel Program Prioritas RPJMD Berhirarki Penuh -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-prioritas-rpjmd" id="TableProgramPrioritas">
                                <thead>
                                    <tr>
                                        <th style="width: 17%;">Visi / Misi</th>
                                        <th style="width: 15%;">Tujuan</th>
                                        <th style="width: 16%;">Sasaran</th>
                                        <th style="width: 15%;">Outcome</th>
                                        <th style="width: 15%;">Indikator</th>
                                        <th style="width: 12%;">Program</th>
                                        <th style="width: 10%;">Keterangan</th>
                                        <?php if ($isDaerah) { ?>
                                            <th style="width: 8%;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $hasData = false;
                                    if (!empty($VMTS)) {
                                        foreach ($VMTS as $visi) {
                                            $misiList = !empty($visi['Misi']) ? $visi['Misi'] : [];
                                            $noMisi = 1;

                                            if (empty($misiList)) {
                                                $hasData = true;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div style="margin-bottom: 8px;">
                                                            <span class="badge-visi">VISI</span>
                                                            <div style="font-weight: 600; color: #0284c7;"><?= html_escape($visi['Visi']) ?></div>
                                                        </div>
                                                        <div class="text-muted" style="font-style:italic;">(Belum ada misi pada visi ini)</div>
                                                    </td>
                                                    <td colspan="<?= $isDaerah ? '7' : '6' ?>" class="text-center text-muted" style="font-style: italic; padding: 20px;">
                                                        Belum ada data Misi pada Visi ini di VMTS
                                                    </td>
                                                </tr>
                                                <?php
                                                continue;
                                            }

                                            foreach ($misiList as $misi) {
                                                $hasData = true;
                                                $misiRows = calcMisiRows($misi);
                                                $isFirstMisiRow = true;
                                                $tujuanList = !empty($misi['Tujuan']) ? $misi['Tujuan'] : [];

                                                if (empty($tujuanList)) {
                                                    // Misi belum ada tujuan
                                                    ?>
                                                    <tr>
                                                        <td rowspan="<?= $misiRows ?>">
                                                            <div style="margin-bottom: 8px;">
                                                                <span class="badge-visi">VISI</span>
                                                                <div style="font-weight: 600; color: #0284c7;"><?= html_escape($visi['Visi']) ?></div>
                                                            </div>
                                                            <div>
                                                                <span class="badge-misi">MISI <?= $noMisi ?></span>
                                                                <div style="font-weight: 500; color: #1e293b;"><?= html_escape($misi['Misi']) ?></div>
                                                            </div>
                                                        </td>
                                                        <td colspan="<?= $isDaerah ? '7' : '6' ?>" class="text-center text-muted" style="font-style: italic; padding: 20px;">
                                                            Belum ada data Tujuan pada Misi ini di VMTS
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $noMisi++;
                                                    continue;
                                                }

                                                $noTujuan = 1;
                                                foreach ($tujuanList as $tujuan) {
                                                    $tujuanRows = calcTujuanRows($tujuan);
                                                    $isFirstTujuanRow = true;
                                                    $sasaranList = !empty($tujuan['Sasaran']) ? $tujuan['Sasaran'] : [];

                                                    if (empty($sasaranList)) {
                                                        // Tujuan belum ada sasaran
                                                        ?>
                                                        <tr>
                                                            <?php if ($isFirstMisiRow) { ?>
                                                                <td rowspan="<?= $misiRows ?>">
                                                                    <div style="margin-bottom: 8px;">
                                                                        <span class="badge-visi">VISI</span>
                                                                        <div style="font-weight: 600; color: #0284c7;"><?= html_escape($visi['Visi']) ?></div>
                                                                    </div>
                                                                    <div>
                                                                        <span class="badge-misi">MISI <?= $noMisi ?></span>
                                                                        <div style="font-weight: 500; color: #1e293b;"><?= html_escape($misi['Misi']) ?></div>
                                                                    </div>
                                                                </td>
                                                            <?php $isFirstMisiRow = false; } ?>

                                                            <td rowspan="<?= $tujuanRows ?>">
                                                                <span class="badge-tujuan">TUJUAN <?= $noMisi . '.' . $noTujuan ?></span>
                                                                <div style="font-weight: 500; color: #1e293b;"><?= html_escape($tujuan['Tujuan']) ?></div>
                                                            </td>
                                                            <td colspan="<?= $isDaerah ? '6' : '5' ?>" class="text-center text-muted" style="font-style: italic; padding: 20px;">
                                                                Belum ada data Sasaran pada Tujuan ini di VMTS
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $noTujuan++;
                                                        continue;
                                                    }

                                                    $noSasaran = 1;
                                                    foreach ($sasaranList as $sasaran) {
                                                        $sasaranRows = calcSasaranRows($sasaran);
                                                        $isFirstSasaranRow = true;
                                                        $outcomes = !empty($sasaran['Outcomes']) ? $sasaran['Outcomes'] : [];

                                                        if (empty($outcomes)) {
                                                            // Sasaran belum punya outcome
                                                            ?>
                                                            <tr>
                                                                <?php if ($isFirstMisiRow) { ?>
                                                                    <td rowspan="<?= $misiRows ?>">
                                                                        <div style="margin-bottom: 8px;">
                                                                            <span class="badge-visi">VISI</span>
                                                                            <div style="font-weight: 600; color: #0284c7;"><?= html_escape($visi['Visi']) ?></div>
                                                                        </div>
                                                                        <div>
                                                                            <span class="badge-misi">MISI <?= $noMisi ?></span>
                                                                            <div style="font-weight: 500; color: #1e293b;"><?= html_escape($misi['Misi']) ?></div>
                                                                        </div>
                                                                    </td>
                                                                <?php $isFirstMisiRow = false; } ?>

                                                                <?php if ($isFirstTujuanRow) { ?>
                                                                    <td rowspan="<?= $tujuanRows ?>">
                                                                        <span class="badge-tujuan">TUJUAN <?= $noMisi . '.' . $noTujuan ?></span>
                                                                        <div style="font-weight: 500; color: #1e293b;"><?= html_escape($tujuan['Tujuan']) ?></div>
                                                                    </td>
                                                                <?php $isFirstTujuanRow = false; } ?>

                                                                <td rowspan="<?= $sasaranRows ?>">
                                                                    <span class="badge-sasaran">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?></span>
                                                                    <div style="font-weight: 600; color: #334155; margin-bottom: 8px;">
                                                                        <?= html_escape($sasaran['Sasaran']) ?>
                                                                    </div>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <button type="button" class="btn btn-xs-custom btn-add-sub btn-tambah-outcome-sasaran" 
                                                                                data-misi-id="<?= $misi['Id'] ?>"
                                                                                data-tujuan-id="<?= $tujuan['Id'] ?>"
                                                                                data-sasaran-id="<?= $sasaran['Id'] ?>" 
                                                                                data-sasaran-nama="<?= html_escape($sasaran['Sasaran']) ?>"
                                                                                data-tujuan-nama="<?= html_escape($tujuan['Tujuan']) ?>"
                                                                                data-misi-nama="<?= html_escape($misi['Misi']) ?>"
                                                                                data-visi-nama="<?= html_escape($visi['Visi']) ?>"
                                                                                title="Tambah Outcome untuk Sasaran ini">
                                                                            <i class="fa fa-plus"></i> Tambah Outcome
                                                                        </button>
                                                                    <?php } ?>
                                                                </td>

                                                                <!-- Outcome, Indikator, Program, Keterangan kosong -->
                                                                <td colspan="4" class="text-center" style="background: #fafafa; color: #94a3b8; font-style: italic; vertical-align: middle !important; padding: 16px !important;">
                                                                    Belum ada Outcome & Program Prioritas
                                                                </td>
                                                                <?php if ($isDaerah) { ?>
                                                                    <td class="text-center" style="vertical-align: middle !important;">
                                                                        <button type="button" class="btn btn-xs-custom btn-add-sub btn-tambah-outcome-sasaran" 
                                                                                data-misi-id="<?= $misi['Id'] ?>"
                                                                                data-tujuan-id="<?= $tujuan['Id'] ?>"
                                                                                data-sasaran-id="<?= $sasaran['Id'] ?>" 
                                                                                data-sasaran-nama="<?= html_escape($sasaran['Sasaran']) ?>"
                                                                                data-tujuan-nama="<?= html_escape($tujuan['Tujuan']) ?>"
                                                                                data-misi-nama="<?= html_escape($misi['Misi']) ?>"
                                                                                data-visi-nama="<?= html_escape($visi['Visi']) ?>"
                                                                                title="Tambah Outcome untuk Sasaran ini">
                                                                            <i class="fa fa-plus"></i> Tambah Outcome
                                                                        </button>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                            <?php
                                                            $noSasaran++;
                                                            continue;
                                                        }

                                                        // Sasaran memiliki Outcome
                                                        $noOutcome = 1;
                                                        foreach ($outcomes as $oc) {
                                                            $ocRows = calcOutcomeRows($oc);
                                                            $isFirstOcRow = true;
                                                            $indikators = !empty($oc['Indikators']) ? $oc['Indikators'] : [];

                                                            if (empty($indikators)) {
                                                                // Outcome belum ada indikator
                                                                ?>
                                                                <tr>
                                                                    <?php if ($isFirstMisiRow) { ?>
                                                                        <td rowspan="<?= $misiRows ?>">
                                                                            <div style="margin-bottom: 8px;">
                                                                                <span class="badge-visi">VISI</span>
                                                                                <div style="font-weight: 600; color: #0284c7;"><?= html_escape($visi['Visi']) ?></div>
                                                                            </div>
                                                                            <div>
                                                                                <span class="badge-misi">MISI <?= $noMisi ?></span>
                                                                                <div style="font-weight: 500; color: #1e293b;"><?= html_escape($misi['Misi']) ?></div>
                                                                            </div>
                                                                        </td>
                                                                    <?php $isFirstMisiRow = false; } ?>

                                                                    <?php if ($isFirstTujuanRow) { ?>
                                                                        <td rowspan="<?= $tujuanRows ?>">
                                                                            <span class="badge-tujuan">TUJUAN <?= $noMisi . '.' . $noTujuan ?></span>
                                                                            <div style="font-weight: 500; color: #1e293b;"><?= html_escape($tujuan['Tujuan']) ?></div>
                                                                        </td>
                                                                    <?php $isFirstTujuanRow = false; } ?>

                                                                    <?php if ($isFirstSasaranRow) { ?>
                                                                        <td rowspan="<?= $sasaranRows ?>">
                                                                            <span class="badge-sasaran">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?></span>
                                                                            <div style="font-weight: 600; color: #334155; margin-bottom: 8px;">
                                                                                <?= html_escape($sasaran['Sasaran']) ?>
                                                                            </div>
                                                                            <?php if ($isDaerah) { ?>
                                                                                <button type="button" class="btn btn-xs-custom btn-add-sub btn-tambah-outcome-sasaran" 
                                                                                        data-misi-id="<?= $misi['Id'] ?>"
                                                                                        data-tujuan-id="<?= $tujuan['Id'] ?>"
                                                                                        data-sasaran-id="<?= $sasaran['Id'] ?>" 
                                                                                        data-sasaran-nama="<?= html_escape($sasaran['Sasaran']) ?>"
                                                                                        data-tujuan-nama="<?= html_escape($tujuan['Tujuan']) ?>"
                                                                                        data-misi-nama="<?= html_escape($misi['Misi']) ?>"
                                                                                        data-visi-nama="<?= html_escape($visi['Visi']) ?>"
                                                                                        style="font-size: 10.5px; padding: 2px 6px;">
                                                                                    <i class="fa fa-plus"></i> Tambah Outcome
                                                                                </button>
                                                                            <?php } ?>
                                                                        </td>
                                                                    <?php $isFirstSasaranRow = false; } ?>

                                                                    <td rowspan="<?= $ocRows ?>">
                                                                        <span class="badge-outcome">OUTCOME #<?= $noOutcome ?></span>
                                                                        <div style="font-weight: 600; color: #0f172a; margin-bottom: 6px;">
                                                                            <?= nl2br(html_escape($oc['Outcome'])) ?>
                                                                        </div>
                                                                        <?php if ($isDaerah) { ?>
                                                                            <div class="btn-action-group" style="margin-top: 6px;">
                                                                                <button type="button" class="btn btn-xs-custom btn-edit-sub btn-edit-outcome" data-id="<?= $oc['Id'] ?>" title="Edit Outcome">
                                                                                    <i class="fa fa-pencil"></i> Edit Outcome
                                                                                </button>
                                                                                <button type="button" class="btn btn-xs-custom btn-del-sub btn-hapus-outcome" data-id="<?= $oc['Id'] ?>" title="Hapus Outcome">
                                                                                    <i class="fa fa-trash"></i> Hapus
                                                                                </button>
                                                                                <button type="button" class="btn btn-xs-custom btn-add-sub btn-quick-add-ind" data-id="<?= $oc['Id'] ?>" data-outcome="<?= html_escape($oc['Outcome']) ?>" title="Tambah Indikator">
                                                                                    <i class="fa fa-plus"></i> Indikator
                                                                                </button>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </td>

                                                                    <td class="text-muted" style="font-style: italic;">(Belum ada indikator)</td>
                                                                    <td class="text-muted">-</td>
                                                                    <td class="text-muted">-</td>
                                                                    <?php if ($isDaerah) { ?>
                                                                        <td class="text-center">-</td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php
                                                                $noOutcome++;
                                                                continue;
                                                            }

                                                            // Outcome memiliki 1 atau lebih indikator
                                                            $noInd = 1;
                                                            foreach ($indikators as $ind) {
                                                                ?>
                                                                <tr>
                                                                    <?php if ($isFirstMisiRow) { ?>
                                                                        <td rowspan="<?= $misiRows ?>">
                                                                            <div style="margin-bottom: 8px;">
                                                                                <span class="badge-visi">VISI</span>
                                                                                <div style="font-weight: 600; color: #0284c7;"><?= html_escape($visi['Visi']) ?></div>
                                                                            </div>
                                                                            <div>
                                                                                <span class="badge-misi">MISI <?= $noMisi ?></span>
                                                                                <div style="font-weight: 500; color: #1e293b;"><?= html_escape($misi['Misi']) ?></div>
                                                                            </div>
                                                                        </td>
                                                                    <?php $isFirstMisiRow = false; } ?>

                                                                    <?php if ($isFirstTujuanRow) { ?>
                                                                        <td rowspan="<?= $tujuanRows ?>">
                                                                            <span class="badge-tujuan">TUJUAN <?= $noMisi . '.' . $noTujuan ?></span>
                                                                            <div style="font-weight: 500; color: #1e293b;"><?= html_escape($tujuan['Tujuan']) ?></div>
                                                                        </td>
                                                                    <?php $isFirstTujuanRow = false; } ?>

                                                                    <?php if ($isFirstSasaranRow) { ?>
                                                                        <td rowspan="<?= $sasaranRows ?>">
                                                                            <span class="badge-sasaran">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?></span>
                                                                            <div style="font-weight: 600; color: #334155; margin-bottom: 8px;">
                                                                                <?= html_escape($sasaran['Sasaran']) ?>
                                                                            </div>
                                                                            <?php if ($isDaerah) { ?>
                                                                                <button type="button" class="btn btn-xs-custom btn-add-sub btn-tambah-outcome-sasaran" 
                                                                                        data-misi-id="<?= $misi['Id'] ?>"
                                                                                        data-tujuan-id="<?= $tujuan['Id'] ?>"
                                                                                        data-sasaran-id="<?= $sasaran['Id'] ?>" 
                                                                                        data-sasaran-nama="<?= html_escape($sasaran['Sasaran']) ?>"
                                                                                        data-tujuan-nama="<?= html_escape($tujuan['Tujuan']) ?>"
                                                                                        data-misi-nama="<?= html_escape($misi['Misi']) ?>"
                                                                                        data-visi-nama="<?= html_escape($visi['Visi']) ?>"
                                                                                        style="font-size: 10.5px; padding: 2px 6px;">
                                                                                    <i class="fa fa-plus"></i> Tambah Outcome
                                                                                </button>
                                                                            <?php } ?>
                                                                        </td>
                                                                    <?php $isFirstSasaranRow = false; } ?>

                                                                    <?php if ($isFirstOcRow) { ?>
                                                                        <td rowspan="<?= $ocRows ?>" style="background: #ffffff;">
                                                                            <span class="badge-outcome">OUTCOME #<?= $noOutcome ?></span>
                                                                            <div style="font-weight: 600; color: #0f172a; margin-bottom: 6px;">
                                                                                <?= nl2br(html_escape($oc['Outcome'])) ?>
                                                                            </div>
                                                                            <?php if ($isDaerah) { ?>
                                                                                <div class="btn-action-group" style="margin-top: 8px;">
                                                                                    <button type="button" class="btn btn-xs-custom btn-edit-sub btn-edit-outcome" data-id="<?= $oc['Id'] ?>" title="Edit Outcome">
                                                                                        <i class="fa fa-pencil"></i> Edit Outcome
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-xs-custom btn-del-sub btn-hapus-outcome" data-id="<?= $oc['Id'] ?>" title="Hapus Seluruh Outcome">
                                                                                        <i class="fa fa-trash"></i> Hapus
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-xs-custom btn-add-sub btn-quick-add-ind" data-id="<?= $oc['Id'] ?>" data-outcome="<?= html_escape($oc['Outcome']) ?>" title="Tambah Indikator Baru ke Outcome ini">
                                                                                        <i class="fa fa-plus"></i> Indikator
                                                                                    </button>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </td>
                                                                    <?php $isFirstOcRow = false; } ?>

                                                                    <!-- Indikator -->
                                                                    <td>
                                                                        <span class="badge-indikator">Indikator <?= $noInd ?></span>
                                                                        <div style="font-weight: 500; color: #1e293b; margin-top: 4px; margin-bottom: 6px;">
                                                                            <?= nl2br(html_escape($ind['Indikator'])) ?>
                                                                        </div>
                                                                        <?php if ($isDaerah) { ?>
                                                                            <div style="margin-top: 6px;">
                                                                                <button type="button" class="btn btn-xs-custom btn-edit-sub btn-edit-single-ind" 
                                                                                        data-id="<?= $ind['Id'] ?>" 
                                                                                        data-indikator="<?= html_escape($ind['Indikator']) ?>"
                                                                                        data-kode-program="<?= html_escape($ind['KodeProgram']) ?>"
                                                                                        data-nama-program="<?= html_escape($ind['NamaProgram']) ?>"
                                                                                        data-keterangan="<?= html_escape($ind['Keterangan']) ?>"
                                                                                        style="font-size: 11px; padding: 3px 8px;"
                                                                                        title="Edit Indikator">
                                                                                    <i class="fa fa-pencil"></i> Edit
                                                                                </button>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </td>

                                                                    <!-- Program (Nomenklatur) -->
                                                                    <td>
                                                                        <?php if (!empty($ind['KodeProgram']) || !empty($ind['NamaProgram'])) { ?>
                                                                            <div class="program-card">
                                                                                <?php if (!empty($ind['KodeProgram'])) { ?>
                                                                                    <span class="badge-prog-kode"><?= html_escape($ind['KodeProgram']) ?></span>
                                                                                <?php } ?>
                                                                                <div class="prog-name">
                                                                                    <?= html_escape($ind['NamaProgram'] ?: '-') ?>
                                                                                </div>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <span class="text-muted">-</span>
                                                                        <?php } ?>
                                                                    </td>

                                                                    <!-- Keterangan -->
                                                                    <td>
                                                                        <?= !empty($ind['Keterangan']) ? nl2br(html_escape($ind['Keterangan'])) : '<span class="text-muted">-</span>' ?>
                                                                    </td>

                                                                    <!-- Opsi Aksi Single Indikator -->
                                                                    <?php if ($isDaerah) { ?>
                                                                        <td class="text-center" style="vertical-align: middle !important;">
                                                                            <div style="display: flex; gap: 4px; justify-content: center;">
                                                                                <button type="button" class="btn btn-xs-custom btn-edit-sub btn-edit-single-ind" 
                                                                                        data-id="<?= $ind['Id'] ?>" 
                                                                                        data-indikator="<?= html_escape($ind['Indikator']) ?>"
                                                                                        data-kode-program="<?= html_escape($ind['KodeProgram']) ?>"
                                                                                        data-nama-program="<?= html_escape($ind['NamaProgram']) ?>"
                                                                                        data-keterangan="<?= html_escape($ind['Keterangan']) ?>"
                                                                                        title="Edit Indikator Ini">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </button>
                                                                                <button type="button" class="btn btn-xs-custom btn-del-sub btn-hapus-single-ind" data-id="<?= $ind['Id'] ?>" title="Hapus Indikator Ini">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php
                                                                $noInd++;
                                                            }
                                                            $noOutcome++;
                                                        }
                                                        $noSasaran++;
                                                    }
                                                    $noTujuan++;
                                                }
                                                $noMisi++;
                                            }
                                        }
                                    }
                                    if (!$hasData) { ?>
                                        <tr>
                                            <td colspan="<?= $isDaerah ? '8' : '7' ?>" class="text-center" style="padding: 40px; color: #64748b;">
                                                <i class="fa fa-info-circle" style="font-size: 20px; color: #94a3b8; display: block; margin-bottom: 10px;"></i>
                                                Belum ada data VMTS (Visi, Misi, Tujuan, Sasaran) untuk wilayah ini.<br>
                                                Silakan lengkapi data pada menu <b>VMTS</b> terlebih dahulu.
                                            </td>
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
</div>

<?php if ($isDaerah) { ?>
<!-- ============================================================ -->
<!-- MODAL TAMBAH PROGRAM PRIORITAS RPJMD (BERHIRARKI CASCADING) -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalInputProgramPrioritas" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #0284c7; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Outcome & Program Prioritas RPJMD
                </h4>
            </div>
            <div class="modal-body" style="padding: 25px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <div id="AlertInput" class="alert alert-warning" style="display:none; padding: 12px 16px; border-radius: 6px; font-size: 13px;"></div>

                <form id="FormInputProgramPrioritas">
                    <input type="hidden" id="Input_KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">
                    <input type="hidden" id="Input_SasaranId" value="">

                    <!-- 1. HIERARKI VMTS (READ-ONLY DARI SASARAN TERPILIH) -->
                    <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                        <div style="font-weight: 800; color: #0f172a; font-size: 13.5px; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between;">
                            <span><i class="fa fa-lock" style="color: #0284c7; margin-right: 5px;"></i> Hirarki VMTS (Otomatis dari VMTS)</span>
                            <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 600; font-size: 11px;">Terkunci</span>
                        </div>
                        
                        <div style="display: grid; grid-gap: 8px; font-size: 13px;">
                            <div style="display: flex; gap: 8px;">
                                <span class="badge-visi" style="align-self: flex-start; min-width: 60px; text-align: center;">VISI</span>
                                <div id="InfoVisiNama" style="color: #0284c7; font-weight: 600;">-</div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <span class="badge-misi" style="align-self: flex-start; min-width: 60px; text-align: center;">MISI</span>
                                <div id="InfoMisiNama" style="color: #1e293b; font-weight: 500;">-</div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <span class="badge-tujuan" style="align-self: flex-start; min-width: 60px; text-align: center;">TUJUAN</span>
                                <div id="InfoTujuanNama" style="color: #1e293b; font-weight: 500;">-</div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <span class="badge-sasaran" style="align-self: flex-start; min-width: 60px; text-align: center;">SASARAN</span>
                                <div id="InfoSasaranNama" style="color: #0f172a; font-weight: 700;">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. OUTCOME (INPUT MANUAL) -->
                    <div class="form-group-custom">
                        <label for="Input_Outcome">
                            2. Outcome <span class="text-danger">*</span>
                        </label>
                        <textarea id="Input_Outcome" class="form-control" rows="3" placeholder="Masukkan uraian Outcome sasaran secara manual..." style="border-radius: 6px; border: 1.5px solid #cbd5e1;"></textarea>
                        <span class="field-hint">Uraian hasil/outcome yang diharapkan dari Sasaran RPJMD yang dipilih.</span>
                    </div>

                    <!-- 3. INDIKATOR-INDIKATOR (1 OUTCOME BISA BEBERAPA INDIKATOR) -->
                    <div class="form-group-custom" style="margin-top: 25px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <label style="margin: 0; font-size: 14px; font-weight: 800; color: #0f172a;">
                                3. Indikator, Program & Keterangan <span class="text-danger">*</span>
                            </label>
                            <button type="button" class="btn btn-sm btn-success" id="BtnTambahRowIndikator" style="border-radius: 6px; font-weight: 700; padding: 6px 14px;">
                                <i class="fa fa-plus"></i> Tambah Indikator
                            </button>
                        </div>
                        <span class="field-hint" style="margin-bottom: 12px;">1 Outcome dapat memiliki beberapa indikator kinerja, program nomenklatur, dan keterangan.</span>

                        <div id="ContainerIndikatorInput">
                            <!-- Baris pertama otomatis muncul -->
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer" style="padding: 15px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-primary notika-btn-primary" id="BtnSimpanProgramPrioritas" style="border-radius: 6px; font-weight: 700; padding: 8px 22px;">
                    <i class="fa fa-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- ============================================================ -->
<!-- MODAL EDIT OUTCOME PROGRAM PRIORITAS RPJMD -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditProgramPrioritas" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md" style="margin-top: 70px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #f59e0b; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Outcome RPJMD
                </h4>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <div id="AlertEdit" class="alert alert-warning" style="display:none; padding: 12px 16px; border-radius: 6px; font-size: 13px;"></div>

                <form id="FormEditProgramPrioritas">
                    <input type="hidden" id="Edit_Id">
                    <input type="hidden" id="Edit_SasaranId">

                    <!-- Info Hirarki VMTS Terikat -->
                    <div class="hierarchy-breadcrumb">
                        <div style="font-weight: 700; color: #0f172a; margin-bottom: 4px;">Hirarki VMTS (Read-Only):</div>
                        <div id="Edit_HierarchyPath">-</div>
                    </div>

                    <!-- Outcome -->
                    <div class="form-group-custom">
                        <label for="Edit_Outcome">
                            Uraian Outcome <span class="text-danger">*</span>
                        </label>
                        <textarea id="Edit_Outcome" class="form-control" rows="4" placeholder="Uraian Outcome..." style="border-radius: 6px; border: 1.5px solid #cbd5e1;"></textarea>
                        <span class="field-hint">Indikator diedit secara terpisah langsung di kolom Indikator.</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 15px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-warning" id="BtnUpdateProgramPrioritas" style="border-radius: 6px; font-weight: 700; padding: 8px 22px; background: #f59e0b; border-color: #d97706; color: #fff;">
                    <i class="fa fa-save"></i> Simpan Perubahan Outcome
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT INDIKATOR TERSENDIRI -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditIndikator" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md" style="margin-top: 70px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #0ea5e9; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Indikator Program Prioritas
                </h4>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <div id="AlertEditInd" class="alert alert-warning" style="display:none; padding: 10px 14px; border-radius: 6px; font-size: 13px;"></div>
                <form id="FormEditIndikator">
                    <input type="hidden" id="EditInd_Id">

                    <div class="form-group-custom">
                        <label for="EditInd_Indikator">Uraian Indikator <span class="text-danger">*</span></label>
                        <textarea id="EditInd_Indikator" class="form-control" rows="3" placeholder="Masukkan uraian indikator..." style="border-radius: 6px; border: 1.5px solid #cbd5e1;"></textarea>
                    </div>

                    <div class="form-group-custom">
                        <label for="EditInd_Program">Program (Nomenklatur)</label>
                        <select id="EditInd_Program" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Program Nomenklatur --</option>
                            <?php foreach ($ProgramNomenklatur as $prg) { ?>
                                <option value="<?= html_escape($prg['Kode']) ?>" data-nama="<?= html_escape($prg['Nomenklatur']) ?>">
                                    [<?= html_escape($prg['Kode']) ?>] <?= html_escape($prg['Nomenklatur']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label for="EditInd_Keterangan">Keterangan</label>
                        <textarea id="EditInd_Keterangan" class="form-control" rows="2" placeholder="Keterangan tambahan (opsional)..." style="border-radius: 6px; border: 1.5px solid #cbd5e1;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 15px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-primary notika-btn-primary" id="BtnUpdateSingleIndikator" style="border-radius: 6px; font-weight: 700; padding: 8px 22px; background: #0284c7; border-color: #0369a1;">
                    <i class="fa fa-save"></i> Simpan Perubahan Indikator
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL QUICK TAMBAH INDIKATOR KE OUTCOME -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalQuickAddIndikator" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 80px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #10b981; color: #fff; padding: 18px 22px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Indikator ke Outcome
                </h4>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <div id="AlertQuickInd" class="alert alert-warning" style="display:none; padding: 10px 14px; border-radius: 6px; font-size: 13px;"></div>

                <form id="FormQuickAddIndikator">
                    <input type="hidden" id="Quick_OutcomeId">

                    <div class="form-group-custom">
                        <label>Outcome</label>
                        <div id="Quick_OutcomeText" style="padding: 10px 14px; background: #f1f5f9; border-radius: 6px; font-weight: 600; color: #334155; font-size: 13px;"></div>
                    </div>

                    <div class="form-group-custom">
                        <label for="Quick_Indikator">Indikator <span class="text-danger">*</span></label>
                        <textarea id="Quick_Indikator" class="form-control" rows="2" placeholder="Masukkan uraian indikator..." style="border-radius: 6px;"></textarea>
                    </div>

                    <div class="form-group-custom">
                        <label for="Quick_Program">Program (Nomenklatur) <span class="text-danger">*</span></label>
                        <select id="Quick_Program" class="form-control select2-modal" style="width: 100%;">
                            <option value="">-- Pilih Program Nomenklatur --</option>
                            <?php foreach ($ProgramNomenklatur as $prg) { ?>
                                <option value="<?= html_escape($prg['Kode']) ?>" data-nama="<?= html_escape($prg['Nomenklatur']) ?>">
                                    [<?= html_escape($prg['Kode']) ?>] <?= html_escape($prg['Nomenklatur']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label for="Quick_Keterangan">Keterangan</label>
                        <textarea id="Quick_Keterangan" class="form-control" rows="2" placeholder="Keterangan tambahan (opsional)..." style="border-radius: 6px;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 15px 22px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success notika-btn-success" id="BtnSimpanQuickIndikator" style="border-radius: 6px; font-weight: 700; padding: 8px 22px;">
                    <i class="fa fa-save"></i> Tambahkan Indikator
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- JS Libraries -->
<script src="<?= base_url() ?>js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

// Master list program nomenklatur dalam javascript
var MASTER_PROGRAM = <?= json_encode($ProgramNomenklatur) ?>;

// Master struktur VMTS untuk cascading dropdown berhirarki
var MASTER_VMTS = <?= json_encode($VMTS) ?>;

// Template HTML untuk baris indikator dinamis
function generateIndikatorRowHtml(index, data) {
    data = data || {};
    var indText = data.Indikator || '';
    var kodeProg = data.KodeProgram || '';
    var namaProg = data.NamaProgram || '';
    var ket = data.Keterangan || '';

    var optionsHtml = '<option value="">-- Pilih Program Nomenklatur --</option>';
    if (MASTER_PROGRAM && MASTER_PROGRAM.length > 0) {
        for (var i = 0; i < MASTER_PROGRAM.length; i++) {
            var p = MASTER_PROGRAM[i];
            var selected = (p.Kode === kodeProg) ? ' selected' : '';
            optionsHtml += '<option value="' + p.Kode + '" data-nama="' + $('<div>').text(p.Nomenklatur).html() + '"' + selected + '>[' + p.Kode + '] ' + $('<div>').text(p.Nomenklatur).html() + '</option>';
        }
    }

    return '' +
    '<div class="repeater-item item-indikator" data-index="' + index + '">' +
        '<div class="repeater-header">' +
            '<i class="fa fa-tag" style="color: #0284c7;"></i> Indikator #' + (index + 1) +
        '</div>' +
        '<button type="button" class="btn btn-xs btn-danger btn-remove-row" title="Hapus Baris">' +
            '<i class="fa fa-times"></i> Hapus' +
        '</button>' +
        '<div class="form-group" style="margin-bottom: 14px;">' +
            '<label style="font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px; display: block;">' +
                'Uraian Indikator <span class="text-danger">*</span>' +
            '</label>' +
            '<textarea class="form-control field-ind-text" rows="2" placeholder="Tuliskan uraian indikator sasaran..." style="border-radius: 6px; font-size: 13px; width: 100%; border: 1.5px solid #cbd5e1;">' + indText + '</textarea>' +
        '</div>' +
        '<div class="form-group" style="margin-bottom: 14px;">' +
            '<label style="font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px; display: block;">' +
                'Program Nomenklatur' +
            '</label>' +
            '<select class="form-control field-ind-program select2-repeater" style="width: 100%;">' +
                optionsHtml +
            '</select>' +
        '</div>' +
        '<div class="form-group" style="margin-bottom: 6px;">' +
            '<label style="font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 6px; display: block;">' +
                'Keterangan' +
            '</label>' +
            '<textarea class="form-control field-ind-keterangan" rows="2" placeholder="Catatan/keterangan tambahan..." style="border-radius: 6px; font-size: 13px; width: 100%; border: 1.5px solid #cbd5e1;">' + ket + '</textarea>' +
        '</div>' +
    '</div>';
}

$(document).ready(function() {
    
    // Inisialisasi Select2
    $('.select2-modal').select2({
        dropdownParent: $('body')
    });

    // Handle modal shown event untuk inisialisasi select2
    $('#ModalInputProgramPrioritas, #ModalEditProgramPrioritas, #ModalQuickAddIndikator, #ModalEditIndikator').on('shown.bs.modal', function () {
        $(this).find('.select2-modal').select2({
            dropdownParent: $(this)
        });
        $(this).find('.select2-repeater').select2({
            dropdownParent: $(this)
        });
    });

    // ============================================================
    // TAMBAH ROW INDIKATOR DI MODAL INPUT
    // ============================================================
    function addRowIndikatorInput(data) {
        var container = $('#ContainerIndikatorInput');
        var index = container.find('.item-indikator').length;
        var html = generateIndikatorRowHtml(index, data);
        container.append(html);
        
        container.find('.item-indikator:last .select2-repeater').select2({
            dropdownParent: $('#ModalInputProgramPrioritas')
        });
    }

    $('#BtnTambahRowIndikator').on('click', function() {
        addRowIndikatorInput();
    });

    // Hapus Row di Modal Input
    $('#ContainerIndikatorInput').on('click', '.btn-remove-row', function() {
        if ($('#ContainerIndikatorInput .item-indikator').length <= 1) {
            alert('Minimal harus ada 1 baris indikator!');
            return;
        }
        $(this).closest('.item-indikator').remove();
        $('#ContainerIndikatorInput .item-indikator').each(function(idx) {
            $(this).find('.repeater-header').html('<i class="fa fa-tag" style="color: #0284c7;"></i> Indikator #' + (idx + 1));
        });
    });

    // Tombol Tambah Outcome dari Sasaran Tertentu di Tabel
    $(document).on('click', '.btn-tambah-outcome-sasaran', function() {
        var sasaranId   = $(this).data('sasaran-id');
        var sasaranNama = $(this).data('sasaran-nama') || '-';
        var tujuanNama  = $(this).data('tujuan-nama') || '-';
        var misiNama    = $(this).data('misi-nama') || '-';
        var visiNama    = $(this).data('visi-nama') || '-';

        $('#FormInputProgramPrioritas')[0].reset();
        $('#Input_SasaranId').val(sasaranId);
        $('#InfoVisiNama').text(visiNama);
        $('#InfoMisiNama').text(misiNama);
        $('#InfoTujuanNama').text(tujuanNama);
        $('#InfoSasaranNama').text(sasaranNama);

        $('#ContainerIndikatorInput').empty();
        addRowIndikatorInput(); // 1 baris default
        $('#AlertInput').hide();

        $('#ModalInputProgramPrioritas').modal('show');
    });

    // ============================================================
    // SIMPAN PROGRAM PRIORITAS BARU (OUTCOME & INDIKATOR-INDIKATOR)
    // ============================================================
    $('#BtnSimpanProgramPrioritas').on('click', function() {
        var sasaranId = $('#Input_SasaranId').val();
        var outcome = $.trim($('#Input_Outcome').val());
        var kodeWilayah = $('#Input_KodeWilayah').val();

        if (!sasaranId) {
            $('#AlertInput').html('Silakan lengkapi hirarki VMTS hingga Sasaran RPJMD!').show();
            $('#Input_SasaranId').focus();
            return;
        }
        if (!outcome) {
            $('#AlertInput').html('Uraian Outcome wajib diisi!').show();
            $('#Input_Outcome').focus();
            return;
        }

        // Kumpulkan data indikator
        var indikatorItems = [];
        var valid = true;

        $('#ContainerIndikatorInput .item-indikator').each(function() {
            var indText = $.trim($(this).find('.field-ind-text').val());
            var progSelect = $(this).find('.field-ind-program');
            var kodeProg = progSelect.val();
            var namaProg = progSelect.find('option:selected').data('nama') || '';
            var ket = $.trim($(this).find('.field-ind-keterangan').val());

            if (!indText) {
                valid = false;
                $(this).find('.field-ind-text').css('border-color', '#ef4444');
            } else {
                $(this).find('.field-ind-text').css('border-color', '#cbd5e1');
            }

            indikatorItems.push({
                indikator: indText,
                kode_program: kodeProg,
                nama_program: namaProg,
                keterangan: ket
            });
        });

        if (!valid || indikatorItems.length === 0) {
            $('#AlertInput').html('Semua baris indikator harus memiliki teks uraian!').show();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/InputProgramPrioritasRPJMD',
            type: 'POST',
            dataType: 'json',
            data: {
                KodeWilayah: kodeWilayah,
                SasaranId: sasaranId,
                Outcome: outcome,
                IndikatorItems: JSON.stringify(indikatorItems)
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Data');
                if (res.status === 'success') {
                    $('#ModalInputProgramPrioritas').modal('hide');
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

    // ============================================================
    // EDIT OUTCOME RPJMD
    // ============================================================
    $(document).on('click', '.btn-edit-outcome', function() {
        var id = $(this).data('id');
        $('#AlertEdit').hide();

        $.ajax({
            url: BaseURL + 'Daerah/GetProgramPrioritasRPJMDById',
            type: 'POST',
            dataType: 'json',
            data: { Id: id },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    var d = res.data;
                    $('#Edit_Id').val(d.Id);
                    $('#Edit_SasaranId').val(d.sasaran_id);
                    $('#Edit_Outcome').val(d.Outcome);

                    var path = '';
                    if (d.Misi) path += '<span style="color:#059669;">[Misi]</span> ' + d.Misi + '<br>';
                    if (d.Tujuan) path += '<span style="color:#d97706;">[Tujuan]</span> ' + d.Tujuan + '<br>';
                    if (d.Sasaran) path += '<span style="color:#0284c7;">[Sasaran]</span> ' + d.Sasaran;
                    $('#Edit_HierarchyPath').html(path || '-');

                    $('#ModalEditProgramPrioritas').modal('show');
                } else {
                    alert(res.message || 'Gagal memuat data!');
                }
            },
            error: function(xhr, status, err) {
                alert('Gagal mengambil data dari server: ' + err);
            }
        });
    });

    $('#BtnUpdateProgramPrioritas').on('click', function() {
        var id = $('#Edit_Id').val();
        var sasaranId = $('#Edit_SasaranId').val();
        var outcome = $.trim($('#Edit_Outcome').val());

        if (!outcome) {
            $('#AlertEdit').html('Uraian Outcome wajib diisi!').show();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditProgramPrioritasRPJMD',
            type: 'POST',
            dataType: 'json',
            data: {
                Id: id,
                SasaranId: sasaranId,
                Outcome: outcome
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan Outcome');
                if (res.status === 'success') {
                    $('#ModalEditProgramPrioritas').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertEdit').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan Outcome');
                $('#AlertEdit').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    // ============================================================
    // EDIT SINGLE INDIKATOR TERSENDIRI (DI KOLOM INDIKATOR)
    // ============================================================
    $(document).on('click', '.btn-edit-single-ind', function() {
        var id = $(this).data('id');
        var indikator = $(this).data('indikator');
        var kodeProg = $(this).data('kode-program');
        var ket = $(this).data('keterangan');

        $('#FormEditIndikator')[0].reset();
        $('#EditInd_Id').val(id);
        $('#EditInd_Indikator').val(indikator);
        $('#EditInd_Program').val(kodeProg).trigger('change');
        $('#EditInd_Keterangan').val(ket);
        $('#AlertEditInd').hide();

        $('#ModalEditIndikator').modal('show');
    });

    $('#BtnUpdateSingleIndikator').on('click', function() {
        var id = $('#EditInd_Id').val();
        var indText = $.trim($('#EditInd_Indikator').val());
        var progSelect = $('#EditInd_Program');
        var kodeProg = progSelect.val();
        var namaProg = progSelect.find('option:selected').data('nama') || '';
        var ket = $.trim($('#EditInd_Keterangan').val());

        if (!indText) {
            $('#AlertEditInd').html('Uraian indikator wajib diisi!').show();
            $('#EditInd_Indikator').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditIndikatorProgramPrioritas',
            type: 'POST',
            dataType: 'json',
            data: {
                Id: id,
                Indikator: indText,
                KodeProgram: kodeProg,
                NamaProgram: namaProg,
                Keterangan: ket
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan Indikator');
                if (res.status === 'success') {
                    $('#ModalEditIndikator').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertEditInd').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan Indikator');
                $('#AlertEditInd').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    // ============================================================
    // HAPUS PROGRAM PRIORITAS (OUTCOME & SEMUA INDIKATORNYA)
    // ============================================================
    $(document).on('click', '.btn-hapus-outcome', function() {
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus data Outcome ini beserta seluruh indikatornya?')) {
            $.ajax({
                url: BaseURL + 'Daerah/HapusProgramPrioritasRPJMD',
                type: 'POST',
                dataType: 'json',
                data: { Id: id },
                success: function(res) {
                    if (res.status === 'success') {
                        alert(res.message);
                        window.location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr, status, err) {
                    alert('Gagal menghapus data: ' + err);
                }
            });
        }
    });

    // ============================================================
    // HAPUS SINGLE INDIKATOR
    // ============================================================
    $(document).on('click', '.btn-hapus-single-ind', function() {
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus indikator ini?')) {
            $.ajax({
                url: BaseURL + 'Daerah/HapusIndikatorProgramPrioritas',
                type: 'POST',
                dataType: 'json',
                data: { Id: id },
                success: function(res) {
                    if (res.status === 'success') {
                        alert(res.message);
                        window.location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr, status, err) {
                    alert('Gagal menghapus indikator: ' + err);
                }
            });
        }
    });

    // ============================================================
    // QUICK TAMBAH INDIKATOR KE OUTCOME
    // ============================================================
    $(document).on('click', '.btn-quick-add-ind', function() {
        var id = $(this).data('id');
        var outcome = $(this).data('outcome');

        $('#FormQuickAddIndikator')[0].reset();
        $('#Quick_OutcomeId').val(id);
        $('#Quick_OutcomeText').text(outcome);
        $('#Quick_Program').val('').trigger('change');
        $('#AlertQuickInd').hide();

        $('#ModalQuickAddIndikator').modal('show');
    });

    $('#BtnSimpanQuickIndikator').on('click', function() {
        var outcomeId = $('#Quick_OutcomeId').val();
        var indText = $.trim($('#Quick_Indikator').val());
        var progSelect = $('#Quick_Program');
        var kodeProg = progSelect.val();
        var namaProg = progSelect.find('option:selected').data('nama') || '';
        var ket = $.trim($('#Quick_Keterangan').val());

        if (!indText) {
            $('#AlertQuickInd').html('Uraian indikator wajib diisi!').show();
            $('#Quick_Indikator').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/InputIndikatorToOutcome',
            type: 'POST',
            dataType: 'json',
            data: {
                OutcomeId: outcomeId,
                Indikator: indText,
                KodeProgram: kodeProg,
                NamaProgram: namaProg,
                Keterangan: ket
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Tambahkan Indikator');
                if (res.status === 'success') {
                    $('#ModalQuickAddIndikator').modal('hide');
                    window.location.reload();
                } else {
                    $('#AlertQuickInd').html(res.message).show();
                }
            },
            error: function(xhr, status, err) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Tambahkan Indikator');
                $('#AlertQuickInd').html('Terjadi kesalahan pada server: ' + err).show();
            }
        });
    });

    // ============================================================
    // FILTER PROVINSI & KAB/KOTA (UNTUK SEBELUM LOGIN)
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
                $("#KabKota").html('<option value="">Gagal memuat data</option>').prop('disabled', false);
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
        $("#Filter").prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Memuat...');
        
        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { 
                KodeWilayah: kodeWilayah, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            success: function(Respon) {
                if (Respon.trim() === '1' || Respon.trim() === 'success') {
                    window.location.href = BaseURL + "Daerah/ProgramPrioritasRPJMD";
                } else {
                    alert(Respon || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).html('Filter');
                }
            },
            error: function() {
                alert("Gagal menghubungi server!");
                $("#Filter").prop('disabled', false).html('Filter');
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

});
</script>
