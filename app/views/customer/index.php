<div class="container">
    <h1>Customer</h1>
    <h3>Daftar Customer</h3>
    <!-- <?php foreach ($data['cust'] as $cust) : ?>
        <ul>
            <li><?= $cust['customer_name']; ?></li>
            <li><?= $cust['alamat1']; ?></li>
            <li><?= $cust['no_telp1']; ?></li>
            <li><?= $cust['email']; ?></li>
        </ul>
    <?php endforeach; ?> -->

    <table id="customers">
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Email</th>
        </tr>
        <?php foreach ($data['cust'] as $cust) : ?>
            <tr>
                <td><?= $cust['customer_name']; ?></td>
                <td><?= $cust['alamat1']; ?></td>
                <td><?= $cust['no_telp1']; ?></td>
                <td><?= $cust['email']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>