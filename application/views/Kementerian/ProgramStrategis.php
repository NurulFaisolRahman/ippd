<?php $this->load->view('Kementerian/Sidebar'); ?>

<div class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <ul class="breadcomb-menu" style="list-style: none; padding: 0; margin: 0;">
                            <li style="display: inline-block; margin-right: 5px;">
                                <a href="<?= base_url('Beranda') ?>">Beranda</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block; margin-right: 5px;">
                                <a href="<?= base_url('Kementerian/ProgramStrategis') ?>">Kementerian</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block;">
                                <span class="bread-blk">Program Strategis</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <!-- Header dengan Button -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <!-- Tombol Filter hanya untuk yang tidak login atau Admin -->
                                <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
                                    <button type="button" class="btn btn-primary notika-btn-primary" id="FilterKementerian">
                                        <i class="notika-icon notika-search"></i> 
                                        <b>Filter Data</b>
                                        <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                            <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                        <?php endif; ?>
                                    </button>
                                <?php endif; ?>
                                
                                <!-- Tombol Input untuk yang login (Admin atau Kementerian) -->
                                <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputProgram">
                                        <i class="notika-icon notika-edit"></i> <b>Input Program Strategis</b>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Modal Filter (hanya untuk yang tidak login atau Admin) -->
                        <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
                        <div class="modal fade" id="ModalFilter" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modals-default">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Filter Data Program Strategis</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-example-wrap">
                                            <!-- Filter Periode -->
                                            <div class="form-example-int">
                                                <div class="form-group">
                                                    <label><b>Periode</b></label>
                                                    <select class="form-control" id="FilterPeriode">
                                                        <option value="">Semua Periode</option>
                                                        <?php foreach ($Periode as $periode): ?>
                                                            <?php
                                                                $periodeValue = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                                $selected = ($CurrentPeriode === $periodeValue) ? 'selected' : '';
                                                            ?>
                                                            <option value="<?= $periodeValue ?>" <?= $selected ?>>
                                                                <?= $periode['TahunMulai'] ?> - <?= $periode['TahunAkhir'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Filter Kementerian -->
                                            <div class="form-example-int">
                                                <div class="form-group">
                                                    <label><b>Kementerian</b></label>
                                                    <select class="form-control" id="FilterKementerianSelect" <?= empty($Kementerian) ? 'disabled' : '' ?>>
                                                        <option value="">Semua Kementerian</option>
                                                        <?php if (!empty($Kementerian)): ?>
                                                            <?php foreach ($Kementerian as $k): ?>
                                                                <option value="<?= $k['Id'] ?>" <?= ($CurrentKementerian == $k['Id']) ? 'selected' : '' ?>>
                                                                    <?= $k['NamaKementerian'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <?php if (empty($Kementerian)): ?>
                                                        <small class="text-muted">Pilih periode terlebih dahulu untuk menampilkan kementerian</small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- Buttons -->
                                            <div class="form-example-int mg-t-20">
                                                <button type="button" class="btn btn-success notika-btn-success" id="ApplyFilter">
                                                    Terapkan Filter
                                                </button>
                                                <button type="button" class="btn btn-danger notika-btn-danger" id="ResetFilter">
                                                    Reset Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Tabel Data -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">Kementerian</th>
                                        <th width="15%">Program Strategis</th>
                                        <th width="15%">Provinsi</th>
                                        <th width="15%">Kota/Kabupaten</th>
                                        <th width="10%" class="text-center">Periode</th>
                                        <th width="8%" class="text-center">Target <br><small>Tahun 1</small></th>
                                        <th width="8%" class="text-center">Target <br><small>Tahun 2</small></th>
                                        <th width="8%" class="text-center">Target <br><small>Tahun 3</small></th>
                                        <th width="8%" class="text-center">Target <br><small>Tahun 4</small></th>
                                        <th width="8%" class="text-center">Target <br><small>Tahun 5</small></th>
                                        <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
                                            <th width="10%" class="text-center">Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Program as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                        <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                        <td style="vertical-align: middle;"><?= $key['NamaProgram'] ?></td>
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <!-- Tombol Tambah Lokasi hanya untuk pemilik data atau Admin -->
                                                    <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
                                                        <?php 
                                                        $showTambahLokasi = false;
                                                        if ($_SESSION['Level'] == 0) {
                                                            $showTambahLokasi = true;
                                                        } elseif ($_SESSION['Level'] == 1 && isset($_SESSION['IdKementerian']) && $key['IdKementerian'] == $_SESSION['IdKementerian']) {
                                                            $showTambahLokasi = true;
                                                        }
                                                        
                                                        if ($showTambahLokasi): ?>
                                                        <button class="btn btn-sm btn-success TambahLokasi" 
                                                                title="Tambah Lokasi"
                                                                data-id="<?= $key['Id'] ?>"
                                                                data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                                data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                                style="width: 30px; height: 30px; padding: 0;">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (!empty($key['NamaProvinsi']) && $key['NamaProvinsi'] != '-'): ?>
                                                    <button class="btn btn-sm btn-info DetailLokasi" 
                                                            title="Detail Lokasi"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-provinsi="<?= $key['KodeWilayah'] ?>"
                                                            data-kota="<?= $key['KodeKota'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['NamaProvinsi']) && $key['NamaProvinsi'] != '-'): ?>
                                                        <?= htmlspecialchars($key['NamaProvinsi']) ?>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <!-- Buttons are handled in Provinsi column -->
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['NamaKota']) && $key['NamaKota'] != '-'): ?>
                                                        <?= htmlspecialchars($key['NamaKota']) ?>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;" class="text-center"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                        <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun1'] ?? '-' ?></td>
                                        <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun2'] ?? '-' ?></td>
                                        <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun3'] ?? '-' ?></td>
                                        <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun4'] ?? '-' ?></td>
                                        <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun5'] ?? '-' ?></td>
                                        
                                        <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
                                        <td style="vertical-align: middle;">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <?php 
                                                // Tampilkan tombol edit hanya untuk pemilik data atau Admin
                                                $showEdit = false;
                                                if ($_SESSION['Level'] == 0) {
                                                    $showEdit = true;
                                                } elseif ($_SESSION['Level'] == 1 && isset($_SESSION['IdKementerian']) && $key['IdKementerian'] == $_SESSION['IdKementerian']) {
                                                    $showEdit = true;
                                                }
                                                
                                                if ($showEdit): ?>
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-kementerian="<?= $key['IdKementerian'] ?>"
                                                        data-program="<?= $key['NamaProgram'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        data-target1="<?= $key['TargetTahun1'] ?>"
                                                        data-target2="<?= $key['TargetTahun2'] ?>"
                                                        data-target3="<?= $key['TargetTahun3'] ?>"
                                                        data-target4="<?= $key['TargetTahun4'] ?>"
                                                        data-target5="<?= $key['TargetTahun5'] ?>"
                                                        data-provinsi="<?= $key['KodeWilayah'] ?>"
                                                        data-kota="<?= $key['KodeKota'] ?>"
                                                        style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <?php else: ?>
                                                <button class="btn btn-sm btn-default amber-icon-notika btn-reco-mg btn-button-mg" disabled title="Tidak dapat mengedit data kementerian lain">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <?php endif; ?>
                                                
                                                <?php 
                                                // Tampilkan tombol hapus hanya untuk pemilik data atau Admin
                                                $showDelete = false;
                                                if ($_SESSION['Level'] == 0) {
                                                    $showDelete = true;
                                                } elseif ($_SESSION['Level'] == 1 && isset($_SESSION['IdKementerian']) && $key['IdKementerian'] == $_SESSION['IdKementerian']) {
                                                    $showDelete = true;
                                                }
                                                
                                                if ($showDelete): ?>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                        data-id="<?= $key['Id'] ?>" 
                                                        data-kementerian="<?= $key['IdKementerian'] ?>"
                                                        data-program="<?= htmlspecialchars($key['NamaProgram']) ?>"
                                                        style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                    <i class="notika-icon notika-trash"></i>
                                                </button>
                                                <?php else: ?>
                                                <button class="btn btn-sm btn-default amber-icon-notika btn-reco-mg btn-button-mg" disabled title="Tidak dapat menghapus data kementerian lain">
                                                    <i class="notika-icon notika-trash"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <?php endif; ?>
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

    <!-- Modal Input Program Strategis -->
    <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
    <div class="modal fade" id="ModalInputProgram" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Input Program Strategis</h4>
                </div>
                <div class="modal-body">
                    <form id="formInputProgram">
                        <div class="form-example-wrap">
                            <!-- Lokasi -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Lokasi</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div id="lokasi-container">
                                                <div class="form-group lokasi-row">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <select class="form-control provinsi-select" name="KodeWilayah[]">
                                                                <option value="">Pilih Provinsi (Opsional)</option>
                                                                <?php foreach ($Provinsi as $prov) { ?>
                                                                    <option value="<?= $prov['Kode'] ?>"><?= $prov['Nama'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <select class="form-control kota-select" name="KodeKota[]" disabled>
                                                                <option value="">Pilih Kota/Kabupaten (Opsional)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2" style="padding-top: 25px;">
                                                            <button type="button" class="btn btn-success btn-add-lokasi">
                                                                <i class="notika-icon notika-plus-symbol"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Nama Program -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Program</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="NamaProgram" name="NamaProgram" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Admin: Pilih Periode dan Kementerian (jika tidak ada filter) -->
                            <?php if ($_SESSION['Level'] == 0 && !($CurrentPeriode && $CurrentKementerian)): ?>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="InputPeriode" required>
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($Periode as $periode): ?>
                                                        <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>">
                                                            <?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="InputKementerian" required>
                                                    <option value="">-- Pilih Kementerian --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <!-- Target Inputs -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tahun 1</label>
                                                    <input type="number" class="form-control" name="TargetTahun1">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tahun 2</label>
                                                    <input type="number" class="form-control" name="TargetTahun2">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tahun 3</label>
                                                    <input type="number" class="form-control" name="TargetTahun3">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label>Tahun 4</label>
                                                    <input type="number" class="form-control" name="TargetTahun4">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tahun 5</label>
                                                    <input type="number" class="form-control" name="TargetTahun5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden Inputs -->
                            <?php if ($_SESSION['Level'] == 1): ?>
                                <input type="hidden" name="IdKementerian" value="<?= isset($_SESSION['IdKementerian']) ? $_SESSION['IdKementerian'] : '' ?>">
                            <?php endif; ?>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-success notika-btn-success">Simpan</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Modal Edit Program Strategis -->
    <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
    <div class="modal fade" id="ModalEditProgram" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit Program Strategis</h4>
                </div>
                <div class="modal-body">
                    <form id="formEditProgram">
                        <input type="hidden" id="EditId" name="Id">
                        <input type="hidden" id="EditIdKementerian" name="IdKementerian">
                        <input type="hidden" id="EditTahunMulai" name="TahunMulai">
                        <input type="hidden" id="EditTahunAkhir" name="TahunAkhir">
                        <div class="form-example-wrap">
                            <!-- Lokasi -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Lokasi</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div id="edit-lokasi-container">
                                                <!-- Rows will be added dynamically -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Nama Program -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Program</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditNamaProgram" name="NamaProgram" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Target Inputs -->
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Target</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tahun 1</label>
                                                    <input type="number" class="form-control" id="EditTargetTahun1" name="TargetTahun1">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tahun 2</label>
                                                    <input type="number" class="form-control" id="EditTargetTahun2" name="TargetTahun2">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tahun 3</label>
                                                    <input type="number" class="form-control" id="EditTargetTahun3" name="TargetTahun3">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label>Tahun 4</label>
                                                    <input type="number" class="form-control" id="EditTargetTahun4" name="TargetTahun4">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tahun 5</label>
                                                    <input type="number" class="form-control" id="EditTargetTahun5" name="TargetTahun5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-success notika-btn-success">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Modal Tambah/Edit Lokasi -->
    <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
    <div class="modal fade" id="ModalTambahLokasi" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Tambah/Edit Lokasi</h4>
                </div>
                <div class="modal-body">
                    <form id="FormTambahLokasi">
                        <input type="hidden" id="LokasiId" name="Id">
                        <div id="lokasi-table-container">
                            <!-- Rows will be added dynamically -->
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-success btn-add-lokasi-row">
                                <i class="notika-icon notika-plus-symbol"></i> Tambah Lokasi
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Modal Detail Lokasi -->
    <div class="modal fade" id="ModalDetailLokasi" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Detail Lokasi</h4>
                </div>
                <div class="modal-body">
                    <div id="lokasi-detail-container">
                        <ul class="list-group">
                            <!-- Data will be populated dynamically -->
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/jquery-price-slider.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/data-table/jquery.dataTables.min.js"></script>
    
 <script>
/* ============================================================
 * GLOBAL VARIABLE
 * ============================================================ */
var BaseURL = <?= json_encode(base_url()) ?>;
var CurrentPeriode = <?= json_encode($CurrentPeriode ?? '') ?>;
var CurrentKementerian = <?= json_encode($CurrentKementerian ?? '') ?>;
var UserLevel = <?= json_encode($_SESSION['Level'] ?? -1) ?>;
var UserKementerian = <?= json_encode($_SESSION['IdKementerian'] ?? '') ?>;
var ProvinsiData = <?= json_encode($Provinsi ?? []) ?>;

$(document).ready(function () {

    /* ============================================================
     * HELPER
     * ============================================================ */
    function getPeriodeAktif() {
        if (CurrentPeriode) return CurrentPeriode.split("|");

        var p = $("#InputPeriode").val();
        if (!p) {
            alert("Periode belum dipilih. Silakan pilih periode terlebih dahulu.");
            return null;
        }
        return p.split("|");
    }

    /* ============================================================
     * DATATABLE (WAJIB AMAN)
     * ============================================================ */
    function initDataTable() {

        if ($.fn.DataTable.isDataTable("#data-table-basic")) {
            $("#data-table-basic").DataTable().clear().destroy();
        }

        $("#data-table-basic").DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    }

    initDataTable();

    /* ============================================================
     * FILTER
     * ============================================================ */
    $("#FilterKementerian").click(() => $("#ModalFilter").modal("show"));

    $("#ApplyFilter").click(function () {
        let url = BaseURL + "Kementerian/ProgramStrategis?";
        if ($("#FilterPeriode").val()) url += "periode=" + $("#FilterPeriode").val() + "&";
        if ($("#FilterKementerianSelect").val()) url += "kementerian=" + $("#FilterKementerianSelect").val();
        window.location.href = url;
    });

    $("#ResetFilter").click(() => {
        window.location.href = BaseURL + "Kementerian/ProgramStrategis";
    });

    /* ============================================================
     * PROVINSI & KOTA
     * ============================================================ */
    function populateProvinsi(select) {
        select.empty().append('<option value="">Pilih Provinsi (Opsional)</option>');
        ProvinsiData.forEach(p => {
            select.append(`<option value="${p.Kode}">${p.Nama}</option>`);
        });
    }

    function populateKota(kodeProv, select, selected = "") {
        if (!kodeProv) {
            select.prop("disabled", true)
                  .html('<option value="">Pilih Kota/Kabupaten (Opsional)</option>');
            return;
        }

        $.post(BaseURL + "Kementerian/GetKotaByProvinsi", {
            kode_provinsi: kodeProv
        }).done(function (res) {
            let data = JSON.parse(res);
            select.empty().append('<option value="">Pilih Kota/Kabupaten (Opsional)</option>');
            data.forEach(k => {
                let sel = (k.Kode == selected) ? "selected" : "";
                select.append(`<option value="${k.Kode}" ${sel}>${k.Nama}</option>`);
            });
            select.prop("disabled", false);
        });
    }

    function addLokasiRow(container, prov = "", kota = "") {
        let row = $(`
            <div class="form-group lokasi-row">
                <div class="row">
                    <div class="col-md-5">
                        <select class="form-control provinsi-select" name="KodeWilayah[]"></select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control kota-select" name="KodeKota[]" disabled>
                            <option value="">Pilih Kota/Kabupaten (Opsional)</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top:25px">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `);

        populateProvinsi(row.find(".provinsi-select"));

        if (prov) {
            row.find(".provinsi-select").val(prov);
            populateKota(prov, row.find(".kota-select"), kota);
        }

        container.append(row);
    }

    $(document).on("change", ".provinsi-select", function () {
        populateKota(
            $(this).val(),
            $(this).closest(".lokasi-row").find(".kota-select")
        );
    });

    $(document).on("click", ".btn-add-lokasi", () => addLokasiRow($("#lokasi-container")));
    $(document).on("click", ".btn-remove-row", function () {
        $(this).closest(".lokasi-row").remove();
    });

    /* ============================================================
     * INPUT PROGRAM STRATEGIS (FIX)
     * ============================================================ */
    $("#formInputProgram").submit(function (e) {
        e.preventDefault();

        if ($("#NamaProgram").val() === "") {
            alert("Nama Program wajib diisi!");
            return;
        }

        let periode = getPeriodeAktif();
        if (!periode) return;

        let fd = new FormData(this);
        fd.append("TahunMulai", periode[0]);
        fd.append("TahunAkhir", periode[1]);

        if (UserLevel == 0) {
            let k = CurrentKementerian || $("#InputKementerian").val();
            if (!k) {
                alert("Kementerian wajib dipilih!");
                return;
            }
            fd.append("IdKementerian", k);
        } else {
            fd.append("IdKementerian", UserKementerian);
        }

        $.ajax({
            url: BaseURL + "Kementerian/InputProgram",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res == "1") {
                    $("#ModalInputProgram").modal("hide");
                    setTimeout(() => location.reload(), 300);
                } else {
                    alert(res);
                }
            }
        });
    });

    /* ============================================================
     * EDIT PROGRAM (AKTIF KEMBALI)
     * ============================================================ */
    $(document).on("click", ".Edit", function () {

        $("#EditId").val($(this).data("id"));
        $("#EditNamaProgram").val($(this).data("program"));

        $("#EditTargetTahun1").val($(this).data("target1"));
        $("#EditTargetTahun2").val($(this).data("target2"));
        $("#EditTargetTahun3").val($(this).data("target3"));
        $("#EditTargetTahun4").val($(this).data("target4"));
        $("#EditTargetTahun5").val($(this).data("target5"));

        $("#EditTahunMulai").val($(this).data("tahunmulai"));
        $("#EditTahunAkhir").val($(this).data("tahunakhir"));

        $("#edit-lokasi-container").empty();

        let prov = ($(this).data("provinsi") || "").split(",");
        let kota = ($(this).data("kota") || "").split(",");

        if (prov[0]) {
            prov.forEach((p, i) => addLokasiRow($("#edit-lokasi-container"), p, kota[i]));
        } else {
            addLokasiRow($("#edit-lokasi-container"));
        }

        $("#ModalEditProgram").modal("show");
    });

    $("#formEditProgram").submit(function (e) {
        e.preventDefault();

        let fd = new FormData(this);

        $.ajax({
            url: BaseURL + "Kementerian/UpdateProgram",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: res => res == "1" ? location.reload() : alert(res)
        });
    });

    $(document).on("click", ".TambahLokasi", function () {

    $("#LokasiId").val($(this).data("id"));
    $("#lokasi-table-container").empty();

    let prov = ($(this).data("provinsi") || "").split(",");
    let kota = ($(this).data("kota") || "").split(",");

    if (prov[0]) {
        prov.forEach((p,i)=>addLokasiRow($("#lokasi-table-container"), p, kota[i]));
    } else {
        addLokasiRow($("#lokasi-table-container"));
    }

    $("#ModalTambahLokasi").modal("show");
});

$(".btn-add-lokasi-row").click(() => addLokasiRow($("#lokasi-table-container")));

$("#FormTambahLokasi").submit(function (e) {
    e.preventDefault();

    $.post(BaseURL + "Kementerian/UpdateLokasiForProgram", $(this).serialize())
        .done(res => res=="1" ? location.reload() : alert(res));
});

    /* ============================================================
     * DETAIL LOKASI
     * ============================================================ */
    $(document).on("click", ".DetailLokasi", function () {

        $("#lokasi-detail-container ul").html('<li class="list-group-item">Memuat...</li>');
        $("#ModalDetailLokasi").modal("show");

        $.post(BaseURL + "Kementerian/GetLokasiByIds", {
            ProvinsiIds: $(this).data("provinsi"),
            KotaIds: $(this).data("kota")
        }).done(function (res) {

            let data = JSON.parse(res);
            let html = "";

            if (!data.length) {
                html = '<li class="list-group-item text-muted">Tidak ada data lokasi</li>';
            } else {
                data.forEach(d => {
                    html += `
                        <li class="list-group-item">
                            <b>Provinsi:</b> ${d.Provinsi}<br>
                            <b>Kota/Kabupaten:</b> ${d.Kota}
                        </li>`;
                });
            }

            $("#lokasi-detail-container ul").html(html);
        });
    });

    /* ============================================================
     * DELETE
     * ============================================================ */
    $(document).on("click", ".Hapus", function () {
        if (!confirm("Yakin hapus data ini?")) return;
        $.post(BaseURL + "Kementerian/DeleteProgram", { Id: $(this).data("id") })
            .done(res => res == "1" ? location.reload() : alert(res));
    });

});
</script>

</div>
</body>
</html>


