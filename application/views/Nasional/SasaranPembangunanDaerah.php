<style>
    /* CSS Modal Vertical Center */
    .modal {
        text-align: center;
        padding: 0!important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        width: 650px; /* Diperlebar sedikit agar form muat rapi */
        max-width: 95%; 
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /* CSS Card Container Enhancement */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    /* CSS Table Enhancement */
    #hierarki-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
        vertical-align: middle;
    }
    #hierarki-table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
    }
    
    /* Efek hover baris tabel hierarki */
    #hierarki-table > tbody > tr.main-row {
        transition: filter 0.2s ease, background-color 0.2s ease;
    }
    #hierarki-table > tbody > tr.main-row:hover {
        background-color: #f1f8e9;
    }

    /* Expandable Metrics Box */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        padding: 15px 20px;
        background-color: #fafafa;
        border-radius: 8px;
        border: 1px dashed #cfd8dc;
        margin: 5px 0 10px 0;
    }
    .metric-box {
        background: #fff;
        padding: 12px 15px;
        border-radius: 8px;
        border-left: 4px solid #20c997;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .metric-label {
        font-size: 11px;
        color: #78909c;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }
    .metric-val {
        font-size: 15px;
        font-weight: 700;
        color: #263238;
    }

    /* CSS Button & Badge Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0 2px;
        transition: all 0.3s ease;
        padding: 5px 10px;
        font-weight: 600;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .badge-periode {
        background-color: #00c292;
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 194, 146, 0.3);
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Sasaran Pembangunan Wilayah</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputSasaranPembangunanDaerah" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Sasaran Pembangunan</b>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="hierarki-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 55%;">Provinsi</th>
                                    <th style="width: 15%;" class="text-center">Tahun</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 25%;" class="text-center">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($SasaranPembangunanDaerah)) {
                                    $No = 1; 
                                    foreach ($SasaranPembangunanDaerah as $key) { 
                                ?>
                                <!-- Baris Utama (Parent) -->
                                <tr class="main-row" data-id="prov-<?=$key['Id']?>" data-expanded="false">
                                    <td class="text-center"><b><?=$No++?></b></td>
                                    <td style="cursor: pointer; font-size: 14px;" onclick="toggleLevel('prov-<?=$key['Id']?>', this)">
                                        <i class="fa fa-plus toggle-icon" style="margin-right: 8px; color: #00c292; font-size: 12px; border: 1px solid #00c292; border-radius: 50%; padding: 3px;"></i>
                                        <b><?=$key['Nama']?></b>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-periode" style="background-color: #00bcd4; box-shadow: 0 2px 5px rgba(0, 188, 212, 0.3);"><?=$key['Tahun']?></span>
                                    </td>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info btn-action Edit" Edit="<?=$key['Id'].'|'.$key['LPE'].'|'.$key['PDRBPerKapita'].'|'.$key['KontribusiPDRB'].'|'.$key['Kemiskinan'].'|'.$key['RasioGINI'].'|'.$key['IMM'].'|'.$key['IntensitasEmisiGRK'].'|'.$key['IKLH'].'|'.$key['TPT'].'|'.$key['Tahun'].'|'.$key['Kode']?>" title="Edit"><i class="fa fa-edit"></i> Edit</button>
                                        <button class="btn btn-sm btn-danger btn-action Hapus" Hapus="<?=$key['Id']?>" title="Hapus"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <!-- Baris Dropdown Detail (Child) -->
                                <tr data-parent="prov-<?=$key['Id']?>" style="display: none; background-color: #fff;">
                                    <td></td>
                                    <td colspan="3" style="padding: 10px 15px 0px 0;">
                                        <!-- Container Flexbox 1 Baris Menyamping -->
                                        <div style="display: flex; flex-wrap: nowrap; gap: 8px; overflow-x: auto; padding: 15px; background-color: #fafafa; border-radius: 8px; border: 1px dashed #cfd8dc;">
                                            
                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Pertumbuhan Ekonomi</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['LPE']?> %</span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">PDRB Per Kapita</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;">Rp <?=$key['PDRBPerKapita']?> Jt</span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Kontribusi PDRB</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['KontribusiPDRB']?> %</span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Tingkat Kemiskinan</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['Kemiskinan']?> %</span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Rasio GINI</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['RasioGINI']?></span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Indeks Modal Manusia</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['IMM']?></span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Intensitas Emisi GRK</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['IntensitasEmisiGRK']?> %</span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Indeks Kualitas Lingkungan</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['IKLH']?></span>
                                            </div>

                                            <div style="flex: 1; min-width: 105px; background: #fff; padding: 10px 5px; border-radius: 6px; border-top: 3px solid #20c997; box-shadow: 0 2px 5px rgba(0,0,0,0.03); text-align: center;">
                                                <span style="font-size: 9px; color: #78909c; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; line-height: 1.2; height: 24px; display: flex; align-items: center; justify-content: center; text-align: center;">Tingkat Pengangguran</span>
                                                <span style="font-size: 10px; font-weight: 700; color: #263238;"><?=$key['TPT']?> %</span>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                    } 
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 30px; color: #999;">Belum ada data Sasaran Pembangunan Wilayah.</td>
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

<!-- ============================================== -->
<!-- MODAL INPUT -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSasaranPembangunanDaerah" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Tambah Pembangunan Wilayah</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-calendar"></i></div>
                            <div class="nk-int-st">
                                <input type="number" class="form-control" id="Tahun" placeholder="Tahun (YYYY)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp"><i class="fa fa-map-marker"></i></div>
                            <div class="nk-int-st">
                                <select class="form-control" id="Provinsi">
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    <?php if(isset($Provinsi)){ foreach ($Provinsi as $key) { ?>
                                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-line-chart"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Laju Pertumbuhan Ekonomi (%)" id="LPE">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-money"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="PDRB Per Kapita (Rp Juta)" id="PDRBPerKapita">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-pie-chart"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Kontribusi PDRB (%)" id="KontribusiPDRB">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-arrow-down"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Tingkat Kemiskinan (%)" id="Kemiskinan">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-balance-scale"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Rasio GINI" id="RasioGINI">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-users"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Indeks Modal Manusia" id="IMM">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-leaf"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Intensitas Emisi GRK (%)" id="IntensitasEmisiGRK">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-tree"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Indeks Lingkungan" id="IKLH">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-briefcase"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Tingkat Pengangguran" id="TPT">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="Input"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditSasaranPembangunanDaerah" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Pembangunan Wilayah</h2>
            </div>
            <div class="modal-body" style="padding-top: 20px;">
                <input type="hidden" id="Id">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-calendar"></i></div>
                            <div class="nk-int-st">
                                <input type="number" class="form-control" id="_Tahun" placeholder="Tahun (YYYY)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp"><i class="fa fa-map-marker"></i></div>
                            <div class="nk-int-st">
                                <select class="form-control" id="_Provinsi">
                                    <?php if(isset($Provinsi)){ foreach ($Provinsi as $key) { ?>
                                        <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-line-chart"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Laju Pertumbuhan Ekonomi (%)" id="_LPE">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-money"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="PDRB Per Kapita (Rp Juta)" id="_PDRBPerKapita">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-pie-chart"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Kontribusi PDRB (%)" id="_KontribusiPDRB">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-arrow-down"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Tingkat Kemiskinan (%)" id="_Kemiskinan">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-balance-scale"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Rasio GINI" id="_RasioGINI">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-users"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Indeks Modal Manusia" id="_IMM">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-leaf"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Intensitas Emisi GRK (%)" id="_IntensitasEmisiGRK">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-tree"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Indeks Lingkungan" id="_IKLH">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int float-lb floating-lb">
                            <div class="form-ic-cmp"><i class="fa fa-briefcase"></i></div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" placeholder="Tingkat Pengangguran" id="_TPT">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="EditBtn"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

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
    // JS Logic untuk Toggle Hierarki Tabel dengan klik text
    function toggleLevel(parentId, element) {
        var trs = document.querySelectorAll('tr[data-parent="' + parentId + '"]');
        var parentTr = element.closest('tr');
        var icon = element.querySelector('.toggle-icon');
        
        var isExpanded = parentTr.getAttribute('data-expanded') === 'true';

        if (isExpanded) {
            // Tutup (Collapse)
            parentTr.setAttribute('data-expanded', 'false');
            if(icon) {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            }
            trs.forEach(function(tr) {
                tr.style.display = 'none';
            });
        } else {
            // Buka (Expand)
            parentTr.setAttribute('data-expanded', 'true');
            if(icon) {
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
            trs.forEach(function(tr) {
                tr.style.display = 'table-row';
            });
        }
    }

    $(document).ready(function() {
        var BaseURL = '<?=base_url()?>'
        
        // Modal Input Submit
        $("#Input").click(function() {
            if (isNaN($("#Tahun").val()) || $("#Tahun").val() == "" || $("#Tahun").val().length != 4) {
                alert("Input Tahun Belum Benar!")
            } else if ($("#Provinsi").val() == null || $("#Provinsi").val() == "") {
                alert("Pilih Provinsi Terlebih Dahulu!")
            } else if ($("#LPE").val() == "") {
                alert('Input Pertumbuhan Ekonomi Belum Benar!')
            } else if ($("#PDRBPerKapita").val() == "") {
                alert('Input PDRB Per Kapita Belum Benar!')
            } else if ($("#KontribusiPDRB").val() == "") {
                alert('Input Kontribusi PDRB Belum Benar!')
            } else if ($("#Kemiskinan").val() == "") {
                alert('Input Tingkat Kemiskinan Belum Benar!')
            } else if ($("#RasioGINI").val() == "") {
                alert('Input Rasio GINI Belum Benar!')
            } else if ($("#IMM").val() == "") {
                alert('Input Indeks Modal Manusia Belum Benar!')
            } else if ($("#IntensitasEmisiGRK").val() == "") {
                alert('Input Intensitas Emisi GRK Belum Benar!')
            } else if ($("#IKLH").val() == "") {
                alert('Input Indeks Kualitas Lingkungan Hidup Belum Benar!')
            } else if ($("#TPT").val() == "") {
                alert('Input Tingkat Penngguran Terbuka Belum Benar!')
            } else {
                var SasaranPembangunanDaerah = { Provinsi           : $("#Provinsi").val(),
                                                 LPE                : $("#LPE").val(),
                                                 PDRBPerKapita      : $("#PDRBPerKapita").val(),
                                                 KontribusiPDRB     : $("#KontribusiPDRB").val(),
                                                 Kemiskinan         : $("#Kemiskinan").val(),
                                                 RasioGINI          : $("#RasioGINI").val(),
                                                 IMM                : $("#IMM").val(),
                                                 IntensitasEmisiGRK : $("#IntensitasEmisiGRK").val(),
                                                 IKLH               : $("#IKLH").val(),
                                                 TPT                : $("#TPT").val(),
                                                 Tahun              : $("#Tahun").val() }
                $.post(BaseURL+"Nasional/InputSasaranPembangunanDaerah", SasaranPembangunanDaerah).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanDaerah"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        })
        
        // Modal Edit Trigger
        $('#hierarki-table tbody').on('click', '.Edit', function () {
            var Data = $(this).attr('Edit')
            var Pisah = Data.split("|");
            $("#Id").val(Pisah[0])
            $("#_LPE").val(Pisah[1])
            $("#_PDRBPerKapita").val(Pisah[2])
            $("#_KontribusiPDRB").val(Pisah[3])
            $("#_Kemiskinan").val(Pisah[4])
            $("#_RasioGINI").val(Pisah[5])
            $("#_IMM").val(Pisah[6])
            $("#_IntensitasEmisiGRK").val(Pisah[7])
            $("#_IKLH").val(Pisah[8])
            $("#_TPT").val(Pisah[9])
            $("#_Tahun").val(Pisah[10])
            $("#_Provinsi").val(Pisah[11])
            $('#ModalEditSasaranPembangunanDaerah').modal("show")
        })

        // Modal Edit Submit
        $("#EditBtn").click(function() {
            if (isNaN($("#_Tahun").val()) || $("#_Tahun").val() == "" || $("#_Tahun").val().length != 4) {
                alert("Input Tahun Belum Benar!")
            } else if ($("#_LPE").val() == "") {
                alert('Input Pertumbuhan Ekonomi Belum Benar!')
            } else if ($("#_PDRBPerKapita").val() == "") {
                alert('Input PDRB Per Kapita Belum Benar!')
            } else if ($("#_KontribusiPDRB").val() == "") {
                alert('Input Kontribusi PDRB Belum Benar!')
            } else if ($("#_Kemiskinan").val() == "") {
                alert('Input Tingkat Kemiskinan Belum Benar!')
            } else if ($("#_RasioGINI").val() == "") {
                alert('Input Rasio GINI Belum Benar!')
            } else if ($("#_IMM").val() == "") {
                alert('Input Indeks Modal Manusia Belum Benar!')
            } else if ($("#_IntensitasEmisiGRK").val() == "") {
                alert('Input Intensitas Emisi GRK Belum Benar!')
            } else if ($("#_IKLH").val() == "") {
                alert('Input Indeks Kualitas Lingkungan Hidup Belum Benar!')
            } else if ($("#_TPT").val() == "") {
                alert('Input Tingkat Penngguran Terbuka Belum Benar!')
            } else {
                var SasaranPembangunanDaerah = { Id                 : $("#Id").val(),
                                                 Provinsi           : $("#_Provinsi").val(),
                                                 LPE                : $("#_LPE").val(),
                                                 PDRBPerKapita      : $("#_PDRBPerKapita").val(),
                                                 KontribusiPDRB     : $("#_KontribusiPDRB").val(),
                                                 Kemiskinan         : $("#_Kemiskinan").val(),
                                                 RasioGINI          : $("#_RasioGINI").val(),
                                                 IMM                : $("#_IMM").val(),
                                                 IntensitasEmisiGRK : $("#_IntensitasEmisiGRK").val(),
                                                 IKLH               : $("#_IKLH").val(),
                                                 TPT                : $("#_TPT").val(),
                                                 Tahun              : $("#_Tahun").val() }
                $.post(BaseURL+"Nasional/EditSasaranPembangunanDaerah", SasaranPembangunanDaerah).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanDaerah"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        })

        // Hapus Data
        $('#hierarki-table tbody').on('click', '.Hapus', function () {
            if(confirm("Apakah Anda yakin ingin menghapus Sasaran Pembangunan Wilayah ini?")) {
                var SasaranPembangunanDaerah = { Id: $(this).attr('Hapus') }
                $.post(BaseURL+"Nasional/HapusSasaranPembangunanDaerah", SasaranPembangunanDaerah).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Nasional/SasaranPembangunanDaerah"
                    } else {
                        alert(Respon)
                    }
                })                         
            }
        })
    })
</script>