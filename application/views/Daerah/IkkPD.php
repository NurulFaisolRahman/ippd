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
?>
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* Card Modern Curve untuk Tabel dan Data IKK PD */
.data-table-list {
    border-radius: 14px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
    border: 1px solid #f1f5f9;
    overflow: hidden;
    background: #ffffff;
    padding: 24px !important;
}

/* Badge & styling tampilan rumus pada tabel */
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
.rumus-badge-icon {
    color: #03a9f3;
    font-size: 12px;
    margin-top: 2px;
    flex-shrink: 0;
}
.btn-add-rumus {
    background: #f0fdf4;
    color: #16a34a;
    border: 1px dashed #86efac;
    border-radius: 6px;
    padding: 4px 9px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-block;
}
.btn-add-rumus:hover {
    background: #dcfce7;
    color: #15803d;
    border-color: #4ade80;
}

/* Modal Dialog Rumus (Wider for Math Keyboard & Preview) */
.modal-rumus-dialog {
    max-width: 780px !important;
    width: 95% !important;
    margin: 30px auto !important;
}
.modal-rumus-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    overflow: hidden;
}
.modal-rumus-header {
    background: #ffffff;
    color: #1e293b;
    padding: 18px 24px;
    border-bottom: 1px solid #eef2f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.modal-rumus-header .modal-title {
    font-size: 16px;
    font-weight: 700;
    margin: 0;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}
.modal-rumus-header .modal-title-icon {
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

/* Math Toolbar Box */
.math-toolbar-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 12px;
    margin-top: 12px;
}
.math-toolbar-header {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e2e8f0;
}
.math-toolbar-title {
    font-size: 12px;
    font-weight: 700;
    color: #334155;
}
.math-tab-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}
.math-tab-btn {
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
    border-radius: 14px;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 9px;
    cursor: pointer;
    transition: all 0.2s ease;
    outline: none !important;
}
.math-tab-btn:hover {
    border-color: #00c292;
    color: #00c292;
}
.math-tab-btn.active {
    background: #00c292;
    color: #ffffff;
    border-color: #00c292;
    box-shadow: 0 2px 4px rgba(0, 194, 146, 0.25);
}
.math-tab-content {
    display: none;
}
.math-tab-content.active {
    display: block;
}
.math-char-group {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 4px;
}
.math-group-label {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    margin-right: 4px;
    display: inline-block;
}
.btn-math-char {
    min-width: 32px;
    height: 32px;
    padding: 2px 7px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    cursor: pointer;
    transition: all 0.15s ease;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    outline: none !important;
}
.btn-math-char:hover {
    background: #00c292;
    color: #ffffff;
    border-color: #00c292;
    transform: translateY(-1px);
    box-shadow: 0 3px 6px rgba(0, 194, 146, 0.2);
}
.btn-math-tag {
    font-size: 11.5px;
    font-family: 'Consolas', 'Courier New', monospace;
    font-weight: 600;
    padding: 2px 8px;
    min-width: unset;
}
.math-template-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
    gap: 6px;
    max-height: 165px;
    overflow-y: auto;
    padding-right: 4px;
}
.btn-math-tpl {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 6px 10px;
    font-size: 11.5px;
    text-align: left;
    color: #334155;
    cursor: pointer;
    transition: all 0.15s ease;
    width: 100%;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    outline: none !important;
}
.btn-math-tpl:hover {
    background: #f0fdf4;
    border-color: #86efac;
    color: #166534;
    box-shadow: 0 2px 4px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

/* Detail Card Info */
.detail-indikator-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-left: 4px solid #00c292;
    border-radius: 6px;
    padding: 12px 14px;
}
.detail-indikator-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: #64748b;
    letter-spacing: 0.5px;
}
.detail-indikator-val {
    font-size: 13.5px;
    font-weight: 700;
    color: #1e293b;
    margin-top: 3px;
    line-height: 1.4;
}

/* Live Preview Box */
.rumus-preview-container {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 14px;
    margin-top: 12px;
}
.rumus-preview-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    font-size: 12px;
    color: #475569;
}
.rumus-preview-badge {
    font-size: 10px;
    background: #e2e8f0;
    color: #475569;
    padding: 2px 7px;
    border-radius: 4px;
    font-weight: 600;
}
.rumus-preview-body {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 10px 12px;
    min-height: 42px;
    font-size: 13.5px;
    color: #0f172a;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    line-height: 1.5;
    word-break: break-word;
}

