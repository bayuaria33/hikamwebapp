<div class="container-fluid">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Product Inventory</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Product/addPage">Tambah data </a>

        <!-- <form action="<?= BASEURL; ?>/Product/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Product.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form> -->

        <table id="tabledetail">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga Jual</th>
                    <th>Unit</th>
                    <th>Deskripsi</th>
                    <th class="datetime">Updated</th>
                    <th>Quantity</th>
                    <th class="actionbuttons">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['prod'] as $prod) : ?>
                    <tr>
                        <td>
                            <?= $prod['product_name']; ?>
                        </td>
                        <td>
                            <?= number_format($prod['product_sell_price'], 2); ?>
                        </td>
                        <td>
                            <?= $prod['unit']; ?>
                        </td>
                        <td>
                            <?= $prod['product_desc']; ?>
                        </td>
                        <td>
                            <?= $prod['product_updated']; ?>
                        </td>
                        <td>
                            <?= $prod['product_quantity']; ?>
                        </td>
                        <td>
                            <?php
                            if ($_SESSION['level_user'] == '5') { ?>
                                <a href="<?= BASEURL; ?>/Product/editPage/<?= $prod['product_id']; ?>" class="editButton" style="float:right">Edit</a>
                            <?php  } else { ?>
                                <a href="<?= BASEURL; ?>/Product/hapus/<?= $prod['product_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                                <a href="<?= BASEURL; ?>/Product/editPage/<?= $prod['product_id']; ?>" class="editButton" style="float:right">Edit</a>
                                <a href="<?= BASEURL; ?>/InfoProduct/detailSupp/<?= $prod['product_id']; ?>" class="detailButton" style="float:right">Info Supplier</a>
                            <?php } ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>