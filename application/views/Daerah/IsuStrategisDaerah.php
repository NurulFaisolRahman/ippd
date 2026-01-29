<?php $this->load->view('Daerah/sidebar'); ?>

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
                                <!-- Menampilkan Wilayah setelah filter -->
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <?php 
                                        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                        $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                        if (empty($IsuStrategis)) {
                                            $pesan_error = "Tidak ada data untuk wilayah: $nama_wilayah";
                                        }
                                    ?>
                                    <div class="alert <?= empty($IsuStrategis) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                        <?php if (!empty($pesan_error)) { ?>
                                            <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsuStrategis">
                                    <i class="notika-icon notika-edit"></i> <b>Input Isu Strategis</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">Nama Isu Strategis</th>
                                        <th width="10%" class="text-center">Isu Strategis Nasional</th>
                                        <th width="8%" class="text-center">Kementrian</th>
                                        <th width="8%" class="text-center">Periode</th>
                                        <th width="10%" class="text-center">Potensi Daerah</th>
                                        <th width="10%" class="text-center">Permasalahan Pokok Daerah</th>
                                        <th width="10%" class="text-center">Isu KLHS Daerah</th>
                                        <th width="10%" class="text-center"><?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>Aksi<?php } ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($IsuStrategis as $key) { ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: top;"><?= $No++ ?></td>
                                        <td style="vertical-align: top;"><?= $key['NamaIsuStrategis'] ?></td>
                                        <td style="vertical-align: middle;">
                                            <div class="accordion-stn">
                                                <div class="panel-group" data-collapse-color="nk-green" id="Accrodion<?=$No?>" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse notika-accrodion-cus">
                                                        <div class="panel-heading" role="tab">
                                                            <b><a data-toggle="collapse" data-parent="#Accrodion<?=$No?>" href="#_Accrodion<?=$No?>" aria-expanded="true">Lihat Isu </a></b>
                                                        </div>
                                                        <div id="_Accrodion<?=$No?>" class="collapse" role="tabpanel">
                                                            <div class="panel-body" style="padding-top: 0px;">
                                                                <?php $_Id = explode("$",$key['_Id']); foreach ($_Id as $x) { ?>
                                                                    <div class="nk-int-st text-justify"><?= $Isu[$x] ?></div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;"><?= $Kementerian[explode("$",$key['_Id'])[0]] ?></td>
                                        <td class="text-center" style="vertical-align: top;"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></td>
                                        
                                        <!-- Kolom Potensi Daerah -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <button class="btn btn-sm btn-success TambahPotensi" 
                                                            title="Tambah Potensi Daerah"
                                                            data-id="<?= $key['Id'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php if (!empty($key['potensi_daerah'])): ?>
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <button class="btn btn-sm btn-primary EditPotensi" 
                                                            title="Edit Potensi Daerah"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-potensi="<?= htmlspecialchars($key['potensi_daerah']) ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['potensi_daerah'])): ?>
                                                        <?php 
                                                        $potensiDaerah = explode(',', $key['potensi_daerah']);
                                                        foreach ($potensiDaerah as $potensi): 
                                                        ?>
                                                            <div style="padding: 2px 0; white-space: nowrap;"><?= htmlspecialchars($potensi) ?></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Kolom Permasalahan Pokok Daerah -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <button class="btn btn-sm btn-success TambahPP" 
                                                            title="Tambah Permasalahan Pokok"
                                                            data-id="<?= $key['Id'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php if (!empty($key['permasalahan_pokok'])): ?>
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <button class="btn btn-sm btn-primary EditPP" 
                                                            title="Edit Permasalahan Pokok"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-pp="<?= htmlspecialchars($key['permasalahan_pokok']) ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['permasalahan_pokok'])): ?>
                                                        <?php 
                                                        $permasalahanPokok = explode(',', $key['permasalahan_pokok']);
                                                        foreach ($permasalahanPokok as $pp): 
                                                        ?>
                                                            <div style="padding: 2px 0; white-space: nowrap;"><?= htmlspecialchars($pp) ?></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Kolom Isu KLHS Daerah -->
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <button class="btn btn-sm btn-success TambahKLHS" 
                                                            title="Tambah Isu KLHS"
                                                            data-id="<?= $key['Id'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php if (!empty($key['isu_klhs'])): ?>
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <button class="btn btn-sm btn-primary EditKLHS" 
                                                            title="Edit Isu KLHS"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-klhs="<?= htmlspecialchars($key['isu_klhs']) ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div style="flex-grow: 1; overflow: auto; text-align: start;">
                                                    <?php if (!empty($key['isu_klhs'])): ?>
                                                        <?php 
                                                        $isuKLHS = explode(',', $key['isu_klhs']);
                                                        foreach ($isuKLHS as $klhs): 
                                                        ?>
                                                            <div style="padding: 2px 0; white-space: nowrap;"><?= htmlspecialchars($klhs) ?></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Kolom Aksi -->
                                        <td class="text-center" style="vertical-align: middle;">
                                            <div style="display: flex; justify-content: center; gap: 5px;">
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                        data-id="<?= $key['Id'] ?>" 
                                                        data-nama="<?= htmlspecialchars($key['NamaIsuStrategis']) ?>" 
                                                        data-tahunmulai="<?= $key['TahunMulai'] ?>" 
                                                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                        data-periode="<?= $key['TahunMulai'] . '-' . $key['TahunAkhir'] ?>"
                                                        data-kementerian="<?= explode("$",$key['_Id'])[0] ?>"
                                                        data-isu="<?= $key['_Id'] ?>"
                                                        style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                    <i class="notika-icon notika-edit" style="font-size: 15px;"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                        data-id="<?= $key['Id'] ?>"
                                                        style="width: 36px; height: 36px; padding: 0; border-radius: 50%;">
                                                    <i class="notika-icon notika-trash" style="font-size: 15px;"></i>
                                                </button>
                                                <?php } ?>
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
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Isu Strategis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeRPJMD" name="PeriodeRPJMD" required>
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                <label class="hrzn-fm"><b>Nama Isu Strategis</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="NamaIsuStrategis" name="NamaIsuStrategis" style="color: #000;" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode Nasional</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="PeriodeIsuStrategisNasional" style="color: #000 !important;">
                                                        <option value="">-- Pilih Periode --</option>
                                                        <?php foreach ($PeriodeIsuStrategisNasional as $key) { ?>
                                                            <option value="<?= $key['TahunMulai'] ?>">
                                                                <?=$key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                <label class="hrzn-fm"><b>Kementerian</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="Kementerian" style="color: #000 !important;">
                                                        <option value="">-- Pilih Kementerian --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu Strategis Nasional</b></label>
                                    </div>
                                    <div style="margin-top: 3px;" class="col-lg-9">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="AccrodionIsuStrategisNasional" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#AccrodionIsuStrategisNasional" href="#PilihIsuStrategisNasional" aria-expanded="true">Pilih Isu</a></b>
                                                    </div>
                                                    <div id="PilihIsuStrategisNasional" class="collapse in" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px;">
                                                            <div class="nk-int-st text-justify" id="ListIsuStrategisNasional"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="InputIsuStrategis"><b>SIMPAN</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Isu Strategis -->
    <div class="modal fade" id="ModalEditIsuStrategis" role="dialog">
        <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Isu Strategis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPeriodeRPJMD" name="EditPeriodeRPJMD" required>
                                                        <option value="">-- Pilih Periode RPJMD --</option>
                                                        <?php foreach ($Periods as $period) { ?>
                                                            <option value="<?= $period['TahunMulai'] ?>-<?= $period['TahunAkhir'] ?>">
                                                                <?= $period['TahunMulai'] ?> - <?= $period['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" id="EditTahunMulai">
                                                    <input type="hidden" id="EditTahunAkhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Nama Isu Strategis</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="hidden" id="EditId" name="EditId">
                                                    <input type="text" class="form-control input-sm" id="EditNamaIsuStrategis" name="EditNamaIsuStrategis" style="color: #000;" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Periode Nasional</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditPeriodeIsuStrategisNasional" style="color: #000 !important;">
                                                        <option value="">-- Pilih Periode --</option>
                                                        <?php foreach ($PeriodeIsuStrategisNasional as $key) { ?>
                                                            <option value="<?= $key['TahunMulai'] ?>">
                                                                <?=$key['TahunMulai'] ?> - <?= $key['TahunAkhir'] ?>
                                                            </option>
                                                        <?php } ?>
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
                                                <label class="hrzn-fm"><b>Kementerian</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <select class="form-control" id="EditKementerian" style="color: #000 !important;">
                                                        <option value="">-- Pilih Kementerian --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="hrzn-fm"><b>Isu Strategis Nasional</b></label>
                                    </div>
                                    <div style="margin-top: 3px;" class="col-lg-9">
                                        <div class="accordion-stn">
                                            <div class="panel-group" data-collapse-color="nk-green" id="EditAccrodionIsuStrategisNasional" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-collapse notika-accrodion-cus">
                                                    <div class="panel-heading" role="tab">
                                                        <b><a data-toggle="collapse" data-parent="#EditAccrodionIsuStrategisNasional" href="#EditPilihIsuStrategisNasional" aria-expanded="true">Pilih Isu</a></b>
                                                    </div>
                                                    <div id="EditPilihIsuStrategisNasional" class="collapse in" role="tabpanel">
                                                        <div class="panel-body" style="padding-top: 0px;">
                                                            <div class="nk-int-st text-justify" id="EditListIsuStrategisNasional"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="UpdateIsuStrategis"><b>UPDATE</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Potensi Daerah -->
    <div class="modal fade" id="ModalTambahPotensi" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Potensi Daerah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <form id="FormTambahPotensi">
                        <input type="hidden" id="PotensiId" name="id">
                        <div id="potensi-container">
                            <div class="form-group potensi-row">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>Potensi Daerah</label>
                                        <select class="form-control potensi-select" name="potensi_daerah[]" required>
                                            <option value="">Pilih Potensi Daerah</option>
                                            <?php foreach ($PotensiDaerah as $potensi) { ?>
                                                <option value="<?= htmlspecialchars($potensi['NamaPotensiDaerah']) ?>">
                                                    <?= htmlspecialchars($potensi['NamaPotensiDaerah']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <button type="button" class="btn btn-success btn-add-potensi">
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

    <!-- Modal Tambah Permasalahan Pokok -->
    <div class="modal fade" id="ModalTambahPP" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Permasalahan Pokok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <form id="FormTambahPP">
                        <input type="hidden" id="PPId" name="id">
                        <div id="pp-container">
                            <div class="form-group pp-row">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>Permasalahan Pokok Daerah</label>
                                        <select class="form-control pp-select" name="permasalahan_pokok[]" required>
                                            <option value="">Pilih Permasalahan Pokok</option>
                                            <?php foreach ($PermasalahanPokok as $pp) { ?>
                                                <option value="<?= htmlspecialchars($pp['NamaPermasalahanPokok']) ?>">
                                                    <?= htmlspecialchars($pp['NamaPermasalahanPokok']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 25px;">
                                        <button type="button" class="btn btn-success btn-add-pp">
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

    <!-- Modal Tambah Isu KLHS -->
    <div class="modal fade" id="ModalTambahKLHS" role="dialog">
        <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Isu KLHS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <form id="FormTambahKLHS">
                        <input type="hidden" id="KLHSId" name="id">
                        <div id="klhs-container">
                            <div class="form-group klhs-row">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>Isu KLHS Daerah</label>
                                        <select class="form-control klhs-select" name="isu_klhs[]" required>
                                            <option value="">Pilih Isu KLHS</option>
                                            <?php foreach ($IsuKLHS as $klhs) { ?>
                                                <option value="<?= htmlspecialchars($klhs['NamaIsuKLHS']) ?>">
                                                    <?= htmlspecialchars($klhs['NamaIsuKLHS']) ?>
                                                </option>
                                            <?php } ?>
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
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Potensi Daerah -->
    <div class="modal fade" id="ModalEditPotensi" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Potensi Daerah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nk-int-st text-justify">
                                            <input type="hidden" class="form-control input-sm" id="IdPotensi">
                                            <div id="ListPotensi"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="SavePotensi">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Permasalahan Pokok -->
    <div class="modal fade" id="ModalEditPP" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Permasalahan Pokok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nk-int-st text-justify">
                                            <input type="hidden" class="form-control input-sm" id="IdPP">
                                            <div id="ListPP"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="SavePP">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Isu KLHS -->
    <div class="modal fade" id="ModalEditKLHS" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Isu KLHS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-example-wrap">
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nk-int-st text-justify">
                                            <input type="hidden" class="form-control input-sm" id="IdKLHS">
                                            <div id="ListKLHS"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="SaveKLHS">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control, .form-control option {
            color: #000 !important;
        }
        .modal-content {
            color: #000;
        }
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-left: 10px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
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
    <script>
        var BaseURL = '<?= base_url() ?>';
        var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
        var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
        var permasalahanPokokOptions = <?php echo json_encode(array_map(function($pp) { return ['nama' => $pp['NamaPermasalahanPokok']]; }, $PermasalahanPokok)); ?>;
        var isuKLHSOptions = <?php echo json_encode(array_map(function($klhs) { return ['nama' => $klhs['NamaIsuKLHS']]; }, $IsuKLHS)); ?>;
        var potensiDaerahOptions = <?php echo json_encode(array_map(function($potensi) { return ['nama' => $potensi['NamaPotensiDaerah']]; }, $PotensiDaerah)); ?>;

        $(document).ready(function() {
            // Logika filter untuk pengguna yang belum login
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
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
                        success: function(Respon) {
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
                        data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
                        beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                        success: function(Respon) {
                            if (Respon === '1') {
                                window.location.href = BaseURL + "Daerah/IsuStrategisDaerah";
                            } else {
                                alert(Respon || "Gagal menyimpan filter wilayah!");
                                $("#Filter").prop('disabled', false).text('Filter');
                            }
                        },
                        error: function() {
                            alert("Gagal menghubungi server!");
                            $("#Filter").prop('disabled', false).text('Filter');
                        }
                    });
                });

                // Populate Kab/Kota dropdown on page load if KodeWilayah is set
                <?php if (!empty($KodeWilayah)) { ?>
                    var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
                    var kodeKab = "<?= $KodeWilayah ?>";
                    $("#Provinsi").val(kodeProv);
                    $.ajax({
                        url: BaseURL + "Daerah/GetListKabKota",
                        type: "POST",
                        data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
                        success: function(Respon) {
                            var Data = JSON.parse(Respon);
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
            <?php } ?>

            // Function to generate options for Permasalahan Pokok
            function getPermasalahanPokokOptions() {
                var options = '';
                permasalahanPokokOptions.forEach(function(pp) {
                    options += '<option value="' + pp.nama + '">' + pp.nama + '</option>';
                });
                return options;
            }

            // Function to generate options for Isu KLHS
            function getIsuKLHSOptions() {
                var options = '';
                isuKLHSOptions.forEach(function(klhs) {
                    options += '<option value="' + klhs.nama + '">' + klhs.nama + '</option>';
                });
                return options;
            }

            // Function to generate options for Potensi Daerah
            function getPotensiDaerahOptions() {
                var options = '';
                potensiDaerahOptions.forEach(function(potensi) {
                    options += '<option value="' + potensi.nama + '">' + potensi.nama + '</option>';
                });
                return options;
            }

            // Load Kementerian based on selected periode
            $("#PeriodeIsuStrategisNasional").change(function(){
                if ($(this).val() == "") {
                    $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>');
                    $("#ListIsuStrategisNasional").html('');
                } else {
                    $.post(BaseURL+"Daerah/GetKementerianStrategis", {TahunMulai: $(this).val()})
                        .done(function(Respon) {
                            var Data = JSON.parse(Respon);
                            var Kementerian = '<option value="">-- Pilih Kementerian --</option>';
                            for (let i = 0; i < Data.length; i++) {
                                Kementerian += '<option value="'+Data[i].Id+'">'+Data[i].NamaKementerian+'</option>';
                            }
                            $("#Kementerian").html(Kementerian);
                        })
                        .fail(function(xhr, status, error) {
                            alert("Terjadi kesalahan: " + error);
                        });
                }
            });

            // Load Isu Strategis Nasional based on selected Kementerian
            $("#Kementerian").change(function(){
                if ($(this).val() == "") {
                    $("#ListIsuStrategisNasional").html('');
                } else {
                    $.post(BaseURL+"Daerah/GetIsuStrategisNasional", {Id: $(this).val()})
                        .done(function(Respon) {
                            var Data = JSON.parse(Respon);
                            var Isu = '';
                            for (let i = 0; i < Data.length; i++) {
                                Isu += '<label><input style="margin-top: 10px;" type="checkbox" name="Isu" value="'+Data[i].Id+'"> '+Data[i].NamaIsuStrategis+'</label><br>';
                            }
                            $("#ListIsuStrategisNasional").html(Isu);
                        })
                        .fail(function(xhr, status, error) {
                            alert("Terjadi kesalahan: " + error);
                        });
                }
            });

            // Edit Form Functions
            $("#EditPeriodeIsuStrategisNasional").change(function(){
                if ($(this).val() == "") {
                    $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
                    $("#EditListIsuStrategisNasional").html('');
                } else {
                    $.post(BaseURL+"Daerah/GetKementerianStrategis", {TahunMulai: $(this).val()})
                        .done(function(Respon) {
                            var Data = JSON.parse(Respon);
                            var Kementerian = '<option value="">-- Pilih Kementerian --</option>';
                            for (let i = 0; i < Data.length; i++) {
                                Kementerian += '<option value="'+Data[i].Id+'">'+Data[i].NamaKementerian+'</option>';
                            }
                            $("#EditKementerian").html(Kementerian);
                        })
                        .fail(function(xhr, status, error) {
                            alert("Terjadi kesalahan: " + error);
                        });
                }
            });

            $("#EditKementerian").change(function(){
                if ($(this).val() == "") {
                    $("#EditListIsuStrategisNasional").html('');
                } else {
                    $.post(BaseURL+"Daerah/GetIsuStrategisNasional", {Id: $(this).val()})
                        .done(function(Respon) {
                            var Data = JSON.parse(Respon);
                            var Isu = '';
                            for (let i = 0; i < Data.length; i++) {
                                Isu += '<label><input style="margin-top: 10px;" type="checkbox" name="EditIsu" value="'+Data[i].Id+'"> '+Data[i].NamaIsuStrategis+'</label><br>';
                            }
                            $("#EditListIsuStrategisNasional").html(Isu);
                            
                            // Check previously selected items
                            var selectedIsu = $("#EditIsuData").val().split("$");
                            $("input[name='EditIsu']").each(function() {
                                if(selectedIsu.includes($(this).val())) {
                                    $(this).prop('checked', true);
                                }
                            });
                        })
                        .fail(function(xhr, status, error) {
                            alert("Terjadi kesalahan: " + error);
                        });
                }
            });

            // Set tahun saat periode dipilih (Input)
            $("#PeriodeRPJMD").change(function() {
                if ($(this).val()) {
                    var years = $(this).val().split('-');
                    $("#TahunMulai").val(years[0]);
                    $("#TahunAkhir").val(years[1]);
                }
            });

            // Set tahun saat periode dipilih (Edit)
            $("#EditPeriodeRPJMD").change(function() {
                if ($(this).val()) {
                    var years = $(this).val().split('-');
                    $("#EditTahunMulai").val(years[0]);
                    $("#EditTahunAkhir").val(years[1]);
                }
            });

            // Input Isu Strategis
            $("#InputIsuStrategis").click(function() {
                var IsuStrategisNasional = [];
                $.each($("input[name='Isu']:checked"), function(){
                    IsuStrategisNasional.push($(this).val());
                });
                
                if ($("#PeriodeRPJMD").val() === "") {
                    alert('Pilih Periode RPJMD terlebih dahulu!');
                    return;
                } else if ($("#NamaIsuStrategis").val() === "") {
                    alert('Nama Isu Strategis harus diisi!');
                    return;
                } else if (!IsuStrategisNasional.length) {
                    alert("Pilih minimal satu Isu Strategis Nasional!");
                    return;
                }
                
                var Data = {
                    PeriodeRPJMD: $("#PeriodeRPJMD").val(),
                    NamaIsuStrategis: $("#NamaIsuStrategis").val(),
                    _Id: IsuStrategisNasional.join("$"),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $.post(BaseURL + "Daerah/InputIsuStrategis", Data)
                    .done(function(Respon) {
                        if (Respon == '1') {
                            $('#ModalInputIsuStrategis').modal('hide');
                            $("#PeriodeRPJMD").val('');
                            $("#NamaIsuStrategis").val('');
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            // Edit Isu Strategis
            $(document).on("click", ".Edit", function() {
                // Get all data attributes
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var tahunmulai = $(this).data('tahunmulai');
                var tahunakhir = $(this).data('tahunakhir');
                var periode = $(this).data('periode');
                var kementerian = $(this).data('kementerian');
                var isu = $(this).data('isu');
                
                // Set basic form values
                $("#EditId").val(id);
                $("#EditNamaIsuStrategis").val(nama);
                $("#EditPeriodeRPJMD").val(periode);
                $("#EditTahunMulai").val(tahunmulai);
                $("#EditTahunAkhir").val(tahunakhir);
                
                // Store the isu data in a hidden field for later use
                $('<input>').attr({
                    type: 'hidden',
                    id: 'EditIsuData',
                    value: isu
                }).appendTo('body');
                
                // Get additional data for Kementerian and Isu
                $.post(BaseURL + "Daerah/GetPeriodeIsuStrategisNasional", {Id: kementerian})
                    .done(function(Respon) {
                        var Data = JSON.parse(Respon)[0];
                        if(Data) {
                            // Set periode nasional
                            $("#EditPeriodeIsuStrategisNasional").val(Data.TahunMulai).trigger('change');
                            
                            // After Kementerian loads, set the value
                            setTimeout(function() {
                                $("#EditKementerian").val(kementerian).trigger('change');
                            }, 500);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
                
                $('#ModalEditIsuStrategis').modal("show");
            });

            // Update Isu Strategis
            $("#UpdateIsuStrategis").click(function() {
                var IsuStrategisNasional = [];
                $.each($("input[name='EditIsu']:checked"), function(){
                    IsuStrategisNasional.push($(this).val());
                });
                
                if ($("#EditPeriodeRPJMD").val() === "") {
                    alert('Pilih Periode RPJMD terlebih dahulu!');
                    return;
                } else if ($("#EditNamaIsuStrategis").val() === "") {
                    alert('Nama Isu Strategis harus diisi!');
                    return;
                } else if (!IsuStrategisNasional.length) {
                    alert("Pilih minimal satu Isu Strategis Nasional!");
                    return;
                }
                
                var Data = {
                    Id: $("#EditId").val(),
                    EditPeriodeRPJMD: $("#EditPeriodeRPJMD").val(),
                    NamaIsuStrategis: $("#EditNamaIsuStrategis").val(),
                    _Id: IsuStrategisNasional.join("$"),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                
                $.post(BaseURL + "Daerah/UpdateIsuStrategis", Data)
                    .done(function(Respon) {
                        if (Respon == '1') {
                            $('#ModalEditIsuStrategis').modal('hide');
                            window.location.reload();
                        } else {
                            alert(Respon);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            // Hapus Isu Strategis
            $(document).on("click", ".Hapus", function() {
                if (confirm("Apakah Anda yakin ingin menghapus isu strategis ini?")) {
                    var Id = { 
                        Id: $(this).data('id'), 
                        [CSRF_NAME]: CSRF_TOKEN 
                    };
                    $.post(BaseURL + "Daerah/DeleteIsuStrategis", Id)
                        .done(function(Respon) {
                            if (Respon == '1') {
                                window.location.reload();
                            } else {
                                alert(Respon);
                            }
                        })
                        .fail(function(xhr, status, error) {
                            alert("Terjadi kesalahan: " + error);
                        });
                }
            });

            // ========== POTENSI DAERAH FUNCTIONS ==========
            $(document).on("click", ".TambahPotensi", function() {
                var id = $(this).data('id');
                $("#PotensiId").val(id);
                $("#potensi-container").html('<div class="form-group potensi-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<label>Potensi Daerah</label>' +
                    '<select class="form-control potensi-select" name="potensi_daerah[]" required>' +
                    '<option value="">Pilih Potensi Daerah</option>' +
                    getPotensiDaerahOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 25px;">' +
                    '<button type="button" class="btn btn-success btn-add-potensi">' +
                    '<i class="notika-icon notika-plus-symbol"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $("#ModalTambahPotensi").modal('show');
            });

            $(document).on('click', '.btn-add-potensi', function() {
                var newRow = $('<div class="form-group potensi-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<select class="form-control potensi-select" name="potensi_daerah[]" required>' +
                    '<option value="">Pilih Potensi Daerah</option>' +
                    getPotensiDaerahOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 7px;">' +
                    '<button type="button" class="btn btn-danger btn-remove-potensi">' +
                    '<i class="notika-icon notika-trash"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $('#potensi-container').append(newRow);
            });

            $(document).on('click', '.btn-remove-potensi', function() {
                if ($('.potensi-row').length > 1) {
                    $(this).closest('.potensi-row').remove();
                } else {
                    alert('Minimal harus ada satu Potensi Daerah');
                }
            });

            $("#FormTambahPotensi").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                var potensiValues = [];
                $('select[name="potensi_daerah[]"]').each(function() {
                    if ($(this).val()) {
                        potensiValues.push($(this).val());
                    }
                });
                formData = formData.filter(item => item.name !== 'potensi_daerah[]');
                formData.push({name: 'potensi_daerah', value: potensiValues.join(',')});
                formData.push({name: CSRF_NAME, value: CSRF_TOKEN});
                
                $.post(BaseURL + "Daerah/TambahPotensiDaerahIsuStrategis", $.param(formData))
                    .done(function(res) {
                        if (res == '1') {
                            window.location.reload();
                        } else {
                            alert("Gagal menambahkan Potensi Daerah: " + res);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            $(document).on("click", ".EditPotensi", function() {
                var id = $(this).data('id');
                var potensi = $(this).data('potensi');
                $("#IdPotensi").val(id);
                var potensiList = potensi.split(",");
                var list = '';
                potensiDaerahOptions.forEach(function(option) {
                    var checked = potensiList.includes(option.nama) ? 'checked' : '';
                    list += '<label><input style="margin-top: 10px;" type="checkbox" name="Potensi" value="' + option.nama + '" ' + checked + '> ' + option.nama + '</label><br>';
                });
                $("#ListPotensi").html(list);
                $("#ModalEditPotensi").modal('show');
            });

            $("#SavePotensi").click(function() {
                var potensiValues = [];
                $.each($("input[name='Potensi']:checked"), function() {
                    potensiValues.push($(this).val());
                });
                var data = {
                    id: $("#IdPotensi").val(),
                    potensi_daerah: potensiValues.join(","),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                $.post(BaseURL + "Daerah/EditPotensiDaerahIsuStrategis", data)
                    .done(function(res) {
                        if (res == '1') {
                            window.location.reload();
                        } else {
                            alert(res);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            // ========== PERMASALAHAN POKOK FUNCTIONS ==========
            $(document).on("click", ".TambahPP", function() {
                var id = $(this).data('id');
                $("#PPId").val(id);
                $("#pp-container").html('<div class="form-group pp-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<label>Permasalahan Pokok Daerah</label>' +
                    '<select class="form-control pp-select" name="permasalahan_pokok[]" required>' +
                    '<option value="">Pilih Permasalahan Pokok</option>' +
                    getPermasalahanPokokOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 25px;">' +
                    '<button type="button" class="btn btn-success btn-add-pp">' +
                    '<i class="notika-icon notika-plus-symbol"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $("#ModalTambahPP").modal('show');
            });

            $(document).on('click', '.btn-add-pp', function() {
                var newRow = $('<div class="form-group pp-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<select class="form-control pp-select" name="permasalahan_pokok[]" required>' +
                    '<option value="">Pilih Permasalahan Pokok</option>' +
                    getPermasalahanPokokOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 7px;">' +
                    '<button type="button" class="btn btn-danger btn-remove-pp">' +
                    '<i class="notika-icon notika-trash"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $('#pp-container').append(newRow);
            });

            $(document).on('click', '.btn-remove-pp', function() {
                if ($('.pp-row').length > 1) {
                    $(this).closest('.pp-row').remove();
                } else {
                    alert('Minimal harus ada satu Permasalahan Pokok');
                }
            });

            $("#FormTambahPP").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                var ppValues = [];
                $('select[name="permasalahan_pokok[]"]').each(function() {
                    if ($(this).val()) {
                        ppValues.push($(this).val());
                    }
                });
                formData = formData.filter(item => item.name !== 'permasalahan_pokok[]');
                formData.push({name: 'permasalahan_pokok', value: ppValues.join(',')});
                formData.push({name: CSRF_NAME, value: CSRF_TOKEN});
                
                $.post(BaseURL + "Daerah/TambahPermasalahanPokokIsuStrategis", $.param(formData))
                    .done(function(res) {
                        if (res == '1') {
                            window.location.reload();
                        } else {
                            alert("Gagal menambahkan Permasalahan Pokok: " + res);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            $(document).on("click", ".EditPP", function() {
                var id = $(this).data('id');
                var pp = $(this).data('pp');
                $("#IdPP").val(id);
                var ppList = pp.split(",");
                var list = '';
                permasalahanPokokOptions.forEach(function(option) {
                    var checked = ppList.includes(option.nama) ? 'checked' : '';
                    list += '<label><input style="margin-top: 10px;" type="checkbox" name="PP" value="' + option.nama + '" ' + checked + '> ' + option.nama + '</label><br>';
                });
                $("#ListPP").html(list);
                $("#ModalEditPP").modal('show');
            });

            $("#SavePP").click(function() {
                var ppValues = [];
                $.each($("input[name='PP']:checked"), function() {
                    ppValues.push($(this).val());
                });
                var data = {
                    id: $("#IdPP").val(),
                    permasalahan_pokok: ppValues.join(","),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                $.post(BaseURL + "Daerah/EditPermasalahanPokokIsuStrategis", data)
                    .done(function(res) {
                        if (res == '1') {
                            window.location.reload();
                        } else {
                            alert(res);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            // ========== ISU KLHS FUNCTIONS ==========
            $(document).on("click", ".TambahKLHS", function() {
                var id = $(this).data('id');
                $("#KLHSId").val(id);
                $("#klhs-container").html('<div class="form-group klhs-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<label>Isu KLHS Daerah</label>' +
                    '<select class="form-control klhs-select" name="isu_klhs[]" required>' +
                    '<option value="">Pilih Isu KLHS</option>' +
                    getIsuKLHSOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 25px;">' +
                    '<button type="button" class="btn btn-success btn-add-klhs">' +
                    '<i class="notika-icon notika-plus-symbol"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $("#ModalTambahKLHS").modal('show');
            });

            $(document).on('click', '.btn-add-klhs', function() {
                var newRow = $('<div class="form-group klhs-row">' +
                    '<div class="row">' +
                    '<div class="col-md-10">' +
                    '<select class="form-control klhs-select" name="isu_klhs[]" required>' +
                    '<option value="">Pilih Isu KLHS</option>' +
                    getIsuKLHSOptions() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding-top: 7px;">' +
                    '<button type="button" class="btn btn-danger btn-remove-klhs">' +
                    '<i class="notika-icon notika-trash"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $('#klhs-container').append(newRow);
            });

            $(document).on('click', '.btn-remove-klhs', function() {
                if ($('.klhs-row').length > 1) {
                    $(this).closest('.klhs-row').remove();
                } else {
                    alert('Minimal harus ada satu Isu KLHS');
                }
            });

            $("#FormTambahKLHS").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                var klhsValues = [];
                $('select[name="isu_klhs[]"]').each(function() {
                    if ($(this).val()) {
                        klhsValues.push($(this).val());
                    }
                });
                formData = formData.filter(item => item.name !== 'isu_klhs[]');
                formData.push({name: 'isu_klhs', value: klhsValues.join(',')});
                formData.push({name: CSRF_NAME, value: CSRF_TOKEN});
                
                $.post(BaseURL + "Daerah/TambahIsuKLHSIsuStrategis", $.param(formData))
                    .done(function(res) {
                        if (res == '1') {
                            window.location.reload();
                        } else {
                            alert("Gagal menambahkan Isu KLHS: " + res);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            $(document).on("click", ".EditKLHS", function() {
                var id = $(this).data('id');
                var klhs = $(this).data('klhs');
                $("#IdKLHS").val(id);
                var klhsList = klhs.split(",");
                var list = '';
                isuKLHSOptions.forEach(function(option) {
                    var checked = klhsList.includes(option.nama) ? 'checked' : '';
                    list += '<label><input style="margin-top: 10px;" type="checkbox" name="KLHS" value="' + option.nama + '" ' + checked + '> ' + option.nama + '</label><br>';
                });
                $("#ListKLHS").html(list);
                $("#ModalEditKLHS").modal('show');
            });

            $("#SaveKLHS").click(function() {
                var klhsValues = [];
                $.each($("input[name='KLHS']:checked"), function() {
                    klhsValues.push($(this).val());
                });
                var data = {
                    id: $("#IdKLHS").val(),
                    isu_klhs: klhsValues.join(","),
                    [CSRF_NAME]: CSRF_TOKEN
                };
                $.post(BaseURL + "Daerah/EditIsuKLHSIsuStrategis", data)
                    .done(function(res) {
                        if (res == '1') {
                            window.location.reload();
                        } else {
                            alert(res);
                        }
                    })
                    .fail(function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    });
            });

            // Reset modals when closed
            $('#ModalInputIsuStrategis').on('hidden.bs.modal', function() {
                $("#PeriodeRPJMD").val('');
                $("#NamaIsuStrategis").val('');
                $("#PeriodeIsuStrategisNasional").val('');
                $("#Kementerian").html('<option value="">-- Pilih Kementerian --</option>');
                $("#ListIsuStrategisNasional").html('');
            });

            $('#ModalEditIsuStrategis').on('hidden.bs.modal', function() {
                $("#EditPeriodeRPJMD").val('');
                $("#EditNamaIsuStrategis").val('');
                $("#EditPeriodeIsuStrategisNasional").val('');
                $("#EditKementerian").html('<option value="">-- Pilih Kementerian --</option>');
                $("#EditListIsuStrategisNasional").html('');
                $("#EditIsuData").remove();
            });

            $('#ModalTambahPotensi').on('hidden.bs.modal', function() {
                $("#potensi-container").html('');
                $("#PotensiId").val('');
            });

            $('#ModalTambahPP').on('hidden.bs.modal', function() {
                $("#pp-container").html('');
                $("#PPId").val('');
            });

            $('#ModalTambahKLHS').on('hidden.bs.modal', function() {
                $("#klhs-container").html('');
                $("#KLHSId").val('');
            });

            $('#ModalEditPotensi').on('hidden.bs.modal', function() {
                $("#ListPotensi").html('');
                $("#IdPotensi").val('');
            });

            $('#ModalEditPP').on('hidden.bs.modal', function() {
                $("#ListPP").html('');
                $("#IdPP").val('');
            });

            $('#ModalEditKLHS').on('hidden.bs.modal', function() {
                $("#ListKLHS").html('');
                $("#IdKLHS").val('');
            });
        });
    </script>
</div>