/* Superscript & Subscript Clean Typography */
sup {
    font-size: 75% !important;
    vertical-align: super !important;
    line-height: 0 !important;
}
/* Modal IKK Dialog & Content (Matching IKD) */
.modal-ikd-dialog {
    width: 92%;
    max-width: 760px;
    margin: 30px auto;
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

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN -->
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
                                                                <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
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

                                            <!-- FILTER INSTANSI SEBELUM LOGIN -->
                                            <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display: none;">
                                                <div class="filter-group">
                                                    <label for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansiBeforeLogin">
                                                        <option value="">-- Semua Instansi --</option>
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

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                    <?php 
                                    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                    if (!empty($filter_instansi_id)) { 
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                                    ?>
                                        <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- END FILTER WILAYAH -->

                        <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="filter-group">
                                                    <label for="FilterInstansi"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansi">
                                                        <option value="">-- Semua Instansi --</option>
                                                        <?php foreach ($ListInstansi as $ins) { ?>
                                                            <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                                <?= html_escape($ins['nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                                                        <b>Tampilkan</b>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn">
                                                        <b>Reset</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- END FILTER INSTANSI -->

                        <!-- TAMPILKAN NAMA INSTANSI YANG SEDANG LOGIN (UNTUK ROLE 4) -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                                <br><small>Anda hanya dapat melihat dan mengelola data milik instansi Anda sendiri.</small>
                            </div>
                        <?php } ?>

                        <?php
                        $NamaBidangAktif = '';
                        if (!empty($Urusan) && !empty($UrusanAktif)) {
                            foreach ($Urusan as $u) {
                                if ((string)$u['id'] === (string)$UrusanAktif) {
                                    $NamaBidangAktif = $u['nama_urusan'];
                                    break;
                                }
                            }
                        }
                        ?>

                        <!-- ================= BIDANG URUSAN PD ================= -->
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-lg-4">
                                <label><b>Bidang Urusan PD <span style="color:red">*</span></b></label>
                                <select class="form-control" id="UrusanPD">
                                    <?php if (!$IsRole4 && empty($FilterInstansiId)) { ?>
                                        <option value="">-- Pilih Instansi terlebih dahulu --</option>
                                    <?php } else { ?>
                                        <option value="">-- Pilih Bidang Urusan --</option>
                                        <?php if (!empty($Urusan)) { ?>
                                            <?php foreach ($Urusan as $u) { ?>
                                                <option value="<?= $u['id'] ?>"
                                                    <?= ($UrusanAktif == $u['id']) ? 'selected' : '' ?>>
                                                    <?= html_escape($u['nama_urusan']) ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="" disabled>-- Instansi ini belum memiliki Bidang Urusan PD --</option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if ($IsRole4 && $UrusanAktif) { ?>
                                <div class="col-lg-3" style="margin-top:25px;">
                                    <button type="button" class="btn btn-success notika-btn-success" id="BtnTambahIkkPD">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah IKK</b>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- ================= TABLE ================= -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2" width="40" style="vertical-align: middle !important;">No</th>
                                        <th rowspan="2" style="min-width:180px; text-align: left; vertical-align: middle !important;">Indikator</th>
                                        <th rowspan="2" style="min-width:180px; text-align: left; vertical-align: middle !important;">Rumus</th>
                                        <th class="text-center" rowspan="2" width="80" style="vertical-align: middle !important;">Satuan</th>
                                        <th class="text-center" rowspan="2" width="90" style="vertical-align: middle !important;">Baseline<br>2024</th>
                                        <th class="text-center" colspan="6">Target Tahun</th>
                                        <th rowspan="2" style="vertical-align: middle !important;">Keterangan</th>
                                        <?php if ($IsRole4) { ?>
                                            <th class="text-center" rowspan="2" width="130" style="vertical-align: middle !important;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                    <tr class="text-center">
                                        <th class="text-center">2025</th>
                                        <th class="text-center">2026</th>
                                        <th class="text-center">2027</th>
                                        <th class="text-center">2028</th>
                                        <th class="text-center">2029</th>
                                        <th class="text-center">2030</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($UrusanAktif && !empty($Data)) { ?>
                                        <?php $no = 1; foreach ($Data as $row) { ?>
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= $no++ ?></td>
                                                <td style="vertical-align: middle !important;"><?= nl2br(html_escape($row['indikator'])) ?></td>
                                                <td style="vertical-align: middle !important;">
                                                    <?php if (!empty($row['rumus'])) { ?>
                                                        <div class="rumus-tag-wrapper">
                                                            <i class="fa fa-calculator rumus-badge-icon"></i>
                                                            <span><?= format_rumus_rpjmd($row['rumus']) ?></span>
                                                        </div>
                                                    <?php } else { ?>
                                                        <span class="text-muted" style="font-size:11px; font-style:italic;">-</span>
                                                    <?php } ?>
                                                </td>
<?php
if (!function_exists('format_target_koma')) {
    function format_target_koma($v) {
        if ($v === null || $v === '') return '-';
        $str = trim((string)$v);
        if ($str === '' || $str === '-') return '-';
        return html_escape(str_replace('.', ',', $str));
    }
}
?>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= html_escape($row['satuan']) ?></td>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= format_target_koma($row['baseline_2024'] ?? null) ?></td>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= format_target_koma($row['t_2025'] ?? null) ?></td>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= format_target_koma($row['t_2026'] ?? null) ?></td>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= format_target_koma($row['t_2027'] ?? null) ?></td>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= format_target_koma($row['t_2028'] ?? null) ?></td>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= format_target_koma($row['t_2029'] ?? null) ?></td>
                                                <td class="text-center" style="vertical-align: middle !important;"><?= format_target_koma($row['t_2030'] ?? null) ?></td>
                                                <td style="vertical-align: middle !important;"><?= nl2br(html_escape($row['keterangan'])) ?></td>
                                                <?php if ($IsRole4) { ?>
                                                    <td class="text-center" style="vertical-align: middle !important;">
                                                        <?php if ($InstansiId == ($row['id_instansi'] ?? null)) { ?>

                                                            <button type="button" class="btn btn-warning btn-sm BtnEdit"
                                                                data-json='<?= json_encode($row) ?>'
                                                                title="Edit IKK PD">
                                                                <i class="notika-icon notika-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger BtnHapus"
                                                                data-id="<?= $row['id'] ?>"
                                                                title="Hapus IKK PD">
                                                                <i class="notika-icon notika-trash"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="<?= $IsRole4 ? '13' : '12' ?>" class="text-center">
                                                <?= $UrusanAktif ? 'Belum ada data IKK PD' : 'Silakan pilih Bidang Urusan PD terlebih dahulu' ?>
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

    <!-- ================= MODAL INPUT / EDIT IKK PD ================= -->
    <div class="modal fade" id="ModalInputIKK" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-ikd-dialog">
            <div class="modal-content modal-ikd-content">
                <div class="modal-header modal-ikd-header">
                    <button type="button" class="close" data-dismiss="modal" title="Tutup">&times;</button>
                    <h4 class="modal-title">
                        <span class="modal-title-icon" id="ModalInputIKKIcon"><i class="fa fa-plus"></i></span>
                        <span id="ModalInputIKKTitle">Form Indikator Kunci (IKK) Bidang Urusan</span>
                    </h4>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-body modal-ikd-body">
                    <div class="aspek-banner-chip">
                        <span class="chip-label"><i class="fa fa-folder-open"></i> Bidang Urusan:</span>
                        <span class="chip-value" id="ModalInputIKKBidangLabel"><?= !empty($NamaBidangAktif) ? html_escape($NamaBidangAktif) : '-' ?></span>
                    </div>
                    <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                        <div class="alert alert-info" style="border-radius: 6px; padding: 10px 14px; margin-bottom: 15px;">
                            <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                        </div>
                    <?php } ?>
                    
                    <input type="hidden" id="EditId">

                    <div class="form-group">
                        <label class="form-label-ikd">Nama Indikator Kunci (IKK) <span class="text-danger">*</span></label>
                        <textarea id="indikator" class="form-control-ikd" rows="2" placeholder="Tuliskan nama indikator secara jelas dan lengkap..." required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label-ikd">Satuan Pengukuran <span class="text-danger">*</span></label>
                                <input type="text" id="satuan" class="form-control-ikd" placeholder="Contoh: %, Orang, Dokumen" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label-ikd">Baseline 2024</label>
                                <input type="text" id="baseline_2024" class="form-control-ikd input-target" placeholder="0,00">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label-ikd">Rumus / Cara Penghitungan</label>

                        <!-- Bilah Tombol Simbol Matematika -->
                        <div class="math-toolbar-box">
                            <div class="math-toolbar-header">
                                <span class="math-toolbar-title"><i class="fa fa-keyboard-o text-primary"></i> Papan Simbol Matematika</span>
                                <div class="math-tab-pills">
                                    <button type="button" class="math-tab-btn active" data-tab="tab-mikk-pangkat">Pangkat</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-mikk-subscript">Indeks Bawah</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-mikk-operator">Operator &amp; Akar</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-mikk-simbol">Simbol &amp; Yunani</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-mikk-kurung">Kurung</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-mikk-template">Template Cepat</button>
                                </div>
                            </div>
                            <div class="math-tab-content active" id="tab-mikk-pangkat">
                                <div class="math-char-group">
                                    <span class="math-group-label">Angka Pangkat:</span>
                                    <button type="button" class="btn-math-char" data-char="⁰">⁰</button>
                                    <button type="button" class="btn-math-char" data-char="¹">¹</button>
                                    <button type="button" class="btn-math-char" data-char="²">²</button>
                                    <button type="button" class="btn-math-char" data-char="³">³</button>
                                    <button type="button" class="btn-math-char" data-char="⁴">⁴</button>
                                    <button type="button" class="btn-math-char" data-char="⁵">⁵</button>
                                    <button type="button" class="btn-math-char" data-char="⁶">⁶</button>
                                    <button type="button" class="btn-math-char" data-char="⁷">⁷</button>
                                    <button type="button" class="btn-math-char" data-char="⁸">⁸</button>
                                    <button type="button" class="btn-math-char" data-char="⁹">⁹</button>
                                    <button type="button" class="btn-math-char" data-char="ⁿ">ⁿ</button>
                                    <button type="button" class="btn-math-char" data-char="ᵗ">ᵗ</button>
                                    <button type="button" class="btn-math-char" data-char="⁺">⁺</button>
                                    <button type="button" class="btn-math-char" data-char="⁻">⁻</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Format Notasi:</span>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="^2">^2</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="^(1/t)">^(1/t)</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="<sup></sup>" data-tag="sup">&lt;sup&gt;x&lt;/sup&gt;</button>
                                </div>
                            </div>
                            <div class="math-tab-content" id="tab-mikk-subscript">
                                <div class="math-char-group">
                                    <span class="math-group-label">Angka &amp; Huruf Bawah:</span>
                                    <button type="button" class="btn-math-char" data-char="₀">₀</button>
                                    <button type="button" class="btn-math-char" data-char="₁">₁</button>
                                    <button type="button" class="btn-math-char" data-char="₂">₂</button>
                                    <button type="button" class="btn-math-char" data-char="₃">₃</button>
                                    <button type="button" class="btn-math-char" data-char="₄">₄</button>
                                    <button type="button" class="btn-math-char" data-char="₅">₅</button>
                                    <button type="button" class="btn-math-char" data-char="₆">₆</button>
                                    <button type="button" class="btn-math-char" data-char="₇">₇</button>
                                    <button type="button" class="btn-math-char" data-char="₈">₈</button>
                                    <button type="button" class="btn-math-char" data-char="₉">₉</button>
                                    <button type="button" class="btn-math-char" data-char="ₜ">ₜ</button>
                                    <button type="button" class="btn-math-char" data-char="ᵢ">ᵢ</button>
                                    <button type="button" class="btn-math-char" data-char="ⱼ">ⱼ</button>
                                    <button type="button" class="btn-math-char" data-char="ₙ">ₙ</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Variabel Populer:</span>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Pₜ">Pₜ</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Pₜ₋₁">Pₜ₋₁</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="P₀">P₀</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Xᵢ">Xᵢ</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Wᵢ">Wᵢ</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="<sub></sub>" data-tag="sub">&lt;sub&gt;x&lt;/sub&gt;</button>
                                </div>
                            </div>
                            <div class="math-tab-content" id="tab-mikk-operator">
                                <div class="math-char-group">
                                    <span class="math-group-label">Aritmatika &amp; Perbandingan:</span>
                                    <button type="button" class="btn-math-char" data-char=" × ">×</button>
                                    <button type="button" class="btn-math-char" data-char=" ÷ ">÷</button>
                                    <button type="button" class="btn-math-char" data-char=" ± ">±</button>
                                    <button type="button" class="btn-math-char" data-char=" / ">/</button>
                                    <button type="button" class="btn-math-char" data-char=" · ">·</button>
                                    <button type="button" class="btn-math-char" data-char=" = ">=</button>
                                    <button type="button" class="btn-math-char" data-char=" ≠ ">≠</button>
                                    <button type="button" class="btn-math-char" data-char=" ≈ ">≈</button>
                                    <button type="button" class="btn-math-char" data-char=" ≤ ">≤</button>
                                    <button type="button" class="btn-math-char" data-char=" ≥ ">≥</button>
                                    <button type="button" class="btn-math-char" data-char="%">%</button>
                                    <button type="button" class="btn-math-char" data-char="‰">‰</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Bentuk Akar:</span>
                                    <button type="button" class="btn-math-char" data-char="√">√</button>
                                    <button type="button" class="btn-math-char" data-char="∛">∛</button>
                                    <button type="button" class="btn-math-char" data-char="∜">∜</button>
                                </div>
                            </div>
                            <div class="math-tab-content" id="tab-mikk-simbol">
                                <div class="math-char-group">
                                    <span class="math-group-label">Statistik &amp; Kalkulus:</span>
                                    <button type="button" class="btn-math-char" data-char="∑">∑</button>
                                    <button type="button" class="btn-math-char" data-char="∏">∏</button>
                                    <button type="button" class="btn-math-char" data-char="Δ">Δ</button>
                                    <button type="button" class="btn-math-char" data-char="x̄">x̄</button>
                                    <button type="button" class="btn-math-char" data-char="μ">μ</button>
                                    <button type="button" class="btn-math-char" data-char="σ">σ</button>
                                    <button type="button" class="btn-math-char" data-char="∞">∞</button>
                                    <button type="button" class="btn-math-char" data-char="∂">∂</button>
                                    <button type="button" class="btn-math-char" data-char="∫">∫</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Huruf Yunani:</span>
                                    <button type="button" class="btn-math-char" data-char="α">α</button>
                                    <button type="button" class="btn-math-char" data-char="β">β</button>
                                    <button type="button" class="btn-math-char" data-char="γ">γ</button>
                                    <button type="button" class="btn-math-char" data-char="δ">δ</button>
                                    <button type="button" class="btn-math-char" data-char="ε">ε</button>
                                    <button type="button" class="btn-math-char" data-char="θ">θ</button>
                                    <button type="button" class="btn-math-char" data-char="λ">λ</button>
                                    <button type="button" class="btn-math-char" data-char="π">π</button>
                                    <button type="button" class="btn-math-char" data-char="φ">φ</button>
                                    <button type="button" class="btn-math-char" data-char="ω">ω</button>
                                </div>
                            </div>
                            <div class="math-tab-content" id="tab-mikk-kurung">
                                <div class="math-char-group">
                                    <span class="math-group-label">Tanda Kurung &amp; Pembatas:</span>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="( )" data-wrap="(" data-wrapend=")">( )</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="[ ]" data-wrap="[" data-wrapend="]">[ ]</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="{ }" data-wrap="{" data-wrapend="}">{ }</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="| |" data-wrap="|" data-wrapend="|">| x |</button>
                                </div>
                            </div>
                            <div class="math-tab-content" id="tab-mikk-template">
                                <div class="math-template-list">
                                    <button type="button" class="btn-math-tpl" data-tpl="(Realisasi / Target) × 100%"><i class="fa fa-percent text-success"></i> <b>Capaian Target:</b> (Realisasi / Target) × 100%</button>
                                    <button type="button" class="btn-math-tpl" data-tpl="((Pₜ - Pₜ₋₁) / Pₜ₋₁) × 100%"><i class="fa fa-line-chart text-info"></i> <b>Laju Pertumbuhan:</b> ((Pₜ - Pₜ₋₁) / Pₜ₋₁) × 100%</button>
                                    <button type="button" class="btn-math-tpl" data-tpl="((Pₜ / P₀)^(1/t) - 1) × 100%"><i class="fa fa-superscript text-primary"></i> <b>Pertumbuhan Geometrik:</b> ((Pₜ / P₀)^(1/t) - 1) × 100%</button>
                                    <button type="button" class="btn-math-tpl" data-tpl="(Jumlah Kasus / Total Populasi) × 100%"><i class="fa fa-pie-chart text-warning"></i> <b>Rasio / Proporsi:</b> (Kasus / Populasi) × 100%</button>
                                    <button type="button" class="btn-math-tpl" data-tpl="∑(Wᵢ × Xᵢ) / ∑Wᵢ"><i class="fa fa-balance-scale text-danger"></i> <b>Rata-rata Tertimbang:</b> ∑(Wᵢ × Xᵢ) / ∑Wᵢ</button>
                                    <button type="button" class="btn-math-tpl" data-tpl="(∑ Xᵢ) / n"><i class="fa fa-calculator text-success"></i> <b>Rata-rata Hitung:</b> (∑ Xᵢ) / n</button>
                                    <button type="button" class="btn-math-tpl" data-tpl="√[ ∑(Xᵢ - x̄)² / (n - 1) ]"><i class="fa fa-area-chart text-info"></i> <b>Standar Deviasi:</b> √[ ∑(Xᵢ - x̄)² / (n - 1) ]</button>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;">
                            <textarea class="form-control-ikd" name="rumus" id="rumus" rows="3" placeholder="Ketik rumus atau klik tombol simbol di atas...&#10;Contoh: ((Pₜ - Pₜ₋₁) / Pₜ₋₁) × 100%" style="border-radius: 8px; font-size: 13px; font-family: 'Consolas', 'Courier New', monospace; resize: vertical; padding: 10px 12px; border: 1.5px solid #cbd5e1; line-height: 1.5;"></textarea>
                        </div>

                        <!-- Live Preview Rumus -->
                        <div class="rumus-preview-container" style="margin-top: 10px;">
                            <div class="rumus-preview-header">
                                <span><i class="fa fa-eye text-primary"></i> <b>Pratinjau Tampilan Rumus:</b></span>
                                <span class="rumus-preview-badge">Tampilan di Tabel</span>
                            </div>
                            <div class="rumus-preview-body" id="RumusLivePreview">
                                <span class="text-muted" style="font-style: italic; color: #94a3b8;">Belum ada rumus.</span>
                            </div>
                        </div>
                    </div>

                    <div class="target-grid-card">
                        <div class="grid-title"><i class="fa fa-calendar-check-o text-success"></i> Target Kinerja Tahunan (2025 - 2030)</div>
                        <div class="row">
                            <?php for ($y = 2025; $y <= 2030; $y++) { ?>
                                <div class="col-xs-4 col-sm-2">
                                    <div class="target-year-box">
                                        <label><?= $y ?></label>
                                        <input type="text" class="form-control-target input-target" id="t_<?= $y ?>" placeholder="0,00">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 14px;">
                        <label class="form-label-ikd">Keterangan</label>
                        <textarea id="keterangan" class="form-control-ikd" rows="2" placeholder="Keterangan tambahan (opsional)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-ikd-footer">
                    <button type="button" class="btn-ikd-modal btn-ikd-cancel" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn-ikd-modal btn-ikd-submit" id="BtnSimpan">
                        <i class="fa fa-save"></i> <b>Simpan Data</b>
                    </button>
                </div>
            </div>
        </div>
    </div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

jQuery(document).ready(function($){

    // Inisialisasi DataTable
    if ($('#data-table-basic').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-basic')) {
                $('#data-table-basic').DataTable().destroy();
            }
            $('#data-table-basic').DataTable({
                "pageLength": 10,
                "ordering": false,
                "language": {
                    "emptyTable": "Tidak ada data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "drawCallback": function(settings) {
                    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                    pagination.find('a').css('margin', '0 5px');
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }

    setTimeout(function() {
        $('.dataTables_paginate a').css('margin', '0 5px');
        $('.dataTables_paginate span a').css('margin', '0 5px');
        $('.dataTables_paginate').css('margin-top', '10px');
        $('.dataTables_info').css('margin', '10px 0');
    }, 100);

    /* ================= FILTER WILAYAH SEBELUM LOGIN ================= */
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiGroupBefore").hide();
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            success: function(res) {
                var opt = '<option value="">Pilih Kab/Kota</option>';
                if (res && res.length > 0) {
                    $.each(res, function(i, item) {
                        opt += '<option value="' + item.Kode + '">' + item.Nama + '</option>';
                    });
                }
                $("#KabKota").html(opt);
                $("#FilterInstansiGroupBefore").hide();
            }
        });
    });

    $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
            $("#FilterInstansiGroupBefore").hide();
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetInstansiByKabKota",
            type: "POST",
            data: { kodewilayah: kabKotaKode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            success: function(res) {
                var opt = '<option value="">-- Semua Instansi --</option>';
                if (res && res.length > 0) {
                    $.each(res, function(i, item) {
                        opt += '<option value="' + item.id + '">' + item.nama + '</option>';
                    });
                    $("#FilterInstansiBeforeLogin").html(opt);
                    $("#FilterInstansiGroupBefore").show();
                } else {
                    $("#FilterInstansiGroupBefore").hide();
                }
            }
        });
    });

    $("#Filter").click(function() {
        var kabKota = $("#KabKota").val();
        var prov    = $("#Provinsi").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();

        if (kabKota === "" && prov === "") {
            alert("Pilih Provinsi dan Kab/Kota terlebih dahulu!");
            return;
        }

        var selectedKode = kabKota !== "" ? kabKota : prov;
        $("#Filter").prop('disabled', true).text('Memuat...');

        $.ajax({
            url: BaseURL + "Instansi/SimpanFilterWilayah",
            type: "POST",
            data: {
                KodeWilayah: selectedKode,
                FilterInstansiId: instansiId,
                [CSRF_NAME]: CSRF_TOKEN
            },
            success: function(res) {
                if (res === "1") {
                    var redirectUrl = BaseURL + "Instansi/IkkPD";
                    if (instansiId && instansiId !== "") {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() { alert("Gagal menghubungi server!"); }
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

    /* ================= FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) ================= */
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
        $("#FilterInstansiBtn").click(function() {
            var instansiId = $("#FilterInstansi").val();
            var url = BaseURL + "Instansi/IkkPD";
            if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
            window.location.href = url;
        });
        $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/IkkPD"; });
    <?php } ?>

    /* ================= FILTER URUSAN PD ================= */
    $("#UrusanPD").change(function(){
        var urusanId = $(this).val();
        var url = BaseURL + "Instansi/IkkPD";
        var params = [];

        var instansiId = '';
        <?php if ($IsLoggedIn && !$IsRole4 && !empty($FilterInstansiId)) { ?>
            instansiId = '<?= $FilterInstansiId ?>';
        <?php } elseif (!isset($_SESSION['KodeWilayah']) && !empty($FilterInstansiId)) { ?>
            instansiId = '<?= $FilterInstansiId ?>';
        <?php } ?>

        if (instansiId) { params.push("instansi_id=" + instansiId); }
        if (urusanId) { params.push("urusan_id=" + urusanId); }

        if (params.length > 0) { url += "?" + params.join("&"); }
        window.location.href = url;
    });

    // Set dropdown urusan jika ada nilai dari URL
    <?php if (!empty($UrusanAktif)) { ?>
        $("#UrusanPD").val("<?= $UrusanAktif ?>");
    <?php } ?>

    /* ================= HELPER FORMULA LIVE PREVIEW & INSERT ================= */
    function renderRumusHtml(str) {
        if (!str || !str.trim()) {
            return '<span class="text-muted" style="font-style: italic; color: #94a3b8;">Belum ada rumus yang dimasukkan. Ketik rumus atau klik tombol simbol di atas.</span>';
        }
        var escaped = $('<div>').text(str).html();
        escaped = escaped.replace(/&lt;sup&gt;/gi, '<sup>')
                         .replace(/&lt;\/sup&gt;/gi, '</sup>')
                         .replace(/&lt;sub&gt;/gi, '<sub>')
                         .replace(/&lt;\/sub&gt;/gi, '</sub>');

        escaped = escaped.replace(/\^\{([^\}]+)\}/g, '<sup>$1</sup>');
        escaped = escaped.replace(/\^\(([^\)]+)\)/g, '<sup>$1</sup>');
        escaped = escaped.replace(/\^([0-9a-zA-Z\+\-\*\/]+)/g, '<sup>$1</sup>');

        escaped = escaped.replace(/\_\{([^\}]+)\}/g, '<sub>$1</sub>');
        escaped = escaped.replace(/\_\(([^\)]+)\)/g, '<sub>$1</sub>');
        escaped = escaped.replace(/\_([a-zA-Z0-9\+\-]+)/g, '<sub>$1</sub>');

        escaped = escaped.replace(/\n/g, '<br>');
        return escaped;
    }

    function updateRumusLivePreviewIkkPD() {
        var raw = $('#rumus').val();
        if (raw && raw.trim() !== '') {
            $('#RumusLivePreview').html(renderRumusHtml(raw));
        } else {
            $('#RumusLivePreview').html('<span class="text-muted" style="font-style: italic; color: #94a3b8;">Belum ada rumus.</span>');
        }
    }

    function insertRumusTextIkkPD(textToInsert, wrapStart, wrapEnd) {
        var textarea = document.getElementById('rumus');
        if (!textarea) return;

        var startPos = textarea.selectionStart;
        var endPos = textarea.selectionEnd;
        var currentVal = textarea.value;

        if (wrapStart !== undefined && wrapEnd !== undefined && startPos !== endPos) {
            var selectedText = currentVal.substring(startPos, endPos);
            var replacement = wrapStart + selectedText + wrapEnd;
            textarea.value = currentVal.substring(0, startPos) + replacement + currentVal.substring(endPos);
            textarea.selectionStart = startPos + wrapStart.length;
            textarea.selectionEnd = startPos + wrapStart.length + selectedText.length;
        } else if (typeof startPos === 'number' && typeof endPos === 'number') {
            textarea.value = currentVal.substring(0, startPos) + textToInsert + currentVal.substring(endPos);
            textarea.selectionStart = textarea.selectionEnd = startPos + textToInsert.length;
        } else {
            textarea.value += textToInsert;
        }

        textarea.focus();
        updateRumusLivePreviewIkkPD();
    }

    // Tab Switching Bilah Simbol Matematika
    $(document).on('click', '.math-tab-btn', function(e) {
        e.preventDefault();
        var parent = $(this).closest('.math-toolbar-box');
        parent.find('.math-tab-btn').removeClass('active');
        $(this).addClass('active');

        var targetTab = $(this).data('tab');
        parent.find('.math-tab-content').removeClass('active');
        $('#' + targetTab).addClass('active');
    });

    // Klik Tombol Karakter / Simbol Matematika
    $(document).on('click', '.btn-math-char', function(e) {
        e.preventDefault();
        var tag = $(this).data('tag');
        var char = $(this).data('char');
        var wrap = $(this).data('wrap');
        var wrapEnd = $(this).data('wrapend');

        if (tag === 'sup') {
            insertRumusTextIkkPD('<sup></sup>', '<sup>', '</sup>');
        } else if (tag === 'sub') {
            insertRumusTextIkkPD('<sub></sub>', '<sub>', '</sub>');
        } else if (wrap && wrapEnd) {
            insertRumusTextIkkPD(char, wrap, wrapEnd);
        } else {
            insertRumusTextIkkPD(char);
        }
    });

    // Klik Tombol Template Rumus Cepat
    $(document).on('click', '.btn-math-tpl', function(e) {
        e.preventDefault();
        var tpl = $(this).data('tpl');
        var current = ($('#rumus').val() || '').trim();

        if (current && current !== tpl) {
            if (confirm('Ganti teks rumus saat ini dengan template yang dipilih?')) {
                $('#rumus').val(tpl);
            } else {
                insertRumusTextIkkPD(' ' + tpl);
                return;
            }
        } else {
            $('#rumus').val(tpl);
        }
        $('#rumus').focus();
        updateRumusLivePreviewIkkPD();
    });

    // Live Preview saat ngetik di Textarea Rumus
    $('#rumus').on('input propertychange change keyup', function() {
        updateRumusLivePreviewIkkPD();
    });

    // Auto replace dot with comma on target inputs
    $(document).on('input', '.input-target', function() {
        $(this).val($(this).val().replace(/\./g, ','));
    });

    /* ================= CRUD OPERATIONS (HANYA UNTUK ROLE 4) ================= */
    <?php if ($IsRole4) { ?>

    // Reset form tambah IKK PD
    $("#BtnTambahIkkPD").click(function(){
        $("#EditId").val("");
        $("#ModalInputIKKTitle").text("Tambah Indikator Kunci (IKK) Bidang Urusan");
        $("#ModalInputIKKIcon").html('<i class="fa fa-plus"></i>');
        $("#indikator").val("");
        $("#rumus").val("");
        $("#satuan").val("");
        $("#baseline_2024").val("");
        for (let y = 2025; y <= 2030; y++) {
            $("#t_" + y).val("");
        }
        $("#keterangan").val("");
        var bidangText = $("#UrusanPD option:selected").text().trim() || '-';
        $("#ModalInputIKKBidangLabel").text(bidangText);
        updateRumusLivePreviewIkkPD();
        $("#ModalInputIKK").modal("show");
    });

    // SIMPAN IKK (baru / edit)
    $("#BtnSimpan").click(function(){
        var indikator = $("#indikator").val().trim();
        var satuan = $("#satuan").val().trim();
        var rumus = $("#rumus").val().trim();
        var urusan_id = $("#UrusanPD").val();
        
        console.log("Urusan ID:", urusan_id);
        console.log("Indikator:", indikator);
        console.log("Satuan:", satuan);
        
        if (!urusan_id) {
            alert("Bidang Urusan PD wajib dipilih terlebih dahulu!");
            return;
        }
        
        if (indikator === "") {
            alert("Indikator wajib diisi!");
            return;
        }
        
        if (satuan === "") {
            alert("Satuan wajib diisi!");
            return;
        }
        
        var id = $("#EditId").val();
        var url = id ? "EditIkkPD" : "InputIkkPD";
        
        var postData = {
            [CSRF_NAME]: CSRF_TOKEN,
            id: id,
            urusan_id: urusan_id,
            indikator: indikator,
            rumus: rumus,
            satuan: satuan,
            baseline_2024: $("#baseline_2024").val(),
            t_2025: $("#t_2025").val(),
            t_2026: $("#t_2026").val(),
            t_2027: $("#t_2027").val(),
            t_2028: $("#t_2028").val(),
            t_2029: $("#t_2029").val(),
            t_2030: $("#t_2030").val(),
            keterangan: $("#keterangan").val()
        };
        
        console.log("Post Data:", postData);
        
        $.ajax({
            url: BaseURL + "Instansi/" + url,
            type: "POST",
            data: postData,
            dataType: 'text',
            success: function(res){
                console.log("Response:", res);
                if (res === '1') {
                    location.reload();
                } else {
                    alert(res || "Gagal menyimpan data!");
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
                console.log("Response Text:", xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });
    });

    // EDIT button
    $(document).on("click", ".BtnEdit", function(){
        var d = JSON.parse($(this).attr("data-json"));
        $("#EditId").val(d.id);
        $("#ModalInputIKKTitle").text("Edit Indikator Kunci (IKK) Bidang Urusan");
        $("#ModalInputIKKIcon").html('<i class="fa fa-pencil"></i>');
        $("#indikator").val(d.indikator);
        $("#rumus").val(d.rumus || "");
        $("#satuan").val(d.satuan);
        $("#baseline_2024").val(d.baseline_2024 ? String(d.baseline_2024).replace(/\./g, ',') : "");
        for (let y = 2025; y <= 2030; y++) {
            $("#t_" + y).val(d["t_" + y] ? String(d["t_" + y]).replace(/\./g, ',') : "");
        }
        $("#keterangan").val(d.keterangan);
        var bidangText = $("#UrusanPD option:selected").text().trim() || '-';
        $("#ModalInputIKKBidangLabel").text(bidangText);
        updateRumusLivePreviewIkkPD();
        $("#ModalInputIKK").modal("show");
    });

    // HAPUS button
    $(document).on("click", ".BtnHapus", function(){
        if (!confirm("Hapus data IKK ini?")) return;
        $.ajax({
            url: BaseURL + "Instansi/HapusIkkPD",
            type: "POST",
            data: {
                id: $(this).data("id"),
                [CSRF_NAME]: CSRF_TOKEN
            },
            success: function(res){
                if (res === '1') location.reload();
                else alert(res);
            },
            error: function() { alert("Gagal request!"); }
        });
    });

    <?php } ?>
});
</script>
</body>
</html>