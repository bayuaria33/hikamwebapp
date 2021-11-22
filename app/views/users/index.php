<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1>Daftar Users</h1>
        <br>

        <a class="editButton" href="<?= BASEURL; ?>/Customer/addPage">Tambah data </a>

        <table id="tabledetail">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Level User</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($data['user'] as $cust) : ?>
                    <tr>
                        <td>
                            <?= $cust['username']; ?>
                        </td>
                        <td>
                            <?= $cust['level_user']; ?>
                        </td>
                        <td>
                            <a href="<?= BASEURL; ?>/Users/gantiPass/<?= $cust['id']; ?>" class="detailButton" style="float:right">Ganti Password</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>