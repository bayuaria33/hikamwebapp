<div class="container">
    <h1>Tambah info Suplier</h1>
    <a class="editButton" href="<?= BASEURL; ?>/InfoProduct">Kembali</a>


    <form action="<?= BASEURL; ?>/InfoProduct/tambah" method="post">
        <label for="product_id">id Product</label>
        <input type="number" id="product_id" name="product_id" autocomplete="off">

        <label for="product_avb">Ketersediaan produk</label>
        <input type="number" id="product_avb" name="product_avb" autocomplete="off">

        <label for="supplier_id">pilih suplier</label>
        <input type="text" id="supplier_id" name="suplier_id" autocomplete="off">

        <label for="product_price">Harga Product</label>
        <input type="number" id="product_price" name="product_price" autocomplete="off">

        <label for="product_update">update Product</label>
        <input type="text" id="product_update" name="product_update" autocomplete="off">
        
        <input type="submit" value="Submit">
    </form>

</div>