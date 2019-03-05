<?php
/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/
class Relacion
{
	//atributos
	public $id_pedido;
	public $id_prod;
	public $fecha_pedido;
	public $hora_pedido;
	public $num_prod;
	public $estado_prod;

	//constructor de la clase
	function __construct($id_pedido, $id_prod, $fecha_pedido, $hora_pedido, $num_prod, $estado_prod)
	{
		$this->id_pedido=$id_pedido;
		$this->id_prod=$id_prod;
		$this->fecha_pedido=$fecha_pedido;
		$this->hora_pedido=$hora_pedido;
		$this->num_prod=$num_prod;
		$this->estado_prod=$estado_prod;
	}

	//función para obtener todos los usuarios
	public static function all(){
		$listaRelaciones =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM pedido_producto');

		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $relacion) {
			$listaRelaciones[]= new Relacion($relacion['id_pedido'],$relacion['id_prod'], $relacion['fecha_pedido'],$relacion['hora_pedido'],$relacion['num_prod'],$relacion['estado_prod']);
		}
		return $listaRelaciones;
	}

	//la función para registrar un usuario
	public static function save($relacion){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO pedido_producto VALUES(:id_pedido,:id_prod,:fecha_pedido,:hora_pedido,:num_prod,:estado_prod)');
			$insert->bindValue('id_pedido',$relacion->id_pedido);
			$insert->bindValue('id_prod',$relacion->id_prod);
			$insert->bindValue('fecha_pedido',$relacion->fecha_pedido);
			$insert->bindValue('hora_pedido',$relacion->hora_pedido);
			$insert->bindValue('num_prod',$relacion->num_prod);
			$insert->bindValue('estado_prod',$relacion->estado_prod);
			$insert->execute();
		}

	//la función para actualizar
	public static function update($relacion){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE pedido_producto
													SET id_prod=:id_prod, fecha_pedido=:fecha_pedido,
													hora_pedido=:hora_pedido, num_prod=:num_prod,estado_prod=:estado_prod
													WHERE id_pedido=:id_pedido');
		$update->bindValue('id_pedido',$relacion->id_pedido);
		$update->bindValue('id_prod',$relacion->id_prod);
		$update->bindValue('fecha_pedido',$relacion->fecha_pedido);
		$update->bindValue('hora_pedido',$relacion->hora_pedido);
		$update->bindValue('num_prod',$relacion->num_prod);
		$update->bindValue('estado_prod',$relacion->estado_prod);
		$update->execute();
		echo "Me ejecuto con normalidad";
	}

	// la función para eliminar por el id
	public static function delete($id){
		$db=Db::getConnect();
		//$delete=$db->prepare('DELETE FROM usuarios WHERE ID=:id');
		$delete=$db->prepare('DELETE FROM pedido_producto WHERE id_pedido=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

	//la función para obtener un usuario por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		//$select=$db->prepare('SELECT * FROM usuario WHERE ID=:id');
		$select=$db->prepare('SELECT * FROM pedido_producto WHERE id_pedido=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto usuario
		$relacionDb=$select->fetch();
		$relacion= new Relacion($relacionDb['id_pedido'],$relacionDb['id_prod'],$relacionDb['fecha_pedido'],$relacionDb['hora_pedido'],$relacionDb['num_prod'],$relacionDb['estado_prod']);
		return $relacion;
	}
}
?>
