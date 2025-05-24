<!-- Table View for Isu Strategis -->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsuStrategis">
                                <i class="notika-icon notika-edit"></i> <b>Input Isu Strategis</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                            <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">Kementerian</th>
                                        <th width="15%">Isu Strategis</th>
                                        <th width="15%">Permasalahan Pokok</th> <!-- Kolom baru -->
                                        <th width="15%">Isu KLHS</th>
                                        <th width="15%">Isu Global</th>
                                        <th width="15%">Isu Nasional</th>
                                        <th width="10%">Periode</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($IsuStrategis as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                    <td style="vertical-align: middle;"><?= $key['NamaIsuStrategis'] ?></td>                     
                                    <td style="vertical-align: top;">
                                    <div style="display: flex; flex-direction: column; height: 100%;">
                                        <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                            <button class="btn btn-sm btn-success TambahPermasalahan" 
                                                    title="Tambah Permasalahan Pokok"
                                                    data-id="<?= $key['Id'] ?>"
                                                    data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                    data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                    style="width: 30px; height: 30px; padding: 0;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <?php if (!empty($key['NamaPermasalahanPokok'])): ?>
                                            <button class="btn btn-sm btn-info DetailPermasalahan" 
                                                    title="Detail Permasalahan Pokok"
                                                    data-id="<?= $key['Id'] ?>"
                                                    data-permasalahan="<?= $key['IdPermasalahanPokok'] ?>"
                                                    data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                    data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                    style="width: 30px; height: 30px; padding: 0;">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                        <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                            <?php if (!empty($key['NamaPermasalahanPokok'])): ?>
                                                <?= htmlspecialchars($key['NamaPermasalahanPokok']) ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                    <!-- Isu KLHS -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahKLHS" 
                                                        title="Tambah Isu KLHS"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['NamaIsuKLHS'])): ?>
                                                <button class="btn btn-sm btn-info DetailKLHS" 
                                                        title="Detail Isu KLHS"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-klhs="<?= $key['IdIsuKLHS'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['NamaIsuKLHS'])): ?>
                                                    <?= htmlspecialchars($key['NamaIsuKLHS']) ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Isu Global -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahGlobal" 
                                                        title="Tambah Isu Global"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['NamaIsuGlobal'])): ?>
                                                <button class="btn btn-sm btn-info DetailGlobal" 
                                                        title="Detail Isu Global"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-global="<?= $key['IdIsuGlobal'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['NamaIsuGlobal'])): ?>
                                                    <?= htmlspecialchars($key['NamaIsuGlobal']) ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Isu Nasional -->
                                    <td style="vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; height: 100%;">
                                            <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                <button class="btn btn-sm btn-success TambahNasional" 
                                                        title="Tambah Isu Nasional"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <?php if (!empty($key['NamaIsuNasional'])): ?>
                                                <button class="btn btn-sm btn-info DetailNasional" 
                                                        title="Detail Isu Nasional"
                                                        data-id="<?= $key['Id'] ?>"
                                                        data-nasional="<?= $key['IdIsuNasional'] ?>"
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        style="width: 30px; height: 30px; padding: 0;">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                            <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                <?php if (!empty($key['NamaIsuNasional'])): ?>
                                                    <?= htmlspecialchars($key['NamaIsuNasional']) ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                    <td style="vertical-align: middle;">
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-edit="<?= $key['Id'] . '|' . $key['IdKementerian'] . '|' . $key['NamaIsuStrategis'] . '|' . $key['IdIsuKLHS'] . '|' . $key['IdIsuGlobal'] . '|' . $key['IdIsuNasional'] . '|' . $key['TahunMulai'] . '|' . $key['TahunAkhir'] ?>"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-hapus="<?= $key['Id'] ?>"
                                                    style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                <i class="notika-icon notika-trash"></i>
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

