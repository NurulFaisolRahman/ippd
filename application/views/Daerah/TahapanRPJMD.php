<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .tahapan-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        padding: 24px;
        margin-bottom: 25px;
        border: 1px solid #e5e7eb;
    }
    
    .tahapan-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 20px;
        border-bottom: 1.5px solid #edf2f7;
    }

    .tahapan-title {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ========================================================
       TABEL TAHAPAN SESUAI GAMBAR (Grid Hitam Rapi 5 Kolom)
       ======================================================== */
    .tahapan-table-wrapper {
        width: 100%;
        overflow-x: auto;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .tahapan-table-grid {
        width: 100%;
        border-collapse: collapse;
        border: 2px solid #000;
        background: #fff;
        min-width: 900px;
    }

    .tahapan-table-grid thead th {
        background-color: #f2f4f8;
        color: #000;
        font-weight: 800;
        font-size: 16px;
        text-align: center;
        vertical-align: middle;
        padding: 14px 10px;
        border: 2px solid #000;
        width: 20%;
        letter-spacing: 0.5px;
    }

    .tahapan-table-grid tbody td {
        background-color: #fff;
        color: #000;
        font-size: 12.5px;
        font-weight: 700;
        text-align: center;
        vertical-align: middle;
        padding: 24px 14px;
        border: 2px solid #000;
        width: 20%;
        line-height: 1.6;
        text-transform: uppercase;
        word-break: break-word;
    }

    .tahapan-table-grid tbody tr:hover td {
        background-color: #fafbfc;
    }

    /* Action Buttons Per Kolom */
    .btn-kolom-action {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 10px;
        font-size: 11.5px;
        font-weight: 700;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        margin: 2px;
        text-decoration: none;
    }

    .btn-kolom-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.18);
    }

    .btn-kolom-edit {
        background: #f59e0b;
        color: #fff !important;
    }
    .btn-kolom-edit:hover {
        background: #d97706;
    }

    .btn-kolom-delete {
        background: #ef4444;
        color: #fff !important;
    }
    .btn-kolom-delete:hover {
        background: #dc2626;
    }

    /* Action Buttons Global */
    .btn-action-group {
        display: inline-flex;
        gap: 8px;
        align-items: center;
    }

    .btn-action-custom {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-action-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }

    .btn-action-add {
        background: #10b981;
        color: #fff;
        padding: 8px 16px;
        font-size: 13px;
    }
    .btn-action-add:hover {
        background: #059669;
        color: #fff;
    }

    /* Modal Form Styles */
    .form-group-custom {
        margin-bottom: 16px;
    }
    .form-group-custom label {
        display: block;
        font-weight: 700;
        font-size: 13px;
        color: #374151;
        margin-bottom: 6px;
    }
    .form-control-custom {
        width: 100%;
        border: 1.5px solid #d1d5db;
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 13px;
        transition: border-color 0.2s ease;
        resize: vertical;
        box-sizing: border-box;
    }
    .form-control-custom:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    .year-grid-inputs {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
        margin-top: 10px;
    }
    @media (min-width: 768px) {
        .year-grid-inputs {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <!-- Filter untuk pengguna yang belum login -->
                    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div class="tahapan-card" style="margin-bottom: 20px;">
                            <div class="row filter-row">
                                <div class="col-lg-4 col-md-5">
                                    <div class="filter-group">
                                        <label for="Provinsi" style="font-weight: 700; margin-bottom: 5px;">Provinsi</label>
                                        <select class="form-control filter-select" id="Provinsi" style="width: 100%;">
                                            <option value="">Pilih Provinsi</option>
                                            <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-5">
                                    <div class="filter-group">
                                        <label for="KabKota" style="font-weight: 700; margin-bottom: 5px;">Kab/Kota</label>
                                        <select class="form-control filter-select" id="KabKota" style="width: 100%;">
                                            <option value="">Pilih Kab/Kota</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2" style="margin-top: 25px;">
                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter" style="font-weight: 700;">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($KodeWilayah)) { ?>
                            <?php 
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                            ?>
                            <div class="alert alert-info" style="margin-bottom: 20px;">
                                <i class="fa fa-map-marker"></i> <strong>Wilayah Terpilih:</strong> <?= $nama_wilayah ?>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <!-- Card Utama: 1 TABEL SAJA DENGAN EDIT & HAPUS DI MASING-MASING KOLOM -->
                    <div class="tahapan-card">
                        <?php 
                            $th1 = 2026;
                            $th2 = 2027;
                            $th3 = 2028;
                            $th4 = 2029;
                            $th5 = 2030;

                            $isi_t1 = !empty($Tahapan['tahun_2026']) ? $Tahapan['tahun_2026'] : '';
                            $isi_t2 = !empty($Tahapan['tahun_2027']) ? $Tahapan['tahun_2027'] : '';
                            $isi_t3 = !empty($Tahapan['tahun_2028']) ? $Tahapan['tahun_2028'] : '';
                            $isi_t4 = !empty($Tahapan['tahun_2029']) ? $Tahapan['tahun_2029'] : '';
                            $isi_t5 = !empty($Tahapan['tahun_2030']) ? $Tahapan['tahun_2030'] : '';
                        ?>

                        <div class="tahapan-card-header">
                            <div>
                                <h3 class="tahapan-title">
                                    <i class="fa fa-line-chart" style="color: #20c997;"></i> 
                                    Tahapan RPJMD
                                </h3>
                                <p style="margin: 4px 0 0 0; color: #6b7280; font-size: 13px;">
                                    Tema dan Arah Kebijakan Pembangunan Tahunan (2026 - 2030)
                                </p>
                            </div>

                            <!-- Tombol Tambah Sekaligus di Header Card -->
                            <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 3])) { ?>
                                <div>
                                    <button type="button" class="btn-action-custom btn-action-add" id="btnBukaModalTambah">
                                        <i class="fa fa-pencil-square-o"></i> <b>Isi Sekaligus (5 Tahun)</b>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- TABEL 1 SAJA DENGAN TOMBOL EDIT & HAPUS DI MASING-MASING KOLOM -->
                        <div class="tahapan-table-wrapper">
                            <table class="tahapan-table-grid">
                                <thead>
                                    <tr>
                                        <th><?= $th1 ?></th>
                                        <th><?= $th2 ?></th>
                                        <th><?= $th3 ?></th>
                                        <th><?= $th4 ?></th>
                                        <th><?= $th5 ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Baris 1: Konten Teks Tiap Tahun -->
                                    <tr>
                                        <td>
                                            <?= !empty($isi_t1) ? nl2br(html_escape($isi_t1)) : '<span style="color: #9ca3af; font-weight: normal;">-</span>' ?>
                                        </td>
                                        <td>
                                            <?= !empty($isi_t2) ? nl2br(html_escape($isi_t2)) : '<span style="color: #9ca3af; font-weight: normal;">-</span>' ?>
                                        </td>
                                        <td>
                                            <?= !empty($isi_t3) ? nl2br(html_escape($isi_t3)) : '<span style="color: #9ca3af; font-weight: normal;">-</span>' ?>
                                        </td>
                                        <td>
                                            <?= !empty($isi_t4) ? nl2br(html_escape($isi_t4)) : '<span style="color: #9ca3af; font-weight: normal;">-</span>' ?>
                                        </td>
                                        <td>
                                            <?= !empty($isi_t5) ? nl2br(html_escape($isi_t5)) : '<span style="color: #9ca3af; font-weight: normal;">-</span>' ?>
                                        </td>
                                    </tr>

                                    <!-- Baris 2: Tombol Edit & Hapus di Kolom Masing-Masing -->
                                    <?php if (isset($_SESSION['Level']) && in_array((int)$_SESSION['Level'], [0, 3])) { ?>
                                        <tr>
                                            <!-- Kolom Tahun 2026 -->
                                            <td style="padding: 10px 6px; background-color: #fafbfc; border: 2px solid #000; text-align: center;">
                                                <button type="button" class="btn-kolom-action btn-kolom-edit" 
                                                        data-tahun="2026" 
                                                        data-label="2026" 
                                                        data-isi="<?= html_escape($isi_t1) ?>"
                                                        title="Edit Tahun 2026">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <?php if (!empty($isi_t1)) { ?>
                                                    <button type="button" class="btn-kolom-action btn-kolom-delete" 
                                                            data-tahun="2026" 
                                                            data-label="2026"
                                                            title="Hapus Tahun 2026">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                <?php } ?>
                                            </td>

                                            <!-- Kolom Tahun 2027 -->
                                            <td style="padding: 10px 6px; background-color: #fafbfc; border: 2px solid #000; text-align: center;">
                                                <button type="button" class="btn-kolom-action btn-kolom-edit" 
                                                        data-tahun="2027" 
                                                        data-label="2027" 
                                                        data-isi="<?= html_escape($isi_t2) ?>"
                                                        title="Edit Tahun 2027">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <?php if (!empty($isi_t2)) { ?>
                                                    <button type="button" class="btn-kolom-action btn-kolom-delete" 
                                                            data-tahun="2027" 
                                                            data-label="2027"
                                                            title="Hapus Tahun 2027">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                <?php } ?>
                                            </td>

                                            <!-- Kolom Tahun 2028 -->
                                            <td style="padding: 10px 6px; background-color: #fafbfc; border: 2px solid #000; text-align: center;">
                                                <button type="button" class="btn-kolom-action btn-kolom-edit" 
                                                        data-tahun="2028" 
                                                        data-label="2028" 
                                                        data-isi="<?= html_escape($isi_t3) ?>"
                                                        title="Edit Tahun 2028">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <?php if (!empty($isi_t3)) { ?>
                                                    <button type="button" class="btn-kolom-action btn-kolom-delete" 
                                                            data-tahun="2028" 
                                                            data-label="2028"
                                                            title="Hapus Tahun 2028">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                <?php } ?>
                                            </td>

                                            <!-- Kolom Tahun 2029 -->
                                            <td style="padding: 10px 6px; background-color: #fafbfc; border: 2px solid #000; text-align: center;">
                                                <button type="button" class="btn-kolom-action btn-kolom-edit" 
                                                        data-tahun="2029" 
                                                        data-label="2029" 
                                                        data-isi="<?= html_escape($isi_t4) ?>"
                                                        title="Edit Tahun 2029">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <?php if (!empty($isi_t4)) { ?>
                                                    <button type="button" class="btn-kolom-action btn-kolom-delete" 
                                                            data-tahun="2029" 
                                                            data-label="2029"
                                                            title="Hapus Tahun 2029">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                <?php } ?>
                                            </td>

                                            <!-- Kolom Tahun 2030 -->
                                            <td style="padding: 10px 6px; background-color: #fafbfc; border: 2px solid #000; text-align: center;">
                                                <button type="button" class="btn-kolom-action btn-kolom-edit" 
                                                        data-tahun="2030" 
                                                        data-label="2030" 
                                                        data-isi="<?= html_escape($isi_t5) ?>"
                                                        title="Edit Tahun 2030">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <?php if (!empty($isi_t5)) { ?>
                                                    <button type="button" class="btn-kolom-action btn-kolom-delete" 
                                                            data-tahun="2030" 
                                                            data-label="2030"
                                                            title="Hapus Tahun 2030">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                <?php } ?>
                                            </td>
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
</div>

<!-- ============================================================
     MODAL EDIT KHUSUS PER KOLOM TAHUN
     ============================================================ -->
<div class="modal fade" id="ModalEditKolom" role="dialog">
    <div class="modal-dialog modal-md" style="margin-top: 70px;">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header" style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0; border-radius: 8px 8px 0 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight: 700; color: #1e293b;">
                    <i class="fa fa-pencil" style="color: #f59e0b;"></i> Edit Tahapan Tahun <span id="labelTahunKolom">2026</span>
                </h4>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <input type="hidden" id="edit_tahun_ke" value="2026">
                <div class="form-group-custom">
                    <label for="input_isi_kolom" id="labelInputKolom">Uraian Tahapan Pembangunan:</label>
                    <textarea class="form-control-custom" id="input_isi_kolom" rows="5" placeholder="Masukkan uraian tahapan pembangunan..."></textarea>
                </div>
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-top: 1.5px solid #e2e8f0; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success notika-btn-success" id="btnSimpanEditKolom" style="font-weight: 700; padding: 7px 22px;">
                    <i class="fa fa-save"></i> SIMPAN
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     MODAL FORM KELOLA SEMUA TAHUN (ISI SEKALIGUS)
     ============================================================ -->
<div class="modal fade" id="ModalTahapanRPJMD" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header" style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0; border-radius: 8px 8px 0 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight: 700; color: #1e293b;">
                    <i class="fa fa-pencil-square-o" style="color: #20c997;"></i> Kelola Tahapan RPJMD (2026 - 2030)
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <form id="formTahapanRPJMD" onsubmit="return false;">
                    <input type="hidden" id="tahapan_Id" value="<?= !empty($Tahapan['Id']) ? $Tahapan['Id'] : '' ?>">

                    <p style="margin: 0 0 16px 0; color: #4b5563; font-size: 13.5px;">
                        Masukkan uraian tema dan arah kebijakan tahapan pembangunan daerah untuk masing-masing tahun (2026 s/d 2030):
                    </p>

                    <div class="year-grid-inputs">
                        <div class="form-group-custom">
                            <label for="input_Tahun1">Tahun 2026</label>
                            <textarea class="form-control-custom" id="input_Tahun1" rows="4" placeholder="Masukkan uraian tahapan pembangunan tahun 2026..."></textarea>
                        </div>
                        <div class="form-group-custom">
                            <label for="input_Tahun2">Tahun 2027</label>
                            <textarea class="form-control-custom" id="input_Tahun2" rows="4" placeholder="Masukkan uraian tahapan pembangunan tahun 2027..."></textarea>
                        </div>
                        <div class="form-group-custom">
                            <label for="input_Tahun3">Tahun 2028</label>
                            <textarea class="form-control-custom" id="input_Tahun3" rows="4" placeholder="Masukkan uraian tahapan pembangunan tahun 2028..."></textarea>
                        </div>
                        <div class="form-group-custom">
                            <label for="input_Tahun4">Tahun 2029</label>
                            <textarea class="form-control-custom" id="input_Tahun4" rows="4" placeholder="Masukkan uraian tahapan pembangunan tahun 2029..."></textarea>
                        </div>
                    </div>
                    <div class="form-group-custom" style="margin-top: 14px;">
                        <label for="input_Tahun5">Tahun 2030</label>
                        <textarea class="form-control-custom" id="input_Tahun5" rows="4" placeholder="Masukkan uraian tahapan pembangunan tahun 2030..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-top: 1.5px solid #e2e8f0; border-radius: 0 0 8px 8px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success notika-btn-success" id="btnSimpanTahapan" style="font-weight: 700; padding: 8px 24px;">
                    <i class="fa fa-save"></i> SIMPAN SEMUA
                </button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var CSRF_TOKEN_VALUE = '<?= $this->security->get_csrf_hash() ?>';

    // Data saat ini dari server
    var currentTahapan = {
        Id: '<?= !empty($Tahapan['Id']) ? $Tahapan['Id'] : '' ?>',
        tahun_2026: <?= json_encode($isi_t1) ?>,
        tahun_2027: <?= json_encode($isi_t2) ?>,
        tahun_2028: <?= json_encode($isi_t3) ?>,
        tahun_2029: <?= json_encode($isi_t4) ?>,
        tahun_2030: <?= json_encode($isi_t5) ?>
    };

    $(document).ready(function() {

        // ============================================================
        // FILTER WILAYAH (Jika belum login)
        // ============================================================
        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
            $("#Provinsi").change(function() {
                var kodeProv = $(this).val();
                if (!kodeProv) {
                    $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                    return;
                }
                $.ajax({
                    url: BaseURL + "Daerah/GetListKabKota",
                    type: "POST",
                    data: { Kode: kodeProv, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                    success: function(res) {
                        try {
                            var data = JSON.parse(res);
                            var html = '<option value="">Pilih Kab/Kota</option>';
                            data.forEach(function(item) {
                                html += '<option value="' + item.Kode + '">' + item.Nama + '</option>';
                            });
                            $("#KabKota").html(html);
                        } catch(e) {}
                    }
                });
            });

            $("#Filter").click(function() {
                var kodeWilayah = $("#KabKota").val();
                if (!kodeWilayah) {
                    Swal.fire('Perhatian', 'Mohon pilih Kabupaten / Kota terlebih dahulu!', 'warning');
                    return;
                }
                $.ajax({
                    url: BaseURL + "Daerah/SetTempKodeWilayah",
                    type: "POST",
                    data: { KodeWilayah: kodeWilayah, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                    beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                    success: function(res) {
                        if (res === '1' || res === 'success') {
                            window.location.reload();
                        } else {
                            Swal.fire('Gagal', res || 'Gagal menyimpan filter wilayah!', 'error');
                            $("#Filter").prop('disabled', false).text('Filter');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal menghubungi server!', 'error');
                        $("#Filter").prop('disabled', false).text('Filter');
                    }
                });
            });

            <?php if (!empty($KodeWilayah)) { ?>
                var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
                var kodeKab = "<?= $KodeWilayah ?>";
                $("#Provinsi").val(kodeProv);
                $.ajax({
                    url: BaseURL + "Daerah/GetListKabKota",
                    type: "POST",
                    data: { Kode: kodeProv, [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE },
                    success: function(res) {
                        try {
                            var data = JSON.parse(res);
                            var html = '<option value="">Pilih Kab/Kota</option>';
                            data.forEach(function(item) {
                                var sel = (item.Kode === kodeKab) ? 'selected' : '';
                                html += '<option value="' + item.Kode + '" ' + sel + '>' + item.Nama + '</option>';
                            });
                            $("#KabKota").html(html);
                        } catch(e) {}
                    }
                });
            <?php } ?>
        <?php } ?>

        // ============================================================
        // MODAL BUKA: ISI SEKALIGUS (5 TAHUN)
        // ============================================================
        $("#btnBukaModalTambah").click(function() {
            $("#tahapan_Id").val(currentTahapan.Id);
            $("#input_Tahun1").val(currentTahapan.tahun_2026);
            $("#input_Tahun2").val(currentTahapan.tahun_2027);
            $("#input_Tahun3").val(currentTahapan.tahun_2028);
            $("#input_Tahun4").val(currentTahapan.tahun_2029);
            $("#input_Tahun5").val(currentTahapan.tahun_2030);
            $("#ModalTahapanRPJMD").modal("show");
        });

        // ============================================================
        // AKSI EDIT DI MASING-MASING KOLOM TAHUN
        // ============================================================
        $(document).on("click", ".btn-kolom-edit", function() {
            var tahunKe = $(this).data("tahun");
            var label = $(this).data("label");
            var isi = $(this).attr("data-isi") || "";

            $("#edit_tahun_ke").val(tahunKe);
            $("#labelTahunKolom").text(label);
            $("#labelInputKolom").text("Uraian Tahapan Pembangunan Tahun " + label + ":");
            $("#input_isi_kolom").val(isi);
            $("#ModalEditKolom").modal("show");
        });

        // Simpan Edit per Kolom
        $("#btnSimpanEditKolom").click(function() {
            var tahunKe = $("#edit_tahun_ke").val();
            var isi = $.trim($("#input_isi_kolom").val());
            var btn = $(this);

            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + "Daerah/EditTahapanRPJMDPerTahun",
                type: "POST",
                data: {
                    tahun_ke: tahunKe,
                    isi: isi,
                    [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                },
                success: function(res) {
                    if (res === '1') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Tahapan tahun tersebut berhasil diperbarui.',
                            icon: 'success',
                            timer: 1200,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res || 'Gagal memperbarui data!', 'error');
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan sistem atau koneksi.', 'error');
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN');
                }
            });
        });

        // ============================================================
        // AKSI HAPUS DI MASING-MASING KOLOM TAHUN
        // ============================================================
        $(document).on("click", ".btn-kolom-delete", function() {
            var tahunKe = $(this).data("tahun");
            var label = $(this).data("label");

            Swal.fire({
                title: 'Hapus Tahapan Tahun ' + label + '?',
                text: "Uraian tahapan untuk tahun " + label + " akan dikosongkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: BaseURL + "Daerah/HapusTahapanRPJMDPerTahun",
                        type: "POST",
                        data: {
                            tahun_ke: tahunKe,
                            [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
                        },
                        success: function(res) {
                            if (res === '1') {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Tahapan tahun ' + label + ' berhasil dihapus.',
                                    icon: 'success',
                                    timer: 1200,
                                    showConfirmButton: false
                                }).then(function() {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Gagal', res || 'Gagal menghapus tahapan tahun ini!', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Terjadi kesalahan koneksi.', 'error');
                        }
                    });
                }
            });
        });

        // ============================================================
        // SIMPAN / UPDATE SEMUA TAHUN SEKALIGUS
        // ============================================================
        $("#btnSimpanTahapan").click(function() {
            var t1 = $.trim($("#input_Tahun1").val());
            var t2 = $.trim($("#input_Tahun2").val());
            var t3 = $.trim($("#input_Tahun3").val());
            var t4 = $.trim($("#input_Tahun4").val());
            var t5 = $.trim($("#input_Tahun5").val());

            if (!t1 && !t2 && !t3 && !t4 && !t5) {
                Swal.fire('Peringatan', 'Minimal isi salah satu uraian tahapan pembangunan tahunan!', 'warning');
                return;
            }

            var postData = {
                Id: $("#tahapan_Id").val(),
                tahun_2026: t1,
                tahun_2027: t2,
                tahun_2028: t3,
                tahun_2029: t4,
                tahun_2030: t5,
                [CSRF_TOKEN_NAME]: CSRF_TOKEN_VALUE
            };

            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + "Daerah/InputTahapanRPJMD",
                type: "POST",
                data: postData,
                success: function(res) {
                    if (res === '1') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Tahapan RPJMD berhasil disimpan.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res || 'Gagal menyimpan data!', 'error');
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN SEMUA');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan sistem atau koneksi.', 'error');
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN SEMUA');
                }
            });
        });

    });
</script>
</body>
</html>