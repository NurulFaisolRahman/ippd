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

                                <!-- Menampilkan Wilayah dan Pesan Error setelah filter -->
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <?php 
                                        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                        $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                        if (empty($Iku)) {
                                            $pesan_error = "Tidak ada data IKU untuk wilayah: $nama_wilayah";
                                        }
                                    ?>
                                    <div class="alert <?= empty($Iku) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                        <?php if (!empty($pesan_error)) { ?>
                                            <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambahIku">
                                        <i class="notika-icon notika-edit"></i> <b>Tambah IKU</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Tujuan</th>
                                        <th>Indikator Tujuan (IKU)</th>
                                        <th class="text-center">Periode</th>
                                        <th class="text-center">Target <br><small>Tahun 1</small></th>
                                        <th class="text-center">Target <br><small>Tahun 2</small></th>
                                        <th class="text-center">Target <br><small>Tahun 3</small></th>
                                        <th class="text-center">Target <br><small>Tahun 4</small></th>
                                        <th class="text-center">Target <br><small>Tahun 5</small></th>
                                     
                                        <th <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>style="width: 10%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Iku as $key) { ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle;">
                                                <?php
                                                $tujuan = $this->db->where('Id', $key['IdTujuan'])->get('tujuanrpjmd')->row_array();
                                                echo $tujuan ? html_escape($tujuan['Tujuan']) : '-';
                                                ?>
                                            </td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['indikator_tujuan']) ?></td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= html_escape($key['tahun_mulai']) ?> - <?= html_escape($key['tahun_akhir']) ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center" align="center">
                                                <?= is_numeric($key['target_1']) ? number_format($key['target_1'], 2, ',', '.') : '-' ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center" align="center">
                                                <?= is_numeric($key['target_2']) ? number_format($key['target_2'], 2, ',', '.') : '-' ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center" align="center">
                                                <?= is_numeric($key['target_3']) ? number_format($key['target_3'], 2, ',', '.') : '-' ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center" align="center">
                                                <?= is_numeric($key['target_4']) ? number_format($key['target_4'], 2, ',', '.') : '-' ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center" align="center">
                                                <?= is_numeric($key['target_5']) ? number_format($key['target_5'], 2, ',', '.') : '-' ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                        <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                                                                data-id="<?= $key['id'] ?>"
                                                                data-tujuan="<?= $key['IdTujuan'] ?>"
                                                                data-indikator-tujuan="<?= html_escape($key['indikator_tujuan']) ?>"
                                                                data-target1="<?= $key['target_1'] ?? '' ?>"
                                                                data-target2="<?= $key['target_2'] ?? '' ?>"
                                                                data-target3="<?= $key['target_3'] ?? '' ?>"
                                                                data-target4="<?= $key['target_4'] ?? '' ?>"
                                                                data-target5="<?= $key['target_5'] ?? '' ?>"
                                                                data-tahunmulai="<?= $key['tahun_mulai'] ?>"
                                                                data-tahunakhir="<?= $key['tahun_akhir'] ?>">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus"
                                                                data-id="<?= $key['id'] ?>">
                                                            <i class="notika-icon notika-trash"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
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

    <!-- Modal Tambah IKU -->
    <div class="modal fade" id="ModalTambahIku" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="FormTambahIku">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <!-- Tahun Filter Dropdown dengan opsi default -->
                        <div class="form-group">
                            <label for="TahunFilter">Periode Tahun</label>
                            <select class="form-control" id="TahunFilter" name="TahunFilter" required>
                                <option value="" selected disabled>-- Pilih Tahun --</option>
                                <?php foreach ($Periods as $period) { ?>
                                    <option value="<?= html_escape($period['TahunMulai'] . '-' . $period['TahunAkhir']) ?>">
                                        <?= html_escape($period['TahunMulai'] . ' - ' . $period['TahunAkhir']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Dropdown Tujuan (akan diisi via AJAX) -->
                        <div class="form-group">
                            <label for="Tujuan">Tujuan</label>
                            <select class="form-control" id="Tujuan" name="Tujuan" required disabled>
                                <option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>
                            </select>
                        </div>

                        <!-- Indikator Tujuan (IKU) -->
                        <div class="form-group">
                            <label for="IndikatorTujuan">Indikator Tujuan (IKU)</label>
                            <textarea class="form-control" id="IndikatorTujuan" name="indikator_tujuan" rows="3" required></textarea>
                        </div>

                        <!-- Target Inputs -->
                        <div class="form-group">
                            <label>Target Tahunan</label>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Tahun 1</label>
                                    <input type="number" step="any" class="form-control" name="target_1" placeholder="Angka">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 2</label>
                                    <input type="number" step="any" class="form-control" name="target_2" placeholder="Angka">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 3</label>
                                    <input type="number" step="any" class="form-control" name="target_3" placeholder="Angka">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 4</label>
                                    <input type="number" step="any" class="form-control" name="target_4" placeholder="Angka">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 5</label>
                                    <input type="number" step="any" class="form-control" name="target_5" placeholder="Angka">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit IKU -->
    <div class="modal fade" id="ModalEditIku" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="FormEditIku">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="EditId" name="id">

                        <!-- Periode Dropdown -->
                        <div class="form-group">
                            <label for="EditPeriode">Periode Tahun</label>
                            <select class="form-control" id="EditPeriode" name="periode" required>
                                <option value="" selected disabled>-- Pilih Tahun --</option>
                                <?php foreach ($Periods as $period) { ?>
                                    <option value="<?= html_escape($period['TahunMulai'] . '-' . $period['TahunAkhir']) ?>">
                                        <?= html_escape($period['TahunMulai'] . ' - ' . $period['TahunAkhir']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Dropdown Tujuan -->
                        <div class="form-group">
                            <label for="EditTujuan">Tujuan</label>
                            <select class="form-control" id="EditTujuan" name="EditTujuan" required disabled>
                                <option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>
                            </select>
                        </div>

                        <!-- Indikator Tujuan -->
                        <div class="form-group">
                            <label for="EditIndikatorTujuan">Indikator Tujuan (IKU)</label>
                            <textarea class="form-control" id="EditIndikatorTujuan" name="indikator_tujuan" rows="3" required></textarea>
                        </div>

                        <!-- Target Inputs -->
                        <div class="form-group">
                            <label>Target Tahunan</label>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Tahun 1</label>
                                    <input type="number" step="any" class="form-control" id="EditTarget1" name="target_1">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 2</label>
                                    <input type="number" step="any" class="form-control" id="EditTarget2" name="target_2">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 3</label>
                                    <input type="number" step="any" class="form-control" id="EditTarget3" name="target_3">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 4</label>
                                    <input type="number" step="any" class="form-control" id="EditTarget4" name="target_4">
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun 5</label>
                                    <input type="number" step="any" class="form-control" id="EditTarget5" name="target_5">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
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
        var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
        var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

        $(document).ready(function() {
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
                        data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
                        beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                        success: function(Respon) {
                            try {
                                if (Respon === '1') {
                                    window.location.href = BaseURL + "Daerah/IKU";
                                } else {
                                    var error = JSON.parse(Respon);
                                    alert(error.message || "Gagal menyimpan filter wilayah!");
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

            // Ketika periode tahun dipilih (Tambah)
            $('#TahunFilter').change(function() {
                if ($(this).val()) {
                    $('#Tujuan').prop('disabled', false);
                    $('#Tujuan').html('<option value="" selected disabled>-- Pilih Tujuan --</option>');
                    var tahunRange = $(this).val().split('-');
                    var tahunMulai = tahunRange[0];
                    var tahunAkhir = tahunRange[1];
                    $.ajax({
                        url: BaseURL + 'Daerah/GetTujuanByPeriod',
                        type: 'POST',
                        data: {
                            tahun_mulai: tahunMulai,
                            tahun_akhir: tahunAkhir,
                            [CSRF_NAME]: CSRF_TOKEN
                        },
                        success: function(response) {
                            try {
                                var data = JSON.parse(response);
                                if (data.message) {
                                    alert(data.message);
                                    $('#Tujuan').html('<option value="" selected disabled>-- Tidak ada tujuan untuk periode ini --</option>');
                                    $('#Tujuan').prop('disabled', true);
                                } else if (data.length > 0) {
                                    $.each(data, function(key, value) {
                                        $('#Tujuan').append('<option value="' + value.Id + '">' + value.Tujuan + '</option>');
                                    });
                                } else {
                                    $('#Tujuan').html('<option value="" selected disabled>-- Tidak ada tujuan untuk periode ini --</option>');
                                    $('#Tujuan').prop('disabled', true);
                                }
                            } catch (e) {
                                alert("Gagal memproses respons server!");
                            }
                        },
                        error: function() {
                            alert("Gagal memuat data tujuan!");
                            $('#Tujuan').html('<option value="" selected disabled>-- Tidak ada tujuan untuk periode ini --</option>');
                            $('#Tujuan').prop('disabled', true);
                        }
                    });
                } else {
                    $('#Tujuan').prop('disabled', true);
                    $('#Tujuan').html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
                }
            });

            // Ketika periode tahun dipilih (Edit)
            $('#EditPeriode').change(function() {
                if ($(this).val()) {
                    $('#EditTujuan').prop('disabled', false);
                    $('#EditTujuan').html('<option value="" selected disabled>-- Pilih Tujuan --</option>');
                    var tahunRange = $(this).val().split('-');
                    var tahunMulai = tahunRange[0];
                    var tahunAkhir = tahunRange[1];
                    $.ajax({
                        url: BaseURL + 'Daerah/GetTujuanByPeriod',
                        type: 'POST',
                        data: {
                            tahun_mulai: tahunMulai,
                            tahun_akhir: tahunAkhir,
                            [CSRF_NAME]: CSRF_TOKEN
                        },
                        success: function(response) {
                            try {
                                var data = JSON.parse(response);
                                if (data.message) {
                                    alert(data.message);
                                    $('#EditTujuan').html('<option value="" selected disabled>-- Tidak ada tujuan untuk periode ini --</option>');
                                    $('#EditTujuan').prop('disabled', true);
                                } else if (data.length > 0) {
                                    $.each(data, function(key, value) {
                                        $('#EditTujuan').append('<option value="' + value.Id + '">' + value.Tujuan + '</option>');
                                    });
                                } else {
                                    $('#EditTujuan').html('<option value="" selected disabled>-- Tidak ada tujuan untuk periode ini --</option>');
                                    $('#EditTujuan').prop('disabled', true);
                                }
                            } catch (e) {
                                alert("Gagal memproses respons server!");
                            }
                        },
                        error: function() {
                            alert("Gagal memuat data tujuan!");
                            $('#EditTujuan').html('<option value="" selected disabled>-- Tidak ada tujuan untuk periode ini --</option>');
                            $('#EditTujuan').prop('disabled', true);
                        }
                    });
                } else {
                    $('#EditTujuan').prop('disabled', true);
                    $('#EditTujuan').html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
                }
            });

            // Validasi sebelum submit (Tambah)
            $("#FormTambahIku").submit(function(e) {
                e.preventDefault();
                if ($('#TahunFilter').val() === "" || $('#TahunFilter').val() === null) {
                    alert('Silakan pilih periode tahun terlebih dahulu!');
                    return false;
                }
                if ($('#Tujuan').val() === "" || $('#Tujuan').val() === null) {
                    alert('Silakan pilih tujuan terlebih dahulu!');
                    return false;
                }
                if ($('#IndikatorTujuan').val() === "") {
                    alert('Silakan isi indikator tujuan!');
                    return false;
                }
                $.ajax({
                    url: BaseURL + "Daerah/TambahIku",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $("#FormTambahIku button[type=submit]").prop('disabled', true).text('Menyimpan...');
                    },
                    success: function(res) {
                        try {
                            if (res === '1') {
                                window.location.reload();
                            } else {
                                var error = JSON.parse(res);
                                alert(error.message || "Gagal menyimpan data!");
                            }
                        } catch (e) {
                            alert("Gagal memproses respons server!");
                        }
                        $("#FormTambahIku button[type=submit]").prop('disabled', false).text('Simpan');
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.statusText);
                        $("#FormTambahIku button[type=submit]").prop('disabled', false).text('Simpan');
                    }
                });
            });

            // Validasi sebelum submit (Edit)
            $("#FormEditIku").submit(function(e) {
                e.preventDefault();
                if ($('#EditPeriode').val() === "" || $('#EditPeriode').val() === null) {
                    alert('Silakan pilih periode tahun terlebih dahulu!');
                    return false;
                }
                if ($('#EditTujuan').val() === "" || $('#EditTujuan').val() === null) {
                    alert('Silakan pilih tujuan terlebih dahulu!');
                    return false;
                }
                if ($('#EditIndikatorTujuan').val() === "") {
                    alert('Silakan isi indikator tujuan!');
                    return false;
                }
                $.ajax({
                    url: BaseURL + "Daerah/EditIku",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $("#FormEditIku button[type=submit]").prop('disabled', true).text('Menyimpan...');
                    },
                    success: function(res) {
                        try {
                            if (res === '1') {
                                window.location.reload();
                            } else {
                                var error = JSON.parse(res);
                                alert(error.message || "Gagal mengupdate data!");
                            }
                        } catch (e) {
                            alert("Gagal memproses respons server!");
                        }
                        $("#FormEditIku button[type=submit]").prop('disabled', false).text('Simpan');
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.statusText);
                        $("#FormEditIku button[type=submit]").prop('disabled', false).text('Simpan');
                    }
                });
            });

            // Edit button click handler
            $(".Edit").click(function() {
                var id = $(this).data('id');
                var IdTujuan = $(this).data('tujuan');
                var indikatorTujuan = $(this).data('indikator-tujuan');
                var target1 = $(this).data('target1');
                var target2 = $(this).data('target2');
                var target3 = $(this).data('target3');
                var target4 = $(this).data('target4');
                var target5 = $(this).data('target5');
                var tahunMulai = $(this).data('tahunmulai');
                var tahunAkhir = $(this).data('tahunakhir');

                $("#EditId").val(id);
                $("#EditPeriode").val('');
                $("#EditTujuan").html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
                $("#EditTujuan").prop('disabled', true);
                $("#EditIndikatorTujuan").val(indikatorTujuan);
                $("#EditTarget1").val(target1 || '');
                $("#EditTarget2").val(target2 || '');
                $("#EditTarget3").val(target3 || '');
                $("#EditTarget4").val(target4 || '');
                $("#EditTarget5").val(target5 || '');

                $("#EditPeriode").val(tahunMulai + '-' + tahunAkhir).trigger('change');
                
                var checkTujuanExist = setInterval(function() {
                    if ($('#EditTujuan option[value="' + IdTujuan + '"]').length > 0) {
                        $('#EditTujuan').val(IdTujuan);
                        clearInterval(checkTujuanExist);
                    }
                }, 100);
                
                $("#ModalEditIku").modal('show');
            });

            // Hapus IKU
            $(".Hapus").click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: BaseURL + "Daerah/HapusIku",
                    type: "POST",
                    data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
                    beforeSend: function() {
                        $(this).prop('disabled', true);
                    },
                    success: function(res) {
                        try {
                            if (res === '1') {
                                window.location.reload();
                            } else {
                                var error = JSON.parse(res);
                                alert(error.message || "Gagal menghapus data!");
                            }
                        } catch (e) {
                            alert("Gagal memproses respons server!");
                        }
                        $(this).prop('disabled', false);
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.statusText);
                        $(this).prop('disabled', false);
                    }
                });
            });
        });
    </script>
</div>
</body>
</html>