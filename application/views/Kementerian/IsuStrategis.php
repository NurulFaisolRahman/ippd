    <?php $this->load->view('Kementerian/Sidebar'); ?>
    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <ul class="breadcomb-menu" style="list-style: none; padding: 0; margin: 0;">
                            <li style="display: inline-block; margin-right: 5px;">
                                <a href="<?= base_url('Beranda') ?>">Beranda</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block; margin-right: 5px;">
                                <a href="<?= base_url('Kementerian/IsuStrategis') ?>">Isu</a>
                                <span class="bread-slash" style="display: inline-block; margin: 0 5px;">/</span>
                            </li>
                            <li style="display: inline-block;">
                                <span class="bread-blk">Isu Strategis</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                        <div class="alert alert-info" style="margin-bottom:15px;">
                        <i class="notika-icon notika-info"></i>
                        <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName) ?><br>
                        <b>Periode :</b> <?= str_replace('|', ' - ', htmlspecialchars($UserPeriode)) ?>
                    </div>
    <?php endif; ?>
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                
                                    <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
                                <button type="button" class="btn btn-primary notika-btn-primary" id="FilterIsuStrategis">
                                    <i class="notika-icon notika-search"></i> 
                                    <b>Filter Data</b>
                                    <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                                        <span class="badge" style="background-color: #f44336; margin-left: 5px;">Filter Aktif</span>
                                    <?php endif; ?>
                                </button>
                                <?php   endif; ?>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputIsuStrategis">
                                    <i class="notika-icon notika-edit"></i> <b>Input Isu Strategis</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Modal Filter -->
                        <div class="modal fade" id="ModalFilter" role="dialog">
                        <div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
                            <div class="modal-dialog modals-default">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Filter Data Isu Strategis</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-example-wrap">
                                                    <div class="form-example-int">
                                                        <div class="form-group">
                                                            <label>Periode</label>
                                                            <select class="form-control" id="FilterPeriode">
                                                                <option value="">Semua Periode</option>
                                                                <?php foreach ($AllPeriode as $periode): ?>
                                                                    <?php 
                                                                        $periodeValue = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                                        $selected = ($CurrentPeriode == $periodeValue) ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?= $periodeValue ?>" <?= $selected ?>>
                                                                        <?= $periode['TahunMulai'] ?> - <?= $periode['TahunAkhir'] ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-example-int">  
                                                        <div class="form-group">
                                                            <label>Kementerian</label>
                                                            <select class="form-control" id="FilterKementerianSelect">
                                                                <option value="">Semua Kementerian</option>
                                                                <?php if ($CurrentPeriode && !empty($Kementerian)): ?>
                                                                    <?php foreach ($Kementerian as $kementerian): ?>
                                                                        <?php $selected = ($CurrentKementerian == $kementerian['Id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $kementerian['Id'] ?>" <?= $selected ?>>
                                                                            <?= $kementerian['NamaKementerian'] ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-example-int mg-t-15">
                                                        <button class="btn btn-success notika-btn-success" id="ApplyFilter">Terapkan Filter</button>
                                                        <button class="btn btn-danger notika-btn-danger" id="ResetFilter">Reset Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        

                        <!-- Tabel Data Isu Strategis -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped" style="table-layout: fixed;">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%">Kementerian</th>
                                        <th width="15%">Isu Strategis</th>
                                        <th width="15%">Permasalahan Pokok</th>
                                        <th width="15%">Isu KLHS</th>
                                        <th width="15%">Isu Global</th>
                                        <th width="15%">Isu Regional</th>
                                        <th width="15%">Isu Nasional</th>
                                        <th width="10%">Periode</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                        <th width="10%">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($IsuStrategis as $key): ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                        <td style="vertical-align: middle;"><?= $key['NamaKementerian'] ?></td>
                                        <td style="vertical-align: middle;"><?= $key['NamaIsuStrategis'] ?></td>                     
                                        <td style="vertical-align: top;">
                                            <div style="display: flex; flex-direction: column; height: 100%;">
                                                <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-success TambahPermasalahan" 
                                                            title="Tambah Permasalahan Pokok"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php if (!empty($key['NamaPermasalahanPokok'])): ?>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-info DetailPermasalahan" 
                                                            title="Detail Permasalahan Pokok"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-permasalahan="<?= $key['IdPermasalahanPokok'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <?php } ?>
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
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-success TambahKLHS" 
                                                            title="Tambah Isu KLHS"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php if (!empty($key['NamaIsuKLHS'])): ?>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-info DetailKLHS" 
                                                            title="Detail Isu KLHS"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-klhs="<?= $key['IdIsuKLHS'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <?php } ?>
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
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-success TambahGlobal" 
                                                            title="Tambah Isu Global"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php if (!empty($key['NamaIsuGlobal'])): ?>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-info DetailGlobal" 
                                                            title="Detail Isu Global"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-global="<?= $key['IdIsuGlobal'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <?php } ?>
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
                                       <!-- Isu Regional -->
<!-- Isu Regional -->
<td style="vertical-align: top;">
    <div style="display: flex; flex-direction: column; height: 100%;">
        <div style="display: flex; justify-content: center; gap: 5px; margin-bottom: 5px;">
            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
                <!-- Tombol Tambah -->
                <button class="btn btn-sm btn-success TambahRegional"
                        title="Tambah Isu Regional"
                        data-id="<?= $key['Id'] ?>"
                        data-tahunmulai="<?= $key['TahunMulai'] ?>"
                        data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                        style="width: 30px; height: 30px; padding: 0;">
                    <i class="fa fa-plus"></i>
                </button>

                <!-- Tombol Detail: muncul selama ada IdIsuRegional -->
                <?php if (!empty($key['IdIsuRegional'])): ?>
                    <button class="btn btn-sm btn-info DetailRegional"
                            title="Detail Isu Regional"
                            data-id="<?= $key['Id'] ?>"
                            data-regional="<?= htmlspecialchars($key['IdIsuRegional']) ?>"
                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                            style="width: 30px; height: 30px; padding: 0;">
                        <i class="fa fa-eye"></i>
                    </button>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div style="flex-grow: 1; overflow: auto; text-align: start;">
            <?php if (!empty($key['NamaIsuRegional'])): ?>
                <?= htmlspecialchars($key['NamaIsuRegional']) ?>
            <?php elseif (!empty($key['IdIsuRegional'])): ?>
                <span style="color: #888; font-style: italic;">
                    (ID: <?= htmlspecialchars($key['IdIsuRegional']) ?>) - Nama sedang dimuat
                </span>
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
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-success TambahNasional" 
                                                            title="Tambah Isu Nasional"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <?php } ?>
                                                    <?php if (!empty($key['NamaIsuNasional'])): ?>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
                                                    <button class="btn btn-sm btn-info DetailNasional" 
                                                            title="Detail Isu Nasional"
                                                            data-id="<?= $key['Id'] ?>"
                                                            data-nasional="<?= $key['IdIsuNasional'] ?>"
                                                            data-tahunmulai="<?= $key['TahunMulai'] ?>"
                                                            data-tahunakhir="<?= $key['TahunAkhir'] ?>"
                                                            style="width: 30px; height: 30px; padding: 0;">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <?php } ?>
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

