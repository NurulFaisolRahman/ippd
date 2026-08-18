<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* ========== STYLE KHUSUS PERJANJIAN KINERJA ========== */
/* ========== STATUS BADGE & SELECT PREMIUM DESIGN ========== */
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 5px 12px;
    border-radius: 9999px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.3px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
}
.status-pill-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}

/* Status Disetujui */
.status-pill.status-disetujui,
.select-status-level3.status-disetujui {
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%) !important;
    color: #065f46 !important;
    border: 1px solid #86efac !important;
}
.status-pill.status-disetujui .status-pill-dot {
    background: #10b981;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25);
}

/* Status Menunggu */
.status-pill.status-menunggu,
.select-status-level3.status-menunggu {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%) !important;
    color: #92400e !important;
    border: 1px solid #fde68a !important;
}
.status-pill.status-menunggu .status-pill-dot {
    background: #f59e0b;
    box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.25);
    animation: statusPulse 2s infinite ease-in-out;
}

/* Status Ditolak */
.status-pill.status-ditolak,
.select-status-level3.status-ditolak {
    background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%) !important;
    color: #9f1239 !important;
    border: 1px solid #fecdd3 !important;
}
.status-pill.status-ditolak .status-pill-dot {
    background: #f43f5e;
    box-shadow: 0 0 0 2px rgba(244, 63, 94, 0.25);
}

@keyframes statusPulse {
    0% { transform: scale(0.92); opacity: 0.8; }
    50% { transform: scale(1.22); opacity: 1; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2); }
    100% { transform: scale(0.92); opacity: 0.8; }
}

/* Custom Interactive Select Level 3 */
.select-status-wrapper {
    position: relative;
    display: inline-block;
}
.select-status-level3 {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    border-radius: 9999px !important;
    font-size: 11.5px !important;
    font-weight: 700 !important;
    padding: 4px 26px 4px 12px !important;
    height: 28px !important;
    cursor: pointer !important;
    outline: none !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
    letter-spacing: 0.2px !important;
}
.select-status-level3:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
}
.select-status-wrapper::after {
    content: "▾";
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    font-size: 12px;
    font-weight: bold;
    color: currentColor;
    opacity: 0.75;
}

.btn-upload {
    position: relative;
    overflow: hidden;
}
.btn-upload input[type=file] {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    opacity: 0;
    cursor: pointer;
}
.upload-preview {
    font-size: 12px;
    color: #6c757d;
    margin-top: 5px;
}
.form-control[readonly] {
    background-color: #f8f9fa;
}
.modal-lg-custom {
    max-width: 85%;
}

/* ============================================================ */
/* FIX Z-INDEX POP UP: Selalu di paling depan (tidak tertimpa header) */
/* ============================================================ */
.modal {
    z-index: 999999 !important;
}
.modal-backdrop {
    z-index: 999990 !important;
}
.modal-dialog {
    z-index: 1000000 !important;
}

/* Style Tab / Slide Dokumen */
.doc-slide-nav {
    display: flex;
    gap: 10px;
    background: #f1f5f9;
    padding: 6px;
    border-radius: 8px;
    margin-bottom: 15px;
}
.doc-slide-btn {
    flex: 1;
    text-align: center;
    padding: 10px 15px;
    font-size: 14px;
    font-weight: 700;
    border: none;
    border-radius: 6px;
    background: transparent;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
}
.doc-slide-btn:hover {
    background: #e2e8f0;
    color: #1e293b;
}
.doc-slide-btn.active {
    background: #2563eb;
    color: #ffffff;
    box-shadow: 0 2px 4px rgba(37,99,235,0.25);
}
.doc-slide-pane {
    display: none;
}
.doc-slide-pane.active {
    display: block;
}

/* Kolom Dokumen Clickable (Tanpa Button) */
.cell-doc-clickable {
    cursor: pointer !important;
    transition: all 0.2s ease;
    user-select: none;
    text-align: center;
    vertical-align: middle !important;
}
.cell-doc-clickable:hover {
    background-color: #eff6ff !important;
}
.doc-card-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #eff6ff;
    color: #1d4ed8;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 12px;
    border: 1px solid #bfdbfe;
    transition: all 0.2s ease;
}
.cell-doc-clickable:hover .doc-card-badge {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(37,99,235,0.25);
}

/* ============================================================ */
/* RADIO BUTTON MODEL CENTANG (TOGGLE)                          */
/* ============================================================ */
.sasaran-item {
    position: relative;
    padding: 10px 15px 10px 50px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    margin-bottom: 8px;
    background: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}
