<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
    /* --- Gaya umum --- */
    #data-table-pk th, #data-table-pk td {
        font-size: 12px;
        vertical-align: middle;
    }
    .status-dropdown {
        padding: 3px 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 12px;
        background-color: #fff;
    }
    .btn-pk {
        padding: 2px 10px;
        font-size: 11px;
        margin: 0 2px;
    }
    .badge-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        color: #fff;
    }
    .badge-menunggu { background: #f0ad4e; }
    .badge-ditinjau { background: #5bc0de; }
    .badge-disetujui { background: #5cb85c; }
    .table-wrap { overflow-x: auto; }

    /* --- Modal lebih lebar --- */
    .modal-very-wide {
        max-width: 1200px;
        width: 95%;
    }
    
    .modal-very-wide .modal-content {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .modal-very-wide .modal-body {
        padding: 25px 30px;
    }

    .form-pk label {
        font-weight: 600;
        margin-bottom: 4px;
        display: block;
    }
    .form-pk .required { color: red; }
    .form-pk .form-group { margin-bottom: 18px; }

    /* Detail pegawai/atasan muncul dalam kotak abu-abu */
    .detail-box {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 12px 15px;
        margin-top: 8px;
        display: none; /* disembunyikan sampai ada pilihan */
    }
    .detail-box .detail-item {
        display: inline-block;
        margin-right: 25px;
        font-size: 13px;
    }
    .detail-box .detail-item strong {
        display: inline-block;
        min-width: 80px;
        color: #495057;
    }
    .detail-box .detail-item span {
        color: #212529;
    }
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Perjanjian Kinerja</h2>
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalPK">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah PK</b>
                                </button>
                            </div>
                        </div>

                        <div class="table-wrap">
                            <table id="data-table-pk" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:40px;">No</th>
                                        <th>Nama / NIP / Jabatan</th>
                                        <th>Eselon</th>
                                        <th>Awal</th>
                                        <th>Akhir</th>
                                        <th>Definitif</th>
                                        <th>Jenis PK</th>
                                        <th>Status</th>
                                        <th class="text-center" style="width:180px;">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($PKData)): ?>
                                        <?php $no = 1; foreach ($PKData as $row): ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td>
                                                    <strong><?= htmlspecialchars($row['karyawan_nama'] ?? '-') ?></strong><br>
                                                    <small>NIP: <?= htmlspecialchars($row['karyawan_nip'] ?? '-') ?></small><br>
                                                    <small><?= htmlspecialchars($row['karyawan_jabatan'] ?? '-') ?></small>
                                                    <?php if (!empty($row['karyawan_satuan'])): ?>
                                                        <br><small><i><?= htmlspecialchars($row['karyawan_satuan']) ?></i></small>
                                                    <?php endif; ?>
                                                    <?php if (!empty($row['atasan_nama'])): ?>
                                                        <br><small><span class="text-muted">Atasan: <?= htmlspecialchars($row['atasan_nama']) ?></span></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($row['karyawan_eselon'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($row['periode_awal'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($row['periode_akhir'] ?? '-') ?></td>
                                                <td>
                                                    <?php if (!empty($row['dokumen_definitif'])): ?>
                                                        <a href="<?= base_url($row['dokumen_definitif']) ?>" target="_blank" title="Lihat dokumen">
                                                            <i class="fa fa-file-pdf-o"></i> DOC ID: <?= $row['id'] ?>
                                                        </a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($row['jenis_pk'] ?? '-') ?></td>
                                                <td>
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3): ?>
                                                        <select class="status-dropdown" data-id="<?= $row['id'] ?>">
                                                            <option value="menunggu" <?= $row['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                                            <option value="ditinjau" <?= $row['status'] == 'ditinjau' ? 'selected' : '' ?>>Ditinjau</option>
                                                            <option value="disetujui" <?= $row['status'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                                                        </select>
                                                    <?php else: ?>
                                                        <span class="badge-status badge-<?= $row['status'] ?>">
                                                            <?= ucfirst($row['status']) ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-xs">
                                                        <button class="btn btn-primary btn-pk btn-edit-pk" data-id="<?= $row['id'] ?>" title="Edit PK">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>
                                                        <?php if (isset($IsRole4) && $IsRole4 && isset($InstansiId) && $row['created_by'] == $InstansiId): ?>
                                                            <button class="btn btn-danger btn-pk btn-hapus-pk" data-id="<?= $row['id'] ?>" title="Hapus">
                                                                <i class="notika-icon notika-trash"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                        <?php if (!empty($row['dokumen_definitif']) || !empty($row['dokumen_lampiran'])): ?>
                                                            <button class="btn btn-info btn-pk btn-lihat-dokumen" data-id="<?= $row['id'] ?>" title="Lihat Dokumen">
                                                                <i class="notika-icon notika-eye"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- Tidak ada baris dengan colspan, DataTables akan menampilkan pesan kosong -->
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================= -->
<!-- MODAL TAMBAH / EDIT PK (LEBAR) -->
<!-- ========================================================= -->
<div class="modal fade" id="ModalPK" tabindex="-1" role="dialog" aria-labelledby="modalPKTitle">
    <div class="modal-dialog modal-very-wide" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalPKTitle">Tambah Perjanjian Kinerja</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formPK" enctype="multipart/form-data" class="form-pk">
                    <input type="hidden" name="id" id="pk_id" value="0">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                    <div class="row">
                        <!-- ====== KOLOM KIRI: PEGAWAI ====== -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Pegawai <span class="required">*</span></label>
                                <select class="form-control" name="id_karyawan" id="id_karyawan" required>
                                    <option value="">-- Pilih Pegawai --</option>
                                    <?php if (!empty($karyawan_list)): ?>
                                        <?php foreach ($karyawan_list as $k): ?>
                                            <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama']) ?> - <?= htmlspecialchars($k['nip']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <!-- Detail pegawai -->
                            <div class="detail-box" id="detail_pegawai">
                                <div class="detail-item"><strong>NIP:</strong> <span id="nip_pengampu">-</span></div>
                                <div class="detail-item"><strong>Nama:</strong> <span id="nama_pengampu">-</span></div>
                                <div class="detail-item"><strong>Jabatan:</strong> <span id="jabatan_pengampu">-</span></div>
                                <div class="detail-item"><strong>Satuan Unit Kerja:</strong> <span id="satuan_pengampu">-</span></div>
                            </div>
                        </div>

                        <!-- ====== KOLOM KANAN: ATASAN ====== -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Atasan Langsung <span class="required">*</span></label>
                                <select class="form-control" name="id_atasan" id="id_atasan" required>
                                    <option value="">-- Pilih Atasan --</option>
                                    <?php if (!empty($atasan_list)): ?>
                                        <?php foreach ($atasan_list as $a): ?>
                                            <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nama']) ?> - <?= htmlspecialchars($a['nip']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <!-- Detail atasan -->
                            <div class="detail-box" id="detail_atasan">
                                <div class="detail-item"><strong>NIP:</strong> <span id="nip_atasan">-</span></div>
                                <div class="detail-item"><strong>Nama:</strong> <span id="nama_atasan">-</span></div>
                                <div class="detail-item"><strong>Jabatan:</strong> <span id="jabatan_atasan">-</span></div>
                                <div class="detail-item"><strong>Satuan Unit Kerja:</strong> <span id="satuan_atasan">-</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- ====== BARIS KEDUA: Jenis PK & Sasaran ====== -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Perjanjian <span class="required">*</span></label>
                                <input type="text" class="form-control" name="jenis_pk" id="jenis_pk" placeholder="Contoh: PK Murni, PK Perubahan, PK PLT" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sasaran <span class="required">*</span></label>
                                <input type="text" class="form-control" name="sasaran" id="sasaran" required>
                            </div>
                        </div>
                    </div>

                    <!-- ====== BARIS KETIGA: Periode, Anggaran, Tahun ====== -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Periode Awal</label>
                                <input type="text" class="form-control" name="periode_awal" id="periode_awal" placeholder="Januari">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Periode Akhir</label>
                                <input type="text" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Desember">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Anggaran</label>
                                <input type="text" class="form-control" name="anggaran" id="anggaran" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" name="tahun" id="tahun" value="<?= date('Y') ?>" min="2020" max="2030">
                            </div>
                        </div>
                    </div>

                    <!-- ====== SASARAN PROGRAM & PERNYATAAN ====== -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sasaran Program / Kegiatan / Sub Kegiatan</label>
                                <textarea class="form-control" name="sasaran_program" id="sasaran_program" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pernyataan</label>
                                <textarea class="form-control" name="pernyataan" id="pernyataan" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ====== UPLOAD DOKUMEN ====== -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dokumen Definitif (Halaman Utama)</label>
                                <input type="file" class="form-control" name="dokumen_definitif" id="dokumen_definitif" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                <small id="file_definitif_existing" style="display:none;">
                                    <a href="#" target="_blank" id="link_definitif">Lihat file saat ini</a>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dokumen Lampiran</label>
                                <input type="file" class="form-control" name="dokumen_lampiran" id="dokumen_lampiran" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                                <small id="file_lampiran_existing" style="display:none;">
                                    <a href="#" target="_blank" id="link_lampiran">Lihat file saat ini</a>
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- ====== TOMBOL ====== -->
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success" id="btnSimpanPK">
                                <i class="notika-icon bi-save"></i> Simpan
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================= -->
<!-- MODAL LIHAT DOKUMEN -->
<!-- ========================================================= -->
<div class="modal fade" id="modalDokumen" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dokumen Perjanjian Kinerja</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modalDokumenBody">
                <p>Memuat...</p>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================= -->
<!-- SCRIPTS -->
<!-- ========================================================= -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js') ?>"></script>

<script>
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

    $(document).ready(function() {
        // =========================================================
        // 1. INISIALISASI DATATABLE
        // =========================================================
        if ($.fn.DataTable.isDataTable('#data-table-pk')) {
            $('#data-table-pk').DataTable().destroy();
        }
        $('#data-table-pk').DataTable({
            "pageLength": 10,
            "ordering": true,
            "columns": [
                { "data": null, "width": "40px" },
                { "data": null },
                { "data": null },
                { "data": null },
                { "data": null },
                { "data": null },
                { "data": null },
                { "data": null },
                { "data": null, "width": "180px" }
            ],
            "language": {
                "emptyTable": "Belum ada data Perjanjian Kinerja",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // =========================================================
        // 2. AUTO FILL DATA PEGAWAI (muncul di detail box)
        // =========================================================
        $(document).on('change', '#id_karyawan', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: BaseURL + "Instansi/GetDataKaryawan",
                    type: "POST",
                    data: {
                        id: id,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#nip_pengampu').text(res.data.nip || '-');
                            $('#nama_pengampu').text(res.data.nama || '-');
                            $('#jabatan_pengampu').text(res.data.jabatan || '-');
                            $('#satuan_pengampu').text(res.data.satuan_unit_kerja || '-');
                            $('#detail_pegawai').show();
                        } else {
                            $('#nip_pengampu, #nama_pengampu, #jabatan_pengampu, #satuan_pengampu').text('-');
                            $('#detail_pegawai').hide();
                        }
                    },
                    error: function() {
                        $('#nip_pengampu, #nama_pengampu, #jabatan_pengampu, #satuan_pengampu').text('-');
                        $('#detail_pegawai').hide();
                    }
                });
            } else {
                $('#nip_pengampu, #nama_pengampu, #jabatan_pengampu, #satuan_pengampu').text('-');
                $('#detail_pegawai').hide();
            }
        });

        // =========================================================
        // 3. AUTO FILL DATA ATASAN
        // =========================================================
        $(document).on('change', '#id_atasan', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: BaseURL + "Instansi/GetDataKaryawan",
                    type: "POST",
                    data: {
                        id: id,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#nip_atasan').text(res.data.nip || '-');
                            $('#nama_atasan').text(res.data.nama || '-');
                            $('#jabatan_atasan').text(res.data.jabatan || '-');
                            $('#satuan_atasan').text(res.data.satuan_unit_kerja || '-');
                            $('#detail_atasan').show();
                        } else {
                            $('#nip_atasan, #nama_atasan, #jabatan_atasan, #satuan_atasan').text('-');
                            $('#detail_atasan').hide();
                        }
                    },
                    error: function() {
                        $('#nip_atasan, #nama_atasan, #jabatan_atasan, #satuan_atasan').text('-');
                        $('#detail_atasan').hide();
                    }
                });
            } else {
                $('#nip_atasan, #nama_atasan, #jabatan_atasan, #satuan_atasan').text('-');
                $('#detail_atasan').hide();
            }
        });

        // =========================================================
        // 4. FORMAT RUPIAH
        // =========================================================
        $('#anggaran').on('keyup', function() {
            var val = $(this).val().replace(/[^0-9]/g, '');
            if (val) {
                $(this).val(parseInt(val).toLocaleString('id-ID'));
            }
        });

        // =========================================================
        // 5. TAMBAH PK - BERSIHKAN FORM
        // =========================================================
        $('[data-toggle="modal"][data-target="#ModalPK"]').click(function() {
            $('#modalPKTitle').text('Tambah Perjanjian Kinerja');
            $('#formPK')[0].reset();
            $('#pk_id').val(0);
            $('#nip_pengampu, #nama_pengampu, #jabatan_pengampu, #satuan_pengampu').text('-');
            $('#nip_atasan, #nama_atasan, #jabatan_atasan, #satuan_atasan').text('-');
            $('#detail_pegawai, #detail_atasan').hide();
            $('#file_definitif_existing, #file_lampiran_existing').hide();
            $('#tahun').val(new Date().getFullYear());
            $('#jenis_pk').val('');
        });

        // =========================================================
        // 6. EDIT PK - LOAD DATA KE MODAL
        // =========================================================
        $(document).on('click', '.btn-edit-pk', function() {
            var id = $(this).data('id');
            $('#modalPKTitle').text('Edit Perjanjian Kinerja');
            $('#pk_id').val(id);

            $.ajax({
                url: BaseURL + "Instansi/GetPKById",
                type: "POST",
                data: {
                    id: id,
                    [CSRF_NAME]: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        var d = res.data;
                        // Set dropdown dan trigger change untuk menampilkan detail
                        $('#id_karyawan').val(d.id_karyawan).trigger('change');
                        $('#id_atasan').val(d.id_atasan).trigger('change');
                        $('#jenis_pk').val(d.jenis_pk || '');
                        $('#sasaran').val(d.sasaran || '');
                        $('#periode_awal').val(d.periode_awal || '');
                        $('#periode_akhir').val(d.periode_akhir || '');
                        $('#anggaran').val(d.anggaran ? parseInt(d.anggaran).toLocaleString('id-ID') : '');
                        $('#tahun').val(d.tahun || new Date().getFullYear());
                        $('#sasaran_program').val(d.sasaran_program || '');
                        $('#pernyataan').val(d.pernyataan || '');

                        if (d.dokumen_definitif) {
                            $('#file_definitif_existing').show();
                            $('#link_definitif').attr('href', BaseURL + d.dokumen_definitif);
                        } else {
                            $('#file_definitif_existing').hide();
                        }

                        if (d.dokumen_lampiran) {
                            $('#file_lampiran_existing').show();
                            $('#link_lampiran').attr('href', BaseURL + d.dokumen_lampiran);
                        } else {
                            $('#file_lampiran_existing').hide();
                        }

                        $('#ModalPK').modal('show');
                    } else {
                        alert(res.message || 'Gagal mengambil data');
                    }
                },
                error: function() {
                    alert('Gagal mengambil data');
                }
            });
        });

        // =========================================================
        // 7. SIMPAN PK
        // =========================================================
        $('#formPK').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            if (!$('#id_karyawan').val()) {
                alert('Pilih pegawai terlebih dahulu!');
                return;
            }
            if (!$('#id_atasan').val()) {
                alert('Pilih atasan langsung!');
                return;
            }
            if (!$('#jenis_pk').val().trim()) {
                alert('Jenis Perjanjian harus diisi!');
                return;
            }
            if (!$('#sasaran').val().trim()) {
                alert('Sasaran harus diisi!');
                return;
            }

            $('#btnSimpanPK').prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: BaseURL + "Instansi/SimpanPK",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        alert(res.message);
                        $('#ModalPK').modal('hide');
                        location.reload();
                    } else {
                        alert(res.message || 'Gagal menyimpan data!');
                        $('#btnSimpanPK').prop('disabled', false).html('<i class="notika-icon bi-save"></i> Simpan');
                    }
                },
                error: function() {
                    alert('Gagal menyimpan data!');
                    $('#btnSimpanPK').prop('disabled', false).html('<i class="notika-icon bi-save"></i> Simpan');
                }
            });
        });

        // =========================================================
        // 8. HAPUS PK
        // =========================================================
        $(document).on('click', '.btn-hapus-pk', function() {
            var id = $(this).data('id');
            if (!confirm('Yakin hapus data ini?')) return;

            $.ajax({
                url: BaseURL + "Instansi/HapusPK",
                type: "POST",
                data: {
                    id: id,
                    [CSRF_NAME]: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message || 'Gagal menghapus data');
                    }
                },
                error: function() {
                    alert('Gagal menghapus data');
                }
            });
        });

        // =========================================================
        // 9. UPDATE STATUS (Level 3)
        // =========================================================
        $(document).on('change', '.status-dropdown', function() {
            var id = $(this).data('id');
            var status = $(this).val();
            var $this = $(this);

            if (!confirm('Ubah status menjadi "' + status + '"?')) {
                $this.val($this.find('option:selected').val());
                return;
            }

            $.ajax({
                url: BaseURL + "Instansi/UpdateStatusPK",
                type: "POST",
                data: {
                    id: id,
                    status: status,
                    [CSRF_NAME]: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message || 'Gagal mengupdate status');
                        $this.val($this.find('option:selected').val());
                    }
                },
                error: function() {
                    alert('Gagal mengupdate status');
                }
            });
        });

        // =========================================================
        // 10. LIHAT DOKUMEN
        // =========================================================
        $(document).on('click', '.btn-lihat-dokumen', function() {
            var id = $(this).data('id');
            $.ajax({
                url: BaseURL + "Instansi/GetDokumenPK",
                type: "POST",
                data: {
                    id: id,
                    [CSRF_NAME]: CSRF_TOKEN
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status === 'success') {
                        var html = '';
                        if (res.data.dokumen_definitif) {
                            html += '<p><strong>Dokumen Definitif (Halaman Utama):</strong><br>';
                            html += '<a href="' + BaseURL + res.data.dokumen_definitif + '" target="_blank" class="btn btn-primary btn-sm">Lihat Dokumen</a></p>';
                        }
                        if (res.data.dokumen_lampiran) {
                            html += '<p><strong>Dokumen Lampiran:</strong><br>';
                            html += '<a href="' + BaseURL + res.data.dokumen_lampiran + '" target="_blank" class="btn btn-info btn-sm">Lihat Lampiran</a></p>';
                        }
                        if (!html) html = '<p>Tidak ada dokumen.</p>';
                        $('#modalDokumenBody').html(html);
                        $('#modalDokumen').modal('show');
                    } else {
                        alert(res.message || 'Gagal mengambil data dokumen');
                    }
                },
                error: function() {
                    alert('Gagal mengambil data dokumen');
                }
            });
        });
    });
</script>

</body>
</html>