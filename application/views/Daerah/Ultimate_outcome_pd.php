<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Dependencies -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
:root {
  --l1-color: #1e40af;
  --l1-bg: #eff6ff;
  --l1-border: #3b82f6;

  --l2-color: #0369a1;
  --l2-bg: #f0f9ff;
  --l2-border: #0ea5e9;

  --l3-color: #0f766e;
  --l3-bg: #f0fdfa;
  --l3-border: #14b8a6;

  --l4-color: #7e22ce;
  --l4-bg: #faf5ff;
  --l4-border: #a855f7;
}

.data-table-list {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
  padding: 24px;
  margin-bottom: 30px;
}

/* Header & Controls */
.pk-control-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 20px;
  padding-bottom: 16px;
  border-bottom: 1px solid #e2e8f0;
}

.pk-title-area h3 {
  font-size: 20px;
  font-weight: 700;
  color: #1e293b;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 10px;
}

.pk-title-area p {
  margin: 4px 0 0 0;
  font-size: 13px;
  color: #64748b;
}

.pk-stats-bar {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 20px;
}

.stat-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  border: 1px solid #e2e8f0;
  background: #f8fafc;
  color: #334155;
}

.stat-badge .dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
}

.stat-badge .count {
  background: white;
  padding: 2px 8px;
  border-radius: 10px;
  font-size: 11px;
  border: 1px solid #cbd5e1;
}

/* Hierarchical Tree Table */
.tree-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

.tree-table thead th {
  background: #f8fafc;
  color: #475569;
  font-weight: 700;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 12px 14px;
  border-bottom: 2px solid #e2e8f0;
  vertical-align: middle;
}

.tree-table tbody tr {
  transition: all 0.15s ease;
}

.tree-table tbody tr:hover {
  filter: brightness(0.97);
}

.tree-table td {
  padding: 12px 14px;
  vertical-align: middle;
  border-top: 1px solid #f1f5f9;
  font-size: 13px;
}

/* Level Row Backgrounds & Borders */
.row-l1 { background-color: var(--l1-bg) !important; font-weight: 600; }
.row-l1 td:nth-child(2) { border-left: 5px solid var(--l1-border) !important; }

.row-l2 { background-color: var(--l2-bg) !important; }
.row-l2 td:nth-child(2) { border-left: 5px solid var(--l2-border) !important; }

.row-l3 { background-color: var(--l3-bg) !important; }
.row-l3 td:nth-child(2) { border-left: 5px solid var(--l3-border) !important; }

.row-l4 { background-color: var(--l4-bg) !important; }
.row-l4 td:nth-child(2) { border-left: 5px solid var(--l4-border) !important; }

/* Level Badges */
.badge-lvl {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 8px;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 700;
  color: white;
  text-transform: uppercase;
  letter-spacing: 0.4px;
}
.badge-lvl-1 { background: var(--l1-color); }
.badge-lvl-2 { background: var(--l2-color); }
.badge-lvl-3 { background: var(--l3-color); }
.badge-lvl-4 { background: var(--l4-color); }

/* Indentations & Toggle Chevron */
.tree-node-content {
  display: flex;
  align-items: flex-start;
  gap: 8px;
}

.tree-indent-1 { padding-left: 4px !important; }
.tree-indent-2 { padding-left: 28px !important; }
.tree-indent-3 { padding-left: 52px !important; }
.tree-indent-4 { padding-left: 76px !important; }

