<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
  /* Styling Tabel RAPBD Tabel 2 Sesuai Tema Notika / Menu Lain */
  .table-rapbd {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    margin-top: 15px;
    font-size: 12px;
    border: 1px solid #cbd5e1;
  }
  .table-rapbd th, 
  .table-rapbd td {
    border: 1px solid #e2e8f0;
    padding: 6px 8px;
    vertical-align: middle;
  }
  .table-rapbd thead th {
    background-color: #f1f5f9;
    color: #334155;
    font-weight: 700;
    text-align: center;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: 0.3px;
    border: 1px solid #cbd5e1;
    vertical-align: middle !important;
  }
  .table-rapbd thead tr.sub-header th {
    background-color: #f8fafc;
    color: #64748b;
    padding: 3px 6px;
    font-weight: 700;
    text-align: center;
    font-size: 10.5px;
    border: 1px solid #cbd5e1;
  }
  .table-rapbd thead tr.col-num-header th {
    background-color: #f1f5f9;
    color: #94a3b8;
    padding: 2px 4px;
    font-size: 10px;
    font-weight: 600;
    border: 1px solid #cbd5e1;
  }

  /* Kolom Kode 1, 2, 3 */
  .table-rapbd td.kd-ur-col {
    width: 25px;
    text-align: center;
    font-weight: 700;
    white-space: nowrap;
    padding: 6px 4px;
  }
  .table-rapbd td.kd-bid-col {
    width: 32px;
    text-align: center;
    font-weight: 700;
    white-space: nowrap;
    padding: 6px 4px;
  }
  .table-rapbd td.kd-org-col {
    width: 175px;
    text-align: left;
    white-space: nowrap;
    font-family: monospace, sans-serif;
    font-size: 11.5px;
    font-weight: 600;
    padding-left: 6px;
  }
  
  /* Kolom Uraian & Anggaran */
  .table-rapbd td.uraian-col {
    text-align: left;
    line-height: 1.4;
  }
  .table-rapbd td.num-col {
    text-align: right;
    white-space: nowrap;
    font-variant-numeric: tabular-nums;
    font-size: 11.5px;
    padding-right: 8px;
  }
  .table-rapbd td.jb-col {
    text-align: right;
    white-space: nowrap;
    font-variant-numeric: tabular-nums;
    font-weight: 700;
    font-size: 11.5px;
    padding-right: 8px;
  }
  .table-rapbd td.aksi-col {
    text-align: center;
    white-space: nowrap;
    width: 55px;
  }

  /* Row Styling Hierarkis (Selaras RPJMD / SIPD) */
  /* Level 1: Urusan */
  .table-rapbd tr.row-urusan {
    background-color: #eef7ee !important;
    font-weight: 700;
    color: #1b5e20;
  }
  .table-rapbd tr.row-urusan td {
    border-left: 4px solid #4caf50 !important;
    font-size: 12.5px;
  }
  /* Level 2: Bidang Urusan */
  .table-rapbd tr.row-bidang {
    background-color: #e6f7fa !important;
    font-weight: 700;
    color: #006064;
  }
  .table-rapbd tr.row-bidang td {
    border-left: 4px solid #00bcd4 !important;
    font-size: 12px;
  }
  .table-rapbd tr.row-bidang td.uraian-col {
    padding-left: 14px;
  }
  /* Level 3: Dinas / Instansi */
  .table-rapbd tr.row-instansi {
    background-color: #ffffff;
    font-weight: 600;
    color: #1e293b;
  }
  .table-rapbd tr.row-instansi td.uraian-col {
    padding-left: 22px;
  }
  /* Level 3+: Unit / Sub Unit (RSUD, Puskesmas, dll) */
  .table-rapbd tr.row-unit {
    background-color: #fafbfc;
    font-weight: normal;
    color: #334155;
  }
  .table-rapbd tr.row-unit td.uraian-col {
    padding-left: 32px;
  }
  /* Row TOTAL */
  .table-rapbd tr.row-total {
    background-color: #fff8eb !important;
    font-weight: 800;
    color: #9a3412;
  }
  .table-rapbd tr.row-total td {
    border-left: 4px solid #ff9800 !important;
    border-top: 2px solid #fdba74 !important;
    border-bottom: 2px solid #fdba74 !important;
    font-size: 12.5px;
  }

  .table-rapbd tbody tr {
    transition: filter 0.15s ease;
  }
  .table-rapbd tbody tr:hover {
    filter: brightness(0.97);
  }

  .btn-action {
    border-radius: 4px;
    margin: 1px;
    transition: all 0.2s ease;
    padding: 3px 8px;
    font-weight: 600;
    font-size: 11px;
    display: inline-flex;
    align-items: center;
    gap: 3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  .btn-action:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
  }

  /* Auto Calc Badge */
  .badge-autocalc {
    background-color: #e0f2fe;
    color: #0369a1;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 4px;
    font-weight: 700;
    border: 1px solid #bae6fd;
    display: inline-block;
  }

  @media print {
    .no-print, .sidebar-wrapper, .header-top-area, .footer-copyright-area, .btn {
      display: none !important;
    }
    .main-content {
      margin-left: 0 !important;
      padding: 0 !important;
    }
    .table-rapbd th, .table-rapbd td {
      border: 1px solid #000 !important;
    }
  }
