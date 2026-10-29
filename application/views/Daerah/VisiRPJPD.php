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
                       
                            <!-- Menampilkan Visi dan Periode setelah filter -->
                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php 
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                    if (empty($Visi)) {
                                        $pesan_error = "Tidak ada data untuk wilayah: $nama_wilayah";
                                    }
                                ?>
                                <div class="alert <?= empty($Visi) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px; border-radius: 8px;">
                                    <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                    <?php if (!empty($pesan_error)) { ?>
                                        <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                        <?php } ?>

                        <!-- HEADER MENU -->
                        <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-sm-6">
                                    <h3 style="font-weight: 800; color: #1f2937; margin: 0 0 5px 0; display: flex; align-items: center; gap: 10px;">
                                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 8px; background: #e0f2fe; color: #0284c7; font-size: 18px;">
                                            <i class="fa fa-flag"></i>
                                        </span>
                                        VISI RPJPD
                                    </h3>
                                    <div style="color: #64748b; font-size: 13px;">
                                        Penyelarasan rumusan Visi RPJPD Daerah dengan Visi RPJPD Provinsi dan Visi RPJPN Nasional.
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6 text-right" style="display: flex; justify-content: flex-end; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputVisi" style="border-radius: 6px; font-weight: 700; padding: 8px 18px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(22, 163, 74, 0.25);">
                                            <i class="fa fa-plus-circle"></i> Tambah Visi RPJPD
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;" class="text-center">No</th>
                                        <th style="width: 25%;">Visi RPJPN</th>
                                        <th style="width: 25%;">Visi RPJPD Provinsi</th>
                                        <th style="width: 25%;">Visi RPJPD</th>
                                        <th style="width: 10%;" class="text-center">Periode</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th style="width: 5%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Visi as $key) { 
                                        // Parse visi_rpjpdp menjadi array
                                        $visiRPJPDPArray = [];
                                        $visiRPJPDPNames = [];
                                        if (!empty($key['visi_rpjpdp'])) {
                                            $visiRPJPDPArray = explode('&&', $key['visi_rpjpdp']);
                                            $visiRPJPDPArray = array_filter($visiRPJPDPArray, function($id) {
                                                return !empty($id) && $id !== '0' && $id !== 'null' && $id !== 'undefined';
                                            });
                                            
                                            // Ambil nama visi RPJPDP
                                            if (!empty($visiRPJPDPArray)) {
                                                $this->db->select('Id, Visi');
                                                $this->db->where_in('Id', $visiRPJPDPArray);
                                                $this->db->where('deleted_at IS NULL');
                                                $rpjpdpData = $this->db->get('visirpjpdp')->result_array();
                                                foreach ($rpjpdpData as $v) {
                                                    $visiRPJPDPNames[] = $v['Visi'];
                                                }
                                            }
                                        }
                                        
                                        // Parse visi_rpjpn menjadi array
                                        $visiRPJPNArray = [];
                                        $visiRPJPNNames = [];
                                        if (!empty($key['visi_rpjpn'])) {
                                            $visiRPJPNArray = explode('&&', $key['visi_rpjpn']);
                                            $visiRPJPNArray = array_filter($visiRPJPNArray, function($id) {
                                                return !empty($id) && $id !== '0' && $id !== 'null' && $id !== 'undefined';
                                            });
                                            
                                            // Ambil nama visi RPJPN
                                            if (!empty($visiRPJPNArray)) {
                                                $this->db->select('Id, Visi');
                                                $this->db->where_in('Id', $visiRPJPNArray);
                                                $this->db->where('deleted_at IS NULL');
                                                $rpjpnData = $this->db->get('visirpjpn')->result_array();
                                                foreach ($rpjpnData as $v) {
                                                    $visiRPJPNNames[] = $v['Visi'];
                                                }
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle;">
                                                <?php if (!empty($visiRPJPNNames)) { ?>
                                                    <ul style="margin: 0; padding-left: 15px;">
                                                        <?php foreach ($visiRPJPNNames as $nama) { ?>
                                                            <li style="font-size: 12px; margin-bottom: 2px;"><?= html_escape($nama) ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } else { ?>
                                                    <span class="text-muted">-</span>
                                                <?php } ?>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php if (!empty($visiRPJPNNames)) { ?>
                                                    <ul style="margin: 0; padding-left: 15px;">
                                                        <?php foreach ($visiRPJPNNames as $nama) { ?>
                                                            <li style="font-size: 12px; margin-bottom: 2px;"><?= html_escape($nama) ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } else { ?>
                                                    <span class="text-muted">-</span>
                                                <?php } ?>
                                            </td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['Visi']) ?></td>
                                            <td style="vertical-align: middle;" class="text-center"><?= html_escape($key['TahunMulai']) . ' - ' . html_escape($key['TahunAkhir']) ?></td>
                                            
                                            
                        
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td class="text-center">
                                                    <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                        <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                                data-id="<?= $key['Id'] ?>"
                                                                data-visi="<?= htmlspecialchars($key['Visi'], ENT_QUOTES) ?>"
                                                                data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                                data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                                data-visi_rpjpdp="<?= htmlspecialchars($key['visi_rpjpdp'] ?? '', ENT_QUOTES) ?>"
                                                                data-visi_rpjpn="<?= htmlspecialchars($key['visi_rpjpn'] ?? '', ENT_QUOTES) ?>">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-id="<?= $key['Id'] ?>">
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

    <!-- ============================================================ -->
    <!-- MODAL INPUT VISI RPJPD                                        -->
    <!-- ============================================================ -->
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { 
        // ============================================================
        // BUAT ARRAY UNIQUE UNTUK PERIODE RPJPDP
        // ============================================================
        $uniquePeriodeRPJPDP = [];
        $periodeRPJPDPKeys = [];
        foreach ($PeriodeRPJPDP as $key) {
            $periodeKey = $key['TahunMulai'] . '-' . $key['TahunAkhir'];
            if (!in_array($periodeKey, $periodeRPJPDPKeys)) {
                $periodeRPJPDPKeys[] = $periodeKey;
                $uniquePeriodeRPJPDP[] = $key;
            }
        }
        
        // ============================================================
        // BUAT ARRAY UNIQUE UNTUK PERIODE RPJPN
        // ============================================================
        $uniquePeriodeRPJPN = [];
        $periodeRPJPNKeys = [];
        foreach ($PeriodeRPJPN as $key) {
            $periodeKey = $key['TahunMulai'] . '-' . $key['TahunAkhir'];
            if (!in_array($periodeKey, $periodeRPJPNKeys)) {
                $periodeRPJPNKeys[] = $periodeKey;
                $uniquePeriodeRPJPN[] = $key;
            }
        }
    ?>
        <!-- MODAL INPUT -->
        <div class="modal fade" id="ModalInputVisi" role="dialog">
            <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
                <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
                    
                    <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                        <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #e6fcf5; color: #0ca678;">
                                <i class="fa fa-flag"></i>
                            </span>
                            Tambah Visi RPJPD
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
                    </div>

                    <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                        <!-- Periode -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode (Tahun) <span class="text-danger">*</span>
                            </label>
                            <div style="display: flex; gap: 12px;">
                                <input type="text" class="form-control" id="TahunMulai" placeholder="Tahun Mulai (YYYY)" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                <input type="text" class="form-control" id="TahunAkhir" placeholder="Tahun Akhir (YYYY)" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <!-- Visi RPJPD -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="Visi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Visi RPJPD <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" rows="4" id="Visi" placeholder="Input rumusan Visi RPJPD..." style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>

                        <!-- REFERENSI VISI RPJPDP (Provinsi) -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="PeriodeRPJPDP" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode RPJPD Provinsi
                            </label>
                            <select class="form-control" id="PeriodeRPJPDP" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                                <option value="">Pilih Periode</option>
                                <?php foreach ($uniquePeriodeRPJPDP as $key) { ?>
                                    <option value="<?= $key['Id'] ?>"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></option>
                                <?php } ?>
                            </select>
                            
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                                <div class="accordion-stn">
                                    <div class="panel-group" id="AccordionVisiRPJPDP" role="tablist" style="margin-bottom: 0;">
                                        <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                            <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                                <a data-toggle="collapse" href="#VisiRPJPDP-one" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                                    <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                        <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Visi RPJPD Provinsi (Bisa lebih dari 1)
                                                    </span>
                                                    <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                                </a>
                                            </div>
                                            <div id="VisiRPJPDP-one" class="collapse in" role="tabpanel">
                                                <div class="panel-body" style="padding: 0;">
                                                    <div class="text-justify" id="VisiRPJPDPList" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 200px; overflow-y: auto;">
                                                        <p class="text-muted" style="margin: 0;">Pilih periode terlebih dahulu</p>
                                                    </div>
                                                    <div class="text-muted" style="margin-top: 6px; font-size: 11.5px; color: #64748b; text-align: left !important;">
                                                        <i class="fa fa-info-circle"></i> Centang lebih dari satu untuk multi-pilih
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- REFERENSI VISI RPJPN (Nasional) -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="PeriodeRPJPN" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode RPJPN (Nasional)
                            </label>
                            <select class="form-control" id="PeriodeRPJPN" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                                <option value="">Pilih Periode</option>
                                <?php foreach ($uniquePeriodeRPJPN as $key) { ?>
                                    <option value="<?= $key['Id'] ?>"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></option>
                                <?php } ?>
                            </select>
                            
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                                <div class="accordion-stn">
                                    <div class="panel-group" id="AccordionVisiRPJPN" role="tablist" style="margin-bottom: 0;">
                                        <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                            <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                                <a data-toggle="collapse" href="#VisiRPJPN-one" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                                    <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                        <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Visi RPJPN (Bisa lebih dari 1)
                                                    </span>
                                                    <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                                </a>
                                            </div>
                                            <div id="VisiRPJPN-one" class="collapse in" role="tabpanel">
                                                <div class="panel-body" style="padding: 0;">
                                                    <div class="text-justify" id="VisiRPJPNList" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 200px; overflow-y: auto;">
                                                        <p class="text-muted" style="margin: 0;">Pilih periode terlebih dahulu</p>
                                                    </div>
                                                    <div class="text-muted" style="margin-top: 6px; font-size: 11.5px; color: #64748b; text-align: left !important;">
                                                        <i class="fa fa-info-circle"></i> Centang lebih dari satu untuk multi-pilih
                                                    </div>
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
        <!-- MODAL EDIT VISI RPJPD                                         -->
        <!-- ============================================================ -->
        <div class="modal fade" id="ModalEditVisi" role="dialog">
            <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
                <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
                    
                    <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                        <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef3c7; color: #d97706;">
                                <i class="fa fa-pencil-square-o"></i>
                            </span>
                            Edit Visi RPJPD
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
                    </div>

                    <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                        <input type="hidden" id="Id">
                        <input type="hidden" id="SavedVisiRPJPDP">
                        <input type="hidden" id="SavedVisiRPJPN">

                        <!-- Periode -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode (Tahun) <span class="text-danger">*</span>
                            </label>
                            <div style="display: flex; gap: 12px;">
                                <input type="text" class="form-control" id="_TahunMulai" placeholder="Tahun Mulai (YYYY)" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                <input type="text" class="form-control" id="_TahunAkhir" placeholder="Tahun Akhir (YYYY)" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <!-- Visi RPJPD -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="_Visi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Visi RPJPD <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" rows="4" id="_Visi" placeholder="Input rumusan Visi RPJPD..." style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>

                        <!-- REFERENSI VISI RPJPDP (Provinsi) - EDIT -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="PeriodeRPJPDP_" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode RPJPD Provinsi
                            </label>
                            <select class="form-control" id="PeriodeRPJPDP_" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                                <option value="">Pilih Periode</option>
                                <?php foreach ($uniquePeriodeRPJPDP as $key) { ?>
                                    <option value="<?= $key['Id'] ?>"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></option>
                                <?php } ?>
                            </select>
                            
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                                <div class="accordion-stn">
                                    <div class="panel-group" id="AccordionVisiRPJPDP_" role="tablist" style="margin-bottom: 0;">
                                        <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                            <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                                <a data-toggle="collapse" href="#_VisiRPJPDP" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                                    <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                        <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Visi RPJPD Provinsi (Bisa lebih dari 1)
                                                    </span>
                                                    <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                                </a>
                                            </div>
                                            <div id="_VisiRPJPDP" class="collapse in" role="tabpanel">
                                                <div class="panel-body" style="padding: 0;">
                                                    <div class="text-justify" id="VisiRPJPDPList_" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 200px; overflow-y: auto;">
                                                        <p class="text-muted" style="margin: 0;">Pilih periode terlebih dahulu</p>
                                                    </div>
                                                    <div class="text-muted" style="margin-top: 6px; font-size: 11.5px; color: #64748b; text-align: left !important;">
                                                        <i class="fa fa-info-circle"></i> Centang lebih dari satu untuk multi-pilih
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- REFERENSI VISI RPJPN (Nasional) - EDIT -->
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="PeriodeRPJPN_" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode RPJPN (Nasional)
                            </label>
                            <select class="form-control" id="PeriodeRPJPN_" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; margin-bottom: 10px;">
                                <option value="">Pilih Periode</option>
                                <?php foreach ($uniquePeriodeRPJPN as $key) { ?>
                                    <option value="<?= $key['Id'] ?>"><?= $key['TahunMulai'] . ' - ' . $key['TahunAkhir'] ?></option>
                                <?php } ?>
                            </select>
                            
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                                <div class="accordion-stn">
                                    <div class="panel-group" id="AccordionVisiRPJPN_" role="tablist" style="margin-bottom: 0;">
                                        <div class="panel panel-collapse notika-accrodion-cus" style="border: none; box-shadow: none; background: transparent; margin-bottom: 0;">
                                            <div class="panel-heading" role="tab" style="padding: 0 0 10px 0;">
                                                <a data-toggle="collapse" href="#_VisiRPJPN" aria-expanded="true" class="accordion-toggle-link" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #0284c7; font-weight: 700; font-size: 13px; cursor: pointer;">
                                                    <span style="display: inline-flex; align-items: center; gap: 8px;">
                                                        <i class="fa fa-list" style="font-size: 13px; color: #0284c7;"></i> Pilih Visi RPJPN (Bisa lebih dari 1)
                                                    </span>
                                                    <i class="fa fa-chevron-down accordion-arrow" style="font-size: 11px; color: #64748b; transition: transform 0.2s ease;"></i>
                                                </a>
                                            </div>
                                            <div id="_VisiRPJPN" class="collapse in" role="tabpanel">
                                                <div class="panel-body" style="padding: 0;">
                                                    <div class="text-justify" id="VisiRPJPNList_" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; max-height: 200px; overflow-y: auto;">
                                                        <p class="text-muted" style="margin: 0;">Pilih periode terlebih dahulu</p>
                                                    </div>
                                                    <div class="text-muted" style="margin-top: 6px; font-size: 11.5px; color: #64748b; text-align: left !important;">
                                                        <i class="fa fa-info-circle"></i> Centang lebih dari satu untuk multi-pilih
                                                    </div>
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
                            <i class="fa fa-save"></i> <b>Update</b>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
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
/* Style untuk accordion body - menampilkan semua visi dengan checkbox */
.panel-body {
    max-height: 250px;
    overflow-y: auto;
    padding: 10px !important;
}
.panel-body label {
    display: block !important;
    padding: 5px 0 !important;
    margin-bottom: 3px !important;
    cursor: pointer !important;
}
.panel-body label:hover {
    background-color: #f5f5f5 !important;
}
.panel-body label.selected {
    background-color: #d4edda !important;
    border-left: 4px solid #28a745 !important;
    padding-left: 10px !important;
}
.panel-body label input[type="checkbox"] {
    margin-right: 10px !important;
    margin-top: 2px !important;
    vertical-align: middle !important;
}
/* Style untuk tabel Visi RPJPD - daftar visi reference */
.table td ul {
    list-style-type: disc;
    margin: 0;
    padding-left: 15px;
}
.table td ul li {
    font-size: 12px;
    margin-bottom: 2px;
    line-height: 1.4;
}
.text-muted {
    color: #999 !important;
    padding: 10px 0 !important;
    text-align: center !important;
}
.label {
    font-size: 11px !important;
    padding: 4px 8px !important;
    border-radius: 3px !important;
    white-space: normal !important;
    word-wrap: break-word !important;
    max-width: 100% !important;
}
</style>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

jQuery(document).ready(function($) {
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
                showNotification("Mohon Pilih Provinsi", "warning");
                return;
            }
            if ($("#KabKota").val() === "") {
                showNotification("Mohon Pilih Kab/Kota", "warning");
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
                        window.location.href = BaseURL + "Daerah/VisiRPJPD";
                    } else {
                        showNotification(Respon || "Gagal menyimpan filter wilayah!", "error");
                        $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                    }
                },
                error: function() {
                    showNotification("Gagal menghubungi server!", "error");
                    $("#Filter").prop('disabled', false).html('<b>Filter</b>');
                }
            });
        });

        function showNotification(message, type) {
            var container = $('#notification-container');
            if (container.length === 0) {
                container = $('<div id="notification-container" style="position:fixed;top:20px;right:20px;z-index:9999;max-width:400px;"></div>');
                $('body').append(container);
            }
            
            var bgColor = type === 'error' ? '#f44336' : (type === 'warning' ? '#ff9800' : '#4CAF50');
            var icon = type === 'error' ? '✕' : (type === 'warning' ? '⚠' : '✓');
            
            var notification = $('<div class="notification" style="background:'+bgColor+';color:white;padding:12px 18px;margin-bottom:8px;border-radius:5px;box-shadow:0 2px 8px rgba(0,0,0,0.2);animation:slideIn 0.3s ease;display:flex;align-items:center;gap:10px;">' +
                '<span style="font-weight:bold;font-size:18px;">' + icon + '</span>' +
                '<span>' + message + '</span>' +
                '</div>');
            
            container.append(notification);
            
            setTimeout(function() {
                notification.fadeOut(400, function() {
                    $(this).remove();
                    if (container.children().length === 0) {
                        container.remove();
                    }
                });
            }, 3000);
        }

        var style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);

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
    // LOAD VISI RPJPDP BERDASARKAN PERIODE (INPUT) - DENGAN CHECKBOX
    // ============================================================
    $("#PeriodeRPJPDP").change(function() {
        var periodeId = $(this).val();
        if (periodeId == "") {
            $("#VisiRPJPDPList").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
            return;
        }
        
        $("#VisiRPJPDPList").html('<p class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat data...</p>');
        
        $.ajax({
            url: BaseURL + "Daerah/GetVisiRPJPDPByPeriode",
            type: "POST",
            data: { 
                Id: periodeId, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                var Visi = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        Visi += '<label style="display:block; padding:5px 0; margin-bottom:3px; cursor:pointer;">';
                        Visi += '<input type="checkbox" name="visi_rpjpdp[]" value="' + Data[i].Id + '"> ';
                        Visi += Data[i].Visi;
                        Visi += '</label>';
                    }
                } else {
                    Visi = '<p class="text-muted">Tidak ada data Visi RPJPD Provinsi</p>';
                }
                $("#VisiRPJPDPList").html(Visi);
            },
            error: function(xhr, status, error) {
                alert("Gagal memuat data Visi RPJPD Provinsi! Error: " + error);
                $("#VisiRPJPDPList").html('<p class="text-muted" style="color:red;">Gagal memuat data</p>');
            }
        });
    });

    // ============================================================
    // LOAD VISI RPJPN BERDASARKAN PERIODE (INPUT) - DENGAN CHECKBOX
    // ============================================================
    $("#PeriodeRPJPN").change(function() {
        var periodeId = $(this).val();
        if (periodeId == "") {
            $("#VisiRPJPNList").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
            return;
        }
        
        $("#VisiRPJPNList").html('<p class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat data...</p>');
        
        $.ajax({
            url: BaseURL + "Daerah/GetVisiRPJPNByPeriode",
            type: "POST",
            data: { 
                Id: periodeId, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                var Visi = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        Visi += '<label style="display:block; padding:5px 0; margin-bottom:3px; cursor:pointer;">';
                        Visi += '<input type="checkbox" name="visi_rpjpn[]" value="' + Data[i].Id + '"> ';
                        Visi += Data[i].Visi;
                        Visi += '</label>';
                    }
                } else {
                    Visi = '<p class="text-muted">Tidak ada data Visi RPJPN</p>';
                }
                $("#VisiRPJPNList").html(Visi);
            },
            error: function(xhr, status, error) {
                alert("Gagal memuat data Visi RPJPN! Error: " + error);
                $("#VisiRPJPNList").html('<p class="text-muted" style="color:red;">Gagal memuat data</p>');
            }
        });
    });

    // ============================================================
    // FUNGSI LOAD VISI RPJPDP EDIT DENGAN SELECTED (CHECKBOX) - PERBAIKAN TOTAL
    // ============================================================
    function loadVisiRPJPDPEditWithSelected(periodeId, selectedIds) {
        // KONVERSI KE STRING UNTUK MENGHINDARI ERROR
        periodeId = String(periodeId);
        selectedIds = String(selectedIds);
        
        console.log('loadVisiRPJPDPEditWithSelected - periodeId:', periodeId, 'selectedIds:', selectedIds);
        
        if (periodeId == "" || periodeId == "0" || periodeId == "null" || periodeId == "undefined") {
            $("#VisiRPJPDPList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
            return;
        }
        
        // KONVERSI selectedIds KE ARRAY
        var selectedArray = [];
        if (selectedIds && selectedIds !== '' && selectedIds !== '0' && selectedIds !== 'null' && selectedIds !== 'undefined') {
            // Jika string mengandung &&, split
            if (selectedIds.includes('&&')) {
                selectedArray = selectedIds.split('&&').filter(function(id) {
                    return id && id !== '0' && id !== 'null' && id !== '' && id !== 'undefined';
                });
            } 
            // Jika string adalah ID tunggal
            else {
                selectedArray = [selectedIds];
            }
        }
        
        console.log('Selected Array RPJPDP:', selectedArray);
        
        // Cek apakah periode ada di dropdown
        var periodExists = false;
        $("#PeriodeRPJPDP_ option").each(function() {
            if ($(this).val() == periodeId) {
                periodExists = true;
                return false;
            }
        });
        
        // Jika periode tidak ditemukan, coba cari berdasarkan teks
        if (!periodExists) {
            // Coba cari ID periode dari selectedIds
            if (selectedArray.length > 0) {
                var firstId = selectedArray[0];
                // Ambil periode dari ID visi
                $.ajax({
                    url: BaseURL + "Daerah/GetPeriodeRPJPDPByVisiId",
                    type: "POST",
                    data: { visi_id: firstId, [CSRF_NAME]: CSRF_TOKEN },
                    dataType: "json",
                    async: false,
                    success: function(periodeData) {
                        if (periodeData && periodeData.length > 0) {
                            var periodeInfo = periodeData[0];
                            var targetTahun = periodeInfo.TahunMulai + ' - ' + periodeInfo.TahunAkhir;
                            
                            // Cari option dengan teks yang sama
                            $("#PeriodeRPJPDP_ option").each(function() {
                                var text = $(this).text().trim();
                                if (text == targetTahun) {
                                    periodeId = $(this).val();
                                    $("#PeriodeRPJPDP_").val(periodeId);
                                    periodExists = true;
                                    return false;
                                }
                            });
                        }
                    }
                });
            }
            
            if (!periodExists) {
                $("#VisiRPJPDPList_").html('<p class="text-muted" style="color:orange;">Periode tidak ditemukan di dropdown</p>');
                return;
            }
        } else {
            $("#PeriodeRPJPDP_").val(periodeId);
        }
        
        // LOAD DATA VISI
        $("#VisiRPJPDPList_").html('<p class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat data...</p>');
        
        $.ajax({
            url: BaseURL + "Daerah/GetVisiRPJPDPByPeriode",
            type: "POST",
            data: { 
                Id: periodeId, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                console.log('Data Visi RPJPDP Edit:', Data);
                var Visi = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var isChecked = selectedArray.includes(String(Data[i].Id)) ? 'checked' : '';
                        var isSelected = selectedArray.includes(String(Data[i].Id)) ? 'selected' : '';
                        
                        Visi += '<label class="' + isSelected + '" style="display:block; padding:5px 0; margin-bottom:3px; cursor:pointer;">';
                        Visi += '<input type="checkbox" name="visi_rpjpdp_[]" value="' + Data[i].Id + '" ' + isChecked + '> ';
                        Visi += Data[i].Visi;
                        Visi += '</label>';
                    }
                } else {
                    Visi = '<p class="text-muted">Tidak ada data Visi RPJPD Provinsi</p>';
                }
                $("#VisiRPJPDPList_").html(Visi);
            },
            error: function(xhr, status, error) {
                console.error('Error load RPJPDP edit:', error);
                $("#VisiRPJPDPList_").html('<p class="text-muted" style="color:red;">Gagal memuat data</p>');
            }
        });
    }

    // ============================================================
    // FUNGSI LOAD VISI RPJPN EDIT DENGAN SELECTED (CHECKBOX) - PERBAIKAN TOTAL
    // ============================================================
    function loadVisiRPJPNEditWithSelected(periodeId, selectedIds) {
        // KONVERSI KE STRING UNTUK MENGHINDARI ERROR
        periodeId = String(periodeId);
        selectedIds = String(selectedIds);
        
        console.log('loadVisiRPJPNEditWithSelected - periodeId:', periodeId, 'selectedIds:', selectedIds);
        
        if (periodeId == "" || periodeId == "0" || periodeId == "null" || periodeId == "undefined") {
            $("#VisiRPJPNList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
            return;
        }
        
        // KONVERSI selectedIds KE ARRAY
        var selectedArray = [];
        if (selectedIds && selectedIds !== '' && selectedIds !== '0' && selectedIds !== 'null' && selectedIds !== 'undefined') {
            // Jika string mengandung &&, split
            if (selectedIds.includes('&&')) {
                selectedArray = selectedIds.split('&&').filter(function(id) {
                    return id && id !== '0' && id !== 'null' && id !== '' && id !== 'undefined';
                });
            } 
            // Jika string adalah ID tunggal
            else {
                selectedArray = [selectedIds];
            }
        }
        
        console.log('Selected Array RPJPN:', selectedArray);
        
        // Cek apakah periode ada di dropdown
        var periodExists = false;
        $("#PeriodeRPJPN_ option").each(function() {
            if ($(this).val() == periodeId) {
                periodExists = true;
                return false;
            }
        });
        
        // Jika periode tidak ditemukan, coba cari berdasarkan teks
        if (!periodExists) {
            // Coba cari ID periode dari selectedIds
            if (selectedArray.length > 0) {
                var firstId = selectedArray[0];
                // Ambil periode dari ID visi
                $.ajax({
                    url: BaseURL + "Daerah/GetPeriodeRPJPNByVisiId",
                    type: "POST",
                    data: { visi_id: firstId, [CSRF_NAME]: CSRF_TOKEN },
                    dataType: "json",
                    async: false,
                    success: function(periodeData) {
                        if (periodeData && periodeData.length > 0) {
                            var periodeInfo = periodeData[0];
                            var targetTahun = periodeInfo.TahunMulai + ' - ' + periodeInfo.TahunAkhir;
                            
                            // Cari option dengan teks yang sama
                            $("#PeriodeRPJPN_ option").each(function() {
                                var text = $(this).text().trim();
                                if (text == targetTahun) {
                                    periodeId = $(this).val();
                                    $("#PeriodeRPJPN_").val(periodeId);
                                    periodExists = true;
                                    return false;
                                }
                            });
                        }
                    }
                });
            }
            
            if (!periodExists) {
                $("#VisiRPJPNList_").html('<p class="text-muted" style="color:orange;">Periode tidak ditemukan di dropdown</p>');
                return;
            }
        } else {
            $("#PeriodeRPJPN_").val(periodeId);
        }
        
        // LOAD DATA VISI
        $("#VisiRPJPNList_").html('<p class="text-muted"><i class="fa fa-spinner fa-spin"></i> Memuat data...</p>');
        
        $.ajax({
            url: BaseURL + "Daerah/GetVisiRPJPNByPeriode",
            type: "POST",
            data: { 
                Id: periodeId, 
                [CSRF_NAME]: CSRF_TOKEN 
            },
            dataType: "json",
            success: function(Data) {
                console.log('Data Visi RPJPN Edit:', Data);
                var Visi = '';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var isChecked = selectedArray.includes(String(Data[i].Id)) ? 'checked' : '';
                        var isSelected = selectedArray.includes(String(Data[i].Id)) ? 'selected' : '';
                        
                        Visi += '<label class="' + isSelected + '" style="display:block; padding:5px 0; margin-bottom:3px; cursor:pointer;">';
                        Visi += '<input type="checkbox" name="visi_rpjpn_[]" value="' + Data[i].Id + '" ' + isChecked + '> ';
                        Visi += Data[i].Visi;
                        Visi += '</label>';
                    }
                } else {
                    Visi = '<p class="text-muted">Tidak ada data Visi RPJPN</p>';
                }
                $("#VisiRPJPNList_").html(Visi);
            },
            error: function(xhr, status, error) {
                console.error('Error load RPJPN edit:', error);
                $("#VisiRPJPNList_").html('<p class="text-muted" style="color:red;">Gagal memuat data</p>');
            }
        });
    }

    // ============================================================
    // EDIT VISI - DENGAN DATA ATTRIBUTE UNTUK MULTI-PILIH (PERBAIKAN TOTAL)
    // ============================================================
    $(document).on("click", ".Edit", function() {
        var id = $(this).data('id');
        var visi = $(this).data('visi');
        var tahunMulai = $(this).data('tahunmulai');
        var tahunAkhir = $(this).data('tahunakhir');
        var visiRPJPDP = $(this).data('visi_rpjpdp') || '';
        var visiRPJPN = $(this).data('visi_rpjpn') || '';

        // KONVERSI KE STRING UNTUK MENGHINDARI ERROR
        visiRPJPDP = String(visiRPJPDP);
        visiRPJPN = String(visiRPJPN);

        console.log('Edit data - visiRPJPDP:', visiRPJPDP);
        console.log('Edit data - visiRPJPN:', visiRPJPN);

        $("#Id").val(id);
        $("#_Visi").val(visi);
        $("#_TahunMulai").val(tahunMulai);
        $("#_TahunAkhir").val(tahunAkhir);
        $("#SavedVisiRPJPDP").val(visiRPJPDP);
        $("#SavedVisiRPJPN").val(visiRPJPN);

        // Reset dropdown dan list
        $("#PeriodeRPJPDP_").val('');
        $("#VisiRPJPDPList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
        $("#PeriodeRPJPN_").val('');
        $("#VisiRPJPNList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');

        // ============================================
        // PROSES VISI RPJPDP (Provinsi) - MULTI-PILIH
        // ============================================
        if (visiRPJPDP != '' && visiRPJPDP != '0' && visiRPJPDP != 'null' && visiRPJPDP != 'undefined') {
            // Ambil ID pertama untuk menentukan periode
            var firstId = visiRPJPDP;
            if (visiRPJPDP.includes('&&')) {
                var ids = visiRPJPDP.split('&&').filter(function(id) {
                    return id && id !== '0' && id !== 'null' && id !== '' && id !== 'undefined';
                });
                if (ids.length > 0) {
                    firstId = ids[0];
                }
            }
            
            // Cari periode berdasarkan ID visi
            $.ajax({
                url: BaseURL + "Daerah/GetPeriodeRPJPDPByVisiId",
                type: "POST",
                data: { visi_id: firstId, [CSRF_NAME]: CSRF_TOKEN },
                dataType: "json",
                async: false,
                success: function(periodeData) {
                    console.log('Periode RPJPDP Data:', periodeData);
                    if (periodeData && periodeData.length > 0) {
                        var periodeInfo = periodeData[0];
                        var targetTahun = periodeInfo.TahunMulai + ' - ' + periodeInfo.TahunAkhir;
                        
                        var foundPeriodeId = null;
                        $("#PeriodeRPJPDP_ option").each(function() {
                            var text = $(this).text().trim();
                            if (text == targetTahun) {
                                foundPeriodeId = $(this).val();
                                return false;
                            }
                        });
                        
                        if (foundPeriodeId) {
                            console.log('Found periode RPJPDP ID:', foundPeriodeId);
                            $("#PeriodeRPJPDP_").val(foundPeriodeId);
                            loadVisiRPJPDPEditWithSelected(foundPeriodeId, visiRPJPDP);
                        } else {
                            loadVisiRPJPDPEditWithSelected(visiRPJPDP, visiRPJPDP);
                        }
                    } else {
                        loadVisiRPJPDPEditWithSelected(visiRPJPDP, visiRPJPDP);
                    }
                },
                error: function() {
                    loadVisiRPJPDPEditWithSelected(visiRPJPDP, visiRPJPDP);
                }
            });
        }

        // ============================================
        // PROSES VISI RPJPN (Nasional) - MULTI-PILIH
        // ============================================
        if (visiRPJPN != '' && visiRPJPN != '0' && visiRPJPN != 'null' && visiRPJPN != 'undefined') {
            // Ambil ID pertama untuk menentukan periode
            var firstId = visiRPJPN;
            if (visiRPJPN.includes('&&')) {
                var ids = visiRPJPN.split('&&').filter(function(id) {
                    return id && id !== '0' && id !== 'null' && id !== '' && id !== 'undefined';
                });
                if (ids.length > 0) {
                    firstId = ids[0];
                }
            }
            
            // Cari periode berdasarkan ID visi
            $.ajax({
                url: BaseURL + "Daerah/GetPeriodeRPJPNByVisiId",
                type: "POST",
                data: { visi_id: firstId, [CSRF_NAME]: CSRF_TOKEN },
                dataType: "json",
                async: false,
                success: function(periodeData) {
                    console.log('Periode RPJPN Data:', periodeData);
                    if (periodeData && periodeData.length > 0) {
                        var periodeInfo = periodeData[0];
                        var targetTahun = periodeInfo.TahunMulai + ' - ' + periodeInfo.TahunAkhir;
                        
                        var foundPeriodeId = null;
                        $("#PeriodeRPJPN_ option").each(function() {
                            var text = $(this).text().trim();
                            if (text == targetTahun) {
                                foundPeriodeId = $(this).val();
                                return false;
                            }
                        });
                        
                        if (foundPeriodeId) {
                            console.log('Found periode RPJPN ID:', foundPeriodeId);
                            $("#PeriodeRPJPN_").val(foundPeriodeId);
                            loadVisiRPJPNEditWithSelected(foundPeriodeId, visiRPJPN);
                        } else {
                            loadVisiRPJPNEditWithSelected(visiRPJPN, visiRPJPN);
                        }
                    } else {
                        loadVisiRPJPNEditWithSelected(visiRPJPN, visiRPJPN);
                    }
                },
                error: function() {
                    loadVisiRPJPNEditWithSelected(visiRPJPN, visiRPJPN);
                }
            });
        }

        $('#ModalEditVisi').modal("show");
    });

    // ============================================================
    // INPUT VISI - DENGAN MULTI-PILIH CHECKBOX
    // ============================================================
    $("#Input").click(function() {
        var tahunMulai = $("#TahunMulai").val();
        var tahunAkhir = $("#TahunAkhir").val();
        var visi = $("#Visi").val();
        
        // Ambil semua checkbox yang dipilih (multi-pilih)
        var visiRPJPDP = [];
        $("input[name='visi_rpjpdp[]']:checked").each(function() {
            visiRPJPDP.push($(this).val());
        });
        
        var visiRPJPN = [];
        $("input[name='visi_rpjpn[]']:checked").each(function() {
            visiRPJPN.push($(this).val());
        });

        if (!/^\d{4}$/.test(tahunMulai)) {
            alert('Input Tahun Mulai harus 4 digit angka!');
            return;
        }
        if (!/^\d{4}$/.test(tahunAkhir)) {
            alert('Input Tahun Akhir harus 4 digit angka!');
            return;
        }
        if (parseInt(tahunMulai) >= parseInt(tahunAkhir)) {
            alert('Tahun Mulai harus lebih kecil dari Tahun Akhir!');
            return;
        }
        if (visi.trim() == "") {
            alert('Input Visi Belum Benar!');
            return;
        }
        if ($("#PeriodeRPJPDP").val() == "") {
            alert("Mohon Input Periode RPJPD Provinsi");
            return;
        }
        if (visiRPJPDP.length === 0) {
            alert("Mohon Pilih minimal 1 Visi RPJPD Provinsi!");
            return;
        }
        if ($("#PeriodeRPJPN").val() == "") {
            alert("Mohon Input Periode RPJPN");
            return;
        }
        if (visiRPJPN.length === 0) {
            alert("Mohon Pilih minimal 1 Visi RPJPN!");
            return;
        }

        var data = {
            Visi: visi,
            TahunMulai: tahunMulai,
            TahunAkhir: tahunAkhir,
            visi_rpjpdp: visiRPJPDP,
            visi_rpjpn: visiRPJPN,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $.ajax({
            url: BaseURL + "Daerah/InputVisiRPJPD",
            type: "POST",
            data: data,
            dataType: "text",
            success: function(Respon) {
                if (Respon.trim() == '1') {
                    $('#ModalInputVisi').modal('hide');
                    location.reload();
                } else {
                    alert(Respon);
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan server: ' + error);
            }
        });
    });

    // ============================================================
    // UPDATE VISI - DENGAN MULTI-PILIH CHECKBOX
    // ============================================================
    $("#Edit").click(function() {
        var tahunMulai = $("#_TahunMulai").val();
        var tahunAkhir = $("#_TahunAkhir").val();
        var visi = $("#_Visi").val();
        
        // Ambil semua checkbox yang dipilih (multi-pilih)
        var visiRPJPDP = [];
        $("input[name='visi_rpjpdp_[]']:checked").each(function() {
            visiRPJPDP.push($(this).val());
        });
        
        var visiRPJPN = [];
        $("input[name='visi_rpjpn_[]']:checked").each(function() {
            visiRPJPN.push($(this).val());
        });

        console.log('Update - visiRPJPDP:', visiRPJPDP);
        console.log('Update - visiRPJPN:', visiRPJPN);

        if (!/^\d{4}$/.test(tahunMulai)) {
            alert('Input Tahun Mulai harus 4 digit angka!');
            return;
        }
        if (!/^\d{4}$/.test(tahunAkhir)) {
            alert('Input Tahun Akhir harus 4 digit angka!');
            return;
        }
        if (parseInt(tahunMulai) >= parseInt(tahunAkhir)) {
            alert('Tahun Mulai harus lebih kecil dari Tahun Akhir!');
            return;
        }
        if (visi.trim() == "") {
            alert('Input Visi Belum Benar!');
            return;
        }
        if ($("#PeriodeRPJPDP_").val() == "") {
            alert("Mohon Input Periode RPJPD Provinsi");
            return;
        }
        if (visiRPJPDP.length === 0) {
            alert("Mohon Pilih minimal 1 Visi RPJPD Provinsi!");
            return;
        }
        if ($("#PeriodeRPJPN_").val() == "") {
            alert("Mohon Input Periode RPJPN");
            return;
        }
        if (visiRPJPN.length === 0) {
            alert("Mohon Pilih minimal 1 Visi RPJPN!");
            return;
        }

        var data = {
            Id: $("#Id").val(),
            Visi: visi,
            TahunMulai: tahunMulai,
            TahunAkhir: tahunAkhir,
            visi_rpjpdp: visiRPJPDP,
            visi_rpjpn: visiRPJPN,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $.ajax({
            url: BaseURL + "Daerah/EditVisiRPJPD",
            type: "POST",
            data: data,
            dataType: "text",
            success: function(Respon) {
                if (Respon.trim() == '1') {
                    $('#ModalEditVisi').modal('hide');
                    location.reload();
                } else {
                    alert(Respon);
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan server: ' + error);
            }
        });
    });

    // ============================================================
    // HAPUS VISI - LANGSUNG REFRESH TANPA POP UP
    // ============================================================
    $(document).on('click', '.Hapus', function() {
        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;

        var id = $(this).data('id');
        if (!id) {
            alert('ID tidak ditemukan!');
            return;
        }

        var data = {
            Id: id,
            [CSRF_NAME]: CSRF_TOKEN
        };

        $.ajax({
            url: BaseURL + "Daerah/HapusVisiRPJPD",
            type: "POST",
            data: data,
            dataType: "text",
            success: function(Respon) {
                if (Respon.trim() == '1') {
                    location.reload();
                } else {
                    alert(Respon);
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan server: ' + error);
            }
        });
    });

    // ============================================================
    // RESET FORM SAAT MODAL DITUTUP
    // ============================================================
    $('#ModalInputVisi').on('hidden.bs.modal', function() {
        $("#TahunMulai").val('');
        $("#TahunAkhir").val('');
        $("#Visi").val('');
        $("#PeriodeRPJPDP").val('');
        $("#PeriodeRPJPN").val('');
        $("#VisiRPJPDPList").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
        $("#VisiRPJPNList").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
        $("#Input").prop('disabled', false).text('SIMPAN');
    });

    $('#ModalEditVisi').on('hidden.bs.modal', function() {
        $("#_TahunMulai").val('');
        $("#_TahunAkhir").val('');
        $("#_Visi").val('');
        $("#PeriodeRPJPDP_").val('');
        $("#PeriodeRPJPN_").val('');
        $("#VisiRPJPDPList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
        $("#VisiRPJPNList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
        $("#Edit").prop('disabled', false).text('UPDATE');
    });

    // ============================================================
    // EVENT UNTUK PERIODE RPJPDP EDIT
    // ============================================================
    $("#PeriodeRPJPDP_").change(function() {
        var periodeId = $(this).val();
        var selectedIds = $("#SavedVisiRPJPDP").val();
        console.log('Periode RPJPDP change - periodeId:', periodeId, 'selectedIds:', selectedIds);
        if (periodeId == "") {
            $("#VisiRPJPDPList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
            return;
        }
        loadVisiRPJPDPEditWithSelected(periodeId, selectedIds);
    });

    // ============================================================
    // EVENT UNTUK PERIODE RPJPN EDIT
    // ============================================================
    $("#PeriodeRPJPN_").change(function() {
        var periodeId = $(this).val();
        var selectedIds = $("#SavedVisiRPJPN").val();
        console.log('Periode RPJPN change - periodeId:', periodeId, 'selectedIds:', selectedIds);
        if (periodeId == "") {
            $("#VisiRPJPNList_").html('<p class="text-muted">Pilih periode terlebih dahulu</p>');
            return;
        }
        loadVisiRPJPNEditWithSelected(periodeId, selectedIds);
    });
});
</script>
</body>
</html>