<?php

class Producto
{

	public $codingre;
	public $descrip;
	public $familia;
	public $unidad;
	public $empaque;
	public $equivale;
	public $inventa1;
	public $stockmax;
	public $stockmin;
	public $ultcosto;
	public $costoprome;
	public $impuesto;
	public $pedido;
	public $status;
	public $inventaFisico;
	public $diferencia;
	// public $inventaFisico;
	// public $diferencia;
	function __construct($codingre, $descrip, $familia, $unidad, $empaque, $equivale, $inventa1,$stockmax, $stockmin, $ultcosto, $costoprome, $impuesto, $pedido, $status,$inventaFisico,$diferencia){

		$this->codingre=$codingre;
		$this->descrip=$descrip;
		$this->familia=$familia;
		$this->unidad=$unidad;
		$this->empaque=$empaque;
		$this->equivale=$equivale;
		$this->inventa1=$inventa1;
		$this->stockmax=$stockmax;
		$this->stockmin=$stockmin;
		$this->ultcosto=$ultcosto;
		$this->costoprome=$costoprome;
		$this->impuesto=$impuesto;
		$this->pedido=$pedido;
		$this->status=$status;
		$this->inventaFisico=$inventaFisico;
		$this->diferencia=$diferencia;
		// $this->inventaFisico=$inventaFisico;
		// $this->diferencia=$diferencia;
	}

	public static function all(){

		$listaProductos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM productos');
		foreach ($sql->fetchAll() as $producto) {
			$listaProductos[]= new Producto($producto['codingre'],$producto['descrip'], $producto['familia'],
											$producto['unidad'],$producto['empaque'],$producto['equivale'],
											$producto['inventa1'],$producto['stockmax'],$producto['stockmin'],
											$producto['ultcosto'],$producto['costoprome'],$producto['impuesto'],
											$producto['pedido'],$producto['status'],$producto['inventaFisico'],
										  $producto['diferencia']);
		}
		return $listaProductos;
	}


