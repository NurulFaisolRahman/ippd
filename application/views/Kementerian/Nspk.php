<?php $this->load->view('Kementerian/Sidebar'); ?>

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
                            <a href="<?= base_url('Kementerian/IsuStrategis') ?>">Kementerian</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block;">
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                        <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center details-control"></th>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="12%">Kode NSPK</th>
                                    <th width="28%">Judul NSPK</th>
                                    <th width="12%">Bidang</th>
                                    <th width="8%">Tahun</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Keterangan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($NSPK as $key): ?>
                                <tr data-id="<?= $key['id'] ?>">
                                    <td class="text-center details-control">
                                        <i class="fa fa-plus-circle text-success"></i>
                                    </td>
                                    <td class="text-center"><?= $No++ ?></td>
                                    <td><?= htmlspecialchars($key['kode_nspk']) ?></td>
                                    <td><?= htmlspecialchars($key['judul_nspk']) ?></td>
                                    <td><?= htmlspecialchars($key['bidang']) ?></td>
                                    <td><?= $key['tahun_penetapan'] ?></td>
                                    <td>
                                        <span class="badge badge-<?= ($key['status'] == 'Berlaku') ? 'success' : (($key['status'] == 'Revisi') ? 'warning' : 'danger') ?>">
                                            <?= $key['status'] ?>
                                        </span>
                                    </td>
                                    <td><?= nl2br(htmlspecialchars($key['keterangan'] ?? '')) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning EditNSPK"
                                            data-id="<?= $key['id'] ?>"
                                            data-kode="<?= htmlspecialchars($key['kode_nspk']) ?>"
                                            data-judul="<?= htmlspecialchars($key['judul_nspk']) ?>"
                                            data-bidang="<?= htmlspecialchars($key['bidang']) ?>"
                                            data-tahun="<?= $key['tahun_penetapan'] ?>"
                                            data-status="<?= $key['status'] ?>"
                                            data-ket="<?= htmlspecialchars($key['keterangan'] ?? '') ?>">
                                            <i class="notika-icon notika-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger HapusNSPK" data-id="<?= $key['id'] ?>">
                                            <i class="notika-icon notika-trash"></i>
                                        </button>
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

<!-- ==================== MODAL INPUT NSPK (DENGAN DYNAMIC DETAIL) ==================== -->
<div class="modal fade" id="ModalInputNSPK" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Input NSPK Baru</h4>
            </div>
            <div class="modal-body">
                <form id="FormInputNSPK">
                    <!-- Header Fields -->
                    <div class="form-group">
                        <label><b>Kode NSPK</b></label>
                        <input type="text" class="form-control" name="kode_nspk" required>
                    </div>
                    <div class="form-group">
                        <label><b>Judul NSPK</b></label>
                        <input type="text" class="form-control" name="judul_nspk" required>
                    </div>
                    <div class="form-group">
                        <label><b>Bidang</b></label>
                        <input type="text" class="form-control" name="bidang" required>
                    </div>
                    <div class="form-group">
                        <label><b>Tahun Penetapan</b></label>
                        <input type="number" class="form-control" name="tahun_penetapan" min="2000" required>
                    </div>
                    <div class="form-group">
                        <label><b>Status</b></label>
                        <select class="form-control" name="status">
                            <option value="Berlaku">Berlaku</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Dicabut">Dicabut</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><b>Keterangan Umum</b></label>
                        <textarea class="form-control" name="keterangan" rows="2"></textarea>
                    </div>

                    <!-- Dynamic Details -->
                    <div class="form-group">
                        <label><b>Isian Detail (Norma / Standar / Prosedur / Kriteria)</b></label>
                        <button type="button" id="btnAddDetail" class="btn btn-info btn-sm">+ Tambah Isian</button>
                        <table id="tableDynamicDetail" class="table table-bordered table-striped" style="margin-top:10px;">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Isi / Uraian</th>
                                    <th>Urutan</th>
                                    <th width="80px"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-success notika-btn-success">SIMPAN NSPK & DETAIL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ==================== MODAL EDIT HEADER NSPK ==================== -->
<div class="modal fade" id="ModalEditNSPK" role="dialog">
    <div class="modal-dialog modals-default">
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
                    <button type="submit" class="btn btn-success">UPDATE HEADER</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ==================== MODAL TAMBAH/EDIT DETAIL ITEM ==================== -->
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
                        <label>Isi / Uraian Lengkap</label>
                        <textarea name="isi" id="d_isi" class="form-control" rows="6" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Urutan Tampil</label>
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

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var table;

