<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
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
                        <?php } ?>

                        <!-- Menampilkan Wilayah setelah filter -->
                        <?php if (!empty($KodeWilayah)) { ?>
                            <?php 
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                if (empty($Misi)) {
                                    $pesan_error = "Tidak ada data untuk wilayah: $nama_wilayah";
                                }
                            ?>
                            <div class="alert <?= empty($Misi) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                <?php if (!empty($pesan_error)) { ?>
                                    <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputMisi"><i class="notika-icon bi-plus-lg"></i> <b>Tambah Misi RPJPD</b></button>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="text-center">No</th>
                                        <th style="width: 25%;">Misi RPJPN (Nasional)</th>
                                        <th style="width: 25%;">Misi RPJPDP (Provinsi)</th>
                                        <th style="width: 30%;">Misi RPJPD</th>
                                        <th style="width: 15%;">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width: 10%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Misi as $key) { 
                                        // Decode Misi RPJPDP (Provinsi) - gunakan field rpjpdp
                                        $misiRPJPDP = '';
                                        if (!empty($key['rpjpdp'])) {
                                            $idsRPJPDP = explode('$', $key['rpjpdp']);
                                            $namaRPJPDP = [];
                                            foreach ($idsRPJPDP as $id) {
                                                if (!empty($id)) {
                                                    $row = $this->db->select('Misi')->where('Id', $id)->where('deleted_at IS NULL')->get('misirpjpdp')->row_array();
                                                    if ($row) {
                                                        $namaRPJPDP[] = $row['Misi'];
                                                    }
                                                }
                                            }
                                            $misiRPJPDP = implode('; ', $namaRPJPDP);
                                        }

                                        // Decode Misi RPJPN (Nasional) - gunakan field rpjpn
                                        $misiRPJPN = '';
                                        if (!empty($key['rpjpn'])) {
                                            $idsRPJPN = explode('$', $key['rpjpn']);
                                            $namaRPJPN = [];
                                            foreach ($idsRPJPN as $id) {
                                                if (!empty($id)) {
                                                    $row = $this->db->select('Misi')->where('Id', $id)->where('deleted_at IS NULL')->get('misirpjpn')->row_array();
                                                    if ($row) {
                                                        $namaRPJPN[] = $row['Misi'];
                                                    }
                                                }
                                            }
                                            $misiRPJPN = implode('; ', $namaRPJPN);
                                        }
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <!-- Kolom Misi RPJPN - dengan titik/bulet -->
                                        <td style="vertical-align: middle;">
                                            <?php if (!empty($misiRPJPN)) { ?>
                                                <?php 
                                                    // Ubah string menjadi array jika mengandung separator
                                                    $misiRPJPNArray = explode('; ', $misiRPJPN);
                                                ?>
                                                <?php if (count($misiRPJPNArray) > 1) { ?>
                                                    <ul style="margin: 0; padding-left: 18px; list-style-type: disc;">
                                                        <?php foreach ($misiRPJPNArray as $item) { ?>
                                                            <?php if (!empty(trim($item))) { ?>
                                                                <li style="font-size: 12px; margin-bottom: 3px; line-height: 1.4; list-style-type: disc;">
                                                                    <?= html_escape(trim($item)) ?>
                                                                </li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } else { ?>
                                                    <?= html_escape($misiRPJPN) ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <span class="text-muted">-</span>
                                            <?php } ?>
                                        </td>

                                            <!-- Kolom Misi RPJPDP - dengan titik/bulet -->
                                            <td style="vertical-align: middle;">
                                                <?php if (!empty($misiRPJPDP)) { ?>
                                                    <?php 
                                                        // Ubah string menjadi array jika mengandung separator
                                                        $misiRPJPDPArray = explode('; ', $misiRPJPDP);
                                                    ?>
                                                    <?php if (count($misiRPJPDPArray) > 1) { ?>
                                                        <ul style="margin: 0; padding-left: 18px; list-style-type: disc;">
                                                            <?php foreach ($misiRPJPDPArray as $item) { ?>
                                                                <?php if (!empty(trim($item))) { ?>
                                                                    <li style="font-size: 12px; margin-bottom: 3px; line-height: 1.4; list-style-type: disc;">
                                                                        <?= html_escape(trim($item)) ?>
                                                                    </li>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } else { ?>
                                                        <?= html_escape($misiRPJPDP) ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <span class="text-muted">-</span>
                                                <?php } ?>
                                            </td>
                                        <td style="vertical-align: middle;"><?=html_escape($key['Misi'])?></td>
                                        <td style="vertical-align: middle;"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></td>
                                        
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                        Edit="<?=$key['Id'].'|'.$key['_Id'].'|'.$key['Misi'].'|'.$key['rpjpn'].'|'.$key['rpjpdp']?>">
                                                    <i class="notika-icon notika-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                        Hapus="<?=$key['Id']?>">
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
</div>

<!-- ============================================================ -->
<!-- MODAL INPUT MISI -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalInputMisi" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 550px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>TAMBAH MISI RPJPD</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <!-- Periode RPJPD -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="Periode">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Visi RPJPD -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Visi RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="IdVisi"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Misi RPJPD -->
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="Misi" placeholder="Input Misi RPJPD"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <!-- Misi RPJPDP (Provinsi) -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode RPJPDP</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodeRPJPDP">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($VisiRPJPDP as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi RPJPDP</b></label>
                                        </div>
                                        <div style="margin-top: 3px;" class="col-lg-9">
                                            <div class="accordion-stn">
                                                <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJPDP" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse notika-accrodion-cus">
                                                        <div class="panel-heading" role="tab">
                                                            <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJPDP" href="#MisiRPJPDP-one" aria-expanded="true">Pilih Misi RPJPDP</a></b>
                                                        </div>
                                                        <div id="MisiRPJPDP-one" class="collapse in" role="tabpanel">
                                                            <div class="panel-body" style="padding-top: 0px;">
                                                                <div class="nk-int-st text-justify" id="MisiRPJPDP"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <!-- Misi RPJPN (Nasional) -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode RPJPN</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodeRPJPN">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($VisiRPJPN as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi RPJPN</b></label>
                                        </div>
                                        <div style="margin-top: 3px;" class="col-lg-9">
                                            <div class="accordion-stn">
                                                <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJPN" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse notika-accrodion-cus">
                                                        <div class="panel-heading" role="tab">
                                                            <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJPN" href="#MisiRPJPN-one" aria-expanded="true">Pilih Misi RPJPN</a></b>
                                                        </div>
                                                        <div id="MisiRPJPN-one" class="collapse in" role="tabpanel">
                                                            <div class="panel-body" style="padding-top: 0px;">
                                                                <div class="nk-int-st text-justify" id="MisiRPJPN"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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

<!-- ============================================================ -->
<!-- MODAL EDIT MISI -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditMisi" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 550px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>EDIT MISI RPJPD</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <input type="hidden" id="Id">
                                    <!-- Periode RPJPD -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b></label>
                                        </div>
                                        <div style="margin-bottom: 5px;" class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_Periode">
                                                    <?php foreach ($Visi as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Visi RPJPD -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Visi RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="_IdVisi"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Misi RPJPD -->
                                    <div class="row" style="margin-top: 9px;">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi RPJPD</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="3" id="_Misi" placeholder="Input Misi RPJPD"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <!-- Misi RPJPDP (Provinsi) -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode RPJPDP</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodeRPJPDP_">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($VisiRPJPDP as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi RPJPDP</b></label>
                                        </div>
                                        <div style="margin-top: 3px;" class="col-lg-9">
                                            <div class="accordion-stn">
                                                <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJPDP_" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse notika-accrodion-cus">
                                                        <div class="panel-heading" role="tab">
                                                            <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJPDP_" href="#_MisiRPJPDP" aria-expanded="true">Pilih Misi RPJPDP</a></b>
                                                        </div>
                                                        <div id="_MisiRPJPDP" class="collapse in" role="tabpanel">
                                                            <div class="panel-body" style="padding-top: 0px;">
                                                                <div class="nk-int-st text-justify" id="MisiRPJPDP_"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <!-- Misi RPJPN (Nasional) -->
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode RPJPN</b></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="PeriodeRPJPN_">
                                                    <option value="">Pilih Periode</option>
                                                    <?php foreach ($VisiRPJPN as $key) { ?>
                                                        <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi RPJPN</b></label>
                                        </div>
                                        <div style="margin-top: 3px;" class="col-lg-9">
                                            <div class="accordion-stn">
                                                <div class="panel-group" data-collapse-color="nk-green" id="AccrodionMisiRPJPN_" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-collapse notika-accrodion-cus">
                                                        <div class="panel-heading" role="tab">
                                                            <b><a data-toggle="collapse" data-parent="#AccrodionMisiRPJPN_" href="#_MisiRPJPN" aria-expanded="true">Pilih Misi RPJPN</a></b>
                                                        </div>
                                                        <div id="_MisiRPJPN" class="collapse in" role="tabpanel">
                                                            <div class="panel-body" style="padding-top: 0px;">
                                                                <div class="nk-int-st text-justify" id="MisiRPJPN_"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="Edit"><b>UPDATE</b></button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
/* Style untuk checkbox di modal */
.accordion-stn .panel-body label {
    display: block;
    padding: 5px 0;
    cursor: pointer;
}
.accordion-stn .panel-body label input[type="checkbox"] {
    margin-right: 10px;
}
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery-price-slider.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.scrollUp.min.js"></script>
<script src="../js/meanmenu/jquery.meanmenu.js"></script>
<script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>
<script src="../js/main.js"></script>

<script>
var BaseURL = '<?=base_url()?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

jQuery(document).ready(function($) {
    // ==============================================
    // FILTER WILAYAH UNTUK PENGGUNA BELUM LOGIN
    // ==============================================
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
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true);
                $("#KabKota").html('<option value="">Memuat...</option>');
            },
            success: function(Respon) {
                var Data = JSON.parse(Respon);
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
            },
            error: function() {
                $("#KabKota").html('<option value="">Gagal memuat data</option>').prop('disabled', false);
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
        $("#Filter").prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Memuat...');
        
        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { 
                KodeWilayah: kodeWilayah, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            success: function(Respon) {
                if (Respon.trim() === '1' || Respon.trim() === 'success') {
                    window.location.href = BaseURL + "Daerah/MisiRPJPD";
                } else {
                    alert(Respon || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                }
            },
            error: function() {
                alert("Gagal menghubungi server!");
                $("#Filter").prop('disabled', false).html('<b>Filter</b>');
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

    // ============================================================
    // FUNGSI UNTUK MODAL INPUT
    // ============================================================
    
    // Load Visi berdasarkan Periode
    $("#Periode").change(function(){
        if ($("#Periode").val() == "") {
            alert("Mohon Input Periode")
        } else {
            $.post(BaseURL+"Daerah/GetVisiRPJPD", {Id : $("#Periode").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Visi = ''
                for (let i = 0; i < Data.length; i++) {
                    Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>'
                }
                $("#IdVisi").html(Visi)
            })                         
        }
    });

    // Load Misi RPJPDP berdasarkan Periode
    $("#PeriodeRPJPDP").change(function(){
        if ($("#PeriodeRPJPDP").val() == "") {
            alert("Mohon Input Periode RPJPDP")
        } else {
            $.post(BaseURL+"Daerah/GetMisiRPJPDP", {Id : $("#PeriodeRPJPDP").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Misi = ''
                for (let i = 0; i < Data.length; i++) {
                    Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="rpjpdp" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                }
                $("#MisiRPJPDP").html(Misi)
            })                         
        }
    });

    // Load Misi RPJPN berdasarkan Periode
    $("#PeriodeRPJPN").change(function(){
        if ($("#PeriodeRPJPN").val() == "") {
            alert("Mohon Input Periode RPJPN")
        } else {
            $.post(BaseURL+"Daerah/GetMisiRPJPN", {Id : $("#PeriodeRPJPN").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Misi = ''
                for (let i = 0; i < Data.length; i++) {
                    Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="rpjpn" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                }
                $("#MisiRPJPN").html(Misi)
            })                         
        }
    });

    // ============================================================
    // PROSES INPUT
    // ============================================================
    $("#Input").click(function() {
    var rpjpdp = []
    $.each($("input[name='rpjpdp']:checked"), function(){
        rpjpdp.push($(this).val())
    })
    var rpjpn = []
    $.each($("input[name='rpjpn']:checked"), function(){
        rpjpn.push($(this).val())
    })
    
    if ($("#Periode").val() == "") {
        alert("Mohon Pilih Periode RPJPD")
    } else if ($("#IdVisi").val() == "" || $("#IdVisi").val() == null) {
        alert("Mohon Pilih Visi RPJPD")
    } else if ($("#Misi").val() == "") {
        alert('Input Misi RPJPD Belum Benar!')
    } else if ($("#PeriodeRPJPDP").val() == "") {
        alert("Mohon Pilih Periode RPJPDP")
    } else if (rpjpdp.length == 0) {
        alert("Mohon Checklist Misi RPJPDP!")
    } else if ($("#PeriodeRPJPN").val() == "") {
        alert("Mohon Pilih Periode RPJPN")
    } else if (rpjpn.length == 0) {
        alert("Mohon Checklist Misi RPJPN!")
    } else {
        var Misi = { 
            _Id    : $("#IdVisi").val(),
            rpjpn  : rpjpn,
            rpjpdp : rpjpdp,
            Misi   : $("#Misi").val() 
        }
        $.post(BaseURL+"Daerah/InputMisiRPJPD", Misi).done(function(Respon) {
            // LANGSUNG REFRESH TANPA PENGECEKAN
            window.location = BaseURL+"Daerah/MisiRPJPD"
        }).fail(function() {
            // Jika gagal, tetap refresh
            window.location = BaseURL+"Daerah/MisiRPJPD"
        })
    }
});

    // ============================================================
    // FUNGSI UNTUK MODAL EDIT
    // ============================================================
    
    // Load Visi berdasarkan Periode (Edit)
    $("#_Periode").change(function(){
        if ($("#_Periode").val() == "") {
            alert("Mohon Input Periode")
        } else {
            $.post(BaseURL+"Daerah/GetVisiRPJPD", {Id : $("#_Periode").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Visi = ''
                for (let i = 0; i < Data.length; i++) {
                    Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>'
                }
                $("#_IdVisi").html(Visi)
            })                         
        }
    });

    // Load Misi RPJPDP berdasarkan Periode (Edit)
    $("#PeriodeRPJPDP_").change(function(){
        if ($("#PeriodeRPJPDP_").val() == "") {
            alert("Mohon Input Periode RPJPDP")
        } else {
            $.post(BaseURL+"Daerah/GetMisiRPJPDP", {Id : $("#PeriodeRPJPDP_").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Misi = ''
                for (let i = 0; i < Data.length; i++) {
                    Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="rpjpdp" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                }
                $("#MisiRPJPDP_").html(Misi)
            })                         
        }
    });

    // Load Misi RPJPN berdasarkan Periode (Edit)
    $("#PeriodeRPJPN_").change(function(){
        if ($("#PeriodeRPJPN_").val() == "") {
            alert("Mohon Input Periode RPJPN")
        } else {
            $.post(BaseURL+"Daerah/GetMisiRPJPN", {Id : $("#PeriodeRPJPN_").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var Misi = ''
                for (let i = 0; i < Data.length; i++) {
                    Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="rpjpn" value="'+Data[i].Id+'"> '+Data[i].Misi+'</label><br>'
                }
                $("#MisiRPJPN_").html(Misi)
            })                         
        }
    });

    // ============================================================
    // PROSES EDIT - Load Data
    // ============================================================
    $(document).on("click",".Edit",function(){
        var Data = $(this).attr('Edit');
        var Pisah = Data.split("|");
        
        // Data: [0]=Id, [1]=_Id, [2]=Misi, [3]=rpjpn, [4]=rpjpdp
        $("#Id").val(Pisah[0]);
        $("#_Periode").val(Pisah[1]);
        
        // Load Visi
        $.post(BaseURL+"Daerah/GetVisiRPJPD", {Id : $("#_Periode").val()}).done(function(Respon) {
            var Data = JSON.parse(Respon);
            var Visi = '';
            for (let i = 0; i < Data.length; i++) {
                Visi += '<option value="'+Data[i].Id+'">'+Data[i].Visi+'</option>';
            }
            $("#_IdVisi").html(Visi);
            $("#_IdVisi").val(Pisah[1]); // Set selected
        });
        
        $("#_Misi").val(Pisah[2]);
        
        // Load Misi RPJPN
        var rpjpnIds = Pisah[3] ? Pisah[3].split("$") : [];
        if (rpjpnIds.length > 0 && rpjpnIds[0] !== '') {
            // Cari periode dari visi RPJPN
            $.post(BaseURL+"Daerah/GetPeriodeRPJPNByVisiId", {visi_id : rpjpnIds[0]}).done(function(Respon) {
                var Data = JSON.parse(Respon);
                if (Data.length > 0) {
                    $("#PeriodeRPJPN_").val(Data[0].Id);
                    // Load Misi RPJPN
                    $.post(BaseURL+"Daerah/GetMisiRPJPN", {Id : Data[0].Id}).done(function(Respon) {
                        var Data = JSON.parse(Respon);
                        var Misi = '';
                        for (let i = 0; i < Data.length; i++) {
                            var checked = rpjpnIds.includes(String(Data[i].Id)) ? 'checked' : '';
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="rpjpn" value="'+Data[i].Id+'" '+checked+'> '+Data[i].Misi+'</label><br>';
                        }
                        $("#MisiRPJPN_").html(Misi);
                    });
                }
            });
        } else {
            $("#PeriodeRPJPN_").val('');
            $("#MisiRPJPN_").html('');
        }
        
        // Load Misi RPJPDP
        var rpjpdpIds = Pisah[4] ? Pisah[4].split("$") : [];
        if (rpjpdpIds.length > 0 && rpjpdpIds[0] !== '') {
            $.post(BaseURL+"Daerah/GetPeriodeRPJPDPByVisiId", {visi_id : rpjpdpIds[0]}).done(function(Respon) {
                var Data = JSON.parse(Respon);
                if (Data.length > 0) {
                    $("#PeriodeRPJPDP_").val(Data[0].Id);
                    $.post(BaseURL+"Daerah/GetMisiRPJPDP", {Id : Data[0].Id}).done(function(Respon) {
                        var Data = JSON.parse(Respon);
                        var Misi = '';
                        for (let i = 0; i < Data.length; i++) {
                            var checked = rpjpdpIds.includes(String(Data[i].Id)) ? 'checked' : '';
                            Misi += '<label><input style="margin-top: 10px;" type="checkbox" name="rpjpdp" value="'+Data[i].Id+'" '+checked+'> '+Data[i].Misi+'</label><br>';
                        }
                        $("#MisiRPJPDP_").html(Misi);
                    });
                }
            });
        } else {
            $("#PeriodeRPJPDP_").val('');
            $("#MisiRPJPDP_").html('');
        }
        
        $('#ModalEditMisi').modal("show");
    });

    // ============================================================
    // PROSES UPDATE
    // ============================================================
    $("#Edit").click(function() {
    var rpjpdp = [];
    $.each($("input[name='rpjpdp']:checked"), function(){
        rpjpdp.push($(this).val());
    });
    
    var rpjpn = [];
    $.each($("input[name='rpjpn']:checked"), function(){
        rpjpn.push($(this).val());
    });
    
    if ($("#_Periode").val() == "") {
        alert("Mohon Pilih Periode RPJPD");
    } else if ($("#_IdVisi").val() == "" || $("#_IdVisi").val() == null) {
        alert("Mohon Pilih Visi RPJPD");
    } else if ($("#_Misi").val() == "") {
        alert('Input Misi RPJPD Belum Benar!');
    } else if ($("#PeriodeRPJPDP_").val() == "") {
        alert("Mohon Pilih Periode RPJPDP");
    } else if (rpjpdp.length == 0) {
        alert("Mohon Checklist Misi RPJPDP!");
    } else if ($("#PeriodeRPJPN_").val() == "") {
        alert("Mohon Pilih Periode RPJPN");
    } else if (rpjpn.length == 0) {
        alert("Mohon Checklist Misi RPJPN!");
    } else {
        var Misi = { 
            Id     : $("#Id").val(),
            _Id    : $("#_IdVisi").val(),
            rpjpn  : rpjpn,
            rpjpdp : rpjpdp,
            Misi   : $("#_Misi").val() 
        };
        $.post(BaseURL+"Daerah/EditMisiRPJPD", Misi).done(function(Respon) {
            // LANGSUNG REFRESH TANPA PENGECEKAN
            window.location = BaseURL+"Daerah/MisiRPJPD";
        }).fail(function() {
            // Jika gagal, tetap refresh
            window.location = BaseURL+"Daerah/MisiRPJPD";
        });
    }
});

    // ============================================================
    // PROSES HAPUS
    // ============================================================
    $('#data-table-basic tbody').on('click', '.Hapus', function () {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        var Misi = { Id: $(this).attr('Hapus') }
        $.post(BaseURL+"Daerah/HapusMisiRPJPD", Misi).done(function(Respon) {
            // LANGSUNG REFRESH TANPA PENGECEKAN
            window.location = BaseURL+"Daerah/MisiRPJPD"
        }).fail(function() {
            // Jika gagal, tetap refresh
            window.location = BaseURL+"Daerah/MisiRPJPD"
        })
    }
});
});
</script>

</body>
</html>