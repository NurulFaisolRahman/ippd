<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No</th>
                                        <th style="width: 15%;">Kode</th>
                                        <th style="width: 20%;">Nomenklatur</th>
                                        <th style="width: 20%;">Kinerja</th>
                                        <th style="width: 15%;">Indikator</th>
                                        <th style="width: 10%;">Satuan</th>
                                        <th style="width: 10%;">Kewenangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Nomenklatur as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['Kode']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Nomenklatur']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Kinerja']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Indikator']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Satuan']?></td>
                                        <td style="vertical-align: middle;"><?=$key['Kewenangan']?></td>
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
</body>

</html>