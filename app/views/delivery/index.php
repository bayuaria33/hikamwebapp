<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1><?= $data['judul']; ?></h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Delivery/addPage">Tambah data </a>

        <!-- <form action="<?= BASEURL; ?>/Delivery/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Delivery.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form> -->

        <table id="tabledetail">
            <thead>
                <tr>
                    <th class="datetime">Delivery Date</th>
                    <th>Delivery Number</th>
                    <th>Customer Name</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['DO'] as $DO => $value) : ?>
                    <tr>
                        <td>
                            <?=
                            $output = date('d-m-Y', strtotime($value['DO_date']));
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($value['delivery_number'])) { ?>
                                <?= $value['delivery_number']; ?>
                            <?php  } else { ?>
                                Buka Detail untuk generate No. Delivery
                            <?php } ?>
                        </td>
                        <td>
                            <?= $value['customer_name']; ?>
                        </td>


                        <td>
                            <a href="<?= BASEURL; ?>/Delivery/hapus/<?= $value['DO_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                            <a href="<?= BASEURL; ?>/Delivery/item/<?= $value['DO_id']; ?>" class="editButton" style="float:right">Detail</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>