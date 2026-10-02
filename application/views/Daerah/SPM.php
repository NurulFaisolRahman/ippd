    <?php $this->load->view('Daerah/sidebar'); ?>
    <?php $this->load->view('Daerah/Cssumum'); ?>
    <?php 
    // Hanya pengguna yang login sebagai Daerah (Level 3) yang dapat melakukan aksi CRUD
    $isDaerah = isset($IsDaerah) ? (bool)$IsDaerah : (isset($_SESSION['Level']) && $_SESSION['Level'] == 3);

    // Definisi Bidang SPM (diambil dinamis dari database BidangList atau SPMList)
    $bidangLabels = [];
    if (!empty($BidangList)) {
        foreach ($BidangList as $b) {
            $bidangLabels[(int)$b['NoBidang']] = $b['NamaBidang'];
        }
    }

    // Kelompokkan data SPM berdasarkan NoBidang
    $groupedSPM = [];
    foreach ($bidangLabels as $bId => $bName) {
        $groupedSPM[$bId] = [];
    }
    if (!empty($SPMList)) {
        foreach ($SPMList as $row) {
            $bId = !empty($row['NoBidang']) ? (int)$row['NoBidang'] : 1;
            if (!isset($bidangLabels[$bId])) {
                $bidangLabels[$bId] = !empty($row['NamaBidang']) ? $row['NamaBidang'] : ('BIDANG ' . $bId);
            }
            if (!isset($groupedSPM[$bId])) {
                $groupedSPM[$bId] = [];
            }
            $groupedSPM[$bId][] = $row;
        }
    }
    ?>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <style>
        .spm-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 25px 25px 35px 25px;
            margin-bottom: 30px;
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
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                gap: 15px;
            }
            .filter-select {
                width: 100%;
            }
        }
        .spm-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-bottom: 2px solid #f0f2f5;
            padding-bottom: 18px;
            margin-bottom: 22px;
            gap: 15px;
        }
        .spm-title-box h3 {
            margin: 0 0 5px 0;
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
        }
        .spm-title-box p {
            margin: 0;
            font-size: 13px;
            color: #7f8c8d;
        }
        .badge-satuan {
            display: inline-block;
            padding: 4px 9px;
            font-size: 11px;
            font-weight: 700;
            border-radius: 4px;
            background: #e8f4fd;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }
        .badge-pengampu {
            display: inline-block;
            padding: 4px 9px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 5px;
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
        }
        .table-spm {
            border-collapse: collapse !important;
            width: 100%;
        }
        .table-spm thead th {
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: 800;
            font-size: 12px;
            letter-spacing: 0.3px;
            border: 1px solid #cbd5e1 !important;
            vertical-align: middle !important;
            text-align: center;
            padding: 10px 8px !important;
        }
        .table-spm thead tr.sub-header th {
            background-color: #f1f5f9;
            font-weight: 700;
            color: #1e293b;
        }
        .table-spm tbody td {
            vertical-align: middle !important;
            font-size: 13px;
            line-height: 1.5;
            border: 1px solid #e2e8f0 !important;
            padding: 8px 10px !important;
        }
        .table-spm tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Style Baris Header Bidang (Mirip Gambar) */
        .table-spm tbody tr.bidang-header-row td {
            background-color: #e5e7eb !important;
            color: #0f172a !important;
            font-weight: 800 !important;
            font-size: 13px;
            letter-spacing: 0.5px;
            border-top: 2px solid #cbd5e1 !important;
            border-bottom: 2px solid #cbd5e1 !important;
            padding: 9px 10px !important;
        }

        /* Target Year Grid Card */
        .target-grid-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 18px;
        }
        .target-grid-card .grid-title {
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 12px;
        }
        .target-year-box {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 8px 10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .target-year-box label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 4px;
        }
        .target-year-box input {
            text-align: center;
            font-weight: 600;
            color: #0f172a;
        }

        .form-group-spm {
            margin-bottom: 16px;
        }
        .form-group-spm label {
            font-weight: 600;
            font-size: 13px;
            color: #334155;
            margin-bottom: 6px;
            display: block;
        }

        .btn-action-group {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        /* ============================================================
        MODERN BEAUTIFUL SELECT2 STYLING
        ============================================================ */
        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-selection--single {
            height: 42px !important;
            border: 1.5px solid #d1d5db !important;
            border-radius: 7px !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease-in-out !important;
            display: flex !important;
            align-items: center !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
            outline: none !important;
        }
        .select2-container--default .select2-selection--single:hover {
            border-color: #94a3b8 !important;
        }
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #20c997 !important;
            box-shadow: 0 0 0 3px rgba(32, 201, 151, 0.2) !important;
            outline: none !important;
        }
        #ModalEditSPM .select2-container--default.select2-container--open .select2-selection--single,
        #ModalEditSPM .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #f59e0b !important;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2) !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1e293b !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            line-height: 40px !important;
            padding-left: 14px !important;
            padding-right: 32px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #94a3b8 !important;
            font-weight: 400 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 12px !important;
            width: 20px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #64748b transparent transparent transparent !important;
            border-width: 5px 4px 0 4px !important;
        }
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #64748b transparent !important;
            border-width: 0 4px 5px 4px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__clear {
            color: #94a3b8 !important;
            font-size: 16px !important;
            margin-right: 16px !important;
            line-height: 40px !important;
            font-weight: 700 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__clear:hover {
            color: #ef4444 !important;
        }
        /* Sembunyikan tanda x pada filter wilayah */
        .filter-row .select2-selection__clear {
            display: none !important;
        }

        /* Dropdown Panel */
        .select2-dropdown {
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.12), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            z-index: 999999 !important;
            overflow: hidden !important;
            background: #ffffff !important;
        }
        .select2-search--dropdown {
            padding: 10px 12px !important;
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        .select2-search--dropdown .select2-search__field {
            border: 1px solid #cbd5e1 !important;
            border-radius: 6px !important;
            padding: 8px 12px !important;
            font-size: 13px !important;
            outline: none !important;
            transition: all 0.15s ease !important;
            background: #ffffff !important;
        }
        .select2-search--dropdown .select2-search__field:focus {
            border-color: #20c997 !important;
            box-shadow: 0 0 0 2px rgba(32, 201, 151, 0.15) !important;
        }
        #ModalEditSPM .select2-search--dropdown .select2-search__field:focus {
            border-color: #f59e0b !important;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.15) !important;
        }
        .select2-results__options {
            max-height: 250px !important;
            padding: 6px !important;
        }
        .select2-results__option {
            padding: 9px 12px !important;
            font-size: 13px !important;
            border-radius: 6px !important;
            color: #334155 !important;
            margin-bottom: 3px !important;
            white-space: normal !important;
            word-break: break-word !important;
            line-height: 1.4 !important;
            transition: background 0.15s ease, color 0.15s ease !important;
        }
        .select2-results__option--highlighted {
            background-color: #ecfdf5 !important;
            color: #065f46 !important;
            font-weight: 600 !important;
        }
        #ModalEditSPM .select2-results__option--highlighted {
            background-color: #fffbeb !important;
            color: #92400e !important;
        }
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #20c997 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }
        #ModalEditSPM .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #f59e0b !important;
            color: #ffffff !important;
        }
    </style>

    <div class="main-content">
        <!-- Data Table Area -->
        <div class="data-table-area" style="padding-top: 20px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <!-- Filter untuk pengguna yang belum login -->
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
                    
                            <!-- Menampilkan Wilayah setelah filter -->
                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php 
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                </div>
                            <?php } ?>

                        <?php } ?>

                        <!-- Card Tabel SPM -->
                        <div class="spm-card">
                            <div class="spm-header">
                                <div class="spm-title-box">
                                    <h3><i class="fa fa-list-alt" style="color: #20c997; margin-right: 8px;"></i> Standar Pelayanan Minimal (SPM) RPJMD</h3>
                                    <p>Target Indikator SPM Berdasarkan 6 Bidang Perangkat Daerah Pengampu (2025 - 2030)</p>
                                </div>
                                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                                    <div style="position: relative; width: 230px;">
                                        <input type="text" id="FilterTableInput" class="form-control input-sm" placeholder="Cari Indikator / OPD..." style="border-radius: 20px; padding-left: 32px; height: 34px;">
                                        <i class="fa fa-search" style="position: absolute; left: 12px; top: 10px; color: #94a3b8;"></i>
                                    </div>
                                    <?php if ($isDaerah) { ?>
                                        <button type="button" class="btn btn-primary notika-btn-primary" data-toggle="modal" data-target="#ModalInputBidang" style="border-radius: 6px;">
                                            <i class="fa fa-folder-plus fa-plus"></i> <b>Tambah Bidang</b>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table id="table-spm-main" class="table table-bordered table-striped table-spm">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 4%;">NO</th>
                                            <th rowspan="2" style="width: 32%; text-align: left;">INDIKATOR</th>
                                            <th rowspan="2" style="width: 7%;">SATUAN</th>
                                            <th colspan="6">TARGET TAHUN</th>
                                            <th rowspan="2" style="width: 17%; text-align: left;">Perangkat Daerah<br>Pengampu</th>
                                            <?php if ($isDaerah) { ?>
                                                <th rowspan="2" style="width: 7%;">Aksi</th>
                                            <?php } ?>
                                        </tr>
                                        <tr class="sub-header">
                                            <th style="width: 5.5%;">2025</th>
                                            <th style="width: 5.5%;">2026</th>
                                            <th style="width: 5.5%;">2027</th>
                                            <th style="width: 5.5%;">2028</th>
                                            <th style="width: 5.5%;">2029</th>
                                            <th style="width: 5.5%;">2030</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-spm-tbody">
                                        <?php if (empty($KodeWilayah)) { ?>
                                            <tr class="empty-wilayah-row">
                                                <td colspan="<?= $isDaerah ? '11' : '10' ?>" class="text-center" style="padding: 45px 20px; color: #64748b;">
                                                    <i class="fa fa-map-marker" style="font-size: 34px; color: #94a3b8; display: block; margin-bottom: 12px;"></i>
                                                    <div style="font-size: 15px; font-weight: 700; color: #334155; margin-bottom: 6px;">Wilayah Belum Dipilih</div>
                                                    <div style="font-size: 13px; color: #64748b;">Data SPM belum dipilih. Silakan pilih <b>Provinsi</b> dan <b>Kabupaten / Kota</b> pada filter di atas untuk menampilkan data.</div>
                                                </td>
                                            </tr>
                                        <?php } elseif (empty($bidangLabels) && empty($SPMList)) { ?>
                                            <tr class="empty-spm-row">
                                                <td colspan="<?= $isDaerah ? '11' : '10' ?>" class="text-center" style="padding: 45px 20px; color: #64748b;">
                                                    <i class="fa fa-folder-open-o" style="font-size: 34px; color: #94a3b8; display: block; margin-bottom: 12px;"></i>
                                                    <div style="font-size: 15px; font-weight: 700; color: #334155; margin-bottom: 6px;">Tidak Ada Data SPM</div>
                                                    <div style="font-size: 13px; color: #64748b;">Belum ada data Standar Pelayanan Minimal (SPM) untuk wilayah ini.</div>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                        <?php foreach ($bidangLabels as $bNum => $bNama) { 
                                            $items = $groupedSPM[$bNum] ?? [];
                                        ?>
                                            <!-- Header Bidang SPM -->
                                            <tr class="bidang-header-row" data-bidang="<?= $bNum ?>">
                                                <td class="text-center" style="font-weight: 800; font-size: 13px;"><?= $bNum ?></td>
                                                <td colspan="<?= $isDaerah ? '10' : '9' ?>" style="font-weight: 800; font-size: 13px; text-transform: uppercase;">
                                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                                        <span><i class="fa fa-folder-open-o" style="color: #4b5563; margin-right: 6px;"></i> <?= html_escape($bNama) ?></span>
                                                        <?php if ($isDaerah) { ?>
                                                            <div style="display: flex; gap: 6px; align-items: center;">
                                                                <button type="button" class="btn btn-xs btn-success notika-btn-success btn-tambah-indikator-bidang" data-nobidang="<?= $bNum ?>" data-namabidang="<?= html_escape($bNama) ?>" style="border-radius: 4px; font-weight: 700; padding: 4px 10px; font-size: 11px;" title="Tambah Indikator pada Bidang ini">
                                                                    <i class="fa fa-plus"></i> Tambah Indikator
                                                                </button>
                                                                <button type="button" class="btn btn-xs btn-default btn-edit-bidang" data-nobidang="<?= $bNum ?>" data-namabidang="<?= html_escape($bNama) ?>" style="border-radius: 4px; padding: 4px 8px; background: #ffffff; font-size: 11px;" title="Ubah Nama Bidang">
                                                                    <i class="fa fa-pencil text-warning"></i> Ubah
                                                                </button>
                                                                <button type="button" class="btn btn-xs btn-default btn-hapus-bidang" data-nobidang="<?= $bNum ?>" data-namabidang="<?= html_escape($bNama) ?>" style="border-radius: 4px; padding: 4px 8px; background: #ffffff; font-size: 11px;" title="Hapus Bidang beserta Indikator di dalamnya">
                                                                    <i class="fa fa-trash text-danger"></i> Hapus
                                                                </button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Indikator dalam Bidang -->
                                            <?php if (!empty($items)) { ?>
                                                <?php foreach ($items as $row) { ?>
                                                    <tr class="spm-row" id="spm-row-<?= $row['Id'] ?>" data-bidang="<?= $bNum ?>">
                                                        <td class="text-center" style="font-weight: 600;"><?= html_escape($row['NoUrut']) ?></td>
                                                        <td style="font-weight: 500; color: #1e293b;">
                                                            <?= html_escape($row['Indikator']) ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if (!empty($row['Satuan'])) { ?>
                                                                <span class="badge-satuan"><?= html_escape($row['Satuan']) ?></span>
                                                            <?php } else { ?>
                                                                <span class="text-muted">-</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="text-center" style="font-weight: 600; color: #0284c7;">
                                                            <?= !empty($row['Target2025']) ? html_escape($row['Target2025']) : '-' ?>
                                                        </td>
                                                        <td class="text-center" style="font-weight: 600; color: #0284c7;">
                                                            <?= !empty($row['Target2026']) ? html_escape($row['Target2026']) : '-' ?>
                                                        </td>
                                                        <td class="text-center" style="font-weight: 600; color: #0284c7;">
                                                            <?= !empty($row['Target2027']) ? html_escape($row['Target2027']) : '-' ?>
                                                        </td>
                                                        <td class="text-center" style="font-weight: 600; color: #0284c7;">
                                                            <?= !empty($row['Target2028']) ? html_escape($row['Target2028']) : '-' ?>
                                                        </td>
                                                        <td class="text-center" style="font-weight: 600; color: #0284c7;">
                                                            <?= !empty($row['Target2029']) ? html_escape($row['Target2029']) : '-' ?>
                                                        </td>
                                                        <td class="text-center" style="font-weight: 600; color: #0284c7;">
                                                            <?= !empty($row['Target2030']) ? html_escape($row['Target2030']) : '-' ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row['PerangkatDaerahPengampu'])) { ?>
                                                                <span class="badge-pengampu"><i class="fa fa-building-o" style="margin-right: 4px;"></i> <?= html_escape($row['PerangkatDaerahPengampu']) ?></span>
                                                            <?php } else { ?>
                                                                <span class="text-muted">-</span>
                                                            <?php } ?>
                                                        </td>
                                                        <?php if ($isDaerah) { ?>
                                                            <td class="text-center">
                                                                <div class="btn-action-group">
                                                                    <button type="button" class="btn btn-warning btn-xs notika-btn-warning btn-edit-spm" data-id="<?= $row['Id'] ?>" title="Edit Data">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-xs notika-btn-danger btn-hapus-spm" data-id="<?= $row['Id'] ?>" data-indikator="<?= html_escape($row['Indikator']) ?>" title="Hapus Data">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr class="empty-bidang-row" data-bidang="<?= $bNum ?>">
                                                    <td class="text-center text-muted">-</td>
                                                    <td colspan="<?= $isDaerah ? '10' : '9' ?>" class="text-muted" style="font-style: italic; font-size: 12px;">
                                                        Belum ada indikator untuk bidang ini. Klik Tambah Indikator untuk menambahkan.
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL TAMBAH SPM -->
        <?php if ($isDaerah) { ?>
        <div class="modal fade" id="ModalInputSPM" role="dialog" aria-labelledby="modalInputSPMLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="border-radius: 8px;">
                    <div class="modal-header" style="background-color: #20c997; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                        <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:0.8;">&times;</button>
                        <h4 class="modal-title" id="modalInputSPMLabel" style="color:#fff; font-weight:700;">
                            <i class="fa fa-plus-circle"></i> Tambah Data Indikator SPM
                        </h4>
                    </div>
                    <div class="modal-body" style="padding: 22px 25px;">
                        <div id="AlertInputSPM" class="alert alert-danger" style="display: none; border-radius: 6px;"></div>
                        <div id="BannerInputBidangTarget" class="alert alert-info" style="border-radius: 6px; padding: 10px 14px; margin-bottom: 16px; font-size: 13px;">
                            <i class="fa fa-info-circle"></i> Indikator ini akan dimasukkan ke: <strong id="TextBidangTargetName">BIDANG PENDIDIKAN</strong>
                        </div>

                        <form id="FormInputSPM">
                            <input type="hidden" name="KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">

                            <input type="hidden" name="NoBidang" id="Input_NoBidang" value="1">
                            <input type="hidden" name="NoUrut" id="Input_NoUrut" value="">

                            <div class="form-group-spm">
                                <label>Indikator SPM <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="Indikator" id="Input_Indikator" rows="3" placeholder="Masukkan nama indikator SPM..." required style="border-radius: 6px;"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group-spm">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control" name="Satuan" id="Input_Satuan" placeholder="Contoh: %, Orang, Skor, Indeks" style="border-radius: 6px; height: 42px;">
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12">
                                    <div class="form-group-spm">
                                        <label>Perangkat Daerah Pengampu</label>
                                        <select class="form-control select2-pengampu" name="PerangkatDaerahPengampu" id="Input_Pengampu" style="width: 100%;">
                                            <option value="">-- Pilih atau Cari Perangkat Daerah Pengampu --</option>
                                            <?php if (!empty($Instansi)) { foreach ($Instansi as $inst) { ?>
                                                <option value="<?= html_escape($inst['nama']) ?>"><?= html_escape($inst['nama']) ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Target Tahunan Grid -->
                            <div class="target-grid-card">
                                <div class="grid-title">
                                    <i class="fa fa-calendar-check-o text-success" style="margin-right: 5px;"></i> 
                                    Target Tahunan (2025 - 2030)
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2025</label>
                                            <input type="text" class="form-control input-sm" name="Target2025" id="Input_T2025" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2026</label>
                                            <input type="text" class="form-control input-sm" name="Target2026" id="Input_T2026" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2027</label>
                                            <input type="text" class="form-control input-sm" name="Target2027" id="Input_T2027" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2028</label>
                                            <input type="text" class="form-control input-sm" name="Target2028" id="Input_T2028" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2029</label>
                                            <input type="text" class="form-control input-sm" name="Target2029" id="Input_T2029" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2030</label>
                                            <input type="text" class="form-control input-sm" name="Target2030" id="Input_T2030" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #f0f2f5;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success notika-btn-success" id="BtnSimpanSPM">
                            <i class="fa fa-save"></i> <b>Simpan Data</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT SPM -->
        <div class="modal fade" id="ModalEditSPM" role="dialog" aria-labelledby="modalEditSPMLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="border-radius: 8px;">
                    <div class="modal-header" style="background-color: #f59e0b; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                        <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:0.8;">&times;</button>
                        <h4 class="modal-title" id="modalEditSPMLabel" style="color:#fff; font-weight:700;">
                            <i class="fa fa-pencil-square-o"></i> Edit Data Indikator SPM
                        </h4>
                    </div>
                    <div class="modal-body" style="padding: 22px 25px;">
                        <div class="alert alert-warning" style="border-radius: 6px; margin-bottom: 20px; font-size: 13px; background-color: #fffbeb; border-color: #fef3c7; color: #92400e;">
                            <i class="fa fa-info-circle"></i> Bidang SPM: <b id="Edit_TextBidangName">-</b>
                        </div>
                        <div id="AlertEditSPM" class="alert alert-danger" style="display: none; border-radius: 6px;"></div>

                        <form id="FormEditSPM">
                            <input type="hidden" name="Id" id="Edit_Id">
                            <input type="hidden" name="NoBidang" id="Edit_NoBidang">
                            <input type="hidden" name="NoUrut" id="Edit_NoUrut">

                            <div class="form-group-spm">
                                <label>Indikator SPM <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="Indikator" id="Edit_Indikator" rows="3" placeholder="Masukkan nama indikator SPM..." required style="border-radius: 6px;"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group-spm">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control" name="Satuan" id="Edit_Satuan" placeholder="Contoh: %, Orang, Skor, Indeks" style="border-radius: 6px; height: 42px;">
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12">
                                    <div class="form-group-spm">
                                        <label>Perangkat Daerah Pengampu</label>
                                        <select class="form-control select2-pengampu" name="PerangkatDaerahPengampu" id="Edit_Pengampu" style="width: 100%;">
                                            <option value="">-- Pilih atau Cari Perangkat Daerah Pengampu --</option>
                                            <?php if (!empty($Instansi)) { foreach ($Instansi as $inst) { ?>
                                                <option value="<?= html_escape($inst['nama']) ?>"><?= html_escape($inst['nama']) ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Target Tahunan Grid -->
                            <div class="target-grid-card">
                                <div class="grid-title">
                                    <i class="fa fa-calendar-check-o text-warning" style="margin-right: 5px;"></i> 
                                    Target Tahunan (2025 - 2030)
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2025</label>
                                            <input type="text" class="form-control input-sm" name="Target2025" id="Edit_T2025" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2026</label>
                                            <input type="text" class="form-control input-sm" name="Target2026" id="Edit_T2026" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2027</label>
                                            <input type="text" class="form-control input-sm" name="Target2027" id="Edit_T2027" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2028</label>
                                            <input type="text" class="form-control input-sm" name="Target2028" id="Edit_T2028" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2029</label>
                                            <input type="text" class="form-control input-sm" name="Target2029" id="Edit_T2029" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">
                                        <div class="target-year-box">
                                            <label>2030</label>
                                            <input type="text" class="form-control input-sm" name="Target2030" id="Edit_T2030" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #f0f2f5;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-warning notika-btn-warning" id="BtnUpdateSPM">
                            <i class="fa fa-save"></i> <b>Perbarui Data</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL TAMBAH BIDANG -->
        <div class="modal fade" id="ModalInputBidang" role="dialog" aria-labelledby="modalInputBidangLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 8px;">
                    <div class="modal-header" style="background-color: #007bff; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                        <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:0.8;">&times;</button>
                        <h4 class="modal-title" id="modalInputBidangLabel" style="color:#fff; font-weight:700;">
                            <i class="fa fa-folder-plus fa-plus"></i> Tambah Bidang SPM Baru
                        </h4>
                    </div>
                    <div class="modal-body" style="padding: 22px 25px;">
                        <div id="AlertInputBidang" class="alert alert-danger" style="display: none; border-radius: 6px;"></div>

                        <form id="FormInputBidang">
                            <input type="hidden" name="KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">
                            <div class="form-group-spm">
                                <label>Nama Bidang SPM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="NamaBidang" id="Input_NamaBidang" placeholder="Contoh: BIDANG KEBUDAYAAN, BIDANG PARIWISATA, dsb." required style="border-radius: 6px; text-transform: uppercase;">
                                <small class="text-muted" style="display:block; margin-top: 5px;">Nomor urut bidang berikutnya akan diberikan secara otomatis.</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #f0f2f5;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary notika-btn-primary" id="BtnSimpanBidang">
                            <i class="fa fa-save"></i> <b>Simpan Bidang</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT BIDANG -->
        <div class="modal fade" id="ModalEditBidang" role="dialog" aria-labelledby="modalEditBidangLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 8px;">
                    <div class="modal-header" style="background-color: #f59e0b; color: #fff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                        <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:0.8;">&times;</button>
                        <h4 class="modal-title" id="modalEditBidangLabel" style="color:#fff; font-weight:700;">
                            <i class="fa fa-pencil-square-o"></i> Edit Nama Bidang SPM
                        </h4>
                    </div>
                    <div class="modal-body" style="padding: 22px 25px;">
                        <div id="AlertEditBidang" class="alert alert-danger" style="display: none; border-radius: 6px;"></div>

                        <form id="FormEditBidang">
                            <input type="hidden" name="KodeWilayah" value="<?= html_escape($KodeWilayah) ?>">
                            <input type="hidden" name="NoBidang" id="Edit_Bidang_NoBidang">
                            <div class="form-group-spm">
                                <label>Nama Bidang SPM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="NamaBidang" id="Edit_Bidang_NamaBidang" required style="border-radius: 6px; text-transform: uppercase;">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #f0f2f5;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-warning notika-btn-warning" id="BtnUpdateBidang">
                            <i class="fa fa-save"></i> <b>Perbarui Bidang</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>

    <!-- SCRIPT LIBRARIES -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        var BaseURL = '<?= base_url() ?>';
        var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
        var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

        jQuery(document).ready(function($) {

            // Setup CSRF untuk semua request AJAX
            $.ajaxSetup({
                data: {
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                }
            });

            // Inisialisasi Select2 Modern untuk Input & Edit SPM
            function initSelect2Elements() {
                $('#Input_Pengampu').select2({
                    placeholder: '-- Pilih atau Cari Perangkat Daerah Pengampu --',
                    allowClear: true,
                    tags: true,
                    dropdownParent: $('#ModalInputSPM'),
                    width: '100%'
                });
                $('#Edit_Pengampu').select2({
                    placeholder: '-- Pilih atau Cari Perangkat Daerah Pengampu --',
                    allowClear: true,
                    tags: true,
                    dropdownParent: $('#ModalEditSPM'),
                    width: '100%'
                });
            }
            initSelect2Elements();

            $('#ModalInputSPM').on('shown.bs.modal', function() {
                initSelect2Elements();
            });
            $('#ModalEditSPM').on('shown.bs.modal', function() {
                initSelect2Elements();
            });

            // Live Filter Tabel
            $('#FilterTableInput').on('keyup', function() {
                var val = $.trim($(this).val()).toLowerCase();
                if (!val) {
                    $('#table-spm-tbody tr.spm-row, #table-spm-tbody tr.bidang-header-row, #table-spm-tbody tr.empty-bidang-row').show();
                    return;
                }
                // Sembunyikan semua terlebih dahulu
                $('#table-spm-tbody tr.spm-row').each(function() {
                    var text = $(this).text().toLowerCase();
                    var match = text.indexOf(val) > -1;
                    $(this).toggle(match);
                });
                // Tampilkan header bidang jika ada baris di dalamnya yang cocok
                $('.bidang-header-row').each(function() {
                    var bId = $(this).data('bidang');
                    var visibleRows = $('#table-spm-tbody tr.spm-row[data-bidang="' + bId + '"]:visible').length;
                    $(this).toggle(visibleRows > 0);
                });
                $('.empty-bidang-row').hide();
            });

            // ==============================================
            // FILTER WILAYAH UNTUK PENGGUNA BELUM LOGIN
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
                        data: { Kode: $(this).val(), [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                        beforeSend: function() { $("#KabKota").prop('disabled', true); },
                        success: function(Respon) {
                            var Data = (typeof Respon === 'string') ? JSON.parse(Respon) : Respon;
                            var KabKota = '<option value="">Pilih Kab/Kota</option>';
                            if (Data.length > 0) {
                                for (let i = 0; i < Data.length; i++) {
                                    KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                                }
                            } else {
                                alert("Belum Ada Data Kab/Kota");
                            }
                            $("#KabKota").html(KabKota).prop('disabled', false);
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
                            if (Respon.trim() === '1') {
                                window.location.href = BaseURL + "Daerah/SPM";
                            } else {
                                alert(Respon || "Gagal menyimpan filter wilayah!");
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
                        data: { Kode: kodeProv, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                        success: function(Respon) {
                            var Data = (typeof Respon === 'string') ? JSON.parse(Respon) : Respon;
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

            <?php if ($isDaerah) { ?>
                // ============================================================
                // BUKA MODAL TAMBAH INDIKATOR DARI BARIS BIDANG
                // ============================================================
                $(document).on('click', '.btn-tambah-indikator-bidang', function() {
                    var noBidang = $(this).data('nobidang') || 1;
                    var namaBidang = $(this).data('namabidang') || '';

                    $('#AlertInputSPM').hide().empty();
                    $('#FormInputSPM')[0].reset();
                    $('#Input_NoBidang').val(noBidang);
                    $('#Input_NoUrut').val('');
                    $('#Input_Pengampu').val('').trigger('change');
                    $('#TextBidangTargetName').text(namaBidang);

                    $('#ModalInputSPM').modal('show');
                    setTimeout(function() {
                        $('#Input_Indikator').focus();
                    }, 400);
                });

                // ============================================================
                // SIMPAN DATA BIDANG BARU
                // ============================================================
                $('#BtnSimpanBidang').on('click', function() {
                    var namaBidang = $('#Input_NamaBidang').val().trim();
                    var $alertBox = $('#AlertInputBidang');
                    $alertBox.hide().empty();

                    if (!namaBidang) {
                        $alertBox.text('Harap isi Nama Bidang SPM!').slideDown();
                        $('#Input_NamaBidang').focus();
                        return;
                    }

                    var $btn = $(this);
                    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                    $.ajax({
                        url: BaseURL + 'Daerah/InputBidangSPM',
                        type: 'POST',
                        data: {
                            KodeWilayah: '<?= html_escape($KodeWilayah) ?>',
                            NamaBidang: namaBidang,
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                        },
                        dataType: 'json',
                        success: function(res) {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Bidang</b>');
                            if (res.status === 'success') {
                                $('#ModalInputBidang').modal('hide');
                                alert(res.message);
                                window.location.reload();
                            } else {
                                $alertBox.text(res.message || 'Gagal menyimpan bidang!').slideDown();
                            }
                        },
                        error: function() {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Bidang</b>');
                            $alertBox.text('Gagal menghubungi server. Silakan coba lagi.').slideDown();
                        }
                    });
                });

                // ============================================================
                // EDIT NAMA BIDANG
                // ============================================================
                $(document).on('click', '.btn-edit-bidang', function() {
                    var noBidang = $(this).data('nobidang');
                    var namaBidang = $(this).data('namabidang');
                    $('#Edit_Bidang_NoBidang').val(noBidang);
                    $('#Edit_Bidang_NamaBidang').val(namaBidang);
                    $('#AlertEditBidang').hide().empty();
                    $('#ModalEditBidang').modal('show');
                });

                $('#BtnUpdateBidang').on('click', function() {
                    var namaBidang = $('#Edit_Bidang_NamaBidang').val().trim();
                    var noBidang = $('#Edit_Bidang_NoBidang').val();
                    var $alertBox = $('#AlertEditBidang');
                    $alertBox.hide().empty();

                    if (!namaBidang) {
                        $alertBox.text('Harap isi Nama Bidang!').slideDown();
                        return;
                    }

                    var $btn = $(this);
                    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');

                    $.ajax({
                        url: BaseURL + 'Daerah/EditBidangSPM',
                        type: 'POST',
                        data: {
                            KodeWilayah: '<?= html_escape($KodeWilayah) ?>',
                            NoBidang: noBidang,
                            NamaBidang: namaBidang,
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                        },
                        dataType: 'json',
                        success: function(res) {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Perbarui Bidang</b>');
                            if (res.status === 'success') {
                                $('#ModalEditBidang').modal('hide');
                                alert(res.message);
                                window.location.reload();
                            } else {
                                $alertBox.text(res.message || 'Gagal memperbarui bidang!').slideDown();
                            }
                        },
                        error: function() {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Perbarui Bidang</b>');
                            $alertBox.text('Gagal menghubungi server.').slideDown();
                        }
                    });
                });

                // ============================================================
                // HAPUS BIDANG (BESERTA INDIKATOR DI DALAMNYA)
                // ============================================================
                $(document).on('click', '.btn-hapus-bidang', function() {
                    var noBidang = $(this).data('nobidang');
                    var namaBidang = $(this).data('namabidang');

                    if (!confirm('Peringatan: Menghapus bidang "' + namaBidang + '" akan menghapus semua data indikator di dalamnya!\nApakah Anda yakin ingin melanjutkan?')) {
                        return;
                    }

                    $.ajax({
                        url: BaseURL + 'Daerah/HapusBidangSPM',
                        type: 'POST',
                        data: {
                            KodeWilayah: '<?= html_escape($KodeWilayah) ?>',
                            NoBidang: noBidang,
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status === 'success') {
                                alert(res.message);
                                window.location.reload();
                            } else {
                                alert(res.message || 'Gagal menghapus bidang!');
                            }
                        },
                        error: function() {
                            alert('Gagal menghubungi server untuk menghapus bidang.');
                        }
                    });
                });

                // ============================================================
                // SIMPAN DATA SPM
                // ============================================================
                $('#BtnSimpanSPM').on('click', function() {
                    var indikator = $('#Input_Indikator').val().trim();
                    var $alertBox = $('#AlertInputSPM');

                    $alertBox.hide().empty();

                    if (!indikator) {
                        $alertBox.text('Harap isi Indikator SPM!').slideDown();
                        $('#Input_Indikator').focus();
                        return;
                    }

                    var formData = $('#FormInputSPM').serializeArray();
                    var postData = {};
                    $.each(formData, function(i, field) {
                        postData[field.name] = field.value;
                    });
                    postData[CSRF_TOKEN_NAME] = CSRF_TOKEN_VALUE;

                    var $btn = $(this);
                    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                    $.ajax({
                        url: BaseURL + 'Daerah/InputSPM',
                        type: 'POST',
                        data: postData,
                        dataType: 'json',
                        success: function(res) {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
                            if (res.status === 'success') {
                                $('#ModalInputSPM').modal('hide');
                                window.location.reload();
                            } else {
                                $alertBox.text(res.message || 'Terjadi kesalahan saat menyimpan!').slideDown();
                            }
                        },
                        error: function(xhr, status, error) {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Simpan Data</b>');
                            $alertBox.text('Gagal menghubungi server. Silakan coba lagi.').slideDown();
                        }
                    });
                });

                // ============================================================
                // BUKA MODAL EDIT DAN ISI DATA
                // ============================================================
                $(document).on('click', '.btn-edit-spm', function() {
                    var id = $(this).data('id');
                    var $btn = $(this);
                    $btn.prop('disabled', true);
                    $('#AlertEditSPM').hide().empty();

                    $.ajax({
                        url: BaseURL + 'Daerah/GetSPMById',
                        type: 'POST',
                        data: {
                            Id: id,
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                        },
                        dataType: 'json',
                        success: function(data) {
                            $btn.prop('disabled', false);
                            if (data && data.Id) {
                                $('#Edit_Id').val(data.Id);
                                $('#Edit_NoBidang').val(data.NoBidang || 1);
                                $('#Edit_NoUrut').val(data.NoUrut || 1);
                                $('#Edit_TextBidangName').text(data.NamaBidang || ('BIDANG ' + (data.NoBidang || 1)));
                                $('#Edit_Indikator').val(data.Indikator);
                                $('#Edit_Satuan').val(data.Satuan);

                                if (data.PerangkatDaerahPengampu) {
                                    if ($('#Edit_Pengampu').find("option[value='" + data.PerangkatDaerahPengampu + "']").length === 0) {
                                        var newOption = new Option(data.PerangkatDaerahPengampu, data.PerangkatDaerahPengampu, true, true);
                                        $('#Edit_Pengampu').append(newOption).trigger('change');
                                    } else {
                                        $('#Edit_Pengampu').val(data.PerangkatDaerahPengampu).trigger('change');
                                    }
                                } else {
                                    $('#Edit_Pengampu').val('').trigger('change');
                                }

                                $('#Edit_T2025').val(data.Target2025);
                                $('#Edit_T2026').val(data.Target2026);
                                $('#Edit_T2027').val(data.Target2027);
                                $('#Edit_T2028').val(data.Target2028);
                                $('#Edit_T2029').val(data.Target2029);
                                $('#Edit_T2030').val(data.Target2030);

                                $('#ModalEditSPM').modal('show');
                            } else {
                                alert('Data SPM tidak ditemukan!');
                            }
                        },
                        error: function() {
                            $btn.prop('disabled', false);
                            alert('Gagal mengambil data SPM dari server.');
                        }
                    });
                });

                // ============================================================
                // UPDATE DATA SPM
                // ============================================================
                $('#BtnUpdateSPM').on('click', function() {
                    var indikator = $('#Edit_Indikator').val().trim();
                    var $alertBox = $('#AlertEditSPM');

                    $alertBox.hide().empty();

                    if (!indikator) {
                        $alertBox.text('Harap isi Indikator SPM!').slideDown();
                        $('#Edit_Indikator').focus();
                        return;
                    }

                    var formData = $('#FormEditSPM').serializeArray();
                    var postData = {};
                    $.each(formData, function(i, field) {
                        postData[field.name] = field.value;
                    });
                    postData[CSRF_TOKEN_NAME] = CSRF_TOKEN_VALUE;

                    var $btn = $(this);
                    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');

                    $.ajax({
                        url: BaseURL + 'Daerah/EditSPM',
                        type: 'POST',
                        data: postData,
                        dataType: 'json',
                        success: function(res) {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Perbarui Data</b>');
                            if (res.status === 'success') {
                                $('#ModalEditSPM').modal('hide');
                                window.location.reload();
                            } else {
                                $alertBox.text(res.message || 'Gagal memperbarui data!').slideDown();
                            }
                        },
                        error: function() {
                            $btn.prop('disabled', false).html('<i class="fa fa-save"></i> <b>Perbarui Data</b>');
                            $alertBox.text('Gagal menghubungi server. Silakan coba lagi.').slideDown();
                        }
                    });
                });

                // ============================================================
                // HAPUS DATA SPM
                // ============================================================
                $(document).on('click', '.btn-hapus-spm', function() {
                    var id = $(this).data('id');
                    var indikator = $(this).data('indikator');

                    if (!confirm('Apakah Anda yakin ingin menghapus data SPM ini:\n"' + indikator + '"?')) {
                        return;
                    }

                    $.ajax({
                        url: BaseURL + 'Daerah/HapusSPM',
                        type: 'POST',
                        data: {
                            Id: id,
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status === 'success') {
                                $('#spm-row-' + id).fadeOut(300, function() {
                                    $(this).remove();
                                });
                            } else {
                                alert(res.message || 'Gagal menghapus data SPM!');
                            }
                        },
                        error: function() {
                            alert('Gagal menghubungi server untuk menghapus data.');
                        }
                    });
                });
            <?php } ?>

        });
    </script>
    </body>
    </html>