<!-- Modal Input Isu Strategis -->
<div class="modal fade" id="ModalInputIsuStrategis" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Input Isu Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="FormInputIsuStrategis">
                    <div class="form-example-wrap" style="padding: 5px;">
                        <!-- Periode -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Periode</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <select class="form-control" id="Periode" name="Periode" required>
                                                <option value="">-- Pilih Periode --</option>
                                                <?php foreach ($Periode as $periode) { ?>
                                                    <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>"><?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Kementerian -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Kementerian</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <select class="form-control" id="IdKementerian" name="IdKementerian" required>
                                                <option value="">-- Pilih Kementerian --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Permasalahan Pokok</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div id="permasalahan-container">
                                                <div class="form-group permasalahan-row">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]">
                                                                <option value="">-- Pilih Permasalahan Pokok --</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2" style="padding-top: 25px;">
                                                            <button type="button" class="btn btn-success btn-add-permasalahan">
                                                                <i class="notika-icon notika-plus-symbol"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Isu KLHS -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu KLHS</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div id="klhs-container">
                                            <div class="form-group klhs-row">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <select class="form-control klhs-select" name="IdIsuKLHS[]">
                                                            <option value="">-- Pilih Isu KLHS --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 25px;">
                                                        <button type="button" class="btn btn-success btn-add-klhs">
                                                            <i class="notika-icon notika-plus-symbol"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Isu Global -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu Global</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div id="global-container">
                                            <div class="form-group global-row">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <select class="form-control global-select" name="IdIsuGlobal[]">
                                                            <option value="">-- Pilih Isu Global --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 25px;">
                                                        <button type="button" class="btn btn-success btn-add-global">
                                                            <i class="notika-icon notika-plus-symbol"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Isu Nasional -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu Nasional</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div id="nasional-container">
                                            <div class="form-group nasional-row">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <select class="form-control nasional-select" name="IdIsuNasional[]">
                                                            <option value="">-- Pilih Isu Nasional --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 25px;">
                                                        <button type="button" class="btn btn-success btn-add-nasional">
                                                            <i class="notika-icon notika-plus-symbol"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Nama Isu Strategis -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Nama Isu Strategis</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="NamaIsuStrategis" name="NamaIsuStrategis" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tahun Mulai dan Akhir (hidden) -->
                        <input type="hidden" id="TahunMulai" name="TahunMulai">
                        <input type="hidden" id="TahunAkhir" name="TahunAkhir">
                        <!-- Submit Button -->
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-success notika-btn-success">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Isu Strategis -->
<div class="modal fade" id="ModalEditIsuStrategis" role="dialog">
    <div class="modal-dialog modal-large" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit Isu Strategis</h4>
            </div>
            <div class="modal-body">
                <form id="FormEditIsuStrategis">
                    <input type="hidden" id="EditId" name="Id">
                    <div class="form-example-wrap" style="padding: 5px;">
                        <!-- Periode -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Periode</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <select class="form-control" id="EditPeriode" name="Periode" required>
                                                <option value="">-- Pilih Periode --</option>
                                                <?php foreach ($Periode as $periode) { ?>
                                                    <option value="<?= $periode['TahunMulai'] . '|' . $periode['TahunAkhir'] ?>"><?= $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Kementerian -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Kementerian</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <select class="form-control" id="EditIdKementerian" name="IdKementerian" required>
                                                <option value="">-- Pilih Kementerian --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Permasalahan Pokok</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div id="edit-permasalahan-container">
                                            <!-- Rows will be added dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Isu KLHS -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu KLHS</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div id="edit-klhs-container">
                                            <!-- Rows will be added dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Isu Global -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu Global</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div id="edit-global-container">
                                            <!-- Rows will be added dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Isu Nasional -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu Nasional</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div id="edit-nasional-container">
                                            <!-- Rows will be added dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Nama Isu Strategis -->
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Nama Isu Strategis</b></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control input-sm" id="EditNamaIsuStrategis" name="NamaIsuStrategis" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tahun Mulai dan Akhir (hidden) -->
                        <input type="hidden" id="EditTahunMulai" name="TahunMulai">
                        <input type="hidden" id="EditTahunAkhir" name="TahunAkhir">
                        <!-- Submit Button -->
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-success notika-btn-success">UPDATE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Permasalahan Pokok -->
<div class="modal fade" id="ModalTambahPermasalahan" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah/Edit Permasalahan Pokok</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahPermasalahan">
                    <input type="hidden" id="PermasalahanId" name="Id">
                    <div id="permasalahan-table-container">
                        <!-- Rows will be added dynamically -->
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-success btn-add-permasalahan-row">
                            <i class="notika-icon notika-plus-symbol"></i> Tambah Permasalahan
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Isu KLHS -->
<div class="modal fade" id="ModalTambahKLHS" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah/Edit Isu KLHS</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahKLHS">
                    <input type="hidden" id="KLHSId" name="Id">
                    <div id="klhs-table-container">
                        <!-- Rows will be added dynamically -->
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-success btn-add-klhs-row">
                            <i class="notika-icon notika-plus-symbol"></i> Tambah Isu KLHS
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Isu Global -->
<div class="modal fade" id="ModalTambahGlobal" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah/Edit Isu Global</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahGlobal">
                    <input type="hidden" id="GlobalId" name="Id">
                    <div id="global-table-container">
                        <!-- Rows will be added dynamically -->
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-success btn-add-global-row">
                            <i class="notika-icon notika-plus-symbol"></i> Tambah Isu Global
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Isu Nasional -->
<div class="modal fade" id="ModalTambahNasional" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah/Edit Isu Nasional</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahNasional">
                    <input type="hidden" id="NasionalId" name="Id">
                    <div id="nasional-table-container">
                        <!-- Rows will be added dynamically -->
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-success btn-add-nasional-row">
                            <i class="notika-icon notika-plus-symbol"></i> Tambah Isu Nasional
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Permasalahan Pokok -->
<div class="modal fade" id="ModalDetailPermasalahan" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Detail Permasalahan Pokok</h4>
            </div>
            <div class="modal-body">
                <div id="permasalahan-detail-container">
                    <ul class="list-group">
                        <!-- Data will be populated dynamically -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Isu KLHS -->
<div class="modal fade" id="ModalDetailKLHS" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Detail Isu KLHS</h4>
            </div>
            <div class="modal-body">
                <div id="klhs-detail-container">
                    <ul class="list-group">
                        <!-- Data will be populated dynamically -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Isu Global -->
<div class="modal fade" id="ModalDetailGlobal" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Detail Isu Global</h4>
            </div>
            <div class="modal-body">
                <div id="global-detail-container">
                    <ul class="list-group">
                        <!-- Data will be populated dynamically -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Isu Nasional -->
<div class="modal fade" id="ModalDetailNasional" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Detail Isu Nasional</h4>
            </div>
            <div class="modal-body">
                <div id="nasional-detail-container">
                    <ul class="list-group">
                        <!-- Data will be populated dynamically -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>
<script>
var BaseURL = '<?= base_url() ?>';
jQuery(document).ready(function($) {
    // Function to populate dropdowns with proper error handling
    function populateDropdown(selectElement, data, selectedIds = [], defaultText = '-- Pilih --') {
        selectElement.html('<option value="">' + defaultText + '</option>');
        
        if (data && data.length > 0) {
            $.each(data, function(index, item) {
                var selected = selectedIds.includes(item.Id.toString()) ? 'selected' : '';
                var displayName = item.Nama || item.NamaKementerian || item.NamaIsuKLHS || 
                                item.NamaIsuGlobal || item.NamaIsuNasional || item.NamaPermasalahanPokok || '-';
                selectElement.append('<option value="' + item.Id + '" ' + selected + '>' + displayName + '</option>');
            });
        }
    }

    // Function to add new dropdown row
    function addRow(containerId, rowClass, selectClass, buttonClass) {
        var newRow = $(`#${containerId} .${rowClass}:first`).clone();
        newRow.find(`.${selectClass}`).val('');
        newRow.find(`.${buttonClass}`).removeClass(buttonClass).addClass('btn-remove-row')
            .html('<i class="notika-icon notika-trash"></i>')
            .removeClass('btn-success').addClass('btn-danger');
        $(`#${containerId}`).append(newRow);
    }

    // Handle add button clicks
    $(document).on('click', '.btn-add-klhs', function() {
        addRow('klhs-container', 'klhs-row', 'klhs-select', 'btn-add-klhs');
    });

    $(document).on('click', '.btn-add-global', function() {
        addRow('global-container', 'global-row', 'global-select', 'btn-add-global');
    });

    $(document).on('click', '.btn-add-nasional', function() {
        addRow('nasional-container', 'nasional-row', 'nasional-select', 'btn-add-nasional');
    });

    $(document).on('click', '.btn-add-permasalahan', function() {
        addRow('permasalahan-container', 'permasalahan-row', 'permasalahan-select', 'btn-add-permasalahan');
    });

    // Handle remove button click
    $(document).on('click', '.btn-remove-row', function() {
        if ($(`#${$(this).closest('.form-group').parent().attr('id')} .form-group`).length > 1) {
            $(this).closest('.form-group').remove();
        }
    });

    // Input Modal: Handle Periode change
    $("#Periode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [TahunMulai, TahunAkhir] = periode.split('|');
            $("#TahunMulai").val(TahunMulai);
            $("#TahunAkhir").val(TahunAkhir);
            
            // Load Kementerian
            $.post(BaseURL + "Super/GetKementerianByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir 
            }, function(data) {
                try {
                    populateDropdown($("#IdKementerian"), JSON.parse(data), '', '-- Pilih Kementerian --');
                } catch(e) {
                    console.error("Error parsing Kementerian data:", e);
                    $("#IdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
                }
            }).fail(function() {
                $("#IdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            });
            
            // Load Isu KLHS
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'KLHS'
            }, function(data) {
                try {
                    $('.klhs-select').each(function() {
                        populateDropdown($(this), JSON.parse(data), '', '-- Pilih Isu KLHS --');
                    });
                } catch(e) {
                    console.error("Error parsing Isu KLHS data:", e);
                    $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
                }
            }).fail(function() {
                $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
            });
            
            // Load Isu Global
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'Global'
            }, function(data) {
                try {
                    $('.global-select').each(function() {
                        populateDropdown($(this), JSON.parse(data), '', '-- Pilih Isu Global --');
                    });
                } catch(e) {
                    console.error("Error parsing Isu Global data:", e);
                    $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
                }
            }).fail(function() {
                $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
            });
            
            // Load Isu Nasional
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'Nasional'
            }, function(data) {
                try {
                    $('.nasional-select').each(function() {
                        populateDropdown($(this), JSON.parse(data), '', '-- Pilih Isu Nasional --');
                    });
                } catch(e) {
                    console.error("Error parsing Isu Nasional data:", e);
                    $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
                }
            }).fail(function() {
                $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
            });
            
            // Load Permasalahan Pokok
            $.post(BaseURL + "Super/GetPermasalahanByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    $('.permasalahan-select').each(function() {
                        populateDropdown($(this), JSON.parse(data), '', '-- Pilih Permasalahan Pokok --');
                    });
                } catch(e) {
                    console.error("Error parsing Permasalahan data:", e);
                    $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
                }
            }).fail(function() {
                $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
            });
        } else {
            $("#IdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
            $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
            $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
            $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
        }
    });

    // Edit Modal: Handle Periode change
    $("#EditPeriode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [TahunMulai, TahunAkhir] = periode.split('|');
            $("#EditTahunMulai").val(TahunMulai);
            $("#EditTahunAkhir").val(TahunAkhir);
            
            // Load Kementerian
            $.post(BaseURL + "Super/GetKementerianByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir 
            }, function(data) {
                try {
                    populateDropdown($("#EditIdKementerian"), JSON.parse(data), [], '-- Pilih Kementerian --');
                } catch(e) {
                    console.error("Error parsing Kementerian data:", e);
                    $("#EditIdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
                }
            }).fail(function() {
                $("#EditIdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            });
            
            // Load Isu KLHS
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'KLHS'
            }, function(data) {
                try {
                    var klhsData = JSON.parse(data);
                    $('.klhs-select').each(function() {
                        var selectedId = $(this).data('selected-id');
                        populateDropdown($(this), klhsData, selectedId ? [selectedId] : [], '-- Pilih Isu KLHS --');
                    });
                } catch(e) {
                    console.error("Error parsing Isu KLHS data:", e);
                    $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
                }
            }).fail(function() {
                $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
            });
            
            // Load Isu Global
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'Global'
            }, function(data) {
                try {
                    var globalData = JSON.parse(data);
                    $('.global-select').each(function() {
                        var selectedId = $(this).data('selected-id');
                        populateDropdown($(this), globalData, selectedId ? [selectedId] : [], '-- Pilih Isu Global --');
                    });
                } catch(e) {
                    console.error("Error parsing Isu Global data:", e);
                    $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
                }
            }).fail(function() {
                $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
            });
            
            // Load Isu Nasional
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'Nasional'
            }, function(data) {
                try {
                    var nasionalData = JSON.parse(data);
                    $('.nasional-select').each(function() {
                        var selectedId = $(this).data('selected-id');
                        populateDropdown($(this), nasionalData, selectedId ? [selectedId] : [], '-- Pilih Isu Nasional --');
                    });
                } catch(e) {
                    console.error("Error parsing Isu Nasional data:", e);
                    $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
                }
            }).fail(function() {
                $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
            });
            
            // Load Permasalahan Pokok
            $.post(BaseURL + "Super/GetPermasalahanByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    var permasalahanData = JSON.parse(data);
                    $('.permasalahan-select').each(function() {
                        var selectedId = $(this).data('selected-id');
                        populateDropdown($(this), permasalahanData, selectedId ? [selectedId] : [], '-- Pilih Permasalahan Pokok --');
                    });
                } catch(e) {
                    console.error("Error parsing Permasalahan data:", e);
                    $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
                }
            }).fail(function() {
                $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
            });
        } else {
            $("#EditIdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
            $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
            $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
            $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
        }
    });

    // Input Isu Strategis
    $("#FormInputIsuStrategis").submit(function(e) {
        e.preventDefault();
        if ($("#Periode").val() === "") {
            alert('Pilih Periode terlebih dahulu!');
            return;
        } else if ($("#IdKementerian").val() === "") {
            alert('Pilih Kementerian terlebih dahulu!');
            return;
        } else if ($("#NamaIsuStrategis").val() == "") {
            alert('Input Isu Strategis Belum Benar!');
            return;
        }
        
        var formData = $(this).serialize();
        
        $.post(BaseURL + "Super/InputIsuStrategis", formData)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert('Gagal menghubungi server. Silakan coba lagi.');
            });
    });

    // Edit Isu Strategis - Open Modal
    $(document).on("click", ".Edit", function() {
        var Data = $(this).data('edit');
        var Pisah = Data.split("|");
        
        $("#EditId").val(Pisah[0]);
        $("#EditIdKementerian").val(Pisah[1]);
        $("#EditNamaIsuStrategis").val(Pisah[2]);
        
        // Set periode first to trigger dropdown changes
        $("#EditPeriode").val(Pisah[6] + '|' + Pisah[7]).trigger('change');
        $("#EditTahunMulai").val(Pisah[6]);
        $("#EditTahunAkhir").val(Pisah[7]);
        
        // Clear existing rows
        $('#edit-klhs-container').empty();
        $('#edit-global-container').empty();
        $('#edit-nasional-container').empty();
        $('#edit-permasalahan-container').empty();
        
        // Add KLHS rows
        if (Pisah[3]) {
            var klhsIds = Pisah[3].split(',');
            klhsIds.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group klhs-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control klhs-select" name="IdIsuKLHS[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu KLHS --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-klhs">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#edit-klhs-container').append(newRow);
                }
            });
        } else {
            // Add one empty row if no KLHS
            var newRow = `
                <div class="form-group klhs-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control klhs-select" name="IdIsuKLHS[]">
                                <option value="">-- Pilih Isu KLHS --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-success btn-add-klhs">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#edit-klhs-container').append(newRow);
        }
        
        // Add Global rows
        if (Pisah[4]) {
            var globalIds = Pisah[4].split(',');
            globalIds.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group global-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control global-select" name="IdIsuGlobal[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu Global --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-global">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#edit-global-container').append(newRow);
                }
            });
        } else {
            // Add one empty row if no Global
            var newRow = `
                <div class="form-group global-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control global-select" name="IdIsuGlobal[]">
                                <option value="">-- Pilih Isu Global --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-success btn-add-global">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#edit-global-container').append(newRow);
        }
        
        // Add Nasional rows
        if (Pisah[5]) {
            var nasionalIds = Pisah[5].split(',');
            nasionalIds.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group nasional-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control nasional-select" name="IdIsuNasional[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu Nasional --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-nasional">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#edit-nasional-container').append(newRow);
                }
            });
        } else {
            // Add one empty row if no Nasional
            var newRow = `
                <div class="form-group nasional-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control nasional-select" name="IdIsuNasional[]">
                                <option value="">-- Pilih Isu Nasional --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-success btn-add-nasional">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#edit-nasional-container').append(newRow);
        }
        
        // Add Permasalahan rows
        if (Pisah[8]) {
            var permasalahanIds = Pisah[8].split(',');
            permasalahanIds.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group permasalahan-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Permasalahan Pokok --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-success btn-add-permasalahan">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#edit-permasalahan-container').append(newRow);
                }
            });
        } else {
            // Add one empty row if no Permasalahan
            var newRow = `
                <div class="form-group permasalahan-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]">
                                <option value="">-- Pilih Permasalahan Pokok --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-success btn-add-permasalahan">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#edit-permasalahan-container').append(newRow);
        }
        
        $('#ModalEditIsuStrategis').modal("show");
    });

    // Update Isu Strategis
    $("#FormEditIsuStrategis").submit(function(e) {
        e.preventDefault();
        if ($("#EditPeriode").val() === "") {
            alert('Pilih Periode terlebih dahulu!');
            return;
        } else if ($("#EditIdKementerian").val() === "") {
            alert('Pilih Kementerian terlebih dahulu!');
            return;
        } else if ($("#EditNamaIsuStrategis").val() == "") {
            alert('Input Nama Isu Strategis Belum Benar!');
            return;
        }
        
        var formData = $(this).serialize();
        
        $.post(BaseURL + "Super/UpdateIsuStrategis", formData)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert('Gagal menghubungi server. Silakan coba lagi.');
            });
    });

    // Delete Isu Strategis
    $(document).on("click", ".Hapus", function() {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            var Data = { Id: $(this).data('hapus') };
            $.post(BaseURL + "Super/DeleteIsuStrategis", Data)
                .done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                })
                .fail(function() {
                    alert('Gagal menghubungi server. Silakan coba lagi.');
                });
        }
    });

    // Handle Tambah/Edit Isu KLHS
    $(document).on('click', '.TambahKLHS, .EditKLHS', function() {
        var isEdit = $(this).hasClass('EditKLHS');
        var id = $(this).data('id');
        var klhsIds = isEdit ? $(this).data('klhs') : '';
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        $('#KLHSId').val(id);
        $('#klhs-table-container').empty();
        
        // Add rows for existing KLHS or one empty row
        if (isEdit && klhsIds) {
            var ids = klhsIds.split(',');
            ids.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group klhs-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control klhs-select" name="IdIsuKLHS[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu KLHS --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-danger btn-remove-row">
                                        <i class="notika-icon notika-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#klhs-table-container').append(newRow);
                }
            });
        } else {
            var newRow = `
                <div class="form-group klhs-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control klhs-select" name="IdIsuKLHS[]" required>
                                <option value="">-- Pilih Isu KLHS --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-danger btn-remove-row">
                                <i class="notika-icon notika-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#klhs-table-container').append(newRow);
        }
        
        // Load Isu KLHS options
        $.post(BaseURL + "Super/GetIsuByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            Jenis: 'KLHS'
        }, function(data) {
            try {
                $('.klhs-select').each(function() {
                    var selectedId = $(this).data('selected-id');
                    populateDropdown($(this), JSON.parse(data), selectedId ? [selectedId] : [], '-- Pilih Isu KLHS --');
                });
            } catch(e) {
                console.error("Error parsing Isu KLHS data:", e);
                $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
            }
        }).fail(function() {
            $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
        });
        
        $('#ModalTambahKLHS').modal('show');
    });

    // Handle Add KLHS Row
    $(document).on('click', '.btn-add-klhs-row', function() {
        var newRow = `
            <div class="form-group klhs-row">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control klhs-select" name="IdIsuKLHS[]" required>
                            <option value="">-- Pilih Isu KLHS --</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
        $('#klhs-table-container').append(newRow);
        
        // Reload options for the new select
        var TahunMulai = $('.TambahKLHS').data('tahunmulai') || $('.EditKLHS').data('tahunmulai');
        var TahunAkhir = $('.TambahKLHS').data('tahunakhir') || $('.EditKLHS').data('tahunakhir');
        
        if (TahunMulai && TahunAkhir) {
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'KLHS'
            }, function(data) {
                try {
                    $('#klhs-table-container .klhs-select').last().html('<option value="">-- Pilih Isu KLHS --</option>');
                    $.each(JSON.parse(data), function(index, item) {
                        $('#klhs-table-container .klhs-select').last().append('<option value="' + item.Id + '">' + (item.NamaIsuKLHS || '-') + '</option>');
                    });
                } catch(e) {
                    console.error("Error parsing Isu KLHS data:", e);
                    $('#klhs-table-container .klhs-select').last().html('<option value="">-- Pilih Isu KLHS --</option>');
                }
            }).fail(function() {
                $('#klhs-table-container .klhs-select').last().html('<option value="">-- Pilih Isu KLHS --</option>');
            });
        }
    });

    // Submit Form Tambah KLHS
    $("#FormTambahKLHS").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.post(BaseURL + "Super/UpdateIsuKLHSForStrategis", formData)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert('Gagal menghubungi server. Silakan coba lagi.');
            });
    });

    // Handle Tambah/Edit Isu Global
    $(document).on('click', '.TambahGlobal, .EditGlobal', function() {
        var isEdit = $(this).hasClass('EditGlobal');
        var id = $(this).data('id');
        var globalIds = isEdit ? $(this).data('global') : '';
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        $('#GlobalId').val(id);
        $('#global-table-container').empty();
        
        // Add rows for existing Global or one empty row
        if (isEdit && globalIds) {
            var ids = globalIds.split(',');
            ids.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group global-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control global-select" name="IdIsuGlobal[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu Global --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-danger btn-remove-row">
                                        <i class="notika-icon notika-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#global-table-container').append(newRow);
                }
            });
        } else {
            var newRow = `
                <div class="form-group global-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control global-select" name="IdIsuGlobal[]" required>
                                <option value="">-- Pilih Isu Global --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-danger btn-remove-row">
                                <i class="notika-icon notika-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#global-table-container').append(newRow);
        }
        
        // Load Isu Global options
        $.post(BaseURL + "Super/GetIsuByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            Jenis: 'Global'
        }, function(data) {
            try {
                $('.global-select').each(function() {
                    var selectedId = $(this).data('selected-id');
                    populateDropdown($(this), JSON.parse(data), selectedId ? [selectedId] : [], '-- Pilih Isu Global --');
                });
            } catch(e) {
                console.error("Error parsing Isu Global data:", e);
                $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
            }
        }).fail(function() {
            $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
        });
        
        $('#ModalTambahGlobal').modal('show');
    });

    // Handle Add Global Row
    $(document).on('click', '.btn-add-global-row', function() {
        var newRow = `
            <div class="form-group global-row">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control global-select" name="IdIsuGlobal[]" required>
                            <option value="">-- Pilih Isu Global --</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
        $('#global-table-container').append(newRow);
        
        // Reload options for the new select
        var TahunMulai = $('.TambahGlobal').data('tahunmulai') || $('.EditGlobal').data('tahunmulai');
        var TahunAkhir = $('.TambahGlobal').data('tahunakhir') || $('.EditGlobal').data('tahunakhir');
        
        if (TahunMulai && TahunAkhir) {
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'Global'
            }, function(data) {
                try {
                    $('#global-table-container .global-select').last().html('<option value="">-- Pilih Isu Global --</option>');
                    $.each(JSON.parse(data), function(index, item) {
                        $('#global-table-container .global-select').last().append('<option value="' + item.Id + '">' + (item.NamaIsuGlobal || '-') + '</option>');
                    });
                } catch(e) {
                    console.error("Error parsing Isu Global data:", e);
                    $('#global-table-container .global-select').last().html('<option value="">-- Pilih Isu Global --</option>');
                }
            }).fail(function() {
                $('#global-table-container .global-select').last().html('<option value="">-- Pilih Isu Global --</option>');
            });
        }
    });

    // Submit Form Tambah Global
    $("#FormTambahGlobal").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.post(BaseURL + "Super/UpdateIsuGlobalForStrategis", formData)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert('Gagal menghubungi server. Silakan coba lagi.');
            });
    });

    // Handle Tambah/Edit Isu Nasional
    $(document).on('click', '.TambahNasional, .EditNasional', function() {
        var isEdit = $(this).hasClass('EditNasional');
        var id = $(this).data('id');
        var nasionalIds = isEdit ? $(this).data('nasional') : '';
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        $('#NasionalId').val(id);
        $('#nasional-table-container').empty();
        
        // Add rows for existing Nasional or one empty row
        if (isEdit && nasionalIds) {
            var ids = nasionalIds.split(',');
            ids.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group nasional-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control nasional-select" name="IdIsuNasional[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu Nasional --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-danger btn-remove-row">
                                        <i class="notika-icon notika-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#nasional-table-container').append(newRow);
                }
            });
        } else {
            var newRow = `
                <div class="form-group nasional-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control nasional-select" name="IdIsuNasional[]" required>
                                <option value="">-- Pilih Isu Nasional --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-danger btn-remove-row">
                                <i class="notika-icon notika-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#nasional-table-container').append(newRow);
        }
        
        // Load Isu Nasional options
        $.post(BaseURL + "Super/GetIsuByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            Jenis: 'Nasional'
        }, function(data) {
            try {
                $('.nasional-select').each(function() {
                    var selectedId = $(this).data('selected-id');
                    populateDropdown($(this), JSON.parse(data), selectedId ? [selectedId] : [], '-- Pilih Isu Nasional --');
                });
            } catch(e) {
                console.error("Error parsing Isu Nasional data:", e);
                $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
            }
        }).fail(function() {
            $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
        });
        
        $('#ModalTambahNasional').modal('show');
    });

    // Handle Add Nasional Row
    $(document).on('click', '.btn-add-nasional-row', function() {
        var newRow = `
            <div class="form-group nasional-row">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control nasional-select" name="IdIsuNasional[]" required>
                            <option value="">-- Pilih Isu Nasional --</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
        $('#nasional-table-container').append(newRow);
        
        // Reload options for the new select
        var TahunMulai = $('.TambahNasional').data('tahunmulai') || $('.EditNasional').data('tahunmulai');
        var TahunAkhir = $('.TambahNasional').data('tahunakhir') || $('.EditNasional').data('tahunakhir');
        
        if (TahunMulai && TahunAkhir) {
            $.post(BaseURL + "Super/GetIsuByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir,
                Jenis: 'Nasional'
            }, function(data) {
                try {
                    $('#nasional-table-container .nasional-select').last().html('<option value="">-- Pilih Isu Nasional --</option>');
                    $.each(JSON.parse(data), function(index, item) {
                        $('#nasional-table-container .nasional-select').last().append('<option value="' + item.Id + '">' + (item.NamaIsuNasional || '-') + '</option>');
                    });
                } catch(e) {
                    console.error("Error parsing Isu Nasional data:", e);
                    $('#nasional-table-container .nasional-select').last().html('<option value="">-- Pilih Isu Nasional --</option>');
                }
            }).fail(function() {
                $('#nasional-table-container .nasional-select').last().html('<option value="">-- Pilih Isu Nasional --</option>');
            });
        }
    });

    // Submit Form Tambah Nasional
    $("#FormTambahNasional").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.post(BaseURL + "Super/UpdateIsuNasionalForStrategis", formData)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert('Gagal menghubungi server. Silakan coba lagi.');
            });
    });

    // Handle Tambah/Edit Permasalahan Pokok
    $(document).on('click', '.TambahPermasalahan, .EditPermasalahan', function() {
        var isEdit = $(this).hasClass('EditPermasalahan');
        var id = $(this).data('id');
        var permasalahanIds = isEdit ? $(this).data('permasalahan') : '';
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        $('#PermasalahanId').val(id);
        $('#permasalahan-table-container').empty();
        
        // Add rows for existing Permasalahan or one empty row
        if (isEdit && permasalahanIds) {
            var ids = permasalahanIds.split(',');
            ids.forEach(function(id) {
                if (id) {
                    var newRow = `
                        <div class="form-group permasalahan-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Permasalahan Pokok --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top: 25px;">
                                    <button type="button" class="btn btn-danger btn-remove-row">
                                        <i class="notika-icon notika-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    $('#permasalahan-table-container').append(newRow);
                }
            });
        } else {
            var newRow = `
                <div class="form-group permasalahan-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]" required>
                                <option value="">-- Pilih Permasalahan Pokok --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <button type="button" class="btn btn-danger btn-remove-row">
                                <i class="notika-icon notika-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
            $('#permasalahan-table-container').append(newRow);
        }
        
        // Load Permasalahan options
        $.post(BaseURL + "Super/GetPermasalahanByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir
        }, function(data) {
            try {
                $('.permasalahan-select').each(function() {
                    var selectedId = $(this).data('selected-id');
                    populateDropdown($(this), JSON.parse(data), selectedId ? [selectedId] : [], '-- Pilih Permasalahan Pokok --');
                });
            } catch(e) {
                console.error("Error parsing Permasalahan data:", e);
                $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
            }
        }).fail(function() {
            $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
        });
        
        $('#ModalTambahPermasalahan').modal('show');
    });

    // Handle Add Permasalahan Row
    $(document).on('click', '.btn-add-permasalahan-row', function() {
        var newRow = `
            <div class="form-group permasalahan-row">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]" required>
                            <option value="">-- Pilih Permasalahan Pokok --</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
        $('#permasalahan-table-container').append(newRow);
        
        // Reload options for the new select
        var TahunMulai = $('.TambahPermasalahan').data('tahunmulai') || $('.EditPermasalahan').data('tahunmulai');
        var TahunAkhir = $('.TambahPermasalahan').data('tahunakhir') || $('.EditPermasalahan').data('tahunakhir');
        
        if (TahunMulai && TahunAkhir) {
            $.post(BaseURL + "Super/GetPermasalahanByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    $('#permasalahan-table-container .permasalahan-select').last().html('<option value="">-- Pilih Permasalahan Pokok --</option>');
                    $.each(JSON.parse(data), function(index, item) {
                        $('#permasalahan-table-container .permasalahan-select').last().append('<option value="' + item.Id + '">' + (item.NamaPermasalahanPokok || '-') + '</option>');
                    });
                } catch(e) {
                    console.error("Error parsing Permasalahan data:", e);
                    $('#permasalahan-table-container .permasalahan-select').last().html('<option value="">-- Pilih Permasalahan Pokok --</option>');
                }
            }).fail(function() {
                $('#permasalahan-table-container .permasalahan-select').last().html('<option value="">-- Pilih Permasalahan Pokok --</option>');
            });
        }
    });

    // Submit Form Tambah Permasalahan
    $("#FormTambahPermasalahan").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        $.post(BaseURL + "Super/UpdatePermasalahanForStrategis", formData)
            .done(function(Respon) {
                if (Respon == '1') {
                    window.location.reload();
                } else {
                    alert(Respon);
                }
            })
            .fail(function() {
                alert('Gagal menghubungi server. Silakan coba lagi.');
            });
    });

    // Handle Detail Isu KLHS
    $(document).on('click', '.DetailKLHS', function() {
        var id = $(this).data('id');
        var klhsIds = $(this).data('klhs');
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        if (klhsIds) {
            $.post(BaseURL + "Super/GetIsuByIds", { 
                Ids: klhsIds,
                Jenis: 'KLHS',
                TahunMulai: TahunMulai,
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    var isuData = JSON.parse(data);
                    var listItems = '';
                    if (isuData && isuData.length > 0) {
                        $.each(isuData, function(index, item) {
                            listItems += '<li class="list-group-item">' + (item.NamaIsuKLHS || '-') + '</li>';
                        });
                    } else {
                        listItems = '<li class="list-group-item">Tidak ada data isu KLHS</li>';
                    }
                    $('#klhs-detail-container .list-group').html(listItems);
                    $('#ModalDetailKLHS').modal('show');
                } catch(e) {
                    console.error("Error parsing Isu KLHS data:", e);
                    $('#klhs-detail-container .list-group').html('<li class="list-group-item">Gagal memuat data</li>');
                    $('#ModalDetailKLHS').modal('show');
                }
            }).fail(function() {
                $('#klhs-detail-container .list-group').html('<li class="list-group-item">Gagal menghubungi server</li>');
                $('#ModalDetailKLHS').modal('show');
            });
        } else {
            $('#klhs-detail-container .list-group').html('<li class="list-group-item">Tidak ada data isu KLHS</li>');
            $('#ModalDetailKLHS').modal('show');
        }
    });

    // Handle Detail Isu Global
    $(document).on('click', '.DetailGlobal', function() {
        var id = $(this).data('id');
        var globalIds = $(this).data('global');
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        if (globalIds) {
            $.post(BaseURL + "Super/GetIsuByIds", { 
                Ids: globalIds,
                Jenis: 'Global',
                TahunMulai: TahunMulai,
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    var isuData = JSON.parse(data);
                    var listItems = '';
                    if (isuData && isuData.length > 0) {
                        $.each(isuData, function(index, item) {
                            listItems += '<li class="list-group-item">' + (item.NamaIsuGlobal || '-') + '</li>';
                        });
                    } else {
                        listItems = '<li class="list-group-item">Tidak ada data isu Global</li>';
                    }
                    $('#global-detail-container .list-group').html(listItems);
                    $('#ModalDetailGlobal').modal('show');
                } catch(e) {
                    console.error("Error parsing Isu Global data:", e);
                    $('#global-detail-container .list-group').html('<li class="list-group-item">Gagal memuat data</li>');
                    $('#ModalDetailGlobal').modal('show');
                }
            }).fail(function() {
                $('#global-detail-container .list-group').html('<li class="list-group-item">Gagal menghubungi server</li>');
                $('#ModalDetailGlobal').modal('show');
            });
        } else {
            $('#global-detail-container .list-group').html('<li class="list-group-item">Tidak ada data isu Global</li>');
            $('#ModalDetailGlobal').modal('show');
        }
    });

    // Handle Detail Isu Nasional
    $(document).on('click', '.DetailNasional', function() {
        var id = $(this).data('id');
        var nasionalIds = $(this).data('nasional');
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        if (nasionalIds) {
            $.post(BaseURL + "Super/GetIsuByIds", { 
                Ids: nasionalIds,
                Jenis: 'Nasional',
                TahunMulai: TahunMulai,
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    var isuData = JSON.parse(data);
                    var listItems = '';
                    if (isuData && isuData.length > 0) {
                        $.each(isuData, function(index, item) {
                            listItems += '<li class="list-group-item">' + (item.NamaIsuNasional || '-') + '</li>';
                        });
                    } else {
                        listItems = '<li class="list-group-item">Tidak ada data isu Nasional</li>';
                    }
                    $('#nasional-detail-container .list-group').html(listItems);
                    $('#ModalDetailNasional').modal('show');
                } catch(e) {
                    console.error("Error parsing Isu Nasional data:", e);
                    $('#nasional-detail-container .list-group').html('<li class="list-group-item">Gagal memuat data</li>');
                    $('#ModalDetailNasional').modal('show');
                }
            }).fail(function() {
                $('#nasional-detail-container .list-group').html('<li class="list-group-item">Gagal menghubungi server</li>');
                $('#ModalDetailNasional').modal('show');
            });
        } else {
            $('#nasional-detail-container .list-group').html('<li class="list-group-item">Tidak ada data isu Nasional</li>');
            $('#ModalDetailNasional').modal('show');
        }
    });

    // Handle Detail Permasalahan Pokok
    $(document).on('click', '.DetailPermasalahan', function() {
        var id = $(this).data('id');
        var permasalahanIds = $(this).data('permasalahanpokok');
        var TahunMulai = $(this).data('TahunMulai');
        var TahunAkhir = $(this).data('TahunAkhir');
        
        if (permasalahanIds) {
            $.post(BaseURL + "Super/GetPermasalahanByIds", { 
                Ids: permasalahanIds,
                TahunMulai: TahunMulai,
                TahunAkhir: TahunAkhir
            }, function(data) {
                try {
                    var permasalahanData = JSON.parse(data);
                    var listItems = '';
                    if (permasalahanData && permasalahanData.length > 0) {
                        $.each(permasalahanData, function(index, item) {
                            listItems += '<li class="list-group-item">' + (item.NamaPermasalahanPokok || '-') + '</li>';
                        });
                    } else {
                        listItems = '<li class="list-group-item">Tidak ada data permasalahan</li>';
                    }
                    $('#permasalahan-detail-container .list-group').html(listItems);
                    $('#ModalDetailPermasalahan').modal('show');
                } catch(e) {
                    console.error("Error parsing Permasalahan data:", e);
                    $('#permasalahan-detail-container .list-group').html('<li class="list-group-item">Gagal memuat data</li>');
                    $('#ModalDetailPermasalahan').modal('show');
                }
            }).fail(function() {
                $('#permasalahan-detail-container .list-group').html('<li class="list-group-item">Gagal menghubungi server</li>');
                $('#ModalDetailPermasalahan').modal('show');
            });
        } else {
            $('#permasalahan-detail-container .list-group').html('<li class="list-group-item">Tidak ada data permasalahan</li>');
            $('#ModalDetailPermasalahan').modal('show');
        }
    });
});
</script>
