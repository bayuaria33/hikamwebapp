<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1><?= $data['judul']; ?></h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Purchase/addPage/<?= $data['jenis']; ?>">Tambah data </a>

        <table id="tabledetail">
            <thead>
                <tr>

                    <th class="datetime">Purchase Order Date</th>
                    <th>Purchase Number</th>
                    <th><?= $data['jenis']; ?> Name</th>
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
                            <?php
                            if (!empty($value['supplier_name'])) { ?>
                                <?= $value['supplier_name']; ?>
                            <?php  } else { ?>
                                <?= $value['customer_name']; ?>
                            <?php } ?>
                        </td>

                        <td>
                            <?php
                            if ($_SESSION['level_user'] == '4') { ?>
                                <a href="<?= BASEURL; ?>/Purchase/item/<?= $value["PO_id"]; ?>" class="editButton" style="float:right">Detail</a>
                            <?php  } else { ?>
                                <a href="<?= BASEURL; ?>/Purchase/hapus/<?= $value['PO_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                                <a href="<?= BASEURL; ?>/Purchase/item/<?= $value["PO_id"]; ?>" class="editButton" style="float:right">Detail</a>
                            <?php } ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>