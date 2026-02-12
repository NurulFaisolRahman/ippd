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
                            <a href="<?= base_url('Kementerian/Renstra') ?>">Renstra</a>
                            <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                        </li>
                        <li style="display: inline-block;">
                            <span class="bread-blk">Hubungan Keterkaitan</span>
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
                    <!-- Tombol Tambah PN -->
                     <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                    <div class="alert alert-info" style="margin-bottom:15px;">
                        <i class="notika-icon notika-info"></i>
                        <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName ?? '-') ?><br>
                        <b>Periode :</b> <?= htmlspecialchars($UserPeriode ?? '-') ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                    <div class="basic-tb-hd">
                        <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#modalAddPN">
                            <i class="notika-icon notika-plus-symbol"></i> Tambah Prioritas Nasional
                        </button>
                    </div>
                    <?php endif; ?>

                    <!-- Tabel Hierarki -->
                    <!-- Tabel Hierarki (tanpa kolom Aksi di header) -->
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="bg-success text-white">
            <tr>
                <th>Prioritas Nasional (PN)</th>
                <th>Program Prioritas (PP)</th>
                <th>Kegiatan Prioritas (KP)</th>
                <th>Proyek Prioritas (Pro-P)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($PN)): ?>
                <?php foreach ($PN as $pn): ?>
                <tr class="table-active">
                    <td colspan="4">
                        <strong><?= htmlspecialchars($pn['kode_pn']) ?> - <?= htmlspecialchars($pn['nama_pn']) ?></strong>
                        <small>(<?= $pn['tahun_mulai'] ?> - <?= $pn['tahun_akhir'] ?>)</small>
                        <?php if ($_SESSION['Level'] == 1): ?>
                        <div class="pull-right">
                            <button class="btn btn-xs btn-success" onclick="showModalAddPP(<?= $pn['id'] ?>)">
                                + Tambah PP
                            </button>
                            <button class="btn btn-xs btn-warning btnEditPN" data-id="<?= $pn['id'] ?>">Edit</button>
                            <button class="btn btn-xs btn-danger btnDeletePN" data-id="<?= $pn['id'] ?>">Hapus</button>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>

                <?php if (!empty($pn['PP'])): ?>
                    <?php foreach ($pn['PP'] as $pp): ?>
                    <tr>
                        <td></td>
                        <td>
                            <?= htmlspecialchars($pp['kode_pp']) ?> - <?= htmlspecialchars($pp['nama_pp']) ?>
                            <?php if ($_SESSION['Level'] == 1): ?>
                            <div class="pull-right">
                                <button class="btn btn-xs btn-success" onclick="showModalAddKP(<?= $pp['id'] ?>)">
                                    + Tambah KP
                                </button>
                                <button class="btn btn-xs btn-warning btnEditPP"
                                        data-id="<?= $pp['id'] ?>"
                                        data-kode="<?= htmlspecialchars($pp['kode_pp']) ?>"
                                        data-nama="<?= htmlspecialchars($pp['nama_pp']) ?>"
                                        data-ket="<?= htmlspecialchars($pp['keterangan'] ?? '') ?>">
                                    Edit
                                </button>
                                <button class="btn btn-xs btn-danger btnDeletePP" data-id="<?= $pp['id'] ?>">
                                    Hapus
                                </button>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td colspan="2"></td>
                    </tr>

                    <?php if (!empty($pp['KP'])): ?>
                        <?php foreach ($pp['KP'] as $kp): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?= htmlspecialchars($kp['kode_kp']) ?> - <?= htmlspecialchars($kp['nama_kp']) ?>
                                <?php if ($_SESSION['Level'] == 1): ?>
                                <div class="pull-right">
                                    <button class="btn btn-xs btn-success" onclick="showModalAddProP(<?= $kp['id'] ?>)">
                                        + Tambah Pro-P
                                    </button>
                                    <button class="btn btn-xs btn-warning btnEditKP"
                                            data-id="<?= $kp['id'] ?>"
                                            data-kode="<?= htmlspecialchars($kp['kode_kp']) ?>"
                                            data-nama="<?= htmlspecialchars($kp['nama_kp']) ?>"
                                            data-ket="<?= htmlspecialchars($kp['keterangan'] ?? '') ?>">
                                        Edit
                                    </button>
                                    <button class="btn btn-xs btn-danger btnDeleteKP" data-id="<?= $kp['id'] ?>">
                                        Hapus
                                    </button>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td></td>
                        </tr>

                        <?php if (!empty($kp['ProP'])): ?>
                            <?php foreach ($kp['ProP'] as $prop): ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?= htmlspecialchars($prop['kode_prop']) ?> - <?= htmlspecialchars($prop['nama_prop']) ?>
                                    <?php if ($_SESSION['Level'] == 1): ?>
                                    <div class="pull-right">
                                        <button class="btn btn-xs btn-warning btnEditProP"
                                                data-id="<?= $prop['id'] ?>"
                                                data-kode="<?= htmlspecialchars($prop['kode_prop']) ?>"
                                                data-nama="<?= htmlspecialchars($prop['nama_prop']) ?>"
                                                data-target="<?= htmlspecialchars($prop['target'] ?? '') ?>"
                                                data-indikator="<?= htmlspecialchars($prop['indikator'] ?? '') ?>"
                                                data-ket="<?= htmlspecialchars($prop['keterangan'] ?? '') ?>">
                                            Edit
                                        </button>
                                        <button class="btn btn-xs btn-danger btnDeleteProP" data-id="<?= $prop['id'] ?>">
                                            Hapus
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data Renstra</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah PN -->
<div class="modal fade" id="modalAddPN" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Prioritas Nasional</h4>
            </div>
            <div class="modal-body">
                <form id="formAddPN">
                    <div class="form-group">
                        <label>Kode PN</label>
                        <input type="text" class="form-control" name="kode_pn" required>
                    </div>
                    <div class="form-group">
                        <label>Nama PN</label>
                        <input type="text" class="form-control" name="nama_pn" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Mulai</label>
                        <input type="number" class="form-control" name="tahun_mulai" min="2000" max="2099" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Akhir</label>
                        <input type="number" class="form-control" name="tahun_akhir" min="2000" max="2099" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit PN -->
