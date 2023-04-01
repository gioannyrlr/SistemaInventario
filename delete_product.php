<?php
  require_once('includes/load.php');
  
  // Verificar que nivel de usuario tiene permiso de ver esta página.
  page_require_level(2);

  $product = find_by_id('products',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","ID vacío");
    redirect('product.php');
  }

  $delete_id = delete_by_id('products',(int)$product['id']);
  if($delete_id){
    $session->msg("s","Producto eliminado.");
    redirect('product.php');
  }else{
    $session->msg("d","Eliminación fallida.");
    redirect('product.php');
  }
?>