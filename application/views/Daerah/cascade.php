<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <!-- Filter untuk pengguna yang belum login -->
                            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                                <div class="form-example-wrap" style="margin-bottom: 20px;">
                                    <div class="form-example-int form-horizental">
                                        <div class="form-group">
                                            <div class="row filter-row">
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="filter-group">
                                                        <label for="Provinsi"><b>Provinsi</b></label>
                                                        <select class="form-control filter-select" id="Provinsi">
                                                            <option value="">Pilih Provinsi</option>
                                                            <?php foreach ($Provinsi as $prov) { ?>
                                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                                    <?= html_escape($prov['Nama']) ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="filter-group">
                                                        <label for="KabKota"><b>Kab/Kota</b></label>
                                                        <select class="form-control filter-select" id="KabKota">
                                                            <option value="">Pilih Kab/Kota</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-6">
                                                    <div class="filter-group" style="margin-top: 28px;">
                                                        <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
                                                            <b>Filter</b>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menampilkan Wilayah dan Pesan Error setelah filter -->
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <?php 
                                        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                        $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                        if (empty($CascadeData)) {
                                            $pesan_error = "Tidak ada data cascade untuk wilayah: $nama_wilayah";
                                        }
                                    ?>
                                    <div class="alert <?= empty($CascadeData) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                        <?php if (!empty($pesan_error)) { ?>
                                            <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambahCascade">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Cascade</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">Misi</th>
                                        <th width="12%" class="text-center">Tujuan</th>
                                        <th width="12%" class="text-center">Sasaran</th>
                                        <th width="15%">IKU/IKD</th>
                                        <th width="10%" class="text-center">Periode</th>
                                        <th width="12%" class="text-center">PD Penanggung Jawab</th>
                                        <th width="12%" class="text-center">PD Penunjang</th>
                                        <th width="6%" class="text-center">Target <br><small>Tahun 1</small></th>
                                        <th width="6%" class="text-center">Target <br><small>Tahun 2</small></th>
                                        <th width="6%" class="text-center">Target <br><small>Tahun 3</small></th>
                                        <th width="6%" class="text-center">Target <br><small>Tahun 4</small></th>
                                        <th width="6%" class="text-center">Target <br><small>Tahun 5</small></th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th width="10%" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($CascadeData as $key) { ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: top;"><?= $No++ ?></td>
                                        <td style="vertical-align: top;">
                                            <?php
                                            $misi = $this->db->where('Id', $key['IdMisi'])->get('misirpjmd')->row_array();
                                            echo $misi ? html_escape($misi['Misi']) : '-';
                                            ?>
                                        </td>
                                        <!-- Kolom Tujuan -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <button class="btn btn-sm btn-success TambahTujuanCascade" 
                                                                title="Tambah Tujuan"
                                                                data-id="<?= $key['id'] ?>"
                                                                data-misi="<?= $key['IdMisi'] ?>"
                                                                style="width: 30px; height: 30px; padding: 0;">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <?php if (!empty($key['tujuan_ids'])): ?>
                                                            <button class="btn btn-sm btn-primary EditTujuanCascade" 
                                                                    title="Edit Tujuan"
                                                                    data-tujuan="<?= $key['id'].'|'.html_escape($key['tujuan_ids']) ?>"
                                                                    data-misi="<?= $key['IdMisi'] ?>"
                                                                    style="width: 30px; height: 30px; padding: 0;">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['tujuan_ids'])): ?>
                                                        <?php 
                                                        $tujuanIds = explode(',', $key['tujuan_ids']);
                                                        foreach ($tujuanIds as $tujuanId): 
                                                            $tujuan = $this->db->where('Id', $tujuanId)->get('tujuanrpjmd')->row_array();
                                                            if ($tujuan):
                                                        ?>
                                                            <div style="padding: 2px 0; white-space: nowrap;"><?= html_escape($tujuan['Tujuan']) ?></div>
                                                        <?php 
                                                            endif;
                                                        endforeach; 
                                                        ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Kolom Sasaran -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <button class="btn btn-sm btn-success TambahSasaranCascade" 
                                                                title="Tambah Sasaran"
                                                                data-id="<?= $key['id'] ?>"
                                                                data-tujuan="<?= !empty($key['tujuan_ids']) ? explode(',', $key['tujuan_ids'])[0] : '' ?>"
                                                                style="width: 30px; height: 30px; padding: 0;">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <?php if (!empty($key['sasaran_ids'])): ?>
                                                            <button class="btn btn-sm btn-primary EditSasaranCascade" 
                                                                    title="Edit Sasaran"
                                                                    data-sasaran="<?= $key['id'].'|'.html_escape($key['sasaran_ids']) ?>"
                                                                    data-tujuan="<?= !empty($key['tujuan_ids']) ? explode(',', $key['tujuan_ids'])[0] : '' ?>"
                                                                    style="width: 30px; height: 30px; padding: 0;">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['sasaran_ids'])): ?>
                                                        <?php 
                                                        $sasaranIds = explode(',', $key['sasaran_ids']);
                                                        foreach ($sasaranIds as $sasaranId): 
                                                            $sasaran = $this->db->where('Id', $sasaranId)->get('sasaranrpjmd')->row_array();
                                                            if ($sasaran):
                                                        ?>
                                                            <div style="padding: 2px 0; white-space: nowrap;"><?= html_escape($sasaran['Sasaran']) ?></div>
                                                        <?php 
                                                            endif;
                                                        endforeach; 
                                                        ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Kolom IKU/IKD - Dimodifikasi seperti Tujuan/Sasaran -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <button class="btn btn-sm btn-success TambahIndikatorCascade" 
                                                                title="Tambah Indikator"
                                                                data-id="<?= $key['id'] ?>"
                                                                style="width: 30px; height: 30px; padding: 0;">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <?php if (!empty($key['indikator'])): ?>
                                                            <button class="btn btn-sm btn-primary EditIndikatorCascade" 
                                                                    title="Edit Indikator"
                                                                    data-indikator="<?= $key['id'].'|'.html_escape($key['indikator']) ?>"
                                                                    style="width: 30px; height: 30px; padding: 0;">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger HapusIndikatorCascade" 
                                                                    title="Hapus Indikator"
                                                                    data-id="<?= $key['id'] ?>"
                                                                    style="width: 30px; height: 30px; padding: 0;">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['indikator'])): ?>
                                                        <div style="padding: 2px 0; white-space: pre-wrap;"><?= html_escape($key['indikator']) ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: top;" class="text-center">
                                            <?= html_escape($key['tahun_mulai']) ?> - <?= html_escape($key['tahun_akhir']) ?>
                                        </td>
                                        <!-- Kolom PD Penanggung Jawab -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <button class="btn btn-sm btn-success TambahPjCascade" 
                                                                title="Tambah PD Penanggung Jawab"
                                                                data-id="<?= $key['id'] ?>"
                                                                style="width: 30px; height: 30px; padding: 0;">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <?php if (!empty($key['pd_penanggung_jawab'])): ?>
                                                            <button class="btn btn-sm btn-primary PicCascade" 
                                                                    title="Edit PD Penanggung Jawab"
                                                                    data-pic="<?= $key['id'].'|'.html_escape($key['pd_penanggung_jawab']) ?>"
                                                                    style="width: 30px; height: 30px; padding: 0;">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['pd_penanggung_jawab'])): ?>
                                                        <?php 
                                                        $penanggungJawab = explode(',', $key['pd_penanggung_jawab']);
                                                        foreach ($penanggungJawab as $pj): 
                                                        ?>
                                                            <div style="padding: 2px 0; white-space: nowrap;"><?= html_escape($pj) ?></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Kolom PD Penunjang -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                        <button class="btn btn-sm btn-success TambahPnCascade" 
                                                                title="Tambah PD Penunjang"
                                                                data-id="<?= $key['id'] ?>"
                                                                style="width: 30px; height: 30px; padding: 0;">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <?php if (!empty($key['pd_penunjang'])): ?>
                                                            <button class="btn btn-sm btn-primary PisCascade" 
                                                                    title="Edit PD Penunjang"
                                                                    data-pis="<?= $key['id'].'|'.html_escape($key['pd_penunjang']) ?>"
                                                                    style="width: 30px; height: 30px; padding: 0;">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['pd_penunjang'])): ?>
                                                        <?php 
                                                        $penunjang = explode(',', $key['pd_penunjang']);
                                                        foreach ($penunjang as $pn): 
                                                        ?>
                                                            <div style="padding: 2px 0; white-space: nowrap;"><?= html_escape($pn) ?></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Kolom Target -->
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?= is_numeric($key['target_1']) && floor($key['target_1']) == $key['target_1'] ? (int)$key['target_1'] : '-' ?>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?= is_numeric($key['target_2']) && floor($key['target_2']) == $key['target_2'] ? (int)$key['target_2'] : '-' ?>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?= is_numeric($key['target_3']) && floor($key['target_3']) == $key['target_3'] ? (int)$key['target_3'] : '-' ?>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?= is_numeric($key['target_4']) && floor($key['target_4']) == $key['target_4'] ? (int)$key['target_4'] : '-' ?>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?= is_numeric($key['target_5']) && floor($key['target_5']) == $key['target_5'] ? (int)$key['target_5'] : '-' ?>
                                        </td>
                                        <!-- Kolom Aksi -->
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <div style="display: flex; justify-content: center; gap: 5px;">
                                                    <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg EditCascade" 
                                                            data-id="<?= $key['id'] ?>" 
                                                            data-visi="<?= $key['IdVisi'] ?>"
                                                            data-misi="<?= $key['IdMisi'] ?>" 
                                                            data-indikator="<?= html_escape($key['indikator']) ?>"
                                                            data-tahunmulai="<?= $key['tahun_mulai'] ?>"
                                                            data-tahunakhir="<?= $key['tahun_akhir'] ?>"
                                                            data-target1="<?= $key['target_1'] ?>"
                                                            data-target2="<?= $key['target_2'] ?>"
                                                            data-target3="<?= $key['target_3'] ?>"
                                                            data-target4="<?= $key['target_4'] ?>"
                                                            data-target5="<?= $key['target_5'] ?>"
                                                            style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                        <i class="fa fa-edit" style="font-size: 15px;"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg HapusCascade" 
                                                            data-id="<?= $key['id'] ?>"
                                                            style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                        <i class="notika-icon notika-trash" style="font-size: 15px;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        <?php } ?>
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

    <!-- Modal Tambah Cascade -->
