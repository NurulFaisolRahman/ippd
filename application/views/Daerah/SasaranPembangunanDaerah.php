<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<?php
// Helper kalkulasi rowspan
function calcSasaranRows($sas) {
    return max(1, count(!empty($sas['indikator_list']) ? $sas['indikator_list'] : []));
}

function calcIsuRows($isu) {
    if (empty($isu['sasaran_list'])) return 1;
    $rows = 0;
    foreach ($isu['sasaran_list'] as $sas) {
        $rows += calcSasaranRows($sas);
    }
    return max(1, $rows);
}

function calcPrioritasSasaranRows($p) {
    if (empty($p['isu_list'])) return 1;
    $rows = 0;
    foreach ($p['isu_list'] as $isu) {
        $rows += calcIsuRows($isu);
    }
    return max(1, $rows);
}

$can_edit = isset($_SESSION['Level']) && $_SESSION['Level'] == 3;
?>

<!-- Dependencies -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
    .sasaran-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .sasaran-card-header {
        background: #f8fafc;
        padding: 16px 20px;
        border-bottom: 1.5px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .sasaran-title h3 {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
    }
    .sasaran-title p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Tabel Sasaran Pembangunan Daerah Sesuai Gambar User */
    .table-sasaran-daerah {
        width: 100%;
        border-collapse: collapse !important;
        font-size: 13px;
        margin-bottom: 0;
        border: 1px solid #1b4f72 !important;
    }
    .table-sasaran-daerah thead th {
        background: #1b4f72 !important;
        color: #ffffff !important;
        text-align: center;
        vertical-align: middle !important;
        font-weight: 700;
        font-size: 12.5px;
        padding: 10px 8px !important;
        border: 1px solid #2874a6 !important;
        line-height: 1.35;
    }
    .table-sasaran-daerah tbody td {
        vertical-align: top !important;
        padding: 10px 12px !important;
        border: 1px solid #cbd5e1 !important;
        line-height: 1.5;
        color: #1e293b;
        background-color: #ffffff;
    }
    .table-sasaran-daerah tbody tr:hover td {
        background-color: #f8fafc;
    }

    .action-group {
        display: inline-flex;
        gap: 4px;
        margin-top: 6px;
        flex-wrap: wrap;
    }
    .btn-action-custom {
        padding: 2px 7px;
        font-size: 11px;
        font-weight: 600;
        border-radius: 3px;
        cursor: pointer;
        opacity: 1 !important;
        transition: all 0.15s ease-in-out;
    }
    .btn-action-add {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }
    .btn-action-add:hover {
        background: #0284c7;
        color: #ffffff;
        border-color: #0284c7;
    }
    .btn-action-edit {
        background: #f0ad4e !important;
        border: 1px solid #eea236 !important;
        color: #ffffff !important;
    }
    .btn-action-edit:hover {
        background: #ec971f !important;
        color: #ffffff !important;
    }
    .btn-action-delete {
        background: #d9534f !important;
        border: 1px solid #d43f3a !important;
        color: #ffffff !important;
    }
    .btn-action-delete:hover {
        background: #c9302c !important;
        color: #ffffff !important;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        
                        <!-- Header & Filter -->
                        <div class="basic-tb-hd" style="margin-bottom: 20px;">
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
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <div class="alert alert-info" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= html_escape($NamaWilayah) ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                            <!-- Toolbar Atas -->
                            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                                <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                    <label for="FilterTahun" style="margin: 0; font-size: 13px; font-weight: bold; color: #333;">Tahun RKPD:</label>
                                    <select id="FilterTahun" class="form-control" style="width: 130px; display: inline-block; height: 34px; padding: 4px 8px; font-size: 13px; color: #000; font-weight: bold;">
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
                            </div>
                        </div>

                        <!-- Card & Tabel Utama -->
                        <div class="sasaran-card">
                            <div class="sasaran-card-header">
                                <div class="sasaran-title">
                                    <h3>Sasaran Pembangunan Daerah (Tahun <?= html_escape($SelectedTahun) ?>)</h3>
                                    <p>Penetapan isu strategis, sasaran, indikator, realisasi tahun <?= $TahunRealisasi ?>, dan target tahun <?= $TahunTarget1 ?> - <?= $TahunTarget3 ?></p>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table-sasaran-daerah">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 20%; vertical-align: middle; text-align: center;">Prioritas Pembangunan Daerah</th>
                                            <th rowspan="2" style="width: 20%; vertical-align: middle; text-align: center;">Isu Strategis</th>
                                            <th rowspan="2" style="width: 20%; vertical-align: middle; text-align: center;">Sasaran Pembangunan Daerah</th>
                                            <th rowspan="2" style="width: 20%; vertical-align: middle; text-align: center;">Indikator Sasaran Pembangunan Daerah</th>
                                            <th colspan="1" style="width: 5%; vertical-align: middle; text-align: center;">Realisasi</th>
                                            <th colspan="3" style="width: 15%; vertical-align: middle; text-align: center;">Target</th>
                                        </tr>
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center;"><?= $TahunRealisasi ?></th>
                                            <th style="vertical-align: middle; text-align: center;"><?= $TahunTarget1 ?></th>
                                            <th style="vertical-align: middle; text-align: center;"><?= $TahunTarget2 ?></th>
                                            <th style="vertical-align: middle; text-align: center;"><?= $TahunTarget3 ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($PrioritasList)) { ?>
                                            <tr>
                                                <td colspan="8" class="text-center" style="padding: 40px !important;">
                                                    <div style="color: #64748b; font-size: 14px;">
                                                        <i class="fa fa-info-circle fa-2x" style="margin-bottom: 8px; color: #0284c7;"></i><br>
                                                        Belum ada data Prioritas Pembangunan Daerah pada menu <b>Tema Pembangunan</b> untuk Tahun <?= html_escape($SelectedTahun) ?>.<br>
                                                        <span style="font-size: 12.5px; color: #94a3b8;">Data Prioritas Pembangunan Daerah akan otomatis muncul di sini setelah diinput pada menu Tema Pembangunan.</span>
                                                        <div style="margin-top: 15px;">
                                                            <a href="<?= base_url('Daerah/TemaPembangunan?tahun=' . html_escape($SelectedTahun)) ?>" class="btn btn-sm btn-primary">
                                                                <i class="fa fa-arrow-right"></i> Buka Menu Tema Pembangunan
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php foreach ($PrioritasList as $p) { 
                                                $p_rows = calcPrioritasSasaranRows($p);
                                                $isuList = !empty($p['isu_list']) ? $p['isu_list'] : [];
                                                $isFirstIsu = true;
                                            ?>
                                                <?php if (empty($isuList)) { ?>
                                                    <!-- Prioritas tanpa Isu -->
                                                    <tr>
                                                        <td rowspan="1" style="font-weight: 600;">
                                                            <div><?= html_escape($p['prioritas_pembangunan']) ?></div>
                                                            <?php if ($can_edit) { ?>
                                                                <div class="action-group">
                                                                    <button type="button" class="btn-action-custom btn-action-add BtnTambahIsu" data-prioritas_id="<?= $p['id'] ?>" title="Tambah Isu Strategis">
                                                                        <i class="fa fa-plus"></i> Tambah Isu
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted" style="font-style: italic;">(Belum ada Isu Strategis)</span>
                                                        </td>
                                                        <td><span class="text-muted" style="font-style: italic;">(Belum ada Sasaran)</span></td>
                                                        <td><span class="text-muted" style="font-style: italic;">(Belum ada Indikator)</span></td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                        <td class="text-center">-</td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <?php foreach ($isuList as $isu) { 
                                                        $isu_rows = calcIsuRows($isu);
                                                        $sasList = !empty($isu['sasaran_list']) ? $isu['sasaran_list'] : [];
                                                        $isFirstSas = true;
                                                    ?>
                                                        <?php if (empty($sasList)) { ?>
                                                            <!-- Isu tanpa Sasaran -->
                                                            <tr>
                                                                <?php if ($isFirstIsu) { ?>
                                                                    <td rowspan="<?= $p_rows ?>" style="font-weight: 600;">
                                                                        <div><?= html_escape($p['prioritas_pembangunan']) ?></div>
                                                                        <?php if ($can_edit) { ?>
                                                                            <div class="action-group">
                                                                                <button type="button" class="btn-action-custom btn-action-add BtnTambahIsu" data-prioritas_id="<?= $p['id'] ?>" title="Tambah Isu Strategis">
                                                                                    <i class="fa fa-plus"></i> Tambah Isu
                                                                                </button>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <?php $isFirstIsu = false; ?>
                                                                <?php } ?>

                                                                <td rowspan="1">
                                                                    <div><?= html_escape($isu['isu_strategis']) ?></div>
                                                                    <?php if ($can_edit) { ?>
                                                                        <div class="action-group">
                                                                            <button type="button" class="btn-action-custom btn-action-add BtnTambahSasaran" data-isu_id="<?= $isu['id'] ?>" title="Tambah Sasaran">
                                                                                <i class="fa fa-plus"></i> Sasaran
                                                                            </button>
                                                                            <button type="button" class="btn-action-custom btn-action-edit BtnEditIsu" data-id="<?= $isu['id'] ?>" data-isu="<?= html_escape($isu['isu_strategis']) ?>" title="Edit Isu">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>
                                                                            <button type="button" class="btn-action-custom btn-action-delete BtnHapusIsu" data-id="<?= $isu['id'] ?>" title="Hapus Isu">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td><span class="text-muted" style="font-style: italic;">(Belum ada Sasaran)</span></td>
                                                                <td><span class="text-muted" style="font-style: italic;">(Belum ada Indikator)</span></td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        <?php } else { ?>
                                                            <?php foreach ($sasList as $sas) { 
                                                                $sas_rows = calcSasaranRows($sas);
                                                                $indList = !empty($sas['indikator_list']) ? $sas['indikator_list'] : [];
                                                                $isFirstInd = true;
                                                            ?>
                                                                <?php if (empty($indList)) { ?>
                                                                    <!-- Sasaran tanpa Indikator -->
                                                                    <tr>
                                                                        <?php if ($isFirstIsu) { ?>
                                                                            <td rowspan="<?= $p_rows ?>" style="font-weight: 600;">
                                                                                <div><?= html_escape($p['prioritas_pembangunan']) ?></div>
                                                                                <?php if ($can_edit) { ?>
                                                                                    <div class="action-group">
                                                                                        <button type="button" class="btn-action-custom btn-action-add BtnTambahIsu" data-prioritas_id="<?= $p['id'] ?>" title="Tambah Isu Strategis">
                                                                                            <i class="fa fa-plus"></i> Tambah Isu
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <?php $isFirstIsu = false; ?>
                                                                        <?php } ?>

                                                                        <?php if ($isFirstSas) { ?>
                                                                            <td rowspan="<?= $isu_rows ?>">
                                                                                <div><?= html_escape($isu['isu_strategis']) ?></div>
                                                                                <?php if ($can_edit) { ?>
                                                                                    <div class="action-group">
                                                                                        <button type="button" class="btn-action-custom btn-action-add BtnTambahSasaran" data-isu_id="<?= $isu['id'] ?>" title="Tambah Sasaran">
                                                                                            <i class="fa fa-plus"></i> Sasaran
                                                                                        </button>
                                                                                        <button type="button" class="btn-action-custom btn-action-edit BtnEditIsu" data-id="<?= $isu['id'] ?>" data-isu="<?= html_escape($isu['isu_strategis']) ?>" title="Edit Isu">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </button>
                                                                                        <button type="button" class="btn-action-custom btn-action-delete BtnHapusIsu" data-id="<?= $isu['id'] ?>" title="Hapus Isu">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <?php $isFirstSas = false; ?>
                                                                        <?php } ?>

                                                                        <td rowspan="1">
                                                                            <div><?= html_escape($sas['sasaran']) ?></div>
                                                                            <?php if ($can_edit) { ?>
                                                                                <div class="action-group">
                                                                                    <button type="button" class="btn-action-custom btn-action-add BtnTambahIndikator" data-sasaran_id="<?= $sas['id'] ?>" title="Tambah Indikator">
                                                                                        <i class="fa fa-plus"></i> Indikator
                                                                                    </button>
                                                                                    <button type="button" class="btn-action-custom btn-action-edit BtnEditSasaran" data-id="<?= $sas['id'] ?>" data-sasaran="<?= html_escape($sas['sasaran']) ?>" title="Edit Sasaran">
                                                                                        <i class="fa fa-pencil"></i>
                                                                                    </button>
                                                                                    <button type="button" class="btn-action-custom btn-action-delete BtnHapusSasaran" data-id="<?= $sas['id'] ?>" title="Hapus Sasaran">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td><span class="text-muted" style="font-style: italic;">(Belum ada Indikator)</span></td>
                                                                        <td class="text-center">-</td>
                                                                        <td class="text-center">-</td>
                                                                        <td class="text-center">-</td>
                                                                        <td class="text-center">-</td>
                                                                    </tr>
                                                                <?php } else { ?>
                                                                    <?php foreach ($indList as $ind) { ?>
                                                                        <tr>
                                                                            <?php if ($isFirstIsu) { ?>
                                                                                <td rowspan="<?= $p_rows ?>" style="font-weight: 600;">
                                                                                    <div><?= html_escape($p['prioritas_pembangunan']) ?></div>
                                                                                    <?php if ($can_edit) { ?>
                                                                                        <div class="action-group">
                                                                                            <button type="button" class="btn-action-custom btn-action-add BtnTambahIsu" data-prioritas_id="<?= $p['id'] ?>" title="Tambah Isu Strategis">
                                                                                                <i class="fa fa-plus"></i> Tambah Isu
                                                                                            </button>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </td>
                                                                                <?php $isFirstIsu = false; ?>
                                                                            <?php } ?>

                                                                            <?php if ($isFirstSas) { ?>
                                                                                <td rowspan="<?= $isu_rows ?>">
                                                                                    <div><?= html_escape($isu['isu_strategis']) ?></div>
                                                                                    <?php if ($can_edit) { ?>
                                                                                        <div class="action-group">
                                                                                            <button type="button" class="btn-action-custom btn-action-add BtnTambahSasaran" data-isu_id="<?= $isu['id'] ?>" title="Tambah Sasaran">
                                                                                                <i class="fa fa-plus"></i> Sasaran
                                                                                            </button>
                                                                                            <button type="button" class="btn-action-custom btn-action-edit BtnEditIsu" data-id="<?= $isu['id'] ?>" data-isu="<?= html_escape($isu['isu_strategis']) ?>" title="Edit Isu">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </button>
                                                                                        <button type="button" class="btn-action-custom btn-action-delete BtnHapusIsu" data-id="<?= $isu['id'] ?>" title="Hapus Isu">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <?php $isFirstSas = false; ?>
                                                                        <?php } ?>

                                                                        <?php if ($isFirstInd) { ?>
                                                                            <td rowspan="<?= $sas_rows ?>">
                                                                                <div><?= html_escape($sas['sasaran']) ?></div>
                                                                                <?php if ($can_edit) { ?>
                                                                                    <div class="action-group">
                                                                                        <button type="button" class="btn-action-custom btn-action-add BtnTambahIndikator" data-sasaran_id="<?= $sas['id'] ?>" title="Tambah Indikator">
                                                                                            <i class="fa fa-plus"></i> Indikator
                                                                                        </button>
                                                                                        <button type="button" class="btn-action-custom btn-action-edit BtnEditSasaran" data-id="<?= $sas['id'] ?>" data-sasaran="<?= html_escape($sas['sasaran']) ?>" title="Edit Sasaran">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </button>
                                                                                        <button type="button" class="btn-action-custom btn-action-delete BtnHapusSasaran" data-id="<?= $sas['id'] ?>" title="Hapus Sasaran">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <?php $isFirstInd = false; ?>
                                                                        <?php } ?>

                                                                        <!-- Kolom Indikator -->
                                                                        <td>
                                                                            <div>
                                                                                <?= html_escape($ind['indikator']) ?>
                                                                            </div>
                                                                            <?php if ($can_edit) { ?>
                                                                                <div class="action-group">
                                                                                    <button type="button" class="btn-action-custom btn-action-edit BtnEditIndikator" 
                                                                                        data-id="<?= $ind['id'] ?>"
                                                                                        data-indikator="<?= html_escape($ind['indikator']) ?>"
                                                                                        data-realisasi="<?= html_escape($ind['realisasi'] ?? '') ?>"
                                                                                        data-target1="<?= html_escape($ind['target_1'] ?? '') ?>"
                                                                                        data-target2="<?= html_escape($ind['target_2'] ?? '') ?>"
                                                                                        data-target3="<?= html_escape($ind['target_3'] ?? '') ?>"
                                                                                        title="Edit Indikator">
                                                                                        <i class="fa fa-pencil"></i>
                                                                                    </button>
                                                                                    <button type="button" class="btn-action-custom btn-action-delete BtnHapusIndikator" data-id="<?= $ind['id'] ?>" title="Hapus Indikator">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </td>

                                                                        <!-- Realisasi N-2 -->
                                                                        <td class="text-center" style="font-weight: 600; vertical-align: middle !important;">
                                                                            <?= !empty($ind['realisasi']) ? html_escape($ind['realisasi']) : '-' ?>
                                                                        </td>

                                                                        <!-- Target N-1 -->
                                                                        <td class="text-center" style="font-weight: 600; vertical-align: middle !important;">
                                                                            <?= !empty($ind['target_1']) ? html_escape($ind['target_1']) : '-' ?>
                                                                        </td>

                                                                        <!-- Target N -->
                                                                        <td class="text-center" style="font-weight: 600; vertical-align: middle !important; background-color: #f0fdf4;">
                                                                            <?= !empty($ind['target_2']) ? html_escape($ind['target_2']) : '-' ?>
                                                                        </td>

                                                                        <!-- Target N+1 -->
                                                                        <td class="text-center" style="font-weight: 600; vertical-align: middle !important;">
                                                                            <?= !empty($ind['target_3']) ? html_escape($ind['target_3']) : '-' ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
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
</div>


<!-- ============================================================
MODAL TAMBAH ISU STRATEGIS
============================================================ -->
<div class="modal fade" id="ModalInputIsu" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Isu Strategis</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="InputIsuPrioritasId">
                <div class="form-group">
                    <label><b>Nama Isu Strategis</b> <span class="text-danger">*</span>:</label>
                    <textarea class="form-control" id="InputIsuText" rows="3" placeholder="Masukkan isu strategis..." style="color: #000;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnSimpanIsu"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT ISU STRATEGIS -->
<div class="modal fade" id="ModalEditIsu" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Isu Strategis</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditIsuId">
                <div class="form-group">
                    <label><b>Nama Isu Strategis</b> <span class="text-danger">*</span>:</label>
                    <textarea class="form-control" id="EditIsuText" rows="3" style="color: #000;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnUpdateIsu"><b>Update</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL TAMBAH SASARAN DAERAH
============================================================ -->
<div class="modal fade" id="ModalInputSasaran" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Sasaran Pembangunan Daerah</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="InputSasaranIsuId">
                <div class="form-group">
                    <label><b>Sasaran Pembangunan Daerah</b> <span class="text-danger">*</span>:</label>
                    <textarea class="form-control" id="InputSasaranText" rows="3" placeholder="Masukkan rumusan sasaran pembangunan daerah..." style="color: #000;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnSimpanSasaran"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT SASARAN DAERAH -->
<div class="modal fade" id="ModalEditSasaran" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Sasaran Pembangunan Daerah</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditSasaranId">
                <div class="form-group">
                    <label><b>Sasaran Pembangunan Daerah</b> <span class="text-danger">*</span>:</label>
                    <textarea class="form-control" id="EditSasaranText" rows="3" style="color: #000;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnUpdateSasaran"><b>Update</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL TAMBAH INDIKATOR SASARAN
============================================================ -->
<div class="modal fade" id="ModalInputIndikator" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Indikator Sasaran Pembangunan Daerah</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="InputIndikatorSasaranId">
                <div class="form-group">
                    <label><b>Nama Indikator</b> <span class="text-danger">*</span>:</label>
                    <textarea class="form-control" id="InputIndikatorText" rows="2" placeholder="Contoh: Indeks Pembangunan Manusia, Persentase Kemiskinan..." style="color: #000;"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Realisasi (<?= $TahunRealisasi ?>):</label>
                            <input type="text" class="form-control" id="InputIndikatorRealisasi" placeholder="Nilai" style="color: #000;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Target <?= $TahunTarget1 ?>:</label>
                            <input type="text" class="form-control" id="InputIndikatorTarget1" placeholder="Target" style="color: #000;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Target <?= $TahunTarget2 ?>:</label>
                            <input type="text" class="form-control" id="InputIndikatorTarget2" placeholder="Target" style="color: #000;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Target <?= $TahunTarget3 ?>:</label>
                            <input type="text" class="form-control" id="InputIndikatorTarget3" placeholder="Target" style="color: #000;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnSimpanIndikator"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT INDIKATOR SASARAN -->
<div class="modal fade" id="ModalEditIndikator" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Indikator Sasaran Pembangunan Daerah</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditIndikatorId">
                <div class="form-group">
                    <label><b>Nama Indikator</b> <span class="text-danger">*</span>:</label>
                    <textarea class="form-control" id="EditIndikatorText" rows="2" style="color: #000;"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Realisasi (<?= $TahunRealisasi ?>):</label>
                            <input type="text" class="form-control" id="EditIndikatorRealisasi" style="color: #000;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Target <?= $TahunTarget1 ?>:</label>
                            <input type="text" class="form-control" id="EditIndikatorTarget1" style="color: #000;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Target <?= $TahunTarget2 ?>:</label>
                            <input type="text" class="form-control" id="EditIndikatorTarget2" style="color: #000;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Target <?= $TahunTarget3 ?>:</label>
                            <input type="text" class="form-control" id="EditIndikatorTarget3" style="color: #000;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnUpdateIndikator"><b>Update</b></button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';
var SelectedTahun = '<?= $SelectedTahun ?>';
var KodeWilayah = '<?= $KodeWilayah ?>';

$(document).ready(function() {
    // Filter Tahun
    $('#FilterTahun').on('change', function() {
        var tahun = $(this).val();
        var url = new URL(window.location.href);
        url.searchParams.set('tahun', tahun);
        window.location.href = url.toString();
    });

    // 1. ISU STRATEGIS
    $(document).on('click', '.BtnTambahIsu', function() {
        var pId = $(this).data('prioritas_id');
        $('#InputIsuPrioritasId').val(pId);
        $('#InputIsuText').val('');
        $('#ModalInputIsu').modal('show');
    });

    $('#BtnSimpanIsu').on('click', function() {
        var pId = $('#InputIsuPrioritasId').val();
        var isu = $('#InputIsuText').val().trim();
        if (!isu) {
            alert('Isu Strategis tidak boleh kosong!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/InputSasaranIsu',
            type: 'POST',
            data: {
                PrioritasId: pId,
                IsuStrategis: isu,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalInputIsu').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Simpan');
                }
            }
        });
    });

    $(document).on('click', '.BtnEditIsu', function() {
        var id = $(this).data('id');
        var isu = $(this).data('isu');
        $('#EditIsuId').val(id);
        $('#EditIsuText').val(isu);
        $('#ModalEditIsu').modal('show');
    });

    $('#BtnUpdateIsu').on('click', function() {
        var id = $('#EditIsuId').val();
        var isu = $('#EditIsuText').val().trim();
        if (!isu) {
            alert('Isu Strategis tidak boleh kosong!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditSasaranIsu',
            type: 'POST',
            data: {
                Id: id,
                IsuStrategis: isu,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalEditIsu').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Update');
                }
            }
        });
    });

    $(document).on('click', '.BtnHapusIsu', function() {
        var id = $(this).data('id');
        if (!confirm('Yakin ingin menghapus Isu Strategis ini beserta sasaran dan indikator terkait?')) {
            return;
        }

        $.ajax({
            url: BaseURL + 'Daerah/HapusSasaranIsu',
            type: 'POST',
            data: {
                Id: id,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                }
            }
        });
    });

    // 4. SASARAN DAERAH
    $(document).on('click', '.BtnTambahSasaran', function() {
        var isuId = $(this).data('isu_id');
        $('#InputSasaranIsuId').val(isuId);
        $('#InputSasaranText').val('');
        $('#ModalInputSasaran').modal('show');
    });

    $('#BtnSimpanSasaran').on('click', function() {
        var isuId = $('#InputSasaranIsuId').val();
        var sasaran = $('#InputSasaranText').val().trim();
        if (!sasaran) {
            alert('Sasaran Pembangunan Daerah tidak boleh kosong!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/InputSasaranDaerah',
            type: 'POST',
            data: {
                IsuId: isuId,
                Sasaran: sasaran,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalInputSasaran').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Simpan');
                }
            }
        });
    });

    $(document).on('click', '.BtnEditSasaran', function() {
        var id = $(this).data('id');
        var sasaran = $(this).data('sasaran');
        $('#EditSasaranId').val(id);
        $('#EditSasaranText').val(sasaran);
        $('#ModalEditSasaran').modal('show');
    });

    $('#BtnUpdateSasaran').on('click', function() {
        var id = $('#EditSasaranId').val();
        var sasaran = $('#EditSasaranText').val().trim();
        if (!sasaran) {
            alert('Sasaran Pembangunan Daerah tidak boleh kosong!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditSasaranDaerah',
            type: 'POST',
            data: {
                Id: id,
                Sasaran: sasaran,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalEditSasaran').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Update');
                }
            }
        });
    });

    $(document).on('click', '.BtnHapusSasaran', function() {
        var id = $(this).data('id');
        if (!confirm('Yakin ingin menghapus Sasaran ini beserta indikator terkait?')) {
            return;
        }

        $.ajax({
            url: BaseURL + 'Daerah/HapusSasaranDaerah',
            type: 'POST',
            data: {
                Id: id,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                }
            }
        });
    });

    // 5. INDIKATOR SASARAN DAERAH
    $(document).on('click', '.BtnTambahIndikator', function() {
        var sId = $(this).data('sasaran_id');
        $('#InputIndikatorSasaranId').val(sId);
        $('#InputIndikatorText').val('');
        $('#InputIndikatorRealisasi').val('');
        $('#InputIndikatorTarget1').val('');
        $('#InputIndikatorTarget2').val('');
        $('#InputIndikatorTarget3').val('');
        $('#ModalInputIndikator').modal('show');
    });

    $('#BtnSimpanIndikator').on('click', function() {
        var sId = $('#InputIndikatorSasaranId').val();
        var ind = $('#InputIndikatorText').val().trim();
        if (!ind) {
            alert('Nama Indikator tidak boleh kosong!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/InputSasaranIndikator',
            type: 'POST',
            data: {
                SasaranId: sId,
                Indikator: ind,
                Realisasi: $('#InputIndikatorRealisasi').val().trim(),
                Target1: $('#InputIndikatorTarget1').val().trim(),
                Target2: $('#InputIndikatorTarget2').val().trim(),
                Target3: $('#InputIndikatorTarget3').val().trim(),
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalInputIndikator').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Simpan');
                }
            }
        });
    });

    $(document).on('click', '.BtnEditIndikator', function() {
        var id = $(this).data('id');
        $('#EditIndikatorId').val(id);
        $('#EditIndikatorText').val($(this).data('indikator'));
        $('#EditIndikatorRealisasi').val($(this).data('realisasi'));
        $('#EditIndikatorTarget1').val($(this).data('target1'));
        $('#EditIndikatorTarget2').val($(this).data('target2'));
        $('#EditIndikatorTarget3').val($(this).data('target3'));
        $('#ModalEditIndikator').modal('show');
    });

    $('#BtnUpdateIndikator').on('click', function() {
        var id = $('#EditIndikatorId').val();
        var ind = $('#EditIndikatorText').val().trim();
        if (!ind) {
            alert('Nama Indikator tidak boleh kosong!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditSasaranIndikator',
            type: 'POST',
            data: {
                Id: id,
                Indikator: ind,
                Realisasi: $('#EditIndikatorRealisasi').val().trim(),
                Target1: $('#EditIndikatorTarget1').val().trim(),
                Target2: $('#EditIndikatorTarget2').val().trim(),
                Target3: $('#EditIndikatorTarget3').val().trim(),
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalEditIndikator').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Update');
                }
            }
        });
    });

    $(document).on('click', '.BtnHapusIndikator', function() {
        var id = $(this).data('id');
        if (!confirm('Yakin ingin menghapus Indikator ini?')) {
            return;
        }

        $.ajax({
            url: BaseURL + 'Daerah/HapusSasaranIndikator',
            type: 'POST',
            data: {
                Id: id,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                }
            }
        });
    });
});
</script>
