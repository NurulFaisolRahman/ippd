<?php
if (!function_exists('format_rumus_rpjmd')) {
    function format_rumus_rpjmd($rumus) {
        if (empty($rumus)) return '';
        $escaped = htmlspecialchars($rumus, ENT_QUOTES, 'UTF-8');
        $formatted = str_replace(
            ['&lt;sup&gt;', '&lt;/sup&gt;', '&lt;sub&gt;', '&lt;/sub&gt;'],
            ['<sup>', '</sup>', '<sub>', '</sub>'],
            $escaped
        );
        $formatted = preg_replace('/\^\{([^\}]+)\}/', '<sup>$1</sup>', $formatted);
        $formatted = preg_replace('/\^\(([^\)]+)\)/', '<sup>$1</sup>', $formatted);
        $formatted = preg_replace('/\^([0-9a-zA-Z\+\-\*\/]+)/', '<sup>$1</sup>', $formatted);
        $formatted = preg_replace('/\_\{([^\}]+)\}/', '<sub>$1</sub>', $formatted);
        $formatted = preg_replace('/\_\(([^\)]+)\)/', '<sub>$1</sub>', $formatted);
        $formatted = preg_replace('/\_([a-zA-Z0-9\+\-]+)/', '<sub>$1</sub>', $formatted);
        return nl2br($formatted);
    }
}

if (!function_exists('format_target_koma')) {
    function format_target_koma($v) {
        if ($v === null || $v === '') return '-';
        $str = trim((string)$v);
        if ($str === '' || $str === '-') return '-';
        return html_escape(str_replace('.', ',', $str));
    }
}

if (!function_exists('hitung_persen_capaian')) {
    function hitung_persen_capaian($target, $realisasi) {
        if ($target === null || $target === '' || $realisasi === null || $realisasi === '') return null;
        $t = (float)$target;
        $r = (float)$realisasi;
        if ($t <= 0) return null;
        return round(($r / $t) * 100, 1);
    }
}
?>
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* Layout Offset agar tidak tertimpa sidebar */
.main-content {
    margin-left: var(--sidebar-width, 280px) !important;
    padding: 24px 28px 60px 28px !important;
    min-height: calc(100vh - 64px) !important;
    transition: all var(--transition-speed, 0.3s) ease;
    box-sizing: border-box !important;
    width: auto !important;
}

.sidebar-mini .main-content {
    margin-left: var(--sidebar-mini-width, 70px) !important;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0 !important;
        padding: 15px 12px !important;
    }
}

.data-table-list-full {
    border-radius: 14px !important;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06) !important;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    padding: 24px 28px !important;
    width: 100% !important;
}

/* Header & Controls */
.capaian-header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 22px;
    padding-bottom: 18px;
    border-bottom: 1px solid #e2e8f0;
}
.capaian-title h3 {
    font-size: 21px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}
.capaian-title p {
    margin: 6px 0 0 0;
    font-size: 13px;
    color: #64748b;
}

/* Integrated Filter Bar */
.filter-card-integrated {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 20px;
}
.filter-card-integrated .filter-label {
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.filter-card-integrated .form-control {
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    font-size: 13px;
    height: 40px;
    box-shadow: none;
    transition: all 0.2s ease;
}
.filter-card-integrated .form-control:focus {
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
}
.btn-filter-act {
    height: 40px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.2s ease;
}

/* Summary Chips & Legend */
.stats-summary-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 20px;
    padding: 10px 14px;
    background: #f1f5f9;
    border-radius: 10px;
}
.stats-chips-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
}
.stat-chip {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    color: #334155;
}
.stat-chip .chip-dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
}
.stat-chip .chip-count {
    background: #f8fafc;
    padding: 2px 7px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    border: 1px solid #e2e8f0;
}
.legend-group {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 12px;
    color: #475569;
}
.legend-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
}
.legend-box {
    width: 14px;
    height: 14px;
    border-radius: 4px;
    display: inline-block;
}

/* Tabel Utama Capaian IKK */
.table-capaian-ikk {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px;
    overflow: hidden;
    font-size: 12.5px;
}
.table-capaian-ikk thead tr th {
    background: #f8fafc !important;
    color: #334155 !important;
    font-weight: 700 !important;
    font-size: 12px !important;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    padding: 13px 8px !important;
    border-bottom: 2px solid #cbd5e1 !important;
    border-right: 1px solid #e2e8f0 !important;
    vertical-align: middle !important;
    text-align: center;
}
.table-capaian-ikk thead tr th:last-child {
    border-right: none !important;
}
.th-year-group {
    background: #f1f5f9 !important;
    color: #0f172a !important;
    font-weight: 800 !important;
    border-right: 1.5px solid #cbd5e1 !important;
}
.table-capaian-ikk tbody td {
    padding: 11px 8px !important;
    border-top: 1px solid #f1f5f9 !important;
    border-right: 1px solid #f1f5f9 !important;
    vertical-align: middle !important;
    color: #1e293b;
    line-height: 1.45;
}
.table-capaian-ikk tbody td:last-child {
    border-right: none !important;
}
.table-capaian-ikk tbody tr:hover td {
    background-color: #f8fafc !important;
}

