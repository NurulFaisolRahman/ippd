<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      
      <!-- HEADER NAVIGASI -->
      <div style="background: white; padding: 12px 20px; margin-bottom: 25px; border: 1px solid #dee2e6; border-radius: 5px;">
        <div style="display: flex; gap: 25px; flex-wrap: wrap;">
          <a href="<?=base_url('Daerah/Ultimate_outcome_pd')?>" class="nav-link active">ULTIMATE OUTCOME PD (Level 1)</a>
          <a href="<?=base_url('Daerah/Intermediate_outcome_pd')?>" class="nav-link">INTERMEDIATE OUTCOME PD (Level 2)</a>
          <a href="<?=base_url('Daerah/Immediate_outcome_pd')?>" class="nav-link">IMMEDIATE OUTCOME PD (Level 3)</a>
          <a href="<?=base_url('Daerah/Output_pd')?>" class="nav-link">OUTPUT PD (Level 4)</a>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="data-table-list">

            <!-- FILTER WILAYAH -->
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
            <br>

            <!-- TOMBOL TAMBAH -->
            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
              <div class="basic-tb-hd mb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalLevel1" id="btn-tambah">
                  <i class="fa fa-plus"></i> Tambah ULTIMATE OUTCOME PD (Level 1)
                </button>
              </div>
            <?php } ?>

            <!-- TABEL -->
            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                      <th width="60" class="text-center">NO</th>
                      <th>Kinerja</th>
                      <th>Indikator Kinerja</th>
                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <th width="120" class="text-center">AKSI</th>
                      <?php } ?>
                    </tr>
                </thead>
                <tbody>
                  <?php if (!empty($items)): ?>
                    <?php $no = 1; foreach($items as $row): ?>
                      <tr data-id="<?= (int)$row['id'] ?>">
                        <td class="text-center align-middle"><?= $no++ ?></td>
                        <td class="align-middle">
                          <strong><?= nl2br(html_escape($row['kinerja'] ?? '—')) ?></strong>
                        </td>
                        <td class="align-middle">
                          <?php 
                            // Parse indikator yang disimpan dalam format: kategori1|||sumber_id1|||kategori2|||sumber_id2
                            if (!empty($row['indikator'])) {
                              $indikator_parts = explode('|||', $row['indikator']);
                              $display_indikator = [];
                              
                              for ($i = 0; $i < count($indikator_parts); $i += 2) {
                                if (isset($indikator_parts[$i + 1])) {
                                  $kategori = $indikator_parts[$i];
                                  $sumber_id = $indikator_parts[$i + 1];
                                  
                                  // Cari teks sumber dari data yang ada
                                  $sumber_text = '';
                                  if ($kategori == 'sektor') {
                                    foreach ($intermediate_sektor as $s) {
                                      if ($s['id'] == $sumber_id) {
                                        $sumber_text = $s['kinerja'];
                                        break;
                                      }
                                    }
                                  } elseif ($kategori == 'taktikal') {
                                    foreach ($intermediate_taktikal as $t) {
                                      if ($t['id'] == $sumber_id) {
                                        $sumber_text = $t['kinerja'];
                                        break;
                                      }
                                    }
                                  }
                                  
                                  if ($sumber_text) {
                                    $display_indikator[] = '• ' . html_escape($sumber_text);
                                  }
                                }
                              }
                              
                              if (!empty($display_indikator)) {
                                echo implode('<br>', $display_indikator);
                              } else {
                                echo '—';
                              }
                            } else {
                              echo '—';
                            }
                          ?>
                        </td>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3): ?>
                          <td class="text-center align-middle">
                            <button class="btn btn-sm btn-primary btn-edit-level1"
                                    data-id="<?= $row['id'] ?>"
                                    data-kinerja="<?= htmlspecialchars($row['kinerja'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                    data-indikator="<?= htmlspecialchars($row['indikator'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                              <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger btn-hapus-level1" data-id="<?= $row['id'] ?>">
                              <i class="fa fa-trash"></i>
                            </button>
                          </td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? 4 : 3 ?>" class="text-center py-5 text-muted">
                        <i class="bi bi-folder-x fa-3x mb-3 d-block opacity-50"></i>
                        Belum ada data Ultimate Outcome Perangkat Daerah<br>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3): ?>
                          <button class="btn btn-success mt-3" data-toggle="modal" data-target="#modalLevel1">
                            <i class="fa fa-plus"></i> Tambah Data Pertama
                          </button>
                        <?php endif; ?>
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

<!-- MODAL ULTIMATE OUTCOME (LEVEL 1) -->
<div class="modal fade" id="modalLevel1" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" style="max-width: 1400px; width: 95%; margin: 30px auto;">
    <div class="modal-content">

      <div class="modal-header bg-light">
        <h3 class="modal-title">
          Ultimate Outcome / Level 1
        </h3>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="id_level1">
        <input type="hidden" id="edit_mode" value="0">

        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          
          <!-- KINERJA - TEXTFIELD UTAMA -->
          <div class="form-group">
            <label><b>Kinerja</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Ultimate Outcome Level 1 - Kinerja Strategis</em>
            </div>
            <textarea id="kinerja" class="form-control" rows="4" placeholder="Masukkan kinerja strategis..."></textarea>
          </div>

          <!-- DATA SUMBER (INDIKATOR) -->
          <div class="form-group">
            <label><b>Data Sumber (Indikator Kinerja)</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Pilih data dari Intermediate Outcome Sektor atau Taktikal yang akan menjadi indikator kinerja</em>
            </div>
            <div id="sumber-container"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-tambah-sumber">
              <i class="fa fa-plus"></i> Tambah Data Sumber
            </button>
          </div>

        </div>
      </div>

      <!-- FOOTER -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-level1">
          Simpan Perubahan
        </button>
      </div>

    </div>
  </div>
</div>

<style>
  .table td { 
    padding: 12px !important; 
    vertical-align: middle !important; 
  }
  .sumber-row {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    position: relative;
  }
  .sumber-row .btn-remove-sumber {
    position: absolute;
    top: 10px;
    right: 10px;
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
  .modal {
    padding-top: 70px;
  }
  
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
  
  .nav-link.active {
    color: #007bff;
    border-bottom: 2px solid #007bff;
  }
  
  .badge {
    padding: 5px 10px;
    font-size: 11px;
    border-radius: 3px;
  }
  .badge-primary {
    background-color: #007bff;
    color: white;
  }
  .badge-info {
    background-color: #17a2b8;
    color: white;
  }
  
  textarea.form-control {
    resize: vertical;
  }
  
  .sumber-row select {
    margin-bottom: 0;
  }
  
  .sumber-row .form-group {
    margin-bottom: 0;
  }
</style>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";

// Data dari server untuk dropdown
var sektorData = <?= json_encode($intermediate_sektor) ?>;
var taktikalData = <?= json_encode($intermediate_taktikal) ?>;
var sumberCounter = 0;
var isEditMode = false;
var editDataId = null;

$(document).ready(function() {
  
  // Setup AJAX CSRF
  $.ajaxSetup({
    beforeSend: function(xhr, settings) {
      if (settings.type.toUpperCase() === 'POST') {
        settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
      }
    }
  });

  // ================= FUNGSI TAMBAH BARIS DATA SUMBER =================
  function addSumberRow(kategori = '', sumberId = '') {
    sumberCounter++;
    let rowId = 'sumber_row_' + sumberCounter;
    
    let kategoriOptions = `
      <option value="">-- Pilih Kategori --</option>
      <option value="sektor" ${kategori === 'sektor' ? 'selected' : ''}>Intermediate Outcome Sektor</option>
      <option value="taktikal" ${kategori === 'taktikal' ? 'selected' : ''}>Intermediate Outcome Taktikal</option>
    `;
    
    let sumberOptions = '<option value="">-- Pilih Kategori Terlebih Dahulu --</option>';
    
    // Jika kategori sudah dipilih, load data sumber
    if (kategori) {
      sumberOptions = getSumberOptions(kategori, sumberId);
    }
    
    let html = `
      <div class="sumber-row" id="${rowId}">
        <button type="button" class="btn btn-danger btn-sm btn-remove-sumber" data-rowid="${rowId}">
          <i class="fa fa-trash"></i>
        </button>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label><b>Kategori Data Sumber</b> <span class="text-danger">*</span></label>
              <select class="form-control kategori-select" data-rowid="${rowId}" required>
                ${kategoriOptions}
              </select>
            </div>
          </div>
          <div class="col-md-7">
            <div class="form-group">
              <label><b>Data Sumber (Indikator)</b> <span class="text-danger">*</span></label>
              <select class="form-control sumber-select" id="sumber_${rowId}" data-rowid="${rowId}" required ${!kategori ? 'disabled' : ''}>
                ${sumberOptions}
              </select>
            </div>
          </div>
        </div>
      </div>
    `;
    
    $('#sumber-container').append(html);
    
    // Bind event untuk kategori select
    $(document).on('change', `.kategori-select[data-rowid="${rowId}"]`, function() {
      let selectedKategori = $(this).val();
      let $sumberSelect = $(`#sumber_${rowId}`);
      
      if (!selectedKategori) {
        $sumberSelect.prop('disabled', true);
        $sumberSelect.html('<option value="">-- Pilih Kategori Terlebih Dahulu --</option>');
        return;
      }
      
      $sumberSelect.prop('disabled', false);
      $sumberSelect.html(getSumberOptions(selectedKategori));
    });
  }
  
  // Fungsi untuk mendapatkan options sumber berdasarkan kategori
  function getSumberOptions(kategori, selectedId = null) {
    let options = '<option value="">-- Pilih Data Sumber --</option>';
    
    if (kategori === 'sektor') {
      if (sektorData && sektorData.length > 0) {
        $.each(sektorData, function(index, item) {
          let selected = (selectedId == item.id) ? 'selected' : '';
          let text = item.kinerja.length > 100 ? item.kinerja.substring(0, 100) + '...' : item.kinerja;
          options += `<option value="${item.id}" ${selected}>${escapeHtml(text)}</option>`;
        });
      } else {
        options += '<option value="" disabled>-- Tidak ada data sektor --</option>';
      }
    } else if (kategori === 'taktikal') {
      if (taktikalData && taktikalData.length > 0) {
        $.each(taktikalData, function(index, item) {
          let selected = (selectedId == item.id) ? 'selected' : '';
          let text = item.kinerja.length > 100 ? item.kinerja.substring(0, 100) + '...' : item.kinerja;
          options += `<option value="${item.id}" ${selected}>${escapeHtml(text)}</option>`;
        });
      } else {
        options += '<option value="" disabled>-- Tidak ada data taktikal --</option>';
      }
    }
    
    return options;
  }
  
  // Hapus baris sumber
  $(document).on('click', '.btn-remove-sumber', function() {
    let rowId = $(this).data('rowid');
    $(`#${rowId}`).remove();
  });
  
  // Helper function untuk escape HTML
  function escapeHtml(text) {
    var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
  }

  // ================= BUTTON TAMBAH DATA SUMBER =================
  $("#btn-tambah-sumber").click(function() {
    addSumberRow();
  });

  // ================= RESET FORM UNTUK TAMBAH DATA =================
  function resetForm() {
    $('#id_level1').val('');
    $('#kinerja').val('');
    $('#sumber-container').empty();
    isEditMode = false;
    editDataId = null;
    // Tambah 1 baris default untuk tambah baru
    addSumberRow();
  }

  // ================= EVENT UNTUK TAMBAH DATA =================
  $('#btn-tambah').on('click', function() {
    resetForm();
  });

  // ================= EDIT DATA =================
  $(document).on('click', '.btn-edit-level1', function(e) {
    e.preventDefault();
    
    let id = $(this).attr('data-id');
    let kinerja = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';
    
    // Reset form terlebih dahulu
    $('#id_level1').val('');
    $('#kinerja').val('');
    $('#sumber-container').empty();
    
    // Set nilai ke form
    $('#id_level1').val(id);
    $('#kinerja').val(kinerja);
    isEditMode = true;
    editDataId = id;
    
    // Proses indikator untuk edit
    // Format indikator: kategori1|||sumber_id1|||kategori2|||sumber_id2|||...
    if (indikator && indikator.trim() !== '' && indikator !== 'null') {
      let indikatorArray = indikator.split('|||');
      
      // Loop untuk setiap pasangan kategori dan sumber_id
      for (let i = 0; i < indikatorArray.length; i += 2) {
        if (i + 1 < indikatorArray.length) {
          let kategori = indikatorArray[i];
          let sumberId = indikatorArray[i + 1];
          addSumberRow(kategori, sumberId);
        }
      }
    }
    
    // Jika tidak ada data, tambah 1 baris kosong
    if ($('#sumber-container .sumber-row').length === 0) {
      addSumberRow();
    }

    // Tampilkan modal
    $('#modalLevel1').modal('show');
  });

  // ================= SIMPAN DATA =================
  $('#btn-simpan-level1').click(function() {
    let id = $('#id_level1').val();
    let kinerja = $('#kinerja').val().trim();

    if (!kinerja) {
      alert('Kinerja wajib diisi!');
      $('#kinerja').focus();
      return;
    }
    
    // Kumpulkan data sumber
    let indikatorList = [];
    let isValid = true;
    
    $('.sumber-row').each(function() {
      let $row = $(this);
      let kategori = $row.find('.kategori-select').val();
      let sumberId = $row.find('.sumber-select').val();
      
      if (!kategori) {
        alert('Kategori data sumber wajib dipilih!');
        isValid = false;
        return false;
      }
      
      if (!sumberId) {
        alert('Data sumber wajib dipilih!');
        isValid = false;
        return false;
      }
      
      // Simpan dalam format: kategori|||sumber_id
      indikatorList.push(kategori);
      indikatorList.push(sumberId);
    });
    
    if (!isValid) return;
    
    if (indikatorList.length === 0) {
      alert('Minimal satu data sumber harus ditambahkan!');
      return;
    }
    
    // Gabungkan indikator dengan delimiter |||
    let indikator = indikatorList.join('|||');
    
    $.ajax({
      url: BaseURL + 'Daerah/Ultimate_outcome_pd_simpan',
      type: 'POST',
      data: {
        id: id,
        kinerja: kinerja,
        indikator: indikator
      },
      dataType: 'json',
      success: function(res) {
        if (res.status === 'success') {
          alert(res.message);
          location.reload();
        } else {
          alert(res.message || 'Gagal menyimpan');
        }
      },
      error: function(jqXHR) {
        alert('Koneksi bermasalah: ' + jqXHR.status);
      }
    });
  });

  // ================= HAPUS DATA =================
  $(document).on('click', '.btn-hapus-level1', function() {
    if (!confirm('Yakin menghapus data ini?')) return;
    
    let id = $(this).data('id');
    
    $.ajax({
      url: BaseURL + 'Daerah/Ultimate_outcome_pd_hapus',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(res) {
        if (res.status === 'success') {
          alert(res.message);
          location.reload();
        } else {
          alert(res.message || 'Gagal menghapus');
        }
      },
      error: function(jqXHR) {
        alert('Koneksi bermasalah: ' + jqXHR.status);
      }
    });
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
      beforeSend: function() { 
        $("#KabKota").prop('disabled', true); 
      },
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
    if ($("#Provinsi").val() === "") {
      alert("Mohon Pilih Provinsi");
      return;
    }
    if ($("#KabKota").val() === "") {
      alert("Mohon Pilih Kab/Kota");
      return;
    }

    var kodeWilayah = $("#KabKota").val();

    $.ajax({
      url: BaseURL + "Daerah/SetTempKodeWilayah",
      type: "POST",
      data: { KodeWilayah: kodeWilayah },
      beforeSend: function() { 
        $("#Filter").prop('disabled', true).text('Memuat...'); 
      },
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

  // Load Kab/Kota if already selected
  <?php if (!empty($KodeWilayah)): ?>
    var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
    var kodeKab = "<?= $KodeWilayah ?>";
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
  <?php endif; ?>

});
</script>