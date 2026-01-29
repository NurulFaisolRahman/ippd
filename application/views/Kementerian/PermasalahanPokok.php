<?php $this->load->view('Kementerian/Sidebar'); ?>

<div class="main-content">
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
                                <a href="<?= base_url('Kementerian/PermasalahanPokok') ?>">Isu</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block;">
                                <span class="bread-blk">Permasalahan Pokok</span>
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
                        <!-- Header dengan Button -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <!-- Tombol Filter hanya untuk Admin -->
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0): ?>
                                    <button type="button" class="btn btn-primary notika-btn-primary" id="FilterPermasalahanPokok">
                                        <i class="notika-icon notika-search"></i> 
                                        <b>Filter Data</b>
                                        <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                            <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                        <?php endif; ?>
                                    </button>
                                <?php endif; ?>
                                
                                <!-- Tombol Input untuk Kementerian -->
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                                    <button type="button" class="btn btn-success notika-btn-success" id="BtnInputPermasalahanPokok">
                                        <i class="notika-icon notika-edit"></i> <b>Input Permasalahan Pokok</b>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Informasi Periode untuk Kementerian -->
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1 && isset($UserKementerianName)): ?>
                        <div class="alert alert-info" style="margin-top: 15px; margin-bottom: 15px; padding: 10px 15px;">
                            <div style="display: flex; align-items: center;">
                                <i class="fa fa-info-circle" style="font-size: 18px; margin-right: 10px;"></i>
                                <div>
                                    <strong>Kementerian:</strong> <?= htmlspecialchars($UserKementerianName) ?><br>
                                    <?php if (isset($UserPeriode)): ?>
                                    <strong>Periode:</strong> <?= htmlspecialchars($UserPeriode) ?>
                                    <?php else: ?>
                                    <strong>Periode:</strong> <span style="color: #dc3545;">Belum ditentukan</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Modal Filter (hanya untuk Admin) -->
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0): ?>
                        <div class="modal fade" id="ModalFilter" role="dialog">
                            <div class="modal-dialog modals-default">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Filter Data Permasalahan Pokok</h4>
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
                        <?php endif; ?>

                        <!-- Tabel Data Permasalahan Pokok -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0): ?>
                                            <th width="25%">Kementerian</th>
                                        <?php endif; ?>
                                        <th width="<?= isset($_SESSION['Level']) && $_SESSION['Level'] == 0 ? '40%' : '65%' ?>">Permasalahan Pokok</th>
                                        <th width="20%" class="text-center">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                                            <th width="10%" class="text-center">Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $No = 1; 
                                    $userKementerianId = isset($_SESSION['IdKementerian']) ? $_SESSION['IdKementerian'] : null;
                                    $isKementerian = isset($_SESSION['Level']) && $_SESSION['Level'] == 1;
                                    $isAdmin = isset($_SESSION['Level']) && $_SESSION['Level'] == 0;
                                    
                                    // Hitung jumlah kolom
                                    $colspan = $isKementerian ? 4 : 5;
                                    
                                    if (!empty($PermasalahanPokok)): 
                                        foreach ($PermasalahanPokok as $key): 
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                        
                                        <?php if ($isAdmin): ?>
                                            <td style="vertical-align: middle;"><?= htmlspecialchars($key['NamaKementerian']) ?></td>
                                        <?php endif; ?>
                                        
                                        <td style="vertical-align: middle;"><?= htmlspecialchars($key['NamaPermasalahanPokok']) ?></td>
                                        
                                        <td style="vertical-align: middle;" class="text-center">
                                            <?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?>
                                        </td>
                                        
                                        <?php if ($isKementerian): ?>
                                        <td style="vertical-align: middle;" class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <?php if ($key['IdKementerian'] == $userKementerianId): ?>
                                                <button class="btn btn-sm btn-warning EditPermasalahanPokok" 
                                                    data-id="<?= $key['Id'] ?>"
                                                    title="Edit"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%; margin-right: 5px;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger HapusPermasalahanPokok" 
                                                    data-id="<?= $key['Id'] ?>"
                                                    data-nama="<?= htmlspecialchars($key['NamaPermasalahanPokok']) ?>"
                                                    title="Hapus"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <?php else: ?>
                                                <button class="btn btn-sm btn-default" disabled 
                                                    title="Data milik kementerian lain"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%; margin-right: 5px;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-default" disabled 
                                                    title="Data milik kementerian lain"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php 
                                        endforeach; 
                                    else: 
                                    ?>
                                    <tr>
                                        <td colspan="<?= $colspan ?>" class="text-center">
                                            <div class="alert alert-warning" style="margin: 10px 0;">
                                                <i class="fa fa-info-circle"></i> 
                                                <?php if ($isKementerian): ?>
                                                    Belum ada data Permasalahan Pokok. Silakan tambah data baru.
                                                <?php else: ?>
                                                    Tidak ada data ditemukan.
                                                <?php endif; ?>
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

    <!-- Modal Input Permasalahan Pokok (untuk Kementerian) -->
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
    <div class="modal fade" id="ModalInputPermasalahanPokok" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Input Permasalahan Pokok</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <!-- Informasi Kementerian dan Periode -->
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <div style="display: flex; align-items: flex-start;">
                                        <i class="fa fa-info-circle" style="font-size: 16px; margin-right: 10px; margin-top: 2px;"></i>
                                        <div>
                                            <strong>Kementerian:</strong> <?= htmlspecialchars($UserKementerianName) ?><br>
                                            <?php if (isset($UserPeriode)): ?>
                                            <strong>Periode:</strong> <?= htmlspecialchars($UserPeriode) ?>
                                            <?php else: ?>
                                            <strong>Periode:</strong> <span style="color: #dc3545;">Belum ditentukan</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label class="hrzn-fm"><b>Nama Permasalahan Pokok</b> <span class="text-danger">*</span></label>
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="NamaPermasalahanPokok" 
                                                           placeholder="Masukkan nama permasalahan pokok" required
                                                           style="height: 40px; font-size: 14px;">
                                                    <small class="text-muted">Contoh: Ketersediaan air bersih, Aksesibilitas transportasi, dll.</small>
                                                    <div class="error-message" id="InputError" style="color: red; display: none;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn btn-success notika-btn-success" id="InputPermasalahanPokokBtn" style="padding: 8px 20px;">
                                                <i class="fa fa-save"></i> SIMPAN
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 8px 20px;">
                                                <i class="fa fa-times"></i> BATAL
                                            </button>
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
    <?php endif; ?>

    <!-- Modal Edit Permasalahan Pokok (untuk Kementerian) -->
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
    <div class="modal fade" id="ModalEditPermasalahanPokok" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit Permasalahan Pokok</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <!-- Informasi Kementerian dan Periode -->
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <div style="display: flex; align-items: flex-start;">
                                        <i class="fa fa-info-circle" style="font-size: 16px; margin-right: 10px; margin-top: 2px;"></i>
                                        <div>
                                            <strong>Kementerian:</strong> <?= htmlspecialchars($UserKementerianName) ?><br>
                                            <?php if (isset($UserPeriode)): ?>
                                            <strong>Periode:</strong> <?= htmlspecialchars($UserPeriode) ?>
                                            <?php else: ?>
                                            <strong>Periode:</strong> <span style="color: #dc3545;">Belum ditentukan</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" id="EditId">
                                
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label class="hrzn-fm"><b>Nama Permasalahan Pokok</b> <span class="text-danger">*</span></label>
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="EditNamaPermasalahanPokok" 
                                                           placeholder="Masukkan nama permasalahan pokok" required
                                                           style="height: 40px; font-size: 14px;">
                                                    <div class="error-message" id="EditError" style="color: red; display: none;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn btn-success notika-btn-success" id="UpdatePermasalahanPokokBtn" style="padding: 8px 20px;">
                                                <i class="fa fa-save"></i> UPDATE
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 8px 20px;">
                                                <i class="fa fa-times"></i> BATAL
                                            </button>
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
    <?php endif; ?>

    <!-- Scripts -->
    <script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
    <!-- HAPUS INI: <script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script> -->

   <script>
