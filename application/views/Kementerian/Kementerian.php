<?php $this->load->view('Kementerian/Sidebar'); ?>
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
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputKementerian">
                                <i class="notika-icon notika-edit"></i> <b>Input Kementerian</b>
                                <?php } ?>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kementerian</th>
                                    <th>Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                    <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Kementerian as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?= $key['Id'] . '|' . $key['NamaKementerian'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] ?>"><i class="notika-icon notika-edit"></i></button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?= $key['Id'] ?>"><i class="notika-icon notika-trash"></i></button>
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

<!-- Modal Input Kementerian -->
<div class="modal fade" id="ModalInputKementerian" role="dialog">
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
                                        <div class="col-lg-5">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TahunMulai" placeholder="Tahun Mulai">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TahunAkhir" placeholder="Tahun Akhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="NamaKementerian" placeholder="Nama Kementerian">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="InputKementerian"><b>SIMPAN</b></button>
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

<!-- Modal Edit Kementerian -->
<div class="modal fade" id="ModalEditKementerian" role="dialog">
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
                                        <div class="col-lg-5">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TahunMulai" placeholder="Tahun Mulai">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="TahunAkhir" placeholder="Tahun Akhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Nama Kementerian</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditNamaKementerian" placeholder="Nama Kementerian">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <input type="hidden" id="EditId">
                                        <button class="btn btn-success notika-btn-success" id="UpdateKementerian"><b>UPDATE</b></button>
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
<!-- (Bagian HTML tetap sama seperti sebelumnya, hanya JavaScript yang diperbarui) -->
<script>
    var BaseURL = '<?= base_url() ?>';
    jQuery(document).ready(function($) {
        // Input Kementerian
        $("#InputKementerian").click(function() {
            if ($("#NamaKementerian").val() === "") {
                alert('Input Nama Kementerian Belum Benar!');
                return;
            } else if (isNaN($("#TahunMulai").val()) || $("#TahunMulai").val() === "" || $("#TahunMulai").val().length !== 4) {
                alert('Input Tahun Mulai Belum Benar!');
                return;
            } else if (isNaN($("#TahunAkhir").val()) || $("#TahunAkhir").val() === "" || $("#TahunAkhir").val().length !== 4) {
                alert('Input Tahun Akhir Belum Benar!');
                return;
            }
            var Data = {
                NamaKementerian: $("#NamaKementerian").val(),
                TahunMulai: $("#TahunMulai").val(),
                TahunAkhir: $("#TahunAkhir").val()
            };
            $.post(BaseURL + "Kementerian/InputKementerian", Data).done(function(Respon) {
                if (Respon === '1') {
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
            var Data = $(this).attr('Edit');
            var Pisah = Data.split("|");
            $("#EditId").val(Pisah[0]);
            $("#EditNamaKementerian").val(Pisah[1]);
            $("#EditTahunMulai").val(Pisah[2]);
            $("#EditTahunAkhir").val(Pisah[3]);
            $('#ModalEditKementerian').modal("show");
        });

        $("#UpdateKementerian").click(function() {
            if ($("#EditId").val() === "") {
                alert('ID Kementerian tidak ditemukan!');
                return;
            } else if ($("#EditNamaKementerian").val() === "") {
                alert('Input Nama Kementerian Belum Benar!');
                return;
            } else if (isNaN($("#EditTahunMulai").val()) || $("#EditTahunMulai").val() === "" || $("#EditTahunMulai").val().length !== 4) {
                alert('Input Tahun Mulai Belum Benar!');
                return;
            } else if (isNaN($("#EditTahunAkhir").val()) || $("#EditTahunAkhir").val() === "" || $("#EditTahunAkhir").val().length !== 4) {
                alert('Input Tahun Akhir Belum Benar!');
                return;
            }

            var Data = {
                Id: $("#EditId").val(),
                NamaKementerian: $("#EditNamaKementerian").val(),
                TahunMulai: $("#EditTahunMulai").val(),
                TahunAkhir: $("#EditTahunAkhir").val()
            };

            $.post(BaseURL + "Kementerian/UpdateKementerian", Data).done(function(Respon) {
                if (Respon === '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            }).fail(function(xhr, status, error) {
                alert('Error: Gagal memperbarui data. Silakan coba lagi.');
            });
        });
        

        // Delete Kementerian
        $(".Hapus").click(function() {
            var Id = { Id: $(this).attr('Hapus') };
            console.log('DeleteKementerian Data:', Id); // Debugging
            $.post(BaseURL + "Kementerian/DeleteKementerian", Id).done(function(Respon) {
                if (Respon === '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            }).fail(function(xhr, status, error) {
                console.error('DeleteKementerian Error:', xhr, status, error);
                alert('Error: Gagal menghapus data. Silakan coba lagi.');
            });
        });
    });
</script>