<div class="modal fade" id="modalEditPN" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit Prioritas Nasional</h4>
            </div>
            <div class="modal-body">
                <form id="formEditPN">
                    <input type="hidden" name="id" id="editPN_id">
                    <div class="form-group">
                        <label>Kode PN</label>
                        <input type="text" class="form-control" name="kode_pn" id="editPN_kode" required>
                    </div>
                    <div class="form-group">
                        <label>Nama PN</label>
                        <input type="text" class="form-control" name="nama_pn" id="editPN_nama" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Mulai</label>
                        <input type="number" class="form-control" name="tahun_mulai" id="editPN_mulai" min="2000" max="2099" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Akhir</label>
                        <input type="number" class="form-control" name="tahun_akhir" id="editPN_akhir" min="2000" max="2099" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="editPN_ket" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah PP -->
<div class="modal fade" id="modalAddPP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Program Prioritas</h4>
            </div>
            <div class="modal-body">
                <form id="formAddPP">
                    <input type="hidden" name="id_pn" id="addPP_id_pn">
                    <div class="form-group">
                        <label>Kode PP</label>
                        <input type="text" class="form-control" name="kode_pp" required>
                    </div>
                    <div class="form-group">
                        <label>Nama PP</label>
                        <input type="text" class="form-control" name="nama_pp" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit PP -->
<div class="modal fade" id="modalEditPP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit Program Prioritas</h4>
            </div>
            <div class="modal-body">
                <form id="formEditPP">
                    <input type="hidden" name="id" id="editPP_id">
                    <div class="form-group">
                        <label>Kode PP</label>
                        <input type="text" class="form-control" name="kode_pp" id="editPP_kode" required>
                    </div>
                    <div class="form-group">
                        <label>Nama PP</label>
                        <input type="text" class="form-control" name="nama_pp" id="editPP_nama" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="editPP_ket" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah KP -->
<div class="modal fade" id="modalAddKP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Kegiatan Prioritas</h4>
            </div>
            <div class="modal-body">
                <form id="formAddKP">
                    <input type="hidden" name="id_pp" id="addKP_id_pp">
                    <div class="form-group">
                        <label>Kode KP</label>
                        <input type="text" class="form-control" name="kode_kp" required>
                    </div>
                    <div class="form-group">
                        <label>Nama KP</label>
                        <input type="text" class="form-control" name="nama_kp" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit KP -->
<div class="modal fade" id="modalEditKP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit Kegiatan Prioritas</h4>
            </div>
            <div class="modal-body">
                <form id="formEditKP">
                    <input type="hidden" name="id" id="editKP_id">
                    <div class="form-group">
                        <label>Kode KP</label>
                        <input type="text" class="form-control" name="kode_kp" id="editKP_kode" required>
                    </div>
                    <div class="form-group">
                        <label>Nama KP</label>
                        <input type="text" class="form-control" name="nama_kp" id="editKP_nama" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="editKP_ket" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pro-P -->
<div class="modal fade" id="modalAddProP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Proyek Prioritas</h4>
            </div>
            <div class="modal-body">
                <form id="formAddProP">
                    <input type="hidden" name="id_kp" id="addProP_id_kp">
                    <div class="form-group">
                        <label>Kode Pro-P</label>
                        <input type="text" class="form-control" name="kode_prop" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pro-P</label>
                        <input type="text" class="form-control" name="nama_prop" required>
                    </div>
                    <div class="form-group">
                        <label>Target</label>
                        <textarea class="form-control" name="target" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Indikator</label>
                        <textarea class="form-control" name="indikator" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pro-P -->
<div class="modal fade" id="modalEditProP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit Proyek Prioritas</h4>
            </div>
            <div class="modal-body">
                <form id="formEditProP">
                    <input type="hidden" name="id" id="editProP_id">
                    <div class="form-group">
                        <label>Kode Pro-P</label>
                        <input type="text" class="form-control" name="kode_prop" id="editProP_kode" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pro-P</label>
                        <input type="text" class="form-control" name="nama_prop" id="editProP_nama" required>
                    </div>
                    <div class="form-group">
                        <label>Target</label>
                        <textarea class="form-control" name="target" id="editProP_target" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Indikator</label>
                        <textarea class="form-control" name="indikator" id="editProP_indikator" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="editProP_ket" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
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

