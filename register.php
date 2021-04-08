<?php require_once('header.php');

 ?>
    <main>
        <h1>Sign Up</h1>
        <p>Please fill this form to create an account.</p>
        <form action="save-registration.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" >
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <!-- Add the recaptcha field -->
          <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

<button class="btn" type="submit">Register</button>
<a class="btn" href="login.php">Login</a>
</form>
</section>
</div>

<!-- Add the recaptcha scripts -->
<?php include_once('config.php') ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
<script>
grecaptcha.ready(() => {
grecaptcha.execute("<?= SITEKEY ?>", { action: "register" })
.then(token => document.querySelector("#recaptchaResponse").value = token)
.catch(error => console.error(error));
});
</script>



            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </main>  
    <?php require_once('footer.php'); ?>  
