<div class="container">
    <h1>Tambah Invoice Item </h1>
    <a class="editButton" href="<?= BASEURL; ?>/Invoice/item/<?= $data['invc']['invoice_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Invoice/tambahItem/<?= $data['invc']['invoice_id']; ?>" method="post">
        <!-- <?php echo '<pre>', var_dump($data), '</pre>'; ?> -->
        <label class="hidden" for="invoice_id">Id Invoice</label>
        <input class="hidden" type="hidden" id="invoice_id" name="invoice_id" autocomplete="off" value="<?= $data['invc']['invoice_id']; ?>">

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