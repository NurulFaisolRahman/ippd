<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 4px 18px rgba(0,0,0,0.06); padding: 25px 25px 30px; background: #fff; border: 1px solid #e2e8f0;">

                        <!-- NOTIFIKASI FLASH DATA -->
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success alert-dismissible fade in" role="alert" style="border-radius: 8px; font-weight: 500;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-check-circle" style="margin-right: 6px;"></i> <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php } ?>

                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger alert-dismissible fade in" role="alert" style="border-radius: 8px; font-weight: 500;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-exclamation-circle" style="margin-right: 6px;"></i> <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php } ?>

                        <?php if ($this->session->flashdata('warning')) { ?>
                            <div class="alert alert-warning alert-dismissible fade in" role="alert" style="border-radius: 8px; font-weight: 500;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="fa fa-warning" style="margin-right: 6px;"></i> <?= $this->session->flashdata('warning') ?>
                            </div>
                        <?php } ?>

                        <!-- FILTER PROVINSI & KAB/KOTA -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: flex-end; gap: 15px; flex-wrap: wrap;">
                                    <div style="flex: 1 1 250px; min-width: 200px;">
                                        <label for="Provinsi" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Provinsi</label>
                                        <select class="form-control" id="Provinsi" style="height: 38px; border-radius: 6px;">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>"
                                                    <?= (!empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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
                                        <button class="btn btn-primary notika-btn-primary" id="FilterWilayah" style="border-radius: 8px; height: 40px; padding: 0 20px; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 2px 4px rgba(59,130,246,0.25);">
                                            <i class="fa fa-filter"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                $wil = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wil = $wil ? html_escape($wil['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px; border-radius: 8px; background: #f0f9ff; border: 1px solid #bae6fd; color: #0369a1;">
                                    <i class="fa fa-map-marker" style="margin-right: 6px;"></i> <strong>Wilayah Terpilih:</strong> <?= $nama_wil ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <!-- HEADER MENU -->
                        <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-sm-6">
                                    <h3 style="font-weight: 800; color: #1f2937; margin: 0 0 5px 0; display: flex; align-items: center; gap: 10px;">
                                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 8px; background: #f1f5f9; color: #475569; font-size: 18px;">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        DAFTAR PEGAWAI (KARYAWAN)
                                    </h3>
                                    <div style="color: #64748b; font-size: 13px;">
                                        Kelola akun pegawai, aparatur perangkat daerah, jabatan, eselon, dan dinas penugasan.
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6 text-right" style="display: flex; justify-content: flex-end; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [3, 4])) { ?>
                                        <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputKaryawan" style="border-radius: 8px; padding: 9px 20px; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                                            <i class="fa fa-user-plus"></i> Tambah Pegawai
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Eselon</th>
                                        <th>Jabatan</th>
                                        <th>Satuan Unit Kerja</th>
                                        <th>Bidang / Sub / Kegiatan</th>
                                        <th>Dinas Terkait</th>
                                        <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [3, 4])) { ?>
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
                                            <td style="vertical-align:middle;">
                                                <?php 
                                                    $eselon = $key['eselon'] ?? '';
                                                    echo !empty($eselon) ? html_escape($eselon) : '-';
                                                ?>
                                            </td>
                                            <td style="vertical-align:middle;"><?= html_escape($key['jabatan']) ?></td>
                                            <td style="vertical-align:middle;"><?= isset($key['satuan_unit_kerja']) && !empty($key['satuan_unit_kerja']) ? html_escape($key['satuan_unit_kerja']) : '-' ?></td>
                                            <td style="vertical-align:middle;"><?= isset($key['bidang_sub_koordinator']) && !empty($key['bidang_sub_koordinator']) ? html_escape($key['bidang_sub_koordinator']) : '-' ?></td>
                                            <td style="vertical-align:middle;"><?= isset($key['dinas_nama']) ? $key['dinas_nama'] : '-' ?></td>
                                            
                                            <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [3, 4])) { ?>
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
                                                            data-eselon="<?= htmlspecialchars($key['eselon'] ?? '', ENT_QUOTES) ?>"
                                                            data-jabatan="<?= htmlspecialchars($key['jabatan'], ENT_QUOTES) ?>"
                                                            data-satuan-unit-kerja="<?= htmlspecialchars($key['satuan_unit_kerja'] ?? '', ENT_QUOTES) ?>"
                                                            data-bidang-sub-koordinator="<?= htmlspecialchars($key['bidang_sub_koordinator'] ?? '', ENT_QUOTES) ?>"
                                                            data-tahun-mulai="<?= $key['tahun_mulai'] ?>"
                                                            data-tahun-akhir="<?= $key['tahun_akhir'] ?>"
                                                            data-dinas-ids="<?= isset($key['edit_dinas_ids']) ? htmlspecialchars($key['edit_dinas_ids'], ENT_QUOTES) : (isset($key['dinas_id']) ? htmlspecialchars($key['dinas_id'], ENT_QUOTES) : '') ?>">
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

    <!-- ============================================================ -->
    <!-- MODAL INPUT KARYAWAN -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalInputKaryawan" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
                
                <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                    <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #e6fcf5; color: #0ca678;">
                            <i class="fa fa-user-plus"></i>
                        </span>
                        Tambah Data Pegawai (Karyawan)
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
                </div>

                <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="NIP" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    NIP <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="NIP" placeholder="Masukkan NIP" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="Nama" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Nama Pegawai <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="Nama" placeholder="Masukkan Nama Lengkap" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="Eselon" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Eselon
                                </label>
                                <input type="text" class="form-control" id="Eselon" placeholder="Contoh: Eselon II, Eselon III, Non Eselon" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="Jabatan" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Jabatan <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="Jabatan" placeholder="Masukkan Jabatan" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="SatuanUnitKerja" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Satuan Unit Kerja
                                </label>
                                <input type="text" class="form-control" id="SatuanUnitKerja" placeholder="Contoh: Sub Bagian Perencanaan" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="BidangSubKoordinator" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Bidang / Sub / Kegiatan
                                </label>
                                <input type="text" class="form-control" id="BidangSubKoordinator" placeholder="Contoh: Bidang Pendidikan Dasar" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>
                    </div>

                    <!-- Dinas Terkait -->
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                            Dinas Terkait <span class="text-danger">*</span>
                        </label>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px;">
                            <div id="dinasContainerAdd"></div>
                            <button type="button" class="btn btn-info btn-sm" id="addDinasRowAdd" style="margin-top: 8px; border-radius: 6px; font-weight: 600;">
                                <i class="fa fa-plus"></i> Tambah Dinas
                            </button>
                            <div style="margin-top: 6px; font-size: 11.5px; color: #64748b;">
                                * Wajib pilih minimal 1 dinas
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="Password" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="Password" placeholder="Masukkan Password" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="TahunMulai" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Tahun Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="TahunMulai" placeholder="Contoh: 2020" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="TahunAkhir" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Tahun Akhir <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="TahunAkhir" placeholder="Contoh: 2025" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 14px 24px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 18px; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">
                        Batal
                    </button>
                    <button class="btn btn-success notika-btn-success" id="Input" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 22px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                        <i class="fa fa-save"></i> <b>Simpan</b>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- MODAL EDIT KARYAWAN -->
    <!-- ============================================================ -->
    <div class="modal fade" id="ModalEditKaryawan" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
                
                <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                    <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef3c7; color: #d97706;">
                            <i class="fa fa-pencil-square-o"></i>
                        </span>
                        Edit Data Pegawai (Karyawan)
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
                </div>

                <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                    <input type="hidden" id="Id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="_NIP" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    NIP <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="_NIP" placeholder="Masukkan NIP" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="_Nama" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Nama Pegawai <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="_Nama" placeholder="Masukkan Nama Lengkap" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="_Eselon" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Eselon
                                </label>
                                <input type="text" class="form-control" id="_Eselon" placeholder="Contoh: Eselon II, Eselon III, Non Eselon" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="_Jabatan" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Jabatan <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="_Jabatan" placeholder="Masukkan Jabatan" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="_SatuanUnitKerja" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Satuan Unit Kerja
                                </label>
                                <input type="text" class="form-control" id="_SatuanUnitKerja" placeholder="Contoh: Sub Bagian Perencanaan" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 18px;">
                                <label for="_BidangSubKoordinator" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Bidang / Sub / Kegiatan
                                </label>
                                <input type="text" class="form-control" id="_BidangSubKoordinator" placeholder="Contoh: Bidang Pendidikan Dasar" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>
                    </div>

                    <!-- Password Baru -->
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label for="_Password" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                            Password Baru
                        </label>
                        <input type="text" class="form-control" id="_Password" placeholder="Kosongkan jika password tidak diubah" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                        <small class="text-muted" style="display: block; margin-top: 4px; font-size: 11.5px;">Kosongkan jika tidak ingin mengubah password akun ini</small>
                    </div>

                    <!-- Dinas Terkait -->
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                            Dinas Terkait <span class="text-danger">*</span>
                        </label>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px;">
                            <div id="dinasContainerEdit"></div>
                            <button type="button" class="btn btn-info btn-sm" id="addDinasRowEdit" style="margin-top: 8px; border-radius: 6px; font-weight: 600;">
                                <i class="fa fa-plus"></i> Tambah Dinas
                            </button>
                            <div style="margin-top: 6px; font-size: 11.5px; color: #64748b;">
                                * Wajib pilih minimal 1 dinas
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="_TahunMulai" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Tahun Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="_TahunMulai" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="_TahunAkhir" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                    Tahun Akhir <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="_TahunAkhir" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
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
</div>

<!-- ============================================================ -->
<!-- STYLE CUSTOM -->
<!-- ============================================================ -->
<style>
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

    .dinas-row {
        display: flex;
        gap: 8px;
        margin-bottom: 8px;
        align-items: center;
    }
    .dinas-row select {
        flex: 1;
        border-radius: 6px;
        height: 34px;
        border: 1px solid #cbd5e1;
    }
    .dinas-row button {
        border-radius: 6px;
    }

    /* Alert styling */
    .alert {
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 12px 20px;
    }
    .alert-success {
        background-color: #dcfce7;
        border-color: #bbf7d0;
        color: #15803d;
    }
    .alert-danger {
        background-color: #fee2e2;
        border-color: #fecaca;
        color: #b91c1c;
    }
    .alert-warning {
        background-color: #fef3c7;
        border-color: #fde68a;
        color: #b45309;
    }
    .alert i {
        margin-right: 8px;
    }
    .fade.in {
        opacity: 1;
    }

    /* DataTable State Save - Mempertahankan posisi */
    .dataTables_wrapper .dataTables_info {
        font-size: 12px;
    }
    .dataTables_wrapper .dataTables_paginate {
        font-size: 12px;
    }
</style>

<!-- ============================================================ -->
<!-- JAVASCRIPT -->
<!-- ============================================================ -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>

<script>
    var BaseURL = '<?= base_url() ?>';
    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
    var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
    var DINAS_LIST = <?= json_encode($DaftarDinas) ?>;

    // ============================================================
    // FUNGSI BANTUAN DINAS
    // ============================================================
    function buildDinasSelect(nameAttr, selectedId) {
        var html = '<div class="dinas-row">';
        html += '<select class="form-control input-sm dinas-select" name="' + nameAttr + '[]" style="flex:1;">';
        html += '<option value="">-- Pilih Dinas / Pimpinan Daerah --</option>';

        var pimpinan = [];
        var dinasLain = [];
        var pimpinanNames = ['bupati', 'wakil bupati', 'walikota', 'wakil walikota'];

        DINAS_LIST.forEach(function(d) {
            var namaClean = (d.nama || '').toLowerCase().trim();
            if (pimpinanNames.indexOf(namaClean) !== -1) {
                pimpinan.push(d);
            } else {
                dinasLain.push(d);
            }
        });

        // Urutkan Pimpinan Daerah sesuai urutan standar
        pimpinan.sort(function(a, b) {
            var idxA = pimpinanNames.indexOf((a.nama || '').toLowerCase().trim());
            var idxB = pimpinanNames.indexOf((b.nama || '').toLowerCase().trim());
            return idxA - idxB;
        });

        if (pimpinan.length > 0) {
            html += '<optgroup label="Pimpinan Daerah">';
            pimpinan.forEach(function(d) {
                var sel = (selectedId && String(selectedId) === String(d.id)) ? 'selected' : '';
                html += '<option value="' + d.id + '" ' + sel + '>' + d.nama + '</option>';
            });
            html += '</optgroup>';
        }

        if (dinasLain.length > 0) {
            html += '<optgroup label="Perangkat Daerah / Dinas">';
            dinasLain.forEach(function(d) {
                var sel = (selectedId && String(selectedId) === String(d.id)) ? 'selected' : '';
                var tahunInfo = (d.tahun_mulai && d.tahun_akhir) ? ' (' + d.tahun_mulai + '-' + d.tahun_akhir + ')' : '';
                html += '<option value="' + d.id + '" ' + sel + '>' + d.nama + tahunInfo + '</option>';
            });
            html += '</optgroup>';
        }

        html += '</select>';
        html += '<button type="button" class="btn btn-danger btn-sm remove-dinas">Hapus</button>';
        html += '</div>';
        return html;
    }

    function checkPimpinanNotice(containerId) {
        var pimpinanNames = ['bupati', 'wakil bupati', 'walikota', 'wakil walikota'];
        var selectedPimpinan = [];

        $('#' + containerId + ' select.dinas-select').each(function() {
            var val = $(this).val();
            if (val) {
                var found = DINAS_LIST.find(function(d) { return String(d.id) === String(val); });
                if (found && pimpinanNames.indexOf((found.nama || '').toLowerCase().trim()) !== -1) {
                    if (selectedPimpinan.indexOf(found.nama) === -1) {
                        selectedPimpinan.push(found.nama);
                    }
                }
            }
        });

        var noticeId = containerId + '_pimpinanNotice';
        $('#' + noticeId).remove();
        if (selectedPimpinan.length > 0) {
            var noticeHtml = '<div id="' + noticeId + '" class="alert alert-info" style="margin-top:8px; margin-bottom:8px; padding:8px 12px; font-size:12px; line-height:1.4;">' +
                '<i class="fa fa-info-circle"></i> <b>' + selectedPimpinan.join(', ') + ' terpilih:</b> Otomatis terhubung dengan <b>seluruh Perangkat Daerah / Dinas</b> di wilayah ini (dapat dipanggil di semua dinas).' +
                '</div>';
            $('#' + containerId).after(noticeHtml);
        }
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
        checkPimpinanNotice(containerId);
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

    // ============================================================
    // DOCUMENT READY
    // ============================================================
    jQuery(document).ready(function($) {
        var table = $('#data-table-basic').DataTable();

        // INIT DINAS CONTAINER
        initDinasContainer('dinasContainerAdd', 'dinas_id', []);
        initDinasContainer('dinasContainerEdit', 'dinas_id', []);

        // ============================================================
        // FILTER WILAYAH (jika belum login)
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
                if (!prov) {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih Provinsi terlebih dahulu!');
                    return;
                }
                if (!kab) {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih Kab/Kota terlebih dahulu!');
                    return;
                }

                $.ajax({
                    url: BaseURL + "Daerah/SetTempKodeWilayah",
                    type: "POST",
                    data: {
                        KodeWilayah: kab,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    success: function(res) {
                        if (res === '1' || res === 'success') {
                            window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Wilayah berhasil dipilih!');
                        } else {
                            window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Gagal memilih wilayah!');
                        }
                    },
                    error: function() {
                        window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan saat memilih wilayah!');
                    }
                });
            });
        <?php } ?>

        // ============================================================
        // TAMBAH / HAPUS ROW DINAS
        // ============================================================
        $(document).on('click', '#addDinasRowAdd', function() {
            $('#dinasContainerAdd').append(buildDinasSelect('dinas_id', null));
            checkPimpinanNotice('dinasContainerAdd');
        });

        $(document).on('click', '#addDinasRowEdit', function() {
            $('#dinasContainerEdit').append(buildDinasSelect('dinas_id', null));
            checkPimpinanNotice('dinasContainerEdit');
        });

        $(document).on('click', '.remove-dinas', function() {
            var $container = $(this).closest('[id^="dinasContainer"]');
            var containerId = $container.attr('id');
            $(this).closest('.dinas-row').remove();
            if (containerId) {
                checkPimpinanNotice(containerId);
            }
        });

        $(document).on('change', '.dinas-select', function() {
            var $container = $(this).closest('[id^="dinasContainer"]');
            var containerId = $container.attr('id');
            if (containerId) {
                checkPimpinanNotice(containerId);
            }
        });

        // ============================================================
        // INPUT / SIMPAN - LANGSUNG RELOAD
        // ============================================================
        $("#Input").click(function() {
            var dinas = collectDinas('dinasContainerAdd');

            // Validasi
            if (!$("#NIP").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('NIP wajib diisi!');
                return;
            }
            if (!$("#Nama").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Nama wajib diisi!');
                return;
            }
            if (!$("#Jabatan").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Jabatan wajib diisi!');
                return;
            }
            if (!$("#Password").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Password wajib diisi!');
                return;
            }
            if (dinas.length < 1) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih minimal 1 dinas!');
                return;
            }
            if (!$("#TahunMulai").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Mulai wajib diisi!');
                return;
            }
            if (!$("#TahunAkhir").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Akhir wajib diisi!');
                return;
            }

            // Submit data
            $.post(BaseURL + "Daerah/InputKaryawan", {
                nip: $("#NIP").val(),
                nama: $("#Nama").val(),
                eselon: $("#Eselon").val(),
                jabatan: $("#Jabatan").val(),
                satuan_unit_kerja: $("#SatuanUnitKerja").val(),
                bidang_sub_koordinator: $("#BidangSubKoordinator").val(),
                password: $("#Password").val(),
                tahun_mulai: $("#TahunMulai").val(),
                tahun_akhir: $("#TahunAkhir").val(),
                dinas_id: dinas,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                if (res == '1') {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Data berhasil disimpan!');
                } else {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent(res || 'Gagal menyimpan data!');
                }
            }).fail(function() {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan pada server!');
            });
        });

        // ============================================================
        // EDIT - AMBIL DATA
        // ============================================================
        $(document).on("click", ".Edit", function() {
            $("#Id").val($(this).data('id'));
            $("#_NIP").val($(this).data('nip'));
            $("#_Nama").val($(this).data('nama'));
            $("#_Eselon").val($(this).data('eselon') || '');
            $("#_Jabatan").val($(this).data('jabatan'));
            $("#_SatuanUnitKerja").val($(this).data('satuan-unit-kerja') || '');
            $("#_BidangSubKoordinator").val($(this).data('bidang-sub-koordinator') || '');
            $("#_Password").val("");
            $("#_TahunMulai").val($(this).data('tahun-mulai'));
            $("#_TahunAkhir").val($(this).data('tahun-akhir'));

            var dinasIds = $(this).data('dinas-ids');
            var selected = dinasIds ? String(dinasIds).split(',').map(function(x) { return x.trim(); }).filter(Boolean) : [];
            initDinasContainer('dinasContainerEdit', 'dinas_id', selected);

            $('#ModalEditKaryawan').modal("show");
        });

        // ============================================================
        // UPDATE / EDIT - LANGSUNG RELOAD
        // ============================================================
        $("#Edit").click(function() {
            var dinas = collectDinas('dinasContainerEdit');

            // Validasi
            if (!$("#_NIP").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('NIP wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_Nama").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Nama wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_Jabatan").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Jabatan wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (dinas.length < 1) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Pilih minimal 1 dinas!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_TahunMulai").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Mulai wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }
            if (!$("#_TahunAkhir").val()) {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Tahun Akhir wajib diisi!');
                $('#ModalEditKaryawan').modal('hide');
                return;
            }

            // Submit data
            $.post(BaseURL + "Daerah/EditKaryawan", {
                id: $("#Id").val(),
                nip: $("#_NIP").val(),
                nama: $("#_Nama").val(),
                eselon: $("#_Eselon").val(),
                jabatan: $("#_Jabatan").val(),
                satuan_unit_kerja: $("#_SatuanUnitKerja").val(),
                bidang_sub_koordinator: $("#_BidangSubKoordinator").val(),
                password: $("#_Password").val(),
                tahun_mulai: $("#_TahunMulai").val(),
                tahun_akhir: $("#_TahunAkhir").val(),
                dinas_id: dinas,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                $('#ModalEditKaryawan').modal('hide');
                if (res == '1') {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Data berhasil diupdate!');
                } else {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent(res || 'Gagal update data!');
                }
            }).fail(function() {
                $('#ModalEditKaryawan').modal('hide');
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan pada server!');
            });
        });

        // ============================================================
        // HAPUS - LANGSUNG RELOAD
        // ============================================================
        $(document).on('click', '.Hapus', function() {
            var id = $(this).data('id');
            
            // Konfirmasi dengan modal confirm bawaan browser
            if (!confirm("Yakin ingin menghapus data ini?")) return;

            $.post(BaseURL + "Daerah/HapusKaryawan", {
                id: id,
                [CSRF_NAME]: CSRF_TOKEN
            }).done(function(res) {
                if (res == '1') {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=success&msg=' + encodeURIComponent('Data berhasil dihapus!');
                } else {
                    window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent(res || 'Gagal menghapus data!');
                }
            }).fail(function() {
                window.location.href = BaseURL + 'Daerah/Akun_Karyawan?flash=error&msg=' + encodeURIComponent('Terjadi kesalahan pada server!');
            });
        });
    });
</script>