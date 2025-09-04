<?php $this->load->view('Kementerian/Sidebar'); ?>
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
                            <a href="<?= base_url('Kementerian/IsuKLHS') ?>">Isu</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block;">
                            <span class="bread-blk">Isu KLHS</span>
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
                    <!-- Header with Filter Button -->
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-primary notika-btn-primary" id="FilterIsuKLHS">
                                <i class="notika-icon notika-search"></i> 
                                <b>Filter Data</b>
                                <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                    <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                <?php endif; ?>
                            </button>
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsuKLHS">
                                <i class="notika-icon notika-edit"></i> <b>Input Isu KLHS</b>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Filter -->
                    <div class="modal fade" id="ModalFilter" role="dialog">
                        <div class="modal-dialog modals-default">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h4 class="modal-title">Filter Data Isu KLHS</h4>
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
                                                        <select class="form-control" id="FilterKementerianSelect">
                                                            <option value="">Semua Kementerian</option>
                                                            <?php foreach ($Kementerian as $kementerian): ?>
                                                                <?php $selected = ($CurrentKementerian == $kementerian['Id']) ? 'selected' : ''; ?>
                                                                <option value="<?= $kementerian['Id'] ?>" <?= $selected ?>>
                                                                    <?= $kementerian['NamaKementerian'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
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

                    <!-- Tabel Data Isu KLHS -->
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kementerian</th>
                                    <th>Isu KLHS</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($IsuKLHS as $key): ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaIsuKLHS'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                data-edit="<?= $key['Id'] . '|' . $key['IdKementerian'] . '|' . $key['NamaIsuKLHS'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-hapus="<?= $key['Id'] ?>">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
                                        </div>
                                    </td>
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

<!-- Modal Input Isu KLHS -->
<div class="modal fade" id="ModalInputIsuKLHS" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Input Isu KLHS</h4>
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
                                                <select class="form-control" id="InputPeriode" required>
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($AllPeriode as $periode): ?>
                                                        <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>">
                                                            <?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
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
                                                <select class="form-control" id="InputKementerian" required>
                                                    <option value="">-- Pilih Kementerian --</option>
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
                                            <label class="hrzn-fm"><b>Nama Isu KLHS</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="NamaIsuKLHS" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="InputIsuKLHS"><b>SIMPAN</b></button>
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

<!-- Modal Edit Isu KLHS -->
<div class="modal fade" id="ModalEditIsuKLHS" role="dialog">
    <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit Isu KLHS</h4>
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
                                                <select class="form-control" id="EditPeriode" required>
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($AllPeriode as $periode): ?>
                                                        <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>">
                                                            <?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
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
                                                <input type="hidden" id="EditId">
                                                <select class="form-control" id="EditIdKementerian" required>
                                                    <option value="">-- Pilih Kementerian --</option>
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
                                            <label class="hrzn-fm"><b>Nama Isu KLHS</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control input-sm" id="EditNamaIsuKLHS" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="UpdateIsuKLHS"><b>UPDATE</b></button>
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
<script>
    var BaseURL = '<?= base_url() ?>';
    var CurrentPeriode = '<?= $CurrentPeriode ?>';
    var CurrentKementerian = '<?= $CurrentKementerian ?>';

    $(document).ready(function() {
        // Function to populate Kementerian dropdown
        function populateKementerian(selectElement, tahunMulai, tahunAkhir, selectedId = '') {
            if (tahunMulai && tahunAkhir) {
                $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                    TahunMulai: tahunMulai,
                    TahunAkhir: tahunAkhir
                }, function(response) {
                    var kementerian = JSON.parse(response);
                    selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
                    $.each(kementerian, function(index, item) {
                        var isSelected = (item.Id == selectedId) ? 'selected' : '';
                        selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                    });
                });
            } else {
                selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
            }
        }

        // Periode change handler for Input modal
        $("#InputPeriode").change(function() {
            var periode = $(this).val();
            if (periode) {
                var [tahunMulai, tahunAkhir] = periode.split('|');
                populateKementerian($("#InputKementerian"), tahunMulai, tahunAkhir);
            } else {
                $("#InputKementerian").empty().append('<option value="">-- Pilih Kementerian --</option>');
            }
        });

        // Periode change handler for Edit modal
        $("#EditPeriode").change(function() {
            var periode = $(this).val();
            if (periode) {
                var [tahunMulai, tahunAkhir] = periode.split('|');
                populateKementerian($("#EditIdKementerian"), tahunMulai, tahunAkhir);
            } else {
                $("#EditIdKementerian").empty().append('<option value="">-- Pilih Kementerian --</option>');
            }
        });

        // Filter functionality
        function loadKementerianForFilter(periode, selectElement, selectedId = '') {
            if (periode) {
                var [tahunMulai, tahunAkhir] = periode.split('|');
                $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                    TahunMulai: tahunMulai,
                    TahunAkhir: tahunAkhir
                }, function(response) {
                    var kementerian = JSON.parse(response);
                    selectElement.empty().append('<option value="">Semua Kementerian</option>');
                    
                    if (kementerian.length > 0) {
                        $.each(kementerian, function(index, item) {
                            var isSelected = (item.Id == selectedId) ? 'selected' : '';
                            selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                        });
                    }
                });
            } else {
                // Load all kementerian when no periode selected
                $.getJSON(BaseURL + "Kementerian/GetAllKementerian", function(kementerian) {
                    selectElement.empty().append('<option value="">Semua Kementerian</option>');
                    $.each(kementerian, function(index, item) {
                        var isSelected = (item.Id == selectedId) ? 'selected' : '';
                        selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                    });
                });
            }
        }

        // Show filter modal
        $("#FilterIsuKLHS").click(function() {
            $('#ModalFilter').modal("show");
        });

        // Load ministries when period filter changes
        $("#FilterPeriode").change(function() {
            var periode = $(this).val();
            loadKementerianForFilter(periode, $("#FilterKementerianSelect"));
        });

        // Apply filter
        $("#ApplyFilter").click(function() {
            var periode = $("#FilterPeriode").val();
            var kementerian = $("#FilterKementerianSelect").val();
            var url = BaseURL + "Kementerian/IsuKLHS?";
            
            if (periode) url += "periode=" + encodeURIComponent(periode) + "&";
            if (kementerian) url += "kementerian=" + encodeURIComponent(kementerian);
            
            window.location.href = url;
        });

        // Reset filter
        $("#ResetFilter").click(function() {
            window.location.href = BaseURL + "Kementerian/IsuKLHS";
        });

        // Input Isu KLHS
        $("#InputIsuKLHS").click(function() {
            if ($("#InputPeriode").val() === "") {
                alert('Pilih Periode terlebih dahulu!');
                return;
            } else if ($("#InputKementerian").val() === "") {
                alert('Pilih Kementerian terlebih dahulu!');
                return;
            } else if ($("#NamaIsuKLHS").val() === "") {
                alert('Input Nama Isu KLHS Belum Benar!');
                return;
            } else {
                var [TahunMulai, TahunAkhir] = $("#InputPeriode").val().split('|');
                var Data = {
                    IdKementerian: $("#InputKementerian").val(),
                    NamaIsuKLHS: $("#NamaIsuKLHS").val(),
                    TahunMulai: TahunMulai,
                    TahunAkhir: TahunAkhir
                };
                $.post(BaseURL + "Kementerian/InputIsuKLHS", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            }
        });

        // Edit Isu KLHS
        $(document).on("click", ".Edit", function() {
            var Data = $(this).data('edit').split("|");
            $("#EditId").val(Data[0]);
            $("#EditNamaIsuKLHS").val(Data[2]);
            var periode = Data[3] + '|' + Data[4];
            $("#EditPeriode").val(periode);
            populateKementerian($("#EditIdKementerian"), Data[3], Data[4], Data[1]);
            $('#ModalEditIsuKLHS').modal("show");
        });

        // Update Isu KLHS
        $("#UpdateIsuKLHS").click(function() {
            if ($("#EditPeriode").val() === "") {
                alert('Pilih Periode terlebih dahulu!');
                return;
            } else if ($("#EditIdKementerian").val() === "") {
                alert('Pilih Kementerian terlebih dahulu!');
                return;
            } else if ($("#EditNamaIsuKLHS").val() === "") {
                alert('Input Nama Isu KLHS Belum Benar!');
                return;
            } else {
                var [TahunMulai, TahunAkhir] = $("#EditPeriode").val().split('|');
                var Data = {
                    Id: $("#EditId").val(),
                    IdKementerian: $("#EditIdKementerian").val(),
                    NamaIsuKLHS: $("#EditNamaIsuKLHS").val(),
                    TahunMulai: TahunMulai,
                    TahunAkhir: TahunAkhir
                };
                $.post(BaseURL + "Kementerian/UpdateIsuKLHS", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            }
        });

        // Delete Isu KLHS
        $(document).on("click", ".Hapus", function() {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                var Id = { Id: $(this).data('hapus') };
                $.post(BaseURL + "Kementerian/DeleteIsuKLHS", Id).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            }
        });

        // Initialize filter state on page load
        <?php if ($CurrentPeriode): ?>
            loadKementerianForFilter('<?= $CurrentPeriode ?>', $("#FilterKementerianSelect"), '<?= $CurrentKementerian ?>');
        <?php else: ?>
            // Load all kementerian if no periode filter
            loadKementerianForFilter('', $("#FilterKementerianSelect"), '<?= $CurrentKementerian ?>');
        <?php endif; ?>
    });
</script>