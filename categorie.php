<?php
  $page_title = 'Lista de categorías';
  require_once('includes/load.php');
  
  // Verificar que nivel de usuario tiene permiso de ver esta página.
  page_require_level(1);
  
  $all_categories = find_all('categories');

  if(isset($_POST['add_cat'])){
    $req_field = array('categorie-name');
    validate_fields($req_field);
    $cat_name = remove_junk($db->escape($_POST['categorie-name']));
    if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Categoría agregada exitosamente.");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Lo siento, registro fallido");
        redirect('categorie.php',false);
      }
    }else{
      $session->msg("d", $errors);
      redirect('categorie.php',false);
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar categoría</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="categorie.php">
          <div class="form-group">
            <input type="text" class="form-control" name="categorie-name" placeholder="Nombre de la categoría" required>
          </div>
          <button type="submit" name="add_cat" class="btn btn-primary">AGREGAR CATEGORÍA</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de categorías</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center">Descripción</th>
                <th class="text-center" style="width: 100px;">Acciones</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($all_categories as $cat):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                      <span class="glyphicon glyphicon-edit" style="padding: 5px 0 7px 5px;"></span>
                    </a>
                    <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
</div>

<?php include_once('layouts/footer.php'); ?>