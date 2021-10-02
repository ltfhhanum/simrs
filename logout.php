<?php
  session_start();
  session_destroy();// untuk 1 sesion pakai uset(nama sesion)
  header('location:index.php');
?>
