<?php
  session_start();
  session_destroy();
  header("Location: index.php");   //redirect your page to Index page
?>