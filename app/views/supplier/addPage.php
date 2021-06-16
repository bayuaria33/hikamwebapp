<div class="container">
    <h1>Tambah data Supplier</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Supplier">Kembali</a>


    <form action="<?= BASEURL; ?>/Supplier/tambah" method="post">
        <label for="supplier_name">Nama Supplier</label>
        <input type="text" id="supplier_name" name="supplier_name" autocomplete="off">

        <label for="sales_name">Nama Sales</label>
        <input type="text" id="sales_name" name="sales_name" autocomplete="off">

        <label for="norek1">No. Rekening 1</label>
        <input type="text" id="norek1" name="norek1" autocomplete="off">

        <label for="norek2">No. Rekening 2</label>
        <input type="text" id="norek2" name="norek2" autocomplete="off">

        <label for="alamat1">Alamat Supplier 1 </label>
        <input type="text" id="alamat1" name="alamat1" autocomplete="off">

        <label for="alamat2">Alamat Supplier 2 </label>
        <input type="text" id="alamat2" name="alamat2" autocomplete="off">

        <label for="no_telp1">Nomor Telepon Supplier 1 </label>
        <input type="number" id="no_telp1" name="no_telp1" autocomplete="off">

        <label for="no_telp2">Nomor Telepon Supplier 2 </label>
        <input type="number" id="no_telp2" name="no_telp2" autocomplete="off">

        <label for="email">Email Supplier</label>
        <input type="email" id="email" name="email" autocomplete="off">

        <input type="submit" value="Submit">
    </form>

</div>