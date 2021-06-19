<div class="container">
    <h1>Edit data Product</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Product">Kembali</a>

    <form action="<?= BASEURL; ?>/Product/edit" method="post">


        <label class="hidden" for="product_id">Id Product</label>
        <input class="hidden" type="hidden" id="product_id" name="product_id" autocomplete="off" value="<?= $data['prod']['product_id']; ?>">

        <label for="product_name">Nama Product</label>
        <input type="text" id="product_name" name="product_name" autocomplete="off" value="<?= $data['prod']['product_name']; ?>">

        <label for="product_desc">deskripsi Product</label>
        <input type="text" id="product_desc" name="product_desc" autocomplete="off" value="<?= $data['prod']['product_desc']; ?>">

        <label for="product_sell_price">Harga Jual Product</label>
        <input type="number" id="product_sell_price" name="product_sell_price" autocomplete="off" value="<?= $data['prod']['product_sell_price']; ?>">

        <label for="unit">Unit Product</label>
        <input type="text" id="unit" name="unit" autocomplete="off" value="<?= $data['prod']['unit']; ?>">

        <label for="product_updated">Update Product</label>
        <input type="number" id="product_updated" name="product_updated" autocomplete="off" value="<?= $data['prod']['product_updated']; ?>">

        <label for="product_quantity">Quantity Product</label>
        <input type="number" id="product_quantity" name="product_quantity" autocomplete="off" value="<?= $data['prod']['product_quantity']; ?>">

        <input type="submit" value="Submit">
    </form>

</div>