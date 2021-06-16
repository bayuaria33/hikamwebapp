<div class="container">
    <br>
    <h1>Detail Customer</h1>
    <a href="<?= BASEURL; ?>/Customer" class="editButton">Kembali</a>
    <br>
    <div class="card">

        <h2><?= $data['cust']['customer_name']; ?></h2>

        <p><?= $data['cust']['alamat1']; ?></p>
        <p><?= $data['cust']['alamat2']; ?></p>
        <p><?= $data['cust']['no_telp1']; ?></p>
        <p><?= $data['cust']['no_telp2']; ?></p>
        <p><?= $data['cust']['email']; ?></p>
    </div>
</div>