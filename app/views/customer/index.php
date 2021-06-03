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
                    <a href="<?= BASEURL; ?>/Customer/detail/<?= $cust['customer_id']; ?>" id="badgebutton" style="float:right">Detail</a>
                </td>

            </tr>
        <?php endforeach; ?>

        <!-- ------------------------------------------------------------- -->

    </table>
</div>