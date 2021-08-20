<?php
    // error_reporting(0);
    session_start();
    require 'database.php';

    $resp = NULL;
    $message = NULL;
    $correo = $_POST['email'];
    $documento = $_SESSION['user_documento'];

    if (!empty($_POST['email'])) {
    $data = [
        'correo' => $correo,
        'documento' => $documento,
    ];
    $sql = "UPDATE usuarios SET emailUsuario=:correo WHERE documento=:documento";
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);

    if($stmt->execute($data)){

        $stmtc = $conn->prepare("SELECT *  FROM codigossmartfit WHERE idUsuario IS NULL limit 1;");
        $stmtc->execute();
        $userc = $stmtc->fetch(PDO::FETCH_ASSOC);
        $respid = $userc['id'];
        $respcodigo = $userc['codigo'];

        if($stmtc->execute()){
            $datab = [
                'documento' => $documento,
                'respid' => $respid
            ];
            $sql = "UPDATE codigossmartfit SET idUsuario=:documento WHERE id=:respid";
            $stmt= $conn->prepare($sql);
            $stmt->execute($datab);

        } 
        if($stmt->execute($datab)){
            $records = $conn->prepare("SELECT * FROM codigossmartfit WHERE idUsuario=:documento"); 
            $records->bindParam(':documento', $documento); 
            $records->execute();  
            $results = $records->fetch(PDO::FETCH_ASSOC);
            $codigoresp = $results['codigo'];
            $message = "Le enviaremos el siguiente codigo ". $codigoresp . " a su correo electronico " .$correo;

            $offset=5*60*60; //converting 5 hours to seconds.
            $dateFormat="Y-m-d H:i:s";
            $timeNdate=gmdate($dateFormat, time()-$offset); //GMT-5
            echo $timeNdate;

            $datac = [
                'timeNdate' => $timeNdate,
                'documento' => $documento
            ];
            $sql = "UPDATE codigossmartfit SET fechaRedime=:timeNdate WHERE idUsuario=:documento";
            $stmt= $conn->prepare($sql);
            $stmt->execute($datac);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Coomeva Cupon</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1,maximum-scale=1, minimum-scale=1">
		<link rel="stylesheet" href="SingUpCC.css">
		<link rel="stylesheet" href="conditions.css">
    </head>

    <header>
	<div class="contenedor">

			<h1>Coomeva Cupon</h1>
				<form action="singUpCC.php" method="post" id="formulario" >
                    <div class="formulario__grupo" id="grupo__email">
                        <div class="formulario__grupo-input">
                            <input type="email" id="password1"  class="formulario__input" name="email" placeholder="Ingresa tu email" >
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">El correo deber contener siguiente estructura:  example@outlook.com .</p>
                    </div>

					<input type="submit" id="into1" value="Send" >
			</form>
		</div>
            
        <?php if(isset($message)) : ?> 
				<div id="modal_container3"  class="modal-container3 show3">
					<div class="modal3">
						<?php if(!empty($message )) : ?> 
							<p class="message"><?=$message ?></p>
						<?php endif; ?>
							<button id="close3">Cerrar</button>
					</div>
				</div>
			<?php endif; ?>
        
		<script src="jsSingUpCC.js"></script>
		<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	</header>
</html>


