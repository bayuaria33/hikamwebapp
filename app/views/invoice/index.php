<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Invoice</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Invoice/addPage">Tambah data </a>

        <form action="<?= BASEURL; ?>/Invoice/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Invoice.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form>

        <table id="tabledetail">
            <tr>
                <th>Invoice Number</th>
                <th>Invoice Date</th>
                <th>Customer Name</th>
                <th>Action</th>
            </tr>
            <!-- <?= '<pre>', var_dump($data), '</pre>' ?> -->
            <?php foreach ($data['invc'] as $invc) : ?>
                <tr>
                    <td>
                        <?= $invc['invoice_id'] ?>
                    </td>
                    <td>
                        <?= $invc['invoice_date']; ?>
                    </td>
                    <td>
                        <?= $invc['customer_name']; ?>
                    </td>


                    <td>
                        <a href="<?= BASEURL; ?>/Invoice/hapus/<?= $invc['invoice_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Invoice/item/<?= $invc["invoice_id"]; ?>" class="editButton" style="float:right">Detail</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>