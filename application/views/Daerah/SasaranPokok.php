<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 4px 18px rgba(0,0,0,0.06); padding: 25px 25px 30px; background: #fff; border: 1px solid #e2e8f0;">
                        
                        <!-- Filter untuk pengguna yang belum login -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="filter-box-custom" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px 20px; margin-bottom: 25px;">
                                <div class="row align-items-center" style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 15px;">
                                    <div style="flex: 1; min-width: 220px;">
                                        <label for="Provinsi" style="font-weight: 600; color: #475569; margin-bottom: 6px; display: block; font-size: 13px;">
                                            <i class="fa fa-map-marker" style="margin-right: 5px; color: #3b82f6;"></i>Provinsi
                                        </label>
                                        <select class="form-control" id="Provinsi" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div style="flex: 1; min-width: 220px;">
                                        <label for="KabKota" style="font-weight: 600; color: #475569; margin-bottom: 6px; display: block; font-size: 13px;">
                                            <i class="fa fa-building" style="margin-right: 5px; color: #3b82f6;"></i>Kab/Kota
                                        </label>
                                        <select class="form-control" id="KabKota" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                                            <option value="">Pilih Kab/Kota</option>
                                        </select>
                                    </div>
                                    <div style="min-width: 130px;">
                                        <button class="btn btn-primary" id="Filter" style="border-radius: 8px; height: 40px; padding: 0 20px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-shadow: 0 2px 4px rgba(59,130,246,0.25);">
                                            <i class="fa fa-filter"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Info Wilayah -->
                        <?php if (!empty($KodeWilayah)) { ?>
                            <?php 
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                            ?>
                            <div class="alert alert-info" style="border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #0284c7; background: #f0f9ff; color: #0369a1; padding: 12px 18px;">
                                <i class="fa fa-map-marker" style="margin-right: 6px;"></i><strong>Wilayah:</strong> <?= $nama_wilayah ?>
                            </div>
                        <?php } ?>

                        <!-- Header Halaman & Tombol Tambah -->
                        <div class="page-header-title-box" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 18px; border-bottom: 1px solid #e2e8f0;">
                            <div>
                                <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px;">
                                    <span style="background: #eff6ff; color: #2563eb; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 18px;">
                                        <i class="fa fa-bullseye"></i>
                                    </span>
                                    SASARAN POKOK DAN IUP
                                </h2>
                                <p style="margin: 5px 0 0 50px; color: #64748b; font-size: 13px;">Manajemen Data Sasaran Pokok dan Indikator Utama Pembangunan (IUP) RPJPD</p>
                            </div>
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                            <div>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalInputSasaranPokok" style="border-radius: 8px; padding: 9px 20px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                                    <i class="fa fa-plus-circle"></i> Tambah Sasaran Pokok
                                </button>
                            </div>
                            <?php } ?>
                        </div>

                        <!-- ============================================================
                        TABEL SASARAN POKOK DAN IUP (DIPERBAIKI)
                        ============================================================ -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2" style="vertical-align: middle; width: 3%;">No</th>
                                        <th rowspan="2" style="vertical-align: middle; width: 10%;">Periode</th>
                                        <th rowspan="2" style="vertical-align: middle; width: 15%;">Misi</th>
                                        <th rowspan="2" style="vertical-align: middle; width: 14%;">Sasaran Pokok</th>
                                        <th rowspan="2" style="vertical-align: middle; width: 14%;">Indikator Utama Pembangunan</th>
                                        <th rowspan="2" style="vertical-align: middle; width: 5%;">Satuan</th>
                                        <th style="text-align: center; width: 8%;">Tahap I<br><small>2025-2029</small></th>
                                        <th style="text-align: center; width: 8%;">Tahap II<br><small>2030-2034</small></th>
                                        <th style="text-align: center; width: 8%;">Tahap III<br><small>2035-2039</small></th>
                                        <th style="text-align: center; width: 8%;">Tahap IV<br><small>2040-2045</small></th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th rowspan="2" style="vertical-align: middle; width: 12%;">Aksi<br><small>Sasaran</small></th>
                                        <th rowspan="2" style="vertical-align: middle; width: 12%;">Aksi<br><small>IUP</small></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $No = 1;
                                    
                                    // 🔴 GROUP IUP per Sasaran Pokok
                                    $IUPGrouped = [];
                                    foreach ($IUP as $iup) {
                                        $IUPGrouped[$iup['IdSasaranPokok']][] = $iup;
                                    }

                                    $NomorMisi = [];
                                    $NoMisi = 1;

                                    foreach ($SasaranPokok as $sp) {
                                        $key = $sp['Periode'] . '_' . $sp['IdMisi'];
                                        if (!isset($NomorMisi[$key])) {
                                            $NomorMisi[$key] = $NoMisi++;
                                        }
                                    }
                                    
                                    // 🔴 GROUP Sasaran Pokok berdasarkan Misi
                                    $sasaranByMisi = [];
                                    foreach ($SasaranPokok as $sp) {
                                        $sasaranByMisi[$sp['IdMisi']][] = $sp;
                                    }
                                    
                                    // 🔴 HITUNG ROWSPAN DENGAN BENAR
                                    $sasaranRowspan = [];
                                    foreach ($SasaranPokok as $sp) {
                                        // Ambil IUP untuk sasaran ini
                                        $iupForSasaran = isset($IUPGrouped[$sp['Id']]) ? $IUPGrouped[$sp['Id']] : [];
                                        
                                        // Rowspan = jumlah IUP, minimal 1
                                        $sasaranRowspan[$sp['Id']] = !empty($iupForSasaran) ? count($iupForSasaran) : 1;
                                    }
                                    
                                    // Hitung rowspan untuk setiap Misi
                                    $misiRowspan = [];
                                    foreach ($sasaranByMisi as $idMisi => $sasaranList) {
                                        $total = 0;
                                        foreach ($sasaranList as $sp) {
                                            $total += $sasaranRowspan[$sp['Id']];
                                        }
                                        $misiRowspan[$idMisi] = $total;
                                    }
                                    
                                    // Hitung rowspan untuk setiap Periode
                                    $periodeRowspan = [];
                                    foreach ($SasaranPokok as $sp) {
                                        $periodeKey = $sp['Periode'] ?? '-';
                                        if (!isset($periodeRowspan[$periodeKey])) {
                                            $periodeRowspan[$periodeKey] = 0;
                                        }
                                        $periodeRowspan[$periodeKey] += $sasaranRowspan[$sp['Id']];
                                    }
                                    
                                    $hasAksi = (isset($_SESSION['Level']) && $_SESSION['Level'] == 3);
                                    $totalCols = $hasAksi ? 14 : 12;
                                    ?>
                                    
                                    <?php if (!empty($SasaranPokok)) { 
                                        $currentPeriode = null;
                                        $currentMisiId = null;
                                        $counterSasaran = 0;
                                        
                                        foreach ($SasaranPokok as $index => $sp) {
                                            $iupList = isset($IUPGrouped[$sp['Id']]) ? $IUPGrouped[$sp['Id']] : [];
                                            $rowspanSasaran = $sasaranRowspan[$sp['Id']];
                                            $rowspanMisi = isset($misiRowspan[$sp['IdMisi']]) ? $misiRowspan[$sp['IdMisi']] : 1;
                                            
                                            $isNewPeriode = ($currentPeriode != $sp['Periode']);
                                            if ($isNewPeriode) {
                                                $currentPeriode = $sp['Periode'];
                                            }
                                            
                                            $isNewMisi = ($currentMisiId != $sp['IdMisi']);
                                            if ($isNewMisi) {
                                                $currentMisiId = $sp['IdMisi'];
                                            }
                                            
                                            $counterSasaran++;
                                            $nomorSasaran = $counterSasaran;
                                            $key = $sp['Periode'] . '_' . $sp['IdMisi'];
                                            
                                            if (empty($iupList)) {
                                                // Tanpa IUP
                                                ?>
                                                <tr>
                                                    <?php if ($isNewMisi) { ?>
                                                        <td class="text-center" rowspan="<?= $rowspanMisi ?>">
                                                            <?= $NomorMisi[$key] ?? '' ?>
                                                        </td>
                                                    <?php } ?>
                                                                                    
                                                    <?php if ($isNewPeriode) { ?>
                                                        <td rowspan="<?= $periodeRowspan[$sp['Periode']] ?? 1 ?>" style="vertical-align: middle;">
                                                            <?= html_escape($sp['Periode'] ?? '-') ?>
                                                        </td>
                                                    <?php } ?>
                                                    
                                                    <?php if ($isNewMisi) { ?>
                                                        <td rowspan="<?= $rowspanMisi ?>" style="vertical-align: middle;">
                                                            <?= html_escape($sp['Misi']) ?>
                                                            <?php if ($hasAksi) { ?>
                                                                <br>
                                                                <div style="display:flex; gap:3px; justify-content:center; flex-wrap:wrap; margin-top:5px;">
                                                                    <button class="btn btn-xs btn-amber EditPeriodeMisi" 
                                                                            data-idmisi="<?= $sp['IdMisi'] ?>" 
                                                                            style="font-size:10px; padding:2px 8px;" 
                                                                            title="Edit Periode dan Misi">
                                                                        <i class="notika-icon notika-edit"></i> Edit
                                                                    </button>
                                                                    <button class="btn btn-xs btn-danger HapusPeriodeMisi" 
                                                                            data-idmisi="<?= $sp['IdMisi'] ?>"
                                                                            data-periode="<?= html_escape($sp['Periode'] ?? '') ?>"
                                                                            data-misi="<?= html_escape($sp['Misi']) ?>"
                                                                            style="font-size:10px; padding:2px 8px;" 
                                                                            title="Hapus Periode dan Misi">
                                                                        <i class="notika-icon notika-trash"></i> Hapus
                                                                    </button>
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                    
                                                    <!-- 🔴 SASARAN POKOK -->
                                                    <td>
                                                        <?= html_escape($sp['SasaranPokok']) ?>
                                                        <?php if ($hasAksi) { ?>
                                                            <br>
                                                            <button class="btn btn-xs btn-success TambahSasaranRow" 
                                                                    data-idmisi="<?= $sp['IdMisi'] ?>" 
                                                                    data-periode="<?= html_escape($sp['Periode'] ?? '') ?>"
                                                                    data-misi="<?= html_escape($sp['Misi']) ?>"
                                                                    data-visiid="<?= $sp['IdVisi'] ?? '' ?>"
                                                                    style="font-size:10px; padding:2px 6px; margin-top:3px;">
                                                                <i class="notika-icon bi-plus-lg"></i> Tambah Sasaran
                                                            </button>
                                                        <?php } ?>
                                                    </td>
                                                    
                                                    <!-- 🔴 KOSONGKAN KOLOM IUP -->
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    
                                                    <?php if ($hasAksi) { ?>
                                                        <td class="text-center" style="vertical-align: middle;">
                                                            <div style="display:flex; gap:3px; justify-content:center; flex-wrap:wrap;">
                                                                <button class="btn btn-sm btn-amber EditSasaran" Edit="<?= $sp['Id'] ?>" title="Edit Sasaran">
                                                                    <i class="notika-icon notika-edit" style="font-size:12px;"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-danger HapusSasaran" Hapus="<?= $sp['Id'] ?>" title="Hapus Sasaran">
                                                                    <i class="notika-icon notika-trash" style="font-size:12px;"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle;">
                                                            <div style="display:flex; gap:3px; justify-content:center; flex-wrap:wrap;">
                                                                <button class="btn btn-sm btn-primary TambahIUP" 
                                                                        data-id="<?= $sp['Id'] ?>"
                                                                        data-idmisi="<?= $sp['IdMisi'] ?>"
                                                                        data-visiid="<?= $sp['IdVisi'] ?? '' ?>"
                                                                        data-periode="<?= html_escape($sp['Periode'] ?? '') ?>"
                                                                        data-misi="<?= html_escape($sp['Misi']) ?>"
                                                                        data-sasaran="<?= html_escape($sp['SasaranPokok']) ?>"
                                                                        style="font-size:10px; padding:2px 6px;"
                                                                        title="Tambah IUP">
                                                                    <i class="notika-icon bi-plus-lg"></i> IUP
                                                                </button>
                                                            </div>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            } else {
                                                // 🔴 ADA IUP - TAMPILKAN SEMUA IUP
                                                $iupCount = count($iupList);
                                                foreach ($iupList as $i => $iup) {
                                                    ?>
                                                    <tr>
                                                        <?php if ($i == 0 && $isNewMisi) { ?>
                                                            <td class="text-center" rowspan="<?= $rowspanMisi ?>">
                                                                <?= $NomorMisi[$key] ?? '' ?>
                                                            </td>
                                                        <?php } ?>
                                                        
                                                        <?php if ($isNewPeriode && $i == 0) { ?>
                                                            <td rowspan="<?= $periodeRowspan[$sp['Periode']] ?? 1 ?>" style="vertical-align: middle;">
                                                                <?= html_escape($sp['Periode'] ?? '-') ?>
                                                            </td>
                                                        <?php } ?>
                                                        
                                                        <?php if ($isNewMisi && $i == 0) { ?>
                                                            <td rowspan="<?= $rowspanMisi ?>" style="vertical-align: middle;">
                                                                <?= html_escape($sp['Misi']) ?>
                                                                <?php if ($hasAksi) { ?>
                                                                    <br>
                                                                    <div style="display:flex; gap:3px; justify-content:center; flex-wrap:wrap; margin-top:5px;">
                                                                        <button class="btn btn-xs btn-amber EditPeriodeMisi" 
                                                                                data-idmisi="<?= $sp['IdMisi'] ?>" 
                                                                                style="font-size:10px; padding:2px 8px;" 
                                                                                title="Edit Periode dan Misi">
                                                                            <i class="notika-icon notika-edit"></i>
                                                                        </button>
                                                                        <button class="btn btn-xs btn-danger HapusPeriodeMisi" 
                                                                                data-idmisi="<?= $sp['IdMisi'] ?>"
                                                                                data-periode="<?= html_escape($sp['Periode'] ?? '') ?>"
                                                                                data-misi="<?= html_escape($sp['Misi']) ?>"
                                                                                style="font-size:10px; padding:2px 8px;" 
                                                                                title="Hapus Periode dan Misi">
                                                                            <i class="notika-icon notika-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                        <?php } ?>
                                                        
                                                        <!-- 🔴 SASARAN POKOK - TAMPILKAN HANYA DI BARIS PERTAMA -->
                                                        <?php if ($i == 0) { ?>
                                                            <td rowspan="<?= $rowspanSasaran ?>" style="vertical-align: middle;">
                                                                <?= html_escape($sp['SasaranPokok']) ?>
                                                                <?php if ($hasAksi) { ?>
                                                                    <br>
                                                                    <button class="btn btn-xs btn-success TambahSasaranRow" 
                                                                            data-idmisi="<?= $sp['IdMisi'] ?>" 
                                                                            data-periode="<?= html_escape($sp['Periode'] ?? '') ?>"
                                                                            data-misi="<?= html_escape($sp['Misi']) ?>"
                                                                            data-visiid="<?= $sp['IdVisi'] ?? '' ?>"
                                                                            style="font-size:10px; padding:2px 6px; margin-top:3px;">
                                                                        <i class="notika-icon bi-plus-lg"></i> Tambah Sasaran
                                                                    </button>
                                                                <?php } ?>
                                                            </td>
                                                        <?php } ?>
                                                        
                                                        <!-- 🔴 IUP - TAMPILKAN DI SETIAP BARIS -->
                                                        <td><?= html_escape($iup['Indikator'] ?? '-') ?></td>
                                                        <td><?= html_escape($iup['Satuan'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_I'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_II'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_III'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_IV'] ?? '-') ?></td>
                                                        
                                                        <?php if ($hasAksi) { ?>
                                                            <!-- 🔴 AKSI SASARAN - TAMPILKAN HANYA DI BARIS PERTAMA -->
                                                            <?php if ($i == 0) { ?>
                                                                <td class="text-center" rowspan="<?= $rowspanSasaran ?>" style="vertical-align: middle;">
                                                                    <div style="display:flex; gap:3px; justify-content:center; flex-wrap:wrap;">
                                                                        <button class="btn btn-sm btn-amber EditSasaran" Edit="<?= $sp['Id'] ?>" title="Edit Sasaran">
                                                                            <i class="notika-icon notika-edit" style="font-size:12px;"></i>
                                                                        </button>
                                                                        <button class="btn btn-sm btn-danger HapusSasaran" Hapus="<?= $sp['Id'] ?>" title="Hapus Sasaran">
                                                                            <i class="notika-icon notika-trash" style="font-size:12px;"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            <?php } ?>
                                                            
                                                            <!-- 🔴 AKSI IUP - TAMPILKAN DI SETIAP BARIS -->
                                                            <td class="text-center" style="vertical-align: middle;">
                                                                <div style="display:flex; gap:3px; justify-content:center; flex-wrap:wrap;">
                                                                    <?php if ($i == 0) { ?>
                                                                        <button class="btn btn-sm btn-primary TambahIUP" 
                                                                                data-id="<?= $sp['Id'] ?>"
                                                                                data-idmisi="<?= $sp['IdMisi'] ?>"
                                                                                data-visiid="<?= $sp['IdVisi'] ?? '' ?>"
                                                                                data-periode="<?= html_escape($sp['Periode'] ?? '') ?>"
                                                                                data-misi="<?= html_escape($sp['Misi']) ?>"
                                                                                data-sasaran="<?= html_escape($sp['SasaranPokok']) ?>"
                                                                                style="font-size:10px; padding:2px 6px;"
                                                                                title="Tambah IUP">
                                                                            <i class="notika-icon bi-plus-lg"></i> IUP
                                                                        </button>
                                                                    <?php } ?>
                                                                    
                                                                    <button class="btn btn-sm btn-info EditIUP" Edit="<?= $iup['Id'] ?>" title="Edit IUP">
                                                                        <i class="notika-icon notika-edit" style="font-size:12px;"></i>
                                                                    </button>
                                                                    
                                                                    <button class="btn btn-sm btn-danger HapusIUP" Hapus="<?= $iup['Id'] ?>" title="Hapus IUP">
                                                                        <i class="notika-icon notika-trash" style="font-size:12px;"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="<?= $totalCols ?>" class="text-center">
                                                <em>Belum ada data Sasaran Pokok dan IUP</em>
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

<!-- ============================================================
MODAL INPUT SASARAN POKOK
============================================================ -->
<div class="modal fade" id="ModalInputSasaranPokok" role="dialog">
    <div class="modal-dialog" style="max-width: 650px; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="position: relative; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; color: #64748b; background: transparent; border: none; z-index: 10; margin: 0; padding: 0; line-height: 1;">&times;</button>
                <h4 class="modal-title" style="margin: 0; text-align: left; font-size: 17px; font-weight: 700; color: #1e293b; padding-right: 40px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-plus-circle" style="color: #10b981;"></i> Tambah Sasaran Pokok
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; max-height: calc(100vh - 200px); overflow-y: auto;">
                <div class="form-group" style="margin-bottom: 18px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Periode <span class="text-danger">*</span></label>
                    <select class="form-control" id="InputPeriodeSasaran" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        <option value="">-- Pilih Periode --</option>
                        <?php if (!empty($PeriodeList)) {
                            foreach ($PeriodeList as $p) { ?>
                                <option value="<?= $p['Id'] ?>"><?= html_escape($p['Periode']) ?></option>
                            <?php } 
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 18px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Misi <span class="text-danger">*</span></label>
                    <select class="form-control" id="InputMisiSasaran" disabled style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Sasaran Pokok <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="3" id="InputSasaranPokok" placeholder="Masukkan Sasaran Pokok" style="border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: none; resize: vertical;"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px; font-weight: 600; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnInputSasaran" style="border-radius: 8px; padding: 8px 22px; font-weight: 600; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                    <i class="fa fa-save" style="margin-right: 5px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL INPUT SASARAN POKOK (QUICK - DI DALAM TABEL)
============================================================ -->
<div class="modal fade" id="ModalInputSasaranPokokQuick" role="dialog">
    <div class="modal-dialog" style="max-width: 650px; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="position: relative; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; color: #64748b; background: transparent; border: none; z-index: 10; margin: 0; padding: 0; line-height: 1;">&times;</button>
                <h4 class="modal-title" style="margin: 0; text-align: left; font-size: 17px; font-weight: 700; color: #1e293b; padding-right: 40px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-plus-circle" style="color: #10b981;"></i> Tambah Sasaran Pokok (Quick Add)
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; max-height: calc(100vh - 200px); overflow-y: auto;">
                <div class="alert alert-info" style="border-radius: 8px; margin-bottom: 18px; border-left: 4px solid #0284c7; background: #f0f9ff; color: #0369a1; padding: 12px 18px;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Periode:</strong> <span id="InfoPeriodeSasaranQuick" class="text-primary">-</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Misi:</strong> <span id="InfoMisiSasaranQuick" class="text-primary">-</span>
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <span class="label label-success" style="border-radius: 4px; padding: 3px 8px;">Quick Add</span> 
                        <small style="color: #64748b; margin-left: 5px;">Menambahkan sasaran pada misi ini</small>
                    </div>
                </div>
                
                <input type="hidden" id="InputSasaranIdMisiQuick" value="">
                <input type="hidden" id="InputSasaranVisiIdQuick" value="">

                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Sasaran Pokok <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="3" id="InputSasaranPokokQuick" placeholder="Masukkan Sasaran Pokok" style="border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: none; resize: vertical;"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px; font-weight: 600; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnInputSasaranQuick" style="border-radius: 8px; padding: 8px 22px; font-weight: 600; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                    <i class="fa fa-save" style="margin-right: 5px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL INPUT IUP (DIPERBAIKI)
============================================================ -->
<div class="modal fade" id="ModalInputIUP" role="dialog">
    <div class="modal-dialog" style="max-width: 700px; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="position: relative; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; color: #64748b; background: transparent; border: none; z-index: 10; margin: 0; padding: 0; line-height: 1;">&times;</button>
                <h4 class="modal-title" style="margin: 0; text-align: left; font-size: 17px; font-weight: 700; color: #1e293b; padding-right: 40px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-plus-circle" style="color: #10b981;"></i> Tambah Indikator Utama Pembangunan (IUP)
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; max-height: calc(100vh - 200px); overflow-y: auto;">
                <!-- 🔴 HIDDEN FIELD UNTUK ID SASARAN -->
                <input type="hidden" id="InputIUPIdSasaran" value="">
                <input type="hidden" id="InputIUPIdMisi" value="">
                <input type="hidden" id="InputIUPVisiId" value="">

                <!-- 🔴 TAMPILKAN INFORMASI SASARAN -->
                <div class="alert alert-info" style="border-radius: 8px; margin-bottom: 18px; border-left: 4px solid #0284c7; background: #f0f9ff; color: #0369a1; padding: 12px 18px;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Periode:</strong> <span id="InfoPeriodeIUP" class="text-primary">-</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Misi:</strong> <span id="InfoMisiIUP" class="text-primary">-</span>
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <strong>Sasaran Pokok:</strong> <span id="InfoSasaranIUP" class="text-primary">-</span>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Indikator <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="2" id="InputIndikatorIUP" placeholder="Masukkan Indikator Utama Pembangunan" style="border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: none; resize: vertical;"></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Satuan</label>
                    <input type="text" class="form-control" id="InputSatuanIUP" placeholder="Contoh: Tahun, %, Jiwa, dll" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap I <small style="color: #64748b;">(2025-2029)</small></label>
                            <input type="text" class="form-control" id="InputTarget1IUP" placeholder="Target 2025-2029" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap II <small style="color: #64748b;">(2030-2034)</small></label>
                            <input type="text" class="form-control" id="InputTarget2IUP" placeholder="Target 2030-2034" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap III <small style="color: #64748b;">(2035-2039)</small></label>
                            <input type="text" class="form-control" id="InputTarget3IUP" placeholder="Target 2035-2039" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap IV <small style="color: #64748b;">(2040-2045)</small></label>
                            <input type="text" class="form-control" id="InputTarget4IUP" placeholder="Target 2040-2045" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px; font-weight: 600; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">Batal</button>
                <button type="button" class="btn btn-success" id="BtnInputIUP" style="border-radius: 8px; padding: 8px 22px; font-weight: 600; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                    <i class="fa fa-save" style="margin-right: 5px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT PERIODE DAN MISI
============================================================ -->
<div class="modal fade" id="ModalEditPeriodeMisi" role="dialog">
    <div class="modal-dialog" style="max-width: 650px; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="position: relative; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; color: #64748b; background: transparent; border: none; z-index: 10; margin: 0; padding: 0; line-height: 1;">&times;</button>
                <h4 class="modal-title" style="margin: 0; text-align: left; font-size: 17px; font-weight: 700; color: #1e293b; padding-right: 40px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-pencil-square-o" style="color: #3b82f6;"></i> Edit Periode dan Misi
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; max-height: calc(100vh - 200px); overflow-y: auto;">
                <input type="hidden" id="EditIdMisi" value="">
                <input type="hidden" id="EditVisiIdLama" value="">
                
                <div class="alert alert-info" style="border-radius: 8px; margin-bottom: 18px; border-left: 4px solid #0284c7; background: #f0f9ff; color: #0369a1; padding: 12px 18px;">
                    <strong>Misi yang akan diedit:</strong><br>
                    <span id="EditMisiLamaInfo" class="text-primary" style="font-weight: 600;">-</span>
                </div>
                
                <div class="form-group" style="margin-bottom: 18px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Periode Baru <span class="text-danger">*</span></label>
                    <select class="form-control" id="EditPeriodeSelect" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        <option value="">-- Pilih Periode --</option>
                        <?php if (!empty($PeriodeList)) {
                            foreach ($PeriodeList as $p) { ?>
                                <option value="<?= $p['Id'] ?>"><?= html_escape($p['Periode']) ?></option>
                            <?php } 
                        } ?>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom: 18px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Misi Baru <span class="text-danger">*</span></label>
                    <select class="form-control" id="EditMisiSelect" disabled style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                    </select>
                </div>
                
                <div class="alert alert-warning" style="border-radius: 8px; margin-bottom: 0; border-left: 4px solid #f59e0b; background: #fffbeb; color: #b45309; padding: 12px 18px;">
                    <i class="fa fa-exclamation-triangle" style="margin-right: 6px;"></i>
                    <strong>Perhatian:</strong> Mengubah misi akan memindahkan semua sasaran pokok dari misi lama ke misi baru.
                </div>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px; font-weight: 600; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnEditPeriodeMisi" style="border-radius: 8px; padding: 8px 22px; font-weight: 600; box-shadow: 0 2px 6px rgba(59,130,246,0.3);">
                    <i class="fa fa-save" style="margin-right: 5px;"></i> Update
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL KONFIRMASI HAPUS PERIODE DAN MISI
============================================================ -->
<div class="modal fade" id="ModalHapusPeriodeMisi" role="dialog">
    <div class="modal-dialog" style="max-width: 550px; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="position: relative; padding: 18px 24px; border-bottom: 1px solid #fee2e2; background: #fef2f2; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; color: #ef4444; background: transparent; border: none; z-index: 10; margin: 0; padding: 0; line-height: 1;">&times;</button>
                <h4 class="modal-title" style="margin: 0; text-align: left; font-size: 17px; font-weight: 700; color: #dc2626; padding-right: 40px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-trash-o" style="color: #dc2626;"></i> Konfirmasi Hapus Misi
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; max-height: calc(100vh - 200px); overflow-y: auto;">
                <input type="hidden" id="HapusIdMisi" value="">
                
                <div class="alert alert-danger" style="border-radius: 8px; margin-bottom: 18px; border-left: 4px solid #ef4444; background: #fef2f2; color: #b91c1c; padding: 12px 18px;">
                    <strong>PERINGATAN!</strong> Menghapus misi akan menghapus:
                    <ul style="margin-top: 8px; margin-bottom: 0; padding-left: 20px;">
                        <li>Misi ini</li>
                        <li>Semua Sasaran Pokok yang terkait</li>
                        <li>Semua IUP yang terkait dengan sasaran pokok</li>
                    </ul>
                </div>
                
                <div id="HapusInfoData" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 18px; margin-bottom: 15px;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong style="color: #475569;">Periode:</strong> <span id="HapusInfoPeriode" class="text-primary" style="font-weight: 600;">-</span>
                        </div>
                        <div class="col-md-6">
                            <strong style="color: #475569;">Misi:</strong> <span id="HapusInfoMisi" class="text-primary" style="font-weight: 600;">-</span>
                        </div>
                    </div>
                </div>
                
                <p class="text-center" style="margin: 10px 0 0; color: #dc2626; font-weight: 600; font-size: 13px;">
                    <i class="fa fa-info-circle"></i> Data yang dihapus tidak dapat dikembalikan!
                </p>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px; font-weight: 600; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">Batal</button>
                <button type="button" class="btn btn-danger" id="BtnHapusPeriodeMisi" style="border-radius: 8px; padding: 8px 22px; font-weight: 600; box-shadow: 0 2px 6px rgba(239,68,68,0.3);">
                    <i class="fa fa-trash" style="margin-right: 5px;"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT SASARAN POKOK
============================================================ -->
<div class="modal fade" id="ModalEditSasaranPokok" role="dialog">
    <div class="modal-dialog" style="max-width: 650px; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="position: relative; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; color: #64748b; background: transparent; border: none; z-index: 10; margin: 0; padding: 0; line-height: 1;">&times;</button>
                <h4 class="modal-title" style="margin: 0; text-align: left; font-size: 17px; font-weight: 700; color: #1e293b; padding-right: 40px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-pencil-square-o" style="color: #3b82f6;"></i> Edit Sasaran Pokok
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; max-height: calc(100vh - 200px); overflow-y: auto;">
                <input type="hidden" id="EditSasaranId">
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Sasaran Pokok <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="3" id="EditSasaranPokok" placeholder="Masukkan Sasaran Pokok" style="border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: none; resize: vertical;"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px; font-weight: 600; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnEditSasaran" style="border-radius: 8px; padding: 8px 22px; font-weight: 600; box-shadow: 0 2px 6px rgba(59,130,246,0.3);">
                    <i class="fa fa-save" style="margin-right: 5px;"></i> Update
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT IUP
============================================================ -->
<div class="modal fade" id="ModalEditIUP" role="dialog">
    <div class="modal-dialog" style="max-width: 700px; margin: 30px auto;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="position: relative; padding: 18px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; color: #64748b; background: transparent; border: none; z-index: 10; margin: 0; padding: 0; line-height: 1;">&times;</button>
                <h4 class="modal-title" style="margin: 0; text-align: left; font-size: 17px; font-weight: 700; color: #1e293b; padding-right: 40px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-pencil-square-o" style="color: #3b82f6;"></i> Edit Indikator Utama Pembangunan (IUP)
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; max-height: calc(100vh - 200px); overflow-y: auto;">
                <input type="hidden" id="EditIUPId">
                <input type="hidden" id="EditIUPIdSasaran">
                
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Indikator <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="2" id="EditIndikatorIUP" placeholder="Masukkan Indikator Utama Pembangunan" style="border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: none; resize: vertical;"></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Satuan</label>
                    <input type="text" class="form-control" id="EditSatuanIUP" placeholder="Contoh: Tahun, %, Jiwa, dll" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap I <small style="color: #64748b;">(2025-2029)</small></label>
                            <input type="text" class="form-control" id="EditTarget1IUP" placeholder="Target 2025-2029" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap II <small style="color: #64748b;">(2030-2034)</small></label>
                            <input type="text" class="form-control" id="EditTarget2IUP" placeholder="Target 2030-2034" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap III <small style="color: #64748b;">(2035-2039)</small></label>
                            <input type="text" class="form-control" id="EditTarget3IUP" placeholder="Target 2035-2039" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-weight: 600; color: #334155; margin-bottom: 6px; display: block; font-size: 13px;">Target Tahap IV <small style="color: #64748b;">(2040-2045)</small></label>
                            <input type="text" class="form-control" id="EditTarget4IUP" placeholder="Target 2040-2045" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 40px; box-shadow: none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 14px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px; font-weight: 600; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">Batal</button>
                <button type="button" class="btn btn-primary" id="BtnEditIUP" style="border-radius: 8px; padding: 8px 22px; font-weight: 600; box-shadow: 0 2px 6px rgba(59,130,246,0.3);">
                    <i class="fa fa-save" style="margin-right: 5px;"></i> Update
                </button>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    /* ==============================================
       MODAL STYLING & CORNER ALIGNMENT
       ============================================== */
    .modal {
        text-align: center;
        padding: 0 !important;
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
        width: 100%;
        max-width: 650px;
    }
    .modal-lg {
        max-width: 900px !important;
    }

    .modal-header {
        position: relative !important;
        padding: 16px 24px !important;
        border-bottom: 1px solid #e2e8f0 !important;
        background: #f8fafc !important;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
    }

    .modal-header:before,
    .modal-header:after {
        display: none !important;
    }

    .modal-header .close {
        position: absolute !important;
        right: 20px !important;
        top: 16px !important;
        margin: 0 !important;
        font-size: 24px !important;
        font-weight: 400 !important;
        line-height: 1 !important;
        color: #64748b !important;
        text-shadow: none !important;
        opacity: 0.6 !important;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        z-index: 10 !important;
        cursor: pointer !important;
        width: 32px !important;
        height: 32px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        transition: all 0.2s ease !important;
    }

    .modal-header .close:hover {
        opacity: 1 !important;
        color: #0f172a !important;
        background: rgba(0,0,0,0.05) !important;
        transform: rotate(90deg) !important;
    }

    .modal-header .close:focus {
        outline: none !important;
        opacity: 0.8 !important;
    }

    .modal-header h4.modal-title {
        font-size: 17px !important;
        margin: 0 !important;
        padding-right: 40px !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        text-align: left !important;
    }

    .modal-body {
        padding: 24px !important;
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }

    .modal-footer {
        padding: 14px 24px !important;
        border-top: 1px solid #e2e8f0 !important;
        background: #f8fafc !important;
        border-bottom-left-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    /* Table Header Styling */
    .table thead th {
        background-color: #f1f5f9 !important;
        color: #334155 !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        border-bottom: 2px solid #cbd5e1 !important;
        border-top: 1px solid #cbd5e1 !important;
        vertical-align: middle !important;
    }
    .table-bordered th, .table-bordered td {
        border-color: #e2e8f0 !important;
    }
    .table th {
        text-align: center;
        vertical-align: middle;
    }
    .table td {
        vertical-align: middle;
    }
    .text-danger {
        color: #ff0000;
    }
    /* ==============================================
       UNIFIED BUTTON STYLING
       ============================================== */
    .btn {
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
        font-weight: 600 !important;
    }
    .btn-sm, .btn-xs {
        border-radius: 6px !important;
        font-weight: 600 !important;
    }
    .btn.Edit, .btn.EditSasaran, .btn.EditPeriodeMisi, .btn-amber {
        background-color: #f59e0b !important;
        border-color: #f59e0b !important;
        color: #ffffff !important;
        border-radius: 6px !important;
        padding: 5px 9px !important;
        font-size: 12px !important;
        line-height: 1.4 !important;
        box-shadow: 0 1px 3px rgba(245, 158, 11, 0.25) !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .btn.Edit:hover, .btn.EditSasaran:hover, .btn.EditPeriodeMisi:hover, .btn-amber:hover {
        background-color: #d97706 !important;
        border-color: #d97706 !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 3px 6px rgba(245, 158, 11, 0.35) !important;
    }
    .btn.Hapus, .btn.HapusSasaran, .btn.HapusPeriodeMisi, .btn-danger {
        background-color: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #ffffff !important;
        border-radius: 6px !important;
        padding: 5px 9px !important;
        font-size: 12px !important;
        line-height: 1.4 !important;
        box-shadow: 0 1px 3px rgba(239, 68, 68, 0.25) !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .btn.Hapus:hover, .btn.HapusSasaran:hover, .btn.HapusPeriodeMisi:hover, .btn-danger:hover {
        background-color: #dc2626 !important;
        border-color: #dc2626 !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 3px 6px rgba(239, 68, 68, 0.35) !important;
    }
    .TambahSasaranRow, .TambahIUP {
        border-radius: 6px !important;
        font-weight: 600 !important;
        padding: 4px 8px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12) !important;
    }
    .button-icon-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 5px !important;
        margin: 0 !important;
    }
    .button-icon-btn .btn-reco-mg,
    .button-icon-btn .btn-button-mg {
        margin: 0 !important;
    }
    .alert-info {
        background-color: #d9edf7;
        border-color: #bce8f1;
        color: #31708f;
        padding: 10px 15px;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    .alert-info strong {
        color: #005c99;
    }
    .alert-info .text-primary {
        color: #005c99;
        font-weight: bold;
    }
    .alert-danger {
        background-color: #f2dede;
        border-color: #ebcccc;
        color: #a94442;
    }
    .label {
        display: inline-block;
        padding: 3px 8px;
        font-size: 11px;
        font-weight: bold;
        border-radius: 3px;
    }
    .label-success {
        background-color: #5cb85c;
        color: #fff;
    }
    .basic-tb-hd {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }
    .basic-tb-hd h2 {
        margin: 0;
    }
    .button-icon-btn {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .table .btn-sm {
        padding: 2px 6px;
        font-size: 11px;
        line-height: 1.4;
    }
    .table .btn-sm i {
        font-size: 11px;
    }
</style>

<!-- ============================================================
JAVASCRIPT (DIPERBAIKI)
============================================================ -->
<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/data-table-act.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

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
            alert("Mohon Pilih Provinsi");
            return;
        }
        if ($("#KabKota").val() === "") {
            alert("Mohon Pilih Kab/Kota");
            return;
        }
        
        var kodeWilayah = $("#KabKota").val();
        $("#Filter").prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Memuat...');
        
        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { 
                KodeWilayah: kodeWilayah, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            success: function(Respon) {
                if (Respon.trim() === '1' || Respon.trim() === 'success') {
                    window.location.href = BaseURL + "Daerah/SasaranPokok";
                } else {
                    alert(Respon || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                }
            },
            error: function() {
                alert("Gagal menghubungi server!");
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

    // ============================================================
    // LOAD MISI UNTUK SASARAN POKOK
    // ============================================================
    $("#InputPeriodeSasaran").change(function() {
        var periodeId = $(this).val();
        var $misiSelect = $("#InputMisiSasaran");
        
        if (periodeId == "") {
            $misiSelect.html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
            $misiSelect.prop('disabled', true);
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetMisiByPeriodeSasaranPokok",
            type: "POST",
            data: { Id: periodeId, [CSRF_NAME]: CSRF_TOKEN },
            beforeSend: function() { 
                $misiSelect.prop('disabled', true);
                $misiSelect.html('<option value="">Memuat data...</option>');
            },
            success: function(Respon) {
                var Data = JSON.parse(Respon);
                var Misi = '<option value="">-- Pilih Misi --</option>';
                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        Misi += '<option value="' + Data[i].Id + '">' + Data[i].Misi + '</option>';
                    }
                } else {
                    Misi = '<option value="">Tidak ada misi untuk periode ini</option>';
                }
                $misiSelect.html(Misi).prop('disabled', false);
            },
            error: function() {
                alert("Gagal memuat data Misi");
                $misiSelect.prop('disabled', false);
            }
        });
    });

    // ============================================================
    // INPUT SASARAN POKOK
    // ============================================================
    $("#BtnInputSasaran").click(function() {
        var idMisi = $("#InputMisiSasaran").val();
        var sasaranPokok = $("#InputSasaranPokok").val().trim();

        if (idMisi == "") {
            alert("⚠️ Periode dan Misi wajib dipilih!");
            return;
        }

        if (sasaranPokok == "") {
            alert("⚠️ Sasaran Pokok harus diisi!");
            return;
        }

        var data = {
            IdMisi: idMisi,
            SasaranPokok: sasaranPokok,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $("#BtnInputSasaran").prop('disabled', true).text('Menyimpan...');
        
        $.post(BaseURL + "Daerah/InputSasaranPokok", data)
            .done(function(Respon) {
                try {
                    var result = JSON.parse(Respon);
                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(result.message || 'Terjadi kesalahan');
                        $("#BtnInputSasaran").prop('disabled', false).text('SIMPAN');
                    }
                } catch(e) {
                    alert("Terjadi kesalahan pada server!");
                    $("#BtnInputSasaran").prop('disabled', false).text('SIMPAN');
                }
            })
            .fail(function() {
                alert("Terjadi kesalahan pada server!");
                $("#BtnInputSasaran").prop('disabled', false).text('SIMPAN');
            });
    });

    // ============================================================
    // TOMBOL TAMBAH SASARAN QUICK
    // ============================================================
    $(document).on("click", ".TambahSasaranRow", function() {
        var idMisi = $(this).data('idmisi');
        var periode = $(this).data('periode');
        var misi = $(this).data('misi');
        var visiId = $(this).data('visiid');
        
        $("#InputSasaranPokokQuick").val('');
        $("#InputSasaranIdMisiQuick").val(idMisi);
        $("#InputSasaranVisiIdQuick").val(visiId || '');
        
        $("#InfoPeriodeSasaranQuick").text(periode || '-');
        $("#InfoMisiSasaranQuick").text(misi || '-');
        
        $('#ModalInputSasaranPokokQuick').modal('show');
    });

    // ============================================================
    // INPUT SASARAN POKOK - QUICK
    // ============================================================
    $("#BtnInputSasaranQuick").click(function() {
        var idMisi = $("#InputSasaranIdMisiQuick").val();
        var sasaranPokok = $("#InputSasaranPokokQuick").val().trim();

        if (idMisi == "" || idMisi == "0" || idMisi == null) {
            alert("⚠️ Misi tidak valid!");
            return;
        }

        if (sasaranPokok == "") {
            alert("⚠️ Sasaran Pokok harus diisi!");
            return;
        }

        var data = {
            IdMisi: idMisi,
            SasaranPokok: sasaranPokok,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $("#BtnInputSasaranQuick").prop('disabled', true).text('Menyimpan...');
        
        $.post(BaseURL + "Daerah/InputSasaranPokok", data)
            .done(function(Respon) {
                try {
                    var result = JSON.parse(Respon);
                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(result.message || 'Terjadi kesalahan');
                        $("#BtnInputSasaranQuick").prop('disabled', false).text('SIMPAN');
                    }
                } catch(e) {
                    alert("Terjadi kesalahan pada server!");
                    $("#BtnInputSasaranQuick").prop('disabled', false).text('SIMPAN');
                }
            })
            .fail(function() {
                alert("Terjadi kesalahan pada server!");
                $("#BtnInputSasaranQuick").prop('disabled', false).text('SIMPAN');
            });
    });

    // ============================================================
    // TOMBOL TAMBAH IUP (DIPERBAIKI)
    // ============================================================
    $(document).on("click", ".TambahIUP", function() {
        var idSasaran = $(this).data('id');
        var idMisi = $(this).data('idmisi');
        var visiId = $(this).data('visiid');
        var periode = $(this).data('periode');
        var misi = $(this).data('misi');
        var sasaran = $(this).data('sasaran');
        
        // 🔴 DEBUG: Cek apakah ID Sasaran terbaca
        console.log('ID Sasaran:', idSasaran);
        console.log('ID Misi:', idMisi);
        console.log('Sasaran:', sasaran);
        
        if (!idSasaran || idSasaran == "" || idSasaran == "0" || idSasaran == null) {
            alert("⚠️ ID Sasaran tidak valid! Silahkan refresh halaman.");
            return;
        }
        
        // Reset form
        $("#InputIndikatorIUP").val('');
        $("#InputSatuanIUP").val('');
        $("#InputTarget1IUP").val('');
        $("#InputTarget2IUP").val('');
        $("#InputTarget3IUP").val('');
        $("#InputTarget4IUP").val('');
        
        // 🔴 SET HIDDEN FIELD DENGAN ID SASARAN
        $("#InputIUPIdSasaran").val(idSasaran);
        $("#InputIUPIdMisi").val(idMisi);
        $("#InputIUPVisiId").val(visiId || '');
        
        // 🔴 TAMPILKAN INFORMASI DI MODAL
        $("#InfoPeriodeIUP").text(periode || '-');
        $("#InfoMisiIUP").text(misi || '-');
        $("#InfoSasaranIUP").text(sasaran || '-');
        
        $('#ModalInputIUP').modal('show');
    });

    // ============================================================
    // INPUT IUP (DIPERBAIKI)
    // ============================================================
    $("#BtnInputIUP").click(function() {
        // 🔴 AMBIL ID SASARAN DARI HIDDEN FIELD
        var idSasaranPokok = $("#InputIUPIdSasaran").val();
        var indikator = $("#InputIndikatorIUP").val().trim();
        var satuan = $("#InputSatuanIUP").val().trim();
        var target1 = $("#InputTarget1IUP").val().trim();
        var target2 = $("#InputTarget2IUP").val().trim();
        var target3 = $("#InputTarget3IUP").val().trim();
        var target4 = $("#InputTarget4IUP").val().trim();

        // 🔴 DEBUG
        console.log('ID Sasaran yang dikirim:', idSasaranPokok);
        console.log('Indikator:', indikator);

        if (idSasaranPokok == "" || idSasaranPokok == "0" || idSasaranPokok == null) {
            alert("⚠️ ID Sasaran tidak valid! Silahkan refresh halaman.");
            return;
        }

        if (indikator == "") {
            alert("⚠️ Indikator harus diisi!");
            return;
        }

        // 🔴 PASTIKAN KEY SESUAI DENGAN CONTROLLER
        var data = {
            IdSasaranPokok: idSasaranPokok,
            Indikator: indikator,
            Satuan: satuan,
            Target1: target1,
            Target2: target2,
            Target3: target3,
            Target4: target4,
            [CSRF_NAME]: CSRF_TOKEN
        };

        console.log('Data yang dikirim ke server:', data);

        $("#BtnInputIUP").prop('disabled', true).text('Menyimpan...');
        
        $.post(BaseURL + "Daerah/InputIUP", data)
            .done(function(Respon) {
                console.log('Response server:', Respon);
                try {
                    var result = JSON.parse(Respon);
                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(result.message || 'Terjadi kesalahan');
                        $("#BtnInputIUP").prop('disabled', false).text('SIMPAN');
                    }
                } catch(e) {
                    alert("Terjadi kesalahan pada server: " + Respon);
                    $("#BtnInputIUP").prop('disabled', false).text('SIMPAN');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                alert("Terjadi kesalahan pada server!");
                $("#BtnInputIUP").prop('disabled', false).text('SIMPAN');
            });
    });

    // ============================================================
    // EDIT PERIODE DAN MISI
    // ============================================================
    $(document).on("click", ".EditPeriodeMisi", function() {
        var idMisi = $(this).data('idmisi');
        
        console.log('EditPeriodeMisi clicked, ID:', idMisi);
        
        $("#EditIdMisi").val('');
        $("#EditVisiIdLama").val('');
        $("#EditPeriodeSelect").val('');
        $("#EditMisiSelect").html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
        $("#EditMisiSelect").prop('disabled', true);
        $("#EditMisiLamaInfo").text('Memuat...');
        
        $.ajax({
            url: BaseURL + "Daerah/GetDataPeriodeMisiEdit",
            type: "POST",
            data: { 
                IdMisi: idMisi, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            beforeSend: function() {
                $('#ModalEditPeriodeMisi').modal('show');
                $("#BtnEditPeriodeMisi").prop('disabled', true).text('Memuat...');
            },
            success: function(response) {
                console.log('Response GetDataPeriodeMisiEdit:', response);
                
                if (response.status === 'success') {
                    var data = response.data;
                    
                    $("#EditIdMisi").val(data.MisiId);
                    $("#EditVisiIdLama").val(data.VisiId);
                    $("#EditMisiLamaInfo").text(data.Misi || 'Misi tidak ditemukan');
                    $("#EditPeriodeSelect").val(data.VisiId);
                    
                    loadMisiForEdit(data.VisiId, data.MisiId);
                    
                    $("#BtnEditPeriodeMisi").prop('disabled', false).text('UPDATE');
                } else {
                    alert('Error: ' + (response.message || 'Gagal mengambil data'));
                    $('#ModalEditPeriodeMisi').modal('hide');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    errorThrown: errorThrown
                });
                alert('Gagal mengambil data: ' + textStatus);
                $('#ModalEditPeriodeMisi').modal('hide');
            }
        });
    });

    function loadMisiForEdit(periodeId, selectedMisiId) {
        var $misiSelect = $("#EditMisiSelect");
        
        console.log('loadMisiForEdit - periodeId:', periodeId, 'selectedMisiId:', selectedMisiId);
        
        if (periodeId == "" || periodeId == null || periodeId == "0") {
            $misiSelect.html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
            $misiSelect.prop('disabled', true);
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetMisiByPeriodeSasaranPokok",
            type: "POST",
            data: { 
                Id: periodeId, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            beforeSend: function() { 
                $misiSelect.prop('disabled', true);
                $misiSelect.html('<option value="">Memuat data...</option>');
            },
            success: function(response) {
                console.log('GetMisiByPeriodeSasaranPokok response:', response);
                
                var Data = response;
                if (!Array.isArray(Data)) {
                    if (Data.data && Array.isArray(Data.data)) {
                        Data = Data.data;
                    } else {
                        Data = [];
                    }
                }
                
                var Misi = '<option value="">-- Pilih Misi --</option>';
                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (Data[i].Id == selectedMisiId) ? 'selected' : '';
                        Misi += '<option value="' + Data[i].Id + '" ' + selected + '>' + Data[i].Misi + '</option>';
                    }
                } else {
                    Misi = '<option value="">Tidak ada misi untuk periode ini</option>';
                }
                $misiSelect.html(Misi).prop('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error loadMisiForEdit:', textStatus, errorThrown);
                $misiSelect.html('<option value="">Gagal memuat data</option>').prop('disabled', false);
            }
        });
    }

    $(document).on("change", "#EditPeriodeSelect", function() {
        var periodeId = $(this).val();
        console.log('Periode changed:', periodeId);
        loadMisiForEdit(periodeId, '');
    });

    $("#BtnEditPeriodeMisi").click(function() {
        var idMisiLama = $("#EditIdMisi").val();
        var visiIdBaru = $("#EditPeriodeSelect").val();
        var idMisiBaru = $("#EditMisiSelect").val();
        
        console.log('Submit Edit:', {
            idMisiLama: idMisiLama,
            visiIdBaru: visiIdBaru,
            idMisiBaru: idMisiBaru
        });
        
        if (!idMisiLama || idMisiLama == "") {
            alert("⚠️ Data misi tidak valid!");
            return;
        }
        
        if (!visiIdBaru || visiIdBaru == "") {
            alert("⚠️ Periode harus dipilih!");
            return;
        }
        
        if (!idMisiBaru || idMisiBaru == "") {
            alert("⚠️ Misi harus dipilih!");
            return;
        }
        
        var misiLamaText = $("#EditMisiLamaInfo").text();
        var misiBaruText = $("#EditMisiSelect option:selected").text();
        
        if (!confirm("Anda akan mengubah misi dari:\n\n" + 
                     "MISI LAMA: " + misiLamaText + "\n\n" +
                     "Menjadi:\n" +
                     "MISI BARU: " + misiBaruText + "\n\n" +
                     "⚠️ Semua Sasaran Pokok yang terkait dengan misi lama akan dipindahkan ke misi baru.\n\n" +
                     "Lanjutkan?")) {
            return;
        }
        
        var data = {
            IdMisi: idMisiLama,
            VisiId: visiIdBaru,
            MisiId: idMisiBaru,
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        console.log('Data yang dikirim ke EditPeriodeMisi:', data);
        
        $("#BtnEditPeriodeMisi").prop('disabled', true).text('Menyimpan...');
        
        $.ajax({
            url: BaseURL + "Daerah/EditPeriodeMisi",
            type: "POST",
            data: data,
            dataType: "json",
            timeout: 30000,
            success: function(response) {
                console.log('Response EditPeriodeMisi:', response);
                
                if (response.status === 'success') {
                    alert("✅ " + response.message);
                    window.location.reload();
                } else {
                    alert("Error: " + (response.message || 'Terjadi kesalahan'));
                    $("#BtnEditPeriodeMisi").prop('disabled', false).text('UPDATE');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error EditPeriodeMisi:', {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    errorThrown: errorThrown
                });
                alert('Terjadi kesalahan: ' + textStatus);
                $("#BtnEditPeriodeMisi").prop('disabled', false).text('UPDATE');
            }
        });
    });

    // ============================================================
    // HAPUS PERIODE DAN MISI
    // ============================================================
    $(document).on("click", ".HapusPeriodeMisi", function() {
        var idMisi = $(this).data('idmisi');
        var periode = $(this).data('periode') || '-';
        var misi = $(this).data('misi') || '-';
        
        $("#HapusIdMisi").val(idMisi);
        $("#HapusInfoPeriode").text(periode);
        $("#HapusInfoMisi").text(misi);
        
        $('#ModalHapusPeriodeMisi').modal('show');
    });

    $("#BtnHapusPeriodeMisi").click(function() {
        var idMisi = $("#HapusIdMisi").val();
        
        if (!idMisi) {
            alert("⚠️ Data tidak valid!");
            return;
        }
        
        var data = {
            IdMisi: idMisi,
            [CSRF_NAME]: CSRF_TOKEN
        };
        
        $("#BtnHapusPeriodeMisi").prop('disabled', true).text('Menghapus...');
        
        $.post(BaseURL + "Daerah/HapusPeriodeMisi", data)
            .done(function(Respon) {
                try {
                    var result = JSON.parse(Respon);
                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(result.message || 'Terjadi kesalahan');
                        $("#BtnHapusPeriodeMisi").prop('disabled', false).text('YA, HAPUS');
                    }
                } catch(e) {
                    alert("Terjadi kesalahan pada server!");
                    $("#BtnHapusPeriodeMisi").prop('disabled', false).text('YA, HAPUS');
                }
            })
            .fail(function() {
                alert("Terjadi kesalahan pada server!");
                $("#BtnHapusPeriodeMisi").prop('disabled', false).text('YA, HAPUS');
            });
    });

    // ============================================================
    // EDIT SASARAN POKOK
    // ============================================================
    $(document).on("click", ".EditSasaran", function() {
        var id = $(this).attr('Edit');
        
        $.ajax({
            url: BaseURL + "Daerah/GetSasaranPokokById",
            type: "POST",
            data: { Id: id, [CSRF_NAME]: CSRF_TOKEN },
            success: function(Respon) {
                try {
                    var Data = JSON.parse(Respon);
                    if (Data && Data.Id) {
                        $("#EditSasaranId").val(Data.Id);
                        $("#EditSasaranPokok").val(Data.SasaranPokok);
                        $('#ModalEditSasaranPokok').modal('show');
                    } else {
                        alert("Data tidak ditemukan!");
                    }
                } catch(e) {
                    alert("Gagal memproses data!");
                }
            },
            error: function() {
                alert("Gagal mengambil data!");
            }
        });
    });

    $("#BtnEditSasaran").click(function() {
        var id = $("#EditSasaranId").val();
        var sasaranPokok = $("#EditSasaranPokok").val().trim();

        if (!id) {
            alert("ID tidak valid!");
            return;
        }

        if (sasaranPokok == "") {
            alert("⚠️ Sasaran Pokok harus diisi!");
            return;
        }

        var data = {
            Id: id,
            SasaranPokok: sasaranPokok,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $("#BtnEditSasaran").prop('disabled', true).text('Menyimpan...');
        
        $.post(BaseURL + "Daerah/EditSasaranPokok", data)
            .done(function(Respon) {
                try {
                    var result = JSON.parse(Respon);
                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(result.message || 'Terjadi kesalahan');
                        $("#BtnEditSasaran").prop('disabled', false).text('UPDATE');
                    }
                } catch(e) {
                    alert("Terjadi kesalahan pada server!");
                    $("#BtnEditSasaran").prop('disabled', false).text('UPDATE');
                }
            })
            .fail(function() {
                alert("Terjadi kesalahan pada server!");
                $("#BtnEditSasaran").prop('disabled', false).text('UPDATE');
            });
    });

    // ============================================================
    // EDIT IUP
    // ============================================================
    $(document).on("click", ".EditIUP", function() {
        var id = $(this).attr('Edit');
        
        $.ajax({
            url: BaseURL + "Daerah/GetIUPById",
            type: "POST",
            data: { Id: id, [CSRF_NAME]: CSRF_TOKEN },
            success: function(Respon) {
                try {
                    var Data = JSON.parse(Respon);
                    if (Data && Data.Id) {
                        $("#EditIUPId").val(Data.Id);
                        $("#EditIUPIdSasaran").val(Data.IdSasaranPokok);
                        $("#EditIndikatorIUP").val(Data.Indikator);
                        $("#EditSatuanIUP").val(Data.Satuan || '');
                        $("#EditTarget1IUP").val(Data.Target_Tahap_I || '');
                        $("#EditTarget2IUP").val(Data.Target_Tahap_II || '');
                        $("#EditTarget3IUP").val(Data.Target_Tahap_III || '');
                        $("#EditTarget4IUP").val(Data.Target_Tahap_IV || '');
                        
                        $('#ModalEditIUP').modal('show');
                    } else {
                        alert("Data tidak ditemukan!");
                    }
                } catch(e) {
                    alert("Gagal memproses data!");
                }
            },
            error: function() {
                alert("Gagal mengambil data!");
            }
        });
    });

    $("#BtnEditIUP").click(function() {
        var id = $("#EditIUPId").val();
        var indikator = $("#EditIndikatorIUP").val().trim();
        var satuan = $("#EditSatuanIUP").val().trim();
        var target1 = $("#EditTarget1IUP").val().trim();
        var target2 = $("#EditTarget2IUP").val().trim();
        var target3 = $("#EditTarget3IUP").val().trim();
        var target4 = $("#EditTarget4IUP").val().trim();

        if (!id) {
            alert("ID tidak valid!");
            return;
        }

        if (indikator == "") {
            alert("⚠️ Indikator harus diisi!");
            return;
        }

        var data = {
            Id: id,
            Indikator: indikator,
            Satuan: satuan,
            Target1: target1,
            Target2: target2,
            Target3: target3,
            Target4: target4,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $("#BtnEditIUP").prop('disabled', true).text('Menyimpan...');
        
        $.post(BaseURL + "Daerah/EditIUP", data)
            .done(function(Respon) {
                try {
                    var result = JSON.parse(Respon);
                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(result.message || 'Terjadi kesalahan');
                        $("#BtnEditIUP").prop('disabled', false).text('UPDATE');
                    }
                } catch(e) {
                    alert("Terjadi kesalahan pada server!");
                    $("#BtnEditIUP").prop('disabled', false).text('UPDATE');
                }
            })
            .fail(function() {
                alert("Terjadi kesalahan pada server!");
                $("#BtnEditIUP").prop('disabled', false).text('UPDATE');
            });
    });

    // ============================================================
    // HAPUS SASARAN POKOK
    // ============================================================
    $(document).on("click", ".HapusSasaran", function() {
        var id = $(this).attr('Hapus');
        
        if (!confirm("⚠️ Menghapus Sasaran Pokok akan menghapus semua IUP yang terkait.\n\nLanjutkan?")) {
            return;
        }
        
        $.post(BaseURL + "Daerah/HapusSasaranPokok", {
            Id: id,
            [CSRF_NAME]: CSRF_TOKEN
        }).done(function(Respon) {
            try {
                var result = JSON.parse(Respon);
                if (result.status === 'success') {
                    window.location.reload();
                } else {
                    alert(result.message || 'Terjadi kesalahan');
                }
            } catch(e) {
                alert("Terjadi kesalahan pada server!");
            }
        }).fail(function() {
            alert("Terjadi kesalahan pada server!");
        });
    });

    // ============================================================
    // HAPUS IUP
    // ============================================================
    $(document).on("click", ".HapusIUP", function() {
        var id = $(this).attr('Hapus');
        
        if (!confirm("Yakin ingin menghapus IUP ini?")) {
            return;
        }
        
        $.post(BaseURL + "Daerah/HapusIUP", {
            Id: id,
            [CSRF_NAME]: CSRF_TOKEN
        }).done(function(Respon) {
            try {
                var result = JSON.parse(Respon);
                if (result.status === 'success') {
                    window.location.reload();
                } else {
                    alert(result.message || 'Terjadi kesalahan');
                }
            } catch(e) {
                alert("Terjadi kesalahan pada server!");
            }
        }).fail(function() {
            alert("Terjadi kesalahan pada server!");
        });
    });

    // ============================================================
    // RESET MODAL
    // ============================================================
    $('#ModalInputSasaranPokok').on('hidden.bs.modal', function() {
        $("#InputPeriodeSasaran").val('');
        $("#InputMisiSasaran").html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
        $("#InputMisiSasaran").prop('disabled', true);
        $("#InputSasaranPokok").val('');
        $("#BtnInputSasaran").prop('disabled', false).text('SIMPAN');
    });

    $('#ModalInputSasaranPokokQuick').on('hidden.bs.modal', function() {
        $("#InputSasaranPokokQuick").val('');
        $("#InputSasaranIdMisiQuick").val('');
        $("#InputSasaranVisiIdQuick").val('');
        $("#InfoPeriodeSasaranQuick").text('-');
        $("#InfoMisiSasaranQuick").text('-');
        $("#BtnInputSasaranQuick").prop('disabled', false).text('SIMPAN');
    });

    // 🔴 RESET MODAL IUP
    $('#ModalInputIUP').on('hidden.bs.modal', function() {
        $("#InputIndikatorIUP").val('');
        $("#InputSatuanIUP").val('');
        $("#InputTarget1IUP").val('');
        $("#InputTarget2IUP").val('');
        $("#InputTarget3IUP").val('');
        $("#InputTarget4IUP").val('');
        $("#InputIUPIdSasaran").val('');
        $("#InputIUPIdMisi").val('');
        $("#InputIUPVisiId").val('');
        $("#InfoPeriodeIUP").text('-');
        $("#InfoMisiIUP").text('-');
        $("#InfoSasaranIUP").text('-');
        $("#BtnInputIUP").prop('disabled', false).text('SIMPAN');
    });

    $('#ModalEditPeriodeMisi').on('hidden.bs.modal', function() {
        $("#EditIdMisi").val('');
        $("#EditPeriodeSelect").val('');
        $("#EditMisiSelect").html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
        $("#EditMisiSelect").prop('disabled', true);
        $("#BtnEditPeriodeMisi").prop('disabled', false).text('UPDATE');
    });

    $('#ModalHapusPeriodeMisi').on('hidden.bs.modal', function() {
        $("#HapusIdMisi").val('');
        $("#HapusInfoPeriode").text('-');
        $("#HapusInfoMisi").text('-');
        $("#BtnHapusPeriodeMisi").prop('disabled', false).text('YA, HAPUS');
    });

    $('#ModalEditSasaranPokok').on('hidden.bs.modal', function() {
        $("#EditSasaranId").val('');
        $("#EditSasaranPokok").val('');
        $("#BtnEditSasaran").prop('disabled', false).text('UPDATE');
    });

    $('#ModalEditIUP').on('hidden.bs.modal', function() {
        $("#EditIUPId").val('');
        $("#EditIUPIdSasaran").val('');
        $("#EditIndikatorIUP").val('');
        $("#EditSatuanIUP").val('');
        $("#EditTarget1IUP").val('');
        $("#EditTarget2IUP").val('');
        $("#EditTarget3IUP").val('');
        $("#EditTarget4IUP").val('');
        $("#BtnEditIUP").prop('disabled', false).text('UPDATE');
    });

});
</script> 


</body>
</html>