<?php 
$this->load->view('Daerah/sidebar'); 
$this->load->view('Daerah/Cssumum'); 

// Helper function to format list of missions with clean dividers
if (!function_exists('renderMisiItems')) {
    function renderMisiItems($misiJsonOrCsv, $misiMap = []) {
        if (empty($misiJsonOrCsv)) {
            return '<span class="text-muted">-</span>';
        }
        $ids = [];
        if (is_array($misiJsonOrCsv)) {
            $ids = $misiJsonOrCsv;
        } else {
            $decoded = json_decode($misiJsonOrCsv, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $ids = $decoded;
            } else {
                $ids = explode(',', $misiJsonOrCsv);
            }
        }
        $output = [];
        foreach ($ids as $val) {
            $val = trim((string)$val);
            if ($val === '') continue;
            if (isset($misiMap[$val])) {
                $output[] = $misiMap[$val];
            } else {
                $output[] = $val;
            }
        }
        if (empty($output)) {
            return '<span class="text-muted">-</span>';
        }
        
        $html = '<div class="misi-item-stack">';
        foreach ($output as $idx => $item) {
            if ($idx > 0) {
                $html .= '<div class="misi-divider-line"></div>';
            }
            $html .= '<div class="misi-text-block">' . nl2br(htmlspecialchars($item)) . '</div>';
        }
        $html .= '</div>';
        return $html;
    }
}

$userLevel = isset($_SESSION['Level']) ? (int)$_SESSION['Level'] : (isset($_SESSION['userLevel']) ? (int)$_SESSION['userLevel'] : null);
$canManage = ($userLevel === 0 || $userLevel === 3);
?>

