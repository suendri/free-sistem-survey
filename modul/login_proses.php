<?php 

$login = new Login();

if (isset($_POST['prclogin'])) {

    $login->proses();
    header("location:" . URL);
}

header("location:" . URL);
