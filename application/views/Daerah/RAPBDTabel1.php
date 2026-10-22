<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
  /* Styling Tabel RAPBD Sesuai Tema Menu Lain (Notika / VisiRPJMD) */
  .table-rapbd {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    margin-top: 15px;
    font-size: 13px;
    border: 1px solid #cbd5e1;
  }
  .table-rapbd th, 
  .table-rapbd td {
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
    vertical-align: middle;
  }
  .table-rapbd thead th {
    background-color: #f1f5f9;
    color: #334155;
    font-weight: 700;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.3px;
    border: 1px solid #cbd5e1;
  }
  .table-rapbd thead tr.sub-header th {
    background-color: #f8fafc;
    color: #64748b;
    padding: 4px 8px;
    font-weight: 700;
    text-align: center;
    font-size: 11px;
    border: 1px solid #cbd5e1;
  }
  .table-rapbd td.kode-col {
    width: 12%;
    text-align: left;
    white-space: nowrap;
    padding-left: 12px;
    font-weight: 600;
  }
  .table-rapbd td.uraian-col {
    width: 52%;
    text-align: left;
  }
  .table-rapbd td.jumlah-col {
    width: 24%;
    text-align: center;
    white-space: nowrap;
    font-variant-numeric: tabular-nums;
    font-weight: 600;
  }
  .table-rapbd td.aksi-col {
    width: 18%;
    text-align: center;
    white-space: nowrap;
  }
  /* Baris Judul (Level 1: 4, 5, 6) - Hijau lembut elegan seperti baris Visi */
  .table-rapbd tr.row-judul {
    background-color: #eef7ee !important;
    font-weight: 700;
    color: #1b5e20;
  }
  .table-rapbd tr.row-judul td {
    border-left: 4px solid #4caf50 !important;
    font-size: 13.5px;
  }
  /* Baris Sub Judul (Level 2: 4.1, 4.2, 5.1, 6.1, 6.2) - Cyan lembut elegan seperti baris Misi */
  .table-rapbd tr.row-sub-judul {
    background-color: #e6f7fa !important;
    font-weight: 700;
    color: #006064;
  }
  .table-rapbd tr.row-sub-judul td {
    border-left: 4px solid #00bcd4 !important;
    font-size: 13px;
  }
  /* Baris Isi (Level 3: 4.1.01, 6.1.01, dll) */
  .table-rapbd tr.row-isi {
    background-color: #ffffff;
    color: #334155;
  }
  .table-rapbd tr.row-isi td.uraian-col {
    padding-left: 30px;
    font-weight: normal;
  }
  /* Baris Jumlah Total per Judul */
  .table-rapbd tr.row-total-judul {
    background-color: #f1f5f9 !important;
    font-weight: 700;
    color: #1e293b;
  }
  .table-rapbd tr.row-total-judul td {
    border-top: 2px solid #cbd5e1 !important;
    border-bottom: 2px solid #cbd5e1 !important;
  }
  /* Baris SURPLUS / (DEFISIT) - Amber/oranye lembut elegan seperti Tujuan */
  .table-rapbd tr.row-surplus-defisit {
    background-color: #fff8eb !important;
    font-weight: 800;
    color: #9a3412;
  }
  .table-rapbd tr.row-surplus-defisit td {
    border-left: 4px solid #ff9800 !important;
    border-top: 2px solid #fdba74 !important;
    border-bottom: 2px solid #fdba74 !important;
  }
  /* Baris Pembiayaan Netto - Ungu/Indigo lembut elegan */
  .table-rapbd tr.row-pembiayaan-netto {
    background-color: #f5f3ff !important;
    font-weight: 800;
    color: #5b21b6;
  }
  .table-rapbd tr.row-pembiayaan-netto td {
    border-left: 4px solid #8b5cf6 !important;
    border-top: 2px solid #ddd6fe !important;
    border-bottom: 2px solid #ddd6fe !important;
  }
  /* Baris SILPA - Biru lembut elegan */
  .table-rapbd tr.row-silpa {
    background-color: #eef2ff !important;
    font-weight: 700;
    color: #3730a3;
  }
  .table-rapbd tr.row-silpa td {
    border-left: 4px solid #6366f1 !important;
  }
  .table-rapbd tbody tr {
    transition: filter 0.15s ease;
  }
  .table-rapbd tbody tr:hover {
    filter: brightness(0.97);
  }

  /* Styling Seragam dan Presisi untuk Tombol Kolom AKSI */
  .table-rapbd td.aksi-col {
    width: 18%;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    padding: 5px 8px !important;
  }

  .table-rapbd .btn-action {
    display: inline-block !important;
    text-align: center !important;
    vertical-align: middle !important;
    height: 26px !important;
    line-height: 26px !important;
    padding: 0 8px !important;
    margin: 1px 2px !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    border-radius: 4px !important;
    border: none !important;
    outline: none !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12) !important;
    transition: all 0.15s ease !important;
    box-sizing: border-box !important;
  }

  .table-rapbd .btn-action:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 3px 6px rgba(0,0,0,0.18) !important;
    filter: brightness(0.94);
  }

  /* Ukuran & Bentuk Seragam untuk Tombol Tambah (Sub Judul, Isi, Rekapitulasi) */
  .table-rapbd .btn-action-tambah {
    width: 96px !important;
    min-width: 96px !important;
    padding: 0 6px !important;
    line-height: 26px !important;
    font-size: 10px !important;
    white-space: nowrap !important;
  }

  .table-rapbd .btn-action-tambah i {
    margin-right: 4px !important;
    line-height: 26px !important;
    vertical-align: middle !important;
  }

  /* Ukuran & Bentuk Seragam untuk Tombol Ikon Kotak (Edit & Hapus) */
  .table-rapbd .btn-action-icon {
    width: 28px !important;
    min-width: 28px !important;
    padding: 0 !important;
    line-height: 26px !important;
    font-size: 11px !important;
  }

  .table-rapbd .btn-action-icon i {
    line-height: 26px !important;
    vertical-align: middle !important;
  }

  /* Warna Tombol Solid dan Konsisten */
  .table-rapbd .btn-action.btn-success {
    background-color: #00c292 !important;
    color: #ffffff !important;
  }
  .table-rapbd .btn-action.btn-info {
    background-color: #00bcd4 !important;
    color: #ffffff !important;
  }
  .table-rapbd .btn-action.btn-warning {
    background-color: #ff9800 !important;
    color: #ffffff !important;
  }
  .table-rapbd .btn-action.btn-danger {
    background-color: #f44336 !important;
    color: #ffffff !important;
  }

  @media print {
    .no-print, .sidebar-wrapper, .header-top-area, .footer-copyright-area, .btn {
      display: none !important;
    }
    .main-content {
      margin-left: 0 !important;
      padding: 0 !important;
    }
    .table-rapbd th, .table-rapbd td {
      border: 1px solid #000 !important;
    }
  }
</style>

