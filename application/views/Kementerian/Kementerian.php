<?php $this->load->view('Kementerian/Sidebar'); ?>
<div class="main-content">

<?php 
// Proteksi & Deteksi Level Pengguna yang Konsisten
$isLoggedInVal = isset($isLoggedIn) ? (bool)$isLoggedIn : (bool)($this->session->userdata('isLoggedIn') ?? ($_SESSION['isLoggedIn'] ?? false));
$rawLevel      = isset($userLevel) ? $userLevel : ($this->session->userdata('userLevel') ?? ($this->session->userdata('Level') ?? ($_SESSION['userLevel'] ?? ($_SESSION['Level'] ?? null))));
$userLevelNum  = ($isLoggedInVal && $rawLevel !== null && $rawLevel !== '') ? (int)$rawLevel : (isset($_SESSION['Level']) ? (int)$_SESSION['Level'] : null);
$isSuperAdmin  = ($userLevelNum === 0);
$isKementerian = ($userLevelNum === 1);
?>

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
                            <a href="<?= base_url('Kementerian/Kementerian') ?>">Kementerian</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block;">
                            <span class="bread-blk">Daftar Kementerian</span>
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

                    <?php if ($isKementerian || !empty($UserKementerianName)): ?>
                    <div class="alert alert-info" style="margin-bottom: 15px;">
                        <i class="notika-icon notika-info"></i>
                        <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName ?? ($_SESSION['NamaKementerian'] ?? '-')) ?><br>
                        <b>Periode :</b> <?= htmlspecialchars($UserPeriode ?? (($_SESSION['TahunMulai'] ?? '-') . ' - ' . ($_SESSION['TahunAkhir'] ?? '-'))) ?>
                    </div>
                    <?php endif; ?>

                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <?php if (!$isKementerian): ?>
                            <button type="button" class="btn btn-primary notika-btn-primary" data-toggle="modal" data-target="#ModalFilterKementerian">
                                <i class="notika-icon notika-search"></i> 
                                <b>Filter Data</b>
                                <?php if (!empty($CurrentPeriode)): ?>
                                    <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                <?php endif; ?>
                            </button>
                            <?php endif; ?>

                            <?php if ($isSuperAdmin): ?>
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputKementerian">
                                <i class="notika-icon notika-edit"></i> <b>Input Kementerian Baru</b>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (!$isKementerian): ?>
                    <!-- Modal Filter Periode -->
                    <div class="modal fade" id="ModalFilterKementerian" role="dialog">
                        <div class="modal-dialog modals-default">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Filter Data Kementerian</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-example-wrap">
                                        <div class="form-example-int">
                                            <div class="form-group">
                                                <label><b>Periode Perencanaan</b></label>
                                                <select class="form-control" id="FilterPeriodeSelect">
                                                    <option value="">Semua Periode</option>
                                                    <?php if (!empty($AllPeriode)): ?>
                                                        <?php foreach ($AllPeriode as $periode): ?>
                                                            <?php 
                                                                $periodeVal = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                                $selected = (!empty($CurrentPeriode) && $CurrentPeriode === $periodeVal) ? 'selected' : '';
                                                            ?>
                                                            <option value="<?= $periodeVal ?>" <?= $selected ?>>
                                                                <?= $periode['TahunMulai'] ?> - <?= $periode['TahunAkhir'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-example-int mg-t-15">
                                            <button type="button" class="btn btn-success notika-btn-success" id="ApplyFilterKemen">Terapkan Filter</button>
                                            <button type="button" class="btn btn-danger notika-btn-danger" id="ResetFilterKemen">Reset Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped" style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="<?= $isSuperAdmin ? '55%' : '70%' ?>">Nama Kementerian / Lembaga</th>
                                    <th width="<?= $isSuperAdmin ? '25%' : '25%' ?>" class="text-center">Periode Perencanaan</th>
                                    <?php if ($isSuperAdmin): ?>
                                    <th width="15%" class="text-center">Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Kementerian as $key): ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $No++ ?></td>
                                    <td style="vertical-align: middle; word-wrap: break-word;">
                                        <i class="fa fa-university" style="color: #20c997; margin-right: 6px;"></i>
                                        <?= htmlspecialchars($key['NamaKementerian']) ?>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <span class="badge" style="background: #e6fcf5; color: #0ca678; border: 1px solid #c3fae8; padding: 5px 12px; font-size: 12px; font-weight: 600; border-radius: 12px;">
                                            <i class="fa fa-calendar" style="margin-right: 4px;"></i>
                                            <?= htmlspecialchars($key['TahunMulai']) ?> &ndash; <?= htmlspecialchars($key['TahunAkhir']) ?>
                                        </span>
                                    </td>
                                    <?php if ($isSuperAdmin): ?>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="button-icon-btn button-icon-btn-cl">
                                            <button type="button" class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                                                data-id="<?= $key['Id'] ?>"
                                                data-nama="<?= htmlspecialchars($key['NamaKementerian']) ?>"
                                                data-mulai="<?= $key['TahunMulai'] ?>"
                                                data-akhir="<?= $key['TahunAkhir'] ?>"
                                                title="Edit">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger danger-icon-notika btn-reco-mg btn-button-mg Hapus"
                                                data-id="<?= $key['Id'] ?>"
                                                title="Hapus">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($isSuperAdmin): ?>
