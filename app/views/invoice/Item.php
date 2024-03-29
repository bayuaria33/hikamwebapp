<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>

        <?php
        if (!empty($data['invc']['invoice_number'])) { ?>
            <h1>Invoice <?= $data['invc']['invoice_number']; ?></h1>
        <?php  } else { ?>
            <h1>Invoice <?= $data['invoice_number']; ?></h1>
        <?php } ?>
        <a href="<?= BASEURL; ?>/Invoice" class="editButton">Kembali</a>
        <a href="<?= BASEURL; ?>/Invoice/editPage/<?= $data['invc']['invoice_id']; ?>" class="editButton">Edit</a>
        <!-- <a href="<?= BASEURL; ?>/Invoice/generatePDF/<?= $data['invc']['invoice_id']; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Generate PDF</a> -->
        <!-- button cek PO -->
        <?php
        if (!empty($data['invc']['PO_id'])) { ?>
            <a href="<?= BASEURL; ?>/Purchase/item/<?= $data['invc']["PO_id"]; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Cek Purchase Order</a>
        <?php  } else { ?>
            <div class="alert"> Purchase Order Belum di isi</div>
        <?php } ?>

        <!-- button cek DO -->
        <?php
        if (!empty($data['invc']['DO_id'])) { ?>
            <a href="<?= BASEURL; ?>/Delivery/item/<?= $data['invc']["DO_id"]; ?>" class="detailButton" style="margin-left: 0;" target="_blank">Cek Delivery Order</a>
        <?php  } else { ?>
            <div class="alert"> Delivery Order Belum di isi</div>
        <?php } ?>

        <br>
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
                    if ($data['invc']['due_date'] == "0000-00-00") { ?>
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
                <td>
                    <b>PPN</b>
                </td>
                <td>
                    <?= $data['invc']['ppn']; ?> %
                </td>
                <td>
                    <b>Biaya Kirim</b>
                </td>
                <td>
                    <?= number_format($data['invc']['biaya_kirim'], 2);  ?>
                </td>
            </tr>
            <tr>
            <tr>
                <td>
                    <b>Payment Option</b>
                </td>
                <td>
                    <?= $data['invc']['payment_option']; ?>
                </td>
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
                <th>Unit</th>
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
                        <?= $invc['unit_item']; ?>
                    </td>
                    <td>
                        <?= number_format($invc['price'], 2);  ?>
                    </td>


                    <td>
                        <a href="<?= BASEURL; ?>/Invoice/hapusItem/<?= $invc['invc_item_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Invoice/editItemPage/<?= $invc['invc_item_id']; ?>" class="editButton" style="float:right">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

        <br>
        <b>Text tambahan 1</b>
        <form action="<?= BASEURL; ?>/Invoice/pregenPDF/<?= $data['invc']['invoice_id']; ?>" method="POST" target="_blank">
        <?php if($data['invc_text'] != false){
            $value1 =$data['invc_text']['text1'];
            $value2 =$data['invc_text']['text2'];
        }else{
            $value1=
            "Transfer FULL AMOUNT \n(Sesuai Nilai PO / Biaya Transfer Ditanggung Buyer) \nBCA KCP JATINEGARA TIMUR \nAcc Name : PT HIKAM ABADI INDONESIA \nNo Rek : 496 024 7090";
            $value2=
            "Lembar putih dan merah untuk customer / penerima Invoice \n1. Pembayaran dengan CHEQUE / GIRO, Mohon mencantumkan nama perusahaan kami. \n2. Kwitansi ini dinyatakan LUNAS, apabila CHEQUE / GIRO telah cair pada rekening Bank kami.";
        } ?>
            <textarea id="text1" name="text1" rows="5" cols="139" style="resize: none;" value="<?$value1 ?>"><?= $value1; ?></textarea>
            <br><br>

            <b>Text tambahan 2</b>
            <textarea id="text2" name="text2" rows="5" cols="139" style="resize: none;" value="<?$value2 ?>"><?= $value2 ?></textarea>

            <label for="" style="color: grey;">*Tekan Generate untuk menyimpan perubahan pada text tambahan.</label>
            <input type="submit" value="Generate PDF">
        </form>


    </div>