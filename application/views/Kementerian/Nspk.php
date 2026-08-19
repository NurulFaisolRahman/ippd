<?php $this->load->view('Kementerian/Sidebar'); ?>

<style>
    /* ============ DROPDOWN TITIK TIGA ============ */
    .dropdown-aksi {
        position: relative;
        display: inline-block;
    }
    .dropdown-aksi .btn-titik-tiga {
        background: transparent;
        border: none;
        padding: 4px 8px;
        border-radius: 4px;
        cursor: pointer;
        color: #718096;
        transition: all 0.2s ease;
        font-size: 16px;
        line-height: 1;
        font-weight: 400;
    }
    .dropdown-aksi .btn-titik-tiga:hover {
        background: #edf2f7;
        color: #2d3748;
    }
    .dropdown-aksi .btn-titik-tiga:focus {
        outline: none;
    }
    .dropdown-aksi .menu-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        min-width: 160px;
        background: white;
        border-radius: 6px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        border: 1px solid #edf2f7;
        padding: 4px 0;
        display: none;
        z-index: 1000;
        margin-top: 4px;
        text-align: left;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    .dropdown-aksi .menu-dropdown.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
    .dropdown-aksi .item-dropdown {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        color: #2d3748;
        font-size: 12px;
        transition: all 0.2s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-weight: 500;
    }
    .dropdown-aksi .item-dropdown:hover {
        background: #f7fafc;
        color: #1a2332;
    }
    .dropdown-aksi .item-dropdown i {
        width: 16px;
        font-size: 13px;
        color: #718096;
    }
    .dropdown-aksi .item-dropdown.text-danger {
        color: #dc3545;
    }
    .dropdown-aksi .item-dropdown.text-danger i {
        color: #dc3545;
    }
    .dropdown-aksi .item-dropdown.text-danger:hover {
        background: #fef2f2;
    }
    .dropdown-aksi .divider-dropdown {
        height: 1px;
        background: #edf2f7;
        margin: 4px 0;
    }
    /* =========================================== */
    
    .badge {
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-success {
        background: #28a745;
        color: #fff;
    }
    .badge-warning {
        background: #ffc107;
        color: #212529;
    }
    .badge-danger {
        background: #dc3545;
        color: #fff;
    }
    .badge-info {
        background: #17a2b8;
        color: #fff;
    }
    
    .details-control i {
        transition: all 0.3s ease;
    }
    .details-control i:hover {
        transform: scale(1.2);
    }
    
    @media (max-width: 768px) {
        .dropdown-aksi .menu-dropdown {
            right: -10px;
            min-width: 150px;
        }
    }
</style>

<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcomb-list">
                    <ul class="breadcomb-menu" style="list-style:none;padding:0;margin:0;">
                        <li style="display:inline-block;margin-right:5px;">
                            <a href="<?= base_url('Beranda') ?>">Beranda</a>
                            <span class="bread-slash"> / </span>
                        </li>
                        <li style="display:inline-block;margin-right:5px;">
                            <a href="<?= base_url('Kementerian/IsuStrategis') ?>">Kementerian</a>
                            <span class="bread-slash"> / </span>
                        </li>
                        <li style="display:inline-block;">
                            <span class="bread-blk">NSPK</span>
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
            <div class="col-lg-12">
                <div class="data-table-list">
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                    <div class="alert alert-info" style="margin-bottom:15px;">
                        <i class="notika-icon notika-info"></i>
                        <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName ?? '-') ?><br>
                        <b>Periode :</b> <?= htmlspecialchars($UserPeriode ?? '-') ?>
                    </div>
                    <?php endif; ?>

                    <div class="basic-tb-hd">
                        <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputNSPK">
                            <i class="notika-icon notika-edit"></i> <b>Input NSPK Baru</b>
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="4%" class="text-center"></th>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="13%">Kode NSPK</th>
                                    <th width="28%">Judul NSPK</th>
                                    <th width="12%">Bidang</th>
                                    <th width="8%">Tahun</th>
                                    <th width="10%">Status</th>
                                    <th width="12%">Keterangan</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($NSPK as $key): ?>
                                <tr data-id="<?= $key['id'] ?>">
                                    <td class="text-center details-control">
                                        <i class="fa fa-plus-circle text-success" style="cursor:pointer;font-size:18px;"></i>
                                    </td>
                                    <td class="text-center"><?= $No++ ?></td>
                                    <td><?= htmlspecialchars($key['kode_nspk']) ?></td>
                                    <td><?= htmlspecialchars($key['judul_nspk']) ?></td>
                                    <td><?= htmlspecialchars($key['bidang']) ?></td>
                                    <td><?= $key['tahun_penetapan'] ?></td>
                                    <td>
                                        <?php
                                        $badge = $key['status'] == 'Berlaku' ? 'success' : ($key['status'] == 'Revisi' ? 'warning' : 'danger');
                                        ?>
                                        <span class="badge badge-<?= $badge ?>"><?= $key['status'] ?></span>
                                    </td>
                                    <td><?= nl2br(htmlspecialchars($key['keterangan'] ?? '')) ?></td>
                                    <td>
                                        <div class="dropdown-aksi">
                                            <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <div class="menu-dropdown">
                                                <button class="item-dropdown EditNSPK"
                                                    data-id="<?= $key['id'] ?>"
                                                    data-kode="<?= htmlspecialchars($key['kode_nspk']) ?>"
                                                    data-judul="<?= htmlspecialchars($key['judul_nspk']) ?>"
                                                    data-bidang="<?= htmlspecialchars($key['bidang']) ?>"
                                                    data-tahun="<?= $key['tahun_penetapan'] ?>"
                                                    data-status="<?= $key['status'] ?>"
                                                    data-ket="<?= htmlspecialchars($key['keterangan'] ?? '') ?>">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <button class="item-dropdown text-danger HapusNSPK" data-id="<?= $key['id'] ?>">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </div>
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

