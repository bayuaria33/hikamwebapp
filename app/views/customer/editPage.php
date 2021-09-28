<div class="container">
    <h1>Edit data Customer</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Customer">Kembali</a>

    <form action="<?= BASEURL; ?>/Customer/edit" method="post">


        <label class="hidden" for="customer_id">Id Customer</label>
        <input class="hidden" type="hidden" id="customer_id" name="customer_id" autocomplete="off" value="<?= $data['cust']['customer_id']; ?>">

        <label for="customer_name">Nama Customer</label>
        <input type="text" id="customer_name" name="customer_name" autocomplete="off" value="<?= $data['cust']['customer_name']; ?>">

        <label for="alamat_penagihan">Alamat Penagihan</label>
        <input type="text" id="alamat_penagihan" name="alamat_penagihan" autocomplete="off" value="<?= $data['cust']['alamat_penagihan']; ?>">

        <label for="alamat_pengiriman">Alamat Pengiriman</label>
        <input type="text" id="alamat_pengiriman" name="alamat_pengiriman" autocomplete="off" value="<?= $data['cust']['alamat_pengiriman']; ?>">

        <label for="no_telp1">Nomor Telepon Customer</label>
        <input type="number" id="no_telp1" name="no_telp1" autocomplete="off" value="<?= $data['cust']['no_telp1']; ?>">

        <label for="no_telp2">Nomor Telepon Customer</label>
        <input type="number" id="no_telp2" name="no_telp2" autocomplete="off" value="<?= $data['cust']['no_telp2']; ?>">

        <label for="email">Email Customer</label>
        <input type="email" id="email" name="email" autocomplete="off" value="<?= $data['cust']['email']; ?>">

        <input type="submit" value="Submit">
    </form>

</div>