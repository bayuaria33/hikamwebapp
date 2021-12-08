<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL; ?>/Purchase/cek_file/<?= $data['PO']['PO_id']; ?>"><i class="fa fa-home"></i>Kembali</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Upload File <?= $data['PO']['purchase_number']; ?>
                </div>
                <form method="POST" action="<?= BASEURL; ?>/Purchase/upload/<?= $data['PO']['PO_id']; ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="file_upload">Pilih file: </label>
                                    <input type="file" style="display:block" class="form-control-file" name="file_upload" accept="application/pdf,application/vnd.ms-excel">
                                    <label for="file_upload">Tipe: .PDF </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="form-group mb-0">
                            <button type="submit" name="file_upload" class="btn btn-primary"><i class="fas fa-upload mr-1"></i>Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>