<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$userLevel = $_SESSION['Level'] ?? (isset($this) ? ($this->session->userdata('Level') ?? null) : null);
$isLoggedIn = !empty($_SESSION['isLoggedIn']) || (isset($this) && !empty($this->session->userdata('isLoggedIn')));
$canEdit = $isLoggedIn && ($userLevel !== null && $userLevel !== '' && (string)$userLevel === '0');

// Helper untuk format tampilan Sumber Dana (Setiap baris berawalan bullet "· ")
if (!function_exists('formatSumberDanaKPU')) {
    function formatSumberDanaKPU($text) {
        if (empty(trim($text))) return '<span style="color:#aaa; font-style:italic;">(Belum diatur)</span>';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $output = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;
            // Bersihkan bullet atau tanda strip/titik di awal
            $clean = preg_replace('/^[\s\x{00B7}\x{2022}\-\*\.]+\s*/u', '', $line);
            if ($clean !== '') {
                $output[] = '&middot; ' . htmlspecialchars($clean);
            }
        }
        return empty($output) ? '<span style="color:#aaa; font-style:italic;">(Belum diatur)</span>' : implode('<br>', $output);
    }
}

// Helper untuk format tampilan Pelaksana (Diawali "Antara Lain:" lalu tiap baris berawalan bullet "· ")
if (!function_exists('formatPelaksanaKPU')) {
    function formatPelaksanaKPU($text) {
        if (empty(trim($text))) return '<span style="color:#aaa; font-style:italic;">(Belum diatur)</span>';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $output = [];
        $hasAntaraLain = false;

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;

            if (stripos($line, 'Antara Lain') !== false) {
                $output[] = htmlspecialchars($line);
                $hasAntaraLain = true;
            } else {
                $clean = preg_replace('/^[\s\x{00B7}\x{2022}\-\*\.]+\s*/u', '', $line);
                if ($clean !== '') {
                    $output[] = '&middot; ' . htmlspecialchars($clean);
                }
            }
        }

        // Jika user belum menyertakan "Antara Lain:", otomatis tambahkan di baris paling atas
        if (!$hasAntaraLain && !empty($output)) {
            array_unshift($output, 'Antara Lain:');
        }

        return empty($output) ? '<span style="color:#aaa; font-style:italic;">(Belum diatur)</span>' : implode('<br>', $output);
    }
}
?>
<style>
    /* CSS Modal Vertical Center */
    .modal {
        text-align: center;
        padding: 0!important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        width: 680px;
        max-width: 95%;
    }
    .modal-header h2 {
        font-size: 18px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /* CSS Card Container Enhancement */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    /* CSS Table Enhancement - Selaras dengan Halaman Lain (#f8f9fa / #455a64) */
    #kpu-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }
    #kpu-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border: 1px solid #e0e0e0;
        text-align: center;
        vertical-align: middle;
        padding: 10px 8px;
    }
    #kpu-table td {
        border: 1px solid #e9ecef;
        padding: 8px 10px;
        vertical-align: top;
        color: #333;
        font-size: 12px;
        line-height: 1.6;
    }

    /* Hover baris tabel */
    #kpu-table tbody tr:hover {
        background-color: #fbfcfd;
    }

    /* Styling Sel Sesuai Level */
    td.cell-pn {
        background-color: #f8fafc;
        border-left: 4px solid #00c292 !important;
        font-weight: 600;
        color: #2c3e50;
    }
    td.cell-kp {
        background-color: #ffffff;
        border-left: 3px solid #03a9f4 !important;
        color: #37474f;
    }
    td.cell-sasaran {
        background-color: #ffffff;
        border-left: 3px solid #ff9800 !important;
        color: #333;
    }
    td.cell-dana {
        background-color: #ffffff;
        color: #333;
        position: relative;
    }
    td.cell-pelaksana {
        background-color: #ffffff;
        color: #333;
        position: relative;
    }
    td.cell-aksi {
        background-color: #fafbfc;
        text-align: center;
        vertical-align: middle !important;
        white-space: nowrap;
    }

    /* Action Buttons */
    .btn-action {
        border-radius: 4px;
        padding: 4px 8px;
        font-size: 11px;
        font-weight: 600;
        margin: 2px 1px;
        transition: all 0.2s ease;
        display: inline-block;
    }
    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
    }
    .action-group {
        margin-top: 8px;
        padding-top: 6px;
        border-top: 1px dashed #e0e0e0;
        display: flex;
        flex-wrap: wrap;
        gap: 3px;
    }

    .badge-pn-tag {
        background-color: #00c292;
        color: #fff;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        margin-right: 4px;
        display: inline-block;
    }
    .badge-kp-tag {
        background-color: #03a9f4;
        color: #fff;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        margin-right: 4px;
        display: inline-block;
    }

    /* Alert Banner Induk Otomatis */
    .info-induk-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        border-radius: 6px;
        margin-bottom: 16px;
    }
    .info-induk-label {
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 3px;
    }
    .info-induk-text {
        font-size: 13px;
        font-weight: 600;
        line-height: 1.4;
    }

    /* Quick Preset Buttons (Pills) */
    .quick-preset-container {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-bottom: 8px;
    }
    .btn-quick-preset {
        background-color: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #334155;
        border-radius: 14px;
        padding: 2px 10px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .btn-quick-preset:hover {
        background-color: #0284c7;
        border-color: #0284c7;
        color: #ffffff;
    }

    /* Tombol Edit Mini di Kolom Dana & Pelaksana */
    .btn-edit-col {
        margin-top: 8px;
        padding: 2px 6px;
        font-size: 10px;
        border-radius: 3px;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        color: #475569;
        display: inline-block;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-edit-col:hover {
        background: #0284c7;
        color: #fff;
        border-color: #0284c7;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <div>
                            <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Hierarki Kegiatan Prioritas Utama RPJMN</h3>
                            <small style="color: #666;">Prioritas Pembangunan &rarr; Kegiatan Prioritas &rarr; Sasaran, Sumber Dana & Pelaksana</small>
                        </div>
                        <?php if ($canEdit) { ?>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputPrioritas" style="padding: 8px 16px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Prioritas Pembangunan</b>
                            </button>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="table-responsive">
                        <table id="kpu-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 22%;">Prioritas Pembangunan</th>
                                    <th style="width: 22%;">Kegiatan Prioritas</th>
                                    <th style="width: 26%;">Sasaran</th>
                                    <th style="width: 14%;">Sumber Dana</th>
                                    <th style="width: 16%;">Pelaksana</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!empty($KPU)) {
                                    foreach ($KPU as $p) {
                                        $kegiatanList = $p['kegiatan'] ?? [];
                                        
                                        // Hitung total baris untuk Prioritas Pembangunan
                                        $p_total_rows = 0;
                                        if (empty($kegiatanList)) {
                                            $p_total_rows = 1;
                                        } else {
                                            foreach ($kegiatanList as $k) {
                                                $s_count = count($k['sasaran'] ?? []);
                                                $p_total_rows += ($s_count > 0 ? $s_count : 1);
                                            }
                                        }

                                        $is_first_p_row = true;
                                        $pnLabel = ($p['Kode'] ? $p['Kode'] . ': ' : '') . $p['PrioritasPembangunan'];

                                        if (empty($kegiatanList)) {
                                            // Kasus Prioritas belum ada Kegiatan
                                ?>
                                            <tr>
                                                <td rowspan="1" class="cell-pn">
                                                    <?php if (!empty($p['Kode'])) { ?>
                                                        <span class="badge-pn-tag"><?= htmlspecialchars($p['Kode']) ?></span>
                                                    <?php } ?>
                                                    <div><?= nl2br(htmlspecialchars($p['PrioritasPembangunan'])) ?></div>
                                                    <?php if ($canEdit) { ?>
                                                    <div class="action-group">
                                                        <button class="btn btn-xs btn-success btn-action TambahKegiatanBtn" data-id="<?= $p['Id'] ?>" data-pn="<?= htmlspecialchars($pnLabel, ENT_QUOTES) ?>" title="Tambah KP"><i class="fa fa-plus"></i> KP</button>
                                                        <button class="btn btn-xs btn-info btn-action EditPrioritasBtn" data-id="<?= $p['Id'] ?>" data-kode="<?= htmlspecialchars($p['Kode'], ENT_QUOTES) ?>" data-nama="<?= htmlspecialchars($p['PrioritasPembangunan'], ENT_QUOTES) ?>" title="Edit Prioritas"><i class="fa fa-pencil"></i></button>
                                                        <button class="btn btn-xs btn-danger btn-action HapusPrioritasBtn" data-id="<?= $p['Id'] ?>" title="Hapus Prioritas"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                    <?php } ?>
                                                </td>
                                                <td colspan="4" style="color: #999; font-style: italic; text-align: center; vertical-align: middle;">
                                                    Belum ada Kegiatan Prioritas. 
                                                    <?php if ($canEdit) { ?>
                                                    <button class="btn btn-xs btn-success btn-action TambahKegiatanBtn" data-id="<?= $p['Id'] ?>" data-pn="<?= htmlspecialchars($pnLabel, ENT_QUOTES) ?>"><i class="fa fa-plus"></i> Tambah KP</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                <?php
                                        } else {
                                            foreach ($kegiatanList as $k) {
                                                $sasaranList = $k['sasaran'] ?? [];
                                                $k_total_rows = count($sasaranList) > 0 ? count($sasaranList) : 1;
                                                $is_first_k_row = true;
                                                $kpLabel = ($k['Kode'] ? $k['Kode'] . ' - ' : '') . $k['KegiatanPrioritas'];

                                                if (empty($sasaranList)) {
                                                    // Kasus Kegiatan belum ada Sasaran
                                ?>
                                                    <tr>
                                                        <?php if ($is_first_p_row) { ?>
                                                        <td rowspan="<?= $p_total_rows ?>" class="cell-pn">
                                                            <?php if (!empty($p['Kode'])) { ?>
                                                                <span class="badge-pn-tag"><?= htmlspecialchars($p['Kode']) ?></span>
                                                            <?php } ?>
                                                            <div><?= nl2br(htmlspecialchars($p['PrioritasPembangunan'])) ?></div>
                                                            <?php if ($canEdit) { ?>
                                                            <div class="action-group">
                                                                <button class="btn btn-xs btn-success btn-action TambahKegiatanBtn" data-id="<?= $p['Id'] ?>" data-pn="<?= htmlspecialchars($pnLabel, ENT_QUOTES) ?>" title="Tambah KP"><i class="fa fa-plus"></i> KP</button>
                                                                <button class="btn btn-xs btn-info btn-action EditPrioritasBtn" data-id="<?= $p['Id'] ?>" data-kode="<?= htmlspecialchars($p['Kode'], ENT_QUOTES) ?>" data-nama="<?= htmlspecialchars($p['PrioritasPembangunan'], ENT_QUOTES) ?>" title="Edit Prioritas"><i class="fa fa-pencil"></i></button>
                                                                <button class="btn btn-xs btn-danger btn-action HapusPrioritasBtn" data-id="<?= $p['Id'] ?>" title="Hapus Prioritas"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                            <?php } ?>
                                                        </td>
                                                        <?php $is_first_p_row = false; } ?>

                                                        <td rowspan="1" class="cell-kp">
                                                            <?php if (!empty($k['Kode'])) { ?>
                                                                <div><span class="badge-kp-tag"><?= htmlspecialchars($k['Kode']) ?></span></div>
                                                            <?php } ?>
                                                            <div style="margin-top: 4px;"><?= nl2br(htmlspecialchars($k['KegiatanPrioritas'])) ?></div>
                                                            <?php if ($canEdit) { ?>
                                                            <div class="action-group">
                                                                <button class="btn btn-xs btn-warning btn-action TambahSasaranBtn" data-id="<?= $k['Id'] ?>" data-kp="<?= htmlspecialchars($kpLabel, ENT_QUOTES) ?>" style="color:#fff;" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                                <button class="btn btn-xs btn-info btn-action EditKegiatanBtn" data-id="<?= $k['Id'] ?>" data-pid="<?= $k['_Id'] ?>" data-kode="<?= htmlspecialchars($k['Kode'], ENT_QUOTES) ?>" data-nama="<?= htmlspecialchars($k['KegiatanPrioritas'], ENT_QUOTES) ?>" data-dana="<?= htmlspecialchars($k['SumberDana'], ENT_QUOTES) ?>" data-pelaksana="<?= htmlspecialchars($k['Pelaksana'], ENT_QUOTES) ?>" title="Edit KP"><i class="fa fa-pencil"></i></button>
                                                                <button class="btn btn-xs btn-danger btn-action HapusKegiatanBtn" data-id="<?= $k['Id'] ?>" title="Hapus KP"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="color: #999; font-style: italic; vertical-align: middle;">
                                                            Belum ada sasaran.
                                                            <?php if ($canEdit) { ?>
                                                            <button class="btn btn-xs btn-warning btn-action TambahSasaranBtn" data-id="<?= $k['Id'] ?>" data-kp="<?= htmlspecialchars($kpLabel, ENT_QUOTES) ?>" style="color:#fff;"><i class="fa fa-plus"></i> Tambah Sasaran</button>
                                                            <?php } ?>
                                                        </td>
                                                        <td rowspan="1" class="cell-dana">
                                                            <div><?= formatSumberDanaKPU($k['SumberDana']) ?></div>
                                                            <?php if ($canEdit) { ?>
                                                            <div>
                                                                <button class="btn-edit-col EditDanaBtn" data-id="<?= $k['Id'] ?>" data-kp="<?= htmlspecialchars($kpLabel, ENT_QUOTES) ?>" data-dana="<?= htmlspecialchars($k['SumberDana'], ENT_QUOTES) ?>" title="Kelola Sumber Dana">
                                                                    <i class="fa fa-pencil text-info"></i> Kelola Dana
                                                                </button>
                                                            </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td rowspan="1" class="cell-pelaksana">
                                                            <div><?= formatPelaksanaKPU($k['Pelaksana']) ?></div>
                                                            <?php if ($canEdit) { ?>
                                                            <div>
                                                                <button class="btn-edit-col EditPelaksanaBtn" data-id="<?= $k['Id'] ?>" data-kp="<?= htmlspecialchars($kpLabel, ENT_QUOTES) ?>" data-pelaksana="<?= htmlspecialchars($k['Pelaksana'], ENT_QUOTES) ?>" title="Kelola Pelaksana">
                                                                    <i class="fa fa-pencil text-info"></i> Kelola Pelaksana
                                                                </button>
                                                            </div>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                <?php
                                                } else {
                                                    // Loop setiap sasaran
                                                    foreach ($sasaranList as $s) {
                                ?>
                                                        <tr>
                                                            <?php if ($is_first_p_row) { ?>
                                                            <td rowspan="<?= $p_total_rows ?>" class="cell-pn">
                                                                <?php if (!empty($p['Kode'])) { ?>
                                                                    <span class="badge-pn-tag"><?= htmlspecialchars($p['Kode']) ?></span>
                                                                <?php } ?>
                                                                <div><?= nl2br(htmlspecialchars($p['PrioritasPembangunan'])) ?></div>
                                                                <?php if ($canEdit) { ?>
                                                                <div class="action-group">
                                                                    <button class="btn btn-xs btn-success btn-action TambahKegiatanBtn" data-id="<?= $p['Id'] ?>" data-pn="<?= htmlspecialchars($pnLabel, ENT_QUOTES) ?>" title="Tambah KP"><i class="fa fa-plus"></i> KP</button>
                                                                    <button class="btn btn-xs btn-info btn-action EditPrioritasBtn" data-id="<?= $p['Id'] ?>" data-kode="<?= htmlspecialchars($p['Kode'], ENT_QUOTES) ?>" data-nama="<?= htmlspecialchars($p['PrioritasPembangunan'], ENT_QUOTES) ?>" title="Edit Prioritas"><i class="fa fa-pencil"></i></button>
                                                                    <button class="btn btn-xs btn-danger btn-action HapusPrioritasBtn" data-id="<?= $p['Id'] ?>" title="Hapus Prioritas"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                                <?php } ?>
                                                            </td>
                                                            <?php $is_first_p_row = false; } ?>

                                                            <?php if ($is_first_k_row) { ?>
                                                            <td rowspan="<?= $k_total_rows ?>" class="cell-kp">
                                                                <?php if (!empty($k['Kode'])) { ?>
                                                                    <div><span class="badge-kp-tag"><?= htmlspecialchars($k['Kode']) ?></span></div>
                                                                <?php } ?>
                                                                <div style="margin-top: 4px;"><?= nl2br(htmlspecialchars($k['KegiatanPrioritas'])) ?></div>
                                                                <?php if ($canEdit) { ?>
                                                                <div class="action-group">
                                                                    <button class="btn btn-xs btn-warning btn-action TambahSasaranBtn" data-id="<?= $k['Id'] ?>" data-kp="<?= htmlspecialchars($kpLabel, ENT_QUOTES) ?>" style="color:#fff;" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                                    <button class="btn btn-xs btn-info btn-action EditKegiatanBtn" data-id="<?= $k['Id'] ?>" data-pid="<?= $k['_Id'] ?>" data-kode="<?= htmlspecialchars($k['Kode'], ENT_QUOTES) ?>" data-nama="<?= htmlspecialchars($k['KegiatanPrioritas'], ENT_QUOTES) ?>" data-dana="<?= htmlspecialchars($k['SumberDana'], ENT_QUOTES) ?>" data-pelaksana="<?= htmlspecialchars($k['Pelaksana'], ENT_QUOTES) ?>" title="Edit KP"><i class="fa fa-pencil"></i></button>
                                                                    <button class="btn btn-xs btn-danger btn-action HapusKegiatanBtn" data-id="<?= $k['Id'] ?>" title="Hapus KP"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                                <?php } ?>
                                                            </td>
                                                            <?php } ?>

                                                            <!-- Kolom Sasaran (dengan tombol Edit & Hapus Sasaran) -->
                                                            <td class="cell-sasaran">
                                                                <div><?= nl2br(htmlspecialchars($s['Sasaran'])) ?></div>
                                                                <?php if ($canEdit) { ?>
                                                                <div class="action-group" style="margin-top: 6px; padding-top: 4px;">
                                                                    <button class="btn btn-xs btn-info btn-action EditSasaranBtn" data-id="<?= $s['Id'] ?>" data-kid="<?= $s['_Id'] ?>" data-sasaran="<?= htmlspecialchars($s['Sasaran'], ENT_QUOTES) ?>" title="Edit Sasaran"><i class="fa fa-pencil"></i> Edit</button>
                                                                    <button class="btn btn-xs btn-danger btn-action HapusSasaranBtn" data-id="<?= $s['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i> Hapus</button>
                                                                </div>
                                                                <?php } ?>
                                                            </td>

                                                            <?php if ($is_first_k_row) { ?>
                                                            <td rowspan="<?= $k_total_rows ?>" class="cell-dana">
                                                                <div><?= formatSumberDanaKPU($k['SumberDana']) ?></div>
                                                                <?php if ($canEdit) { ?>
                                                                <div>
                                                                    <button class="btn-edit-col EditDanaBtn" data-id="<?= $k['Id'] ?>" data-kp="<?= htmlspecialchars($kpLabel, ENT_QUOTES) ?>" data-dana="<?= htmlspecialchars($k['SumberDana'], ENT_QUOTES) ?>" title="Kelola Sumber Dana">
                                                                        <i class="fa fa-pencil text-info"></i> Kelola Dana
                                                                    </button>
                                                                </div>
                                                                <?php } ?>
                                                            </td>
                                                            <td rowspan="<?= $k_total_rows ?>" class="cell-pelaksana">
                                                                <div><?= formatPelaksanaKPU($k['Pelaksana']) ?></div>
                                                                <?php if ($canEdit) { ?>
                                                                <div>
                                                                    <button class="btn-edit-col EditPelaksanaBtn" data-id="<?= $k['Id'] ?>" data-kp="<?= htmlspecialchars($kpLabel, ENT_QUOTES) ?>" data-pelaksana="<?= htmlspecialchars($k['Pelaksana'], ENT_QUOTES) ?>" title="Kelola Pelaksana">
                                                                        <i class="fa fa-pencil text-info"></i> Kelola Pelaksana
                                                                    </button>
                                                                </div>
                                                                <?php } ?>
                                                            </td>
                                                            <?php $is_first_k_row = false; } ?>
                                                        </tr>
                                <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center" style="padding: 35px; color: #999;">
                                            Belum ada data Kegiatan Prioritas Utama RPJMN.
                                            <?php if ($canEdit) { ?>
                                            <br><br>
                                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputPrioritas">
                                                <i class="fa fa-plus-circle"></i> Input Prioritas Pembangunan Sekarang
                                            </button>
                                            <?php } ?>
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

<?php if ($canEdit) { ?>
<!-- ==================== MODALS UNTUK CRUD (Gaya Notika Standar) ==================== -->

<!-- Modal Input Prioritas -->
<div class="modal fade" id="ModalInputPrioritas" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormInputPrioritas">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Prioritas Pembangunan (PN)</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <div class="form-group">
                        <label><b>Kode Prioritas</b> (Contoh: PN 1, PN 2)</label>
                        <input type="text" class="form-control" name="Kode" placeholder="Contoh: PN 1" required>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label><b>Deskripsi Prioritas Pembangunan</b></label>
                        <textarea class="form-control" name="PrioritasPembangunan" rows="4" placeholder="Uraian Prioritas Pembangunan..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnSimpanPrioritas"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Prioritas -->
<div class="modal fade" id="ModalEditPrioritas" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormEditPrioritas">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Prioritas Pembangunan (PN)</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" name="Id" id="EditPrioritasId">
                    <div class="form-group">
                        <label><b>Kode Prioritas</b></label>
                        <input type="text" class="form-control" name="Kode" id="EditPrioritasKode" required>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label><b>Deskripsi Prioritas Pembangunan</b></label>
                        <textarea class="form-control" name="PrioritasPembangunan" id="EditPrioritasNama" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnUpdatePrioritas"><i class="fa fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Input Kegiatan -->
<div class="modal fade" id="ModalInputKegiatan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormInputKegiatan">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Kegiatan Prioritas (KP)</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <!-- Hidden Induk: Otomatis dari baris PN -->
                    <input type="hidden" name="_Id" id="InputKegiatan_Id" required>
                    
                    <div class="info-induk-box" style="border-left: 4px solid #00c292;">
                        <span class="info-induk-label" style="color: #008764;"><i class="fa fa-level-down"></i> Ditambahkan di Bawah Prioritas Pembangunan:</span>
                        <div class="info-induk-text" id="LabelPrioritasInduk" style="color: #2c3e50;">-</div>
                    </div>

                    <div class="form-group">
                        <label><b>Kode Kegiatan</b> (Contoh: 01.02.01)</label>
                        <input type="text" class="form-control" name="Kode" id="InputKegiatanKode" placeholder="Contoh: 01.02.01">
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label><b>Nama Kegiatan Prioritas</b> <span style="color:red;">*</span></label>
                        <textarea class="form-control" name="KegiatanPrioritas" id="InputKegiatanNama" rows="3" placeholder="Contoh: KP: Penguatan Pers Dan Media Massa..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnSimpanKegiatan"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kegiatan -->
<div class="modal fade" id="ModalEditKegiatan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormEditKegiatan">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Kegiatan Prioritas (KP)</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" name="Id" id="EditKegiatanId">
                    <input type="hidden" name="_Id" id="EditKegiatan_Id">

                    <div class="form-group">
                        <label><b>Kode Kegiatan</b></label>
                        <input type="text" class="form-control" name="Kode" id="EditKegiatanKode">
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label><b>Nama Kegiatan Prioritas</b> <span style="color:red;">*</span></label>
                        <textarea class="form-control" name="KegiatanPrioritas" id="EditKegiatanNama" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnUpdateKegiatan"><i class="fa fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Input Sasaran -->
<div class="modal fade" id="ModalInputSasaran" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormInputSasaran">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Sasaran</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" name="_Id" id="InputSasaran_Id" required>

                    <div class="info-induk-box" style="border-left: 4px solid #03a9f4;">
                        <span class="info-induk-label" style="color: #0284c7;"><i class="fa fa-level-down"></i> Ditambahkan di Bawah Kegiatan Prioritas:</span>
                        <div class="info-induk-text" id="LabelKegiatanInduk" style="color: #0c4a6e;">-</div>
                    </div>

                    <div class="form-group">
                        <label><b>Uraian Sasaran</b> <span style="color:red;">*</span></label>
                        <textarea class="form-control" name="Sasaran" id="InputSasaranText" rows="4" placeholder="Tuliskan uraian sasaran..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnSimpanSasaran"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Sasaran -->
<div class="modal fade" id="ModalEditSasaran" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormEditSasaran">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Sasaran</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" name="Id" id="EditSasaranId">
                    <input type="hidden" name="_Id" id="EditSasaran_Id">

                    <div class="form-group">
                        <label><b>Uraian Sasaran</b> <span style="color:red;">*</span></label>
                        <textarea class="form-control" name="Sasaran" id="EditSasaranText" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnUpdateSasaran"><i class="fa fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- MODAL CRUD MANDIRI: SUMBER DANA                                -->
<!-- ============================================================== -->
<div class="modal fade" id="ModalEditSumberDana" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormEditSumberDana">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2><i class="fa fa-money text-success"></i> Kelola Sumber Dana</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" name="Id" id="DanaKegiatanId" required>

                    <div class="info-induk-box" style="border-left: 4px solid #03a9f4;">
                        <span class="info-induk-label" style="color: #0284c7;">Kegiatan Prioritas:</span>
                        <div class="info-induk-text" id="DanaLabelKP" style="color: #0c4a6e;">-</div>
                    </div>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label style="margin: 0;"><b>Daftar Sumber Dana</b></label>
                            <small style="color: #64748b;">Klik opsi untuk menambahkan langsung:</small>
                        </div>
                        <div class="quick-preset-container">
                            <button type="button" class="btn-quick-preset append-dana-btn" data-target="#DanaText" data-val="Belanja K/L">+ Belanja K/L</button>
                            <button type="button" class="btn-quick-preset append-dana-btn" data-target="#DanaText" data-val="APBD">+ APBD</button>
                            <button type="button" class="btn-quick-preset append-dana-btn" data-target="#DanaText" data-val="Badan Usaha (BUMN/Swasta)">+ Badan Usaha (BUMN/Swasta)</button>
                            <button type="button" class="btn-quick-preset append-dana-btn" data-target="#DanaText" data-val="DAK">+ DAK</button>
                            <button type="button" class="btn-quick-preset append-dana-btn" data-target="#DanaText" data-val="PHLN">+ PHLN</button>
                            <button type="button" class="btn-quick-preset append-dana-btn" data-target="#DanaText" data-val="SBSN">+ SBSN</button>
                        </div>
                        <textarea class="form-control" name="SumberDana" id="DanaText" rows="4" placeholder="Contoh:&#10;· Belanja K/L&#10;· APBD&#10;· Badan Usaha (BUMN/Swasta)"></textarea>
                        <small style="color: #94a3b8; display: block; margin-top: 4px;">* Anda dapat mengedit, menambah, atau menghapus baris. Tanda titik bullet (&middot;) akan otomatis dirapikan pada tampilan tabel.</small>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnUpdateDana"><i class="fa fa-save"></i> Simpan Sumber Dana</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- MODAL CRUD MANDIRI: PELAKSANA                                  -->
<!-- ============================================================== -->
<div class="modal fade" id="ModalEditPelaksana" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <form id="FormEditPelaksana">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2><i class="fa fa-users text-primary"></i> Kelola Pelaksana</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" name="Id" id="PelaksanaKegiatanId" required>

                    <div class="info-induk-box" style="border-left: 4px solid #03a9f4;">
                        <span class="info-induk-label" style="color: #0284c7;">Kegiatan Prioritas:</span>
                        <div class="info-induk-text" id="PelaksanaLabelKP" style="color: #0c4a6e;">-</div>
                    </div>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label style="margin: 0;"><b>Daftar Pelaksana</b></label>
                            <small style="color: #64748b;">Pilihan instan:</small>
                        </div>
                        <div class="quick-preset-container">
                            <button type="button" class="btn-quick-preset append-pelaksana-btn" data-target="#PelaksanaText" data-val="Pemerintah Daerah">+ Pemerintah Daerah</button>
                            <button type="button" class="btn-quick-preset append-pelaksana-btn" data-target="#PelaksanaText" data-val="Badan Usaha (BUMN/Swasta)">+ Badan Usaha (BUMN/Swasta)</button>
                        </div>
                        <?php if (!empty($Kementerian)) { ?>
                        <div style="margin-bottom: 8px;">
                            <select class="form-control quick-kementerian-select" data-target="#PelaksanaText" style="font-size: 12px; height: 32px; padding: 4px 8px;">
                                <option value="">-- + Tambah Kementerian / Lembaga Pelaksana --</option>
                                <?php foreach ($Kementerian as $kem) { ?>
                                    <option value="<?= htmlspecialchars($kem['NamaKementerian'], ENT_QUOTES) ?>">+ <?= htmlspecialchars($kem['NamaKementerian']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                        <textarea class="form-control" name="Pelaksana" id="PelaksanaText" rows="5" placeholder="Antara Lain:&#10;· Kementerian Pertanian&#10;· Kementerian Pekerjaan Umum&#10;· Pemerintah Daerah"></textarea>
                        <small style="color: #94a3b8; display: block; margin-top: 4px;">* Anda dapat mengedit, menambah, atau menghapus instansi pelaksana. Format otomatis diawali <b>Antara Lain:</b> dan bertanda bullet (&middot;).</small>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn btn-success notika-btn-success btn-action" id="BtnUpdatePelaksana"><i class="fa fa-save"></i> Simpan Pelaksana</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- Vendor Scripts yang Wajib untuk Bootstrap Modal & Notika UI -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/wow.min.js') ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js') ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js') ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js') ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<script src="<?= base_url('js/main.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($canEdit) { ?>
<script>
$(document).ready(function() {
    var baseUrl = "<?= base_url('Nasional/') ?>";

    // Helper notifikasi
    function showSuccess(msg) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: msg,
                timer: 1500,
                showConfirmButton: false
            }).then(function() {
                location.reload();
            });
        } else {
            alert(msg);
            location.reload();
        }
    }

    function showError(msg) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: msg
            });
        } else {
            alert(msg);
        }
    }

    // ==========================================
    // HELPER AUTO-BULLET & QUICK PRESET
    // ==========================================
    $(document).on('click', '.append-dana-btn', function() {
        var targetSelector = $(this).data('target');
        var val = $(this).data('val');
        var $target = $(targetSelector);
        var current = $.trim($target.val());
        var lineToAdd = '· ' + val;

        if (current.indexOf(val) !== -1) {
            return;
        }

        if (current === '') {
            $target.val(lineToAdd);
        } else {
            $target.val(current + '\n' + lineToAdd);
        }
    });

    $(document).on('click', '.append-pelaksana-btn', function() {
        var targetSelector = $(this).data('target');
        var val = $(this).data('val');
        var $target = $(targetSelector);
        var current = $.trim($target.val());

        if (current.indexOf(val) !== -1) {
            return;
        }

        if (current === '') {
            $target.val('Antara Lain:\n· ' + val);
        } else {
            if (current.indexOf('Antara Lain:') === -1) {
                current = 'Antara Lain:\n' + current;
            }
            $target.val(current + '\n· ' + val);
        }
    });

    $(document).on('change', '.quick-kementerian-select', function() {
        var val = $(this).val();
        if (!val) return;
        var targetSelector = $(this).data('target');
        var $target = $(targetSelector);
        var current = $.trim($target.val());

        if (current.indexOf(val) !== -1) {
            $(this).val('');
            return;
        }

        if (current === '') {
            $target.val('Antara Lain:\n· ' + val);
        } else {
            if (current.indexOf('Antara Lain:') === -1) {
                current = 'Antara Lain:\n' + current;
            }
            $target.val(current + '\n· ' + val);
        }
        $(this).val('');
    });

    // ==========================================
    // 1. PRIORITAS PEMBANGUNAN (PN)
    // ==========================================
    $('#FormInputPrioritas').on('submit', function(e) {
        e.preventDefault();
        $('#BtnSimpanPrioritas').prop('disabled', true).text('Menyimpan...');
        $.ajax({
            url: baseUrl + 'InputPrioritasKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Prioritas Pembangunan berhasil disimpan!');
                } else {
                    showError(res);
                    $('#BtnSimpanPrioritas').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnSimpanPrioritas').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });

    $(document).on('click', '.EditPrioritasBtn', function() {
        $('#EditPrioritasId').val($(this).data('id'));
        $('#EditPrioritasKode').val($(this).data('kode'));
        $('#EditPrioritasNama').val($(this).data('nama'));
        $('#ModalEditPrioritas').modal('show');
    });

    $('#FormEditPrioritas').on('submit', function(e) {
        e.preventDefault();
        $('#BtnUpdatePrioritas').prop('disabled', true).text('Mengupdate...');
        $.ajax({
            url: baseUrl + 'EditPrioritasKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Prioritas Pembangunan berhasil diperbarui!');
                } else {
                    showError(res);
                    $('#BtnUpdatePrioritas').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnUpdatePrioritas').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
            }
        });
    });

    $(document).on('click', '.HapusPrioritasBtn', function() {
        var id = $(this).data('id');
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Prioritas Pembangunan?',
                text: 'Data Prioritas Pembangunan ini akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    doHapusPrioritas(id);
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin menghapus Prioritas Pembangunan ini?')) {
                doHapusPrioritas(id);
            }
        }
    });

    function doHapusPrioritas(id) {
        $.ajax({
            url: baseUrl + 'HapusPrioritasKPU',
            type: 'POST',
            data: { Id: id },
            success: function(res) {
                if (res == '1') {
                    showSuccess('Prioritas Pembangunan berhasil dihapus!');
                } else {
                    showError(res);
                }
            },
            error: function() {
                showError('Gagal menghapus data.');
            }
        });
    }

    // ==========================================
    // 2. KEGIATAN PRIORITAS (KP)
    // ==========================================
    $(document).on('click', '.TambahKegiatanBtn', function() {
        var pid = $(this).data('id');
        var pnNama = $(this).data('pn') || 'Prioritas Pembangunan';
        $('#InputKegiatan_Id').val(pid);
        $('#LabelPrioritasInduk').text(pnNama);
        $('#InputKegiatanKode').val('');
        $('#InputKegiatanNama').val('');
        $('#ModalInputKegiatan').modal('show');
    });

    $('#FormInputKegiatan').on('submit', function(e) {
        e.preventDefault();
        $('#BtnSimpanKegiatan').prop('disabled', true).text('Menyimpan...');
        $.ajax({
            url: baseUrl + 'InputKegiatanKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Kegiatan Prioritas berhasil disimpan!');
                } else {
                    showError(res);
                    $('#BtnSimpanKegiatan').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnSimpanKegiatan').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });

    $(document).on('click', '.EditKegiatanBtn', function() {
        $('#EditKegiatanId').val($(this).data('id'));
        $('#EditKegiatan_Id').val($(this).data('pid'));
        $('#EditKegiatanKode').val($(this).data('kode'));
        $('#EditKegiatanNama').val($(this).data('nama'));
        $('#ModalEditKegiatan').modal('show');
    });

    $('#FormEditKegiatan').on('submit', function(e) {
        e.preventDefault();
        $('#BtnUpdateKegiatan').prop('disabled', true).text('Mengupdate...');
        $.ajax({
            url: baseUrl + 'EditKegiatanKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Kegiatan Prioritas berhasil diperbarui!');
                } else {
                    showError(res);
                    $('#BtnUpdateKegiatan').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnUpdateKegiatan').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
            }
        });
    });

    $(document).on('click', '.HapusKegiatanBtn', function() {
        var id = $(this).data('id');
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Kegiatan Prioritas?',
                text: 'Data Kegiatan Prioritas ini beserta pengaturannya akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    doHapusKegiatan(id);
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin menghapus Kegiatan Prioritas ini?')) {
                doHapusKegiatan(id);
            }
        }
    });

    function doHapusKegiatan(id) {
        $.ajax({
            url: baseUrl + 'HapusKegiatanKPU',
            type: 'POST',
            data: { Id: id },
            success: function(res) {
                if (res == '1') {
                    showSuccess('Kegiatan Prioritas berhasil dihapus!');
                } else {
                    showError(res);
                }
            },
            error: function() {
                showError('Gagal menghapus data.');
            }
        });
    }

    // ==========================================
    // 3. CRUD MANDIRI: SUMBER DANA
    // ==========================================
    $(document).on('click', '.EditDanaBtn', function() {
        var id = $(this).data('id');
        var kp = $(this).data('kp') || 'Kegiatan Prioritas';
        var dana = $(this).data('dana') || '';

        $('#DanaKegiatanId').val(id);
        $('#DanaLabelKP').text(kp);
        $('#DanaText').val(dana);
        $('#ModalEditSumberDana').modal('show');
    });

    $('#FormEditSumberDana').on('submit', function(e) {
        e.preventDefault();
        $('#BtnUpdateDana').prop('disabled', true).text('Menyimpan...');
        $.ajax({
            url: baseUrl + 'UpdateSumberDanaKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Sumber Dana berhasil diperbarui!');
                } else {
                    showError(res);
                    $('#BtnUpdateDana').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Sumber Dana');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnUpdateDana').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Sumber Dana');
            }
        });
    });

    // ==========================================
    // 4. CRUD MANDIRI: PELAKSANA
    // ==========================================
    $(document).on('click', '.EditPelaksanaBtn', function() {
        var id = $(this).data('id');
        var kp = $(this).data('kp') || 'Kegiatan Prioritas';
        var pelaksana = $(this).data('pelaksana') || '';

        $('#PelaksanaKegiatanId').val(id);
        $('#PelaksanaLabelKP').text(kp);
        $('#PelaksanaText').val(pelaksana);
        $('#ModalEditPelaksana').modal('show');
    });

    $('#FormEditPelaksana').on('submit', function(e) {
        e.preventDefault();
        $('#BtnUpdatePelaksana').prop('disabled', true).text('Menyimpan...');
        $.ajax({
            url: baseUrl + 'UpdatePelaksanaKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Pelaksana berhasil diperbarui!');
                } else {
                    showError(res);
                    $('#BtnUpdatePelaksana').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Pelaksana');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnUpdatePelaksana').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Pelaksana');
            }
        });
    });

    // ==========================================
    // 5. SASARAN
    // ==========================================
    $(document).on('click', '.TambahSasaranBtn', function() {
        var kid = $(this).data('id');
        var kpNama = $(this).data('kp') || 'Kegiatan Prioritas';
        $('#InputSasaran_Id').val(kid);
        $('#LabelKegiatanInduk').text(kpNama);
        $('#InputSasaranText').val('');
        $('#ModalInputSasaran').modal('show');
    });

    $('#FormInputSasaran').on('submit', function(e) {
        e.preventDefault();
        $('#BtnSimpanSasaran').prop('disabled', true).text('Menyimpan...');
        $.ajax({
            url: baseUrl + 'InputSasaranKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Sasaran berhasil disimpan!');
                } else {
                    showError(res);
                    $('#BtnSimpanSasaran').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnSimpanSasaran').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            }
        });
    });

    $(document).on('click', '.EditSasaranBtn', function() {
        $('#EditSasaranId').val($(this).data('id'));
        $('#EditSasaran_Id').val($(this).data('kid'));
        $('#EditSasaranText').val($(this).data('sasaran'));
        $('#ModalEditSasaran').modal('show');
    });

    $('#FormEditSasaran').on('submit', function(e) {
        e.preventDefault();
        $('#BtnUpdateSasaran').prop('disabled', true).text('Mengupdate...');
        $.ajax({
            url: baseUrl + 'EditSasaranKPU',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if (res == '1') {
                    showSuccess('Sasaran berhasil diperbarui!');
                } else {
                    showError(res);
                    $('#BtnUpdateSasaran').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                }
            },
            error: function() {
                showError('Terjadi kesalahan koneksi server.');
                $('#BtnUpdateSasaran').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
            }
        });
    });

    $(document).on('click', '.HapusSasaranBtn', function() {
        var id = $(this).data('id');
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Sasaran?',
                text: 'Sasaran ini akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    doHapusSasaran(id);
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin menghapus Sasaran ini?')) {
                doHapusSasaran(id);
            }
        }
    });

    function doHapusSasaran(id) {
        $.ajax({
            url: baseUrl + 'HapusSasaranKPU',
            type: 'POST',
            data: { Id: id },
            success: function(res) {
                if (res == '1') {
                    showSuccess('Sasaran berhasil dihapus!');
                } else {
                    showError(res);
                }
            },
            error: function() {
                showError('Gagal menghapus sasaran.');
            }
        });
    }
});
</script>
<?php } ?>
