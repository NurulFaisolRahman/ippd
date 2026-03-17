<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- FILTER PROVINSI & KAB/KOTA -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 15px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>"
                                                                <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="FilterWilayah">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                $wil = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wil = $wil ? html_escape($wil['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 15px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wil ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputKaryawan">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah Karyawan</b>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>NIP</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Dinas Terkait</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th>Password</th>
                                            <th>Tahun Mulai</th>
                                            <th>Tahun Akhir</th>
                                            <th class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1;
                                    foreach ($Karyawan as $key) { ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align:middle;"><?= $No++ ?></td>
                                            <td style="vertical-align:middle;"><?= html_escape($key['nip']) ?></td>
                                            <td style="vertical-align:middle;"><?= html_escape($key['nama']) ?></td>
                                            <td style="vertical-align:middle;"><?= html_escape($key['jabatan']) ?></td>
                                            <td style="vertical-align:middle;"><?= isset($key['dinas_nama']) ? $key['dinas_nama'] : '-' ?></td>
                                            
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td style="vertical-align: middle; font-size: 11px; max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                                    <?= substr($key['password'], 0, 20) ?>...
                                                </td>
                                                <td style="vertical-align:middle;"><?= $key['tahun_mulai'] ?></td>
                                                <td style="vertical-align:middle;"><?= $key['tahun_akhir'] ?></td>
                                                <td class="text-center">
                                                    <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                        <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                                                            data-id="<?= $key['id'] ?>"
                                                            data-nip="<?= htmlspecialchars($key['nip'], ENT_QUOTES) ?>"
                                                            data-nama="<?= htmlspecialchars($key['nama'], ENT_QUOTES) ?>"
                                                            data-jabatan="<?= htmlspecialchars($key['jabatan'], ENT_QUOTES) ?>"
                                                            data-tahun-mulai="<?= $key['tahun_mulai'] ?>"
                                                            data-tahun-akhir="<?= $key['tahun_akhir'] ?>"
                                                            data-dinas-ids="<?= isset($key['dinas_id']) ? htmlspecialchars($key['dinas_id'], ENT_QUOTES) : '' ?>">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-id="<?= $key['id'] ?>">
                                                            <i class="notika-icon notika-trash"></i>
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

    <!-- MODAL INPUT KARYAWAN -->
    <div class="modal fade" id="ModalInputKaryawan" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Tambah Data Karyawan</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>NIP</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="NIP" placeholder="Masukkan NIP">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Nama</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="Nama" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Jabatan</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="Jabatan" placeholder="Masukkan Jabatan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Password</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="Password" placeholder="Masukkan Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Dinas Terkait</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="dinasContainerAdd"></div>
                                        <button type="button" class="btn btn-info btn-sm" id="addDinasRowAdd">
                                            + Tambah Dinas
                                        </button>
                                        <div style="margin-top:6px; font-size:12px; color:#888;">
                                            * Wajib pilih minimal 1 dinas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Mulai</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="TahunMulai" placeholder="Contoh: 2020">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Akhir</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="TahunAkhir" placeholder="Contoh: 2025">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-8">
                                    <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT KARYAWAN -->
    <div class="modal fade" id="ModalEditKaryawan" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Edit Data Karyawan</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <input type="hidden" id="Id">

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>NIP</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_NIP" placeholder="Masukkan NIP">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Nama</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_Nama" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Jabatan</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_Jabatan" placeholder="Masukkan Jabatan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Password</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_Password" placeholder="Kosongkan jika tidak diubah">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Dinas Terkait</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="dinasContainerEdit"></div>
                                        <button type="button" class="btn btn-info btn-sm" id="addDinasRowEdit">
                                            + Tambah Dinas
                                        </button>
                                        <div style="margin-top:6px; font-size:12px; color:#888;">
                                            * Wajib pilih minimal 1 dinas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Mulai</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_TahunMulai">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label class="hrzn-fm"><b>Tahun Akhir</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" id="_TahunAkhir">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-8">
                                    <button class="btn btn-success notika-btn-success" id="Edit"><b>UPDATE</b></button>
                                </div>
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
    @media (max-width:768px) {
        .filter-row {
            flex-direction: column;
            gap: 15px;
        }
        .filter-select {
            width: 100%;
        }
    }
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var DINAS_LIST = <?= json_encode($DaftarDinas) ?>;

    function buildDinasSelect(nameAttr, selectedId) {
        var html = '<div class="dinas-row" style="display:flex; gap:8px; margin-bottom:6px;">';
        html += '<select class="form-control input-sm dinas-select" name="' + nameAttr + '[]" style="flex:1;">';
        html += '<option value="">-- Pilih Dinas --</option>';

        DINAS_LIST.forEach(function(d) {
            var sel = (selectedId && String(selectedId) === String(d.id)) ? 'selected' : '';
            var tahunInfo = (d.tahun_mulai && d.tahun_akhir) ? ' (' + d.tahun_mulai + '-' + d.tahun_akhir + ')' : '';
            html += '<option value="' + d.id + '" ' + sel + '>' + d.nama + tahunInfo + '</option>';
        });

        html += '</select>';
        html += '<button type="button" class="btn btn-danger btn-sm remove-dinas">Hapus</button>';
        html += '</div>';
        return html;
    }

    function initDinasContainer(containerId, nameAttr, selectedIds) {
        var $c = $('#' + containerId);
        $c.html('');
        if (!selectedIds || selectedIds.length === 0) {
            $c.append(buildDinasSelect(nameAttr, null));
        } else {
            selectedIds.forEach(function(id) {
                $c.append(buildDinasSelect(nameAttr, id));
            });
        }
    }

    function collectDinas(containerId) {
        var arr = [];
        $('#' + containerId + ' select.dinas-select').each(function() {
            var v = $(this).val();
            if (v) arr.push(v);
        });
        return arr.filter(function(v, i, a) {
            return a.indexOf(v) === i;
        });
    }

    jQuery(document).ready(function($) {
        var table = $('#data-table-basic').DataTable();

        // INIT
        initDinasContainer('dinasContainerAdd', 'dinas_id', []);

        // FILTER WILAYAH
        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
            $("#Provinsi").change(function() {
                if ($(this).val() === "") {
                    $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
                    return;
                }
                $.ajax({
                    url: BaseURL + "Daerah/GetListKabKota",
                    type: "POST",
                    data: {
                        Kode: $(this).val(),
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    success: function(res) {
                        var Data = JSON.parse(res);
                        var html = '<option value="">Pilih Kab/Kota</option>';
                        Data.forEach(function(item) {
                            html += '<option value="' + item.Kode + '">' + item.Nama + '</option>';
                        });
                        $("#KabKota").html(html);
                    }
                });
            });

            $("#FilterWilayah").click(function() {
                var prov = $("#Provinsi").val();
                var kab = $("#KabKota").val();
                if (!prov) return alert("Pilih Provinsi");
                if (!kab) return alert("Pilih Kab/Kota");

                $.ajax({
                    url: BaseURL + "Daerah/SetTempKodeWilayah",
                    type: "POST",
                    data: {
                        KodeWilayah: kab,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    success: function(res) {
                        if (res === '1') window.location.reload();
                    }
                });
            });
        <?php } ?>

        // TAMBAH ROW DINAS
        $(document).on('click', '#addDinasRowAdd', function() {
            $('#dinasContainerAdd').append(buildDinasSelect('dinas_id', null));
        });

        $(document).on('click', '#addDinasRowEdit', function() {
            $('#dinasContainerEdit').append(buildDinasSelect('dinas_id', null));
        });

        $(document).on('click', '.remove-dinas', function() {
            $(this).closest('.dinas-row').remove();
        });

        // SIMPAN
        $("#Input").click(function() {
            var dinas = collectDinas('dinasContainerAdd');

            if (!$("#NIP").val()) return alert('NIP wajib diisi!');
            if (!$("#Nama").val()) return alert('Nama wajib diisi!');
            if (!$("#Jabatan").val()) return alert('Jabatan wajib diisi!');
            if (!$("#Password").val()) return alert('Password wajib diisi!');
            if (dinas.length < 1) return alert('Pilih minimal 1 dinas!');
            if (!$("#TahunMulai").val()) return alert('Tahun Mulai wajib diisi!');
            if (!$("#TahunAkhir").val()) return alert('Tahun Akhir wajib diisi!');

            $.post(BaseURL + "Daerah/InputKaryawan", {
                nip: $("#NIP").val(),
                nama: $("#Nama").val(),
                jabatan: $("#Jabatan").val(),
                password: $("#Password").val(),
                tahun_mulai: $("#TahunMulai").val(),
                tahun_akhir: $("#TahunAkhir").val(),
                dinas_id: dinas,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                if (res == '1') {
                    alert('Data berhasil disimpan!');
                    window.location.reload();
                } else {
                    alert(res);
                }
            });
        });

        // EDIT
        $(document).on("click", ".Edit", function() {
            $("#Id").val($(this).data('id'));
            $("#_NIP").val($(this).data('nip'));
            $("#_Nama").val($(this).data('nama'));
            $("#_Jabatan").val($(this).data('jabatan'));
            $("#_Password").val("");
            $("#_TahunMulai").val($(this).data('tahun-mulai'));
            $("#_TahunAkhir").val($(this).data('tahun-akhir'));

            var dinasIds = $(this).data('dinas-ids');
            var selected = dinasIds ? String(dinasIds).split(',').map(function(x) { return x.trim(); }).filter(Boolean) : [];
            initDinasContainer('dinasContainerEdit', 'dinas_id', selected);

            $('#ModalEditKaryawan').modal("show");
        });

        $("#Edit").click(function() {
            var dinas = collectDinas('dinasContainerEdit');

            if (!$("#_NIP").val()) return alert('NIP wajib diisi!');
            if (!$("#_Nama").val()) return alert('Nama wajib diisi!');
            if (!$("#_Jabatan").val()) return alert('Jabatan wajib diisi!');
            if (dinas.length < 1) return alert('Pilih minimal 1 dinas!');
            if (!$("#_TahunMulai").val()) return alert('Tahun Mulai wajib diisi!');
            if (!$("#_TahunAkhir").val()) return alert('Tahun Akhir wajib diisi!');

            $.post(BaseURL + "Daerah/EditKaryawan", {
                id: $("#Id").val(),
                nip: $("#_NIP").val(),
                nama: $("#_Nama").val(),
                jabatan: $("#_Jabatan").val(),
                password: $("#_Password").val(),
                tahun_mulai: $("#_TahunMulai").val(),
                tahun_akhir: $("#_TahunAkhir").val(),
                dinas_id: dinas,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                if (res == '1') {
                    alert('Data berhasil diupdate!');
                    window.location.reload();
                } else {
                    alert(res);
                }
            });
        });

        // HAPUS
        $(document).on('click', '.Hapus', function() {
            if (!confirm("Yakin ingin menghapus data ini?")) return;
            $.post(BaseURL + "Daerah/HapusKaryawan", {
                id: $(this).data('id'),
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                if (res == '1') {
                    alert('Data berhasil dihapus!');
                    window.location.reload();
                } else {
                    alert(res);
                }
            });
        });
    });
</script>