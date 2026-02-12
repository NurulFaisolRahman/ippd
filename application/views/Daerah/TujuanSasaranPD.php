<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">

            <!-- FILTER PROVINSI & KAB/KOTA (MUNCUL SAAT BELUM SET KodeWilayah) -->
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
                </div>
              <?php } ?>
            <?php } ?>
            <!-- END FILTER -->

            <!-- Tombol Tambah MASTER -->
            <?php if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) { ?>
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
              <table id="data-table-basic" class="table table-striped">
                <thead>
                  <tr>
                    <th rowspan="2" style="width:60px;">No</th>
                    <th rowspan="2" style="width:420px; text-align:center;">NSPK DAN SASARAN RPJMD YANG RELEVAN</th>
                    <th rowspan="2" style="width:180px; text-align:center;">TUJUAN</th>
                    <th rowspan="2" style="width:180px; text-align:center;">SASARAN PD</th>
                    <th rowspan="2" style="width:220px; text-align:center;">INDIKATOR</th>
                    <th colspan="6" style="text-align:center;">TARGET TAHUN</th>
                    <th rowspan="2" style="width:220px; text-align:center;">KETERANGAN</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th rowspan="2" style="width:120px; text-align:center;">AKSI</th>
                      <th rowspan="2" style="width:120px; text-align:center;">AKSI <br>INDIKATOR</th>
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

                <?php
                  $details  = isset($m['details']) ? $m['details'] : [];
                  $rowspan  = max(1, count($details));

                  $normaText    = $m['norma_text'] ?? '';
                  $standarText  = $m['standar_text'] ?? '';
                  $prosedurText = $m['prosedur_text'] ?? '';
                  $kriteriaText = $m['kriteria_text'] ?? '';

                  $sasaranRelText  = $m['sasaran_relevan_text'] ?? '';
                  $tujuanText      = $m['tujuan_text'] ?? '';
                ?>

                <?php if (!empty($details)) { ?>
                <?php $d0 = $details[0]; ?>

                <tr>
                  <td rowspan="<?= $rowspan ?>" class="text-center"><?= $no++ ?></td>

                  <td rowspan="<?= $rowspan ?>">
                    <b>NSPK:</b><br>

                    <?php if(!empty($m['norma_list'])){ ?>
                      <b>Norma:</b>
                      <ul>
                        <?php foreach($m['norma_list'] as $x){ ?>
                          <li><?= html_escape($x['judul_nspk']) ?></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['standar_list'])){ ?>
                      <b>Standar:</b>
                      <ul>
                        <?php foreach($m['standar_list'] as $x){ ?>
                          <li><?= html_escape($x['judul_nspk']) ?></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['prosedur_list'])){ ?>
                      <b>Prosedur:</b>
                      <ul>
                        <?php foreach($m['prosedur_list'] as $x){ ?>
                          <li><?= html_escape($x['judul_nspk']) ?></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <?php if(!empty($m['kriteria_list'])){ ?>
                      <b>Kriteria:</b>
                      <ul>
                        <?php foreach($m['kriteria_list'] as $x){ ?>
                          <li><?= html_escape($x['judul_nspk']) ?></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>



                    <br>
                    <b>Sasaran RPJMD yang Relevan:</b><br>
                    <?= nl2br(html_escape($sasaranRelText)) ?>
                  </td>


                  <td rowspan="<?= $rowspan ?>"><?= nl2br(html_escape($tujuanText)) ?></td>

                  <!-- INDIKATOR TEXT -->
                  <td><?= html_escape($d0['sasaran_text'] ?? '-') ?></td>
                  <td><?= nl2br(html_escape($d0['indikator'])) ?></td>

                  <!-- TARGET -->
                  <td class="text-center"><?= $d0['t2025'] ?></td>
                  <td class="text-center"><?= $d0['t2026'] ?></td>
                  <td class="text-center"><?= $d0['t2027'] ?></td>
                  <td class="text-center"><?= $d0['t2028'] ?></td>
                  <td class="text-center"><?= $d0['t2029'] ?></td>
                  <td class="text-center"><?= $d0['t2030'] ?></td>

                  <td><?= nl2br(html_escape($d0['keterangan'])) ?></td>

                  <!-- AKSI HEADER -->
                  <td class="text-center">
                    <div class="btn-group-flex">
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                    <?php
$normaPipe    = $m['nspk_norma_id'] ?? '';
$standarPipe  = $m['nspk_standar_id'] ?? '';
$prosedurPipe = $m['nspk_prosedur_id'] ?? '';
$kriteriaPipe = $m['nspk_kriteria_id'] ?? '';
?>
                     <button class="btn btn-info BtnEditMaster"
    data-id="<?= $m['id'] ?>"

    data-norma="<?= $normaPipe ?>"
    data-standar="<?= $standarPipe ?>"
    data-prosedur="<?= $prosedurPipe ?>"
    data-kriteria="<?= $kriteriaPipe ?>"

    data-sasaran-relevan-id="<?= $m['sasaran_relevan_id'] ?>"
    data-tujuan-id="<?= $m['tujuan_id'] ?>"
>

                    <i class="notika-icon notika-edit"></i>
                  </button>



                      <button class="btn btn-danger btn-sm BtnHapusMaster" data-id="<?= $m['id'] ?>">
                        <i class="notika-icon notika-trash"></i>
                      </button>
                    <?php } ?>
                    </div>
                  </td>

                  <!-- AKSI INDIKATOR -->
                  <td class="text-center">
                    <div class="btn-group-flex">
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <button class="btn btn-success btn-sm BtnAddDetail" data-master-id="<?= $m['id'] ?>">
                        <i class="notika-icon bi-plus-lg"></i>
                      </button>
                      <button class="btn btn-warning btn-sm BtnEditDetail"
                  data-id="<?= (int)$d0['id'] ?>"
                  data-parent-id="<?= (int)$m['id'] ?>"
                  data-sasaran-id="<?= (int)$d0['sasaran_id'] ?>"
                  data-indikator="<?= html_escape($d0['indikator']) ?>"
                  data-t2025="<?= html_escape($d0['t2025']) ?>"
                  data-t2026="<?= html_escape($d0['t2026']) ?>"
                  data-t2027="<?= html_escape($d0['t2027']) ?>"
                  data-t2028="<?= html_escape($d0['t2028']) ?>"
                  data-t2029="<?= html_escape($d0['t2029']) ?>"
                  data-t2030="<?= html_escape($d0['t2030']) ?>"
                  data-keterangan="<?= html_escape($d0['keterangan']) ?>">
                  <i class="notika-icon notika-edit"></i>
                </button>

                      <button class="btn btn-danger btn-sm BtnHapusDetail" data-id="<?= $d0['id'] ?>">
                        <i class="notika-icon notika-trash"></i>
                      </button>
                    <?php } ?>
                    </div>
                  </td>
                </tr>

                <?php for ($i=1; $i<count($details); $i++) { $d=$details[$i]; ?>
                <tr>
                  <td><?= html_escape($d['sasaran_text'] ?? '-') ?></td>
                  <td><?= nl2br(html_escape($d['indikator'])) ?></td>
                  <td class="text-center"><?= $d['t2025'] ?></td>
                  <td class="text-center"><?= $d['t2026'] ?></td>
                  <td class="text-center"><?= $d['t2027'] ?></td>
                  <td class="text-center"><?= $d['t2028'] ?></td>
                  <td class="text-center"><?= $d['t2029'] ?></td>
                  <td class="text-center"><?= $d['t2030'] ?></td>
                  <td><?= nl2br(html_escape($d['keterangan'])) ?></td>
                  <td></td>
                  <td class="text-center">
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <button class="btn btn-warning btn-sm BtnEditDetail"
                  data-id="<?= (int)$d['id'] ?>"
                  data-parent-id="<?= (int)$m['id'] ?>"
                  data-sasaran-id="<?= (int)$d['sasaran_id'] ?>"
                  data-indikator="<?= html_escape($d['indikator']) ?>"
                  data-t2025="<?= html_escape($d['t2025']) ?>"
                  data-t2026="<?= html_escape($d['t2026']) ?>"
                  data-t2027="<?= html_escape($d['t2027']) ?>"
                  data-t2028="<?= html_escape($d['t2028']) ?>"
                  data-t2029="<?= html_escape($d['t2029']) ?>"
                  data-t2030="<?= html_escape($d['t2030']) ?>"
                  data-keterangan="<?= html_escape($d['keterangan']) ?>">
                  <i class="notika-icon notika-edit"></i>
                </button>

                      <button class="btn btn-danger btn-sm BtnHapusDetail" data-id="<?= $d['id'] ?>">
                        <i class="notika-icon notika-trash"></i>
                      </button>
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>

                <?php } else { ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td>
                    <b>NSPK:</b><br>

                        <?php if(!empty($m['norma_list'])){ ?>
                          <b>Norma:</b><br>
                          <?php $i=0; foreach($m['norma_list'] as $x){ ?>
                            <div class="huruf-list">
                              <span class="huruf"><?= chr(97+$i++) ?>.</span>
                              <span class="isi"><?= html_escape($x['judul_nspk']) ?></span>
                            </div>
                          <?php } ?>
                          <br>
                        <?php } ?>

                        <?php if(!empty($m['standar_list'])){ ?>
                          <b>Standar:</b><br>
                          <?php $i=0; foreach($m['standar_list'] as $x){ ?>
                            <div class="huruf-list">
                              <span class="huruf"><?= chr(97+$i++) ?>.</span>
                              <span class="isi"><?= html_escape($x['judul_nspk']) ?></span>
                            </div>
                          <?php } ?>
                          <br>
                        <?php } ?>

                        <?php if(!empty($m['prosedur_list'])){ ?>
                          <b>Prosedur:</b><br>
                          <?php $i=0; foreach($m['prosedur_list'] as $x){ ?>
                            <div class="huruf-list">
                              <span class="huruf"><?= chr(97+$i++) ?>.</span>
                              <span class="isi"><?= html_escape($x['judul_nspk']) ?></span>
                            </div>
                          <?php } ?>
                          <br>
                        <?php } ?>

                        <?php if(!empty($m['kriteria_list'])){ ?>
                          <b>Kriteria:</b><br>
                          <?php $i=0; foreach($m['kriteria_list'] as $x){ ?>
                            <div class="huruf-list">
                              <span class="huruf"><?= chr(97+$i++) ?>.</span>
                              <span class="isi"><?= html_escape($x['judul_nspk']) ?></span>
                            </div>
                          <?php } ?>
                          <br>
                        <?php } ?>
                    <b>Sasaran RPJMD yang Relevan:</b><br><?= nl2br(html_escape($sasaranRelText)) ?>
                  </td>
                  <td><?= nl2br(html_escape($tujuanText)) ?></td>

                  <td colspan="8" class="text-center"><i>Belum ada indikator</i></td>
                  <td>-</td>

                  <td class="text-center">
                    <div class="btn-group-flex">
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                    <?php
                      $normaPipe    = $m['nspk_norma_id'] ?? '';
                      $standarPipe  = $m['nspk_standar_id'] ?? '';
                      $prosedurPipe = $m['nspk_prosedur_id'] ?? '';
                      $kriteriaPipe = $m['nspk_kriteria_id'] ?? '';
                      ?>
                                            <button class="btn btn-info BtnEditMaster"
                          data-id="<?= $m['id'] ?>"

                          data-norma="<?= $normaPipe ?>"
                          data-standar="<?= $standarPipe ?>"
                          data-prosedur="<?= $prosedurPipe ?>"
                          data-kriteria="<?= $kriteriaPipe ?>"

                          data-sasaran-relevan-id="<?= $m['sasaran_relevan_id'] ?>"
                          data-tujuan-id="<?= $m['tujuan_id'] ?>"
                      >

                      <i class="notika-icon notika-edit"></i>
                  </button>


                      <button class="btn btn-danger btn-sm BtnHapusMaster" data-id="<?= $m['id'] ?>">
                        <i class="notika-icon notika-trash"></i>
                      </button>
                    <?php } ?>
                    </div>
                  </td>

                  <td class="text-center">
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <button class="btn btn-success btn-sm BtnAddDetail" data-master-id="<?= $m['id'] ?>">
                        <i class="notika-icon bi-plus-lg"></i>
                      </button>
                    <?php } ?>
                  </td>
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
  <!-- ================= MODAL INPUT MASTER ================= -->
<div class="modal fade" id="ModalInputMaster" role="dialog">
  <div class="modal-dialog modal-lg" style="top:10%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><b>Tambah NSPK & Sasaran (Header)</b></h4>
      </div>

      <div class="modal-body">

        <!-- NORMA -->
        <div class="form-group">
          <label><b>Norma</b></label>
          <div class="nspk-wrapper">
            <div class="nspk-row">
              <select name="nspk_norma_id[]" class="form-control">
                <option value="">Pilih Norma</option>
                <?php foreach($ListNSPK as $n){
                  if($n['jenis_nspk']=="Norma"){ ?>
                    <option value="<?= $n['id'] ?>">
                      <?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?>
                    </option>
                <?php }} ?>
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
                <?php foreach($ListNSPK as $n){
                  if($n['jenis_nspk']=="Standar"){ ?>
                    <option value="<?= $n['id'] ?>">
                      <?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?>
                    </option>
                <?php }} ?>
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
                <?php foreach($ListNSPK as $n){
                  if($n['jenis_nspk']=="Prosedur"){ ?>
                    <option value="<?= $n['id'] ?>">
                      <?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?>
                    </option>
                <?php }} ?>
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
                <?php foreach($ListNSPK as $n){
                  if($n['jenis_nspk']=="Kriteria"){ ?>
                    <option value="<?= $n['id'] ?>">
                      <?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?>
                    </option>
                <?php }} ?>
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
                <option value="<?= (int)$s['id'] ?>"><?= html_escape($s['Sasaran']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Tujuan</b></label>
            <select id="TujuanId" class="form-control">
              <option value="">Pilih Tujuan</option>
              <?php if (!empty($ListTujuanPD)) { foreach ($ListTujuanPD as $t) { ?>
                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
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

          <!-- ================= NSPK DROPDOWN EDIT ================= -->

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

                  <!-- Tambahkan opsi untuk modal edit -->
                  <div style="display:none">
                    <div id="edit-opt-norma">
                      <?php foreach($ListNSPK as $n){ if($n['jenis_nspk']=="Norma"){ ?>
                        <option value="<?= $n['id'] ?>"><?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?></option>
                      <?php }} ?>
                    </div>

                    <div id="edit-opt-standar">
                      <?php foreach($ListNSPK as $n){ if($n['jenis_nspk']=="Standar"){ ?>
                        <option value="<?= $n['id'] ?>"><?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?></option>
                      <?php }} ?>
                    </div>

                    <div id="edit-opt-prosedur">
                      <?php foreach($ListNSPK as $n){ if($n['jenis_nspk']=="Prosedur"){ ?>
                        <option value="<?= $n['id'] ?>"><?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?></option>
                      <?php }} ?>
                    </div>

                    <div id="edit-opt-kriteria">
                      <?php foreach($ListNSPK as $n){ if($n['jenis_nspk']=="Kriteria"){ ?>
                        <option value="<?= $n['id'] ?>"><?= html_escape($n['kode_nspk']." - ".$n['judul_nspk']) ?></option>
                      <?php }} ?>
                    </div>
                  </div>


            <!-- ================= END NSPK DROPDOWN EDIT ================= -->

          <div class="form-group">
            <label><b>Sasaran RPJMD yang Relevan</b></label>
            <select id="EditSasaranRelevanId" class="form-control">
              <option value="">Pilih Sasaran RPJMD</option>
              <?php if (!empty($ListSasaranRPJMD)) { foreach ($ListSasaranRPJMD as $s) { ?>
                <option value="<?= (int)$s['id'] ?>"><?= html_escape($s['Sasaran']) ?></option>
              <?php }} ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Tujuan</b></label>
            <select id="EditTujuanId" class="form-control">
              <option value="">Pilih Tujuan</option>
              <?php if (!empty($ListTujuanPD)) { foreach ($ListTujuanPD as $t) { ?>
                <option value="<?= (int)$t['id'] ?>"><?= html_escape($t['tujuan_pd']) ?></option>
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

          <div class="form-group">
            <label><b>Sasaran PD (Opsional)</b></label>
            <select id="DetailSasaranId" class="form-control">
              <option value="">-- Tidak dipilih --</option>
              <?php foreach ($ListSasaranPD as $sp) { ?>
                <option value="<?= (int)$sp['id'] ?>">
                  <?= html_escape($sp['sasaran_pd']) ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Indikator</b></label>
            <textarea id="Indikator" class="form-control" rows="3" placeholder="Ketik indikator..."></textarea>
          </div>

          <div class="row">
            <div class="col-lg-2"><label><b>2025</b></label><input type="text" id="T2025" class="form-control"></div>
            <div class="col-lg-2"><label><b>2026</b></label><input type="text" id="T2026" class="form-control"></div>
            <div class="col-lg-2"><label><b>2027</b></label><input type="text" id="T2027" class="form-control"></div>
            <div class="col-lg-2"><label><b>2028</b></label><input type="text" id="T2028" class="form-control"></div>
            <div class="col-lg-2"><label><b>2029</b></label><input type="text" id="T2029" class="form-control"></div>
            <div class="col-lg-2"><label><b>2030</b></label><input type="text" id="T2030" class="form-control"></div>
          </div>

          <br>

          <div class="form-group">
            <label><b>Keterangan</b></label>
            <textarea id="Keterangan" class="form-control" rows="2" placeholder="Ketik keterangan..."></textarea>
          </div>

          <button class="btn btn-success notika-btn-success" id="BtnSimpanDetail"><b>SIMPAN</b></button>
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
                <option value="<?= (int)$sp['id'] ?>">
                  <?= html_escape($sp['sasaran_pd']) ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label><b>Indikator</b></label>
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
        </div>
      </div>
    </div>
  </div>

</div><!-- /.main-content -->

<style>
  .btn-group-flex {
  display: flex;
  justify-content: center; /* tengah */
  align-items: center;
  gap: 6px; /* jarak antar tombol */
  flex-wrap: nowrap;
}

.btn-group-flex .btn {
  margin: 0;
}

.nspk-row{
  display:flex;
  gap:6px;
  margin-bottom:6px;
}

.nspk-row select{
  flex:1;
}

.huruf-list {
    display: flex;
    align-items: flex-start;
    margin-bottom: 4px;
}

.huruf {
    width: 22px;       /* jarak huruf */
    flex-shrink: 0;
}

.isi {
    flex: 1;
}


</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
  var BaseURL    = '<?= base_url() ?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';

  jQuery(document).ready(function($){


    // =========================
    // FILTER PROVINSI & KAB/KOTA
    // =========================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

      $("#Provinsi").change(function() {
        if ($(this).val() === "") {
          $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
          return;
        }

        $.ajax({
          url: BaseURL + "Daerah/GetListKabKota",
          type: "POST",
          data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
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
          data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
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

      <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv);

        $.ajax({
          url: BaseURL + "Daerah/GetListKabKota",
          type: "POST",
          data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
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

    <?php } ?>
    // =========================
    // END FILTER
    // =========================

    // =========================
    // MASTER - SIMPAN
    // =========================

    function getNSPK(name){
  var arr = [];
  $("select[name='"+name+"']").each(function(){
    if($(this).val()!="") arr.push($(this).val());
  });
  return arr;
}

   $("#BtnSimpanMaster").click(function(){
 
var nspk_norma_id    = getNSPK("nspk_norma_id[]");
var nspk_standar_id  = getNSPK("nspk_standar_id[]");
var nspk_prosedur_id = getNSPK("nspk_prosedur_id[]");
var nspk_kriteria_id = getNSPK("nspk_kriteria_id[]");

 if(
   nspk_standar_id.length == 0 &&
   nspk_norma_id.length == 0 &&
   nspk_prosedur_id.length == 0 &&
   nspk_kriteria_id.length == 0
)
{
   alert("Minimal pilih salah satu NSPK!");
   return;
}


  var sasaranRelevanId = $("#SasaranRelevanId").val();
  var tujuanId = $("#TujuanId").val();

  if(!sasaranRelevanId){ alert('Sasaran RPJMD harus dipilih!'); return; }
  if(!tujuanId){ alert('Tujuan harus dipilih!'); return; }

  $.post(BaseURL + "Daerah/InputTujuanSasaranPD_Master", {
  nspk_standar_id: nspk_standar_id,
  nspk_norma_id: nspk_norma_id,
  nspk_prosedur_id: nspk_prosedur_id,
  nspk_kriteria_id: nspk_kriteria_id,
  sasaran_relevan_id: sasaranRelevanId,
  tujuan_id: tujuanId,
  [CSRF_NAME]: CSRF_TOKEN
})

  .done(function(res){
    if(res == '1') window.location.reload();
    else alert(res || 'Gagal simpan!');
  });
});



    // MASTER - BUKA EDIT
 $(document).on("click", ".BtnEditMaster", function(){

  let btn = $(this);

  $("#EditMasterId").val(btn.data("id"));

  function render(wrapperClass, dataAttr, name, optionId){

let raw = btn.attr(dataAttr) || "";
let ids = raw !== "" ? raw.split("|||") : [];

if(ids.length === 0) ids = [""];


    if(ids.length === 0) ids = [""];

    $(wrapperClass).html("");

    ids.forEach((val,i)=>{

        let row = `
            <div class="nspk-row">
                <select name="${name}[]" class="form-control">
                    <option value="">Pilih</option>
                    ${$(optionId).html()}
                </select>

                <button type="button" class="btn btn-success BtnAddRowEdit">+</button>

                ${i>0 ? `<button type="button" class="btn btn-danger BtnRemoveRowEdit">x</button>` : ""}
            </div>
        `;

        $(wrapperClass).append(row);
        $(wrapperClass).find("select").last().val(val);
    });
}


  render(".wrapper-norma",    "data-norma",    "edit_nspk_norma_id",    "#edit-opt-norma");
  render(".wrapper-standar",  "data-standar",  "edit_nspk_standar_id",  "#edit-opt-standar");
  render(".wrapper-prosedur", "data-prosedur", "edit_nspk_prosedur_id", "#edit-opt-prosedur");
  render(".wrapper-kriteria", "data-kriteria", "edit_nspk_kriteria_id", "#edit-opt-kriteria");

  $("#EditSasaranRelevanId").val(btn.data("sasaran-relevan-id"));
  $("#EditTujuanId").val(btn.data("tujuan-id"));

  $("#ModalEditMaster").modal("show");
});


// ADD ROW INPUT
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


// ADD ROW EDIT
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



    // MASTER - UPDATE
 $("#BtnUpdateMaster").click(function(){

  var id = $("#EditMasterId").val();

  // ambil isi dropdown NSPK edit
  var nspk_norma_id    = getNSPK("edit_nspk_norma_id[]");
var nspk_standar_id  = getNSPK("edit_nspk_standar_id[]");
var nspk_prosedur_id = getNSPK("edit_nspk_prosedur_id[]");
var nspk_kriteria_id = getNSPK("edit_nspk_kriteria_id[]");


  // validasi minimal pilih salah satu
  if(
  nspk_norma_id.length == 0 &&
  nspk_standar_id.length == 0 &&
  nspk_prosedur_id.length == 0 &&
  nspk_kriteria_id.length == 0
){
  alert("Minimal pilih salah satu NSPK!");
  return;
}

  // validasi sasaran & tujuan
  var sasaranRelevanId = $("#EditSasaranRelevanId").val();
  var tujuanId         = $("#EditTujuanId").val();

  if(!sasaranRelevanId){
    alert("Sasaran RPJMD harus dipilih!");
    return;
  }

  if(!tujuanId){
    alert("Tujuan harus dipilih!");
    return;
  }

  // kirim AJAX update
  $.post(BaseURL + "Daerah/EditTujuanSasaranPD_Master", {

    id: id,

    nspk_standar_id: nspk_standar_id,
nspk_norma_id: nspk_norma_id,
nspk_prosedur_id: nspk_prosedur_id,
nspk_kriteria_id: nspk_kriteria_id,


    sasaran_relevan_id: sasaranRelevanId,
    tujuan_id: tujuanId,

    [CSRF_NAME]: CSRF_TOKEN

  }).done(function(res){

      if(res == "1"){
        window.location.reload();
      } else {
        alert(res || "Gagal update header!");
      }

  }).fail(function(){
      alert("Request gagal (Update Master)");
  });

});



    // MASTER - HAPUS
    $(document).on("click", ".BtnHapusMaster", function(){
      var id = $(this).data('id');
      if(!id){ alert('ID tidak valid!'); return; }
      if(!confirm('Yakin hapus HEADER ini beserta semua indikatornya?')) return;

      $.post(BaseURL + "Daerah/HapusTujuanSasaranPD_Master", {
        id: id,
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        if(res == '1'){ window.location.reload(); }
        else { alert(res || 'Gagal hapus header!'); }
      }).fail(function(){
        alert('Gagal request (Hapus Header)');
      });
    });

    // =========================
    // DETAIL - OPEN ADD
    // =========================
    $(document).on("click", ".BtnAddDetail", function(){
      $("#DetailMasterId").val($(this).data('master-id'));
      $("#DetailSasaranId").val('');
      $("#Indikator").val('');
      $("#T2025,#T2026,#T2027,#T2028,#T2029,#T2030").val('');
      $("#Keterangan").val('');
      $("#ModalInputDetail").modal("show");
    });

    // DETAIL - SIMPAN
    $("#BtnSimpanDetail").click(function(){

  var masterId  = $("#DetailMasterId").val();
  var indikator = $("#Indikator").val().trim();

  if(!indikator){
    alert("Indikator wajib diisi!");
    return;
  }

  $.post(BaseURL + "Daerah/InputTujuanSasaranPD_Detail", {
    master_id: masterId,
    sasaran_id: $("#DetailSasaranId").val(),
    indikator: indikator,

    t2025: $("#T2025").val(),
    t2026: $("#T2026").val(),
    t2027: $("#T2027").val(),
    t2028: $("#T2028").val(),
    t2029: $("#T2029").val(),
    t2030: $("#T2030").val(),

    keterangan: $("#Keterangan").val(),

    [CSRF_NAME]: CSRF_TOKEN
  })
  .done(function(res){
    if(res == "1") window.location.reload();
    else alert(res);
  });

});



    // DETAIL - OPEN EDIT
    $(document).on("click", ".BtnEditDetail", function(){
  $("#EditDetailId").val($(this).data('id'));
  $("#EditDetailParentId").val($(this).data('parent-id'));
 $("#EditDetailSasaranId").val($(this).data('sasaran-id'));
  $("#EditIndikator").val($(this).data('indikator'));
  $("#EditT2025").val($(this).data('t2025'));
  $("#EditT2026").val($(this).data('t2026'));
  $("#EditT2027").val($(this).data('t2027'));
  $("#EditT2028").val($(this).data('t2028'));
  $("#EditT2029").val($(this).data('t2029'));
  $("#EditT2030").val($(this).data('t2030'));
  $("#EditKeterangan").val($(this).data('keterangan'));
  $("#ModalEditDetail").modal("show");
});


    // DETAIL - UPDATE
    $("#BtnUpdateDetail").click(function(){
      var id = $("#EditDetailId").val();
      var indikator = $("#EditIndikator").val().trim();
      if(!id){ alert('ID detail tidak valid!'); return; }

      $.post(BaseURL + "Daerah/EditTujuanSasaranPD_Detail", {
        id: id,
        sasaran_id: $("#EditDetailSasaranId").val(),
        indikator: indikator,
        t2025: $("#EditT2025").val().trim(),
        t2026: $("#EditT2026").val().trim(),
        t2027: $("#EditT2027").val().trim(),
        t2028: $("#EditT2028").val().trim(),
        t2029: $("#EditT2029").val().trim(),
        t2030: $("#EditT2030").val().trim(),
        keterangan: $("#EditKeterangan").val().trim(),
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        if(res == '1'){ window.location.reload(); }
        else { alert(res || 'Gagal update indikator!'); }
      }).fail(function(){
        alert('Gagal request (Update Indikator)');
      });
    });

    // DETAIL - HAPUS
    $(document).on("click", ".BtnHapusDetail", function(){
      var id = $(this).data('id');
      if(!id){ alert('ID detail tidak valid!'); return; }
      if(!confirm('Yakin hapus indikator ini?')) return;

      $.post(BaseURL + "Daerah/HapusTujuanSasaranPD_Detail", {
        id: id,
        [CSRF_NAME]: CSRF_TOKEN
      }).done(function(res){
        if(res == '1'){ window.location.reload(); }
        else { alert(res || 'Gagal hapus indikator!'); }
      }).fail(function(){
        alert('Gagal request (Hapus Indikator)');
      });
    });

  });
</script>

<div style="display:none">

  <div id="opt-norma">
    <?php foreach($ListNSPK as $n){
      if($n['jenis_nspk']=="Norma"){ ?>
        <option value="<?= $n['id'] ?>">
          <?= html_escape($n['judul_nspk']) ?>
        </option>
    <?php }} ?>
  </div>

  <div id="opt-standar">
    <?php foreach($ListNSPK as $n){
      if($n['jenis_nspk']=="Standar"){ ?>
        <option value="<?= $n['id'] ?>">
          <?= html_escape($n['judul_nspk']) ?>
        </option>
    <?php }} ?>
  </div>

  <div id="opt-prosedur">
    <?php foreach($ListNSPK as $n){
      if($n['jenis_nspk']=="Prosedur"){ ?>
        <option value="<?= $n['id'] ?>">
          <?= html_escape($n['judul_nspk']) ?>
        </option>
    <?php }} ?>
  </div>

  <div id="opt-kriteria">
    <?php foreach($ListNSPK as $n){
      if($n['jenis_nspk']=="Kriteria"){ ?>
        <option value="<?= $n['id'] ?>">
          <?= html_escape($n['judul_nspk']) ?>
        </option>
    <?php }} ?>
  </div>

</div>


</body>
</html>