<?php
// Fungsi pembantu untuk menerjemahkan kode JSON kementerian menjadi string nama
if (!function_exists('renderPengampu')) {
    function renderPengampu($jsonString, $map) {
        if (empty($jsonString)) return '-';
        $arr = json_decode($jsonString, true);
        if(!is_array($arr)) $arr = explode(',', $jsonString);
        $names = [];
        foreach($arr as $kd) {
            $kd = trim($kd);
            if($kd == '') continue;
            $names[] = isset($map[$kd]) ? $map[$kd] : $kd;
        }
        return implode(', ', $names);
    }
}
?>
<style>
    /* CSS untuk Modal Vertical Center */
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
        width: 800px; /* Diperlebar karena form indikator banyak kolomnya */
        max-width: 95%; 
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /* CSS Card Container Enhancement */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    /* CSS Table Enhancement */
    #hierarki-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #hierarki-table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
        font-size: 13px;
    }
    
    #hierarki-table > tbody > tr {
        transition: filter 0.2s ease;
    }
    #hierarki-table > tbody > tr:hover {
        filter: brightness(0.96); 
    }

    /* CSS Button & Badge Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0 2px;
        transition: all 0.3s ease;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    /* Warna penanda level hierarki (Kiri Border) */
    .border-pn { border-left: 4px solid #8bc34a !important; }
    .border-pp { border-left: 4px solid #00bcd4 !important; }
    .border-kp { border-left: 4px solid #ff9800 !important; }
    .border-proyek { border-left: 4px solid #9c27b0 !important; }
    .border-sasaran { border-left: 4px solid #607d8b !important; }
    .border-indikator { border-left: 4px solid #e0e0e0 !important; }
    
    .badge-periode {
        background-color: #8bc34a;
        color: white;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 11px;
    }

    /* Penyesuaian UI Select2 agar menyatu dengan Bootstrap Notika */
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
        min-height: 35px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 2px 0;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #ffffff !important; 
        border: 1px solid #111111 !important;
        color: #333333 !important; 
        border-radius: 3px;
        padding: 4px 8px;
        margin-top: 4px;
        font-weight: 600; 
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #111111 !important; 
        margin-right: 5px;
        font-weight: bold;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #d9534f !important; 
        background-color: transparent !important;
    }
</style>

<!-- Load Library Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Proyek Strategis RPJMN</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Induk (Level 1) -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputPN" style="padding: 8px 15px; font-size: 13px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Prioritas Nasional</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="hierarki-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 35%;">Uraian Proyek Strategis</th>
                                    <th style="width: 7%;" class="text-center">Satuan</th>
                                    <th style="width: 7%;" class="text-center">Baseline</th>
                                    <th style="width: 7%;" class="text-center">T.Awal</th>
                                    <th style="width: 7%;" class="text-center">T.Akhir</th>
                                    <th style="width: 12%;">Pengampu</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 20%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($ProyekStrategis) && count($ProyekStrategis) > 0) {
                                    $noPN = 1;
                                    $mapKemen = isset($MapKementerian) ? $MapKementerian : [];
                                    foreach ($ProyekStrategis as $pn) { 
                                ?>
                                    <!-- ============================================== LEVEL 1: PRIORITAS NASIONAL -->
                                    <tr data-id="pn-<?= $pn['Id'] ?>" data-parent="" data-expanded="false" style="background-color: #f1f8e9;">
                                        <td class="text-center"><b><?= $noPN ?></b></td>
                                        <td colspan="6" class="border-pn" style="cursor: pointer;" onclick="toggleLevel('pn-<?= $pn['Id'] ?>', this)">
                                            <b>PRIORITAS NASIONAL:</b> <?= $pn['PrioritasNasional'] ?> 
                                            <span class="badge-periode"><?= $pn['TahunMulai'].'-'.$pn['TahunAkhir'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success TambahSasaran btn-action" data-id="<?= $pn['Id'] ?>" data-tipe="PN" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sas</button>
                                            <button class="btn btn-sm btn-success TambahPP btn-action" data-id="<?= $pn['Id'] ?>" title="Tambah Program Prioritas"><i class="fa fa-plus"></i> PP</button>
                                            <button class="btn btn-sm btn-info EditPN btn-action" data-id="<?= $pn['Id'] ?>" data-idvisi="<?= $pn['_IdVisi'] ?>" data-pn="<?= $pn['PrioritasNasional'] ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger HapusPN btn-action" data-id="<?= $pn['Id'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                        <!-- CABANG SASARAN PN -->
                                        <?php if(isset($pn['Sasaran'])) { foreach ($pn['Sasaran'] as $sasPN) { ?>
                                        <tr data-id="saspn-<?= $sasPN['Id'] ?>" data-parent="pn-<?= $pn['Id'] ?>" data-expanded="false" style="display: none; background-color: #f5f5f5;">
                                            <td></td>
                                            <td colspan="6" class="border-sasaran" style="padding-left: 20px; cursor: pointer; color: #555;" onclick="toggleLevel('saspn-<?= $sasPN['Id'] ?>', this)">
                                                <i class="fa fa-angle-right"></i> <b>SASARAN:</b> <?= $sasPN['Sasaran'] ?>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success TambahIndikator btn-action" data-id="<?= $sasPN['Id'] ?>" data-tipe="PN" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                <button class="btn btn-sm btn-info EditSasaran btn-action" data-id="<?= $sasPN['Id'] ?>" data-tipe="PN" data-parentid="<?= $pn['Id'] ?>" data-sasaran="<?= $sasPN['Sasaran'] ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger HapusSasaran btn-action" data-id="<?= $sasPN['Id'] ?>" data-tipe="PN" title="Hapus"><i class="fa fa-trash"></i></button>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                            <!-- CABANG INDIKATOR PN -->
                                            <?php if(isset($sasPN['Indikator'])) { foreach ($sasPN['Indikator'] as $indPN) { ?>
                                            <tr data-id="indpn-<?= $indPN['Id'] ?>" data-parent="saspn-<?= $sasPN['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff;">
                                                <td></td>
                                                <td class="border-indikator" style="padding-left: 40px; color: #666;">- <?= $indPN['Indikator'] ?></td>
                                                <td class="text-center"><?= $indPN['Satuan'] ?></td>
                                                <td class="text-center"><?= $indPN['Baseline'] ?></td>
                                                <td class="text-center"><b><?= $indPN['TargetAwal'] ?></b></td>
                                                <td class="text-center"><b><?= $indPN['TargetAkhir'] ?></b></td>
                                                <td><small><?= renderPengampu($indPN['Pengampu'], $mapKemen) ?></small></td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-info EditIndikator btn-action" data-id="<?= $indPN['Id'] ?>" data-tipe="PN" data-parentid="<?= $sasPN['Id'] ?>" data-indikator="<?= $indPN['Indikator'] ?>" data-satuan="<?= $indPN['Satuan'] ?>" data-baseline="<?= $indPN['Baseline'] ?>" data-targetawal="<?= $indPN['TargetAwal'] ?>" data-targetakhir="<?= $indPN['TargetAkhir'] ?>" data-pengampu="<?= htmlspecialchars($indPN['Pengampu'], ENT_QUOTES, 'UTF-8') ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger HapusIndikator btn-action" data-id="<?= $indPN['Id'] ?>" data-tipe="PN" title="Hapus"><i class="fa fa-trash"></i></button>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <?php } } ?>
                                        <?php } } ?>

                                        <!-- ============================================== LEVEL 2: PROGRAM PRIORITAS -->
                                        <?php if(isset($pn['ProgramPrioritas'])) { $noPP=1; foreach ($pn['ProgramPrioritas'] as $pp) { ?>
                                        <tr data-id="pp-<?= $pp['Id'] ?>" data-parent="pn-<?= $pn['Id'] ?>" data-expanded="false" style="display: none; background-color: #e0f7fa;">
                                            <td></td>
                                            <td colspan="6" class="border-pp" style="padding-left: 20px; cursor: pointer;" onclick="toggleLevel('pp-<?= $pp['Id'] ?>', this)">
                                                <b style="color: #00838f;">PROGRAM PRIORITAS <?= $noPN.'.'.$noPP ?>:</b> <?= $pp['ProgramPrioritas'] ?>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success TambahSasaran btn-action" data-id="<?= $pp['Id'] ?>" data-tipe="PP" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sas</button>
                                                <button class="btn btn-sm btn-success TambahKP btn-action" data-id="<?= $pp['Id'] ?>" title="Tambah Kegiatan Prioritas"><i class="fa fa-plus"></i> KP</button>
                                                <button class="btn btn-sm btn-info EditPP btn-action" data-id="<?= $pp['Id'] ?>" data-idpn="<?= $pn['Id'] ?>" data-pp="<?= $pp['ProgramPrioritas'] ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger HapusPP btn-action" data-id="<?= $pp['Id'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                            <!-- CABANG SASARAN PP -->
                                            <?php if(isset($pp['Sasaran'])) { foreach ($pp['Sasaran'] as $sasPP) { ?>
                                            <tr data-id="saspp-<?= $sasPP['Id'] ?>" data-parent="pp-<?= $pp['Id'] ?>" data-expanded="false" style="display: none; background-color: #f5f5f5;">
                                                <td></td>
                                                <td colspan="6" class="border-sasaran" style="padding-left: 40px; cursor: pointer; color: #555;" onclick="toggleLevel('saspp-<?= $sasPP['Id'] ?>', this)">
                                                    <i class="fa fa-angle-right"></i> <b>SASARAN:</b> <?= $sasPP['Sasaran'] ?>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-success TambahIndikator btn-action" data-id="<?= $sasPP['Id'] ?>" data-tipe="PP" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                    <button class="btn btn-sm btn-info EditSasaran btn-action" data-id="<?= $sasPP['Id'] ?>" data-tipe="PP" data-parentid="<?= $pp['Id'] ?>" data-sasaran="<?= $sasPP['Sasaran'] ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger HapusSasaran btn-action" data-id="<?= $sasPP['Id'] ?>" data-tipe="PP" title="Hapus"><i class="fa fa-trash"></i></button>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                                <!-- CABANG INDIKATOR PP -->
                                                <?php if(isset($sasPP['Indikator'])) { foreach ($sasPP['Indikator'] as $indPP) { ?>
                                                <tr data-id="indpp-<?= $indPP['Id'] ?>" data-parent="saspp-<?= $sasPP['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff;">
                                                    <td></td>
                                                    <td class="border-indikator" style="padding-left: 60px; color: #666;">- <?= $indPP['Indikator'] ?></td>
                                                    <td class="text-center"><?= $indPP['Satuan'] ?></td>
                                                    <td class="text-center"><?= $indPP['Baseline'] ?></td>
                                                    <td class="text-center"><b><?= $indPP['TargetAwal'] ?></b></td>
                                                    <td class="text-center"><b><?= $indPP['TargetAkhir'] ?></b></td>
                                                    <td><small><?= renderPengampu($indPP['Pengampu'], $mapKemen) ?></small></td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-info EditIndikator btn-action" data-id="<?= $indPP['Id'] ?>" data-tipe="PP" data-parentid="<?= $sasPP['Id'] ?>" data-indikator="<?= $indPP['Indikator'] ?>" data-satuan="<?= $indPP['Satuan'] ?>" data-baseline="<?= $indPP['Baseline'] ?>" data-targetawal="<?= $indPP['TargetAwal'] ?>" data-targetakhir="<?= $indPP['TargetAkhir'] ?>" data-pengampu="<?= htmlspecialchars($indPP['Pengampu'], ENT_QUOTES, 'UTF-8') ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger HapusIndikator btn-action" data-id="<?= $indPP['Id'] ?>" data-tipe="PP" title="Hapus"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php } } ?>
                                            <?php } } ?>

                                            <!-- ============================================== LEVEL 3: KEGIATAN PRIORITAS -->
                                            <?php if(isset($pp['KegiatanPrioritas'])) { $noKP=1; foreach ($pp['KegiatanPrioritas'] as $kp) { ?>
                                            <tr data-id="kp-<?= $kp['Id'] ?>" data-parent="pp-<?= $pp['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff3e0;">
                                                <td></td>
                                                <td colspan="6" class="border-kp" style="padding-left: 40px; cursor: pointer;" onclick="toggleLevel('kp-<?= $kp['Id'] ?>', this)">
                                                    <b style="color: #ef6c00;">KEGIATAN PRIORITAS <?= $noPN.'.'.$noPP.'.'.$noKP ?>:</b> <?= $kp['KegiatanPrioritas'] ?>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-success TambahSasaran btn-action" data-id="<?= $kp['Id'] ?>" data-tipe="KP" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sas</button>
                                                    <button class="btn btn-sm btn-success TambahProyek btn-action" data-id="<?= $kp['Id'] ?>" title="Tambah Proyek Prioritas"><i class="fa fa-plus"></i> Proyek</button>
                                                    <button class="btn btn-sm btn-info EditKP btn-action" data-id="<?= $kp['Id'] ?>" data-idpp="<?= $pp['Id'] ?>" data-kp="<?= $kp['KegiatanPrioritas'] ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger HapusKP btn-action" data-id="<?= $kp['Id'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                                <!-- CABANG SASARAN KP -->
                                                <?php if(isset($kp['Sasaran'])) { foreach ($kp['Sasaran'] as $sasKP) { ?>
                                                <tr data-id="saskp-<?= $sasKP['Id'] ?>" data-parent="kp-<?= $kp['Id'] ?>" data-expanded="false" style="display: none; background-color: #f5f5f5;">
                                                    <td></td>
                                                    <td colspan="6" class="border-sasaran" style="padding-left: 60px; cursor: pointer; color: #555;" onclick="toggleLevel('saskp-<?= $sasKP['Id'] ?>', this)">
                                                        <i class="fa fa-angle-right"></i> <b>SASARAN:</b> <?= $sasKP['Sasaran'] ?>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-success TambahIndikator btn-action" data-id="<?= $sasKP['Id'] ?>" data-tipe="KP" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button>
                                                        <button class="btn btn-sm btn-info EditSasaran btn-action" data-id="<?= $sasKP['Id'] ?>" data-tipe="KP" data-parentid="<?= $kp['Id'] ?>" data-sasaran="<?= $sasKP['Sasaran'] ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger HapusSasaran btn-action" data-id="<?= $sasKP['Id'] ?>" data-tipe="KP" title="Hapus"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                    <!-- CABANG INDIKATOR KP -->
                                                    <?php if(isset($sasKP['Indikator'])) { foreach ($sasKP['Indikator'] as $indKP) { ?>
                                                    <tr data-id="indkp-<?= $indKP['Id'] ?>" data-parent="saskp-<?= $sasKP['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff;">
                                                        <td></td>
                                                        <td class="border-indikator" style="padding-left: 80px; color: #666;">- <?= $indKP['Indikator'] ?></td>
                                                        <td class="text-center"><?= $indKP['Satuan'] ?></td>
                                                        <td class="text-center"><?= $indKP['Baseline'] ?></td>
                                                        <td class="text-center"><b><?= $indKP['TargetAwal'] ?></b></td>
                                                        <td class="text-center"><b><?= $indKP['TargetAkhir'] ?></b></td>
                                                        <td><small><?= renderPengampu($indKP['Pengampu'], $mapKemen) ?></small></td>
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-info EditIndikator btn-action" data-id="<?= $indKP['Id'] ?>" data-tipe="KP" data-parentid="<?= $sasKP['Id'] ?>" data-indikator="<?= $indKP['Indikator'] ?>" data-satuan="<?= $indKP['Satuan'] ?>" data-baseline="<?= $indKP['Baseline'] ?>" data-targetawal="<?= $indKP['TargetAwal'] ?>" data-targetakhir="<?= $indKP['TargetAkhir'] ?>" data-pengampu="<?= htmlspecialchars($indKP['Pengampu'], ENT_QUOTES, 'UTF-8') ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-danger HapusIndikator btn-action" data-id="<?= $indKP['Id'] ?>" data-tipe="KP" title="Hapus"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php } } ?>
                                                <?php } } ?>

                                                <!-- ============================================== LEVEL 4: PROYEK PRIORITAS -->
                                                <?php if(isset($kp['Proyek'])) { $noProy=1; foreach ($kp['Proyek'] as $proy) { ?>
                                                <tr data-id="proy-<?= $proy['Id'] ?>" data-parent="kp-<?= $kp['Id'] ?>" data-expanded="false" style="display: none; background-color: #f3e5f5;">
                                                    <td></td>
                                                    <td colspan="6" class="border-proyek" style="padding-left: 60px;">
                                                        <b style="color: #6a1b9a;">PROYEK PRIORITAS <?= $noPN.'.'.$noPP.'.'.$noKP.'.'.$noProy ?>:</b> <?= $proy['ProyekPrioritas'] ?>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-info EditProyek btn-action" data-id="<?= $proy['Id'] ?>" data-idkp="<?= $kp['Id'] ?>" data-proyek="<?= $proy['ProyekPrioritas'] ?>" title="Edit"><i class="fa fa-edit"></i> Edit</button>
                                                        <button class="btn btn-sm btn-danger HapusProyek btn-action" data-id="<?= $proy['Id'] ?>" title="Hapus"><i class="fa fa-trash"></i> Hapus</button>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php $noProy++; } } ?>

                                            <?php $noKP++; } } ?>

                                        <?php $noPP++; } } ?>
                                <?php 
                                        $noPN++;
                                    } // End Loop PN
                                } else { ?>
                                    <tr>
                                        <td colspan="8" class="text-center" style="padding: 30px; color: #999;">Belum ada data Proyek Strategis RPJMN.</td>
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

<!-- ============================================================================================== -->
<!-- MODAL KHUSUS MAIN LEVEL (1 - 4) -->
<!-- ============================================================================================== -->

<!-- 1. MODAL PRIORITAS NASIONAL -->
<div class="modal fade" id="ModalInputPN" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Tambah Prioritas Nasional</h2></div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group ic-cmp-int"><div class="form-ic-cmp"><i class="fa fa-flag"></i></div>
                            <div class="nk-int-st" style="width: 100%;">
                                <select class="form-control" id="IdVisiPN">
                                    <option value="">Pilih Periode RPJMN</option>
                                    <?php if(isset($ComboVisi)) { foreach ($ComboVisi as $cv) { echo "<option value='".$cv['Id']."'>".$cv['TahunMulai']." - ".$cv['TahunAkhir']."</option>"; } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                            <div class="nk-int-st"><textarea class="form-control" id="PrioritasNasional" rows="3" placeholder="Uraian Prioritas Nasional"></textarea></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanPN"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditPN" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Edit Prioritas Nasional</h2></div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdPNForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group ic-cmp-int"><div class="form-ic-cmp"><i class="fa fa-flag"></i></div>
                            <div class="nk-int-st" style="width: 100%;">
                                <select class="form-control" id="_IdVisiPN">
                                    <option value="">Pilih Periode RPJMN</option>
                                    <?php if(isset($ComboVisi)) { foreach ($ComboVisi as $cv) { echo "<option value='".$cv['Id']."'>".$cv['TahunMulai']." - ".$cv['TahunAkhir']."</option>"; } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                            <div class="nk-int-st"><textarea class="form-control" id="_PrioritasNasional" rows="3" placeholder="Uraian Prioritas Nasional"></textarea></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnPN"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- 2. MODAL PROGRAM PRIORITAS -->
<div class="modal fade" id="ModalInputPP" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Tambah Program Prioritas</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdPNParent">
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="ProgramPrioritas" rows="3" placeholder="Uraian Program Prioritas"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-success btn-action" id="SimpanPP"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div></div>
</div>

<div class="modal fade" id="ModalEditPP" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Edit Program Prioritas</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdPPForm"><input type="hidden" id="_IdPNParent">
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="_ProgramPrioritas" rows="3" placeholder="Uraian Program Prioritas"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-info btn-action" id="EditBtnPP"><i class="fa fa-save"></i> Update</button>
        </div>
    </div></div>
</div>

<!-- 3. MODAL KEGIATAN PRIORITAS -->
<div class="modal fade" id="ModalInputKP" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Tambah Kegiatan Prioritas</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdPPParent">
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="KegiatanPrioritas" rows="3" placeholder="Uraian Kegiatan Prioritas"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-success btn-action" id="SimpanKP"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div></div>
</div>

<div class="modal fade" id="ModalEditKP" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Edit Kegiatan Prioritas</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdKPForm"><input type="hidden" id="_IdPPParent">
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="_KegiatanPrioritas" rows="3" placeholder="Uraian Kegiatan Prioritas"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-info btn-action" id="EditBtnKP"><i class="fa fa-save"></i> Update</button>
        </div>
    </div></div>
</div>

<!-- 4. MODAL PROYEK PRIORITAS -->
<div class="modal fade" id="ModalInputProyek" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Tambah Proyek Prioritas</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdKPParent">
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="ProyekPrioritas" rows="3" placeholder="Uraian Proyek Prioritas"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-success btn-action" id="SimpanProyek"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div></div>
</div>

<div class="modal fade" id="ModalEditProyek" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Edit Proyek Prioritas</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdProyekForm"><input type="hidden" id="_IdKPParent">
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="_ProyekPrioritas" rows="3" placeholder="Uraian Proyek Prioritas"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-info btn-action" id="EditBtnProyek"><i class="fa fa-save"></i> Update</button>
        </div>
    </div></div>
</div>

<!-- ============================================================================================== -->
<!-- UNIVERSAL MODAL: SASARAN & INDIKATOR (Bisa Menyesuaikan PN, PP, atau KP) -->
<!-- ============================================================================================== -->

<!-- UNIVERSAL SASARAN -->
<div class="modal fade" id="ModalInputSasaran" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Tambah Sasaran</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <!-- Hidden Fields penentu target tabel/controller AJAX -->
            <input type="hidden" id="IdParentSasaran">
            <input type="hidden" id="TipeLevelSasaran"> 
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="UniversalSasaran" rows="3" placeholder="Uraian Sasaran"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-success btn-action" id="SimpanSasaran"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div></div>
</div>

<div class="modal fade" id="ModalEditSasaran" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Edit Sasaran</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdSasaranForm">
            <input type="hidden" id="_IdParentSasaran">
            <input type="hidden" id="_TipeLevelSasaran"> 
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="_UniversalSasaran" rows="3" placeholder="Uraian Sasaran"></textarea></div>
            </div></div></div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-info btn-action" id="EditBtnSasaran"><i class="fa fa-save"></i> Update</button>
        </div>
    </div></div>
</div>

<!-- UNIVERSAL INDIKATOR -->
<div class="modal fade" id="ModalInputIndikator" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Tambah Indikator</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdSasaranParent">
            <input type="hidden" id="TipeLevelIndikator"> 
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="UniversalIndikator" rows="2" placeholder="Uraian Indikator"></textarea></div>
            </div></div></div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-balance-scale"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="Satuan" placeholder="Satuan (Contoh: %, Orang, Unit)"></div>
                </div></div>
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-bar-chart"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="Baseline" placeholder="Baseline"></div>
                </div></div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-bullseye"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="TargetAwal" placeholder="Target Awal"></div>
                </div></div>
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-flag-checkered"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="TargetAkhir" placeholder="Target Akhir"></div>
                </div></div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-lg-12"><div class="form-group ic-cmp-int">
                    <div class="form-ic-cmp"><i class="fa fa-building"></i></div>
                    <div class="nk-int-st" style="width: 100%;">
                        <select class="select2 form-control" multiple="multiple" id="Pengampu" data-placeholder="Pilih Kementerian Pengampu">
                            <?php if(isset($Kementerian)) { foreach ($Kementerian as $k) { echo "<option value='".$k['Id']."'>".$k['NamaKementerian']."</option>"; } } ?>
                        </select>
                    </div>
                </div></div>
            </div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-success btn-action" id="SimpanIndikator"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div></div>
</div>

<div class="modal fade" id="ModalEditIndikator" role="dialog">
    <div class="modal-dialog modals-default"><div class="modal-content">
        <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h2>Edit Indikator</h2></div>
        <div class="modal-body" style="padding-top: 20px;">
            <input type="hidden" id="IdIndikatorForm">
            <input type="hidden" id="_IdSasaranParent">
            <input type="hidden" id="_TipeLevelIndikator"> 
            <div class="row"><div class="col-lg-12"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-edit"></i></div>
                <div class="nk-int-st"><textarea class="form-control" id="_UniversalIndikator" rows="2" placeholder="Uraian Indikator"></textarea></div>
            </div></div></div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-balance-scale"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="_Satuan" placeholder="Satuan"></div>
                </div></div>
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-bar-chart"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="_Baseline" placeholder="Baseline"></div>
                </div></div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-bullseye"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="_TargetAwal" placeholder="Target Awal"></div>
                </div></div>
                <div class="col-lg-6"><div class="form-group ic-cmp-int float-lb floating-lb"><div class="form-ic-cmp"><i class="fa fa-flag-checkered"></i></div>
                    <div class="nk-int-st"><input type="text" class="form-control" id="_TargetAkhir" placeholder="Target Akhir"></div>
                </div></div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-lg-12"><div class="form-group ic-cmp-int">
                    <div class="form-ic-cmp"><i class="fa fa-building"></i></div>
                    <div class="nk-int-st" style="width: 100%;">
                        <select class="select2 form-control" multiple="multiple" id="_Pengampu" data-placeholder="Pilih Kementerian Pengampu">
                            <?php if(isset($Kementerian)) { foreach ($Kementerian as $k) { echo "<option value='".$k['Id']."'>".$k['NamaKementerian']."</option>"; } } ?>
                        </select>
                    </div>
                </div></div>
            </div>
        </div>
        <div class="modal-footer" style="padding-top: 15px;">
            <button type="button" class="btn btn-info btn-action" id="EditBtnIndikator"><i class="fa fa-save"></i> Update</button>
        </div>
    </div></div>
</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery-price-slider.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.scrollUp.min.js"></script>
<script src="../js/meanmenu/jquery.meanmenu.js"></script>
<script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>
<script src="../js/main.js"></script>
<!-- Load Library Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // JS Logic Toggle Hierarki Tabel
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
        saveExpandedState();
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

    function saveExpandedState() {
        var expanded = [];
        document.querySelectorAll('tr[data-expanded="true"]').forEach(function(tr) {
            expanded.push(tr.getAttribute('data-id'));
        });
        sessionStorage.setItem('expandedRowsProyekStrategis', JSON.stringify(expanded)); 
    }

    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>'; 

        // Inisialisasi Select2
        $('.select2').select2({ width: '100%' });

        // Restore State Hierarki
        var expandedRows = JSON.parse(sessionStorage.getItem('expandedRowsProyekStrategis')) || [];
        document.querySelectorAll('#hierarki-table tbody tr').forEach(function(tr) {
            var id = tr.getAttribute('data-id');
            if (expandedRows.includes(id)) {
                tr.setAttribute('data-expanded', 'true');
                var trs = document.querySelectorAll('tr[data-parent="' + id + '"]');
                trs.forEach(function(childTr) {
                    childTr.style.display = 'table-row';
                });
            }
        });
        saveExpandedState();

        // Otomatis Expand saat klik tombol Tambah sub-level
        $('#hierarki-table tbody').on('click', '.TambahPP, .TambahKP, .TambahProyek, .TambahSasaran, .TambahIndikator', function() {
            var parentRow = $(this).closest('tr')[0];
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }
        });

        // ============================================== SCRIPT LEVEL 1 (PN)
        $("#SimpanPN").click(function() {
            if ($("#IdVisiPN").val() == "") alert('Pilih Periode RPJMN!');
            else if ($("#PrioritasNasional").val() == "") alert('Isi Prioritas Nasional!');
            else {
                $.post(BaseURL+"Nasional/InputPS_PN", { _IdVisi: $("#IdVisiPN").val(), PrioritasNasional: $("#PrioritasNasional").val() }).done(function(Respon) {
                    if(Respon=='1') window.location.reload(); else alert(Respon);
                });
            }
        });

        $('#hierarki-table tbody').on('click', '.EditPN', function () {
            $("#IdPNForm").val($(this).data('id'));
            $("#_IdVisiPN").val($(this).data('idvisi'));
            $("#_PrioritasNasional").val($(this).data('pn'));
            $('#ModalEditPN').modal("show");
        });

        $("#EditBtnPN").click(function() {
            $.post(BaseURL+"Nasional/EditPS_PN", { Id: $("#IdPNForm").val(), _IdVisi: $("#_IdVisiPN").val(), PrioritasNasional: $("#_PrioritasNasional").val() }).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.HapusPN', function () {
            if(confirm("Yakin hapus Prioritas Nasional ini? Sub-data dibawahnya akan hilang.")) {
                $.post(BaseURL+"Nasional/HapusPS_PN", { Id: $(this).data('id') }).done(function(Respon) {
                    if(Respon=='1') window.location.reload(); else alert(Respon);
                });
            }
        });

        // ============================================== SCRIPT LEVEL 2 (PP)
        $('#hierarki-table tbody').on('click', '.TambahPP', function() {
            $('#IdPNParent').val($(this).data('id'));
            $('#ModalInputPP').modal('show');
        });

        $("#SimpanPP").click(function() {
            $.post(BaseURL+"Nasional/InputPS_PP", { _IdPN: $("#IdPNParent").val(), ProgramPrioritas: $("#ProgramPrioritas").val() }).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.EditPP', function () {
            $("#IdPPForm").val($(this).data('id'));
            $("#_IdPNParent").val($(this).data('idpn'));
            $("#_ProgramPrioritas").val($(this).data('pp'));
            $('#ModalEditPP').modal("show");
        });

        $("#EditBtnPP").click(function() {
            $.post(BaseURL+"Nasional/EditPS_PP", { Id: $("#IdPPForm").val(), _IdPN: $("#_IdPNParent").val(), ProgramPrioritas: $("#_ProgramPrioritas").val() }).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.HapusPP', function () {
            if(confirm("Yakin hapus Program Prioritas ini?")) {
                $.post(BaseURL+"Nasional/HapusPS_PP", { Id: $(this).data('id') }).done(function(Respon) {
                    if(Respon=='1') window.location.reload(); else alert(Respon);
                });
            }
        });

        // ============================================== SCRIPT LEVEL 3 (KP)
        $('#hierarki-table tbody').on('click', '.TambahKP', function() {
            $('#IdPPParent').val($(this).data('id'));
            $('#ModalInputKP').modal('show');
        });

        $("#SimpanKP").click(function() {
            $.post(BaseURL+"Nasional/InputPS_KP", { _IdPP: $("#IdPPParent").val(), KegiatanPrioritas: $("#KegiatanPrioritas").val() }).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.EditKP', function () {
            $("#IdKPForm").val($(this).data('id'));
            $("#_IdPPParent").val($(this).data('idpp'));
            $("#_KegiatanPrioritas").val($(this).data('kp'));
            $('#ModalEditKP').modal("show");
        });

        $("#EditBtnKP").click(function() {
            $.post(BaseURL+"Nasional/EditPS_KP", { Id: $("#IdKPForm").val(), _IdPP: $("#_IdPPParent").val(), KegiatanPrioritas: $("#_KegiatanPrioritas").val() }).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.HapusKP', function () {
            if(confirm("Yakin hapus Kegiatan Prioritas ini?")) {
                $.post(BaseURL+"Nasional/HapusPS_KP", { Id: $(this).data('id') }).done(function(Respon) {
                    if(Respon=='1') window.location.reload(); else alert(Respon);
                });
            }
        });

        // ============================================== SCRIPT LEVEL 4 (PROYEK)
        $('#hierarki-table tbody').on('click', '.TambahProyek', function() {
            $('#IdKPParent').val($(this).data('id'));
            $('#ModalInputProyek').modal('show');
        });

        $("#SimpanProyek").click(function() {
            $.post(BaseURL+"Nasional/InputPS_Proyek", { _IdKP: $("#IdKPParent").val(), ProyekPrioritas: $("#ProyekPrioritas").val() }).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.EditProyek', function () {
            $("#IdProyekForm").val($(this).data('id'));
            $("#_IdKPParent").val($(this).data('idkp'));
            $("#_ProyekPrioritas").val($(this).data('proyek'));
            $('#ModalEditProyek').modal("show");
        });

        $("#EditBtnProyek").click(function() {
            $.post(BaseURL+"Nasional/EditPS_Proyek", { Id: $("#IdProyekForm").val(), _IdKP: $("#_IdKPParent").val(), ProyekPrioritas: $("#_ProyekPrioritas").val() }).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.HapusProyek', function () {
            if(confirm("Yakin hapus Proyek Prioritas ini?")) {
                $.post(BaseURL+"Nasional/HapusPS_Proyek", { Id: $(this).data('id') }).done(function(Respon) {
                    if(Respon=='1') window.location.reload(); else alert(Respon);
                });
            }
        });

        // ============================================== SCRIPT UNIVERSAL SASARAN (PN, PP, KP)
        $('#hierarki-table tbody').on('click', '.TambahSasaran', function() {
            $('#IdParentSasaran').val($(this).data('id'));
            $('#TipeLevelSasaran').val($(this).data('tipe')); // Menyimpan tipe "PN", "PP", atau "KP"
            $('#ModalInputSasaran').modal('show');
        });

        $("#SimpanSasaran").click(function() {
            var tipe = $("#TipeLevelSasaran").val();
            var Data = { Sasaran: $("#UniversalSasaran").val() };
            Data["_Id" + tipe] = $("#IdParentSasaran").val(); // Dinamis: _IdPN, _IdPP, atau _IdKP
            
            $.post(BaseURL+"Nasional/InputPS_Sasaran" + tipe, Data).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.EditSasaran', function () {
            $("#IdSasaranForm").val($(this).data('id'));
            $("#_IdParentSasaran").val($(this).data('parentid'));
            $("#_TipeLevelSasaran").val($(this).data('tipe'));
            $("#_UniversalSasaran").val($(this).data('sasaran'));
            $('#ModalEditSasaran').modal("show");
        });

        $("#EditBtnSasaran").click(function() {
            var tipe = $("#_TipeLevelSasaran").val();
            var Data = { Id: $("#IdSasaranForm").val(), Sasaran: $("#_UniversalSasaran").val() };
            Data["_Id" + tipe] = $("#_IdParentSasaran").val();
            
            $.post(BaseURL+"Nasional/EditPS_Sasaran" + tipe, Data).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.HapusSasaran', function () {
            if(confirm("Yakin hapus Sasaran ini? Indikator didalamnya juga akan hilang.")) {
                var tipe = $(this).data('tipe');
                $.post(BaseURL+"Nasional/HapusPS_Sasaran" + tipe, { Id: $(this).data('id') }).done(function(Respon) {
                    if(Respon=='1') window.location.reload(); else alert(Respon);
                });
            }
        });

        // ============================================== SCRIPT UNIVERSAL INDIKATOR (PN, PP, KP)
        $('#hierarki-table tbody').on('click', '.TambahIndikator', function() {
            $('#IdSasaranParent').val($(this).data('id'));
            $('#TipeLevelIndikator').val($(this).data('tipe')); // Menyimpan tipe "PN", "PP", atau "KP"
            $('#Pengampu').val(null).trigger('change'); // Kosongkan pilihan saat nambah baru
            $('#ModalInputIndikator').modal('show');
        });

        $("#SimpanIndikator").click(function() {
            var tipe = $("#TipeLevelIndikator").val();
            var Data = { 
                Indikator: $("#UniversalIndikator").val(), Satuan: $("#Satuan").val(), 
                Baseline: $("#Baseline").val(), TargetAwal: $("#TargetAwal").val(), 
                TargetAkhir: $("#TargetAkhir").val(), 
                Pengampu: $("#Pengampu").val() ? JSON.stringify($("#Pengampu").val()) : '[]' // Convert jadi JSON array 
            };
            Data["_IdSasaran" + tipe] = $("#IdSasaranParent").val(); // Dinamis: _IdSasaranPN, dll.
            
            $.post(BaseURL+"Nasional/InputPS_Indikator" + tipe, Data).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.EditIndikator', function () {
            $("#IdIndikatorForm").val($(this).data('id'));
            $("#_IdSasaranParent").val($(this).data('parentid'));
            $("#_TipeLevelIndikator").val($(this).data('tipe'));
            
            $("#_UniversalIndikator").val($(this).data('indikator'));
            $("#_Satuan").val($(this).data('satuan'));
            $("#_Baseline").val($(this).data('baseline'));
            $("#_TargetAwal").val($(this).data('targetawal'));
            $("#_TargetAkhir").val($(this).data('targetakhir'));
            
            // Logika mengisi array Select2
            var pengampuData = $(this).data('pengampu');
            var pengampuArr = [];
            try {
                if(typeof pengampuData === 'string') {
                    pengampuArr = JSON.parse(pengampuData);
                } else if (typeof pengampuData === 'object') {
                    pengampuArr = pengampuData;
                }
            } catch(e) {
                // Fallback kalau data jadul pakai koma biasa
                pengampuArr = pengampuData ? pengampuData.split(',') : [];
            }
            $('#_Pengampu').val(pengampuArr).trigger('change');
            
            $('#ModalEditIndikator').modal("show");
        });

        $("#EditBtnIndikator").click(function() {
            var tipe = $("#_TipeLevelIndikator").val();
            var Data = { 
                Id: $("#IdIndikatorForm").val(), Indikator: $("#_UniversalIndikator").val(), 
                Satuan: $("#_Satuan").val(), Baseline: $("#_Baseline").val(), 
                TargetAwal: $("#_TargetAwal").val(), TargetAkhir: $("#_TargetAkhir").val(), 
                Pengampu: $("#_Pengampu").val() ? JSON.stringify($("#_Pengampu").val()) : '[]'
            };
            Data["_IdSasaran" + tipe] = $("#_IdSasaranParent").val();
            
            $.post(BaseURL+"Nasional/EditPS_Indikator" + tipe, Data).done(function(Respon) {
                if(Respon=='1') window.location.reload(); else alert(Respon);
            });
        });

        $('#hierarki-table tbody').on('click', '.HapusIndikator', function () {
            if(confirm("Yakin hapus Indikator ini?")) {
                var tipe = $(this).data('tipe');
                $.post(BaseURL+"Nasional/HapusPS_Indikator" + tipe, { Id: $(this).data('id') }).done(function(Respon) {
                    if(Respon=='1') window.location.reload(); else alert(Respon);
                });
            }
        });

    });
</script>