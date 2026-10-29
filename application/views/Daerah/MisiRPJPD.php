<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 4px 18px rgba(0,0,0,0.06); padding: 25px 25px 30px; background: #fff; border: 1px solid #e2e8f0;">
                        <!-- Filter untuk pengguna yang belum login -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: flex-end; gap: 15px; flex-wrap: wrap;">
                                    <div style="flex: 1 1 250px; min-width: 200px;">
                                        <label for="Provinsi" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Provinsi</label>
                                        <select class="form-control" id="Provinsi" style="height: 38px; border-radius: 6px;">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div style="flex: 1 1 250px; min-width: 200px;">
                                        <label for="KabKota" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Kab/Kota</label>
                                        <select class="form-control" id="KabKota" style="height: 38px; border-radius: 6px;">
                                            <option value="">Pilih Kab/Kota</option>
                                        </select>
                                    </div>
                                    <div style="flex: 0 0 auto;">
                                        <button class="btn btn-primary notika-btn-primary" id="Filter" style="height: 38px; padding: 0 25px; font-weight: 700; border-radius: 6px;">
                                            Filter
                                        </button>
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
                            <div class="alert <?= empty($Misi) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px; border-radius: 8px;">
                                <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                <?php if (!empty($pesan_error)) { ?>
                                    <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- HEADER MENU -->
                        <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-sm-6">
                                    <h3 style="font-weight: 800; color: #1f2937; margin: 0 0 5px 0; display: flex; align-items: center; gap: 10px;">
                                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 8px; background: #e0f2fe; color: #0284c7; font-size: 18px;">
                                            <i class="fa fa-compass"></i>
                                        </span>
                                        MISI RPJPD
                                    </h3>
                                    <div style="color: #64748b; font-size: 13px;">
                                        Penyelarasan Misi RPJPD Daerah dengan Misi RPJPDP Provinsi dan Misi RPJPN Nasional.
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6 text-right" style="display: flex; justify-content: flex-end; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputMisi" style="border-radius: 6px; font-weight: 700; padding: 8px 18px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(22, 163, 74, 0.25);">
                                            <i class="fa fa-plus-circle"></i> Tambah Misi RPJPD
                                        </button>
                                    <?php } ?>
                                </div>
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
    <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
            
            <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #e6fcf5; color: #0ca678;">
                        <i class="fa fa-compass"></i>
                    </span>
                    Tambah Misi RPJPD
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
            </div>

            <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="Periode" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode RPJPD <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="Periode" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                <option value="">Pilih Periode</option>
                                <?php foreach ($Visi as $key) { ?>
                                    <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="IdVisi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Visi RPJPD <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="IdVisi" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                <option value="">Pilih Visi RPJPD</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Misi RPJPD -->
                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="Misi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                        Rumusan Misi RPJPD <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" rows="3" id="Misi" placeholder="Input rumusan Misi RPJPD..." style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                </div>

                <!-- Misi RPJPDP (Provinsi) -->
                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="PeriodeRPJPDP" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                        Periode Misi RPJPD Provinsi
                    </label>
                    <select class="form-control" id="PeriodeRPJPDP" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                        <option value="">Pilih Periode Provinsi</option>
                        <?php foreach ($VisiRPJPDP as $key) { ?>
                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                        <?php } ?>
                    </select>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <div class="accordion-stn">
                            <div class="panel-group" id="AccrodionMisiRPJPDP" role="tablist" style="margin-bottom: 0;">
                                <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                    <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                        <a data-toggle="collapse" href="#MisiRPJPDP-one" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                            <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Misi RPJPDP (Provinsi)
                                            </span>
                                            <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                        </a>
                                    </div>
                                    <div id="MisiRPJPDP-one" class="collapse in" role="tabpanel">
                                        <div class="panel-body" style="padding: 0;">
                                            <div class="text-justify" id="MisiRPJPDP" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 180px; overflow-y: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Misi RPJPN (Nasional) -->
                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="PeriodeRPJPN" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                        Periode Misi RPJPN (Nasional)
                    </label>
                    <select class="form-control" id="PeriodeRPJPN" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                        <option value="">Pilih Periode Nasional</option>
                        <?php foreach ($VisiRPJPN as $key) { ?>
                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                        <?php } ?>
                    </select>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <div class="accordion-stn">
                            <div class="panel-group" id="AccrodionMisiRPJPN" role="tablist" style="margin-bottom: 0;">
                                <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                    <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                        <a data-toggle="collapse" href="#MisiRPJPN-one" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                            <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Misi RPJPN (Nasional)
                                            </span>
                                            <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                        </a>
                                    </div>
                                    <div id="MisiRPJPN-one" class="collapse in" role="tabpanel">
                                        <div class="panel-body" style="padding: 0;">
                                            <div class="text-justify" id="MisiRPJPN" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 180px; overflow-y: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 14px 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 18px; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">
                    Batal
                </button>
                <button class="btn btn-success notika-btn-success" id="Input" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 22px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                    <i class="fa fa-save"></i> <b>SIMPAN</b>
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT MISI -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditMisi" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
            
            <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef3c7; color: #d97706;">
                        <i class="fa fa-pencil-square-o"></i>
                    </span>
                    Edit Misi RPJPD
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
            </div>

            <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                <input type="hidden" id="Id">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="_Periode" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode RPJPD <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="_Periode" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                <?php foreach ($Visi as $key) { ?>
                                    <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="_IdVisi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Visi RPJPD <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="_IdVisi" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;"></select>
                        </div>
                    </div>
                </div>

                <!-- Misi RPJPD -->
                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="_Misi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                        Rumusan Misi RPJPD <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" rows="3" id="_Misi" placeholder="Input rumusan Misi RPJPD..." style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                </div>

                <!-- Misi RPJPDP (Provinsi) -->
                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="PeriodeRPJPDP_" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                        Periode Misi RPJPD Provinsi
                    </label>
                    <select class="form-control" id="PeriodeRPJPDP_" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                        <option value="">Pilih Periode Provinsi</option>
                        <?php foreach ($VisiRPJPDP as $key) { ?>
                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                        <?php } ?>
                    </select>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <div class="accordion-stn">
                            <div class="panel-group" id="AccrodionMisiRPJPDP_" role="tablist" style="margin-bottom: 0;">
                                <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                    <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                        <a data-toggle="collapse" href="#_MisiRPJPDP" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                            <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Misi RPJPDP (Provinsi)
                                            </span>
                                            <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                        </a>
                                    </div>
                                    <div id="_MisiRPJPDP" class="collapse in" role="tabpanel">
                                        <div class="panel-body" style="padding: 0;">
                                            <div class="text-justify" id="MisiRPJPDP_" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 180px; overflow-y: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Misi RPJPN (Nasional) -->
                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="PeriodeRPJPN_" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                        Periode Misi RPJPN (Nasional)
                    </label>
                    <select class="form-control" id="PeriodeRPJPN_" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                        <option value="">Pilih Periode Nasional</option>
                        <?php foreach ($VisiRPJPN as $key) { ?>
                            <option value="<?=$key['Id']?>"><?=$key['TahunMulai'].' - '.$key['TahunAkhir']?></option>
                        <?php } ?>
                    </select>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <div class="accordion-stn">
                            <div class="panel-group" id="AccrodionMisiRPJPN_" role="tablist" style="margin-bottom: 0;">
                                <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                    <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                        <a data-toggle="collapse" href="#_MisiRPJPN" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                            <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Misi RPJPN (Nasional)
                                            </span>
                                            <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                        </a>
                                    </div>
                                    <div id="_MisiRPJPN" class="collapse in" role="tabpanel">
                                        <div class="panel-body" style="padding: 0;">
                                            <div class="text-justify" id="MisiRPJPN_" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 180px; overflow-y: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 14px 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 18px; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">
                    Batal
                </button>
                <button class="btn btn-success notika-btn-success" id="Edit" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 22px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                    <i class="fa fa-save"></i> <b>UPDATE</b>
                </button>
            </div>

        </div>
    </div>
</div>

<style>
/* Accordion Fix - Hilangkan icon default Notika yang menumpuk dan rapikan tampilan */
.notika-accrodion-cus .panel-heading:before,
.notika-accrodion-cus .panel-heading:after,
.panel-collapse .panel-heading:before,
.panel-collapse .panel-heading:after {
    display: none !important;
    content: none !important;
}
.accordion-toggle-link {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    text-decoration: none !important;
    user-select: none;
}
.accordion-toggle-link:hover,
.accordion-toggle-link:focus {
    text-decoration: none !important;
    color: #0284c7 !important;
}
.accordion-toggle-link.collapsed .accordion-arrow {
    transform: rotate(-90deg) !important;
}

/* Modal Header styling - Tombol silang pojok kanan, judul pojok kiri */
.modal-header {
    position: relative !important;
    padding: 16px 24px !important;
}
.modal-header:before,
.modal-header:after {
    display: none !important;
}
.modal-header .close {
    position: absolute !important;
    right: 20px !important;
    top: 16px !important;
    margin: 0 !important;
    padding: 0 !important;
    font-size: 24px !important;
    opacity: 0.6 !important;
    line-height: 1 !important;
    cursor: pointer !important;
    border: none !important;
    background: transparent !important;
    z-index: 10 !important;
    transition: opacity 0.2s;
}
.modal-header .close:hover {
    opacity: 1 !important;
}
.modal-header .modal-title {
    text-align: left !important;
    margin: 0 !important;
    padding-right: 40px !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

/* Styling Tabel Sesuai Tema Notika / Menu Lain */
#data-table-basic {
    border-collapse: collapse;
    width: 100% !important;
}
#data-table-basic thead th {
    background-color: #f1f5f9 !important;
    color: #334155 !important;
    font-weight: 700 !important;
    border: 1px solid #cbd5e1 !important;
    font-size: 11.5px !important;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    padding: 10px 8px !important;
    vertical-align: middle !important;
}
#data-table-basic tbody td {
    border: 1px solid #e2e8f0;
    vertical-align: middle !important;
    font-size: 12px;
}
#data-table-basic tbody tr:hover {
    background-color: #f8fafc;
}

