<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalTambahIkd">
                                <i class="notika-icon notika-edit"></i> <b>Tambah IKD</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="15%">Sasaran</th>
                                    <th width="15%">Indikator Sasaran</th>
                                    <th width="10%" class="text-center">Periode</th>
                                    <th width="12%" class="text-center">PD Penanggung Jawab</th>
                                    <th width="12%" class="text-center">PD Penunjang</th>
                                    <th width="12%" class="text-center">Isu Strategis Daerah</th>
                                    <th width="6%" class="text-center">Target <br><small>Tahun 1</small></th>
                                    <th width="6%" class="text-center">Target <br><small>Tahun 2</small></th>
                                    <th width="6%" class="text-center">Target <br><small>Tahun 3</small></th>
                                    <th width="6%" class="text-center">Target <br><small>Tahun 4</small></th>
                                    <th width="6%" class="text-center">Target <br><small>Tahun 5</small></th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Ikd as $key) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: top;"><?= $No++ ?></td>
                                    <td style="vertical-align: top;">
                                        <?php
                                        $sasaran = $this->db->where('Id', $key['IdSasaran'])->get('sasaranrpjmd')->row_array();
                                        echo $sasaran ? $sasaran['Sasaran'] : '-';
                                        ?>
                                    </td>
                                    <td style="vertical-align: top;"><?= $key['indikator_sasaran'] ?></td>
                                    <td style="vertical-align: top;" class="text-center">
                                        <?= $key['tahun_mulai'] ?> - <?= $key['tahun_akhir'] ?>
                                    </td>
                                    
                                    <!-- Kolom PD Penanggung Jawab -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahPj" 
                                                        title="Tambah PD Penanggung Jawab"
                                                        data-id="<?= $key['id'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['pd_penanggung_jawab'])): ?>
                                                <button class="btn btn-sm btn-primary Pic" 
                                                        title="Edit PD Penanggung Jawab"
                                                        Pic="<?=$key['id'].'|'.$key['pd_penanggung_jawab']?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['pd_penanggung_jawab'])): ?>
                                                    <?php 
                                                    $penanggungJawab = explode(',', $key['pd_penanggung_jawab']);
                                                    foreach ($penanggungJawab as $pj): 
                                                    ?>
                                                        <div style="padding: 2px 0; white-space: nowrap;"><?= $pj ?></div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Kolom PD Penunjang -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahPn" 
                                                        title="Tambah PD Penunjang"
                                                        data-id="<?= $key['id'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['pd_penunjang'])): ?>
                                                <button class="btn btn-sm btn-primary Pis" 
                                                        title="Edit PD Penunjang"
                                                        Pis="<?=$key['id'].'|'.$key['pd_penunjang']?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['pd_penunjang'])): ?>
                                                    <?php 
                                                    $penunjang = explode(',', $key['pd_penunjang']);
                                                    foreach ($penunjang as $pn): 
                                                    ?>
                                                        <div style="padding: 2px 0; white-space: nowrap;"><?= $pn ?></div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- In the table body (add this after the PD Penunjang cell) -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahIsu" 
                                                        title="Tambah Isu Strategis"
                                                        data-id="<?= $key['id'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['isu_strategis'])): ?>
                                                <button class="btn btn-sm btn-primary EditIsu" 
                                                        title="Edit Isu Strategis"
                                                        data-isi="<?=$key['id'].'|'.$key['isu_strategis']?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['isu_strategis'])): ?>
                                                    <?php 
                                                    $isuStrategis = explode(',', $key['isu_strategis']);
                                                    foreach ($isuStrategis as $isu): 
                                                        $isuData = $this->db->where('Id', $isu)->get('isustrategisdaerah')->row_array();
                                                        if($isuData):
                                                    ?>
                                                        <div style="padding: 2px 0; white-space: nowrap;"><?= $isuData['NamaIsuStrategis'] ?></div>
                                                    <?php 
                                                        endif;
                                                    endforeach; 
                                                    ?>
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
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div style="display: flex; justify-content: center; gap: 5px;">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['id'] ?>" 
                                                    data-sasaran="<?= $key['IdSasaran'] ?>" 
                                                    data-indikator-sasaran="<?= $key['indikator_sasaran'] ?>"
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
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-id="<?= $key['id'] ?>"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                <i class="notika-icon notika-trash" style="font-size: 15px;"></i>
                                            </button>
                                        </div>
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

