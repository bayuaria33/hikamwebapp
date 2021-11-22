<div class="div-center">
    <div class="content">
        <h2>Sign in</h2>
        <div class="form-group">
            <form action="<?php echo BASEURL; ?>/users/login" method="POST">
                <label for="username">Username</label>
                <input type="text" placeholder="Username *" name="username" class="form-control">
                <span class="invalidFeedback">
                    <?php echo $data['usernameError']; ?>
                </span>
                <br>
                <label for="password">Password</label>
                <input type="password" placeholder="Password *" name="password" class="form-control">
                <span class="invalidFeedback">
                    <?php echo $data['passwordError']; ?>
                </span>
                <br>
                <button id="submit" type="submit" value="submit" class="btn button-primary">Submit</button>

                <!-- <p class="options">Not registered yet? <a href="<?php echo BASEURL; ?>/users/register">Create an account!</a></p> -->
            </form>
        </div>
    </div>
</div>