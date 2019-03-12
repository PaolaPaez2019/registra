<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="cocina"||$_SESSION['id_sesion']=="barra"){
?>

<script src="Public/jquery/jquery-3.3.1.min.js"></script>
<script src="Public/jquery/verifica_cambio_pedido.js"></script>
<section>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead class="thead-dark small">
				<tr>
					<th>Descripción</th>
					<th>Inventario Físico</th>
					<th>Inventario Teórico</th>
					<th>Codigo <br>Ingrediente</th>

				</tr>
			</thead>
			<tbody>
				<?php
				// $costo_total=0;
				// $total_prod=0;
				foreach ($productos as $producto) {
						?>
						<tr>
							<td class="small"><?php echo $producto->descrip?></td>
							<!-- <td><input class="inventa1" type="number"  value="<?php //echo $producto->inventa1;?>" name="inventa1" id="inventa1" required></td> -->
							<td class="small"><?php echo $producto->inventaFisico?></td>
							<td class="small"><?php echo $producto->inventa1?></td>

							<td><?php echo $producto->codingre; ?></td>
						</tr>
					<?php  }//end foreach ?>


			</tbody>
		</table>
						<!-- <form action='Controllers/producto_controller.php' method='post' id="register_form_exis">
							<input type='hidden' name='action' value='updateExistencia'>
							<input type='hidden' name='codingre' maxlength='10' value='<?php //echo $producto->codingre; ?>'>	 -->
					<form action="Controllers/relacion_controller.php" method="post" id="pedido_form">
						<input type="hidden" name="action" value="updateRelation">
						<input type="hidden" name="id_pedido" value="<?php echo $order['id_pedido'];?>" >
						<input type="hidden" name="costo_total" value="<?php echo $costo_total;?>" id="costo_total_mod">
						<!-- <input type="hidden" name="total_prod" value="<?php //echo $total_prod;?>"> -->
						<input type="hidden" name="modificados" value="" id="array_modifica">


					</form>
	</div>
</div>
</section>



		<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: Views/sesion/no_sesion.php');
		}
	}
//}
	?>
