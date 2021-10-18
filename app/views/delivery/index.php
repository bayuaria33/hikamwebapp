<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Delivery Order</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Delivery/addPage">Tambah data </a>

        <form action="<?= BASEURL; ?>/Delivery/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Delivery.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form>

        <table id="tabledetail">
            <tr>
                <!-- <th>No. </th> -->
                <th>Delivery Date</th>
                <th>Customer Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($data['DO'] as $DO => $value) : ?>
                <tr>
                    <!-- <td>
                        <?= $DO + 1 ?>
                    </td> -->
                    <td>
                        <?=
                        $output = date('d-m-Y', strtotime($value['DO_date'])); ?>
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

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>