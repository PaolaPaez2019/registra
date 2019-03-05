		<?php

	class UsuarioController
	{
		public function __construct(){}

		public function index(){
			//echo 'index desde UsuarioController';

			$usuarios=Usuario::all();
			require_once('Views/Usuario/index.php');
		}


		public function register(){
			require_once('Views/Usuario/register.php');
		}

		//guardar
		public function save($usuario){
			Usuario::save($usuario);
			header('Location: ../index.php');
		}

		public function update($usuario){
			Usuario::update($usuario);
			header('Location: ../index.php');
		}

		public function delete($id){
			//se está de dentro del directorio Controllers y se debe salir con ../
			require_once('../Models/usuario.php');
			Usuario::delete($id);
			header('Location: ../index.php');
		}

		public function error(){
			require_once('Views/Usuario/error.php');
		}
	}


	//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
	if (isset($_POST['action'])) {
		$usuarioController= new UsuarioController();
		//se añade el archivo usuario.php
		require_once('../Models/usuario.php');

		//se añade el archivo para la conexion
		require_once('../Config/connection.php');

		if ($_POST['action']=='register') {
			$usuario= new Usuario(null,$_POST['username'],$_POST['password'],$_POST['cargo'],$_POST['nombre'],$_POST['email']);
			$usuarioController->save($usuario);

		}elseif ($_POST['action']=='update') {
			$usuario= new Usuario($_POST['id_user'],$_POST['username'],$_POST['password'],$_POST['cargo'],$_POST['nombre'],$_POST['email']);
			$usuarioController->update($usuario);

		}elseif($_POST['action']=='login'){
			$usuario=Usuario::login($_POST["usuario"]);
			if($usuario->email==$_POST["usuario"] && $usuario->password==$_POST["password"]){
			// header('Location: ../index.php');
		  session_start();
			$_SESSION["id_sesion"] = $usuario->cargo;
			$_SESSION["nombre"] = $usuario->nombre;
			if($_SESSION["id_sesion"] == "cocina"){
					header("Location: ../?controller=producto&action=search_prod");
			}elseif($_SESSION["id_sesion"] == "barra"){
					header("Location: ../?controller=producto&action=search_prodBarra");
			// header('Location: ../?controller=producto&action=search_prod');
			}else{
				 header('Location: ../Public/no_sesion.php');
			}
		}
	}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index'&$_GET['action']!='ver_pedido') {
			require_once('Config/connection.php');
			$usuarioController=new UsuarioController();
			//para eliminar

			if ($_GET['action']=='delete') {
				$usuarioController->delete($_GET['id']);

			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/usuario.php');
				$usuario=Usuario::getById($_GET['id']);
				//var_dump($usuario);
				//$usuarioController->update();
				require_once('../Views/Usuario/update.php');
			}
		}
	}
?>