/* Kolom Angka Target & Realisasi: Terpisah Jelas Namun Tanpa Nama Kolom */
.td-target-num {
    background-color: #f8fafc;
    font-weight: 700;
    color: #0369a1;
    font-family: 'Consolas', 'Roboto Mono', monospace;
    font-size: 12px;
    border-right: 1px dashed #cbd5e1 !important;
    min-width: 58px;
    width: 62px;
    text-align: center;
}
.td-realisasi-num {
    background-color: #ffffff;
    font-weight: 700;
    font-family: 'Consolas', 'Roboto Mono', monospace;
    font-size: 12px;
    border-right: 1.5px solid #cbd5e1 !important;
    min-width: 62px;
    width: 68px;
    text-align: center;
}
.badge-realisasi-val {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 6px;
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
    font-weight: 700;
}
.val-realisasi-empty {
    color: #cbd5e1;
    font-weight: normal;
}
.badge-capaian-pct {
    display: block;
    font-size: 10px;
    font-weight: 700;
    margin-top: 3px;
    padding: 1px 4px;
    border-radius: 4px;
    font-family: sans-serif;
}
.pct-high { color: #047857; background: #d1fae5; }
.pct-mid { color: #b45309; background: #fef3c7; }
.pct-low { color: #b91c1c; background: #fee2e2; }

/* Rumus & Definisi */
.rumus-tag-wrapper {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-left: 3px solid #0284c7;
    border-radius: 6px;
    padding: 5px 8px;
    font-size: 11px;
    color: #334155;
    line-height: 1.4;
    display: inline-flex;
    align-items: flex-start;
    gap: 6px;
    word-break: break-word;
}
.definisi-text-wrapper {
    font-size: 11px;
    color: #475569;
    line-height: 1.4;
    word-break: break-word;
}

/* Modal Realisasi Dialog */
.modal-realisasi-dialog {
    max-width: 900px !important;
    width: 95% !important;
    margin: 30px auto !important;
}
.modal-realisasi-content {
    border-radius: 14px;
    border: none;
    box-shadow: 0 20px 45px rgba(0,0,0,0.18);
    overflow: hidden;
}
.modal-realisasi-header {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: #ffffff;
    padding: 18px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.modal-realisasi-header h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    display: flex;
    align-items: center;
    gap: 10px;
}
.modal-realisasi-header .close {
    color: #ffffff;
    opacity: 0.8;
    text-shadow: none;
    font-size: 24px;
}
.modal-realisasi-header .close:hover { opacity: 1; }

.modal-info-panel {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 14px 18px;
    margin-bottom: 20px;
}
.modal-info-panel .info-row {
    display: flex;
    margin-bottom: 6px;
    font-size: 13px;
}
.modal-info-panel .info-row:last-child { margin-bottom: 0; }
.modal-info-panel .info-label {
    width: 140px;
    font-weight: 600;
    color: #64748b;
    flex-shrink: 0;
}
.modal-info-panel .info-val {
    color: #1e293b;
    font-weight: 600;
}

.table-input-realisasi {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 18px;
}
.table-input-realisasi th {
    background: #f1f5f9;
    color: #334155;
    font-weight: 700;
    font-size: 12px;
    padding: 10px 12px;
    border: 1px solid #e2e8f0;
    text-align: center;
}
.table-input-realisasi td {
    padding: 8px 12px;
    border: 1px solid #e2e8f0;
    vertical-align: middle;
}
.table-input-realisasi .input-realisasi-field {
    border-radius: 6px;
    border: 1.5px solid #cbd5e1;
    padding: 7px 10px;
    font-size: 13px;
    font-weight: 600;
    color: #0f172a;
    transition: all 0.2s ease;
    width: 100%;
}
.table-input-realisasi .input-realisasi-field:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    outline: none;
}
.target-display-box {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1e40af;
    font-weight: 700;
    border-radius: 6px;
    padding: 6px 10px;
    text-align: center;
    font-size: 13px;
}
.live-capaian-pct {
    font-size: 12px;
    font-weight: 700;
    text-align: center;
}
</style>

<div class="main-content">
    <div class="container-fluid" style="padding: 0;">
        <div class="data-table-list-full">

        <!-- ================= HEADER & CONTROL BAR ================= -->
        <div class="capaian-header-bar">
            <div class="capaian-title">
                <h3>
                    <i class="fa fa-check-square-o text-success" style="font-size:24px;"></i>
                    Capaian IKK Perangkat Daerah
                    <?php if (!empty($NamaWilayah)): ?>
                        <span class="badge badge-info" style="font-size:12px; font-weight:600; background:#0284c7; padding:4px 10px; border-radius:12px;">
                            <?= html_escape($NamaWilayah) ?>
                        </span>
                    <?php endif; ?>
                </h3>
                <p>Monitoring dan Evaluasi Capaian Kinerja (Target vs Realisasi) Indikator Kinerja Kunci (IKK) Perangkat Daerah</p>
            </div>
            <div>
                <a href="<?= base_url('Instansi/IkkPD' . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '')) ?>" class="btn btn-default" style="font-weight:600; border-radius:8px; padding:7px 16px;">
                    <i class="fa fa-list"></i> Lihat Menu IKK PD
                </a>
            </div>
        </div>

        <!-- ================= FILTER WILAYAH SEBELUM LOGIN ================= -->
        <?php if (empty($IsLoggedIn)) { ?>
            <div class="filter-card-integrated">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12" style="margin-bottom:10px;">
                        <div class="filter-label"><i class="fa fa-map"></i> Provinsi</div>
                        <select class="form-control" id="Provinsi">
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($Provinsi as $prov) { ?>
                                <option value="<?= $prov['Kode'] ?>"
                                    <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) === $prov['Kode']) ? 'selected' : '' ?>>
                                    <?= html_escape($prov['Nama']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12" style="margin-bottom:10px;">
                        <div class="filter-label"><i class="fa fa-building-o"></i> Kabupaten/Kota</div>
                        <select class="form-control" id="KabKota">
                            <option value="">Pilih Kab/Kota</option>
                            <?php 
                            if (!empty($KodeWilayah)) {
                                $provKode = substr($KodeWilayah, 0, 2);
                                $listKabKota = $this->db->select('Kode, Nama')
                                                       ->from('kodewilayah')
                                                       ->where("Kode LIKE '{$provKode}.%'")
                                                       ->where('LENGTH(REPLACE(Kode, ".", "")) = 4', null, false)
                                                       ->order_by('Nama', 'ASC')
                                                       ->get()
                                                       ->result_array();
                                foreach ($listKabKota as $kab) { ?>
                                    <option value="<?= html_escape($kab['Kode']) ?>" <?= ($KodeWilayah == $kab['Kode'] || str_replace('.', '', $KodeWilayah) == str_replace('.', '', $kab['Kode'])) ? 'selected' : '' ?>>
                                        <?= html_escape($kab['Nama']) ?>
                                    </option>
                                <?php }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12" id="FilterInstansiGroupBefore" style="<?= (!empty($KodeWilayah) && !empty($ListInstansi)) ? '' : 'display: none;' ?> margin-bottom:10px;">
                        <div class="filter-label"><i class="fa fa-users"></i> Filter Instansi</div>
                        <select class="form-control" id="FilterInstansiBeforeLogin">
                            <option value="">-- Semua Instansi --</option>
                            <?php if (!empty($ListInstansi)) { ?>
                                <?php foreach ($ListInstansi as $ins) { ?>
                                    <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                        <?= html_escape($ins['nama']) ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-12" style="margin-bottom:10px;">
                        <div class="filter-label">&nbsp;</div>
                        <div style="display:flex; gap:6px;">
                            <button class="btn btn-primary notika-btn-primary btn-block btn-filter-act" id="Filter" style="flex:1;">
                                <i class="fa fa-search"></i> <b>Filter</b>
                            </button>
                            <?php if (!empty($KodeWilayah)) { ?>
                                <button type="button" class="btn btn-default btn-filter-act" id="ResetWilayahBtn" title="Reset Wilayah">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($KodeWilayah)) { ?>
                    <div style="margin-top:12px; padding:10px 14px; background:#eff6ff; border:1px solid #bfdbfe; border-radius:6px; font-size:13px; color:#1e40af; display:flex; align-items:center; gap:8px;">
                        <i class="fa fa-info-circle" style="font-size:16px;"></i>
                        <div>
                            <strong>Wilayah terpilih:</strong> <?= htmlspecialchars($NamaWilayah ?: $KodeWilayah) ?>
                            <?php 
                            if (!empty($FilterInstansiId)) { 
                                $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $FilterInstansiId)->get()->row_array();
                                if ($instansi_terpilih) {
                            ?>
                                &nbsp;|&nbsp; <strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama']) ?>
                            <?php 
                                }
                            } 
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <!-- ================= FILTER INTEGRATED (INSTANSI & BIDANG URUSAN) ================= -->
        <?php
        $NamaBidangAktif = '';
        if (!empty($Urusan) && !empty($UrusanAktif)) {
            foreach ($Urusan as $u) {
                if ((string)$u['id'] === (string)$UrusanAktif) {
                    $NamaBidangAktif = $u['nama_urusan'];
                    break;
                }
            }
        }
        ?>

        <div class="filter-card-integrated">
            <div class="row" style="display: flex; flex-wrap: wrap; align-items: flex-end;">
                <!-- FILTER INSTANSI (NON ROLE 4) -->
                <?php if (!$IsRole4 && !empty($KodeWilayah)) { ?>
                    <div class="col-lg-4 col-md-5 col-sm-12" style="margin-bottom:10px;">
                        <div class="filter-label"><i class="fa fa-university"></i> Pilih Instansi</div>
                        <select class="form-control" id="FilterInstansi">
                            <option value="">-- Semua Instansi --</option>
                            <?php foreach ($ListInstansi as $ins) { ?>
                                <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                    <?= html_escape($ins['nama']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>

                <!-- BIDANG URUSAN PD -->
                <div class="<?= (!$IsRole4 && !empty($KodeWilayah)) ? 'col-lg-5 col-md-4 col-sm-12' : 'col-lg-8 col-md-8 col-sm-12' ?>" style="margin-bottom:10px;">
                    <div class="filter-label">
                        <i class="fa fa-sitemap"></i> Bidang Urusan PD <span style="color:#ef4444;">*</span>
                    </div>
                    <select class="form-control" id="UrusanPD">
                        <?php if (!$IsRole4 && empty($FilterInstansiId)) { ?>
                            <option value="">-- Pilih Instansi terlebih dahulu --</option>
                        <?php } else { ?>
                            <option value="">-- Pilih Bidang Urusan --</option>
                            <?php if (!empty($Urusan)) { ?>
                                <?php foreach ($Urusan as $u) { ?>
                                    <option value="<?= $u['id'] ?>"
                                        <?= ($UrusanAktif == $u['id']) ? 'selected' : '' ?>>
                                        <?= html_escape($u['nama_urusan']) ?>
                                    </option>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="" disabled>-- Instansi ini belum memiliki Bidang Urusan PD --</option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <!-- TOMBOL ACTION (NON-ROLE 4) -->
                <?php if (!$IsRole4 && !empty($KodeWilayah)) { ?>
                    <div class="col-lg-3 col-md-3 col-sm-12" style="margin-bottom:10px;">
                        <div style="display:flex; gap:8px;">
                            <button class="btn btn-info notika-btn-info btn-filter-act" id="FilterInstansiBtn" style="flex:1;">
                                <i class="fa fa-eye"></i> Tampilkan
                            </button>
                            <button class="btn btn-default btn-filter-act" id="ResetFilterBtn" style="flex:1;">
                                <i class="fa fa-refresh"></i> Reset
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- ALERT ROLE 4 INSTANSI -->
            <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                <div style="margin-top:10px; font-size:12.5px; color:#065f46; background:#ecfdf5; border:1px solid #a7f3d0; padding:8px 12px; border-radius:6px; display:flex; align-items:center; gap:8px;">
                    <i class="fa fa-building"></i> 
                    <span>Instansi Login: <b><?= htmlspecialchars($NamaInstansi) ?></b> &mdash; Menampilkan data capaian target &amp; realisasi IKK instansi Anda.</span>
                </div>
            <?php } ?>
        </div>

        <!-- ================= SUMMARY CHIPS & LEGEND TOOLBAR ================= -->
        <?php if ($UrusanAktif && !empty($Data)): ?>
            <?php
                $totalIndikator = count($Data);
                $terisiCount = 0;
                foreach ($Data as $d) {
                    if (!empty($d['r_2025']) || !empty($d['r_2026']) || !empty($d['r_2027']) || !empty($d['r_2028']) || !empty($d['r_2029']) || !empty($d['r_2030'])) {
                        $terisiCount++;
                    }
                }
            ?>
            <div class="stats-summary-bar">
                <div class="stats-chips-group">
                    <div class="stat-chip">
                        <span class="chip-dot" style="background:#0284c7;"></span>
                        Total IKK: <span class="chip-count"><?= $totalIndikator ?></span>
                    </div>
                    <div class="stat-chip">
                        <span class="chip-dot" style="background:#10b981;"></span>
                        Realisasi Terisi: <span class="chip-count"><?= $terisiCount ?></span>
                    </div>
                    <div class="stat-chip">
                        <span class="chip-dot" style="background:#f59e0b;"></span>
                        Belum Terisi: <span class="chip-count"><?= $totalIndikator - $terisiCount ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- KETERANGAN & SEARCH BAR -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:10px;">
            <div style="font-size:12.5px; color:#475569; font-weight:600; display:flex; align-items:center; gap:15px; flex-wrap:wrap;">
                <div><i class="fa fa-info-circle text-primary"></i> Keterangan kolom tahun:</div>
                <div class="legend-item" style="margin:0;">
                    <span class="legend-box" style="background:#f8fafc; border:1px dashed #cbd5e1;"></span>
                    <span>Kolom Kiri: <b>Target</b></span>
                </div>
                <div class="legend-item" style="margin:0;">
                    <span class="legend-box" style="background:#ffffff; border:1.5px solid #cbd5e1;"></span>
                    <span>Kolom Kanan: <b>Realisasi</b></span>
                </div>
            </div>
            <?php if ($UrusanAktif && !empty($Data)): ?>
                <div style="width:260px;">
                    <input type="text" id="SearchCapaianIkk" class="form-control" placeholder="Cari indikator di tabel..." style="border-radius:6px; font-size:12.5px; height:33px; border:1.5px solid #cbd5e1;">
                </div>
            <?php endif; ?>
        </div>

        <!-- ================= TABEL CAPAIAN IKK FULL-WIDTH ================= -->
        <div class="table-responsive" style="border:none; margin-bottom:15px;">
            <table id="data-table-capaian-ikk" class="table table-capaian-ikk">
                <thead>
                    <tr class="text-center">
                        <th width="35" style="vertical-align: middle;">No</th>
                        <th style="min-width:180px; text-align: left; vertical-align: middle;">Indikator</th>
                        <th style="min-width:140px; text-align: left; vertical-align: middle;">Rumus</th>
                        <th style="min-width:150px; text-align: left; vertical-align: middle;">Definisi Operasional</th>
                        <th class="text-center" width="65" style="vertical-align: middle;">Satuan</th>
                        <th class="text-center th-year-group" colspan="2">Baseline 2024</th>
                        <th class="text-center th-year-group" colspan="2">2025</th>
                        <th class="text-center th-year-group" colspan="2">2026</th>
                        <th class="text-center th-year-group" colspan="2">2027</th>
                        <th class="text-center th-year-group" colspan="2">2028</th>
                        <th class="text-center th-year-group" colspan="2">2029</th>
                        <th class="text-center th-year-group" colspan="2">2030</th>
                        <th style="min-width:140px; text-align: left; vertical-align: middle;">Keterangan Realisasi</th>
                        <?php if ($CanInputRealisasi) { ?>
                            <th class="text-center" width="105" style="vertical-align: middle;">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($UrusanAktif && !empty($Data)) { ?>
                        <?php $no = 1; foreach ($Data as $row) { ?>
                            <tr>
                                <td class="text-center" style="font-weight:600; color:#64748b;"><?= $no++ ?></td>
                                <td>
                                    <div style="font-weight:700; color:#0f172a;"><?= nl2br(html_escape($row['indikator'])) ?></div>
                                </td>
                                <td>
                                    <?php if (!empty($row['rumus'])) { ?>
                                        <div class="rumus-tag-wrapper">
                                            <i class="fa fa-calculator text-primary"></i>
                                            <span><?= format_rumus_rpjmd($row['rumus']) ?></span>
                                        </div>
                                    <?php } else { ?>
                                        <span class="text-muted" style="font-size:11px; font-style:italic;">-</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if (!empty($row['definisi_operasional'])) { ?>
                                        <div class="definisi-text-wrapper">
                                            <?= nl2br(html_escape($row['definisi_operasional'])) ?>
                                        </div>
                                    <?php } else { ?>
                                        <span class="text-muted" style="font-size:11px; font-style:italic;">-</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center" style="font-weight:600; color:#475569;">
                                    <?= html_escape($row['satuan']) ?>
                                </td>

                                <!-- BASELINE 2024 -->
                                <td class="text-center td-target-num" title="Target Baseline 2024">
                                    <?= format_target_koma($row['baseline_2024'] ?? null) ?>
                                </td>
                                <td class="text-center td-realisasi-num" title="Realisasi Baseline 2024">
                                    <?php if ($row['r_baseline_2024'] !== null && $row['r_baseline_2024'] !== ''): ?>
                                        <span class="badge-realisasi-val"><?= format_target_koma($row['r_baseline_2024']) ?></span>
                                    <?php else: ?>
                                        <span class="val-realisasi-empty">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- 2025 -->
                                <td class="text-center td-target-num" title="Target 2025">
                                    <?= format_target_koma($row['t_2025'] ?? null) ?>
                                </td>
                                <td class="text-center td-realisasi-num" title="Realisasi 2025">
                                    <?php if ($row['r_2025'] !== null && $row['r_2025'] !== ''): ?>
                                        <span class="badge-realisasi-val"><?= format_target_koma($row['r_2025']) ?></span>
                                        <?php 
                                            $pct = hitung_persen_capaian($row['t_2025'] ?? null, $row['r_2025']);
                                            if ($pct !== null) {
                                                $pClass = $pct >= 100 ? 'pct-high' : ($pct >= 75 ? 'pct-mid' : 'pct-low');
                                                echo "<span class='badge-capaian-pct {$pClass}'>{$pct}%</span>";
                                            }
                                        ?>
                                    <?php else: ?>
                                        <span class="val-realisasi-empty">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- 2026 -->
                                <td class="text-center td-target-num" title="Target 2026">
                                    <?= format_target_koma($row['t_2026'] ?? null) ?>
                                </td>
                                <td class="text-center td-realisasi-num" title="Realisasi 2026">
                                    <?php if ($row['r_2026'] !== null && $row['r_2026'] !== ''): ?>
                                        <span class="badge-realisasi-val"><?= format_target_koma($row['r_2026']) ?></span>
                                        <?php 
                                            $pct = hitung_persen_capaian($row['t_2026'] ?? null, $row['r_2026']);
                                            if ($pct !== null) {
                                                $pClass = $pct >= 100 ? 'pct-high' : ($pct >= 75 ? 'pct-mid' : 'pct-low');
                                                echo "<span class='badge-capaian-pct {$pClass}'>{$pct}%</span>";
                                            }
                                        ?>
                                    <?php else: ?>
                                        <span class="val-realisasi-empty">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- 2027 -->
                                <td class="text-center td-target-num" title="Target 2027">
                                    <?= format_target_koma($row['t_2027'] ?? null) ?>
                                </td>
                                <td class="text-center td-realisasi-num" title="Realisasi 2027">
                                    <?php if ($row['r_2027'] !== null && $row['r_2027'] !== ''): ?>
                                        <span class="badge-realisasi-val"><?= format_target_koma($row['r_2027']) ?></span>
                                        <?php 
                                            $pct = hitung_persen_capaian($row['t_2027'] ?? null, $row['r_2027']);
                                            if ($pct !== null) {
                                                $pClass = $pct >= 100 ? 'pct-high' : ($pct >= 75 ? 'pct-mid' : 'pct-low');
                                                echo "<span class='badge-capaian-pct {$pClass}'>{$pct}%</span>";
                                            }
                                        ?>
                                    <?php else: ?>
                                        <span class="val-realisasi-empty">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- 2028 -->
                                <td class="text-center td-target-num" title="Target 2028">
                                    <?= format_target_koma($row['t_2028'] ?? null) ?>
                                </td>
                                <td class="text-center td-realisasi-num" title="Realisasi 2028">
                                    <?php if ($row['r_2028'] !== null && $row['r_2028'] !== ''): ?>
                                        <span class="badge-realisasi-val"><?= format_target_koma($row['r_2028']) ?></span>
                                        <?php 
                                            $pct = hitung_persen_capaian($row['t_2028'] ?? null, $row['r_2028']);
                                            if ($pct !== null) {
                                                $pClass = $pct >= 100 ? 'pct-high' : ($pct >= 75 ? 'pct-mid' : 'pct-low');
                                                echo "<span class='badge-capaian-pct {$pClass}'>{$pct}%</span>";
                                            }
                                        ?>
                                    <?php else: ?>
                                        <span class="val-realisasi-empty">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- 2029 -->
                                <td class="text-center td-target-num" title="Target 2029">
                                    <?= format_target_koma($row['t_2029'] ?? null) ?>
                                </td>
                                <td class="text-center td-realisasi-num" title="Realisasi 2029">
                                    <?php if ($row['r_2029'] !== null && $row['r_2029'] !== ''): ?>
                                        <span class="badge-realisasi-val"><?= format_target_koma($row['r_2029']) ?></span>
                                        <?php 
                                            $pct = hitung_persen_capaian($row['t_2029'] ?? null, $row['r_2029']);
                                            if ($pct !== null) {
                                                $pClass = $pct >= 100 ? 'pct-high' : ($pct >= 75 ? 'pct-mid' : 'pct-low');
                                                echo "<span class='badge-capaian-pct {$pClass}'>{$pct}%</span>";
                                            }
                                        ?>
                                    <?php else: ?>
                                        <span class="val-realisasi-empty">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- 2030 -->
                                <td class="text-center td-target-num" title="Target 2030">
                                    <?= format_target_koma($row['t_2030'] ?? null) ?>
                                </td>
                                <td class="text-center td-realisasi-num" title="Realisasi 2030">
                                    <?php if ($row['r_2030'] !== null && $row['r_2030'] !== ''): ?>
                                        <span class="badge-realisasi-val"><?= format_target_koma($row['r_2030']) ?></span>
                                        <?php 
                                            $pct = hitung_persen_capaian($row['t_2030'] ?? null, $row['r_2030']);
                                            if ($pct !== null) {
                                                $pClass = $pct >= 100 ? 'pct-high' : ($pct >= 75 ? 'pct-mid' : 'pct-low');
                                                echo "<span class='badge-capaian-pct {$pClass}'>{$pct}%</span>";
                                            }
                                        ?>
                                    <?php else: ?>
                                        <span class="val-realisasi-empty">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- KETERANGAN REALISASI -->
                                <td style="font-size:12px; color:#475569;">
                                    <?= !empty($row['keterangan_realisasi']) ? nl2br(html_escape($row['keterangan_realisasi'])) : '<span class="text-muted">-</span>' ?>
                                </td>

                                <!-- AKSI INPUT REALISASI -->
                                <?php if ($CanInputRealisasi) { ?>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-success BtnInputRealisasi"
                                            data-json='<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>'
                                            title="Isi / Perbarui Realisasi IKK Daerah"
                                            style="border-radius:6px; font-weight:600; padding:5px 10px; font-size:11.5px; background:#059669; border-color:#059669;">
                                            <i class="fa fa-pencil-square-o"></i> <b>Realisasi</b>
                                        </button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="<?= $CanInputRealisasi ? '21' : '20' ?>" class="text-center" style="padding:45px 20px;">
                                <i class="fa fa-folder-open text-muted" style="font-size:38px; margin-bottom:12px; display:block;"></i>
                                <p class="text-muted" style="margin:0; font-size:14px; font-weight:500;">
                                    <?= $UrusanAktif ? 'Belum ada data IKK untuk Bidang Urusan ini.' : 'Silakan pilih Bidang Urusan PD terlebih dahulu untuk menampilkan data capaian IKK.' ?>
                                </p>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        </div>
    </div>
</div>

<?php if ($CanInputRealisasi) { ?>
<!-- ========================================================================= -->
<!-- MODAL INPUT / EDIT REALISASI IKK DAERAH -->
<!-- ========================================================================= -->
<div class="modal fade" id="ModalInputRealisasi" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-realisasi-dialog">
        <div class="modal-content modal-realisasi-content">
            <div class="modal-realisasi-header">
                <h4>
                    <i class="fa fa-bullseye"></i>
                    <span>Input Realisasi Capaian IKK Daerah</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <input type="hidden" id="realisasi_id">

                <!-- Info Ringkasan Indikator -->
                <div class="modal-info-panel">
                    <div class="info-row">
                        <div class="info-label"><i class="fa fa-tag text-muted"></i> Indikator:</div>
                        <div class="info-val" id="modal_indikator_nama" style="font-weight:700; color:#0f172a;">-</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa fa-sitemap text-muted"></i> Bidang Urusan:</div>
                        <div class="info-val" id="modal_bidang_nama">-</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fa fa-balance-scale text-muted"></i> Satuan:</div>
                        <div class="info-val" id="modal_satuan">-</div>
                    </div>
                    <div class="info-row" id="modal_rumus_row" style="display:none;">
                        <div class="info-label"><i class="fa fa-calculator text-muted"></i> Rumus:</div>
                        <div class="info-val" id="modal_rumus_val">-</div>
                    </div>
                </div>

                <p style="font-size:13px; color:#475569; margin-bottom:12px;">
                    <i class="fa fa-info-circle text-primary"></i> Masukkan nilai realisasi pada kolom <b>Realisasi Daerah</b> di bawah ini. Persentase capaian akan otomatis dihitung berdasarkan perbandingan Target vs Realisasi.
                </p>

                <!-- Tabel Input Realisasi per Tahun -->
                <div class="table-responsive">
                    <table class="table-input-realisasi">
                        <thead>
                            <tr>
                                <th width="140">Tahun</th>
                                <th width="160">Target IKK</th>
                                <th>Realisasi Daerah <span class="text-danger">*</span></th>
                                <th width="130">Capaian (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baseline 2024 -->
                            <tr>
                                <td class="text-center" style="font-weight:600; color:#475569;">Baseline 2024</td>
                                <td>
                                    <div class="target-display-box" id="target_baseline_2024_text">-</div>
                                    <input type="hidden" id="target_baseline_2024_val">
                                </td>
                                <td>
                                    <input type="text" class="input-realisasi-field input-live-calc" id="r_baseline_2024" placeholder="Contoh: 85 atau 85,5" data-target="target_baseline_2024_val" data-out="pct_baseline_2024">
                                </td>
                                <td class="text-center">
                                    <span class="live-capaian-pct" id="pct_baseline_2024">-</span>
                                </td>
                            </tr>

                            <!-- Tahun 2025 s.d 2030 -->
                            <?php for ($y = 2025; $y <= 2030; $y++): ?>
                                <tr>
                                    <td class="text-center" style="font-weight:700; color:#1e293b;">Tahun <?= $y ?></td>
                                    <td>
                                        <div class="target-display-box" id="target_<?= $y ?>_text">-</div>
                                        <input type="hidden" id="target_<?= $y ?>_val">
                                    </td>
                                    <td>
                                        <input type="text" class="input-realisasi-field input-live-calc" id="r_<?= $y ?>" placeholder="Contoh: 90 atau 90,5" data-target="target_<?= $y ?>_val" data-out="pct_<?= $y ?>">
                                    </td>
                                    <td class="text-center">
                                        <span class="live-capaian-pct" id="pct_<?= $y ?>">-</span>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Keterangan / Analisis Realisasi -->
                <div class="form-group" style="margin-top:10px;">
                    <label for="keterangan_realisasi"><b>Keterangan / Faktor Pendorong / Kendala Realisasi</b></label>
                    <textarea class="form-control" id="keterangan_realisasi" rows="3" placeholder="Tuliskan catatan analisis ketercapaian, faktor pendorong, kendala, atau tindak lanjut realisasi capaian IKK ini..." style="border-radius:8px; border:1.5px solid #cbd5e1;"></textarea>
                </div>
            </div>

            <div class="modal-footer" style="padding: 16px 24px; background:#f8fafc; border-top:1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight:600; border-radius:8px;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnSimpanRealisasi" style="font-weight:700; background:#059669; border-color:#059669; padding:8px 22px; border-radius:8px;">
                    <i class="fa fa-save"></i> Simpan Realisasi Daerah
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

jQuery(document).ready(function($){

    // Live Search Tabel Capaian IKK
    $('#SearchCapaianIkk').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $("#data-table-capaian-ikk tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    /* ================= FILTER WILAYAH SEBELUM LOGIN ================= */
    <?php if (empty($IsLoggedIn)) { ?>

    $("#Provinsi").change(function() {
        var prov = $(this).val();
        if (!prov) {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiGroupBefore").hide();
            return;
        }

        $("#KabKota").html('<option value="">Memuat Kab/Kota...</option>');

        $.ajax({
            url: BaseURL + "Instansi/GetListKabKota",
            type: "POST",
            data: { Kode: prov },
            dataType: 'json',
            success: function(res) {
                var opt = '<option value="">Pilih Kab/Kota</option>';
                if (res && res.length > 0) {
                    $.each(res, function(i, item) {
                        var sel = (KODE_WILAYAH === item.Kode || (KODE_WILAYAH && KODE_WILAYAH.replace(/\./g, '') === item.Kode.replace(/\./g, ''))) ? 'selected' : '';
                        opt += '<option value="' + item.Kode + '" ' + sel + '>' + item.Nama + '</option>';
                    });
                }
                $("#KabKota").html(opt);
                if ($("#KabKota").val()) {
                    $("#KabKota").trigger('change');
                } else {
                    $("#FilterInstansiGroupBefore").hide();
                }
            },
            error: function() {
                $("#KabKota").html('<option value="">Gagal memuat Kab/Kota</option>');
            }
        });
    });

    var initProvVal = $("#Provinsi").val();
    if (initProvVal && $("#KabKota option").length <= 1) {
        $("#Provinsi").trigger('change');
    }

    $("#KabKota").change(function() {
        var kode = $(this).val();
        if (kode === "") {
            $("#FilterInstansiGroupBefore").hide();
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListInstansiByWilayah",
            type: "POST",
            data: { KodeWilayah: kode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            success: function(res) {
                var opt = '<option value="">-- Semua Instansi --</option>';
                if (res && res.length > 0) {
                    $.each(res, function(i, item) {
                        var sel = (CURRENT_FILTER_INSTANSI == item.id) ? 'selected' : '';
                        opt += '<option value="' + item.id + '" ' + sel + '>' + item.nama + '</option>';
                    });
                    $("#FilterInstansiBeforeLogin").html(opt);
                    $("#FilterInstansiGroupBefore").show();
                } else {
                    $("#FilterInstansiGroupBefore").hide();
                }
            }
        });
    });

    $("#Filter").click(function() {
        var prov = $("#Provinsi").val();
        var kabKota = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();

        if (kabKota === "" && prov === "") {
            alert("Pilih Provinsi dan Kab/Kota terlebih dahulu!");
            return;
        }

        var selectedKode = kabKota !== "" ? kabKota : prov;
        $("#Filter").prop('disabled', true).text('Memuat...');

        $.ajax({
            url: BaseURL + "Instansi/SimpanFilterWilayah",
            type: "POST",
            data: {
                KodeWilayah: selectedKode,
                FilterInstansiId: instansiId,
                [CSRF_NAME]: CSRF_TOKEN
            },
            success: function(res) {
                if (res === "1") {
                    var redirectUrl = BaseURL + "Instansi/CapaianIkkPD";
                    if (instansiId && instansiId !== "") {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() { alert("Gagal menghubungi server!"); }
        });
    });

    $("#ResetWilayahBtn").click(function() {
        $(this).prop('disabled', true);
        $.ajax({
            url: BaseURL + "Instansi/ResetFilterWilayah",
            type: "POST",
            data: { [CSRF_NAME]: CSRF_TOKEN },
            success: function() {
                window.location.href = BaseURL + "Instansi/CapaianIkkPD";
            },
            error: function() {
                window.location.href = BaseURL + "Instansi/CapaianIkkPD";
            }
        });
    });

    <?php } ?>

    /* ================= FILTER INSTANSI NON-ROLE 4 ================= */
    <?php if (!$IsRole4 && !empty($KodeWilayah)) { ?>
        // AJAX: Ketika selesai memilih Instansi, langsung ambil dan munculkan daftar Bidang Urusan PD
        $("#FilterInstansi").change(function(){
            var instansiId = $(this).val();
            if (!instansiId) {
                $("#UrusanPD").html('<option value="">-- Pilih Instansi terlebih dahulu --</option>');
                return;
            }

            $("#UrusanPD").html('<option value="">Memuat Bidang Urusan...</option>').prop('disabled', true);

            $.ajax({
                url: BaseURL + "Instansi/GetUrusanByInstansi",
                type: "POST",
                data: {
                    instansi_id: instansiId,
                    kodewilayah: KODE_WILAYAH,
                    [CSRF_NAME]: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(res) {
                    $("#UrusanPD").prop('disabled', false);
                    var opt = '<option value="">-- Pilih Bidang Urusan --</option>';
                    if (res && res.length > 0) {
                        $.each(res, function(i, item) {
                            opt += '<option value="' + item.id + '">' + item.nama_urusan + '</option>';
                        });
                    } else {
                        opt = '<option value="" disabled>-- Instansi ini belum memiliki Bidang Urusan PD --</option>';
                    }
                    $("#UrusanPD").html(opt);
                },
                error: function() {
                    $("#UrusanPD").prop('disabled', false);
                    $("#UrusanPD").html('<option value="">Gagal memuat Bidang Urusan</option>');
                }
            });
        });

        $("#FilterInstansiBtn").click(function() {
            var instansiId = $("#FilterInstansi").val();
            var urusanId = $("#UrusanPD").val();
            var url = BaseURL + "Instansi/CapaianIkkPD";
            var params = [];
            if (instansiId) { params.push("instansi_id=" + instansiId); }
            if (urusanId) { params.push("urusan_id=" + urusanId); }
            if (params.length > 0) { url += "?" + params.join("&"); }
            window.location.href = url;
        });

        $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/CapaianIkkPD"; });
    <?php } ?>

    /* ================= DROPDOWN BIDANG URUSAN PD ================= */
    $("#UrusanPD").change(function(){
        var urusanId = $(this).val();
        var url = BaseURL + "Instansi/CapaianIkkPD";
        var params = [];
        var instansiId = $("#FilterInstansi").val();

        <?php if (!empty($FilterInstansiId)) { ?>
            if (!instansiId) { instansiId = '<?= $FilterInstansiId ?>'; }
        <?php } ?>

        if (instansiId) { params.push("instansi_id=" + instansiId); }
        if (urusanId) { params.push("urusan_id=" + urusanId); }

        if (params.length > 0) { url += "?" + params.join("&"); }
        window.location.href = url;
    });

    <?php if (!empty($UrusanAktif)) { ?>
        $("#UrusanPD").val("<?= $UrusanAktif ?>");
    <?php } ?>

    /* ================= LIVE CALCULATION HELPER ================= */
    function calcPercentage(targetStr, realisasiStr) {
        if (!targetStr || !realisasiStr) return '-';
        var t = parseFloat(String(targetStr).replace(/,/g, '.'));
        var r = parseFloat(String(realisasiStr).replace(/,/g, '.'));
        if (isNaN(t) || isNaN(r) || t <= 0) return '-';
        var pct = ((r / t) * 100).toFixed(1);
        return pct + '%';
    }

    $(document).on('input keyup', '.input-live-calc', function() {
        var targetFieldId = $(this).data('target');
        var outFieldId = $(this).data('out');
        var targetVal = $('#' + targetFieldId).val();
        var realisasiVal = $(this).val();
        var pctText = calcPercentage(targetVal, realisasiVal);
        var $out = $('#' + outFieldId);
        $out.text(pctText);
        if (pctText !== '-') {
            var num = parseFloat(pctText);
            if (num >= 100) {
                $out.css({ color: '#047857', fontWeight: 'bold' });
            } else if (num >= 75) {
                $out.css({ color: '#b45309', fontWeight: 'bold' });
            } else {
                $out.css({ color: '#b91c1c', fontWeight: 'bold' });
            }
        } else {
            $out.css({ color: '#64748b', fontWeight: 'normal' });
        }
    });

    /* ================= BUKA MODAL REALISASI ================= */
    $(document).on('click', '.BtnInputRealisasi', function() {
        var d = JSON.parse($(this).attr('data-json'));
        $('#realisasi_id').val(d.id);
        $('#modal_indikator_nama').text(d.indikator || '-');
        $('#modal_satuan').text(d.satuan || '-');

        var bidangText = $("#UrusanPD option:selected").text().trim() || '-';
        $('#modal_bidang_nama').text(bidangText);

        if (d.rumus) {
            $('#modal_rumus_val').html(d.rumus);
            $('#modal_rumus_row').show();
        } else {
            $('#modal_rumus_row').hide();
        }

        // Set Baseline 2024
        var baseTarget = d.baseline_2024 !== null && d.baseline_2024 !== '' ? String(d.baseline_2024).replace(/\./g, ',') : '-';
        $('#target_baseline_2024_text').text(baseTarget);
        $('#target_baseline_2024_val').val(d.baseline_2024 || '');
        var baseReal = d.r_baseline_2024 !== null && d.r_baseline_2024 !== '' ? String(d.r_baseline_2024).replace(/\./g, ',') : '';
        $('#r_baseline_2024').val(baseReal).trigger('input');

        // Set 2025 s.d 2030
        for (let y = 2025; y <= 2030; y++) {
            var tVal = d['t_' + y] !== null && d['t_' + y] !== '' ? String(d['t_' + y]).replace(/\./g, ',') : '-';
            $('#target_' + y + '_text').text(tVal);
            $('#target_' + y + '_val').val(d['t_' + y] || '');

            var rVal = d['r_' + y] !== null && d['r_' + y] !== '' ? String(d['r_' + y]).replace(/\./g, ',') : '';
            $('#r_' + y).val(rVal).trigger('input');
        }

        $('#keterangan_realisasi').val(d.keterangan_realisasi || '');
        $('#ModalInputRealisasi').modal('show');
    });

    /* ================= SIMPAN REALISASI AJAX ================= */
    $('#BtnSimpanRealisasi').click(function() {
        var id = $('#realisasi_id').val();
        if (!id) {
            alert('ID IKK tidak ditemukan!');
            return;
        }

        var postData = {
            id: id,
            r_baseline_2024: $('#r_baseline_2024').val(),
            r_2025: $('#r_2025').val(),
            r_2026: $('#r_2026').val(),
            r_2027: $('#r_2027').val(),
            r_2028: $('#r_2028').val(),
            r_2029: $('#r_2029').val(),
            r_2030: $('#r_2030').val(),
            keterangan_realisasi: $('#keterangan_realisasi').val(),
            [CSRF_NAME]: CSRF_TOKEN
        };

        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Instansi/SimpanRealisasiIkkPD',
            type: 'POST',
            data: postData,
            dataType: 'json',
            success: function(res) {
                if (res && res.status === 'success') {
                    alert(res.message || 'Data realisasi berhasil disimpan!');
                    location.reload();
                } else {
                    alert((res && res.message) ? res.message : 'Gagal menyimpan data realisasi!');
                    $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Realisasi Daerah');
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan koneksi server: ' + error);
                $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Realisasi Daerah');
            }
        });
    });

});
</script>
