<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
  <div class="data-table-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="data-table-list">

            <!-- FILTER PROVINSI & KAB/KOTA -->
            <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
              <div class="form-example-wrap" style="margin-bottom: 15px;">
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
                          <button class="btn btn-primary notika-btn-primary btn-block" id="FilterWilayah">
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
                  $wil = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                  $nama_wil = $wil ? html_escape($wil['Nama']) : 'Wilayah Tidak Ditemukan';
                ?>
                <div class="alert alert-info" style="margin-bottom: 15px;">
                  <strong>Wilayah terpilih:</strong> <?= $nama_wil ?>
                </div>
              <?php } ?>
            <?php } ?>
            <!-- END FILTER WILAYAH -->

            <div class="basic-tb-hd">
              <div class="button-icon-btn sm-res-mg-t-30">
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                  <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputInstansi">
                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Instansi</b>
                  </button>
                <?php } ?>
              </div>
            </div>

            <div class="table-responsive">
              <table id="data-table-basic" class="table table-striped table-keselarasan">
                <thead>
                  <tr>
                    <th style="width:40px; min-width:40px;">NO</th>
                    <th style="min-width:100px;">KODE INSTANSI</th>
                    <th style="min-width:200px;">NAMA PERANGKAT DAERAH</th>
                    <th style="min-width:150px;">INDUK KEMENTERIAN</th>
                    <th style="width:80px;">JML SUB UNIT</th>
                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                      <th style="min-width:100px;">PASSWORD</th>
                      <th style="min-width:80px;">TAHUN MULAI</th>
                      <th style="min-width:80px;">TAHUN AKHIR</th>
                      <th style="min-width:100px;">AKSI</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($Akun)) { ?>
                    <?php $No = 1; foreach ($Akun as $key) { ?>
                      <!-- HEADER ROW - INSTANSI -->
                      <tr class="header-row status-normal" 
                          data-instansi-id="<?= $key['id'] ?>" 
                          data-expanded="false"
                          style="cursor:pointer;">
                        <td class="text-center header-clickable no-column" onclick="toggleDetails('<?= $key['id'] ?>', this)">
                          <?= $No++ ?>
                        </td>
                        <td class="text-center header-clickable" onclick="toggleDetails('<?= $key['id'] ?>', this)" style="font-weight:bold;color:#007bff;">
                          <?= html_escape($key['kode_instansi'] ?? '-') ?>
                        </td>
                        <td class="uraian header-clickable" onclick="toggleDetails('<?= $key['id'] ?>', this)" style="font-weight:bold;">
                          <?= html_escape($key['nama']) ?>
                        </td>
                        <td class="uraian header-clickable" onclick="toggleDetails('<?= $key['id'] ?>', this)">
                          <?= html_escape($key['nama_kementerian'] ?? '-') ?>
                        </td>
                        <td class="text-center header-clickable" onclick="toggleDetails('<?= $key['id'] ?>', this)">
                          <span class="badge badge-detail">
                            <i class="fa fa-list"></i> <?= count($key['sub_unit']) ?>
                          </span>
                        </td>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <td style="vertical-align: middle; font-size:10px; word-break:break-all;">
                              <?= substr($key['password'], 0, 25) . '...' ?>
                          </td>
                          <td style="vertical-align:middle;text-align:center;"><?= $key['tahun_mulai'] ?></td>
                          <td style="vertical-align:middle;text-align:center;"><?= $key['tahun_akhir'] ?></td>
                          <td class="text-center" style="vertical-align:middle;">
                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                              <button
                                class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                                data-id="<?= $key['id'] ?>"
                                data-kode-instansi="<?= htmlspecialchars($key['kode_instansi'] ?? '', ENT_QUOTES) ?>"
                                data-nama="<?= htmlspecialchars($key['nama'], ENT_QUOTES) ?>"
                                data-tahun-mulai="<?= $key['tahun_mulai'] ?>"
                                data-tahun-akhir="<?= $key['tahun_akhir'] ?>"
                                data-idkementerian="<?= $key['idkementerian'] ?>"
                                title="Edit Instansi"
                              >
                                <i class="notika-icon notika-edit"></i>
                              </button>

                              <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" data-id="<?= $key['id'] ?>" title="Hapus Instansi">
                                <i class="notika-icon notika-trash"></i>
                              </button>
                            </div>
                          </td>
                        <?php } ?>
                      </tr>
                      
                      <!-- DETAIL ROW - SUB UNIT -->
                      <?php if (!empty($key['sub_unit'])) { ?>
                        <tr class="detail-row detail-hidden" data-instansi-id="<?= $key['id'] ?>">
                          <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '9' : '6' ?>" style="padding:0;">
                            <div class="detail-container">
                              <table class="table table-bordered table-condensed" style="margin:0; font-size:11px; min-width:850px;">
                                <thead>
                                  <tr style="background:#f8f9fa;">
                                    <th style="width:12%;vertical-align:middle;">KODE SUB UNIT</th>
                                    <th style="width:28%;vertical-align:middle;">SUB UNIT</th>
                                    <th style="width:40%;vertical-align:middle;">BIDANG URUSAN / BIDANG UNSUR</th>
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                      <th style="width:20%;vertical-align:middle;">AKSI</th>
                                    <?php } ?>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($key['sub_unit'] as $su) { ?>
                                    <tr>
                                      <td class="text-center">
                                        <span class="badge badge-primary" style="background:#17a2b8;font-size:11px;">
                                          <?= html_escape($su['kode_sub_unit']) ?>
                                        </span>
                                      </td>
                                      <td>
                                        <strong><?= html_escape($su['nama_sub_unit']) ?></strong>
                                        <?php if ($su['parent_id'] > 0): ?>
                                          <span class="label label-primary" style="font-size:9px; margin-left:5px;">
                                            <i class="fa fa-level-up"></i> 
                                            <?php 
                                              // Cari nama parent
                                              $parentNama = '-';
                                              foreach ($key['sub_unit'] as $parent) {
                                                if ($parent['id'] == $su['parent_id']) {
                                                  $parentNama = $parent['nama_sub_unit'];
                                                  break;
                                                }
                                              }
                                              echo html_escape($parentNama);
                                            ?>
                                          </span>
                                        <?php endif; ?>
                                      </td>
                                      <td>
                                        <?php if (!empty($su['bidang_urusan_list'])): ?>
                                          <?php foreach ($su['bidang_urusan_list'] as $bidang): ?>
                                            <span class="label label-default" style="background:#f0f0f0;color:#333;display:inline-block;margin:1px;padding:2px 8px;border:1px solid #ddd;border-radius:3px;font-size:10px;">
                                              <?= html_escape($bidang['kode']) ?> - <?= html_escape($bidang['nama']) ?>
                                            </span>
                                          <?php endforeach; ?>
                                        <?php else: ?>
                                          <span class="text-muted">-</span>
                                        <?php endif; ?>
                                      </td>
                                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td class="text-center" style="vertical-align:middle;">
                                          <div class="btn-group-aksi">
                                            <button class="btn btn-warning btn-xs BtnEditSubUnit"
                                                data-id="<?= $su['id'] ?>"
                                                data-instansi-id="<?= $key['id'] ?>"
                                                title="Edit Sub Unit"
                                                type="button">
                                                <i class="notika-icon notika-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-xs BtnHapusSubUnit"
                                                data-id="<?= $su['id'] ?>"
                                                title="Hapus Sub Unit"
                                                type="button">
                                                <i class="notika-icon notika-trash"></i>
                                            </button>
                                          </div>
                                        </td>
                                      <?php } ?>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                      
                      <!-- BARIS TAMBAH SUB UNIT - HANYA ROLE 3 -->
                      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                        <tr class="detail-row detail-hidden" data-instansi-id="<?= $key['id'] ?>" style="background:#fafafa;">
                          <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '9' : '6' ?>" class="text-center" style="padding:5px;">
                            <button class="btn btn-success btn-sm btn-add-sub-unit"
                                data-instansi-id="<?= $key['id'] ?>"
                                data-instansi-nama="<?= html_escape($key['nama']) ?>"
                                data-parent-id="0"
                                data-parent-nama="(Root)"
                                title="Tambah Sub Unit"
                                type="button">
                                <i class="notika-icon notika-plus"></i> Tambah Sub Unit
                            </button>
                          </td>
                        </tr>
                      <?php } ?>
                      
                    <?php } ?>
                  <?php } else { ?>
                    <tr>
                      <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '9' : '6' ?>" class="text-center no-data">
                        <i class="fa fa-inbox" style="font-size: 40px; display: block; color: #ddd;"></i>
                        <strong>Belum ada data Instansi</strong>
                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                          <br>
                          <small class="text-muted">Klik tombol <strong>"Tambah Instansi"</strong> untuk mulai mengisi data.</small>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- /.table-responsive -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ================================================================ -->
  <!-- MODAL INPUT INSTANSI -->
  <!-- ================================================================ -->
  <div class="modal fade" id="ModalInputInstansi" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Instansi</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">

                <!-- KODE INSTANSI -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Kode Instansi</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="KodeInstansi" placeholder="Contoh: DIN-PEND-001">
                          <small class="text-muted">Kode unik untuk instansi ini</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NAMA INSTANSI -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Nama Instansi</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="Username" placeholder="Contoh: Dinas Pendidikan">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- PASSWORD -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Password</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="Password" placeholder="Isi password">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- INDUK KEMENTERIAN -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Induk Kementerian</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div id="kementerianContainerAdd"></div>
                        <button type="button" class="btn btn-info btn-sm" id="addKementerianRowAdd" style="margin-top:8px;">
                          + Tambah Induk Kementerian
                        </button>
                        <div style="margin-top:6px; font-size:12px; color:#888;">
                          * Boleh pilih lebih dari 1
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- TAHUN MULAI -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Mulai</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="TahunMulai" placeholder="Contoh: 2024">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- TAHUN AKHIR -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Akhir</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="TahunAkhir" placeholder="Contoh: 2029">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                      <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
                    </div>
                  </div>
                </div>

              </div><!-- /.form-example-wrap -->
            </div>
          </div>
        </div><!-- /.modal-body -->
      </div>
    </div>
  </div>

  <!-- ================================================================ -->
  <!-- MODAL EDIT INSTANSI -->
  <!-- ================================================================ -->
  <div class="modal fade" id="ModalEditInstansi" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Instansi</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">

                <input type="hidden" id="Id">

                <!-- KODE INSTANSI -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Kode Instansi</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_KodeInstansi" placeholder="Contoh: DIN-PEND-001">
                          <small class="text-muted">Kode unik untuk instansi ini</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- NAMA INSTANSI -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Nama Instansi</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_Username">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- PASSWORD -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Password</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_Password" placeholder="Isi Jika Ganti Password">
                          <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- INDUK KEMENTERIAN -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Induk Kementerian</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div id="kementerianContainerEdit"></div>
                        <button type="button" class="btn btn-info btn-sm" id="addKementerianRowEdit" style="margin-top:8px;">
                          + Tambah Induk Kementerian
                        </button>
                        <div style="margin-top:6px; font-size:12px; color:#888;">
                          * Boleh pilih lebih dari 1
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- TAHUN MULAI -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Mulai</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_TahunMulai">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- TAHUN AKHIR -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Tahun Akhir</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="_TahunAkhir">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-example-int">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                      <button class="btn btn-success notika-btn-success" id="Edit"><b>SIMPAN</b></button>
                    </div>
                  </div>
                </div>

              </div><!-- /.form-example-wrap -->
            </div>
          </div>
        </div><!-- /.modal-body -->
      </div>
    </div>
  </div>

  <!-- ================================================================ -->
  <!-- MODAL SUB UNIT -->
  <!-- ================================================================ -->
  <div class="modal fade" id="ModalSubUnit" role="dialog">
    <div class="modal-dialog modal-md" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%);">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="ModalSubUnitTitle">Tambah Sub Unit</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-example-wrap" style="padding:5px;">
                <input type="hidden" id="sub_unit_id">
                <input type="hidden" id="sub_unit_instansi_id">
                <input type="hidden" id="sub_unit_parent_id">
                
                <!-- Informasi Parent -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Parent</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <span class="label label-info" id="sub_unit_parent_display" style="font-size:14px; padding:8px 15px;">
                            <i class="fa fa-database"></i> (Root)
                          </span>
                          <button type="button" class="btn btn-xs btn-link" id="toggleParentDropdown" style="padding:0 5px;">
                            <i class="fa fa-edit"></i> Ubah Parent
                          </button>
                          <select class="form-control input-sm" id="sub_unit_parent_dropdown" style="margin-top:5px; display:none;">
                            <option value="0">-- Pilih Parent --</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- KODE SUB UNIT -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Kode Sub Unit</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="sub_unit_kode" placeholder="Contoh: 1">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- NAMA SUB UNIT -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Nama Sub Unit</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="sub_unit_nama" placeholder="Contoh: Sekretariat">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- LEVEL - OTOMATIS 4 (HIDDEN) -->
                <input type="hidden" id="sub_unit_level" value="4">
                
                <!-- PASSWORD -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Password</b> <span class="text-danger">*</span></label>
                      </div>
                      <div class="col-lg-8">
                        <div class="nk-int-st">
                          <input type="text" class="form-control input-sm" id="sub_unit_password" placeholder="Isi password">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- BIDANG URUSAN -->
                <div class="form-example-int form-horizental">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <label class="hrzn-fm"><b>Bidang Urusan / Bidang Unsur</b></label>
                      </div>
                      <div class="col-lg-8">
                        <div id="bidangUrusanContainerSub">
                          <div class="bidang-urusan-row" style="display:flex; gap:8px; margin-bottom:6px;">
                            <select class="form-control input-sm urusan-select-sub" style="flex:1;" data-level="1">
                              <option value="">-- Pilih Urusan --</option>
                            </select>
                            <select class="form-control input-sm bidang-select-sub" style="flex:1;" data-level="2" disabled>
                              <option value="">-- Pilih Bidang Urusan / Unsur --</option>
                            </select>
                            <button type="button" class="btn btn-danger btn-sm remove-bidang-urusan-sub">Hapus</button>
                          </div>
                        </div>
                        <button type="button" class="btn btn-info btn-sm" id="addBidangUrusanRowSub" style="margin-top:8px;">
                          + Tambah Bidang Urusan / Unsur
                        </button>
                        <div style="margin-top:6px; font-size:12px; color:#888;">
                          * Boleh pilih lebih dari 1 bidang urusan/unsur
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-example-int">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-8">
                      <button class="btn btn-success notika-btn-success" id="SimpanSubUnit"><b>SIMPAN</b></button>
                      <button class="btn btn-danger" id="HapusSubUnit" style="display:none;"><b>HAPUS</b></button>
                    </div>
                  </div>
                </div>
                
              </div><!-- /.form-example-wrap -->
            </div>
          </div>
        </div><!-- /.modal-body -->
      </div>
    </div>
  </div>

