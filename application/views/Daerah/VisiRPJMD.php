<?php
if (!function_exists('formatDesimalIndikator')) {
    function formatDesimalIndikator($val, $fallback = '-') {
        if ($val === null || $val === '') return $fallback;
        $str = trim((string)$val);
        if ($str === '' || $str === '-') return $fallback;
        $clean = str_replace(',', '.', $str);
        if (is_numeric($clean)) {
            $formatted = (string)(float)$clean;
            return str_replace('.', ',', $formatted);
        }
        return html_escape($str);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visi RPJMD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load->view('Daerah/Cssumum'); ?>
</head>
<body>
    <?php $this->load->view('Daerah/sidebar'); ?>

    <style>
        /* Toast Notification */
        .toast-error {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            z-index: 99999;
            display: none;
            font-weight: 500;
            max-width: 450px;
            animation: slideIn 0.4s ease;
            font-size: 14px;
        }

        .toast-error.success {
            background: #4caf50;
            color: white;
        }

        .toast-error.error {
            background: #f44336;
            color: white;
        }

        .toast-error .close-btn {
            float: right;
            margin-left: 15px;
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            opacity: 0.8;
        }
        .toast-error .close-btn:hover {
            opacity: 1;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .modal {
            text-align: center;
            padding: 0!important;
        }
        .modal:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            margin-right: -4px;
        }
        .modal-dialog {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
            width: 700px; 
            max-width: 95%; 
        }
        .modal-lg {
            width: 850px !important;
            max-width: 95% !important;
        }
        .modal-header h2 {
            font-size: 20px;
            color: #333;
            font-weight: 600;
            margin-bottom: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .data-table-list {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            border: none;
        }

        /* Tabel Utama RPJMD */
        #hierarki-table {
            border: 1px solid #dcdcdc;
            border-collapse: collapse;
        }
        #hierarki-table > thead > tr > th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 700;
            text-transform: capitalize;
            font-size: 12px;
            letter-spacing: 0.3px;
            border: 1px solid #cbd5e1;
            text-align: center;
            padding: 8px 6px;
        }
        #hierarki-table > tbody > tr > td {
            vertical-align: middle;
            color: #333;
            border: 1px solid #e2e8f0;
            font-size: 13px;
            padding: 6px 8px;
        }
        
        #hierarki-table > tbody > tr {
            transition: filter 0.15s ease;
        }
        #hierarki-table > tbody > tr:hover {
            filter: brightness(0.97);
        }

        .btn-action {
            border-radius: 4px;
            margin: 1px;
            transition: all 0.2s ease;
            padding: 4px 8px;
            font-weight: 600;
            font-size: 11px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }
        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }
        .btn-action:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .btn-aksi-group {
            display: flex;
            flex-wrap: wrap;
            gap: 3px;
            justify-content: center;
            align-items: center;
        }
        .btn-aksi-group .btn-action {
            margin: 1px;
            padding: 3px 6px;
            font-size: 11px;
            white-space: nowrap;
        }

        .badge-periode {
            background-color: #00c292;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-periode.level2 {
            background-color: #00bcd4;
        }
        .badge-periode.level3 {
            background-color: #ff9800;
        }
        .badge-periode.level4 {
            background-color: #78909c;
        }

        .filter-row {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 10px;
        }
        .filter-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .filter-group label {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .filter-select {
            width: 260px;
            font-size: 14px;
            padding: 5px 8px;
        }

        .periode-info {
            background: #e8f5e9;
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            color: #2e7d32;
            font-weight: 600;
            border-left: 3px solid #4caf50;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
            display: inline-block;
            vertical-align: text-bottom;
            border: 0.2em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
        }
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }

        .td-content-wrapper {
            display: block !important;
            padding: 2px 0;
        }
        
        .td-content-wrapper .text-content {
            display: block;
            word-wrap: break-word;
            word-break: break-word;
            line-height: 1.5;
            text-align: left !important;
        }

        .row-visi { background-color: #eef7ee !important; font-weight: 600; }
        .row-misi { background-color: #e6f7fa !important; }
        .row-tujuan { background-color: #fff8eb !important; }
        .row-tujuan-sub { background-color: #fffdf5 !important; }
        .row-sasaran { background-color: #ffffff !important; }
        .row-sasaran-sub { background-color: #fcfcfc !important; }
        
        .border-visi { border-left: 4px solid #4caf50 !important; }
        .border-misi { border-left: 4px solid #00bcd4 !important; }
        .border-tujuan { border-left: 4px solid #ff9800 !important; }
        .border-sasaran { border-left: 4px solid #78909c !important; }

        .clickable-row {
            cursor: pointer;
        }
        .clickable-row:hover {
            text-decoration: underline;
        }

        .pd-tag {
            display: inline-block;
            background: #e3f2fd;
            color: #0d47a1;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            margin: 1px 2px;
            line-height: 1.3;
        }

        .program-tag {
            display: inline-block;
            background: #f5f3ff;
            color: #6b21a8;
            border: 1px solid #ddd6fe;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            margin: 1px 2px;
            line-height: 1.3;
            word-break: break-word;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 4px;
            min-height: 36px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f5f3ff;
            border: 1px solid #ddd6fe;
            color: #6b21a8;
            border-radius: 4px;
            padding: 3px 8px;
            font-size: 12px;
            margin-top: 4px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #6b21a8;
            margin-right: 5px;
            font-weight: bold;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ef4444;
        }

        /* PD Pengampuh Table Styles */
        .pd-table {
            margin-bottom: 5px;
            text-align: left;
        }
        .pd-table thead th {
            font-size: 12px;
            padding: 5px 8px;
            background: #f8f9fa;
            text-align: left;
        }
        .pd-table thead th.text-center {
            text-align: center !important;
        }
        .pd-table tbody td {
            padding: 5px 8px;
            vertical-align: middle;
            text-align: left;
        }
        .pd-table tbody td.text-center {
            text-align: center !important;
        }
        .pd-table .form-control-sm {
            padding: 4px 8px;
            font-size: 13px;
            height: 34px;
            text-align: left;
        }
        .pd-table .btn-sm {
            padding: 3px 8px;
            font-size: 12px;
        }
        .select2-container--default .select2-selection--single {
            height: 34px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            text-align: left !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 32px;
            padding-left: 10px;
            text-align: left !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 32px;
        }
        .select2-container--default .select2-results__option {
            text-align: left !important;
        }
        .select2-dropdown {
            text-align: left !important;
        }
        .select2-search--dropdown .select2-search__field {
            text-align: left !important;
        }

        .divider-aksi {
            width: 100%;
            height: 1px;
            background: #e0e0e0;
            margin: 3px 0;
        }

        .clickable-indikator {
            cursor: pointer;
        }

        /* Floating Contextual Popover for Indikator Actions */
        #IndikatorActionPopover {
            position: absolute;
            z-index: 9999;
            width: 270px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18), 0 0 0 1px rgba(0, 0, 0, 0.08);
            display: none;
            animation: popoverScaleIn 0.18s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes popoverScaleIn {
            from { opacity: 0; transform: scale(0.92) translateY(-4px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .ind-popover-header {
            background: #f8fafc;
            padding: 8px 12px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ind-popover-title {
            font-weight: 700;
            font-size: 11px;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .ind-popover-close {
            background: none;
            border: none;
            font-size: 16px;
            line-height: 1;
            color: #94a3b8;
            cursor: pointer;
            padding: 0;
        }
        .ind-popover-close:hover {
            color: #ef4444;
        }
        .ind-popover-body {
            padding: 10px 12px;
        }
        .ind-popover-text {
            font-size: 12px;
            color: #475569;
            margin-bottom: 10px;
            line-height: 1.4;
            font-weight: 500;
            background: #f1f5f9;
            padding: 6px 8px;
            border-radius: 4px;
            border-left: 3px solid #0284c7;
            max-height: 52px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .ind-popover-actions {
            display: flex;
            gap: 6px;
        }
        .ind-popover-actions .btn {
            flex: 1;
            font-size: 11px;
            font-weight: 600;
            padding: 6px 8px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }
    </style>

    <!-- Toast Error -->
    <div class="toast-error error" id="toastError">
        <span class="close-btn" onclick="document.getElementById('toastError').classList.remove('show')">&times;</span>
        <span id="toastMessage">Error</span>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid" style="padding: 0 25px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="data-table-list">
                            
                            <!-- FILTER UNTUK PENGGUNA YANG BELUM LOGIN -->
                            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
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
                            <?php } ?>

                            <!-- MENAMPILKAN WILAYAH DAN PERIODE SETELAH FILTER -->
                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php 
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                    <?php if (empty($Visi)) { ?>
                                        <strong>Peringatan:</strong> Tidak ada data Visi RPJMD untuk wilayah ini.
                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <!-- HEADER TABEL -->
                            <div class="basic-tb-hd" style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                                <div>
                                    <h4 style="margin: 0; color: #333; font-weight: 700;">VMTS RPJMD (Visi, Misi, Tujuan, Sasaran & Indikator)</h4>
                                </div>
                                <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 8px;">
                                    <button type="button" class="btn btn-default btn-action" id="btnToggleAll" style="padding: 6px 12px;">
                                        <i class="fa fa-arrows-v"></i> <span id="toggleAllText">Tutup Semua</span>
                                    </button>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputVisi" style="padding: 6px 14px;">
                                        <i class="fa fa-plus-circle"></i> <b>Input Visi RPJMD</b>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- TABEL HIERARKI DENGAN INDIKATOR KELUAR LANGSUNG -->
                            <div class="table-responsive">
                                <table id="hierarki-table" class="table table-bordered">
                                     <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle; width: 3%;">No</th>
                                            <th rowspan="2" style="vertical-align: middle; width: 25%;">Visi, Misi, Tujuan dan Sasaran</th>
                                            <th rowspan="2" style="vertical-align: middle; width: 15%;">Indikator</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle; width: 5%;">Satuan</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle; width: 5%;">Base line<br>2024</th>
                                            <th colspan="6" class="text-center" style="vertical-align: middle;">Target</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle; width: 5%;">Kondisi<br>Akhir</th>
                                            <th rowspan="2" style="vertical-align: middle; width: 12%;">Perangkat Daerah<br>Pengampuh</th>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle; width: 10%;">Opsi Aksi</th>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th class="text-center" style="width: 4%;">2025</th>
                                            <th class="text-center" style="width: 4%;">2026</th>
                                            <th class="text-center" style="width: 4%;">2027</th>
                                            <th class="text-center" style="width: 4%;">2028</th>
                                            <th class="text-center" style="width: 4%;">2029</th>
                                            <th class="text-center" style="width: 4%;">2030</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($Visi) && count($Visi) > 0) {
                                            $noVisi = 1;
                                            foreach ($Visi as $visi) { 
                                                $misiData = isset($visi['Misi']) ? $visi['Misi'] : [];
                                        ?>
                                            <!-- LEVEL 1: VISI -->
                                            <tr data-id="visi-<?= $visi['Id'] ?>" data-parent="" data-expanded="true" class="row-visi">
                                                <td class="text-center" style="font-size: 13px;"><b><?= $noVisi ?></b></td>
                                                <td style="padding-left: 10px !important;" class="border-visi clickable-row" onclick="toggleLevel('visi-<?= $visi['Id'] ?>', this)">
                                                    <div class="td-content-wrapper">
                                                        <div class="text-content">
                                                            <span class="label-text" style="color: #2e7d32;"><b>VISI:</b> </span>
                                                            <?= html_escape($visi['Visi']) ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <td class="text-center text-muted">-</td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td class="text-center">
                                                    <div class="btn-aksi-group">
                                                        <button class="btn btn-xs btn-success TambahMisi btn-action" data-id="<?= $visi['Id'] ?>" title="Tambah Misi"><i class="fa fa-plus"></i> Misi</button>
                                                        <button class="btn btn-xs btn-warning EditVisi btn-action" data-id="<?= $visi['Id'] ?>" data-visi="<?= html_escape($visi['Visi']) ?>" title="Edit Visi"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-xs btn-danger HapusVisi btn-action" data-id="<?= $visi['Id'] ?>" title="Hapus Visi"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                            <?php 
                                            if(!empty($misiData)) {
                                                $noMisi = 1;
                                                foreach ($misiData as $misi) { 
                                                    $tujuanData = isset($misi['Tujuan']) ? $misi['Tujuan'] : [];
                                            ?>
                                                <!-- LEVEL 2: MISI -->
                                                <tr data-id="misi-<?= $misi['Id'] ?>" data-parent="visi-<?= $visi['Id'] ?>" data-expanded="true" class="row-misi">
                                                    <td class="text-center" style="font-weight: 600;"><?= $noMisi ?></td>
                                                    <td style="padding-left: 20px !important;" class="border-misi clickable-row" onclick="toggleLevel('misi-<?= $misi['Id'] ?>', this)">
                                                        <div class="td-content-wrapper">
                                                            <div class="text-content">
                                                                <span class="label-text"><b style="color: #00838f;">MISI <?= $noMisi ?>:</b> </span>
                                                                <?= html_escape($misi['Misi']) ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <td class="text-center text-muted">-</td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <td class="text-center">
                                                        <div class="btn-aksi-group">
                                                            <button class="btn btn-xs btn-success TambahTujuan btn-action" data-id="<?= $misi['Id'] ?>" title="Tambah Tujuan"><i class="fa fa-plus"></i> Tujuan</button>
                                                            <button class="btn btn-xs btn-warning EditMisi btn-action" data-id="<?= $misi['Id'] ?>" data-idvisi="<?= $visi['Id'] ?>" data-misi="<?= html_escape($misi['Misi']) ?>" title="Edit Misi"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-xs btn-danger HapusMisi btn-action" data-id="<?= $misi['Id'] ?>" title="Hapus Misi"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                </tr>

                                                <?php 
                                                if(!empty($tujuanData)) {
                                                    $noTujuan = 1;
                                                    foreach ($tujuanData as $tujuan) { 
                                                        $sasaranData = isset($tujuan['Sasaran']) ? $tujuan['Sasaran'] : [];
                                                        $tujuanIndikators = isset($tujuan['Indikator']) ? $tujuan['Indikator'] : [];
                                                        $tujuanRowspan = count($tujuanIndikators) > 0 ? count($tujuanIndikators) : 1;
                                                        $firstIndT = count($tujuanIndikators) > 0 ? $tujuanIndikators[0] : null;
                                                ?>
                                                    <!-- LEVEL 3: TUJUAN (Baris Pertama / Utama) -->
                                                    <tr data-id="tujuan-<?= $tujuan['Id'] ?>" data-parent="misi-<?= $misi['Id'] ?>" data-expanded="true" class="row-tujuan">
                                                        <td rowspan="<?= $tujuanRowspan ?>" class="text-center" style="font-weight: 600;"><?= $noMisi . '.' . $noTujuan ?></td>
                                                        <td rowspan="<?= $tujuanRowspan ?>" style="padding-left: 30px !important;" class="border-tujuan clickable-row" onclick="toggleLevel('tujuan-<?= $tujuan['Id'] ?>', this)">
                                                             <div class="td-content-wrapper">
                                                                <div class="text-content">
                                                                    <span class="label-text"><b style="color: #ef6c00;">TUJUAN <?= $noMisi . '.' . $noTujuan ?>:</b> </span>
                                                                    <?= html_escape($tujuan['Tujuan']) ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        <?php if ($firstIndT) { 
                                                            $isLvl3 = (isset($_SESSION['Level']) && $_SESSION['Level'] == 3);
                                                            $clsInd = $isLvl3 ? 'clickable-indikator' : '';
                                                            $titleInd = $isLvl3 ? 'Klik untuk opsi aksi indikator' : '';
                                                        ?>
                                                            <!-- Indikator Data 1 -->
                                                            <td class="<?= $clsInd ?>" 
                                                                style="text-align: left;"
                                                                data-type="tujuan"
                                                                data-id="<?= $firstIndT['id'] ?>" 
                                                                data-parent-id="<?= $tujuan['Id'] ?>"
                                                                data-parent-text="<?= html_escape($tujuan['Tujuan']) ?>"
                                                                data-indikator="<?= html_escape($firstIndT['indikator']) ?>"
                                                                data-satuan="<?= html_escape($firstIndT['satuan'] ?? '') ?>"
                                                                data-baseline="<?= formatDesimalIndikator($firstIndT['baseline_2024'] ?? '', '') ?>"
                                                                data-t2025="<?= formatDesimalIndikator($firstIndT['target_2025'] ?? '', '') ?>"
                                                                data-t2026="<?= formatDesimalIndikator($firstIndT['target_2026'] ?? '', '') ?>"
                                                                data-t2027="<?= formatDesimalIndikator($firstIndT['target_2027'] ?? '', '') ?>"
                                                                data-t2028="<?= formatDesimalIndikator($firstIndT['target_2028'] ?? '', '') ?>"
                                                                data-t2029="<?= formatDesimalIndikator($firstIndT['target_2029'] ?? '', '') ?>"
                                                                data-t2030="<?= formatDesimalIndikator($firstIndT['target_2030'] ?? '', '') ?>"
                                                                data-pd="<?= html_escape($firstIndT['pd_pengampuh'] ?? '') ?>"
                                                                title="<?= $titleInd ?>">
                                                                <?= html_escape($firstIndT['indikator']) ?>
                                                            </td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= html_escape($firstIndT['satuan'] ?: '-') ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['baseline_2024'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['target_2025'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['target_2026'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['target_2027'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['target_2028'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['target_2029'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['target_2030'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndT['kondisi_akhir'] ?? ($firstIndT['target_2030'] ?? null)) ?></td>
                                                            <td class="<?= $clsInd ?>" title="<?= $titleInd ?>">
                                                                <?php if (!empty($firstIndT['pd_pengampuh_names'])) { ?>
                                                                    <?php foreach ($firstIndT['pd_pengampuh_names'] as $pdn) { ?>
                                                                        <span class="pd-tag"><?= html_escape($pdn) ?></span>
                                                                    <?php } ?>
                                                                <?php } else if (!empty($firstIndT['pd_pengampuh'])) { ?>
                                                                    <span class="pd-tag">ID: <?= html_escape($firstIndT['pd_pengampuh']) ?></span>
                                                                <?php } else { ?>
                                                                    <span class="text-muted">-</span>
                                                                <?php } ?>
                                                            </td>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <td rowspan="<?= $tujuanRowspan ?>" class="text-center">
                                                                <div class="btn-aksi-group">
                                                                    <button class="btn btn-xs btn-info TambahIndikatorTujuanDirect btn-action" data-tujuan-id="<?= $tujuan['Id'] ?>" data-tujuan-text="<?= html_escape($tujuan['Tujuan']) ?>" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                                    <button class="btn btn-xs btn-success TambahSasaran btn-action" data-id="<?= $tujuan['Id'] ?>" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                                    <button class="btn btn-xs btn-warning EditTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" data-idmisi="<?= $misi['Id'] ?>" data-tujuan="<?= html_escape($tujuan['Tujuan']) ?>" title="Edit Tujuan"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-xs btn-danger HapusTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" title="Hapus Tujuan"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </td>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <!-- Belum ada Indikator -->
                                                            <td class="text-muted" style="font-style: italic;">Belum ada indikator</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <td class="text-center text-muted">-</td>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <td class="text-center">
                                                                <div class="btn-aksi-group">
                                                                    <button class="btn btn-xs btn-info TambahIndikatorTujuanDirect btn-action" data-tujuan-id="<?= $tujuan['Id'] ?>" data-tujuan-text="<?= html_escape($tujuan['Tujuan']) ?>" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                                    <button class="btn btn-xs btn-success TambahSasaran btn-action" data-id="<?= $tujuan['Id'] ?>" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                                    <button class="btn btn-xs btn-warning EditTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" data-idmisi="<?= $misi['Id'] ?>" data-tujuan="<?= html_escape($tujuan['Tujuan']) ?>" title="Edit Tujuan"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-xs btn-danger HapusTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" title="Hapus Tujuan"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </td>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </tr>

                                                    <?php 
                                                    // Baris Indikator Tujuan ke-2, 3, dst
                                                    if (count($tujuanIndikators) > 1) {
                                                        for ($ti = 1; $ti < count($tujuanIndikators); $ti++) {
                                                            $indT = $tujuanIndikators[$ti];
                                                            $isLvl3 = (isset($_SESSION['Level']) && $_SESSION['Level'] == 3);
                                                            $clsInd = $isLvl3 ? 'clickable-indikator' : '';
                                                            $titleInd = $isLvl3 ? 'Klik untuk opsi aksi indikator' : '';
                                                    ?>
                                                        <tr data-id="tujuan-<?= $tujuan['Id'] ?>-sub-<?= $ti ?>" data-parent="misi-<?= $misi['Id'] ?>" class="row-tujuan row-tujuan-sub">
                                                            <td class="<?= $clsInd ?>" 
                                                                style="text-align: left;"
                                                                data-type="tujuan"
                                                                data-id="<?= $indT['id'] ?>" 
                                                                data-tujuan-id="<?= $tujuan['Id'] ?>"
                                                                data-parent-id="<?= $tujuan['Id'] ?>"
                                                                data-parent-text="<?= html_escape($tujuan['Tujuan']) ?>"
                                                                data-indikator="<?= html_escape($indT['indikator']) ?>"
                                                                data-satuan="<?= html_escape($indT['satuan'] ?? '') ?>"
                                                                data-baseline="<?= formatDesimalIndikator($indT['baseline_2024'] ?? '', '') ?>"
                                                                data-t2025="<?= formatDesimalIndikator($indT['target_2025'] ?? '', '') ?>"
                                                                data-t2026="<?= formatDesimalIndikator($indT['target_2026'] ?? '', '') ?>"
                                                                data-t2027="<?= formatDesimalIndikator($indT['target_2027'] ?? '', '') ?>"
                                                                data-t2028="<?= formatDesimalIndikator($indT['target_2028'] ?? '', '') ?>"
                                                                data-t2029="<?= formatDesimalIndikator($indT['target_2029'] ?? '', '') ?>"
                                                                data-t2030="<?= formatDesimalIndikator($indT['target_2030'] ?? '', '') ?>"
                                                                data-pd="<?= html_escape($indT['pd_pengampuh'] ?? '') ?>"
                                                                title="<?= $titleInd ?>">
                                                                <?= html_escape($indT['indikator']) ?>
                                                            </td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= html_escape($indT['satuan'] ?: '-') ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['baseline_2024'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['target_2025'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['target_2026'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['target_2027'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['target_2028'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['target_2029'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['target_2030'] ?? null) ?></td>
                                                            <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indT['kondisi_akhir'] ?? ($indT['target_2030'] ?? null)) ?></td>
                                                            <td class="<?= $clsInd ?>" title="<?= $titleInd ?>">
                                                                <?php if (!empty($indT['pd_pengampuh_names'])) { ?>
                                                                    <?php foreach ($indT['pd_pengampuh_names'] as $pdn) { ?>
                                                                        <span class="pd-tag"><?= html_escape($pdn) ?></span>
                                                                    <?php } ?>
                                                                <?php } else if (!empty($indT['pd_pengampuh'])) { ?>
                                                                    <span class="pd-tag">ID: <?= html_escape($indT['pd_pengampuh']) ?></span>
                                                                <?php } else { ?>
                                                                    <span class="text-muted">-</span>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php 
                                                        }
                                                    }
                                                    ?>

                                                    <?php 
                                                    if(!empty($sasaranData)) {
                                                        $noSasaran = 1;
                                                        foreach ($sasaranData as $sasaran) { 
                                                            $sasaranIndikators = isset($sasaran['Indikator']) ? $sasaran['Indikator'] : [];
                                                            $sasaranRowspan = count($sasaranIndikators) > 0 ? count($sasaranIndikators) : 1;
                                                            $firstIndS = count($sasaranIndikators) > 0 ? $sasaranIndikators[0] : null;
                                                    ?>
                                                        <!-- LEVEL 4: SASARAN (Baris Pertama / Utama) -->
                                                        <tr data-id="sasaran-<?= $sasaran['Id'] ?>" data-parent="tujuan-<?= $tujuan['Id'] ?>" data-expanded="true" class="row-sasaran">
                                                            <td rowspan="<?= $sasaranRowspan ?>" class="text-center" style="font-weight: 500;"><?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?></td>
                                                            <td rowspan="<?= $sasaranRowspan ?>" style="padding-left: 45px !important;" class="border-sasaran">
                                                                 <div class="td-content-wrapper">
                                                                    <div class="text-content">
                                                                        <span class="label-text"><b style="color: #616161;">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?>:</b> </span>
                                                                        <?= html_escape($sasaran['Sasaran']) ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                            <?php if ($firstIndS) { 
                                                                $isLvl3 = (isset($_SESSION['Level']) && $_SESSION['Level'] == 3);
                                                                $clsInd = $isLvl3 ? 'clickable-indikator' : '';
                                                                $titleInd = $isLvl3 ? 'Klik untuk opsi aksi indikator' : '';
                                                            ?>
                                                                <!-- Indikator Sasaran Data 1 -->
                                                                <td class="<?= $clsInd ?>" 
                                                                    style="text-align: left;"
                                                                    data-type="sasaran"
                                                                    data-id="<?= $firstIndS['id'] ?>" 
                                                                    data-parent-id="<?= $sasaran['Id'] ?>"
                                                                    data-parent-text="<?= html_escape($sasaran['Sasaran']) ?>"
                                                                    data-indikator="<?= html_escape($firstIndS['indikator']) ?>"
                                                                    data-satuan="<?= html_escape($firstIndS['satuan'] ?? '') ?>"
                                                                    data-baseline="<?= formatDesimalIndikator($firstIndS['baseline_2024'] ?? '', '') ?>"
                                                                    data-t2025="<?= formatDesimalIndikator($firstIndS['target_2025'] ?? '', '') ?>"
                                                                    data-t2026="<?= formatDesimalIndikator($firstIndS['target_2026'] ?? '', '') ?>"
                                                                    data-t2027="<?= formatDesimalIndikator($firstIndS['target_2027'] ?? '', '') ?>"
                                                                    data-t2028="<?= formatDesimalIndikator($firstIndS['target_2028'] ?? '', '') ?>"
                                                                    data-t2029="<?= formatDesimalIndikator($firstIndS['target_2029'] ?? '', '') ?>"
                                                                    data-t2030="<?= formatDesimalIndikator($firstIndS['target_2030'] ?? '', '') ?>"
                                                                    data-pd="<?= html_escape($firstIndS['pd_pengampuh'] ?? '') ?>"
                                                                    data-program-pd="<?= html_escape($firstIndS['program_pd'] ?? '') ?>"
                                                                    title="<?= $titleInd ?>">
                                                                    <?= html_escape($firstIndS['indikator']) ?>
                                                                </td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= html_escape($firstIndS['satuan'] ?: '-') ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['baseline_2024'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['target_2025'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['target_2026'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['target_2027'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['target_2028'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['target_2029'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['target_2030'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($firstIndS['kondisi_akhir'] ?? ($firstIndS['target_2030'] ?? null)) ?></td>
                                                                <td class="<?= $clsInd ?>" title="<?= $titleInd ?>">
                                                                    <?php if (!empty($firstIndS['pd_pengampuh_names'])) { ?>
                                                                        <?php foreach ($firstIndS['pd_pengampuh_names'] as $pdn) { ?>
                                                                            <span class="pd-tag"><?= html_escape($pdn) ?></span>
                                                                        <?php } ?>
                                                                    <?php } else if (!empty($firstIndS['pd_pengampuh'])) { ?>
                                                                        <span class="pd-tag">ID: <?= html_escape($firstIndS['pd_pengampuh']) ?></span>
                                                                    <?php } else { ?>
                                                                        <span class="text-muted">-</span>
                                                                    <?php } ?>

                                                                    <?php if (!empty($firstIndS['program_pd_names'])) { ?>
                                                                        <div style="margin-top: 5px; border-top: 1px dashed #cbd5e1; padding-top: 4px;">
                                                                            <small style="color: #6b21a8; font-weight: 700; font-size: 10px; display: block; margin-bottom: 2px;">
                                                                                <i class="fa fa-folder-open-o"></i> Program PD:
                                                                            </small>
                                                                            <?php foreach ($firstIndS['program_pd_names'] as $prgName) { ?>
                                                                                <span class="program-tag" title="<?= html_escape($prgName) ?>"><?= html_escape($prgName) ?></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                <td rowspan="<?= $sasaranRowspan ?>" class="text-center">
                                                                    <div class="btn-aksi-group">
                                                                        <button class="btn btn-xs btn-info TambahIndikatorSasaranDirect btn-action" data-sasaran-id="<?= $sasaran['Id'] ?>" data-sasaran-text="<?= html_escape($sasaran['Sasaran']) ?>" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                                        <button class="btn btn-xs btn-warning EditSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" data-idtujuan="<?= $tujuan['Id'] ?>" data-sasaran="<?= html_escape($sasaran['Sasaran']) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                                        <button class="btn btn-xs btn-danger HapusSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </td>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <!-- Belum ada Indikator -->
                                                                <td class="text-muted" style="font-style: italic;">Belum ada indikator</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <td class="text-center text-muted">-</td>
                                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                                <td class="text-center">
                                                                    <div class="btn-aksi-group">
                                                                        <button class="btn btn-xs btn-info TambahIndikatorSasaranDirect btn-action" data-sasaran-id="<?= $sasaran['Id'] ?>" data-sasaran-text="<?= html_escape($sasaran['Sasaran']) ?>" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                                        <button class="btn btn-xs btn-warning EditSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" data-idtujuan="<?= $tujuan['Id'] ?>" data-sasaran="<?= html_escape($sasaran['Sasaran']) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                                        <button class="btn btn-xs btn-danger HapusSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </td>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tr>

                                                        <?php 
                                                        // Baris Indikator Sasaran ke-2, 3, dst
                                                        if (count($sasaranIndikators) > 1) {
                                                            for ($si = 1; $si < count($sasaranIndikators); $si++) {
                                                                $indS = $sasaranIndikators[$si];
                                                                $isLvl3 = (isset($_SESSION['Level']) && $_SESSION['Level'] == 3);
                                                                $clsInd = $isLvl3 ? 'clickable-indikator' : '';
                                                                $titleInd = $isLvl3 ? 'Klik untuk opsi aksi indikator' : '';
                                                        ?>
                                                            <tr data-id="sasaran-<?= $sasaran['Id'] ?>-sub-<?= $si ?>" data-parent="tujuan-<?= $tujuan['Id'] ?>" class="row-sasaran row-sasaran-sub">
                                                                <td class="<?= $clsInd ?>" 
                                                                    style="text-align: left;"
                                                                    data-type="sasaran"
                                                                    data-id="<?= $indS['id'] ?>" 
                                                                    data-sasaran-id="<?= $sasaran['Id'] ?>"
                                                                    data-parent-id="<?= $sasaran['Id'] ?>"
                                                                    data-parent-text="<?= html_escape($sasaran['Sasaran']) ?>"
                                                                    data-indikator="<?= html_escape($indS['indikator']) ?>"
                                                                    data-satuan="<?= html_escape($indS['satuan'] ?? '') ?>"
                                                                    data-baseline="<?= formatDesimalIndikator($indS['baseline_2024'] ?? '', '') ?>"
                                                                    data-t2025="<?= formatDesimalIndikator($indS['target_2025'] ?? '', '') ?>"
                                                                    data-t2026="<?= formatDesimalIndikator($indS['target_2026'] ?? '', '') ?>"
                                                                    data-t2027="<?= formatDesimalIndikator($indS['target_2027'] ?? '', '') ?>"
                                                                    data-t2028="<?= formatDesimalIndikator($indS['target_2028'] ?? '', '') ?>"
                                                                    data-t2029="<?= formatDesimalIndikator($indS['target_2029'] ?? '', '') ?>"
                                                                    data-t2030="<?= formatDesimalIndikator($indS['target_2030'] ?? '', '') ?>"
                                                                    data-pd="<?= html_escape($indS['pd_pengampuh'] ?? '') ?>"
                                                                    data-program-pd="<?= html_escape($indS['program_pd'] ?? '') ?>"
                                                                    title="<?= $titleInd ?>">
                                                                    <?= html_escape($indS['indikator']) ?>
                                                                </td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= html_escape($indS['satuan'] ?: '-') ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['baseline_2024'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['target_2025'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['target_2026'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['target_2027'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['target_2028'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['target_2029'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['target_2030'] ?? null) ?></td>
                                                                <td class="text-center <?= $clsInd ?>" title="<?= $titleInd ?>"><?= formatDesimalIndikator($indS['kondisi_akhir'] ?? ($indS['target_2030'] ?? null)) ?></td>
                                                                <td class="<?= $clsInd ?>" title="<?= $titleInd ?>">
                                                                    <?php if (!empty($indS['pd_pengampuh_names'])) { ?>
                                                                        <?php foreach ($indS['pd_pengampuh_names'] as $pdn) { ?>
                                                                            <span class="pd-tag"><?= html_escape($pdn) ?></span>
                                                                        <?php } ?>
                                                                    <?php } else if (!empty($indS['pd_pengampuh'])) { ?>
                                                                        <span class="pd-tag">ID: <?= html_escape($indS['pd_pengampuh']) ?></span>
                                                                    <?php } else { ?>
                                                                        <span class="text-muted">-</span>
                                                                    <?php } ?>

                                                                    <?php if (!empty($indS['program_pd_names'])) { ?>
                                                                        <div style="margin-top: 5px; border-top: 1px dashed #cbd5e1; padding-top: 4px;">
                                                                            <small style="color: #6b21a8; font-weight: 700; font-size: 10px; display: block; margin-bottom: 2px;">
                                                                                <i class="fa fa-folder-open-o"></i> Program PD:
                                                                            </small>
                                                                            <?php foreach ($indS['program_pd_names'] as $prgName) { ?>
                                                                                <span class="program-tag" title="<?= html_escape($prgName) ?>"><?= html_escape($prgName) ?></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>

                                                    <?php 
                                                            $noSasaran++;
                                                        } 
                                                    } 
                                                    ?>
                                                <?php 
                                                        $noTujuan++;
                                                    } 
                                                } 
                                                ?>
                                            <?php 
                                                    $noMisi++;
                                                } 
                                            } 
                                            ?>
                                        <?php 
                                                $noVisi++;
                                            } 
                                        } else { ?>
                                            <tr>
                                                <td colspan="14" class="text-center" style="padding: 30px; color: #999;">Belum ada data Visi RPJMD.</td>
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

    <!-- ============================================== -->
    <!-- MODAL INPUT VISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputVisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Visi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanVisi"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT VISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditVisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Visi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdVisiForm">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnVisi"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL TAMBAH MISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalTambahMisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Misi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdVisi">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanMisi"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT MISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditMisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Misi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdMisiForm">
                    <input type="hidden" id="_IdVisi">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnMisi"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL TAMBAH TUJUAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalTambahTujuan" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Tujuan RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdMisi">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanTujuan"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT TUJUAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditTujuan" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Tujuan RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdTujuanForm">
                    <input type="hidden" id="_IdMisi">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnTujuan"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL TAMBAH SASARAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalTambahSasaran" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Sasaran RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdTujuan">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanSasaran"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT SASARAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditSasaran" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Sasaran RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdSasaranForm">
                    <input type="hidden" id="_IdTujuan">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnSasaran"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL FORM INDIKATOR TUJUAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalIndikatorTujuan" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 id="judul_modal_tujuan">Tambah Indikator Tujuan</h2>
                    <p id="tujuan_info" style="margin-top: 10px; color: #555; font-size: 13px;"></p>
                </div>
                <div class="modal-body" style="padding-top: 15px;">
                    <input type="hidden" id="indikator_tujuan_id">
                    <input type="hidden" id="current_tujuan_id">
                    <input type="hidden" id="is_edit_tujuan" value="false">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Indikator</b> <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="input_indikator_tujuan" rows="2" placeholder="Masukkan indikator tujuan" style="resize: vertical;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Satuan</b></label>
                                <input type="text" class="form-control" id="input_satuan_tujuan" placeholder="Contoh: % / Dokumen / Indeks">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Baseline 2024</b></label>
                                <input type="text" class="form-control input-target-tujuan" id="input_baseline_tujuan" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2025</b></label>
                                <input type="text" class="form-control input-target-tujuan" id="input_target2025_tujuan" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2026</b></label>
                                <input type="text" class="form-control input-target-tujuan" id="input_target2026_tujuan" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2027</b></label>
                                <input type="text" class="form-control input-target-tujuan" id="input_target2027_tujuan" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2028</b></label>
                                <input type="text" class="form-control input-target-tujuan" id="input_target2028_tujuan" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2029</b></label>
                                <input type="text" class="form-control input-target-tujuan" id="input_target2029_tujuan" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2030</b></label>
                                <input type="text" class="form-control input-target-tujuan" id="input_target2030_tujuan" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- PD PENGGAMPUH -->
                            <div class="form-group">
                                <label><b>Perangkat Daerah Pengampuh</b></label>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm pd-table" style="margin-bottom: 5px;">
                                        <thead>
                                            <tr>
                                                <th>Nama Perangkat Daerah</th>
                                                <th width="50" class="text-center">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pd-pengampuh-tujuan-body"></tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" id="btn-tambah-pd-tujuan">
                                    <i class="fa fa-plus"></i> Tambah Perangkat Daerah
                                </button>
                                <small class="text-muted pd-info-text" style="display: block; margin-top: 5px;">
                                    Pilih Perangkat Daerah yang menjadi pengampuh indikator ini
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanIndikatorTujuan">
                        <i class="fa fa-save"></i> <span id="btn_text_tujuan">Simpan</span>
                    </button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL FORM INDIKATOR SASARAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalIndikatorSasaran" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 id="judul_modal_sasaran">Tambah Indikator Sasaran</h2>
                    <p id="sasaran_info" style="margin-top: 10px; color: #555; font-size: 13px;"></p>
                </div>
                <div class="modal-body" style="padding-top: 15px;">
                    <input type="hidden" id="indikator_sasaran_id">
                    <input type="hidden" id="current_sasaran_id">
                    <input type="hidden" id="is_edit_sasaran" value="false">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Indikator</b> <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="input_indikator_sasaran" rows="2" placeholder="Masukkan indikator sasaran" style="resize: vertical;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Satuan</b></label>
                                <input type="text" class="form-control" id="input_satuan_sasaran" placeholder="Contoh: % / Dokumen / Indeks">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Baseline 2024</b></label>
                                <input type="text" class="form-control input-target-sasaran" id="input_baseline_sasaran" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2025</b></label>
                                <input type="text" class="form-control input-target-sasaran" id="input_target2025_sasaran" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2026</b></label>
                                <input type="text" class="form-control input-target-sasaran" id="input_target2026_sasaran" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2027</b></label>
                                <input type="text" class="form-control input-target-sasaran" id="input_target2027_sasaran" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2028</b></label>
                                <input type="text" class="form-control input-target-sasaran" id="input_target2028_sasaran" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2029</b></label>
                                <input type="text" class="form-control input-target-sasaran" id="input_target2029_sasaran" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label><b>Target 2030</b></label>
                                <input type="text" class="form-control input-target-sasaran" id="input_target2030_sasaran" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- PD PENGGAMPUH -->
                            <div class="form-group">
                                <label><b>Perangkat Daerah Pengampuh</b></label>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm pd-table" style="margin-bottom: 5px;">
                                        <thead>
                                            <tr>
                                                <th>Nama Perangkat Daerah</th>
                                                <th width="50" class="text-center">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pd-pengampuh-sasaran-body"></tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" id="btn-tambah-pd-sasaran">
                                    <i class="fa fa-plus"></i> Tambah Perangkat Daerah
                                </button>
                                <small class="text-muted pd-info-text" style="display: block; margin-top: 5px;">
                                    Pilih Perangkat Daerah yang menjadi pengampuh indikator ini
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- PROGRAM PD -->
                            <div class="form-group">
                                <label><b>Program</b></label>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm pd-table" style="margin-bottom: 5px;">
                                        <thead>
                                            <tr>
                                                <th>Nama Program</th>
                                                <th width="50" class="text-center">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody id="program-sasaran-body"></tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" id="btn-tambah-program-sasaran">
                                    <i class="fa fa-plus"></i> Tambah Program
                                </button>
                                <small class="text-muted pd-info-text" style="display: block; margin-top: 5px;">
                                    Pilih Program dari Program PD yang terkait dengan indikator sasaran ini
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanIndikatorSasaran">
                        <i class="fa fa-save"></i> <span id="btn_text_sasaran">Simpan</span>
                    </button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Contextual Popover for Indikator Actions -->
    <div id="IndikatorActionPopover">
        <div class="ind-popover-header">
            <span class="ind-popover-title"><i class="fa fa-sliders"></i> <span id="popoverIndikatorTypeTitle">Opsi Indikator</span></span>
            <button type="button" class="ind-popover-close" id="btnIndikatorPopoverClose">&times;</button>
        </div>
        <div class="ind-popover-body">
            <div class="ind-popover-text" id="popoverIndikatorText"></div>
            <div class="ind-popover-actions">
                <button type="button" class="btn btn-warning btn-xs" id="btnIndikatorPopoverEdit">
                    <i class="fa fa-pencil"></i> Edit
                </button>
                <button type="button" class="btn btn-danger btn-xs" id="btnIndikatorPopoverDelete">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- SCRIPTS -->
    <!-- ============================================== -->
    <script src="<?=base_url()?>js/vendor/jquery-1.12.4.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/wow.min.js"></script>
    <script src="<?=base_url()?>js/jquery-price-slider.js"></script>
    <script src="<?=base_url()?>js/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>js/jquery.scrollUp.min.js"></script>
    <script src="<?=base_url()?>js/meanmenu/jquery.meanmenu.js"></script>
    <script src="<?=base_url()?>js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?=base_url()?>js/data-table/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>js/data-table/data-table-act.js"></script>
    <script src="<?=base_url()?>js/main.js"></script>
    
    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        var BaseURL = '<?=base_url()?>';
        var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
        var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

        // ==============================================
        // FUNGSI TOAST
        // ==============================================
        function showToast(message, type = 'error') {
            var toast = document.getElementById('toastError');
            var msgEl = document.getElementById('toastMessage');
            
            toast.className = 'toast-error';
            if (type === 'success') {
                toast.classList.add('success');
            } else {
                toast.classList.add('error');
            }
            
            msgEl.innerHTML = message;
            toast.style.display = 'block';
            
            clearTimeout(window.toastTimeout);
            window.toastTimeout = setTimeout(function() {
                toast.style.display = 'none';
            }, 4000);
        }

        function escapeHtml(text) {
            if (!text) return '';
            var div = document.createElement('div');
            div.appendChild(document.createTextNode(text));
            return div.innerHTML;
        }

        // Helper: cek apakah response server = sukses (string '1' atau JSON {status:'success'})
        function isRespSuccess(r) {
            if (r === '1' || r === 1) return true;
            try {
                var j = (typeof r === 'object') ? r : JSON.parse(r);
                return j && (j.status === 'success' || j === 1);
            } catch(e) {}
            return false;
        }

        // Helper: ambil pesan error dari response (JSON atau string)
        function parseRespError(r, fallback) {
            try {
                var j = (typeof r === 'object') ? r : JSON.parse(r);
                if (j && j.message) return j.message;
            } catch(e) {}
            return (typeof r === 'string' && r.trim() !== '') ? r : fallback;
        }

        // ==============================================
        // FUNGSI TOGGLE HIERARKI
        // ==============================================
        function toggleLevel(parentId, element) {
            var trs = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
            var parentTr = element.closest('tr');
            var isExpanded = parentTr.getAttribute('data-expanded') === 'true';

            if (isExpanded) {
                parentTr.setAttribute('data-expanded', 'false');
                hideAllChildren(parentId);
            } else {
                parentTr.setAttribute('data-expanded', 'true');
                trs.forEach(function(tr) {
                    tr.style.display = 'table-row';
                });
            }
        }

        function hideAllChildren(parentId) {
            var children = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
            children.forEach(function(child) {
                child.style.display = 'none';
                child.setAttribute('data-expanded', 'false');
                var childId = child.getAttribute('data-id');
                if (childId) {
                    hideAllChildren(childId);
                }
            });
        }

        // ==============================================
        // DATA PERANGKAT DAERAH UNTUK PD PENGGAMPUH
        // ==============================================
        var daftarPD = [];

        function loadDaftarPD() {
            $.ajax({
                url: BaseURL + "Daerah/GetListPDForIndikator",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    if (res && res.status === 'success') {
                        daftarPD = res.data;
                    }
                },
                error: function() {
                    console.log('Gagal memuat daftar PD');
                }
            });
        }

        // ==============================================
        // DATA PROGRAM PD UNTUK INDIKATOR SASARAN
        // ==============================================
        var daftarProgramPD = [];

        function loadDaftarProgramPD(callback) {
            $.ajax({
                url: BaseURL + "Daerah/GetListProgramPDForIndikator",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    if (res && res.status === 'success') {
                        daftarProgramPD = res.data;
                        var currentSelected = typeof getSelectedProgramSasaran === 'function' ? getSelectedProgramSasaran() : [];
                        if (currentSelected.length === 0 && $('#program-sasaran-body tr').length > 0) {
                            $('#program-sasaran-body').empty();
                            addProgramRowSasaran('program-sasaran-body', '');
                        }
                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                },
                error: function() {
                    console.log('Gagal memuat daftar Program PD');
                }
            });
        }

        // ==============================================
        // FUNGSI TAMBAH BARIS PD PENGGAMPUH TUJUAN
        // ==============================================
        function addPDRowTujuan(containerId, pdId = '') {
            var container = document.getElementById(containerId);
            if (!container) return;
            
            var options = '<option value="">-- Pilih Perangkat Daerah --</option>';
            if (daftarPD && daftarPD.length > 0) {
                for (var i = 0; i < daftarPD.length; i++) {
                    var selected = (String(daftarPD[i].id) === String(pdId)) ? 'selected' : '';
                    options += '<option value="' + daftarPD[i].id + '" ' + selected + '>' + 
                            escapeHtml(daftarPD[i].nama) +
                            '</option>';
                }
            } else {
                options += '<option value="" disabled>Data perangkat daerah tidak tersedia</option>';
            }
            
            var tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="text-align: left;">
                    <select class="form-control form-control-sm pd-select-tujuan" style="width: 100%; text-align: left;">
                        ${options}
                    </select>
                </td>
                <td class="text-center" style="text-align: center; vertical-align: middle;">
                    <button type="button" class="btn btn-danger btn-sm remove-pd-row"><i class="fa fa-trash"></i></button>
                </td>
            `;
            container.appendChild(tr);
            
            $(tr).find('.pd-select-tujuan').select2({
                placeholder: 'Pilih Perangkat Daerah',
                dropdownParent: $('#ModalIndikatorTujuan'),
                width: '100%'
            });
        }

        // ==============================================
        // FUNGSI TAMBAH BARIS PD PENGGAMPUH SASARAN
        // ==============================================
        function addPDRowSasaran(containerId, pdId = '') {
            var container = document.getElementById(containerId);
            if (!container) return;
            
            var options = '<option value="">-- Pilih Perangkat Daerah --</option>';
            if (daftarPD && daftarPD.length > 0) {
                for (var i = 0; i < daftarPD.length; i++) {
                    var selected = (String(daftarPD[i].id) === String(pdId)) ? 'selected' : '';
                    options += '<option value="' + daftarPD[i].id + '" ' + selected + '>' + 
                            escapeHtml(daftarPD[i].nama) +
                            '</option>';
                }
            } else {
                options += '<option value="" disabled>Data perangkat daerah tidak tersedia</option>';
            }
            
            var tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="text-align: left;">
                    <select class="form-control form-control-sm pd-select-sasaran" style="width: 100%; text-align: left;">
                        ${options}
                    </select>
                </td>
                <td class="text-center" style="text-align: center; vertical-align: middle;">
                    <button type="button" class="btn btn-danger btn-sm remove-pd-row"><i class="fa fa-trash"></i></button>
                </td>
            `;
            container.appendChild(tr);
            
            $(tr).find('.pd-select-sasaran').select2({
                placeholder: 'Pilih Perangkat Daerah',
                dropdownParent: $('#ModalIndikatorSasaran'),
                width: '100%'
            });
        }

        $(document).on('click', '.remove-pd-row', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });

        function getSelectedPDTujuan() {
            var ids = [];
            $('#pd-pengampuh-tujuan-body .pd-select-tujuan').each(function() {
                var val = $(this).val();
                if (val && val !== '') {
                    ids.push(val);
                }
            });
            return ids;
        }

        function getSelectedPDSasaran() {
            var ids = [];
            $('#pd-pengampuh-sasaran-body .pd-select-sasaran').each(function() {
                var val = $(this).val();
                if (val && val !== '') {
                    ids.push(val);
                }
            });
            return ids;
        }

        function setSelectedPDTujuan(selectedIds) {
            $('#pd-pengampuh-tujuan-body').empty();
            if (!selectedIds || selectedIds.length === 0) {
                addPDRowTujuan('pd-pengampuh-tujuan-body', '');
                return;
            }
            for (var i = 0; i < selectedIds.length; i++) {
                addPDRowTujuan('pd-pengampuh-tujuan-body', selectedIds[i]);
            }
        }

        function setSelectedPDSasaran(selectedIds) {
            $('#pd-pengampuh-sasaran-body').empty();
            if (!selectedIds || selectedIds.length === 0) {
                addPDRowSasaran('pd-pengampuh-sasaran-body', '');
                return;
            }
            for (var i = 0; i < selectedIds.length; i++) {
                addPDRowSasaran('pd-pengampuh-sasaran-body', selectedIds[i]);
            }
        }

        $(document).on('click', '#btn-tambah-pd-tujuan', function(e) {
            e.preventDefault();
            addPDRowTujuan('pd-pengampuh-tujuan-body', '');
        });

        $(document).on('click', '#btn-tambah-pd-sasaran', function(e) {
            e.preventDefault();
            addPDRowSasaran('pd-pengampuh-sasaran-body', '');
        });

        // ==============================================
        // FUNGSI TAMBAH BARIS PROGRAM SASARAN
        // ==============================================
        function addProgramRowSasaran(containerId, programId = '') {
            var container = document.getElementById(containerId);
            if (!container) return;
            
            var options = '<option value="">-- Pilih Program --</option>';
            if (daftarProgramPD && daftarProgramPD.length > 0) {
                for (var i = 0; i < daftarProgramPD.length; i++) {
                    var selected = (String(daftarProgramPD[i].id) === String(programId)) ? 'selected' : '';
                    var label = '[' + daftarProgramPD[i].kode_program + '] ' + daftarProgramPD[i].nama_program;
                    options += '<option value="' + daftarProgramPD[i].id + '" ' + selected + '>' + 
                            escapeHtml(label) +
                            '</option>';
                }
            } else {
                options += '<option value="" disabled>Data program tidak tersedia</option>';
            }
            
            var tr = document.createElement('tr');
            tr.innerHTML = `
                <td style="text-align: left;">
                    <select class="form-control form-control-sm program-select-sasaran" style="width: 100%; text-align: left;">
                        ${options}
                    </select>
                </td>
                <td class="text-center" style="text-align: center; vertical-align: middle;">
                    <button type="button" class="btn btn-danger btn-sm remove-program-row"><i class="fa fa-trash"></i></button>
                </td>
            `;
            container.appendChild(tr);
            
            $(tr).find('.program-select-sasaran').select2({
                placeholder: 'Pilih Program',
                dropdownParent: $('#ModalIndikatorSasaran'),
                width: '100%'
            });
        }

        $(document).on('click', '.remove-program-row', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });

        function getSelectedProgramSasaran() {
            var ids = [];
            $('#program-sasaran-body .program-select-sasaran').each(function() {
                var val = $(this).val();
                if (val && val !== '') {
                    ids.push(val);
                }
            });
            return ids;
        }

        function setSelectedProgramSasaran(selectedIds) {
            $('#program-sasaran-body').empty();
            if (!selectedIds || selectedIds.length === 0) {
                addProgramRowSasaran('program-sasaran-body', '');
                return;
            }
            for (var i = 0; i < selectedIds.length; i++) {
                addProgramRowSasaran('program-sasaran-body', selectedIds[i]);
            }
        }

        $(document).on('click', '#btn-tambah-program-sasaran', function(e) {
            e.preventDefault();
            addProgramRowSasaran('program-sasaran-body', '');
        });

        // ==============================================
        // RESET FORM INDIKATOR
        // ==============================================
        function resetFormTujuan() {
            $('#indikator_tujuan_id').val('');
            $('#input_indikator_tujuan').val('');
            $('#input_satuan_tujuan').val('');
            $('#input_baseline_tujuan').val('');
            $('.input-target-tujuan').val('');
            $('#pd-pengampuh-tujuan-body').empty();
            addPDRowTujuan('pd-pengampuh-tujuan-body', '');
            $('#is_edit_tujuan').val('false');
            $('#judul_modal_tujuan').text('Tambah Indikator Tujuan');
            $('#btn_text_tujuan').text('Simpan');
            $('#SimpanIndikatorTujuan').removeClass('btn-warning').addClass('btn-success');
        }

        function resetFormSasaran() {
            $('#indikator_sasaran_id').val('');
            $('#input_indikator_sasaran').val('');
            $('#input_satuan_sasaran').val('');
            $('#input_baseline_sasaran').val('');
            $('.input-target-sasaran').val('');
            $('#pd-pengampuh-sasaran-body').empty();
            addPDRowSasaran('pd-pengampuh-sasaran-body', '');
            $('#program-sasaran-body').empty();
            addProgramRowSasaran('program-sasaran-body', '');
            $('#is_edit_sasaran').val('false');
            $('#judul_modal_sasaran').text('Tambah Indikator Sasaran');
            $('#btn_text_sasaran').text('Simpan');
            $('#SimpanIndikatorSasaran').removeClass('btn-warning').addClass('btn-success');
        }

        // ==============================================
        // DOCUMENT READY
        // ==============================================
        $(document).ready(function() {
            loadDaftarPD();
            loadDaftarProgramPD();

            // Toggle Buka / Tutup Semua
            var allExpanded = true;
            $('#btnToggleAll').click(function() {
                if (allExpanded) {
                    // Tutup Misi, Tujuan, Sasaran
                    $('#hierarki-table tbody tr.row-misi, #hierarki-table tbody tr.row-tujuan, #hierarki-table tbody tr.row-sasaran').hide().attr('data-expanded', 'false');
                    $('#hierarki-table tbody tr.row-visi').attr('data-expanded', 'false');
                    $('#toggleAllText').text('Buka Semua');
                    allExpanded = false;
                } else {
                    // Buka Semua
                    $('#hierarki-table tbody tr').show().attr('data-expanded', 'true');
                    $('#toggleAllText').text('Tutup Semua');
                    allExpanded = true;
                }
            });

            // ==============================================
            // FILTER WILAYAH
            // ==============================================
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
            $("#Provinsi").change(function() {
                if ($(this).val() === "") {
                    $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                    return;
                }
                $.ajax({
                    url: BaseURL + "Daerah/GetListKabKota",
                    type: "POST",
                    data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
                    beforeSend: function() { 
                        $("#KabKota").prop('disabled', true);
                        $("#KabKota").html('<option value="">Memuat...</option>');
                    },
                    success: function(Respon) {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                            }
                        }
                        $("#KabKota").html(KabKota).prop('disabled', false);
                    },
                    error: function() {
                        $("#KabKota").html('<option value="">Gagal memuat data</option>').prop('disabled', false);
                    }
                });
            });

            $("#Filter").click(function() {
                if ($("#Provinsi").val() === "") {
                    showToast("Mohon Pilih Provinsi", "error");
                    return;
                }
                if ($("#KabKota").val() === "") {
                    showToast("Mohon Pilih Kab/Kota", "error");
                    return;
                }
                
                var kodeWilayah = $("#KabKota").val();
                $("#Filter").prop('disabled', true).html('<span class="spinner-border-sm" role="status"></span> Memuat...');
                
                $.ajax({
                    url: BaseURL + "Daerah/SetTempKodeWilayah",
                    type: "POST",
                    data: { 
                        KodeWilayah: kodeWilayah, 
                        [CSRF_NAME]: CSRF_TOKEN 
                    },
                    success: function(Respon) {
                        if (Respon.trim() === '1' || Respon.trim() === 'success') {
                            window.location.href = BaseURL + "Daerah/VisiRPJMD";
                        } else {
                            showToast(Respon || "Gagal menyimpan filter wilayah!", "error");
                            $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                        }
                    },
                    error: function() {
                        showToast("Gagal menghubungi server!", "error");
                        $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                    }
                });
            });

            <?php if (!empty($KodeWilayah)) { ?>
                var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
                var kodeKab = "<?= $KodeWilayah ?>";
                $("#Provinsi").val(kodeProv);
                $.ajax({
                    url: BaseURL + "Daerah/GetListKabKota",
                    type: "POST",
                    data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
                    success: function(Respon) {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                                KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                            }
                        }
                        $("#KabKota").html(KabKota);
                    }
                });
            <?php } ?>
            <?php } ?>

            // ==============================================
            // CRUD VISI
            // ==============================================
            $("#SimpanVisi").click(function() {
                var visi = $("#Visi").val().trim();
                if (visi === "") {
                    showToast('Visi harus diisi!', 'error');
                    return;
                }
                
                var data = {
                    Visi: visi,
                    [CSRF_NAME]: CSRF_TOKEN
                };

                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/InputVisiRPJMD", data, function(Respon) {
                    var isSuccess = (Respon == '1');
                    try {
                        var json = (typeof Respon === 'object') ? Respon : JSON.parse(Respon);
                        if (json && (json.status === 'success' || json == 1)) {
                            isSuccess = true;
                        }
                    } catch(e) {}

                    if (isSuccess) {
                        location.reload();
                    } else if (Respon == '2') {
                        showToast('Gagal: Periode tahun sudah ada!', 'error');
                    } else {
                        var msg = Respon;
                        try {
                            var jsonErr = (typeof Respon === 'object') ? Respon : JSON.parse(Respon);
                            if (jsonErr && jsonErr.message) msg = jsonErr.message;
                        } catch(e) {}
                        showToast(msg || 'Gagal Menyimpan Visi RPJMD!', 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditVisi', function() {
                $("#IdVisiForm").val($(this).data('id'));
                $("#_Visi").val($(this).data('visi'));
                $("#ModalEditVisi").modal('show');
            });

            $("#EditBtnVisi").click(function() {
                var visi = $("#_Visi").val().trim();
                if (visi === "") {
                    showToast('Visi harus diisi!', 'error');
                    return;
                }
                
                var data = {
                    Id: $("#IdVisiForm").val(),
                    Visi: visi,
                    [CSRF_NAME]: CSRF_TOKEN
                };

                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/EditVisiRPJMD", data, function(Respon) {
                    var isSuccess = (Respon == '1');
                    try {
                        var json = (typeof Respon === 'object') ? Respon : JSON.parse(Respon);
                        if (json && (json.status === 'success' || json == 1)) {
                            isSuccess = true;
                        }
                    } catch(e) {}

                    if (isSuccess) {
                        location.reload();
                    } else {
                        var msg = Respon;
                        try {
                            var jsonErr = (typeof Respon === 'object') ? Respon : JSON.parse(Respon);
                            if (jsonErr && jsonErr.message) msg = jsonErr.message;
                        } catch(e) {}
                        showToast(msg || 'Gagal Mengupdate Visi RPJMD!', 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusVisi', function() {
                var id = $(this).data('id');
                var data = { Id: id, [CSRF_NAME]: CSRF_TOKEN };
                $.post(BaseURL + "Daerah/HapusVisiRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        showToast(parseRespError(Respon, 'Gagal Menghapus Visi RPJMD!'), 'error');
                    }
                });
            });

            // ==============================================
            // CRUD MISI
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahMisi', function() {
                var visiId = $(this).data('id');
                $("#IdVisi").val(visiId);
                $("#Misi").val("");
                $("#ModalTambahMisi").modal('show');
            });

            $("#SimpanMisi").click(function() {
                if ($("#Misi").val() == "") {
                    showToast('Misi harus diisi!', 'error');
                    return;
                }
                var data = {
                    _Id: $("#IdVisi").val(),
                    Misi: $("#Misi").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/InputMisiRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                        showToast(parseRespError(Respon, 'Gagal Menyimpan Misi RPJMD!'), 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditMisi', function() {
                $("#IdMisiForm").val($(this).data('id'));
                $("#_IdVisi").val($(this).data('idvisi'));
                $("#_Misi").val($(this).data('misi'));
                $("#ModalEditMisi").modal('show');
            });

            $("#EditBtnMisi").click(function() {
                if ($("#_Misi").val() == "") {
                    showToast('Misi harus diisi!', 'error');
                    return;
                }
                var data = {
                    Id: $("#IdMisiForm").val(),
                    _Id: $("#_IdVisi").val(),
                    Misi: $("#_Misi").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/EditMisiRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                        showToast(parseRespError(Respon, 'Gagal Mengupdate Misi RPJMD!'), 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusMisi', function() {
                var id = $(this).data('id');
                var data = { Id: id, [CSRF_NAME]: CSRF_TOKEN };
                $.post(BaseURL + "Daerah/HapusMisiRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        showToast(parseRespError(Respon, 'Gagal Menghapus Misi RPJMD!'), 'error');
                    }
                });
            });

            // ==============================================
            // CRUD TUJUAN
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahTujuan', function() {
                var misiId = $(this).data('id');
                $("#IdMisi").val(misiId);
                $("#Tujuan").val("");
                $("#ModalTambahTujuan").modal('show');
            });

            $("#SimpanTujuan").click(function() {
                if ($("#Tujuan").val() == "") {
                    showToast('Tujuan harus diisi!', 'error');
                    return;
                }
                var data = {
                    _Id: $("#IdMisi").val(),
                    Tujuan: $("#Tujuan").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/InputTujuanRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                        showToast(parseRespError(Respon, 'Gagal Menyimpan Tujuan RPJMD!'), 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditTujuan', function() {
                $("#IdTujuanForm").val($(this).data('id'));
                $("#_IdMisi").val($(this).data('idmisi'));
                $("#_Tujuan").val($(this).data('tujuan'));
                $("#ModalEditTujuan").modal('show');
            });

            $("#EditBtnTujuan").click(function() {
                if ($("#_Tujuan").val() == "") {
                    showToast('Tujuan harus diisi!', 'error');
                    return;
                }
                var data = {
                    Id: $("#IdTujuanForm").val(),
                    _Id: $("#_IdMisi").val(),
                    Tujuan: $("#_Tujuan").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/EditTujuanRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                        showToast(parseRespError(Respon, 'Gagal Mengupdate Tujuan RPJMD!'), 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusTujuan', function() {
                var id = $(this).data('id');
                var data = { Id: id, [CSRF_NAME]: CSRF_TOKEN };
                $.post(BaseURL + "Daerah/HapusTujuanRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        showToast(parseRespError(Respon, 'Gagal Menghapus Tujuan RPJMD!'), 'error');
                    }
                });
            });

            // ==============================================
            // CRUD SASARAN
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahSasaran', function() {
                var tujuanId = $(this).data('id');
                $("#IdTujuan").val(tujuanId);
                $("#Sasaran").val("");
                $("#ModalTambahSasaran").modal('show');
            });

            $("#SimpanSasaran").click(function() {
                if ($("#Sasaran").val() == "") {
                    showToast('Sasaran harus diisi!', 'error');
                    return;
                }
                var data = {
                    _Id: $("#IdTujuan").val(),
                    Sasaran: $("#Sasaran").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/InputSasaranRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                        showToast(parseRespError(Respon, 'Gagal Menyimpan Sasaran RPJMD!'), 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditSasaran', function() {
                $("#IdSasaranForm").val($(this).data('id'));
                $("#_IdTujuan").val($(this).data('idtujuan'));
                $("#_Sasaran").val($(this).data('sasaran'));
                $("#ModalEditSasaran").modal('show');
            });

            $("#EditBtnSasaran").click(function() {
                if ($("#_Sasaran").val() == "") {
                    showToast('Sasaran harus diisi!', 'error');
                    return;
                }
                var data = {
                    Id: $("#IdSasaranForm").val(),
                    _Id: $("#_IdTujuan").val(),
                    Sasaran: $("#_Sasaran").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.post(BaseURL + "Daerah/EditSasaranRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                        showToast(parseRespError(Respon, 'Gagal Mengupdate Sasaran RPJMD!'), 'error');
                    }
                }).fail(function() {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusSasaran', function() {
                var id = $(this).data('id');
                var data = { Id: id, [CSRF_NAME]: CSRF_TOKEN };
                $.post(BaseURL + "Daerah/HapusSasaranRPJMD", data, function(Respon) {
                    if (isRespSuccess(Respon)) {
                        location.reload();
                    } else {
                        showToast(parseRespError(Respon, 'Gagal Menghapus Sasaran RPJMD!'), 'error');
                    }
                });
            });

            // Helper function to clean target input (support text and numbers)
            function cleanDecimalInput(val) {
                if (val === null || val === undefined) return null;
                val = String(val).trim();
                if (val === '' || val === '-') return null;
                return val;
            }

            // ==============================================
            // INDIKATOR TUJUAN - TAMBAH DIRECT & SIMPAN
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahIndikatorTujuanDirect', function() {
                var tujuanId = $(this).data('tujuan-id');
                var tujuanText = $(this).data('tujuan-text') || '';
                
                resetFormTujuan();
                $('#current_tujuan_id').val(tujuanId);
                $('#tujuan_info').html('<strong>Tujuan:</strong> ' + escapeHtml(tujuanText));
                $('#ModalIndikatorTujuan').modal('show');
            });

            $("#SimpanIndikatorTujuan").click(function() {
                var indikator = $('#input_indikator_tujuan').val().trim();
                if (indikator === '') {
                    showToast('Indikator harus diisi!', 'error');
                    return;
                }
                
                var pdValues = getSelectedPDTujuan();
                var tujuanId = $('#current_tujuan_id').val();
                var isEdit = $('#is_edit_tujuan').val() === 'true';
                var editId = $('#indikator_tujuan_id').val();
                
                var data = {
                    tujuan_id: tujuanId,
                    indikator: indikator,
                    satuan: $('#input_satuan_tujuan').val().trim(),
                    baseline_2024: cleanDecimalInput($('#input_baseline_tujuan').val()),
                    target_2025: cleanDecimalInput($('#input_target2025_tujuan').val()),
                    target_2026: cleanDecimalInput($('#input_target2026_tujuan').val()),
                    target_2027: cleanDecimalInput($('#input_target2027_tujuan').val()),
                    target_2028: cleanDecimalInput($('#input_target2028_tujuan').val()),
                    target_2029: cleanDecimalInput($('#input_target2029_tujuan').val()),
                    target_2030: cleanDecimalInput($('#input_target2030_tujuan').val()),
                    pd_pengampuh: pdValues,
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                var url = isEdit ? 'EditIndikatorTujuan' : 'InputIndikatorTujuan';
                if (isEdit) data.id = editId;
                
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.ajax({
                    url: BaseURL + "Daerah/" + url,
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(result) {
                        if (result.status === 'success') {
                            location.reload();
                        } else {
                            btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_tujuan">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                            showToast('❌ ' + result.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_tujuan">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                        showToast('❌ Gagal menyimpan: ' + xhr.status + ' - ' + xhr.statusText, 'error');
                    }
                });
            });

            // ==============================================
            // INDIKATOR SASARAN - TAMBAH DIRECT & SIMPAN
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahIndikatorSasaranDirect', function() {
                var sasaranId = $(this).data('sasaran-id');
                var sasaranText = $(this).data('sasaran-text') || '';
                
                resetFormSasaran();
                $('#current_sasaran_id').val(sasaranId);
                $('#sasaran_info').html('<strong>Sasaran:</strong> ' + escapeHtml(sasaranText));
                $('#ModalIndikatorSasaran').modal('show');
            });

            $("#SimpanIndikatorSasaran").click(function() {
                var indikator = $('#input_indikator_sasaran').val().trim();
                if (indikator === '') {
                    showToast('Indikator harus diisi!', 'error');
                    return;
                }
                
                var pdValues = getSelectedPDSasaran();
                var programValues = getSelectedProgramSasaran();
                var sasaranId = $('#current_sasaran_id').val();
                var isEdit = $('#is_edit_sasaran').val() === 'true';
                var editId = $('#indikator_sasaran_id').val();
                
                var data = {
                    sasaran_id: sasaranId,
                    indikator: indikator,
                    satuan: $('#input_satuan_sasaran').val().trim(),
                    baseline_2024: cleanDecimalInput($('#input_baseline_sasaran').val()),
                    target_2025: cleanDecimalInput($('#input_target2025_sasaran').val()),
                    target_2026: cleanDecimalInput($('#input_target2026_sasaran').val()),
                    target_2027: cleanDecimalInput($('#input_target2027_sasaran').val()),
                    target_2028: cleanDecimalInput($('#input_target2028_sasaran').val()),
                    target_2029: cleanDecimalInput($('#input_target2029_sasaran').val()),
                    target_2030: cleanDecimalInput($('#input_target2030_sasaran').val()),
                    pd_pengampuh: pdValues,
                    program_pd: programValues,
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                var url = isEdit ? 'EditIndikatorSasaran' : 'InputIndikatorSasaran';
                if (isEdit) data.id = editId;
                
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.ajax({
                    url: BaseURL + "Daerah/" + url,
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(result) {
                        if (result.status === 'success') {
                            location.reload();
                        } else {
                            btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_sasaran">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                            showToast('❌ ' + result.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_sasaran">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                        showToast('❌ Gagal menyimpan: ' + xhr.status + ' - ' + xhr.statusText, 'error');
                    }
                });
            });

            // ==============================================
            // CONTEXTUAL POPOVER UNTUK AKSI INDIKATOR (KLIK FIELD)
            // ==============================================
            var activeIndikatorData = null;
            var activeIndikatorCell = null;

            function hideIndikatorPopover() {
                $('#IndikatorActionPopover').hide();
                activeIndikatorCell = null;
                activeIndikatorData = null;
            }

            $('#btnIndikatorPopoverClose').on('click', function(e) {
                e.stopPropagation();
                hideIndikatorPopover();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#IndikatorActionPopover').length && !$(e.target).closest('.clickable-indikator').length) {
                    hideIndikatorPopover();
                }
            });

            $(document).on('keydown', function(e) {
                if (e.key === "Escape" || e.keyCode === 27) {
                    hideIndikatorPopover();
                }
            });

            $(window).on('resize scroll', function() {
                if ($('#IndikatorActionPopover').is(':visible')) {
                    hideIndikatorPopover();
                }
            });

            // Click handler on ANY indicator cell (from Indikator to PD Pengampuh)
            $('#hierarki-table tbody').on('click', 'td.clickable-indikator', function(e) {
                e.stopPropagation();
                var cell = $(this);
                var row = cell.closest('tr');
                var mainCell = row.find('td.clickable-indikator[data-id]');
                if (!mainCell.length) mainCell = cell;

                if (activeIndikatorCell && activeIndikatorCell[0] === cell[0] && $('#IndikatorActionPopover').is(':visible')) {
                    hideIndikatorPopover();
                    return;
                }

                activeIndikatorCell = cell;

                var indType = mainCell.data('type') || 'tujuan';
                var indId = mainCell.data('id');
                var parentId = mainCell.data('parent-id');
                var indikator = mainCell.data('indikator') || '';
                
                activeIndikatorData = {
                    type: indType,
                    id: indId,
                    parentId: parentId,
                    parentText: mainCell.data('parent-text') || '',
                    indikator: indikator,
                    satuan: mainCell.data('satuan') || '',
                    baseline: mainCell.data('baseline') || '',
                    t2025: mainCell.data('t2025') || '',
                    t2026: mainCell.data('t2026') || '',
                    t2027: mainCell.data('t2027') || '',
                    t2028: mainCell.data('t2028') || '',
                    t2029: mainCell.data('t2029') || '',
                    t2030: mainCell.data('t2030') || '',
                    pd: mainCell.data('pd') || '',
                    program_pd: mainCell.data('program-pd') || ''
                };

                $('#popoverIndikatorTypeTitle').text(indType === 'sasaran' ? 'Opsi Indikator Sasaran' : 'Opsi Indikator Tujuan');
                $('#popoverIndikatorText').text(indikator);

                var popover = $('#IndikatorActionPopover');
                popover.show();

                var cellOffset = cell.offset();
                var cellWidth = cell.outerWidth();
                var cellHeight = cell.outerHeight();
                var popoverWidth = popover.outerWidth();
                var popoverHeight = popover.outerHeight();

                var topPos = cellOffset.top + cellHeight + 6;
                var leftPos = cellOffset.left + (cellWidth / 2) - (popoverWidth / 2);

                if (leftPos < 10) leftPos = 10;
                else if (leftPos + popoverWidth > $(window).width() - 20) leftPos = $(window).width() - popoverWidth - 20;

                if (topPos + popoverHeight > $(window).scrollTop() + $(window).height()) topPos = cellOffset.top - popoverHeight - 6;

                popover.css({ top: topPos + 'px', left: leftPos + 'px' });
            });

            $('#btnIndikatorPopoverEdit').on('click', function() {
                if (!activeIndikatorData) return;
                var data = activeIndikatorData;
                hideIndikatorPopover();

                if (data.type === 'tujuan') {
                    resetFormTujuan();
                    $('#indikator_tujuan_id').val(data.id);
                    $('#current_tujuan_id').val(data.parentId);
                    $('#is_edit_tujuan').val('true');
                    $('#judul_modal_tujuan').text('Edit Indikator Tujuan');
                    $('#btn_text_tujuan').text('Update');
                    $('#SimpanIndikatorTujuan').removeClass('btn-success').addClass('btn-warning');
                    $('#tujuan_info').html('<strong>Tujuan:</strong> ' + escapeHtml(data.parentText || ''));
                    $('#input_indikator_tujuan').val(data.indikator);
                    $('#input_satuan_tujuan').val(data.satuan);
                    $('#input_baseline_tujuan').val(data.baseline);
                    $('#input_target2025_tujuan').val(data.t2025);
                    $('#input_target2026_tujuan').val(data.t2026);
                    $('#input_target2027_tujuan').val(data.t2027);
                    $('#input_target2028_tujuan').val(data.t2028);
                    $('#input_target2029_tujuan').val(data.t2029);
                    $('#input_target2030_tujuan').val(data.t2030);
                    var pdList = data.pd ? String(data.pd).split(',').map(function(s) { return s.trim(); }).filter(Boolean) : [];
                    setSelectedPDTujuan(pdList);
                    $('#ModalIndikatorTujuan').modal('show');
                } else {
                    resetFormSasaran();
                    $('#indikator_sasaran_id').val(data.id);
                    $('#current_sasaran_id').val(data.parentId);
                    $('#is_edit_sasaran').val('true');
                    $('#judul_modal_sasaran').text('Edit Indikator Sasaran');
                    $('#btn_text_sasaran').text('Update');
                    $('#SimpanIndikatorSasaran').removeClass('btn-success').addClass('btn-warning');
                    $('#sasaran_info').html('<strong>Sasaran:</strong> ' + escapeHtml(data.parentText || ''));
                    $('#input_indikator_sasaran').val(data.indikator);
                    $('#input_satuan_sasaran').val(data.satuan);
                    $('#input_baseline_sasaran').val(data.baseline);
                    $('#input_target2025_sasaran').val(data.t2025);
                    $('#input_target2026_sasaran').val(data.t2026);
                    $('#input_target2027_sasaran').val(data.t2027);
                    $('#input_target2028_sasaran').val(data.t2028);
                    $('#input_target2029_sasaran').val(data.t2029);
                    $('#input_target2030_sasaran').val(data.t2030);
                    var pdList = data.pd ? String(data.pd).split(',').map(function(s) { return s.trim(); }).filter(Boolean) : [];
                    setSelectedPDSasaran(pdList);
                    var prgList = data.program_pd ? String(data.program_pd).split(',').map(function(s) { return s.trim(); }).filter(Boolean) : [];
                    if (daftarProgramPD && daftarProgramPD.length > 0) {
                        setSelectedProgramSasaran(prgList);
                    } else {
                        loadDaftarProgramPD(function() {
                            setSelectedProgramSasaran(prgList);
                        });
                    }
                    $('#ModalIndikatorSasaran').modal('show');
                }
            });

            $('#btnIndikatorPopoverDelete').on('click', function() {
                if (!activeIndikatorData) return;
                var data = activeIndikatorData;
                hideIndikatorPopover();

                var url = data.type === 'tujuan' ? 'HapusIndikatorTujuan' : 'HapusIndikatorSasaran';
                $.post(BaseURL + "Daerah/" + url, { id: data.id, [CSRF_NAME]: CSRF_TOKEN }, function(Respon) {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        location.reload();
                    } else {
                        showToast('❌ ' + result.message, 'error');
                    }
                });
            });

        });
    </script>

</body>
</html>