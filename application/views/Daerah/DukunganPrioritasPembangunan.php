<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<?php
$can_edit = isset($_SESSION['Level']) && $_SESSION['Level'] == 3;

// Kelompokkan data dukungan prioritas berdasarkan ID Prioritas Nasional (id_pn)
$groupedDukungan = [];
if (!empty($DukunganList)) {
    foreach ($DukunganList as $row) {
        $pnId = $row['id_pn'];
        if (!isset($groupedDukungan[$pnId])) {
            $groupedDukungan[$pnId] = [
                'id_pn' => $pnId,
                'kode_pn' => $row['kode_pn'],
                'nama_pn' => $row['nama_pn'],
                'rows' => []
            ];
        }
        $groupedDukungan[$pnId]['rows'][] = $row;
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

    .dukungan-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .dukungan-card-header {
        background: #f8fafc;
        padding: 16px 20px;
        border-bottom: 1.5px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .dukungan-title h3 {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
    }
    .dukungan-title p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Tabel Sesuai Gambar Referensi */
    .table-dukungan {
        width: 100%;
        border-collapse: collapse !important;
        font-size: 13px;
        margin-bottom: 0;
        border: 1.5px solid #1b4f72 !important;
    }
    .table-dukungan thead th {
        background: #1b4f72 !important;
        color: #ffffff !important;
        text-align: center;
        vertical-align: middle !important;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 8px !important;
        border: 1px solid #2874a6 !important;
        line-height: 1.35;
    }
    .table-dukungan thead th.th-number {
        background: #154360 !important;
        font-size: 12px;
        padding: 4px 6px !important;
    }
    .table-dukungan tbody td {
        vertical-align: top !important;
        padding: 8px 10px !important;
        border: 1px solid #cbd5e1 !important;
        line-height: 1.45;
        color: #1e293b;
        background-color: #ffffff;
    }
    .table-dukungan tbody tr.subgroup-header td {
        background: #f1f5f9 !important;
        font-weight: 700;
        color: #0f172a;
        padding: 10px 14px !important;
        border-top: 2px solid #1b4f72 !important;
        border-bottom: 1.5px solid #94a3b8 !important;
        font-size: 13.5px;
    }
    .table-dukungan tbody tr:not(.subgroup-header):hover td {
        background-color: #f8fafc;
    }

    .kegiatan-item-block {
        padding: 7px 4px;
        border-bottom: 1px solid #cbd5e1;
        line-height: 1.4;
    }
    .kegiatan-item-block:last-child {
        border-bottom: none;
    }

    .indikator-item-block {
        padding: 4px 0;
        border-bottom: 1px dashed #e2e8f0;
        line-height: 1.4;
    }
    .indikator-item-block:last-child {
        border-bottom: none;
    }

    .action-group {
        display: flex;
        flex-direction: row;
        gap: 6px;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
    }
    .btn-action-custom {
        width: 32px;
        height: 32px;
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
        line-height: 1;
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
        box-shadow: 0 2px 5px rgba(240, 173, 78, 0.4);
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
        box-shadow: 0 2px 5px rgba(217, 83, 79, 0.4);
    }

    /* Modal Styling */
    .repeater-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }
    .repeater-table th {
        background: #f1f5f9;
        font-size: 12px;
        font-weight: 700;
        color: #334155;
        padding: 8px;
        border: 1px solid #cbd5e1;
    }
    .repeater-table td {
        padding: 8px;
        border: 1px solid #cbd5e1;
        vertical-align: top;
    }
    .repeater-kegiatan-item {
        display: flex;
        gap: 6px;
        margin-bottom: 6px;
        align-items: center;
    }
    .badge-p-kode {
        display: inline-block;
        padding: 2px 7px;
        font-size: 12px;
        font-weight: 800;
        color: #0f172a;
        background: #e2e8f0;
        border-radius: 4px;
        border: 1px solid #cbd5e1;
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
                                        <i class="fa fa-plus"></i> <b>Tambah Dukungan Prioritas</b>
                                    </button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Card & Tabel Utama -->
                        <div class="dukungan-card">
                            <div class="dukungan-card-header">
                                <div class="dukungan-title">
                                    <h3>Dukungan Prioritas Pembangunan (Tahun <?= html_escape($SelectedTahun) ?>)</h3>
                                    <p>Matriks Penyelarasan Program & Kegiatan Prioritas Nasional (<?= ($SelectedTahun == '2026') ? 'RKP Nasional - Menu Matriks Pembangunan' : 'RPJMN' ?>) dengan Program Prioritas & Dukungan Program Pembangunan Daerah</p>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table-dukungan">
                                    <thead>
                                        <!-- Header Baris 1: Judul Kolom -->
                                        <tr>
                                            <th style="width: 3%; text-align: center;">No</th>
                                            <th style="width: 16%;">Program Prioritas Nasional</th>
                                            <th style="width: 18%;">Kegiatan Prioritas Nasional</th>
                                            <th style="width: 16%;">Prioritas Pembangunan Daerah</th>
                                            <th style="width: 15%;">Program Prioritas Pembangunan Daerah</th>
                                            <th style="width: 16%;">Dukungan Program Pembangunan Daerah</th>
                                            <th style="width: 16%;">Indikator Kinerja</th>
                                            <?php if ($can_edit) { ?>
                                                <th style="width: 85px; min-width: 85px; text-align: center;">Aksi</th>
                                            <?php } ?>
                                        </tr>
                                        <!-- Header Baris 2: Penomoran Kolom Sesuai Referensi (1-7) -->
                                        <tr>
                                            <th class="th-number">1</th>
                                            <th class="th-number">2</th>
                                            <th class="th-number">3</th>
                                            <th class="th-number">4</th>
                                            <th class="th-number">5</th>
                                            <th class="th-number">6</th>
                                            <th class="th-number">7</th>
                                            <?php if ($can_edit) { ?>
                                                <th class="th-number"></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($groupedDukungan)) { ?>
                                            <tr>
                                                <td colspan="<?= $can_edit ? 8 : 7 ?>" class="text-center" style="padding: 40px !important;">
                                                    <div style="color: #64748b; font-size: 14px;">
                                                        <i class="fa fa-info-circle fa-2x" style="margin-bottom: 8px; color: #0284c7;"></i><br>
                                                        Belum ada data Dukungan Prioritas Pembangunan untuk Tahun <?= html_escape($SelectedTahun) ?>.<br>
                                                        <?php if ($can_edit) { ?>
                                                            <div style="margin-top: 14px;">
                                                                <button type="button" class="btn btn-sm btn-success notika-btn-success" id="BtnTambahEmpty">
                                                                    <i class="fa fa-plus"></i> Tambah Data Baru
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php foreach ($groupedDukungan as $g) { 
                                                $pnHeaderTitle = $g['kode_pn'] . '. ' . $g['nama_pn'];
                                            ?>
                                                <!-- Baris Subgroup Prioritas Nasional (PN) Sesuai Referensi -->
                                                <tr class="subgroup-header">
                                                    <td colspan="<?= $can_edit ? 8 : 7 ?>">
                                                        <b><?= html_escape($pnHeaderTitle) ?></b>
                                                    </td>
                                                </tr>

                                                <!-- Baris-Baris Data di Bawah PN Tersebut -->
                                                <?php foreach ($g['rows'] as $row) { 
                                                    // Parse Kegiatan Nasional JSON
                                                    $kegiatanList = [];
                                                    if (!empty($row['kegiatan_nasional_json'])) {
                                                        $parsedK = json_decode($row['kegiatan_nasional_json'], true);
                                                        if (is_array($parsedK)) {
                                                            $kegiatanList = $parsedK;
                                                        }
                                                    }

                                                    // Parse Dukungan Program & Indikator JSON
                                                    $dukunganItems = [];
                                                    if (!empty($row['dukungan_program_json'])) {
                                                        $parsedD = json_decode($row['dukungan_program_json'], true);
                                                        if (is_array($parsedD)) {
                                                            $dukunganItems = $parsedD;
                                                        }
                                                    }
                                                    if (empty($dukunganItems)) {
                                                        $dukunganItems = [['dukungan_program' => '', 'indikator_kinerja' => '']];
                                                    }

                                                    $totalSubrows = count($dukunganItems);
                                                ?>
                                                    <?php for ($idx = 0; $idx < $totalSubrows; $idx++) { 
                                                        $dItem = $dukunganItems[$idx];
                                                        $indLines = [];
                                                        if (!empty($dItem['indikator_kinerja'])) {
                                                            $rawLines = preg_split('/\r\n|\r|\n/', trim($dItem['indikator_kinerja']));
                                                            foreach ($rawLines as $l) {
                                                                $lTrim = trim($l);
                                                                if (!empty($lTrim)) {
                                                                    $indLines[] = $lTrim;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                        <tr>
                                                            <?php if ($idx === 0) { ?>
                                                                <!-- Kolom 1: No (Nomor PPN) -->
                                                                <td rowspan="<?= $totalSubrows ?>" style="text-align: center; font-weight: 600;">
                                                                    <?= !empty($row['nomor_ppn']) ? html_escape($row['nomor_ppn']) : '-' ?>
                                                                </td>

                                                                <!-- Kolom 2: Program Prioritas Nasional -->
                                                                <td rowspan="<?= $totalSubrows ?>" style="font-weight: 500;">
                                                                    <?= html_escape($row['program_nasional']) ?>
                                                                </td>

                                                                <!-- Kolom 3: Kegiatan Prioritas Nasional (Daftar bergaris) -->
                                                                <td rowspan="<?= $totalSubrows ?>" style="padding: 0 !important;">
                                                                    <?php if (!empty($kegiatanList)) { ?>
                                                                        <?php foreach ($kegiatanList as $kIdx => $kText) { ?>
                                                                            <div class="kegiatan-item-block" style="padding: 8px 10px;">
                                                                                <?= html_escape($kText) ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    <?php } else { ?>
                                                                        <div style="padding: 8px 10px; color: #94a3b8; font-style: italic;">-</div>
                                                                    <?php } ?>
                                                                </td>

                                                                <!-- Kolom 4: Prioritas Pembangunan Daerah (Badge Kode + Teks) -->
                                                                <td rowspan="<?= $totalSubrows ?>">
                                                                    <div style="display: flex; gap: 8px; align-items: flex-start;">
                                                                        <?php if (!empty($row['kode_prioritas_daerah'])) { ?>
                                                                            <div class="badge-p-kode">
                                                                                <?= html_escape($row['kode_prioritas_daerah']) ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div style="font-weight: 500;">
                                                                            <?= html_escape($row['prioritas_daerah']) ?>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                <!-- Kolom 5: Program Prioritas Pembangunan Daerah -->
                                                                <td rowspan="<?= $totalSubrows ?>" style="font-weight: 500;">
                                                                    <?= html_escape($row['program_prioritas_daerah']) ?>
                                                                </td>
                                                            <?php } ?>

                                                            <!-- Kolom 6: Dukungan Program Pembangunan Daerah -->
                                                            <td style="font-weight: 500;">
                                                                <?= !empty($dItem['dukungan_program']) ? html_escape($dItem['dukungan_program']) : '<span style="color:#94a3b8; font-style:italic;">-</span>' ?>
                                                            </td>

                                                            <!-- Kolom 7: Indikator Kinerja -->
                                                            <td>
                                                                <?php if (!empty($indLines)) { ?>
                                                                    <?php foreach ($indLines as $il) { ?>
                                                                        <div class="indikator-item-block">
                                                                            <?= html_escape($il) ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <span style="color:#94a3b8; font-style:italic;">-</span>
                                                                <?php } ?>
                                                            </td>

                                                            <?php if ($idx === 0 && $can_edit) { ?>
                                                                <!-- Kolom 8: Aksi -->
                                                                <td rowspan="<?= $totalSubrows ?>" style="text-align: center; vertical-align: middle !important;">
                                                                    <div class="action-group">
                                                                        <button type="button" 
                                                                                class="btn-action-custom btn-action-edit BtnEditDukungan"
                                                                                data-id="<?= $row['id'] ?>"
                                                                                data-id_pn="<?= $row['id_pn'] ?>"
                                                                                data-nomor_ppn="<?= html_escape($row['nomor_ppn']) ?>"
                                                                                data-id_program_nasional="<?= $row['id_program_nasional'] ?>"
                                                                                data-program_nasional="<?= html_escape($row['program_nasional']) ?>"
                                                                                data-kegiatan_json="<?= html_escape($row['kegiatan_nasional_json'] ?? '[]') ?>"
                                                                                data-id_prioritas_daerah="<?= $row['id_prioritas_daerah'] ?>"
                                                                                data-prioritas_daerah="<?= html_escape($row['prioritas_daerah']) ?>"
                                                                                data-program_prioritas_daerah="<?= html_escape($row['program_prioritas_daerah']) ?>"
                                                                                data-dukungan_json="<?= html_escape($row['dukungan_program_json'] ?? '[]') ?>"
                                                                                title="Edit Data">
                                                                            <i class="fa fa-pencil-alt"></i>
                                                                        </button>
                                                                        <button type="button" 
                                                                                class="btn-action-custom btn-action-delete BtnHapusDukungan"
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

<!-- ============================================================ -->
<!-- MODAL TAMBAH DUKUNGAN PRIORITAS -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalInputDukungan" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" style="width: 90%; max-width: 950px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #1b4f72; color: #ffffff;">
                <button type="button" class="close" data-dismiss="modal" style="color: #ffffff; opacity: 0.8;">&times;</button>
                <h4 class="modal-title" style="color: #ffffff; font-weight: 700; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                    <span><i class="fa fa-plus-circle"></i> Tambah Dukungan Prioritas Pembangunan</span>
                    <?php if ($SelectedTahun == '2026') { ?>
                        <span class="label label-info" style="font-size: 11px; font-weight: normal; background-color: #0284c7;">
                            <i class="fa fa-table"></i> RKP Nasional (Matriks Pembangunan)
                        </span>
                    <?php } ?>
                </h4>
            </div>
            <form id="FormInputDukungan">
                <div class="modal-body" style="max-height: 75vh; overflow-y: auto; padding: 20px;">
                    <input type="hidden" name="Tahun" value="<?= html_escape($SelectedTahun) ?>">
                    <?php if (!empty($KodeWilayah)) { ?>
                        <input type="hidden" name="KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">
                    <?php } ?>

                    <!-- Baris 1: No. & Prioritas Nasional (PN) -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-weight: 700; color: #0f172a;">
                                    No. (Kolom 1) <small class="text-muted">(Opsional)</small>
                                </label>
                                <input type="text" class="form-control" id="Input_NomorPPN" name="NomorPPN" value="" placeholder="Contoh: 1 atau 9">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label style="font-weight: 700; color: #0f172a;">
                                    Prioritas Nasional (PN) <span class="text-danger">*</span>
                                </label>
                                <select class="form-control select2-modal" id="Input_IdPN" name="IdPN" required style="width: 100%;">
                                    <option value="">-- Pilih Prioritas Nasional --</option>
                                    <?php foreach ($PNMaster as $pn) { ?>
                                        <option value="<?= $pn['Id'] ?>">
                                            PN <?= $pn['Id'] ?>. <?= html_escape($pn['PrioritasNasional']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 2: Program Prioritas Nasional -->
                    <div class="form-group">
                        <label style="font-weight: 700; color: #0f172a;">
                            Program Prioritas Nasional (Kolom 2) <span class="text-danger">*</span>
                        </label>
                        <input type="hidden" id="Input_ProgramNasional" name="ProgramNasional" value="">
                        <select class="form-control select2-modal" id="Input_SelectProgramNasional" name="IdProgramNasional" required style="width: 100%;">
                            <option value="">-- Pilih Program Prioritas Nasional --</option>
                        </select>
                    </div>

                    <!-- Baris 3: Kegiatan Prioritas Nasional (Repeater Dropdown dari Master Nasional) -->
                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label style="font-weight: 700; color: #0f172a; margin: 0;">
                                Kegiatan Prioritas Nasional (Kolom 3)
                            </label>
                            <button type="button" class="btn btn-xs btn-primary" id="BtnTambahKegiatanInput">
                                <i class="fa fa-plus"></i> Tambah Kegiatan
                            </button>
                        </div>
                        <div id="ContainerKegiatanInput">
                            <div class="repeater-kegiatan-item" style="display: flex; gap: 8px; margin-bottom: 6px; align-items: center;">
                                <select class="form-control select-kegiatan-item select2-modal" name="KegiatanNasional[]" style="width: 100%;">
                                    <option value="">-- Pilih Kegiatan Prioritas Nasional --</option>
                                </select>
                                <button type="button" class="btn btn-sm btn-danger btn-remove-kegiatan" title="Hapus"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>

                    <hr style="border-top: 1px dashed #cbd5e1; margin: 18px 0;">
                    
                    <!-- Baris 4: Prioritas Pembangunan Daerah -->
                    <div class="form-group">
                        <label style="font-weight: 700; color: #0f172a; margin-bottom: 2px;">
                            Prioritas Pembangunan Daerah (Kolom 4) <span class="text-danger">*</span>
                        </label>
                        <small class="text-muted" style="display: block; font-weight: normal; margin-bottom: 5px;">
                            <i class="fa fa-info-circle text-info"></i> Mengambil data dari menu Permasalahan Daerah (Tahun <?= html_escape($SelectedTahun) ?>)
                        </small>
                        <input type="hidden" id="Input_PrioritasDaerah" name="PrioritasDaerah" value="">
                        <select class="form-control select2-modal" id="Input_IdPrioritasDaerah" name="IdPrioritasDaerah" required style="width: 100%;">
                            <option value="">-- Pilih Prioritas Pembangunan Daerah --</option>
                            <?php if (!empty($PrioritasDaerahList)) { ?>
                                <?php foreach ($PrioritasDaerahList as $p) { ?>
                                    <option value="<?= $p['id'] ?>" data-kode="<?= html_escape($p['kode']) ?>" data-prioritas="<?= html_escape($p['prioritas']) ?>">
                                        <?= html_escape($p['label']) ?>
                                    </option>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="" disabled>Belum ada data di menu Permasalahan Daerah</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Baris 5: Program Prioritas Pembangunan Daerah (Hanya Uraian) -->
                    <div class="form-group">
                        <label style="font-weight: 700; color: #0f172a;">
                            Program Prioritas Pembangunan Daerah <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="Input_ProgramPrioritasDaerah" name="ProgramPrioritasDaerah" rows="3" placeholder="Masukkan uraian Program Prioritas Pembangunan Daerah..." required></textarea>
                    </div>

                    <hr style="border-top: 1px dashed #cbd5e1; margin: 18px 0;">

                    <!-- Baris 6: Pasangan Dukungan Program & Indikator Kinerja (Repeater Table) -->
                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <div>
                                <label style="font-weight: 700; color: #0f172a; margin: 0;">
                                    Dukungan Program Pembangunan Daerah & Indikator Kinerja (Kolom 6 & 7)
                                </label>
                                <div style="font-size: 12px; color: #64748b;">Pilih program dukungan dari Dukungan RPJMD atau ketik manual beserta indikator kinerjanya.</div>
                            </div>
                            <button type="button" class="btn btn-sm btn-info" id="BtnTambahDukunganInput">
                                <i class="fa fa-plus"></i> Tambah Baris Dukungan
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="repeater-table" id="TableDukunganInput">
                                <thead>
                                    <tr>
                                        <th style="width: 48%;">Dukungan Program Pembangunan Daerah (Diambil dari Program Prioritas RPJMD)</th>
                                        <th style="width: 46%;">Indikator Kinerja (Kolom 7) <br><small style="font-weight: normal; color: #64748b;">(Otomatis terisi saat program dipilih, bisa diedit/ditambah)</small></th>
                                        <th style="width: 6%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control select-dukungan-rpjmd select2-modal" name="DukunganProgram[0][dukungan_program]" style="width: 100%;" required>
                                                <option value="">-- Pilih Program Prioritas RPJMD --</option>
                                                <?php foreach ($DukunganProgramOptions as $dOpt) { ?>
                                                    <option value="<?= html_escape($dOpt) ?>"><?= html_escape($dOpt) ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="DukunganProgram[0][indikator_kinerja]" rows="3" placeholder="1. Indikator A&#10;2. Indikator B..."></textarea>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button type="button" class="btn btn-sm btn-danger btn-remove-dukungan" title="Hapus"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="BtnSimpanInputDukungan">
                        <i class="fa fa-save"></i> <b>Simpan Data</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT DUKUNGAN PRIORITAS -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditDukungan" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" style="width: 90%; max-width: 950px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #f0ad4e; color: #ffffff;">
                <button type="button" class="close" data-dismiss="modal" style="color: #ffffff; opacity: 0.8;">&times;</button>
                <h4 class="modal-title" style="color: #ffffff; font-weight: 700; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                    <span><i class="fa fa-pencil-alt"></i> Edit Dukungan Prioritas Pembangunan</span>
                    <?php if ($SelectedTahun == '2026') { ?>
                        <span class="label label-info" style="font-size: 11px; font-weight: normal; background-color: #0284c7;">
                            <i class="fa fa-table"></i> RKP Nasional (Matriks Pembangunan)
                        </span>
                    <?php } ?>
                </h4>
            </div>
            <form id="FormEditDukungan">
                <input type="hidden" id="Edit_Id" name="Id" value="">
                <input type="hidden" name="Tahun" value="<?= html_escape($SelectedTahun) ?>">
                <?php if (!empty($KodeWilayah)) { ?>
                    <input type="hidden" name="KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">
                <?php } ?>

                <div class="modal-body" style="max-height: 75vh; overflow-y: auto; padding: 20px;">
                    <!-- Baris 1: No. & Prioritas Nasional (PN) -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="font-weight: 700; color: #0f172a;">
                                    No. (Kolom 1) <small class="text-muted">(Opsional)</small>
                                </label>
                                <input type="text" class="form-control" id="Edit_NomorPPN" name="NomorPPN" placeholder="Contoh: 1 atau 9">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label style="font-weight: 700; color: #0f172a;">
                                    Prioritas Nasional (PN) <span class="text-danger">*</span>
                                </label>
                                <select class="form-control select2-modal" id="Edit_IdPN" name="IdPN" required style="width: 100%;">
                                    <option value="">-- Pilih Prioritas Nasional --</option>
                                    <?php foreach ($PNMaster as $pn) { ?>
                                        <option value="<?= $pn['Id'] ?>">
                                            PN <?= $pn['Id'] ?>. <?= html_escape($pn['PrioritasNasional']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 2: Program Prioritas Nasional -->
                    <div class="form-group">
                        <label style="font-weight: 700; color: #0f172a;">
                            Program Prioritas Nasional (Kolom 2) <span class="text-danger">*</span>
                        </label>
                        <input type="hidden" id="Edit_ProgramNasional" name="ProgramNasional" value="">
                        <select class="form-control select2-modal" id="Edit_SelectProgramNasional" name="IdProgramNasional" required style="width: 100%;">
                            <option value="">-- Pilih Program Prioritas Nasional --</option>
                        </select>
                    </div>

                    <!-- Baris 3: Kegiatan Prioritas Nasional (Repeater Dropdown dari Master Nasional) -->
                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label style="font-weight: 700; color: #0f172a; margin: 0;">
                                Kegiatan Prioritas Nasional (Kolom 3)
                            </label>
                            <button type="button" class="btn btn-xs btn-primary" id="BtnTambahKegiatanEdit">
                                <i class="fa fa-plus"></i> Tambah Kegiatan
                            </button>
                        </div>
                        <div id="ContainerKegiatanEdit">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                    <hr style="border-top: 1px dashed #cbd5e1; margin: 18px 0;">

                    <!-- Baris 4: Prioritas Pembangunan Daerah -->
                    <div class="form-group">
                        <label style="font-weight: 700; color: #0f172a; margin-bottom: 2px;">
                            Prioritas Pembangunan Daerah (Kolom 4) <span class="text-danger">*</span>
                        </label>
                        <small class="text-muted" style="display: block; font-weight: normal; margin-bottom: 5px;">
                            <i class="fa fa-info-circle text-info"></i> Mengambil data dari menu Permasalahan Daerah (Tahun <?= html_escape($SelectedTahun) ?>)
                        </small>
                        <input type="hidden" id="Edit_PrioritasDaerah" name="PrioritasDaerah" value="">
                        <select class="form-control select2-modal" id="Edit_IdPrioritasDaerah" name="IdPrioritasDaerah" required style="width: 100%;">
                            <option value="">-- Pilih Prioritas Pembangunan Daerah --</option>
                            <?php if (!empty($PrioritasDaerahList)) { ?>
                                <?php foreach ($PrioritasDaerahList as $p) { ?>
                                    <option value="<?= $p['id'] ?>" data-kode="<?= html_escape($p['kode']) ?>" data-prioritas="<?= html_escape($p['prioritas']) ?>">
                                        <?= html_escape($p['label']) ?>
                                    </option>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="" disabled>Belum ada data di menu Permasalahan Daerah</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Baris 5: Program Prioritas Pembangunan Daerah (Hanya Uraian) -->
                    <div class="form-group">
                        <label style="font-weight: 700; color: #0f172a;">
                            Program Prioritas Pembangunan Daerah (Diambil dari Sasaran Pembangunan Daerah) <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="Edit_ProgramPrioritasDaerah" name="ProgramPrioritasDaerah" rows="3" placeholder="Masukkan uraian Program Prioritas Pembangunan Daerah..." required></textarea>
                    </div>

                    <hr style="border-top: 1px dashed #cbd5e1; margin: 18px 0;">

                    <!-- Baris 6: Pasangan Dukungan Program & Indikator Kinerja (Repeater Table) -->
                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <div>
                                <label style="font-weight: 700; color: #0f172a; margin: 0;">
                                    Dukungan Program Pembangunan Daerah & Indikator Kinerja (Kolom 6 & 7)
                                </label>
                                <div style="font-size: 12px; color: #64748b;">Kelola pasangan program dukungan dari Program Prioritas RPJMD dan indikator kinerjanya.</div>
                            </div>
                            <button type="button" class="btn btn-sm btn-info" id="BtnTambahDukunganEdit">
                                <i class="fa fa-plus"></i> Tambah Baris Dukungan
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="repeater-table" id="TableDukunganEdit">
                                <thead>
                                    <tr>
                                        <th style="width: 48%;">Dukungan Program Pembangunan Daerah (Diambil dari Program Prioritas RPJMD)</th>
                                        <th style="width: 46%;">Indikator Kinerja (Kolom 7)</th>
                                        <th style="width: 6%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning" id="BtnSimpanEditDukungan" style="color: #ffffff;">
                        <i class="fa fa-save"></i> <b>Simpan Perubahan</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';
    var BaseURL = '<?= base_url() ?>';
    var SelectedTahun = '<?= $SelectedTahun ?>';
    var DUKUNGAN_RPJMD_OPTIONS = `<?php foreach ($DukunganProgramOptions as $dOpt) { ?><option value="<?= html_escape($dOpt) ?>"><?= html_escape($dOpt) ?></option><?php } ?>`;
    var PROGRAM_INDIKATOR_MAP = <?= json_encode(!empty($ProgramToIndikatorMap) ? $ProgramToIndikatorMap : new stdClass()) ?>;
    var CURRENT_KEGIATAN_OPTIONS_INPUT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
    var CURRENT_KEGIATAN_OPTIONS_EDIT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';

    // Filter Tahun
    $('#FilterTahun').on('change', function() {
        var selected = $(this).val();
        var url = new URL(window.location.href);
        url.searchParams.set('tahun', selected);
        window.location.href = url.toString();
    });

    // Auto-fill Indikator Kinerja saat Program Prioritas RPJMD dipilih
    $(document).on('change', '.select-dukungan-rpjmd', function() {
        var prog = $(this).val();
        var $tr = $(this).closest('tr');
        var $textarea = $tr.find('textarea[name*="[indikator_kinerja]"]');
        if (prog && PROGRAM_INDIKATOR_MAP && PROGRAM_INDIKATOR_MAP[prog]) {
            var indList = PROGRAM_INDIKATOR_MAP[prog];
            if (indList && indList.length > 0) {
                var formatted = indList.length > 1
                    ? indList.map(function(item, idx) { return (idx + 1) + '. ' + item; }).join('\n')
                    : indList[0];
                $textarea.val(formatted);
            }
        }
    });



    // Inisialisasi Select2 Filter Wilayah
    $('#Provinsi, #KabKota').select2({
        width: '100%'
    });

    // Inisialisasi Select2 di Modal saat modal ditampilkan
    $('#ModalInputDukungan').on('shown.bs.modal', function () {
        $(this).find('.select2-modal').select2({
            dropdownParent: $('#ModalInputDukungan'),
            width: '100%'
        });
    });

    $('#ModalEditDukungan').on('shown.bs.modal', function () {
        $(this).find('.select2-modal').select2({
            dropdownParent: $('#ModalEditDukungan'),
            width: '100%'
        });
    });

    // Buka Modal Tambah
    $('#BtnBukaModalTambah, #BtnTambahEmpty').on('click', function() {
        $('#FormInputDukungan')[0].reset();
        CURRENT_KEGIATAN_OPTIONS_INPUT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
        $('#ContainerKegiatanInput').html(`
            <div class="repeater-kegiatan-item" style="display: flex; gap: 8px; margin-bottom: 6px; align-items: center;">
                <select class="form-control select-kegiatan-item select2-modal" name="KegiatanNasional[]" style="width: 100%;">
                    ` + CURRENT_KEGIATAN_OPTIONS_INPUT + `
                </select>
                <button type="button" class="btn btn-sm btn-danger btn-remove-kegiatan" title="Hapus"><i class="fa fa-times"></i></button>
            </div>
        `);
        $('#TableDukunganInput tbody').html(`
            <tr>
                <td>
                    <select class="form-control select-dukungan-rpjmd select2-modal" name="DukunganProgram[0][dukungan_program]" style="width: 100%;" required>
                        <option value="">-- Pilih Program Prioritas RPJMD --</option>
                        ` + DUKUNGAN_RPJMD_OPTIONS + `
                    </select>
                </td>
                <td>
                    <textarea class="form-control" name="DukunganProgram[0][indikator_kinerja]" rows="3" placeholder="Indikator Kinerja..."></textarea>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <button type="button" class="btn btn-sm btn-danger btn-remove-dukungan" title="Hapus"><i class="fa fa-times"></i></button>
                </td>
            </tr>
        `);
        $('#Input_SelectProgramNasional').html('<option value="">-- Pilih Program Prioritas Nasional --</option>');
        $('#Input_ProgramNasional').val('');
        $('#Input_PrioritasDaerah').val('');
        $('#ModalInputDukungan .select2-modal').val('').trigger('change.select2');
        $('#ModalInputDukungan').modal('show');
    });

    // ============================================================
    // REPEATER KEGIATAN & DUKUNGAN (MODAL INPUT)
    // ============================================================
    $('#BtnTambahKegiatanInput').on('click', function() {
        var html = `
            <div class="repeater-kegiatan-item" style="display: flex; gap: 8px; margin-bottom: 6px; align-items: center;">
                <select class="form-control select-kegiatan-item select2-modal" name="KegiatanNasional[]" style="width: 100%;">
                    ` + CURRENT_KEGIATAN_OPTIONS_INPUT + `
                </select>
                <button type="button" class="btn btn-sm btn-danger btn-remove-kegiatan" title="Hapus"><i class="fa fa-times"></i></button>
            </div>
        `;
        $('#ContainerKegiatanInput').append(html);
        $('#ContainerKegiatanInput .select-kegiatan-item:last').select2({
            dropdownParent: $('#ModalInputDukungan'),
            width: '100%'
        });
    });

    $(document).on('click', '.btn-remove-kegiatan', function() {
        if ($('#ContainerKegiatanInput .repeater-kegiatan-item').length > 1 || $('#ContainerKegiatanEdit .repeater-kegiatan-item').length > 1) {
            $(this).closest('.repeater-kegiatan-item').remove();
        } else {
            $(this).closest('.repeater-kegiatan-item').find('select').val('').trigger('change.select2');
        }
    });

    var inputDukunganIndex = 1;
    $('#BtnTambahDukunganInput').on('click', function() {
        var idx = inputDukunganIndex++;
        var html = `
            <tr>
                <td>
                    <select class="form-control select-dukungan-rpjmd select2-modal" name="DukunganProgram[` + idx + `][dukungan_program]" style="width: 100%;" required>
                        <option value="">-- Pilih Program Prioritas RPJMD --</option>
                        ` + DUKUNGAN_RPJMD_OPTIONS + `
                    </select>
                </td>
                <td>
                    <textarea class="form-control" name="DukunganProgram[` + idx + `][indikator_kinerja]" rows="3" placeholder="Indikator Kinerja..."></textarea>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <button type="button" class="btn btn-sm btn-danger btn-remove-dukungan" title="Hapus"><i class="fa fa-times"></i></button>
                </td>
            </tr>
        `;
        $('#TableDukunganInput tbody').append(html);
        $('#TableDukunganInput tbody tr:last .select-dukungan-rpjmd').select2({
            dropdownParent: $('#ModalInputDukungan'),
            width: '100%'
        });
    });

    $(document).on('click', '.btn-remove-dukungan', function() {
        var tbody = $(this).closest('tbody');
        if (tbody.find('tr').length > 1) {
            $(this).closest('tr').remove();
        } else {
            $(this).closest('tr').find('select').val('').trigger('change.select2');
            $(this).closest('tr').find('textarea').val('');
        }
    });

    // Dynamic fetch Program & Kegiatan saat PN dipilih (Modal Tambah)
    $('#Input_IdPN').on('change', function() {
        var idPn = $(this).val();
        $('#Input_SelectProgramNasional').html('<option value="">Memuat program' + (SelectedTahun === '2026' ? ' RKP...' : ' RPJMN...') + '</option>');
        $('#Input_ProgramNasional').val('');
        CURRENT_KEGIATAN_OPTIONS_INPUT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
        $('#ContainerKegiatanInput .select-kegiatan-item').html(CURRENT_KEGIATAN_OPTIONS_INPUT);

        if (idPn) {
            $.ajax({
                url: BaseURL + 'Daerah/GetProgramNasionalByPN',
                type: 'GET',
                data: { id_pn: idPn, tahun: SelectedTahun },
                dataType: 'json',
                success: function(res) {
                    var opt = '<option value="">-- Pilih Program Prioritas Nasional --</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            opt += '<option value="' + item.id + '" data-program="' + item.program + '">' + item.program + '</option>';
                        });
                    }
                    $('#Input_SelectProgramNasional').html(opt).trigger('change.select2');
                }
            });

            $.ajax({
                url: BaseURL + 'Daerah/GetKegiatanNasionalByProgram',
                type: 'GET',
                data: { id_pn: idPn, tahun: SelectedTahun },
                dataType: 'json',
                success: function(res) {
                    CURRENT_KEGIATAN_OPTIONS_INPUT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            CURRENT_KEGIATAN_OPTIONS_INPUT += '<option value="' + item.kegiatan + '">' + item.kegiatan + '</option>';
                        });
                    }
                    $('#ContainerKegiatanInput .select-kegiatan-item').each(function() {
                        var curr = $(this).val();
                        $(this).html(CURRENT_KEGIATAN_OPTIONS_INPUT);
                        if (curr) $(this).val(curr);
                        $(this).trigger('change.select2');
                    });
                }
            });
        } else {
            $('#Input_SelectProgramNasional').html('<option value="">-- Pilih Program Prioritas Nasional --</option>').trigger('change.select2');
        }
    });

    $('#Input_SelectProgramNasional').on('change', function() {
        var selectedTxt = $(this).find('option:selected').data('program');
        var progId = $(this).val();
        var idPn = $('#Input_IdPN').val();
        $('#Input_ProgramNasional').val(selectedTxt || '');

        if (progId) {
            $.ajax({
                url: BaseURL + 'Daerah/GetKegiatanNasionalByProgram',
                type: 'GET',
                data: { id_program: progId, id_pn: idPn, tahun: SelectedTahun },
                dataType: 'json',
                success: function(res) {
                    CURRENT_KEGIATAN_OPTIONS_INPUT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            CURRENT_KEGIATAN_OPTIONS_INPUT += '<option value="' + item.kegiatan + '">' + item.kegiatan + '</option>';
                        });
                    }
                    $('#ContainerKegiatanInput .select-kegiatan-item').each(function() {
                        var curr = $(this).val();
                        $(this).html(CURRENT_KEGIATAN_OPTIONS_INPUT);
                        if (curr) $(this).val(curr);
                        $(this).trigger('change.select2');
                    });
                }
            });
        }
    });

    // Auto populate Prioritas Daerah saat dropdown dipilih
    $('#Input_IdPrioritasDaerah').on('change', function() {
        var priTxt = $(this).find('option:selected').data('prioritas');
        $('#Input_PrioritasDaerah').val(priTxt || '');
    });

    // SUBMIT SIMPAN INPUT DUKUNGAN
    $('#FormInputDukungan').on('submit', function(e) {
        e.preventDefault();
        var btn = $('#BtnSimpanInputDukungan');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var formData = $(this).serializeArray();
        formData.push({ name: CSRF_TOKEN_NAME, value: CSRF_TOKEN_VALUE });

        $.ajax({
            url: BaseURL + 'Daerah/InputDukunganPrioritas',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    alert('✓ ' + res.message);
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan koneksi server!');
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
            }
        });
    });

    // ============================================================
    // EDIT DUKUNGAN PRIORITAS
    // ============================================================
    var editDukunganIndex = 1;
    $('#BtnTambahKegiatanEdit').on('click', function() {
        var html = `
            <div class="repeater-kegiatan-item" style="display: flex; gap: 8px; margin-bottom: 6px; align-items: center;">
                <select class="form-control select-kegiatan-item select2-modal" name="KegiatanNasional[]" style="width: 100%;">
                    ` + CURRENT_KEGIATAN_OPTIONS_EDIT + `
                </select>
                <button type="button" class="btn btn-sm btn-danger btn-remove-kegiatan" title="Hapus"><i class="fa fa-times"></i></button>
            </div>
        `;
        $('#ContainerKegiatanEdit').append(html);
        $('#ContainerKegiatanEdit .select-kegiatan-item:last').select2({
            dropdownParent: $('#ModalEditDukungan'),
            width: '100%'
        });
    });

    $('#BtnTambahDukunganEdit').on('click', function() {
        var idx = editDukunganIndex++;
        var html = `
            <tr>
                <td>
                    <select class="form-control select-dukungan-rpjmd select2-modal" name="DukunganProgram[` + idx + `][dukungan_program]" style="width: 100%;" required>
                        <option value="">-- Pilih Program Prioritas RPJMD --</option>
                        ` + DUKUNGAN_RPJMD_OPTIONS + `
                    </select>
                </td>
                <td>
                    <textarea class="form-control" name="DukunganProgram[` + idx + `][indikator_kinerja]" rows="3" placeholder="Indikator Kinerja..."></textarea>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <button type="button" class="btn btn-sm btn-danger btn-remove-dukungan" title="Hapus"><i class="fa fa-times"></i></button>
                </td>
            </tr>
        `;
        $('#TableDukunganEdit tbody').append(html);
        $('#TableDukunganEdit tbody tr:last .select-dukungan-rpjmd').select2({
            dropdownParent: $('#ModalEditDukungan'),
            width: '100%'
        });
    });

    $(document).on('click', '.BtnEditDukungan', function() {
        var id = $(this).data('id');
        var idPn = $(this).data('id_pn');
        var nomorPpn = $(this).data('nomor_ppn');
        var programNas = $(this).data('program_nasional');
        var kegiatanJson = $(this).data('kegiatan_json');
        var idPrioritasDaerah = $(this).data('id_prioritas_daerah');
        var prioritasDaerah = $(this).data('prioritas_daerah');
        var programPrioritasDaerah = $(this).data('program_prioritas_daerah');
        var dukunganJson = $(this).data('dukungan_json');

        $('#Edit_Id').val(id);
        $('#Edit_IdPN').val(idPn);
        $('#Edit_NomorPPN').val(nomorPpn);
        $('#Edit_ProgramNasional').val(programNas);
        var matchedPriVal = '';
        $('#Edit_IdPrioritasDaerah option').each(function() {
            if ($(this).val() == idPrioritasDaerah || ($(this).data('prioritas') && $(this).data('prioritas') == prioritasDaerah)) {
                matchedPriVal = $(this).val();
                return false;
            }
        });
        if (matchedPriVal) {
            $('#Edit_IdPrioritasDaerah').val(matchedPriVal);
        } else {
            $('#Edit_IdPrioritasDaerah').val(idPrioritasDaerah);
        }
        $('#Edit_PrioritasDaerah').val(prioritasDaerah);
        $('#Edit_ProgramPrioritasDaerah').val(programPrioritasDaerah);

        // Parse Kegiatan Nasional JSON
        var kList = [];
        try {
            kList = typeof kegiatanJson === 'object' ? kegiatanJson : JSON.parse(kegiatanJson);
        } catch(e) { kList = []; }

        // Fetch Program Nasional & Kegiatan Nasional options from master
        CURRENT_KEGIATAN_OPTIONS_EDIT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
        if (idPn) {
            $.ajax({
                url: BaseURL + 'Daerah/GetProgramNasionalByPN',
                type: 'GET',
                data: { id_pn: idPn, tahun: SelectedTahun },
                dataType: 'json',
                success: function(res) {
                    var opt = '<option value="">-- Pilih Program Prioritas Nasional --</option>';
                    var matchedProgId = '';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            var isSel = (item.program === programNas) ? 'selected' : '';
                            if (isSel) matchedProgId = item.id;
                            opt += '<option value="' + item.id + '" data-program="' + item.program + '" ' + isSel + '>' + item.program + '</option>';
                        });
                    }
                    $('#Edit_SelectProgramNasional').html(opt).trigger('change.select2');

                    // Fetch kegiatan for matched program or PN
                    $.ajax({
                        url: BaseURL + 'Daerah/GetKegiatanNasionalByProgram',
                        type: 'GET',
                        data: { id_program: matchedProgId, id_pn: idPn, tahun: SelectedTahun },
                        dataType: 'json',
                        success: function(kRes) {
                            CURRENT_KEGIATAN_OPTIONS_EDIT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
                            if (kRes && kRes.length > 0) {
                                $.each(kRes, function(i, item) {
                                    CURRENT_KEGIATAN_OPTIONS_EDIT += '<option value="' + item.kegiatan + '">' + item.kegiatan + '</option>';
                                });
                            }

                            // Render kegiatan dropdown items
                            var kHtml = '';
                            if (kList && kList.length > 0) {
                                $.each(kList, function(i, kegItem) {
                                    kHtml += `
                                        <div class="repeater-kegiatan-item" style="display: flex; gap: 8px; margin-bottom: 6px; align-items: center;">
                                            <select class="form-control select-kegiatan-item select2-modal" name="KegiatanNasional[]" style="width: 100%;">
                                                ` + CURRENT_KEGIATAN_OPTIONS_EDIT + `
                                            </select>
                                            <button type="button" class="btn btn-sm btn-danger btn-remove-kegiatan" title="Hapus"><i class="fa fa-times"></i></button>
                                        </div>
                                    `;
                                });
                            } else {
                                kHtml = `
                                    <div class="repeater-kegiatan-item" style="display: flex; gap: 8px; margin-bottom: 6px; align-items: center;">
                                        <select class="form-control select-kegiatan-item select2-modal" name="KegiatanNasional[]" style="width: 100%;">
                                            ` + CURRENT_KEGIATAN_OPTIONS_EDIT + `
                                        </select>
                                        <button type="button" class="btn btn-sm btn-danger btn-remove-kegiatan" title="Hapus"><i class="fa fa-times"></i></button>
                                    </div>
                                `;
                            }
                            $('#ContainerKegiatanEdit').html(kHtml);

                            // Select matching option or append if missing
                            if (kList && kList.length > 0) {
                                $('#ContainerKegiatanEdit .repeater-kegiatan-item').each(function(i) {
                                    var kegVal = kList[i];
                                    if (kegVal) {
                                        var $sel = $(this).find('.select-kegiatan-item');
                                        var found = false;
                                        $sel.find('option').each(function() {
                                            if ($(this).val() === kegVal) {
                                                found = true;
                                                return false;
                                            }
                                        });
                                        if (!found) {
                                            $sel.append('<option value="' + kegVal.replace(/"/g, '&quot;') + '">' + kegVal + '</option>');
                                        }
                                        $sel.val(kegVal);
                                    }
                                });
                            }

                            $('#ContainerKegiatanEdit .select-kegiatan-item').select2({
                                dropdownParent: $('#ModalEditDukungan'),
                                width: '100%'
                            });
                        }
                    });
                }
            });
        }

        // Render Dukungan & Indikator
        var dList = [];
        try {
            dList = typeof dukunganJson === 'object' ? dukunganJson : JSON.parse(dukunganJson);
        } catch(e) { dList = []; }

        var dHtml = '';
        if (dList && dList.length > 0) {
            $.each(dList, function(i, item) {
                var prog = item.dukungan_program || '';
                var ind = item.indikator_kinerja || '';
                dHtml += `
                    <tr>
                        <td>
                            <select class="form-control select-dukungan-rpjmd select2-modal" name="DukunganProgram[` + i + `][dukungan_program]" style="width: 100%;" required>
                                <option value="">-- Pilih Program Prioritas RPJMD --</option>
                                ` + DUKUNGAN_RPJMD_OPTIONS + `
                            </select>
                        </td>
                        <td>
                            <textarea class="form-control" name="DukunganProgram[` + i + `][indikator_kinerja]" rows="3">` + ind + `</textarea>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <button type="button" class="btn btn-sm btn-danger btn-remove-dukungan" title="Hapus"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                `;
            });
            editDukunganIndex = dList.length;
        } else {
            dHtml = `
                <tr>
                    <td>
                        <select class="form-control select-dukungan-rpjmd select2-modal" name="DukunganProgram[0][dukungan_program]" style="width: 100%;" required>
                            <option value="">-- Pilih Program Prioritas RPJMD --</option>
                            ` + DUKUNGAN_RPJMD_OPTIONS + `
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control" name="DukunganProgram[0][indikator_kinerja]" rows="3" placeholder="Indikator Kinerja..."></textarea>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button type="button" class="btn btn-sm btn-danger btn-remove-dukungan" title="Hapus"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `;
            editDukunganIndex = 1;
        }
        $('#TableDukunganEdit tbody').html(dHtml);

        // Pre-select options for each row if matches, or append custom option if not present
        if (dList && dList.length > 0) {
            $('#TableDukunganEdit tbody tr').each(function(i) {
                var prog = dList[i] ? (dList[i].dukungan_program || '') : '';
                if (prog) {
                    var $sel = $(this).find('.select-dukungan-rpjmd');
                    var exists = false;
                    $sel.find('option').each(function() {
                        if ($(this).val() === prog) {
                            exists = true;
                            return false;
                        }
                    });
                    if (!exists) {
                        $sel.append('<option value="' + prog.replace(/"/g, '&quot;') + '">' + prog + '</option>');
                    }
                    $sel.val(prog);
                }
            });
        }

        $('#TableDukunganEdit .select-dukungan-rpjmd').select2({
            dropdownParent: $('#ModalEditDukungan'),
            width: '100%'
        });

        $('#Edit_IdPN').trigger('change.select2');
        $('#Edit_IdPrioritasDaerah').trigger('change.select2');

        $('#ModalEditDukungan').modal('show');
    });

    $('#Edit_IdPN').on('change', function() {
        var idPn = $(this).val();
        $('#Edit_SelectProgramNasional').html('<option value="">Memuat program' + (SelectedTahun === '2026' ? ' RKP...' : ' RPJMN...') + '</option>');
        $('#Edit_ProgramNasional').val('');
        CURRENT_KEGIATAN_OPTIONS_EDIT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
        $('#ContainerKegiatanEdit .select-kegiatan-item').html(CURRENT_KEGIATAN_OPTIONS_EDIT);

        if (idPn) {
            $.ajax({
                url: BaseURL + 'Daerah/GetProgramNasionalByPN',
                type: 'GET',
                data: { id_pn: idPn, tahun: SelectedTahun },
                dataType: 'json',
                success: function(res) {
                    var opt = '<option value="">-- Pilih Program Prioritas Nasional --</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            opt += '<option value="' + item.id + '" data-program="' + item.program + '">' + item.program + '</option>';
                        });
                    }
                    $('#Edit_SelectProgramNasional').html(opt).trigger('change.select2');
                }
            });

            $.ajax({
                url: BaseURL + 'Daerah/GetKegiatanNasionalByProgram',
                type: 'GET',
                data: { id_pn: idPn, tahun: SelectedTahun },
                dataType: 'json',
                success: function(res) {
                    CURRENT_KEGIATAN_OPTIONS_EDIT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            CURRENT_KEGIATAN_OPTIONS_EDIT += '<option value="' + item.kegiatan + '">' + item.kegiatan + '</option>';
                        });
                    }
                    $('#ContainerKegiatanEdit .select-kegiatan-item').each(function() {
                        var curr = $(this).val();
                        $(this).html(CURRENT_KEGIATAN_OPTIONS_EDIT);
                        if (curr) $(this).val(curr);
                        $(this).trigger('change.select2');
                    });
                }
            });
        } else {
            $('#Edit_SelectProgramNasional').html('<option value="">-- Pilih Program Prioritas Nasional --</option>').trigger('change.select2');
        }
    });

    $('#Edit_SelectProgramNasional').on('change', function() {
        var selectedTxt = $(this).find('option:selected').data('program');
        var progId = $(this).val();
        var idPn = $('#Edit_IdPN').val();
        $('#Edit_ProgramNasional').val(selectedTxt || '');

        if (progId) {
            $.ajax({
                url: BaseURL + 'Daerah/GetKegiatanNasionalByProgram',
                type: 'GET',
                data: { id_program: progId, id_pn: idPn, tahun: SelectedTahun },
                dataType: 'json',
                success: function(res) {
                    CURRENT_KEGIATAN_OPTIONS_EDIT = '<option value="">-- Pilih Kegiatan Prioritas Nasional --</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            CURRENT_KEGIATAN_OPTIONS_EDIT += '<option value="' + item.kegiatan + '">' + item.kegiatan + '</option>';
                        });
                    }
                    $('#ContainerKegiatanEdit .select-kegiatan-item').each(function() {
                        var curr = $(this).val();
                        $(this).html(CURRENT_KEGIATAN_OPTIONS_EDIT);
                        if (curr) $(this).val(curr);
                        $(this).trigger('change.select2');
                    });
                }
            });
        }
    });

    $('#Edit_IdPrioritasDaerah').on('change', function() {
        var priTxt = $(this).find('option:selected').data('prioritas');
        $('#Edit_PrioritasDaerah').val(priTxt || '');
    });

    // SUBMIT EDIT DUKUNGAN
    $('#FormEditDukungan').on('submit', function(e) {
        e.preventDefault();
        var btn = $('#BtnSimpanEditDukungan');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var formData = $(this).serializeArray();
        formData.push({ name: CSRF_TOKEN_NAME, value: CSRF_TOKEN_VALUE });

        $.ajax({
            url: BaseURL + 'Daerah/EditDukunganPrioritas',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    alert('✓ ' + res.message);
                    location.reload();
                } else {
                    alert('✗ ' + res.message);
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan koneksi server!');
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
            }
        });
    });

    // ============================================================
    // HAPUS DUKUNGAN PRIORITAS
    // ============================================================
    $(document).on('click', '.BtnHapusDukungan', function() {
        var id = $(this).data('id');
        if (!confirm('Yakin ingin menghapus data dukungan prioritas ini?')) {
            return;
        }

        $.ajax({
            url: BaseURL + 'Daerah/HapusDukunganPrioritas',
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
                url: BaseURL + 'Daerah/GetListKabKota',
                type: 'POST',
                data: {
                    Kode: kodeProv,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(res) {
                    var html = '<option value="">Pilih Kab/Kota</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            html += '<option value="' + item.Kode + '">' + item.Nama + '</option>';
                        });
                    }
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
        if (!prov) { alert('Mohon Pilih Provinsi'); return; }
        if (!kabKota) { alert('Mohon Pilih Kab/Kota'); return; }

        var $btn = $(this);
        $btn.prop('disabled', true).text('Memuat...');

        $.ajax({
            url: BaseURL + 'Daerah/SetTempKodeWilayah',
            type: 'POST',
            data: {
                KodeWilayah: kabKota,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            success: function(res) {
                if (res === '1' || res.trim() === '1' || res === 'success' || res.trim() === 'success') {
                    window.location.reload();
                } else {
                    alert(res || 'Gagal menyimpan filter wilayah!');
                    $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Filter');
                }
            },
            error: function() {
                alert('Gagal menghubungi server!');
                $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Filter');
            }
        });
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var curKodeDukungan = "<?= $KodeWilayah ?>";
        var curProvDukungan = curKodeDukungan.substring(0, 2);
        if ($('#Provinsi').val() && $('#KabKota option').length <= 1) {
            $.ajax({
                url: BaseURL + 'Daerah/GetListKabKota',
                type: 'POST',
                data: {
                    Kode: curProvDukungan,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                dataType: 'json',
                success: function(res) {
                    var html = '<option value="">Pilih Kab/Kota</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            var sel = (item.Kode === curKodeDukungan) ? 'selected' : '';
                            html += '<option value="' + item.Kode + '" ' + sel + '>' + item.Nama + '</option>';
                        });
                    }
                    $('#KabKota').html(html);
                }
            });
        }
    <?php } ?>
});
</script>
