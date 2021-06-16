<div class="container">
    <h1>Edit data Supplier</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Supplier">Kembali</a>

    <form action="<?= BASEURL; ?>/Supplier/edit" method="post">


        <label class="hidden" for="supplier_id">Id Supplier</label>
        <input class="hidden" type="hidden" id="supplier_id" name="supplier_id" autocomplete="off" value="<?= $data['sup']['supplier_id']; ?>">

        <label for="supplier_name">Nama Supplier</label>
        <input type="text" id="supplier_name" name="supplier_name" autocomplete="off" value="<?= $data['sup']['supplier_name']; ?>">

        <label for="sales_name">Nama Sales</label>
        <input type="text" id="sales_name" name="sales_name" autocomplete="off" value="<?= $data['sup']['sales_name']; ?>">

        <label for="norek1">Nomor rekening</label>
        <input type="text" id="norek1" name="norek1" autocomplete="off" value="<?= $data['sup']['norek1']; ?>">

        <label for="norek2">Nomor rekening</label>
        <input type="text" id="norek2" name="norek2" autocomplete="off" value="<?= $data['sup']['norek2']; ?>">

        <label for="alamat1">Alamat Supplier</label>
        <input type="text" id="alamat1" name="alamat1" autocomplete="off" value="<?= $data['sup']['alamat1']; ?>">

        <label for="alamat2">Alamat Supplier</label>
        <input type="text" id="alamat2" name="alamat2" autocomplete="off" value="<?= $data['sup']['alamat2']; ?>">

        <label for="no_telp1">Nomor Telepon Supplier</label>
        <input type="number" id="no_telp1" name="no_telp1" autocomplete="off" value="<?= $data['sup']['no_telp1']; ?>">

        <label for="no_telp2">Nomor Telepon Supplier</label>
        <input type="number" id="no_telp2" name="no_telp2" autocomplete="off" value="<?= $data['sup']['no_telp2']; ?>">

        <label for="email">Email Supplier</label>
        <input type="email" id="email" name="email" autocomplete="off" value="<?= $data['sup']['email']; ?>">

        <input type="submit" value="Submit">
    </form>

</div>