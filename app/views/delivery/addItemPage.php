<div class="container">
    <h1>Tambah Delivery Item </h1>
    <a class="editButton" href="<?= BASEURL; ?>/Delivery/item/<?= $data['DO']['DO_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Delivery/tambahItem/<?= $data['DO']['DO_id']; ?>" method="post">

        <label class="hidden" for="DO_id">Id DO</label>
        <input class="hidden" type="hidden" id="DO_id" name="DO_id" autocomplete="off" value="<?= $data['DO']['DO_id']; ?>">

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="selectpicker form-control" data-live-search="true">

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