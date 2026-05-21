<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- FILTER PROVINSI & KAB/KOTA (jika belum set wilayah permanen) -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap mb-4">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <label><b>Provinsi</b></label>
                                                <select class="form-control" id="Provinsi">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($Provinsi as $prov) { ?>
                                                        <option value="<?= html_escape($prov['Kode']) ?>"
                                                            <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                            <?= html_escape($prov['Nama']) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <label><b>Kab/Kota</b></label>
                                                <select class="form-control" id="KabKota">
                                                    <option value="">Pilih Kab/Kota</option>
                                                </select>
                                            </div>

                                            <!-- FILTER INSTANSI SEBELUM LOGIN -->
                                            <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display: none;">
                                                <label><b>Filter Instansi</b></label>
                                                <select class="form-control" id="FilterInstansiBeforeLogin">
                                                    <option value="">-- Semua Instansi --</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-2 col-md-6">
                                                <label>&nbsp;</label>
                                                <button class="btn btn-primary btn-block" id="Filter">FILTER</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { 
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                            ?>
                                <div class="alert alert-info mb-4">
                                    <strong>Wilayah Aktif:</strong> <?= $nama_wilayah ?>
                                    <?php 
                                    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                    if (!empty($filter_instansi_id)) { 
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                                    ?>
                                        <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="filter-group">
                                                    <label for="FilterInstansi"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansi">
                                                        <option value="">-- Semua Instansi --</option>
                                                        <?php foreach ($ListInstansi as $ins) { ?>
                                                            <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                                <?= html_escape($ins['nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                                                        <b>Tampilkan</b>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn">
                                                        <b>Reset</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                        <!-- TOMBOL TAMBAH GRUP -->
                        <div class="basic-tb-hd">
                            <?php if ($IsRole4) { ?>
                                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#ModalTambahHeader">
                                    <i class="fa fa-plus"></i> Tambah Grup Renstra PD
                                </button>
                            <?php } ?>
                        </div>


                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:60px;">No</th>
                                        <th style="width:25%;">NSPK dan Sasaran RPJMD yang Relevan</th>
                                        <th style="width:15%;">Tujuan PD</th>
                                        <th style="width:15%;">Sasaran PD</th>
                                        <th style="width:10%;">Outcome</th>
                                        <th style="width:10%;">Output</th>
                                        <th style="width:10%;">Indikator</th>
                                        <th style="width:15%;">Program/Kegiatan</th>
                                        <th style="width:10%;">Keterangan</th>
                                        <?php if ($IsRole4) { ?>
                                            <th class="text-center" style="width:100px;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($RumusanRenstra)) { 
                                        $group_no = 0;
                                        $prev_header_id = null;
                                    ?>
                                        <?php foreach ($RumusanRenstra as $r) { 
                                            $is_new_group = ($r['header_id'] != $prev_header_id);
                                            if ($is_new_group) $group_no++;
                                            $prev_header_id = $r['header_id'];
                                        ?>
                                            <tr <?= $is_new_group ? 'class="table-primary"' : '' ?>>
                                                <!-- No Grup -->
                                                <td class="text-center align-middle font-weight-bold" <?= $is_new_group ? '' : 'style="display:none;"' ?> rowspan="<?= $is_new_group ? $GroupCounts[$r['header_id']] : 1 ?>">
                                                    <?= $group_no ?>
                                                </td>

                                                <!-- NSPK + Sasaran RPJMD Relevan -->
                                                <td class="align-top" <?= $is_new_group ? '' : 'style="display:none;"' ?> rowspan="<?= $is_new_group ? $GroupCounts[$r['header_id']] : 1 ?>">
                                                   <div class="p-2">
                                                        <strong>Norma:</strong><br>
                                                        <?php if(!empty($r['norma'])){ foreach($r['norma'] as $n){ ?>
                                                            • <?= html_escape($n['judul_nspk']) ?><br>
                                                        <?php } } else { echo "-<br>"; } ?>

                                                        <br><strong>Standar:</strong><br>
                                                        <?php if(!empty($r['standar'])){ foreach($r['standar'] as $s){ ?>
                                                            • <?= html_escape($s['judul_nspk']) ?><br>
                                                        <?php } } else { echo "-<br>"; } ?>

                                                        <br><strong>Prosedur:</strong><br>
                                                        <?php if(!empty($r['prosedur'])){ foreach($r['prosedur'] as $p){ ?>
                                                            • <?= html_escape($p['judul_nspk']) ?><br>
                                                        <?php } } else { echo "-<br>"; } ?>

                                                        <br><strong>Kriteria:</strong><br>
                                                        <?php if(!empty($r['kriteria'])){ foreach($r['kriteria'] as $k){ ?>
                                                            • <?= html_escape($k['judul_nspk']) ?><br>
                                                        <?php } } else { echo "-<br>"; } ?>

                                                        <hr style="margin:10px 0;">

                                                        <strong>Sasaran RPJMD Relevan:</strong><br>
                                                        <?= html_escape($r['sasaran_rpjmd'] ?? '-') ?>
                                                    </div>
                                                </td>

                                                <!-- Tujuan PD -->
                                                <td class="align-middle" <?= $is_new_group ? '' : 'style="display:none;"' ?> rowspan="<?= $is_new_group ? $GroupCounts[$r['header_id']] : 1 ?>">
                                                    <?= html_escape($MapTujuan[$r['tujuan_pd']] ?? '-') ?>
                                                </td>

                                                <!-- Sasaran PD -->
                                                <td style="vertical-align:top;">
                                                    <div style="display:flex; flex-direction:column; height:100%;">
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($IsRole4) { ?>
                                                                <button class="btn btn-sm btn-success TambahDetail" title="Tambah Sasaran PD"
                                                                        data-header-id="<?= $r['header_id'] ?>"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                <?php if (!empty($r['sasaran_pd'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditDetail" title="Edit Sasaran PD"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-sasaran="<?= $r['sasaran_pd'] ?>"
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-danger HapusDetail" title="Hapus Sasaran PD"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                        <div style="flex-grow:1; overflow:auto; padding-left:5px;">
                                                            <?php if (!empty($r['sasaran_pd']) && isset($MapSasaran[$r['sasaran_pd']])) { ?>
                                                                <div>• <?= html_escape($MapSasaran[$r['sasaran_pd']]) ?></div>
                                                            <?php } else { ?>
                                                                <span class="text-muted">— Belum ada sasaran PD —</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>

                                               <!-- Outcome -->
                                                <td style="vertical-align:top;">
                                                    <div style="display:flex; flex-direction:column; height:100%;">
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($IsRole4 && !empty($r['detail_id'])) { ?>
                                                                <!-- Tombol Tambah Outcome (SELALU TAMPIL jika ada detail_id) -->
                                                                <button class="btn btn-sm btn-success TambahKolom" title="Tambah Outcome"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="outcome"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                
                                                                <!-- Tombol Edit Outcome (hanya jika outcome tidak kosong) -->
                                                                <?php if (!empty($r['outcome'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom" title="Edit Outcome"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="outcome"
                                                                            data-raw='<?= html_escape($r["outcome"] ?? '') ?>'
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                        <div style="flex-grow:1; overflow:auto; padding-left:5px;">
                                                            <?php if (!empty($r['outcome'])) {
                                                                $items = array_filter(array_map('trim', explode('|||', $r['outcome'])));
                                                                foreach ($items as $item) {
                                                                    echo '<div>• ' . html_escape($item) . '</div>';
                                                                }
                                                            } else { ?>
                                                                <span class="text-muted">—</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>
 

                                                                                                <!-- Output -->
                                                <td style="vertical-align:top;">
                                                    <div style="display:flex; flex-direction:column; height:100%;">
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($IsRole4 && !empty($r['detail_id'])) { ?>
                                                                <button class="btn btn-sm btn-success TambahKolom" title="Tambah Output"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="output"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                <?php if (!empty($r['output'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom" title="Edit Output"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="output"
                                                                            data-raw='<?= html_escape($r["output"] ?? '') ?>'
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                        <div style="flex-grow:1; overflow:auto; padding-left:5px;">
                                                            <?php if (!empty($r['output'])) {
                                                                $items = array_filter(array_map('trim', explode('|||', $r['output'])));
                                                                foreach ($items as $item) {
                                                                    echo '<div>• ' . html_escape($item) . '</div>';
                                                                }
                                                            } else { ?>
                                                                <span class="text-muted">—</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Indikator -->
                                                <td style="vertical-align:top;">
                                                    <div style="display:flex; flex-direction:column; height:100%;">
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($IsRole4 && !empty($r['detail_id'])) { ?>
                                                                <button class="btn btn-sm btn-success TambahKolom" title="Tambah Indikator"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="indikator"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                <?php if (!empty($r['indikator'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom" title="Edit Indikator"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="indikator"
                                                                            data-raw='<?= html_escape($r["indikator"] ?? '') ?>'
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                        <div style="flex-grow:1; overflow:auto; padding-left:5px;">
                                                            <?php if (!empty($r['indikator'])) {
                                                                $items = array_filter(array_map('trim', explode('|||', $r['indikator'])));
                                                                foreach ($items as $item) {
                                                                    echo '<div>• ' . html_escape($item) . '</div>';
                                                                }
                                                            } else { ?>
                                                                <span class="text-muted">—</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Program/Kegiatan -->
                                                <td style="vertical-align:top;">
                                                    <div style="display:flex; flex-direction:column; height:100%;">
                                                        <?php
                                                        $prog_items = [];
                                                        if (!empty($r['program'])) {
                                                            foreach (explode('|||', $r['program']) as $v) {
                                                                $v = trim($v);
                                                                if ($v) $prog_items[] = "Program: " . $v;
                                                            }
                                                        }
                                                        if (!empty($r['kegiatan'])) {
                                                            foreach (explode('|||', $r['kegiatan']) as $v) {
                                                                $v = trim($v);
                                                                if ($v) $prog_items[] = "Kegiatan: " . $v;
                                                            }
                                                        }
                                                        if (!empty($r['sub_kegiatan'])) {
                                                            foreach (explode('|||', $r['sub_kegiatan']) as $v) {
                                                                $v = trim($v);
                                                                if ($v) $prog_items[] = "Sub Kegiatan: " . $v;
                                                            }
                                                        }
                                                        ?>
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($IsRole4 && !empty($r['detail_id'])) { ?>
                                                                <button class="btn btn-sm btn-success TambahKolom" title="Tambah Program/Kegiatan"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="program_kegiatan"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                <?php if (!empty($prog_items)) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom" title="Edit Program/Kegiatan"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="program_kegiatan"
                                                                            data-program="<?= html_escape($r['program'] ?? '') ?>"
                                                                            data-kegiatan="<?= html_escape($r['kegiatan'] ?? '') ?>"
                                                                            data-sub="<?= html_escape($r['sub_kegiatan'] ?? '') ?>"
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-danger HapusKolom" title="Hapus Program/Kegiatan"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="program_kegiatan"
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                        <div style="flex-grow:1; overflow:auto; padding-left:5px;">
                                                            <?php if (!empty($prog_items)) {
                                                                foreach ($prog_items as $item) {
                                                                    echo '<div>• ' . html_escape($item) . '</div>';
                                                                }
                                                            } else { ?>
                                                                <span class="text-muted">—</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Keterangan -->
                                                <td style="vertical-align:top;">
                                                    <div style="display:flex; flex-direction:column; height:100%;">
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($IsRole4 && !empty($r['detail_id'])) { ?>
                                                                <button class="btn btn-sm btn-success TambahKolom" title="Tambah Keterangan"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="keterangan"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                                <?php if (!empty($r['keterangan'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom" title="Edit Keterangan"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="keterangan"
                                                                            data-raw='<?= html_escape($r["keterangan"] ?? '') ?>'
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                        <div style="flex-grow:1; overflow:auto; padding-left:5px;">
                                                            <?php if (!empty($r['keterangan'])) {
                                                                $items = array_filter(array_map('trim', explode('|||', $r['keterangan'])));
                                                                foreach ($items as $item) {
                                                                    echo '<div>• ' . html_escape($item) . '</div>';
                                                                }
                                                            } else { ?>
                                                                <span class="text-muted">—</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Aksi Header -->
                                                <?php if ($IsRole4) { ?>
                                                    <td class="text-center align-middle">
                                                        <button class="btn btn-sm btn-warning EditHeader" title="Edit Grup"
                                                                data-id="<?= $r['header_id'] ?>"
                                                                data-nspk="<?= $r['tujuansasaran_master_id'] ?>"
                                                                data-tujuan="<?= $r['tujuan_pd'] ?>"
                                                                style="width:30px;height:30px;padding:0;">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger HapusHeader" title="Hapus Grup"
                                                                data-id="<?= $r['header_id'] ?>"
                                                                style="width:30px;height:30px;padding:0;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="<?= $IsRole4 ? '11' : '10' ?>" class="text-center py-5 text-muted">
                                                <i class="fa fa-folder-open fa-3x mb-3 d-block opacity-50"></i>
                                                <div>Belum ada Rumusan Renstra PD untuk wilayah ini.</div>
                                                <small class="d-block mt-2">Silakan tambah grup baru untuk memulai.</small>
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

<!-- ===================================================================== -->
<!--                           SEMUA MODAL                                 -->
<!-- ===================================================================== -->

<!-- Modal Tambah Grup Baru (Header) -->
<div class="modal fade" id="ModalTambahHeader" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-plus-circle"></i> Tambah Grup Renstra PD Baru
                </h5>
            </div>
            <div class="modal-body">
                <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                    <div class="alert alert-info">
                        <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label class="font-weight-bold">NSPK</label>
                    <select id="NSPK" class="form-control" style="white-space: pre-line;" required>
                        <option value="">-- Pilih NSPK --</option>
                        <?php foreach ($ListNSPK as $n) { ?>
                            <option value="<?= $n['id'] ?>">
                                <?= html_escape($n['nama_nspk']) ?>
                                <?php if(!empty($n['sasaran_rpjmd'])){ ?>
                                    - (<?= html_escape($n['sasaran_rpjmd']) ?>)
                                <?php } ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tujuan PD</label>
                    <select id="TujuanPD" class="form-control" required>
                        <option value="">-- Pilih Tujuan PD --</option>
                        <?php foreach ($ListTujuan as $t) { ?>
                            <option value="<?= $t['id'] ?>">
                                <?= html_escape($t['tujuan_pd']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-primary btn-block mt-3" id="BtnSimpanHeader">
                    <i class="fa fa-save"></i> SIMPAN GRUP BARU
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Sasaran PD -->
<div class="modal fade" id="ModalTambahDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-plus-circle"></i> Tambah Sasaran PD
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="TambahHeaderId">
                <div class="form-group">
                    <label class="font-weight-bold">Pilih Sasaran PD</label>
                    <select id="SelectSasaranPD" class="form-control" required>
                        <option value="">-- Pilih satu sasaran --</option>
                        <?php foreach ($ListSasaran as $s) { ?>
                            <option value="<?= $s['id'] ?>">
                                <?= html_escape($s['sasaran_pd']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-success btn-block mt-3" id="BtnSimpanDetail">
                    <i class="fa fa-save"></i> SIMPAN SASARAN
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Sasaran PD -->
<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-edit"></i> Edit Sasaran PD
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditDetailId">
                <div class="form-group">
                    <label class="font-weight-bold">Sasaran PD Baru</label>
                    <select id="EditSelectSasaranPD" class="form-control" required>
                        <option value="">-- Pilih satu sasaran --</option>
                        <?php foreach ($ListSasaran as $s) { ?>
                            <option value="<?= $s['id'] ?>">
                                <?= html_escape($s['sasaran_pd']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-warning btn-block mt-3 text-white" id="BtnSimpanEditDetail">
                    <i class="fa fa-save"></i> UPDATE SASARAN
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Grup Header -->
<div class="modal fade" id="ModalEditHeader" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-edit"></i> Edit Grup Renstra PD
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="EditHeaderId">
                <div class="form-group">
                    <label><b>NSPK</b></label>
                    <select id="EditNSPK" class="form-control">
                        <?php foreach ($ListNSPK as $n) { ?>
                            <option value="<?= $n['id'] ?>">
                                <?= html_escape($n['nama_nspk']) ?>
                                <?php if(!empty($n['sasaran_rpjmd'])){ ?>
                                    - (<?= html_escape($n['sasaran_rpjmd']) ?>)
                                <?php } ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><b>Tujuan PD</b></label>
                    <select id="EditTujuanPD" class="form-control">
                        <?php foreach ($ListTujuan as $t) { ?>
                            <option value="<?= $t['id'] ?>">
                                <?= html_escape($t['tujuan_pd']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-warning btn-block text-white" id="BtnUpdateHeader">
                    <i class="fa fa-save"></i> UPDATE GRUP
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reusable Tambah/Edit Multi-Value -->
<div class="modal fade" id="ModalMultiValue" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" style="top:10%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-list-ul"></i> <span id="ModalMultiTitle">Tambah / Edit Data</span>
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="MultiDetailId">
                <input type="hidden" id="MultiKolom">
                <select id="JenisProgramKegiatan" class="form-control mb-3" style="display:none;">
                    <option value="program">Program</option>
                    <option value="kegiatan">Kegiatan</option>
                    <option value="sub_kegiatan">Sub Kegiatan</option>
                </select>
                <div id="ListMultiItem" class="mb-3"></div>
                <hr>
                <button class="btn btn-success btn-block mt-3" id="BtnSimpanMulti">
                    <i class="fa fa-save"></i> SIMPAN PERUBAHAN
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.btn-remove-multi {
    display: inline-block;
    margin-left: 5px;
}
.multi-card {
    padding: 5px;
    margin-bottom: 10px;
}
.table td div > div {
    margin-bottom: 10px;
    line-height: 1.6;
}
.table td {
    padding-top: 12px !important;
    padding-bottom: 12px !important;
}
.btn-sm {
    margin: 2px;
}
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var MapSasaran = <?= json_encode($MapSasaran ?? []) ?>;
var MapTujuan  = <?= json_encode($MapTujuan ?? []) ?>;
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';
var MultiMode = "append";

$(document).ready(function() {

    // Inisialisasi DataTable
    if ($('#data-table-basic').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-basic')) {
                $('#data-table-basic').DataTable().destroy();
            }
            $('#data-table-basic').DataTable({
                "pageLength": 10,
                "ordering": false,
                "language": {
                    "emptyTable": "Tidak ada data",
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
        } catch(e) { console.log("DataTable error:", e); }
    }

    /* ================= FILTER WILAYAH SEBELUM LOGIN ================= */
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiGroupBefore").hide();
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
                $("#FilterInstansiGroupBefore").hide();
            },
            success: function(Data) {
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
            },
            error: function() { alert("Gagal memuat data Kab/Kota"); }
        });
    });

    $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
            $("#FilterInstansiGroupBefore").hide();
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListInstansiLevel4",
            type: "POST",
            data: { kode_wilayah: kabKotaKode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() {
                $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
                $("#FilterInstansiGroupBefore").show();
            },
            success: function(Data) {
                var options = '<option value="">-- Semua Instansi --</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
                        options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
                    }
                }
                $("#FilterInstansiBeforeLogin").html(options);
                $("#FilterInstansiGroupBefore").show();
            },
            error: function() { alert("Gagal memuat data Instansi"); }
        });
    });

    $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") { alert("Mohon Pilih Provinsi"); return; }
        if ($("#KabKota").val() === "") { alert("Mohon Pilih Kab/Kota"); return; }

        var kodeWilayah = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        $.ajax({
            url: BaseURL + "Instansi/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
            beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
            success: function(res) {
                if (res === '1') {
                    var redirectUrl = BaseURL + "Instansi/RumusanRenstraPD";
                    if (instansiId && instansiId != '') {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() { alert("Gagal menghubungi server!"); }
        });
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
            $("#KabKota").val(kodeKab).trigger('change');
            <?php if (!empty($FilterInstansiId)) { ?>
                setTimeout(function() {
                    if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
                        $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
                    }
                }, 800);
            <?php } ?>
        }, 500);
    <?php } ?>

    <?php } ?>

    /* ================= FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) ================= */
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
        $("#FilterInstansiBtn").click(function() {
            var instansiId = $("#FilterInstansi").val();
            var url = BaseURL + "Instansi/RumusanRenstraPD";
            if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
            window.location.href = url;
        });
        $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/RumusanRenstraPD"; });
    <?php } ?>

    /* ================= CRUD OPERATIONS (HANYA UNTUK ROLE 4) ================= */
    <?php if ($IsRole4) { ?>

    // Tambah Grup Baru (Header)
    $("#BtnSimpanHeader").click(function() {
        var nspk = $("#NSPK").val();
        var tujuan = $("#TujuanPD").val();

        if (!nspk || !tujuan) {
            alert("Mohon lengkapi NSPK dan Tujuan PD");
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/SimpanRumusanRenstraPD",
            type: "POST",
            data: {
                tujuansasaran_master_id: nspk,
                tujuan_pd: tujuan,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal menyimpan grup baru");
                }
            },
            error: function() { alert("Terjadi kesalahan saat menyimpan grup"); }
        });
    });

    // Tambah Sasaran PD Baru (Detail)
    $(document).on("click", ".TambahDetail", function() {
        $("#TambahHeaderId").val($(this).data("header-id"));
        $("#SelectSasaranPD").val("").trigger('change');
        $("#ModalTambahDetail").modal("show");
    });

    $("#BtnSimpanDetail").click(function() {
        var header_id = $("#TambahHeaderId").val();
        var sasaran = $("#SelectSasaranPD").val();

        if (!sasaran) {
            alert("Pilih satu sasaran PD terlebih dahulu");
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/TambahDetail",
            type: "POST",
            data: {
                header_id: header_id,
                sasaran_pd: sasaran,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal menambah sasaran PD");
                }
            },
            error: function() { alert("Error saat menambah sasaran"); }
        });
    });

    // Edit Sasaran PD
    $(document).on("click", ".EditDetail", function() {
        $("#EditDetailId").val($(this).data("id"));
        $("#EditSelectSasaranPD").val($(this).data("sasaran")).trigger('change');
        $("#ModalEditDetail").modal("show");
    });

    $("#BtnSimpanEditDetail").click(function() {
        var id = $("#EditDetailId").val();
        var sasaran = $("#EditSelectSasaranPD").val();

        if (!sasaran) {
            alert("Pilih satu sasaran PD");
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/UpdateDetail",
            type: "POST",
            data: {
                id: id,
                sasaran_pd: sasaran,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal mengubah sasaran PD");
                }
            },
            error: function() { alert("Error saat update sasaran"); }
        });
    });

    // Edit Header
    $(document).on("click", ".EditHeader", function() {
        $("#EditHeaderId").val($(this).data("id"));
        $("#EditNSPK").val($(this).data("nspk"));
        $("#EditTujuanPD").val($(this).data("tujuan"));
        $("#ModalEditHeader").modal("show");
    });

    $("#BtnUpdateHeader").click(function() {
        var id = $("#EditHeaderId").val();
        var nspk = $("#EditNSPK").val();
        var tujuan = $("#EditTujuanPD").val();

        $.ajax({
            url: BaseURL + "Instansi/UpdateHeaderRenstra",
            type: "POST",
            data: {
                id: id,
                tujuansasaran_master_id: nspk,
                tujuan_pd: tujuan,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert("Gagal update header!");
                }
            },
            error: function() { alert("Error update header"); }
        });
    });

    // Hapus Header
    $(document).on("click", ".HapusHeader", function() {
        if (!confirm("Yakin ingin menghapus grup ini beserta semua detailnya?")) return;
        var id = $(this).data("id");

        $.ajax({
            url: BaseURL + "Instansi/HapusHeader",
            type: "POST",
            data: {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert("Gagal menghapus grup!");
                }
            },
            error: function() { alert("Error hapus grup"); }
        });
    });

    // Hapus Detail (Sasaran PD)
    $(document).on("click", ".HapusDetail", function() {
        if (!confirm("Yakin ingin menghapus sasaran PD ini beserta semua datanya?")) return;
        var id = $(this).data("id");

        $.ajax({
            url: BaseURL + "Instansi/HapusDetail",
            type: "POST",
            data: {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === "success") {
                    location.reload();
                } else {
                    alert(res.message || "Gagal menghapus sasaran PD");
                }
            },
            error: function() { alert("Error hapus sasaran"); }
        });
    });

   // Tambah / Edit Kolom Multi-Value
$(document).on("click", ".TambahKolom, .EditKolom", function(e) {
    e.preventDefault();
    
    var $this = $(this);
    var isEdit = $this.hasClass("EditKolom");
    var kolom = $this.data("kolom");
    var detailId = $this.data("id");
    
    // DEBUG: Log untuk melihat data
    console.log("Tombol diklik:", this);
    console.log("data-kolom:", kolom);
    console.log("data-id (raw):", detailId);
    
    // VALIDASI: Pastikan kolom tidak undefined
    if (!kolom) {
        console.error("ERROR: kolom undefined - periksa atribut data-kolom pada tombol");
        alert("Terjadi kesalahan: data kolom tidak ditemukan. Silakan refresh halaman.");
        return;
    }
    
    // VALIDASI: Jika detailId kosong atau 0
    if (!detailId || detailId == 0 || detailId === "") {
        console.warn("Warning: detailId kosong, mencoba mencari alternatif");
        
        // Coba ambil dari attribute data-detail-id
        detailId = $this.data("detail-id");
        
        // Jika masih kosong, coba dari parent row
        if (!detailId || detailId == 0) {
            var parentRow = $this.closest("tr");
            detailId = parentRow.data("detail-id");
        }
        
        console.log("data-id (after fallback):", detailId);
    }
    
    // VALIDASI: Jika masih kosong, tampilkan error
    if (!detailId || detailId == 0 || detailId === "") {
        console.error("ERROR: detailId masih kosong setelah fallback");
        alert("Terjadi kesalahan: ID detail tidak ditemukan. Silakan tambah sasaran PD terlebih dahulu.");
        return;
    }
    
    MultiMode = isEdit ? "replace" : "append";
    
    $("#MultiDetailId").val(detailId);
    $("#MultiKolom").val(kolom);
    $("#ListMultiItem").empty();
    
    // Set judul modal dengan aman
    var kolomName = String(kolom).toUpperCase();
    $("#ModalMultiTitle").text((isEdit ? "Edit " : "Tambah ") + kolomName);
    
    if (kolom === "program_kegiatan") {
        function addProgramItem(type, value) {
            $("#ListMultiItem").append(`
                <div class="multi-card">
                    <select class="form-control multi-type mb-2">
                        <option value="program" ${type=="program"?"selected":""}>Program</option>
                        <option value="kegiatan" ${type=="kegiatan"?"selected":""}>Kegiatan</option>
                        <option value="sub_kegiatan" ${type=="sub_kegiatan"?"selected":""}>Sub Kegiatan</option>
                    </select>
                    <textarea class="form-control multi-item" rows="3">${value || ''}</textarea>
                    <div class="mt-2">
                        <button class="btn btn-success btn-sm btn-add-after" type="button">Tambah</button>
                        <button class="btn btn-danger btn-sm btn-remove-multi" type="button">Hapus</button>
                    </div>
                </div>
            `);
        }
        
        if (isEdit) {
            let prog = ($this.data("program") || "").toString().split("|||");
            let keg = ($this.data("kegiatan") || "").toString().split("|||");
            let sub = ($this.data("sub") || "").toString().split("|||");
            prog.forEach(v => { if(v && v.trim()) addProgramItem("program", v.trim()); });
            keg.forEach(v => { if(v && v.trim()) addProgramItem("kegiatan", v.trim()); });
            sub.forEach(v => { if(v && v.trim()) addProgramItem("sub_kegiatan", v.trim()); });
        } else {
            addProgramItem("program", "");
        }
        
        // Jika tidak ada item, tambahkan satu baris kosong
        if ($("#ListMultiItem .multi-card").length === 0) {
            addProgramItem("program", "");
        }
        
        $("#ModalMultiValue").modal("show");
        return;
    }
    
    // Kolom biasa (outcome, output, indikator, keterangan)
    var nilai = "";
    if (isEdit) {
        var raw = $this.attr("data-raw");
        if (raw && raw !== "undefined" && raw !== "null") {
            try {
                nilai = JSON.parse(raw) || "";
            } catch(e) {
                nilai = raw || "";
            }
        }
    }
    
    nilai = String(nilai);
    var arr = nilai ? nilai.split("|||") : [];
    
    function appendSimple(value) {
        $("#ListMultiItem").append(`
            <div class="multi-card">
                <textarea class="form-control multi-item" rows="3">${value || ''}</textarea>
                <div class="mt-2">
                    <button class="btn btn-success btn-sm btn-add-after" type="button">Tambah</button>
                    <button class="btn btn-danger btn-sm btn-remove-multi" type="button">Hapus</button>
                </div>
            </div>
        `);
    }
    
    if (arr.length > 0) {
        arr.forEach(v => { if(v && v.trim()) appendSimple(v.trim()); });
    }
    
    if (!isEdit || arr.length === 0) {
        appendSimple("");
    }
    
    // Jika masih tidak ada item, tambahkan satu baris kosong
    if ($("#ListMultiItem .multi-card").length === 0) {
        appendSimple("");
    }
    
    $("#ModalMultiValue").modal("show");
});

// Tambah item multi
$(document).on("click", ".btn-add-after", function(e) {
    e.preventDefault();
    var kolom = $("#MultiKolom").val();
    var card = $(this).closest(".multi-card");

    if (kolom === "program_kegiatan") {
        var newItem = `
            <div class="multi-card">
                <select class="form-control multi-type mb-2">
                    <option value="program">Program</option>
                    <option value="kegiatan">Kegiatan</option>
                    <option value="sub_kegiatan">Sub Kegiatan</option>
                </select>
                <textarea class="form-control multi-item" rows="3"></textarea>
                <div class="mt-2">
                    <button class="btn btn-success btn-sm btn-add-after" type="button">Tambah</button>
                    <button class="btn btn-danger btn-sm btn-remove-multi" type="button">Hapus</button>
                </div>
            </div>
        `;
        card.after(newItem);
    } else {
        var newItem = `
            <div class="multi-card">
                <textarea class="form-control multi-item" rows="3"></textarea>
                <div class="mt-2">
                    <button class="btn btn-success btn-sm btn-add-after" type="button">Tambah</button>
                    <button class="btn btn-danger btn-sm btn-remove-multi" type="button">Hapus</button>
                </div>
            </div>
        `;
        card.after(newItem);
    }
});

// Hapus item multi
$(document).on("click", ".btn-remove-multi", function() {
    $(this).closest(".multi-card").remove();
});

// Simpan multi-value
$("#BtnSimpanMulti").click(function() {
    var id = $("#MultiDetailId").val();
    var kolom = $("#MultiKolom").val();

    if (kolom === "program_kegiatan") {
        var programArr = [], kegiatanArr = [], subArr = [];
        $("#ListMultiItem .multi-card").each(function() {
            var type = $(this).find(".multi-type").val();
            var val = $(this).find(".multi-item").val().trim();
            if (!val) return;
            if (type === "program") programArr.push(val);
            if (type === "kegiatan") kegiatanArr.push(val);
            if (type === "sub_kegiatan") subArr.push(val);
        });
        var requests = [];
        if (programArr.length > 0) {
            requests.push($.post(BaseURL + "Instansi/UpdateKolomDetail", {
                id: id, kolom: "program", nilai: programArr.join("|||"), mode: MultiMode, [CSRF_NAME]: CSRF_TOKEN
            }));
        }
        if (kegiatanArr.length > 0) {
            requests.push($.post(BaseURL + "Instansi/UpdateKolomDetail", {
                id: id, kolom: "kegiatan", nilai: kegiatanArr.join("|||"), mode: MultiMode, [CSRF_NAME]: CSRF_TOKEN
            }));
        }
        if (subArr.length > 0) {
            requests.push($.post(BaseURL + "Instansi/UpdateKolomDetail", {
                id: id, kolom: "sub_kegiatan", nilai: subArr.join("|||"), mode: MultiMode, [CSRF_NAME]: CSRF_TOKEN
            }));
        }
        $.when.apply($, requests).done(function() { location.reload(); });
        return;
    }

    // Kolom biasa
    var items = [];
    $("#ListMultiItem .multi-item").each(function() {
        var val = $(this).val().trim();
        if (val) items.push(val);
    });
    $.post(BaseURL + "Instansi/UpdateKolomDetail", {
        id: id, kolom: kolom, nilai: items.join("|||"), mode: MultiMode, [CSRF_NAME]: CSRF_TOKEN
    }, function() { location.reload(); });
});

<?php } ?>
});
</script>
</body>
</html>