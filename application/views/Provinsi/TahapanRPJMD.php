<style>
    /* CSS untuk membuat Modal persis di tengah (Vertical Center) */
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

    /* CSS Card Container Enhancement */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    /* CSS Table Enhancement */
    #hierarki-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #hierarki-table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    
    /* Efek hover baris tabel hierarki */
    #hierarki-table > tbody > tr {
        transition: filter 0.2s ease;
    }
    #hierarki-table > tbody > tr:hover {
        filter: brightness(0.96); /* Menggelapkan sedikit baris saat di-hover tanpa merusak warna latar bawaan */
    }

    /* CSS Button & Badge Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0 2px;
        transition: all 0.3s ease;
        padding: 5px 10px;
        font-weight: 600;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Penyesuaian Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Hierarki Tahapan RPJMD</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <!-- Tombol Input Induk Level 1 -->
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputTahapan" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Tahapan RPJMD</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <!-- Menggunakan class table standar, tanpa datatable-basic default agar custom toggle berfungsi baik -->
                        <table id="hierarki-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 50%;">Uraian (Tahapan / Sub Tahapan / Pembangunan)</th>
                                    <th style="width: 15%;" class="text-center">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                    <th style="width: 30%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                /* LOGIKA FOREACH BERSARANG DENGAN PENOMORAN OTOMATIS */
                                if(isset($Tahapan) && count($Tahapan) > 0) {
                                    $noTahapan = 1;
                                    foreach ($Tahapan as $tahapan) { 
                                ?>
                                    <!-- LEVEL 1: TAHAPAN RPJMD -->
                                    <tr data-id="tahapan-<?= $tahapan['Id'] ?>" data-parent="" data-expanded="false" style="background-color: #f1f8e9;">
                                        <td class="text-center" style="font-size: 14px;"><b><?= $noTahapan ?></b></td>
                                        <!-- Teks dibuat bisa diklik tanpa icon + / - -->
                                        <td style="cursor: pointer; font-size: 14px; border-left: 3px solid #8bc34a;" onclick="toggleLevel('tahapan-<?= $tahapan['Id'] ?>', this)">
                                            <b>TAHAPAN:</b> <?= $tahapan['Tahapan'] ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-periode"><?= $tahapan['TahunMulai'].'-'.$tahapan['TahunAkhir'] ?></span>
                                        </td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                        <td class="text-center">
                                            <!-- Tombol Aksi di baris Tahapan -->
                                            <button class="btn btn-sm btn-success TambahSubTahapan btn-action" data-id="<?= $tahapan['Id'] ?>" title="Tambah Sub Tahapan"><i class="fa fa-plus"></i> Sub Tahapan</button>
                                            <button class="btn btn-sm btn-info EditTahapan btn-action" data-id="<?= $tahapan['Id'] ?>" data-idvisi="<?= isset($tahapan['IdVisi']) ? $tahapan['IdVisi'] : '' ?>" data-periode="<?= $tahapan['TahunMulai'].'-'.$tahapan['TahunAkhir'] ?>" data-tahapan="<?= $tahapan['Tahapan'] ?>" title="Edit Tahapan"><i class="fa fa-edit"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger HapusTahapan btn-action" data-id="<?= $tahapan['Id'] ?>" title="Hapus Tahapan"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <?php 
                                    // Pengecekan Sub Tahapan berdasarkan Tahapan ini
                                    if(isset($tahapan['SubTahapan'])) {
                                        $noSub = 1;
                                        foreach ($tahapan['SubTahapan'] as $sub) { 
                                    ?>
                                        <!-- LEVEL 2: SUB TAHAPAN RPJMD -->
                                        <tr data-id="sub-<?= $sub['Id'] ?>" data-parent="tahapan-<?= $tahapan['Id'] ?>" data-expanded="false" style="display: none; background-color: #e0f7fa;">
                                            <td></td>
                                            <td style="padding-left: 30px; cursor: pointer; border-left: 3px solid #00bcd4;" onclick="toggleLevel('sub-<?= $sub['Id'] ?>', this)">
                                                <b style="color: #00838f;">SUB TAHAPAN <?= $noSub ?>:</b> <?= $sub['SubTahapan'] ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-periode" style="background-color: #00bcd4; box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);"><?= $sub['Periode'] ?></span>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                            <td class="text-center">
                                                <!-- Tombol Aksi di baris Sub Tahapan -->
                                                <button class="btn btn-sm btn-success TambahPembangunan btn-action" data-id="<?= $sub['Id'] ?>" title="Tambah Pembangunan"><i class="fa fa-plus"></i> Pembangunan</button>
                                                <button class="btn btn-sm btn-info EditSubTahapan btn-action" data-id="<?= $sub['Id'] ?>" data-idtahapan="<?= $tahapan['Id'] ?>" data-subtahapan="<?= $sub['SubTahapan'] ?>" title="Edit Sub Tahapan"><i class="fa fa-edit"></i> Edit</button>
                                                <button class="btn btn-sm btn-danger HapusSubTahapan btn-action" data-id="<?= $sub['Id'] ?>" title="Hapus Sub Tahapan"><i class="fa fa-trash"></i> Hapus</button>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                        <?php 
                                        // Pengecekan Pembangunan berdasarkan Sub Tahapan ini
                                        if(isset($sub['Pembangunan'])) {
                                            $noPem = 1;
                                            foreach ($sub['Pembangunan'] as $pem) { 
                                        ?>
                                            <!-- LEVEL 3: PEMBANGUNAN -->
                                            <tr data-id="pem-<?= $pem['Id'] ?>" data-parent="sub-<?= $sub['Id'] ?>" data-expanded="false" style="display: none; background-color: #fff3e0;">
                                                <td></td>
                                                <td style="padding-left: 60px; border-left: 3px solid #ff9800;">
                                                    <b style="color: #ef6c00;">PEMBANGUNAN <?= $noSub . '.' . $noPem ?>:</b> <?= $pem['TahapanPembangunan'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge-periode" style="background-color: #ff9800; box-shadow: 0 2px 5px rgba(255, 152, 0, 0.3);"><?= $pem['Periode'] ?></span>
                                                </td>
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
                                                <td class="text-center">
                                                    <!-- Tombol Aksi di baris Pembangunan -->
                                                    <button class="btn btn-sm btn-info EditPembangunan btn-action" data-id="<?= $pem['Id'] ?>" data-idsub="<?= $sub['Id'] ?>" data-pembangunan="<?= $pem['TahapanPembangunan'] ?>" title="Edit Pembangunan"><i class="fa fa-edit"></i> Edit</button>
                                                    <button class="btn btn-sm btn-danger HapusPembangunan btn-action" data-id="<?= $pem['Id'] ?>" title="Hapus Pembangunan"><i class="fa fa-trash"></i> Hapus</button>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php 
                                                $noPem++;
                                            } // End Pembangunan
                                        } 
                                        ?>
                                    <?php 
                                            $noSub++;
                                        } // End Sub Tahapan
                                    } 
                                    ?>
                                <?php 
                                        $noTahapan++;
                                    } // End Tahapan
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 30px; color: #999;">Belum ada data Tahapan RPJMD.</td>
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
<!-- MODAL INPUT & EDIT TAHAPAN (LEVEL 1)           -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputTahapan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Tahapan RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="fa fa-flag"></i>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <select class="selectpicker form-control" data-live-search="true" id="IdVisi">
                                    <option value="">Pilih Periode RPJMD</option>
                                    <?php 
                                    if(isset($Visi)) {
                                        foreach ($Visi as $cv) {
                                            echo "<option value='".$cv['Id']."'>".$cv['TahunMulai']." - ".$cv['TahunAkhir']."</option>";
                                        }
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Tahapan" rows="3" style="resize: vertical;" placeholder="Uraian Tahapan RPJMD"></textarea>
                            </div>
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

<div class="modal fade" id="ModalEditTahapan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Tahapan RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdTahapanForm">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Tahapan" rows="3" style="resize: vertical;" placeholder="Uraian Tahapan RPJMD"></textarea>
                            </div>
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

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT SUB TAHAPAN (LEVEL 2)       -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSubTahapan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Sub Tahapan RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" id="IdTahapan">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="SubTahapan" rows="3" style="resize: vertical;" placeholder="Uraian Sub Tahapan RPJMD"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanSubTahapan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditSubTahapan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Sub Tahapan RPJMD</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdSubTahapanForm">
                <input type="hidden" id="_IdTahapan">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_SubTahapan" rows="3" style="resize: vertical;" placeholder="Uraian Sub Tahapan RPJMD"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnSubTahapan"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT & EDIT PEMBANGUNAN (LEVEL 3)       -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Tahapan Pembangunan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" id="IdSubTahapan">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="TahapanPembangunan" rows="3" style="resize: vertical;" placeholder="Uraian Tahapan Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanPembangunan"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEditPembangunan" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Tahapan Pembangunan</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="IdPembangunanForm">
                <input type="hidden" id="_IdSubTahapan">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_TahapanPembangunan" rows="3" style="resize: vertical;" placeholder="Uraian Tahapan Pembangunan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtnPembangunan"><i class="fa fa-save"></i> Update</button>
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
    // JS Logic untuk Toggle Hierarki Tabel dengan klik text (Tanpa Icon)
    function toggleLevel(parentId, element) {
        var trs = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        var parentTr = element.closest('tr');
        
        // Membaca status berdasarkan atribut custom data-expanded
        var isExpanded = parentTr.getAttribute('data-expanded') === 'true';

        if (isExpanded) {
            // Tutup (Collapse)
            parentTr.setAttribute('data-expanded', 'false');
            hideAllChildren(parentId);
        } else {
            // Buka (Expand)
            parentTr.setAttribute('data-expanded', 'true');
            trs.forEach(function(tr) {
                tr.style.display = 'table-row';
            });
        }
        
        saveExpandedState();
    }

    // Fungsi Rekursif untuk menyembunyikan semua turunan di bawahnya
    function hideAllChildren(parentId) {
        var children = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        
        children.forEach(function(child) {
            child.style.display = 'none';
            child.setAttribute('data-expanded', 'false'); // Set turunan jadi tertutup
            var childId = child.getAttribute('data-id');
            
            hideAllChildren(childId); // Jalankan ke anak yang lebih dalam
        });
    }

    // Simpan state secara presisi dengan memindai atribut data-expanded
    function saveExpandedState() {
        var expanded = [];
        document.querySelectorAll('tr[data-expanded="true"]').forEach(function(tr) {
            expanded.push(tr.getAttribute('data-id'));
        });
        sessionStorage.setItem('expandedRowsTahapan', JSON.stringify(expanded)); // Nama session dibedakan khusus Tahapan
    }

    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>';

        // --- Restore & Reset Bug State dari Session ---
        var expandedRows = JSON.parse(sessionStorage.getItem('expandedRowsTahapan')) || [];
        
        // Membaca dari atas ke bawah (DOM order) agar parent terbuka terlebih dahulu 
        // sehingga child yang seharusnya tampil tidak terblokir status display 'none'
        document.querySelectorAll('#hierarki-table tbody tr').forEach(function(tr) {
            var id = tr.getAttribute('data-id');
            if (expandedRows.includes(id)) {
                tr.setAttribute('data-expanded', 'true');
                var trs = document.querySelectorAll('tr[data-parent="' + id + '"]');
                trs.forEach(function(childTr) {
                    childTr.style.display = 'table-row';
                });
            }
        });
        saveExpandedState();
        // ---------------------------------------------------------------

        // Trigger Auto-Select ComboBox saat tombol "Tambah di setiap baris" diklik
        $('#hierarki-table tbody').on('click', '.TambahSubTahapan', function() {
            var parentRow = $(this).closest('tr')[0];
            
            // Buka otomatis induknya jika saat diklik kondisinya masih tertutup
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            $('#IdTahapanForm').val($(this).data('id'));
            $('#ModalInputSubTahapan').modal('show');
        });

        $('#hierarki-table tbody').on('click', '.TambahPembangunan', function() {
            var parentRow = $(this).closest('tr')[0];
            
            // Buka otomatis induknya jika saat diklik kondisinya masih tertutup
            if (parentRow.getAttribute('data-expanded') !== 'true') {
                toggleLevel(parentRow.getAttribute('data-id'), parentRow);
            }

            $('#IdSubTahapanForm').val($(this).data('id'));
            $('#ModalInputPembangunan').modal('show');
        });

        // ==============================================
        // SCRIPT TAHAPAN RPJMD (LEVEL 1)
        // ==============================================
        $("#SimpanTahapan").click(function() {
            if ($("#IdVisi").val() == "") {
                alert('Pilih Periode Visi Terlebih Dahulu!')
            } else if ($("#Tahapan").val() == "") {
                alert('Input Tahapan Belum Benar!')
            } else {
                var Data = { _Id  : $("#IdVisi").val(), // Menyesuaikan Payload yang baru
                             Tahapan  : $("#Tahapan").val() }
                $.post(BaseURL+"Nasional/InputTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditTahapan', function () {
            $("#IdTahapanForm").val($(this).data('id'));
            $("#_IdVisi").val($(this).data('idvisi'));
            $("#_PeriodeVisi").val($(this).data('periode'));
            $("#_Tahapan").val($(this).data('tahapan'));
            $('#ModalEditTahapan').modal("show");
        });

        $("#EditBtnTahapan").click(function() {
            if ($("#_Tahapan").val() == "") {
                alert('Input Tahapan Belum Benar!')
            } else {
                var Data = { Id       : $("#IdTahapanForm").val(),
                             _Id  : $("#_IdVisi").val(),
                             Tahapan  : $("#_Tahapan").val() }
                $.post(BaseURL+"Nasional/EditTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusTahapan', function () {
            if(confirm("Yakin ingin menghapus Tahapan ini? Seluruh sub-data dibawahnya mungkin akan ikut terhapus.")) {
                var Data = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });

        // ==============================================
        // SCRIPT SUB TAHAPAN RPJMD (LEVEL 2)
        // ==============================================
        $("#SimpanSubTahapan").click(function() {
            if ($("#SubTahapan").val() == "") {
                alert('Input Sub Tahapan Belum Benar!')
            } else {
                var Data = { _Id        : $("#IdTahapanForm").val(),
                             SubTahapan : $("#SubTahapan").val() }
                $.post(BaseURL+"Nasional/InputSubTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditSubTahapan', function () {
            $("#IdSubTahapanForm").val($(this).data('id'));
            $("#_IdTahapan").val($(this).data('idtahapan'));
            $("#_SubTahapan").val($(this).data('subtahapan'));
            $('#ModalEditSubTahapan').modal("show");
        });

        $("#EditBtnSubTahapan").click(function() {
            if ($("#_SubTahapan").val() == "") {
                alert('Input Sub Tahapan Belum Benar!')
            } else {
                var Data = { Id         : $("#IdSubTahapanForm").val(),
                             _Id        : $("#_IdTahapan").val(),
                             SubTahapan : $("#_SubTahapan").val() }
                $.post(BaseURL+"Nasional/EditSubTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusSubTahapan', function () {
            if(confirm("Yakin ingin menghapus Sub Tahapan ini? Seluruh sub-data dibawahnya mungkin akan ikut terhapus.")) {
                var Data = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusSubTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });

        // ==============================================
        // SCRIPT TAHAPAN PEMBANGUNAN (LEVEL 3)
        // ==============================================
        $("#SimpanPembangunan").click(function() {
            if ($("#TahapanPembangunan").val() == "") {
                alert('Input Tahapan Pembangunan Belum Benar!')
            } else {
                var Data = { _Id                : $("#IdSubTahapanForm").val(),
                             Pembangunan : $("#TahapanPembangunan").val() }
                $.post(BaseURL+"Nasional/InputPembangunanTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.EditPembangunan', function () {
            $("#IdPembangunanForm").val($(this).data('id'));
            $("#_IdSubTahapan").val($(this).data('idsub'));
            $("#_TahapanPembangunan").val($(this).data('pembangunan'));
            $('#ModalEditPembangunan').modal("show");
        });

        $("#EditBtnPembangunan").click(function() {
            if ($("#_TahapanPembangunan").val() == "") {
                alert('Input Tahapan Pembangunan Belum Benar!')
            } else {
                var Data = { Id                 : $("#IdPembangunanForm").val(),
                             _Id                : $("#_IdSubTahapan").val(),
                             Pembangunan : $("#_TahapanPembangunan").val() }
                $.post(BaseURL+"Nasional/EditPembangunanTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })                         
            }
        });

        $('#hierarki-table tbody').on('click', '.HapusPembangunan', function () {
            if(confirm("Yakin ingin menghapus Tahapan Pembangunan ini?")) {
                var Data = { Id: $(this).data('id') }
                $.post(BaseURL+"Nasional/HapusPembangunanTahapanRPJMD", Data).done(function(Respon) {
                    if (Respon == '1') { window.location.reload(); } else { alert(Respon) }
                })
            }
        });
    });
</script>