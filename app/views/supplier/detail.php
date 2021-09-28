<div class="container">
    <br>
    <?php Flasher::flash() ?>
    <h1>Detail Supplier</h1>
    <a href="<?= BASEURL; ?>/Supplier" class="editButton">Kembali</a>
    <a href="<?= BASEURL; ?>/Supplier/editPage/<?= $data['sup']['supplier_id']; ?>" class="editButton">Edit</a>
    <br>
    <div>
        <table id="tabledetail">
            <tr>
                <th>Detail Supplier</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>

            <tr>
                <td>
                    <b>Nama Supplier</b>
                </td>
                <td>
                    <?= $data['sup']['supplier_name']; ?>
                </td>
                <td>
                    <b>Nomor Telepon 1 </b>
                </td>
                <td>
                    <?= $data['sup']['no_telp1']; ?>
                </td>

            </tr>

            <tr>
                <td>
                    <b>Alamat Penagihan</b>
                </td>
                <td>
                    <?= $data['sup']['alamat_penagihan']; ?>
                </td>
                <td>
                    <b>Nomor Telepon 2 </b>
                </td>
                <td>
                    <?= $data['sup']['no_telp2']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Alamat Pengiriman</b>
                </td>
                <td>
                    <?= $data['sup']['alamat_pengiriman']; ?>
                </td>
                <td>
                    <b>Email</b>
                </td>
                <td>
                    <?= $data['sup']['email']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Nomor Rekening 1</b>
                </td>
                <td>
                    <?= $data['sup']['norek1']; ?>
                </td>
                <td>
                    <b>Nama Sales</b>
                </td>
                <td>
                    <?= $data['sup']['sales_name']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Nomor Rekening 2</b>
                </td>
                <td>
                    <?= $data['sup']['norek2']; ?>
                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>

        </table>
    </div>
</div>