<?php

	class RelacionController
	{
		public function __construct(){}

		public function index(){
			//echo 'index desde UsuarioController';
			$relaciones=Relacion::all();
			require_once('Views/Relacion/index.php');
		}

		public function register(){
			require_once('Views/Relacion/register.php');
		}

		//guardar
		public function save($relacion){
			Relacion::save($relacion);
			header('Location: ../index.php');
		}

		public function update($relacion){
			Relacion::update($relacion);
			header('Location: ../index.php');
		}

		public function delete($id){
			//se está de dentro del directorio Controllers y se debe salir con ../
			require_once('../Models/relacion.php');
			Relacion::delete($id);
			header('Location: ../index.php');
		}

		public function error(){
			require_once('Views/Relacion/error.php');
		}
	}


	//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
	if (isset($_POST['action'])) {
		$relacionController= new RelacionController();
		//se añade el archivo usuario.php
		require_once('../Models/relacion.php');

		//se añade el archivo para la conexion
		require_once('../Config/connection.php');

		if ($_POST['action']=='register') {
			$relacion= new Relacion($_POST['id_pedido'],$_POST['codingre'],$_POST['fecha_pedido'],$_POST['hora_pedido'],$_POST['num_prod'],$_POST['estado_prod']);
			$relacionController->save($relacion);

		}elseif ($_POST['action']=='update') {
			$relacion= new Relacion($_POST['id_pedido'],$_POST['codingre'],$_POST['fecha_pedido'],$_POST['hora_pedido'],$_POST['num_prod'],$_POST['estado_prod']);
			$relacionController->update($relacion);
			
		}elseif($_POST['action']=='updateRelation'){
			require_once('../Models/relacion.php');
			Relacion::updateProductsOrder($_POST['id_pedido'],$_POST['modificados']);
			
						header('Location: ../?controller=producto&action=search_prod');						
					    // header('Location: ../?controller=producto&action=search_prodBarra');
		
		}elseif($_POST['action']=='updateRelationBarra'){
			require_once('../Models/relacion.php');
			Relacion::updateProductsOrder($_POST['id_pedido'],$_POST['modificados']);
			
						header('Location: ../?controller=producto&action=search_prodBarra');						
					    // header('Location: ../?controller=producto&action=search_prodBarra');
		}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index') {
			require_once('../connection.php');
			$relacionController=new RelacionController();
			//para eliminar
			if ($_GET['action']=='delete') {
				$relacionController->delete($_GET['id']);
			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/relacion.php');
				$relacion=Relacion::getById($_GET['id']);
				//var_dump($usuario);
				//$usuarioController->update();
				require_once('../Views/Relacion/update.php');
			}
		}
	}
?>
