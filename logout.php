<?php
require "auth.php";

session_unset();   // Unset all session variables
session_destroy(); // Destroy the session
header("Location: index.php");
exit();
?>
