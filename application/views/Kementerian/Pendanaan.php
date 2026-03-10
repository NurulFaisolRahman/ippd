<?php $this->load->view('Kementerian/Sidebar'); ?>

<!-- Library utama -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                <div class="breadcomb-list">
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
                            <span class="bread-blk">Matriks Pendanaan Renstra</span>
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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="tabelPendanaan" style="min-width: 2800px; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="background-color: #00c292 ; vertical-align: middle; width: 350px; color: white;">Kegiatan / Proyek Prioritas</th>
                                    <th rowspan="2" class="text-center" style="background-color: #00c292 ; vertical-align: middle; width: 280px; color: white;">Penugasan Indikator</th>
                                    <th colspan="5" class="text-center" style="background-color: #00c292 !important; color: white;">Target</th>
                                    <th colspan="5" class="text-center" style="background-color: #00c292 !important; color: white;">APBN (Rp)</th>
                                    <th colspan="5" class="text-center" style="background-color: #00c292 !important; color: white;">Non-APBN (Rp)</th>
                                    <th colspan="5" class="text-center" style="background-color: #00c292 !important; color: white;">Total (Rp)</th>
                                    <th rowspan="2" class="text-center" style="background-color: #00c292 ;vertical-align: middle; width: 180px; color: white;">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- Target 2025-2029 -->
                                    <th class="text-center" style="background-color: #00c292; color: white;">2025</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2026</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2027</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2028</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2029</th>
                                    <!-- APBN 2025-2029 -->
                                    <th class="text-center" style="background-color: #00c292; color: white;">2025</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2026</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2027</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2028</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2029</th>
                                    <!-- Non-APBN 2025-2029 -->
                                    <th class="text-center" style="background-color: #00c292; color: white;">2025</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2026</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2027</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2028</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2029</th>
                                    <!-- Total 2025-2029 -->
                                    <th class="text-center" style="background-color: #00c292; color: white;">2025</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2026</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2027</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2028</th>
                                    <th class="text-center" style="background-color: #00c292; color: white;">2029</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Kegiatan Prioritas (KP) -->
                                <?php if (!empty($Kegiatan)): ?>
                                    <?php foreach ($Kegiatan as $item): ?>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <strong><?= htmlspecialchars($item['kode_kp'] ?? '-') ?></strong><br>
                                            <small style="color: #555;"><?= htmlspecialchars($item['nama_kp'] ?? '-') ?></small>
                                        </td>
                                        <td style="vertical-align: middle; white-space: normal; word-wrap: break-word;">
                                            <?= htmlspecialchars($item['penugasan_indikator'] ?? '-') ?>
                                        </td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2025'] ?? 0 ?>" data-type="Target 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2026'] ?? 0 ?>" data-type="Target 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2027'] ?? 0 ?>" data-type="Target 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2028'] ?? 0 ?>" data-type="Target 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2029'] ?? 0 ?>" data-type="Target 2029"></td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2025'] ?? 0 ?>" data-type="APBN 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2026'] ?? 0 ?>" data-type="APBN 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2027'] ?? 0 ?>" data-type="APBN 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2028'] ?? 0 ?>" data-type="APBN 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2029'] ?? 0 ?>" data-type="APBN 2029"></td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2025'] ?? 0 ?>" data-type="Non-APBN 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2026'] ?? 0 ?>" data-type="Non-APBN 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2027'] ?? 0 ?>" data-type="Non-APBN 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2028'] ?? 0 ?>" data-type="Non-APBN 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2029'] ?? 0 ?>" data-type="Non-APBN 2029"></td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2025'] ?? 0 ?>" data-type="Total 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2026'] ?? 0 ?>" data-type="Total 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2027'] ?? 0 ?>" data-type="Total 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2028'] ?? 0 ?>" data-type="Total 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2029'] ?? 0 ?>" data-type="Total 2029"></td>

                                        <td class="text-center">
                                            <?php if ($_SESSION['Level'] == 1): ?>
                                            <div class="btn-group btn-group-sm"style="display: flex; gap: 5px; justify-content: center;">
                                                <button class="btn btn-success btn-sm btnTambahPendanaan"
                                                        data-jenis="KP" data-ref="<?= $item['kp_id'] ?>"
                                                        data-nama="<?= htmlspecialchars($item['nama_kp'] ?? 'Kegiatan Prioritas', ENT_QUOTES) ?>"
                                                        title="Tambah Pendanaan">
                                                    <i class="notika-icon notika-plus-symbol"></i>
                                                </button>
                                                <?php if (!empty($item['pend_id'])): ?>
                                                <button class="btn btn-warning btn-sm btnEditPendanaan"
                                                        data-id="<?= $item['pend_id'] ?>"
                                                        title="Edit Pendanaan">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm btnHapusPendanaan"
                                                        data-id="<?= $item['pend_id'] ?>"
                                                        title="Hapus Pendanaan">
                                                    <i class="notika-icon notika-trash"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <!-- Proyek Prioritas (ProP) -->
                                <?php if (!empty($Proyek)): ?>
                                    <?php foreach ($Proyek as $item): ?>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <strong><?= htmlspecialchars($item['kode_prop'] ?? '-') ?></strong><br>
                                            <small style="color: #555;"><?= htmlspecialchars($item['nama_prop'] ?? '-') ?></small>
                                        </td>
                                        <td style="vertical-align: middle; white-space: normal; word-wrap: break-word;">
                                            <?= htmlspecialchars($item['penugasan_indikator'] ?? '-') ?>
                                        </td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2025'] ?? 0 ?>" data-type="Target 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2026'] ?? 0 ?>" data-type="Target 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2027'] ?? 0 ?>" data-type="Target 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2028'] ?? 0 ?>" data-type="Target 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['target_2029'] ?? 0 ?>" data-type="Target 2029"></td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2025'] ?? 0 ?>" data-type="APBN 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2026'] ?? 0 ?>" data-type="APBN 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2027'] ?? 0 ?>" data-type="APBN 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2028'] ?? 0 ?>" data-type="APBN 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2029'] ?? 0 ?>" data-type="APBN 2029"></td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2025'] ?? 0 ?>" data-type="Non-APBN 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2026'] ?? 0 ?>" data-type="Non-APBN 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2027'] ?? 0 ?>" data-type="Non-APBN 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2028'] ?? 0 ?>" data-type="Non-APBN 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2029'] ?? 0 ?>" data-type="Non-APBN 2029"></td>

                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2025'] ?? 0 ?>" data-type="Total 2025"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2026'] ?? 0 ?>" data-type="Total 2026"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2027'] ?? 0 ?>" data-type="Total 2027"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2028'] ?? 0 ?>" data-type="Total 2028"></td>
                                        <td class="nilai-detail text-right" data-full="<?= $item['total_2029'] ?? 0 ?>" data-type="Total 2029"></td>

                                        <td class="text-center">
                                            <?php if ($_SESSION['Level'] == 1): ?>
                                            <div class="btn-group btn-group-sm"style="display: flex; gap: 5px; justify-content: center;">
                                                <button class="btn btn-success btn-sm btnTambahPendanaan"
                                                        data-jenis="ProP" data-ref="<?= $item['prop_id'] ?>"
                                                        data-nama="<?= htmlspecialchars($item['nama_prop'] ?? 'Proyek Prioritas', ENT_QUOTES) ?>"
                                                        title="Tambah Pendanaan">
                                                    <i class="notika-icon notika-plus-symbol"></i>
                                                </button>
                                                <?php if (!empty($item['pend_id'])): ?>
                                                <button class="btn btn-warning btn-sm btnEditPendanaan"
                                                        data-id="<?= $item['pend_id'] ?>"
                                                        title="Edit Pendanaan">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm btnHapusPendanaan"
                                                        data-id="<?= $item['pend_id'] ?>"
                                                        title="Hapus Pendanaan">
                                                    <i class="notika-icon notika-trash"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if (empty($Kegiatan) && empty($Proyek)): ?>
                                <tr>
                                    <td colspan="23" class="text-center text-muted" style="padding: 40px 0;">
                                        Belum ada data pendanaan.
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

