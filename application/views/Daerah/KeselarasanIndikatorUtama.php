<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    /* ============================================================
       STYLE UTAMA - FONT SAMA UNTUK SEMUA
       ============================================================ */
    .table-indikator-utama th,
    .table-indikator-utama td {
        font-size: 12px !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .table-indikator-utama th {
        background: #f8f9fa;
        font-weight: 700;
        text-align: center;
        vertical-align: middle;
        padding: 6px 4px;
        border: 1px solid #dee2e6;
    }
    .table-indikator-utama td {
        vertical-align: middle;
        padding: 4px 6px;
        border: 1px solid #dee2e6;
    }
    
    /* ============================================================
       ROW INDUK (HEADER)
       ============================================================ */
    .row-induk {
        background-color: #e8f0fe !important;
        border-left: 4px solid #007bff;
    }
    .row-induk .no-rkp {
        font-weight: 700;
        color: #1a5276;
    }
    .row-induk .no-kabkota {
        font-weight: 700;
        color: #155724;
    }
    .row-induk .nama-induk {
        font-weight: 600;
    }
    .row-induk .target-utama {
        font-weight: 700;
        color: #004085;
    }
    .row-induk .target-utama-kabkota {
        font-weight: 700;
        color: #155724;
    }
    
    /* ============================================================
       ROW PERIHAL RKP (BARIS SENDIRI)
       ============================================================ */
    .row-perihal-rkp {
        background-color: #f0f8ff !important;
        border-left: 2px solid #007bff;
    }
    .row-perihal-rkp .perihal-indent {
        padding-left: 25px !important;
    }
    .row-perihal-rkp .perihal-nama {
        font-weight: 500;
        color: #0c5460;
    }
    .row-perihal-rkp .target-perihal {
        font-weight: 600;
        color: #004085;
    }
    .row-perihal-rkp .no-perihal {
        color: #007bff;
        font-weight: 600;
    }
    
    /* ============================================================
       ROW PERIHAL KAB/KOTA (BARIS SENDIRI)
       ============================================================ */
    .row-perihal-kabkota {
        background-color: #f0fff4 !important;
        border-left: 2px solid #28a745;
    }
    .row-perihal-kabkota .perihal-indent {
        padding-left: 25px !important;
    }
    .row-perihal-kabkota .perihal-nama {
        font-weight: 500;
        color: #155724;
    }
    .row-perihal-kabkota .target-perihal-kabkota {
        font-weight: 600;
        color: #155724;
    }
    .row-perihal-kabkota .no-perihal {
        color: #28a745;
        font-weight: 600;
    }
    
    /* ============================================================
       TEXT KETERANGAN
       ============================================================ */
    .keterangan-text {
        color: #555;
    }
    .keterangan-perihal {
        color: #555;
    }
    
    /* ============================================================
       TOMBOL AKSI
       ============================================================ */
    .btn-aksi-group {
        display: flex;
        flex-wrap: wrap;
        gap: 3px;
        justify-content: center;
        align-items: center;
    }
    .btn-aksi-group .btn {
        padding: 2px 8px;
        font-size: 11px;
        margin: 1px;
    }
    .btn-aksi-group .btn i {
        margin-right: 2px;
    }
    
    /* ============================================================
       FILTER
       ============================================================ */
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
        font-size: 13px;
        margin-bottom: 4px;
    }
    .filter-select {
        width: 200px;
        font-size: 13px;
        padding: 4px 8px;
    }
    
    /* ============================================================
       PERIHAL ROW DI MODAL
       ============================================================ */
    .perihal-row {
        background: #f8f9fa;
        padding: 8px;
        border-radius: 4px;
        margin-bottom: 8px;
        border: 1px solid #e9ecef;
        position: relative;
    }
    .perihal-row .row {
        margin-top: 3px;
    }
    .perihal-row input {
        font-size: 12px !important;
    }
    
    /* ============================================================
       MODAL
       ============================================================ */
    .modal.fixed-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
        overflow-y: auto;
        background: rgba(0,0,0,0.5);
    }
    .modal.fixed-modal .modal-dialog {
        margin: 20px auto;
        position: relative;
        top: 0;
        left: 0;
        transform: none !important;
    }
    .modal-lg-custom {
        max-width: 95%;
        width: 95%;
    }
    .modal-body label {
        font-size: 12px !important;
        font-weight: 600;
    }
    .modal-body input,
    .modal-body textarea,
    .modal-body select {
        font-size: 12px !important;
    }
    
    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media (max-width: 768px) {
        .filter-row { flex-direction: column; gap: 12px; }
        .filter-select { width: 100%; }
        .table-indikator-utama td { font-size: 10px !important; padding: 2px 3px; }
        .row-perihal-rkp .perihal-indent { padding-left: 8px !important; }
        .row-perihal-kabkota .perihal-indent { padding-left: 8px !important; }
        .btn-aksi-group { flex-direction: column; }
        .btn-aksi-group .btn { width: 100%; }
        .modal-lg-custom { max-width: 100%; width: 100%; }
    }
