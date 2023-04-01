<?php
  require_once('includes/load.php');
  
  // Verificar que nivel de usuario tiene permiso de ver esta página.
  page_require_level(1);

  $categorie = find_by_id('categories',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","ID de la categoría falta.");
    redirect('categorie.php');
  }

  $delete_id = delete_by_id('categories',(int)$categorie['id']);
  if($delete_id){
    $session->msg("s","Categoría eliminada.");
    redirect('categorie.php');
  }else{
    $session->msg("d","Eliminación fallida.");
    redirect('categorie.php');
  }
?>