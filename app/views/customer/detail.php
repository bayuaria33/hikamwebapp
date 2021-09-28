<div class="container">
    <br>
    <?php Flasher::flash() ?>
    <h1>Detail <?= $data['cust']['customer_name']; ?></h1>
    <a href="<?= BASEURL; ?>/Customer" class="editButton">Kembali</a>
    <a href="<?= BASEURL; ?>/Customer/editPage/<?= $data['cust']['customer_id']; ?>" class="editButton">Edit</a>
    <br>
    <div>

        <table id="tabledetail">
            <tr>
                <th>Detail Customer</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <b>Nama Customer</b>
                </td>
                <td>
                    <?= $data['cust']['customer_name']; ?>
                </td>
                <td>
                    <b>Nomor Telepon 1 </b>
                </td>
                <td>
                    <?= $data['cust']['no_telp1']; ?>
                </td>

            </tr>

            <tr>
                <td>
                    <b>Alamat Penagihan</b>
                </td>
                <td>
                    <?= $data['cust']['alamat_penagihan']; ?>
                </td>
                <td>
                    <b>Nomor Telepon 2 </b>
                </td>
                <td>
                    <?= $data['cust']['no_telp2']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Alamat Pengiriman</b>
                </td>
                <td>
                    <?= $data['cust']['alamat_pengiriman']; ?>
                </td>
                <td>
                    <b>Email</b>
                </td>
                <td>
                    <?= $data['cust']['email']; ?>
                </td>
            </tr>
        </table>
    </div>
</div>