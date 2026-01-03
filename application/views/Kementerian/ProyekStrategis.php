<?php $this->load->view('Kementerian/Sidebar'); ?>
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
                            <a href="<?= base_url('Kementerian/ProyekStrategis') ?>">Kementerian</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block;">
                            <span class="bread-blk">Proyek Strategis</span>
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
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-primary notika-btn-primary" id="FilterProyek">
                                <i class="notika-icon notika-search"></i> 
                                <b>Filter Data</b>
                                <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                    <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                <?php endif; ?>
                            </button>
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                            <button type="button" class="btn btn-success notika-btn-success" id="BtnInputProyek">
                                <i class="notika-icon notika-edit"></i> <b>Input Proyek Strategis</b>
                            </button>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Modal Filter -->
                    <div class="modal fade" id="ModalFilter" role="dialog">
                        <div class="modal-dialog modal-large">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Filter Data Proyek Strategis</h4>
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
                                                            <?php foreach ($Periode as $periode): ?>
                                                                <?php 
                                                                    $periodeValue = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                                    $selected = ($CurrentPeriode == $periodeValue) ? 'selected' : '';
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
                                                        <label>Kementerian</label>
                                                        <select class="form-control" id="FilterKementerianSelect" <?= empty($Kementerian) && !$CurrentKementerian ? 'disabled' : '' ?>>
                                                            <option value="">Semua Kementerian</option>
                                                            <?php if (!empty($Kementerian)): ?>
                                                                <?php foreach ($Kementerian as $kementerian): ?>
                                                                    <?php $selected = ($CurrentKementerian == $kementerian['Id']) ? 'selected' : ''; ?>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="15%">Kementerian</th>
                                    <th width="15%">Program Strategis</th>
                                    <th width="15%">Proyek Strategis</th>
                                    <th width="15%">Provinsi</th>
                                    <th width="15%">Kota/Kabupaten</th>
                                    <th width="10%" class="text-center">Periode</th>
                                    <th width="8%" class="text-center">Target <br><small>Tahun 1</small></th>
                                    <th width="8%" class="text-center">Target <br><small>Tahun 2</small></th>
                                    <th width="8%" class="text-center">Target <br><small>Tahun 3</small></th>
                                    <th width="8%" class="text-center">Target <br><small>Tahun 4</small></th>
                                    <th width="8%" class="text-center">Target <br><small>Tahun 5</small></th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Proyek as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaProgram'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaProyek'] ?></td>
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                <button class="btn btn-sm btn-success TambahLokasi" 
                                                        title="Tambah Lokasi"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php } ?>
                                                <?php if (!empty($key['NamaProvinsi']) && $key['NamaProvinsi'] != '-'): ?>
                                                <button class="btn btn-sm btn-info DetailLokasi" 
                                                        title="Detail Lokasi"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-provinsi="<?= htmlspecialchars($key['KodeWilayah'] ?? '') ?>"
                                                        data-kota="<?= htmlspecialchars($key['KodeKota'] ?? '') ?>"
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
                                    <td style="vertical-align: middle;">
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['Id'] ?>"
                                                    data-kementerian="<?= $key['IdKementerian'] ?>"
                                                    data-program="<?= $key['IdProgramStrategis'] ?>"
                                                    data-proyek="<?= htmlspecialchars($key['NamaProyek']) ?>"
                                                    data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                    data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                    data-target1="<?= $key['TargetTahun1'] ?? '' ?>"
                                                    data-target2="<?= $key['TargetTahun2'] ?? '' ?>"
                                                    data-target3="<?= $key['TargetTahun3'] ?? '' ?>"
                                                    data-target4="<?= $key['TargetTahun4'] ?? '' ?>"
                                                    data-target5="<?= $key['TargetTahun5'] ?? '' ?>"
                                                    data-provinsi="<?= htmlspecialchars($key['KodeWilayah'] ?? '') ?>"
                                                    data-kota="<?= htmlspecialchars($key['KodeKota'] ?? '') ?>"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-id="<?= $key['Id'] ?>"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
                                            <?php } ?>
                                        </div>
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

