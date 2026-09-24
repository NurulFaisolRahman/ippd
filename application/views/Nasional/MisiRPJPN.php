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
        width: 600px; 
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

    /* Card Header Custom for 3 Categories */
    .category-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .category-title {
        font-size: 17px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .category-badge-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 16px;
    }

    /* CSS Table */
    .misi-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    .misi-table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    .misi-table > tbody > tr {
        transition: filter 0.2s ease;
    }
    .misi-table > tbody > tr:hover {
        filter: brightness(0.96);
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
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 194, 146, 0.3);
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
                            <i class="fa fa-compass" style="color: #00c292; margin-right: 8px;"></i> Misi Pembangunan RPJPN
                        </h2>
                        <p style="margin: 5px 0 0 0; color: #7f8c8d; font-size: 13px;">
                            8 Agenda Pembangunan Nasional terbagi ke dalam 3 Kategori Transformasi Indonesia Emas 2045
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        // Definisi metadata visual untuk 3 Kategori
        $kategoriConfig = [
            'Transformasi Indonesia' => [
                'icon'        => 'fa-rocket',
                'bg_color'    => '#1e88e5',
                'title_color' => '#1565c0',
                'border_misi' => '#1e88e5',
                'bg_misi'     => '#e3f2fd',
                'table_id'    => 'table-kat-1',
                'desc'        => 'Transformasi Sosial, Transformasi Ekonomi, dan Transformasi Tata Kelola'
            ],
            'Landasan Transformasi' => [
                'icon'        => 'fa-shield',
                'bg_color'    => '#2e7d32',
                'title_color' => '#1b5e20',
                'border_misi' => '#2e7d32',
                'bg_misi'     => '#e8f5e9',
                'table_id'    => 'table-kat-2',
                'desc'        => 'Supremasi Hukum, Stabilitas, Kepemimpinan, dan Ketahanan Sosial Budaya & Ekologi'
            ],
            'Kerangka Implementasi Transformasi' => [
                'icon'        => 'fa-cubes',
                'bg_color'    => '#7b1fa2',
                'title_color' => '#4a148c',
                'border_misi' => '#7b1fa2',
                'bg_misi'     => '#f3e5f5',
                'table_id'    => 'table-kat-3',
                'desc'        => 'Pembangunan Kewilayahan, Sarana Prasarana, dan Kesinambungan Pembangunan'
            ]
        ];

        $katIndex = 1;
        foreach ($KategoriList as $kategoriName) { 
            $config = isset($kategoriConfig[$kategoriName]) ? $kategoriConfig[$kategoriName] : [
                'icon'        => 'fa-list',
                'bg_color'    => '#00c292',
                'title_color' => '#333',
                'border_misi' => '#00c292',
                'bg_misi'     => '#f1f8e9',
                'table_id'    => 'table-kat-' . $katIndex,
                'desc'        => ''
            ];
            $listMisi = isset($MisiGrouped[$kategoriName]) ? $MisiGrouped[$kategoriName] : [];
        ?>

        <!-- TABEL KATEGORI: <?= htmlspecialchars($kategoriName) ?> -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Header Kategori -->
                    <div class="category-header">
                        <div>
                            <h3 class="category-title" style="color: <?= $config['title_color'] ?>;">
                                <span class="category-badge-icon" style="background-color: <?= $config['bg_color'] ?>;">
                                    <i class="fa <?= $config['icon'] ?>"></i>
                                </span>
                                <?= $katIndex ?>. <?= htmlspecialchars($kategoriName) ?>
                            </h3>
                            <small style="color: #888; margin-left: 48px; display: block; margin-top: 3px;">
                                <?= $config['desc'] ?>
                            </small>
                        </div>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                        <div class="button-icon-btn">
                            <button type="button" class="btn btn-sm btn-action BtnTambahMisiKategori" data-kategori="<?= htmlspecialchars($kategoriName, ENT_QUOTES) ?>" style="background-color: <?= $config['bg_color'] ?>; color: #fff; padding: 7px 14px;">
                                <i class="fa fa-plus"></i> Tambah Misi <?= htmlspecialchars($kategoriName) ?>
                            </button>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="table-responsive">
                        <table id="<?= $config['table_id'] ?>" class="table table-striped misi-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 65%;">Uraian Misi</th>
                                    <th style="width: 15%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 15%; white-space: nowrap;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!empty($listMisi)) {
                                    $noMisi = 1;
                                    foreach ($listMisi as $misi) {
                                ?>
                                    <!-- BARIS MISI -->
                                    <tr style="background-color: <?= $config['bg_misi'] ?>;">
                                        <td class="text-center" style="font-size: 14px;"><b><?= $noMisi ?></b></td>
                                        <td style="font-size: 14px; border-left: 3px solid <?= $config['border_misi'] ?>;">
                                            <b style="color: <?= $config['title_color'] ?>;">MISI:</b> <?= htmlspecialchars($misi['Misi']) ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-periode"><?= $misi['Periode'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                        <td class="text-center td-aksi">
                                            <div class="btn-action-group">
                                                <button class="btn btn-sm btn-info EditMisi btn-action" data-id="<?= $misi['Id'] ?>" data-periode="<?= htmlspecialchars($misi['Periode'], ENT_QUOTES) ?>" data-kategori="<?= htmlspecialchars($misi['Kategori'], ENT_QUOTES) ?>" data-misi="<?= htmlspecialchars($misi['Misi'], ENT_QUOTES) ?>" title="Edit Misi"><i class="fa fa-edit"></i> Edit</button>
                                                <button class="btn btn-sm btn-danger HapusMisi btn-action" data-id="<?= $misi['Id'] ?>" title="Hapus Misi"><i class="fa fa-trash"></i> Hapus</button>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php 
                                        $noMisi++;
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 25px; color: #999;">Belum ada data Misi pada kategori ini.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $katIndex++;
        } 
        ?>

    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT MISI -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputMisi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Misi RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="KategoriMisi">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 5px; display: block;">Kategori Transformasi</label>
                        <div id="DisplayKategoriMisi" style="font-size: 14px; font-weight: 700; padding: 10px 14px; background: #f8fafc; border-radius: 6px; border-left: 4px solid #00c292; color: #1e293b;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <label style="font-size: 11px; color: #888;">Periode</label>
                                <input type="text" class="form-control" id="Periode" placeholder="Contoh: 2025-2045">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Misi" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanMisi"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditMisi" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Misi RPJPN</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdMisiForm">
                <input type="hidden" id="_KategoriMisiEdit">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 5px; display: block;">Kategori Transformasi</label>
                        <div id="DisplayKategoriMisiEdit" style="font-size: 14px; font-weight: 700; padding: 10px 14px; background: #f8fafc; border-radius: 6px; border-left: 4px solid #00c292; color: #1e293b;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="nk-int-st">
                                <label style="font-size: 11px; color: #888;">Periode</label>
                                <input type="text" class="form-control" id="_PeriodeEdit" placeholder="Contoh: 2025-2045">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_MisiEdit" rows="3" style="resize: vertical;" placeholder="Uraian Misi RPJPN"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnMisi"><i class="fa fa-save"></i> Update</button>
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

        // Trigger Modal Tambah Misi dari tombol masing-masing Kategori
        $('.BtnTambahMisiKategori').click(function() {
            var kat = $(this).data('kategori');
            $('#KategoriMisi').val(kat);
            $('#DisplayKategoriMisi').text(kat);
            $('#Periode').val('');
            $('#Misi').val('');
            $('#ModalInputMisi').modal('show');
        });

        // ==============================================
        // SCRIPT MISI
        // ==============================================
        $("#SimpanMisi").click(function() {
            if ($("#Periode").val().trim() == "") {
                alert('Input Periode Belum Benar!');
            } else if ($("#Misi").val().trim() == "") {
                alert('Input Misi Belum Benar!');
            } else {
                var MisiData = { 
                    Periode  : $("#Periode").val().trim(),
                    Kategori : $("#KategoriMisi").val(),
                    Misi     : $("#Misi").val().trim() 
                };
                $.post(BaseURL + "Nasional/InputMisiRPJPN", MisiData).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('.misi-table tbody').on('click', '.EditMisi', function () {
            var kat = $(this).data('kategori');
            $("#IdMisiForm").val($(this).data('id'));
            $("#_PeriodeEdit").val($(this).data('periode'));
            $("#_KategoriMisiEdit").val(kat);
            $("#DisplayKategoriMisiEdit").text(kat);
            $("#_MisiEdit").val($(this).data('misi'));
            $('#ModalEditMisi').modal("show");
        });

        $("#EditBtnMisi").click(function() {
            if ($("#_PeriodeEdit").val().trim() == "") {
                alert('Input Periode Belum Benar!');
            } else if ($("#_MisiEdit").val().trim() == "") {
                alert('Input Misi Belum Benar!');
            } else {
                var MisiData = { 
                    Id       : $("#IdMisiForm").val(),
                    Periode  : $("#_PeriodeEdit").val().trim(),
                    Kategori : $("#_KategoriMisiEdit").val(),
                    Misi     : $("#_MisiEdit").val().trim() 
                };
                $.post(BaseURL + "Nasional/EditMisiRPJPN", MisiData).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });                         
            }
        });

        $('.misi-table tbody').on('click', '.HapusMisi', function () {
            if(confirm("Yakin ingin menghapus Misi ini?")) {
                var MisiData = { Id: $(this).data('id') };
                $.post(BaseURL + "Nasional/HapusMisiRPJPN", MisiData).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon); }
                });
            }
        });
    });
</script>
