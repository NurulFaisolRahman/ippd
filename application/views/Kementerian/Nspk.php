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
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputNSPK">
                                <i class="notika-icon notika-edit"></i> <b>Input NSPK</b>
                            </button>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="12%">Kode NSPK</th>
                                    <th width="25%">Judul NSPK</th>
                                    <th width="10%">Jenis</th>
                                    <th width="12%">Bidang</th>
                                    <th width="8%">Tahun</th>
                                    <th width="10%">Status</th>
                                    <th width="18%">Keterangan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($NSPK as $key): ?>
                                <tr>
                                    <td class="text-center"><?= $No++ ?></td>
                                    <td><?= htmlspecialchars($key['kode_nspk']) ?></td>
                                    <td><?= htmlspecialchars($key['judul_nspk']) ?></td>
                                    <td><?= $key['jenis_nspk'] ?></td>
                                    <td><?= htmlspecialchars($key['bidang']) ?></td>
                                    <td><?= $key['tahun_penetapan'] ?></td>
                                    <td>
                                        <span class="badge badge-<?= ($key['status'] == 'Berlaku') ? 'success' : (($key['status'] == 'Revisi') ? 'warning' : 'danger') ?>">
                                            <?= $key['status'] ?>
                                        </span>
                                    </td>
                                    <td><?= nl2br(htmlspecialchars($key['keterangan'])) ?></td>

                                    <td>
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-warning EditNSPK"
                                                data-id="<?= $key['id'] ?>"
                                                data-kode="<?= htmlspecialchars($key['kode_nspk']) ?>"
                                                data-judul="<?= htmlspecialchars($key['judul_nspk']) ?>"
                                                data-jenis="<?= $key['jenis_nspk'] ?>"
                                                data-bidang="<?= htmlspecialchars($key['bidang']) ?>"
                                                data-tahun="<?= $key['tahun_penetapan'] ?>"
                                                data-status="<?= $key['status'] ?>"
                                                data-ket="<?= htmlspecialchars($key['keterangan']) ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger HapusNSPK" data-id="<?= $key['id'] ?>">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
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
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Input NSPK Baru</h4>
            </div>
            <div class="modal-body">
                <form id="FormInputNSPK">
                    <div class="form-example-wrap" style="padding: 5px;">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Kode NSPK</b></label></div>
                                    <div class="col-lg-9"><input type="text" class="form-control" name="kode_nspk" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Judul NSPK</b></label></div>
                                    <div class="col-lg-9"><input type="text" class="form-control" name="judul_nspk" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Jenis</b></label></div>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="jenis_nspk" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Norma">Norma</option>
                                            <option value="Standar">Standar</option>
                                            <option value="Prosedur">Prosedur</option>
                                            <option value="Kriteria">Kriteria</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Bidang</b></label></div>
                                    <div class="col-lg-9"><input type="text" class="form-control" name="bidang" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Tahun Penetapan</b></label></div>
                                    <div class="col-lg-9"><input type="number" class="form-control" name="tahun_penetapan" min="2000" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Status</b></label></div>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="status">
                                            <option value="Berlaku">Berlaku</option>
                                            <option value="Revisi">Revisi</option>
                                            <option value="Dicabut">Dicabut</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Keterangan</b></label></div>
                                    <div class="col-lg-9"><textarea class="form-control" name="keterangan" rows="3"></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-success notika-btn-success">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit NSPK -->
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
                    <div class="form-example-wrap" style="padding: 5px;">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Kode NSPK</b></label></div>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="EditKode" name="kode_nspk" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Judul NSPK</b></label></div>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="EditJudul" name="judul_nspk" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Jenis</b></label></div>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="EditJenis" name="jenis_nspk" required>
                                            <option value="Norma">Norma</option>
                                            <option value="Standar">Standar</option>
                                            <option value="Prosedur">Prosedur</option>
                                            <option value="Kriteria">Kriteria</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Bidang</b></label></div>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="EditBidang" name="bidang" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Tahun Penetapan</b></label></div>
                                    <div class="col-lg-9"><input type="number" class="form-control" id="EditTahun" name="tahun_penetapan" min="2000" required></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Status</b></label></div>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="EditStatus" name="status">
                                            <option value="Berlaku">Berlaku</option>
                                            <option value="Revisi">Revisi</option>
                                            <option value="Dicabut">Dicabut</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2"><label><b>Keterangan</b></label></div>
                                    <div class="col-lg-9"><textarea class="form-control" id="EditKeterangan" name="keterangan" rows="3"></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-success notika-btn-success">UPDATE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

$(document).ready(function() {
    $('#data-table-basic').DataTable();
});

// Input
$("#FormInputNSPK").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/InputNSPK", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Edit - isi modal
$(document).on('click', '.EditNSPK', function() {
    var btn = $(this);
    $('#EditId').val(btn.data('id'));
    $('#EditKode').val(btn.data('kode'));
    $('#EditJudul').val(btn.data('judul'));
    $('#EditJenis').val(btn.data('jenis'));
    $('#EditBidang').val(btn.data('bidang'));
    $('#EditTahun').val(btn.data('tahun'));
    $('#EditStatus').val(btn.data('status'));
    $('#EditKeterangan').val(btn.data('ket'));

    $('#ModalEditNSPK').modal('show');
});

// Update
$("#FormEditNSPK").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/UpdateNSPK", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Hapus
$(document).on('click', '.HapusNSPK', function() {
    if (confirm('Yakin hapus NSPK ini?')) {
        var id = $(this).data('id');
        $.post(BaseURL + "Kementerian/DeleteNSPK", {id: id}, function(res) {
            if (res.trim() === '1') {
                location.reload();
            } else {
                alert(res);
            }
        }).fail(function() {
            alert('Gagal menghubungi server');
        });
    }
});
</script>