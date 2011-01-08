<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");

$sys->submit($_POST['rated'],$_POST['id']);