$(document).ready(function () {

    /* =========================================================
     * GLOBAL
     * ========================================================= */
    const BaseURL = '<?= base_url() ?>';
    const UserLevel = <?= isset($_SESSION['Level']) ? (int)$_SESSION['Level'] : -1 ?>;
    const UserKementerianId = '<?= $_SESSION['IdKementerian'] ?? '' ?>';

    /* =========================================================
     * DATATABLE INIT (JANGAN DESTROY & EMPTY)
     * ========================================================= */
    if (!$.fn.DataTable.isDataTable('#data-table-basic')) {
        $('#data-table-basic').DataTable({
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            order: [],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                paginate: {
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: [
                {
                    // Level 1 → kolom No & Aksi
                    targets: UserLevel == 1 ? [0, 3] : [0],
                    orderable: false
                }
            ]
        });
    }

    /* =========================================================
     * INPUT PERMASALAHAN POKOK
     * ========================================================= */
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>

    $('#BtnInputPermasalahanPokok').on('click', function () {
        if (!UserKementerianId) {
            alert('Session tidak valid, silakan login ulang');
            window.location.href = BaseURL + 'Auth/Logout';
            return;
        }
        $('#NamaPermasalahanPokok').val('');
        $('#InputError').hide();
        $('#ModalInputPermasalahanPokok').modal('show');
    });

    $('#InputPermasalahanPokokBtn').on('click', function () {
        const nama = $('#NamaPermasalahanPokok').val().trim();

        if (!nama) {
            $('#InputError').text('Nama wajib diisi').show();
            return;
        }

        const btn = $(this);
        const text = btn.html();
        btn.prop('disabled', true).html('Menyimpan...');

        $.post(BaseURL + 'Kementerian/InputPermasalahanPokok', {
            NamaPermasalahanPokok: nama
        }).done(function (res) {
            try {
                const r = JSON.parse(res);
                if (r.success) {
                    alert(r.message);
                    location.reload();
                } else {
                    alert(r.message);
                }
            } catch {
                alert(res);
            }
        }).fail(function () {
            alert('Gagal koneksi ke server');
        }).always(function () {
            btn.prop('disabled', false).html(text);
        });
    });

    <?php endif; ?>

    /* =========================================================
     * EDIT PERMASALAHAN POKOK (FIXED)
     * ========================================================= */
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>

    $(document).on('click', '.EditPermasalahanPokok', function () {
        const id = $(this).data('id');

        if (!id) {
            alert('ID tidak valid');
            return;
        }

        $('#EditId').val('');
        $('#EditNamaPermasalahanPokok').val('');
        $('#EditError').hide();

        $.post(BaseURL + 'Kementerian/GetPermasalahanPokokById', {
            id: id
        }).done(function (res) {
            const r = JSON.parse(res);
            if (r.success) {
                $('#EditId').val(r.data.Id);
                $('#EditNamaPermasalahanPokok').val(r.data.NamaPermasalahanPokok);
                $('#ModalEditPermasalahanPokok').modal('show');
            } else {
                alert(r.message);
            }
        }).fail(function () {
            alert('Gagal memuat data');
        });
    });

    $('#UpdatePermasalahanPokokBtn').on('click', function () {
        const id = $('#EditId').val();
        const nama = $('#EditNamaPermasalahanPokok').val().trim();

        if (!id || !nama) {
            $('#EditError').text('Data tidak lengkap').show();
            return;
        }

        const btn = $(this);
        const text = btn.html();
        btn.prop('disabled', true).html('Mengupdate...');

        $.post(BaseURL + 'Kementerian/UpdatePermasalahanPokok', {
            Id: id,
            NamaPermasalahanPokok: nama
        }).done(function (res) {
            const r = JSON.parse(res);
            if (r.success) {
                alert(r.message);
                location.reload();
            } else {
                alert(r.message);
            }
        }).fail(function () {
            alert('Gagal update');
        }).always(function () {
            btn.prop('disabled', false).html(text);
        });
    });

    <?php endif; ?>

    /* =========================================================
     * HAPUS PERMASALAHAN POKOK (FIXED)
     * ========================================================= */
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>

    $(document).on('click', '.HapusPermasalahanPokok', function () {
        const id = $(this).data('id');
        const nama = $(this).data('nama');

        if (!id) {
            alert('ID tidak valid');
            return;
        }

        if (!confirm('Hapus "' + nama + '" ?')) return;

        $.post(BaseURL + 'Kementerian/DeletePermasalahanPokok', {
            Id: id
        }).done(function (res) {
            const r = JSON.parse(res);
            if (r.success) {
                alert(r.message);
                location.reload();
            } else {
                alert(r.message);
            }
        }).fail(function () {
            alert('Gagal menghapus data');
        });
    });

    <?php endif; ?>

    /* =========================================================
     * ENTER KEY HANDLER
     * ========================================================= */
    $('#NamaPermasalahanPokok').on('keypress', function (e) {
        if (e.which === 13) {
            $('#InputPermasalahanPokokBtn').click();
        }
    });

    $('#EditNamaPermasalahanPokok').on('keypress', function (e) {
        if (e.which === 13) {
            $('#UpdatePermasalahanPokokBtn').click();
        }
    });

});
</script>

</div>
</body>
</html>