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
                        <a href="<?= BASEURL; ?>/Customer/detail/<?= $cust['customer_id']; ?>" class="detailButton detail" style="float:right">Detail</a>
                    </td>

                </tr>
            <?php endforeach; ?>

            <!-- ------------------------------------------------------------- -->

        </table>

    </div>