<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Product</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Product/addPage">Tambah data </a>

        <form action="<?= BASEURL; ?>/Product/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Product.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form>

        <table id="customers">
            <tr>
                <th>prodid</th>
                <th>ketersediaan</th>
                <th>Suplier</th>
                <th>Harga</th>
                <th>updated</th>
                <th>action</th>

            </tr>

            <?php foreach ($data['inprod'] as $inprod) : ?>
                <tr>
                    <td>
                        <?= $inprod['product_id']; ?>
                    </td>
                    <td>
                        <?= $inprod['product_avb']; ?>
                    </td>
                    <td>
                        <?= $inprod['supplier_id']; ?>
                    </td>
                    <td>
                        <?= $inprod['product_price']; ?>
                    </td>
                    <td>
                        <?= $inprod['product_update']; ?>
                    </td>
                                    
                    <td>
                    <a href="<?= BASEURL; ?>/InfoProduct/hapus/<?= $inprod['infoproduct_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/InfoProduct/editPage/<?= $inprod['infoproduct_id']; ?>" class="editButton" style="float:right">Edit</a>
                        <!-- <a href="<?= BASEURL; ?>/InfoProduct/detail/<?= $inprod['infoproduct_id']; ?>" class="detailButton" style="float:right">detail</a> -->
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>