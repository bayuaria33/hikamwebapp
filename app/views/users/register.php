<div class="div-center">
    <div class="content">
        <h2>Register</h2>
        <div class="form-group">
            <form id="register-form" method="POST" action="<?php echo BASEURL; ?>/users/register">
                <input type="text" placeholder="Username *" name="username" class="form-control">
                <span class="invalidFeedback">
                    <?php echo $data['usernameError']; ?>
                </span>

                <input type="text" placeholder="Level User *" name="level_user" class="form-control">
                <span class="invalidFeedback">
                    <?php echo $data['level_userError']; ?>
                </span>

                <input type="password" placeholder="Password *" name="password" class="form-control">
                <span class="invalidFeedback">
                    <?php echo $data['passwordError']; ?>
                </span>

                <input type="password" placeholder="Confirm Password *" name="confirmPassword" class="form-control">
                <span class="invalidFeedback">
                    <?php echo $data['confirmPasswordError']; ?>
                </span>

                <button id="submit" type="submit" value="submit">Submit</button>

                <p class="options">Not registered yet? <a href="<?php echo BASEURL; ?>/users/register">Create an account!</a></p>
            </form>
        </div>
    </div>
</div>