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
                                <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
                                    <button type="button" class="btn btn-primary notika-btn-primary" id="FilterKementerian">
                                        <i class="notika-icon notika-search"></i> 
                                        <b>Filter Data</b>
                                        <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                            <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                        <?php endif; ?>
                                    </button>
                                <?php endif; ?>
                                
                                <?php if (isset($_SESSION['Level']) && ($_SESSION['Level'] == 0 || $_SESSION['Level'] == 1)): ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputProgram">
                                        <i class="notika-icon notika-edit"></i> <b>Input Program Strategis</b>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Modal Filter -->
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
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;"></div>
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
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Lokasi</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div id="edit-lokasi-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <div id="lokasi-table-container"></div>
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
                        <ul class="list-group"></ul>
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
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
         * SWEETALERT2 FUNCTIONS
         * ============================================================ */
        function showToast(icon, title, message, timer = 3000) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: timer,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: icon,
                title: title,
                text: message
            });
        }

        function showLoading(message = 'Memproses...') {
            Swal.fire({
                title: message,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        function closeLoading() {
            Swal.close();
        }

        function showConfirmDelete(title, text, callback) {
            Swal.fire({
                title: title,
                html: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }

        /* ============================================================
         * HELPER
         * ============================================================ */
        function getPeriodeAktif() {
            if (CurrentPeriode) return CurrentPeriode.split("|");

            var p = $("#InputPeriode").val();
            if (!p) {
                showToast('warning', 'Peringatan', 'Periode belum dipilih. Silakan pilih periode terlebih dahulu.');
                return null;
            }
            return p.split("|");
        }

        /* ============================================================
         * DATATABLE
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
         * INPUT PROGRAM STRATEGIS
         * ============================================================ */
        $("#formInputProgram").submit(function (e) {
            e.preventDefault();

            if ($("#NamaProgram").val().trim() === "") {
                showToast('warning', 'Peringatan', 'Nama Program wajib diisi!');
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
                    showToast('warning', 'Peringatan', 'Kementerian wajib dipilih!');
                    return;
                }
                fd.append("IdKementerian", k);
            } else {
                fd.append("IdKementerian", UserKementerian);
            }

            showLoading('Menyimpan data...');

            $.ajax({
                url: BaseURL + "Kementerian/InputProgram",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (res) {
                    closeLoading();
                    var response = res.trim();
                    
                    if (response === "1") {
                        showToast('success', 'Berhasil!', 'Data program strategis berhasil disimpan', 2000);
                        $("#ModalInputProgram").modal("hide");
                        setTimeout(() => location.reload(), 1500);
                    } else if (response === "0") {
                        showToast('error', 'Gagal!', 'Gagal menyimpan data');
                    } else {
                        showToast('error', 'Error!', response || 'Terjadi kesalahan saat menyimpan data');
                    }
                },
                error: function(xhr, status, error) {
                    closeLoading();
                    showToast('error', 'Error!', 'Terjadi kesalahan pada server: ' + status);
                    console.error('Input error:', xhr.responseText);
                }
            });
        });

        /* ============================================================
         * EDIT PROGRAM
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

            if ($("#EditNamaProgram").val().trim() === "") {
                showToast('warning', 'Peringatan', 'Nama Program wajib diisi!');
                return;
            }

            let fd = new FormData(this);
            
            showLoading('Mengupdate data...');

            $.ajax({
                url: BaseURL + "Kementerian/UpdateProgram",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                success: function (res) {
                    closeLoading();
                    var response = res.trim();
                    
                    if (response === "1") {
                        showToast('success', 'Berhasil!', 'Data program berhasil diupdate', 2000);
                        $("#ModalEditProgram").modal("hide");
                        setTimeout(() => location.reload(), 1500);
                    } else if (response === "0") {
                        showToast('error', 'Gagal!', 'Gagal mengupdate data');
                    } else {
                        showToast('error', 'Error!', response || 'Terjadi kesalahan saat update data');
                    }
                },
                error: function(xhr, status, error) {
                    closeLoading();
                    showToast('error', 'Error!', 'Terjadi kesalahan pada server: ' + status);
                    console.error('Update error:', xhr.responseText);
                }
            });
        });

        /* ============================================================
         * TAMBAH LOKASI
         * ============================================================ */
        $(document).on("click", ".TambahLokasi", function () {
            $("#LokasiId").val($(this).data("id"));
            $("#lokasi-table-container").empty();

            let prov = ($(this).data("provinsi") || "").split(",");
            let kota = ($(this).data("kota") || "").split(",");

            if (prov[0]) {
                prov.forEach((p, i) => addLokasiRow($("#lokasi-table-container"), p, kota[i]));
            } else {
                addLokasiRow($("#lokasi-table-container"));
            }

            $("#ModalTambahLokasi").modal("show");
        });

        $(".btn-add-lokasi-row").click(() => addLokasiRow($("#lokasi-table-container")));

        $("#FormTambahLokasi").submit(function (e) {
            e.preventDefault();
            
            showLoading('Menyimpan lokasi...');

            $.post(BaseURL + "Kementerian/UpdateLokasiForProgram", $(this).serialize())
                .done(function(res) {
                    closeLoading();
                    var response = res.trim();
                    
                    if (response === "1") {
                        showToast('success', 'Berhasil!', 'Lokasi berhasil diupdate', 2000);
                        $("#ModalTambahLokasi").modal("hide");
                        setTimeout(() => location.reload(), 1500);
                    } else if (response === "0") {
                        showToast('error', 'Gagal!', 'Gagal mengupdate lokasi');
                    } else {
                        showToast('error', 'Error!', response || 'Terjadi kesalahan saat update lokasi');
                    }
                })
                .fail(function(xhr, status, error) {
                    closeLoading();
                    showToast('error', 'Error!', 'Terjadi kesalahan pada server: ' + status);
                    console.error('Lokasi error:', xhr.responseText);
                });
        });

        /* ============================================================
         * DETAIL LOKASI
         * ============================================================ */
        $(document).on("click", ".DetailLokasi", function () {
            $("#lokasi-detail-container ul").html('<li class="list-group-item text-center"><i class="fa fa-spinner fa-spin"></i> Memuat...</li>');
            $("#ModalDetailLokasi").modal("show");

            $.post(BaseURL + "Kementerian/GetLokasiByIds", {
                ProvinsiIds: $(this).data("provinsi"),
                KotaIds: $(this).data("kota")
            }).done(function (res) {
                try {
                    let data = JSON.parse(res);
                    let html = "";

                    if (!data || !data.length) {
                        html = '<li class="list-group-item text-muted text-center">Tidak ada data lokasi</li>';
                    } else {
                        data.forEach(d => {
                            html += `
                                <li class="list-group-item">
                                    <b>Provinsi:</b> ${d.Provinsi || '-'}<br>
                                    <b>Kota/Kabupaten:</b> ${d.Kota || '-'}
                                </li>`;
                        });
                    }

                    $("#lokasi-detail-container ul").html(html);
                } catch(e) {
                    $("#lokasi-detail-container ul").html('<li class="list-group-item text-danger">Gagal memuat data lokasi</li>');
                    console.error('Parse error:', e);
                }
            }).fail(function(xhr, status, error) {
                $("#lokasi-detail-container ul").html('<li class="list-group-item text-danger">Terjadi kesalahan saat memuat data</li>');
                console.error('Detail error:', xhr.responseText);
            });
        });

        /* ============================================================
         * DELETE PROGRAM - FIXED WITH SWEETALERT
         * ============================================================ */
        $(document).on("click", ".Hapus", function () {
            var id = $(this).data("id");
            var program = $(this).data("program");
            
            showConfirmDelete(
                'Hapus Program Strategis?',
                `Apakah Anda yakin ingin menghapus program "<strong>${program}</strong>"?<br><small style="color: #999;">Data yang dihapus tidak dapat dikembalikan!</small>`,
                function() {
                    showLoading('Menghapus data...');
                    
                    $.post(BaseURL + "Kementerian/DeleteProgram", { Id: id })
                        .done(function(res) {
                            closeLoading();
                            var response = res.trim();
                            
                            if (response === "1") {
                                showToast('success', 'Terhapus!', 'Program strategis berhasil dihapus', 2000);
                                setTimeout(() => location.reload(), 1500);
                            } else if (response === "0") {
                                showToast('error', 'Gagal!', 'Data tidak dapat dihapus');
                            } else {
                                showToast('error', 'Error!', response || 'Terjadi kesalahan saat menghapus data');
                            }
                        })
                        .fail(function(xhr, status, error) {
                            closeLoading();
                            showToast('error', 'Error!', 'Terjadi kesalahan pada server: ' + status);
                            console.error('Delete error:', xhr.responseText);
                        });
                }
            );
        });

        /* ============================================================
         * LOAD KEMENTERIAN UNTUK INPUT
         * ============================================================ */
        $("#InputPeriode").change(function() {
            var periode = $(this).val();
            if (periode) {
                $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                    periode: periode
                }).done(function(res) {
                    try {
                        var data = JSON.parse(res);
                        var select = $("#InputKementerian");
                        select.empty().append('<option value="">-- Pilih Kementerian --</option>');
                        data.forEach(k => {
                            select.append(`<option value="${k.Id}">${k.NamaKementerian}</option>`);
                        });
                    } catch(e) {
                        console.error('Error parsing response:', e);
                    }
                });
            }
        });

        /* ============================================================
         * INIT
         * ============================================================ */
        if (CurrentPeriode && CurrentKementerian) {
            // Already filtered
        }

        console.log('Program Strategis loaded successfully with SweetAlert2!');
    });
    </script>

</div>
</body>
</html>