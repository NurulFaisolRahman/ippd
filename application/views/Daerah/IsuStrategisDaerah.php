<?php 
$this->load->view('Daerah/sidebar'); 
$this->load->view('Daerah/Cssumum'); 

// Helper function to format multiline cell into bullet list or clean lines
if (!function_exists('formatLinearitasCell')) {
    function formatLinearitasCell($text) {
        if ($text === null || trim($text) === '') {
            return '<span class="text-muted">-</span>';
        }
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $lines = array_filter(array_map('trim', $lines), function($item) {
            return $item !== '';
        });
        if (count($lines) <= 1) {
            return nl2br(htmlspecialchars(reset($lines)));
        }
        $html = '<ul class="linearitas-list">';
        foreach ($lines as $line) {
            // Strip existing bullet prefix if typed manually
            $cleanLine = preg_replace('/^[\•\-\*\d\.\)\s]+/u', '', $line);
            if ($cleanLine === '') $cleanLine = $line;
            $html .= '<li>' . htmlspecialchars($cleanLine) . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}

$userLevel = isset($_SESSION['Level']) ? (int)$_SESSION['Level'] : (isset($_SESSION['userLevel']) ? (int)$_SESSION['userLevel'] : null);
$canManage = ($userLevel === 0 || $userLevel === 3);

$uniqueIsuStrategis = [];
$uniquePermasalahan = [];
$uniqueKLHS = [];
$uniqueGlobal = [];
$uniqueNasional = [];
$uniqueRegional = [];

if (!empty($IsuStrategis)) {
    if (!function_exists('addUniqueIsu')) {
        function addUniqueIsu(&$array, $val) {
            $val = trim($val);
            if (empty($val)) return;
            $valLower = strtolower($val);
            foreach ($array as $u) {
                if (strtolower($u) === $valLower) return;
            }
            $array[] = $val;
        }
    }

    foreach ($IsuStrategis as $isu) {
        addUniqueIsu($uniqueIsuStrategis, $isu['NamaIsuStrategis']);
        
        $pm_list = explode("||", str_replace([",", "\n", "\r"], "||", $isu['permasalahan_pokok']));
        foreach($pm_list as $pm) {
            addUniqueIsu($uniquePermasalahan, $pm);
        }
        
        $klhs_list = explode("||", str_replace([",", "\n", "\r"], "||", $isu['isu_klhs']));
        foreach($klhs_list as $klhs) {
            addUniqueIsu($uniqueKLHS, $klhs);
        }

        $glb_list = explode("||", str_replace([",", "\n", "\r"], "||", $isu['isu_global']));
        foreach($glb_list as $glb) {
            addUniqueIsu($uniqueGlobal, $glb);
        }

        $nas_list = explode("||", str_replace([",", "\n", "\r"], "||", $isu['isu_nasional']));
        foreach($nas_list as $nas) {
            addUniqueIsu($uniqueNasional, $nas);
        }

        $reg_list = explode("||", str_replace([",", "\n", "\r"], "||", $isu['isu_regional']));
        foreach($reg_list as $reg) {
            addUniqueIsu($uniqueRegional, $reg);
        }
    }
}

?>

<style>
    :root {
        --theme-green-primary: #00c292;
        --theme-green-dark: #008f6b;
        --theme-green-hover: #00a87e;
        --theme-green-light: #f0fdf4;
        --theme-green-border: #a7f3d0;
    }

    .table-linearitas {
        width: 100% !important;
        border-collapse: collapse !important;
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .table-linearitas thead tr:first-child th {
        background-color: var(--theme-green-primary) !important;
        color: #ffffff !important;
        font-weight: 700;
        text-align: center;
        vertical-align: middle !important;
        border: 1px solid var(--theme-green-hover) !important;
        padding: 10px 8px;
        font-size: 13px;
        letter-spacing: 0.3px;
    }
    .table-linearitas thead tr:last-child th {
        background-color: var(--theme-green-hover) !important;
        color: #ffffff !important;
        font-weight: 600;
        text-align: center;
        vertical-align: middle !important;
        border: 1px solid var(--theme-green-dark) !important;
        padding: 8px 6px;
        font-size: 12px;
    }
    .table-linearitas tbody td {
        vertical-align: top !important;
        border: 1px solid #e5e7eb !important;
        padding: 10px 12px !important;
        font-size: 13px;
        line-height: 1.5;
        color: #374151;
    }
    .table-linearitas tbody tr:hover {
        background-color: var(--theme-green-light) !important;
    }
    .linearitas-list {
        padding-left: 18px;
        margin: 0;
        list-style-type: disc;
    }
    .linearitas-list li {
        margin-bottom: 6px;
        line-height: 1.45;
        text-align: left;
    }
    .linearitas-list li:last-child {
        margin-bottom: 0;
    }
    .card-header-title {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
    }
    .card-header-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 15px;
    }
    .filter-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }
    .btn-action-group {
        display: flex;
        gap: 6px;
        justify-content: center;
        align-items: center;
    }
    .btn-action-group .btn {
        padding: 5px 9px;
        font-size: 12px;
        border-radius: 4px;
    }

    /* Modal Dialog & Scrollable Body */
    .modal-dialog-custom {
        max-width: 860px !important;
        width: 92% !important;
        margin: 25px auto !important;
    }
    .modal-body-scrollable {
        max-height: 68vh !important;
        overflow-y: auto !important;
        padding: 22px 25px !important;
        background-color: #f8fafc;
    }
    /* Custom Green Scrollbar */
    .modal-body-scrollable::-webkit-scrollbar {
        width: 7px;
    }
    .modal-body-scrollable::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .modal-body-scrollable::-webkit-scrollbar-thumb {
        background: #00c292;
        border-radius: 4px;
    }
    .modal-body-scrollable::-webkit-scrollbar-thumb:hover {
        background: #008f6b;
    }
    
    /* Uniform Form Field Card */
    .form-field-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 15px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-field-card:focus-within {
        border-color: #00c292;
        box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.12);
    }
    .form-field-card label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }
    .form-field-card label .field-hint {
        font-size: 11.5px;
        font-weight: 400;
        color: #64748b;
    }
    .form-field-card textarea.form-control {
        width: 100% !important;
        min-height: 84px !important;
        height: 84px !important;
        resize: vertical;
        font-size: 13px !important;
        line-height: 1.5 !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 8px 12px !important;
        box-sizing: border-box !important;
    }
    .form-field-card select.form-control {
        height: 40px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        font-size: 13px !important;
    }

    .modal-section-badge {
        display: inline-block;
        font-size: 12px;
        font-weight: 700;
        color: #065f46;
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 20px;
        padding: 4px 12px;
        margin-bottom: 12px;
        margin-top: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list" style="padding: 25px; border-radius: 8px; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        
                        <!-- Header Title -->
                        <div class="basic-tb-hd" style="border-bottom: 1px solid #f3f4f6; padding-bottom: 15px; margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <h2 class="card-header-title">
                                        <i class="fa fa-sitemap" style="color: #00c292; margin-right: 8px;"></i>
                                        Linearitas Isu Strategis RPJMN, KLHS dan RPJMD
                                    </h2>
                                    <p class="card-header-subtitle">
                                        Wilayah: <strong><?= !empty($NamaWilayah) ? html_escape($NamaWilayah) : 'Pilih Wilayah Terlebih Dahulu' ?></strong>
                                    </p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <?php if ($canManage && !empty($KodeWilayah)) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" id="BtnTambahIsuStrategis" style="border-radius: 6px; background-color: #00c292; border-color: #00c292;">
                                        <i class="fa fa-plus"></i> <b>Tambah Isu Strategis</b>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Wilayah & Periode -->
                        <div class="filter-box">
                            <div class="row">
                                <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="Provinsi">Provinsi</label>
                                        <select class="form-control filter-select" id="Provinsi" style="width: 100%;">
                                            <option value="">-- Pilih Provinsi --</option>
                                            <?php foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="KabKota">Kabupaten / Kota</label>
                                        <select class="form-control filter-select" id="KabKota" style="width: 100%;">
                                            <option value="">-- Pilih Kab/Kota --</option>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="FilterPeriode">Periode RPJMD</label>
                                        <select class="form-control" id="FilterPeriode" style="width: 100%;">
                                            <option value="">-- Semua Periode --</option>
                                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                                                $selectedP = (isset($selectedPeriode) && $selectedPeriode == $valP) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $valP ?>" <?= $selectedP ?>>
                                                    <?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?>
                                                </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <div class="form-group" style="margin-top: 25px;">
                                        <button class="btn btn-success notika-btn-success btn-block" id="BtnTerapkanFilter" style="border-radius: 6px; background-color: #00c292; border-color: #00c292;">
                                            <i class="fa fa-filter"></i> <b>Filter</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Notice jika belum ada data atau belum pilih wilayah -->
                        <?php if (empty($KodeWilayah)) { ?>
                            <div class="alert alert-warning" style="border-radius: 6px;">
                                <i class="fa fa-info-circle"></i> Silakan pilih Provinsi dan Kabupaten/Kota terlebih dahulu untuk melihat data Isu Strategis Daerah.
                            </div>
                        <?php } ?>

                        <!-- Tabel Linearitas Isu Strategis -->
                        <div class="table-responsive" style="margin-top: 15px;">
                            <table class="table table-bordered table-linearitas" id="tabelIsuStrategis">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 4%;">No</th>
                                        <th rowspan="2" style="width: 23%;">Permasalahan</th>
                                        <th rowspan="2" style="width: 15%;">Isu KLHS</th>
                                        <th colspan="3" style="width: 38%;">Isu Lingkungan Dinamis</th>
                                        <th rowspan="2" style="width: 14%;">Isu Strategis</th>
                                        <?php if ($canManage) { ?>
                                        <th rowspan="2" style="width: 6%;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="width: 13%;">Global</th>
                                        <th style="width: 12%;">Nasional</th>
                                        <th style="width: 13%;">Regional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php if (!empty($IsuStrategis)) { 
                                          // Grouping logic for rowspan
                                          $grouped = [];
                                          foreach ($IsuStrategis as $row) {
                                              $nama = trim($row['NamaIsuStrategis']);
                                              $grouped[$nama][] = $row;
                                          }
                                          $no = 1;
                                          foreach ($grouped as $nama => $rows) {
                                              $rowspan = count($rows);
                                              foreach ($rows as $index => $row) {
                                      ?>
                                          <tr>
                                              <td class="text-center dt-index" style="font-weight: 600; vertical-align: middle;"><?= $no++ ?></td>
                                              
                                              <td style="vertical-align: middle;"><?= formatLinearitasCell($row['permasalahan_pokok']) ?></td>
                                              <td style="vertical-align: middle;"><?= formatLinearitasCell($row['isu_klhs']) ?></td>
                                              <td style="vertical-align: middle;"><?= formatLinearitasCell($row['isu_global'] ?? '') ?></td>
                                              <td style="vertical-align: middle;"><?= formatLinearitasCell($row['isu_nasional'] ?? '') ?></td>
                                              <td style="vertical-align: middle;"><?= formatLinearitasCell($row['isu_regional'] ?? '') ?></td>
                                              
                                              <?php if ($index === 0) { ?>
                                              <td rowspan="<?= $rowspan ?>" style="font-weight: 600; color: #1f2937; vertical-align: middle;">
                                                  <?= formatLinearitasCell($row['NamaIsuStrategis']) ?>
                                                  <?php if (!empty($row['TahunMulai']) && !empty($row['TahunAkhir'])) { ?>
                                                      <div style="margin-top: 6px;">
                                                          <span class="badge" style="background-color: #ecfdf5; color: #065f46; font-size: 11px; border: 1px solid #a7f3d0; font-weight: 600;">
                                                              <?= html_escape($row['TahunMulai']) ?> - <?= html_escape($row['TahunAkhir']) ?>
                                                          </span>
                                                      </div>
                                                  <?php } ?>
                                              </td>
                                              <?php } ?>
                                              
                                              <?php if ($canManage) { ?>
                                              <td class="text-center" style="vertical-align: middle !important;">
                                                  <div class="btn-action-group">
                                                      <button type="button" class="btn btn-sm EditIsuStrategis" 
                                                              data-id="<?= $row['Id'] ?>" 
                                                              title="Edit Data" 
                                                              style="background: #00c292; border-color: #00a87e; color: #fff;">
                                                          <i class="fa fa-pencil"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-danger btn-sm HapusIsuStrategis" 
                                                              data-id="<?= $row['Id'] ?>" 
                                                              title="Hapus Data" 
                                                              style="background: #ef4444; border-color: #dc2626; color: #fff;">
                                                          <i class="fa fa-trash"></i>
                                                      </button>
                                                  </div>
                                              </td>
                                              <?php } ?>
                                          </tr>
                                      <?php } } } else { ?>
                                          <tr>
                                              <td colspan="<?= $canManage ? '8' : '7' ?>" class="text-center text-muted" style="padding: 30px !important;">
                                                  <i class="fa fa-folder-open-o fa-2x" style="display: block; margin-bottom: 8px; color: #9ca3af;"></i>
                                                  Belum ada data Isu Strategis Daerah untuk wilayah ini.
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
</div>

<!-- MODAL TAMBAH ISU STRATEGIS DAERAH -->
<div class="modal fade" id="ModalTambahIsuStrategis" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; text-align: left; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #00c292 0%, #008f6b 100%); color: #fff; padding: 16px 24px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="color: #fff; font-weight: 700; font-size: 16px;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Isu Strategis Daerah
                </h4>
            </div>
            <form id="FormTambahIsuStrategis">
                <div class="modal-body modal-body-scrollable">
                    
                    <!-- 1. Periode RPJMD -->
                    <div class="form-field-card">
                        <label for="TambahPeriodeRPJMD">
                            <span class="dynamic-number">Periode RPJMD <span class="text-danger">*</span></span>
                            <span class="field-hint">Pilih periode berlaku dokumen</span>
                        </label>
                        <select class="form-control" name="PeriodeRPJMD" id="TambahPeriodeRPJMD">
                            <option value="">-- Pilih Periode --</option>
                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                            ?>
                                <option value="<?= $valP ?>"><?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?></option>
                            <?php } } else { ?>
                                <option value="2025-2029">2025 - 2029</option>
                                <option value="2026-2030">2026 - 2030</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- 2. Isu Strategis -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Strategis Daerah <span class="text-danger">*</span></span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="mode_NamaIsuStrategis" value="pilih" checked onchange="toggleFieldMode('tambah', 'NamaIsuStrategis', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="mode_NamaIsuStrategis" value="manual" onchange="toggleFieldMode('tambah', 'NamaIsuStrategis', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapTambahNamaIsuStrategisPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Strategis Daerah</span>
                            <select class="select2 form-control" name="NamaIsuStrategis_pilih" id="TambahNamaIsuStrategisPilih" data-placeholder="Pilih Isu Strategis Daerah" style="width: 100%;">
                                <option value="">-- Pilih Isu Strategis Daerah --</option>
                                <?php foreach ($uniqueIsuStrategis as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapTambahNamaIsuStrategisManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Strategis Daerah secara manual</span>
                            <textarea class="form-control" name="NamaIsuStrategis_manual" id="TambahNamaIsuStrategisManual" placeholder="Contoh: SDM Belum Berdaya Saing"></textarea>
                        </div>
                    </div>

                    <!-- 3. Permasalahan -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Permasalahan Pokok</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="mode_permasalahan_pokok" value="pilih" checked onchange="toggleFieldMode('tambah', 'permasalahan_pokok', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="mode_permasalahan_pokok" value="manual" onchange="toggleFieldMode('tambah', 'permasalahan_pokok', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapTambahPermasalahan_pokokPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih permasalahan</span>
                            <select class="select2 form-control" multiple="multiple" name="permasalahan_pokok_pilih[]" id="TambahPermasalahan_pokokPilih" data-placeholder="Pilih Permasalahan Pokok" style="width: 100%;">
                                <option value="">-- Pilih Permasalahan Pokok --</option>
                                <?php foreach ($uniquePermasalahan as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapTambahPermasalahan_pokokManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Permasalahan Pokok secara manual</span>
                            <textarea class="form-control" name="permasalahan_pokok_manual" id="TambahPermasalahan_pokokManual" placeholder="Tekan Enter..."></textarea>
                        </div>
                    </div>

                    <!-- 4. Isu KLHS -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu KLHS</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="mode_isu_klhs" value="pilih" checked onchange="toggleFieldMode('tambah', 'isu_klhs', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="mode_isu_klhs" value="manual" onchange="toggleFieldMode('tambah', 'isu_klhs', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapTambahIsu_klhsPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu KLHS</span>
                            <select class="select2 form-control" name="isu_klhs_pilih" id="TambahIsu_klhsPilih" data-placeholder="Pilih Isu KLHS" style="width: 100%;">
                                <option value="">-- Pilih Isu KLHS --</option>
                                <?php foreach ($uniqueKLHS as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapTambahIsu_klhsManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu KLHS secara manual</span>
                            <textarea class="form-control" name="isu_klhs_manual" id="TambahIsu_klhsManual" placeholder="Contoh: Kualitas SDM"></textarea>
                        </div>
                    </div>

                    <div class="text-center" style="margin: 10px 0;">
                        <span class="modal-section-badge">
                            <i class="fa fa-globe"></i> Isu Lingkungan Dinamis
                        </span>
                    </div>

                    <!-- 5. Isu Lingkungan Dinamis: Global -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Global</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="mode_isu_global" value="pilih" checked onchange="toggleFieldMode('tambah', 'isu_global', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="mode_isu_global" value="manual" onchange="toggleFieldMode('tambah', 'isu_global', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapTambahIsu_globalPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Global</span>
                            <select class="select2 form-control" name="isu_global_pilih" id="TambahIsu_globalPilih" data-placeholder="Pilih Isu Global" style="width: 100%;">
                                <option value="">-- Pilih Isu Global --</option>
                                <?php foreach ($uniqueGlobal as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapTambahIsu_globalManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Global secara manual</span>
                            <textarea class="form-control" name="isu_global_manual" id="TambahIsu_globalManual" placeholder="Contoh: Persaingan"></textarea>
                        </div>
                    </div>

                    <!-- 6. Isu Lingkungan Dinamis: Nasional -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Nasional</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="mode_isu_nasional" value="pilih" checked onchange="toggleFieldMode('tambah', 'isu_nasional', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="mode_isu_nasional" value="manual" onchange="toggleFieldMode('tambah', 'isu_nasional', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapTambahIsu_nasionalPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Nasional</span>
                            <select class="select2 form-control" name="isu_nasional_pilih" id="TambahIsu_nasionalPilih" data-placeholder="Pilih Isu Nasional" style="width: 100%;">
                                <option value="">-- Pilih Isu Nasional --</option>
                                <?php foreach ($uniqueNasional as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapTambahIsu_nasionalManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Nasional secara manual</span>
                            <textarea class="form-control" name="isu_nasional_manual" id="TambahIsu_nasionalManual" placeholder="Contoh: Rendahnya SDM"></textarea>
                        </div>
                    </div>

                    <!-- 7. Isu Lingkungan Dinamis: Regional -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Regional</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="mode_isu_regional" value="pilih" checked onchange="toggleFieldMode('tambah', 'isu_regional', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="mode_isu_regional" value="manual" onchange="toggleFieldMode('tambah', 'isu_regional', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapTambahIsu_regionalPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Regional</span>
                            <select class="select2 form-control" name="isu_regional_pilih" id="TambahIsu_regionalPilih" data-placeholder="Pilih Isu Regional" style="width: 100%;">
                                <option value="">-- Pilih Isu Regional --</option>
                                <?php foreach ($uniqueRegional as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapTambahIsu_regionalManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Regional secara manual</span>
                            <textarea class="form-control" name="isu_regional_manual" id="TambahIsu_regionalManual" placeholder="Contoh: SDM"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="background-color: #ffffff; border-top: 1px solid #e2e8f0; padding: 14px 25px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; padding: 7px 18px;">Batal</button>
                    <button type="submit" class="btn btn-success notika-btn-success" id="BtnSimpanTambah" style="background-color: #00c292; border-color: #00c292; border-radius: 6px; padding: 7px 20px;">
                        <i class="fa fa-save"></i> <b>Simpan Data</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT ISU STRATEGIS DAERAH -->
<div class="modal fade" id="ModalEditIsuStrategis" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-custom" role="document">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; text-align: left; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #00c292 0%, #00a87e 100%); color: #fff; padding: 16px 24px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="color: #fff; font-weight: 700; font-size: 16px;">
                    <i class="fa fa-edit" style="margin-right: 6px;"></i> Edit Isu Strategis Daerah
                </h4>
            </div>
            <form id="FormEditIsuStrategis">
                <input type="hidden" name="Id" id="EditId">
                <div class="modal-body modal-body-scrollable">
                    
                    <!-- 1. Periode RPJMD -->
                    <div class="form-field-card">
                        <label for="EditPeriodeRPJMD">
                            <span class="dynamic-number">Periode RPJMD <span class="text-danger">*</span></span>
                            <span class="field-hint">Pilih periode berlaku dokumen</span>
                        </label>
                        <select class="form-control" name="EditPeriodeRPJMD" id="EditPeriodeRPJMD">
                            <option value="">-- Pilih Periode --</option>
                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                            ?>
                                <option value="<?= $valP ?>"><?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?></option>
                            <?php } } else { ?>
                                <option value="2025-2029">2025 - 2029</option>
                                <option value="2026-2030">2026 - 2030</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- 2. Isu Strategis -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Strategis Daerah <span class="text-danger">*</span></span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="edit_mode_NamaIsuStrategis" value="pilih" checked onchange="toggleFieldMode('edit', 'NamaIsuStrategis', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="edit_mode_NamaIsuStrategis" value="manual" onchange="toggleFieldMode('edit', 'NamaIsuStrategis', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapEditNamaIsuStrategisPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Strategis Daerah</span>
                            <select class="select2 form-control" name="NamaIsuStrategis_pilih" id="EditNamaIsuStrategisPilih" data-placeholder="Pilih Isu Strategis Daerah" style="width: 100%;">
                                <option value="">-- Pilih Isu Strategis Daerah --</option>
                                <?php foreach ($uniqueIsuStrategis as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapEditNamaIsuStrategisManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Strategis Daerah secara manual</span>
                            <textarea class="form-control" name="NamaIsuStrategis_manual" id="EditNamaIsuStrategisManual" placeholder="Contoh: SDM Belum Berdaya Saing"></textarea>
                        </div>
                    </div>

                    <!-- 3. Permasalahan -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Permasalahan Pokok</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="edit_mode_permasalahan_pokok" value="pilih" checked onchange="toggleFieldMode('edit', 'permasalahan_pokok', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="edit_mode_permasalahan_pokok" value="manual" onchange="toggleFieldMode('edit', 'permasalahan_pokok', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapEditPermasalahan_pokokPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih permasalahan</span>
                            <select class="select2 form-control" multiple="multiple" name="permasalahan_pokok_pilih[]" id="EditPermasalahan_pokokPilih" data-placeholder="Pilih Permasalahan Pokok" style="width: 100%;">
                                <option value="">-- Pilih Permasalahan Pokok --</option>
                                <?php foreach ($uniquePermasalahan as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapEditPermasalahan_pokokManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Permasalahan Pokok secara manual</span>
                            <textarea class="form-control" name="permasalahan_pokok_manual" id="EditPermasalahan_pokokManual" placeholder="Tekan Enter..."></textarea>
                        </div>
                    </div>

                    <!-- 4. Isu KLHS -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu KLHS</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_klhs" value="pilih" checked onchange="toggleFieldMode('edit', 'isu_klhs', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_klhs" value="manual" onchange="toggleFieldMode('edit', 'isu_klhs', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapEditIsu_klhsPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu KLHS</span>
                            <select class="select2 form-control" name="isu_klhs_pilih" id="EditIsu_klhsPilih" data-placeholder="Pilih Isu KLHS" style="width: 100%;">
                                <option value="">-- Pilih Isu KLHS --</option>
                                <?php foreach ($uniqueKLHS as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapEditIsu_klhsManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu KLHS secara manual</span>
                            <textarea class="form-control" name="isu_klhs_manual" id="EditIsu_klhsManual" placeholder="Contoh: Kualitas SDM"></textarea>
                        </div>
                    </div>

                    <div class="text-center" style="margin: 10px 0;">
                        <span class="modal-section-badge">
                            <i class="fa fa-globe"></i> Isu Lingkungan Dinamis
                        </span>
                    </div>

                    <!-- 5. Isu Lingkungan Dinamis: Global -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Global</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_global" value="pilih" checked onchange="toggleFieldMode('edit', 'isu_global', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_global" value="manual" onchange="toggleFieldMode('edit', 'isu_global', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapEditIsu_globalPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Global</span>
                            <select class="select2 form-control" name="isu_global_pilih" id="EditIsu_globalPilih" data-placeholder="Pilih Isu Global" style="width: 100%;">
                                <option value="">-- Pilih Isu Global --</option>
                                <?php foreach ($uniqueGlobal as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapEditIsu_globalManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Global secara manual</span>
                            <textarea class="form-control" name="isu_global_manual" id="EditIsu_globalManual" placeholder="Contoh: Persaingan"></textarea>
                        </div>
                    </div>

                    <!-- 6. Isu Lingkungan Dinamis: Nasional -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Nasional</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_nasional" value="pilih" checked onchange="toggleFieldMode('edit', 'isu_nasional', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_nasional" value="manual" onchange="toggleFieldMode('edit', 'isu_nasional', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapEditIsu_nasionalPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Nasional</span>
                            <select class="select2 form-control" name="isu_nasional_pilih" id="EditIsu_nasionalPilih" data-placeholder="Pilih Isu Nasional" style="width: 100%;">
                                <option value="">-- Pilih Isu Nasional --</option>
                                <?php foreach ($uniqueNasional as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapEditIsu_nasionalManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Nasional secara manual</span>
                            <textarea class="form-control" name="isu_nasional_manual" id="EditIsu_nasionalManual" placeholder="Contoh: Rendahnya SDM"></textarea>
                        </div>
                    </div>

                    <!-- 7. Isu Lingkungan Dinamis: Regional -->
                    <div class="form-field-card">
                        <label>
                            <span class="dynamic-number">Isu Regional</span>
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label class="radio-inline" style="margin-right: 15px; cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_regional" value="pilih" checked onchange="toggleFieldMode('edit', 'isu_regional', this.value)"> Pilih dari Data Master
                            </label>
                            <label class="radio-inline" style="cursor: pointer;">
                                <input type="radio" name="edit_mode_isu_regional" value="manual" onchange="toggleFieldMode('edit', 'isu_regional', this.value)"> Input Manual
                            </label>
                        </div>
                        
                        <div id="WrapEditIsu_regionalPilih">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Pilih Isu Regional</span>
                            <select class="select2 form-control" name="isu_regional_pilih" id="EditIsu_regionalPilih" data-placeholder="Pilih Isu Regional" style="width: 100%;">
                                <option value="">-- Pilih Isu Regional --</option>
                                <?php foreach ($uniqueRegional as $opt) { ?>
                                    <option value="<?= html_escape($opt) ?>"><?= html_escape($opt) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="WrapEditIsu_regionalManual" style="display: none;">
                            <span class="field-hint" style="display:block; margin-bottom: 5px;">Ketik Isu Regional secara manual</span>
                            <textarea class="form-control" name="isu_regional_manual" id="EditIsu_regionalManual" placeholder="Contoh: SDM"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="background-color: #ffffff; border-top: 1px solid #e2e8f0; padding: 14px 25px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; padding: 7px 18px;">Batal</button>
                    <button type="submit" class="btn btn-success notika-btn-success" id="BtnSimpanEdit" style="background-color: #00c292; border-color: #00c292; border-radius: 6px; padding: 7px 20px;">
                        <i class="fa fa-save"></i> <b>Simpan Perubahan</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
  #FormTambahIsuStrategis { counter-reset: form-counter; }
  #FormEditIsuStrategis { counter-reset: form-counter; }
  .dynamic-number::before {
      counter-increment: form-counter;
      content: counter(form-counter) ". ";
  }
</style>

<!-- Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var BaseURL = "<?= base_url() ?>";
    var CurrentKodeWilayah = "<?= $KodeWilayah ?>";

    $(document).ready(function() {

        window.toggleFieldMode = function(mode, field, type) {
            var prefix = (mode === 'tambah') ? 'Tambah' : 'Edit';
            var fCap = field.charAt(0).toUpperCase() + field.slice(1);
            if (type === 'pilih') {
                $('#Wrap' + prefix + fCap + 'Pilih').show();
                $('#Wrap' + prefix + fCap + 'Manual').hide();
            } else {
                $('#Wrap' + prefix + fCap + 'Pilih').hide();
                $('#Wrap' + prefix + fCap + 'Manual').show();
            }
        };

        $('#ModalTambahIsuStrategis').on('shown.bs.modal', function () {
            $('#TambahNamaIsuStrategisPilih, #TambahPermasalahan_pokokPilih, #TambahIsu_klhsPilih, #TambahIsu_globalPilih, #TambahIsu_nasionalPilih, #TambahIsu_regionalPilih').select2({
                tags: true, width: '100%', dropdownParent: $('#ModalTambahIsuStrategis'), tokenSeparators: [',', '\n']
            });
        });

        $('#ModalEditIsuStrategis').on('shown.bs.modal', function () {
            $('#EditNamaIsuStrategisPilih, #EditPermasalahan_pokokPilih, #EditIsu_klhsPilih, #EditIsu_globalPilih, #EditIsu_nasionalPilih, #EditIsu_regionalPilih').select2({
                tags: true, width: '100%', dropdownParent: $('#ModalEditIsuStrategis'), tokenSeparators: [',', '\n']
            });
        });


        // Filter Wilayah (Provinsi -> Kab/Kota)
        $('#Provinsi').on('change', function() {
            var provKode = $(this).val();
            var $kabSelect = $('#KabKota');
            $kabSelect.html('<option value="">-- Pilih Kab/Kota --</option>');
            
            if (provKode) {
                $.ajax({
                    url: BaseURL + 'Daerah/KabKota',
                    type: 'POST',
                    data: { Kode: provKode },
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(index, item) {
                            var isSelected = (CurrentKodeWilayah == item.Kode) ? 'selected' : '';
                            $kabSelect.append('<option value="' + item.Kode + '" ' + isSelected + '>' + item.Nama + '</option>');
                        });
                    }
                });
            }
        });

        // Trigger change jika provinsi sudah terisi
        if ($('#Provinsi').val()) {
            $('#Provinsi').trigger('change');
        }

        // Tombol Terapkan Filter
        $('#BtnTerapkanFilter').on('click', function() {
            var kabKode = $('#KabKota').val();
            var provKode = $('#Provinsi').val();
            var periode = $('#FilterPeriode').val();

            if (kabKode) {
                // Set session wilayah via AJAX lalu reload
                $.ajax({
                    url: BaseURL + 'Daerah/SetSessionWilayah',
                    type: 'POST',
                    data: { KodeWilayah: kabKode },
                    success: function() {
                        var url = BaseURL + 'Daerah/IsuStrategisDaerah';
                        if (periode) {
                            url += '?periode=' + encodeURIComponent(periode);
                        }
                        window.location.href = url;
                    },
                    error: function() {
                        var url = BaseURL + 'Daerah/IsuStrategisDaerah';
                        if (periode) {
                            url += '?periode=' + encodeURIComponent(periode);
                        }
                        window.location.href = url;
                    }
                });
            } else {
                var url = BaseURL + 'Daerah/IsuStrategisDaerah';
                if (periode) {
                    url += '?periode=' + encodeURIComponent(periode);
                }
                window.location.href = url;
            }
        });

        // Buka Modal Tambah
        $('#BtnTambahIsuStrategis').on('click', function() {
            $('#FormTambahIsuStrategis')[0].reset();

            // Reset radio to pilih and trigger change for UI toggle
            $('input[name^="mode_"][value="pilih"]').prop('checked', true).trigger('change');
            
            // Reset all select2 values in Tambah
            $('#TambahNamaIsuStrategisPilih, #TambahPermasalahan_pokokPilih, #TambahIsu_klhsPilih, #TambahIsu_globalPilih, #TambahIsu_nasionalPilih, #TambahIsu_regionalPilih').val(null).trigger('change');
            
            // Reset manual textareas
            $('#FormTambahIsuStrategis textarea').val('');

            var curPeriode = $('#FilterPeriode').val();
            if (curPeriode) {
                $('#TambahPeriodeRPJMD').val(curPeriode);
            }
            $('#ModalTambahIsuStrategis').modal('show');
        });

        // Submit Form Tambah
        $('#FormTambahIsuStrategis').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $('#BtnSimpanTambah').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/InputIsuStrategis',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    $('#BtnSimpanTambah').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Terjadi kesalahan saat menyimpan data.'
                        });
                    }
                },
                error: function() {
                    $('#BtnSimpanTambah').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan pada server.'
                    });
                }
            });
        });

        // Buka Modal Edit
        $(document).on('click', '.EditIsuStrategis', function() {
            var id = $(this).data('id');
            if (!id) return;

            $.ajax({
                url: BaseURL + 'Daerah/GetIsuStrategisById',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success' && res.data) {
                        var d = res.data;
                        $('#EditId').val(d.Id);
                        
                        var perVal = d.TahunMulai + '-' + d.TahunAkhir;
                        $('#EditPeriodeRPJMD').val(perVal);
                        if (!$('#EditPeriodeRPJMD').val()) {
                            // If not existing in select option, append it
                            $('#EditPeriodeRPJMD').append('<option value="' + perVal + '" selected>' + d.TahunMulai + ' - ' + d.TahunAkhir + '</option>');
                        }

                        
                        // Helper to set field
                        function setFieldEdit(field, dbVal) {
                            var fCap = field.charAt(0).toUpperCase() + field.slice(1);
                            var selId = '#Edit' + fCap + 'Pilih';
                            var manId = '#Edit' + fCap + 'Manual';
                            var rdoName = 'edit_mode_' + field;
                            
                            $('input[name="' + rdoName + '"][value="pilih"]').prop('checked', true).trigger('change');
                            $(manId).val('');
                            
                            if (dbVal) {
                                var exists = false;
                                $(selId + ' option').each(function() {
                                    if (this.value.toLowerCase() == dbVal.toLowerCase()) {
                                        dbVal = this.value; // Use the properly cased option value for Select2
                                        exists = true;
                                        return false;
                                    }
                                });
                                
                                var isMultiple = $(selId).prop('multiple');
                                if (isMultiple) {
                                    var vals = dbVal.split(/[\n,]/).map(function(s){return s.trim();}).filter(function(s){return s !== '';});
                                    var matched = [];
                                    var unmatched = [];
                                    vals.forEach(function(v) {
                                        var found = false;
                                        $(selId + ' option').each(function() {
                                            if (this.value.toLowerCase() == v.toLowerCase()) {
                                                matched.push(this.value);
                                                found = true;
                                                return false;
                                            }
                                        });
                                        if (!found) unmatched.push(v);
                                    });
                                    if (unmatched.length > 0) {
                                        $('input[name="' + rdoName + '"][value="manual"]').prop('checked', true).trigger('change');
                                        $(manId).val(dbVal);
                                        $(selId).val(null).trigger('change');
                                    } else {
                                        $(selId).val(matched).trigger('change');
                                    }
                                } else {
                                    if (exists) {
                                        $(selId).val(dbVal).trigger('change');
                                    } else {
                                        $('input[name="' + rdoName + '"][value="manual"]').prop('checked', true).trigger('change');
                                        $(manId).val(dbVal);
                                        $(selId).val(null).trigger('change');
                                    }
                                }
                            } else {
                                $(selId).val(null).trigger('change');
                            }
                        }

                        setFieldEdit('NamaIsuStrategis', d.NamaIsuStrategis);
                        setFieldEdit('permasalahan_pokok', d.permasalahan_pokok);
                        setFieldEdit('isu_klhs', d.isu_klhs);
                        setFieldEdit('isu_global', d.isu_global);
                        setFieldEdit('isu_nasional', d.isu_nasional);
                        setFieldEdit('isu_regional', d.isu_regional);


                        $('#ModalEditIsuStrategis').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Data tidak ditemukan.'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengambil data dari server.'
                    });
                }
            });
        });

        // Submit Form Edit
        
        $('#FormEditIsuStrategis').on('submit', function(e) {
            e.preventDefault();
            
            // Validate Isu Strategis Daerah
            var mode_isu = $('input[name="edit_mode_NamaIsuStrategis"]:checked').val();
            var val_isu = (mode_isu === 'pilih') ? $('#EditNamaIsuStrategisPilih').val() : $('#EditNamaIsuStrategisManual').val();
            if (!val_isu || val_isu.trim() === '') {
                Swal.fire({icon: 'warning', title: 'Peringatan', text: 'Isu Strategis Daerah wajib diisi!'});
                return;
            }

            var formData = $(this).serialize();

            $('#BtnSimpanEdit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateIsuStrategis',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    $('#BtnSimpanEdit').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Terjadi kesalahan saat memperbarui data.'
                        });
                    }
                },
                error: function() {
                    $('#BtnSimpanEdit').prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan pada server.'
                    });
                }
            });
        });

        // Hapus Isu Strategis
        $(document).on('click', '.HapusIsuStrategis', function() {
            var id = $(this).data('id');
            if (!id) return;

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data Isu Strategis Daerah ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: BaseURL + 'Daerah/DeleteIsuStrategis',
                        type: 'POST',
                        data: { Id: id },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message || 'Gagal menghapus data.'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan pada server saat menghapus data.'
                            });
                        }
                    });
                }
            });
        });

    });
</script>