<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
  .card-stat {
    border-radius: 12px;
    padding: 20px;
    color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  .card-stat:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
  }
  .card-stat-1 {
    background: linear-gradient(135deg, #20c997 0%, #0ca678 100%);
  }
  .card-stat-2 {
    background: linear-gradient(135deg, #845ef7 0%, #5f3dc4 100%);
  }
  .card-stat-title {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
  }
  .card-stat-val {
    font-size: 24px;
    font-weight: 800;
    margin-top: 5px;
  }
  .card-stat-icon {
    font-size: 40px;
    opacity: 0.3;
  }

  .badge-kode {
    background-color: #f3f0ff;
    color: #5f3dc4;
    border: 1px solid #d0bfff;
    font-weight: 700;
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 6px;
    display: inline-block;
    font-family: 'Courier New', Courier, monospace;
  }

  .table-custom th {
    background-color: #f1f3f5 !important;
    color: #495057 !important;
    font-weight: 700 !important;
    text-align: center;
    vertical-align: middle !important;
    border: 1px solid #dee2e6 !important;
  }

  .table-custom td {
    vertical-align: middle !important;
    border: 1px solid #dee2e6 !important;
  }

  .btn-action {
    width: 32px;
    height: 32px;
    padding: 0;
    line-height: 32px;
    text-align: center;
    border-radius: 6px;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 2px;
  }

  .header-page-title {
    font-size: 20px;
    font-weight: 800;
    color: #2b2f38;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .header-page-title i {
    color: #20c997;
  }
</style>

<!-- Main Content -->
<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px;">
            
            <!-- Header Section -->
            <div class="basic-tb-hd" style="border-bottom: 2px solid #e9ecef; padding-bottom: 15px; margin-bottom: 20px;">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <div class="header-page-title">
                    <i class="fa fa-money"></i>
                    <span>Anggaran Pendapatan dan Belanja Daerah (APBD)</span>
                  </div>
                  <p class="text-muted" style="margin-top: 5px; font-size: 13px;">
                    Kelola data penetapan kode, uraian, dan jumlah alokasi APBD Daerah secara manual.
                  </p>
                </div>
                <div class="col-md-6 text-right">
                  <?php if (!empty($NamaWilayah)) { ?>
                    <span class="badge" style="background-color: #e3fafc; color: #1098ad; border: 1px solid #99e9f2; padding: 8px 14px; font-size: 13px; border-radius: 20px; font-weight: 700;">
                      <i class="fa fa-map-marker"></i> <?= html_escape($NamaWilayah) ?>
                    </span>
                  <?php } ?>
                </div>
              </div>
            </div>

            <!-- Filter untuk pengguna tanpa KodeWilayah tetap (misal Super Admin) -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div class="form-example-wrap" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 10px; padding: 15px; margin-bottom: 20px;">
                <div class="row filter-row">
                  <div class="col-lg-4 col-md-5">
                    <label style="font-weight: 700; font-size: 13px; margin-bottom: 5px;">Provinsi</label>
                    <select class="form-control" id="FilterProvinsi" style="border-radius: 6px;">
                      <option value="">-- Pilih Provinsi --</option>
                      <?php foreach ($Provinsi as $prov) { ?>
                        <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                          <?= html_escape($prov['Nama']) ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-5">
                    <label style="font-weight: 700; font-size: 13px; margin-bottom: 5px;">Kabupaten/Kota</label>
                    <select class="form-control" id="FilterKabKota" style="border-radius: 6px;">
                      <option value="">-- Pilih Kab/Kota --</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-2" style="margin-top: 25px;">
                    <button class="btn btn-primary notika-btn-primary btn-block" id="BtnTerapkanWilayah" style="border-radius: 6px; font-weight: 700;">
                      <i class="fa fa-filter"></i> Pilih
                    </button>
                  </div>
                </div>
              </div>
            <?php } ?>

            <!-- Stats & Filter Bar -->
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-md-6">
                <div class="card-stat card-stat-1">
                  <div>
                    <div class="card-stat-title">Total Alokasi APBD (Tahun <?= $SelectedTahun ?>)</div>
                    <div class="card-stat-val">Rp <?= number_format($TotalJumlah, 0, ',', '.') ?></div>
                  </div>
                  <div class="card-stat-icon">
                    <i class="fa fa-calculator"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-stat card-stat-2">
                  <div>
                    <div class="card-stat-title">Jumlah Rincian Uraian</div>
                    <div class="card-stat-val"><?= count($APBDList) ?> Item</div>
                  </div>
                  <div class="card-stat-icon">
                    <i class="fa fa-list-ol"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Toolbar Action & Filter Tahun -->
            <div class="row align-items-center" style="background: #fdfdfe; border: 1px solid #eef2f5; border-radius: 10px; padding: 15px; margin-bottom: 20px;">
              <div class="col-md-4 col-sm-6">
                <form method="GET" action="<?= base_url('Daerah/APBD') ?>" class="form-inline" id="formFilterTahun">
                  <label for="filterTahun" style="font-weight: 700; margin-right: 10px; font-size: 13px;">
                    <i class="fa fa-calendar"></i> Tahun Anggaran:
                  </label>
                  <select name="tahun" id="filterTahun" class="form-control" style="border-radius: 6px; font-weight: 700; width: 130px;" onchange="this.form.submit()">
                    <?php foreach ($TahunList as $t) { ?>
                      <option value="<?= $t ?>" <?= ($SelectedTahun == $t) ? 'selected' : '' ?>><?= $t ?></option>
                    <?php } ?>
                  </select>
                </form>
              </div>
              <div class="col-md-8 col-sm-6 text-right">
                <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [0, 2, 3, 4])) { ?>
                  <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#modalTambahAPBD" style="border-radius: 6px; font-weight: 700; padding: 8px 18px;">
                    <i class="fa fa-plus-circle"></i> Tambah Data APBD
                  </button>
                <?php } ?>
              </div>
            </div>

            <!-- Tabel Data APBD -->
            <div class="table-responsive">
              <table id="data-table-apbd" class="table table-bordered table-striped table-custom" style="width: 100%;">
                <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 18%;">Kode</th>
                    <th style="width: 45%;">Uraian</th>
                    <th style="width: 20%;">Jumlah (Rp)</th>
                    <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [0, 2, 3, 4])) { ?>
                      <th style="width: 12%;">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($APBDList)) { ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [0, 2, 3, 4])) ? '5' : '4' ?>" class="text-center text-muted" style="padding: 40px 0;">
                        <i class="fa fa-info-circle" style="font-size: 28px; margin-bottom: 10px; display: block; color: #adb5bd;"></i>
                        Belum ada data APBD untuk tahun <?= $SelectedTahun ?>.<br>
                        <small>Klik tombol <b>Tambah Data APBD</b> untuk menambahkan data secara manual.</small>
                      </td>
                    </tr>
                  <?php } else { ?>
                    <?php $no = 1; foreach ($APBDList as $row) { ?>
                      <tr>
                        <td class="text-center font-weight-bold"><?= $no++ ?></td>
                        <td>
                          <span class="badge-kode"><?= html_escape($row['kode']) ?></span>
                        </td>
                        <td>
                          <div style="font-weight: 600; color: #212529;">
                            <?= nl2br(html_escape($row['uraian'])) ?>
                          </div>
                          <?php if (!empty($row['keterangan'])) { ?>
                            <small class="text-muted"><i class="fa fa-sticky-note-o"></i> <?= html_escape($row['keterangan']) ?></small>
                          <?php } ?>
                        </td>
                        <td class="text-right" style="font-weight: 700; font-size: 14px; color: #0ca678;">
                          Rp <?= number_format($row['jumlah'], 0, ',', '.') ?>
                        </td>
                        <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [0, 2, 3, 4])) { ?>
                          <td class="text-center">
                            <button type="button" class="btn btn-warning btn-action btn-edit-apbd" data-id="<?= $row['id'] ?>" title="Edit">
                              <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-action btn-hapus-apbd" data-id="<?= $row['id'] ?>" data-uraian="<?= html_escape($row['uraian']) ?>" title="Hapus">
                              <i class="fa fa-trash"></i>
                            </button>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
                <?php if (!empty($APBDList)) { ?>
                  <tfoot>
                    <tr style="background-color: #e6fcf5; font-weight: 800;">
                      <td colspan="3" class="text-right" style="font-size: 14px; color: #0ca678;">TOTAL ANGGARAN APBD:</td>
                      <td class="text-right" style="font-size: 15px; color: #087f5b;">
                        Rp <?= number_format($TotalJumlah, 0, ',', '.') ?>
                      </td>
                      <?php if (isset($_SESSION['Level']) && in_array($_SESSION['Level'], [0, 2, 3, 4])) { ?>
                        <td></td>
                      <?php } ?>
                    </tr>
                  </tfoot>
                <?php } ?>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah APBD -->
<div class="modal fade" id="modalTambahAPBD" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <form id="formTambahAPBD" method="POST">
        <div class="modal-header" style="background: linear-gradient(135deg, #20c997 0%, #0ca678 100%); color: white; padding: 15px 20px;">
          <h5 class="modal-title font-weight-bold" style="color: white; margin: 0;">
            <i class="fa fa-plus-circle"></i> Tambah Data APBD
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 20px;">
          <input type="hidden" name="kodewilayah" value="<?= html_escape($KodeWilayah) ?>">

          <div class="form-group">
            <label style="font-weight: 700;">Tahun Anggaran <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="tahun" value="<?= $SelectedTahun ?>" required style="border-radius: 6px;">
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Kode <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="kode" placeholder="Contoh: 4.1.01.01 atau 5.1.02.01" required style="border-radius: 6px; font-family: monospace;">
            <small class="text-muted">Masukkan kode akun, rekening, atau kode urusan/program yang relevan.</small>
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Uraian <span class="text-danger">*</span></label>
            <textarea class="form-control" name="uraian" rows="3" placeholder="Masukkan uraian anggaran..." required style="border-radius: 6px;"></textarea>
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Jumlah (Rp) <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-addon" style="font-weight: 700;">Rp</span>
              <input type="text" class="form-control rupiah-input" name="jumlah" id="tambahJumlah" placeholder="0" required style="border-radius: 0 6px 6px 0; font-weight: 700; font-size: 15px;">
            </div>
            <small class="text-muted">Nominal angka akan otomatis diformat ribuan.</small>
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Keterangan <small class="text-muted">(Opsional)</small></label>
            <input type="text" class="form-control" name="keterangan" placeholder="Catatan tambahan (opsional)" style="border-radius: 6px;">
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8f9fa; padding: 12px 20px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
          <button type="submit" class="btn btn-success" id="btnSimpanTambah" style="border-radius: 6px; font-weight: 700; background-color: #0ca678; border-color: #0ca678;">
            <i class="fa fa-save"></i> Simpan Data
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit APBD -->
<div class="modal fade" id="modalEditAPBD" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <form id="formEditAPBD" method="POST">
        <input type="hidden" name="id" id="editId">
        <div class="modal-header" style="background: linear-gradient(135deg, #845ef7 0%, #5f3dc4 100%); color: white; padding: 15px 20px;">
          <h5 class="modal-title font-weight-bold" style="color: white; margin: 0;">
            <i class="fa fa-pencil-square-o"></i> Edit Data APBD
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 20px;">
          <div class="form-group">
            <label style="font-weight: 700;">Tahun Anggaran <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="tahun" id="editTahun" required style="border-radius: 6px;">
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Kode <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="kode" id="editKode" required style="border-radius: 6px; font-family: monospace;">
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Uraian <span class="text-danger">*</span></label>
            <textarea class="form-control" name="uraian" id="editUraian" rows="3" required style="border-radius: 6px;"></textarea>
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Jumlah (Rp) <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-addon" style="font-weight: 700;">Rp</span>
              <input type="text" class="form-control rupiah-input" name="jumlah" id="editJumlah" required style="border-radius: 0 6px 6px 0; font-weight: 700; font-size: 15px;">
            </div>
          </div>

          <div class="form-group">
            <label style="font-weight: 700;">Keterangan <small class="text-muted">(Opsional)</small></label>
            <input type="text" class="form-control" name="keterangan" id="editKeterangan" style="border-radius: 6px;">
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8f9fa; padding: 12px 20px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSimpanEdit" style="border-radius: 6px; font-weight: 700; background-color: #5f3dc4; border-color: #5f3dc4;">
            <i class="fa fa-save"></i> Perbarui Data
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  var BaseURL = '<?= base_url() ?>';

  // Format Rupiah Helper
  function formatRupiah(angka) {
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
  }

  $(document).ready(function() {
    // Auto format Rupiah on input
    $(document).on('keyup', '.rupiah-input', function() {
      $(this).val(formatRupiah($(this).val()));
    });

    // Handle cascade dropdown wilayah jika Super Admin / Guest
    $('#FilterProvinsi').on('change', function() {
      var kodeProv = $(this).val();
      var kabSelect = $('#FilterKabKota');
      kabSelect.empty().append('<option value="">-- Pilih Kab/Kota --</option>');
      
      if (kodeProv) {
        $.ajax({
          url: BaseURL + 'Daerah/GetListKabKota',
          type: 'POST',
          data: { Kode: kodeProv },
          dataType: 'json',
          success: function(res) {
            $.each(res, function(k, v) {
              kabSelect.append('<option value="' + v.Kode + '">' + v.Nama + '</option>');
            });
          }
        });
      }
    });

    $('#BtnTerapkanWilayah').on('click', function() {
      var kode = $('#FilterKabKota').val() || $('#FilterProvinsi').val();
      if (!kode) {
        Swal.fire('Perhatian', 'Silakan pilih wilayah terlebih dahulu!', 'warning');
        return;
      }
      $.ajax({
        url: BaseURL + 'Daerah/SetTempKodeWilayah',
        type: 'POST',
        data: { KodeWilayah: kode },
        success: function(res) {
          if (res == '1') {
            window.location.reload();
          } else {
            Swal.fire('Gagal', 'Wilayah tidak valid', 'error');
          }
        }
      });
    });

    // Form Tambah APBD Submit
    $('#formTambahAPBD').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnSimpanTambah');
      btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

      $.ajax({
        url: BaseURL + 'Daerah/InputAPBD',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
          btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Data');
          if (res.status === 'success') {
            $('#modalTambahAPBD').modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: res.message,
              timer: 1500,
              showConfirmButton: false
            }).then(function() {
              window.location.reload();
            });
          } else {
            Swal.fire('Gagal', res.message, 'error');
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Data');
          Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
        }
      });
    });

    // Edit Button Click - Load Data
    $(document).on('click', '.btn-edit-apbd', function() {
      var id = $(this).data('id');
      $.ajax({
        url: BaseURL + 'Daerah/GetAPBDById',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(res) {
          if (res.status === 'success') {
            $('#editId').val(res.data.id);
            $('#editTahun').val(res.data.tahun);
            $('#editKode').val(res.data.kode);
            $('#editUraian').val(res.data.uraian);
            $('#editJumlah').val(formatRupiah(res.data.jumlah));
            $('#editKeterangan').val(res.data.keterangan);
            $('#modalEditAPBD').modal('show');
          } else {
            Swal.fire('Error', res.message, 'error');
          }
        }
      });
    });

    // Form Edit APBD Submit
    $('#formEditAPBD').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnSimpanEdit');
      btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');

      $.ajax({
        url: BaseURL + 'Daerah/UpdateAPBD',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
          btn.prop('disabled', false).html('<i class="fa fa-save"></i> Perbarui Data');
          if (res.status === 'success') {
            $('#modalEditAPBD').modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: res.message,
              timer: 1500,
              showConfirmButton: false
            }).then(function() {
              window.location.reload();
            });
          } else {
            Swal.fire('Gagal', res.message, 'error');
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa fa-save"></i> Perbarui Data');
          Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
        }
      });
    });

    // Delete Button Click
    $(document).on('click', '.btn-hapus-apbd', function() {
      var id = $(this).data('id');
      var uraian = $(this).data('uraian');

      Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data: "' + uraian + '"?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: BaseURL + 'Daerah/DeleteAPBD',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(res) {
              if (res.status === 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'Terhapus!',
                  text: res.message,
                  timer: 1500,
                  showConfirmButton: false
                }).then(function() {
                  window.location.reload();
                });
              } else {
                Swal.fire('Gagal', res.message, 'error');
              }
            }
          });
        }
      });
    });

  });
</script>
</body>
</html>