<!-- Modal Detail Nilai -->
<div class="modal fade" id="modalDetailNilai" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 600px;"> <!-- Ditambah lebar menjadi 600px -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="detailTitle">Detail Nilai</h4>
            </div>
            <div class="modal-body" style="padding: 30px;"> <!-- Padding diperbesar -->
                <div class="detail-label" style="font-weight: bold; color: #666; margin-bottom: 10px; font-size: 14px;">Informasi Nilai Anggaran</div>
                <p id="jenisNilai" style="font-size: 18px; margin: 15px 0; font-weight: 500;"></p>
                <div class="detail-divider" style="border-top: 2px solid #00c292; margin: 20px 0; width: 100px; margin-left: auto; margin-right: auto;"></div>
                <h3 id="nilaiPenuh" style="color: #00c292; margin: 20px 0; font-size: 32px; font-weight: bold;"></h3>
                <p class="detail-satuan" style="color: #999; font-size: 13px; margin-top: 15px;">* Klik kolom lain untuk melihat detail nilai lainnya</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah / Edit Pendanaan -->
<div class="modal fade" id="modalPendanaan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background-color: #00c292; color: white; padding: 15px;">
                <h5 class="modal-title" id="modalPendanaanLabel" style="display: inline-block; margin: 0;">Input Pendanaan</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">×</button>
            </div>
            <div class="modal-body">
                <form id="formPendanaan">
                    <input type="hidden" name="id" id="pend_id">
                    <input type="hidden" name="jenis" id="pend_jenis">
                    <input type="hidden" name="id_ref" id="pend_id_ref">

                    <div class="form-group">
                        <label>Nama Kegiatan / Proyek</label>
                        <input type="text" class="form-control" id="pend_nama_entitas" readonly>
                    </div>

                    <div class="form-group">
                        <label>Penugasan / Indikator <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="penugasan_indikator" id="pend_indikator" rows="3" required></textarea>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #f5f5f5;">
                                <tr>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Target</th>
                                    <th class="text-center">APBN (Rp)</th>
                                    <th class="text-center">Non-APBN (Rp)</th>
                                    <th class="text-center">Total (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($th = 2025; $th <= 2029; $th++): ?>
                                <tr>
                                    <td class="text-center"><strong><?= $th ?></strong></td>
                                    <td><input type="number" class="form-control" name="target_<?= $th ?>" id="target_<?= $th ?>" min="0" step="1" value="0"></td>
                                    <td><input type="number" class="form-control" name="apbn_<?= $th ?>" id="apbn_<?= $th ?>" min="0" step="1" value="0"></td>
                                    <td><input type="number" class="form-control" name="non_apbn_<?= $th ?>" id="non_apbn_<?= $th ?>" min="0" step="1" value="0"></td>
                                    <td><input type="number" class="form-control" name="total_<?= $th ?>" id="total_<?= $th ?>" readonly style="background-color: #f9f9f9;" value="0"></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right" style="margin-top: 20px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Lengkap & Aman (tanpa CSRF) -->
<script>
var BaseURL = '<?= base_url() ?>';
if (BaseURL.slice(-1) !== '/') BaseURL += '/';

// Format ringkas (Miliar, Juta, dll)
function formatRingkas(nilai) {
    nilai = parseFloat(nilai) || 0;
    if (nilai === 0) return '0';

    if (nilai >= 1e12) return (nilai / 1e12).toFixed(2).replace(/\.00$/, '') + ' Trilliun';
    if (nilai >= 1e9)  return (nilai / 1e9).toFixed(2).replace(/\.00$/, '') + ' Milyar';
    if (nilai >= 1e6)  return (nilai / 1e6).toFixed(2).replace(/\.00$/, '') + ' Juta';
    if (nilai >= 1e3)  return (nilai / 1e3).toFixed(1).replace(/\.0$/, '') + ' Ribu';
    return nilai.toLocaleString('id-ID');
}

// Format penuh dengan Rp untuk modal
function formatPenuh(nilai) {
    return 'Rp ' + (parseFloat(nilai) || 0).toLocaleString('id-ID');
}

// Terapkan format ringkas ke semua sel
$(document).ready(function() {
    $('.nilai-detail').each(function() {
        let full = $(this).data('full');
        $(this).html(formatRingkas(full));
    });
});

// Klik sel nilai → modal detail
$(document).on('click', '.nilai-detail', function(e) {
    if ($(e.target).closest('.btn-group').length) return;

    let full = $(this).data('full');
    let type = $(this).data('type');

    $('#nilaiPenuh').text(formatPenuh(full));
    $('#jenisNilai').text(type);
    $('#detailTitle').text('Detail ' + type);
    $('#modalDetailNilai').modal('show');
});

// Hitung total di modal tambah/edit
function hitungTotal(tahun) {
    let apbn = parseFloat($('#apbn_' + tahun).val()) || 0;
    let non  = parseFloat($('#non_apbn_' + tahun).val()) || 0;
    $('#total_' + tahun).val(apbn + non);
}

$(document).on('input', '[name^="apbn_"], [name^="non_apbn_"]', function() {
    let tahun = $(this).attr('name').split('_')[1];
    hitungTotal(tahun);
});

// Tambah Pendanaan
$(document).on('click', '.btnTambahPendanaan', function() {
    let jenis = $(this).data('jenis');
    let id_ref = $(this).data('ref');
    let nama = $(this).data('nama');

    $('#pend_id').val('');
    $('#pend_jenis').val(jenis);
    $('#pend_id_ref').val(id_ref);
    $('#pend_nama_entitas').val(nama);
    $('#pend_indikator').val('');

    for (let th = 2025; th <= 2029; th++) {
        $('#target_' + th).val(0);
        $('#apbn_' + th).val(0);
        $('#non_apbn_' + th).val(0);
        $('#total_' + th).val(0);
    }

    $('#modalPendanaanLabel').text('Tambah Pendanaan ' + (jenis === 'KP' ? 'Kegiatan Prioritas' : 'Proyek Prioritas'));
    $('#modalPendanaan').modal('show');
});

// Edit Pendanaan
$(document).on('click', '.btnEditPendanaan', function() {
    let id = $(this).data('id');
    $.post(BaseURL + "Kementerian/GetPendanaanById", {id: id}, function(res) {
        if (res.status === 'success') {
            let d = res.data;
            $('#pend_id').val(d.id);
            $('#pend_jenis').val(d.jenis);
            $('#pend_id_ref').val(d.jenis === 'KP' ? d.id_kp : d.id_prop);
            $('#pend_nama_entitas').val(d.nama_entitas || '');
            $('#pend_indikator').val(d.penugasan_indikator || '');

            for (let th = 2025; th <= 2029; th++) {
                $('#target_' + th).val(d['target_' + th] || 0);
                $('#apbn_' + th).val(d['apbn_' + th] || 0);
                $('#non_apbn_' + th).val(d['non_apbn_' + th] || 0);
                $('#total_' + th).val(d['total_' + th] || 0);
            }

            $('#modalPendanaanLabel').text('Edit Pendanaan');
            $('#modalPendanaan').modal('show');
        } else {
            alert(res.message || 'Gagal memuat data');
        }
    }, 'json').fail(() => alert('Gagal menghubungi server'));
});

// Simpan Pendanaan
$("#formPendanaan").submit(function(e) {
    e.preventDefault();
    let formData = $(this).serialize();

    $.post(BaseURL + "Kementerian/SavePendanaan", formData, function(res) {
        if (res.status === 'success') {
            $('#modalPendanaan').modal('hide');
            alert(res.message || 'Data berhasil disimpan');
            location.reload();
        } else {
            alert(res.message || 'Gagal menyimpan');
        }
    }, 'json').fail(() => alert('Gagal menghubungi server'));
});

// Hapus Pendanaan
$(document).on('click', '.btnHapusPendanaan', function() {
    let id = $(this).data('id');
    if (!confirm('Yakin hapus data pendanaan ini?')) return;

    $.post(BaseURL + "Kementerian/DeletePendanaan", {id: id}, function(res) {
        if (res.status === 'success') {
            alert('Data berhasil dihapus');
            location.reload();
        } else {
            alert(res.message || 'Gagal menghapus');
        }
    }, 'json').fail(() => alert('Gagal menghubungi server'));
});
</script>