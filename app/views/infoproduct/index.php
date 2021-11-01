<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Supplier <?= $data['inprod'][0]['product_name']; ?></h1>
        <br>

        <a href="<?= BASEURL; ?>/Product" class="editButton">Kembali</a> <br>
        <a class="editButton" href="<?= BASEURL; ?>/InfoProduct/addPage/ <?= $data['inprod'][0]['product_id']; ?>">Tambah Data </a>


        <!-- <form action="<?= BASEURL; ?>/Product/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Product.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form> -->

        <table id="tabledetail">
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Ketersediaan</th>
                    <th>Deskripsi</th>
                    <th>Unit</th>
                    <th>Harga Beli</th>
                    <th>Updated</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['inprod'] as $inprod) : ?>
                    <tr>
                        <td>
                            <?= $inprod['supplier_name']; ?>
                        </td>
                        <td>
                            <?= $inprod['product_avb']; ?>
                        </td>
                        <td>
                            <?= $inprod['product_desc']; ?>
                        </td>
                        <td>
                            <?= $inprod['unit']; ?>
                        </td>
                        <td>
                            <?= number_format($inprod['product_price']); ?>
                        </td>
                        <td>
                            <?= $inprod['product_updated']; ?>
                        </td>

                        <td>

                            <!-- <label class="editButton">
                            <input type="file" accept="application/pdf, application/vnd.ms-excel" />
                            Upload File
                        </label>

                        <a href="#" class="detailButton" style="float:right;margin-left: 0px;">Check File</a> -->
                            <a href="<?= BASEURL; ?>/InfoProduct/hapus/<?= $inprod['infoproduct_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                            <a href="<?= BASEURL; ?>/InfoProduct/editPage/<?= $inprod['infoproduct_id']; ?>" class="editButton" style="float:right">Edit</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>