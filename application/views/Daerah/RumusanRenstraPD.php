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
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <!-- TOMBOL TAMBAH GRUP -->
                         <div class="basic-tb-hd">
                        <?php if ($this->session->userdata('Level') == 3) { ?>
                            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#ModalTambahHeader">
                                <i class="fa fa-plus"></i> Tambah Grup Renstra PD
                            </button>
                        <?php } ?>
                            </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-hover table-bordered">
                                <thead >
                                    <tr>
                                        <th class="text-center" style="width:60px;">No</th>
                                        <th>NSPK dan Sasaran RPJMD yang Relevan</th>
                                        <th>Tujuan PD</th>
                                        <th>Sasaran PD</th>
                                        <th>Outcome</th>
                                        <th>Output</th>
                                        <th>Indikator</th>
                                        <th>Program/Kegiatan</th>
                                        <th>Keterangan</th>
                                        <?php if ($this->session->userdata('Level') == 3) { ?>
                                            <th class="text-center" style="width:160px;">Aksi</th>
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

                                                        <!-- Tombol -->
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($this->session->userdata('Level') == 3) { ?>

                                                                <button class="btn btn-sm btn-success TambahDetail"
                                                                        data-header-id="<?= $r['header_id'] ?>"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>

                                                                <?php if (!empty($r['sasaran_pd'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditDetail"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-sasaran="<?= $r['sasaran_pd'] ?>"
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-sm btn-danger HapusDetail"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="notika-icon notika-trash"></i>
                                                                    </button>
                                                                <?php } ?>

                                                            <?php } ?>
                                                        </div>

                                                        <!-- Isi -->
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
                                                            <?php if ($this->session->userdata('Level') == 3) { ?>

                                                                <button class="btn btn-sm btn-success TambahKolom"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="outcome"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>

                                                                <?php if (!empty($r['outcome'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="outcome"
                                                                            data-raw='<?= html_escape($r["outcome"]) ?>'
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
                                                            <?php if ($this->session->userdata('Level') == 3) { ?>

                                                                <button class="btn btn-sm btn-success TambahKolom"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="output"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>

                                                                <?php if (!empty($r['output'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="output"
                                                                            data-raw='<?= html_escape($r["output"]) ?>'
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
                                                            <?php if ($this->session->userdata('Level') == 3) { ?>

                                                                <button class="btn btn-sm btn-success TambahKolom"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="indikator"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>

                                                                <?php if (!empty($r['indikator'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="indikator"
                                                                            data-raw='<?= html_escape($r["indikator"]) ?>'
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
                                                        $items = [];
                                                        $rawValues = [];

                                                        if (!empty($r['program'])) {
                                                            foreach (explode('|||', $r['program']) as $v) {
                                                                $v = trim($v);
                                                                if ($v) {
                                                                    $items[] = "Program: " . $v;
                                                                    $rawValues[] = $v;
                                                                }
                                                            }
                                                        }

                                                        if (!empty($r['kegiatan'])) {
                                                            foreach (explode('|||', $r['kegiatan']) as $v) {
                                                                $v = trim($v);
                                                                if ($v) {
                                                                    $items[] = "Kegiatan: " . $v;
                                                                    $rawValues[] = $v;
                                                                }
                                                            }
                                                        }

                                                        if (!empty($r['sub_kegiatan'])) {
                                                            foreach (explode('|||', $r['sub_kegiatan']) as $v) {
                                                                $v = trim($v);
                                                                if ($v) {
                                                                    $items[] = "Sub Kegiatan: " . $v;
                                                                    $rawValues[] = $v;
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                        <!-- Tombol -->
                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($this->session->userdata('Level') == 3) { ?>

                                                                <!-- Tambah -->
                                                                <button class="btn btn-sm btn-success TambahKolom"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="program_kegiatan"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>

                                                                <?php if (!empty($items)) { ?>

                                                                    <!-- Edit -->
                                                                    <button class="btn btn-sm btn-primary EditKolom"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="program_kegiatan"
                                                                            data-program="<?= html_escape($r['program'] ?? '') ?>"
                                                                            data-kegiatan="<?= html_escape($r['kegiatan'] ?? '') ?>"
                                                                            data-sub="<?= html_escape($r['sub_kegiatan'] ?? '') ?>"

                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>

                                                                    <!-- Hapus -->
                                                                    <button class="btn btn-sm btn-danger HapusKolom"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="program_kegiatan"
                                                                            style="width:30px;height:30px;padding:0;">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>

                                                                <?php } ?>

                                                            <?php } ?>
                                                        </div>

                                                        <!-- Isi -->
                                                        <div style="flex-grow:1; overflow:auto; padding-left:5px;">
                                                            <?php
                                                            if (!empty($items)) {
                                                                foreach ($items as $item) {
                                                                    echo '<div>• ' . html_escape($item) . '</div>';
                                                                }
                                                            } else {
                                                                echo '<span class="text-muted">—</span>';
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>
                                                </td>


                                                <!-- Keterangan -->
                                                <td style="vertical-align:top;">
                                                    <div style="display:flex; flex-direction:column; height:100%;">

                                                        <div style="display:flex; justify-content:center; gap:5px; margin-bottom:5px;">
                                                            <?php if ($this->session->userdata('Level') == 3) { ?>

                                                                <button class="btn btn-sm btn-success TambahKolom"
                                                                        data-id="<?= $r['detail_id'] ?>"
                                                                        data-kolom="keterangan"
                                                                        style="width:30px;height:30px;padding:0;">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>

                                                                <?php if (!empty($r['keterangan'])) { ?>
                                                                    <button class="btn btn-sm btn-primary EditKolom"
                                                                            data-id="<?= $r['detail_id'] ?>"
                                                                            data-kolom="keterangan"
                                                                            data-raw='<?= html_escape($r["keterangan"]) ?>'
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


                                                 <!-- Aksi -->
                                                <!-- Aksi Grup Header -->
                                                    <?php if ($this->session->userdata('Level') == 3) { ?>
                                                    <td class="text-center align-middle">

                                                        <!-- Edit Header -->
                                                        <button class="btn btn-sm btn-warning EditHeader"
                                                                data-id="<?= $r['header_id'] ?>"
                                                                data-nspk="<?= $r['tujuansasaran_master_id'] ?>"
                                                                data-tujuan="<?= $r['tujuan_pd'] ?>"
                                                                style="width:30px;height:30px;padding:0;">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <!-- Hapus Header -->
                                                        <button class="btn btn-sm btn-danger HapusHeader"
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
                                            <td colspan="11" class="text-center py-5 text-muted">
                                                <i class="fa fa-folder-open fa-3x mb-3 d-block opacity-50"></i>
                                                <div>Belum ada data Rumusan Renstra PD untuk wilayah ini.</div>
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
<div class="modal fade" id="ModalTambahHeader" tabindex="-1" role="dialog" aria-labelledby="modalTambahHeaderLabel">
    <div class="modal-dialog modal-lg" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header ">
                 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h5 class="modal-title" id="modalTambahHeaderLabel">
                    <i class="fa fa-plus-circle"></i> Tambah Grup Renstra PD Baru
                </h5>
            </div>
            <div class="modal-body">
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
<div class="modal fade" id="ModalTambahDetail" tabindex="-1" role="dialog" aria-labelledby="modalTambahDetailLabel">
    <div class="modal-dialog modal-dialog-centered modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="modalTambahDetailLabel">
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
<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="modalEditDetailLabel">
    <div class="modal-dialog modal-dialog-centered modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="modalEditDetailLabel">
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
<div class="modal fade" id="ModalEditHeader" tabindex="-1"role="dialog" aria-labelledby="modalEditDetailLabel">
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
<div class="modal fade" id="ModalMultiValue" tabindex="-1" role="dialog" aria-labelledby="modalMultiValueLabel">
    <div class="modal-dialog modal-xl" style="top:10%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMultiValueLabel">
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

<!-- Styling -->
<style>
.btn-remove-multi {
    display: inline-block;
    margin-left: 5px;
}

.multi-card {
    padding: 5px;
    margin-bottom: 10px;
}

/* Spacing antar item bullet */
.table td div > div {
    margin-bottom: 10px;
    line-height: 1.6;
}

/* Optional: beri jarak lebih besar antar blok kolom */
.table td {
    padding-top: 12px !important;
    padding-bottom: 12px !important;
}


 </style>   

<!-- Script Lengkap -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var MapSasaran = <?= json_encode($MapSasaran ?? []) ?>;
var MapTujuan  = <?= json_encode($MapTujuan ?? []) ?>;
// ================= MODE SIMPAN =================
var MultiMode = "append";


$(document).ready(function() {
    /* ================= FILTER ================= */
$("#Provinsi").change(function() {
        if ($(this).val() === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
          return;
        }

        $.ajax({
          url: BaseURL + "Daerah/GetListKabKota",
          type: "POST",
          data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { $("#KabKota").prop('disabled', true); },
          success: function(res) {
            var Data = (typeof res === 'string') ? JSON.parse(res) : res;
            var KabKota = '<option value="">Pilih Kab/Kota</option>';

            if (Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
              }
            } else {
              alert("Belum Ada Data Kab/Kota");
            }

            $("#KabKota").html(KabKota).prop('disabled', false);
          },
          error: function() {
            alert("Gagal memuat data Kab/Kota");
            $("#KabKota").prop('disabled', false);
          }
        });
      });

      $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") return alert("Mohon Pilih Provinsi");
        if ($("#KabKota").val() === "") return alert("Mohon Pilih Kab/Kota");

        var kodeWilayah = $("#KabKota").val();

        $.ajax({
          url: BaseURL + "Daerah/SetTempKodeWilayah",
          type: "POST",
          data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
          beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
          success: function(res) {
            if (res === '1') {
              window.location.reload();
            } else {
              alert(res || "Gagal menyimpan filter wilayah!");
              $("#Filter").prop('disabled', false).text('Filter');
            }
          },
          error: function() {
            alert("Gagal menghubungi server!");
            $("#Filter").prop('disabled', false).text('Filter');
          }
        });
      });

      // Populate kab/kota on page load jika KodeWilayah sudah ada
      <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv);

        $.ajax({
          url: BaseURL + "Daerah/GetListKabKota",
          type: "POST",
          data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
          success: function(res) {
            var Data = (typeof res === 'string') ? JSON.parse(res) : res;
            var KabKota = '<option value="">Pilih Kab/Kota</option>';

            if (Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
              }
            }
            $("#KabKota").html(KabKota);
          }
        });
      <?php } ?>

    // Tambah Grup Baru (Header)
    $("#BtnSimpanHeader").click(function() {
        var nspk = $("#NSPK").val();
        var tujuan = $("#TujuanPD").val();

        if (!nspk || !tujuan) {
            alert("Mohon lengkapi NSPK dan Tujuan PD");
            return;
        }

        $.post(BaseURL + "Daerah/SimpanRumusanRenstraPD", {
            tujuansasaran_master_id: nspk,
            tujuan_pd: tujuan,
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data.status === "success") {
                    location.reload();
                } else {
                    alert(data.message || "Gagal menyimpan grup baru");
                }
            } catch (e) {
                alert("Terjadi kesalahan saat menyimpan grup");
            }
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

        $.post(BaseURL + "Daerah/TambahDetail", {
            header_id: header_id,
            sasaran_pd: sasaran,
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data.status === "success") {
                    location.reload();
                } else {
                    alert(data.message || "Gagal menambah sasaran PD");
                }
            } catch (e) {
                alert("Error saat menambah sasaran");
            }
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

        $.post(BaseURL + "Daerah/UpdateDetail", {
            id: id,
            sasaran_pd: sasaran,
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data.status === "success") {
                    location.reload();
                } else {
                    alert(data.message || "Gagal mengubah sasaran PD");
                }
            } catch (e) {
                alert("Error saat update sasaran");
            }
        });
    });

    // Hapus Kolom Multi (Outcome, Output, Program dll)
$(document).on("click", ".HapusKolom", function() {

    if (!confirm("Yakin ingin menghapus semua data pada kolom ini?")) return;

    var id = $(this).data("id");
    var kolom = $(this).data("kolom");

    if (kolom === "program_kegiatan") {
        // kosongkan semua jenis
        $.post(BaseURL + "Daerah/UpdateKolomDetail", {
            id: id,
            kolom: "program",
            nilai: "",
            [CSRF_NAME]: CSRF_TOKEN
        });

        $.post(BaseURL + "Daerah/UpdateKolomDetail", {
            id: id,
            kolom: "kegiatan",
            nilai: "",
            [CSRF_NAME]: CSRF_TOKEN
        });

        $.post(BaseURL + "Daerah/UpdateKolomDetail", {
            id: id,
            kolom: "sub_kegiatan",
            nilai: "",
            [CSRF_NAME]: CSRF_TOKEN
        }, function() {
            location.reload();
        });

    } else {
$.post(BaseURL + "Daerah/UpdateKolomDetail", {
    id: id,
    kolom: kolom,
    nilai: items.join(""),
    mode: MultiMode,            [CSRF_NAME]: CSRF_TOKEN
        }, function() {
            location.reload();
        });

    }

});

    // Hapus Sasaran PD (Detail)
    $(document).on("click", ".HapusDetail", function() {
        if (!confirm("Yakin ingin menghapus sasaran PD ini beserta semua datanya?")) return;

        var id = $(this).data("id");

        $.post(BaseURL + "Daerah/HapusDetail", {
            id: id,
            [CSRF_NAME]: CSRF_TOKEN
        }, function(res) {
            try {
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data.status === "success") {
                    location.reload();
                } else {
                    alert(data.message || "Gagal menghapus sasaran PD");
                }
            } catch (e) {
                alert("Error saat menghapus");
            }
        });
    });

    // Tambah / Edit Kolom Multi-Value (Outcome, Output, dll)
$(document).on("click", ".TambahKolom, .EditKolom", function() {

    var isEdit   = $(this).hasClass("EditKolom");
    MultiMode = isEdit ? "replace" : "append";
    var kolom    = $(this).data("kolom");
    var detailId = $(this).data("id");

    $("#MultiDetailId").val(detailId);
    $("#MultiKolom").val(kolom);
    $("#ListMultiItem").empty();

    $("#ModalMultiTitle").text(
        (isEdit ? "Edit " : "Tambah ") + kolom.toUpperCase()
    );

    if (kolom === "program_kegiatan") {

    function addProgramItem(type, value) {
        $("#ListMultiItem").append(`
            <div class="multi-card">
                <select class="form-control multi-type mb-2">
                    <option value="program" ${type=="program"?"selected":""}>Program</option>
                    <option value="kegiatan" ${type=="kegiatan"?"selected":""}>Kegiatan</option>
                    <option value="sub_kegiatan" ${type=="sub_kegiatan"?"selected":""}>Sub Kegiatan</option>
                </select>

                <textarea class="form-control multi-item" rows="3">${value}</textarea>

                <div class="mt-2">
                    <button class="btn btn-success btn-sm btn-add-after" type="button">Tambah</button>
                    <button class="btn btn-danger btn-sm btn-remove-multi" type="button">Hapus</button>
                </div>
            </div>
        `);
    }

    if (isEdit) {

        let prog = ($(this).data("program") || "").split("|||");
        let keg  = ($(this).data("kegiatan") || "").split("|||");
        let sub  = ($(this).data("sub") || "").split("|||");

        prog.forEach(v => { if(v.trim()) addProgramItem("program", v.trim()); });
        keg.forEach(v => { if(v.trim()) addProgramItem("kegiatan", v.trim()); });
        sub.forEach(v => { if(v.trim()) addProgramItem("sub_kegiatan", v.trim()); });

    } else {
        addProgramItem("program", "");
    }

    $("#ModalMultiValue").modal("show");
    return; // IMPORTANT → stop lanjut ke kode kolom biasa
}


    // ==== KOLOM BIASA ====
    var nilai = "";

    if (isEdit) {
        var raw = $(this).attr("data-raw");

        if (raw) {
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
                <textarea class="form-control multi-item" rows="3">${value}</textarea>
                <div class="mt-2">
                    <button class="btn btn-success btn-sm btn-add-after" type="button">Tambah</button>
                    <button class="btn btn-danger btn-sm btn-remove-multi" type="button">Hapus</button>
                </div>
            </div>
        `);
    }
    

    if (arr.length > 0) {
    arr.forEach(v => appendSimple(v.trim()));
}

// kalau klik Tambah → tambahkan 1 field kosong di bawah
if (!isEdit) {
    appendSimple("");
}

    $("#ModalMultiValue").modal("show");

});


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

        // Untuk Outcome, Output, Indikator, Keterangan
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




    // Hapus item multi-value
    $(document).on("click", ".btn-remove-multi", function() {
    $(this).closest(".multi-card").remove();
});


    // Simpan multi-value
   $("#BtnSimpanMulti").click(function () {

    var id = $("#MultiDetailId").val();
    var kolom = $("#MultiKolom").val();

    if (kolom === "program_kegiatan") {

    var programArr = [];
    var kegiatanArr = [];
    var subArr = [];

    $("#ListMultiItem .multi-card").each(function () {

        var type = $(this).find(".multi-type").val();
        var val  = $(this).find(".multi-item").val().trim();

        if (!val) return;

        if (type === "program") programArr.push(val);
        if (type === "kegiatan") kegiatanArr.push(val);
        if (type === "sub_kegiatan") subArr.push(val);
    });

    // kumpulkan request
    var requests = [];

    if (programArr.length > 0) {
        requests.push(
            $.post(BaseURL + "Daerah/UpdateKolomDetail", {
                id: id,
                kolom: "program",
                nilai: programArr.join("|||"),
                mode: MultiMode,
                [CSRF_NAME]: CSRF_TOKEN
            })
        );
    }

    if (kegiatanArr.length > 0) {
        requests.push(
            $.post(BaseURL + "Daerah/UpdateKolomDetail", {
                id: id,
                kolom: "kegiatan",
                nilai: kegiatanArr.join("|||"),
                mode: MultiMode,
                [CSRF_NAME]: CSRF_TOKEN
            })
        );
    }

    if (subArr.length > 0) {
        requests.push(
            $.post(BaseURL + "Daerah/UpdateKolomDetail", {
                id: id,
                kolom: "sub_kegiatan",
                nilai: subArr.join("|||"),
                mode: MultiMode,
                [CSRF_NAME]: CSRF_TOKEN
            })
        );
    }

    // ✅ reload setelah semua selesai
    $.when.apply($, requests).done(function () {
        location.reload();
    });

    return;
}


    // ================= KOLOM BIASA =================

    var items = [];

    $("#ListMultiItem .multi-item").each(function () {
        var val = $(this).val().trim();
        if (val) items.push(val);
    });

    $.post(BaseURL + "Daerah/UpdateKolomDetail", {
        id: id,
        kolom: kolom,
        nilai: items.join("|||"),
        mode: MultiMode,        [CSRF_NAME]: CSRF_TOKEN
    }, function () {
        location.reload();
    });

});

$(document).on("click", ".EditHeader", function () {

    $("#EditHeaderId").val($(this).data("id"));
    $("#EditNSPK").val($(this).data("nspk"));
    $("#EditTujuanPD").val($(this).data("tujuan"));

    $("#ModalEditHeader").modal("show");
});

$("#BtnUpdateHeader").click(function () {

    var id     = $("#EditHeaderId").val();
    var nspk   = $("#EditNSPK").val();
    var tujuan = $("#EditTujuanPD").val();

    $.post(BaseURL + "Daerah/UpdateHeaderRenstra", {
        id: id,
        tujuansasaran_master_id: nspk,
        tujuan_pd: tujuan,
        [CSRF_NAME]: CSRF_TOKEN
    }, function (res) {

        var data = typeof res === "string" ? JSON.parse(res) : res;

        if (data.status === "success") {
            location.reload();
        } else {
            alert("Gagal update header!");
        }
    });
});


});

</script>