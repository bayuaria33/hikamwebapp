<div class="div-center">
    <div class="content">
        <h2>Ganti Password <?= $data['user']['username']; ?></h2>
        <div class="form-group">
            <form action="<?= BASEURL; ?>/Users/edit/" method="post" onSubmit="return validatePassword()">


                <label class="hidden" for="id">Id User</label>
                <input class="form-control" class="hidden" type="hidden" id="id" name="id" autocomplete="off" value="<?= $data['user']['id']; ?>">

                <label for="username">Username</label>
                <input class="form-control" disable type="text" id="username" name="username" autocomplete="off" value="<?= $data['user']['username']; ?>">

                <label for="currentPassword">Current Password</label>
                <input class="form-control" type="text" id="currentPassword" name="currentPassword" autocomplete="off">

                <label for="newPassword">New Password</label>
                <input class="form-control" type="text" id="newPassword" name="newPassword" autocomplete="off">

                <label for="confirmPassword">Confirm new Password</label>
                <input class="form-control" type="text" id="confirmPassword" name="confirmPassword" autocomplete="off">


                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</div>