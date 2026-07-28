<?php $this->load->view('Kementerian/Sidebar'); ?>

<style>
    .renja-section {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }
    .renja-section .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .renja-section .section-title .badge {
        font-size: 12px;
    }
    .table-renja th {
        background: #f8f9fa;
        font-weight: 600;
        font-size: 12px;
        vertical-align: middle;
    }
    .table-renja td {
        font-size: 13px;
        vertical-align: middle;
    }
    .total-row {
        background: #f0f7ff !important;
        font-weight: 600;
    }
    .total-row td {
        border-top: 2px solid #4a90d9 !important;
    }
    .text-right {
        text-align: right;
    }
    .text-center {
        text-align: center;
    }
    .btn-xs {
        padding: 2px 8px;
        font-size: 11px;
        border-radius: 3px;
    }
    .uang {
        font-family: 'Courier New', monospace;
        font-size: 13px;
    }
    .uang::before {
        content: 'Rp ';
        font-size: 11px;
    }
    .uang-besar {
        font-family: 'Courier New', monospace;
        font-size: 14px;
        font-weight: 600;
    }
    .uang-besar::before {
        content: 'Rp ';
        font-size: 12px;
    }
    .akumulasi-box {
        background: linear-gradient(135deg, #0c8d1f 0%, #0db762 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    .akumulasi-box .item {
        text-align: center;
        padding: 5px 20px;
    }
    .akumulasi-box .label {
        font-size: 12px;
        opacity: 0.9;
    }
    .akumulasi-box .value {
        font-size: 20px;
        font-weight: 700;
    }
    .collapse-toggle {
        cursor: pointer;
    }
    .collapse-toggle:hover {
        background: #f5f5f5;
    }
    .program-sub-table {
        background: #fafbfc;
        margin-top: 5px;
    }
    .program-sub-table td {
        padding: 6px 10px !important;
        font-size: 12px !important;
    }
    .program-card {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
    }
    .program-card .collapse-toggle {
        padding: 5px 10px;
        border-radius: 4px;
    }
    .program-card .collapse-toggle:hover {
        background: #f5f5f5;
    }
    .sumber-label {
        display: inline-block;
        background: #f0f0f0;
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 10px;
        font-weight: 700;
        margin: 1px;
    }
    .modal-lg-custom {
        max-width: 95%;
    }
    .tahun-btn {
        min-width: 50px;
    }
    .tahun-btn.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
    .tahun-btn.active:hover {
        background-color: #0069d9;
        color: white;
    }
    #loadingData {
        text-align: center;
        padding: 40px;
    }
    #loadingData .spinner {
        font-size: 40px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    @media print {
        .btn, .no-print {
            display: none !important;
        }
        .akumulasi-box {
            background: #667eea !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
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
                            <a href="<?= base_url('Kementerian/renjaanggaranrekap1') ?>">Kementerian</a>
                            <span style="margin:0 5px;">/</span>
                        </li>
                        <li style="display:inline-block;">
                            <span class="bread-blk">Rekap 1</span>
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
                <div class="alert alert-info" style="margin-bottom:15px;">
                    <i class="notika-icon notika-info"></i>
                    <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName ?? '-') ?><br>
                    <b>Periode :</b> <?= htmlspecialchars($UserPeriode ?? '-') ?>
                </div>
                <?php endif; ?>

                <!-- Tombol Aksi -->
                <div class="button-icon-btn sm-res-mg-t-30" style="margin-bottom:15px;">
                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalRenja">
                        <i class="notika-icon notika-edit"></i> <b>Buat/Edit Renja</b>
                    </button>
                    <!-- <button type="button" class="btn btn-primary notika-btn-primary" onclick="loadAkumulasi()">
                        <i class="notika-icon notika-analytics"></i> <b>Akumulasi Anggaran</b>
                    </button> -->
                    <?php if (!empty($Renja)): ?>
                    <button type="button" class="btn btn-info notika-btn-info" onclick="window.print()">
                        <i class="notika-icon notika-print"></i> <b>Cetak</b>
                    </button>
                    <?php endif; ?>
                </div>

                <!-- AKUMULASI BOX -->
                <div id="akumulasiContainer"></div>

                <?php if (empty($Renja)): ?>
                <!-- Jika belum ada data -->
                <div class="alert alert-warning text-center">
                    <i class="notika-icon notika-alert"></i>
                    <h4>Belum ada data Renja</h4>
                    <p>Klik tombol <b>"Buat/Edit Renja"</b> untuk mulai mengisi data.</p>
                </div>
                <?php else: ?>

                <!-- ===================================================== -->
                <!-- NAVIGASI TAHUN -->
                <!-- ===================================================== -->
                <div class="renja-section" style="padding:10px 20px;background:#f8f9fa;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="btn-group btn-group-sm" role="group" id="tahunNav">
                                <?php 
                                $tahun_sekarang = date('Y');
                                $tahun_mulai = $UserTahunMulai ?? ($tahun_sekarang - 4);
                                $tahun_akhir = $UserTahunAkhir ?? $tahun_sekarang;
                                
                                // Tampilkan semua tahun dalam periode
                                for ($t = $tahun_mulai; $t <= $tahun_akhir; $t++): 
                                    $active = ($t == ($Renja['tahun'] ?? $tahun_sekarang)) ? 'active' : '';
                                ?>
                                <button class="btn btn-outline-primary tahun-btn <?= $active ?>" 
                                    data-tahun="<?= $t ?>"
                                    onclick="loadDataTahun(<?= $t ?>)">
                                    <?= $t ?>
                                </button>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <span class="badge badge-info" style="font-size:14px;padding:8px 15px;">
                                <i class="notika-icon notika-calendar"></i> Periode: <?= $tahun_mulai ?> - <?= $tahun_akhir ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ===================================================== -->
                <!-- LOADING -->
                <!-- ===================================================== -->
                <div id="loadingData" style="display:none;">
                    <div class="spinner">⏳</div>
                    <p>Memuat data...</p>
                </div>

                <!-- ===================================================== -->
                <!-- CONTENT DATA -->
                <!-- ===================================================== -->
                <div id="contentData">
                    <!-- 1. VISI & MISI -->
                    <div class="renja-section">
                        <div class="section-title">
                            <span>VISI & MISI</span>
                            <span class="badge badge-primary">Tahun <?= $Renja['tahun'] ?></span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Visi:</strong><br><?= nl2br(htmlspecialchars($Renja['visi'])) ?></p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Misi:</strong><br><?= nl2br(htmlspecialchars($Renja['misi'])) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. PRIORITAS NASIONAL -->
                    <div class="renja-section">
                        <div class="section-title">
                            <span>PRIORITAS NASIONAL</span>
                            <div>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalPrioritas">
                                    <i class="notika-icon notika-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-renja">
                                <thead>
                                    <tr>
                                        <th width="10%">KODE</th>
                                        <th>PRIORITAS</th>
                                        <th width="20%" class="text-right">ALOKASI (RIBU)</th>
                                        <th width="10%" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="prioritasBody">
                                    <?php 
                                    $total_prioritas = 0;
                                    foreach ($PrioritasNasional as $p): 
                                        $total_prioritas += $p['alokasi'];
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($p['kode']) ?></td>
                                        <td><?= htmlspecialchars($p['nama_prioritas']) ?></td>
                                        <td class="text-right uang-besar"><?= number_format($p['alokasi'], 0, ',', '.') ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-xs btn-warning edit-prioritas" 
                                                data-id="<?= $p['id'] ?>"
                                                data-kode="<?= htmlspecialchars($p['kode']) ?>"
                                                data-nama="<?= htmlspecialchars($p['nama_prioritas']) ?>"
                                                data-alokasi="<?= $p['alokasi'] ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-xs btn-danger delete-prioritas" data-id="<?= $p['id'] ?>">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($PrioritasNasional)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada data prioritas nasional</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="total-row">
                                        <td colspan="2" class="text-right"><strong>TOTAL</strong></td>
                                        <td class="text-right uang-besar" id="totalPrioritas"><?= number_format($total_prioritas, 0, ',', '.') ?></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- 3. SASARAN STRATEGIS -->
                    <div class="renja-section">
                        <div class="section-title">
                            <span>SASARAN STRATEGIS DAN INDIKATOR KINERJA</span>
                            <div>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalSasaran">
                                    <i class="notika-icon notika-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-renja">
                                <thead>
                                    <tr>
                                        <th width="8%">KODE</th>
                                        <th>SASARAN STRATEGIS / INDIKATOR KINERJA</th>
                                        <th width="12%" class="text-right">TARGET</th>
                                        <th width="18%" class="text-right">ALOKASI (RIBU)</th>
                                        <th width="10%" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="sasaranBody">
                                    <?php 
                                    $total_sasaran = 0;
                                    foreach ($SasaranStrategis as $s): 
                                        $total_sasaran += $s['alokasi'];
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($s['kode']) ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($s['nama_sasaran']) ?></strong><br>
                                            <small class="text-muted">Indikator: <?= htmlspecialchars($s['indikator_kinerja']) ?></small>
                                        </td>
                                        <td class="text-right"><?= number_format($s['target'], 2, ',', '.') ?></td>
                                        <td class="text-right uang-besar"><?= number_format($s['alokasi'], 0, ',', '.') ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-xs btn-warning edit-sasaran"
                                                data-id="<?= $s['id'] ?>"
                                                data-kode="<?= htmlspecialchars($s['kode']) ?>"
                                                data-nama="<?= htmlspecialchars($s['nama_sasaran']) ?>"
                                                data-indikator="<?= htmlspecialchars($s['indikator_kinerja']) ?>"
                                                data-target="<?= $s['target'] ?>"
                                                data-alokasi="<?= $s['alokasi'] ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-xs btn-danger delete-sasaran" data-id="<?= $s['id'] ?>">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($SasaranStrategis)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada data sasaran strategis</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="total-row">
                                        <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                                        <td class="text-right uang-besar" id="totalSasaran"><?= number_format($total_sasaran, 0, ',', '.') ?></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- 4. PROGRAM DAN PENDANAAN -->
                    <div class="renja-section">
                        <div class="section-title">
                            <span>PROGRAM DAN PENDANAAN</span>
                            <div>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalProgram">
                                    <i class="notika-icon notika-plus"></i> Tambah Program
                                </button>
                            </div>
                        </div>

                        <?php if (!empty($Program)): ?>
                            <?php foreach ($Program as $program): ?>
                            <?php 
                            $total_program = 0;
                            $pendanaan_by_year = [];
                            foreach ($program['pendanaan'] as $pd) {
                                $pendanaan_by_year[$pd['tahun']] = $pd;
                                $total_program += $pd['total'];
                            }
                            ?>
                            <div class="program-card">
                                <div class="collapse-toggle" data-toggle="collapse" data-target="#program_<?= $program['id'] ?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong><?= htmlspecialchars($program['kode_program']) ?></strong>
                                        </div>
                                        <div class="col-md-5">
                                            <?= htmlspecialchars($program['nama_program']) ?>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <span class="badge badge-info">Total: Rp <?= number_format($total_program, 0, ',', '.') ?></span>
                                            <i class="notika-icon notika-arrow-down" style="margin-left:10px;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="program_<?= $program['id'] ?>">
                                    <div class="table-responsive" style="margin-top:10px;">
                                        <table class="table table-bordered table-renja program-sub-table">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" width="10%">TAHUN</th>
                                                    <th colspan="10" class="text-center">SUMBER DANA</th>
                                                    <th rowspan="2" width="15%" class="text-right">TOTAL</th>
                                                    <th rowspan="2" width="8%" class="text-center">AKSI</th>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $sources = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
                                                $grand_total = 0;
                                                
                                                foreach ($program['pendanaan'] as $pd):
                                                    $grand_total += $pd['total'];
                                                ?>
                                                <tr>
                                                    <td><?= $pd['tahun'] ?></td>
                                                    <?php foreach ($sources as $src): ?>
                                                    <td class="text-right uang"><?= number_format($pd[$src] ?? 0, 0, ',', '.') ?></td>
                                                    <?php endforeach; ?>
                                                    <td class="text-right uang-besar"><?= number_format($pd['total'], 0, ',', '.') ?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-xs btn-warning edit-pendanaan"
                                                            data-id="<?= $pd['id'] ?>"
                                                            data-id_program="<?= $program['id'] ?>"
                                                            data-tahun="<?= $pd['tahun'] ?>"
                                                            <?php foreach ($sources as $src): ?>
                                                            data-<?= $src ?>="<?= $pd[$src] ?? 0 ?>"
                                                            <?php endforeach; ?>>
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>
                                                        <button class="btn btn-xs btn-danger delete-pendanaan" data-id="<?= $pd['id'] ?>">
                                                            <i class="notika-icon notika-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                
                                                <?php if (empty($program['pendanaan'])): ?>
                                                <tr>
                                                    <td colspan="12" class="text-center text-muted">Belum ada data pendanaan</td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="total-row">
                                                    <td><strong>TOTAL</strong></td>
                                                    <?php 
                                                    $totals = array_fill_keys($sources, 0);
                                                    foreach ($program['pendanaan'] as $pd) {
                                                        foreach ($sources as $src) {
                                                            $totals[$src] += $pd[$src] ?? 0;
                                                        }
                                                    }
                                                    foreach ($sources as $src): 
                                                    ?>
                                                    <td class="text-right uang-besar"><?= number_format($totals[$src], 0, ',', '.') ?></td>
                                                    <?php endforeach; ?>
                                                    <td class="text-right uang-besar" style="font-size:16px;">
                                                        <?= number_format($grand_total, 0, ',', '.') ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="text-right" style="margin-top:10px;">
                                        <button class="btn btn-xs btn-primary add-pendanaan" 
                                            data-id_program="<?= $program['id'] ?>"
                                            data-kode="<?= htmlspecialchars($program['kode_program']) ?>">
                                            <i class="notika-icon notika-plus"></i> Tambah Pendanaan
                                        </button>
                                        <button class="btn btn-xs btn-danger delete-program" data-id="<?= $program['id'] ?>">
                                            <i class="notika-icon notika-trash"></i> Hapus Program
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <div class="alert alert-info text-center">
                            Belum ada program. Klik <b>"Tambah Program"</b> untuk mulai mengisi.
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- 5. REKAPITULASI AKHIR -->
                    <div class="renja-section" style="background:#f8faff;">
                        <div class="section-title">
                            <span>REKAPITULASI ANGGARAN</span>
                            <span class="badge badge-success">Total Akumulasi</span>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card" style="padding:15px;text-align:center;border:1px solid #e0e0e0;border-radius:5px;">
                                    <small class="text-muted">Prioritas Nasional</small>
                                    <h3 class="uang-besar" id="rekapPrioritas"><?= number_format($total_prioritas, 0, ',', '.') ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="padding:15px;text-align:center;border:1px solid #e0e0e0;border-radius:5px;">
                                    <small class="text-muted">Sasaran Strategis</small>
                                    <h3 class="uang-besar" id="rekapSasaran"><?= number_format($total_sasaran, 0, ',', '.') ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="padding:15px;text-align:center;border:1px solid #e0e0e0;border-radius:5px;background:#e8f5e9;">
                                    <small class="text-muted">Total Program & Pendanaan</small>
                                    <h3 class="uang-besar" id="rekapProgram">
                                        <?php 
                                        $total_all_program = 0;
                                        foreach ($Program as $p) {
                                            foreach ($p['pendanaan'] as $pd) {
                                                $total_all_program += $pd['total'];
                                            }
                                        }
                                        echo number_format($total_all_program, 0, ',', '.');
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODALS -->
<!-- ============================================================ -->

<!-- Modal Renja -->
<div class="modal fade" id="ModalRenja" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Data Renja K/L - Rekap 1</h4>
            </div>
            <div class="modal-body">
                <form id="FormRenja">
                    <input type="hidden" name="id" id="RenjaId" value="<?= $Renja['id'] ?? '' ?>">
                    <div class="form-group">
                        <label><b>Tahun Anggaran</b></label>
                        <input type="number" class="form-control" name="tahun" id="RenjaTahun" 
                            value="<?= $Renja['tahun'] ?? date('Y') ?>" min="2020" max="2045" required>
                    </div>
                    <div class="form-group">
                        <label><b>Visi</b></label>
                        <textarea class="form-control" name="visi" id="RenjaVisi" rows="3" required><?= htmlspecialchars($Renja['visi'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><b>Misi</b></label>
                        <textarea class="form-control" name="misi" id="RenjaMisi" rows="3" required><?= htmlspecialchars($Renja['misi'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Prioritas Nasional -->
<div class="modal fade" id="ModalPrioritas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="PrioritasTitle">Tambah Prioritas Nasional</h4>
            </div>
            <div class="modal-body">
                <form id="FormPrioritas">
                    <input type="hidden" name="id" id="PrioritasId">
                    <input type="hidden" name="id_renja" id="PrioritasRenjaId" value="<?= $Renja['id'] ?? '' ?>">
                    <div class="form-group">
                        <label><b>Kode Prioritas</b></label>
                        <input type="text" class="form-control" name="kode" id="PrioritasKode" required maxlength="10">
                        <small class="text-muted">Contoh: 01, 02, 03, dst</small>
                    </div>
                    <div class="form-group">
                        <label><b>Nama Prioritas</b></label>
                        <input type="text" class="form-control" name="nama_prioritas" id="PrioritasNama" required>
                    </div>
                    <div class="form-group">
                        <label><b>Alokasi (Ribu Rupiah)</b></label>
                        <input type="number" class="form-control" name="alokasi" id="PrioritasAlokasi" value="0" step="1000">
                        <small class="text-muted">Masukkan dalam ribuan rupiah</small>
                    </div>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sasaran Strategis -->
<div class="modal fade" id="ModalSasaran" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="SasaranTitle">Tambah Sasaran Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="FormSasaran">
                    <input type="hidden" name="id" id="SasaranId">
                    <input type="hidden" name="id_renja" id="SasaranRenjaId" value="<?= $Renja['id'] ?? '' ?>">
                    <div class="form-group">
                        <label><b>Kode</b></label>
                        <input type="text" class="form-control" name="kode" id="SasaranKode" required maxlength="10">
                        <small class="text-muted">Contoh: 01, 02, 03, dst</small>
                    </div>
                    <div class="form-group">
                        <label><b>Nama Sasaran Strategis</b></label>
                        <input type="text" class="form-control" name="nama_sasaran" id="SasaranNama" required>
                    </div>
                    <div class="form-group">
                        <label><b>Indikator Kinerja</b></label>
                        <input type="text" class="form-control" name="indikator_kinerja" id="SasaranIndikator" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Target</b></label>
                                <input type="number" class="form-control" name="target" id="SasaranTarget" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Alokasi (Ribu Rupiah)</b></label>
                                <input type="number" class="form-control" name="alokasi" id="SasaranAlokasi" value="0" step="1000">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Program -->
<div class="modal fade" id="ModalProgram" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Program</h4>
            </div>
            <div class="modal-body">
                <form id="FormProgram">
                    <input type="hidden" name="id" id="ProgramId">
                    <input type="hidden" name="id_renja" id="ProgramRenjaId" value="<?= $Renja['id'] ?? '' ?>">
                    <div class="form-group">
                        <label><b>Kode Program</b></label>
                        <input type="text" class="form-control" name="kode_program" id="ProgramKode" required maxlength="20">
                        <small class="text-muted">Contoh: 027.DQ, 027.WA</small>
                    </div>
                    <div class="form-group">
                        <label><b>Nama Program</b></label>
                        <input type="text" class="form-control" name="nama_program" id="ProgramNama" required>
                    </div>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pendanaan -->
<div class="modal fade" id="ModalPendanaan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Pendanaan Program</h4>
            </div>
            <div class="modal-body">
                <form id="FormPendanaan">
                    <input type="hidden" name="id" id="PendanaanId">
                    <input type="hidden" name="id_program" id="PendanaanIdProgram" required>
                    
                    <div class="form-group">
                        <label><b>Tahun</b></label>
                        <input type="number" class="form-control" name="tahun" id="PendanaanTahun" min="2020" max="2045" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12"><h5>Sumber Dana</h5></div>
                        <?php 
                        $sumber_dana = [
                            'rpp' => 'RPP',
                            'nbp' => 'NBP',
                            'blu' => 'BLU',
                            'ln' => 'LN',
                            'rm' => 'RM',
                            'ppdn' => 'PPDN',
                            'hibah' => 'HIBAH',
                            'phbs' => 'PHBS',
                            'snh' => 'SNH',
                            'nt' => 'NT'
                        ];
                        foreach ($sumber_dana as $key => $label): 
                        ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><b><?= $label ?></b></label>
                                <input type="number" class="form-control sumber-dana-input" 
                                    name="<?= $key ?>" id="Pendanaan<?= strtoupper($key) ?>" 
                                    value="0" step="1000">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="form-group" style="background:#f0f7ff;padding:15px;border-radius:5px;">
                        <label><b>TOTAL</b></label>
                        <input type="text" class="form-control" id="PendanaanTotal" readonly style="font-weight:700;font-size:18px;background:#fff;">
                    </div>
                    
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- SCRIPTS -->
<!-- ============================================================ -->

<!-- 1. jQuery -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>

<!-- 2. Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>

<!-- 3. Main JS -->
<script src="<?= base_url('js/main.js'); ?>"></script>

<!-- 4. Script Utama -->
<script>
var BaseURL = '<?= base_url() ?>';
var IdRenja = <?= json_encode($Renja['id'] ?? null) ?>;
var CurrentTahun = <?= json_encode($Renja['tahun'] ?? date('Y')) ?>;

// ============================================================
// FUNGSI UTILITY
// ============================================================
function formatNumber(num, decimals = 0) {
    if (num === null || num === undefined) return '0';
    return Number(num).toLocaleString('id-ID', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals
    });
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function nl2br(text) {
    if (!text) return '';
    return text.replace(/\n/g, '<br>');
}

// ============================================================
// FUNGSI LOAD DATA PER TAHUN
// ============================================================
function loadDataTahun(tahun) {
    // Show loading
    $('#loadingData').show();
    $('#contentData').hide();
    
    // Update active button
    $('.tahun-btn').removeClass('active');
    $('.tahun-btn[data-tahun="' + tahun + '"]').addClass('active');
    
    $.ajax({
        url: BaseURL + "Kementerian/renja_get_by_tahun",
        type: "POST",
        data: {tahun: tahun},
        dataType: "json",
        success: function(res) {
            $('#loadingData').hide();
            
            if (res.success) {
                CurrentTahun = tahun;
                renderData(res.data);
                $('#contentData').show();
            } else {
                $('#contentData').html('<div class="alert alert-warning">' + res.message + '</div>');
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
// FUNGSI RENDER DATA
// ============================================================
function renderData(data) {
    var html = '';
    
    // 1. VISI & MISI
    html += '<div class="renja-section">';
    html += '<div class="section-title"><span>VISI & MISI</span><span class="badge badge-primary">Tahun ' + data.renja.tahun + '</span></div>';
    html += '<div class="row">';
    html += '<div class="col-md-12"><p><strong>Visi:</strong><br>' + nl2br(escapeHtml(data.renja.visi)) + '</p></div>';
    html += '<div class="col-md-12"><p><strong>Misi:</strong><br>' + nl2br(escapeHtml(data.renja.misi)) + '</p></div>';
    html += '</div></div>';
    
    // 2. PRIORITAS NASIONAL
    html += '<div class="renja-section">';
    html += '<div class="section-title"><span>PRIORITAS NASIONAL</span>';
    html += '<div><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalPrioritas"><i class="notika-icon notika-plus"></i> Tambah</button></div></div>';
    html += '<div class="table-responsive"><table class="table table-bordered table-renja">';
    html += '<thead><tr><th width="10%">KODE</th><th>PRIORITAS</th><th width="20%" class="text-right">ALOKASI (RIBU)</th><th width="10%" class="text-center">AKSI</th></tr></thead>';
    html += '<tbody>';
    
    if (data.prioritas && data.prioritas.length > 0) {
        data.prioritas.forEach(function(p) {
            html += '<tr>';
            html += '<td>' + escapeHtml(p.kode) + '</td>';
            html += '<td>' + escapeHtml(p.nama_prioritas) + '</td>';
            html += '<td class="text-right uang-besar">' + formatNumber(p.alokasi) + '</td>';
            html += '<td class="text-center">';
            html += '<button class="btn btn-xs btn-warning edit-prioritas" data-id="' + p.id + '" data-kode="' + escapeHtml(p.kode) + '" data-nama="' + escapeHtml(p.nama_prioritas) + '" data-alokasi="' + p.alokasi + '"><i class="notika-icon notika-edit"></i></button> ';
            html += '<button class="btn btn-xs btn-danger delete-prioritas" data-id="' + p.id + '"><i class="notika-icon notika-trash"></i></button>';
            html += '</td></tr>';
        });
    } else {
        html += '<tr><td colspan="4" class="text-center text-muted">Belum ada data prioritas nasional</td></tr>';
    }
    
    html += '</tbody>';
    html += '<tfoot><tr class="total-row"><td colspan="2" class="text-right"><strong>TOTAL</strong></td>';
    html += '<td class="text-right uang-besar">' + formatNumber(data.total_prioritas) + '</td><td></td></tr></tfoot>';
    html += '</table></div></div>';
    
    // 3. SASARAN STRATEGIS
    html += '<div class="renja-section">';
    html += '<div class="section-title"><span>SASARAN STRATEGIS DAN INDIKATOR KINERJA</span>';
    html += '<div><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalSasaran"><i class="notika-icon notika-plus"></i> Tambah</button></div></div>';
    html += '<div class="table-responsive"><table class="table table-bordered table-renja">';
    html += '<thead><tr><th width="8%">KODE</th><th>SASARAN STRATEGIS / INDIKATOR KINERJA</th><th width="12%" class="text-right">TARGET</th><th width="18%" class="text-right">ALOKASI (RIBU)</th><th width="10%" class="text-center">AKSI</th></tr></thead>';
    html += '<tbody>';
    
    if (data.sasaran && data.sasaran.length > 0) {
        data.sasaran.forEach(function(s) {
            html += '<tr>';
            html += '<td>' + escapeHtml(s.kode) + '</td>';
            html += '<td><strong>' + escapeHtml(s.nama_sasaran) + '</strong><br><small class="text-muted">Indikator: ' + escapeHtml(s.indikator_kinerja) + '</small></td>';
            html += '<td class="text-right">' + formatNumber(s.target, 2) + '</td>';
            html += '<td class="text-right uang-besar">' + formatNumber(s.alokasi) + '</td>';
            html += '<td class="text-center">';
            html += '<button class="btn btn-xs btn-warning edit-sasaran" data-id="' + s.id + '" data-kode="' + escapeHtml(s.kode) + '" data-nama="' + escapeHtml(s.nama_sasaran) + '" data-indikator="' + escapeHtml(s.indikator_kinerja) + '" data-target="' + s.target + '" data-alokasi="' + s.alokasi + '"><i class="notika-icon notika-edit"></i></button> ';
            html += '<button class="btn btn-xs btn-danger delete-sasaran" data-id="' + s.id + '"><i class="notika-icon notika-trash"></i></button>';
            html += '</td></tr>';
        });
    } else {
        html += '<tr><td colspan="5" class="text-center text-muted">Belum ada data sasaran strategis</td></tr>';
    }
    
    html += '</tbody>';
    html += '<tfoot><tr class="total-row"><td colspan="3" class="text-right"><strong>TOTAL</strong></td>';
    html += '<td class="text-right uang-besar">' + formatNumber(data.total_sasaran) + '</td><td></td></tr></tfoot>';
    html += '</table></div></div>';
    
    // 4. PROGRAM DAN PENDANAAN
    html += '<div class="renja-section">';
    html += '<div class="section-title"><span>PROGRAM DAN PENDANAAN</span>';
    html += '<div><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalProgram"><i class="notika-icon notika-plus"></i> Tambah Program</button></div></div>';
    
    if (data.program && data.program.length > 0) {
        data.program.forEach(function(program) {
            var total_program = 0;
            if (program.pendanaan) {
                program.pendanaan.forEach(function(pd) {
                    total_program += parseFloat(pd.total) || 0;
                });
            }
            
            html += '<div class="program-card">';
            html += '<div class="collapse-toggle" data-toggle="collapse" data-target="#program_' + program.id + '">';
            html += '<div class="row"><div class="col-md-3"><strong>' + escapeHtml(program.kode_program) + '</strong></div>';
            html += '<div class="col-md-5">' + escapeHtml(program.nama_program) + '</div>';
            html += '<div class="col-md-4 text-right"><span class="badge badge-info">Total: Rp ' + formatNumber(total_program) + '</span> <i class="notika-icon notika-arrow-down" style="margin-left:10px;"></i></div></div>';
            html += '</div>';
            
            html += '<div class="collapse" id="program_' + program.id + '">';
            html += '<div class="table-responsive" style="margin-top:10px;">';
            html += '<table class="table table-bordered table-renja program-sub-table">';
            html += '<thead><tr><th rowspan="2" width="10%">TAHUN</th><th colspan="10" class="text-center">SUMBER DANA</th><th rowspan="2" width="15%" class="text-right">TOTAL</th><th rowspan="2" width="8%" class="text-center">AKSI</th></tr>';
            html += '<tr><th class="text-right">RPP</th><th class="text-right">NBP</th><th class="text-right">BLU</th><th class="text-right">LN</th><th class="text-right">RM</th><th class="text-right">PPDN</th><th class="text-right">HIBAH</th><th class="text-right">PHBS</th><th class="text-right">SNH</th><th class="text-right">NT</th></tr></thead>';
            html += '<tbody>';
            
            var sources = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
            var grand_total = 0;
            
            if (program.pendanaan && program.pendanaan.length > 0) {
                program.pendanaan.forEach(function(pd) {
                    grand_total += parseFloat(pd.total) || 0;
                    html += '<tr><td>' + pd.tahun + '</td>';
                    sources.forEach(function(src) {
                        var val = pd[src] || 0;
                        html += '<td class="text-right uang">' + formatNumber(val) + '</td>';
                    });
                    html += '<td class="text-right uang-besar">' + formatNumber(pd.total) + '</td>';
                    html += '<td class="text-center">';
                    html += '<button class="btn btn-xs btn-warning edit-pendanaan" data-id="' + pd.id + '" data-id_program="' + program.id + '" data-tahun="' + pd.tahun + '"';
                    sources.forEach(function(src) {
                        html += ' data-' + src + '="' + (pd[src] || 0) + '"';
                    });
                    html += '><i class="notika-icon notika-edit"></i></button> ';
                    html += '<button class="btn btn-xs btn-danger delete-pendanaan" data-id="' + pd.id + '"><i class="notika-icon notika-trash"></i></button>';
                    html += '</td></tr>';
                });
            } else {
                html += '<tr><td colspan="12" class="text-center text-muted">Belum ada data pendanaan</td></tr>';
            }
            
            html += '</tbody>';
            html += '<tfoot><tr class="total-row"><td><strong>TOTAL</strong></td>';
            var totals = {};
            sources.forEach(function(src) { totals[src] = 0; });
            if (program.pendanaan) {
                program.pendanaan.forEach(function(pd) {
                    sources.forEach(function(src) {
                        totals[src] += parseFloat(pd[src]) || 0;
                    });
                });
            }
            sources.forEach(function(src) {
                html += '<td class="text-right uang-besar">' + formatNumber(totals[src]) + '</td>';
            });
            html += '<td class="text-right uang-besar" style="font-size:16px;">' + formatNumber(grand_total) + '</td><td></td></tr></tfoot>';
            html += '</table></div>';
            html += '<div class="text-right" style="margin-top:10px;">';
            html += '<button class="btn btn-xs btn-primary add-pendanaan" data-id_program="' + program.id + '" data-kode="' + escapeHtml(program.kode_program) + '"><i class="notika-icon notika-plus"></i> Tambah Pendanaan</button> ';
            html += '<button class="btn btn-xs btn-danger delete-program" data-id="' + program.id + '"><i class="notika-icon notika-trash"></i> Hapus Program</button>';
            html += '</div></div></div>';
        });
    } else {
        html += '<div class="alert alert-info text-center">Belum ada program. Klik <b>"Tambah Program"</b> untuk mulai mengisi.</div>';
    }
    
    html += '</div>';
    
    // 5. REKAPITULASI
    html += '<div class="renja-section" style="background:#f8faff;">';
    html += '<div class="section-title"><span>REKAPITULASI ANGGARAN</span><span class="badge badge-success">Total Akumulasi</span></div>';
    html += '<div class="row">';
    html += '<div class="col-md-4"><div class="card" style="padding:15px;text-align:center;border:1px solid #e0e0e0;border-radius:5px;"><small class="text-muted">Prioritas Nasional</small><h3 class="uang-besar">' + formatNumber(data.total_prioritas) + '</h3></div></div>';
    html += '<div class="col-md-4"><div class="card" style="padding:15px;text-align:center;border:1px solid #e0e0e0;border-radius:5px;"><small class="text-muted">Sasaran Strategis</small><h3 class="uang-besar">' + formatNumber(data.total_sasaran) + '</h3></div></div>';
    html += '<div class="col-md-4"><div class="card" style="padding:15px;text-align:center;border:1px solid #e0e0e0;border-radius:5px;background:#e8f5e9;"><small class="text-muted">Total Program & Pendanaan</small><h3 class="uang-besar">' + formatNumber(data.total_pendanaan) + '</h3></div></div>';
    html += '</div></div>';
    
    $('#contentData').html(html);
    
    // Re-inisialisasi event listener
    initEventListeners();
}

// ============================================================
// INISIALISASI EVENT LISTENERS
// ============================================================
function initEventListeners() {
    // Collapse toggle
    $('.collapse-toggle').off('click').on('click', function() {
        var target = $(this).data('target');
        $(target).collapse('toggle');
    });
}

// ============================================================
// FUNGSI AKUMULASI
// ============================================================
window.loadAkumulasi = function() {
    if (!IdRenja) {
        $('#akumulasiContainer').html('<div class="alert alert-warning">Data Renja belum dibuat</div>');
        return;
    }
    
    $.ajax({
        url: BaseURL + "Kementerian/renja_akumulasi",
        type: "POST",
        data: {id_renja: IdRenja},
        dataType: "json",
        success: function(res) {
            if (res.success) {
                var html = '<div class="akumulasi-box">';
                html += '<div class="item"><div class="label">Total Prioritas Nasional</div><div class="value">Rp ' + Number(res.data.total_prioritas).toLocaleString('id-ID') + '</div></div>';
                html += '<div class="item"><div class="label">Total Sasaran Strategis</div><div class="value">Rp ' + Number(res.data.total_sasaran).toLocaleString('id-ID') + '</div></div>';
                html += '<div class="item"><div class="label">Total Pendanaan Program</div><div class="value">Rp ' + Number(res.data.total_pendanaan).toLocaleString('id-ID') + '</div></div>';
                html += '</div>';
                $('#akumulasiContainer').html(html);
            } else {
                $('#akumulasiContainer').html('<div class="alert alert-danger">' + res.message + '</div>');
            }
        },
        error: function(xhr, status, error) {
            $('#akumulasiContainer').html('<div class="alert alert-danger">Gagal menghubungi server: ' + error + '</div>');
        }
    });
};

// ============================================================
// DOCUMENT READY
// ============================================================
$(document).ready(function() {
    console.log('Renja Rekap 1 - Document Ready');
    console.log('IdRenja:', IdRenja);
    console.log('CurrentTahun:', CurrentTahun);
    
    // Auto load akumulasi
    if (IdRenja) {
        loadAkumulasi();
    }
    
    // ============================================================
    // RENJA - CRUD
    // ============================================================
    $("#FormRenja").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: BaseURL + "Kementerian/renja_save",
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
    // PRIORITAS NASIONAL - CRUD
    // ============================================================
    $("#FormPrioritas").submit(function(e) {
        e.preventDefault();
        
        var kode = $('#PrioritasKode').val().trim();
        var nama = $('#PrioritasNama').val().trim();
        var alokasi = $('#PrioritasAlokasi').val();
        
        if (!kode) { alert('Kode Prioritas wajib diisi!'); return; }
        if (!nama) { alert('Nama Prioritas wajib diisi!'); return; }
        if (!alokasi || isNaN(alokasi)) { alert('Alokasi harus diisi dengan angka!'); return; }
        
        var formData = $(this).serialize();
        $.ajax({
            url: BaseURL + "Kementerian/renja_prioritas_save",
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
        $('#PrioritasAlokasi').val(btn.data('alokasi'));
        $('#PrioritasTitle').text('Edit Prioritas Nasional');
        $('#ModalPrioritas').modal('show');
    });

    $(document).on('click', '.delete-prioritas', function() {
        var id = $(this).data('id');
        if (confirm('Yakin hapus data prioritas ini?')) {
            $.ajax({
                url: BaseURL + "Kementerian/renja_prioritas_delete",
                type: "POST",
                data: {id: id},
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
        }
    });

    $('#ModalPrioritas').on('hidden.bs.modal', function() {
        $('#PrioritasId').val('');
        $('#PrioritasKode').val('');
        $('#PrioritasNama').val('');
        $('#PrioritasAlokasi').val('0');
        $('#PrioritasTitle').text('Tambah Prioritas Nasional');
    });

    // ============================================================
    // SASARAN STRATEGIS - CRUD
    // ============================================================
    $("#FormSasaran").submit(function(e) {
        e.preventDefault();
        
        var kode = $('#SasaranKode').val().trim();
        var nama = $('#SasaranNama').val().trim();
        var indikator = $('#SasaranIndikator').val().trim();
        
        if (!kode) { alert('Kode Sasaran wajib diisi!'); return; }
        if (!nama) { alert('Nama Sasaran wajib diisi!'); return; }
        if (!indikator) { alert('Indikator Kinerja wajib diisi!'); return; }
        
        var formData = $(this).serialize();
        $.ajax({
            url: BaseURL + "Kementerian/renja_sasaran_save",
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
        $('#SasaranTitle').text('Edit Sasaran Strategis');
        $('#ModalSasaran').modal('show');
    });

    $(document).on('click', '.delete-sasaran', function() {
        var id = $(this).data('id');
        if (confirm('Yakin hapus data sasaran ini?')) {
            $.ajax({
                url: BaseURL + "Kementerian/renja_sasaran_delete",
                type: "POST",
                data: {id: id},
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
        }
    });

    $('#ModalSasaran').on('hidden.bs.modal', function() {
        $('#SasaranId').val('');
        $('#SasaranKode').val('');
        $('#SasaranNama').val('');
        $('#SasaranIndikator').val('');
        $('#SasaranTarget').val('');
        $('#SasaranAlokasi').val('0');
        $('#SasaranTitle').text('Tambah Sasaran Strategis');
    });

    // ============================================================
    // PROGRAM - CRUD
    // ============================================================
    $("#FormProgram").submit(function(e) {
        e.preventDefault();
        
        var kode = $('#ProgramKode').val().trim();
        var nama = $('#ProgramNama').val().trim();
        
        if (!kode) { alert('Kode Program wajib diisi!'); return; }
        if (!nama) { alert('Nama Program wajib diisi!'); return; }
        
        var formData = $(this).serialize();
        $.ajax({
            url: BaseURL + "Kementerian/renja_program_save",
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

    $(document).on('click', '.delete-program', function() {
        var id = $(this).data('id');
        if (confirm('Yakin hapus program ini? Data pendanaan akan terhapus juga.')) {
            $.ajax({
                url: BaseURL + "Kementerian/renja_program_delete",
                type: "POST",
                data: {id: id},
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
        }
    });

    // ============================================================
    // PENDANAAN - CRUD
    // ============================================================
    $(document).on('click', '.add-pendanaan', function() {
        var id_program = $(this).data('id_program');
        var kode_program = $(this).data('kode') || '';
        
        $('#PendanaanId').val('');
        $('#PendanaanIdProgram').val(id_program);
        $('#PendanaanTahun').val(CurrentTahun);
        $('.sumber-dana-input').val(0);
        updateTotalPendanaan();
        $('#ModalPendanaan').modal('show');
    });

    $(document).on('click', '.edit-pendanaan', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: BaseURL + "Kementerian/renja_pendanaan_get",
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    $('#PendanaanId').val(data.id);
                    $('#PendanaanIdProgram').val(data.id_program);
                    $('#PendanaanTahun').val(data.tahun);
                    
                    var sources = ['rpp', 'nbp', 'blu', 'ln', 'rm', 'ppdn', 'hibah', 'phbs', 'snh', 'nt'];
                    sources.forEach(function(src) {
                        var val = data[src] || 0;
                        $('#Pendanaan' + src.toUpperCase()).val(val);
                    });
                    
                    updateTotalPendanaan();
                    $('#ModalPendanaan').modal('show');
                } else {
                    alert('Error: ' + res.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Gagal mengambil data: ' + error);
                console.log(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delete-pendanaan', function() {
        var id = $(this).data('id');
        if (confirm('Yakin hapus data pendanaan ini?')) {
            $.ajax({
                url: BaseURL + "Kementerian/renja_pendanaan_delete",
                type: "POST",
                data: {id: id},
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
        }
    });

    $("#FormPendanaan").submit(function(e) {
        e.preventDefault();
        
        var id_program = $('#PendanaanIdProgram').val();
        var tahun = $('#PendanaanTahun').val();
        
        if (!id_program || isNaN(id_program)) {
            alert('ID Program tidak valid!');
            return;
        }
        if (!tahun || isNaN(tahun) || tahun.length != 4) {
            alert('Tahun harus 4 digit!');
            return;
        }
        
        var formData = $(this).serialize();
        $.ajax({
            url: BaseURL + "Kementerian/renja_pendanaan_save",
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

    $(document).on('input', '.sumber-dana-input', function() {
        updateTotalPendanaan();
    });

    function updateTotalPendanaan() {
        var total = 0;
        $('.sumber-dana-input').each(function() {
            var val = parseFloat($(this).val()) || 0;
            total += val;
        });
        $('#PendanaanTotal').val('Rp ' + total.toLocaleString('id-ID'));
    }

    $('#ModalPendanaan').on('hidden.bs.modal', function() {
        $('#PendanaanId').val('');
        $('#PendanaanIdProgram').val('');
        $('#PendanaanTahun').val('');
        $('.sumber-dana-input').val(0);
        updateTotalPendanaan();
    });

    // ============================================================
    // COLLAPSE TOGGLE
    // ============================================================
    $('.collapse-toggle').on('click', function() {
        var target = $(this).data('target');
        $(target).collapse('toggle');
    });

    console.log('Renja Rekap 1 - All scripts loaded successfully');
});
</script>