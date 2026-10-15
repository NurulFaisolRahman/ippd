import re

def process_file():
    with open('application/views/Daerah/IsuStrategisDaerah.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Replace the table rendering
    old_tbody_match = re.search(r'<tbody>(.*?)</tbody>', content, re.DOTALL)
    
    new_tbody = """<tbody>
                                    <?php if (!empty($IsuStrategis)) { 
                                        $no = 1;
                                        foreach ($IsuStrategis as $row) {
                                            $permList = $row['PermasalahanList'] ?? [];
                                            $permCount = count($permList);
                                            if ($permCount == 0) $permCount = 1;
                                    ?>
                                        <tr>
                                            <td rowspan="<?= $permCount ?>" class="text-center" style="font-weight: 600;"><?= $no++ ?></td>
                                            
                                            <!-- Permasalahan Baris Pertama -->
                                            <td class="td-permasalahan">
                                                <div class="permasalahan-item" style="justify-content: space-between; border-left: none; border-right: none; <?php if($permCount == 1) echo 'border-bottom: none;'; ?>">
                                                    <?php if (!empty($permList)) { ?>
                                                        <div><?= htmlspecialchars($permList[0]['Permasalahan']) ?></div>
                                                        <?php if ($canManage) { ?>
                                                        <div class="btn-action-group" style="flex-shrink: 0; margin-left: 10px;">
                                                            <button type="button" class="btn btn-xs btn-default EditPermasalahan" data-id="<?= $permList[0]['Id'] ?>" data-idisustrategis="<?= $row['Id'] ?>" title="Edit"><i class="fa fa-pencil text-success"></i></button>
                                                            <button type="button" class="btn btn-xs btn-default HapusPermasalahan" data-id="<?= $permList[0]['Id'] ?>" title="Hapus"><i class="fa fa-trash text-danger"></i></button>
                                                        </div>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <div class="text-muted text-center" style="width:100%;">- Belum ada permasalahan -</div>
                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td rowspan="<?= $permCount ?>"><?= formatLinearitasCell($row['isu_klhs']) ?></td>
                                            <td rowspan="<?= $permCount ?>"><?= formatLinearitasCell($row['isu_global'] ?? '') ?></td>
                                            <td rowspan="<?= $permCount ?>"><?= formatLinearitasCell($row['isu_nasional'] ?? '') ?></td>
                                            <td rowspan="<?= $permCount ?>"><?= formatLinearitasCell($row['isu_regional'] ?? '') ?></td>
                                            <td rowspan="<?= $permCount ?>" style="font-weight: 600; color: #1f2937;">
                                                <?= formatLinearitasCell($row['NamaIsuStrategis']) ?>
                                                <?php if (!empty($row['TahunMulai']) && !empty($row['TahunAkhir'])) { ?>
                                                    <div style="margin-top: 6px;">
                                                        <span class="badge" style="background-color: #ecfdf5; color: #065f46; font-size: 11px; border: 1px solid #a7f3d0; font-weight: 600;">
                                                            <?= html_escape($row['TahunMulai']) ?> - <?= html_escape($row['TahunAkhir']) ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($canManage) { ?>
                                                    <div style="margin-top: 10px;">
                                                        <button type="button" class="btn btn-xs TambahPermasalahan" data-id="<?= $row['Id'] ?>" style="background: #e2e8f0; color: #334155; border: 1px solid #cbd5e1; font-weight: 600; width: 100%;">
                                                            <i class="fa fa-plus"></i> Permasalahan
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            
                                            <?php if ($canManage) { ?>
                                            <td rowspan="<?= $permCount ?>" class="text-center" style="vertical-align: middle !important;">
                                                <div class="btn-action-group">
                                                    <button type="button" class="btn btn-sm EditIsuStrategis" 
                                                            data-id="<?= $row['Id'] ?>" 
                                                            title="Edit Isu Strategis" 
                                                            style="background: #00c292; border-color: #00a87e; color: #fff; margin-bottom: 5px; width: 100%;">
                                                        <i class="fa fa-pencil"></i> Edit Isu
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm HapusIsuStrategis" 
                                                            data-id="<?= $row['Id'] ?>" 
                                                            title="Hapus Isu Strategis" 
                                                            style="background: #ef4444; border-color: #dc2626; color: #fff; width: 100%;">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>

                                        <?php 
                                            // Render remaining Permasalahan rows
                                            for ($i = 1; $i < $permCount; $i++) { 
                                        ?>
                                        <tr>
                                            <td class="td-permasalahan">
                                                <div class="permasalahan-item" style="justify-content: space-between; border-left: none; border-right: none; <?php if($i == $permCount-1) echo 'border-bottom: none;'; ?>">
                                                    <div><?= htmlspecialchars($permList[$i]['Permasalahan']) ?></div>
                                                    <?php if ($canManage) { ?>
                                                    <div class="btn-action-group" style="flex-shrink: 0; margin-left: 10px;">
                                                        <button type="button" class="btn btn-xs btn-default EditPermasalahan" data-id="<?= $permList[$i]['Id'] ?>" data-idisustrategis="<?= $row['Id'] ?>" title="Edit"><i class="fa fa-pencil text-success"></i></button>
                                                        <button type="button" class="btn btn-xs btn-default HapusPermasalahan" data-id="<?= $permList[$i]['Id'] ?>" title="Hapus"><i class="fa fa-trash text-danger"></i></button>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    <?php 
                                        } 
                                    } else { ?>
                                        <tr>
                                            <td colspan="<?= $canManage ? '8' : '7' ?>" class="text-center text-muted" style="padding: 30px !important;">
                                                <i class="fa fa-folder-open-o fa-2x" style="display: block; margin-bottom: 8px; color: #9ca3af;"></i>
                                                Belum ada data Isu Strategis Daerah untuk wilayah ini.
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>"""
    content = content.replace(old_tbody_match.group(0), new_tbody)

    # 2. Modify Modal Isu Strategis: Remove Permasalahan field
    content = re.sub(r'<!-- 2\. Permasalahan Pokok -->.*?<!-- 3\. Isu KLHS -->', '<!-- 3. Isu KLHS -->', content, flags=re.DOTALL)

    # 3. Add Modal Permasalahan (Tambah & Edit)
    new_modals = """
<!-- MODAL TAMBAH PERMASALAHAN -->
<div class="modal fade" id="ModalTambahPermasalahan" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; text-align: left; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: #fff; padding: 16px 24px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="color: #fff; font-weight: 700; font-size: 16px;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Permasalahan
                </h4>
            </div>
            <form id="FormTambahPermasalahan">
                <input type="hidden" name="IdIsuStrategis" id="TambahIdIsuStrategisPermasalahan">
                <div class="modal-body">
                    <div class="form-field-card">
                        <label for="TambahTextPermasalahan">
                            <span>Permasalahan Pokok <span class="text-danger">*</span></span>
                        </label>
                        <textarea class="form-control" name="Permasalahan" id="TambahTextPermasalahan" placeholder="Contoh: Infrastruktur kesehatan belum merata" required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 6px; font-weight: 600; background-color: #3b82f6; border-color: #2563eb;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT PERMASALAHAN -->
<div class="modal fade" id="ModalEditPermasalahan" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; text-align: left; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; padding: 16px 24px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="color: #fff; font-weight: 700; font-size: 16px;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Permasalahan
                </h4>
            </div>
            <form id="FormEditPermasalahan">
                <input type="hidden" name="Id" id="EditIdPermasalahan">
                <input type="hidden" name="IdIsuStrategis" id="EditIdIsuStrategisPermasalahan">
                <div class="modal-body">
                    <div class="form-field-card">
                        <label for="EditTextPermasalahan">
                            <span>Permasalahan Pokok <span class="text-danger">*</span></span>
                        </label>
                        <textarea class="form-control" name="Permasalahan" id="EditTextPermasalahan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                    <button type="submit" class="btn btn-success" style="border-radius: 6px; font-weight: 600;">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
"""
    # Append modals right before JS
    content = content.replace("<!-- JS & Script AJAX -->", new_modals + "\n<!-- JS & Script AJAX -->")

    # 4. Add JS handlers for Permasalahan
    new_js = """
        // ================= PERMASALAHAN =================

        // Buka Modal Tambah Permasalahan
        $('.TambahPermasalahan').on('click', function() {
            $('#TambahIdIsuStrategisPermasalahan').val($(this).data('id'));
            $('#TambahTextPermasalahan').val('');
            $('#ModalTambahPermasalahan').modal('show');
        });

        // Submit Tambah Permasalahan
        $('#FormTambahPermasalahan').on('submit', function(e) {
            e.preventDefault();
            $.post(BaseURL + "Daerah/InputPermasalahan", $(this).serialize(), function(response) {
                if(response.trim() == "1") {
                    window.location.reload();
                } else {
                    alert(response);
                }
            });
        });

        // Buka Modal Edit Permasalahan
        $('.EditPermasalahan').on('click', function() {
            var id = $(this).data('id');
            var idIsuStrategis = $(this).data('idisustrategis');
            
            $.post(BaseURL + "Daerah/GetPermasalahanById", {Id: id}, function(data) {
                var res = JSON.parse(data);
                $('#EditIdPermasalahan').val(res.Id);
                $('#EditIdIsuStrategisPermasalahan').val(res.IdIsuStrategis);
                $('#EditTextPermasalahan').val(res.Permasalahan);
                $('#ModalEditPermasalahan').modal('show');
            });
        });

        // Submit Edit Permasalahan
        $('#FormEditPermasalahan').on('submit', function(e) {
            e.preventDefault();
            $.post(BaseURL + "Daerah/UpdatePermasalahan", $(this).serialize(), function(response) {
                if(response.trim() == "1") {
                    window.location.reload();
                } else {
                    alert(response);
                }
            });
        });

        // Hapus Permasalahan
        $('.HapusPermasalahan').on('click', function() {
            if(confirm('Apakah Anda yakin ingin menghapus permasalahan ini?')) {
                var id = $(this).data('id');
                $.post(BaseURL + "Daerah/DeletePermasalahan", {Id: id}, function(response) {
                    if(response.trim() == "1") {
                        window.location.reload();
                    } else {
                        alert(response);
                    }
                });
            }
        });
"""
    content = content.replace("$(document).ready(function() {", "$(document).ready(function() {\n" + new_js)

    with open('application/views/Daerah/IsuStrategisDaerah.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
