<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<?php
// ==============================================
// FUNGSI MENGHITUNG TOTAL ANGGARAN PER TAHUN
// ==============================================
function hitungTotalAnggaranSubKegiatan($subKegiatanList) {
    $total = ['2026' => 0, '2027' => 0, '2028' => 0, '2029' => 0, '2030' => 0];
    foreach ($subKegiatanList as $sub) {
        if (isset($sub['sasaran_list'])) {
            foreach ($sub['sasaran_list'] as $sasaran) {
                if (isset($sasaran['indikators'])) {
                    foreach ($sasaran['indikators'] as $ind) {
                        foreach (['2026','2027','2028','2029','2030'] as $year) {
                            $key = 'anggaran_' . $year;
                            if (isset($ind[$key]) && $ind[$key] !== '' && $ind[$key] !== null) {
                                $total[$year] += (float) $ind[$key];
                            }
                        }
                    }
                }
            }
        }
    }
    return $total;
}

function hitungTotalAnggaranKegiatan($kegiatanList) {
    $total = ['2026' => 0, '2027' => 0, '2028' => 0, '2029' => 0, '2030' => 0];
    foreach ($kegiatanList as $keg) {
        if (isset($keg['sub_kegiatan_list'])) {
            $subTotal = hitungTotalAnggaranSubKegiatan($keg['sub_kegiatan_list']);
            foreach (['2026','2027','2028','2029','2030'] as $year) {
                $total[$year] += $subTotal[$year];
            }
        }
    }
    return $total;
}

function hitungTotalAnggaranProgram($program) {
    $kegiatanList = $program['kegiatan_list'] ?? [];
    return hitungTotalAnggaranKegiatan($kegiatanList);
}
?>

<style>
/* ============================================================
   STYLE RENSTRA PD - DENGAN OUTCOME & INDIKATOR
   MEMPERTAHANKAN NOMENKLATUR DAN TAMPILAN SEBELUMNYA
============================================================ */
.filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
.filter-group { display:flex; flex-direction:column; align-items:flex-start; }
.filter-group label { font-size:14px; margin-bottom:5px; }
.filter-select { width:260px; font-size:14px; padding:5px 8px; }



.renstra-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}
.renstra-table th {
    background: #f1f8e9;
    text-align: center;
    font-weight: 600;
    padding: 6px 4px;
    border: 1px solid #dee2e6;
    font-size: 10px;
    vertical-align: middle;
}
.renstra-table td {
    padding: 4px 3px;
    border: 1px solid #dee2e6;
    vertical-align: middle;
    text-align: center;
}
.renstra-table .text-left { text-align: left; padding-left: 8px; }
.renstra-table .text-right { text-align: right; padding-right: 8px; }
.renstra-table .cell-no { font-weight: 600; font-size: 11px; white-space: nowrap; padding: 4px 6px; }

