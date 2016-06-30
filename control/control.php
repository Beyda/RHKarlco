 
 <?php
session_start(); //Inicia session

$_POST['login']; //Variables recibidas login
$_POST['pass']; //Variables recibidas login 

if (isset($_POST['login'])){       //Verica si existe  la variable recibida Login
		$login= $_POST['login'];   //Guardamos la variable recibida en una variable Login
		$contrasena= md5($_POST['pass']);  //Guardamos la variable recibida en una variable contraseña y al mismo tiempo la convertimos en encriptada a md5
		include_once("connect.php");  //librerias para conneccion a la base de datos

		$query1="SELECT * FROM  `tipo_usuario` ,  `usuarios` WHERE  `usuarios`.`usuario` =  '$login'AND  `usuarios`.`pass` =  '$contrasena' AND  `usuarios`.`id_tipous` =  `tipo_usuario`.`id_tipous`"; //query sql para comparar las variables recibidas con las existentes en la base datos
		$resultado = $mysqli->query($query1) or die ($mysqli->error); //ejecuta el query y se guarda en una variable resultado en caso contrario muestra el error MYSQL
		$fila=$resultado->fetch_assoc();
		$filas = $resultado->num_rows; //Verifica que solamente exista una persona arrojando un 1 o 0
	
if ($filas==1){	 // verifica que el la variable filas tenga un valor 1
		$_SESSION["id_usuario_session"]=$fila['id_usuario'];//Guarda en session lo que este en la base de datos en la columna id_usuario
		$_SESSION["id_tipo_usuario"]=$fila['id_tipous'];
		$_SESSION["id_datosper"]=$fila['id_datosper']; //Guarda en session lo que este en la base de datos en la columna nombre
		//$_SESSION["apellidos_session"]=$fila['apellidos'];
		$_SESSION["login_session"]=$fila['usuario']; //Guarda en session lo que este en la base de datos en la columna usuario
		$_SESSION["t_usuario_session"]=$fila['nombre'];//Guarda en session lo que este en la base de datos en la columna tipo_usuario
		//$_SESSION["avatar_session"]=$fila['avatar'];
		header("location: /rhkarlco/index.php");//redirecciona al inicio con las sessiones guardadas
	}	
	else { // en caso de que no exista 
		$var=$_POST['login'];	
		header("location: /rhkarlco/404.php?error=1&var=$var"); //redirecciona al inicio con las variables invalidas
		}
		} 
		else{

		$login=" "; //define las variables en vacio 
		$contrasena= " "; //define las variables en vacio 
		header("location: /rhkarlco/404.php?error=1&var=$var"); //redirecciona al inicio con las variables invalidas


		}

?>


  