<!-- Modal Input Proyek Strategis -->
<div class="modal fade" id="ModalInputProyek" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Input Proyek Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formInputProyek">
                    <div class="form-example-wrap">
                        <!-- Program Strategis Dropdown -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Program Strategis</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="IdProgramStrategis" name="IdProgramStrategis" required>
                                            <option value="">-- Pilih Program Strategis --</option>
                                        </select>
                                        <div class="text-danger" id="program-error" style="display: none;">
                                            Program Strategis harus dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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

                        <!-- Proyek Name -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Nama Proyek</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="NamaProyek" name="NamaProyek" required>
                                            <div class="text-danger" id="nama-proyek-error" style="display: none;">
                                                Nama Proyek harus diisi
                                            </div>
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
                                                <input type="number" class="form-control" name="TargetTahun1" step="0.01">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tahun 2</label>
                                                <input type="number" class="form-control" name="TargetTahun2" step="0.01">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tahun 3</label>
                                                <input type="number" class="form-control" name="TargetTahun3" step="0.01">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label>Tahun 4</label>
                                                <input type="number" class="form-control" name="TargetTahun4" step="0.01">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tahun 5</label>
                                                <input type="number" class="form-control" name="TargetTahun5" step="0.01">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="IdKementerian" id="InputIdKementerian">
                        <input type="hidden" name="TahunMulai" id="InputTahunMulai">
                        <input type="hidden" name="TahunAkhir" id="InputTahunAkhir">
                    </div>
                    <div class="form-example-int">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-success notika-btn-success" id="BtnSubmitProyek">
                                    <i class="notika-icon notika-checked"></i> Simpan
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Proyek Strategis -->
<div class="modal fade" id="ModalEditProyek" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Proyek Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="formEditProyek">
                    <input type="hidden" id="EditId" name="Id">
                    <input type="hidden" id="EditIdKementerian" name="IdKementerian">
                    <input type="hidden" id="EditTahunMulai" name="TahunMulai">
                    <input type="hidden" id="EditTahunAkhir" name="TahunAkhir">
                    <div class="form-example-wrap">
                        <!-- Program Strategis Dropdown -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Program Strategis</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="EditIdProgramStrategis" name="IdProgramStrategis" required>
                                            <option value="">-- Pilih Program Strategis --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

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

                        <!-- Proyek Name -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Nama Proyek</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="EditNamaProyek" name="NamaProyek" required>
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
                                                <input type="number" class="form-control" name="TargetTahun1" id="EditTargetTahun1" step="0.01">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tahun 2</label>
                                                <input type="number" class="form-control" name="TargetTahun2" id="EditTargetTahun2" step="0.01">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tahun 3</label>
                                                <input type="number" class="form-control" name="TargetTahun3" id="EditTargetTahun3" step="0.01">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label>Tahun 4</label>
                                                <input type="number" class="form-control" name="TargetTahun4" id="EditTargetTahun4" step="0.01">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Tahun 5</label>
                                                <input type="number" class="form-control" name="TargetTahun5" id="EditTargetTahun5" step="0.01">
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
                                <button type="submit" class="btn btn-success notika-btn-success">
                                    <i class="notika-icon notika-checked"></i> Update
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Lokasi -->
<div class="modal fade" id="ModalTambahLokasi" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Lokasi -->
<div class="modal fade" id="ModalDetailLokasi" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
<script>
$(document).ready(function() {
    var BaseURL = '<?= base_url() ?>';
    var CurrentPeriode = '<?= $CurrentPeriode ?>';
    var CurrentKementerian = '<?= $CurrentKementerian ?>';

    // Function to populate Kementerian dropdown
    function populateKementerian(periode, selectElement, selectedId = '') {
        if (periode) {
            $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                periode: periode
            }, function(response) {
                var kementerian = JSON.parse(response);
                selectElement.empty().append('<option value="">Semua Kementerian</option>');
                if (kementerian.length > 0) {
                    $.each(kementerian, function(index, item) {
                        var isSelected = (item.Id == selectedId) ? 'selected' : '';
                        selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                    });
                    selectElement.prop('disabled', false);
                } else {
                    selectElement.append('<option value="">Tidak ada kementerian</option>');
                    selectElement.prop('disabled', true);
                }
            }).fail(function() {
                selectElement.empty().append('<option value="">Gagal memuat kementerian</option>').prop('disabled', true);
            });
        } else {
            selectElement.empty().append('<option value="">Semua Kementerian</option>').prop('disabled', true);
        }
    }

    // Function to populate Provinsi dropdown
    function populateProvinsi(selectElement, provinsiData, selectedId = '') {
        selectElement.empty().append('<option value="">Pilih Provinsi (Opsional)</option>');
        if (provinsiData && provinsiData.length > 0) {
            $.each(provinsiData, function(index, item) {
                var isSelected = (item.Kode == selectedId) ? 'selected' : '';
                selectElement.append('<option value="' + item.Kode + '" ' + isSelected + '>' + item.Nama + '</option>');
            });
        }
    }

    // Function to populate Kota dropdown
    function populateKota(provinsiKode, selectElement, selectedKota = '') {
        if (provinsiKode) {
            $.post(BaseURL + "Kementerian/GetKotaByProvinsi", { 
                kode_provinsi: provinsiKode 
            }, function(response) {
                var kotaData = JSON.parse(response);
                selectElement.empty().append('<option value="">Pilih Kota/Kabupaten (Opsional)</option>');
                $.each(kotaData, function(index, item) {
                    var isSelected = (item.Kode == selectedKota) ? 'selected' : '';
                    selectElement.append('<option value="' + item.Kode + '" ' + isSelected + '>' + item.Nama + '</option>');
                });
                selectElement.prop('disabled', false);
            }).fail(function() {
                selectElement.empty().append('<option value="">Gagal memuat kota</option>').prop('disabled', true);
            });
        } else {
            selectElement.empty().append('<option value="">Pilih Kota/Kabupaten (Opsional)</option>').prop('disabled', true);
        }
    }

    // Function to add new lokasi row
    function addLokasiRow(containerId, rowClass, provinsiClass, kotaClass, buttonClass, provinsiData) {
        var newRow = $(`#${containerId} .${rowClass}:first`).clone();
        newRow.find(`.${provinsiClass}`).val('');
        newRow.find(`.${kotaClass}`).val('').prop('disabled', true).html('<option value="">Pilih Kota/Kabupaten (Opsional)</option>');
        newRow.find(`.${buttonClass}`).removeClass(buttonClass).addClass('btn-remove-row')
            .html('<i class="notika-icon notika-trash"></i>')
            .removeClass('btn-success').addClass('btn-danger');
        $(`#${containerId}`).append(newRow);
        populateProvinsi(newRow.find(`.${provinsiClass}`), provinsiData);
    }

    // Handle add lokasi button click
    $(document).on('click', '.btn-add-lokasi', function() {
        var provinsiData = <?= json_encode($Provinsi) ?>;
        addLokasiRow('lokasi-container', 'lokasi-row', 'provinsi-select', 'kota-select', 'btn-add-lokasi', provinsiData);
    });

    $(document).on('click', '.btn-add-lokasi-row', function() {
        var provinsiData = <?= json_encode($Provinsi) ?>;
        addLokasiRow('lokasi-table-container', 'lokasi-row', 'provinsi-select', 'kota-select', 'btn-add-lokasi', provinsiData);
    });

    // Handle remove row button click
    $(document).on('click', '.btn-remove-row', function() {
        if ($(`#${$(this).closest('.form-group').parent().attr('id')} .form-group`).length > 1) {
            $(this).closest('.form-group').remove();
        }
    });

    // Provinsi change handler for dynamic kota loading
    $(document).on('change', '.provinsi-select', function() {
        var provinsiKode = $(this).val();
        var kotaSelect = $(this).closest('.lokasi-row').find('.kota-select');
        populateKota(provinsiKode, kotaSelect);
    });

    // Show filter modal
    $("#FilterProyek").click(function() {
        $('#ModalFilter').modal("show");
    });

    // Load Kementerian when Periode filter changes
    $("#FilterPeriode").change(function() {
        var periode = $(this).val();
        populateKementerian(periode, $("#FilterKementerianSelect"));
    });

    // Apply filter
    $("#ApplyFilter").click(function() {
        var periode = $("#FilterPeriode").val();
        var kementerian = $("#FilterKementerianSelect").val();
        var url = BaseURL + "Kementerian/ProyekStrategis?";
        
        if (periode) url += "periode=" + encodeURIComponent(periode) + "&";
        if (kementerian) url += "kementerian=" + encodeURIComponent(kementerian);
        
        window.location.href = url;
    });

    // Reset filter
    $("#ResetFilter").click(function() {
        window.location.href = BaseURL + "Kementerian/ProyekStrategis";
    });

    // Function to populate Program Strategis dropdown
    function populateProgramStrategis(selectElement, idKementerian, tahunMulai, tahunAkhir, selectedId = '') {
        console.log("Populating Program Strategis:", idKementerian, tahunMulai, tahunAkhir);
        
        if (idKementerian && tahunMulai && tahunAkhir) {
            // Show loading
            selectElement.empty().append('<option value="">Memuat program...</option>').prop('disabled', true);
            
            $.post(BaseURL + "Kementerian/GetProgramByKementerianAndPeriode", {
                IdKementerian: idKementerian,
                TahunMulai: tahunMulai,
                TahunAkhir: tahunAkhir
            }, function(response) {
                console.log("Program Response:", response);
                var program = JSON.parse(response);
                selectElement.empty().append('<option value="">-- Pilih Program Strategis --</option>');
                
                if (program.length > 0) {
                    $.each(program, function(index, item) {
                        var isSelected = (item.Id == selectedId) ? 'selected' : '';
                        selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaProgram + '</option>');
                    });
                    selectElement.prop('disabled', false);
                    $('#program-error').hide();
                } else {
                    selectElement.append('<option value="">Tidak ada program tersedia</option>');
                    selectElement.prop('disabled', true);
                    $('#program-error').show().text('Tidak ada Program Strategis yang tersedia untuk Kementerian dan Periode ini!');
                }
            }).fail(function(xhr, status, error) {
                console.error("Error loading programs:", error);
                selectElement.empty().append('<option value="">Gagal memuat program</option>').prop('disabled', true);
                $('#program-error').show().text('Gagal memuat data Program Strategis');
            });
        } else {
            selectElement.empty().append('<option value="">-- Pilih Program Strategis --</option>').prop('disabled', true);
            $('#program-error').show().text('Harap pilih Periode dan Kementerian terlebih dahulu di filter');
        }
    }

    // Handle Input Proyek button click
    $("#BtnInputProyek").click(function() {
        if (!CurrentPeriode || !CurrentKementerian) {
            alert('Harap pilih Periode dan Kementerian terlebih dahulu di filter!');
            $('#ModalFilter').modal('show');
            return;
        }

        // Reset form
        $('#formInputProyek')[0].reset();
        $('#lokasi-container').html(`
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
        `);

        // Populate Program Strategis
        var [tahunMulai, tahunAkhir] = CurrentPeriode.split('|');
        populateProgramStrategis($("#IdProgramStrategis"), CurrentKementerian, tahunMulai, tahunAkhir);

        $('#ModalInputProyek').modal('show');
    });

    // Input Proyek Strategis
    $("#formInputProyek").submit(function(e) {
        e.preventDefault();
        
        // Reset error messages
        $('.text-danger').hide();
        
        // Validate form
        var isValid = true;
        
        if (!$("#IdProgramStrategis").val()) {
            $('#program-error').show();
            isValid = false;
        }
        
        if (!$("#NamaProyek").val()) {
            $('#nama-proyek-error').show();
            isValid = false;
        }
        
        if (!isValid) {
            alert('Harap lengkapi semua field yang wajib diisi!');
            return;
        }

        if (!CurrentPeriode || !CurrentKementerian) {
            alert('Pilih Periode dan Kementerian terlebih dahulu di filter!');
            return;
        }

        var [TahunMulai, TahunAkhir] = CurrentPeriode.split('|');
        $("#InputIdKementerian").val(CurrentKementerian);
        $("#InputTahunMulai").val(TahunMulai);
        $("#InputTahunAkhir").val(TahunAkhir);

        // Show loading
        $('#BtnSubmitProyek').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        var formData = $(this).serialize();
        
        console.log("Sending data:", formData);
        
        $.post(BaseURL + "Kementerian/InputProyek", formData)
            .done(function(Respon) {
                if (Respon == '1') {
                    alert('Proyek Strategis berhasil disimpan!');
                    $('#ModalInputProyek').modal('hide');
                    window.location.reload();
                } else {
                    alert('Error: ' + Respon);
                }
            })
            .fail(function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("Terjadi kesalahan saat mengirim data");
            })
            .always(function() {
                $('#BtnSubmitProyek').prop('disabled', false).html('<i class="notika-icon notika-checked"></i> Simpan');
            });
    });

    // Edit Proyek Strategis - Open Modal
    $(document).on("click", ".Edit", function() {
        var data = $(this).data();
        
        console.log("Edit Data:", data);
        
        // Clear previous data
        $("#EditId").val('');
        $("#EditIdKementerian").val('');
        $("#EditTahunMulai").val('');
        $("#EditTahunAkhir").val('');
        $("#EditNamaProyek").val('');
        $("#EditTargetTahun1").val('');
        $("#EditTargetTahun2").val('');
        $("#EditTargetTahun3").val('');
        $("#EditTargetTahun4").val('');
        $("#EditTargetTahun5").val('');

        // Set new data
        $("#EditId").val(data.id);
        $("#EditIdKementerian").val(data.kementerian);
        $("#EditTahunMulai").val(data.tahunmulai);
        $("#EditTahunAkhir").val(data.tahunakhir);
        $("#EditNamaProyek").val(data.proyek || '');
        $("#EditTargetTahun1").val(data.target1 || '');
        $("#EditTargetTahun2").val(data.target2 || '');
        $("#EditTargetTahun3").val(data.target3 || '');
        $("#EditTargetTahun4").val(data.target4 || '');
        $("#EditTargetTahun5").val(data.target5 || '');

        // Populate Program Strategis
        populateProgramStrategisEdit(data.kementerian, data.tahunmulai, data.tahunakhir, data.program);

        // Populate Lokasi rows
        populateLokasiEdit(data.provinsi, data.kota);

        $('#ModalEditProyek').modal("show");
    });

    // Function khusus untuk populate Program Strategis di Edit Modal
    function populateProgramStrategisEdit(idKementerian, tahunMulai, tahunAkhir, selectedId = '') {
        console.log("Populating Program Strategis for Edit:", idKementerian, tahunMulai, tahunAkhir, selectedId);
        
        if (idKementerian && tahunMulai && tahunAkhir) {
            // Show loading
            $("#EditIdProgramStrategis").empty().append('<option value="">Memuat program...</option>').prop('disabled', true);
            
            $.post(BaseURL + "Kementerian/GetProgramByKementerianAndPeriode", {
                IdKementerian: idKementerian,
                TahunMulai: tahunMulai,
                TahunAkhir: tahunAkhir
            }, function(response) {
                console.log("Edit Program Response:", response);
                var program = JSON.parse(response);
                $("#EditIdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>');
                
                if (program.length > 0) {
                    $.each(program, function(index, item) {
                        var isSelected = (item.Id == selectedId) ? 'selected' : '';
                        $("#EditIdProgramStrategis").append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaProgram + '</option>');
                    });
                    $("#EditIdProgramStrategis").prop('disabled', false);
                    
                    // Jika selectedId tidak ditemukan, pilih yang pertama
                    if (selectedId && !$("#EditIdProgramStrategis").val()) {
                        $("#EditIdProgramStrategis").val(program[0].Id);
                    }
                } else {
                    $("#EditIdProgramStrategis").append('<option value="">Tidak ada program tersedia</option>');
                    $("#EditIdProgramStrategis").prop('disabled', true);
                }
            }).fail(function(xhr, status, error) {
                console.error("Error loading programs for edit:", error);
                $("#EditIdProgramStrategis").empty().append('<option value="">Gagal memuat program</option>').prop('disabled', true);
            });
        } else {
            $("#EditIdProgramStrategis").empty().append('<option value="">-- Pilih Program Strategis --</option>').prop('disabled', true);
        }
    }

    // Function untuk populate lokasi di Edit Modal
    function populateLokasiEdit(provinsiIds = '', kotaIds = '') {
        console.log("populateLokasiEdit called with:", provinsiIds, kotaIds);
        
        $('#edit-lokasi-container').empty();
        var provinsiData = <?= json_encode($Provinsi) ?>;
        
        try {
            // Convert to string first, then handle
            var provinsiStr = String(provinsiIds || '');
            var kotaStr = String(kotaIds || '');
            
            var provinsiArray = provinsiStr ? provinsiStr.split(',') : [];
            var kotaArray = kotaStr ? kotaStr.split(',') : [];
            
            // Clean up arrays
            provinsiArray = provinsiArray.filter(item => item && item !== 'null' && item !== 'undefined');
            kotaArray = kotaArray.filter(item => item && item !== 'null' && item !== 'undefined');
            
            console.log("Processed arrays:", provinsiArray, kotaArray);
            
            if (provinsiArray.length > 0) {
                provinsiArray.forEach(function(provId, index) {
                    var kotaId = kotaArray[index] || '';
                    if (provId && provId !== 'null') {
                        addLokasiEditRow(provId, kotaId, provinsiData);
                    }
                });
            }
            
            // Always add at least one empty row
            if ($('#edit-lokasi-container .lokasi-row').length === 0) {
                addLokasiEditRow('', '', provinsiData);
            }
            
        } catch (error) {
            console.error("Error in populateLokasiEdit:", error);
            // Fallback - add empty row
            addLokasiEditRow('', '', provinsiData);
        }
    }

    // Function untuk menambah row lokasi di Edit Modal
    function addLokasiEditRow(provId = '', kotaId = '', provinsiData) {
        console.log("Adding lokasi row:", provId, kotaId);
        
        var newRow = `
            <div class="form-group lokasi-row">
                <div class="row">
                    <div class="col-md-5">
                        <select class="form-control provinsi-select" name="KodeWilayah[]">
                            <option value="">Pilih Provinsi (Opsional)</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control kota-select" name="KodeKota[]" ${provId ? '' : 'disabled'}>
                            <option value="">Pilih Kota/Kabupaten (Opsional)</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <button type="button" class="btn btn-success btn-add-edit-lokasi">
                            <i class="notika-icon notika-plus-symbol"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-remove-edit-row" style="display: none;">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
        
        $('#edit-lokasi-container').append(newRow);
        
        var provSelect = $('#edit-lokasi-container .provinsi-select').last();
        var kotaSelect = $('#edit-lokasi-container .kota-select').last();
        var addButton = $('#edit-lokasi-container .btn-add-edit-lokasi').last();
        var removeButton = $('#edit-lokasi-container .btn-remove-edit-row').last();
        
        // Populate provinsi
        populateProvinsi(provSelect, provinsiData, provId);
        
        // Jika ada provinsi yang dipilih, populate kota
        if (provId) {
            populateKota(provId, kotaSelect, kotaId);
        }
        
        // Show remove button if there are multiple rows
        updateEditLokasiButtons();
    }

    // Update button visibility for edit modal
    function updateEditLokasiButtons() {
        var rows = $('#edit-lokasi-container .lokasi-row');
        if (rows.length > 1) {
            $('#edit-lokasi-container .btn-remove-edit-row').show();
            $('#edit-lokasi-container .btn-add-edit-lokasi').hide();
            $('#edit-lokasi-container .btn-add-edit-lokasi').last().show();
        } else {
            $('#edit-lokasi-container .btn-remove-edit-row').hide();
            $('#edit-lokasi-container .btn-add-edit-lokasi').show();
        }
    }

    // Handle add lokasi button in edit modal
    $(document).on('click', '.btn-add-edit-lokasi', function() {
        var provinsiData = <?= json_encode($Provinsi) ?>;
        addLokasiEditRow('', '', provinsiData);
    });

    // Handle remove row in edit modal
    $(document).on('click', '.btn-remove-edit-row', function() {
        if ($('#edit-lokasi-container .lokasi-row').length > 1) {
            $(this).closest('.lokasi-row').remove();
            updateEditLokasiButtons();
        }
    });

    // Update Proyek Strategis
    $("#formEditProyek").submit(function(e) {
        e.preventDefault();
        
        console.log("Submitting edit form...");
        
        // Validasi form
        var isValid = true;
        
        if (!$("#EditIdProgramStrategis").val()) {
            alert('Program Strategis harus dipilih!');
            $("#EditIdProgramStrategis").focus();
            isValid = false;
        }
        
        if (!$("#EditNamaProyek").val()) {
            alert('Nama Proyek harus diisi!');
            $("#EditNamaProyek").focus();
            isValid = false;
        }
        
        if (!isValid) {
            return;
        }

        var formData = $(this).serialize();
        
        console.log("Edit Form Data:", formData);
        
        // Show loading
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
        
        $.post(BaseURL + "Kementerian/UpdateProyek", formData)
            .done(function(Respon) {
                console.log("Update Response:", Respon);
                if (Respon == '1') {
                    alert('Proyek Strategis berhasil diupdate!');
                    $('#ModalEditProyek').modal('hide');
                    window.location.reload();
                } else {
                    alert('Error: ' + Respon);
                }
            })
            .fail(function(xhr, status, error) {
                console.error("Update Error:", status, error);
                alert("Terjadi kesalahan saat mengupdate data. Silakan coba lagi.");
            })
            .always(function() {
                submitBtn.prop('disabled', false).html(originalText);
            });
    });

    // Delete Proyek Strategis
    $(document).on("click", ".Hapus", function() {
        if (confirm('Apakah Anda yakin ingin menghapus proyek ini?')) {
            var Proyek = { 
                Id: $(this).data('id') 
            };
            
            $.post(BaseURL + "Kementerian/DeleteProyek", Proyek)
                .done(function(Respon) {
                    if (Respon == '1') {
                        alert('Proyek berhasil dihapus!');
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                })
                .fail(function() {
                    alert("Terjadi kesalahan saat menghapus data");
                });
        }
    });

    // Handle Tambah/Edit Lokasi
    $(document).on('click', '.TambahLokasi', function() {
        var id = $(this).data('id');
        var provinsiIds = $(this).data('provinsi') || '';
        var kotaIds = $(this).data('kota') || '';
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        $('#LokasiId').val(id);
        $('#lokasi-table-container').empty();
        var provinsiData = <?= json_encode($Provinsi) ?>;

        // Add rows for existing locations or one empty row
        if (provinsiIds && kotaIds) {
            var provIds = String(provinsiIds).split(',');
            var kotaIdsArray = String(kotaIds).split(',');
            provIds.forEach(function(provId, index) {
                if (provId && provId !== 'null') {
                    var kotaId = kotaIdsArray[index] || '';
                    var newRow = `
                        <div class="form-group lokasi-row">
                            <div class="row">
                                <div class="col-md-5">
                                    <select class="form-control provinsi-select" name="KodeWilayah[]" data-selected-id="${provId}">
                                        <option value="">Pilih Provinsi (Opsional)</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <select class="form-control kota-select" name="KodeKota[]" data-selected-id="${kotaId}">
                                        <option value="">Pilih Kota/Kabupaten (Opsional)</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-danger btn-remove-row">
                                        <i class="notika-icon notika-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#lokasi-table-container').append(newRow);
                    var provSelect = $('#lokasi-table-container .provinsi-select').last();
                    var kotaSelect = $('#lokasi-table-container .kota-select').last();
                    populateProvinsi(provSelect, provinsiData, provId);
                    populateKota(provId, kotaSelect, kotaId);
                }
            });
        } else {
            var newRow = `
                <div class="form-group lokasi-row">
                    <div class="row">
                        <div class="col-md-5">
                            <select class="form-control provinsi-select" name="KodeWilayah[]">
                                <option value="">Pilih Provinsi (Opsional)</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control kota-select" name="KodeKota[]" disabled>
                                <option value="">Pilih Kota/Kabupaten (Opsional)</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-danger btn-remove-row">
                                <i class="notika-icon notika-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#lokasi-table-container').append(newRow);
            populateProvinsi($('#lokasi-table-container .provinsi-select').last(), provinsiData);
        }
        
        $('#ModalTambahLokasi').modal('show');
    });

    // Submit Form Tambah Lokasi
    // Submit Form Tambah Lokasi - PERBAIKAN
$("#FormTambahLokasi").submit(function(e) {
    e.preventDefault();
    
    console.log("Submitting lokasi form...");
    
    // Collect data manually untuk debugging
    var formData = $(this).serialize();
    console.log("Form Data:", formData);
    
    // Show loading
    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
    
    $.ajax({
        url: BaseURL + "Kementerian/UpdateLokasiForProyek",
        type: "POST",
        data: formData,
        dataType: "text",
        success: function(Respon) {
            console.log("Update Lokasi Response:", Respon);
            if (Respon == '1') {
                alert('Lokasi berhasil diupdate!');
                $('#ModalTambahLokasi').modal('hide');
                window.location.reload();
            } else {
                alert('Error: ' + Respon);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.error("Response Text:", xhr.responseText);
            alert('Gagal menghubungi server. Silakan coba lagi. Error: ' + error);
        },
        complete: function() {
            submitBtn.prop('disabled', false).html(originalText);
        }
    });
});

    // Handle Detail Lokasi
    $(document).on('click', '.DetailLokasi', function() {
        var id = $(this).data('id');
        var provinsiIds = $(this).data('provinsi') || '';
        var kotaIds = $(this).data('kota') || '';
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        if (provinsiIds || kotaIds) {
            $.post(BaseURL + "Kementerian/GetLokasiByIds", { 
                ProvinsiIds: provinsiIds,
                KotaIds: kotaIds,
                TahunMulai: TahunMulai,
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    var lokasiData = JSON.parse(data);
                    var listItems = '';
                    if (lokasiData && lokasiData.length > 0) {
                        $.each(lokasiData, function(index, item) {
                            listItems += '<li class="list-group-item">' + (item.Provinsi || '-') + ' - ' + (item.Kota || '-') + '</li>';
                        });
                    } else {
                        listItems = '<li class="list-group-item">Tidak ada data lokasi</li>';
                    }
                    $('#lokasi-detail-container .list-group').html(listItems);
                    $('#ModalDetailLokasi').modal('show');
                } catch(e) {
                    console.error("Error parsing Lokasi data:", e);
                    $('#lokasi-detail-container .list-group').html('<li class="list-group-item">Gagal memuat data</li>');
                    $('#ModalDetailLokasi').modal('show');
                }
            }).fail(function() {
                $('#lokasi-detail-container .list-group').html('<li class="list-group-item">Gagal menghubungi server</li>');
                $('#ModalDetailLokasi').modal('show');
            });
        } else {
            $('#lokasi-detail-container .list-group').html('<li class="list-group-item">Tidak ada data lokasi</li>');
            $('#ModalDetailLokasi').modal('show');
        }
    });
});
</script>