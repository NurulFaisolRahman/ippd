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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<style>
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
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    .select2-dropdown {
        border: 1.5px solid #94a3b8 !important;
        border-radius: 6px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        z-index: 999999999 !important;
        font-size: 13px !important;
    }
    .select2-search--dropdown .select2-search__field {
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
        padding: 5px 8px !important;
    }

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

    /* ============================================================
       MODAL SCROLLABLE & VIEWPORT FIX
       Mengatasi modal yang tidak bisa di-scroll akibat benturan
       vertical centering (:before) di header & konten form yang panjang
       ============================================================ */
    #ModalInputKeterkaitan,
    #ModalEditKeterkaitan {
        z-index: 105000 !important;
        overflow-y: auto !important;
        padding-right: 0 !important;
    }
    .modal-backdrop {
        z-index: 104990 !important;
    }
    #ModalInputKeterkaitan:before,
    #ModalEditKeterkaitan:before {
        display: none !important;
        height: 0 !important;
        content: none !important;
    }
    #ModalInputKeterkaitan .modal-dialog,
    #ModalEditKeterkaitan .modal-dialog {
        display: block !important;
        margin: 20px auto !important;
        max-width: 96vw !important;
        width: 96% !important;
        vertical-align: top !important;
    }
    #ModalInputKeterkaitan .modal-content,
    #ModalEditKeterkaitan .modal-content {
        max-height: calc(100vh - 60px) !important;
        display: flex !important;
        flex-direction: column !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25) !important;
    }
    #ModalInputKeterkaitan .modal-header,
    #ModalEditKeterkaitan .modal-header {
        flex-shrink: 0 !important;
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 15px 20px !important;
    }
    #ModalInputKeterkaitan .modal-body,
    #ModalEditKeterkaitan .modal-body {
        flex: 1 1 auto !important;
        overflow-y: auto !important;
        max-height: calc(100vh - 180px) !important;
        padding: 20px !important;
        background: #fdfdfd !important;
    }
    #ModalInputKeterkaitan .modal-footer,
    #ModalEditKeterkaitan .modal-footer {
        flex-shrink: 0 !important;
        background: #f8fafc !important;
        border-top: 1px solid #e2e8f0 !important;
        padding: 12px 20px !important;
        margin-top: 0 !important;
    }

    /* Styling Scrollbar Modal Body */
    #ModalInputKeterkaitan .modal-body::-webkit-scrollbar,
    #ModalEditKeterkaitan .modal-body::-webkit-scrollbar {
        width: 8px;
    }
    #ModalInputKeterkaitan .modal-body::-webkit-scrollbar-track,
    #ModalEditKeterkaitan .modal-body::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    #ModalInputKeterkaitan .modal-body::-webkit-scrollbar-thumb,
    #ModalEditKeterkaitan .modal-body::-webkit-scrollbar-thumb {
        background: #0284c7;
        border-radius: 4px;
    }
    #ModalInputKeterkaitan .modal-body::-webkit-scrollbar-thumb:hover,
    #ModalEditKeterkaitan .modal-body::-webkit-scrollbar-thumb:hover {
        background: #0369a1;
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
        display: inline-flex;
        flex-direction: row;
        gap: 6px;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }
    .btn-action-custom {
        width: 30px;
        height: 30px;
        padding: 0;
        font-size: 13px;
        border-radius: 4px;
        cursor: pointer;
        opacity: 1 !important;
        transition: all 0.15s ease-in-out;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    .btn-action-custom i {
        pointer-events: none;
    }
    .btn-action-edit {
        background: #f0ad4e !important;
        border: 1px solid #eea236 !important;
        color: #ffffff !important;
    }
    .btn-action-edit:hover {
        background: #ec971f !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }
    .btn-action-delete {
        background: #d9534f !important;
        border: 1px solid #d43f3a !important;
        color: #ffffff !important;
    }
    .btn-action-delete:hover {
        background: #c9302c !important;
        color: #ffffff !important;
        transform: translateY(-1px);
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
                                    <button type="button" class="btn btn-sm btn-success notika-btn-success" id="BtnBukaModalTambah" data-toggle="modal" data-target="#ModalInputKeterkaitan">
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
                                                <th style="width: 75px; text-align: center;">Aksi</th>
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
                                                                <button type="button" class="btn btn-sm btn-success notika-btn-success" id="BtnTambahEmpty" data-toggle="modal" data-target="#ModalInputKeterkaitan">
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
                                                <?php 
                                                // Kelompokkan baris berdasarkan Sasaran Daerah & Indikator Daerah agar cell dapat di-merge jika sama
                                                $daerahSubgroups = [];
                                                foreach ($g['rows'] as $r) {
                                                    $dKey = (!empty($r['id_sasaran_daerah']) ? $r['id_sasaran_daerah'] : trim($r['sasaran_daerah']))
                                                          . '|||' . trim($r['indikator_daerah_json'] ?? '');
                                                    if (!isset($daerahSubgroups[$dKey])) {
                                                        $daerahSubgroups[$dKey] = [
                                                            'id_sasaran_daerah'     => $r['id_sasaran_daerah'] ?? '',
                                                            'kode_sasaran_daerah'   => $r['kode_sasaran_daerah'] ?? '',
                                                            'sasaran_daerah'        => $r['sasaran_daerah'] ?? '',
                                                            'indikator_daerah_json' => $r['indikator_daerah_json'] ?? '',
                                                            'rows'                  => []
                                                        ];
                                                    }
                                                    $daerahSubgroups[$dKey]['rows'][] = $r;
                                                }

                                                foreach ($daerahSubgroups as $dGroup) { 
                                                    $dRowCount = count($dGroup['rows']);

                                                    // Parse Indikator Daerah untuk grup ini
                                                    $indDaeLines = [];
                                                    if (!empty($dGroup['indikator_daerah_json'])) {
                                                        $indDaeArr = json_decode($dGroup['indikator_daerah_json'], true);
                                                        if (is_array($indDaeArr)) {
                                                            foreach ($indDaeArr as $idItem) {
                                                                $itemTxt = is_array($idItem) ? ($idItem['indikator'] ?? '') : $idItem;
                                                                if (!empty(trim($itemTxt))) {
                                                                    $indDaeLines[] = trim($itemTxt);
                                                                }
                                                            }
                                                        }
                                                    }

                                                    foreach ($dGroup['rows'] as $idx => $r) {
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
                                                                    <?php foreach ($indNasLines as $nIdx => $indNas) { ?>
                                                                        <div class="indikator-nasional-item">
                                                                            <?= ($nIdx + 1) ?>. <?= html_escape($indNas) ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div style="padding: 10px 12px;">
                                                                    <span class="text-muted" style="font-style: italic;">-</span>
                                                                </div>
                                                            <?php } ?>
                                                        </td>

                                                        <!-- Kolom 3 & 4: Sasaran Pembangunan Daerah & Indikator Sasaran Pembangunan Daerah (Dijadikan 1 jika masih sama) -->
                                                        <?php if ($idx === 0) { ?>
                                                            <!-- Kolom 3: Sasaran Pembangunan Daerah -->
                                                            <td style="font-weight: 600;<?= ($dRowCount > 1) ? ' vertical-align: middle !important;' : '' ?>" <?= ($dRowCount > 1) ? 'rowspan="' . $dRowCount . '"' : '' ?>>
                                                                <div>
                                                                    <?= !empty($dGroup['kode_sasaran_daerah']) ? html_escape($dGroup['kode_sasaran_daerah']) . '. ' : '' ?>
                                                                    <?= html_escape($dGroup['sasaran_daerah']) ?>
                                                                </div>
                                                            </td>

                                                            <!-- Kolom 4: Indikator Sasaran Pembangunan Daerah -->
                                                            <td <?= ($dRowCount > 1) ? 'style="vertical-align: middle !important;" rowspan="' . $dRowCount . '"' : '' ?>>
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
                                                        <?php } ?>

                                                        <!-- Kolom 5: Aksi -->
                                                        <?php if ($can_edit) { ?>
                                                            <td class="text-center" style="vertical-align: middle !important;">
                                                                <div class="action-group">
                                                                    <button type="button" class="btn-action-custom btn-action-edit BtnEditKeterkaitan" 
                                                                        data-toggle="modal"
                                                                        data-target="#ModalEditKeterkaitan"
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
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
                                                                    <button type="button" class="btn-action-custom btn-action-delete BtnHapusKeterkaitan" 
                                                                        data-id="<?= $r['id'] ?>" 
                                                                        title="Hapus Data">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
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
                <div class="row">
                    <!-- KOLOM KIRI: 1. KETERKAITAN PRIORITAS & SASARAN NASIONAL -->
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-default" style="border-left: 4px solid #1b4f72; margin-bottom: 15px;">
                            <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #1b4f72;">
                                <i class="fa fa-landmark"></i> 1. Keterkaitan Prioritas & Sasaran Nasional
                            </div>
                            <div class="panel-body">
                                <!-- PN (Prioritas Nasional) -->
                                <div class="form-group">
                                    <label><b>Prioritas Nasional (PN)</b> <span class="text-danger">*</span>:</label>
                                    <select class="form-control select2-modal" id="InputIdPN" style="width: 100%;">
                                        <option value="">-- Pilih Prioritas Nasional (PN) --</option>
                                        <?php foreach ($PNMaster as $pn) { ?>
                                            <option value="<?= $pn['Id'] ?>">
                                                PN <?= $pn['Id'] ?>: <?= html_escape($pn['PrioritasNasional']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Container Sasaran & Indikator Nasional (Dipisah dengan Checkbox jika > 1) -->
                                <div id="ContainerSasaranNasional">
                                    <div class="alert alert-info" style="margin-bottom: 0; padding: 10px 14px; font-size: 13px;">
                                        <i class="fa fa-info-circle"></i> Silakan pilih <b>Prioritas Nasional (PN)</b> di atas untuk memunculkan Sasaran dan Indikator Nasional secara otomatis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: 2. KETERKAITAN PRIORITAS & SASARAN PEMBANGUNAN DAERAH -->
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-default" style="border-left: 4px solid #0369a1; margin-bottom: 15px;">
                            <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #0369a1;">
                                <i class="fa fa-map-marker-alt"></i> 2. Keterkaitan Prioritas & Sasaran Pembangunan Daerah
                            </div>
                            <div class="panel-body">
                        <!-- Prioritas Pembangunan Daerah (P) -->
                        <div class="form-group">
                            <label><b>Prioritas Pembangunan Daerah (P)</b> (Bisa Pilih Lebih Dari Satu):</label>
                            <div class="custom-multiselect-box" id="BoxPDaerah">
                                <div class="custom-multiselect-toggle" id="TogglePDaerah">
                                    <span id="LabelPDaerahSelected" style="color: #64748b; font-size: 13px; flex: 1; min-width: 0; line-height: 1.4; padding: 2px 0;">
                                        -- Pilih Prioritas Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="CaretPDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s; margin-left: 8px; flex-shrink: 0;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="MenuPDaerah">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH SATU ATAU LEBIH:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="BtnSelectAllPDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="BtnClearPDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div style="padding: 2px 0 6px 0;">
                                        <input type="text" class="form-control input-sm search-multiselect" placeholder="Cari Prioritas Daerah..." style="height: 30px; font-size: 12px; padding: 4px 8px; border-radius: 4px; border: 1px solid #cbd5e1;">
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
                                                <i class="fa fa-exclamation-circle"></i> Belum ada data Prioritas Pembangunan Daerah pada menu Sasaran Pembangunan Daerah tahun <?= html_escape($SelectedTahun) ?>.
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sasaran Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) -->
                        <div class="form-group">
                            <label><b>Sasaran Pembangunan Daerah</b> <span class="text-danger">*</span> (Bisa Pilih Lebih Dari Satu):</label>
                            <div class="custom-multiselect-box" id="BoxSasDaerah">
                                <div class="custom-multiselect-toggle" id="ToggleSasDaerah">
                                    <span id="LabelSasDaerahSelected" style="color: #64748b; font-size: 13px; flex: 1; min-width: 0; line-height: 1.4; padding: 2px 0;">
                                        -- Pilih Sasaran Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="CaretSasDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s; margin-left: 8px; flex-shrink: 0;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="MenuSasDaerah">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH SATU ATAU LEBIH:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="BtnSelectAllSasDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="BtnClearSasDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div style="padding: 2px 0 6px 0;">
                                        <input type="text" class="form-control input-sm search-multiselect" placeholder="Cari Sasaran Daerah..." style="height: 30px; font-size: 12px; padding: 4px 8px; border-radius: 4px; border: 1px solid #cbd5e1;">
                                    </div>
                                    <div id="ListSasDaerahOptions">
                                        <?php if (!empty($SasaranDaerahList)) { ?>
                                            <?php foreach ($SasaranDaerahList as $sasDae) { ?>
                                                <label class="custom-multiselect-item">
                                                    <input type="checkbox" class="CheckSasDaerah" value="<?= $sasDae['id'] ?>" data-kode="<?= html_escape($sasDae['kode']) ?>" data-sasaran="<?= html_escape($sasDae['sasaran']) ?>" data-prioritas-id="<?= $sasDae['prioritas_id'] ?? '' ?>">
                                                    <span><b style="color: #0369a1;"><?= html_escape($sasDae['kode']) ?>:</b> <?= html_escape($sasDae['sasaran']) ?></span>
                                                </label>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <span class="text-danger" style="font-size: 12px; display: block; padding: 4px;">
                                                <i class="fa fa-exclamation-circle"></i> Belum ada data Sasaran Pembangunan Daerah pada tahun <?= html_escape($SelectedTahun) ?>.
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Indikator Sasaran Pembangunan Daerah (Tampil perihal per sasaran sama dengan 1. Keterkaitan Prioritas & Sasaran Nasional) -->
                        <div class="form-group" style="margin-bottom: 0;">
                            <label><b>Indikator Sasaran Pembangunan Daerah</b> (Diambil dari Menu Sasaran Pembangunan):</label>
                            <small class="text-muted" style="display: block; margin-bottom: 6px;">
                                * Otomatis muncul per Sasaran Daerah terpilih (apabila lebih dari 1 dapat dipilih salah satu atau semuanya).
                            </small>
                            <div id="ContainerIndikatorDaerah">
                                <div class="alert alert-info" style="margin-bottom: 0; padding: 10px 14px; font-size: 13px;">
                                    <i class="fa fa-info-circle"></i> Silakan pilih <b>Sasaran Pembangunan Daerah</b> pada dropdown di atas untuk memunculkan indikatornya secara otomatis.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ROW BERDAMPINGAN -->
            </div>
            </div> <!-- /.modal-body -->
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
                <div class="row">
                    <!-- KOLOM KIRI: 1. KETERKAITAN PRIORITAS & SASARAN NASIONAL -->
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-default" style="border-left: 4px solid #1b4f72; margin-bottom: 15px;">
                            <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #1b4f72;">
                                <i class="fa fa-landmark"></i> 1. Keterkaitan Prioritas & Sasaran Nasional
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><b>Prioritas Nasional (PN)</b> <span class="text-danger">*</span>:</label>
                                    <select class="form-control select2-modal" id="EditIdPN" style="width: 100%;">
                                        <option value="">-- Pilih Prioritas Nasional (PN) --</option>
                                        <?php foreach ($PNMaster as $pn) { ?>
                                            <option value="<?= $pn['Id'] ?>">
                                                PN <?= $pn['Id'] ?>: <?= html_escape($pn['PrioritasNasional']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Container Sasaran & Indikator Nasional Edit -->
                                <div id="EditContainerSasaranNasional">
                                    <div class="alert alert-info" style="margin-bottom: 0; padding: 10px 14px; font-size: 13px;">
                                        <i class="fa fa-info-circle"></i> Silakan pilih <b>Prioritas Nasional (PN)</b> di atas untuk memunculkan Sasaran dan Indikator Nasional secara otomatis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: 2. KETERKAITAN PRIORITAS & SASARAN PEMBANGUNAN DAERAH -->
                    <div class="col-md-6 col-xs-12">
                        <div class="panel panel-default" style="border-left: 4px solid #0369a1; margin-bottom: 15px;">
                            <div class="panel-heading" style="background: #f1f5f9; font-weight: bold; color: #0369a1;">
                                <i class="fa fa-map-marker-alt"></i> 2. Keterkaitan Prioritas & Sasaran Pembangunan Daerah
                            </div>
                            <div class="panel-body">
                        <!-- Prioritas Daerah (Edit) -->
                        <div class="form-group">
                            <label><b>Prioritas Pembangunan Daerah (P)</b> (Bisa Pilih Lebih Dari Satu):</label>
                            <div class="custom-multiselect-box" id="EditBoxPDaerah">
                                <div class="custom-multiselect-toggle" id="EditTogglePDaerah">
                                    <span id="EditLabelPDaerahSelected" style="color: #64748b; font-size: 13px; flex: 1; min-width: 0; line-height: 1.4; padding: 2px 0;">
                                        -- Pilih Prioritas Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="EditCaretPDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s; margin-left: 8px; flex-shrink: 0;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="EditMenuPDaerah">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH SATU ATAU LEBIH:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="EditBtnSelectAllPDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="EditBtnClearPDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div style="padding: 2px 0 6px 0;">
                                        <input type="text" class="form-control input-sm search-multiselect" placeholder="Cari Prioritas Daerah..." style="height: 30px; font-size: 12px; padding: 4px 8px; border-radius: 4px; border: 1px solid #cbd5e1;">
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

                        <!-- Sasaran Daerah (Edit) -->
                        <div class="form-group">
                            <label><b>Sasaran Pembangunan Daerah</b> <span class="text-danger">*</span> (Bisa Pilih Lebih Dari Satu):</label>
                            <div class="custom-multiselect-box" id="EditBoxSasDaerah">
                                <div class="custom-multiselect-toggle" id="EditToggleSasDaerah">
                                    <span id="EditLabelSasDaerahSelected" style="color: #64748b; font-size: 13px; flex: 1; min-width: 0; line-height: 1.4; padding: 2px 0;">
                                        -- Pilih Sasaran Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --
                                    </span>
                                    <i class="fa fa-chevron-down" id="EditCaretSasDaerah" style="color: #64748b; font-size: 11px; transition: transform 0.2s; margin-left: 8px; flex-shrink: 0;"></i>
                                </div>
                                <div class="custom-multiselect-menu" id="EditMenuSasDaerah">
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 6px; margin-bottom: 6px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 11px; font-weight: 700; color: #64748b;">PILIH SATU ATAU LEBIH:</span>
                                        <div>
                                            <a href="javascript:void(0)" id="EditBtnSelectAllSasDaerah" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>
                                            <a href="javascript:void(0)" id="EditBtnClearSasDaerah" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>
                                        </div>
                                    </div>
                                    <div style="padding: 2px 0 6px 0;">
                                        <input type="text" class="form-control input-sm search-multiselect" placeholder="Cari Sasaran Daerah..." style="height: 30px; font-size: 12px; padding: 4px 8px; border-radius: 4px; border: 1px solid #cbd5e1;">
                                    </div>
                                    <div id="EditListSasDaerahOptions">
                                        <?php if (!empty($SasaranDaerahList)) { ?>
                                            <?php foreach ($SasaranDaerahList as $sasDae) { ?>
                                                <label class="custom-multiselect-item">
                                                    <input type="checkbox" class="EditCheckSasDaerah" value="<?= $sasDae['id'] ?>" data-kode="<?= html_escape($sasDae['kode']) ?>" data-sasaran="<?= html_escape($sasDae['sasaran']) ?>" data-prioritas-id="<?= $sasDae['prioritas_id'] ?? '' ?>">
                                                    <span><b style="color: #0369a1;"><?= html_escape($sasDae['kode']) ?>:</b> <?= html_escape($sasDae['sasaran']) ?></span>
                                                </label>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Indikator Sasaran Daerah (Edit) -->
                        <div class="form-group" style="margin-bottom: 0;">
                            <label><b>Indikator Sasaran Pembangunan Daerah</b> (Diambil dari Menu Sasaran Pembangunan):</label>
                            <small class="text-muted" style="display: block; margin-bottom: 6px;">
                                * Otomatis muncul per Sasaran Daerah terpilih (apabila lebih dari 1 dapat dipilih salah satu atau semuanya).
                            </small>
                            <div id="EditContainerIndikatorDaerah">
                                <div class="alert alert-info" style="margin-bottom: 0; padding: 10px 14px; font-size: 13px;">
                                    <i class="fa fa-info-circle"></i> Silakan pilih <b>Sasaran Pembangunan Daerah</b> pada dropdown di atas untuk memunculkan indikatornya secara otomatis.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ROW BERDAMPINGAN -->
            </div>
            </div> <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnUpdateKeterkaitan"><b>Update</b></button>
            </div>
        </div>
    </div>
</div>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';
var SelectedTahun = '<?= $SelectedTahun ?>';
var KodeWilayah = '<?= $KodeWilayah ?>';
var IndikatorDaerahMaster = <?= json_encode($IndikatorDaerahMaster ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
var SasaranDaerahList = <?= json_encode($SasaranDaerahList ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

$(document).ready(function() {
    // Inisialisasi Select2 Filter Wilayah
    $('#Provinsi, #KabKota').select2({
        width: '100%'
    });

    // Inisialisasi Select2 di Modal saat modal ditampilkan
    $('#ModalInputKeterkaitan, #ModalEditKeterkaitan').on('shown.bs.modal', function () {
        $(this).find('.select2-modal').select2({
            dropdownParent: $(this),
            width: '100%'
        });
    });

    // Live search di dalam custom multiselect dropdown
    $(document).on('keyup', '.search-multiselect', function() {
        var q = $(this).val().toLowerCase().trim();
        var $menu = $(this).closest('.custom-multiselect-menu');
        $menu.find('.custom-multiselect-item').each(function() {
            var t = $(this).text().toLowerCase();
            if (t.indexOf(q) !== -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $(document).on('click', '.search-multiselect', function(e) {
        e.stopPropagation();
    });

    // Filter Tahun
    $('#FilterTahun').on('change', function() {
        var tahun = $(this).val();
        var url = new URL(window.location.href);
        url.searchParams.set('tahun', tahun);
        window.location.href = url.toString();
    });

    // ============================================================
    // RENDER SASARAN & INDIKATOR NASIONAL DENGAN CHECKBOX
    // ============================================================
    function renderSasaranNasional(container, list, isEdit, preSelectedSasNasId, preSelectedIndNasText) {
        if (!list || list.length === 0) {
            container.html('<div class="alert alert-warning" style="margin-bottom: 0; font-size: 13px;"><i class="fa fa-exclamation-triangle"></i> Belum ada data Sasaran Prioritas pada PN ini.</div>');
            return;
        }

        var checkSasClass = isEdit ? 'EditCheckSasNasItem' : 'CheckSasNasItem';
        var checkIndClass = isEdit ? 'EditCheckIndNasItem' : 'CheckIndNasItem';
        var cardClass = isEdit ? 'edit-sas-nas-card' : 'sas-nas-card';

        var html = '';

        // Jika lebih dari 1 sasaran, tampilkan toolbar Pilih Semua / Kosongkan Sasaran
        if (list.length > 1) {
            html += '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 7px 12px; background: #e0f2fe; border: 1px solid #bae6fd; border-radius: 6px;">' +
                '<span style="font-size: 12px; font-weight: 700; color: #0369a1;">' +
                    '<i class="fa fa-list-check"></i> ' + list.length + ' Sasaran Prioritas Nasional (Dapat dipilih salah 1 atau semuanya):' +
                '</span>' +
                '<div>' +
                    '<a href="javascript:void(0)" class="' + (isEdit ? 'EditBtnSelectAllSasNas' : 'BtnSelectAllSasNas') + '" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 10px;">Pilih Semua</a>' +
                    '<a href="javascript:void(0)" class="' + (isEdit ? 'EditBtnClearSasNas' : 'BtnClearSasNas') + '" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>' +
                '</div>' +
            '</div>';
        }

        $.each(list, function(i, item) {
            var kd = item.kode || ('S' + (i + 1));
            var safeSas = (item.sasaran || '').replace(/"/g, '&quot;');
            
            var isSasChecked = true;
            if (isEdit && preSelectedSasNasId) {
                isSasChecked = (item.id == preSelectedSasNasId);
            }

            html += '<div class="panel panel-default ' + cardClass + '" data-sasaran-id="' + item.id + '" style="margin-bottom: 14px; border: 1.5px solid #cbd5e1; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">' +
                '<div class="panel-heading" style="background: #f8fafc; padding: 10px 14px; display: flex; align-items: flex-start; gap: 10px;">';

            if (list.length > 1) {
                html += '<input type="checkbox" class="' + checkSasClass + '" value="' + item.id + '" data-kode="' + kd + '" data-sasaran="' + safeSas + '" ' + (isSasChecked ? 'checked' : '') + ' style="margin-top: 3px; cursor: pointer; width: 16px; height: 16px;">';
            } else {
                html += '<input type="checkbox" class="' + checkSasClass + '" value="' + item.id + '" data-kode="' + kd + '" data-sasaran="' + safeSas + '" checked style="display: none;">';
            }

            html += '<div style="flex: 1;">' +
                        '<b style="color: #1b4f72; font-size: 13px;">' + kd + '. ' + item.sasaran + '</b>' +
                    '</div>' +
                '</div>' +
                '<div class="panel-body ' + (isEdit ? 'edit-sas-nas-body' : 'sas-nas-body') + '" style="padding: 12px 14px; background: #ffffff;' + (!isSasChecked ? ' opacity: 0.5;' : '') + '">' +
                    '<div class="form-group" style="margin-bottom: 0;">';

            var indList = item.indikator || [];
            var numInd = indList.length;

            if (numInd > 1) {
                html += '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">' +
                            '<label style="font-size: 12px; color: #334155; margin-bottom: 0;">' +
                                '<b>Indikator Sasaran Prioritas (' + kd + ')</b> <small class="text-muted">(Pilih salah 1 atau semuanya)</small>:' +
                            '</label>' +
                            '<div>' +
                                '<a href="javascript:void(0)" class="btn-check-all-ind-item" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 8px;">Pilih Semua</a>' +
                                '<a href="javascript:void(0)" class="btn-clear-ind-item" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>' +
                            '</div>' +
                        '</div>';
            } else {
                html += '<label style="font-size: 12px; color: #334155; margin-bottom: 6px;"><b>Indikator Sasaran Prioritas (' + kd + '):</b></label>';
            }

            if (numInd > 0) {
                html += '<div class="list-ind-items-container" style="display: flex; flex-direction: column; gap: 6px;">';
                $.each(indList, function(idx, indText) {
                    var safeInd = indText.replace(/"/g, '&quot;');
                    var isIndChecked = true;
                    if (isEdit && preSelectedIndNasText) {
                        isIndChecked = (preSelectedIndNasText.indexOf(indText) !== -1);
                    }

                    html += '<label style="margin: 0; font-weight: normal; cursor: pointer; display: flex; align-items: flex-start; gap: 8px; font-size: 12.5px; padding: 6px 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px;">';
                    if (numInd > 1) {
                        html += '<input type="checkbox" class="' + checkIndClass + '" value="' + safeInd + '" data-sasaran-id="' + item.id + '" ' + (isIndChecked ? 'checked' : '') + ' style="margin-top: 2px; cursor: pointer;">';
                    } else {
                        html += '<input type="checkbox" class="' + checkIndClass + '" value="' + safeInd + '" data-sasaran-id="' + item.id + '" checked style="display: none;">';
                    }
                    html += '<span><b>' + (idx + 1) + '.</b> ' + indText + '</span>' +
                    '</label>';
                });
                html += '</div>';
            } else {
                html += '<div style="color: #64748b; font-size: 12px; font-style: italic;">(Belum ada data indikator)</div>';
            }

            html += '</div>' +
                '</div>' +
            '</div>';
        });

        container.html(html);
    }

    // Helper: Load Sasaran & Indikator Nasional by PN
    function loadSasaranNasional(idPn, isEdit, preSelectedSasNasId, preSelectedIndNasText) {
        var container = isEdit ? $('#EditContainerSasaranNasional') : $('#ContainerSasaranNasional');
        if (!idPn) {
            container.html('<div class="alert alert-info" style="margin-bottom: 0; padding: 10px 14px; font-size: 13px;"><i class="fa fa-info-circle"></i> Silakan pilih <b>Prioritas Nasional (PN)</b> di atas untuk memunculkan Sasaran dan Indikator Nasional secara otomatis.</div>');
            return;
        }

        container.html('<div class="text-muted" style="padding: 10px; font-size: 13px;"><i class="fa fa-spinner fa-spin"></i> Memuat Sasaran & Indikator Nasional...</div>');

        $.ajax({
            url: BaseURL + 'Daerah/GetSasaranNasionalByPN',
            type: 'GET',
            data: { id_pn: idPn },
            dataType: 'json',
            success: function(res) {
                renderSasaranNasional(container, res, isEdit, preSelectedSasNasId, preSelectedIndNasText);
            },
            error: function() {
                container.html('<div class="alert alert-danger" style="margin-bottom: 0; font-size: 13px;"><i class="fa fa-exclamation-triangle"></i> Gagal memuat data dari server.</div>');
            }
        });
    }
    // ============================================================
    // RENDER INDIKATOR DAERAH PER SASARAN TERPILIH (PERSIS BAGIAN 1)
    // ============================================================
    function renderIndikatorDaerahPerSasaran(isEdit, preSelectedIndDaerahArr) {
        var checkSasClass = isEdit ? '.EditCheckSasDaerah:checked' : '.CheckSasDaerah:checked';
        var container = isEdit ? $('#EditContainerIndikatorDaerah') : $('#ContainerIndikatorDaerah');
        var checkIndClass = isEdit ? 'EditCheckIndDaerahItem' : 'CheckIndDaerahItem';
        var cardClass = isEdit ? 'edit-sas-dae-card' : 'sas-dae-card';
        var bodyClass = isEdit ? 'edit-sas-dae-body' : 'sas-dae-body';

        var checkedSas = $(checkSasClass);
        if (checkedSas.length === 0) {
            container.html('<div class="alert alert-info" style="margin-bottom: 0; padding: 10px 14px; font-size: 13px;"><i class="fa fa-info-circle"></i> Silakan pilih <b>Sasaran Pembangunan Daerah</b> pada dropdown di atas untuk memunculkan indikatornya secara otomatis.</div>');
            return;
        }

        var html = '';

        checkedSas.each(function(i, sasElem) {
            var sid = $(sasElem).val();
            var kd = $(sasElem).data('kode') || ('S' + (i + 1));
            var sasTitle = $(sasElem).data('sasaran') || '';

            // Cari indikator untuk sasaran ini
            var indList = [];
            if (IndikatorDaerahMaster && IndikatorDaerahMaster.length > 0) {
                $.each(IndikatorDaerahMaster, function(idx, ind) {
                    if (parseInt(ind.sasaran_id) === parseInt(sid)) {
                        indList.push(ind.indikator);
                    }
                });
            }

            var numInd = indList.length;

            // Render card panel per sasaran terpilih persis seperti Bagian 1 (Sasaran Nasional)
            html += '<div class="panel panel-default ' + cardClass + '" data-sasaran-id="' + sid + '" style="margin-bottom: 14px; border: 1.5px solid #cbd5e1; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">' +
                '<div class="panel-heading" style="background: #f8fafc; padding: 10px 14px; display: flex; align-items: center; gap: 8px;">' +
                    '<span class="badge" style="background: #0284c7; font-size: 11px;">' + kd + '</span>' +
                    '<b style="color: #0369a1; font-size: 13px;">' + kd + '. ' + sasTitle + '</b>' +
                '</div>' +
                '<div class="panel-body ' + bodyClass + '" style="padding: 12px 14px; background: #ffffff;">' +
                    '<div class="form-group" style="margin-bottom: 0;">';

            if (numInd > 1) {
                html += '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">' +
                            '<label style="font-size: 12px; color: #334155; margin-bottom: 0;">' +
                                '<b>Indikator Sasaran Daerah (' + kd + ')</b> <small class="text-muted">(Pilih salah 1 atau semuanya)</small>:' +
                            '</label>' +
                            '<div>' +
                                '<a href="javascript:void(0)" class="btn-check-all-ind-dae-item" style="font-size: 11px; font-weight: bold; color: #0284c7; margin-right: 8px;">Pilih Semua</a>' +
                                '<a href="javascript:void(0)" class="btn-clear-ind-dae-item" style="font-size: 11px; font-weight: bold; color: #d9534f;">Kosongkan</a>' +
                            '</div>' +
                        '</div>';
            } else {
                html += '<label style="font-size: 12px; color: #334155; margin-bottom: 6px;"><b>Indikator Sasaran Daerah (' + kd + '):</b></label>';
            }

            if (numInd > 0) {
                html += '<div class="list-ind-dae-items-container" style="display: flex; flex-direction: column; gap: 6px;">';
                $.each(indList, function(idx, indText) {
                    var safeInd = indText.replace(/"/g, '&quot;');
                    var isIndChecked = true;
                    if (isEdit && preSelectedIndDaerahArr && preSelectedIndDaerahArr.length > 0) {
                        isIndChecked = false;
                        $.each(preSelectedIndDaerahArr, function(pi, pVal) {
                            var pText = typeof pVal === 'object' ? (pVal.indikator || '') : pVal;
                            if ((pText || '').trim() === (indText || '').trim()) {
                                isIndChecked = true;
                                return false;
                            }
                        });
                    }

                    html += '<label style="margin: 0; font-weight: normal; cursor: pointer; display: flex; align-items: flex-start; gap: 8px; font-size: 12.5px; padding: 6px 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px;">';
                    if (numInd > 1) {
                        html += '<input type="checkbox" class="' + checkIndClass + '" value="' + safeInd + '" data-sasaran-id="' + sid + '" ' + (isIndChecked ? 'checked' : '') + ' style="margin-top: 2px; cursor: pointer;">';
                    } else {
                        html += '<input type="checkbox" class="' + checkIndClass + '" value="' + safeInd + '" data-sasaran-id="' + sid + '" checked style="display: none;">';
                    }
                    html += '<span><b>' + (idx + 1) + '.</b> ' + indText + '</span>' +
                    '</label>';
                });
                html += '</div>';
            } else {
                html += '<div style="color: #64748b; font-size: 12px; font-style: italic;">(Belum ada data indikator pada sasaran ini)</div>';
            }

            html += '</div>' +
                '</div>' +
            '</div>';
        });

        container.html(html);
    }

    // Helper: Update label dropdown Sasaran Daerah (Menampilkan kode & perihal)
    function updateSasDaerahDisplay(isEdit, preSelectedIndDaerahArr) {
        var checkClass = isEdit ? '.EditCheckSasDaerah' : '.CheckSasDaerah';
        var labelElem = isEdit ? $('#EditLabelSasDaerahSelected') : $('#LabelSasDaerahSelected');

        var checked = $(checkClass + ':checked');
        if (checked.length === 0) {
            labelElem.html('<span style="color: #64748b;">-- Pilih Sasaran Pembangunan Daerah (Bisa Pilih Lebih Dari Satu) --</span>');
        } else if (checked.length === 1) {
            var first = checked.first();
            var kd = first.data('kode') || '';
            var sas = first.data('sasaran') || '';
            labelElem.html('<div style="display: flex; align-items: flex-start; gap: 6px; line-height: 1.4;"><span class="label label-primary" style="font-size: 10.5px; margin-top: 2px; flex-shrink: 0;">' + kd + '</span> <span style="color: #0f172a; font-weight: 600; font-size: 12.5px;">' + sas + '</span></div>');
            labelElem.attr('title', kd + ': ' + sas);
        } else {
            var itemsHtml = '';
            var itemsPlain = [];
            checked.each(function() {
                var kd = $(this).data('kode') || '';
                var sas = $(this).data('sasaran') || '';
                if (kd) {
                    itemsHtml += '<div style="display: flex; align-items: flex-start; gap: 6px; line-height: 1.4; margin-top: 4px;">' +
                        '<span class="label label-primary" style="font-size: 10.5px; margin-top: 2px; flex-shrink: 0;">' + kd + '</span>' +
                        '<span style="color: #0f172a; font-weight: 600; font-size: 12.5px;">' + sas + '</span>' +
                    '</div>';
                    itemsPlain.push(kd + ': ' + sas);
                }
            });
            var fullHtml = '<div style="display: flex; flex-direction: column; width: 100%;">' +
                '<div><span class="badge" style="background: #0284c7; font-size: 11px;">' + checked.length + ' Dipilih:</span></div>' +
                itemsHtml +
            '</div>';
            labelElem.html(fullHtml);
            labelElem.attr('title', itemsPlain.join(' | '));
        }

        renderIndikatorDaerahPerSasaran(isEdit, preSelectedIndDaerahArr);
    }

    // ============================================================
    // CUSTOM MULTISELECT DROPDOWN SASARAN DAERAH
    // ============================================================
    $(document).on('click', '#ToggleSasDaerah', function(e) {
        e.stopPropagation();
        var menu = $('#MenuSasDaerah');
        var isVisible = menu.is(':visible');
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
        if (!isVisible) {
            menu.show();
            $(this).addClass('active');
            $('#CaretSasDaerah').css('transform', 'rotate(180deg)');
        }
    });

    $(document).on('click', '#EditToggleSasDaerah', function(e) {
        e.stopPropagation();
        var menu = $('#EditMenuSasDaerah');
        var isVisible = menu.is(':visible');
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
        if (!isVisible) {
            menu.show();
            $(this).addClass('active');
            $('#EditCaretSasDaerah').css('transform', 'rotate(180deg)');
        }
    });

    // Event Checkbox Sasaran Daerah change
    $(document).on('change', '.CheckSasDaerah', function() {
        updateSasDaerahDisplay(false);
    });
    $(document).on('change', '.EditCheckSasDaerah', function() {
        updateSasDaerahDisplay(true);
    });

    // Toolbar Sasaran Daerah Tambah
    $(document).on('click', '#BtnSelectAllSasDaerah', function(e) {
        e.preventDefault();
        $('.CheckSasDaerah').prop('checked', true);
        updateSasDaerahDisplay(false);
    });
    $(document).on('click', '#BtnClearSasDaerah', function(e) {
        e.preventDefault();
        $('.CheckSasDaerah').prop('checked', false);
        updateSasDaerahDisplay(false);
    });

    // Toolbar Sasaran Daerah Edit
    $(document).on('click', '#EditBtnSelectAllSasDaerah', function(e) {
        e.preventDefault();
        $('.EditCheckSasDaerah').prop('checked', true);
        updateSasDaerahDisplay(true);
    });
    $(document).on('click', '#EditBtnClearSasDaerah', function(e) {
        e.preventDefault();
        $('.EditCheckSasDaerah').prop('checked', false);
        updateSasDaerahDisplay(true);
    });

    // Toolbar Indikator per Sasaran Daerah
    $(document).on('click', '.btn-check-all-ind-dae-item', function(e) {
        e.preventDefault();
        $(this).closest('.panel-body').find('input[type="checkbox"]').prop('checked', true);
    });
    $(document).on('click', '.btn-clear-ind-dae-item', function(e) {
        e.preventDefault();
        $(this).closest('.panel-body').find('input[type="checkbox"]').prop('checked', false);
    });

    // ============================================================
    // CUSTOM MULTISELECT DROPDOWN PRIORITAS DAERAH (P)
    // ============================================================
    $(document).on('click', '#TogglePDaerah', function(e) {
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

    $(document).on('click', '#EditTogglePDaerah', function(e) {
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

    $(document).on('click', '.custom-multiselect-menu', function(e) {
        e.stopPropagation();
    });

    $(document).on('click', function() {
        $('.custom-multiselect-menu').hide();
        $('.custom-multiselect-toggle').removeClass('active');
        $('.custom-multiselect-toggle i').css('transform', 'rotate(0deg)');
    });

    // Update P Daerah Display
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
            labelElem.html('<div style="display: flex; align-items: flex-start; gap: 6px; line-height: 1.4;"><span class="label label-primary" style="font-size: 10.5px; margin-top: 2px; flex-shrink: 0;">' + kd + '</span> <span style="color: #0f172a; font-weight: 600; font-size: 12.5px;">' + pri + '</span></div>');
            labelElem.attr('title', kd + ': ' + pri);
        } else {
            var itemsHtml = '';
            var itemsPlain = [];
            checked.each(function() {
                var kd = $(this).data('kode') || '';
                var pri = $(this).data('prioritas') || '';
                if (kd) {
                    itemsHtml += '<div style="display: flex; align-items: flex-start; gap: 6px; line-height: 1.4; margin-top: 4px;">' +
                        '<span class="label label-primary" style="font-size: 10.5px; margin-top: 2px; flex-shrink: 0;">' + kd + '</span>' +
                        '<span style="color: #0f172a; font-weight: 600; font-size: 12.5px;">' + pri + '</span>' +
                    '</div>';
                    itemsPlain.push(kd + ': ' + pri);
                }
            });
            var fullHtml = '<div style="display: flex; flex-direction: column; width: 100%;">' +
                '<div><span class="badge" style="background: #0284c7; font-size: 11px;">' + checked.length + ' Dipilih:</span></div>' +
                itemsHtml +
            '</div>';
            labelElem.html(fullHtml);
            labelElem.attr('title', itemsPlain.join(' | '));
        }
    }

    function filterSasaranDaerahOptions(isEdit) {
        var checkPClass = isEdit ? '.EditCheckPDaerah:checked' : '.CheckPDaerah:checked';
        var listContainer = isEdit ? $('#EditListSasDaerahOptions') : $('#ListSasDaerahOptions');
        var checkedP = $(checkPClass);

        if (checkedP.length === 0) {
            listContainer.find('.custom-multiselect-item').show();
        } else {
            var selectedPIds = [];
            checkedP.each(function() {
                selectedPIds.push($(this).val().toString());
            });
            listContainer.find('.custom-multiselect-item').each(function() {
                var $chk = $(this).find('input[type="checkbox"]');
                var pId = ($chk.data('prioritas-id') || '').toString();
                if (pId && selectedPIds.indexOf(pId) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    }

    $(document).on('change', '.CheckPDaerah', function() {
        updatePDaerahDisplay(false);
        filterSasaranDaerahOptions(false);
    });
    $(document).on('change', '.EditCheckPDaerah', function() {
        updatePDaerahDisplay(true);
        filterSasaranDaerahOptions(true);
    });

    $(document).on('click', '#BtnSelectAllPDaerah', function(e) {
        e.preventDefault();
        $('.CheckPDaerah').prop('checked', true);
        updatePDaerahDisplay(false);
        filterSasaranDaerahOptions(false);
    });
    $(document).on('click', '#BtnClearPDaerah', function(e) {
        e.preventDefault();
        $('.CheckPDaerah').prop('checked', false);
        updatePDaerahDisplay(false);
        filterSasaranDaerahOptions(false);
    });

    $(document).on('click', '#EditBtnSelectAllPDaerah', function(e) {
        e.preventDefault();
        $('.EditCheckPDaerah').prop('checked', true);
        updatePDaerahDisplay(true);
        filterSasaranDaerahOptions(true);
    });
    $(document).on('click', '#EditBtnClearPDaerah', function(e) {
        e.preventDefault();
        $('.EditCheckPDaerah').prop('checked', false);
        updatePDaerahDisplay(true);
        filterSasaranDaerahOptions(true);
    });

    // Buka Modal Tambah
    $(document).on('click', '#BtnBukaModalTambah, #BtnTambahEmpty', function() {
        try {
            $('#InputIdPN').val('').trigger('change.select2');
            $('#ContainerSasaranNasional').html('<div class="alert alert-info" style="margin-bottom: 0; padding: 10px 14px; font-size: 13px;"><i class="fa fa-info-circle"></i> Silakan pilih <b>Prioritas Nasional (PN)</b> di atas untuk memunculkan Sasaran dan Indikator Nasional secara otomatis.</div>');
            
            $('.CheckPDaerah').prop('checked', false);
            updatePDaerahDisplay(false);
            filterSasaranDaerahOptions(false);

            $('.CheckSasDaerah').prop('checked', false);
            updateSasDaerahDisplay(false);

            $('.custom-multiselect-menu').hide();
            $('.custom-multiselect-toggle').removeClass('active');
            $('.search-multiselect').val('');
            $('.custom-multiselect-item').show();
        } catch(e) {
            console.error('Error pre-opening modal tambah:', e);
        }
        $('#ModalInputKeterkaitan').modal('show');
    });

    // Event saat PN dipilih (Tambah)
    $('#InputIdPN').on('change', function() {
        var idPn = $(this).val();
        loadSasaranNasional(idPn, false);
    });

    // Simpan Keterkaitan (Tambah)
    $(document).on('click', '#BtnSimpanKeterkaitan', function() {
        var idPn = $('#InputIdPN').val();

        // P Daerah
        var pDaerahIds = [];
        $('.CheckPDaerah:checked').each(function() {
            pDaerahIds.push($(this).val());
        });

        // Sasaran Nasional & Indikator Nasional
        var sasaranNasListToSubmit = [];
        $('.CheckSasNasItem:checked').each(function() {
            var sId = $(this).val();
            var sKode = $(this).data('kode');
            var sText = $(this).data('sasaran');

            var indChecked = [];
            $(this).closest('.sas-nas-card').find('.CheckIndNasItem:checked').each(function() {
                var indVal = $(this).val().trim();
                if (indVal) indChecked.push(indVal);
            });

            sasaranNasListToSubmit.push({
                id: sId,
                kode: sKode,
                sasaran: sText,
                indikator: indChecked
            });
        });

        // Sasaran Daerah & Indikator Daerah
        var sasaranDaeListToSubmit = [];
        $('.CheckSasDaerah:checked').each(function() {
            var sdId = $(this).val();
            var sdKode = $(this).data('kode');
            var sdText = $(this).data('sasaran');

            var indDaeChecked = [];
            $('.CheckIndDaerahItem:checked[data-sasaran-id="' + sdId + '"]').each(function() {
                var indVal = $(this).val().trim();
                if (indVal) indDaeChecked.push(indVal);
            });

            sasaranDaeListToSubmit.push({
                id: sdId,
                kode: sdKode,
                sasaran: sdText,
                indikator: indDaeChecked
            });
        });

        if (!idPn) {
            alert('Prioritas Nasional (PN) wajib dipilih!');
            return;
        }
        if (sasaranNasListToSubmit.length === 0) {
            alert('Minimal pilih salah satu Sasaran Prioritas Pembangunan Nasional!');
            return;
        }
        if (sasaranDaeListToSubmit.length === 0) {
            alert('Minimal pilih salah satu Sasaran Pembangunan Daerah!');
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
                SasaranNasionalList: JSON.stringify(sasaranNasListToSubmit),
                SasaranDaerahList: JSON.stringify(sasaranDaeListToSubmit),
                PDaerahIds: pDaerahIds,
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
            error: function() {
                alert('Terjadi kesalahan koneksi server!');
                btn.prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // EDIT KETERKAITAN
    // ============================================================
    var isEditModalOpening = false;

    $(document).on('click', '.BtnEditKeterkaitan', function() {
        try {
            var id = $(this).data('id');
            var idPn = $(this).data('id_pn');
            var idSasNas = $(this).data('id_sasaran_nasional');
            var indNas = $(this).data('indikator_nasional');
            var pDaerahJson = $(this).data('p_daerah');
            var idSasDae = $(this).data('id_sasaran_daerah');
            var indDaeJson = $(this).data('indikator_daerah');

            // Aman parsing JSON jika tipe data adalah string
            if (typeof pDaerahJson === 'string') {
                try { pDaerahJson = JSON.parse(pDaerahJson); } catch(e) { pDaerahJson = []; }
            }
            if (!Array.isArray(pDaerahJson)) {
                pDaerahJson = [];
            }

            if (typeof indDaeJson === 'string') {
                try { indDaeJson = JSON.parse(indDaeJson); } catch(e) { indDaeJson = []; }
            }
            if (!Array.isArray(indDaeJson)) {
                indDaeJson = [];
            }

            isEditModalOpening = true;

            $('#EditKeterkaitanId').val(id);
            $('#EditIdPN').val(idPn).trigger('change.select2');

            // P Daerah
            $('.EditCheckPDaerah').prop('checked', false);
            if (pDaerahJson && pDaerahJson.length > 0) {
                $.each(pDaerahJson, function(i, p) {
                    if (p && p.id) {
                        $('.EditCheckPDaerah[value="' + p.id + '"]').prop('checked', true);
                    }
                });
            }
            updatePDaerahDisplay(true);

            // Sasaran Daerah
            $('.EditCheckSasDaerah').prop('checked', false);
            if (idSasDae) {
                $('.EditCheckSasDaerah[value="' + idSasDae + '"]').prop('checked', true);
            }
            updateSasDaerahDisplay(true, indDaeJson);
            filterSasaranDaerahOptions(true);

            // Muat Sasaran & Indikator Nasional
            loadSasaranNasional(idPn, true, idSasNas, indNas);

            $('.custom-multiselect-menu').hide();
            $('.custom-multiselect-toggle').removeClass('active');
            $('.search-multiselect').val('');
            $('.custom-multiselect-item').show();

            isEditModalOpening = false;
        } catch(err) {
            console.error('Error pre-opening modal edit:', err);
            isEditModalOpening = false;
        }
        $('#ModalEditKeterkaitan').modal('show');
    });

    $('#EditIdPN').on('change', function() {
        if (isEditModalOpening) return;
        var idPn = $(this).val();
        loadSasaranNasional(idPn, true);
    });

    $(document).on('click', '#BtnUpdateKeterkaitan', function() {
        var id = $('#EditKeterkaitanId').val();
        var idPn = $('#EditIdPN').val();

        var pDaerahIds = [];
        $('.EditCheckPDaerah:checked').each(function() {
            pDaerahIds.push($(this).val());
        });

        // Sasaran Nasional & Indikator Nasional
        var sasaranNasListToSubmit = [];
        $('.EditCheckSasNasItem:checked').each(function() {
            var sId = $(this).val();
            var sKode = $(this).data('kode');
            var sText = $(this).data('sasaran');

            var indChecked = [];
            $(this).closest('.edit-sas-nas-card').find('.EditCheckIndNasItem:checked').each(function() {
                var indVal = $(this).val().trim();
                if (indVal) indChecked.push(indVal);
            });

            sasaranNasListToSubmit.push({
                id: sId,
                kode: sKode,
                sasaran: sText,
                indikator: indChecked
            });
        });

        // Sasaran Daerah & Indikator Daerah
        var sasaranDaeListToSubmit = [];
        $('.EditCheckSasDaerah:checked').each(function() {
            var sdId = $(this).val();
            var sdKode = $(this).data('kode');
            var sdText = $(this).data('sasaran');

            var indDaeChecked = [];
            $('.EditCheckIndDaerahItem:checked[data-sasaran-id="' + sdId + '"]').each(function() {
                var indVal = $(this).val().trim();
                if (indVal) indDaeChecked.push(indVal);
            });

            sasaranDaeListToSubmit.push({
                id: sdId,
                kode: sdKode,
                sasaran: sdText,
                indikator: indDaeChecked
            });
        });

        if (!idPn) {
            alert('Prioritas Nasional (PN) wajib dipilih!');
            return;
        }
        if (sasaranNasListToSubmit.length === 0) {
            alert('Minimal pilih salah satu Sasaran Prioritas Pembangunan Nasional!');
            return;
        }
        if (sasaranDaeListToSubmit.length === 0) {
            alert('Minimal pilih salah satu Sasaran Pembangunan Daerah!');
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
                SasaranNasionalList: JSON.stringify(sasaranNasListToSubmit),
                SasaranDaerahList: JSON.stringify(sasaranDaeListToSubmit),
                PDaerahIds: pDaerahIds,
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
            error: function() {
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
                    $('#KabKota').html(html).trigger('change.select2');
                }
            });
        } else {
            $('#KabKota').html('<option value="">Pilih Kab/Kota</option>').trigger('change.select2');
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
