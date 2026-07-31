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
    
    .sumber-dana-mini { font-size: 11px; }
    .sumber-dana-mini span { display: inline-block; background: #f0f0f0; padding: 1px 6px; border-radius: 3px; margin: 1px; }
    
    @media (max-width: 768px) {
        .card-notika .card-header { flex-direction: column; align-items: flex-start; }
        .year-nav .year-btn { min-width: 36px; padding: 3px 6px; font-size: 12px; }
        .table-notika { font-size: 11px; }
        .table-notika thead th, .table-notika tbody td { padding: 5px 6px; }
        .modal-notika .modal-body { padding: 12px; }
    }
    @media print {
        .btn-notika, .no-print { display: none !important; }
        .akumulasi-box { background: #4a90d9 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .card-notika { break-inside: avoid; }
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
                    <button class="btn-notika btn-notika-success" data-toggle="modal" data-target="#ModalRekap3">
                        <span>+</span> Buat/Edit Rekap 3
                    </button>
                    <?php if ($Rekap3): ?>
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
                    <?php if ($Rekap3): ?>
                        <!-- ============================================================
                        HEADER REKAP 3
                        ============================================================ -->
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

                        <!-- ============================================================
                        SASARAN KEGIATAN (IKK)
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Sasaran Kegiatan / Indikator Kinerja Kegiatan (IKK)</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalSasaran">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table-notika">
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
                                    <tbody>
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
                                                <button class="btn-notika btn-notika-warning btn-notika-xs edit-sasaran" 
                                                    data-id="<?= $s['id'] ?>"
                                                    data-kode="<?= htmlspecialchars($s['kode']) ?>"
                                                    data-nama="<?= htmlspecialchars($s['nama_sasaran']) ?>"
                                                    data-indikator="<?= htmlspecialchars($s['indikator_kinerja'] ?? '') ?>"
                                                    data-target="<?= htmlspecialchars($s['target'] ?? '') ?>"
                                                    data-alokasi="<?= $s['alokasi'] ?>">
                                                    ✎
                                                </button>
                                                <button class="btn-notika btn-notika-danger btn-notika-xs delete-sasaran" data-id="<?= $s['id'] ?>">×</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($SasaranKegiatan)): ?>
                                        <tr><td colspan="6" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data sasaran kegiatan</td></tr>
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
                        RINCIAN KEGIATAN - PEMETAAN
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Rincian Kegiatan - Pemetaan</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalRincian">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table-notika" style="font-size:11px;">
                                    <thead>
                                        <tr>
                                            <th style="width:6%;">Kode</th>
                                            <th>Sasaran Kegiatan</th>
                                            <th>Klasifikasi Rincian Output</th>
                                            <th>Rincian Output / Komponen</th>
                                            <th style="width:8%;text-align:center;">Lokasi</th>
                                            <th style="width:10%;text-align:right;">Alokasi</th>
                                            <th style="width:6%;text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total_rincian = 0;
                                        foreach ($Rincian as $r): 
                                            $total_rincian += $r['alokasi'];
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
                                                <?= htmlspecialchars($r['provinsi'] ?? '-') ?>
                                                <?php if ($r['kabupaten_kota']): ?>
                                                <br><small style="color:#888;"><?= htmlspecialchars($r['kabupaten_kota']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right"><?= number_format($r['alokasi'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <button class="btn-notika btn-notika-warning btn-notika-xs edit-rincian"
                                                    data-id="<?= $r['id'] ?>"
                                                    data-kode="<?= htmlspecialchars($r['kode']) ?>"
                                                    data-sasaran="<?= htmlspecialchars($r['sasaran_kegiatan'] ?? '') ?>"
                                                    data-klasifikasi="<?= htmlspecialchars($r['klasifikasi_rincian_output'] ?? '') ?>"
                                                    data-rincian="<?= htmlspecialchars($r['rincian_output'] ?? '') ?>"
                                                    data-komponen="<?= htmlspecialchars($r['komponen'] ?? '') ?>"
                                                    data-provinsi="<?= htmlspecialchars($r['provinsi'] ?? '') ?>"
                                                    data-kabupaten="<?= htmlspecialchars($r['kabupaten_kota'] ?? '') ?>"
                                                    data-alokasi="<?= $r['alokasi'] ?>">
                                                    ✎
                                                </button>
                                                <button class="btn-notika btn-notika-danger btn-notika-xs delete-rincian" data-id="<?= $r['id'] ?>">×</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($Rincian)): ?>
                                        <tr><td colspan="7" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data rincian kegiatan</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="5" class="text-right">TOTAL</td>
                                            <td class="text-right"><?= number_format($total_rincian, 0, ',', '.') ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- ============================================================
                        PERHITUNGAN PENDANAAN
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Perhitungan Pendanaan (Tahun <?= $CurrentTahun ?> dan Prakiraan Maju)</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalPendanaan">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table-notika" style="font-size:11px;">
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
                                    <tbody>
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
                                                <button class="btn-notika btn-notika-warning btn-notika-xs edit-pendanaan"
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
                                                    ✎
                                                </button>
                                                <button class="btn-notika btn-notika-danger btn-notika-xs delete-pendanaan" data-id="<?= $p['id'] ?>">×</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($Pendanaan)): ?>
                                        <tr><td colspan="10" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data perhitungan pendanaan</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="5" class="text-right">TOTAL</td>
                                            <td class="text-right"><?= number_format($total_pendanaan, 0, ',', '.') ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- ============================================================
                        SUMBER PENDANAAN
                        ============================================================ -->
                        <div class="card-notika">
                            <div class="card-header">
                                <div class="card-title">Sumber Pendanaan</div>
                                <button class="btn-notika btn-notika-success btn-notika-sm" data-toggle="modal" data-target="#ModalSumberDana">
                                    <span>+</span> Tambah
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table-notika" style="font-size:11px;">
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
                                    <tbody>
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
                                                <button class="btn-notika btn-notika-warning btn-notika-xs edit-sumber-dana"
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
                                                    ✎
                                                </button>
                                                <button class="btn-notika btn-notika-danger btn-notika-xs delete-sumber-dana" data-id="<?= $sd['id'] ?>">×</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($SumberDana)): ?>
                                        <tr><td colspan="15" style="text-align:center;color:#aaa;padding:20px 0;">Belum ada data sumber pendanaan</td></tr>
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
                                            <td class="text-right" style="font-weight:700;color:#4a90d9;font-size:14px;">
                                                <?= number_format($total_sumber_dana, 0, ',', '.') ?>
                                            </td>
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
                                        <div class="rekap-label">Sasaran Kegiatan</div>
                                        <div class="rekap-value">Rp <?= number_format($total_sasaran, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card">
                                        <div class="rekap-label">Rincian Kegiatan</div>
                                        <div class="rekap-value">Rp <?= number_format($total_rincian, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card">
                                        <div class="rekap-label">Perhitungan Pendanaan</div>
                                        <div class="rekap-value">Rp <?= number_format($total_pendanaan, 0, ',', '.') ?></div>
                                    </div>
                                    <div class="rekap-card rekap-highlight">
                                        <div class="rekap-label">Total Sumber Dana</div>
                                        <div class="rekap-value">Rp <?= number_format($total_sumber_dana, 0, ',', '.') ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($IdRenja): ?>
                        <!-- Renja ada tapi Rekap 3 belum -->
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
                        <!-- Belum ada Renja sama sekali -->
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormRekap3">Simpan</button>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormSasaran">Simpan</button>
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
                <h4 class="modal-title">Tambah Rincian Kegiatan</h4>
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
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="form-group-notika">
                            <label>Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" id="RincianProvinsi" placeholder="Pusat / DKI Jakarta">
                        </div>
                        <div class="form-group-notika">
                            <label>Kabupaten / Kota</label>
                            <input type="text" class="form-control" name="kabupaten_kota" id="RincianKabupaten" placeholder="Pusat / Jakarta Selatan">
                        </div>
                    </div>
                    <div class="form-group-notika">
                        <label>Alokasi (Ribu Rupiah)</label>
                        <input type="number" class="form-control" name="alokasi" id="RincianAlokasi" value="0" step="1000">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormRincian">Simpan</button>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormPendanaan">Simpan</button>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-notika btn-notika-outline" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-notika btn-notika-success" form="FormSumberDana">Simpan</button>
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
var IdRekap3 = <?= json_encode($Rekap3['id'] ?? null) ?>;
var CurrentTahun = <?= json_encode($CurrentTahun) ?>;
var IdRenja = <?= json_encode($IdRenja ?? null) ?>;

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
// CREATE REKAP 3
// ============================================================
function createRekap3() {
    if (!IdRenja) {
        alert('ID Renja tidak ditemukan');
        return;
    }
    
    if (!confirm('Buat data Rekap 3 untuk tahun ' + CurrentTahun + '?')) return;
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_create",
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
                    html += '<h4>' + res.message + '</h4>';
                    html += '<div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">';
                    html += '<button class="btn-notika btn-notika-success" onclick="createRekap3()">';
                    html += '<span>+</span> Buat Rekap 3</button>';
                    html += '<button class="btn-notika btn-notika-primary" data-toggle="modal" data-target="#ModalRekap3">';
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
    $('#Rekap3Id').val(data.rekap3.id);
    $('#Rekap3IdRenja').val(data.rekap3.id_renja);
    $('#Rekap3Program').val(data.rekap3.program || '');
    $('#Rekap3SasaranProgram').val(data.rekap3.sasaran_program || '');
    $('#Rekap3Kegiatan').val(data.rekap3.kegiatan || '');
    $('#Rekap3Unit').val(data.rekap3.unit_organisasi || '');
    
    // Update status button
    $('.year-btn').removeClass('has-data renja-only no-data');
    $('.year-btn[data-tahun="' + data.rekap3.tahun + '"]').addClass('has-data');
    $('.year-btn[data-tahun="' + data.rekap3.tahun + '"] .status-icon').text('✓');
    
    // Load akumulasi
    loadAkumulasi();
}

// ============================================================
// AKUMULASI
// ============================================================
window.loadAkumulasi = function() {
    if (!IdRekap3) {
        $('#akumulasiContainer').html('<div class="alert alert-warning">Data Rekap 3 belum dibuat</div>');
        return;
    }
    
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_get_by_tahun",
        type: "POST",
        data: {tahun: CurrentTahun},
        dataType: "json",
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
        }
    });
};

