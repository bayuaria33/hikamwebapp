<div class="container">
    <h1>Update info Supplier</h1>
    <a href="<?= BASEURL; ?>/InfoProduct/detailSupp/<?= $data['inprod']['product_id']; ?>" class="editButton">Kembali</a> <br>

    <form action="<?= BASEURL; ?>/InfoProduct/edit" method="post">

        <label class="hidden" for="infoproduct_id">Id infoProduct </label>
        <input class="hidden" type="hidden" id="infoproduct_id" name="infoproduct_id" autocomplete="off" value="<?= $data['inprod']['infoproduct_id']; ?>">

        <label for="supplier_name">Supplier </label>
        <input type="text" id="supplier_name" name="supplier_name" autocomplete="off" value="<?= $data['inprod']['supplier_name']; ?>" readonly>

        <label for="product_avb">Ketersediaan </label>
        <select name="product_avb" id="product_avb">
            <option value="Ready">Ready</option>
            <option value="Not Ready">Not Ready</option>
        </select>

        <label for="product_desc">Deskripsi </label>
        <input type="text" id="product_desc" name="product_desc" autocomplete="off" value="<?= $data['inprod']['product_desc']; ?>">

        <label for="unit">Unit </label>
        <input type="text" id="unit" name="unit" autocomplete="off" value="<?= $data['inprod']['unit']; ?>">

        <label for="product_price">Harga </label>
        <input type="number" id="product_price" name="product_price" autocomplete="off" value="<?= $data['inprod']['product_price']; ?>">


        <input type="submit" value="Submit">


    </form>

</div>