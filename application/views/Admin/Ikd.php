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
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Sasaran</th>
                                    <th>Indikator Sasaran (IKD)</th>
                                    <th class="text-center">PD Penanggung Jawab</th>
                                    <th class="text-center">PD Penunjang</th>
                                    <th class="text-center">Target <br><small>Tahun 1</small></th>
                                    <th class="text-center">Target <br><small>Tahun 2</small></th>
                                    <th class="text-center">Target <br><small>Tahun 3</small></th>
                                    <th class="text-center">Target <br><small>Tahun 4</small></th>
                                    <th class="text-center">Target <br><small>Tahun 5</small></th>
                                    <th style="width: 10%;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Ikd as $key) { ?>
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php
                                        $sasaran = $this->db->where('Id', $key['IdSasaran'])->get('sasaranrpjmd')->row_array();
                                        echo $sasaran ? $sasaran['Sasaran'] : '-';
                                        ?>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $key['indikator_sasaran'] ?></td>
                                    <td style="vertical-align: middle;" class="text-center">
                                    <button class="btn btn-sm btn-success amber-icon-notika btn-reco-mg btn-button-mg TambahPj" 
                                                title="Tambah PD Penanggung Jawab"
                                                data-id="<?= $key['id'] ?>">
                                            <i class="notika-icon notika-plus-symbol"></i>
                                        </button>
                                        <?php if (!empty($key['pd_penanggung_jawab'])): ?>
                                            <button class="btn btn-sm btn-primary amber-icon-notika btn-reco-mg btn-button-mg Pic" 
                                                    title="Edit PD Penanggung Jawab"
                                                    Pic="<?=$key['id'].'|'.$key['pd_penanggung_jawab']?>">
                                                <i class="notika-icon notika-support"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                    <button class="btn btn-sm btn-success amber-icon-notika btn-reco-mg btn-button-mg TambahPn" 
                                                title="Tambah PD Penunjang"
                                                data-id="<?= $key['id'] ?>">
                                            <i class="notika-icon notika-plus-symbol"></i>
                                        </button>
                                        <?php if (!empty($key['pd_penunjang'])): ?>
                                            <button class="btn btn-sm btn-primary amber-icon-notika btn-reco-mg btn-button-mg Pis" 
                                                    title="Edit PD Penunjang"
                                                    Pis="<?=$key['id'].'|'.$key['pd_penunjang']?>">
                                                <i class="notika-icon notika-support"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?= is_numeric($key['target_1']) && floor($key['target_1']) == $key['target_1'] ? (int)$key['target_1'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?= is_numeric($key['target_2']) && floor($key['target_2']) == $key['target_2'] ? (int)$key['target_2'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?= is_numeric($key['target_3']) && floor($key['target_3']) == $key['target_3'] ? (int)$key['target_3'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?= is_numeric($key['target_4']) && floor($key['target_4']) == $key['target_4'] ? (int)$key['target_4'] : '-' ?>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <?= is_numeric($key['target_5']) && floor($key['target_5']) == $key['target_5'] ? (int)$key['target_5'] : '-' ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                            <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                    data-id="<?= $key['id'] ?>" 
                                                    data-sasaran="<?= $key['IdSasaran'] ?>" 
                                                    data-indikator-sasaran="<?= $key['indikator_sasaran'] ?>"
                                                    data-target1="<?= $key['target_1'] ?? '' ?>"
                                                    data-target2="<?= $key['target_2'] ?? '' ?>"
                                                    data-target3="<?= $key['target_3'] ?? '' ?>"
                                                    data-target4="<?= $key['target_4'] ?? '' ?>"
                                                    data-target5="<?= $key['target_5'] ?? '' ?>">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                    data-id="<?= $key['id'] ?>">
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

<!-- Modal Tambah IKD -->
<div class="modal fade" id="ModalTambahIkd" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormTambahIkd">
                    <div class="form-group">
                        <label for="Sasaran">Sasaran</label>
                        <select class="form-control" id="Sasaran" name="Sasaran" required>
                            <?php foreach ($Sasaran as $sasaran) { ?>
                                <option value="<?= $sasaran['Id'] ?>"><?= $sasaran['Sasaran'] ?></option>
                            <?php } ?>
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
                                <input  class="form-control" name="target_1" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2</label>
                                <input  class="form-control" name="target_2" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 3</label>
                                <input  class="form-control" name="target_3" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 4</label>
                                <input  class="form-control" name="target_4" placeholder="Angka">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 5</label>
                                <input  class="form-control" name="target_5" placeholder="Angka">
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
                    <div class="form-group">
                        <label for="EditSasaran">Sasaran</label>
                        <select class="form-control" id="EditSasaran" name="EditSasaran" required>
                            <?php foreach ($Sasaran as $sasaran) { ?>
                                <option value="<?= $sasaran['Id'] ?>"><?= $sasaran['Sasaran'] ?></option>
                            <?php } ?>
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
                                <input  class="form-control" id="EditTarget1" name="target_1">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 2</label>
                                <input  class="form-control" id="EditTarget2" name="target_2">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 3</label>
                                <input  class="form-control" id="EditTarget3" name="target_3">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 4</label>
                                <input  class="form-control" id="EditTarget4" name="target_4">
                            </div>
                            <div class="col-md-2">
                                <label>Tahun 5</label>
                                <input  class="form-control" id="EditTarget5" name="target_5">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
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

        // Tambah IKD
        $("#FormTambahIkd").submit(function(e) {
            e.preventDefault();
            if(validateIntegerInputs('FormTambahIkd')) {
                $.post(BaseURL + "Admin/TambahIkd", $(this).serialize()).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menyimpan data: " + res);
                    }
                });
            }
        });

        // Edit IKD
        $(".Edit").click(function() {
            var id = $(this).data('id');
            var IdSasaran = $(this).data('sasaran');
            var indikatorSasaran = $(this).data('indikator-sasaran');
            var target1 = $(this).data('target1');
            var target2 = $(this).data('target2');
            var target3 = $(this).data('target3');
            var target4 = $(this).data('target4');
            var target5 = $(this).data('target5');

            $("#EditId").val(id);
            $("#EditSasaran").val(IdSasaran);
            $("#EditIndikatorSasaran").val(indikatorSasaran);
            $("#EditTarget1").val(target1 ? parseInt(target1) : '');
            $("#EditTarget2").val(target2 ? parseInt(target2) : '');
            $("#EditTarget3").val(target3 ? parseInt(target3) : '');
            $("#EditTarget4").val(target4 ? parseInt(target4) : '');
            $("#EditTarget5").val(target5 ? parseInt(target5) : '');

            $("#ModalEditIkd").modal('show');
        });

        $("#FormEditIkd").submit(function(e) {
            e.preventDefault();
            if(validateIntegerInputs('FormEditIkd')) {
                $.post(BaseURL + "Admin/EditIkd", $(this).serialize()).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal mengupdate data: " + res);
                    }
                });
            }
        });

        // Hapus IKD
        $(".Hapus").click(function() {
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var id = $(this).data('id');
                $.post(BaseURL + "Admin/HapusIkd", { id: id }).done(function(res) {
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
            
            $.post(BaseURL + "Admin/TambahPd", $.param(formData)).done(function(res) {
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
            
            $.post(BaseURL + "Admin/TambahPd", $.param(formData)).done(function(res) {
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
            $.post(BaseURL + "Admin/EditPDIKD", Pic).done(function(Respon) {
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
            $.post(BaseURL + "Admin/EditPDIKD", Pis).done(function(Respon) {
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