<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
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
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <?php 
                                        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                        $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                    ?>
                                    <div class="alert <?= empty($PermasalahanPokok) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                        <?php if (empty($PermasalahanPokok)) { ?>
                                            <strong>Peringatan:</strong> Tidak ada data untuk wilayah ini
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputPermasalahanPokok">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Permasalahan Pokok</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Permasalahan Pokok</th>
                                        <th>Kementerian</th>
                                        <th>Permasalahan Nasional</th>
                                        <th>Periode</th>
                                        <th class="text-center"><?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>Aksi<?php } ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($PermasalahanPokok as $key) { 
                                        // Parse ID Permasalahan Nasional
                                        $permIds = !empty($key['_Id']) ? explode('$', $key['_Id']) : array();
                                        // Buat ID unik untuk setiap baris
                                        $rowId = 'acc_' . $key['Id'] . '_' . $No;
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                        <td style="vertical-align: middle;"><?= html_escape($key['NamaPermasalahanPokok']) ?></td>
                                        <td style="vertical-align: middle;">
                                            <?php if (!empty($key['NamaKementerian'])): ?>
                                                <?php foreach (explode('; ', $key['NamaKementerian']) as $kem): ?>
                                                    <span class="badge badge-info" style="background-color:#17a2b8;color:#fff;padding:2px 8px;border-radius:12px;font-size:11px;display:inline-block;margin:1px;">
                                                        <?= html_escape($kem) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <!-- SOLUSI: Menggunakan toggle button sederhana -->
                                            <div class="permasalahan-wrapper">
                                                <button class="btn btn-sm btn-info toggle-permasalahan" data-target="#collapse_<?= $rowId ?>">
                                                    <span class="toggle-icon">▶</span> 
                                                    <?php if (!empty($permIds)): ?>
                                                        <?= count($permIds) ?> Permasalahan
                                                    <?php else: ?>
                                                        0 Permasalahan
                                                    <?php endif; ?>
                                                </button>
                                                <div id="collapse_<?= $rowId ?>" class="permasalahan-list" style="display:none; margin-top: 8px;">
                                                    <?php if (!empty($permIds)): ?>
                                                        <?php foreach ($permIds as $permId): ?>
                                                            <?php if (isset($Permasalahan[$permId])): ?>
                                                                <span class="badge badge-success" style="background-color:#28a745;color:#fff;padding:2px 8px;border-radius:12px;font-size:11px;display:inline-block;margin:2px;">
                                                                    <?= html_escape($Permasalahan[$permId]) ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted">Tidak ada permasalahan nasional</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                        <td class="text-center align-middle">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg EditPermasalahan" 
                                                        data-id="<?= $key['Id'] ?>" 
                                                        data-nama="<?= html_escape($key['NamaPermasalahanPokok']) ?>" 
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>" 
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        data-periode="<?= $key['TahunMulai'] . '-' . $key['TahunAkhir'] ?>"
                                                        data-permasalahan="<?= isset($key['_Id']) ? $key['_Id'] : '' ?>"
                                                        data-kementerian="<?= isset($key['IdKementerian']) ? $key['IdKementerian'] : '' ?>">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg HapusPermasalahan" data-id="<?= $key['Id'] ?>">
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

    <!-- ============================================================
    MODAL INPUT PERMASALAHAN POKOK
    ============================================================ -->
    <div class="modal fade" id="ModalInputPermasalahanPokok" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJMD">
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                <label class="hrzn-fm"><b>Nama Permasalahan</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="NamaPermasalahanPokok" placeholder="Masukkan Nama Permasalahan Pokok" style="color: #000;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode Nasional</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodePermasalahanPokokNasional" style="color: #000 !important;">
                                                        <option value="">-- Pilih Periode --</option>
                                                        <?php foreach ($PeriodePermasalahanPokokNasional as $key) { ?>
                                                            <option value="<?= $key['TahunMulai'] ?>">
                                                                <?= $key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                    <select class="form-control" id="Kementerian" style="color: #000 !important;">
                                                        <option value="">-- Pilih Kementerian --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Permasalahan Nasional</b></label>
                                    </div>
                                    <div style="margin-top: 3px;" class="col-lg-9">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="AccrodionPermasalahanNasional" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#AccrodionPermasalahanNasional" href="#PilihPermasalahanNasional" aria-expanded="true">Pilih Permasalahan</a></b>
                                                    </div>
                                                    <div id="PilihPermasalahanNasional" class="collapse in" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px;">
                                                            <div class="nk-int-st text-justify" id="ListPermasalahanNasional"></div>
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
                                            <button class="btn btn-success notika-btn-success" id="InputPermasalahanPokok"><b>SIMPAN</b></button>
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

    <!-- ============================================================
    MODAL EDIT PERMASALAHAN POKOK
    ============================================================ -->
    <div class="modal fade" id="ModalEditPermasalahanPokok" role="dialog">
        <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPeriodeRPJMD">
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                <label class="hrzn-fm"><b>Nama Permasalahan</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="hidden" id="EditId">
                                                    <input type="text" class="form-control input-sm" id="EditNamaPermasalahanPokok" style="color: #000;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode Nasional</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPeriodePermasalahanNasional" style="color: #000 !important;">
                                                        <option value="">-- Pilih Periode --</option>
                                                        <?php foreach ($PeriodePermasalahanPokokNasional as $key) { ?>
                                                            <option value="<?= $key['TahunMulai'] ?>">
                                                                <?= $key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                    <select class="form-control" id="EditKementerian" style="color: #000 !important;">
                                                        <option value="">-- Pilih Kementerian --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Permasalahan Nasional</b></label>
                                    </div>
                                    <div style="margin-top: 3px;" class="col-lg-9">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="EditAccrodionPermasalahanNasional" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#EditAccrodionPermasalahanNasional" href="#EditPilihPermasalahanNasional" aria-expanded="true">Pilih Permasalahan</a></b>
                                                    </div>
                                                    <div id="EditPilihPermasalahanNasional" class="collapse in" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px;">
                                                            <div class="nk-int-st text-justify" id="EditListPermasalahanNasional"></div>
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
                                            <button class="btn btn-success notika-btn-success" id="UpdatePermasalahanPokok"><b>UPDATE</b></button>
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

    <style>
        .form-control, .form-control option {
            color: #000 !important;
        }
        .modal-content {
            color: #000;
        }
        .badge-info {
            background-color: #17a2b8 !important;
        }
        .badge-success {
            background-color: #28a745 !important;
        }
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-left: 10px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
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
        /* Loading spinner untuk tombol */
        .spinner-border-sm {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
            vertical-align: middle;
            margin-right: 5px;
        }
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }
        /* Modal large */
        .modal-large {
            width: 70%;
            max-width: 800px;
        }
        @media (max-width: 768px) {
            .modal-large {
                width: 95%;
            }
        }
        
        /* STYLE UNTUK TOGGLE PERMASALAHAN */
        .toggle-permasalahan {
            background-color: #f5f7f8;
            color: #000000;
            border: none;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .toggle-permasalahan:hover {
            background-color: #138496;
            color: #fff;
        }
        .toggle-permasalahan .toggle-icon {
            display: inline-block;
            transition: transform 0.3s ease;
            margin-right: 3px;
        }
        .toggle-permasalahan.active .toggle-icon {
            transform: rotate(90deg);
        }
        .permasalahan-list {
            background-color: #f8f9fa;
            padding: 8px 10px;
            border-radius: 4px;
            border-left: 3px solid #17a2b8;
        }
    </style>

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
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

    jQuery(document).ready(function($) {

        // ============================================================
        // SOLUSI: Toggle Permasalahan dengan button sederhana
        // ============================================================
        $(document).on('click', '.toggle-permasalahan', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var target = $(this).data('target');
            var $list = $(target);
            
            if ($list.length) {
                $list.slideToggle(300);
                $(this).toggleClass('active');
            }
        });

        // ============================================================
        // FUNGSI BANTUAN
        // ============================================================

        function getCsrfData() {
            var data = {};
            data[CSRF_TOKEN_NAME] = CSRF_TOKEN_VALUE;
            return data;
        }

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
                    data: { Kode: $(this).val(), [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                    beforeSend: function() { $("#KabKota").prop('disabled', true); },
                    success: function(Respon) {
                        try {
                            var Data = JSON.parse(Respon);
                            var KabKota = '<option value="">Pilih Kab/Kota</option>';
                            if (Data.length > 0) {
                                for (let i = 0; i < Data.length; i++) {
                                    KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                                }
                            } else {
                                alert("Belum Ada Data Kab/Kota");
                            }
                            $("#KabKota").html(KabKota).prop('disabled', false);
                        } catch (e) {
                            alert("Gagal memuat data Kab/Kota");
                            $("#KabKota").prop('disabled', false);
                        }
                    },
                    error: function() {
                        alert("Gagal memuat data Kab/Kota");
                        $("#KabKota").prop('disabled', false);
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
                $.ajax({
                    url: BaseURL + "Daerah/SetTempKodeWilayah",
                    type: "POST",
                    data: { KodeWilayah: kodeWilayah, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                    beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                    success: function(Respon) {
                        try {
                            if (Respon === 'success' || Respon.trim() === 'success') {
                                window.location.href = BaseURL + "Daerah/PermasalahanPokok";
                            } else {
                                alert(Respon || "Gagal menyimpan filter wilayah!");
                                $("#Filter").prop('disabled', false).text('Filter');
                            }
                        } catch (e) {
                            alert("Gagal memproses respons server!");
                            $("#Filter").prop('disabled', false).text('Filter');
                        }
                    },
                    error: function() {
                        alert("Gagal menghubungi server!");
                        $("#Filter").prop('disabled', false).text('Filter');
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
                    data: { Kode: kodeProv, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                    success: function(Respon) {
                        try {
                            var Data = JSON.parse(Respon);
                            var KabKota = '<option value="">Pilih Kab/Kota</option>';
                            if (Data.length > 0) {
                                for (let i = 0; i < Data.length; i++) {
                                    var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                                    KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                                }
                            }
                            $("#KabKota").html(KabKota);
                        } catch (e) {
                            alert("Gagal memuat data Kab/Kota");
                        }
                    },
                    error: function() {
                        alert("Gagal memuat data Kab/Kota");
                    }
                });
            <?php } ?>
        <?php } ?>

        // ============================================================
        // LOAD KEMENTERIAN UNTUK INPUT
        // ============================================================
        $("#PeriodePermasalahanPokokNasional").change(function() {
            var tahunMulai = $(this).val();
            if (tahunMulai == "") {
                $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>');
                $("#ListPermasalahanNasional").html('');
                return;
            }
            
            $.ajax({
                url: BaseURL + "Daerah/GetKementerian",
                type: "POST",
                data: { 
                    TahunMulai: tahunMulai,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                },
                beforeSend: function() {
                    $("#Kementerian").html('<option value="">Memuat...</option>').prop('disabled', true);
                },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var Kementerian = '<option value="">-- Pilih Kementerian --</option>';
                        for (var i = 0; i < Data.length; i++) {
                            Kementerian += '<option value="'+Data[i].Id+'">'+Data[i].NamaKementerian+'</option>';
                        }
                        $("#Kementerian").html(Kementerian).prop('disabled', false);
                    } catch(e) {
                        alert("Gagal memuat data kementerian");
                        $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                    }
                },
                error: function() {
                    alert("Gagal memuat data kementerian");
                    $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                }
            });
        });

        // ============================================================
        // LOAD PERMASALAHAN NASIONAL UNTUK INPUT
        // ============================================================
        $("#Kementerian").change(function() {
            var idKementerian = $(this).val();
            if (idKementerian == "") {
                $("#ListPermasalahanNasional").html('');
                return;
            }
            
            $.ajax({
                url: BaseURL + "Daerah/GetPermasalahanPokokNasional",
                type: "POST",
                data: { 
                    Id: idKementerian,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                },
                beforeSend: function() {
                    $("#ListPermasalahanNasional").html('<div class="text-center"><span class="loading"></span> Memuat...</div>');
                },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var Permasalahan = '';
                        if (Data.length > 0) {
                            for (var i = 0; i < Data.length; i++) {
                                Permasalahan += '<label style="display:block;margin:5px 0;">';
                                Permasalahan += '<input type="checkbox" name="Permasalahan" value="'+Data[i].Id+'"> ';
                                Permasalahan += Data[i].NamaPermasalahanPokok;
                                Permasalahan += '</label>';
                            }
                        } else {
                            Permasalahan = '<span class="text-muted">Tidak ada permasalahan untuk kementerian ini</span>';
                        }
                        $("#ListPermasalahanNasional").html(Permasalahan);
                    } catch(e) {
                        alert("Gagal memuat data permasalahan");
                        $("#ListPermasalahanNasional").html('');
                    }
                },
                error: function() {
                    alert("Gagal memuat data permasalahan");
                    $("#ListPermasalahanNasional").html('');
                }
            });
        });

        // ============================================================
        // INPUT PERMASALAHAN POKOK
        // ============================================================
        $("#InputPermasalahanPokok").click(function() {
            var PermasalahanNasional = [];
            $("input[name='Permasalahan']:checked").each(function() {
                PermasalahanNasional.push($(this).val());
            });
            
            // Validasi
            if ($("#PeriodeRPJMD").val() === "") {
                alert('Pilih Periode RPJMD terlebih dahulu!');
                return;
            }
            if ($("#NamaPermasalahanPokok").val().trim() === "") {
                alert('Nama Permasalahan Pokok harus diisi!');
                return;
            }
            if (PermasalahanNasional.length === 0) {
                alert("Pilih minimal satu Permasalahan Nasional!");
                return;
            }
            
            var Data = {
                PeriodeRPJMD: $("#PeriodeRPJMD").val(),
                NamaPermasalahanPokok: $("#NamaPermasalahanPokok").val().trim(),
                _Id: PermasalahanNasional.join("$"),
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            };
            
            $.ajax({
                url: BaseURL + "Daerah/InputPermasalahanPokok",
                type: "POST",
                data: Data,
                beforeSend: function() {
                    $("#InputPermasalahanPokok").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
                },
                success: function(Respon) {
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') {
                            alert('✓ ' + result.message);
                            $('#ModalInputPermasalahanPokok').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            alert('✗ ' + result.message);
                        }
                    } catch(e) {
                        if (Respon === '1' || Respon.trim() === '1') {
                            alert('✓ Data berhasil disimpan!');
                            $('#ModalInputPermasalahanPokok').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            alert('✗ ' + Respon);
                        }
                    }
                    $("#InputPermasalahanPokok").prop('disabled', false).html('<b>SIMPAN</b>');
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.statusText);
                    $("#InputPermasalahanPokok").prop('disabled', false).html('<b>SIMPAN</b>');
                }
            });
        });

        // ============================================================
        // LOAD DATA UNTUK EDIT
        // ============================================================
        $(document).on("click", ".EditPermasalahan", function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var periode = $(this).data('periode');
            var permasalahan = $(this).data('permasalahan');
            var kementerianIds = $(this).data('kementerian');
            
            if (kementerianIds === undefined || kementerianIds === null) {
                kementerianIds = '';
            } else {
                kementerianIds = String(kementerianIds);
            }
            
            if (permasalahan === undefined || permasalahan === null) {
                permasalahan = '';
            } else {
                permasalahan = String(permasalahan);
            }
            
            // Set basic form values
            $("#EditId").val(id);
            $("#EditNamaPermasalahanPokok").val(nama);
            $("#EditPeriodeRPJMD").val(periode);
            
            // Reset dropdowns
            $("#EditPeriodePermasalahanNasional").val('');
            $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $("#EditListPermasalahanNasional").html('');
            
            // Remove hidden fields lama
            $("#EditPermasalahanData").remove();
            $("#EditKementerianIdsData").remove();
            
            // Store data untuk restore
            $('<input>').attr({
                type: 'hidden',
                id: 'EditPermasalahanData',
                value: permasalahan
            }).appendTo('body');
            
            $('<input>').attr({
                type: 'hidden',
                id: 'EditKementerianIdsData',
                value: kementerianIds
            }).appendTo('body');
            
            if (kementerianIds && kementerianIds !== '' && kementerianIds !== 'null' && kementerianIds !== 'undefined') {
                
                var kemIds = kementerianIds.split(',');
                var firstKemId = kemIds.length > 0 ? kemIds[0].trim() : '';
                
                if (firstKemId && firstKemId !== '' && firstKemId !== 'null') {
                    
                    $.ajax({
                        url: BaseURL + "Daerah/GetPeriodePermasalahanPokokNasional",
                        type: "POST",
                        data: { 
                            Id: firstKemId,
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                        },
                        beforeSend: function() {
                            $("#EditKementerian").html('<option value="">Memuat...</option>').prop('disabled', true);
                            $("#EditListPermasalahanNasional").html('<div class="text-center"><span class="loading"></span> Memuat data...</div>');
                        },
                        success: function(Respon) {
                            try {
                                var Data = JSON.parse(Respon);
                                
                                if (!Data || Data.length === 0) {
                                    $.ajax({
                                        url: BaseURL + "Daerah/GetKementerianById",
                                        type: "POST",
                                        data: { 
                                            Id: firstKemId,
                                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                                        },
                                        success: function(KemRespon) {
                                            try {
                                                var KemData = JSON.parse(KemRespon);
                                                if (KemData && KemData.length > 0) {
                                                    var periodeNasional = KemData[0].TahunMulai;
                                                    $("#EditPeriodePermasalahanNasional").val(periodeNasional);
                                                    loadKementerianForEdit(periodeNasional, firstKemId, permasalahan);
                                                } else {
                                                    $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                                                    $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih periode nasional terlebih dahulu</span>');
                                                    alert('Data kementerian tidak ditemukan! Silakan pilih periode nasional secara manual.');
                                                }
                                            } catch(e) {
                                                console.error('Error:', e);
                                                $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                                                $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih periode nasional terlebih dahulu</span>');
                                            }
                                        },
                                        error: function() {
                                            $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                                            $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih periode nasional terlebih dahulu</span>');
                                        }
                                    });
                                    return;
                                }
                                
                                if (Data && Data.length > 0) {
                                    var periodeNasional = Data[0].TahunMulai;
                                    $("#EditPeriodePermasalahanNasional").val(periodeNasional);
                                    loadKementerianForEdit(periodeNasional, firstKemId, permasalahan);
                                }
                                
                            } catch(e) {
                                console.error('Error parsing periode:', e);
                                $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                                $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih periode nasional terlebih dahulu</span>');
                            }
                        },
                        error: function() {
                            $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                            $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih periode nasional terlebih dahulu</span>');
                        }
                    });
                } else {
                    $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih periode nasional dan kementerian terlebih dahulu</span>');
                    $("#EditKementerian").prop('disabled', false);
                }
            } else {
                $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih periode nasional dan kementerian terlebih dahulu</span>');
                $("#EditKementerian").prop('disabled', false);
            }
            
            $('#ModalEditPermasalahanPokok').modal("show");
        });

        // ============================================================
        // FUNGSI BANTUAN: Load Kementerian untuk Edit
        // ============================================================
        function loadKementerianForEdit(periodeNasional, selectedKemId, permasalahan) {
            $.ajax({
                url: BaseURL + "Daerah/GetKementerian",
                type: "POST",
                data: { 
                    TahunMulai: periodeNasional,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                },
                success: function(ResponKementerian) {
                    try {
                        var DataKem = JSON.parse(ResponKementerian);
                        var Kementerian = '<option value="">-- Pilih Kementerian --</option>';
                        var selectedKem = '';
                        
                        for (var i = 0; i < DataKem.length; i++) {
                            var isSelected = (String(DataKem[i].Id) === String(selectedKemId));
                            if (isSelected) {
                                selectedKem = DataKem[i].Id;
                            }
                            Kementerian += '<option value="'+DataKem[i].Id+'" ' + (isSelected ? 'selected' : '') + '>'+DataKem[i].NamaKementerian+'</option>';
                        }
                        $("#EditKementerian").html(Kementerian).prop('disabled', false);
                        
                        if (selectedKem) {
                            loadPermasalahanForEdit(selectedKem, permasalahan);
                        } else {
                            $("#EditListPermasalahanNasional").html('<span class="text-muted">Pilih kementerian terlebih dahulu</span>');
                            $("#EditKementerian").prop('disabled', false);
                        }
                    } catch(e) {
                        console.error('Error loading kementerian:', e);
                        $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                        $("#EditListPermasalahanNasional").html('<span class="text-danger">Gagal memuat data</span>');
                    }
                },
                error: function() {
                    $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>').prop('disabled', false);
                    $("#EditListPermasalahanNasional").html('<span class="text-danger">Gagal memuat data</span>');
                }
            });
        }

        // ============================================================
        // FUNGSI BANTUAN: Load Permasalahan untuk Edit
        // ============================================================
        function loadPermasalahanForEdit(idKementerian, permasalahan) {
            $.ajax({
                url: BaseURL + "Daerah/GetPermasalahanPokokNasional",
                type: "POST",
                data: { 
                    Id: idKementerian,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                },
                success: function(ResponPermasalahan) {
                    try {
                        var DataPerm = JSON.parse(ResponPermasalahan);
                        var selectedPermasalahan = permasalahan ? permasalahan.split("$") : [];
                        var PermasalahanHTML = '';
                        
                        if (DataPerm.length > 0) {
                            for (var i = 0; i < DataPerm.length; i++) {
                                var checked = selectedPermasalahan.includes(String(DataPerm[i].Id)) ? 'checked' : '';
                                PermasalahanHTML += '<label style="display:block;margin:5px 0;">';
                                PermasalahanHTML += '<input type="checkbox" name="EditPermasalahan" value="'+DataPerm[i].Id+'" '+checked+'> ';
                                PermasalahanHTML += DataPerm[i].NamaPermasalahanPokok;
                                PermasalahanHTML += '</label>';
                            }
                        } else {
                            PermasalahanHTML = '<span class="text-muted">Tidak ada permasalahan untuk kementerian ini</span>';
                        }
                        $("#EditListPermasalahanNasional").html(PermasalahanHTML);
                        $("#EditKementerian").prop('disabled', false);
                    } catch(e) {
                        console.error('Error loading permasalahan:', e);
                        $("#EditListPermasalahanNasional").html('<span class="text-danger">Gagal memuat data</span>');
                        $("#EditKementerian").prop('disabled', false);
                    }
                },
                error: function() {
                    $("#EditListPermasalahanNasional").html('<span class="text-danger">Gagal memuat data</span>');
                    $("#EditKementerian").prop('disabled', false);
                }
            });
        }

        // ============================================================
        // UPDATE PERMASALAHAN POKOK
        // ============================================================
        $("#UpdatePermasalahanPokok").click(function() {
            var PermasalahanNasional = [];
            $("input[name='EditPermasalahan']:checked").each(function() {
                PermasalahanNasional.push($(this).val());
            });
            
            // Validasi
            if ($("#EditPeriodeRPJMD").val() === "") {
                alert('Pilih Periode RPJMD terlebih dahulu!');
                return;
            }
            if ($("#EditNamaPermasalahanPokok").val().trim() === "") {
                alert('Nama Permasalahan Pokok harus diisi!');
                return;
            }
            if (PermasalahanNasional.length === 0) {
                alert("Pilih minimal satu Permasalahan Nasional!");
                return;
            }
            
            var Data = {
                Id: $("#EditId").val(),
                EditPeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
                NamaPermasalahanPokok: $("#EditNamaPermasalahanPokok").val().trim(),
                _Id: PermasalahanNasional.join("$"),
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            };
            
            $.ajax({
                url: BaseURL + "Daerah/UpdatePermasalahanPokok",
                type: "POST",
                data: Data,
                beforeSend: function() {
                    $("#UpdatePermasalahanPokok").prop('disabled', true).html('<span class="spinner-border-sm"></span> Menyimpan...');
                },
                success: function(Respon) {
                    try {
                        var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (result.status === 'success') {
                            alert('✓ ' + result.message);
                            $('#ModalEditPermasalahanPokok').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            alert('✗ ' + result.message);
                        }
                    } catch(e) {
                        if (Respon === '1' || Respon.trim() === '1') {
                            alert('✓ Data berhasil diupdate!');
                            $('#ModalEditPermasalahanPokok').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            alert('✗ ' + Respon);
                        }
                    }
                    $("#UpdatePermasalahanPokok").prop('disabled', false).html('<b>UPDATE</b>');
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.statusText);
                    $("#UpdatePermasalahanPokok").prop('disabled', false).html('<b>UPDATE</b>');
                }
            });
        });

        // ============================================================
        // HAPUS PERMASALAHAN POKOK
        // ============================================================
        $(document).on("click", ".HapusPermasalahan", function() {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var id = $(this).data('id');
                var btn = $(this);
                
                $.ajax({
                    url: BaseURL + "Daerah/DeletePermasalahanPokok",
                    type: "POST",
                    data: { 
                        Id: id,
                        [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                    },
                    beforeSend: function() {
                        btn.prop('disabled', true).html('<span class="spinner-border-sm"></span>');
                    },
                    success: function(Respon) {
                        try {
                            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                            if (result.status === 'success') {
                                alert('✓ ' + result.message);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                alert('✗ ' + result.message);
                            }
                        } catch(e) {
                            if (Respon === '1' || Respon.trim() === '1') {
                                alert('✓ Data berhasil dihapus!');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                alert('✗ ' + Respon);
                            }
                        }
                        btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.statusText);
                        btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
                    }
                });
            }
        });

        // ============================================================
        // RESET FORM SAAT MODAL DITUTUP
        // ============================================================
        $('#ModalInputPermasalahanPokok').on('hidden.bs.modal', function() {
            $("#PeriodeRPJMD").val('');
            $("#NamaPermasalahanPokok").val('');
            $("#PeriodePermasalahanPokokNasional").val('');
            $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $("#ListPermasalahanNasional").html('');
            $("#InputPermasalahanPokok").prop('disabled', false).html('<b>SIMPAN</b>');
        });

        $('#ModalEditPermasalahanPokok').on('hidden.bs.modal', function() {
            $("#EditPeriodeRPJMD").val('');
            $("#EditNamaPermasalahanPokok").val('');
            $("#EditPeriodePermasalahanNasional").val('');
            $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $("#EditListPermasalahanNasional").html('');
            $("#EditPermasalahanData").remove();
            $("#EditKementerianIdsData").remove();
            $("#UpdatePermasalahanPokok").prop('disabled', false).html('<b>UPDATE</b>');
        });

        // ============================================================
        // CLEAN MODAL BACKDROP
        // ============================================================
        $(document).on("hidden.bs.modal", ".modal", function() {
            $(".modal-backdrop").remove();
            $("body").removeClass("modal-open");
        });

        // ============================================================
        // SET TAHUN SAAT PERIODE DIPILIH
        // ============================================================
        $("#PeriodeRPJMD").change(function() {
            if ($(this).val()) {
                var years = $(this).val().split('-');
                $("#TahunMulai").val(years[0]);
                $("#TahunAkhir").val(years[1]);
            }
        });

        $("#EditPeriodeRPJMD").change(function() {
            if ($(this).val()) {
                var years = $(this).val().split('-');
                $("#EditTahunMulai").val(years[0]);
                $("#EditTahunAkhir").val(years[1]);
            }
        });

    });
    </script>
</div>