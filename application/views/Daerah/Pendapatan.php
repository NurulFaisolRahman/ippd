<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  :root {
    --brand-green: #00c292;
    --brand-green-dark: #00a87e;
    --brand-green-light: #e8f8f5;
    --brand-green-btn: #16a34a;
    --brand-green-btn-hover: #15803d;
  }

  /* Agar konten utama tergeser sesuai lebar sidebar dan tidak tertutup */
  .main-content {
    margin-left: var(--sidebar-width, 280px);
    padding: 20px 25px 60px;
    min-height: 100vh;
    transition: all 0.3s ease;
  }
  body.sidebar-mini .main-content {
    margin-left: var(--sidebar-mini-width, 70px);
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
    color: #b91c1c; /* Merah untuk Pendapatan */
  }

  /* Card Stat mirip halaman lain */
  .card-stat {
    border-radius: 12px;
    padding: 18px 22px;
    color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  .card-stat:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  }
  .card-stat-green {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
  }
  .card-stat-title {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.95;
  }
  .card-stat-val {
    font-size: 24px;
    font-weight: 800;
    margin-top: 4px;
    font-family: 'Roboto Mono', monospace;
  }
  .card-stat-icon {
    font-size: 42px;
    opacity: 0.25;
  }

  /* Table Custom Style selaras dengan APBD & halaman lain */
  .table-custom {
    margin-bottom: 0;
  }
  .table-custom th {
    background-color: #f1f3f5 !important;
    color: #343a40 !important;
    font-weight: 700 !important;
    text-align: center;
    vertical-align: middle !important;
    border: 1px solid #dee2e6 !important;
    font-size: 13.5px;
    padding: 10px 12px !important;
  }
  .table-custom td {
    vertical-align: middle !important;
    border: 1px solid #dee2e6 !important;
    font-size: 13.5px;
    padding: 9px 12px !important;
    color: #212529;
  }
  .table-custom tbody tr:hover {
    background-color: #f8fafc;
  }

  .badge-rekening {
    background-color: #f1f5f9;
    color: #0f172a;
    border: 1px solid #cbd5e1;
    font-weight: 700;
    font-size: 13px;
    padding: 5px 10px;
    border-radius: 6px;
    display: inline-block;
    font-family: 'Roboto Mono', monospace;
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
    border: none;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .btn-action-edit {
    background-color: #f59e0b;
    color: #ffffff;
  }
  .btn-action-edit:hover {
    background-color: #d97706;
    color: #ffffff;
  }
  .btn-action-delete {
    background-color: #ef4444;
    color: #ffffff;
  }
  .btn-action-delete:hover {
    background-color: #dc2626;
    color: #ffffff;
  }

  /* Center Modal Vertically and Horizontally */
  .modal {
    text-align: center;
    padding: 0 !important;
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
    max-width: 760px;
    width: 92%;
    margin: 30px auto;
  }
  .modal-content {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    border: none;
  }
  .modal-header {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: #ffffff;
    padding: 16px 22px;
    border-bottom: none;
  }
  .modal-header .modal-title {
    color: #ffffff;
    font-weight: 700;
    font-size: 17px;
    margin: 0;
  }
  .modal-header .close {
    color: #ffffff;
    opacity: 0.85;
    text-shadow: none;
    font-size: 24px;
    margin-top: -3px;
  }
  .modal-header .close:hover {
    opacity: 1;
  }
  .modal-body {
    padding: 22px 24px;
    background: #ffffff;
  }
  .modal-footer {
    background-color: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 14px 22px;
  }

  /* Select2 Styling tweak for inside modal */
  .select2-container--default .select2-selection--single {
    height: 40px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 6px 10px;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 26px;
    color: #0f172a;
    font-weight: 600;
    font-size: 13.5px;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px;
  }
</style>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 25px; background:#fff;">
            
            <!-- Header Section -->
            <div class="basic-tb-hd" style="border-bottom: 2px solid #e9ecef; padding-bottom: 15px; margin-bottom: 20px;">
              <div class="header-page-title">
                <i class="fa fa-credit-card"></i>
                <span>PENDAPATAN</span>
              </div>
            </div>

            <!-- Stats Card (Hanya Kartu Pendapatan) -->
            <div class="row" style="margin-bottom: 15px;">
              <div class="col-md-5 col-sm-12">
                <div class="card-stat card-stat-green" style="margin-bottom: 0;">
                  <div>
                    <div class="card-stat-title">Pendapatan (Tahun <?= htmlspecialchars($TahunAktif) ?>)</div>
                    <div class="card-stat-val">Rp <?= number_format($TotalPendapatan, 0, ',', '.') ?></div>
                  </div>
                  <div class="card-stat-icon">
                    <i class="fa fa-money"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Toolbar Action & Filter -->
            <div class="row align-items-center" style="background: #fdfdfe; border: 1px solid #eef2f5; border-radius: 10px; padding: 15px; margin-bottom: 20px;">
              
              <!-- Filter Instansi (Jikalau Level 0/3) -->
              <?php if (!$IsRole4 && !empty($ListInstansi)): ?>
              <div class="col-md-5 col-sm-6" style="margin-bottom: 8px;">
                <label style="font-weight: 700; font-size: 13px; margin-bottom: 4px; display:block;">Perangkat Daerah:</label>
                <select id="filterInstansi" class="form-control" style="border-radius: 6px; font-weight: 600;" onchange="handleFilterChange()">
                  <?php foreach ($ListInstansi as $inst): ?>
                    <option value="<?= $inst['id'] ?>" <?= ($ActiveInstansiId == $inst['id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($inst['nama']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <?php endif; ?>

              <!-- Filter Tahun -->
              <div class="col-md-3 col-sm-6" style="margin-bottom: 8px;">
                <label style="font-weight: 700; font-size: 13px; margin-bottom: 4px; display:block;">Tahun Anggaran:</label>
                <select id="filterTahun" class="form-control" style="border-radius: 6px; font-weight: 700;" onchange="handleFilterChange()">
                  <?php foreach ($ListTahun as $th): ?>
                    <option value="<?= $th ?>" <?= ($TahunAktif == $th) ? 'selected' : '' ?>><?= $th ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="<?= (!$IsRole4 && !empty($ListInstansi)) ? 'col-md-4' : 'col-md-9' ?> col-sm-12 text-right" style="margin-top: 18px;">
                <?php if ($CanCrud): ?>
                  <button type="button" class="btn btn-success notika-btn-success" onclick="openAddModal()" style="border-radius: 6px; font-weight: 700; padding: 8px 20px; background-color: var(--brand-green-btn); border-color: var(--brand-green-btn);">
                    <i class="fa fa-plus-circle"></i> Pendapatan
                  </button>
                <?php endif; ?>
              </div>
            </div>

            <!-- Tabel Data Pendapatan -->
            <div class="table-responsive">
              <table id="tablePendapatan" class="table table-bordered table-striped table-hover table-custom" style="width: 100%;">
                <thead>
                  <tr>
                    <th style="width: <?= $CanCrud ? '18%' : '20%' ?>;">Rekening</th>
                    <th style="width: <?= $CanCrud ? '44%' : '50%' ?>;">Uraian</th>
                    <th style="width: <?= $CanCrud ? '13%' : '14%' ?>;">Keterangan</th>
                    <th style="width: <?= $CanCrud ? '16%' : '16%' ?>;">Nilai</th>
                    <?php if ($CanCrud): ?>
                    <th style="width: 9%;">Aksi</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($DataPendapatan)): ?>
                    <?php foreach ($DataPendapatan as $row): ?>
                      <tr data-id="<?= $row['id'] ?>" 
                          data-kode="<?= htmlspecialchars($row['kode_rekening']) ?>" 
                          data-uraian="<?= htmlspecialchars($row['uraian']) ?>" 
                          data-keterangan="<?= htmlspecialchars($row['keterangan'] ?? '') ?>" 
                          data-nilai="<?= (float)$row['nilai'] ?>">
                        <td class="text-center">
                          <span class="badge-rekening"><?= htmlspecialchars($row['kode_rekening']) ?></span>
                        </td>
                        <td><?= htmlspecialchars($row['uraian']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['keterangan'] ?: '-') ?></td>
                        <td class="text-right" style="font-weight: 700; font-family: 'Roboto Mono', monospace;">
                          Rp <?= number_format($row['nilai'], 0, ',', '.') ?>
                        </td>
                        <?php if ($CanCrud): ?>
                        <td class="text-center">
                          <button type="button" class="btn-action btn-action-edit" title="Edit" onclick="openEditModal(this)">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <button type="button" class="btn-action btn-action-delete" title="Hapus" onclick="confirmDelete(<?= $row['id'] ?>)">
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="<?= $CanCrud ? 5 : 4 ?>" style="text-align: center; padding: 25px; color: #64748b;">
                        <i class="fa fa-info-circle"></i> Belum ada data pendapatan untuk perangkat daerah dan tahun terpilih.
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
</div>

<?php if ($CanCrud): ?>
<!-- Modal Add / Edit Pendapatan (Centered Bootstrap Modal) -->
<div class="modal fade" id="modalPendapatan" role="dialog" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="formPendapatan" onsubmit="savePendapatan(event)">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="modalTitle">
            <i class="fa fa-plus-circle"></i> Tambah Pendapatan
          </h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="pendapatanId" name="id" value="">
          <input type="hidden" id="inputUraian" name="uraian" value="">
          <input type="hidden" name="id_instansi" value="<?= $ActiveInstansiId ?>">
          <input type="hidden" name="tahun" value="<?= $TahunAktif ?>">

          <!-- Dropdown Rekening (Awalan 4) -->
          <div class="form-group" style="margin-bottom: 16px;">
            <label style="font-weight: 700; font-size: 13.5px; color:#1e293b; margin-bottom:6px;">
              Nomor Rekening (Awalan 4) <span class="text-danger">*</span>
            </label>
            <select id="selectRekening" name="kode_rekening" class="form-control" style="width: 100%;" required>
              <option value="">-- Ketik untuk mencari rekening pendapatan (4...) --</option>
            </select>
            <small class="text-muted" style="font-size: 12px; margin-top: 4px; display: block;">
              Uraian akan terisi otomatis langsung dari nomor rekening yang dipilih.
            </small>
          </div>

          <!-- Keterangan (Kosong saat tambah) -->
          <div class="form-group" style="margin-bottom: 16px;">
            <label style="font-weight: 700; font-size: 13.5px; color:#1e293b; margin-bottom:6px;">
              Keterangan
            </label>
            <input type="text" class="form-control" id="inputKeterangan" name="keterangan" placeholder="Contoh: 1 Tahun" style="border-radius: 6px;">
          </div>

          <!-- Nilai (Kosong saat tambah) -->
          <div class="form-group" style="margin-bottom: 8px;">
            <label style="font-weight: 700; font-size: 13.5px; color:#1e293b; margin-bottom:6px;">
              Nilai (Rp) <span class="text-danger">*</span>
            </label>
            <div class="input-group">
              <span class="input-group-addon" style="font-weight: 700;">Rp</span>
              <input type="text" class="form-control" id="inputNilai" name="nilai" required placeholder="0" style="border-radius: 0 6px 6px 0; font-weight: 700; font-size: 15px;" onkeyup="formatCurrency(this)">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-success" id="btnSave" style="border-radius: 6px; font-weight: 700; background-color: var(--brand-green-btn); border-color: var(--brand-green-btn);">
            <i class="fa fa-save"></i> Simpan Pendapatan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  const baseURL = "<?= base_url() ?>";
  const activeInstansiId = "<?= $ActiveInstansiId ?>";
  const activeTahun = "<?= $TahunAktif ?>";

  $(document).ready(function() {
    // Inisialisasi Select2 AJAX untuk Rekening Pendapatan (Awalan 4)
    $('#selectRekening').select2({
      dropdownParent: $('#modalPendapatan'),
      ajax: {
        url: baseURL + 'Instansi/SearchRekening',
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            tipe: 'pendapatan',
            q: params.term || ''
          };
        },
        processResults: function (data) {
          return {
            results: data.results || []
          };
        },
        cache: true
      },
      placeholder: '-- Cari kode atau nama rekening (awalan 4)... --',
      minimumInputLength: 0,
      width: '100%'
    });

    // Otomatis isi Uraian saat nomor rekening dipilih
    $('#selectRekening').on('select2:select', function (e) {
      const data = e.params.data;
      if (data && data.uraian) {
        $('#inputUraian').val(data.uraian);
      }
    });
  });

  // Handle pergantian filter OPD / Tahun
  function handleFilterChange() {
    const th = $('#filterTahun').val() || activeTahun;
    let url = baseURL + 'Instansi/Pendapatan?tahun=' + th;
    const instEl = document.getElementById('filterInstansi');
    if (instEl) {
      url += '&instansi_id=' + instEl.value;
    }
    window.location.href = url;
  }

  // Format Input Currency Rupiah
  function formatCurrency(input) {
    let value = input.value.replace(/[^0-9]/g, '');
    if (value) {
      input.value = new Intl.NumberFormat('id-ID').format(value);
    } else {
      input.value = '';
    }
  }

  function numberToRp(num) {
    return new Intl.NumberFormat('id-ID').format(num);
  }

  // Buka Modal Tambah: kosongkan semua input
  function openAddModal() {
    $('#modalTitle').html('<i class="fa fa-plus-circle"></i> Tambah Pendapatan');
    $('#pendapatanId').val('');
    $('#inputUraian').val('');
    $('#inputKeterangan').val('');
    $('#inputNilai').val('');
    $('#selectRekening').val(null).trigger('change');
    $('#btnSave').html('<i class="fa fa-save"></i> Simpan Pendapatan');
    $('#modalPendapatan').modal('show');
  }

  // Buka Modal Edit
  function openEditModal(btn) {
    const tr = $(btn).closest('tr');
    const id = tr.data('id');
    const kode = tr.data('kode');
    const uraian = tr.data('uraian');
    const keterangan = tr.data('keterangan');
    const nilai = tr.data('nilai');

    $('#modalTitle').html('<i class="fa fa-pencil"></i> Edit Pendapatan');
    $('#pendapatanId').val(id);
    $('#inputUraian').val(uraian);
    $('#inputKeterangan').val(keterangan);
    $('#inputNilai').val(numberToRp(nilai));

    // Preselect rekening di Select2
    const option = new Option(kode + ' - ' + uraian, kode, true, true);
    $('#selectRekening').empty().append(option).trigger('change');

    $('#btnSave').html('<i class="fa fa-save"></i> Perbarui Pendapatan');
    $('#modalPendapatan').modal('show');
  }

  // Simpan data (Tambah / Edit) via AJAX
  function savePendapatan(e) {
    e.preventDefault();

    const kodeRek = $('#selectRekening').val();
    if (!kodeRek) {
      Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Nomor rekening harus dipilih.' });
      return;
    }

    const formData = $('#formPendapatan').serialize();
    $('#btnSave').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

    $.ajax({
      url: baseURL + 'Instansi/SavePendapatan',
      type: 'POST',
      data: formData,
      dataType: 'json',
      success: function(res) {
        $('#btnSave').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Pendapatan');
        if (res.status === 'success') {
          $('#modalPendapatan').modal('hide');
          location.reload();
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal', text: res.message || 'Terjadi kesalahan.' });
        }
      },
      error: function() {
        $('#btnSave').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Pendapatan');
        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghubungi server.' });
      }
    });
  }

  // Hapus data Pendapatan
  function confirmDelete(id) {
    Swal.fire({
      title: 'Hapus Rekening Pendapatan?',
      text: 'Data yang dihapus tidak dapat dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#64748b',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: baseURL + 'Instansi/DeletePendapatan',
          type: 'POST',
          data: { id: id },
          dataType: 'json',
          success: function(res) {
            if (res.status === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Dihapus!',
                text: res.message,
                timer: 1500,
                showConfirmButton: false
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({ icon: 'error', title: 'Gagal', text: res.message || 'Gagal menghapus.' });
            }
          },
          error: function() {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghubungi server.' });
          }
        });
      }
    });
  }
</script>
