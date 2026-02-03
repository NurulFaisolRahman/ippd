<?php $this->load->view('Daerah/Cssumum'); ?>
    <?php $this->load->view('Daerah/sidebar'); ?>

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
                           
                            <!-- Menampilkan Visi dan Periode setelah filter -->
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

                        <?php } ?>
                                <div class="button-icon-btn sm-res-mg-t-30">
                                     <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputVisi">
                                        <i class="notika-icon notika-edit"></i> <b>Input Visi RPJMD</b>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="data-table-basic" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;" class="text-center">No</th>
                                            <th style="width: 70%;">Visi RPJMD</th>
                                            <th style="width: 10%;">Periode</th>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width: 10%;" class="text-center">Edit</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $No = 1; foreach ($Visi as $key) { ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                            <td style="vertical-align: middle;"><?=$key['Visi']?></td>
                                            <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <td class="text-center">
                                                <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                    <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id'].'|'.$key['Visi'].'|'.$key['TahunMulai'].'|'.$key['TahunAkhir']?>">
                                                        <i class="notika-icon notika-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['Id']?>">
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
        </div>
        
        <!-- Modal Input Visi -->
        <div class="modal fade" id="ModalInputVisi" role="dialog">
            <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-example-wrap">
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Periode RPJMD</b></label>
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
                                                    <label class="hrzn-fm"><b>Visi RPJMD</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <textarea class="form-control" rows="3" id="Visi" placeholder="Input Visi RPJMD"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-example-int">
                                        <div class="row">
                                            <div class="col-lg-2">
                                            </div>
                                            <div class="col-lg-9">
                                                <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
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
        
        <!-- Modal Edit Visi -->
        <div class="modal fade" id="ModalEditVisi" role="dialog">
            <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-example-wrap" style="padding: 5px;">
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Periode RPJMD</b></label>
                                                    <input type="hidden" class="form-control input-sm" id="Id">
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="nk-int-st">
                                                        <input type="text" class="form-control input-sm" id="_TahunMulai" placeholder="Tahun Mulai">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="nk-int-st">
                                                        <input type="text" class="form-control input-sm" id="_TahunAkhir" placeholder="Tahun Akhir">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label class="hrzn-fm"><b>Visi RPJMD</b></label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="nk-int-st">
                                                        <textarea class="form-control" rows="3" id="_Visi"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-example-int">
                                        <div class="row">
                                            <div class="col-lg-2">
                                            </div>
                                            <div class="col-lg-9">
                                                <button class="btn btn-success notika-btn-success" id="Edit"><b>Update</b></button>
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
    </div>
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
@media (max-width: 768px) {
    .filter-row {
        flex-direction: column;
        gap: 15px;
    }
    .filter-select {
        width: 100%;
    }
}
</style>
    <!-- JavaScript Libraries -->
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
    
    <!-- Custom JavaScript -->
    <script>
        var BaseURL = '<?=base_url()?>';
        var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

    jQuery(document).ready(function($) {
        // Logika filter untuk pengguna yang belum login
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
                    beforeSend: function() { $("#KabKota").prop('disabled', true); },
                    success: function(Respon) {
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
                    data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
                    beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                    success: function(Respon) {
                        if (Respon === '1') {
                            window.location.href = BaseURL + "Daerah/VisiRPJMD";
                        } else {
                            alert(Respon || "Gagal menyimpan filter wilayah!");
                            $("#Filter").prop('disabled', false).text('Filter');
                        }
                    },
                    error: function() {
                        alert("Gagal menghubungi server!");
                        $("#Filter").prop('disabled', false).text('Filter');
                    }
                });
            });

            // Populate Kab/Kota dropdown on page load if KodeWilayah is set
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

        $("#Input").click(function() {
            if (isNaN($("#TahunMulai").val()) || $("#TahunMulai").val() == "" || $("#TahunMulai").val().length != 4) {
                alert('Input Tahun Mulai Belum Benar!');
                return;
            }
            if (isNaN($("#TahunAkhir").val()) || $("#TahunAkhir").val() == "" || $("#TahunAkhir").val().length != 4) {
                alert('Input Tahun Akhir Belum Benar!');
                return;
            }
            if ($("#Visi").val() == "") {
                ALERT('Input Visi Belum Benar!');
                return;
            }
            var Visi = {
                Visi: $("#Visi").val(),
                TahunMulai: $("#TahunMulai").val(),
                TahunAkhir: $("#TahunAkhir").val()
            };
            $.post(BaseURL + "Daerah/InputVisiRPJMD", Visi).done(function(Respon) {
                if (Respon == '1') {
                    window.location = BaseURL + "Daerah/VisiRPJMD";
                } else {
                    alert(Respon);
                }
            });
        });
            
            $(document).on("click",".Edit",function(){
                var Data = $(this).attr('Edit');
                var Pisah = Data.split("|");
                $("#Id").val(Pisah[0]);
                $("#_Visi").val(Pisah[1]);
                $("#_TahunMulai").val(Pisah[2]);
                $("#_TahunAkhir").val(Pisah[3]);
                $('#ModalEditVisi').modal("show");
            });


            
            $("#Edit").click(function() {
                if (isNaN($("#_TahunMulai").val()) || $("#_TahunMulai").val() == "" || $("#_TahunMulai").val().length != 4) {
                    alert('Input Tahun Mulai Belum Benar!');
                } else if (isNaN($("#_TahunAkhir").val()) || $("#_TahunAkhir").val() == "" || $("#_TahunAkhir").val().length != 4) {
                    alert('Input Tahun Akhir Belum Benar!');
                } else if ($("#_Visi").val() == "") {
                    alert('Input Visi Belum Benar!');
                } else {
                    var Visi = { 
                        Id: $("#Id").val(),
                        Visi: $("#_Visi").val(),
                        TahunMulai: $("#_TahunMulai").val(),
                        TahunAkhir: $("#_TahunAkhir").val() 
                    };
                    
                    $.post(BaseURL+"Daerah/EditVisiRPJMD", Visi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Daerah/VisiRPJMD";
                        } else {
                            alert(Respon);
                        }
                    });                         
                }
            });

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    var Visi = { Id: $(this).attr('Hapus') };
                    $.post(BaseURL+"Daerah/HapusVisiRPJMD", Visi).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Daerah/VisiRPJMD";
                        } else {
                            alert(Respon);
                        }
                    });
                }                         
            });
        });
    </script>
</body>
</html>