<!-- Modal Input NSPK -->
<div class="modal fade" id="ModalInputNSPK" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Input NSPK Baru</h4>
            </div>
            <div class="modal-body">
                <form id="FormInputNSPK">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Kode NSPK</b></label>
                                <input type="text" class="form-control" name="kode_nspk" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Tahun Penetapan</b></label>
                                <input type="number" class="form-control" name="tahun_penetapan" min="2000" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Judul NSPK</b></label>
                        <input type="text" class="form-control" name="judul_nspk" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Bidang</b></label>
                                <input type="text" class="form-control" name="bidang" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Status</b></label>
                                <select class="form-control" name="status">
                                    <option value="Berlaku">Berlaku</option>
                                    <option value="Revisi">Revisi</option>
                                    <option value="Dicabut">Dicabut</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Keterangan Umum</b></label>
                        <textarea class="form-control" name="keterangan" rows="2"></textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label><b>Isian Detail (Norma / Standar / Prosedur / Kriteria)</b></label>
                        <button type="button" id="btnAddDetail" class="btn btn-info btn-sm">+ Tambah Isian</button>
                        <table id="tableDynamicDetail" class="table table-bordered" style="margin-top:10px;">
                            <thead>
                                <tr>
                                    <th width="18%">Jenis</th>
                                    <th>Isi / Uraian</th>
                                    <th width="10%">Urutan</th>
                                    <th width="8%"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-success">SIMPAN NSPK & DETAIL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Header -->
<div class="modal fade" id="ModalEditNSPK" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit NSPK</h4>
            </div>
            <div class="modal-body">
                <form id="FormEditNSPK">
                    <input type="hidden" name="id" id="EditId">
                    <div class="form-group">
                        <label><b>Kode NSPK</b></label>
                        <input type="text" class="form-control" id="EditKode" name="kode_nspk" required>
                    </div>
                    <div class="form-group">
                        <label><b>Judul NSPK</b></label>
                        <input type="text" class="form-control" id="EditJudul" name="judul_nspk" required>
                    </div>
                    <div class="form-group">
                        <label><b>Bidang</b></label>
                        <input type="text" class="form-control" id="EditBidang" name="bidang" required>
                    </div>
                    <div class="form-group">
                        <label><b>Tahun Penetapan</b></label>
                        <input type="number" class="form-control" id="EditTahun" name="tahun_penetapan" min="2000" required>
                    </div>
                    <div class="form-group">
                        <label><b>Status</b></label>
                        <select class="form-control" id="EditStatus" name="status">
                            <option value="Berlaku">Berlaku</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Dicabut">Dicabut</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><b>Keterangan Umum</b></label>
                        <textarea class="form-control" id="EditKeterangan" name="keterangan" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Item -->