// ============================================================
// CRUD - REKAP 3
// ============================================================
$("#FormRekap3").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_save",
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
// CRUD - SASARAN KEGIATAN
// ============================================================
$("#FormSasaran").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_sasaran_save",
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
            success: function(res) {
                if (res.success) { alert(res.message); location.reload(); }
                else { alert('Error: ' + res.message); }
            }
        });
    }
});

$('#ModalSasaran').on('hidden.bs.modal', function() {
    $('#SasaranId').val('');
    $('#SasaranTitle').text('Tambah Sasaran Kegiatan');
});

// ============================================================
// CRUD - RINCIAN KEGIATAN
// ============================================================
$("#FormRincian").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_rincian_save",
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

$(document).on('click', '.edit-rincian', function() {
    var btn = $(this);
    $('#RincianId').val(btn.data('id'));
    $('#RincianKode').val(btn.data('kode'));
    $('#RincianSasaran').val(btn.data('sasaran'));
    $('#RincianKlasifikasi').val(btn.data('klasifikasi'));
    $('#RincianOutput').val(btn.data('rincian'));
    $('#RincianKomponen').val(btn.data('komponen'));
    $('#RincianProvinsi').val(btn.data('provinsi'));
    $('#RincianKabupaten').val(btn.data('kabupaten'));
    $('#RincianAlokasi').val(btn.data('alokasi'));
    $('#ModalRincian').modal('show');
});

