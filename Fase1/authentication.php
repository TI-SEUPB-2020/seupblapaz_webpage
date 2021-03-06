<?php
session_start();
unset($_SESSION['idCode']);
unset($_SESSION['id_school']);
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

include 'db_connection.php';
$message = '';

if (!empty($_POST['idCode']) && !empty($_POST['ci'])) {
  $idCode = $_POST['idCode'];
  $ci = $_POST['ci'];

  $query = "SELECT * from registered_students where code='$idCode' and voted='0' and ci='$ci';";
  $consulta = mysqli_query($db_connection, $query);
  $results = mysqli_fetch_array($consulta);
  $count = mysqli_num_rows($consulta);
  $message = $count;
  if ($count == 1) {
    $_SESSION['idCode'] = $idCode;
    $_SESSION['id_school'] = $results['id_school'];

    header('location: vote.php');
  } else {
    $message = 'La información es incorrecta o el usuario ya votó';
  }

} else if (!empty($_POST['idCode']) || !empty($_POST['ci'])) {
  $message = 'Datos incompletos';
}

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#9932cc" />
    <title>Verificación</title>
    <link rel="icon" type="image/png" href="res/favicon.png">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
		body {
			background-image: url('res/authentication.jpg');
			background-position: center center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
			background-color: #464646;
		}
		.center_div{
		    margin: 0 auto;
		    width:80%;
		    height: auto;
		    background-color: #8906FF;
		    padding: 20px;
		    border-radius: 10px;
		}
		label {
		    cursor: pointer;
		    color: #ffffff;
		    display: block;
		    padding: 5px;
		    margin: 3px;
		}
		.center {
		  display: block;
		  margin-left: auto;
		  margin-right: auto;
		  width: 50%;
		  height: auto;
		}
    </style>
  </head>
  <body>
    <div class="overlay bg-rgba-black-light text-white flex-center">
	    <div class="container">
	    	<img src="res/logo.png" class="center">
	    </div>
	    <div class="container">
	    	<img src="res/titulo.png" class="center" style="margin-bottom: 10%;">
	    </div>
	    <div class="container center_div">
		    <form action="authentication.php" method="post">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Código</label>
			    <input type="text" class="form-control" name="idCode" placeholder="Ingresa tu código">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Carnet de Identidad</label>
			    <input type="text" class="form-control" name="ci" placeholder="Ingresa tu CI">
			  </div>
			  <input type="submit" class="btn btn-warning" value="Verificar"></input><br><br>
			  <p>¿Tienes problemas iniciando sesión? - Contáctate con nosotros al 78898825 o 72581793
			</form>
				<?php
		    		if (!empty($message)) {
		      			echo "<div class='alert alert-danger' role='alert'>$message</div>";
		       		}
		    	?>
		</div>
	</div>
  </body>
</html>
