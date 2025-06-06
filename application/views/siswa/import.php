<div class="container">
    <div class="page-inner">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Import Data Siswa</h4>
            </div>
            <div class="card-body">

                <p>
                    <a href="<?= base_url('template/template_import.xlsx') ?>" download>
                        Download template import data siswa
                    </a>
                </p>

                <?= form_open_multipart('siswa/import') ?>
                    <div class="mb-3">
                        <input type="file" name="file_excel" accept=".xls,.xlsx" required class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