<style>
    :root {
        --theme-green-primary: #00c292;
        --theme-green-dark: #008f6b;
        --theme-green-hover: #00a87e;
        --theme-green-light: #f0fdf4;
        --theme-green-border: #a7f3d0;
    }

    .table-keselarasan {
        width: 100% !important;
        border-collapse: collapse !important;
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .table-keselarasan thead th {
        background-color: var(--theme-green-primary) !important;
        color: #ffffff !important;
        font-weight: 700;
        text-align: center;
        vertical-align: middle !important;
        border: 1px solid var(--theme-green-hover) !important;
        padding: 12px 10px;
        font-size: 13.5px;
        letter-spacing: 0.3px;
    }
    .table-keselarasan tbody td {
        vertical-align: top !important;
        border: 1px solid #e5e7eb !important;
        padding: 12px 14px !important;
        font-size: 13px;
        line-height: 1.55;
        color: #374151;
    }
    .table-keselarasan tbody tr:hover {
        background-color: var(--theme-green-light) !important;
    }
    .misi-item-stack {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .misi-divider-line {
        height: 1px;
        background-color: #d1d5db;
        margin: 4px 0;
    }
    .misi-text-block {
        line-height: 1.5;
        text-align: left;
    }
    .card-header-title {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
    }
    .card-header-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 15px;
    }
    .filter-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }
    .btn-action-group {
        display: flex;
        gap: 6px;
        justify-content: center;
        align-items: center;
    }
    .btn-action-group .btn {
        padding: 5px 9px;
        font-size: 12px;
        border-radius: 4px;
    }

    /* Modal Dialog & Scrollable Body */
    .modal-dialog-custom {
        max-width: 860px !important;
        width: 92% !important;
        margin: 25px auto !important;
    }
    .modal-body-scrollable {
        max-height: 68vh !important;
        overflow-y: auto !important;
        padding: 22px 25px !important;
        background-color: #f8fafc;
    }
    .modal-body-scrollable::-webkit-scrollbar {
        width: 7px;
    }
    .modal-body-scrollable::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .modal-body-scrollable::-webkit-scrollbar-thumb {
        background: #00c292;
        border-radius: 4px;
    }
    .modal-body-scrollable::-webkit-scrollbar-thumb:hover {
        background: #008f6b;
    }
    
    /* Form Field Card */
    .form-field-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 15px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-field-card:focus-within {
        border-color: #00c292;
        box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.12);
    }
    .form-field-card label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .form-field-card label .field-hint {
        font-size: 11.5px;
        font-weight: 400;
        color: #64748b;
    }
    .form-field-card select.form-control {
        height: 42px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        font-size: 13px !important;
    }

    /* Multi-select Checklist Box */
    .checklist-container {
        max-height: 180px;
        overflow-y: auto;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 8px 12px;
        background-color: #ffffff;
    }
    .checklist-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 6px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
        color: #334155;
        cursor: pointer;
        line-height: 1.4;
    }
    .checklist-item:last-child {
        border-bottom: none;
    }
    .checklist-item input[type="checkbox"] {
        margin-top: 3px;
        cursor: pointer;
        accent-color: #00c292;
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }
    .checklist-item span {
        flex-grow: 1;
    }
    .checklist-item:hover {
        background-color: #f8fafc;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list" style="padding: 25px; border-radius: 8px; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        
                        <!-- Header Title -->
                        <div class="basic-tb-hd" style="border-bottom: 1px solid #f3f4f6; padding-bottom: 15px; margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <h2 class="card-header-title">
                                        <i class="fa fa-handshake-o" style="color: #00c292; margin-right: 8px;"></i>
                                        Tabel 3.1 Keselarasan untuk Mendukung Tercapainya Asta Cita dan Misi <?= html_escape($NamaProvinsi) ?>
                                    </h2>
                                    <p class="card-header-subtitle">
                                        Wilayah: <strong><?= !empty($NamaWilayah) ? html_escape($NamaWilayah) : 'Pilih Wilayah Terlebih Dahulu' ?></strong>
                                    </p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <?php if ($canManage && !empty($KodeWilayah)) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" id="BtnTambahKeselarasan" style="border-radius: 6px; background-color: #00c292; border-color: #00c292;">
                                        <i class="fa fa-plus"></i> <b>Tambah Keselarasan</b>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Wilayah & Periode -->
                        <div class="filter-box">
                            <div class="row">
                                <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="Provinsi">Provinsi</label>
                                        <select class="form-control filter-select" id="Provinsi" style="width: 100%;">
                                            <option value="">-- Pilih Provinsi --</option>
                                            <?php foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="KabKota">Kabupaten / Kota</label>
                                        <select class="form-control filter-select" id="KabKota" style="width: 100%;">
                                            <option value="">-- Pilih Kab/Kota --</option>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="FilterPeriode">Periode RPJMD</label>
                                        <select class="form-control" id="FilterPeriode" style="width: 100%;">
                                            <option value="">-- Semua Periode --</option>
                                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                                                $selectedP = (isset($selectedPeriode) && $selectedPeriode == $valP) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $valP ?>" <?= $selectedP ?>>
                                                    <?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?>
                                                </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <div class="form-group" style="margin-top: 25px;">
                                        <button class="btn btn-success notika-btn-success btn-block" id="BtnTerapkanFilter" style="border-radius: 6px; background-color: #00c292; border-color: #00c292;">
                                            <i class="fa fa-filter"></i> <b>Filter</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Notice jika belum ada wilayah -->
                        <?php if (empty($KodeWilayah)) { ?>
                            <div class="alert alert-warning" style="border-radius: 6px;">
                                <i class="fa fa-info-circle"></i> Silakan pilih Provinsi dan Kabupaten/Kota terlebih dahulu untuk melihat Tabel Keselarasan.
                            </div>
                        <?php } ?>

                        <!-- Tabel Keselarasan Asta Cita & Misi -->
                        <div class="table-responsive" style="margin-top: 15px;">
                            <table class="table table-bordered table-keselarasan" id="tabelKeselarasan">
                                <thead>
                                    <tr>
                                        <th style="width: 4%;">No</th>
                                        <th style="width: 32%;">Asta Cita</th>
                                        <th style="width: 32%;">Misi <?= html_escape($NamaProvinsi) ?></th>
                                        <th style="width: 26%;">Misi <?= html_escape($NamaWilayah) ?></th>
                                        <?php if ($canManage) { ?>
                                        <th style="width: 6%;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($Keselarasan)) { 
                                        $no = 1;
                                        foreach ($Keselarasan as $row) {
                                            $pnNumber = $row['id_prioritas_nasional'];
                                            $pnLabel = '<strong>PN' . $pnNumber . '.</strong> ' . htmlspecialchars($row['nama_pn'] ?? '-');
                                    ?>
                                        <tr>
                                            <td class="text-center" style="font-weight: 600;"><?= $no++ ?></td>
                                            <td style="color: #1e293b; font-weight: 600;">
                                                <?= $pnLabel ?>
                                                <?php if (!empty($row['tahun_mulai']) && !empty($row['tahun_akhir'])) { ?>
                                                    <div style="margin-top: 6px;">
                                                        <span class="badge" style="background-color: #ecfdf5; color: #065f46; font-size: 11px; border: 1px solid #a7f3d0; font-weight: 600;">
                                                            <?= html_escape($row['tahun_mulai']) ?> - <?= html_escape($row['tahun_akhir']) ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td><?= renderMisiItems($row['id_misi_provinsi'], $MisiProvMap) ?></td>
                                            <td><?= renderMisiItems($row['id_misi_daerah'], $MisiDaerahMap) ?></td>
                                            <?php if ($canManage) { ?>
                                            <td class="text-center" style="vertical-align: middle !important;">
                                                <div class="btn-action-group">
                                                    <button type="button" class="btn btn-sm EditKeselarasan" 
                                                            data-id="<?= $row['id'] ?>" 
                                                            title="Edit Data" 
                                                            style="background: #00c292; border-color: #00a87e; color: #fff;">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm HapusKeselarasan" 
                                                            data-id="<?= $row['id'] ?>" 
                                                            title="Hapus Data" 
                                                            style="background: #ef4444; border-color: #dc2626; color: #fff;">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php 
                                        } 
                                    } else { ?>
                                        <tr>
                                            <td colspan="<?= $canManage ? '5' : '4' ?>" class="text-center text-muted" style="padding: 30px !important;">
                                                <i class="fa fa-folder-open-o fa-2x" style="display: block; margin-bottom: 8px; color: #9ca3af;"></i>
                                                Belum ada data Keselarasan untuk wilayah ini.
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

<!-- MODAL TAMBAH KESELARASAN -->
<div class="modal fade" id="ModalTambahKeselarasan" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; text-align: left; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #00c292 0%, #008f6b 100%); color: #fff; padding: 16px 24px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="color: #fff; font-weight: 700; font-size: 16px;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Keselarasan Asta Cita & Misi
                </h4>
            </div>
            <form id="FormTambahKeselarasan">
                <div class="modal-body modal-body-scrollable">
                    
                    <!-- 1. Periode RPJMD -->
                    <div class="form-field-card">
                        <label for="TambahPeriodeRPJMD">
                            <span>1. Periode RPJMD <span class="text-danger">*</span></span>
                            <span class="field-hint">Pilih periode berlaku dokumen</span>
                        </label>
                        <select class="form-control" name="PeriodeRPJMD" id="TambahPeriodeRPJMD" required>
                            <option value="">-- Pilih Periode --</option>
                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                            ?>
                                <option value="<?= $valP ?>"><?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?></option>
                            <?php } } else { ?>
                                <option value="2025-2029">2025 - 2029</option>
                                <option value="2026-2030">2026 - 2030</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- 2. Dropdown Asta Cita (PN) -->
                    <div class="form-field-card">
                        <label for="TambahAstaCita">
                            <span>2. Asta Cita (Prioritas Nasional / PN) <span class="text-danger">*</span></span>
                            <span class="field-hint">Ditarik dari data PN Menu Kementerian</span>
                        </label>
                        <select class="form-control" name="id_prioritas_nasional" id="TambahAstaCita" required>
                            <option value="">-- Pilih Asta Cita (PN) --</option>
                            <?php if (!empty($ListAstaCita)) { foreach ($ListAstaCita as $pn) { ?>
                                <option value="<?= $pn['Id'] ?>">
                                    PN<?= $pn['Id'] ?>. <?= htmlspecialchars($pn['PrioritasNasional']) ?>
                                </option>
                            <?php } } ?>
                        </select>
                    </div>

                    <!-- 3. Misi Provinsi (Checklist / Dropdown Pilihan) -->
                    <div class="form-field-card">
                        <label>
                            <span>3. Misi <?= html_escape($NamaProvinsi) ?></span>
                            <span class="field-hint">Ditarik dari VMTS Menu Provinsi (Pilih satu atau lebih)</span>
                        </label>
                        <div class="checklist-container" id="ContainerMisiProvinsiTambah">
                            <?php if (!empty($ListMisiProvinsi)) { foreach ($ListMisiProvinsi as $mp) { ?>
                                <label class="checklist-item">
                                    <input type="checkbox" name="id_misi_provinsi[]" value="<?= $mp['Id'] ?>">
                                    <span><?= htmlspecialchars($mp['Misi']) ?></span>
                                </label>
                            <?php } } else { ?>
                                <p class="text-muted" style="margin: 5px 0;">Belum ada data Misi pada VMTS Provinsi.</p>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- 4. Misi Kabupaten / Kota (Checklist / Dropdown Pilihan) -->
                    <div class="form-field-card">
                        <label>
                            <span>4. Misi <?= html_escape($NamaWilayah) ?></span>
                            <span class="field-hint">Ditarik dari VMTS Menu Daerah (Pilih satu atau lebih)</span>
                        </label>
                        <div class="checklist-container" id="ContainerMisiDaerahTambah">
                            <?php if (!empty($ListMisiDaerah)) { foreach ($ListMisiDaerah as $md) { ?>
                                <label class="checklist-item">
                                    <input type="checkbox" name="id_misi_daerah[]" value="<?= $md['Id'] ?>">
                                    <span><?= htmlspecialchars($md['Misi']) ?></span>
                                </label>
                            <?php } } else { ?>
                                <p class="text-muted" style="margin: 5px 0;">Belum ada data Misi pada VMTS Daerah ini.</p>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="background-color: #ffffff; border-top: 1px solid #e2e8f0; padding: 14px 25px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; padding: 7px 18px;">Batal</button>
                    <button type="submit" class="btn btn-success notika-btn-success" id="BtnSimpanTambahKeselarasan" style="background-color: #00c292; border-color: #00c292; border-radius: 6px; padding: 7px 20px;">
                        <i class="fa fa-save"></i> <b>Simpan Data</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT KESELARASAN -->
<div class="modal fade" id="ModalEditKeselarasan" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; text-align: left; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #00c292 0%, #00a87e 100%); color: #fff; padding: 16px 24px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="color: #fff; font-weight: 700; font-size: 16px;">
                    <i class="fa fa-edit" style="margin-right: 6px;"></i> Edit Keselarasan Asta Cita & Misi
                </h4>
            </div>
            <form id="FormEditKeselarasan">
                <input type="hidden" name="id" id="EditId">
                <div class="modal-body modal-body-scrollable">
                    
                    <!-- 1. Periode RPJMD -->
                    <div class="form-field-card">
                        <label for="EditPeriodeRPJMD">
                            <span>1. Periode RPJMD <span class="text-danger">*</span></span>
                            <span class="field-hint">Pilih periode berlaku dokumen</span>
                        </label>
                        <select class="form-control" name="EditPeriodeRPJMD" id="EditPeriodeRPJMD" required>
                            <option value="">-- Pilih Periode --</option>
                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                            ?>
                                <option value="<?= $valP ?>"><?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?></option>
                            <?php } } else { ?>
                                <option value="2025-2029">2025 - 2029</option>
                                <option value="2026-2030">2026 - 2030</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- 2. Dropdown Asta Cita (PN) -->
                    <div class="form-field-card">
                        <label for="EditAstaCita">
                            <span>2. Asta Cita (Prioritas Nasional / PN) <span class="text-danger">*</span></span>
                            <span class="field-hint">Ditarik dari data PN Menu Kementerian</span>
                        </label>
                        <select class="form-control" name="id_prioritas_nasional" id="EditAstaCita" required>
                            <option value="">-- Pilih Asta Cita (PN) --</option>
                            <?php if (!empty($ListAstaCita)) { foreach ($ListAstaCita as $pn) { ?>
                                <option value="<?= $pn['Id'] ?>">
                                    PN<?= $pn['Id'] ?>. <?= htmlspecialchars($pn['PrioritasNasional']) ?>
                                </option>
                            <?php } } ?>
                        </select>
                    </div>

                    <!-- 3. Misi Provinsi (Checklist / Dropdown Pilihan) -->
                    <div class="form-field-card">
                        <label>
                            <span>3. Misi <?= html_escape($NamaProvinsi) ?></span>
                            <span class="field-hint">Ditarik dari VMTS Menu Provinsi (Pilih satu atau lebih)</span>
                        </label>
                        <div class="checklist-container" id="ContainerMisiProvinsiEdit">
                            <?php if (!empty($ListMisiProvinsi)) { foreach ($ListMisiProvinsi as $mp) { ?>
                                <label class="checklist-item">
                                    <input type="checkbox" name="id_misi_provinsi[]" value="<?= $mp['Id'] ?>" class="edit-misi-prov-chk">
                                    <span><?= htmlspecialchars($mp['Misi']) ?></span>
                                </label>
                            <?php } } else { ?>
                                <p class="text-muted" style="margin: 5px 0;">Belum ada data Misi pada VMTS Provinsi.</p>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- 4. Misi Kabupaten / Kota (Checklist / Dropdown Pilihan) -->
                    <div class="form-field-card">
                        <label>
                            <span>4. Misi <?= html_escape($NamaWilayah) ?></span>
                            <span class="field-hint">Ditarik dari VMTS Menu Daerah (Pilih satu atau lebih)</span>
                        </label>
                        <div class="checklist-container" id="ContainerMisiDaerahEdit">
                            <?php if (!empty($ListMisiDaerah)) { foreach ($ListMisiDaerah as $md) { ?>
                                <label class="checklist-item">
                                    <input type="checkbox" name="id_misi_daerah[]" value="<?= $md['Id'] ?>" class="edit-misi-daerah-chk">
                                    <span><?= htmlspecialchars($md['Misi']) ?></span>
                                </label>
                            <?php } } else { ?>
                                <p class="text-muted" style="margin: 5px 0;">Belum ada data Misi pada VMTS Daerah ini.</p>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="background-color: #ffffff; border-top: 1px solid #e2e8f0; padding: 14px 25px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; padding: 7px 18px;">Batal</button>
                    <button type="submit" class="btn btn-success notika-btn-success" id="BtnSimpanEditKeselarasan" style="background-color: #00c292; border-color: #00c292; border-radius: 6px; padding: 7px 20px;">
                        <i class="fa fa-save"></i> <b>Simpan Perubahan</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var BaseURL = "<?= base_url() ?>";
    var CurrentKodeWilayah = "<?= $KodeWilayah ?>";

    $(document).ready(function() {

        // Filter Wilayah (Provinsi -> Kab/Kota)
        $('#Provinsi').on('change', function() {
            var provKode = $(this).val();
            var $kabSelect = $('#KabKota');
            $kabSelect.html('<option value="">-- Pilih Kab/Kota --</option>');
            
            if (provKode) {
                $.ajax({
                    url: BaseURL + 'Daerah/KabKota',
                    type: 'POST',
                    data: { Kode: provKode },
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(index, item) {
                            var isSelected = (CurrentKodeWilayah == item.Kode) ? 'selected' : '';
                            $kabSelect.append('<option value="' + item.Kode + '" ' + isSelected + '>' + item.Nama + '</option>');
                        });
                    }
                });
            }
        });

        // Trigger change jika provinsi sudah terisi
        if ($('#Provinsi').val()) {
            $('#Provinsi').trigger('change');
        }

        // Tombol Terapkan Filter
        $('#BtnTerapkanFilter').on('click', function() {
            var kabKode = $('#KabKota').val();
            var periode = $('#FilterPeriode').val();

            if (kabKode) {
                $.ajax({
                    url: BaseURL + 'Daerah/SetSessionWilayah',
                    type: 'POST',
                    data: { KodeWilayah: kabKode },
                    success: function() {
                        var url = BaseURL + 'Daerah/TabelKeselarasan';
                        if (periode) {
                            url += '?periode=' + encodeURIComponent(periode);
                        }
                        window.location.href = url;
                    },
                    error: function() {
                        var url = BaseURL + 'Daerah/TabelKeselarasan';
                        if (periode) {
                            url += '?periode=' + encodeURIComponent(periode);
                        }
                        window.location.href = url;
                    }
                });
            } else {
                var url = BaseURL + 'Daerah/TabelKeselarasan';
                if (periode) {
                    url += '?periode=' + encodeURIComponent(periode);
                }
                window.location.href = url;
            }
        });

        // Buka Modal Tambah
        $('#BtnTambahKeselarasan').on('click', function() {
            $('#FormTambahKeselarasan')[0].reset();
            var curPeriode = $('#FilterPeriode').val();
            if (curPeriode) {
                $('#TambahPeriodeRPJMD').val(curPeriode);
            }
            $('#ModalTambahKeselarasan').modal('show');
        });

        // Submit Form Tambah
        $('#FormTambahKeselarasan').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $('#BtnSimpanTambahKeselarasan').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/InputKeselarasan',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    $('#BtnSimpanTambahKeselarasan').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Terjadi kesalahan saat menyimpan data.'
                        });
                    }
                },
                error: function() {
                    $('#BtnSimpanTambahKeselarasan').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan pada server.'
                    });
                }
            });
        });

        // Buka Modal Edit
        $(document).on('click', '.EditKeselarasan', function() {
            var id = $(this).data('id');
            if (!id) return;

            $.ajax({
                url: BaseURL + 'Daerah/GetKeselarasanById',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success' && res.data) {
                        var d = res.data;
                        $('#EditId').val(d.id);
                        
                        var perVal = d.tahun_mulai + '-' + d.tahun_akhir;
                        $('#EditPeriodeRPJMD').val(perVal);
                        if (!$('#EditPeriodeRPJMD').val()) {
                            $('#EditPeriodeRPJMD').append('<option value="' + perVal + '" selected>' + d.tahun_mulai + ' - ' + d.tahun_akhir + '</option>');
                        }

                        $('#EditAstaCita').val(d.id_prioritas_nasional);

                        // Uncheck all checkboxes first
                        $('.edit-misi-prov-chk').prop('checked', false);
                        $('.edit-misi-daerah-chk').prop('checked', false);

                        // Check selected Provinsi missions
                        if (d.id_misi_provinsi_array && Array.isArray(d.id_misi_provinsi_array)) {
                            d.id_misi_provinsi_array.forEach(function(val) {
                                $('.edit-misi-prov-chk[value="' + val + '"]').prop('checked', true);
                            });
                        }

                        // Check selected Daerah missions
                        if (d.id_misi_daerah_array && Array.isArray(d.id_misi_daerah_array)) {
                            d.id_misi_daerah_array.forEach(function(val) {
                                $('.edit-misi-daerah-chk[value="' + val + '"]').prop('checked', true);
                            });
                        }

                        $('#ModalEditKeselarasan').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Data tidak ditemukan.'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengambil data dari server.'
                    });
                }
            });
        });

        // Submit Form Edit
        $('#FormEditKeselarasan').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $('#BtnSimpanEditKeselarasan').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateKeselarasan',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    $('#BtnSimpanEditKeselarasan').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Terjadi kesalahan saat memperbarui data.'
                        });
                    }
                },
                error: function() {
                    $('#BtnSimpanEditKeselarasan').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan pada server.'
                    });
                }
            });
        });

        // Hapus Keselarasan
        $(document).on('click', '.HapusKeselarasan', function() {
            var id = $(this).data('id');
            if (!id) return;

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data Keselarasan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: BaseURL + 'Daerah/DeleteKeselarasan',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message || 'Gagal menghapus data.'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan pada server saat menghapus data.'
                            });
                        }
                    });
                }
            });
        });

    });
</script>