</div><!-- /.main-content -->

<style>
  .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
  .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
  .filter-group label { font-size:14px; margin-bottom:5px; }
  .filter-select { width:260px; font-size:14px; padding:5px 8px; }
  @media (max-width:768px){
    .filter-row{ flex-direction:column; gap:15px; }
    .filter-select{ width:100%; }
  }
  
  /* Styling untuk Header Row */
  .header-row {
    background-color: #f8f9fa !important;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s ease;
  }
  .header-row:hover {
    background-color: #e9ecef !important;
  }
  .header-row.status-normal {
    border-left: 4px solid #28a745;
  }
  .header-row .no-column {
    font-weight: 700;
    color: #495057;
  }
  .header-clickable {
    cursor: pointer;
  }
  
  /* Styling untuk Detail Row */
  .detail-row {
    background-color: #ffffff;
    transition: background-color 0.2s ease;
  }
  .detail-row:hover {
    background-color: #f5f5f5;
  }
  .detail-row.detail-hidden {
    display: none !important;
  }
  .detail-container {
    padding: 5px 5px 5px 30px;
    overflow-x: auto;
  }
  .detail-container .table {
    min-width: 850px;
  }
  
  /* Badge */
  .badge-detail {
    background-color: #17a2b8;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 11px;
  }
  
  /* Tombol */
  .btn-aksi { padding: 3px 6px; font-size: 0.8rem; margin: 0 1px; }
  .btn-group-aksi {
    display: flex;
    justify-content: center;
    gap: 3px;
    flex-wrap: wrap;
  }
  .no-data {
    padding: 30px 0;
    color: #999;
  }
  
  /* Modal */
  .modal-body {
    max-height: 70vh;
    overflow-y: auto;
    padding: 15px 20px;
  }
  .modal-content {
    max-height: 95vh;
    overflow: hidden;
  }
  
  /* Bidang Urusan Row */
  .bidang-urusan-row {
    display: flex;
    gap: 8px;
    margin-bottom: 6px;
  }
  .bidang-urusan-row select {
    flex: 1;
  }
  
  /* Parent display di modal */
  #sub_unit_parent_display {
    font-size: 14px;
    padding: 8px 15px;
    display: inline-block;
  }
  #sub_unit_parent_display .fa-database {
    color: #5bc0de;
  }
  #sub_unit_parent_display .fa-level-up {
    color: #f0ad4e;
  }
  #sub_unit_parent_dropdown {
    max-width: 300px;
  }
  #toggleParentDropdown {
    color: #337ab7;
    text-decoration: none;
    font-size: 12px;
  }
  
  /* Label untuk bidang urusan di detail */
  .label-default {
    background: #f0f0f0;
    color: #333;
    display: inline-block;
    margin: 1px;
    padding: 2px 8px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 10px;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .table-keselarasan {
      font-size: 10px;
    }
    .table-keselarasan th, .table-keselarasan td {
      padding: 4px;
    }
    .btn-aksi {
      font-size: 0.7rem;
      padding: 2px 4px;
    }
    .modal-body {
      max-height: 60vh;
      padding: 10px 15px;
    }
  }
  
  /* DataTable State Save - Mempertahankan posisi */
  .dataTables_wrapper .dataTables_info {
    font-size: 12px;
  }
  .dataTables_wrapper .dataTables_paginate {
    font-size: 12px;
  }
