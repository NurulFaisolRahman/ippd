<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<?php
$can_edit = isset($_SESSION['Level']) && $_SESSION['Level'] == 3;

// Kelompokkan data keterkaitan berdasarkan ID Prioritas Nasional (id_pn)
$groupedKeterkaitan = [];
if (!empty($KeterkaitanList)) {
    foreach ($KeterkaitanList as $row) {
        $pnId = $row['id_pn'];
        if (!isset($groupedKeterkaitan[$pnId])) {
            $groupedKeterkaitan[$pnId] = [
                'id_pn' => $pnId,
                'kode_pn' => $row['kode_pn'],
                'nama_pn' => $row['nama_pn'],
                'p_daerah_list' => [],
                'rows' => []
            ];
        }

        // Kumpulkan P Daerah unik untuk header subgrup ini
        if (!empty($row['p_daerah_json'])) {
            $pArr = json_decode($row['p_daerah_json'], true);
            if (is_array($pArr)) {
                foreach ($pArr as $pItem) {
                    $pDisplay = !empty($pItem['display']) ? $pItem['display'] : (!empty($pItem['kode']) ? $pItem['kode'] . ': ' . $pItem['prioritas'] : $pItem['prioritas']);
                    if (!in_array($pDisplay, $groupedKeterkaitan[$pnId]['p_daerah_list'])) {
                        $groupedKeterkaitan[$pnId]['p_daerah_list'][] = $pDisplay;
                    }
                }
            }
        }

        $groupedKeterkaitan[$pnId]['rows'][] = $row;
    }
}
?>

