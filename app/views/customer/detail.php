<div class="container">

    <h3><?= $data['cust']['customer_name']; ?></h3>
    <p><?= $data['cust']['alamat1']; ?></p>
    <p><?= $data['cust']['alamat2']; ?></p>
    <p><?= $data['cust']['no_telp1']; ?></p>
    <p><?= $data['cust']['no_telp2']; ?></p>
    <p><?= $data['cust']['email']; ?></p>
    <a href="<?= BASEURL; ?>/Customer" class="editButton">Kembali</a>
</div>