<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Purchase Order <?= $data['purchase_number']; ?></h1>
        <a href="<?= BASEURL; ?>/Purchase" class="editButton">Kembali</a>
        <a href="<?= BASEURL; ?>/Purchase/editPage/<?= $data['PO']['PO_id']; ?>" class="editButton">Edit</a>
        <a href="<?= BASEURL; ?>/Purchase/generatePDF/<?= $data['PO']['PO_id']; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Generate PDF</a>
        <br>
        <table id="tabledetail">
            <tr>
                <th>Detail Purchase</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <b>Nama Customer</b>
                </td>
                <td>
                    <?= $data['PO']['customer_name']; ?>
                </td>
                <td>
                    <b>Tanggal Purchase</b>
                </td>
                <td>
                    <?= $data['purchase_date_format']; ?>
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
                    <b>Tanggal Jatuh Tempo</b>
                </td>
                <td>
                    <?= $data['due_date_format']; ?>
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
                    <b>Catatan Lain</b>
                </td>
                <td>
                    <?= $data['PO']['other_expenses']; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Nomor Telepon</b>
                </td>
                <td>
                    <?= $data['cust']['no_telp1']; ?>
                </td>
                <td>
                    <b>Status Pembayaran</b>
                </td>
                <td>
                    <?= $data['PO']['status_pembayaran']; ?>
                </td>


            </tr>
            <tr>
                <td>
                    <b>invoice_id</b>
                </td>
                <td>
                    <?= $data['PO']['invoice_id']; ?>
                </td>
                <td>
                    <b>DO ID</b>
                </td>
                <td>
                    <?= $data['PO']['DO_id']; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>PPN</b>
                </td>
                <td>
                    <?= $data['PO']['ppn']; ?> %
                </td>
            </tr>
            <tr>

            </tr>
        </table>

        <br>
        <a class="editButton" href="<?= BASEURL; ?>/Purchase/addItemPage/<?= $data['PO']['PO_id']; ?>">Tambah Item </a>
        <br>
        <!-- table item invoice -->
        <table id="tabledetail">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php foreach ($data['pc_item'] as $PO) : ?>
                <tr>
                    <td>
                        <?= $PO['product_name'] ?>
                    </td>
                    <td>
                        <?= $PO['quantity']; ?>
                    </td>
                    <td>
                        <?= $PO['price']; ?>
                    </td>


                    <td>
                        <a href="<?= BASEURL; ?>/Purchase/hapusItem/<?= $PO['pc_item_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Purchase/editItemPage/<?= $PO['pc_item_id']; ?>" class="editButton" style="float:right">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>