<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Customer</h1>

        <a class="editButton" href="<?= BASEURL; ?>/Customer/addPage">Tambah data </a>


        <table id="customers">
            <tr>
                <th>Nama</th>
            </tr>

            <?php foreach ($data['cust'] as $cust) : ?>
                <tr>
                    <td>
                        <?= $cust['customer_name']; ?>
                        <a href="<?= BASEURL; ?>/Customer/hapus/<?= $cust['customer_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        <a href="<?= BASEURL; ?>/Customer/detail/<?= $cust['customer_id']; ?>" class="detailButton" style="float:right">Detail</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>