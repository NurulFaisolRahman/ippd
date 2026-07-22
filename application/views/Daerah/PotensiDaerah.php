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
                                <!-- Menampilkan Wilayah setelah filter -->
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <?php 
                                        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                        $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                        if (empty($PotensiDaerah)) {
                                            $pesan_error = "Tidak ada data untuk wilayah: $nama_wilayah";
                                        }
                                    ?>
                                    <div class="alert <?= empty($PotensiDaerah) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                        <?php if (!empty($pesan_error)) { ?>
                                            <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputPotensiDaerah">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Input Potensi Daerah</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Potensi Daerah</th>
                                        <th>Periode</th>
                                        <th class="text-center" ><?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>Aksi<?php } ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($PotensiDaerah as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                        <td style="vertical-align: middle;"><?= html_escape($key['NamaPotensiDaerah']) ?></td>
                                        <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                        <td class="text-center align-middle">
    
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                           <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg EditPotensi" 
                                                        data-id="<?= $key['Id'] ?>" 
                                                        data-nama="<?= html_escape($key['NamaPotensiDaerah']) ?>" 
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>" 
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        data-periode="<?= $key['TahunMulai'] . '-' . $key['TahunAkhir'] ?>">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg HapusPotensi" data-id="<?= $key['Id'] ?>">
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

    <!-- Modal Input Potensi Daerah -->
    <div class="modal fade" id="ModalInputPotensiDaerah" role="dialog">
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
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJMD">
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" id="TahunMulai">
                                                    <input type="hidden" id="TahunAkhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Nama Potensi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="NamaPotensiDaerah" style="color: #000;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="InputPotensiDaerah"><b>SIMPAN</b></button>
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

    <!-- Modal Edit Potensi Daerah -->
    <div class="modal fade" id="ModalEditPotensiDaerah" role="dialog">
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
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPeriodeRPJMD">
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" id="EditTahunMulai">
                                                    <input type="hidden" id="EditTahunAkhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Nama Potensi</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="hidden" id="EditId">
                                                    <input type="text" class="form-control input-sm" id="EditNamaPotensiDaerah" style="color: #000;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="UpdatePotensiDaerah"><b>UPDATE</b></button>
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
        .form-control, .form-control option {
            color: #000 !important;
        }
        .modal-content {
            color: #000;
        }
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

        /* Button styles */
        .btn-amber {
            background: #ffc107;
            color: #212529;
        }
        .btn-amber:hover {
            background: #e0a800;
            color: #212529;
        }
    </style>

    <!-- SCRIPT - Gunakan CDN untuk menghindari 404 -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    
    <script>
        var BaseURL = '<?= base_url() ?>';
        var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
        var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

        // ============================================================
        // FUNCTION TO REFRESH PAGE
        // ============================================================
        function refreshPage() {
            window.location.reload();
        }

        jQuery(document).ready(function($) {
            // ============================================================
            // FILTER LOGIC (untuk pengguna belum login)
            // ============================================================
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                $("#Provinsi").change(function() {
                    if ($(this).val() === "") {
                        $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                        return;
                    }
                    $.ajax({
                        url: BaseURL + "Daerah/GetListKabKota",
                        type: "POST",
                        data: { 
                            Kode: $(this).val(), 
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                        },
                        beforeSend: function() { 
                            $("#KabKota").prop('disabled', true); 
                        },
                        success: function(Respon) {
                            try {
                                var Data = JSON.parse(Respon);
                                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                                if (Data.length > 0) {
                                    for (let i = 0; i < Data.length; i++) {
                                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                                    }
                                }
                                $("#KabKota").html(KabKota).prop('disabled', false);
                            } catch (e) {
                                $("#KabKota").prop('disabled', false);
                            }
                        },
                        error: function() {
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
                        data: { 
                            KodeWilayah: kodeWilayah, 
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                        },
                        beforeSend: function() { 
                            $("#Filter").prop('disabled', true).text('Memuat...'); 
                        },
                        success: function(Respon) {
                            try {
                                if (Respon === '1' || Respon === 'success') {
                                    window.location.href = BaseURL + "Daerah/PotensiDaerah";
                                } else {
                                    alert(Respon || "Gagal menyimpan filter wilayah!");
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
                        data: { 
                            Kode: kodeProv, 
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE 
                        },
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
                            } catch (e) {}
                        },
                        error: function() {}
                    });
                <?php } ?>
            <?php } ?>

            // ============================================================
            // SET TAHUN SAAT PERIODE DIPILIH (INPUT)
            // ============================================================
            $("#PeriodeRPJMD").change(function() {
                if ($(this).val()) {
                    var years = $(this).val().split('-');
                    $("#TahunMulai").val(years[0]);
                    $("#TahunAkhir").val(years[1]);
                }
            });

            // ============================================================
            // SET TAHUN SAAT PERIODE DIPILIH (EDIT)
            // ============================================================
            $("#EditPeriodeRPJMD").change(function() {
                if ($(this).val()) {
                    var years = $(this).val().split('-');
                    $("#EditTahunMulai").val(years[0]);
                    $("#EditTahunAkhir").val(years[1]);
                }
            });

            // ============================================================
            // INPUT POTENSI DAERAH - LANGSUNG REFRESH
            // ============================================================
            $("#InputPotensiDaerah").click(function() {
                if ($("#PeriodeRPJMD").val() === "") {
                    alert('Pilih Periode RPJMD terlebih dahulu!');
                    return;
                }
                if ($("#NamaPotensiDaerah").val() === "") {
                    alert('Nama Potensi Daerah harus diisi!');
                    return;
                }

                var Data = {
                    PeriodeRPJMD: $("#PeriodeRPJMD").val(),
                    NamaPotensiDaerah: $("#NamaPotensiDaerah").val(),
                    TahunMulai: $("#TahunMulai").val(),
                    TahunAkhir: $("#TahunAkhir").val(),
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                };

                $.ajax({
                    url: BaseURL + "Daerah/InputPotensiDaerah",
                    type: "POST",
                    data: Data,
                    beforeSend: function() {
                        $("#InputPotensiDaerah").prop('disabled', true).html('<b>Menyimpan...</b>');
                    },
                    success: function(Respon) {
                        $("#PeriodeRPJMD").val('').trigger('change');
                        $("#NamaPotensiDaerah").val('');
                        $("#TahunMulai").val('');
                        $("#TahunAkhir").val('');
                        $('#ModalInputPotensiDaerah').modal('hide');
                        refreshPage();
                    },
                    error: function() {
                        $('#ModalInputPotensiDaerah').modal('hide');
                        refreshPage();
                    },
                    complete: function() {
                        $("#InputPotensiDaerah").prop('disabled', false).html('<b>SIMPAN</b>');
                    }
                });
            });

            // ============================================================
            // EDIT POTENSI DAERAH - LOAD DATA
            // ============================================================
            $(document).on("click", ".EditPotensi", function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var tahunmulai = $(this).data('tahunmulai');
                var tahunakhir = $(this).data('tahunakhir');
                var periode = $(this).data('periode');

                $("#EditId").val(id);
                $("#EditNamaPotensiDaerah").val(nama);
                $("#EditPeriodeRPJMD").val(periode);
                $("#EditTahunMulai").val(tahunmulai);
                $("#EditTahunAkhir").val(tahunakhir);

                $('#ModalEditPotensiDaerah').modal("show");
            });

            // ============================================================
            // UPDATE POTENSI DAERAH - LANGSUNG REFRESH
            // ============================================================
            $("#UpdatePotensiDaerah").click(function() {
                if ($("#EditPeriodeRPJMD").val() === "") {
                    alert('Pilih Periode RPJMD terlebih dahulu!');
                    return;
                }
                if ($("#EditNamaPotensiDaerah").val() === "") {
                    alert('Nama Potensi Daerah harus diisi!');
                    return;
                }

                var Data = {
                    Id: $("#EditId").val(),
                    PeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
                    NamaPotensiDaerah: $("#EditNamaPotensiDaerah").val(),
                    TahunMulai: $("#EditTahunMulai").val(),
                    TahunAkhir: $("#EditTahunAkhir").val(),
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                };

                $.ajax({
                    url: BaseURL + "Daerah/UpdatePotensiDaerah",
                    type: "POST",
                    data: Data,
                    beforeSend: function() {
                        $("#UpdatePotensiDaerah").prop('disabled', true).html('<b>Menyimpan...</b>');
                    },
                    success: function(Respon) {
                        $('#ModalEditPotensiDaerah').modal('hide');
                        refreshPage();
                    },
                    error: function() {
                        $('#ModalEditPotensiDaerah').modal('hide');
                        refreshPage();
                    },
                    complete: function() {
                        $("#UpdatePotensiDaerah").prop('disabled', false).html('<b>UPDATE</b>');
                    }
                });
            });

            // ============================================================
            // HAPUS POTENSI DAERAH - LANGSUNG REFRESH
            // ============================================================
            $(".HapusPotensi").click(function() {
                if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    return;
                }
                
                var Data = { 
                    Id: $(this).data('id'),
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                };
                
                $.ajax({
                    url: BaseURL + "Daerah/DeletePotensiDaerah",
                    type: "POST",
                    data: Data,
                    beforeSend: function() {
                        $(this).prop('disabled', true);
                    },
                    success: function(Respon) {
                        refreshPage();
                    },
                    error: function() {
                        refreshPage();
                    }
                });
            });

            // ============================================================
            // RESET FORM SAAT MODAL DITUTUP
            // ============================================================
            $('#ModalInputPotensiDaerah').on('hidden.bs.modal', function () {
                $("#PeriodeRPJMD").val('').trigger('change');
                $("#NamaPotensiDaerah").val('');
                $("#TahunMulai").val('');
                $("#TahunAkhir").val('');
            });

            $('#ModalEditPotensiDaerah').on('hidden.bs.modal', function () {
                $("#EditPeriodeRPJMD").val('').trigger('change');
                $("#EditNamaPotensiDaerah").val('');
                $("#EditTahunMulai").val('');
                $("#EditTahunAkhir").val('');
                $("#EditId").val('');
            });
        });
    </script>
</div>
</body>
</html>