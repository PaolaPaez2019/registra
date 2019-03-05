<?php
/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/
class Pedido
{
	//atributos
	public $id_pedido;
	public $fecha;
	public $hora;
	public $autoriza;
	public $solicita;
	public $estado;
	//public $no_prod;
	//public $id_prod;
	public $observaciones;
	public $unidad_medida;
	public $total_prod;
	public $costo_total;

	//constructor de la clase
	function __construct($id_pedido, $fecha, $hora, $autoriza, $solicita, $estado, $observaciones, $unidad_medida, $total_prod, $costo_total)
	{
		$this->id_pedido=$id_pedido;
		$this->fecha=$fecha;
		$this->hora=$hora;
		$this->autoriza=$autoriza;
		$this->solicita=$solicita;
		$this->estado=$estado;
		//$this->no_prod=$no_prod;
		//$this->id_prod=$id_prod;
		$this->observaciones=$observaciones;
		$this->unidad_medida=$unidad_medida;
		$this->total_prod=$total_prod;
		$this->costo_total=$costo_total;
	}

	//función para obtener todos los usuarios
	public static function all(){
		$listaPedidos =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM pedidos');

		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $pedido) {
			$listaPedidos[]= new Pedido($pedido['id_pedido'],$pedido['fecha'], $pedido['hora'],
																	$pedido['autoriza'],$pedido['solicita'],$pedido['estado'],
																	$pedido['observaciones'],$pedido['unidad_medida'],$pedido['total_prod'],
																	$pedido['costo_total']);
		}
		return $listaPedidos;
	}

	//la función para registrar un usuario
	public static function save($pedido){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO pedidos
														VALUES(NULL,:fecha,:hora,:autoriza,
																				:solicita,:estado,:observaciones,
																				:unidad_medida,:total_prod,:costo_total)');
			$insert->bindValue('fecha',$pedido->fecha);
			$insert->bindValue('hora',$pedido->hora);
			$insert->bindValue('autoriza',$pedido->autoriza);
			$insert->bindValue('solicita',$pedido->solicita);
			$insert->bindValue('estado',$pedido->estado);
			$insert->bindValue('observaciones',$pedido->observaciones);
			$insert->bindValue('unidad_medida',$pedido->unidad_medida);
			$insert->bindValue('total_prod',$pedido->total_prod);
			$insert->bindValue('costo_total',$pedido->costo_total);
			$insert->execute();
			$last_id=$db->lastInsertId();
			return $last_id;
		}

	//la función para actualizar
	public static function update($pedido){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE pedidos
													SET fecha=:fecha, hora=:hora, autoriza=:autoriza,
															solicita=:solicita, estado=:estado, observaciones=:observaciones,
															unidad_medida=:unidad_medida, total_prod=:total_prod, costo_total=:costo_total
												  WHERE id_pedido=:id_pedido');
		$update->bindValue('id_pedido',$pedido->id_pedido);
		$update->bindValue('fecha',$pedido->fecha);
		$update->bindValue('hora',$pedido->hora);
		$update->bindValue('autoriza',$pedido->autoriza);
		$update->bindValue('solicita',$pedido->solicita);
		$update->bindValue('estado',$pedido->estado);
		$update->bindValue('observaciones',$pedido->observaciones);
		$update->bindValue('unidad_medida',$pedido->unidad_medida);
		$update->bindValue('total_prod',$pedido->total_prod);
		$update->bindValue('costo_total',$pedido->costo_total);
		$update->execute();
	}

	// la función para eliminar por el id
	public static function delete($id){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM pedidos WHERE id_pedido=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

	//la función para obtener un usuario por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT * FROM pedidos WHERE id_pedido=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto usuario
		$pedidoDb=$select->fetch();
		$pedido= new Pedido($pedidoDb['id_pedido'],$pedidoDb['fecha'],$pedidoDb['hora'],
		$pedidoDb['autoriza'],$pedidoDb['solicita'],$pedidoDb['estado'],$pedidoDb['observaciones']
		,$pedidoDb['unidad_medida'],$pedidoDb['total_prod'],$pedidoDb['costo_total']);

		return $pedido;
	}

	public static function getOrderById($id){
		//buscar
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT pedidos.id_pedido,producto.id_prod,pedidos.fecha, producto.descripcion
													FROM pedidos
													RIGHT OUTER JOIN pedido_producto ON pedidos.id_pedido = pedido_producto.id_pedido
													RIGHT OUTER JOIN producto ON pedido_producto.id_prod = producto.id_prod
													WHERE pedidos.id_pedido = :id');
		$select->bindValue('id',$id);
		$select->execute();

		return $select;
	  }

	public static function get_id($conn){
		$conn->lastInsertId();
	}

}
?>