.sasaran-item:hover {
    border-color: #6c757d;
    background: #f8f9fa;
}
.sasaran-item.selected {
    border-color: #2563eb;
    background: #eff6ff;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}
.sasaran-item .radio-indicator {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    width: 22px;
    height: 22px;
    border-radius: 50%;
    border: 2px solid #adb5bd;
    background: #fff;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.sasaran-item.selected .radio-indicator {
    border-color: #2563eb;
    background: #2563eb;
}
.sasaran-item.selected .radio-indicator::after {
    content: "✓";
    color: #fff;
    font-size: 14px;
    font-weight: 700;
}
.sasaran-item .sasaran-text {
    font-weight: 700;
    font-size: 14px;
    color: #1e293b;
    display: block;
}
.sasaran-item .sasaran-detail-text {
    display: block;
    font-size: 13px;
    color: #495057;
    margin-top: 2px;
}
.sasaran-item .sub-unit {
    font-size: 12px;
    color: #6c757d;
    display: block;
    margin-top: 2px;
}
.sasaran-item .radio-hidden {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}
.sasaran-detail {
    margin-left: 30px;
    margin-top: 10px;
    padding: 12px 15px;
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    display: none;
}
.sasaran-detail table {
    margin-bottom: 0;
    font-size: 13px;
}
.sasaran-detail table th {
    font-size: 12px;
    padding: 4px 8px;
}
.sasaran-detail table td {
    padding: 4px 8px;
}
.selected-count {
    margin-top: 10px;
    font-size: 13px;
    color: #6c757d;
}
.selected-count b {
    color: #2563eb;
}

/* ===== CHECKBOX ANGGARAN ===== */
.anggaran-checkbox-group {
    margin-top: 5px;
}
.anggaran-checkbox-group label {
    font-weight: normal;
    cursor: pointer;
}
.anggaran-checkbox-group input[type="checkbox"] {
    margin-right: 5px;
    width: 18px;
    height: 18px;
    cursor: pointer;
}
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- ===== FILTER WILAYAH SAMPAI INSTANSI (SEBELUM LOGIN) ===== -->
                        <?php if (!$IsLoggedIn || !isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px; background:#fff; padding:15px 20px; border-radius:6px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group" style="margin-bottom:0;">
                                        <div class="row filter-row" style="display:flex; align-items:flex-end; flex-wrap:wrap; gap:12px;">
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>"
                                                                <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                                <?= html_escape($prov['Nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="filter-group">
                                                    <label for="KabKota"><b>Kab/Kota</b></label>
                                                    <select class="form-control filter-select" id="KabKota">
                                                        <option value="">Pilih Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-6" id="FilterInstansiGroup" style="display: none;">
                                                <div class="filter-group">
                                                    <label for="FilterInstansiBeforeLogin"><b>Instansi / Perangkat Daerah</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansiBeforeLogin">
                                                        <option value="">-- Semua Instansi --</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-3 col-sm-6">
                                                <div class="filter-group">
                                                    <button class="btn btn-primary btn-block" id="Filter" style="font-weight:600;">
                                                        <i class="fa fa-filter"></i> Filter
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px; font-size:13px;">
                                    <strong><i class="fa fa-map-marker"></i> Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                    <?php 
                                    if (!empty($FilterInstansiId)) { 
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $FilterInstansiId)->get()->row_array();
                                    ?>
                                        | <strong><i class="fa fa-building"></i> Instansi:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <!-- ===== FILTER INSTANSI (UNTUK ROLE DAERAH / NON-ROLE 4 SAAT SUDAH LOGIN) ===== -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px; background:#fff; padding:15px 20px; border-radius:6px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group" style="margin-bottom:0;">
                                        <div class="row filter-row" style="display:flex; align-items:flex-end; flex-wrap:wrap; gap:12px;">
                                            <div class="col-lg-5 col-md-6">
                                                <div class="filter-group">
                                                    <label for="FilterInstansi"><b>Pilih Akun Instansi / Perangkat Daerah:</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansi">
                                                        <option value="">-- Semua Instansi di <?= htmlspecialchars($NamaWilayah ?: 'Daerah') ?> --</option>
                                                        <?php foreach ($ListInstansi as $ins) { ?>
                                                            <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                                <?= html_escape($ins['nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-3">
                                                <div class="filter-group">
                                                    <button class="btn btn-info btn-block" id="FilterInstansiBtn" style="font-weight:600;">
                                                        <i class="fa fa-search"></i> Tampilkan
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-3">
                                                <div class="filter-group">
                                                    <button class="btn btn-default btn-block" id="ResetFilterBtn">
                                                        <i class="fa fa-refresh"></i> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- ===== TOMBOL TAMBAH & DROPDOWN TAHUN ===== -->
                        <div style="margin-bottom:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                            <div>
                                <?php if ($IsRole4) { ?>
                                <button class="btn btn-success" id="btnTambahPK">
                                    <i class="fa fa-plus"></i> <b>Buat Perjanjian Kinerja</b>
                                </button>
                                <?php } ?>
                            </div>
                            <div>
                                <label for="tahun_filter" style="font-weight:bold; margin-right:6px;">Tahun:</label>
                                <select id="tahun_filter" class="form-control" style="width:auto;display:inline-block;">
                                    <?php for ($y = date('Y'); $y >= 2020; $y--) { ?>
                                        <option value="<?= $y ?>" <?= ($y == date('Y')) ? 'selected' : '' ?>><?= $y ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- ===== TABEL DAFTAR PERJANJIAN KINERJA ===== -->
                        <div class="table-card">
                            <div class="table-scroll">
                                <table class="table table-bordered table-hover" style="min-width:1200px;">
                                    <thead>
                                        <tr style="background:#f8fafc;">
                                            <th style="text-align:center; vertical-align:middle; width:40px;">No</th>
                                            <?php if (!$IsRole4) { ?>
                                            <th style="text-align:center; vertical-align:middle;">Perangkat Daerah / Instansi</th>
                                            <?php } ?>
                                            <th style="vertical-align:middle;">Nama / NIP / Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Eselon</th>
                                            <th style="text-align:center; vertical-align:middle;">Awal</th>
                                            <th style="text-align:center; vertical-align:middle;">Akhir</th>
                                            <th style="text-align:center; vertical-align:middle;">Definitif</th>
                                            <th style="text-align:center; vertical-align:middle;">PK Perubahan</th>
                                            <th style="text-align:center; vertical-align:middle;">PK PLT</th>
                                            <th style="text-align:center; vertical-align:middle;">Status</th>
                                            <th style="text-align:center; vertical-align:middle;">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($PerjanjianKinerja)) {
                                            $no = 1;
                                            foreach ($PerjanjianKinerja as $pk) {
                                                $status_class = '';
                                                $status_text = $pk['status'];
                                                if ($status_text == 'disetujui') $status_class = 'status-disetujui';
                                                elseif ($status_text == 'menunggu')  $status_class = 'status-menunggu';
                                                elseif ($status_text == 'ditolak')   $status_class = 'status-ditolak';

                                                $hasDefinitif = (!empty($pk['dokumen_utama']) || !empty($pk['dokumen_lampiran']) || !empty($pk['definitif_doc_id']) || $pk['jenis_perjanjian'] == 'PK Murni');
                                                $hasPerubahan = (!empty($pk['dokumen_perubahan_utama']) || !empty($pk['dokumen_perubahan_lampiran']) || !empty($pk['pk_perubahan_doc_id']));
                                                $hasPLT = (!empty($pk['dokumen_plt_utama']) || !empty($pk['dokumen_plt_lampiran']) || !empty($pk['pk_plt_doc_id']));

                                                $docDefinitif = $pk['definitif_doc_id'] ?: ('DOC-' . $pk['id']);
                                                $docPerubahan = $pk['pk_perubahan_doc_id'] ?: ('DOC-P-' . $pk['id']);
                                                $docPLT = $pk['pk_plt_doc_id'] ?: ('DOC-PLT-' . $pk['id']);
                                        ?>
                                        <tr>
                                            <td style="text-align:center; vertical-align:middle;"><?= $no++ ?></td>
                                            <?php if (!$IsRole4) { ?>
                                            <td style="vertical-align:middle;"><span class="badge" style="background:#f1f5f9; color:#334155; border:1px solid #cbd5e1; font-weight:600; padding:5px 8px;"><?= htmlspecialchars($pk['nama_instansi'] ?? '-') ?></span></td>
                                            <?php } ?>
                                            <td style="vertical-align:middle;">
                                                <strong><?= htmlspecialchars($pk['pengampu_nama'] ?? '') ?></strong><br>
                                                <span style="font-size:12px; color:#475569;">NIP: <?= htmlspecialchars($pk['pengampu_nip'] ?? '-') ?></span><br>
                                                <span style="font-size:12px; color:#2563eb;"><?= htmlspecialchars($pk['pengampu_jabatan'] ?? '-') ?></span>
                                            </td>
                                            <td style="text-align:center; vertical-align:middle; font-weight:600;"><?= $pk['eselon'] ?? '-' ?></td>
                                            <td style="text-align:center; vertical-align:middle;"><?= date('F', mktime(0,0,0, (int)$pk['periode_awal'], 1)) ?></td>
                                            <td style="text-align:center; vertical-align:middle;"><?= date('F', mktime(0,0,0, (int)$pk['periode_akhir'], 1)) ?></td>
                                            
                                            <!-- Definitif (PK Murni) -->
                                            <?php if ($hasDefinitif) { ?>
                                            <td class="cell-doc-clickable" data-id="<?= $pk['id'] ?>" data-doctype="definitif" title="Klik untuk membuka dokumen Definitif">
                                                <div class="doc-card-badge">
                                                    <i class="fa fa-file-text-o"></i> <?= htmlspecialchars($docDefinitif) ?>
                                                </div>
                                            </td>
                                            <?php } else { ?>
                                            <td style="text-align:center; vertical-align:middle;"><span class="text-muted">-</span></td>
                                            <?php } ?>
                                            
                                            <!-- PK Perubahan -->
                                            <?php if ($hasPerubahan) { ?>
                                            <td class="cell-doc-clickable" data-id="<?= $pk['id'] ?>" data-doctype="perubahan" title="Klik untuk membuka dokumen PK Perubahan">
                                                <div class="doc-card-badge" style="background:#fef3c7; color:#b45309; border-color:#fde68a;">
                                                    <i class="fa fa-refresh"></i> <?= htmlspecialchars($docPerubahan) ?>
                                                </div>
                                            </td>
                                            <?php } else { ?>
                                            <td style="text-align:center; vertical-align:middle;"><span class="text-muted">-</span></td>
                                            <?php } ?>
                                            
                                            <!-- PK PLT -->
                                            <?php if ($hasPLT) { ?>
                                            <td class="cell-doc-clickable" data-id="<?= $pk['id'] ?>" data-doctype="plt" title="Klik untuk membuka dokumen PK PLT">
                                                <div class="doc-card-badge" style="background:#f3e8ff; color:#7e22ce; border-color:#e9d5ff;">
                                                    <i class="fa fa-users"></i> <?= htmlspecialchars($docPLT) ?>
                                                </div>
                                            </td>
                                            <?php } else { ?>
                                            <td style="text-align:center; vertical-align:middle;"><span class="text-muted">-</span></td>
                                            <?php } ?>
                                            
                                            <td style="text-align:center; vertical-align:middle;">
                                                <?php if ($IsRole3) { ?>
                                                    <div class="select-status-wrapper" title="Klik untuk mengubah status verifikasi (Role Daerah Level 3)">
                                                        <select class="select-status-level3 status-<?= $status_text ?>" data-id="<?= $pk['id'] ?>" data-prev="<?= $status_text ?>">
                                                            <option value="menunggu" <?= ($status_text == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                                                            <option value="disetujui" <?= ($status_text == 'disetujui') ? 'selected' : '' ?>>Disetujui</option>
                                                            <option value="ditolak" <?= ($status_text == 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <span class="status-pill status-<?= $status_text ?>">
                                                        <span class="status-pill-dot"></span>
                                                        <span><?= ucfirst($status_text) ?></span>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align:center; vertical-align:middle; white-space:nowrap;">
                                                <?php if ($IsRole4) { ?>
                                                <button class="btn btn-sm btn-primary btn-edit-pk" data-id="<?= $pk['id'] ?>" title="Edit / Tambah Dokumen PK"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-sm btn-danger btn-hapus-pk" data-id="<?= $pk['id'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php }
                                        } else { ?>
                                        <tr><td colspan="<?= $IsRole4 ? '10' : '11' ?>" style="text-align:center;padding:30px 0;">Belum ada data Perjanjian Kinerja</td></tr>
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
</div>

<!-- ================================================================ -->
<!-- MODAL FORM PERJANJIAN KINERJA (TAMBAH / EDIT)                    -->
<!-- ================================================================ -->
<div class="modal fade" id="modalPK" role="dialog">
    <div class="modal-dialog modal-lg modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modalPKTitle">Buat Perjanjian Kinerja</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="pk_id" value="">
                <input type="hidden" id="tahun_selected" value="">
                
                <!-- Hidden Flags untuk Hapus File -->
                <input type="hidden" id="delete_dokumen_utama" value="0">
                <input type="hidden" id="delete_dokumen_lampiran" value="0">
                <input type="hidden" id="delete_dokumen_perubahan_utama" value="0">
                <input type="hidden" id="delete_dokumen_perubahan_lampiran" value="0">
                <input type="hidden" id="delete_dokumen_plt_utama" value="0">
                <input type="hidden" id="delete_dokumen_plt_lampiran" value="0">

                <!-- ===== 1. PEGAWAI PENGAMPU ===== -->
                <div class="form-group">
                    <label><b>Pilih Pegawai Pengampu</b> <span class="text-danger">*</span></label>
                    <select class="form-control" id="pegawai_pengampu_id" required>
                        <option value="">-- Pilih Pegawai --</option>
                        <?php foreach ($PegawaiList as $p) { ?>
                        <option value="<?= $p['id'] ?>"
                                data-nip="<?= htmlspecialchars($p['nip'] ?? '') ?>"
                                data-jabatan="<?= htmlspecialchars($p['jabatan'] ?? '') ?>"
                                data-eselon="<?= htmlspecialchars($p['eselon'] ?? '') ?>"
                                data-satuan="<?= htmlspecialchars($p['satuan_unit_kerja'] ?? '') ?>">
                            <?= htmlspecialchars($p['nama']) ?> (NIP: <?= $p['nip'] ?>) - <?= htmlspecialchars($p['jabatan']) ?><?= !empty($p['eselon']) ? ' [' . $p['eselon'] . ']' : '' ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIP Pegawai</label>
                            <input type="text" class="form-control" id="pengampu_nip" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jabatan Pegawai</label>
                            <input type="text" class="form-control" id="pengampu_jabatan" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Eselon</label>
                            <input type="text" class="form-control" id="pengampu_eselon" readonly style="font-weight:700; color:#1e40af; background:#eff6ff;" placeholder="-">
                        </div>
                    </div>
                </div>

                <!-- ===== 2. ATASAN LANGSUNG ===== -->
                <div class="form-group">
                    <label><b>Pilih Atasan Langsung</b> <span class="text-danger">*</span></label>
                    <select class="form-control" id="atasan_langsung_id" required>
                        <option value="">-- Pilih Atasan --</option>
                        <?php foreach ($AtasanList as $a) { ?>
                        <option value="<?= $a['id'] ?>"
                                data-nip="<?= htmlspecialchars($a['nip'] ?? '') ?>"
                                data-jabatan="<?= htmlspecialchars($a['jabatan'] ?? '') ?>"
                                data-satuan="<?= htmlspecialchars($a['satuan_unit_kerja'] ?? '') ?>">
                            <?= htmlspecialchars($a['nama']) ?> (NIP: <?= $a['nip'] ?>) - <?= htmlspecialchars($a['jabatan']) ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIP Atasan</label>
                            <input type="text" class="form-control" id="atasan_nip" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jabatan Atasan</label>
                            <input type="text" class="form-control" id="atasan_jabatan" readonly>
                        </div>
                    </div>
                </div>

                <!-- ===== 3. JENIS PERJANJIAN & LEVEL SASARAN ===== -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Jenis Perjanjian</b> <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_perjanjian">
                                <option value="PK Murni">PK Murni (Definitif)</option>
                                <option value="PK Perubahan">PK Perubahan</option>
                                <option value="PK PLT">PK PLT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Level Sasaran</b> <span class="text-danger">*</span></label>
                            <select class="form-control" id="sasaran_level">
                                <option value="">-- Pilih Level --</option>
                                <option value="program">Program</option>
                                <option value="kegiatan">Kegiatan</option>
                                <option value="sub_kegiatan">Sub Kegiatan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ===== 4. LIST SASARAN & INDIKATOR TARGET ===== -->
                <div class="form-group">
                    <label><b>Pilih Sasaran</b> <span class="text-danger">*</span></label>
                    <div id="sasaran_list">
                        <p class="text-muted">Pilih level terlebih dahulu</p>
                    </div>
                    <p class="selected-count" id="selectedCount">Belum ada sasaran dipilih</p>
                    <button type="button" class="btn btn-sm btn-secondary" id="btnBatalPilihSasaran" style="display:none;">
                        <i class="fa fa-times"></i> Batal Pilih
                    </button>
                </div>

                <!-- ===== 5. PERIODE ===== -->
                <div class="row">
                    <div class="col-md-4">
                        <label><b>Periode Awal</b></label>
                        <select class="form-control" id="periode_awal">
                            <?php for ($i=1; $i<=12; $i++) { ?>
                            <option value="<?= $i ?>"><?= date('F', mktime(0,0,0,$i,1)) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><b>Periode Akhir</b></label>
                        <select class="form-control" id="periode_akhir">
                            <?php for ($i=1; $i<=12; $i++) { ?>
                            <option value="<?= $i ?>"><?= date('F', mktime(0,0,0,$i,1)) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><b>Anggaran</b></label>
                        <div class="anggaran-checkbox-group">
                            <label>
                                <input type="checkbox" id="anggaran_checkbox" value="1"> Anggaran
                            </label>
                        </div>
                    </div>
                </div>

                <!-- ===== 6. SUB UNIT (otomatis dari sasaran terpilih) ===== -->
                <div class="form-group">
                    <label><b>Sub Unit</b></label>
                    <input type="text" class="form-control" id="sub_unit" readonly>
                </div>

                <!-- ===== 7. UPLOAD DOKUMEN (DEFINITIF, PERUBAHAN, PLT) ===== -->
                <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:15px; margin-bottom:15px;">
                    <label style="font-size:14px; color:#1e293b; margin-bottom:10px; display:block;">
                        <i class="fa fa-cloud-upload text-primary"></i> <b>Upload Dokumen (Bisa Upload Bersamaan / Satu per Satu)</b>
                    </label>

                    <!-- Nav Tabs Upload Dokumen -->
                    <ul class="nav nav-tabs" style="margin-bottom:15px;">
                        <li class="active"><a data-toggle="tab" href="#tabUploadDefinitif"><b>📄 Dokumen Definitif (PK Murni)</b></a></li>
                        <li><a data-toggle="tab" href="#tabUploadPerubahan"><b>🔄 Dokumen PK Perubahan</b></a></li>
                        <li><a data-toggle="tab" href="#tabUploadPLT"><b>👥 Dokumen PK PLT</b></a></li>
                    </ul>

                    <div class="tab-content" style="background:#fff; border:1px solid #ddd; border-top:none; padding:15px; border-radius:0 0 6px 6px;">
                        
                        <!-- TAB DEFINITIF -->
                        <div id="tabUploadDefinitif" class="tab-pane fade in active">
                            <p class="text-muted" style="font-size:12px; margin-bottom:10px;">Unggah dokumen utama & lampiran untuk Perjanjian Kinerja Definitif (PK Murni):</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:5px;">
                                        <label style="font-size:12px;"><b>Dokumen Utama (Definitif)</b></label>
                                        <div class="btn btn-default btn-upload" style="display:block;">
                                            <i class="fa fa-upload"></i> Pilih File
                                            <input type="file" name="dokumen_utama" id="dokumen_utama" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                        </div>
                                        <div class="upload-preview" id="preview_utama">Belum ada file</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:5px;">
                                        <label style="font-size:12px;"><b>Dokumen Lampiran (Definitif)</b></label>
                                        <div class="btn btn-default btn-upload" style="display:block;">
                                            <i class="fa fa-upload"></i> Pilih File
                                            <input type="file" name="dokumen_lampiran" id="dokumen_lampiran" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                        </div>
                                        <div class="upload-preview" id="preview_lampiran">Belum ada file</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB PK PERUBAHAN -->
                        <div id="tabUploadPerubahan" class="tab-pane fade">
                            <p class="text-muted" style="font-size:12px; margin-bottom:10px;">Unggah dokumen utama & lampiran untuk PK Perubahan (opsional):</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:5px;">
                                        <label style="font-size:12px;"><b>Dokumen Utama (PK Perubahan)</b></label>
                                        <div class="btn btn-default btn-upload" style="display:block;">
                                            <i class="fa fa-upload"></i> Pilih File
                                            <input type="file" name="dokumen_perubahan_utama" id="dokumen_perubahan_utama" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                        </div>
                                        <div class="upload-preview" id="preview_perubahan_utama">Belum ada file</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:5px;">
                                        <label style="font-size:12px;"><b>Dokumen Lampiran (PK Perubahan)</b></label>
                                        <div class="btn btn-default btn-upload" style="display:block;">
                                            <i class="fa fa-upload"></i> Pilih File
                                            <input type="file" name="dokumen_perubahan_lampiran" id="dokumen_perubahan_lampiran" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                        </div>
                                        <div class="upload-preview" id="preview_perubahan_lampiran">Belum ada file</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB PK PLT -->
                        <div id="tabUploadPLT" class="tab-pane fade">
                            <p class="text-muted" style="font-size:12px; margin-bottom:10px;">Unggah dokumen utama & lampiran untuk PK PLT (opsional):</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:5px;">
                                        <label style="font-size:12px;"><b>Dokumen Utama (PK PLT)</b></label>
                                        <div class="btn btn-default btn-upload" style="display:block;">
                                            <i class="fa fa-upload"></i> Pilih File
                                            <input type="file" name="dokumen_plt_utama" id="dokumen_plt_utama" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                        </div>
                                        <div class="upload-preview" id="preview_plt_utama">Belum ada file</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom:5px;">
                                        <label style="font-size:12px;"><b>Dokumen Lampiran (PK PLT)</b></label>
                                        <div class="btn btn-default btn-upload" style="display:block;">
                                            <i class="fa fa-upload"></i> Pilih File
                                            <input type="file" name="dokumen_plt_lampiran" id="dokumen_plt_lampiran" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                        </div>
                                        <div class="upload-preview" id="preview_plt_lampiran">Belum ada file</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ===== 8. STATUS PENGAJUAN (OTOMATIS MENUNGGU) ===== -->
                <div class="form-group" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 1px solid #fde68a; border-radius: 8px; padding: 12px 16px; margin-top: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:36px; height:36px; border-radius:50%; background:#fef9c3; border:1px solid #fde047; display:flex; align-items:center; justify-content:center; color:#ca8a04; flex-shrink:0;">
                                <i class="fa fa-shield fa-lg"></i>
                            </div>
                            <div>
                                <label style="margin:0; font-size:13px; color:#854d0e; font-weight:700;">Status Verifikasi:</label>
                                <p style="margin:2px 0 0 0; font-size:11.5px; color:#a16207;">Setiap penginputan data baru otomatis berstatus <b>Menunggu Verifikasi</b> oleh Tim Daerah.</p>
                            </div>
                        </div>
                        <span class="status-pill status-menunggu" id="status_badge_info" style="padding:6px 14px; font-size:12px;">
                            <span class="status-pill-dot"></span> <span id="status_badge_text">Menunggu</span>
                        </span>
                    </div>
                    <input type="hidden" id="status" value="menunggu">
                </div>

            </div> <!-- /modal-body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanPK"><b>Simpan Perjanjian</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================ -->
<!-- MODAL POP-UP DOKUMEN 2 SLIDE (HALAMAN UTAMA & LAMPIRAN)          -->
<!-- ================================================================ -->
<div class="modal fade" id="modalDetailPK" role="dialog">
    <div class="modal-dialog modal-lg modal-lg-custom" style="max-width:92%;">
        <div class="modal-content" style="border:none; border-radius:10px; overflow:hidden; box-shadow:0 20px 25px -5px rgba(0,0,0,0.3);">
            
            <!-- Header Modal -->
            <div class="modal-header" style="background:#1e3a8a; color:#fff; padding:15px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff; opacity:0.9; font-size:24px;">&times;</button>
                <div style="display:flex; align-items:center; gap:10px;">
                    <i class="fa fa-file-text-o fa-lg" style="color:#60a5fa;"></i>
                    <div>
                        <h4 style="margin:0; color:#fff; font-weight:700;" id="detailModalTitle">Dokumen Perjanjian Kinerja</h4>
                        <div style="font-size:12px; color:#cbd5e1; margin-top:2px;" id="detailModalSubTitle">-</div>
                    </div>
                </div>
            </div>

            <!-- Navigasi Slide 1 & Slide 2 -->
            <div style="background:#f8fafc; padding:12px 20px 0 20px; border-bottom:1px solid #e2e8f0;">
                <div class="doc-slide-nav" style="margin-bottom:0;">
                    <button type="button" class="doc-slide-btn active" id="btnTabSlideUtama" data-slide="utama">
                        <i class="fa fa-file-text"></i> <b>1. Halaman Dokumen Utama</b>
                    </button>
                    <button type="button" class="doc-slide-btn" id="btnTabSlideLampiran" data-slide="lampiran">
                        <i class="fa fa-paperclip"></i> <b>2. Halaman Dokumen Lampiran</b>
                    </button>
                </div>
            </div>

            <div class="modal-body" style="padding:20px; background:#f1f5f9;">

                <!-- SLIDE 1: DOKUMEN UTAMA -->
                <div class="doc-slide-pane active" id="paneSlideUtama">
                    <div style="background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:15px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; border-bottom:1px solid #f1f5f9; padding-bottom:10px;">
                            <div>
                                <span class="badge" style="background:#2563eb; font-size:12px; padding:5px 10px;">Halaman 1: Dokumen Utama</span>
                                <span id="labelFileNameUtama" style="font-size:13px; color:#475569; margin-left:10px; font-weight:600;">-</span>
                            </div>
                            <div id="detailBtnUtama"></div>
                        </div>
                        <div id="detailPreviewUtamaContainer" style="min-height:500px; background:#f8fafc; border:1px solid #cbd5e1; border-radius:6px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                            <p class="text-muted" style="margin:0;"><i class="fa fa-spinner fa-spin"></i> Memuat dokumen utama...</p>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2: DOKUMEN LAMPIRAN -->
                <div class="doc-slide-pane" id="paneSlideLampiran">
                    <div style="background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:15px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; border-bottom:1px solid #f1f5f9; padding-bottom:10px;">
                            <div>
                                <span class="badge" style="background:#0284c7; font-size:12px; padding:5px 10px;">Halaman 2: Dokumen Lampiran</span>
                                <span id="labelFileNameLampiran" style="font-size:13px; color:#475569; margin-left:10px; font-weight:600;">-</span>
                            </div>
                            <div id="detailBtnLampiran"></div>
                        </div>
                        <div id="detailPreviewLampiranContainer" style="min-height:500px; background:#f8fafc; border:1px solid #cbd5e1; border-radius:6px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                            <p class="text-muted" style="margin:0;"><i class="fa fa-spinner fa-spin"></i> Memuat dokumen lampiran...</p>
                        </div>
                    </div>
                </div>

            </div> <!-- /modal-body -->

            <!-- Footer Modal dengan Tombol Navigasi Slide Prev / Next -->
            <div class="modal-footer" style="background:#fff; border-top:1px solid #e2e8f0; padding:12px 20px; display:flex; justify-content:space-between; align-items:center;">
                <div style="display:flex; gap:8px; align-items:center;">
                    <button type="button" class="btn btn-default" id="btnPrevSlide" style="font-weight:600;" disabled>
                        <i class="fa fa-chevron-left"></i> Halaman Sebelumnya
                    </button>
                    <span style="font-size:13px; color:#64748b; margin:0 10px;" id="slideIndicatorText">
                        <b>Halaman 1 dari 2</b> (Dokumen Utama)
                    </span>
                    <button type="button" class="btn btn-primary" id="btnNextSlide" style="font-weight:600; background:#2563eb; border-color:#2563eb;">
                        Halaman Selanjutnya (Lampiran) <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight:600;">Tutup</button>
            </div>

        </div>
    </div>
</div>

<!-- ================================================================ -->
<!-- SCRIPT JAVASCRIPT                                                -->
<!-- ================================================================ -->
<script>
var BaseURL   = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var CURRENT_FILTER_INSTANSI = "<?= !empty($FilterInstansiId) ? $FilterInstansiId : '' ?>";

$(document).ready(function() {

    // ============================================================
    // FILTER WILAYAH SAMPAI INSTANSI (SEBELUM LOGIN)
    // ============================================================
    <?php if (!$IsLoggedIn || !isset($_SESSION['KodeWilayah'])) { ?>
      $("#Provinsi").change(function() {
        var provinsiKode = $(this).val();
        if (provinsiKode === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
          $("#FilterInstansiGroup").hide();
          return;
        }

        $.ajax({
          url: BaseURL + "Instansi/GetListKabKota",
          type: "POST",
          data: { Kode: provinsiKode, [CSRF_NAME]: CSRF_TOKEN },
          dataType: 'json',
          beforeSend: function() { 
            $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
            $("#FilterInstansiGroup").hide();
          },
          success: function(Data) {
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
              }
            }
            $("#KabKota").html(KabKota).prop('disabled', false);
          },
          error: function() { 
            alert("Gagal memuat data Kab/Kota"); 
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', false);
          }
        });
      });

      $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
          $("#FilterInstansiGroup").hide();
          return;
        }

        $.ajax({
          url: BaseURL + "Instansi/GetListInstansiLevel4",
          type: "POST",
          data: { kode_wilayah: kabKotaKode, [CSRF_NAME]: CSRF_TOKEN },
          dataType: 'json',
          beforeSend: function() { 
            $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
            $("#FilterInstansiGroup").show();
          },
          success: function(Data) {
            var options = '<option value="">-- Semua Instansi --</option>';
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
                options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
              }
            }
            $("#FilterInstansiBeforeLogin").html(options);
            $("#FilterInstansiGroup").show();
          },
          error: function() { 
            alert("Gagal memuat data Instansi"); 
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
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
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        $.ajax({
          url: BaseURL + "Instansi/SetTempKodeWilayah",
          type: "POST",
          data: { 
            KodeWilayah: kodeWilayah, 
            InstansiId: instansiId,
            [CSRF_NAME]: CSRF_TOKEN 
          },
          beforeSend: function() { 
            $("#Filter").prop('disabled', true).text('Memuat...'); 
          },
          success: function(res) {
            if (res === '1') {
              var redirectUrl = BaseURL + "Instansi/PerjanjianKinerjaPD";
              if (instansiId && instansiId != '') {
                redirectUrl += "?instansi_id=" + instansiId;
              }
              window.location.href = redirectUrl;
            } else {
              alert(res || "Gagal menyimpan filter wilayah!");
              $("#Filter").prop('disabled', false).text('Filter');
            }
          },
          error: function() { 
            alert("Gagal menghubungi server!"); 
            $("#Filter").prop('disabled', false).text('Filter');
          }
        });
      });

      <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
          $("#KabKota").val(kodeKab).trigger('change');
          <?php if (!empty($FilterInstansiId)) { ?>
            setTimeout(function() {
              if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
                $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
              }
            }, 800);
          <?php } ?>
        }, 500);
      <?php } ?>

    <?php } ?>

    // ============================================================
    // FILTER INSTANSI (ROLE DAERAH / NON-ROLE 4 SUDAH LOGIN)
    // ============================================================
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
      $("#FilterInstansiBtn").click(function() {
        var instansiId = $("#FilterInstansi").val();
        var url = BaseURL + "Instansi/PerjanjianKinerjaPD";
        if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
        window.location.href = url;
      });
      $("#ResetFilterBtn").click(function() { 
        window.location.href = BaseURL + "Instansi/PerjanjianKinerjaPD"; 
      });
    <?php } ?>

    // ============================================================
    // UBAH STATUS PERJANJIAN KINERJA (KHUSUS AKUN LEVEL 3)
    // ============================================================
    <?php if ($IsRole3) { ?>
    $(document).on('change', '.select-status-level3', function() {
        var $select = $(this);
        var id = $select.data('id');
        var prevStatus = $select.data('prev') || 'menunggu';
        var newStatus = $select.val();
        
        if (!id || !newStatus) return;
        
        if (!confirm('Yakin ingin mengubah status perjanjian kinerja ini menjadi "' + newStatus.toUpperCase() + '"?')) {
            $select.val(prevStatus);
            return;
        }
        
        $select.prop('disabled', true);
        
        $.ajax({
            url: BaseURL + "Instansi/updateStatusPerjanjianKinerja",
            type: "POST",
            data: {
                id: id,
                status: newStatus,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            success: function(res) {
                $select.prop('disabled', false);
                if (res.status === 'success') {
                    alert(res.message);
                    $select.data('prev', newStatus);
                    $select.removeClass('status-menunggu status-disetujui status-ditolak').addClass('status-' + newStatus);
                } else {
                    alert(res.message || 'Gagal mengubah status!');
                    $select.val(prevStatus);
                }
            },
            error: function(xhr, status, error) {
                $select.prop('disabled', false);
                alert('Terjadi kesalahan: ' + error);
                $select.val(prevStatus);
            }
        });
    });
    <?php } ?>

    // ============================================================
    // TAMBAH DATA (munculkan modal kosong)
    // ============================================================
    $('#btnTambahPK').click(function() {
        var tahun = $('#tahun_filter').val();
        $('#tahun_selected').val(tahun);
        $('#modalPKTitle').text('Buat Perjanjian Kinerja');
        $('#pk_id').val('');
        $('#pegawai_pengampu_id').val('');
        $('#atasan_langsung_id').val('');
        $('#jenis_perjanjian').val('PK Murni');
        $('#periode_awal').val(1);
        $('#periode_akhir').val(12);
        $('#anggaran_checkbox').prop('checked', false);
        $('#sasaran_level').val('');
        $('#sasaran_list').html('<p class="text-muted">Pilih level terlebih dahulu</p>');
        $('#sub_unit').val('');
        $('#status').val('menunggu');
        $('#status_badge_info').removeClass('status-disetujui status-ditolak').addClass('status-menunggu').find('#status_badge_text').text('Menunggu');
        $('#dokumen_utama').val('');
        $('#dokumen_lampiran').val('');
        $('#dokumen_perubahan_utama').val('');
        $('#dokumen_perubahan_lampiran').val('');
        $('#dokumen_plt_utama').val('');
        $('#dokumen_plt_lampiran').val('');
        $('#delete_dokumen_utama').val('0');
        $('#delete_dokumen_lampiran').val('0');
        $('#delete_dokumen_perubahan_utama').val('0');
        $('#delete_dokumen_perubahan_lampiran').val('0');
        $('#delete_dokumen_plt_utama').val('0');
        $('#delete_dokumen_plt_lampiran').val('0');
        $('#preview_utama').html('<span class="text-muted" style="font-size:12px;">Belum ada file</span>');
        $('#preview_lampiran').html('<span class="text-muted" style="font-size:12px;">Belum ada file</span>');
        $('#preview_perubahan_utama').html('<span class="text-muted" style="font-size:12px;">Belum ada file</span>');
        $('#preview_perubahan_lampiran').html('<span class="text-muted" style="font-size:12px;">Belum ada file</span>');
        $('#preview_plt_utama').html('<span class="text-muted" style="font-size:12px;">Belum ada file</span>');
        $('#preview_plt_lampiran').html('<span class="text-muted" style="font-size:12px;">Belum ada file</span>');
        clearPengampuDetail();
        clearAtasanDetail();
        $('#satuan_unit_kerja').val('');
        $('#satuan_unit_kerja_atasan').val('');
        $('#selectedCount').text('Belum ada sasaran dipilih');
        $('#btnBatalPilihSasaran').hide();
        $('#modalPK').modal('show');
    });

    // Helper render file preview box di Form (dengan tombol Hapus & Link)
    function renderFilePreviewBox(containerId, inputId, deleteFlagId, fileName, fileUrl) {
        $(deleteFlagId).val('0');
        if (!fileName || !fileUrl) {
            $(containerId).html('<span class="text-muted" style="font-size:12px;">Belum ada file</span>');
            return;
        }

        var ext = fileName.split('.').pop().toLowerCase();
        var icon = 'fa-file-text-o text-primary';
        if (['jpg','jpeg','png','gif','webp'].indexOf(ext) !== -1) icon = 'fa-file-image-o text-success';
        else if (ext === 'pdf') icon = 'fa-file-pdf-o text-danger';
        else if (['doc','docx'].indexOf(ext) !== -1) icon = 'fa-file-word-o text-info';

        var html = '<div class="existing-file-card" style="display:flex; justify-content:space-between; align-items:center; background:#f8fafc; border:1px solid #cbd5e1; border-radius:4px; padding:5px 8px; margin-top:5px;">';
        html += '  <a href="' + fileUrl + '" target="_blank" style="font-size:12px; font-weight:600; text-decoration:none; max-width:180px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="' + escapeHtml(fileName) + '">';
        html += '    <i class="fa ' + icon + '"></i> ' + escapeHtml(fileName);
        html += '  </a>';
        html += '  <button type="button" class="btn btn-xs btn-danger btn-trigger-delete-file" data-container="' + containerId + '" data-input="' + inputId + '" data-flag="' + deleteFlagId + '" data-filename="' + escapeHtml(fileName) + '" data-fileurl="' + fileUrl + '" title="Hapus file yang tersimpan" style="font-weight:600; padding:2px 6px;">';
        html += '    <i class="fa fa-trash"></i> Hapus';
        html += '  </button>';
        html += '</div>';

        $(containerId).html(html);
    }

    // Klik tombol Hapus file di Form Edit
    $(document).on('click', '.btn-trigger-delete-file', function() {
        var containerId = $(this).data('container');
        var inputId = $(this).data('input');
        var flagId = $(this).data('flag');
        var fileName = $(this).data('filename');
        var fileUrl = $(this).data('fileurl');

        $(flagId).val('1');
        $(inputId).val(''); // Reset file input

        var html = '<div style="display:flex; justify-content:space-between; align-items:center; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; padding:5px 8px; margin-top:5px;">';
        html += '  <span style="font-size:11px; color:#b91c1c; font-weight:600;"><i class="fa fa-trash"></i> File akan dihapus</span>';
        html += '  <button type="button" class="btn btn-xs btn-default btn-cancel-delete-file" data-container="' + containerId + '" data-input="' + inputId + '" data-flag="' + flagId + '" data-filename="' + escapeHtml(fileName) + '" data-fileurl="' + fileUrl + '" style="font-weight:600; padding:2px 6px;"><i class="fa fa-undo"></i> Batal</button>';
        html += '</div>';

        $(containerId).html(html);
    });

    // Klik tombol Batal Hapus file
    $(document).on('click', '.btn-cancel-delete-file', function() {
        var containerId = $(this).data('container');
        var inputId = $(this).data('input');
        var flagId = $(this).data('flag');
        var fileName = $(this).data('filename');
        var fileUrl = $(this).data('fileurl');

        renderFilePreviewBox(containerId, inputId, flagId, fileName, fileUrl);
    });

    // Setup input file change untuk preview file baru
    function setupFilePreview(inputId, previewId, flagId) {
        $(inputId).change(function() {
            var file = this.files[0];
            if (file) {
                $(flagId).val('0');
                $(previewId).html('<div style="display:flex; justify-content:space-between; align-items:center; background:#f0fdf4; border:1px solid #86efac; border-radius:4px; padding:5px 8px; margin-top:5px;"><span class="text-success" style="font-size:11px; font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:180px;"><i class="fa fa-check-circle"></i> File Baru: ' + escapeHtml(file.name) + '</span><span style="font-size:10px; color:#15803d;">' + (file.size/1024).toFixed(0) + 'KB</span></div>');
            }
        });
    }
    setupFilePreview('#dokumen_utama', '#preview_utama', '#delete_dokumen_utama');
    setupFilePreview('#dokumen_lampiran', '#preview_lampiran', '#delete_dokumen_lampiran');
    setupFilePreview('#dokumen_perubahan_utama', '#preview_perubahan_utama', '#delete_dokumen_perubahan_utama');
    setupFilePreview('#dokumen_perubahan_lampiran', '#preview_perubahan_lampiran', '#delete_dokumen_perubahan_lampiran');
    setupFilePreview('#dokumen_plt_utama', '#preview_plt_utama', '#delete_dokumen_plt_utama');
    setupFilePreview('#dokumen_plt_lampiran', '#preview_plt_lampiran', '#delete_dokumen_plt_lampiran');

    // ============================================================
    // EVENT CHANGE PEGAWAI PENGAMPU
    // ============================================================
    $('#pegawai_pengampu_id').change(function() {
        var selected = $(this).find('option:selected');
        var id = $(this).val();
        if (id) {
            $('#pengampu_nip').val(selected.data('nip') || '');
            $('#pengampu_jabatan').val(selected.data('jabatan') || '');
            $('#pengampu_eselon').val(selected.data('eselon') || '-');
            $('#nip_pengampu').val(selected.data('nip') || '');
            $('#nama_pengampu').val(selected.data('nama') || '');
            $('#jabatan_pengampu').val(selected.data('jabatan') || '');
            $('#satuan_unit_kerja').val(selected.data('satuan') || '');
        } else {
            clearPengampuDetail();
            $('#satuan_unit_kerja').val('');
        }
    });

    // ============================================================
    // EVENT CHANGE ATASAN LANGSUNG
    // ============================================================
    $('#atasan_langsung_id').change(function() {
        var selected = $(this).find('option:selected');
        var id = $(this).val();
        if (id) {
            $('#nip_atasan').val(selected.data('nip') || '');
            $('#nama_atasan').val(selected.data('nama') || '');
            $('#jabatan_atasan').val(selected.data('jabatan') || '');
            $('#satuan_unit_kerja_atasan').val(selected.data('satuan') || '');
        } else {
            clearAtasanDetail();
            $('#satuan_unit_kerja_atasan').val('');
        }
    });

    // ============================================================
    // EVENT CHANGE LEVEL SASARAN (AJAX getSasaranByLevel)
    // ============================================================
    $('#sasaran_level').change(function() {
        var level = $(this).val();
        var tahun = $('#tahun_selected').val() || $('#tahun_filter').val();

        if (!level) {
            $('#sasaran_list').html('<p class="text-muted">Pilih level terlebih dahulu</p>');
            $('#sub_unit').val('');
            $('#selectedCount').text('Belum ada sasaran dipilih');
            $('#btnBatalPilihSasaran').hide();
            return;
        }

        $('#sasaran_list').html('<p class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat data sasaran...</p>');

        $.ajax({
            url: BaseURL + "Instansi/getSasaranByLevel",
            type: "POST",
            data: {
                level: level,
                tahun: tahun,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    renderSasaranList(res.data, level);
                } else {
                    $('#sasaran_list').html('<p class="text-danger">' + (res.message || 'Gagal memuat data') + '</p>');
                    $('#selectedCount').text('Belum ada sasaran dipilih');
                    $('#btnBatalPilihSasaran').hide();
                }
            },
            error: function(xhr, status, error) {
                $('#sasaran_list').html('<p class="text-danger">Terjadi kesalahan koneksi.</p>');
                $('#selectedCount').text('Belum ada sasaran dipilih');
                $('#btnBatalPilihSasaran').hide();
            }
        });
    });

    // ============================================================
    // RENDER SASARAN LIST (RADIO BUTTON MODEL CENTANG)
    // ============================================================
    function renderSasaranList(data, level) {
        if (!data || data.length === 0) {
            $('#sasaran_list').html('<p class="text-muted">Tidak ada data untuk level ini</p>');
            $('#selectedCount').text('Belum ada sasaran dipilih');
            $('#btnBatalPilihSasaran').hide();
            return;
        }

        var html = '';
        $.each(data, function(i, item) {
            var nama = item.nama || '-';
            var sasaran = item.sasaran || '';
            var subUnit = item.sub_unit || '-';
            var sasaranId = item.id;
            var indikatorList = item.indikator_list || [];

            html += '<div class="sasaran-item" data-id="' + sasaranId + '" data-subunit="' + subUnit + '" data-level="' + level + '">';
            html += '  <div class="radio-indicator"></div>';
            html += '  <input type="radio" class="radio-hidden" name="sasaran_radio" value="' + sasaranId + '" data-level="' + level + '">';
            html += '  <span class="sasaran-text">' + escapeHtml(nama) + '</span>';
            if (sasaran) {
                var labelSasaran = (level === 'program') ? 'Outcome' : 'Sasaran';
                html += '  <span class="sasaran-detail-text">' + labelSasaran + ': ' + escapeHtml(sasaran) + '</span>';
            }
            html += '  <span class="sub-unit">' + escapeHtml(subUnit) + '</span>';
            
            // Detail indikator (dikelompokkan per outcome / sasaran)
            html += '  <div class="sasaran-detail" style="display:none;">';
            if (item.outcomes && item.outcomes.length > 0) {
                $.each(item.outcomes, function(k, out) {
                    html += '    <div style="margin-bottom:10px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:8px 10px;">';
                    html += '      <div style="font-weight:700; color:#1e3a8a; font-size:13px; margin-bottom:5px;">';
                    html += '        <i class="fa fa-bullseye" style="color:#2563eb;"></i> Outcome: ' + escapeHtml(out.outcome_text || '-');
                    html += '      </div>';
                    if (out.indikator_list && out.indikator_list.length > 0) {
                        html += '      <table class="table table-sm table-bordered" style="margin-bottom:0; background:#fff;">';
                        html += '        <thead><tr style="background:#f1f5f9;"><th>Indikator</th><th style="width:100px;">Satuan</th><th style="width:100px;">Target</th></tr></thead>';
                        html += '        <tbody>';
                        $.each(out.indikator_list, function(j, ind) {
                            html += '          <tr>';
                            html += '            <td>' + escapeHtml(ind.indikator || '') + '</td>';
                            html += '            <td>' + escapeHtml(ind.satuan || '') + '</td>';
                            html += '            <td>' + escapeHtml(ind.target || '') + '</td>';
                            html += '          </tr>';
                        });
                        html += '        </tbody>';
                        html += '      </table>';
                    } else {
                        html += '      <p class="text-muted" style="margin:0; font-size:12px;"><i>Tidak ada indikator untuk outcome ini</i></p>';
                    }
                    html += '    </div>';
                });
            } else if (item.sasaran_list && item.sasaran_list.length > 0) {
                $.each(item.sasaran_list, function(k, sas) {
                    html += '    <div style="margin-bottom:10px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:8px 10px;">';
                    html += '      <div style="font-weight:700; color:#1e3a8a; font-size:13px; margin-bottom:5px;">';
                    html += '        <i class="fa fa-bullseye" style="color:#2563eb;"></i> Sasaran: ' + escapeHtml(sas.sasaran_text || '-');
                    html += '      </div>';
                    if (sas.indikator_list && sas.indikator_list.length > 0) {
                        html += '      <table class="table table-sm table-bordered" style="margin-bottom:0; background:#fff;">';
                        html += '        <thead><tr style="background:#f1f5f9;"><th>Indikator</th><th style="width:100px;">Satuan</th><th style="width:100px;">Target</th></tr></thead>';
                        html += '        <tbody>';
                        $.each(sas.indikator_list, function(j, ind) {
                            html += '          <tr>';
                            html += '            <td>' + escapeHtml(ind.indikator || '') + '</td>';
                            html += '            <td>' + escapeHtml(ind.satuan || '') + '</td>';
                            html += '            <td>' + escapeHtml(ind.target || '') + '</td>';
                            html += '          </tr>';
                        });
                        html += '        </tbody>';
                        html += '      </table>';
                    } else {
                        html += '      <p class="text-muted" style="margin:0; font-size:12px;"><i>Tidak ada indikator untuk sasaran ini</i></p>';
                    }
                    html += '    </div>';
                });
            } else if (indikatorList.length > 0) {
                html += '    <table class="table table-sm table-bordered" style="margin-top:5px;">';
                html += '      <thead><tr><th>Indikator</th><th>Satuan</th><th>Target</th></tr></thead>';
                html += '      <tbody>';
                $.each(indikatorList, function(j, ind) {
                    html += '        <tr>';
                    html += '          <td>' + escapeHtml(ind.indikator || '') + '</td>';
                    html += '          <td>' + escapeHtml(ind.satuan || '') + '</td>';
                    html += '          <td>' + escapeHtml(ind.target || '') + '</td>';
                    html += '        </tr>';
                });
                html += '      </tbody>';
                html += '    </table>';
            } else {
                html += '    <p class="text-muted">Tidak ada indikator</p>';
            }
            html += '  </div>';
            html += '</div>';
        });

        $('#sasaran_list').html(html);
        updateSelectedCount();
        $('#btnBatalPilihSasaran').hide();
    }

    // ============================================================
    // EVENT DELEGATION UNTUK RADIO BUTTON (TOGGLE - bisa uncheck)
    // ============================================================
    $(document).on('click', '.sasaran-item', function(e) {
        if ($(e.target).closest('.sasaran-detail').length > 0) return;
        if ($(e.target).closest('input').length > 0) return;

        var $item = $(this);
        var $radio = $item.find('.radio-hidden');
        var isCurrentlyChecked = $radio.prop('checked');

        if (isCurrentlyChecked) {
            $radio.prop('checked', false);
            $item.removeClass('selected');
            $item.find('.sasaran-detail').slideUp();
            $('#sub_unit').val('');
            $('#btnBatalPilihSasaran').hide();
        } else {
            $('.sasaran-item').removeClass('selected');
            $('.sasaran-detail').slideUp();
            $('.radio-hidden').prop('checked', false);

            $radio.prop('checked', true);
            $item.addClass('selected');
            $item.find('.sasaran-detail').slideDown();
            var subUnit = $item.data('subunit') || '';
            $('#sub_unit').val(subUnit);
            $('#btnBatalPilihSasaran').show();
        }
        updateSelectedCount();
    });

    $(document).on('change', '.radio-hidden', function() {
        var $radio = $(this);
        var $item = $radio.closest('.sasaran-item');

        if ($radio.is(':checked')) {
            $('.sasaran-item').removeClass('selected');
            $('.radio-hidden').prop('checked', false);
            $('.sasaran-detail').slideUp();

            $radio.prop('checked', true);
            $item.addClass('selected');
            $item.find('.sasaran-detail').slideDown();

            var subUnit = $item.data('subunit');
            $('#sub_unit').val(subUnit || '');
            $('#btnBatalPilihSasaran').show();
        } else {
            $item.removeClass('selected');
            $item.find('.sasaran-detail').slideUp();
            if ($('.radio-hidden:checked').length === 0) {
                $('#sub_unit').val('');
                $('#btnBatalPilihSasaran').hide();
            }
        }
        updateSelectedCount();
    });

    // ============================================================
    // TOMBOL BATAL PILIH SASARAN
    // ============================================================
    $('#btnBatalPilihSasaran').click(function() {
        $('.sasaran-item').removeClass('selected');
        $('.radio-hidden').prop('checked', false);
        $('.sasaran-detail').slideUp();
        $('#sub_unit').val('');
        $('#selectedCount').text('Belum ada sasaran dipilih');
        $(this).hide();
    });

    // ============================================================
    // UPDATE SELECTED COUNT
    // ============================================================
    function updateSelectedCount() {
        var count = $('.radio-hidden:checked').length;
        if (count > 0) {
            var text = $('.radio-hidden:checked').closest('.sasaran-item').find('.sasaran-text').text();
            $('#selectedCount').html('<b>1</b> sasaran dipilih: ' + text);
            $('#btnBatalPilihSasaran').show();
        } else {
            $('#selectedCount').text('Belum ada sasaran dipilih');
            $('#btnBatalPilihSasaran').hide();
        }
    }

    // ============================================================
    // FUNGSI BANTUAN
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

    function clearPengampuDetail() {
        $('#pengampu_nip').val('');
        $('#pengampu_jabatan').val('');
        $('#pengampu_eselon').val('');
        $('#nip_pengampu').val('');
        $('#nama_pengampu').val('');
        $('#jabatan_pengampu').val('');
    }

    function clearAtasanDetail() {
        $('#nip_atasan').val('');
        $('#nama_atasan').val('');
        $('#jabatan_atasan').val('');
    }

    // ============================================================
    // SIMPAN / UPDATE PERJANJIAN KINERJA (AJAX)
    // ============================================================
    $('#btnSimpanPK').click(function() {
        var id = $('#pk_id').val();

        if (!$('#pegawai_pengampu_id').val()) {
            alert('Pilih Pegawai Pengampu!');
            return;
        }
        if (!$('#atasan_langsung_id').val()) {
            alert('Pilih Atasan Langsung!');
            return;
        }
        if (!$('#jenis_perjanjian').val()) {
            alert('Pilih Jenis Perjanjian!');
            return;
        }
        if (!$('#sasaran_level').val()) {
            alert('Pilih Level Sasaran!');
            return;
        }
        if ($('.radio-hidden:checked').length === 0) {
            alert('Pilih satu sasaran!');
            return;
        }
        if (!$('#periode_awal').val() || !$('#periode_akhir').val()) {
            alert('Lengkapi periode!');
            return;
        }

        var sasaranTerpilih = [];
        $('.radio-hidden:checked').each(function() {
            var item = $(this).closest('.sasaran-item');
            var id = $(this).val();
            var level = $(this).data('level');
            // Ambil indikator dari tabel (hanya untuk informasi, tidak disimpan)
            var indikator = item.find('.indikator-input').val() || '';
            var satuan = item.find('.satuan-input').val() || '';
            var target = item.find('.target-input').val() || '';
            sasaranTerpilih.push({
                id: id,
                level: level,
                indikator: indikator,
                satuan: satuan,
                target: target
            });
        });

        var anggaran = $('#anggaran_checkbox').is(':checked') ? 1 : 0;

        var formData = new FormData();
        formData.append('pegawai_pengampu_id', $('#pegawai_pengampu_id').val());
        formData.append('atasan_langsung_id', $('#atasan_langsung_id').val());
        formData.append('jenis_perjanjian', $('#jenis_perjanjian').val());
        formData.append('periode_awal', $('#periode_awal').val());
        formData.append('periode_akhir', $('#periode_akhir').val());
        formData.append('anggaran', anggaran);
        formData.append('sasaran_level', $('#sasaran_level').val());
        formData.append('sasaran_data', JSON.stringify(sasaranTerpilih));
        formData.append('sub_unit', $('#sub_unit').val());
        formData.append('status', $('#status').val());
        formData.append(CSRF_NAME, CSRF_TOKEN);
        if (id) formData.append('id', id);

        // Upload Definitif
        var fileUtama = $('#dokumen_utama')[0].files[0];
        var fileLampiran = $('#dokumen_lampiran')[0].files[0];
        if (fileUtama)   formData.append('dokumen_utama', fileUtama);
        if (fileLampiran) formData.append('dokumen_lampiran', fileLampiran);

        // Upload PK Perubahan
        var filePerubahanUtama = $('#dokumen_perubahan_utama')[0].files[0];
        var filePerubahanLampiran = $('#dokumen_perubahan_lampiran')[0].files[0];
        if (filePerubahanUtama)   formData.append('dokumen_perubahan_utama', filePerubahanUtama);
        if (filePerubahanLampiran) formData.append('dokumen_perubahan_lampiran', filePerubahanLampiran);

        // Upload PK PLT
        var filePLTUtama = $('#dokumen_plt_utama')[0].files[0];
        var filePLTLampiran = $('#dokumen_plt_lampiran')[0].files[0];
        if (filePLTUtama)   formData.append('dokumen_plt_utama', filePLTUtama);
        if (filePLTLampiran) formData.append('dokumen_plt_lampiran', filePLTLampiran);

        // Flags Hapus File Lama
        formData.append('delete_dokumen_utama', $('#delete_dokumen_utama').val());
        formData.append('delete_dokumen_lampiran', $('#delete_dokumen_lampiran').val());
        formData.append('delete_dokumen_perubahan_utama', $('#delete_dokumen_perubahan_utama').val());
        formData.append('delete_dokumen_perubahan_lampiran', $('#delete_dokumen_perubahan_lampiran').val());
        formData.append('delete_dokumen_plt_utama', $('#delete_dokumen_plt_utama').val());
        formData.append('delete_dokumen_plt_lampiran', $('#delete_dokumen_plt_lampiran').val());

        var url = id ? BaseURL + "Instansi/updatePerjanjianKinerja"
                     : BaseURL + "Instansi/simpanPerjanjianKinerja";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function() {
                $('#btnSimpanPK').prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    $('#modalPK').modal('hide');
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan!');
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            },
            complete: function() {
                $('#btnSimpanPK').prop('disabled', false).text('Simpan Perjanjian');
            }
        });
    });

    // ============================================================
    // EDIT DATA (load data ke modal)
    // ============================================================
    $(document).on('click', '.btn-edit-pk', function() {
        var id = $(this).data('id');
        if (!id) return;
        var tahun = $('#tahun_filter').val();
        $('#tahun_selected').val(tahun);
        
        // Reset file inputs
        $('#dokumen_utama').val('');
        $('#dokumen_lampiran').val('');
        $('#dokumen_perubahan_utama').val('');
        $('#dokumen_perubahan_lampiran').val('');
        $('#dokumen_plt_utama').val('');
        $('#dokumen_plt_lampiran').val('');

        $.ajax({
            url: BaseURL + "Instansi/getPerjanjianKinerja",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    var data = res.data;
                    $('#modalPKTitle').text('Edit Perjanjian Kinerja');
                    $('#pk_id').val(data.id);
                    $('#pegawai_pengampu_id').val(data.pegawai_pengampu_id).trigger('change');
                    $('#atasan_langsung_id').val(data.atasan_langsung_id).trigger('change');
                    $('#jenis_perjanjian').val(data.jenis_perjanjian);
                    $('#periode_awal').val(data.periode_awal);
                    $('#periode_akhir').val(data.periode_akhir);
                    $('#anggaran_checkbox').prop('checked', (data.anggaran == 1));
                    $('#sasaran_level').val(data.sasaran_level).trigger('change');
                    if (data.sasaran_data) {
                        var selected = JSON.parse(data.sasaran_data);
                        setTimeout(function() {
                            $.each(selected, function(i, s) {
                                var $item = $('.sasaran-item[data-id="' + s.id + '"]');
                                if ($item.length) {
                                    $item.find('.radio-hidden').prop('checked', true);
                                    $item.addClass('selected');
                                    $item.find('.sasaran-detail').show();
                                    $('#sub_unit').val($item.data('subunit') || '');
                                    $('#btnBatalPilihSasaran').show();
                                }
                            });
                            updateSelectedCount();
                        }, 500);
                    }
                    $('#sub_unit').val(data.sub_unit);
                    $('#status').val(data.status || 'menunggu');
                    
                    var st = (data.status || 'menunggu').toLowerCase();
                    $('#status_badge_info').removeClass('status-menunggu status-disetujui status-ditolak').addClass('status-' + st);
                    if (st === 'disetujui') {
                        $('#status_badge_text').text('Disetujui');
                    } else if (st === 'ditolak') {
                        $('#status_badge_text').text('Ditolak');
                    } else {
                        $('#status_badge_text').text('Menunggu');
                    }
                    
                    // Render File Preview Cards dengan tombol Hapus & Link
                    renderFilePreviewBox('#preview_utama', '#dokumen_utama', '#delete_dokumen_utama', data.dokumen_utama, data.dokumen_utama_url);
                    renderFilePreviewBox('#preview_lampiran', '#dokumen_lampiran', '#delete_dokumen_lampiran', data.dokumen_lampiran, data.dokumen_lampiran_url);
                    
                    renderFilePreviewBox('#preview_perubahan_utama', '#dokumen_perubahan_utama', '#delete_dokumen_perubahan_utama', data.dokumen_perubahan_utama, data.dokumen_perubahan_utama_url);
                    renderFilePreviewBox('#preview_perubahan_lampiran', '#dokumen_perubahan_lampiran', '#delete_dokumen_perubahan_lampiran', data.dokumen_perubahan_lampiran, data.dokumen_perubahan_lampiran_url);
                    
                    renderFilePreviewBox('#preview_plt_utama', '#dokumen_plt_utama', '#delete_dokumen_plt_utama', data.dokumen_plt_utama, data.dokumen_plt_utama_url);
                    renderFilePreviewBox('#preview_plt_lampiran', '#dokumen_plt_lampiran', '#delete_dokumen_plt_lampiran', data.dokumen_plt_lampiran, data.dokumen_plt_lampiran_url);
                    
                    $('#modalPK').modal('show');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            }
        });
    });

    // ============================================================
    // DETAIL DATA & PREVIEW DOKUMEN 2 SLIDE (modalDetailPK)
    // ============================================================
    var currentActiveSlide = 'utama'; // 'utama' atau 'lampiran'

    function switchDocSlide(targetSlide) {
        currentActiveSlide = targetSlide;
        if (targetSlide === 'lampiran') {
            $('#btnTabSlideUtama').removeClass('active');
            $('#btnTabSlideLampiran').addClass('active');
            $('#paneSlideUtama').removeClass('active');
            $('#paneSlideLampiran').addClass('active');

            $('#btnPrevSlide').prop('disabled', false).removeClass('btn-default').addClass('btn-primary').css({'background':'#2563eb', 'border-color':'#2563eb', 'color':'#fff'});
            $('#btnNextSlide').prop('disabled', true).removeClass('btn-primary').addClass('btn-default').css({'background':'#f1f5f9', 'border-color':'#cbd5e1', 'color':'#94a3b8'});
            $('#slideIndicatorText').html('<b>Halaman 2 dari 2</b> (Dokumen Lampiran)');
        } else {
            $('#btnTabSlideLampiran').removeClass('active');
            $('#btnTabSlideUtama').addClass('active');
            $('#paneSlideLampiran').removeClass('active');
            $('#paneSlideUtama').addClass('active');

            $('#btnPrevSlide').prop('disabled', true).removeClass('btn-primary').addClass('btn-default').css({'background':'#f1f5f9', 'border-color':'#cbd5e1', 'color':'#94a3b8'});
            $('#btnNextSlide').prop('disabled', false).removeClass('btn-default').addClass('btn-primary').css({'background':'#2563eb', 'border-color':'#2563eb', 'color':'#fff'});
            $('#slideIndicatorText').html('<b>Halaman 1 dari 2</b> (Dokumen Utama)');
        }
    }

    // Klik tab slide
    $(document).on('click', '.doc-slide-btn', function() {
        var slide = $(this).data('slide');
        switchDocSlide(slide);
    });

    // Klik tombol prev & next slide di footer
    $('#btnPrevSlide').click(function() {
        switchDocSlide('utama');
    });
    $('#btnNextSlide').click(function() {
        switchDocSlide('lampiran');
    });

    // Klik kolom dokumen atau tombol Detail dari tabel (Langsung munculkan pop-up sesuai tipe dokumen)
    $(document).on('click', '.cell-doc-clickable', function() {
        var id = $(this).data('id');
        var docType = $(this).data('doctype') || 'definitif'; // 'definitif', 'perubahan', atau 'plt'
        var initialSlide = $(this).data('slide') || 'utama';
        if (!id) return;
        
        // Reset modal preview
        switchDocSlide(initialSlide);
        $('#detailModalTitle').text('Dokumen Perjanjian Kinerja');
        $('#detailModalSubTitle').text('Memuat informasi...');
        $('#labelFileNameUtama').text('-');
        $('#labelFileNameLampiran').text('-');
        $('#detailBtnUtama').empty();
        $('#detailBtnLampiran').empty();
        $('#detailPreviewUtamaContainer').html('<p class="text-muted" style="margin:0;"><i class="fa fa-spinner fa-spin"></i> Memuat dokumen utama...</p>');
        $('#detailPreviewLampiranContainer').html('<p class="text-muted" style="margin:0;"><i class="fa fa-spinner fa-spin"></i> Memuat dokumen lampiran...</p>');

        $('#modalDetailPK').modal('show');

        $.ajax({
            url: BaseURL + "Instansi/getPerjanjianKinerja",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    var data = res.data;
                    
                    var blnAwal = getMonthName(data.periode_awal);
                    var blnAkhir = getMonthName(data.periode_akhir);
                    
                    var typeTitle = 'Definitif (PK Murni)';
                    var fileUtama = data.dokumen_utama;
                    var fileUtamaUrl = data.dokumen_utama_url;
                    var fileLampiran = data.dokumen_lampiran;
                    var fileLampiranUrl = data.dokumen_lampiran_url;
                    
                    if (docType === 'perubahan') {
                        typeTitle = 'PK Perubahan';
                        fileUtama = data.dokumen_perubahan_utama;
                        fileUtamaUrl = data.dokumen_perubahan_utama_url;
                        fileLampiran = data.dokumen_perubahan_lampiran;
                        fileLampiranUrl = data.dokumen_perubahan_lampiran_url;
                    } else if (docType === 'plt') {
                        typeTitle = 'PK PLT';
                        fileUtama = data.dokumen_plt_utama;
                        fileUtamaUrl = data.dokumen_plt_utama_url;
                        fileLampiran = data.dokumen_plt_lampiran;
                        fileLampiranUrl = data.dokumen_plt_lampiran_url;
                    }

                    var subtitle = (data.pengampu_nama ? data.pengampu_nama + ' (' + (data.pengampu_nip || '-') + ')' : '') + 
                                   ' • ' + typeTitle + 
                                   ' • Periode: ' + blnAwal + ' s/d ' + blnAkhir;
                    
                    $('#detailModalTitle').text('Dokumen ' + typeTitle);
                    $('#detailModalSubTitle').text(subtitle);
                    
                    $('#labelFileNameUtama').text(fileUtama ? fileUtama : 'Belum diunggah');
                    $('#labelFileNameLampiran').text(fileLampiran ? fileLampiran : 'Belum diunggah');
                    
                    // Render Preview Dokumen Utama
                    renderDocPreview('#detailPreviewUtamaContainer', '#detailBtnUtama', fileUtama, fileUtamaUrl, 'Dokumen Utama ' + typeTitle);
                    
                    // Render Preview Dokumen Lampiran
                    renderDocPreview('#detailPreviewLampiranContainer', '#detailBtnLampiran', fileLampiran, fileLampiranUrl, 'Dokumen Lampiran ' + typeTitle);
                    
                } else {
                    alert(res.message || 'Gagal memuat dokumen!');
                    $('#modalDetailPK').modal('hide');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat memuat dokumen!');
                $('#modalDetailPK').modal('hide');
            }
        });
    });

    // Helper preview file
    function renderDocPreview(containerSelector, btnSelector, fileName, fileUrl, docLabel) {
        if (!fileName || !fileUrl) {
            $(containerSelector).html('<div style="text-align:center; padding:50px 20px; color:#94a3b8;"><i class="fa fa-file-o fa-4x" style="margin-bottom:12px; color:#cbd5e1;"></i><p style="margin:0; font-size:14px; font-weight:600; color:#64748b;">Tidak ada ' + escapeHtml(docLabel) + ' yang diunggah.</p></div>');
            $(btnSelector).empty();
            return;
        }

        var ext = fileName.split('.').pop().toLowerCase();
        
        // Tombol download / buka di tab baru
        $(btnSelector).html('<a href="' + fileUrl + '" target="_blank" class="btn btn-sm btn-primary" style="font-weight:600;"><i class="fa fa-external-link"></i> Buka Layar Penuh</a>');
        
        if (['jpg', 'jpeg', 'png', 'gif', 'webp'].indexOf(ext) !== -1) {
            $(containerSelector).html('<div style="text-align:center; padding:15px; width:100%;"><img src="' + fileUrl + '" alt="' + escapeHtml(fileName) + '" style="max-width:100%; max-height:550px; border-radius:6px; box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);"></div>');
        } else if (ext === 'pdf') {
            $(containerSelector).html('<iframe src="' + fileUrl + '" style="width:100%; height:550px; border:none; border-radius:6px;"></iframe>');
        } else if (['doc', 'docx'].indexOf(ext) !== -1) {
            $(containerSelector).html('<div style="text-align:center; padding:60px 20px; color:#334155;"><i class="fa fa-file-word-o fa-5x text-primary" style="margin-bottom:15px;"></i><p style="font-weight:700; font-size:16px; margin-bottom:5px;">' + escapeHtml(fileName) + '</p><p class="text-muted" style="font-size:13px; margin-bottom:20px;">Berkas Word tidak dapat dipratinjau langsung di browser. Silakan unduh untuk membukanya.</p><a href="' + fileUrl + '" download class="btn btn-md btn-primary" style="font-weight:600;"><i class="fa fa-download"></i> Unduh Dokumen Word</a></div>');
        } else {
            $(containerSelector).html('<div style="text-align:center; padding:60px 20px; color:#334155;"><i class="fa fa-file-text-o fa-5x text-primary" style="margin-bottom:15px;"></i><p style="font-weight:700; font-size:16px; margin-bottom:15px;">' + escapeHtml(fileName) + '</p><a href="' + fileUrl + '" target="_blank" class="btn btn-md btn-primary" style="font-weight:600;"><i class="fa fa-download"></i> Buka / Unduh File</a></div>');
        }
    }

    function getMonthName(monthNumber) {
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var idx = parseInt(monthNumber, 10) - 1;
        return (idx >= 0 && idx < 12) ? months[idx] : '-';
    }

    function capitalizeFirst(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // ============================================================
    // HAPUS DATA
    // ============================================================
    $(document).on('click', '.btn-hapus-pk', function() {
        if (!confirm('Yakin hapus Perjanjian Kinerja ini?')) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusPerjanjianKinerja",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

}); // end ready
</script>

</body>
</html>