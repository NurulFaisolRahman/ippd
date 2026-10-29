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
  /* Level 1: Urusan - Garis Pemisah Utama Tebal */
  .table-rapbd tr.row-urusan {
    background-color: #ecfdf5 !important;
    font-weight: 800;
    color: #14532d;
  }
  .table-rapbd tr.row-urusan td {
    border-top: 3px solid #15803d !important;
    border-bottom: 1.5px solid #86efac !important;
    font-size: 12.5px;
    padding-top: 8px;
    padding-bottom: 8px;
  }
  .table-rapbd tr.row-urusan td:first-child {
    border-left: 5px solid #16a34a !important;
  }
  .table-rapbd tr.row-urusan td.uraian-col {
    letter-spacing: 0.3px;
  }

  /* Level 2: Bidang Urusan - Garis Pemisah Bidang */
  .table-rapbd tr.row-bidang {
    background-color: #f0f9ff !important;
    font-weight: 700;
    color: #0369a1;
  }
  .table-rapbd tr.row-bidang td {
    border-top: 2px solid #0284c7 !important;
    border-bottom: 1px solid #bae6fd !important;
    font-size: 12px;
    padding-top: 6px;
    padding-bottom: 6px;
  }
  .table-rapbd tr.row-bidang td:first-child {
    border-left: 5px solid #0284c7 !important;
  }
  .table-rapbd tr.row-bidang td.uraian-col {
    padding-left: 14px;
  }

  /* Level 3: Dinas / Instansi */
  .table-rapbd tr.row-instansi {
    background-color: #ffffff;
    font-weight: 500;
    color: #1e293b;
  }
  .table-rapbd tr.row-instansi td {
    border-top: 1px solid #f1f5f9;
    border-bottom: 1px solid #e2e8f0;
  }
  .table-rapbd tr.row-instansi td.uraian-col {
    padding-left: 26px;
    font-weight: 600;
  }

  /* Level 3+: Unit / Sub Unit (RSUD, Puskesmas, dll) */
  .table-rapbd tr.row-unit {
    background-color: #fafbfc;
    font-weight: normal;
    color: #334155;
  }
  .table-rapbd tr.row-unit td.uraian-col {
    padding-left: 36px;
  }

  /* Row TOTAL - Garis Pemisah Total Ganda */
  .table-rapbd tr.row-total {
    background-color: #fff8eb !important;
    font-weight: 800;
    color: #9a3412;
  }
  .table-rapbd tr.row-total td:first-child {
    border-left: 5px solid #ea580c !important;
  }
  .table-rapbd tr.row-total td {
    border-top: 3px double #f97316 !important;
    border-bottom: 3px double #f97316 !important;
    font-size: 13px;
    padding-top: 8px;
    padding-bottom: 8px;
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
      border: 1px solid #94a3b8 !important;
    }
    .table-rapbd tr.row-urusan td {
      border-top: 3px solid #000 !important;
      border-bottom: 1.5px solid #000 !important;
      font-weight: bold !important;
    }
    .table-rapbd tr.row-bidang td {
      border-top: 2px solid #000 !important;
      border-bottom: 1px solid #000 !important;
      font-weight: bold !important;
    }
    .table-rapbd tr.row-total td {
      border-top: 3px double #000 !important;
      border-bottom: 3px double #000 !important;
      font-weight: bold !important;
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
            
            <!-- FILTER WILAYAH SEBELUM LOGIN -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px;">
                <div style="display: flex; align-items: flex-end; gap: 15px; flex-wrap: wrap;">
                  <div style="flex: 1 1 250px; min-width: 200px;">
                    <label for="Provinsi" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Provinsi</label>
                    <select class="form-control" id="Provinsi" style="height: 38px; border-radius: 6px;">
                      <option value="">Pilih Provinsi</option>
                      <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                        <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($HasFiltered) && !empty($KodeWilayah) && substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                          <?= html_escape($prov['Nama']) ?>
                        </option>
                      <?php } } ?>
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
              <?php if (!empty($KodeWilayah) && !empty($HasFiltered)) { ?>
                <div class="alert alert-info" style="margin-bottom: 15px;">
                  <strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah ?? '') ?>
                </div>
              <?php } ?>
            <?php } ?>

            <?php if (empty($KodeWilayah)) { ?>
              <div class="alert alert-info text-center" style="padding: 30px 20px; margin: 20px 0; border-radius: 8px; background-color: #f0f9ff; border: 1px solid #bae6fd;">
                <i class="fa fa-info-circle fa-2x" style="color: #0284c7; margin-bottom: 10px; display: block;"></i>
                <h4 style="font-weight: 700; color: #0369a1; margin-bottom: 6px;">Wilayah Belum Dipilih</h4>
                <p style="color: #475569; margin: 0; font-size: 13.5px;">Silakan pilih <b>Provinsi</b> dan <b>Kab/Kota</b> di atas, kemudian klik tombol <b>Filter</b> untuk menampilkan data.</p>
              </div>
            <?php } else { ?>

            <!-- Header di atas tabel -->
            <div class="basic-tb-hd" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
              <div class="row align-items-center">
                <div class="col-md-7 col-sm-6">
                  <h3 style="font-weight: 800; color: #1f2937; margin: 0 0 5px 0;">
                    RANCANGAN APBD (RAPBD) - TABEL 2
                  </h3>
                  <div style="color: #64748b; font-size: 13px;">
                    Penjabaran menurut <b>Urusan</b> dan <b>Organisasi Perangkat Daerah</b>. Data Pendapatan bersumber dari menu <b>Anggaran Pendapatan</b> dan Belanja dari menu <b>Belanja Sub Kegiatan</b>.
                  </div>
                </div>

                <div class="col-md-5 col-sm-6 text-right no-print" style="display: flex; justify-content: flex-end; align-items: center; gap: 8px; flex-wrap: wrap;">
                  <!-- Filter Tahun -->
                  <form method="GET" action="<?= base_url('Daerah/RAPBDTabel2') ?>" class="form-inline" id="formFilterTahun" style="margin-right: 5px;">
                    <?php if (!empty($KodeWilayah)) { ?>
                      <input type="hidden" name="kodewilayah" value="<?= html_escape($KodeWilayah) ?>">
                    <?php } ?>
                    <label for="filterTahun" style="font-weight: 700; margin-right: 6px; font-size: 13px; color: #374151;">
                      <i class="fa fa-calendar"></i> Tahun:
                    </label>
                    <select name="tahun" id="filterTahun" class="form-control input-sm" style="border-radius: 6px; font-weight: 700; width: 105px;" onchange="this.form.submit()">
                      <?php foreach ($TahunList as $t) { ?>
                        <option value="<?= $t ?>" <?= ($SelectedTahun == $t) ? 'selected' : '' ?>><?= $t ?></option>
                      <?php } ?>
                    </select>
                  </form>
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
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($RAPBDList)) { ?>
                    <tr>
                      <td colspan="10" class="text-center" style="padding: 40px; color: #6b7280;">
                        <i class="fa fa-folder-open-o" style="font-size: 32px; color: #9ca3af; margin-bottom: 8px;"></i><br>
                        Belum ada data anggaran untuk tahun <b><?= $SelectedTahun ?></b>.<br>
                        <small>Data akan otomatis terisi saat data diinput pada menu <b>Pendapatan</b> dan <b>Belanja Sub Kegiatan</b>.</small>
                      </td>
                    </tr>
                  <?php } else { ?>
                    <?php 
                      foreach ($RAPBDList as $row) {
                        $tipe = $row['tipe'] ?? 'instansi';
                        if ($tipe === 'unit') {
                          continue;
                        }

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

                        $pendText = ($pend != 0) ? number_format($pend, 2, ',', '.') : '0';
                        $opText   = ($op != 0) ? number_format($op, 2, ',', '.') : '0';
                        $modText  = ($mod != 0) ? number_format($mod, 2, ',', '.') : '0';
                        $ttText   = ($tt != 0) ? number_format($tt, 2, ',', '.') : '0';
                        $trText   = ($tr != 0) ? number_format($tr, 2, ',', '.') : '0';
                        $jbText   = ($jb != 0) ? number_format($jb, 2, ',', '.') : '0';

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

                      $totPendText = ($totPend != 0) ? number_format($totPend, 2, ',', '.') : '0';
                      $totOpText   = ($totOp != 0) ? number_format($totOp, 2, ',', '.') : '0';
                      $totModText  = ($totMod != 0) ? number_format($totMod, 2, ',', '.') : '0';
                      $totTtText   = ($totTt != 0) ? number_format($totTt, 2, ',', '.') : '0';
                      $totTrText   = ($totTr != 0) ? number_format($totTr, 2, ',', '.') : '0';
                      $totJbText   = ($totJb != 0) ? number_format($totJb, 2, ',', '.') : '0';
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
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

            <?php } ?>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script>
  var BaseURL = '<?= base_url() ?>';
  var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';

  $(document).ready(function() {
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
      $("#Provinsi").change(function() {
        var kodeProv = $(this).val();
        if (kodeProv === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', true);
          return;
        }
        $("#KabKota").html('<option value="">Memuat...</option>').prop('disabled', true);
        $.ajax({
          url: BaseURL + "Daerah/GetListKabKota",
          type: "POST",
          data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
          success: function(Respon) {
            var Data = JSON.parse(Respon);
            var options = '<option value="">Pilih Kab/Kota</option>';
            for (var i = 0; i < Data.length; i++) {
              options += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
            }
            $("#KabKota").html(options).prop('disabled', false);
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
        var tahunVal = $("#filterTahun").length ? $("#filterTahun").val() : '<?= $SelectedTahun ?>';
        window.location.href = BaseURL + "Daerah/RAPBDTabel2?tahun=" + tahunVal + "&kodewilayah=" + kodeWilayah;
      });

      <?php if (!empty($HasFiltered) && !empty($KodeWilayah)) { ?>
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
              $("#KabKota").html(KabKota);
            }
          }
        });
      <?php } ?>
    <?php } ?>
  });
</script>