/* ==============================================
   UNIFIED BUTTON STYLING
   ============================================== */
.btn {
    border-radius: 8px !important;
    transition: all 0.2s ease !important;
    font-weight: 600 !important;
}
.btn-sm, .btn-xs {
    border-radius: 6px !important;
    font-weight: 600 !important;
}
.btn.Edit, .btn.EditSasaran, .btn.EditPeriodeMisi, .btn-amber {
    background-color: #f59e0b !important;
    border-color: #f59e0b !important;
    color: #ffffff !important;
    border-radius: 6px !important;
    padding: 5px 9px !important;
    font-size: 12px !important;
    line-height: 1.4 !important;
    box-shadow: 0 1px 3px rgba(245, 158, 11, 0.25) !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.btn.Edit:hover, .btn.EditSasaran:hover, .btn.EditPeriodeMisi:hover, .btn-amber:hover {
    background-color: #d97706 !important;
    border-color: #d97706 !important;
    color: #ffffff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 3px 6px rgba(245, 158, 11, 0.35) !important;
}
.btn.Hapus, .btn.HapusSasaran, .btn.HapusPeriodeMisi, .btn-danger {
    background-color: #ef4444 !important;
    border-color: #ef4444 !important;
    color: #ffffff !important;
    border-radius: 6px !important;
    padding: 5px 9px !important;
    font-size: 12px !important;
    line-height: 1.4 !important;
    box-shadow: 0 1px 3px rgba(239, 68, 68, 0.25) !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.btn.Hapus:hover, .btn.HapusSasaran:hover, .btn.HapusPeriodeMisi:hover, .btn-danger:hover {
    background-color: #dc2626 !important;
    border-color: #dc2626 !important;
    color: #ffffff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 3px 6px rgba(239, 68, 68, 0.35) !important;
}
.button-icon-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 5px !important;
    margin: 0 !important;
}
.button-icon-btn .btn-reco-mg,
.button-icon-btn .btn-button-mg {
    margin: 0 !important;
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

<script>
var BaseURL = '<?=base_url()?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

jQuery(document).ready(function($) {
    // Inisialisasi DataTable jika belum terinisialisasi
    if ($.fn.DataTable && !$.fn.DataTable.isDataTable('#data-table-basic')) {
        $('#data-table-basic').DataTable({
            "ordering": false
        });
    }

    // Handler toggle collapse accordion untuk minimize & maximize
    $(document).on('click', '.accordion-toggle-link', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        if (target && $(target).length) {
            $(target).collapse('toggle');
        }
    });

    $(document).on('show.bs.collapse', '.collapse', function() {
        $('a[href="#' + $(this).attr('id') + '"]').removeClass('collapsed').attr('aria-expanded', 'true');
    });

    $(document).on('hide.bs.collapse', '.collapse', function() {
        $('a[href="#' + $(this).attr('id') + '"]').addClass('collapsed').attr('aria-expanded', 'false');
    });
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