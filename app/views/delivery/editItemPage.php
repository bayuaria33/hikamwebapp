<div class="container">
    <h1>Edit data Item Delivery <?= $data['do_item']['do_item_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Delivery/Item/ <?= $data['do_item']['do_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Delivery/editItem/<?= $data['do_item']['do_id']; ?>" method="post">
        <label class="hidden" for="do_id">Id Invoice</label>
        <input class="hidden" type="hidden" id="do_id" name="do_id" autocomplete="off" value="<?= $data['do_item']['do_id']; ?>">
        <label class="hidden" for="do_item_id">Id do Item</label>
        <input class="hidden" type="hidden" id="do_item_id" name="do_item_id" autocomplete="off" value="<?= $data['do_item']['do_item_id']; ?>">

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="selectpicker form-control" data-live-search="true">

            <?php foreach ($data['product'] as $prod) : ?>

                <option value="<?= $prod['product_id']; ?>"><?= $prod['product_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" autocomplete="off" value="<?= $data['do_item']['quantity']; ?>">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" autocomplete="off" value="<?= $data['do_item']['price']; ?>">

        <input type="submit" value="Submit">
    </form>

</div>