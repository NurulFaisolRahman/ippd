
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
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
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
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
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
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
<!-- Modal Edit Kementerian -->
<div class="modal fade" id="ModalEditKementerian" role="dialog">
    <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="form-example-wrap">

                    <input type="hidden" id="EditId">

                    <div class="form-group row">
                        <label class="col-lg-3"><b>Nama Kementerian</b></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditNamaKementerian">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3"><b>Tahun Mulai</b></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditTahunMulai" maxlength="4">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3"><b>Tahun Akhir</b></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="EditTahunAkhir" maxlength="4">
                        </div>
                    </div>

                    <button class="btn btn-success" id="UpdateKementerian">
                        UPDATE
                    </button>

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
            $.post(BaseURL + "Nasional/InputKementerian", Data).done(function(Respon) {
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
        $(document).on("click", ".Edit", function () {

        let data = $(this).attr("Edit").split("|");

        $("#EditId").val(data[0]);
        $("#EditNamaKementerian").val(data[1]);
        $("#EditTahunMulai").val(data[2]);
        $("#EditTahunAkhir").val(data[3]);

        $("#ModalEditKementerian").modal("show");
    });

    /* =========================
       UPDATE DATA
    ==========================*/
    $("#UpdateKementerian").click(function () {

        let Id         = $("#EditId").val();
        let Nama       = $("#EditNamaKementerian").val();
        let TahunMulai = $("#EditTahunMulai").val();
        let TahunAkhir = $("#EditTahunAkhir").val();

        // VALIDASI
        if (Id === "") {
            alert("ID tidak ditemukan");
            return;
        }
        if (Nama === "") {
            alert("Nama kementerian wajib diisi");
            return;
        }
        if (isNaN(TahunMulai) || TahunMulai.length !== 4) {
            alert("Tahun Mulai tidak valid");
            return;
        }
        if (isNaN(TahunAkhir) || TahunAkhir.length !== 4) {
            alert("Tahun Akhir tidak valid");
            return;
        }

        let Data = {
            Id: Id,
            NamaKementerian: Nama,
            TahunMulai: TahunMulai,
            TahunAkhir: TahunAkhir
        };

        console.log("DATA UPDATE:", Data); // DEBUG

        $.ajax({
            url: BaseURL + "Nasional/UpdateKementerian",
            type: "POST",
            data: Data,
            success: function (response) {
                console.log("RESPONSE:", response);

                if (response.trim() === "1") {
                    location.reload();
                } else {
                    alert(response);
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert("SERVER ERROR (500)");
            }
        });
    });
        

        // Delete Kementerian
        $(document).on("click", ".Hapus", function() {
    var Id = { Id: $(this).attr('Hapus') };

    $.post(BaseURL + "Nasional/DeleteKementerian", Id)
    .done(function(Respon) {
        if (Respon === '1') {
            window.location.reload();
        } else {
            alert(Respon);
        }
    })
    .fail(function(xhr, status, error) {
        console.error(xhr.responseText);
        alert('Gagal menghapus data');
    });
});
});

</script>