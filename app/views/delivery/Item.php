<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>

        <?php
        if (!empty($data['DO']['delivery_number'])) { ?>
            <h1>Delivery Order <?= $data['DO']['delivery_number']; ?></h1>
        <?php  } else { ?>
            <h1>Delivery Order <?= $data['delivery_number']; ?></h1>
        <?php } ?>
        <a href="<?= BASEURL; ?>/Delivery" class="editButton">Kembali</a>
        <a href="<?= BASEURL; ?>/Delivery/editPage/<?= $data['DO']['DO_id']; ?>" class="editButton">Edit</a>
        <a href="<?= BASEURL; ?>/Delivery/generatePDF/<?= $data['DO']['DO_id']; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Generate PDF</a>

        <!-- button cek PO -->
        <?php
        if (!empty($data['DO']['PO_id'])) { ?>
            <a href="<?= BASEURL; ?>/Purchase/item/<?= $data['DO']["PO_id"]; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Cek Purchase Order</a>
        <?php  } else { ?>
            <div class="alert"> Purchase Order Belum di isi</div>
        <?php } ?>

        <!-- button cek Invoice -->
        <?php
        if (!empty($data['DO']['invoice_id'])) { ?>
            <a href="<?= BASEURL; ?>/Invoice/item/<?= $data['DO']["invoice_id"]; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Cek Invoice</a>
        <?php  } else { ?>
            <div class="alert"> Invoice Belum di isi</div>
        <?php } ?>

        <br>
        <table id="tabledetail">
            <tr>
                <th>Detail Delivery</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <b>Nama Customer</b>
                </td>
                <td>
                    <?= $data['DO']['customer_name']; ?>
                </td>
                <td>
                    <b>Tanggal Delivery</b>
                </td>
                <td>
                    <?= $data['delivery_date_format']; ?>
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
                    <?= $data['DO']['other_expenses']; ?>
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
                    <?= $data['DO']['status_pembayaran']; ?>
                </td>


            </tr>
            <tr>
                <td>
                    <b>PO ID</b>
                </td>
                <td>
                    <?= $data['DO']['PO_id']; ?>
                </td>
                <td>
                    <b>Invoice ID</b>
                </td>
                <td>
                    <?= $data['DO']['invoice_id']; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>PPN</b>
                </td>
                <td>
                    <?= $data['DO']['ppn']; ?> %
                </td>
            </tr>
            <tr>

            </tr>
        </table>

        <br>
        <a class="editButton" href="<?= BASEURL; ?>/Delivery/addItemPage/<?= $data['DO']['DO_id']; ?>">Tambah Item </a>
        <br>
        <!-- table item invoice -->
        <table id="tabledetail">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php foreach ($data['do_item'] as $DO) : ?>
                <tr>
                    <td>
                        <?= $DO['product_name'] ?>
                    </td>
                    <td>
                        <?= $DO['quantity']; ?>
                    </td>
                    <td>
                        <?= $DO['price']; ?>
                    </td>


                    <td>
                        <a href="<?= BASEURL; ?>/Delivery/hapusItem/<?= $DO['do_item_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Delivery/editItemPage/<?= $DO['do_item_id']; ?>" class="editButton" style="float:right">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>