/* Warna level */
.row-tujuan { background: #e3f2fd; font-weight: 700; border-bottom: 2px solid #1565c0; }
.row-tujuan .badge-tujuan { background: #1565c0; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 10px; }

.row-sasaran { background: #f3e5f5; font-weight: 600; border-bottom: 2px solid #7b1fa2; }
.row-sasaran .badge-sasaran { background: #7b1fa2; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 10px; }

.row-program { background: #e8f5e9; border-bottom: 2px solid #2e7d32; }
.row-program .badge-program { background: #2e7d32; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
.row-program .nama-program { font-weight: 600; color: #1b5e20; }

.row-outcome { background: #fff3e0; border-left: 3px solid #e65100; }
.row-outcome .badge-outcome { background: #e65100; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px; }
.row-outcome .outcome-text { font-weight: 500; color: #0a3622; display: block; padding-left: 0px; }

.row-indikator { background: #fff; border-left: 3px solid #f9a825; }
.row-indikator .badge-indikator { background: #f9a825; color: #212529; padding: 2px 6px; border-radius: 8px; font-size: 9px; }
.row-indikator .indikator-text { font-weight: 400; color: #2c3e50; }

.row-kegiatan { background: #e0f7fa; border-left: 3px solid #006064; }
.row-kegiatan .badge-kegiatan { background: #006064; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px; }

.row-kegiatan-sasaran { background: #b2ebf2; border-left: 3px solid #00838f; }
.row-kegiatan-sasaran .badge-kegiatan-sasaran { background: #00838f; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px; }

.row-subkegiatan { background: #fce4ec; border-left: 3px solid #880e4f; }
.row-subkegiatan .badge-subkegiatan { background: #880e4f; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px; }

.row-subkegiatan-sasaran { background: #f8bbd0; border-left: 3px solid #ad1457; }
.row-subkegiatan-sasaran .badge-subkegiatan-sasaran { background: #ad1457; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 9px; }

.renstra-table .pagu-col { color: #1a5276; font-weight: 500; font-size: 10px; }
.renstra-table .badge-pd { background: #e9ecef; color: #495057; padding: 2px 6px; border-radius: 4px; font-size: 9px; }
.renstra-table .badge-empty { color: #adb5bd; font-size: 9px; }

/* Indentasi */
.level-tujuan { padding-left: 5px; }
.level-sasaran { padding-left: 25px; }
.level-program { padding-left: 45px; }
.level-outcome { padding-left: 65px; }
.level-indikator { padding-left: 65px; }
.level-kegiatan { padding-left: 85px; }
.level-kegiatan-sasaran { padding-left: 105px; }
.level-kegiatan-indikator { padding-left: 125px; }
.level-subkegiatan { padding-left: 105px; }
.level-subkegiatan-sasaran { padding-left: 125px; }
.level-subkegiatan-indikator { padding-left: 145px; }

.border-tujuan { border-left: 4px solid #1565c0 !important; }
.border-sasaran { border-left: 4px solid #7b1fa2 !important; }
.border-program { border-left: 4px solid #2e7d32 !important; }
.border-outcome { border-left: 4px solid #e65100 !important; }
.border-indikator { border-left: 4px solid #f9a825 !important; }
.border-kegiatan { border-left: 4px solid #006064 !important; }
.border-kegiatan-sasaran { border-left: 4px solid #00838f !important; }
.border-subkegiatan { border-left: 4px solid #880e4f !important; }
.border-subkegiatan-sasaran { border-left: 4px solid #ad1457 !important; }

.renstra-table .col-aksi { text-align: center; vertical-align: middle; min-width: 80px; }
.renstra-table .btn-aksi { padding: 2px 6px; font-size: 9px; margin: 1px; border: none; border-radius: 3px; }
.renstra-table .btn-group-aksi { display: inline-flex; gap: 2px; flex-wrap: wrap; justify-content: center; }

.table-scroll { overflow-x: auto; margin-top: 5px; }
.table-scroll .renstra-table { min-width: 1600px; }

.empty-state { text-align: center; padding: 40px 20px; color: #6c757d; }
.empty-state .icon { font-size: 48px; margin-bottom: 15px; color: #dee2e6; }
.empty-state h5 { color: #495057; }

/* MODAL FIXED */
.modal.fixed-modal {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    z-index: 99999;
    background: rgba(0,0,0,0.6);
    display: none !important;
    padding: 20px;
    overflow-y: auto;
    align-items: center;
    justify-content: center;
}
.modal.fixed-modal.show { display: flex !important; }
.modal.fixed-modal .modal-dialog { margin: 0 auto; position: relative; width: 100%; max-width: 95%; max-height: calc(100vh - 40px); display: flex; flex-direction: column; }
.modal.fixed-modal .modal-content { max-height: calc(100vh - 40px); display: flex; flex-direction: column; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); background: #fff; }
.modal.fixed-modal .modal-header { flex-shrink: 0; border-radius: 8px 8px 0 0; padding: 15px 20px; background: #2e7d32; color: #fff; position: sticky; top: 0; z-index: 10; }
.modal.fixed-modal .modal-header .close { color: #fff; opacity: 0.8; font-size: 28px; background: transparent; border: none; padding: 0 10px; }
.modal.fixed-modal .modal-header .close:hover { opacity: 1; }
.modal.fixed-modal .modal-body { flex: 1; overflow-y: auto; padding: 20px; max-height: calc(100vh - 200px); }
.modal.fixed-modal .modal-footer { flex-shrink: 0; border-radius: 0 0 8px 8px; padding: 15px 20px; background: #f8f9fa; border-top: 1px solid #dee2e6; position: sticky; bottom: 0; z-index: 10; }
.modal.fixed-modal .modal-dialog.modal-xl-custom { max-width: 98%; width: 98%; }
.modal.fixed-modal.show .modal-dialog { animation: modalSlideIn 0.3s ease; }
@keyframes modalSlideIn {
    from { transform: translateY(-30px) scale(0.95); opacity: 0; }
    to { transform: translateY(0) scale(1); opacity: 1; }
}

/* OUTCOME & INDIKATOR DI MODAL */
.outcome-group {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 15px;
    position: relative;
}
.outcome-group .btn-remove-outcome {
    position: absolute;
    top: 8px;
    right: 8px;
    padding: 4px 12px;
    font-size: 16px;
    line-height: 1.2;
    min-width: 30px;
    min-height: 30px;
    border-radius: 5px;
    z-index: 10;
}
.outcome-group .outcome-textarea { resize: vertical; min-height: 50px; }

.indikator-row {
    background: #fff;
    padding: 30px 15px 10px 15px;
    border-radius: 5px;
    margin-bottom: 10px;
    border: 1px solid #dee2e6;
    position: relative;
}
.indikator-row .btn-remove-indikator {
    position: absolute;
    top: 8px;
    right: 8px;
    padding: 5px 12px;
    font-size: 16px;
    line-height: 1.2;
    min-width: 34px;
    min-height: 34px;
    border-radius: 5px;
    z-index: 10;
}
.indikator-row .form-control-sm { font-size: 12px; height: 30px; padding: 2px 8px; }
.indikator-row textarea.form-control-sm { height: 38px; resize: vertical; }
.btn-group-center { display: flex; justify-content: center; align-items: center; gap: 15px; margin-top: 20px; padding: 10px 0; }

/* NOMENKLATUR CASCADING */
.nomenklatur-container { padding: 10px 0; }
.breadcrumb-nomenklatur {
    background: #f8f9fa;
    padding: 8px 15px;
    border-radius: 4px;
    margin-bottom: 12px;
    border: 1px solid #dee2e6;
    font-size: 13px;
}
.breadcrumb-nomenklatur .badge-path {
    background: #007bff; color: #fff; padding: 3px 10px; border-radius: 4px; margin-right: 8px; font-size: 11px;
}
.cascading-select { margin-bottom: 10px; }
.cascading-select select { height: 38px; font-size: 13px; }
.cascading-select label { font-weight: 600; font-size: 12px; color: #495057; margin-bottom: 3px; }
.nomenklatur-info {
    background: #e8f0fe; padding: 10px 15px; border-radius: 4px; margin-top: 10px;
    border-left: 3px solid #007bff; display: none;
}
.nomenklatur-info strong { color: #1a5276; }

@media (max-width: 768px) {
    .filter-row { flex-direction:column; gap:15px; }
    .filter-select { width:100%; }
    .modal.fixed-modal .modal-dialog { max-height: calc(100vh - 20px); }
    .renstra-table { font-size: 9px; }
    .renstra-table th, .renstra-table td { padding: 2px 1px; }
}
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom:20px; background:#fff; padding:15px 20px; border-radius:6px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                                <div class="row filter-row" style="display:flex; align-items:flex-end; flex-wrap:wrap; gap:12px;">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
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
                                            <button class="btn btn-primary btn-block" id="Filter" style="font-weight:600;"><i class="fa fa-filter"></i> Filter</button>
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

                        <!-- FILTER INSTANSI -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom:20px;">
                                <div class="row filter-row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="filter-group">
                                            <label for="FilterInstansi"><b>Filter Instansi</b></label>
                                            <select class="form-control" id="FilterInstansi">
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
                                        <div class="filter-group" style="margin-top:28px;">
                                            <button class="btn btn-info btn-block" id="FilterInstansiBtn"><b>Tampilkan</b></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="filter-group" style="margin-top:28px;">
                                            <button class="btn btn-default btn-block" id="ResetFilterBtn"><b>Reset</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- INFO INSTANSI -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                                <br><small>Anda hanya dapat mengelola data milik instansi Anda sendiri.</small>
                            </div>
                        <?php } ?>

                        <!-- TOMBOL TAMBAH -->
                        <?php if ($IsRole4) { ?>
                            <div style="margin-bottom:20px;">
                                <button class="btn btn-success" id="btnTambahTujuan">
                                    <i class="fa fa-plus"></i> <b>Tambah Tujuan PD</b>
                                </button>
                            </div>
                        <?php } ?>

                        <!-- TABLE RENSTRA -->
                        <div class="table-card">
                            <div class="table-scroll">
                                <table class="renstra-table">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;">NO</th>
                                            <th style="width:25%;">TUJUAN / SASARAN / PROGRAM / OUTCOME</th>
                                            <th style="width:12%;">INDIKATOR</th>
                                            <th style="width:5%;">SATUAN</th>
                                            <th style="width:7%;">KONDISI AWAL</th>
                                            <th colspan="2" style="width:7%;">2026</th>
                                            <th colspan="2" style="width:7%;">2027</th>
                                            <th colspan="2" style="width:7%;">2028</th>
                                            <th colspan="2" style="width:7%;">2029</th>
                                            <th colspan="2" style="width:7%;">2030</th>
                                            <?php if ($IsRole4) { ?>
                                                <th style="width:5%;" class="col-aksi">AKSI</th>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <th></th><th></th><th></th><th></th><th></th>
                                            <th>TARGET</th><th>ANGGARAN</th>
                                            <th>TARGET</th><th>ANGGARAN</th>
                                            <th>TARGET</th><th>ANGGARAN</th>
                                            <th>TARGET</th><th>ANGGARAN</th>
                                            <th>TARGET</th><th>ANGGARAN</th>
                                            <?php if ($IsRole4) { ?>
                                                <th class="col-aksi"></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php if (!empty($RenstraData)) { 
                                             $no_tujuan = 1;
                                             foreach ($RenstraData as $tujuan) { 
                                                 $tujuan_id = $tujuan['id'] ?? 0;
                                                 $tujuan_uraian = $tujuan['uraian'] ?? '';
                                                 $tujuan_indikators = $tujuan['indikators'] ?? [];
                                                 $tujuanRowspan = count($tujuan_indikators) > 0 ? count($tujuan_indikators) : 1;
                                                 $firstIndTujuan = $tujuan_indikators[0] ?? null;
                                         ?>
                                             <!-- ROW TUJUAN (Baris Pertama) -->
                                             <tr class="row-tujuan border-tujuan">
                                                 <td class="cell-no" rowspan="<?= $tujuanRowspan ?>"><?= $no_tujuan ?></td>
                                                 <td class="text-left level-tujuan" rowspan="<?= $tujuanRowspan ?>">
                                                     <span class="badge-tujuan">Tujuan <?= $no_tujuan ?></span>
                                                     <strong><?= html_escape($tujuan_uraian) ?></strong>
                                                 </td>
                                                 <!-- INDIKATOR -->
                                                 <td class="indikator-text" style="text-align:left; padding-left:5px;"><?= html_escape($firstIndTujuan['indikator'] ?? ($tujuan['indikator'] ?? '-')) ?></td>
                                                 <!-- SATUAN -->
                                                 <td><?= html_escape($firstIndTujuan['satuan'] ?? ($tujuan['satuan'] ?? '-')) ?></td>
                                                 <!-- KONDISI AWAL -->
                                                 <td><?= html_escape($firstIndTujuan['kondisi_awal'] ?? ($tujuan['kondisi_awal'] ?? '-')) ?></td>
                                                 <!-- 2026 -->
                                                 <td><?= html_escape($firstIndTujuan['target_2026'] ?? ($tujuan['target_2026'] ?? '-')) ?></td>
                                                 <td class="pagu-col">-</td>
                                                 <!-- 2027 -->
                                                 <td><?= html_escape($firstIndTujuan['target_2027'] ?? ($tujuan['target_2027'] ?? '-')) ?></td>
                                                 <td class="pagu-col">-</td>
                                                 <!-- 2028 -->
                                                 <td><?= html_escape($firstIndTujuan['target_2028'] ?? ($tujuan['target_2028'] ?? '-')) ?></td>
                                                 <td class="pagu-col">-</td>
                                                 <!-- 2029 -->
                                                 <td><?= html_escape($firstIndTujuan['target_2029'] ?? ($tujuan['target_2029'] ?? '-')) ?></td>
                                                 <td class="pagu-col">-</td>
                                                 <!-- 2030 -->
                                                 <td><?= html_escape($firstIndTujuan['target_2030'] ?? ($tujuan['target_2030'] ?? '-')) ?></td>
                                                 <td class="pagu-col">-</td>
                                                 <?php if ($IsRole4) { ?>
                                                     <td class="col-aksi" rowspan="<?= $tujuanRowspan ?>">
                                                         <div class="btn-group-aksi">
                                                             <button class="btn btn-sm btn-success btn-aksi btnTambahSasaran" data-tujuan-id="<?= $tujuan_id ?>" title="Tambah Sasaran"><i class="fa fa-plus"></i></button>
                                                             <button class="btn btn-sm btn-warning btn-aksi btnEditTujuan" data-id="<?= $tujuan_id ?>" title="Edit Tujuan"><i class="fa fa-edit"></i></button>
                                                             <button class="btn btn-sm btn-danger btn-aksi btnHapusTujuan" data-id="<?= $tujuan_id ?>" title="Hapus Tujuan"><i class="fa fa-trash"></i></button>
                                                         </div>
                                                     </td>
                                                 <?php } ?>
                                             </tr>

                                             <?php 
                                             // Baris Indikator Tujuan ke-2, 3, dst
                                             if (count($tujuan_indikators) > 1) {
                                                 for ($ti = 1; $ti < count($tujuan_indikators); $ti++) {
                                                     $indT = $tujuan_indikators[$ti];
                                             ?>
                                                 <tr class="row-tujuan border-tujuan">
                                                     <td class="indikator-text" style="text-align:left; padding-left:5px;"><?= html_escape($indT['indikator'] ?? '-') ?></td>
                                                     <td><?= html_escape($indT['satuan'] ?? '-') ?></td>
                                                     <td><?= html_escape($indT['kondisi_awal'] ?? '-') ?></td>
                                                     <td><?= html_escape($indT['target_2026'] ?? '-') ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <td><?= html_escape($indT['target_2027'] ?? '-') ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <td><?= html_escape($indT['target_2028'] ?? '-') ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <td><?= html_escape($indT['target_2029'] ?? '-') ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <td><?= html_escape($indT['target_2030'] ?? '-') ?></td>
                                                     <td class="pagu-col">-</td>
                                                 </tr>
                                             <?php 
                                                 }
                                             }
                                             ?>

                                             <?php 
                                             $sasaran_list = $tujuan['sasaran_list'] ?? [];
                                             if (!empty($sasaran_list)) {
                                                 $no_sasaran = 1;
                                                 foreach ($sasaran_list as $sasaran) {
                                                     $sasaran_id = $sasaran['id'] ?? 0;
                                                     $sasaran_uraian = $sasaran['uraian'] ?? '';
                                                     $sasaran_indikators = $sasaran['indikators'] ?? [];
                                                     $sasaranRowspan = count($sasaran_indikators) > 0 ? count($sasaran_indikators) : 1;
                                                     $firstIndSasaran = $sasaran_indikators[0] ?? null;
                                             ?>
                                                 <!-- ROW SASARAN (Baris Pertama) -->
                                                 <tr class="row-sasaran border-sasaran">
                                                     <td class="cell-no" rowspan="<?= $sasaranRowspan ?>"><?= $no_tujuan . '.' . $no_sasaran ?></td>
                                                     <td class="text-left level-sasaran" rowspan="<?= $sasaranRowspan ?>">
                                                         <span class="badge-sasaran">Sasaran <?= $no_sasaran ?></span>
                                                         <?= html_escape($sasaran_uraian) ?>
                                                     </td>
                                                     <!-- INDIKATOR -->
                                                     <td class="indikator-text" style="text-align:left; padding-left:5px;"><?= html_escape($firstIndSasaran['indikator'] ?? ($sasaran['indikator'] ?? '-')) ?></td>
                                                     <!-- SATUAN -->
                                                     <td><?= html_escape($firstIndSasaran['satuan'] ?? ($sasaran['satuan'] ?? '-')) ?></td>
                                                     <!-- KONDISI AWAL -->
                                                     <td><?= html_escape($firstIndSasaran['kondisi_awal'] ?? ($sasaran['kondisi_awal'] ?? '-')) ?></td>
                                                     <!-- 2026 -->
                                                     <td><?= html_escape($firstIndSasaran['target_2026'] ?? ($sasaran['target_2026'] ?? '-')) ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <!-- 2027 -->
                                                     <td><?= html_escape($firstIndSasaran['target_2027'] ?? ($sasaran['target_2027'] ?? '-')) ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <!-- 2028 -->
                                                     <td><?= html_escape($firstIndSasaran['target_2028'] ?? ($sasaran['target_2028'] ?? '-')) ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <!-- 2029 -->
                                                     <td><?= html_escape($firstIndSasaran['target_2029'] ?? ($sasaran['target_2029'] ?? '-')) ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <!-- 2030 -->
                                                     <td><?= html_escape($firstIndSasaran['target_2030'] ?? ($sasaran['target_2030'] ?? '-')) ?></td>
                                                     <td class="pagu-col">-</td>
                                                     <?php if ($IsRole4) { ?>
                                                         <td class="col-aksi" rowspan="<?= $sasaranRowspan ?>">
                                                             <div class="btn-group-aksi">
                                                                 <button class="btn btn-sm btn-success btn-aksi btnTambahProgram" data-sasaran-id="<?= $sasaran_id ?>" title="Tambah Program"><i class="fa fa-plus"></i></button>
                                                                 <button class="btn btn-sm btn-warning btn-aksi btnEditSasaran" data-id="<?= $sasaran_id ?>" title="Edit Sasaran"><i class="fa fa-edit"></i></button>
                                                                 <button class="btn btn-sm btn-danger btn-aksi btnHapusSasaran" data-id="<?= $sasaran_id ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>
                                                             </div>
                                                         </td>
                                                     <?php } ?>
                                                 </tr>

                                                 <?php 
                                                 // Baris Indikator Sasaran ke-2, 3, dst
                                                 if (count($sasaran_indikators) > 1) {
                                                     for ($si = 1; $si < count($sasaran_indikators); $si++) {
                                                         $indS = $sasaran_indikators[$si];
                                                 ?>
                                                     <tr class="row-sasaran border-sasaran">
                                                         <td class="indikator-text" style="text-align:left; padding-left:5px;"><?= html_escape($indS['indikator'] ?? '-') ?></td>
                                                         <td><?= html_escape($indS['satuan'] ?? '-') ?></td>
                                                         <td><?= html_escape($indS['kondisi_awal'] ?? '-') ?></td>
                                                         <td><?= html_escape($indS['target_2026'] ?? '-') ?></td>
                                                         <td class="pagu-col">-</td>
                                                         <td><?= html_escape($indS['target_2027'] ?? '-') ?></td>
                                                         <td class="pagu-col">-</td>
                                                         <td><?= html_escape($indS['target_2028'] ?? '-') ?></td>
                                                         <td class="pagu-col">-</td>
                                                         <td><?= html_escape($indS['target_2029'] ?? '-') ?></td>
                                                         <td class="pagu-col">-</td>
                                                         <td><?= html_escape($indS['target_2030'] ?? '-') ?></td>
                                                         <td class="pagu-col">-</td>
                                                     </tr>
                                                 <?php 
                                                     }
                                                 }
                                                 ?>
                                                <?php
                                                $program_list = $sasaran['program_list'] ?? [];
                                                if (!empty($program_list)) {
                                                    $no_program = 1;
                                                    foreach ($program_list as $program) {
                                                        $program_id = $program['id'] ?? 0;
                                                        $program_nama = preg_replace('/^(\d+(\.\d+)*)\s*[-–—:]?\s*/', '', $program['nama'] ?? '');
                                                        $program_kode = $program['kode_program'] ?? '';
                                                        $outcomes = $program['outcomes'] ?? [];
                                                        $kegiatan_list = $program['kegiatan_list'] ?? [];
                                                        
                                                        // ==========================================================
                                                        // HITUNG TOTAL ANGGARAN PROGRAM DARI SELURUH KEGIATAN
                                                        // ==========================================================
                                                        $totalAnggaranProgram = hitungTotalAnggaranProgram($program);

                                                        // Hitung total indikator
                                                        $totalIndikator = 0;
                                                        foreach ($outcomes as $out) {
                                                            $totalIndikator += count($out['indikator_list'] ?? []);
                                                        }

                                                        // Jika tidak ada indikator sama sekali
                                                        if ($totalIndikator == 0 && empty($kegiatan_list)) {
                                                            ?>
                                                            <tr class="row-program border-program">
                                                                <td class="cell-no"><?= !empty($program_kode) ? html_escape($program_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program) ?></td>
                                                                <td class="text-left level-program">
                                                                    <span class="nama-program"><?= html_escape($program_nama) ?></span>
                                                                </td>
                                                                <td colspan="13" style="text-align:center; color:#999;">Tidak ada outcome/indikator</td>
                                                                <?php if ($IsRole4) { ?>
                                                                    <td class="col-aksi">
                                                                        <div class="btn-group-aksi">
                                                                            <button class="btn btn-sm btn-primary btn-aksi btnTambahKegiatan" data-program-id="<?= $program_id ?>" title="Tambah Kegiatan"><i class="fa fa-plus"></i></button>
                                                                            <button class="btn btn-sm btn-warning btn-aksi btnEditProgram" data-id="<?= $program_id ?>" title="Edit Program"><i class="fa fa-edit"></i></button>
                                                                            <button class="btn btn-sm btn-danger btn-aksi btnHapusProgram" data-id="<?= $program_id ?>" title="Hapus Program"><i class="fa fa-trash"></i></button>
                                                                            
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                            <?php
                                                            $no_program++;
                                                            continue;
                                                        }

                                                        // Tampilkan PROGRAM + OUTCOME + INDIKATOR pertama
                                                        $isFirstOutcome = true;
                                                        $outcomeIndex = 0;

                                                        // Hitung total indikator untuk program
                                                        $totalIndikatorProgram = 0;
                                                        $allIndikators = [];
                                                        foreach ($outcomes as $out) {
                                                            $indikator_list = $out['indikator_list'] ?? [];
                                                            $totalIndikatorProgram += count($indikator_list);
                                                            foreach ($indikator_list as $ind) {
                                                                $allIndikators[] = $ind;
                                                            }
                                                        }

                                                        // Jika tidak ada indikator sama sekali
                                                        if ($totalIndikatorProgram == 0 && empty($kegiatan_list)) {
                                                            ?>
                                                            <tr class="row-program border-program">
                                                                <td class="cell-no"><?= !empty($program_kode) ? html_escape($program_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program) ?></td>
                                                                <td class="text-left level-program">
                                                                    <span class="nama-program"><?= html_escape($program_nama) ?></span>
                                                                </td>
                                                                <td colspan="13" style="text-align:center; color:#999;">Tidak ada outcome/indikator</td>
                                                                <?php if ($IsRole4) { ?>
                                                                    <td class="col-aksi">
                                                                        <div class="btn-group-aksi">
                                                                            <button class="btn btn-sm btn-primary btn-aksi btnTambahKegiatan" data-program-id="<?= $program_id ?>" title="Tambah Kegiatan"><i class="fa fa-plus"></i></button>
                                                                            <button class="btn btn-sm btn-warning btn-aksi btnEditProgram" data-id="<?= $program_id ?>" title="Edit Program"><i class="fa fa-edit"></i></button>
                                                                            <button class="btn btn-sm btn-danger btn-aksi btnHapusProgram" data-id="<?= $program_id ?>" title="Hapus Program"><i class="fa fa-trash"></i></button>
                                                                            
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                            <?php
                                                            $no_program++;
                                                            continue;
                                                        }

                                                        // ============================================================
                                                        // TAMPILKAN PROGRAM + OUTCOME + INDIKATOR DENGAN ROWSPAN
                                                        // ============================================================

                                                        // Penanda untuk menampilkan Program hanya sekali
                                                        $isFirstRow = true;
                                                        $isFirstProgramRow = true; // untuk menampilkan total anggaran program

                                                        foreach ($outcomes as $outIndex => $outcome) {
                                                            $indikator_list = $outcome['indikator_list'] ?? [];
                                                            
                                                             // Lewati outcome tanpa indikator
                                                            if (empty($indikator_list)) {
                                                                continue;
                                                            }
                                                            
                                                            $outcomeRowspan = count($indikator_list);
                                                            $firstIndikator = $indikator_list[0];
                                                            ?>
                                                            
                                                            <!-- BARIS OUTCOME + INDIKATOR PERTAMA -->
                                                            <tr class="row-outcome border-outcome">
                                                                <!-- NOMOR - HANYA SEKALI PER PROGRAM -->
                                                                <?php if ($isFirstRow) { ?>
                                                                    <td class="cell-no" rowspan="<?= $totalIndikatorProgram ?>">
                                                                        <?= !empty($program_kode) ? html_escape($program_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program) ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <!-- PROGRAM + OUTCOME - SATU KOLOM -->
                                                                <td class="text-left" style="padding-left:45px;" rowspan="<?= $outcomeRowspan ?>">
                                                                    <?php if ($isFirstRow) { ?>
                                                                        <!-- PROGRAM (hanya muncul di baris pertama) -->
                                                                        <div class="program-title" style="margin-bottom:5px;">
                                                                            <span class="nama-program"><?= html_escape($program_nama) ?></span>
                                                                        </div>
                                                                    <?php } ?>
                                                                    
                                                                    <!-- OUTCOME (muncul di setiap baris pertama tiap outcome) -->
                                                                    <div class="outcome-title" style="margin-top:<?= $isFirstRow ? '3px' : '0' ?>;">
                                                                        <span class="badge-outcome">Sasaran <?= $outcomeIndex+1 ?></span>
                                                                        <?= html_escape($outcome['outcome_text']) ?>
                                                                    </div>
                                                                </td>
                                                                
                                                                <!-- INDIKATOR PERTAMA -->
                                                                <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                    <?= html_escape($firstIndikator['indikator'] ?? '-') ?>
                                                                </td>
                                                                
                                                                <!-- SATUAN -->
                                                                <td><?= html_escape($firstIndikator['satuan'] ?? '-') ?></td>
                                                                
                                                                <!-- KONDISI AWAL -->
                                                                <td><?= html_escape($firstIndikator['kondisi_awal'] ?? '-') ?></td>
                                                                
                                                                <!-- 2026 -->
                                                                <td><?= html_escape($firstIndikator['target_2026'] ?? '-') ?></td>
                                                                <?php if ($isFirstRow) { ?>
                                                                    <td class="pagu-col" rowspan="<?= $totalIndikatorProgram ?>">
                                                                        <?php if (!empty($totalAnggaranProgram['2026'])): ?>
                                                                            <?= number_format($totalAnggaranProgram['2026'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <!-- 2027 -->
                                                                <td><?= html_escape($firstIndikator['target_2027'] ?? '-') ?></td>
                                                                <?php if ($isFirstRow) { ?>
                                                                    <td class="pagu-col" rowspan="<?= $totalIndikatorProgram ?>">
                                                                        <?php if (!empty($totalAnggaranProgram['2027'])): ?>
                                                                            <?= number_format($totalAnggaranProgram['2027'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <!-- 2028 -->
                                                                <td><?= html_escape($firstIndikator['target_2028'] ?? '-') ?></td>
                                                                <?php if ($isFirstRow) { ?>
                                                                    <td class="pagu-col" rowspan="<?= $totalIndikatorProgram ?>">
                                                                        <?php if (!empty($totalAnggaranProgram['2028'])): ?>
                                                                            <?= number_format($totalAnggaranProgram['2028'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <!-- 2029 -->
                                                                <td><?= html_escape($firstIndikator['target_2029'] ?? '-') ?></td>
                                                                <?php if ($isFirstRow) { ?>
                                                                    <td class="pagu-col" rowspan="<?= $totalIndikatorProgram ?>">
                                                                        <?php if (!empty($totalAnggaranProgram['2029'])): ?>
                                                                            <?= number_format($totalAnggaranProgram['2029'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <!-- 2030 -->
                                                                <td><?= html_escape($firstIndikator['target_2030'] ?? '-') ?></td>
                                                                <?php if ($isFirstRow) { ?>
                                                                    <td class="pagu-col" rowspan="<?= $totalIndikatorProgram ?>">
                                                                        <?php if (!empty($totalAnggaranProgram['2030'])): ?>
                                                                            <?= number_format($totalAnggaranProgram['2030'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <?php } ?>
                                                                
                                                                <!-- AKSI PROGRAM - ROWSPAN TOTAL INDIKATOR -->
                                                                <?php if ($IsRole4 && $isFirstRow) { ?>
                                                                    <td class="col-aksi" rowspan="<?= $totalIndikatorProgram ?>">
                                                                        <div class="btn-group-aksi">
                                                                            <button class="btn btn-sm btn-primary btn-aksi btnTambahKegiatan" data-program-id="<?= $program_id ?>" title="Tambah Kegiatan"><i class="fa fa-plus"></i></button>
                                                                            <button class="btn btn-sm btn-warning btn-aksi btnEditProgram" data-id="<?= $program_id ?>" title="Edit Program"><i class="fa fa-edit"></i></button>
                                                                            <button class="btn btn-sm btn-danger btn-aksi btnHapusProgram" data-id="<?= $program_id ?>" title="Hapus Program"><i class="fa fa-trash"></i></button>
                                                                            
                                                                        </div>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                            
                                                            <?php
                                                            // ============================================================
                                                            // INDIKATOR KE-2, KE-3, DST UNTUK OUTCOME YANG SAMA
                                                            // ============================================================
                                                            if (count($indikator_list) > 1) {
                                                                for ($i = 1; $i < count($indikator_list); $i++) {
                                                                    $indikator = $indikator_list[$i];
                                                                    ?>
                                                                    <tr class="row-indikator border-indikator">
                                                                        <!-- INDIKATOR -->
                                                                        <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                            <?= html_escape($indikator['indikator'] ?? '-') ?>
                                                                        </td>
                                                                        
                                                                        <!-- SATUAN -->
                                                                        <td><?= html_escape($indikator['satuan'] ?? '-') ?></td>
                                                                        
                                                                        <!-- KONDISI AWAL -->
                                                                        <td><?= html_escape($indikator['kondisi_awal'] ?? '-') ?></td>
                                                                        
                                                                        <!-- 2026 -->
                                                                        <td><?= html_escape($indikator['target_2026'] ?? '-') ?></td>
                                                                        
                                                                        <!-- 2027 -->
                                                                        <td><?= html_escape($indikator['target_2027'] ?? '-') ?></td>
                                                                        
                                                                        <!-- 2028 -->
                                                                        <td><?= html_escape($indikator['target_2028'] ?? '-') ?></td>
                                                                        
                                                                        <!-- 2029 -->
                                                                        <td><?= html_escape($indikator['target_2029'] ?? '-') ?></td>
                                                                        
                                                                        <!-- 2030 -->
                                                                        <td><?= html_escape($indikator['target_2030'] ?? '-') ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            
                                                            // Reset flag setelah baris pertama
                                                            $isFirstRow = false;
                                                            $isFirstProgramRow = false;
                                                            $outcomeIndex++;
                                                        }

                                                        // ============================================================
                                                        // TAMPILKAN KEGIATAN DENGAN MULTIPLE SASARAN & INDIKATOR
                                                        // ============================================================
                                                        if (!empty($kegiatan_list)) {

                                                        $no_kegiatan = 1;

                                                        foreach ($kegiatan_list as $kegiatan) {

                                                            $kegiatan_id   = $kegiatan['id'] ?? 0;
                                                            $kegiatan_nama = preg_replace('/^(\d+(\.\d+)*)\s*[-–—:]?\s*/', '', $kegiatan['nama'] ?? '');
                                                            $kegiatan_kode = $kegiatan['kode_nomenklatur'] ?? ($kegiatan['kode_kegiatan'] ?? '');

                                                            $kegiatan_sasaran_list = $kegiatan['sasaran_list'] ?? [];
                                                            $sub_kegiatan_list     = $kegiatan['sub_kegiatan_list'] ?? [];

                                                            // ==========================================================
                                                            // HITUNG TOTAL ANGGARAN KEGIATAN DARI SELURUH SUB KEGIATAN
                                                            // ==========================================================
                                                            $totalAnggaranKegiatan = hitungTotalAnggaranKegiatan([$kegiatan]);

                                                            // ========================================================
                                                            // JIKA KEGIATAN TIDAK MEMILIKI SASARAN
                                                            // ========================================================

                                                            if (empty($kegiatan_sasaran_list)) {
                                                                ?>
                                                                <tr class="row-kegiatan border-kegiatan">
                                                                    <td class="cell-no">
                                                                        <?= !empty($kegiatan_kode) ? html_escape($kegiatan_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program . '.' . $no_kegiatan) ?>
                                                                    </td>
                                                                    <td class="text-left level-kegiatan">
                                                                        <?= html_escape($kegiatan_nama) ?>
                                                                    </td>
                                                                    <td colspan="15" style="color:#999;">
                                                                        Tidak ada sasaran/indikator
                                                                    </td>
                                                                    <?php if ($IsRole4) { ?>
                                                                        <td class="col-aksi">
                                                                            <div class="btn-group-aksi">
                                                                                <button class="btn btn-sm btn-success btn-aksi btnTambahSubKegiatan" data-kegiatan-id="<?= $kegiatan_id ?>" title="Tambah Sub Kegiatan"><i class="fa fa-plus"></i></button>
                                                                                <button class="btn btn-sm btn-warning btn-aksi btnEditKegiatan" data-id="<?= $kegiatan_id ?>" title="Edit Kegiatan"><i class="fa fa-edit"></i></button>
                                                                                <button class="btn btn-sm btn-danger btn-aksi btnHapusKegiatan" data-id="<?= $kegiatan_id ?>" title="Hapus Kegiatan"><i class="fa fa-trash"></i></button>
                                                                            </div>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php
                                                                $no_kegiatan++;
                                                                continue;
                                                            }

                                                            // ========================================================
                                                            // HITUNG TOTAL BARIS SELURUH SASARAN
                                                            // ========================================================

                                                            $kegiatanTotalRows = 0;
                                                            foreach ($kegiatan_sasaran_list as $ks) {
                                                                $indikators = $ks['indikators'] ?? [];
                                                                if (!empty($indikators)) {
                                                                    $kegiatanTotalRows += count($indikators);
                                                                }
                                                            }

                                                            // Jika semua sasaran tidak punya indikator
                                                            if ($kegiatanTotalRows == 0) {
                                                                ?>
                                                                <tr class="row-kegiatan border-kegiatan">
                                                                    <td class="cell-no">
                                                                        <?= !empty($kegiatan_kode) ? html_escape($kegiatan_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program . '.' . $no_kegiatan) ?>
                                                                    </td>
                                                                    <td class="text-left level-kegiatan">
                                                                        <?= html_escape($kegiatan_nama) ?>
                                                                    </td>
                                                                    <td colspan="15" style="color:#999;">
                                                                        Tidak ada indikator
                                                                    </td>
                                                                    <?php if ($IsRole4) { ?>
                                                                        <td class="col-aksi">
                                                                            <div class="btn-group-aksi">
                                                                                <button class="btn btn-sm btn-success btn-aksi btnTambahSubKegiatan" data-kegiatan-id="<?= $kegiatan_id ?>"><i class="fa fa-plus"></i></button>
                                                                                <button class="btn btn-sm btn-warning btn-aksi btnEditKegiatan" data-id="<?= $kegiatan_id ?>"><i class="fa fa-edit"></i></button>
                                                                                <button class="btn btn-sm btn-danger btn-aksi btnHapusKegiatan" data-id="<?= $kegiatan_id ?>"><i class="fa fa-trash"></i></button>
                                                                            </div>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php
                                                                $no_kegiatan++;
                                                                continue;
                                                            }

                                                            // ========================================================
                                                            // LOOP SASARAN KEGIATAN
                                                            // ========================================================

                                                            $firstSasaran = true;
                                                            $isFirstKegiatanRow = true; // untuk menampilkan total anggaran kegiatan

                                                            foreach ($kegiatan_sasaran_list as $ksIndex => $ks) {

                                                                $indikators_ks = $ks['indikators'] ?? [];

                                                                // Lewati sasaran yang tidak memiliki indikator
                                                                if (empty($indikators_ks)) {
                                                                    continue;
                                                                }

                                                                // Jumlah indikator untuk SASARAN INI
                                                                $ksRowspan = count($indikators_ks);

                                                                // ====================================================
                                                                // INDIKATOR PERTAMA
                                                                // ====================================================

                                                                $firstIndKeg = $indikators_ks[0];

                                                                // ====================================================
                                                                // BARIS PERTAMA SASARAN
                                                                // ====================================================

                                                                ?>
                                                                <tr class="row-kegiatan-sasaran border-kegiatan-sasaran">

                                                                    <!-- =================================================
                                                                        NOMOR KEGIATAN
                                                                        HANYA SEKALI
                                                                        ================================================= -->

                                                                    <?php if ($firstSasaran) { ?>
                                                                        <td class="cell-no" rowspan="<?= $kegiatanTotalRows ?>">
                                                                            <?= !empty($kegiatan_kode) ? html_escape($kegiatan_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program . '.' . $no_kegiatan) ?>
                                                                        </td>
                                                                    <?php } ?>

                                                                    <!-- =================================================
                                                                        KEGIATAN + SASARAN
                                                                        SATU KOLOM
                                                                        ================================================= -->

                                                                    <td class="text-left level-kegiatan-sasaran" rowspan="<?= $ksRowspan ?>">

                                                                        <?php if ($firstSasaran) { ?>
                                                                            <!-- KEGIATAN -->
                                                                            <div class="kegiatan-title">
                                                                                <?= html_escape($kegiatan_nama) ?>
                                                                            </div>
                                                                            <!-- SASARAN 1 -->
                                                                            <div class="sasaran-title">
                                                                                <span class="badge-kegiatan-sasaran">Sasaran <?= $ksIndex + 1 ?></span>
                                                                                <?= html_escape($ks['sasaran_text'] ?? '') ?>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <!-- SASARAN 2, 3, DST -->
                                                                            <div class="sasaran-title">
                                                                                <span class="badge-kegiatan-sasaran">Sasaran <?= $ksIndex + 1 ?></span>
                                                                                <?= html_escape($ks['sasaran_text'] ?? '') ?>
                                                                            </div>
                                                                        <?php } ?>

                                                                    </td>

                                                                    <!-- =================================================
                                                                        INDIKATOR
                                                                        ================================================= -->

                                                                    <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                        <?= html_escape($firstIndKeg['indikator'] ?? '-') ?>
                                                                    </td>

                                                                    <!-- SATUAN -->
                                                                    <td><?= html_escape($firstIndKeg['satuan'] ?? '-') ?></td>

                                                                    <!-- KONDISI AWAL -->
                                                                    <td><?= html_escape($firstIndKeg['kondisi_awal'] ?? '-') ?></td>

                                                                    <!-- 2026 -->
                                                                    <td><?= html_escape($firstIndKeg['target_2026'] ?? '-') ?></td>
                                                                    <td class="pagu-col">
                                                                        <?php if ($isFirstKegiatanRow && !empty($totalAnggaranKegiatan['2026'])): ?>
                                                                            <?= number_format($totalAnggaranKegiatan['2026'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <!-- 2027 -->
                                                                    <td><?= html_escape($firstIndKeg['target_2027'] ?? '-') ?></td>
                                                                    <td class="pagu-col">
                                                                        <?php if ($isFirstKegiatanRow && !empty($totalAnggaranKegiatan['2027'])): ?>
                                                                            <?= number_format($totalAnggaranKegiatan['2027'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <!-- 2028 -->
                                                                    <td><?= html_escape($firstIndKeg['target_2028'] ?? '-') ?></td>
                                                                    <td class="pagu-col">
                                                                        <?php if ($isFirstKegiatanRow && !empty($totalAnggaranKegiatan['2028'])): ?>
                                                                            <?= number_format($totalAnggaranKegiatan['2028'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <!-- 2029 -->
                                                                    <td><?= html_escape($firstIndKeg['target_2029'] ?? '-') ?></td>
                                                                    <td class="pagu-col">
                                                                        <?php if ($isFirstKegiatanRow && !empty($totalAnggaranKegiatan['2029'])): ?>
                                                                            <?= number_format($totalAnggaranKegiatan['2029'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <!-- 2030 -->
                                                                    <td><?= html_escape($firstIndKeg['target_2030'] ?? '-') ?></td>
                                                                    <td class="pagu-col">
                                                                        <?php if ($isFirstKegiatanRow && !empty($totalAnggaranKegiatan['2030'])): ?>
                                                                            <?= number_format($totalAnggaranKegiatan['2030'], 0, ',', '.') ?>
                                                                        <?php else: ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <!-- =================================================
                                                                        AKSI KEGIATAN
                                                                        ================================================= -->

                                                                    <?php if ($firstSasaran && $IsRole4) { ?>
                                                                        <td class="col-aksi" rowspan="<?= $kegiatanTotalRows ?>">
                                                                            <div class="btn-group-aksi">
                                                                                <button class="btn btn-sm btn-success btn-aksi btnTambahSubKegiatan" data-kegiatan-id="<?= $kegiatan_id ?>" title="Tambah Sub Kegiatan"><i class="fa fa-plus"></i></button>
                                                                                <button class="btn btn-sm btn-warning btn-aksi btnEditKegiatan" data-id="<?= $kegiatan_id ?>" title="Edit Kegiatan"><i class="fa fa-edit"></i></button>
                                                                                <button class="btn btn-sm btn-danger btn-aksi btnHapusKegiatan" data-id="<?= $kegiatan_id ?>" title="Hapus Kegiatan"><i class="fa fa-trash"></i></button>
                                                                            </div>
                                                                        </td>
                                                                    <?php } ?>

                                                                </tr>

                                                                <?php

                                                                // ====================================================
                                                                // INDIKATOR KE-2, KE-3, DST
                                                                // ====================================================

                                                                if (count($indikators_ks) > 1) {
                                                                    for ($i = 1; $i < count($indikators_ks); $i++) {
                                                                        $ind = $indikators_ks[$i];
                                                                        ?>
                                                                        <tr class="row-indikator border-indikator">
                                                                            <!-- INDIKATOR -->
                                                                            <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                                <?= html_escape($ind['indikator'] ?? '-') ?>
                                                                            </td>
                                                                            <!-- SATUAN -->
                                                                            <td><?= html_escape($ind['satuan'] ?? '-') ?></td>
                                                                            <!-- KONDISI AWAL -->
                                                                            <td><?= html_escape($ind['kondisi_awal'] ?? '-') ?></td>
                                                                            <!-- 2026 -->
                                                                            <td><?= html_escape($ind['target_2026'] ?? '-') ?></td>
                                                                            <td class="pagu-col">-</td>
                                                                            <!-- 2027 -->
                                                                            <td><?= html_escape($ind['target_2027'] ?? '-') ?></td>
                                                                            <td class="pagu-col">-</td>
                                                                            <!-- 2028 -->
                                                                            <td><?= html_escape($ind['target_2028'] ?? '-') ?></td>
                                                                            <td class="pagu-col">-</td>
                                                                            <!-- 2029 -->
                                                                            <td><?= html_escape($ind['target_2029'] ?? '-') ?></td>
                                                                            <td class="pagu-col">-</td>
                                                                            <!-- 2030 -->
                                                                            <td><?= html_escape($ind['target_2030'] ?? '-') ?></td>
                                                                            <td class="pagu-col">-</td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }

                                                                // Sasaran berikutnya
                                                                $firstSasaran = false;
                                                                $isFirstKegiatanRow = false;
                                                            }

                                                            // ============================================================
                                                            // TAMPILKAN SUB KEGIATAN
                                                            // ============================================================

                                                            $no_sub = 1;

                                                            foreach ($sub_kegiatan_list as $sub) {

                                                                $sub_id   = $sub['id'] ?? 0;
                                                                $sub_nama = preg_replace('/^(\d+(\.\d+)*)\s*[-–—:]?\s*/', '', $sub['nama'] ?? '');
                                                                $sub_kode = $sub['kode_nomenklatur'] ?? ($sub['kode_sub_kegiatan'] ?? ($sub['kode_subkegiatan'] ?? ''));

                                                                $sub_sasaran_list = $sub['sasaran_list'] ?? [];

                                                                // ========================================================
                                                                // JIKA SUB KEGIATAN TIDAK MEMILIKI SASARAN
                                                                // ========================================================

                                                                if (empty($sub_sasaran_list)) {
                                                                    ?>
                                                                    <tr class="row-subkegiatan border-subkegiatan">
                                                                        <!-- NOMOR -->
                                                                        <td class="cell-no">
                                                                            <?= !empty($sub_kode) ? html_escape($sub_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program . '.' . $no_kegiatan . '.' . $no_sub) ?>
                                                                        </td>
                                                                        <!-- SUB KEGIATAN -->
                                                                        <td class="text-left level-subkegiatan">
                                                                            <div class="subkegiatan-title">
                                                                                <?= html_escape($sub_nama) ?>
                                                                            </div>
                                                                        </td>
                                                                        <!-- KOLOM LAIN -->
                                                                        <td colspan="15" style="color:#999;">
                                                                            Tidak ada sasaran/indikator
                                                                        </td>
                                                                        <!-- AKSI -->
                                                                        <?php if ($IsRole4) { ?>
                                                                            <td class="col-aksi">
                                                                                <div class="btn-group-aksi">
                                                                                    <button class="btn btn-sm btn-warning btn-aksi btnEditSubKegiatan" data-id="<?= $sub_id ?>" title="Edit Sub Kegiatan"><i class="fa fa-edit"></i></button>
                                                                                    <button class="btn btn-sm btn-danger btn-aksi btnHapusSubKegiatan" data-id="<?= $sub_id ?>" title="Hapus Sub Kegiatan"><i class="fa fa-trash"></i></button>
                                                                                </div>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php
                                                                    $no_sub++;
                                                                    continue;
                                                                }

                                                                // ========================================================
                                                                // HITUNG TOTAL BARIS SELURUH SASARAN
                                                                // ========================================================

                                                                $subTotalRows = 0;

                                                                foreach ($sub_sasaran_list as $ss) {
                                                                    $indikators = $ss['indikators'] ?? [];
                                                                    if (!empty($indikators)) {
                                                                        $subTotalRows += count($indikators);
                                                                    }
                                                                }

                                                                // ========================================================
                                                                // JIKA SASARAN ADA TAPI TIDAK MEMILIKI INDIKATOR
                                                                // ========================================================

                                                                if ($subTotalRows == 0) {
                                                                    ?>
                                                                    <tr class="row-subkegiatan border-subkegiatan">
                                                                        <!-- NOMOR -->
                                                                        <td class="cell-no">
                                                                            <?= !empty($sub_kode) ? html_escape($sub_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program . '.' . $no_kegiatan . '.' . $no_sub) ?>
                                                                        </td>
                                                                        <!-- SUB KEGIATAN -->
                                                                        <td class="text-left level-subkegiatan">
                                                                            <div class="subkegiatan-title">
                                                                                <?= html_escape($sub_nama) ?>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="15" style="color:#999;">
                                                                            Tidak ada indikator
                                                                        </td>
                                                                        <?php if ($IsRole4) { ?>
                                                                            <td class="col-aksi">
                                                                                <div class="btn-group-aksi">
                                                                                    <button class="btn btn-sm btn-warning btn-aksi btnEditSubKegiatan" data-id="<?= $sub_id ?>"><i class="fa fa-edit"></i></button>
                                                                                    <button class="btn btn-sm btn-danger btn-aksi btnHapusSubKegiatan" data-id="<?= $sub_id ?>"><i class="fa fa-trash"></i></button>
                                                                                </div>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <?php
                                                                    $no_sub++;
                                                                    continue;
                                                                }

                                                                // ========================================================
                                                                // PENANDA SASARAN PERTAMA
                                                                // ========================================================

                                                                $firstSubSasaran = true;

                                                                // ========================================================
                                                                // LOOP SASARAN SUB KEGIATAN
                                                                // ========================================================

                                                                foreach ($sub_sasaran_list as $ssIndex => $ss) {

                                                                    $indikators_ss = $ss['indikators'] ?? [];

                                                                    // Lewati sasaran tanpa indikator
                                                                    if (empty($indikators_ss)) {
                                                                        continue;
                                                                    }

                                                                    // ====================================================
                                                                    // JUMLAH INDIKATOR UNTUK SASARAN INI
                                                                    // ====================================================

                                                                    $ssRowspan = count($indikators_ss);

                                                                    // ====================================================
                                                                    // INDIKATOR PERTAMA
                                                                    // ====================================================

                                                                    $firstIndSub = $indikators_ss[0];

                                                                    // ====================================================
                                                                    // BARIS PERTAMA SASARAN
                                                                    // ====================================================

                                                                    ?>
                                                                    <tr class="row-subkegiatan-sasaran border-subkegiatan-sasaran">

                                                                        <!-- =================================================
                                                                            NOMOR SUB KEGIATAN
                                                                            SATU KALI UNTUK SELURUH SUB KEGIATAN
                                                                            ================================================= -->

                                                                        <?php if ($firstSubSasaran) { ?>
                                                                            <td class="cell-no" rowspan="<?= $subTotalRows ?>">
                                                                                <?= !empty($sub_kode) ? html_escape($sub_kode) : ($no_tujuan . '.' . $no_sasaran . '.' . $no_program . '.' . $no_kegiatan . '.' . $no_sub) ?>
                                                                            </td>
                                                                        <?php } ?>

                                                                        <!-- =================================================
                                                                            SUB KEGIATAN + SASARAN
                                                                            DALAM 1 KOLOM
                                                                            ================================================= -->

                                                                        <td class="text-left level-subkegiatan-sasaran" rowspan="<?= $ssRowspan ?>">

                                                                            <?php if ($firstSubSasaran) { ?>
                                                                                <!-- =========================================
                                                                                    SUB KEGIATAN
                                                                                    ========================================= -->
                                                                                <div class="subkegiatan-title">
                                                                                    <?= html_escape($sub_nama) ?>
                                                                                </div>
                                                                            <?php } ?>

                                                                            <!-- =============================================
                                                                                SASARAN SUB KEGIATAN
                                                                                SASARAN 1, 2, 3, DST
                                                                                ============================================= -->

                                                                            <div class="sasaran-subkegiatan-title">
                                                                                <span class="badge-subkegiatan-sasaran">Sasaran <?= $ssIndex + 1 ?></span>
                                                                                <?= html_escape($ss['sasaran_text'] ?? '') ?>
                                                                            </div>

                                                                        </td>

                                                                        <!-- =================================================
                                                                            INDIKATOR PERTAMA
                                                                            ================================================= -->

                                                                        <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                            <?= html_escape($firstIndSub['indikator'] ?? '-') ?>
                                                                        </td>

                                                                        <!-- =================================================
                                                                            SATUAN
                                                                            ================================================= -->

                                                                        <td><?= html_escape($firstIndSub['satuan'] ?? '-') ?></td>

                                                                        <!-- =================================================
                                                                            KONDISI AWAL
                                                                            ================================================= -->

                                                                        <td><?= html_escape($firstIndSub['kondisi_awal'] ?? '-') ?></td>

                                                                        <!-- =================================================
                                                                            2026
                                                                            ================================================= -->

                                                                        <td><?= html_escape($firstIndSub['target_2026'] ?? '-') ?></td>
                                                                        <td class="pagu-col">
                                                                            <?= !empty($firstIndSub['anggaran_2026']) ? number_format($firstIndSub['anggaran_2026'], 0, ',', '.') : '-' ?>
                                                                        </td>

                                                                        <!-- =================================================
                                                                            2027
                                                                            ================================================= -->

                                                                        <td><?= html_escape($firstIndSub['target_2027'] ?? '-') ?></td>
                                                                        <td class="pagu-col">
                                                                            <?= !empty($firstIndSub['anggaran_2027']) ? number_format($firstIndSub['anggaran_2027'], 0, ',', '.') : '-' ?>
                                                                        </td>

                                                                        <!-- =================================================
                                                                            2028
                                                                            ================================================= -->

                                                                        <td><?= html_escape($firstIndSub['target_2028'] ?? '-') ?></td>
                                                                        <td class="pagu-col">
                                                                            <?= !empty($firstIndSub['anggaran_2028']) ? number_format($firstIndSub['anggaran_2028'], 0, ',', '.') : '-' ?>
                                                                        </td>

                                                                        <!-- =================================================
                                                                            2029
                                                                            ================================================= -->

                                                                        <td><?= html_escape($firstIndSub['target_2029'] ?? '-') ?></td>
                                                                        <td class="pagu-col">
                                                                            <?= !empty($firstIndSub['anggaran_2029']) ? number_format($firstIndSub['anggaran_2029'], 0, ',', '.') : '-' ?>
                                                                        </td>

                                                                        <!-- =================================================
                                                                            2030
                                                                            ================================================= -->

                                                                        <td><?= html_escape($firstIndSub['target_2030'] ?? '-') ?></td>
                                                                        <td class="pagu-col">
                                                                            <?= !empty($firstIndSub['anggaran_2030']) ? number_format($firstIndSub['anggaran_2030'], 0, ',', '.') : '-' ?>
                                                                        </td>

                                                                        <!-- =================================================
                                                                            AKSI SUB KEGIATAN
                                                                            HANYA SEKALI UNTUK SELURUH SUB KEGIATAN
                                                                            ================================================= -->

                                                                        <?php if ($firstSubSasaran && $IsRole4) { ?>
                                                                            <td class="col-aksi" rowspan="<?= $subTotalRows ?>">
                                                                                <div class="btn-group-aksi">
                                                                                    <!-- EDIT -->
                                                                                    <button class="btn btn-sm btn-warning btn-aksi btnEditSubKegiatan" data-id="<?= $sub_id ?>" title="Edit Sub Kegiatan"><i class="fa fa-edit"></i></button>
                                                                                    <!-- HAPUS -->
                                                                                    <button class="btn btn-sm btn-danger btn-aksi btnHapusSubKegiatan" data-id="<?= $sub_id ?>" title="Hapus Sub Kegiatan"><i class="fa fa-trash"></i></button>
                                                                                </div>
                                                                            </td>
                                                                        <?php } ?>

                                                                    </tr>

                                                                    <?php

                                                                    // ====================================================
                                                                    // INDIKATOR KE-2, KE-3, DST
                                                                    // ====================================================

                                                                    if (count($indikators_ss) > 1) {
                                                                        for ($i = 1; $i < count($indikators_ss); $i++) {
                                                                            $ind = $indikators_ss[$i];
                                                                            ?>
                                                                            <tr class="row-indikator border-indikator">
                                                                                <!-- INDIKATOR -->
                                                                                <td class="indikator-text" style="text-align:left; padding-left:5px;">
                                                                                    <?= html_escape($ind['indikator'] ?? '-') ?>
                                                                                </td>
                                                                                <!-- SATUAN -->
                                                                                <td><?= html_escape($ind['satuan'] ?? '-') ?></td>
                                                                                <!-- KONDISI AWAL -->
                                                                                <td><?= html_escape($ind['kondisi_awal'] ?? '-') ?></td>
                                                                                <!-- 2026 -->
                                                                                <td><?= html_escape($ind['target_2026'] ?? '-') ?></td>
                                                                                <td class="pagu-col">
                                                                                    <?= !empty($ind['anggaran_2026']) ? number_format($ind['anggaran_2026'], 0, ',', '.') : '-' ?>
                                                                                </td>
                                                                                <!-- 2027 -->
                                                                                <td><?= html_escape($ind['target_2027'] ?? '-') ?></td>
                                                                                <td class="pagu-col">
                                                                                    <?= !empty($ind['anggaran_2027']) ? number_format($ind['anggaran_2027'], 0, ',', '.') : '-' ?>
                                                                                </td>
                                                                                <!-- 2028 -->
                                                                                <td><?= html_escape($ind['target_2028'] ?? '-') ?></td>
                                                                                <td class="pagu-col">
                                                                                    <?= !empty($ind['anggaran_2028']) ? number_format($ind['anggaran_2028'], 0, ',', '.') : '-' ?>
                                                                                </td>
                                                                                <!-- 2029 -->
                                                                                <td><?= html_escape($ind['target_2029'] ?? '-') ?></td>
                                                                                <td class="pagu-col">
                                                                                    <?= !empty($ind['anggaran_2029']) ? number_format($ind['anggaran_2029'], 0, ',', '.') : '-' ?>
                                                                                </td>
                                                                                <!-- 2030 -->
                                                                                <td><?= html_escape($ind['target_2030'] ?? '-') ?></td>
                                                                                <td class="pagu-col">
                                                                                    <?= !empty($ind['anggaran_2030']) ? number_format($ind['anggaran_2030'], 0, ',', '.') : '-' ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }

                                                                    // ====================================================
                                                                    // SASARAN BERIKUTNYA
                                                                    // ====================================================

                                                                    $firstSubSasaran = false;
                                                                }

                                                                // ========================================================
                                                                // SUB KEGIATAN BERIKUTNYA
                                                                // ========================================================

                                                                $no_sub++;
                                                            }

                                                            $no_kegiatan++;
                                                        }
                                                    }

                                                        $no_program++;
                                                    }
                                                }
                                                $no_sasaran++;
                                            }
                                        } 
                                        $no_tujuan++;
                                    }

                                    
                                } else { ?>
                                    <tr>
                                        <td colspan="<?= 16 + ($IsRole4 ? 1 : 0) ?>" style="text-align:center;padding:30px 0;color:#999;">
                                            <i>Belum ada data Renstra PD</i>
                                            <?php if ($IsRole4) { ?>
                                                <br><small>Klik tombol <b>Tambah Tujuan PD</b> untuk memulai.</small>
                                            <?php } ?>
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

<!-- ============================================================ -->
<!-- MODAL TUJUAN -->
<!-- ============================================================ -->
<div class="modal fixed-modal" id="modalTujuan" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b id="modalTujuanTitle">Tambah Tujuan PD</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="tujuan_id">
                <div class="form-group">
                    <label><b>Sasaran RPJMD</b></label>
                    <select class="form-control" id="tujuan_sasaran_rpjmd_id">
                        <option value="">-- Pilih Sasaran RPJMD --</option>
                        <?php if (!empty($SasaranRPJMD)) { ?>
                            <?php foreach ($SasaranRPJMD as $sr) { ?>
                                <option value="<?= $sr['Id'] ?>"><?= html_escape($sr['Sasaran']) ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><b>Uraian Tujuan</b> <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="tujuan_uraian" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="tujuan_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <label><b>INDIKATOR TUJUAN</b></label>
                    <div class="indikator-list" id="tujuan_indikator_list">
                        <!-- Indikator rows akan ditambahkan di sini -->
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" id="btnTambahIndikatorTujuan">
                        <i class="fa fa-plus"></i> Tambah Indikator
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-batal" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanTujuan"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL SASARAN -->
<!-- ============================================================ -->
<div class="modal fixed-modal" id="modalSasaran" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b id="modalSasaranTitle">Tambah Sasaran PD</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sasaran_id">
                <input type="hidden" id="sasaran_tujuan_id">
                <div class="form-group">
                    <label><b>Uraian Sasaran</b> <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="sasaran_uraian" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="sasaran_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <label><b>INDIKATOR SASARAN</b></label>
                    <div class="indikator-list" id="sasaran_indikator_list">
                        <!-- Indikator rows akan ditambahkan di sini -->
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" id="btnTambahIndikatorSasaran">
                        <i class="fa fa-plus"></i> Tambah Indikator
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-batal" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanSasaran"><b>Simpan</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL PROGRAM RENSTRA - DENGAN OUTCOME & INDIKATOR -->
<!-- ============================================================ -->
<div class="modal fixed-modal" id="modalProgram" role="dialog" style="display:none;">
    <div class="modal-dialog modal-xl-custom">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b id="modalProgramTitle">Tambah Program</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="program_id">
                <input type="hidden" id="program_sasaran_id">
                
                <!-- NOMENKLATUR CASCADING -->
                <div class="nomenklatur-container">
                    <div class="breadcrumb-nomenklatur">
                        <span class="badge-path">📁 Pilih Program dari Nomenklatur</span>
                        <span id="path_display_program">Belum ada yang dipilih</span>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 cascading-select">
                            <label><b>1. Urusan</b></label>
                            <select class="form-control" id="program_select_urusan">
                                <option value="">-- Pilih Urusan --</option>
                            </select>
                        </div>
                        <div class="col-md-4 cascading-select">
                            <label><b>2. Bidang Urusan</b></label>
                            <select class="form-control" id="program_select_bidang" disabled>
                                <option value="">-- Pilih Bidang Urusan --</option>
                            </select>
                        </div>
                        <div class="col-md-4 cascading-select">
                            <label><b>3. Program</b></label>
                            <select class="form-control" id="program_select_program" disabled>
                                <option value="">-- Pilih Program --</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="nomenklatur-info" id="info_nomenklatur_program" style="display:none;">
                        <strong>📌 Terpilih:</strong> <span id="selected_nomenklatur_program"></span>
                        <button type="button" class="btn btn-success btn-sm pull-right" id="BtnAmbilIndikatorProgram" style="display:none;">
                            <i class="fa fa-download"></i> Ambil Indikator
                        </button>
                    </div>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label><b>Nama Program</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="program_nama" readonly style="background:#f8f9fa;">
                </div>
                
                <div class="form-group">
                    <label><b>Kode Program</b></label>
                    <input type="text" class="form-control" id="program_kode" readonly style="background:#f8f9fa;">
                </div>
                
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="program_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label><b>OUTCOME & INDIKATOR</b></label>
                    <div id="OutcomeContainer">
                        <!-- Outcome groups akan ditambahkan di sini -->
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="BtnTambahOutcome">
                        <i class="fa fa-plus"></i> Tambah Outcome
                    </button>
                </div>
                
                <div class="btn-group-center">
                    <button class="btn btn-success" id="btnSimpanProgram"><b>SIMPAN PROGRAM</b></button>
                    <button type="button" class="btn btn-default btn-batal"><b>BATAL</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL KEGIATAN - DENGAN MULTIPLE SASARAN & INDIKATOR -->
<!-- ============================================================ -->
<div class="modal fixed-modal" id="modalKegiatan" role="dialog" style="display:none;">
    <div class="modal-dialog modal-xl-custom">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b id="modalKegiatanTitle">Tambah Kegiatan</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="kegiatan_id">
                <input type="hidden" id="kegiatan_program_id">
                <input type="hidden" id="kegiatan_nama_hidden" value="">
                
                <!-- NOMENKLATUR CASCADING UNTUK KEGIATAN -->
                <div class="nomenklatur-container">
                    <div class="breadcrumb-nomenklatur">
                        <span class="badge-path">📁 Pilih Kegiatan dari Nomenklatur</span>
                        <span id="kegiatan_path_display">Belum ada yang dipilih</span>
                    </div>
                    <div class="row">
                        <div class="col-md-3 cascading-select">
                            <label><b>1. Urusan</b></label>
                            <select class="form-control" id="kegiatan_select_urusan">
                                <option value="">-- Pilih Urusan --</option>
                            </select>
                        </div>
                        <div class="col-md-3 cascading-select">
                            <label><b>2. Bidang Urusan</b></label>
                            <select class="form-control" id="kegiatan_select_bidang" disabled>
                                <option value="">-- Pilih Bidang Urusan --</option>
                            </select>
                        </div>
                        <div class="col-md-3 cascading-select">
                            <label><b>3. Program</b></label>
                            <select class="form-control" id="kegiatan_select_program" disabled>
                                <option value="">-- Pilih Program --</option>
                            </select>
                        </div>
                        <div class="col-md-3 cascading-select">
                            <label><b>4. Kegiatan</b></label>
                            <select class="form-control" id="kegiatan_select_kegiatan" disabled>
                                <option value="">-- Pilih Kegiatan --</option>
                            </select>
                        </div>
                    </div>
                    <div class="nomenklatur-info" id="kegiatan_info_nomenklatur" style="display:none;">
                        <strong>📌 Kegiatan terpilih:</strong> <span id="kegiatan_selected_text"></span>
                    </div>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="kegiatan_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label><b>SASARAN & INDIKATOR KEGIATAN</b></label>
                    <div id="KegiatanSasaranContainer">
                        <!-- Sasaran groups akan ditambahkan di sini -->
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="BtnTambahKegiatanSasaran">
                        <i class="fa fa-plus"></i> Tambah Sasaran
                    </button>
                </div>
                
                <div class="btn-group-center">
                    <button class="btn btn-success" id="btnSimpanKegiatan"><b>SIMPAN KEGIATAN</b></button>
                    <button type="button" class="btn btn-default btn-batal"><b>BATAL</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL SUB KEGIATAN - DENGAN MULTIPLE SASARAN & INDIKATOR -->
<!-- ============================================================ -->
<div class="modal fixed-modal" id="modalSubKegiatan" role="dialog" style="display:none;">
    <div class="modal-dialog modal-xl-custom">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><b id="modalSubKegiatanTitle">Tambah Sub Kegiatan</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="subkegiatan_id">
                <input type="hidden" id="subkegiatan_kegiatan_id">
                <input type="hidden" id="subkegiatan_nama_hidden" value="">
                <input type="hidden" id="subkegiatan_kode_nomenklatur" value="">
                
                <!-- NOMENKLATUR CASCADING UNTUK SUB KEGIATAN -->
                <div class="nomenklatur-container">
                    <div class="breadcrumb-nomenklatur">
                        <span class="badge-path">📁 Pilih Sub Kegiatan dari Nomenklatur</span>
                        <span id="subkegiatan_path_display">Belum ada yang dipilih</span>
                    </div>
                    <div class="row">
                        <div class="col-md-2 cascading-select">
                            <label><b>1. Urusan</b></label>
                            <select class="form-control" id="subkegiatan_select_urusan">
                                <option value="">-- Pilih Urusan --</option>
                            </select>
                        </div>
                        <div class="col-md-2 cascading-select">
                            <label><b>2. Bidang</b></label>
                            <select class="form-control" id="subkegiatan_select_bidang" disabled>
                                <option value="">-- Pilih Bidang --</option>
                            </select>
                        </div>
                        <div class="col-md-2 cascading-select">
                            <label><b>3. Program</b></label>
                            <select class="form-control" id="subkegiatan_select_program" disabled>
                                <option value="">-- Pilih Program --</option>
                            </select>
                        </div>
                        <div class="col-md-3 cascading-select">
                            <label><b>4. Kegiatan</b></label>
                            <select class="form-control" id="subkegiatan_select_kegiatan" disabled>
                                <option value="">-- Pilih Kegiatan --</option>
                            </select>
                        </div>
                        <div class="col-md-3 cascading-select">
                            <label><b>5. Sub Kegiatan</b></label>
                            <select class="form-control" id="subkegiatan_select_subkegiatan" disabled>
                                <option value="">-- Pilih Sub Kegiatan --</option>
                            </select>
                        </div>
                    </div>
                    <div class="nomenklatur-info" id="subkegiatan_info_nomenklatur" style="display:none;">
                        <strong>📌 Sub Kegiatan terpilih:</strong> <span id="subkegiatan_selected_text"></span>
                    </div>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label><b>Bidang / Sub / Koordinator</b></label>
                    <select class="form-control" id="subkegiatan_bidang_id">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <label><b>SASARAN & INDIKATOR SUB KEGIATAN</b></label>
                    <div id="SubKegiatanSasaranContainer">
                        <!-- Sasaran groups akan ditambahkan di sini -->
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="BtnTambahSubKegiatanSasaran">
                        <i class="fa fa-plus"></i> Tambah Sasaran
                    </button>
                </div>
                
                <div class="btn-group-center">
                    <button class="btn btn-success" id="btnSimpanSubKegiatan"><b>SIMPAN SUB KEGIATAN</b></button>
                    <button type="button" class="btn btn-default btn-batal"><b>BATAL</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var FILTER_INSTANSI_ID = '<?= $FilterInstansiId ?? '' ?>';
var counterOutcome = 0;
var counterIndikator = 0;
var counterKegiatanSasaran = 0;
var counterKegiatanIndikator = 0;
var counterSubKegiatanSasaran = 0;
var counterSubKegiatanIndikator = 0;

// NOMENKLATUR CACHE
var nomenklaturCache = {};
var nomenklaturCacheKegiatan = {};
var nomenklaturCacheSub = {};

// ==============================================
// FUNGSI RESET DROPDOWN
// ==============================================
function resetKegiatanDropdowns() {
    $('#kegiatan_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
    $('#kegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    $('#kegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
    $('#kegiatan_path_display').text('Belum ada yang dipilih');
    $('#kegiatan_info_nomenklatur').hide();
    $('#kegiatan_selected_text').text('');
    $('#kegiatan_nama_hidden').val('');
    nomenklaturCacheKegiatan = {};
}

function resetSubKegiatanDropdowns() {
    $('#subkegiatan_select_bidang').html('<option value="">-- Pilih Bidang --</option>').prop('disabled', true);
    $('#subkegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
    $('#subkegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
    $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
    $('#subkegiatan_path_display').text('Belum ada yang dipilih');
    $('#subkegiatan_info_nomenklatur').hide();
    $('#subkegiatan_selected_text').text('');
    $('#subkegiatan_nama_hidden').val('');
    $('#subkegiatan_kode_nomenklatur').val('');
    nomenklaturCacheSub = {};
}

$(document).ready(function() {

    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
    var CURRENT_FILTER_INSTANSI = "<?= !empty($FilterInstansiId) ? $FilterInstansiId : '' ?>";

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
                var options = '<option value="">Pilih Kab/Kota</option>';
                if (Data && Data.length > 0) {
                    for (var i = 0; i < Data.length; i++) {
                        options += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(options).prop('disabled', false);
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
                    for (var i = 0; i < Data.length; i++) {
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
        if ($("#Provinsi").val() === "") { alert("Mohon Pilih Provinsi"); return; }
        if ($("#KabKota").val() === "") { alert("Mohon Pilih Kab/Kota"); return; }
        var kodeWilayah = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val() || "";
        $.ajax({
            url: BaseURL + "Instansi/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kodeWilayah, InstansiId: instansiId, [CSRF_NAME]: CSRF_TOKEN },
            beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
            success: function(res) {
                if (res === '1') {
                    var url = BaseURL + "Instansi/MenuRenstraPD";
                    if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
                    window.location.href = url;
                } else {
                    alert(res || "Gagal menyimpan filter!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() { alert("Gagal menghubungi server!"); $("#Filter").prop('disabled', false).text('Filter'); }
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

    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
    $("#FilterInstansiBtn").click(function() {
        var instansiId = $("#FilterInstansi").val();
        var url = BaseURL + "Instansi/MenuRenstraPD";
        if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
        window.location.href = url;
    });
    $("#ResetFilterBtn").click(function() {
        window.location.href = BaseURL + "Instansi/MenuRenstraPD";
    });
    <?php } ?>

    // ==============================================
    // FUNGSI BANTUAN
    // ==============================================
    function escapeHtml(text) {
        if (text === null || text === undefined) return '';
        return String(text).replace(/&/g, "&amp;").replace(/</g, "&lt;")
            .replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    function formatRupiah(angka) {
        if (!angka) return '';
        var num = parseFloat(angka);
        if (isNaN(num)) return '';
        return num.toLocaleString('id-ID');
    }

    function parseRupiah(value) {
        if (!value) return null;
        var clean = String(value).replace(/[^0-9]/g, '');
        return clean !== '' ? parseFloat(clean) : null;
    }

    function loadBidangList(selectId, selectedValue) {
        $.ajax({
            url: BaseURL + "Instansi/getBidangList",
            type: "POST",
            data: { [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            beforeSend: function() {
                $("#" + selectId).html('<option value="">Memuat...</option>').prop('disabled', true);
            },
            success: function(data) {
                var options = '<option value="">-- Pilih Bidang --</option>';
                if (data && data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var selected = (selectedValue && data[i].id == selectedValue) ? 'selected' : '';
                        var label = data[i].nama + (data[i].jabatan ? ' - ' + data[i].jabatan : '');
                        options += '<option value="' + data[i].id + '" ' + selected + '>' + label + '</option>';
                    }
                }
                $("#" + selectId).html(options).prop('disabled', false);
            },
            error: function() {
                $("#" + selectId).html('<option value="">Gagal memuat data</option>').prop('disabled', false);
            }
        });
    }

    function loadSasaranRPJMD(selectId, selectedValue) {
        $.ajax({
            url: BaseURL + "Instansi/getSasaranRPJMD",
            type: "POST",
            data: { [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            beforeSend: function() {
                $("#" + selectId).html('<option value="">Memuat...</option>').prop('disabled', true);
            },
            success: function(data) {
                var options = '<option value="">-- Pilih Sasaran RPJMD --</option>';
                if (data && data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var selected = (selectedValue && data[i].Id == selectedValue) ? 'selected' : '';
                        options += '<option value="' + data[i].Id + '" ' + selected + '>' + data[i].Sasaran + '</option>';
                    }
                }
                $("#" + selectId).html(options).prop('disabled', false);
            },
            error: function() {
                $("#" + selectId).html('<option value="">Gagal memuat data</option>').prop('disabled', false);
            }
        });
    }

    // ==============================================
    // FUNGSI SHOW/HIDE MODAL
    // ==============================================
    function showFixedModal(selector) {
        var $modal = $(selector);
        $('.modal-backdrop').remove();
        $modal.css('display', 'flex');
        $modal.addClass('show');
        var $backdrop = $('<div class="modal-backdrop fade in"></div>');
        $('body').append($backdrop);
        $('body').addClass('modal-open');
    }

    function hideFixedModal(selector) {
        var $modal = $(selector);
        $modal.removeClass('show');
        $modal.css('display', 'none');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    }

    $(document).on('click', '.modal.fixed-modal .close, .modal.fixed-modal .btn-batal', function(e) {
        e.preventDefault();
        var $modal = $(this).closest('.modal.fixed-modal');
        if ($modal.length) hideFixedModal('#' + $modal.attr('id'));
    });

    $(document).on('click', '.modal.fixed-modal', function(e) {
        if ($(e.target).hasClass('modal.fixed-modal')) {
            hideFixedModal('#' + $(this).attr('id'));
        }
    });

    // ==============================================
    // FORMAT RUPIAH OTOMATIS
    // ==============================================
    $(document).on('input', '.rupiah-input', function() {
        var raw = $(this).val().replace(/[^0-9]/g, '');
        if (raw) {
            $(this).val('Rp ' + parseInt(raw).toLocaleString('id-ID'));
        } else {
            $(this).val('');
        }
    });

    $(document).on('input', '.anggaran-input', function() {
        var raw = $(this).val().replace(/[^0-9]/g, '');
        if (raw) {
            $(this).val(parseInt(raw).toLocaleString('id-ID'));
        } else {
            $(this).val('');
        }
    });

    // ==============================================
    // NOMENKLATUR CASCADING - FUNGSI PROGRAM
    // ==============================================
    function getNomenklaturProgram(level, parentKode, callback) {
        var cacheKey = 'program_level' + level + '_' + (parentKode || 'root');
        if (nomenklaturCache[cacheKey]) {
            if (callback) callback(nomenklaturCache[cacheKey]);
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getNomenklaturByLevelRenja",
            type: "POST",
            data: {
                level: level,
                parent_kode: parentKode || '',
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                nomenklaturCache[cacheKey] = res;
                if (callback) callback(res);
            },
            error: function() {
                if (callback) callback([]);
            }
        });
    }

    function loadProgramLevel(level, parentKode) {
        var selectId = level == 1 ? 'program_select_urusan' : 
                       (level == 2 ? 'program_select_bidang' : 'program_select_program');
        
        if (level == 1) {
            $('#program_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#path_display_program').text('Belum ada yang dipilih');
            $('#info_nomenklatur_program').hide();
            $('#program_kode').val('');
            $('#program_nama').val('');
            $('#BtnAmbilIndikatorProgram').hide();
        } else if (level == 2) {
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }
        
        if (!parentKode && level > 1) {
            $('#' + selectId).html('<option value="">-- Pilih --</option>').prop('disabled', true);
            return;
        }
        
        getNomenklaturProgram(level, parentKode, function(res) {
            var options = '<option value="">-- Pilih ' + 
                (level == 1 ? 'Urusan' : (level == 2 ? 'Bidang Urusan' : 'Program')) + 
                ' --</option>';
            if (res && res.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + 
                               res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#' + selectId).html(options).prop('disabled', false);
        });
    }

    function updatePathDisplayProgram() {
        var urusanVal = $('#program_select_urusan').val() || '';
        var bidangVal = $('#program_select_bidang').val() || '';
        var programVal = $('#program_select_program').val() || '';
        var urusanText = $('#program_select_urusan option:selected').text() || '';
        var bidangText = $('#program_select_bidang option:selected').text() || '';
        var programText = $('#program_select_program option:selected').text() || '';
        var parts = [];
        if (urusanVal) parts.push(urusanText);
        if (bidangVal) parts.push(bidangText);
        if (programVal) parts.push(programText);
        $('#path_display_program').text(parts.length ? parts.join(' → ') : 'Belum ada yang dipilih');
        
        if (programVal) {
            $('#info_nomenklatur_program').show();
            $('#selected_nomenklatur_program').text(programText || 'Program terpilih: ' + programVal);
            $('#program_kode').val(programVal);
            $('#BtnAmbilIndikatorProgram').show();
            loadIndikatorProgramMulti(programVal);
        } else {
            $('#info_nomenklatur_program').hide();
            $('#program_kode').val('');
            $('#BtnAmbilIndikatorProgram').hide();
        }
    }

    // ==============================================
    // NOMENKLATUR CASCADING - FUNGSI KEGIATAN
    // ==============================================
    function getNomenklaturKegiatan(level, parentKode, callback) {
        var cacheKey = 'keg_level' + level + '_' + (parentKode || 'root');
        if (nomenklaturCacheKegiatan[cacheKey]) {
            if (callback) callback(nomenklaturCacheKegiatan[cacheKey]);
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getNomenklaturByLevelRenja",
            type: "POST",
            data: {
                level: level,
                parent_kode: parentKode || '',
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                nomenklaturCacheKegiatan[cacheKey] = res || [];
                if (callback) callback(res || []);
            },
            error: function() {
                if (callback) callback([]);
            }
        });
    }

    function loadKegiatanLevel(level, parentKode, callback) {
        var selectId = level == 1 ? 'kegiatan_select_urusan' : 
                       (level == 2 ? 'kegiatan_select_bidang' : 
                       (level == 3 ? 'kegiatan_select_program' : 'kegiatan_select_kegiatan'));
        
        if (level == 1) {
            $('#kegiatan_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            $('#kegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#kegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            $('#kegiatan_path_display').text('Belum ada yang dipilih');
            $('#kegiatan_info_nomenklatur').hide();
            $('#kegiatan_nama_hidden').val('');
        } else if (level == 2) {
            $('#kegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#kegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        } else if (level == 3) {
            $('#kegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        }
        
        if (!parentKode && level > 1) {
            $('#' + selectId).html('<option value="">-- Pilih --</option>').prop('disabled', true);
            if (callback) callback([]);
            return;
        }
        
        getNomenklaturKegiatan(level, parentKode, function(res) {
            var options = '<option value="">-- Pilih ' + 
                (level == 1 ? 'Urusan' : (level == 2 ? 'Bidang Urusan' : (level == 3 ? 'Program' : 'Kegiatan'))) + 
                ' --</option>';
            if (res && res.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#' + selectId).html(options).prop('disabled', false);
            if (callback) callback(res);
        });
    }

    function updateKegiatanPath() {
        var urusan = $('#kegiatan_select_urusan option:selected').text();
        var bidang = $('#kegiatan_select_bidang option:selected').text();
        var program = $('#kegiatan_select_program option:selected').text();
        var kegiatan = $('#kegiatan_select_kegiatan option:selected').text();
        
        var parts = [];
        if (urusan && urusan.indexOf('--') == -1) parts.push(urusan);
        if (bidang && bidang.indexOf('--') == -1) parts.push(bidang);
        if (program && program.indexOf('--') == -1) parts.push(program);
        if (kegiatan && kegiatan.indexOf('--') == -1) parts.push(kegiatan);
        
        $('#kegiatan_path_display').text(parts.length ? parts.join(' → ') : 'Belum ada yang dipilih');
        
        if (kegiatan && kegiatan.indexOf('--') == -1) {
            $('#kegiatan_info_nomenklatur').show();
            $('#kegiatan_selected_text').text(kegiatan);
            var nama = kegiatan.replace(/^\d+(\.\d+){3}\s*-\s*/, '');
            nama = nama.replace(/^\d+(\.\d+){2,3}\s*-\s*/, '');
            $('#kegiatan_nama_hidden').val(nama);
        } else {
            $('#kegiatan_info_nomenklatur').hide();
            $('#kegiatan_selected_text').text('');
            $('#kegiatan_nama_hidden').val('');
        }
    }

    // ==============================================
    // NOMENKLATUR CASCADING - FUNGSI SUB KEGIATAN (FIX)
    // ==============================================
    function getNomenklaturSub(level, parentKode, callback) {
    var cacheKey = 'sub_level' + level + '_' + (parentKode || 'root');
    if (nomenklaturCacheSub[cacheKey]) {
        if (callback) callback(nomenklaturCacheSub[cacheKey]);
        return;
    }
    $.ajax({
        url: BaseURL + "Instansi/getNomenklaturByLevelRenja",
        type: "POST",
        data: {
            level: level,
            parent_kode: parentKode || '',
            [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res) {
            nomenklaturCacheSub[cacheKey] = res || [];
            if (callback) callback(res || []);
        },
        error: function() {
            if (callback) callback([]);
        }
    });
}

    function loadSubLevel(level, parentKode, callback) {
        var selectId = level == 1 ? 'subkegiatan_select_urusan' : 
                       (level == 2 ? 'subkegiatan_select_bidang' : 
                       (level == 3 ? 'subkegiatan_select_program' : 
                       (level == 4 ? 'subkegiatan_select_kegiatan' : 'subkegiatan_select_subkegiatan')));
        
        if (level == 1) {
            $('#subkegiatan_select_bidang').html('<option value="">-- Pilih Bidang --</option>').prop('disabled', true);
            $('#subkegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#subkegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_path_display').text('Belum ada yang dipilih');
            $('#subkegiatan_info_nomenklatur').hide();
            $('#subkegiatan_nama_hidden').val('');
            $('#subkegiatan_kode_nomenklatur').val('');
        } else if (level == 2) {
            $('#subkegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#subkegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        } else if (level == 3) {
            $('#subkegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        } else if (level == 4) {
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        }
        
        if (!parentKode && level > 1) {
            $('#' + selectId).html('<option value="">-- Pilih --</option>').prop('disabled', true);
            if (callback) callback([]);
            return;
        }
        
        getNomenklaturSub(level, parentKode, function(res) {
            var options = '<option value="">-- Pilih ' + 
                (level == 1 ? 'Urusan' : (level == 2 ? 'Bidang' : (level == 3 ? 'Program' : (level == 4 ? 'Kegiatan' : 'Sub Kegiatan')))) + 
                ' --</option>';
            if (res && res.length > 0) {
                for (var i = 0; i < res.length; i++) {
                    options += '<option value="' + res[i].Kode + '">' + res[i].Kode + ' - ' + res[i].Nomenklatur + '</option>';
                }
            }
            $('#' + selectId).html(options).prop('disabled', false);
            if (callback) callback(res);
        });
    }

    function updateSubPath() {
        var urusan = $('#subkegiatan_select_urusan option:selected').text();
        var bidang = $('#subkegiatan_select_bidang option:selected').text();
        var program = $('#subkegiatan_select_program option:selected').text();
        var kegiatan = $('#subkegiatan_select_kegiatan option:selected').text();
        var sub = $('#subkegiatan_select_subkegiatan option:selected').text();
        var parts = [];
        if (urusan && urusan.indexOf('--') == -1) parts.push(urusan);
        if (bidang && bidang.indexOf('--') == -1) parts.push(bidang);
        if (program && program.indexOf('--') == -1) parts.push(program);
        if (kegiatan && kegiatan.indexOf('--') == -1) parts.push(kegiatan);
        if (sub && sub.indexOf('--') == -1) parts.push(sub);
        $('#subkegiatan_path_display').text(parts.length ? parts.join(' → ') : 'Belum ada yang dipilih');
        
        var subKode = $('#subkegiatan_select_subkegiatan').val();
        if (subKode) {
            $('#subkegiatan_kode_nomenklatur').val(subKode);
        }
        
        if (sub && sub.indexOf('--') == -1) {
            $('#subkegiatan_info_nomenklatur').show();
            $('#subkegiatan_selected_text').text(sub);
            var nama = sub.replace(/^\d+(\.\d+){4}\s*-\s*/, '');
            nama = nama.replace(/^\d+(\.\d+){3,4}\s*-\s*/, '');
            $('#subkegiatan_nama_hidden').val(nama);
        } else {
            $('#subkegiatan_info_nomenklatur').hide();
            $('#subkegiatan_selected_text').text('');
            if (!subKode) {
                $('#subkegiatan_nama_hidden').val('');
            }
        }
    }

    // ==============================================
    // EVENT NOMENKLATUR PROGRAM
    // ==============================================
    $(document).on('change', '#program_select_urusan', function() {
        var urusanKode = $(this).val();
        var isEditing = $('#program_id').val() !== '';
        
        if (!isEditing) {
            $('#OutcomeContainer').empty();
            addOutcome({ indikators: [] });
            $('#program_nama').val('');
            $('#program_kode').val('');
            $('#BtnAmbilIndikatorProgram').hide();
            $('#info_nomenklatur_program').hide();
            $('#path_display_program').text('Belum ada yang dipilih');
        }
        
        if (urusanKode) {
            loadProgramLevel(2, urusanKode);
        } else {
            $('#program_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }
        updatePathDisplayProgram();
    });

    $(document).on('change', '#program_select_bidang', function() {
        var bidangKode = $(this).val();
        var isEditing = $('#program_id').val() !== '';
        
        if (!isEditing) {
            $('#OutcomeContainer').empty();
            addOutcome({ indikators: [] });
            $('#program_nama').val('');
            $('#program_kode').val('');
            $('#BtnAmbilIndikatorProgram').hide();
            $('#info_nomenklatur_program').hide();
            $('#path_display_program').text('Belum ada yang dipilih');
        }
        
        if (bidangKode) {
            loadProgramLevel(3, bidangKode);
        } else {
            $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        }
        updatePathDisplayProgram();
    });

    $(document).on('change', '#program_select_program', function() {
        updatePathDisplayProgram();
    });

    // ==============================================
    // EVENT NOMENKLATUR KEGIATAN
    // ==============================================
    $(document).on('change', '#kegiatan_select_urusan', function() {
        var val = $(this).val();
        if (val) loadKegiatanLevel(2, val);
        else {
            $('#kegiatan_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
            $('#kegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#kegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        }
        updateKegiatanPath();
    });

    $(document).on('change', '#kegiatan_select_bidang', function() {
        var val = $(this).val();
        if (val) loadKegiatanLevel(3, val);
        else {
            $('#kegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#kegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        }
        updateKegiatanPath();
    });

    $(document).on('change', '#kegiatan_select_program', function() {
        var val = $(this).val();
        if (val) loadKegiatanLevel(4, val);
        else {
            $('#kegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
        }
        updateKegiatanPath();
    });

    $(document).on('change', '#kegiatan_select_kegiatan', function() {
        updateKegiatanPath();
    });

    // ==============================================
    // EVENT NOMENKLATUR SUB KEGIATAN (FIX)
    // ==============================================
    $(document).on('change', '#subkegiatan_select_urusan', function() {
        var val = $(this).val();
        if (val) {
            loadSubLevel(2, val);
        } else {
            $('#subkegiatan_select_bidang').html('<option value="">-- Pilih Bidang --</option>').prop('disabled', true);
            $('#subkegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#subkegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_nama_hidden').val('');
            $('#subkegiatan_kode_nomenklatur').val('');
        }
        updateSubPath();
    });

    $(document).on('change', '#subkegiatan_select_bidang', function() {
        var val = $(this).val();
        if (val) {
            loadSubLevel(3, val);
        } else {
            $('#subkegiatan_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
            $('#subkegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        }
        updateSubPath();
    });

    $(document).on('change', '#subkegiatan_select_program', function() {
        var val = $(this).val();
        if (val) {
            loadSubLevel(4, val);
        } else {
            $('#subkegiatan_select_kegiatan').html('<option value="">-- Pilih Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
        }
        updateSubPath();
    });

    $(document).on('change', '#subkegiatan_select_kegiatan', function() {
        var val = $(this).val();
        if (val) {
            loadSubLevel(5, val);
        } else {
            $('#subkegiatan_select_subkegiatan').html('<option value="">-- Pilih Sub Kegiatan --</option>').prop('disabled', true);
            $('#subkegiatan_nama_hidden').val('');
            $('#subkegiatan_kode_nomenklatur').val('');
        }
        updateSubPath();
    });

    $(document).on('change', '#subkegiatan_select_subkegiatan', function() {
        updateSubPath();
        var kode = $(this).val();
        if (kode) {
            $('#subkegiatan_kode_nomenklatur').val(kode);
        }
    });

    // ==============================================
    // FUNGSI OUTCOME & INDIKATOR DI MODAL PROGRAM
    // ==============================================
    function addOutcome(data) {
        var id = data && data.id ? data.id : '';
        var text = data && data.outcome_text ? escapeHtml(data.outcome_text) : '';
        var indikators = data && data.indikators ? data.indikators : [];
        var counter = counterOutcome++;
        var html = '<div class="outcome-group" id="outcome_group_' + counter + '">';
        html += '<input type="hidden" class="outcome-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-outcome" data-group="' + counter + '" title="Hapus Outcome">×</button>';
        
        html += '<div class="form-group">';
        html += '<label><b>Sasaran (Outcome)</b> <span class="text-danger">*</span></label>';
        html += '<textarea class="form-control outcome-textarea" id="outcome_text_' + counter + '" rows="2" placeholder="Tulis Sasaran/Outcome">' + text + '</textarea>';
        html += '<small class="text-muted">Sasaran/Outcome akan ditampilkan di bawah Program pada tabel</small>';
        html += '</div>';
        
        html += '<hr style="margin:10px 0;">';
        
        html += '<div class="indikator-list" id="indikator_list_' + counter + '">';
        if (indikators.length > 0) {
            for (var i = 0; i < indikators.length; i++) {
                html += generateIndikatorRow(counter, indikators[i]);
            }
        } else {
            html += generateIndikatorRow(counter, null);
        }
        html += '</div>';
        html += '<button type="button" class="btn btn-sm btn-primary tambah-indikator" data-group="' + counter + '"><i class="fa fa-plus"></i> Tambah Indikator</button>';
        html += '</div>';
        $('#OutcomeContainer').append(html);
    }

    function generateIndikatorRow(groupId, data) {
        var id = data && data.id ? data.id : '';
        var indikator = data && data.indikator ? escapeHtml(data.indikator) : '';
        var satuan = data && data.satuan ? escapeHtml(data.satuan) : '';
        var kondisiAwal = data && data.kondisi_awal ? escapeHtml(data.kondisi_awal) : '';
        var target2026 = data && data.target_2026 ? escapeHtml(data.target_2026) : '';
        var target2027 = data && data.target_2027 ? escapeHtml(data.target_2027) : '';
        var target2028 = data && data.target_2028 ? escapeHtml(data.target_2028) : '';
        var target2029 = data && data.target_2029 ? escapeHtml(data.target_2029) : '';
        var target2030 = data && data.target_2030 ? escapeHtml(data.target_2030) : '';
        
        var counter = counterIndikator++;
        var html = '<div class="indikator-row" id="indikator_row_' + counter + '">';
        html += '<input type="hidden" class="indikator-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-indikator" data-row="' + counter + '" title="Hapus Indikator">×</button>';
        
        html += '<div class="row"><div class="col-md-12"><div class="form-group"><label>Indikator</label>';
        html += '<textarea class="form-control form-control-sm indikator-textarea" id="indikator_' + counter + '" rows="2">' + indikator + '</textarea>';
        html += '</div></div></div>';
        
        html += '<div class="row">';
        html += '<div class="col-md-6"><div class="form-group"><label>Satuan</label><input type="text" class="form-control form-control-sm satuan-input" id="satuan_' + counter + '" value="' + satuan + '"></div></div>';
        html += '<div class="col-md-6"><div class="form-group"><label>Kondisi Awal</label><input type="text" class="form-control form-control-sm kondisi-input" id="kondisi_awal_' + counter + '" value="' + kondisiAwal + '"></div></div>';
        html += '</div>';
        
        html += '<div class="row">';
        var years = ['2026','2027','2028','2029','2030'];
        var targetVals = [target2026, target2027, target2028, target2029, target2030];
        for (var y = 0; y < years.length; y++) {
            html += '<div class="col-md-2"><div class="form-group"><label style="font-size:11px; color:#007bff;">' + years[y] + '</label>';
            html += '<input type="text" class="form-control form-control-sm target-input" id="target_' + years[y] + '_' + counter + '" placeholder="Target" value="' + targetVals[y] + '">';
            html += '</div></div>';
        }
        html += '</div>';
        
        html += '</div>';
        return html;
    }

    // ==============================================
    // FUNGSI OUTCOME & INDIKATOR DI MODAL KEGIATAN
    // ==============================================

    function addKegiatanSasaran(data) {
        var id = data && data.id ? data.id : '';
        var text = data && data.sasaran_text ? escapeHtml(data.sasaran_text) : '';
        var indikators = data && data.indikators ? data.indikators : [];
        var counter = counterKegiatanSasaran++;
        
        var html = '<div class="outcome-group" id="kegiatan_sasaran_group_' + counter + '">';
        html += '<input type="hidden" class="kegiatan-sasaran-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-outcome" data-group="' + counter + '" data-type="kegiatan" title="Hapus Sasaran">×</button>';
        
        html += '<div class="form-group">';
        html += '<label><b>Sasaran (Outcome)</b> <span class="text-danger">*</span></label>';
        html += '<textarea class="form-control outcome-textarea" id="kegiatan_sasaran_text_' + counter + '" rows="2" placeholder="Tulis Sasaran/Outcome">' + text + '</textarea>';
        html += '</div>';
        
        html += '<hr style="margin:10px 0;">';
        
        html += '<div class="indikator-list" id="kegiatan_indikator_list_' + counter + '">';
        if (indikators.length > 0) {
            for (var i = 0; i < indikators.length; i++) {
                html += generateKegiatanIndikatorRow(counter, indikators[i]);
            }
        } else {
            html += generateKegiatanIndikatorRow(counter, null);
        }
        html += '</div>';
        html += '<button type="button" class="btn btn-sm btn-primary tambah-kegiatan-indikator" data-group="' + counter + '"><i class="fa fa-plus"></i> Tambah Indikator</button>';
        html += '</div>';
        
        $('#KegiatanSasaranContainer').append(html);
    }

    function generateKegiatanIndikatorRow(groupId, data) {
        var id = data && data.id ? data.id : '';
        var indikator = data && data.indikator ? escapeHtml(data.indikator) : '';
        var satuan = data && data.satuan ? escapeHtml(data.satuan) : '';
        var kondisiAwal = data && data.kondisi_awal ? escapeHtml(data.kondisi_awal) : '';
        var target2026 = data && data.target_2026 ? escapeHtml(data.target_2026) : '';
        var target2027 = data && data.target_2027 ? escapeHtml(data.target_2027) : '';
        var target2028 = data && data.target_2028 ? escapeHtml(data.target_2028) : '';
        var target2029 = data && data.target_2029 ? escapeHtml(data.target_2029) : '';
        var target2030 = data && data.target_2030 ? escapeHtml(data.target_2030) : '';
        
        var counter = counterKegiatanIndikator++;
        var html = '<div class="indikator-row" id="kegiatan_indikator_row_' + counter + '">';
        html += '<input type="hidden" class="kegiatan-indikator-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-indikator" data-row="' + counter + '" data-type="kegiatan" title="Hapus Indikator">×</button>';
        
        html += '<div class="row"><div class="col-md-12"><div class="form-group"><label>Indikator</label>';
        html += '<textarea class="form-control form-control-sm indikator-textarea" id="kegiatan_indikator_' + counter + '" rows="2">' + indikator + '</textarea>';
        html += '</div></div></div>';
        
        html += '<div class="row">';
        html += '<div class="col-md-6"><div class="form-group"><label>Satuan</label><input type="text" class="form-control form-control-sm satuan-input" id="kegiatan_satuan_' + counter + '" value="' + satuan + '"></div></div>';
        html += '<div class="col-md-6"><div class="form-group"><label>Kondisi Awal</label><input type="text" class="form-control form-control-sm kondisi-input" id="kegiatan_kondisi_awal_' + counter + '" value="' + kondisiAwal + '"></div></div>';
        html += '</div>';
        
        html += '<div class="row">';
        var years = ['2026','2027','2028','2029','2030'];
        var targetVals = [target2026, target2027, target2028, target2029, target2030];
        for (var y = 0; y < years.length; y++) {
            html += '<div class="col-md-2"><div class="form-group"><label style="font-size:11px; color:#007bff;">' + years[y] + '</label>';
            html += '<input type="text" class="form-control form-control-sm target-input" id="kegiatan_target_' + years[y] + '_' + counter + '" placeholder="Target" value="' + targetVals[y] + '">';
            html += '</div></div>';
        }
        html += '</div>';
        html += '</div>';
        return html;
    }

    // ==============================================
    // FUNGSI SASARAN & INDIKATOR UNTUK SUB KEGIATAN
    // ==============================================

    function addSubKegiatanSasaran(data) {
        var id = data && data.id ? data.id : '';
        var text = data && data.sasaran_text ? escapeHtml(data.sasaran_text) : '';
        var indikators = data && data.indikators ? data.indikators : [];
        var counter = counterSubKegiatanSasaran++;
        
        var html = '<div class="outcome-group" id="subkegiatan_sasaran_group_' + counter + '">';
        html += '<input type="hidden" class="subkegiatan-sasaran-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-outcome" data-group="' + counter + '" data-type="subkegiatan" title="Hapus Sasaran">×</button>';
        
        html += '<div class="form-group">';
        html += '<label><b>Sasaran (Outcome)</b> <span class="text-danger">*</span></label>';
        html += '<textarea class="form-control outcome-textarea" id="subkegiatan_sasaran_text_' + counter + '" rows="2" placeholder="Tulis Sasaran/Outcome">' + text + '</textarea>';
        html += '</div>';
        
        html += '<hr style="margin:10px 0;">';
        
        html += '<div class="indikator-list" id="subkegiatan_indikator_list_' + counter + '">';
        if (indikators.length > 0) {
            for (var i = 0; i < indikators.length; i++) {
                html += generateSubKegiatanIndikatorRow(counter, indikators[i]);
            }
        } else {
            html += generateSubKegiatanIndikatorRow(counter, null);
        }
        html += '</div>';
        html += '<button type="button" class="btn btn-sm btn-primary tambah-subkegiatan-indikator" data-group="' + counter + '"><i class="fa fa-plus"></i> Tambah Indikator</button>';
        html += '</div>';
        
        $('#SubKegiatanSasaranContainer').append(html);
        initAnggaranInputs();
    }

    function generateSubKegiatanIndikatorRow(groupId, data) {
        var id = data && data.id ? data.id : '';
        var indikator = data && data.indikator ? escapeHtml(data.indikator) : '';
        var satuan = data && data.satuan ? escapeHtml(data.satuan) : '';
        var kondisiAwal = data && data.kondisi_awal ? escapeHtml(data.kondisi_awal) : '';
        var target2026 = data && data.target_2026 ? escapeHtml(data.target_2026) : '';
        var anggaran2026 = data && data.anggaran_2026 ? data.anggaran_2026 : '';
        var anggaran2026Formatted = anggaran2026 ? formatRupiah(anggaran2026) : '';
        var target2027 = data && data.target_2027 ? escapeHtml(data.target_2027) : '';
        var anggaran2027 = data && data.anggaran_2027 ? data.anggaran_2027 : '';
        var anggaran2027Formatted = anggaran2027 ? formatRupiah(anggaran2027) : '';
        var target2028 = data && data.target_2028 ? escapeHtml(data.target_2028) : '';
        var anggaran2028 = data && data.anggaran_2028 ? data.anggaran_2028 : '';
        var anggaran2028Formatted = anggaran2028 ? formatRupiah(anggaran2028) : '';
        var target2029 = data && data.target_2029 ? escapeHtml(data.target_2029) : '';
        var anggaran2029 = data && data.anggaran_2029 ? data.anggaran_2029 : '';
        var anggaran2029Formatted = anggaran2029 ? formatRupiah(anggaran2029) : '';
        var target2030 = data && data.target_2030 ? escapeHtml(data.target_2030) : '';
        var anggaran2030 = data && data.anggaran_2030 ? data.anggaran_2030 : '';
        var anggaran2030Formatted = anggaran2030 ? formatRupiah(anggaran2030) : '';
        
        var counter = counterSubKegiatanIndikator++;
        var html = '<div class="indikator-row" id="subkegiatan_indikator_row_' + counter + '">';
        html += '<input type="hidden" class="subkegiatan-indikator-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-indikator" data-row="' + counter + '" data-type="subkegiatan" title="Hapus Indikator">×</button>';
        
        html += '<div class="row"><div class="col-md-12"><div class="form-group"><label>Indikator</label>';
        html += '<textarea class="form-control form-control-sm indikator-textarea" id="subkegiatan_indikator_' + counter + '" rows="2">' + indikator + '</textarea>';
        html += '</div></div></div>';
        
        html += '<div class="row">';
        html += '<div class="col-md-6"><div class="form-group"><label>Satuan</label><input type="text" class="form-control form-control-sm satuan-input" id="subkegiatan_satuan_' + counter + '" value="' + satuan + '"></div></div>';
        html += '<div class="col-md-6"><div class="form-group"><label>Kondisi Awal</label><input type="text" class="form-control form-control-sm kondisi-input" id="subkegiatan_kondisi_awal_' + counter + '" value="' + kondisiAwal + '"></div></div>';
        html += '</div>';
        
        html += '<div class="row">';
        var years = ['2026','2027','2028','2029','2030'];
        var targetVals = [target2026, target2027, target2028, target2029, target2030];
        var anggaranVals = [anggaran2026Formatted, anggaran2027Formatted, anggaran2028Formatted, anggaran2029Formatted, anggaran2030Formatted];
        for (var y = 0; y < years.length; y++) {
            html += '<div class="col-md-2"><div class="form-group"><label style="font-size:11px; color:#007bff;">' + years[y] + '</label>';
            html += '<input type="text" class="form-control form-control-sm target-input" id="subkegiatan_target_' + years[y] + '_' + counter + '" placeholder="Target" value="' + targetVals[y] + '">';
            html += '<input type="text" class="form-control form-control-sm anggaran-input" id="subkegiatan_anggaran_' + years[y] + '_' + counter + '" placeholder="Anggaran" value="' + anggaranVals[y] + '" style="margin-top:3px;">';
            html += '</div></div>';
        }
        html += '</div>';
        html += '</div>';
        return html;
    }

    function initAnggaranInputs() {
        $('.anggaran-input').off('keyup').on('keyup', function() {
            var val = $(this).val().replace(/[^0-9]/g, '');
            if (val) {
                $(this).val(parseInt(val).toLocaleString('id-ID'));
            }
        });
    }

    // ==============================================
    // FUNGSI AMBIL INDIKATOR DARI PROGRAM PD
    // ==============================================
    function loadIndikatorProgramMulti(programKode) {
        if (!programKode || programKode === '') {
            var isEditing = $('#program_id').val() !== '';
            if (!isEditing) {
                $('#OutcomeContainer').empty();
                addOutcome({ indikators: [] });
                $('#program_nama').val('');
            }
            return;
        }
        
        $('#OutcomeContainer').html('<div class="text-center" style="padding:20px;"><i class="fa fa-spinner fa-spin"></i> Memuat indikator dari Program PD...</div>');
        
        $.ajax({
            url: BaseURL + "Instansi/getProgramDetailByKode",
            type: "POST",
            data: {
                kode_program: programKode,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            timeout: 10000,
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    $('#program_nama').val(res.data.nama_program || '');
                    var outcomesFromProgram = res.data.outcomes || [];
                    loadIndikatorFromProgram(programKode, outcomesFromProgram);
                } else {
                    var isEditing = $('#program_id').val() !== '';
                    if (!isEditing) {
                        $('#program_nama').val('');
                    }
                    loadIndikatorFromProgram(programKode, []);
                }
            },
            error: function() {
                var isEditing = $('#program_id').val() !== '';
                if (!isEditing) {
                    $('#program_nama').val('');
                }
                loadIndikatorFromProgram(programKode, []);
            }
        });
    }

    function loadIndikatorFromProgram(programKode, outcomesFromProgram) {
        $.ajax({
            url: BaseURL + "Instansi/getIndikatorProgramPDRenstra",
            type: "POST",
            data: {
                kode_program: programKode,
                tahun: 2026,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            timeout: 10000,
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    var program = res.data.program || {};
                    var outcomesData = res.data.outcomes || [];
                    
                    if ($('#program_nama').val() === '') {
                        $('#program_nama').val(program.nama_program || '');
                    }
                    
                    $('#OutcomeContainer').empty();
                    
                    if (outcomesData.length > 0) {
                        var totalIndikator = 0;
                        for (var i = 0; i < outcomesData.length; i++) {
                            var outcome = outcomesData[i];
                            var indikatorList = outcome.indikator || [];
                            totalIndikator += indikatorList.length;
                            var outcomeText = outcome.outcome_text || 'Outcome ' + (i+1);
                            var outcomeData = {
                                outcome_text: outcomeText,
                                indikators: []
                            };
                            for (var j = 0; j < indikatorList.length; j++) {
                                var item = indikatorList[j];
                                outcomeData.indikators.push({
                                    indikator: item.indikator || '',
                                    satuan: item.satuan || '',
                                    kondisi_awal: item.kondisi_awal || '',
                                    target_2026: item.target_2026 || '',
                                    target_2027: item.target_2027 || '',
                                    target_2028: item.target_2028 || '',
                                    target_2029: item.target_2029 || '',
                                    target_2030: item.target_2030 || ''
                                });
                            }
                            addOutcome(outcomeData);
                        }
                        showNotification('✅ ' + totalIndikator + ' indikator dari ' + outcomesData.length + ' Outcome terisi otomatis', 'success');
                    } else {
                        var outcomeData = {
                            outcome_text: 'Outcome Program',
                            indikators: []
                        };
                        addOutcome(outcomeData);
                        showNotification('ℹ️ Tidak ada outcome untuk Program ini', 'info');
                    }
                } else {
                    $('#OutcomeContainer').empty();
                    var outcomeData = {
                        outcome_text: 'Outcome Program',
                        indikators: []
                    };
                    addOutcome(outcomeData);
                    showNotification(res.message || 'Gagal memuat indikator', 'error');
                }
            },
            error: function() {
                $('#OutcomeContainer').empty();
                var outcomeData = {
                    outcome_text: 'Outcome Program',
                    indikators: []
                };
                addOutcome(outcomeData);
                showNotification('Terjadi kesalahan saat memuat indikator', 'error');
            }
        });
    }

    function showNotification(message, type) {
        $('#notification-toast').remove();
        var bgColor = '#28a745';
        var icon = '✅';
        if (type === 'error') { bgColor = '#dc3545'; icon = '❌'; }
        else if (type === 'info') { bgColor = '#17a2b8'; icon = 'ℹ️'; }
        var html = '<div id="notification-toast" style="position:fixed;top:20px;right:20px;z-index:99999;background:'+bgColor+';color:#fff;padding:15px 25px;border-radius:8px;box-shadow:0 4px 15px rgba(0,0,0,0.3);font-size:14px;max-width:450px;animation:slideInRight 0.5s ease;display:flex;align-items:center;gap:10px;">';
        html += '<span style="font-size:20px;">'+icon+'</span><span>'+message+'</span>';
        html += '<button onclick="$(this).closest(\'#notification-toast\').remove()" style="background:none;border:none;color:#fff;font-size:18px;cursor:pointer;margin-left:10px;">&times;</button>';
        html += '</div>';
        $('body').append(html);
        setTimeout(function() {
            $('#notification-toast').fadeOut(500, function() { $(this).remove(); });
        }, 5000);
    }

    // ==============================================
    // TOMBOL AMBIL INDIKATOR
    // ==============================================
    $(document).on('click', '#BtnAmbilIndikatorProgram', function() {
        var programKode = $('#program_select_program').val();
        if (programKode) {
            loadIndikatorProgramMulti(programKode);
        } else {
            alert('Pilih Program terlebih dahulu!');
        }
    });

    // ==============================================
    // FUNGSI INDIKATOR DI MODAL TUJUAN
    // ==============================================
    var counterTujuanIndikator = 0;
    function generateTujuanIndikatorRow(data) {
        var id = data && data.id ? data.id : '';
        var indikator = data && data.indikator ? escapeHtml(data.indikator) : '';
        var satuan = data && data.satuan ? escapeHtml(data.satuan) : '';
        var kondisiAwal = data && data.kondisi_awal ? escapeHtml(data.kondisi_awal) : '';
        var target2026 = data && data.target_2026 ? escapeHtml(data.target_2026) : '';
        var target2027 = data && data.target_2027 ? escapeHtml(data.target_2027) : '';
        var target2028 = data && data.target_2028 ? escapeHtml(data.target_2028) : '';
        var target2029 = data && data.target_2029 ? escapeHtml(data.target_2029) : '';
        var target2030 = data && data.target_2030 ? escapeHtml(data.target_2030) : '';
        
        var counter = counterTujuanIndikator++;
        var html = '<div class="indikator-row" id="tujuan_indikator_row_' + counter + '">';
        html += '<input type="hidden" class="tujuan-indikator-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-indikator btn-remove-tujuan-indikator" data-row="' + counter + '" title="Hapus Indikator">×</button>';
        
        html += '<div class="row"><div class="col-md-12"><div class="form-group"><label>Indikator</label>';
        html += '<textarea class="form-control form-control-sm indikator-textarea" id="tujuan_indikator_' + counter + '" rows="2" placeholder="Nama indikator tujuan...">' + indikator + '</textarea>';
        html += '</div></div></div>';
        
        html += '<div class="row">';
        html += '<div class="col-md-6"><div class="form-group"><label>Satuan</label><input type="text" class="form-control form-control-sm satuan-input" id="tujuan_satuan_' + counter + '" placeholder="contoh: %, Nilai, Indeks" value="' + satuan + '"></div></div>';
        html += '<div class="col-md-6"><div class="form-group"><label>Kondisi Awal</label><input type="text" class="form-control form-control-sm kondisi-input" id="tujuan_kondisi_awal_' + counter + '" placeholder="Kondisi awal..." value="' + kondisiAwal + '"></div></div>';
        html += '</div>';
        
        html += '<div class="row">';
        var years = ['2026','2027','2028','2029','2030'];
        var targetVals = [target2026, target2027, target2028, target2029, target2030];
        for (var y = 0; y < years.length; y++) {
            html += '<div class="col-md-2" style="width:20%;"><div class="form-group"><label style="font-size:11px; color:#007bff;">' + years[y] + '</label>';
            html += '<input type="text" class="form-control form-control-sm target-input" id="tujuan_target_' + years[y] + '_' + counter + '" placeholder="Target ' + years[y] + '" value="' + targetVals[y] + '">';
            html += '</div></div>';
        }
        html += '</div>';
        html += '</div>';
        return html;
    }

    $(document).on("click", "#btnTambahIndikatorTujuan", function() {
        $("#tujuan_indikator_list").append(generateTujuanIndikatorRow(null));
    });

    $(document).on("click", ".btn-remove-tujuan-indikator", function() {
        if ($("#tujuan_indikator_list .indikator-row").length <= 1) {
            alert("Minimal 1 indikator harus ada!");
            return;
        }
        $(this).closest(".indikator-row").remove();
    });

    // ==============================================
    // FUNGSI INDIKATOR DI MODAL SASARAN
    // ==============================================
    var counterSasaranIndikator = 0;
    function generateSasaranIndikatorRow(data) {
        var id = data && data.id ? data.id : '';
        var indikator = data && data.indikator ? escapeHtml(data.indikator) : '';
        var satuan = data && data.satuan ? escapeHtml(data.satuan) : '';
        var kondisiAwal = data && data.kondisi_awal ? escapeHtml(data.kondisi_awal) : '';
        var target2026 = data && data.target_2026 ? escapeHtml(data.target_2026) : '';
        var target2027 = data && data.target_2027 ? escapeHtml(data.target_2027) : '';
        var target2028 = data && data.target_2028 ? escapeHtml(data.target_2028) : '';
        var target2029 = data && data.target_2029 ? escapeHtml(data.target_2029) : '';
        var target2030 = data && data.target_2030 ? escapeHtml(data.target_2030) : '';
        
        var counter = counterSasaranIndikator++;
        var html = '<div class="indikator-row" id="sasaran_indikator_row_' + counter + '">';
        html += '<input type="hidden" class="sasaran-indikator-id" value="' + id + '">';
        html += '<button type="button" class="btn btn-danger btn-sm btn-remove-indikator btn-remove-sasaran-indikator" data-row="' + counter + '" title="Hapus Indikator">×</button>';
        
        html += '<div class="row"><div class="col-md-12"><div class="form-group"><label>Indikator</label>';
        html += '<textarea class="form-control form-control-sm indikator-textarea" id="sasaran_indikator_' + counter + '" rows="2" placeholder="Nama indikator sasaran...">' + indikator + '</textarea>';
        html += '</div></div></div>';
        
        html += '<div class="row">';
        html += '<div class="col-md-6"><div class="form-group"><label>Satuan</label><input type="text" class="form-control form-control-sm satuan-input" id="sasaran_satuan_' + counter + '" placeholder="contoh: %, Nilai, Indeks" value="' + satuan + '"></div></div>';
        html += '<div class="col-md-6"><div class="form-group"><label>Kondisi Awal</label><input type="text" class="form-control form-control-sm kondisi-input" id="sasaran_kondisi_awal_' + counter + '" placeholder="Kondisi awal..." value="' + kondisiAwal + '"></div></div>';
        html += '</div>';
        
        html += '<div class="row">';
        var years = ['2026','2027','2028','2029','2030'];
        var targetVals = [target2026, target2027, target2028, target2029, target2030];
        for (var y = 0; y < years.length; y++) {
            html += '<div class="col-md-2" style="width:20%;"><div class="form-group"><label style="font-size:11px; color:#007bff;">' + years[y] + '</label>';
            html += '<input type="text" class="form-control form-control-sm target-input" id="sasaran_target_' + years[y] + '_' + counter + '" placeholder="Target ' + years[y] + '" value="' + targetVals[y] + '">';
            html += '</div></div>';
        }
        html += '</div>';
        html += '</div>';
        return html;
    }

    $(document).on("click", "#btnTambahIndikatorSasaran", function() {
        $("#sasaran_indikator_list").append(generateSasaranIndikatorRow(null));
    });

    $(document).on("click", ".btn-remove-sasaran-indikator", function() {
        if ($("#sasaran_indikator_list .indikator-row").length <= 1) {
            alert("Minimal 1 indikator harus ada!");
            return;
        }
        $(this).closest(".indikator-row").remove();
    });

    // ==============================================
    // CRUD TUJUAN
    // ==============================================
    $("#btnTambahTujuan").click(function() {
        $("#modalTujuanTitle").text("Tambah Tujuan PD");
        $("#tujuan_id").val('');
        $("#tujuan_uraian").val('');
        $("#tujuan_indikator_list").empty();
        $("#tujuan_indikator_list").append(generateTujuanIndikatorRow(null));
        loadSasaranRPJMD('tujuan_sasaran_rpjmd_id', null);
        loadBidangList('tujuan_bidang_id', null);
        showFixedModal('#modalTujuan');
    });

    $(document).on("click", ".btnEditTujuan", function() {
        var id = $(this).data('id');
        if (!id) { alert('ID tidak valid!'); return; }
        $.ajax({
            url: BaseURL + "Instansi/getRenstraTujuanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $("#modalTujuanTitle").text("Edit Tujuan PD");
                    $("#tujuan_id").val(res.data.id);
                    $("#tujuan_uraian").val(res.data.uraian || '');
                    $("#tujuan_indikator_list").empty();
                    
                    var inds = res.data.indikators || [];
                    if (inds.length > 0) {
                        $.each(inds, function(i, ind) {
                            $("#tujuan_indikator_list").append(generateTujuanIndikatorRow(ind));
                        });
                    } else {
                        $("#tujuan_indikator_list").append(generateTujuanIndikatorRow(null));
                    }

                    loadSasaranRPJMD('tujuan_sasaran_rpjmd_id', res.data.sasaran_rpjmd_id);
                    loadBidangList('tujuan_bidang_id', res.data.bidang_id || null);
                    showFixedModal('#modalTujuan');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusTujuan", function() {
        if (!confirm("Yakin hapus Tujuan ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraTujuanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanTujuan").click(function() {
        var id = $("#tujuan_id").val();
        var uraian = $("#tujuan_uraian").val();
        if (!uraian || !uraian.trim()) {
            alert("Uraian Tujuan wajib diisi!");
            return;
        }

        var indikators = [];
        $("#tujuan_indikator_list .indikator-row").each(function() {
            var indText = $(this).find(".indikator-textarea").val();
            if (indText && indText.trim()) {
                indikators.push({
                    indikator: indText.trim(),
                    satuan: $(this).find(".satuan-input").val(),
                    kondisi_awal: $(this).find(".kondisi-input").val(),
                    target_2026: $(this).find(".target-input:eq(0)").val(),
                    target_2027: $(this).find(".target-input:eq(1)").val(),
                    target_2028: $(this).find(".target-input:eq(2)").val(),
                    target_2029: $(this).find(".target-input:eq(3)").val(),
                    target_2030: $(this).find(".target-input:eq(4)").val()
                });
            }
        });

        $(this).prop('disabled', true).text('Menyimpan...');
        var data = {
            id: id,
            sasaran_rpjmd_id: $("#tujuan_sasaran_rpjmd_id").val(),
            uraian: uraian,
            bidang_id: $("#tujuan_bidang_id").val(),
            indikators: JSON.stringify(indikators),
            [CSRF_NAME]: CSRF_TOKEN
        };
        var url = id ? BaseURL + "Instansi/editRenstraTujuanPD" : BaseURL + "Instansi/tambahRenstraTujuanPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    hideFixedModal('#modalTujuan');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanTujuan").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ==============================================
    // CRUD SASARAN
    // ==============================================
    $(document).on("click", ".btnTambahSasaran", function() {
        var tujuanId = $(this).data('tujuan-id');
        $("#modalSasaranTitle").text("Tambah Sasaran PD");
        $("#sasaran_id").val('');
        $("#sasaran_tujuan_id").val(tujuanId);
        $("#sasaran_uraian").val('');
        $("#sasaran_indikator_list").empty();
        $("#sasaran_indikator_list").append(generateSasaranIndikatorRow(null));
        loadBidangList('sasaran_bidang_id', null);
        showFixedModal('#modalSasaran');
    });

    $(document).on("click", ".btnEditSasaran", function() {
        var id = $(this).data('id');
        if (!id) { alert('ID tidak valid!'); return; }
        $.ajax({
            url: BaseURL + "Instansi/getRenstraSasaranPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $("#modalSasaranTitle").text("Edit Sasaran PD");
                    $("#sasaran_id").val(res.data.id);
                    $("#sasaran_tujuan_id").val(res.data.tujuan_id);
                    $("#sasaran_uraian").val(res.data.uraian || '');
                    $("#sasaran_indikator_list").empty();

                    var inds = res.data.indikators || [];
                    if (inds.length > 0) {
                        $.each(inds, function(i, ind) {
                            $("#sasaran_indikator_list").append(generateSasaranIndikatorRow(ind));
                        });
                    } else {
                        $("#sasaran_indikator_list").append(generateSasaranIndikatorRow(null));
                    }

                    loadBidangList('sasaran_bidang_id', res.data.bidang_id || null);
                    showFixedModal('#modalSasaran');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusSasaran", function() {
        if (!confirm("Yakin hapus Sasaran ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraSasaranPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanSasaran").click(function() {
        var id = $("#sasaran_id").val();
        var uraian = $("#sasaran_uraian").val();
        if (!uraian || !uraian.trim()) {
            alert("Uraian Sasaran wajib diisi!");
            return;
        }

        var indikators = [];
        $("#sasaran_indikator_list .indikator-row").each(function() {
            var indText = $(this).find(".indikator-textarea").val();
            if (indText && indText.trim()) {
                indikators.push({
                    indikator: indText.trim(),
                    satuan: $(this).find(".satuan-input").val(),
                    kondisi_awal: $(this).find(".kondisi-input").val(),
                    target_2026: $(this).find(".target-input:eq(0)").val(),
                    target_2027: $(this).find(".target-input:eq(1)").val(),
                    target_2028: $(this).find(".target-input:eq(2)").val(),
                    target_2029: $(this).find(".target-input:eq(3)").val(),
                    target_2030: $(this).find(".target-input:eq(4)").val()
                });
            }
        });

        $(this).prop('disabled', true).text('Menyimpan...');
        var data = {
            id: id,
            tujuan_id: $("#sasaran_tujuan_id").val(),
            uraian: uraian,
            bidang_id: $("#sasaran_bidang_id").val(),
            indikators: JSON.stringify(indikators),
            [CSRF_NAME]: CSRF_TOKEN
        };
        var url = id ? BaseURL + "Instansi/editRenstraSasaranPD" : BaseURL + "Instansi/tambahRenstraSasaranPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    hideFixedModal('#modalSasaran');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanSasaran").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ==============================================
    // CRUD PROGRAM
    // ==============================================
    
    $(document).on("click", ".btnTambahProgram", function() {
        var sasaranId = $(this).data('sasaran-id');
        $("#modalProgramTitle").text("Tambah Program");
        $("#program_id").val('');
        $("#program_sasaran_id").val(sasaranId);
        $("#program_nama").val('');
        $("#program_kode").val('');
        $('#OutcomeContainer').html('');
        counterOutcome = 0;
        counterIndikator = 0;
        
        nomenklaturCache = {};
        $('#program_select_urusan').html('<option value="">-- Pilih Urusan --</option>');
        $('#program_select_bidang').html('<option value="">-- Pilih Bidang Urusan --</option>').prop('disabled', true);
        $('#program_select_program').html('<option value="">-- Pilih Program --</option>').prop('disabled', true);
        $('#path_display_program').text('Belum ada yang dipilih');
        $('#info_nomenklatur_program').hide();
        $('#BtnAmbilIndikatorProgram').hide();
        
        loadProgramLevel(1, '');
        loadBidangList('program_bidang_id', null);
        addOutcome({ indikators: [] });
        showFixedModal('#modalProgram');
    });

    $(document).on("click", ".btnEditProgram", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Instansi/getRenstraProgramById",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success" && res.data) {
                    var program = res.data;
                    $("#modalProgramTitle").text("Edit Program");
                    $("#program_id").val(program.id);
                    $("#program_sasaran_id").val(program.sasaran_id);
                    $("#program_nama").val(program.nama || '');
                    $("#program_kode").val(program.kode_program || '');
                    
                    var kodeProgram = program.kode_program || '';
                    if (kodeProgram) {
                        var parts = kodeProgram.split('.');
                        nomenklaturCache = {};
                        loadProgramLevel(1, '');
                        setTimeout(function() {
                            if (parts.length >= 1) {
                                $('#program_select_urusan').val(parts[0]);
                                $('#program_select_urusan').trigger('change');
                            }
                        }, 300);
                        if (parts.length >= 2) {
                            setTimeout(function() {
                                if ($('#program_select_bidang option').length > 1) {
                                    $('#program_select_bidang').val(parts.slice(0,2).join('.'));
                                    $('#program_select_bidang').trigger('change');
                                }
                            }, 800);
                        }
                        if (parts.length >= 3) {
                            setTimeout(function() {
                                if ($('#program_select_program option').length > 1) {
                                    $('#program_select_program').val(kodeProgram);
                                    $('#program_select_program').trigger('change');
                                }
                            }, 1300);
                        }
                    }
                    
                    loadBidangList('program_bidang_id', program.bidang_id || null);
                    
                    $('#OutcomeContainer').html('');
                    counterOutcome = 0;
                    counterIndikator = 0;
                    
                    if (program.outcomes && program.outcomes.length > 0) {
                        for (var i = 0; i < program.outcomes.length; i++) {
                            var out = program.outcomes[i];
                            out.indikators = out.indikators || [];
                            addOutcome(out);
                        }
                    } else {
                        addOutcome({ indikators: [] });
                    }
                    
                    showFixedModal('#modalProgram');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusProgram", function() {
        if (!confirm("Yakin hapus Program ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraProgramPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    // ==============================================
    // TAMBAH OUTCOME & INDIKATOR PROGRAM
    // ==============================================
    $("#BtnTambahOutcome").click(function() {
        addOutcome({ indikators: [] });
    });

    $(document).on('click', '.tambah-indikator', function() {
        var groupId = $(this).data('group');
        var listId = '#indikator_list_' + groupId;
        $(listId).append(generateIndikatorRow(groupId, null));
    });

    $(document).on('click', '.btn-remove-outcome', function() {
        if (!confirm('Hapus Outcome ini beserta semua indikatornya?')) return;
        var group = $(this).data('group');
        $('#outcome_group_' + group).remove();
    });

    $(document).on('click', '.btn-remove-indikator', function() {
        if (!confirm('Hapus indikator ini?')) return;
        var row = $(this).data('row');
        $('#indikator_row_' + row).remove();
    });

    // ==============================================
    // SIMPAN PROGRAM
    // ==============================================
    $("#btnSimpanProgram").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        
        var id = $("#program_id").val();
        var sasaran_id = $("#program_sasaran_id").val();
        var nama = $("#program_nama").val().trim();
        var kode_program = $("#program_kode").val().trim();
        var bidang_id = $("#program_bidang_id").val();
        
        if (!nama) {
            alert('Nama Program harus diisi!');
            $(this).prop('disabled', false).text('Simpan Program');
            return;
        }
        
        var outcomes = [];
        var hasError = false;
        var totalIndikator = 0;
        
        $('.outcome-group').each(function() {
            var group = $(this);
            var outcomeId = group.find('.outcome-id').val();
            var outcomeText = group.find('.outcome-textarea').val().trim();
            if (!outcomeText) {
                hasError = true;
                alert('Sasaran (Outcome) tidak boleh kosong!');
                return false;
            }
            var indikators = [];
            group.find('.indikator-row').each(function() {
                var row = $(this);
                var indId = row.find('.indikator-id').val();
                var indText = row.find('.indikator-textarea').val().trim();
                if (!indText) {
                    hasError = true;
                    alert('Indikator tidak boleh kosong!');
                    return false;
                }
                var satuan = row.find('.satuan-input').val().trim();
                var kondisi = row.find('.kondisi-input').val().trim();
                
                var target2026 = row.find('#target_2026_' + row.attr('id').replace('indikator_row_', '')).val().trim();
                var target2027 = row.find('#target_2027_' + row.attr('id').replace('indikator_row_', '')).val().trim();
                var target2028 = row.find('#target_2028_' + row.attr('id').replace('indikator_row_', '')).val().trim();
                var target2029 = row.find('#target_2029_' + row.attr('id').replace('indikator_row_', '')).val().trim();
                var target2030 = row.find('#target_2030_' + row.attr('id').replace('indikator_row_', '')).val().trim();
                
                indikators.push({
                    id: indId,
                    indikator: indText,
                    satuan: satuan,
                    kondisi_awal: kondisi,
                    target_2026: target2026,
                    target_2027: target2027,
                    target_2028: target2028,
                    target_2029: target2029,
                    target_2030: target2030
                });
            });
            if (hasError) return false;
            outcomes.push({
                id: outcomeId,
                outcome_text: outcomeText,
                indikators: indikators
            });
            totalIndikator += indikators.length;
        });
        
        if (hasError) {
            $(this).prop('disabled', false).text('Simpan Program');
            return;
        }
        
        if (outcomes.length === 0) {
            alert('Minimal tambahkan 1 Outcome!');
            $(this).prop('disabled', false).text('Simpan Program');
            return;
        }
        if (totalIndikator === 0) {
            alert('Setiap Outcome minimal memiliki 1 Indikator!');
            $(this).prop('disabled', false).text('Simpan Program');
            return;
        }
        
        var data = {
            id: id,
            sasaran_id: sasaran_id,
            nama: nama,
            kode_program: kode_program,
            bidang_id: bidang_id,
            outcomes: outcomes,
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = id ? BaseURL + "Instansi/editRenstraProgramPD" : BaseURL + "Instansi/tambahRenstraProgramPD";
        
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    hideFixedModal('#modalProgram');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanProgram").prop('disabled', false).text('Simpan Program');
            }
        });
    });

    // ==============================================
    // EVENT UNTUK KEGIATAN
    // ==============================================

    // Tombol Tambah Sasaran Kegiatan
    $("#BtnTambahKegiatanSasaran").click(function() {
        addKegiatanSasaran({ indikators: [] });
    });

    // Tombol Tambah Indikator Kegiatan
    $(document).on('click', '.tambah-kegiatan-indikator', function() {
        var groupId = $(this).data('group');
        var listId = '#kegiatan_indikator_list_' + groupId;
        $(listId).append(generateKegiatanIndikatorRow(groupId, null));
    });

    // Hapus Sasaran Kegiatan
    $(document).on('click', '.btn-remove-outcome[data-type="kegiatan"]', function() {
        if (!confirm('Hapus Sasaran ini beserta semua indikatornya?')) return;
        var group = $(this).data('group');
        $('#kegiatan_sasaran_group_' + group).remove();
    });

    // Hapus Indikator Kegiatan
    $(document).on('click', '.btn-remove-indikator[data-type="kegiatan"]', function() {
        if (!confirm('Hapus indikator ini?')) return;
        var row = $(this).data('row');
        $('#kegiatan_indikator_row_' + row).remove();
    });

    // ==============================================
    // EVENT UNTUK SUB KEGIATAN
    // ==============================================

    // Tombol Tambah Sasaran Sub Kegiatan
    $("#BtnTambahSubKegiatanSasaran").click(function() {
        addSubKegiatanSasaran({ indikators: [] });
    });

    // Tombol Tambah Indikator Sub Kegiatan
    $(document).on('click', '.tambah-subkegiatan-indikator', function() {
        var groupId = $(this).data('group');
        var listId = '#subkegiatan_indikator_list_' + groupId;
        $(listId).append(generateSubKegiatanIndikatorRow(groupId, null));
        initAnggaranInputs();
    });

    // Hapus Sasaran Sub Kegiatan
    $(document).on('click', '.btn-remove-outcome[data-type="subkegiatan"]', function() {
        if (!confirm('Hapus Sasaran ini beserta semua indikatornya?')) return;
        var group = $(this).data('group');
        $('#subkegiatan_sasaran_group_' + group).remove();
    });

    // Hapus Indikator Sub Kegiatan
    $(document).on('click', '.btn-remove-indikator[data-type="subkegiatan"]', function() {
        if (!confirm('Hapus indikator ini?')) return;
        var row = $(this).data('row');
        $('#subkegiatan_indikator_row_' + row).remove();
    });

    // ==============================================
    // CRUD KEGIATAN - DENGAN FIX UNTUK EDIT
    // ==============================================

    $(document).on("click", ".btnTambahKegiatan", function() {
        var programId = $(this).data('program-id');
        $("#modalKegiatanTitle").text("Tambah Kegiatan");
        $("#kegiatan_id").val('');
        $("#kegiatan_program_id").val(programId);
        $("#kegiatan_nama_hidden").val('');
        
        counterKegiatanSasaran = 0;
        counterKegiatanIndikator = 0;
        $('#KegiatanSasaranContainer').html('');
        addKegiatanSasaran({ indikators: [] });
        
        resetKegiatanDropdowns();
        loadKegiatanLevel(1, '');
        loadBidangList('kegiatan_bidang_id', null);
        showFixedModal('#modalKegiatan');
    });

    // ================================================================
    // EDIT KEGIATAN - DENGAN PERBAIKAN NOMENKLATUR
    // ================================================================
    $(document).on("click", ".btnEditKegiatan", function() {
        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak valid!');
            return;
        }
        
        resetKegiatanDropdowns();
        
        $.ajax({
            url: BaseURL + "Instansi/getRenstraKegiatanById",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success" && res.data) {
                    var kegiatan = res.data;
                    $("#modalKegiatanTitle").text("Edit Kegiatan");
                    $("#kegiatan_id").val(kegiatan.id);
                    $("#kegiatan_program_id").val(kegiatan.program_id);
                    
                    var kodeNomenklatur = kegiatan.kode_nomenklatur || '';
                    var namaKegiatan = kegiatan.nama || '';
                    
                    // Reset cache
                    nomenklaturCacheKegiatan = {};
                    
                    // Fungsi untuk mengisi dropdown secara bertahap
                    function fillKegiatanDropdowns(level, parts) {
                        if (level >= parts.length) {
                            var $select = $('#kegiatan_select_kegiatan');
                            if ($select.val()) {
                                var selectedText = $select.find('option:selected').text();
                                if (selectedText && selectedText.indexOf('--') === -1) {
                                    $('#kegiatan_selected_text').text(selectedText);
                                    $('#kegiatan_info_nomenklatur').show();
                                    $('#kegiatan_path_display').text(selectedText);
                                    var nama = selectedText.replace(/^\d+(\.\d+){3}\s*-\s*/, '');
                                    nama = nama.replace(/^\d+(\.\d+){2,3}\s*-\s*/, '');
                                    $('#kegiatan_nama_hidden').val(nama);
                                }
                            }
                            return;
                        }

                        var kode;
                        if (level == 4 && parts.length >= 5) {
                            kode = parts.slice(0, 5).join('.');
                        } else {
                            kode = parts.slice(0, level).join('.');
                        }

                        var selectId = level == 1 ? 'kegiatan_select_urusan' :
                                       (level == 2 ? 'kegiatan_select_bidang' :
                                       (level == 3 ? 'kegiatan_select_program' :
                                       'kegiatan_select_kegiatan'));

                        var checkCount = 0;
                        var maxChecks = 30;
                        var checkInterval = setInterval(function() {
                            var $select = $('#' + selectId);
                            var optionExists = false;

                            $select.find('option').each(function() {
                                if ($(this).val() === kode) {
                                    optionExists = true;
                                    return false;
                                }
                            });

                            if (optionExists && !$select.prop('disabled')) {
                                $select.val(kode);
                                $select.trigger('change');
                                clearInterval(checkInterval);

                                setTimeout(function() {
                                    if (level < parts.length) {
                                        fillKegiatanDropdowns(level + 1, parts);
                                    }
                                }, 500);
                            }

                            checkCount++;
                            if (checkCount >= maxChecks) {
                                clearInterval(checkInterval);
                                var namaKegiatan = $('#kegiatan_nama_hidden').val() || '';
                                if (namaKegiatan) {
                                    $('#kegiatan_selected_text').text(namaKegiatan);
                                    $('#kegiatan_info_nomenklatur').show();
                                    $('#kegiatan_path_display').text('Nama Kegiatan: ' + namaKegiatan);
                                    $('#kegiatan_nama_hidden').val(namaKegiatan);
                                }
                            }
                        }, 200);
                    }
                    
                    loadKegiatanLevel(1, '', function() {
                        if (kodeNomenklatur) {
                            var parts = kodeNomenklatur.split('.');
                            
                            if (parts.length < 4) {
                                $('#kegiatan_selected_text').text(namaKegiatan || kodeNomenklatur);
                                $('#kegiatan_info_nomenklatur').show();
                                $('#kegiatan_path_display').text('Kode: ' + kodeNomenklatur + ' - ' + (namaKegiatan || ''));
                                $('#kegiatan_nama_hidden').val(namaKegiatan || kodeNomenklatur);
                            } else {
                                fillKegiatanDropdowns(1, parts);
                            }
                        } else if (namaKegiatan) {
                            $('#kegiatan_selected_text').text(namaKegiatan);
                            $('#kegiatan_info_nomenklatur').show();
                            $('#kegiatan_path_display').text('Nama Kegiatan: ' + namaKegiatan);
                            $('#kegiatan_nama_hidden').val(namaKegiatan);
                        }
                    });
                    
                    $('#KegiatanSasaranContainer').html('');
                    counterKegiatanSasaran = 0;
                    counterKegiatanIndikator = 0;
                    
                    if (kegiatan.sasaran_list && kegiatan.sasaran_list.length > 0) {
                        for (var i = 0; i < kegiatan.sasaran_list.length; i++) {
                            var sas = kegiatan.sasaran_list[i];
                            sas.indikators = sas.indikators || [];
                            addKegiatanSasaran(sas);
                        }
                    } else {
                        addKegiatanSasaran({ indikators: [] });
                    }
                    
                    loadBidangList('kegiatan_bidang_id', kegiatan.bidang_id || null);
                    showFixedModal('#modalKegiatan');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    $(document).on("click", ".btnHapusKegiatan", function() {
        if (!confirm("Yakin hapus Kegiatan ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraKegiatanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanKegiatan").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        var id = $("#kegiatan_id").val();
        var program_id = $("#kegiatan_program_id").val();
        var bidang_id = $("#kegiatan_bidang_id").val();
        
        var kodeNomenklatur = $('#kegiatan_select_kegiatan').val() || '';
        var nama = $("#kegiatan_nama_hidden").val() || '';
        
        if (!nama) {
            var selectedText = $('#kegiatan_selected_text').text();
            if (selectedText && selectedText.indexOf('--') === -1) {
                nama = selectedText.replace(/^\d+(\.\d+){3}\s*-\s*/, '');
                nama = nama.replace(/^\d+(\.\d+){2,3}\s*-\s*/, '');
            }
        }
        
        if (!nama) {
            alert('Pilih Kegiatan dari dropdown nomenklatur!');
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        
        var sasaranData = [];
        var hasError = false;
        var totalIndikator = 0;
        
        $('.outcome-group').each(function() {
            var group = $(this);
            var sasaranId = group.find('.kegiatan-sasaran-id').val();
            var sasaranText = group.find('.outcome-textarea').val().trim();
            if (!sasaranText) {
                hasError = true;
                alert('Sasaran tidak boleh kosong!');
                return false;
            }
            var indikators = [];
            group.find('.indikator-row').each(function() {
                var row = $(this);
                var indId = row.find('.kegiatan-indikator-id').val();
                var indText = row.find('.indikator-textarea').val().trim();
                if (!indText) {
                    hasError = true;
                    alert('Indikator tidak boleh kosong!');
                    return false;
                }
                var satuan = row.find('.satuan-input').val().trim();
                var kondisi = row.find('.kondisi-input').val().trim();
                
                var target2026 = row.find('#kegiatan_target_2026_' + row.attr('id').replace('kegiatan_indikator_row_', '')).val().trim();
                var target2027 = row.find('#kegiatan_target_2027_' + row.attr('id').replace('kegiatan_indikator_row_', '')).val().trim();
                var target2028 = row.find('#kegiatan_target_2028_' + row.attr('id').replace('kegiatan_indikator_row_', '')).val().trim();
                var target2029 = row.find('#kegiatan_target_2029_' + row.attr('id').replace('kegiatan_indikator_row_', '')).val().trim();
                var target2030 = row.find('#kegiatan_target_2030_' + row.attr('id').replace('kegiatan_indikator_row_', '')).val().trim();
                
                indikators.push({
                    id: indId,
                    indikator: indText,
                    satuan: satuan,
                    kondisi_awal: kondisi,
                    target_2026: target2026,
                    target_2027: target2027,
                    target_2028: target2028,
                    target_2029: target2029,
                    target_2030: target2030
                });
            });
            if (hasError) return false;
            sasaranData.push({
                id: sasaranId,
                sasaran_text: sasaranText,
                indikators: indikators
            });
            totalIndikator += indikators.length;
        });
        
        if (hasError) {
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        
        if (sasaranData.length === 0) {
            alert('Minimal tambahkan 1 Sasaran!');
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        if (totalIndikator === 0) {
            alert('Setiap Sasaran minimal memiliki 1 Indikator!');
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        
        var data = {
            id: id,
            program_id: program_id,
            nama: nama,
            kode_nomenklatur: kodeNomenklatur,
            bidang_id: bidang_id,
            sasaran_data: JSON.stringify(sasaranData),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = id ? BaseURL + "Instansi/editRenstraKegiatanPD" : BaseURL + "Instansi/tambahRenstraKegiatanPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    hideFixedModal('#modalKegiatan');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanKegiatan").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ==============================================
    // CRUD SUB KEGIATAN - DENGAN FIX UNTUK EDIT (PERBAIKAN TOTAL)
    // ==============================================

    $(document).on("click", ".btnTambahSubKegiatan", function() {
        var kegiatanId = $(this).data('kegiatan-id');
        $("#modalSubKegiatanTitle").text("Tambah Sub Kegiatan");
        $("#subkegiatan_id").val('');
        $("#subkegiatan_kegiatan_id").val(kegiatanId);
        $("#subkegiatan_nama_hidden").val('');
        $("#subkegiatan_kode_nomenklatur").val('');
        
        counterSubKegiatanSasaran = 0;
        counterSubKegiatanIndikator = 0;
        $('#SubKegiatanSasaranContainer').html('');
        addSubKegiatanSasaran({ indikators: [] });
        
        resetSubKegiatanDropdowns();
        loadSubLevel(1, '');
        loadBidangList('subkegiatan_bidang_id', null);
        showFixedModal('#modalSubKegiatan');
    });

// ================================================================
// EDIT SUB KEGIATAN - DENGAN PERBAIKAN PEMBAGIAN KODE (FIX TOTAL)
// ================================================================
$(document).on("click", ".btnEditSubKegiatan", function() {
    var id = $(this).data('id');
    if (!id) {
        alert('ID tidak valid!');
        return;
    }
    
    console.log('=== EDIT SUB KEGIATAN ===');
    console.log('ID Sub Kegiatan:', id);
    
    // Reset semua dropdown terlebih dahulu
    resetSubKegiatanDropdowns();
    
    // Tampilkan loading
    showFixedModal('#modalSubKegiatan');
    $('#subkegiatan_path_display').text('Memuat data...');
    
    $.ajax({
        url: BaseURL + "Instansi/getRenstraSubKegiatanById",
        type: "POST",
        data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
        dataType: "json",
        success: function(res) {
            console.log('Response dari server:', res);
            
            if (res.status === "success" && res.data) {
                var sub = res.data;
                console.log('Data Sub Kegiatan:', sub);
                
                $("#modalSubKegiatanTitle").text("Edit Sub Kegiatan");
                $("#subkegiatan_id").val(sub.id);
                $("#subkegiatan_kegiatan_id").val(sub.kegiatan_id);
                
                var kodeNomenklatur = sub.kode_nomenklatur || '';
                var namaSub = sub.nama || '';
                
                // ============================================================
                // JIKA KODE_NOMENKLATUR NULL, EKSTRAK DARI NAMA
                // ============================================================
                if (!kodeNomenklatur && namaSub) {
                    // Ekstrak kode dari nama (ambil bagian sebelum " - ")
                    var partsFromName = namaSub.split(' - ');
                    if (partsFromName.length > 0) {
                        // Cek apakah bagian pertama adalah kode (berisi angka dan titik)
                        var potentialCode = partsFromName[0].trim();
                        if (/^[\d\.]+$/.test(potentialCode)) {
                            kodeNomenklatur = potentialCode;
                            console.log('Kode diekstrak dari nama:', kodeNomenklatur);
                        }
                    }
                }
                
                console.log('Kode Nomenklatur (setelah ekstrak):', kodeNomenklatur);
                console.log('Nama Sub:', namaSub);
                
                // Reset cache
                nomenklaturCacheSub = {};
                
                // Jika ada kode nomenklatur (baik dari DB atau hasil ekstrak), gunakan untuk mengisi dropdown
                if (kodeNomenklatur) {
                    var parts = kodeNomenklatur.split('.');
                    console.log('Parts dari kode nomenklatur:', parts);
                    console.log('Jumlah parts:', parts.length);
                    
                    // ============================================================
                    // FUNGSI UNTUK MENGISI DROPDOWN MENGGUNAKAN API
                    // ============================================================
                    function loadDropdownLevel(level, callback) {
                        console.log('=== loadDropdownLevel level ' + level + ' ===');
                        
                        // Jika level sudah selesai (lebih dari 5)
                        if (level > 5) {
                            console.log('Selesai mengisi semua level');
                            // Set nilai sub kegiatan yang dipilih
                            var $subSelect = $('#subkegiatan_select_subkegiatan');
                            
                            if ($subSelect.val()) {
                                var selectedText = $subSelect.find('option:selected').text();
                                if (selectedText && selectedText.indexOf('--') === -1) {
                                    $('#subkegiatan_selected_text').text(selectedText);
                                    $('#subkegiatan_info_nomenklatur').show();
                                    $('#subkegiatan_path_display').text(selectedText);
                                    var nama = selectedText.replace(/^\d+(\.\d+){4}\s*-\s*/, '');
                                    nama = nama.replace(/^\d+(\.\d+){3,4}\s*-\s*/, '');
                                    $('#subkegiatan_nama_hidden').val(nama);
                                    $('#subkegiatan_kode_nomenklatur').val($subSelect.val());
                                }
                            } else if (namaSub) {
                                $('#subkegiatan_selected_text').text(namaSub);
                                $('#subkegiatan_info_nomenklatur').show();
                                $('#subkegiatan_path_display').text(namaSub);
                                $('#subkegiatan_nama_hidden').val(namaSub);
                                if (kodeNomenklatur) {
                                    $('#subkegiatan_kode_nomenklatur').val(kodeNomenklatur);
                                }
                            }
                            if (callback) callback();
                            return;
                        }

                        // ============================================================
                        // Tentukan kode berdasarkan level:
                        // Level 1: 1 bagian (1)
                        // Level 2: 2 bagian (1.01)
                        // Level 3: 3 bagian (1.01.02)
                        // Level 4: 4 bagian (1.01.02.1) - KEGIATAN
                        // Level 5: 5 bagian (1.01.02.1.01) - SUB KEGIATAN
                        // ============================================================
                        var kode;
                        if (level == 1) {
                            kode = parts[0];
                        } else if (level == 2) {
                            kode = parts.slice(0, 2).join('.');
                        } else if (level == 3) {
                            kode = parts.slice(0, 3).join('.');
                        } else if (level == 4) {
                            // Level 4: Kegiatan - ambil 4 bagian (1.01.02.1)
                            kode = parts.slice(0, 4).join('.');
                        } else if (level == 5) {
                            // Level 5: Sub Kegiatan - ambil semua bagian (1.01.02.1.01)
                            kode = parts.join('.');
                        }
                        console.log('Kode untuk level ' + level + ':', kode);

                        var selectId = '';
                        var label = '';
                        if (level == 1) {
                            selectId = 'subkegiatan_select_urusan';
                            label = 'Urusan';
                        } else if (level == 2) {
                            selectId = 'subkegiatan_select_bidang';
                            label = 'Bidang';
                        } else if (level == 3) {
                            selectId = 'subkegiatan_select_program';
                            label = 'Program';
                        } else if (level == 4) {
                            selectId = 'subkegiatan_select_kegiatan';
                            label = 'Kegiatan';
                        } else if (level == 5) {
                            selectId = 'subkegiatan_select_subkegiatan';
                            label = 'Sub Kegiatan';
                        }

                        // Tentukan parent kode
                        var parentKode = '';
                        if (level == 2) {
                            parentKode = parts[0];
                        } else if (level == 3) {
                            parentKode = parts.slice(0, 2).join('.');
                        } else if (level == 4) {
                            parentKode = parts.slice(0, 3).join('.');
                        } else if (level == 5) {
                            parentKode = parts.slice(0, 4).join('.');
                        }
                        console.log('Parent Kode untuk level ' + level + ':', parentKode);

                        // Panggil API untuk mendapatkan data
                        $.ajax({
                            url: BaseURL + "Instansi/getNomenklaturByLevelRenja",
                            type: "POST",
                            data: {
                                level: level,
                                parent_kode: parentKode || '',
                                [CSRF_NAME]: CSRF_TOKEN
                            },
                            dataType: 'json',
                            success: function(resData) {
                                console.log('Data level ' + level + ':', resData);
                                
                                var $select = $('#' + selectId);
                                var options = '<option value="">-- Pilih ' + label + ' --</option>';
                                
                                if (resData && resData.length > 0) {
                                    for (var i = 0; i < resData.length; i++) {
                                        var selected = (resData[i].Kode === kode) ? ' selected' : '';
                                        options += '<option value="' + resData[i].Kode + '"' + selected + '>' + 
                                                   resData[i].Kode + ' - ' + resData[i].Nomenklatur + '</option>';
                                    }
                                }
                                $select.html(options).prop('disabled', false);
                                
                                // Cek apakah kode ada
                                var optionExists = false;
                                $select.find('option').each(function() {
                                    if ($(this).val() === kode) {
                                        optionExists = true;
                                        return false;
                                    }
                                });
                                
                                if (optionExists) {
                                    $select.val(kode);
                                    $select.trigger('change');
                                    console.log('Level ' + level + ' berhasil diisi:', kode);
                                } else {
                                    console.log('Level ' + level + ' tidak ditemukan kode:', kode);
                                    // Cari berdasarkan prefix
                                    $select.find('option').each(function() {
                                        var val = $(this).val();
                                        if (val && kode.indexOf(val) === 0) {
                                            $select.val(val);
                                            $select.trigger('change');
                                            console.log('Level ' + level + ' ditemukan dengan prefix:', val);
                                            return false;
                                        }
                                    });
                                }
                                
                                // Lanjut ke level berikutnya
                                setTimeout(function() {
                                    loadDropdownLevel(level + 1, callback);
                                }, 300);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error loading level ' + level + ':', error);
                                setTimeout(function() {
                                    loadDropdownLevel(level + 1, callback);
                                }, 300);
                            }
                        });
                    }
                    
                    // ============================================================
                    // MULAI PROSES PENGISIAN DROPDOWN
                    // ============================================================
                    loadDropdownLevel(1);
                    
                } else if (namaSub) {
                    console.log('Tidak ada kode nomenklatur, hanya nama:', namaSub);
                    $('#subkegiatan_selected_text').text(namaSub);
                    $('#subkegiatan_info_nomenklatur').show();
                    $('#subkegiatan_path_display').text('Nama Sub Kegiatan: ' + namaSub);
                    $('#subkegiatan_nama_hidden').val(namaSub);
                    loadSubLevel(1, '');
                } else {
                    console.log('Tidak ada data nomenklatur sama sekali');
                    $('#subkegiatan_path_display').text('Tidak ada data nomenklatur');
                    loadSubLevel(1, '');
                }
                
                // ==============================================
                // LOAD SASARAN & INDIKATOR
                // ==============================================
                $('#SubKegiatanSasaranContainer').html('');
                counterSubKegiatanSasaran = 0;
                counterSubKegiatanIndikator = 0;
                
                if (sub.sasaran_list && sub.sasaran_list.length > 0) {
                    console.log('Jumlah sasaran:', sub.sasaran_list.length);
                    for (var i = 0; i < sub.sasaran_list.length; i++) {
                        var sas = sub.sasaran_list[i];
                        sas.indikators = sas.indikators || [];
                        addSubKegiatanSasaran(sas);
                    }
                } else {
                    console.log('Tidak ada sasaran');
                    addSubKegiatanSasaran({ indikators: [] });
                }
                
                loadBidangList('subkegiatan_bidang_id', sub.bidang_id || null);
                
            } else {
                alert(res.message || 'Gagal mengambil data!');
                hideFixedModal('#modalSubKegiatan');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            console.error('Response:', xhr.responseText);
            alert('Terjadi kesalahan: ' + error);
            hideFixedModal('#modalSubKegiatan');
        }
    });
});

    $(document).on("click", ".btnHapusSubKegiatan", function() {
        if (!confirm("Yakin hapus Sub Kegiatan ini?")) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusRenstraSubKegiatanPD",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#btnSimpanSubKegiatan").click(function() {
        $(this).prop('disabled', true).text('Menyimpan...');
        var id = $("#subkegiatan_id").val();
        var kegiatan_id = $("#subkegiatan_kegiatan_id").val();
        var bidang_id = $("#subkegiatan_bidang_id").val();
        var nama = $("#subkegiatan_nama_hidden").val() || '';
        var kodeNomenklatur = $("#subkegiatan_kode_nomenklatur").val() || '';
        
        if (!nama) {
            var selectedText = $('#subkegiatan_selected_text').text();
            if (selectedText && selectedText.indexOf('--') === -1) {
                nama = selectedText.replace(/^\d+(\.\d+){4}\s*-\s*/, '');
                nama = nama.replace(/^\d+(\.\d+){3,4}\s*-\s*/, '');
            }
        }
        
        if (!nama) {
            alert('Pilih Sub Kegiatan dari dropdown nomenklatur!');
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        
        var sasaranData = [];
        var hasError = false;
        var totalIndikator = 0;
        
        $('.outcome-group').each(function() {
            var group = $(this);
            var sasaranId = group.find('.subkegiatan-sasaran-id').val();
            var sasaranText = group.find('.outcome-textarea').val().trim();
            if (!sasaranText) {
                hasError = true;
                alert('Sasaran tidak boleh kosong!');
                return false;
            }
            var indikators = [];
            group.find('.indikator-row').each(function() {
                var row = $(this);
                var indId = row.find('.subkegiatan-indikator-id').val();
                var indText = row.find('.indikator-textarea').val().trim();
                if (!indText) {
                    hasError = true;
                    alert('Indikator tidak boleh kosong!');
                    return false;
                }
                var satuan = row.find('.satuan-input').val().trim();
                var kondisi = row.find('.kondisi-input').val().trim();
                
                var target2026 = row.find('#subkegiatan_target_2026_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().trim();
                var anggaran2026 = row.find('#subkegiatan_anggaran_2026_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().replace(/[^0-9]/g, '');
                var target2027 = row.find('#subkegiatan_target_2027_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().trim();
                var anggaran2027 = row.find('#subkegiatan_anggaran_2027_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().replace(/[^0-9]/g, '');
                var target2028 = row.find('#subkegiatan_target_2028_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().trim();
                var anggaran2028 = row.find('#subkegiatan_anggaran_2028_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().replace(/[^0-9]/g, '');
                var target2029 = row.find('#subkegiatan_target_2029_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().trim();
                var anggaran2029 = row.find('#subkegiatan_anggaran_2029_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().replace(/[^0-9]/g, '');
                var target2030 = row.find('#subkegiatan_target_2030_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().trim();
                var anggaran2030 = row.find('#subkegiatan_anggaran_2030_' + row.attr('id').replace('subkegiatan_indikator_row_', '')).val().replace(/[^0-9]/g, '');
                
                indikators.push({
                    id: indId,
                    indikator: indText,
                    satuan: satuan,
                    kondisi_awal: kondisi,
                    target_2026: target2026,
                    anggaran_2026: anggaran2026 || null,
                    target_2027: target2027,
                    anggaran_2027: anggaran2027 || null,
                    target_2028: target2028,
                    anggaran_2028: anggaran2028 || null,
                    target_2029: target2029,
                    anggaran_2029: anggaran2029 || null,
                    target_2030: target2030,
                    anggaran_2030: anggaran2030 || null
                });
            });
            if (hasError) return false;
            sasaranData.push({
                id: sasaranId,
                sasaran_text: sasaranText,
                indikators: indikators
            });
            totalIndikator += indikators.length;
        });
        
        if (hasError) {
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        
        if (sasaranData.length === 0) {
            alert('Minimal tambahkan 1 Sasaran!');
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        if (totalIndikator === 0) {
            alert('Setiap Sasaran minimal memiliki 1 Indikator!');
            $(this).prop('disabled', false).text('Simpan');
            return;
        }
        
        var data = {
            id: id,
            kegiatan_id: kegiatan_id,
            nama: nama,
            kode_nomenklatur: kodeNomenklatur,
            bidang_id: bidang_id,
            sasaran_data: JSON.stringify(sasaranData),
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        var url = id ? BaseURL + "Instansi/editRenstraSubKegiatanPD" : BaseURL + "Instansi/tambahRenstraSubKegiatanPD";
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    alert(res.message);
                    hideFixedModal('#modalSubKegiatan');
                    location.reload();
                } else {
                    alert(res.message || "Terjadi kesalahan!");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            },
            complete: function() {
                $("#btnSimpanSubKegiatan").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ==============================================
    // RESET MODAL
    // ==============================================
    $(document).on('hidden.bs.modal', '.modal.fixed-modal', function() {
        $("#btnSimpanTujuan").prop('disabled', false).text('Simpan');
        $("#btnSimpanSasaran").prop('disabled', false).text('Simpan');
        $("#btnSimpanProgram").prop('disabled', false).text('Simpan Program');
        $("#btnSimpanKegiatan").prop('disabled', false).text('Simpan');
        $("#btnSimpanSubKegiatan").prop('disabled', false).text('Simpan');
    });

});
</script>

</body>
</html>