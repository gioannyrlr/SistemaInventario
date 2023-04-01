<?php include_once('includes/load.php'); ?>

<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user = authenticate_v2($username, $password);
    if($user):
      // Crear session con id
      $session->login($user['id']);
      // Actualizar ultima conexion usuario.
      updateLastLogIn($user['id']);
      // Redirigir al inicio segun el nivel de usuario.
      if($user['user_level'] === '1'):
        $session->msg("s", "Hello ".$user['username']."");
        redirect('admin.php',false);
      elseif ($user['user_level'] === '2'):
        $session->msg("s", "Hello ".$user['username']."");
        redirect('special.php',false);
      else:
        $session->msg("s", "Hello ".$user['username']."");
        redirect('home.php',false);
      endif;
    else:
      $session->msg("d", "Sorry Username/Password incorrect.");
      redirect('index.php',false);
    endif;
}else{
    $session->msg("d", $errors);
    redirect('login_v2.php',false);
}
?>