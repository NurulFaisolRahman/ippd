<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">

            <!-- FILTER WILAYAH (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div class="form-example-wrap" style="margin-bottom: 20px;">
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row filter-row">

                      <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                          <label for="Provinsi"><b>Provinsi</b></label>
                          <select class="form-control filter-select" id="Provinsi">
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($Provinsi as $prov) { ?>
                              <option value="<?= html_escape($prov['Kode']) ?>"
                                <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                <?= html_escape($prov['Nama']) ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                          <label for="KabKota"><b>Kab/Kota</b></label>
                          <select class="form-control filter-select" id="KabKota">
                            <option value="">Pilih Kab/Kota</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-6" id="FilterInstansiGroup" style="display: none;">
                        <div class="filter-group">
                          <label for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                          <select class="form-control filter-select" id="FilterInstansiBeforeLogin">
                            <option value="">-- Semua Instansi --</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-6">
                        <div class="filter-group" style="margin-top: 28px;">
                          <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
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
                  <?php 
                  $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                  if (!empty($filter_instansi_id)) { 
                    $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                  ?>
                    <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                  <?php } ?>
                </div>
              <?php } ?>
            <?php } ?>
            <!-- END FILTER WILAYAH -->

            <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
            <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
              <div class="form-example-wrap" style="margin-bottom: 20px;">
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row filter-row">
                      <div class="col-lg-4 col-md-6">
                        <div class="filter-group">
                          <label for="FilterInstansi"><b>Filter Instansi</b></label>
                          <select class="form-control filter-select" id="FilterInstansi">
                            <option value="">-- Semua Instansi --</option>
                            <?php foreach ($ListInstansi as $ins) { ?>
                              <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                <?= html_escape($ins['nama']) ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-6">
                        <div class="filter-group" style="margin-top: 38px;">
                          <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                            <b>Tampilkan</b>
                          </button>
                        </div>
                      </div>

                      <div class="col-lg-2 col-md-6">
                        <div class="filter-group" style="margin-top: 38px;">
                          <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn">
                            <b>Reset</b>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- END FILTER INSTANSI -->

            <!-- Tombol Tambah MASTER (HANYA UNTUK ROLE 4) -->
            <?php if ($IsRole4) { ?>
              <div class="basic-tb-hd">
                <div class="button-icon-btn sm-res-mg-t-30">
                  <button type="button"
                          class="btn btn-success notika-btn-success"
                          data-toggle="modal"
                          data-target="#ModalInputMaster">
                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah NSPK & Sasaran (Header)</b>
                  </button>
                </div>
              </div>
              <br>
            <?php } ?>

            <!-- TABLE (MASTER-DETAIL) -->
            <div class="table-responsive">
              <table id="data-table-tujuan-sasaran" class="table table-striped">
                <thead>
                  <tr>
                    <th rowspan="2" style="width:60px; text-align:center;">No</th>
                    <th rowspan="2" style="width:420px; text-align:center;">NSPK DAN SASARAN RPJMD YANG RELEVAN</th>
                    <th rowspan="2" style="width:180px; text-align:center;">TUJUAN</th>
                    <th rowspan="2" style="width:180px; text-align:center;">SASARAN PD</th>
                    <th rowspan="2" style="width:220px; text-align:center;">INDIKATOR</th>
                    <th colspan="6" style="text-align:center;">TARGET TAHUN</th>
                    <th rowspan="2" style="width:220px; text-align:center;">KETERANGAN</th>
                    <?php if ($IsRole4) { ?>
                      <th rowspan="2" style="width:80px; text-align:center;">AKSI<br>HEADER</th>
                      <th rowspan="2" style="width:120px; text-align:center;">AKSI<br>INDIKATOR</th>
                    <?php } ?>
                  </tr>
                  <tr>
                    <th style="width:90px; text-align:center;">2025</th>
                    <th style="width:90px; text-align:center;">2026</th>
                    <th style="width:90px; text-align:center;">2027</th>
                    <th style="width:90px; text-align:center;">2028</th>
                    <th style="width:90px; text-align:center;">2029</th>
                    <th style="width:90px; text-align:center;">2030</th>
                  </tr>
                </thead>

                <tbody>
                <?php if (!empty($TujuanSasaranPD)) { ?>
                <?php $no = 1; foreach ($TujuanSasaranPD as $m) { ?>
                <?php if ($IsRole4 && $m['id_instansi'] != $InstansiId && empty($FilterInstansiId)) continue; ?>

                <?php
                  $details  = isset($m['details']) ? $m['details'] : [];
                  $rowspan  = max(1, count($details));

                  $sasaranRelText  = $m['sasaran_relevan_text'] ?? '';
                  $tujuanText      = $m['tujuan_text'] ?? '';
                ?>

                <?php if (!empty($details)) { ?>
                <?php $d0 = $details[0]; ?>
                <?php $detailCount = count($details); ?>

                <!-- BARIS PERTAMA (Header + Detail Pertama) -->
                <tr class="master-row" data-master-id="<?= html_escape($m['id']) ?>">
                  <td rowspan="<?= $rowspan ?>" class="text-center"><?= $no++ ?></td>

                  <td rowspan="<?= $rowspan ?>">
                    <b>NSPK:</b><br>

                    <?php if(!empty($m['norma_list'])){ ?>
                      <b>Norma:</b>
                      <ul>
                        <?php foreach($m['norma_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            // Cek apakah ada isi dari nspk_detail
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['standar_list'])){ ?>
                      <b>Standar:</b>
                      <ul>
                        <?php foreach($m['standar_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['prosedur_list'])){ ?>
                      <b>Prosedur:</b>
                      <ul>
                        <?php foreach($m['prosedur_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['kriteria_list'])){ ?>
                      <b>Kriteria:</b>
                      <ul>
                        <?php foreach($m['kriteria_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <br>
                    <b>Sasaran RPJMD yang Relevan:</b><br>
                    <?= nl2br(html_escape($sasaranRelText)) ?>
                  </td>

                  <td rowspan="<?= $rowspan ?>"><?= nl2br(html_escape($tujuanText)) ?></td>

                  <!-- Detail Pertama -->
                  <td><?= html_escape($d0['sasaran_text'] ?? '-') ?></td>
                  <td><?= nl2br(html_escape($d0['indikator'] ?? '')) ?></td>
                  <td class="text-center"><?= html_escape($d0['t2025'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d0['t2026'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d0['t2027'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d0['t2028'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d0['t2029'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d0['t2030'] ?? '') ?></td>
                  <td><?= nl2br(html_escape($d0['keterangan'] ?? '')) ?></td>

                  <!-- AKSI HEADER -->
                  <?php if ($IsRole4) { ?>
                  <td class="text-center">
                    <div class="btn-group-flex">
                      <button class="btn btn-info btn-sm BtnEditMaster"
                        data-id="<?= html_escape($m['id']) ?>"
                        data-norma="<?= html_escape($m['nspk_norma_id'] ?? '') ?>"
                        data-standar="<?= html_escape($m['nspk_standar_id'] ?? '') ?>"
                        data-prosedur="<?= html_escape($m['nspk_prosedur_id'] ?? '') ?>"
                        data-kriteria="<?= html_escape($m['nspk_kriteria_id'] ?? '') ?>"
                        data-sasaran-relevan-id="<?= html_escape($m['sasaran_relevan_id'] ?? '') ?>"
                        data-tujuan-id="<?= html_escape($m['tujuan_id'] ?? '') ?>">
                        <i class="notika-icon notika-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-sm BtnHapusMaster" data-id="<?= html_escape($m['id']) ?>">
                        <i class="notika-icon notika-trash"></i>
                      </button>
                    </div>
                  </td>

                  <!-- AKSI INDIKATOR (Baris Pertama) -->
                  <td class="text-center">
                    <div class="btn-group-flex">
                      <button class="btn btn-success btn-sm BtnAddDetail" 
                              data-master-id="<?= html_escape($m['id']) ?>"
                              data-detail-id="<?= html_escape($d0['id'] ?? 0) ?>"
                              data-position="after">
                        <i class="notika-icon bi-plus-lg"></i>
                      </button>
                      <button class="btn btn-warning btn-sm BtnEditDetail"
                        data-id="<?= html_escape((int)($d0['id'] ?? 0)) ?>"
                        data-parent-id="<?= html_escape((int)$m['id']) ?>"
                        data-sasaran-id="<?= html_escape((int)($d0['sasaran_id'] ?? 0)) ?>"
                        data-indikator="<?= html_escape($d0['indikator'] ?? '') ?>"
                        data-t2025="<?= html_escape($d0['t2025'] ?? '') ?>"
                        data-t2026="<?= html_escape($d0['t2026'] ?? '') ?>"
                        data-t2027="<?= html_escape($d0['t2027'] ?? '') ?>"
                        data-t2028="<?= html_escape($d0['t2028'] ?? '') ?>"
                        data-t2029="<?= html_escape($d0['t2029'] ?? '') ?>"
                        data-t2030="<?= html_escape($d0['t2030'] ?? '') ?>"
                        data-keterangan="<?= html_escape($d0['keterangan'] ?? '') ?>">
                        <i class="notika-icon notika-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-sm BtnHapusDetail" data-id="<?= html_escape($d0['id'] ?? 0) ?>">
                        <i class="notika-icon notika-trash"></i>
                      </button>
                    </div>
                  </td>
                  <?php } ?>
                </tr>

                <!-- BARIS DETAIL SELANJUTNYA -->
                <?php for ($i=1; $i<$detailCount; $i++) { $d=$details[$i]; ?>
                <tr class="detail-row" data-master-id="<?= html_escape($m['id']) ?>" data-detail-id="<?= html_escape($d['id'] ?? 0) ?>">
                  <td><?= html_escape($d['sasaran_text'] ?? '-') ?></td>
                  <td><?= nl2br(html_escape($d['indikator'] ?? '')) ?></td>
                  <td class="text-center"><?= html_escape($d['t2025'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d['t2026'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d['t2027'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d['t2028'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d['t2029'] ?? '') ?></td>
                  <td class="text-center"><?= html_escape($d['t2030'] ?? '') ?></td>
                  <td><?= nl2br(html_escape($d['keterangan'] ?? '')) ?></td>
                  <?php if ($IsRole4) { ?>
                  <td class="text-center">-</td>
                  <td class="text-center">
                    <div class="btn-group-flex">
                      <button class="btn btn-success btn-sm BtnAddDetail" 
                              data-master-id="<?= html_escape($m['id']) ?>"
                              data-detail-id="<?= html_escape($d['id'] ?? 0) ?>"
                              data-position="after">
                        <i class="notika-icon bi-plus-lg"></i>
                      </button>
                      <button class="btn btn-warning btn-sm BtnEditDetail"
                        data-id="<?= html_escape((int)($d['id'] ?? 0)) ?>"
                        data-parent-id="<?= html_escape((int)$m['id']) ?>"
                        data-sasaran-id="<?= html_escape((int)($d['sasaran_id'] ?? 0)) ?>"
                        data-indikator="<?= html_escape($d['indikator'] ?? '') ?>"
                        data-t2025="<?= html_escape($d['t2025'] ?? '') ?>"
                        data-t2026="<?= html_escape($d['t2026'] ?? '') ?>"
                        data-t2027="<?= html_escape($d['t2027'] ?? '') ?>"
                        data-t2028="<?= html_escape($d['t2028'] ?? '') ?>"
                        data-t2029="<?= html_escape($d['t2029'] ?? '') ?>"
                        data-t2030="<?= html_escape($d['t2030'] ?? '') ?>"
                        data-keterangan="<?= html_escape($d['keterangan'] ?? '') ?>">
                        <i class="notika-icon notika-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-sm BtnHapusDetail" data-id="<?= html_escape($d['id'] ?? 0) ?>">
                        <i class="notika-icon notika-trash"></i>
                      </button>
                    </div>
                  </td>
                  <?php } ?>
                </tr>
                <?php } ?>

                <?php } else { ?>
                <!-- Jika Tidak Ada Detail -->
                <tr class="master-row" data-master-id="<?= html_escape($m['id']) ?>">
                  <td class="text-center"><?= $no++ ?></td>
                  <td>
                    <b>NSPK:</b><br>

                    <?php if(!empty($m['norma_list'])){ ?>
                      <b>Norma:</b>
                      <ul>
                        <?php foreach($m['norma_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['standar_list'])){ ?>
                      <b>Standar:</b>
                      <ul>
                        <?php foreach($m['standar_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['prosedur_list'])){ ?>
                      <b>Prosedur:</b>
                      <ul>
                        <?php foreach($m['prosedur_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['kriteria_list'])){ ?>
                      <b>Kriteria:</b>
                      <ul>
                        <?php foreach($m['kriteria_list'] as $x){ ?>
                          <li>
                            <?= html_escape($x['judul_nspk'] ?? '') ?>
                            <?php 
                            $detail_isi = isset($x['isi']) && !empty($x['isi']) ? $x['isi'] : '';
                            if (!empty($detail_isi)) { ?>
                              <br><small class="text-muted"><?= html_escape($detail_isi) ?></small>
                            <?php } ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <br>
                    <b>Sasaran RPJMD yang Relevan:</b><br>
                    <?= nl2br(html_escape($sasaranRelText)) ?>
                  </td>
                  <td><?= nl2br(html_escape($tujuanText)) ?></td>
                  <td colspan="8" class="text-center"><i>Belum ada indikator</i></td>
                  <td>-</td>
                  <?php if ($IsRole4) { ?>
                  <td class="text-center">
                    <button class="btn btn-info btn-sm BtnEditMaster"
                      data-id="<?= html_escape($m['id']) ?>"
                      data-norma="<?= html_escape($m['nspk_norma_id'] ?? '') ?>"
                      data-standar="<?= html_escape($m['nspk_standar_id'] ?? '') ?>"
                      data-prosedur="<?= html_escape($m['nspk_prosedur_id'] ?? '') ?>"
                      data-kriteria="<?= html_escape($m['nspk_kriteria_id'] ?? '') ?>"
                      data-sasaran-relevan-id="<?= html_escape($m['sasaran_relevan_id'] ?? '') ?>"
                      data-tujuan-id="<?= html_escape($m['tujuan_id'] ?? '') ?>">
                      <i class="notika-icon notika-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm BtnHapusMaster" data-id="<?= html_escape($m['id']) ?>">
                      <i class="notika-icon notika-trash"></i>
                    </button>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-success btn-sm BtnAddDetail" 
                            data-master-id="<?= html_escape($m['id']) ?>"
                            data-detail-id="0"
                            data-position="last">
                      <i class="notika-icon bi-plus-lg"></i>
                    </button>
                  </td>
                  <?php } ?>
                </tr>
                <?php } ?>

                <?php } } ?>
                </tbody>
              </table>
            </div>

          </div><!-- /.data-table-list -->
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL INPUT MASTER ================= -->
  <div class="modal fade" id="ModalInputMaster" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Tambah NSPK & Sasaran (Header)</b></h4>
        </div>

        <div class="modal-body">
          <?php if (!empty($NamaInstansi)) { ?>
            <div class="alert alert-info">
              <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
            </div>
          <?php } ?>

          <!-- NORMA -->
          <div class="form-group">
            <label><b>Norma</b></label>
            <div class="nspk-wrapper">
              <div class="nspk-row">
                <select name="nspk_norma_id[]" class="form-control">
                  <option value="">Pilih Norma</option>
                  <?php 
                  $normaList = isset($ListNSPK['Norma']) ? $ListNSPK['Norma'] : [];
                  foreach ($normaList as $n) { ?>
                    <option value="<?= html_escape($n['id']) ?>">
                      <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                      <?php if (!empty($n['isi'])) { ?>
                        (<?= html_escape($n['isi']) ?>)
                      <?php } ?>
                    </option>
                  <?php } ?>
                </select>
                <button type="button" class="btn btn-success BtnAddRow">+</button>
              </div>
            </div>
          </div>

          <!-- STANDAR -->
          <div class="form-group">
            <label><b>Standar</b></label>
            <div class="nspk-wrapper">
              <div class="nspk-row">
                <select name="nspk_standar_id[]" class="form-control">
                  <option value="">Pilih Standar</option>
                  <?php 
                  $standarList = isset($ListNSPK['Standar']) ? $ListNSPK['Standar'] : [];
                  foreach ($standarList as $n) { ?>
                    <option value="<?= html_escape($n['id']) ?>">
                      <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                      <?php if (!empty($n['isi'])) { ?>
                        (<?= html_escape($n['isi']) ?>)
                      <?php } ?>
                    </option>
                  <?php } ?>
                </select>
                <button type="button" class="btn btn-success BtnAddRow">+</button>
              </div>
            </div>
          </div>

          <!-- PROSEDUR -->
          <div class="form-group">
            <label><b>Prosedur</b></label>
            <div class="nspk-wrapper">
              <div class="nspk-row">
                <select name="nspk_prosedur_id[]" class="form-control">
                  <option value="">Pilih Prosedur</option>
                  <?php 
                  $prosedurList = isset($ListNSPK['Prosedur']) ? $ListNSPK['Prosedur'] : [];
                  foreach ($prosedurList as $n) { ?>
                    <option value="<?= html_escape($n['id']) ?>">
                      <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                      <?php if (!empty($n['isi'])) { ?>
                        (<?= html_escape($n['isi']) ?>)
                      <?php } ?>
                    </option>
                  <?php } ?>
                </select>
                <button type="button" class="btn btn-success BtnAddRow">+</button>
              </div>
            </div>
          </div>

          <!-- KRITERIA -->
          <div class="form-group">
            <label><b>Kriteria</b></label>
            <div class="nspk-wrapper">
              <div class="nspk-row">
                <select name="nspk_kriteria_id[]" class="form-control">
                  <option value="">Pilih Kriteria</option>
                  <?php 
                  $kriteriaList = isset($ListNSPK['Kriteria']) ? $ListNSPK['Kriteria'] : [];
                  foreach ($kriteriaList as $n) { ?>
                    <option value="<?= html_escape($n['id']) ?>">
                      <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                      <?php if (!empty($n['isi'])) { ?>
                        (<?= html_escape($n['isi']) ?>)
                      <?php } ?>
                    </option>
                  <?php } ?>
                </select>
                <button type="button" class="btn btn-success BtnAddRow">+</button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label><b>Sasaran RPJMD yang Relevan</b></label>
            <select id="SasaranRelevanId" class="form-control">
              <option value="">Pilih Sasaran RPJMD</option>
              <?php if (!empty($ListSasaranRPJMD)) { foreach ($ListSasaranRPJMD as $s) { ?>
                <option value="<?= html_escape((int)$s['id']) ?>"><?= html_escape($s['Sasaran'] ?? '') ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Tujuan</b></label>
            <select id="TujuanId" class="form-control">
              <option value="">Pilih Tujuan</option>
              <?php if (!empty($ListTujuanPD)) { foreach ($ListTujuanPD as $t) { ?>
                <option value="<?= html_escape((int)$t['id']) ?>"><?= html_escape($t['tujuan_pd'] ?? '') ?></option>
              <?php }} ?>
            </select>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnSimpanMaster"><b>SIMPAN</b></button>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT MASTER ================= -->
  <div class="modal fade" id="ModalEditMaster" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Edit NSPK & Sasaran (Header)</b></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="EditMasterId">

          <div class="form-group">
            <label><b>Norma</b></label>
            <div class="wrapper-norma"></div>
          </div>

          <div class="form-group">
            <label><b>Standar</b></label>
            <div class="wrapper-standar"></div>
          </div>

          <div class="form-group">
            <label><b>Prosedur</b></label>
            <div class="wrapper-prosedur"></div>
          </div>

          <div class="form-group">
            <label><b>Kriteria</b></label>
            <div class="wrapper-kriteria"></div>
          </div>

          <div style="display:none">
            <div id="edit-opt-norma">
              <?php 
              $normaList = isset($ListNSPK['Norma']) ? $ListNSPK['Norma'] : [];
              foreach ($normaList as $n) { ?>
                <option value="<?= html_escape($n['id']) ?>">
                  <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                </option>
              <?php } ?>
            </div>
            <div id="edit-opt-standar">
              <?php 
              $standarList = isset($ListNSPK['Standar']) ? $ListNSPK['Standar'] : [];
              foreach ($standarList as $n) { ?>
                <option value="<?= html_escape($n['id']) ?>">
                  <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                </option>
              <?php } ?>
            </div>
            <div id="edit-opt-prosedur">
              <?php 
              $prosedurList = isset($ListNSPK['Prosedur']) ? $ListNSPK['Prosedur'] : [];
              foreach ($prosedurList as $n) { ?>
                <option value="<?= html_escape($n['id']) ?>">
                  <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                </option>
              <?php } ?>
            </div>
            <div id="edit-opt-kriteria">
              <?php 
              $kriteriaList = isset($ListNSPK['Kriteria']) ? $ListNSPK['Kriteria'] : [];
              foreach ($kriteriaList as $n) { ?>
                <option value="<?= html_escape($n['id']) ?>">
                  <?= html_escape($n['kode_nspk'] ?? '') . " - " . html_escape($n['judul_nspk'] ?? '') ?>
                </option>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label><b>Sasaran RPJMD yang Relevan</b></label>
            <select id="EditSasaranRelevanId" class="form-control">
              <option value="">Pilih Sasaran RPJMD</option>
              <?php if (!empty($ListSasaranRPJMD)) { foreach ($ListSasaranRPJMD as $s) { ?>
                <option value="<?= html_escape((int)$s['id']) ?>"><?= html_escape($s['Sasaran'] ?? '') ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Tujuan</b></label>
            <select id="EditTujuanId" class="form-control">
              <option value="">Pilih Tujuan</option>
              <?php if (!empty($ListTujuanPD)) { foreach ($ListTujuanPD as $t) { ?>
                <option value="<?= html_escape((int)$t['id']) ?>"><?= html_escape($t['tujuan_pd'] ?? '') ?></option>
              <?php }} ?>
            </select>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnUpdateMaster"><b>SIMPAN</b></button>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL INPUT DETAIL ================= -->
  <div class="modal fade" id="ModalInputDetail" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Tambah Indikator</b></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="DetailMasterId">
          <input type="hidden" id="DetailPositionId">
          <input type="hidden" id="DetailPositionType">
          
          <div class="form-group">
            <label><b>Sasaran PD (Opsional)</b></label>
            <select id="DetailSasaranId" class="form-control">
              <option value="">-- Tidak dipilih --</option>
              <?php foreach ($ListSasaranPD as $sp) { ?>
                <option value="<?= html_escape((int)$sp['id']) ?>">
                  <?= html_escape($sp['sasaran_pd'] ?? '') ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Indikator</b> <span class="text-danger">*</span></label>
            <textarea id="Indikator" class="form-control" rows="3" placeholder="Ketik indikator..."></textarea>
          </div>

          <div class="row">
            <div class="col-lg-2"><label><b>2025</b></label><input type="text" id="T2025" class="form-control" placeholder="Target"></div>
            <div class="col-lg-2"><label><b>2026</b></label><input type="text" id="T2026" class="form-control" placeholder="Target"></div>
            <div class="col-lg-2"><label><b>2027</b></label><input type="text" id="T2027" class="form-control" placeholder="Target"></div>
            <div class="col-lg-2"><label><b>2028</b></label><input type="text" id="T2028" class="form-control" placeholder="Target"></div>
            <div class="col-lg-2"><label><b>2029</b></label><input type="text" id="T2029" class="form-control" placeholder="Target"></div>
            <div class="col-lg-2"><label><b>2030</b></label><input type="text" id="T2030" class="form-control" placeholder="Target"></div>
          </div>

          <br>

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea id="Keterangan" class="form-control" rows="2" placeholder="Ketik keterangan..."></textarea>
          </div>

          <!-- Debug Info (hidden by default) -->
          <div id="DebugMasterInfo" style="display:none; padding:10px; background:#f8f9fa; border-radius:5px; margin-bottom:10px;">
            <small>
              <b>Debug:</b> Master ID: <span id="DebugMasterIdValue"></span> | 
              Posisi: <span id="DebugPositionId"></span>
            </small>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnSimpanDetail"><b>SIMPAN</b></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <div id="LoadingIndicator" style="display:none; margin-left:10px;">
            <i class="fa fa-spinner fa-spin"></i> Menyimpan...
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= MODAL EDIT DETAIL ================= -->
  <div class="modal fade" id="ModalEditDetail" role="dialog">
    <div class="modal-dialog modal-lg" style="top:10%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><b>Edit Indikator</b></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" id="EditDetailId">

          <div class="form-group">
            <label><b>Sasaran PD (Opsional)</b></label>
            <select id="EditDetailSasaranId" class="form-control">
              <option value="">-- Tidak dipilih --</option>
              <?php foreach ($ListSasaranPD as $sp) { ?>
                <option value="<?= html_escape((int)$sp['id']) ?>">
                  <?= html_escape($sp['sasaran_pd'] ?? '') ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Indikator</b> <span class="text-danger">*</span></label>
            <textarea id="EditIndikator" class="form-control" rows="3"></textarea>
          </div>

          <div class="row">
            <div class="col-lg-2"><label><b>2025</b></label><input type="text" id="EditT2025" class="form-control"></div>
            <div class="col-lg-2"><label><b>2026</b></label><input type="text" id="EditT2026" class="form-control"></div>
            <div class="col-lg-2"><label><b>2027</b></label><input type="text" id="EditT2027" class="form-control"></div>
            <div class="col-lg-2"><label><b>2028</b></label><input type="text" id="EditT2028" class="form-control"></div>
            <div class="col-lg-2"><label><b>2029</b></label><input type="text" id="EditT2029" class="form-control"></div>
            <div class="col-lg-2"><label><b>2030</b></label><input type="text" id="EditT2030" class="form-control"></div>
          </div>

          <br>

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea id="EditKeterangan" class="form-control" rows="2"></textarea>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnUpdateDetail"><b>SIMPAN</b></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.main-content -->

<style>
  .btn-group-flex {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    flex-wrap: nowrap;
  }
  .btn-group-flex .btn { margin: 0; }
  .nspk-row {
    display: flex;
    gap: 6px;
    margin-bottom: 6px;
  }
  .nspk-row select { flex: 1; }
  .text-danger { color: #ff0000; }
  
  .new-row-highlight {
    animation: highlightRow 2s ease-in-out;
  }
  @keyframes highlightRow {
    0% { background-color: #d4edda; }
    100% { background-color: transparent; }
  }
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
// ============================================
// KONFIGURASI GLOBAL
// ============================================
var BaseURL    = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= addslashes($KodeWilayah ?? '') ?>';

jQuery(document).ready(function($){

    // ============================================
    // INISIALISASI DATATABLE
    // ============================================
    if ($('#data-table-tujuan-sasaran').length > 0) {
      try {
        if ($.fn.DataTable.isDataTable('#data-table-tujuan-sasaran')) {
          $('#data-table-tujuan-sasaran').DataTable().destroy();
        }
        $('#data-table-tujuan-sasaran').DataTable({
          "pageLength": 10,
          "ordering": false,
          "language": {
            "emptyTable": "Tidak ada data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data",
            "paginate": {
              "first": "Pertama",
              "last": "Terakhir",
              "next": "Berikutnya",
              "previous": "Sebelumnya"
            }
          }
        });
      } catch(e) { 
        console.log("DataTable error:", e); 
      }
    }

    // ============================================
    // FILTER WILAYAH SEBELUM LOGIN
    // ============================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

      $("#Provinsi").change(function() {
        var provinsiKode = $(this).val();
        if (provinsiKode === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
          $("#FilterInstansiGroup").hide();
          return;
        }

        $.ajax({
          url: BaseURL + "Instansi/GetListKabKota",
          type: "POST",
          data: { Kode: provinsiKode, [CSRF_NAME]: CSRF_TOKEN },
          dataType: 'json',
          beforeSend: function() { 
            $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
            $("#FilterInstansiGroup").hide();
          },
          success: function(Data) {
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
              }
            }
            $("#KabKota").html(KabKota).prop('disabled', false);
          },
          error: function() { 
            alert("Gagal memuat data Kab/Kota"); 
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', false);
          }
        });
      });

      $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
          $("#FilterInstansiGroup").hide();
          return;
        }

        $.ajax({
          url: BaseURL + "Instansi/GetListInstansiLevel4",
          type: "POST",
          data: { kode_wilayah: kabKotaKode, [CSRF_NAME]: CSRF_TOKEN },
          dataType: 'json',
          beforeSend: function() {
            $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
            $("#FilterInstansiGroup").show();
          },
          success: function(Data) {
            var options = '<option value="">-- Semua Instansi --</option>';
            if (Data && Data.length > 0) {
              for (let i = 0; i < Data.length; i++) {
                var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
                options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
              }
            }
            $("#FilterInstansiBeforeLogin").html(options);
            $("#FilterInstansiGroup").show();
          },
          error: function() { 
            alert("Gagal memuat data Instansi");
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
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
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        $.ajax({
          url: BaseURL + "Instansi/SetTempKodeWilayah",
          type: "POST",
          data: { 
            KodeWilayah: kodeWilayah, 
            InstansiId: instansiId,
            [CSRF_NAME]: CSRF_TOKEN 
          },
          beforeSend: function() { 
            $("#Filter").prop('disabled', true).text('Memuat...'); 
          },
          success: function(res) {
            if (res === '1') {
              var redirectUrl = BaseURL + "Instansi/TujuanSasaranPD";
              if (instansiId && instansiId != '') {
                redirectUrl += "?instansi_id=" + instansiId;
              }
              window.location.href = redirectUrl;
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

      <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
          $("#KabKota").val(kodeKab).trigger('change');
          <?php if (!empty($FilterInstansiId)) { ?>
            setTimeout(function() {
              if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
                $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
              }
            }, 800);
          <?php } ?>
        }, 500);
      <?php } ?>

    <?php } ?>

    // ============================================
    // FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4)
    // ============================================
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
      $("#FilterInstansiBtn").click(function() {
        var instansiId = $("#FilterInstansi").val();
        var url = BaseURL + "Instansi/TujuanSasaranPD";
        if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
        window.location.href = url;
      });
      $("#ResetFilterBtn").click(function() { 
        window.location.href = BaseURL + "Instansi/TujuanSasaranPD"; 
      });
    <?php } ?>

    // ============================================
    // CRUD OPERATIONS (HANYA UNTUK ROLE 4)
    // ============================================
    <?php if ($IsRole4) { ?>

    // ============================================
    // FUNGSI BANTU UNTUK NSPK
    // ============================================
    function getNSPK(name){
      var arr = [];
      $("select[name='"+name+"']").each(function(){
        var val = $(this).val();
        if(val && val != "") arr.push(val);
      });
      return arr;
    }

    function resetFormDetail() {
      $("#DetailMasterId").val('');
      $("#DetailPositionId").val('');
      $("#DetailPositionType").val('');
      $("#DetailSasaranId").val('');
      $("#Indikator").val('');
      $("#T2025,#T2026,#T2027,#T2028,#T2029,#T2030").val('');
      $("#Keterangan").val('');
      $("#DebugMasterInfo").hide();
    }

    // ============================================
    // FUNGSI UPDATE ROWSPAN
    // ============================================
    function updateMasterRowspan(masterId) {
      var detailCount = $('tr.detail-row[data-master-id="' + masterId + '"]').length;
      var masterRow = $('tr.master-row[data-master-id="' + masterId + '"]');
      
      if (masterRow.length > 0) {
        var rowspan = detailCount > 0 ? detailCount + 1 : 1;
        masterRow.find('td:first').attr('rowspan', rowspan);
        masterRow.find('td:nth-child(2)').attr('rowspan', rowspan);
        masterRow.find('td:nth-child(3)').attr('rowspan', rowspan);
      }
    }

    // ============================================
    // FUNGSI UPDATE NOMOR URUT
    // ============================================
    function updateRowNumbers() {
      var counter = 1;
      $('tr.master-row').each(function() {
        var firstTd = $(this).find('td:first');
        if (firstTd.attr('rowspan')) {
          firstTd.text(counter++);
        }
      });
    }

    // ============================================
    // FUNGSI TAMBAH BARIS DETAIL
    // ============================================
    function addNewDetailRow(masterId, positionId, positionType, newData) {
      console.log("=== addNewDetailRow ===");
      console.log("Master ID:", masterId);
      console.log("Position ID:", positionId);
      console.log("Position Type:", positionType);
      console.log("New Data:", newData);
      
      // Cari baris target
      var targetRow = null;
      var isDetail = false;
      
      if (positionType == 'after' && positionId && positionId != 0 && positionId != '0') {
        // Cari baris dengan detail-id tertentu
        targetRow = $('tr.detail-row[data-detail-id="' + positionId + '"]');
        if (targetRow.length > 0) {
          isDetail = true;
        }
      }
      
      // Jika tidak ditemukan, cari baris terakhir di master
      if (targetRow == null || targetRow.length == 0) {
        var detailRows = $('tr.detail-row[data-master-id="' + masterId + '"]');
        if (detailRows.length > 0) {
          targetRow = detailRows.last();
          isDetail = true;
        } else {
          targetRow = $('tr.master-row[data-master-id="' + masterId + '"]');
          isDetail = false;
        }
      }
      
      if (targetRow.length == 0) {
        console.error("Target row tidak ditemukan!");
        return false;
      }
      
      // Cek apakah target adalah master row
      var isMasterRow = targetRow.hasClass('master-row');
      
      // Data untuk baris baru
      var sasaranText = newData.sasaran_text || '-';
      var indikator = newData.indikator || '';
      var t2025 = newData.t2025 || '';
      var t2026 = newData.t2026 || '';
      var t2027 = newData.t2027 || '';
      var t2028 = newData.t2028 || '';
      var t2029 = newData.t2029 || '';
      var t2030 = newData.t2030 || '';
      var keterangan = newData.keterangan || '';
      var detailId = newData.id || 'new_' + Date.now();
      var sasaranId = newData.sasaran_id || '';
      
      var isRole4 = <?= $IsRole4 ? 'true' : 'false' ?>;
      
      // Buat baris baru dengan struktur yang tepat
      var newRow = $('<tr class="detail-row new-row-highlight" data-master-id="' + masterId + '" data-detail-id="' + detailId + '">');
      var html = '';
      
      if (isMasterRow || !isDetail) {
        // Ini adalah baris pertama detail (di bawah master)
        // Kolom: No(1), NSPK(2), Tujuan(3), Sasaran PD(4), Indikator(5), Target(6-11), Keterangan(12), Aksi(13-14)
        html += '<td></td>'; // No (kosong)
        html += '<td></td>'; // NSPK (kosong)
        html += '<td></td>'; // Tujuan (kosong)
        html += '<td>' + sasaranText + '</td>'; // Sasaran PD
        html += '<td>' + indikator + '</td>'; // Indikator
        html += '<td class="text-center">' + t2025 + '</td>';
        html += '<td class="text-center">' + t2026 + '</td>';
        html += '<td class="text-center">' + t2027 + '</td>';
        html += '<td class="text-center">' + t2028 + '</td>';
        html += '<td class="text-center">' + t2029 + '</td>';
        html += '<td class="text-center">' + t2030 + '</td>';
        html += '<td>' + keterangan + '</td>'; // Keterangan
        
        if (isRole4) {
          html += '<td class="text-center">-</td>'; // Aksi Header
          html += '<td class="text-center"><div class="btn-group-flex">';
          html += '<button class="btn btn-success btn-sm BtnAddDetail" data-master-id="' + masterId + '" data-detail-id="' + detailId + '" data-position="after"><i class="notika-icon bi-plus-lg"></i></button>';
          html += '<button class="btn btn-warning btn-sm BtnEditDetail" data-id="' + detailId + '" data-parent-id="' + masterId + '" data-sasaran-id="' + sasaranId + '" data-indikator="' + indikator.replace(/"/g, '&quot;') + '" data-t2025="' + t2025 + '" data-t2026="' + t2026 + '" data-t2027="' + t2027 + '" data-t2028="' + t2028 + '" data-t2029="' + t2029 + '" data-t2030="' + t2030 + '" data-keterangan="' + keterangan.replace(/"/g, '&quot;') + '"><i class="notika-icon notika-edit"></i></button>';
          html += '<button class="btn btn-danger btn-sm BtnHapusDetail" data-id="' + detailId + '"><i class="notika-icon notika-trash"></i></button>';
          html += '</div></td>';
        }
      } else {
        // Detail row biasa (di bawah detail lain)
        // Kolom: Sasaran PD(1), Indikator(2), Target(3-8), Keterangan(9)
        html += '<td>' + sasaranText + '</td>'; // Sasaran PD
        html += '<td>' + indikator + '</td>'; // Indikator
        html += '<td class="text-center">' + t2025 + '</td>';
        html += '<td class="text-center">' + t2026 + '</td>';
        html += '<td class="text-center">' + t2027 + '</td>';
        html += '<td class="text-center">' + t2028 + '</td>';
        html += '<td class="text-center">' + t2029 + '</td>';
        html += '<td class="text-center">' + t2030 + '</td>';
        html += '<td>' + keterangan + '</td>'; // Keterangan
        
        if (isRole4) {
          html += '<td class="text-center">-</td>'; // Aksi Header
          html += '<td class="text-center"><div class="btn-group-flex">';
          html += '<button class="btn btn-success btn-sm BtnAddDetail" data-master-id="' + masterId + '" data-detail-id="' + detailId + '" data-position="after"><i class="notika-icon bi-plus-lg"></i></button>';
          html += '<button class="btn btn-warning btn-sm BtnEditDetail" data-id="' + detailId + '" data-parent-id="' + masterId + '" data-sasaran-id="' + sasaranId + '" data-indikator="' + indikator.replace(/"/g, '&quot;') + '" data-t2025="' + t2025 + '" data-t2026="' + t2026 + '" data-t2027="' + t2027 + '" data-t2028="' + t2028 + '" data-t2029="' + t2029 + '" data-t2030="' + t2030 + '" data-keterangan="' + keterangan.replace(/"/g, '&quot;') + '"><i class="notika-icon notika-edit"></i></button>';
          html += '<button class="btn btn-danger btn-sm BtnHapusDetail" data-id="' + detailId + '"><i class="notika-icon notika-trash"></i></button>';
          html += '</div></td>';
        }
      }
      
      newRow.html(html);
      
      // Sisipkan setelah target
      targetRow.after(newRow);
      
      // Update rowspan di baris master
      updateMasterRowspan(masterId);
      
      // Update nomor urut
      updateRowNumbers();
      
      // Animasi highlight
      setTimeout(function() {
        newRow.removeClass('new-row-highlight');
      }, 3000);
      
      // Scroll ke baris baru
      $('html, body').animate({
        scrollTop: newRow.offset().top - 150
      }, 500);
      
      return true;
    }

    // ============================================
    // MASTER - SIMPAN
    // ============================================
    $("#BtnSimpanMaster").click(function(){
      var nspk_norma_id = getNSPK("nspk_norma_id[]");
      var nspk_standar_id = getNSPK("nspk_standar_id[]");
      var nspk_prosedur_id = getNSPK("nspk_prosedur_id[]");
      var nspk_kriteria_id = getNSPK("nspk_kriteria_id[]");

      if(nspk_standar_id.length == 0 && nspk_norma_id.length == 0 && 
         nspk_prosedur_id.length == 0 && nspk_kriteria_id.length == 0){
        alert("Minimal pilih salah satu NSPK!");
        return;
      }

      var sasaranRelevanId = $("#SasaranRelevanId").val();
      var tujuanId = $("#TujuanId").val();

      if(!sasaranRelevanId){ 
        alert('Sasaran RPJMD harus dipilih!'); 
        return; 
      }
      if(!tujuanId){ 
        alert('Tujuan harus dipilih!'); 
        return; 
      }

      var btn = $(this);
      btn.prop('disabled', true).text('Menyimpan...');

      $.ajax({
        url: BaseURL + "Instansi/InputTujuanSasaranPD_Master",
        type: "POST",
        data: {
          nspk_standar_id: nspk_standar_id,
          nspk_norma_id: nspk_norma_id,
          nspk_prosedur_id: nspk_prosedur_id,
          nspk_kriteria_id: nspk_kriteria_id,
          sasaran_relevan_id: sasaranRelevanId,
          tujuan_id: tujuanId,
          [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res){
          if(res == '1') {
            window.location.reload();
          } else {
            alert(res || 'Gagal simpan!');
            btn.prop('disabled', false).text('SIMPAN');
          }
        },
        error: function(xhr) {
          alert('Terjadi kesalahan: ' + xhr.responseText);
          btn.prop('disabled', false).text('SIMPAN');
        }
      });
    });

    // ============================================
    // MASTER - BUKA EDIT
    // ============================================
    $(document).on("click", ".BtnEditMaster", function(){
      let btn = $(this);
      $("#EditMasterId").val(btn.data("id"));

      function render(wrapperClass, dataAttr, name, optionId){
        let raw = btn.attr(dataAttr) || "";
        let ids = raw !== "" ? raw.split("|||") : [];
        if(ids.length === 0 || (ids.length === 1 && ids[0] === "")) ids = [""];
        $(wrapperClass).html("");
        ids.forEach((val,i)=>{
          let row = `<div class="nspk-row">
            <select name="${name}[]" class="form-control">
              <option value="">Pilih</option>
              ${$(optionId).html()}
            </select>
            <button type="button" class="btn btn-success BtnAddRowEdit">+</button>
            ${i>0 ? `<button type="button" class="btn btn-danger BtnRemoveRowEdit">x</button>` : ""}
          </div>`;
          $(wrapperClass).append(row);
          $(wrapperClass).find("select").last().val(val);
        });
      }

      render(".wrapper-norma", "data-norma", "edit_nspk_norma_id", "#edit-opt-norma");
      render(".wrapper-standar", "data-standar", "edit_nspk_standar_id", "#edit-opt-standar");
      render(".wrapper-prosedur", "data-prosedur", "edit_nspk_prosedur_id", "#edit-opt-prosedur");
      render(".wrapper-kriteria", "data-kriteria", "edit_nspk_kriteria_id", "#edit-opt-kriteria");

      $("#EditSasaranRelevanId").val(btn.data("sasaran-relevan-id"));
      $("#EditTujuanId").val(btn.data("tujuan-id"));

      $("#ModalEditMaster").modal("show");
    });

    // ============================================
    // NSPK ROW MANAGEMENT
    // ============================================
    $(document).on("click", ".BtnAddRow", function(){
      var row = $(this).closest(".nspk-row");
      var newRow = row.clone();
      newRow.find("select").val("");
      if(newRow.find(".BtnRemoveRow").length==0){
        newRow.append('<button type="button" class="btn btn-danger BtnRemoveRow">x</button>');
      }
      row.after(newRow);
    });

    $(document).on("click", ".BtnRemoveRow", function(){ 
      $(this).closest(".nspk-row").remove(); 
    });

    $(document).on("click", ".BtnAddRowEdit", function(){
      var row = $(this).closest(".nspk-row");
      var newRow = row.clone();
      newRow.find("select").val("");
      if(newRow.find(".BtnRemoveRowEdit").length==0){
        newRow.append('<button type="button" class="btn btn-danger BtnRemoveRowEdit">x</button>');
      }
      row.after(newRow);
    });

    $(document).on("click", ".BtnRemoveRowEdit", function(){ 
      $(this).closest(".nspk-row").remove(); 
    });

    // ============================================
    // MASTER - UPDATE
    // ============================================
    $("#BtnUpdateMaster").click(function(){
      var id = $("#EditMasterId").val();
      if(!id) {
        alert("ID Master tidak ditemukan!");
        return;
      }

      var nspk_norma_id = getNSPK("edit_nspk_norma_id[]");
      var nspk_standar_id = getNSPK("edit_nspk_standar_id[]");
      var nspk_prosedur_id = getNSPK("edit_nspk_prosedur_id[]");
      var nspk_kriteria_id = getNSPK("edit_nspk_kriteria_id[]");

      if(nspk_norma_id.length == 0 && nspk_standar_id.length == 0 && 
         nspk_prosedur_id.length == 0 && nspk_kriteria_id.length == 0){
        alert("Minimal pilih salah satu NSPK!");
        return;
      }

      var sasaranRelevanId = $("#EditSasaranRelevanId").val();
      var tujuanId = $("#EditTujuanId").val();

      if(!sasaranRelevanId){ 
        alert("Sasaran RPJMD harus dipilih!"); 
        return; 
      }
      if(!tujuanId){ 
        alert("Tujuan harus dipilih!"); 
        return; 
      }

      var btn = $(this);
      btn.prop('disabled', true).text('Menyimpan...');

      $.ajax({
        url: BaseURL + "Instansi/EditTujuanSasaranPD_Master",
        type: "POST",
        data: {
          id: id,
          nspk_standar_id: nspk_standar_id,
          nspk_norma_id: nspk_norma_id,
          nspk_prosedur_id: nspk_prosedur_id,
          nspk_kriteria_id: nspk_kriteria_id,
          sasaran_relevan_id: sasaranRelevanId,
          tujuan_id: tujuanId,
          [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res){
          if(res == "1") {
            window.location.reload();
          } else {
            alert(res || "Gagal update header!");
            btn.prop('disabled', false).text('SIMPAN');
          }
        },
        error: function(xhr) {
          alert('Terjadi kesalahan: ' + xhr.responseText);
          btn.prop('disabled', false).text('SIMPAN');
        }
      });
    });

    // ============================================
    // MASTER - HAPUS
    // ============================================
    $(document).on("click", ".BtnHapusMaster", function(){
      var id = $(this).data('id');
      if(!id){ 
        alert('ID tidak valid!'); 
        return; 
      }
      if(!confirm('Yakin hapus HEADER ini beserta semua indikatornya?')) return;

      $.ajax({
        url: BaseURL + "Instansi/HapusTujuanSasaranPD_Master",
        type: "POST",
        data: {
          id: id,
          [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res){
          if(res == '1') {
            window.location.reload();
          } else {
            alert(res || 'Gagal hapus header!');
          }
        },
        error: function(xhr) {
          alert('Terjadi kesalahan: ' + xhr.responseText);
        }
      });
    });

    // ============================================
    // DETAIL - OPEN ADD
    // ============================================
    $(document).on("click", ".BtnAddDetail", function(){
      var masterId = $(this).data('master-id');
      var detailId = $(this).data('detail-id') || 0;
      var position = $(this).data('position') || 'after';
      
      console.log("=== TAMBAH INDIKATOR ===");
      console.log("Master ID:", masterId);
      console.log("Detail ID (posisi):", detailId);
      console.log("Position:", position);
      
      if (!masterId || masterId == '') {
        alert("Error: Master ID tidak ditemukan! Silakan refresh halaman.");
        return;
      }

      resetFormDetail();
      $("#DetailMasterId").val(masterId);
      $("#DetailPositionId").val(detailId);
      $("#DetailPositionType").val(position);
      
      var positionText = "";
      if (position == 'after') {
        if (detailId && detailId != 0 && detailId != '0') {
          positionText = "Setelah indikator ID: " + detailId;
        } else {
          positionText = "Di akhir daftar";
        }
      } else if (position == 'last') {
        positionText = "Di akhir daftar";
      }
      
      $("#DebugMasterIdValue").text(masterId);
      $("#DebugPositionId").text(positionText);
      $("#DebugMasterInfo").show();
      
      $('#ModalInputDetail').modal('show');
    });

    // ============================================
    // DETAIL - SIMPAN
    // ============================================
    $("#BtnSimpanDetail").click(function(){
      var masterId = $("#DetailMasterId").val();
      var positionId = $("#DetailPositionId").val();
      var positionType = $("#DetailPositionType").val();
      var indikator = $("#Indikator").val().trim();
      
      console.log("=== SIMPAN INDIKATOR ===");
      console.log("Master ID:", masterId);
      console.log("Position ID:", positionId);
      console.log("Position Type:", positionType);
      console.log("Indikator:", indikator);
      
      if (!masterId || masterId == '') {
        alert("Error: Master ID tidak ditemukan! Silakan tutup modal dan coba lagi.");
        return;
      }
      
      if(!indikator){
        alert("Indikator wajib diisi!");
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).text('Menyimpan...');
      $("#LoadingIndicator").show();

      var postData = {
        master_id: masterId,
        position_id: positionId,
        position_type: positionType,
        sasaran_id: $("#DetailSasaranId").val() || '',
        indikator: indikator,
        t2025: $("#T2025").val() || '',
        t2026: $("#T2026").val() || '',
        t2027: $("#T2027").val() || '',
        t2028: $("#T2028").val() || '',
        t2029: $("#T2029").val() || '',
        t2030: $("#T2030").val() || '',
        keterangan: $("#Keterangan").val() || '',
        [CSRF_NAME]: CSRF_TOKEN
      };

      console.log("Data yang dikirim:", postData);

      $.ajax({
        url: BaseURL + "Instansi/InputTujuanSasaranPD_Detail",
        type: "POST",
        data: postData,
        dataType: 'json',
        success: function(res){
          console.log("Response:", res);
          if(res.status == 'success') {
            // Ambil teks sasaran yang dipilih
            var sasaranText = $('#DetailSasaranId option:selected').text() || '-';
            if (sasaranText == '-- Tidak dipilih --') {
              sasaranText = '-';
            }
            
            var newData = {
              id: res.id || 'new_' + Date.now(),
              sasaran_id: postData.sasaran_id,
              sasaran_text: sasaranText,
              indikator: indikator,
              t2025: postData.t2025,
              t2026: postData.t2026,
              t2027: postData.t2027,
              t2028: postData.t2028,
              t2029: postData.t2029,
              t2030: postData.t2030,
              keterangan: postData.keterangan
            };
            
            var added = addNewDetailRow(masterId, positionId, positionType, newData);
            
            if (added) {
              alert('Data berhasil ditambahkan!');
              $('#ModalInputDetail').modal('hide');
            } else {
              window.location.reload();
            }
          } else {
            alert("Gagal menyimpan: " + (res.message || "Unknown error"));
            btn.prop('disabled', false).text('SIMPAN');
            $("#LoadingIndicator").hide();
          }
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", xhr, status, error);
          alert("Terjadi kesalahan: " + error + "\nSilakan refresh halaman untuk melihat perubahan.");
          btn.prop('disabled', false).text('SIMPAN');
          $("#LoadingIndicator").hide();
        }
      });
    });

    // ============================================
    // DETAIL - OPEN EDIT
    // ============================================
    $(document).on("click", ".BtnEditDetail", function(){
      var id = $(this).data('id');
      if(!id) {
        alert('ID detail tidak valid!');
        return;
      }

      $("#EditDetailId").val(id);
      $("#EditDetailSasaranId").val($(this).data('sasaran-id') || '');
      $("#EditIndikator").val($(this).data('indikator') || '');
      $("#EditT2025").val($(this).data('t2025') || '');
      $("#EditT2026").val($(this).data('t2026') || '');
      $("#EditT2027").val($(this).data('t2027') || '');
      $("#EditT2028").val($(this).data('t2028') || '');
      $("#EditT2029").val($(this).data('t2029') || '');
      $("#EditT2030").val($(this).data('t2030') || '');
      $("#EditKeterangan").val($(this).data('keterangan') || '');
      
      $("#ModalEditDetail").modal("show");
    });

    // ============================================
    // DETAIL - UPDATE
    // ============================================
    $("#BtnUpdateDetail").click(function(){
      var id = $("#EditDetailId").val();
      var indikator = $("#EditIndikator").val().trim();
      
      if(!id){ 
        alert('ID detail tidak valid!'); 
        return; 
      }
      
      if(!indikator){
        alert("Indikator wajib diisi!");
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).text('Menyimpan...');

      $.ajax({
        url: BaseURL + "Instansi/EditTujuanSasaranPD_Detail",
        type: "POST",
        data: {
          id: id,
          sasaran_id: $("#EditDetailSasaranId").val() || '',
          indikator: indikator,
          t2025: $("#EditT2025").val() || '',
          t2026: $("#EditT2026").val() || '',
          t2027: $("#EditT2027").val() || '',
          t2028: $("#EditT2028").val() || '',
          t2029: $("#EditT2029").val() || '',
          t2030: $("#EditT2030").val() || '',
          keterangan: $("#EditKeterangan").val() || '',
          [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res){
          if(res.status == 'success') {
            // Update baris
            var $row = $('tr.detail-row[data-detail-id="' + id + '"]');
            if ($row.length > 0) {
              var sasaranText = $('#EditDetailSasaranId option:selected').text() || '-';
              if (sasaranText == '-- Tidak dipilih --') {
                sasaranText = '-';
              }
              var sasaranId = $('#EditDetailSasaranId').val() || '';
              
              // Get all cells
              var cells = $row.find('td');
              
              // Check row type by checking previous row
              var prevRow = $row.prev();
              var isFirstDetail = (prevRow.length > 0 && prevRow.hasClass('master-row'));
              
              if (isFirstDetail) {
                // Baris pertama detail (di bawah master) - 14 kolom
                $(cells[3]).text(sasaranText); // Sasaran PD
                $(cells[4]).text(indikator); // Indikator
                $(cells[5]).text($("#EditT2025").val() || ''); // 2025
                $(cells[6]).text($("#EditT2026").val() || ''); // 2026
                $(cells[7]).text($("#EditT2027").val() || ''); // 2027
                $(cells[8]).text($("#EditT2028").val() || ''); // 2028
                $(cells[9]).text($("#EditT2029").val() || ''); // 2029
                $(cells[10]).text($("#EditT2030").val() || ''); // 2030
                $(cells[11]).text($("#EditKeterangan").val() || ''); // Keterangan
              } else {
                // Detail row biasa - 11 kolom
                $(cells[0]).text(sasaranText); // Sasaran PD
                $(cells[1]).text(indikator); // Indikator
                $(cells[2]).text($("#EditT2025").val() || ''); // 2025
                $(cells[3]).text($("#EditT2026").val() || ''); // 2026
                $(cells[4]).text($("#EditT2027").val() || ''); // 2027
                $(cells[5]).text($("#EditT2028").val() || ''); // 2028
                $(cells[6]).text($("#EditT2029").val() || ''); // 2029
                $(cells[7]).text($("#EditT2030").val() || ''); // 2030
                $(cells[8]).text($("#EditKeterangan").val() || ''); // Keterangan
              }
              
              // Update data attributes on buttons
              $row.find('.BtnEditDetail').data({
                'sasaran-id': sasaranId,
                'indikator': indikator,
                't2025': $("#EditT2025").val() || '',
                't2026': $("#EditT2026").val() || '',
                't2027': $("#EditT2027").val() || '',
                't2028': $("#EditT2028").val() || '',
                't2029': $("#EditT2029").val() || '',
                't2030': $("#EditT2030").val() || '',
                'keterangan': $("#EditKeterangan").val() || ''
              });
            }
            
            alert('Data berhasil diperbarui!');
            $('#ModalEditDetail').modal('hide');
          } else {
            alert(res.message || 'Gagal update indikator!');
          }
          btn.prop('disabled', false).text('SIMPAN');
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan: ' + error);
          btn.prop('disabled', false).text('SIMPAN');
        }
      });
    });

    // ============================================
    // DETAIL - HAPUS
    // ============================================
    $(document).on("click", ".BtnHapusDetail", function(){
      var id = $(this).data('id');
      var $row = $(this).closest('tr');
      
      if(!id){ 
        alert('ID detail tidak valid!'); 
        return; 
      }
      if(!confirm('Yakin hapus indikator ini?')) return;

      $.ajax({
        url: BaseURL + "Instansi/HapusTujuanSasaranPD_Detail",
        type: "POST",
        data: {
          id: id,
          [CSRF_NAME]: CSRF_TOKEN
        },
        dataType: 'json',
        success: function(res){
          if(res.status == 'success') {
            var masterId = $row.data('master-id');
            $row.remove();
            updateMasterRowspan(masterId);
            updateRowNumbers();
            alert('Data berhasil dihapus!');
          } else {
            alert(res.message || 'Gagal hapus indikator!');
          }
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan: ' + error);
        }
      });
    });

    // ============================================
    // CLEANUP: Reset form saat modal ditutup
    // ============================================
    $('#ModalInputDetail').on('hidden.bs.modal', function () {
      resetFormDetail();
      $("#BtnSimpanDetail").prop('disabled', false).text('SIMPAN');
      $("#LoadingIndicator").hide();
    });

    <?php } // End Role 4 ?>

  }); // End document ready
</script>

</body>
</html>