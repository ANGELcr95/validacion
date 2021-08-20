<?php
session_start();
require 'database.php'; // traigo la conexion dela base de datos

if (!empty($_POST['email']) && !empty($_POST['password'])) { // si las casilla de los input no estan vacias
  //sentencia sql
  $records = $conn->prepare('SELECT id, email, password  FROM users WHERE email=:email'); // slecciones los elementos de la tabla que requiera pra este caso users
  $records->bindParam(':email', $_POST['email']); //asigna valor dentro de nuestra consulta para que lo busque
  $records->execute(); // ejecuta 
  $results = $records->fetch(PDO::FETCH_ASSOC); // lo que hago es obtener los datos de este usuario si existe

  $message = '';

  if (count($results) &&  password_verify($_POST['password'], $results['password'])) { // si se cumple la condicion  hace el codigo dependiendo que coincida o no
    $_SESSION['user_id'] = $results['id']; // se hace con l aintension de exportar el dato del id a otras paginas
    $message = 'You have logged in';
    header("Location: index.php"); //redirecciona

    // die(); //este die sirve para no ejecutar lo de abajo y que el codigo quede ahi

   // AQUI ES DONDE DEBEMOS REDIRECCIONAR
  } 
  else {
    $message = 'Sorry, Those credentials do not match';
  }
}

   //Pagina para poder iniciar sesion 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Compras</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1,maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="https://fonts.google.com/">
        <link rel="stylesheet" href="./Styles/login.css">
    </head>
    
    <header>
      <div class="banner">
       <img src="./img/fondo_arentio_1.jpg" alt="Fondo de registro">
      </div> 
      <div class="contenedor">

      <?php if (!empty($message)) :?>
            <p class = "logeado"><?= $message ?></p>
          <?php endif?>

         <h1> Login</h1>
         <span><a href="index.php">Index</a> or <a href="singup.php">SingUp</a></span>
         <div class="general">  
         <div class="alterno">
            <form action="login.php" method="post">
              <input type="text" id="usuario" placeholder="Email" name="email">
              <input type="password" id="clave" placeholder="Password" name="password"> 
              <input type="submit" id="into" value="Login">
            </form>
          </div>
       </form>
    </header>
</html>