// ===================== Tambah PN =====================
$("#formAddPN").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/InputPN", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Edit PN
$(document).on('click', '.btnEditPN', function() {
    var btn = $(this);
    $('#editPN_id').val(btn.data('id'));
    $('#editPN_kode').val(btn.data('kode'));
    $('#editPN_nama').val(btn.data('nama'));
    $('#editPN_mulai').val(btn.data('mulai'));
    $('#editPN_akhir').val(btn.data('akhir'));
    $('#editPN_ket').val(btn.data('ket'));
    $('#modalEditPN').modal('show');
});

$("#formEditPN").submit(function(e) {
    e.preventDefault();
    $.post(BaseURL + "Kementerian/UpdatePN", $(this).serialize())
        .done(function(res) {
            if (res.trim() === '1') {
                location.reload();
            } else {
                alert(res || 'Gagal mengupdate Prioritas Nasional');
            }
        })
        .fail(function() {
            alert('Gagal menghubungi server (Update PN)');
        });
});

// Hapus PN
$(document).on('click', '.btnDeletePN', function() {
    if (confirm('Yakin hapus Prioritas Nasional ini?\nSemua Program, Kegiatan, dan Proyek di bawahnya akan terhapus secara permanen.')) {
        var id = $(this).data('id');
        $.post(BaseURL + "Kementerian/DeletePN", {id: id})
            .done(function(res) {
                if (res.trim() === '1') {
                    location.reload();
                } else {
                    alert(res || 'Gagal menghapus Prioritas Nasional');
                }
            })
            .fail(function() {
                alert('Gagal menghubungi server (Hapus PN)');
            });
    }
});

// ===================== Tambah PP =====================
function showModalAddPP(id_pn) {
    $('#addPP_id_pn').val(id_pn);
    $('#modalAddPP').modal('show');
}

$("#formAddPP").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/InputPP", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Edit PP
$(document).on('click', '.btnEditPP', function() {
    var btn = $(this);
    $('#editPP_id').val(btn.data('id'));
    $('#editPP_kode').val(btn.data('kode'));
    $('#editPP_nama').val(btn.data('nama'));
    $('#editPP_ket').val(btn.data('ket'));
    $('#modalEditPP').modal('show');
});

$("#formEditPP").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/UpdatePP", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Hapus PP
$(document).on('click', '.btnDeletePP', function() {
    if (confirm('Yakin hapus Program Prioritas ini? Semua KP dan Pro-P di bawahnya juga akan terhapus.')) {
        var id = $(this).data('id');
        $.post(BaseURL + "Kementerian/DeletePP", {id: id}, function(res) {
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

// ===================== Tambah KP =====================
function showModalAddKP(id_pp) {
    $('#addKP_id_pp').val(id_pp);
    $('#modalAddKP').modal('show');
}

$("#formAddKP").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/InputKP", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Edit KP
$(document).on('click', '.btnEditKP', function() {
    var btn = $(this);
    $('#editKP_id').val(btn.data('id'));
    $('#editKP_kode').val(btn.data('kode'));
    $('#editKP_nama').val(btn.data('nama'));
    $('#editKP_ket').val(btn.data('ket'));
    $('#modalEditKP').modal('show');
});

$("#formEditKP").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/UpdateKP", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Hapus KP
$(document).on('click', '.btnDeleteKP', function() {
    if (confirm('Yakin hapus Kegiatan Prioritas ini? Semua Pro-P di bawahnya juga akan terhapus.')) {
        var id = $(this).data('id');
        $.post(BaseURL + "Kementerian/DeleteKP", {id: id}, function(res) {
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

// ===================== Tambah Pro-P =====================
function showModalAddProP(id_kp) {
    $('#addProP_id_kp').val(id_kp);
    $('#modalAddProP').modal('show');
}

$("#formAddProP").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/InputProP", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Edit Pro-P
$(document).on('click', '.btnEditProP', function() {
    var btn = $(this);
    $('#editProP_id').val(btn.data('id'));
    $('#editProP_kode').val(btn.data('kode'));
    $('#editProP_nama').val(btn.data('nama'));
    $('#editProP_target').val(btn.data('target'));
    $('#editProP_indikator').val(btn.data('indikator'));
    $('#editProP_ket').val(btn.data('ket'));
    $('#modalEditProP').modal('show');
});

$("#formEditProP").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post(BaseURL + "Kementerian/UpdateProP", formData, function(res) {
        if (res.trim() === '1') {
            location.reload();
        } else {
            alert(res);
        }
    }).fail(function() {
        alert('Gagal menghubungi server');
    });
});

// Hapus Pro-P
$(document).on('click', '.btnDeleteProP', function() {
    if (confirm('Yakin hapus Proyek Prioritas ini?')) {
        var id = $(this).data('id');
        $.post(BaseURL + "Kementerian/DeleteProP", {id: id}, function(res) {
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