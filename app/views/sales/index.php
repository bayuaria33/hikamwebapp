<div class="container-fluid">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Sales</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Sales/addPage">Tambah data </a>

        <table id="tabledetail">
            <thead>
                <tr>
                    <th class="datetime">Sales Date</th>
                    <th>Nama Customer</th>
                    <th>Nama Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($data['sales'] as $sales) : ?>
                    <tr>
                        <td>
                            <?= $sales['sales_date']; ?>
                        </td>
                        <td>
                            <?= $sales['customer_name'] ?>
                        </td>
                        <td>
                            <?= $sales['product_name'] ?>
                        </td>
                        <td>
                            <?= $sales['quantity']; ?>
                        </td>
                        <td>
                            <?= number_format($sales['price'], 2); ?>
                        </td>
                        <td>

                            <a href="<?= BASEURL; ?>/Sales/hapus/<?= $sales['sales_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                            <a href="<?= BASEURL; ?>/Sales/editPage/<?= $sales['sales_id']; ?>" class="editButton" style="float:right">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>