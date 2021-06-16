<div class="container">
    <br>
    <h1>Detail Supplier</h1>
    <a href="<?= BASEURL; ?>/Supplier" class="editButton">Kembali</a>
    <br>
    <div class="card">

        <h2><?= $data['sup']['supplier_name']; ?></h2>
        <p><?= $data['sup']['sales_name']; ?></p>
        <p><?= $data['sup']['norek1']; ?></p>
        <p><?= $data['sup']['norek2']; ?></p>
        <p><?= $data['sup']['alamat1']; ?></p>
        <p><?= $data['sup']['alamat2']; ?></p>
        <p><?= $data['sup']['no_telp1']; ?></p>
        <p><?= $data['sup']['no_telp2']; ?></p>
        <p><?= $data['sup']['email']; ?></p>
    </div>
</div>