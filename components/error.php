<?php
  defined("BASE_PATH") OR exit('No direct script access allowed');
  if (!isset($title) OR !isset($message)) {
    exit("No direct script access allowed");
  }
?>
<div style="text-align: center;">
  <h1 style="color: red"><?=$title?></h1>
  <div><?=$message?></div>
</div>