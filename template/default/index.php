<?php
defined("BASE_PATH") OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$data['title']?></title>
  <?php include_once "template/default/style.php" ?>
  <link rel="shortcut icon" href="<?=base_url()?>assets/logo/circle-cropped.png" type="image/x-icon">

  <script>
  window.onbeforeunload = function() {
    window.scrollTo(0, 0);
  }
  </script>
</head>

<body>
  <div id="content"><?=$data['content']?></div>
</body>

</html>