.toggle-btn {
  background: none;
  border: none;
  color: #64748b;
  cursor: pointer;
  padding: 2px 6px;
  font-size: 12px;
  transition: transform 0.2s ease;
  outline: none;
}
.toggle-btn:hover { color: #1e293b; }
.toggle-btn.collapsed i { transform: rotate(-90deg); }

/* Action Button Groups */
.action-btn-group {
  display: flex;
  flex-wrap: wrap;
  gap: 4px;
  justify-content: center;
  align-items: center;
}

.action-btn-group .btn {
  padding: 4px 8px;
  font-size: 11px;
  font-weight: 600;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

/* Indicators and Pelaksana format */
.indicator-tag {
  display: block;
  background: white;
  border: 1px solid #e2e8f0;
  padding: 3px 8px;
  border-radius: 6px;
  font-size: 11px;
  margin-bottom: 3px;
  color: #334155;
}

.pelaksana-box {
  font-size: 11px;
  line-height: 1.4;
}
.pelaksana-box .dinas-name {
  font-weight: 700;
  color: #1e40af;
}
.pelaksana-box .karyawan-name {
  color: #475569;
}

/* Modal Positioning & Centering */
.modal {
  text-align: center !important;
  padding: 0 !important;
  z-index: 105000 !important;
  overflow-y: auto !important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block !important;
  text-align: left !important;
  vertical-align: middle !important;
  margin: 30px auto !important;
}

.modal-backdrop {
  z-index: 104990 !important;
}

.modal-content {
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.25);
  border: none;
  overflow: hidden;
}

.modal-header {
  border-bottom: 1px solid #e2e8f0;
  padding: 16px 24px;
}
.modal-header h4, .modal-header h3 {
  font-size: 18px;
  font-weight: 700;
  margin: 0;
}
.modal-body {
  padding: 20px 24px;
  max-height: calc(85vh - 140px);
  overflow-y: auto;
}
.modal-footer {
  border-top: 1px solid #e2e8f0;
  padding: 14px 24px;
}

.field-row {
  display: flex;
  gap: 8px;
  margin-bottom: 8px;
}
.field-row input {
  flex: 1;
}

.select2-container {
  width: 100% !important;
}
.select2-container--open,
.select2-dropdown {
  z-index: 105050 !important;
}
</style>

<div class="main-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">

          <!-- ================= FILTER WILAYAH (SEBELUM LOGIN) ================= -->
          <?php if (!isset($_SESSION['KodeWilayah'])): ?>
            <div class="well well-sm" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; margin-bottom:20px; padding:16px;">
              <div class="row">
                <div class="col-lg-3 col-md-6">
                  <label><b>Provinsi</b></label>
                  <select class="form-control" id="Provinsi">
                    <option value="">Pilih Provinsi</option>
                    <?php foreach ($Provinsi as $prov): ?>
                      <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                        <?= html_escape($prov['Nama']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-3 col-md-6">
                  <label><b>Kab/Kota</b></label>
                  <select class="form-control" id="KabKota" <?= empty($KodeWilayah) ? 'disabled' : '' ?>>
                    <option value="">Pilih Kab/Kota</option>
                  </select>
                </div>
                <div class="col-lg-3 col-md-6" id="FilterInstansiBeforeGroup" style="display: none;">
                  <label><b>Filter Instansi</b></label>
                  <select class="form-control" id="FilterInstansiBeforeLogin">
                    <option value="">-- Semua Instansi --</option>
                  </select>
                </div>
                <div class="col-lg-3 col-md-6" style="margin-top: 25px;">
                  <button class="btn btn-primary btn-block" id="Filter">
                    Filter
                  </button>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <!-- FILTER INSTANSI (LOGIN NON-ROLE 4) -->
          <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)): ?>
            <div class="well well-sm" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; margin-bottom:20px; padding:16px;">
              <div class="row">
                <div class="col-lg-8 col-md-8">
                  <label><b>Filter Instansi Perangkat Daerah</b></label>
                  <select id="FilterInstansi" class="form-control">
                    <option value="">-- Semua Instansi --</option>
                    <?php foreach ($ListInstansi as $ins): ?>
                      <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                        <?= html_escape($ins['nama']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-4 col-md-4" style="margin-top: 25px;">
                  <button class="btn btn-primary" id="FilterInstansiBtn">Tampilkan</button>
                  <button class="btn btn-default" id="ResetFilterBtn">Reset</button>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <!-- ================= KONTROL & STATS BAR ================= -->
          <div class="pk-control-bar">
            <div class="pk-title-area">
              <h3>
                Pohon Kinerja Perangkat Daerah
                <?php if (!empty($NamaInstansi)): ?>
                  <span class="badge badge-info" style="font-size:13px; font-weight:normal;"><?= html_escape($NamaInstansi) ?></span>
                <?php elseif (!empty($NamaWilayah)): ?>
                  <span class="badge badge-info" style="font-size:13px; font-weight:normal;"><?= html_escape($NamaWilayah) ?></span>
                <?php endif; ?>
              </h3>
              <p>Kelola data pohon kinerja 4 level perangkat daerah secara berhierarki (Ultimate Outcome PD &rarr; Intermediate &rarr; Immediate &rarr; Output)</p>
            </div>
            
            <div class="pk-actions">
              <?php if ($IsRole4): ?>
                <button type="button" class="btn btn-primary" id="btn-tambah-l1" style="font-weight:600;">
                  Tambah Ultimate Outcome PD (Level 1)
                </button>
              <?php endif; ?>
              
              <button type="button" class="btn btn-default" onclick="expandAll()" title="Buka Semua Level">
                Expand All
              </button>
              <button type="button" class="btn btn-default" onclick="collapseAll()" title="Tutup Semua Level">
                Collapse All
              </button>
              <a href="<?= base_url('Instansi/TampilPohonKinerjaPD') ?>" class="btn btn-info" target="_blank" title="Buka Bagan Pohon">
                Lihat Bagan Pohon
              </a>
            </div>
          </div>

          <!-- ================= STATS CHIPS ================= -->
          <div class="pk-stats-bar">
            <div class="stat-badge">
              <span class="dot" style="background:var(--l1-color)"></span>
              Ultimate Outcome PD: <span class="count"><?= $TotalData['level1'] ?? 0 ?></span>
            </div>
            <div class="stat-badge">
              <span class="dot" style="background:var(--l2-color)"></span>
              Intermediate Outcome PD: <span class="count"><?= $TotalData['level2'] ?? 0 ?></span>
            </div>
            <div class="stat-badge">
              <span class="dot" style="background:var(--l3-color)"></span>
              Immediate Outcome PD: <span class="count"><?= $TotalData['level3'] ?? 0 ?></span>
            </div>
            <div class="stat-badge">
              <span class="dot" style="background:var(--l4-color)"></span>
              Output PD: <span class="count"><?= $TotalData['level4'] ?? 0 ?></span>
            </div>
          </div>

          <!-- ================= TABEL HIERARKI ================= -->
          <div class="table-responsive">
            <table class="table tree-table" id="table-hierarki-pk-pd">
              <thead>
                <tr>
                  <th width="4%" class="text-center">No</th>
                  <th width="42%">Uraian Kinerja</th>
                  <th width="20%">Indikator Kinerja</th>
                  <th width="16%">Perangkat Daerah / Pelaksana</th>
                  <?php if ($IsRole4): ?>
                    <th width="18%" class="text-center">Aksi</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($hierarchy)): ?>
                  <tr>
                    <td colspan="<?= $IsRole4 ? '5' : '4' ?>" class="text-center" style="padding: 40px;">
                      <p class="text-muted" style="margin:0;">Belum ada data pohon kinerja untuk perangkat daerah ini.</p>
                      <?php if ($IsRole4): ?>
                        <button type="button" class="btn btn-sm btn-primary mt-2" id="btn-tambah-l1-empty">
                          Tambah Ultimate Outcome PD Pertama
                        </button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php else: ?>
                  <?php 
                  $no1 = 1;
                  foreach ($hierarchy as $u): 
                    $hasChild1 = !empty($u['intermediate']);
                  ?>
                    <!-- LEVEL 1: ULTIMATE OUTCOME PD -->
                    <tr class="row-l1" id="row-u-<?= $u['id'] ?>" data-node-id="u-<?= $u['id'] ?>" data-level="1">
                      <td class="text-center"><b><?= $no1 ?></b></td>
                      <td class="tree-indent-1">
                        <div class="tree-node-content">
                          <?php if ($hasChild1): ?>
                            <button type="button" class="toggle-btn" onclick="toggleRow('u-<?= $u['id'] ?>')">
                              <i class="fa fa-chevron-down"></i>
                            </button>
                          <?php else: ?>
                            <span style="width:20px; display:inline-block;"></span>
                          <?php endif; ?>
                          <div>
                            <span class="badge-lvl badge-lvl-1">ULTIMATE OUTCOME PD</span>
                            <div style="margin-top: 4px; font-size: 13.5px; color: #1e3a8a;">
                              <?= html_escape($u['kinerja']) ?>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php 
                        if (!empty($u['indikator'])) {
                          $indikator_parts = explode('|||', $u['indikator']);
                          $display_indikator = [];
                          
                          if (count($indikator_parts) % 2 === 0 && ($indikator_parts[0] === 'sektor' || $indikator_parts[0] === 'taktikal')) {
                            for ($i = 0; $i < count($indikator_parts); $i += 2) {
                              if (isset($indikator_parts[$i + 1])) {
                                $kategori = $indikator_parts[$i];
                                $sumber_id = $indikator_parts[$i + 1];
                                $sumber_text = '';
                                if ($kategori === 'sektor') {
                                  foreach ($intermediate_sektor as $s) {
                                    if ($s['id'] == $sumber_id) { $sumber_text = $s['kinerja']; break; }
                                  }
                                } elseif ($kategori === 'taktikal') {
                                  foreach ($intermediate_taktikal as $t) {
                                    if ($t['id'] == $sumber_id) { $sumber_text = $t['kinerja']; break; }
                                  }
                                }
                                if ($sumber_text) {
                                  $display_indikator[] = '<span class="indicator-tag">' . html_escape($sumber_text) . '</span>';
                                }
                              }
                            }
                          } else {
                            foreach ($indikator_parts as $ind) {
                              if (trim($ind)) $display_indikator[] = '<span class="indicator-tag">' . html_escape($ind) . '</span>';
                            }
                          }
                          
                          if (!empty($display_indikator)) {
                            echo implode(' ', $display_indikator);
                          } else {
                            echo '<span class="text-muted">-</span>';
                          }
                        } else {
                          echo '<span class="text-muted">-</span>';
                        }
                        ?>
                      </td>
                      <td><span class="text-muted"><?= html_escape($NamaInstansi ?: 'Perangkat Daerah') ?></span></td>
                      <?php if ($IsRole4): ?>
                        <td class="text-center">
                          <div class="action-btn-group">
                            <button type="button" class="btn btn-xs btn-success btn-add-child-l2" 
                              data-ultimate="<?= $u['id'] ?>" 
                              data-parent-kinerja="<?= html_escape($u['kinerja']) ?>" 
                              title="Tambah Intermediate">
                              + Intermediate
                            </button>
                            <button type="button" class="btn btn-xs btn-warning btn-edit-level1" 
                              data-id="<?= $u['id'] ?>" 
                              data-kinerja="<?= html_escape($u['kinerja']) ?>" 
                              data-indikator="<?= html_escape($u['indikator']) ?>" 
                              title="Edit">
                              Edit
                            </button>
                            <button type="button" class="btn btn-xs btn-danger btn-hapus-level1" data-id="<?= $u['id'] ?>" title="Hapus">
                              Hapus
                            </button>
                          </div>
                        </td>
                      <?php endif; ?>
                    </tr>

                    <!-- LEVEL 2: INTERMEDIATE OUTCOME PD -->
                    <?php 
                    $no2 = 1;
                    foreach ($u['intermediate'] as $inter): 
                      $hasChild2 = !empty($inter['immediate']);
                    ?>
                      <tr class="row-l2 child-of-u-<?= $u['id'] ?>" id="row-inter-<?= $inter['id'] ?>" data-node-id="inter-<?= $inter['id'] ?>" data-parent="u-<?= $u['id'] ?>" data-level="2">
                        <td class="text-center text-muted"><small><?= $no1 . '.' . $no2 ?></small></td>
                        <td class="tree-indent-2">
                          <div class="tree-node-content">
                            <?php if ($hasChild2): ?>
                              <button type="button" class="toggle-btn" onclick="toggleRow('inter-<?= $inter['id'] ?>')">
                                <i class="fa fa-chevron-down"></i>
                              </button>
                            <?php else: ?>
                              <span style="width:20px; display:inline-block;"></span>
                            <?php endif; ?>
                            <div>
                              <span class="badge-lvl badge-lvl-2">INTERMEDIATE OUTCOME PD</span>
                              <div style="margin-top: 4px; font-weight: 600; color: #0369a1;">
                                <?= html_escape($inter['kinerja']) ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <?php 
                          if (!empty($inter['indikator'])) {
                            $inds = explode('|||', $inter['indikator']);
                            foreach ($inds as $ind) {
                              if (trim($ind)) echo '<span class="indicator-tag">' . html_escape($ind) . '</span>';
                            }
                          } else {
                            echo '<span class="text-muted">-</span>';
                          }
                          ?>
                        </td>
                        <td>
                          <div class="pelaksana-box">
                            <?php if (!empty($inter['pelaksana_detail'])): ?>
                              <div class="dinas-name"><?= html_escape($inter['pelaksana_detail']['dinas']) ?></div>
                              <div class="karyawan-name"><?= html_escape($inter['pelaksana_detail']['nama']) ?></div>
                            <?php else: ?>
                              <span class="text-muted">-</span>
                            <?php endif; ?>
                          </div>
                        </td>
                        <?php if ($IsRole4): ?>
                          <td class="text-center">
                            <div class="action-btn-group">
                              <button type="button" class="btn btn-xs btn-info btn-add-child-l3" 
                                data-intermediate="<?= $inter['id'] ?>" 
                                data-parent-kinerja="<?= html_escape($inter['kinerja']) ?>" 
                                title="Tambah Immediate">
                                + Immediate
                              </button>
                              <button type="button" class="btn btn-xs btn-warning btn-edit-level2" 
                                data-id="<?= $inter['id'] ?>" 
                                data-ultimate="<?= $inter['ultimate_outcome_id'] ?>" 
                                data-parent-kinerja="<?= html_escape($u['kinerja']) ?>" 
                                data-kinerja="<?= html_escape($inter['kinerja']) ?>" 
                                data-indikator="<?= html_escape($inter['indikator']) ?>" 
                                data-pelaksana="<?= html_escape($inter['pelaksana']) ?>" 
                                data-inovasi="<?= html_escape($inter['inovasi_daerah']) ?>" 
                                data-outcome="<?= html_escape($inter['outcome_inovasi']) ?>" 
                                data-output="<?= html_escape($inter['output_inovasi']) ?>" 
                                data-crosscutting-pd="<?= html_escape($inter['crosscutting_pd']) ?>" 
                                data-crosscutting-keterangan="<?= html_escape($inter['crosscutting_keterangan']) ?>" 
                                title="Edit">
                                Edit
                              </button>
                              <button type="button" class="btn btn-xs btn-danger btn-hapus-level2" data-id="<?= $inter['id'] ?>" title="Hapus">
                                Hapus
                              </button>
                            </div>
                          </td>
                        <?php endif; ?>
                      </tr>

                      <!-- LEVEL 3: IMMEDIATE OUTCOME PD -->
                      <?php 
                      $no3 = 1;
                      foreach ($inter['immediate'] as $imm): 
                        $hasChild3 = !empty($imm['output']);
                      ?>
                        <tr class="row-l3 child-of-u-<?= $u['id'] ?> child-of-inter-<?= $inter['id'] ?>" id="row-imm-<?= $imm['id'] ?>" data-node-id="imm-<?= $imm['id'] ?>" data-parent="inter-<?= $inter['id'] ?>" data-level="3">
                          <td class="text-center text-muted"><small><?= $no1 . '.' . $no2 . '.' . $no3 ?></small></td>
                          <td class="tree-indent-3">
                            <div class="tree-node-content">
                              <?php if ($hasChild3): ?>
                                <button type="button" class="toggle-btn" onclick="toggleRow('imm-<?= $imm['id'] ?>')">
                                  <i class="fa fa-chevron-down"></i>
                                </button>
                              <?php else: ?>
                                <span style="width:20px; display:inline-block;"></span>
                              <?php endif; ?>
                              <div>
                                <span class="badge-lvl badge-lvl-3">IMMEDIATE OUTCOME PD</span>
                                <div style="margin-top: 4px; font-weight: 600; color: #0f766e;">
                                  <?= html_escape($imm['kinerja']) ?>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <?php 
                            if (!empty($imm['indikator'])) {
                              $inds = explode('|||', $imm['indikator']);
                              foreach ($inds as $ind) {
                                if (trim($ind)) echo '<span class="indicator-tag">' . html_escape($ind) . '</span>';
                              }
                            } else {
                              echo '<span class="text-muted">-</span>';
                            }
                            ?>
                          </td>
                          <td>
                            <div class="pelaksana-box">
                              <?php if (!empty($imm['pelaksana_detail'])): ?>
                                <div class="dinas-name"><?= html_escape($imm['pelaksana_detail']['dinas']) ?></div>
                                <div class="karyawan-name"><?= html_escape($imm['pelaksana_detail']['nama']) ?></div>
                              <?php else: ?>
                                <span class="text-muted">-</span>
                              <?php endif; ?>
                            </div>
                          </td>
                          <?php if ($IsRole4): ?>
                            <td class="text-center">
                              <div class="action-btn-group">
                                <button type="button" class="btn btn-xs btn-success btn-add-child-l4" 
                                  data-immediate="<?= $imm['id'] ?>" 
                                  data-parent-kinerja="<?= html_escape($imm['kinerja']) ?>" 
                                  title="Tambah Output">
                                  + Output
                                </button>
                                <button type="button" class="btn btn-xs btn-warning btn-edit-level3" 
                                  data-id="<?= $imm['id'] ?>" 
                                  data-intermediate="<?= $imm['intermediate_outcome_id'] ?>" 
                                  data-parent-kinerja="<?= html_escape($inter['kinerja']) ?>" 
                                  data-kinerja="<?= html_escape($imm['kinerja']) ?>" 
                                  data-indikator="<?= html_escape($imm['indikator']) ?>" 
                                  data-pelaksana="<?= html_escape($imm['pelaksana']) ?>" 
                                  data-inovasi="<?= html_escape($imm['inovasi_daerah']) ?>" 
                                  data-outcome="<?= html_escape($imm['outcome_inovasi']) ?>" 
                                  data-output="<?= html_escape($imm['output_inovasi']) ?>" 
                                  data-crosscutting-pd="<?= html_escape($imm['crosscutting_pd']) ?>" 
                                  data-crosscutting-keterangan="<?= html_escape($imm['crosscutting_keterangan']) ?>" 
                                  title="Edit">
                                  Edit
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-hapus-level3" data-id="<?= $imm['id'] ?>" title="Hapus">
                                  Hapus
                                </button>
                              </div>
                            </td>
                          <?php endif; ?>
                        </tr>

                        <!-- LEVEL 4: OUTPUT PD -->
                        <?php 
                        $no4 = 1;
                        foreach ($imm['output'] as $out): 
                        ?>
                          <tr class="row-l4 child-of-u-<?= $u['id'] ?> child-of-inter-<?= $inter['id'] ?> child-of-imm-<?= $imm['id'] ?>" id="row-out-<?= $out['id'] ?>" data-node-id="out-<?= $out['id'] ?>" data-parent="imm-<?= $imm['id'] ?>" data-level="4">
                            <td class="text-center text-muted"><small><?= $no1 . '.' . $no2 . '.' . $no3 . '.' . $no4 ?></small></td>
                            <td class="tree-indent-4">
                              <div class="tree-node-content">
                                <span style="width:20px; display:inline-block;"></span>
                                <div>
                                  <span class="badge-lvl badge-lvl-4">OUTPUT PD</span>
                                  <div style="margin-top: 4px; font-weight: 600; color: #7e22ce;">
                                    <?= html_escape($out['kinerja']) ?>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <?php 
                              if (!empty($out['indikator'])) {
                                $inds = explode('|||', $out['indikator']);
                                foreach ($inds as $ind) {
                                  if (trim($ind)) echo '<span class="indicator-tag">' . html_escape($ind) . '</span>';
                                }
                              } else {
                                echo '<span class="text-muted">-</span>';
                              }
                              ?>
                            </td>
                            <td>
                              <div class="pelaksana-box">
                                <?php if (!empty($out['pelaksana_detail'])): ?>
                                  <div class="dinas-name"><?= html_escape($out['pelaksana_detail']['dinas']) ?></div>
                                  <div class="karyawan-name"><?= html_escape($out['pelaksana_detail']['nama']) ?></div>
                                <?php else: ?>
                                  <span class="text-muted">-</span>
                                <?php endif; ?>
                              </div>
                            </td>
                            <?php if ($IsRole4): ?>
                              <td class="text-center">
                                <div class="action-btn-group">
                                  <button type="button" class="btn btn-xs btn-warning btn-edit-level4" 
                                    data-id="<?= $out['id'] ?>" 
                                    data-immediate="<?= $out['immediate_outcome_id'] ?>" 
                                    data-parent-kinerja="<?= html_escape($imm['kinerja']) ?>" 
                                    data-kinerja="<?= html_escape($out['kinerja']) ?>" 
                                    data-indikator="<?= html_escape($out['indikator']) ?>" 
                                    data-pelaksana="<?= html_escape($out['pelaksana']) ?>" 
                                    data-inovasi="<?= html_escape($out['inovasi_daerah']) ?>" 
                                    data-outcome="<?= html_escape($out['outcome_inovasi']) ?>" 
                                    data-output="<?= html_escape($out['output_inovasi']) ?>" 
                                    data-crosscutting-pd="<?= html_escape($out['crosscutting_pd']) ?>" 
                                    data-crosscutting-keterangan="<?= html_escape($out['crosscutting_keterangan']) ?>" 
                                    title="Edit">
                                    Edit
                                  </button>
                                  <button type="button" class="btn btn-xs btn-danger btn-hapus-level4" data-id="<?= $out['id'] ?>" title="Hapus">
                                    Hapus
                                  </button>
                                </div>
                              </td>
                            <?php endif; ?>
                          </tr>
                        <?php 
                          $no4++;
                        endforeach; 
                        ?>
                      <?php 
                        $no3++;
                      endforeach; 
                      ?>
                    <?php 
                      $no2++;
                    endforeach; 
                    ?>
                  <?php 
                    $no1++;
                  endforeach; 
                  ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 1 (ULTIMATE OUTCOME PD) -->