<!-- Modal Tambah IKD -->
<div class="modal fade" id="ModalTambahIkd" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahIkd">
                    <!-- Tahun Filter Dropdown -->
                    <div class="form-group">
                        <label for="TahunFilter">Periode Tahun</label>
                        <select class="form-control" id="TahunFilter" name="TahunFilter" required>
                            <option value="" selected disabled>-- Pilih Tahun --</option>
                            <?php foreach ($Periods as $period) { ?>
                                <option value="<?= $period['TahunMulai'].'-'.$period['TahunAkhir'] ?>">
                                    <?= $period['TahunMulai'].' - '.$period['TahunAkhir'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Dropdown Sasaran -->
                    <div class="form-group">
                        <label for="Sasaran">Sasaran</label>
                        <select class="form-control" id="Sasaran" name="Sasaran" required disabled>
                            <option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="IndikatorSasaran">Indikator Sasaran (IKD)</label>
                        <textarea class="form-control" id="IndikatorSasaran" name="indikator_sasaran" rows="3" required></textarea>
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

<!-- Modal Edit IKD -->
<div class="modal fade" id="ModalEditIkd" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormEditIkd">
                    <input type="hidden" id="EditId" name="id">

                    <!-- Periode Dropdown -->
                    <div class="form-group">
                        <label for="EditPeriode">Periode Tahun</label>
                        <select class="form-control" id="EditPeriode" name="periode" required>
                            <option value="" selected disabled>-- Pilih Tahun --</option>
                            <?php foreach ($Periods as $period) { ?>
                                <option value="<?= $period['TahunMulai'].'-'.$period['TahunAkhir'] ?>">
                                    <?= $period['TahunMulai'].' - '.$period['TahunAkhir'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Dropdown Sasaran -->
                    <div class="form-group">
                        <label for="EditSasaran">Sasaran</label>
                        <select class="form-control" id="EditSasaran" name="EditSasaran" required disabled>
                            <option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="EditIndikatorSasaran">Indikator Sasaran (IKD)</label>
                        <textarea class="form-control" id="EditIndikatorSasaran" name="indikator_sasaran" rows="3" required></textarea>
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

<!-- Modal Tambah Isu Strategis -->
<div class="modal fade" id="ModalTambahIsu" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Isu Strategis Daerah</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahIsu">
                    <input type="hidden" id="IsuId" name="id">
                    <div id="isu-container">
                        <div class="form-group isu-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <label>Isu Strategis Daerah</label>
                                    <select class="form-control isu-select" name="isu_strategis[]" required>
                                        <option value="">Pilih Isu Strategis</option>
                                        <?php 
                                        $allIsu = $this->db->where('KodeWilayah', $_SESSION['KodeWilayah'])
                                                          ->where('deleted_at IS NULL')
                                                          ->get('isustrategisdaerah')
                                                          ->result_array();
                                        foreach ($allIsu as $isu): ?>
                                            <option value="<?= $isu['Id'] ?>"><?= $isu['NamaIsuStrategis'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-isu">
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

<!-- Modal Edit Isu Strategis -->
<div class="modal fade" id="ModalEditIsu" role="dialog">
    <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Isu Strategis Daerah</h4>
            </div>
            <div class="modal-body">
                <div class="form-example-wrap">
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="nk-int-st text-justify">
                                        <input type="hidden" class="form-control input-sm" id="IdIKDIsu">
                                        <div id="ListIsu"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int">
                        <div class="row">
                            <div class="col-lg-12">
                                <button class="btn btn-success" id="EditIsu">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah PD Penanggung Jawab -->
<div class="modal fade" id="ModalTambahPj" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahPj">
                    <input type="hidden" id="PjId" name="id">
                    <div id="pj-container">
                        <div class="form-group pj-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <label>PD Penanggung Jawab</label>
                                    <select class="form-control pj-select" name="pd_penanggung_jawab[]" required>
                                        <option value="">Pilih PD Penanggung Jawab</option>
                                        <option value="Semua Instansi Terkait">Semua Instansi Terkait</option>
                                        <?php foreach ($Instansi as $instansi) { ?>
                                            <option value="<?= $instansi['nama'] ?>"><?= $instansi['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-pj">
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

<!-- Modal Tambah PD Penunjang -->
<div class="modal fade" id="ModalTambahPn" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahPn">
                    <input type="hidden" id="PnId" name="id">
                    <div id="pn-container">
                        <div class="form-group pn-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <label>PD Penunjang</label>
                                    <select class="form-control pn-select" name="pd_penunjang[]" required>
                                        <option value="">Pilih PD Penunjang</option>
                                        <option value="Semua Instansi Terkait">Semua Instansi Terkait</option>
                                        <?php foreach ($Instansi as $instansi) { ?>
                                            <option value="<?= $instansi['nama'] ?>"><?= $instansi['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-pn">
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

<!-- Modal Edit PD Penanggung Jawab -->
<div class="modal fade" id="ModalPic" role="dialog">
    <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit PD Penanggung Jawab</h4>
            </div>
            <div class="modal-body">
                <div class="form-example-wrap">
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="nk-int-st text-justify">
                                        <input type="hidden" class="form-control input-sm" id="IdIKDPic">
                                        <div id="ListPic"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int">
                        <div class="row">
                            <div class="col-lg-12">
                                <button class="btn btn-success" id="EditPic">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit PD Penunjang -->
<div class="modal fade" id="ModalPis" role="dialog">
    <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit PD Penunjang</h4>
            </div>
            <div class="modal-body">
                <div class="form-example-wrap">
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="nk-int-st text-justify">
                                        <input type="hidden" class="form-control input-sm" id="IdIKDPis">
                                        <div id="ListPis"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int">
                        <div class="row">
                            <div class="col-lg-12">
                                <button class="btn btn-success" id="EditPis">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
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
    var instansiOptions = <?php echo json_encode($Instansi); ?>;
    
    $(document).ready(function() {
        
        // Inisialisasi variabel untuk menyimpan data input terakhir
        // Mencoba mendapatkan data dari localStorage jika ada
        var storedData = localStorage.getItem('ikdLastInputData');
        var lastInputData = storedData ? JSON.parse(storedData) : {};
        
        // Function to add new PD Penanggung Jawab dropdown
        $(document).on('click', '.btn-add-pj', function() {
            var newRow = $('<div class="form-group pj-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<select class="form-control pj-select" name="pd_penanggung_jawab[]" required>' +
                '<option value="">Pilih PD Penanggung Jawab</option>' +
                '<option value="Semua Instansi Terkait">Semua Instansi Terkait</option>' +
                getInstansiOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 7px;">' +
                '<button type="button" class="btn btn-danger btn-remove-pj">' +
                '<i class="notika-icon notika-trash"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            
            $('#pj-container').append(newRow);
        });

        // Function to add new PD Penunjang dropdown
        $(document).on('click', '.btn-add-pn', function() {
            var newRow = $('<div class="form-group pn-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<select class="form-control pn-select" name="pd_penunjang[]" required>' +
                '<option value="">Pilih PD Penunjang</option>' +
                '<option value="Semua Instansi Terkait">Semua Instansi Terkait</option>' +
                getInstansiOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 7px;">' +
                '<button type="button" class="btn btn-danger btn-remove-pn">' +
                '<i class="notika-icon notika-trash"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            
            $('#pn-container').append(newRow);
        });

        // Function to remove PD Penanggung Jawab dropdown
        $(document).on('click', '.btn-remove-pj', function() {
            if($('.pj-row').length > 1) {
                $(this).closest('.pj-row').remove();
            } else {
                alert('Minimal harus ada satu PD Penanggung Jawab');
            }
        });

        // Function to remove PD Penunjang dropdown
        $(document).on('click', '.btn-remove-pn', function() {
            if($('.pn-row').length > 1) {
                $(this).closest('.pn-row').remove();
            } else {
                alert('Minimal harus ada satu PD Penunjang');
            }
        });

        // Function to generate instansi options
        function getInstansiOptions() {
            var options = '';
            instansiOptions.forEach(function(instansi) {
                options += '<option value="' + instansi.nama + '">' + instansi.nama + '</option>';
            });
            return options;
        }
        // Load sasaran when tahun filter changes
        $('#TahunFilter').change(function() {
            if ($(this).val()) {
                $('#Sasaran').prop('disabled', false);
                $('#Sasaran').html('<option value="">-- Pilih Sasaran --</option>');
                
                var tahunRange = $(this).val().split('-');
                var tahunMulai = tahunRange[0];
                var tahunAkhir = tahunRange[1];
                
                $.ajax({
                    url: BaseURL + 'Daerah/GetSasaranByPeriod',
                    type: 'POST',
                    data: {
                        tahun_mulai: tahunMulai,
                        tahun_akhir: tahunAkhir
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $.each(data, function(key, value) {
                            $('#Sasaran').append('<option value="' + value.Id + '">' + value.Sasaran + '</option>');
                        });
                    }
                });
            } else {
                $('#Sasaran').prop('disabled', true);
                $('#Sasaran').html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
            }
        });

        // Edit IKD - Load data
        $(".Edit").click(function() {
            var id = $(this).data('id');
            var IdSasaran = $(this).data('sasaran');
            var indikatorSasaran = $(this).data('indikator-sasaran');
            var target1 = $(this).data('target1');
            var target2 = $(this).data('target2');
            var target3 = $(this).data('target3');
            var target4 = $(this).data('target4');
            var target5 = $(this).data('target5');
            var tahunMulai = $(this).data('tahunmulai');
            var tahunAkhir = $(this).data('tahunakhir');

            // Reset form first
            $("#EditId").val(id);
            $("#EditPeriode").val('');
            $("#EditSasaran").html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
            $("#EditSasaran").prop('disabled', true);
            $("#EditIndikatorSasaran").val(indikatorSasaran);
            $("#EditTarget1").val(target1 || '');
            $("#EditTarget2").val(target2 || '');
            $("#EditTarget3").val(target3 || '');
            $("#EditTarget4").val(target4 || '');
            $("#EditTarget5").val(target5 || '');

            // Set the period value and trigger change
            $("#EditPeriode").val(tahunMulai + '-' + tahunAkhir).trigger('change');
            
            // Setelah sasaran di-load, set nilai sasaran yang dipilih
            var checkSasaranExist = setInterval(function() {
                if($('#EditSasaran option[value="'+IdSasaran+'"]').length > 0) {
                    $('#EditSasaran').val(IdSasaran);
                    clearInterval(checkSasaranExist);
                }
            }, 100);
            
            // Show modal
            $("#ModalEditIkd").modal('show');
        });

        // Handle period change in edit modal (IKD)
        $('#EditPeriode').change(function() {
            if ($(this).val()) {
                // Enable dropdown sasaran
                $('#EditSasaran').prop('disabled', false);
                
                // Kosongkan dan tambah opsi default
                $('#EditSasaran').html('<option value="">-- Pilih Sasaran --</option>');
                
                // Load sasaran berdasarkan periode
                var tahunRange = $(this).val().split('-');
                var tahunMulai = tahunRange[0];
                var tahunAkhir = tahunRange[1];
                
                $.ajax({
                    url: BaseURL + 'Daerah/GetSasaranByPeriod',
                    type: 'POST',
                    data: {
                        tahun_mulai: tahunMulai,
                        tahun_akhir: tahunAkhir
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if(data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#EditSasaran').append('<option value="' + value.Id + '">' + value.Sasaran + '</option>');
                            });
                        } else {
                            $('#EditSasaran').html('<option value="" selected disabled>-- Tidak ada sasaran untuk periode ini --</option>');
                            $('#EditSasaran').prop('disabled', true);
                        }
                    }
                });
            } else {
                // Jika tidak ada periode yang dipilih, disable dropdown sasaran
                $('#EditSasaran').prop('disabled', true);
                $('#EditSasaran').html('<option value="" selected disabled>-- Pilih Periode Tahun terlebih dahulu --</option>');
            }
        });

        // Edit IKD form submission
        $("#FormEditIkd").submit(function(e) {
            e.preventDefault();
            
            // Validasi form
            if ($('#EditPeriode').val() === "" || $('#EditPeriode').val() === null) {
                alert('Silakan pilih periode tahun terlebih dahulu!');
                return false;
            }
            if ($('#EditSasaran').val() === "" || $('#EditSasaran').val() === null) {
                alert('Silakan pilih sasaran terlebih dahulu!');
                return false;
            }
            if ($('#EditIndikatorSasaran').val() === "") {
                alert('Silakan isi indikator sasaran!');
                return false;
            }

            $.ajax({
                url: BaseURL + "Daerah/EditIkd",
                type: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert(res || "Gagal mengupdate data!");
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.statusText);
                }
            });
        });

        // Hapus IKD
        $(".Hapus").click(function() {
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var id = $(this).data('id');
                $.post(BaseURL + "Daerah/HapusIkd", { id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menghapus data: " + res);
                    }
                });
            }
        });

        // Tambah PD Penanggung Jawab
        $(".TambahPj").click(function() {
            var id = $(this).data('id');
            $("#PjId").val(id);
            $("#pj-container").html('<div class="form-group pj-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<label>PD Penanggung Jawab</label>' +
                '<select class="form-control pj-select" name="pd_penanggung_jawab[]" required>' +
                '<option value="">Pilih PD Penanggung Jawab</option>' +
                '<option value="Semua Instansi Terkait">Semua Instansi Terkait</option>' +
                getInstansiOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 25px;">' +
                '<button type="button" class="btn btn-success btn-add-pj">' +
                '<i class="notika-icon notika-plus-symbol"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            $("#ModalTambahPj").modal('show');
        });

        $("#FormTambahPj").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            // Combine multiple PD selections into comma-separated string
            var pdValues = [];
            $('select[name="pd_penanggung_jawab[]"]').each(function() {
                if($(this).val()) {
                    pdValues.push($(this).val());
                }
            });
            
            // Replace array with combined string
            formData = formData.filter(item => item.name !== 'pd_penanggung_jawab[]');
            formData.push({name: 'pd_penanggung_jawab', value: pdValues.join(',')});
            
            $.post(BaseURL + "Daerah/TambahPd", $.param(formData)).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal menambahkan PD Penanggung Jawab: " + res);
                }
            });
        });

        // Tambah PD Penunjang
        $(".TambahPn").click(function() {
            var id = $(this).data('id');
            $("#PnId").val(id);
            $("#pn-container").html('<div class="form-group pn-row">' +
                '<div class="row">' +
                '<div class="col-md-10">' +
                '<label>PD Penunjang</label>' +
                '<select class="form-control pn-select" name="pd_penunjang[]" required>' +
                '<option value="">Pilih PD Penunjang</option>' +
                '<option value="Semua Instansi Terkait">Semua Instansi Terkait</option>' +
                getInstansiOptions() +
                '</select>' +
                '</div>' +
                '<div class="col-md-2" style="padding-top: 25px;">' +
                '<button type="button" class="btn btn-success btn-add-pn">' +
                '<i class="notika-icon notika-plus-symbol"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>');
            $("#ModalTambahPn").modal('show');
        });

        $("#FormTambahPn").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            // Combine multiple PD selections into comma-separated string
            var pdValues = [];
            $('select[name="pd_penunjang[]"]').each(function() {
                if($(this).val()) {
                    pdValues.push($(this).val());
                }
            });
            
            // Replace array with combined string
            formData = formData.filter(item => item.name !== 'pd_penunjang[]');
            formData.push({name: 'pd_penunjang', value: pdValues.join(',')});
            
            $.post(BaseURL + "Daerah/TambahPd", $.param(formData)).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert("Gagal menambahkan PD Penunjang: " + res);
                }
            });
        });

        $(".Pic").click(function() {
            var Data = $(this).attr('Pic').split("|");
            $("#IdIKDPic").val(Data[0]);
            var Pisah = Data[1].split(",");
            var List = '';
            for (let i = 0; i < Pisah.length; i++) {
                List += '<label><input style="margin-top: 10px;" type="checkbox" checked name="Pic" value="'+Pisah[i]+'"> '+Pisah[i]+'</label><br>';    
            }
            $("#ListPic").html(List);
            $("#ModalPic").modal('show');
        });

        $("#EditPic").click(function() {
            var Tampung = [];
            $.each($("input[name='Pic']:checked"), function(){
                Tampung.push($(this).val());
            });
            var Pic = {
                id: $("#IdIKDPic").val(),
                pd_penanggung_jawab: Tampung.join(",")
            };
            $.post(BaseURL + "Daerah/EditPDIKD", Pic).done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            });
        });

        $(".Pis").click(function() {
            var Data = $(this).attr('Pis').split("|");
            $("#IdIKDPis").val(Data[0]);
            var Pisah = Data[1].split(",");
            var List = '';
            for (let i = 0; i < Pisah.length; i++) {
                List += '<label><input style="margin-top: 10px;" type="checkbox" checked name="Pis" value="'+Pisah[i]+'"> '+Pisah[i]+'</label><br>';    
            }
            $("#ListPis").html(List);
            $("#ModalPis").modal('show');
        });

        $("#EditPis").click(function() {
            var Tampung = [];
            $.each($("input[name='Pis']:checked"), function(){
                Tampung.push($(this).val());
            });
            var Pis = {
                id: $("#IdIKDPis").val(),
                pd_penunjang: Tampung.join(",")
            };
            $.post(BaseURL + "Daerah/EditPDIKD", Pis).done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            });
        });

        function getIsuStrategisOptions() {
                var options = '';
                <?php 
                $allIsu = $this->db->where('KodeWilayah', $_SESSION['KodeWilayah'])
                                ->where('deleted_at IS NULL')
                                ->get('isustrategisdaerah')
                                ->result_array();
                foreach ($allIsu as $isu): ?>
                    options += '<option value="<?= $isu['Id'] ?>"><?= $isu['NamaIsuStrategis'] ?></option>';
                <?php endforeach; ?>
                return options;
            }

            // Add new Isu Strategis dropdown
            $(document).on('click', '.btn-add-isu', function() {
                var newRow = $('<div class="form-group isu-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<select class="form-control isu-select" name="isu_strategis[]" required>' +
                    '<option value="">Pilih Isu Strategis</option>' +
                    getIsuStrategisOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 7px;">' +
                    '<button type="button" class="btn btn-danger btn-remove-isu">' +
                    '<i class="notika-icon notika-trash"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                
                $('#isu-container').append(newRow);
            });

            // Remove Isu Strategis dropdown
            $(document).on('click', '.btn-remove-isu', function() {
                if($('.isu-row').length > 1) {
                    $(this).closest('.isu-row').remove();
                } else {
                    alert('Minimal harus ada satu Isu Strategis');
                }
            });

            // Tambah Isu Strategis button click
            $(".TambahIsu").click(function() {
                var id = $(this).data('id');
                $("#IsuId").val(id);
                $("#isu-container").html('<div class="form-group isu-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<label>Isu Strategis Daerah</label>' +
                    '<select class="form-control isu-select" name="isu_strategis[]" required>' +
                    '<option value="">Pilih Isu Strategis</option>' +
                    getIsuStrategisOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 25px;">' +
                    '<button type="button" class="btn btn-success btn-add-isu">' +
                    '<i class="notika-icon notika-plus-symbol"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $("#ModalTambahIsu").modal('show');
            });

            // Form submission for adding Isu Strategis
            $("#FormTambahIsu").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                // Combine multiple Isu selections into comma-separated string
                var isuValues = [];
                $('select[name="isu_strategis[]"]').each(function() {
                    if($(this).val()) {
                        isuValues.push($(this).val());
                    }
                });
                
                // Replace array with combined string
                formData = formData.filter(item => item.name !== 'isu_strategis[]');
                formData.push({name: 'isu_strategis', value: isuValues.join(',')});
                
                $.post(BaseURL + "Daerah/TambahIsuStrategis", $.param(formData)).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menambahkan Isu Strategis: " + res);
                    }
                });
            });

            // Edit Isu Strategis button click
            $(".EditIsu").click(function() {
                var Data = $(this).attr('data-isi').split("|");
                $("#IdIKDIsu").val(Data[0]);
                var Pisah = Data[1].split(",");
                var List = '';
                
                <?php 
                $allIsu = $this->db->where('KodeWilayah', $_SESSION['KodeWilayah'])
                                ->where('deleted_at IS NULL')
                                ->get('isustrategisdaerah')
                                ->result_array();
                foreach ($allIsu as $isu): ?>
                    var isChecked = Pisah.includes("<?= $isu['Id'] ?>") ? 'checked' : '';
                    List += '<label><input style="margin-top: 10px;" type="checkbox" '+isChecked+' name="Isu" value="<?= $isu['Id'] ?>"> <?= $isu['NamaIsuStrategis'] ?></label><br>';    
                <?php endforeach; ?>
                
                $("#ListIsu").html(List);
                $("#ModalEditIsu").modal('show');
            });

            // Save edited Isu Strategis
            $("#EditIsu").click(function() {
                var Tampung = [];
                $.each($("input[name='Isu']:checked"), function(){
                    Tampung.push($(this).val());
                });
                var Isu = {
                    id: $("#IdIKDIsu").val(),
                    isu_strategis: Tampung.join(",")
                };
                $.post(BaseURL + "Daerah/EditIsuStrategis", Isu).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            });                             

        // Function to validate integer inputs
        function validateIntegerInputs(formId) {
            var isValid = true;
            $('#' + formId + ' input[type="number"]').each(function() {
                if(this.value && !Number.isInteger(parseFloat(this.value))) {
                    alert('Harap masukkan angka bulat untuk semua target!');
                    isValid = false;
                    return false; // break out of loop
                }
            });
            return isValid;
        }
    });
</script>