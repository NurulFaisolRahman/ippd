<?php $this->load->view('Kementerian/Sidebar'); ?>

<!-- Library utama (sudah ada di header/sidebar Notika) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


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
                            <span class="bread-blk">Matriks Kinerja dan Pendanaan</span>
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

                    <div class="basic-tb-hd" style="margin-bottom: 15px;">
                        <?php if ($_SESSION['Level'] == 1): ?>
                        <!-- <button type="button" class="btn btn-success notika-btn-success" id="btnPanduanTambah" title="Petunjuk Tambah Rincian">
                            <i class="notika-icon notika-plus-symbol"></i>
                        </button> -->
                        <?php endif; ?>
                    </div>

                    <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tabelMatriks" style="min-width: 3200px; font-size: 12px;">
        <thead>
            <tr>
                <th rowspan="2" class="text-center" style="background-color: #00c292; color: white; vertical-align: middle; width: 50px;">No</th>
                <th rowspan="2" class="text-center" style="background-color: #00c292; color: white; vertical-align: middle; width: 300px;">Program / Kegiatan / Rincian Output</th>
                <th rowspan="2" class="text-center" style="background-color: #00c292; color: white; vertical-align: middle; width: 250px;">Sasaran / Indikator</th>
                <th rowspan="2" class="text-center" style="background-color: #00c292; color: white; vertical-align: middle; width: 150px;">Lokasi</th>
                <th colspan="5" class="text-center" style="background-color: #00b686; color: white;">Target</th>
                <th colspan="5" class="text-center" style="background-color: #00b686; color: white;">APBN (Rp)</th>
                <th colspan="5" class="text-center" style="background-color: #00b686; color: white;">Non-APBN (Rp)</th>
                <th colspan="5" class="text-center" style="background-color: #00b686; color: white;">Total (Rp)</th>
                <th rowspan="2" class="text-center" style="background-color: #00c292; color: white; vertical-align: middle; width: 80px;">Satuan</th>
                <th rowspan="2" class="text-center" style="background-color: #00c292; color: white; vertical-align: middle; width: 150px;">Unit Organisasi</th>
                <th rowspan="2" class="text-center" style="background-color: #00c292; color: white; vertical-align: middle; width: 200px;">Aksi</th>
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
            <?php if (!empty($DataMatriks)): ?>
                <?php $no = 1; $current_program = null; $current_kegiatan = null; ?>
                <?php foreach ($DataMatriks as $item): ?>
                    <?php 
                    if ($current_program != $item['program_id']): 
                        $current_program = $item['program_id'];
                        $current_kegiatan = null;
                    ?>
                    <tr class="active" style="background-color: #e8f4f8;">
                        <td colspan="28" style="padding: 8px 15px;">
                            <strong style="color: #00c292;">PROGRAM: <?= htmlspecialchars($item['kode_program'] ?? '-') ?> - <?= htmlspecialchars($item['nama_program'] ?? '-') ?></strong>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php 
                    if ($current_kegiatan != $item['kegiatan_id']): 
                        $current_kegiatan = $item['kegiatan_id'];
                    ?>
                    <tr class="warning" style="background-color: #fff3e0;">
                        <td colspan="28" style="padding: 8px 15px;">
                            <strong style="color: #f39c12;">KEGIATAN: <?= htmlspecialchars($item['kode_kegiatan'] ?? '-') ?> - <?= htmlspecialchars($item['nama_kegiatan'] ?? '-') ?></strong>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><?= $no++ ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($item['kode_rincian'] ?? '-') ?> - <?= htmlspecialchars($item['nama_rincian'] ?? '-') ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($item['indikator'] ?? '-') ?></td>
                        <td style="vertical-align: middle;"><?= htmlspecialchars($item['lokasi'] ?? '-') ?></td>

                        <!-- Target Cells -->
                        <td class="nilai-detail text-right" data-full="<?= $item['target_2025'] ?? 0 ?>" data-type="Target 2025" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['target_2026'] ?? 0 ?>" data-type="Target 2026" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['target_2027'] ?? 0 ?>" data-type="Target 2027" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['target_2028'] ?? 0 ?>" data-type="Target 2028" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['target_2029'] ?? 0 ?>" data-type="Target 2029" style="text-align: center; "></td>

                        <!-- APBN Cells -->
                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2025'] ?? 0 ?>" data-type="APBN 2025" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2026'] ?? 0 ?>" data-type="APBN 2026" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2027'] ?? 0 ?>" data-type="APBN 2027" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2028'] ?? 0 ?>" data-type="APBN 2028" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['apbn_2029'] ?? 0 ?>" data-type="APBN 2029" style="text-align: center; "></td>

                        <!-- Non-APBN Cells -->
                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2025'] ?? 0 ?>" data-type="Non-APBN 2025" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2026'] ?? 0 ?>" data-type="Non-APBN 2026" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2027'] ?? 0 ?>" data-type="Non-APBN 2027" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2028'] ?? 0 ?>" data-type="Non-APBN 2028" style="text-align: center; "></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['non_apbn_2029'] ?? 0 ?>" data-type="Non-APBN 2029" style="text-align: center; "></td>

                        <!-- Total Cells -->
                        <td class="nilai-detail text-right" data-full="<?= $item['total_2025'] ?? 0 ?>" data-type="Total 2025" style="text-align: center;  f"></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['total_2026'] ?? 0 ?>" data-type="Total 2026" style="text-align: center;  f"></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['total_2027'] ?? 0 ?>" data-type="Total 2027" style="text-align: center;  f"></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['total_2028'] ?? 0 ?>" data-type="Total 2028" style="text-align: center;  f"></td>
                        <td class="nilai-detail text-right" data-full="<?= $item['total_2029'] ?? 0 ?>" data-type="Total 2029" style="text-align: center;  f"></td>

                        <td class="text-center" style="vertical-align: middle;"><?= htmlspecialchars($item['satuan'] ?? '-') ?></td>
                        <td class="text-center" style="vertical-align: middle;"><?= htmlspecialchars($item['unit_organisasi'] ?? '-') ?></td>
                        <td class="text-center" style="vertical-align: middle;">
                            <?php if ($_SESSION['Level'] == 1): ?>
                            <div class="btn-group btn-group-sm" style="display: flex; gap: 3px; justify-content: center;">
                                <?php if (empty($item['pend_id'])): ?>
                                <button class="btn btn-success btn-sm btnTambahMatriks" 
                                        style="background-color: #00c292; border-color: #00a57a;"
                                        data-rincian-id="<?= $item['rincian_id'] ?? 0 ?>"
                                        data-nama-rincian="<?= htmlspecialchars($item['nama_rincian'] ?? 'Rincian Baru', ENT_QUOTES) ?>"
                                        title="Tambah Data Baru">
                                    <i class="notika-icon notika-plus-symbol"></i>
                                </button>
                                <?php else: ?>
                                <button class="btn btn-warning btn-sm btnEditMatriks" 
                                        style="background-color: #f39c12; border-color: #e67e22;"
                                        data-id="<?= $item['pend_id'] ?>"
                                        title="Edit Data">
                                    <i class="notika-icon notika-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btnHapusMatriks" 
                                        style="background-color: #e74c3c; border-color: #c0392b;"
                                        data-id="<?= $item['pend_id'] ?>"
                                        title="Hapus Data">
                                    <i class="notika-icon notika-trash"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="28" class="text-center text-muted" style="padding: 40px 0;">
                        Belum ada data matriks kinerja dan pendanaan.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Detail Nilai - Muncul di tengah halaman (vertikal & horizontal) -->
