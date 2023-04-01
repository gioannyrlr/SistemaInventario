<?php
  require_once('includes/load.php');
  
  // Verificar que nivel de usuario tiene permiso de ver esta página.
  page_require_level(1);

  $delete_id = delete_by_id('users',(int)$_GET['id']);
  if($delete_id){
    $session->msg("s","Usuario eliminado");
    redirect('users.php');
  }else{
    $session->msg("d","Eliminación fallida.");
    redirect('users.php');
  }
?>