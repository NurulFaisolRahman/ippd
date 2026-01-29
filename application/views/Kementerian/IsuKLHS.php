<?php $this->load->view('Kementerian/Sidebar'); ?>

<div class="main-content">

<!-- ===================== BREADCRUMB ===================== -->
<div class="breadcomb-area">
    <div class="container">
        <ul class="breadcomb-menu" style="list-style:none;padding:0;margin:0">
            <li style="display:inline-block">
                <a href="<?= base_url('Beranda') ?>">Beranda</a>
                <span class="bread-slash"> / </span>
            </li>
            <li style="display:inline-block">
                <a href="<?= base_url('Kementerian/IsuKLHS') ?>">Isu</a>
                <span class="bread-slash"> / </span>
            </li>
            <li style="display:inline-block">
                <span class="bread-blk">Isu KLHS</span>
            </li>
        </ul>
    </div>
</div>

<!-- ===================== CONTENT ===================== -->
<div class="data-table-area">
<div class="container">
<div class="row">
<div class="col-lg-12">

<div class="data-table-list">

<!-- ===================== INFO SESSION ===================== -->
<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
<div class="alert alert-info" style="margin-bottom:15px;">
    <i class="notika-icon notika-info"></i>
    <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName) ?><br>
    <b>Periode :</b> <?= htmlspecialchars($UserPeriode) ?>
</div>
<?php endif; ?>

<!-- ===================== HEADER BUTTON ===================== -->
<div class="basic-tb-hd">
    <div class="button-icon-btn sm-res-mg-t-30">

        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0): ?>
        <button class="btn btn-primary notika-btn-primary" id="FilterIsuKLHS">
            <i class="notika-icon notika-search"></i>
            <b>Filter Data</b>
            <?php if ($CurrentPeriode || $CurrentKementerian): ?>
                <span class="badge" style="background:#f44336;margin-left:5px;">Aktif</span>
            <?php endif; ?>
        </button>
        <?php endif; ?>

        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
        <button class="btn btn-success notika-btn-success" id="BtnInputIsuKLHS">
            <i class="notika-icon notika-edit"></i>
            <b>Input Isu KLHS</b>
        </button>
        <?php endif; ?>

    </div>
</div>

<!-- ===================== TABLE ===================== -->
<div class="table-responsive">
<table id="data-table-basic" class="table table-striped">
<thead>
<tr>
    <th width="5%" class="text-center">No</th>

    <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
        <th width="25%">Kementerian</th>
    <?php endif; ?>

    <th>Isu KLHS</th>
    <th width="18%">Periode</th>

    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
        <th width="12%" class="text-center">Aksi</th>
    <?php endif; ?>
</tr>
</thead>

<tbody>
<?php if (!empty($IsuKLHS)): ?>
<?php $no=1; foreach($IsuKLHS as $row): ?>
<tr>
    <td class="text-center"><?= $no++ ?></td>

    <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
        <td><?= htmlspecialchars($row['NamaKementerian']) ?></td>
    <?php endif; ?>

    <td><?= htmlspecialchars($row['NamaIsuKLHS']) ?></td>
    <td><?= $row['TahunMulai'].' - '.$row['TahunAkhir'] ?></td>

    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
    <td class="text-center">
        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
            <?php if ($row['IdKementerian'] == $_SESSION['IdKementerian']): ?>
                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                        data-id="<?= $row['Id'] ?>"
                        title="Edit">
                    <i class="notika-icon notika-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus"
                        data-id="<?= $row['Id'] ?>"
                        title="Hapus">
                    <i class="notika-icon notika-trash"></i>
                </button>
            <?php else: ?>
                <button class="btn btn-sm btn-default amber-icon-notika btn-reco-mg btn-button-mg"
                        disabled
                        title="Data milik kementerian lain">
                    <i class="notika-icon notika-lock"></i>
                </button>
            <?php endif; ?>
        </div>
    </td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="<?= isset($_SESSION['Level']) && $_SESSION['Level']==1 ? 5 : 4 ?>" class="text-center">
        <div class="alert alert-warning">
            <i class="notika-icon notika-info"></i>
            Belum ada data Isu KLHS
        </div>
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

<!-- ===================== MODAL INPUT ===================== -->
<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
<div class="modal fade" id="ModalInputIsuKLHS">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Input Isu KLHS</h4>
</div>
<div class="modal-body">

<div class="alert alert-info">
    <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName) ?><br>
    <b>Periode :</b> <?= htmlspecialchars($UserPeriode) ?>
</div>

<div class="form-example-wrap">
    <div class="form-example-int form-horizental">
        <div class="form-group">
            <label><b>Nama Isu KLHS</b></label>
            <textarea class="form-control" id="NamaIsuKLHS" rows="4"
                placeholder="Tuliskan isu strategis KLHS..."></textarea>
        </div>
    </div>

    <button class="btn btn-success notika-btn-success" id="InputIsuKLHS">
        <i class="notika-icon notika-checked"></i> SIMPAN
    </button>
    <button class="btn btn-default" data-dismiss="modal">BATAL</button>
</div>

</div>
</div>
</div>
</div>
<?php endif; ?>

<!-- ===================== MODAL EDIT ===================== -->
<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
<div class="modal fade" id="ModalEditIsuKLHS">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Edit Isu KLHS</h4>
</div>
<div class="modal-body">