$(document).ready(function() {
    table = $('#data-table-basic').DataTable();

    // ===================== EXPAND CHILD ROW =====================
    $('#data-table-basic tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var nspk_id = tr.data('id');

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            $(this).html('<i class="fa fa-plus-circle text-success"></i>');
        } else {
            $.post(BaseURL + "Kementerian/GetNSPKDetails", {nspk_id: nspk_id}, function (res) {
                var details = JSON.parse(res);
                var html = '<div style="padding:15px; background:#f9f9f9;">';

                if (details.length === 0) {
                    html += '<p class="text-muted">Belum ada detail isian.</p>';
                } else {
                    html += `<table class="table table-bordered table-striped">
                        <thead><tr><th>No</th><th>Jenis</th><th>Isi</th><th>Urutan</th><th>Aksi</th></tr></thead><tbody>`;
                    details.forEach(function(d, i) {
                        html += `<tr>
                            <td>${i+1}</td>
                            <td><span class="badge badge-info">${d.jenis}</span></td>
                            <td>${d.isi.replace(/\n/g, '<br>')}</td>
                            <td>${d.urutan}</td>
                            <td>
                                <button class="btn btn-xs btn-warning EditDetail" 
                                    data-id="${d.id}" 
                                    data-nspk="${nspk_id}"
                                    data-jenis="${d.jenis}" 
                                    data-isi="${d.isi.replace(/"/g,'&quot;')}" 
                                    data-urutan="${d.urutan}">Edit</button>
                                <button class="btn btn-xs btn-danger DeleteDetail" data-id="${d.id}">Hapus</button>
                            </td>
                        </tr>`;
                    });
                    html += '</tbody></table>';
                }

                html += `<button class="btn btn-sm btn-primary AddDetailBtn mt-2" data-nspk="${nspk_id}">
                    <i class="fa fa-plus"></i> Tambah Isian Baru
                </button></div>`;

                row.child(html).show();
                tr.addClass('shown');
                $(tr.find('td.details-control')).html('<i class="fa fa-minus-circle text-danger"></i>');
            });
        }
    });

    // ===================== DYNAMIC FORM DI MODAL INPUT =====================
    let detailIndex = 0;
    $('#btnAddDetail').click(function() {
        detailIndex++;
        var row = `
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
            </tr>`;
        $('#tableDynamicDetail tbody').append(row);
    });

    $(document).on('click', '.remove-detail', function() {
        $(this).closest('tr').remove();
    });

    // Submit Input
    $("#FormInputNSPK").submit(function(e) {
        e.preventDefault();
        $.post(BaseURL + "Kementerian/InputNSPK", $(this).serialize(), function(res) {
            if (res.trim() === '1') {
                location.reload();
            } else {
                alert(res);
            }
        });
    });

    // Edit Header
    $(document).on('click', '.EditNSPK', function() {
        var btn = $(this);
        $('#EditId').val(btn.data('id'));
        $('#EditKode').val(btn.data('kode'));
        $('#EditJudul').val(btn.data('judul'));
        $('#EditBidang').val(btn.data('bidang'));
        $('#EditTahun').val(btn.data('tahun'));
        $('#EditStatus').val(btn.data('status'));
        $('#EditKeterangan').val(btn.data('ket'));
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

    // ===================== CRUD DETAIL ITEM =====================
    $(document).on('click', '.AddDetailBtn', function() {
        var nspk_id = $(this).data('nspk');
        $('#d_id').val('');
        $('#d_nspk_id').val(nspk_id);
        $('#d_jenis').val('Norma');
        $('#d_isi').val('');
        $('#d_urutan').val('1');
        $('#titleDetailModal').text('Tambah Isian Baru');
        $('#ModalDetailItem').modal('show');
    });

    $(document).on('click', '.EditDetail', function() {
        $('#d_id').val($(this).data('id'));
        $('#d_nspk_id').val($(this).data('nspk'));
        $('#d_jenis').val($(this).data('jenis'));
        $('#d_isi').val($(this).data('isi'));
        $('#d_urutan').val($(this).data('urutan'));
        $('#titleDetailModal').text('Edit Isian');
        $('#ModalDetailItem').modal('show');
    });

    $('#btnSaveDetail').click(function() {
        var url = $('#d_id').val() 
            ? BaseURL + 'Kementerian/UpdateNSPKDetail' 
            : BaseURL + 'Kementerian/InputNSPKDetail';
        
        $.post(url, $('#FormDetailItem').serialize(), function(res) {
            if (res.trim() === '1') {
                location.reload();
            } else {
                alert(res);
            }
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