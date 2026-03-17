<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Di bagian head tambahkan CSS Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      
      <!-- HEADER NAVIGASI -->
      <div style="background: white; padding: 12px 20px; margin-bottom: 25px; border: 1px solid #dee2e6; border-radius: 5px;">
        <div style="display: flex; gap: 25px; flex-wrap: wrap;">
          <a href="<?=base_url('Daerah/Ultimate_outcome_pd')?>" class="nav-link">ULTIMATE OUTCOME PD (Level 1)</a>
          <a href="<?=base_url('Daerah/Intermediate_outcome_pd')?>" class="nav-link">INTERMEDIATE OUTCOME PD (Level 2)</a>
          <a href="<?=base_url('Daerah/Immediate_outcome_pd')?>" class="nav-link active">IMMEDIATE OUTCOME PD (Level 3)</a>
          <a href="<?=base_url('Daerah/Output_pd')?>" class="nav-link">OUTPUT PD (Level 4)</a>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="data-table-list">

            <!-- ================= FILTER WILAYAH ================= -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

              <div class="form-example-wrap" style="margin-bottom: 20px;">
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row filter-row">

                      <div class="col-lg-3 col-md-6">
                        <label><b>Provinsi</b></label>
                        <select class="form-control" id="Provinsi">
                          <option value="">Pilih Provinsi</option>
                          <?php foreach ($Provinsi as $prov) { ?>
                            <option value="<?= html_escape($prov['Kode']) ?>">
                              <?= html_escape($prov['Nama']) ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="col-lg-3 col-md-6">
                        <label><b>Kab/Kota</b></label>
                        <select class="form-control" id="KabKota">
                          <option value="">Pilih Kab/Kota</option>
                        </select>
                      </div>

                      <div class="col-lg-2 col-md-6">
                        <div style="margin-top: 28px;">
                          <button class="btn btn-primary btn-block" id="Filter">
                            <b>Filter</b>
                          </button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <?php if (!empty($KodeWilayah)) { ?>
                <?php
                  $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                  $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                ?>
                <div class="alert alert-info" style="margin-bottom: 20px;">
                  <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                </div>
              <?php } ?>

            <?php } ?>
            <!-- ================= END FILTER ================= -->
            <br>

            <!-- TOMBOL TAMBAH -->
            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              <div class="basic-tb-hd mb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#ModalLevel3">
                  <i class="fa fa-plus"></i> Tambah IMMEDIATE OUTCOME PD (Level 3)
                </button>
              </div>
            <?php } ?>

            <!-- TABEL DENGAN KOLOM PELAKSANA -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="40" class="text-center">NO</th>
                    <th>Intermediate Outcome (Level 2)</th>
                    <th>Kinerja Immediate & Pelaksana</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th width="120" class="text-center">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($items)) { $no = 1; foreach($items as $row){ 
                    // Ambil nama pelaksana dari tabel akun_karyawan
                    $nama_pelaksana = '';
                    $detail_pelaksana = '';
                    if (!empty($row['pelaksana'])) {
                        $pelaksana = $this->db
                            ->select('nama, jabatan')
                            ->where('id', $row['pelaksana'])
                            ->get('akun_karyawan')
                            ->row();
                        if ($pelaksana) {
                            $nama_pelaksana = $pelaksana->nama;
                            $detail_pelaksana = $pelaksana->jabatan;
                        }
                    }
                  ?>
                    <tr data-id="<?= (int)$row['id'] ?>">
                      <td class="text-center align-middle"><?= $no++ ?></td>
                      <td class="align-middle">
                        <small><?= nl2br(html_escape(substr($row['intermediate_kinerja'] ?? '—', 0, 150))) . (strlen($row['intermediate_kinerja'] ?? '') > 150 ? '...' : '') ?></small>
                      </td>
                      <td class="align-middle">
                        <strong><?= nl2br(html_escape($row['kinerja'] ?? '—')) ?></strong>
                        <?php if (!empty($nama_pelaksana)): ?>
                          <br>
                        <?php endif; ?>
                      </td>
                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <td class="text-center align-middle">
                          <button class="btn btn-sm btn-primary btn-edit" 
                                  data-id="<?= $row['id'] ?>"
                                  title="Edit">
                            <i class="fa fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger btn-hapus" 
                                  data-id="<?= $row['id'] ?>"
                                  title="Hapus">
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php } } else { ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? 4 : 3 ?>" class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x fa-3x mb-3 d-block opacity-50"></i>
                        Belum ada data Immediate Outcome Perangkat Daerah<br>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <button class="btn btn-success mt-3" data-toggle="modal" data-target="#ModalLevel3">
                            <i class="fa fa-plus"></i> Tambah Data Pertama
                          </button>
                        <?php } ?>
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
</div>

