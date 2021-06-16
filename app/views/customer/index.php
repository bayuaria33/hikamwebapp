<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Customer</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Customer/addPage">Tambah data </a>

        <form action="<?= BASEURL; ?>/Customer/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari Customer.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form>

        <table id="customers">
            <tr>
                <th>Nama</th>
            </tr>

            <?php foreach ($data['cust'] as $cust) : ?>
                <tr>
                    <td>
                        <?= $cust['customer_name']; ?>
                        <a href="<?= BASEURL; ?>/Customer/hapus/<?= $cust['customer_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Customer/editPage/<?= $cust['customer_id']; ?>" class="editButton" style="float:right">Edit</a>
                        <a href="<?= BASEURL; ?>/Customer/detail/<?= $cust['customer_id']; ?>" class="detailButton" style="float:right">Detail</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>