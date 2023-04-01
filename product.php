<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  
  // Verificar que nivel de usuario tiene permiso de ver esta página.
  page_require_level(2);
  $products = join_product_table();
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Productos</span>
        </strong>
      <div class="pull-right">
        <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
      </div>
    </div>
    <div class="panel-body">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th class="text-center" style="width: 25%;"> Descripción </th>
            <th class="text-center" style="width: 15%;"> Categoría </th>
            <th class="text-center" style="width: 8%;"> Stock </th>
            <th class="text-center" style="width: 11%;"> Precio compra </th>
            <th class="text-center" style="width: 10%;"> Precio venta </th>
            <th class="text-center" style="width: 17%;"> Agregado </th>
            <th class="text-center" style="width: 100px;"> Acciones </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product):?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <td> <?php echo remove_junk($product['name']); ?></td>
              <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
              <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
              <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
              <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
              <td class="text-center"> <?php echo read_date($product['date']); ?></td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-edit" style="padding: 5px 0 7px 5px;"></span>
                  </a>
                  <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-trash" style="padding: 5px 5px 7px 0;"></span>
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<?php include_once('layouts/footer.php'); ?>