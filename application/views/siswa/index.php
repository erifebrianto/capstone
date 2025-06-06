<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Data Siswa</h3>
        <h6 class="op-7 mb-2">Daftar lengkap siswa dan status kelulusannya</h6>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <a href="<?php echo base_url();?>siswa/create" class="btn btn-primary btn-round me-2">Tambah Siswa</a>
        <a href="<?php echo base_url();?>siswa/import" class="btn btn-success btn-round">Import</a>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="siswaTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NO Ujian</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Dibuat Pada</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($siswa)): ?>
                <?php $no = 1; foreach ($siswa as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->no_ujian ?></td>
                    <td><?= $row->nis ?></td>
                    <td><?= $row->kelas ?></td>
                    <td>
                      <span class="badge bg-<?= $row->status == 'Lulus' ? 'success' : 'danger' ?>">
                        <?= ucfirst($row->status) ?>
                      </span>
                    </td>
                    <td><?= date('d-m-Y H:i', strtotime($row->created_at)) ?></td>
                    <td>
                      <button class="btn btn-sm btn-info" onclick="showDetail(<?= $row->id ?>)">Detail</button>
                      <button class="btn btn-sm btn-warning" onclick="showEdit(<?= $row->id ?>)">Edit</button>
                      <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $row->id ?>)">Delete</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="text-center">Tidak ada data siswa</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail Siswa (tanpa nilai) -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-md-4 fw-bold">Nama Lengkap</div>
          <div class="col-md-8" id="detail_nama">-</div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4 fw-bold">Kelas</div>
          <div class="col-md-8" id="detail_kelas">-</div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4 fw-bold">Status</div>
          <div class="col-md-8" id="detail_status">-</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- DataTables & Bootstrap Scripts -->
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#siswaTable').DataTable({
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Cari siswa..."
      }
    });
  });

  function showDetail(id) {
    fetch('<?= base_url("siswa/detail/") ?>' + id)
      .then(response => response.json())
      .then(data => {
        document.getElementById('detail_nama').innerText = data.siswa.nama_lengkap;
        document.getElementById('detail_kelas').innerText = data.siswa.kelas;
        document.getElementById('detail_status').innerText = data.siswa.status;

        const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
        modal.show();
      })
      .catch(error => {
        console.error('Gagal memuat data detail:', error);
        alert('Terjadi kesalahan saat mengambil data.');
      });
  }

  function showEdit(id) {
    // Redirect ke halaman edit siswa
    window.location.href = '<?= base_url("siswa/edit/") ?>' + id;
  }

  function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data siswa ini?')) {
      // Redirect ke controller delete (buat controller siswa dengan method delete)
      window.location.href = '<?= base_url("siswa/delete/") ?>' + id;
    }
  }
</script>
