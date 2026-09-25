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
        width: 700px;
        max-width: 95%;
    }
    .modal-header h2 {
        font-size: 18px;
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

    /* CSS Table Enhancement - Selaras dengan Halaman Lain (#f8f9fa / #455a64) */
    #agenda-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }
    #agenda-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border: 1px solid #e0e0e0;
        text-align: center;
        vertical-align: middle;
        padding: 10px 6px;
    }
    #agenda-table > thead > tr.th-sub > th {
        background-color: #f1f3f5;
        color: #546e7a;
        font-size: 10px;
        font-weight: 700;
        padding: 6px 4px;
        border: 1px solid #e0e0e0;
    }
    #agenda-table td {
        border: 1px solid #e9ecef;
        padding: 7px 8px;
        vertical-align: middle;
        color: #444;
    }

    /* Hover baris tabel */
    #agenda-table tbody tr:hover {
        background-color: #fbfcfd;
    }

    /* Styling Sel Sesuai Level */
    td.cell-pn {
        background-color: #f8fafc;
        border-left: 4px solid #00c292;
        font-weight: 700;
        vertical-align: top;
        color: #2c3e50;
    }
    td.cell-pp {
        background-color: #ffffff;
        border-left: 4px solid #03a9f4;
        font-weight: 600;
        vertical-align: top;
        color: #37474f;
    }
    td.cell-kp {
        background-color: #ffffff;
        border-left: 4px solid #ff9800;
        vertical-align: top;
        color: #455a64;
    }
    td.cell-sasaran {
        background-color: #ffffff;
        vertical-align: top;
        border-left: 3px solid #9c27b0;
        color: #333;
    }
    td.cell-ind {
        background-color: #ffffff;
        font-size: 11px;
        border-left: 3px solid #607d8b;
        color: #333;
    }
    td.cell-data {
        background-color: #ffffff;
        text-align: center;
        font-size: 11px;
    }
    td.cell-aksi {
        background-color: #fafbfc;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        border-left: 1px solid #e0e0e0;
    }

    /* Badges */
    .tipe-badge {
        display: inline-block;
        padding: 2px 7px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
        color: #fff;
        margin-right: 4px;
    }
    .tipe-PN { background-color: #00c292; }
    .tipe-PP { background-color: #03a9f4; }
    .tipe-KP { background-color: #ff9800; }

    .badge-agenda {
        background-color: #ede7f6;
        color: #512da8;
        border: 1px solid #d1c4e9;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-periode {
        background-color: #00c292;
        color: #ffffff;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        margin-left: 5px;
        display: inline-block;
    }
    .badge-satuan {
        background-color: #e1f5fe;
        color: #0277bd;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-target {
        background-color: #fff3e0;
        color: #e65100;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-baseline {
        background-color: #eceff1;
        color: #455a64;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
        display: inline-block;
    }

    /* Action Buttons */
    .btn-action {
        border-radius: 4px;
        padding: 3px 8px;
        font-size: 11px;
        font-weight: 600;
        margin: 1px;
        transition: all 0.2s ease;
        display: inline-block;
    }
    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
    }

    .nomor-cell {
        color: #555;
        font-weight: 700;
        font-size: 11px;
        min-width: 18px;
        display: inline-block;
    }
    .empty-cell {
        color: #bbb;
        font-style: italic;
        font-size: 11px;
        text-align: center;
        background-color: #fafafa;
    }

    .form-section-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #455a64;
        margin: 12px 0 5px;
        padding-bottom: 4px;
        border-bottom: 1px solid #e0e0e0;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">

                    <!-- Header Kontainer Tabel Selaras dengan Halaman Lain -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <div>
                            <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Agenda Pembangunan (PN / PP / KP)</h3>
                            <small style="color: #888;">Hierarki Terstruktur: Prioritas Nasional → Program Prioritas → Kegiatan Prioritas</small>
                        </div>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputPN" style="padding: 8px 15px;">
                                <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Prioritas Nasional</b>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="agenda-table">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Prioritas Nasional / Program Prioritas / Kegiatan Prioritas</th>
                                    <th style="width: 15%;">Sasaran</th>
                                    <th style="width: 14%;">Indikator</th>
                                    <th style="width: 5%;">Satuan</th>
                                    <th style="width: 6%;">Baseline 2024</th>
                                    <th style="width: 6%;">Target 2025</th>
                                    <th style="width: 6%;">Target 2029</th>
                                    <th style="width: 9%;">Agenda Transformasi</th>
                                    <th style="width: 9%;">Koordinator</th>
                                    <th colspan="3" style="width: 10%;">Aksi</th>
                                </tr>
                                <tr class="th-sub">
                                    <th colspan="9" style="letter-spacing: 0.5px;">— Data Agenda Pembangunan & Target RPJMN —</th>
                                    <th style="width: 3.5%; color: #00c292;">PN/PP/KP</th>
                                    <th style="width: 3.5%; color: #7b1fa2;">Sasaran</th>
                                    <th style="width: 3%; color: #455a64;">Indikator</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($DataAgenda) && count($DataAgenda) > 0):

                                    function agendaRowspan($sasaranList) {
                                        if (empty($sasaranList)) return 1;
                                        $n = 0;
                                        foreach ($sasaranList as $s) {
                                            $n += max(1, count($s['Indikator']));
                                        }
                                        return $n;
                                    }

                                    function agendaActBtns($id, $tipe, $uraian, $periode = '') {
                                        $u = htmlspecialchars($uraian, ENT_QUOTES);
                                        $p = htmlspecialchars($periode, ENT_QUOTES);
                                        $html = '';
                                        if ($tipe === 'PN') {
                                            $html .= '<button class="btn btn-xs btn-success btn-action TambahPP" data-id="' . $id . '" title="Tambah Program Prioritas"><i class="fa fa-plus"></i> PP</button><br>';
                                        }
                                        if ($tipe === 'PP') {
                                            $html .= '<button class="btn btn-xs btn-success btn-action TambahKP" data-id="' . $id . '" title="Tambah Kegiatan Prioritas"><i class="fa fa-plus"></i> KP</button><br>';
                                        }
                                        $html .= '<button class="btn btn-xs btn-warning btn-action TambahSasaran" data-id="' . $id . '" style="color:#fff;" title="Tambah Sasaran"><i class="fa fa-plus"></i> Sasaran</button><br>';
                                        $html .= '<button class="btn btn-xs btn-info btn-action EditAgenda" data-id="' . $id . '" data-tipe="' . $tipe . '" data-uraian="' . $u . '" data-periode="' . $p . '" title="Edit ' . $tipe . '"><i class="fa fa-edit"></i></button>';
                                        $html .= '<button class="btn btn-xs btn-danger btn-action HapusAgenda" data-id="' . $id . '" title="Hapus ' . $tipe . '"><i class="fa fa-trash"></i></button>';
                                        return $html;
                                    }

                                    function sasaranActBtns($id, $sasaran) {
                                        $s = htmlspecialchars($sasaran, ENT_QUOTES);
                                        return '<button class="btn btn-xs btn-success btn-action TambahIndikator" data-id="' . $id . '" title="Tambah Indikator"><i class="fa fa-plus"></i> Indikator</button><br>'
                                            . '<button class="btn btn-xs btn-info btn-action EditSasaran" data-id="' . $id . '" data-sasaran="' . $s . '" title="Edit Sasaran"><i class="fa fa-edit"></i></button>'
                                            . '<button class="btn btn-xs btn-danger btn-action HapusSasaran" data-id="' . $id . '" title="Hapus Sasaran"><i class="fa fa-trash"></i></button>';
                                    }

                                    function indikatorActBtns($ind) {
                                        return '<button class="btn btn-xs btn-info btn-action EditIndikator"'
                                            . ' data-id="' . $ind['Id'] . '" data-indikator="' . htmlspecialchars($ind['Indikator'], ENT_QUOTES) . '"'
                                            . ' data-satuan="' . htmlspecialchars($ind['Satuan'], ENT_QUOTES) . '"'
                                            . ' data-baseline="' . htmlspecialchars($ind['Baseline2024'], ENT_QUOTES) . '"'
                                            . ' data-t2025="' . htmlspecialchars($ind['Target2025'], ENT_QUOTES) . '"'
                                            . ' data-t2029="' . htmlspecialchars($ind['Target2029'], ENT_QUOTES) . '"'
                                            . ' data-agenda="' . htmlspecialchars($ind['AgendaTransformasi'], ENT_QUOTES) . '"'
                                            . ' data-koordinator="' . htmlspecialchars($ind['Koordinator'], ENT_QUOTES) . '" title="Edit Indikator">'
                                            . '<i class="fa fa-edit"></i></button>'
                                            . '<button class="btn btn-xs btn-danger btn-action HapusIndikator" data-id="' . $ind['Id'] . '" title="Hapus Indikator">'
                                            . '<i class="fa fa-trash"></i></button>';
                                    }

                                    function renderSection($nomor, $tipe, $uraian, $id, $sasaranList, $periode = '') {
                                        $agRS   = agendaRowspan($sasaranList);
                                        $css    = 'cell-' . strtolower($tipe);
                                        $agCell = '<span class="tipe-badge tipe-' . $tipe . '">' . $tipe . '</span><b>' . $nomor . '</b> ' . htmlspecialchars($uraian)
                                            . ($periode ? ' <span class="badge-periode">' . htmlspecialchars($periode) . '</span>' : '');
                                        $agAksi = agendaActBtns($id, $tipe, $uraian, $periode);

                                        $html = '';
                                        $agFirst = true;
                                        $agAksiFirst = true;

                                        if (empty($sasaranList)) {
                                            return '<tr>'
                                                . '<td rowspan="1" class="' . $css . '">' . $agCell . '</td>'
                                                . '<td class="empty-cell">Belum ada sasaran</td>'
                                                . '<td colspan="7" class="empty-cell">-</td>'
                                                . '<td class="cell-aksi">' . $agAksi . '</td>'
                                                . '<td class="empty-cell">-</td>'
                                                . '<td class="empty-cell">-</td>'
                                                . '</tr>';
                                        }

                                        $nSas = 0;
                                        foreach ($sasaranList as $s) {
                                            $nSas++;
                                            $sasRS   = max(1, count($s['Indikator']));
                                            $sasCont = '<span class="nomor-cell">' . $nSas . '</span> ' . htmlspecialchars($s['Sasaran']);
                                            $sasAksi = sasaranActBtns($s['Id'], $s['Sasaran']);
                                            $sasFirst = true;

                                            if (empty($s['Indikator'])) {
                                                $html .= '<tr>';
                                                if ($agFirst) {
                                                    $html .= '<td rowspan="' . $agRS . '" class="' . $css . '">' . $agCell . '</td>';
                                                    $agFirst = false;
                                                }
                                                $html .= '<td rowspan="1" class="cell-sasaran">' . $sasCont . '</td>';
                                                $html .= '<td colspan="7" class="empty-cell">Belum ada indikator</td>';
                                                if ($agAksiFirst) {
                                                    $html .= '<td rowspan="' . $agRS . '" class="cell-aksi">' . $agAksi . '</td>';
                                                    $agAksiFirst = false;
                                                }
                                                $html .= '<td rowspan="1" class="cell-aksi">' . $sasAksi . '</td>';
                                                $html .= '<td class="empty-cell">-</td>';
                                                $html .= '</tr>';
                                            } else {
                                                $nInd = 0;
                                                foreach ($s['Indikator'] as $ind) {
                                                    $nInd++;
                                                    $agendaBadge = !empty($ind['AgendaTransformasi']) ? '<span class="badge-agenda">' . htmlspecialchars($ind['AgendaTransformasi']) . '</span>' : '-';
                                                    $satuanBadge = !empty($ind['Satuan']) ? '<span class="badge-satuan">' . htmlspecialchars($ind['Satuan']) . '</span>' : '-';
                                                    $baseBadge = !empty($ind['Baseline2024']) ? '<span class="badge-baseline">' . htmlspecialchars($ind['Baseline2024']) . '</span>' : '-';
                                                    $t2025Badge = !empty($ind['Target2025']) ? '<span class="badge-target">' . htmlspecialchars($ind['Target2025']) . '</span>' : '-';
                                                    $t2029Badge = !empty($ind['Target2029']) ? '<span class="badge-target">' . htmlspecialchars($ind['Target2029']) . '</span>' : '-';

                                                    $html .= '<tr>';
                                                    if ($agFirst) {
                                                        $html .= '<td rowspan="' . $agRS . '" class="' . $css . '">' . $agCell . '</td>';
                                                        $agFirst = false;
                                                    }
                                                    if ($sasFirst) {
                                                        $html .= '<td rowspan="' . $sasRS . '" class="cell-sasaran">' . $sasCont . '</td>';
                                                        $sasFirst = false;
                                                    }
                                                    $html .= '<td class="cell-ind"><span class="nomor-cell">' . $nInd . '</span> ' . htmlspecialchars($ind['Indikator']) . '</td>';
                                                    $html .= '<td class="cell-data">' . $satuanBadge . '</td>';
                                                    $html .= '<td class="cell-data">' . $baseBadge . '</td>';
                                                    $html .= '<td class="cell-data">' . $t2025Badge . '</td>';
                                                    $html .= '<td class="cell-data">' . $t2029Badge . '</td>';
                                                    $html .= '<td class="cell-data">' . $agendaBadge . '</td>';
                                                    $html .= '<td class="cell-data" style="font-size:11px; color:#455a64;">' . htmlspecialchars($ind['Koordinator'] ?: '-') . '</td>';
                                                    if ($agAksiFirst) {
                                                        $html .= '<td rowspan="' . $agRS . '" class="cell-aksi">' . $agAksi . '</td>';
                                                        $agAksiFirst = false;
                                                    }
                                                    if ($sasFirst) {
                                                        $html .= '<td rowspan="' . $sasRS . '" class="cell-aksi">' . $sasAksi . '</td>';
                                                        $sasFirst = false;
                                                    }
                                                    $html .= '<td class="cell-aksi">' . indikatorActBtns($ind) . '</td>';
                                                    $html .= '</tr>';
                                                }
                                            }
                                        }
                                        return $html;
                                    }

                                    $nPN = 0;
                                    foreach ($DataAgenda as $pn):
                                        $nPN++;
                                        echo renderSection($nPN, 'PN', $pn['Uraian'], $pn['Id'], $pn['Sasaran'], $pn['Periode']);
                                        $nPP = 0;
                                        foreach ($pn['PP'] as $pp):
                                            $nPP++;
                                            $ppNo = $nPN . '.' . $nPP;
                                            echo renderSection($ppNo, 'PP', $pp['Uraian'], $pp['Id'], $pp['Sasaran']);
                                            $nKP = 0;
                                            foreach ($pp['KP'] as $kp):
                                                $nKP++;
                                                echo renderSection($ppNo . '.' . $nKP, 'KP', $kp['Uraian'], $kp['Id'], $kp['Sasaran']);
                                            endforeach;
                                        endforeach;
                                    endforeach;

                                else: ?>
                                    <tr>
                                        <td colspan="12" class="empty-cell" style="padding: 40px;">
                                            Belum ada data agenda pembangunan. Klik <b>Input Prioritas Nasional</b> untuk memulai.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL TAMBAH PN ======== -->
<div class="modal fade" id="ModalInputPN" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-PN">PN</span> Tambah Prioritas Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <div class="form-section-title">Periode RPJMN</div>
                <input type="text" class="form-control" id="PeriodePN" placeholder="cth: 2025-2029">
                <div class="form-section-title">Uraian Prioritas Nasional</div>
                <textarea class="form-control" id="UraianPN" rows="3" placeholder="Uraian Prioritas Nasional..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="SimpanPN"><i class="fa fa-save"></i> Simpan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL TAMBAH PP ======== -->
<div class="modal fade" id="ModalInputPP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-PP">PP</span> Tambah Program Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdPNforPP">
                <p style="color: #03a9f4; font-size: 12px; margin: 8px 0;">Di bawah PN: <b><span id="LabelPNno"></span></b></p>
                <div class="form-section-title">Uraian Program Prioritas</div>
                <textarea class="form-control" id="UraianPP" rows="3" placeholder="Uraian Program Prioritas..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="SimpanPP"><i class="fa fa-save"></i> Simpan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL TAMBAH KP ======== -->
<div class="modal fade" id="ModalInputKP" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><span class="tipe-badge tipe-KP">KP</span> Tambah Kegiatan Prioritas</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdPPforKP">
                <p style="color: #ff9800; font-size: 12px; margin: 8px 0;">Di bawah PP: <b><span id="LabelPPno"></span></b></p>
                <div class="form-section-title">Uraian Kegiatan Prioritas</div>
                <textarea class="form-control" id="UraianKP" rows="3" placeholder="Uraian Kegiatan Prioritas..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="SimpanKP"><i class="fa fa-save"></i> Simpan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL EDIT PN/PP/KP ======== -->
<div class="modal fade" id="ModalEditAgenda" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-edit" style="color: #03a9f4; margin-right: 6px;"></i>Edit <span id="LabelEditTipe"></span></h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="_IdAgenda"><input type="hidden" id="_TipeAgenda">
                <div id="GroupEditPeriode" style="display: none;">
                    <div class="form-section-title">Periode RPJMN</div>
                    <input type="text" class="form-control" id="_PeriodeAgenda" placeholder="cth: 2025-2029">
                </div>
                <div class="form-section-title">Uraian</div>
                <textarea class="form-control" id="_UraianAgenda" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="UpdateAgenda"><i class="fa fa-save"></i> Simpan Perubahan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL INPUT SASARAN ======== -->
<div class="modal fade" id="ModalInputSasaran" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-plus-circle" style="color: #00c292; margin-right: 6px;"></i>Tambah Sasaran</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="IdAgendaForSasaran">
                <div class="form-section-title">Uraian Sasaran</div>
                <textarea class="form-control" id="Sasaran" rows="3" placeholder="Uraian Sasaran..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="SimpanSasaran"><i class="fa fa-save"></i> Simpan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL EDIT SASARAN ======== -->
<div class="modal fade" id="ModalEditSasaran" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-edit" style="color: #03a9f4; margin-right: 6px;"></i>Edit Sasaran</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px;">
                <input type="hidden" id="_IdSasaran">
                <div class="form-section-title">Uraian Sasaran</div>
                <textarea class="form-control" id="_Sasaran" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="UpdateSasaran"><i class="fa fa-save"></i> Simpan Perubahan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL INPUT INDIKATOR ======== -->
<div class="modal fade" id="ModalInputIndikator" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-plus-circle" style="color: #00c292; margin-right: 6px;"></i>Tambah Indikator</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px; max-height: 65vh; overflow-y: auto;">
                <input type="hidden" id="IdSasaranForInd">
                <div class="form-section-title">Uraian Indikator</div>
                <textarea class="form-control" id="Indikator" rows="2" placeholder="Uraian Indikator..."></textarea>
                <div class="form-section-title">Satuan & Target</div>
                <div class="row">
                    <div class="col-xs-3"><label style="font-size: 11px;">Satuan</label><input type="text" class="form-control" id="Satuan" placeholder="Satuan"></div>
                    <div class="col-xs-3"><label style="font-size: 11px;">Baseline 2024</label><input type="text" class="form-control" id="Baseline2024" placeholder="Baseline"></div>
                    <div class="col-xs-3"><label style="font-size: 11px;">Target 2025</label><input type="text" class="form-control" id="Target2025" placeholder="2025"></div>
                    <div class="col-xs-3"><label style="font-size: 11px;">Target 2029</label><input type="text" class="form-control" id="Target2029" placeholder="2029"></div>
                </div>
                <div class="form-section-title">Agenda Transformasi & Koordinator</div>
                <div class="row">
                    <div class="col-xs-6"><label style="font-size: 11px;">Agenda Transformasi</label><input type="text" class="form-control" id="AgendaTransformasi" placeholder="Agenda Transformasi"></div>
                    <div class="col-xs-6"><label style="font-size: 11px;">Koordinator/Pengampu</label><input type="text" class="form-control" id="Koordinator" placeholder="Koordinator"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="SimpanIndikator"><i class="fa fa-save"></i> Simpan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ======== MODAL EDIT INDIKATOR ======== -->
<div class="modal fade" id="ModalEditIndikator" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-edit" style="color: #03a9f4; margin-right: 6px;"></i>Edit Indikator</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px; max-height: 65vh; overflow-y: auto;">
                <input type="hidden" id="_IdInd">
                <div class="form-section-title">Uraian Indikator</div>
                <textarea class="form-control" id="_Indikator" rows="2"></textarea>
                <div class="form-section-title">Satuan & Target</div>
                <div class="row">
                    <div class="col-xs-3"><label style="font-size: 11px;">Satuan</label><input type="text" class="form-control" id="_Satuan"></div>
                    <div class="col-xs-3"><label style="font-size: 11px;">Baseline 2024</label><input type="text" class="form-control" id="_Baseline2024"></div>
                    <div class="col-xs-3"><label style="font-size: 11px;">Target 2025</label><input type="text" class="form-control" id="_Target2025"></div>
                    <div class="col-xs-3"><label style="font-size: 11px;">Target 2029</label><input type="text" class="form-control" id="_Target2029"></div>
                </div>
                <div class="form-section-title">Agenda Transformasi & Koordinator</div>
                <div class="row">
                    <div class="col-xs-6"><label style="font-size: 11px;">Agenda Transformasi</label><input type="text" class="form-control" id="_AgendaTransformasi"></div>
                    <div class="col-xs-6"><label style="font-size: 11px;">Koordinator/Pengampu</label><input type="text" class="form-control" id="_Koordinator"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="UpdateIndikator"><i class="fa fa-save"></i> Simpan Perubahan</button>
                <button class="btn btn-default" data-dismiss="modal">Tutup</button>
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
var BaseURL = '<?= base_url() ?>';
$(function(){
    $('#SimpanPN').click(function(){
        if(!$('#PeriodePN').val()) return alert('Periode belum diisi!');
        if(!$('#UraianPN').val()) return alert('Uraian PN belum diisi!');
        $.post(BaseURL + 'Nasional/InputIUPRPJMN', {
            _Id: 0,
            Tipe: 'PN',
            Periode: $('#PeriodePN').val(),
            Uraian: $('#UraianPN').val()
        }).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.TambahPP', function(){
        $('#IdPNforPP').val($(this).data('id'));
        $('#LabelPNno').text('');
        $('#UraianPP').val('');
        $('#ModalInputPP').modal('show');
    });

    $('#SimpanPP').click(function(){
        if(!$('#UraianPP').val()) return alert('Uraian PP belum diisi!');
        $.post(BaseURL + 'Nasional/InputIUPRPJMN', {
            _Id: $('#IdPNforPP').val(),
            Tipe: 'PP',
            Uraian: $('#UraianPP').val()
        }).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.TambahKP', function(){
        $('#IdPPforKP').val($(this).data('id'));
        $('#UraianKP').val('');
        $('#ModalInputKP').modal('show');
    });

    $('#SimpanKP').click(function(){
        if(!$('#UraianKP').val()) return alert('Uraian KP belum diisi!');
        $.post(BaseURL + 'Nasional/InputIUPRPJMN', {
            _Id: $('#IdPPforKP').val(),
            Tipe: 'KP',
            Uraian: $('#UraianKP').val()
        }).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.EditAgenda', function(){
        var tipe = $(this).data('tipe');
        $('#_IdAgenda').val($(this).data('id'));
        $('#_TipeAgenda').val(tipe);
        $('#LabelEditTipe').text(tipe);
        $('#_UraianAgenda').val($(this).data('uraian'));
        if (tipe === 'PN') {
            $('#GroupEditPeriode').show();
            $('#_PeriodeAgenda').val($(this).data('periode'));
        } else {
            $('#GroupEditPeriode').hide();
        }
        $('#ModalEditAgenda').modal('show');
    });

    $('#UpdateAgenda').click(function(){
        if(!$('#_UraianAgenda').val()) return alert('Uraian belum diisi!');
        var tipe = $('#_TipeAgenda').val();
        var payload = {
            Id: $('#_IdAgenda').val(),
            Tipe: tipe,
            Uraian: $('#_UraianAgenda').val()
        };
        if (tipe === 'PN') {
            payload.Periode = $('#_PeriodeAgenda').val();
        }
        $.post(BaseURL + 'Nasional/EditIUPRPJMN', payload).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.HapusAgenda', function(){
        if(confirm('Hapus item agenda pembangunan ini?')) {
            $.post(BaseURL + 'Nasional/HapusIUPRPJMN', {Id: $(this).data('id')}).done(function(r){
                r == '1' ? location.reload() : alert(r);
            });
        }
    });

    $('body').on('click', '.TambahSasaran', function(){
        $('#IdAgendaForSasaran').val($(this).data('id'));
        $('#Sasaran').val('');
        $('#ModalInputSasaran').modal('show');
    });

    $('#SimpanSasaran').click(function(){
        if(!$('#Sasaran').val()) return alert('Sasaran belum diisi!');
        $.post(BaseURL + 'Nasional/InputSasaranAgenda', {
            _Id: $('#IdAgendaForSasaran').val(),
            Sasaran: $('#Sasaran').val()
        }).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.EditSasaran', function(){
        $('#_IdSasaran').val($(this).data('id'));
        $('#_Sasaran').val($(this).data('sasaran'));
        $('#ModalEditSasaran').modal('show');
    });

    $('#UpdateSasaran').click(function(){
        if(!$('#_Sasaran').val()) return alert('Sasaran belum diisi!');
        $.post(BaseURL + 'Nasional/EditSasaranAgenda', {
            Id: $('#_IdSasaran').val(),
            Sasaran: $('#_Sasaran').val()
        }).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.HapusSasaran', function(){
        if(confirm('Hapus Sasaran beserta semua Indikator di bawahnya?')) {
            $.post(BaseURL + 'Nasional/HapusSasaranAgenda', {Id: $(this).data('id')}).done(function(r){
                r == '1' ? location.reload() : alert(r);
            });
        }
    });

    $('body').on('click', '.TambahIndikator', function(){
        $('#IdSasaranForInd').val($(this).data('id'));
        $('#Indikator,#Satuan,#Baseline2024,#Target2025,#Target2029,#AgendaTransformasi,#Koordinator').val('');
        $('#ModalInputIndikator').modal('show');
    });

    $('#SimpanIndikator').click(function(){
        if(!$('#Indikator').val()) return alert('Indikator belum diisi!');
        $.post(BaseURL + 'Nasional/InputIndikatorAgenda', {
            _Id: $('#IdSasaranForInd').val(),
            Indikator: $('#Indikator').val(),
            Satuan: $('#Satuan').val(),
            Baseline2024: $('#Baseline2024').val(),
            Target2025: $('#Target2025').val(),
            Target2029: $('#Target2029').val(),
            AgendaTransformasi: $('#AgendaTransformasi').val(),
            Koordinator: $('#Koordinator').val()
        }).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.EditIndikator', function(){
        $('#_IdInd').val($(this).data('id'));
        $('#_Indikator').val($(this).data('indikator'));
        $('#_Satuan').val($(this).data('satuan'));
        $('#_Baseline2024').val($(this).data('baseline'));
        $('#_Target2025').val($(this).data('t2025'));
        $('#_Target2029').val($(this).data('t2029'));
        $('#_AgendaTransformasi').val($(this).data('agenda'));
        $('#_Koordinator').val($(this).data('koordinator'));
        $('#ModalEditIndikator').modal('show');
    });

    $('#UpdateIndikator').click(function(){
        if(!$('#_Indikator').val()) return alert('Indikator belum diisi!');
        $.post(BaseURL + 'Nasional/EditIndikatorAgenda', {
            Id: $('#_IdInd').val(),
            Indikator: $('#_Indikator').val(),
            Satuan: $('#_Satuan').val(),
            Baseline2024: $('#_Baseline2024').val(),
            Target2025: $('#_Target2025').val(),
            Target2029: $('#_Target2029').val(),
            AgendaTransformasi: $('#_AgendaTransformasi').val(),
            Koordinator: $('#_Koordinator').val()
        }).done(function(r){
            r == '1' ? location.reload() : alert(r);
        });
    });

    $('body').on('click', '.HapusIndikator', function(){
        if(confirm('Hapus Indikator ini?')) {
            $.post(BaseURL + 'Nasional/HapusIndikatorAgenda', {Id: $(this).data('id')}).done(function(r){
                r == '1' ? location.reload() : alert(r);
            });
        }
    });
});
</script>