<?php $this->load->view('Kementerian/Sidebar'); ?>

<!-- DEBUG INFO - Tampilkan di halaman untuk testing -->
<div style="background: #f0f0f0; padding: 10px; margin: 10px; border: 1px solid #ccc; display: none;" id="debugInfo">
    <h4>Debug Info:</h4>
    <p>Username: <?php echo isset($username) ? $username : 'Not logged in'; ?></p>
    <p>User Level: <?php echo isset($userLevel) ? $userLevel : '2'; ?> 
        (0=Admin, 1=Kementerian, 2=Pengunjung)</p>
    <p>User IdKementerian: <?php echo isset($userIdKementerian) ? $userIdKementerian : 'Not set'; ?></p>
    <p>Logged In: <?php echo isset($isLoggedIn) && $isLoggedIn ? 'Yes' : 'No'; ?></p>
    <p>Data Count: <?php echo isset($SPM) ? count($SPM) : '0'; ?></p>
    
    <?php if (isset($SPM) && count($SPM) > 0): ?>
    <p>Sample Data:</p>
    <ul>
        <?php for($i = 0; $i < min(3, count($SPM)); $i++): ?>
        <li>SPM: <?php echo $SPM[$i]['NamaSPM']; ?> - 
            Kementerian: <?php echo $SPM[$i]['NamaKementerian']; ?> 
            (ID: <?php echo $SPM[$i]['IdKementerian']; ?>)</li>
        <?php endfor; ?>
    </ul>
    <?php endif; ?>
</div>

<script>
// Tampilkan debug info dengan menekan Ctrl+D
$(document).keydown(function(e) {
    if (e.ctrlKey && e.keyCode == 68) { // Ctrl+D
        $('#debugInfo').toggle();
        return false;
    }
});
</script>
<!-- END DEBUG INFO -->

