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
            width: 95% !important;
            max-width: 1200px !important;
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

        #hierarki-table > thead > tr > th {
            background-color: #f8f9fa;
            color: #455a64;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e0e0e0;
            vertical-align: middle;
        }
        #hierarki-table > tbody > tr > td {
            vertical-align: middle;
            color: #444;
            border-top: 1px solid #f2f2f2;
        }
        
        #hierarki-table > tbody > tr > td:nth-child(2) {
            padding-left: 15px !important;
            padding-right: 15px !important;
            text-align: left !important;
        }
        
        #hierarki-table > tbody > tr {
            transition: filter 0.2s ease;
        }
        #hierarki-table > tbody > tr:hover {
            filter: brightness(0.96);
        }

        .btn-action {
            border-radius: 5px;
            margin: 0 2px;
            transition: all 0.3s ease;
            padding: 5px 10px;
            font-weight: 600;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
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
            gap: 4px;
            justify-content: center;
            align-items: center;
        }
        .btn-aksi-group .btn-action {
            margin: 1px;
            padding: 4px 8px;
            font-size: 12px;
            white-space: nowrap;
        }
        .btn-aksi-group .btn-action i {
            margin-right: 3px;
        }

        .badge-periode {
            background-color: #00c292;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 194, 146, 0.3);
        }

        .badge-periode.level2 {
            background-color: #00bcd4;
            box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);
        }
        .badge-periode.level3 {
            background-color: #ff9800;
            box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);
        }
        .badge-periode.level4 {
            background-color: #9e9e9e;
            box-shadow: 0 2px 5px rgba(158, 158, 158, 0.3);
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
            padding: 6px 0;
        }
        
        .td-content-wrapper .text-content {
            display: block;
            word-wrap: break-word;
            word-break: break-word;
            line-height: 1.6;
            text-align: left !important;
        }
        
        .td-content-wrapper .text-content .label-text {
            display: inline;
        }
        
        .td-content-wrapper .text-content .label-text b {
            white-space: nowrap;
        }

        .row-visi { background-color: #f1f8e9 !important; }
        .row-misi { background-color: #e0f7fa !important; }
        .row-tujuan { background-color: #fff3e0 !important; }
        .row-sasaran { background-color: #ffffff !important; }
        
        .border-visi { border-left: 4px solid #8bc34a !important; }
        .border-misi { border-left: 4px solid #00bcd4 !important; }
        .border-tujuan { border-left: 4px solid #ff9800 !important; }
        .border-sasaran { border-left: 4px solid #9e9e9e !important; }

        .clickable-row {
            cursor: pointer;
        }
        .clickable-row:hover {
            background-color: rgba(0,0,0,0.02);
        }

        /* Tabel Indikator */
        #tabel-indikator-tujuan thead th,
        #tabel-indikator-sasaran thead th {
            font-size: 11px;
            padding: 8px 5px;
            text-align: center;
            vertical-align: middle;
        }
        #tabel-indikator-tujuan tbody td,
        #tabel-indikator-sasaran tbody td {
            padding: 8px 5px;
            vertical-align: middle;
            font-size: 13px;
        }
        #tabel-indikator-tujuan tbody td:first-child,
        #tabel-indikator-sasaran tbody td:first-child {
            text-align: left;
        }
        .table-indikator-wrapper {
            max-height: 400px;
            overflow-y: auto;
        }
        .badge-indikator-count {
            background: #2196F3;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 11px;
            margin-left: 5px;
        }

        /* PD Multi-Select Styles */
        .pd-multiselect {
            width: 100%;
            min-height: 80px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background: white;
        }
        .pd-multiselect option {
            padding: 6px 10px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
        }
        .pd-multiselect option:checked {
            background: #00c292;
            color: white;
        }
        .pd-multiselect option:checked:hover {
            background: #00b386;
        }
        .pd-multiselect option .pd-level-badge {
            float: right;
            font-size: 10px;
            color: #999;
            margin-left: 10px;
        }
        .pd-multiselect option:checked .pd-level-badge {
            color: rgba(255,255,255,0.8);
        }

        .pd-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 8px;
            min-height: 20px;
        }

        .pd-tag {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            border: 1px solid #c8e6c9;
            animation: tagIn 0.3s ease;
        }

        @keyframes tagIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .pd-tag .remove-pd {
            margin-left: 6px;
            cursor: pointer;
            color: #c62828;
            font-weight: bold;
            font-size: 14px;
            line-height: 1;
        }
        .pd-tag .remove-pd:hover {
            color: #d32f2f;
            transform: scale(1.2);
        }

        .pd-info-text {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Aksi Indikator - Berdampingan */
        .aksi-indikator {
            display: flex;
            gap: 3px;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
        }
        .aksi-indikator .btn-action {
            padding: 3px 7px;
            font-size: 12px;
            margin: 0;
        }
        .aksi-indikator .btn-action i {
            margin: 0;
        }

        @media (max-width: 768px) {
            .aksi-indikator {
                flex-wrap: wrap;
            }
            .aksi-indikator .btn-action {
                padding: 2px 5px;
                font-size: 10px;
            }
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
            <div class="container">
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
                            <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                                <div class="button-icon-btn sm-res-mg-t-30">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputVisi" style="padding: 8px 15px;">
                                        <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Visi RPJMD</b>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- TABEL HIERARKI -->
                            <div class="table-responsive">
                                <table id="hierarki-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;" class="text-center">No</th>
                                            <th style="width: 40%;">Uraian (Visi / Misi / Tujuan / Sasaran)</th>
                                            <th style="width: 10%;" class="text-center">Periode</th>
                                            <th style="width: 8%;" class="text-center">Indikator</th>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width: 37%;" class="text-center">Aksi</th>
                                            <?php } ?>
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
                                            <tr data-id="visi-<?= $visi['Id'] ?>" data-parent="" data-expanded="false" class="row-visi">
                                                <td class="text-center" style="font-size: 14px;"><b><?= $noVisi ?></b></td>
                                                <td style="cursor: pointer; padding-left: 15px !important;" class="border-visi clickable-row" onclick="toggleLevel('visi-<?= $visi['Id'] ?>', this)">
                                                    <div class="td-content-wrapper">
                                                        <div class="text-content">
                                                            <span class="label-text"><b>VISI:</b> </span>
                                                            <?= html_escape($visi['Visi']) ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-periode"><?= $visi['TahunMulai'] . ' - ' . $visi['TahunAkhir'] ?></span>
                                                </td>
                                                <td class="text-center">-</td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td class="text-center">
                                                    <div class="btn-aksi-group">
                                                        <button class="btn btn-sm btn-success TambahMisi btn-action" data-id="<?= $visi['Id'] ?>" title="Tambah Misi"><i class="fa fa-plus"></i> Misi</button>
                                                        <button class="btn btn-sm btn-warning EditVisi btn-action" data-id="<?= $visi['Id'] ?>" data-visi="<?= html_escape($visi['Visi']) ?>" data-awal="<?= $visi['TahunMulai'] ?>" data-akhir="<?= $visi['TahunAkhir'] ?>" title="Edit Visi"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger HapusVisi btn-action" data-id="<?= $visi['Id'] ?>" title="Hapus Visi"><i class="fa fa-trash"></i></button>
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
                                                <tr data-id="misi-<?= $misi['Id'] ?>" data-parent="visi-<?= $visi['Id'] ?>" data-expanded="false" style="display: none;" class="row-misi">
                                                    <td></td>
                                                    <td style="cursor: pointer; padding-left: 15px !important;" class="border-misi clickable-row" onclick="toggleLevel('misi-<?= $misi['Id'] ?>', this)">
                                                        <div class="td-content-wrapper">
                                                            <div class="text-content">
                                                                <span class="label-text"><b style="color: #00838f;">MISI <?= $noMisi ?>:</b> </span>
                                                                <?= html_escape($misi['Misi']) ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge-periode level2"><?= $misi['TahunMulai'] . ' - ' . $misi['TahunAkhir'] ?></span>
                                                    </td>
                                                    <td class="text-center">-</td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <td class="text-center">
                                                        <div class="btn-aksi-group">
                                                            <button class="btn btn-sm btn-success TambahTujuan btn-action" data-id="<?= $misi['Id'] ?>" title="Tambah Tujuan"><i class="fa fa-plus"></i> Tujuan</button>
                                                            <button class="btn btn-sm btn-warning EditMisi btn-action" data-id="<?= $misi['Id'] ?>" data-idvisi="<?= $visi['Id'] ?>" data-misi="<?= html_escape($misi['Misi']) ?>" title="Edit Misi"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-danger HapusMisi btn-action" data-id="<?= $misi['Id'] ?>" title="Hapus Misi"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                </tr>

                                                <?php 
                                                if(!empty($tujuanData)) {
                                                    $noTujuan = 1;
                                                    foreach ($tujuanData as $tujuan) { 
                                                        $sasaranData = isset($tujuan['Sasaran']) ? $tujuan['Sasaran'] : [];
                                                ?>
                                                    <!-- LEVEL 3: TUJUAN -->
                                                    <tr data-id="tujuan-<?= $tujuan['Id'] ?>" data-parent="misi-<?= $misi['Id'] ?>" data-expanded="false" style="display: none;" class="row-tujuan">
                                                        <td></td>
                                                        <td style="cursor: pointer; padding-left: 15px !important;" class="border-tujuan clickable-row" onclick="toggleLevel('tujuan-<?= $tujuan['Id'] ?>', this)">
                                                            <div class="td-content-wrapper">
                                                                <div class="text-content">
                                                                    <span class="label-text"><b style="color: #ef6c00;">TUJUAN <?= $noMisi . '.' . $noTujuan ?>:</b> </span>
                                                                    <?= html_escape($tujuan['Tujuan']) ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge-periode level3"><?= $tujuan['TahunMulai'] . ' - ' . $tujuan['TahunAkhir'] ?></span>
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-info btn-action IndikatorTujuan" data-id="<?= $tujuan['Id'] ?>" title="Kelola Indikator">
                                                                <i class="fa fa-bar-chart"></i> 
                                                                <span class="badge-indikator-count" id="indikator-count-tujuan-<?= $tujuan['Id'] ?>">0</span>
                                                            </button>
                                                        </td>
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <td class="text-center">
                                                            <div class="btn-aksi-group">
                                                                <button class="btn btn-sm btn-success TambahSasaran btn-action" data-id="<?= $tujuan['Id'] ?>" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                                <button class="btn btn-sm btn-warning EditTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" data-idmisi="<?= $misi['Id'] ?>" data-tujuan="<?= html_escape($tujuan['Tujuan']) ?>" title="Edit Tujuan"><i class="fa fa-edit"></i></button>
                                                                <button class="btn btn-sm btn-danger HapusTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" title="Hapus Tujuan"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>

                                                    <?php 
                                                    if(!empty($sasaranData)) {
                                                        $noSasaran = 1;
                                                        foreach ($sasaranData as $sasaran) { 
                                                    ?>
                                                        <!-- LEVEL 4: SASARAN -->
                                                        <tr data-id="sasaran-<?= $sasaran['Id'] ?>" data-parent="tujuan-<?= $tujuan['Id'] ?>" data-expanded="false" style="display: none;" class="row-sasaran">
                                                            <td></td>
                                                            <td style="padding-left: 15px !important;" class="border-sasaran">
                                                                <div class="td-content-wrapper">
                                                                    <div class="text-content">
                                                                        <span class="label-text"><b style="color: #616161;">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?>:</b> </span>
                                                                        <?= html_escape($sasaran['Sasaran']) ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge-periode level4"><?= $sasaran['TahunMulai'] . ' - ' . $sasaran['TahunAkhir'] ?></span>
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-info btn-action IndikatorSasaran" data-id="<?= $sasaran['Id'] ?>" title="Kelola Indikator">
                                                                    <i class="fa fa-bar-chart"></i> 
                                                                    <span class="badge-indikator-count" id="indikator-count-sasaran-<?= $sasaran['Id'] ?>">0</span>
                                                                </button>
                                                            </td>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <td class="text-center">
                                                                <div class="btn-aksi-group">
                                                                    <button class="btn btn-sm btn-warning EditSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" data-idtujuan="<?= $tujuan['Id'] ?>" data-sasaran="<?= html_escape($sasaran['Sasaran']) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-sm btn-danger HapusSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </td>
                                                            <?php } ?>
                                                        </tr>
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
                                                <td colspan="5" class="text-center" style="padding: 30px; color: #999;">Belum ada data Visi RPJMD.</td>
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
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="TahunMulai" placeholder="Tahun Mulai (YYYY)">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="TahunAkhir" placeholder="Tahun Akhir (YYYY)">
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
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="_TahunMulai" placeholder="Tahun Mulai (YYYY)">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="_TahunAkhir" placeholder="Tahun Akhir (YYYY)">
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
    <!-- MODAL INPUT MISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputMisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Misi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdVisiMisiForm">
                    <div class="periode-info" id="PeriodeMisiInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Visi yang dipilih
                    </div>
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
                    <div class="periode-info" id="EditPeriodeMisiInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Visi yang dipilih
                    </div>
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
    <!-- MODAL INPUT TUJUAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputTujuan" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Tujuan RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdMisiTujuanForm">
                    <div class="periode-info" id="PeriodeTujuanInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Misi yang dipilih
                    </div>
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
                    <div class="periode-info" id="EditPeriodeTujuanInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Misi yang dipilih
                    </div>
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
    <!-- MODAL INPUT SASARAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputSasaran" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Sasaran RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdTujuanSasaranForm">
                    <div class="periode-info" id="PeriodeSasaranInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Tujuan yang dipilih
                    </div>
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
                    <div class="periode-info" id="EditPeriodeSasaranInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Tujuan yang dipilih
                    </div>
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
<!-- MODAL INDIKATOR TUJUAN - DENGAN PD MULTI-SELECT (SEMUA LEVEL) -->
<!-- ============================================== -->
<div class="modal fade" id="ModalIndikatorTujuan" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 95%; max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Indikator Tujuan</h2>
                <p id="tujuan_info" style="margin-top: 10px; color: #555; font-size: 14px;"></p>
            </div>
            <div class="modal-body">
                <input type="hidden" id="indikator_tujuan_id">
                <input type="hidden" id="current_tujuan_id">
                <input type="hidden" id="is_edit_tujuan" value="false">
 <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>               
                <!-- Form Tambah/Edit Indikator -->
                <div class="panel panel-default" style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 4px;">
                    <div class="panel-heading" style="background: #f5f5f5; padding: 10px 15px; border-bottom: 1px solid #e0e0e0;">
                        <h4 class="panel-title" style="margin: 0; font-size: 14px; font-weight: 600;">
                            <i class="fa fa-plus-circle" style="color: #4caf50;" id="icon_tujuan_form"></i> 
                            <span id="judul_form_tujuan">Tambah Indikator Baru</span>
                        </h4>
                    </div>
                    <div class="panel-body" style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Indikator <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="input_indikator_tujuan" rows="2" placeholder="Masukkan indikator tujuan" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" id="input_satuan_tujuan" placeholder="Contoh: %">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Baseline 2024</label>
                                    <input type="number" class="form-control input-target-tujuan" id="input_baseline_tujuan" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Perangkat Daerah Pengampuh <span class="text-info">(Bisa pilih lebih dari 1)</span></label>
                                    <select class="form-control pd-multiselect" id="input_pd_tujuan" multiple size="4">
                                        <option value="">-- Pilih PD --</option>
                                    </select>
                                    <small class="text-muted pd-info-text">Tekan <kbd>Ctrl</kbd> + Klik untuk memilih lebih dari satu</small>
                                    <div class="pd-tags" id="pd_tags_tujuan"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2025</label>
                                    <input type="number" class="form-control input-target-tujuan" id="input_target2025_tujuan" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2026</label>
                                    <input type="number" class="form-control input-target-tujuan" id="input_target2026_tujuan" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2027</label>
                                    <input type="number" class="form-control input-target-tujuan" id="input_target2027_tujuan" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2028</label>
                                    <input type="number" class="form-control input-target-tujuan" id="input_target2028_tujuan" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2029</label>
                                    <input type="number" class="form-control input-target-tujuan" id="input_target2029_tujuan" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2030</label>
                                    <input type="number" class="form-control input-target-tujuan" id="input_target2030_tujuan" placeholder="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 text-right" style="margin-top: 10px;">
                                <button class="btn btn-success btn-action" id="SimpanIndikatorTujuan">
                                    <i class="fa fa-save"></i> <span id="btn_text_tujuan">Simpan</span>
                                </button>
                                <button class="btn btn-default btn-action" onclick="resetFormTujuan()">
                                    <i class="fa fa-refresh"></i> Reset
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
<?php } ?>
                <!-- Tabel Indikator -->
                <div class="table-indikator-wrapper">
                    <table class="table table-bordered table-striped" id="tabel-indikator-tujuan">
                        <thead>
                            <tr style="background: #f8f9fa;">
                                <th style="width: 18%;">Indikator</th>
                                <th style="width: 7%;">Satuan</th>
                                <th style="width: 8%;">Baseline 2024</th>
                                <th style="width: 6%;">Target 2025</th>
                                <th style="width: 6%;">Target 2026</th>
                                <th style="width: 6%;">Target 2027</th>
                                <th style="width: 6%;">Target 2028</th>
                                <th style="width: 6%;">Target 2029</th>
                                <th style="width: 6%;">Target 2030</th>
                                <th style="width: 22%;">PD Pengampuh</th>
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <th style="width: 9%;">Aksi</th>
                                <?php  } ?>
                            </tr>
                        </thead>
                        <tbody id="list-indikator-tujuan">
                            <tr>
                                <td colspan="11" class="text-center" style="padding: 20px; color: #999;">Belum ada indikator</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" style="padding: 10px 15px; border-top: 1px solid #e0e0e0;">
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

    <!-- ============================================== -->
<!-- MODAL INDIKATOR SASARAN - DENGAN PD MULTI-SELECT (SEMUA LEVEL) -->
<!-- ============================================== -->
<div class="modal fade" id="ModalIndikatorSasaran" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 95%; max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Indikator Sasaran</h2>
                <p id="sasaran_info" style="margin-top: 10px; color: #555; font-size: 14px;"></p>
            </div>
            <div class="modal-body">
                <input type="hidden" id="indikator_sasaran_id">
                <input type="hidden" id="current_sasaran_id">
                <input type="hidden" id="is_edit_sasaran" value="false">
 <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>               
                <!-- Form Tambah/Edit Indikator Sasaran -->
                <div class="panel panel-default" style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 4px;">
                    <div class="panel-heading" style="background: #f5f5f5; padding: 10px 15px; border-bottom: 1px solid #e0e0e0;">
                        <h4 class="panel-title" style="margin: 0; font-size: 14px; font-weight: 600;">
                            <i class="fa fa-plus-circle" style="color: #4caf50;" id="icon_sasaran_form"></i> 
                            <span id="judul_form_sasaran">Tambah Indikator Baru</span>
                        </h4>
                    </div>
                    <div class="panel-body" style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Indikator <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="input_indikator_sasaran" rows="2" placeholder="Masukkan indikator sasaran" style="resize: vertical;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" id="input_satuan_sasaran" placeholder="Contoh: %">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Baseline 2024</label>
                                    <input type="number" class="form-control input-target-sasaran" id="input_baseline_sasaran" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Perangkat Daerah Pengampuh <span class="text-info">(Bisa pilih lebih dari 1)</span></label>
                                    <select class="form-control pd-multiselect" id="input_pd_sasaran" multiple size="4">
                                        <option value="">-- Pilih PD --</option>
                                    </select>
                                    <small class="text-muted pd-info-text">Tekan <kbd>Ctrl</kbd> + Klik untuk memilih lebih dari satu</small>
                                    <div class="pd-tags" id="pd_tags_sasaran"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2025</label>
                                    <input type="number" class="form-control input-target-sasaran" id="input_target2025_sasaran" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2026</label>
                                    <input type="number" class="form-control input-target-sasaran" id="input_target2026_sasaran" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2027</label>
                                    <input type="number" class="form-control input-target-sasaran" id="input_target2027_sasaran" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2028</label>
                                    <input type="number" class="form-control input-target-sasaran" id="input_target2028_sasaran" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2029</label>
                                    <input type="number" class="form-control input-target-sasaran" id="input_target2029_sasaran" placeholder="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Target 2030</label>
                                    <input type="number" class="form-control input-target-sasaran" id="input_target2030_sasaran" placeholder="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right" style="margin-top: 10px;">
                                <button class="btn btn-success btn-action" id="SimpanIndikatorSasaran">
                                    <i class="fa fa-save"></i> <span id="btn_text_sasaran">Simpan</span>
                                </button>
                                <button class="btn btn-default btn-action" onclick="resetFormSasaran()">
                                    <i class="fa fa-refresh"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>

                <!-- Tabel Indikator Sasaran -->
                <div class="table-indikator-wrapper">
                    <table class="table table-bordered table-striped" id="tabel-indikator-sasaran">
                        <thead>
                            <tr style="background: #f8f9fa;">
                                <th style="width: 18%;">Indikator</th>
                                <th style="width: 7%;">Satuan</th>
                                <th style="width: 8%;">Baseline 2024</th>
                                <th style="width: 6%;">Target 2025</th>
                                <th style="width: 6%;">Target 2026</th>
                                <th style="width: 6%;">Target 2027</th>
                                <th style="width: 6%;">Target 2028</th>
                                <th style="width: 6%;">Target 2029</th>
                                <th style="width: 6%;">Target 2030</th>
                                <th style="width: 22%;">PD Pengampuh</th>
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <th style="width: 9%;">Aksi</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id="list-indikator-sasaran">
                            <tr>
                                <td colspan="11" class="text-center" style="padding: 20px; color: #999;">Belum ada indikator</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" style="padding: 10px 15px; border-top: 1px solid #e0e0e0;">
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
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
            }, 5000);
        }

        function escapeHtml(text) {
            if (!text) return '';
            var div = document.createElement('div');
            div.appendChild(document.createTextNode(text));
            return div.innerHTML;
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
                hideAllChildren(childId);
            });
        }

        // ==============================================
// FUNGSI UNTUK MENGUBAH JUDUL FORM INDIKATOR
// ==============================================

function setFormModeTujuan(mode) {
    // mode: 'add' atau 'edit'
    var isEdit = (mode === 'edit');
    
    $('#is_edit_tujuan').val(isEdit ? 'true' : 'false');
    
    if (isEdit) {
        $('#judul_form_tujuan').text('Edit Indikator');
        $('#icon_tujuan_form').removeClass('fa-plus-circle').addClass('fa-edit');
        $('#btn_text_tujuan').text('Update');
        $('#SimpanIndikatorTujuan').removeClass('btn-success').addClass('btn-warning');
    } else {
        $('#judul_form_tujuan').text('Tambah Indikator Baru');
        $('#icon_tujuan_form').removeClass('fa-edit').addClass('fa-plus-circle');
        $('#btn_text_tujuan').text('Simpan');
        $('#SimpanIndikatorTujuan').removeClass('btn-warning').addClass('btn-success');
    }
}

function setFormModeSasaran(mode) {
    // mode: 'add' atau 'edit'
    var isEdit = (mode === 'edit');
    
    $('#is_edit_sasaran').val(isEdit ? 'true' : 'false');
    
    if (isEdit) {
        $('#judul_form_sasaran').text('Edit Indikator');
        $('#icon_sasaran_form').removeClass('fa-plus-circle').addClass('fa-edit');
        $('#btn_text_sasaran').text('Update');
        $('#SimpanIndikatorSasaran').removeClass('btn-success').addClass('btn-warning');
    } else {
        $('#judul_form_sasaran').text('Tambah Indikator Baru');
        $('#icon_sasaran_form').removeClass('fa-edit').addClass('fa-plus-circle');
        $('#btn_text_sasaran').text('Simpan');
        $('#SimpanIndikatorSasaran').removeClass('btn-warning').addClass('btn-success');
    }
}

        // ==============================================
        // FUNGSI PD MULTI-SELECT (SEMUA LEVEL)
        // ==============================================
        function loadPDList(selectId) {
        var select = document.getElementById(selectId.replace('#', ''));
        if (!select) return;
        
        $.ajax({
            url: BaseURL + "Daerah/GetListPD",
            type: "POST",
            data: { [CSRF_NAME]: CSRF_TOKEN },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        var options = '<option value="">-- Pilih PD --</option>';
                        result.data.forEach(function(pd) {
                            // HANYA TAMPILKAN NAMA PD, TANPA LEVEL
                            options += '<option value="' + pd.id + '">' + 
                                    escapeHtml(pd.nama) + 
                                    '</option>';
                        });
                        select.innerHTML = options;
                    } else {
                        select.innerHTML = '<option value="">Gagal memuat data PD</option>';
                    }
                } catch(e) {
                    console.error('Error loading PD list:', e);
                    select.innerHTML = '<option value="">Error loading data</option>';
                }
            },
            error: function() {
                select.innerHTML = '<option value="">Gagal menghubungi server</option>';
            }
        });
    }

        function updatePDTags(selectId, containerId) {
            var select = document.getElementById(selectId);
            var container = document.getElementById(containerId);
            if (!select || !container) return;
            
            var selectedOptions = select.selectedOptions;
            container.innerHTML = '';
            
            for (var i = 0; i < selectedOptions.length; i++) {
                var option = selectedOptions[i];
                if (option.value) {
                    var tag = document.createElement('span');
                    tag.className = 'pd-tag';
                    // Ambil teks tanpa span
                    var textContent = option.textContent || option.innerText;
                    textContent = textContent.replace(/\(.*?\)/g, '').trim();
                    
                    tag.innerHTML = escapeHtml(textContent) + 
                                   ' <span class="remove-pd" data-value="' + option.value + 
                                   '" onclick="removePDTag(\'' + selectId + '\', \'' + containerId + '\', ' + option.value + ')">&times;</span>';
                    container.appendChild(tag);
                }
            }
        }

        function removePDTag(selectId, containerId, value) {
            var select = document.getElementById(selectId);
            if (!select) return;
            
            for (var i = 0; i < select.options.length; i++) {
                if (select.options[i].value == value) {
                    select.options[i].selected = false;
                    break;
                }
            }
            updatePDTags(selectId, containerId);
        }

        function setSelectedPD(selectId, values) {
    var select = document.getElementById(selectId);
    if (!select) {
        console.error('Select element not found:', selectId);
        return;
    }
    
    // Pastikan values adalah array
    if (!Array.isArray(values)) {
        try {
            values = JSON.parse(values);
        } catch(e) {
            values = [];
        }
    }
    
    // Convert values ke string untuk perbandingan
    var valueStrings = values.map(String);
    
    for (var i = 0; i < select.options.length; i++) {
        select.options[i].selected = false;
        if (valueStrings.indexOf(select.options[i].value) !== -1) {
            select.options[i].selected = true;
        }
    }
    
    var containerId = selectId.replace('input', 'pd_tags');
    updatePDTags(selectId, containerId);
}

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
        // INIT
        // ==============================================
        $(document).ready(function() {
            // Sembunyikan semua Misi, Tujuan, Sasaran
            document.querySelectorAll('#hierarki-table tbody tr.row-misi').forEach(function(tr) {
                tr.style.display = 'none';
                tr.setAttribute('data-expanded', 'false');
            });
            document.querySelectorAll('#hierarki-table tbody tr.row-tujuan').forEach(function(tr) {
                tr.style.display = 'none';
                tr.setAttribute('data-expanded', 'false');
            });
            document.querySelectorAll('#hierarki-table tbody tr.row-sasaran').forEach(function(tr) {
                tr.style.display = 'none';
                tr.setAttribute('data-expanded', 'false');
            });
            
            // Visi tetap tampil
            document.querySelectorAll('#hierarki-table tbody tr.row-visi').forEach(function(tr) {
                tr.style.display = 'table-row';
                tr.setAttribute('data-expanded', 'false');
            });

            // ==============================================
            // LOAD INDIKATOR COUNTS
            // ==============================================
            loadAllIndikatorCounts();

            // ==============================================
            // CRUD VISI
            // ==============================================
            $("#SimpanVisi").click(function() {
                if (isNaN($("#TahunMulai").val()) || $("#TahunMulai").val() == "" || $("#TahunMulai").val().length != 4) {
                    showToast('Tahun Mulai harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (isNaN($("#TahunAkhir").val()) || $("#TahunAkhir").val() == "" || $("#TahunAkhir").val().length != 4) {
                    showToast('Tahun Akhir harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (parseInt($("#TahunMulai").val()) >= parseInt($("#TahunAkhir").val())) {
                    showToast('Tahun Mulai harus lebih kecil dari Tahun Akhir!', 'error');
                    return;
                }
                if ($("#Visi").val() == "") {
                    showToast('Visi harus diisi!', 'error');
                    return;
                }
                
                var data = {
                    Visi: $("#Visi").val(),
                    TahunMulai: $("#TahunMulai").val(),
                    TahunAkhir: $("#TahunAkhir").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanVisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputVisiRPJMD", data, function(Respon) {
                    $("#SimpanVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalInputVisi').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#SimpanVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditVisi', function() {
                $("#IdVisiForm").val($(this).data('id'));
                $("#_Visi").val($(this).data('visi'));
                $("#_TahunMulai").val($(this).data('awal'));
                $("#_TahunAkhir").val($(this).data('akhir'));
                $('#ModalEditVisi').modal("show");
            });

            $("#EditBtnVisi").click(function() {
                if (isNaN($("#_TahunMulai").val()) || $("#_TahunMulai").val() == "" || $("#_TahunMulai").val().length != 4) {
                    showToast('Tahun Mulai harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (isNaN($("#_TahunAkhir").val()) || $("#_TahunAkhir").val() == "" || $("#_TahunAkhir").val().length != 4) {
                    showToast('Tahun Akhir harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (parseInt($("#_TahunMulai").val()) >= parseInt($("#_TahunAkhir").val())) {
                    showToast('Tahun Mulai harus lebih kecil dari Tahun Akhir!', 'error');
                    return;
                }
                if ($("#_Visi").val() == "") {
                    showToast('Visi harus diisi!', 'error');
                    return;
                }
                
                var data = {
                    Id: $("#IdVisiForm").val(),
                    Visi: $("#_Visi").val(),
                    TahunMulai: $("#_TahunMulai").val(),
                    TahunAkhir: $("#_TahunAkhir").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#EditBtnVisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditVisiRPJMD", data, function(Respon) {
                    $("#EditBtnVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalEditVisi').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#EditBtnVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusVisi', function() {
                if (confirm("Yakin ingin menghapus Visi ini?")) {
                    var data = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusVisiRPJMD", data, function(Respon) {
                        try {
                            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            if (result.status === 'success') { 
                                showToast('✅ ' + result.message, 'success');
                                setTimeout(function() { location.reload(); }, 600);
                            } else { 
                                btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                                showToast('❌ Error: ' + result.message, 'error'); 
                            }
                        } catch(e) {
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error parsing response', 'error');
                        }
                    });
                }
            });

            // ==============================================
            // CRUD MISI
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahMisi', function() {
                var parentRow = $(this).closest('tr')[0];
                if (parentRow.getAttribute('data-expanded') !== 'true') {
                    toggleLevel(parentRow.getAttribute('data-id'), parentRow);
                }
                
                var visiId = $(this).data('id');
                $('#IdVisiMisiForm').val(visiId);
                
                $.post(BaseURL + "Daerah/GetVisiRPJMD", {
                    Id: visiId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        if (data.length > 0) {
                            var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                            $('#PeriodeMisiInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Visi)');
                        }
                    } catch(e) {}
                });
                
                $('#Misi').val('');
                $('#ModalInputMisi').modal('show');
            });

            $("#SimpanMisi").click(function() {
                if ($("#Misi").val() == "") {
                    showToast('Misi harus diisi!', 'error');
                    return;
                }
                
                var data = {
                    _Id: $("#IdVisiMisiForm").val(),
                    Misi: $("#Misi").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanMisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputMisiRPJMD", data, function(Respon) {
                    $("#SimpanMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalInputMisi').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#SimpanMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditMisi', function() {
                $("#IdMisiForm").val($(this).data('id'));
                $("#_IdVisi").val($(this).data('idvisi'));
                $("#_Misi").val($(this).data('misi'));
                
                $.post(BaseURL + "Daerah/GetVisiRPJMD", {
                    Id: $(this).data('idvisi'),
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        if (data.length > 0) {
                            var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                            $('#EditPeriodeMisiInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Visi)');
                        }
                    } catch(e) {}
                });
                
                $('#ModalEditMisi').modal("show");
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
                
                $("#EditBtnMisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditMisiRPJMD", data, function(Respon) {
                    $("#EditBtnMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalEditMisi').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#EditBtnMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusMisi', function() {
                if (confirm("Yakin ingin menghapus Misi ini?")) {
                    var data = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusMisiRPJMD", data, function(Respon) {
                        try {
                            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            if (result.status === 'success') { 
                                showToast('✅ ' + result.message, 'success');
                                setTimeout(function() { location.reload(); }, 600);
                            } else { 
                                btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                                showToast('❌ Error: ' + result.message, 'error'); 
                            }
                        } catch(e) {
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error parsing response', 'error');
                        }
                    });
                }
            });

            // ==============================================
            // CRUD TUJUAN
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahTujuan', function() {
                var parentRow = $(this).closest('tr')[0];
                if (parentRow.getAttribute('data-expanded') !== 'true') {
                    toggleLevel(parentRow.getAttribute('data-id'), parentRow);
                }
                
                var misiId = $(this).data('id');
                $('#IdMisiTujuanForm').val(misiId);
                
                $.post(BaseURL + "Daerah/GetMisiRPJMD", {
                    Id: misiId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        if (data.length > 0) {
                            var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                            $('#PeriodeTujuanInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Misi)');
                        }
                    } catch(e) {}
                });
                
                $('#Tujuan').val('');
                $('#ModalInputTujuan').modal('show');
            });

            $("#SimpanTujuan").click(function() {
                if ($("#Tujuan").val() == "") {
                    showToast('Tujuan harus diisi!', 'error');
                    return;
                }
                
                var data = {
                    _Id: $("#IdMisiTujuanForm").val(),
                    Tujuan: $("#Tujuan").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanTujuan").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputTujuanRPJMD", data, function(Respon) {
                    $("#SimpanTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalInputTujuan').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#SimpanTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditTujuan', function() {
                $("#IdTujuanForm").val($(this).data('id'));
                $("#_IdMisi").val($(this).data('idmisi'));
                $("#_Tujuan").val($(this).data('tujuan'));
                
                $.post(BaseURL + "Daerah/GetMisiRPJMD", {
                    Id: $(this).data('idmisi'),
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        if (data.length > 0) {
                            var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                            $('#EditPeriodeTujuanInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Misi)');
                        }
                    } catch(e) {}
                });
                
                $('#ModalEditTujuan').modal("show");
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
                
                $("#EditBtnTujuan").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditTujuanRPJMD", data, function(Respon) {
                    $("#EditBtnTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalEditTujuan').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#EditBtnTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusTujuan', function() {
                if (confirm("Yakin ingin menghapus Tujuan ini?")) {
                    var data = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusTujuanRPJMD", data, function(Respon) {
                        try {
                            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            if (result.status === 'success') { 
                                showToast('✅ ' + result.message, 'success');
                                setTimeout(function() { location.reload(); }, 600);
                            } else { 
                                btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                                showToast('❌ Error: ' + result.message, 'error'); 
                            }
                        } catch(e) {
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error parsing response', 'error');
                        }
                    });
                }
            });

            // ==============================================
            // CRUD SASARAN
            // ==============================================
            $('#hierarki-table tbody').on('click', '.TambahSasaran', function() {
                var parentRow = $(this).closest('tr')[0];
                if (parentRow.getAttribute('data-expanded') !== 'true') {
                    toggleLevel(parentRow.getAttribute('data-id'), parentRow);
                }
                
                var tujuanId = $(this).data('id');
                $('#IdTujuanSasaranForm').val(tujuanId);
                
                $.post(BaseURL + "Daerah/GetTujuanRPJMD", {
                    Id: tujuanId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        if (data.length > 0) {
                            var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                            $('#PeriodeSasaranInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Tujuan)');
                        }
                    } catch(e) {}
                });
                
                $('#Sasaran').val('');
                $('#ModalInputSasaran').modal('show');
            });

            $("#SimpanSasaran").click(function() {
                if ($("#Sasaran").val() == "") {
                    showToast('Sasaran harus diisi!', 'error');
                    return;
                }
                
                var data = {
                    _Id: $("#IdTujuanSasaranForm").val(),
                    Sasaran: $("#Sasaran").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanSasaran").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputSasaranRPJMD", data, function(Respon) {
                    $("#SimpanSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalInputSasaran').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#SimpanSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditSasaran', function() {
                $("#IdSasaranForm").val($(this).data('id'));
                $("#_IdTujuan").val($(this).data('idtujuan'));
                $("#_Sasaran").val($(this).data('sasaran'));
                
                $.post(BaseURL + "Daerah/GetTujuanRPJMD", {
                    Id: $(this).data('idtujuan'),
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        if (data.length > 0) {
                            var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                            $('#EditPeriodeSasaranInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Tujuan)');
                        }
                    } catch(e) {}
                });
                
                $('#ModalEditSasaran').modal("show");
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
                
                $("#EditBtnSasaran").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditSasaranRPJMD", data, function(Respon) {
                    $("#EditBtnSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') { 
                            $('#ModalEditSasaran').modal('hide');
                            showToast('✅ ' + result.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            showToast('❌ Error: ' + result.message, 'error'); 
                        }
                    } catch(e) {
                        showToast('❌ Error parsing response', 'error');
                    }
                }).fail(function() {
                    $("#EditBtnSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ Gagal menghubungi server!', 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusSasaran', function() {
                if (confirm("Yakin ingin menghapus Sasaran ini?")) {
                    var data = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusSasaranRPJMD", data, function(Respon) {
                        try {
                            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            if (result.status === 'success') { 
                                showToast('✅ ' + result.message, 'success');
                                setTimeout(function() { location.reload(); }, 600);
                            } else { 
                                btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                                showToast('❌ Error: ' + result.message, 'error'); 
                            }
                        } catch(e) {
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error parsing response', 'error');
                        }
                    });
                }
            });

            // ==============================================
            // INDIKATOR TUJUAN - DENGAN PD MULTI-SELECT (SEMUA LEVEL)
            // ==============================================
            var currentTujuanId = null;

            $('#hierarki-table tbody').on('click', '.IndikatorTujuan', function() {
                currentTujuanId = $(this).data('id');
                $('#current_tujuan_id').val(currentTujuanId);
                
                var tujuanText = $(this).closest('tr').find('.text-content').text().trim();
                $('#tujuan_info').html('<strong>Tujuan:</strong> ' + escapeHtml(tujuanText));
                
                resetFormTujuan();
                loadPDList('input_pd_tujuan');
                loadIndikatorTujuan(currentTujuanId);
                
                $('#ModalIndikatorTujuan').modal('show');
            });

            // ==============================================
            // RESET FORM TUJUAN - KEMBALI KE MODE TAMBAH
            // ==============================================
            function resetFormTujuan() {
                $('#indikator_tujuan_id').val('');
                $('#input_indikator_tujuan').val('');
                $('#input_satuan_tujuan').val('');
                $('#input_baseline_tujuan').val('');
                $('#input_pd_tujuan').val('');
                $('.input-target-tujuan').val('');
                $('#pd_tags_tujuan').html('');
                
                // Reset ke mode tambah
                setFormModeTujuan('add');
                
                var select = document.getElementById('input_pd_tujuan');
                if (select) {
                    for (var i = 0; i < select.options.length; i++) {
                        select.options[i].selected = false;
                    }
                }
            }

            function loadIndikatorTujuan(tujuanId) {
                $.post(BaseURL + "Daerah/GetIndikatorTujuan", {
                    tujuan_id: tujuanId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        var html = '';
                        
                        if (data.length > 0) {
                            data.forEach(function(item, index) {
                                var pdDisplay = '-';
                                if (item.pd_pengampuh_names && item.pd_pengampuh_names.length > 0) {
                                    pdDisplay = item.pd_pengampuh_names.join(', ');
                                } else if (item.pd_pengampuh) {
                                    pdDisplay = 'ID: ' + item.pd_pengampuh;
                                }
                                
                                html += '<tr>';
                                html += '<td>' + escapeHtml(item.indikator) + '</td>';
                                html += '<td class="text-center">' + escapeHtml(item.satuan || '-') + '</td>';
                                html += '<td class="text-center">' + (item.baseline_2024 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2025 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2026 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2027 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2028 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2029 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2030 || '-') + '</td>';
                                html += '<td>' + escapeHtml(pdDisplay) + '</td>';
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                html += '<td class="text-center">';
                                html += '<div class="aksi-indikator">';
                                html += '<button class="btn btn-sm btn-warning EditIndikatorTujuan btn-action" data-id="' + item.id + '" title="Edit"><i class="fa fa-edit"></i></button>';
                                html += '<button class="btn btn-sm btn-danger HapusIndikatorTujuan btn-action" data-id="' + item.id + '" title="Hapus"><i class="fa fa-trash"></i></button>';
                                <?php } ?>
                                html += '</div>';
                                html += '</td>';
                                html += '</tr>';
                            });
                        } else {
                            html = '<tr><td colspan="11" class="text-center" style="padding: 20px; color: #999;">Belum ada indikator</td></tr>';
                        }
                        
                        $('#list-indikator-tujuan').html(html);
                        
                        // Update badge count
                        $('#indikator-count-tujuan-' + tujuanId).text(data.length);
                        
                    } catch(e) {
                        console.error('Error loading indikator:', e);
                    }
                });
            }

            // ==============================================
            // EDIT INDIKATOR TUJUAN
            // ==============================================
            $('#list-indikator-tujuan').on('click', '.EditIndikatorTujuan', function() {
                var id = $(this).data('id');
                $('#indikator_tujuan_id').val(id);
                
                // Ubah ke mode edit
                setFormModeTujuan('edit');
                
                var row = $(this).closest('tr');
                var cells = row.find('td');
                
                $('#input_indikator_tujuan').val(cells.eq(0).text().trim());
                $('#input_satuan_tujuan').val(cells.eq(1).text().trim());
                $('#input_baseline_tujuan').val(cells.eq(2).text().trim());
                $('#input_target2025_tujuan').val(cells.eq(3).text().trim());
                $('#input_target2026_tujuan').val(cells.eq(4).text().trim());
                $('#input_target2027_tujuan').val(cells.eq(5).text().trim());
                $('#input_target2028_tujuan').val(cells.eq(6).text().trim());
                $('#input_target2029_tujuan').val(cells.eq(7).text().trim());
                $('#input_target2030_tujuan').val(cells.eq(8).text().trim());
                
                // Load selected PD dengan AJAX
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                
                $.ajax({
                    url: BaseURL + "Daerah/GetSelectedPD",
                    type: "POST",
                    data: { 
                        indikator_id: id, 
                        type: 'tujuan',
                        [CSRF_NAME]: CSRF_TOKEN 
                    },
                    success: function(Respon) {
                        btn.prop('disabled', false).html('<i class="fa fa-edit"></i>');
                        try {
                            var selectedIds = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            console.log('Selected PD IDs:', selectedIds);
                            setSelectedPD('input_pd_tujuan', selectedIds);
                        } catch(e) {
                            console.error('Error parsing selected PD:', e);
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html('<i class="fa fa-edit"></i>');
                        console.error('AJAX Error:', status, error);
                        showToast('Gagal memuat data PD terpilih', 'error');
                    }
                });
                
                // Scroll ke form
                $('html, body').animate({
                    scrollTop: $('#input_indikator_tujuan').offset().top - 100
                }, 300);
            });

            // ==============================================
            // SIMPAN INDIKATOR TUJUAN
            // ==============================================
            $("#SimpanIndikatorTujuan").click(function() {
                var indikator = $('#input_indikator_tujuan').val().trim();
                if (indikator === '') {
                    showToast('Indikator harus diisi!', 'error');
                    return;
                }
                
                var pdSelect = document.getElementById('input_pd_tujuan');
                var pdValues = [];
                if (pdSelect) {
                    for (var i = 0; i < pdSelect.options.length; i++) {
                        if (pdSelect.options[i].selected && pdSelect.options[i].value) {
                            pdValues.push(pdSelect.options[i].value);
                        }
                    }
                }
                
                var data = {
                    tujuan_id: currentTujuanId,
                    indikator: indikator,
                    satuan: $('#input_satuan_tujuan').val().trim(),
                    baseline_2024: $('#input_baseline_tujuan').val() || null,
                    target_2025: $('#input_target2025_tujuan').val() || null,
                    target_2026: $('#input_target2026_tujuan').val() || null,
                    target_2027: $('#input_target2027_tujuan').val() || null,
                    target_2028: $('#input_target2028_tujuan').val() || null,
                    target_2029: $('#input_target2029_tujuan').val() || null,
                    target_2030: $('#input_target2030_tujuan').val() || null,
                    pd_pengampuh: pdValues,
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                var editId = $('#indikator_tujuan_id').val();
                var isEdit = $('#is_edit_tujuan').val() === 'true';
                var url = isEdit ? 'EditIndikatorTujuan' : 'InputIndikatorTujuan';
                if (isEdit) data.id = editId;
                
                console.log('Saving data:', data);
                
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.ajax({
                    url: BaseURL + "Daerah/" + url,
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(result) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_tujuan">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                        if (result.status === 'success') {
                            showToast('✅ ' + result.message, 'success');
                            resetFormTujuan();
                            setFormModeTujuan('add');
                            loadIndikatorTujuan(currentTujuanId);
                        } else {
                            showToast('❌ ' + result.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_tujuan">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                        showToast('❌ Gagal menyimpan: ' + xhr.status + ' - ' + xhr.statusText, 'error');
                    }
                });
            });

            // ==============================================
            // HAPUS INDIKATOR TUJUAN
            // ==============================================
            $('#list-indikator-tujuan').on('click', '.HapusIndikatorTujuan', function() {
                if (confirm("Yakin ingin menghapus indikator ini?")) {
                    var id = $(this).data('id');
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    
                    $.post(BaseURL + "Daerah/HapusIndikatorTujuan", {
                        id: id,
                        [CSRF_NAME]: CSRF_TOKEN
                    }, function(Respon) {
                        try {
                            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            if (result.status === 'success') {
                                showToast('✅ ' + result.message, 'success');
                                loadIndikatorTujuan(currentTujuanId);
                            } else {
                                btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                                showToast('❌ ' + result.message, 'error');
                            }
                        } catch(e) {
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                            showToast('❌ Error parsing response', 'error');
                        }
                    });
                }
            });

            // ==============================================
            // INDIKATOR SASARAN - OPEN MODAL
            // ==============================================
            var currentSasaranId = null;

            $('#hierarki-table tbody').on('click', '.IndikatorSasaran', function() {
                currentSasaranId = $(this).data('id');
                $('#current_sasaran_id').val(currentSasaranId);
                
                var sasaranText = $(this).closest('tr').find('.text-content').text().trim();
                $('#sasaran_info').html('<strong>Sasaran:</strong> ' + escapeHtml(sasaranText));
                
                // Reset ke mode tambah
                resetFormSasaran();
                setFormModeSasaran('add');
                
                loadPDList('input_pd_sasaran');
                loadIndikatorSasaran(currentSasaranId);
                
                $('#ModalIndikatorSasaran').modal('show');
            });

            function resetFormSasaran() {
            $('#indikator_sasaran_id').val('');
            $('#input_indikator_sasaran').val('');
            $('#input_satuan_sasaran').val('');
            $('#input_baseline_sasaran').val('');
            $('#input_pd_sasaran').val('');
            $('.input-target-sasaran').val('');
            $('#pd_tags_sasaran').html('');
            
            // Reset ke mode tambah
            setFormModeSasaran('add');
            
            var select = document.getElementById('input_pd_sasaran');
            if (select) {
                for (var i = 0; i < select.options.length; i++) {
                    select.options[i].selected = false;
                }
            }
        }

            function loadIndikatorSasaran(sasaranId) {
                $.post(BaseURL + "Daerah/GetIndikatorSasaran", {
                    sasaran_id: sasaranId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(Respon) {
                    try {
                        var data = JSON.parse(Respon);
                        var html = '';
                        
                        if (data.length > 0) {
                            data.forEach(function(item) {
                                var pdDisplay = '-';
                                if (item.pd_pengampuh_names && item.pd_pengampuh_names.length > 0) {
                                    pdDisplay = item.pd_pengampuh_names.join(', ');
                                } else if (item.pd_pengampuh) {
                                    pdDisplay = 'ID: ' + item.pd_pengampuh;
                                }
                                
                                html += '<tr>';
                                html += '<td>' + escapeHtml(item.indikator) + '</td>';
                                html += '<td class="text-center">' + escapeHtml(item.satuan || '-') + '</td>';
                                html += '<td class="text-center">' + (item.baseline_2024 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2025 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2026 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2027 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2028 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2029 || '-') + '</td>';
                                html += '<td class="text-center">' + (item.target_2030 || '-') + '</td>';
                                html += '<td>' + escapeHtml(pdDisplay) + '</td>';
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                html += '<td class="text-center">';
                                html += '<div class="aksi-indikator">';
                                html += '<button class="btn btn-sm btn-warning EditIndikatorSasaran btn-action" data-id="' + item.id + '" title="Edit"><i class="fa fa-edit"></i></button>';
                                html += '<button class="btn btn-sm btn-danger HapusIndikatorSasaran btn-action" data-id="' + item.id + '" title="Hapus"><i class="fa fa-trash"></i></button>';
                                <?php }?>
                                html += '</div>';
                                html += '</td>';
                                html += '</tr>';
                            });
                        } else {
                            html = '<tr><td colspan="11" class="text-center" style="padding: 20px; color: #999;">Belum ada indikator</td></tr>';
                        }
                        
                        $('#list-indikator-sasaran').html(html);
                        
                        // Update badge count
                        $('#indikator-count-sasaran-' + sasaranId).text(data.length);
                        
                    } catch(e) {
                        console.error('Error loading indikator:', e);
                    }
                });
            }

            // ==============================================
            // EDIT INDIKATOR SASARAN
            // ==============================================
            $('#list-indikator-sasaran').on('click', '.EditIndikatorSasaran', function() {
                var id = $(this).data('id');
                $('#indikator_sasaran_id').val(id);
                
                // Ubah ke mode edit
                setFormModeSasaran('edit');
                
                var row = $(this).closest('tr');
                var cells = row.find('td');
                
                $('#input_indikator_sasaran').val(cells.eq(0).text().trim());
                $('#input_satuan_sasaran').val(cells.eq(1).text().trim());
                $('#input_baseline_sasaran').val(cells.eq(2).text().trim());
                $('#input_target2025_sasaran').val(cells.eq(3).text().trim());
                $('#input_target2026_sasaran').val(cells.eq(4).text().trim());
                $('#input_target2027_sasaran').val(cells.eq(5).text().trim());
                $('#input_target2028_sasaran').val(cells.eq(6).text().trim());
                $('#input_target2029_sasaran').val(cells.eq(7).text().trim());
                $('#input_target2030_sasaran').val(cells.eq(8).text().trim());
                
                // Load selected PD dengan AJAX
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                
                $.ajax({
                    url: BaseURL + "Daerah/GetSelectedPD",
                    type: "POST",
                    data: { 
                        indikator_id: id, 
                        type: 'sasaran',
                        [CSRF_NAME]: CSRF_TOKEN 
                    },
                    success: function(Respon) {
                        btn.prop('disabled', false).html('<i class="fa fa-edit"></i>');
                        try {
                            var selectedIds = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            console.log('Selected PD IDs:', selectedIds);
                            setSelectedPD('input_pd_sasaran', selectedIds);
                        } catch(e) {
                            console.error('Error parsing selected PD:', e);
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html('<i class="fa fa-edit"></i>');
                        console.error('AJAX Error:', status, error);
                        showToast('Gagal memuat data PD terpilih', 'error');
                    }
                });
                
                $('html, body').animate({
                    scrollTop: $('#input_indikator_sasaran').offset().top - 100
                }, 300);
            });

            // ==============================================
            // SIMPAN INDIKATOR SASARAN
            // ==============================================
            $("#SimpanIndikatorSasaran").click(function() {
                var indikator = $('#input_indikator_sasaran').val().trim();
                if (indikator === '') {
                    showToast('Indikator harus diisi!', 'error');
                    return;
                }
                
                var pdSelect = document.getElementById('input_pd_sasaran');
                var pdValues = [];
                if (pdSelect) {
                    for (var i = 0; i < pdSelect.options.length; i++) {
                        if (pdSelect.options[i].selected && pdSelect.options[i].value) {
                            pdValues.push(pdSelect.options[i].value);
                        }
                    }
                }
                
                var data = {
                    sasaran_id: currentSasaranId,
                    indikator: indikator,
                    satuan: $('#input_satuan_sasaran').val().trim(),
                    baseline_2024: $('#input_baseline_sasaran').val() || null,
                    target_2025: $('#input_target2025_sasaran').val() || null,
                    target_2026: $('#input_target2026_sasaran').val() || null,
                    target_2027: $('#input_target2027_sasaran').val() || null,
                    target_2028: $('#input_target2028_sasaran').val() || null,
                    target_2029: $('#input_target2029_sasaran').val() || null,
                    target_2030: $('#input_target2030_sasaran').val() || null,
                    pd_pengampuh: pdValues,
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                var editId = $('#indikator_sasaran_id').val();
                var isEdit = $('#is_edit_sasaran').val() === 'true';
                var url = isEdit ? 'EditIndikatorSasaran' : 'InputIndikatorSasaran';
                if (isEdit) data.id = editId;
                
                console.log('Saving data:', data);
                
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.ajax({
                    url: BaseURL + "Daerah/" + url,
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(result) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_sasaran">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                        if (result.status === 'success') {
                            showToast('✅ ' + result.message, 'success');
                            resetFormSasaran();
                            setFormModeSasaran('add');
                            loadIndikatorSasaran(currentSasaranId);
                        } else {
                            showToast('❌ ' + result.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> <span id="btn_text_sasaran">' + (isEdit ? 'Update' : 'Simpan') + '</span>');
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                        showToast('❌ Gagal menyimpan: ' + xhr.status + ' - ' + xhr.statusText, 'error');
                    }
                });
            });

            // ==============================================
            // HAPUS INDIKATOR SASARAN
            // ==============================================
            $('#list-indikator-sasaran').on('click', '.HapusIndikatorSasaran', function() {
                if (confirm("Yakin ingin menghapus indikator ini?")) {
                    var id = $(this).data('id');
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    
                    $.post(BaseURL + "Daerah/HapusIndikatorSasaran", {
                        id: id,
                        [CSRF_NAME]: CSRF_TOKEN
                    }, function(Respon) {
                        try {
                            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            if (result.status === 'success') {
                                showToast('✅ ' + result.message, 'success');
                                loadIndikatorSasaran(currentSasaranId);
                            } else {
                                btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                                showToast('❌ ' + result.message, 'error');
                            }
                        } catch(e) {
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                            showToast('❌ Error parsing response', 'error');
                        }
                    });
                }
            });

            // ==============================================
            // EVENT LISTENER UNTUK PD DROPDOWN
            // ==============================================
            $('#input_pd_tujuan').on('change', function() {
                updatePDTags('input_pd_tujuan', 'pd_tags_tujuan');
            });

            $('#input_pd_sasaran').on('change', function() {
                updatePDTags('input_pd_sasaran', 'pd_tags_sasaran');
            });

            // ==============================================
            // LOAD ALL INDIKATOR COUNTS
            // ==============================================
            function loadAllIndikatorCounts() {
                // Hitung indikator tujuan
                $('.IndikatorTujuan').each(function() {
                    var tujuanId = $(this).data('id');
                    $.post(BaseURL + "Daerah/GetIndikatorTujuan", {
                        tujuan_id: tujuanId,
                        [CSRF_NAME]: CSRF_TOKEN
                    }, function(Respon) {
                        try {
                            var data = JSON.parse(Respon);
                            $('#indikator-count-tujuan-' + tujuanId).text(data.length);
                        } catch(e) {}
                    });
                });
                
                // Hitung indikator sasaran
                $('.IndikatorSasaran').each(function() {
                    var sasaranId = $(this).data('id');
                    $.post(BaseURL + "Daerah/GetIndikatorSasaran", {
                        sasaran_id: sasaranId,
                        [CSRF_NAME]: CSRF_TOKEN
                    }, function(Respon) {
                        try {
                            var data = JSON.parse(Respon);
                            $('#indikator-count-sasaran-' + sasaranId).text(data.length);
                        } catch(e) {}
                    });
                });
            }

        });
    </script>

</body>
</html>