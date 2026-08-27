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

                            <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px;">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-primary notika-btn-primary BtnBukaSinkron" data-tipe="tujuan" data-label="Sinkron Tujuan">
                                        <i class="fa fa-refresh"></i> <b>Sinkron Tujuan</b>
                                    </button>
                                    <button type="button" class="btn btn-info notika-btn-info BtnBukaSinkron" data-tipe="sasaran" data-label="Sinkron Sasaran">
                                        <i class="fa fa-refresh"></i> <b>Sinkron Sasaran</b>
                                    </button>
                                    <button type="button" class="btn btn-success notika-btn-success BtnBukaSinkron" data-tipe="tujuan_sasaran" data-label="Sinkron Tujuan &amp; Sasaran">
                                        <i class="fa fa-refresh"></i> <b>Sinkron Tujuan &amp; Sasaran</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th style="width: 35%;">Indikator Kinerja Utama</th>
                                        <th class="text-center" style="width: 15%;">Periode</th>
                                        <th class="text-center" style="width: 9%;">Target <br><small>Tahun 1</small></th>
                                        <th class="text-center" style="width: 9%;">Target <br><small>Tahun 2</small></th>
                                        <th class="text-center" style="width: 9%;">Target <br><small>Tahun 3</small></th>
                                        <th class="text-center" style="width: 9%;">Target <br><small>Tahun 4</small></th>
                                        <th class="text-center" style="width: 9%;">Target <br><small>Tahun 5</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Iku as $key) { ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['indikator_tujuan']) ?></td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= (!empty($key['tahun_mulai']) && !empty($key['tahun_akhir'])) ? html_escape($key['tahun_mulai']) . ' - ' . html_escape($key['tahun_akhir']) : '-' ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= (isset($key['target_1']) && is_numeric($key['target_1'])) ? number_format((float)$key['target_1'], 2, '.', '') : (isset($key['target_1']) && $key['target_1'] !== '' ? html_escape(str_replace(',', '.', $key['target_1'])) : '-') ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= (isset($key['target_2']) && is_numeric($key['target_2'])) ? number_format((float)$key['target_2'], 2, '.', '') : (isset($key['target_2']) && $key['target_2'] !== '' ? html_escape(str_replace(',', '.', $key['target_2'])) : '-') ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= (isset($key['target_3']) && is_numeric($key['target_3'])) ? number_format((float)$key['target_3'], 2, '.', '') : (isset($key['target_3']) && $key['target_3'] !== '' ? html_escape(str_replace(',', '.', $key['target_3'])) : '-') ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= (isset($key['target_4']) && is_numeric($key['target_4'])) ? number_format((float)$key['target_4'], 2, '.', '') : (isset($key['target_4']) && $key['target_4'] !== '' ? html_escape(str_replace(',', '.', $key['target_4'])) : '-') ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= (isset($key['target_5']) && is_numeric($key['target_5'])) ? number_format((float)$key['target_5'], 2, '.', '') : (isset($key['target_5']) && $key['target_5'] !== '' ? html_escape(str_replace(',', '.', $key['target_5'])) : '-') ?>
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

    <!-- Modal Pilih Periode Sinkronisasi -->
    <div class="modal fade" id="ModalSinkronIku" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="ModalSinkronTitle"><i class="fa fa-refresh"></i> Sinkronisasi Data IKU</h4>
                </div>
                <div class="modal-body">
                    <form id="FormSinkronIku">
                        <input type="hidden" id="SinkronTipe" name="tipe" value="">
                        
                        <div class="alert alert-info" style="margin-bottom: 15px;">
                            <span id="SinkronKeterangan">Pilih periode tahun untuk melakukan sinkronisasi data dari VMTS.</span>
                        </div>

                        <div class="form-group">
                            <label for="SinkronPeriode"><b>Pilih Periode Tahun</b> <span class="text-danger">*</span></label>
                            <select class="form-control" id="SinkronPeriode" name="periode" required>
                                <option value="" selected disabled>-- Pilih Periode Tahun --</option>
                                <?php if (!empty($Periods)) { ?>
                                    <?php foreach ($Periods as $period) { ?>
                                        <option value="<?= html_escape($period['TahunMulai'] . '-' . $period['TahunAkhir']) ?>">
                                            <?= html_escape($period['TahunMulai'] . ' - ' . $period['TahunAkhir']) ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled>Belum ada data periode VMTS untuk wilayah ini</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" id="BtnProsesSinkron">
                                <i class="fa fa-cloud-download"></i> <b>Sinkronkan Sekarang</b>
                            </button>
                        </div>
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

            // Ketika salah satu dari 3 tombol sinkronisasi diklik
            $(".BtnBukaSinkron").click(function() {
                var tipe = $(this).data('tipe');
                var label = $(this).data('label');
                
                $("#SinkronTipe").val(tipe);
                $("#ModalSinkronTitle").html('<i class="fa fa-refresh"></i> ' + label + ' dari VMTS');
                
                var keterangan = "Sinkronisasi akan menarik data ";
                if (tipe === 'tujuan') {
                    keterangan += "<b>Indikator Tujuan</b>";
                } else if (tipe === 'sasaran') {
                    keterangan += "<b>Indikator Sasaran</b>";
                } else {
                    keterangan += "<b>Indikator Tujuan (di atas) dan Indikator Sasaran (di bawah)</b>";
                }
                keterangan += " untuk periode yang dipilih.";
                
                $("#SinkronKeterangan").html(keterangan);
                $("#SinkronPeriode").val('');
                $("#ModalSinkronIku").modal('show');
            });

            // Submit Form Sinkronisasi
            $("#FormSinkronIku").submit(function(e) {
                e.preventDefault();

                var tipe = $("#SinkronTipe").val();
                var periode = $("#SinkronPeriode").val();

                if (!periode) {
                    alert("Silakan pilih periode tahun terlebih dahulu!");
                    return false;
                }

                var btn = $("#BtnProsesSinkron");
                var originalHtml = btn.html();
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');

                $.ajax({
                    url: BaseURL + "Daerah/SinkronIku",
                    type: "POST",
                    data: {
                        tipe: tipe,
                        periode: periode,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(response) {
                        btn.prop('disabled', false).html(originalHtml);
                        if (response.status === 'success') {
                            $("#ModalSinkronIku").modal('hide');
                            alert(response.message);
                            location.reload();
                        } else if (response.status === 'warning') {
                            alert(response.message);
                        } else {
                            alert(response.message || "Gagal melakukan sinkronisasi data!");
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html(originalHtml);
                        alert("Terjadi kesalahan saat menghubungi server: " + error);
                    }
                });
            });
        });
    </script>
</div>
</body>
</html>