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

if (!function_exists('fmtIkdVal')) {
    function fmtIkdVal($v) {
        if ($v === null || $v === '') return '-';
        $str = trim((string)$v);
        if ($str === '' || $str === '-') return '-';
        $clean = str_replace(',', '.', $str);
        if (is_numeric($clean)) {
            $formatted = (string)(float)$clean;
            return str_replace('.', ',', $formatted);
        }
        return html_escape($str);
    }
}
?>
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* ============================================================
   STYLING MODERN & ELEGAN - IKD TAHUN BERJALAN (4 BAGIAN RPJMD)
   ============================================================ */

/* Card Wrapper Tabel */
.data-table-list {
    border-radius: 14px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
    border: 1px solid #f1f5f9;
    overflow: hidden;
    background: #ffffff;
    padding: 24px !important;
    margin-bottom: 25px;
}

/* Toolbar Dropdown Tahun Berjalan */
.toolbar-tahun-wrapper {
    background: #ffffff;
    border-radius: 14px;
    padding: 18px 22px;
    margin-bottom: 24px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    border: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}
.toolbar-left {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
.filter-tahun-label {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    display: inline-flex;
    align-items: center;
    gap: 7px;
}
.filter-tahun-select {
    width: 160px !important;
    height: 40px !important;
    padding: 6px 14px !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #0f172a !important;
    background-color: #ffffff !important;
    border: 2px solid #00c292 !important;
    border-radius: 8px !important;
    box-shadow: 0 2px 6px rgba(0, 194, 146, 0.15) !important;
    cursor: pointer;
    outline: none !important;
    transition: all 0.2s ease;
}
.filter-tahun-select:focus {
    box-shadow: 0 0 0 4px rgba(0, 194, 146, 0.22) !important;
}
.badge-tahun-active {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #00c292, #00a87e);
    color: #ffffff;
    font-size: 12px;
    font-weight: 600;
    padding: 7px 14px;
    border-radius: 20px;
    box-shadow: 0 2px 6px rgba(0, 194, 146, 0.25);
}
.badge-wilayah-info {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f1f5f9;
    color: #334155;
    font-size: 12px;
    font-weight: 600;
    padding: 7px 12px;
    border-radius: 20px;
    border: 1px solid #cbd5e1;
}
.btn-nav-rpjmd {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #f0fdf4;
    color: #15803d;
    border: 1.5px solid #86efac;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none !important;
    transition: all 0.2s ease;
}
.btn-nav-rpjmd:hover {
    background: #dcfce7;
    color: #166534;
    border-color: #4ade80;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.06);
}

/* 4 Counter Cards (Hitungan per Aspek) */
.ikd-counter-row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
    margin-bottom: 22px;
}
.ikd-counter-col {
    display: flex;
    padding-left: 10px;
    padding-right: 10px;
    margin-bottom: 15px;
}
.ikd-counter-box {
    background: #fff;
    border-radius: 14px !important;
    padding: 18px 20px;
    margin-bottom: 0;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    border-left: 5px solid #00c292;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    min-height: 98px;
    transition: all 0.25s ease;
}
.ikd-counter-box:hover {
    box-shadow: 0 8px 22px rgba(0,0,0,0.09);
    transform: translateY(-2px);
}
.ikd-counter-box.card-geografi { border-left-color: #00c292; }
.ikd-counter-box.card-kesejahteraan { border-left-color: #fb9678; }
.ikd-counter-box.card-dayasaing { border-left-color: #03a9f3; }
.ikd-counter-box.card-pelayanan { border-left-color: #ab8ce4; }

.ikd-counter-box .counter-info {
    flex: 1;
    min-width: 0;
    padding-right: 10px;
}
.ikd-counter-box .counter-info h4 {
    margin: 0 0 4px 0;
    font-size: 22px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.2;
}
.ikd-counter-box .counter-info p {
    margin: 0;
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    line-height: 1.35;
    word-break: break-word;
}
.ikd-counter-box .counter-icon {
    font-size: 28px;
    opacity: 0.35;
    flex-shrink: 0;
}
.ikd-counter-box.card-geografi .counter-icon { color: #00c292; }
.ikd-counter-box.card-kesejahteraan .counter-icon { color: #fb9678; }
.ikd-counter-box.card-dayasaing .counter-icon { color: #03a9f3; }
.ikd-counter-box.card-pelayanan .counter-icon { color: #ab8ce4; }

/* Header Aspek */
.aspek-header-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    padding-bottom: 14px;
    margin-bottom: 15px;
    border-bottom: 2px solid #f1f5f9;
}
.aspek-title {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 8px;
}
.aspek-title .badge-aspek {
    font-size: 10px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 4px;
    line-height: 1.2;
    color: #fff;
    display: inline-block;
}
.badge-geografi { background-color: #00c292; }
.badge-kesejahteraan { background-color: #fb9678; }
.badge-dayasaing { background-color: #03a9f3; }
.badge-pelayanan { background-color: #ab8ce4; }

/* Header & Cell Tabel */
table.dataTable thead th,
table.dataTable thead td,
.table-ikd-aspek thead th,
.table thead th {
    background-color: #f8fafc;
    color: #334155;
    font-weight: 600;
    text-align: center;
    vertical-align: middle !important;
    border-bottom: 2px solid #e2e8f0 !important;
    padding: 12px 8px !important;
    line-height: 1.4 !important;
    background-image: none !important;
    cursor: default !important;
}
.table-ikd-aspek tbody td {
    vertical-align: middle;
    padding: 10px 8px;
}

/* Tombol Aksi */
.btn-action-ikd {
    width: 26px !important;
    height: 26px !important;
    padding: 0 !important;
    font-size: 11px !important;
    line-height: 26px !important;
    border-radius: 6px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 1px !important;
    transition: all 0.2s ease;
    border: none !important;
}
.btn-action-ikd:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 7px rgba(0,0,0,0.15);
}

/* Badges Target & Rumus */
.rumus-tag-wrapper {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-left: 3px solid #03a9f3;
    border-radius: 6px;
    padding: 6px 10px;
    font-size: 12px;
    color: #334155;
    line-height: 1.4;
    display: inline-flex;
    align-items: flex-start;
    gap: 7px;
    max-width: 100%;
    word-break: break-word;
}
.definisi-text-wrapper {
    font-size: 12px;
    color: #334155;
    line-height: 1.45;
    word-break: break-word;
}
.rumus-badge-icon {
    color: #03a9f3;
    font-size: 12px;
    margin-top: 2px;
    flex-shrink: 0;
}

.target-badge-rpjmd {
    display: inline-block;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 700;
    color: #1e293b;
    background-color: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
}
.target-badge-berjalan {
    display: inline-block;
    padding: 4px 12px;
    font-size: 12.5px;
    font-weight: 700;
    color: #ffffff;
    background: linear-gradient(135deg, #00c292, #00a87e);
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 194, 146, 0.25);
}
.target-badge-custom {
    background: linear-gradient(135deg, #0284c7, #0369a1) !important;
    box-shadow: 0 2px 5px rgba(2, 132, 199, 0.25) !important;
}

.tag-auto-rpjmd {
    display: block;
    font-size: 10px;
    color: #64748b;
    margin-top: 3px;
    font-weight: 500;
}
.tag-custom-tb {
    display: block;
    font-size: 10px;
    color: #0284c7;
    margin-top: 3px;
    font-weight: 700;
}

/* Hilangkan Icon Panah Sort pada DataTables */
table.dataTable thead th,
table.dataTable thead td,
.table-ikd-aspek thead th,
table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc {
    background-image: none !important;
    cursor: default !important;
}

/* Pagination & Search DataTables */
.dataTables_wrapper .dataTables_paginate .paginate_button.previous:before,
.dataTables_wrapper .dataTables_paginate .paginate_button.next:before {
    display: none !important;
    content: "" !important;
}
.dataTables_wrapper .dataTables_paginate {
    margin-top: 20px !important;
    padding-top: 6px !important;
    float: right;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    min-width: 28px !important;
    height: 28px !important;
    line-height: 26px !important;
    padding: 0 6px !important;
    text-align: center !important;
    font-size: 12px !important;
    border-radius: 6px !important;
    background: #f1f5f9 !important;
    color: #475569 !important;
    border: 1px solid #e2e8f0 !important;
    margin: 0 2px !important;
    display: inline-block !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #00c292 !important;
    border-color: #00c292 !important;
    color: #ffffff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #00c292 !important;
    border-color: #00c292 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
}
.dataTables_wrapper .dataTables_info {
    font-size: 12px !important;
    margin-top: 20px !important;
    padding-top: 8px !important;
    float: left;
    color: #64748b;
}
.dataTables_filter label:after,
.dataTables_filter label::after,
.dataTables_wrapper .dataTables_filter label:after,
.dataTables_wrapper .dataTables_filter label::after {
    display: none !important;
    content: none !important;
}
.dataTables_wrapper .dataTables_filter {
    float: right;
    text-align: right;
    margin-bottom: 14px;
}
.dataTables_wrapper .dataTables_filter input {
    height: 36px;
    padding: 6px 14px !important;
    font-size: 13px;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    outline: none;
    background-color: #ffffff !important;
    background-image: none !important;
    transition: all 0.2s ease;
    min-width: 210px;
}
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #00c292;
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
}
.dataTables_wrapper .dataTables_length {
    float: left;
    margin-bottom: 14px;
}
.dataTables_wrapper .dataTables_length select {
    height: 36px;
    padding: 4px 10px;
    font-size: 13px;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    background-color: #ffffff;
    cursor: pointer;
}

/* Modal Dialog Edit Target */
.modal-target-dialog {
    width: 92%;
    max-width: 600px;
    margin: 40px auto !important;
}
.modal-target-content {
    border-radius: 14px;
    border: none;
    box-shadow: 0 20px 45px rgba(0,0,0,0.22);
    overflow: hidden;
}
.modal-target-header {
    background: #ffffff;
    padding: 18px 22px;
    border-bottom: 1px solid #eef2f6;
    position: relative;
}
.modal-target-title {
    color: #1e293b;
    font-size: 16px;
    font-weight: 700;
    margin: 0;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}
.modal-target-title-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: rgba(0, 194, 146, 0.12);
    color: #00c292;
    font-size: 15px;
}
.modal-target-body {
    padding: 22px;
    background-color: #ffffff;
}
.form-label-target {
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    margin-bottom: 6px;
    display: block;
}
.form-control-target {
    border: 1.5px solid #cbd5e1;
    border-radius: 8px;
    padding: 9px 12px;
    font-size: 14px;
    color: #0f172a;
    font-weight: 600;
    background-color: #fff;
    width: 100%;
    transition: all 0.2s;
}
.form-control-target:focus {
    border-color: #00c292;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
}
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <!-- ============================================================
                    FILTER WILAYAH - HANYA UNTUK USER YANG BELUM LOGIN
                    ============================================================ -->
                    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div class="data-table-list" style="margin-bottom: 20px; padding: 18px 24px !important;">
                            <div class="form-example-wrap">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi" style="font-weight: 600; margin-bottom: 4px;">Provinsi</label>
                                                    <select class="form-control" id="Provinsi" style="height: 38px; border-radius: 6px;">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>">
                                                                <?= html_escape($prov['Nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="KabKota" style="font-weight: 600; margin-bottom: 4px;">Kab/Kota</label>
                                                    <select class="form-control" id="KabKota" style="height: 38px; border-radius: 6px;">
                                                        <option value="">Pilih Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4">
                                                <div class="filter-group" style="margin-top: 24px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter" style="height: 38px; border-radius: 6px; font-weight: 700;">
                                                        Filter Wilayah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- ============================================================
                    TOOLBAR ATAS: DROPDOWN TAHUN BERJALAN & STATUS
                    ============================================================ -->
                    <div class="toolbar-tahun-wrapper">
                        <div class="toolbar-left">
                            <label for="FilterTahun" class="filter-tahun-label">
                                <i class="fa fa-calendar-check-o text-success" style="font-size: 16px;"></i>
                                Tahun Berjalan:
                            </label>
                            <select id="FilterTahun" class="filter-tahun-select" title="Pilih Tahun Berjalan yang Sedang Dikerjakan">
                                <?php foreach ($ListTahun as $th) { ?>
                                    <option value="<?= html_escape($th) ?>" <?= ($th == $SelectedTahun) ? 'selected' : '' ?>>
                                        Tahun <?= html_escape($th) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <span class="badge-tahun-active">
                                <i class="fa fa-pencil-square-o"></i> Sedang Mengerjakan Tahun <?= html_escape($SelectedTahun) ?>
                            </span>
                        </div>
                    </div>

                    <!-- ============================================================
                    COUNTER CARDS: HITUNGAN PER ASPEK (4 BAGIAN SEPERTI RPJMD)
                    ============================================================ -->
                    <div class="row ikd-counter-row">
                        <?php foreach ($AspekDef as $key => $asp) { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 ikd-counter-col">
                                <div class="ikd-counter-box <?= $asp['cardClass'] ?>">
                                    <div class="counter-info">
                                        <h4><?= count($asp['items']) ?></h4>
                                        <p><?= $asp['code'] ?>. <?= html_escape($asp['name']) ?></p>
                                    </div>
                                    <div class="counter-icon">
                                        <i class="fa <?= $asp['icon'] ?>"></i>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if (empty($KodeWilayah)) { ?>
                        <div class="alert alert-warning" style="border-radius: 10px;">
                            <i class="fa fa-exclamation-triangle"></i> Silakan pilih wilayah terlebih dahulu untuk melihat data IKD Tahun Berjalan.
                        </div>
                    <?php } elseif ($TotalIndikator == 0) { ?>
                        <div class="alert alert-info" style="border-radius: 10px; padding: 20px;">
                            <h4><i class="fa fa-info-circle"></i> Belum Ada Data IKD RPJMD</h4>
                            <p style="margin-bottom: 12px;">Data IKD Tahun Berjalan ditarik otomatis dari <b>IKD RPJMD</b>. Saat ini belum ada data IKD pada RPJMD wilayah ini.</p>
                        </div>
                    <?php } ?>

                    <!-- ============================================================
                    TABEL DATA: 4 BAGIAN PER ASPEK (SEPERTI IKD RPJMD)
                    ============================================================ -->
                    <?php foreach ($AspekDef as $key => $asp) { ?>
                        <div class="data-table-list" id="card-aspek-<?= $key ?>">
                            <div class="aspek-header-wrap">
                                <h3 class="aspek-title">
                                    <span class="badge-aspek <?= $asp['badgeClass'] ?>"><?= $asp['code'] ?></span>
                                    <?= html_escape($asp['name']) ?>
                                    <span class="label label-default" style="font-size: 11px; margin-left: 6px; border-radius: 4px; background: #e2e8f0; color: #334155;">
                                        <?= count($asp['items']) ?> Indikator
                                    </span>
                                </h3>

                                <div style="font-size: 12px; color: #64748b; font-weight: 600;">
                                    <i class="fa fa-calendar text-success"></i> Periode Target: Tahun <?= html_escape($SelectedTahun) ?>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-ikd-aspek table-data-aspek" id="table-aspek-<?= $key ?>">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 4%; vertical-align: middle !important;">No</th>
                                            <th style="width: 45%; text-align: left; vertical-align: middle !important;">Indikator Sasaran (IKD)</th>
                                            <th class="text-center" style="width: 10%; vertical-align: middle !important;">Satuan</th>
                                            <th class="text-center" style="width: 12%; vertical-align: middle !important;">Target <br><small><?= html_escape($SelectedTahun) ?></small></th>
                                            <th style="width: 23%; text-align: left; vertical-align: middle !important;">Perangkat Daerah Pengampu</th>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <th class="text-center" style="width: 6%; vertical-align: middle !important;">Aksi</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($asp['items'])) { ?>
                                            <?php $noAspek = 1; foreach ($asp['items'] as $row) { ?>
                                                <tr id="row-ikd-<?= $row['id'] ?>">
                                                    <td class="text-center"><?= $noAspek++ ?></td>
                                                    <td style="font-weight: 600; color: #1e293b;">
                                                        <?= html_escape($row['indikator_sasaran']) ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge" style="background-color: #f1f5f9; color: #475569; font-weight: normal; border: 1px solid #e2e8f0;">
                                                            <?= !empty($row['satuan']) ? html_escape($row['satuan']) : '-' ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center" style="font-weight: 600; color: #1e293b;">
                                                        <?= fmtIkdVal($row['target_berjalan']) ?>
                                                    </td>
                                                    <td style="font-size: 12px; color: #4b5563;">
                                                        <?= !empty($row['pd_penanggung_jawab']) ? html_escape($row['pd_penanggung_jawab']) : '<em class="text-muted">Belum ditentukan</em>' ?>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-warning btn-action-ikd BtnEditTarget" 
                                                                    style="background-color: #f59e0b !important; color: #ffffff !important;"
                                                                    data-id="<?= $row['id'] ?>"
                                                                    data-aspek="<?= html_escape($row['aspek'] ?? $key) ?>"
                                                                    data-nama="<?= html_escape($row['indikator_sasaran']) ?>"
                                                                    data-satuan="<?= html_escape($row['satuan'] ?? '-') ?>"
                                                                    data-opd="<?= html_escape($row['pd_penanggung_jawab'] ?? '-') ?>"
                                                                    data-target-rpjmd="<?= html_escape(fmtIkdVal($row['target_rpjmd_tahun'])) ?>"
                                                                    data-target-berjalan="<?= html_escape(str_replace('.', ',', (string)$row['target_berjalan'])) ?>"
                                                                    data-is-custom="<?= $row['is_custom'] ? '1' : '0' ?>"
                                                                    data-tahun="<?= html_escape($SelectedTahun) ?>"
                                                                    title="Sesuaikan Target Tahun <?= html_escape($SelectedTahun) ?>">
                                                                <i class="notika-icon notika-edit"></i>
                                                            </button>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL SESUAIKAN TARGET IKD TAHUN BERJALAN
============================================================ -->
<div class="modal fade" id="ModalEditTarget" role="dialog">
    <div class="modal-dialog modal-target-dialog">
        <div class="modal-content modal-target-content">
            <div class="modal-header modal-target-header">
                <button type="button" class="close" data-dismiss="modal" title="Tutup">&times;</button>
                <h4 class="modal-target-title">
                    <span class="modal-target-title-icon"><i class="fa fa-sliders"></i></span>
                    Sesuaikan Target IKD Tahun Berjalan (<span id="ModalTahunLabel"><?= html_escape($SelectedTahun) ?></span>)
                </h4>
            </div>
            <div class="modal-body modal-target-body">
                <form id="FormEditTarget">
                    <input type="hidden" id="ModalIKDId" name="ikd_id">
                    <input type="hidden" id="ModalTahun" name="tahun" value="<?= html_escape($SelectedTahun) ?>">

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px; margin-bottom: 18px;">
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Indikator Kinerja Daerah (IKD):</div>
                        <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 3px;" id="ModalIndikatorNama">-</div>
                        
                        <div style="display: flex; gap: 12px; margin-top: 8px; font-size: 12px; color: #475569;">
                            <div><i class="fa fa-tag text-muted"></i> Satuan: <b id="ModalSatuanLabel">-</b></div>
                            <div><i class="fa fa-building text-muted"></i> OPD: <b id="ModalOpdLabel">-</b></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label-target">Target <span class="ModalTahunText"><?= html_escape($SelectedTahun) ?></span> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-target" id="ModalTargetBerjalan" name="target" placeholder="Contoh: 75,5 atau 80%" required>
                        <input type="hidden" id="ModalTargetRpjmd">
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 22px; padding-top: 15px; border-top: 1px solid #eef2f6;">
                        <div>
                            <button type="button" class="btn btn-default" id="BtnResetTarget" style="font-size: 12px; border-radius: 6px; color: #dc2626; border-color: #fca5a5; display: none;">
                                <i class="fa fa-undo"></i> Kembalikan ke Target RPJMD
                            </button>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                            <button type="submit" class="btn btn-success notika-btn-success" id="BtnSimpanTarget" style="border-radius: 6px; font-weight: 700;">
                                <i class="fa fa-save"></i> Simpan Target
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';
var SelectedTahun = '<?= $SelectedTahun ?>';

jQuery(document).ready(function($) {

    // ============================================================
    // DROPDOWN FILTER TAHUN BERJALAN
    // ============================================================
    $('#FilterTahun').on('change', function() {
        var tahunDipilih = $(this).val();
        if (tahunDipilih && tahunDipilih !== SelectedTahun) {
            window.location.href = BaseURL + 'Daerah/IKDTahunBerjalan?tahun=' + tahunDipilih;
        }
    });

    // ============================================================
    // INISIALISASI DATATABLES PADA SETIAP ASPEK
    // ============================================================
    $('.table-data-aspek').each(function() {
        var table = $(this);
        table.DataTable({
            "ordering": false,
            "pageLength": 10,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
            "language": {
                "search": "",
                "searchPlaceholder": "Cari indikator...",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ indikator",
                "infoEmpty": "Menampilkan 0 dari 0 indikator",
                "infoFiltered": "(disaring dari _MAX_ total indikator)",
                "zeroRecords": "Tidak ada indikator yang sesuai",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left"></i>',
                    "last": '<i class="fa fa-angle-double-right"></i>',
                    "next": '<i class="fa fa-angle-right"></i>',
                    "previous": '<i class="fa fa-angle-left"></i>'
                }
            }
        });
    });

    // ============================================================
    // FILTER PROVINSI & KAB/KOTA (UNTUK YANG BELUM LOGIN)
    // ============================================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
        $("#Provinsi").change(function() {
            var provKode = $(this).val();
            if (provKode === "") {
                $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                return;
            }
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: provKode, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $("#KabKota").prop('disabled', true); },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var opt = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                opt += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                            }
                        }
                        $("#KabKota").html(opt).prop('disabled', false);
                    } catch (e) {
                        alert("Gagal memuat data Kab/Kota");
                        $("#KabKota").prop('disabled', false);
                    }
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                    $("#KabKota").prop('disabled', false);
                }
            });
        });

        $("#Filter").click(function() {
            if ($("#Provinsi").val() === "") {
                alert("Mohon Pilih Provinsi");
                return;
            }
            if ($("#KabKota").val() === "") {
                alert("Mohon Pilih Kab/Kota");
                return;
            }
            var kodeWilayah = $("#KabKota").val();
            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: { KodeWilayah: kodeWilayah, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                success: function(Respon) {
                    try {
                        if (Respon === 'success' || Respon.trim() === 'success') {
                            window.location.href = BaseURL + "Daerah/IKDTahunBerjalan";
                        } else {
                            alert(Respon || "Gagal menyimpan filter wilayah!");
                            $("#Filter").prop('disabled', false).text('Filter Wilayah');
                        }
                    } catch (e) {
                        alert("Gagal memproses respons server!");
                        $("#Filter").prop('disabled', false).text('Filter Wilayah');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
                    $("#Filter").prop('disabled', false).text('Filter Wilayah');
                }
            });
        });
    <?php } ?>

    // ============================================================
    // BUKA MODAL SESUAIKAN TARGET TAHUN BERJALAN
    // ============================================================
    $(document).on('click', '.BtnEditTarget', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var satuan = $(this).data('satuan');
        var opd = $(this).data('opd');
        var targetRpjmd = $(this).data('target-rpjmd');
        var targetBerjalan = $(this).data('target-berjalan');
        var isCustom = $(this).data('is-custom') == '1';
        var tahun = $(this).data('tahun');

        $('#ModalIKDId').val(id);
        $('#ModalTahun').val(tahun);
        $('#ModalTahunLabel').text(tahun);
        $('.ModalTahunText').text(tahun);
        $('#ModalIndikatorNama').text(nama);
        $('#ModalSatuanLabel').text(satuan || '-');
        $('#ModalOpdLabel').text(opd || '-');
        $('#ModalTargetRpjmd').val(targetRpjmd);
        $('#ModalTargetBerjalan').val(targetBerjalan);

        if (isCustom) {
            $('#BtnResetTarget').show();
        } else {
            $('#BtnResetTarget').hide();
        }

        $('#ModalEditTarget').modal('show');
    });

    // ============================================================
    // SIMPAN TARGET TAHUN BERJALAN (AJAX)
    // ============================================================
    $('#FormEditTarget').on('submit', function(e) {
        e.preventDefault();

        var ikdId = $('#ModalIKDId').val();
        var indikator = $('#ModalIndikatorNama').text().trim();
        var target = $('#ModalTargetBerjalan').val().trim();
        var tahun = $('#ModalTahun').val();

        if (target === '') {
            alert('Target tidak boleh kosong!');
            return;
        }

        var btn = $('#BtnSimpanTarget');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/SimpanTargetIKDTahunBerjalan',
            type: 'POST',
            data: {
                ikd_id: ikdId,
                indikator: indikator,
                target: target,
                tahun: tahun,
                action: 'save',
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(resp) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Target');
                if (resp.status === 'success') {
                    $('#ModalEditTarget').modal('hide');
                    // Update tampilan baris langsung & reload untuk konsistensi
                    location.reload();
                } else {
                    alert('Gagal: ' + (resp.message || 'Terjadi kesalahan!'));
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Target');
                alert('Gagal menghubungi server!');
            }
        });
    });

    // ============================================================
    // RESET TARGET KE RPJMD (AJAX)
    // ============================================================
    $('#BtnResetTarget').on('click', function() {
        if (!confirm('Apakah Anda yakin ingin mengembalikan Target Tahun Berjalan ke nilai Baseline RPJMD?')) {
            return;
        }

        var ikdId = $('#ModalIKDId').val();
        var tahun = $('#ModalTahun').val();
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengembalikan...');

        $.ajax({
            url: BaseURL + 'Daerah/SimpanTargetIKDTahunBerjalan',
            type: 'POST',
            data: {
                ikd_id: ikdId,
                tahun: tahun,
                action: 'reset',
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: 'json',
            success: function(resp) {
                btn.prop('disabled', false).html('<i class="fa fa-undo"></i> Kembalikan ke Target RPJMD');
                if (resp.status === 'success') {
                    $('#ModalEditTarget').modal('hide');
                    location.reload();
                } else {
                    alert('Gagal: ' + (resp.message || 'Terjadi kesalahan!'));
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fa fa-undo"></i> Kembalikan ke Target RPJMD');
                alert('Gagal menghubungi server!');
            }
        });
    });

});
</script>