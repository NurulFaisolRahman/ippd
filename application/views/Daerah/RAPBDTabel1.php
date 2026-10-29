<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
  /* Styling Tabel RAPBD Sesuai Tema Notika / Menu Lain dengan Pewarnaan Hirarki yang Jelas dan Kontras */
  .table-rapbd {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    margin-top: 15px;
    font-size: 13px;
    border: 1px solid #cbd5e1;
  }
  .table-rapbd th, 
  .table-rapbd td {
    border: 1px solid #cbd5e1;
    padding: 8px 12px;
    vertical-align: middle;
  }
  .table-rapbd thead th {
    background-color: #f1f5f9;
    color: #334155;
    font-weight: 700;
    text-align: center;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.3px;
    border: 1px solid #cbd5e1;
  }
  .table-rapbd thead tr.sub-header th {
    background-color: #f8fafc;
    color: #64748b;
    padding: 4px 8px;
    font-weight: 700;
    text-align: center;
    font-size: 11px;
    border: 1px solid #cbd5e1;
  }

  /* Kolom */
  .table-rapbd td.kode-col {
    width: 12%;
    text-align: left;
    white-space: nowrap;
    padding-left: 12px;
    font-weight: 700;
  }
  .table-rapbd td.uraian-col {
    width: 60%;
    text-align: left;
  }
  .table-rapbd td.jumlah-col {
    width: 28%;
    text-align: right;
    white-space: nowrap;
    font-variant-numeric: tabular-nums;
    font-weight: 700;
    padding-right: 14px;
  }

  /* ======================================================== */
  /* 1. Baris JUDUL (Level 1: 4, 5, 6) - HIJAU SEGAR TEGAS    */
  /* ======================================================== */
  .table-rapbd tr.row-judul,
  .table-rapbd tr.row-judul td {
    background-color: #bbf7d0 !important;
    color: #14532d !important;
    font-weight: 800 !important;
    font-size: 13.5px;
  }
  .table-rapbd tr.row-judul td {
    border-left: 5px solid #16a34a !important;
    border-top: 1.5px solid #86efac !important;
    border-bottom: 1.5px solid #86efac !important;
  }

  /* ======================================================== */
  /* 2. Baris SUB JUDUL (Level 2: 4,1; 4,2; 5,1; dst) - BIRU  */
  /* ======================================================== */
  .table-rapbd tr.row-sub-judul,
  .table-rapbd tr.row-sub-judul td {
    background-color: #bae6fd !important;
    color: #0369a1 !important;
    font-weight: 700 !important;
    font-size: 13px;
  }
  .table-rapbd tr.row-sub-judul td {
    border-left: 5px solid #0284c7 !important;
    border-top: 1.5px solid #7dd3fc !important;
    border-bottom: 1.5px solid #7dd3fc !important;
  }
  .table-rapbd tr.row-sub-judul td.uraian-col {
    padding-left: 16px;
  }

  /* ======================================================== */
  /* 3. Baris RINCIAN / ISI (Level 3: 4.1.01, dst) - PUTIH    */
  /* ======================================================== */
  .table-rapbd tr.row-isi,
  .table-rapbd tr.row-isi td {
    background-color: #ffffff !important;
    color: #1e293b !important;
  }
  .table-rapbd tr.row-isi td.uraian-col {
    padding-left: 28px;
    font-weight: normal;
  }

  /* ======================================================== */
  /* 4. Baris JUMLAH / TOTAL - KUNING EMAS / AMBER            */
  /* ======================================================== */
  .table-rapbd tr.row-total-judul,
  .table-rapbd tr.row-total-judul td {
    background-color: #fef08a !important;
    color: #713f12 !important;
    font-weight: 800 !important;
  }
  .table-rapbd tr.row-total-judul td {
    border-left: 5px solid #d97706 !important;
    border-top: 2px solid #ca8a04 !important;
    border-bottom: 2px solid #ca8a04 !important;
  }

  /* ======================================================== */
  /* 5. Baris SURPLUS / (DEFISIT) - ORANYE PEACH TEGAS        */
  /* ======================================================== */
  .table-rapbd tr.row-surplus-defisit,
  .table-rapbd tr.row-surplus-defisit td {
    background-color: #fed7aa !important;
    color: #7c2d12 !important;
    font-weight: 800 !important;
  }
  .table-rapbd tr.row-surplus-defisit td {
    border-left: 5px solid #ea580c !important;
    border-top: 2px solid #f97316 !important;
    border-bottom: 2px solid #f97316 !important;
  }

  /* ======================================================== */
  /* 6. Baris PEMBIAYAAN NETTO - UNGU LAVENDER                */
  /* ======================================================== */
  .table-rapbd tr.row-pembiayaan-netto,
  .table-rapbd tr.row-pembiayaan-netto td {
    background-color: #e9d5ff !important;
    color: #581c87 !important;
    font-weight: 800 !important;
  }
  .table-rapbd tr.row-pembiayaan-netto td {
    border-left: 5px solid #9333ea !important;
    border-top: 2px solid #a855f7 !important;
    border-bottom: 2px solid #a855f7 !important;
  }

  /* ======================================================== */
  /* 7. Baris SILPA - INDIGO / BIRU TUA                       */
  /* ======================================================== */
  .table-rapbd tr.row-silpa,
  .table-rapbd tr.row-silpa td {
    background-color: #c7d2fe !important;
    color: #312e81 !important;
    font-weight: 700 !important;
  }
  .table-rapbd tr.row-silpa td {
    border-left: 5px solid #4f46e5 !important;
  }
  .table-rapbd tr.row-silpa td.uraian-col {
    padding-left: 28px;
  }

  .table-rapbd tbody tr {
    transition: filter 0.15s ease;
  }
  .table-rapbd tbody tr:hover {
    filter: brightness(0.96);
  }

  @media print {
    .no-print, .sidebar-wrapper, .header-top-area, .footer-copyright-area, .btn {
      display: none !important;
    }
    .main-content {
      margin-left: 0 !important;
      padding: 0 !important;
    }
    .table-rapbd {
      border: 1px solid #000 !important;
      font-size: 11px !important;
    }
    .table-rapbd th, .table-rapbd td {
      border: 1px solid #000 !important;
      padding: 4px 6px !important;
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
                  <h3 style="font-weight: 800; color: #1f2937; margin: 0;">
                    RINGKASAN RAPBD
                  </h3>
                </div>

                <div class="col-md-5 col-sm-6 text-right no-print" style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; flex-wrap: wrap;">
                  <!-- Filter Tahun -->
                  <form method="GET" action="<?= base_url('Daerah/RAPBDTabel1') ?>" class="form-inline" id="formFilterTahun">
                    <?php if (!empty($KodeWilayah)) { ?>
                      <input type="hidden" name="kodewilayah" value="<?= html_escape($KodeWilayah) ?>">
                    <?php } ?>
                    <label for="filterTahun" style="font-weight: 700; margin-right: 6px; font-size: 13px; color: #374151;">
                      <i class="fa fa-calendar"></i> Tahun:
                    </label>
                    <select name="tahun" id="filterTahun" class="form-control input-sm" style="border-radius: 6px; font-weight: 700; width: 110px;" onchange="this.form.submit()">
                      <?php foreach ($TahunList as $t) { ?>
                        <option value="<?= $t ?>" <?= ($SelectedTahun == $t) ? 'selected' : '' ?>><?= $t ?></option>
                      <?php } ?>
                    </select>
                  </form>
                </div>
              </div>
            </div>

            <!-- TABEL RINGKASAN RAPBD -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-rapbd" id="tabel-ringkasan-rapbd">
                <thead>
                  <tr>
                    <th style="width: 12%;">KODE</th>
                    <th style="width: 60%;">URAIAN</th>
                    <th style="width: 28%;">JUMLAH (Rp)</th>
                  </tr>
                  <tr class="sub-header">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <!-- ========================================== -->
                  <!-- 1. PENDAPATAN DAERAH (AKUN 4)               -->
                  <!-- ========================================== -->
                  <tr class="row-judul">
                    <td class="kode-col">4</td>
                    <td class="uraian-col font-weight-bold">PENDAPATAN DAERAH</td>
                    <td class="jumlah-col"></td>
                  </tr>

                  <?php foreach ($Ringkasan['4']['groups'] as $gKey => $group) { 
                    $hasItems = !empty($group['items']);
                    $subtotal = $group['subtotal'] ?? 0;
                    if ($subtotal > 0 || $hasItems || in_array($gKey, ['4.1', '4.2'])) {
                  ?>
                    <tr class="row-sub-judul">
                      <td class="kode-col"><?= html_escape($group['kode']) ?></td>
                      <td class="uraian-col font-weight-bold"><?= html_escape($group['uraian']) ?></td>
                      <td class="jumlah-col font-weight-bold"><?= number_format($subtotal, 2, ',', '.') ?></td>
                    </tr>

                    <?php foreach ($group['items'] as $item) { 
                      if ($item['total'] > 0 || $hasItems) {
                    ?>
                      <tr class="row-isi">
                        <td class="kode-col"><?= html_escape($item['kode']) ?></td>
                        <td class="uraian-col"><?= html_escape($item['uraian']) ?></td>
                        <td class="jumlah-col"><?= number_format($item['total'], 2, ',', '.') ?></td>
                      </tr>
                    <?php } } ?>

                  <?php } } ?>

                  <!-- JUMLAH PENDAPATAN -->
                  <tr class="row-total-judul">
                    <td class="kode-col"></td>
                    <td class="uraian-col font-weight-bold">Jumlah Pendapatan</td>
                    <td class="jumlah-col font-weight-bold"><?= number_format($TotPendapatan, 2, ',', '.') ?></td>
                  </tr>

                  <!-- ========================================== -->
                  <!-- 2. BELANJA DAERAH (AKUN 5)                  -->
                  <!-- ========================================== -->
                  <tr class="row-judul">
                    <td class="kode-col">5</td>
                    <td class="uraian-col font-weight-bold">BELANJA DAERAH</td>
                    <td class="jumlah-col"></td>
                  </tr>

                  <?php foreach ($Ringkasan['5']['groups'] as $gKey => $group) { 
                    $hasItems = !empty($group['items']);
                    $subtotal = $group['subtotal'] ?? 0;
                    if ($subtotal > 0 || $hasItems || in_array($gKey, ['5.1', '5.2', '5.3', '5.4'])) {
                  ?>
                    <tr class="row-sub-judul">
                      <td class="kode-col"><?= html_escape($group['kode']) ?></td>
                      <td class="uraian-col font-weight-bold"><?= html_escape($group['uraian']) ?></td>
                      <td class="jumlah-col font-weight-bold"><?= number_format($subtotal, 2, ',', '.') ?></td>
                    </tr>

                    <?php foreach ($group['items'] as $item) { 
                      if ($item['total'] > 0 || $hasItems) {
                    ?>
                      <tr class="row-isi">
                        <td class="kode-col"><?= html_escape($item['kode']) ?></td>
                        <td class="uraian-col"><?= html_escape($item['uraian']) ?></td>
                        <td class="jumlah-col"><?= number_format($item['total'], 2, ',', '.') ?></td>
                      </tr>
                    <?php } } ?>

                  <?php } } ?>

                  <!-- JUMLAH BELANJA -->
                  <tr class="row-total-judul">
                    <td class="kode-col"></td>
                    <td class="uraian-col font-weight-bold">Jumlah Belanja</td>
                    <td class="jumlah-col font-weight-bold"><?= number_format($TotBelanja, 2, ',', '.') ?></td>
                  </tr>

                  <!-- TOTAL SURPLUS / (DEFISIT) -->
                  <tr class="row-surplus-defisit">
                    <td class="kode-col"></td>
                    <td class="uraian-col font-weight-bold">Total Surplus/(Defisit)</td>
                    <td class="jumlah-col font-weight-bold" style="color: <?= $SurplusDefisit >= 0 ? '#15803d' : '#b91c1c' ?>;">
                      <?= ($SurplusDefisit < 0 ? '-' : '') . number_format(abs($SurplusDefisit), 2, ',', '.') ?>
                    </td>
                  </tr>

                  <!-- ========================================== -->
                  <!-- 3. PEMBIAYAAN DAERAH (AKUN 6)               -->
                  <!-- ========================================== -->
                  <tr class="row-judul">
                    <td class="kode-col">6</td>
                    <td class="uraian-col font-weight-bold">PEMBIAYAAN DAERAH</td>
                    <td class="jumlah-col"></td>
                  </tr>

                  <!-- 6.1 PENERIMAAN PEMBIAYAAN -->
                  <?php 
                    $grpTerima = $Ringkasan['6']['groups']['6.1'] ?? [];
                    $subTerima = $grpTerima['subtotal'] ?? 0;
                  ?>
                  <tr class="row-sub-judul">
                    <td class="kode-col"><?= html_escape($grpTerima['kode'] ?? '6,1') ?></td>
                    <td class="uraian-col font-weight-bold"><?= html_escape($grpTerima['uraian'] ?? 'PENERIMAAN PEMBIAYAAN') ?></td>
                    <td class="jumlah-col font-weight-bold"><?= number_format($subTerima, 2, ',', '.') ?></td>
                  </tr>

                  <?php if (!empty($grpTerima['items'])) {
                    foreach ($grpTerima['items'] as $item) {
                      if ($item['total'] > 0) {
                  ?>
                    <tr class="row-isi">
                      <td class="kode-col"><?= html_escape($item['kode']) ?></td>
                      <td class="uraian-col"><?= html_escape($item['uraian']) ?></td>
                      <td class="jumlah-col"><?= number_format($item['total'], 2, ',', '.') ?></td>
                    </tr>
                  <?php } } } ?>

                  <!-- 6.2 PENGELUARAN PEMBIAYAAN -->
                  <?php 
                    $grpKeluar = $Ringkasan['6']['groups']['6.2'] ?? [];
                    $subKeluar = $grpKeluar['subtotal'] ?? 0;
                  ?>
                  <tr class="row-sub-judul">
                    <td class="kode-col"><?= html_escape($grpKeluar['kode'] ?? '6,2') ?></td>
                    <td class="uraian-col font-weight-bold"><?= html_escape($grpKeluar['uraian'] ?? 'PENGELUARAN PEMBIAYAAN') ?></td>
                    <td class="jumlah-col font-weight-bold"><?= number_format($subKeluar, 2, ',', '.') ?></td>
                  </tr>

                  <?php if (!empty($grpKeluar['items'])) {
                    foreach ($grpKeluar['items'] as $item) {
                      if ($item['total'] > 0) {
                  ?>
                    <tr class="row-isi">
                      <td class="kode-col"><?= html_escape($item['kode']) ?></td>
                      <td class="uraian-col"><?= html_escape($item['uraian']) ?></td>
                      <td class="jumlah-col"><?= number_format($item['total'], 2, ',', '.') ?></td>
                    </tr>
                  <?php } } } ?>

                  <!-- JUMLAH PENERIMAAN PEMBIAYAAN -->
                  <tr class="row-total-judul">
                    <td class="kode-col"></td>
                    <td class="uraian-col font-weight-bold">Jumlah Penerimaan Pembiayaan</td>
                    <td class="jumlah-col font-weight-bold"><?= number_format($TotPenerimaan, 2, ',', '.') ?></td>
                  </tr>

                  <!-- JUMLAH PENGELUARAN PEMBIAYAAN -->
                  <tr class="row-total-judul">
                    <td class="kode-col"></td>
                    <td class="uraian-col font-weight-bold">Jumlah Pengeluaran Pembiayaan</td>
                    <td class="jumlah-col font-weight-bold"><?= number_format($TotPengeluaran, 2, ',', '.') ?></td>
                  </tr>

                  <!-- PEMBIAYAAN NETTO -->
                  <tr class="row-pembiayaan-netto">
                    <td class="kode-col"></td>
                    <td class="uraian-col font-weight-bold">Pembiayaan Netto</td>
                    <td class="jumlah-col font-weight-bold"><?= ($PembiayaanNetto < 0 ? '-' : '') . number_format(abs($PembiayaanNetto), 2, ',', '.') ?></td>
                  </tr>

                  <!-- 6.3 SILPA -->
                  <tr class="row-silpa">
                    <td class="kode-col font-weight-bold">6.3</td>
                    <td class="uraian-col font-weight-bold">Sisa Lebih Pembiayaan Anggaran Daerah Tahun Berkenaan (SILPA)</td>
                    <td class="jumlah-col font-weight-bold"><?= ($SiLPA < 0 ? '-' : '') . number_format(abs($SiLPA), 2, ',', '.') ?></td>
                  </tr>

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
        window.location.href = BaseURL + "Daerah/RAPBDTabel1?tahun=" + tahunVal + "&kodewilayah=" + kodeWilayah;
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
