<?php

	class PedidoController
	{
		public function __construct(){}

		public function index(){
			//echo 'index desde UsuarioController';

			$pedidos=Pedido::all();
			require_once('Views/Pedido/index.php');
		}

		public function register(){
			require_once('Views/Pedido/register.php');
		}

		//guardar
		public function save($pedido){
			Pedido::save($pedido);
			header('Location: ../index.php?controller=pedido&action=register');
		}

		public function update($pedido){
			Pedido::update($pedido);
			header('Location: ../index.php?controller=pedido&action=index');
		}

		public function delete($id){
			//se está de dentro del directorio Controllers y se debe salir con ../
			require_once('../Models/pedido.php');
			Pedido::delete($id);
			header('Location: ../index.php?controller=pedido&action=index');
		}

		public function error(){
			require_once('Views/Pedido/error.php');
		}
	}


	//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
	if (isset($_POST['action'])) {
		$pedidoController= new PedidoController();
		//se añade el archivo usuario.php
		require_once('../Models/pedido.php');

		//se añade el archivo para la conexion
		require_once('../connection.php');

		if ($_POST['action']=='register') {
			$pedido= new Pedido(NULL,$_POST['fecha'],$_POST['hora'],$_POST['autoriza'],
															 $_POST['solicita'],$_POST['estado'],$_POST['observaciones'],
															 $_POST['unidad_medida'],$_POST['total_prod'],$_POST['costo_total']);
			$pedidoController->save($pedido);
		}elseif ($_POST['action']=='update') {
			$pedido= new Pedido($_POST['id_pedido'],$_POST['fecha'],$_POST['hora'],
													$_POST['autoriza'],$_POST['solicita'],$_POST['estado'],
													$_POST['observaciones'],$_POST['unidad_medida'],$_POST['total_prod'],
													$_POST['costo_total']);
			$pedidoController->update($pedido);
		}
	}

	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index') {
			require_once('../connection.php');
			$pedidoController=new PedidoController();
			//para eliminar
			if ($_GET['action']=='delete') {
				$pedidoController->delete($_GET['id_pedido']);
			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/pedido.php');
				$pedido=Pedido::getById($_GET['id_pedido']);
				//var_dump($usuario);
				//$usuarioController->update();
				require_once('../Views/Pedido/update.php');
			}elseif($_GET['action']=='order'){
				require_once('../Models/pedido.php');
				$select=Pedido::getOrderById($_GET['id_pedido']);
			  // $pedidoController->getOrderById($_GET['id_pedido']);
				require_once('../Views/Pedido/order_prod.php');
			}
		}
	}
?>