<!-- Link CSS (letakkan di <head> atau setelah library Bootstrap) -->
<link rel="stylesheet" href="<?= base_url('assets/css/modal-detail-nilai.css') ?>">

<!-- Modal Detail Nilai -->
<div class="modal fade" id="modalDetailNilai" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="detailTitle">Detail Nilai</h4>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Badge label -->
                <div class="detail-label">Informasi Nilai Anggaran</div>

                <!-- Jenis Nilai -->
                <p id="jenisNilai"></p>

                <!-- Divider -->
                <div class="detail-divider"></div>

                <!-- Nilai Penuh -->
                <h3 id="nilaiPenuh"></h3>

                <!-- Keterangan satuan -->
                <p class="detail-satuan">* Klik kolom lain untuk melihat detail nilai lainnya</p>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Tambah / Edit -->
<div class="modal fade" id="modalMatriks" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalMatriksLabel">Input Matriks Kinerja & Pendanaan</h5>
                <button type="button" class="close text-white" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <form id="formMatriks">
                    <input type="hidden" name="id" id="matriks_id">
                    <input type="hidden" name="id_rincian" id="matriks_id_rincian" required>
                    <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>">

                    <div class="form-group">
                        <label>Rincian Output</label>
                        <input type="text" class="form-control" id="matriks_nama_rincian" readonly>
                    </div>

                    <div class="form-group">
                        <label>Indikator Kinerja <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="indikator" id="matriks_indikator" rows="3" required></textarea>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
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
                                    <td><input type="number" class="form-control" name="target_<?= $th ?>" id="target_<?= $th ?>" min="0" value="0"></td>
                                    <td><input type="number" class="form-control" name="apbn_<?= $th ?>" id="apbn_<?= $th ?>" min="0" value="0"></td>
                                    <td><input type="number" class="form-control" name="non_apbn_<?= $th ?>" id="non_apbn_<?= $th ?>" min="0" value="0"></td>
                                    <td><input type="number" class="form-control bg-light" name="total_<?= $th ?>" id="total_<?= $th ?>" readonly value="0"></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    var BaseURL = '<?= base_url() ?>';
    if (BaseURL.slice(-1) !== '/') BaseURL += '/';

    var csrfName = '<?= $csrf_name ?>';
    var csrfHash = '<?= $csrf_hash ?>';

    function formatRingkas(nilai) {
        nilai = parseFloat(nilai) || 0;
        if (nilai === 0) return '0';

        if (nilai >= 1e12) return (nilai / 1e12).toFixed(2).replace(/\.00$/, '') + ' Triliun';
        if (nilai >= 1e9)  return (nilai / 1e9).toFixed(2).replace(/\.00$/, '') + ' Miliar';
        if (nilai >= 1e6)  return (nilai / 1e6).toFixed(2).replace(/\.00$/, '') + ' Juta';
        if (nilai >= 1e3)  return (nilai / 1e3).toFixed(1).replace(/\.0$/, '') + ' Ribu';
        return nilai.toLocaleString('id-ID');
    }

    $('.nilai-detail').each(function() {
        $(this).text(formatRingkas($(this).data('full')));
    });

    $(document).on('click', '.nilai-detail', function() {
        let full = $(this).data('full');
        let type = $(this).data('type');

        $('#nilaiPenuh').text(full.toLocaleString('id-ID'));
        $('#jenisNilai').text(type);
        $('#detailTitle').text('Detail ' + type);
        $('#modalDetailNilai').modal('show');
    });

    function hitungTotal(tahun) {
        let apbn = parseFloat($('#apbn_' + tahun).val()) || 0;
        let non = parseFloat($('#non_apbn_' + tahun).val()) || 0;
        $('#total_' + tahun).val(apbn + non);
    }

    $(document).on('input', '[name^="apbn_"], [name^="non_apbn_"]', function() {
        let tahun = $(this).attr('name').split('_')[1];
        hitungTotal(tahun);
    });

    $('#btnPanduanTambah').click(function() {
        alert('Silakan klik tombol Tambah pada baris rincian di tabel yang sesuai.');
    });

    $(document).on('click', '.btnTambahMatriks', function() {
        let id_rincian = $(this).data('rincian-id');
        let nama_rincian = $(this).data('nama-rincian');

        if (!id_rincian || id_rincian <= 0) return alert('ID rincian tidak valid.');

        $('#matriks_id').val('');
        $('#matriks_id_rincian').val(id_rincian);
        $('#matriks_nama_rincian').val(nama_rincian || 'Rincian Baru');
        $('#matriks_indikator').val('');

        for (let th = 2025; th <= 2029; th++) {
            $('#target_' + th).val(0);
            $('#apbn_' + th).val(0);
            $('#non_apbn_' + th).val(0);
            $('#total_' + th).val(0);
        }

        $('#modalMatriksLabel').text('Tambah Matriks Kinerja & Pendanaan');
        $('#modalMatriks').modal('show');
    });

    $(document).on('click', '.btnEditMatriks', function() {
        let id = $(this).data('id');
        if (!id) return alert('ID tidak ditemukan');

        $.post(BaseURL + "Kementerian/GetMatriksById", {id: id, [csrfName]: csrfHash}, function(res) {
            if (res.status === 'success' && res.data) {
                let d = res.data;

                $('#matriks_id').val(d.id);
                $('#matriks_id_rincian').val(d.id_rincian);
                $('#matriks_indikator').val(d.indikator);

                for (let th = 2025; th <= 2029; th++) {
                    $('#target_' + th).val(d['target_' + th] || 0);
                    $('#apbn_' + th).val(d['apbn_' + th] || 0);
                    $('#non_apbn_' + th).val(d['non_apbn_' + th] || 0);
                    $('#total_' + th).val(d['total_' + th] || 0);
                }

                $('#modalMatriksLabel').text('Edit Matriks Kinerja & Pendanaan');
                $('#modalMatriks').modal('show');
            } else {
                alert(res.message || 'Gagal memuat data');
            }
        }, 'json').fail(() => alert('Gagal menghubungi server'));
    });

    $("#formMatriks").submit(function(e) {
        e.preventDefault();

        let id_rincian = $('#matriks_id_rincian').val();
        if (!id_rincian || id_rincian <= 0) return alert('ID rincian tidak terdeteksi.');

        let formData = $(this).serialize();

        $.post(BaseURL + "Kementerian/SaveMatriks", formData, function(res) {
            if (res.status === 'success') {
                $('#modalMatriks').modal('hide');
                alert(res.message || 'Data berhasil disimpan');
                location.reload();
            } else {
                alert(res.message || 'Gagal menyimpan data');
            }
        }, 'json').fail(() => alert('Gagal menghubungi server'));
    });

    $(document).on('click', '.btnHapusMatriks', function() {
        let id = $(this).data('id');
        if (!id) return alert('ID tidak ditemukan');

        if (!confirm('Yakin menghapus data ini?')) return;

        $.post(BaseURL + "Kementerian/DeleteMatriks", {id: id, [csrfName]: csrfHash}, function(res) {
            if (res.status === 'success') {
                alert(res.message || 'Data berhasil dihapus');
                location.reload();
            } else {
                alert(res.message || 'Gagal menghapus');
            }
        }, 'json').fail(() => alert('Gagal menghubungi server'));
    });

        function formatPenuh(nilai) {
        return 'Rp ' + (parseFloat(nilai) || 0).toLocaleString('id-ID');
    }

    $('.nilai-detail').each(function() {
        $(this).text(formatRingkas($(this).data('full')));
    });

    $(document).on('click', '.nilai-detail', function() {
        let full = $(this).data('full');
        let type = $(this).data('type');

        $('#nilaiPenuh').text(formatPenuh(full));
        $('#jenisNilai').text(type);
        $('#detailTitle').text('Detail ' + type);
        $('#modalDetailNilai').modal('show');
});
});
</script>