<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1><?= $data['judul']; ?></h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Purchase/addPage">Tambah data </a>

        <!-- <form action="<?= BASEURL; ?>/Purchase/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Purchase.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form> -->

        <table id="tabledetail">
            <thead>
                <tr>

                    <th class="datetime">Purchase Order Date</th>
                    <th>Purchase Number</th>
                    <th>Customer Name</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['PO'] as $PO => $value) : ?>
                    <tr>

                        <td>
                            <?= $output = date('d-m-Y', strtotime($value['PO_date'])); ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($value['purchase_number'])) { ?>
                                <?= $value['purchase_number']; ?>
                            <?php  } else { ?>
                                Buka Detail untuk generate No. Purchase
                            <?php } ?>
                        </td>
                        <td>
                            <?= $value['customer_name']; ?>
                        </td>


                        <td>
                            <a href="<?= BASEURL; ?>/Purchase/hapus/<?= $value['PO_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                            <a href="<?= BASEURL; ?>/Purchase/item/<?= $value["PO_id"]; ?>" class="editButton" style="float:right">Detail</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>