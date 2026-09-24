<style>
    /* CSS Modal Vertical Center */
    .modal {
        text-align: center;
        padding: 0!important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        width: 750px; 
        max-width: 95%; 
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /* CSS Card Container */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
        margin-bottom: 30px;
    }

    /* Header Tabel 1 Baris Sesuai Desain */
    .tahapan-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #d99b26;
        border-radius: 6px;
        overflow: hidden;
    }
    .tahapan-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #111827;
        font-weight: 700;
        font-size: 13.5px;
        line-height: 1.45;
        border-top: 3px solid #d99b26 !important;
        border-bottom: 2px solid #d99b26 !important;
        border-right: 1px solid #d99b26;
        border-left: none;
        vertical-align: middle;
        padding: 14px 12px;
        text-align: center;
    }
    .tahapan-table > thead > tr > th:last-child {
        border-right: none;
    }
    .tahapan-table > tbody > tr > td {
        vertical-align: top;
        color: #374151;
        font-size: 13.5px;
        line-height: 1.55;
        border-top: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        padding: 14px 16px;
        background-color: #ffffff;
    }
    .tahapan-table > tbody > tr > td:last-child {
        border-right: none;
    }
    .tahapan-table > tbody > tr:hover > td {
        background-color: #fdfaf3;
    }

    /* Button Action & Group */
    .btn-action {
        border-radius: 5px;
        margin: 0;
        transition: all 0.3s ease;
        padding: 5px 10px;
        font-weight: 600;
        white-space: nowrap;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .btn-action-group {
        display: inline-flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        flex-wrap: nowrap;
    }
    .td-aksi {
        white-space: nowrap !important;
        vertical-align: middle !important;
    }

    .badge-periode {
        background-color: #00c292;
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }
</style>

<div class="data-table-area">
    <div class="container">
        
        <!-- Judul Halaman Utama -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="background: #ffffff; border-radius: 10px; padding: 20px 25px; margin-bottom: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                    <div>
                        <h2 style="margin: 0; color: #2c3e50; font-weight: 700; font-size: 22px;">
                            <i class="fa fa-tasks" style="color: #00c292; margin-right: 8px;"></i> Tahapan Pembangunan RPJPN
                        </h2>
                        <p style="margin: 5px 0 0 0; color: #7f8c8d; font-size: 13px;">
                            Tahapan Pembangunan Jangka Panjang Nasional Menuju Indonesia Emas 2045
                        </p>
                    </div>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                    <div>
                        <button type="button" class="btn btn-success notika-btn-success btn-action BtnTambahTahapan" data-toggle="modal" data-target="#ModalInputTahapan" style="padding: 9px 18px;">
                            <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Tahapan Pembangunan</b>
                        </button>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- 1 TABEL TAHAPAN PEMBANGUNAN -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="table-tahapan-rpjpn" class="table tahapan-table">
                            <thead>
                                <tr>
                                    <th style="width: 4%;" class="text-center">No</th>
                                    <th style="width: 20%;">
                                        Nama Tahap Pembangunan
                                    </th>
                                    <th style="width: 17%;">
                                        Tahap 1 (2025-2029)<br>
                                        Penguatan Fondasi Transformasi
                                    </th>
                                    <th style="width: 17%;">
                                        Tahap 2 (2030-2034)<br>
                                        Akselerasi Transformasi
                                    </th>
                                    <th style="width: 17%;">
                                        Tahap 3 (2035-2039)<br>
                                        Ekspansi Global
                                    </th>
                                    <th style="width: 17%;">
                                        Tahap 4 (2040-2045)<br>
                                        Perwujudan Indonesia Emas
                                    </th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 8%; white-space: nowrap;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!empty($Tahapan)) {
                                    $no = 1;
                                    foreach ($Tahapan as $item) {
                                ?>
                                    <tr>
                                        <td class="text-center" style="font-size: 14px; font-weight: 600; vertical-align: middle;">
                                            <?= $no ?>
                                        </td>
                                        <td style="font-weight: 600; color: #1e293b;">
                                            <?= !empty($item['Tahapan']) ? nl2br(htmlspecialchars($item['Tahapan'])) : (!empty($item['Tahap']) ? htmlspecialchars($item['Tahap']) : '-') ?>
                                        </td>
                                        <td>
                                            <?= !empty($item['Tahap1']) ? nl2br(htmlspecialchars($item['Tahap1'])) : '-' ?>
                                        </td>
                                        <td>
                                            <?= !empty($item['Tahap2']) ? nl2br(htmlspecialchars($item['Tahap2'])) : '-' ?>
                                        </td>
                                        <td>
                                            <?= !empty($item['Tahap3']) ? nl2br(htmlspecialchars($item['Tahap3'])) : '-' ?>
                                        </td>
                                        <td>
                                            <?= !empty($item['Tahap4']) ? nl2br(htmlspecialchars($item['Tahap4'])) : '-' ?>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center td-aksi">
                                            <div class="btn-action-group">
                                                <button class="btn btn-sm btn-info EditTahapan btn-action" 
                                                    data-id="<?= $item['Id'] ?>" 
                                                    data-periode="<?= htmlspecialchars($item['Periode'] ?? '', ENT_QUOTES) ?>" 
                                                    data-tahapan="<?= htmlspecialchars($item['Tahapan'] ?? ($item['Tahap'] ?? ''), ENT_QUOTES) ?>" 
                                                    data-tahap1="<?= htmlspecialchars($item['Tahap1'] ?? '', ENT_QUOTES) ?>" 
                                                    data-tahap2="<?= htmlspecialchars($item['Tahap2'] ?? '', ENT_QUOTES) ?>" 
                                                    data-tahap3="<?= htmlspecialchars($item['Tahap3'] ?? '', ENT_QUOTES) ?>" 
                                                    data-tahap4="<?= htmlspecialchars($item['Tahap4'] ?? '', ENT_QUOTES) ?>" 
                                                    title="Edit Data">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger HapusTahapan btn-action" data-id="<?= $item['Id'] ?>" title="Hapus Data">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php 
                                        $no++;
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) ? '7' : '6' ?>" class="text-center" style="padding: 30px; color: #999;">
                                            Belum ada data Tahapan Pembangunan RPJPN.
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

<!-- ============================================== -->
<!-- MODAL INPUT TAHAPAN PEMBANGUNAN                -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputTahapan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Tahapan Pembangunan RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 5px;">Nama Tahap Pembangunan</label>
                            <textarea class="form-control" id="Tahapan" rows="2" style="resize: vertical;" placeholder="Contoh: Transformasi Sosial / Nama Tahap Pembangunan"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 5px;">Periode</label>
                            <input type="text" class="form-control" id="Periode" value="2025-2045" placeholder="Contoh: 2025-2045">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #1e88e5; font-weight: 600; margin-bottom: 5px;">Tahap 1 (2025-2029): Penguatan Fondasi Transformasi</label>
                            <textarea class="form-control" id="Tahap1" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 1"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #00897b; font-weight: 600; margin-bottom: 5px;">Tahap 2 (2030-2034): Akselerasi Transformasi</label>
                            <textarea class="form-control" id="Tahap2" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #f57c00; font-weight: 600; margin-bottom: 5px;">Tahap 3 (2035-2039): Ekspansi Global</label>
                            <textarea class="form-control" id="Tahap3" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 3"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #7b1fa2; font-weight: 600; margin-bottom: 5px;">Tahap 4 (2040-2045): Perwujudan Indonesia Emas</label>
                            <textarea class="form-control" id="Tahap4" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanTahapan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT TAHAPAN PEMBANGUNAN                  -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditTahapan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Tahapan Pembangunan RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdTahapanForm">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 5px;">Nama Tahap Pembangunan</label>
                            <textarea class="form-control" id="_TahapanEdit" rows="2" style="resize: vertical;" placeholder="Contoh: Transformasi Sosial / Nama Tahap Pembangunan"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 5px;">Periode</label>
                            <input type="text" class="form-control" id="_PeriodeEdit" placeholder="Contoh: 2025-2045">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #1e88e5; font-weight: 600; margin-bottom: 5px;">Tahap 1 (2025-2029): Penguatan Fondasi Transformasi</label>
                            <textarea class="form-control" id="_Tahap1Edit" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 1"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #00897b; font-weight: 600; margin-bottom: 5px;">Tahap 2 (2030-2034): Akselerasi Transformasi</label>
                            <textarea class="form-control" id="_Tahap2Edit" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #f57c00; font-weight: 600; margin-bottom: 5px;">Tahap 3 (2035-2039): Ekspansi Global</label>
                            <textarea class="form-control" id="_Tahap3Edit" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 3"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label style="font-size: 12px; color: #7b1fa2; font-weight: 600; margin-bottom: 5px;">Tahap 4 (2040-2045): Perwujudan Indonesia Emas</label>
                            <textarea class="form-control" id="_Tahap4Edit" rows="3" style="resize: vertical;" placeholder="Uraian Tahap 4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnTahapan"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
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
    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>';

        $('.BtnTambahTahapan').click(function() {
            $('#Tahapan').val('');
            $('#Periode').val('2025-2045');
            $('#Tahap1').val('');
            $('#Tahap2').val('');
            $('#Tahap3').val('');
            $('#Tahap4').val('');
        });

        // ==============================================
        // SCRIPT SIMPAN TAHAPAN
        // ==============================================
        $("#SimpanTahapan").click(function() {
            var tahapan = $("#Tahapan").val().trim();
            var tahap1 = $("#Tahap1").val().trim();
            var tahap2 = $("#Tahap2").val().trim();
            var tahap3 = $("#Tahap3").val().trim();
            var tahap4 = $("#Tahap4").val().trim();

            if (tahapan == "" && tahap1 == "" && tahap2 == "" && tahap3 == "" && tahap4 == "") {
                alert('Silakan isi Nama Tahap Pembangunan atau minimal salah satu uraian Tahap!');
                return;
            }

            var Data = { 
                Tahapan : tahapan,
                Periode : $("#Periode").val().trim(),
                Tahap1  : tahap1,
                Tahap2  : tahap2,
                Tahap3  : tahap3,
                Tahap4  : tahap4
            };

            $.post(BaseURL + "Nasional/InputTahapanRPJPN", Data).done(function(Respon) {
                if (Respon == '1') { 
                    window.location.reload(); 
                } else { 
                    alert(Respon); 
                }
            });                         
        });

        $('.tahapan-table tbody').on('click', '.EditTahapan', function () {
            $("#IdTahapanForm").val($(this).data('id'));
            $("#_TahapanEdit").val($(this).data('tahapan'));
            $("#_PeriodeEdit").val($(this).data('periode'));
            $("#_Tahap1Edit").val($(this).data('tahap1'));
            $("#_Tahap2Edit").val($(this).data('tahap2'));
            $("#_Tahap3Edit").val($(this).data('tahap3'));
            $("#_Tahap4Edit").val($(this).data('tahap4'));
            $('#ModalEditTahapan').modal("show");
        });

        $("#EditBtnTahapan").click(function() {
            var tahapan = $("#_TahapanEdit").val().trim();
            var tahap1 = $("#_Tahap1Edit").val().trim();
            var tahap2 = $("#_Tahap2Edit").val().trim();
            var tahap3 = $("#_Tahap3Edit").val().trim();
            var tahap4 = $("#_Tahap4Edit").val().trim();

            if (tahapan == "" && tahap1 == "" && tahap2 == "" && tahap3 == "" && tahap4 == "") {
                alert('Silakan isi Nama Tahap Pembangunan atau minimal salah satu uraian Tahap!');
                return;
            }

            var Data = { 
                Id      : $("#IdTahapanForm").val(),
                Tahapan : tahapan,
                Periode : $("#_PeriodeEdit").val().trim(),
                Tahap1  : tahap1,
                Tahap2  : tahap2,
                Tahap3  : tahap3,
                Tahap4  : tahap4
            };

            $.post(BaseURL + "Nasional/EditTahapanRPJPN", Data).done(function(Respon) {
                if (Respon == '1') { 
                    window.location.reload(); 
                } else { 
                    alert(Respon); 
                }
            });                         
        });

        $('.tahapan-table tbody').on('click', '.HapusTahapan', function () {
            if (confirm("Yakin ingin menghapus baris data Tahapan Pembangunan ini?")) {
                var Data = { Id: $(this).data('id') };
                $.post(BaseURL + "Nasional/HapusTahapanRPJPN", Data).done(function(Respon) {
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