<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- NOTIFIKASI FLASH DATA -->
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php } ?>

                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php } ?>

                        <?php if ($this->session->flashdata('warning')) { ?>
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-warning"></i> <?= $this->session->flashdata('warning') ?>
                            </div>
                        <?php } ?>

                        <!-- FILTER PROVINSI & KAB/KOTA -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 15px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>"
                                                                <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="FilterWilayah">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                $wil = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wil = $wil ? html_escape($wil['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 15px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wil ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [3, 4])) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputKaryawan">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Pegawai</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Eselon</th>
                                        <th>Jabatan</th>
                                        <th>Satuan Unit Kerja</th>
                                        <th>Bidang / Sub / Kegiatan</th>
                                        <th>Dinas Terkait</th>
                                        <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [3, 4])) { ?>
                                            <th>Password</th>
                                            <th>Tahun Mulai</th>
                                            <th>Tahun Akhir</th>
                                            <th class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1;
                                    foreach ($Karyawan as $key) { ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align:middle;"><?= $No++ ?></td>
                                            <td style="vertical-align:middle;"><?= html_escape($key['nip']) ?></td>
                                            <td style="vertical-align:middle;"><?= html_escape($key['nama']) ?></td>
                                            <td style="vertical-align:middle;">
                                                <?php 
                                                    $eselon = $key['eselon'] ?? '';
                                                    echo !empty($eselon) ? html_escape($eselon) : '-';
                                                ?>
                                            </td>
                                            <td style="vertical-align:middle;"><?= html_escape($key['jabatan']) ?></td>
                                            <td style="vertical-align:middle;"><?= isset($key['satuan_unit_kerja']) && !empty($key['satuan_unit_kerja']) ? html_escape($key['satuan_unit_kerja']) : '-' ?></td>
                                            <td style="vertical-align:middle;"><?= isset($key['bidang_sub_koordinator']) && !empty($key['bidang_sub_koordinator']) ? html_escape($key['bidang_sub_koordinator']) : '-' ?></td>
                                            <td style="vertical-align:middle;"><?= isset($key['dinas_nama']) ? $key['dinas_nama'] : '-' ?></td>
                                            
                                            <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [3, 4])) { ?>
                                                <td style="vertical-align: middle; font-size: 11px; max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                                    <?= substr($key['password'], 0, 20) ?>...
                                                </td>
                                                <td style="vertical-align:middle;"><?= $key['tahun_mulai'] ?></td>
                                                <td style="vertical-align:middle;"><?= $key['tahun_akhir'] ?></td>
                                                <td class="text-center">
                                                    <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                        <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                                                            data-id="<?= $key['id'] ?>"
                                                            data-nip="<?= htmlspecialchars($key['nip'], ENT_QUOTES) ?>"
                                                            data-nama="<?= htmlspecialchars($key['nama'], ENT_QUOTES) ?>"
                                                            data-eselon="<?= htmlspecialchars($key['eselon'] ?? '', ENT_QUOTES) ?>"
                                                            data-jabatan="<?= htmlspecialchars($key['jabatan'], ENT_QUOTES) ?>"
                                                            data-satuan-unit-kerja="<?= htmlspecialchars($key['satuan_unit_kerja'] ?? '', ENT_QUOTES) ?>"
                                                            data-bidang-sub-koordinator="<?= htmlspecialchars($key['bidang_sub_koordinator'] ?? '', ENT_QUOTES) ?>"
                                                            data-tahun-mulai="<?= $key['tahun_mulai'] ?>"
                                                            data-tahun-akhir="<?= $key['tahun_akhir'] ?>"
                                                            data-dinas-ids="<?= isset($key['dinas_id']) ? htmlspecialchars($key['dinas_id'], ENT_QUOTES) : '' ?>">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-id="<?= $key['id'] ?>">
                                                            <i class="notika-icon notika-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            <?php } ?>
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

    <!-- ============================================================ -->
    <!-- MODAL INPUT KARYAWAN -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalInputKaryawan" role="dialog">
        <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Tambah Data Karyawan</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <!-- NIP -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>NIP</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="NIP" placeholder="Masukkan NIP">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Nama</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="Nama" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Eselon - INPUT MANUAL -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Eselon</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="Eselon" placeholder="Contoh: Eselon II, Eselon III, Non Eselon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Jabatan</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="Jabatan" placeholder="Masukkan Jabatan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Satuan Unit Kerja -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Satuan Unit Kerja</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="SatuanUnitKerja" placeholder="Contoh: Sub Bagian Perencanaan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bidang / Sub Kegiatan -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Bidang / Sub Kegiatan</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="BidangSubKoordinator" placeholder="Contoh: Bidang Pendidikan Dasar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Password</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="Password" placeholder="Masukkan Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dinas Terkait -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Dinas Terkait</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="dinasContainerAdd"></div>
                                        <button type="button" class="btn btn-info btn-sm" id="addDinasRowAdd">
                                            + Tambah Dinas
                                        </button>
                                        <div style="margin-top:6px; font-size:12px; color:#888;">
                                            * Wajib pilih minimal 1 dinas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun Mulai -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Mulai</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="TahunMulai" placeholder="Contoh: 2020">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun Akhir -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Akhir</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="TahunAkhir" placeholder="Contoh: 2025">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-8">
                                    <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- MODAL EDIT KARYAWAN -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalEditKaryawan" role="dialog">
        <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Edit Data Karyawan</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <input type="hidden" id="Id">

                        <!-- NIP -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>NIP</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_NIP" placeholder="Masukkan NIP">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Nama</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_Nama" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Eselon - INPUT MANUAL -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Eselon</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_Eselon" placeholder="Contoh: Eselon II, Eselon III, Non Eselon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Jabatan</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_Jabatan" placeholder="Masukkan Jabatan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Satuan Unit Kerja -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Satuan Unit Kerja</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_SatuanUnitKerja" placeholder="Contoh: Sub Bagian Perencanaan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bidang / Sub Kegiatan -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Bidang / Sub Kegiatan</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_BidangSubKoordinator" placeholder="Contoh: Bidang Pendidikan Dasar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Password</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_Password" placeholder="Kosongkan jika tidak diubah">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dinas Terkait -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Dinas Terkait</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="dinasContainerEdit"></div>
                                        <button type="button" class="btn btn-info btn-sm" id="addDinasRowEdit">
                                            + Tambah Dinas
                                        </button>
                                        <div style="margin-top:6px; font-size:12px; color:#888;">
                                            * Wajib pilih minimal 1 dinas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun Mulai -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Mulai</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_TahunMulai">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun Akhir -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Akhir</b> <span style="color:red;">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_TahunAkhir">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-8">
                                    <button class="btn btn-success notika-btn-success" id="Edit"><b>UPDATE</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- STYLE CUSTOM -->
<!-- ============================================================ -->
<style>
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
    .dinas-row {
        display: flex;
        gap: 8px;
        margin-bottom: 6px;
        align-items: center;
    }
    .dinas-row select {
        flex: 1;
    }
    @media (max-width:768px) {
        .filter-row {
            flex-direction: column;
            gap: 15px;
        }
        .filter-select {
            width: 100%;
        }
    }
    /* Alert styling */
    .alert {
        margin-bottom: 15px;
        border-radius: 4px;
        padding: 12px 20px;
    }
    .alert-success {
        background-color: #dff0d8;
        border-color: #d6e9c6;
        color: #3c763d;
    }
    .alert-danger {
        background-color: #f2dede;
        border-color: #ebccd1;
        color: #a94442;
    }
    .alert-warning {
        background-color: #fcf8e3;
        border-color: #faebcc;
        color: #8a6d3b;
    }
    .alert i {
        margin-right: 8px;
    }
    .fade.in {
        opacity: 1;
    }
</style>

<!-- ============================================================ -->
<!-- JAVASCRIPT -->
<!-- ============================================================ -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var DINAS_LIST = <?= json_encode($DaftarDinas) ?>;

    // ============================================================
    // FUNGSI BANTUAN DINAS
    // ============================================================
    function buildDinasSelect(nameAttr, selectedId) {
        var html = '<div class="dinas-row">';
        html += '<select class="form-control input-sm dinas-select" name="' + nameAttr + '[]" style="flex:1;">';
        html += '<option value="">-- Pilih Dinas --</option>';

        DINAS_LIST.forEach(function(d) {
            var sel = (selectedId && String(selectedId) === String(d.id)) ? 'selected' : '';
            var tahunInfo = (d.tahun_mulai && d.tahun_akhir) ? ' (' + d.tahun_mulai + '-' + d.tahun_akhir + ')' : '';
            html += '<option value="' + d.id + '" ' + sel + '>' + d.nama + tahunInfo + '</option>';
        });

        html += '</select>';
        html += '<button type="button" class="btn btn-danger btn-sm remove-dinas">Hapus</button>';
        html += '</div>';
        return html;
    }

    function initDinasContainer(containerId, nameAttr, selectedIds) {
        var $c = $('#' + containerId);
        $c.html('');
        if (!selectedIds || selectedIds.length === 0) {
            $c.append(buildDinasSelect(nameAttr, null));
        } else {
            selectedIds.forEach(function(id) {
                $c.append(buildDinasSelect(nameAttr, id));
            });
        }
    }

    function collectDinas(containerId) {
        var arr = [];
        $('#' + containerId + ' select.dinas-select').each(function() {
            var v = $(this).val();
            if (v) arr.push(v);
        });
        return arr.filter(function(v, i, a) {
            return a.indexOf(v) === i;
        });
    }

    // ============================================================
    // DOCUMENT READY
    // ============================================================
    jQuery(document).ready(function($) {
        var table = $('#data-table-basic').DataTable();

        // INIT DINAS CONTAINER
        initDinasContainer('dinasContainerAdd', 'dinas_id', []);
        initDinasContainer('dinasContainerEdit', 'dinas_id', []);

        // ============================================================
        // FILTER WILAYAH (jika belum login)
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
                    data: {
                        Kode: $(this).val(),
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    success: function(res) {
                        var Data = JSON.parse(res);
                        var html = '<option value="">Pilih Kab/Kota</option>';
                        Data.forEach(function(item) {
                            html += '<option value="' + item.Kode + '">' + item.Nama + '</option>';
                        });
                        $("#KabKota").html(html);
                    }
                });
            });

            $("#FilterWilayah").click(function() {
                var prov = $("#Provinsi").val();
                var kab = $("#KabKota").val();
                if (!prov) {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih Provinsi terlebih dahulu!');
                    return;
                }
                if (!kab) {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih Kab/Kota terlebih dahulu!');
                    return;
                }

                $.ajax({
                    url: BaseURL + "Daerah/SetTempKodeWilayah",
                    type: "POST",
                    data: {
                        KodeWilayah: kab,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    success: function(res) {
                        if (res === '1' || res === 'success') {
                            window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Wilayah berhasil dipilih!');
                        } else {
                            window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Gagal memilih wilayah!');
                        }
                    },
                    error: function() {
                        window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan saat memilih wilayah!');
                    }
                });
            });
        <?php } ?>

        // ============================================================
        // TAMBAH / HAPUS ROW DINAS
        // ============================================================
        $(document).on('click', '#addDinasRowAdd', function() {
            $('#dinasContainerAdd').append(buildDinasSelect('dinas_id', null));
        });

        $(document).on('click', '#addDinasRowEdit', function() {
            $('#dinasContainerEdit').append(buildDinasSelect('dinas_id', null));
        });

        $(document).on('click', '.remove-dinas', function() {
            $(this).closest('.dinas-row').remove();
        });

        // ============================================================
        // INPUT / SIMPAN - LANGSUNG RELOAD
        // ============================================================
        $("#Input").click(function() {
            var dinas = collectDinas('dinasContainerAdd');

            // Validasi
            if (!$("#NIP").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('NIP wajib diisi!');
                return;
            }
            if (!$("#Nama").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Nama wajib diisi!');
                return;
            }
            if (!$("#Jabatan").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Jabatan wajib diisi!');
                return;
            }
            if (!$("#Password").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Password wajib diisi!');
                return;
            }
            if (dinas.length < 1) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih minimal 1 dinas!');
                return;
            }
            if (!$("#TahunMulai").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Mulai wajib diisi!');
                return;
            }
            if (!$("#TahunAkhir").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Akhir wajib diisi!');
                return;
            }

            // Submit data
            $.post(BaseURL + "Daerah/InputKaryawan", {
                nip: $("#NIP").val(),
                nama: $("#Nama").val(),
                eselon: $("#Eselon").val(),
                jabatan: $("#Jabatan").val(),
                satuan_unit_kerja: $("#SatuanUnitKerja").val(),
                bidang_sub_koordinator: $("#BidangSubKoordinator").val(),
                password: $("#Password").val(),
                tahun_mulai: $("#TahunMulai").val(),
                tahun_akhir: $("#TahunAkhir").val(),
                dinas_id: dinas,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                if (res == '1') {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Data berhasil disimpan!');
                } else {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent(res || 'Gagal menyimpan data!');
                }
            }).fail(function() {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan pada server!');
            });
        });

        // ============================================================
        // EDIT - AMBIL DATA
        // ============================================================
        $(document).on("click", ".Edit", function() {
            $("#Id").val($(this).data('id'));
            $("#_NIP").val($(this).data('nip'));
            $("#_Nama").val($(this).data('nama'));
            $("#_Eselon").val($(this).data('eselon') || '');
            $("#_Jabatan").val($(this).data('jabatan'));
            $("#_SatuanUnitKerja").val($(this).data('satuan-unit-kerja') || '');
            $("#_BidangSubKoordinator").val($(this).data('bidang-sub-koordinator') || '');
            $("#_Password").val("");
            $("#_TahunMulai").val($(this).data('tahun-mulai'));
            $("#_TahunAkhir").val($(this).data('tahun-akhir'));

            var dinasIds = $(this).data('dinas-ids');
            var selected = dinasIds ? String(dinasIds).split(',').map(function(x) { return x.trim(); }).filter(Boolean) : [];
            initDinasContainer('dinasContainerEdit', 'dinas_id', selected);

            $('#ModalEditKaryawan').modal("show");
        });

        // ============================================================
        // UPDATE / EDIT - LANGSUNG RELOAD
        // ============================================================
        $("#Edit").click(function() {
            var dinas = collectDinas('dinasContainerEdit');

            // Validasi
            if (!$("#_NIP").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('NIP wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_Nama").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Nama wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_Jabatan").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Jabatan wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (dinas.length < 1) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih minimal 1 dinas!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_TahunMulai").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Mulai wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_TahunAkhir").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Akhir wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }

            // Submit data
            $.post(BaseURL + "Daerah/EditKaryawan", {
                id: $("#Id").val(),
                nip: $("#_NIP").val(),
                nama: $("#_Nama").val(),
                eselon: $("#_Eselon").val(),
                jabatan: $("#_Jabatan").val(),
                satuan_unit_kerja: $("#_SatuanUnitKerja").val(),
                bidang_sub_koordinator: $("#_BidangSubKoordinator").val(),
                password: $("#_Password").val(),
                tahun_mulai: $("#_TahunMulai").val(),
                tahun_akhir: $("#_TahunAkhir").val(),
                dinas_id: dinas,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                $('#ModalEditKaryawan').modal('hide');
                if (res == '1') {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Data berhasil diupdate!');
                } else {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent(res || 'Gagal update data!');
                }
            }).fail(function() {
                $('#ModalEditKaryawan').modal('hide');
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan pada server!');
            });
        });

        // ============================================================
        // HAPUS - LANGSUNG RELOAD
        // ============================================================
        $(document).on('click', '.Hapus', function() {
            var id = $(this).data('id');
            
            // Konfirmasi dengan modal confirm bawaan browser
            if (!confirm("Yakin ingin menghapus data ini?")) return;

            $.post(BaseURL + "Daerah/HapusKaryawan", {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                if (res == '1') {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Data berhasil dihapus!');
                } else {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent(res || 'Gagal menghapus data!');
                }
            }).fail(function() {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan pada server!');
            });
        });
    });
</script>