<?php $this->load->view('Kementerian/Sidebar'); ?>

<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <ul class="breadcomb-menu" style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: inline-block; margin-right: 5px;">
                            <a href="<?= base_url('Beranda') ?>">Beranda</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block; margin-right: 5px;">
                            <a href="<?= base_url('Kementerian/Renstra') ?>">Renstra</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block;">
                            <span class="bread-blk">Hubungan Keterkaitan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Toast Notification */
    .toast-error {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        z-index: 99999;
        display: none;
        font-weight: 500;
        max-width: 450px;
        animation: slideIn 0.4s ease;
        font-size: 14px;
    }

    .toast-error.success {
        background: #4caf50;
        color: white;
    }

    .toast-error.error {
        background: #f44336;
        color: white;
    }

    .toast-error .close-btn {
        float: right;
        margin-left: 15px;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        opacity: 0.8;
    }
    .toast-error .close-btn:hover {
        opacity: 1;
    }

    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

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
        width: 700px; 
        max-width: 95%; 
    }
    .modal-lg {
        width: 95% !important;
        max-width: 1200px !important;
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    #renstra-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    #renstra-table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
        padding: 10px 8px;
    }
    
    #renstra-table > tbody > tr > td:nth-child(2) {
        padding-left: 15px !important;
        padding-right: 15px !important;
        text-align: left !important;
    }
    
    #renstra-table > tbody > tr {
        transition: background-color 0.3s ease;
    }
    #renstra-table > tbody > tr:hover {
        background-color: rgba(0,0,0,0.02);
    }

    /* ============ DROPDOWN TITIK TIGA ============ */
    .dropdown-aksi {
        position: relative;
        display: inline-block;
    }
    
    .dropdown-aksi .btn-titik-tiga {
        background: transparent;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        cursor: pointer;
        color: #718096;
        transition: all 0.2s ease;
        font-size: 18px;
        line-height: 1;
        font-weight: 400;
    }
    .dropdown-aksi .btn-titik-tiga:hover {
        background: #edf2f7;
        color: #2d3748;
    }
    .dropdown-aksi .btn-titik-tiga:focus {
        outline: none;
    }
    
    .dropdown-aksi .menu-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        min-width: 170px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        border: 1px solid #edf2f7;
        padding: 6px 0;
        display: none;
        z-index: 1000;
        margin-top: 4px;
        text-align: left;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    .dropdown-aksi .menu-dropdown.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
    
    .dropdown-aksi .item-dropdown {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        color: #2d3748;
        text-decoration: none;
        font-size: 13px;
        transition: all 0.2s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-weight: 500;
    }
    .dropdown-aksi .item-dropdown:hover {
        background: #f7fafc;
        color: #1a2332;
    }
    .dropdown-aksi .item-dropdown i {
        width: 18px;
        font-size: 14px;
        color: #718096;
    }
    .dropdown-aksi .item-dropdown.text-danger {
        color: #dc3545;
    }
    .dropdown-aksi .item-dropdown.text-danger i {
        color: #dc3545;
    }
    .dropdown-aksi .item-dropdown.text-danger:hover {
        background: #fef2f2;
    }
    .dropdown-aksi .divider-dropdown {
        height: 1px;
        background: #edf2f7;
        margin: 4px 0;
    }
    /* =========================================== */

    .badge-periode {
        background-color: #00c292;
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 194, 146, 0.3);
    }

    .badge-periode.level2 {
        background-color: #00bcd4;
        box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);
    }
    .badge-periode.level3 {
        background-color: #ff9800;
        box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);
    }
    .badge-periode.level4 {
        background-color: #9e9e9e;
        box-shadow: 0 2px 5px rgba(158, 158, 158, 0.3);
    }

    .periode-info {
        background: #e8f5e9;
        padding: 8px 15px;
        border-radius: 5px;
        margin-bottom: 10px;
        color: #2e7d32;
        font-weight: 600;
        border-left: 3px solid #4caf50;
    }

    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.2em;
        display: inline-block;
        vertical-align: text-bottom;
        border: 0.2em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
    }
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }

    .td-content-wrapper {
        display: block !important;
        padding: 6px 0;
    }
    
    .td-content-wrapper .text-content {
        display: block;
        word-wrap: break-word;
        word-break: break-word;
        line-height: 1.6;
        text-align: left !important;
    }
    
    .td-content-wrapper .text-content .label-text {
        display: inline;
    }
    
    .td-content-wrapper .text-content .label-text b {
        white-space: nowrap;
    }

    .row-pn { background-color: #f1f8e9 !important; }
    .row-pp { background-color: #e0f7fa !important; }
    .row-kp { background-color: #fff3e0 !important; }
    .row-prop { background-color: #ffffff !important; }
    
    .border-pn { border-left: 4px solid #8bc34a !important; }
    .border-pp { border-left: 4px solid #00bcd4 !important; }
    .border-kp { border-left: 4px solid #ff9800 !important; }
    .border-prop { border-left: 4px solid #9e9e9e !important; }

    .clickable-row {
        cursor: pointer;
    }

    /* child row indentation */
    .child-row-pn td:first-child {
        padding-left: 30px !important;
    }
    .child-row-pp td:first-child {
        padding-left: 60px !important;
    }
    .child-row-kp td:first-child {
        padding-left: 90px !important;
    }

    /* Animasi smooth untuk expand/collapse */
    .row-expand {
        animation: fadeSlideDown 0.3s ease forwards;
    }
    .row-collapse {
        animation: fadeSlideUp 0.3s ease forwards;
    }

    @keyframes fadeSlideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeSlideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    /* Loading overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
    }
    .loading-overlay .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .dropdown-aksi .menu-dropdown {
            right: -10px;
            min-width: 150px;
        }
        #renstra-table > tbody > tr > td {
            padding: 8px 6px;
            font-size: 12px;
        }
        .badge-periode {
            font-size: 10px;
            padding: 3px 8px;
        }
    }
</style>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<!-- Toast Error -->
<div class="toast-error error" id="toastError">
    <span class="close-btn" onclick="document.getElementById('toastError').style.display='none'">&times;</span>
    <span id="toastMessage">Error</span>
</div>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Tombol Tambah PN -->
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                    <div class="alert alert-info" style="margin-bottom:15px;">
                        <i class="notika-icon notika-info"></i>
                        <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName ?? '-') ?><br>
                        <b>Periode :</b> <?= htmlspecialchars($UserPeriode ?? '-') ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- HEADER TABEL -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#modalAddPN" style="padding: 8px 15px; border-radius: 6px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Tambah Prioritas Nasional</b>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- TABEL HIERARKI -->
                    <div class="table-responsive">
                        <table id="renstra-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 42%;">Uraian (PN / PP / KP / Pro-P)</th>
                                    <th style="width: 12%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                                    <th style="width: 8%;" class="text-center">Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php if (!empty($PN)): ?>
                                    <?php $noPN = 1; foreach ($PN as $pn): ?>
                                        <!-- LEVEL 1: PRIORITAS NASIONAL (PN) -->
                                        <tr data-id="pn-<?= $pn['id'] ?>" data-parent="" data-expanded="false" class="row-pn level-row">
                                            <td class="text-center" style="font-size: 14px;"><b><?= $noPN ?></b></td>
                                            <td style="cursor: pointer; padding-left: 15px !important;" class="border-pn clickable-row" onclick="toggleLevel('pn-<?= $pn['id'] ?>', this)">
                                                <div class="td-content-wrapper">
                                                    <div class="text-content">
                                                        <span class="label-text"><b>PN:</b> </span>
                                                        <?= htmlspecialchars($pn['kode_pn']) ?> - <?= htmlspecialchars($pn['nama_pn']) ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-periode"><?= $pn['tahun_mulai'] . ' - ' . $pn['tahun_akhir'] ?></span>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                                            <td class="text-center">
                                                <div class="dropdown-aksi">
                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="menu-dropdown">
                                                        <button class="item-dropdown TambahPP" data-id="<?= $pn['id'] ?>">
                                                            <i class="fa fa-plus-circle"></i> Tambah PP
                                                        </button>
                                                        <div class="divider-dropdown"></div>
                                                        <button class="item-dropdown EditPN" data-id="<?= $pn['id'] ?>" data-kode="<?= htmlspecialchars($pn['kode_pn']) ?>" data-nama="<?= htmlspecialchars($pn['nama_pn']) ?>" data-mulai="<?= $pn['tahun_mulai'] ?>" data-akhir="<?= $pn['tahun_akhir'] ?>" data-ket="<?= htmlspecialchars($pn['keterangan'] ?? '') ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </button>
                                                        <button class="item-dropdown text-danger HapusPN" data-id="<?= $pn['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php endif; ?>
                                        </tr>

                                        <?php if (!empty($pn['PP'])): ?>
                                            <?php $noPP = 1; foreach ($pn['PP'] as $pp): ?>
                                                <!-- LEVEL 2: PROGRAM PRIORITAS (PP) -->
                                                <tr data-id="pp-<?= $pp['id'] ?>" data-parent="pn-<?= $pn['id'] ?>" data-expanded="false" style="display: none;" class="row-pp child-row-pn level-row">
                                                    <td></td>
                                                    <td style="cursor: pointer; padding-left: 15px !important;" class="border-pp clickable-row" onclick="toggleLevel('pp-<?= $pp['id'] ?>', this)">
                                                        <div class="td-content-wrapper">
                                                            <div class="text-content">
                                                                <span class="label-text"><b style="color: #00838f;">PP <?= $noPN . '.' . $noPP ?>:</b> </span>
                                                                <?= htmlspecialchars($pp['kode_pp']) ?> - <?= htmlspecialchars($pp['nama_pp']) ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge-periode level2"><?= $pn['tahun_mulai'] . ' - ' . $pn['tahun_akhir'] ?></span>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                                                    <td class="text-center">
                                                        <div class="dropdown-aksi">
                                                            <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="menu-dropdown">
                                                                <button class="item-dropdown TambahKP" data-id="<?= $pp['id'] ?>">
                                                                    <i class="fa fa-plus-circle"></i> Tambah KP
                                                                </button>
                                                                <div class="divider-dropdown"></div>
                                                                <button class="item-dropdown EditPP" data-id="<?= $pp['id'] ?>" data-kode="<?= htmlspecialchars($pp['kode_pp']) ?>" data-nama="<?= htmlspecialchars($pp['nama_pp']) ?>" data-ket="<?= htmlspecialchars($pp['keterangan'] ?? '') ?>">
                                                                    <i class="fa fa-pencil"></i> Edit
                                                                </button>
                                                                <button class="item-dropdown text-danger HapusPP" data-id="<?= $pp['id'] ?>">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <?php endif; ?>
                                                </tr>

                                                <?php if (!empty($pp['KP'])): ?>
                                                    <?php $noKP = 1; foreach ($pp['KP'] as $kp): ?>
                                                        <!-- LEVEL 3: KEGIATAN PRIORITAS (KP) -->
                                                        <tr data-id="kp-<?= $kp['id'] ?>" data-parent="pp-<?= $pp['id'] ?>" data-expanded="false" style="display: none;" class="row-kp child-row-pp level-row">
                                                            <td></td>
                                                            <td style="cursor: pointer; padding-left: 15px !important;" class="border-kp clickable-row" onclick="toggleLevel('kp-<?= $kp['id'] ?>', this)">
                                                                <div class="td-content-wrapper">
                                                                    <div class="text-content">
                                                                        <span class="label-text"><b style="color: #ef6c00;">KP <?= $noPN . '.' . $noPP . '.' . $noKP ?>:</b> </span>
                                                                        <?= htmlspecialchars($kp['kode_kp']) ?> - <?= htmlspecialchars($kp['nama_kp']) ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge-periode level3"><?= $pn['tahun_mulai'] . ' - ' . $pn['tahun_akhir'] ?></span>
                                                            </td>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                                                            <td class="text-center">
                                                                <div class="dropdown-aksi">
                                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                    </button>
                                                                    <div class="menu-dropdown">
                                                                        <button class="item-dropdown TambahProP" data-id="<?= $kp['id'] ?>">
                                                                            <i class="fa fa-plus-circle"></i> Tambah Pro-P
                                                                        </button>
                                                                        <div class="divider-dropdown"></div>
                                                                        <button class="item-dropdown EditKP" data-id="<?= $kp['id'] ?>" data-kode="<?= htmlspecialchars($kp['kode_kp']) ?>" data-nama="<?= htmlspecialchars($kp['nama_kp']) ?>" data-ket="<?= htmlspecialchars($kp['keterangan'] ?? '') ?>">
                                                                            <i class="fa fa-pencil"></i> Edit
                                                                        </button>
                                                                        <button class="item-dropdown text-danger HapusKP" data-id="<?= $kp['id'] ?>">
                                                                            <i class="fa fa-trash"></i> Hapus
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <?php endif; ?>
                                                        </tr>

                                                        <?php if (!empty($kp['ProP'])): ?>
                                                            <?php $noProP = 1; foreach ($kp['ProP'] as $prop): ?>
                                                                <!-- LEVEL 4: PROYEK PRIORITAS (Pro-P) -->
                                                                <tr data-id="prop-<?= $prop['id'] ?>" data-parent="kp-<?= $kp['id'] ?>" data-expanded="false" style="display: none;" class="row-prop child-row-kp level-row">
                                                                    <td></td>
                                                                    <td style="padding-left: 15px !important;" class="border-prop">
                                                                        <div class="td-content-wrapper">
                                                                            <div class="text-content">
                                                                                <span class="label-text"><b style="color: #616161;">Pro-P <?= $noPN . '.' . $noPP . '.' . $noKP . '.' . $noProP ?>:</b> </span>
                                                                                <?= htmlspecialchars($prop['kode_prop']) ?> - <?= htmlspecialchars($prop['nama_prop']) ?>
                                                                                <?php if (!empty($prop['target']) || !empty($prop['indikator'])): ?>
                                                                                    <div class="item-meta small text-muted mt-2">
                                                                                        <?php if (!empty($prop['target'])): ?>
                                                                                            <div><strong>Target:</strong> <?= nl2br(htmlspecialchars($prop['target'])) ?></div>
                                                                                        <?php endif; ?>
                                                                                        <?php if (!empty($prop['indikator'])): ?>
                                                                                            <div><strong>Indikator:</strong> <?= nl2br(htmlspecialchars($prop['indikator'])) ?></div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="badge-periode level4"><?= $pn['tahun_mulai'] . ' - ' . $pn['tahun_akhir'] ?></span>
                                                                    </td>
                                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                                                                    <td class="text-center">
                                                                        <div class="dropdown-aksi">
                                                                            <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                            </button>
                                                                            <div class="menu-dropdown">
                                                                                <button class="item-dropdown EditProP" data-id="<?= $prop['id'] ?>" data-kode="<?= htmlspecialchars($prop['kode_prop']) ?>" data-nama="<?= htmlspecialchars($prop['nama_prop']) ?>" data-target="<?= htmlspecialchars($prop['target'] ?? '') ?>" data-indikator="<?= htmlspecialchars($prop['indikator'] ?? '') ?>" data-ket="<?= htmlspecialchars($prop['keterangan'] ?? '') ?>">
                                                                                    <i class="fa fa-pencil"></i> Edit
                                                                                </button>
                                                                                <button class="item-dropdown text-danger HapusProP" data-id="<?= $prop['id'] ?>">
                                                                                    <i class="fa fa-trash"></i> Hapus
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            <?php 
                                                                $noProP++;
                                                                endforeach; 
                                                            ?>
                                                        <?php endif; ?>

                                                    <?php 
                                                        $noKP++;
                                                        endforeach; 
                                                    ?>
                                                <?php endif; ?>

                                            <?php 
                                                $noPP++;
                                                endforeach; 
                                            ?>
                                        <?php endif; ?>

                                    <?php 
                                        $noPN++;
                                        endforeach; 
                                    ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 30px; color: #999;">Belum ada data Renstra.</td>
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

<!-- ============================================== -->
<!-- MODAL TAMBAH PN -->
<!-- ============================================== -->
<div class="modal fade" id="modalAddPN" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Prioritas Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formAddPN">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_pn" placeholder="Kode PN" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_pn" placeholder="Nama PN" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" name="tahun_mulai" placeholder="Tahun Mulai (YYYY)" min="2000" max="2099" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" name="tahun_akhir" placeholder="Tahun Akhir (YYYY)" min="2000" max="2099" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="SimpanPN"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT PN -->
<!-- ============================================== -->
<div class="modal fade" id="modalEditPN" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Prioritas Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formEditPN">
                    <input type="hidden" name="id" id="editPN_id">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_pn" id="editPN_kode" placeholder="Kode PN" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_pn" id="editPN_nama" placeholder="Nama PN" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" name="tahun_mulai" id="editPN_mulai" placeholder="Tahun Mulai (YYYY)" min="2000" max="2099" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" name="tahun_akhir" id="editPN_akhir" placeholder="Tahun Akhir (YYYY)" min="2000" max="2099" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" id="editPN_ket" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="EditBtnPN"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL TAMBAH PP -->
<!-- ============================================== -->
<div class="modal fade" id="modalAddPP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Program Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formAddPP">
                    <input type="hidden" name="id_pn" id="addPP_id_pn">
                    <div class="periode-info" id="PeriodePPInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari PN yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_pp" placeholder="Kode PP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_pp" placeholder="Nama PP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="SimpanPP"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT PP -->
<!-- ============================================== -->
<div class="modal fade" id="modalEditPP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Program Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formEditPP">
                    <input type="hidden" name="id" id="editPP_id">
                    <div class="periode-info" id="EditPeriodePPInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari PN yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_pp" id="editPP_kode" placeholder="Kode PP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_pp" id="editPP_nama" placeholder="Nama PP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" id="editPP_ket" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="EditBtnPP"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL TAMBAH KP -->
<!-- ============================================== -->
<div class="modal fade" id="modalAddKP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Kegiatan Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formAddKP">
                    <input type="hidden" name="id_pp" id="addKP_id_pp">
                    <div class="periode-info" id="PeriodeKPInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari PP yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_kp" placeholder="Kode KP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_kp" placeholder="Nama KP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="SimpanKP"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT KP -->
<!-- ============================================== -->
<div class="modal fade" id="modalEditKP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Kegiatan Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formEditKP">
                    <input type="hidden" name="id" id="editKP_id">
                    <div class="periode-info" id="EditPeriodeKPInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari PP yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_kp" id="editKP_kode" placeholder="Kode KP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_kp" id="editKP_nama" placeholder="Nama KP" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" id="editKP_ket" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="EditBtnKP"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL TAMBAH PRO-P -->
<!-- ============================================== -->
<div class="modal fade" id="modalAddProP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Proyek Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formAddProP">
                    <input type="hidden" name="id_kp" id="addProP_id_kp">
                    <div class="periode-info" id="PeriodeProPInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari KP yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_prop" placeholder="Kode Pro-P" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_prop" placeholder="Nama Pro-P" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="target" rows="2" placeholder="Target" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="indikator" rows="2" placeholder="Indikator" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="SimpanProP"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT PRO-P -->
<!-- ============================================== -->
<div class="modal fade" id="modalEditProP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Proyek Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <form id="formEditProP">
                    <input type="hidden" name="id" id="editProP_id">
                    <div class="periode-info" id="EditPeriodeProPInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari KP yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="kode_prop" id="editProP_kode" placeholder="Kode Pro-P" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" name="nama_prop" id="editProP_nama" placeholder="Nama Pro-P" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="target" id="editProP_target" rows="2" placeholder="Target" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="indikator" id="editProP_indikator" rows="2" placeholder="Indikator" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" name="keterangan" id="editProP_ket" rows="3" placeholder="Keterangan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="EditBtnProP"><i class="fa fa-save"></i> Update</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

// ==============================================
// FUNGSI TOAST
// ==============================================
function showToast(message, type = 'error') {
    var toast = document.getElementById('toastError');
    var msgEl = document.getElementById('toastMessage');
    
    toast.className = 'toast-error';
    if (type === 'success') {
        toast.classList.add('success');
    } else {
        toast.classList.add('error');
    }
    
    msgEl.innerHTML = message;
    toast.style.display = 'block';
    
    clearTimeout(window.toastTimeout);
    window.toastTimeout = setTimeout(function() {
        toast.style.display = 'none';
    }, 5000);
}

// ==============================================
// FUNGSI LOADING
// ==============================================
function showLoading(show) {
    var overlay = document.getElementById('loadingOverlay');
    if (show) {
        overlay.style.display = 'flex';
    } else {
        overlay.style.display = 'none';
    }
}

// ==============================================
// FUNGSI TOGGLE DROPDOWN
// ==============================================
function toggleDropdown(button) {
    event.stopPropagation();
    var menu = button.nextElementSibling;
    var isOpen = menu.classList.contains('show');
    
    // Tutup semua dropdown lain
    document.querySelectorAll('.menu-dropdown.show').forEach(function(m) {
        if (m !== menu) m.classList.remove('show');
    });
    
    menu.classList.toggle('show');
}

// Tutup dropdown saat klik di luar
$(document).on('click', function(e) {
    if (!$(e.target).closest('.dropdown-aksi').length) {
        $('.menu-dropdown.show').removeClass('show');
    }
});

// ==============================================
// FUNGSI TOGGLE HIERARKI
// ==============================================
function toggleLevel(parentId, element) {
    var $parentTr = $(element).closest('tr');
    var $children = $('tr[data-parent="' + parentId + '"]');
    var isExpanded = $parentTr.data('expanded') === true;

    if (isExpanded) {
        // Collapse
        $parentTr.data('expanded', false);
        $children.each(function() {
            var $child = $(this);
            $child.removeClass('row-expand').addClass('row-collapse');
            setTimeout(function() {
                $child.hide().removeClass('row-collapse');
            }, 300);
            // Sembunyikan semua children dari children
            var childId = $child.data('id');
            $('tr[data-parent="' + childId + '"]').each(function() {
                $(this).hide().data('expanded', false);
            });
        });
    } else {
        // Expand
        $parentTr.data('expanded', true);
        $children.each(function(index) {
            var $child = $(this);
            setTimeout(function() {
                $child.show().addClass('row-expand');
                setTimeout(function() {
                    $child.removeClass('row-expand');
                }, 300);
            }, index * 50); // Stagger animation
        });
    }
}

// ==============================================
// INIT
// ==============================================
$(document).ready(function() {
    // Sembunyikan semua PP, KP, Pro-P
    $('.row-pp, .row-kp, .row-prop').hide();
    $('.level-row').data('expanded', false);

    // Auto expand saat klik tombol tambah
    $(document).on('click', '.TambahPP, .TambahKP, .TambahProP', function() {
        var $parentRow = $(this).closest('tr');
        var parentId = $parentRow.data('id');
        var isExpanded = $parentRow.data('expanded');
        
        if (!isExpanded) {
            toggleLevel(parentId, $parentRow.find('.clickable-row')[0] || $parentRow[0]);
        }
    });

    // ==============================================
    // CRUD PN
    // ==============================================
    $("#SimpanPN").click(function() {
        var form = $('#formAddPN');
        var kode = form.find('input[name="kode_pn"]').val();
        var nama = form.find('input[name="nama_pn"]').val();
        var tahunMulai = form.find('input[name="tahun_mulai"]').val();
        var tahunAkhir = form.find('input[name="tahun_akhir"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode PN harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama PN harus diisi!', 'error');
            return;
        }
        if (!tahunMulai || tahunMulai.toString().length != 4) {
            showToast('Tahun Mulai harus diisi dengan format YYYY!', 'error');
            return;
        }
        if (!tahunAkhir || tahunAkhir.toString().length != 4) {
            showToast('Tahun Akhir harus diisi dengan format YYYY!', 'error');
            return;
        }
        if (parseInt(tahunMulai) >= parseInt(tahunAkhir)) {
            showToast('Tahun Mulai harus lebih kecil dari Tahun Akhir!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#SimpanPN").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/InputPN", formData, function(res) {
            $("#SimpanPN").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            if (res.trim() === '1') {
                $('#modalAddPN').modal('hide');
                showToast('✅ Prioritas Nasional berhasil ditambahkan', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#SimpanPN").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Edit PN
    $(document).on('click', '.EditPN', function() {
        var btn = $(this);
        $('#editPN_id').val(btn.data('id'));
        $('#editPN_kode').val(btn.data('kode'));
        $('#editPN_nama').val(btn.data('nama'));
        $('#editPN_mulai').val(btn.data('mulai'));
        $('#editPN_akhir').val(btn.data('akhir'));
        $('#editPN_ket').val(btn.data('ket'));
        $('#modalEditPN').modal('show');
    });

    $("#EditBtnPN").click(function() {
        var form = $('#formEditPN');
        var kode = form.find('input[name="kode_pn"]').val();
        var nama = form.find('input[name="nama_pn"]').val();
        var tahunMulai = form.find('input[name="tahun_mulai"]').val();
        var tahunAkhir = form.find('input[name="tahun_akhir"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode PN harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama PN harus diisi!', 'error');
            return;
        }
        if (!tahunMulai || tahunMulai.toString().length != 4) {
            showToast('Tahun Mulai harus diisi dengan format YYYY!', 'error');
            return;
        }
        if (!tahunAkhir || tahunAkhir.toString().length != 4) {
            showToast('Tahun Akhir harus diisi dengan format YYYY!', 'error');
            return;
        }
        if (parseInt(tahunMulai) >= parseInt(tahunAkhir)) {
            showToast('Tahun Mulai harus lebih kecil dari Tahun Akhir!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#EditBtnPN").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/UpdatePN", formData, function(res) {
            $("#EditBtnPN").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            if (res.trim() === '1') {
                $('#modalEditPN').modal('hide');
                showToast('✅ Prioritas Nasional berhasil diupdate', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#EditBtnPN").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Hapus PN
    $(document).on('click', '.HapusPN', function() {
        if (confirm('Yakin hapus Prioritas Nasional ini?\nSemua Program, Kegiatan, dan Proyek di bawahnya akan terhapus secara permanen.')) {
            var id = $(this).data('id');
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            
            $.post(BaseURL + "Kementerian/DeletePN", {id: id, [CSRF_NAME]: CSRF_TOKEN}, function(res) {
                if (res.trim() === '1') {
                    showToast('✅ Prioritas Nasional berhasil dihapus', 'success');
                    setTimeout(function() { location.reload(); }, 600);
                } else {
                    btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                    showToast('❌ ' + res, 'error');
                }
            }).fail(function() {
                btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                showToast('❌ Gagal menghubungi server!', 'error');
            });
        }
    });

    // ==============================================
    // CRUD PP
    // ==============================================
    $(document).on('click', '.TambahPP', function() {
        var pnId = $(this).data('id');
        $('#addPP_id_pn').val(pnId);
        
        // Get PN info for periode
        $.post(BaseURL + "Kementerian/GetPNById", {
            id: pnId,
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data && data.tahun_mulai && data.tahun_akhir) {
                    var periode = data.tahun_mulai + ' - ' + data.tahun_akhir;
                    $('#PeriodePPInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari PN)');
                }
            } catch(e) {}
        });
        
        $('#formAddPP').find('input[name="kode_pp"]').val('');
        $('#formAddPP').find('input[name="nama_pp"]').val('');
        $('#formAddPP').find('textarea[name="keterangan"]').val('');
        $('#modalAddPP').modal('show');
    });

    $("#SimpanPP").click(function() {
        var form = $('#formAddPP');
        var kode = form.find('input[name="kode_pp"]').val();
        var nama = form.find('input[name="nama_pp"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode PP harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama PP harus diisi!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#SimpanPP").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/InputPP", formData, function(res) {
            $("#SimpanPP").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            if (res.trim() === '1') {
                $('#modalAddPP').modal('hide');
                showToast('✅ Program Prioritas berhasil ditambahkan', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#SimpanPP").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Edit PP
    $(document).on('click', '.EditPP', function() {
        var btn = $(this);
        $('#editPP_id').val(btn.data('id'));
        $('#editPP_kode').val(btn.data('kode'));
        $('#editPP_nama').val(btn.data('nama'));
        $('#editPP_ket').val(btn.data('ket'));
        
        // Get periode info
        $.post(BaseURL + "Kementerian/GetPPById", {
            id: btn.data('id'),
            [CSRF_NAME]: CSRF_TOKEN        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data && data.tahun_mulai && data.tahun_akhir) {
                    var periode = data.tahun_mulai + ' - ' + data.tahun_akhir;
                    $('#EditPeriodePPInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari PN)');
                }
            } catch(e) {}
        });
        
        $('#modalEditPP').modal('show');
    });

    $("#EditBtnPP").click(function() {
        var form = $('#formEditPP');
        var kode = form.find('input[name="kode_pp"]').val();
        var nama = form.find('input[name="nama_pp"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode PP harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama PP harus diisi!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#EditBtnPP").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/UpdatePP", formData, function(res) {
            $("#EditBtnPP").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            if (res.trim() === '1') {
                $('#modalEditPP').modal('hide');
                showToast('✅ Program Prioritas berhasil diupdate', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#EditBtnPP").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Hapus PP
    $(document).on('click', '.HapusPP', function() {
        if (confirm('Yakin hapus Program Prioritas ini?\nSemua KP dan Pro-P di bawahnya juga akan terhapus.')) {
            var id = $(this).data('id');
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            
            $.post(BaseURL + "Kementerian/DeletePP", {id: id, [CSRF_NAME]: CSRF_TOKEN}, function(res) {
                if (res.trim() === '1') {
                    showToast('✅ Program Prioritas berhasil dihapus', 'success');
                    setTimeout(function() { location.reload(); }, 600);
                } else {
                    btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                    showToast('❌ ' + res, 'error');
                }
            }).fail(function() {
                btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                showToast('❌ Gagal menghubungi server!', 'error');
            });
        }
    });

    // ==============================================
    // CRUD KP
    // ==============================================
    $(document).on('click', '.TambahKP', function() {
        var ppId = $(this).data('id');
        $('#addKP_id_pp').val(ppId);
        
        // Get PP info for periode
        $.post(BaseURL + "Kementerian/GetPPById", {
            id: ppId,
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data && data.tahun_mulai && data.tahun_akhir) {
                    var periode = data.tahun_mulai + ' - ' + data.tahun_akhir;
                    $('#PeriodeKPInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari PP)');
                }
            } catch(e) {}
        });
        
        $('#formAddKP').find('input[name="kode_kp"]').val('');
        $('#formAddKP').find('input[name="nama_kp"]').val('');
        $('#formAddKP').find('textarea[name="keterangan"]').val('');
        $('#modalAddKP').modal('show');
    });

    $("#SimpanKP").click(function() {
        var form = $('#formAddKP');
        var kode = form.find('input[name="kode_kp"]').val();
        var nama = form.find('input[name="nama_kp"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode KP harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama KP harus diisi!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#SimpanKP").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/InputKP", formData, function(res) {
            $("#SimpanKP").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            if (res.trim() === '1') {
                $('#modalAddKP').modal('hide');
                showToast('✅ Kegiatan Prioritas berhasil ditambahkan', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#SimpanKP").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Edit KP
    $(document).on('click', '.EditKP', function() {
        var btn = $(this);
        $('#editKP_id').val(btn.data('id'));
        $('#editKP_kode').val(btn.data('kode'));
        $('#editKP_nama').val(btn.data('nama'));
        $('#editKP_ket').val(btn.data('ket'));
        
        // Get periode info
        $.post(BaseURL + "Kementerian/GetKPById", {
            id: btn.data('id'),
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data && data.tahun_mulai && data.tahun_akhir) {
                    var periode = data.tahun_mulai + ' - ' + data.tahun_akhir;
                    $('#EditPeriodeKPInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari PP)');
                }
            } catch(e) {}
        });
        
        $('#modalEditKP').modal('show');
    });

    $("#EditBtnKP").click(function() {
        var form = $('#formEditKP');
        var kode = form.find('input[name="kode_kp"]').val();
        var nama = form.find('input[name="nama_kp"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode KP harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama KP harus diisi!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#EditBtnKP").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/UpdateKP", formData, function(res) {
            $("#EditBtnKP").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            if (res.trim() === '1') {
                $('#modalEditKP').modal('hide');
                showToast('✅ Kegiatan Prioritas berhasil diupdate', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#EditBtnKP").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Hapus KP
    $(document).on('click', '.HapusKP', function() {
        if (confirm('Yakin hapus Kegiatan Prioritas ini?\nSemua Pro-P di bawahnya juga akan terhapus.')) {
            var id = $(this).data('id');
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            
            $.post(BaseURL + "Kementerian/DeleteKP", {id: id, [CSRF_NAME]: CSRF_TOKEN}, function(res) {
                if (res.trim() === '1') {
                    showToast('✅ Kegiatan Prioritas berhasil dihapus', 'success');
                    setTimeout(function() { location.reload(); }, 600);
                } else {
                    btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                    showToast('❌ ' + res, 'error');
                }
            }).fail(function() {
                btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                showToast('❌ Gagal menghubungi server!', 'error');
            });
        }
    });

    // ==============================================
    // CRUD PRO-P
    // ==============================================
    $(document).on('click', '.TambahProP', function() {
        var kpId = $(this).data('id');
        $('#addProP_id_kp').val(kpId);
        
        // Get KP info for periode
        $.post(BaseURL + "Kementerian/GetKPById", {
            id: kpId,
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data && data.tahun_mulai && data.tahun_akhir) {
                    var periode = data.tahun_mulai + ' - ' + data.tahun_akhir;
                    $('#PeriodeProPInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari KP)');
                }
            } catch(e) {}
        });
        
        $('#formAddProP').find('input[name="kode_prop"]').val('');
        $('#formAddProP').find('input[name="nama_prop"]').val('');
        $('#formAddProP').find('textarea[name="target"]').val('');
        $('#formAddProP').find('textarea[name="indikator"]').val('');
        $('#formAddProP').find('textarea[name="keterangan"]').val('');
        $('#modalAddProP').modal('show');
    });

    $("#SimpanProP").click(function() {
        var form = $('#formAddProP');
        var kode = form.find('input[name="kode_prop"]').val();
        var nama = form.find('input[name="nama_prop"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode Pro-P harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama Pro-P harus diisi!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#SimpanProP").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/InputProP", formData, function(res) {
            $("#SimpanProP").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            if (res.trim() === '1') {
                $('#modalAddProP').modal('hide');
                showToast('✅ Proyek Prioritas berhasil ditambahkan', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#SimpanProP").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Edit Pro-P
    $(document).on('click', '.EditProP', function() {
        var btn = $(this);
        $('#editProP_id').val(btn.data('id'));
        $('#editProP_kode').val(btn.data('kode'));
        $('#editProP_nama').val(btn.data('nama'));
        $('#editProP_target').val(btn.data('target'));
        $('#editProP_indikator').val(btn.data('indikator'));
        $('#editProP_ket').val(btn.data('ket'));
        
        // Get periode info
        $.post(BaseURL + "Kementerian/GetProPById", {
            id: btn.data('id'),
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data && data.tahun_mulai && data.tahun_akhir) {
                    var periode = data.tahun_mulai + ' - ' + data.tahun_akhir;
                    $('#EditPeriodeProPInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari KP)');
                }
            } catch(e) {}
        });
        
        $('#modalEditProP').modal('show');
    });

    $("#EditBtnProP").click(function() {
        var form = $('#formEditProP');
        var kode = form.find('input[name="kode_prop"]').val();
        var nama = form.find('input[name="nama_prop"]').val();
        
        if (!kode || kode.trim() === '') {
            showToast('Kode Pro-P harus diisi!', 'error');
            return;
        }
        if (!nama || nama.trim() === '') {
            showToast('Nama Pro-P harus diisi!', 'error');
            return;
        }
        
        var formData = form.serialize();
        formData += '&' + CSRF_NAME + '=' + CSRF_TOKEN;
        
        $("#EditBtnProP").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.post(BaseURL + "Kementerian/UpdateProP", formData, function(res) {
            $("#EditBtnProP").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            if (res.trim() === '1') {
                $('#modalEditProP').modal('hide');
                showToast('✅ Proyek Prioritas berhasil diupdate', 'success');
                setTimeout(function() { location.reload(); }, 600);
            } else {
                showToast('❌ ' + res, 'error');
            }
        }).fail(function() {
            $("#EditBtnProP").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
            showToast('❌ Gagal menghubungi server!', 'error');
        });
    });

    // Hapus Pro-P
    $(document).on('click', '.HapusProP', function() {
        if (confirm('Yakin hapus Proyek Prioritas ini?')) {
            var id = $(this).data('id');
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            
            $.post(BaseURL + "Kementerian/DeleteProP", {id: id, [CSRF_NAME]: CSRF_TOKEN}, function(res) {
                if (res.trim() === '1') {
                    showToast('✅ Proyek Prioritas berhasil dihapus', 'success');
                    setTimeout(function() { location.reload(); }, 600);
                } else {
                    btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                    showToast('❌ ' + res, 'error');
                }
            }).fail(function() {
                btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                showToast('❌ Gagal menghubungi server!', 'error');
            });
        }
    });

});
</script>