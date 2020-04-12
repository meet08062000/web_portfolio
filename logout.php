<?php
   session_start();
   unset($_SESSION['valid']);
   unset($_SESSION['email']);
   unset($_SESSION['password']);
   session_destroy();
   mysqli_close($db);
   header('Location: login.php');
?>