<div class="modal fade" id="ModalDetailItem" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="titleDetailModal">Tambah Isian Detail</h4>
            </div>
            <div class="modal-body">
                <form id="FormDetailItem">
                    <input type="hidden" name="id" id="d_id">
                    <input type="hidden" name="nspk_id" id="d_nspk_id">
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" id="d_jenis" class="form-control" required>
                            <option value="Norma">Norma</option>
                            <option value="Standar">Standar</option>
                            <option value="Prosedur">Prosedur</option>
                            <option value="Kriteria">Kriteria</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Isi / Uraian</label>
                        <textarea name="isi" id="d_isi" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" name="urutan" id="d_urutan" class="form-control" value="1" min="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="btnSaveDetail">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var table;

// ============================================================
// FUNGSI TOGGLE DROPDOWN
// ============================================================
function toggleDropdown(button) {
    event.stopPropagation();
    var menu = button.nextElementSibling;
    var isOpen = menu.classList.contains('show');
    
    // Close all other dropdowns
    document.querySelectorAll('.menu-dropdown.show').forEach(function(m) {
        if (m !== menu) m.classList.remove('show');
    });
    
    menu.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-aksi')) {
        document.querySelectorAll('.menu-dropdown.show').forEach(function(menu) {
            menu.classList.remove('show');
        });
    }
});

