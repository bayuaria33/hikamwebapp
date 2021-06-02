<div class="container">
    <h1>Customer</h1>
    <h3>Daftar Customer</h3>

    <table id="customers">
        <tr>
            <th>Nama</th>
        </tr>

        <?php foreach ($data['cust'] as $cust) : ?>
            <tr>
                <td>
                    <?= $cust['customer_name']; ?>
                    <a href="" id="badgebutton" style="float:right">Detail</a>
                </td>

            </tr>
        <?php endforeach; ?>

        <!-- ------------------------------------------------------------- -->
        <!-- <?php foreach ($data['cust'] as $cust) : ?>
            <tr>
                <td><?= $cust['customer_name']; ?></td>
                <td><?= $cust['alamat1']; ?></td>
                <td><?= $cust['no_telp1']; ?></td>
                <td><?= $cust['email']; ?></td>
            </tr>
        <?php endforeach; ?> -->


    </table>
</div>