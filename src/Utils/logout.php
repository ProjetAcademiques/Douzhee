<?php
require_once('pdo.php');
unset($_SESSION['user_id']);
header("Location: index.php");
exit();
?>