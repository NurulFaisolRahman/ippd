<?php $this->load->view('Kementerian/Sidebar'); ?>

<style>
    .card-notika {
        background: #ffffff;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #e8e8e8;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .card-notika .card-header {
        padding: 14px 20px;
        background: #f9f9f9;
        border-bottom: 1px solid #e8e8e8;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .card-notika .card-header .card-title {
        font-size: 15px;
        font-weight: 600;
        color: #222;
    }
    .card-notika .card-body {
        padding: 18px 20px;
    }
    .table-notika {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .table-notika thead th {
        background: #f9f9f9;
        color: #444;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        padding: 10px 12px;
        border-bottom: 2px solid #e8e8e8;
        text-align: left;
    }
    .table-notika thead th.text-right { text-align: right; }
    .table-notika thead th.text-center { text-align: center; }
    .table-notika tbody td {
        padding: 9px 12px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }
    .table-notika tbody tr:hover { background: #f9f9f9; }
    .table-notika .text-right { text-align: right; }
    .table-notika .text-center { text-align: center; }
    .table-notika .total-row { background: #e8f0fe !important; font-weight: 600; }
    .table-notika .total-row td { border-top: 2px solid #4a90d9; }
    
    /* ============ DROPDOWN TITIK TIGA ============ */
    .dropdown-aksi {
        position: relative;
        display: inline-block;
    }
    .dropdown-aksi .btn-titik-tiga {
        background: transparent;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
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
        border-radius: 6px;
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
    
    .btn-notika {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
        text-decoration: none;
    }
    .btn-notika-primary { background: #4a90d9; color: #fff; }
    .btn-notika-primary:hover { background: #3a7bc8; }
    .btn-notika-success { background: #26B99A; color: #fff; }
    .btn-notika-success:hover { background: #1e8a73; }
    .btn-notika-warning { background: #f0ad4e; color: #fff; }
    .btn-notika-warning:hover { background: #d98c1f; }
    .btn-notika-danger { background: #e74c3c; color: #fff; }
    .btn-notika-danger:hover { background: #c0392b; }
    .btn-notika-outline { background: transparent; border: 1.5px solid #d1d1d1; color: #666; }
    .btn-notika-outline:hover { border-color: #4a90d9; color: #4a90d9; }
    .btn-notika-xs { padding: 2px 8px; font-size: 11px; border-radius: 3px; }
    .btn-notika-sm { padding: 4px 12px; font-size: 12px; }
    
    .badge-notika {
        display: inline-block;
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }
    .badge-notika-success { background: #e8f5f0; color: #26B99A; }
    .badge-notika-warning { background: #fef8e7; color: #f0ad4e; }
    .badge-notika-danger { background: #fde8e5; color: #e74c3c; }
    .badge-notika-info { background: #e8f0fe; color: #4a90d9; }
    
    .year-nav { display: flex; flex-wrap: wrap; gap: 5px; }
    .year-nav .year-btn {
        min-width: 44px;
        padding: 4px 10px;
        border: 1.5px solid #d1d1d1;
        border-radius: 4px;
        background: #fff;
        color: #666;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.25s ease;
        text-align: center;
    }
    .year-nav .year-btn:hover { border-color: #4a90d9; background: #e8f0fe; }
    .year-nav .year-btn.active { background: #4a90d9; border-color: #4a90d9; color: #fff; }
    .year-nav .year-btn.has-data { border-color: #26B99A; color: #26B99A; }
    .year-nav .year-btn.has-data.active { background: #26B99A; border-color: #26B99A; color: #fff; }
    .year-nav .year-btn.has-data:hover { background: #e8f5f0; }
    .year-nav .year-btn.renja-only { border-color: #f0ad4e; color: #f0ad4e; }
    .year-nav .year-btn.renja-only.active { background: #f0ad4e; border-color: #f0ad4e; color: #fff; }
    .year-nav .year-btn.no-data { border-color: #e74c3c; color: #e74c3c; }
    .year-nav .year-btn.no-data.active { background: #e74c3c; border-color: #e74c3c; color: #fff; }
    .year-nav .year-btn .status-icon { font-size: 10px; margin-left: 2px; }
    
    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-state .empty-icon { font-size: 48px; margin-bottom: 12px; opacity: 0.4; }
    .empty-state h4 { color: #444; margin-bottom: 6px; }
    .empty-state p { color: #888; font-size: 13px; max-width: 400px; margin: 0 auto 16px; }
    
    .loading-state { display: flex; flex-direction: column; align-items: center; padding: 40px 20px; }
    .loading-state .spinner {
        width: 40px; height: 40px;
        border: 3px solid #e8e8e8;
        border-top-color: #4a90d9;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    
    .form-group-notika { margin-bottom: 14px; }
    .form-group-notika label { display: block; font-weight: 500; color: #444; font-size: 13px; margin-bottom: 3px; }
    .form-group-notika .form-control {
        width: 100%; padding: 7px 12px;
        border: 1.5px solid #d1d1d1;
        border-radius: 4px;
        font-size: 13px;
        transition: all 0.25s ease;
        background: #fff;
        color: #222;
    }
    .form-group-notika .form-control:focus { outline: none; border-color: #4a90d9; box-shadow: 0 0 0 3px rgba(74,144,217,0.15); }
    .form-group-notika .help-text { font-size: 12px; color: #888; margin-top: 3px; }
    
    .modal-notika .modal-content { border-radius: 6px; border: none; }
    .modal-notika .modal-header {
        border-bottom: 1px solid #e8e8e8;
        padding: 14px 20px;
        background: #f9f9f9;
        border-radius: 6px 6px 0 0;
    }
    .modal-notika .modal-header .modal-title { font-weight: 600; color: #222; }
    .modal-notika .modal-body { padding: 20px; }
    .modal-notika .modal-footer {
        border-top: 1px solid #e8e8e8;
        padding: 14px 20px;
        background: #f9f9f9;
        border-radius: 0 0 6px 6px;
    }
    
    .alert-notika {
        border-radius: 4px;
        border-left: 4px solid #4a90d9;
        padding: 10px 16px;
        margin-bottom: 16px;
        background: #e8f0fe;
        color: #444;
    }
    
    .akumulasi-box {
        background: linear-gradient(135deg, #4a90d9 0%, #357abd 100%);
        border-radius: 6px;
        padding: 16px 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        gap: 10px;
        margin-bottom: 20px;
    }
    .akumulasi-box .item { text-align: center; padding: 8px 16px; background: rgba(255,255,255,0.12); border-radius: 4px; flex: 1; min-width: 120px; }
    .akumulasi-box .item .label { font-size: 11px; opacity: 0.85; color: rgba(255,255,255,0.9); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; }
    .akumulasi-box .item .value { font-size: 18px; font-weight: 700; color: #fff; margin-top: 2px; }
    
    .rekap-card { background: #fff; padding: 14px 18px; border-radius: 4px; text-align: center; border: 1px solid #e8e8e8; }
    .rekap-card .rekap-label { font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500; }
    .rekap-card .rekap-value { font-size: 18px; font-weight: 700; color: #4a90d9; margin-top: 2px; }
    .rekap-card.rekap-highlight { background: #e8f5f0; border-color: #26B99A; }
    .rekap-card.rekap-highlight .rekap-value { color: #26B99A; }
    
    @media (max-width: 768px) {
        .card-notika .card-header { flex-direction: column; align-items: flex-start; }
        .year-nav .year-btn { min-width: 36px; padding: 3px 6px; font-size: 12px; }
        .table-notika { font-size: 12px; }
        .table-notika thead th, .table-notika tbody td { padding: 6px 8px; }
        .dropdown-aksi .menu-dropdown {
            right: -10px;
            min-width: 150px;
        }
    }
    @media print {
        .btn-notika, .no-print, .dropdown-aksi { display: none !important; }
        .akumulasi-box { background: #4a90d9 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
</style>

<!-- BREADCRUMB -->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcomb-list">
                    <ul class="breadcomb-menu" style="list-style:none;padding:0;margin:0;">
                        <li style="display:inline-block;margin-right:5px;">
                            <a href="<?= base_url('Beranda') ?>">Beranda</a>
                            <span style="margin:0 5px;">/</span>
                        </li>
                        <li style="display:inline-block;margin-right:5px;">
                            <a href="<?= base_url('Kementerian/renjaanggaranrekap2') ?>">Kementerian</a>
                            <span style="margin:0 5px;">/</span>
                        </li>
                        <li style="display:inline-block;">
                            <span class="bread-blk">Rekap 2 - Program K/L</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Info Kementerian -->
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                <div class="alert-notika">
                    <div style="display:flex;flex-wrap:wrap;gap:16px;">
                        <div><strong>Kementerian :</strong> <?= htmlspecialchars($UserKementerianName ?? '-') ?></div>
                        <div><strong>Periode :</strong> <?= htmlspecialchars($UserPeriode ?? '-') ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tombol Aksi -->
                <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px;">
                    <button class="btn-notika btn-notika-success" data-toggle="modal" data-target="#ModalRekap2">
                        <span>+</span> Buat/Edit Rekap 2
                    </button>
                    <?php if ($Rekap2): ?>
                    <button class="btn-notika btn-notika-outline" onclick="window.print()">
                        <span>⎙</span> Cetak
                    </button>
                    <?php endif; ?>
                </div>

                <!-- Akumulasi -->
                <div id="akumulasiContainer"></div>

                <!-- ============================================================
                    YEAR NAVIGATION
                    ============================================================ -->
                <div class="card-notika" style="background:#f9f9f9;">
                    <div class="card-body" style="padding:12px 16px;">
                        <div style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;gap:10px;">
                            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                                <span style="font-weight:600;color:#444;font-size:13px;">Tahun:</span>
                                <div class="year-nav" id="tahunNav">
                                    <?php foreach ($TahunList as $t): 
                                        $status = $TahunStatus[$t] ?? 'empty';
                                        $active = ($t == $CurrentTahun) ? 'active' : '';
                                        
                                        if ($status == 'filled') {
                                            $status_class = 'has-data';
                                            $status_icon = '✓';
                                        } elseif ($status == 'renja_only') {
                                            $status_class = 'renja-only';
                                            $status_icon = '○';
                                        } else {
                                            $status_class = 'no-data';
                                            $status_icon = '+';
                                        }
                                    ?>
                                    <button class="year-btn <?= $active ?> <?= $status_class ?>" 
                                        data-tahun="<?= $t ?>"
                                        data-status="<?= $status ?>"
                                        onclick="loadDataTahun(<?= $t ?>)">
                                        <?= $t ?>
                                        <span class="status-icon"><?= $status_icon ?></span>
                                    </button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                                <span class="badge-notika badge-notika-info">Periode: <?= $UserTahunMulai ?? '' ?> - <?= $UserTahunAkhir ?? '' ?></span>
                                <?php if ($Rekap2): ?>
                                <span class="badge-notika badge-notika-success">Data <?= $CurrentTahun ?></span>
                                <?php elseif ($IdRenja): ?>
                                <span class="badge-notika badge-notika-warning">Renja ada, Rekap 2 belum</span>
                                <?php else: ?>
                                <span class="badge-notika badge-notika-danger">Belum ada data</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div style="margin-top:6px;">
                            <small style="color:#888;font-size:11px;">
                                <span style="color:#26B99A;">✓</span> Lengkap &nbsp;|&nbsp;
                                <span style="color:#f0ad4e;">○</span> Renja saja &nbsp;|&nbsp;
                                <span style="color:#e74c3c;">+</span> Kosong
                            </small>
                        </div>
                    </div>
                </div>

                <!-- ============================================================
                    LOADING
                    ============================================================ -->
                <div id="loadingData" style="display:none;">
                    <div class="loading-state">
                        <div class="spinner"></div>
                        <p style="margin-top:12px;color:#888;font-weight:500;">Memuat data...</p>
                    </div>
                </div>

                <!-- ============================================================
                    CONTENT DATA
                    ============================================================ -->
                <div id="contentData">
                    <?php if ($Rekap2): ?>
                        <!-- ============================================================
                        HEADER REKAP 2
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Rekap 2 - Program K/L <span class="badge-notika badge-notika-info">Tahun <?= $CurrentTahun ?></span></div>
                            </div>
                            <div class="card-body">
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                                    <div>
                                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Sasaran Strategis K/L</div>
                                        <div style="color:#666;font-size:13px;"><?= nl2br(htmlspecialchars($Rekap2['sasaran_strategis'] ?? '-')) ?></div>
                                    </div>
                                    <div>
                                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Program</div>
                                        <div style="color:#666;font-size:13px;"><?= nl2br(htmlspecialchars($Rekap2['program'] ?? '-')) ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ============================================================
                        PRIORITAS NASIONAL
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Prioritas Nasional / Program Prioritas</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalPrioritas">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table-notika">
                                    <thead>
                                        <tr>
                                            <th style="width:10%;">Kode</th>
                                            <th>Prioritas Nasional</th>
                                            <th>Program Prioritas</th>
                                            <th class="text-right" style="width:18%;">Alokasi (Ribu)</th>
                                            <th class="text-center" style="width:8%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total_prioritas = 0;
                                        foreach ($Prioritas as $p): 
                                            $total_prioritas += $p['alokasi'];
                                        ?>
                                        <tr>
                                            <td><span class="badge-notika badge-notika-info"><?= htmlspecialchars($p['kode']) ?></span></td>
                                            <td><?= htmlspecialchars($p['nama_prioritas']) ?></td>
                                            <td><?= htmlspecialchars($p['program_prioritas'] ?? '-') ?></td>
                                            <td class="text-right"><?= number_format($p['alokasi'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown-aksi">
                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="menu-dropdown">
                                                        <button class="item-dropdown edit-prioritas" 
                                                            data-id="<?= $p['id'] ?>"
                                                            data-kode="<?= htmlspecialchars($p['kode']) ?>"
                                                            data-nama="<?= htmlspecialchars($p['nama_prioritas']) ?>"
                                                            data-program="<?= htmlspecialchars($p['program_prioritas'] ?? '') ?>"
                                                            data-alokasi="<?= $p['alokasi'] ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </button>
                                                        <button class="item-dropdown text-danger delete-prioritas" data-id="<?= $p['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($Prioritas)): ?>
                                        <tr><td colspan="5" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data prioritas</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="3" class="text-right">TOTAL</td>
                                            <td class="text-right"><?= number_format($total_prioritas, 0, ',', '.') ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- ============================================================
                        SASARAN PROGRAM
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Sasaran Program (Outcome) dan Indikator Kinerja Program (IKP)</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalSasaran">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table-notika">
                                    <thead>
                                        <tr>
                                            <th style="width:8%;">Kode</th>
                                            <th>Sasaran Program</th>
                                            <th>Indikator Kinerja</th>
                                            <th class="text-center" style="width:10%;">Target</th>
                                            <th class="text-right" style="width:15%;">Alokasi (Ribu)</th>
                                            <th class="text-center" style="width:8%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total_sasaran = 0;
                                        foreach ($SasaranProgram as $s): 
                                            $total_sasaran += $s['alokasi'];
                                        ?>
                                        <tr>
                                            <td><span class="badge-notika badge-notika-info"><?= htmlspecialchars($s['kode']) ?></span></td>
                                            <td><?= htmlspecialchars($s['nama_sasaran']) ?></td>
                                            <td><?= htmlspecialchars($s['indikator_kinerja'] ?? '-') ?></td>
                                            <td class="text-center"><?= htmlspecialchars($s['target'] ?? '-') ?></td>
                                            <td class="text-right"><?= number_format($s['alokasi'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown-aksi">
                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="menu-dropdown">
                                                        <button class="item-dropdown edit-sasaran"
                                                            data-id="<?= $s['id'] ?>"
                                                            data-kode="<?= htmlspecialchars($s['kode']) ?>"
                                                            data-nama="<?= htmlspecialchars($s['nama_sasaran']) ?>"
                                                            data-indikator="<?= htmlspecialchars($s['indikator_kinerja'] ?? '') ?>"
                                                            data-target="<?= htmlspecialchars($s['target'] ?? '') ?>"
                                                            data-alokasi="<?= $s['alokasi'] ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </button>
                                                        <button class="item-dropdown text-danger delete-sasaran" data-id="<?= $s['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($SasaranProgram)): ?>
                                        <tr><td colspan="6" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data sasaran program</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="4" class="text-right">TOTAL</td>
                                            <td class="text-right"><?= number_format($total_sasaran, 0, ',', '.') ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- ============================================================
                        OUTPUT PROGRAM
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Output Program dan Indikator Output Program</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalOutput">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table-notika">
                                    <thead>
                                        <tr>
                                            <th style="width:8%;">Kode</th>
                                            <th>Output Program</th>
                                            <th>Indikator Output</th>
                                            <th class="text-right" style="width:18%;">Alokasi (Ribu)</th>
                                            <th class="text-center" style="width:8%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total_output = 0;
                                        foreach ($OutputProgram as $o): 
                                            $total_output += $o['alokasi'];
                                        ?>
                                        <tr>
                                            <td><span class="badge-notika badge-notika-info"><?= htmlspecialchars($o['kode']) ?></span></td>
                                            <td><?= htmlspecialchars($o['nama_output']) ?></td>
                                            <td><?= htmlspecialchars($o['indikator_output'] ?? '-') ?></td>
                                            <td class="text-right"><?= number_format($o['alokasi'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown-aksi">
                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="menu-dropdown">
                                                        <button class="item-dropdown edit-output"
                                                            data-id="<?= $o['id'] ?>"
                                                            data-kode="<?= htmlspecialchars($o['kode']) ?>"
                                                            data-nama="<?= htmlspecialchars($o['nama_output']) ?>"
                                                            data-indikator="<?= htmlspecialchars($o['indikator_output'] ?? '') ?>"
                                                            data-alokasi="<?= $o['alokasi'] ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </button>
                                                        <button class="item-dropdown text-danger delete-output" data-id="<?= $o['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($OutputProgram)): ?>
                                        <tr><td colspan="5" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data output program</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="3" class="text-right">TOTAL</td>
                                            <td class="text-right"><?= number_format($total_output, 0, ',', '.') ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- ============================================================
                        KEGIATAN DAN PENDANAAN
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Kegiatan dan Pendanaan</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalKegiatan">
                                    <span>+</span> Tambah Kegiatan
                                </button>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table-notika" style="font-size:12px;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width:8%;">Kode</th>
                                            <th rowspan="2">Program / Kegiatan</th>
                                            <th colspan="10" class="text-center">Indikasi Pendanaan Tahun <?= $CurrentTahun ?></th>
                                            <th colspan="3" class="text-center">Prakiraan Kebutuhan</th>
                                            <th rowspan="2" class="text-center" style="width:8%;">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right">RPP</th>
                                            <th class="text-right">NBP</th>
                                            <th class="text-right">BLU</th>
                                            <th class="text-right">LN</th>
                                            <th class="text-right">RM</th>
                                            <th class="text-right">PPDN</th>
                                            <th class="text-right">HIBAH</th>
                                            <th class="text-right">PHBS</th>
                                            <th class="text-right">SNH</th>
                                            <th class="text-right">NT</th>
                                            <th class="text-right">2026</th>
                                            <th class="text-right">2027</th>
                                            <th class="text-right">2028</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sources = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
                                        $grand_total = 0;
                                        foreach ($Kegiatan as $k): 
                                            $grand_total += $k['total'];
                                        ?>
                                        <tr>
                                            <td><span class="badge-notika badge-notika-info"><?= htmlspecialchars($k['kode']) ?></span></td>
                                            <td><?= htmlspecialchars($k['nama_kegiatan']) ?></td>
                                            <?php foreach ($sources as $src): ?>
                                            <td class="text-right"><?= number_format($k[$src] ?? 0, 0, ',', '.') ?></td>
                                            <?php endforeach; ?>
                                            <td class="text-right"><?= number_format($k['tahun_2026'] ?? 0, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($k['tahun_2027'] ?? 0, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($k['tahun_2028'] ?? 0, 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown-aksi">
                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="menu-dropdown">
                                                        <button class="item-dropdown edit-kegiatan"
                                                            data-id="<?= $k['id'] ?>"
                                                            data-kode="<?= htmlspecialchars($k['kode']) ?>"
                                                            data-nama="<?= htmlspecialchars($k['nama_kegiatan']) ?>"
                                                            <?php foreach ($sources as $src): ?>
                                                            data-<?= $src ?>="<?= $k[$src] ?? 0 ?>"
                                                            <?php endforeach; ?>
                                                            data-tahun_2026="<?= $k['tahun_2026'] ?? 0 ?>"
                                                            data-tahun_2027="<?= $k['tahun_2027'] ?? 0 ?>"
                                                            data-tahun_2028="<?= $k['tahun_2028'] ?? 0 ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </button>
                                                        <button class="item-dropdown text-danger delete-kegiatan" data-id="<?= $k['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($Kegiatan)): ?>
                                        <tr><td colspan="16" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data kegiatan</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="2" class="text-right"><strong>TOTAL</strong></td>
                                            <?php 
                                            $totals = array_fill_keys($sources, 0);
                                            $total_2026 = 0; $total_2027 = 0; $total_2028 = 0;
                                            foreach ($Kegiatan as $k) {
                                                foreach ($sources as $src) {
                                                    $totals[$src] += $k[$src] ?? 0;
                                                }
                                                $total_2026 += $k['tahun_2026'] ?? 0;
                                                $total_2027 += $k['tahun_2027'] ?? 0;
                                                $total_2028 += $k['tahun_2028'] ?? 0;
                                            }
                                            foreach ($sources as $src): 
                                            ?>
                                            <td class="text-right"><?= number_format($totals[$src], 0, ',', '.') ?></td>
                                            <?php endforeach; ?>
                                            <td class="text-right"><?= number_format($total_2026, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($total_2027, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($total_2028, 0, ',', '.') ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- ============================================================
                        REKAPITULASI AKHIR
                        ============================================================ -->
                        <div class="card-notika" style="background:#f9f9f9;">
                            <div class="card-header" style="background:#fff;">
                                <div class="card-title">
                                    Rekapitulasi Anggaran
                                    <span class="badge-notika badge-notika-success">Total Akumulasi</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(160px, 1fr));gap:14px;">
                                    <div class="rekap-card">
                                        <div class="rekap-label">Prioritas Nasional</div>
                                        <div class="rekap-value">Rp <?= number_format($total_prioritas, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card">
                                        <div class="rekap-label">Sasaran Program</div>
                                        <div class="rekap-value">Rp <?= number_format($total_sasaran, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card">
                                        <div class="rekap-label">Output Program</div>
                                        <div class="rekap-value">Rp <?= number_format($total_output, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card rekap-highlight">
                                        <div class="rekap-label">Total Kegiatan & Pendanaan</div>
                                        <div class="rekap-value">Rp <?= number_format($grand_total, 0, ',', '.') ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($IdRenja): ?>
                        <!-- Renja ada tapi Rekap 2 belum -->
                        <div class="card-notika">
                            <div class="card-body">
                                <div class="empty-state">
                                    <div class="empty-icon">📋</div>
                                    <h4>Data Rekap 2 Belum Dibuat</h4>
                                    <p>Renja untuk tahun <strong><?= $CurrentTahun ?></strong> sudah ada, namun Rekap 2 belum diisi.</p>
                                    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                                        <button class="btn-notika btn-notika-success" onclick="createRekap2()">
                                            <span>+</span> Buat Rekap 2
                                        </button>
                                        <button class="btn-notika btn-notika-primary" data-toggle="modal" data-target="#ModalRekap2">
                                            <span>✎</span> Isi Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Belum ada Renja sama sekali -->
                        <div class="card-notika">
                            <div class="card-body">
                                <div class="empty-state">
                                    <div class="empty-icon">📄</div>
                                    <h4>Belum Ada Data</h4>
                                    <p>Untuk tahun <strong><?= $CurrentTahun ?></strong>, belum ada data Renja dan Rekap 2.</p>
                                    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                                        <a href="<?= base_url('Kementerian/renjaanggaranrekap1?tahun=' . $CurrentTahun) ?>" class="btn-notika btn-notika-primary">
                                            <span>+</span> Buat Renja di Rekap 1
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ============================================================
    MODALS
    ============================================================ -->

<!-- Modal Rekap 2 -->
<div class="modal fade modal-notika" id="ModalRekap2" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Rekap 2 - Program K/L</h4>
            </div>
            <div class="modal-body">
                <form id="FormRekap2">
                    <input type="hidden" name="id" id="Rekap2Id" value="<?= $Rekap2['id'] ?? '' ?>">
                    <input type="hidden" name="id_renja" id="Rekap2IdRenja" value="<?= $IdRenja ?? '' ?>">
                    <input type="hidden" name="tahun" id="Rekap2Tahun" value="<?= $CurrentTahun ?>">
                    
                    <div class="form-group-notika">
                        <label>Sasaran Strategis K/L</label>
                        <textarea class="form-control" name="sasaran_strategis" id="Rekap2Sasaran" rows="3"><?= htmlspecialchars($Rekap2['sasaran_strategis'] ?? '') ?></textarea>
                        <div class="help-text">Contoh: 01 - Terwujudnya Perekonomian Indonesia yang Unggul...</div>
                    </div>
                    <div class="form-group-notika">
                        <label>Program</label>
                        <input type="text" class="form-control" name="program" id="Rekap2Program" value="<?= htmlspecialchars($Rekap2['program'] ?? '') ?>">
                        <div class="help-text">Contoh: Program Koordinasi Pelaksanaan Kebijakan</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormRekap2">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Prioritas -->
<div class="modal fade modal-notika" id="ModalPrioritas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="PrioritasTitle">Tambah Prioritas Nasional</h4>
            </div>
            <div class="modal-body">
                <form id="FormPrioritas">
                    <input type="hidden" name="id" id="PrioritasId">
                    <input type="hidden" name="id_rekap2" id="PrioritasIdRekap2" value="<?= $Rekap2['id'] ?? '' ?>">
                    <div class="form-group-notika">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="PrioritasKode" required maxlength="20">
                        <div class="help-text">Contoh: 02, 02.08, 02.16</div>
                    </div>
                    <div class="form-group-notika">
                        <label>Prioritas Nasional</label>
                        <input type="text" class="form-control" name="nama_prioritas" id="PrioritasNama" required>
                    </div>
                    <div class="form-group-notika">
                        <label>Program Prioritas</label>
                        <input type="text" class="form-control" name="program_prioritas" id="PrioritasProgram">
                    </div>
                    <div class="form-group-notika">
                        <label>Alokasi (Ribu Rupiah)</label>
                        <input type="number" class="form-control" name="alokasi" id="PrioritasAlokasi" value="0" step="1000">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormPrioritas">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sasaran Program -->
<div class="modal fade modal-notika" id="ModalSasaran" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="SasaranTitle">Tambah Sasaran Program</h4>
            </div>
            <div class="modal-body">
                <form id="FormSasaran">
                    <input type="hidden" name="id" id="SasaranId">
                    <input type="hidden" name="id_rekap2" id="SasaranIdRekap2" value="<?= $Rekap2['id'] ?? '' ?>">
                    <div class="form-group-notika">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="SasaranKode" required maxlength="20">
                        <div class="help-text">Contoh: 01, 01.01</div>
                    </div>
                    <div class="form-group-notika">
                        <label>Sasaran Program</label>
                        <input type="text" class="form-control" name="nama_sasaran" id="SasaranNama" required>
                    </div>
                    <div class="form-group-notika">
                        <label>Indikator Kinerja Program (IKP)</label>
                        <input type="text" class="form-control" name="indikator_kinerja" id="SasaranIndikator">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="form-group-notika">
                            <label>Target</label>
                            <input type="text" class="form-control" name="target" id="SasaranTarget">
                        </div>
                        <div class="form-group-notika">
                            <label>Alokasi (Ribu Rupiah)</label>
                            <input type="number" class="form-control" name="alokasi" id="SasaranAlokasi" value="0" step="1000">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormSasaran">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Output Program -->
<div class="modal fade modal-notika" id="ModalOutput" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Output Program</h4>
            </div>
            <div class="modal-body">
                <form id="FormOutput">
                    <input type="hidden" name="id" id="OutputId">
                    <input type="hidden" name="id_rekap2" id="OutputIdRekap2" value="<?= $Rekap2['id'] ?? '' ?>">
                    <div class="form-group-notika">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="OutputKode" required maxlength="20">
                    </div>
                    <div class="form-group-notika">
                        <label>Output Program</label>
                        <input type="text" class="form-control" name="nama_output" id="OutputNama" required>
                    </div>
                    <div class="form-group-notika">
                        <label>Indikator Output</label>
                        <input type="text" class="form-control" name="indikator_output" id="OutputIndikator">
                    </div>
                    <div class="form-group-notika">
                        <label>Alokasi (Ribu Rupiah)</label>
                        <input type="number" class="form-control" name="alokasi" id="OutputAlokasi" value="0" step="1000">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormOutput">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kegiatan -->
<div class="modal fade modal-notika" id="ModalKegiatan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Kegiatan dan Pendanaan</h4>
            </div>
            <div class="modal-body">
                <form id="FormKegiatan">
                    <input type="hidden" name="id" id="KegiatanId">
                    <input type="hidden" name="id_rekap2" id="KegiatanIdRekap2" value="<?= $Rekap2['id'] ?? '' ?>">
                    
                    <div style="display:grid;grid-template-columns:1fr 2fr;gap:16px;">
                        <div class="form-group-notika">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode" id="KegiatanKode" required maxlength="20">
                        </div>
                        <div class="form-group-notika">
                            <label>Nama Kegiatan</label>
                            <input type="text" class="form-control" name="nama_kegiatan" id="KegiatanNama" required>
                        </div>
                    </div>
                    
                    <div style="margin-top:12px;">
                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:8px;">Indikasi Pendanaan Tahun <?= $CurrentTahun ?></div>
                        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(90px, 1fr));gap:8px;">
                            <?php 
                            $sumber_dana = [
                                'rpp' => 'RPP', 'nbp' => 'NBP', 'blu' => 'BLU',
                                'ln' => 'LN', 'rm' => 'RM', 'ppdn' => 'PPDN',
                                'hibah' => 'HIBAH', 'phbs' => 'PHBS', 'snh' => 'SNH', 'nt' => 'NT'
                            ];
                            foreach ($sumber_dana as $key => $label): 
                            ?>
                            <div class="form-group-notika" style="margin-bottom:0;">
                                <label style="font-size:11px;color:#888;"><?= $label ?></label>
                                <input type="number" class="form-control sumber-dana-input" 
                                    name="<?= $key ?>" id="Kegiatan<?= strtoupper($key) ?>" 
                                    value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div style="margin-top:12px;">
                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:8px;">Prakiraan Kebutuhan</div>
                        <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:12px;">
                            <div class="form-group-notika" style="margin-bottom:0;">
                                <label style="font-size:11px;color:#888;">2026</label>
                                <input type="number" class="form-control" name="tahun_2026" id="Kegiatan2026" value="0" step="1000">
                            </div>
                            <div class="form-group-notika" style="margin-bottom:0;">
                                <label style="font-size:11px;color:#888;">2027</label>
                                <input type="number" class="form-control" name="tahun_2027" id="Kegiatan2027" value="0" step="1000">
                            </div>
                            <div class="form-group-notika" style="margin-bottom:0;">
                                <label style="font-size:11px;color:#888;">2028</label>
                                <input type="number" class="form-control" name="tahun_2028" id="Kegiatan2028" value="0" step="1000">
                            </div>
                        </div>
                    </div>
                    
                    <div style="background:#e8f0fe;padding:12px 16px;border-radius:4px;margin-top:14px;">
                        <label style="font-weight:600;color:#444;font-size:13px;display:block;margin-bottom:2px;">TOTAL</label>
                        <input type="text" class="form-control" id="KegiatanTotal" readonly style="font-weight:700;font-size:16px;background:#fff;border-color:#4a90d9;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormKegiatan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
    SCRIPTS
    ============================================================ -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var IdRekap2 = <?= json_encode($Rekap2['id'] ?? null) ?>;
var CurrentTahun = <?= json_encode($CurrentTahun) ?>;
var IdRenja = <?= json_encode($IdRenja ?? null) ?>;

// ============================================================
// FUNGSI TOGGLE DROPDOWN
// ============================================================
function toggleDropdown(button) {
    event.stopPropagation();
    var menu = button.nextElementSibling;
    var isOpen = menu.classList.contains('show');
    
    // Close all other dropdowns
    document.querySelectorAll('.menu-dropdown.show').forEach(function(m) {
        if (m !== menu) m.classList.remove('show');
    });
    
    menu.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-aksi')) {
        document.querySelectorAll('.menu-dropdown.show').forEach(function(menu) {
            menu.classList.remove('show');
        });
    }
});

// ============================================================
// FUNGSI UTILITY
// ============================================================
function formatNumber(num) {
    if (!num) return '0';
    return Number(num).toLocaleString('id-ID');
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ============================================================
// CREATE REKAP 2
// ============================================================
function createRekap2() {
    if (!IdRenja) {
        alert('ID Renja tidak ditemukan');
        return;
    }
    
    if (!confirm('Buat data Rekap 2 untuk tahun ' + CurrentTahun + '?')) return;
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_create",
        type: "POST",
        data: {id_renja: IdRenja, tahun: CurrentTahun},
        dataType: "json",
        success: function(res) {
            if (res.success) {
                alert(res.message);
                location.reload();
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Gagal menghubungi server: ' + error);
        }
    });
}

// ============================================================
// LOAD DATA PER TAHUN
// ============================================================
function loadDataTahun(tahun) {
    $('#loadingData').show();
    $('#contentData').hide();
    
    $('.year-btn').removeClass('active');
    var btn = $('.year-btn[data-tahun="' + tahun + '"]');
    btn.addClass('active');
    
    var status = btn.data('status');
    
    if (status === 'empty') {
        $('#loadingData').hide();
        var html = '<div class="card-notika"><div class="card-body"><div class="empty-state">';
        html += '<div class="empty-icon">📄</div>';
        html += '<h4>Belum Ada Data</h4>';
        html += '<p>Untuk tahun <strong>' + tahun + '</strong>, belum ada data Renja dan Rekap 2.</p>';
        html += '<a href="' + BaseURL + 'Kementerian/renjaanggaranrekap1?tahun=' + tahun + '" class="btn-notika btn-notika-primary">';
        html += '<span>+</span> Buat Renja di Rekap 1</a>';
        html += '</div></div></div>';
        $('#contentData').html(html);
        $('#contentData').show();
        return;
    }
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_get_by_tahun",
        type: "POST",
        data: {tahun: tahun},
        dataType: "json",
        success: function(res) {
            $('#loadingData').hide();
            
            if (res.success) {
                CurrentTahun = tahun;
                IdRekap2 = res.data.rekap2.id;
                renderData(res.data);
                $('#contentData').show();
            } else {
                if (res.can_create && res.id_renja) {
                    IdRenja = res.id_renja;
                    var html = '<div class="card-notika"><div class="card-body"><div class="empty-state">';
                    html += '<div class="empty-icon">📋</div>';
                    html += '<h4>' + res.message + '</h4>';
                    html += '<div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">';
                    html += '<button class="btn-notika btn-notika-success" onclick="createRekap2()">';
                    html += '<span>+</span> Buat Rekap 2</button>';
                    html += '<button class="btn-notika btn-notika-primary" data-toggle="modal" data-target="#ModalRekap2">';
                    html += '<span>✎</span> Isi Data</button>';
                    html += '</div></div></div></div>';
                    $('#contentData').html(html);
                } else {
                    $('#contentData').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
                $('#contentData').show();
            }
        },
        error: function(xhr, status, error) {
            $('#loadingData').hide();
            $('#contentData').html('<div class="alert alert-danger">Gagal memuat data: ' + error + '</div>');
            $('#contentData').show();
            console.log(xhr.responseText);
        }
    });
}

// ============================================================
// RENDER DATA
// ============================================================
function renderData(data) {
    // Update hidden fields
    $('#Rekap2Id').val(data.rekap2.id);
    $('#Rekap2IdRenja').val(data.rekap2.id_renja);
    $('#Rekap2Sasaran').val(data.rekap2.sasaran_strategis || '');
    $('#Rekap2Program').val(data.rekap2.program || '');
    
    // Update status button
    $('.year-btn').removeClass('has-data renja-only no-data');
    $('.year-btn[data-tahun="' + data.rekap2.tahun + '"]').addClass('has-data');
    $('.year-btn[data-tahun="' + data.rekap2.tahun + '"] .status-icon').text('✓');
    
    // Load akumulasi
    loadAkumulasi();
}

// ============================================================
// AKUMULASI
// ============================================================
window.loadAkumulasi = function() {
    if (!IdRekap2) {
        $('#akumulasiContainer').html('<div class="alert alert-warning">Data Rekap 2 belum dibuat</div>');
        return;
    }
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_get_by_tahun",
        type: "POST",
        data: {tahun: CurrentTahun},
        dataType: "json",
        success: function(res) {
            if (res.success) {
                var html = '<div class="akumulasi-box">';
                html += '<div class="item"><div class="label">Prioritas Nasional</div><div class="value">Rp ' + formatNumber(res.data.total_prioritas) + '</div></div>';
                html += '<div class="item"><div class="label">Sasaran Program</div><div class="value">Rp ' + formatNumber(res.data.total_sasaran) + '</div></div>';
                html += '<div class="item"><div class="label">Output Program</div><div class="value">Rp ' + formatNumber(res.data.total_output) + '</div></div>';
                html += '<div class="item"><div class="label">Kegiatan & Pendanaan</div><div class="value">Rp ' + formatNumber(res.data.total_kegiatan) + '</div></div>';
                html += '</div>';
                $('#akumulasiContainer').html(html);
            }
        }
    });
};

// ============================================================
// CRUD - REKAP 2
// ============================================================
$("#FormRekap2").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_save",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(res) {
            if (res.success) {
                alert(res.message);
                location.reload();
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Gagal menghubungi server: ' + error);
            console.log(xhr.responseText);
        }
    });
});

// ============================================================
// CRUD - PRIORITAS
// ============================================================
$("#FormPrioritas").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_prioritas_save",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(res) {
            if (res.success) {
                alert(res.message);
                location.reload();
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Gagal menghubungi server: ' + error);
            console.log(xhr.responseText);
        }
    });
});

$(document).on('click', '.edit-prioritas', function() {
    var btn = $(this);
    $('#PrioritasId').val(btn.data('id'));
    $('#PrioritasKode').val(btn.data('kode'));
    $('#PrioritasNama').val(btn.data('nama'));
    $('#PrioritasProgram').val(btn.data('program'));
    $('#PrioritasAlokasi').val(btn.data('alokasi'));
    $('#PrioritasTitle').text('Edit Prioritas Nasional');
    $('#ModalPrioritas').modal('show');
});

$(document).on('click', '.delete-prioritas', function() {
    if (confirm('Yakin hapus data prioritas ini?')) {
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Kementerian/rekap2_prioritas_delete",
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function(res) {
                if (res.success) { alert(res.message); location.reload(); }
                else { alert('Error: ' + res.message); }
            }
        });
    }
});

$('#ModalPrioritas').on('hidden.bs.modal', function() {
    $('#PrioritasId').val('');
    $('#PrioritasTitle').text('Tambah Prioritas Nasional');
});

// ============================================================
// CRUD - SASARAN PROGRAM
// ============================================================
$("#FormSasaran").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_sasaran_save",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(res) {
            if (res.success) {
                alert(res.message);
                location.reload();
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Gagal menghubungi server: ' + error);
            console.log(xhr.responseText);
        }
    });
});

$(document).on('click', '.edit-sasaran', function() {
    var btn = $(this);
    $('#SasaranId').val(btn.data('id'));
    $('#SasaranKode').val(btn.data('kode'));
    $('#SasaranNama').val(btn.data('nama'));
    $('#SasaranIndikator').val(btn.data('indikator'));
    $('#SasaranTarget').val(btn.data('target'));
    $('#SasaranAlokasi').val(btn.data('alokasi'));
    $('#SasaranTitle').text('Edit Sasaran Program');
    $('#ModalSasaran').modal('show');
});

$(document).on('click', '.delete-sasaran', function() {
    if (confirm('Yakin hapus data sasaran ini?')) {
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Kementerian/rekap2_sasaran_delete",
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function(res) {
                if (res.success) { alert(res.message); location.reload(); }
                else { alert('Error: ' + res.message); }
            }
        });
    }
});

$('#ModalSasaran').on('hidden.bs.modal', function() {
    $('#SasaranId').val('');
    $('#SasaranTitle').text('Tambah Sasaran Program');
});

// ============================================================
// CRUD - OUTPUT PROGRAM
// ============================================================
$("#FormOutput").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_output_save",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(res) {
            if (res.success) {
                alert(res.message);
                location.reload();
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Gagal menghubungi server: ' + error);
            console.log(xhr.responseText);
        }
    });
});

$(document).on('click', '.edit-output', function() {
    var btn = $(this);
    $('#OutputId').val(btn.data('id'));
    $('#OutputKode').val(btn.data('kode'));
    $('#OutputNama').val(btn.data('nama'));
    $('#OutputIndikator').val(btn.data('indikator'));
    $('#OutputAlokasi').val(btn.data('alokasi'));
    $('#ModalOutput').modal('show');
});

$(document).on('click', '.delete-output', function() {
    if (confirm('Yakin hapus data output ini?')) {
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Kementerian/rekap2_output_delete",
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function(res) {
                if (res.success) { alert(res.message); location.reload(); }
                else { alert('Error: ' + res.message); }
            }
        });
    }
});

// ============================================================
// CRUD - KEGIATAN
// ============================================================
$(document).on('input', '.sumber-dana-input', function() {
    updateTotalKegiatan();
});

function updateTotalKegiatan() {
    var total = 0;
    $('.sumber-dana-input').each(function() {
        var val = parseFloat($(this).val()) || 0;
        total += val;
    });
    var val2026 = parseFloat($('#Kegiatan2026').val()) || 0;
    var val2027 = parseFloat($('#Kegiatan2027').val()) || 0;
    var val2028 = parseFloat($('#Kegiatan2028').val()) || 0;
    total += val2026 + val2027 + val2028;
    $('#KegiatanTotal').val('Rp ' + total.toLocaleString('id-ID'));
}

$('#Kegiatan2026, #Kegiatan2027, #Kegiatan2028').on('input', function() {
    updateTotalKegiatan();
});

$("#FormKegiatan").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap2_kegiatan_save",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(res) {
            if (res.success) {
                alert(res.message);
                location.reload();
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Gagal menghubungi server: ' + error);
            console.log(xhr.responseText);
        }
    });
});

$(document).on('click', '.edit-kegiatan', function() {
    var btn = $(this);
    $('#KegiatanId').val(btn.data('id'));
    $('#KegiatanKode').val(btn.data('kode'));
    $('#KegiatanNama').val(btn.data('nama'));
    
    var sources = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
    sources.forEach(function(src) {
        var val = btn.data(src) || 0;
        $('#Kegiatan' + src.toUpperCase()).val(val);
    });
    
    $('#Kegiatan2026').val(btn.data('tahun_2026') || 0);
    $('#Kegiatan2027').val(btn.data('tahun_2027') || 0);
    $('#Kegiatan2028').val(btn.data('tahun_2028') || 0);
    
    updateTotalKegiatan();
    $('#ModalKegiatan').modal('show');
});

$(document).on('click', '.delete-kegiatan', function() {
    if (confirm('Yakin hapus data kegiatan ini?')) {
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Kementerian/rekap2_kegiatan_delete",
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function(res) {
                if (res.success) { alert(res.message); location.reload(); }
                else { alert('Error: ' + res.message); }
            }
        });
    }
});

$('#ModalKegiatan').on('hidden.bs.modal', function() {
    $('#KegiatanId').val('');
    $('.sumber-dana-input').val(0);
    $('#Kegiatan2026, #Kegiatan2027, #Kegiatan2028').val(0);
    updateTotalKegiatan();
});

// ============================================================
// DOCUMENT READY
// ============================================================
$(document).ready(function() {
    console.log('Rekap 2 - Document Ready');
    console.log('IdRekap2:', IdRekap2);
    console.log('CurrentTahun:', CurrentTahun);
    
    if (IdRekap2) {
        loadAkumulasi();
    }
});
</script>