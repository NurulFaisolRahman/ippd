<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      
      <!-- HEADER NAVIGASI -->
      <div style="background: white; padding: 12px 20px; margin-bottom: 25px; border: 1px solid #dee2e6; border-radius: 5px;">
        <div style="display: flex; gap: 25px; flex-wrap: wrap;">
          <a href="<?=base_url('Daerah/Ultimate_outcome_pd')?>" class="nav-link">ULTIMATE OUTCOME PD (Level 1)</a>
          <a href="<?=base_url('Daerah/Intermediate_outcome_pd')?>" class="nav-link active">INTERMEDIATE OUTCOME PD (Level 2)</a>
          <a href="<?=base_url('Daerah/Immediate_outcome_pd')?>" class="nav-link">IMMEDIATE OUTCOME PD (Level 3)</a>
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
                <button class="btn btn-success" data-toggle="modal" data-target="#ModalLevel2">
                  <i class="fa fa-plus"></i> Tambah INTERMEDIATE OUTCOME PD (Level 2)
                </button>
              </div>
            <?php } ?>

            <!-- TABEL -->
            <div class="table-responsive">
            <table id="data-table-basic" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="40" class="text-center">NO</th>
                    <th>Ultimate Outcome (Level 1)</th>
                    <th>Kinerja Strategis Sektor dan aksi</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                    <th width="100" class="text-center">AKSI</th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($items)) { $no = 1; foreach($items as $row){ ?>
                    <tr data-id="<?= (int)$row['id'] ?>">
                    <td class="text-center align-middle"><?= $no++ ?></td>
                    <td class="align-middle">
                        <small><?= nl2br(html_escape(substr($row['ultimate_kinerja'] ?? '—', 0, 100))) . (strlen($row['ultimate_kinerja'] ?? '') > 100 ? '...' : '') ?></small>
                    </td>
                    <td class="align-middle">
                        <!-- Kinerja Strategis Sektor -->
                        <div> <?= nl2br(html_escape($row['kinerja'] ?? '—')) ?></div>
                        
                    </td>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <td class="text-center align-middle">
                        <button class="btn btn-sm btn-primary btn-edit" 
                                data-id="<?= $row['id'] ?>">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $row['id'] ?>">
                            <i class="fa fa-trash"></i>
                        </button>
                        </td>
                    <?php } ?>
                    </tr>
                <?php } } else { ?>
                    <tr>
                    <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? 4 : 3 ?>" class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x fa-3x mb-3 d-block opacity-50"></i>
                        Belum ada data Intermediate Outcome Perangkat Daerah<br>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <button class="btn btn-success mt-3" data-toggle="modal" data-target="#ModalLevel2">
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

<!-- MODAL LEVEL 2 -->
<div class="modal fade" id="ModalLevel2" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">INTERMEDIATE OUTCOME PERANGKAT DAERAH (Level 2)</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="ItemId">
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label><b>Tautan ke Ultimate Outcome (Level 1)</b></label>
              <select id="UltimateId" class="form-control">
                <option value="">— Pilih Ultimate Outcome —</option>
                <?php foreach ($ultimate_options as $opt): ?>
                  <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'],0,150)) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label><b>Kinerja Strategis Sektor</b> <span class="text-danger">*</span></label>
          <textarea id="Kinerja" class="form-control" rows="3" placeholder="Masukkan kinerja strategis sektor..." required></textarea>
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
            <div class="form-group">
              <label><b>Pelaksana / Urusan</b></label>
              <select id="Pelaksana" class="form-control">
                <option value="Tinggi">Tinggi</option>
                <option value="Sedang" selected>Sedang</option>
                <option value="Rendah">Rendah</option>
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
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Detail Intermediate Outcome PD</h4>
      </div>
      <div class="modal-body" id="DetailContent">
        <div class="text-center py-4">
          <i class="fa fa-spinner fa-spin fa-2x"></i> Memuat data...
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" id="BtnHapusIsi" style="display:none;">Hapus Isi Level Ini</button>
        <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
    padding: 8px !important; 
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
  }
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

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

  // ==================== LOAD PERANGKAT DAERAH ====================
  function loadPerangkatDaerah(callback) {
    console.log('Loading perangkat daerah...');
    
    $.ajax({
      url: BaseURL + "Daerah/Intermediate_outcome_pd_get_perangkat_daerah",
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
  $('#ModalLevel2').on('show.bs.modal', function(e) {
    // Only reset if opening for add (not edit)
    if (!$(e.relatedTarget) || !$(e.relatedTarget).hasClass('btn-edit')) {
      $('#ItemId').val('');
      $('#UltimateId').val('');
      $('#Kinerja').val('');
      $('#Pelaksana').val('Sedang');
      
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
    $('#ModalLevel2').modal('show');
    
    // Add loading overlay
    $('.modal-content').css('position', 'relative');
    $('#ModalLevel2 .modal-content').append('<div class="modal-loading"><i class="fa fa-spinner fa-spin fa-3x text-primary"></i><br><span class="mt-2">Memuat data...</span></div>');
    
    $.ajax({
      url: BaseURL + 'Daerah/Intermediate_outcome_pd_get',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(res) {
        // Remove loading overlay
        $('.modal-loading').remove();
        
        if (res.status === 'error') {
          alert(res.message);
          $('#ModalLevel2').modal('hide');
          return;
        }
        
        let data = res.data;
        console.log('Data loaded:', data);
        
        // Fill basic fields
        $('#ItemId').val(data.id);
        $('#UltimateId').val(data.ultimate_outcome_id || '');
        $('#Kinerja').val(data.kinerja || '');
        $('#Pelaksana').val(data.pelaksana_urutan || 'Sedang');
        
        // Clear all containers
        $('#IndikatorList').empty();
        $('#InovasiList').empty();
        $('#OutcomeList').empty();
        $('#OutputList').empty();
        $('#CrosscuttingBody').empty();
        
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
        $('#ModalLevel2').modal('hide');
      }
    });
  });

  // ==================== SIMPAN DATA ====================
  $('#BtnSimpan').click(function() {
    let id = $('#ItemId').val();
    let ultimate_id = $('#UltimateId').val();
    let kinerja = $('#Kinerja').val().trim();
    let pelaksana = $('#Pelaksana').val();
    
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
      url: BaseURL + 'Daerah/Intermediate_outcome_pd_simpan',
      type: 'POST',
      data: {
        id: id,
        ultimate_id: ultimate_id,
        kinerja: kinerja,
        pelaksana_urutan: pelaksana,
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
    
    $.post(BaseURL + 'Daerah/Intermediate_outcome_pd_hapus', {id: id}, function(res) {
      if (res.status === 'success') {
        alert(res.message);
        location.reload();
      } else {
        alert(res.message || 'Gagal menghapus');
      }
    }, 'json');
  });

  // ==================== DETAIL ====================
  $(document).on('click', '.btn-detail', function() {
    let id = $(this).data('id');
    $('#DetailContent').html('<div class="text-center py-4"><i class="fa fa-spinner fa-spin fa-2x"></i> Memuat data...</div>');
    $('#BtnHapusIsi').hide();
    
    $.post(BaseURL + 'Daerah/Intermediate_outcome_pd_get', {id: id}, function(res) {
      if (res.status === 'error') {
        $('#DetailContent').html('<div class="alert alert-danger">' + (res.message || 'Data tidak ditemukan') + '</div>');
        return;
      }
      
      let data = res.data;
      let html = '<div class="row"><div class="col-md-12">';
      html += '<table class="table table-bordered">';
      html += '<tr><th width="30%">Ultimate Outcome</th><td>' + (data.ultimate_kinerja || '—') + '</td></tr>';
      html += '<tr><th>Kinerja Strategis Sektor</th><td>' + nl2br(data.kinerja || '—') + '</td></tr>';
      
      // Indikator
      if (data.indikator) {
        html += '<tr><th>Indikator Kinerja</th><td><ul>';
        if (typeof data.indikator === 'string') {
          data.indikator.split('|||').forEach(v => { 
            if(v && v.trim()) html += '<li>' + v.trim() + '</li>'; 
          });
        }
        html += '</ul></td></tr>';
      } else {
        html += '<tr><th>Indikator Kinerja</th><td>—</td></tr>';
      }
      
      html += '<tr><th>Pelaksana / Urusan</th><td>' + (data.pelaksana_urutan || 'Sedang') + '</td></tr>';
      
      // Inovasi
      if (data.inovasi_daerah) {
        html += '<tr><th>Inovasi Daerah</th><td><ul>';
        if (typeof data.inovasi_daerah === 'string') {
          data.inovasi_daerah.split('|||').forEach(v => { 
            if(v && v.trim()) html += '<li>' + v.trim() + '</li>'; 
          });
        }
        html += '</ul></td></tr>';
      }
      
      if (data.outcome_inovasi) {
        html += '<tr><th>Outcome Inovasi</th><td><ul>';
        if (typeof data.outcome_inovasi === 'string') {
          data.outcome_inovasi.split('|||').forEach(v => { 
            if(v && v.trim()) html += '<li>' + v.trim() + '</li>'; 
          });
        }
        html += '</ul></td></tr>';
      }
      
      if (data.output_inovasi) {
        html += '<tr><th>Output Inovasi</th><td><ul>';
        if (typeof data.output_inovasi === 'string') {
          data.output_inovasi.split('|||').forEach(v => { 
            if(v && v.trim()) html += '<li>' + v.trim() + '</li>'; 
          });
        }
        html += '</ul></td></tr>';
      }
      
      // Crosscutting
      if (data.crosscutting_pd && data.crosscutting_keterangan) {
        html += '<tr><th>Crosscutting PD</th><td><ul>';
        try {
          let pd_list = data.crosscutting_pd;
          let ket_list = data.crosscutting_keterangan;
          
          if (typeof pd_list === 'string') pd_list = JSON.parse(pd_list);
          if (typeof ket_list === 'string') ket_list = JSON.parse(ket_list);
          
          if (Array.isArray(pd_list)) {
            for (let i = 0; i < pd_list.length; i++) {
              let pd_name = 'ID: ' + pd_list[i];
              
              // Cari nama dari daftarPerangkat
              if (daftarPerangkat && daftarPerangkat.length > 0) {
                let found = daftarPerangkat.find(item => String(item.id) === String(pd_list[i]));
                if (found) {
                  pd_name = found.nama;
                }
              }
              
              html += '<li><strong>' + pd_name + '</strong> - <em>' + (ket_list[i] || '') + '</em></li>';
            }
          } else {
            html += '<li class="text-muted">Tidak ada data crosscutting</li>';
          }
        } catch(e) {
          console.error('Error parsing crosscutting:', e);
          html += '<li class="text-danger">Error menampilkan data crosscutting</li>';
        }
        html += '</ul></td></tr>';
      }
      
      html += '</table></div></div>';
      $('#DetailContent').html(html);
      $('#BtnHapusIsi').show().data('id', id);
    }, 'json').fail(function() {
      $('#DetailContent').html('<div class="alert alert-danger">Gagal memuat data</div>');
    });
  });

  // ==================== HAPUS ISI LEVEL ====================
  $('#BtnHapusIsi').click(function() {
    if (!confirm('Yakin ingin menghapus semua isi level ini?')) return;
    
    let id = $(this).data('id');
    
    $.post(BaseURL + 'Daerah/Intermediate_outcome_pd_hapus_isi', {id: id}, function(res) {
      if (res.status === 'success') {
        alert(res.message);
        location.reload();
      } else {
        alert(res.message || 'Gagal menghapus isi level');
      }
    }, 'json').fail(function() {
      alert('Method hapus_isi belum tersedia di controller');
    });
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
    var kodeKab  = "<?= $KodeWilayah ?>";
    $("#Provinsi").val(kodeProv).trigger('change');
    
    // Setelah kab/kota di-load, pilih yang sesuai
    setTimeout(function() {
      $("#KabKota").val(kodeKab);
    }, 500);
  <?php } ?>

});
</script>