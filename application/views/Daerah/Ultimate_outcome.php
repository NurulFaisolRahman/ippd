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

  --l4-color: #c2410c;
  --l4-bg: #fff7ed;
  --l4-border: #f97316;

  --l5-color: #7e22ce;
  --l5-bg: #faf5ff;
  --l5-border: #a855f7;
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

.row-l5 { background-color: var(--l5-bg) !important; }
.row-l5 td:nth-child(2) { border-left: 5px solid var(--l5-border) !important; }

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
.badge-lvl-5 { background: var(--l5-color); }

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
.tree-indent-5 { padding-left: 100px !important; }

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
.indicator-tag i { color: #3b82f6; margin-right: 4px; }

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

/* Field dynamic rows */
.field-row {
  display: flex;
  gap: 8px;
  margin-bottom: 8px;
}
.field-row input {
  flex: 1;
}

.modal-header {
  border-bottom: 1px solid #e2e8f0;
  padding: 16px 24px;
}
.modal-header h4 {
  font-size: 18px;
  font-weight: 700;
  margin: 0;
}
.modal-body {
  padding: 20px 24px;
  max-height: calc(85vh - 120px);
  overflow-y: auto;
}
.modal-footer {
  border-top: 1px solid #e2e8f0;
  padding: 14px 24px;
}

.select2-container {
  width: 100% !important;
}
</style>

<div class="main-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">

          <!-- ================= FILTER WILAYAH ================= -->
          <?php if (!isset($_SESSION['KodeWilayah'])): ?>
            <div class="well well-sm" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; margin-bottom:20px; padding:16px;">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <label><i class="fa fa-map"></i> <b>Provinsi</b></label>
                  <select class="form-control" id="Provinsi">
                    <option value="">Pilih Provinsi</option>
                    <?php foreach ($Provinsi as $prov): ?>
                      <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                        <?= html_escape($prov['Nama']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-4 col-md-4">
                  <label><i class="fa fa-city"></i> <b>Kabupaten/Kota</b></label>
                  <select class="form-control" id="KabKota" <?= empty($KodeWilayah) ? 'disabled' : '' ?>>
                    <option value="">Pilih Kab/Kota</option>
                  </select>
                </div>
                <div class="col-lg-2 col-md-2" style="margin-top: 25px;">
                  <button class="btn btn-primary btn-block" id="Filter">
                    <i class="fa fa-search"></i> Filter
                  </button>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <!-- ================= KONTROL & STATS BAR ================= -->
          <div class="pk-control-bar">
            <div class="pk-title-area">
              <h3>
                <i class="fa fa-sitemap text-primary"></i> 
                Pohon Kinerja Daerah
                <?= !empty($NamaWilayah) ? '<span class="badge badge-info" style="font-size:13px; font-weight:normal;">' . html_escape($NamaWilayah) . '</span>' : '' ?>
              </h3>
              <p>Kelola data pohon kinerja 5 level secara berhierarki (Ultimate Outcome &rarr; Sektor &rarr; Taktikal &rarr; Immediate Outcome &rarr; Output)</p>
            </div>
            
            <div class="pk-actions">
              <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3): ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLevel1" style="font-weight:600;">
                  <i class="fa fa-plus-circle"></i> Tambah Ultimate Outcome (Level 1)
                </button>
              <?php endif; ?>
              
              <button type="button" class="btn btn-default" onclick="expandAll()" title="Buka Semua Level">
                <i class="fa fa-expand-alt"></i> Expand All
              </button>
              <button type="button" class="btn btn-default" onclick="collapseAll()" title="Tutup Semua Level">
                <i class="fa fa-compress-alt"></i> Collapse All
              </button>
              <a href="<?= base_url('Daerah/TampilPohonKinerja') ?>" class="btn btn-info" target="_blank" title="Buka Bagan Pohon">
                <i class="fa fa-diagram-project"></i> Lihat Bagan Pohon
              </a>
            </div>
          </div>

          <!-- ================= STATS CHIPS ================= -->
          <div class="pk-stats-bar">
            <div class="stat-badge">
              <span class="dot" style="background:var(--l1-color)"></span>
              Ultimate Outcome: <span class="count"><?= $TotalData['level1'] ?? 0 ?></span>
            </div>
            <div class="stat-badge">
              <span class="dot" style="background:var(--l2-color)"></span>
              Intermediate Sektor: <span class="count"><?= $TotalData['level2'] ?? 0 ?></span>
            </div>
            <div class="stat-badge">
              <span class="dot" style="background:var(--l3-color)"></span>
              Intermediate Taktikal: <span class="count"><?= $TotalData['level3'] ?? 0 ?></span>
            </div>
            <div class="stat-badge">
              <span class="dot" style="background:var(--l4-color)"></span>
              Immediate Outcome: <span class="count"><?= $TotalData['level4'] ?? 0 ?></span>
            </div>
            <div class="stat-badge">
              <span class="dot" style="background:var(--l5-color)"></span>
              Output: <span class="count"><?= $TotalData['level5'] ?? 0 ?></span>
            </div>
          </div>

          <?php $isRole3 = (isset($_SESSION['Level']) && $_SESSION['Level'] == 3); ?>
          <!-- ================= TABEL HIERARKI ================= -->
          <div class="table-responsive">
            <table class="table tree-table" id="table-hierarki-pk">
              <thead>
                <tr>
                  <th width="4%" class="text-center">No</th>
                  <th width="42%">Uraian Kinerja</th>
                  <th width="20%">Indikator Kinerja</th>
                  <th width="16%">Perangkat Daerah / Pelaksana</th>
                  <?php if ($isRole3): ?>
                    <th width="18%" class="text-center">Aksi</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($hierarchy)): ?>
                  <tr>
                    <td colspan="<?= $isRole3 ? '5' : '4' ?>" class="text-center" style="padding: 40px;">
                      <i class="fa fa-folder-open text-muted" style="font-size: 36px; margin-bottom: 10px;"></i>
                      <p class="text-muted" style="margin:0;">Belum ada data pohon kinerja untuk wilayah ini.</p>
                      <?php if ($isRole3): ?>
                        <button type="button" class="btn btn-sm btn-primary mt-2" data-toggle="modal" data-target="#modalLevel1">
                          <i class="fa fa-plus"></i> Tambah Ultimate Outcome Pertama
                        </button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php else: ?>
                  <?php 
                  $no1 = 1;
                  foreach ($hierarchy as $u): 
                    $hasChild1 = !empty($u['sektor']);
                  ?>
                    <!-- LEVEL 1: ULTIMATE OUTCOME -->
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
                            <span class="badge-lvl badge-lvl-1">ULTIMATE OUTCOME</span>
                            <div style="margin-top: 4px; font-size: 13.5px; color: #1e3a8a;">
                              <?= html_escape($u['kinerja']) ?>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php 
                        if (!empty($u['indikator'])) {
                          $inds = explode('|||', $u['indikator']);
                          foreach ($inds as $ind) {
                            if (trim($ind)) echo '<span class="indicator-tag">' . html_escape($ind) . '</span>';
                          }
                        } else {
                          echo '<span class="text-muted">-</span>';
                        }
                        ?>
                      </td>
                      <td><span class="text-muted">Tingkat Daerah</span></td>
                      <?php if ($isRole3): ?>
                        <td class="text-center">
                          <div class="action-btn-group">
                            <button type="button" class="btn btn-xs btn-success btn-add-child-l2" data-ultimate="<?= $u['id'] ?>" title="Tambah Sektor">
                              + Sektor
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

                    <!-- LEVEL 2: INTERMEDIATE SEKTOR -->
                    <?php 
                    $no2 = 1;
                    foreach ($u['sektor'] as $s): 
                      $hasChild2 = !empty($s['taktikal']);
                    ?>
                      <tr class="row-l2 child-of-u-<?= $u['id'] ?>" id="row-s-<?= $s['id'] ?>" data-node-id="s-<?= $s['id'] ?>" data-parent="u-<?= $u['id'] ?>" data-level="2">
                        <td class="text-center text-muted"><small><?= $no1 . '.' . $no2 ?></small></td>
                        <td class="tree-indent-2">
                          <div class="tree-node-content">
                            <?php if ($hasChild2): ?>
                              <button type="button" class="toggle-btn" onclick="toggleRow('s-<?= $s['id'] ?>')">
                                <i class="fa fa-chevron-down"></i>
                              </button>
                            <?php else: ?>
                              <span style="width:20px; display:inline-block;"></span>
                            <?php endif; ?>
                            <div>
                              <span class="badge-lvl badge-lvl-2">INTERMEDIATE SEKTOR</span>
                              <div style="margin-top: 4px; font-weight: 600; color: #0369a1;">
                                <?= html_escape($s['kinerja']) ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <?php 
                          if (!empty($s['indikator'])) {
                            $inds = explode('|||', $s['indikator']);
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
                            <?php if (!empty($s['pelaksana_detail'])): ?>
                              <div class="dinas-name"><?= html_escape($s['pelaksana_detail']['dinas']) ?></div>
                              <div class="karyawan-name"><?= html_escape($s['pelaksana_detail']['nama']) ?></div>
                            <?php else: ?>
                              <span class="text-muted">-</span>
                            <?php endif; ?>
                          </div>
                        </td>
                        <?php if ($isRole3): ?>
                          <td class="text-center">
                            <div class="action-btn-group">
                              <button type="button" class="btn btn-xs btn-info btn-add-child-l3" data-sektor="<?= $s['id'] ?>" title="Tambah Taktikal">
                                + Taktikal
                              </button>
                              <button type="button" class="btn btn-xs btn-warning btn-edit-level2" 
                                data-id="<?= $s['id'] ?>" 
                                data-ultimate="<?= $s['ultimate_outcome_id'] ?>" 
                                data-kinerja="<?= html_escape($s['kinerja']) ?>" 
                                data-indikator="<?= html_escape($s['indikator']) ?>" 
                                data-pelaksana="<?= html_escape($s['pelaksana']) ?>" 
                                data-inovasi="<?= html_escape($s['inovasi_daerah']) ?>" 
                                data-outcome="<?= html_escape($s['outcome_inovasi']) ?>" 
                                data-output="<?= html_escape($s['output_inovasi']) ?>" 
                                data-crosscutting="<?= html_escape($s['crosscutting']) ?>" 
                                title="Edit">
                                Edit
                              </button>
                              <button type="button" class="btn btn-xs btn-danger btn-hapus-level2" data-id="<?= $s['id'] ?>" title="Hapus">
                                Hapus
                              </button>
                            </div>
                          </td>
                        <?php endif; ?>
                      </tr>

                      <!-- LEVEL 3: INTERMEDIATE TAKTIKAL -->
                      <?php 
                      $no3 = 1;
                      foreach ($s['taktikal'] as $t): 
                        $hasChild3 = !empty($t['immediate']);
                      ?>
                        <tr class="row-l3 child-of-u-<?= $u['id'] ?> child-of-s-<?= $s['id'] ?>" id="row-t-<?= $t['id'] ?>" data-node-id="t-<?= $t['id'] ?>" data-parent="s-<?= $s['id'] ?>" data-level="3">
                          <td class="text-center text-muted"><small><?= $no1 . '.' . $no2 . '.' . $no3 ?></small></td>
                          <td class="tree-indent-3">
                            <div class="tree-node-content">
                              <?php if ($hasChild3): ?>
                                <button type="button" class="toggle-btn" onclick="toggleRow('t-<?= $t['id'] ?>')">
                                  <i class="fa fa-chevron-down"></i>
                                </button>
                              <?php else: ?>
                                <span style="width:20px; display:inline-block;"></span>
                              <?php endif; ?>
                              <div>
                                <span class="badge-lvl badge-lvl-3">INTERMEDIATE TAKTIKAL</span>
                                <div style="margin-top: 4px; font-weight: 600; color: #0f766e;">
                                  <?= html_escape($t['kinerja']) ?>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <?php 
                            if (!empty($t['indikator'])) {
                              $inds = explode('|||', $t['indikator']);
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
                              <?php if (!empty($t['pelaksana_detail'])): ?>
                                <div class="dinas-name"><?= html_escape($t['pelaksana_detail']['dinas']) ?></div>
                                <div class="karyawan-name"><?= html_escape($t['pelaksana_detail']['nama']) ?></div>
                              <?php else: ?>
                                <span class="text-muted">-</span>
                              <?php endif; ?>
                            </div>
                          </td>
                          <?php if ($isRole3): ?>
                            <td class="text-center">
                              <div class="action-btn-group">
                                <button type="button" class="btn btn-xs btn-success btn-add-child-l4" data-taktikal="<?= $t['id'] ?>" title="Tambah Immediate">
                                  + Immediate
                                </button>
                                <button type="button" class="btn btn-xs btn-warning btn-edit-level3" 
                                  data-id="<?= $t['id'] ?>" 
                                  data-sektor="<?= $t['intermediate_sektor_id'] ?>" 
                                  data-kinerja="<?= html_escape($t['kinerja']) ?>" 
                                  data-indikator="<?= html_escape($t['indikator']) ?>" 
                                  data-pelaksana="<?= html_escape($t['pelaksana']) ?>" 
                                  data-inovasi="<?= html_escape($t['inovasi_daerah']) ?>" 
                                  data-outcome="<?= html_escape($t['outcome_inovasi']) ?>" 
                                  data-output="<?= html_escape($t['output_inovasi']) ?>" 
                                  data-crosscutting="<?= html_escape($t['crosscutting']) ?>" 
                                  title="Edit">
                                  Edit
                                </button>
                                <button type="button" class="btn btn-xs btn-danger btn-hapus-level3" data-id="<?= $t['id'] ?>" title="Hapus">
                                  Hapus
                                </button>
                              </div>
                            </td>
                          <?php endif; ?>
                        </tr>

                        <!-- LEVEL 4: IMMEDIATE OUTCOME -->
                        <?php 
                        $no4 = 1;
                        foreach ($t['immediate'] as $imm): 
                          $hasChild4 = !empty($imm['output']);
                        ?>
                          <tr class="row-l4 child-of-u-<?= $u['id'] ?> child-of-s-<?= $s['id'] ?> child-of-t-<?= $t['id'] ?>" id="row-i-<?= $imm['id'] ?>" data-node-id="i-<?= $imm['id'] ?>" data-parent="t-<?= $t['id'] ?>" data-level="4">
                            <td class="text-center text-muted"><small><?= $no1 . '.' . $no2 . '.' . $no3 . '.' . $no4 ?></small></td>
                            <td class="tree-indent-4">
                              <div class="tree-node-content">
                                <?php if ($hasChild4): ?>
                                  <button type="button" class="toggle-btn" onclick="toggleRow('i-<?= $imm['id'] ?>')">
                                    <i class="fa fa-chevron-down"></i>
                                  </button>
                                <?php else: ?>
                                  <span style="width:20px; display:inline-block;"></span>
                                <?php endif; ?>
                                <div>
                                  <span class="badge-lvl badge-lvl-4">IMMEDIATE OUTCOME</span>
                                  <div style="margin-top: 4px; font-weight: 600; color: #c2410c;">
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
                            <?php if ($isRole3): ?>
                              <td class="text-center">
                                <div class="action-btn-group">
                                  <button type="button" class="btn btn-xs btn-primary btn-add-child-l5" data-immediate="<?= $imm['id'] ?>" title="Tambah Output">
                                    + Output
                                  </button>
                                  <button type="button" class="btn btn-xs btn-warning btn-edit-level4" 
                                    data-id="<?= $imm['id'] ?>" 
                                    data-taktikal="<?= $imm['intermediate_taktikal_id'] ?>" 
                                    data-kinerja="<?= html_escape($imm['kinerja']) ?>" 
                                    data-indikator="<?= html_escape($imm['indikator']) ?>" 
                                    data-pelaksana="<?= html_escape($imm['pelaksana']) ?>" 
                                    data-inovasi="<?= html_escape($imm['inovasi_daerah']) ?>" 
                                    data-outcome="<?= html_escape($imm['outcome_inovasi']) ?>" 
                                    data-output="<?= html_escape($imm['output_inovasi']) ?>" 
                                    data-crosscutting="<?= html_escape($imm['crosscutting']) ?>" 
                                    title="Edit">
                                    Edit
                                  </button>
                                  <button type="button" class="btn btn-xs btn-danger btn-hapus-level4" data-id="<?= $imm['id'] ?>" title="Hapus">
                                    Hapus
                                  </button>
                                </div>
                              </td>
                            <?php endif; ?>
                          </tr>

                          <!-- LEVEL 5: OUTPUT -->
                          <?php 
                          $no5 = 1;
                          foreach ($imm['output'] as $out): 
                          ?>
                            <tr class="row-l5 child-of-u-<?= $u['id'] ?> child-of-s-<?= $s['id'] ?> child-of-t-<?= $t['id'] ?> child-of-i-<?= $imm['id'] ?>" id="row-o-<?= $out['id'] ?>" data-node-id="o-<?= $out['id'] ?>" data-parent="i-<?= $imm['id'] ?>" data-level="5">
                              <td class="text-center text-muted"><small><?= $no1 . '.' . $no2 . '.' . $no3 . '.' . $no4 . '.' . $no5 ?></small></td>
                              <td class="tree-indent-5">
                                <div class="tree-node-content">
                                  <span style="width:20px; display:inline-block;"></span>
                                  <div>
                                    <span class="badge-lvl badge-lvl-5">OUTPUT</span>
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
                              <?php if ($isRole3): ?>
                                <td class="text-center">
                                  <div class="action-btn-group">
                                    <button type="button" class="btn btn-xs btn-warning btn-edit-level5" 
                                      data-id="<?= $out['id'] ?>" 
                                      data-immediate="<?= $out['immediate_outcome_id'] ?>" 
                                      data-kinerja="<?= html_escape($out['kinerja']) ?>" 
                                      data-indikator="<?= html_escape($out['indikator']) ?>" 
                                      data-pelaksana="<?= html_escape($out['pelaksana']) ?>" 
                                      data-inovasi="<?= html_escape($out['inovasi_daerah']) ?>" 
                                      data-outcome="<?= html_escape($out['outcome_inovasi']) ?>" 
                                      data-output="<?= html_escape($out['output_inovasi']) ?>" 
                                      data-crosscutting="<?= html_escape($out['crosscutting']) ?>" 
                                      title="Edit">
                                      Edit
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger btn-hapus-level5" data-id="<?= $out['id'] ?>" title="Hapus">
                                      Hapus
                                    </button>
                                  </div>
                                </td>
                              <?php endif; ?>
                            </tr>
                          <?php 
                            $no5++;
                          endforeach; 
                          ?>
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
<!-- ORIGINAL MODAL LEVEL 1 (ULTIMATE OUTCOME) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel1" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalL1Title">Ultimate Outcome (Level 1)</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level1">

        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Ultimate Outcome / Level 1</em>
            </div>
            <textarea id="kinerja_level1" class="form-control" rows="4" required></textarea>
          </div>

          <!-- Indikator Kinerja -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div class="mb-2 text-muted small">
              <em>Ultimate Outcome Level 1 - Indikator Kinerja</em>
            </div>
            <div id="indikator-container-level1"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-indikator-l1">
              <i class="fa fa-plus"></i> Tambah Indikator
            </button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-simpan-level1">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 2 (INTERMEDIATE SEKTOR) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel2" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalL2Title">Intermediate Outcome Sektor (Level 2)</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level2">

        <!-- Tautan kinerja yang lebih tinggi -->
        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Ultimate Outcome -->
          <div class="form-group">
            <label><b>Tautan kinerja yang lebih tinggi</b></label>
            <div class="mb-2 text-muted small">
              <em>Ultimate Outcome (Level 1) → Ultimate Outcome / Level 1</em>
            </div>
            <select id="ultimate_id" class="form-control">
              <option value="">— Pilih Ultimate Outcome —</option>
              <?php foreach ($ultimate_options as $opt): ?>
                <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'],0,100)) . (strlen($opt['kinerja'])>100?'...':'') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Intermediate Outcome / Level 2</em>
            </div>
            <textarea id="kinerja_level2" class="form-control" rows="4" required></textarea>
          </div>

          <!-- Indikator Kinerja -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div class="mb-2 text-muted small">
              <em>Intermediate Outcome Level 2 - Indikator Kinerja</em>
            </div>
            <div id="indikator-container-level2"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-indikator-l2">
              <i class="fa fa-plus"></i> Tambah Indikator
            </button>
          </div>

          <!-- Layout 2 Kolom: KIRI (Pelaksana) dan KANAN (Inovasi) -->
          <div class="row mt-3">
            <!-- KOLOM KIRI (col-md-6) -->
            <div class="col-md-6">
              <!-- Dinas / Instansi -->
              <div class="form-group">
                <label><b>Dinas / Instansi</b></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Dinas untuk memfilter Pelaksana</em>
                </div>
                <select id="dinas_filter_l2" class="form-control select2-dinas" style="width: 100%;">
                  <option value="">-- Semua Dinas --</option>
                </select>
              </div>

              <!-- Pelaksana dari Database -->
              <div class="form-group mt-3">
                <label><b>Pelaksana / Urusan</b></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Pelaksana (Level 4 - Karyawan)</em>
                </div>
                <select id="pelaksana_l2" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>

            <!-- KOLOM KANAN (col-md-6) -->
            <div class="col-md-6">
              <!-- Inovasi Daerah -->
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Intermediate Outcome / Level 2</em>
                </div>
                <div id="inovasi-container-level2"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-inovasi-l2">
                  <i class="fa fa-plus"></i> Tambah Inovasi
                </button>
              </div>

              <!-- Outcome Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Outcome Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Intermediate Outcome / Level 2</em>
                </div>
                <div id="outcome-inovasi-container-level2"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outcome-inovasi-l2">
                  <i class="fa fa-plus"></i> Tambah Outcome
                </button>
              </div>

              <!-- Output Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Output Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Intermediate Outcome / Level 2</em>
                </div>
                <div id="output-inovasi-container-level2"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-output-inovasi-l2">
                  <i class="fa fa-plus"></i> Tambah Output
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- CROSSCUTTING -->
        <div class="form-group">
          <label><b>Crosscutting Dengan:</b></label>
          <div class="mb-2 text-muted small">
            <em>PD/UPT/Lembaga/Desa - Pohon Kinerja - Informasi Kegiatan</em>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #007bff; color:white;">
                <tr>
                  <th class="text-center">PD/UPT/Lembaga/Desa</th>
                  <th class="text-center">Pohon Kinerja</th>
                  <th class="text-center">Informasi Kegiatan</th>
                  <th width="60"></th>
                </tr>
              </thead>
              <tbody id="crosscutting-body-level2"></tbody>
            </table>
          </div>

          <button type="button" class="btn btn-success btn-sm" id="btn-add-crosscutting-l2">
            <i class="fa fa-plus"></i> Add
          </button>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-simpan-level2">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 3 (INTERMEDIATE TAKTIKAL) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel3" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalL3Title">Intermediate Outcome Taktikal (Level 3)</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level3">

        <!-- Tautan kinerja yang lebih tinggi -->
        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Intermediate Sektor -->
          <div class="form-group">
            <label><b>Tautan kinerja yang lebih tinggi</b></label>
            <div class="mb-2 text-muted small">
              <em>Intermediate Outcome Sektor (Level 2) → Intermediate Outcome / Level 2</em>
            </div>
            <select id="sektor_id" class="form-control">
              <option value="">— Pilih Intermediate Sektor —</option>
              <?php foreach ($sektor_options as $opt): ?>
                <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'],0,100)) . (strlen($opt['kinerja'])>100?'...':'') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Intermediate Outcome Taktikal / Level 3</em>
            </div>
            <textarea id="kinerja_level3" class="form-control" rows="4" required></textarea>
          </div>

          <!-- Indikator Kinerja -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div class="mb-2 text-muted small">
              <em>Intermediate Outcome Taktikal Level 3 - Indikator Kinerja</em>
            </div>
            <div id="indikator-container-level3"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-indikator-l3">
              <i class="fa fa-plus"></i> Tambah Indikator
            </button>
          </div>

          <!-- Layout 2 Kolom: KIRI (Pelaksana) dan KANAN (Inovasi) -->
          <div class="row mt-3">
            <!-- KOLOM KIRI (col-md-6) -->
            <div class="col-md-6">
              <!-- Dinas / Instansi -->
              <div class="form-group">
                <label><b>Pilih Dinas / Instansi</b> <span class="text-danger">*</span></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Dinas terlebih dahulu untuk melihat Pelaksana</em>
                </div>
                <select id="dinas_filter_l3" class="form-control select2-dinas" style="width: 100%;" required>
                  <option value="">-- Pilih Dinas --</option>
                </select>
              </div>

              <!-- Pelaksana dari Database -->
              <div class="form-group mt-3" id="pelaksana_group_l3" style="display: none;">
                <label><b>Pelaksana / Urusan</b></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Pelaksana (Level 4 - Karyawan) dari Dinas terpilih</em>
                </div>
                <select id="pelaksana_l3" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>

            <!-- KOLOM KANAN (col-md-6) -->
            <div class="col-md-6">
              <!-- Inovasi Daerah -->
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Intermediate Outcome Taktikal / Level 3</em>
                </div>
                <div id="inovasi-container-level3"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-inovasi-l3">
                  <i class="fa fa-plus"></i> Tambah Inovasi
                </button>
              </div>

              <!-- Outcome Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Outcome Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Intermediate Outcome Taktikal / Level 3</em>
                </div>
                <div id="outcome-inovasi-container-level3"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outcome-inovasi-l3">
                  <i class="fa fa-plus"></i> Tambah Outcome
                </button>
              </div>

              <!-- Output Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Output Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Intermediate Outcome Taktikal / Level 3</em>
                </div>
                <div id="output-inovasi-container-level3"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-output-inovasi-l3">
                  <i class="fa fa-plus"></i> Tambah Output
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- CROSSCUTTING -->
        <div class="form-group">
          <label><b>Crosscutting Dengan:</b></label>
          <div class="mb-2 text-muted small">
            <em>PD/UPT/Lembaga/Desa - Pohon Kinerja - Informasi Kegiatan</em>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #007bff; color:white;">
                <tr>
                  <th class="text-center">PD/UPT/Lembaga/Desa</th>
                  <th class="text-center">Pohon Kinerja</th>
                  <th class="text-center">Informasi Kegiatan</th>
                  <th width="60"></th>
                </tr>
              </thead>
              <tbody id="crosscutting-body-level3"></tbody>
            </table>
          </div>

          <button type="button" class="btn btn-success btn-sm" id="btn-add-crosscutting-l3">
            <i class="fa fa-plus"></i> Add
          </button>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-simpan-level3">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 4 (IMMEDIATE OUTCOME) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel4" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalL4Title">Immediate Outcome (Level 4)</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level4">

        <!-- Tautan kinerja yang lebih tinggi -->
        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Intermediate Taktikal -->
          <div class="form-group">
            <label><b>Tautan kinerja yang lebih tinggi</b></label>
            <div class="mb-2 text-muted small">
              <em>Intermediate Outcome Taktikal (Level 3) → Intermediate Outcome / Level 3</em>
            </div>
            <select id="taktikal_id" class="form-control">
              <option value="">— Pilih Intermediate Taktikal —</option>
              <?php foreach ($taktikal_options as $opt): ?>
                <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'],0,100)) . (strlen($opt['kinerja'])>100?'...':'') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Immediate Outcome / Level 4</em>
            </div>
            <textarea id="kinerja_level4" class="form-control" rows="4" required></textarea>
          </div>

          <!-- Indikator Kinerja -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div class="mb-2 text-muted small">
              <em>Immediate Outcome Level 4 - Indikator Kinerja</em>
            </div>
            <div id="indikator-container-level4"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-indikator-l4">
              <i class="fa fa-plus"></i> Tambah Indikator
            </button>
          </div>

          <!-- Layout 2 Kolom: KIRI (Pelaksana) dan KANAN (Inovasi) -->
          <div class="row mt-3">
            <!-- KOLOM KIRI (col-md-6) -->
            <div class="col-md-6">
              <!-- Dinas / Instansi -->
              <div class="form-group">
                <label><b>Pilih Dinas / Instansi</b> <span class="text-danger">*</span></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Dinas terlebih dahulu untuk melihat Pelaksana</em>
                </div>
                <select id="dinas_filter_l4" class="form-control select2-dinas" style="width: 100%;" required>
                  <option value="">-- Pilih Dinas --</option>
                </select>
              </div>

              <!-- Pelaksana dari Database -->
              <div class="form-group mt-3" id="pelaksana_group_l4" style="display: none;">
                <label><b>Pelaksana / Urusan</b></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Pelaksana (Level 4 - Karyawan) dari Dinas terpilih</em>
                </div>
                <select id="pelaksana_l4" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>

            <!-- KOLOM KANAN (col-md-6) -->
            <div class="col-md-6">
              <!-- Inovasi Daerah -->
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Immediate Outcome / Level 4</em>
                </div>
                <div id="inovasi-container-level4"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-inovasi-l4">
                  <i class="fa fa-plus"></i> Tambah Inovasi
                </button>
              </div>

              <!-- Outcome Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Outcome Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Immediate Outcome / Level 4</em>
                </div>
                <div id="outcome-inovasi-container-level4"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outcome-inovasi-l4">
                  <i class="fa fa-plus"></i> Tambah Outcome
                </button>
              </div>

              <!-- Output Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Output Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Immediate Outcome / Level 4</em>
                </div>
                <div id="output-inovasi-container-level4"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-output-inovasi-l4">
                  <i class="fa fa-plus"></i> Tambah Output
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- CROSSCUTTING -->
        <div class="form-group">
          <label><b>Crosscutting Dengan:</b></label>
          <div class="mb-2 text-muted small">
            <em>PD/UPT/Lembaga/Desa - Pohon Kinerja - Informasi Kegiatan</em>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #007bff; color:white;">
                <tr>
                  <th class="text-center">PD/UPT/Lembaga/Desa</th>
                  <th class="text-center">Pohon Kinerja</th>
                  <th class="text-center">Informasi Kegiatan</th>
                  <th width="60"></th>
                </tr>
              </thead>
              <tbody id="crosscutting-body-level4"></tbody>
            </table>
          </div>

          <button type="button" class="btn btn-success btn-sm" id="btn-add-crosscutting-l4">
            <i class="fa fa-plus"></i> Add
          </button>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-simpan-level4">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- ORIGINAL MODAL LEVEL 5 (OUTPUT) -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalLevel5" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalL5Title">Output / Kinerja Operasional (Level 5)</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_level5">

        <!-- Tautan kinerja yang lebih tinggi -->
        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          <!-- Immediate Outcome -->
          <div class="form-group">
            <label><b>Tautan kinerja yang lebih tinggi</b></label>
            <div class="mb-2 text-muted small">
              <em>Immediate Outcome (Level 4) → Immediate Outcome / Level 4</em>
            </div>
            <select id="immediate_id" class="form-control">
              <option value="">— Pilih Immediate Outcome —</option>
              <?php foreach ($immediate_options as $opt): ?>
                <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'],0,100)) . (strlen($opt['kinerja'])>100?'...':'') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Output / Kinerja Operasional / Level 5</em>
            </div>
            <textarea id="kinerja_level5" class="form-control" rows="4" required></textarea>
          </div>

          <!-- Indikator Kinerja -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div class="mb-2 text-muted small">
              <em>Output Level 5 - Indikator Kinerja</em>
            </div>
            <div id="indikator-container-level5"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-indikator-l5">
              <i class="fa fa-plus"></i> Tambah Indikator
            </button>
          </div>

          <!-- Layout 2 Kolom: KIRI (Pelaksana) dan KANAN (Inovasi) -->
          <div class="row mt-3">
            <!-- KOLOM KIRI (col-md-6) -->
            <div class="col-md-6">
              <!-- Dinas / Instansi -->
              <div class="form-group">
                <label><b>Pilih Dinas / Instansi</b> <span class="text-danger">*</span></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Dinas terlebih dahulu untuk melihat Pelaksana</em>
                </div>
                <select id="dinas_filter_l5" class="form-control select2-dinas" style="width: 100%;" required>
                  <option value="">-- Pilih Dinas --</option>
                </select>
              </div>

              <!-- Pelaksana dari Database -->
              <div class="form-group mt-3" id="pelaksana_group_l5" style="display: none;">
                <label><b>Pelaksana / Urusan</b></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Pelaksana (Level 4 - Karyawan) dari Dinas terpilih</em>
                </div>
                <select id="pelaksana_l5" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>

            <!-- KOLOM KANAN (col-md-6) -->
            <div class="col-md-6">
              <!-- Inovasi Daerah -->
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Output Level 5</em>
                </div>
                <div id="inovasi-container-level5"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-inovasi-l5">
                  <i class="fa fa-plus"></i> Tambah Inovasi
                </button>
              </div>

              <!-- Outcome Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Outcome Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Output Level 5</em>
                </div>
                <div id="outcome-inovasi-container-level5"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outcome-inovasi-l5">
                  <i class="fa fa-plus"></i> Tambah Outcome
                </button>
              </div>

              <!-- Output Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Output Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Output Level 5</em>
                </div>
                <div id="output-inovasi-container-level5"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-output-inovasi-l5">
                  <i class="fa fa-plus"></i> Tambah Output
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- CROSSCUTTING -->
        <div class="form-group">
          <label><b>Crosscutting Dengan:</b></label>
          <div class="mb-2 text-muted small">
            <em>PD/UPT/Lembaga/Desa - Pohon Kinerja - Informasi Kegiatan</em>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #007bff; color:white;">
                <tr>
                  <th class="text-center">PD/UPT/Lembaga/Desa</th>
                  <th class="text-center">Pohon Kinerja</th>
                  <th class="text-center">Informasi Kegiatan</th>
                  <th width="60"></th>
                </tr>
              </thead>
              <tbody id="crosscutting-body-level5"></tbody>
            </table>
          </div>

          <button type="button" class="btn btn-success btn-sm" id="btn-add-crosscutting-l5">
            <i class="fa fa-plus"></i> Add
          </button>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-simpan-level5">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================================= -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";

$(document).ready(function() {

  // ================= FILTER WILAYAH =================
  <?php if (!isset($_SESSION['KodeWilayah'])): ?>
    $("#Provinsi").change(function() {
      var prov = $(this).val();
      if (!prov) {
        $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', true);
        return;
      }
      $.post(BaseURL + "Daerah/GetListKabKota", { Kode: prov }, function(res) {
        var Data = (typeof res === 'string') ? JSON.parse(res) : res;
        var options = '<option value="">Pilih Kab/Kota</option>';
        if (Data && Data.length > 0) {
          for (let i = 0; i < Data.length; i++) {
            options += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
          }
        }
        $("#KabKota").html(options).prop('disabled', false);
        <?php if (!empty($KodeWilayah)): ?>
          $("#KabKota").val("<?= $KodeWilayah ?>");
        <?php endif; ?>
      });
    });

    <?php if (!empty($KodeWilayah)): ?>
      $("#Provinsi").trigger('change');
    <?php endif; ?>

    $("#Filter").click(function() {
      var kab = $("#KabKota").val();
      if (!kab) {
        alert("Pilih Kabupaten/Kota terlebih dahulu!");
        return;
      }
      $.post(BaseURL + "Daerah/SetTempKodeWilayah", { KodeWilayah: kab }, function(res) {
        if (res === '1') location.reload();
        else alert(res || "Gagal filter wilayah");
      });
    });
  <?php endif; ?>

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

  function addCrosscuttingRow(tbody, pd = '', pohon = '', info = '') {
    let row = $(`
      <tr>
        <td><input type="text" class="form-control" value="${pd}"></td>
        <td><input type="text" class="form-control" value="${pohon}"></td>
        <td><input type="text" class="form-control" value="${info}"></td>
        <td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-del-cc"><i class="fa fa-trash"></i></button></td>
      </tr>
    `);
    row.find('.btn-del-cc').click(function() { row.remove(); });
    $(tbody).append(row);
  }

  // ================= LOAD DINAS & PELAKSANA FOR MODALS =================
  function loadDinas(lvl, selectedDinas = '') {
    let url = BaseURL + 'Daerah/get_daftar_dinas';
    if (lvl === 3) url = BaseURL + 'Daerah/get_daftar_dinas_taktikal';
    if (lvl === 4) url = BaseURL + 'Daerah/get_daftar_dinas_immediate';
    if (lvl === 5) url = BaseURL + 'Daerah/get_daftar_dinas_output';

    let $sel = $('#dinas_filter_l' + lvl);
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

      if (selectedDinas) {
        $('#pelaksana_group_l' + lvl).show();
      }
    });
  }

  function loadPelaksana(lvl, dinasId, selectedPel = '') {
    let $group = $('#pelaksana_group_l' + lvl);
    let $sel = $('#pelaksana_l' + lvl);
    if (!dinasId) {
      if (lvl >= 3) $group.hide();
      $sel.html('<option value="">-- Pilih Pelaksana --</option>');
      return;
    }
    $group.show();
    $sel.html('<option value="">Loading...</option>');

    let url = BaseURL + 'Daerah/get_pelaksana_by_dinas';
    if (lvl === 3) url = BaseURL + 'Daerah/get_pelaksana_taktikal_by_dinas';
    if (lvl === 4) url = BaseURL + 'Daerah/get_pelaksana_immediate_by_dinas';
    if (lvl === 5) url = BaseURL + 'Daerah/get_pelaksana_output_by_dinas';

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

  // Bind change events for dinas in modals
  $('#dinas_filter_l2').change(function() { loadPelaksana(2, $(this).val()); });
  $('#dinas_filter_l3').change(function() { loadPelaksana(3, $(this).val()); });
  $('#dinas_filter_l4').change(function() { loadPelaksana(4, $(this).val()); });
  $('#dinas_filter_l5').change(function() { loadPelaksana(5, $(this).val()); });

  // Bind add row buttons
  $('#btn-add-indikator-l1').click(function() { addFieldRow('#indikator-container-level1'); });
  $('#btn-add-indikator-l2').click(function() { addFieldRow('#indikator-container-level2'); });
  $('#btn-add-inovasi-l2').click(function() { addFieldRow('#inovasi-container-level2'); });
  $('#btn-add-outcome-inovasi-l2').click(function() { addFieldRow('#outcome-inovasi-container-level2'); });
  $('#btn-add-output-inovasi-l2').click(function() { addFieldRow('#output-inovasi-container-level2'); });
  $('#btn-add-crosscutting-l2').click(function() { addCrosscuttingRow('#crosscutting-body-level2'); });

  $('#btn-add-indikator-l3').click(function() { addFieldRow('#indikator-container-level3'); });
  $('#btn-add-inovasi-l3').click(function() { addFieldRow('#inovasi-container-level3'); });
  $('#btn-add-outcome-inovasi-l3').click(function() { addFieldRow('#outcome-inovasi-container-level3'); });
  $('#btn-add-output-inovasi-l3').click(function() { addFieldRow('#output-inovasi-container-level3'); });
  $('#btn-add-crosscutting-l3').click(function() { addCrosscuttingRow('#crosscutting-body-level3'); });

  $('#btn-add-indikator-l4').click(function() { addFieldRow('#indikator-container-level4'); });
  $('#btn-add-inovasi-l4').click(function() { addFieldRow('#inovasi-container-level4'); });
  $('#btn-add-outcome-inovasi-l4').click(function() { addFieldRow('#outcome-inovasi-container-level4'); });
  $('#btn-add-output-inovasi-l4').click(function() { addFieldRow('#output-inovasi-container-level4'); });
  $('#btn-add-crosscutting-l4').click(function() { addCrosscuttingRow('#crosscutting-body-level4'); });

  $('#btn-add-indikator-l5').click(function() { addFieldRow('#indikator-container-level5'); });
  $('#btn-add-inovasi-l5').click(function() { addFieldRow('#inovasi-container-level5'); });
  $('#btn-add-outcome-inovasi-l5').click(function() { addFieldRow('#outcome-inovasi-container-level5'); });
  $('#btn-add-output-inovasi-l5').click(function() { addFieldRow('#output-inovasi-container-level5'); });
  $('#btn-add-crosscutting-l5').click(function() { addCrosscuttingRow('#crosscutting-body-level5'); });

  // ================= MODAL LEVEL 1 EVENTS =================
  $(document).on('click', '.btn-edit-level1', function() {
    let id = $(this).attr('data-id');
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';

    $('#id_level1').val(id);
    $('#kinerja_level1').val(kinerja);
    $('#indikator-container-level1').empty();
    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-level1', v.trim()); });
    }
    if (!$('#indikator-container-level1 .field-row').length) {
      addFieldRow('#indikator-container-level1');
    }
    $('#modalLevel1').modal('show');
  });

  $('#btn-simpan-level1').click(function() {
    let id = $('#id_level1').val();
    let kinerja = $('#kinerja_level1').val().trim();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }
    let indikator = [];
    $('#indikator-container-level1 input').each(function() {
      let v = $(this).val().trim();
      if (v) indikator.push(v);
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Daerah/Ultimate_outcome_simpan', { id: id, kinerja: kinerja, indikator: indikator }, function(res) {
      if (res.status === 'success') location.reload();
      else { alert(res.message || 'Gagal'); $('#btn-simpan-level1').prop('disabled', false).text('Simpan Perubahan'); }
    }, 'json');
  });

  $(document).on('click', '.btn-hapus-level1', function() {
    if (!confirm('Yakin menghapus Ultimate Outcome ini beserta seluruh turunannya?')) return;
    $.post(BaseURL + 'Daerah/Ultimate_outcome_hapus', { id: $(this).data('id') }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || 'Gagal menghapus');
    }, 'json');
  });

  // ================= MODAL LEVEL 2 EVENTS =================
  $(document).on('click', '.btn-add-child-l2', function() {
    let ultimateId = $(this).attr('data-ultimate') || '';
    $('#id_level2').val('');
    $('#ultimate_id').val(ultimateId);
    $('#kinerja_level2').val('');
    $('#dinas_filter_l2').val('').trigger('change');
    $('#indikator-container-level2').empty();
    addFieldRow('#indikator-container-level2');
    $('#inovasi-container-level2').empty();
    $('#outcome-inovasi-container-level2').empty();
    $('#output-inovasi-container-level2').empty();
    $('#crosscutting-body-level2').empty();
    loadDinas(2, '');
    loadPelaksana(2, '', '');
    $('#modalLevel2').modal('show');
  });

  $(document).on('click', '.btn-edit-level2', function() {
    let id = $(this).attr('data-id');
    let ultimate = $(this).attr('data-ultimate') || '';
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';
    let inovasi = $(this).attr('data-inovasi') || '';
    let outcome = $(this).attr('data-outcome') || '';
    let output = $(this).attr('data-output') || '';
    let crosscut = $(this).attr('data-crosscutting') || '';

    $('#id_level2').val(id);
    $('#ultimate_id').val(ultimate);
    $('#kinerja_level2').val(kinerja);
    $('#indikator-container-level2').empty();
    $('#inovasi-container-level2').empty();
    $('#outcome-inovasi-container-level2').empty();
    $('#output-inovasi-container-level2').empty();
    $('#crosscutting-body-level2').empty();

    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-level2', v.trim()); });
    }
    if (!$('#indikator-container-level2 .field-row').length) addFieldRow('#indikator-container-level2');

    if (inovasi) inovasi.split('|||').forEach(v => { if (v.trim()) addFieldRow('#inovasi-container-level2', v.trim()); });
    if (outcome) outcome.split('|||').forEach(v => { if (v.trim()) addFieldRow('#outcome-inovasi-container-level2', v.trim()); });
    if (output) output.split('|||').forEach(v => { if (v.trim()) addFieldRow('#output-inovasi-container-level2', v.trim()); });

    if (crosscut) {
      try {
        let arr = (typeof crosscut === 'string') ? JSON.parse(crosscut) : crosscut;
        if (typeof arr === 'string') arr = JSON.parse(arr);
        if (Array.isArray(arr)) {
          arr.forEach(c => addCrosscuttingRow('#crosscutting-body-level2', c.pd || '', c.pohon || '', c.info || ''));
        }
      } catch(e) {}
    }

    if (pelaksanaId) {
      $.post(BaseURL + 'Daerah/get_pelaksana_detail', { id: pelaksanaId }, function(data) {
        let res = (typeof data === 'string') ? JSON.parse(data) : data;
        let dId = (res && res.dinas_id) ? res.dinas_id.split(',')[0] : '';
        loadDinas(2, dId);
        setTimeout(() => { loadPelaksana(2, dId, pelaksanaId); }, 400);
      }).fail(() => { loadDinas(2, ''); loadPelaksana(2, '', pelaksanaId); });
    } else {
      loadDinas(2, '');
      loadPelaksana(2, '', '');
    }

    $('#modalLevel2').modal('show');
  });

  $('#btn-simpan-level2').click(function() {
    let id = $('#id_level2').val();
    let ultimate = $('#ultimate_id').val();
    let kinerja = $('#kinerja_level2').val().trim();
    let pelaksana = $('#pelaksana_l2').val();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }

    let indikator = [];
    $('#indikator-container-level2 input').each(function() { let v = $(this).val().trim(); if (v) indikator.push(v); });
    let inovasi = [];
    $('#inovasi-container-level2 input').each(function() { let v = $(this).val().trim(); if (v) inovasi.push(v); });
    let outcome = [];
    $('#outcome-inovasi-container-level2 input').each(function() { let v = $(this).val().trim(); if (v) outcome.push(v); });
    let output = [];
    $('#output-inovasi-container-level2 input').each(function() { let v = $(this).val().trim(); if (v) output.push(v); });
    let crosscut = [];
    $('#crosscutting-body-level2 tr').each(function() {
      let pd = $(this).find('td:eq(0) input').val().trim();
      let pohon = $(this).find('td:eq(1) input').val().trim();
      let info = $(this).find('td:eq(2) input').val().trim();
      if (pd || pohon || info) crosscut.push({ pd, pohon, info });
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Daerah/Intermediate_sektor_simpan', {
      id: id, ultimate_id: ultimate, kinerja: kinerja,
      indikator: indikator, pelaksana: pelaksana || null,
      inovasi_daerah: inovasi.join('|||'), outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'), crosscutting: crosscut.length ? crosscut : null
    }, function(res) {
      if (res.status === 'success') location.reload();
      else { alert(res.message || 'Gagal'); $('#btn-simpan-level2').prop('disabled', false).text('Simpan Perubahan'); }
    }, 'json');
  });

  $(document).on('click', '.btn-hapus-level2', function() {
    if (!confirm('Yakin menghapus Intermediate Sektor ini beserta turunannya?')) return;
    $.post(BaseURL + 'Daerah/Intermediate_sektor_hapus', { id: $(this).data('id') }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || 'Gagal menghapus');
    }, 'json');
  });

  // ================= MODAL LEVEL 3 EVENTS =================
  $(document).on('click', '.btn-add-child-l3', function() {
    let sektorId = $(this).attr('data-sektor') || '';
    $('#id_level3').val('');
    $('#sektor_id').val(sektorId);
    $('#kinerja_level3').val('');
    $('#dinas_filter_l3').val('').trigger('change');
    $('#indikator-container-level3').empty();
    addFieldRow('#indikator-container-level3');
    $('#inovasi-container-level3').empty();
    $('#outcome-inovasi-container-level3').empty();
    $('#output-inovasi-container-level3').empty();
    $('#crosscutting-body-level3').empty();
    loadDinas(3, '');
    loadPelaksana(3, '', '');
    $('#modalLevel3').modal('show');
  });

  $(document).on('click', '.btn-edit-level3', function() {
    let id = $(this).attr('data-id');
    let sektor = $(this).attr('data-sektor') || '';
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';
    let inovasi = $(this).attr('data-inovasi') || '';
    let outcome = $(this).attr('data-outcome') || '';
    let output = $(this).attr('data-output') || '';
    let crosscut = $(this).attr('data-crosscutting') || '';

    $('#id_level3').val(id);
    $('#sektor_id').val(sektor);
    $('#kinerja_level3').val(kinerja);
    $('#indikator-container-level3').empty();
    $('#inovasi-container-level3').empty();
    $('#outcome-inovasi-container-level3').empty();
    $('#output-inovasi-container-level3').empty();
    $('#crosscutting-body-level3').empty();

    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-level3', v.trim()); });
    }
    if (!$('#indikator-container-level3 .field-row').length) addFieldRow('#indikator-container-level3');

    if (inovasi) inovasi.split('|||').forEach(v => { if (v.trim()) addFieldRow('#inovasi-container-level3', v.trim()); });
    if (outcome) outcome.split('|||').forEach(v => { if (v.trim()) addFieldRow('#outcome-inovasi-container-level3', v.trim()); });
    if (output) output.split('|||').forEach(v => { if (v.trim()) addFieldRow('#output-inovasi-container-level3', v.trim()); });

    if (crosscut) {
      try {
        let arr = (typeof crosscut === 'string') ? JSON.parse(crosscut) : crosscut;
        if (typeof arr === 'string') arr = JSON.parse(arr);
        if (Array.isArray(arr)) {
          arr.forEach(c => addCrosscuttingRow('#crosscutting-body-level3', c.pd || '', c.pohon || '', c.info || ''));
        }
      } catch(e) {}
    }

    if (pelaksanaId) {
      $.post(BaseURL + 'Daerah/get_pelaksana_taktikal_detail', { id: pelaksanaId }, function(data) {
        let res = (typeof data === 'string') ? JSON.parse(data) : data;
        let dId = (res && res.dinas_id) ? res.dinas_id.split(',')[0] : '';
        loadDinas(3, dId);
        setTimeout(() => { loadPelaksana(3, dId, pelaksanaId); }, 400);
      }).fail(() => { loadDinas(3, ''); loadPelaksana(3, '', pelaksanaId); });
    } else {
      loadDinas(3, '');
      loadPelaksana(3, '', '');
    }

    $('#modalLevel3').modal('show');
  });

  $('#btn-simpan-level3').click(function() {
    let id = $('#id_level3').val();
    let sektor = $('#sektor_id').val();
    let kinerja = $('#kinerja_level3').val().trim();
    let pelaksana = $('#pelaksana_l3').val();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }

    let indikator = [];
    $('#indikator-container-level3 input').each(function() { let v = $(this).val().trim(); if (v) indikator.push(v); });
    let inovasi = [];
    $('#inovasi-container-level3 input').each(function() { let v = $(this).val().trim(); if (v) inovasi.push(v); });
    let outcome = [];
    $('#outcome-inovasi-container-level3 input').each(function() { let v = $(this).val().trim(); if (v) outcome.push(v); });
    let output = [];
    $('#output-inovasi-container-level3 input').each(function() { let v = $(this).val().trim(); if (v) output.push(v); });
    let crosscut = [];
    $('#crosscutting-body-level3 tr').each(function() {
      let pd = $(this).find('td:eq(0) input').val().trim();
      let pohon = $(this).find('td:eq(1) input').val().trim();
      let info = $(this).find('td:eq(2) input').val().trim();
      if (pd || pohon || info) crosscut.push({ pd, pohon, info });
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Daerah/Intermediate_taktikal_simpan', {
      id: id, intermediate_sektor_id: sektor, kinerja: kinerja,
      indikator: indikator, pelaksana: pelaksana || null,
      inovasi_daerah: inovasi.join('|||'), outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'), crosscutting: crosscut.length ? crosscut : null
    }, function(res) {
      if (res.status === 'success') location.reload();
      else { alert(res.message || 'Gagal'); $('#btn-simpan-level3').prop('disabled', false).text('Simpan Perubahan'); }
    }, 'json');
  });

  $(document).on('click', '.btn-hapus-level3', function() {
    if (!confirm('Yakin menghapus Intermediate Taktikal ini beserta turunannya?')) return;
    $.post(BaseURL + 'Daerah/Intermediate_taktikal_hapus', { id: $(this).data('id') }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || 'Gagal menghapus');
    }, 'json');
  });

  // ================= MODAL LEVEL 4 EVENTS =================
  $(document).on('click', '.btn-add-child-l4', function() {
    let taktikalId = $(this).attr('data-taktikal') || '';
    $('#id_level4').val('');
    $('#taktikal_id').val(taktikalId);
    $('#kinerja_level4').val('');
    $('#dinas_filter_l4').val('').trigger('change');
    $('#indikator-container-level4').empty();
    addFieldRow('#indikator-container-level4');
    $('#inovasi-container-level4').empty();
    $('#outcome-inovasi-container-level4').empty();
    $('#output-inovasi-container-level4').empty();
    $('#crosscutting-body-level4').empty();
    loadDinas(4, '');
    loadPelaksana(4, '', '');
    $('#modalLevel4').modal('show');
  });

  $(document).on('click', '.btn-edit-level4', function() {
    let id = $(this).attr('data-id');
    let taktikal = $(this).attr('data-taktikal') || '';
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';
    let inovasi = $(this).attr('data-inovasi') || '';
    let outcome = $(this).attr('data-outcome') || '';
    let output = $(this).attr('data-output') || '';
    let crosscut = $(this).attr('data-crosscutting') || '';

    $('#id_level4').val(id);
    $('#taktikal_id').val(taktikal);
    $('#kinerja_level4').val(kinerja);
    $('#indikator-container-level4').empty();
    $('#inovasi-container-level4').empty();
    $('#outcome-inovasi-container-level4').empty();
    $('#output-inovasi-container-level4').empty();
    $('#crosscutting-body-level4').empty();

    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-level4', v.trim()); });
    }
    if (!$('#indikator-container-level4 .field-row').length) addFieldRow('#indikator-container-level4');

    if (inovasi) inovasi.split('|||').forEach(v => { if (v.trim()) addFieldRow('#inovasi-container-level4', v.trim()); });
    if (outcome) outcome.split('|||').forEach(v => { if (v.trim()) addFieldRow('#outcome-inovasi-container-level4', v.trim()); });
    if (output) output.split('|||').forEach(v => { if (v.trim()) addFieldRow('#output-inovasi-container-level4', v.trim()); });

    if (crosscut) {
      try {
        let arr = (typeof crosscut === 'string') ? JSON.parse(crosscut) : crosscut;
        if (typeof arr === 'string') arr = JSON.parse(arr);
        if (Array.isArray(arr)) {
          arr.forEach(c => addCrosscuttingRow('#crosscutting-body-level4', c.pd || '', c.pohon || '', c.info || ''));
        }
      } catch(e) {}
    }

    if (pelaksanaId) {
      $.post(BaseURL + 'Daerah/get_pelaksana_immediate_detail', { id: pelaksanaId }, function(data) {
        let res = (typeof data === 'string') ? JSON.parse(data) : data;
        let dId = (res && res.dinas_id) ? res.dinas_id.split(',')[0] : '';
        loadDinas(4, dId);
        setTimeout(() => { loadPelaksana(4, dId, pelaksanaId); }, 400);
      }).fail(() => { loadDinas(4, ''); loadPelaksana(4, '', pelaksanaId); });
    } else {
      loadDinas(4, '');
      loadPelaksana(4, '', '');
    }

    $('#modalLevel4').modal('show');
  });

  $('#btn-simpan-level4').click(function() {
    let id = $('#id_level4').val();
    let taktikal = $('#taktikal_id').val();
    let kinerja = $('#kinerja_level4').val().trim();
    let pelaksana = $('#pelaksana_l4').val();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }

    let indikator = [];
    $('#indikator-container-level4 input').each(function() { let v = $(this).val().trim(); if (v) indikator.push(v); });
    let inovasi = [];
    $('#inovasi-container-level4 input').each(function() { let v = $(this).val().trim(); if (v) inovasi.push(v); });
    let outcome = [];
    $('#outcome-inovasi-container-level4 input').each(function() { let v = $(this).val().trim(); if (v) outcome.push(v); });
    let output = [];
    $('#output-inovasi-container-level4 input').each(function() { let v = $(this).val().trim(); if (v) output.push(v); });
    let crosscut = [];
    $('#crosscutting-body-level4 tr').each(function() {
      let pd = $(this).find('td:eq(0) input').val().trim();
      let pohon = $(this).find('td:eq(1) input').val().trim();
      let info = $(this).find('td:eq(2) input').val().trim();
      if (pd || pohon || info) crosscut.push({ pd, pohon, info });
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Daerah/Immediate_outcome_simpan', {
      id: id, taktikal_id: taktikal, kinerja: kinerja,
      indikator: indikator, pelaksana: pelaksana || null,
      inovasi_daerah: inovasi.join('|||'), outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'), crosscutting: crosscut.length ? crosscut : null
    }, function(res) {
      if (res.status === 'success') location.reload();
      else { alert(res.message || 'Gagal'); $('#btn-simpan-level4').prop('disabled', false).text('Simpan Perubahan'); }
    }, 'json');
  });

  $(document).on('click', '.btn-hapus-level4', function() {
    if (!confirm('Yakin menghapus Immediate Outcome ini beserta turunannya?')) return;
    $.post(BaseURL + 'Daerah/Immediate_outcome_hapus', { id: $(this).data('id') }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || 'Gagal menghapus');
    }, 'json');
  });

  // ================= MODAL LEVEL 5 EVENTS =================
  $(document).on('click', '.btn-add-child-l5', function() {
    let immediateId = $(this).attr('data-immediate') || '';
    $('#id_level5').val('');
    $('#immediate_id').val(immediateId);
    $('#kinerja_level5').val('');
    $('#dinas_filter_l5').val('').trigger('change');
    $('#indikator-container-level5').empty();
    addFieldRow('#indikator-container-level5');
    $('#inovasi-container-level5').empty();
    $('#outcome-inovasi-container-level5').empty();
    $('#output-inovasi-container-level5').empty();
    $('#crosscutting-body-level5').empty();
    loadDinas(5, '');
    loadPelaksana(5, '', '');
    $('#modalLevel5').modal('show');
  });

  $(document).on('click', '.btn-edit-level5', function() {
    let id = $(this).attr('data-id');
    let immediate = $(this).attr('data-immediate') || '';
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';
    let inovasi = $(this).attr('data-inovasi') || '';
    let outcome = $(this).attr('data-outcome') || '';
    let output = $(this).attr('data-output') || '';
    let crosscut = $(this).attr('data-crosscutting') || '';

    $('#id_level5').val(id);
    $('#immediate_id').val(immediate);
    $('#kinerja_level5').val(kinerja);
    $('#indikator-container-level5').empty();
    $('#inovasi-container-level5').empty();
    $('#outcome-inovasi-container-level5').empty();
    $('#output-inovasi-container-level5').empty();
    $('#crosscutting-body-level5').empty();

    if (indikator) {
      indikator.split('|||').forEach(v => { if (v.trim()) addFieldRow('#indikator-container-level5', v.trim()); });
    }
    if (!$('#indikator-container-level5 .field-row').length) addFieldRow('#indikator-container-level5');

    if (inovasi) inovasi.split('|||').forEach(v => { if (v.trim()) addFieldRow('#inovasi-container-level5', v.trim()); });
    if (outcome) outcome.split('|||').forEach(v => { if (v.trim()) addFieldRow('#outcome-inovasi-container-level5', v.trim()); });
    if (output) output.split('|||').forEach(v => { if (v.trim()) addFieldRow('#output-inovasi-container-level5', v.trim()); });

    if (crosscut) {
      try {
        let arr = (typeof crosscut === 'string') ? JSON.parse(crosscut) : crosscut;
        if (typeof arr === 'string') arr = JSON.parse(arr);
        if (Array.isArray(arr)) {
          arr.forEach(c => addCrosscuttingRow('#crosscutting-body-level5', c.pd || '', c.pohon || '', c.info || ''));
        }
      } catch(e) {}
    }

    if (pelaksanaId) {
      $.post(BaseURL + 'Daerah/get_pelaksana_output_detail', { id: pelaksanaId }, function(data) {
        let res = (typeof data === 'string') ? JSON.parse(data) : data;
        let dId = (res && res.dinas_id) ? res.dinas_id.split(',')[0] : '';
        loadDinas(5, dId);
        setTimeout(() => { loadPelaksana(5, dId, pelaksanaId); }, 400);
      }).fail(() => { loadDinas(5, ''); loadPelaksana(5, '', pelaksanaId); });
    } else {
      loadDinas(5, '');
      loadPelaksana(5, '', '');
    }

    $('#modalLevel5').modal('show');
  });

  $('#btn-simpan-level5').click(function() {
    let id = $('#id_level5').val();
    let immediate = $('#immediate_id').val();
    let kinerja = $('#kinerja_level5').val().trim();
    let pelaksana = $('#pelaksana_l5').val();
    if (!kinerja) { alert('Kinerja wajib diisi!'); return; }

    let indikator = [];
    $('#indikator-container-level5 input').each(function() { let v = $(this).val().trim(); if (v) indikator.push(v); });
    let inovasi = [];
    $('#inovasi-container-level5 input').each(function() { let v = $(this).val().trim(); if (v) inovasi.push(v); });
    let outcome = [];
    $('#outcome-inovasi-container-level5 input').each(function() { let v = $(this).val().trim(); if (v) outcome.push(v); });
    let output = [];
    $('#output-inovasi-container-level5 input').each(function() { let v = $(this).val().trim(); if (v) output.push(v); });
    let crosscut = [];
    $('#crosscutting-body-level5 tr').each(function() {
      let pd = $(this).find('td:eq(0) input').val().trim();
      let pohon = $(this).find('td:eq(1) input').val().trim();
      let info = $(this).find('td:eq(2) input').val().trim();
      if (pd || pohon || info) crosscut.push({ pd, pohon, info });
    });

    $(this).prop('disabled', true).text('Menyimpan...');
    $.post(BaseURL + 'Daerah/Output_simpan', {
      id: id, immediate_id: immediate, kinerja: kinerja,
      indikator: indikator, pelaksana: pelaksana || null,
      inovasi_daerah: inovasi.join('|||'), outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'), crosscutting: crosscut.length ? crosscut : null
    }, function(res) {
      if (res.status === 'success') location.reload();
      else { alert(res.message || 'Gagal'); $('#btn-simpan-level5').prop('disabled', false).text('Simpan Perubahan'); }
    }, 'json');
  });

  $(document).on('click', '.btn-hapus-level5', function() {
    if (!confirm('Yakin menghapus Output ini?')) return;
    $.post(BaseURL + 'Daerah/Output_hapus', { id: $(this).data('id') }, function(res) {
      if (res.status === 'success') location.reload();
      else alert(res.message || 'Gagal menghapus');
    }, 'json');
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
  $('.row-l2, .row-l3, .row-l4, .row-l5').hide();
  $('.toggle-btn').addClass('collapsed');
}
</script>