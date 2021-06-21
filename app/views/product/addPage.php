<div class="container">
    <h1>Tambah data Product</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Product">Kembali</a>


    <form action="<?= BASEURL; ?>/Product/tambah" method="post">
        <label for="product_name">Nama Product</label>
        <input type="text" id="product_name" name="product_name" autocomplete="off">

        <label for="product_sell_price">Harga Product</label>
        <input type="number" id="product_sell_price" name="product_sell_price" autocomplete="off">

        <label for="unit">jenis Unit Product</label>
        <select name="unit" id="unit" autocomplete="off" value="<?= $data['prod']['unit']; ?>">
            <option value="liter">Liter</option>
            <option value="Kg">Kg</option>
            <option value="Ton">Ton</option>
            <option value="Kubik">Kubik</option>
        </select>

        <label for="product_desc">Deskripsi Product</label>
        <input type="text" id="product_desc" name="product_desc" autocomplete="off">

        <!-- <label for="product_updated">update Product</label>
        <input type="text" id="product_updated" name="product_updated" autocomplete="off"> -->

        <label for="product_quantity">Quantity Product</label>
        <input type="number" id="product_quantity" name="product_quantity" autocomplete="off">

        <input type="submit" value="Submit">
    </form>

</div>