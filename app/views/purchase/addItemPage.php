<div class="container">
    <h1>Tambah Purchase Item </h1>
    <a class="editButton" href="<?= BASEURL; ?>/Purchase/item/<?= $data['PO']['PO_id']; ?>">Kembali</a>

    <form action="<?= BASEURL; ?>/Purchase/tambahItem/<?= $data['PO']['PO_id']; ?>" method="post">

        <label class="hidden" for="PO_id">Id Purchase</label>
        <input class="hidden" type="hidden" id="PO_id" name="PO_id" autocomplete="off" value="<?= $data['PO']['PO_id']; ?>">

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id">

            <?php foreach ($data['product'] as $prod) : ?>

                <option value="<?= $prod['product_id']; ?>"><?= $prod['product_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" autocomplete="off">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" autocomplete="off">


        <input type="submit" value="Submit">
    </form>

</div>