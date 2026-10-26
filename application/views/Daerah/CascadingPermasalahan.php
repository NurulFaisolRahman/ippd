<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>
<?php 
// Pengguna yang login (Daerah atau Admin) dapat melakukan aksi CRUD
$isDaerah = isset($IsDaerah) ? $IsDaerah : (isset($_SESSION['Username']) || isset($_SESSION['Level'])); 
?>

<!-- Dependencies: Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
    .cascading-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .cascading-card-header {
        background: #ffffff;
        padding: 20px 24px;
        border-bottom: 1.5px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }
    .cascading-title h3 {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
        letter-spacing: -0.3px;
    }
    .cascading-title p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Tabel Cascading Permasalahan - Serasi dengan ProgramKegiatanPrioritas */
    .table-cascading {
        width: 100%;
        border-collapse: separate !important;
        border-spacing: 0;
        font-size: 13px;
        margin-bottom: 0;
        border: 1px solid #b7d7b0 !important;
    }
    .table-cascading thead th {
        background: #d9ead3 !important;
        color: #1b4d21 !important;
        text-align: center;
        vertical-align: middle !important;
        font-weight: 700;
        font-size: 12.5px;
        padding: 13px 10px !important;
        border: 1px solid #b7d7b0 !important;
        line-height: 1.4;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    .table-cascading tbody td {
        vertical-align: top !important;
        padding: 12px 14px !important;
        border: 1px solid #e2e8f0 !important;
        line-height: 1.55;
        color: #1e293b;
        background-color: #ffffff;
    }
    .table-cascading tbody tr {
        height: 48px;
    }
    .table-cascading tbody tr:hover td {
        background-color: #fbfdfb;
    }
    td.mid,
    .table-cascading tbody td.mid {
        vertical-align: top !important;
    }
    .table-cascading tbody td.mid .item {
        align-items: flex-start;
    }

    /* Item & Action Buttons serasi dengan ProgramKegiatanPrioritas */
    .item {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: space-between;
        gap: 8px;
        position: relative;
        width: 100%;
    }
    .item .t {
        flex: 1;
        min-width: 0;
        border-radius: 4px;
        padding: 3px 6px;
        font-size: 13px;
        color: #1e293b;
        line-height: 1.5;
        transition: background 0.15s, box-shadow 0.15s;
        word-break: break-word;
    }
    .item .t[contenteditable="true"] {
        cursor: text;
    }
    .item .t[contenteditable="true"]:hover {
        background: #f0fdf4;
        box-shadow: inset 0 0 0 1px #a7f3d0;
    }
    .item .t[contenteditable="true"]:focus {
        background: #ffffff;
        outline: 2px solid #15803d;
        outline-offset: 1px;
        box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.18);
    }
    .item-actions {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .btn-xs-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        padding: 0;
        font-size: 11.5px;
        border-radius: 5px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        text-decoration: none !important;
        line-height: 1;
    }
    .btn-edit-level {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .btn-edit-level:hover {
        background: #f59e0b;
        color: #ffffff;
        border-color: #f59e0b;
    }
    .btn-del-level {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .btn-del-level:hover {
        background: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
    }
    @keyframes pulseHighlight {
        0% {
            background-color: rgba(21, 128, 61, 0.25);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.35);
            border-radius: 4px;
        }
        50% {
            background-color: rgba(21, 128, 61, 0.12);
            box-shadow: 0 0 0 2px rgba(21, 128, 61, 0.2);
            border-radius: 4px;
        }
        100% {
            background-color: transparent;
            box-shadow: none;
        }
    }
    .highlight-edited {
        animation: pulseHighlight 2.2s ease-out;
    }
    .na {
        color: #94a3b8;
        font-style: italic;
    }

    /* Tools & Modals */
    .tools {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .chk {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 9px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        margin: 0 0 8px;
        font-weight: 400;
        background: #fff;
        cursor: pointer;
        transition: background 0.15s, border-color 0.15s;
    }
    .chk:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .chk input[type="checkbox"],
    .chk input[type="radio"] {
        margin-top: 3px;
        cursor: pointer;
    }
    .hint {
        color: #64748b;
        font-size: 12.5px;
    }
    .err-msg {
        color: #ef4444;
        font-size: 12px;
        font-weight: 600;
        min-height: 1.2em;
        margin: 6px 0 0;
    }
    .empty-msg {
        color: #64748b;
        padding: 16px;
        text-align: center;
        font-style: italic;
        background: #f8fafc;
        border-radius: 6px;
        border: 1px dashed #cbd5e1;
    }

    /* Filter Bar */
    .filter-wrapper {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 20px;
    }
</style>

<div class="main-content" style="padding: 20px 24px; min-height: 100vh; background: #f8fafc;">
    <div class="container-fluid" style="padding: 0;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- Filter Bar: Wilayah & Tahun RKPD -->
                <div class="filter-wrapper">
                    <form method="GET" action="<?= base_url('Daerah/CascadingPermasalahan') ?>" id="FormFilterCascading">
                        <div class="row" style="display: flex; align-items: flex-end; flex-wrap: wrap;">
                            
                            <?php if (empty($_SESSION['KodeWilayah'])) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155;">Pilih Provinsi</label>
                                    <select class="form-control" id="FilterProvinsi" style="height: 40px; border-radius: 6px;">
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                <?= html_escape($prov['Nama']) ?>
                                            </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155;">Pilih Kabupaten / Kota</label>
                                    <select class="form-control" name="KodeWilayah" id="FilterKabKota" style="height: 40px; border-radius: 6px;">
                                        <option value="">-- Pilih Kabupaten / Kota --</option>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="KodeWilayah" id="FilterKabKota" value="<?= html_escape($KodeWilayah) ?>">
                            <?php } ?>

                            <!-- Filter Tahun Perencanaan RKPD -->
                            <div class="col-lg-3 col-md-3 col-sm-6" style="margin-bottom: 10px;">
                                <label style="font-weight: 700; font-size: 13px; color: #334155;">
                                    <i class="fa fa-calendar" style="color: #15803d;"></i> Tahun Perencanaan RKPD
                                </label>
                                <select class="form-control" name="tahun" id="FilterTahun" style="height: 40px; border-radius: 6px; font-weight: 600;">
                                    <?php foreach ($ListTahun as $th) { ?>
                                        <option value="<?= html_escape($th) ?>" <?= ($SelectedTahun == $th) ? 'selected' : '' ?>>
                                            Tahun <?= html_escape($th) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6" style="margin-bottom: 10px;">
                                <button type="submit" class="btn btn-primary notika-btn-primary btn-block" style="height: 40px; font-weight: 700; border-radius: 6px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-filter"></i> Tampilkan
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

                <?php if (empty($KodeWilayah)) { ?>
                    <div class="alert alert-warning" style="border-radius: 8px; font-size: 13px; margin-bottom: 20px;">
                        <i class="fa fa-exclamation-triangle"></i> <strong>Perhatian:</strong> Silakan pilih Provinsi dan Kabupaten / Kota terlebih dahulu pada form filter di atas untuk mengelola data Cascading Permasalahan.
                    </div>
                <?php } ?>

                <!-- Card Utama: Tabel Cascading Permasalahan -->
                <div class="cascading-card">
                    <div class="cascading-card-header">
                        <div class="cascading-title">
                            <h3>
                                <i class="fa fa-sitemap" style="color: #15803d; margin-right: 8px;"></i> CASCADING PERMASALAHAN RKPD
                            </h3>
                            <p>Penyelarasan Permasalahan &rarr; Isu Strategis &rarr; Prioritas Pembangunan Daerah (Rancangan Awal RKPD Tahun <?= html_escape($SelectedTahun) ?>)</p>
                        </div>
                        <?php if ($isDaerah && !empty($KodeWilayah)) { ?>
                            <div class="tools">
                                <button type="button" class="btn btn-success" id="bP" style="border-radius: 6px; font-weight: 700; padding: 9px 16px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Tambah permasalahan
                                </button>
                                <button type="button" class="btn btn-success" id="bI" style="border-radius: 6px; font-weight: 700; padding: 9px 16px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Tambah isu strategis
                                </button>
                                <button type="button" class="btn btn-success" id="bR" style="border-radius: 6px; font-weight: 700; padding: 9px 16px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Tambah prioritas pembangunan daerah
                                </button>
                            </div>
                        <?php } ?>
                    </div>

                    <div style="padding: 14px 24px 6px;">
                        <p class="hint" style="margin: 0; font-size: 13px; color: #166534; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 10px 14px; border-radius: 6px;">
                            <i class="fa fa-info-circle" style="color: #15803d; margin-right: 4px;"></i>
                            Tambahkan berurutan: <strong>permasalahan</strong>, <strong>isu strategis</strong>, lalu <strong>prioritas pembangunan daerah</strong>. Satu prioritas pembangunan daerah dapat mengampu 1 hingga 2 isu strategis. Klik tombol <span class="btn-xs-custom btn-edit-level" style="width:20px; height:20px; font-size:10px;"><i class="fa fa-pencil"></i></span> di sebelah kanan untuk mengubah uraian &amp; keterkaitannya, serta tombol <span class="btn-xs-custom btn-del-level" style="width:20px; height:20px; font-size:10px;"><i class="fa fa-trash"></i></span> untuk menghapus butir.
                        </p>
                    </div>

                    <div class="table-responsive" style="padding: 14px 24px 24px;">
                        <table class="table table-bordered table-cascading" id="tbl"></table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?php if ($isDaerah) { ?>
<!-- ============================================================ -->
<!-- 1. MODAL TAMBAH PERMASALAHAN -->
<!-- ============================================================ -->
<div class="modal fade" id="dP" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 560px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Permasalahan
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <label for="inP" style="font-weight: 700; font-size: 13px; color: #1e293b; margin: 0 0 6px; display: block;">Permasalahan <span class="text-danger">*</span></label>
                <textarea id="inP" class="form-control" rows="4" placeholder="Contoh: Rendahnya produktivitas dan nilai tambah sumber daya lokal" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                <p class="hint" style="margin: 6px 0 0; font-size: 12px; color: #64748b;">
                    <i class="fa fa-lightbulb-o" style="color: #f59e0b;"></i> Untuk menambah banyak sekaligus, tulis satu permasalahan per baris.
                </p>
                <p class="err-msg" id="eP"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="sP" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 2. MODAL TAMBAH ISU STRATEGIS -->
<!-- ============================================================ -->
<div class="modal fade" id="dI" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Isu Strategis
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Permasalahan yang tercakup dalam isu ini</label>
                <div style="position: relative; margin-bottom: 8px;">
                    <i class="fa fa-search" style="position: absolute; left: 10px; top: 9px; color: #94a3b8; font-size: 12px;"></i>
                    <input type="text" id="searchPickP" class="form-control input-sm" placeholder="Cari permasalahan..." autocomplete="off" style="padding-left: 28px; border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
                </div>
                <div id="pickP" style="max-height: 220px; overflow-y: auto; padding: 2px;"></div>

                <label for="inI" style="font-weight: 700; font-size: 13px; color: #1e293b; margin: 16px 0 6px; display: block;">Isu strategis <span class="text-danger">*</span></label>
                <textarea id="inI" class="form-control" rows="3" placeholder="Contoh: Pemantapan pertumbuhan dan pemerataan ekonomi daerah" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                <p class="err-msg" id="eI"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="sI" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 3. MODAL TAMBAH PRIORITAS PEMBANGUNAN DAERAH -->
<!-- ============================================================ -->
<div class="modal fade" id="dR" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Prioritas Pembangunan Daerah
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">
                    Isu strategis <span class="text-danger">*</span>
                    <span class="text-muted" style="font-size: 11.5px; font-weight: normal; margin-left: 4px;">(Dapat memilih 1 atau 2 isu strategis)</span>
                </label>
                <div style="position: relative; margin-bottom: 8px;">
                    <i class="fa fa-search" style="position: absolute; left: 10px; top: 9px; color: #94a3b8; font-size: 12px;"></i>
                    <input type="text" id="searchPickI" class="form-control input-sm" placeholder="Cari isu strategis..." autocomplete="off" style="padding-left: 28px; border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
                </div>
                <div id="pickI" style="max-height: 200px; overflow-y: auto; padding: 2px;"></div>

                <label for="inR" style="font-weight: 700; font-size: 13px; color: #1e293b; margin: 16px 0 6px; display: block;">Prioritas pembangunan daerah</label>
                <textarea id="inR" class="form-control" rows="3" placeholder="Contoh: Jatim Kerja, memperluas lapangan kerja yang berkualitas" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                <p class="err-msg" id="eR"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="sR" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 4. MODAL EDIT PERMASALAHAN & KETERKAITAN ISU -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditPermasalahan" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Permasalahan & Keterkaitan Isu
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <input type="hidden" id="editPermId">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">
                        Isu Strategis yang Mengampu Permasalahan Ini
                        <span class="text-muted" style="font-size: 11.5px; font-weight: normal; margin-left: 4px;">(Dapat memilih 1 atau 2 isu strategis)</span>
                    </label>
                    <div style="position: relative; margin-bottom: 8px;">
                        <i class="fa fa-search" style="position: absolute; left: 10px; top: 9px; color: #94a3b8; font-size: 12px;"></i>
                        <input type="text" id="searchEditPermIsu" class="form-control input-sm" placeholder="Cari isu strategis..." autocomplete="off" style="padding-left: 28px; border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
                    </div>
                    <div id="editPermIsuContainer" style="max-height: 200px; overflow-y: auto; padding: 2px;"></div>
                </div>
                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="editPermText" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Uraian Permasalahan <span class="text-danger">*</span></label>
                    <textarea id="editPermText" class="form-control" rows="4" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                </div>
                <p class="err-msg" id="editPermErr"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="btnSaveEditPerm" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 5. MODAL EDIT ISU STRATEGIS & KETERKAITAN PERMASALAHAN -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditIsu" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Isu Strategis & Pemetaan Permasalahan
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <input type="hidden" id="editIsuId">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Permasalahan yang Tercakup dalam Isu Ini</label>
                    <p class="hint" style="margin: 0 0 8px; font-size: 12px; color: #64748b;">
                        Centang permasalahan untuk memetakannya ke isu ini, atau hilangkan centang untuk melepasnya.
                    </p>
                    <div style="position: relative; margin-bottom: 8px;">
                        <i class="fa fa-search" style="position: absolute; left: 10px; top: 9px; color: #94a3b8; font-size: 12px;"></i>
                        <input type="text" id="searchEditIsuPerm" class="form-control input-sm" placeholder="Cari permasalahan..." autocomplete="off" style="padding-left: 28px; border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
                    </div>
                    <div id="editIsuPermContainer" style="max-height: 220px; overflow-y: auto; padding: 2px;"></div>
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="editIsuText" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Uraian Isu Strategis <span class="text-danger">*</span></label>
                    <textarea id="editIsuText" class="form-control" rows="3" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                </div>
                <p class="err-msg" id="editIsuErr"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="btnSaveEditIsu" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 6. MODAL EDIT PRIORITAS DAERAH & KETERKAITAN ISU -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditPrioritas" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Prioritas Daerah & Keterkaitan Isu
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <input type="hidden" id="editProgId">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">
                        Isu Strategis yang Terkait <span class="text-danger">*</span>
                        <span class="text-muted" style="font-size: 11.5px; font-weight: normal; margin-left: 4px;">(Dapat memilih 1 atau 2 isu strategis)</span>
                    </label>
                    <div style="position: relative; margin-bottom: 8px;">
                        <i class="fa fa-search" style="position: absolute; left: 10px; top: 9px; color: #94a3b8; font-size: 12px;"></i>
                        <input type="text" id="searchEditProgIsu" class="form-control input-sm" placeholder="Cari isu strategis..." autocomplete="off" style="padding-left: 28px; border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
                    </div>
                    <div id="editProgIsuContainer" style="max-height: 200px; overflow-y: auto; padding: 2px;"></div>
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="editProgText" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Uraian Prioritas Pembangunan Daerah <span class="text-danger">*</span></label>
                    <textarea id="editProgText" class="form-control" rows="3" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                </div>
                <p class="err-msg" id="editProgErr"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="btnSaveEditProg" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Scripts -->
<script>
$(document).ready(function() {
    var S = <?= json_encode(!empty($CascadingState) ? $CascadingState : ['perm'=>[], 'isu'=>[], 'prog'=>[]]) ?>;
    var isDaerah = <?= $isDaerah ? 'true' : 'false' ?>;
    var kodeWilayah = '<?= html_escape($KodeWilayah) ?>';
    var tahun = '<?= html_escape($SelectedTahun) ?>';
    var BaseURL = '<?= base_url() ?>';

    // State untuk menjaga posisi scroll dan kestabilan tampilan saat edit
    var savedScrollY = null;
    var savedScrollX = null;
    var savedWrapScrollLeft = 0;

    function captureScroll() {
        savedScrollY = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        savedScrollX = window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0;
        var wr = $('.table-responsive');
        savedWrapScrollLeft = wr.length ? wr.scrollLeft() : 0;
    }

    function restoreScroll() {
        if (savedScrollY !== null && savedScrollY !== undefined) {
            window.scrollTo(savedScrollX || 0, savedScrollY);
            var wr = $('.table-responsive');
            if (wr.length && savedWrapScrollLeft != null) {
                wr.scrollLeft(savedWrapScrollLeft);
            }
        }
    }

    // Pastikan saat modal ditutup, posisi scroll tidak pernah melompat
    $('.modal').on('hidden.bs.modal', function() {
        restoreScroll();
        setTimeout(restoreScroll, 50);
        setTimeout(restoreScroll, 150);
    });

    function byId(id) {
        return document.getElementById(id);
    }

    function el(t, c, txt) {
        var e = document.createElement(t);
        if (c) e.className = c;
        if (txt != null) e.textContent = txt;
        return e;
    }

    function clusters() {
        var isuMap = {};
        (S.isu || []).forEach(function(i) {
            isuMap[String(i.id)] = i;
        });

        // 1. Temukan isu yang berbagi prioritas ATAU berbagi permasalahan
        var parent = {};
        function find(x) {
            if (!parent[x]) parent[x] = x;
            if (parent[x] === x) return x;
            parent[x] = find(parent[x]);
            return parent[x];
        }
        function union(a, b) {
            var rootA = find(a);
            var rootB = find(b);
            if (rootA !== rootB) {
                parent[rootB] = rootA;
            }
        }

        (S.isu || []).forEach(function(i) {
            find(String(i.id));
        });

        // Hubungkan isu jika ada Prioritas yang memilih > 1 isu
        (S.prog || []).forEach(function(r) {
            var validIsuIds = (r.isuIds || []).map(String).filter(function(id) {
                return !!isuMap[id];
            });
            if (validIsuIds.length > 1) {
                for (var idx = 1; idx < validIsuIds.length; idx++) {
                    union(validIsuIds[0], validIsuIds[idx]);
                }
            }
        });

        // Hubungkan isu jika ada Permasalahan yang diampu oleh > 1 isu
        (S.perm || []).forEach(function(p) {
            var validIsuIds = (p.isuIds || (p.isuId ? [p.isuId] : [])).map(String).filter(function(id) {
                return !!isuMap[id];
            });
            if (validIsuIds.length > 1) {
                for (var idx = 1; idx < validIsuIds.length; idx++) {
                    union(validIsuIds[0], validIsuIds[idx]);
                }
            }
        });

        // Urutkan isu berdasarkan urutan input aslinya (S.isu) agar urutan baris tidak pernah teracak/berubah
        var isuGroupsByRoot = {};
        var isuOrder = [];
        (S.isu || []).forEach(function(i) {
            isuOrder.push(String(i.id));
        });

        isuOrder.forEach(function(isuId) {
            var root = find(isuId);
            if (!isuGroupsByRoot[root]) isuGroupsByRoot[root] = [];
            isuGroupsByRoot[root].push(isuMap[isuId]);
        });

        var clusterList = [];
        var seenRoots = {};
        var allMappedProgIds = {};
        var allMappedPermIds = {};

        isuOrder.forEach(function(isuId) {
            var root = find(isuId);
            if (!seenRoots[root]) {
                seenRoots[root] = true;
                var isus = isuGroupsByRoot[root] || [];
                var clusterIsuIdSet = {};
                isus.forEach(function(isu) {
                    clusterIsuIdSet[String(isu.id)] = true;
                });

                var progs = (S.prog || []).filter(function(r) {
                    var ids = (r.isuIds || []).map(String);
                    for (var m = 0; m < ids.length; m++) {
                        if (clusterIsuIdSet[ids[m]]) return true;
                    }
                    return false;
                });
                progs.forEach(function(r) {
                    allMappedProgIds[String(r.id)] = true;
                });

                var perms = (S.perm || []).filter(function(p) {
                    var ids = (p.isuIds || (p.isuId ? [p.isuId] : [])).map(String);
                    for (var m = 0; m < ids.length; m++) {
                        if (clusterIsuIdSet[ids[m]]) return true;
                    }
                    return false;
                });
                perms.forEach(function(p) {
                    allMappedPermIds[String(p.id)] = true;
                });

                // Bangun graf rantai linier antar-isu yang saling terhubung agar semua pasangan isu multi-isu selalu bersebelahan
                var adj = {};
                isus.forEach(function(isu) { adj[String(isu.id)] = []; });

                var addEdge = function(id1, id2) {
                    if (id1 && id2 && id1 !== id2 && adj[id1] && adj[id2]) {
                        if (adj[id1].indexOf(id2) === -1) adj[id1].push(id2);
                        if (adj[id2].indexOf(id1) === -1) adj[id2].push(id1);
                    }
                };

                progs.forEach(function(r) {
                    var v = (r.isuIds || []).map(String).filter(function(id) { return !!adj[id]; });
                    if (v.length === 2) addEdge(v[0], v[1]);
                });

                perms.forEach(function(p) {
                    var v = (p.isuIds || (p.isuId ? [p.isuId] : [])).map(String).filter(function(id) { return !!adj[id]; });
                    if (v.length === 2) addEdge(v[0], v[1]);
                });

                // Cari simpul ujung (degree <= 1)
                var endpoints = [];
                isus.forEach(function(isu) {
                    var id = String(isu.id);
                    if (adj[id] && adj[id].length <= 1) endpoints.push(id);
                });

                var buildChain = function(startId) {
                    var visited = {};
                    var chain = [];
                    var queue = [startId];
                    visited[startId] = true;
                    while (queue.length > 0) {
                        var curr = queue.shift();
                        if (isuMap[curr]) chain.push(isuMap[curr]);
                        (adj[curr] || []).forEach(function(nbr) {
                            if (!visited[nbr]) {
                                visited[nbr] = true;
                                queue.push(nbr);
                            }
                        });
                    }
                    isus.forEach(function(isu) {
                        var id = String(isu.id);
                        if (!visited[id]) {
                            visited[id] = true;
                            chain.push(isu);
                        }
                    });
                    return chain;
                };

                var candidateIsus = isus.slice();
                if (isus.length > 1 && isus.length <= 6) {
                    var permute = function(arr) {
                        if (arr.length <= 1) return [arr];
                        var result = [];
                        for (var i = 0; i < arr.length; i++) {
                            var current = arr[i];
                            var remaining = arr.slice(0, i).concat(arr.slice(i + 1));
                            var remainingPerms = permute(remaining);
                            for (var j = 0; j < remainingPerms.length; j++) {
                                result.push([current].concat(remainingPerms[j]));
                            }
                        }
                        return result;
                    };

                    var allPerms = permute(isus);
                    var bestScore = 99999999;
                    var bestOrder = candidateIsus;

                    allPerms.forEach(function(cand) {
                        var tIdx = {};
                        cand.forEach(function(isu, idx) { tIdx[String(isu.id)] = idx; });

                        var score = 0;
                        perms.forEach(function(p) {
                            var ids = (p.isuIds || (p.isuId ? [p.isuId] : [])).map(String);
                            var matched = [];
                            ids.forEach(function(id) {
                                if (tIdx[id] !== undefined) matched.push(tIdx[id]);
                            });
                            matched.sort(function(a, b) { return a - b; });
                            var cnt = matched.length;
                            if (cnt > 1) {
                                var span = matched[cnt - 1] - matched[0];
                                score += span;
                                if (span !== cnt - 1) score += 1000;
                            }
                        });

                        progs.forEach(function(r) {
                            var ids = (r.isuIds || []).map(String);
                            var matched = [];
                            ids.forEach(function(id) {
                                if (tIdx[id] !== undefined) matched.push(tIdx[id]);
                            });
                            matched.sort(function(a, b) { return a - b; });
                            var cnt = matched.length;
                            if (cnt > 1) {
                                var span = matched[cnt - 1] - matched[0];
                                score += span;
                                if (span !== cnt - 1) score += 1000;
                            }
                        });

                        var avgPositions = [];
                        perms.forEach(function(p) {
                            var ids = (p.isuIds || (p.isuId ? [p.isuId] : [])).map(String);
                            var matched = [];
                            ids.forEach(function(id) {
                                if (tIdx[id] !== undefined) matched.push(tIdx[id]);
                            });
                            avgPositions.push(matched.length > 0 ? (matched.reduce(function(a, b){ return a + b; }, 0) / matched.length) : 0);
                        });

                        for (var i = 0; i < avgPositions.length; i++) {
                            for (var j = i + 1; j < avgPositions.length; j++) {
                                if (avgPositions[i] > avgPositions[j]) score += 100;
                                if (avgPositions[i] === avgPositions[j]) score += 50;
                            }
                        }

                        if (score < bestScore) {
                            bestScore = score;
                            bestOrder = cand;
                        }
                    });

                    candidateIsus = bestOrder;
                } else if (endpoints.length >= 2) {
                    var cand1 = buildChain(endpoints[0]);
                    candidateIsus = cand1;
                }

                var orderedIsus = candidateIsus;

                clusterList.push({
                    type: 'chain',
                    isus: orderedIsus,
                    perms: perms,
                    progs: progs
                });
            }
        });

        // Tangani permasalahan dan prioritas yang belum dipetakan
        var unmappedPerms = (S.perm || []).filter(function(p) {
            return !allMappedPermIds[String(p.id)];
        });
        var unmappedProgs = (S.prog || []).filter(function(r) {
            return !allMappedProgIds[String(r.id)];
        });

        if (unmappedPerms.length > 0 || unmappedProgs.length > 0) {
            clusterList.push({
                type: 'unmapped',
                P: unmappedPerms,
                R: unmappedProgs
            });
        }

        return clusterList;
    }

    function getOrderedIsus() {
        var cls = clusters();
        var ordered = [];
        var seen = {};
        cls.forEach(function(c) {
            if (c.isus) {
                c.isus.forEach(function(isu) {
                    var id = String(isu.id);
                    if (!seen[id]) {
                        seen[id] = true;
                        ordered.push(isu);
                    }
                });
            }
        });
        (S.isu || []).forEach(function(isu) {
            var id = String(isu.id);
            if (!seen[id]) {
                seen[id] = true;
                ordered.push(isu);
            }
        });
        return ordered;
    }

    function validateAdjacentSelection(selectedIds, allOrderedItems, labelType) {
        if (!selectedIds || selectedIds.length <= 1) return { valid: true };
        labelType = labelType || 'kategori';
        if (selectedIds.length > 2) {
            return {
                valid: false,
                message: 'Maksimal 2 ' + labelType + ' yang dapat diampu.'
            };
        }

        var itemIdx = {};
        (allOrderedItems || []).forEach(function(item, idx) {
            itemIdx[String(item.id)] = idx;
        });

        var idxs = [];
        selectedIds.forEach(function(id) {
            if (itemIdx[String(id)] !== undefined) {
                idxs.push(itemIdx[String(id)]);
            }
        });

        if (idxs.length === 2) {
            var diff = Math.abs(idxs[0] - idxs[1]);
            if (diff > 1) {
                var minIdx = Math.min(idxs[0], idxs[1]);
                var maxIdx = Math.max(idxs[0], idxs[1]);
                var first = allOrderedItems[minIdx].text;
                var second = allOrderedItems[maxIdx].text;
                var skipped = allOrderedItems[minIdx + 1].text;
                return {
                    valid: false,
                    message: 'Pilihan ' + labelType + ' harus berurutan / berdampingan (tidak bisa memilih ' + first + ' dan ' + second + ' karena melewati ' + skipped + ').'
                };
            }
        }
        return { valid: true };
    }

    function editable(list, obj, type, isuContext) {
        var box = el('div', 'item'), t = el('span', 't', obj.text);
        box.setAttribute('data-type', type);
        box.setAttribute('data-id', obj.id);

        if (isDaerah && kodeWilayah) {
            var actions = el('span', 'item-actions');

            // Tombol Edit (Hanya dapat diedit saat tombol edit ditekan)
            var pencil = el('button', 'btn-xs-custom btn-edit-level', '');
            pencil.type = 'button';
            pencil.title = 'Edit uraian & keterkaitannya';
            pencil.innerHTML = '<i class="fa fa-pencil"></i>';
            pencil.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                captureScroll();
                openEditModal(type, obj, isuContext);
            };

            // Tombol Hapus
            var x = el('button', 'btn-xs-custom btn-del-level', '');
            x.type = 'button';
            x.title = 'Hapus';
            x.setAttribute('aria-label', 'Hapus');
            x.innerHTML = '<i class="fa fa-trash"></i>';
            x.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                captureScroll();

                var msg = type === 'perm' ? 'Apakah Anda yakin ingin menghapus permasalahan ini?' :
                         (type === 'isu' ? 'Apakah Anda yakin ingin menghapus isu strategis ini?\n(Permasalahan terkait akan kembali berstatus belum dipetakan)' :
                         'Apakah Anda yakin ingin menghapus prioritas pembangunan daerah ini?');
                if (!confirm(msg)) return;

                $.ajax({
                    url: BaseURL + 'Daerah/DeleteCascadingItem',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        type: type,
                        id: obj.id,
                        isuId: isuContext ? isuContext.id : null,
                        KodeWilayah: kodeWilayah,
                        Tahun: tahun
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            reloadState();
                        } else {
                            alert(res.message || 'Gagal menghapus data.');
                        }
                    },
                    error: function(xhr, status, err) {
                        alert('Terjadi kesalahan server: ' + err);
                    }
                });
            };

            actions.append(pencil, x);
            box.append(t, actions);
        } else {
            box.append(t);
        }
        return box;
    }

    function cell(rows, cls) {
        var c = document.createElement('td');
        if (rows > 1) c.rowSpan = rows;
        if (cls) c.className = cls;
        return c;
    }

    function getDistribution(itemCount, totalRows) {
        if (itemCount <= 0 || totalRows <= 0) return {};
        var base = Math.floor(totalRows / itemCount);
        var rem = totalRows % itemCount;
        var res = {};
        var curr = 0;
        for (var i = 0; i < itemCount; i++) {
            var span = base + (i < rem ? 1 : 0);
            res[curr] = { idx: i, span: span };
            curr += span;
        }
        return res;
    }

    function renderTable(targetType, targetId) {
        var T = byId('tbl');
        if (!T) return;

        // Kunci tinggi minimum tabel agar tidak terjadi collapse tinggi dokumen yang menyebabkan scroll lompat ke atas
        var prevHeight = T.offsetHeight;
        if (prevHeight > 0) {
            T.style.minHeight = prevHeight + 'px';
        }

        T.innerHTML = '';
        var th = el('thead'), hr = el('tr');
        ['Permasalahan', 'Isu Strategis', 'Prioritas Pembangunan Daerah'].forEach(function(h) {
            var thCell = el('th', '', h);
            if (h === 'Permasalahan') thCell.style.width = '38%';
            else if (h === 'Isu Strategis') thCell.style.width = '32%';
            else thCell.style.width = '30%';
            hr.appendChild(thCell);
        });
        th.appendChild(hr);
        T.appendChild(th);

        var tb = el('tbody'), permNum = 0, cls = clusters();
        if (!cls.length) {
            var r = el('tr');
            var emptyTxt = kodeWilayah ? 'Belum ada data. Klik "Tambah permasalahan" untuk memulai.' : 'Silakan pilih Provinsi dan Kabupaten / Kota terlebih dahulu.';
            var c = el('td', 'empty-msg', emptyTxt);
            c.colSpan = 3;
            r.appendChild(c);
            tb.appendChild(r);
        }

        cls.forEach(function(cluster) {
            if (cluster.type === 'chain') {
                var isus = cluster.isus;
                var perms = cluster.perms || [];
                var progs = cluster.progs || [];
                var K = isus.length;

                var isuIdx = {};
                isus.forEach(function(isu, idx) {
                    isuIdx[String(isu.id)] = idx;
                });

                // 1. Kumpulkan permasalahan dan prioritas per Isu
                var p_per_isu = [];
                var r_per_isu = [];
                for (var i = 0; i < K; i++) {
                    p_per_isu.push([]);
                    r_per_isu.push([]);
                }

                perms.forEach(function(p) {
                    var ids = (p.isuIds || (p.isuId ? [p.isuId] : [])).map(String);
                    var matched = [];
                    ids.forEach(function(id) {
                        if (isuIdx[id] !== undefined) matched.push(isuIdx[id]);
                    });
                    matched.sort(function(a, b) { return a - b; });
                    matched.forEach(function(idx) {
                        p_per_isu[idx].push(p);
                    });
                });

                progs.forEach(function(r) {
                    var ids = (r.isuIds || []).map(String);
                    var matched = [];
                    ids.forEach(function(id) {
                        if (isuIdx[id] !== undefined) matched.push(isuIdx[id]);
                    });
                    matched.sort(function(a, b) { return a - b; });
                    matched.forEach(function(idx) {
                        r_per_isu[idx].push(r);
                    });
                });

                // Urutkan item di dalam Isu berdasarkan arah koneksi agar baris kontinu teratur:
                // Kategori 0: Item yang menyambung dari Isu di atasnya (min < isuIndex) -> ditempatkan di paling ATAS
                // Kategori 1: Item yang khusus/eksklusif pada Isu ini (min == isuIndex && max == isuIndex) -> di TENGAH
                // Kategori 2: Item yang menyambung ke Isu di bawahnya (max > isuIndex) -> ditempatkan di paling BAWAH
                function sortItemsInIsu(items, isuIndex) {
                    return items.slice().sort(function(a, b) {
                        var aIds = (a.isuIds || (a.isuId ? [a.isuId] : [])).map(String).map(function(id) { return isuIdx[id]; }).filter(function(x){ return x !== undefined; });
                        var bIds = (b.isuIds || (b.isuId ? [b.isuId] : [])).map(String).map(function(id) { return isuIdx[id]; }).filter(function(x){ return x !== undefined; });

                        var aMin = aIds.length > 0 ? Math.min.apply(null, aIds) : isuIndex;
                        var aMax = aIds.length > 0 ? Math.max.apply(null, aIds) : isuIndex;
                        var bMin = bIds.length > 0 ? Math.min.apply(null, bIds) : isuIndex;
                        var bMax = bIds.length > 0 ? Math.max.apply(null, bIds) : isuIndex;

                        var aCat = (aMin < isuIndex) ? 0 : ((aMax > isuIndex) ? 2 : 1);
                        var bCat = (bMin < isuIndex) ? 0 : ((bMax > isuIndex) ? 2 : 1);

                        if (aCat !== bCat) return aCat - bCat;
                        return String(a.id).localeCompare(String(b.id));
                    });
                }

                for (var i = 0; i < K; i++) {
                    p_per_isu[i] = sortItemsInIsu(p_per_isu[i], i);
                    r_per_isu[i] = sortItemsInIsu(r_per_isu[i], i);
                }

                // 2. Hitung tinggi (baris) yang dibutuhkan masing-masing Isu
                var H = [];
                for (var i = 0; i < K; i++) {
                    var m = p_per_isu[i].length;
                    var rCount = r_per_isu[i].length;
                    H.push(Math.max(1, m, rCount));
                }

                var col1Items = {};
                var col2Items = {};
                var col3Items = {};

                var p_span = {};
                var p_start = {};
                var r_span = {};
                var r_start = {};

                var currRow = 0;
                for (var i = 0; i < K; i++) {
                    var isuStart = currRow;
                    var isuHeight = H[i];
                    col2Items[isuStart] = { isu: isus[i], span: isuHeight };

                    // Distribusikan baris untuk Permasalahan yang melintasi Isu i
                    var m = p_per_isu[i].length;
                    if (m > 0) {
                        var base = Math.floor(isuHeight / m);
                        var rem = isuHeight % m;
                        var rOffset = isuStart;
                        for (var k = 0; k < m; k++) {
                            var p = p_per_isu[i][k];
                            var pid = String(p.id);
                            var s = base + (k < rem ? 1 : 0);
                            if (p_start[pid] === undefined) {
                                p_start[pid] = rOffset;
                                p_span[pid] = 0;
                            }
                            p_span[pid] += s;
                            rOffset += s;
                        }
                    } else {
                        col1Items[isuStart] = { item: null, span: isuHeight };
                    }

                    // Distribusikan baris untuk Prioritas yang melintasi Isu i
                    var rCount = r_per_isu[i].length;
                    if (rCount > 0) {
                        var base = Math.floor(isuHeight / rCount);
                        var rem = isuHeight % rCount;
                        var rOffset = isuStart;
                        for (var k = 0; k < rCount; k++) {
                            var r = r_per_isu[i][k];
                            var rid = String(r.id);
                            var s = base + (k < rem ? 1 : 0);
                            if (r_start[rid] === undefined) {
                                r_start[rid] = rOffset;
                                r_span[rid] = 0;
                            }
                            r_span[rid] += s;
                            rOffset += s;
                        }
                    } else {
                        col3Items[isuStart] = { item: null, span: isuHeight, isuContext: isus[i] };
                    }

                    currRow += isuHeight;
                }

                var totalClusterRows = currRow;

                // Masukkan Permasalahan ke col1Items pada baris awalnya dengan total span kontinu
                perms.forEach(function(p) {
                    var pid = String(p.id);
                    if (p_start[pid] !== undefined) {
                        col1Items[p_start[pid]] = { item: p, span: p_span[pid] };
                    }
                });

                // Masukkan Prioritas ke col3Items pada baris awalnya dengan total span kontinu
                progs.forEach(function(r) {
                    var rid = String(r.id);
                    if (r_start[rid] !== undefined) {
                        var matchedIsu = isus[0];
                        for (var ui = 0; ui < isus.length; ui++) {
                            if ((r.isuIds || []).map(String).indexOf(String(isus[ui].id)) !== -1) {
                                matchedIsu = isus[ui];
                                break;
                            }
                        }
                        col3Items[r_start[rid]] = { item: r, span: r_span[rid], isuContext: matchedIsu };
                    }
                });

                // 6. Buat baris <tr> dan sel <td> untuk cluster ini
                for (var rIdx = 0; rIdx < totalClusterRows; rIdx++) {
                    var tr = el('tr');

                    // Kolom 1: Permasalahan
                    if (col1Items[rIdx]) {
                        var pInfo = col1Items[rIdx];
                        var c1 = cell(pInfo.span);
                        if (pInfo.item) {
                            permNum++;
                            var w = el('div', 'item-wrapper');
                            w.style.display = 'flex';
                            w.style.alignItems = 'flex-start';
                            w.style.gap = '8px';
                            w.style.width = '100%';

                            var num = el('span', 'item-num', permNum + '.');
                            num.style.fontWeight = '700';
                            num.style.color = '#15803d';
                            num.style.minWidth = '20px';
                            num.style.paddingTop = '3px';
                            num.style.fontSize = '13px';
                            w.appendChild(num);

                            var ed = editable(S.perm, pInfo.item, 'perm', null);
                            ed.style.flex = '1';
                            w.appendChild(ed);
                            c1.appendChild(w);
                        } else {
                            c1.appendChild(el('span', 'na', 'Belum ada permasalahan'));
                        }
                        tr.appendChild(c1);
                    }

                    // Kolom 2: Isu Strategis
                    if (col2Items[rIdx]) {
                        var iInfo = col2Items[rIdx];
                        var c2 = cell(iInfo.span);
                        c2.appendChild(editable(S.isu, iInfo.isu, 'isu', null));
                        tr.appendChild(c2);
                    }

                    // Kolom 3: Prioritas Pembangunan Daerah
                    if (col3Items[rIdx]) {
                        var rInfo = col3Items[rIdx];
                        var c3 = cell(rInfo.span);
                        if (rInfo.item) {
                            c3.appendChild(editable(S.prog, rInfo.item, 'prog', rInfo.isuContext));
                        } else {
                            c3.appendChild(el('span', 'na', 'Belum ada prioritas pembangunan daerah'));
                        }
                        tr.appendChild(c3);
                    }

                    tb.appendChild(tr);
                }

            } else if (cluster.type === 'unmapped') {
                var P = cluster.P || [];
                var R = cluster.R || [];
                var rows = Math.max(P.length, R.length, 1);
                for (var k = 0; k < rows; k++) {
                    var tr = el('tr');

                    // Kolom 1: Permasalahan belum dipetakan
                    if (P.length === 0) {
                        if (k === 0) {
                            var c0 = cell(rows);
                            c0.appendChild(el('span', 'na', '—'));
                            tr.appendChild(c0);
                        }
                    } else if (k < P.length) {
                        var c1 = cell(k === P.length - 1 ? (rows - k) : 1);
                        permNum++;
                        var w = el('div', 'item-wrapper');
                        w.style.display = 'flex';
                        w.style.alignItems = 'flex-start';
                        w.style.gap = '8px';
                        w.style.width = '100%';

                        var num = el('span', 'item-num', permNum + '.');
                        num.style.fontWeight = '700';
                        num.style.color = '#15803d';
                        num.style.minWidth = '20px';
                        num.style.paddingTop = '3px';
                        num.style.fontSize = '13px';
                        w.appendChild(num);

                        var ed = editable(S.perm, P[k], 'perm', null);
                        ed.style.flex = '1';
                        w.appendChild(ed);
                        c1.appendChild(w);
                        tr.appendChild(c1);
                    }

                    // Kolom 2: Keterangan belum dipetakan
                    if (k === 0) {
                        var c2 = cell(rows);
                        c2.appendChild(el('span', 'na', 'Belum dipetakan ke isu strategis'));
                        tr.appendChild(c2);
                    }

                    // Kolom 3: Prioritas belum dipetakan
                    if (R.length === 0) {
                        if (k === 0) {
                            var c3 = cell(rows);
                            c3.appendChild(el('span', 'na', '—'));
                            tr.appendChild(c3);
                        }
                    } else if (k < R.length) {
                        var c4 = cell(k === R.length - 1 ? (rows - k) : 1);
                        c4.appendChild(editable(S.prog, R[k], 'prog', null));
                        tr.appendChild(c4);
                    }

                    tb.appendChild(tr);
                }
            }
        });
        T.appendChild(tb);

        // Lepas minHeight secara mulus
        setTimeout(function() {
            if (T) T.style.minHeight = '';
        }, 120);

        // Kembalikan posisi scroll pada beberapa interval agar modal bootstrap tidak meresetnya
        restoreScroll();
        requestAnimationFrame(restoreScroll);
        setTimeout(restoreScroll, 40);
        setTimeout(restoreScroll, 120);
        setTimeout(restoreScroll, 300);

        // Beri efek highlight pada item yang baru selesai diedit
        if (targetType && targetId) {
            setTimeout(function() {
                var targetEl = document.querySelector('.item[data-type="' + targetType + '"][data-id="' + targetId + '"]');
                if (targetEl) {
                    targetEl.classList.add('highlight-edited');
                    setTimeout(function() {
                        targetEl.classList.remove('highlight-edited');
                    }, 2200);

                    // Pastikan tetap berada dalam bidang pandang tanpa lompat kasar
                    var rect = targetEl.getBoundingClientRect();
                    var windowH = window.innerHeight || document.documentElement.clientHeight;
                    if (rect.top < 60 || rect.bottom > windowH - 30) {
                        targetEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                }
            }, 60);
        }
    }

    function clean() {
        var ids = {};
        (S.isu || []).forEach(function(i) { ids[String(i.id)] = 1; });
        (S.perm || []).forEach(function(p) {
            p.isuIds = (p.isuIds || (p.isuId ? [p.isuId] : [])).filter(function(id) { return ids[String(id)]; });
            p.isuId = p.isuIds.length ? p.isuIds[0] : null;
        });
        (S.prog || []).forEach(function(r) {
            r.isuIds = (r.isuIds || []).filter(function(id) { return ids[String(id)]; });
        });
    }

    function render(targetType, targetId) {
        clean();
        if (isDaerah && kodeWilayah) {
            var hasPerm = S.perm && S.perm.length > 0;
            var hasIsu = S.isu && S.isu.length > 0;

            $('#bI').prop('disabled', !hasPerm).attr('title', hasPerm ? '' : 'Tambahkan permasalahan terlebih dahulu');
            $('#bR').prop('disabled', !hasIsu).attr('title', hasIsu ? '' : 'Tambahkan isu strategis terlebih dahulu');
        }
        renderTable(targetType, targetId);
    }

    function reloadState(targetType, targetId) {
        if (!kodeWilayah) return;
        if (savedScrollY === null || savedScrollY === undefined) {
            captureScroll();
        }
        $.ajax({
            url: BaseURL + 'Daerah/GetCascadingData',
            type: 'POST',
            dataType: 'json',
            cache: false,
            data: {
                KodeWilayah: kodeWilayah,
                Tahun: tahun,
                _t: new Date().getTime()
            },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    S = res.data;
                    render(targetType, targetId);
                }
            }
        });
    }

    // Modal Actions
    if (isDaerah && kodeWilayah) {

        // 1. Tambah Permasalahan
        $('#bP').on('click', function() {
            captureScroll();
            $('#inP').val('');
            $('#eP').text('');
            $('#dP').modal('show');
            setTimeout(function() { $('#inP').focus(); }, 350);
        });

        $('#sP').on('click', function() {
            var raw = $('#inP').val();
            var lines = raw.split('\n').map(function(s) { return s.trim(); }).filter(Boolean);

            if (!lines.length) {
                $('#eP').text('Isi permasalahan terlebih dahulu.');
                $('#inP').focus();
                return;
            }
            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/SavePermasalahan',
                type: 'POST',
                dataType: 'json',
                data: {
                    lines: lines,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).text('Simpan');
                    if (res.status === 'success') {
                        $('#dP').modal('hide');
                        reloadState();
                    } else {
                        $('#eP').text(res.message || 'Gagal menyimpan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).text('Simpan');
                    $('#eP').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // 2. Tambah Isu Strategis
        $('#bI').on('click', function() {
            captureScroll();
            $('#inI').val('');
            $('#eI').text('');
            $('#searchPickP').val('');
            var pk = $('#pickP');
            pk.empty();

            if (!S.perm || !S.perm.length) {
                pk.html('<div class="empty-msg">Belum ada permasalahan yang tersedia. (Anda tetap dapat menyimpan isu strategis ini dan memetakannya nanti)</div>');
            } else {
                S.perm.forEach(function(p) {
                    var l = $('<label class="chk"></label>');
                    var inp = $('<input type="checkbox">').val(p.id);

                    inp.on('change', function() {
                        var checkedBoxes = pk.find('input:checked');
                        var checkedIds = [];
                        checkedBoxes.each(function() { checkedIds.push($(this).val()); });

                        if (checkedIds.length > 2) {
                            $(this).prop('checked', false);
                            $('#eI').text('Maksimal 2 Permasalahan yang dapat diampu.');
                            return;
                        }

                        var adjCheck = validateAdjacentSelection(checkedIds, S.perm, 'Permasalahan');
                        if (!adjCheck.valid) {
                            $(this).prop('checked', false);
                            $('#eI').text(adjCheck.message);
                        } else {
                            $('#eI').text('');
                        }
                    });

                    l.append(inp).append($('<span></span>').text(p.text));
                    pk.append(l);
                });
            }
            $('#sI').prop('disabled', false);
            $('#dI').modal('show');
            setTimeout(function() { $('#inI').focus(); }, 350);
        });

        $('#sI').on('click', function() {
            var t = $.trim($('#inI').val());
            var ids = [];
            $('#pickP input:checked').each(function() {
                ids.push($(this).val());
            });

            if (!t) {
                $('#eI').text('Isi isu strategis terlebih dahulu.');
                $('#inI').focus();
                return;
            }

            if (ids.length > 2) {
                $('#eI').text('Maksimal 2 Permasalahan yang dapat diampu.');
                return;
            }

            var adjCheck = validateAdjacentSelection(ids, S.perm, 'Permasalahan');
            if (!adjCheck.valid) {
                $('#eI').text(adjCheck.message);
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/SaveIsuStrategis',
                type: 'POST',
                dataType: 'json',
                data: {
                    text: t,
                    permIds: ids,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).text('Simpan');
                    if (res.status === 'success') {
                        $('#dI').modal('hide');
                        reloadState();
                    } else {
                        $('#eI').text(res.message || 'Gagal menyimpan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).text('Simpan');
                    $('#eI').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // 3. Tambah Prioritas Pembangunan Daerah
        $('#bR').on('click', function() {
            captureScroll();
            $('#inR').val('');
            $('#eR').text('');
            $('#searchPickI').val('');
            var pk = $('#pickI');
            pk.empty();

            var orderedIsus = getOrderedIsus();
            if (!orderedIsus || !orderedIsus.length) {
                pk.html('<div class="empty-msg">Belum ada isu strategis. Tambahkan isu strategis terlebih dahulu.</div>');
                $('#sR').prop('disabled', true);
            } else {
                $('#sR').prop('disabled', false);
                orderedIsus.forEach(function(i, idx) {
                    var l = $('<label class="chk"></label>');
                    var c = $('<input type="checkbox" name="pickIsuChk">').val(i.id);

                    c.on('change', function() {
                        var checkedBoxes = pk.find('input[name="pickIsuChk"]:checked');
                        var checkedIds = [];
                        checkedBoxes.each(function() { checkedIds.push($(this).val()); });

                        if (checkedIds.length > 2) {
                            $(this).prop('checked', false);
                            $('#eR').text('Maksimal 2 Isu Strategis yang dapat diampu.');
                            return;
                        }

                        var adjCheck = validateAdjacentSelection(checkedIds, orderedIsus, 'Isu Strategis');
                        if (!adjCheck.valid) {
                            $(this).prop('checked', false);
                            $('#eR').text(adjCheck.message);
                        } else {
                            $('#eR').text('');
                        }
                    });

                    l.append(c).append($('<span></span>').text(i.text));
                    pk.append(l);
                });
            }
            $('#dR').modal('show');
            setTimeout(function() { $('#inR').focus(); }, 350);
        });

        $('#sR').on('click', function() {
            var t = $.trim($('#inR').val());
            var ids = [];
            $('#pickI input[name="pickIsuChk"]:checked').each(function() {
                ids.push($(this).val());
            });

            if (!ids.length) {
                $('#eR').text('Pilih minimal 1 isu strategis.');
                return;
            }
            if (ids.length > 2) {
                $('#eR').text('Maksimal 2 Isu Strategis yang dapat diampu.');
                return;
            }
            var orderedIsus = getOrderedIsus();
            var adjCheck = validateAdjacentSelection(ids, orderedIsus, 'Isu Strategis');
            if (!adjCheck.valid) {
                $('#eR').text(adjCheck.message);
                return;
            }
            if (!t) {
                $('#eR').text('Isi prioritas pembangunan daerah terlebih dahulu.');
                $('#inR').focus();
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/SavePrioritasDaerah',
                type: 'POST',
                dataType: 'json',
                data: {
                    text: t,
                    isuIds: ids,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).text('Simpan');
                    if (res.status === 'success') {
                        $('#dR').modal('hide');
                        reloadState();
                    } else {
                        $('#eR').text(res.message || 'Gagal menyimpan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).text('Simpan');
                    $('#eR').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // ============================================================
        // MODAL EDIT KETERKAITAN (Permasalahan, Isu, Prioritas)
        // ============================================================

        function openEditModal(type, obj, isuContext) {
            captureScroll();
            if (type === 'perm') {
                var curPerm = (S.perm || []).find(function(p) { return String(p.id) === String(obj.id); }) || obj;
                $('#editPermId').val(curPerm.id);
                $('#editPermText').val(curPerm.text);
                $('#editPermErr').text('');
                $('#searchEditPermIsu').val('');

                var ctn = $('#editPermIsuContainer');
                ctn.empty();

                var orderedIsus = getOrderedIsus();
                if (!orderedIsus || !orderedIsus.length) {
                    ctn.html('<div class="empty-msg">Belum ada isu strategis.</div>');
                } else {
                    var activeIsuIds = (curPerm.isuIds && curPerm.isuIds.length) 
                        ? curPerm.isuIds.map(String) 
                        : (curPerm.isuId ? [String(curPerm.isuId)] : ((isuContext && isuContext.id) ? [String(isuContext.id)] : []));

                    orderedIsus.forEach(function(i, idx) {
                        var isChecked = activeIsuIds.indexOf(String(i.id)) > -1;
                        var l = $('<label class="chk"></label>');
                        var inp = $('<input type="checkbox" name="editPermIsuChk">').val(i.id).prop('checked', isChecked);

                        inp.on('change', function() {
                            var checkedBoxes = ctn.find('input[name="editPermIsuChk"]:checked');
                            var checkedIds = [];
                            checkedBoxes.each(function() { checkedIds.push($(this).val()); });

                            if (checkedIds.length > 2) {
                                $(this).prop('checked', false);
                                $('#editPermErr').text('Maksimal 2 Isu Strategis yang dapat diampu.');
                                return;
                            }

                            var adjCheck = validateAdjacentSelection(checkedIds, orderedIsus, 'Isu Strategis');
                            if (!adjCheck.valid) {
                                $(this).prop('checked', false);
                                $('#editPermErr').text(adjCheck.message);
                            } else {
                                $('#editPermErr').text('');
                            }
                        });

                        l.append(inp).append($('<span></span>').text(i.text));
                        ctn.append(l);
                    });
                }

                $('#ModalEditPermasalahan').modal('show');
                setTimeout(function() { $('#editPermText').focus(); }, 350);

            } else if (type === 'isu') {
                var curIsu = (S.isu || []).find(function(i) { return String(i.id) === String(obj.id); }) || obj;
                $('#editIsuId').val(curIsu.id);
                $('#editIsuText').val(curIsu.text);
                $('#editIsuErr').text('');
                $('#searchEditIsuPerm').val('');

                var ctn = $('#editIsuPermContainer');
                ctn.empty();

                if (!S.perm || !S.perm.length) {
                    ctn.html('<div class="empty-msg">Belum ada permasalahan yang tersedia.</div>');
                } else {
                    S.perm.forEach(function(p) {
                        var pIsuIds = (p.isuIds || (p.isuId ? [p.isuId] : [])).map(String);
                        var isChecked = pIsuIds.indexOf(String(curIsu.id)) > -1;

                        var l = $('<label class="chk"></label>');
                        var inp = $('<input type="checkbox">').val(p.id).prop('checked', isChecked);

                        inp.on('change', function() {
                            var checkedBoxes = ctn.find('input:checked');
                            var checkedIds = [];
                            checkedBoxes.each(function() { checkedIds.push($(this).val()); });

                            if (checkedIds.length > 2) {
                                $(this).prop('checked', false);
                                $('#editIsuErr').text('Maksimal 2 Permasalahan yang dapat diampu.');
                                return;
                            }

                            var adjCheck = validateAdjacentSelection(checkedIds, S.perm, 'Permasalahan');
                            if (!adjCheck.valid) {
                                $(this).prop('checked', false);
                                $('#editIsuErr').text(adjCheck.message);
                            } else {
                                $('#editIsuErr').text('');
                            }
                        });

                        l.append(inp).append($('<span></span>').text(p.text));
                        ctn.append(l);
                    });
                }
                $('#ModalEditIsu').modal('show');
                setTimeout(function() { $('#editIsuText').focus(); }, 350);

            } else if (type === 'prog') {
                var curProg = (S.prog || []).find(function(r) { return String(r.id) === String(obj.id); }) || obj;
                $('#editProgId').val(curProg.id);
                $('#editProgText').val(curProg.text);
                $('#editProgErr').text('');
                $('#searchEditProgIsu').val('');

                var ctn = $('#editProgIsuContainer');
                ctn.empty();

                var orderedIsus = getOrderedIsus();
                if (!orderedIsus || !orderedIsus.length) {
                    ctn.html('<div class="empty-msg">Belum ada isu strategis.</div>');
                } else {
                    var activeIsuIds = (curProg.isuIds && curProg.isuIds.length) 
                        ? curProg.isuIds.map(String) 
                        : (isuContext && isuContext.id ? [String(isuContext.id)] : []);

                    orderedIsus.forEach(function(i, idx) {
                        var isChecked = activeIsuIds.indexOf(String(i.id)) > -1;
                        var l = $('<label class="chk"></label>');
                        var inp = $('<input type="checkbox" name="editProgIsuChk">').val(i.id).prop('checked', isChecked);

                        inp.on('change', function() {
                            var checkedBoxes = ctn.find('input[name="editProgIsuChk"]:checked');
                            var checkedIds = [];
                            checkedBoxes.each(function() { checkedIds.push($(this).val()); });

                            if (checkedIds.length > 2) {
                                $(this).prop('checked', false);
                                $('#editProgErr').text('Maksimal 2 Isu Strategis yang dapat diampu.');
                                return;
                            }

                            var adjCheck = validateAdjacentSelection(checkedIds, orderedIsus, 'Isu Strategis');
                            if (!adjCheck.valid) {
                                $(this).prop('checked', false);
                                $('#editProgErr').text(adjCheck.message);
                            } else {
                                $('#editProgErr').text('');
                            }
                        });

                        l.append(inp).append($('<span></span>').text(i.text));
                        ctn.append(l);
                    });
                }
                $('#ModalEditPrioritas').modal('show');
                setTimeout(function() { $('#editProgText').focus(); }, 350);
            }
        }

        // Simpan Edit Permasalahan
        $('#btnSaveEditPerm').on('click', function() {
            var id = $('#editPermId').val();
            var text = $.trim($('#editPermText').val());
            var isuIds = [];
            $('#editPermIsuContainer input[name="editPermIsuChk"]:checked').each(function() {
                isuIds.push($(this).val());
            });

            if (!text) {
                $('#editPermErr').text('Uraian permasalahan wajib diisi!');
                $('#editPermText').focus();
                return;
            }

            if (isuIds.length > 2) {
                $('#editPermErr').text('Maksimal 2 Isu Strategis yang dapat diampu.');
                return;
            }
            var orderedIsus = getOrderedIsus();
            var adjCheck = validateAdjacentSelection(isuIds, orderedIsus, 'Isu Strategis');
            if (!adjCheck.valid) {
                $('#editPermErr').text(adjCheck.message);
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateKeterkaitanPermasalahan',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    text: text,
                    isuIds: isuIds,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    if (res.status === 'success') {
                        $('#ModalEditPermasalahan').modal('hide');
                        reloadState('perm', id);
                    } else {
                        $('#editPermErr').text(res.message || 'Gagal menyimpan perubahan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    $('#editPermErr').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // Simpan Edit Isu Strategis & Pemetaan Permasalahan
        $('#btnSaveEditIsu').on('click', function() {
            var id = $('#editIsuId').val();
            var text = $.trim($('#editIsuText').val());
            var permIds = [];
            $('#editIsuPermContainer input:checked').each(function() {
                permIds.push($(this).val());
            });

            if (!text) {
                $('#editIsuErr').text('Uraian isu strategis wajib diisi!');
                $('#editIsuText').focus();
                return;
            }

            if (permIds.length > 2) {
                $('#editIsuErr').text('Maksimal 2 Permasalahan yang dapat diampu.');
                return;
            }
            var adjCheck = validateAdjacentSelection(permIds, S.perm, 'Permasalahan');
            if (!adjCheck.valid) {
                $('#editIsuErr').text(adjCheck.message);
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateKeterkaitanIsu',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    text: text,
                    permIds: permIds,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    if (res.status === 'success') {
                        $('#ModalEditIsu').modal('hide');
                        reloadState('isu', id);
                    } else {
                        $('#editIsuErr').text(res.message || 'Gagal menyimpan perubahan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    $('#editIsuErr').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // Simpan Edit Prioritas Daerah & Keterkaitan Isu
        $('#btnSaveEditProg').on('click', function() {
            var id = $('#editProgId').val();
            var text = $.trim($('#editProgText').val());
            var isuIds = [];
            $('#editProgIsuContainer input[name="editProgIsuChk"]:checked').each(function() {
                isuIds.push($(this).val());
            });

            if (!text) {
                $('#editProgErr').text('Uraian prioritas daerah wajib diisi!');
                $('#editProgText').focus();
                return;
            }
            if (!isuIds.length) {
                $('#editProgErr').text('Pilih minimal 1 isu strategis yang terkait!');
                return;
            }
            if (isuIds.length > 2) {
                $('#editProgErr').text('Maksimal 2 Isu Strategis yang dapat diampu.');
                return;
            }
            var orderedIsus = getOrderedIsus();
            var adjCheck = validateAdjacentSelection(isuIds, orderedIsus, 'Isu Strategis');
            if (!adjCheck.valid) {
                $('#editProgErr').text(adjCheck.message);
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateKeterkaitanPrioritas',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    text: text,
                    isuIds: isuIds,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    if (res.status === 'success') {
                        $('#ModalEditPrioritas').modal('hide');
                        reloadState('prog', id);
                    } else {
                        $('#editProgErr').text(res.message || 'Gagal menyimpan perubahan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    $('#editProgErr').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // Filter Pencarian Real-Time pada Checkbox Modal
        function bindSearchFilter(inputId, containerId) {
            $('#' + inputId).on('input keyup', function() {
                var q = $(this).val().toLowerCase().trim();
                var $container = $('#' + containerId);
                var $items = $container.find('label.chk');
                var matchCount = 0;

                $items.each(function() {
                    var txt = $(this).text().toLowerCase();
                    var isMatch = !q || txt.indexOf(q) > -1;
                    $(this).css('display', isMatch ? 'flex' : 'none');
                    if (isMatch) matchCount++;
                });

                var $noMatch = $container.find('.search-no-match');
                if (q && matchCount === 0 && $items.length > 0) {
                    if (!$noMatch.length) {
                        $container.append('<div class="search-no-match empty-msg" style="padding: 10px; margin-top: 4px; font-size: 12px;">Tidak ditemukan data yang sesuai dengan pencarian "' + $('<div>').text(q).html() + '"</div>');
                    } else {
                        $noMatch.html('Tidak ditemukan data yang sesuai dengan pencarian "' + $('<div>').text(q).html() + '"').show();
                    }
                } else {
                    $noMatch.hide();
                }
            });
        }

        bindSearchFilter('searchPickP', 'pickP');
        bindSearchFilter('searchPickI', 'pickI');
        bindSearchFilter('searchEditPermIsu', 'editPermIsuContainer');
        bindSearchFilter('searchEditIsuPerm', 'editIsuPermContainer');
        bindSearchFilter('searchEditProgIsu', 'editProgIsuContainer');

        // Reset pencarian saat modal ditutup
        $('#dP, #dI, #dR, #ModalEditPermasalahan, #ModalEditIsu, #ModalEditPrioritas').on('hidden.bs.modal', function() {
            $(this).find('input[id^="search"]').val('');
        });

    }

    // Filter Provinsi/KabKota untuk admin
    $('#FilterProvinsi').on('change', function() {
        var provKode = $(this).val();
        if (!provKode) {
            $('#FilterKabKota').html('<option value="">-- Pilih Kabupaten / Kota --</option>');
            return;
        }
        $.ajax({
            url: BaseURL + 'Daerah/GetKabKotaByProvinsi',
            type: 'POST',
            dataType: 'json',
            data: { KodeProvinsi: provKode },
            success: function(kabList) {
                var opt = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                if (kabList) {
                    for (var i = 0; i < kabList.length; i++) {
                        var k = kabList[i];
                        opt += '<option value="' + k.Kode + '">' + $('<div>').text(k.Nama).html() + '</option>';
                    }
                }
                $('#FilterKabKota').html(opt);
            }
        });
    });

    // Populate KabKota saat halaman dibuka jika sudah ada provinsi terpilih
    var initProv = $('#FilterProvinsi').val();
    if (initProv) {
        $.ajax({
            url: BaseURL + 'Daerah/GetKabKotaByProvinsi',
            type: 'POST',
            dataType: 'json',
            data: { KodeProvinsi: initProv },
            success: function(kabList) {
                var opt = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                if (kabList) {
                    for (var i = 0; i < kabList.length; i++) {
                        var k = kabList[i];
                        var sel = (k.Kode === kodeWilayah) ? 'selected' : '';
                        opt += '<option value="' + k.Kode + '" ' + sel + '>' + $('<div>').text(k.Nama).html() + '</option>';
                    }
                }
                $('#FilterKabKota').html(opt);
            }
        });
    }

    render();
});
</script>
