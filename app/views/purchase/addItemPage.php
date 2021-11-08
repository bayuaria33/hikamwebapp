<div class="container">
    <h1>Tambah Purchase Item </h1>
    <a class="editButton" href="<?= BASEURL; ?>/Purchase/item/<?= $data['PO']['PO_id']; ?>">Kembali</a>

    <form action="<?= BASEURL; ?>/Purchase/tambahItem/<?= $data['PO']['PO_id']; ?>" method="post">

        <label class="hidden" for="PO_id">Id Purchase</label>
        <input class="hidden" type="hidden" id="PO_id" name="PO_id" autocomplete="off" value="<?= $data['PO']['PO_id']; ?>">

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="selectpicker form-control" data-live-search="true">

            <?php foreach ($data['product'] as $prod) : ?>

                <option value="<?= $prod['product_id']; ?>"><?= $prod['product_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" autocomplete="off">

        <label for="unit_item">jenis Unit Product</label>
        <select name="unit_item" id="unit_item" autocomplete="off" class="selectpicker form-control" data-live-search="true">
            <option value="liter">Liter</option>
            <option value="Kg">Kg</option>
            <option value="Ton">Ton</option>
            <option value="Kubik">Kubik</option>
            <option value="Pouch">Pouch</option>
            <option value="Pail">Pail</option>
            <option value="Case">Case</option>
            <option value="Botol">Botol</option>
            <option value="Drum">Drum</option>
        </select>

        <label for="price">Price</label>
        <input type="text" id="price" name="price" autocomplete="off">


        <input type="submit" value="Submit">
    </form>

</div>