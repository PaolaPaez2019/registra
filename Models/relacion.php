<?php
/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/
class Relacion
{
	//atributos
	public $id_pedido;
	public $codingre;
	public $fecha_pedido;
	public $hora_pedido;
	public $num_prod;
	public $estado_prod;
	public $observacion;

	//constructor de la clase
	function __construct($id_pedido, $codingre, $fecha_pedido, $hora_pedido, $num_prod, $estado_prod, $observacion)
	{
		$this->id_pedido=$id_pedido;
		$this->codingre=$codingre;
		$this->fecha_pedido=$fecha_pedido;
		$this->hora_pedido=$hora_pedido;
		$this->num_prod=$num_prod;
		$this->estado_prod=$estado_prod;
		$this->observacion=$observacion;
	}

	//función para obtener todos los usuarios
	public static function all(){
		$listaRelaciones =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM pedido_producto');
		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $relacion) {
			$listaRelaciones[]= new Relacion($relacion['id_pedido'],$relacion['codingre'], $relacion['fecha_pedido'],
																			 $relacion['hora_pedido'],$relacion['num_prod'],$relacion['estado_prod'],
																		 	 $relacion['observacion']);
		}
		return $listaRelaciones;
	}

	//la función para registrar un usuario
	public static function save($relacion){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO pedido_producto
													  VALUES(:id_pedido,:codingre,:fecha_pedido,
																	 :hora_pedido,:num_prod,:estado_prod,
																 	 :observacion)');
			$insert->bindValue('id_pedido',$relacion->id_pedido);
			$insert->bindValue('codingre',$relacion->codingre);
			$insert->bindValue('fecha_pedido',$relacion->fecha_pedido);
			$insert->bindValue('hora_pedido',$relacion->hora_pedido);
			$insert->bindValue('num_prod',$relacion->num_prod);
			$insert->bindValue('estado_prod',$relacion->estado_prod);
			$insert->bindValue('observacion',$relacion->observacion);
			$insert->execute();
		}

		public static function saveDiferencia($codingre){
				// $diferencia=$inventa1-$inventaFisico;
				$db=Db::getConnect();
				$insert=$db->prepare('UPDATE productos SET  diferencia = (inventa1 - inventaFisico) WHERE codingre=:codingre');
				$insert->bindValue('codingre',$codingre);
				// $insert->bindValue('inventaFisico',$relacion->$inventaFisico);
				// $insert->bindValue('inventa1',$relacion->$inventa1);
				$insert->execute();
			}
	//la función para actualizar
	public static function update($relacion){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE pedido_producto
													SET codingre=:codingre, fecha_pedido=:fecha_pedido,	hora_pedido=:hora_pedido,
													    num_prod=:num_prod,estado_prod=:estado_prod, observacion=:observacion
													WHERE id_pedido=:id_pedido');
		$update->bindValue('id_pedido',$relacion->id_pedido);
		$update->bindValue('codingre',$relacion->codingre);
		$update->bindValue('fecha_pedido',$relacion->fecha_pedido);
		$update->bindValue('hora_pedido',$relacion->hora_pedido);
		$update->bindValue('num_prod',$relacion->num_prod);
		$update->bindValue('estado_prod',$relacion->estado_prod);
		$update->bindValue('observacion',$relacion->observacion);
		$update->execute();
		// echo "Me ejecuto con normalidad";
	}

	public static function copyCol(){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE productos SET inventa1=inventaFisico');
		$update->execute();
	}
	//la función para actualizar
	public static function updateProductsOrder($codingre,$modificados){

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
		    $update=$db->prepare('UPDATE productos SET inventaFisico=:inventa1, diferencia = (inventa1 - inventaFisico)
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
		$relacion= new Relacion($relacionDb['id_pedido'],$relacionDb['codingre'],$relacionDb['fecha_pedido'],
														$relacionDb['hora_pedido'],$relacionDb['num_prod'],$relacionDb['estado_prod'],
														$relacionDb['observacion']);
		return $relacion;
	}
}
?>
