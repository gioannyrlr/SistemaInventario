<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  
  // Verificar que nivel de usuario tiene permiso de ver esta página.
  page_require_level(3);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id','quantity','price','total', 'date' );
    validate_fields($req_fields);
    if(empty($errors)){
      $p_id      = $db->escape((int)$_POST['s_id']);
      $s_qty     = $db->escape((int)$_POST['quantity']);
      $s_total   = $db->escape($_POST['total']);
      $date      = $db->escape($_POST['date']);
      $s_date    = make_date();

      $sql  = "INSERT INTO sales (";
      $sql .= " product_id,qty,price,date";
      $sql .= ") VALUES (";
      $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
      $sql .= ")";

      if($db->query($sql)){
        update_product_qty($s_qty,$p_id);
        $session->msg('s',"Venta agregada. ");
        redirect('add_sale.php', false);
      } else {
        $session->msg('d','Registro fallido.');
        redirect('add_sale.php', false);
      }
    }else{
      $session->msg("d", $errors);
      redirect('add_sale.php',false);
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-4">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Agregar</button>
            </span>
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Editar venta</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
          <table class="table">
            <thead>
              <th class="text-center"> Producto </th>
              <th class="text-center"> Precio </th>
              <th class="text-center"> Cantidad </th>
              <th class="text-center"> Total </th>
              <th class="text-center"> Agregado</th>
              <th class="text-center"> Acciones</th>
            </thead>
            <tbody id="product_info"></tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>