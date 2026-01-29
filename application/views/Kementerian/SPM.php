<?php $this->load->view('Kementerian/Sidebar'); ?>

<div class="main-content">
    <!-- Breadcrumb -->
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
    
    <!-- Main Content Area -->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <!-- Header with Buttons -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (!$isLoggedIn || $userLevel != 1): ?>
                                <button type="button" class="btn btn-primary notika-btn-primary" id="FilterKementerian">
                                    <i class="notika-icon notika-search"></i> 
                                    <b>Filter Data</b>
                                    <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                        <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                    <?php endif; ?>
                                </button>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputSPM">
                                    <i class="notika-icon notika-edit"></i> <b>Input SPM</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Modal Filter -->
                        <div class="modal fade" id="ModalFilter" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modals-default">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Filter Data SPM</h4>
                                    </div>
                                    <!-- Body -->
                                    <div class="modal-body">
                                        <div class="form-example-wrap">
                                            <!-- Filter Periode -->
                                            <div class="form-example-int">
                                                <div class="form-group">
                                                    <label><b>Periode</b></label>
                                                    <select class="form-control" id="FilterPeriode">
                                                        <option value="">Semua Periode</option>
                                                        <?php foreach ($AllPeriode as $periode): ?>
                                                            <?php
                                                                $periodeValue = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                                $selected = ($CurrentPeriode === $periodeValue) ? 'selected' : '';
                                                            ?>
                                                            <option value="<?= $periodeValue ?>" <?= $selected ?>>
                                                                <?= $periode['TahunMulai'] ?> - <?= $periode['TahunAkhir'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Filter Kementerian -->
                                            <div class="form-example-int">
                                                <div class="form-group">
                                                    <label><b>Kementerian</b></label>
                                                    <select class="form-control" id="FilterKementerianSelect" <?= empty($Kementerian) ? 'disabled' : '' ?>>
                                                        <option value="">Semua Kementerian</option>
                                                        <?php if (!empty($Kementerian)): ?>
                                                            <?php foreach ($Kementerian as $k): ?>
                                                                <option value="<?= $k['Id'] ?>" <?= ($CurrentKementerian == $k['Id']) ? 'selected' : '' ?>>
                                                                    <?= $k['NamaKementerian'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <?php if (empty($Kementerian)): ?>
                                                        <small class="text-muted">Pilih periode terlebih dahulu untuk menampilkan kementerian</small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- Buttons -->
                                            <div class="form-example-int mg-t-20">
                                                <button type="button" class="btn btn-success notika-btn-success" id="ApplyFilter">
                                                    Terapkan Filter
                                                </button>
                                                <button type="button" class="btn btn-danger notika-btn-danger" id="ResetFilter">
                                                    Reset Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;" class="text-center">No</th>
                                        <th style="width: 12%;">Kementerian</th>
                                        <th style="width: 20%;">SPM</th>
                                        <th style="width: 10%;" class="text-center">Tahun 1<br><small><?= !empty($SPM) ? $SPM[0]['TahunMulai'] : '' ?></small></th>
                                        <th style="width: 10%;" class="text-center">Tahun 2<br><small><?= !empty($SPM) ? $SPM[0]['TahunMulai'] + 1 : '' ?></small></th>
                                        <th style="width: 10%;" class="text-center">Tahun 3<br><small><?= !empty($SPM) ? $SPM[0]['TahunMulai'] + 2 : '' ?></small></th>
                                        <th style="width: 10%;" class="text-center">Tahun 4<br><small><?= !empty($SPM) ? $SPM[0]['TahunMulai'] + 3 : '' ?></small></th>
                                        <th style="width: 10%;" class="text-center">Tahun 5<br><small><?= !empty($SPM) ? $SPM[0]['TahunMulai'] + 4 : '' ?></small></th>
                                        <th style="width: 10%;">Periode Kementerian</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                        <th style="width: 5%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($SPM)): ?>
                                        <?php $No = 1; foreach ($SPM as $key): ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                            <td style="vertical-align: middle;"><?= $key['NamaSPM'] ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= number_format($key['TargetTahun1'], 2) ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= number_format($key['TargetTahun2'], 2) ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= number_format($key['TargetTahun3'], 2) ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= number_format($key['TargetTahun4'], 2) ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= number_format($key['TargetTahun5'], 2) ?></td>
                                            <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                    <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                        data-edit="<?= $key['Id'] . '|' . $key['IdKementerian'] . '|' . $key['NamaSPM'] . '|' . $key['TargetTahun1'] . '|' . $key['TargetTahun2'] . '|' . $key['TargetTahun3'] . '|' . $key['TargetTahun4'] . '|' . $key['TargetTahun5'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] ?>">
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
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <div class="alert alert-warning">
                                                    <i class="notika-icon notika-info"></i> Tidak ada data SPM ditemukan
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Input SPM -->
    <div class="modal fade" id="ModalInputSPM" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Input SPM</h4>
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
                                                    <input type="text" class="form-control" id="NamaSPM" placeholder="Masukkan nama SPM...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Target Per Tahun -->
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 1</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="number" step="0.01" class="form-control" id="TargetTahun1" placeholder="0.00">
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
                                                    <input type="number" step="0.01" class="form-control" id="TargetTahun2" placeholder="0.00">
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
                                                    <input type="number" step="0.01" class="form-control" id="TargetTahun3" placeholder="0.00">
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
                                                    <input type="number" step="0.01" class="form-control" id="TargetTahun4" placeholder="0.00">
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
                                                    <input type="number" step="0.01" class="form-control" id="TargetTahun5" placeholder="0.00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="InputSPM"><b>SIMPAN</b></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
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

    <!-- Modal Edit SPM -->
    <div class="modal fade" id="ModalEditSPM" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit SPM</h4>
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
                                                    <input type="text" class="form-control" id="EditNamaSPM">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Target Per Tahun -->
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Target Tahun 1</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="number" step="0.01" class="form-control" id="EditTargetTahun1">
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
                                                    <input type="number" step="0.01" class="form-control" id="EditTargetTahun2">
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
                                                    <input type="number" step="0.01" class="form-control" id="EditTargetTahun3">
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
                                                    <input type="number" step="0.01" class="form-control" id="EditTargetTahun4">
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
                                                    <input type="number" step="0.01" class="form-control" id="EditTargetTahun5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="UpdateSPM"><b>UPDATE</b></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
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

    <!-- JavaScript -->
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
                var url = BaseURL + "Kementerian/SPM?";
                
                if (periode) url += "periode=" + encodeURIComponent(periode) + "&";
                if (kementerian) url += "kementerian=" + encodeURIComponent(kementerian);
                
                window.location.href = url;
            });

            // Reset filter
            $("#ResetFilter").click(function() {
                window.location.href = BaseURL + "Kementerian/SPM";
            });

            // Input SPM
            $("#InputSPM").click(function(e) {
                e.preventDefault();

                if ($("#NamaSPM").val() === "") {
                    alert('Nama SPM harus diisi!');
                    return;
                }

                var Data = {
                    NamaSPM: $("#NamaSPM").val(),
                    TargetTahun1: $("#TargetTahun1").val() || 0,
                    TargetTahun2: $("#TargetTahun2").val() || 0,
                    TargetTahun3: $("#TargetTahun3").val() || 0,
                    TargetTahun4: $("#TargetTahun4").val() || 0,
                    TargetTahun5: $("#TargetTahun5").val() || 0
                };

                $.post(BaseURL + "Kementerian/InputSPM", Data)
                    .done(function(Respon) {
                        if (Respon == '1') {
                            $('#ModalInputSPM').modal('hide');
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    });
            });

            // Edit SPM
            $(document).on("click", ".Edit", function() {
                var Data = $(this).data('edit').split("|");
                $("#EditId").val(Data[0]);
                $("#EditIdKementerian").val(Data[1]);
                $("#EditNamaSPM").val(Data[2]);
                $("#EditTargetTahun1").val(Data[3]);
                $("#EditTargetTahun2").val(Data[4]);
                $("#EditTargetTahun3").val(Data[5]);
                $("#EditTargetTahun4").val(Data[6]);
                $("#EditTargetTahun5").val(Data[7]);
                $("#EditTahunMulai").val(Data[8]);
                $("#EditTahunAkhir").val(Data[9]);
                
                $('#ModalEditSPM').modal("show");
            });

            // Update SPM
            $("#UpdateSPM").click(function() {
                if ($("#EditNamaSPM").val() === "") {
                    alert('Nama SPM harus diisi!');
                    return;
                }
                
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
                            $('#ModalEditSPM').modal('hide');
                            window.location.reload();
                        } else {
                            alert('Error: ' + Respon);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert('Request failed: ' + error);
                        console.log('Error details:', xhr.responseText);
                    });
            });

            // Delete SPM
            $(document).on("click", ".Hapus", function() {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    var Id = { Id: $(this).data('hapus') };
                    $.post(BaseURL + "Kementerian/DeleteSPM", Id)
                        .done(function(Respon) {
                            if (Respon == '1') {
                                window.location.reload();
                            } else {
                                alert('Error: ' + Respon);
                            }
                        })
                        .fail(function(xhr, status, error) {
                            alert('Request failed: ' + error);
                            console.log('Error details:', xhr.responseText);
                        });
                }
            });

            // Clear modal input when closed
            $('#ModalInputSPM').on('hidden.bs.modal', function () {
                $(this).find('textarea, input').val('');
            });
        });
    </script>
</div>
</body>
</html>