<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1><?= $data['judul']; ?></h1>
        <br>
        <a class="editButton" href="<?= BASEURL; ?>/Invoice/addPage">Tambah data </a>

        <!-- <form action="<?= BASEURL; ?>/Invoice/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Invoice.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form> -->

        <table id="tabledetail">
            <thead>
                <tr>
                    <th class="datetime">Invoice Date</th>
                    <th>Invoice Number</th>
                    <th>Customer Name</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['invc'] as $invc => $value) : ?>
                    <tr>
                        <td>
                            <?=
                            $output = date('d-F-Y', strtotime($value['invoice_date'])); ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($value['invoice_number'])) { ?>
                                <?= $value['invoice_number']; ?>
                            <?php  } else { ?>
                                Buka Detail untuk generate No. Invoice
                            <?php } ?>
                        </td>
                        <td>
                            <?= $value['customer_name']; ?>
                        </td>


                        <td>
                            <a href="<?= BASEURL; ?>/Invoice/hapus/<?= $value['invoice_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                            <a href="<?= BASEURL; ?>/Invoice/item/<?= $value["invoice_id"]; ?>" class="editButton" style="float:right">Detail</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>