<div class="container">
    <h1>Edit data Item Invoice <?= $data['invc_item']['invc_item_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Invoice/Item/ <?= $data['invc_item']['invoice_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Invoice/editItem/<?= $data['invc_item']['invoice_id']; ?>" method="post">
        <label class="hidden" for="invoice_id">Id Invoice</label>
        <input class="hidden" type="hidden" id="invoice_id" name="invoice_id" autocomplete="off" value="<?= $data['invc_item']['invoice_id']; ?>">
        <label class="hidden" for="invc_item_id">Id invc Item</label>
        <input class="hidden" type="hidden" id="invc_item_id" name="invc_item_id" autocomplete="off" value="<?= $data['invc_item']['invc_item_id']; ?>">

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="selectpicker form-control" data-live-search="true">

            <?php foreach ($data['product'] as $prod) : ?>

                <option value="<?= $prod['product_id']; ?>"><?= $prod['product_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" autocomplete="off" value="<?= $data['invc_item']['quantity']; ?>">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" autocomplete="off" value="<?= $data['invc_item']['price']; ?>">

        <input type="submit" value="Submit">
    </form>

</div>