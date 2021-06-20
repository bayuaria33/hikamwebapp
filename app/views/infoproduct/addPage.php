<div class="container">
    <h1>Tambah Data Supplier <?= $data['inprod'][0]['product_name']; ?></h1>
    <!-- <?php echo '<pre>', var_dump($data), '</pre>'; ?> -->
    <a href="<?= BASEURL; ?>/InfoProduct/detailSupp/<?= $data['inprod'][0]['product_id']; ?>" class="editButton">Kembali</a> <br>


    <form action="<?= BASEURL; ?>/InfoProduct/tambah" method="post">
        <label class="hidden" for="product_id">id Product</label>
        <input class="hidden" type="hidden" id="product_id" name="product_id" autocomplete="off" value="<?= $data['inprod'][0]['product_id']; ?>">

        <label for="supplier_name">Supplier</label>
        <select name="supplier_name" id="supplier_name">
            <?php foreach ($data['suppliers'] as $supp) :  ?>
                <option value="<?= $supp['supplier_name']; ?>"> <?= $supp['supplier_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="product_avb">Ketersediaan </label>
        <select name="product_avb" id="product_avb">
            <option value="Ready">Ready</option>
            <option value="Not Ready">Not Ready</option>
        </select>


        <label for="product_price">Harga Product</label>
        <input type="number" id="product_price" name="product_price" autocomplete="off">

        <input type="submit" value="Submit">
    </form>

</div>