<!-- ========================================================================= -->
<?php if ($IsRole4): ?>
<div class="modal fade" id="modalLevel1" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title">Ultimate Outcome PD / Level 1</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level1">
        <input type="hidden" id="edit_mode_l1" value="0">

        <?php if (!empty($NamaInstansi)): ?>
          <div class="alert alert-info mb-3"><strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?></div>
        <?php endif; ?>

        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small"><em>Ultimate Outcome Level 1 - Kinerja Strategis</em></div>
            <textarea id="kinerja_l1" class="form-control" rows="4" placeholder="Masukkan kinerja strategis..."></textarea>
          </div>

          <div class="form-group">
            <label><b>Data Sumber (Indikator Kinerja)</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small"><em>Pilih data dari Intermediate Outcome Sektor yang akan menjadi indikator kinerja</em></div>
            <div id="sumber-container-l1"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-tambah-sumber-l1">
              Tambah Data Sumber
            </button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-level1">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 2 (INTERMEDIATE OUTCOME PD) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel2" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title">Intermediate Outcome PD / Level 2</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level2">
        <input type="hidden" id="edit_mode_l2" value="0">

        <?php if (!empty($NamaInstansi)): ?>
          <div class="alert alert-info mb-3"><strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?></div>
        <?php endif; ?>

        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Tautan ke Ultimate Outcome -->
          <div class="form-group">
            <label><b>Tautan ke Ultimate Outcome (Level 1)</b></label>
            <div class="mb-2 text-muted small">
              <em>Ultimate Outcome PD (Level 1) &rarr; Otomatis terisi</em>
            </div>
            <div id="parent_display_l2_pd" class="p-2 border rounded" style="background:#fff; font-weight:600; color:#1e40af; border-left:4px solid #3b82f6;">—</div>
            <input type="hidden" id="UltimateId_l2" name="ultimate_id">
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja Strategis Sektor</b> <span class="text-danger">*</span></label>
            <textarea id="kinerja_l2" class="form-control" rows="4" placeholder="Masukkan kinerja strategis sektor..."></textarea>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Indikator Kinerja</b></label>
                <div id="indikator-container-l2"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-ind-l2">Tambah Indikator</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Pilih Dinas / Instansi</b></label>
                <select id="DinasFilter_l2" class="form-control select2-dinas" style="width: 100%;">
                  <option value="">-- Pilih Dinas --</option>
                </select>
              </div>
              <div class="form-group" id="PelaksanaGroup_l2" style="display: none;">
                <label><b>Pelaksana / Urusan</b></label>
                <select id="Pelaksana_l2" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div id="inovasi-container-l2"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-ino-l2">Tambah Inovasi</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Outcome Inovasi</b></label>
                <div id="outcome-container-l2"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-out-l2">Tambah Outcome</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Output Inovasi</b></label>
                <div id="output-container-l2"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outp-l2">Tambah Output</button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label><b>Crosscutting Dengan Perangkat Daerah</b></label>
            <div class="table-responsive">
              <table class="table table-bordered table-sm">
                <thead><tr><th>Perangkat Daerah</th><th>Keterangan</th><th width="50"></th></tr></thead>
                <tbody id="crosscutting-body-l2"></tbody>
              </table>
            </div>
            <button type="button" class="btn btn-success btn-sm" id="btn-add-cross-l2">Tambah Crosscutting</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-level2">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 3 (IMMEDIATE OUTCOME PD) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel3" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title">Immediate Outcome PD / Level 3</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level3">
        <input type="hidden" id="edit_mode_l3" value="0">

        <?php if (!empty($NamaInstansi)): ?>
          <div class="alert alert-info mb-3"><strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?></div>
        <?php endif; ?>

        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Tautan ke Intermediate Outcome -->
          <div class="form-group">
            <label><b>Tautan ke Intermediate Outcome (Level 2)</b></label>
            <div class="mb-2 text-muted small">
              <em>Intermediate Outcome PD (Level 2) &rarr; Otomatis terisi</em>
            </div>
            <div id="parent_display_l3_pd" class="p-2 border rounded" style="background:#fff; font-weight:600; color:#0369a1; border-left:4px solid #0ea5e9;">—</div>
            <input type="hidden" id="IntermediateId_l3" name="intermediate_id">
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja Immediate</b> <span class="text-danger">*</span></label>
            <textarea id="kinerja_l3" class="form-control" rows="4" placeholder="Masukkan kinerja immediate..."></textarea>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Indikator Kinerja</b></label>
                <div id="indikator-container-l3"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-ind-l3">Tambah Indikator</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Pilih Dinas / Instansi</b></label>
                <select id="DinasFilter_l3" class="form-control select2-dinas" style="width: 100%;">
                  <option value="">-- Pilih Dinas --</option>
                </select>
              </div>
              <div class="form-group" id="PelaksanaGroup_l3" style="display: none;">
                <label><b>Pelaksana / Urusan</b></label>
                <select id="Pelaksana_l3" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div id="inovasi-container-l3"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-ino-l3">Tambah Inovasi</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Outcome Inovasi</b></label>
                <div id="outcome-container-l3"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-out-l3">Tambah Outcome</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Output Inovasi</b></label>
                <div id="output-container-l3"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outp-l3">Tambah Output</button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label><b>Crosscutting Dengan Perangkat Daerah</b></label>
            <div class="table-responsive">
              <table class="table table-bordered table-sm">
                <thead><tr><th>Perangkat Daerah</th><th>Keterangan</th><th width="50"></th></tr></thead>
                <tbody id="crosscutting-body-l3"></tbody>
              </table>
            </div>
            <button type="button" class="btn btn-success btn-sm" id="btn-add-cross-l3">Tambah Crosscutting</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-level3">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 4 (OUTPUT PD) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel4" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h3 class="modal-title">Output PD / Level 4</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level4">
        <input type="hidden" id="edit_mode_l4" value="0">

        <?php if (!empty($NamaInstansi)): ?>
          <div class="alert alert-info mb-3"><strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?></div>
        <?php endif; ?>

        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Tautan ke Immediate Outcome -->
          <div class="form-group">
            <label><b>Tautan ke Immediate Outcome (Level 3)</b></label>
            <div class="mb-2 text-muted small">
              <em>Immediate Outcome PD (Level 3) &rarr; Otomatis terisi</em>
            </div>
            <div id="parent_display_l4_pd" class="p-2 border rounded" style="background:#fff; font-weight:600; color:#0f766e; border-left:4px solid #14b8a6;">—</div>
            <input type="hidden" id="ImmediateId_l4" name="immediate_id">
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja Output</b> <span class="text-danger">*</span></label>
            <textarea id="kinerja_l4" class="form-control" rows="4" placeholder="Masukkan kinerja output..."></textarea>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Indikator Kinerja</b></label>
                <div id="indikator-container-l4"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-ind-l4">Tambah Indikator</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><b>Pilih Dinas / Instansi</b></label>
                <select id="DinasFilter_l4" class="form-control select2-dinas" style="width: 100%;">
                  <option value="">-- Pilih Dinas --</option>
                </select>
              </div>
              <div class="form-group" id="PelaksanaGroup_l4" style="display: none;">
                <label><b>Pelaksana / Urusan</b></label>
                <select id="Pelaksana_l4" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div id="inovasi-container-l4"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-ino-l4">Tambah Inovasi</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Outcome Inovasi</b></label>
                <div id="outcome-container-l4"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-out-l4">Tambah Outcome</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label><b>Output Inovasi</b></label>
                <div id="output-container-l4"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outp-l4">Tambah Output</button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label><b>Crosscutting Dengan Perangkat Daerah</b></label>
            <div class="table-responsive">
              <table class="table table-bordered table-sm">
                <thead><tr><th>Perangkat Daerah</th><th>Keterangan</th><th width="50"></th></tr></thead>
                <tbody id="crosscutting-body-l4"></tbody>
              </table>
            </div>
            <button type="button" class="btn btn-success btn-sm" id="btn-add-cross-l4">Tambah Crosscutting</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-level4">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ========================================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================================= -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var sektorData = <?= json_encode($intermediate_sektor) ?>;
