<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Item Invoice <?= $data['invoice_number']; ?></h1>
        <a href="<?= BASEURL; ?>/Invoice" class="editButton">Kembali</a>
        <a href="<?= BASEURL; ?>/Invoice/editPage/<?= $data['invc']['invoice_id']; ?>" class="editButton">Edit</a>
        <a href="<?= BASEURL; ?>/Invoice/generatePDF/<?= $data['invc']['invoice_id']; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Generate PDF</a>
        <br>
        <!-- <?php echo '<pre>', var_dump($data), '</pre>'; ?> -->
        <!-- tabel detail invoice -->
        <table id="tabledetail">
            <tr>
                <th>Detail Invoice</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <b>Nama Customer</b>
                </td>
                <td>
                    <?= $data['invc']['customer_name']; ?>
                </td>
                <td>
                    <b>Tanggal Invoice</b>
                </td>
                <td>
                    <?= $data['invoice_date_format']; ?>
                </td>

            </tr>

            <tr>
                <td>
                    <b>Alamat Customer</b>
                </td>
                <td>
                    <?= $data['cust']['alamat1']; ?>
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
                    <b>Alamat Customer</b>
                </td>
                <td>
                    <?= $data['cust']['alamat2']; ?>
                </td>
                <td>
                    <b>Pengeluaran Lain</b>
                </td>
                <td>
                    <?= $data['invc']['other_expenses']; ?>
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
                    <?= $data['invc']['status_pembayaran']; ?>
                </td>


            </tr>
            <tr>
                <td>
                    <b>PO ID</b>
                </td>
                <td>
                    <?= $data['invc']['PO_id']; ?>
                </td>
                <td>
                    <b>DO ID</b>
                </td>
                <td>
                    <?= $data['invc']['DO_id']; ?>
                </td>
            </tr>
            <tr>

            </tr>
        </table>

        <br>
        <a class="editButton" href="<?= BASEURL; ?>/Invoice/addItemPage/<?= $data['invc']['invoice_id']; ?>">Tambah Item </a>
        <br>
        <!-- table item invoice -->
        <table id="tabledetail">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php foreach ($data['invc_item'] as $invc) : ?>
                <tr>
                    <td>
                        <?= $invc['product_name'] ?>
                    </td>
                    <td>
                        <?= $invc['quantity']; ?>
                    </td>
                    <td>
                        <?= $invc['price']; ?>
                    </td>


                    <td>
                        <a href="<?= BASEURL; ?>/Invoice/hapusItem/<?= $invc['invc_item_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Invoice/editItemPage/<?= $invc['invc_item_id']; ?>" class="editButton" style="float:right">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>