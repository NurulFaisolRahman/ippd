<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Di bagian head tambahkan CSS Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">

      <div style="background: white; padding: 12px 20px; margin-bottom: 25px; border: 1px solid #dee2e6; border-radius: 5px;">
        <div style="display: flex; gap: 25px; flex-wrap: wrap;">
          <a href="<?=base_url('Daerah/Ultimate_outcome')?>" class="nav-link">Ultimate outcome</a>
          <a href="<?=base_url('Daerah/Intermediate_sektor')?>"  class="nav-link">Intermediate sektor</a>
          <a href="<?=base_url('Daerah/Intermediate_taktikal')?>" class="nav-link">Intermediate taktikal</a>
          <a href="<?=base_url('Daerah/Immediate_outcome')?>" class="nav-link">Immediate outcome</a>
          <a href="<?=base_url('Daerah/Output')?>" class="nav-link active">Output</a>
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

            <!-- TOMBOL TAMBAH OUTPUT -->
            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              <div class="basic-tb-hd">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalLevel5">
                  <i class="fa fa-plus"></i> Tambah Output (Level 5)
                </button>
              </div>
            <?php } ?>

            <!-- TABEL OUTPUT -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="60" class="text-center">NO</th>
                    <th>Immediate Outcome (Level 4)</th>
                    <th>Kinerja Output & Pelaksana</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th width="120" class="text-center">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($items)) { $no = 1; foreach($items as $row) { 
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
                      <td class="align-middle"><?= nl2br(html_escape($row['immediate_kinerja'] ?? '—')) ?></td>
                      <td class="align-middle">
                        <strong><?= nl2br(html_escape($row['kinerja'] ?? '—')) ?></strong>
                        <?php if (!empty($nama_pelaksana)): ?>
                          <br>
                        <?php endif; ?>
                      </td>
                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <td class="text-center align-middle">
                          <button class="btn btn-sm btn-primary btn-edit-level5"
                                data-id="<?= $row['id'] ?>"
                                data-immediate="<?= htmlspecialchars($row['immediate_outcome_id'] ?? '', ENT_QUOTES) ?>"
                                data-kinerja="<?= htmlspecialchars($row['kinerja'] ?? '', ENT_QUOTES) ?>"
                                data-indikator="<?= htmlspecialchars($row['indikator'] ?? '', ENT_QUOTES) ?>"
                                data-inovasi="<?= htmlspecialchars($row['inovasi_daerah'] ?? '', ENT_QUOTES) ?>"
                                data-outcome="<?= htmlspecialchars($row['outcome_inovasi'] ?? '', ENT_QUOTES) ?>"
                                data-output="<?= htmlspecialchars($row['output_inovasi'] ?? '', ENT_QUOTES) ?>"
                                data-crosscutting="<?= htmlspecialchars($row['crosscutting'] ?? '', ENT_QUOTES) ?>"
                                data-pelaksana="<?= htmlspecialchars($row['pelaksana'] ?? '', ENT_QUOTES) ?>">
                            <i class="fa fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger btn-hapus-level5" data-id="<?= $row['id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php } } else { ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? 4 : 3 ?>" class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x fa-3x mb-3 d-block opacity-50"></i>
                        Belum ada data Output<br>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <button class="btn btn-success mt-3" data-toggle="modal" data-target="#modalLevel5">
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

<!-- MODAL OUTPUT (LEVEL 5) -->
<div class="modal fade" id="modalLevel5" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">

      <div class="modal-header bg-light">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 class="modal-title">
          Output / Kinerja Operasional / Level 5
        </h3>
      </div>

      <div class="modal-body">

        <input type="hidden" id="id_level5">

        <!-- Tautan kinerja yang lebih tinggi -->
        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          
          <!-- Immediate Outcome (Level 4) -->
          <div class="form-group">
            <label><b>Tautan kinerja yang lebih tinggi</b></label>
            <div class="mb-2 text-muted small">
              <em>Immediate Outcome (Level 4) → Immediate Outcome / Level 4</em>
            </div>
            <select id="immediate_id" class="form-control">
              <option value="">— Pilih Immediate Outcome —</option>
              <?php foreach ($immediate_options as $opt): ?>
                <option value="<?= $opt['id'] ?>"><?= html_escape(substr($opt['kinerja'],0,100)) . (strlen($opt['kinerja'])>100?'...':'') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Output / Kinerja Operasional / Level 5</em>
            </div>
            <textarea id="kinerja_level5" class="form-control" rows="4" required></textarea>
          </div>

          <!-- Indikator Kinerja -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div class="mb-2 text-muted small">
              <em>Output Level 5 - Indikator Kinerja</em>
            </div>
            <div id="indikator-container-level5"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-indikator-l5">
              <i class="fa fa-plus"></i> Tambah Indikator
            </button>
          </div>

          <!-- Layout 2 Kolom: KIRI (Pelaksana) dan KANAN (Inovasi, Outcome, Output) -->
          <div class="row mt-3">
            <!-- KOLOM KIRI (col-md-6) -->
            <div class="col-md-6">
              <!-- Dinas / Instansi - WAJIB PILIH DULU -->
              <div class="form-group">
                <label><b>Pilih Dinas / Instansi</b> <span class="text-danger">*</span></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Dinas terlebih dahulu untuk melihat Pelaksana</em>
                </div>
                <select id="dinas_filter_l5" class="form-control select2-dinas" style="width: 100%;" required>
                  <option value="">-- Pilih Dinas --</option>
                </select>
              </div>

              <!-- Pelaksana dari Database - Hanya muncul setelah Dinas dipilih -->
              <div class="form-group mt-3" id="pelaksana_group_l5" style="display: none;">
                <label><b>Pelaksana / Urusan</b></label>
                <div class="mb-2 text-muted small">
                  <em>Pilih Pelaksana (Level 4 - Karyawan) dari Dinas terpilih</em>
                </div>
                <select id="pelaksana_l5" class="form-control select2-pelaksana" style="width: 100%;">
                  <option value="">-- Pilih Pelaksana --</option>
                </select>
              </div>
            </div>

            <!-- KOLOM KANAN (col-md-6) -->
            <div class="col-md-6">
              <!-- Inovasi Daerah -->
              <div class="form-group">
                <label><b>Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Output / Level 5</em>
                </div>
                <div id="inovasi-container-level5"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-inovasi-l5">
                  <i class="fa fa-plus"></i> Tambah Inovasi
                </button>
              </div>

              <!-- Outcome Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Outcome Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Output / Level 5</em>
                </div>
                <div id="outcome-inovasi-container-level5"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-outcome-inovasi-l5">
                  <i class="fa fa-plus"></i> Tambah Outcome
                </button>
              </div>

              <!-- Output Inovasi Daerah -->
              <div class="form-group mt-3">
                <label><b>Output Inovasi Daerah</b></label>
                <div class="mb-2 text-muted small">
                  <em>Output / Level 5</em>
                </div>
                <div id="output-inovasi-container-level5"></div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-output-inovasi-l5">
                  <i class="fa fa-plus"></i> Tambah Output
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- CROSSCUTTING -->
        <div class="form-group">
          <label><b>Crosscutting Dengan:</b></label>
          <div class="mb-2 text-muted small">
            <em>PD/UPT/Lembaga/Desa - Pohon Kinerja - Informasi Kegiatan</em>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #007bff; color:white;">
                <tr>
                  <th class="text-center">PD/UPT/Lembaga/Desa</th>
                  <th class="text-center">Pohon Kinerja</th>
                  <th class="text-center">Informasi Kegiatan</th>
                  <th width="60"></th>
                </tr>
              </thead>
              <tbody id="crosscutting-body-level5"></tbody>
            </table>
          </div>

          <button type="button" class="btn btn-success btn-sm" id="btn-add-crosscutting-l5">
            <i class="fa fa-plus"></i> Add
          </button>
        </div>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer">
        <button class="btn btn-danger" id="btn-hapus-modal-level5" style="display:none;">Delete</button>
        <button class="btn btn-primary" id="btn-simpan-level5">
          Simpan Perubahan
        </button>
      </div>

    </div>
  </div>
</div>

<!-- STYLE -->
<style>
  /* Style untuk navigasi link dengan efek hover smooth */
  .nav-link {
    color: #6c757d;
    text-decoration: none;
    padding: 5px 0;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
    font-weight: 500;
    position: relative;
  }
  
  .nav-link:hover {
    color: #007bff;
    transform: translateY(-2px);
    border-bottom-color: #007bff;
  }
  
  .nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #007bff;
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: center;
  }
  
  .nav-link:hover::after {
    transform: scaleX(1);
  }
  
  .nav-link.active {
    color: #007bff;
    border-bottom: 2px solid #007bff;
  }
  
  .nav-link.active::after {
    display: none;
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
  
  /* Table styling */
  .table td { 
    padding: 12px !important; 
    vertical-align: top !important; 
  }
  
  .input-group { 
    margin-bottom: 8px !important; 
  }
  
  textarea.form-control { 
    resize: vertical; 
    min-height: 120px; 
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
  
  .modal-content {
    border-radius: 8px;
  }
  
  .modal-header {
    border-bottom: 1px solid #ddd;
  }
  
  .modal-footer {
    border-top: 1px solid #ddd;
  }
  
  .table thead th {
    vertical-align: middle !important;
  }
  
  .modal {
    padding-top: 70px;
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

<!-- Sertakan jQuery dan Bootstrap -->
<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/jquery.dataTables.min.js') ?>"></script>
<!-- Load Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";

$(document).ready(function() {
  
  // Setup AJAX CSRF
  $.ajaxSetup({
    beforeSend: function(xhr, settings) {
      if (settings.type.toUpperCase() === 'POST') {
        settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
      }
    }
  });

  // ================= FUNGSI TAMBAH BARIS =================
  function addIndikator(container, val = '') {
    $(container).append(`
      <div class="field-row">
        <input type="text" class="form-control" value="${val.replace(/"/g, '&quot;')}" placeholder="Masukkan indikator...">
        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
      </div>
    `);
  }

  function addInovasi(container, val = '') {
    $(container).append(`
      <div class="field-row">
        <input type="text" class="form-control" value="${val.replace(/"/g, '&quot;')}" placeholder="Masukkan inovasi daerah...">
        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
      </div>
    `);
  }

  function addOutcomeInovasi(container, val = '') {
    $(container).append(`
      <div class="field-row">
        <input type="text" class="form-control" value="${val.replace(/"/g, '&quot;')}" placeholder="Masukkan outcome inovasi...">
        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
      </div>
    `);
  }

  function addOutputInovasi(container, val = '') {
    $(container).append(`
      <div class="field-row">
        <input type="text" class="form-control" value="${val.replace(/"/g, '&quot;')}" placeholder="Masukkan output inovasi...">
        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
      </div>
    `);
  }

  function addCrosscutting(pd='', pohon='', info='') {
    $("#crosscutting-body-level5").append(`
      <tr>
        <td><input type="text" class="form-control" value="${pd.replace(/"/g, '&quot;')}" placeholder="PD/UPTD/Lembaga/Desa"></td>
        <td><input type="text" class="form-control" value="${pohon.replace(/"/g, '&quot;')}" placeholder="Pohon Kinerja"></td>
        <td><input type="text" class="form-control" value="${info.replace(/"/g, '&quot;')}" placeholder="Informasi Kegiatan"></td>
        <td><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>
      </tr>
    `);
  }

  // Hapus baris
  $(document).on("click", ".remove-row", function(e) {
    e.preventDefault();
    const $row = $(this).closest('.field-row, tr');
    if ($row.length) {
      $row.remove();
    }
  });

  // ================= LOAD DROPDOWN DINAS UNTUK LEVEL 5 =================
  function loadDinasOptionsLevel5(selectedDinasId = '') {
    $.ajax({
      url: BaseURL + 'Daerah/get_daftar_dinas_output',
      type: 'GET',
      dataType: 'json',
      beforeSend: function() {
        $('#dinas_filter_l5').html('<option value="">Loading...</option>');
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
        
        $('#dinas_filter_l5').html(options);
        
        // Inisialisasi Select2 untuk Dinas
        if ($('#dinas_filter_l5').hasClass('select2-hidden-accessible')) {
          $('#dinas_filter_l5').select2('destroy');
        }
        $('#dinas_filter_l5').select2({
          placeholder: 'Pilih Dinas...',
          dropdownParent: $('#modalLevel5'),
          width: '100%',
          minimumResultsForSearch: -1
        });
        
        // Tampilkan/Sembunyikan group pelaksana berdasarkan selected value
        if (selectedDinasId) {
          $('#pelaksana_group_l5').show();
        } else {
          $('#pelaksana_group_l5').hide();
        }
      },
      error: function() {
        $('#dinas_filter_l5').html('<option value="">Gagal memuat data</option>');
      }
    });
  }

  // ================= LOAD PELAKSANA BERDASARKAN DINAS UNTUK LEVEL 5 =================
  function loadPelaksanaByDinasLevel5(dinasId, selectedPelaksanaId = '') {
    if (!dinasId) {
      $('#pelaksana_group_l5').hide();
      $('#pelaksana_l5').html('<option value="">-- Pilih Pelaksana --</option>');
      return;
    }
    
    $('#pelaksana_group_l5').show();
    
    $.ajax({
      url: BaseURL + 'Daerah/get_pelaksana_output_by_dinas',
      type: 'POST',
      data: { dinas_id: dinasId },
      dataType: 'json',
      beforeSend: function() {
        $('#pelaksana_l5').html('<option value="">Loading...</option>');
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
        
        $('#pelaksana_l5').html(options);
        
        // Re-inisialisasi Select2 untuk Pelaksana
        if ($('#pelaksana_l5').hasClass('select2-hidden-accessible')) {
          $('#pelaksana_l5').select2('destroy');
        }
        $('#pelaksana_l5').select2({
          placeholder: 'Pilih Pelaksana...',
          dropdownParent: $('#modalLevel5'),
          width: '100%',
          minimumResultsForSearch: -1
        });
        
        // Set value setelah Select2 diinisialisasi
        if (selectedPelaksanaId) {
          $('#pelaksana_l5').val(selectedPelaksanaId).trigger('change');
        }
      },
      error: function() {
        $('#pelaksana_l5').html('<option value="">Gagal memuat data</option>');
      }
    });
  }

  // ================= SAAT DINAS BERUBAH =================
  $('#dinas_filter_l5').on('change', function() {
    let dinasId = $(this).val();
    loadPelaksanaByDinasLevel5(dinasId, '');
  });

  // ================= BUTTON TAMBAH =================
  $("#btn-add-indikator-l5").click(() => addIndikator("#indikator-container-level5"));
  $("#btn-add-inovasi-l5").click(() => addInovasi("#inovasi-container-level5"));
  $("#btn-add-outcome-inovasi-l5").click(() => addOutcomeInovasi("#outcome-inovasi-container-level5"));
  $("#btn-add-output-inovasi-l5").click(() => addOutputInovasi("#output-inovasi-container-level5"));
  $("#btn-add-crosscutting-l5").click(() => addCrosscutting());

  // ================= RESET MODAL SAAT TAMBAH BARU =================
  $('#modalLevel5').on('show.bs.modal', function(e){
    if (!e.relatedTarget) return;

    if (!$(e.relatedTarget).hasClass('btn-edit-level5')) {
      $('#id_level5').val('');
      $('#immediate_id').val('');
      $('#kinerja_level5').val('');
      $('#dinas_filter_l5').val('').trigger('change');
      
      // Load dinas options
      loadDinasOptionsLevel5('');
      
      // Sembunyikan group pelaksana
      $('#pelaksana_group_l5').hide();
      
      $('#indikator-container-level5').empty();
      $('#inovasi-container-level5').empty();
      $('#outcome-inovasi-container-level5').empty();
      $('#output-inovasi-container-level5').empty();
      $('#crosscutting-body-level5').empty();

      addIndikator('#indikator-container-level5');
    }
  });

  // ================= EDIT =================
  $(document).on('click', '.btn-edit-level5', function(){
    let id        = $(this).attr('data-id');
    let immediate = $(this).attr('data-immediate');
    let kinerja   = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    let inovasi   = $(this).attr('data-inovasi') || '';
    let outcome   = $(this).attr('data-outcome') || '';
    let output    = $(this).attr('data-output') || '';
    let crosscut  = $(this).attr('data-crosscutting') || '';
    let pelaksanaId = $(this).attr('data-pelaksana') || '';

    $('#id_level5').val(id);
    $('#immediate_id').val(immediate);
    $('#kinerja_level5').val(kinerja);
    
    // Reset containers
    $('#indikator-container-level5').empty();
    $('#inovasi-container-level5').empty();
    $('#outcome-inovasi-container-level5').empty();
    $('#output-inovasi-container-level5').empty();
    $('#crosscutting-body-level5').empty();

    // Load dinas options terlebih dahulu
    loadDinasOptionsLevel5('');
    
    // Untuk mendapatkan dinas_id dari pelaksana
    if (pelaksanaId) {
      $.ajax({
        url: BaseURL + 'Daerah/get_pelaksana_output_detail',
        type: 'POST',
        data: { id: pelaksanaId },
        dataType: 'json',
        success: function(data) {
          if (data && data.dinas_id) {
            // Parse dinas_id (mungkin berisi multiple ID dipisah koma)
            let dinasIds = data.dinas_id.split(',');
            if (dinasIds.length > 0 && dinasIds[0]) {
              // Set dinas filter ke ID pertama
              $('#dinas_filter_l5').val(dinasIds[0]).trigger('change');
              // Load pelaksana berdasarkan dinas dan set selected
              setTimeout(function() {
                loadPelaksanaByDinasLevel5(dinasIds[0], pelaksanaId);
              }, 500);
            } else {
              // Jika tidak ada dinas, sembunyikan group pelaksana
              $('#pelaksana_group_l5').hide();
            }
          } else {
            // Jika tidak ada data, sembunyikan group pelaksana
            $('#pelaksana_group_l5').hide();
          }
        },
        error: function() {
          $('#pelaksana_group_l5').hide();
        }
      });
    } else {
      $('#pelaksana_group_l5').hide();
    }

    // indikator
    if (indikator) {
      indikator.split('|||').forEach(v=>{
        if(v.trim()) addIndikator('#indikator-container-level5', v.trim());
      });
    }
    if(!$('#indikator-container-level5 .field-row').length){
      addIndikator('#indikator-container-level5');
    }

    // inovasi
    if (inovasi) {
      inovasi.split('|||').forEach(v=>{
        if(v.trim()) addInovasi('#inovasi-container-level5', v.trim());
      });
    }

    // outcome inovasi
    if (outcome) {
      outcome.split('|||').forEach(v=>{
        if(v.trim()) addOutcomeInovasi('#outcome-inovasi-container-level5', v.trim());
      });
    }

    // output inovasi
    if (output) {
      output.split('|||').forEach(v=>{
        if(v.trim()) addOutputInovasi('#output-inovasi-container-level5', v.trim());
      });
    }

    // crosscutting
    if (crosscut) {
      try{
        let arr = JSON.parse(crosscut);
        arr.forEach(item=>{
          addCrosscutting(
            item.pd || '',
            item.pohon || '',
            item.info || ''
          );
        });
      }catch(e){}
    }

    $('#modalLevel5').modal('show');
  });

  // ================= SIMPAN =================
  $('#btn-simpan-level5').click(function() {
    let id = $('#id_level5').val();
    let immediate_id = $('#immediate_id').val();
    let kinerja = $('#kinerja_level5').val().trim();
    let pelaksanaId = $('#pelaksana_l5').val();

    if (!kinerja) {
      alert('Kinerja wajib diisi!');
      return;
    }

    // Kumpulkan indikator
    let indikator = [];
    $('#indikator-container-level5 input').each(function() {
      let v = $(this).val().trim();
      if (v) indikator.push(v);
    });

    // Kumpulkan inovasi
    let inovasi = [];
    $('#inovasi-container-level5 input').each(function() {
      let v = $(this).val().trim();
      if (v) inovasi.push(v);
    });

    // Kumpulkan outcome inovasi
    let outcome = [];
    $('#outcome-inovasi-container-level5 input').each(function() {
      let v = $(this).val().trim();
      if (v) outcome.push(v);
    });

    // Kumpulkan output inovasi
    let output = [];
    $('#output-inovasi-container-level5 input').each(function() {
      let v = $(this).val().trim();
      if (v) output.push(v);
    });

    // Kumpulkan crosscutting
    let crosscutting = [];
    $('#crosscutting-body-level5 tr').each(function() {
      let pd = $(this).find("td:eq(0) input").val().trim();
      let pohon = $(this).find("td:eq(1) input").val().trim();
      let info = $(this).find("td:eq(2) input").val().trim();
      if (pd || pohon || info) {
        crosscutting.push({pd, pohon, info});
      }
    });

    // Disable button
    $(this).prop('disabled', true).text('Menyimpan...');

    $.post(BaseURL + 'Daerah/Output_simpan', {
      id: id,
      immediate_id: immediate_id,
      kinerja: kinerja,
      indikator: indikator,
      pelaksana: pelaksanaId,
      inovasi_daerah: inovasi.join('|||'),
      outcome_inovasi: outcome.join('|||'),
      output_inovasi: output.join('|||'),
      crosscutting: crosscutting.length ? crosscutting : null
    }, function(res) {
      if (res.status === 'success') {
        alert(res.message);
        location.reload();
      } else {
        alert(res.message || 'Gagal menyimpan');
        $('#btn-simpan-level5').prop('disabled', false).text('Simpan Perubahan');
      }
    }, 'json').fail(function(jqXHR) {
      alert('Koneksi bermasalah: ' + jqXHR.status);
      $('#btn-simpan-level5').prop('disabled', false).text('Simpan Perubahan');
    });
  });

  // ================= HAPUS DARI TABEL =================
  $(document).on('click', '.btn-hapus-level5', function() {
    if (!confirm('Yakin menghapus data ini?')) return;
    let id = $(this).data('id');
    
    $.post(BaseURL + 'Daerah/Output_hapus', {id: id}, function(res) {
      if (res.status === 'success') {
        alert(res.message);
        location.reload();
      } else {
        alert(res.message || 'Gagal menghapus');
      }
    }, 'json');
  });

  // ================= FILTER WILAYAH =================
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
        } else {
          alert("Belum Ada Data Kab/Kota");
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
    $("#Provinsi").val(kodeProv);

    $.ajax({
      url: BaseURL + "Daerah/GetListKabKota",
      type: "POST",
      data: { Kode: kodeProv },
      success: function(res) {
        var Data = (typeof res === 'string') ? JSON.parse(res) : res;
        var KabKota = '<option value="">Pilih Kab/Kota</option>';

        if (Data.length > 0) {
          for (let i = 0; i < Data.length; i++) {
            var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
            KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
          }
        }
        $("#KabKota").html(KabKota);
      }
    });
  <?php } ?>

});
</script>