<?php
session_start();
require 'database.php'; 
$message = NULL;
$user = NULL;
if (!empty($_POST['number'])) { 
  $records = $conn->prepare('SELECT  documento, nombre_asociado FROM usuarios WHERE documento=:number'); 
  $records->bindParam(':number', $_POST['number']); 
  $records->execute();  
  $results = $records->fetch(PDO::FETCH_ASSOC);


  if (($_POST['number']) == $results['documento']) {
	$_SESSION['user_documento'] = $results['documento'];
	$user = $results['nombre_asociado'];
    $message1 = 'Hola ' .$user. ", ingresa por favor tu correo electronico para enviarte tu ¡CUPON!";
    // header("Location: singUpCC.php"); //redirecciona
	// $recordsa = $conn->prepare('SELECT * FROM codigossmartfit WHERE documento=:documento'); 
	// $recordsa->bindParam(':documento', $results['documento']); 
	// $recordsa->execute();  
	// $resultsa = $recordsa->fetch(PDO::FETCH_ASSOC);

	// $offset=5*60*60; //converting 5 hours to seconds.
	// $dateFormat="Y-m-d H:i:s";
	// $timeNdate=gmdate($dateFormat, time()-$offset); //GMT-5

	// $date1 = $resultsa['fechaRedime'];
	// $date2 = $timeNdate;

	// $diff = $date1->diff($date2);

	// if($resultsa['fechaRedime'])


  } 
  else {
    $message = 'Su numero de identificacion no esta registrada en nuestra base de datos';
  }
}

?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Coomeva Cupon</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1,maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="index.css">
		<link rel="stylesheet" href="conditions.css">
    </head>

    <header>
	
	<div class="contenedor">
			<h1>Coomeva Cupon</h1>
				<form action="index.php" method="post" id="formulario" >

				<div class="formulario__grupo" id="grupo__number">
					<div class="formulario__grupo-input">
						<input type="number" id="usuario" class="formulario__input" name="number" placeholder="Ingresa numero cedula" >
						<i class="formulario__validacion-estado fas fa-times-circle"></i>
					</div>
					<p class="formulario__input-error">El numero de cedula solo debe contener numeros y minimo de 4 digitos</p>
				</div>

					<input type="submit" id="into1" value="Send" >
			</form> 
			
			<div class="formulario__grupo" id="grupo__condiciones">
					<input type="checkbox" id="condiciones" name ="condiciones"  >
					<button  id="conditions">Terminos y condiciones</button> 
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				<p class="formulario__input-error">Debe aceptar terminos y condiciones</p>
			</div>
			
			<div>
				<div id="modal_container" class="modal-container">
					<div class="modal">
						<h2>Es una prueba de Acepto Condiciones</h2>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque assumenda dignissimos illo explicabo natus quia repellat, praesentium voluptatibus harum ipsam dolorem cumque labore sunt dicta consectetur, nesciunt maiores delectus maxime?
						</p>
						<button id="close">Cerrar</button>
					</div>
				</div>
			</div>

			<?php if(!empty($user)) : ?> 
				<div>
				<di id="modal_container2"  class="modal-container2 show2">
					<div class="modal2">
						<?php if(!empty($message1)) : ?> 
							<p class="message"><?=$message1?></p>
						<?php endif; ?>
							<button id="close2">Cerrar</button>
					</div>
				</di>
				</div>
			<?php endif; ?>

			<?php if(isset($message)) : ?> 

				<div>
				<di id="modal_container3"  class="modal-container3 show3">
					<div class="modal3">
						<?php if(!empty($message )) : ?> 
							<p class="message"><?=$message ?></p>
						<?php endif; ?>
							<button id="close3">Cerrar</button>
					</div>
				</di>
				</div>
			<?php endif; ?>

		</div>
		<script src="js.js"></script>
		<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	</header> 
</html>



			