<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
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

                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTahapan">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Tahapan RPJMD</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 70%;">Tahapan RPJMD</th>
                                        <th style="width: 10%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width: 10%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Tahapan as $key) { ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['Tahapan']) ?></td>
                                            <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td class="text-center">
                                                    <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                        <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                                data-id="<?= $key['Id'] ?>" 
                                                                data-tahapan="<?= html_escape($key['Tahapan']) ?>" 
                                                                data-visi="<?= $key['_Id'] ?>">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                                data-id="<?= $key['Id'] ?>">
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

    <!-- Modal Input Tahapan -->
    <div class="modal fade" id="ModalInputTahapan" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tahapan RPJMD</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Periode">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?= $key['Id'] ?>"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></option>
                                                    <?php } ?>
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
                                            <label class="hrzn-fm"><b>Tahapan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="Tahapan" placeholder="Input Tahapan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
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

    <!-- Modal Edit Tahapan -->
    <div class="modal fade" id="ModalEditTahapan" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Tahapan RPJMD</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Periode">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?= $key['Id'] ?>"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></option>
                                                    <?php } ?>
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
                                            <label class="hrzn-fm"><b>Tahapan</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <input type="hidden" class="form-control input-sm" id="Id">
                                                <textarea class="form-control" rows="3" id="_Tahapan" placeholder="Input Tahapan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="Edit"><b>UPDATE</b></button>
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
                                    window.location.href = BaseURL + "Daerah/TahapanRPJMD";
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
            // INPUT TAHAPAN - LANGSUNG REFRESH
            // ============================================================
            $("#Input").click(function() {
                if ($("#Periode").val() == "") {
                    alert("Mohon Pilih Periode");
                    return;
                }
                if ($("#Tahapan").val() == "") {
                    alert("Tahapan harus diisi!");
                    return;
                }

                var Data = {
                    Tahapan: $("#Tahapan").val(),
                    _Id: $("#Periode").val(),
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                };

                $.ajax({
                    url: BaseURL + "Daerah/InputTahapanRPJMD",
                    type: "POST",
                    data: Data,
                    beforeSend: function() {
                        $("#Input").prop('disabled', true).html('<b>Menyimpan...</b>');
                    },
                    success: function(Respon) {
                        $("#Periode").val('');
                        $("#Tahapan").val('');
                        $('#ModalInputTahapan').modal('hide');
                        refreshPage();
                    },
                    error: function() {
                        $('#ModalInputTahapan').modal('hide');
                        refreshPage();
                    },
                    complete: function() {
                        $("#Input").prop('disabled', false).html('<b>SIMPAN</b>');
                    }
                });
            });

            // ============================================================
            // EDIT TAHAPAN - LOAD DATA
            // ============================================================
            $(document).on("click", ".Edit", function() {
                var id = $(this).data('id');
                var tahapan = $(this).data('tahapan');
                var visi = $(this).data('visi');

                $("#Id").val(id);
                $("#_Tahapan").val(tahapan);
                $("#_Periode").val(visi);

                $('#ModalEditTahapan').modal("show");
            });

            // ============================================================
            // UPDATE TAHAPAN - LANGSUNG REFRESH
            // ============================================================
            $("#Edit").click(function() {
                if ($("#_Periode").val() == "") {
                    alert("Mohon Pilih Periode");
                    return;
                }
                if ($("#_Tahapan").val() == "") {
                    alert("Tahapan harus diisi!");
                    return;
                }

                var Data = {
                    Id: $("#Id").val(),
                    Tahapan: $("#_Tahapan").val(),
                    _Id: $("#_Periode").val(),
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                };

                $.ajax({
                    url: BaseURL + "Daerah/EditTahapanRPJMD",
                    type: "POST",
                    data: Data,
                    beforeSend: function() {
                        $("#Edit").prop('disabled', true).html('<b>Menyimpan...</b>');
                    },
                    success: function(Respon) {
                        $('#ModalEditTahapan').modal('hide');
                        refreshPage();
                    },
                    error: function() {
                        $('#ModalEditTahapan').modal('hide');
                        refreshPage();
                    },
                    complete: function() {
                        $("#Edit").prop('disabled', false).html('<b>UPDATE</b>');
                    }
                });
            });

            // ============================================================
            // HAPUS TAHAPAN - LANGSUNG REFRESH
            // ============================================================
            $(document).on('click', '.Hapus', function() {
                if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    return;
                }

                var Data = {
                    Id: $(this).data('id'),
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                };

                $.ajax({
                    url: BaseURL + "Daerah/HapusTahapanRPJMD",
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
            $('#ModalInputTahapan').on('hidden.bs.modal', function() {
                $("#Periode").val('');
                $("#Tahapan").val('');
            });

            $('#ModalEditTahapan').on('hidden.bs.modal', function() {
                $("#_Periode").val('');
                $("#_Tahapan").val('');
                $("#Id").val('');
            });
        });
    </script>
</div>
</body>
</html>