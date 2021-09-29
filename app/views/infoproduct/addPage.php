<div class="container">
    <h1>Tambah info Supplier <?= $data['inprod'][0]['product_name']; ?></h1>
    <a href="<?= BASEURL; ?>/InfoProduct/detailSupp/<?= $data['inprod'][0]['product_id']; ?>" class="editButton">Kembali</a> <br>

    <form action="<?= BASEURL; ?>/InfoProduct/tambah/<?= $data['inprod'][0]['product_id']; ?>" method="post">

        <label class="hidden" for="product_id">Id Product</label>
        <input class="hidden" type="hidden" id="product_id" name="product_id" autocomplete="off" value="<?= $data['inprod'][0]['product_id']; ?>">

        <label for="product_avb">Ketersedian Barang</label>
        <select name="product_avb" id="product_avb" autocomplete="off">
            <option value="Ready">Ready</option>
            <option value="Habis">Habis</option>
            <option value="inden">Inden</option>
        </select>

        <label for="supplier_name">pilih Supplier</label>
        <select name="supplier_name" id="supplier_name">

            <?php foreach ($data['suppliers'] as $sup) : ?>

                <option value="<?= $sup['supplier_name']; ?>"><?= $sup['supplier_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="product_desc">Deskripsi</label>
        <input type="text" id="product_desc" name="product_desc" autocomplete="off">

        <label for="unit">Unit</label>
        <select name="unit" id="unit" autocomplete="off" value="<?= $data['inprod']['unit']; ?>">
            <option value="liter">Liter</option>
            <option value="Kg">Kg</option>
            <option value="Ton">Ton</option>
            <option value="Kubik">Kubik</option>
        </select>

        <label for="product_price">Harga Product</label>
        <input type="number" id="product_price" name="product_price" autocomplete="off">


        <input type="submit" value="Submit">
    </form>

</div>