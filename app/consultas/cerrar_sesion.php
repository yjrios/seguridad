<?php  
   session_start();
   session_destroy();
   echo 'Cerraste Sesion';
   echo '<script> window.location ="../login.php";</script>';   
  ?> 