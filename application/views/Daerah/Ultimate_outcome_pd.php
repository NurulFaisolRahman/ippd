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
                <button class="btn btn-success" data-toggle="modal" data-target="#modalLevel1">
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
                    <th>Kinerja Strategis Daerah</th>
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
                          <?php if (!empty($row['indikator'])): ?>
                            <?php 
                              $indikator_list = explode('|||', $row['indikator']);
                              foreach($indikator_list as $ind):
                                if(trim($ind)):
                            ?>
                                <div><?= html_escape(trim($ind)) ?></div>
                            <?php 
                                endif;
                              endforeach; 
                            ?>
                          <?php else: ?>
                            —
                          <?php endif; ?>
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
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 class="modal-title">
          Ultimate Outcome / Level 1
        </h3>
      </div>

      <div class="modal-body">
        <input type="hidden" id="id_level1">

        <!-- Kinerja -->
        <div class="p-3 mb-4" style="background:#f3f3f3; border-radius:6px;">
          
          <!-- Kinerja -->
          <div class="form-group">
            <label><b>Kinerja Strategis Daerah</b> <span class="text-danger">*</span></label>
            <div class="mb-2 text-muted small">
              <em>Ultimate Outcome / Level 1 - Kinerja Strategis Daerah</em>
            </div>
            <textarea id="kinerja_level1" class="form-control" rows="4" placeholder="Masukkan kinerja strategis daerah..." required></textarea>
          </div>

          <!-- Indikator Kinerja -->
          <div class="form-group">
            <label><b>Indikator Kinerja</b></label>
            <div class="mb-2 text-muted small">
              <em>Ultimate Outcome Level 1 - Indikator Kinerja</em>
            </div>
            <div id="indikator-container-level1"></div>
            <button type="button" class="btn btn-success btn-sm mt-2" id="btn-add-indikator-l1">
              <i class="fa fa-plus"></i> Tambah Indikator
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

<!-- STYLE -->
<style>
  .table td { 
    padding: 12px !important; 
    vertical-align: middle !important; 
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
  .modal {
    padding-top: 70px;
  }
  
  /* Style untuk navigasi link */
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
</style>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

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

  // ================= FUNGSI TAMBAH BARIS INDIKATOR =================
  function addIndikator(container, val = '') {
    // Escape nilai untuk mencegah XSS
    let safeVal = $('<div>').text(val).html();
    
    $(container).append(`
      <div class="field-row">
        <input type="text" class="form-control" value="${safeVal}" placeholder="Masukkan indikator...">
        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button>
      </div>
    `);
  }

  // Hapus baris indikator
  $(document).on("click", ".remove-row", function(e) {
    e.preventDefault();
    $(this).closest(".field-row").remove();
  });

  // ================= BUTTON TAMBAH INDIKATOR =================
  $("#btn-add-indikator-l1").click(function() {
    addIndikator("#indikator-container-level1");
  });

  // ================= RESET MODAL SAAT TAMBAH BARU =================
  $('#modalLevel1').on('show.bs.modal', function(e) {
    if (!e.relatedTarget) return;

    // Jika tombol yang diklik bukan btn-edit-level1 (berarti tombol tambah baru)
    if (!$(e.relatedTarget).hasClass('btn-edit-level1')) {
      $('#id_level1').val('');
      $('#kinerja_level1').val('');
      $('#indikator-container-level1').empty();
      addIndikator('#indikator-container-level1');
    }
  });

  // ================= EDIT DATA =================
  $(document).on('click', '.btn-edit-level1', function() {
    // Ambil data dari atribut menggunakan .attr() seperti contoh
    let id        = $(this).attr('data-id');
    let kinerja   = $(this).attr('data-kinerja') || '';
    let indikator = $(this).attr('data-indikator') || '';

    // Set nilai ke form
    $('#id_level1').val(id);
    $('#kinerja_level1').val(kinerja);

    // Kosongkan container indikator
    $('#indikator-container-level1').empty();

    // Proses indikator
    if (indikator && indikator.trim() !== '' && indikator !== 'null') {
      // Pisahkan berdasarkan separator |||
      let indikatorArray = indikator.split('|||');
      
      // Tambahkan setiap indikator ke form
      indikatorArray.forEach(function(v) {
        if(v && v.trim() !== '') {
          addIndikator('#indikator-container-level1', v.trim());
        }
      });
    }
    
    // Jika tidak ada indikator yang ditambahkan, berikan 1 baris kosong
    if ($('#indikator-container-level1 .field-row').length === 0) {
      addIndikator('#indikator-container-level1');
    }

    // Tampilkan modal
    $('#modalLevel1').modal('show');
  });

  // ================= SIMPAN DATA =================
  $('#btn-simpan-level1').click(function() {
    let id = $('#id_level1').val();
    let kinerja = $('#kinerja_level1').val().trim();

    if (!kinerja) {
      alert('Kinerja wajib diisi!');
      return;
    }

    // Kumpulkan indikator
    let indikator = [];
    $('#indikator-container-level1 input').each(function() {
      let v = $(this).val().trim();
      if (v) indikator.push(v);
    });

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