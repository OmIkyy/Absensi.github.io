<style media="screen">
    table,
    th,
    tr {
        text-align: center;
    }

    .dataTables_wrapper .dt-buttons {
        float: none;
        text-align: center;
    }

    .swal2-popup {
        font-family: inherit;
        font-size: 1.2rem;
    }

    div.dataTables_wrapper div.dataTables_length label {
        padding-top: 5px;
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
    }
</style>

<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>DATA PENGGAJIAN</h3>
                </div>
                <div class="box-body"></div>
                <!-- /.box-header -->
                <div class='box-body'>
                    <div class="actionPart">
                        <div class="actionSelect">
                            <div class="col-md-3">
                                <select id="exportLink" class="form-control">
                                    <option>Pilih Metode Ekspor</option>
                                    <option value="csv">Ekspor sebagai CSV</option>
                                    <option value="print">Cetak Data</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="penggajian" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="all">No</th>
                                <th class="all">NIP</th>
                                <th class="all">Nama Pengajar</th>
                                <th class="desktop">Kehadiran</th>
                                <th class="desktop">Transport</th>
                                <th class="desktop">Gaji Pokok</th>
                                <th class="desktop">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($this->rekap->pengajar() as $row) {
                                $no++;
                                $hadir = $this->rekap->totalHadir_bak_3($row->nomor_induk);
                                $tunjangan = 12500;
                                $gapok = 200000;
                                $total = $tunjangan + $gapok;
                                $tot_gaji = $hadir * $total;
                                echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $row->nomor_induk . "</td>
                                <td>" . $row->nama_user . "</td>
                                <td>" . $hadir . "</td>
                                <td>" . $tunjangan . "</td>
                                <td>" . $gapok . "</td>
                                <td>" . $tot_gaji . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
    let base_url = '<?= base_url() ?>';
</script>

<script type="text/javascript">
    let checkLogin = '<?= $result ?>';
</script>

<script>
    $(document).ready(function() {
        if (checkLogin == 0) {
            $('.btn-create-data').hide();
        }

        // Event listener untuk menu dropdown ekspor
        $('#exportLink').change(function() {
            let selectedOption = $(this).val();
            if (selectedOption === "csv") {
                window.location.href = base_url + 'penggajian/export_csv';
            } else if (selectedOption === "pdf") {
                window.location.href = base_url + 'penggajian/export_pdf';
            } else if (selectedOption === "print") {
                printTable();
            }
        });

        // Fungsi cetak tabel
        function printTable() {
            let printContents = document.getElementById('penggajian').outerHTML;
            let originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // Reload halaman setelah cetak
        }
    });
</script>
