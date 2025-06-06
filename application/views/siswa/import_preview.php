<div class="container">
    <div class="page-inner">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Preview Data Siswa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>No Ujian</th>
                                <th>Kelas</th>
                                <th>Nama Orang Tua</th>                
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($preview as $row): ?>
                            <tr>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['tempat_lahir'] ?></td>
                                <td><?= $row['tanggal_lahir'] ?></td>
                                <td><?= $row['nis'] ?></td>
                                <td><?= $row['nisn'] ?></td>
                                <td><?= $row['no_ujian'] ?></td>
                                <td><?= $row['kelas'] ?></td>
                                <td><?= $row['nama_ortu'] ?></td>
                                <td><?= $row['status'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <form action="<?= site_url('siswa/do_import') ?>" method="post" class="mt-3">
                    <button type="submit" class="btn btn-success">Import Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
