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
                                    <th width="12%" class="text-center">PD Penanggung Jawab</th>
                                    <th width="12%" class="text-center">PD Penunjang</th>
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
            
            // Mengambil data target dari baris tabel atau dari lastInputData jika tersedia
            var target1, target2, target3, target4, target5;
            
            if (lastInputData[id]) {
                // Menggunakan nilai terakhir yang diinput oleh user
                target1 = lastInputData[id].target_1;
                target2 = lastInputData[id].target_2;
                target3 = lastInputData[id].target_3;
                target4 = lastInputData[id].target_4;
                target5 = lastInputData[id].target_5;
            } else {
                // Mengambil nilai dari elemen tabel sebagai fallback
                var rowCells = $(this).closest('tr').find('td');
                target1 = rowCells.eq(5).text().trim() !== '-' ? parseInt(rowCells.eq(5).text().trim()) : '';
                target2 = rowCells.eq(6).text().trim() !== '-' ? parseInt(rowCells.eq(6).text().trim()) : '';
                target3 = rowCells.eq(7).text().trim() !== '-' ? parseInt(rowCells.eq(7).text().trim()) : '';
                target4 = rowCells.eq(8).text().trim() !== '-' ? parseInt(rowCells.eq(8).text().trim()) : '';
                target5 = rowCells.eq(9).text().trim() !== '-' ? parseInt(rowCells.eq(9).text().trim()) : '';
            }

            $("#EditId").val(id);
            $("#EditSasaran").val(IdSasaran);
            $("#EditIndikatorSasaran").val(indikatorSasaran);
            $("#EditTarget1").val(target1);
            $("#EditTarget2").val(target2);
            $("#EditTarget3").val(target3);
            $("#EditTarget4").val(target4);
            $("#EditTarget5").val(target5);

            $("#ModalEditIkd").modal('show');
        });

        $("#FormEditIkd").submit(function(e) {
            e.preventDefault();
            if(validateIntegerInputs('FormEditIkd')) {
                // Menyimpan nilai terakhir yang diinput
                var id = $("#EditId").val();
                lastInputData[id] = {
                    target_1: $("#EditTarget1").val(),
                    target_2: $("#EditTarget2").val(),
                    target_3: $("#EditTarget3").val(),
                    target_4: $("#EditTarget4").val(),
                    target_5: $("#EditTarget5").val()
                };
                
                // Menyimpan ke localStorage untuk persistensi data
                localStorage.setItem('ikdLastInputData', JSON.stringify(lastInputData));
                
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
        $('#data-table-basic tbody').on('click', '.Hapus', function () {
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var id = $(this).data('id');
                
                // Menghapus data input terakhir jika ID dihapus
                if (lastInputData[id]) {
                    delete lastInputData[id];
                    localStorage.setItem('ikdLastInputData', JSON.stringify(lastInputData));
                }
                
                $.post(BaseURL + "Admin/HapusIkd", { id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menghapus data: " + res);
                    }
                });
            }
        });

        // Hapus IKD
        $(".Hapus").click(function() {
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var id = $(this).data('id');
                
                // Menghapus data input terakhir jika ID dihapus
                if (lastInputData[id]) {
                    delete lastInputData[id];
                    localStorage.setItem('ikdLastInputData', JSON.stringify(lastInputData));
                }
                
                $.post(BaseURL + "Admin/HapusIkd", { id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert("Gagal menghapus data: " + res);
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