</style>

<!-- Main Content -->
<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      
      <!-- Tabel Area -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list" style="border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px; background: #fff;">
            
            <!-- Header di atas tabel -->
            <div class="basic-tb-hd" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
              <div class="row align-items-center">
                <div class="col-md-7 col-sm-6">
                  <h3 style="font-weight: 800; color: #1f2937; margin: 0 0 5px 0;">
                    RANCANGAN APBD (RAPBD) - TABEL 2
                  </h3>
                  <div style="color: #64748b; font-size: 13px;">
                    <?php if (!empty($NamaWilayah)) { ?>
                      <span class="badge" style="background-color: #e6fcf5; color: #0ca678; border: 1px solid #c3fae8; padding: 4px 10px; font-size: 12px; border-radius: 12px; font-weight: 700; margin-right: 8px;">
                        <i class="fa fa-map-marker"></i> <?= html_escape($NamaWilayah) ?>
                      </span>
                    <?php } ?>
                    Penjabaran menurut <b>Urusan</b>, <b>Bidang Urusan</b>, dan <b>Organisasi Perangkat Daerah</b>. Kode & Urusan otomatis dari Daftar Instansi.
                  </div>
                </div>

                <div class="col-md-5 col-sm-6 text-right no-print" style="display: flex; justify-content: flex-end; align-items: center; gap: 8px; flex-wrap: wrap;">
                  <!-- Filter Tahun -->
                  <form method="GET" action="<?= base_url('Daerah/RAPBDTabel2') ?>" class="form-inline" id="formFilterTahun" style="margin-right: 5px;">
                    <label for="filterTahun" style="font-weight: 700; margin-right: 6px; font-size: 13px; color: #374151;">
                      <i class="fa fa-calendar"></i> Tahun:
                    </label>
                    <select name="tahun" id="filterTahun" class="form-control input-sm" style="border-radius: 6px; font-weight: 700; width: 105px;" onchange="this.form.submit()">
                      <?php foreach ($TahunList as $t) { ?>
                        <option value="<?= $t ?>" <?= ($SelectedTahun == $t) ? 'selected' : '' ?>><?= $t ?></option>
                      <?php } ?>
                    </select>
                  </form>

                  <button type="button" class="btn btn-sm btn-info notika-btn-info" id="btnSyncInstansi2" style="border-radius: 6px; font-weight: 600; font-size: 12px;" title="Tarik pembaruan dari Daftar Instansi">
                    <i class="fa fa-refresh"></i> Sinkronkan Instansi
                  </button>

                  <?php if (!empty($RAPBDList)) { ?>
                    <button type="button" class="btn btn-sm btn-danger notika-btn-danger" id="btnClearTabel2" style="border-radius: 6px; font-weight: 600; font-size: 12px;" title="Kosongkan Semua Nilai Anggaran">
                      <i class="fa fa-trash"></i> Kosongkan
                    </button>
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover table-rapbd" id="tabel-rapbd-2">
                <thead>
                  <tr>
                    <th colspan="3" rowspan="2" style="width: 232px; vertical-align: middle !important;">KODE</th>
                    <th rowspan="2" style="min-width: 250px; vertical-align: middle !important;">URUSAN PEMERINTAH DAERAH</th>
                    <th rowspan="2" style="width: 125px; vertical-align: middle !important;">PENDAPATAN</th>
                    <th colspan="5" style="vertical-align: middle !important;">BELANJA</th>
                    <th rowspan="2" class="no-print aksi-col" style="vertical-align: middle !important;">AKSI</th>
                  </tr>
                  <tr class="sub-header">
                    <th style="width: 120px;">OPERASI</th>
                    <th style="width: 115px;">MODAL</th>
                    <th style="width: 95px;">TIDAK TERDUGA</th>
                    <th style="width: 95px;">TRANSFER</th>
                    <th style="width: 130px;">JUMLAH BELANJA</th>
                  </tr>
                  <tr class="col-num-header">
                    <th>1</th>
                    <th></th>
                    <th></th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8 = 4+5+6+7</th>
                    <th class="no-print aksi-col">-</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($RAPBDList)) { ?>
                    <tr>
                      <td colspan="11" class="text-center" style="padding: 40px; color: #6b7280;">
                        <i class="fa fa-folder-open-o" style="font-size: 32px; color: #9ca3af; margin-bottom: 8px;"></i><br>
                        Belum ada data RAPBD Tabel 2 untuk tahun <b><?= $SelectedTahun ?></b>.<br>
                        <small>Klik tombol <b>Sinkronkan Instansi</b> untuk menarik data perangkat daerah dari menu Daftar Instansi.</small>
                      </td>
                    </tr>
                  <?php } else { ?>
                    <?php 
                      foreach ($RAPBDList as $row) {
                        $tipe = $row['tipe'] ?? 'instansi';
                        $kdUr = trim($row['kode_urusan'] ?? '');
                        $kdBid = trim($row['kode_bidang'] ?? '');
                        $kdOrg = trim($row['kode_organisasi'] ?? '');
                        $uraian = trim($row['uraian'] ?? '');

                        $pend = floatval($row['pendapatan'] ?? 0);
                        $op   = floatval($row['belanja_operasi'] ?? 0);
                        $mod  = floatval($row['belanja_modal'] ?? 0);
                        $tt   = floatval($row['belanja_tidak_terduga'] ?? 0);
                        $tr   = floatval($row['belanja_transfer'] ?? 0);
                        $jb   = floatval($row['jumlah_belanja'] ?? 0);

                        // Aturan: Jika belum mengisi dana (nilai 0), jangan ada isinya (kosong)
                        $pendText = ($pend != 0) ? number_format($pend, 2, ',', '.') : '';
                        $opText   = ($op != 0) ? number_format($op, 2, ',', '.') : '';
                        $modText  = ($mod != 0) ? number_format($mod, 2, ',', '.') : '';
                        $ttText   = ($tt != 0) ? number_format($tt, 2, ',', '.') : '';
                        $trText   = ($tr != 0) ? number_format($tr, 2, ',', '.') : '';
                        $jbText   = ($jb != 0) ? number_format($jb, 2, ',', '.') : '';

                        $rowClass = 'row-' . $tipe;
                    ?>
                      <tr class="<?= $rowClass ?>">
                        <td class="kd-ur-col"><?= html_escape($kdUr) ?></td>
                        <td class="kd-bid-col"><?= html_escape($kdBid) ?></td>
                        <td class="kd-org-col"><?= html_escape($kdOrg) ?></td>
                        <td class="uraian-col"><?= html_escape($uraian) ?></td>
                        <td class="num-col"><?= $pendText ?></td>
                        <td class="num-col"><?= $opText ?></td>
                        <td class="num-col"><?= $modText ?></td>
                        <td class="num-col"><?= $ttText ?></td>
                        <td class="num-col"><?= $trText ?></td>
                        <td class="jb-col"><?= $jbText ?></td>
                        <td class="no-print aksi-col">
                          <button type="button" class="btn btn-xs btn-warning btn-action btn-edit-rapbd2" data-id="<?= $row['id'] ?>" title="Edit Anggaran">
                            <i class="fa fa-pencil"></i> Edit
                          </button>
                        </td>
                      </tr>
                    <?php } ?>

                    <!-- Baris TOTAL -->
                    <?php 
                      $totPend = floatval($TotalSum['pendapatan'] ?? 0);
                      $totOp   = floatval($TotalSum['belanja_operasi'] ?? 0);
                      $totMod  = floatval($TotalSum['belanja_modal'] ?? 0);
                      $totTt   = floatval($TotalSum['belanja_tidak_terduga'] ?? 0);
                      $totTr   = floatval($TotalSum['belanja_transfer'] ?? 0);
                      $totJb   = floatval($TotalSum['jumlah_belanja'] ?? 0);

                      $totPendText = ($totPend != 0) ? number_format($totPend, 2, ',', '.') : '';
                      $totOpText   = ($totOp != 0) ? number_format($totOp, 2, ',', '.') : '';
                      $totModText  = ($totMod != 0) ? number_format($totMod, 2, ',', '.') : '';
                      $totTtText   = ($totTt != 0) ? number_format($totTt, 2, ',', '.') : '';
                      $totTrText   = ($totTr != 0) ? number_format($totTr, 2, ',', '.') : '';
                      $totJbText   = ($totJb != 0) ? number_format($totJb, 2, ',', '.') : '';
                    ?>
                    <tr class="row-total">
                      <td class="kd-ur-col"></td>
                      <td class="kd-bid-col"></td>
                      <td class="kd-org-col"></td>
                      <td class="uraian-col" style="font-weight: 800; letter-spacing: 1px;">TOTAL</td>
                      <td class="num-col" style="font-weight: 800;"><?= $totPendText ?></td>
                      <td class="num-col" style="font-weight: 800;"><?= $totOpText ?></td>
                      <td class="num-col" style="font-weight: 800;"><?= $totModText ?></td>
                      <td class="num-col" style="font-weight: 800;"><?= $totTtText ?></td>
                      <td class="num-col" style="font-weight: 800;"><?= $totTrText ?></td>
                      <td class="jb-col" style="font-weight: 800; font-size: 12.5px;"><?= $totJbText ?></td>
                      <td class="no-print aksi-col">-</td>
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

<!-- ============================================================== -->
<!-- MODAL POP UP: EDIT ANGGARAN RAPBD TABEL 2                      -->
<!-- (HANYA PENDAPATAN, OPERASI, MODAL, TIDAK TERDUGA, TRANSFER)    -->
<!-- ============================================================== -->
<div class="modal fade" id="modalEditRAPBD2" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 10px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
      <form id="formEditRAPBD2">
        <input type="hidden" name="id" id="edit_id">

        <div class="modal-header" style="background: #20c997; color: white; padding: 15px 20px;">
          <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 0.9; font-size: 24px;">&times;</button>
          <h4 class="modal-title" style="color: white; font-weight: 700;">
            <i class="fa fa-pencil-square-o"></i> Edit Anggaran RAPBD
          </h4>
        </div>

        <div class="modal-body" style="padding: 20px 25px;">
          
          <!-- Info Read-Only: Nama Urusan/Instansi & Kode (TIDAK BISA DIUBAH KARENA OTOMATIS DARI DAFTAR INSTANSI) -->
          <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 14px 18px; margin-bottom: 20px;">
            <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
              <i class="fa fa-building text-info"></i> URUSAN / PERANGKAT DAERAH:
            </div>
            <div style="font-size: 15px; font-weight: 800; color: #1e293b; margin-top: 2px;" id="edit_info_uraian">
              -
            </div>
            <div style="font-size: 12px; font-weight: 600; color: #0284c7; margin-top: 4px; font-family: monospace;" id="edit_info_kode">
              -
            </div>
          </div>

          <!-- Input Anggaran (HANYA INI YANG BISA DIEDIT) -->
          <h5 style="font-weight: 700; color: #1f2937; margin-bottom: 15px;">
            <i class="fa fa-money text-success"></i> Pengisian Dana Anggaran (Rupiah)
          </h5>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-weight: 700; color: #166534;">
                  <i class="fa fa-arrow-circle-down text-success"></i> PENDAPATAN (Rp):
                </label>
                <input type="text" name="pendapatan" id="edit_pendapatan" class="form-control input-currency text-right" placeholder="Belum mengisi dana" style="border-radius: 6px; font-weight: 700; color: #166534; font-size: 14px;">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-weight: 700; color: #1e293b;">
                  BELANJA OPERASI (Rp):
                </label>
                <input type="text" name="belanja_operasi" id="edit_operasi" class="form-control input-currency calc-belanja-edit text-right" placeholder="Belum mengisi dana" style="border-radius: 6px; font-weight: 600; font-size: 14px;">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label style="font-weight: 700; color: #1e293b;">
                  BELANJA MODAL (Rp):
                </label>
                <input type="text" name="belanja_modal" id="edit_modal" class="form-control input-currency calc-belanja-edit text-right" placeholder="Belum mengisi dana" style="border-radius: 6px; font-weight: 600;">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label style="font-weight: 700; color: #1e293b;">
                  TIDAK TERDUGA (Rp):
                </label>
                <input type="text" name="belanja_tidak_terduga" id="edit_tidak_terduga" class="form-control input-currency calc-belanja-edit text-right" placeholder="Belum mengisi dana" style="border-radius: 6px; font-weight: 600;">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label style="font-weight: 700; color: #1e293b;">
                  TRANSFER (Rp):
                </label>
                <input type="text" name="belanja_transfer" id="edit_transfer" class="form-control input-currency calc-belanja-edit text-right" placeholder="Belum mengisi dana" style="border-radius: 6px; font-weight: 600;">
              </div>
            </div>
          </div>

          <!-- Highlight Jumlah Belanja Terisi Otomatis -->
          <div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 8px; padding: 12px 18px; margin-top: 10px;">
            <div class="row align-items-center">
              <div class="col-xs-6">
                <label style="font-weight: 800; color: #166534; font-size: 13px; margin: 0;">
                  JUMLAH BELANJA <span class="badge-autocalc"><i class="fa fa-calculator"></i> TERISI OTOMATIS</span>:
                </label>
                <div style="font-size: 11px; color: #15803d;">= Operasi + Modal + Tidak Terduga + Transfer</div>
              </div>
              <div class="col-xs-6 text-right">
                <input type="text" id="edit_jumlah_belanja" class="form-control text-right" value="" placeholder="Belum mengisi dana" readonly style="font-size: 16px; font-weight: 800; color: #15803d; background: transparent; border: none; box-shadow: none; padding: 0;">
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-success notika-btn-success" id="btnSubmitEdit2" style="border-radius: 6px; font-weight: 700;">
            <i class="fa fa-save"></i> Simpan Perubahan Dana
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {

  // Helper parsing & formatting rupiah
  function parseRupiah(val) {
    if (!val) return 0;
    var s = String(val).trim();
    if (s === '' || s === '-') return 0;
    var isNeg = (s.indexOf('-') !== -1 || (s.indexOf('(') !== -1 && s.indexOf(')') !== -1));
    var parts = s.split(',');
    var intClean = parts[0].replace(/[^0-9]/g, '');
    var decClean = parts[1] ? parts[1].replace(/[^0-9]/g, '').substr(0, 2) : '00';
    var n = parseFloat(intClean + '.' + decClean.padEnd(2, '0'));
    if (isNaN(n)) n = 0;
    return isNeg ? -n : n;
  }

  function formatRupiah(num) {
    var n = parseFloat(num);
    if (isNaN(n) || n === 0) return '';
    var isNeg = n < 0;
    var absN = Math.abs(n);
    var parts = absN.toFixed(2).split('.');
    var ribuan = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    var result = ribuan + ',' + parts[1];
    return isNeg ? '-' + result : result;
  }

  // Live Auto-calc Jumlah Belanja di modal Edit
  function calcEditJumlahBelanja() {
    var op = parseRupiah($('#edit_operasi').val());
    var mod = parseRupiah($('#edit_modal').val());
    var tt = parseRupiah($('#edit_tidak_terduga').val());
    var tr = parseRupiah($('#edit_transfer').val());
    var jb = op + mod + tt + tr;
    if (jb === 0) {
      $('#edit_jumlah_belanja').val('');
    } else {
      $('#edit_jumlah_belanja').val(formatRupiah(jb));
    }
  }

  $('.calc-belanja-edit').on('input blur keyup', function() {
    calcEditJumlahBelanja();
  });

  // Currency auto format on blur
  $('.input-currency').on('blur', function() {
    var val = $(this).val();
    if (val !== '') {
      var num = parseRupiah(val);
      $(this).val(num !== 0 ? formatRupiah(num) : '');
    }
  });

  // Klik Edit Baris -> Buka Modal Edit Anggaran
  $(document).on('click', '.btn-edit-rapbd2', function() {
    var id = $(this).data('id');
    if (!id) return;

    $.ajax({
      url: '<?= base_url("Daerah/GetRAPBDTabel2ById") ?>',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(resp) {
        if (resp.status === 'success' && resp.data) {
          var d = resp.data;
          $('#edit_id').val(d.id);
          
          // Info header readonly
          $('#edit_info_uraian').text(d.uraian || '-');
          var fullKode = d.kode_organisasi ? d.kode_organisasi : ((d.kode_urusan || '') + (d.kode_bidang ? '.' + d.kode_bidang : ''));
          $('#edit_info_kode').text('Kode: ' + (fullKode || '-'));

          // Input nominal (jika 0 atau kosong, kosongkan)
          var pVal = parseFloat(d.pendapatan || 0);
          var oVal = parseFloat(d.belanja_operasi || 0);
          var mVal = parseFloat(d.belanja_modal || 0);
          var ttVal = parseFloat(d.belanja_tidak_terduga || 0);
          var trVal = parseFloat(d.belanja_transfer || 0);

          $('#edit_pendapatan').val(pVal !== 0 ? formatRupiah(pVal) : '');
          $('#edit_operasi').val(oVal !== 0 ? formatRupiah(oVal) : '');
          $('#edit_modal').val(mVal !== 0 ? formatRupiah(mVal) : '');
          $('#edit_tidak_terduga').val(ttVal !== 0 ? formatRupiah(ttVal) : '');
          $('#edit_transfer').val(trVal !== 0 ? formatRupiah(trVal) : '');

          calcEditJumlahBelanja();
          $('#modalEditRAPBD2').modal('show');
        } else {
          alert(resp.message || 'Gagal memuat data baris.');
        }
      },
      error: function() {
        alert('Terjadi kesalahan memuat data.');
      }
    });
  });

  // Form Edit Submit via AJAX
  $('#formEditRAPBD2').on('submit', function(e) {
    e.preventDefault();
    var $btn = $('#btnSubmitEdit2');
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

    $.ajax({
      url: '<?= base_url("Daerah/UpdateRAPBDTabel2") ?>',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(resp) {
        $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan Dana');
        if (resp.status === 'success') {
          $('#modalEditRAPBD2').modal('hide');
          if (typeof swal === 'function') {
            swal({
              title: "Berhasil!",
              text: resp.message,
              type: "success",
              timer: 1200,
              showConfirmButton: false
            });
            setTimeout(function() { location.reload(); }, 1200);
          } else {
            alert(resp.message);
            location.reload();
          }
        } else {
          alert(resp.message || 'Gagal memperbarui dana anggaran.');
        }
      },
      error: function() {
        $btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan Dana');
        alert('Terjadi kesalahan koneksi server.');
      }
    });
  });

  // Sinkronkan dari Daftar Instansi
  $('#btnSyncInstansi2').on('click', function() {
    var $btn = $(this);
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyinkronkan...');

    $.ajax({
      url: '<?= base_url("Daerah/SyncRAPBDTabel2") ?>',
      type: 'POST',
      data: {
        kodewilayah: '<?= $KodeWilayah ?>',
        tahun: '<?= $SelectedTahun ?>'
      },
      dataType: 'json',
      success: function(resp) {
        $btn.prop('disabled', false).html('<i class="fa fa-refresh"></i> Sinkronkan Instansi');
        if (resp.status === 'success') {
          if (typeof swal === 'function') {
            swal({
              title: "Berhasil!",
              text: resp.message,
              type: "success",
              timer: 1200,
              showConfirmButton: false
            });
            setTimeout(function() { location.reload(); }, 1200);
          } else {
            alert(resp.message);
            location.reload();
          }
        } else {
          alert(resp.message || 'Gagal melakukan sinkronisasi.');
        }
      },
      error: function() {
        $btn.prop('disabled', false).html('<i class="fa fa-refresh"></i> Sinkronkan Instansi');
        alert('Terjadi kesalahan server saat sinkronisasi.');
      }
    });
  });

  // Tombol Kosongkan Tabel 2
  $('#btnClearTabel2').on('click', function() {
    var doClear = function() {
      $.ajax({
        url: '<?= base_url("Daerah/ClearRAPBDTabel2") ?>',
        type: 'POST',
        data: {
          kodewilayah: '<?= $KodeWilayah ?>',
          tahun: '<?= $SelectedTahun ?>'
        },
        dataType: 'json',
        success: function(resp) {
          if (resp.status === 'success') {
            if (typeof swal === 'function') {
              swal({
                title: "Dikosongkan!",
                text: resp.message,
                type: "success",
                timer: 1200,
                showConfirmButton: false
              });
              setTimeout(function() { location.reload(); }, 1200);
            } else {
              alert(resp.message);
              location.reload();
            }
          } else {
            alert(resp.message || 'Gagal mengosongkan tabel.');
          }
        },
        error: function() {
          alert('Terjadi kesalahan server.');
        }
      });
    };

    if (typeof swal === 'function') {
      swal({
        title: "Kosongkan Tabel 2?",
        text: "Seluruh data RAPBD Tabel 2 untuk tahun <?= $SelectedTahun ?> akan dihapus.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Kosongkan!",
        cancelButtonText: "Batal",
        closeOnConfirm: false
      }, function(isConfirm) {
        if (isConfirm) doClear();
      });
    } else {
      if (confirm("Kosongkan semua data RAPBD Tabel 2 tahun <?= $SelectedTahun ?>?")) doClear();
    }
  });

});
</script>
