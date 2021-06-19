<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Supplier</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Supplier/addPage">Tambah data </a>

        <form action="<?= BASEURL; ?>/Supplier/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Supplier.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form>

        <table id="tabledetail">
            <tr>
                <th>Nama</th>
                <th>Action</th>
            </tr>

            <?php foreach ($data['sup'] as $sup) : ?>
                <tr>
                    <td>
                        <?= $sup['supplier_name']; ?>
                    <td>
                        <a href="<?= BASEURL; ?>/Supplier/hapus/<?= $sup['supplier_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Supplier/editPage/<?= $sup['supplier_id']; ?>" class="editButton" style="float:right">Edit</a>
                        <a href="<?= BASEURL; ?>/Supplier/detail/<?= $sup['supplier_id']; ?>" class="detailButton" style="float:right">Detail</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>