<input type="hidden" id="EditId">

<div class="form-example-wrap">
    <div class="form-example-int">
        <label><b>Nama Isu KLHS</b></label>
        <textarea class="form-control" id="EditNamaIsuKLHS" rows="4"></textarea>
    </div>

    <button class="btn btn-success notika-btn-success" id="UpdateIsuKLHS">
        <i class="notika-icon notika-checked"></i> UPDATE
    </button>
    <button class="btn btn-default" data-dismiss="modal">BATAL</button>
</div>

</div>
</div>
</div>
</div>
<?php endif; ?>


<!-- Scripts -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/data-table-act.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>
<script>
$(document).ready(function () {

    /* =====================================================
     * GLOBAL
     * ===================================================== */
    const BaseURL = "<?= site_url() ?>";
    const UserLevel = <?= isset($_SESSION['Level']) ? (int)$_SESSION['Level'] : -1 ?>;

    /* =====================================================
     * DATATABLE (AMAN, TIDAK DOUBLE INIT)
     * ===================================================== */
    if (!$.fn.DataTable.isDataTable('#data-table-basic')) {
        $('#data-table-basic').DataTable({
            pageLength: 10,
            order: [],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: [
                {
                    targets: UserLevel == 1 ? [0, 4] : [0],
                    orderable: false
                }
            ]
        });
    }

    /* =====================================================
     * FILTER (ADMIN)
     * ===================================================== */
    $('#FilterIsuKLHS').on('click', function () {
        $('#ModalFilter').modal('show');
    });

    $('#FilterPeriode').on('change', function () {
        const periode = $(this).val();
        const select = $('#FilterKementerianSelect');

        if (!periode) {
            select.html('<option value="">Semua Kementerian</option>');
            return;
        }

        const [tm, ta] = periode.split('|');

        $.post(BaseURL + 'Kementerian/GetKementerianByPeriode', {
            TahunMulai: tm,
            TahunAkhir: ta
        }, function (res) {
            const data = JSON.parse(res);
            select.html('<option value="">Semua Kementerian</option>');
            data.forEach(k => {
                select.append(`<option value="${k.Id}">${k.NamaKementerian}</option>`);
            });
        });
    });

    $('#ApplyFilter').on('click', function () {
        let url = BaseURL + 'Kementerian/IsuKLHS?';
        const periode = $('#FilterPeriode').val();
        const kementerian = $('#FilterKementerianSelect').val();

        if (periode) url += 'periode=' + encodeURIComponent(periode) + '&';
        if (kementerian) url += 'kementerian=' + encodeURIComponent(kementerian);

        window.location.href = url.replace(/&$/, '');
    });

    $('#ResetFilter').on('click', function () {
        window.location.href = BaseURL + 'Kementerian/IsuKLHS';
    });

    /* =====================================================
     * INPUT ISU KLHS (LEVEL 1 - SESSION)
     * ===================================================== */
    $('#BtnInputIsuKLHS').on('click', function () {
        $('#NamaIsuKLHS').val('');
        $('#ModalInputIsuKLHS').modal('show');
    });

    $('#InputIsuKLHS').on('click', function () {
        const nama = $('#NamaIsuKLHS').val().trim();

        if (!nama) {
            alert('Nama Isu KLHS wajib diisi');
            return;
        }

        $.post(BaseURL + 'Kementerian/InputIsuKLHS', {
            NamaIsuKLHS: nama
        }, function (res) {
            const r = JSON.parse(res);
            alert(r.message);
            if (r.success) location.reload();
        }).fail(function () {
            alert('Gagal menghubungi server');
        });
    });

    /* =====================================================
     * EDIT ISU KLHS
     * ===================================================== */
    $(document).on('click', '.Edit', function () {
        const id = $(this).data('id');

        $.post(BaseURL + 'Kementerian/GetIsuKLHSById', {
            id: id
        }, function (res) {
            const r = JSON.parse(res);
            if (!r.success) {
                alert(r.message);
                return;
            }
            $('#EditId').val(r.data.Id);
            $('#EditNamaIsuKLHS').val(r.data.NamaIsuKLHS);
            $('#ModalEditIsuKLHS').modal('show');
        });
    });

    $('#UpdateIsuKLHS').on('click', function () {
        const id = $('#EditId').val();
        const nama = $('#EditNamaIsuKLHS').val().trim();

        if (!nama) {
            alert('Nama Isu KLHS wajib diisi');
            return;
        }

        $.post(BaseURL + 'Kementerian/UpdateIsuKLHS', {
            Id: id,
            NamaIsuKLHS: nama
        }, function (res) {
            const r = JSON.parse(res);
            alert(r.message);
            if (r.success) location.reload();
        }).fail(function () {
            alert('Gagal update data');
        });
    });

    /* =====================================================
     * DELETE ISU KLHS
     * ===================================================== */
    $(document).on('click', '.Hapus', function () {
        const id = $(this).data('id');

        if (!confirm('Yakin ingin menghapus data ini?')) return;

        $.post(BaseURL + 'Kementerian/DeleteIsuKLHS', {
            Id: id
        }, function (res) {
            const r = JSON.parse(res);
            alert(r.message);
            if (r.success) location.reload();
        }).fail(function () {
            alert('Gagal menghapus data');
        });
    });

});
</script>