</style>

<!-- Loading Overlay -->
<div class="loading-overlay" id="LoadingOverlay">
    <div class="loading-spinner">
        <i class="fa fa-spinner fa-spin fa-3x"></i>
        <p style="margin-top:15px;">Memuat data...</p>
    </div>
</div>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH -->
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
                                                            <option value="<?= html_escape($prov['Kode']) ?>"
                                                                <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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

                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="FilterBtn">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!empty($KodeWilayah)) { ?>
                            <div class="alert alert-info" style="margin-bottom: 15px; font-size:12px;">
                                <strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah) ?>
                            </div>
                        <?php } ?>

                        <!-- TOMBOL TAMBAH -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" id="BtnTambah">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Indikator</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <br>

                        <!-- ============================================================
                        TABEL DATA - DENGAN URUTAN TETAP
                        ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered table-indikator-utama">
                                <thead>
                                    <tr>
                                        <th style="width:30px; text-align:center;">NO.<br><small>RKP</small></th>
                                        <th style="width:140px; text-align:center;">INDIKATOR UTAMA PEMBANGUNAN<br><small>RKP 2026</small></th>
                                        <th style="width:55px; text-align:center;">TARGET<br><small>RKP 2026</small></th>
                                        <th style="width:100px; text-align:center;">KETERANGAN<br><small>RKP 2026</small></th>
                                        <th style="width:30px; text-align:center;">NO.<br><small>Kab/Kota</small></th>
                                        <th style="width:140px; text-align:center;">INDIKATOR UTAMA PEMBANGUNAN<br><small>Kab/Kota</small></th>
                                        <th style="width:55px; text-align:center;">TARGET<br><small>Kab/Kota</small></th>
                                        <th style="width:100px; text-align:center;">KETERANGAN<br><small>Kab/Kota</small></th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width:80px; text-align:center;">AKSI</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                <?php 
                                $globalRowCounter = 0;
                                if (!empty($IndikatorUtama)) { 
                                    foreach ($IndikatorUtama as $row) {
                                        $hasRKP = !empty($row['nomor_rkp']) || !empty($row['nama_indikator_rkp']);
                                        $hasKabKota = !empty($row['nomor_kabkota']) || !empty($row['nama_indikator_kabkota']);
                                        
                                        $perihalRKP = $row['perihal_rkp'] ?? [];
                                        $perihalKabKota = $row['perihal_kabkota'] ?? [];
                                        
                                        // Urutkan perihal berdasarkan nomor_perihal
                                        usort($perihalRKP, function($a, $b) {
                                            return strnatcmp($a['nomor_perihal'] ?? '', $b['nomor_perihal'] ?? '');
                                        });
                                        usort($perihalKabKota, function($a, $b) {
                                            return strnatcmp($a['nomor_perihal'] ?? '', $b['nomor_perihal'] ?? '');
                                        });
                                        
                                        $rkpTotalRows = ($hasRKP ? 1 : 0) + count($perihalRKP);
                                        $kabkotaTotalRows = ($hasKabKota ? 1 : 0) + count($perihalKabKota);
                                        $maxRows = max($rkpTotalRows, $kabkotaTotalRows, 1);
                                        
                                        // Buat data per baris dengan urutan tetap
                                        for ($i = 0; $i < $maxRows; $i++) {
                                            $isRKPInduk = ($i == 0 && $hasRKP);
                                            $isRKPPerihal = ($i > 0 && ($i - 1) < count($perihalRKP));
                                            $rkpPerihalData = $isRKPPerihal ? $perihalRKP[$i - 1] : null;
                                            $isKabKotaInduk = ($i == 0 && $hasKabKota);
                                            $isKabKotaPerihal = ($i > 0 && ($i - 1) < count($perihalKabKota));
                                            $kabkotaPerihalData = $isKabKotaPerihal ? $perihalKabKota[$i - 1] : null;
                                            $isRowInduk = ($isRKPInduk || $isKabKotaInduk);
                                            
                                            $rowClass = '';
                                            if ($isRKPInduk || $isKabKotaInduk) {
                                                $rowClass = 'row-induk';
                                            } else if ($isRKPPerihal) {
                                                $rowClass = 'row-perihal-rkp';
                                            } else if ($isKabKotaPerihal) {
                                                $rowClass = 'row-perihal-kabkota';
                                            }
                                            
                                            $globalRowCounter++;
                                            $rowId = 'row_' . $row['id'] . '_' . $i;
                                            $uniqueId = 'row_' . $row['id'] . '_' . $i . '_' . $globalRowCounter;
                                ?>
                                            <tr class="<?= $rowClass ?>" 
                                                id="<?= $rowId ?>" 
                                                data-parent="<?= $row['id'] ?>" 
                                                data-row="<?= $i ?>" 
                                                data-order="<?= $globalRowCounter ?>"
                                                data-unique="<?= $uniqueId ?>">
                                                
                                                <!-- NO RKP -->
                                                <td class="text-center <?= ($isRKPInduk || $isRKPPerihal) ? '' : 'perihal-indent' ?>">
                                                    <?php if ($isRKPInduk) { ?>
                                                        <strong class="no-rkp"><?= html_escape($row['nomor_rkp']) ?></strong>
                                                    <?php } else if ($isRKPPerihal) { ?>
                                                        <span class="no-perihal">↳ <?= html_escape($rkpPerihalData['nomor_perihal'] ?? '') ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- INDIKATOR RKP -->
                                                <td class="<?= ($isRKPInduk || $isRKPPerihal) ? '' : 'perihal-indent' ?>">
                                                    <?php if ($isRKPInduk) { ?>
                                                        <span class="nama-induk"><?= nl2br(html_escape($row['nama_indikator_rkp'])) ?></span>
                                                    <?php } else if ($isRKPPerihal) { ?>
                                                        <span class="perihal-nama"><?= html_escape($rkpPerihalData['nama_perihal']) ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- TARGET RKP -->
                                                <td class="text-center">
                                                    <?php if ($isRKPInduk) { ?>
                                                        <span class="target-utama"><?= html_escape($row['target_rkp'] ?? '-') ?></span>
                                                    <?php } else if ($isRKPPerihal) { ?>
                                                        <span class="target-perihal"><?= html_escape($rkpPerihalData['target'] ?? '-') ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- KETERANGAN RKP -->
                                                <td>
                                                    <?php if ($isRKPInduk) { ?>
                                                        <span class="keterangan-text"><?= nl2br(html_escape($row['keterangan_rkp'] ?? '-')) ?></span>
                                                    <?php } else if ($isRKPPerihal) { ?>
                                                        <span class="keterangan-perihal"><?= nl2br(html_escape($rkpPerihalData['keterangan'] ?? '-')) ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- NO KAB/KOTA -->
                                                <td class="text-center <?= ($isKabKotaInduk || $isKabKotaPerihal) ? '' : 'perihal-indent' ?>">
                                                    <?php if ($isKabKotaInduk) { ?>
                                                        <strong class="no-kabkota"><?= html_escape($row['nomor_kabkota']) ?></strong>
                                                    <?php } else if ($isKabKotaPerihal) { ?>
                                                        <span class="no-perihal">↳ <?= html_escape($kabkotaPerihalData['nomor_perihal'] ?? '') ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- INDIKATOR KAB/KOTA -->
                                                <td class="<?= ($isKabKotaInduk || $isKabKotaPerihal) ? '' : 'perihal-indent' ?>">
                                                    <?php if ($isKabKotaInduk) { ?>
                                                        <span class="nama-induk"><?= nl2br(html_escape($row['nama_indikator_kabkota'])) ?></span>
                                                    <?php } else if ($isKabKotaPerihal) { ?>
                                                        <span class="perihal-nama"><?= html_escape($kabkotaPerihalData['nama_perihal']) ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- TARGET KAB/KOTA -->
                                                <td class="text-center">
                                                    <?php if ($isKabKotaInduk) { ?>
                                                        <span class="target-utama-kabkota"><?= html_escape($row['target_kabkota'] ?? '-') ?></span>
                                                    <?php } else if ($isKabKotaPerihal) { ?>
                                                        <span class="target-perihal-kabkota"><?= html_escape($kabkotaPerihalData['target'] ?? '-') ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- KETERANGAN KAB/KOTA -->
                                                <td>
                                                    <?php if ($isKabKotaInduk) { ?>
                                                        <span class="keterangan-text"><?= nl2br(html_escape($row['keterangan_kabkota'] ?? '-')) ?></span>
                                                    <?php } else if ($isKabKotaPerihal) { ?>
                                                        <span class="keterangan-perihal"><?= nl2br(html_escape($kabkotaPerihalData['keterangan'] ?? '-')) ?></span>
                                                    <?php } else { ?>
                                                        -
                                                    <?php } ?>
                                                </td>
                                                
                                                <!-- AKSI - HANYA DI BARIS INDUK -->
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <td class="text-center">
                                                        <?php if ($isRowInduk) { ?>
                                                            <div class="btn-aksi-group">
                                                                <button class="btn btn-warning btn-sm BtnEdit" 
                                                                        data-id="<?= $row['id'] ?>"
                                                                        data-row-id="<?= $rowId ?>"
                                                                        data-order="<?= $globalRowCounter ?>"
                                                                        data-unique="<?= $uniqueId ?>"
                                                                        title="Edit Induk">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-danger btn-sm BtnHapus" 
                                                                        data-id="<?= $row['id'] ?>"
                                                                        title="Hapus">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        <?php } else { ?>
                                                            -
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                <?php 
                                        }
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="<?= isset($_SESSION['Level']) && $_SESSION['Level'] == 3 ? 9 : 8 ?>" 
                                            class="text-center" style="padding:30px;">
                                            <i class="notika-icon notika-info" style="font-size:24px; display:block;"></i>
                                            <span style="font-size:16px; color:#999;">Belum ada data</span>
                                            <br><small class="text-muted">Klik tombol "Tambah Indikator" untuk menambahkan</small>
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

<!-- ================================================================
MODAL TAMBAH/EDIT INDIKATOR UTAMA
================================================================ -->
<div class="modal fade fixed-modal" id="ModalForm" role="dialog">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header" style="background:#28a745; color:#fff;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b><i class="notika-icon bi-plus-lg"></i> <span id="ModalTitle">Tambah</span> Indikator Utama Pembangunan</b></h4>
            </div>

            <div class="modal-body">
                <form id="FormIndikator">
                    <input type="hidden" name="id" id="FormId" value="">
                    <input type="hidden" name="row_id" id="FormRowId" value="">
                    <input type="hidden" name="row_order" id="FormRowOrder" value="">
                    <input type="hidden" name="row_unique" id="FormRowUnique" value="">

                    <!-- 2 KOLOM: RKP 2026 dan KAB/KOTA -->
                    <div class="row">
                        <!-- KOLOM KIRI: RKP 2026 -->
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><b>RKP 2026</b></h4>
                                    <small style="color:#fff;">(Opsional)</small>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label><b>Nomor RKP</b></label>
                                        <input type="text" name="nomor_rkp" id="FormNomorRKP" class="form-control" placeholder="Contoh: 1">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Nama Indikator RKP</b></label>
                                        <textarea name="nama_indikator_rkp" id="FormNamaRKP" class="form-control" rows="2" placeholder="Isi nama indikator RKP 2026"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Target RKP</b></label>
                                        <input type="text" name="target_rkp" id="FormTargetRKP" class="form-control" placeholder="Target RKP 2026">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Keterangan RKP</b></label>
                                        <textarea name="keterangan_rkp" id="FormKeteranganRKP" class="form-control" rows="2" placeholder="Keterangan RKP 2026"></textarea>
                                    </div>
                                    
                                    <!-- Perihal RKP -->
                                    <div class="form-group" style="margin-top:10px;">
                                        <label><b>Perihal RKP</b></label>
                                        <button type="button" class="btn btn-info btn-sm" id="BtnTambahPerihalRKP">
                                            <i class="fa fa-plus"></i> Tambah Perihal
                                        </button>
                                        <div id="FormPerihalWrapperRKP" style="margin-top:10px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KOLOM KANAN: KAB/KOTA -->
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><b>Kab/Kota</b></h4>
                                    <small style="color:#fff;">(Opsional)</small>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label><b>Nomor Kab/Kota</b></label>
                                        <input type="text" name="nomor_kabkota" id="FormNomorKabKota" class="form-control" placeholder="Contoh: 1">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Nama Indikator Kab/Kota</b></label>
                                        <textarea name="nama_indikator_kabkota" id="FormNamaKabKota" class="form-control" rows="2" placeholder="Isi nama indikator Kab/Kota"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Target Kab/Kota</b></label>
                                        <input type="text" name="target_kabkota" id="FormTargetKabKota" class="form-control" placeholder="Target Kab/Kota">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Keterangan Kab/Kota</b></label>
                                        <textarea name="keterangan_kabkota" id="FormKeteranganKabKota" class="form-control" rows="2" placeholder="Keterangan Kab/Kota"></textarea>
                                    </div>
                                    
                                    <!-- Perihal Kab/Kota -->
                                    <div class="form-group" style="margin-top:10px;">
                                        <label><b>Perihal Kab/Kota</b></label>
                                        <button type="button" class="btn btn-info btn-sm" id="BtnTambahPerihalKabKota">
                                            <i class="fa fa-plus"></i> Tambah Perihal
                                        </button>
                                        <div id="FormPerihalWrapperKabKota" style="margin-top:10px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:center; gap:10px; margin-top:15px;">
                        <button type="button" class="btn btn-success" id="BtnSimpan"><b>SIMPAN</b></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
JAVASCRIPT
================================================================ -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
// ============================================================
// KONFIGURASI
// ============================================================
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var KODE_WILAYAH = '<?= addslashes($KodeWilayah ?? '') ?>';

// ============================================================
// HELPERS
// ============================================================
function escapeHtml(text) {
    if (!text) return '';
    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// ============================================================
// FUNGSI CREATE PERIHAL ROW - RKP
// ============================================================
function createPerihalRowRKP(data) {
    data = data || {};
    return `
        <div class="perihal-row">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="perihal_nomor_rkp[]" class="form-control" 
                           value="${escapeHtml(data.nomor_perihal || '')}" placeholder="No.">
                </div>
                <div class="col-md-4">
                    <input type="text" name="perihal_nama_rkp[]" class="form-control" 
                           value="${escapeHtml(data.nama_perihal || '')}" placeholder="Nama Perihal RKP">
                </div>
                <div class="col-md-2">
                    <input type="text" name="perihal_target_rkp[]" class="form-control" 
                           value="${escapeHtml(data.target || '')}" placeholder="Target">
                </div>
                <div class="col-md-3">
                    <input type="text" name="perihal_keterangan_rkp[]" class="form-control" 
                           value="${escapeHtml(data.keterangan || '')}" placeholder="Keterangan">
                </div>
                <div class="col-md-1" style="text-align:right;">
                    <button type="button" class="btn btn-danger btn-sm BtnRemovePerihal" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="perihal_id_rkp[]" value="${data.id || ''}">
        </div>
    `;
}

// ============================================================
// FUNGSI CREATE PERIHAL ROW - KAB/KOTA
// ============================================================
function createPerihalRowKabKota(data) {
    data = data || {};
    return `
        <div class="perihal-row">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="perihal_nomor_kabkota[]" class="form-control" 
                           value="${escapeHtml(data.nomor_perihal || '')}" placeholder="No.">
                </div>
                <div class="col-md-4">
                    <input type="text" name="perihal_nama_kabkota[]" class="form-control" 
                           value="${escapeHtml(data.nama_perihal || '')}" placeholder="Nama Perihal Kab/Kota">
                </div>
                <div class="col-md-2">
                    <input type="text" name="perihal_target_kabkota[]" class="form-control" 
                           value="${escapeHtml(data.target || '')}" placeholder="Target">
                </div>
                <div class="col-md-3">
                    <input type="text" name="perihal_keterangan_kabkota[]" class="form-control" 
                           value="${escapeHtml(data.keterangan || '')}" placeholder="Keterangan">
                </div>
                <div class="col-md-1" style="text-align:right;">
                    <button type="button" class="btn btn-danger btn-sm BtnRemovePerihal" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="perihal_id_kabkota[]" value="${data.id || ''}">
        </div>
    `;
}

// ============================================================
// TAMBAH PERIHAL DI MODAL FORM
// ============================================================
$('#BtnTambahPerihalRKP').click(function() {
    $('#FormPerihalWrapperRKP').append(createPerihalRowRKP({}));
});

$('#BtnTambahPerihalKabKota').click(function() {
    $('#FormPerihalWrapperKabKota').append(createPerihalRowKabKota({}));
});

$(document).on('click', '.BtnRemovePerihal', function() {
    var row = $(this).closest('.perihal-row');
    var wrapper = row.closest('div[id^="FormPerihalWrapper"]');
    var count = wrapper.find('.perihal-row').length;
    
    if (count <= 1) {
        alert('Minimal harus ada 1 perihal!');
        return;
    }
    
    var idInput = row.find('input[type="hidden"]');
    if (idInput.val()) {
        var wrapperId = wrapper.attr('id');
        var deletedField = (wrapperId.includes('RKP')) ? 'perihal_deleted_rkp[]' : 'perihal_deleted_kabkota[]';
        row.append('<input type="hidden" name="' + deletedField + '" value="' + idInput.val() + '">');
    }
    row.remove();
});

// ============================================================
// SIMPAN / UPDATE INDIKATOR UTAMA - DENGAN MULTIPLE SCROLL FALLBACK
// ============================================================
$('#BtnSimpan').click(function() {
    var btn = $(this);
    btn.prop('disabled', true).text('Menyimpan...');
    
    var id = $('#FormId').val();
    var rowId = $('#FormRowId').val();
    var rowOrder = $('#FormRowOrder').val();
    var rowUnique = $('#FormRowUnique').val();
    var nomorRKP = $('#FormNomorRKP').val().trim();
    var namaRKP = $('#FormNamaRKP').val().trim();
    var targetRKP = $('#FormTargetRKP').val().trim();
    var keteranganRKP = $('#FormKeteranganRKP').val().trim();
    
    var nomorKabKota = $('#FormNomorKabKota').val().trim();
    var namaKabKota = $('#FormNamaKabKota').val().trim();
    var targetKabKota = $('#FormTargetKabKota').val().trim();
    var keteranganKabKota = $('#FormKeteranganKabKota').val().trim();
    
    var hasRKP = nomorRKP || namaRKP;
    var hasKabKota = nomorKabKota || namaKabKota;
    
    if (!hasRKP && !hasKabKota) {
        alert('Minimal isi salah satu: RKP 2026 atau Kab/Kota!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    
    if (hasRKP && !nomorRKP) {
        alert('Nomor RKP 2026 wajib diisi jika mengisi indikator RKP!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    
    if (hasKabKota && !nomorKabKota) {
        alert('Nomor Kab/Kota wajib diisi jika mengisi indikator Kab/Kota!');
        btn.prop('disabled', false).text('SIMPAN');
        return;
    }
    
    // Kumpulkan perihal RKP
    var perihalIdRKP = [], perihalNomorRKP = [], perihalNamaRKP = [], 
        perihalTargetRKP = [], perihalKeteranganRKP = [];
    $('#FormPerihalWrapperRKP .perihal-row').each(function() {
        var nama = $(this).find('input[name="perihal_nama_rkp[]"]').val().trim();
        if (nama) {
            perihalIdRKP.push($(this).find('input[name="perihal_id_rkp[]"]').val() || '');
            perihalNomorRKP.push($(this).find('input[name="perihal_nomor_rkp[]"]').val().trim() || '');
            perihalNamaRKP.push(nama);
            perihalTargetRKP.push($(this).find('input[name="perihal_target_rkp[]"]').val().trim() || '');
            perihalKeteranganRKP.push($(this).find('input[name="perihal_keterangan_rkp[]"]').val().trim() || '');
        }
    });
    
    // Kumpulkan perihal Kab/Kota
    var perihalIdKabKota = [], perihalNomorKabKota = [], perihalNamaKabKota = [], 
        perihalTargetKabKota = [], perihalKeteranganKabKota = [];
    $('#FormPerihalWrapperKabKota .perihal-row').each(function() {
        var nama = $(this).find('input[name="perihal_nama_kabkota[]"]').val().trim();
        if (nama) {
            perihalIdKabKota.push($(this).find('input[name="perihal_id_kabkota[]"]').val() || '');
            perihalNomorKabKota.push($(this).find('input[name="perihal_nomor_kabkota[]"]').val().trim() || '');
            perihalNamaKabKota.push(nama);
            perihalTargetKabKota.push($(this).find('input[name="perihal_target_kabkota[]"]').val().trim() || '');
            perihalKeteranganKabKota.push($(this).find('input[name="perihal_keterangan_kabkota[]"]').val().trim() || '');
        }
    });
    
    // Kumpulkan perihal yang dihapus
    var perihalDeletedRKP = [];
    $('#FormPerihalWrapperRKP input[name="perihal_deleted_rkp[]"]').each(function() {
        perihalDeletedRKP.push($(this).val());
    });
    
    var perihalDeletedKabKota = [];
    $('#FormPerihalWrapperKabKota input[name="perihal_deleted_kabkota[]"]').each(function() {
        perihalDeletedKabKota.push($(this).val());
    });
    
    var payload = {
        id: id || '',
        nomor_rkp: nomorRKP || '',
        nama_indikator_rkp: namaRKP || '',
        target_rkp: targetRKP || '',
        keterangan_rkp: keteranganRKP || '',
        nomor_kabkota: nomorKabKota || '',
        nama_indikator_kabkota: namaKabKota || '',
        target_kabkota: targetKabKota || '',
        keterangan_kabkota: keteranganKabKota || '',
        perihal_id_rkp: perihalIdRKP,
        perihal_nomor_rkp: perihalNomorRKP,
        perihal_nama_rkp: perihalNamaRKP,
        perihal_target_rkp: perihalTargetRKP,
        perihal_keterangan_rkp: perihalKeteranganRKP,
        perihal_id_kabkota: perihalIdKabKota,
        perihal_nomor_kabkota: perihalNomorKabKota,
        perihal_nama_kabkota: perihalNamaKabKota,
        perihal_target_kabkota: perihalTargetKabKota,
        perihal_keterangan_kabkota: perihalKeteranganKabKota,
        perihal_deleted_rkp: perihalDeletedRKP,
        perihal_deleted_kabkota: perihalDeletedKabKota,
        [CSRF_NAME]: CSRF_TOKEN
    };
    
    // ============================================================
    // CARI POSISI TARGET DENGAN MULTIPLE FALLBACK
    // ============================================================
    var targetPosition = $(window).scrollTop();
    
    // Method 1: Cari berdasarkan rowId
    var targetRow = $('#' + rowId);
    if (targetRow.length > 0) {
        targetPosition = targetRow.offset().top - 150;
    }
    
    // Method 2: Cari berdasarkan data-unique
    if (targetRow.length === 0 && rowUnique) {
        var targetByUnique = $('tr[data-unique="' + rowUnique + '"]');
        if (targetByUnique.length > 0) {
            targetPosition = targetByUnique.offset().top - 150;
        }
    }
    
    // Method 3: Cari berdasarkan data-order
    if (targetRow.length === 0 && rowOrder) {
        var targetByOrder = $('tr[data-order="' + rowOrder + '"]');
        if (targetByOrder.length > 0) {
            targetPosition = targetByOrder.offset().top - 150;
        }
    }
    
    // Method 4: Cari berdasarkan data-parent dan data-row
    if (targetRow.length === 0 && rowId) {
        var parentId = rowId.split('_')[1];
        var rowIndex = rowId.split('_')[2];
        if (parentId && rowIndex !== undefined) {
            var targetByParent = $('tr[data-parent="' + parentId + '"][data-row="' + rowIndex + '"]');
            if (targetByParent.length > 0) {
                targetPosition = targetByParent.offset().top - 150;
            }
        }
    }
    
    var url = id ? BaseURL + "Daerah/UpdateIndikatorUtama" : BaseURL + "Daerah/InputIndikatorUtama";
    
    $.ajax({
        url: url,
        type: "POST",
        data: payload,
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                alert(res.message);
                // Reload dengan parameter scroll ke posisi target
                window.location.href = window.location.pathname + '?scroll_to=' + Math.floor(targetPosition) + '&t=' + new Date().getTime();
            } else {
                alert(res.message || 'Gagal menyimpan!');
                btn.prop('disabled', false).text('SIMPAN');
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
            btn.prop('disabled', false).text('SIMPAN');
        }
    });
});

// ============================================================
// SCROLL KE POSISI SEBELUMNYA SETELAH RELOAD
// ============================================================
$(document).ready(function() {
    // Cek parameter scroll di URL
    var urlParams = new URLSearchParams(window.location.search);
    var scrollTo = urlParams.get('scroll_to');
    
    if (scrollTo) {
        // Scroll ke posisi yang disimpan
        setTimeout(function() {
            $('html, body').animate({
                scrollTop: parseInt(scrollTo)
            }, 400);
            
            // Hapus parameter dari URL
            var newUrl = window.location.pathname + window.location.search;
            newUrl = newUrl.replace(/[&?]scroll_to=[^&]*/, '');
            newUrl = newUrl.replace(/[&?]t=[^&]*/, '');
            newUrl = newUrl.replace(/[&?]$/, '');
            newUrl = newUrl.replace(/\?$/, '');
            window.history.replaceState({}, document.title, newUrl);
        }, 500);
    }
});

// ============================================================
// EDIT INDIKATOR UTAMA - OPEN MODAL
// ============================================================
$(document).on('click', '.BtnEdit', function() {
    var id = $(this).data('id');
    var rowId = $(this).data('row-id');
    var rowOrder = $(this).data('order');
    var rowUnique = $(this).data('unique');
    
    if (!id) return;
    
    $('#ModalTitle').text('Edit');
    $('#FormId').val(id);
    $('#FormRowId').val(rowId || '');
    $('#FormRowOrder').val(rowOrder || '');
    $('#FormRowUnique').val(rowUnique || '');
    $('#FormNomorRKP').val('');
    $('#FormNamaRKP').val('');
    $('#FormTargetRKP').val('');
    $('#FormKeteranganRKP').val('');
    $('#FormNomorKabKota').val('');
    $('#FormNamaKabKota').val('');
    $('#FormTargetKabKota').val('');
    $('#FormKeteranganKabKota').val('');
    $('#FormPerihalWrapperRKP').html('');
    $('#FormPerihalWrapperKabKota').html('');
    
    $.ajax({
        url: BaseURL + "Daerah/GetIndikatorUtamaById",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success' && res.data) {
                var d = res.data;
                
                $('#FormId').val(d.id);
                $('#FormNomorRKP').val(d.nomor_rkp || '');
                $('#FormNamaRKP').val(d.nama_indikator_rkp || '');
                $('#FormTargetRKP').val(d.target_rkp || '');
                $('#FormKeteranganRKP').val(d.keterangan_rkp || '');
                
                $('#FormNomorKabKota').val(d.nomor_kabkota || '');
                $('#FormNamaKabKota').val(d.nama_indikator_kabkota || '');
                $('#FormTargetKabKota').val(d.target_kabkota || '');
                $('#FormKeteranganKabKota').val(d.keterangan_kabkota || '');
                
                // Render perihal RKP
                var perihalRKP = d.perihal_rkp || [];
                if (perihalRKP.length > 0) {
                    $.each(perihalRKP, function(i, item) {
                        $('#FormPerihalWrapperRKP').append(createPerihalRowRKP(item));
                    });
                } else {
                    $('#FormPerihalWrapperRKP').append(createPerihalRowRKP({}));
                }
                
                // Render perihal Kab/Kota
                var perihalKabKota = d.perihal_kabkota || [];
                if (perihalKabKota.length > 0) {
                    $.each(perihalKabKota, function(i, item) {
                        $('#FormPerihalWrapperKabKota').append(createPerihalRowKabKota(item));
                    });
                } else {
                    $('#FormPerihalWrapperKabKota').append(createPerihalRowKabKota({}));
                }
                
                $('#ModalForm').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            } else {
                alert(res.message || 'Gagal mengambil data!');
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

// ============================================================
// TAMBAH INDIKATOR UTAMA - OPEN MODAL
// ============================================================
$('#BtnTambah').click(function() {
    $('#ModalTitle').text('Tambah');
    $('#FormId').val('');
    $('#FormRowId').val('');
    $('#FormRowOrder').val('');
    $('#FormRowUnique').val('');
    $('#FormNomorRKP').val('');
    $('#FormNamaRKP').val('');
    $('#FormTargetRKP').val('');
    $('#FormKeteranganRKP').val('');
    $('#FormNomorKabKota').val('');
    $('#FormNamaKabKota').val('');
    $('#FormTargetKabKota').val('');
    $('#FormKeteranganKabKota').val('');
    $('#FormPerihalWrapperRKP').html('');
    $('#FormPerihalWrapperKabKota').html('');
    
    $('#FormPerihalWrapperRKP').append(createPerihalRowRKP({}));
    $('#FormPerihalWrapperKabKota').append(createPerihalRowKabKota({}));
    
    $('#ModalForm').modal({
        backdrop: 'static',
        keyboard: false
    });
});

// ============================================================
// HAPUS INDIKATOR UTAMA
// ============================================================
$(document).on('click', '.BtnHapus', function() {
    var id = $(this).data('id');
    if (!id) return;
    if (!confirm('Yakin hapus data ini dan semua perihalnya?')) return;
    
    $.ajax({
        url: BaseURL + "Daerah/HapusIndikatorUtama",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: 'json',
        success: function(res) {
            if (res.status == 'success') {
                alert(res.message);
                window.location.reload();
            } else {
                alert(res.message || 'Gagal hapus!');
            }
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});

// ============================================================
// FILTER
// ============================================================
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
            beforeSend: function() { $("#KabKota").prop('disabled', true); },
            success: function(res) {
                var Data = (typeof res === 'string') ? JSON.parse(res) : res;
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
            },
            error: function() {
                $("#KabKota").prop('disabled', false);
            }
        });
    });

    $("#FilterBtn").click(function() {
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
            async: false
        });

        window.location.href = BaseURL + "Daerah/KeselarasanIndikatorUtama";
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv);

        $.ajax({
            url: BaseURL + "Daerah/GetListKabKota",
            type: "POST",
            data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
            success: function(res) {
                var Data = (typeof res === 'string') ? JSON.parse(res) : res;
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

// ============================================================
// DATA TABLE - MENJAGA URUTAN TETAP DENGAN DATA-ORDER
// ============================================================
$(document).ready(function() {
    if ($('#data-table').length > 0) {
        try {
            // Hancurkan DataTable jika sudah ada
            if ($.fn.DataTable.isDataTable('#data-table')) {
                $('#data-table').DataTable().destroy();
            }
            
            // Inisialisasi DataTable
            $('#data-table').DataTable({
                "pageLength": 50,
                "ordering": false,
                "searching": false,
                "paging": true,
                "info": true,
                "columnDefs": [
                    { "orderable": false, "targets": "_all" }
                ],
                "stateSave": false,
                "drawCallback": function() {
                    // Memastikan data-order tetap valid setelah redraw
                    var table = this.api();
                    var rows = table.rows().nodes();
                    var orderIndex = 1;
                    var currentParent = '';
                    var rowIndex = 0;
                    
                    $(rows).each(function(index, row) {
                        var parentId = $(row).data('parent');
                        var currentRow = $(row).data('row');
                        
                        // Reset rowIndex jika parent berubah
                        if (parentId !== currentParent) {
                            currentParent = parentId;
                            rowIndex = 0;
                        }
                        
                        // Set data-order berdasarkan urutan tampilan
                        $(row).attr('data-order', orderIndex);
                        
                        // Set data-row sesuai urutan per parent
                        if (currentRow !== undefined) {
                            $(row).attr('data-row', rowIndex);
                            rowIndex++;
                        }
                        
                        orderIndex++;
                    });
                }
            });
            
        } catch(e) { 
            console.log('DataTable Error:', e); 
        }
    }
});
</script>

</body>
</html>