<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) { ?>
<td style="vertical-align: middle;">
    <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">

        <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
    data-edit="<?= $key['Id'] ?>|<?= $key['IdKementerian'] ?>|<?= htmlspecialchars($key['NamaIsuStrategis']) ?>|<?= $key['IdIsuKLHS'] ?>|<?= $key['IdIsuGlobal'] ?>|<?= $key['IdIsuNasional'] ?>|<?= $key['TahunMulai'] ?>|<?= $key['TahunAkhir'] ?>|<?= $key['IdPermasalahanPokok'] ?>|<?= $key['IdIsuRegional'] ?>">
    <i class="notika-icon notika-edit"></i>
</button>

        <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus"
            data-hapus="<?= $key['Id'] ?>">
            <i class="notika-icon notika-trash"></i>
        </button>

    </div>
</td>
<?php } ?>

                                    </tr>
                                    <?php endforeach; ?>
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
                                            <?php if($_SESSION['Level']==0): ?>
                                                <select class="form-control" id="Periode" name="Periode" required>
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php foreach ($Periode as $periode): ?>
                                                        <option value="<?= $periode['TahunMulai'].'|'.$periode['TahunAkhir'] ?>">
                                                            <?= $periode['TahunMulai'].' - '.$periode['TahunAkhir'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                <input type="hidden" id="Periode" value="<?= htmlspecialchars($UserPeriode) ?>">
                                                <input type="hidden" name="TahunMulai" value="<?= htmlspecialchars($UserTahunMulai) ?>">
                                                <input type="hidden" name="TahunAkhir" value="<?= htmlspecialchars($UserTahunAkhir) ?>">
                                                <input type="text" class="form-control" value="<?= htmlspecialchars($UserTahunMulai.' - '.$UserTahunAkhir) ?>" readonly>
                                            <?php endif; ?>
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
                                            <?php if($_SESSION['Level']==0): ?>
                                                <select class="form-control" id="IdKementerian" name="IdKementerian" required>
                                                    <option value="">-- Pilih Kementerian --</option>
                                                </select>
                                            <?php else: ?>
                                                <input type="hidden" name="IdKementerian" id="IdKementerian" value="<?= $_SESSION['IdKementerian'] ?>">
                                                <input type="text" class="form-control" value="<?= $UserKementerianName ?>" readonly>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Permasalahan Pokok -->
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

                        <div class="form-example-int form-horizental">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-2">
                <label class="hrzn-fm"><b>Isu Regional</b></label>
            </div>
            <div class="col-lg-9">
                <div id="regional-container">   <!-- ← ganti dari edit- menjadi regional- -->
                    <div class="form-group regional-row">
                        <div class="row">
                            <div class="col-md-10">
                                <select class="form-control regional-select" name="IdIsuRegional[]">
                                    <option value="">-- Pilih Isu Regional --</option>
                                </select>
                            </div>
                            <div class="col-md-2" style="padding-top: 25px;">
                                <button type="button" class="btn btn-success btn-add-regional">
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
                                                <?php if($_SESSION['Level']==0): ?>

                                                    <select class="form-control" id="EditPeriode" name="Periode" required>
                                                        <option value="">-- Pilih Periode --</option>
                                                        <?php foreach ($Periode as $periode): ?>
                                                            <option value="<?= $periode['TahunMulai'].'|'.$periode['TahunAkhir'] ?>">
                                                                <?= $periode['TahunMulai'].' - '.$periode['TahunAkhir'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                    <?php else: ?>

                                                    <input type="hidden" id="EditPeriode" value="<?= $UserPeriode ?>">
                                                    <input type="hidden" name="TahunMulai" value="<?= $UserTahunMulai ?>">
    <input type="hidden" name="TahunAkhir" value="<?= $UserTahunAkhir ?>">

                                                    <input type="text" value="<?= $UserTahunMulai.' - '.$UserTahunAkhir ?>">

                                                    <?php endif; ?>

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
                                                <?php if($_SESSION['Level']==0): ?>

                                                    <select class="form-control" id="EditIdKementerian" name="IdKementerian" required>
                                                        <option value="">-- Pilih Kementerian --</option>
                                                    </select>

                                                    <?php else: ?>

                                                    <input type="hidden" name="IdKementerian" id="EditIdKementerian" value="<?= $_SESSION['IdKementerian'] ?>">
                                                    <input type="text" class="form-control" value="<?= $UserKementerianName ?>" readonly>

                                                    <?php endif; ?>

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
                            
                           <!-- Isu Regional (wajib ditambahkan di modal Edit) -->
<div class="form-example-int form-horizental">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-2">
                <label class="hrzn-fm"><b>Isu Regional</b></label>
            </div>
            <div class="col-lg-9">
                <div id="edit-regional-container">
                    <!-- Rows diisi oleh JS -->
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

    <!-- Modal Tambah/Edit Isu Regional -->
<div class="modal fade" id="ModalTambahRegional" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah/Edit Isu Regional</h4>
            </div>
            <div class="modal-body">
                <form id="FormTambahRegional">
                    <input type="hidden" id="RegionalId" name="Id">
                    <div id="regional-table-container">
                        <!-- Rows akan diisi JS -->
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-success btn-add-regional-row">
                            <i class="notika-icon notika-plus-symbol"></i> Tambah Isu Regional
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

    <div class="modal fade" id="ModalDetailRegional" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Detail Isu Regional</h4>
            </div>
            <div class="modal-body">
                <div id="regional-detail-container">
                    <ul class="list-group">
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
var USER_LEVEL = '<?= $_SESSION['Level'] ?? 0 ?>';
var USER_KEMENTERIAN = '<?= $_SESSION['IdKementerian'] ?? '' ?>';
var USER_PERIODE = '<?= $UserPeriode ?? '' ?>';
var USER_TAHUN_MULAI = '<?= $UserTahunMulai ?? '' ?>';
var USER_TAHUN_AKHIR = '<?= $UserTahunAkhir ?? '' ?>';

jQuery(document).ready(function($) {
    console.log("Initial Data:", {
        USER_LEVEL,
        USER_KEMENTERIAN,
        USER_PERIODE,
        USER_TAHUN_MULAI,
        USER_TAHUN_AKHIR
    });

    // =============================================================
    // Fungsi utama: Load semua dropdown berdasarkan periode
    // =============================================================
    function loadDropdownByPeriode(prefix = '', TahunMulai = '', TahunAkhir = '', selected = {}) {
    if (!TahunMulai || !TahunAkhir) {
        console.warn("[loadDropdownByPeriode] Periode tidak valid", { prefix, TahunMulai, TahunAkhir });
        return;
    }
    console.log("[loadDropdownByPeriode] Memuat data untuk periode:", TahunMulai, "-", TahunAkhir, "prefix:", prefix);
    const root = prefix ? '#edit-' : '#';

    // Permasalahan Pokok
    $.post(BaseURL + "Kementerian/GetPermasalahanByPeriode", {
        TahunMulai,
        TahunAkhir,
        IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
    }).done(data => {
        console.log("[Raw Permasalahan]:", data);
        console.log("[Permasalahan] Jumlah data:", data?.length || 0);

        $(`${root}permasalahan-container .permasalahan-select, ${root}permasalahan-table-container .permasalahan-select`)
            .each(function() {
                const selId = $(this).data('selected-id') || '';
                populateDropdown($(this), data, selId ? [selId] : [], '-- Pilih Permasalahan Pokok --');
            });
    }).fail(err => console.error("[Permasalahan] AJAX gagal:", err));

    // Isu KLHS
    $.post(BaseURL + "Kementerian/GetIsuByPeriode", {
        TahunMulai,
        TahunAkhir,
        Jenis: 'KLHS',
        IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
    }).done(data => {
        console.log("[Raw KLHS]:", data);
        console.log("[KLHS] Jumlah data:", data?.length || 0);

        $(`${root}klhs-container .klhs-select, ${root}klhs-table-container .klhs-select`)
            .each(function() {
                const selId = $(this).data('selected-id') || '';
                populateDropdown($(this), data, selId ? [selId] : [], '-- Pilih Isu KLHS --');
            });
    }).fail(err => console.error("[KLHS] AJAX gagal:", err));

    // Isu Global
    $.post(BaseURL + "Kementerian/GetIsuByPeriode", {
        TahunMulai,
        TahunAkhir,
        Jenis: 'Global',
        IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
    }).done(data => {
        console.log("[Raw Global]:", data);
        console.log("[Global] Jumlah data:", data?.length || 0);

        $(`${root}global-container .global-select, ${root}global-table-container .global-select`)
            .each(function() {
                const selId = $(this).data('selected-id') || '';
                populateDropdown($(this), data, selId ? [selId] : [], '-- Pilih Isu Global --');
            });
    }).fail(err => console.error("[Global] AJAX gagal:", err));
    


    // Isu Nasional
    $.post(BaseURL + "Kementerian/GetIsuByPeriode", {
        TahunMulai,
        TahunAkhir,
        Jenis: 'Nasional',
        IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
    }).done(data => {
        console.log("[Raw Nasional]:", data);
        console.log("[Nasional] Jumlah data:", data?.length || 0);

        $(`${root}nasional-container .nasional-select, ${root}nasional-table-container .nasional-select`)
            .each(function() {
                const selId = $(this).data('selected-id') || '';
                populateDropdown($(this), data, selId ? [selId] : [], '-- Pilih Isu Nasional --');
            });
    }).fail(err => console.error("[Nasional] AJAX gagal:", err));

    // Isu Regional
$.post(BaseURL + "Kementerian/GetIsuByPeriode", {
    TahunMulai,
    TahunAkhir,
    Jenis: 'Regional',
    IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
}).done(data => {
    console.log("[Raw Regional]:", data);
    console.log("[Regional] Jumlah data:", data?.length || 0);
    $(`${root}regional-container .regional-select, 
       ${root}edit-regional-container .regional-select,
       ${root}regional-table-container .regional-select`)
        .each(function() {
            const selId = $(this).data('selected-id') || '';
            populateDropdown($(this), data, selId ? [selId] : [], '-- Pilih Isu Regional --');
        });
}).fail(err => console.error("[Regional] AJAX gagal:", err));
}

    // =============================================================
    // Fungsi populate dropdown
    // =============================================================
    function populateDropdown(selectElement, data, selectedIds = [], defaultText = '-- Pilih --') {
        selectElement.empty().append('<option value="">' + defaultText + '</option>');

        if (!Array.isArray(selectedIds)) selectedIds = [selectedIds];

        if (data && Array.isArray(data) && data.length > 0) {
            $.each(data, function(index, item) {
                const text = item.NamaPermasalahanPokok ||
                             item.NamaIsuKLHS ||
                             item.NamaIsuGlobal ||
                             item.NamaIsuRegional ||
                             item.NamaIsuNasional ||
                             item.Nama ||
                             '-';
                selectElement.append('<option value="' + item.Id + '">' + text + '</option>');
            });
        }

        if (selectedIds.length > 0 && selectedIds[0] !== '') {
            setTimeout(() => {
                selectElement.val(selectedIds).trigger('change');
            }, 80);
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

    // Function to populate Kementerian dropdown
    function populateKementerian(selectElement, tahunMulai, tahunAkhir, selectedId = '') {
        if (tahunMulai && tahunAkhir) {
            $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                TahunMulai: tahunMulai,
                TahunAkhir: tahunAkhir
            }, function(response) {
                try {
                    var kementerian = JSON.parse(response);
                    selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
                    $.each(kementerian, function(index, item) {
                        var isSelected = (item.Id == selectedId) ? 'selected' : '';
                        selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                    });
                } catch(e) {
                    console.error("Error parsing Kementerian data:", e);
                    selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
                }
            }).fail(function() {
                selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
            });
        } else {
            selectElement.empty().append('<option value="">-- Pilih Kementerian --</option>');
        }
    }

    // Function to load Kementerian for filter
    function loadKementerianForFilter(periode, selectElement, selectedId = '') {
        if (periode) {
            var [tahunMulai, tahunAkhir] = periode.split('|');
            $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {
                TahunMulai: tahunMulai, 
                TahunAkhir: tahunAkhir
            }, function(response) {
                try {
                    var kementerian = JSON.parse(response);
                    selectElement.empty().append('<option value="">Semua Kementerian</option>');
                    
                    if (kementerian.length > 0) {
                        $.each(kementerian, function(index, item) {
                            var isSelected = (item.Id == selectedId) ? 'selected' : '';
                            selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                        });
                    }
                } catch(e) {
                    console.error("Error parsing Kementerian data:", e);
                    selectElement.empty().append('<option value="">Semua Kementerian</option>');
                }
            }).fail(function() {
                selectElement.empty().append('<option value="">Semua Kementerian</option>');
            });
        } else {
            // Load all ministries if no period selected
            $.post(BaseURL + "Kementerian/GetKementerianByPeriode", {}, function(response) {
                try {
                    var kementerian = JSON.parse(response);
                    selectElement.empty().append('<option value="">Semua Kementerian</option>');
                    
                    if (kementerian.length > 0) {
                        $.each(kementerian, function(index, item) {
                            var isSelected = (item.Id == selectedId) ? 'selected' : '';
                            selectElement.append('<option value="' + item.Id + '" ' + isSelected + '>' + item.NamaKementerian + '</option>');
                        });
                    }
                } catch(e) {
                    console.error("Error parsing Kementerian data:", e);
                    selectElement.empty().append('<option value="">Semua Kementerian</option>');
                }
            }).fail(function() {
                selectElement.empty().append('<option value="">Semua Kementerian</option>');
            });
        }
    }

    // =============================================================
    // Load awal untuk user Level 1 (periode dari session)
    // =============================================================
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1 && !empty($UserTahunMulai) && !empty($UserTahunAkhir)): ?>
    loadDropdownByPeriode('', '<?= htmlspecialchars($UserTahunMulai) ?>', '<?= htmlspecialchars($UserTahunAkhir) ?>');
    <?php endif; ?>

    // =============================================================
    // Saat modal Input muncul → pastikan load untuk Level 1
    // =============================================================
    // Saat modal Input muncul
$("#ModalInputIsuStrategis").on("show.bs.modal", function() {
    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
    // Pakai nilai dari session (sudah ada di hidden input)
    const tm = $("#TahunMulai").val() || '<?= htmlspecialchars($UserTahunMulai ?? '') ?>';
    const ta = $("#TahunAkhir").val() || '<?= htmlspecialchars($UserTahunAkhir ?? '') ?>';
    
    // Pastikan terisi
    if (tm && ta) {
        $("#TahunMulai").val(tm);
        $("#TahunAkhir").val(ta);
        loadDropdownByPeriode('', tm, ta);
    } else {
        alert('Periode tidak ditemukan. Silakan hubungi admin.');
    }
    <?php else: ?>
    // Untuk admin: biarkan user pilih periode (sudah ada event change)
    <?php endif; ?>
});

    // Show filter modal
    $("#FilterIsuStrategis").click(function() {
        $('#ModalFilter').modal("show");
        
        // Initialize the ministry dropdown based on current period filter
        var currentPeriode = $("#FilterPeriode").val();
        if (currentPeriode) {
            loadKementerianForFilter(currentPeriode, $("#FilterKementerianSelect"), '<?= $CurrentKementerian ?>');
        } else {
            loadKementerianForFilter('', $("#FilterKementerianSelect"), '<?= $CurrentKementerian ?>');
        }
    });

    // Load ministries when period filter changes
    $("#FilterPeriode").change(function() {
        var periode = $(this).val();
        loadKementerianForFilter(periode, $("#FilterKementerianSelect"));
    });

    // Apply filter
    $("#ApplyFilter").click(function() {
        var periode = $("#FilterPeriode").val();
        var kementerian = $("#FilterKementerianSelect").val();
        var url = BaseURL + "Kementerian/IsuStrategis?";
        
        if (periode) url += "periode=" + encodeURIComponent(periode) + "&";
        if (kementerian) url += "kementerian=" + encodeURIComponent(kementerian);
        
        window.location.href = url;
    });

    // Reset filter
    $("#ResetFilter").click(function() {
        window.location.href = BaseURL + "Kementerian/IsuStrategis";
    });

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

    // Input Modal: Handle Periode change (untuk Admin)
    $("#Periode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [TahunMulai, TahunAkhir] = periode.split('|');
            $("#TahunMulai").val(TahunMulai);
            $("#TahunAkhir").val(TahunAkhir);
            
            // Load Kementerian
            $.post(BaseURL + "Kementerian/GetKementerianByPeriode", { 
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
            
            // Load semua dropdown untuk Admin
            loadDropdownByPeriode('', TahunMulai, TahunAkhir);
        } else {
            $("#IdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
            $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
            $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
            $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
        }
    });

    // Edit Modal: Handle Periode change (untuk Admin)
    $("#EditPeriode").change(function() {
        var periode = $(this).val();
        if (periode) {
            var [TahunMulai, TahunAkhir] = periode.split('|');
            $("#EditTahunMulai").val(TahunMulai);
            $("#EditTahunAkhir").val(TahunAkhir);
            
            // Load Kementerian
            $.post(BaseURL + "Kementerian/GetKementerianByPeriode", { 
                TahunMulai: TahunMulai, 
                TahunAkhir: TahunAkhir 
            }, function(data) {
                try {
                    populateDropdown($("#EditIdKementerian"), JSON.parse(data), Pisah[1], '-- Pilih Kementerian --');
                } catch(e) {
                    console.error("Error parsing Kementerian data:", e);
                    $("#EditIdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
                }
            }).fail(function() {
                $("#EditIdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            });
            
            // Load semua dropdown untuk Admin
            loadDropdownByPeriode('edit', TahunMulai, TahunAkhir);
        } else {
            $("#EditIdKementerian").html('<option value="">-- Pilih Kementerian --</option>');
            $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
            $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
            $('.nasional-select').html('<option value="">-- Pilih Isu Nasional --</option>');
            $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
        }
    });

    // =============================================================
    // Saat tombol Edit diklik → siapkan modal edit
    // =============================================================
    $(document).on("click", ".Edit", function() {
        var Data = $(this).data('edit');
        var Pisah = Data.split("|");

        $("#EditId").val(Pisah[0]);
        $("#EditNamaIsuStrategis").val(Pisah[2]);

        // simpan kementerian → nanti dipilih setelah dropdown load
        $("#EditIdKementerian").data('selected-id', Pisah[1]);

        // set periode dulu → akan trigger ajax load dropdown
        $("#EditTahunMulai").val(Pisah[6]);
        $("#EditTahunAkhir").val(Pisah[7]);

        // reset container
        $('#edit-klhs-container').empty();
        $('#edit-global-container').empty();
        $('#edit-nasional-container').empty();
        $('#edit-permasalahan-container').empty();


        /* ===================== KLHS ===================== */
        if (Pisah[3]) {
            var klhsIds = Pisah[3].split(',');
            klhsIds.forEach(function(id) {
                if (id) {
                    $('#edit-klhs-container').append(`
                        <div class="form-group klhs-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control klhs-select" name="IdIsuKLHS[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu KLHS --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top:25px;">
                                    <button type="button" class="btn btn-success btn-add-klhs">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        } else {
            $('#edit-klhs-container').append(`
                <div class="form-group klhs-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control klhs-select" name="IdIsuKLHS[]">
                                <option value="">-- Pilih Isu KLHS --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="button" class="btn btn-success btn-add-klhs">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        }


        /* ===================== GLOBAL ===================== */
        if (Pisah[4]) {
            var globalIds = Pisah[4].split(',');
            globalIds.forEach(function(id) {
                if (id) {
                    $('#edit-global-container').append(`
                        <div class="form-group global-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control global-select" name="IdIsuGlobal[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu Global --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top:25px;">
                                    <button type="button" class="btn btn-success btn-add-global">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        } else {
            $('#edit-global-container').append(`
                <div class="form-group global-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control global-select" name="IdIsuGlobal[]">
                                <option value="">-- Pilih Isu Global --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="button" class="btn btn-success btn-add-global">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        }


        /* ===================== NASIONAL ===================== */
        if (Pisah[5]) {
            var nasionalIds = Pisah[5].split(',');
            nasionalIds.forEach(function(id) {
                if (id) {
                    $('#edit-nasional-container').append(`
                        <div class="form-group nasional-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control nasional-select" name="IdIsuNasional[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Isu Nasional --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top:25px;">
                                    <button type="button" class="btn btn-success btn-add-nasional">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        } else {
            $('#edit-nasional-container').append(`
                <div class="form-group nasional-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control nasional-select" name="IdIsuNasional[]">
                                <option value="">-- Pilih Isu Nasional --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="button" class="btn btn-success btn-add-nasional">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        }
      // Isu Regional - Modal Edit
if (Pisah[9]) {  // Pisah[9] = IdIsuRegional dari data-edit
    var ids = Pisah[9].split(',');
    ids.forEach(function(id) {
        if (id.trim()) {
            $('#edit-regional-container').append(`
                <div class="form-group regional-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control regional-select" name="IdIsuRegional[]" required data-selected-id="${id.trim()}">
                                <option value="">-- Pilih Isu Regional --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="button" class="btn btn-success btn-add-regional">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        }
    });
} else {
    $('#edit-regional-container').append(`
        <div class="form-group regional-row">
            <div class="row">
                <div class="col-md-10">
                    <select class="form-control regional-select" name="IdIsuRegional[]">
                        <option value="">-- Pilih Isu Regional --</option>
                    </select>
                </div>
                <div class="col-md-2" style="padding-top:25px;">
                    <button type="button" class="btn btn-success btn-add-regional">
                        <i class="notika-icon notika-plus-symbol"></i>
                    </button>
                </div>
            </div>
        </div>
    `);
}

        /* ===================== PERMASALAHAN ===================== */
        if (Pisah[8]) {
            var perIds = Pisah[8].split(',');
            perIds.forEach(function(id) {
                if (id) {
                    $('#edit-permasalahan-container').append(`
                        <div class="form-group permasalahan-row">
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]" required data-selected-id="${id}">
                                        <option value="">-- Pilih Permasalahan Pokok --</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding-top:25px;">
                                    <button type="button" class="btn btn-success btn-add-permasalahan">
                                        <i class="notika-icon notika-plus-symbol"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        } else {
            $('#edit-permasalahan-container').append(`
                <div class="form-group permasalahan-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]">
                                <option value="">-- Pilih Permasalahan Pokok --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="button" class="btn btn-success btn-add-permasalahan">
                                <i class="notika-icon notika-plus-symbol"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        }

        // Set Kementerian dropdown
        if (USER_LEVEL == 0) { // Admin
            populateKementerian($("#EditIdKementerian"), Pisah[6], Pisah[7], Pisah[1]);
        } else { // Kementerian
            $("#EditIdKementerian").val(Pisah[1]);
        }

        // Load dropdown data dengan filter kementerian
        loadDropdownByPeriode('edit', Pisah[6], Pisah[7]);

        $('#ModalEditIsuStrategis').modal("show");
    });

    // Input Isu Strategis
    $("#FormInputIsuStrategis").submit(function(e) {
    e.preventDefault();

    // Cek periode
    if (!$("#TahunMulai").val() || !$("#TahunAkhir").val()) {
        alert('Periode (Tahun Mulai & Akhir) wajib diisi!');
        return;
    }

    // Cek kementerian
    if (!$("#IdKementerian").val()) {
        alert('Kementerian wajib dipilih!');
        return;
    }

    // Cek nama isu
    if (!$("#NamaIsuStrategis").val().trim()) {
        alert('Nama Isu Strategis wajib diisi!');
        return;
    }

    var formData = $(this).serialize();

    $.post(BaseURL + "Kementerian/InputIsuStrategis", formData)
        .done(function(Respon) {
    if (Respon.trim() === '1') {
        window.location.reload();  // berhasil → reload langsung, tanpa alert
    } else {
        alert(Respon || 'Terjadi kesalahan pada server');
    }
})
        .fail(function() {
            alert('Gagal menghubungi server. Silakan coba lagi.');
        });
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
        
        $.post(BaseURL + "Kementerian/UpdateIsuStrategis", formData)
            .done(function(Respon) {
    if (Respon.trim() === '1') {
        window.location.reload();  // berhasil → reload langsung, tanpa alert
    } else {
        alert(Respon || 'Terjadi kesalahan pada server');
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
            $.post(BaseURL + "Kementerian/DeleteIsuStrategis", Data)
                .done(function(Respon) {
    if (Respon.trim() === '1') {
        window.location.reload();  // berhasil → reload langsung, tanpa alert
    } else {
        alert(Respon || 'Terjadi kesalahan pada server');
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
            if (id.trim()) {
                var newRow = `
                    <div class="form-group klhs-row">
                        <div class="row">
                            <div class="col-md-10">
                                <select class="form-control klhs-select" name="IdIsuKLHS[]" required data-selected-id="${id.trim()}">
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

    // Load Isu KLHS options (tanpa JSON.parse)
    if (TahunMulai && TahunAkhir) {
        $.post(BaseURL + "Kementerian/GetIsuByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            Jenis: 'KLHS',
            IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
        }).done(data => {
            console.log("[Raw KLHS Modal]:", data);  // ← DEBUG penting
            console.log("[KLHS Modal] Jumlah data:", data?.length || 0);

            $('.klhs-select').each(function() {
                var selectedId = $(this).data('selected-id') || '';
                populateDropdown($(this), data, selectedId ? [selectedId] : [], '-- Pilih Isu KLHS --');
            });
        }).fail(function() {
            console.error("[KLHS Modal] AJAX gagal");
            $('.klhs-select').html('<option value="">-- Pilih Isu KLHS --</option>');
        });
    }

    $('#ModalTambahKLHS').modal('show');
});

// Handle Add Regional Row
$(document).on('click', '.btn-add-regional', function() {
    var container = $(this).closest('[id$="-container"]');  // cari container terdekat (regional atau edit-regional)
    var newRow = `
        <div class="form-group regional-row">
            <div class="row">
                <div class="col-md-10">
                    <select class="form-control regional-select" name="IdIsuRegional[]">
                        <option value="">-- Pilih Isu Regional --</option>
                    </select>
                </div>
                <div class="col-md-2" style="padding-top: 25px;">
                    <button type="button" class="btn btn-success btn-add-regional">
                        <i class="notika-icon notika-plus-symbol"></i>
                    </button>
                </div>
            </div>
        </div>`;
    container.append(newRow);

    // Reload dropdown hanya untuk select baru (opsional tapi bagus)
    var TahunMulai = $("#TahunMulai").val() || $("#EditTahunMulai").val();
    var TahunAkhir = $("#TahunAkhir").val() || $("#EditTahunAkhir").val();
    if (TahunMulai && TahunAkhir) {
        $.post(BaseURL + "Kementerian/GetIsuByPeriode", {
            TahunMulai, TahunAkhir,
            Jenis: 'Regional',
            IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
        }).done(data => {
            container.find('.regional-select').last().each(function() {
                populateDropdown($(this), data, [], '-- Pilih Isu Regional --');
            });
        });
    }
});


// Handle Add KLHS Row (reload hanya untuk select baru)
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

    // Reload options untuk select terakhir saja
    var TahunMulai = $('.TambahKLHS').data('tahunmulai') || $('.EditKLHS').data('tahunmulai');
    var TahunAkhir = $('.TambahKLHS').data('tahunakhir') || $('.EditKLHS').data('tahunakhir');

    if (TahunMulai && TahunAkhir) {
        $.post(BaseURL + "Kementerian/GetIsuByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            Jenis: 'KLHS',
            IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
        }).done(data => {
            console.log("[Raw KLHS Tambah Row]:", data);
            console.log("[KLHS Tambah Row] Jumlah data:", data?.length || 0);

            var lastSelect = $('#klhs-table-container .klhs-select').last();
            lastSelect.html('<option value="">-- Pilih Isu KLHS --</option>');
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    lastSelect.append('<option value="' + item.Id + '">' + (item.NamaIsuKLHS || '-') + '</option>');
                });
            }
        }).fail(function() {
            $('#klhs-table-container .klhs-select').last().html('<option value="">-- Pilih Isu KLHS --</option>');
        });
    }
});

// Submit Form Tambah KLHS (sudah benar, tidak perlu diubah)
$("#FormTambahKLHS").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    
    $.post(BaseURL + "Kementerian/UpdateIsuKLHSForStrategis", formData)
        .done(function(Respon) {
    if (Respon.trim() === '1') {
        window.location.reload();  // berhasil → reload langsung, tanpa alert
    } else {
        alert(Respon || 'Terjadi kesalahan pada server');
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
            if (id.trim()) {
                var newRow = `
                    <div class="form-group global-row">
                        <div class="row">
                            <div class="col-md-10">
                                <select class="form-control global-select" name="IdIsuGlobal[]" required data-selected-id="${id.trim()}">
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

    // Load Isu Global options (tanpa JSON.parse)
    if (TahunMulai && TahunAkhir) {
        $.post(BaseURL + "Kementerian/GetIsuByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            Jenis: 'Global',
            IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
        }).done(data => {
            console.log("[Raw Global Modal]:", data);  // ← DEBUG penting
            console.log("[Global Modal] Jumlah data:", data?.length || 0);

            $('.global-select').each(function() {
                var selectedId = $(this).data('selected-id') || '';
                populateDropdown($(this), data, selectedId ? [selectedId] : [], '-- Pilih Isu Global --');
            });
        }).fail(function() {
            console.error("[Global Modal] AJAX gagal");
            $('.global-select').html('<option value="">-- Pilih Isu Global --</option>');
        });
    }

    $('#ModalTambahGlobal').modal('show');
});

// Handle Add Global Row (reload hanya untuk select baru)
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

    // Reload options untuk select terakhir saja
    var TahunMulai = $('.TambahGlobal').data('tahunmulai') || $('.EditGlobal').data('tahunmulai');
    var TahunAkhir = $('.TambahGlobal').data('tahunakhir') || $('.EditGlobal').data('tahunakhir');

    if (TahunMulai && TahunAkhir) {
        $.post(BaseURL + "Kementerian/GetIsuByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            Jenis: 'Global',
            IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
        }).done(data => {
            console.log("[Raw Global Tambah Row]:", data);
            console.log("[Global Tambah Row] Jumlah data:", data?.length || 0);

            var lastSelect = $('#global-table-container .global-select').last();
            lastSelect.html('<option value="">-- Pilih Isu Global --</option>');
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    lastSelect.append('<option value="' + item.Id + '">' + (item.NamaIsuGlobal || '-') + '</option>');
                });
            }
        }).fail(function() {
            $('#global-table-container .global-select').last().html('<option value="">-- Pilih Isu Global --</option>');
        });
    }
});

// Submit Form Tambah Global (sudah benar, tidak perlu diubah)
$("#FormTambahGlobal").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    
    $.post(BaseURL + "Kementerian/UpdateIsuGlobalForStrategis", formData)
        .done(function(Respon) {
    if (Respon.trim() === '1') {
        window.location.reload();  // berhasil → reload langsung, tanpa alert
    } else {
        alert(Respon || 'Terjadi kesalahan pada server');
    }
})
        .fail(function() {
            alert('Gagal menghubungi server. Silakan coba lagi.');
        });
});
// ======================================================
// REGIONAL
// ======================================================

// Buka modal tambah/edit
// =============================================================
// Handler Tambah/Edit Isu Regional (modal khusus)
// =============================================================
$(document).on('click', '.TambahRegional, .EditRegional', function() {
    const isEdit       = $(this).hasClass('EditRegional');
    const id           = $(this).data('id');
    const regionalIds  = isEdit ? ($(this).data('regional') || '') : '';
    const tahunMulai   = $(this).data('tahunmulai') || '';
    const tahunAkhir   = $(this).data('tahunakhir') || '';

    // Simpan data tahun ke modal agar bisa diakses oleh tombol tambah row
    $('#ModalTambahRegional')
        .data('tahunmulai', tahunMulai)
        .data('tahunakhir', tahunAkhir);

    $('#RegionalId').val(id);
    $('#regional-table-container').empty();

    // Isi row existing atau satu row kosong
    if (isEdit && regionalIds) {
        regionalIds.toString().split(',').forEach(rid => {
            if (!rid.trim()) return;
            $('#regional-table-container').append(`
                <div class="form-group regional-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control regional-select" name="IdIsuRegional[]" required data-selected-id="${rid.trim()}">
                                <option value="">-- Pilih Isu Regional --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="button" class="btn btn-danger btn-remove-row">
                                <i class="notika-icon notika-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        });
    } else {
        $('#regional-table-container').append(`
            <div class="form-group regional-row">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control regional-select" name="IdIsuRegional[]" required>
                            <option value="">-- Pilih Isu Regional --</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top:25px;">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `);
    }

    // Load dropdown awal jika tahun tersedia
    if (tahunMulai && tahunAkhir) {
        loadRegionalForModal(tahunMulai, tahunAkhir);
    } else {
        console.warn("Tahun Mulai/Akhir tidak ditemukan saat buka modal Regional");
        $('.regional-select').html('<option value="">-- Pilih Isu Regional --</option>');
    }

    $('#ModalTambahRegional').modal('show');
});

// Tambah row baru di modal Regional
$(document).on('click', '.btn-add-regional-row', function() {
    $('#regional-table-container').append(`
        <div class="form-group regional-row">
            <div class="row">
                <div class="col-md-10">
                    <select class="form-control regional-select" name="IdIsuRegional[]" required>
                        <option value="">-- Pilih Isu Regional --</option>
                    </select>
                </div>
                <div class="col-md-2" style="padding-top:25px;">
                    <button type="button" class="btn btn-danger btn-remove-row">
                        <i class="notika-icon notika-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `);

    // Ambil tahun dari data modal (lebih aman daripada ambil dari tombol)
    const tahunMulai = $('#ModalTambahRegional').data('tahunmulai') || '';
    const tahunAkhir = $('#ModalTambahRegional').data('tahunakhir') || '';

    if (tahunMulai && tahunAkhir) {
        loadRegionalForModal(tahunMulai, tahunAkhir);
    } else {
        // Jika tidak ada tahun → minimal beri option default
        $('#regional-table-container .regional-select').last()
            .html('<option value="">-- Pilih Isu Regional --</option>');
    }
});

// Submit form Regional
$("#FormTambahRegional").submit(function(e) {
    e.preventDefault();

    $.post(BaseURL + "Kementerian/UpdateIsuRegionalForStrategis", $(this).serialize())
        .done(res => {
            if (res.trim() === '1') {
                location.reload();
            } else {
                alert(res || 'Gagal menyimpan data');
            }
        })
        .fail(() => {
            alert('Gagal menghubungi server. Periksa koneksi.');
        });
});

// =============================================================
// Fungsi load dropdown Regional (khusus modal tambah/edit regional)
// =============================================================
function loadRegionalForModal(tahunMulai, tahunAkhir) {
    if (!tahunMulai || !tahunAkhir) {
        $('.regional-select').html('<option value="">-- Periode tidak valid --</option>');
        return;
    }

    $.post(BaseURL + "Kementerian/GetIsuByPeriode", {
        TahunMulai: tahunMulai,
        TahunAkhir: tahunAkhir,
        Jenis: 'Regional',
        IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
    })
    .done(data => {
        $('.regional-select').each(function() {
            const selectedId = $(this).data('selected-id') || '';
            populateDropdown($(this), data, selectedId ? [selectedId] : [], '-- Pilih Isu Regional --');
        });
    })
    .fail(() => {
        $('.regional-select').html('<option value="">-- Gagal memuat data --</option>');
    });
}
// ======================================================
// NASIONAL
// ======================================================
$(document).on('click', '.TambahNasional, .EditNasional', function() {

    let isEdit = $(this).hasClass('EditNasional');
    let id = $(this).data('id');
    let nasionalIds = isEdit ? $(this).data('nasional') : '';
    let TahunMulai = $(this).data('tahunmulai');
    let TahunAkhir = $(this).data('tahunakhir');

    $('#NasionalId').val(id);
    $('#nasional-table-container').empty();

    if (isEdit && nasionalIds) {

        nasionalIds.toString().split(',').forEach(function(nid){
            if(!nid.trim()) return;

            $('#nasional-table-container').append(`
                <div class="form-group nasional-row">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-control nasional-select" name="IdIsuNasional[]" data-selected-id="${nid.trim()}" required>
                                <option value="">-- Pilih Isu Nasional --</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="button" class="btn btn-danger btn-remove-row">
                                <i class="notika-icon notika-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        });

    } else {

        $('#nasional-table-container').append(`
            <div class="form-group nasional-row">
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control nasional-select" name="IdIsuNasional[]" required>
                            <option value="">-- Pilih Isu Nasional --</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top:25px;">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="notika-icon notika-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `);
    }

    // load nasional
    $.post(BaseURL + "Kementerian/GetIsuByPeriode", {
        TahunMulai,
        TahunAkhir,
        Jenis:'Nasional',
        IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
    }).done(data=>{
        $('#nasional-table-container .nasional-select').each(function(){
            let selectedId=$(this).data('selected-id')||'';
            populateDropdown($(this),data,selectedId?[selectedId]:[],'-- Pilih Isu Nasional --');
        });
    });

    $('#ModalTambahNasional').modal('show');
});


// tambah row nasional
$(document).on('click','.btn-add-nasional-row',function(){

    $('#nasional-table-container').append(`
        <div class="form-group nasional-row">
            <div class="row">
                <div class="col-md-10">
                    <select class="form-control nasional-select" name="IdIsuNasional[]" required>
                        <option value="">-- Pilih Isu Nasional --</option>
                    </select>
                </div>
                <div class="col-md-2" style="padding-top:25px;">
                    <button type="button" class="btn btn-danger btn-remove-row">
                        <i class="notika-icon notika-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `);

    $('.TambahNasional, .EditNasional').first().click();
});


// submit nasional
$("#FormTambahNasional").submit(function(e){
    e.preventDefault();

    $.post(BaseURL+"Kementerian/UpdateIsuNasionalForStrategis",$(this).serialize())
    .done(res=>{
        if(res.trim()==='1') location.reload();
        else alert(res);
    })
    .fail(()=>alert('Gagal menghubungi server.'));
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
            if (id.trim()) {
                var newRow = `
                    <div class="form-group permasalahan-row">
                        <div class="row">
                            <div class="col-md-10">
                                <select class="form-control permasalahan-select" name="IdPermasalahanPokok[]" required data-selected-id="${id.trim()}">
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

    // Load data dropdown setelah row dibuat (tanpa JSON.parse)
    if (TahunMulai && TahunAkhir) {
        $.post(BaseURL + "Kementerian/GetPermasalahanByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
        }).done(data => {
            console.log("[Raw Permasalahan Modal]:", data);  // ← DEBUG
            console.log("[Permasalahan Modal] Jumlah data:", data?.length || 0);

            $('.permasalahan-select').each(function() {
                var selectedId = $(this).data('selected-id') || '';
                populateDropdown($(this), data, selectedId ? [selectedId] : [], '-- Pilih Permasalahan Pokok --');
            });
        }).fail(function() {
            console.error("[Permasalahan Modal] AJAX gagal");
            $('.permasalahan-select').html('<option value="">-- Pilih Permasalahan Pokok --</option>');
        });
    }

    $('#ModalTambahPermasalahan').modal('show');
});

// Handle Add Permasalahan Row (reload hanya untuk select baru)
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

    // Reload options untuk select terakhir saja
    var TahunMulai = $('.TambahPermasalahan').data('tahunmulai') || $('.EditPermasalahan').data('tahunmulai');
    var TahunAkhir = $('.TambahPermasalahan').data('tahunakhir') || $('.EditPermasalahan').data('tahunakhir');

    if (TahunMulai && TahunAkhir) {
        $.post(BaseURL + "Kementerian/GetPermasalahanByPeriode", { 
            TahunMulai: TahunMulai, 
            TahunAkhir: TahunAkhir,
            IdKementerian: USER_LEVEL == 1 ? USER_KEMENTERIAN : ''
        }).done(data => {
            console.log("[Raw Permasalahan Tambah Row]:", data);
            console.log("[Permasalahan Tambah Row] Jumlah data:", data?.length || 0);

            var lastSelect = $('#permasalahan-table-container .permasalahan-select').last();
            lastSelect.html('<option value="">-- Pilih Permasalahan Pokok --</option>');
            if (data && data.length > 0) {
                $.each(data, function(index, item) {
                    lastSelect.append('<option value="' + item.Id + '">' + (item.NamaPermasalahanPokok || '-') + '</option>');
                });
            }
        }).fail(function() {
            $('#permasalahan-table-container .permasalahan-select').last().html('<option value="">-- Pilih Permasalahan Pokok --</option>');
        });
    }
});

// Submit Form Tambah Permasalahan (sudah benar, tidak perlu diubah)
$("#FormTambahPermasalahan").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    
    $.post(BaseURL + "Kementerian/UpdatePermasalahanForStrategis", formData)
        .done(function(Respon) {
    if (Respon.trim() === '1') {
        window.location.reload();  // berhasil → reload langsung, tanpa alert
    } else {
        alert(Respon || 'Terjadi kesalahan pada server');
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
            $.post(BaseURL + "Kementerian/GetIsuByIds", { 
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
            $.post(BaseURL + "Kementerian/GetIsuByIds", { 
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
            $.post(BaseURL + "Kementerian/GetIsuByIds", { 
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
// Handle Detail Isu Regional
$(document).on('click', '.DetailRegional', function() {
    var id = $(this).data('id');
    var regionalIds = $(this).data('regional');
    var TahunMulai = $(this).data('tahunmulai');
    var TahunAkhir = $(this).data('tahunakhir');
    
    if (regionalIds) {
        $.post(BaseURL + "Kementerian/GetIsuByIds", { 
            Ids: regionalIds,
            Jenis: 'Regional',
            TahunMulai: TahunMulai,
            TahunAkhir: TahunAkhir
        }, function(data) {
            try {
                var isuData = JSON.parse(data);
                var listItems = '';
                if (isuData && isuData.length > 0) {
                    $.each(isuData, function(index, item) {
                        listItems += '<li class="list-group-item">' + (item.NamaIsuRegional || '-') + '</li>';
                    });
                } else {
                    listItems = '<li class="list-group-item">Tidak ada data isu Regional</li>';
                }
                $('#regional-detail-container .list-group').html(listItems);
                $('#ModalDetailRegional').modal('show');
            } catch(e) {
                console.error("Error parsing Isu Regional data:", e);
                $('#regional-detail-container .list-group').html('<li class="list-group-item">Gagal memuat data</li>');
                $('#ModalDetailRegional').modal('show');
            }
        }).fail(function() {
            $('#regional-detail-container .list-group').html('<li class="list-group-item">Gagal menghubungi server</li>');
            $('#ModalDetailRegional').modal('show');
        });
    } else {
        $('#regional-detail-container .list-group').html('<li class="list-group-item">Tidak ada data isu Regional</li>');
        $('#ModalDetailRegional').modal('show');
    }
});
    // Handle Detail Permasalahan Pokok
    $(document).on('click', '.DetailPermasalahan', function() {
        var id = $(this).data('id');
        var permasalahanIds = $(this).data('permasalahan');
        var TahunMulai = $(this).data('tahunmulai');
        var TahunAkhir = $(this).data('tahunakhir');
        
        if (permasalahanIds) {
            $.post(BaseURL + "Kementerian/GetPermasalahanByIds", { 
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

    // Initialize filter state on page load
    $(document).ready(function() {
        <?php if ($CurrentPeriode): ?>
            loadKementerianForFilter('<?= $CurrentPeriode ?>', $("#FilterKementerianSelect"), '<?= $CurrentKementerian ?>');
        <?php endif; ?>
    });
});
</script>