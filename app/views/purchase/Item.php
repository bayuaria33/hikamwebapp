<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <?php
        if (!empty($data['PO']['purchase_number'])) { ?>
            <h1>Purchase <?= $data['PO']['purchase_number']; ?></h1>
        <?php  } else { ?>
            <h1>Purchase <?= $data['purchase_number']; ?></h1>
        <?php } ?>


        <?php
        if (!empty($data['PO']['supplier_name'])) { ?>
            <a class="editButton" href="<?= BASEURL; ?>/Purchase/index">Kembali</a>
            <a href="<?= BASEURL; ?>/Purchase/editPage/<?= $data['PO']['PO_id']; ?>/Supplier" class="editButton">Edit</a>
        <?php  } else { ?>
            <a class="editButton" href="<?= BASEURL; ?>/Purchase/index2">Kembali</a>
            <a href="<?= BASEURL; ?>/Purchase/editPage/<?= $data['PO']['PO_id']; ?>/Customer" class="editButton">Edit</a>
        <?php } ?>


        <a href="<?= BASEURL; ?>/Purchase/generatePDF/<?= $data['PO']['PO_id']; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Generate PDF</a>

        <!-- button cek invoice -->
        <?php
        if (!empty($data['PO']['invoice_id'])) { ?>
            <a href="<?= BASEURL; ?>/Invoice/item/<?= $data['PO']["invoice_id"]; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Cek Invoice</a>
        <?php  } else { ?>
            <div class="alert"> Invoice Belum di isi</div>
        <?php } ?>

        <!-- button cek DO -->
        <?php
        if (!empty($data['PO']['DO_id'])) { ?>
            <a href="<?= BASEURL; ?>/Delivery/item/<?= $data['PO']["DO_id"]; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Cek Delivery Order</a>
        <?php  } else { ?>
            <div class="alert"> Delivery Order Belum di isi</div>
        <?php } ?>

        <br>
        <?php
        if (!empty($data['PO']['supplier_name'])) { ?>
            <!-- Supplier -->
            <table id="tabledetail">
                <tr>
                    <th>Detail Purchase Supplier</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                    <td>
                        <b>Nama Supplier</b>
                    </td>
                    <td>
                        <?= $data['PO']['supplier_name']; ?>
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
                        <?= $data['supp']['alamat_penagihan']; ?>
                    </td>
                    <td>
                        <b>Tanggal Jatuh Tempo</b>
                    </td>
                    <td>
                        <?php
                        if ($data['PO']['due_date'] == "0000-00-00") { ?>
                            -
                        <?php  } else { ?>
                            <?= $data['due_date_format']; ?>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Alamat Pengiriman</b>
                    </td>
                    <td>
                        <?= $data['supp']['alamat_pengiriman']; ?>
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
                        <?= $data['supp']['no_telp1']; ?>
                    </td>
                    <td>
                        <b>Status Pembayaran</b>
                    </td>
                    <td>
                        <?= $data['PO']['status_pembayaran']; ?>
                    </td>


                </tr>
                <tr>
                    <!-- <td>
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
                    </td> -->
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
                    <td>
                        <b>Payment Option</b>
                    </td>
                    <td>
                        <?= $data['PO']['payment_option']; ?>
                    </td>
                </tr>
            </table>
        <?php  } else { ?>
            <!-- Customer -->
            <table id="tabledetail">
                <tr>
                    <th>Detail Purchase Customer</th>
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
                        <?php
                        if ($data['PO']['due_date'] == "0000-00-00") { ?>
                            -
                        <?php  } else { ?>
                            <?= $data['due_date_format']; ?>
                        <?php } ?>
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
                    <td>
                        <b>Payment Option</b>
                    </td>
                    <td>
                        <?= $data['PO']['payment_option']; ?>
                    </td>
                </tr>
            </table>
        <?php } ?>



        <br>
        <a class="editButton" href="<?= BASEURL; ?>/Purchase/addItemPage/<?= $data['PO']['PO_id']; ?>">Tambah Item </a>
        <br>
        <!-- table item invoice -->
        <table id="tabledetail">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit</th>
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
                        <?= $PO['unit_item']; ?>
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