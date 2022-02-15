<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Petty Cash</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/PettyCash/addPage">Tambah data </a>

        <!-- <form action="<?= BASEURL; ?>/PettyCash/cari" style="max-width:350px;display:flex;justify-content:center;align-items:center;" method="post">
            <input type="text" placeholder="Cari PettyCash.." name="keyword" id="keyword" autocomplete="off">
            <button type="submit" style="max-width:100px;height:40px;margin-left:5px" id="tombolCari">Search</button>
        </form> -->

        <table id ="tabledetail">
            <thead class ="thead-dark">
                <tr>
                    <th>Penggunaan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['petty'] as $petty) : ?>
                    <tr>
                        <td>
                            <?= $petty['name']; ?>
                        </td>
                        <td>
                            <?= $petty['petty_date']; ?>
                        </td>
                        <td>
                        <?= number_format($petty['price'], 2); ?>
                        </td>
                        <td>
                            <a href="<?= BASEURL; ?>/PettyCash/hapus/<?= $petty['petty_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                        </td>
                        

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>