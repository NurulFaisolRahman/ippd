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
        width: 650px;
        max-width: 95%;
    }

    /* CSS Card Container */
    .data-table-list {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        padding: 25px;
        border: none;
        margin-bottom: 30px;
    }

    /* CSS Table Eksak Sesuai Gambar Lampiran */
    .table-iup-dokumen {
        border-collapse: collapse !important;
        width: 100%;
        border: 1.5px solid #dfa539 !important;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* Header styling eksak sesuai gambar: biru muda, teks hitam tebal */
    .table-iup-dokumen > thead > tr > th {
        background-color: #8cbfe4 !important;
        color: #000000 !important;
        font-weight: 700 !important;
        font-size: 13.5px !important;
        text-align: center !important;
        vertical-align: middle !important;
        border: 1px solid #dfa539 !important;
        padding: 8px 6px !important;
        line-height: 1.35;
    }

    /* Cell styling dengan border emas / kuning-oranye */
    .table-iup-dokumen > tbody > tr > td {
        border: 1px solid #dfa539 !important;
        color: #000000 !important;
        font-size: 13px !important;
        padding: 6px 8px !important;
        background-color: #ffffff;
        line-height: 1.4;
    }

    .table-iup-dokumen > tbody > tr:hover td {
        background-color: #fafcfe;
    }

    /* Tombol Aksi */
    .btn-action {
        border-radius: 4px;
        margin: 0;
        transition: all 0.2s ease;
        padding: 3px 8px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .btn-action-group {
        display: inline-flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 3px;
        white-space: nowrap;
    }

    .form-label-custom {
        font-size: 12px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 5px;
        display: block;
    }
</style>

<div class="data-table-area">
    <div class="container">
        
        <!-- Header Atas (Tombol Input Agenda Transformasi) -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="background: #ffffff; border-radius: 8px; padding: 18px 22px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                    <div>
                        <h2 style="margin: 0; color: #1e293b; font-weight: 700; font-size: 20px;">
                            <i class="fa fa-bullseye" style="color: #00c292; margin-right: 8px;"></i> Arah Pembangunan dan Indikator Utama Pembangunan (IUP) RPJPN
                        </h2>
                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                            Agenda Transformasi, Arah (Tujuan) Pembangunan, serta Indikator Utama Pembangunan (IUP) Indonesia Emas 2045
                        </p>
                    </div>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                    <div style="margin-top: 8px;">
                        <button type="button" class="btn btn-primary notika-btn-primary btn-action" data-toggle="modal" data-target="#ModalInputAgenda" style="padding: 7px 15px; font-size: 12px;">
                            <i class="fa fa-plus-circle"></i> <b>Input Agenda Transformasi</b>
                        </button>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Tabel Sesuai Format Dokumen Lampiran -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                        <div style="font-size: 13px; font-weight: 600; color: #475569;">
                            <i class="fa fa-table" style="color: #00c292; margin-right: 5px;"></i> Matriks Arah Pembangunan dan Indikator Utama Pembangunan (IUP)
                        </div>
                        <div style="width: 260px; max-width: 100%;">
                            <input type="text" id="SearchInput" class="form-control" placeholder="Cari data pada tabel..." style="border-radius: 4px; padding: 5px 12px; font-size: 12px; border: 1px solid #cbd5e1; height: 32px;">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="TableArahIUP" class="table table-bordered table-iup-dokumen">
                            <thead>
                                <tr>
                                    <th style="width: 17%; text-align: center; vertical-align: middle;">Agenda Transformasi</th>
                                    <th colspan="2" style="width: 25%; text-align: center; vertical-align: middle;">Arah (Tujuan) Pembangunan</th>
                                    <th colspan="2" style="width: 32%; text-align: center; vertical-align: middle;">Indikator Pembangunan Utama (IUP)</th>
                                    <th style="width: 10%; text-align: center; vertical-align: middle;">Satuan</th>
                                    <th style="width: 8%; text-align: center; vertical-align: middle;">Baseline<br>2025*</th>
                                    <th style="width: 8%; text-align: center; vertical-align: middle;">Sasaran<br>2045</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                                    <th style="width: 7%; text-align: center; vertical-align: middle;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Grouping Tujuan berdasarkan IdAgenda / AgendaTransformasi
                                $tujuanByAgendaId = [];
                                if (isset($Tujuan) && !empty($Tujuan)) {
                                    foreach ($Tujuan as $t) {
                                        $agendaKey = !empty($t['IdAgenda']) ? $t['IdAgenda'] : (!empty($t['AgendaTransformasi']) ? trim($t['AgendaTransformasi']) : 0);
                                        $tujuanByAgendaId[$agendaKey][] = $t;
                                    }
                                }

                                // Grouping IUP berdasarkan Tujuan (_Id)
                                $iupByTujuan = [];
                                if (isset($IUP) && !empty($IUP)) {
                                    foreach ($IUP as $i) {
                                        $iupByTujuan[$i['_Id']][] = $i;
                                    }
                                }

                                $hasAdmin = (isset($_SESSION['Level']) && $_SESSION['Level'] == 0);

                                if (isset($Agenda) && !empty($Agenda)) {
                                    foreach ($Agenda as $agenda) {
                                        $idAgenda = $agenda['Id'];
                                        $namaAgenda = $agenda['NamaAgenda'];

                                        // Ambil daftar Arah Pembangunan untuk Agenda ini
                                        $tujuanList = isset($tujuanByAgendaId[$idAgenda]) ? $tujuanByAgendaId[$idAgenda] : (isset($tujuanByAgendaId[$namaAgenda]) ? $tujuanByAgendaId[$namaAgenda] : []);

                                        // Hitung total baris untuk Agenda Transformasi ini
                                        $agendaRowspan = 0;
                                        if (!empty($tujuanList)) {
                                            foreach ($tujuanList as $t) {
                                                $allArahIup = isset($iupByTujuan[$t['Id']]) ? $iupByTujuan[$t['Id']] : [];
                                                $agendaRowspan += max(1, count($allArahIup));
                                            }
                                        } else {
                                            $agendaRowspan = 1;
                                        }

                                        $isFirstAgendaRow = true;

                                        if (!empty($tujuanList)) {
                                            foreach ($tujuanList as $tujuan) {
                                                $idTujuan = $tujuan['Id'];
                                                $allArahIup = isset($iupByTujuan[$idTujuan]) ? $iupByTujuan[$idTujuan] : [];

                                                // Pisahkan parent (Indikator Utama) dan children (Sub Indikator)
                                                $parents = [];
                                                $childrenByParent = [];
                                                foreach ($allArahIup as $item) {
                                                    if (!empty($item['ParentId']) && $item['ParentId'] > 0) {
                                                        $childrenByParent[$item['ParentId']][] = $item;
                                                    } else {
                                                        $parents[] = $item;
                                                    }
                                                }

                                                // Susun daftar terurut: Indikator Utama -> Sub Indikator langsung di bawahnya
                                                $orderedIupList = [];
                                                foreach ($parents as $p) {
                                                    $p['IsSub'] = false;
                                                    $orderedIupList[] = $p;
                                                    if (isset($childrenByParent[$p['Id']])) {
                                                        foreach ($childrenByParent[$p['Id']] as $child) {
                                                            $child['IsSub'] = true;
                                                            $orderedIupList[] = $child;
                                                        }
                                                    }
                                                }
                                                // Tambahkan jika ada sub indikator tanpa parent yang cocok
                                                foreach ($childrenByParent as $pId => $children) {
                                                    $parentFound = false;
                                                    foreach ($parents as $p) {
                                                        if ($p['Id'] == $pId) { $parentFound = true; break; }
                                                    }
                                                    if (!$parentFound) {
                                                        foreach ($children as $c) {
                                                            $c['IsSub'] = true;
                                                            $orderedIupList[] = $c;
                                                        }
                                                    }
                                                }

                                                $tujuanRowspan = max(1, count($orderedIupList));
                                                $isFirstTujuanRow = true;

                                                // Kode Arah (IE 1, IE 2, dst)
                                                $kodeArah = !empty($tujuan['Kode']) ? $tujuan['Kode'] : ('IE ' . $tujuan['Id']);

                                                if (!empty($orderedIupList)) {
                                                    foreach ($orderedIupList as $iup) {
                                                        $isSub = $iup['IsSub'] ?? false;
                                                        $valBaseline = !empty($iup['Baseline']) ? $iup['Baseline'] : '';
                                                        $valSasaran = !empty($iup['Sasaran']) ? $iup['Sasaran'] : (!empty($iup['TargetAkhir']) ? $iup['TargetAkhir'] : '');
                                ?>
                                    <tr class="row-data">
                                        <!-- 1. Agenda Transformasi (Rowspan) + Tombol Tambah Arah -->
                                        <?php if ($isFirstAgendaRow) { ?>
                                        <td rowspan="<?= $agendaRowspan ?>" style="vertical-align: top; font-weight: 500;">
                                            <div style="font-weight: 600; color: #000000;">
                                                <?= htmlspecialchars($namaAgenda) ?>
                                            </div>
                                            <?php if ($hasAdmin) { ?>
                                            <div style="margin-top: 8px; display: flex; gap: 3px; flex-wrap: wrap;">
                                                <!-- Tombol Tambah Arah Pembangunan untuk Agenda ini -->
                                                <button type="button" class="btn btn-xs btn-primary btn-action BtnTambahArahRow" 
                                                        data-idagenda="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        title="Tambah Arah Pembangunan pada Agenda ini">
                                                    <i class="fa fa-plus"></i> Arah
                                                </button>
                                                <button type="button" class="btn btn-xs btn-info btn-action BtnEditAgenda" 
                                                        data-id="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        title="Edit Agenda Transformasi">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger btn-action BtnHapusAgenda" 
                                                        data-id="<?= $idAgenda ?>" 
                                                        title="Hapus Agenda Transformasi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <?php $isFirstAgendaRow = false; } ?>

                                        <!-- 2. Arah (Tujuan) Pembangunan: Kode (IE 1) & Nama + Tombol Input IUP (Rowspan) -->
                                        <?php if ($isFirstTujuanRow) { ?>
                                        <td rowspan="<?= $tujuanRowspan ?>" style="width: 4.5%; text-align: center; vertical-align: top; white-space: nowrap; font-weight: 500;">
                                            <?= htmlspecialchars($kodeArah) ?>
                                        </td>
                                        <td rowspan="<?= $tujuanRowspan ?>" style="vertical-align: top;">
                                            <div style="font-weight: 500; color: #000000;">
                                                <?= htmlspecialchars($tujuan['Tujuan']) ?>
                                            </div>
                                            <?php if ($hasAdmin) { ?>
                                            <div style="margin-top: 6px; display: flex; gap: 4px; flex-wrap: wrap;">
                                                <!-- Tombol Input IUP Hanya di Kolom Arah Pembangunan -->
                                                <button type="button" class="btn btn-xs btn-success btn-action BtnTambahIUPRow" 
                                                        data-idarah="<?= $tujuan['Id'] ?>" 
                                                        data-arah="<?= htmlspecialchars($tujuan['Tujuan'], ENT_QUOTES) ?>" 
                                                        title="Input IUP pada Arah ini">
                                                    <i class="fa fa-plus"></i> IUP
                                                </button>
                                                <button type="button" class="btn btn-xs btn-info btn-action BtnEditArah" 
                                                        data-id="<?= $tujuan['Id'] ?>" 
                                                        data-idagenda="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        data-kode="<?= htmlspecialchars($kodeArah, ENT_QUOTES) ?>" 
                                                        data-arah="<?= htmlspecialchars($tujuan['Tujuan'], ENT_QUOTES) ?>" 
                                                        title="Edit Arah Pembangunan">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger btn-action BtnHapusArah" 
                                                        data-id="<?= $tujuan['Id'] ?>" 
                                                        title="Hapus Arah Pembangunan">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <?php $isFirstTujuanRow = false; } ?>

                                        <!-- 3. Indikator Pembangunan Utama (IUP): Kode/No & Uraian -->
                                        <td style="width: 3.5%; text-align: center; vertical-align: middle; white-space: nowrap;">
                                            <?= htmlspecialchars($iup['Kode'] ?? '') ?>
                                        </td>
                                        <td style="vertical-align: middle; <?= ($isSub ? 'padding-left: 20px !important;' : '') ?>">
                                            <?= htmlspecialchars($iup['IUP']) ?>
                                        </td>

                                        <!-- 4. Satuan -->
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= htmlspecialchars($iup['Satuan'] ?? '') ?>
                                        </td>

                                        <!-- 5. Baseline 2025* -->
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= htmlspecialchars($valBaseline) ?>
                                        </td>

                                        <!-- 6. Sasaran 2045 -->
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= htmlspecialchars($valSasaran) ?>
                                        </td>

                                        <!-- 7. Aksi IUP (Tambah Sub Indikator hanya pada Indikator Utama) -->
                                        <?php if ($hasAdmin) { ?>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <div class="btn-action-group">
                                                <?php if (!$isSub) { ?>
                                                <!-- Tombol Tambah Sub Indikator berada di Aksi Indikator -->
                                                <button type="button" class="btn btn-xs btn-success btn-action BtnTambahSubIUP" 
                                                        data-idparent="<?= $iup['Id'] ?>" 
                                                        data-idarah="<?= $tujuan['Id'] ?>" 
                                                        data-parentnama="<?= htmlspecialchars($iup['IUP'], ENT_QUOTES) ?>" 
                                                        title="Tambah Sub Indikator">
                                                    <i class="fa fa-plus"></i> Sub
                                                </button>
                                                <?php } ?>
                                                <button type="button" class="btn btn-xs btn-info btn-action BtnEditIUP" 
                                                        data-id="<?= $iup['Id'] ?>" 
                                                        data-idarah="<?= $tujuan['Id'] ?>" 
                                                        data-issub="<?= $isSub ? '1' : '0' ?>" 
                                                        data-kode="<?= htmlspecialchars($iup['Kode'] ?? '', ENT_QUOTES) ?>" 
                                                        data-iup="<?= htmlspecialchars($iup['IUP'], ENT_QUOTES) ?>" 
                                                        data-satuan="<?= htmlspecialchars($iup['Satuan'] ?? '', ENT_QUOTES) ?>" 
                                                        data-baseline="<?= htmlspecialchars($valBaseline, ENT_QUOTES) ?>" 
                                                        data-sasaran="<?= htmlspecialchars($valSasaran, ENT_QUOTES) ?>" 
                                                        title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger btn-action BtnHapusIUP" 
                                                        data-id="<?= $iup['Id'] ?>" 
                                                        title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php 
                                                    } // End foreach orderedIupList
                                                } else { 
                                                    // Jika Tujuan belum memiliki IUP
                                ?>
                                    <tr class="row-data">
                                        <!-- Agenda Transformasi (Rowspan) -->
                                        <?php if ($isFirstAgendaRow) { ?>
                                        <td rowspan="<?= $agendaRowspan ?>" style="vertical-align: top; font-weight: 500;">
                                            <div style="font-weight: 600; color: #000000;">
                                                <?= htmlspecialchars($namaAgenda) ?>
                                            </div>
                                            <?php if ($hasAdmin) { ?>
                                            <div style="margin-top: 8px; display: flex; gap: 3px; flex-wrap: wrap;">
                                                <button type="button" class="btn btn-xs btn-primary btn-action BtnTambahArahRow" 
                                                        data-idagenda="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        title="Tambah Arah Pembangunan pada Agenda ini">
                                                    <i class="fa fa-plus"></i> Arah
                                                </button>
                                                <button type="button" class="btn btn-xs btn-info btn-action BtnEditAgenda" 
                                                        data-id="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        title="Edit Agenda Transformasi">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger btn-action BtnHapusAgenda" 
                                                        data-id="<?= $idAgenda ?>" 
                                                        title="Hapus Agenda Transformasi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <?php $isFirstAgendaRow = false; } ?>

                                        <!-- Arah Pembangunan -->
                                        <td style="width: 4.5%; text-align: center; vertical-align: top; white-space: nowrap; font-weight: 500;">
                                            <?= htmlspecialchars($kodeArah) ?>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <div style="font-weight: 500; color: #000000;">
                                                <?= htmlspecialchars($tujuan['Tujuan']) ?>
                                            </div>
                                            <?php if ($hasAdmin) { ?>
                                            <div style="margin-top: 6px; display: flex; gap: 4px; flex-wrap: wrap;">
                                                <button type="button" class="btn btn-xs btn-success btn-action BtnTambahIUPRow" 
                                                        data-idarah="<?= $tujuan['Id'] ?>" 
                                                        data-arah="<?= htmlspecialchars($tujuan['Tujuan'], ENT_QUOTES) ?>" 
                                                        title="Input IUP pada Arah ini">
                                                    <i class="fa fa-plus"></i> IUP
                                                </button>
                                                <button type="button" class="btn btn-xs btn-info btn-action BtnEditArah" 
                                                        data-id="<?= $tujuan['Id'] ?>" 
                                                        data-idagenda="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        data-kode="<?= htmlspecialchars($kodeArah, ENT_QUOTES) ?>" 
                                                        data-arah="<?= htmlspecialchars($tujuan['Tujuan'], ENT_QUOTES) ?>" 
                                                        title="Edit Arah Pembangunan">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger btn-action BtnHapusArah" 
                                                        data-id="<?= $tujuan['Id'] ?>" 
                                                        title="Hapus Arah Pembangunan">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <?php } ?>
                                        </td>

                                        <!-- IUP Kosong -->
                                        <td></td>
                                        <td style="color: #94a3b8; font-style: italic; font-size: 12px;">
                                            Belum ada Indikator Utama Pembangunan (IUP)
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <?php if ($hasAdmin) { ?>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button type="button" class="btn btn-xs btn-success btn-action BtnTambahIUPRow" 
                                                    data-idarah="<?= $tujuan['Id'] ?>" 
                                                    data-arah="<?= htmlspecialchars($tujuan['Tujuan'], ENT_QUOTES) ?>" 
                                                    title="Input IUP">
                                                <i class="fa fa-plus"></i> IUP
                                            </button>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php 
                                            } // End else orderedIupList empty
                                        } // End foreach tujuanList
                                    } else { 
                                        // Agenda belum memiliki Arah Pembangunan sama sekali
                                ?>
                                    <tr class="row-data">
                                        <td style="vertical-align: top; font-weight: 500;">
                                            <div style="font-weight: 600; color: #000000;">
                                                <?= htmlspecialchars($namaAgenda) ?>
                                            </div>
                                            <?php if ($hasAdmin) { ?>
                                            <div style="margin-top: 8px; display: flex; gap: 3px; flex-wrap: wrap;">
                                                <button type="button" class="btn btn-xs btn-primary btn-action BtnTambahArahRow" 
                                                        data-idagenda="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        title="Tambah Arah Pembangunan pada Agenda ini">
                                                    <i class="fa fa-plus"></i> Arah
                                                </button>
                                                <button type="button" class="btn btn-xs btn-info btn-action BtnEditAgenda" 
                                                        data-id="<?= $idAgenda ?>" 
                                                        data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                        title="Edit Agenda Transformasi">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger btn-action BtnHapusAgenda" 
                                                        data-id="<?= $idAgenda ?>" 
                                                        title="Hapus Agenda Transformasi">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td colspan="2" style="color: #94a3b8; font-style: italic; font-size: 12px; vertical-align: top;">
                                            Belum ada Arah (Tujuan) Pembangunan
                                        </td>
                                        <td></td>
                                        <td style="color: #94a3b8; font-style: italic; font-size: 12px; vertical-align: top;">-</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <?php if ($hasAdmin) { ?>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button type="button" class="btn btn-xs btn-primary btn-action BtnTambahArahRow" 
                                                    data-idagenda="<?= $idAgenda ?>" 
                                                    data-namaagenda="<?= htmlspecialchars($namaAgenda, ENT_QUOTES) ?>" 
                                                    title="Tambah Arah">
                                                <i class="fa fa-plus"></i> Arah
                                            </button>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php 
                                    } // End else tujuanList empty
                                    } // End foreach Agenda
                                } else { 
                                ?>
                                    <tr>
                                        <td colspan="<?= $hasAdmin ? 9 : 8 ?>" class="text-center" style="padding: 25px; color: #94a3b8;">
                                            Belum ada data Agenda Transformasi / Arah Pembangunan.
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

<!-- ============================================== -->
<!-- 1. MODAL INPUT AGENDA TRANSFORMASI (INPUT MANUAL) -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputAgenda" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-plus-circle" style="color: #03a9f4; margin-right: 5px;"></i> Tambah Agenda Transformasi</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Nama Agenda Transformasi <span style="color: red;">*</span> (Input Manual)</label>
                            <input type="text" class="form-control" id="InputNamaAgenda" placeholder="Contoh: Transformasi Sosial">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 10px;">
                <button type="button" class="btn btn-primary btn-action" id="BtnSimpanAgenda"><i class="fa fa-save"></i> Simpan Agenda</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT AGENDA TRANSFORMASI -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditAgenda" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-edit" style="color: #03a9f4; margin-right: 5px;"></i> Edit Agenda Transformasi</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="EditIdAgenda">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Nama Agenda Transformasi <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="EditNamaAgenda">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 10px;">
                <button type="button" class="btn btn-info btn-action" id="BtnUpdateAgenda"><i class="fa fa-save"></i> Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- 2. MODAL INPUT ARAH (TUJUAN) PEMBANGUNAN -->
<!-- Terpisah untuk 1 Agenda Transformasi bisa banyak Arah -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputArah" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-plus-circle" style="color: #03a9f4; margin-right: 5px;"></i> Tambah Arah (Tujuan) Pembangunan</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="InputArahIdAgenda">
                <input type="hidden" id="InputArahNamaAgenda">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Agenda Transformasi</label>
                            <input type="text" class="form-control" id="InputArahAgendaDisplay" readonly style="background-color: #f8fafc; font-weight: 600;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Kode Arah</label>
                            <input type="text" class="form-control" id="InputArahKode" placeholder="Contoh: IE 1, IE 2">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Arah (Tujuan) Pembangunan <span style="color: red;">*</span></label>
                            <textarea class="form-control" id="InputArahTujuan" rows="2" style="resize: vertical;" placeholder="Contoh: Kesehatan untuk Semua"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 10px;">
                <button type="button" class="btn btn-primary btn-action" id="BtnSimpanArah"><i class="fa fa-save"></i> Simpan Arah Pembangunan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL EDIT ARAH PEMBANGUNAN -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditArah" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-edit" style="color: #03a9f4; margin-right: 5px;"></i> Edit Arah (Tujuan) Pembangunan</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="EditIdArahTujuan">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Agenda Transformasi</label>
                            <input type="text" class="form-control" id="EditArahAgendaDisplay" readonly style="background-color: #f8fafc; font-weight: 600;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Kode Arah</label>
                            <input type="text" class="form-control" id="EditArahKode" placeholder="Contoh: IE 1">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Arah (Tujuan) Pembangunan <span style="color: red;">*</span></label>
                            <textarea class="form-control" id="EditArahTujuan" rows="2" style="resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 10px;">
                <button type="button" class="btn btn-info btn-action" id="BtnUpdateArah"><i class="fa fa-save"></i> Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- 3. MODAL INPUT IUP (DARI KOLOM ARAH PEMBANGUNAN) -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputIUP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-plus-circle" style="color: #00c292; margin-right: 5px;"></i> Tambah Indikator Utama (IUP)</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="InputIdArah">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Arah (Tujuan) Pembangunan</label>
                            <input type="text" class="form-control" id="InputArahNamaDisplay" readonly style="background-color: #f8fafc; font-weight: 600;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Nomor / Kode</label>
                            <input type="text" class="form-control" id="InputKode" placeholder="Contoh: 1, 2, 3">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Satuan</label>
                            <input type="text" class="form-control" id="InputSatuan" placeholder="Contoh: tahun, %, Nilai">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Indikator Pembangunan Utama (IUP) <span style="color: red;">*</span></label>
                            <textarea class="form-control" id="InputIUP" rows="2" style="resize: vertical;" placeholder="Contoh: Usia Harapan Hidup (UHH) atau Kesehatan ibu dan anak:"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Baseline 2025*</label>
                            <input type="text" class="form-control" id="InputBaseline" placeholder="Contoh: 74,4">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Sasaran 2045</label>
                            <input type="text" class="form-control" id="InputSasaran" placeholder="Contoh: 80,0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 10px;">
                <button type="button" class="btn btn-success btn-action" id="BtnSimpanIUP"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- 4. MODAL INPUT SUB INDIKATOR -->
<!-- Berada di Tombol Aksi Indikator (Tidak ada rincian) -->
<!-- ============================================== -->
<div class="modal fade" id="ModalInputSubIUP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-plus-circle" style="color: #00c292; margin-right: 5px;"></i> Tambah Sub Indikator</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="InputSubParentId">
                <input type="hidden" id="InputSubIdArah">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Indikator Induk</label>
                            <input type="text" class="form-control" id="InputSubParentDisplay" readonly style="background-color: #f8fafc; font-weight: 600;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Huruf / Kode</label>
                            <input type="text" class="form-control" id="InputSubKode" placeholder="Contoh: a), b)">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Satuan</label>
                            <input type="text" class="form-control" id="InputSubSatuan" placeholder="Contoh: per 100.000 kelahiran hidup, %">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Sub Indikator IUP <span style="color: red;">*</span></label>
                            <textarea class="form-control" id="InputSubIUP" rows="2" style="resize: vertical;" placeholder="Contoh: Angka Kematian Ibu atau Prevalensi Stunting..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Baseline 2025*</label>
                            <input type="text" class="form-control" id="InputSubBaseline" placeholder="Contoh: 122">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Sasaran 2045</label>
                            <input type="text" class="form-control" id="InputSubSasaran" placeholder="Contoh: 16">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 10px;">
                <button type="button" class="btn btn-success btn-action" id="BtnSimpanSubIUP"><i class="fa fa-save"></i> Simpan Sub Indikator</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- 5. MODAL EDIT IUP / SUB INDIKATOR -->
<!-- ============================================== -->
<div class="modal fade" id="ModalEditIUP" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 id="ModalEditTitle"><i class="fa fa-edit" style="color: #00c292; margin-right: 5px;"></i> Edit Indikator</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="EditIdIUP">

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Nomor / Kode</label>
                            <input type="text" class="form-control" id="EditKode" placeholder="Contoh: 1, a)">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Satuan</label>
                            <input type="text" class="form-control" id="EditSatuan" placeholder="Contoh: %, tahun, Nilai">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Uraian Indikator <span style="color: red;">*</span></label>
                            <textarea class="form-control" id="EditIUP" rows="2" style="resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Baseline 2025*</label>
                            <input type="text" class="form-control" id="EditBaseline">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label-custom">Sasaran 2045</label>
                            <input type="text" class="form-control" id="EditSasaran">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 10px;">
                <button type="button" class="btn btn-info btn-action" id="BtnUpdateIUP"><i class="fa fa-save"></i> Simpan Perubahan</button>
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
<script src="../js/main.js"></script>
<script>
    $(document).ready(function() {
        var BaseURL = '<?= base_url() ?>';

        // ==============================================
        // 1. LOGIKA AGENDA TRANSFORMASI (INPUT MANUAL)
        // ==============================================
        $('#BtnSimpanAgenda').click(function() {
            var nama = $('#InputNamaAgenda').val().trim();
            if (!nama) {
                alert('Mohon masukkan Nama Agenda Transformasi!');
                return;
            }

            $.post(BaseURL + 'Nasional/InputAgendaRPJPN', { NamaAgenda: nama }).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Terjadi kesalahan saat menyimpan Agenda Transformasi.');
            });
        });

        // Edit Agenda Transformasi
        $('.BtnEditAgenda').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('namaagenda');
            $('#EditIdAgenda').val(id);
            $('#EditNamaAgenda').val(nama);
            $('#ModalEditAgenda').modal('show');
        });

        $('#BtnUpdateAgenda').click(function() {
            var id = $('#EditIdAgenda').val();
            var nama = $('#EditNamaAgenda').val().trim();
            if (!nama) {
                alert('Mohon masukkan Nama Agenda Transformasi!');
                return;
            }

            $.post(BaseURL + 'Nasional/EditAgendaRPJPN', { Id: id, NamaAgenda: nama }).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Terjadi kesalahan saat mengupdate Agenda Transformasi.');
            });
        });

        // Hapus Agenda Transformasi
        $('.BtnHapusAgenda').click(function() {
            var id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus Agenda Transformasi ini?')) {
                $.post(BaseURL + 'Nasional/HapusAgendaRPJPN', { Id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert(res);
                    }
                }).fail(function() {
                    alert('Terjadi kesalahan saat menghapus Agenda Transformasi.');
                });
            }
        });

        // ==============================================
        // 2. LOGIKA ARAH PEMBANGUNAN (TERPISAH PER AGENDA)
        // ==============================================
        // Klik tombol "+ Arah" pada kolom Agenda Transformasi tertentu
        $('.BtnTambahArahRow').click(function() {
            var idAgenda = $(this).data('idagenda');
            var namaAgenda = $(this).data('namaagenda');

            $('#InputArahIdAgenda').val(idAgenda);
            $('#InputArahNamaAgenda').val(namaAgenda);
            $('#InputArahAgendaDisplay').val(namaAgenda);
            $('#InputArahKode').val('');
            $('#InputArahTujuan').val('');

            $('#ModalInputArah').modal('show');
        });

        // Simpan Arah Pembangunan
        $('#BtnSimpanArah').click(function() {
            var idAgenda = $('#InputArahIdAgenda').val();
            var namaAgenda = $('#InputArahNamaAgenda').val();
            var kode = $('#InputArahKode').val().trim();
            var tujuan = $('#InputArahTujuan').val().trim();

            if (!tujuan) {
                alert('Mohon masukkan Uraian Arah (Tujuan) Pembangunan!');
                return;
            }

            var postData = {
                IdAgenda: idAgenda,
                AgendaTransformasi: namaAgenda,
                Kode: kode,
                Tujuan: tujuan
            };

            $.post(BaseURL + 'Nasional/InputTujuanRPJPN', postData).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Terjadi kesalahan saat menyimpan Arah Pembangunan.');
            });
        });

        // Edit Arah Pembangunan
        $('.BtnEditArah').click(function() {
            var id = $(this).data('id');
            var namaAgenda = $(this).data('namaagenda');
            var kode = $(this).data('kode');
            var arah = $(this).data('arah');

            $('#EditIdArahTujuan').val(id);
            $('#EditArahAgendaDisplay').val(namaAgenda);
            $('#EditArahKode').val(kode);
            $('#EditArahTujuan').val(arah);

            $('#ModalEditArah').modal('show');
        });

        $('#BtnUpdateArah').click(function() {
            var id = $('#EditIdArahTujuan').val();
            var kode = $('#EditArahKode').val().trim();
            var tujuan = $('#EditArahTujuan').val().trim();

            if (!tujuan) {
                alert('Mohon masukkan Uraian Arah (Tujuan) Pembangunan!');
                return;
            }

            var postData = {
                Id: id,
                Kode: kode,
                Tujuan: tujuan
            };

            $.post(BaseURL + 'Nasional/EditTujuanRPJPN', postData).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Terjadi kesalahan saat mengupdate Arah Pembangunan.');
            });
        });

        // Hapus Arah Pembangunan
        $('.BtnHapusArah').click(function() {
            var id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus Arah (Tujuan) Pembangunan ini? Semua indikator di dalamnya akan terhapus.')) {
                $.post(BaseURL + 'Nasional/HapusTujuanRPJPN', { Id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert(res);
                    }
                }).fail(function() {
                    alert('Terjadi kesalahan saat menghapus Arah Pembangunan.');
                });
            }
        });

        // ==============================================
        // 3. LOGIKA INDIKATOR UTAMA (IUP)
        // Hanya di kolom Arah (Tujuan) Pembangunan
        // ==============================================
        $('.BtnTambahIUPRow').click(function() {
            var idArah = $(this).data('idarah');
            var arahNama = $(this).data('arah');

            $('#InputIdArah').val(idArah);
            $('#InputArahNamaDisplay').val(arahNama);
            $('#InputKode').val('');
            $('#InputIUP').val('');
            $('#InputSatuan').val('');
            $('#InputBaseline').val('');
            $('#InputSasaran').val('');

            $('#ModalInputIUP').modal('show');
        });

        $('#BtnSimpanIUP').click(function() {
            var idArah = $('#InputIdArah').val();
            var kode = $('#InputKode').val().trim();
            var iup = $('#InputIUP').val().trim();
            var satuan = $('#InputSatuan').val().trim();
            var baseline = $('#InputBaseline').val().trim();
            var sasaran = $('#InputSasaran').val().trim();

            if (!idArah) {
                alert('Arah Pembangunan tidak valid!');
                return;
            }
            if (!iup) {
                alert('Mohon masukkan Uraian Indikator Pembangunan Utama (IUP)!');
                return;
            }

            var postData = {
                _Id: idArah,
                ParentId: 0,
                Kode: kode,
                IUP: iup,
                Satuan: satuan,
                Baseline: baseline,
                Sasaran: sasaran
            };

            $.post(BaseURL + 'Nasional/InputIUPRPJPN', postData).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Terjadi kesalahan saat menyimpan data IUP.');
            });
        });

        // ==============================================
        // 4. LOGIKA SUB INDIKATOR
        // Berada di tombol aksi Indikator (Tidak ada rincian)
        // ==============================================
        $('.BtnTambahSubIUP').click(function() {
            var parentId = $(this).data('idparent');
            var idArah = $(this).data('idarah');
            var parentNama = $(this).data('parentnama');

            $('#InputSubParentId').val(parentId);
            $('#InputSubIdArah').val(idArah);
            $('#InputSubParentDisplay').val(parentNama);
            $('#InputSubKode').val('');
            $('#InputSubIUP').val('');
            $('#InputSubSatuan').val('');
            $('#InputSubBaseline').val('');
            $('#InputSubSasaran').val('');

            $('#ModalInputSubIUP').modal('show');
        });

        $('#BtnSimpanSubIUP').click(function() {
            var parentId = $('#InputSubParentId').val();
            var idArah = $('#InputSubIdArah').val();
            var kode = $('#InputSubKode').val().trim();
            var iup = $('#InputSubIUP').val().trim();
            var satuan = $('#InputSubSatuan').val().trim();
            var baseline = $('#InputSubBaseline').val().trim();
            var sasaran = $('#InputSubSasaran').val().trim();

            if (!iup) {
                alert('Mohon masukkan Uraian Sub Indikator!');
                return;
            }

            var postData = {
                _Id: idArah,
                ParentId: parentId,
                Kode: kode,
                IUP: iup,
                Satuan: satuan,
                Baseline: baseline,
                Sasaran: sasaran
            };

            $.post(BaseURL + 'Nasional/InputIUPRPJPN', postData).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Terjadi kesalahan saat menyimpan Sub Indikator.');
            });
        });

        // ==============================================
        // 5. EDIT IUP / SUB INDIKATOR
        // ==============================================
        $('.BtnEditIUP').click(function() {
            var id = $(this).data('id');
            var isSub = $(this).data('issub');
            var kode = $(this).data('kode');
            var iup = $(this).data('iup');
            var satuan = $(this).data('satuan');
            var baseline = $(this).data('baseline');
            var sasaran = $(this).data('sasaran');

            $('#EditIdIUP').val(id);
            $('#EditKode').val(kode);
            $('#EditIUP').val(iup);
            $('#EditSatuan').val(satuan);
            $('#EditBaseline').val(baseline);
            $('#EditSasaran').val(sasaran);

            if (isSub == '1') {
                $('#ModalEditTitle').html('<i class="fa fa-edit" style="color: #00c292; margin-right: 5px;"></i> Edit Sub Indikator');
            } else {
                $('#ModalEditTitle').html('<i class="fa fa-edit" style="color: #00c292; margin-right: 5px;"></i> Edit Indikator Utama');
            }

            $('#ModalEditIUP').modal('show');
        });

        $('#BtnUpdateIUP').click(function() {
            var id = $('#EditIdIUP').val();
            var kode = $('#EditKode').val().trim();
            var iup = $('#EditIUP').val().trim();
            var satuan = $('#EditSatuan').val().trim();
            var baseline = $('#EditBaseline').val().trim();
            var sasaran = $('#EditSasaran').val().trim();

            if (!iup) {
                alert('Mohon masukkan Uraian Indikator!');
                return;
            }

            var postData = {
                Id: id,
                Kode: kode,
                IUP: iup,
                Satuan: satuan,
                Baseline: baseline,
                Sasaran: sasaran
            };

            $.post(BaseURL + 'Nasional/EditIUPRPJPN', postData).done(function(res) {
                if (res == '1') {
                    window.location.reload();
                } else {
                    alert(res);
                }
            }).fail(function() {
                alert('Terjadi kesalahan saat mengupdate data.');
            });
        });

        // Hapus IUP / Sub Indikator
        $('.BtnHapusIUP').click(function() {
            var id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus indikator ini?')) {
                $.post(BaseURL + 'Nasional/HapusIUPRPJPN', { Id: id }).done(function(res) {
                    if (res == '1') {
                        window.location.reload();
                    } else {
                        alert(res);
                    }
                }).fail(function() {
                    alert('Terjadi kesalahan saat menghapus data.');
                });
            }
        });

        // LIVE SEARCH FITUR
        $('#SearchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            if (value === "") {
                $('.row-data').show();
            } else {
                $('.row-data').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    if (rowText.indexOf(value) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    });
</script>