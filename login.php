<!doctype html>
<html lang="en">
<head>
  <title><?php echo JUDUL; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem Informasi Kuesioner">
  <meta name="author" content="Suendri">

  <link rel="shortcut icon"href="<?php echo URL; ?>asset/images/favicon.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link href="<?php echo URL; ?>asset/css/style.css" rel="stylesheet">

</head>

<body class="text-center">
  <?php 

  if (!isset($_GET['hal'])) {
    include "modul/login.php";
  } else {    
    include "modul/login_proses.php";
  }

  ?>

</body>
</html>