</style>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery-price-slider.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.scrollUp.min.js"></script>
<script src="../js/meanmenu/jquery.meanmenu.js"></script>
<script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>
<script src="../js/main.js"></script>
<!-- jQuery UI untuk Sortable -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
  
  var BaseURL = '<?=base_url()?>';
  var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
  var CSRF_NAME  = '<?= $this->security->get_csrf_token_name() ?>';
  var IS_ROLE_3 = '<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '1' : '0' ?>';

  // =====================================================
  // TOGGLE DETAILS
  // =====================================================
  function toggleDetails(instansiId, element) {
    var $headerRow = $('tr.header-row[data-instansi-id="' + instansiId + '"]');
    var $detailRows = $('tr.detail-row[data-instansi-id="' + instansiId + '"]');
    
    var isExpanded = $headerRow.data('expanded') === true;
    
    if (isExpanded) {
      $detailRows.addClass('detail-hidden');
      $headerRow.data('expanded', false);
      var noText = $headerRow.find('.no-column').text().replace('▼', '');
      $headerRow.find('.no-column').html(noText);
    } else {
      $detailRows.removeClass('detail-hidden');
      $headerRow.data('expanded', true);
      var noText = $headerRow.find('.no-column').text().trim();
      if (!noText.includes('▼')) {
        $headerRow.find('.no-column').html(noText + ' ▼');
      }
    }
  }

  // =====================================================
  // DATA KEMENTERIAN
  // =====================================================
  var KEMENTERIAN_LIST = <?= json_encode($Kementerian) ?>;
  
  function buildKementerianSelect(nameAttr, selectedVal) {
    var html = '<div class="kementerian-row" style="display:flex; gap:8px; margin-bottom:6px;">';
    html += '<select class="form-control input-sm kementerian-select" name="'+nameAttr+'[]" style="flex:1;">';
    html += '<option value="">-- Pilih Kementerian --</option>';

    KEMENTERIAN_LIST.forEach(function(k){
      var sel = (selectedVal && String(selectedVal) === String(k.username)) ? 'selected' : '';
      html += '<option value="'+k.username+'" '+sel+'>'+k.username+'</option>';
    });

    html += '</select>';
    html += '<button type="button" class="btn btn-danger btn-sm remove-kementerian">Hapus</button>';
    html += '</div>';

    return html;
  }

  function initKementerianContainer(containerId, nameAttr, selectedVals) {
    var $c = $('#'+containerId);
    $c.html('');

    if (!selectedVals || selectedVals.length === 0) {
      $c.append(buildKementerianSelect(nameAttr, null));
    } else {
      selectedVals.forEach(function(val){
        $c.append(buildKementerianSelect(nameAttr, val));
      });
    }
  }

  function collectKementerian(containerId) {
    var arr = [];
    $('#'+containerId+' select.kementerian-select').each(function(){
      var v = $(this).val();
      if (v) arr.push(v);
    });
    return arr.filter(function(v, i, a){ return a.indexOf(v) === i; });
  }

  // init saat load
  initKementerianContainer('kementerianContainerAdd', 'idkementerian', []);

  $(document).on('click', '#addKementerianRowAdd', function(){
    $('#kementerianContainerAdd').append(buildKementerianSelect('idkementerian', null));
  });

  $(document).on('click', '#addKementerianRowEdit', function(){
    $('#kementerianContainerEdit').append(buildKementerianSelect('idkementerian', null));
  });

  $(document).on('click', '.remove-kementerian', function(){
    $(this).closest('.kementerian-row').remove();
  });

  // =====================================================
  // NOMENKLATUR - DROPDOWN HIERARKI (UNTUK SUB UNIT)
  // =====================================================

  function loadUrusan(selectElement) {
    $.ajax({
      url: BaseURL + 'Daerah/getUrusanNomenklatur',
      type: 'POST',
      data: { [CSRF_NAME]: CSRF_TOKEN },
      success: function(res) {
        var data = typeof res === 'string' ? JSON.parse(res) : res;
        var select = $(selectElement);
        select.find('option:not(:first)').remove();
        
        if (data.length > 0) {
          $.each(data, function(i, item) {
            select.append('<option value="' + item.Kode + '">' + item.Kode + ' - ' + item.Nomenklatur + '</option>');
          });
        }
        select.prop('disabled', false);
      },
      error: function() {
        $(selectElement).html('<option value="">-- Gagal memuat data --</option>');
      }
    });
  }

  function loadBidangUrusan(urusanSelect, bidangSelect) {
    var kodeUrusan = $(urusanSelect).val();
    
    if (!kodeUrusan) {
      $(bidangSelect).html('<option value="">-- Pilih Bidang Urusan / Unsur --</option>');
      $(bidangSelect).prop('disabled', true);
      return;
    }
    
    $(bidangSelect).html('<option value="">Memuat...</option>');
    $(bidangSelect).prop('disabled', true);
    
    $.ajax({
      url: BaseURL + 'Daerah/getBidangUrusanNomenklatur',
      type: 'POST',
      data: {
        kode_urusan: kodeUrusan,
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res) {
        var data = typeof res === 'string' ? JSON.parse(res) : res;
        var select = $(bidangSelect);
        select.find('option:not(:first)').remove();
        select.prop('disabled', false);
        
        if (data.length > 0) {
          $.each(data, function(i, item) {
            select.append('<option value="' + item.Kode + '">' + item.Kode + ' - ' + item.Nomenklatur + '</option>');
          });
        } else {
          select.append('<option value="">-- Tidak ada bidang urusan / unsur --</option>');
        }
      },
      error: function() {
        $(bidangSelect).html('<option value="">-- Gagal memuat data --</option>');
        $(bidangSelect).prop('disabled', false);
      }
    });
  }

  $(document).on('change', '.urusan-select-sub', function() {
    var row = $(this).closest('.bidang-urusan-row');
    var bidangSelect = row.find('.bidang-select-sub');
    loadBidangUrusan(this, bidangSelect);
  });

  // =====================================================
  // BIDANG URUSAN - TAMBAH ROW
  // =====================================================

  $(document).on('click', '#addBidangUrusanRowSub', function() {
    var row = `
      <div class="bidang-urusan-row" style="display:flex; gap:8px; margin-bottom:6px;">
        <select class="form-control input-sm urusan-select-sub" style="flex:1;" data-level="1">
          <option value="">-- Pilih Urusan --</option>
        </select>
        <select class="form-control input-sm bidang-select-sub" style="flex:1;" data-level="2" disabled>
          <option value="">-- Pilih Bidang Urusan / Unsur --</option>
        </select>
        <button type="button" class="btn btn-danger btn-sm remove-bidang-urusan-sub">Hapus</button>
      </div>
    `;
    $('#bidangUrusanContainerSub').append(row);
    loadUrusan($('#bidangUrusanContainerSub .urusan-select-sub:last'));
  });

  $(document).on('click', '.remove-bidang-urusan-sub', function() {
    var container = $(this).closest('.bidang-urusan-row').parent();
    if (container.find('.bidang-urusan-row').length > 1) {
      $(this).closest('.bidang-urusan-row').remove();
    } else {
      alert('Minimal harus ada 1 pilihan bidang urusan / unsur!');
    }
  });

  function collectBidangUrusan() {
    var arr = [];
    $('#bidangUrusanContainerSub .bidang-select-sub').each(function() {
      var val = $(this).val();
      if (val) arr.push(val);
    });
    return arr;
  }

  // =====================================================
  // PARENT SUB UNIT
  // =====================================================

  function loadParentOptions(instansiId, currentId, selectedParentId) {
    $.ajax({
      url: BaseURL + 'Daerah/GetSubUnitForParent',
      type: 'POST',
      data: {
        instansi_id: instansiId,
        current_id: currentId,
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res) {
        var data = typeof res === 'string' ? JSON.parse(res) : res;
        var select = $('#sub_unit_parent_dropdown');
        select.find('option:not(:first)').remove();
        
        if (data.length > 0) {
          $.each(data, function(i, item) {
            var sel = (selectedParentId && item.id == selectedParentId) ? 'selected' : '';
            var levelText = item.level ? ' (Lv.' + item.level + ')' : '';
            select.append('<option value="' + item.id + '" ' + sel + '>' + 
              item.kode_sub_unit + ' - ' + item.nama_sub_unit + levelText + '</option>');
          });
        }
      }
    });
  }

  $(document).on('click', '#toggleParentDropdown', function() {
    $('#sub_unit_parent_dropdown').slideToggle(200);
    $(this).find('i').toggleClass('fa-edit fa-check');
    if ($(this).find('i').hasClass('fa-check')) {
      $(this).html('<i class="fa fa-check"></i> Selesai');
    } else {
      $(this).html('<i class="fa fa-edit"></i> Ubah Parent');
    }
  });

  $(document).on('change', '#sub_unit_parent_dropdown', function() {
    var val = $(this).val();
    var text = $(this).find('option:selected').text();
    var instansiNama = $('.btn-add-sub-unit').data('instansi-nama') || 'Instansi';
    
    if (val == '0') {
      $('#sub_unit_parent_display').html('<i class="fa fa-database"></i> ' + instansiNama + ' (Root)').removeClass('label-primary').addClass('label-info');
      $('#sub_unit_parent_id').val(0);
    } else {
      $('#sub_unit_parent_display').html('<i class="fa fa-level-up"></i> ' + text).removeClass('label-info').addClass('label-primary');
      $('#sub_unit_parent_id').val(val);
    }
  });

  // =====================================================
  // SUB UNIT CRUD - BUTTONS
  // =====================================================

  // Tombol Tambah Sub Unit (di baris detail)
  $(document).on('click', '.btn-add-sub-unit', function(e) {
    e.preventDefault();
    var instansiId = $(this).data('instansi-id');
    var instansiNama = $(this).data('instansi-nama');
    var parentId = $(this).data('parent-id') || 0;
    var parentNama = $(this).data('parent-nama') || '(Root)';
    
    $('#sub_unit_id').val('');
    $('#sub_unit_instansi_id').val(instansiId);
    $('#sub_unit_parent_id').val(parentId);
    
    if (parentId == 0) {
      $('#sub_unit_parent_display').html('<i class="fa fa-database"></i> ' + instansiNama + ' (Root)').removeClass('label-primary').addClass('label-info');
    } else {
      $('#sub_unit_parent_display').html('<i class="fa fa-level-up"></i> ' + parentNama).removeClass('label-info').addClass('label-primary');
    }
    
    $('#sub_unit_kode, #sub_unit_nama, #sub_unit_password').val('');
    // Level otomatis 4 (hidden)
    $('#sub_unit_level').val('4');
    $('#sub_unit_parent_dropdown').val(parentId).hide();
    $('#toggleParentDropdown').html('<i class="fa fa-edit"></i> Ubah Parent');
    
    // Reset bidang urusan
    var container = $('#bidangUrusanContainerSub');
    container.html(`
      <div class="bidang-urusan-row" style="display:flex; gap:8px; margin-bottom:6px;">
        <select class="form-control input-sm urusan-select-sub" style="flex:1;" data-level="1">
          <option value="">-- Pilih Urusan --</option>
        </select>
        <select class="form-control input-sm bidang-select-sub" style="flex:1;" data-level="2" disabled>
          <option value="">-- Pilih Bidang Urusan / Unsur --</option>
        </select>
        <button type="button" class="btn btn-danger btn-sm remove-bidang-urusan-sub">Hapus</button>
      </div>
    `);
    loadUrusan(container.find('.urusan-select-sub'));
    
    loadParentOptions(instansiId, 0, parentId);
    
    $('#ModalSubUnitTitle').text('Tambah Sub Unit - ' + instansiNama + ' (di bawah ' + parentNama + ')');
    $('#HapusSubUnit').hide();
    $('#ModalSubUnit').modal('show');
  });

  // Tombol Edit Sub Unit (di baris detail)
  $(document).on('click', '.BtnEditSubUnit', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var instansiId = $(this).data('instansi-id');
    var instansiNama = $(this).closest('tr.header-row').find('td:eq(1)').text().trim();
    
    $.ajax({
      url: BaseURL + 'Daerah/GetSubUnitById',
      type: 'POST',
      data: {
        id: id,
        [CSRF_NAME]: CSRF_TOKEN
      },
      success: function(res) {
        var data = typeof res === 'string' ? JSON.parse(res) : res;
        if (data.status === 'success') {
          var item = data.data;
          
          $('#sub_unit_id').val(item.id);
          $('#sub_unit_instansi_id').val(item.instansi_id);
          $('#sub_unit_parent_id').val(item.parent_id || 0);
          $('#sub_unit_kode').val(item.kode_sub_unit);
          $('#sub_unit_nama').val(item.nama_sub_unit);
          // Level otomatis 4
          $('#sub_unit_level').val('4');
          $('#sub_unit_password').val('');
          
          if (item.parent_id == 0 || !item.parent_id) {
            $('#sub_unit_parent_display').html('<i class="fa fa-database"></i> ' + instansiNama + ' (Root)').removeClass('label-primary').addClass('label-info');
          } else {
            // Cari nama parent
            $.ajax({
              url: BaseURL + 'Daerah/GetSubUnitById',
              type: 'POST',
              data: {
                id: item.parent_id,
                [CSRF_NAME]: CSRF_TOKEN
              },
              async: false,
              success: function(parentRes) {
                var parentData = typeof parentRes === 'string' ? JSON.parse(parentRes) : parentRes;
                if (parentData.status === 'success') {
                  $('#sub_unit_parent_display').html('<i class="fa fa-level-up"></i> ' + parentData.data.nama_sub_unit).removeClass('label-info').addClass('label-primary');
                }
              }
            });
          }
          
          $('#sub_unit_parent_dropdown').val(item.parent_id || 0).hide();
          $('#toggleParentDropdown').html('<i class="fa fa-edit"></i> Ubah Parent');
          
          // Set bidang urusan
          var bidangIds = item.bidang_urusan_ids || [];
          setBidangUrusanEdit(bidangIds);
          
          loadParentOptions(item.instansi_id, item.id, item.parent_id || 0);
          
          $('#ModalSubUnitTitle').text('Edit Sub Unit - ' + instansiNama);
          $('#HapusSubUnit').show();
          $('#ModalSubUnit').modal('show');
        } else {
          alert(data.message || 'Gagal mengambil data!');
        }
      },
      error: function() {
        alert('Gagal menghubungi server!');
      }
    });
  });

  function setBidangUrusanEdit(bidangIds) {
    var container = $('#bidangUrusanContainerSub');
    container.html('');
    
    if (bidangIds && bidangIds.length > 0) {
      $.each(bidangIds, function(i, kode) {
        var row = `
          <div class="bidang-urusan-row" style="display:flex; gap:8px; margin-bottom:6px;">
            <select class="form-control input-sm urusan-select-sub" style="flex:1;" data-level="1">
              <option value="">-- Pilih Urusan --</option>
            </select>
            <select class="form-control input-sm bidang-select-sub" style="flex:1;" data-level="2">
              <option value="">-- Pilih Bidang Urusan / Unsur --</option>
            </select>
            <button type="button" class="btn btn-danger btn-sm remove-bidang-urusan-sub">Hapus</button>
          </div>
        `;
        container.append(row);
        
        var urusanSelect = container.find('.urusan-select-sub:last');
        var bidangSelect = container.find('.bidang-select-sub:last');
        
        loadUrusan(urusanSelect);
        setTimeout(function() {
          $.ajax({
            url: BaseURL + 'Daerah/getNomenklaturByKode',
            type: 'POST',
            data: {
              kode: kode,
              [CSRF_NAME]: CSRF_TOKEN
            },
            async: false,
            success: function(res) {
              var data = typeof res === 'string' ? JSON.parse(res) : res;
              if (data.status === 'success') {
                var kodeUrusan = kode.split('.')[0];
                urusanSelect.val(kodeUrusan).trigger('change');
                setTimeout(function() {
                  bidangSelect.val(kode);
                }, 200);
              }
            }
          });
        }, 300);
      });
    } else {
      container.html(`
        <div class="bidang-urusan-row" style="display:flex; gap:8px; margin-bottom:6px;">
          <select class="form-control input-sm urusan-select-sub" style="flex:1;" data-level="1">
            <option value="">-- Pilih Urusan --</option>
          </select>
          <select class="form-control input-sm bidang-select-sub" style="flex:1;" data-level="2" disabled>
            <option value="">-- Pilih Bidang Urusan / Unsur --</option>
          </select>
          <button type="button" class="btn btn-danger btn-sm remove-bidang-urusan-sub">Hapus</button>
        </div>
      `);
      loadUrusan(container.find('.urusan-select-sub'));
    }
  }

  // Tombol Hapus Sub Unit (di baris detail)
  $(document).on('click', '.BtnHapusSubUnit', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    
    if (!id) {
      alert('ID tidak valid!');
      return;
    }
    
    if (!confirm("Yakin hapus Sub Unit ini?")) return;
    
    $.post(BaseURL + 'Daerah/HapusSubUnit', {
      id: id,
      [CSRF_NAME]: CSRF_TOKEN
    }).done(function(res) {
      var response = typeof res === 'string' ? JSON.parse(res) : res;
      if (response.status === 'success') {
        location.reload();
      } else {
        alert(response.message || "Gagal hapus!");
      }
    });
  });

  // =====================================================
  // SIMPAN SUB UNIT
  // =====================================================

  $('#SimpanSubUnit').click(function() {
    var id = $('#sub_unit_id').val();
    var instansiId = $('#sub_unit_instansi_id').val();
    var kode = $('#sub_unit_kode').val().trim();
    var nama = $('#sub_unit_nama').val().trim();
    var password = $('#sub_unit_password').val().trim();
    var parentId = $('#sub_unit_parent_dropdown').val() || 0;
    var bidangUrusan = collectBidangUrusan();
    // Level OTOMATIS 4
    var level = 4;
    
    if (!instansiId) {
      alert('Instansi tidak valid!');
      return;
    }
    if (!kode) {
      alert('Kode Sub Unit harus diisi!');
      return;
    }
    if (!nama) {
      alert('Nama Sub Unit harus diisi!');
      return;
    }
    if (!password && !id) {
      alert('Password harus diisi!');
      return;
    }
    
    var url = id ? BaseURL + 'Daerah/EditSubUnit' : BaseURL + 'Daerah/InputSubUnit';
    var data = {
      instansi_id: instansiId,
      kode_sub_unit: kode,
      nama_sub_unit: nama,
      level: level,
      parent_id: parentId || 0,
      bidang_urusan_id: bidangUrusan,
      [CSRF_NAME]: CSRF_TOKEN
    };
    
    if (id) {
      data.id = id;
    }
    if (password) {
      data.password = password;
    }
    
    $('#SimpanSubUnit').prop('disabled', true).text('Menyimpan...');
    
    $.post(url, data).done(function(res) {
      var response = typeof res === 'string' ? JSON.parse(res) : res;
      if (response.status === 'success') {
        $('#ModalSubUnit').modal('hide');
        location.reload();
      } else {
        alert(response.message || 'Gagal menyimpan data!');
      }
    }).fail(function() {
      alert('Gagal menghubungi server!');
    }).always(function() {
      $('#SimpanSubUnit').prop('disabled', false).text('SIMPAN');
    });
  });

  // =====================================================
  // HAPUS SUB UNIT (di modal)
  // =====================================================

  $('#HapusSubUnit').click(function() {
    var id = $('#sub_unit_id').val();
    if (!id) return;
    if (!confirm('Yakin ingin menghapus Sub Unit ini?')) return;
    
    $('#HapusSubUnit').prop('disabled', true).text('Menghapus...');
    
    $.post(BaseURL + 'Daerah/HapusSubUnit', {
      id: id,
      [CSRF_NAME]: CSRF_TOKEN
    }).done(function(res) {
      var response = typeof res === 'string' ? JSON.parse(res) : res;
      if (response.status === 'success') {
        $('#ModalSubUnit').modal('hide');
        location.reload();
      } else {
        alert(response.message || 'Gagal menghapus data!');
      }
    }).fail(function() {
      alert('Gagal menghubungi server!');
    }).always(function() {
      $('#HapusSubUnit').prop('disabled', false).text('HAPUS');
    });
  });

  // =====================================================
  // CRUD INSTANSI
  // =====================================================

  // SIMPAN INSTANSI
  $("#Input").click(function() {
    var kodeInstansi = $("#KodeInstansi").val().trim();
    var nama = $("#Username").val().trim();
    var password = $("#Password").val().trim();
    var tahunMulai = $("#TahunMulai").val().trim();
    var tahunAkhir = $("#TahunAkhir").val().trim();

    if (kodeInstansi == "") return alert('Kode Instansi harus diisi!');
    if (nama == "") return alert('Nama Instansi harus diisi!');
    if (password == "") return alert('Password harus diisi!');
    if (tahunMulai == "") return alert('Tahun Mulai harus diisi!');
    if (tahunAkhir == "") return alert('Tahun Akhir harus diisi!');

    var payload = {
      kode_instansi: kodeInstansi,
      nama: nama,
      password: password,
      tahun_mulai: tahunMulai,
      tahun_akhir: tahunAkhir,
      idkementerian: collectKementerian('kementerianContainerAdd'),
      [CSRF_NAME]: CSRF_TOKEN
    };

    $("#Input").prop('disabled', true).text('Menyimpan...');

    $.post(BaseURL+"Daerah/InputInstansi", payload).done(function(res){
      var response = typeof res === 'string' ? JSON.parse(res) : res;
      if (response.status === 'success' || res == '1') {
        // Reload dengan mempertahankan posisi
        window.location.reload();
      } else {
        alert(response.message || res || 'Gagal menyimpan data!');
      }
    }).fail(function() {
      alert('Gagal menghubungi server!');
    }).always(function() {
      $("#Input").prop('disabled', false).text('SIMPAN');
    });
  });

  // EDIT INSTANSI
  $(document).on("click", ".Edit", function(){
    var id = $(this).data('id');
    var kodeInstansi = $(this).data('kode-instansi') || '';
    var nama = $(this).data('nama');
    var tm = $(this).data('tahun-mulai');
    var ta = $(this).data('tahun-akhir');
    var idKem = $(this).data('idkementerian');

    $("#Id").val(id);
    $("#_KodeInstansi").val(kodeInstansi);
    $("#_Username").val(nama);
    $("#_Password").val("");
    $("#_TahunMulai").val(tm);
    $("#_TahunAkhir").val(ta);

    var selectedKem = [];
    if (idKem) {
      selectedKem = String(idKem).split(',').map(function(x){ return x.trim(); }).filter(Boolean);
    }
    initKementerianContainer('kementerianContainerEdit', 'idkementerian', selectedKem);

    $('#ModalEditInstansi').modal("show");
  });

  // SIMPAN EDIT INSTANSI
  $("#Edit").click(function() {
    var kodeInstansi = $("#_KodeInstansi").val().trim();
    var nama = $("#_Username").val().trim();
    var password = $("#_Password").val().trim();
    var tahunMulai = $("#_TahunMulai").val().trim();
    var tahunAkhir = $("#_TahunAkhir").val().trim();

    if (kodeInstansi == "") return alert('Kode Instansi harus diisi!');
    if (nama == "") return alert('Nama Instansi harus diisi!');
    if (tahunMulai == "") return alert('Tahun Mulai harus diisi!');
    if (tahunAkhir == "") return alert('Tahun Akhir harus diisi!');

    var payload = {
      id: $("#Id").val(),
      kode_instansi: kodeInstansi,
      nama: nama,
      password: password,
      tahun_mulai: tahunMulai,
      tahun_akhir: tahunAkhir,
      idkementerian: collectKementerian('kementerianContainerEdit'),
      [CSRF_NAME]: CSRF_TOKEN
    };

    $("#Edit").prop('disabled', true).text('Menyimpan...');

    $.post(BaseURL+"Daerah/EditInstansi", payload).done(function(res){
      var response = typeof res === 'string' ? JSON.parse(res) : res;
      if (response.status === 'success' || res == '1') {
        // Reload dengan mempertahankan posisi
        window.location.reload();
      } else {
        alert(response.message || res || 'Gagal update data!');
      }
    }).fail(function() {
      alert('Gagal menghubungi server!');
    }).always(function() {
      $("#Edit").prop('disabled', false).text('SIMPAN');
    });
  });

  // HAPUS INSTANSI
  $(document).on('click', '.Hapus', function () {
    if(!confirm("Yakin ingin menghapus data ini?")) return;
    
    var btn = $(this);
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
    
    $.post(BaseURL+"Daerah/HapusInstansi", { 
      id: $(this).data('id'), 
      [CSRF_NAME]: CSRF_TOKEN 
    }).done(function(res){
      var response = typeof res === 'string' ? JSON.parse(res) : res;
      if (response.status === 'success' || res == '1') {
        window.location.reload();
      } else {
        alert(response.message || res || 'Gagal menghapus data!');
        btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
      }
    }).fail(function() {
      alert('Gagal menghubungi server!');
      btn.prop('disabled', false).html('<i class="notika-icon notika-trash"></i>');
    });
  });

  // =====================================================
  // INIT DATATABLE DENGAN STATE SAVE
  // =====================================================
  $(document).ready(function() {
    // Inisialisasi DataTable dengan stateSave
    if ($('#data-table-basic').length > 0) {
      try {
        if ($.fn.DataTable.isDataTable('#data-table-basic')) {
          $('#data-table-basic').DataTable().destroy();
        }
        
        $('#data-table-basic').DataTable({
          "pageLength": 10,
          "ordering": true,
          "order": [[1, "asc"]], // Urutkan berdasarkan Kode Instansi (kolom ke-2) secara ascending
          "stateSave": true, // Menyimpan state (posisi, filter, sorting)
          "stateDuration": -1, // Menyimpan state selamanya di localStorage
          "scrollX": true,
          "scrollY": "400px",
          "scrollCollapse": true,
          "language": {
            "emptyTable": "Tidak ada data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada",
            "paginate": {
              "first": "Pertama",
              "last": "Terakhir",
              "next": "Berikutnya",
              "previous": "Sebelumnya"
            }
          },
          "drawCallback": function(settings) {
            // Setelah draw, pastikan tombol-tombol tetap berfungsi
            $('.btn-add-sub-unit, .BtnEditHeader, .BtnHapusHeader, .BtnEditSubUnit, .BtnHapusSubUnit, .Edit, .Hapus').css({
              'cursor': 'pointer',
              'pointer-events': 'auto'
            });
          }
        });
      } catch(e) {
        console.log("DataTable error:", e);
      }
    }
  });

  // =====================================================
  // FILTER WILAYAH
  // =====================================================

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

    $("#FilterWilayah").click(function() {
      if ($("#Provinsi").val() === "") return alert("Mohon Pilih Provinsi");
      if ($("#KabKota").val() === "") return alert("Mohon Pilih Kab/Kota");

      var kodeWilayah = $("#KabKota").val();

      $.ajax({
        url: BaseURL + "Daerah/SetTempKodeWilayah",
        type: "POST",
        data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
        beforeSend: function() { $("#FilterWilayah").prop('disabled', true).text('Memuat...'); },
        success: function(res) {
          if (res === '1') {
            window.location.reload();
          } else {
            alert(res || "Gagal menyimpan filter wilayah!");
            $("#FilterWilayah").prop('disabled', false).text('Filter');
          }
        },
        error: function() {
          alert("Gagal menghubungi server!");
          $("#FilterWilayah").prop('disabled', false).text('Filter');
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

</script>

</body>
</html>