<!-- MODAL LEVEL 3 -->
<div class="modal fade" id="ModalLevel3" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">IMMEDIATE OUTCOME PERANGKAT DAERAH (Level 3)</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="ItemId">
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label><b>Tautan ke Intermediate Outcome (Level 2)</b></label>
              <select id="IntermediateId" class="form-control">
                <option value="">— Pilih Intermediate Outcome —</option>
                <?php foreach ($intermediate_options as $opt): ?>
                  <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'],0,150)) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label><b>Kinerja Immediate</b> <span class="text-danger">*</span></label>
          <textarea id="Kinerja" class="form-control" rows="3" placeholder="Masukkan kinerja immediate..." required></textarea>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label><b>Indikator Kinerja</b></label>
              <div id="IndikatorList"></div>
              <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddIndikator">
                <i class="fa fa-plus"></i> Tambah Indikator
              </button>
            </div>
          </div>
          <div class="col-md-6">
            <!-- Dinas / Instansi - WAJIB PILIH DULU -->
            <div class="form-group">
              <label><b>Pilih Dinas / Instansi</b> <span class="text-danger">*</span></label>
              <div class="mb-2 text-muted small">
                <em>Pilih Dinas terlebih dahulu untuk melihat Pelaksana</em>
              </div>
              <select id="DinasFilter" class="form-control select2-dinas" style="width: 100%;" required>
                <option value="">-- Pilih Dinas --</option>
              </select>
            </div>

            <!-- Pelaksana dari Database - Hanya muncul setelah Dinas dipilih -->
            <div class="form-group mt-3" id="PelaksanaGroup" style="display: none;">
              <label><b>Pelaksana / Urusan</b></label>
              <div class="mb-2 text-muted small">
                <em>Pilih Pelaksana (Level 4 - Karyawan) dari Dinas terpilih</em>
              </div>
              <select id="Pelaksana" class="form-control select2-pelaksana" style="width: 100%;">
                <option value="">-- Pilih Pelaksana --</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label><b>Inovasi Daerah</b></label>
              <div id="InovasiList"></div>
              <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddInovasi">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label><b>Outcome Inovasi</b></label>
              <div id="OutcomeList"></div>
              <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddOutcome">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label><b>Output Inovasi</b></label>
              <div id="OutputList"></div>
              <button type="button" class="btn btn-success btn-sm mt-2" id="BtnAddOutput">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
          </div>
        </div>
        
        <!-- CROSSCUTTING -->
        <div class="form-group">
          <label><b>Crosscutting Dengan Perangkat Daerah</b></label>
          <div class="table-responsive">
            <table class="table table-bordered table-sm">
              <thead class="bg-primary text-white">
                <tr>
                  <th class="text-center">Perangkat Daerah</th>
                  <th class="text-center">Keterangan</th>
                  <th width="50"></th>
                </tr>
              </thead>
              <tbody id="CrosscuttingBody"></tbody>
            </table>
          </div>
          <button type="button" class="btn btn-success btn-sm" id="BtnAddCrosscutting">
            <i class="fa fa-plus"></i> Tambah Crosscutting
          </button>
        </div>
        
        <div class="text-right mt-4">
          <button class="btn btn-primary" id="BtnSimpan">Simpan</button>
          <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .nav-link {
    color: #6c757d;
    text-decoration: none;
    padding: 5px 0;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
    font-weight: 500;
  }
  .nav-link:hover {
    color: #007bff;
    transform: translateY(-2px);
    border-bottom-color: #007bff;
  }
  .nav-link.active {
    color: #007bff;
    border-bottom: 2px solid #007bff;
  }
  .field-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
  }
  .field-row .form-control {
    flex: 1;
  }
  .table td { 
    padding: 12px !important; 
    vertical-align: middle !important; 
  }
  .modal {
    padding-top: 70px;
  }
  .badge {
    padding: 5px 10px;
    font-size: 11px;
  }
  .badge-success { background-color: #28a745; color: white; }
  .badge-secondary { background-color: #6c757d; color: white; }
  .badge-danger { background-color: #dc3545; color: white; }
  .modal-loading {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.9);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    flex-direction: column;
  }
  
  /* Select2 Custom Styling */
  .select2-container--default .select2-selection--single {
    height: 38px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    background-color: #fff;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 36px;
    padding-left: 12px;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
  }
  .select2-dropdown {
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }
  .select2-results__option--highlighted {
    background-color: #007bff !important;
  }
  
  /* Styling untuk list di tabel */
  .list-unstyled {
    padding-left: 0;
    list-style: none;
  }
  .list-unstyled li {
    margin-bottom: 5px;
    padding: 3px 0;
    border-bottom: 1px dashed #eee;
  }
  .list-unstyled li:last-child {
    border-bottom: none;
  }
  .list-unstyled li i {
    margin-right: 5px;
  }
</style>

<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/jquery.dataTables.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var daftarPerangkat = [];

$(document).ready(function() {
  
  $.ajaxSetup({
    beforeSend: function(xhr, settings) {
      if (settings.type.toUpperCase() === 'POST') {
        settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
      }
    }
  });

  // ==================== LOAD DROPDOWN DINAS ====================
  function loadDinasOptions(selectedDinasId = '') {
    $.ajax({
      url: BaseURL + 'Daerah/Immediate_outcome_pd_get_daftar_dinas',
      type: 'GET',
      dataType: 'json',
      beforeSend: function() {
        $('#DinasFilter').html('<option value="">Loading...</option>');
      },
      success: function(data) {
        let options = '<option value="">-- Pilih Dinas --</option>';
        
        if (data.length > 0) {
          $.each(data, function(index, item) {
            let selected = (item.id == selectedDinasId) ? 'selected' : '';
            options += `<option value="${item.id}" ${selected}>${item.nama}</option>`;
          });
        } else {
          options += '<option value="" disabled>Tidak ada data Dinas</option>';
        }
        
        $('#DinasFilter').html(options);
        
        // Inisialisasi Select2 untuk Dinas
        if ($('#DinasFilter').hasClass('select2-hidden-accessible')) {
          $('#DinasFilter').select2('destroy');
        }
        $('#DinasFilter').select2({
          placeholder: 'Pilih Dinas...',
          dropdownParent: $('#ModalLevel3'),
          width: '100%',
          minimumResultsForSearch: -1
        });
        
        // Tampilkan/Sembunyikan group pelaksana berdasarkan selected value
        if (selectedDinasId) {
          $('#PelaksanaGroup').show();
        } else {
          $('#PelaksanaGroup').hide();
        }
      },
      error: function() {
        $('#DinasFilter').html('<option value="">Gagal memuat data</option>');
      }
    });
  }

  // ==================== LOAD PELAKSANA BERDASARKAN DINAS ====================
  function loadPelaksanaByDinas(dinasId, selectedPelaksanaId = '') {
    if (!dinasId) {
      $('#PelaksanaGroup').hide();
      $('#Pelaksana').html('<option value="">-- Pilih Pelaksana --</option>');
      return;
    }
    
    $('#PelaksanaGroup').show();
    
    $.ajax({
      url: BaseURL + 'Daerah/Immediate_outcome_pd_get_pelaksana_by_dinas',
      type: 'POST',
      data: { dinas_id: dinasId },
      dataType: 'json',
      beforeSend: function() {
        $('#Pelaksana').html('<option value="">Loading...</option>');
      },
      success: function(data) {
        let options = '<option value="">-- Pilih Pelaksana --</option>';
        
        if (data.length > 0) {
          $.each(data, function(index, item) {
            let selected = (item.id == selectedPelaksanaId) ? 'selected' : '';
            
            // Format tampilan: Nama - Jabatan
            let displayText = item.nama;
            if (item.jabatan) {
              displayText += ' - ' + item.jabatan;
            }
            if (item.nama_dinas) {
              displayText += ' (' + item.nama_dinas + ')';
            }
            
            options += `<option value="${item.id}" ${selected}>${displayText}</option>`;
          });
        } else {
          options += '<option value="" disabled>Tidak ada pelaksana untuk dinas ini</option>';
        }
        
        $('#Pelaksana').html(options);
        
        // Re-inisialisasi Select2 untuk Pelaksana
        if ($('#Pelaksana').hasClass('select2-hidden-accessible')) {
          $('#Pelaksana').select2('destroy');
        }
        $('#Pelaksana').select2({
          placeholder: 'Pilih Pelaksana...',
          dropdownParent: $('#ModalLevel3'),
          width: '100%',
          minimumResultsForSearch: -1
        });
        
        // Set value setelah Select2 diinisialisasi
        if (selectedPelaksanaId) {
          $('#Pelaksana').val(selectedPelaksanaId).trigger('change');
        }
      },
      error: function() {
        $('#Pelaksana').html('<option value="">Gagal memuat data</option>');
      }
    });
  }

  // ==================== SAAT DINAS BERUBAH ====================
  $('#DinasFilter').on('change', function() {
    let dinasId = $(this).val();
    loadPelaksanaByDinas(dinasId, '');
  });

  // ==================== LOAD PERANGKAT DAERAH ====================
  function loadPerangkatDaerah(callback) {
    console.log('Loading perangkat daerah...');
    
    $.ajax({
      url: BaseURL + "Daerah/Immediate_outcome_pd_get_perangkat_daerah",
      type: "GET",
      dataType: "json",
      success: function(res) {
        console.log('Response perangkat daerah:', res);
        
        if (res && res.status === 'success') {
          daftarPerangkat = res.data;
          console.log('Jumlah data perangkat daerah:', daftarPerangkat.length);
          
          if (daftarPerangkat.length === 0) {
            console.warn('Tidak ada data perangkat daerah');
          }
          
          if (callback) callback();
        } else {
          console.error('Gagal load perangkat daerah:', res);
          if (callback) callback();
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error load perangkat daerah:', error);
        if (callback) callback();
      }
    });
  }
  
  // Load perangkat daerah
  loadPerangkatDaerah();

  // ==================== FUNGSI TAMBAH BARIS ====================
  function addField(container, val = '', placeholder = '') {
    // Escape value untuk keamanan
    let escapedVal = val.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    
    $(container).append(`
      <div class="field-row">
        <input type="text" class="form-control" value="${escapedVal}" placeholder="${placeholder}">
        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
      </div>
    `);
  }

  function addCrosscutting(pd_id = '', keterangan = '') {
    let options = '<option value="">-- Pilih Perangkat Daerah --</option>';
    
    if (daftarPerangkat && daftarPerangkat.length > 0) {
      daftarPerangkat.forEach(item => {
        if (item.id && item.nama) {
          // Convert ke string untuk perbandingan
          let selected = (String(item.id) === String(pd_id)) ? 'selected' : '';
          options += `<option value="${item.id}" ${selected}>${item.nama}</option>`;
        }
      });
    } else {
      options += `<option value="" disabled>Data perangkat daerah tidak tersedia</option>`;
    }
    
    // Escape keterangan
    let escapedKet = keterangan.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    
    $("#CrosscuttingBody").append(`
      <tr>
        <td>
          <select class="form-control form-control-sm pd-select">
            ${options}
          </select>
        </td>
        <td>
          <input type="text" class="form-control form-control-sm" value="${escapedKet}" placeholder="Keterangan crosscutting">
        </td>
        <td class="text-center">
          <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
        </td>
      </tr>
    `);
  }

  // Hapus baris
  $(document).on("click", ".remove-row", function() {
    $(this).closest(".field-row, tr").remove();
  });

  // ==================== TOMBOL TAMBAH ====================
  $("#BtnAddIndikator").click(() => addField("#IndikatorList", '', 'Indikator Kinerja'));
  $("#BtnAddInovasi").click(() => addField("#InovasiList", '', 'Inovasi Daerah'));
  $("#BtnAddOutcome").click(() => addField("#OutcomeList", '', 'Outcome Inovasi'));
  $("#BtnAddOutput").click(() => addField("#OutputList", '', 'Output Inovasi'));
  $("#BtnAddCrosscutting").click(() => addCrosscutting());

  // ==================== RESET MODAL ====================
  $('#ModalLevel3').on('show.bs.modal', function(e) {
    // Only reset if opening for add (not edit)
    if (!$(e.relatedTarget) || !$(e.relatedTarget).hasClass('btn-edit')) {
      $('#ItemId').val('');
      $('#IntermediateId').val('');
      $('#Kinerja').val('');
      $('#DinasFilter').val('').trigger('change');
      
      // Load dinas options
      loadDinasOptions('');
      
      // Sembunyikan group pelaksana
      $('#PelaksanaGroup').hide();
      
      // Clear all containers
      $('#IndikatorList').empty();
      $('#InovasiList').empty();
      $('#OutcomeList').empty();
      $('#OutputList').empty();
      $('#CrosscuttingBody').empty();
      
      // Add default empty rows
      addField("#IndikatorList", '', 'Indikator Kinerja');
    }
  });

  // ==================== EDIT DATA ====================
  $(document).on('click', '.btn-edit', function() {
    let id = $(this).data('id');
    
    // Show modal and loading indicator
    $('#ModalLevel3').modal('show');
    
    // Add loading overlay
    $('.modal-content').css('position', 'relative');
    $('#ModalLevel3 .modal-content').append('<div class="modal-loading"><i class="fa fa-spinner fa-spin fa-3x text-primary"></i><br><span class="mt-2">Memuat data...</span></div>');
    
    $.ajax({
      url: BaseURL + 'Daerah/Immediate_outcome_pd_get',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(res) {
        // Remove loading overlay
        $('.modal-loading').remove();
        
        if (res.status === 'error') {
          alert(res.message);
          $('#ModalLevel3').modal('hide');
          return;
        }
        
        let data = res.data;
        console.log('Data loaded:', data);
        
        // Fill basic fields
        $('#ItemId').val(data.id);
        $('#IntermediateId').val(data.intermediate_outcome_id || '');
        $('#Kinerja').val(data.kinerja || '');
        
        // Reset containers
        $('#IndikatorList').empty();
        $('#InovasiList').empty();
        $('#OutcomeList').empty();
        $('#OutputList').empty();
        $('#CrosscuttingBody').empty();
        
        // Load dinas options terlebih dahulu
        loadDinasOptions('');
        
        // Untuk mendapatkan dinas_id dari pelaksana
        if (data.pelaksana) {
          $.ajax({
            url: BaseURL + 'Daerah/Immediate_outcome_pd_get_pelaksana_detail',
            type: 'POST',
            data: { id: data.pelaksana },
            dataType: 'json',
            success: function(detail) {
              if (detail && detail.dinas_id) {
                // Parse dinas_id (mungkin berisi multiple ID dipisah koma)
                let dinasIds = detail.dinas_id.split(',');
                if (dinasIds.length > 0 && dinasIds[0]) {
                  // Set dinas filter ke ID pertama
                  $('#DinasFilter').val(dinasIds[0]).trigger('change');
                  // Load pelaksana berdasarkan dinas dan set selected
                  setTimeout(function() {
                    loadPelaksanaByDinas(dinasIds[0], data.pelaksana);
                  }, 500);
                } else {
                  // Jika tidak ada dinas, sembunyikan group pelaksana
                  $('#PelaksanaGroup').hide();
                }
              } else {
                // Jika tidak ada data, sembunyikan group pelaksana
                $('#PelaksanaGroup').hide();
              }
            },
            error: function() {
              $('#PelaksanaGroup').hide();
            }
          });
        } else {
          $('#PelaksanaGroup').hide();
        }
        
        // ========== INDIKATOR ==========
        if (data.indikator) {
          if (typeof data.indikator === 'string') {
            let indikatorList = data.indikator.split('|||');
            indikatorList.forEach(v => {
              if (v && v.trim()) {
                addField("#IndikatorList", v.trim(), 'Indikator Kinerja');
              }
            });
          } else if (Array.isArray(data.indikator)) {
            data.indikator.forEach(v => {
              if (v && v.trim()) {
                addField("#IndikatorList", v.trim(), 'Indikator Kinerja');
              }
            });
          }
        }
        
        // Add at least one empty field if no data
        if ($('#IndikatorList .field-row').length === 0) {
          addField("#IndikatorList", '', 'Indikator Kinerja');
        }
        
        // ========== INOVASI ==========
        if (data.inovasi_daerah) {
          if (typeof data.inovasi_daerah === 'string') {
            let inovasiList = data.inovasi_daerah.split('|||');
            inovasiList.forEach(v => {
              if (v && v.trim()) {
                addField("#InovasiList", v.trim(), 'Inovasi Daerah');
              }
            });
          } else if (Array.isArray(data.inovasi_daerah)) {
            data.inovasi_daerah.forEach(v => {
              if (v && v.trim()) {
                addField("#InovasiList", v.trim(), 'Inovasi Daerah');
              }
            });
          }
        }
        
        // ========== OUTCOME INOVASI ==========
        if (data.outcome_inovasi) {
          if (typeof data.outcome_inovasi === 'string') {
            let outcomeList = data.outcome_inovasi.split('|||');
            outcomeList.forEach(v => {
              if (v && v.trim()) {
                addField("#OutcomeList", v.trim(), 'Outcome Inovasi');
              }
            });
          } else if (Array.isArray(data.outcome_inovasi)) {
            data.outcome_inovasi.forEach(v => {
              if (v && v.trim()) {
                addField("#OutcomeList", v.trim(), 'Outcome Inovasi');
              }
            });
          }
        }
        
        // ========== OUTPUT INOVASI ==========
        if (data.output_inovasi) {
          if (typeof data.output_inovasi === 'string') {
            let outputList = data.output_inovasi.split('|||');
            outputList.forEach(v => {
              if (v && v.trim()) {
                addField("#OutputList", v.trim(), 'Output Inovasi');
              }
            });
          } else if (Array.isArray(data.output_inovasi)) {
            data.output_inovasi.forEach(v => {
              if (v && v.trim()) {
                addField("#OutputList", v.trim(), 'Output Inovasi');
              }
            });
          }
        }
        
        // ========== CROSSCUTTING ==========
        if (data.crosscutting_pd || data.crosscutting_keterangan) {
          try {
            let pd_list = data.crosscutting_pd;
            let ket_list = data.crosscutting_keterangan;
            
            // Parse if still JSON string
            if (pd_list && typeof pd_list === 'string') {
              pd_list = JSON.parse(pd_list);
            }
            if (ket_list && typeof ket_list === 'string') {
              ket_list = JSON.parse(ket_list);
            }
            
            if (pd_list && ket_list && Array.isArray(pd_list) && Array.isArray(ket_list)) {
              for (let i = 0; i < pd_list.length; i++) {
                addCrosscutting(pd_list[i], ket_list[i] || '');
              }
            }
          } catch(e) {
            console.error('Error parsing crosscutting:', e);
          }
        }
      },
      error: function(xhr, status, error) {
        $('.modal-loading').remove();
        alert('Error loading data: ' + error);
        $('#ModalLevel3').modal('hide');
      }
    });
  });

  // ==================== SIMPAN DATA ====================
  $('#BtnSimpan').click(function() {
    let id = $('#ItemId').val();
    let intermediate_id = $('#IntermediateId').val();
    let kinerja = $('#Kinerja').val().trim();
    let pelaksana_id = $('#Pelaksana').val();
    
    if (!kinerja) {
      alert('Kinerja wajib diisi!');
      $('#Kinerja').focus();
      return;
    }
    
    // Show loading on button
    let $btn = $(this);
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
    
    // Kumpulkan data
    let indikator = [], inovasi = [], outcome = [], output = [];
    
    $('#IndikatorList input').each(function() { 
      let v = $(this).val().trim(); 
      if(v) indikator.push(v); 
    });
    
    $('#InovasiList input').each(function() { 
      let v = $(this).val().trim(); 
      if(v) inovasi.push(v); 
    });
    
    $('#OutcomeList input').each(function() { 
      let v = $(this).val().trim(); 
      if(v) outcome.push(v); 
    });
    
    $('#OutputList input').each(function() { 
      let v = $(this).val().trim(); 
      if(v) output.push(v); 
    });
    
    let cross_pd = [], cross_ket = [];
    $('#CrosscuttingBody tr').each(function() {
      let pd = $(this).find('.pd-select').val();
      let ket = $(this).find('td:eq(1) input').val().trim();
      if (pd && ket) {
        cross_pd.push(pd);
        cross_ket.push(ket);
      }
    });
    
    $.ajax({
      url: BaseURL + 'Daerah/Immediate_outcome_pd_simpan',
      type: 'POST',
      data: {
        id: id,
        intermediate_id: intermediate_id,
        kinerja: kinerja,
        pelaksana: pelaksana_id,
        indikator: indikator,
        inovasi_daerah: inovasi.join('|||'),
        outcome_inovasi: outcome.join('|||'),
        output_inovasi: output.join('|||'),
        crosscutting_pd: cross_pd,
        crosscutting_ket: cross_ket
      },
      dataType: 'json',
      success: function(res) {
        $btn.prop('disabled', false).html('Simpan');
        
        if (res.status === 'success') {
          alert(res.message);
          location.reload();
        } else {
          alert(res.message || 'Gagal menyimpan');
        }
      },
      error: function(xhr, status, error) {
        $btn.prop('disabled', false).html('Simpan');
        alert('Error: ' + error);
      }
    });
  });

  // ==================== HAPUS DATA ====================
  $(document).on('click', '.btn-hapus', function() {
    if (!confirm('Yakin menghapus data ini?')) return;
    
    let id = $(this).data('id');
    
    $.post(BaseURL + 'Daerah/Immediate_outcome_pd_hapus', {id: id}, function(res) {
      if (res.status === 'success') {
        alert(res.message);
        location.reload();
      } else {
        alert(res.message || 'Gagal menghapus');
      }
    }, 'json');
  });

  // ==================== HELPER FUNCTION ====================
  function nl2br(str) {
    return str ? String(str).replace(/\n/g, '<br>') : '—';
  }

  // ==================== FILTER WILAYAH ====================
  $("#Provinsi").change(function() {
    if ($(this).val() === "") {
      $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
      return;
    }

    $.ajax({
      url: BaseURL + "Daerah/GetListKabKota",
      type: "POST",
      data: { Kode: $(this).val() },
      beforeSend: function() { $("#KabKota").prop('disabled', true); },
      success: function(res) {
        var Data = (typeof res === 'string') ? JSON.parse(res) : res;
        var KabKota = '<option value="">Pilih Kab/Kota</option>';

        if (Data.length > 0) {
          for (let i = 0; i < Data.length; i++) {
            KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
          }
        }

        $("#KabKota").html(KabKota).prop('disabled', false);
      },
      error: function() {
        alert("Gagal memuat data Kab/Kota");
        $("#KabKota").prop('disabled', false);
      }
    });
  });

  $("#Filter").click(function() {
    if ($("#Provinsi").val() === "") return alert("Mohon Pilih Provinsi");
    if ($("#KabKota").val() === "") return alert("Mohon Pilih Kab/Kota");

    var kodeWilayah = $("#KabKota").val();

    $.ajax({
      url: BaseURL + "Daerah/SetTempKodeWilayah",
      type: "POST",
      data: { KodeWilayah: kodeWilayah },
      beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
      success: function(res) {
        if (res === '1') {
          window.location.reload();
        } else {
          alert(res || "Gagal menyimpan filter wilayah!");
          $("#Filter").prop('disabled', false).text('Filter');
        }
      },
      error: function() {
        alert("Gagal menghubungi server!");
        $("#Filter").prop('disabled', false).text('Filter');
      }
    });
  });

  // Populate kab/kota on page load jika KodeWilayah sudah ada
  <?php if (!empty($KodeWilayah)) { ?>
    var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
    var kodeKab = "<?= $KodeWilayah ?>";
    $("#Provinsi").val(kodeProv).trigger('change');
    
    // Setelah kab/kota di-load, pilih yang sesuai
    setTimeout(function() {
      $("#KabKota").val(kodeKab);
    }, 500);
  <?php } ?>

});
</script>