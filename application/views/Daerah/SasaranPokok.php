<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        
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
                        <?php } ?>

                        <!-- Info Wilayah -->
                        <?php if (!empty($KodeWilayah)) { ?>
                            <?php 
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                            ?>
                            <div class="alert alert-info" style="margin-bottom: 20px;">
                                <strong>Wilayah:</strong> <?= $nama_wilayah ?>
                            </div>
                        <?php } ?>

                        <!-- Tombol Tambah -->
                        <div class="basic-tb-hd">
                            <h2><b>SASARAN POKOK DAN IUP</b></h2>
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaranPokok">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Sasaran Pokok</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Tabel -->
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
                                    
                                    // Group IUP per Sasaran Pokok
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
                                    
                                    // Group Sasaran Pokok berdasarkan Misi
                                    $sasaranByMisi = [];
                                    foreach ($SasaranPokok as $sp) {
                                        $sasaranByMisi[$sp['IdMisi']][] = $sp;
                                    }
                                    
                                    // Hitung rowspan untuk setiap Sasaran Pokok
                                    $sasaranRowspan = [];
                                    foreach ($SasaranPokok as $sp) {
                                        $jumlahIUP = isset($IUPGrouped[$sp['Id']]) ? count($IUPGrouped[$sp['Id']]) : 0;
                                        $sasaranRowspan[$sp['Id']] = $jumlahIUP > 0 ? $jumlahIUP : 1;
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
                                    
                                    // Group Misi per Periode
                                    $misiByPeriode = [];
                                    foreach ($SasaranPokok as $sp) {
                                        $periodeKey = $sp['Periode'] ?? '-';
                                        $misiByPeriode[$periodeKey][$sp['IdMisi']] = $sp;
                                    }
                                    
                                    // Hitung rowspan untuk setiap Periode
                                    $periodeRowspan = [];
                                    foreach ($misiByPeriode as $periode => $misiList) {
                                        $total = 0;
                                        foreach ($misiList as $idMisi => $sp) {
                                            $total += $misiRowspan[$idMisi];
                                        }
                                        $periodeRowspan[$periode] = $total;
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
                                            
                                            if (empty($iupList)) {
                                                ?>
                                                <tr>
                                                    <?php
                                                        $key = $sp['Periode'] . '_' . $sp['IdMisi'];
                                                    ?>
                                                    <?php if ($isNewMisi) { ?>
                                                        <td class="text-center" rowspan="<?= $rowspanMisi ?>">
                                                            <?= $NomorMisi[$key] ?>
                                                        </td>
                                                    <?php } ?>
                                                                                                            
                                                    <?php if ($isNewPeriode) { ?>
                                                        <?php 
                                                        $periodeRowspanCount = isset($periodeRowspan[$sp['Periode']]) ? $periodeRowspan[$sp['Periode']] : 1;
                                                        ?>
                                                        <td rowspan="<?= $periodeRowspanCount ?>" style="vertical-align: middle;">
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
                                                $iupCount = count($iupList);
                                                foreach ($iupList as $i => $iup) {
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        $key = $sp['Periode'] . '_' . $sp['IdMisi'];
                                                        ?>
                                                        <?php if ($i == 0 && $isNewMisi) { ?>
                                                            <td class="text-center" rowspan="<?= $rowspanMisi ?>">
                                                                <?= $NomorMisi[$key] ?>
                                                            </td>
                                                        <?php } ?>
                                                        
                                                        <?php if ($isNewPeriode && $i == 0) { ?>
                                                            <?php 
                                                            $periodeRowspanCount = isset($periodeRowspan[$sp['Periode']]) ? $periodeRowspan[$sp['Periode']] : 1;
                                                            ?>
                                                            <td rowspan="<?= $periodeRowspanCount ?>" style="vertical-align: middle;">
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
                                                        
                                                        <?php if ($i == 0) { ?>
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
                                                        <?php } ?>
                                                        
                                                        <td><?= html_escape($iup['Indikator']) ?></td>
                                                        <td><?= html_escape($iup['Satuan'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_I'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_II'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_III'] ?? '-') ?></td>
                                                        <td class="text-center"><?= html_escape($iup['Target_Tahap_IV'] ?? '-') ?></td>
                                                        
                                                        <?php if ($hasAksi) { ?>
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
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Tambah Sasaran Pokok</b></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Periode</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" id="InputPeriodeSasaran">
                                <option value="">-- Pilih Periode --</option>
                                <?php if (!empty($PeriodeList)) {
                                    foreach ($PeriodeList as $p) { ?>
                                        <option value="<?= $p['Id'] ?>"><?= html_escape($p['Periode']) ?></option>
                                    <?php } 
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Misi</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" id="InputMisiSasaran" disabled>
                                <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Sasaran Pokok</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="3" id="InputSasaranPokok" placeholder="Masukkan Sasaran Pokok"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="BtnInputSasaran"><b>SIMPAN</b></button>
                <button class="btn btn-danger" data-dismiss="modal"><b>BATAL</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL INPUT SASARAN POKOK (QUICK - DI DALAM TABEL)
============================================================ -->
<div class="modal fade" id="ModalInputSasaranPokokQuick" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Tambah Sasaran Pokok</b></h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" style="margin-bottom: 15px;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Periode:</strong> <span id="InfoPeriodeSasaranQuick" class="text-primary">-</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Misi:</strong> <span id="InfoMisiSasaranQuick" class="text-primary">-</span>
                        </div>
                    </div>
                    <div style="margin-top: 8px;">
                        <span class="label label-success">Quick Add</span> 
                        <small>Menambahkan sasaran pada misi ini</small>
                    </div>
                </div>
                
                <input type="hidden" id="InputSasaranIdMisiQuick" value="">
                <input type="hidden" id="InputSasaranVisiIdQuick" value="">

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Sasaran Pokok</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="3" id="InputSasaranPokokQuick" placeholder="Masukkan Sasaran Pokok"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="BtnInputSasaranQuick"><b>SIMPAN</b></button>
                <button class="btn btn-danger" data-dismiss="modal"><b>BATAL</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL INPUT IUP
============================================================ -->
<div class="modal fade" id="ModalInputIUP" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Tambah Indikator Utama Pembangunan (IUP)</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="InputIUPIdSasaran" value="">
                <input type="hidden" id="InputIUPIdMisi" value="">
                <input type="hidden" id="InputIUPVisiId" value="">

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Indikator</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="2" id="InputIndikatorIUP" placeholder="Masukkan Indikator Utama Pembangunan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Satuan</b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="InputSatuanIUP" placeholder="Contoh: Tahun, %, Jiwa, dll">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap I<br><small>2025-2029</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="InputTarget1IUP" placeholder="Target 2025-2029">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap II<br><small>2030-2034</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="InputTarget2IUP" placeholder="Target 2030-2034">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap III<br><small>2035-2039</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="InputTarget3IUP" placeholder="Target 2035-2039">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap IV<br><small>2040-2045</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="InputTarget4IUP" placeholder="Target 2040-2045">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="BtnInputIUP"><b>SIMPAN</b></button>
                <button class="btn btn-danger" data-dismiss="modal"><b>BATAL</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT PERIODE DAN MISI (SAMA DENGAN FORM INPUT)
============================================================ -->
<!-- Modal Edit Periode dan Misi -->
<div class="modal fade" id="ModalEditPeriodeMisi" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Edit Periode dan Misi</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditIdMisi" value="">
                <input type="hidden" id="EditVisiIdLama" value="">
                
                <!-- Informasi Misi Lama -->
                <div class="alert alert-info" style="margin-bottom: 15px;">
                    <strong>Misi yang akan diedit:</strong><br>
                    <span id="EditMisiLamaInfo" class="text-primary">-</span>
                </div>
                
                <!-- Periode (Dropdown) -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Periode Baru</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" id="EditPeriodeSelect">
                                <option value="">-- Pilih Periode --</option>
                                <?php if (!empty($PeriodeList)) {
                                    foreach ($PeriodeList as $p) { ?>
                                        <option value="<?= $p['Id'] ?>"><?= html_escape($p['Periode']) ?></option>
                                    <?php } 
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Misi (Dropdown) -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Misi Baru</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" id="EditMisiSelect" disabled>
                                <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-warning" style="margin-top: 15px;">
                    <i class="notika-icon notika-warning"></i>
                    <strong>Perhatian:</strong> Mengubah misi akan memindahkan semua sasaran pokok dari misi lama ke misi baru.
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="BtnEditPeriodeMisi"><b>UPDATE</b></button>
                <button class="btn btn-danger" data-dismiss="modal"><b>BATAL</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL KONFIRMASI HAPUS PERIODE DAN MISI
============================================================ -->
<div class="modal fade" id="ModalHapusPeriodeMisi" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f44336; color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h4 class="modal-title"><b><i class="notika-icon notika-danger"></i> Konfirmasi Hapus</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="HapusIdMisi" value="">
                
                <div class="alert alert-danger" style="margin-bottom: 15px;">
                    <strong>PERINGATAN!</strong> Menghapus misi akan menghapus:
                    <ul style="margin-top: 10px; padding-left: 20px;">
                        <li>Misi ini</li>
                        <li>Semua Sasaran Pokok yang terkait</li>
                        <li>Semua IUP yang terkait dengan sasaran pokok</li>
                    </ul>
                </div>
                
                <div id="HapusInfoData" style="margin-bottom: 15px;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Periode:</strong> <span id="HapusInfoPeriode" class="text-primary">-</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Misi:</strong> <span id="HapusInfoMisi" class="text-primary">-</span>
                        </div>
                    </div>
                </div>
                
                <p class="text-center" style="margin-top: 15px; color: #f44336;">
                    <strong>Data yang dihapus tidak dapat dikembalikan!</strong>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="BtnHapusPeriodeMisi"><b>YA, HAPUS</b></button>
                <button class="btn btn-default" data-dismiss="modal"><b>BATAL</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT SASARAN POKOK
============================================================ -->
<div class="modal fade" id="ModalEditSasaranPokok" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Edit Sasaran Pokok</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditSasaranId">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Sasaran Pokok</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="3" id="EditSasaranPokok" placeholder="Masukkan Sasaran Pokok"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="BtnEditSasaran"><b>UPDATE</b></button>
                <button class="btn btn-danger" data-dismiss="modal"><b>BATAL</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT IUP
============================================================ -->
<div class="modal fade" id="ModalEditIUP" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Edit IUP</b></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditIUPId">
                <input type="hidden" id="EditIUPIdSasaran">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Indikator</b> <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" rows="2" id="EditIndikatorIUP" placeholder="Masukkan Indikator Utama Pembangunan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Satuan</b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditSatuanIUP" placeholder="Contoh: Tahun, %, Jiwa, dll">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap I<br><small>2025-2029</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditTarget1IUP" placeholder="Target 2025-2029">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap II<br><small>2030-2034</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditTarget2IUP" placeholder="Target 2030-2034">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap III<br><small>2035-2039</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditTarget3IUP" placeholder="Target 2035-2039">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Target Tahap IV<br><small>2040-2045</small></b></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditTarget4IUP" placeholder="Target 2040-2045">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="BtnEditIUP"><b>UPDATE</b></button>
                <button class="btn btn-danger" data-dismiss="modal"><b>BATAL</b></button>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    /* ==============================================
   MODAL STYLING - Tombol Close Terlihat
   ============================================== */
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

/* TOMBOL CLOSE - JELAS TERLIHAT */
.modal-header {
    position: relative !important;
    padding: 15px 20px !important;
    border-bottom: 1px solid #e5e5e5 !important;
    background: #fafafa !important;
    border-radius: 4px 4px 0 0 !important;
}

.modal-header .close {
    position: absolute !important;
    right: 15px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    font-size: 28px !important;
    font-weight: 700 !important;
    line-height: 1 !important;
    color: #333 !important;
    text-shadow: none !important;
    opacity: 0.6 !important;
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
    z-index: 10 !important;
    cursor: pointer !important;
    width: 35px !important;
    height: 35px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
}

.modal-header .close:hover {
    opacity: 1 !important;
    background: rgba(0,0,0,0.08) !important;
    transform: translateY(-50%) rotate(90deg) !important;
}

.modal-header .close:focus {
    outline: none !important;
    opacity: 0.8 !important;
}

.modal-header .close span {
    display: inline-block !important;
    font-size: 30px !important;
    line-height: 1 !important;
}

.modal-header h2 {
    font-size: 20px;
    color: #333;
    font-weight: 600;
    margin: 0;
    padding-right: 40px;
}

/* Untuk modal dengan judul kecil */
.modal-header h4.modal-title {
    font-size: 18px;
    margin: 0;
    padding-right: 40px;
    font-weight: 600;
}

/* Modal body */
.modal-body {
    padding: 20px 25px !important;
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}

/* Modal footer */
.modal-footer {
    padding: 12px 20px !important;
    border-top: 1px solid #e5e5e5 !important;
    background: #fafafa !important;
    border-radius: 0 0 4px 4px !important;
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
.table th {
    text-align: center;
    vertical-align: middle;
}
.table td {
    vertical-align: middle;
}
.modal-body {
    padding: 20px 30px;
}
.modal-dialog {
    max-width: 800px;
}
.text-danger {
    color: #ff0000;
}
.btn-sm {
    padding: 4px 10px;
    font-size: 12px;
    margin: 1px;
}
.btn-xs {
    padding: 2px 8px;
    font-size: 10px;
    line-height: 1.4;
}
.btn-xs i {
    font-size: 10px;
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
.btn-amber {
    background-color: #ffbf00;
    color: #333;
}
.btn-amber:hover {
    background-color: #e6ac00;
    color: #333;
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
JAVASCRIPT
============================================================ -->
<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/data-table-act.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/glightbox.min.css') ?>">
<script src="<?= base_url('assets/js/glightbox.min.js') ?>"></script>

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
            showNotification("Mohon Pilih Provinsi", "warning");
            return;
        }
        if ($("#KabKota").val() === "") {
            showNotification("Mohon Pilih Kab/Kota", "warning");
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
                    showNotification(Respon || "Gagal menyimpan filter wilayah!", "error");
                    $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                }
            },
            error: function() {
                showNotification("Gagal menghubungi server!", "error");
                $("#Filter").prop('disabled', false).html('<b>Filter</b>');
            }
        });
    });

    function showNotification(message, type) {
        var container = $('#notification-container');
        if (container.length === 0) {
            container = $('<div id="notification-container" style="position:fixed;top:20px;right:20px;z-index:9999;max-width:400px;"></div>');
            $('body').append(container);
        }
        
        var bgColor = type === 'error' ? '#f44336' : (type === 'warning' ? '#ff9800' : '#4CAF50');
        var icon = type === 'error' ? '✕' : (type === 'warning' ? '⚠' : '✓');
        
        var notification = $('<div class="notification" style="background:'+bgColor+';color:white;padding:12px 18px;margin-bottom:8px;border-radius:5px;box-shadow:0 2px 8px rgba(0,0,0,0.2);animation:slideIn 0.3s ease;display:flex;align-items:center;gap:10px;">' +
            '<span style="font-weight:bold;font-size:18px;">' + icon + '</span>' +
            '<span>' + message + '</span>' +
            '</div>');
        
        container.append(notification);
        
        setTimeout(function() {
            notification.fadeOut(400, function() {
                $(this).remove();
                if (container.children().length === 0) {
                    container.remove();
                }
            });
        }, 3000);
    }

    var style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);

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
                        alert(result.message);
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
    // TOMBOL TAMBAH SASARAN QUICK (DI DALAM TABEL - DI KOLOM SASARAN)
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
    // INPUT SASARAN POKOK - QUICK (DI DALAM TABEL)
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
                        alert(result.message);
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
    // INPUT IUP
    // ============================================================
    $(document).on("click", ".TambahIUP", function() {
        var idSasaran = $(this).data('id');
        var idMisi = $(this).data('idmisi');
        var visiId = $(this).data('visiid');
        var periode = $(this).data('periode');
        var misi = $(this).data('misi');
        var sasaran = $(this).data('sasaran');
        
        $("#InputIndikatorIUP").val('');
        $("#InputSatuanIUP").val('');
        $("#InputTarget1IUP").val('');
        $("#InputTarget2IUP").val('');
        $("#InputTarget3IUP").val('');
        $("#InputTarget4IUP").val('');
        
        $("#InputIUPIdSasaran").val(idSasaran);
        $("#InputIUPIdMisi").val(idMisi);
        $("#InputIUPVisiId").val(visiId);
        
        $('#ModalInputIUP').modal('show');
    });

    $("#BtnInputIUP").click(function() {
        var idSasaran = $("#InputIUPIdSasaran").val();
        var indikator = $("#InputIndikatorIUP").val().trim();
        var satuan = $("#InputSatuanIUP").val().trim();
        var target1 = $("#InputTarget1IUP").val().trim();
        var target2 = $("#InputTarget2IUP").val().trim();
        var target3 = $("#InputTarget3IUP").val().trim();
        var target4 = $("#InputTarget4IUP").val().trim();

        if (idSasaran == "" || idSasaran == "0" || idSasaran == null) {
            alert("⚠️ Sasaran Pokok tidak valid!");
            return;
        }

        if (indikator == "") {
            alert("⚠️ Indikator harus diisi!");
            return;
        }

        var data = {
            IdSasaranPokok: idSasaran,
            Indikator: indikator,
            Satuan: satuan,
            Target1: target1,
            Target2: target2,
            Target3: target3,
            Target4: target4,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $("#BtnInputIUP").prop('disabled', true).text('Menyimpan...');
        
        $.post(BaseURL + "Daerah/InputIUP", data)
            .done(function(Respon) {
                try {
                    var result = JSON.parse(Respon);
                    if (result.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(result.message);
                        $("#BtnInputIUP").prop('disabled', false).text('SIMPAN');
                    }
                } catch(e) {
                    alert("Terjadi kesalahan pada server!");
                    $("#BtnInputIUP").prop('disabled', false).text('SIMPAN');
                }
            })
            .fail(function() {
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
    
    // Reset form
    $("#EditIdMisi").val('');
    $("#EditVisiIdLama").val('');
    $("#EditPeriodeSelect").val('');
    $("#EditMisiSelect").html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
    $("#EditMisiSelect").prop('disabled', true);
    $("#EditMisiLamaInfo").text('Memuat...');
    
    // Ambil data misi untuk ditampilkan di form edit
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
                
                // Set ID Misi Lama
                $("#EditIdMisi").val(data.MisiId);
                $("#EditVisiIdLama").val(data.VisiId);
                
                // Tampilkan informasi misi yang akan diedit
                $("#EditMisiLamaInfo").text(data.Misi || 'Misi tidak ditemukan');
                
                // Set periode yang dipilih (visi dari misi lama)
                $("#EditPeriodeSelect").val(data.VisiId);
                
                // Load misi berdasarkan periode yang dipilih
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
            
            var errorMsg = 'Gagal mengambil data: ';
            if (jqXHR.status === 404) {
                errorMsg += 'Endpoint tidak ditemukan (404)';
            } else if (jqXHR.status === 500) {
                errorMsg += 'Server error (500)';
            } else if (jqXHR.status === 0) {
                errorMsg += 'Koneksi gagal';
            } else {
                errorMsg += textStatus || 'Unknown error';
            }
            
            alert(errorMsg);
            $('#ModalEditPeriodeMisi').modal('hide');
        }
    });
});

// Function untuk load misi di form edit
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
            // Jika response adalah array langsung
            if (!Array.isArray(Data)) {
                // Jika response adalah object dengan data property
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

// Ketika periode berubah di form edit, update misi
$(document).on("change", "#EditPeriodeSelect", function() {
    var periodeId = $(this).val();
    console.log('Periode changed:', periodeId);
    loadMisiForEdit(periodeId, '');
});

// Submit Edit Periode dan Misi
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
    
    // Konfirmasi
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
        timeout: 30000, // 30 second timeout
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
            
            var errorMsg = 'Terjadi kesalahan: ';
            if (jqXHR.status === 404) {
                errorMsg += 'Endpoint tidak ditemukan (404)';
            } else if (jqXHR.status === 500) {
                errorMsg += 'Server error (500) - Cek log server';
            } else if (jqXHR.status === 0) {
                errorMsg += 'Koneksi gagal - Periksa network';
            } else {
                errorMsg += textStatus || 'Unknown error';
            }
            
            if (jqXHR.responseText) {
                try {
                    var resp = JSON.parse(jqXHR.responseText);
                    if (resp.message) errorMsg = resp.message;
                } catch(e) {
                    // Jika response bukan JSON, tampilkan raw response
                    if (jqXHR.responseText.length < 200) {
                        errorMsg += '\n\nResponse: ' + jqXHR.responseText;
                    }
                }
            }
            
            alert(errorMsg);
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
                        alert(result.message);
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
                        alert(result.message);
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
                        alert(result.message);
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
                    alert(result.message);
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
                    alert(result.message);
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