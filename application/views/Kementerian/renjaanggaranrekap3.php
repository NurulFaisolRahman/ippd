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
        overflow-x: auto;
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
        white-space: nowrap;
    }
    .table-notika thead th.text-right { text-align: right; }
    .table-notika thead th.text-center { text-align: center; }
    .table-notika tbody td {
        padding: 9px 12px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
        font-size: 12px;
    }
    .table-notika tbody tr:hover { background: #f9f9f9; }
    .table-notika .text-right { text-align: right; }
    .table-notika .text-center { text-align: center; }
    .table-notika .total-row { background: #e8f0fe !important; font-weight: 600; }
    .table-notika .total-row td { border-top: 2px solid #4a90d9; }
    
    .dropdown-aksi {
        position: relative;
        display: inline-block;
    }
    .dropdown-aksi .btn-titik-tiga {
        background: transparent;
        border: none;
        padding: 4px 8px;
        border-radius: 4px;
        cursor: pointer;
        color: #718096;
        transition: all 0.2s ease;
        font-size: 16px;
        line-height: 1;
    }
    .dropdown-aksi .btn-titik-tiga:hover {
        background: #edf2f7;
        color: #2d3748;
    }
    .dropdown-aksi .btn-titik-tiga:focus { outline: none; }
    .dropdown-aksi .menu-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        min-width: 160px;
        background: white;
        border-radius: 6px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        border: 1px solid #edf2f7;
        padding: 4px 0;
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
        gap: 8px;
        padding: 6px 14px;
        color: #2d3748;
        font-size: 12px;
        transition: all 0.2s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-weight: 500;
    }
    .dropdown-aksi .item-dropdown:hover { background: #f7fafc; }
    .dropdown-aksi .item-dropdown i { width: 16px; font-size: 13px; color: #718096; }
    .dropdown-aksi .item-dropdown.text-danger { color: #dc3545; }
    .dropdown-aksi .item-dropdown.text-danger i { color: #dc3545; }
    .dropdown-aksi .item-dropdown.text-danger:hover { background: #fef2f2; }
    .dropdown-aksi .divider-dropdown {
        height: 1px;
        background: #edf2f7;
        margin: 4px 0;
    }
    
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
    .badge-notika-primary { background: #4a90d9; color: #fff; }
    
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
    .form-group-notika textarea.form-control { resize: vertical; min-height: 60px; }
    .form-group-notika select.form-control { appearance: auto; }
    
    .modal-notika .modal-content { border-radius: 6px; border: none; }
    .modal-notika .modal-header {
        border-bottom: 1px solid #e8e8e8;
        padding: 14px 20px;
        background: #f9f9f9;
        border-radius: 6px 6px 0 0;
    }
    .modal-notika .modal-header .modal-title { font-weight: 600; color: #222; font-size: 16px; }
    .modal-notika .modal-body { padding: 20px; max-height: 70vh; overflow-y: auto; }
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
    
    .lokasi-item {
        display: flex;
        gap: 10px;
        align-items: center;
        padding: 10px;
        background: #f9f9f9;
        border-radius: 4px;
        margin-bottom: 8px;
        border: 1px solid #e8e8e8;
        flex-wrap: wrap;
    }
    .lokasi-item .lokasi-provinsi { flex: 2; min-width: 120px; }
    .lokasi-item .lokasi-kabupaten { flex: 2; min-width: 120px; }
    .lokasi-item .btn-remove-lokasi {
        background: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 6px 10px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .lokasi-item .btn-remove-lokasi:hover { background: #c0392b; }
    .btn-add-lokasi {
        background: #4a90d9;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 6px 14px;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-add-lokasi:hover { background: #3a7bc8; }
    
    .lokasi-display { font-size: 11px; color: #666; }
    .lokasi-display .lokasi-tag {
        display: inline-block;
        background: #e8f0fe;
        padding: 2px 10px;
        border-radius: 12px;
        margin: 2px;
        font-size: 10px;
    }
    
    .toast-notif {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 20px;
        border-radius: 6px;
        z-index: 99999;
        display: none;
        font-weight: 500;
        max-width: 450px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        font-size: 14px;
    }
    .toast-notif.success { background: #4caf50; color: #fff; }
    .toast-notif.error { background: #f44336; color: #fff; }
    .toast-notif .close-toast {
        float: right;
        margin-left: 15px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        opacity: 0.8;
    }
    .toast-notif .close-toast:hover { opacity: 1; }
    
    .spinner-border-sm {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
        vertical-align: middle;
    }
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    
    @media (max-width: 768px) {
        .card-notika .card-header { flex-direction: column; align-items: flex-start; }
        .year-nav .year-btn { min-width: 36px; padding: 3px 6px; font-size: 12px; }
        .table-notika { font-size: 11px; }
        .table-notika thead th, .table-notika tbody td { padding: 5px 6px; }
        .modal-notika .modal-body { padding: 12px; }
        .lokasi-item { flex-direction: column; }
        .lokasi-item .lokasi-provinsi, .lokasi-item .lokasi-kabupaten { width: 100%; }
    }
    @media print {
        .btn-notika, .no-print, .dropdown-aksi { display: none !important; }
        .akumulasi-box { background: #4a90d9 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .card-notika { break-inside: avoid; }
    }
</style>

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
                            <a href="<?= base_url('Kementerian/renjaanggaranrekap3') ?>">Kementerian</a>
                            <span style="margin:0 5px;">/</span>
                        </li>
                        <li style="display:inline-block;">
                            <span class="bread-blk">Rekap 3 - Kegiatan K/L</span>
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

                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                <div class="alert-notika">
                    <div style="display:flex;flex-wrap:wrap;gap:16px;">
                        <div><strong>Kementerian :</strong> <?= htmlspecialchars($UserKementerianName ?? '-') ?></div>
                        <div><strong>Periode :</strong> <?= htmlspecialchars($UserPeriode ?? '-') ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px;">
                    <button class="btn-notika btn-notika-success" data-toggle="modal" data-target="#ModalRekap3">
                        <span>+</span> Buat/Edit Rekap 3
                    </button>
                    <?php if ($Rekap3): ?>
                    <button class="btn-notika btn-notika-outline" onclick="window.print()">
                        <span>⎙</span> Cetak
                    </button>
                    <?php endif; ?>
                </div>

                <div id="akumulasiContainer"></div>

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
                                <?php if ($Rekap3): ?>
                                <span class="badge-notika badge-notika-success">Data <?= $CurrentTahun ?></span>
                                <?php elseif ($IdRenja): ?>
                                <span class="badge-notika badge-notika-warning">Renja ada, Rekap 3 belum</span>
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

                <div id="loadingData" style="display:none;">
                    <div class="loading-state">
                        <div class="spinner"></div>
                        <p style="margin-top:12px;color:#888;font-weight:500;">Memuat data...</p>
                    </div>
                </div>

                <div id="contentData">
                    <?php if ($Rekap3): ?>
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Rekap 3 - Kegiatan K/L <span class="badge-notika badge-notika-info">Tahun <?= $CurrentTahun ?></span></div>
                            </div>
                            <div class="card-body">
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                                    <div>
                                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Program</div>
                                        <div style="color:#666;font-size:13px;"><?= nl2br(htmlspecialchars($Rekap3['program'] ?? '-')) ?></div>
                                    </div>
                                    <div>
                                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Sasaran Program</div>
                                        <div style="color:#666;font-size:13px;"><?= nl2br(htmlspecialchars($Rekap3['sasaran_program'] ?? '-')) ?></div>
                                    </div>
                                    <div>
                                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Kegiatan</div>
                                        <div style="color:#666;font-size:13px;"><?= nl2br(htmlspecialchars($Rekap3['kegiatan'] ?? '-')) ?></div>
                                    </div>
                                    <div>
                                        <div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Unit Organisasi (Eselon 2)</div>
                                        <div style="color:#666;font-size:13px;"><?= nl2br(htmlspecialchars($Rekap3['unit_organisasi'] ?? '-')) ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SASARAN KEGIATAN -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Sasaran Kegiatan / Indikator Kinerja Kegiatan (IKK)</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalSasaran">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table-notika" id="tabelSasaran">
                                    <thead>
                                        <tr>
                                            <th style="width:8%;">Kode</th>
                                            <th>Sasaran Kegiatan</th>
                                            <th>Indikator Kinerja</th>
                                            <th style="width:10%;text-align:center;">Target</th>
                                            <th style="width:15%;text-align:right;">Alokasi (Ribu)</th>
                                            <th style="width:8%;text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodySasaran">
                                        <?php 
                                        $total_sasaran = 0;
                                        foreach ($SasaranKegiatan as $s): 
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
                                        <?php if (empty($SasaranKegiatan)): ?>
                                        <tr id="emptySasaran"><td colspan="6" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data sasaran kegiatan</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="4" class="text-right">TOTAL</td>
                                            <td class="text-right" id="totalSasaran"><?= number_format($total_sasaran, 0, ',', '.') ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- RINCIAN KEGIATAN - TAMPILKAN NAMA WILAYAH -->
<div class="card-notika">
    <div class="card-header">
        <div class="card-title">Rincian Kegiatan - Pemetaan</div>
        <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalRincian">
            <span>+</span> Tambah
        </button>
    </div>
    <div class="card-body">
        <table class="table-notika" id="tabelRincian" style="font-size:11px;">
            <thead>
                <tr>
                    <th style="width:6%;">Kode</th>
                    <th>Sasaran Kegiatan</th>
                    <th>Klasifikasi Rincian Output</th>
                    <th>Rincian Output / Komponen</th>
                    <th style="width:20%;text-align:center;">Lokasi</th>
                    <th style="width:10%;text-align:right;">Alokasi</th>
                    <th style="width:6%;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbodyRincian">
                <?php 
                $total_rincian = 0;
                foreach ($Rincian as $r): 
                    $total_rincian += $r['alokasi'];
                    
                    // Tampilkan nama wilayah dari lokasi_wilayah_detail
                    $lokasi_display = '-';
                    if (!empty($r['lokasi_wilayah_detail']) && is_array($r['lokasi_wilayah_detail'])) {
                        $lokasi_parts = [];
                        foreach ($r['lokasi_wilayah_detail'] as $lok) {
                            $prov = $lok['provinsi'] ?? '';
                            $kab = $lok['kabupaten'] ?? '';
                            $display = $prov;
                            if (!empty($kab) && $kab != '') {
                                $display .= ' - ' . $kab;
                            }
                            $lokasi_parts[] = '<span class="lokasi-tag">' . htmlspecialchars($display) . '</span>';
                        }
                        $lokasi_display = implode(' ', $lokasi_parts);
                    }
                ?>
                <tr>
                    <td><span class="badge-notika badge-notika-info"><?= htmlspecialchars($r['kode']) ?></span></td>
                    <td><?= htmlspecialchars($r['sasaran_kegiatan'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($r['klasifikasi_rincian_output'] ?? '-') ?></td>
                    <td>
                        <strong><?= htmlspecialchars($r['rincian_output'] ?? '-') ?></strong>
                        <?php if ($r['komponen']): ?>
                        <br><small style="color:#888;"><?= htmlspecialchars($r['komponen']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="lokasi-display"><?= $lokasi_display ?></div>
                    </td>
                    <td class="text-right"><?= number_format($r['alokasi'], 0, ',', '.') ?></td>
                    <td class="text-center">
                        <div class="dropdown-aksi">
                            <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="menu-dropdown">
                                <button class="item-dropdown edit-rincian"
                                    data-id="<?= $r['id'] ?>"
                                    data-kode="<?= htmlspecialchars($r['kode']) ?>"
                                    data-sasaran="<?= htmlspecialchars($r['sasaran_kegiatan'] ?? '') ?>"
                                    data-klasifikasi="<?= htmlspecialchars($r['klasifikasi_rincian_output'] ?? '') ?>"
                                    data-rincian="<?= htmlspecialchars($r['rincian_output'] ?? '') ?>"
                                    data-komponen="<?= htmlspecialchars($r['komponen'] ?? '') ?>"
                                    data-lokasi="<?= htmlspecialchars($r['lokasi_wilayah'] ?? '') ?>"
                                    data-alokasi="<?= $r['alokasi'] ?>">
                                    <i class="fa fa-pencil"></i> Edit
                                </button>
                                <button class="item-dropdown text-danger delete-rincian" data-id="<?= $r['id'] ?>">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($Rincian)): ?>
                <tr id="emptyRincian"><td colspan="7" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data rincian kegiatan</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" class="text-right">TOTAL</td>
                    <td class="text-right" id="totalRincian"><?= number_format($total_rincian, 0, ',', '.') ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
                        <!-- PERHITUNGAN PENDANAAN -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Perhitungan Pendanaan (Tahun <?= $CurrentTahun ?> dan Prakiraan Maju)</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalPendanaan">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table-notika" id="tabelPendanaan" style="font-size:11px;">
                                    <thead>
                                        <tr>
                                            <th style="width:6%;">Kode</th>
                                            <th>Rincian Output</th>
                                            <th style="width:8%;text-align:center;">Volume</th>
                                            <th style="width:8%;text-align:center;">Satuan</th>
                                            <th style="width:10%;text-align:right;">Satuan Biaya</th>
                                            <th style="width:10%;text-align:right;">Alokasi <?= $CurrentTahun ?></th>
                                            <th colspan="3" style="text-align:center;">Prakiraan Kebutuhan</th>
                                            <th style="width:6%;text-align:center;">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th colspan="6"></th>
                                            <th style="text-align:center;font-size:10px;">2025</th>
                                            <th style="text-align:center;font-size:10px;">2026</th>
                                            <th style="text-align:center;font-size:10px;">2027</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyPendanaan">
                                        <?php 
                                        $total_pendanaan = 0;
                                        foreach ($Pendanaan as $p): 
                                            $total_pendanaan += $p['alokasi_2024'];
                                        ?>
                                        <tr>
                                            <td><span class="badge-notika badge-notika-info"><?= htmlspecialchars($p['kode']) ?></span></td>
                                            <td>
                                                <strong><?= htmlspecialchars($p['rincian_output'] ?? '-') ?></strong>
                                                <?php if ($p['komponen']): ?>
                                                <br><small style="color:#888;"><?= htmlspecialchars($p['komponen']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?= htmlspecialchars($p['volume_target'] ?? '-') ?></td>
                                            <td class="text-center"><?= htmlspecialchars($p['satuan'] ?? '-') ?></td>
                                            <td class="text-right"><?= number_format($p['satuan_biaya'] ?? 0, 0, ',', '.') ?></td>
                                            <td class="text-right"><?= number_format($p['alokasi_2024'] ?? 0, 0, ',', '.') ?></td>
                                            <td class="text-center"><?= htmlspecialchars($p['target_2025'] ?? '-') ?></td>
                                            <td class="text-center"><?= htmlspecialchars($p['target_2026'] ?? '-') ?></td>
                                            <td class="text-center"><?= htmlspecialchars($p['target_2027'] ?? '-') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown-aksi">
                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="menu-dropdown">
                                                        <button class="item-dropdown edit-pendanaan"
                                                            data-id="<?= $p['id'] ?>"
                                                            data-kode="<?= htmlspecialchars($p['kode']) ?>"
                                                            data-sasaran="<?= htmlspecialchars($p['sasaran_kegiatan'] ?? '') ?>"
                                                            data-klasifikasi="<?= htmlspecialchars($p['klasifikasi_rincian_output'] ?? '') ?>"
                                                            data-rincian="<?= htmlspecialchars($p['rincian_output'] ?? '') ?>"
                                                            data-komponen="<?= htmlspecialchars($p['komponen'] ?? '') ?>"
                                                            data-volume="<?= htmlspecialchars($p['volume_target'] ?? '') ?>"
                                                            data-satuan="<?= htmlspecialchars($p['satuan'] ?? '') ?>"
                                                            data-satuan_biaya="<?= $p['satuan_biaya'] ?? 0 ?>"
                                                            data-alokasi_2024="<?= $p['alokasi_2024'] ?? 0 ?>"
                                                            data-target_2025="<?= htmlspecialchars($p['target_2025'] ?? '') ?>"
                                                            data-target_2026="<?= htmlspecialchars($p['target_2026'] ?? '') ?>"
                                                            data-target_2027="<?= htmlspecialchars($p['target_2027'] ?? '') ?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </button>
                                                        <button class="item-dropdown text-danger delete-pendanaan" data-id="<?= $p['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($Pendanaan)): ?>
                                        <tr id="emptyPendanaan"><td colspan="10" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data perhitungan pendanaan</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="5" class="text-right">TOTAL</td>
                                            <td class="text-right" id="totalPendanaan"><?= number_format($total_pendanaan, 0, ',', '.') ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- SUMBER PENDANAAN -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Sumber Pendanaan</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalSumberDana">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table-notika" id="tabelSumberDana" style="font-size:11px;">
                                    <thead>
                                        <tr>
                                            <th style="width:6%;">Kode</th>
                                            <th>Rincian Output / Komponen</th>
                                            <th style="width:8%;text-align:center;">Jenis</th>
                                            <th style="width:8%;text-align:right;">RPP</th>
                                            <th style="width:8%;text-align:right;">NBP</th>
                                            <th style="width:8%;text-align:right;">BLU</th>
                                            <th style="width:8%;text-align:right;">LN</th>
                                            <th style="width:8%;text-align:right;">RM</th>
                                            <th style="width:8%;text-align:right;">PPDN</th>
                                            <th style="width:8%;text-align:right;">HIBAH</th>
                                            <th style="width:8%;text-align:right;">PHBS</th>
                                            <th style="width:8%;text-align:right;">SNH</th>
                                            <th style="width:8%;text-align:right;">NT</th>
                                            <th style="width:10%;text-align:right;">Total</th>
                                            <th style="width:6%;text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodySumberDana">
                                        <?php 
                                        $total_sumber_dana = 0;
                                        $sources = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
                                        foreach ($SumberDana as $sd): 
                                            $total_sumber_dana += $sd['total'];
                                        ?>
                                        <tr>
                                            <td><span class="badge-notika badge-notika-info"><?= htmlspecialchars($sd['kode']) ?></span></td>
                                            <td>
                                                <strong><?= htmlspecialchars($sd['rincian_output'] ?? '-') ?></strong>
                                                <?php if ($sd['komponen']): ?>
                                                <br><small style="color:#888;"><?= htmlspecialchars($sd['komponen']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><span class="badge-notika badge-notika-primary"><?= htmlspecialchars($sd['jenis_komponen'] ?? '-') ?></span></td>
                                            <?php foreach ($sources as $src): ?>
                                            <td class="text-right"><?= number_format($sd[$src] ?? 0, 0, ',', '.') ?></td>
                                            <?php endforeach; ?>
                                            <td class="text-right" style="font-weight:600;color:#4a90d9;"><?= number_format($sd['total'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown-aksi">
                                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="menu-dropdown">
                                                        <button class="item-dropdown edit-sumber-dana"
                                                            data-id="<?= $sd['id'] ?>"
                                                            data-kode="<?= htmlspecialchars($sd['kode']) ?>"
                                                            data-sasaran="<?= htmlspecialchars($sd['sasaran_kegiatan'] ?? '') ?>"
                                                            data-klasifikasi="<?= htmlspecialchars($sd['klasifikasi_rincian_output'] ?? '') ?>"
                                                            data-rincian="<?= htmlspecialchars($sd['rincian_output'] ?? '') ?>"
                                                            data-komponen="<?= htmlspecialchars($sd['komponen'] ?? '') ?>"
                                                            data-jenis="<?= htmlspecialchars($sd['jenis_komponen'] ?? '') ?>"
                                                            <?php foreach ($sources as $src): ?>
                                                            data-<?= $src ?>="<?= $sd[$src] ?? 0 ?>"
                                                            <?php endforeach; ?>>
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </button>
                                                        <button class="item-dropdown text-danger delete-sumber-dana" data-id="<?= $sd['id'] ?>">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($SumberDana)): ?>
                                        <tr id="emptySumberDana"><td colspan="15" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data sumber pendanaan</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="3" class="text-right">TOTAL</td>
                                            <?php 
                                            $totals = array_fill_keys($sources, 0);
                                            foreach ($SumberDana as $sd) {
                                                foreach ($sources as $src) {
                                                    $totals[$src] += $sd[$src] ?? 0;
                                                }
                                            }
                                            foreach ($sources as $src): 
                                            ?>
                                            <td class="text-right"><?= number_format($totals[$src], 0, ',', '.') ?></td>
                                            <?php endforeach; ?>
                                            <td class="text-right" id="totalSumberDana" style="font-weight:700;color:#4a90d9;font-size:14px;">
                                                <?= number_format($total_sumber_dana, 0, ',', '.') ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- REKAPITULASI AKHIR -->
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
                                        <div class="rekap-label">Sasaran Kegiatan</div>
                                        <div class="rekap-value" id="rekapSasaran">Rp <?= number_format($total_sasaran, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card">
                                        <div class="rekap-label">Rincian Kegiatan</div>
                                        <div class="rekap-value" id="rekapRincian">Rp <?= number_format($total_rincian, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card">
                                        <div class="rekap-label">Perhitungan Pendanaan</div>
                                        <div class="rekap-value" id="rekapPendanaan">Rp <?= number_format($total_pendanaan, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card rekap-highlight">
                                        <div class="rekap-label">Total Sumber Dana</div>
                                        <div class="rekap-value" id="rekapSumberDana">Rp <?= number_format($total_sumber_dana, 0, ',', '.') ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($IdRenja): ?>
                        <div class="card-notika">
                            <div class="card-body">
                                <div class="empty-state">
                                    <div class="empty-icon">📋</div>
                                    <h4>Data Rekap 3 Belum Dibuat</h4>
                                    <p>Renja untuk tahun <strong><?= $CurrentTahun ?></strong> sudah ada, namun Rekap 3 belum diisi.</p>
                                    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                                        <button class="btn-notika btn-notika-success" onclick="createRekap3()">
                                            <span>+</span> Buat Rekap 3
                                        </button>
                                        <button class="btn-notika btn-notika-primary" data-toggle="modal" data-target="#ModalRekap3">
                                            <span>✎</span> Isi Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card-notika">
                            <div class="card-body">
                                <div class="empty-state">
                                    <div class="empty-icon">📄</div>
                                    <h4>Belum Ada Data</h4>
                                    <p>Untuk tahun <strong><?= $CurrentTahun ?></strong>, belum ada data Renja dan Rekap 3.</p>
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

<!-- Modal Rekap 3 -->
<div class="modal fade modal-notika" id="ModalRekap3" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Rekap 3 - Kegiatan K/L</h4>
            </div>
            <div class="modal-body">
                <form id="FormRekap3">
                    <input type="hidden" name="id" id="Rekap3Id" value="<?= $Rekap3['id'] ?? '' ?>">
                    <input type="hidden" name="id_renja" id="Rekap3IdRenja" value="<?= $IdRenja ?? '' ?>">
                    <input type="hidden" name="tahun" id="Rekap3Tahun" value="<?= $CurrentTahun ?>">
                    
                    <div class="form-group-notika">
                        <label>Program</label>
                        <input type="text" class="form-control" name="program" id="Rekap3Program" value="<?= htmlspecialchars($Rekap3['program'] ?? '') ?>" placeholder="Contoh: CL - Program Koordinasi Pelaksanaan Kebijakan">
                    </div>
                    <div class="form-group-notika">
                        <label>Sasaran Program</label>
                        <input type="text" class="form-control" name="sasaran_program" id="Rekap3SasaranProgram" value="<?= htmlspecialchars($Rekap3['sasaran_program'] ?? '') ?>" placeholder="Contoh: 08 - Terwujudnya Kebijakan Bidang Kerja sama Ekonomi Internasional">
                    </div>
                    <div class="form-group-notika">
                        <label>Kegiatan</label>
                        <input type="text" class="form-control" name="kegiatan" id="Rekap3Kegiatan" value="<?= htmlspecialchars($Rekap3['kegiatan'] ?? '') ?>" placeholder="Contoh: 2513 - Koordinasi Kebijakan Kerja Sama Ekonomi Multilateral">
                    </div>
                    <div class="form-group-notika">
                        <label>Unit Organisasi (Eselon 2)</label>
                        <input type="text" class="form-control" name="unit_organisasi" id="Rekap3Unit" value="<?= htmlspecialchars($Rekap3['unit_organisasi'] ?? '') ?>" placeholder="Contoh: 22 - Asdep Kerjasama Ekonomi Multilateral">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-notika btn-notika-success" form="FormRekap3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sasaran Kegiatan -->
<div class="modal fade modal-notika" id="ModalSasaran" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="SasaranTitle">Tambah Sasaran Kegiatan</h4>
            </div>
            <div class="modal-body">
                <form id="FormSasaran">
                    <input type="hidden" name="id" id="SasaranId">
                    <input type="hidden" name="id_rekap3" id="SasaranIdRekap3" value="<?= $Rekap3['id'] ?? '' ?>">
                    <div class="form-group-notika">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="SasaranKode" required maxlength="20" placeholder="Contoh: 01, 01.01">
                    </div>
                    <div class="form-group-notika">
                        <label>Sasaran Kegiatan</label>
                        <input type="text" class="form-control" name="nama_sasaran" id="SasaranNama" required placeholder="Contoh: Terwujudnya Kebijakan di Bidang...">
                    </div>
                    <div class="form-group-notika">
                        <label>Indikator Kinerja Kegiatan (IKK)</label>
                        <input type="text" class="form-control" name="indikator_kinerja" id="SasaranIndikator" placeholder="Contoh: Jumlah Kesepakatan dalam Forum...">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="form-group-notika">
                            <label>Target</label>
                            <input type="text" class="form-control" name="target" id="SasaranTarget" placeholder="Contoh: 5, 75%">
                        </div>
                        <div class="form-group-notika">
                            <label>Alokasi (Ribu Rupiah)</label>
                            <input type="number" class="form-control" name="alokasi" id="SasaranAlokasi" value="0" step="1000">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-notika btn-notika-success" form="FormSasaran">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rincian Kegiatan -->
<div class="modal fade modal-notika" id="ModalRincian" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="RincianTitle">Tambah Rincian Kegiatan</h4>
            </div>
            <div class="modal-body">
                <form id="FormRincian">
                    <input type="hidden" name="id" id="RincianId">
                    <input type="hidden" name="id_rekap3" id="RincianIdRekap3" value="<?= $Rekap3['id'] ?? '' ?>">
                    
                    <div class="form-group-notika">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="RincianKode" required maxlength="50" placeholder="Contoh: 01, 01.ABA, 01.ABA.001">
                    </div>
                    <div class="form-group-notika">
                        <label>Sasaran Kegiatan</label>
                        <input type="text" class="form-control" name="sasaran_kegiatan" id="RincianSasaran" placeholder="Contoh: Terwujudnya Kebijakan...">
                    </div>
                    <div class="form-group-notika">
                        <label>Klasifikasi Rincian Output</label>
                        <input type="text" class="form-control" name="klasifikasi_rincian_output" id="RincianKlasifikasi" placeholder="Contoh: Kebijakan Bidang Ekonomi dan Keuangan">
                    </div>
                    <div class="form-group-notika">
                        <label>Rincian Output</label>
                        <input type="text" class="form-control" name="rincian_output" id="RincianOutput" placeholder="Contoh: Rekomendasi Kebijakan Kerja Sama Ekonomi">
                    </div>
                    <div class="form-group-notika">
                        <label>Komponen</label>
                        <input type="text" class="form-control" name="komponen" id="RincianKomponen" placeholder="Contoh: 51 - Persiapan Kegiatan">
                    </div>
                    
                    <!-- LOKASI WILAYAH - DINAMIS -->
                    <div class="form-group-notika">
                        <label>Lokasi Wilayah</label>
                        <div id="lokasiContainer">
                            <!-- Lokasi akan ditambahkan di sini -->
                        </div>
                        <button type="button" class="btn-add-lokasi" onclick="tambahLokasi()">
                            <span>+</span> Tambah Lokasi
                        </button>
                    </div>
                    
                    <div class="form-group-notika">
                        <label>Alokasi (Ribu Rupiah)</label>
                        <input type="number" class="form-control" name="alokasi" id="RincianAlokasi" value="0" step="1000">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-notika btn-notika-success" form="FormRincian" id="btnSimpanRincian">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Perhitungan Pendanaan -->
<div class="modal fade modal-notika" id="ModalPendanaan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Perhitungan Pendanaan</h4>
            </div>
            <div class="modal-body">
                <form id="FormPendanaan">
                    <input type="hidden" name="id" id="PendanaanId">
                    <input type="hidden" name="id_rekap3" id="PendanaanIdRekap3" value="<?= $Rekap3['id'] ?? '' ?>">
                    <div class="form-group-notika">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="PendanaanKode" required maxlength="50" placeholder="Contoh: 01, 01.ABA">
                    </div>
                    <div class="form-group-notika">
                        <label>Sasaran Kegiatan</label>
                        <input type="text" class="form-control" name="sasaran_kegiatan" id="PendanaanSasaran" placeholder="Contoh: Terwujudnya Kebijakan...">
                    </div>
                    <div class="form-group-notika">
                        <label>Klasifikasi Rincian Output</label>
                        <input type="text" class="form-control" name="klasifikasi_rincian_output" id="PendanaanKlasifikasi" placeholder="Contoh: Kebijakan Bidang Ekonomi dan Keuangan">
                    </div>
                    <div class="form-group-notika">
                        <label>Rincian Output / Komponen</label>
                        <input type="text" class="form-control" name="rincian_output" id="PendanaanRincian" placeholder="Contoh: Rekomendasi Kebijakan...">
                    </div>
                    <div class="form-group-notika">
                        <label>Komponen</label>
                        <input type="text" class="form-control" name="komponen" id="PendanaanKomponen" placeholder="Contoh: 51 - Persiapan Kegiatan">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                        <div class="form-group-notika">
                            <label>Volume / Target</label>
                            <input type="text" class="form-control" name="volume_target" id="PendanaanVolume" placeholder="Contoh: 2, 1,0">
                        </div>
                        <div class="form-group-notika">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan" id="PendanaanSatuan" placeholder="Contoh: Kegiatan, Rekomendasi">
                        </div>
                        <div class="form-group-notika">
                            <label>Satuan Biaya</label>
                            <input type="number" class="form-control" name="satuan_biaya" id="PendanaanSatuanBiaya" value="0" step="1000">
                        </div>
                    </div>
                    <div class="form-group-notika">
                        <label>Alokasi <?= $CurrentTahun ?> (Ribu Rupiah)</label>
                        <input type="number" class="form-control" name="alokasi_2024" id="PendanaanAlokasi" value="0" step="1000">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                        <div class="form-group-notika">
                            <label>Target 2025</label>
                            <input type="text" class="form-control" name="target_2025" id="PendanaanTarget2025" placeholder="Contoh: 2, 1,0">
                        </div>
                        <div class="form-group-notika">
                            <label>Target 2026</label>
                            <input type="text" class="form-control" name="target_2026" id="PendanaanTarget2026" placeholder="Contoh: 2, 1,0">
                        </div>
                        <div class="form-group-notika">
                            <label>Target 2027</label>
                            <input type="text" class="form-control" name="target_2027" id="PendanaanTarget2027" placeholder="Contoh: 2, 1,0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-notika btn-notika-success" form="FormPendanaan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sumber Dana -->
<div class="modal fade modal-notika" id="ModalSumberDana" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Sumber Pendanaan</h4>
            </div>
            <div class="modal-body">
                <form id="FormSumberDana">
                    <input type="hidden" name="id" id="SumberDanaId">
                    <input type="hidden" name="id_rekap3" id="SumberDanaIdRekap3" value="<?= $Rekap3['id'] ?? '' ?>">
                    <div class="form-group-notika">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="SumberDanaKode" required maxlength="50" placeholder="Contoh: 01, 01.ABA">
                    </div>
                    <div class="form-group-notika">
                        <label>Sasaran Kegiatan</label>
                        <input type="text" class="form-control" name="sasaran_kegiatan" id="SumberDanaSasaran" placeholder="Contoh: Terwujudnya Kebijakan...">
                    </div>
                    <div class="form-group-notika">
                        <label>Klasifikasi Rincian Output</label>
                        <input type="text" class="form-control" name="klasifikasi_rincian_output" id="SumberDanaKlasifikasi" placeholder="Contoh: Kebijakan Bidang Ekonomi dan Keuangan">
                    </div>
                    <div class="form-group-notika">
                        <label>Rincian Output / Komponen</label>
                        <input type="text" class="form-control" name="rincian_output" id="SumberDanaRincian" placeholder="Contoh: Rekomendasi Kebijakan...">
                    </div>
                    <div class="form-group-notika">
                        <label>Komponen</label>
                        <input type="text" class="form-control" name="komponen" id="SumberDanaKomponen" placeholder="Contoh: 51 - Persiapan Kegiatan">
                    </div>
                    <div class="form-group-notika">
                        <label>Jenis Komponen</label>
                        <select class="form-control" name="jenis_komponen" id="SumberDanaJenis">
                            <option value="">-- Pilih --</option>
                            <option value="Utama">Utama</option>
                            <option value="Pendukung">Pendukung</option>
                        </select>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr;gap:8px;margin-top:8px;">
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">RPP</label>
                            <input type="number" class="form-control sumber-dana-input" name="rpp" id="SumberDanaRPP" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">NBP</label>
                            <input type="number" class="form-control sumber-dana-input" name="nbp" id="SumberDanaNBP" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">BLU</label>
                            <input type="number" class="form-control sumber-dana-input" name="blu" id="SumberDanaBLU" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">LN</label>
                            <input type="number" class="form-control sumber-dana-input" name="ln" id="SumberDanaLN" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">RM</label>
                            <input type="number" class="form-control sumber-dana-input" name="rm" id="SumberDanaRM" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">PPDN</label>
                            <input type="number" class="form-control sumber-dana-input" name="ppdn" id="SumberDanaPPDN" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">HIBAH</label>
                            <input type="number" class="form-control sumber-dana-input" name="hibah" id="SumberDanaHIBAH" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">PHBS</label>
                            <input type="number" class="form-control sumber-dana-input" name="phbs" id="SumberDanaPHBS" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">SNH</label>
                            <input type="number" class="form-control sumber-dana-input" name="snh" id="SumberDanaSNH" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                        <div class="form-group-notika" style="margin-bottom:0;">
                            <label style="font-size:11px;color:#888;">NT</label>
                            <input type="number" class="form-control sumber-dana-input" name="nt" id="SumberDanaNT" value="0" step="1000" style="padding:4px 8px;font-size:12px;">
                        </div>
                    </div>
                    <div style="background:#e8f0fe;padding:12px 16px;border-radius:4px;margin-top:12px;">
                        <label style="font-weight:600;color:#444;font-size:13px;display:block;margin-bottom:2px;">TOTAL</label>
                        <input type="text" class="form-control" id="SumberDanaTotal" readonly style="font-weight:700;font-size:16px;background:#fff;border-color:#4a90d9;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-notika btn-notika-success" form="FormSumberDana">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var IdRekap3 = <?= json_encode($Rekap3['id'] ?? null) ?>;
var CurrentTahun = <?= json_encode($CurrentTahun) ?>;
var IdRenja = <?= json_encode($IdRenja ?? null) ?>;

// ============================================================
// FUNGSI TOAST
// ============================================================
function showToast(message, type) {
    var toast = document.getElementById('toastNotif');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toastNotif';
        toast.className = 'toast-notif';
        toast.innerHTML = '<span class="close-toast" onclick="this.parentElement.style.display=\'none\'">&times;</span><span id="toastMessage"></span>';
        document.body.appendChild(toast);
    }
    
    toast.className = 'toast-notif ' + type;
    document.getElementById('toastMessage').textContent = message;
    toast.style.display = 'block';
    
    clearTimeout(window.toastTimeout);
    window.toastTimeout = setTimeout(function() {
        toast.style.display = 'none';
    }, 4000);
}

// ============================================================
// FUNGSI TOGGLE DROPDOWN
// ============================================================
function toggleDropdown(button) {
    event.stopPropagation();
    var menu = button.nextElementSibling;
    var isOpen = menu.classList.contains('show');
    
    document.querySelectorAll('.menu-dropdown.show').forEach(function(m) {
        if (m !== menu) m.classList.remove('show');
    });
    
    menu.classList.toggle('show');
}

$(document).on('click', function(e) {
    if (!$(e.target).closest('.dropdown-aksi').length) {
        $('.menu-dropdown.show').removeClass('show');
    }
});

// ============================================================
// FUNGSI LOKASI DINAMIS
// ============================================================
var lokasiIndex = 0;

function tambahLokasi(provinsiKode, kabupatenKode) {
    var container = document.getElementById('lokasiContainer');
    var index = lokasiIndex++;
    
    var div = document.createElement('div');
    div.className = 'lokasi-item';
    div.id = 'lokasi-' + index;
    
    var provinsiOptions = '';
    <?php foreach ($WilayahList as $w): if (strpos($w['Kode'], '.') === false): ?>
    provinsiOptions += '<option value="<?= htmlspecialchars($w['Kode']) ?>"' + (provinsiKode == '<?= htmlspecialchars($w['Kode']) ?>' ? ' selected' : '') + '><?= htmlspecialchars($w['Nama']) ?></option>';
    <?php endif; endforeach; ?>
    
    div.innerHTML = `
        <div class="lokasi-provinsi">
            <select class="form-control lokasi-provinsi-select" id="provinsi-${index}" onchange="loadKabupatenDinamis(${index})">
                <option value="">-- Pilih Provinsi --</option>
                ${provinsiOptions}
            </select>
        </div>
        <div class="lokasi-kabupaten">
            <select class="form-control lokasi-kabupaten-select" id="kabupaten-${index}">
                <option value="">-- Pilih Kab/Kota --</option>
            </select>
        </div>
        <button type="button" class="btn-remove-lokasi" onclick="hapusLokasi(${index})" title="Hapus Lokasi">
            <span>×</span>
        </button>
    `;
    
    container.appendChild(div);
    
    if (provinsiKode && provinsiKode !== '') {
        document.getElementById('provinsi-' + index).value = provinsiKode;
        setTimeout(function() {
            loadKabupatenDinamis(index, kabupatenKode || '');
        }, 200);
    }
}

function hapusLokasi(index) {
    var el = document.getElementById('lokasi-' + index);
    if (el) el.remove();
}

function loadKabupatenDinamis(index, kabupatenKode) {
    var provinsiSelect = document.getElementById('provinsi-' + index);
    var provinsiKode = provinsiSelect.value;
    var kabupatenSelect = document.getElementById('kabupaten-' + index);
    
    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
    if (!provinsiKode || provinsiKode === '') return;
    
    kabupatenSelect.innerHTML = '<option value="">Memuat data...</option>';
    
    $.ajax({
        url: BaseURL + "Kementerian/get_kabupaten_by_provinsi",
        type: "POST",
        data: { provinsi_kode: provinsiKode },
        dataType: "json",
        timeout: 30000,
        success: function(res) {
            kabupatenSelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
            if (res.success && res.data && res.data.length > 0) {
                var found = false;
                $.each(res.data, function(idx, item) {
                    var selected = '';
                    if (kabupatenKode && item.Kode == kabupatenKode) {
                        selected = ' selected';
                        found = true;
                    }
                    kabupatenSelect.innerHTML += '<option value="' + item.Kode + '"' + selected + '>' + item.Nama + '</option>';
                });
                if (!found && kabupatenKode && kabupatenKode !== '') {
                    kabupatenSelect.innerHTML += '<option value="' + kabupatenKode + '" selected>' + kabupatenKode + '</option>';
                }
            } else {
                if (kabupatenKode && kabupatenKode !== '') {
                    kabupatenSelect.innerHTML = '<option value="' + kabupatenKode + '" selected>' + kabupatenKode + '</option>';
                } else {
                    kabupatenSelect.innerHTML = '<option value="">Tidak ada data kabupaten</option>';
                }
            }
        },
        error: function() {
            if (kabupatenKode && kabupatenKode !== '') {
                kabupatenSelect.innerHTML = '<option value="' + kabupatenKode + '" selected>' + kabupatenKode + '</option>';
            } else {
                kabupatenSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            }
        }
    });
}

// ============================================================
// CREATE REKAP 3
// ============================================================
function createRekap3() {
    if (!IdRenja) {
        showToast('ID Renja tidak ditemukan', 'error');
        return;
    }
    if (!confirm('Buat data Rekap 3 untuk tahun ' + CurrentTahun + '?')) return;
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_create",
        type: "POST",
        data: {id_renja: IdRenja, tahun: CurrentTahun},
        dataType: "json",
        timeout: 30000,
        success: function(res) {
            if (res.success) {
                showToast(res.message, 'success');
                setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
            } else {
                showToast(res.message || 'Error', 'error');
            }
        },
        error: function() {
            showToast('Gagal menghubungi server', 'error');
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
        html += '<p>Untuk tahun <strong>' + tahun + '</strong>, belum ada data Renja dan Rekap 3.</p>';
        html += '<a href="' + BaseURL + 'Kementerian/renjaanggaranrekap1?tahun=' + tahun + '" class="btn-notika btn-notika-primary">';
        html += '<span>+</span> Buat Renja di Rekap 1</a>';
        html += '</div></div></div>';
        $('#contentData').html(html);
        $('#contentData').show();
        return;
    }
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_get_by_tahun",
        type: "POST",
        data: {tahun: tahun},
        dataType: "json",
        timeout: 30000,
        success: function(res) {
            $('#loadingData').hide();
            if (res.success) {
                CurrentTahun = tahun;
                IdRekap3 = res.data.rekap3.id;
                renderData(res.data);
                $('#contentData').show();
            } else {
                if (res.can_create && res.id_renja) {
                    IdRenja = res.id_renja;
                    var html = '<div class="card-notika"><div class="card-body"><div class="empty-state">';
                    html += '<div class="empty-icon">📋</div>';
                    html += '<h4>' + (res.message || 'Data Rekap 3 Belum Dibuat') + '</h4>';
                    html += '<div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">';
                    html += '<button class="btn-notika btn-notika-success" onclick="createRekap3()">';
                    html += '<span>+</span> Buat Rekap 3</button>';
                    html += '<button class="btn-notika btn-notika-primary" data-toggle="modal" data-target="#ModalRekap3">';
                    html += '<span>✎</span> Isi Data</button>';
                    html += '</div></div></div></div>';
                    $('#contentData').html(html);
                } else {
                    $('#contentData').html('<div class="alert alert-danger">' + (res.message || 'Error loading data') + '</div>');
                }
                $('#contentData').show();
            }
        },
        error: function() {
            $('#loadingData').hide();
            $('#contentData').html('<div class="alert alert-danger">Gagal memuat data</div>');
            $('#contentData').show();
        }
    });
}

// ============================================================
// RENDER DATA
// ============================================================
function renderData(data) {
    $('#Rekap3Id').val(data.rekap3.id);
    $('#Rekap3IdRenja').val(data.rekap3.id_renja);
    $('#Rekap3Program').val(data.rekap3.program || '');
    $('#Rekap3SasaranProgram').val(data.rekap3.sasaran_program || '');
    $('#Rekap3Kegiatan').val(data.rekap3.kegiatan || '');
    $('#Rekap3Unit').val(data.rekap3.unit_organisasi || '');
    
    $('.year-btn').removeClass('has-data renja-only no-data');
    $('.year-btn[data-tahun="' + data.rekap3.tahun + '"]').addClass('has-data');
    $('.year-btn[data-tahun="' + data.rekap3.tahun + '"] .status-icon').text('✓');
    
    loadContentData(data);
    loadAkumulasi();
}

// ============================================================
// LOAD CONTENT DATA
// ============================================================
function loadContentData(data) {
    var html = '';
    
    // Header Rekap 3
    html += '<div class="card-notika">';
    html += '<div class="card-header"><div class="card-title">Rekap 3 - Kegiatan K/L <span class="badge-notika badge-notika-info">Tahun ' + data.rekap3.tahun + '</span></div></div>';
    html += '<div class="card-body">';
    html += '<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">';
    html += '<div><div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Program</div><div style="color:#666;font-size:13px;">' + (data.rekap3.program || '-') + '</div></div>';
    html += '<div><div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Sasaran Program</div><div style="color:#666;font-size:13px;">' + (data.rekap3.sasaran_program || '-') + '</div></div>';
    html += '<div><div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Kegiatan</div><div style="color:#666;font-size:13px;">' + (data.rekap3.kegiatan || '-') + '</div></div>';
    html += '<div><div style="font-weight:600;color:#444;font-size:13px;margin-bottom:2px;">Unit Organisasi (Eselon 2)</div><div style="color:#666;font-size:13px;">' + (data.rekap3.unit_organisasi || '-') + '</div></div>';
    html += '</div></div></div>';
    
    // Sasaran Kegiatan
    html += '<div class="card-notika">';
    html += '<div class="card-header"><div class="card-title">Sasaran Kegiatan / Indikator Kinerja Kegiatan (IKK)</div>';
    html += '<button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalSasaran"><span>+</span> Tambah</button></div>';
    html += '<div class="card-body"><table class="table-notika" id="tabelSasaran"><thead><tr>';
    html += '<th style="width:8%;">Kode</th><th>Sasaran Kegiatan</th><th>Indikator Kinerja</th>';
    html += '<th style="width:10%;text-align:center;">Target</th>';
    html += '<th style="width:15%;text-align:right;">Alokasi (Ribu)</th>';
    html += '<th style="width:8%;text-align:center;">Aksi</th></tr></thead><tbody id="tbodySasaran">';
    
    var totalSasaran = 0;
    if (data.sasaran && data.sasaran.length > 0) {
        $.each(data.sasaran, function(i, s) {
            totalSasaran += parseFloat(s.alokasi) || 0;
            html += '<tr>';
            html += '<td><span class="badge-notika badge-notika-info">' + s.kode + '</span></td>';
            html += '<td>' + s.nama_sasaran + '</td>';
            html += '<td>' + (s.indikator_kinerja || '-') + '</td>';
            html += '<td class="text-center">' + (s.target || '-') + '</td>';
            html += '<td class="text-right">' + formatNumber(s.alokasi) + '</td>';
            html += '<td class="text-center"><div class="dropdown-aksi">';
            html += '<button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)"><i class="fa fa-ellipsis-v"></i></button>';
            html += '<div class="menu-dropdown">';
            html += '<button class="item-dropdown edit-sasaran" data-id="' + s.id + '" data-kode="' + s.kode + '" data-nama="' + s.nama_sasaran + '" data-indikator="' + (s.indikator_kinerja || '') + '" data-target="' + (s.target || '') + '" data-alokasi="' + s.alokasi + '"><i class="fa fa-pencil"></i> Edit</button>';
            html += '<button class="item-dropdown text-danger delete-sasaran" data-id="' + s.id + '"><i class="fa fa-trash"></i> Hapus</button>';
            html += '</div></div></td></tr>';
        });
    } else {
        html += '<tr><td colspan="6" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data sasaran kegiatan</td></tr>';
    }
    html += '</tbody><tfoot><tr class="total-row">';
    html += '<td colspan="4" class="text-right">TOTAL</td>';
    html += '<td class="text-right">' + formatNumber(totalSasaran) + '</td><td></td></tr></tfoot></table></div></div>';
    
    // Rincian Kegiatan - Tampilkan NAMA Wilayah
    html += '<div class="card-notika">';
    html += '<div class="card-header"><div class="card-title">Rincian Kegiatan - Pemetaan</div>';
    html += '<button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalRincian"><span>+</span> Tambah</button></div>';
    html += '<div class="card-body"><table class="table-notika" style="font-size:11px;" id="tabelRincian"><thead><tr>';
    html += '<th style="width:6%;">Kode</th><th>Sasaran Kegiatan</th><th>Klasifikasi Rincian Output</th>';
    html += '<th>Rincian Output / Komponen</th>';
    html += '<th style="width:20%;text-align:center;">Lokasi</th>';
    html += '<th style="width:10%;text-align:right;">Alokasi</th>';
    html += '<th style="width:6%;text-align:center;">Aksi</th></tr></thead><tbody id="tbodyRincian">';
    
    var totalRincian = 0;
    if (data.rincian && data.rincian.length > 0) {
        $.each(data.rincian, function(i, r) {
            totalRincian += parseFloat(r.alokasi) || 0;
            
            var lokasiDisplay = '-';
            if (r.lokasi_wilayah_detail && r.lokasi_wilayah_detail.length > 0) {
                var parts = [];
                $.each(r.lokasi_wilayah_detail, function(idx, lok) {
                    var prov = lok.provinsi || '';
                    var kab = lok.kabupaten || '';
                    var display = prov || '-';
                    if (kab && kab !== '') display += ' - ' + kab;
                    parts.push('<span class="lokasi-tag">' + display + '</span>');
                });
                lokasiDisplay = parts.join(' ');
            }
            
            html += '<tr>';
            html += '<td><span class="badge-notika badge-notika-info">' + r.kode + '</span></td>';
            html += '<td>' + (r.sasaran_kegiatan || '-') + '</td>';
            html += '<td>' + (r.klasifikasi_rincian_output || '-') + '</td>';
            html += '<td><strong>' + (r.rincian_output || '-') + '</strong>' + (r.komponen ? '<br><small style="color:#888;">' + r.komponen + '</small>' : '') + '</td>';
            html += '<td class="text-center"><div class="lokasi-display">' + lokasiDisplay + '</div></td>';
            html += '<td class="text-right">' + formatNumber(r.alokasi) + '</td>';
            html += '<td class="text-center"><div class="dropdown-aksi">';
            html += '<button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)"><i class="fa fa-ellipsis-v"></i></button>';
            html += '<div class="menu-dropdown">';
            html += '<button class="item-dropdown edit-rincian" data-id="' + r.id + '" data-kode="' + r.kode + '" data-sasaran="' + (r.sasaran_kegiatan || '') + '" data-klasifikasi="' + (r.klasifikasi_rincian_output || '') + '" data-rincian="' + (r.rincian_output || '') + '" data-komponen="' + (r.komponen || '') + '" data-lokasi="' + (r.lokasi_wilayah || '') + '" data-alokasi="' + r.alokasi + '"><i class="fa fa-pencil"></i> Edit</button>';
            html += '<button class="item-dropdown text-danger delete-rincian" data-id="' + r.id + '"><i class="fa fa-trash"></i> Hapus</button>';
            html += '</div></div></td></tr>';
        });
    } else {
        html += '<tr><td colspan="7" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data rincian kegiatan</td></tr>';
    }
    html += '</tbody><tfoot><tr class="total-row">';
    html += '<td colspan="5" class="text-right">TOTAL</td>';
    html += '<td class="text-right">' + formatNumber(totalRincian) + '</td><td></td></tr></tfoot></table></div></div>';
    
    // Pendanaan
    html += '<div class="card-notika">';
    html += '<div class="card-header"><div class="card-title">Perhitungan Pendanaan (Tahun ' + data.rekap3.tahun + ' dan Prakiraan Maju)</div>';
    html += '<button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalPendanaan"><span>+</span> Tambah</button></div>';
    html += '<div class="card-body"><table class="table-notika" style="font-size:11px;" id="tabelPendanaan"><thead><tr>';
    html += '<th style="width:6%;">Kode</th><th>Rincian Output</th>';
    html += '<th style="width:8%;text-align:center;">Volume</th><th style="width:8%;text-align:center;">Satuan</th>';
    html += '<th style="width:10%;text-align:right;">Satuan Biaya</th>';
    html += '<th style="width:10%;text-align:right;">Alokasi ' + data.rekap3.tahun + '</th>';
    html += '<th colspan="3" style="text-align:center;">Prakiraan Kebutuhan</th>';
    html += '<th style="width:6%;text-align:center;">Aksi</th></tr>';
    html += '<tr><th colspan="6"></th><th style="text-align:center;font-size:10px;">2025</th><th style="text-align:center;font-size:10px;">2026</th><th style="text-align:center;font-size:10px;">2027</th><th></th></tr></thead><tbody id="tbodyPendanaan">';
    
    var totalPendanaan = 0;
    if (data.pendanaan && data.pendanaan.length > 0) {
        $.each(data.pendanaan, function(i, p) {
            totalPendanaan += parseFloat(p.alokasi_2024) || 0;
            html += '<tr>';
            html += '<td><span class="badge-notika badge-notika-info">' + p.kode + '</span></td>';
            html += '<td><strong>' + (p.rincian_output || '-') + '</strong>' + (p.komponen ? '<br><small style="color:#888;">' + p.komponen + '</small>' : '') + '</td>';
            html += '<td class="text-center">' + (p.volume_target || '-') + '</td>';
            html += '<td class="text-center">' + (p.satuan || '-') + '</td>';
            html += '<td class="text-right">' + formatNumber(p.satuan_biaya) + '</td>';
            html += '<td class="text-right">' + formatNumber(p.alokasi_2024) + '</td>';
            html += '<td class="text-center">' + (p.target_2025 || '-') + '</td>';
            html += '<td class="text-center">' + (p.target_2026 || '-') + '</td>';
            html += '<td class="text-center">' + (p.target_2027 || '-') + '</td>';
            html += '<td class="text-center"><div class="dropdown-aksi">';
            html += '<button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)"><i class="fa fa-ellipsis-v"></i></button>';
            html += '<div class="menu-dropdown">';
            html += '<button class="item-dropdown edit-pendanaan" data-id="' + p.id + '" data-kode="' + p.kode + '" data-sasaran="' + (p.sasaran_kegiatan || '') + '" data-klasifikasi="' + (p.klasifikasi_rincian_output || '') + '" data-rincian="' + (p.rincian_output || '') + '" data-komponen="' + (p.komponen || '') + '" data-volume="' + (p.volume_target || '') + '" data-satuan="' + (p.satuan || '') + '" data-satuan_biaya="' + p.satuan_biaya + '" data-alokasi_2024="' + p.alokasi_2024 + '" data-target_2025="' + (p.target_2025 || '') + '" data-target_2026="' + (p.target_2026 || '') + '" data-target_2027="' + (p.target_2027 || '') + '"><i class="fa fa-pencil"></i> Edit</button>';
            html += '<button class="item-dropdown text-danger delete-pendanaan" data-id="' + p.id + '"><i class="fa fa-trash"></i> Hapus</button>';
            html += '</div></div></td></tr>';
        });
    } else {
        html += '<tr><td colspan="10" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data perhitungan pendanaan</td></tr>';
    }
    html += '</tbody><tfoot><tr class="total-row">';
    html += '<td colspan="5" class="text-right">TOTAL</td>';
    html += '<td class="text-right">' + formatNumber(totalPendanaan) + '</td>';
    html += '<td colspan="4"></td></tr></tfoot></table></div></div>';
    
    // Sumber Dana
    html += '<div class="card-notika">';
    html += '<div class="card-header"><div class="card-title">Sumber Pendanaan</div>';
    html += '<button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalSumberDana"><span>+</span> Tambah</button></div>';
    html += '<div class="card-body"><table class="table-notika" style="font-size:11px;" id="tabelSumberDana"><thead><tr>';
    html += '<th style="width:6%;">Kode</th><th>Rincian Output / Komponen</th>';
    html += '<th style="width:8%;text-align:center;">Jenis</th>';
    var sources = ['RPP', 'NBP', 'BLU', 'LN', 'RM', 'PPDN', 'HIBAH', 'PHBS', 'SNH', 'NT'];
    $.each(sources, function(i, src) {
        html += '<th style="width:8%;text-align:right;">' + src + '</th>';
    });
    html += '<th style="width:10%;text-align:right;">Total</th>';
    html += '<th style="width:6%;text-align:center;">Aksi</th></tr></thead><tbody id="tbodySumberDana">';
    
    var totalSumberDana = 0;
    var srcKeys = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
    if (data.sumber_dana && data.sumber_dana.length > 0) {
        $.each(data.sumber_dana, function(i, sd) {
            totalSumberDana += parseFloat(sd.total) || 0;
            html += '<tr>';
            html += '<td><span class="badge-notika badge-notika-info">' + sd.kode + '</span></td>';
            html += '<td><strong>' + (sd.rincian_output || '-') + '</strong>' + (sd.komponen ? '<br><small style="color:#888;">' + sd.komponen + '</small>' : '') + '</td>';
            html += '<td class="text-center"><span class="badge-notika badge-notika-primary">' + (sd.jenis_komponen || '-') + '</span></td>';
            $.each(srcKeys, function(si, sk) {
                var val = sd[sk] || 0;
                html += '<td class="text-right">' + formatNumber(val) + '</td>';
            });
            html += '<td class="text-right" style="font-weight:600;color:#4a90d9;">' + formatNumber(sd.total) + '</td>';
            html += '<td class="text-center"><div class="dropdown-aksi">';
            html += '<button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)"><i class="fa fa-ellipsis-v"></i></button>';
            html += '<div class="menu-dropdown">';
            var dataAttrs = 'data-id="' + sd.id + '" data-kode="' + sd.kode + '" data-sasaran="' + (sd.sasaran_kegiatan || '') + '" data-klasifikasi="' + (sd.klasifikasi_rincian_output || '') + '" data-rincian="' + (sd.rincian_output || '') + '" data-komponen="' + (sd.komponen || '') + '" data-jenis="' + (sd.jenis_komponen || '') + '"';
            $.each(srcKeys, function(si, sk) {
                dataAttrs += ' data-' + sk + '="' + (sd[sk] || 0) + '"';
            });
            html += '<button class="item-dropdown edit-sumber-dana" ' + dataAttrs + '><i class="fa fa-pencil"></i> Edit</button>';
            html += '<button class="item-dropdown text-danger delete-sumber-dana" data-id="' + sd.id + '"><i class="fa fa-trash"></i> Hapus</button>';
            html += '</div></div></td></tr>';
        });
    } else {
        html += '<tr><td colspan="15" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data sumber pendanaan</td></tr>';
    }
    
    var totalSources = {};
    $.each(srcKeys, function(si, sk) { totalSources[sk] = 0; });
    if (data.sumber_dana) {
        $.each(data.sumber_dana, function(i, sd) {
            $.each(srcKeys, function(si, sk) {
                totalSources[sk] += parseFloat(sd[sk]) || 0;
            });
        });
    }
    
    html += '</tbody><tfoot><tr class="total-row">';
    html += '<td colspan="3" class="text-right">TOTAL</td>';
    $.each(srcKeys, function(si, sk) {
        html += '<td class="text-right">' + formatNumber(totalSources[sk]) + '</td>';
    });
    html += '<td class="text-right" style="font-weight:700;color:#4a90d9;font-size:14px;">' + formatNumber(totalSumberDana) + '</td>';
    html += '<td></td></tr></tfoot></table></div></div>';
    
    // Rekapitulasi
    html += '<div class="card-notika" style="background:#f9f9f9;">';
    html += '<div class="card-header" style="background:#fff;"><div class="card-title">Rekapitulasi Anggaran <span class="badge-notika badge-notika-success">Total Akumulasi</span></div></div>';
    html += '<div class="card-body"><div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(160px, 1fr));gap:14px;">';
    html += '<div class="rekap-card"><div class="rekap-label">Sasaran Kegiatan</div><div class="rekap-value">Rp ' + formatNumber(totalSasaran) + '</div></div>';
    html += '<div class="rekap-card"><div class="rekap-label">Rincian Kegiatan</div><div class="rekap-value">Rp ' + formatNumber(totalRincian) + '</div></div>';
    html += '<div class="rekap-card"><div class="rekap-label">Perhitungan Pendanaan</div><div class="rekap-value">Rp ' + formatNumber(totalPendanaan) + '</div></div>';
    html += '<div class="rekap-card rekap-highlight"><div class="rekap-label">Total Sumber Dana</div><div class="rekap-value">Rp ' + formatNumber(totalSumberDana) + '</div></div>';
    html += '</div></div></div>';
    
    $('#contentData').html(html);
    $('#contentData').show();
    
    var akumulasiHtml = '<div class="akumulasi-box">';
    akumulasiHtml += '<div class="item"><div class="label">Sasaran Kegiatan</div><div class="value">Rp ' + formatNumber(totalSasaran) + '</div></div>';
    akumulasiHtml += '<div class="item"><div class="label">Rincian Kegiatan</div><div class="value">Rp ' + formatNumber(totalRincian) + '</div></div>';
    akumulasiHtml += '<div class="item"><div class="label">Perhitungan Pendanaan</div><div class="value">Rp ' + formatNumber(totalPendanaan) + '</div></div>';
    akumulasiHtml += '<div class="item"><div class="label">Sumber Dana</div><div class="value">Rp ' + formatNumber(totalSumberDana) + '</div></div>';
    akumulasiHtml += '</div>';
    $('#akumulasiContainer').html(akumulasiHtml);
}

// ============================================================
// FUNGSI FORMAT NUMBER
// ============================================================
function formatNumber(num) {
    if (!num || num == 0) return '0';
    return Number(num).toLocaleString('id-ID');
}

// ============================================================
// AKUMULASI
// ============================================================
function loadAkumulasi() {
    if (!IdRekap3) {
        $('#akumulasiContainer').html('<div class="alert alert-warning">Data Rekap 3 belum dibuat</div>');
        return;
    }
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_get_by_tahun",
        type: "POST",
        data: {tahun: CurrentTahun},
        dataType: "json",
        timeout: 30000,
        success: function(res) {
            if (res.success) {
                var html = '<div class="akumulasi-box">';
                html += '<div class="item"><div class="label">Sasaran Kegiatan</div><div class="value">Rp ' + formatNumber(res.data.total_sasaran) + '</div></div>';
                html += '<div class="item"><div class="label">Rincian Kegiatan</div><div class="value">Rp ' + formatNumber(res.data.total_rincian) + '</div></div>';
                html += '<div class="item"><div class="label">Perhitungan Pendanaan</div><div class="value">Rp ' + formatNumber(res.data.total_pendanaan) + '</div></div>';
                html += '<div class="item"><div class="label">Sumber Dana</div><div class="value">Rp ' + formatNumber(res.data.total_sumber_dana) + '</div></div>';
                html += '</div>';
                $('#akumulasiContainer').html(html);
            }
        },
        error: function() {
            $('#akumulasiContainer').html('<div class="alert alert-danger">Gagal memuat akumulasi</div>');
        }
    });
}

// ============================================================
// DOCUMENT READY
// ============================================================
$(document).ready(function() {
    // CRUD - REKAP 3
    $("#FormRekap3").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            url: BaseURL + "Kementerian/rekap3_save",
            type: "POST",
            data: formData,
            dataType: "json",
            timeout: 30000,
            success: function(res) {
                if (res.success) {
                    showToast(res.message, 'success');
                    setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    $('#ModalRekap3').modal('hide');
                } else {
                    showToast(res.message || 'Error', 'error');
                }
            },
            error: function() {
                showToast('Gagal menghubungi server', 'error');
            }
        });
    });
    
    // CRUD - SASARAN KEGIATAN
    $("#FormSasaran").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            url: BaseURL + "Kementerian/rekap3_sasaran_save",
            type: "POST",
            data: formData,
            dataType: "json",
            timeout: 30000,
            success: function(res) {
                if (res.success) {
                    showToast(res.message, 'success');
                    setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    $('#ModalSasaran').modal('hide');
                } else {
                    showToast(res.message || 'Error', 'error');
                }
            },
            error: function() {
                showToast('Gagal menghubungi server', 'error');
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
        $('#SasaranTitle').text('Edit Sasaran Kegiatan');
        $('#ModalSasaran').modal('show');
    });
    
    $(document).on('click', '.delete-sasaran', function() {
        if (confirm('Yakin hapus data sasaran ini?')) {
            var id = $(this).data('id');
            $.ajax({
                url: BaseURL + "Kementerian/rekap3_sasaran_delete",
                type: "POST",
                data: {id: id},
                dataType: "json",
                timeout: 30000,
                success: function(res) {
                    if (res.success) {
                        showToast(res.message, 'success');
                        setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    } else {
                        showToast(res.message || 'Error', 'error');
                    }
                },
                error: function() {
                    showToast('Gagal menghubungi server', 'error');
                }
            });
        }
    });
    
    $('#ModalSasaran').on('hidden.bs.modal', function() {
        $('#SasaranId').val('');
        $('#SasaranTitle').text('Tambah Sasaran Kegiatan');
        $('#FormSasaran')[0].reset();
    });
    
    // ============================================================
    // CRUD - RINCIAN KEGIATAN
    // ============================================================
    $("#FormRincian").submit(function(e) {
        e.preventDefault();
        
        var kode = $('#RincianKode').val().trim();
        var rincianOutput = $('#RincianOutput').val().trim();
        
        if (!kode) {
            showToast('Kode harus diisi!', 'error');
            return;
        }
        if (!rincianOutput) {
            showToast('Rincian Output harus diisi!', 'error');
            return;
        }
        
        var lokasiArray = [];
        $('.lokasi-item').each(function() {
            var provinsiSelect = $(this).find('.lokasi-provinsi-select');
            var kabupatenSelect = $(this).find('.lokasi-kabupaten-select');
            
            var provinsiKode = provinsiSelect.val() || '';
            var kabupatenKode = kabupatenSelect.val() || '';
            
            if (provinsiKode && provinsiKode !== '') {
                lokasiArray.push({
                    provinsi_kode: provinsiKode,
                    kabupaten_kode: kabupatenKode || ''
                });
            }
        });
        
        var formData = $(this).serialize();
        var lokasiJson = JSON.stringify(lokasiArray);
        formData += '&lokasi_wilayah=' + encodeURIComponent(lokasiJson);
        
        $('#btnSimpanRincian').prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        
        $.ajax({
            url: BaseURL + "Kementerian/rekap3_rincian_save",
            type: "POST",
            data: formData,
            dataType: "json",
            timeout: 30000,
            success: function(res) {
                $('#btnSimpanRincian').prop('disabled', false).html('Simpan');
                if (res.success) {
                    showToast(res.message, 'success');
                    setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    $('#ModalRincian').modal('hide');
                } else {
                    showToast(res.message || 'Error menyimpan data', 'error');
                }
            },
            error: function(xhr, status, error) {
                $('#btnSimpanRincian').prop('disabled', false).html('Simpan');
                showToast('Gagal menghubungi server: ' + error, 'error');
            }
        });
    });
    
    $(document).on('click', '.edit-rincian', function() {
        var btn = $(this);
        $('#RincianId').val(btn.data('id'));
        $('#RincianKode').val(btn.data('kode'));
        $('#RincianSasaran').val(btn.data('sasaran'));
        $('#RincianKlasifikasi').val(btn.data('klasifikasi'));
        $('#RincianOutput').val(btn.data('rincian'));
        $('#RincianKomponen').val(btn.data('komponen'));
        $('#RincianAlokasi').val(btn.data('alokasi'));
        
        $('#lokasiContainer').empty();
        lokasiIndex = 0;
        
        var lokasiRaw = btn.data('lokasi');
        if (lokasiRaw && lokasiRaw !== '' && lokasiRaw !== 'null' && lokasiRaw !== '[]') {
            try {
                var lokasiArray;
                if (typeof lokasiRaw === 'string') {
                    lokasiArray = JSON.parse(lokasiRaw);
                } else if (typeof lokasiRaw === 'object') {
                    lokasiArray = lokasiRaw;
                } else {
                    lokasiArray = [];
                }
                if (Array.isArray(lokasiArray) && lokasiArray.length > 0) {
                    $.each(lokasiArray, function(index, lok) {
                        var provKode = lok.provinsi_kode || '';
                        var kabKode = lok.kabupaten_kode || '';
                        tambahLokasi(provKode, kabKode);
                    });
                } else {
                    tambahLokasi();
                }
            } catch(e) {
                tambahLokasi();
            }
        } else {
            tambahLokasi();
        }
        
        $('#RincianTitle').text('Edit Rincian Kegiatan');
        $('#ModalRincian').modal('show');
    });
    
    $(document).on('click', '.delete-rincian', function() {
        if (confirm('Yakin hapus data rincian ini?')) {
            var id = $(this).data('id');
            var btn = $(this);
            btn.html('<span class="spinner-border-sm"></span>');
            btn.prop('disabled', true);
            
            $.ajax({
                url: BaseURL + "Kementerian/rekap3_rincian_delete",
                type: "POST",
                data: {id: id},
                dataType: "json",
                timeout: 30000,
                success: function(res) {
                    btn.html('<i class="fa fa-trash"></i>');
                    btn.prop('disabled', false);
                    if (res.success) {
                        showToast(res.message, 'success');
                        setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    } else {
                        showToast(res.message || 'Error', 'error');
                    }
                },
                error: function() {
                    btn.html('<i class="fa fa-trash"></i>');
                    btn.prop('disabled', false);
                    showToast('Gagal menghubungi server', 'error');
                }
            });
        }
    });
    
    $('#ModalRincian').on('hidden.bs.modal', function() {
        $('#RincianId').val('');
        $('#RincianTitle').text('Tambah Rincian Kegiatan');
        $('#FormRincian')[0].reset();
        $('#lokasiContainer').empty();
        lokasiIndex = 0;
        $('#btnSimpanRincian').prop('disabled', false).html('Simpan');
    });
    
    $('#ModalRincian').on('shown.bs.modal', function() {
        if ($('#lokasiContainer').children().length === 0) {
            tambahLokasi();
        }
    });
    
    // CRUD - PERHITUNGAN PENDANAAN
    $("#FormPendanaan").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            url: BaseURL + "Kementerian/rekap3_pendanaan_save",
            type: "POST",
            data: formData,
            dataType: "json",
            timeout: 30000,
            success: function(res) {
                if (res.success) {
                    showToast(res.message, 'success');
                    setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    $('#ModalPendanaan').modal('hide');
                } else {
                    showToast(res.message || 'Error', 'error');
                }
            },
            error: function() {
                showToast('Gagal menghubungi server', 'error');
            }
        });
    });
    
    $(document).on('click', '.edit-pendanaan', function() {
        var btn = $(this);
        $('#PendanaanId').val(btn.data('id'));
        $('#PendanaanKode').val(btn.data('kode'));
        $('#PendanaanSasaran').val(btn.data('sasaran'));
        $('#PendanaanKlasifikasi').val(btn.data('klasifikasi'));
        $('#PendanaanRincian').val(btn.data('rincian'));
        $('#PendanaanKomponen').val(btn.data('komponen'));
        $('#PendanaanVolume').val(btn.data('volume'));
        $('#PendanaanSatuan').val(btn.data('satuan'));
        $('#PendanaanSatuanBiaya').val(btn.data('satuan_biaya'));
        $('#PendanaanAlokasi').val(btn.data('alokasi_2024'));
        $('#PendanaanTarget2025').val(btn.data('target_2025'));
        $('#PendanaanTarget2026').val(btn.data('target_2026'));
        $('#PendanaanTarget2027').val(btn.data('target_2027'));
        $('#ModalPendanaan').modal('show');
    });
    
    $(document).on('click', '.delete-pendanaan', function() {
        if (confirm('Yakin hapus data pendanaan ini?')) {
            var id = $(this).data('id');
            $.ajax({
                url: BaseURL + "Kementerian/rekap3_pendanaan_delete",
                type: "POST",
                data: {id: id},
                dataType: "json",
                timeout: 30000,
                success: function(res) {
                    if (res.success) {
                        showToast(res.message, 'success');
                        setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    } else {
                        showToast(res.message || 'Error', 'error');
                    }
                },
                error: function() {
                    showToast('Gagal menghubungi server', 'error');
                }
            });
        }
    });
    
    // CRUD - SUMBER DANA
    $(document).on('input', '.sumber-dana-input', function() {
        updateTotalSumberDana();
    });
    
    function updateTotalSumberDana() {
        var total = 0;
        $('.sumber-dana-input').each(function() {
            var val = parseFloat($(this).val()) || 0;
            total += val;
        });
        $('#SumberDanaTotal').val('Rp ' + total.toLocaleString('id-ID'));
    }
    
    $("#FormSumberDana").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            url: BaseURL + "Kementerian/rekap3_sumber_dana_save",
            type: "POST",
            data: formData,
            dataType: "json",
            timeout: 30000,
            success: function(res) {
                if (res.success) {
                    showToast(res.message, 'success');
                    setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    $('#ModalSumberDana').modal('hide');
                } else {
                    showToast(res.message || 'Error', 'error');
                }
            },
            error: function() {
                showToast('Gagal menghubungi server', 'error');
            }
        });
    });
    
    $(document).on('click', '.edit-sumber-dana', function() {
        var btn = $(this);
        $('#SumberDanaId').val(btn.data('id'));
        $('#SumberDanaKode').val(btn.data('kode'));
        $('#SumberDanaSasaran').val(btn.data('sasaran'));
        $('#SumberDanaKlasifikasi').val(btn.data('klasifikasi'));
        $('#SumberDanaRincian').val(btn.data('rincian'));
        $('#SumberDanaKomponen').val(btn.data('komponen'));
        $('#SumberDanaJenis').val(btn.data('jenis'));
        
        var srcKeys = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
        srcKeys.forEach(function(src) {
            var val = btn.data(src) || 0;
            $('#SumberDana' + src.toUpperCase()).val(val);
        });
        
        updateTotalSumberDana();
        $('#ModalSumberDana').modal('show');
    });
    
    $(document).on('click', '.delete-sumber-dana', function() {
        if (confirm('Yakin hapus data sumber dana ini?')) {
            var id = $(this).data('id');
            $.ajax({
                url: BaseURL + "Kementerian/rekap3_sumber_dana_delete",
                type: "POST",
                data: {id: id},
                dataType: "json",
                timeout: 30000,
                success: function(res) {
                    if (res.success) {
                        showToast(res.message, 'success');
                        setTimeout(function() { loadDataTahun(CurrentTahun); }, 800);
                    } else {
                        showToast(res.message || 'Error', 'error');
                    }
                },
                error: function() {
                    showToast('Gagal menghubungi server', 'error');
                }
            });
        }
    });
    
    $('#ModalSumberDana').on('hidden.bs.modal', function() {
        $('#SumberDanaId').val('');
        $('.sumber-dana-input').val(0);
        updateTotalSumberDana();
        $('#FormSumberDana')[0].reset();
    });
    
    if (IdRekap3) {
        loadAkumulasi();
    }
});
</script>