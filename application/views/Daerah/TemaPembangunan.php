<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <!-- Filter untuk pengguna yang belum login -->
                            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="filter-card-custom" style="background:#fff; border-radius:12px; padding:18px 24px; margin-bottom:20px; box-shadow:0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04); border:1px solid #cbd5e1;">
                                <div class="filter-header-title" style="font-size:14px; font-weight:700; color:#1e293b; margin-bottom:14px; display:flex; align-items:center; gap:8px;">
                                    <i class="fa fa-filter" style="color:#2d6a4f;"></i> Filter Wilayah
                                </div>
                                <div class="row" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
                                    <div class="col-filter" style="flex:1; min-width:200px;">
                                        <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Provinsi</label>
                                        <select class="form-control filter-select-custom" id="Provinsi" style="width:100%; height:38px; border-radius:8px; border:1px solid #cbd5e1; font-size:13px; padding:6px 10px;">
                                            <option value="">Pilih Provinsi</option>
                                            <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php }} ?>
                                        </select>
                                    </div>

                                    <div class="col-filter" style="flex:1; min-width:200px;">
                                        <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:5px; display:block;">Kabupaten / Kota</label>
                                        <select class="form-control filter-select-custom" id="KabKota" style="width:100%; height:38px; border-radius:8px; border:1px solid #cbd5e1; font-size:13px; padding:6px 10px;">
                                            <option value="">Pilih Kab/Kota</option>
                                            <?php if (!empty($KodeWilayah)) { 
                                                $selected_kab = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                            ?>
                                                <option value="<?= html_escape($KodeWilayah) ?>" selected>
                                                    <?= html_escape($selected_kab['Nama'] ?? $NamaWilayah) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-filter" style="width:auto;">
                                        <button type="button" class="btn btn-primary-custom" id="Filter" style="height:38px; padding:0 22px; font-size:13px;">
                                            <i class="fa fa-search"></i> Filter
                                        </button>
                                    </div>
                                </div>

                                <?php if (!empty($KodeWilayah)) { ?>
                                    <div style="margin-top:14px; padding:10px 14px; background:#f2fbf5; border-left:4px solid #2d6a4f; border-radius:6px; font-size:12.5px; color:#334155;">
                                        <strong>Wilayah Terpilih:</strong> <?= html_escape($NamaWilayah) ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php } ?>

                            <div class="basic-tb-hd" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <div style="display: inline-flex; align-items: center; gap: 8px;">
                                        <label for="FilterTahunTema" style="margin: 0; font-size: 13px; font-weight: bold; color: #333;">Tahun RKPD:</label>
                                        <select id="FilterTahunTema" class="form-control" style="width: 140px; display: inline-block; height: 34px; padding: 4px 8px; font-size: 13px; color: #000; font-weight: bold;">
                                            <?php foreach ($ListTahun as $th) { ?>
                                                <option value="<?= html_escape($th) ?>" <?= ($th == $SelectedTahun) ? 'selected' : '' ?>>
                                                    Tahun <?= html_escape($th) ?>
                                                </option>
                                            <?php } ?>
                                            <option value="all" <?= ($SelectedTahun == 'all') ? 'selected' : '' ?>>Semua Tahun</option>
                                        </select>
                                    </div>
                                    <?php if (!empty($NamaWilayah)) { ?>
                                        <span class="label label-primary" style="font-size: 12px; padding: 6px 10px;">
                                            <i class="fa fa-map-marker-alt"></i> <?= html_escape($NamaWilayah) ?>
                                        </span>
                                    <?php } ?>
                                </div>

                                <div class="button-icon-btn" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <!-- Tombol Tambah Tema -->
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTema">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Tema</b>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <?php if (empty($TemaPembangunan)) { ?>
                            <div class="alert alert-info text-center" style="padding: 30px; margin-top: 15px;">
                                <i class="fa fa-info-circle fa-2x" style="vertical-align: middle; margin-right: 8px;"></i>
                                <span style="font-size: 14px;">Belum ada data Tema Pembangunan.</span>
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <div style="margin-top: 12px;">
                                        <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTema">
                                            <i class="notika-icon bi-plus-lg"></i> <b>Tambah Tema Sekarang</b>
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <?php 
                            $can_edit = isset($_SESSION['Level']) && $_SESSION['Level'] == 3;
                            foreach ($TemaPembangunan as $tema) { 
                                $pn_list = $tema['prioritas_nasional'] ?? [];
                                $pp_list = $tema['prioritas_provinsi'] ?? [];
                                $pd_list = $tema['prioritas_daerah'] ?? [];

                                // Kelompokkan PP dan PD berdasarkan id_pn
                                $pp_by_pn = [];
                                $pd_by_pn = [];
                                $pp_unlinked = [];
                                $pd_unlinked = [];

                                foreach ($pp_list as $pp) {
                                    if (!empty($pp['id_pn'])) {
                                        $pp_by_pn[$pp['id_pn']][] = $pp;
                                    } else {
                                        $pp_unlinked[] = $pp;
                                    }
                                }

                                foreach ($pd_list as $pd) {
                                    if (!empty($pd['id_pn'])) {
                                        $pd_by_pn[$pd['id_pn']][] = $pd;
                                    } else {
                                        $pd_unlinked[] = $pd;
                                    }
                                }

                                $prioritas_rows = [];
                                if (!empty($pn_list)) {
                                    foreach ($pn_list as $idx => $pn) {
                                        $pn_id = $pn['id'];
                                        $cur_pp = isset($pp_by_pn[$pn_id]) ? $pp_by_pn[$pn_id] : [];
                                        $cur_pd = isset($pd_by_pn[$pn_id]) ? $pd_by_pn[$pn_id] : [];

                                        if (empty($cur_pp) && isset($pp_unlinked[$idx])) {
                                            $cur_pp = [$pp_unlinked[$idx]];
                                            unset($pp_unlinked[$idx]);
                                        }
                                        if (empty($cur_pd) && isset($pd_unlinked[$idx])) {
                                            $cur_pd = [$pd_unlinked[$idx]];
                                            unset($pd_unlinked[$idx]);
                                        }

                                        $prioritas_rows[] = [
                                            'pn' => $pn,
                                            'pp' => $cur_pp,
                                            'pd' => $cur_pd
                                        ];
                                    }
                                }

                                $max_extra = max(count($pp_unlinked), count($pd_unlinked));
                                if ($max_extra > 0) {
                                    $pp_rem = array_values($pp_unlinked);
                                    $pd_rem = array_values($pd_unlinked);
                                    for ($i = 0; $i < $max_extra; $i++) {
                                        $prioritas_rows[] = [
                                            'pn' => null,
                                            'pp' => isset($pp_rem[$i]) ? [$pp_rem[$i]] : [],
                                            'pd' => isset($pd_rem[$i]) ? [$pd_rem[$i]] : []
                                        ];
                                    }
                                }

                                if (empty($prioritas_rows)) {
                                    $prioritas_rows[] = [
                                        'pn' => null,
                                        'pp' => [],
                                        'pd' => []
                                    ];
                                }
                            ?>
                            <div class="tema-card-wrapper" data-tahun="<?= html_escape($tema['tahun']) ?>" style="margin-bottom: 35px;">
                                <!-- Card Header Toolbar -->
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; padding: 6px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span class="label label-primary" style="font-size: 12px; padding: 4px 8px;">Tahun <?= html_escape($tema['tahun']) ?></span>
                                        <?php if (!empty($tema['tema_rkp_text'])) { ?>
                                            <span class="text-muted" style="font-size: 11px;"><i class="fa fa-bookmark"></i> RKP: <?= html_escape($tema['tema_rkp_text']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <?php if ($can_edit) { ?>
                                    <div class="action-group" style="display: inline-flex; gap: 5px; align-items: center;">
                                        <button type="button" class="btn btn-action-custom btn-action-edit EditTema" 
                                            data-id="<?= $tema['id'] ?>"
                                            data-tahun="<?= html_escape($tema['tahun']) ?>"
                                            data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                            data-tema_provinsi="<?= html_escape($tema['tema_provinsi']) ?>"
                                            data-tema_daerah="<?= html_escape($tema['tema_daerah']) ?>"
                                            data-tema_rkp_id="<?= $tema['tema_rkp_id'] ?? '' ?>"
                                            title="Edit Tema">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-action-custom btn-action-delete HapusTema" 
                                            data-id="<?= $tema['id'] ?>"
                                            title="Hapus Tema">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="table-responsive">
                                    <table class="table-tema-pembangunan">
                                        <thead>
                                            <tr class="header-tema">
                                                <th style="width: 33.33%;">
                                                    TEMA PEMBANGUNAN NASIONAL<br>TAHUN <?= html_escape($tema['tahun']) ?>
                                                </th>
                                                <th style="width: 33.33%;">
                                                    TEMA PEMBANGUNAN PROVINSI TAHUN<br><?= html_escape($tema['tahun']) ?>
                                                </th>
                                                <th style="width: 33.34%;">
                                                    TEMA PEMBANGUNAN DAERAH TAHUN<br><?= html_escape($tema['tahun']) ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="row-tema-value">
                                                <td><?= nl2br(html_escape($tema['tema_nasional'])) ?></td>
                                                <td><?= nl2br(html_escape($tema['tema_provinsi'])) ?></td>
                                                <td><?= nl2br(html_escape($tema['tema_daerah'])) ?></td>
                                            </tr>
                                            <tr class="row-separator">
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr class="header-prioritas">
                                                <th style="vertical-align: middle; padding: 10px 14px;">
                                                    <div style="display: flex; align-items: center; justify-content: space-between; position: relative;">
                                                        <!-- Spacer penyeimbang di sisi kiri agar judul benar-benar berada di tengah cell -->
                                                        <div style="visibility: hidden; flex-shrink: 0; min-width: 95px;" aria-hidden="true">
                                                            <button type="button" class="btn btn-xs" style="padding: 3px 10px; font-size: 11px;">+ Tambah PN</button>
                                                        </div>

                                                        <!-- Judul Tepat di Tengah Cell -->
                                                        <span style="font-weight: 700; text-align: center; flex: 1; margin: 0 12px;">
                                                            Prioritas Pembangunan Nasional (PN)
                                                        </span>

                                                        <!-- Tombol di Sisi Kanan dengan Jarak Aman -->
                                                        <?php if ($can_edit) { ?>
                                                            <div style="flex-shrink: 0; min-width: 95px; text-align: right;">
                                                                <button type="button" class="btn btn-xs btn-primary tambah-prioritas-kolom"
                                                                        data-tema_id="<?= $tema['id'] ?>"
                                                                        data-tahun="<?= $tema['tahun'] ?>"
                                                                        data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                                        data-id_pn=""
                                                                        data-pn_text=""
                                                                        data-jenis="nasional"
                                                                        data-label="PN"
                                                                        title="Tambah PN"
                                                                        style="font-size: 11px; font-weight: bold; padding: 3px 10px; border-radius: 4px; text-transform: none; display: inline-flex; align-items: center; gap: 4px; white-space: nowrap;">
                                                                    <i class="fa fa-plus"></i> Tambah PN
                                                                </button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div style="flex-shrink: 0; min-width: 95px;"></div>
                                                        <?php } ?>
                                                    </div>
                                                </th>
                                                <th style="vertical-align: middle; text-align: center; padding: 10px 14px;">
                                                    <span style="font-weight: 700;">Prioritas Pembangunan Provinsi (PP)</span>
                                                </th>
                                                <th style="vertical-align: middle; text-align: center; padding: 10px 14px;">
                                                    <span style="font-weight: 700;">Prioritas Pembangunan Daerah (PD)</span>
                                                </th>
                                            </tr>
                                            <?php foreach ($prioritas_rows as $row) { 
                                                $pn = $row['pn'];
                                                $pps = $row['pp'];
                                                $pds = $row['pd'];
                                            ?>
                                            <tr class="row-prioritas-data">
                                                <!-- Kolom PN -->
                                                <td>
                                                    <?php if (!empty($pn)) { ?>
                                                        <div class="pn-box">
                                                            <div class="pn-text" style="font-weight: 500; color: #111; margin-bottom: 6px;">
                                                                <?= html_escape(ltrim(trim($pn['prioritas']), "•*- \t\n\r\0\x0B")) ?>
                                                            </div>
                                                            <?php if ($can_edit) { ?>
                                                                <div class="action-group" style="display: inline-flex; gap: 4px; margin-top: 4px;">
                                                                    <button type="button" class="btn btn-action-custom btn-action-edit EditPrioritas" 
                                                                            data-id="<?= $pn['id'] ?>" 
                                                                            data-tema_id="<?= $tema['id'] ?>" 
                                                                            data-tahun="<?= $tema['tahun'] ?>"
                                                                            data-prioritas="<?= html_escape($pn['prioritas']) ?>" 
                                                                            data-jenis="nasional" 
                                                                            data-label="PN" 
                                                                            title="Edit PN">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-action-custom btn-action-delete HapusPrioritas" 
                                                                            data-id="<?= $pn['id'] ?>" 
                                                                            title="Hapus PN">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <?php if ($can_edit) { ?>
                                                            <span class="text-muted" style="font-size: 11px; font-style: italic;">(Belum ada PN pada baris ini)</span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>

                                                <!-- Kolom PP -->
                                                <td>
                                                    <?php if (!empty($pps)) { ?>
                                                        <?php foreach ($pps as $p) { ?>
                                                            <div class="prioritas-item-box" style="margin-bottom: 8px; line-height: 1.45; display: flex; justify-content: space-between; align-items: flex-start; gap: 8px;">
                                                                <span class="pp-text">&bull; <?= html_escape(ltrim(trim($p['prioritas']), "•*- \t\n\r\0\x0B")) ?></span>
                                                                <?php if ($can_edit) { ?>
                                                                    <span class="action-group" style="display: inline-flex; gap: 3px; flex-shrink: 0; margin-top: 1px;">
                                                                        <button type="button" class="btn btn-action-custom btn-action-edit EditPrioritas" 
                                                                                data-id="<?= $p['id'] ?>" 
                                                                                data-tema_id="<?= $tema['id'] ?>" 
                                                                                data-tahun="<?= $tema['tahun'] ?>"
                                                                                data-prioritas="<?= html_escape($p['prioritas']) ?>" 
                                                                                data-jenis="provinsi" 
                                                                                data-label="PP" 
                                                                                title="Edit PP">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-action-custom btn-action-delete HapusPrioritas" 
                                                                                data-id="<?= $p['id'] ?>" 
                                                                                title="Hapus PP">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </span>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if ($can_edit) { ?>
                                                        <div>
                                                            <button type="button" class="btn-add-inline tambah-prioritas-kolom"
                                                                    data-tema_id="<?= $tema['id'] ?>"
                                                                    data-tahun="<?= $tema['tahun'] ?>"
                                                                    data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                                    data-id_pn="<?= !empty($pn) ? $pn['id'] : '' ?>"
                                                                    data-pn_text="<?= !empty($pn) ? html_escape($pn['prioritas']) : '' ?>"
                                                                    data-jenis="provinsi"
                                                                    data-label="PP">
                                                                <i class="fa fa-plus"></i> Tambah PP
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </td>

                                                <!-- Kolom PD -->
                                                <td>
                                                    <?php if (!empty($pds)) { ?>
                                                        <?php foreach ($pds as $p) { ?>
                                                            <div class="prioritas-item-box" style="margin-bottom: 8px; line-height: 1.45; display: flex; justify-content: space-between; align-items: flex-start; gap: 8px;">
                                                                <span class="pd-text">&bull; <?= html_escape(ltrim(trim($p['prioritas']), "•*- \t\n\r\0\x0B")) ?></span>
                                                                <?php if ($can_edit) { ?>
                                                                    <span class="action-group" style="display: inline-flex; gap: 3px; flex-shrink: 0; margin-top: 1px;">
                                                                        <button type="button" class="btn btn-action-custom btn-action-edit EditPrioritas" 
                                                                                data-id="<?= $p['id'] ?>" 
                                                                                data-tema_id="<?= $tema['id'] ?>" 
                                                                                data-tahun="<?= $tema['tahun'] ?>"
                                                                                data-prioritas="<?= html_escape($p['prioritas']) ?>" 
                                                                                data-jenis="daerah" 
                                                                                data-label="PD" 
                                                                                title="Edit PD">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-action-custom btn-action-delete HapusPrioritas" 
                                                                                data-id="<?= $p['id'] ?>" 
                                                                                title="Hapus PD">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </span>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if ($can_edit) { ?>
                                                        <div>
                                                            <button type="button" class="btn-add-inline tambah-prioritas-kolom"
                                                                    data-tema_id="<?= $tema['id'] ?>"
                                                                    data-tahun="<?= $tema['tahun'] ?>"
                                                                    data-tema_nasional="<?= html_escape($tema['tema_nasional']) ?>"
                                                                    data-id_pn="<?= !empty($pn) ? $pn['id'] : '' ?>"
                                                                    data-pn_text="<?= !empty($pn) ? html_escape($pn['prioritas']) : '' ?>"
                                                                    data-jenis="daerah"
                                                                    data-label="PD">
                                                                <i class="fa fa-plus"></i> Tambah PD
                                                            </button>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL INPUT TEMA - TAHUN INPUT MANUAL, TEMA NASIONAL AUTO REFRESH
============================================================ -->
<div class="modal fade" id="ModalInputTema" role="dialog">
    <div class="modal-dialog modal-lg" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Tema Pembangunan</b></h4>
                <p><small class="text-muted">Tahun diisi manual, Tema Nasional otomatis refresh saat pilih tahun Tema RKP</small></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <!-- TAHUN -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Tahun" style="color: #000; font-weight: bold;">
                                                    <?php foreach ($ListTahun as $th) { ?>
                                                        <option value="<?= html_escape($th) ?>" <?= ($th == ($SelectedTahun !== 'all' ? $SelectedTahun : '2026')) ? 'selected' : '' ?>>
                                                            <?= html_escape($th) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <small class="text-muted" style="display: block; margin-top: 4px;">
                                                    <i class="fa fa-info-circle"></i> Pilih tahun rencana tema pembangunan (Periode 2025 - 2029)
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================== -->
                            <!-- DROPDOWN TEMA NASIONAL DENGAN AUTO REFRESH -->
                            <!-- ========================================== -->
                            <div class="dropdown-group">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Tema Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">Tema RKP</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <!-- Pilih Tahun Tema RKP - Auto Refresh -->
                                                    <div style="margin-bottom: 8px;">
                                                        <select class="form-control" id="TahunTemaRKP" style="color: #000;">
                                                            <option value="">-- Pilih Tahun Tema RKP --</option>
                                                            <?php foreach ($TahunTemaRKP as $t) { ?>
                                                                <option value="<?= $t['Tahun'] ?>"><?= $t['Tahun'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="text-muted" style="display: block; margin-top: 4px;">
                                                            <i class="fa fa-info-circle"></i> Tema RKP akan otomatis dimuat saat memilih tahun
                                                        </small>
                                                    </div>
                                                    <!-- Dropdown Tema RKP -->
                                                    <select class="form-control" id="TemaNasionalId" style="color: #000;">
                                                        <option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>
                                                    </select>
                                                    <span class="tema-rkp-loading" id="tema-rkp-loading">
                                                        <span class="spinner-border-sm"></span> Memuat...
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TEMA PROVINSI -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema Provinsi</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="TemaProvinsi" rows="2" placeholder="Tema Pembangunan Provinsi" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================== -->
                            <!-- DROPDOWN TEMA DAERAH (TAHAPAN RPJMD) -->
                            <!-- ========================================== -->
                            <div class="dropdown-group">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Tema Daerah</b>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <!-- Pilih Tahun Tahapan RPJMD - Auto Refresh -->
                                                    <div style="margin-bottom: 8px;">
                                                        <select class="form-control" id="TahunTahapanRPJMD" style="color: #000;">
                                                            <option value="">-- Pilih Tahun Tahapan RPJMD --</option>
                                                            <?php if (!empty($TahunTahapanRPJMD)) { 
                                                                foreach ($TahunTahapanRPJMD as $th) { ?>
                                                                    <option value="<?= $th['Tahun'] ?>">Tahun <?= $th['Tahun'] ?></option>
                                                            <?php } } else { ?>
                                                                <option value="2026">Tahun 2026</option>
                                                                <option value="2027">Tahun 2027</option>
                                                                <option value="2028">Tahun 2028</option>
                                                                <option value="2029">Tahun 2029</option>
                                                                <option value="2030">Tahun 2030</option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="text-muted" style="display: block; margin-top: 4px;">
                                                            <i class="fa fa-info-circle"></i> Tema Tahapan RPJMD akan otomatis dimuat saat memilih tahun
                                                        </small>
                                                    </div>
                                                    <!-- Dropdown Tema Daerah (Tahapan RPJMD) -->
                                                    <select class="form-control" id="TemaDaerah" style="color: #000;">
                                                        <option value="">-- Pilih Tahun Tahapan Terlebih Dahulu --</option>
                                                    </select>
                                                    <span class="tema-rkp-loading" id="tema-daerah-loading">
                                                        <span class="spinner-border-sm"></span> Memuat...
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="InputTema"><b>SIMPAN</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT TEMA - TAHUN INPUT MANUAL, TEMA NASIONAL AUTO REFRESH
============================================================ -->
<div class="modal fade" id="ModalEditTema" role="dialog">
    <div class="modal-dialog modal-lg" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Tema Pembangunan</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <input type="hidden" id="EditId">
                            
                            <!-- TAHUN -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tahun</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditTahun" style="color: #000; font-weight: bold;">
                                                    <?php foreach ($ListTahun as $th) { ?>
                                                        <option value="<?= html_escape($th) ?>"><?= html_escape($th) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN TEMA NASIONAL DENGAN AUTO REFRESH -->
                            <div class="dropdown-group">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Tema Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">Tema RKP</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <div style="margin-bottom: 8px;">
                                                        <select class="form-control" id="EditTahunTemaRKP" style="color: #000;">
                                                            <option value="">-- Pilih Tahun Tema RKP --</option>
                                                            <?php foreach ($TahunTemaRKP as $t) { ?>
                                                                <option value="<?= $t['Tahun'] ?>"><?= $t['Tahun'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <select class="form-control" id="EditTemaNasionalId" style="color: #000;">
                                                        <option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>
                                                    </select>
                                                    <span class="tema-rkp-loading" id="edit-tema-rkp-loading">
                                                        <span class="spinner-border-sm"></span> Memuat...
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TEMA PROVINSI -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema Provinsi</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="EditTemaProvinsi" rows="2" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================== -->
                            <!-- DROPDOWN TEMA DAERAH (TAHAPAN RPJMD) EDIT -->
                            <!-- ========================================== -->
                            <div class="dropdown-group">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Tema Daerah</b>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <!-- Pilih Tahun Tahapan RPJMD - Auto Refresh -->
                                                    <div style="margin-bottom: 8px;">
                                                        <select class="form-control" id="EditTahunTahapanRPJMD" style="color: #000;">
                                                            <option value="">-- Pilih Tahun Tahapan RPJMD --</option>
                                                            <?php if (!empty($TahunTahapanRPJMD)) { 
                                                                foreach ($TahunTahapanRPJMD as $th) { ?>
                                                                    <option value="<?= $th['Tahun'] ?>">Tahun <?= $th['Tahun'] ?></option>
                                                            <?php } } else { ?>
                                                                <option value="2026">Tahun 2026</option>
                                                                <option value="2027">Tahun 2027</option>
                                                                <option value="2028">Tahun 2028</option>
                                                                <option value="2029">Tahun 2029</option>
                                                                <option value="2030">Tahun 2030</option>
                                                            <?php } ?>
                                                        </select>
                                                        <small class="text-muted" style="display: block; margin-top: 4px;">
                                                            <i class="fa fa-info-circle"></i> Tema Tahapan RPJMD akan otomatis dimuat saat memilih tahun
                                                        </small>
                                                    </div>
                                                    <!-- Dropdown Tema Daerah (Tahapan RPJMD) -->
                                                    <select class="form-control" id="EditTemaDaerah" style="color: #000;">
                                                        <option value="">-- Pilih Tahun Tahapan Terlebih Dahulu --</option>
                                                    </select>
                                                    <span class="tema-rkp-loading" id="edit-tema-daerah-loading">
                                                        <span class="spinner-border-sm"></span> Memuat...
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="UpdateTema"><b>UPDATE</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL TAMBAH PRIORITAS - PN DARI DROPDOWN RPJMN
============================================================ -->
<div class="modal fade" id="ModalInputPrioritasKolom" role="dialog">
    <div class="modal-dialog" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Tambah Prioritas</b></h4>
                <p><small>Untuk tema: <span id="LabelTemaPrioritasKolom" style="font-weight: bold;"></span></small></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <input type="hidden" id="InputPrioritasTemaIdKolom">
                            <input type="hidden" id="InputPrioritasTahunKolom">
                            <input type="hidden" id="InputPrioritasJenisKolom">
                            <input type="hidden" id="InputPrioritasLabelKolom">
                            <input type="hidden" id="InputPrioritasIdPN">
                            
                            <!-- TEMA INFO -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="TemaInfoKolom" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SELARAS PN INFO -->
                            <div class="form-example-int form-horizental" id="PnInfoContainer" style="display: none;">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Selaras PN</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="PnInfoKolom" style="font-size: 12px; color: #0d6efd; background: #e7f1ff; border: 1px solid #b6d4fe; border-radius: 4px; padding: 6px 10px; margin-bottom: 0;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- JENIS PRIORITAS -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Jenis</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="JenisInfoKolom" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN PRIORITAS NASIONAL RPJMN - KHUSUS PN -->
                            <div class="dropdown-group" id="DropdownRPJMNContainer" style="display: none;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Prioritas Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">RPJMN</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="InputPrioritasRPJMNId" style="color: #000;">
                                                        <option value="">-- Pilih Prioritas Nasional RPJMN --</option>
                                                        <?php foreach ($PrioritasNasionalRPJMN as $p) { ?>
                                                            <option value="<?= $p['Id'] ?>"><?= html_escape($p['PrioritasNasional']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN PRIORITAS DAERAH DARI CASCADING RKPD - KHUSUS PD -->
                            <div class="dropdown-group" id="DropdownCascadingPDContainer" style="display: none;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Program Prioritas</b> <span class="text-danger">*</span>
                                                    <span class="badge" style="background:#28a745; color:#fff; font-size:10px; padding:2px 6px; border-radius:3px;">Cascading</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <select class="form-control select2-modal" id="InputProgramPrioritasCascadingId" style="width: 100%;">
                                                        <option value="">-- Pilih Program Prioritas (Dari Cascading RKPD) --</option>
                                                    </select>
                                                    <small class="text-muted" style="display: block; margin-top: 5px;">
                                                        * Diambil dari Program Prioritas di menu Cascading Permasalahan RKPD.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- INPUT MANUAL UNTUK PP -->
                            <div class="form-example-int form-horizental" id="InputManualContainer">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Prioritas</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="InputPrioritasKolom" rows="3" placeholder="Masukkan prioritas..." style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-primary notika-btn-primary" id="SimpanPrioritasKolom"><b>SIMPAN</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT PRIORITAS - SAMA DENGAN INPUT
============================================================ -->
<div class="modal fade" id="ModalEditPrioritas" role="dialog">
    <div class="modal-dialog" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><b>Edit Prioritas</b></h4>
                <p><small>Edit prioritas untuk tema terkait</small></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap" style="padding: 5px;">
                            
                            <input type="hidden" id="EditPrioritasId">
                            <input type="hidden" id="EditPrioritasTemaId">
                            <input type="hidden" id="EditPrioritasTahunHidden">
                            <input type="hidden" id="EditPrioritasJenisHidden">
                            <input type="hidden" id="EditPrioritasLabelHidden">
                            
                            <!-- TEMA INFO -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Tema</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="EditTemaInfo" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- JENIS PRIORITAS -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Jenis</b></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <p class="form-control-static" id="EditJenisInfo" style="font-weight: bold; color: #333;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN PRIORITAS NASIONAL RPJMN - UNTUK EDIT PN -->
                            <div class="dropdown-group" id="EditDropdownRPJMNContainer" style="display: none;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Prioritas Nasional</b> <span class="text-danger">*</span>
                                                    <span class="badge-reference">RPJMN</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPrioritasRPJMNId" style="color: #000;">
                                                        <option value="">-- Pilih Prioritas Nasional RPJMN --</option>
                                                        <?php foreach ($PrioritasNasionalRPJMN as $p) { ?>
                                                            <option value="<?= $p['Id'] ?>"><?= html_escape($p['PrioritasNasional']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DROPDOWN PRIORITAS DAERAH DARI CASCADING RKPD - KHUSUS PD (EDIT) -->
                            <div class="dropdown-group" id="EditDropdownCascadingPDContainer" style="display: none;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm">
                                                    <b>Program Prioritas</b> <span class="text-danger">*</span>
                                                    <span class="badge" style="background:#28a745; color:#fff; font-size:10px; padding:2px 6px; border-radius:3px;">Cascading</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <select class="form-control select2-modal" id="EditProgramPrioritasCascadingId" style="width: 100%;">
                                                        <option value="">-- Pilih Program Prioritas (Dari Cascading RKPD) --</option>
                                                    </select>
                                                    <small class="text-muted" style="display: block; margin-top: 5px;">
                                                        * Diambil dari Program Prioritas di menu Cascading Permasalahan RKPD.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- INPUT MANUAL UNTUK PP (EDIT) -->
                            <div class="form-example-int form-horizental" id="EditInputManualContainer">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="hrzn-fm"><b>Prioritas</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" id="EditPrioritasText" rows="3" style="color: #000;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-example-int" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-8">
                                        <button class="btn btn-success notika-btn-success" id="UpdatePrioritas"><b>UPDATE</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Select2 Customization */
    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single {
        height: 38px !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding-top: 4px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px !important;
        font-size: 13px !important;
        color: #1e293b !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    .select2-dropdown {
        border: 1.5px solid #94a3b8 !important;
        border-radius: 6px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        z-index: 999999999 !important;
        font-size: 13px !important;
    }
    .select2-search--dropdown .select2-search__field {
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
        padding: 5px 8px !important;
    }

    .form-control, .form-control option {
        color: #000 !important;
    }
    .modal-content {
        color: #000;
    }
    
    .badge-pn {
        background-color: #007bff;
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        display: inline-block;
        margin-right: 3px;
        font-weight: bold;
        min-width: 28px;
        text-align: center;
    }
    .badge-pp {
        background-color: #28a745;
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        display: inline-block;
        margin-right: 3px;
        font-weight: bold;
        min-width: 28px;
        text-align: center;
    }
    .badge-pd {
        background-color: #fd7e14;
        color: #fff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        display: inline-block;
        margin-right: 3px;
        font-weight: bold;
        min-width: 28px;
        text-align: center;
    }
    
    .dropdown-group {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #dee2e6;
        margin-bottom: 15px;
    }
    .dropdown-group label {
        font-weight: 600;
        color: #495057;
    }
    .dropdown-group .badge-reference {
        background-color: #17a2b8;
        color: #fff;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 10px;
        margin-left: 5px;
    }
    .tema-rkp-loading {
        display: none;
        color: #6c757d;
        font-size: 12px;
        margin-left: 10px;
    }
    .tema-rkp-loading.active {
        display: inline-block;
    }
    
    .text-danger {
        color: #dc3545 !important;
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
        .table-responsive {
            overflow-x: auto;
        }
    }
    .spinner-border-sm {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
        vertical-align: middle;
        margin-right: 5px;
    }
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    
    .table-bordered td, .table-bordered th {
        border: 1px solid #ddd !important;
    }
    
    .text-muted {
        color: #999 !important;
        font-size: 12px;
    }
    
    .prioritas-item {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 2px 0;
        border-bottom: 1px dashed #eee;
    }
    .prioritas-item:last-child {
        border-bottom: none;
    }
    
    .btn-xs {
        padding: 1px 4px;
        font-size: 9px;
        line-height: 1.2;
        border-radius: 3px;
    }
    .btn-xs .notika-icon {
        font-size: 9px;
    }
    
    .btn-default {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        color: #333;
    }
    .btn-default:hover {
        background-color: #e8e8e8;
    }
    
    .btn-warning {
        background-color: #f0ad4e;
        border-color: #eea236;
        color: #fff;
    }
    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #d58512;
        color: #fff;
    }
    
    .form-control-static {
        padding: 6px 12px;
        margin-bottom: 0;
        font-weight: bold;
        color: #333;
    }

    /* Styling Tabel Tema & Prioritas Pembangunan Sesuai Gambar */
    .table-tema-pembangunan {
        width: 100%;
        border-collapse: collapse !important;
        border: 1.5px solid #000 !important;
        background-color: #fff;
        margin-bottom: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .table-tema-pembangunan th,
    .table-tema-pembangunan td {
        border: 1px solid #000 !important;
        color: #000 !important;
    }
    .table-tema-pembangunan thead th {
        text-align: center;
        vertical-align: middle;
        font-size: 13.5px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 10px 14px;
        line-height: 1.35;
        background-color: #fff;
        color: #000 !important;
        letter-spacing: 0.2px;
    }
    .table-tema-pembangunan .row-tema-value td {
        text-align: center;
        vertical-align: middle;
        font-style: italic;
        font-size: 13px;
        line-height: 1.45;
        padding: 12px 16px;
        background-color: #fff;
        color: #000 !important;
    }
    .table-tema-pembangunan .row-separator td {
        height: 18px;
        padding: 0;
        background-color: #fff;
        border-top: 1px solid #000 !important;
        border-bottom: 1px solid #000 !important;
    }
    .table-tema-pembangunan .header-prioritas th {
        text-align: center;
        vertical-align: middle;
        font-size: 13.5px;
        font-weight: 700;
        padding: 8px 12px;
        background-color: #fff;
        color: #000 !important;
    }
    .table-tema-pembangunan .row-prioritas-data td {
        vertical-align: top;
        padding: 12px 14px;
        font-size: 13px;
        line-height: 1.5;
        background-color: #fff;
        color: #000 !important;
    }
    .table-tema-pembangunan .prioritas-bullet-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .table-tema-pembangunan .prioritas-bullet-item {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        margin-bottom: 8px;
        line-height: 1.45;
    }
    .table-tema-pembangunan .prioritas-bullet-item:last-child {
        margin-bottom: 0;
    }
    .table-tema-pembangunan .prioritas-bullet-item .bullet {
        font-size: 15px;
        line-height: 1.2;
        flex-shrink: 0;
        color: #000;
    }
    .table-tema-pembangunan .prioritas-bullet-item .item-text {
        flex: 1;
        color: #000;
    }
    .table-tema-pembangunan .item-actions-group,
    .table-tema-pembangunan .item-actions-hover {
        display: inline-flex;
        gap: 4px;
        opacity: 1 !important;
        margin-left: 6px;
        flex-shrink: 0;
        vertical-align: middle;
    }
    .table-tema-pembangunan .EditPrioritas {
        background-color: #f0ad4e !important;
        border: 1px solid #eea236 !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        opacity: 1 !important;
        border-radius: 3px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.12);
        transition: all 0.15s ease-in-out;
    }
    .table-tema-pembangunan .EditPrioritas:hover {
        background-color: #ec971f !important;
        border-color: #d58512 !important;
        color: #ffffff !important;
    }
    .table-tema-pembangunan .HapusPrioritas {
        background-color: #d9534f !important;
        border: 1px solid #d43f3a !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        opacity: 1 !important;
        border-radius: 3px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.12);
        transition: all 0.15s ease-in-out;
    }
    .table-tema-pembangunan .HapusPrioritas:hover {
        background-color: #c9302c !important;
        border-color: #ac2925 !important;
        color: #ffffff !important;
    }
    .table-tema-pembangunan .btn-add-inline {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        height: 28px;
        padding: 0 10px;
        font-size: 11px;
        font-weight: 600;
        color: #ffffff;
        background: #10b981;
        border: 1px solid #059669;
        border-radius: 4px;
        margin-top: 6px;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        transition: all 0.15s ease-in-out;
    }
    .table-tema-pembangunan .btn-add-inline:hover {
        background: #059669;
        color: #ffffff;
        border-color: #047857;
    }
</style>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

jQuery(document).ready(function($) {

    // ============================================================
    // FILTER WILAYAH
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
                data: { Kode: $(this).val(), [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $("#KabKota").prop('disabled', true); },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                            }
                        }
                        $("#KabKota").html(KabKota).prop('disabled', false);
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
            var $btn = $(this);
            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: { KodeWilayah: kodeWilayah, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                beforeSend: function() { $btn.prop('disabled', true).text('Memuat...'); },
                success: function(Respon) {
                    try {
                        if (Respon === '1' || Respon.trim() === '1' || Respon === 'success' || Respon.trim() === 'success') {
                            window.location.reload();
                        } else {
                            alert(Respon || "Gagal menyimpan filter wilayah!");
                            $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Filter');
                        }
                    } catch (e) {
                        alert("Gagal memproses respons server!");
                        $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Filter');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
                    $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Filter');
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
                data: { Kode: kodeProv, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
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
                        alert("Gagal memuat data Kab/Kota");
                    }
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                }
            });
        <?php } ?>
    <?php } ?>

    // ============================================================
    // FUNGSI UNTUK MEMUAT TEMA RKP BERDASARKAN TAHUN
    // ============================================================
    function loadTemaRKP(tahun, targetId, selectedId = null) {
        if (!tahun || tahun === '' || tahun.length !== 4) {
            $('#' + targetId).html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
            return;
        }
        
        var loadingId = (targetId === 'TemaNasionalId') ? '#tema-rkp-loading' : '#edit-tema-rkp-loading';
        $(loadingId).addClass('active');
        
        $.ajax({
            url: BaseURL + "Daerah/GetTemaRKPByTahun",
            type: "POST",
            data: { 
                tahun: tahun,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            success: function(Respon) {
                try {
                    var Data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    var options = '<option value="">-- Pilih Tema Nasional --</option>';
                    
                    if (Data.length > 0) {
                        for (var i = 0; i < Data.length; i++) {
                            var selected = (selectedId && parseInt(Data[i].Id) === parseInt(selectedId)) ? 'selected' : '';
                            options += '<option value="' + Data[i].Id + '" ' + selected + '>' + Data[i].TemaRKP + '</option>';
                        }
                    } else {
                        options = '<option value="">Tidak ada data Tema RKP untuk tahun ' + tahun + '</option>';
                    }
                    
                    $('#' + targetId).html(options);
                } catch(e) {
                    console.error('Error parsing Tema RKP:', e);
                    $('#' + targetId).html('<option value="">Error memuat data</option>');
                }
                $(loadingId).removeClass('active');
            },
            error: function(xhr) {
                console.error('Error loading Tema RKP:', xhr);
                $('#' + targetId).html('<option value="">Error memuat data</option>');
                $(loadingId).removeClass('active');
            }
        });
    }

    // ============================================================
    // EVENT LISTENER - AUTO REFRESH SAAT PILIH TAHUN TEMA RKP
    // ============================================================
    $('#TahunTemaRKP').on('change', function() {
        var tahun = $(this).val();
        if (tahun && tahun.length === 4) {
            // Reset dropdown Tema Nasional
            $('#TemaNasionalId').html('<option value="">Memuat data...</option>');
            loadTemaRKP(tahun, 'TemaNasionalId');
        } else {
            $('#TemaNasionalId').html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        }
    });

    // ============================================================
    // AUTO REFRESH SAAT PILIH TAHUN TEMA RKP
    // ============================================================
    $('#EditTahunTemaRKP').on('change', function() {
        var tahun = $(this).val();
        if (tahun && tahun.length === 4) {
            // Ambil selected ID yang tersimpan
            var selectedId = $('#EditTemaNasionalId').data('selected') || null;
            $('#EditTemaNasionalId').html('<option value="">Memuat data...</option>');
            loadTemaRKP(tahun, 'EditTemaNasionalId', selectedId);
        } else {
            $('#EditTemaNasionalId').html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        }
    });

    // ============================================================
    // FUNGSI UNTUK MEMUAT TEMA TAHAPAN RPJMD BERDASARKAN TAHUN
    // ============================================================
    function loadTemaTahapanRPJMD(tahun, targetId, selectedText, targetTextareaId) {
        if (!tahun || isNaN(tahun)) {
            $('#' + targetId).html('<option value="">-- Pilih Tahun Tahapan RPJMD Terlebih Dahulu --</option>');
            return;
        }
        
        var loadingId = (targetId === 'TemaDaerah') ? '#tema-daerah-loading' : '#edit-tema-daerah-loading';
        $(loadingId).addClass('active');
        
        $.ajax({
            url: BaseURL + "Daerah/GetTemaTahapanRPJMDByTahun",
            type: "POST",
            data: { 
                tahun: tahun,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            success: function(Respon) {
                try {
                    var Data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    var options = '<option value="">-- Pilih Tema Daerah (Tahapan RPJMD) --</option>';
                    var matched = false;
                    
                    if (Data && Data.length > 0) {
                        for (var i = 0; i < Data.length; i++) {
                            var temaText = Data[i].Tema.trim();
                            var isSelected = (selectedText && temaText === selectedText.trim());
                            if (isSelected) matched = true;
                            var selAttr = isSelected ? 'selected' : '';
                            options += '<option value="' + temaText.replace(/"/g, '&quot;') + '" ' + selAttr + '>' + temaText + '</option>';
                        }
                    }
                    
                    // Jika ada data tersimpan sebelumnya namun tidak ada di list RPJMD, tetap pertahankan sebagai pilihan
                    if (selectedText && selectedText.trim() !== '' && !matched) {
                        options += '<option value="' + selectedText.trim().replace(/"/g, '&quot;') + '" selected>' + selectedText.trim() + '</option>';
                    }
                    
                    if (!Data || Data.length === 0) {
                        if (!selectedText) {
                            options = '<option value="">Tidak ada data Tahapan RPJMD untuk tahun ' + tahun + '</option>';
                        }
                    }
                    
                    $('#' + targetId).html(options);

                    // Jika hanya ada 1 pilihan tema dan belum ada nilai terpilih, otomatis pilih
                    if (!selectedText && Data && Data.length === 1) {
                        $('#' + targetId).val(Data[0].Tema.trim());
                    }
                } catch(e) {
                    console.error('Error parsing Tema Tahapan RPJMD:', e);
                    $('#' + targetId).html('<option value="">Error memuat data</option>');
                }
                $(loadingId).removeClass('active');
            },
            error: function(xhr) {
                console.error('Error loading Tema Tahapan RPJMD:', xhr);
                $('#' + targetId).html('<option value="">Error memuat data</option>');
                $(loadingId).removeClass('active');
            }
        });
    }

    // Event listener saat memilih tahun tahapan RPJMD (Modal Tambah)
    $('#TahunTahapanRPJMD').on('change', function() {
        var tahun = $(this).val();
        if (tahun) {
            $('#TemaDaerah').html('<option value="">Memuat data...</option>');
            loadTemaTahapanRPJMD(tahun, 'TemaDaerah');
        } else {
            $('#TemaDaerah').html('<option value="">-- Pilih Tahun Tahapan RPJMD Terlebih Dahulu --</option>');
        }
    });

    // Event listener saat memilih tahun tahapan RPJMD (Modal Edit)
    $('#EditTahunTahapanRPJMD').on('change', function() {
        var tahun = $(this).val();
        if (tahun) {
            var selectedText = $('#EditTemaDaerah').val() || $('#EditTemaDaerah').data('selected');
            $('#EditTemaDaerah').html('<option value="">Memuat data...</option>');
            loadTemaTahapanRPJMD(tahun, 'EditTemaDaerah', selectedText);
        } else {
            $('#EditTemaDaerah').html('<option value="">-- Pilih Tahun Tahapan RPJMD Terlebih Dahulu --</option>');
        }
    });

    // Auto sinkronisasi dropdown saat input Tahun diketik
    $('#Tahun').on('input change', function() {
        var inputTahun = $(this).val().trim();
        if (inputTahun && inputTahun.length === 4) {
            if ($('#TahunTemaRKP option[value="' + inputTahun + '"]').length > 0) {
                $('#TahunTemaRKP').val(inputTahun).trigger('change');
            }
            if ($('#TahunTahapanRPJMD option[value="' + inputTahun + '"]').length > 0) {
                $('#TahunTahapanRPJMD').val(inputTahun).trigger('change');
            }
        }
    });

    // ============================================================
    // INPUT TEMA
    // ============================================================
    $("#InputTema").click(function() {
    var tahun = $("#Tahun").val().trim();
    
    if (tahun === "" || tahun.length !== 4 || isNaN(tahun)) {
        alert('Tahun harus diisi dengan 4 digit angka (contoh: 2026)!');
        return;
    }
    
    if ($("#TemaNasionalId").val() === "" || $("#TemaNasionalId").val() === null) {
        alert('Tema Nasional harus dipilih!');
        return;
    }
    
    var temaNasionalText = $("#TemaNasionalId option:selected").text();
    var temaRKPId = $("#TemaNasionalId").val();
    
    var Data = {
        Tahun: tahun,
        TemaRKPId: temaRKPId,
        TemaNasionalText: temaNasionalText,
        TemaProvinsi: ($("#TemaProvinsi").val() || '').trim(),
        TemaDaerah: ($("#TemaDaerah").val() || '').trim(),
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/InputTemaPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#InputTema").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
        }
    });
});

    // ============================================================
    // TARIK TEMA DARI PROVINSI (MODAL INPUT)
    // ============================================================
    $("#BtnTarikTemaProvinsiInput").click(function() {
        var tahun = $("#Tahun").val();
        if (!tahun) {
            alert("Silakan masukkan Tahun terlebih dahulu!");
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menarik...');

        $.ajax({
            url: BaseURL + "Daerah/TarikTemaProvinsi",
            type: "POST",
            data: {
                Tahun: tahun,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    $("#TemaProvinsi").val(res.tema_provinsi);
                    alert("Berhasil menarik Tema Provinsi dari " + res.nama_provinsi + "!");
                } else {
                    alert(res.message || "Data tidak ditemukan!");
                }
            },
            error: function(xhr) {
                alert("Gagal menghubungi server: " + xhr.statusText);
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fa fa-cloud-download"></i> Tarik dari Provinsi');
            }
        });
    });

    // ============================================================
    // TARIK TEMA DARI PROVINSI (MODAL EDIT)
    // ============================================================
    $("#BtnTarikTemaProvinsiEdit").click(function() {
        var tahun = $("#EditTahun").val();
        if (!tahun) {
            alert("Silakan masukkan Tahun terlebih dahulu!");
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menarik...');

        $.ajax({
            url: BaseURL + "Daerah/TarikTemaProvinsi",
            type: "POST",
            data: {
                Tahun: tahun,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    $("#EditTemaProvinsi").val(res.tema_provinsi);
                    alert("Berhasil menarik Tema Provinsi dari " + res.nama_provinsi + "!");
                } else {
                    alert(res.message || "Data tidak ditemukan!");
                }
            },
            error: function(xhr) {
                alert("Gagal menghubungi server: " + xhr.statusText);
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fa fa-cloud-download"></i> Tarik dari Provinsi');
            }
        });
    });

    // ============================================================
    // TARIK PRIORITAS PROVINSI (PP) DARI TABEL DAERAH
    // ============================================================
    $(document).on("click", ".TarikPrioritasProvinsiBtn", function() {
        var temaId = $(this).data('tema_id');
        var tahun = $(this).data('tahun');

        if (!confirm("Tarik dan sinkronkan Prioritas Provinsi untuk tahun " + tahun + " dari akun Provinsi ke daerah ini?")) {
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menarik...');

        $.ajax({
            url: BaseURL + "Daerah/TarikPrioritasProvinsi",
            type: "POST",
            data: {
                tema_id: temaId,
                tahun: tahun,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
                } else {
                    alert(res.message || "Gagal menarik data prioritas provinsi!");
                    btn.prop('disabled', false).html('<i class="fa fa-cloud-download"></i> Tarik PP Provinsi');
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                btn.prop('disabled', false).html('<i class="fa fa-cloud-download"></i> Tarik PP Provinsi');
            }
        });
    });

    // ============================================================
// EDIT TEMA - Tampilkan data yang sudah tersimpan
// ============================================================
$(document).on("click", ".EditTema", function() {
    var id = $(this).data('id');
    var tahun = $(this).data('tahun');
    var temaRKPId = $(this).data('tema_rkp_id') || '';
    var temaNasional = $(this).data('tema_nasional');
    var temaProvinsi = $(this).data('tema_provinsi');
    var temaDaerah = $(this).data('tema_daerah');
    
    // Isi field
    $("#EditId").val(id);
    $("#EditTahun").val(tahun);
    $("#EditTemaProvinsi").val(temaProvinsi);
    $("#EditTemaDaerah").val(temaDaerah);
    
    // =============================================
    // SET DROPDOWN TEMA NASIONAL
    // =============================================
    if (temaRKPId) {
        // 1. Cari tahun dari tema_rkp_id
        $.ajax({
            url: BaseURL + "Daerah/GetTemaRKPById",
            type: "POST",
            data: { 
                id: temaRKPId,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.Tahun) {
                    // Set dropdown tahun
                    $('#EditTahunTemaRKP').val(response.Tahun);
                    
                    // Load data Tema RKP berdasarkan tahun
                    loadTemaRKP(response.Tahun, 'EditTemaNasionalId', temaRKPId);
                } else {
                    // Fallback: coba load semua tema
                    $('#EditTemaNasionalId').html('<option value="">-- Pilih Tema Nasional --</option>');
                }
            },
            error: function() {
                // Jika gagal, tampilkan teks tema sebagai info
                $('#EditTemaNasionalId').html('<option value="">-- Error memuat data --</option>');
                alert('Gagal memuat data Tema Nasional. Silakan pilih manual.');
            }
        });
    } else {
        // Tidak ada tema_rkp_id, reset dropdown
        $('#EditTahunTemaRKP').val('');
        $('#EditTemaNasionalId').html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
    }
    
    // =============================================
    // SET DROPDOWN TEMA DAERAH (TAHAPAN RPJMD)
    // =============================================
    if (tahun) {
        $('#EditTemaDaerah').data('selected', temaDaerah);
        $('#EditTahunTahapanRPJMD').val(tahun);
        loadTemaTahapanRPJMD(tahun, 'EditTemaDaerah', temaDaerah);
    } else {
        $('#EditTahunTahapanRPJMD').val('');
        $('#EditTemaDaerah').html('<option value="">-- Pilih Tahun Tahapan RPJMD Terlebih Dahulu --</option>');
    }
    
    $('#ModalEditTema').modal("show");
});

// ============================================================
// FUNGSI LOAD TEMA RKP
// ============================================================
function loadTemaRKP(tahun, targetId, selectedId = null) {
    if (!tahun || tahun === '' || tahun.length !== 4) {
        $('#' + targetId).html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        return;
    }
    
    var loadingId = (targetId === 'TemaNasionalId') ? '#tema-rkp-loading' : '#edit-tema-rkp-loading';
    $(loadingId).addClass('active');
    
    $.ajax({
        url: BaseURL + "Daerah/GetTemaRKPByTahun",
        type: "POST",
        data: { 
            tahun: tahun,
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
        },
        dataType: 'json',
        success: function(Data) {
            var options = '<option value="">-- Pilih Tema Nasional --</option>';
            
            if (Data && Data.length > 0) {
                for (var i = 0; i < Data.length; i++) {
                    var selected = (selectedId && parseInt(Data[i].Id) === parseInt(selectedId)) ? 'selected' : '';
                    options += '<option value="' + Data[i].Id + '" ' + selected + '>' + Data[i].TemaRKP + '</option>';
                }
            } else {
                options = '<option value="">Tidak ada data Tema RKP untuk tahun ' + tahun + '</option>';
            }
            
            $('#' + targetId).html(options);
            $(loadingId).removeClass('active');
        },
        error: function(xhr) {
            console.error('Error loading Tema RKP:', xhr);
            $('#' + targetId).html('<option value="">Error memuat data</option>');
            $(loadingId).removeClass('active');
        }
    });
}

// ============================================================
// UPDATE TEMA - Pastikan mengirim TemaRKPId
// ============================================================
$("#UpdateTema").click(function() {
    var tahun = $("#EditTahun").val().trim();
    
    if (tahun === "" || tahun.length !== 4 || isNaN(tahun)) {
        alert('Tahun harus diisi dengan 4 digit angka (contoh: 2026)!');
        return;
    }
    
    var temaRKPId = $("#EditTemaNasionalId").val();
    if (!temaRKPId || temaRKPId === "") {
        alert('Tema Nasional harus dipilih!');
        return;
    }
    
    var temaNasionalText = $("#EditTemaNasionalId option:selected").text();
    
    var Data = {
        Id: $("#EditId").val(),
        Tahun: tahun,
        TemaRKPId: temaRKPId,
        TemaNasionalText: temaNasionalText,
        TemaProvinsi: ($("#EditTemaProvinsi").val() || '').trim(),
        TemaDaerah: ($("#EditTemaDaerah").val() || '').trim(),
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/UpdateTemaPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#UpdateTema").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditTema').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
        }
    });
});

    // ============================================================
    // GET TEMA RKP BY ID (untuk edit)
    // ============================================================
    $.ajax({
        url: BaseURL + "Daerah/GetTemaRKPById",
        type: "POST",
        data: { 
            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
        },
        // Method ini akan dipanggil dari fungsi di atas
    });

    // ============================================================
    // FILTER TAHUN TEMA (NAVIGASI DINAMIS & SERVER-SIDE FILTER)
    // ============================================================
    $('#FilterTahunTema').on('change', function() {
        var tahun = $(this).val();
        var url = new URL(window.location.href);
        if (tahun) {
            url.searchParams.set('tahun', tahun);
        } else {
            url.searchParams.delete('tahun');
        }
        window.location.href = url.toString();
    });

    // ============================================================
    // HELPER LOAD PROGRAM PRIORITAS CASCADING RKPD
    // ============================================================
    function loadCascadingProgramPrioritas(selectElement, targetTahun, selectedValue) {
        var $el = $(selectElement);
        $el.empty().append('<option value="">-- Sedang memuat Program Prioritas... --</option>');
        
        $.ajax({
            url: BaseURL + "Daerah/GetProgramPrioritasFromCascading",
            type: "POST",
            dataType: "json",
            data: {
                Tahun: targetTahun,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            },
            success: function(list) {
                $el.empty().append('<option value="">-- Pilih Program Prioritas (Dari Cascading RKPD) --</option>');
                var found = false;
                if (list && list.length > 0) {
                    list.forEach(function(item) {
                        var pp = (item.ProgramPrioritas || '').trim();
                        if (pp) {
                            var isSelected = (selectedValue && pp === selectedValue) ? true : false;
                            if (isSelected) found = true;
                            $el.append($('<option>', {
                                value: pp,
                                text: pp,
                                selected: isSelected
                            }));
                        }
                    });
                } else {
                    $el.append('<option value="" disabled>-- Tidak ada Program Prioritas di Cascading RKPD tahun ' + (targetTahun || '') + ' --</option>');
                }
                
                if (selectedValue && !found) {
                    $el.append($('<option>', {
                        value: selectedValue,
                        text: selectedValue + ' (Tersimpan sebelumnya)',
                        selected: true
                    }));
                }
                $el.trigger('change');
            },
            error: function() {
                $el.empty().append('<option value="">-- Gagal memuat data --</option>');
            }
        });
    }

    // Inisialisasi Select2 untuk Modal Prioritas
    $('#InputProgramPrioritasCascadingId').select2({
        dropdownParent: $('#ModalInputPrioritasKolom'),
        width: '100%',
        placeholder: '-- Pilih Program Prioritas (Dari Cascading RKPD) --',
        allowClear: true
    });

    $('#EditProgramPrioritasCascadingId').select2({
        dropdownParent: $('#ModalEditPrioritas'),
        width: '100%',
        placeholder: '-- Pilih Program Prioritas (Dari Cascading RKPD) --',
        allowClear: true
    });

    // ============================================================
    // TAMBAH PRIORITAS DARI KOLOM
    // ============================================================
    $(document).on("click", ".tambah-prioritas-kolom", function(e) {
        e.preventDefault();
        var temaId = $(this).data('tema_id');
        var tahun = $(this).data('tahun') || '';
        var temaNasional = $(this).data('tema_nasional');
        var jenis = $(this).data('jenis');
        var label = $(this).data('label');
        var idPn = $(this).data('id_pn') || '';
        var pnText = $(this).data('pn_text') || '';
        
        var labelJenis = '';
        if (jenis === 'nasional') labelJenis = 'PN - Prioritas Nasional';
        else if (jenis === 'provinsi') labelJenis = 'PP - Prioritas Provinsi';
        else if (jenis === 'daerah') labelJenis = 'PD - Prioritas Daerah';
        
        $("#InputPrioritasTemaIdKolom").val(temaId);
        $("#InputPrioritasTahunKolom").val(tahun);
        $("#InputPrioritasJenisKolom").val(jenis);
        $("#InputPrioritasLabelKolom").val(label);
        $("#InputPrioritasIdPN").val(idPn);
        $("#LabelTemaPrioritasKolom").text(temaNasional);
        $("#TemaInfoKolom").text(temaNasional);
        $("#JenisInfoKolom").text(labelJenis);
        $("#InputPrioritasKolom").val('');
        $("#InputPrioritasRPJMNId").val('');
        $("#InputProgramPrioritasCascadingId").val('').trigger('change');
        
        if (idPn && pnText) {
            $("#PnInfoKolom").text(pnText);
            $("#PnInfoContainer").show();
        } else {
            $("#PnInfoKolom").text('');
            $("#PnInfoContainer").hide();
        }
        
        if (jenis === 'nasional') {
            $('#DropdownRPJMNContainer').show();
            $('#DropdownCascadingPDContainer').hide();
            $('#InputManualContainer').hide();
        } else if (jenis === 'daerah') {
            $('#DropdownRPJMNContainer').hide();
            $('#DropdownCascadingPDContainer').show();
            $('#InputManualContainer').hide();
            loadCascadingProgramPrioritas('#InputProgramPrioritasCascadingId', tahun, '');
        } else {
            $('#DropdownRPJMNContainer').hide();
            $('#DropdownCascadingPDContainer').hide();
            $('#InputManualContainer').show();
        }
        
        $('#ModalInputPrioritasKolom').modal("show");
    });

    // ============================================================
    // SIMPAN PRIORITAS DARI KOLOM
    // ============================================================
    $("#SimpanPrioritasKolom").click(function() {
    var temaId = $("#InputPrioritasTemaIdKolom").val();
    var jenis = $("#InputPrioritasJenisKolom").val();
    var idPn = $("#InputPrioritasIdPN").val() || '';
    var prioritas = '';
    var rpjmnId = '';
    var rpjmnText = '';
    
    if (jenis === 'nasional') {
        rpjmnId = $("#InputPrioritasRPJMNId").val();
        if (!rpjmnId || rpjmnId === "") {
            alert('Pilih Prioritas Nasional RPJMN!');
            return;
        }
        prioritas = $("#InputPrioritasRPJMNId option:selected").text();
        rpjmnText = prioritas;
    } else if (jenis === 'daerah') {
        prioritas = ($("#InputProgramPrioritasCascadingId").val() || '').trim();
        if (prioritas === "") {
            alert('Pilih Program Prioritas dari Cascading Permasalahan RKPD!');
            return;
        }
    } else {
        prioritas = $("#InputPrioritasKolom").val().trim();
        if (prioritas === "") {
            alert('Prioritas harus diisi!');
            return;
        }
    }
    
    if (!temaId || temaId === "") {
        alert('Data tidak valid!');
        return;
    }
    if (!jenis || jenis === "") {
        alert('Jenis prioritas tidak valid!');
        return;
    }
    
    var Data = {
        TemaId: temaId,
        Jenis: jenis,
        Prioritas: prioritas,
        IdPN: idPn,
        PrioritasNasionalId: rpjmnId || '',
        PrioritasNasionalText: rpjmnText || '',
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/InputPrioritasPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#SimpanPrioritasKolom").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputPrioritasKolom').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalInputPrioritasKolom').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
        }
    });
});

    // ============================================================
    // EDIT PRIORITAS
    // ============================================================
    $(document).on("click", ".EditPrioritas", function(e) {
        e.stopPropagation();
        var id = $(this).data('id');
        var temaId = $(this).data('tema_id');
        var tahun = $(this).data('tahun') || '';
        var prioritas = $(this).data('prioritas');
        var jenis = $(this).data('jenis');
        var label = $(this).data('label') || '';
        
        var labelJenis = '';
        if (jenis === 'nasional') labelJenis = 'PN - Prioritas Nasional';
        else if (jenis === 'provinsi') labelJenis = 'PP - Prioritas Provinsi';
        else if (jenis === 'daerah') labelJenis = 'PD - Prioritas Daerah';
        
        var temaNasional = '';
        <?php foreach ($TemaPembangunan as $tema) { ?>
            if (temaId == <?= $tema['id'] ?>) {
                temaNasional = '<?= html_escape($tema['tema_nasional']) ?>';
            }
        <?php } ?>
        
        $("#EditPrioritasId").val(id);
        $("#EditPrioritasTemaId").val(temaId);
        $("#EditPrioritasTahunHidden").val(tahun);
        $("#EditPrioritasJenisHidden").val(jenis);
        $("#EditPrioritasLabelHidden").val(label);
        $("#EditPrioritasText").val(prioritas);
        $("#EditTemaInfo").text(temaNasional);
        $("#EditJenisInfo").text(labelJenis);
        
        if (jenis === 'nasional') {
            $('#EditDropdownRPJMNContainer').show();
            $('#EditDropdownCascadingPDContainer').hide();
            $('#EditInputManualContainer').hide();
            var foundId = '';
            <?php foreach ($PrioritasNasionalRPJMN as $p) { ?>
                if ('<?= html_escape($p['PrioritasNasional']) ?>' === prioritas) {
                    foundId = '<?= $p['Id'] ?>';
                }
            <?php } ?>
            $('#EditPrioritasRPJMNId').val(foundId);
        } else if (jenis === 'daerah') {
            $('#EditDropdownRPJMNContainer').hide();
            $('#EditDropdownCascadingPDContainer').show();
            $('#EditInputManualContainer').hide();
            loadCascadingProgramPrioritas('#EditProgramPrioritasCascadingId', tahun, prioritas);
        } else {
            $('#EditDropdownRPJMNContainer').hide();
            $('#EditDropdownCascadingPDContainer').hide();
            $('#EditInputManualContainer').show();
        }
        
        $('#ModalEditPrioritas').modal("show");
    });

    $("#UpdatePrioritas").click(function() {
    var id = $("#EditPrioritasId").val();
    var jenis = $("#EditPrioritasJenisHidden").val();
    var prioritas = '';
    var rpjmnId = '';
    var rpjmnText = '';
    
    if (jenis === 'nasional') {
        rpjmnId = $("#EditPrioritasRPJMNId").val();
        if (!rpjmnId || rpjmnId === "") {
            alert('Pilih Prioritas Nasional RPJMN!');
            return;
        }
        prioritas = $("#EditPrioritasRPJMNId option:selected").text();
        rpjmnText = prioritas;
    } else if (jenis === 'daerah') {
        prioritas = ($("#EditProgramPrioritasCascadingId").val() || '').trim();
        if (prioritas === "") {
            alert('Pilih Program Prioritas dari Cascading Permasalahan RKPD!');
            return;
        }
    } else {
        prioritas = $("#EditPrioritasText").val().trim();
        if (prioritas === "") {
            alert('Prioritas harus diisi!');
            return;
        }
    }
    
    if (!id || id === "") {
        alert('Data tidak valid!');
        return;
    }
    if (!jenis || jenis === "") {
        alert('Jenis prioritas tidak valid!');
        return;
    }
    
    var Data = {
        Id: id,
        Jenis: jenis,
        Prioritas: prioritas,
        PrioritasNasionalId: rpjmnId || '',
        PrioritasNasionalText: rpjmnText || '',
        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
    };
    
    $.ajax({
        url: BaseURL + "Daerah/UpdatePrioritasPembangunan",
        type: "POST",
        data: Data,
        beforeSend: function() {
            $("#UpdatePrioritas").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
        },
        success: function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                if (result.status === 'success') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditPrioritas').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + result.message);
                    $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
                }
            } catch(e) {
                if (Respon === '1' || Respon.trim() === '1') {
                    // LANGSUNG REFRESH - TANPA ALERT
                    $('#ModalEditPrioritas').modal('hide');
                    location.reload();
                } else {
                    alert('✗ ' + Respon);
                    $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
                }
            }
        },
        error: function(xhr) {
            alert("Terjadi kesalahan: " + xhr.statusText);
            $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
        }
    });
});

    // ============================================================
    // HAPUS PRIORITAS
    // ============================================================
    $(document).on("click", ".HapusPrioritas", function(e) {
    e.stopPropagation();
    if (confirm("Apakah Anda yakin ingin menghapus prioritas ini?")) {
        var id = $(this).data('id');
        var btn = $(this);
        
        $.ajax({
            url: BaseURL + "Daerah/DeletePrioritasPembangunan",
            type: "POST",
            data: { 
                Id: id,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            beforeSend: function() {
                btn.prop('disabled', true).html('<span class="spinner-border-sm"></span>');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        // LANGSUNG REFRESH - TANPA ALERT
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-close"></i>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        // LANGSUNG REFRESH - TANPA ALERT
                        location.reload();
                    } else {
                        alert('✗ ' + Respon);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-close"></i>');
                    }
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                btn.prop('disabled', false).html('<i class="notika-icon notika-close"></i>');
            }
        });
    }
});


    // ============================================================
    // HAPUS TEMA
    // ============================================================
    $(document).on("click", ".HapusTema", function() {
    if (confirm("Apakah Anda yakin ingin menghapus tema ini beserta semua prioritasnya?")) {
        var id = $(this).data('id');
        var btn = $(this);
        
        $.ajax({
            url: BaseURL + "Daerah/DeleteTemaPembangunan",
            type: "POST",
            data: { 
                Id: id,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
            },
            beforeSend: function() {
                btn.prop('disabled', true).html('<span class="spinner-border-sm"></span>');
            },
            success: function(Respon) {
                try {
                    var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (result.status === 'success') {
                        // LANGSUNG REFRESH - TANPA ALERT
                        location.reload();
                    } else {
                        alert('✗ ' + result.message);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                    }
                } catch(e) {
                    if (Respon === '1' || Respon.trim() === '1') {
                        // LANGSUNG REFRESH - TANPA ALERT
                        location.reload();
                    } else {
                        alert('✗ ' + Respon);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                    }
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
            }
        });
    }
});

    // ============================================================
    // RESET FORM SAAT MODAL DITUTUP
    // ============================================================
    $('#ModalInputTema').on('hidden.bs.modal', function() {
        $("#Tahun").val('');
        $("#TahunTemaRKP").val('');
        $("#TemaNasionalId").html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        $("#TahunTahapanRPJMD").val('');
        $("#TemaDaerah").html('<option value="">-- Pilih Tahun Tahapan Terlebih Dahulu --</option>');
        $("#TemaProvinsi").val('');
        $("#InputTema").prop('disabled', false).html('<b>SIMPAN</b>');
        $('#tema-rkp-loading').removeClass('active');
        $('#tema-daerah-loading').removeClass('active');
    });

    $('#ModalEditTema').on('hidden.bs.modal', function() {
        $("#EditId").val('');
        $("#EditTahun").val('');
        $("#EditTahunTemaRKP").val('');
        $("#EditTemaNasionalId").html('<option value="">-- Pilih Tahun Tema RKP Terlebih Dahulu --</option>');
        $("#EditTemaNasionalId").data('selected', '');
        $("#EditTahunTahapanRPJMD").val('');
        $("#EditTemaDaerah").html('<option value="">-- Pilih Tahun Tahapan Terlebih Dahulu --</option>');
        $("#EditTemaDaerah").data('selected', '');
        $("#EditTemaProvinsi").val('');
        $("#UpdateTema").prop('disabled', false).html('<b>UPDATE</b>');
        $('#edit-tema-rkp-loading').removeClass('active');
        $('#edit-tema-daerah-loading').removeClass('active');
    });

    $('#ModalInputPrioritasKolom').on('hidden.bs.modal', function() {
        $("#InputPrioritasTemaIdKolom").val('');
        $("#InputPrioritasTahunKolom").val('');
        $("#InputPrioritasJenisKolom").val('');
        $("#InputPrioritasLabelKolom").val('');
        $("#InputPrioritasIdPN").val('');
        $("#InputPrioritasKolom").val('');
        $("#InputPrioritasRPJMNId").val('');
        $("#InputProgramPrioritasCascadingId").val('').trigger('change');
        $("#LabelTemaPrioritasKolom").text('');
        $("#TemaInfoKolom").text('');
        $("#JenisInfoKolom").text('');
        $("#PnInfoKolom").text('');
        $("#PnInfoContainer").hide();
        $('#DropdownRPJMNContainer').hide();
        $('#DropdownCascadingPDContainer').hide();
        $('#InputManualContainer').show();
        $("#SimpanPrioritasKolom").prop('disabled', false).html('<b>SIMPAN</b>');
    });

    $('#ModalEditPrioritas').on('hidden.bs.modal', function() {
        $("#EditPrioritasId").val('');
        $("#EditPrioritasTemaId").val('');
        $("#EditPrioritasTahunHidden").val('');
        $("#EditPrioritasJenisHidden").val('');
        $("#EditPrioritasLabelHidden").val('');
        $("#EditPrioritasText").val('');
        $("#EditPrioritasRPJMNId").val('');
        $("#EditProgramPrioritasCascadingId").val('').trigger('change');
        $("#EditTemaInfo").text('');
        $("#EditJenisInfo").text('');
        $('#EditDropdownRPJMNContainer').hide();
        $('#EditDropdownCascadingPDContainer').hide();
        $('#EditInputManualContainer').show();
        $("#UpdatePrioritas").prop('disabled', false).html('<b>UPDATE</b>');
    });

    // ============================================================
    // CLEAN MODAL BACKDROP
    // ============================================================
    $(document).on("hidden.bs.modal", ".modal", function() {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    });

});
</script>