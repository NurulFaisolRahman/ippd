<!DOCTYPE html>
<html>
<head>
    <title>Visi RPJMD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load->view('Daerah/Cssumum'); ?>
</head>
<body>
    <?php $this->load->view('Daerah/sidebar'); ?>

    <style>
        /* Toast Notification */
        .toast-error {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            z-index: 99999;
            display: none;
            font-weight: 500;
            max-width: 450px;
            animation: slideIn 0.4s ease;
            font-size: 14px;
        }

        .toast-error.success {
            background: #4caf50;
            color: white;
        }

        .toast-error.error {
            background: #f44336;
            color: white;
        }

        .toast-error .close-btn {
            float: right;
            margin-left: 15px;
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            opacity: 0.8;
        }
        .toast-error .close-btn:hover {
            opacity: 1;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* CSS untuk Modal persis di tengah (Vertical Center) */
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

        /* CSS Table Enhancement - SEMUA RATA KIRI TANPA INDENTASI */
        #hierarki-table > thead > tr > th {
            background-color: #f8f9fa;
            color: #455a64;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e0e0e0;
            vertical-align: middle;
        }
        #hierarki-table > tbody > tr > td {
            vertical-align: middle;
            color: #444;
            border-top: 1px solid #f2f2f2;
        }
        
        /* SEMUA BARIS RATA KIRI TANPA INDENTASI */
        #hierarki-table > tbody > tr > td:nth-child(2) {
            padding-left: 15px !important;
            padding-right: 15px !important;
            text-align: left !important;
        }
        
        #hierarki-table > tbody > tr {
            transition: filter 0.2s ease;
        }
        #hierarki-table > tbody > tr:hover {
            filter: brightness(0.96);
        }

        .btn-action {
            border-radius: 5px;
            margin: 0 2px;
            transition: all 0.3s ease;
            padding: 5px 10px;
            font-weight: 600;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .btn-action:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .badge-periode {
            background-color: #00c292;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 194, 146, 0.3);
        }

        .badge-periode.level2 {
            background-color: #00bcd4;
            box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);
        }
        .badge-periode.level3 {
            background-color: #ff9800;
            box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);
        }
        .badge-periode.level4 {
            background-color: #9e9e9e;
            box-shadow: 0 2px 5px rgba(158, 158, 158, 0.3);
        }

        /* Filter Wilayah */
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

        /* Info Periode di Modal */
        .periode-info {
            background: #e8f5e9;
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            color: #2e7d32;
            font-weight: 600;
            border-left: 3px solid #4caf50;
        }

        /* Loading Spinner di Tombol */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
            display: inline-block;
            vertical-align: text-bottom;
            border: 0.2em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
        }
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }

        /* Gaya untuk konten teks yang bisa wrap - RATA KIRI SEMUA */
        .td-content-wrapper {
            display: block !important;
            padding: 6px 0;
        }
        
        .td-content-wrapper .text-content {
            display: block;
            word-wrap: break-word;
            word-break: break-word;
            line-height: 1.6;
            text-align: left !important;
        }
        
        .td-content-wrapper .text-content .label-text {
            display: inline;
        }
        
        .td-content-wrapper .text-content .label-text b {
            white-space: nowrap;
        }

        /* Warna latar belakang per level */
        .row-visi { background-color: #f1f8e9 !important; }
        .row-misi { background-color: #e0f7fa !important; }
        .row-tujuan { background-color: #fff3e0 !important; }
        .row-sasaran { background-color: #ffffff !important; }
        
        /* Border kiri per level */
        .border-visi { border-left: 4px solid #8bc34a !important; }
        .border-misi { border-left: 4px solid #00bcd4 !important; }
        .border-tujuan { border-left: 4px solid #ff9800 !important; }
        .border-sasaran { border-left: 4px solid #9e9e9e !important; }

        /* INDENTASI DINONAKTIFKAN - SEMUA RATA KIRI */
        .level-indent {
            display: none !important;
        }

        /* Baris yang bisa diklik */
        .clickable-row {
            cursor: pointer;
        }
        .clickable-row:hover {
            background-color: rgba(0,0,0,0.02);
        }
    </style>

    <!-- Toast Error -->
    <div class="toast-error error" id="toastError">
        <span class="close-btn" onclick="document.getElementById('toastError').classList.remove('show')">&times;</span>
        <span id="toastMessage">Error</span>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="data-table-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="data-table-list">
                            
                            <!-- FILTER UNTUK PENGGUNA YANG BELUM LOGIN -->
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

                            <!-- MENAMPILKAN WILAYAH DAN PERIODE SETELAH FILTER -->
                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php 
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                    if (empty($Visi)) {
                                        $pesan_error = "Tidak ada data untuk wilayah: $nama_wilayah";
                                    }
                                ?>
                                <div class="alert <?= empty($Visi) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                    <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                    <?php if (!empty($pesan_error)) { ?>
                                        <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <!-- HEADER TABEL -->
                            <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                                <div class="button-icon-btn sm-res-mg-t-30">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputVisi" style="padding: 8px 15px;">
                                        <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Visi RPJMD</b>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- TABEL HIERARKI - SEMUA RATA KIRI TANPA INDENTASI -->
                            <div class="table-responsive">
                                <table id="hierarki-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;" class="text-center">No</th>
                                            <th style="width: 55%;">Uraian (Visi / Misi / Tujuan / Sasaran)</th>
                                            <th style="width: 15%;" class="text-center">Periode</th>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width: 25%;" class="text-center">Aksi</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($Visi) && count($Visi) > 0) {
                                            $noVisi = 1;
                                            foreach ($Visi as $visi) { 
                                                $misiData = isset($visi['Misi']) ? $visi['Misi'] : [];
                                        ?>
                                            <!-- LEVEL 1: VISI - TAMPIL -->
                                            <tr data-id="visi-<?= $visi['Id'] ?>" data-parent="" data-expanded="false" class="row-visi">
                                                <td class="text-center" style="font-size: 14px;"><b><?= $noVisi ?></b></td>
                                                <td style="cursor: pointer; padding-left: 15px !important;" class="border-visi clickable-row" onclick="toggleLevel('visi-<?= $visi['Id'] ?>', this)">
                                                    <div class="td-content-wrapper">
                                                        <div class="text-content">
                                                            <span class="label-text"><b>VISI:</b> </span>
                                                            <?= html_escape($visi['Visi']) ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-periode"><?= $visi['TahunMulai'] . ' - ' . $visi['TahunAkhir'] ?></span>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-success TambahMisi btn-action" data-id="<?= $visi['Id'] ?>" title="Tambah Misi"><i class="fa fa-plus"></i> Misi</button>
                                                    <button class="btn btn-sm btn-warning EditVisi btn-action" data-id="<?= $visi['Id'] ?>" data-visi="<?= html_escape($visi['Visi']) ?>" data-awal="<?= $visi['TahunMulai'] ?>" data-akhir="<?= $visi['TahunAkhir'] ?>" title="Edit Visi"><i class="fa fa-edit"></i> </button>
                                                    <button class="btn btn-sm btn-danger HapusVisi btn-action" data-id="<?= $visi['Id'] ?>" title="Hapus Visi"><i class="fa fa-trash"></i> </button>
                                                </td>
                                                <?php } ?>
                                            </tr>

                                            <?php 
                                            if(!empty($misiData)) {
                                                $noMisi = 1;
                                                foreach ($misiData as $misi) { 
                                                    $tujuanData = isset($misi['Tujuan']) ? $misi['Tujuan'] : [];
                                            ?>
                                                <!-- LEVEL 2: MISI - DISEMBUNYIKAN -->
                                                <tr data-id="misi-<?= $misi['Id'] ?>" data-parent="visi-<?= $visi['Id'] ?>" data-expanded="false" style="display: none;" class="row-misi">
                                                    <td></td>
                                                    <td style="cursor: pointer; padding-left: 15px !important;" class="border-misi clickable-row" onclick="toggleLevel('misi-<?= $misi['Id'] ?>', this)">
                                                        <div class="td-content-wrapper">
                                                            <div class="text-content">
                                                                <span class="label-text"><b style="color: #00838f;">MISI <?= $noMisi ?>:</b> </span>
                                                                <?= html_escape($misi['Misi']) ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge-periode level2"><?= $misi['TahunMulai'] . ' - ' . $misi['TahunAkhir'] ?></span>
                                                    </td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-success TambahTujuan btn-action" data-id="<?= $misi['Id'] ?>" title="Tambah Tujuan"><i class="fa fa-plus"></i> Tujuan</button>
                                                        <button class="btn btn-sm btn-warning EditMisi btn-action" data-id="<?= $misi['Id'] ?>" data-idvisi="<?= $visi['Id'] ?>" data-misi="<?= html_escape($misi['Misi']) ?>" title="Edit Misi"><i class="fa fa-edit"></i> </button>
                                                        <button class="btn btn-sm btn-danger HapusMisi btn-action" data-id="<?= $misi['Id'] ?>" title="Hapus Misi"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                    <?php } ?>
                                                </tr>

                                                <?php 
                                                if(!empty($tujuanData)) {
                                                    $noTujuan = 1;
                                                    foreach ($tujuanData as $tujuan) { 
                                                        $sasaranData = isset($tujuan['Sasaran']) ? $tujuan['Sasaran'] : [];
                                                ?>
                                                    <!-- LEVEL 3: TUJUAN - DISEMBUNYIKAN -->
                                                    <tr data-id="tujuan-<?= $tujuan['Id'] ?>" data-parent="misi-<?= $misi['Id'] ?>" data-expanded="false" style="display: none;" class="row-tujuan">
                                                        <td></td>
                                                        <td style="cursor: pointer; padding-left: 15px !important;" class="border-tujuan clickable-row" onclick="toggleLevel('tujuan-<?= $tujuan['Id'] ?>', this)">
                                                            <div class="td-content-wrapper">
                                                                <div class="text-content">
                                                                    <span class="label-text"><b style="color: #ef6c00;">TUJUAN <?= $noMisi . '.' . $noTujuan ?>:</b> </span>
                                                                    <?= html_escape($tujuan['Tujuan']) ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge-periode level3"><?= $tujuan['TahunMulai'] . ' - ' . $tujuan['TahunAkhir'] ?></span>
                                                        </td>
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-success TambahSasaran btn-action" data-id="<?= $tujuan['Id'] ?>" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button>
                                                            <button class="btn btn-sm btn-warning EditTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" data-idmisi="<?= $misi['Id'] ?>" data-tujuan="<?= html_escape($tujuan['Tujuan']) ?>" title="Edit Tujuan"><i class="fa fa-edit"></i> </button>
                                                            <button class="btn btn-sm btn-danger HapusTujuan btn-action" data-id="<?= $tujuan['Id'] ?>" title="Hapus Tujuan"><i class="fa fa-trash"></i> </button>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>

                                                    <?php 
                                                    if(!empty($sasaranData)) {
                                                        $noSasaran = 1;
                                                        foreach ($sasaranData as $sasaran) { 
                                                    ?>
                                                        <!-- LEVEL 4: SASARAN - DISEMBUNYIKAN -->
                                                        <tr data-id="sasaran-<?= $sasaran['Id'] ?>" data-parent="tujuan-<?= $tujuan['Id'] ?>" data-expanded="false" style="display: none;" class="row-sasaran">
                                                            <td></td>
                                                            <td style="padding-left: 15px !important;" class="border-sasaran">
                                                                <div class="td-content-wrapper">
                                                                    <div class="text-content">
                                                                        <span class="label-text"><b style="color: #616161;">SASARAN <?= $noMisi . '.' . $noTujuan . '.' . $noSasaran ?>:</b> </span>
                                                                        <?= html_escape($sasaran['Sasaran']) ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge-periode level4"><?= $sasaran['TahunMulai'] . ' - ' . $sasaran['TahunAkhir'] ?></span>
                                                            </td>
                                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-warning EditSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" data-idtujuan="<?= $tujuan['Id'] ?>" data-sasaran="<?= html_escape($sasaran['Sasaran']) ?>" title="Edit Sasaran"><i class="fa fa-edit"></i> </button>
                                                                <button class="btn btn-sm btn-danger HapusSasaran btn-action" data-id="<?= $sasaran['Id'] ?>" title="Hapus Sasaran"><i class="fa fa-trash"></i> </button>
                                                            </td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php 
                                                            $noSasaran++;
                                                        } 
                                                    } 
                                                    ?>
                                                <?php 
                                                        $noTujuan++;
                                                    } 
                                                } 
                                                ?>
                                            <?php 
                                                    $noMisi++;
                                                } 
                                            } 
                                            ?>
                                        <?php 
                                                $noVisi++;
                                            } 
                                        } else { ?>
                                            <tr>
                                                <td colspan="4" class="text-center" style="padding: 30px; color: #999;">Belum ada data Visi RPJMD.</td>
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

    <!-- ============================================== -->
    <!-- MODAL INPUT VISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputVisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Visi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="TahunMulai" placeholder="Tahun Mulai (YYYY)">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="TahunAkhir" placeholder="Tahun Akhir (YYYY)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanVisi"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT VISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditVisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Visi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdVisiForm">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Visi" rows="3" style="resize: vertical;" placeholder="Uraian Visi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="_TahunMulai" placeholder="Tahun Mulai (YYYY)">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" class="form-control" id="_TahunAkhir" placeholder="Tahun Akhir (YYYY)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnVisi"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL INPUT MISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputMisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Misi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdVisiMisiForm">
                    <div class="periode-info" id="PeriodeMisiInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Visi yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanMisi"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT MISI -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditMisi" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Misi RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdMisiForm">
                    <input type="hidden" id="_IdVisi">
                    <div class="periode-info" id="EditPeriodeMisiInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Visi yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnMisi"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL INPUT TUJUAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputTujuan" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Tujuan RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdMisiTujuanForm">
                    <div class="periode-info" id="PeriodeTujuanInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Misi yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanTujuan"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT TUJUAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditTujuan" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Tujuan RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdTujuanForm">
                    <input type="hidden" id="_IdMisi">
                    <div class="periode-info" id="EditPeriodeTujuanInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Misi yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Tujuan" rows="3" style="resize: vertical;" placeholder="Uraian Tujuan RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnTujuan"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL INPUT SASARAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalInputSasaran" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Tambah Sasaran RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdTujuanSasaranForm">
                    <div class="periode-info" id="PeriodeSasaranInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Tujuan yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-success btn-action" id="SimpanSasaran"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MODAL EDIT SASARAN -->
    <!-- ============================================== -->
    <div class="modal fade" id="ModalEditSasaran" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Edit Sasaran RPJMD</h2>
                </div>
                <div class="modal-body" style="padding-top: 20px;">
                    <input type="hidden" id="IdSasaranForm">
                    <input type="hidden" id="_IdTujuan">
                    <div class="periode-info" id="EditPeriodeSasaranInfo">
                        <i class="fa fa-info-circle"></i> Periode akan diambil otomatis dari Tujuan yang dipilih
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int float-lb floating-lb">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <textarea class="form-control" id="_Sasaran" rows="3" style="resize: vertical;" placeholder="Uraian Sasaran RPJMD"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding-top: 15px;">
                    <button type="button" class="btn btn-info btn-action" id="EditBtnSasaran"><i class="fa fa-save"></i> Update</button>
                    <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- SCRIPTS -->
    <!-- ============================================== -->
    <script src="<?=base_url()?>js/vendor/jquery-1.12.4.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/wow.min.js"></script>
    <script src="<?=base_url()?>js/jquery-price-slider.js"></script>
    <script src="<?=base_url()?>js/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>js/jquery.scrollUp.min.js"></script>
    <script src="<?=base_url()?>js/meanmenu/jquery.meanmenu.js"></script>
    <script src="<?=base_url()?>js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?=base_url()?>js/data-table/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>js/data-table/data-table-act.js"></script>
    <script src="<?=base_url()?>js/main.js"></script>

    <script>
        var BaseURL = '<?=base_url()?>';
        var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
        var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

        // ==============================================
        // FUNGSI TOAST ERROR
        // ==============================================
        function showToast(message, type = 'error') {
            var toast = document.getElementById('toastError');
            var msgEl = document.getElementById('toastMessage');
            
            // Reset class
            toast.className = 'toast-error';
            if (type === 'success') {
                toast.classList.add('success');
            } else {
                toast.classList.add('error');
            }
            
            msgEl.innerHTML = message;
            toast.classList.add('show');
            
            // Auto hide after 5 seconds
            clearTimeout(window.toastTimeout);
            window.toastTimeout = setTimeout(function() {
                toast.classList.remove('show');
            }, 5000);
        }

        // ==============================================
        // FUNGSI TOGGLE HIERARKI
        // ==============================================
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
            sessionStorage.setItem('expandedRows', JSON.stringify(expanded));
        }

        // ==============================================
        // FILTER WILAYAH UNTUK PENGGUNA BELUM LOGIN
        // ==============================================
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
                        window.location.href = BaseURL + "Daerah/VisiRPJMD";
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

        // ==============================================
        // INIT - HANYA VISI YANG TAMPIL
        // ==============================================
        $(document).ready(function() {
            // Hapus session storage agar tidak mengembalikan state lama
            sessionStorage.removeItem('expandedRows');
            
            // SEMUA disembunyikan kecuali Visi
            // Visi: tampil (data-expanded="false" tapi tetap terlihat karena tidak ada style display:none)
            // Misi, Tujuan, Sasaran: disembunyikan (style="display: none;")
            
            // Visi tetap tampil (tanpa style display:none)
            document.querySelectorAll('#hierarki-table tbody tr.row-visi').forEach(function(tr) {
                tr.style.display = 'table-row';
                tr.setAttribute('data-expanded', 'false');
            });
            
            // Misi disembunyikan
            document.querySelectorAll('#hierarki-table tbody tr.row-misi').forEach(function(tr) {
                tr.style.display = 'none';
                tr.setAttribute('data-expanded', 'false');
            });
            
            // Tujuan disembunyikan
            document.querySelectorAll('#hierarki-table tbody tr.row-tujuan').forEach(function(tr) {
                tr.style.display = 'none';
                tr.setAttribute('data-expanded', 'false');
            });
            
            // Sasaran disembunyikan
            document.querySelectorAll('#hierarki-table tbody tr.row-sasaran').forEach(function(tr) {
                tr.style.display = 'none';
                tr.setAttribute('data-expanded', 'false');
            });

            // ==============================================
            // CRUD VISI - DENGAN RELOAD OTOMATIS
            // ==============================================
            $("#SimpanVisi").click(function() {
                if (isNaN($("#TahunMulai").val()) || $("#TahunMulai").val() == "" || $("#TahunMulai").val().length != 4) {
                    showToast('Tahun Mulai harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (isNaN($("#TahunAkhir").val()) || $("#TahunAkhir").val() == "" || $("#TahunAkhir").val().length != 4) {
                    showToast('Tahun Akhir harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (parseInt($("#TahunMulai").val()) >= parseInt($("#TahunAkhir").val())) {
                    showToast('Tahun Mulai harus lebih kecil dari Tahun Akhir!', 'error');
                    return;
                }
                if ($("#Visi").val() == "") {
                    showToast('Visi harus diisi!', 'error');
                    return;
                }
                
                var Visi = {
                    Visi: $("#Visi").val(),
                    TahunMulai: $("#TahunMulai").val(),
                    TahunAkhir: $("#TahunAkhir").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanVisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputVisiRPJMD", Visi, function(Respon) {
                    $("#SimpanVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalInputVisi').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#SimpanVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditVisi', function() {
                $("#IdVisiForm").val($(this).data('id'));
                $("#_Visi").val($(this).data('visi'));
                $("#_TahunMulai").val($(this).data('awal'));
                $("#_TahunAkhir").val($(this).data('akhir'));
                $('#ModalEditVisi').modal("show");
            });

            $("#EditBtnVisi").click(function() {
                if (isNaN($("#_TahunMulai").val()) || $("#_TahunMulai").val() == "" || $("#_TahunMulai").val().length != 4) {
                    showToast('Tahun Mulai harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (isNaN($("#_TahunAkhir").val()) || $("#_TahunAkhir").val() == "" || $("#_TahunAkhir").val().length != 4) {
                    showToast('Tahun Akhir harus diisi dengan format YYYY!', 'error');
                    return;
                }
                if (parseInt($("#_TahunMulai").val()) >= parseInt($("#_TahunAkhir").val())) {
                    showToast('Tahun Mulai harus lebih kecil dari Tahun Akhir!', 'error');
                    return;
                }
                if ($("#_Visi").val() == "") {
                    showToast('Visi harus diisi!', 'error');
                    return;
                }
                
                var Visi = {
                    Id: $("#IdVisiForm").val(),
                    Visi: $("#_Visi").val(),
                    TahunMulai: $("#_TahunMulai").val(),
                    TahunAkhir: $("#_TahunAkhir").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#EditBtnVisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditVisiRPJMD", Visi, function(Respon) {
                    $("#EditBtnVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalEditVisi').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#EditBtnVisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusVisi', function() {
                if (confirm("Yakin ingin menghapus Visi ini?")) {
                    var Visi = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusVisiRPJMD", Visi, function(Respon) {
                        var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (data.status === 'success') { 
                            showToast('✅ ' + data.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error: ' + data.message, 'error'); 
                        }
                    });
                }
            });

            // ==============================================
            // CRUD MISI - DENGAN RELOAD OTOMATIS
            // ==============================================

            $('#hierarki-table tbody').on('click', '.TambahMisi', function() {
                var parentRow = $(this).closest('tr')[0];
                if (parentRow.getAttribute('data-expanded') !== 'true') {
                    toggleLevel(parentRow.getAttribute('data-id'), parentRow);
                }
                
                var visiId = $(this).data('id');
                $('#IdVisiMisiForm').val(visiId);
                
                $.post(BaseURL + "Daerah/GetVisiRPJMD", {
                    Id: visiId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(respon) {
                    var data = JSON.parse(respon);
                    if (data.length > 0) {
                        var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                        $('#PeriodeMisiInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Visi)');
                    }
                });
                
                $('#Misi').val('');
                $('#ModalInputMisi').modal('show');
            });

            $("#SimpanMisi").click(function() {
                if ($("#Misi").val() == "") {
                    showToast('Misi harus diisi!', 'error');
                    return;
                }
                
                var Misi = {
                    _Id: $("#IdVisiMisiForm").val(),
                    Misi: $("#Misi").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanMisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputMisiRPJMD", Misi, function(Respon) {
                    $("#SimpanMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalInputMisi').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#SimpanMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditMisi', function() {
                $("#IdMisiForm").val($(this).data('id'));
                $("#_IdVisi").val($(this).data('idvisi'));
                $("#_Misi").val($(this).data('misi'));
                
                $.post(BaseURL + "Daerah/GetVisiRPJMD", {
                    Id: $(this).data('idvisi'),
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(respon) {
                    var data = JSON.parse(respon);
                    if (data.length > 0) {
                        var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                        $('#EditPeriodeMisiInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Visi)');
                    }
                });
                
                $('#ModalEditMisi').modal("show");
            });

            $("#EditBtnMisi").click(function() {
                if ($("#_Misi").val() == "") {
                    showToast('Misi harus diisi!', 'error');
                    return;
                }
                
                var Misi = {
                    Id: $("#IdMisiForm").val(),
                    _Id: $("#_IdVisi").val(),
                    Misi: $("#_Misi").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#EditBtnMisi").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditMisiRPJMD", Misi, function(Respon) {
                    $("#EditBtnMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalEditMisi').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#EditBtnMisi").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusMisi', function() {
                if (confirm("Yakin ingin menghapus Misi ini?")) {
                    var Misi = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusMisiRPJMD", Misi, function(Respon) {
                        var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (data.status === 'success') { 
                            showToast('✅ ' + data.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error: ' + data.message, 'error'); 
                        }
                    });
                }
            });

            // ==============================================
            // CRUD TUJUAN - DENGAN RELOAD OTOMATIS
            // ==============================================

            $('#hierarki-table tbody').on('click', '.TambahTujuan', function() {
                var parentRow = $(this).closest('tr')[0];
                if (parentRow.getAttribute('data-expanded') !== 'true') {
                    toggleLevel(parentRow.getAttribute('data-id'), parentRow);
                }
                
                var misiId = $(this).data('id');
                $('#IdMisiTujuanForm').val(misiId);
                
                $.post(BaseURL + "Daerah/GetMisiRPJMD", {
                    Id: misiId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(respon) {
                    var data = JSON.parse(respon);
                    if (data.length > 0) {
                        var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                        $('#PeriodeTujuanInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Misi)');
                    }
                });
                
                $('#Tujuan').val('');
                $('#ModalInputTujuan').modal('show');
            });

            $("#SimpanTujuan").click(function() {
                if ($("#Tujuan").val() == "") {
                    showToast('Tujuan harus diisi!', 'error');
                    return;
                }
                
                var Tujuan = {
                    _Id: $("#IdMisiTujuanForm").val(),
                    Tujuan: $("#Tujuan").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanTujuan").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputTujuanRPJMD", Tujuan, function(Respon) {
                    $("#SimpanTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalInputTujuan').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#SimpanTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditTujuan', function() {
                $("#IdTujuanForm").val($(this).data('id'));
                $("#_IdMisi").val($(this).data('idmisi'));
                $("#_Tujuan").val($(this).data('tujuan'));
                
                $.post(BaseURL + "Daerah/GetMisiRPJMD", {
                    Id: $(this).data('idmisi'),
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(respon) {
                    var data = JSON.parse(respon);
                    if (data.length > 0) {
                        var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                        $('#EditPeriodeTujuanInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Misi)');
                    }
                });
                
                $('#ModalEditTujuan').modal("show");
            });

            $("#EditBtnTujuan").click(function() {
                if ($("#_Tujuan").val() == "") {
                    showToast('Tujuan harus diisi!', 'error');
                    return;
                }
                
                var Tujuan = {
                    Id: $("#IdTujuanForm").val(),
                    _Id: $("#_IdMisi").val(),
                    Tujuan: $("#_Tujuan").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#EditBtnTujuan").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditTujuanRPJMD", Tujuan, function(Respon) {
                    $("#EditBtnTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalEditTujuan').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#EditBtnTujuan").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusTujuan', function() {
                if (confirm("Yakin ingin menghapus Tujuan ini?")) {
                    var Tujuan = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusTujuanRPJMD", Tujuan, function(Respon) {
                        var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (data.status === 'success') { 
                            showToast('✅ ' + data.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error: ' + data.message, 'error'); 
                        }
                    });
                }
            });

            // ==============================================
            // CRUD SASARAN - DENGAN RELOAD OTOMATIS
            // ==============================================

            $('#hierarki-table tbody').on('click', '.TambahSasaran', function() {
                var parentRow = $(this).closest('tr')[0];
                if (parentRow.getAttribute('data-expanded') !== 'true') {
                    toggleLevel(parentRow.getAttribute('data-id'), parentRow);
                }
                
                var tujuanId = $(this).data('id');
                $('#IdTujuanSasaranForm').val(tujuanId);
                
                $.post(BaseURL + "Daerah/GetTujuanRPJMD", {
                    Id: tujuanId,
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(respon) {
                    var data = JSON.parse(respon);
                    if (data.length > 0) {
                        var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                        $('#PeriodeSasaranInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Tujuan)');
                    }
                });
                
                $('#Sasaran').val('');
                $('#ModalInputSasaran').modal('show');
            });

            $("#SimpanSasaran").click(function() {
                if ($("#Sasaran").val() == "") {
                    showToast('Sasaran harus diisi!', 'error');
                    return;
                }
                
                var Sasaran = {
                    _Id: $("#IdTujuanSasaranForm").val(),
                    Sasaran: $("#Sasaran").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#SimpanSasaran").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/InputSasaranRPJMD", Sasaran, function(Respon) {
                    $("#SimpanSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalInputSasaran').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#SimpanSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.EditSasaran', function() {
                $("#IdSasaranForm").val($(this).data('id'));
                $("#_IdTujuan").val($(this).data('idtujuan'));
                $("#_Sasaran").val($(this).data('sasaran'));
                
                $.post(BaseURL + "Daerah/GetTujuanRPJMD", {
                    Id: $(this).data('idtujuan'),
                    [CSRF_NAME]: CSRF_TOKEN
                }, function(respon) {
                    var data = JSON.parse(respon);
                    if (data.length > 0) {
                        var periode = data[0].TahunMulai + ' - ' + data[0].TahunAkhir;
                        $('#EditPeriodeSasaranInfo').html('<i class="fa fa-info-circle"></i> Periode: <strong>' + periode + '</strong> (otomatis dari Tujuan)');
                    }
                });
                
                $('#ModalEditSasaran').modal("show");
            });

            $("#EditBtnSasaran").click(function() {
                if ($("#_Sasaran").val() == "") {
                    showToast('Sasaran harus diisi!', 'error');
                    return;
                }
                
                var Sasaran = {
                    Id: $("#IdSasaranForm").val(),
                    _Id: $("#_IdTujuan").val(),
                    Sasaran: $("#_Sasaran").val(),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $("#EditBtnSasaran").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                
                $.post(BaseURL + "Daerah/EditSasaranRPJMD", Sasaran, function(Respon) {
                    $("#EditBtnSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                    if (data.status === 'success') { 
                        $('#ModalEditSasaran').modal('hide');
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(function() { location.reload(); }, 600);
                    } else { 
                        showToast('❌ Error: ' + data.message, 'error'); 
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    $("#EditBtnSasaran").prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                    showToast('❌ AJAX Error: ' + textStatus, 'error');
                });
            });

            $('#hierarki-table tbody').on('click', '.HapusSasaran', function() {
                if (confirm("Yakin ingin menghapus Sasaran ini?")) {
                    var Sasaran = { Id: $(this).data('id'), [CSRF_NAME]: CSRF_TOKEN };
                    var btn = $(this);
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                    $.post(BaseURL + "Daerah/HapusSasaranRPJMD", Sasaran, function(Respon) {
                        var data = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                        if (data.status === 'success') { 
                            showToast('✅ ' + data.message, 'success');
                            setTimeout(function() { location.reload(); }, 600);
                        } else { 
                            btn.prop('disabled', false).html('<i class="fa fa-trash"></i> Hapus');
                            showToast('❌ Error: ' + data.message, 'error'); 
                        }
                    });
                }
            });

        });
    </script>

</body>
</html>