$(document).on('click', '.delete-rincian', function() {
    if (confirm('Yakin hapus data rincian ini?')) {
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Kementerian/rekap3_rincian_delete",
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
// CRUD - PERHITUNGAN PENDANAAN
// ============================================================
$("#FormPendanaan").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: BaseURL + "Kementerian/rekap3_pendanaan_save",
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
            success: function(res) {
                if (res.success) { alert(res.message); location.reload(); }
                else { alert('Error: ' + res.message); }
            }
        });
    }
});

// ============================================================
// CRUD - SUMBER DANA
// ============================================================
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

$(document).on('click', '.edit-sumber-dana', function() {
    var btn = $(this);
    $('#SumberDanaId').val(btn.data('id'));
    $('#SumberDanaKode').val(btn.data('kode'));
    $('#SumberDanaSasaran').val(btn.data('sasaran'));
    $('#SumberDanaKlasifikasi').val(btn.data('klasifikasi'));
    $('#SumberDanaRincian').val(btn.data('rincian'));
    $('#SumberDanaKomponen').val(btn.data('komponen'));
    $('#SumberDanaJenis').val(btn.data('jenis'));
    
    var sources = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
    sources.forEach(function(src) {
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
            success: function(res) {
                if (res.success) { alert(res.message); location.reload(); }
                else { alert('Error: ' + res.message); }
            }
        });
    }
});

$('#ModalSumberDana').on('hidden.bs.modal', function() {
    $('#SumberDanaId').val('');
    $('.sumber-dana-input').val(0);
    updateTotalSumberDana();
});

// ============================================================
// DOCUMENT READY
// ============================================================
$(document).ready(function() {
    console.log('Rekap 3 - Document Ready');
    console.log('IdRekap3:', IdRekap3);
    console.log('CurrentTahun:', CurrentTahun);
    
    if (IdRekap3) {
        loadAkumulasi();
    }
});
</script>