<!-- Main Content -->
<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      
      <!-- Tabel Area -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list" style="border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px; background: #fff;">
            
            <!-- Header di atas tabel -->
            <div class="basic-tb-hd" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
              <div class="row align-items-center">
                <div class="col-md-7 col-sm-6">
                  <h3 style="font-weight: 800; color: #1f2937; margin: 0 0 5px 0;">
                    RANCANGAN APBD (RAPBD) - TABEL 1
                  </h3>
                  <div style="color: #64748b; font-size: 13px;">
                    <?php if (!empty($NamaWilayah)) { ?>
                      <span class="badge" style="background-color: #e6fcf5; color: #0ca678; border: 1px solid #c3fae8; padding: 4px 10px; font-size: 12px; border-radius: 12px; font-weight: 700; margin-right: 8px;">
                        <i class="fa fa-map-marker"></i> <?= html_escape($NamaWilayah) ?>
                      </span>
                    <?php } ?>
                    Format: <b>Judul</b>, <b>Sub Judul</b>, <b>Isi</b>, dan Kategori Rekapitulasi Otomatis
                  </div>
                </div>

                <div class="col-md-5 col-sm-6 text-right no-print" style="display: flex; justify-content: flex-end; align-items: center; gap: 8px; flex-wrap: wrap;">
                  <!-- Filter Tahun -->
                  <form method="GET" action="<?= base_url('Daerah/RAPBDTabel1') ?>" class="form-inline" id="formFilterTahun" style="margin-right: 5px;">
                    <label for="filterTahun" style="font-weight: 700; margin-right: 6px; font-size: 13px; color: #374151;">
                      <i class="fa fa-calendar"></i> Tahun:
                    </label>
                    <select name="tahun" id="filterTahun" class="form-control input-sm" style="border-radius: 6px; font-weight: 700; width: 105px;" onchange="this.form.submit()">
                      <?php foreach ($TahunList as $t) { ?>
                        <option value="<?= $t ?>" <?= ($SelectedTahun == $t) ? 'selected' : '' ?>><?= $t ?></option>
                      <?php } ?>
                    </select>
                  </form>

                  <?php if (!empty($RAPBDList)) { ?>
                    <button type="button" class="btn btn-sm btn-danger notika-btn-danger" id="btnClearTabel1" style="border-radius: 6px; font-weight: 600; font-size: 12px;" title="Kosongkan Semua Data Tabel 1">
                      <i class="fa fa-trash"></i> Kosongkan
                    </button>
                  <?php } ?>

                  <!-- Tombol Tambah Judul Di Atas Tabel -->
                  <button type="button" class="btn btn-sm btn-success notika-btn-success" id="btnTambahBarisUtama" data-toggle="modal" data-target="#modalTambahRAPBD" style="border-radius: 6px; font-weight: 700; font-size: 13px; padding: 6px 14px;">
                    <i class="fa fa-plus-circle"></i> Tambah Judul
                  </button>
                </div>
              </div>
            </div>

            <?php
            // Perhitungan Akurat & Otomatis untuk Rekapitulasi RAPBD Tabel 1
            if (!function_exists('calcRAPBDTotalsHelper')) {
              function calcRAPBDTotalsHelper($list) {
                if (empty($list)) {
                  return [
                    'pendapatan' => 0,
                    'belanja' => 0,
                    'surplus_defisit' => 0,
                    'penerimaan_pembiayaan' => 0,
                    'pengeluaran_pembiayaan' => 0,
                    'pembiayaan_netto' => 0
                  ];
                }

                $has4 = false; $has5 = false; $has6 = false;
                foreach ($list as $r) {
                  $k = trim($r['kode'] ?? '');
                  if (strpos($k, '4') === 0) $has4 = true;
                  if (strpos($k, '5') === 0) $has5 = true;
                  if (strpos($k, '6') === 0) $has6 = true;
                }

                $pendRows = [];
                $belanjaRows = [];
                $terimaRows = [];
                $keluarRows = [];

                foreach ($list as $r) {
                  $k = trim($r['kode'] ?? '');
                  $u = strtolower(trim($r['uraian'] ?? ''));

                  // Lewati baris rekapitulasi agar tidak dihitung ganda
                  if (strpos($u, 'jumlah pendapatan') !== false ||
                      strpos($u, 'surplus') !== false || strpos($u, 'defisit') !== false ||
                      strpos($u, 'jumlah belanja') !== false ||
                      strpos($u, 'jumlah penerimaan') !== false ||
                      strpos($u, 'jumlah pengeluaran') !== false ||
                      strpos($u, 'pembiayaan netto') !== false ||
                      strpos($u, 'silpa') !== false) {
                    continue;
                  }

                  // 1. Pembiayaan
                  if (strpos($k, '6.1') === 0 || (!$has6 && strpos($k, '3.1') === 0) || (strpos($u, 'penerimaan') !== false && strpos($u, 'pembiayaan') !== false)) {
                    $terimaRows[] = $r;
                    continue;
                  }
                  if (strpos($k, '6.2') === 0 || (!$has6 && strpos($k, '3.2') === 0) || (strpos($u, 'pengeluaran') !== false && strpos($u, 'pembiayaan') !== false)) {
                    $keluarRows[] = $r;
                    continue;
                  }

                  // 2. Pendapatan
                  if (strpos($k, '4') === 0 || (!$has4 && strpos($k, '1') === 0) || strpos($u, 'pendapatan') !== false) {
                    $pendRows[] = $r;
                    continue;
                  }

                  // 3. Belanja
                  if (strpos($k, '5') === 0 || (!$has5 && strpos($k, '2') === 0) || strpos($u, 'belanja') !== false) {
                    $belanjaRows[] = $r;
                    continue;
                  }
                }

                $calcHierarchical = function($items) {
                  if (empty($items)) return 0;
                  $subjuduls = [];
                  $rincian = [];
                  $others = [];

                  foreach ($items as $r) {
                    $k = trim($r['kode'] ?? '');
                    $val = floatval($r['jumlah'] ?? 0);
                    $dots = substr_count($k, '.');
                    if ($dots == 1) {
                      $subjuduls[$k] = ['val' => $val, 'children' => 0, 'has_child' => false];
                    } else if ($dots >= 2) {
                      $rincian[] = ['kode' => $k, 'val' => $val];
                    } else {
                      $others[] = $val;
                    }
                  }

                  foreach ($rincian as $rin) {
                    $parts = explode('.', $rin['kode']);
                    $parentKey = $parts[0] . '.' . $parts[1];
                    if (isset($subjuduls[$parentKey])) {
                      $subjuduls[$parentKey]['children'] += $rin['val'];
                      $subjuduls[$parentKey]['has_child'] = true;
                    }
                  }

                  $total = 0;
                  if (!empty($subjuduls)) {
                    foreach ($subjuduls as $sj) {
                      $total += $sj['has_child'] ? $sj['children'] : $sj['val'];
                    }
                    foreach ($rincian as $rin) {
                      $parts = explode('.', $rin['kode']);
                      $parentKey = $parts[0] . '.' . $parts[1];
                      if (!isset($subjuduls[$parentKey])) {
                        $total += $rin['val'];
                      }
                    }
                  } else if (!empty($rincian)) {
                    foreach ($rincian as $rin) $total += $rin['val'];
                  } else {
                    foreach ($others as $ot) $total += $ot;
                  }

                  return $total;
                };

                $totPendapatan = $calcHierarchical($pendRows);
                $totBelanja = $calcHierarchical($belanjaRows);
                $surplusDefisit = $totPendapatan - $totBelanja;
                $totTerima = $calcHierarchical($terimaRows);
                $totKeluar = $calcHierarchical($keluarRows);
                $netto = $totTerima - $totKeluar;

                return [
                  'pendapatan' => $totPendapatan,
                  'belanja' => $totBelanja,
                  'surplus_defisit' => $surplusDefisit,
                  'penerimaan_pembiayaan' => $totTerima,
                  'pengeluaran_pembiayaan' => $totKeluar,
                  'pembiayaan_netto' => $netto
                ];
              }
            }

            $calcTotals = calcRAPBDTotalsHelper($RAPBDList ?? []);
            $calcTotPendapatan = $calcTotals['pendapatan'];
            $calcTotBelanja = $calcTotals['belanja'];
            $calcSurplusDefisit = $calcTotals['surplus_defisit'];
            $calcPenerimaan = $calcTotals['penerimaan_pembiayaan'];
            $calcPengeluaran = $calcTotals['pengeluaran_pembiayaan'];
            $calcPembiayaanNetto = $calcTotals['pembiayaan_netto'];

            $hasCode4 = false; $hasCode5 = false; $hasCode6 = false;
            if (!empty($RAPBDList)) {
              foreach ($RAPBDList as $r) {
                $k = trim($r['kode'] ?? '');
                if (strpos($k, '4') === 0) $hasCode4 = true;
                if (strpos($k, '5') === 0) $hasCode5 = true;
                if (strpos($k, '6') === 0) $hasCode6 = true;
              }
            }
            ?>
            
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-rapbd" id="tabel-rapbd-1">
                <thead>
                  <tr>
                    <th style="width: 10%;">KODE</th>
                    <th style="width: 48%;">URAIAN</th>
                    <th style="width: 24%;">JUMLAH (Rp)</th>
                    <th class="no-print aksi-col" style="width: 18%;">AKSI</th>
                  </tr>
                  <tr class="sub-header">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th class="no-print aksi-col">-</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($RAPBDList)) { ?>
                    <!-- KONDISI KETIKA BELUM ADA DATA INPUT -->
                    <tr>
                      <td colspan="4" class="text-center" style="padding: 45px 15px; color: #6b7280;">
                        <i class="fa fa-folder-open-o" style="font-size: 38px; color: #adb5bd; margin-bottom: 12px; display: block;"></i>
                        <span style="font-size: 15px; font-weight: 700; color: #374151;">Belum ada data RAPBD untuk tahun <?= $SelectedTahun ?>.</span><br>
                        <small class="text-muted">Klik tombol <b>Tambah Judul</b> untuk menambah judul tingkat atas melalui formulir Pop Up.</small>
                        <div style="margin-top: 15px;">
                          <button type="button" class="btn btn-sm btn-success notika-btn-success btn-tambah-utama" data-toggle="modal" data-target="#modalTambahRAPBD" style="border-radius: 6px; font-weight: 700; padding: 6px 14px;">
                            <i class="fa fa-plus-circle"></i> Tambah Judul
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php } else { ?>
                    <?php
                      $calcSubJudulSums = [];
                      $manualSummaryRows = [
                        'jumlah_pendapatan' => null,
                        'surplus_defisit' => null,
                        'penerimaan_pembiayaan' => null,
                        'pengeluaran_pembiayaan' => null,
                        'pembiayaan_netto' => null
                      ];

                      $groups = [];
                      $silpaRow = null;

                      // Pisahkan baris manual rekapitulasi, silpa, dan kelompokkan judul
                      foreach ($RAPBDList as $row) {
                        $k = trim($row['kode']);
                        $u = trim($row['uraian']);
                        $val = floatval($row['jumlah']);

                        if (stripos($u, 'Jumlah Pendapatan') !== false) {
                          $manualSummaryRows['jumlah_pendapatan'] = $row;
                          continue;
                        }
                        if (stripos($u, 'Surplus') !== false || stripos($u, 'Defisit') !== false) {
                          $manualSummaryRows['surplus_defisit'] = $row;
                          continue;
                        }
                        if (stripos($u, 'Jumlah Penerimaan Pembiayaan') !== false) {
                          $manualSummaryRows['penerimaan_pembiayaan'] = $row;
                          continue;
                        }
                        if (stripos($u, 'Jumlah Pengeluaran Pembiayaan') !== false) {
                          $manualSummaryRows['pengeluaran_pembiayaan'] = $row;
                          continue;
                        }
                        if (stripos($u, 'Pembiayaan Netto') !== false) {
                          $manualSummaryRows['pembiayaan_netto'] = $row;
                          continue;
                        }
                        if ($k === '6.3' || (stripos($u, 'SILPA') !== false && !empty($k))) {
                          $silpaRow = $row;
                          continue;
                        }

                        // Akumulasi rincian isi ke subjudul (misal 4.1.01 -> 4.1)
                        if (substr_count($k, '.') >= 2) {
                          $parts = explode('.', $k);
                          $subKey = $parts[0] . '.' . $parts[1];
                          if (!isset($calcSubJudulSums[$subKey])) $calcSubJudulSums[$subKey] = 0;
                          $calcSubJudulSums[$subKey] += $val;
                        }

                        $mainDigit = explode('.', $k)[0];
                        if (empty($mainDigit)) $mainDigit = 'lain';
                        $groups[$mainDigit][] = $row;
                      }

                      $renderedSummary = [
                        'jumlah_pendapatan' => false,
                        'surplus_defisit' => false,
                        'penerimaan_pembiayaan' => false,
                        'pengeluaran_pembiayaan' => false,
                        'pembiayaan_netto' => false
                      ];

                      // RENDER SETIAP KELOMPOK JUDUL
                      foreach ($groups as $mainDigit => $items) {
                        $totalJudul = 0;

                        // Render setiap baris dalam kelompok judul ini
                        foreach ($items as $it) {
                          $k = trim($it['kode']);
                          $u = trim($it['uraian']);
                          $dots = substr_count($k, '.');
                          $isJudul = ($dots == 0);
                          $isSubJudul = ($dots == 1);
                          $isIsi = ($dots >= 2);

                          $val = floatval($it['jumlah']);

                          if ($isJudul) {
                            // Baris Judul (4, 5, 6): Kolom jumlah KOSONG
                            ?>
                            <tr class="row-judul">
                              <td class="kode-col"><?= html_escape($k) ?></td>
                              <td class="uraian-col"><?= html_escape($u) ?></td>
                              <td class="jumlah-col"></td>
                              <td class="no-print aksi-col">
                                <button type="button" class="btn btn-xs btn-success notika-btn-success btn-action btn-action-tambah btn-tambah-subjudul" data-kode="<?= html_escape($k) ?>" data-uraian="<?= html_escape($u) ?>" title="Tambah Sub Judul di bawah <?= html_escape($u) ?>">
                                  <i class="fa fa-plus"></i> Sub Judul
                                </button>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $it['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $it['id'] ?>" data-uraian="<?= html_escape($u) ?>" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </td>
                            </tr>
                            <?php
                          } else if ($isSubJudul) {
                            if (isset($calcSubJudulSums[$k]) && $calcSubJudulSums[$k] > 0) {
                              $val = $calcSubJudulSums[$k];
                            }
                            $totalJudul += $val;
                            ?>
                            <tr class="row-sub-judul">
                              <td class="kode-col"><?= html_escape($k) ?></td>
                              <td class="uraian-col" style="padding-left: 15px;"><?= html_escape($u) ?></td>
                              <td class="jumlah-col"><?= number_format($val, 2, ',', '.') ?></td>
                              <td class="no-print aksi-col">
                                <button type="button" class="btn btn-xs btn-success notika-btn-success btn-action btn-action-tambah btn-tambah-isi" data-kode="<?= html_escape($k) ?>" data-uraian="<?= html_escape($u) ?>" title="Tambah Isi di bawah <?= html_escape($u) ?>">
                                  <i class="fa fa-plus"></i> Isi
                                </button>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $it['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $it['id'] ?>" data-uraian="<?= html_escape($u) ?>" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </td>
                            </tr>
                            <?php
                          } else {
                            // Isi / Rincian (Level 3)
                            ?>
                            <tr class="row-isi">
                              <td class="kode-col"><?= html_escape($k) ?></td>
                              <td class="uraian-col"><?= html_escape($u) ?></td>
                              <td class="jumlah-col"><?= number_format($val, 2, ',', '.') ?></td>
                              <td class="no-print aksi-col">
                                <button type="button" class="btn btn-xs btn-info notika-btn-info btn-action btn-action-tambah btn-tambah-rekap" data-parent-digit="<?= $mainDigit ?>" data-kode="<?= html_escape($k) ?>" data-uraian="<?= html_escape($u) ?>" title="Tambah Kategori Rekapitulasi (tertambah di bawah)">
                                  <i class="fa fa-calculator"></i> Rekapitulasi
                                </button>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $it['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $it['id'] ?>" data-uraian="<?= html_escape($u) ?>" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </td>
                            </tr>
                            <?php
                          }
                        }

                        // TAMPILKAN BARIS REKAPITULASI PADA SETIAP KELOMPOK
                        $firstUraian = strtolower($items[0]['uraian'] ?? '');
                        $isPendapatan = ($mainDigit == '4') || (!$hasCode4 && $mainDigit == '1') || (strpos($firstUraian, 'pendapatan') !== false);
                        $isBelanja = ($mainDigit == '5') || (!$hasCode5 && $mainDigit == '2') || (strpos($firstUraian, 'belanja') !== false);
                        $isPembiayaan = ($mainDigit == '6') || (!$hasCode6 && $mainDigit == '3') || (strpos($firstUraian, 'pembiayaan') !== false);

                        if ($isPendapatan) {
                          $renderedSummary['jumlah_pendapatan'] = true;
                          $dispVal = $manualSummaryRows['jumlah_pendapatan'] ? floatval($manualSummaryRows['jumlah_pendapatan']['jumlah']) : $calcTotPendapatan;
                          ?>
                          <tr class="row-total-judul">
                            <td class="kode-col"></td>
                            <td class="uraian-col font-weight-bold">Jumlah Pendapatan</td>
                            <td class="jumlah-col font-weight-bold"><?= number_format($dispVal, 2, ',', '.') ?></td>
                            <td class="no-print aksi-col">
                              <?php if ($manualSummaryRows['jumlah_pendapatan']) { ?>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $manualSummaryRows['jumlah_pendapatan']['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $manualSummaryRows['jumlah_pendapatan']['id'] ?>" data-uraian="Jumlah Pendapatan" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              <?php } ?>
                            </td>
                          </tr>
                          <?php
                        } else if ($isBelanja) {
                          $renderedSummary['surplus_defisit'] = true;
                          $dispSurplus = $manualSummaryRows['surplus_defisit'] ? floatval($manualSummaryRows['surplus_defisit']['jumlah']) : $calcSurplusDefisit;
                          ?>
                          <tr class="row-total-judul">
                            <td class="kode-col"></td>
                            <td class="uraian-col font-weight-bold">Jumlah Belanja</td>
                            <td class="jumlah-col font-weight-bold"><?= number_format($calcTotBelanja, 2, ',', '.') ?></td>
                            <td class="no-print aksi-col"></td>
                          </tr>
                          <tr class="row-surplus-defisit">
                            <td class="kode-col"></td>
                            <td class="uraian-col font-weight-bold">
                              SURPLUS / (DEFISIT)
                            </td>
                            <td class="jumlah-col font-weight-bold" style="color: <?= $dispSurplus >= 0 ? '#0ca678' : '#e03131' ?>;">
                              <?= ($dispSurplus < 0 ? '(' : '') . number_format(abs($dispSurplus), 2, ',', '.') . ($dispSurplus < 0 ? ')' : '') ?>
                            </td>
                            <td class="no-print aksi-col">
                              <?php if ($manualSummaryRows['surplus_defisit']) { ?>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $manualSummaryRows['surplus_defisit']['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $manualSummaryRows['surplus_defisit']['id'] ?>" data-uraian="Total Surplus/(Defisit)" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              <?php } ?>
                            </td>
                          </tr>
                          <?php
                        } else if ($isPembiayaan) {
                          $renderedSummary['penerimaan_pembiayaan'] = true;
                          $renderedSummary['pengeluaran_pembiayaan'] = true;
                          $renderedSummary['pembiayaan_netto'] = true;
                          $dispPenerimaan = $manualSummaryRows['penerimaan_pembiayaan'] ? floatval($manualSummaryRows['penerimaan_pembiayaan']['jumlah']) : $calcPenerimaan;
                          $dispPengeluaran = $manualSummaryRows['pengeluaran_pembiayaan'] ? floatval($manualSummaryRows['pengeluaran_pembiayaan']['jumlah']) : $calcPengeluaran;
                          $dispNetto = $manualSummaryRows['pembiayaan_netto'] ? floatval($manualSummaryRows['pembiayaan_netto']['jumlah']) : $calcPembiayaanNetto;
                          ?>
                          <tr class="row-total-judul">
                            <td class="kode-col"></td>
                            <td class="uraian-col font-weight-bold">Jumlah Penerimaan Pembiayaan</td>
                            <td class="jumlah-col font-weight-bold"><?= number_format($dispPenerimaan, 2, ',', '.') ?></td>
                            <td class="no-print aksi-col">
                              <?php if ($manualSummaryRows['penerimaan_pembiayaan']) { ?>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $manualSummaryRows['penerimaan_pembiayaan']['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $manualSummaryRows['penerimaan_pembiayaan']['id'] ?>" data-uraian="Jumlah Penerimaan Pembiayaan" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              <?php } ?>
                            </td>
                          </tr>
                          <tr class="row-total-judul">
                            <td class="kode-col"></td>
                            <td class="uraian-col font-weight-bold">Jumlah Pengeluaran Pembiayaan</td>
                            <td class="jumlah-col font-weight-bold"><?= number_format($dispPengeluaran, 2, ',', '.') ?></td>
                            <td class="no-print aksi-col">
                              <?php if ($manualSummaryRows['pengeluaran_pembiayaan']) { ?>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $manualSummaryRows['pengeluaran_pembiayaan']['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $manualSummaryRows['pengeluaran_pembiayaan']['id'] ?>" data-uraian="Jumlah Pengeluaran Pembiayaan" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              <?php } ?>
                            </td>
                          </tr>
                          <tr class="row-pembiayaan-netto">
                            <td class="kode-col"></td>
                            <td class="uraian-col font-weight-bold">Pembiayaan Netto</td>
                            <td class="jumlah-col font-weight-bold"><?= number_format($dispNetto, 2, ',', '.') ?></td>
                            <td class="no-print aksi-col">
                              <?php if ($manualSummaryRows['pembiayaan_netto']) { ?>
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $manualSummaryRows['pembiayaan_netto']['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $manualSummaryRows['pembiayaan_netto']['id'] ?>" data-uraian="Pembiayaan Netto" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              <?php } ?>
                            </td>
                          </tr>
                          <?php
                          if ($silpaRow) {
                            ?>
                            <tr class="row-silpa">
                              <td class="kode-col"><?= html_escape($silpaRow['kode']) ?></td>
                              <td class="uraian-col"><?= html_escape($silpaRow['uraian']) ?></td>
                              <td class="jumlah-col"><?= number_format(floatval($silpaRow['jumlah']), 2, ',', '.') ?></td>
                              <td class="no-print aksi-col">
                                <button type="button" class="btn btn-xs btn-warning btn-action btn-action-icon btn-edit-rapbd" data-id="<?= $silpaRow['id'] ?>" title="Edit Baris">
                                  <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-action btn-action-icon btn-hapus-rapbd" data-id="<?= $silpaRow['id'] ?>" data-uraian="<?= html_escape($silpaRow['uraian']) ?>" title="Hapus Baris">
                                  <i class="fa fa-trash"></i>
                                </button>
                              </td>
                            </tr>
                            <?php
                          }
                        } else {
                          ?>
                          <tr class="row-total-judul">
                            <td class="kode-col"></td>
                            <td class="uraian-col font-weight-bold">Jumlah Total</td>
                            <td class="jumlah-col font-weight-bold"><?= number_format($totalJudul, 2, ',', '.') ?></td>
                            <td class="no-print aksi-col"></td>
                          </tr>
                          <?php
                        }
                      }

                      // Pastikan baris rekapitulasi manual yang belum dicetak tetap tampil
                      foreach ($manualSummaryRows as $mKey => $mRow) {
                        if ($mRow && empty($renderedSummary[$mKey])) {
                          $val = floatval($mRow['jumlah']);
                          ?>
                          <tr class="row-total-judul">
                            <td class="kode-col"><?= html_escape($mRow['kode']) ?></td>
                            <td class="uraian-col font-weight-bold"><?= html_escape($mRow['uraian']) ?></td>
                            <td class="jumlah-col font-weight-bold"><?= number_format($val, 2, ',', '.') ?></td>
                            <td class="no-print aksi-col">
                              <button type="button" class="btn btn-xs btn-warning btn-action btn-edit-rapbd" data-id="<?= $mRow['id'] ?>" title="Edit Baris">
                                <i class="fa fa-pencil"></i>
                              </button>
                              <button type="button" class="btn btn-xs btn-danger btn-action btn-hapus-rapbd" data-id="<?= $mRow['id'] ?>" data-uraian="<?= html_escape($mRow['uraian']) ?>" title="Hapus Baris">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                          <?php
                        }
                      }
                    ?>
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

<!-- Modal Tambah RAPBD (Full CRUD Pop Up) -->
<div class="modal fade" id="modalTambahRAPBD" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <form id="formTambahRAPBD" method="POST">
        <input type="hidden" name="kodewilayah" value="<?= html_escape($KodeWilayah) ?>">
        <input type="hidden" name="tahun" value="<?= $SelectedTahun ?>">
        <input type="hidden" name="tabel" value="tabel_1">

        <div class="modal-header" style="background: #20c997; color: white; padding: 16px 22px;">
          <h5 class="modal-title font-weight-bold" id="modalTambahTitle" style="color: white; margin: 0; font-size: 16px;">
            <i class="fa fa-plus-circle"></i> Tambah Data RAPBD (Pop Up)
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.9;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 22px;">
          
          <div class="form-group">
            <label style="font-weight: 700; font-size: 13px;">Kategori Data <span class="text-danger">*</span></label>
            <select class="form-control" name="kategori" id="pilihLevelTambah" style="border-radius: 6px; font-weight: 600;">
              <optgroup label="Struktur Standar">
                <option value="isi" selected>Isi</option>
                <option value="subjudul">Sub Judul</option>
                <option value="judul">Judul</option>
              </optgroup>
              <optgroup label="Kategori Rekapitulasi Otomatis">
                <option value="jumlah_pendapatan">Jumlah Pendapatan</option>
                <option value="surplus_defisit">Total Surplus/(Defisit)</option>
                <option value="penerimaan_pembiayaan">Jumlah Penerimaan Pembiayaan</option>
                <option value="pengeluaran_pembiayaan">Jumlah Pengeluaran Pembiayaan</option>
                <option value="pembiayaan_netto">Pembiayaan Netto</option>
              </optgroup>
            </select>
          </div>

          <!-- Alert Info Perhitungan Otomatis -->
          <div id="alertAutoTambah" class="alert alert-info" style="display:none; padding: 10px 14px; border-radius: 6px; font-size: 12.5px; background-color: #e7f5ff; border: 1px solid #a5d8ff; color: #1971c2;"></div>

          <div class="form-group">
            <label style="font-weight: 700; font-size: 13px;">Kode</label>
            <input type="text" name="kode" id="tambah_kode" class="form-control" placeholder="Contoh: 4.1.01" style="border-radius: 6px; font-weight: 700;">
            <small class="text-muted" id="helpKode">Level Isi: Kode rincian (misal: 4.1.01, 5.1.01, 6.1.01).</small>
          </div>

          <div class="form-group">
            <label style="font-weight: 700; font-size: 13px;">Uraian <span class="text-danger">*</span></label>
            <input type="text" name="uraian" id="tambah_uraian" class="form-control" required placeholder="Contoh: Pajak Daerah" style="border-radius: 6px;">
          </div>

          <div class="form-group" id="groupJumlahTambah">
            <label style="font-weight: 700; font-size: 13px;">Jumlah (Rp)</label>
            <input type="text" name="jumlah" id="tambah_jumlah" class="form-control input-format-rupiah" placeholder="0" style="border-radius: 6px; font-weight: 700;">
            <small class="text-muted" id="helpJumlah">Masukkan nominal rupiah.</small>
          </div>
        </div>
        <div class="modal-footer" style="background: #f8f9fa; padding: 14px 22px;">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-success notika-btn-success" id="btnSimpanTambah" style="border-radius: 6px; font-weight: 700;">
            <i class="fa fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit RAPBD (Full CRUD Pop Up) -->
<div class="modal fade" id="modalEditRAPBD" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <form id="formEditRAPBD" method="POST">
        <input type="hidden" name="id" id="edit_id">
        <input type="hidden" name="tahun" value="<?= $SelectedTahun ?>">
        <input type="hidden" name="tabel" value="tabel_1">

        <div class="modal-header" style="background: #ff9800; color: white; padding: 16px 22px;">
          <h5 class="modal-title font-weight-bold" style="color: white; margin: 0; font-size: 16px;">
            <i class="fa fa-pencil"></i> Edit Data RAPBD (Pop Up)
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.9;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 22px;">

          <div class="form-group">
            <label style="font-weight: 700; font-size: 13px;">Kategori Data</label>
            <select class="form-control" name="kategori" id="modalEditKategori" style="border-radius: 6px; font-weight: 600;">
              <optgroup label="Struktur Standar">
                <option value="isi">Isi</option>
                <option value="subjudul">Sub Judul</option>
                <option value="judul">Judul</option>
              </optgroup>
              <optgroup label="Kategori Rekapitulasi Otomatis">
                <option value="jumlah_pendapatan">Jumlah Pendapatan</option>
                <option value="surplus_defisit">Total Surplus/(Defisit)</option>
                <option value="penerimaan_pembiayaan">Jumlah Penerimaan Pembiayaan</option>
                <option value="pengeluaran_pembiayaan">Jumlah Pengeluaran Pembiayaan</option>
                <option value="pembiayaan_netto">Pembiayaan Netto</option>
              </optgroup>
            </select>
          </div>

          <!-- Alert Info Perhitungan Otomatis di Modal Edit -->
          <div id="alertAutoEdit" class="alert alert-info" style="display:none; padding: 10px 14px; border-radius: 6px; font-size: 12.5px; margin-bottom: 15px;"></div>

          <div class="form-group">
            <label style="font-weight: 700; font-size: 13px;">Kode</label>
            <input type="text" name="kode" id="edit_kode" class="form-control" style="border-radius: 6px; font-weight: 700;">
          </div>
          <div class="form-group">
            <label style="font-weight: 700; font-size: 13px;">Uraian <span class="text-danger">*</span></label>
            <input type="text" name="uraian" id="edit_uraian" class="form-control" required style="border-radius: 6px;">
          </div>
          <div class="form-group" id="groupJumlahEdit">
            <label style="font-weight: 700; font-size: 13px;">Jumlah (Rp)</label>
            <input type="text" name="jumlah" id="edit_jumlah" class="form-control input-format-rupiah" style="border-radius: 6px; font-weight: 700;">
          </div>
        </div>
        <div class="modal-footer" style="background: #f8f9fa; padding: 14px 22px;">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-warning notika-btn-warning" id="btnSimpanEdit" style="border-radius: 6px; font-weight: 700;">
            <i class="fa fa-save"></i> Perbarui
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Nilai perhitungan otomatis terkini dari data tabel
  var autoCalcTotals = {
    jumlah_pendapatan: <?= (float)($calcTotPendapatan ?? 0) ?>,
    belanja: <?= (float)($calcTotBelanja ?? 0) ?>,
    surplus_defisit: <?= (float)($calcSurplusDefisit ?? 0) ?>,
    penerimaan_pembiayaan: <?= (float)($calcPenerimaan ?? 0) ?>,
    pengeluaran_pembiayaan: <?= (float)($calcPengeluaran ?? 0) ?>,
    pembiayaan_netto: <?= (float)($calcPembiayaanNetto ?? 0) ?>
  };

  function formatRupiahInput(val) {
    if (val === undefined || val === null || val === '') return '';
    var isNeg = (val.toString().indexOf('-') !== -1 || val.toString().indexOf('(') !== -1);
    var number_string = val.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa  = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      var separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    var res = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return isNeg ? ('-' + res) : res;
  }

  function formatNominal(num) {
    var n = parseFloat(num) || 0;
    var isNeg = n < 0;
    var absN = Math.round(Math.abs(n));
    var s = absN.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    return isNeg ? ('-' + s) : s;
  }

  $('.input-format-rupiah').on('keyup', function() {
    $(this).val(formatRupiahInput($(this).val()));
  });

  // Logika Terisi Otomatis Berdasarkan Kategori yang Dipilih
  function applyKategoriRules(mode) {
    var isTambah = (mode === 'tambah');
    var prefix = isTambah ? '#tambah_' : '#edit_';
    var kat = isTambah ? $('#pilihLevelTambah').val() : $('#modalEditKategori').val();
    var $alert = isTambah ? $('#alertAutoTambah') : $('#alertAutoEdit');
    var $inputJumlah = $(prefix + 'jumlah');
    var $inputKode = $(prefix + 'kode');
    var $inputUraian = $(prefix + 'uraian');
    var $helpKode = isTambah ? $('#helpKode') : null;
    var $helpJumlah = isTambah ? $('#helpJumlah') : null;

    // Reset default styling & status editable
    $alert.hide();
    $inputJumlah.prop('readonly', false).css({ 'background-color': '#fff', 'color': '#333' });
    $inputKode.prop('readonly', false).css({ 'background-color': '#fff', 'color': '#333' });
    $inputUraian.prop('readonly', false).css({ 'background-color': '#fff', 'color': '#333' });

    if (kat === 'judul') {
      $inputKode.attr('placeholder', 'Contoh: 4, 5, atau 6');
      if (isTambah && $inputKode.val() === '') $inputKode.val('');
      $inputUraian.attr('placeholder', 'Contoh: PEMBIAYAAN DAERAH');
      $inputJumlah.val('').prop('readonly', true).attr('placeholder', 'Dikosongkan untuk baris Judul').css({ 'background-color': '#f8fafc', 'color': '#94a3b8' });
      if ($helpKode) $helpKode.text('Level Judul: 1 digit angka (misal: 4, 5, 6). Kolom jumlah dikosongkan.');
      if ($helpJumlah) $helpJumlah.text('Pada baris Judul, nominal jumlah dikosongkan.');

    } else if (kat === 'subjudul') {
      $inputKode.attr('placeholder', 'Contoh: 4.1 atau 6.1');
      $inputUraian.attr('placeholder', 'Contoh: PENERIMAAN PEMBIAYAAN');
      $inputJumlah.attr('placeholder', '0');
      if ($helpKode) $helpKode.text('Level Sub Judul: misal 4.1, 5.1, 6.1, 6.2.');
      if ($helpJumlah) $helpJumlah.text('Nominal sub judul (atau terhitung otomatis dari rincian isi di bawahnya).');

    } else if (kat === 'isi') {
      $inputKode.attr('placeholder', 'Contoh: 4.1.01 atau 6.1.01');
      $inputUraian.attr('placeholder', 'Contoh: Pajak Daerah / Retribusi');
      $inputJumlah.attr('placeholder', '0');
      if ($helpKode) $helpKode.text('Level Isi: Kode rincian (misal: 4.1.01, 5.1.01, 6.1.01).');
      if ($helpJumlah) $helpJumlah.text('Masukkan nominal rupiah rincian.');

    } else if (kat === 'jumlah_pendapatan') {
      $inputKode.val('').prop('readonly', true).attr('placeholder', 'Otomatis Dikosongkan').css({ 'background-color': '#f8fafc' });
      $inputUraian.val('Jumlah Pendapatan').prop('readonly', true).css({ 'background-color': '#f8fafc', 'font-weight': '700' });
      var val = autoCalcTotals.jumlah_pendapatan || 0;
      $inputJumlah.val(formatNominal(val)).prop('readonly', true).css({ 'background-color': '#e8f5e9', 'color': '#1b5e20', 'font-weight': '700' });
      if ($helpKode) $helpKode.text('Kode otomatis dikosongkan untuk baris Jumlah Pendapatan.');
      if ($helpJumlah) $helpJumlah.text('Terisi otomatis dari total Pendapatan Daerah.');
      $alert.html('<div style="font-weight:700; margin-bottom:3px;"><i class="fa fa-calculator text-success"></i> TERISI OTOMATIS DARI PERHITUNGAN</div>Total Pendapatan saat ini: <b>Rp ' + formatNominal(val) + '</b>').removeClass('alert-info alert-danger').addClass('alert-success').show();

    } else if (kat === 'surplus_defisit') {
      $inputKode.val('').prop('readonly', true).attr('placeholder', 'Otomatis Dikosongkan').css({ 'background-color': '#f8fafc' });
      $inputUraian.val('Total Surplus/(Defisit)').prop('readonly', true).css({ 'background-color': '#f8fafc', 'font-weight': '700' });
      var val = autoCalcTotals.surplus_defisit || 0;
      var isDefisit = val < 0;
      $inputJumlah.val(formatNominal(val)).prop('readonly', true).css({ 'background-color': isDefisit ? '#ffebee' : '#e8f5e9', 'color': isDefisit ? '#c62828' : '#1b5e20', 'font-weight': '700' });
      if ($helpKode) $helpKode.text('Kode otomatis dikosongkan untuk baris Total Surplus/(Defisit).');
      if ($helpJumlah) $helpJumlah.text('Terisi otomatis dari (Jumlah Pendapatan - Jumlah Belanja).');
      var statusText = isDefisit ? '<span class="text-danger font-weight-bold">DEFISIT</span>' : '<span class="text-success font-weight-bold">SURPLUS</span>';
      $alert.html('<div style="font-weight:700; margin-bottom:3px;"><i class="fa fa-calculator"></i> TERISI OTOMATIS DARI PERHITUNGAN (' + statusText + ')</div>Rumus: <b>Pendapatan (Rp ' + formatNominal(autoCalcTotals.jumlah_pendapatan) + ') - Belanja (Rp ' + formatNominal(autoCalcTotals.belanja) + ')</b> = <b>Rp ' + formatNominal(val) + '</b>').removeClass('alert-success alert-danger alert-info').addClass(isDefisit ? 'alert-danger' : 'alert-success').show();

    } else if (kat === 'penerimaan_pembiayaan') {
      $inputKode.val('').prop('readonly', true).attr('placeholder', 'Otomatis Dikosongkan').css({ 'background-color': '#f8fafc' });
      $inputUraian.val('Jumlah Penerimaan Pembiayaan').prop('readonly', true).css({ 'background-color': '#f8fafc', 'font-weight': '700' });
      var val = autoCalcTotals.penerimaan_pembiayaan || 0;
      $inputJumlah.val(formatNominal(val)).prop('readonly', true).css({ 'background-color': '#e8f5e9', 'color': '#1b5e20', 'font-weight': '700' });
      if ($helpKode) $helpKode.text('Kode otomatis dikosongkan untuk baris Penerimaan Pembiayaan.');
      if ($helpJumlah) $helpJumlah.text('Terisi otomatis dari total Penerimaan Pembiayaan.');
      $alert.html('<div style="font-weight:700; margin-bottom:3px;"><i class="fa fa-calculator text-success"></i> TERISI OTOMATIS DARI PERHITUNGAN</div>Total Penerimaan Pembiayaan: <b>Rp ' + formatNominal(val) + '</b>').removeClass('alert-info alert-danger').addClass('alert-success').show();

    } else if (kat === 'pengeluaran_pembiayaan') {
      $inputKode.val('').prop('readonly', true).attr('placeholder', 'Otomatis Dikosongkan').css({ 'background-color': '#f8fafc' });
      $inputUraian.val('Jumlah Pengeluaran Pembiayaan').prop('readonly', true).css({ 'background-color': '#f8fafc', 'font-weight': '700' });
      var val = autoCalcTotals.pengeluaran_pembiayaan || 0;
      $inputJumlah.val(formatNominal(val)).prop('readonly', true).css({ 'background-color': '#e8f5e9', 'color': '#1b5e20', 'font-weight': '700' });
      if ($helpKode) $helpKode.text('Kode otomatis dikosongkan untuk baris Pengeluaran Pembiayaan.');
      if ($helpJumlah) $helpJumlah.text('Terisi otomatis dari total Pengeluaran Pembiayaan.');
      $alert.html('<div style="font-weight:700; margin-bottom:3px;"><i class="fa fa-calculator text-success"></i> TERISI OTOMATIS DARI PERHITUNGAN</div>Total Pengeluaran Pembiayaan: <b>Rp ' + formatNominal(val) + '</b>').removeClass('alert-info alert-danger').addClass('alert-success').show();

    } else if (kat === 'pembiayaan_netto') {
      $inputKode.val('').prop('readonly', true).attr('placeholder', 'Otomatis Dikosongkan').css({ 'background-color': '#f8fafc' });
      $inputUraian.val('Pembiayaan Netto').prop('readonly', true).css({ 'background-color': '#f8fafc', 'font-weight': '700' });
      var val = autoCalcTotals.pembiayaan_netto || 0;
      var isDefisit = val < 0;
      $inputJumlah.val(formatNominal(val)).prop('readonly', true).css({ 'background-color': isDefisit ? '#ffebee' : '#e8f5e9', 'color': isDefisit ? '#c62828' : '#1b5e20', 'font-weight': '700' });
      if ($helpKode) $helpKode.text('Kode otomatis dikosongkan untuk baris Pembiayaan Netto.');
      if ($helpJumlah) $helpJumlah.text('Terisi otomatis dari (Penerimaan Pembiayaan - Pengeluaran Pembiayaan).');
      $alert.html('<div style="font-weight:700; margin-bottom:3px;"><i class="fa fa-calculator"></i> TERISI OTOMATIS DARI PERHITUNGAN</div>Rumus: <b>Penerimaan (Rp ' + formatNominal(autoCalcTotals.penerimaan_pembiayaan) + ') - Pengeluaran (Rp ' + formatNominal(autoCalcTotals.pengeluaran_pembiayaan) + ')</b> = <b>Rp ' + formatNominal(val) + '</b>').removeClass('alert-success alert-danger alert-info').addClass(isDefisit ? 'alert-danger' : 'alert-success').show();
    }
  }

  // Fungsi Helper Menyetel Opsi Dropdown Kategori Tambah secara Dinamis
  function setOptionsTambah(type, selectedVal) {
    var $sel = $('#pilihLevelTambah');
    $sel.empty();
    if (type === 'judul') {
      $sel.append('<option value="judul" selected>Judul</option>');
    } else if (type === 'subjudul') {
      $sel.append('<option value="subjudul" selected>Sub Judul</option>');
    } else if (type === 'isi') {
      $sel.append('<option value="isi" selected>Isi</option>');
    } else if (type === 'rekap') {
      $sel.append('<option value="jumlah_pendapatan">Jumlah Pendapatan</option>');
      $sel.append('<option value="surplus_defisit">Total Surplus/(Defisit)</option>');
      $sel.append('<option value="penerimaan_pembiayaan">Jumlah Penerimaan Pembiayaan</option>');
      $sel.append('<option value="pengeluaran_pembiayaan">Jumlah Pengeluaran Pembiayaan</option>');
      $sel.append('<option value="pembiayaan_netto">Pembiayaan Netto</option>');
      if (selectedVal) {
        $sel.val(selectedVal);
      }
    } else {
      $sel.append('<optgroup label="Struktur Standar"><option value="isi" selected>Isi</option><option value="subjudul">Sub Judul</option><option value="judul">Judul</option></optgroup>');
      $sel.append('<optgroup label="Kategori Rekapitulasi Otomatis"><option value="jumlah_pendapatan">Jumlah Pendapatan</option><option value="surplus_defisit">Total Surplus/(Defisit)</option><option value="penerimaan_pembiayaan">Jumlah Penerimaan Pembiayaan</option><option value="pengeluaran_pembiayaan">Jumlah Pengeluaran Pembiayaan</option><option value="pembiayaan_netto">Pembiayaan Netto</option></optgroup>');
      if (selectedVal) {
        $sel.val(selectedVal);
      }
    }
    applyKategoriRules('tambah');
  }

  // Event change kategori
  $('#pilihLevelTambah').on('change', function() {
    applyKategoriRules('tambah');
  });

  $('#modalEditKategori').on('change', function() {
    applyKategoriRules('edit');
  });

  $('#modalTambahRAPBD').on('show.bs.modal', function() {
    if (!$('#pilihLevelTambah').val()) {
      setOptionsTambah('judul');
    } else {
      applyKategoriRules('tambah');
    }
  });

  // Handle klik Tambah Judul Utama (di atas tabel)
  $(document).on('click', '#btnTambahBarisUtama, .btn-tambah-utama', function() {
    $('#modalTambahTitle').html('<i class="fa fa-plus-circle"></i> Tambah Judul (Pop Up)');
    $('#formTambahRAPBD')[0].reset();
    setOptionsTambah('judul');
  });

  // Handle Tombol Tambah Sub Judul (berada di kolom aksi baris judul)
  $(document).on('click', '.btn-tambah-subjudul', function(e) {
    e.preventDefault();
    var parentKode = $(this).data('kode') ? String($(this).data('kode')).trim() : '';
    var parentUraian = $(this).data('uraian') ? String($(this).data('uraian')).trim() : '';
    
    $('#modalTambahTitle').html('<i class="fa fa-plus-circle"></i> Tambah Sub Judul <small style="display:block; color:#e6fcf5; font-size:12px; margin-top:3px; font-weight:normal;">Parent Judul: <b>' + (parentKode ? (parentKode + ' ') : '') + parentUraian + '</b></small>');
    
    setOptionsTambah('subjudul');
    $('#tambah_kode').val(parentKode ? (parentKode + '.') : '');
    $('#tambah_uraian').val('');
    $('#tambah_jumlah').val('');
    
    $('#modalTambahRAPBD').modal('show');
    setTimeout(function() {
      var kElem = document.getElementById('tambah_kode');
      if (kElem) {
        kElem.focus();
        kElem.setSelectionRange(kElem.value.length, kElem.value.length);
      }
    }, 400);
  });

  // Handle Tombol Tambah Isi (berada di kolom aksi baris sub judul)
  $(document).on('click', '.btn-tambah-isi', function(e) {
    e.preventDefault();
    var parentKode = $(this).data('kode') ? String($(this).data('kode')).trim() : '';
    var parentUraian = $(this).data('uraian') ? String($(this).data('uraian')).trim() : '';
    
    $('#modalTambahTitle').html('<i class="fa fa-plus-circle"></i> Tambah Isi / Rincian <small style="display:block; color:#e6fcf5; font-size:12px; margin-top:3px; font-weight:normal;">Parent Sub Judul: <b>' + (parentKode ? (parentKode + ' ') : '') + parentUraian + '</b></small>');
    
    setOptionsTambah('isi');
    $('#tambah_kode').val(parentKode ? (parentKode + '.') : '');
    $('#tambah_uraian').val('');
    $('#tambah_jumlah').val('');
    
    $('#modalTambahRAPBD').modal('show');
    setTimeout(function() {
      var kElem = document.getElementById('tambah_kode');
      if (kElem) {
        kElem.focus();
        kElem.setSelectionRange(kElem.value.length, kElem.value.length);
      }
    }, 400);
  });

  // Handle Tombol Tambah Rekapitulasi (berada di kolom aksi baris isi)
  $(document).on('click', '.btn-tambah-rekap', function(e) {
    e.preventDefault();
    var parentDigit = $(this).data('parent-digit') ? String($(this).data('parent-digit')).trim() : '';
    var parentKode = $(this).data('kode') ? String($(this).data('kode')).trim() : '';
    var parentUraian = $(this).data('uraian') ? String($(this).data('uraian')).trim() : '';
    
    var defaultRekap = 'jumlah_pendapatan';
    if (parentDigit === '5' || parentKode.indexOf('5') === 0 || parentKode.indexOf('2') === 0) {
      defaultRekap = 'surplus_defisit';
    } else if (parentDigit === '6' || parentKode.indexOf('6') === 0 || parentKode.indexOf('3') === 0) {
      defaultRekap = 'penerimaan_pembiayaan';
    } else {
      defaultRekap = 'jumlah_pendapatan';
    }
    
    $('#modalTambahTitle').html('<i class="fa fa-calculator"></i> Tambah Kategori Rekapitulasi <small style="display:block; color:#e6fcf5; font-size:12px; margin-top:3px; font-weight:normal;">(Akan tertambah di bawah baris terkait)</small>');
    
    setOptionsTambah('rekap', defaultRekap);
    $('#modalTambahRAPBD').modal('show');
  });

  // CREATE: Submit Form Modal Tambah Data
  $('#formTambahRAPBD').on('submit', function(e) {
    e.preventDefault();
    $('#btnSimpanTambah').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
    $.ajax({
      url: '<?= base_url("Daerah/InputRAPBD") ?>',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(resp) {
        if (resp.status === 'success') {
          location.reload();
        } else {
          alert(resp.message || 'Gagal menyimpan data.');
          $('#btnSimpanTambah').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
        }
      },
      error: function() {
        alert('Terjadi kesalahan koneksi server.');
        $('#btnSimpanTambah').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
      }
    });
  });

  // READ & POPULATE: Ambil Data By ID untuk Edit
  $(document).on('click', '.btn-edit-rapbd', function() {
    var id = $(this).data('id');
    $.ajax({
      url: '<?= base_url("Daerah/GetRAPBDById") ?>',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(resp) {
        if (resp.status === 'success') {
          var d = resp.data;
          $('#edit_id').val(d.id);
          $('#edit_kode').val(d.kode);
          $('#edit_uraian').val(d.uraian);
          var valNum = parseFloat(d.jumlah) || 0;
          $('#edit_jumlah').val(formatRupiahInput(Math.round(valNum).toString()));

          // Deteksi kategori untuk dropdown Edit
          var u = d.uraian || '';
          var k = d.kode || '';
          var detKat = 'isi';
          if (u.indexOf('Jumlah Pendapatan') !== -1) detKat = 'jumlah_pendapatan';
          else if (u.indexOf('Surplus') !== -1 || u.indexOf('Defisit') !== -1) detKat = 'surplus_defisit';
          else if (u.indexOf('Jumlah Penerimaan Pembiayaan') !== -1) detKat = 'penerimaan_pembiayaan';
          else if (u.indexOf('Jumlah Pengeluaran Pembiayaan') !== -1) detKat = 'pengeluaran_pembiayaan';
          else if (u.indexOf('Pembiayaan Netto') !== -1) detKat = 'pembiayaan_netto';
          else if (k && k.indexOf('.') === -1) detKat = 'judul';
          else if (k && (k.match(/\./g) || []).length === 1) detKat = 'subjudul';
          else detKat = 'isi';

          $('#modalEditKategori').val(detKat).trigger('change');
          $('#modalEditRAPBD').modal('show');
        } else {
          alert(resp.message || 'Data tidak ditemukan.');
        }
      }
    });
  });

  // UPDATE: Simpan Perubahan Data
  $('#formEditRAPBD').on('submit', function(e) {
    e.preventDefault();
    $('#btnSimpanEdit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');
    $.ajax({
      url: '<?= base_url("Daerah/UpdateRAPBD") ?>',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(resp) {
        if (resp.status === 'success') {
          location.reload();
        } else {
          alert(resp.message || 'Gagal memperbarui data.');
          $('#btnSimpanEdit').prop('disabled', false).html('<i class="fa fa-save"></i> Perbarui');
        }
      },
      error: function() {
        alert('Terjadi kesalahan koneksi server.');
        $('#btnSimpanEdit').prop('disabled', false).html('<i class="fa fa-save"></i> Perbarui');
      }
    });
  });

  // DELETE: Hapus Baris Tunggal
  $(document).on('click', '.btn-hapus-rapbd', function() {
    var id = $(this).data('id');
    var uraian = $(this).data('uraian');
    if (!confirm('Apakah Anda yakin ingin menghapus item: "' + uraian + '"?')) {
      return;
    }
    $.ajax({
      url: '<?= base_url("Daerah/DeleteRAPBD") ?>',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(resp) {
        if (resp.status === 'success') {
          location.reload();
        } else {
          alert(resp.message || 'Gagal menghapus data.');
        }
      }
    });
  });

  // DELETE ALL: Kosongkan Semua Data Tahun Ini
  $('#btnClearTabel1').on('click', function() {
    if (!confirm('Apakah Anda yakin ingin MENGHAPUS SEMUA DATA Tabel 1 untuk tahun <?= $SelectedTahun ?>?')) {
      return;
    }
    $.ajax({
      url: '<?= base_url("Daerah/ClearRAPBDTabel1") ?>',
      type: 'POST',
      data: {
        kodewilayah: '<?= html_escape($KodeWilayah) ?>',
        tahun: '<?= $SelectedTahun ?>'
      },
      dataType: 'json',
      success: function(resp) {
        if (resp.status === 'success') {
          location.reload();
        } else {
          alert(resp.message || 'Gagal mengosongkan data.');
        }
      }
    });
  });
});
</script>
</body>
</html>
