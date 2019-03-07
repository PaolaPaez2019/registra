<?php

	if(isset($_SESSION["id_sesion"])){
		if($_SESSION["id_sesion"]=="cocina"||$_SESSION["id_sesion"]=="barra"){
?>

<script src="Public/jquery/jquery-3.3.1.min.js"></script>
<script src="Public/jquery/verifica_cambio_pedido.js"></script>


<section>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead class="thead-dark small" >
				<tr>
					<th style="width:180px">Descripción</th>
					<th style="width:">Inventario Físico</th>
					<th style="width:px">Inventario Teórico</th>
					<th style="width:px">Diferencia</th>
					<th style="width:px">Porcentaje</th>

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
							<td><input class="existencia" id="existencia" type="number" style="width:80px" name="<?php echo $producto->codingre?>" value="<?php echo $producto->inventa1?>" required></td>
							<td class="existencia_sin_modificar"><?php echo $producto->inventa1?></td>
							<td class="modifica" id="modifica"> <?php echo 0;?></td>
							<td class="porcent"><?php echo "100%"; ?></td>
						</tr>
					<?php  }//end foreach ?>


			</tbody>
		</table>
						<!-- <form action='Controllers/producto_controller.php' method='post' id="register_form_exis">
							<input type='hidden' name='action' value='updateExistencia'>
							<input type='hidden' name='codingre' maxlength='10' value='<?php //echo $producto->codingre; ?>'>	 -->
					<form action="Controllers/producto_controller.php" method="post" id="form">
						<input type="hidden" name="action" value="updateExistencia">
						<input type="hidden" name="codingre" value="<?php echo $order['codingre'];?>" >
						<!-- <input type="hidden" name="existencia" value="<?php //echo $_POST['existencia'];?>" id="existencia"> -->
						<!-- <input type="hidden" name="diferencia" value="<?php //echo $_POST['diferencia'];?>"> -->

							<center>
								<input type="submit" value="Registrar" class="btn btn-success" id="btn" onclick="foor()">
							</center>
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
