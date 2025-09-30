<?php $this->load->view('Kementerian/Sidebar'); ?>

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
                                <a href="<?= base_url('Kementerian/SasaranStrategis') ?>">Kementerian</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block;">
                                <span class="bread-blk">Sasaran Strategis</span>
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
                        <!-- Header with Button -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-primary notika-btn-primary" id="FilterKementerian">
                                    <i class="notika-icon notika-search"></i> 
                                    <b>Filter Data</b>
                                    <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                        <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                    <?php endif; ?>
                                </button>
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSasaranStrategis">
                                    <i class="notika-icon notika-edit"></i> <b>Input Sasaran Strategis</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Modal Filter -->
                        <div class="modal fade" id="ModalFilter" role="dialog">
                            <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Filter Data Sasaran Strategis</h4>
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
                                                                <?php foreach ($AllPeriode as $periode): ?>
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
                                                            <select class="form-control" id="FilterKementerianSelect" <?= empty($Kementerian) ? 'disabled' : '' ?>>
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

                        <!-- Tabel Data Sasaran Strategis -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="text-center">No</th>
                                        <th style="width: 15%;">Kementerian</th>
                                        <th style="width: 25%;">Sasaran Strategis</th>
                                        <th style="width: 40%;">Indikator Sasaran Strategis</th>
                                        <th style="width: 10%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                        <th style="width: 10%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($SasaranStrategis as $key): ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                        <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                        <td style="vertical-align: middle;"><?= $key['SasaranStrategis'] ?></td>
                                        <td style="vertical-align: middle;"><?= $key['IndikatorSasaranStrategis'] ?></td>
                                        <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>                                    
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                        <td style="vertical-align: middle;" class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-edit="<?= $key['Id'] . '|' . $key['IdKementerian'] . '|' . $key['SasaranStrategis'] . '|' . $key['IndikatorSasaranStrategis'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] ?>">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-hapus="<?= $key['Id'] ?>">
                                                    <i class="notika-icon notika-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <?php } ?>
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

    <!-- Modal Input Sasaran Strategis -->
    <div class="modal fade" id="ModalInputSasaranStrategis" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Sasaran Strategis</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" id="SasaranStrategis" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Indikator Sasaran Strategis</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" id="IndikatorSasaranStrategis" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="InputSasaranStrategis"><b>SIMPAN</b></button>
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

    <!-- Modal Edit Sasaran Strategis -->
    <div class="modal fade" id="ModalEditSasaranStrategis" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Sasaran Strategis</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="hidden" id="EditId">
                                                    <input type="hidden" id="EditIdKementerian">
                                                    <input type="hidden" id="EditTahunMulai">
                                                    <input type="hidden" id="EditTahunAkhir">
                                                    <textarea class="form-control" id="EditSasaranStrategis" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Indikator Sasaran Strategis</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <textarea class="form-control" id="EditIndikatorSasaranStrategis" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="UpdateSasaranStrategis"><b>UPDATE</b></button>
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

    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/jquery-price-slider.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/data-table/jquery.dataTables.min.js"></script>
    <script src="../js/data-table/data-table-act.js"></script>
    <script src="../js/main.js"></script>
    <script>
        var BaseURL = '<?= base_url() ?>';
        var CurrentPeriode = '<?= $CurrentPeriode ?>';
        var CurrentKementerian = '<?= $CurrentKementerian ?>';

        $(document).ready(function() {
            // Load ministries when period filter changes
            function loadKementerian(periode, selectElement, selectedId = '') {
                if (periode) {
                    $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                        periode: periode
                    }, function(response) {
                        var kementerian = JSON.parse(response);
                        selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
                        
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
                    });
                } else {
                    selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
                    selectElement.prop('disabled', true);
                }
            }

            // Show filter modal
            $("#FilterKementerian").click(function() {
                $('#ModalFilter').modal("show");
            });

            // Load ministries when period filter changes
            $("#FilterPeriode").change(function() {
                var periode = $(this).val();
                loadKementerian(periode, $("#FilterKementerianSelect"));
            });

            // Apply filter
            $("#ApplyFilter").click(function() {
                var periode = $("#FilterPeriode").val();
                var kementerian = $("#FilterKementerianSelect").val();
                var url = BaseURL + "Kementerian/SasaranStrategis?";
                
                if (periode) url += "periode=" + encodeURIComponent(periode) + "&";
                if (kementerian) url += "kementerian=" + encodeURIComponent(kementerian);
                
                window.location.href = url;
            });

            // Reset filter
            $("#ResetFilter").click(function() {
                window.location.href = BaseURL + "Kementerian/SasaranStrategis";
            });

            // Input Sasaran Strategis
            $("#InputSasaranStrategis").click(function() {
                if (!CurrentPeriode || !CurrentKementerian) {
                    alert('Pilih Periode dan Kementerian terlebih dahulu di filter!');
                    return;
                }
                if ($("#SasaranStrategis").val() === "" || $("#IndikatorSasaranStrategis").val() === "") {
                    alert('Sasaran Strategis dan Indikator harus diisi!');
                    return;
                }
                var [TahunMulai, TahunAkhir] = CurrentPeriode.split('|');
                var Data = {
                    IdKementerian: CurrentKementerian,
                    SasaranStrategis: $("#SasaranStrategis").val(),
                    IndikatorSasaranStrategis: $("#IndikatorSasaranStrategis").val(),
                    TahunMulai: TahunMulai,
                    TahunAkhir: TahunAkhir
                };
                $.post(BaseURL + "Kementerian/InputSasaranStrategis", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            });

            // Edit Sasaran Strategis
            $(document).on("click", ".Edit", function() {
                var Data = $(this).data('edit').split("|");
                $("#EditId").val(Data[0]);
                $("#EditIdKementerian").val(Data[1]);
                $("#EditSasaranStrategis").val(Data[2]);
                $("#EditIndikatorSasaranStrategis").val(Data[3]);
                $("#EditTahunMulai").val(Data[4]);
                $("#EditTahunAkhir").val(Data[5]);
                
                $('#ModalEditSasaranStrategis').modal("show");
            });

            // Update Sasaran Strategis
            $("#UpdateSasaranStrategis").click(function() {
                if ($("#EditSasaranStrategis").val() === "" || $("#EditIndikatorSasaranStrategis").val() === "") {
                    alert('Sasaran Strategis dan Indikator harus diisi!');
                    return;
                }
                var Data = {
                    Id: $("#EditId").val(),
                    SasaranStrategis: $("#EditSasaranStrategis").val(),
                    IndikatorSasaranStrategis: $("#EditIndikatorSasaranStrategis").val()
                };
                $.post(BaseURL + "Kementerian/UpdateSasaranStrategis", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            });

            // Delete Sasaran Strategis
            $(document).on("click", ".Hapus", function() {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    var Id = { Id: $(this).data('hapus') };
                    $.post(BaseURL + "Kementerian/DeleteSasaranStrategis", Id).done(function(Respon) {
                        if (Respon == '1') {
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    });
                }
            });
        });
    </script>
</div>
</body>
</html>