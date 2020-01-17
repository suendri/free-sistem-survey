<?php 

if(!defined('gosoftware')) { header("location:/"); }

?>

<form class="form-signin" method="POST" action="<?php echo URL; ?>login">
    <img class="mb-4" src="<?php echo URL; ?>asset/images/uinsu-logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

    <label class="sr-only">Username</label>
    <input type="text" class="form-control" name="user_name" placeholder="Username" required autocomplete="off">
    <label class="sr-only">Password</label>
    <input type="password" class="form-control" name="user_password" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="prclogin">Sign in</button>
    <p class="mt-5 mb-3 text-muted">Sistem Informasi Kuesioner <br> SIKUE Beta3 &copy; 2018</p>
</form>