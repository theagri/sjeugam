<?php
require('sjeugam/bootstrap.php');
if(empty($_GET['route'])) {$_GET['route'] = null;}
new SjeugamController($_GET['route']);
?>