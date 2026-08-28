<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* Styling Card Modern Curve untuk Tabel dan Data IKD */
.data-table-list {
    border-radius: 14px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
    border: 1px solid #f1f5f9;
    overflow: hidden;
    background: #ffffff;
    padding: 24px !important;
}

/* Card Counter IKD Curve & Ukuran Seragam (Equal Height & Width) */
.ikd-counter-row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
}
.ikd-counter-col {
    display: flex;
    padding-left: 10px;
    padding-right: 10px;
    margin-bottom: 22px;
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
    min-height: 100px;
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
    font-size: 20px;
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
    padding: 2px 7px;
    border-radius: 4px;
    line-height: 1.2;
    color: #fff;
    display: inline-block;
}
.badge-geografi { background-color: #00c292; }
.badge-kesejahteraan { background-color: #fb9678; }
.badge-dayasaing { background-color: #03a9f3; }
.badge-pelayanan { background-color: #ab8ce4; }

/* Posisi Teks Header Tabel Berada Presisi di Tengah (Vertikal) */
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

/* Ukuran Compact Button Aksi pada Tabel IKD */
.btn-action-ikd {
    width: 24px !important;
    height: 24px !important;
    padding: 0 !important;
    font-size: 10px !important;
    line-height: 24px !important;
    border-radius: 5px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 1px !important;
    transition: all 0.2s ease;
    border: none !important;
}
.btn-action-ikd i {
    font-size: 11px !important;
    line-height: 1 !important;
    margin: 0 !important;
}
.btn-action-ikd:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
}

/* Hilangkan Icon Panah Sort pada Header Tabel */
table.dataTable thead th,
table.dataTable thead td,
.table-ikd-aspek thead th,
table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc,
table.dataTable thead .sorting_asc_disabled,
table.dataTable thead .sorting_desc_disabled {
    background-image: none !important;
    cursor: default !important;
}

/* Hilangkan Icon Panah Pseudo Bawaan Notika pada Pagination */
.dataTables_wrapper .dataTables_paginate .paginate_button.previous:before,
.dataTables_wrapper .dataTables_paginate .paginate_button.next:before {
    display: none !important;
    content: "" !important;
}

/* Styling Bersih & Rapi untuk Tombol Penomoran Halaman */
.dataTables_wrapper .dataTables_paginate {
    margin-top: 25px !important;
    padding-top: 8px !important;
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
    vertical-align: middle !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    box-shadow: none !important;
    box-sizing: border-box !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #00c292 !important;
    border-color: #00c292 !important;
    color: #ffffff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:focus {
    background: #00c292 !important;
    border-color: #00c292 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    opacity: 0.4 !important;
    cursor: not-allowed !important;
    background: #f8fafc !important;
    border-color: #e2e8f0 !important;
    color: #94a3b8 !important;
}
.dataTables_wrapper .dataTables_info {
    font-size: 12px !important;
    margin-top: 25px !important;
    padding-top: 12px !important;
    float: left;
    color: #64748b;
}

/* Hilangkan Icon Search Bawaan Notika di Sebelah Kanan */
.dataTables_filter label:after,
.dataTables_filter label::after,
.dataTables_wrapper .dataTables_filter label:after,
.dataTables_wrapper .dataTables_filter label::after {
    display: none !important;
    content: none !important;
}

/* Styling Bersih Kolom Pencarian (Search) di Setiap Aspek */
.dataTables_wrapper .dataTables_filter {
    float: right;
    text-align: right;
    margin-bottom: 15px;
    width: auto !important;
}
.dataTables_wrapper .dataTables_filter label {
    font-weight: normal;
    margin-bottom: 0;
    position: relative;
    display: inline-block;
    width: auto !important;
    font-size: 13px !important;
}
.dataTables_wrapper .dataTables_filter input {
    height: 38px;
    padding: 6px 16px !important;
    font-size: 13px;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    outline: none;
    background-color: #ffffff !important;
    background-image: none !important;
    transition: all 0.25s ease;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
    min-width: 220px;
    margin-left: 0 !important;
}
.dataTables_wrapper .dataTables_filter input:focus {
    min-width: 260px;
    border-color: #00c292;
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
    background-color: #ffffff !important;
    background-image: none !important;
}

/* Styling Dropdown Tampilkan Entri (Length Menu) */
.dataTables_wrapper .dataTables_length {
    float: left;
    margin-bottom: 15px;
}
.dataTables_wrapper .dataTables_length label {
    font-weight: 500;
    font-size: 13px;
    color: #475569;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 0;
}
.dataTables_wrapper .dataTables_length select {
    height: 38px;
    padding: 4px 12px;
    font-size: 13px;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background-color: #ffffff;
    outline: none;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
    margin: 0 4px;
}
.dataTables_wrapper .dataTables_length select:focus {
    border-color: #00c292;
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
}

/* Styling Modal Menarik */
.modal-ikd-dialog {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%) !important;
    width: 92%;
    max-width: 760px;
    margin: 0;
}
.modal-ikd-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    overflow: hidden;
}
.modal-ikd-header {
    background: #ffffff;
    color: #1e293b;
    padding: 18px 24px;
    position: relative;
    width: 100%;
    border-bottom: 1px solid #eef2f6;
}
.modal-ikd-header::before,
.modal-ikd-header::after {
    display: none !important;
}
.modal-ikd-header .modal-title {
    color: #1e293b;
    font-size: 16px;
    font-weight: 700;
    margin: 0;
    float: left !important;
    text-align: left;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    line-height: 32px;
}
.modal-ikd-header .modal-title-icon {
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
.modal-ikd-header .close {
    color: #64748b !important;
    opacity: 0.7 !important;
    font-size: 26px !important;
    font-weight: 300 !important;
    text-shadow: none !important;
    float: right !important;
    margin-top: 1px !important;
    margin-right: 0 !important;
    line-height: 28px !important;
    outline: none !important;
    cursor: pointer;
    transition: all 0.2s;
}
.modal-ikd-header .close:hover {
    color: #0f172a !important;
    opacity: 1 !important;
}
.modal-ikd-body {
    padding: 22px 24px;
    background-color: #ffffff;
}
.aspek-banner-chip {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f8fafc;
    border-left: 4px solid #00c292;
    padding: 10px 14px;
    border-radius: 6px;
    margin-bottom: 18px;
}
.aspek-banner-chip .chip-label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
}
.aspek-banner-chip .chip-value {
    font-size: 13px;
    font-weight: 700;
    color: #0f172a;
}
.form-label-ikd {
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    margin-bottom: 6px;
    display: block;
}
.form-control-ikd {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 9px 12px;
    font-size: 13px;
    color: #1e293b;
    background-color: #fff;
    width: 100%;
    transition: all 0.2s;
    box-shadow: none;
}
.form-control-ikd:focus {
    border-color: #00c292;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.15);
}
.target-grid-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px;
    margin-top: 14px;
}
.target-grid-card .grid-title {
    font-size: 12px;
    font-weight: 700;
    color: #475569;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.target-year-box {
    text-align: center;
}
.target-year-box label {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 4px;
    display: block;
}
.target-year-box .form-control-target {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    background: #fff;
    padding: 7px 4px;
    font-size: 13px;
    font-weight: 600;
    text-align: center;
    color: #0f172a;
    width: 100%;
    transition: all 0.2s;
}
.target-year-box .form-control-target:focus {
    border-color: #00c292;
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 194, 146, 0.2);
}
.modal-ikd-footer {
    background-color: #f8fafc;
    padding: 14px 24px;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
.btn-ikd-modal {
    padding: 8px 18px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    cursor: pointer;
}
.btn-ikd-cancel {
    background: #e2e8f0;
    color: #475569;
}
.btn-ikd-cancel:hover {
    background: #cbd5e1;
    color: #1e293b;
}
.btn-ikd-submit {
    background: #00c292;
    color: #fff;
}
.btn-ikd-submit:hover {
    background: #00a87e;
    color: #fff;
}
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <!-- Filter untuk pengguna yang belum login -->
                    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div class="data-table-list" style="margin-bottom: 20px; padding: 20px;">
                            <div class="form-example-wrap">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                                <?= html_escape($prov['Nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="KabKota"><b>Kab/Kota</b></label>
                                                    <select class="form-control filter-select" id="KabKota">
                                                        <option value="">Pilih Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menampilkan Wilayah dan Pesan setelah filter -->
                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php 
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert <?= empty($Ikd) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 0; margin-top: 15px; border-radius: 6px;">
                                    <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                    <?php if (empty($Ikd)) { ?>
                                        <strong>Peringatan:</strong> Tidak ada data IKD untuk wilayah ini.
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php
                    // Pengelompokan Data & Hitungan per Aspek
                    $aspekDef = [
                        'geografi' => [
                            'code' => 'I',
                            'name' => 'ASPEK GEOGRAFI DAN DEMOGRAFI',
                            'cardClass' => 'card-geografi',
                            'badgeClass' => 'badge-geografi',
                            'icon' => 'fa-globe',
                            'items' => []
                        ],
                        'kesejahteraan' => [
                            'code' => 'II',
                            'name' => 'ASPEK KESEJAHTERAAN MASYARAKAT',
                            'cardClass' => 'card-kesejahteraan',
                            'badgeClass' => 'badge-kesejahteraan',
                            'icon' => 'fa-heartbeat',
                            'items' => []
                        ],
                        'dayasaing' => [
                            'code' => 'III',
                            'name' => 'ASPEK DAYA SAING',
                            'cardClass' => 'card-dayasaing',
                            'badgeClass' => 'badge-dayasaing',
                            'icon' => 'fa-line-chart',
                            'items' => []
                        ],
                        'pelayanan' => [
                            'code' => 'IV',
                            'name' => 'ASPEK PELAYANAN UMUM',
                            'cardClass' => 'card-pelayanan',
                            'badgeClass' => 'badge-pelayanan',
                            'icon' => 'fa-building',
                            'items' => []
                        ]
                    ];

                    foreach ($Ikd as $item) {
                        $asp = !empty($item['aspek']) ? strtolower($item['aspek']) : 'geografi';
                        if (isset($aspekDef[$asp])) {
                            $aspekDef[$asp]['items'][] = $item;
                        } else {
                            $aspekDef['geografi']['items'][] = $item;
                        }
                    }

                    function fmtIkdVal($v) {
                        if ($v === null || $v === '') return '-';
                        if (is_numeric($v)) return number_format((float)$v, 2, '.', '');
                        return html_escape(str_replace(',', '.', $v));
                    }
                    ?>

                    <!-- ============================================================
                    SUMMARY / COUNTER CARDS (HITUNGAN PER ASPEK)
                    ============================================================ -->
                    <div class="row ikd-counter-row">
                        <?php foreach ($aspekDef as $key => $asp) { ?>
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

                    <!-- ============================================================
                    TABEL DATA DIPISAHKAN PER ASPEK
                    ============================================================ -->
                    <?php foreach ($aspekDef as $key => $asp) { ?>
                        <div class="data-table-list" style="margin-bottom: 25px;">
                            <div class="aspek-header-wrap">
                                <h3 class="aspek-title">
                                    <span class="badge-aspek <?= $asp['badgeClass'] ?>"><?= $asp['code'] ?></span>
                                    <?= html_escape($asp['name']) ?>
                                    <span class="label label-default" style="font-size: 11px; margin-left: 5px; border-radius: 4px;"><?= count($asp['items']) ?> Indikator</span>
                                </h3>

                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success btn-sm BtnTambahPerAspek" data-aspek="<?= $key ?>" data-aspek-name="<?= html_escape($asp['name']) ?>">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Indikator</b>
                                    </button>
                                <?php } ?>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-ikd-aspek table-data-aspek" id="table-aspek-<?= $key ?>">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 4%; vertical-align: middle !important;">No</th>
                                            <th style="width: 25%; text-align: left; vertical-align: middle !important;">Indikator Sasaran (IKD)</th>
                                            <th class="text-center" style="width: 7%; vertical-align: middle !important;">Satuan</th>
                                            <th class="text-center" style="width: 7%; vertical-align: middle !important;">Target <br><small>2025</small></th>
                                            <th class="text-center" style="width: 7%; vertical-align: middle !important;">Target <br><small>2026</small></th>
                                            <th class="text-center" style="width: 7%; vertical-align: middle !important;">Target <br><small>2027</small></th>
                                            <th class="text-center" style="width: 7%; vertical-align: middle !important;">Target <br><small>2028</small></th>
                                            <th class="text-center" style="width: 7%; vertical-align: middle !important;">Target <br><small>2029</small></th>
                                            <th class="text-center" style="width: 7%; vertical-align: middle !important;">Target <br><small>2030</small></th>
                                            <th style="width: 14%; text-align: left; vertical-align: middle !important;">Perangkat Daerah Pengampu</th>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <th class="text-center" style="width: 8%; vertical-align: middle !important;">Aksi</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($asp['items'])) { ?>
                                            <?php $noAspek = 1; foreach ($asp['items'] as $row) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $noAspek++ ?></td>
                                                    <td style="font-weight: 600;">
                                                        <?= html_escape($row['indikator_sasaran']) ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge" style="background-color: #f1f5f9; color: #475569; font-weight: normal;">
                                                            <?= !empty($row['satuan']) ? html_escape($row['satuan']) : '-' ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center"><?= fmtIkdVal($row['target_1'] ?? $row['target_2025'] ?? null) ?></td>
                                                    <td class="text-center"><?= fmtIkdVal($row['target_2'] ?? $row['target_2026'] ?? null) ?></td>
                                                    <td class="text-center"><?= fmtIkdVal($row['target_3'] ?? $row['target_2027'] ?? null) ?></td>
                                                    <td class="text-center"><?= fmtIkdVal($row['target_4'] ?? $row['target_2028'] ?? null) ?></td>
                                                    <td class="text-center"><?= fmtIkdVal($row['target_5'] ?? $row['target_2029'] ?? null) ?></td>
                                                    <td class="text-center"><?= fmtIkdVal($row['target_6'] ?? $row['target_2030'] ?? null) ?></td>
                                                    <td style="font-size: 12px; color: #4b5563;">
                                                        <?= !empty($row['pd_penanggung_jawab']) ? html_escape($row['pd_penanggung_jawab']) : '<em class="text-muted">Belum ditentukan</em>' ?>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <td class="text-center" style="white-space: nowrap;">
                                                            <div style="display: inline-flex; gap: 4px; justify-content: center; align-items: center;">
                                                                <button type="button" class="btn btn-warning btn-action-ikd BtnEditIKD" 
                                                                        style="background-color: #f59e0b !important; color: #ffffff !important;"
                                                                        data-id="<?= $row['id'] ?>"
                                                                        data-aspek="<?= html_escape($row['aspek'] ?? $key) ?>"
                                                                        data-nama="<?= html_escape($row['indikator_sasaran']) ?>"
                                                                        data-satuan="<?= html_escape($row['satuan'] ?? '') ?>"
                                                                        data-opd="<?= html_escape($row['pd_penanggung_jawab'] ?? '') ?>"
                                                                        data-t1="<?= html_escape($row['target_1'] ?? $row['target_2025'] ?? '') ?>"
                                                                        data-t2="<?= html_escape($row['target_2'] ?? $row['target_2026'] ?? '') ?>"
                                                                        data-t3="<?= html_escape($row['target_3'] ?? $row['target_2027'] ?? '') ?>"
                                                                        data-t4="<?= html_escape($row['target_4'] ?? $row['target_2028'] ?? '') ?>"
                                                                        data-t5="<?= html_escape($row['target_5'] ?? $row['target_2029'] ?? '') ?>"
                                                                        data-t6="<?= html_escape($row['target_6'] ?? $row['target_2030'] ?? '') ?>"
                                                                        title="Edit Indikator">
                                                                    <i class="notika-icon notika-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-action-ikd BtnHapusIKD" 
                                                                        style="background-color: #ef4444 !important; color: #ffffff !important;"
                                                                        data-id="<?= $row['id'] ?>"
                                                                        data-nama="<?= html_escape($row['indikator_sasaran']) ?>"
                                                                        title="Hapus Indikator">
                                                                    <i class="notika-icon notika-trash"></i>
                                                                </button>
                                                            </div>
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
MODAL TAMBAH IKD (DESAIN MENARIK & MODERN)
============================================================ -->
<div class="modal fade" id="ModalInputIKD" role="dialog">
    <div class="modal-dialog modal-ikd-dialog">
        <div class="modal-content modal-ikd-content">
            <div class="modal-header modal-ikd-header">
                <button type="button" class="close" data-dismiss="modal" title="Tutup">&times;</button>
                <h4 class="modal-title">
                    <span class="modal-title-icon"><i class="fa fa-plus"></i></span>
                    Tambah Indikator Kinerja Daerah (IKD)
                </h4>
                <div style="clear: both;"></div>
            </div>
            <div class="modal-body modal-ikd-body">
                <form id="FormTambahIKD">
                    <input type="hidden" name="aspek" id="TambahAspek" value="geografi">
                    
                    <div class="aspek-banner-chip" id="TambahAspekChip">
                        <span class="chip-label"><i class="fa fa-folder-open"></i> Aspek Terpilih:</span>
                        <span class="chip-value" id="TambahAspekLabel">I. ASPEK GEOGRAFI DAN DEMOGRAFI</span>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label-ikd">Nama Indikator Kinerja Daerah <span class="text-danger">*</span></label>
                                <textarea class="form-control-ikd" name="nama" id="TambahNama" rows="3" placeholder="Tuliskan nama indikator secara jelas dan lengkap..." required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label class="form-label-ikd">Satuan Pengukuran</label>
                                        <select class="form-control-ikd" name="satuan" id="TambahSatuan">
                                            <option value="">-- Pilih Satuan --</option>
                                            <option value="Persen">Persen</option>
                                            <option value="Poin">Poin</option>
                                            <option value="Indeks">Indeks</option>
                                            <option value="Rasio">Rasio</option>
                                            <option value="Jiwa">Jiwa</option>
                                            <option value="Orang">Orang</option>
                                            <option value="Km">Km</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Dokumen">Dokumen</option>
                                            <option value="Paket">Paket</option>
                                            <option value="Ha">Ha (Hektar)</option>
                                            <option value="Rp">Rp (Rupiah)</option>
                                            <option value="Nilai">Nilai</option>
                                            <option value="Skor">Skor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="form-group">
                                        <label class="form-label-ikd">Perangkat Daerah Pengampu (OPD)</label>
                                        <select class="form-control-ikd" name="opd" id="TambahOpd">
                                            <option value="">-- Pilih Perangkat Daerah --</option>
                                            <?php if (!empty($Instansi)) { ?>
                                                <?php foreach ($Instansi as $inst) { ?>
                                                    <option value="<?= html_escape($inst['nama']) ?>"><?= html_escape($inst['nama']) ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="target-grid-card">
                                <div class="grid-title"><i class="fa fa-calendar-check-o text-success"></i> Target Kinerja Tahunan (2025 - 2030)</div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2025</label>
                                            <input type="text" class="form-control-target input-target" name="target_1" id="TambahT1" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2026</label>
                                            <input type="text" class="form-control-target input-target" name="target_2" id="TambahT2" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2027</label>
                                            <input type="text" class="form-control-target input-target" name="target_3" id="TambahT3" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2028</label>
                                            <input type="text" class="form-control-target input-target" name="target_4" id="TambahT4" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2029</label>
                                            <input type="text" class="form-control-target input-target" name="target_5" id="TambahT5" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2030</label>
                                            <input type="text" class="form-control-target input-target" name="target_6" id="TambahT6" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-ikd-footer">
                <button type="button" class="btn-ikd-modal btn-ikd-cancel" data-dismiss="modal">Batal</button>
                <button type="button" class="btn-ikd-modal btn-ikd-submit" id="BtnSimpanTambah">
                    <i class="fa fa-check"></i> Simpan Indikator
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT IKD (DESAIN MENARIK & MODERN)
============================================================ -->
<div class="modal fade" id="ModalEditIKD" role="dialog">
    <div class="modal-dialog modal-ikd-dialog">
        <div class="modal-content modal-ikd-content">
            <div class="modal-header modal-ikd-header">
                <button type="button" class="close" data-dismiss="modal" title="Tutup">&times;</button>
                <h4 class="modal-title">
                    <span class="modal-title-icon" style="background: rgba(245, 158, 11, 0.2); color: #f59e0b;"><i class="fa fa-pencil"></i></span>
                    Edit Indikator Kinerja Daerah (IKD)
                </h4>
                <div style="clear: both;"></div>
            </div>
            <div class="modal-body modal-ikd-body">
                <form id="FormEditIKD">
                    <input type="hidden" name="id" id="EditId">
                    <input type="hidden" name="aspek" id="EditAspek">

                    <div class="aspek-banner-chip" id="EditAspekChip">
                        <span class="chip-label"><i class="fa fa-folder-open"></i> Aspek:</span>
                        <span class="chip-value" id="EditAspekLabel"></span>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label-ikd">Nama Indikator Kinerja Daerah <span class="text-danger">*</span></label>
                                <textarea class="form-control-ikd" name="nama" id="EditNama" rows="3" placeholder="Tuliskan nama indikator secara jelas dan lengkap..." required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label class="form-label-ikd">Satuan Pengukuran</label>
                                        <select class="form-control-ikd" name="satuan" id="EditSatuan">
                                            <option value="">-- Pilih Satuan --</option>
                                            <option value="Persen">Persen</option>
                                            <option value="Poin">Poin</option>
                                            <option value="Indeks">Indeks</option>
                                            <option value="Rasio">Rasio</option>
                                            <option value="Jiwa">Jiwa</option>
                                            <option value="Orang">Orang</option>
                                            <option value="Km">Km</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Dokumen">Dokumen</option>
                                            <option value="Paket">Paket</option>
                                            <option value="Ha">Ha (Hektar)</option>
                                            <option value="Rp">Rp (Rupiah)</option>
                                            <option value="Nilai">Nilai</option>
                                            <option value="Skor">Skor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="form-group">
                                        <label class="form-label-ikd">Perangkat Daerah Pengampu (OPD)</label>
                                        <select class="form-control-ikd" name="opd" id="EditOpd">
                                            <option value="">-- Pilih Perangkat Daerah --</option>
                                            <?php if (!empty($Instansi)) { ?>
                                                <?php foreach ($Instansi as $inst) { ?>
                                                    <option value="<?= html_escape($inst['nama']) ?>"><?= html_escape($inst['nama']) ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="target-grid-card">
                                <div class="grid-title"><i class="fa fa-calendar-check-o text-warning"></i> Target Kinerja Tahunan (2025 - 2030)</div>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2025</label>
                                            <input type="text" class="form-control-target input-target" name="target_1" id="EditT1" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2026</label>
                                            <input type="text" class="form-control-target input-target" name="target_2" id="EditT2" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2027</label>
                                            <input type="text" class="form-control-target input-target" name="target_3" id="EditT3" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2028</label>
                                            <input type="text" class="form-control-target input-target" name="target_4" id="EditT4" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2029</label>
                                            <input type="text" class="form-control-target input-target" name="target_5" id="EditT5" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <div class="target-year-box">
                                            <label>2030</label>
                                            <input type="text" class="form-control-target input-target" name="target_6" id="EditT6" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-ikd-footer">
                <button type="button" class="btn-ikd-modal btn-ikd-cancel" data-dismiss="modal">Batal</button>
                <button type="button" class="btn-ikd-modal btn-ikd-submit" id="BtnSimpanEdit" style="background: #f59e0b;">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Datalist Rekomendasi OPD -->
<datalist id="OpdList">
    <option value="Sekretariat Daerah">
    <option value="Sekretariat DPRD">
    <option value="Inspektorat Daerah">
    <option value="Badan Perencanaan Pembangunan Daerah (Bappeda)">
    <option value="Badan Pendapatan Daerah (Bapenda)">
    <option value="Badan Pengelolaan Keuangan dan Aset Daerah (BPKAD)">
    <option value="Badan Kepegawaian dan Pengembangan Sumber Daya Manusia (BKPSDM)">
    <option value="Badan Kesatuan Bangsa dan Politik (Kesbangpol)">
    <option value="Badan Penanggulangan Bencana Daerah (BPBD)">
    <option value="Dinas Pendidikan dan Kebudayaan">
    <option value="Dinas Kesehatan">
    <option value="Rumah Sakit Umum Daerah (RSUD)">
    <option value="Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)">
    <option value="Dinas Perumahan Rakyat dan Kawasan Permukiman">
    <option value="Dinas Sosial">
    <option value="Dinas Tenaga Kerja">
    <option value="Dinas Pemberdayaan Perempuan, Perlindungan Anak, dan Keluarga Berencana">
    <option value="Dinas Ketahanan Pangan">
    <option value="Dinas Lingkungan Hidup">
    <option value="Dinas Kependudukan dan Pencatatan Sipil">
    <option value="Dinas Pemberdayaan Masyarakat dan Desa">
    <option value="Dinas Perhubungan">
    <option value="Dinas Komunikasi dan Informatika">
    <option value="Dinas Koperasi, Usaha Kecil, dan Menengah">
    <option value="Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP)">
    <option value="Dinas Pemuda dan Olahraga">
    <option value="Dinas Perpustakaan dan Kearsipan">
    <option value="Dinas Pertanian">
    <option value="Dinas Perikanan">
    <option value="Dinas Pariwisata dan Kebudayaan">
    <option value="Dinas Perindustrian dan Perdagangan">
    <option value="Satuan Polisi Pamong Praja (Satpol PP)">
</datalist>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/counterup/jquery.counterup.min.js'); ?>"></script>
<script src="<?= base_url('js/counterup/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('js/counterup/counterup-active.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/sparkline/jquery.sparkline.min.js'); ?>"></script>
<script src="<?= base_url('js/sparkline/sparkline-active.js'); ?>"></script>
<script src="<?= base_url('js/flot/jquery.flot.js'); ?>"></script>
<script src="<?= base_url('js/flot/jquery.flot.resize.js'); ?>"></script>
<script src="<?= base_url('js/flot/flot-active.js'); ?>"></script>
<script src="<?= base_url('js/knob/jquery.knob.js'); ?>"></script>
<script src="<?= base_url('js/knob/jquery.appear.js'); ?>"></script>
<script src="<?= base_url('js/knob/knob-active.js'); ?>"></script>
<script src="<?= base_url('js/chat/jquery.chat.js'); ?>"></script>
<script src="<?= base_url('js/todo/jquery.todo.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
$(document).ready(function () {
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

    // Auto replace comma with dot on target inputs
    $(document).on('input', '.input-target', function() {
        $(this).val($(this).val().replace(/,/g, '.'));
    });

    // Inisialisasi DataTables untuk masing-masing tabel aspek
    $('.table-data-aspek').each(function() {
        var table = $(this);
        table.DataTable({
            "ordering": false,
            "pageLength": 5,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
            "language": {
                "search": "",
                "searchPlaceholder": "Cari indikator...",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "zeroRecords": "Tidak ada data yang cocok",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left"></i>',
                    "last": '<i class="fa fa-angle-double-right"></i>',
                    "next": '<i class="fa fa-angle-right"></i>',
                    "previous": '<i class="fa fa-angle-left"></i>'
                }
            }
        });
    });

    // Filter Provinsi & Kab/Kota
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
        $('#Provinsi').change(function () {
            var kodeProv = $(this).val();
            if (kodeProv === "") {
                $('#KabKota').html('<option value="">Pilih Kab/Kota</option>');
                return;
            }
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
                beforeSend: function() { $('#KabKota').prop('disabled', true); },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                            }
                        } else {
                            alert("Belum Ada Data Kab/Kota");
                        }
                        $('#KabKota').html(KabKota).prop('disabled', false);
                    } catch (e) {
                        alert("Gagal memuat data Kab/Kota");
                        $('#KabKota').prop('disabled', false);
                    }
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                    $('#KabKota').prop('disabled', false);
                }
            });
        });

        $('#Filter').click(function () {
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
                data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
                beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                success: function(Respon) {
                    var r = typeof Respon === 'string' ? Respon.trim() : Respon;
                    if (r === '1' || r === 'success' || r == 1) {
                        window.location.href = BaseURL + "Daerah/IKD";
                    } else {
                        alert("Gagal menyimpan filter wilayah!");
                        $("#Filter").prop('disabled', false).text('Filter');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            });
        });

        // Populate Kab/Kota dropdown on page load if KodeWilayah is set
        <?php if (!empty($KodeWilayah)) { ?>
            var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
            var kodeKab = "<?= $KodeWilayah ?>";
            $("#Provinsi").val(kodeProv);
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                                KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                            }
                        }
                        $("#KabKota").html(KabKota);
                    } catch (e) {
                        console.error("Gagal memuat data Kab/Kota");
                    }
                }
            });
        <?php } ?>
    <?php } ?>

    var aspekMapLabels = {
        'geografi': 'I. ASPEK GEOGRAFI DAN DEMOGRAFI',
        'kesejahteraan': 'II. ASPEK KESEJAHTERAAN MASYARAKAT',
        'dayasaing': 'III. ASPEK DAYA SAING',
        'pelayanan': 'IV. ASPEK PELAYANAN UMUM'
    };

    // Buka Modal Tambah dengan Aspek yang Dipilih Otomatis
    $(document).on('click', '.BtnTambahPerAspek', function() {
        var aspek = $(this).data('aspek') || 'geografi';
        var label = $(this).data('aspek-name') || aspekMapLabels[aspek] || aspek.toUpperCase();
        $('#FormTambahIKD')[0].reset();
        $('#TambahAspek').val(aspek);
        $('#TambahAspekLabel').text(label);
        $('#TambahSatuan').val('');
        $('#TambahOpd').val('');
        $('#ModalInputIKD').modal('show');
    });

    // Simpan Tambah IKD
    $('#BtnSimpanTambah').click(function() {
        var nama = $('#TambahNama').val().trim();
        if (!nama) {
            alert('Nama Indikator wajib diisi!');
            $('#TambahNama').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/TambahIkd',
            type: 'POST',
            data: $('#FormTambahIKD').serialize(),
            dataType: 'json',
            success: function(resp) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan</b>');
                if (resp.status === 'success') {
                    $('#ModalInputIKD').modal('hide');
                    alert(resp.message || 'Indikator berhasil ditambahkan!');
                    location.reload();
                } else {
                    alert(resp.message || 'Gagal menambahkan indikator!');
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan</b>');
                alert('Terjadi kesalahan koneksi server!');
            }
        });
    });

    // Buka Modal Edit IKD
    $(document).on('click', '.BtnEditIKD', function() {
        var d = $(this).data();
        var aspek = d.aspek || 'geografi';
        var label = aspekMapLabels[aspek] || aspek.toUpperCase();
        $('#EditId').val(d.id);
        $('#EditAspek').val(aspek);
        $('#EditAspekLabel').text(label);
        $('#EditNama').val(d.nama);
        $('#EditSatuan').val(d.satuan || '');
        if (d.opd && $('#EditOpd option[value="' + d.opd + '"]').length === 0) {
            $('#EditOpd').append(new Option(d.opd, d.opd, true, true));
        }
        $('#EditOpd').val(d.opd || '');
        $('#EditT1').val(d.t1 ? String(d.t1).replace(',', '.') : '');
        $('#EditT2').val(d.t2 ? String(d.t2).replace(',', '.') : '');
        $('#EditT3').val(d.t3 ? String(d.t3).replace(',', '.') : '');
        $('#EditT4').val(d.t4 ? String(d.t4).replace(',', '.') : '');
        $('#EditT5').val(d.t5 ? String(d.t5).replace(',', '.') : '');
        $('#EditT6').val(d.t6 ? String(d.t6).replace(',', '.') : '');
        $('#ModalEditIKD').modal('show');
    });

    // Simpan Perubahan Edit IKD
    $('#BtnSimpanEdit').click(function() {
        var nama = $('#EditNama').val().trim();
        if (!nama) {
            alert('Nama Indikator wajib diisi!');
            $('#EditNama').focus();
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: BaseURL + 'Daerah/EditIkd',
            type: 'POST',
            data: $('#FormEditIKD').serialize(),
            dataType: 'json',
            success: function(resp) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
                if (resp.status === 'success') {
                    $('#ModalEditIKD').modal('hide');
                    alert(resp.message || 'Indikator berhasil diperbarui!');
                    location.reload();
                } else {
                    alert(resp.message || 'Gagal memperbarui indikator!');
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Perubahan</b>');
                alert('Terjadi kesalahan koneksi server!');
            }
        });
    });

    // Hapus IKD
    $(document).on('click', '.BtnHapusIKD', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        if (confirm('Apakah Anda yakin ingin menghapus indikator "' + nama + '"?')) {
            $.ajax({
                url: BaseURL + 'Daerah/HapusIkd',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status === 'success') {
                        alert(resp.message || 'Indikator berhasil dihapus!');
                        location.reload();
                    } else {
                        alert(resp.message || 'Gagal menghapus indikator!');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan koneksi server!');
                }
            });
        }
    });
});
</script>
</body>
</html>