<!-- Modal Input Kementerian -->
<div class="modal fade" id="ModalInputKementerian" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Input Data Kementerian Baru</h4>
            </div>
            <div class="modal-body">
                <form id="formInputKemen" onsubmit="return false;">
                    <div class="form-example-wrap">
                        <div class="form-example-int">
                            <div class="form-group">
                                <label><b>Nama Kementerian / Lembaga <span class="text-danger">*</span></b></label>
                                <input type="text" class="form-control" id="NamaKementerian" placeholder="Contoh: Kementerian Dalam Negeri" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-example-int">
                                    <div class="form-group">
                                        <label><b>Tahun Mulai <span class="text-danger">*</span></b></label>
                                        <input type="number" class="form-control" id="TahunMulai" placeholder="Contoh: 2025" min="2000" max="2100" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-example-int">
                                    <div class="form-group">
                                        <label><b>Tahun Akhir <span class="text-danger">*</span></b></label>
                                        <input type="number" class="form-control" id="TahunAkhir" placeholder="Contoh: 2029" min="2000" max="2100" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success notika-btn-success" id="InputKementerian">
                    <i class="notika-icon notika-checked"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kementerian -->
<div class="modal fade" id="ModalEditKementerian" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Kementerian</h4>
            </div>
            <div class="modal-body">
                <form id="formEditKemen" onsubmit="return false;">
                    <input type="hidden" id="EditId">
                    <div class="form-example-wrap">
                        <div class="form-example-int">
                            <div class="form-group">
                                <label><b>Nama Kementerian / Lembaga <span class="text-danger">*</span></b></label>
                                <input type="text" class="form-control" id="EditNamaKementerian" placeholder="Nama Kementerian" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-example-int">
                                    <div class="form-group">
                                        <label><b>Tahun Mulai <span class="text-danger">*</span></b></label>
                                        <input type="number" class="form-control" id="EditTahunMulai" placeholder="Tahun Mulai" min="2000" max="2100" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-example-int">
                                    <div class="form-group">
                                        <label><b>Tahun Akhir <span class="text-danger">*</span></b></label>
                                        <input type="number" class="form-control" id="EditTahunAkhir" placeholder="Tahun Akhir" min="2000" max="2100" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success notika-btn-success" id="UpdateKementerian">
                    <i class="notika-icon notika-checked"></i> Update
                </button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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
    var BaseURL = '<?= base_url() ?>';

    jQuery(document).ready(function($) {
        // Filter Periode
        $('#ApplyFilterKemen').on('click', function() {
            var periode = $('#FilterPeriodeSelect').val();
            if (periode) {
                window.location.href = BaseURL + 'Kementerian/Kementerian?periode=' + encodeURIComponent(periode);
            } else {
                window.location.href = BaseURL + 'Kementerian/Kementerian';
            }
        });

        $('#ResetFilterKemen').on('click', function() {
            window.location.href = BaseURL + 'Kementerian/Kementerian';
        });

        // Input Kementerian
        $("#InputKementerian").click(function() {
            var nama  = $("#NamaKementerian").val().trim();
            var mulai = $("#TahunMulai").val().trim();
            var akhir = $("#TahunAkhir").val().trim();

            if (nama === "") {
                alert('Nama Kementerian wajib diisi!');
                $("#NamaKementerian").focus();
                return;
            } else if (isNaN(mulai) || mulai.length !== 4) {
                alert('Tahun Mulai harus 4 digit angka!');
                $("#TahunMulai").focus();
                return;
            } else if (isNaN(akhir) || akhir.length !== 4) {
                alert('Tahun Akhir harus 4 digit angka!');
                $("#TahunAkhir").focus();
                return;
            }

            var Data = {
                NamaKementerian: nama,
                TahunMulai: mulai,
                TahunAkhir: akhir
            };

            $.post(BaseURL + "Kementerian/InputKementerian", Data).done(function(Respon) {
                if (Respon.trim() === '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            }).fail(function(xhr, status, error) {
                console.error('InputKementerian Error:', xhr, status, error);
                alert('Error: Gagal menyimpan data. Silakan coba lagi.');
            });
        });

        // Edit Kementerian
        $(document).on("click", ".Edit", function() {
            var id    = $(this).data('id');
            var nama  = $(this).data('nama');
            var mulai = $(this).data('mulai');
            var akhir = $(this).data('akhir');

            $("#EditId").val(id);
            $("#EditNamaKementerian").val(nama);
            $("#EditTahunMulai").val(mulai);
            $("#EditTahunAkhir").val(akhir);
            $('#ModalEditKementerian').modal("show");
        });

        $("#UpdateKementerian").click(function() {
            var id    = $("#EditId").val();
            var nama  = $("#EditNamaKementerian").val().trim();
            var mulai = $("#EditTahunMulai").val().trim();
            var akhir = $("#EditTahunAkhir").val().trim();

            if (id === "") {
                alert('ID Kementerian tidak ditemukan!');
                return;
            } else if (nama === "") {
                alert('Nama Kementerian wajib diisi!');
                $("#EditNamaKementerian").focus();
                return;
            } else if (isNaN(mulai) || mulai.length !== 4) {
                alert('Tahun Mulai harus 4 digit angka!');
                $("#EditTahunMulai").focus();
                return;
            } else if (isNaN(akhir) || akhir.length !== 4) {
                alert('Tahun Akhir harus 4 digit angka!');
                $("#EditTahunAkhir").focus();
                return;
            }

            var Data = {
                Id: id,
                NamaKementerian: nama,
                TahunMulai: mulai,
                TahunAkhir: akhir
            };

            $.post(BaseURL + "Kementerian/UpdateKementerian", Data).done(function(Respon) {
                if (Respon.trim() === '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            }).fail(function(xhr, status, error) {
                alert('Error: Gagal memperbarui data. Silakan coba lagi.');
            });
        });

        // Delete Kementerian dengan konfirmasi
        $(document).on("click", ".Hapus", function() {
            var id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus data kementerian ini?')) {
                $.post(BaseURL + "Kementerian/DeleteKementerian", { Id: id }).done(function(Respon) {
                    if (Respon.trim() === '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                }).fail(function(xhr, status, error) {
                    console.error('DeleteKementerian Error:', xhr, status, error);
                    alert('Error: Gagal menghapus data. Silakan coba lagi.');
                });
            }
        });
    });
</script>
</div>