<?php
  require_once('includes/load.php');
  
  // Verificar que nivel de usuario tiene permiso de ver esta página.
  page_require_level(3);

  $d_sale = find_by_id('sales',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('sales.php');
  }

  $delete_id = delete_by_id('sales',(int)$d_sale['id']);
  if($delete_id){
    $session->msg("s","Venta eliminada.");
    redirect('sales.php');
  }else{
    $session->msg("d","Eliminación fallida.");
    redirect('sales.php');
  }
?>