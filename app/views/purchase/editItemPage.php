<div class="container">
    <h1>Edit data Item Purchase <?= $data['pc_item']['pc_item_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Purchase/Item/ <?= $data['PO']['PO_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Purchase/editItem/<?= $data['PO']['PO_id']; ?>" method="post">
        <label class="hidden" for="PO_id">Id Purchase</label>
        <input class="hidden" type="hidden" id="PO_id" name="PO_id" autocomplete="off" value="<?= $data['pc_item']['PO_id']; ?>">

        <label class="hidden" for="pc_item_id">Id PO Item</label>
        <input class="hidden" type="hidden" id="pc_item_id" name="pc_item_id" autocomplete="off" value="<?= $data['pc_item']['pc_item_id']; ?>">

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="selectpicker form-control" data-live-search="true">

            <?php foreach ($data['product'] as $prod) : ?>

                <option value="<?= $prod['product_id']; ?>"><?= $prod['product_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" autocomplete="off" value="<?= $data['pc_item']['quantity']; ?>">

        <label for="unit_item">jenis Unit Product</label>
        <select name="unit_item" id="unit_item" autocomplete="off" class="selectpicker form-control" data-live-search="true" value="<?= $data['invc_item']['unit_item']; ?>">
            <option value="liter">Liter</option>
            <option value="Kg">Kg</option>
            <option value="Ton">Ton</option>
            <option value="Kubik">Kubik</option>
            <option value="Pouch">Pouch</option>
            <option value="CS">CS</option>
            <option value="Case">Case</option>
            <option value="Botol">Botol</option>
        </select>

        <label for="price">Price</label>
        <input type="text" id="price" name="price" autocomplete="off" value="<?= $data['pc_item']['price']; ?>">

        <input type="submit" value="Submit">
    </form>

</div>