<!-- Dependencies -->
<!-- Dependencies -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
    /* Custom Multiselect Dropdown */
    .custom-multiselect-box {
        position: relative;
        width: 100%;
    }
    .custom-multiselect-toggle {
        width: 100%;
        min-height: 38px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        user-select: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .custom-multiselect-toggle:hover {
        border-color: #94a3b8;
    }
    .custom-multiselect-toggle.active {
        border-color: #0284c7;
        box-shadow: 0 0 0 2px rgba(2, 132, 199, 0.15);
    }
    .custom-multiselect-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        margin-top: 4px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        z-index: 1060;
        max-height: 230px;
        overflow-y: auto;
        padding: 8px 10px;
    }
    .custom-multiselect-item {
        display: flex;
        align-items: flex-start;
        padding: 6px 8px;
        margin: 0;
        cursor: pointer;
        border-radius: 4px;
        transition: background 0.15s;
        font-weight: normal;
        font-size: 13px;
        color: #1e293b;
    }
    .custom-multiselect-item:hover {
        background-color: #f1f5f9;
    }
    .custom-multiselect-item input[type="checkbox"] {
        margin-right: 8px;
        margin-top: 3px;
        cursor: pointer;
    }

    .keterkaitan-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .keterkaitan-card-header {
        background: #f8fafc;
        padding: 16px 20px;
        border-bottom: 1.5px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .keterkaitan-title h3 {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
    }
    .keterkaitan-title p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Tabel Keterkaitan Indikator Sesuai Desain */
    .table-keterkaitan {
        width: 100%;
        border-collapse: collapse !important;
        font-size: 13px;
        margin-bottom: 0;
        border: 1.5px solid #1b4f72 !important;
    }
    .table-keterkaitan thead th {
        background: #1b4f72 !important;
        color: #ffffff !important;
        text-align: center;
        vertical-align: middle !important;
        font-weight: 700;
        font-size: 13px;
        padding: 12px 10px !important;
        border: 1px solid #2874a6 !important;
        line-height: 1.35;
    }
    .table-keterkaitan tbody td {
        vertical-align: top !important;
        padding: 10px 12px !important;
        border: 1px solid #cbd5e1 !important;
        line-height: 1.5;
        color: #1e293b;
        background-color: #ffffff;
    }
    .table-keterkaitan tbody tr.subgroup-header td {
        background: #e9ecef !important;
        font-weight: 700;
        color: #0f172a;
        padding: 11px 14px !important;
        border-top: 2px solid #1b4f72 !important;
        border-bottom: 2px solid #94a3b8 !important;
    }
    .table-keterkaitan tbody tr:not(.subgroup-header):hover td {
        background-color: #f8fafc;
    }

    .action-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
        align-items: center;
        justify-content: center;
    }
    .btn-action-custom {
        padding: 4px 8px;
        font-size: 11px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        opacity: 1 !important;
        transition: all 0.15s ease-in-out;
        border: none;
        display: inline-block;
        text-align: center;
        width: 100%;
        max-width: 60px;
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

    .indikator-nasional-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    .indikator-nasional-item {
        padding: 6px 10px;
        border-bottom: 1px solid #cbd5e1;
        line-height: 1.45;
        font-size: 13px;
        color: #1e293b;
        text-align: left;
    }
    .indikator-nasional-item:last-child {
        border-bottom: none;
    }

    .indikator-list-ol {
        padding-left: 20px;
        margin: 0;
    }
    .indikator-list-ol li {
        margin-bottom: 4px;
        line-height: 1.4;
    }

    .p-daerah-badge-item {
        margin-bottom: 4px;
        line-height: 1.35;
        font-weight: 700;
        color: #0f172a;
    }
    .p-daerah-badge-item:last-child {
        margin-bottom: 0;
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

                                <?php if ($can_edit) { ?>
                                <div>
                                    <button type="button" class="btn btn-sm btn-success notika-btn-success" id="BtnBukaModalTambah">
                                        <i class="fa fa-plus"></i> <b>Tambah Keterkaitan Indikator</b>
                                    </button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Card & Tabel Utama -->
                        <div class="keterkaitan-card">
                            <div class="keterkaitan-card-header">
                                <div class="keterkaitan-title">
                                    <h3>Keterkaitan Indikator Pembangunan Daerah (Tahun <?= html_escape($SelectedTahun) ?>)</h3>
                                    <p>Penyelarasan Sasaran & Indikator Prioritas Pembangunan Nasional (PN) dengan Prioritas & Sasaran Pembangunan Daerah</p>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table-keterkaitan">
                                    <thead>
                                        <tr>
                                            <th style="width: 25%;">Sasaran Prioritas Pembangunan Nasional</th>
                                            <th style="width: 25%;">Indikator Sasaran Prioritas Pembangunan Nasional</th>
                                            <th style="width: 25%;">Sasaran Pembangunan Daerah</th>
                                            <th style="width: <?= $can_edit ? '20%' : '25%' ?>;">Indikator Sasaran Pembangunan Daerah</th>
                                            <?php if ($can_edit) { ?>
                                                <th style="width: 5%; text-align: center;">Aksi</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($groupedKeterkaitan)) { ?>
                                            <tr>
                                                <td colspan="<?= $can_edit ? 5 : 4 ?>" class="text-center" style="padding: 40px !important;">
                                                    <div style="color: #64748b; font-size: 14px;">
                                                        Belum ada data Keterkaitan Indikator Pembangunan Daerah untuk Tahun <?= html_escape($SelectedTahun) ?>.<br>
                                                        <?php if ($can_edit) { ?>
                                                            <div style="margin-top: 14px;">
                                                                <button type="button" class="btn btn-sm btn-success notika-btn-success" id="BtnTambahEmpty">
                                                                    <i class="fa fa-plus"></i> Tambah Keterkaitan Baru
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php foreach ($groupedKeterkaitan as $g) { 
                                                $pnTitle = $g['kode_pn'] . ': ' . $g['nama_pn'];
                                            ?>
                                                <!-- Baris Subheader Prioritas Nasional & Prioritas Daerah -->
                                                <tr class="subgroup-header">
                                                    <td colspan="2">
                                                        <?= html_escape($pnTitle) ?>
                                                    </td>
                                                    <td colspan="<?= $can_edit ? 3 : 2 ?>">
                                                        <?php if (!empty($g['p_daerah_list'])) { ?>
                                                            <?php foreach ($g['p_daerah_list'] as $pItem) { ?>
                                                                <div class="p-daerah-badge-item">
                                                                    <?= html_escape($pItem) ?>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <span class="text-muted" style="font-weight: normal; font-style: italic;">(Belum ada Prioritas Daerah terpilih)</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <!-- Baris-Baris Keterkaitan di bawah subheader ini -->
                                                <?php foreach ($g['rows'] as $r) { 
                                                    // Parse Indikator Nasional
                                                    $indNasText = trim($r['indikator_nasional'] ?? '');
                                                    $indNasLines = [];
                                                    if (!empty($indNasText)) {
                                                        $rawLines = preg_split('/\r\n|\r|\n/', $indNasText);
                                                        $hasNumberedPattern = false;
                                                        foreach ($rawLines as $l) {
                                                            if (preg_match('/^\s*\d+[\.\)]\s+/', $l)) {
                                                                $hasNumberedPattern = true;
                                                                break;
                                                            }
                                                        }

                                                        if ($hasNumberedPattern) {
                                                            $currentItem = '';
                                                            foreach ($rawLines as $l) {
                                                                $lTrim = trim($l);
                                                                if (empty($lTrim)) continue;
                                                                if (preg_match('/^\s*(\d+)[\.\)]\s*(.*)$/', $lTrim, $matches)) {
                                                                    if (!empty($currentItem)) {
                                                                        $indNasLines[] = $currentItem;
                                                                    }
                                                                    $currentItem = $matches[2];
                                                                } else {
                                                                    if (!empty($currentItem)) {
                                                                        $currentItem .= ' ' . $lTrim;
                                                                    } else {
                                                                        $currentItem = $lTrim;
                                                                    }
                                                                }
                                                            }
                                                            if (!empty($currentItem)) {
                                                                $indNasLines[] = $currentItem;
                                                            }
                                                        } else {
                                                            foreach ($rawLines as $l) {
                                                                $lTrim = trim($l);
                                                                $lClean = preg_replace('/^\s*[\-\•\*\d+\.\)]\s*/', '', $lTrim);
                                                                if (!empty($lClean)) {
                                                                    $indNasLines[] = $lClean;
                                                                }
                                                            }
                                                        }
                                                    }

                                                    // Parse Indikator Daerah
                                                    $indDaeLines = [];
                                                    if (!empty($r['indikator_daerah_json'])) {
                                                        $indDaeArr = json_decode($r['indikator_daerah_json'], true);
                                                        if (is_array($indDaeArr)) {
                                                            foreach ($indDaeArr as $idItem) {
                                                                $itemTxt = is_array($idItem) ? ($idItem['indikator'] ?? '') : $idItem;
                                                                if (!empty(trim($itemTxt))) {
                                                                    $indDaeLines[] = trim($itemTxt);
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                                    <tr>
                                                        <!-- Kolom 1: Sasaran Prioritas Pembangunan Nasional -->
                                                        <td style="font-weight: 600;">
                                                            <div>
                                                                <?= !empty($r['kode_sasaran_nasional']) ? html_escape($r['kode_sasaran_nasional']) . '. ' : '' ?>
                                                                <?= html_escape($r['sasaran_nasional']) ?>
                                                            </div>
                                                        </td>

                                                        <!-- Kolom 2: Indikator Sasaran Prioritas Pembangunan Nasional -->
                                                        <td style="padding: 0 !important; vertical-align: top !important;">
                                                            <?php if (!empty($indNasLines)) { ?>
                                                                <div class="indikator-nasional-container">
                                                                    <?php foreach ($indNasLines as $idx => $indNas) { ?>
                                                                        <div class="indikator-nasional-item">
                                                                            <?= ($idx + 1) ?>. <?= html_escape($indNas) ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div style="padding: 10px 12px;">
                                                                    <span class="text-muted" style="font-style: italic;">-</span>
                                                                </div>
                                                            <?php } ?>
                                                        </td>

                                                        <!-- Kolom 3: Sasaran Pembangunan Daerah -->
                                                        <td style="font-weight: 600;">
                                                            <div>
                                                                <?= !empty($r['kode_sasaran_daerah']) ? html_escape($r['kode_sasaran_daerah']) . '. ' : '' ?>
                                                                <?= html_escape($r['sasaran_daerah']) ?>
                                                            </div>
                                                        </td>

                                                        <!-- Kolom 4: Indikator Sasaran Pembangunan Daerah -->
                                                        <td>
                                                            <?php if (!empty($indDaeLines)) { ?>
                                                                <?php foreach ($indDaeLines as $indDae) { ?>
                                                                    <div style="margin-bottom: 5px; line-height: 1.4;">
                                                                        <?= html_escape($indDae) ?>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <span class="text-muted" style="font-style: italic;">-</span>
                                                            <?php } ?>
                                                        </td>

                                                        <!-- Kolom 5: Aksi -->
                                                        <?php if ($can_edit) { ?>
                                                            <td class="text-center" style="vertical-align: middle !important;">
                                                                <div class="action-group">
                                                                    <button type="button" class="btn-action-custom btn-action-edit BtnEditKeterkaitan" 
                                                                        data-id="<?= $r['id'] ?>"
                                                                        data-id_pn="<?= $r['id_pn'] ?>"
                                                                        data-id_sasaran_nasional="<?= $r['id_sasaran_nasional'] ?? '' ?>"
                                                                        data-kode_sasaran_nasional="<?= html_escape($r['kode_sasaran_nasional'] ?? '') ?>"
                                                                        data-sasaran_nasional="<?= html_escape($r['sasaran_nasional']) ?>"
                                                                        data-indikator_nasional="<?= html_escape($r['indikator_nasional'] ?? '') ?>"
                                                                        data-p_daerah='<?= html_escape($r['p_daerah_json'] ?? '[]') ?>'
                                                                        data-id_sasaran_daerah="<?= $r['id_sasaran_daerah'] ?? '' ?>"
                                                                        data-kode_sasaran_daerah="<?= html_escape($r['kode_sasaran_daerah'] ?? '') ?>"
                                                                        data-sasaran_daerah="<?= html_escape($r['sasaran_daerah']) ?>"
                                                                        data-indikator_daerah='<?= html_escape($r['indikator_daerah_json'] ?? '[]') ?>'
                                                                        title="Edit Data">
                                                                        Edit
                                                                    </button>
                                                                    <button type="button" class="btn-action-custom btn-action-delete BtnHapusKeterkaitan" 
                                                                        data-id="<?= $r['id'] ?>" 
                                                                        title="Hapus Data">
                                                                        Hapus
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
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
MODAL TAMBAH KETERKAITAN INDIKATOR
============================================================ -->
<div class="modal fade" id="ModalInputKeterkaitan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Keterkaitan Indikator Pembangunan</b></h4>
            </div>
            <div class="modal-body">
                
                <!-- BAGIAN 1: SISI NASIONAL -->
                <div class="panel panel-default" style="border-left: 4px solid #1b4f72;">
                    <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #1b4f72;">
                        <i class="fa fa-landmark"></i> 1. Keterkaitan Prioritas & Sasaran Nasional
                    </div>
                    <div class="panel-body">
                        <!-- PN (Prioritas Nasional) -->
                        <div class="form-group">
                            <label><b>Prioritas Nasional (PN)</b> <span class="text-danger">*</span>:</label>
                            <select class="form-control" id="InputIdPN" style="color: #000; font-weight: 500;">
                                <option value="">-- Pilih Prioritas Nasional (PN) --</option>
                                <?php foreach ($PNMaster as $pn) { ?>
                                    <option value="<?= $pn['Id'] ?>">
                                        PN <?= $pn['Id'] ?>: <?= html_escape($pn['PrioritasNasional']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Sasaran Prioritas Pembangunan Nasional -->
                        <div class="form-group">
                            <label><b>Sasaran Prioritas Pembangunan Nasional</b> <span class="text-danger">*</span>:</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="InputKodeSasNas" placeholder="Kode (misal: S1)" style="color: #000;">
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="SelectSasaranNasional" style="color: #000;">
                                        <option value="">-- Pilih Sasaran Nasional (atau Ketik Manual) --</option>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: 8px;">
                                <textarea class="form-control" id="InputSasaranNasionalCustom" rows="2" placeholder="Atau ketik/edit rumusan sasaran prioritas pembangunan nasional di sini..." style="color: #000;"></textarea>
                            </div>
                        </div>

                        <!-- Indikator Sasaran Prioritas Pembangunan Nasional (Input Manual) -->
                        <div class="form-group" style="margin-bottom: 0;">
                            <label><b>Indikator Sasaran Prioritas Pembangunan Nasional</b> (Input Manual):</label>
                            <small class="text-muted" style="display: block; margin-bottom: 5px;">
                                * Ketik setiap indikator pada baris baru (tekan Enter). Di tabel akan otomatis ditampilkan bernomor urut 1, 2, 3...
                            </small>
                            <textarea class="form-control" id="InputIndikatorNasional" rows="4" placeholder="Contoh:&#10;Indeks Demokrasi Indonesia Aspek Kebebasan&#10;Indeks Aktualisasi Pancasila Aspek Rumah Tangga&#10;Indeks Kemerdekaan Pers" style="color: #000;"></textarea>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: SISI DAERAH -->
                <div class="panel panel-default" style="border-left: 4px solid #0369a1;">
                    <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #0369a1;">
                        <i class="fa fa-map-marker-alt"></i> 2. Keterkaitan Prioritas & Sasaran Pembangunan Daerah
                    </div>
                    <div class="panel-body">
                        <!-- Prioritas Pembangunan Daerah (P) -->
                        <div class="form-group">
                            <label><b>Prioritas Pembangunan Daerah (P)</b> (Bisa Pilih Lebih Dari Satu):</label>
                            <div class="custom-multiselect-box" id="BoxPDaerah">
                                <div class="custom-multiselect-toggle" id="TogglePDaerah">
                                    <span id="LabelPDaerahSelected" style="color: #64748b; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 90%;">
                                        -- Pilih Prioritas Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="CaretPDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="MenuPDaerah">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH SATU ATAU LEBIH:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="BtnSelectAllPDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="BtnClearPDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div id="ListPDaerahOptions">
                                        <?php if (!empty($PrioritasDaerahList)) { ?>
                                            <?php foreach ($PrioritasDaerahList as $pItem) { ?>
                                                <label class="custom-multiselect-item">
                                                    <input type="checkbox" class="CheckPDaerah" value="<?= $pItem['id'] ?>" data-kode="<?= html_escape($pItem['kode']) ?>" data-prioritas="<?= html_escape($pItem['prioritas']) ?>">
                                                    <span><b style="color: #0369a1;"><?= html_escape($pItem['kode']) ?>:</b> <?= html_escape($pItem['prioritas']) ?></span>
                                                </label>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <span class="text-danger" style="font-size: 12px; display: block; padding: 4px;">
                                                <i class="fa fa-exclamation-circle"></i> Belum ada data Prioritas Pembangunan Daerah pada menu Tema Pembangunan tahun <?= html_escape($SelectedTahun) ?>.
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sasaran Pembangunan Daerah -->
                        <div class="form-group">
                            <label><b>Sasaran Pembangunan Daerah</b> <span class="text-danger">*</span>:</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="InputKodeSasDaerah" placeholder="Kode (misal: S1)" style="color: #000;">
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="SelectSasaranDaerah" style="color: #000;">
                                        <option value="">-- Pilih dari Sasaran Pembangunan Daerah --</option>
                                        <?php foreach ($SasaranDaerahList as $sasDae) { ?>
                                            <option value="<?= $sasDae['id'] ?>" data-kode="<?= html_escape($sasDae['kode']) ?>" data-sasaran="<?= html_escape($sasDae['sasaran']) ?>">
                                                <?= html_escape($sasDae['label']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: 8px;">
                                <textarea class="form-control" id="InputSasaranDaerahCustom" rows="2" placeholder="Atau ketik/edit rumusan sasaran pembangunan daerah di sini..." style="color: #000;"></textarea>
                            </div>
                        </div>

                        <!-- Indikator Sasaran Pembangunan Daerah -->
                        <div class="form-group" style="margin-bottom: 0;">
                            <label><b>Indikator Sasaran Pembangunan Daerah</b> (Diambil dari Menu Sasaran Pembangunan):</label>
                            
                            <!-- Custom Multiselect Dropdown Indikator Daerah -->
                            <div class="custom-multiselect-box" id="BoxIndikatorDaerah" style="margin-bottom: 8px;">
                                <div class="custom-multiselect-toggle" id="ToggleIndikatorDaerah">
                                    <span id="LabelIndikatorDaerahSelected" style="color: #64748b; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 90%;">
                                        -- Pilih Indikator Sasaran Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="CaretIndikatorDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="MenuIndikatorDaerah" style="max-height: 250px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH INDIKATOR:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="BtnSelectAllIndikatorDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="BtnClearIndikatorDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div id="ListIndikatorDaerahOptions">
                                        <?php if (!empty($IndikatorDaerahMaster)) { ?>
                                            <?php foreach ($IndikatorDaerahMaster as $indItem) { ?>
                                                <label class="custom-multiselect-item item-ind-daerah" data-sasaran-id="<?= $indItem['sasaran_id'] ?>">
                                                    <input type="checkbox" class="CheckIndikatorDaerah" value="<?= html_escape($indItem['indikator']) ?>" data-sasaran-id="<?= $indItem['sasaran_id'] ?>" data-indikator="<?= html_escape($indItem['indikator']) ?>">
                                                    <span>
                                                        <b><?= html_escape($indItem['indikator']) ?></b>
                                                        <span class="text-muted" style="font-size: 11px; display: block;">Sasaran: <?= html_escape($indItem['sasaran']) ?></span>
                                                    </span>
                                                </label>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <span class="text-muted" style="font-size: 12px; display: block; padding: 6px;">
                                                <i class="fa fa-info-circle"></i> Belum ada data indikator pada Menu Sasaran Pembangunan Daerah tahun <?= html_escape($SelectedTahun) ?>.
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar Indikator Terpilih & Input Tambahan -->
                            <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 4px; padding: 10px;">
                                <label style="font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 4px; display: block;">
                                    Daftar Indikator Sasaran Terpilih:
                                </label>
                                <div id="BadgesIndikatorDaerah" style="display: flex; flex-wrap: wrap; gap: 6px; min-height: 28px; margin-bottom: 6px;">
                                    <span class="text-muted" style="font-style: italic; font-size: 12px; padding: 4px 0;">Belum ada indikator yang dipilih dari dropdown di atas.</span>
                                </div>
                                <small class="text-muted" style="display: block; margin-bottom: 4px;">
                                    * Anda juga dapat mengetik indikator tambahan pada baris baru di bawah ini jika diperlukan:
                                </small>
                                <textarea class="form-control" id="InputIndikatorDaerahCustom" rows="2" placeholder="Ketik indikator tambahan di sini (jika ada)..." style="color: #000; font-size: 12px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnSimpanKeterkaitan"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT KETERKAITAN INDIKATOR
============================================================ -->
<div class="modal fade" id="ModalEditKeterkaitan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Keterkaitan Indikator Pembangunan</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditKeterkaitanId">

                <!-- BAGIAN 1: SISI NASIONAL -->
                <div class="panel panel-default" style="border-left: 4px solid #1b4f72;">
                    <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #1b4f72;">
                        <i class="fa fa-landmark"></i> 1. Keterkaitan Prioritas & Sasaran Nasional
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label><b>Prioritas Nasional (PN)</b> <span class="text-danger">*</span>:</label>
                            <select class="form-control" id="EditIdPN" style="color: #000; font-weight: 500;">
                                <option value="">-- Pilih Prioritas Nasional (PN) --</option>
                                <?php foreach ($PNMaster as $pn) { ?>
                                    <option value="<?= $pn['Id'] ?>">
                                        PN <?= $pn['Id'] ?>: <?= html_escape($pn['PrioritasNasional']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><b>Sasaran Prioritas Pembangunan Nasional</b> <span class="text-danger">*</span>:</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="EditKodeSasNas" placeholder="Kode (misal: S1)" style="color: #000;">
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="EditSelectSasaranNasional" style="color: #000;">
                                        <option value="">-- Pilih Sasaran Nasional (atau Ketik Manual) --</option>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: 8px;">
                                <textarea class="form-control" id="EditSasaranNasionalCustom" rows="2" style="color: #000;"></textarea>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label><b>Indikator Sasaran Prioritas Pembangunan Nasional</b> (Input Manual):</label>
                            <small class="text-muted" style="display: block; margin-bottom: 5px;">
                                * Ketik setiap indikator pada baris baru (tekan Enter). Di tabel akan otomatis ditampilkan bernomor urut 1, 2, 3...
                            </small>
                            <textarea class="form-control" id="EditIndikatorNasional" rows="4" style="color: #000;"></textarea>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN 2: SISI DAERAH -->
                <div class="panel panel-default" style="border-left: 4px solid #0369a1;">
                    <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #0369a1;">
                        <i class="fa fa-map-marker-alt"></i> 2. Keterkaitan Prioritas & Sasaran Pembangunan Daerah
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label><b>Prioritas Pembangunan Daerah (P)</b> (Bisa Pilih Lebih Dari Satu):</label>
                            <div class="custom-multiselect-box" id="EditBoxPDaerah">
                                <div class="custom-multiselect-toggle" id="EditTogglePDaerah">
                                    <span id="EditLabelPDaerahSelected" style="color: #64748b; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 90%;">
                                        -- Pilih Prioritas Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="EditCaretPDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="EditMenuPDaerah">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH SATU ATAU LEBIH:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="EditBtnSelectAllPDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="EditBtnClearPDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div id="EditListPDaerahOptions">
                                        <?php if (!empty($PrioritasDaerahList)) { ?>
                                            <?php foreach ($PrioritasDaerahList as $pItem) { ?>
                                                <label class="custom-multiselect-item">
                                                    <input type="checkbox" class="EditCheckPDaerah" value="<?= $pItem['id'] ?>" data-kode="<?= html_escape($pItem['kode']) ?>" data-prioritas="<?= html_escape($pItem['prioritas']) ?>">
                                                    <span><b style="color: #0369a1;"><?= html_escape($pItem['kode']) ?>:</b> <?= html_escape($pItem['prioritas']) ?></span>
                                                </label>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><b>Sasaran Pembangunan Daerah</b> <span class="text-danger">*</span>:</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="EditKodeSasDaerah" placeholder="Kode (misal: S1)" style="color: #000;">
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="EditSelectSasaranDaerah" style="color: #000;">
                                        <option value="">-- Pilih dari Sasaran Pembangunan Daerah --</option>
                                        <?php foreach ($SasaranDaerahList as $sasDae) { ?>
                                            <option value="<?= $sasDae['id'] ?>" data-kode="<?= html_escape($sasDae['kode']) ?>" data-sasaran="<?= html_escape($sasDae['sasaran']) ?>">
                                                <?= html_escape($sasDae['label']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: 8px;">
                                <textarea class="form-control" id="EditSasaranDaerahCustom" rows="2" style="color: #000;"></textarea>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label><b>Indikator Sasaran Pembangunan Daerah</b> (Diambil dari Menu Sasaran Pembangunan):</label>
                            
                            <!-- Custom Multiselect Dropdown Indikator Daerah (Edit) -->
                            <div class="custom-multiselect-box" id="EditBoxIndikatorDaerah" style="margin-bottom: 8px;">
                                <div class="custom-multiselect-toggle" id="EditToggleIndikatorDaerah">
                                    <span id="EditLabelIndikatorDaerahSelected" style="color: #64748b; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 90%;">
                                        -- Pilih Indikator Sasaran Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="EditCaretIndikatorDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="EditMenuIndikatorDaerah" style="max-height: 250px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH INDIKATOR:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="EditBtnSelectAllIndikatorDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="EditBtnClearIndikatorDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div id="EditListIndikatorDaerahOptions">
                                        <?php if (!empty($IndikatorDaerahMaster)) { ?>
                                            <?php foreach ($IndikatorDaerahMaster as $indItem) { ?>
                                                <label class="custom-multiselect-item edit-item-ind-daerah" data-sasaran-id="<?= $indItem['sasaran_id'] ?>">
                                                    <input type="checkbox" class="EditCheckIndikatorDaerah" value="<?= html_escape($indItem['indikator']) ?>" data-sasaran-id="<?= $indItem['sasaran_id'] ?>" data-indikator="<?= html_escape($indItem['indikator']) ?>">
                                                    <span>
                                                        <b><?= html_escape($indItem['indikator']) ?></b>
                                                        <span class="text-muted" style="font-size: 11px; display: block;">Sasaran: <?= html_escape($indItem['sasaran']) ?></span>
                                                    </span>
                                                </label>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <span class="text-muted" style="font-size: 12px; display: block; padding: 6px;">
                                                <i class="fa fa-info-circle"></i> Belum ada data indikator pada Menu Sasaran Pembangunan Daerah tahun <?= html_escape($SelectedTahun) ?>.
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Daftar Indikator Terpilih & Input Tambahan (Edit) -->
                            <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 4px; padding: 10px;">
                                <label style="font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 4px; display: block;">
                                    Daftar Indikator Sasaran Terpilih:
                                </label>
                                <div id="EditBadgesIndikatorDaerah" style="display: flex; flex-wrap: wrap; gap: 6px; min-height: 28px; margin-bottom: 6px;">
                                    <span class="text-muted" style="font-style: italic; font-size: 12px; padding: 4px 0;">Belum ada indikator yang dipilih dari dropdown di atas.</span>
                                </div>
                                <small class="text-muted" style="display: block; margin-bottom: 4px;">
                                    * Anda juga dapat mengetik indikator tambahan pada baris baru di bawah ini jika diperlukan:
                                </small>
                                <textarea class="form-control" id="EditInputIndikatorDaerahCustom" rows="2" placeholder="Ketik indikator tambahan di sini (jika ada)..." style="color: #000; font-size: 12px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnUpdateKeterkaitan"><b>Update</b></button>
            </div>
        </div>
    </div>
</div>

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

    // Helper: Load Sasaran Nasional by PN
    function loadSasaranNasional(idPn, targetSelect, callback) {
        if (!idPn) {
            targetSelect.html('<option value="">-- Pilih Sasaran Nasional (atau Ketik Manual) --</option>');
            if (callback) callback();
            return;
        }

        $.ajax({
            url: BaseURL + 'Daerah/GetSasaranNasionalByPN',
            type: 'GET',
            data: { id_pn: idPn },
            dataType: 'json',
            success: function(res) {
                var html = '<option value="">-- Pilih Sasaran Nasional (atau Ketik Manual) --</option>';
                if (res && res.length > 0) {
                    $.each(res, function(i, item) {
                        html += '<option value="' + item.id + '" data-kode="' + item.kode + '" data-sasaran="' + item.sasaran + '">' + item.label + '</option>';
                    });
                }
                targetSelect.html(html);
                if (callback) callback(res);
            }
        });
    }

    // Helper: Load Indikator Daerah by Sasaran ID
    function loadIndikatorDaerah(sasaranId, targetContainer, checkedItems) {
        if (!sasaranId) {
            targetContainer.html('<span class="text-muted" style="font-style: italic; font-size: 12px;">Pilih Sasaran Pembangunan Daerah di atas untuk memuat daftar indikator terkait...</span>');
            return;
        }

        targetContainer.html('<span class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat indikator...</span>');

        $.ajax({
            url: BaseURL + 'Daerah/GetIndikatorBySasaranDaerah',
            type: 'GET',
            data: { sasaran_id: sasaranId },
            dataType: 'json',
            success: function(res) {
                if (res && res.length > 0) {
                    var html = '';
                    $.each(res, function(i, item) {
                        var isChecked = false;
                        if (checkedItems && checkedItems.length > 0) {
                            if (checkedItems.indexOf(item.indikator) !== -1 || checkedItems.indexOf(String(item.id)) !== -1) {
                                isChecked = true;
                            }
                        } else {
                            // Default checked all
                            isChecked = true;
                        }

                        html += '<div class="checkbox" style="margin-top: 4px; margin-bottom: 6px;">';
                        html += '<label style="font-weight: normal; color: #1e293b;">';
                        html += '<input type="checkbox" class="CheckIndikatorDaerahItem" value="' + item.indikator.replace(/"/g, '&quot;') + '" ' + (isChecked ? 'checked' : '') + '>';
                        html += ' ' + item.indikator;
                        html += '</label>';
                        html += '</div>';
                    });
                    targetContainer.html(html);
                } else {
                    targetContainer.html('<span class="text-warning" style="font-size: 12px;"><i class="fa fa-info-circle"></i> Sasaran ini belum memiliki indikator di menu Sasaran Pembangunan Daerah.</span>');
                }
            }
        });
    }

    // ============================================================
    // CUSTOM MULTISELECT DROPDOWN PRIORITAS DAERAH (P)
    // ============================================================
    // ============================================================
    // CUSTOM MULTISELECT DROPDOWN PRIORITAS DAERAH (P)
    // ============================================================
    // Toggle Menu Tambah (P Daerah)
    $('#TogglePDaerah').on('click', function(e) {
        e.stopPropagation();
        var menu = $('#MenuPDaerah');
        var isVisible = menu.is(':visible');
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
        if (!isVisible) {
            menu.show();
            $(this).addClass('active');
            $('#CaretPDaerah').css('transform', 'rotate(180deg)');
        }
    });

    // Toggle Menu Edit (P Daerah)
    $('#EditTogglePDaerah').on('click', function(e) {
        e.stopPropagation();
        var menu = $('#EditMenuPDaerah');
        var isVisible = menu.is(':visible');
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
        if (!isVisible) {
            menu.show();
            $(this).addClass('active');
            $('#EditCaretPDaerah').css('transform', 'rotate(180deg)');
        }
    });

    // ============================================================
    // CUSTOM MULTISELECT DROPDOWN INDIKATOR DAERAH
    // ============================================================
    // Toggle Menu Tambah (Indikator Daerah)
    $('#ToggleIndikatorDaerah').on('click', function(e) {
        e.stopPropagation();
        var menu = $('#MenuIndikatorDaerah');
        var isVisible = menu.is(':visible');
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
        if (!isVisible) {
            menu.show();
            $(this).addClass('active');
            $('#CaretIndikatorDaerah').css('transform', 'rotate(180deg)');
        }
    });

    // Toggle Menu Edit (Indikator Daerah)
    $('#EditToggleIndikatorDaerah').on('click', function(e) {
        e.stopPropagation();
        var menu = $('#EditMenuIndikatorDaerah');
        var isVisible = menu.is(':visible');
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
        if (!isVisible) {
            menu.show();
            $(this).addClass('active');
            $('#EditCaretIndikatorDaerah').css('transform', 'rotate(180deg)');
        }
    });

    // Cegah penutupan saat klik di dalam menu
    $('.custom-multiselect-menu').on('click', function(e) {
        e.stopPropagation();
    });

    // Tutup saat klik di luar
    $(document).on('click', function() {
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
    });

    // Update Label Tampilan P Daerah
    function updatePDaerahDisplay(isEdit) {
        var checkClass = isEdit ? '.EditCheckPDaerah' : '.CheckPDaerah';
        var labelElem = isEdit ? $('#EditLabelPDaerahSelected') : $('#LabelPDaerahSelected');

        var checked = $(checkClass + ':checked');
        if (checked.length === 0) {
            labelElem.html('<span style="color: #64748b;">-- Pilih Prioritas Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --</span>');
        } else if (checked.length === 1) {
            var first = checked.first();
            var kd = first.data('kode') || '';
            var pri = first.data('prioritas') || '';
            labelElem.html('<span class="label label-primary" style="font-size: 11px; margin-right: 5px;">' + kd + '</span> <span style="color: #0f172a; font-weight: 600;">' + pri + '</span>');
        } else {
            var kodes = [];
            checked.each(function() {
                var kd = $(this).data('kode');
                if (kd) kodes.push(kd);
            });
            labelElem.html('<span class="badge" style="background: #0284c7; margin-right: 6px;">' + checked.length + ' Dipilih:</span> <span style="color: #0f172a; font-weight: 600;">' + kodes.join(', ') + '</span>');
        }
    }

    $(document).on('change', '.CheckPDaerah', function() {
        updatePDaerahDisplay(false);
    });
    $(document).on('change', '.EditCheckPDaerah', function() {
        updatePDaerahDisplay(true);
    });

    $('#BtnSelectAllPDaerah').on('click', function(e) {
        e.preventDefault();
        $('.CheckPDaerah').prop('checked', true);
        updatePDaerahDisplay(false);
    });

    $('#BtnClearPDaerah').on('click', function(e) {
        e.preventDefault();
        $('.CheckPDaerah').prop('checked', false);
        updatePDaerahDisplay(false);
    });

    $('#EditBtnSelectAllPDaerah').on('click', function(e) {
        e.preventDefault();
        $('.EditCheckPDaerah').prop('checked', true);
        updatePDaerahDisplay(true);
    });

    $('#EditBtnClearPDaerah').on('click', function(e) {
        e.preventDefault();
        $('.EditCheckPDaerah').prop('checked', false);
        updatePDaerahDisplay(true);
    });

    // Update Tampilan Indikator Daerah (Dropdown & Badges)
    function updateIndikatorDaerahDisplay(isEdit) {
        var checkClass = isEdit ? '.EditCheckIndikatorDaerah' : '.CheckIndikatorDaerah';
        var labelElem = isEdit ? $('#EditLabelIndikatorDaerahSelected') : $('#LabelIndikatorDaerahSelected');
        var badgesElem = isEdit ? $('#EditBadgesIndikatorDaerah') : $('#BadgesIndikatorDaerah');

        var checked = $(checkClass + ':checked');
        if (checked.length === 0) {
            labelElem.html('<span style="color: #64748b;">-- Pilih Indikator Sasaran Daerah (Bisa Pilih Lebih Dari Satu) --</span>');
            badgesElem.html('<span class="text-muted" style="font-style: italic; font-size: 12px; padding: 4px 0;">Belum ada indikator yang dipilih dari dropdown di atas.</span>');
        } else {
            var items = [];
            var badgesHtml = '';
            checked.each(function() {
                var val = $(this).val();
                items.push(val);
                var removeClass = isEdit ? 'remove-badge-edit-ind' : 'remove-badge-ind';
                badgesHtml += '<span class="label label-info" style="font-size: 11.5px; padding: 5px 8px; font-weight: 500; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 2px;">' +
                    '• ' + val +
                    ' <i class="fa fa-times ' + removeClass + '" data-val="' + val.replace(/"/g, '&quot;') + '" style="cursor: pointer; margin-left: 4px;" title="Hapus"></i>' +
                    '</span> ';
            });
            labelElem.html('<span class="badge" style="background: #0284c7; margin-right: 6px;">' + checked.length + ' Dipilih:</span> <span style="color: #0f172a; font-weight: 600;">' + items.join(', ') + '</span>');
            badgesElem.html(badgesHtml);
        }
    }

    $(document).on('change', '.CheckIndikatorDaerah', function() {
        updateIndikatorDaerahDisplay(false);
    });
    $(document).on('change', '.EditCheckIndikatorDaerah', function() {
        updateIndikatorDaerahDisplay(true);
    });

    $(document).on('click', '.remove-badge-ind', function() {
        var val = $(this).data('val');
        $('.CheckIndikatorDaerah[value="' + val + '"]').prop('checked', false);
        updateIndikatorDaerahDisplay(false);
    });

    $(document).on('click', '.remove-badge-edit-ind', function() {
        var val = $(this).data('val');
        $('.EditCheckIndikatorDaerah[value="' + val + '"]').prop('checked', false);
        updateIndikatorDaerahDisplay(true);
    });

    $('#BtnSelectAllIndikatorDaerah').on('click', function(e) {
        e.preventDefault();
        $('#ListIndikatorDaerahOptions .item-ind-daerah:visible .CheckIndikatorDaerah').prop('checked', true);
        updateIndikatorDaerahDisplay(false);
    });

    $('#BtnClearIndikatorDaerah').on('click', function(e) {
        e.preventDefault();
        $('.CheckIndikatorDaerah').prop('checked', false);
        updateIndikatorDaerahDisplay(false);
    });

    $('#EditBtnSelectAllIndikatorDaerah').on('click', function(e) {
        e.preventDefault();
        $('#EditListIndikatorDaerahOptions .edit-item-ind-daerah:visible .EditCheckIndikatorDaerah').prop('checked', true);
        updateIndikatorDaerahDisplay(true);
    });

    $('#EditBtnClearIndikatorDaerah').on('click', function(e) {
        e.preventDefault();
        $('.EditCheckIndikatorDaerah').prop('checked', false);
        updateIndikatorDaerahDisplay(true);
    });

    // Buka Modal Tambah
    $('#BtnBukaModalTambah, #BtnTambahEmpty').on('click', function() {
        $('#InputIdPN').val('');
        $('#InputKodeSasNas').val('');
        $('#SelectSasaranNasional').html('<option value="">-- Pilih Sasaran Nasional (atau Ketik Manual) --</option>');
        $('#InputSasaranNasionalCustom').val('');
        $('#InputIndikatorNasional').val('');
        $('.CheckPDaerah').prop('checked', false);
        updatePDaerahDisplay(false);
        $('.CheckIndikatorDaerah').prop('checked', false);
        $('#ListIndikatorDaerahOptions .item-ind-daerah').show();
        updateIndikatorDaerahDisplay(false);
        $('#InputIndikatorDaerahCustom').val('');
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('#InputKodeSasDaerah').val('');
        $('#SelectSasaranDaerah').val('');
        $('#InputSasaranDaerahCustom').val('');
        $('#ModalInputKeterkaitan').modal('show');
    });

    // Event saat PN dipilih (Tambah)
    $('#InputIdPN').on('change', function() {
        var idPn = $(this).val();
        loadSasaranNasional(idPn, $('#SelectSasaranNasional'));
    });

    // Event saat Sasaran Nasional dipilih dari dropdown (Tambah)
    $('#SelectSasaranNasional').on('change', function() {
        var opt = $(this).find(':selected');
        var sasText = opt.data('sasaran');
        var kode = opt.data('kode');
        if (sasText) {
            $('#InputSasaranNasionalCustom').val(sasText);
            if (kode && !$('#InputKodeSasNas').val()) {
                $('#InputKodeSasNas').val(kode);
            }
        }
    });

    // Event saat Sasaran Daerah dipilih (Tambah)
    $('#SelectSasaranDaerah').on('change', function() {
        var sasId = $(this).val();
        var opt = $(this).find(':selected');
        var sasText = opt.data('sasaran');
        var kode = opt.data('kode');

        if (sasText) {
            $('#InputSasaranDaerahCustom').val(sasText);
            $('#InputKodeSasDaerah').val(kode || '');
        }

        // Filter dan otomatis pilih indikator yang sesuai dengan sasaran daerah tersebut
        if (sasId) {
            var matching = $('#ListIndikatorDaerahOptions .item-ind-daerah[data-sasaran-id="' + sasId + '"]');
            if (matching.length > 0) {
                matching.find('.CheckIndikatorDaerah').prop('checked', true);
            }
        }
        updateIndikatorDaerahDisplay(false);
    });

    // Simpan Keterkaitan (Tambah)
    $('#BtnSimpanKeterkaitan').on('click', function() {
        var idPn = $('#InputIdPN').val();
        var idSasNas = $('#SelectSasaranNasional').val();
        var kodeSasNas = $('#InputKodeSasNas').val().trim();
        var sasNasCustom = $('#InputSasaranNasionalCustom').val().trim();
        var indNas = $('#InputIndikatorNasional').val().trim();

        // P Daerah
        var pDaerahIds = [];
        $('.CheckPDaerah:checked').each(function() {
            pDaerahIds.push($(this).val());
        });

        // Sasaran Daerah
        var idSasDae = $('#SelectSasaranDaerah').val();
        var kodeSasDae = $('#InputKodeSasDaerah').val().trim();
        var sasDaeCustom = $('#InputSasaranDaerahCustom').val().trim();

        // Indikator Daerah (Dropdown Checked + Custom Textarea)
        var indDaerah = [];
        $('.CheckIndikatorDaerah:checked').each(function() {
            var val = $(this).val().trim();
            if (val && indDaerah.indexOf(val) === -1) {
                indDaerah.push(val);
            }
        });
        var customInd = $('#InputIndikatorDaerahCustom').val();
        if (customInd) {
            var lines = customInd.split('\n');
            $.each(lines, function(i, l) {
                var lTrim = l.trim();
                if (lTrim && indDaerah.indexOf(lTrim) === -1) {
                    indDaerah.push(lTrim);
                }
            });
        }

        if (!idPn) {
            alert('Prioritas Nasional (PN) wajib dipilih!');
            return;
        }
        if (!sasNasCustom) {
            alert('Sasaran Prioritas Pembangunan Nasional wajib diisi!');
            return;
        }
        if (!sasDaeCustom) {
            alert('Sasaran Pembangunan Daerah wajib dipilih atau diisi!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/InputKeterkaitanIndikator',
            type: 'POST',
            data: {
                Tahun: SelectedTahun,
                KodeWilayah: KodeWilayah,
                IdPN: idPn,
                IdSasaranNasional: idSasNas,
                KodeSasaranNasional: kodeSasNas,
                SasaranNasionalCustom: sasNasCustom,
                IndikatorNasional: indNas,
                PDaerahIds: pDaerahIds,
                IdSasaranDaerah: idSasDae,
                KodeSasaranDaerah: kodeSasDae,
                SasaranDaerahCustom: sasDaeCustom,
                IndikatorDaerah: indDaerah,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalInputKeterkaitan').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Simpan');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan koneksi server!');
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // EDIT KETERKAITAN
    // ============================================================
    $(document).on('click', '.BtnEditKeterkaitan', function() {
        var id = $(this).data('id');
        var idPn = $(this).data('id_pn');
        var idSasNas = $(this).data('id_sasaran_nasional');
        var kodeSasNas = $(this).data('kode_sasaran_nasional');
        var sasNas = $(this).data('sasaran_nasional');
        var indNas = $(this).data('indikator_nasional');
        var pDaerahJson = $(this).data('p_daerah');
        var idSasDae = $(this).data('id_sasaran_daerah');
        var kodeSasDae = $(this).data('kode_sasaran_daerah');
        var sasDae = $(this).data('sasaran_daerah');
        var indDaeJson = $(this).data('indikator_daerah');

        $('#EditKeterkaitanId').val(id);
        $('#EditIdPN').val(idPn);
        $('#EditKodeSasNas').val(kodeSasNas);
        $('#EditSasaranNasionalCustom').val(sasNas);
        $('#EditIndikatorNasional').val(indNas);

        // Set P Daerah di Multiselect
        $('.EditCheckPDaerah').prop('checked', false);
        if (pDaerahJson && pDaerahJson.length > 0) {
            $.each(pDaerahJson, function(i, p) {
                $('.EditCheckPDaerah[value="' + p.id + '"]').prop('checked', true);
            });
        }
        updatePDaerahDisplay(true);
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');

        // Sasaran Daerah
        $('#EditKodeSasDaerah').val(kodeSasDae);
        $('#EditSelectSasaranDaerah').val(idSasDae || '');
        $('#EditSasaranDaerahCustom').val(sasDae);

        // Load Sasaran Nasional
        loadSasaranNasional(idPn, $('#EditSelectSasaranNasional'), function() {
            if (idSasNas) {
                $('#EditSelectSasaranNasional').val(idSasNas);
            }
        });

        // Set Indikator Daerah di Multiselect
        $('.EditCheckIndikatorDaerah').prop('checked', false);
        var unhandledIndikator = [];
        if (indDaeJson && indDaeJson.length > 0) {
            $.each(indDaeJson, function(i, item) {
                var indText = typeof item === 'object' ? (item.indikator || '') : item;
                indText = indText.trim();
                var foundCb = $('.EditCheckIndikatorDaerah[value="' + indText + '"]');
                if (foundCb.length > 0) {
                    foundCb.prop('checked', true);
                } else if (indText) {
                    unhandledIndikator.push(indText);
                }
            });
        }
        updateIndikatorDaerahDisplay(true);
        $('#EditInputIndikatorDaerahCustom').val(unhandledIndikator.join('\n'));

        $('#ModalEditKeterkaitan').modal('show');
    });

    $('#EditIdPN').on('change', function() {
        var idPn = $(this).val();
        loadSasaranNasional(idPn, $('#EditSelectSasaranNasional'));
    });

    $('#EditSelectSasaranNasional').on('change', function() {
        var opt = $(this).find(':selected');
        var sasText = opt.data('sasaran');
        var kode = opt.data('kode');
        if (sasText) {
            $('#EditSasaranNasionalCustom').val(sasText);
            if (kode && !$('#EditKodeSasNas').val()) {
                $('#EditKodeSasNas').val(kode);
            }
        }
    });

    $('#EditSelectSasaranDaerah').on('change', function() {
        var sasId = $(this).val();
        var opt = $(this).find(':selected');
        var sasText = opt.data('sasaran');
        var kode = opt.data('kode');

        if (sasText) {
            $('#EditSasaranDaerahCustom').val(sasText);
            $('#EditKodeSasDaerah').val(kode || '');
        }

        if (sasId) {
            var matching = $('#EditListIndikatorDaerahOptions .edit-item-ind-daerah[data-sasaran-id="' + sasId + '"]');
            if (matching.length > 0) {
                matching.find('.EditCheckIndikatorDaerah').prop('checked', true);
            }
        }
        updateIndikatorDaerahDisplay(true);
    });

    $('#BtnUpdateKeterkaitan').on('click', function() {
        var id = $('#EditKeterkaitanId').val();
        var idPn = $('#EditIdPN').val();
        var idSasNas = $('#EditSelectSasaranNasional').val();
        var kodeSasNas = $('#EditKodeSasNas').val().trim();
        var sasNasCustom = $('#EditSasaranNasionalCustom').val().trim();
        var indNas = $('#EditIndikatorNasional').val().trim();

        var pDaerahIds = [];
        $('.EditCheckPDaerah:checked').each(function() {
            pDaerahIds.push($(this).val());
        });

        var idSasDae = $('#EditSelectSasaranDaerah').val();
        var kodeSasDae = $('#EditKodeSasDaerah').val().trim();
        var sasDaeCustom = $('#EditSasaranDaerahCustom').val().trim();

        // Indikator Daerah (Dropdown Checked + Custom Textarea)
        var indDaerah = [];
        $('.EditCheckIndikatorDaerah:checked').each(function() {
            var val = $(this).val().trim();
            if (val && indDaerah.indexOf(val) === -1) {
                indDaerah.push(val);
            }
        });
        var customInd = $('#EditInputIndikatorDaerahCustom').val();
        if (customInd) {
            var lines = customInd.split('\n');
            $.each(lines, function(i, l) {
                var lTrim = l.trim();
                if (lTrim && indDaerah.indexOf(lTrim) === -1) {
                    indDaerah.push(lTrim);
                }
            });
        }

        if (!idPn) {
            alert('Prioritas Nasional (PN) wajib dipilih!');
            return;
        }
        if (!sasNasCustom) {
            alert('Sasaran Prioritas Pembangunan Nasional wajib diisi!');
            return;
        }
        if (!sasDaeCustom) {
            alert('Sasaran Pembangunan Daerah wajib dipilih atau diisi!');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditKeterkaitanIndikator',
            type: 'POST',
            data: {
                Id: id,
                Tahun: SelectedTahun,
                KodeWilayah: KodeWilayah,
                IdPN: idPn,
                IdSasaranNasional: idSasNas,
                KodeSasaranNasional: kodeSasNas,
                SasaranNasionalCustom: sasNasCustom,
                IndikatorNasional: indNas,
                PDaerahIds: pDaerahIds,
                IdSasaranDaerah: idSasDae,
                KodeSasaranDaerah: kodeSasDae,
                SasaranDaerahCustom: sasDaeCustom,
                IndikatorDaerah: indDaerah,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ModalEditKeterkaitan').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).text('Update');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan koneksi server!');
                btn.prop('disabled', false).text('Update');
            }
        });
    });

    // ============================================================
    // HAPUS KETERKAITAN
    // ============================================================
    $(document).on('click', '.BtnHapusKeterkaitan', function() {
        var id = $(this).data('id');
        if (!confirm('Yakin ingin menghapus data keterkaitan indikator ini?')) {
            return;
        }

        $.ajax({
            url: BaseURL + 'Daerah/HapusKeterkaitanIndikator',
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
            },
            error: function(xhr) {
                alert('Terjadi kesalahan koneksi server!');
            }
        });
    });

    // Filter Provinsi/KabKota
    $('#Provinsi').on('change', function() {
        var kodeProv = $(this).val();
        if (kodeProv) {
            $.ajax({
                url: BaseURL + 'Daerah/GetKabKota',
                type: 'POST',
                data: {
                    Kode: kodeProv,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(res) {
                    var html = '<option value="">Pilih Kab/Kota</option>';
                    $.each(res, function(i, item) {
                        html += '<option value="' + item.Kode + '">' + item.Nama + '</option>';
                    });
                    $('#KabKota').html(html);
                }
            });
        } else {
            $('#KabKota').html('<option value="">Pilih Kab/Kota</option>');
        }
    });

    $('#Filter').on('click', function() {
        var prov = $('#Provinsi').val();
        var kabKota = $('#KabKota').val();
        var kode = kabKota ? kabKota : prov;
        if (!kode) {
            alert('Pilih Provinsi atau Kab/Kota terlebih dahulu!');
            return;
        }
        var url = new URL(window.location.href);
        url.searchParams.set('kode_wilayah', kode);
        window.location.href = url.toString();
    });
});
</script>