$(document).ready(function() {
    table = $('#data-table-basic').DataTable();

    // Expand / Collapse child row
    $('#data-table-basic tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var nspk_id = tr.data('id');

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            $(this).html('<i class="fa fa-plus-circle text-success" style="cursor:pointer;font-size:18px;"></i>');
        } else {
            $.post(BaseURL + "Kementerian/GetNSPKDetails", {nspk_id: nspk_id}, function (res) {
                var details = JSON.parse(res);
                var html = '<div style="padding:12px;background:#f8f9fa;border-radius:4px;">';

                if (details.length === 0) {
                    html += '<p class="text-muted mb-2">Belum ada isian detail.</p>';
                } else {
                    html += `<table class="table table-bordered table-sm">
                        <thead><tr><th>No</th><th>Jenis</th><th>Isi</th><th>Urutan</th><th>Aksi</th></tr></thead><tbody>`;
                    details.forEach(function(d, i) {
                        html += `<tr>
                            <td>${i+1}</td>
                            <td><span class="badge badge-info">${d.jenis}</span></td>
                            <td>${d.isi.replace(/\n/g, '<br>')}</td>
                            <td>${d.urutan}</td>
                            <td>
                                <div class="dropdown-aksi">
                                    <button class="btn-titik-tiga" onclick="event.stopPropagation(); toggleDropdown(this)">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="menu-dropdown">
                                        <button class="item-dropdown EditDetail"
                                            data-id="${d.id}" data-nspk="${nspk_id}"
                                            data-jenis="${d.jenis}" data-isi="${d.isi.replace(/"/g,'&quot;')}"
                                            data-urutan="${d.urutan}">
                                            <i class="fa fa-pencil"></i> Edit
                                        </button>
                                        <button class="item-dropdown text-danger DeleteDetail" data-id="${d.id}">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                    });
                    html += '</tbody></table>';
                }

                html += `<button class="btn btn-sm btn-primary AddDetailBtn" data-nspk="${nspk_id}">
                    <i class="fa fa-plus"></i> Tambah Isian Baru
                </button></div>`;

                row.child(html).show();
                tr.addClass('shown');
                $(tr.find('td.details-control')).html('<i class="fa fa-minus-circle text-danger" style="cursor:pointer;font-size:18px;"></i>');
            });
        }
    });

    // Dynamic form di modal input
    let detailIndex = 0;
    $('#btnAddDetail').click(function() {
        detailIndex++;
        $('#tableDynamicDetail tbody').append(`
            <tr>
                <td>
                    <select name="details[${detailIndex}][jenis]" class="form-control">
                        <option value="Norma">Norma</option>
                        <option value="Standar">Standar</option>
                        <option value="Prosedur">Prosedur</option>
                        <option value="Kriteria">Kriteria</option>
                    </select>
                </td>
                <td><textarea name="details[${detailIndex}][isi]" class="form-control" rows="2" required></textarea></td>
                <td><input type="number" name="details[${detailIndex}][urutan]" value="${detailIndex}" class="form-control" min="1"></td>
                <td><button type="button" class="btn btn-danger btn-xs remove-detail">×</button></td>
            </tr>
        `);
    });

    $(document).on('click', '.remove-detail', function() {
        $(this).closest('tr').remove();
    });

    // Submit Input
    $("#FormInputNSPK").submit(function(e) {
        e.preventDefault();
        $.post(BaseURL + "Kementerian/InputNSPK", $(this).serialize(), function(res) {
            if (res.trim() === '1') location.reload();
            else alert(res);
        });
    });

    // Edit Header
    $(document).on('click', '.EditNSPK', function() {
        var b = $(this);
        $('#EditId').val(b.data('id'));
        $('#EditKode').val(b.data('kode'));
        $('#EditJudul').val(b.data('judul'));
        $('#EditBidang').val(b.data('bidang'));
        $('#EditTahun').val(b.data('tahun'));
        $('#EditStatus').val(b.data('status'));
        $('#EditKeterangan').val(b.data('ket'));
        $('#ModalEditNSPK').modal('show');
    });

    $("#FormEditNSPK").submit(function(e) {
        e.preventDefault();
        $.post(BaseURL + "Kementerian/UpdateNSPK", $(this).serialize(), function(res) {
            if (res.trim() === '1') location.reload();
            else alert(res);
        });
    });

    // Hapus Header
    $(document).on('click', '.HapusNSPK', function() {
        if (confirm('Yakin hapus NSPK ini beserta semua detailnya?')) {
            $.post(BaseURL + "Kementerian/DeleteNSPK", {id: $(this).data('id')}, function(res) {
                if (res.trim() === '1') location.reload();
                else alert(res);
            });
        }
    });

    // Detail CRUD
    $(document).on('click', '.AddDetailBtn', function() {
        $('#d_id').val('');
        $('#d_nspk_id').val($(this).data('nspk'));
        $('#d_jenis').val('Norma');
        $('#d_isi').val('');
        $('#d_urutan').val('1');
        $('#titleDetailModal').text('Tambah Isian Baru');
        $('#ModalDetailItem').modal('show');
    });

    $(document).on('click', '.EditDetail', function() {
        var b = $(this);
        $('#d_id').val(b.data('id'));
        $('#d_nspk_id').val(b.data('nspk'));
        $('#d_jenis').val(b.data('jenis'));
        $('#d_isi').val(b.data('isi'));
        $('#d_urutan').val(b.data('urutan'));
        $('#titleDetailModal').text('Edit Isian');
        $('#ModalDetailItem').modal('show');
    });

    $('#btnSaveDetail').click(function() {
        var url = $('#d_id').val() ? BaseURL + 'Kementerian/UpdateNSPKDetail' : BaseURL + 'Kementerian/InputNSPKDetail';
        $.post(url, $('#FormDetailItem').serialize(), function(res) {
            if (res.trim() === '1') location.reload();
            else alert(res);
        });
    });

    $(document).on('click', '.DeleteDetail', function() {
        if (confirm('Yakin hapus isian ini?')) {
            $.post(BaseURL + "Kementerian/DeleteNSPKDetail", {id: $(this).data('id')}, function(res) {
                if (res.trim() === '1') location.reload();
                else alert(res);
            });
        }
    });
});
</script>