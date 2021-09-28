<div class="container">
    <h1>Tambah data Customer</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Customer">Kembali</a>


    <form action="<?= BASEURL; ?>/Customer/tambah" method="post">
        <label for="customer_name">Nama Customer</label>
        <input type="text" id="customer_name" name="customer_name" autocomplete="off">

        <label for="alamat_penagihan">Alamat Penagihan</label>
        <input type="text" id="alamat_penagihan" name="alamat_penagihan" autocomplete="off">

        <label for="alamat_pengiriman">Alamat Pengiriman</label>
        <input type="text" id="alamat_pengiriman" name="alamat_pengiriman" autocomplete="off">

        <label for="no_telp1">Nomor Telepon Customer</label>
        <input type="number" id="no_telp1" name="no_telp1" autocomplete="off">

        <label for="no_telp2">Nomor Telepon Customer</label>
        <input type="number" id="no_telp2" name="no_telp2" autocomplete="off">

        <label for="email">Email Customer</label>
        <input type="email" id="email" name="email" autocomplete="off">

        <input type="submit" value="Submit">
    </form>

</div>