	public static function save($producto){

			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO productos
			     				VALUES(:codingre,:descrip,:familia,
			     							:unidad,:empaque,:equivale,
			     							:inventa1,:stockmax,:stockmin,
			     							:ultcosto,:costoprome,:impuesto,
			     							:pedido,:status)');
			$insert->bindValue('codingre',$producto->codingre);
			$insert->bindValue('descrip',$producto->descrip);
			$insert->bindValue('familia',$producto->familia);
			$insert->bindValue('unidad',$producto->unidad);
			$insert->bindValue('empaque',$producto->empaque);
			$insert->bindValue('equivale',$producto->equivale);
			$insert->bindValue('inventa1',$producto->inventa1);
			$insert->bindValue('stockmax',$producto->stockmax);
			$insert->bindValue('stockmin',$producto->stockmin);
			$insert->bindValue('ultcosto',$producto->ultcosto);
			$insert->bindValue('costoprome',$producto->costoprome);
			$insert->bindValue('impuesto',$producto->impuesto);
			$insert->bindValue('pedido',$producto->pedido);
			$insert->bindValue('status',$producto->status);
			// $insert->bindValue('status',$producto->inventaFisico);
			// $insert->bindValue('status',$producto->diferencia);

			$insert->execute();
		}

public static function saveInventaFisico($codingre,$modificados){

				if(!empty($modificados)){
					$lista_productos=[];
					$lista_existencia=[];
					$datos_modificados = explode(" ",$_POST['modificados']);
							for($i=0; $i< count($datos_modificados)-1; $i++){
								$id_and_existencia=explode(':',$datos_modificados[$i]);
								$lista_productos[]=$id_and_existencia[0];
								$lista_existencia[]=$id_and_existencia[1];
							}

				    for($i=0; $i<count($lista_productos); $i++){
						$db=Db::getConnect();
				    $update=$db->prepare('INSERT productos (inventaFisico) VALUES inventaFisico=:inventa1
				    											WHERE codingre=:codingre');

				    $update->bindValue('codingre',$codingre);
				    $update->bindValue('codingre',$lista_productos[$i]);
				    $update->bindValue('inventa1',$lista_existencia[$i]);
				    // $update->bindValue('hora_pedido',$relacion->hora_pedido);
				    // $update->bindValue('num_prod',$lista_cantidad[$i]);
				    // $update->bindValue('estado_prod',$relacion->estado_prod);
				    $update->execute();
				    // echo "Me ejecuto con normalidad";
						}
					}
				}
    //public $inventaFisico = isset($_POST["existencia"]);
		// public static function saveInventaFisico($producto){
		// 		$db=Db::getConnect();
		// 		$insert=$db->prepare('INSERT INTO productos (inventaFisico) VALUES (:inventaFisico)');
		// 		$insert->bindValue('inventaFisico',$producto->inventaFisico);
		// 		$insert->execute();
		// 	}

	//la función para actualizar
	public static function update($producto){

		$db=Db::getConnect();
		$update=$db->prepare('UPDATE productos
							SET descrip=:descrip, familia=:familia, unidad=:unidad,
										empaque=:empaque, equivale=:equivale, inventa1=:inventa1,
									stockmax=:stockmax,stockmin=:stockmin,ultcosto=:ultcosto,
									costoprome=:costoprome,impuesto=:impuesto,pedido=:pedido,
									status=:status
							WHERE codingre=:codingre');
		$update->bindValue('codingre',$producto->codingre);
		$update->bindValue('descrip',$producto->descrip);
		$update->bindValue('familia',$producto->familia);
		$update->bindValue('unidad',$producto->unidad);
		$update->bindValue('empaque',$producto->empaque);
		$update->bindValue('equivale',$producto->equivale);
		$update->bindValue('inventa1',$producto->inventa1);
		$update->bindValue('stockmax',$producto->stockmax);
		$update->bindValue('stockmin',$producto->stockmin);
		$update->bindValue('ultcosto',$producto->ultcosto);
		$update->bindValue('costoprome',$producto->costoprome);
		$update->bindValue('impuesto',$producto->impuesto);
		$update->bindValue('pedido',$producto->pedido);
		$update->bindValue('status',$producto->status);
		$update->execute();
	}
	public static function updateExistencia($producto){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE productos
							SET inventa1=:inventa1
							WHERE codingre=:codingre');
		$update->bindValue('inventa1',$producto->inventa1);
		$update->execute();
	}
	// la función para eliminar por el id
	public static function delete($codingre){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM productos WHERE codingre=:codingre');
		$delete->bindValue('codingre',$codingre);
		$delete->execute();
	}
	//la función para obtener un producto por el id
	public static function getById($codingre){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM productos WHERE codingre=:codingre');
		$select->bindValue('codingre',$codingre);
		$select->execute();
		$productoDb=$select->fetch();
		$producto= new Producto($productoDb['codingre'],$productoDb['descrip'], $productoDb['familia'],
								$productoDb['unidad'],$productoDb['empaque'],$productoDb['equivale'],
				  				$productoDb['inventa1'],$productoDb['stockmax'],$productoDb['stockmin'],
								$productoDb['ultcosto'],$productoDb['costoprome'],$productoDb['impuesto'],
								$productoDb['pedido'],$productoDb['status']);
		return $producto;
	}

	public static function getByIdExistencia($codingre){
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM productos WHERE codingre=:codingre');
		$select->bindValue('codingre',$codingre);
		$select->execute();
		$productoDb=$select->fetch();
		$producto=new Producto($productoDb['inventa1']);
		return $producto;
	}

	//la función para obtener un producto por el id
	public static function getByFam($familia){

		$listaProductos =[];
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM productos WHERE familia=:familia');
		$select->bindValue('familia',$familia);
		$select->execute();
		foreach($select->fetchAll() as $productoDb)
		$productos[]= new Producto($productoDb['codingre'],$productoDb['descrip'], $productoDb['familia'],
									$productoDb['unidad'],$productoDb['empaque'],$productoDb['equivale'],
					  				$productoDb['inventa1'],$productoDb['stockmax'],$productoDb['stockmin'],
									$productoDb['ultcosto'],$productoDb['costoprome'],$productoDb['impuesto'],
									$productoDb['pedido'],$productoDb['status'],$productoDb['inventaFisico'],
									$productoDb['diferencia']);
		return $productos;
	}
}
?>
