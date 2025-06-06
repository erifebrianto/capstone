<div class="container">
    <div class="page-inner">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Siswa</h4>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($siswa->nama_lengkap) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="<?= htmlspecialchars($siswa->tempat_lahir) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= htmlspecialchars($siswa->tanggal_lahir) ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" value="<?= htmlspecialchars($siswa->nis) ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control" value="<?= htmlspecialchars($siswa->nisn) ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>No. Ujian</label>
                        <input type="text" name="no_ujian" class="form-control" value="<?= htmlspecialchars($siswa->no_ujian) ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>Kelas</label>
                        <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($siswa->kelas) ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>Nama Orang Tua</label>
                        <input type="text" name="nama_ortu" class="form-control" value="<?= htmlspecialchars($siswa->nama_ortu) ?>">
                    </div>

                    <div class="form-group mb-4">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Lulus" <?= $siswa->status == 'Lulus' ? 'selected' : '' ?>>Lulus</option>
                            <option value="Tidak Lulus" <?= $siswa->status == 'Tidak Lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= site_url('siswa') ?>" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