var taktikalData = <?= json_encode($intermediate_taktikal) ?>;
var sumberCounter = 0;

$(document).ready(function() {

  // Setup AJAX CSRF
  $.ajaxSetup({
    beforeSend: function(xhr, settings) {
      if (settings.type.toUpperCase() === 'POST') {
        settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
      }
    }
  });

  // ================= FILTER WILAYAH & INSTANSI =================
  <?php if (!isset($_SESSION['KodeWilayah'])): ?>
    $("#Provinsi").change(function() {
      var prov = $(this).val();
      if (!prov) {
        $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', true);
        $("#FilterInstansiBeforeGroup").hide();
        return;
      }
      $.post(BaseURL + "Instansi/GetListKabKota", { Kode: prov }, function(Data) {
        var res = (typeof Data === 'string') ? JSON.parse(Data) : Data;
        var opt = '<option value="">Pilih Kab/Kota</option>';
        if (res && res.length > 0) {
          for (let i = 0; i < res.length; i++) opt += '<option value="' + res[i].Kode + '">' + res[i].Nama + '</option>';
        }
        $("#KabKota").html(opt).prop('disabled', false);
        <?php if (!empty($KodeWilayah)): ?>
          $("#KabKota").val("<?= $KodeWilayah ?>").trigger('change');
        <?php endif; ?>
      });
    });

    $("#KabKota").change(function() {
      var kab = $(this).val();
      if (!kab) { $("#FilterInstansiBeforeGroup").hide(); return; }
      $.post(BaseURL + "Instansi/GetListInstansiByKabKota", { KodeWilayah: kab }, function(res) {
        var data = (typeof res === 'string') ? JSON.parse(res) : res;
        var opt = '<option value="">-- Semua Instansi --</option>';
        if (data && data.length > 0) {
          for (let i = 0; i < data.length; i++) opt += '<option value="' + data[i].id + '">' + data[i].nama + '</option>';
          $("#FilterInstansiBeforeLogin").html(opt);
          $("#FilterInstansiBeforeGroup").show();
        } else {
          $("#FilterInstansiBeforeGroup").hide();
        }
      });
    });

    <?php if (!empty($KodeWilayah)): ?>
      $("#Provinsi").trigger('change');
    <?php endif; ?>

    $("#Filter").click(function() {
      var kab = $("#KabKota").val();
      var ins = $("#FilterInstansiBeforeLogin").val();
      if (!kab) { alert("Pilih Kabupaten/Kota terlebih dahulu!"); return; }
      $.post(BaseURL + "Instansi/SetTempKodeWilayah", { KodeWilayah: kab }, function(res) {
        if (res === '1') {
          var url = BaseURL + "Instansi/Ultimate_outcome_pd";
          if (ins) url += "?instansi_id=" + ins;
          window.location.href = url;
        } else alert(res || "Gagal filter");
      });
    });
  <?php endif; ?>

  // Filter Instansi non-role 4
  $("#FilterInstansiBtn").click(function() {
    var insId = $("#FilterInstansi").val();
    var url = BaseURL + "Instansi/Ultimate_outcome_pd";
    if (insId) url += "?instansi_id=" + insId;
    window.location.href = url;
  });

  $("#ResetFilterBtn").click(function() {
    window.location.href = BaseURL + "Instansi/Ultimate_outcome_pd";
  });

  // ================= HELPER FUNCTIONS =================
  function addFieldRow(container, val = '') {
    let row = $(`
      <div class="field-row">
        <input type="text" class="form-control" value="${val}">
        <button type="button" class="btn btn-danger btn-sm btn-del"><i class="fa fa-trash"></i></button>
      </div>
    `);
    row.find('.btn-del').click(function() { row.remove(); });
    $(container).append(row);
  }

  function addCrosscuttingRow(tbody, pd = '', ket = '') {
    let row = $(`
      <tr>
        <td><input type="text" class="form-control" value="${pd}"></td>
        <td><input type="text" class="form-control" value="${ket}"></td>
        <td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-del-cc"><i class="fa fa-trash"></i></button></td>
      </tr>
    `);
    row.find('.btn-del-cc').click(function() { row.remove(); });
    $(tbody).append(row);
  }

  function addSumberRow(kategori = '', sumberId = '') {
    sumberCounter++;
    let rowId = 'sumber_row_' + sumberCounter;
    
    let kategoriOptions = `
      <option value="">-- Pilih Kategori --</option>
      <option value="sektor" ${kategori === 'sektor' ? 'selected' : ''}>Intermediate Outcome Sektor</option>
    `;
    
    let sumberOptions = '<option value="">-- Pilih Kategori Terlebih Dahulu --</option>';
    if (kategori) {
      sumberOptions = getSumberOptions(kategori, sumberId);
    }
    
    let html = `
      <div class="sumber-row" id="${rowId}" style="margin-bottom: 15px; padding: 12px; background: #fff; border-radius: 5px; border: 1px solid #ddd;">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: end;">
          <div>
            <label style="margin-bottom: 5px; font-weight: bold; display: block;">Kategori Data Sumber <span style="color: red;">*</span></label>
            <select class="form-control kategori-select" data-rowid="${rowId}" required style="width: 100%;">
              ${kategoriOptions}
            </select>
          </div>
          <div>
            <label style="margin-bottom: 5px; font-weight: bold; display: block;">Data Sumber (Indikator) <span style="color: red;">*</span></label>
            <select class="form-control sumber-select" id="sumber_${rowId}" data-rowid="${rowId}" required ${!kategori ? 'disabled' : ''} style="width: 100%;">
              ${sumberOptions}
            </select>
          </div>
          <div>
            <button type="button" class="btn btn-danger btn-sm btn-remove-sumber" data-rowid="${rowId}" style="width: 100%; white-space: nowrap;">
              <i class="fa fa-trash"></i> Hapus
            </button>
          </div>
        </div>
      </div>
    `;
    
    $('#sumber-container-l1').append(html);
    
    // Bind event change
    $('.kategori-select[data-rowid="' + rowId + '"]').on('change', function() {
      let selectedKategori = $(this).val();
      let $sumberSelect = $(`#sumber_${rowId}`);
      if (!selectedKategori) {
        $sumberSelect.prop('disabled', true);
        $sumberSelect.html('<option value="">-- Pilih Kategori Terlebih Dahulu --</option>');
        return;
      }
      $sumberSelect.prop('disabled', false);
      $sumberSelect.html(getSumberOptions(selectedKategori));
    });
  }

  function getSumberOptions(kategori, selectedId = null) {
    let options = '<option value="">-- Pilih Data Sumber --</option>';
    if (kategori === 'sektor') {
      if (sektorData && sektorData.length > 0) {
        $.each(sektorData, function(index, item) {
          let selected = (selectedId == item.id) ? 'selected' : '';
          let text = item.kinerja.length > 100 ? item.kinerja.substring(0, 100) + '...' : item.kinerja;
          options += `<option value="${item.id}" ${selected}>${escapeHtml(text)}</option>`;
        });
      } else {
        options += '<option value="" disabled>-- Tidak ada data sektor --</option>';
      }
    }
    return options;
  }

  function escapeHtml(text) {
    var map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' };
    return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
  }

  $(document).on('click', '.btn-remove-sumber', function() {
    let rowId = $(this).data('rowid');
    $(`#${rowId}`).remove();
  });

  // ================= LOAD DINAS & PELAKSANA FOR MODALS =================
  function loadDinasPD(lvl, selectedDinas = '') {
    let url = BaseURL + 'Instansi/Intermediate_outcome_pd_get_daftar_dinas';
    if (lvl === 3) url = BaseURL + 'Instansi/Immediate_outcome_pd_get_daftar_dinas';
    if (lvl === 4) url = BaseURL + 'Instansi/Output_pd_get_daftar_dinas';

    let $sel = $('#DinasFilter_l' + lvl);
    $.getJSON(url, function(data) {
      let opt = '<option value="">-- Pilih Dinas --</option>';
      if (data && data.length) {
        data.forEach(d => {
          let s = (d.id == selectedDinas) ? 'selected' : '';
          opt += `<option value="${d.id}" ${s}>${d.nama}</option>`;
        });
      }
      $sel.html(opt);
      if ($sel.hasClass('select2-hidden-accessible')) $sel.select2('destroy');
      $sel.select2({ dropdownParent: $('#modalLevel' + lvl), width: '100%' });

      if (selectedDinas) $('#PelaksanaGroup_l' + lvl).show();
    });
  }

  function loadPelaksanaPD(lvl, dinasId, selectedPel = '') {
    let $group = $('#PelaksanaGroup_l' + lvl);
    let $sel = $('#Pelaksana_l' + lvl);
    if (!dinasId) {
      $group.hide();
      $sel.html('<option value="">-- Pilih Pelaksana --</option>');
      return;
    }
    $group.show();
    $sel.html('<option value="">Loading...</option>');

    let url = BaseURL + 'Instansi/Intermediate_outcome_pd_get_pelaksana_by_dinas';
    if (lvl === 3) url = BaseURL + 'Instansi/Immediate_outcome_pd_get_pelaksana_by_dinas';
    if (lvl === 4) url = BaseURL + 'Instansi/Output_pd_get_pelaksana_by_dinas';

    $.post(url, { dinas_id: dinasId }, function(data) {
      let res = (typeof data === 'string') ? JSON.parse(data) : data;
      let opt = '<option value="">-- Pilih Pelaksana --</option>';
      if (res && res.length) {
        res.forEach(p => {
          let s = (p.id == selectedPel) ? 'selected' : '';
          let lbl = p.nama + (p.jabatan ? ' - ' + p.jabatan : '');
          opt += `<option value="${p.id}" ${s}>${lbl}</option>`;
        });
      }
      $sel.html(opt);
      if ($sel.hasClass('select2-hidden-accessible')) $sel.select2('destroy');
      $sel.select2({ dropdownParent: $('#modalLevel' + lvl), width: '100%' });
    });
  }

  $('#DinasFilter_l2').change(function() { loadPelaksanaPD(2, $(this).val()); });
  $('#DinasFilter_l3').change(function() { loadPelaksanaPD(3, $(this).val()); });
  $('#DinasFilter_l4').change(function() { loadPelaksanaPD(4, $(this).val()); });

  // Add field button events
  $('#btn-tambah-sumber-l1').click(function() { addSumberRow(); });
  $('#btn-add-ind-l2').click(function() { addFieldRow('#indikator-container-l2'); });
  $('#btn-add-ino-l2').click(function() { addFieldRow('#inovasi-container-l2'); });
  $('#btn-add-out-l2').click(function() { addFieldRow('#outcome-container-l2'); });
  $('#btn-add-outp-l2').click(function() { addFieldRow('#output-container-l2'); });
  $('#btn-add-cross-l2').click(function() { addCrosscuttingRow('#crosscutting-body-l2'); });

  $('#btn-add-ind-l3').click(function() { addFieldRow('#indikator-container-l3'); });
  $('#btn-add-ino-l3').click(function() { addFieldRow('#inovasi-container-l3'); });
  $('#btn-add-out-l3').click(function() { addFieldRow('#outcome-container-l3'); });
  $('#btn-add-outp-l3').click(function() { addFieldRow('#output-container-l3'); });
  $('#btn-add-cross-l3').click(function() { addCrosscuttingRow('#crosscutting-body-l3'); });

  $('#btn-add-ind-l4').click(function() { addFieldRow('#indikator-container-l4'); });
  $('#btn-add-ino-l4').click(function() { addFieldRow('#inovasi-container-l4'); });
  $('#btn-add-out-l4').click(function() { addFieldRow('#outcome-container-l4'); });
  $('#btn-add-outp-l4').click(function() { addFieldRow('#output-container-l4'); });
  $('#btn-add-cross-l4').click(function() { addCrosscuttingRow('#crosscutting-body-l4'); });

  // ================= MODAL LEVEL 1 EVENTS =================
  $(document).on('click', '#btn-tambah-l1, #btn-tambah-l1-empty', function() {
    $('#id_level1').val('');
    $('#edit_mode_l1').val('0');
    $('#kinerja_l1').val('');
    $('#sumber-container-l1').empty();
    addSumberRow();
    $('#modalLevel1').modal('show');
  });

  $(document).on('click', '.btn-edit-level1', function() {
    let id = $(this).attr('data-id');
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';

    $('#id_level1').val(id);
    $('#edit_mode_l1').val('1');
    $('#kinerja_l1').val(kinerja);
    $('#sumber-container-l1').empty();

    if (indikator && indikator.trim() !== '' && indikator !== 'null') {
      let indikatorArray = indikator.split('|||');
      if (indikatorArray.length % 2 === 0 && (indikatorArray[0] === 'sektor' || indikatorArray[0] === 'taktikal')) {
        for (let i = 0; i < indikatorArray.length; i += 2) {
          if (i + 1 < indikatorArray.length) {
            let kategori = indikatorArray[i];
            let sumberId = indikatorArray[i + 1];
            addSumberRow(kategori, sumberId);
          }
        }
      }
    }
    if ($('#sumber-container-l1 .sumber-row').length === 0) {
      addSumberRow();
    }
    $('#modalLevel1').modal('show');
  });

  $('#btn-simpan-level1').click(function() {
    let id = $('#id_level1').val();
    let kinerja = $('#kinerja_l1').val().trim();
    if (!kinerja) { alert('Kinerja wajib diisi!'); $('#kinerja_l1').focus(); return; }

    let indikatorList = [];
    let isValid = true;
    
    $('#sumber-container-l1 .sumber-row').each(function() {
      let $row = $(this);
      let kategori = $row.find('.kategori-select').val();
      let sumberId = $row.find('.sumber-select').val();
      
      if (!kategori) {
        alert('Kategori data sumber wajib dipilih!');
        isValid = false;
        return false;
      }
      if (!sumberId) {
        alert('Data sumber wajib dipilih!');
        isValid = false;
        return false;
      }
      indikatorList.push(kategori);
      indikatorList.push(sumberId);
    });
    
    if (!isValid) return;
    if (indikatorList.length === 0) {
      alert('Minimal satu data sumber harus ditambahkan!');
      return;
    }

    let indikator = indikatorList.join('|||');

    $(this).prop('disabled', true).text('Menyimpan...');
    $.ajax({
      url: BaseURL + 'Instansi/Ultimate_outcome_pd_simpan',
      type: 'POST',
      data: { id: id, kinerja: kinerja, indikator: indikator },
      dataType: 'json',
      success: function(res) {
        if (res.status === 'success') {
          location.reload();
        } else {
          alert(res.message || 'Gagal menyimpan');
          $('#btn-simpan-level1').prop('disabled', false).text('Simpan Perubahan');
        }
      },
      error: function(jqXHR) {
        alert('Koneksi bermasalah: ' + jqXHR.status);
        $('#btn-simpan-level1').prop('disabled', false).text('Simpan Perubahan');
      }
    });
  });

  $(document).on('click', '.btn-hapus-level1', function() {
    if (!confirm('Yakin menghapus Ultimate Outcome PD ini beserta seluruh turunannya?')) return;
    $.post(BaseURL + 'Instansi/Ultimate_outcome_pd_hapus', { id: $(this).data('id') }, function(res) {
      let r = (typeof res === 'string') ? JSON.parse(res) : res;
      if (r.status === 'success') location.reload();
      else alert(r.message || 'Gagal menghapus');
    });
  });

  // ================= MODAL LEVEL 2 EVENTS =================
  $(document).on('click', '.btn-add-child-l2', function() {
    let ultimateId = $(this).attr('data-ultimate') || '';
    let parentKinerja = $(this).attr('data-parent-kinerja') || '';
    $('#id_level2').val('');
    $('#edit_mode_l2').val('0');
    $('#UltimateId_l2').val(ultimateId);
    $('#parent_display_l2_pd').text(parentKinerja || 'Ultimate Outcome PD (Level 1)');
    $('#kinerja_l2').val('');
    $('#indikator-container-l2').empty();
    addFieldRow('#indikator-container-l2');
    $('#inovasi-container-l2').empty();
    $('#outcome-container-l2').empty();
    $('#output-container-l2').empty();
    $('#crosscutting-body-l2').empty();
    loadDinasPD(2, '');
    loadPelaksanaPD(2, '', '');
    $('#modalLevel2').modal('show');
  });

  $(document).on('click', '.btn-edit-level2', function() {
    let id = $(this).attr('data-id');
    let ultimate = $(this).attr('data-ultimate') || '';
    let parentKinerja = $(this).attr('data-parent-kinerja') || '';
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';
    let inovasi = $(this).attr('data-inovasi') || '';
    let outcome = $(this).attr('data-outcome') || '';
    let output = $(this).attr('data-output') || '';
    let crossPD = $(this).attr('data-crosscutting-pd') || '';
    let crossKet = $(this).attr('data-crosscutting-keterangan') || '';

    $('#id_level2').val(id);
    $('#edit_mode_l2').val('1');
    $('#UltimateId_l2').val(ultimate);
    $('#parent_display_l2_pd').text(parentKinerja || 'Ultimate Outcome PD (Level 1)');
    $('#kinerja_l2').val(kinerja);
    $('#indikator-container-l2').empty();
    $('#inovasi-container-l2').empty();
    $('#outcome-container-l2').empty();
    $('#output-container-l2').empty();
    $('#crosscutting-body-l2').empty();

    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-l2', v.trim()); });
    }
    if (!$('#indikator-container-l2 .field-row').length) addFieldRow('#indikator-container-l2');

    if (inovasi) inovasi.split('|||').forEach(v => { if (v.trim()) addFieldRow('#inovasi-container-l2', v.trim()); });
    if (outcome) outcome.split('|||').forEach(v => { if (v.trim()) addFieldRow('#outcome-container-l2', v.trim()); });
    if (output) output.split('|||').forEach(v => { if (v.trim()) addFieldRow('#output-container-l2', v.trim()); });

    if (crossPD) {
      let pds = crossPD.split('|||');
      let kets = crossKet.split('|||');
      pds.forEach((pd, idx) => addCrosscuttingRow('#crosscutting-body-l2', pd, kets[idx] || ''));
    }

    if (pelaksanaId) {
      $.post(BaseURL + 'Instansi/Intermediate_outcome_pd_get_pelaksana_detail', { id: pelaksanaId }, function(d) {
        let res = (typeof d === 'string') ? JSON.parse(d) : d;
        let dId = (res && res.dinas_id) ? res.dinas_id.split(',')[0] : '';
        loadDinasPD(2, dId);
        setTimeout(() => { loadPelaksanaPD(2, dId, pelaksanaId); }, 400);
      }, 'json').fail(() => { loadDinasPD(2, ''); loadPelaksanaPD(2, '', pelaksanaId); });
    } else {
      loadDinasPD(2, '');
      loadPelaksanaPD(2, '', '');
    }

    $('#modalLevel2').modal('show');
  });

  $('#btn-simpan-level2').click(function() {
    let id = $('#id_level2').val();
    let ultimate = $('#UltimateId_l2').val();
    let kinerja = $('#kinerja_l2').val().trim();
    let pelaksana = $('#Pelaksana_l2').val();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }

    let indikator = [];
    $('#indikator-container-l2 input').each(function() { let v = $(this).val().trim(); if (v) indikator.push(v); });
    let inovasi = [];
    $('#inovasi-container-l2 input').each(function() { let v = $(this).val().trim(); if (v) inovasi.push(v); });
    let outcome = [];
    $('#outcome-container-l2 input').each(function() { let v = $(this).val().trim(); if (v) outcome.push(v); });
    let output = [];
    $('#output-container-l2 input').each(function() { let v = $(this).val().trim(); if (v) output.push(v); });
    let crossPD = [], crossKet = [];
    $('#crosscutting-body-l2 tr').each(function() {
      let pd = $(this).find('td:eq(0) input').val().trim();
      let ket = $(this).find('td:eq(1) input').val().trim();
      if (pd || ket) { crossPD.push(pd); crossKet.push(ket); }
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Instansi/Intermediate_outcome_pd_simpan', {
      id: id, ultimate_id: ultimate, kinerja: kinerja,
      indikator: indikator, pelaksana: pelaksana || null,
      inovasi_daerah: inovasi.join('|||'), outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'), crosscutting_pd: crossPD.join('|||'), crosscutting_keterangan: crossKet.join('|||')
    }, function(res) {
      let r = (typeof res === 'string') ? JSON.parse(res) : res;
      if (r.status === 'success') location.reload();
      else { alert(r.message || 'Gagal'); $('#btn-simpan-level2').prop('disabled', false).text('Simpan Perubahan'); }
    });
  });

  $(document).on('click', '.btn-hapus-level2', function() {
    if (!confirm('Yakin menghapus Intermediate Outcome PD ini beserta seluruh turunannya?')) return;
    $.post(BaseURL + 'Instansi/Intermediate_outcome_pd_hapus', { id: $(this).data('id') }, function(res) {
      let r = (typeof res === 'string') ? JSON.parse(res) : res;
      if (r.status === 'success') location.reload();
      else alert(r.message || 'Gagal menghapus');
    });
  });

  // ================= MODAL LEVEL 3 EVENTS =================
  $(document).on('click', '.btn-add-child-l3', function() {
    let intermediateId = $(this).attr('data-intermediate') || '';
    let parentKinerja = $(this).attr('data-parent-kinerja') || '';
    $('#id_level3').val('');
    $('#edit_mode_l3').val('0');
    $('#IntermediateId_l3').val(intermediateId);
    $('#parent_display_l3_pd').text(parentKinerja || 'Intermediate Outcome PD (Level 2)');
    $('#kinerja_l3').val('');
    $('#indikator-container-l3').empty();
    addFieldRow('#indikator-container-l3');
    $('#inovasi-container-l3').empty();
    $('#outcome-container-l3').empty();
    $('#output-container-l3').empty();
    $('#crosscutting-body-l3').empty();
    loadDinasPD(3, '');
    loadPelaksanaPD(3, '', '');
    $('#modalLevel3').modal('show');
  });

  $(document).on('click', '.btn-edit-level3', function() {
    let id = $(this).attr('data-id');
    let intermediate = $(this).attr('data-intermediate') || '';
    let parentKinerja = $(this).attr('data-parent-kinerja') || '';
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';
    let inovasi = $(this).attr('data-inovasi') || '';
    let outcome = $(this).attr('data-outcome') || '';
    let output = $(this).attr('data-output') || '';
    let crossPD = $(this).attr('data-crosscutting-pd') || '';
    let crossKet = $(this).attr('data-crosscutting-keterangan') || '';

    $('#id_level3').val(id);
    $('#edit_mode_l3').val('1');
    $('#IntermediateId_l3').val(intermediate);
    $('#parent_display_l3_pd').text(parentKinerja || 'Intermediate Outcome PD (Level 2)');
    $('#kinerja_l3').val(kinerja);
    $('#indikator-container-l3').empty();
    $('#inovasi-container-l3').empty();
    $('#outcome-container-l3').empty();
    $('#output-container-l3').empty();
    $('#crosscutting-body-l3').empty();

    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-l3', v.trim()); });
    }
    if (!$('#indikator-container-l3 .field-row').length) addFieldRow('#indikator-container-l3');

    if (inovasi) inovasi.split('|||').forEach(v => { if (v.trim()) addFieldRow('#inovasi-container-l3', v.trim()); });
    if (outcome) outcome.split('|||').forEach(v => { if (v.trim()) addFieldRow('#outcome-container-l3', v.trim()); });
    if (output) output.split('|||').forEach(v => { if (v.trim()) addFieldRow('#output-container-l3', v.trim()); });

    if (crossPD) {
      let pds = crossPD.split('|||');
      let kets = crossKet.split('|||');
      pds.forEach((pd, idx) => addCrosscuttingRow('#crosscutting-body-l3', pd, kets[idx] || ''));
    }

    if (pelaksanaId) {
      $.post(BaseURL + 'Instansi/Immediate_outcome_pd_get_pelaksana_detail', { id: pelaksanaId }, function(d) {
        let res = (typeof d === 'string') ? JSON.parse(d) : d;
        let dId = (res && res.dinas_id) ? res.dinas_id.split(',')[0] : '';
        loadDinasPD(3, dId);
        setTimeout(() => { loadPelaksanaPD(3, dId, pelaksanaId); }, 400);
      }, 'json').fail(() => { loadDinasPD(3, ''); loadPelaksanaPD(3, '', pelaksanaId); });
    } else {
      loadDinasPD(3, '');
      loadPelaksanaPD(3, '', '');
    }

    $('#modalLevel3').modal('show');
  });

  $('#btn-simpan-level3').click(function() {
    let id = $('#id_level3').val();
    let intermediate = $('#IntermediateId_l3').val();
    let kinerja = $('#kinerja_l3').val().trim();
    let pelaksana = $('#Pelaksana_l3').val();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }

    let indikator = [];
    $('#indikator-container-l3 input').each(function() { let v = $(this).val().trim(); if (v) indikator.push(v); });
    let inovasi = [];
    $('#inovasi-container-l3 input').each(function() { let v = $(this).val().trim(); if (v) inovasi.push(v); });
    let outcome = [];
    $('#outcome-container-l3 input').each(function() { let v = $(this).val().trim(); if (v) outcome.push(v); });
    let output = [];
    $('#output-container-l3 input').each(function() { let v = $(this).val().trim(); if (v) output.push(v); });
    let crossPD = [], crossKet = [];
    $('#crosscutting-body-l3 tr').each(function() {
      let pd = $(this).find('td:eq(0) input').val().trim();
      let ket = $(this).find('td:eq(1) input').val().trim();
      if (pd || ket) { crossPD.push(pd); crossKet.push(ket); }
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Instansi/Immediate_outcome_pd_simpan', {
      id: id, intermediate_id: intermediate, kinerja: kinerja,
      indikator: indikator, pelaksana: pelaksana || null,
      inovasi_daerah: inovasi.join('|||'), outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'), crosscutting_pd: crossPD.join('|||'), crosscutting_keterangan: crossKet.join('|||')
    }, function(res) {
      let r = (typeof res === 'string') ? JSON.parse(res) : res;
      if (r.status === 'success') location.reload();
      else { alert(r.message || 'Gagal'); $('#btn-simpan-level3').prop('disabled', false).text('Simpan Perubahan'); }
    });
  });

  $(document).on('click', '.btn-hapus-level3', function() {
    if (!confirm('Yakin menghapus Immediate Outcome PD ini beserta seluruh turunannya?')) return;
    $.post(BaseURL + 'Instansi/Immediate_outcome_pd_hapus', { id: $(this).data('id') }, function(res) {
      let r = (typeof res === 'string') ? JSON.parse(res) : res;
      if (r.status === 'success') location.reload();
      else alert(r.message || 'Gagal menghapus');
    });
  });

  // ================= MODAL LEVEL 4 EVENTS =================
  $(document).on('click', '.btn-add-child-l4', function() {
    let immediateId = $(this).attr('data-immediate') || '';
    let parentKinerja = $(this).attr('data-parent-kinerja') || '';
    $('#id_level4').val('');
    $('#edit_mode_l4').val('0');
    $('#ImmediateId_l4').val(immediateId);
    $('#parent_display_l4_pd').text(parentKinerja || 'Immediate Outcome PD (Level 3)');
    $('#kinerja_l4').val('');
    $('#indikator-container-l4').empty();
    addFieldRow('#indikator-container-l4');
    $('#inovasi-container-l4').empty();
    $('#outcome-container-l4').empty();
    $('#output-container-l4').empty();
    $('#crosscutting-body-l4').empty();
    loadDinasPD(4, '');
    loadPelaksanaPD(4, '', '');
    $('#modalLevel4').modal('show');
  });

  $(document).on('click', '.btn-edit-level4', function() {
    let id = $(this).attr('data-id');
    let immediate = $(this).attr('data-immediate') || '';
    let parentKinerja = $(this).attr('data-parent-kinerja') || '';
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';
    let inovasi = $(this).attr('data-inovasi') || '';
    let outcome = $(this).attr('data-outcome') || '';
    let output = $(this).attr('data-output') || '';
    let crossPD = $(this).attr('data-crosscutting-pd') || '';
    let crossKet = $(this).attr('data-crosscutting-keterangan') || '';

    $('#id_level4').val(id);
    $('#edit_mode_l4').val('1');
    $('#ImmediateId_l4').val(immediate);
    $('#parent_display_l4_pd').text(parentKinerja || 'Immediate Outcome PD (Level 3)');
    $('#kinerja_l4').val(kinerja);
    $('#indikator-container-l4').empty();
    $('#inovasi-container-l4').empty();
    $('#outcome-container-l4').empty();
    $('#output-container-l4').empty();
    $('#crosscutting-body-l4').empty();

    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-l4', v.trim()); });
    }
    if (!$('#indikator-container-l4 .field-row').length) addFieldRow('#indikator-container-l4');

    if (inovasi) inovasi.split('|||').forEach(v => { if (v.trim()) addFieldRow('#inovasi-container-l4', v.trim()); });
    if (outcome) outcome.split('|||').forEach(v => { if (v.trim()) addFieldRow('#outcome-container-l4', v.trim()); });
    if (output) output.split('|||').forEach(v => { if (v.trim()) addFieldRow('#output-container-l4', v.trim()); });

    if (crossPD) {
      let pds = crossPD.split('|||');
      let kets = crossKet.split('|||');
      pds.forEach((pd, idx) => addCrosscuttingRow('#crosscutting-body-l4', pd, kets[idx] || ''));
    }

    if (pelaksanaId) {
      $.post(BaseURL + 'Instansi/Output_pd_get_pelaksana_detail', { id: pelaksanaId }, function(d) {
        let res = (typeof d === 'string') ? JSON.parse(d) : d;
        let dId = (res && res.dinas_id) ? res.dinas_id.split(',')[0] : '';
        loadDinasPD(4, dId);
        setTimeout(() => { loadPelaksanaPD(4, dId, pelaksanaId); }, 400);
      }, 'json').fail(() => { loadDinasPD(4, ''); loadPelaksanaPD(4, '', pelaksanaId); });
    } else {
      loadDinasPD(4, '');
      loadPelaksanaPD(4, '', '');
    }

    $('#modalLevel4').modal('show');
  });

  $('#btn-simpan-level4').click(function() {
    let id = $('#id_level4').val();
    let immediate = $('#ImmediateId_l4').val();
    let kinerja = $('#kinerja_l4').val().trim();
    let pelaksana = $('#Pelaksana_l4').val();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }

    let indikator = [];
    $('#indikator-container-l4 input').each(function() { let v = $(this).val().trim(); if (v) indikator.push(v); });
    let inovasi = [];
    $('#inovasi-container-l4 input').each(function() { let v = $(this).val().trim(); if (v) inovasi.push(v); });
    let outcome = [];
    $('#outcome-container-l4 input').each(function() { let v = $(this).val().trim(); if (v) outcome.push(v); });
    let output = [];
    $('#output-container-l4 input').each(function() { let v = $(this).val().trim(); if (v) output.push(v); });
    let crossPD = [], crossKet = [];
    $('#crosscutting-body-l4 tr').each(function() {
      let pd = $(this).find('td:eq(0) input').val().trim();
      let ket = $(this).find('td:eq(1) input').val().trim();
      if (pd || ket) { crossPD.push(pd); crossKet.push(ket); }
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Instansi/Output_pd_simpan', {
      id: id, immediate_id: immediate, kinerja: kinerja,
      indikator: indikator, pelaksana: pelaksana || null,
      inovasi_daerah: inovasi.join('|||'), outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'), crosscutting_pd: crossPD.join('|||'), crosscutting_keterangan: crossKet.join('|||')
    }, function(res) {
      let r = (typeof res === 'string') ? JSON.parse(res) : res;
      if (r.status === 'success') location.reload();
      else { alert(r.message || 'Gagal'); $('#btn-simpan-level4').prop('disabled', false).text('Simpan Perubahan'); }
    });
  });

  $(document).on('click', '.btn-hapus-level4', function() {
    if (!confirm('Yakin menghapus Output PD ini?')) return;
    $.post(BaseURL + 'Instansi/Output_pd_hapus', { id: $(this).data('id') }, function(res) {
      let r = (typeof res === 'string') ? JSON.parse(res) : res;
      if (r.status === 'success') location.reload();
      else alert(r.message || 'Gagal menghapus');
    });
  });

});

// ================= TOGGLE / EXPAND / COLLAPSE =================
function toggleRow(nodeId) {
  let $btn = $('#row-' + nodeId).find('.toggle-btn');
  let isExpanded = !$btn.hasClass('collapsed');
  
  if (isExpanded) {
    $btn.addClass('collapsed');
    $('.child-of-' + nodeId).hide();
  } else {
    $btn.removeClass('collapsed');
    $('tr[data-parent="' + nodeId + '"]').show();
    $('tr[data-parent="' + nodeId + '"]').each(function() {
      let childId = $(this).data('node-id');
      let childBtn = $(this).find('.toggle-btn');
      if (childBtn.length && !childBtn.hasClass('collapsed')) {
        $('tr[data-parent="' + childId + '"]').show();
      }
    });
  }
}

function expandAll() {
  $('.tree-table tbody tr').show();
  $('.toggle-btn').removeClass('collapsed');
}

function collapseAll() {
  $('.row-l2, .row-l3, .row-l4').hide();
  $('.toggle-btn').addClass('collapsed');
}
</script>