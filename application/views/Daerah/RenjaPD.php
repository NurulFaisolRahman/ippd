<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    .table-renja th, .table-renja td { 
        vertical-align: middle; 
        text-align: center; 
        border: 1px solid #dee2e6; 
        padding: 8px; 
        font-size: 12px;
    }
    .table-renja th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    .uraian { 
        text-align: left !important; 
        padding-left: 15px !important; 
        white-space: pre-wrap; 
        word-break: break-word; 
    }
    .rp { white-space: nowrap; font-weight: 500; }
    .btn-aksi { padding: 5px 8px; font-size: 0.8rem; margin: 0 2px; }
    .filter-row .form-control { height: 38px; }
    .btn-group-aksi { display: flex; justify-content: center; gap: 5px; }
    
    .nomenklatur-container {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background: #f9f9f9;
    }
    .nomenklatur-container .panel-heading {
        background: #e7f3ff;
        padding: 10px;
        margin: -15px -15px 15px -15px;
        border-radius: 8px 8px 0 0;
        border-bottom: 1px solid #d1e7ff;
    }
    .nav-tabs { margin-bottom: 20px; }
    .nav-tabs > li > a { font-weight: 500; }
    
    .info-nomenklatur {
        background: #d1ecf1;
        color: #0c5460;
        padding: 8px 12px;
        border-radius: 4px;
        margin-top: 10px;
        font-size: 12px;
    }
    .cascading-select { margin-bottom: 15px; }
    .cascading-select label { font-weight: 600; margin-bottom: 5px; }
    
    .breadcrumb-nomenklatur {
        background: #e9ecef;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    .breadcrumb-nomenklatur .badge { background: #007bff; margin-right: 5px; }
    
    .info-card {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .info-card .card-title {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 10px;
        padding-bottom: 8px;
        border-bottom: 2px solid #0275d8;
        color: #0275d8;
    }
    .info-card .card-title i { margin-right: 5px; }
    
    .dataTables_wrapper { overflow-x: auto; }
    .modal-open .modal { overflow-y: auto !important; }
    .modal-open { overflow: auto !important; padding-right: 0 !important; }
    .modal { overflow-y: auto !important; }
    .modal-body { max-height: calc(100vh - 200px); overflow-y: auto; }
    
    .kode-rekening-preview {
        font-family: monospace;
        font-size: 14px;
        font-weight: bold;
        color: #0056b3;
    }
    .required:after { content: " *"; color: red; }
    
    /* Alert floating untuk notifikasi filter */
    .filter-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideInRight 0.3s ease-out;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH SEBELUM LOGIN -->
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
                                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
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
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter"><b>Filter</b></button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($KodeWilayah)) { 
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

                        <!-- FILTER INSTANSI UNTUK NON ROLE 4 (SUDAH LOGIN) -->
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
                                                            <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>><?= html_escape($ins['nama']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn"><b>Tampilkan</b></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn"><b>Reset</b></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- INFO INSTANSI UNTUK ROLE 4 -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                                <br><small>Anda hanya dapat melihat dan mengelola data milik instansi Anda sendiri.</small>
                            </div>
                        <?php } ?>

                        <!-- HEADER TAHUN -->
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <h4><b>RENCANA KERJA (RENJA) PERANGKAT DAERAH</b></h4>
                                    <p>Tahun Anggaran: 
                                        <select id="filterTahun" class="form-control" style="width: 100px; display: inline-block; margin-left: 10px;">
                                            <?php for ($th = 2024; $th <= 2030; $th++): ?>
                                                <option value="<?= $th ?>" <?= ($TahunAktif == $th) ? 'selected' : '' ?>><?= $th ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <button class="btn btn-primary btn-sm" id="btnFilterTahun"><i class="fa fa-search"></i> Tampilkan</button>
                                    </p>
                                </div>
                                <?php if ($IsRole4) { ?>
                                <div class="pull-right">
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalInputRenja"><i class="fa fa-plus"></i> Tambah Data</button>
                                </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <!-- TABEL RENJA -->
                        <div class="table-responsive">
                            <table id="table-renja" class="table table-striped table-bordered table-renja" style="width: 100%; min-width: 2800px;">
                                <thead>
                                    <tr><th>Kode Rekening</th><th style="min-width: 300px;">URUSAN / BIDANG URUSAN / PROGRAM / KEGIATAN / SUB KEGIATAN</th>
                                    <th style="min-width: 200px;">Indikator Kinerja</th><th>Satuan</th><th>Lokasi</th><th>Prioritas Daerah</th><th>Prioritas Nasional</th>
                                    <th>Ranwal Kinerja</th><th>Ranwal Rp</th><th>Rancangan Kinerja</th><th>Rancangan Rp</th><th>Ranhir Kinerja</th><th>Ranhir Rp</th>
                                    <th>Renja Kinerja</th><th>Renja Rp</th><th>DPA Murni Kinerja</th><th>DPA Murni Rp</th><th>Sumber Dana</th><th>DPA Perubahan Kinerja</th>
                                    <th>DPA Perubahan Rp</th><th style="min-width: 200px;">Bidang & Pengampu</th><?php if ($IsRole4) { ?><th>Aksi</th><?php } ?></tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($RenjaData)) { ?>
                                        <?php foreach ($RenjaData as $row) { ?>
                                            <tr>
                                                <td class="text-center"><?= html_escape($row['kode_rekening'] ?? '-') ?></td>
                                                <td class="text-left">
                                                    <?php 
                                                    $items = [];
                                                    if (!empty($row['tujuan'])) $items[] = '<strong>Urusan:</strong> ' . html_escape($row['tujuan']);
                                                    if (!empty($row['sasaran'])) $items[] = '<strong>Bidang Urusan:</strong> ' . html_escape($row['sasaran']);
                                                    if (!empty($row['program'])) $items[] = '<strong>Program:</strong> ' . html_escape($row['program']);
                                                    if (!empty($row['kegiatan'])) $items[] = '<strong>Kegiatan:</strong> ' . html_escape($row['kegiatan']);
                                                    if (!empty($row['sub_kegiatan'])) $items[] = '<strong>Sub Kegiatan:</strong> ' . html_escape($row['sub_kegiatan']);
                                                    echo implode('<br>', $items);
                                                    ?>
                                                </td>
                                                <td class="text-left"><?= nl2br(html_escape($row['indikator_kinerja'] ?? '-')) ?></td>
                                                <td class="text-center"><?= html_escape($row['satuan'] ?? '-') ?></td>
                                                <td class="text-center"><?= html_escape($row['lokasi'] ?? '-') ?></td>
                                                <td class="text-center"><?= html_escape($row['prioritas_daerah'] ?? '-') ?></td>
                                                <td class="text-center"><?= html_escape($row['prioritas_nasional'] ?? '-') ?></td>
                                                <td class="text-center"><?= html_escape($row['ranwal_kinerja'] ?? '-') ?></td>
                                                <td class="text-right rp"><?= ($row['ranwal_rp'] ?? 0) ? 'Rp ' . number_format($row['ranwal_rp'], 0, ',', '.') : '-' ?></td>
                                                <td class="text-center"><?= html_escape($row['rancangan_kinerja'] ?? '-') ?></td>
                                                <td class="text-right rp"><?= ($row['rancangan_rp'] ?? 0) ? 'Rp ' . number_format($row['rancangan_rp'], 0, ',', '.') : '-' ?></td>
                                                <td class="text-center"><?= html_escape($row['ranhir_kinerja'] ?? '-') ?></td>
                                                <td class="text-right rp"><?= ($row['ranhir_rp'] ?? 0) ? 'Rp ' . number_format($row['ranhir_rp'], 0, ',', '.') : '-' ?></td>
                                                <td class="text-center"><?= html_escape($row['renja_kinerja'] ?? '-') ?></td>
                                                <td class="text-right rp"><?= ($row['renja_rp'] ?? 0) ? 'Rp ' . number_format($row['renja_rp'], 0, ',', '.') : '-' ?></td>
                                                <td class="text-center"><?= html_escape($row['dpa_murni_kinerja'] ?? '-') ?></td>
                                                <td class="text-right rp"><?= ($row['dpa_murni_rp'] ?? 0) ? 'Rp ' . number_format($row['dpa_murni_rp'], 0, ',', '.') : '-' ?></td>
                                                <td class="text-center"><?= html_escape($row['sumber_dana'] ?? '-') ?></td>
                                                <td class="text-center"><?= html_escape($row['dpa_perubahan_kinerja'] ?? '-') ?></td>
                                                <td class="text-right rp"><?= ($row['dpa_perubahan_rp'] ?? 0) ? 'Rp ' . number_format($row['dpa_perubahan_rp'], 0, ',', '.') : '-' ?></td>
                                                <td class="text-left">
                                                    <?php 
                                                    $bidang_pengampu = [];
                                                    if (!empty($row['dinas_nama'])) $bidang_pengampu[] = '<strong>Bidang:</strong> ' . html_escape($row['dinas_nama']);
                                                    if (!empty($row['karyawan_nama'])) {
                                                        $pengampu = html_escape($row['karyawan_nama']);
                                                        if (!empty($row['karyawan_jabatan'])) $pengampu .= ' - ' . html_escape($row['karyawan_jabatan']);
                                                        $bidang_pengampu[] = '<strong>Pengampu:</strong> ' . $pengampu;
                                                    }
                                                    echo implode('<br>', $bidang_pengampu);
                                                    ?>
                                                </td>
                                                <?php if ($IsRole4) { ?>
                                                    <td class="text-center">
                                                        <div class="btn-group-aksi">
                                                            <button class="btn btn-warning btn-sm BtnEditRenja" data-id="<?= $row['id'] ?>"><i class="fa fa-pencil"></i></button>
                                                            <button class="btn btn-danger btn-sm BtnHapusRenja" data-id="<?= $row['id'] ?>"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr><td colspan="<?= $IsRole4 ? '22' : '21' ?>" class="text-center">Belum ada data untuk tahun <?= $TahunAktif ?></td></tr>
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

<!-- MODAL INPUT RENJA -->
<div class="modal fade" id="ModalInputRenja" role="dialog">
    <div class="modal-dialog modal-xl" style="top:5%; width:95%; max-width:1400px;">
        <div class="modal-content">
            <div class="modal-header" style="background: #0275d8; color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h4><b><i class="fa fa-file-text"></i> <span id="ModalTitleRenja">Form Rencana Kerja (RENJA)</span></b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_id_renja" value="0">
                
                <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                    <div class="alert alert-info"><strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?></div>
                <?php } ?>
                
                <div class="row"><div class="col-md-3"><div class="form-group"><label><b>TAHUN</b> <span class="text-danger">*</span></label>
                    <select class="form-control" id="form_tahun"><?php for ($th = 2024; $th <= 2030; $th++): ?><option value="<?= $th ?>" <?= ($th == $TahunAktif) ? 'selected' : '' ?>><?= $th ?></option><?php endfor; ?></select>
                </div></div></div>
                
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_nomenklatur_renja" data-toggle="tab">📋 Pilih dari Nomenklatur</a></li>
                    <li><a href="#tab_manual_renja" data-toggle="tab">✏️ Isi Manual</a></li>
                </ul>
                
                <div class="tab-content" style="margin-top: 20px;">
                    <div class="tab-pane fade in active" id="tab_nomenklatur_renja">
                        <div class="nomenklatur-container">
                            <div class="panel-heading"><b>📋 Pilih dari Nomenklatur (Berjenjang)</b></div>
                            <div class="panel-body">
                                <div class="breadcrumb-nomenklatur"><span class="badge">📁 Jalur Pilihan</span> <span id="path_display_renja">Belum ada yang dipilih</span></div>
                                <div class="alert alert-info" id="preview_kode_rekening" style="display: none;"><strong>Kode Rekening:</strong> <span id="kode_rekening_hasil" class="kode-rekening-preview"></span></div>
                                
                                <div class="row">
                                    <div class="col-md-6"><div class="cascading-select"><label><b>1. URUSAN</b></label>
                                        <select class="form-control" id="select_urusan_renja"><option value="">-- Pilih Urusan --</option>
                                        <?php foreach ($ListUrusan as $urusan): ?>
                                            <option value="<?= html_escape($urusan['Kode']) ?>"><?= html_escape($urusan['Kode']) ?> - <?= html_escape($urusan['Nomenklatur']) ?></option>
                                        <?php endforeach; ?>
                                    </select></div></div>
                                    <div class="col-md-6"><div class="cascading-select"><label><b>2. BIDANG URUSAN</b></label>
                                        <select class="form-control" id="select_bidang_renja" disabled><option value="">-- Pilih Bidang Urusan --</option></select>
                                    </div></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><div class="cascading-select"><label><b>3. PROGRAM</b></label>
                                        <select class="form-control" id="select_program_renja" disabled><option value="">-- Pilih Program --</option></select>
                                    </div></div>
                                    <div class="col-md-4"><div class="cascading-select"><label><b>4. KEGIATAN</b></label>
                                        <select class="form-control" id="select_kegiatan_renja" disabled><option value="">-- Pilih Kegiatan --</option></select>
                                    </div></div>
                                    <div class="col-md-4"><div class="cascading-select"><label><b>5. SUB KEGIATAN</b></label>
                                        <select class="form-control" id="select_sub_kegiatan_renja" disabled><option value="">-- Pilih Sub Kegiatan --</option></select>
                                    </div></div>
                                </div>
                                <div class="info-nomenklatur"><i class="fa fa-info-circle"></i> Anda dapat memilih mulai dari Urusan, Bidang Urusan, Program, Kegiatan, atau Sub Kegiatan. Tidak harus memilih semua level.</div>
                            </div>
                        </div>
                        <input type="hidden" id="form_urusan_kode"><input type="hidden" id="form_bidang_kode"><input type="hidden" id="form_program_kode">
                        <input type="hidden" id="form_kegiatan_kode"><input type="hidden" id="form_sub_kegiatan_kode">
                        <input type="hidden" id="form_tujuan"><input type="hidden" id="form_sasaran"><input type="hidden" id="form_program">
                        <input type="hidden" id="form_kegiatan"><input type="hidden" id="form_sub_kegiatan">
                    </div>
                    
                    <div class="tab-pane fade" id="tab_manual_renja">
                        <div class="panel panel-default"><div class="panel-heading"><b>✏️ Isi Manual</b></div>
                        <div class="panel-body">
                            <div class="form-group"><label><b>KODE REKENING</b></label><input type="text" class="form-control" id="manual_kode_rekening" placeholder="Contoh: 1.01.01.01.01.001"></div>
                            <div class="form-group"><label><b>URUSAN</b></label><input type="text" class="form-control" id="manual_tujuan" placeholder="Urusan..."></div>
                            <div class="form-group"><label><b>BIDANG URUSAN</b></label><input type="text" class="form-control" id="manual_sasaran" placeholder="Bidang Urusan..."></div>
                            <div class="form-group"><label><b>PROGRAM</b></label><input type="text" class="form-control" id="manual_program" placeholder="Program..."></div>
                            <div class="form-group"><label><b>KEGIATAN</b></label><input type="text" class="form-control" id="manual_kegiatan" placeholder="Kegiatan..."></div>
                            <div class="form-group"><label><b>SUB KEGIATAN</b></label><input type="text" class="form-control" id="manual_sub_kegiatan" placeholder="Sub Kegiatan..."></div>
                        </div></div>
                    </div>
                </div>
                
                <hr>
                <div class="row"><div class="col-md-10"><div class="form-group"><label><b>INDIKATOR KINERJA</b></label><textarea class="form-control" id="form_indikator_kinerja" rows="2"></textarea></div></div>
                <div class="col-md-2"><div class="form-group"><label><b>SATUAN</b></label><input type="text" class="form-control" id="form_satuan"></div></div></div>
                
                <div class="row"><div class="col-md-6"><div class="form-group"><label><b>LOKASI</b></label><input type="text" class="form-control" id="form_lokasi"></div></div>
                <div class="col-md-3"><div class="form-group"><label><b>PRIORITAS DAERAH</b></label><input type="text" class="form-control" id="form_prioritas_daerah"></div></div>
                <div class="col-md-3"><div class="form-group"><label><b>PRIORITAS NASIONAL</b></label><input type="text" class="form-control" id="form_prioritas_nasional"></div></div></div>
                
                <div class="info-card"><div class="card-title">RANWAL RENJA</div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="form_ranwal_kinerja" placeholder="Kinerja"></div><div class="col-md-6"><input type="text" class="form-control" id="form_ranwal_rp" placeholder="Rp" onkeyup="formatRupiah(this)"></div></div></div>
                <div class="info-card"><div class="card-title">RANCANGAN RENJA</div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="form_rancangan_kinerja" placeholder="Kinerja"></div><div class="col-md-6"><input type="text" class="form-control" id="form_rancangan_rp" placeholder="Rp" onkeyup="formatRupiah(this)"></div></div></div>
                <div class="info-card"><div class="card-title">RANHIR RENJA</div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="form_ranhir_kinerja" placeholder="Kinerja"></div><div class="col-md-6"><input type="text" class="form-control" id="form_ranhir_rp" placeholder="Rp" onkeyup="formatRupiah(this)"></div></div></div>
                <div class="info-card"><div class="card-title">RENJA TAHUN <?= $TahunAktif ?></div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="form_renja_kinerja" placeholder="Kinerja"></div><div class="col-md-6"><input type="text" class="form-control" id="form_renja_rp" placeholder="Rp" onkeyup="formatRupiah(this)"></div></div></div>
                <div class="info-card"><div class="card-title">DPA MURNI <?= $TahunAktif ?></div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="form_dpa_murni_kinerja" placeholder="Kinerja"></div><div class="col-md-6"><input type="text" class="form-control" id="form_dpa_murni_rp" placeholder="Rp" onkeyup="formatRupiah(this)"></div></div></div>
                
                <div class="info-card"><div class="card-title">SUMBER DANA</div><input type="text" class="form-control" id="form_sumber_dana" placeholder="Contoh: APBD, APBN, DAK, Hibah, Bantuan Provinsi, Lainnya"></div>
                
                <div class="info-card"><div class="card-title">DPA PERUBAHAN <?= $TahunAktif ?></div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="form_dpa_perubahan_kinerja" placeholder="Kinerja"></div><div class="col-md-6"><input type="text" class="form-control" id="form_dpa_perubahan_rp" placeholder="Rp" onkeyup="formatRupiah(this)"></div></div></div>
                
                <div class="info-card"><div class="card-title">BIDANG & PENGAMPU</div>
                    <div class="row"><div class="col-md-6"><label><b>Pilih Dinas / Instansi</b></label>
                        <select class="form-control" id="DinasFilterRenja"><option value="">-- Pilih Dinas --</option>
                        <?php foreach ($ListDinas as $dinas): ?><option value="<?= $dinas['id'] ?>"><?= html_escape($dinas['nama']) ?></option><?php endforeach; ?>
                    </select></div>
                    <div class="col-md-6"><div id="PengampuGroupRenja" style="display: none;"><label><b>Pilih Pengampu / Pelaksana</b></label>
                        <select class="form-control" id="PengampuRenja"><option value="">-- Pilih Pengampu --</option></select>
                    </div></div></div>
                </div>
                
                <div class="info-card"><div class="card-title">KINERJA & TARGET</div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="form_kinerja" placeholder="Kinerja yang diharapkan"></div><div class="col-md-6"><input type="text" class="form-control" id="form_target" placeholder="Target (contoh: 100 Orang)"></div></div></div>
                
                <hr>
                <div class="text-right"><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</button>
                <button class="btn btn-success" id="BtnSimpanRenja"><i class="fa fa-save"></i> SIMPAN</button></div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/jquery.dataTables.min.js') ?>"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var CURRENT_TAHUN = '<?= $TahunAktif ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var listDinas = <?= json_encode($ListDinas); ?>;
var listKaryawan = <?= json_encode($ListKaryawan); ?>;

// =============================================
// FUNGSI UTILITY
// =============================================
function formatRupiah(element) {
    var value = element.value.replace(/[^0-9]/g, '');
    if (value) element.value = new Intl.NumberFormat('id-ID').format(value);
}

function unformatRupiah(value) { 
    if (!value) return ''; 
    return value.replace(/[^0-9]/g, ''); 
}

function escapeHtml(text) { 
    if (!text) return ''; 
    var map = {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}; 
    return String(text).replace(/[&<>"']/g, function(m) { return map[m]; }); 
}

function showNotification(message, type) {
    type = type || 'success';
    var bgColor = type === 'success' ? '#28a745' : (type === 'error' ? '#dc3545' : '#17a2b8');
    var icon = type === 'success' ? 'fa-check-circle' : (type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle');
    
    var notification = $('<div class="alert alert-' + type + ' filter-notification" style="background-color: ' + bgColor + '; color: white; border: none;">' +
        '<i class="fa ' + icon + '"></i> ' + message +
        '<button type="button" class="close" style="color: white; opacity: 0.8;" data-dismiss="alert">&times;</button>' +
        '</div>');
    
    $('body').append(notification);
    setTimeout(function() { notification.fadeOut(500, function() { $(this).remove(); }); }, 3000);
}

// =============================================
// LOAD & SAVE FILTER KE LOCALSTORAGE (UNTUK USER BELUM LOGIN)
// =============================================
function saveFilterToLocalStorage() {
    if (IS_LOGGED_IN === '1') return; // Hanya untuk user belum login
    
    var kodeWilayah = $('#KabKota').val();
    var instansiId = $('#FilterInstansiBeforeLogin').val();
    
    if (kodeWilayah) {
        localStorage.setItem('tempKodeWilayah', kodeWilayah);
        if (instansiId && instansiId !== '') {
            localStorage.setItem('tempInstansiId', instansiId);
        } else {
            localStorage.removeItem('tempInstansiId');
        }
    }
}

function loadFilterFromLocalStorage() {
    if (IS_LOGGED_IN === '1') return; // Hanya untuk user belum login
    
    var savedKodeWilayah = localStorage.getItem('tempKodeWilayah');
    var savedInstansiId = localStorage.getItem('tempInstansiId');
    
    if (savedKodeWilayah && !KODE_WILAYAH) {
        // Set provinsi dari kode wilayah
        var kodeProv = savedKodeWilayah.substring(0, 2);
        $('#Provinsi').val(kodeProv).trigger('change');
        
        // Set kab/kota setelah data dimuat
        setTimeout(function() {
            $('#KabKota').val(savedKodeWilayah).trigger('change');
            
            // Set instansi setelah data instansi dimuat
            setTimeout(function() {
                if (savedInstansiId && savedInstansiId !== '') {
                    $('#FilterInstansiBeforeLogin').val(savedInstansiId);
                    var selectedText = $('#FilterInstansiBeforeLogin option:selected').text();
                    if (selectedText && selectedText !== '-- Semua Instansi --') {
                        showNotification('Filter instansi: ' + selectedText, 'info');
                    }
                }
            }, 600);
        }, 300);
    }
}

// =============================================
// FUNGSI NOMENKLATUR
// =============================================
function loadNomenklatur(level, parentKode, targetSelectId, resetLower) {
    var url = BaseURL + "Instansi/getNomenklaturByLevelAndParent";
    var data = { level: level, [CSRF_NAME]: CSRF_TOKEN };
    if (parentKode) data.parent_kode = parentKode;
    
    $.ajax({ url: url, type: "POST", data: data, dataType: "json",
        beforeSend: function() { $('#' + targetSelectId).html('<option value="">Memuat...</option>').prop('disabled', true); },
        success: function(res) {
            var options = '<option value="">-- Pilih --</option>';
            for (var i = 0; i < res.length; i++) options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
            $('#' + targetSelectId).html(options).prop('disabled', false);
            if (resetLower) {
                if (targetSelectId == 'select_urusan_renja') {
                    $('#select_bidang_renja').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
                    $('#select_program_renja').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
                    $('#select_kegiatan_renja').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
                    $('#select_sub_kegiatan_renja').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
                } else if (targetSelectId == 'select_bidang_renja') {
                    $('#select_program_renja').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
                    $('#select_kegiatan_renja').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
                    $('#select_sub_kegiatan_renja').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
                } else if (targetSelectId == 'select_program_renja') {
                    $('#select_kegiatan_renja').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
                    $('#select_sub_kegiatan_renja').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
                } else if (targetSelectId == 'select_kegiatan_renja') {
                    $('#select_sub_kegiatan_renja').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
                }
            }
            updatePathDisplay();
        },
        error: function() { $('#' + targetSelectId).html('<option value="">Gagal memuat data</option>').prop('disabled', false); }
    });
}

function updatePathDisplay() {
    var paths = [];
    if ($('#select_urusan_renja').val()) paths.push('<span class="label label-primary">Urusan: ' + escapeHtml($('#select_urusan_renja option:selected').text()) + '</span>');
    if ($('#select_bidang_renja').val()) paths.push('<span class="label label-info">Bidang: ' + escapeHtml($('#select_bidang_renja option:selected').text()) + '</span>');
    if ($('#select_program_renja').val()) paths.push('<span class="label label-success">Program: ' + escapeHtml($('#select_program_renja option:selected').text()) + '</span>');
    if ($('#select_kegiatan_renja').val()) paths.push('<span class="label label-warning">Kegiatan: ' + escapeHtml($('#select_kegiatan_renja option:selected').text()) + '</span>');
    if ($('#select_sub_kegiatan_renja').val()) paths.push('<span class="label label-danger">Sub Kegiatan: ' + escapeHtml($('#select_sub_kegiatan_renja option:selected').text()) + '</span>');
    
    $('#path_display_renja').html(paths.length ? paths.join(' → ') : 'Belum ada yang dipilih');
    updateKodeRekening();
}

function updateKodeRekening() {
    var kode = $('#select_sub_kegiatan_renja').val() || $('#select_kegiatan_renja').val() || $('#select_program_renja').val() || $('#select_bidang_renja').val() || $('#select_urusan_renja').val() || '';
    if (kode) { $('#kode_rekening_hasil').text(kode); $('#preview_kode_rekening').show(); }
    else { $('#preview_kode_rekening').hide(); }
}

function loadPengampuByDinas(dinasId, selectedPengampuId) {
    selectedPengampuId = selectedPengampuId || '';
    $('#PengampuGroupRenja').hide();
    $('#PengampuRenja').html('<option value="">-- Pilih Pengampu --</option>');
    if (!dinasId) return;
    if (!listKaryawan || !listKaryawan.length) { $('#PengampuGroupRenja').show(); $('#PengampuRenja').html('<option disabled>⚠️ Tidak ada data</option>'); return; }
    
    var filtered = [], dinasIdStr = String(dinasId).trim();
    for (var i = 0; i < listKaryawan.length; i++) {
        var k = listKaryawan[i], dinasIds = k.dinas_id_array || (k.dinas_id ? String(k.dinas_id).split(',').map(function(id){ return id.trim(); }) : []);
        for (var j = 0; j < dinasIds.length; j++) { if (String(dinasIds[j]).trim() === dinasIdStr) { filtered.push(k); break; } }
    }
    var options = '<option value="">-- Pilih Pengampu --</option>';
    for (var i = 0; i < filtered.length; i++) {
        var k = filtered[i], selected = (k.id == selectedPengampuId) ? 'selected' : '', txt = k.nama + (k.jabatan ? ' - ' + k.jabatan : '') + (k.nip ? ' (' + k.nip + ')' : '');
        options += '<option value="' + k.id + '" ' + selected + '>' + escapeHtml(txt) + '</option>';
    }
    if (filtered.length === 0) options += '<option disabled>⚠️ Tidak ada pengampu</option>';
    $('#PengampuGroupRenja').show();
    $('#PengampuRenja').html(options);
}

function initDataTable() {
    if ($('#table-renja').length && $.fn.DataTable.isDataTable('#table-renja')) $('#table-renja').DataTable().destroy();
    try { 
        $('#table-renja').DataTable({ 
            pageLength: 10, 
            ordering: false, 
            scrollX: true, 
            autoWidth: false, 
            destroy: true, 
            retrieve: true, 
            language: { 
                emptyTable: "Tidak ada data", 
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data", 
                infoEmpty: "Tidak ada data", 
                search: "Cari:", 
                lengthMenu: "Tampilkan _MENU_ data", 
                paginate: { first: "Pertama", last: "Terakhir", next: "Berikutnya", previous: "Sebelumnya" } 
            } 
        }); 
    } catch(e) { console.log("DataTable error:", e); }
}

// =============================================
// DOCUMENT READY
// =============================================
$(document).ready(function() {
    setTimeout(initDataTable, 200);
    
    // =========================================
    // FILTER UNTUK USER BELUM LOGIN
    // =========================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
    
    // Load filter dari localStorage saat halaman dimuat
    loadFilterFromLocalStorage();
    
    $("#Provinsi").change(function() {
        if (!$(this).val()) { 
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>'); 
            $("#FilterInstansiGroupBefore").hide(); 
            return; 
        }
        $.ajax({ url: BaseURL + "Instansi/GetListKabKota", type: "POST", data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN }, dataType: 'json',
            beforeSend: function() { $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>'); $("#FilterInstansiGroupBefore").hide(); },
            success: function(d) { 
                var o = '<option value="">Pilih Kab/Kota</option>'; 
                for (var i=0;i<d.length;i++) o+='<option value="'+d[i].Kode+'">'+d[i].Nama+'</option>'; 
                $("#KabKota").html(o).prop('disabled', false); 
            },
            error: function() { alert("Gagal memuat data Kab/Kota"); }
        });
    });
    
    $("#KabKota").change(function() {
        if (!$(this).val()) { 
            $("#FilterInstansiGroupBefore").hide(); 
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>'); 
            return; 
        }
        $.ajax({ url: BaseURL + "Instansi/GetListInstansiLevel4", type: "POST", data: { kode_wilayah: $(this).val(), [CSRF_NAME]: CSRF_TOKEN }, dataType: 'json',
            beforeSend: function() { $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>'); $("#FilterInstansiGroupBefore").show(); },
            success: function(d) { 
                var o = '<option value="">-- Semua Instansi --</option>'; 
                for (var i=0;i<d.length;i++) o+='<option value="'+d[i].id+'">'+d[i].nama+'</option>'; 
                $("#FilterInstansiBeforeLogin").html(o); 
                $("#FilterInstansiGroupBefore").show();
                
                // ✅ Setelah data instansi dimuat, cek localStorage lagi
                var savedInstansiId = localStorage.getItem('tempInstansiId');
                if (savedInstansiId && savedInstansiId !== '') {
                    $("#FilterInstansiBeforeLogin").val(savedInstansiId);
                }
            },
            error: function() { alert("Gagal memuat data Instansi"); }
        });
    });
    
    // Tombol FILTER
    $("#Filter").click(function() {
        if (!$("#Provinsi").val()) { alert("Pilih Provinsi"); return; }
        if (!$("#KabKota").val()) { alert("Pilih Kab/Kota"); return; }
        
        var kodeWilayah = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        // ✅ Simpan ke localStorage sebelum redirect
        localStorage.setItem('tempKodeWilayah', kodeWilayah);
        if (instansiId && instansiId !== '') {
            localStorage.setItem('tempInstansiId', instansiId);
        } else {
            localStorage.removeItem('tempInstansiId');
        }
        
        $.ajax({ url: BaseURL + "Instansi/SetTempKodeWilayah", type: "POST", data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN }, 
            beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
            success: function(r) { 
                if(r === '1') { 
                    var url = BaseURL + "Instansi/RenjaPD";
                    if(instansiId && instansiId !== '') {
                        url += "?instansi_id=" + instansiId;
                    }
                    window.location.href = url;
                } else { 
                    alert(r); 
                    $("#Filter").prop('disabled', false).text('Filter'); 
                }
            },
            error: function() { alert("Gagal menghubungi server!"); $("#Filter").prop('disabled', false).text('Filter'); }
        });
    });
    
    // Tombol RESET filter
    $("#ResetFilterBefore").click(function() {
        if(confirm("Reset semua filter? Semua pilihan filter akan dihapus.")) {
            localStorage.removeItem('tempKodeWilayah');
            localStorage.removeItem('tempInstansiId');
            window.location.href = BaseURL + "Instansi/RenjaPD";
        }
    });
    
    <?php if (!empty($KodeWilayah)) { ?>
        $("#Provinsi").val("<?= substr($KodeWilayah, 0, 2) ?>").trigger('change');
        setTimeout(function() { $("#KabKota").val("<?= $KodeWilayah ?>").trigger('change'); }, 500);
    <?php } ?>
    
    <?php } ?>
    
    // =========================================
    // FILTER UNTUK USER SUDAH LOGIN (NON ROLE 4)
    // =========================================
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
        $("#FilterInstansiBtn").click(function() { 
            var url = BaseURL + "Instansi/RenjaPD?tahun=" + $('#filterTahun').val(); 
            if($("#FilterInstansi").val()) url += "&instansi_id=" + $("#FilterInstansi").val(); 
            window.location.href = url; 
        });
        $("#ResetFilterBtn").click(function() { 
            window.location.href = BaseURL + "Instansi/RenjaPD?tahun=" + $('#filterTahun').val(); 
        });
    <?php } ?>
    
    // Filter tahun
    $('#btnFilterTahun').click(function() { 
        var url = BaseURL + "Instansi/RenjaPD?tahun=" + $('#filterTahun').val(); 
        if (typeof $('#FilterInstansi') !== 'undefined' && $('#FilterInstansi').val()) {
            url += "&instansi_id=" + $('#FilterInstansi').val();
        }
        if (typeof $('#FilterInstansiBeforeLogin') !== 'undefined' && $('#FilterInstansiBeforeLogin').val() && !IS_LOGGED_IN) {
            url += "&instansi_id=" + $('#FilterInstansiBeforeLogin').val();
        }
        window.location.href = url; 
    });
    
    // =========================================
    // EVENT UNTUK MODAL (ROLE 4)
    // =========================================
    <?php if ($IsRole4) { ?>
    
    $('#select_urusan_renja').change(function() {
        var k = $(this).val();
        if (k) {
            var parts = $(this).find('option:selected').text().split(' - ');
            $('#form_tujuan').val(parts.slice(1).join(' - '));
            $('#form_urusan_kode').val(k);
            loadNomenklatur(2, k, 'select_bidang_renja', true);
        } else { $('#form_tujuan,#form_urusan_kode').val(''); $('#select_bidang_renja,#select_program_renja,#select_kegiatan_renja,#select_sub_kegiatan_renja').html('<option value="">-- Pilih --</option>').prop('disabled', true); }
        updatePathDisplay();
    });
    
    $('#select_bidang_renja').change(function() {
        var k = $(this).val();
        if (k) {
            var parts = $(this).find('option:selected').text().split(' - ');
            $('#form_sasaran').val(parts.slice(1).join(' - '));
            $('#form_bidang_kode').val(k);
            loadNomenklatur(3, k, 'select_program_renja', true);
        } else { $('#form_sasaran,#form_bidang_kode').val(''); $('#select_program_renja,#select_kegiatan_renja,#select_sub_kegiatan_renja').html('<option value="">-- Pilih --</option>').prop('disabled', true); }
        updatePathDisplay();
    });
    
    $('#select_program_renja').change(function() {
        var k = $(this).val();
        if (k) {
            var parts = $(this).find('option:selected').text().split(' - ');
            $('#form_program').val(parts.slice(1).join(' - '));
            $('#form_program_kode').val(k);
            loadNomenklatur(4, k, 'select_kegiatan_renja', true);
        } else { $('#form_program,#form_program_kode').val(''); $('#select_kegiatan_renja,#select_sub_kegiatan_renja').html('<option value="">-- Pilih --</option>').prop('disabled', true); }
        updatePathDisplay();
    });
    
    $('#select_kegiatan_renja').change(function() {
        var k = $(this).val();
        if (k) {
            var parts = $(this).find('option:selected').text().split(' - ');
            $('#form_kegiatan').val(parts.slice(1).join(' - '));
            $('#form_kegiatan_kode').val(k);
            loadNomenklatur(5, k, 'select_sub_kegiatan_renja', true);
        } else { $('#form_kegiatan,#form_kegiatan_kode').val(''); $('#select_sub_kegiatan_renja').html('<option value="">-- Pilih --</option>').prop('disabled', true); }
        updatePathDisplay();
    });
    
    $('#select_sub_kegiatan_renja').change(function() {
        var k = $(this).val();
        if (k) {
            var parts = $(this).find('option:selected').text().split(' - ');
            $('#form_sub_kegiatan').val(parts.slice(1).join(' - '));
            $('#form_sub_kegiatan_kode').val(k);
        } else { $('#form_sub_kegiatan,#form_sub_kegiatan_kode').val(''); }
        updatePathDisplay();
    });
    
    $('#DinasFilterRenja').change(function() { loadPengampuByDinas($(this).val(), ''); });
    
    $('#ModalInputRenja').on('show.bs.modal', function() {
        var editId = $('#edit_id_renja').val();
        if (!editId || editId == '0') {
            $('#edit_id_renja').val(0);
            $('#form_tahun').val(CURRENT_TAHUN);
            $('#select_urusan_renja').val('').trigger('change');
            $('#form_urusan_kode,#form_bidang_kode,#form_program_kode,#form_kegiatan_kode,#form_sub_kegiatan_kode').val('');
            $('#form_tujuan,#form_sasaran,#form_program,#form_kegiatan,#form_sub_kegiatan').val('');
            $('#manual_kode_rekening,#manual_tujuan,#manual_sasaran,#manual_program,#manual_kegiatan,#manual_sub_kegiatan').val('');
            $('#form_indikator_kinerja,#form_satuan,#form_lokasi,#form_prioritas_daerah,#form_prioritas_nasional').val('');
            $('#form_ranwal_kinerja,#form_rancangan_kinerja,#form_ranhir_kinerja,#form_renja_kinerja').val('');
            $('#form_dpa_murni_kinerja,#form_sumber_dana,#form_dpa_perubahan_kinerja').val('');
            $('#form_kinerja,#form_target').val('');
            $('#form_ranwal_rp,#form_rancangan_rp,#form_ranhir_rp,#form_renja_rp').val('');
            $('#form_dpa_murni_rp,#form_dpa_perubahan_rp').val('');
            $('#DinasFilterRenja').val(''); $('#PengampuGroupRenja').hide(); $('#PengampuRenja').html('<option value="">-- Pilih Pengampu --</option>');
            $('a[href="#tab_nomenklatur_renja"]').tab('show');
            updatePathDisplay(); $('#preview_kode_rekening').hide();
            $('#ModalTitleRenja').text('Form Rencana Kerja (RENJA)');
        }
    });
    
    // SIMPAN DATA
    $("#BtnSimpanRenja").click(function(){
        var isNomenklatur = $('#tab_nomenklatur_renja').hasClass('active');
        var editId = $('#edit_id_renja').val();
        
        var data = {
            [CSRF_NAME]: CSRF_TOKEN,
            id: editId,
            tahun: $('#form_tahun').val(),
            mode_nomenklatur: isNomenklatur ? 1 : 0
        };
        
        if (isNomenklatur) {
            data.urusan_kode = $('#select_urusan_renja').val() || '';
            data.bidang_kode = $('#select_bidang_renja').val() || '';
            data.program_kode = $('#select_program_renja').val() || '';
            data.kegiatan_kode = $('#select_kegiatan_renja').val() || '';
            data.sub_kegiatan_kode = $('#select_sub_kegiatan_renja').val() || '';
            
            if (!data.urusan_kode && !data.bidang_kode && !data.program_kode && !data.kegiatan_kode && !data.sub_kegiatan_kode) {
                alert("Silakan pilih minimal Urusan, Bidang Urusan, Program, Kegiatan, atau Sub Kegiatan!");
                return;
            }
        } else {
            data.kode_rekening = $('#manual_kode_rekening').val();
            data.tujuan_manual = $('#manual_tujuan').val();
            data.sasaran_manual = $('#manual_sasaran').val();
            data.program_manual = $('#manual_program').val();
            data.kegiatan_manual = $('#manual_kegiatan').val();
            data.sub_kegiatan_manual = $('#manual_sub_kegiatan').val();
            
            if (!data.tujuan_manual && !data.sasaran_manual && !data.program_manual && !data.kegiatan_manual && !data.sub_kegiatan_manual) {
                alert("Silakan isi minimal Urusan, Bidang Urusan, Program, Kegiatan, atau Sub Kegiatan!");
                return;
            }
        }
        
        data.indikator_kinerja = $('#form_indikator_kinerja').val();
        data.satuan = $('#form_satuan').val();
        data.lokasi = $('#form_lokasi').val();
        data.prioritas_daerah = $('#form_prioritas_daerah').val();
        data.prioritas_nasional = $('#form_prioritas_nasional').val();
        data.ranwal_kinerja = $('#form_ranwal_kinerja').val();
        data.ranwal_rp = unformatRupiah($('#form_ranwal_rp').val());
        data.rancangan_kinerja = $('#form_rancangan_kinerja').val();
        data.rancangan_rp = unformatRupiah($('#form_rancangan_rp').val());
        data.ranhir_kinerja = $('#form_ranhir_kinerja').val();
        data.ranhir_rp = unformatRupiah($('#form_ranhir_rp').val());
        data.renja_kinerja = $('#form_renja_kinerja').val();
        data.renja_rp = unformatRupiah($('#form_renja_rp').val());
        data.dpa_murni_kinerja = $('#form_dpa_murni_kinerja').val();
        data.dpa_murni_rp = unformatRupiah($('#form_dpa_murni_rp').val());
        data.sumber_dana = $('#form_sumber_dana').val();
        data.dpa_perubahan_kinerja = $('#form_dpa_perubahan_kinerja').val();
        data.dpa_perubahan_rp = unformatRupiah($('#form_dpa_perubahan_rp').val());
        data.dinas_id = $('#DinasFilterRenja').val() || null;
        data.pengampu_id = $('#PengampuRenja').val() || null;
        data.bidang_pengampu = $('#DinasFilterRenja option:selected').text();
        data.kinerja = $('#form_kinerja').val();
        data.target = $('#form_target').val();
        data.pagu_anggaran = unformatRupiah($('#form_renja_rp').val());
        
        $("#BtnSimpanRenja").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        $.ajax({
            url: BaseURL + "Instansi/simpanRenjaPD",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res){
                $("#BtnSimpanRenja").prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN');
                if(res.status === "success") {
                    showNotification(res.message, 'success');
                    setTimeout(function() { location.reload(); }, 1500);
                } else {
                    alert(res.message || "Gagal menyimpan");
                }
            },
            error: function(xhr) {
                $("#BtnSimpanRenja").prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN');
                console.log(xhr.responseText);
                alert("Terjadi kesalahan saat menyimpan data");
            }
        });
    });
    
    // EDIT DATA
    $(document).on("click", ".BtnEditRenja", function() {
        var id = $(this).data('id');
        $('#edit_id_renja').val(id);
        $('#ModalTitleRenja').text('Edit Rencana Kerja (RENJA)');
        $("#ModalInputRenja").modal("show");
        $("#BtnSimpanRenja").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');
        
        $.ajax({ url: BaseURL + "Instansi/getRenjaPD", type: "POST", data: { id: id, [CSRF_NAME]: CSRF_TOKEN }, dataType: "json",
            success: function(r) {
                if(r.status === "success" && r.data) {
                    var d = r.data;
                    $('#edit_id_renja').val(d.id);
                    $('#form_tahun').val(d.tahun);
                    $('#form_indikator_kinerja').val(d.indikator_kinerja || '');
                    $('#form_satuan').val(d.satuan || '');
                    $('#form_lokasi').val(d.lokasi || '');
                    $('#form_prioritas_daerah').val(d.prioritas_daerah || '');
                    $('#form_prioritas_nasional').val(d.prioritas_nasional || '');
                    $('#form_ranwal_kinerja').val(d.ranwal_kinerja || '');
                    $('#form_ranwal_rp').val(d.ranwal_rp ? new Intl.NumberFormat('id-ID').format(d.ranwal_rp) : '');
                    $('#form_rancangan_kinerja').val(d.rancangan_kinerja || '');
                    $('#form_rancangan_rp').val(d.rancangan_rp ? new Intl.NumberFormat('id-ID').format(d.rancangan_rp) : '');
                    $('#form_ranhir_kinerja').val(d.ranhir_kinerja || '');
                    $('#form_ranhir_rp').val(d.ranhir_rp ? new Intl.NumberFormat('id-ID').format(d.ranhir_rp) : '');
                    $('#form_renja_kinerja').val(d.renja_kinerja || '');
                    $('#form_renja_rp').val(d.renja_rp ? new Intl.NumberFormat('id-ID').format(d.renja_rp) : '');
                    $('#form_dpa_murni_kinerja').val(d.dpa_murni_kinerja || '');
                    $('#form_dpa_murni_rp').val(d.dpa_murni_rp ? new Intl.NumberFormat('id-ID').format(d.dpa_murni_rp) : '');
                    $('#form_sumber_dana').val(d.sumber_dana || '');
                    $('#form_dpa_perubahan_kinerja').val(d.dpa_perubahan_kinerja || '');
                    $('#form_dpa_perubahan_rp').val(d.dpa_perubahan_rp ? new Intl.NumberFormat('id-ID').format(d.dpa_perubahan_rp) : '');
                    $('#form_kinerja').val(d.kinerja || '');
                    $('#form_target').val(d.target || '');
                    
                    if (d.dinas_id) { $('#DinasFilterRenja').val(d.dinas_id); loadPengampuByDinas(d.dinas_id, d.pengampu_id || ''); }
                    
                    var isNomenklatur = d.kode_rekening && (d.tujuan || d.sasaran || d.program || d.kegiatan || d.sub_kegiatan);
                    if (isNomenklatur) {
                        $('a[href="#tab_nomenklatur_renja"]').tab('show');
                        $('#form_tujuan').val(d.tujuan || ''); $('#form_sasaran').val(d.sasaran || ''); $('#form_program').val(d.program || '');
                        $('#form_kegiatan').val(d.kegiatan || ''); $('#form_sub_kegiatan').val(d.sub_kegiatan || '');
                        if (d.kode_rekening) {
                            var parts = d.kode_rekening.split('.');
                            if (parts[0]) {
                                $('#select_urusan_renja').val(parts[0]).trigger('change');
                                setTimeout(function() { if (parts[1]) { $('#select_bidang_renja').val(parts[0]+'.'+parts[1]).trigger('change');
                                    setTimeout(function() { if (parts[2]) { $('#select_program_renja').val(parts[0]+'.'+parts[1]+'.'+parts[2]).trigger('change');
                                        setTimeout(function() { if (parts[3]) { $('#select_kegiatan_renja').val(parts[0]+'.'+parts[1]+'.'+parts[2]+'.'+parts[3]).trigger('change');
                                            setTimeout(function() { if (parts[4]) { $('#select_sub_kegiatan_renja').val(parts[0]+'.'+parts[1]+'.'+parts[2]+'.'+parts[3]+'.'+parts[4]).trigger('change'); } }, 200);
                                        } }, 200);
                                    } }, 200);
                                } }, 200);
                            }
                        }
                    } else {
                        $('a[href="#tab_manual_renja"]').tab('show');
                        $('#manual_kode_rekening').val(d.kode_rekening || '');
                        $('#manual_tujuan').val(d.tujuan || ''); $('#manual_sasaran').val(d.sasaran || '');
                        $('#manual_program').val(d.program || ''); $('#manual_kegiatan').val(d.kegiatan || '');
                        $('#manual_sub_kegiatan').val(d.sub_kegiatan || '');
                    }
                    $("#BtnSimpanRenja").prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN');
                } else { alert(r.message || "Gagal mengambil data"); $("#ModalInputRenja").modal("hide"); $("#BtnSimpanRenja").prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN'); }
            },
            error: function() { alert("Terjadi kesalahan saat mengambil data"); $("#ModalInputRenja").modal("hide"); $("#BtnSimpanRenja").prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN'); }
        });
    });
    
    // HAPUS DATA
    $(document).on("click", ".BtnHapusRenja", function() {
        if(!confirm("Yakin hapus data ini?")) return;
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({ url: BaseURL + "Instansi/hapusRenjaPD", type: "POST", data: { id: btn.data("id"), [CSRF_NAME]: CSRF_TOKEN }, dataType: "json",
            success: function(r) { 
                if(r.status === "success") { 
                    showNotification(r.message, 'success');
                    setTimeout(function() { location.reload(); }, 1500);
                } else { 
                    alert(r.message || "Gagal hapus!"); 
                    btn.prop('disabled', false).html('<i class="fa fa-trash"></i>');
                } 
            },
            error: function() { alert("Terjadi kesalahan saat menghapus data"); btn.prop('disabled', false).html('<i class="fa fa-trash"></i>'); }
        });
    });
    
    <?php } ?>
    
});
</script>
</body>
</html>