<div class="main-content">
    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <ul class="breadcomb-menu" style="list-style: none; padding: 0; margin: 0;">
                            <li style="display: inline-block; margin-right: 5px;">
                                <a href="<?= base_url('Beranda') ?>">Home</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block; margin-right: 5px;">
                                <a href="<?= base_url('Kementerian/SPM') ?>">Kementerian</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block;">
                                <span class="bread-blk">SPM</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <!-- Informasi Status User -->
                        <div class="alert-container" style="margin-bottom: 20px;">
                            <?php if (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && $userLevel == 1): ?>
                                <?php 
                                // Cari nama kementerian user
                                $userKementerianName = isset($userIdKementerian) ? $userIdKementerian : 'Kementerian Anda';
                                ?>
                                <div class="alert alert-success">
                                    <i class="notika-icon notika-checked"></i> 
                                    <strong>Login sebagai Kementerian:</strong> <?= $userKementerianName ?>
                                    <br><small>Hanya menampilkan data dari kementerian Anda</small>
                                </div>
                            <?php elseif (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && $userLevel == 0): ?>
                                <div class="alert alert-info">
                                    <i class="notika-icon notika-info"></i> 
                                    <strong>Login sebagai Admin</strong>
                                    <br><small>Anda dapat melihat dan mengelola semua data</small>
                                </div>
                            <?php elseif (!isset($isLoggedIn) || !$isLoggedIn): ?>
                                <div class="alert alert-warning">
                                    <i class="notika-icon notika-info"></i> 
                                    <strong>Mode Pengunjung</strong>
                                    <br><small>Menampilkan semua data SPM dari semua kementerian</small>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Header dengan Button yang Dinamis -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                
                                <!-- TOMBOL FILTER: untuk Pengunjung (tidak login) dan Admin (Level 0) -->
                                <?php if ((!isset($isLoggedIn) || !$isLoggedIn) || (isset($userLevel) && $userLevel == 0)) { ?>
                                    <button type="button" class="btn btn-primary notika-btn-primary" id="FilterKementerian">
                                        <i class="notika-icon notika-search"></i> 
                                        <b>Filter Data</b>
                                        <?php if ((isset($CurrentPeriode) && $CurrentPeriode) || (isset($CurrentKementerian) && $CurrentKementerian)): ?>
                                            <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                        <?php endif; ?>
                                    </button>
                                <?php } ?>
                                
                                <!-- TOMBOL INPUT: untuk Admin (Level 0) dan Kementerian (Level 1) -->
                                <?php if (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && ($userLevel == 0 || $userLevel == 1)) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSPM">
                                        <i class="notika-icon notika-edit"></i> <b>Input SPM</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Modal Filter (hanya untuk Pengunjung dan Admin) -->
                        <?php if ((!isset($isLoggedIn) || !$isLoggedIn) || (isset($userLevel) && $userLevel == 0)) { ?>
                        <div class="modal fade" id="ModalFilter" role="dialog">
                            <div class="modal-dialog modals-default">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Filter Data SPM</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-example-wrap">
                                                    <div class="form-example-int">
                                                        <div class="form-group">
                                                            <label>Periode</label>
                                                            <select class="form-control" id="FilterPeriode">
                                                                <option value="">Semua Periode</option>
                                                                <?php if (isset($AllPeriode)): ?>
                                                                    <?php foreach ($AllPeriode as $periode): ?>
                                                                        <?php 
                                                                            $periodeValue = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                                            $selected = (isset($CurrentPeriode) && $CurrentPeriode == $periodeValue) ? 'selected' : '';
                                                                        ?>
                                                                        <option value="<?= $periodeValue ?>" <?= $selected ?>>
                                                                            <?= $periode['TahunMulai'] ?> - <?= $periode['TahunAkhir'] ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-example-int">
                                                        <div class="form-group">
                                                            <label>Kementerian</label>
                                                            <select class="form-control" id="FilterKementerianSelect" <?= (isset($Kementerian) && empty($Kementerian)) ? 'disabled' : '' ?>>
                                                                <option value="">Semua Kementerian</option>
                                                                <?php if (isset($Kementerian) && !empty($Kementerian)): ?>
                                                                    <?php foreach ($Kementerian as $kementerian): ?>
                                                                        <?php $selected = (isset($CurrentKementerian) && $CurrentKementerian == $kementerian['Id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $kementerian['Id'] ?>" <?= $selected ?>>
                                                                            <?= $kementerian['NamaKementerian'] ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-example-int mg-t-15">
                                                        <button class="btn btn-success notika-btn-success" id="ApplyFilter">Terapkan Filter</button>
                                                        <button class="btn btn-danger notika-btn-danger" id="ResetFilter">Reset Filter</button>
                                                        <button class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Tabel Data SPM -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="text-center">No</th>
                                        <!-- Kolom Kementerian hanya untuk Pengunjung dan Admin -->
                                        <?php if ((!isset($isLoggedIn) || !$isLoggedIn) || (isset($userLevel) && $userLevel == 0)) { ?>
                                            <th style="width: 20%;">Kementerian</th>
                                            <th style="width: 25%;">SPM</th>
                                        <?php } else { ?>
                                            <th style="width: 40%;">SPM</th>
                                        <?php } ?>
                                        <th style="width: 10%;">Periode</th>
                                        <th style="width: 8%;" class="text-center">Target <br><small>Tahun 1</small></th>
                                        <th style="width: 8%;" class="text-center">Target <br><small>Tahun 2</small></th>
                                        <th style="width: 8%;" class="text-center">Target <br><small>Tahun 3</small></th>
                                        <th style="width: 8%;" class="text-center">Target <br><small>Tahun 4</small></th>
                                        <th style="width: 8%;" class="text-center">Target <br><small>Tahun 5</small></th>
                                        <!-- Kolom Aksi hanya untuk Admin dan Kementerian -->
                                        <?php if (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && ($userLevel == 0 || $userLevel == 1)) { ?>
                                        <th style="width: 10%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!isset($SPM) || empty($SPM)): ?>
                                    <tr>
                                        <td colspan="<?= ((!isset($isLoggedIn) || !$isLoggedIn) || (isset($userLevel) && $userLevel == 0)) ? ((isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && ($userLevel == 0 || $userLevel == 1)) ? 11 : 10) : ((isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && ($userLevel == 0 || $userLevel == 1)) ? 9 : 8) ?>" class="text-center">
                                            <div class="alert alert-info" style="margin: 10px 0;">
                                                <i class="notika-icon notika-info"></i> Tidak ada data SPM yang ditemukan.
                                                <?php if (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && $userLevel == 1): ?>
                                                    <br><small>Silakan input data SPM untuk kementerian Anda.</small>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                        <?php $No = 1; foreach ($SPM as $key): ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <?php if ((!isset($isLoggedIn) || !$isLoggedIn) || (isset($userLevel) && $userLevel == 0)) { ?>
                                                <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                            <?php } ?>
                                            <td style="vertical-align: middle;"><?= $key['NamaSPM'] ?></td>
                                            <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>                                    
                                            <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun1'] ?? '-' ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun2'] ?? '-' ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun3'] ?? '-' ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun4'] ?? '-' ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= $key['TargetTahun5'] ?? '-' ?></td>
                                            <?php if (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && ($userLevel == 0 || $userLevel == 1)) { ?>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                    <?php 
                                                    // Tampilkan tombol edit hanya jika:
                                                    // 1. User adalah Admin (Level 0) ATAU
                                                    // 2. User adalah Kementerian (Level 1) DAN data milik kementeriannya
                                                    $showEdit = false;
                                                    if (isset($userLevel) && $userLevel == 0) {
                                                        $showEdit = true;
                                                    } elseif (isset($userLevel) && $userLevel == 1 && isset($userIdKementerian) && $key['IdKementerian'] == $userIdKementerian) {
                                                        $showEdit = true;
                                                    }
                                                    
                                                    if ($showEdit): ?>
                                                    <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                        data-edit="<?= $key['Id'] . '|' . $key['IdKementerian'] . '|' . $key['NamaSPM'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] . '|' . $key['TargetTahun1'] . '|' . $key['TargetTahun2'] . '|' . $key['TargetTahun3'] . '|' . $key['TargetTahun4'] . '|' . $key['TargetTahun5'] ?>">
                                                        <i class="notika-icon notika-edit"></i>
                                                    </button>
                                                    <?php else: ?>
                                                    <button class="btn btn-sm btn-default amber-icon-notika btn-reco-mg btn-button-mg" disabled title="Tidak dapat mengedit data kementerian lain">
                                                        <i class="notika-icon notika-edit"></i>
                                                    </button>
                                                    <?php endif; ?>
                                                    
                                                    <?php 
                                                    // Tampilkan tombol hapus hanya jika:
                                                    // 1. User adalah Admin (Level 0) ATAU
                                                    // 2. User adalah Kementerian (Level 1) DAN data milik kementeriannya
                                                    $showDelete = false;
                                                    if (isset($userLevel) && $userLevel == 0) {
                                                        $showDelete = true;
                                                    } elseif (isset($userLevel) && $userLevel == 1 && isset($userIdKementerian) && $key['IdKementerian'] == $userIdKementerian) {
                                                        $showDelete = true;
                                                    }
                                                    
                                                    if ($showDelete): ?>
                                                    <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                        data-hapus="<?= $key['Id'] ?>" 
                                                        data-kementerian="<?= $key['IdKementerian'] ?>"
                                                        data-spm="<?= htmlspecialchars($key['NamaSPM']) ?>">
                                                        <i class="notika-icon notika-trash"></i>
                                                    </button>
                                                    <?php else: ?>
                                                    <button class="btn btn-sm btn-default amber-icon-notika btn-reco-mg btn-button-mg" disabled title="Tidak dapat menghapus data kementerian lain">
                                                        <i class="notika-icon notika-trash"></i>
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Input SPM (hanya untuk Admin dan Kementerian) -->
    <?php if (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && ($userLevel == 0 || $userLevel == 1)) { ?>
    <div class="modal fade" id="ModalInputSPM" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Input SPM Baru</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap">
                                <?php if (isset($userLevel) && $userLevel == 1): ?>
                                    <!-- Untuk user kementerian, tampilkan info kementeriannya -->
                                    <div class="alert alert-info" style="margin-bottom: 20px;">
                                        <i class="notika-icon notika-info"></i> 
                                        <strong>Anda akan menambahkan SPM untuk:</strong> 
                                        <?= isset($UserKementerianName) ? $UserKementerianName : 'Kementerian Anda' ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Nama SPM</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="NamaSPM" 
                                                           placeholder="Masukkan nama SPM" required>
                                                    <small class="text-muted">Contoh: Persentase capaian SPM kesehatan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if (isset($userLevel) && $userLevel == 0 && !(isset($CurrentPeriode) && $CurrentPeriode)): ?>
                                <!-- Admin tanpa filter periode perlu pilih periode -->
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control input-sm" id="InputPeriode">
                                                        <option value="">Pilih Periode</option>
                                                        <?php if (isset($AllPeriode)): ?>
                                                            <?php foreach ($AllPeriode as $periode): ?>
                                                                <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>">
                                                                    <?= $periode['TahunMulai'] ?> - <?= $periode['TahunAkhir'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 1</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TargetTahun1" 
                                                           placeholder="Masukkan target tahun 1" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 2</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TargetTahun2" 
                                                           placeholder="Masukkan target tahun 2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 3</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TargetTahun3" 
                                                           placeholder="Masukkan target tahun 3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 4</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TargetTahun4" 
                                                           placeholder="Masukkan target tahun 4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 5</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TargetTahun5" 
                                                           placeholder="Masukkan target tahun 5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="InputSPM">
                                                <i class="notika-icon notika-checked"></i> <b>SIMPAN</b>
                                            </button>
                                            <button class="btn btn-default" data-dismiss="modal">BATAL</button>
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
    <?php } ?>

    <!-- Modal Edit SPM (hanya untuk Admin dan Kementerian) -->
    <?php if (isset($isLoggedIn) && $isLoggedIn && isset($userLevel) && ($userLevel == 0 || $userLevel == 1)) { ?>
    <div class="modal fade" id="ModalEditSPM" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit Data SPM</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Nama SPM</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="hidden" id="EditId">
                                                    <input type="hidden" id="EditIdKementerian">
                                                    <input type="hidden" id="EditTahunMulai">
                                                    <input type="hidden" id="EditTahunAkhir">
                                                    <input type="text" class="form-control input-sm" id="EditNamaSPM" 
                                                           placeholder="Masukkan nama SPM" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 1</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="EditTargetTahun1" 
                                                           placeholder="Masukkan target tahun 1" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 2</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="EditTargetTahun2" 
                                                           placeholder="Masukkan target tahun 2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 3</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="EditTargetTahun3" 
                                                           placeholder="Masukkan target tahun 3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 4</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="EditTargetTahun4" 
                                                           placeholder="Masukkan target tahun 4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 5</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="EditTargetTahun5" 
                                                           placeholder="Masukkan target tahun 5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="UpdateSPM">
                                                <i class="notika-icon notika-checked"></i> <b>UPDATE</b>
                                            </button>
                                            <button class="btn btn-default" data-dismiss="modal">BATAL</button>
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
    <?php } ?>

    <!-- JavaScript -->
    <script>
        var BaseURL = '<?= base_url() ?>';
        var CurrentPeriode = '<?= isset($CurrentPeriode) ? $CurrentPeriode : "" ?>';
        var CurrentKementerian = '<?= isset($CurrentKementerian) ? $CurrentKementerian : "" ?>';
        var isLoggedIn = <?= (isset($isLoggedIn) && $isLoggedIn) ? 'true' : 'false' ?>;
        var userLevel = <?= isset($userLevel) ? $userLevel : '2' ?>;
        var userIdKementerian = '<?= isset($userIdKementerian) ? $userIdKementerian : "" ?>';
        
        $(document).ready(function() {
            // Initialize DataTable
            $('#data-table-basic').DataTable({
                "pageLength": 25,
                "order": [[0, 'asc']],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
            
            // Show filter modal (hanya untuk pengunjung dan admin)
            if ($("#FilterKementerian").length) {
                $("#FilterKementerian").click(function() {
                    if (!isLoggedIn || userLevel == 0) {
                        $('#ModalFilter').modal("show");
                    }
                });
            }
            
            // Load ministries when period filter changes (hanya untuk pengunjung dan admin)
            if ($("#FilterPeriode").length && (!isLoggedIn || userLevel == 0)) {
                $("#FilterPeriode").change(function() {
                    var periode = $(this).val();
                    var selectElement = $("#FilterKementerianSelect");
                    
                    if (periode) {
                        $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                            periode: periode
                        }, function(response) {
                            try {
                                var kementerian = JSON.parse(response);
                                selectElement.empty().append('<option value="">Semua Kementerian</option>');
                                
                                if (kementerian.length > 0) {
                                    $.each(kementerian, function(index, item) {
                                        selectElement.append('<option value="' + item.Id + '">' + item.NamaKementerian + '</option>');
                                    });
                                    selectElement.prop('disabled', false);
                                } else {
                                    selectElement.append('<option value="">Tidak ada kementerian</option>');
                                    selectElement.prop('disabled', true);
                                }
                            } catch(e) {
                                console.error("Error parsing response:", e);
                                selectElement.empty().append('<option value="">Error loading data</option>');
                            }
                        }).fail(function() {
                            alert("Gagal memuat data kementerian");
                        });
                    } else {
                        selectElement.empty().append('<option value="">Semua Kementerian</option>');
                        selectElement.prop('disabled', false);
                    }
                });
            }
            
            // Apply filter
            if ($("#ApplyFilter").length) {
                $("#ApplyFilter").click(function() {
                    var periode = $("#FilterPeriode").val();
                    var kementerian = $("#FilterKementerianSelect").val();
                    var url = BaseURL + "Kementerian/SPM";
                    
                    var params = [];
                    if (periode) params.push("periode=" + encodeURIComponent(periode));
                    if (kementerian) params.push("kementerian=" + encodeURIComponent(kementerian));
                    
                    if (params.length > 0) {
                        url += "?" + params.join("&");
                    }
                    
                    window.location.href = url;
                });
            }
            
            // Reset filter
            if ($("#ResetFilter").length) {
                $("#ResetFilter").click(function() {
                    window.location.href = BaseURL + "Kementerian/SPM";
                });
            }
            
            // Input SPM - LOGIKA KHUSUS BERDASARKAN USER
            $("#InputSPM").click(function() {
                var IdKementerian, TahunMulai, TahunAkhir;
                
                // Validasi login
                if (!isLoggedIn) {
                    alert('Anda harus login untuk melakukan input data!');
                    return;
                }
                
                // Validasi input wajib
                if ($("#NamaSPM").val() === "") {
                    alert('Nama SPM harus diisi!');
                    $("#NamaSPM").focus();
                    return;
                }
                
                if ($("#TargetTahun1").val() === "") {
                    alert('Target Tahun 1 harus diisi!');
                    $("#TargetTahun1").focus();
                    return;
                }
                
                // Untuk user kementerian, ambil data dari session
                if (userLevel == 1) {
                    IdKementerian = userIdKementerian;
                    if (!IdKementerian) {
                        alert('Session kementerian tidak ditemukan!');
                        return;
                    }
                    
                    // Ambil periode dari filter atau default
                    if (CurrentPeriode) {
                        [TahunMulai, TahunAkhir] = CurrentPeriode.split('|');
                    } else {
                        alert('Silakan pilih periode terlebih dahulu melalui filter!');
                        return;
                    }
                } 
                // Untuk admin
                else if (userLevel == 0) {
                    if (!CurrentPeriode || !CurrentKementerian) {
                        // Coba ambil dari input modal
                        if (!$("#InputPeriode").val()) {
                            alert('Pilih Periode terlebih dahulu!');
                            return;
                        }
                        [TahunMulai, TahunAkhir] = $("#InputPeriode").val().split('|');
                        IdKementerian = CurrentKementerian;
                    } else {
                        IdKementerian = CurrentKementerian;
                        [TahunMulai, TahunAkhir] = CurrentPeriode.split('|');
                    }
                }
                
                var Data = {
                    IdKementerian: IdKementerian,
                    NamaSPM: $("#NamaSPM").val(),
                    TahunMulai: TahunMulai,
                    TahunAkhir: TahunAkhir,
                    TargetTahun1: $("#TargetTahun1").val() || 0,
                    TargetTahun2: $("#TargetTahun2").val() || 0,
                    TargetTahun3: $("#TargetTahun3").val() || 0,
                    TargetTahun4: $("#TargetTahun4").val() || 0,
                    TargetTahun5: $("#TargetTahun5").val() || 0
                };
                
                // Tampilkan loading
                $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Kementerian/InputSPM", Data)
                .done(function(Respon) {
                    if (Respon == '1') {
                        alert('Data berhasil disimpan!');
                        window.location.reload();
                    } else {
                        alert('Error: ' + Respon);
                        $("#InputSPM").prop('disabled', false).html('<i class="notika-icon notika-checked"></i> <b>SIMPAN</b>');
                    }
                })
                .fail(function() {
                    alert('Gagal menyimpan data. Periksa koneksi internet Anda.');
                    $("#InputSPM").prop('disabled', false).html('<i class="notika-icon notika-checked"></i> <b>SIMPAN</b>');
                });
            });
            
            // Edit SPM - validasi hak akses
            $(document).on("click", ".Edit:not(:disabled)", function() {
                if (!isLoggedIn) {
                    alert('Anda harus login untuk mengedit data!');
                    return;
                }
                
                var Data = $(this).data('edit').split("|");
                var dataIdKementerian = Data[1];
                
                // Untuk user kementerian, cek apakah data miliknya
                if (isLoggedIn && userLevel == 1 && dataIdKementerian != userIdKementerian) {
                    alert('Anda hanya bisa mengedit data kementerian Anda sendiri!');
                    return;
                }
                
                $("#EditId").val(Data[0]);
                $("#EditIdKementerian").val(Data[1]);
                $("#EditNamaSPM").val(Data[2]);
                $("#EditTahunMulai").val(Data[3]);
                $("#EditTahunAkhir").val(Data[4]);
                $("#EditTargetTahun1").val(Data[5]);
                $("#EditTargetTahun2").val(Data[6]);
                $("#EditTargetTahun3").val(Data[7]);
                $("#EditTargetTahun4").val(Data[8]);
                $("#EditTargetTahun5").val(Data[9]);
                
                $('#ModalEditSPM').modal("show");
            });
            
            // Update SPM
            $("#UpdateSPM").click(function() {
                if ($("#EditNamaSPM").val() === "") {
                    alert('Nama SPM harus diisi!');
                    $("#EditNamaSPM").focus();
                    return;
                }
                
                // Tampilkan loading
                $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');
                
                var Data = {
                    Id: $("#EditId").val(),
                    NamaSPM: $("#EditNamaSPM").val(),
                    TargetTahun1: $("#EditTargetTahun1").val() || 0,
                    TargetTahun2: $("#EditTargetTahun2").val() || 0,
                    TargetTahun3: $("#EditTargetTahun3").val() || 0,
                    TargetTahun4: $("#EditTargetTahun4").val() || 0,
                    TargetTahun5: $("#EditTargetTahun5").val() || 0
                };
                
                $.post(BaseURL + "Kementerian/UpdateSPM", Data)
                .done(function(Respon) {
                    if (Respon == '1') {
                        alert('Data berhasil diperbarui!');
                        window.location.reload();
                    } else {
                        alert('Error: ' + Respon);
                        $("#UpdateSPM").prop('disabled', false).html('<i class="notika-icon notika-checked"></i> <b>UPDATE</b>');
                    }
                })
                .fail(function() {
                    alert('Gagal memperbarui data. Periksa koneksi internet Anda.');
                    $("#UpdateSPM").prop('disabled', false).html('<i class="notika-icon notika-checked"></i> <b>UPDATE</b>');
                });
            });
            
            // Delete SPM - validasi hak akses
            $(document).on("click", ".Hapus:not(:disabled)", function() {
                if (!isLoggedIn) {
                    alert('Anda harus login untuk menghapus data!');
                    return;
                }
                
                var Id = $(this).data('hapus');
                var dataIdKementerian = $(this).data('kementerian');
                var spmName = $(this).data('spm');
                
                // Untuk user kementerian, cek apakah data miliknya
                if (isLoggedIn && userLevel == 1 && dataIdKementerian != userIdKementerian) {
                    alert('Anda hanya bisa menghapus data kementerian Anda sendiri!');
                    return;
                }
                
                if (confirm('Apakah Anda yakin ingin menghapus data SPM "' + spmName + '"?')) {
                    var data = { Id: Id };
                    $.post(BaseURL + "Kementerian/DeleteSPM", data).done(function(Respon) {
                        if (Respon == '1') {
                            alert('Data berhasil dihapus!');
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    });
                }
            });
            
            // Validasi input hanya angka untuk target
            $('input[id^="TargetTahun"], input[id^="EditTargetTahun"]').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
            });
            
            // Clear modal input when closed
            $('#ModalInputSPM').on('hidden.bs.modal', function () {
                $(this).find('input[type="text"], input[type="number"]').val('');
                $('#InputSPM').prop('disabled', false).html('<i class="notika-icon notika-checked"></i> <b>SIMPAN</b>');
            });
            
            $('#ModalEditSPM').on('hidden.bs.modal', function () {
                $('#UpdateSPM').prop('disabled', false).html('<i class="notika-icon notika-checked"></i> <b>UPDATE</b>');
            });
        });
    </script>
</div>
</body>
</html>