<div class="container">
    <br>
    <h1>Detail Product</h1>
    <a href="<?= BASEURL; ?>/Product" class="editButton">Kembali</a>
    <br>
    <div class="card">

        <h2><?= $data['prod']['product_name']; ?></h2>

        <p><?= $data['prod']['product_sell_price']; ?></p>
        <p><?= $data['prod']['unit']; ?></p>
        <p><?= $data['prod']['product_desc']; ?></p>
        <p><?= $data['prod']['product_updated']; ?></p>
        <p><?= $data['prod']['product_quantity']; ?></p>
    </div>
</div>