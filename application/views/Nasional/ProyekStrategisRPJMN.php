<style>
    /* CSS untuk Modal Vertical Center */
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
        width: 700px;
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
    #data-table-basic > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #data-table-basic > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    
    /* Efek hover baris tabel */
    #data-table-basic > tbody > tr {
        transition: filter 0.2s ease;
    }
    #data-table-basic > tbody > tr:hover {
        filter: brightness(0.96);
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
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Penyesuaian Header Kontainer Tabel -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Proyek Strategis Nasional (RPJMN)</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputProyek" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Proyek Strategis</b>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 40%;">Proyek</th>
                                    <th style="width: 25%;">Lokasi</th>
                                    <th style="width: 20%;">Pelaksana</th>
                                    <th style="width: 10%;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!empty($ProyekStrategis)) {
                                    $no = 1;
                                    foreach ($ProyekStrategis as $row) { 
                                ?>
                                    <tr>
                                        <td class="text-center" style="font-weight: 700; color: #555;"><?= $no++ ?></td>
                                        <td style="font-weight: 600; color: #2c3e50; line-height: 1.5;">
                                            <?= nl2br(htmlspecialchars($row['Proyek'])) ?>
                                        </td>
                                        <td style="color: #444;">
                                            <?php if (!empty($row['Lokasi'])): ?>
                                                <i class="fa fa-map-marker text-danger" style="margin-right: 5px;"></i><?= nl2br(htmlspecialchars($row['Lokasi'])) ?>
                                            <?php else: ?>
                                                <span style="color: #aaa; font-style: italic;">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="color: #444;">
                                            <?php if (!empty($row['Pelaksana'])): ?>
                                                <i class="fa fa-building-o text-primary" style="margin-right: 5px;"></i><?= htmlspecialchars($row['Pelaksana']) ?>
                                            <?php else: ?>
                                                <span style="color: #aaa; font-style: italic;">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center" style="white-space: nowrap;">
                                            <button type="button" class="btn btn-sm btn-info EditProyek btn-action" 
                                                    data-id="<?= $row['Id'] ?>" 
                                                    data-proyek="<?= htmlspecialchars($row['Proyek'], ENT_QUOTES) ?>" 
                                                    data-lokasi="<?= htmlspecialchars($row['Lokasi'], ENT_QUOTES) ?>" 
                                                    data-pelaksana="<?= htmlspecialchars($row['Pelaksana'], ENT_QUOTES) ?>" 
                                                    title="Edit Proyek">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger HapusProyek btn-action" 
                                                    data-id="<?= $row['Id'] ?>" 
                                                    title="Hapus Proyek">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php 
                                    }
                                } 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL INPUT PROYEK STRATEGIS -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputProyek" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Proyek Strategis Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Proyek" rows="3" style="resize: vertical;" placeholder="Uraian / Nama Proyek Strategis"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="Lokasi" rows="2" style="resize: vertical;" placeholder="Lokasi Proyek"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="Pelaksana" placeholder="Pelaksana / Pengampu Proyek">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="SimpanProyek"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT PROYEK STRATEGIS -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditProyek" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Proyek Strategis Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="_Id">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Proyek" rows="3" style="resize: vertical;" placeholder="Uraian / Nama Proyek Strategis"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="nk-int-st">
                                <textarea class="form-control" id="_Lokasi" rows="2" style="resize: vertical;" placeholder="Lokasi Proyek"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" id="_Pelaksana" placeholder="Pelaksana / Pengampu Proyek">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="UpdateProyek"><i class="fa fa-save"></i> Update</button>
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
var BaseURL = '<?= base_url() ?>';

$(document).ready(function() {
    // Simpan Proyek Baru
    $('#SimpanProyek').click(function() {
        var proyek = $.trim($('#Proyek').val());
        var lokasi = $.trim($('#Lokasi').val());
        var pelaksana = $.trim($('#Pelaksana').val());

        if (proyek === '') {
            alert('Uraian Proyek belum diisi!');
            $('#Proyek').focus();
            return;
        }

        $.post(BaseURL + 'Nasional/InputProyekStrategis', {
            Proyek: proyek,
            Lokasi: lokasi,
            Pelaksana: pelaksana
        }).done(function(res) {
            if (res === '1') {
                location.reload();
            } else {
                alert(res);
            }
        }).fail(function() {
            alert('Gagal menghubungi server!');
        });
    });

    // Buka Modal Edit Proyek
    $('#data-table-basic tbody').on('click', '.EditProyek', function() {
        var id = $(this).data('id');
        var proyek = $(this).data('proyek');
        var lokasi = $(this).data('lokasi');
        var pelaksana = $(this).data('pelaksana');

        $('#_Id').val(id);
        $('#_Proyek').val(proyek);
        $('#_Lokasi').val(lokasi);
        $('#_Pelaksana').val(pelaksana);

        $('#ModalEditProyek').modal('show');
    });

    // Update Proyek
    $('#UpdateProyek').click(function() {
        var id = $('#_Id').val();
        var proyek = $.trim($('#_Proyek').val());
        var lokasi = $.trim($('#_Lokasi').val());
        var pelaksana = $.trim($('#_Pelaksana').val());

        if (proyek === '') {
            alert('Uraian Proyek belum diisi!');
            $('#_Proyek').focus();
            return;
        }

        $.post(BaseURL + 'Nasional/EditProyekStrategis', {
            Id: id,
            Proyek: proyek,
            Lokasi: lokasi,
            Pelaksana: pelaksana
        }).done(function(res) {
            if (res === '1') {
                location.reload();
            } else {
                alert(res);
            }
        }).fail(function() {
            alert('Gagal menghubungi server!');
        });
    });

    // Hapus Proyek
    $('#data-table-basic tbody').on('click', '.HapusProyek', function() {
        var id = $(this).data('id');
        if (confirm('Yakin ingin menghapus Proyek Strategis ini?')) {
            $.post(BaseURL + 'Nasional/HapusProyekStrategis', { Id: id }).done(function(res) {
                if (res === '1') {
                    location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Gagal menghubungi server!');
            });
        }
    });
});
</script>