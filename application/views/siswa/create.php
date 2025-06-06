<div class="container">
    <div class="page-inner">
        <h3 class="mb-4">Form Tambah Siswa</h3>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('siswa/create') ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>NIS</label>
                                        <input type="text" name="nis" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>NISN</label>
                                        <input type="text" name="nisn" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>No Ujian</label>
                                        <input type="text" name="no_ujian" placeholder="Contoh : 2025-0309-002" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Kelas</label>
                                        <input type="text" name="kelas" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Nama Orang Tua</label>
                                        <input type="text" name="nama_ortu" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="lulus">Lulus</option>
                                            <option value="tidak lulus">Tidak Lulus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>