<div class="modal fade" id="ModalTambahCascade" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Cascade</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahCascade">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <!-- Tahun Filter Dropdown -->
                    <div class="form-group">
                        <label for="TahunFilter">Periode Tahun</label>
                        <select class="form-control" id="TahunFilter" name="TahunFilter" required>
                            <option value="" selected disabled>-- Pilih Tahun --</option>
                            <?php foreach ($Periods as $period) { ?>
                                <option value="<?= html_escape($period['TahunMulai'].'-'.$period['TahunAkhir']) ?>">
                                    <?= html_escape($period['TahunMulai'].' - '.$period['TahunAkhir']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Dropdown Visi -->
                    <div class="form-group">
                        <label for="Visi">Visi</label>
                        <select class="form-control" id="Visi" name="Visi" required disabled>
                            <option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>
                        </select>
                    </div>
                    <!-- Dropdown Misi -->
                    <div class="form-group">
                        <label for="Misi">Misi</label>
                        <select class="form-control" id="Misi" name="Misi" required disabled>
                            <option value="" selected disabled>-- Pilih Visi terlebih dahulu --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Target Tahunan</label>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Tahun 1</label>
                                <input type="number" class="form-control" name="target_1" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2</label>
                                <input type="number" class="form-control" name="target_2" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 3</label>
                                <input type="number" class="form-control" name="target_3" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 4</label>
                                <input type="number" class="form-control" name="target_4" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 5</label>
                                <input type="number" class="form-control" name="target_5" placeholder="Angka">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Cascade -->
<div class="modal fade" id="ModalEditCascade" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Cascade</h4>
            </div>
            <div class="modal-body">
                <form id="FormEditCascade">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" id="EditId" name="id">
                    <!-- Periode Dropdown -->
                    <div class="form-group">
                        <label for="EditPeriode">Periode Tahun</label>
                        <select class="form-control" id="EditPeriode" name="periode" required>
                            <option value="" selected disabled>-- Pilih Tahun --</option>
                            <?php foreach ($Periods as $period) { ?>
                                <option value="<?= html_escape($period['TahunMulai'].'-'.$period['TahunAkhir']) ?>">
                                    <?= html_escape($period['TahunMulai'].' - '.$period['TahunAkhir']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Dropdown Visi -->
                    <div class="form-group">
                        <label for="EditVisi">Visi</label>
                        <select class="form-control" id="EditVisi" name="EditVisi" required disabled>
                            <option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>
                        </select>
                    </div>
                    <!-- Dropdown Misi -->
                    <div class="form-group">
                        <label for="EditMisi">Misi</label>
                        <select class="form-control" id="EditMisi" name="EditMisi" required disabled>
                            <option value="" selected disabled>-- Pilih Visi terlebih dahulu --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Target Tahunan</label>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Tahun 1</label>
                                <input type="number" class="form-control" id="EditTarget1" name="target_1">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2</label>
                                <input type="number" class="form-control" id="EditTarget2" name="target_2">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 3</label>
                                <input type="number" class="form-control" id="EditTarget3" name="target_3">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 4</label>
                                <input type="number" class="form-control" id="EditTarget4" name="target_4">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 5</label>
                                <input type="number" class="form-control" id="EditTarget5" name="target_5">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Tambah Tujuan Cascade -->
    <div class="modal fade" id="ModalTambahTujuanCascade" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tujuan - Cascade</h4>
                </div>
                <div class="modal-body">
                    <form id="FormTambahTujuanCascade">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="TujuanCascadeId" name="id">
                        <input type="hidden" id="TujuanCascadeMisi" name="misi_id">
                        <div id="tujuan-cascade-container">
                            <div class="form-group tujuan-cascade-row">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>Tujuan</label>
                                        <select class="form-control tujuan-cascade-select" name="tujuan_ids[]" required>
                                            <option value="">Pilih Tujuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <button type="button" class="btn btn-success btn-add-tujuan-cascade">
                                            <i class="notika-icon notika-plus-symbol"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tujuan Cascade -->
    <div class="modal fade" id="ModalEditTujuanCascade" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Tujuan - Cascade</h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nk-int-st text-justify">
                                            <input type="hidden" class="form-control input-sm" id="IdCascadeTujuan">
                                            <input type="hidden" class="form-control input-sm" id="EditTujuanCascadeMisi">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div id="ListTujuanCascade"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="EditTujuanCascade">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Sasaran Cascade -->
    <div class="modal fade" id="ModalTambahSasaranCascade" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Sasaran - Cascade</h4>
                </div>
                <div class="modal-body">
                    <form id="FormTambahSasaranCascade">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="SasaranCascadeId" name="id">
                        <input type="hidden" id="SasaranCascadeTujuan" name="tujuan_id">
                        <div id="sasaran-cascade-container">
                            <div class="form-group sasaran-cascade-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Tujuan Terkait</label>
                                        <select class="form-control tujuan-select-for-sasaran" name="tujuan_terkait[]" required>
                                            <option value="">Pilih Tujuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>Sasaran</label>
                                        <select class="form-control sasaran-cascade-select" name="sasaran_ids[]" required disabled>
                                            <option value="">Pilih Sasaran</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <button type="button" class="btn btn-success btn-add-sasaran-cascade">
                                            <i class="notika-icon notika-plus-symbol"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Sasaran Cascade -->
    <div class="modal fade" id="ModalEditSasaranCascade" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Sasaran - Cascade</h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nk-int-st text-justify">
                                            <input type="hidden" class="form-control input-sm" id="IdCascadeSasaran">
                                            <input type="hidden" class="form-control input-sm" id="EditSasaranCascadeTujuan">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div id="ListSasaranCascade"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="EditSasaranCascade">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Indikator Cascade -->
    <div class="modal fade" id="ModalTambahIndikatorCascade" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Indikator - Cascade</h4>
                </div>
                <div class="modal-body">
                    <form id="FormTambahIndikatorCascade">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="IndikatorCascadeId" name="id">
                        <div class="form-group">
                            <label for="IndikatorText">Indikator IKU/IKD</label>
                            <textarea class="form-control" id="IndikatorText" name="indikator" rows="3" required placeholder="Masukkan teks indikator..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Indikator Cascade -->
    <div class="modal fade" id="ModalEditIndikatorCascade" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Indikator - Cascade</h4>
                </div>
                <div class="modal-body">
                    <form id="FormEditIndikatorCascade">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="EditIndikatorCascadeId" name="id">
                        <div class="form-group">
                            <label for="EditIndikatorText">Indikator IKU/IKD</label>
                            <textarea class="form-control" id="EditIndikatorText" name="indikator" rows="3" required placeholder="Masukkan teks indikator..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah PD Penanggung Jawab Cascade -->
    <div class="modal fade" id="ModalTambahPjCascade" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah PD Penanggung Jawab - Cascade</h4>
                </div>
                <div class="modal-body">
                    <form id="FormTambahPjCascade">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="PjCascadeId" name="id">
                        <div id="pj-cascade-container">
                            <div class="form-group pj-cascade-row">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>PD Penanggung Jawab</label>
                                        <select class="form-control pj-cascade-select" name="pd_penanggung_jawab[]" required>
                                            <option value="">Pilih PD Penanggung Jawab</option>
                                            <option value="Semua Instansi Terkait">Semua Instansi Terkait</option>
                                            <?php foreach ($Instansi as $instansi) { ?>
                                                <option value="<?= html_escape($instansi['nama']) ?>"><?= html_escape($instansi['nama']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <button type="button" class="btn btn-success btn-add-pj-cascade">
                                            <i class="notika-icon notika-plus-symbol"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah PD Penunjang Cascade -->
    <div class="modal fade" id="ModalTambahPnCascade" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah PD Penunjang - Cascade</h4>
                </div>
                <div class="modal-body">
                    <form id="FormTambahPnCascade">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="PnCascadeId" name="id">
                        <div id="pn-cascade-container">
                            <div class="form-group pn-cascade-row">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>PD Penunjang</label>
                                        <select class="form-control pn-cascade-select" name="pd_penunjang[]" required>
                                            <option value="">Pilih PD Penunjang</option>
                                            <option value="Semua Instansi Terkait">Semua Instansi Terkait</option>
                                            <?php foreach ($Instansi as $instansi) { ?>
                                                <option value="<?= html_escape($instansi['nama']) ?>"><?= html_escape($instansi['nama']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <button type="button" class="btn btn-success btn-add-pn-cascade">
                                            <i class="notika-icon notika-plus-symbol"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit PD Penanggung Jawab Cascade -->
    <div class="modal fade" id="ModalPicCascade" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit PD Penanggung Jawab - Cascade</h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nk-int-st text-justify">
                                            <input type="hidden" class="form-control input-sm" id="IdCascadePic">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div id="ListPicCascade"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="EditPicCascade">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit PD Penunjang Cascade -->
    <div class="modal fade" id="ModalPisCascade" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit PD Penunjang - Cascade</h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nk-int-st text-justify">
                                            <input type="hidden" class="form-control input-sm" id="IdCascadePis">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div id="ListPisCascade"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="EditPisCascade">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .filter-row {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 10px;
        }
        .filter-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .filter-group label {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .filter-select {
            width: 260px;
            font-size: 14px;
            padding: 5px 8px;
        }
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                gap: 15px;
            }
            .filter-select {
                width: 100%;
            }
        }
    </style>

    <script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
    <script src="<?= base_url('js/main.js'); ?>"></script>

    <script>
       var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_token_name() ?>';
var CSRF_HASH = '<?= $this->security->get_csrf_hash() ?>';
var instansiOptions = <?php echo json_encode($Instansi); ?>;

$(document).ready(function() {

    // ============================================================
    // FUNGSI BANTUAN
    // ============================================================

    function getInstansiOptions() {
        var options = '<option value="">Pilih PD</option><option value="Semua Instansi Terkait">Semua Instansi Terkait</option>';
        instansiOptions.forEach(function(instansi) {
            options += '<option value="' + instansi.nama + '">' + instansi.nama + '</option>';
        });
        return options;
    }

    function handleResponse(res, modalId, formId) {
        try {
            if (res === '1' || res.trim() === '1') {
                if (formId) {
                    $('#' + formId)[0].reset();
                }
                if (modalId) {
                    $('#' + modalId).modal('hide');
                }
                window.location.reload();
            } else {
                try {
                    var error = JSON.parse(res);
                    alert(error.message || "Gagal memproses data!");
                } catch (e) {
                    alert(res || "Gagal memproses data!");
                }
            }
        } catch (e) {
            alert("Terjadi kesalahan: " + e.message);
        }
    }

    function loadTujuanByMisi(misiId, targetSelect, disableMessage) {
        if (misiId) {
            targetSelect.prop('disabled', false).html('<option value="" selected disabled>-- Pilih Tujuan --</option>');
            $.ajax({
                url: BaseURL + 'Daerah/GetTujuanByMisi',
                type: 'POST',
                data: { misi_id: misiId, [CSRF_TOKEN]: CSRF_HASH },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                targetSelect.append('<option value="' + value.Id + '">' + value.Tujuan + '</option>');
                            });
                        } else {
                            targetSelect.html('<option value="" selected disabled>' + disableMessage + '</option>').prop('disabled', true);
                        }
                    } catch (e) {
                        targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                    }
                },
                error: function() {
                    targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                }
            });
        } else {
            targetSelect.prop('disabled', true).html('<option value="" selected disabled>' + disableMessage + '</option>');
        }
    }

    function loadSasaranByTujuan(tujuanId, targetSelect, disableMessage) {
        if (tujuanId) {
            targetSelect.prop('disabled', false).html('<option value="" selected disabled>-- Pilih Sasaran --</option>');
            $.ajax({
                url: BaseURL + 'Daerah/GetSasaranByTujuan',
                type: 'POST',
                data: { tujuan_id: tujuanId, [CSRF_TOKEN]: CSRF_HASH },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                targetSelect.append('<option value="' + value.Id + '">' + value.Sasaran + '</option>');
                            });
                        } else {
                            targetSelect.html('<option value="" selected disabled>' + disableMessage + '</option>').prop('disabled', true);
                        }
                    } catch (e) {
                        targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                    }
                },
                error: function() {
                    targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                }
            });
        } else {
            targetSelect.prop('disabled', true).html('<option value="" selected disabled>' + disableMessage + '</option>');
        }
    }

    function loadVisiByPeriod(tahunRange, targetSelect, disableMessage) {
        if (tahunRange) {
            targetSelect.prop('disabled', false).html('<option value="" selected disabled>-- Pilih Visi --</option>');
            var tahunRangeSplit = tahunRange.split('-');
            $.ajax({
                url: BaseURL + 'Daerah/GetVisiByPeriod',
                type: 'POST',
                data: {
                    tahun_mulai: tahunRangeSplit[0],
                    tahun_akhir: tahunRangeSplit[1],
                    [CSRF_TOKEN]: CSRF_HASH
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                targetSelect.append('<option value="' + value.Id + '">' + value.Visi + '</option>');
                            });
                        } else {
                            targetSelect.html('<option value="" selected disabled>' + disableMessage + '</option>').prop('disabled', true);
                        }
                    } catch (e) {
                        targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                    }
                },
                error: function() {
                    targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                }
            });
        } else {
            targetSelect.prop('disabled', true).html('<option value="" selected disabled>' + disableMessage + '</option>');
        }
    }

    function loadMisiByVisi(visiId, targetSelect, disableMessage) {
        if (visiId) {
            targetSelect.prop('disabled', false).html('<option value="" selected disabled>-- Pilih Misi --</option>');
            $.ajax({
                url: BaseURL + 'Daerah/GetMisiByVisi',
                type: 'POST',
                data: { visi_id: visiId, [CSRF_TOKEN]: CSRF_HASH },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                targetSelect.append('<option value="' + value.Id + '">' + value.Misi + '</option>');
                            });
                        } else {
                            targetSelect.html('<option value="" selected disabled>' + disableMessage + '</option>').prop('disabled', true);
                        }
                    } catch (e) {
                        targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                    }
                },
                error: function() {
                    targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                }
            });
        } else {
            targetSelect.prop('disabled', true).html('<option value="" selected disabled>' + disableMessage + '</option>');
        }
    }

    function loadTujuanForSasaran(tujuanIds, targetSelect) {
        if (tujuanIds && tujuanIds !== "") {
            var tujuanIdArray = tujuanIds.split(",");
            targetSelect.prop('disabled', false).html('<option value="" selected disabled>-- Pilih Tujuan --</option>');
            
            $.ajax({
                url: BaseURL + 'Daerah/GetTujuanByMisi',
                type: 'POST',
                data: { 
                    misi_id: $('.EditTujuanCascade').data('misi') || '', 
                    [CSRF_TOKEN]: CSRF_HASH 
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.length > 0) {
                            var filteredTujuan = data.filter(function(tujuan) {
                                return tujuanIdArray.includes(tujuan.Id.toString());
                            });
                            
                            if (filteredTujuan.length > 0) {
                                $.each(filteredTujuan, function(key, value) {
                                    targetSelect.append('<option value="' + value.Id + '">' + value.Tujuan + '</option>');
                                });
                                targetSelect.trigger('change');
                            } else {
                                targetSelect.html('<option value="" selected disabled>-- Tidak ada tujuan yang dipilih --</option>').prop('disabled', true);
                            }
                        } else {
                            targetSelect.html('<option value="" selected disabled>-- Tidak ada tujuan --</option>').prop('disabled', true);
                        }
                    } catch (e) {
                        targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                    }
                },
                error: function() {
                    targetSelect.html('<option value="" selected disabled>Error memuat data</option>').prop('disabled', true);
                }
            });
        } else {
            targetSelect.prop('disabled', true).html('<option value="" selected disabled>-- Belum ada tujuan yang dipilih --</option>');
        }
    }

    function validateIntegerInputs(formId) {
        var isValid = true;
        $('#' + formId + ' input[type="number"]').each(function() {
            if (this.value && !Number.isInteger(parseFloat(this.value))) {
                alert('Target harus angka bulat!');
                isValid = false;
                return false;
            }
        });
        return isValid;
    }

    // ============================================================
    // FILTER WILAYAH
    // ============================================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
        $("#Provinsi").change(function() {
            if ($(this).val() === "") {
                $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                return;
            }
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: $(this).val(), [CSRF_TOKEN]: CSRF_HASH },
                beforeSend: function() { $("#KabKota").prop('disabled', true); },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                            }
                        } else {
                            alert("Belum Ada Data Kab/Kota");
                        }
                        $("#KabKota").html(KabKota).prop('disabled', false);
                    } catch (e) {
                        alert("Gagal memuat data Kab/Kota");
                        $("#KabKota").prop('disabled', false);
                    }
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                    $("#KabKota").prop('disabled', false);
                }
            });
        });

        $("#Filter").click(function() {
            if ($("#Provinsi").val() === "") {
                alert("Mohon Pilih Provinsi");
                return;
            }
            if ($("#KabKota").val() === "") {
                alert("Mohon Pilih Kab/Kota");
                return;
            }
            var kodeWilayah = $("#KabKota").val();
            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: { KodeWilayah: kodeWilayah, [CSRF_TOKEN]: CSRF_HASH },
                beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                success: function(Respon) {
                    try {
                        if (Respon === '1' || Respon.trim() === '1') {
                            window.location.href = BaseURL + "Daerah/Cascade";
                        } else {
                            alert(Respon || "Gagal menyimpan filter wilayah!");
                            $("#Filter").prop('disabled', false).text('Filter');
                        }
                    } catch (e) {
                        alert("Gagal memproses respons server!");
                        $("#Filter").prop('disabled', false).text('Filter');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
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
                data: { Kode: kodeProv, [CSRF_TOKEN]: CSRF_HASH },
                success: function(Respon) {
                    try {
                        var Data = JSON.parse(Respon);
                        var KabKota = '<option value="">Pilih Kab/Kota</option>';
                        if (Data.length > 0) {
                            for (let i = 0; i < Data.length; i++) {
                                var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                                KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                            }
                        }
                        $("#KabKota").html(KabKota);
                    } catch (e) {
                        alert("Gagal memuat data Kab/Kota");
                    }
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                }
            });
        <?php } ?>
    <?php } ?>

    // ============================================================
    // TAMBAH CASCADE
    // ============================================================

    $('#TahunFilter').change(function() {
        loadVisiByPeriod($(this).val(), $('#Visi'), '-- Tidak ada visi untuk periode ini --');
        $('#Misi').prop('disabled', true).html('<option value="" selected disabled>-- Pilih Visi terlebih dahulu --</option>');
    });

    $('#Visi').change(function() {
        loadMisiByVisi($(this).val(), $('#Misi'), '-- Tidak ada misi untuk visi ini --');
    });

    $("#FormTambahCascade").submit(function(e) {
        e.preventDefault();
        
        if ($('#TahunFilter').val() === "") { alert('Pilih periode tahun!'); return false; }
        if ($('#Visi').val() === "") { alert('Pilih visi!'); return false; }
        if ($('#Misi').val() === "") { alert('Pilih misi!'); return false; }
        if (!validateIntegerInputs('FormTambahCascade')) return false;
        
        $.ajax({
            url: BaseURL + "Daerah/TambahCascade",
            type: "POST",
            data: $(this).serialize(),
            beforeSend: function() {
                $("#FormTambahCascade button[type=submit]").prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalTambahCascade', 'FormTambahCascade');
                $("#FormTambahCascade button[type=submit]").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#FormTambahCascade button[type=submit]").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // EDIT CASCADE
    // ============================================================

    $('#EditPeriode').change(function() {
        loadVisiByPeriod($(this).val(), $('#EditVisi'), '-- Tidak ada visi untuk periode ini --');
        $('#EditMisi').prop('disabled', true).html('<option value="" selected disabled>-- Pilih Visi terlebih dahulu --</option>');
    });

    $('#EditVisi').change(function() {
        loadMisiByVisi($(this).val(), $('#EditMisi'), '-- Tidak ada misi untuk visi ini --');
    });

    $(".EditCascade").click(function() {
        var data = $(this).data();
        $("#EditId").val(data.id);
        $("#EditTarget1").val(data.target1 || '');
        $("#EditTarget2").val(data.target2 || '');
        $("#EditTarget3").val(data.target3 || '');
        $("#EditTarget4").val(data.target4 || '');
        $("#EditTarget5").val(data.target5 || '');
        $("#EditPeriode").val(data.tahunmulai + '-' + data.tahunakhir).trigger('change');

        var intervalVisi = setInterval(function() {
            if ($('#EditVisi option[value="' + data.visi + '"]').length > 0) {
                $('#EditVisi').val(data.visi).trigger('change');
                clearInterval(intervalVisi);
                var intervalMisi = setInterval(function() {
                    if ($('#EditMisi option[value="' + data.misi + '"]').length > 0) {
                        $('#EditMisi').val(data.misi);
                        clearInterval(intervalMisi);
                    }
                }, 100);
            }
        }, 100);

        $("#ModalEditCascade").modal('show');
    });

    $("#FormEditCascade").submit(function(e) {
        e.preventDefault();
        
        if ($('#EditPeriode').val() === "") { alert('Pilih periode tahun!'); return false; }
        if ($('#EditVisi').val() === "") { alert('Pilih visi!'); return false; }
        if ($('#EditMisi').val() === "") { alert('Pilih misi!'); return false; }
        if (!validateIntegerInputs('FormEditCascade')) return false;
        
        $.ajax({
            url: BaseURL + "Daerah/EditCascade",
            type: "POST",
            data: $(this).serialize(),
            beforeSend: function() {
                $("#FormEditCascade button[type=submit]").prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalEditCascade', 'FormEditCascade');
                $("#FormEditCascade button[type=submit]").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#FormEditCascade button[type=submit]").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // HAPUS CASCADE
    // ============================================================

    $(".HapusCascade").click(function() {
        if (confirm("Apakah Anda yakin ingin menghapus data cascade ini?")) {
            var id = $(this).data('id');
            $.ajax({
                url: BaseURL + "Daerah/HapusCascade",
                type: "POST",
                data: { id: id, [CSRF_TOKEN]: CSRF_HASH },
                beforeSend: function() { $(this).prop('disabled', true); },
                success: function(res) {
                    handleResponse(res, null, null);
                    $(this).prop('disabled', false);
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.statusText);
                    $(this).prop('disabled', false);
                }
            });
        }
    });

    // ============================================================
    // INDIKATOR CASCADE
    // ============================================================

    $(document).on('click', '.TambahIndikatorCascade', function() {
        $('#IndikatorCascadeId').val($(this).data('id'));
        $('#IndikatorText').val('');
        $('#ModalTambahIndikatorCascade').modal('show');
    });

    $('#FormTambahIndikatorCascade').submit(function(e) {
        e.preventDefault();
        if ($('#IndikatorText').val().trim() === "") { alert('Indikator harus diisi!'); return false; }
        
        $.ajax({
            url: BaseURL + 'Daerah/TambahIndikatorCascade',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                $('button[type="submit"]', this).prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalTambahIndikatorCascade', 'FormTambahIndikatorCascade');
                $('button[type="submit"]', this).prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $('button[type="submit"]', this).prop('disabled', false).text('Simpan');
            }
        });
    });

    $(document).on('click', '.EditIndikatorCascade', function() {
        var data = $(this).attr('data-indikator').split('|');
        $('#EditIndikatorCascadeId').val(data[0]);
        $('#EditIndikatorText').val(data[1]);
        $('#ModalEditIndikatorCascade').modal('show');
    });

    $('#FormEditIndikatorCascade').submit(function(e) {
        e.preventDefault();
        if ($('#EditIndikatorText').val().trim() === "") { alert('Indikator harus diisi!'); return false; }
        
        $.ajax({
            url: BaseURL + 'Daerah/EditIndikatorCascade',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                $('button[type="submit"]', this).prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalEditIndikatorCascade', 'FormEditIndikatorCascade');
                $('button[type="submit"]', this).prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $('button[type="submit"]', this).prop('disabled', false).text('Simpan');
            }
        });
    });

    $(document).on('click', '.HapusIndikatorCascade', function() {
        if (confirm('Apakah Anda yakin ingin menghapus indikator ini?')) {
            var id = $(this).data('id');
            $.ajax({
                url: BaseURL + 'Daerah/HapusIndikatorCascade',
                type: 'POST',
                data: { id: id, [CSRF_TOKEN]: CSRF_HASH },
                beforeSend: function() { $(this).prop('disabled', true); },
                success: function(res) {
                    handleResponse(res, null, null);
                    $(this).prop('disabled', false);
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.statusText);
                    $(this).prop('disabled', false);
                }
            });
        }
    });

    // ============================================================
    // TUJUAN CASCADE
    // ============================================================

    $(document).on('click', '.btn-add-tujuan-cascade', function() {
        var misiId = $('#TujuanCascadeMisi').val();
        var newRow = $('<div class="form-group tujuan-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<select class="form-control tujuan-cascade-select" name="tujuan_ids[]" required>' +
            '<option value="">Pilih Tujuan</option>' +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 7px;">' +
            '<button type="button" class="btn btn-danger btn-remove-tujuan-cascade">' +
            '<i class="notika-icon notika-trash"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        $('#tujuan-cascade-container').append(newRow);
        loadTujuanByMisi(misiId, newRow.find('.tujuan-cascade-select'), '-- Tidak ada tujuan untuk misi ini --');
    });

    $(document).on('click', '.btn-remove-tujuan-cascade', function() {
        if ($('.tujuan-cascade-row').length > 1) {
            $(this).closest('.tujuan-cascade-row').remove();
        } else {
            alert('Minimal harus ada satu Tujuan');
        }
    });

    $(".TambahTujuanCascade").click(function() {
        var id = $(this).data('id');
        var misiId = $(this).data('misi');
        
        $("#TujuanCascadeId").val(id);
        $("#TujuanCascadeMisi").val(misiId);
        
        $("#tujuan-cascade-container").html('<div class="form-group tujuan-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<label>Tujuan</label>' +
            '<select class="form-control tujuan-cascade-select" name="tujuan_ids[]" required>' +
            '<option value="">Pilih Tujuan</option>' +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 25px;">' +
            '<button type="button" class="btn btn-success btn-add-tujuan-cascade">' +
            '<i class="notika-icon notika-plus-symbol"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        
        loadTujuanByMisi(misiId, $('#tujuan-cascade-container .tujuan-cascade-select:first'), '-- Tidak ada tujuan untuk misi ini --');
        $("#ModalTambahTujuanCascade").modal('show');
    });

    $("#FormTambahTujuanCascade").submit(function(e) {
        e.preventDefault();
        
        var semuaTujuanIds = [];
        $('select[name="tujuan_ids[]"]').each(function() {
            if ($(this).val()) {
                semuaTujuanIds.push($(this).val());
            }
        });
        
        if (semuaTujuanIds.length === 0) {
            alert('Pilih minimal satu Tujuan!');
            return false;
        }
        
        var formData = {
            id: $('#TujuanCascadeId').val(),
            tujuan_ids: semuaTujuanIds.join(','),
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        $.ajax({
            url: BaseURL + "Daerah/TambahTujuanCascade",
            type: "POST",
            data: formData,
            beforeSend: function() {
                $("#FormTambahTujuanCascade button[type=submit]").prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalTambahTujuanCascade', 'FormTambahTujuanCascade');
                $("#FormTambahTujuanCascade button[type=submit]").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#FormTambahTujuanCascade button[type=submit]").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // EDIT TUJUAN CASCADE
    // ============================================================

    $(".EditTujuanCascade").click(function() {
        var Data = $(this).attr('data-tujuan').split("|");
        var misiId = $(this).data('misi');
        var cascadeId = Data[0];
        var existingTujuanIds = Data[1].split(",");
        
        $("#IdCascadeTujuan").val(cascadeId);
        $("#EditTujuanCascadeMisi").val(misiId);
        
        if (existingTujuanIds.length > 0 && existingTujuanIds[0] !== "") {
            $.ajax({
                url: BaseURL + 'Daerah/GetTujuanByMisi',
                type: 'POST',
                data: { misi_id: misiId, [CSRF_TOKEN]: CSRF_HASH },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.length > 0) {
                            var filteredData = data.filter(function(tujuan) {
                                return existingTujuanIds.includes(tujuan.Id.toString());
                            });
                            
                            if (filteredData.length > 0) {
                                var List = '';
                                $.each(filteredData, function(key, value) {
                                    List += '<label><input style="margin-top: 10px;" type="checkbox" checked name="TujuanCascade" value="'+value.Id+'"> '+value.Tujuan+'</label><br>';
                                });
                                $("#ListTujuanCascade").html(List);
                                $("#ModalEditTujuanCascade").modal('show');
                            } else {
                                alert("Tujuan yang dipilih sebelumnya tidak ditemukan");
                            }
                        } else {
                            alert("Tidak ada tujuan untuk misi ini");
                        }
                    } catch (e) {
                        alert("Gagal memproses data tujuan");
                    }
                },
                error: function() {
                    alert("Gagal memuat data tujuan");
                }
            });
        } else {
            alert("Tidak ada tujuan yang dipilih sebelumnya");
        }
    });

    $("#EditTujuanCascade").click(function() {
        var previousTujuanIds = $("#ListTujuanCascade input[name='TujuanCascade']").map(function() {
            return $(this).val();
        }).get();
        
        var currentTujuanIds = [];
        $.each($("input[name='TujuanCascade']:checked"), function() {
            currentTujuanIds.push($(this).val());
        });
        
        var deletedTujuanIds = previousTujuanIds.filter(function(id) {
            return !currentTujuanIds.includes(id);
        });
        
        var Tujuan = {
            id: $("#IdCascadeTujuan").val(),
            tujuan_ids: currentTujuanIds.join(","),
            deleted_tujuan_ids: deletedTujuanIds.join(","),
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        if (deletedTujuanIds.length > 0 && !confirm("Beberapa tujuan akan dihapus. Sasaran dan indikator terkait juga akan terhapus. Lanjutkan?")) {
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/EditTujuanCascade",
            type: "POST",
            data: Tujuan,
            beforeSend: function() {
                $("#EditTujuanCascade").prop('disabled', true).text('Menyimpan...');
            },
            success: function(Respon) {
                handleResponse(Respon, 'ModalEditTujuanCascade', null);
                $("#EditTujuanCascade").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#EditTujuanCascade").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // SASARAN CASCADE
    // ============================================================

    $(document).on('change', '.tujuan-select-for-sasaran', function() {
        var tujuanId = $(this).val();
        var sasaranSelect = $(this).closest('.sasaran-cascade-row').find('.sasaran-cascade-select');
        
        if (tujuanId) {
            loadSasaranByTujuan(tujuanId, sasaranSelect, '-- Tidak ada sasaran untuk tujuan ini --');
            sasaranSelect.prop('disabled', false);
        } else {
            sasaranSelect.prop('disabled', true).html('<option value="">Pilih Sasaran</option>');
        }
    });

    $(document).on('click', '.btn-add-sasaran-cascade', function() {
        var newRow = $('<div class="form-group sasaran-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-12">' +
            '<label>Tujuan Terkait</label>' +
            '<select class="form-control tujuan-select-for-sasaran" name="tujuan_terkait[]" required>' +
            '<option value="">Pilih Tujuan</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<label>Sasaran</label>' +
            '<select class="form-control sasaran-cascade-select" name="sasaran_ids[]" required disabled>' +
            '<option value="">Pilih Sasaran</option>' +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 25px;">' +
            '<button type="button" class="btn btn-danger btn-remove-sasaran-cascade">' +
            '<i class="notika-icon notika-trash"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        
        $('#sasaran-cascade-container').append(newRow);
        
        var firstTujuanSelect = $('#sasaran-cascade-container .tujuan-select-for-sasaran:first');
        firstTujuanSelect.find('option').each(function() {
            if ($(this).val() !== "") {
                newRow.find('.tujuan-select-for-sasaran').append('<option value="' + $(this).val() + '">' + $(this).text() + '</option>');
            }
        });
    });

    $(document).on('click', '.btn-remove-sasaran-cascade', function() {
        if ($('.sasaran-cascade-row').length > 1) {
            $(this).closest('.sasaran-cascade-row').remove();
        } else {
            alert('Minimal harus ada satu Sasaran');
        }
    });

    $(".TambahSasaranCascade").click(function() {
        var id = $(this).data('id');
        var tujuanIds = $(this).closest('tr').find('.EditTujuanCascade').attr('data-tujuan').split("|")[1];
        
        $("#SasaranCascadeId").val(id);
        
        $("#sasaran-cascade-container").html('<div class="form-group sasaran-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-12">' +
            '<label>Tujuan Terkait</label>' +
            '<select class="form-control tujuan-select-for-sasaran" name="tujuan_terkait[]" required>' +
            '<option value="">Pilih Tujuan</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<label>Sasaran</label>' +
            '<select class="form-control sasaran-cascade-select" name="sasaran_ids[]" required disabled>' +
            '<option value="">Pilih Sasaran</option>' +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 25px;">' +
            '<button type="button" class="btn btn-success btn-add-sasaran-cascade">' +
            '<i class="notika-icon notika-plus-symbol"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        
        loadTujuanForSasaran(tujuanIds, $('#sasaran-cascade-container .tujuan-select-for-sasaran:first'));
        $("#ModalTambahSasaranCascade").modal('show');
    });

    $("#FormTambahSasaranCascade").submit(function(e) {
        e.preventDefault();
        
        var semuaSasaranIds = [];
        $('select[name="sasaran_ids[]"]').each(function() {
            if ($(this).val()) {
                semuaSasaranIds.push($(this).val());
            }
        });
        
        if (semuaSasaranIds.length === 0) {
            alert('Pilih minimal satu Sasaran!');
            return false;
        }
        
        var formData = {
            id: $('#SasaranCascadeId').val(),
            sasaran_ids: semuaSasaranIds.join(','),
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        $.ajax({
            url: BaseURL + "Daerah/TambahSasaranCascade",
            type: "POST",
            data: formData,
            beforeSend: function() {
                $("#FormTambahSasaranCascade button[type=submit]").prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalTambahSasaranCascade', 'FormTambahSasaranCascade');
                $("#FormTambahSasaranCascade button[type=submit]").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#FormTambahSasaranCascade button[type=submit]").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // EDIT SASARAN CASCADE
    // ============================================================

    $(".EditSasaranCascade").click(function() {
        var Data = $(this).attr('data-sasaran').split("|");
        var tujuanId = $(this).data('tujuan');
        $("#IdCascadeSasaran").val(Data[0]);
        $("#EditSasaranCascadeTujuan").val(tujuanId);
        var existingSasaranIds = Data[1].split(",");
        
        if (existingSasaranIds.length > 0 && existingSasaranIds[0] !== "") {
            $.ajax({
                url: BaseURL + 'Daerah/GetSasaranByTujuan',
                type: 'POST',
                data: { tujuan_id: tujuanId, [CSRF_TOKEN]: CSRF_HASH },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.length > 0) {
                            var filteredData = data.filter(function(sasaran) {
                                return existingSasaranIds.includes(sasaran.Id.toString());
                            });
                            
                            if (filteredData.length > 0) {
                                var List = '';
                                $.each(filteredData, function(key, value) {
                                    List += '<label><input style="margin-top: 10px;" type="checkbox" checked name="SasaranCascade" value="'+value.Id+'"> '+value.Sasaran+'</label><br>';
                                });
                                $("#ListSasaranCascade").html(List);
                                $("#ModalEditSasaranCascade").modal('show');
                            } else {
                                alert("Sasaran yang dipilih sebelumnya tidak ditemukan");
                            }
                        } else {
                            alert("Tidak ada sasaran untuk tujuan ini");
                        }
                    } catch (e) {
                        alert("Gagal memproses data sasaran");
                    }
                },
                error: function() {
                    alert("Gagal memuat data sasaran");
                }
            });
        } else {
            alert("Tidak ada sasaran yang dipilih sebelumnya");
        }
    });

    $("#EditSasaranCascade").click(function() {
        var previousSasaranIds = $("#ListSasaranCascade input[name='SasaranCascade']").map(function() {
            return $(this).val();
        }).get();
        
        var currentSasaranIds = [];
        $.each($("input[name='SasaranCascade']:checked"), function() {
            currentSasaranIds.push($(this).val());
        });
        
        var deletedSasaranIds = previousSasaranIds.filter(function(id) {
            return !currentSasaranIds.includes(id);
        });
        
        var Sasaran = {
            id: $("#IdCascadeSasaran").val(),
            sasaran_ids: currentSasaranIds.join(","),
            deleted_sasaran_ids: deletedSasaranIds.join(","),
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        if (deletedSasaranIds.length > 0 && !confirm("Beberapa sasaran akan dihapus. Indikator terkait juga akan terhapus. Lanjutkan?")) {
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/EditSasaranCascade",
            type: "POST",
            data: Sasaran,
            beforeSend: function() {
                $("#EditSasaranCascade").prop('disabled', true).text('Menyimpan...');
            },
            success: function(Respon) {
                handleResponse(Respon, 'ModalEditSasaranCascade', null);
                $("#EditSasaranCascade").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#EditSasaranCascade").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // PD CASCADE
    // ============================================================

    $(document).on('click', '.btn-add-pj-cascade', function() {
        var newRow = $('<div class="form-group pj-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<select class="form-control pj-cascade-select" name="pd_penanggung_jawab[]" required>' +
            getInstansiOptions() +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 7px;">' +
            '<button type="button" class="btn btn-danger btn-remove-pj-cascade">' +
            '<i class="notika-icon notika-trash"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        $('#pj-cascade-container').append(newRow);
    });

    $(document).on('click', '.btn-remove-pj-cascade', function() {
        if ($('.pj-cascade-row').length > 1) {
            $(this).closest('.pj-cascade-row').remove();
        } else {
            alert('Minimal harus ada satu PD Penanggung Jawab');
        }
    });

    $(".TambahPjCascade").click(function() {
        var id = $(this).data('id');
        $("#PjCascadeId").val(id);
        $("#pj-cascade-container").html('<div class="form-group pj-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<label>PD Penanggung Jawab</label>' +
            '<select class="form-control pj-cascade-select" name="pd_penanggung_jawab[]" required>' +
            getInstansiOptions() +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 25px;">' +
            '<button type="button" class="btn btn-success btn-add-pj-cascade">' +
            '<i class="notika-icon notika-plus-symbol"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        $("#ModalTambahPjCascade").modal('show');
    });

    $("#FormTambahPjCascade").submit(function(e) {
        e.preventDefault();
        
        var pdValues = [];
        $('select[name="pd_penanggung_jawab[]"]').each(function() {
            if ($(this).val()) {
                pdValues.push($(this).val());
            }
        });
        
        if (pdValues.length === 0) {
            alert('Pilih minimal satu PD Penanggung Jawab!');
            return false;
        }
        
        var formData = {
            id: $('#PjCascadeId').val(),
            pd_values: pdValues.join(','),
            type: 'pj',
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        $.ajax({
            url: BaseURL + "Daerah/TambahPdCascade",
            type: "POST",
            data: formData,
            beforeSend: function() {
                $("#FormTambahPjCascade button[type=submit]").prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalTambahPjCascade', 'FormTambahPjCascade');
                $("#FormTambahPjCascade button[type=submit]").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#FormTambahPjCascade button[type=submit]").prop('disabled', false).text('Simpan');
            }
        });
    });

    // PD Penunjang
    $(document).on('click', '.btn-add-pn-cascade', function() {
        var newRow = $('<div class="form-group pn-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<select class="form-control pn-cascade-select" name="pd_penunjang[]" required>' +
            getInstansiOptions() +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 7px;">' +
            '<button type="button" class="btn btn-danger btn-remove-pn-cascade">' +
            '<i class="notika-icon notika-trash"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        $('#pn-cascade-container').append(newRow);
    });

    $(document).on('click', '.btn-remove-pn-cascade', function() {
        if ($('.pn-cascade-row').length > 1) {
            $(this).closest('.pn-cascade-row').remove();
        } else {
            alert('Minimal harus ada satu PD Penunjang');
        }
    });

    $(".TambahPnCascade").click(function() {
        var id = $(this).data('id');
        $("#PnCascadeId").val(id);
        $("#pn-cascade-container").html('<div class="form-group pn-cascade-row">' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<label>PD Penunjang</label>' +
            '<select class="form-control pn-cascade-select" name="pd_penunjang[]" required>' +
            getInstansiOptions() +
            '</select>' +
            '</div>' +
            '<div class="col-md-2" style="padding-top: 25px;">' +
            '<button type="button" class="btn btn-success btn-add-pn-cascade">' +
            '<i class="notika-icon notika-plus-symbol"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>');
        $("#ModalTambahPnCascade").modal('show');
    });

    $("#FormTambahPnCascade").submit(function(e) {
        e.preventDefault();
        
        var pdValues = [];
        $('select[name="pd_penunjang[]"]').each(function() {
            if ($(this).val()) {
                pdValues.push($(this).val());
            }
        });
        
        if (pdValues.length === 0) {
            alert('Pilih minimal satu PD Penunjang!');
            return false;
        }
        
        var formData = {
            id: $('#PnCascadeId').val(),
            pd_values: pdValues.join(','),
            type: 'pn',
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        $.ajax({
            url: BaseURL + "Daerah/TambahPdCascade",
            type: "POST",
            data: formData,
            beforeSend: function() {
                $("#FormTambahPnCascade button[type=submit]").prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                handleResponse(res, 'ModalTambahPnCascade', 'FormTambahPnCascade');
                $("#FormTambahPnCascade button[type=submit]").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#FormTambahPnCascade button[type=submit]").prop('disabled', false).text('Simpan');
            }
        });
    });

    // Edit PD Penanggung Jawab
    $(".PicCascade").click(function() {
        var Data = $(this).attr('data-pic').split("|");
        $("#IdCascadePic").val(Data[0]);
        var Pisah = Data[1].split(",");
        var List = '';
        for (let i = 0; i < Pisah.length; i++) {
            List += '<label><input style="margin-top: 10px;" type="checkbox" checked name="PicCascade" value="'+Pisah[i]+'"> '+Pisah[i]+'</label><br>';
        }
        $("#ListPicCascade").html(List);
        $("#ModalPicCascade").modal('show');
    });

    $("#EditPicCascade").click(function() {
        var Tampung = [];
        $.each($("input[name='PicCascade']:checked"), function() {
            Tampung.push($(this).val());
        });
        var Pic = {
            id: $("#IdCascadePic").val(),
            pd_penanggung_jawab: Tampung.join(","),
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        $.ajax({
            url: BaseURL + "Daerah/EditPDCascade",
            type: "POST",
            data: Pic,
            beforeSend: function() {
                $("#EditPicCascade").prop('disabled', true).text('Menyimpan...');
            },
            success: function(Respon) {
                handleResponse(Respon, 'ModalPicCascade', null);
                $("#EditPicCascade").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#EditPicCascade").prop('disabled', false).text('Simpan');
            }
        });
    });

    // Edit PD Penunjang
    $(".PisCascade").click(function() {
        var Data = $(this).attr('data-pis').split("|");
        $("#IdCascadePis").val(Data[0]);
        var Pisah = Data[1].split(",");
        var List = '';
        for (let i = 0; i < Pisah.length; i++) {
            List += '<label><input style="margin-top: 10px;" type="checkbox" checked name="PisCascade" value="'+Pisah[i]+'"> '+Pisah[i]+'</label><br>';
        }
        $("#ListPisCascade").html(List);
        $("#ModalPisCascade").modal('show');
    });

    $("#EditPisCascade").click(function() {
        var Tampung = [];
        $.each($("input[name='PisCascade']:checked"), function() {
            Tampung.push($(this).val());
        });
        var Pis = {
            id: $("#IdCascadePis").val(),
            pd_penunjang: Tampung.join(","),
            [CSRF_TOKEN]: CSRF_HASH
        };
        
        $.ajax({
            url: BaseURL + "Daerah/EditPDCascade",
            type: "POST",
            data: Pis,
            beforeSend: function() {
                $("#EditPisCascade").prop('disabled', true).text('Menyimpan...');
            },
            success: function(Respon) {
                handleResponse(Respon, 'ModalPisCascade', null);
                $("#EditPisCascade").prop('disabled', false).text('Simpan');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan: " + xhr.statusText);
                $("#EditPisCascade").prop('disabled', false).text('Simpan');
            }
        });
    });

    // ============================================================
    // MODAL CLEANUP
    // ============================================================

    $(".modal").on("hidden.bs.modal", function() {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    });

    $('#ModalTambahCascade').on('hidden.bs.modal', function() {
        $('#FormTambahCascade')[0].reset();
        $('#Visi').prop('disabled', true).html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
        $('#Misi').prop('disabled', true).html('<option value="" selected disabled>-- Pilih Visi terlebih dahulu --</option>');
    });

    $('#ModalEditCascade').on('hidden.bs.modal', function() {
        $('#FormEditCascade')[0].reset();
        $('#EditVisi').prop('disabled', true).html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
        $('#EditMisi').prop('disabled', true).html('<option value="" selected disabled>-- Pilih Visi terlebih dahulu --</option>');
    });

    $('#ModalTambahTujuanCascade').on('hidden.bs.modal', function() {
        $('#FormTambahTujuanCascade')[0].reset();
    });

    $('#ModalTambahSasaranCascade').on('hidden.bs.modal', function() {
        $('#FormTambahSasaranCascade')[0].reset();
    });

    $('#ModalTambahIndikatorCascade').on('hidden.bs.modal', function() {
        $('#FormTambahIndikatorCascade')[0].reset();
    });

    $('#ModalEditIndikatorCascade').on('hidden.bs.modal', function() {
        $('#FormEditIndikatorCascade')[0].reset();
    });

});
    </script>
</div>
</body>
</html>