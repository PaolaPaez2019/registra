<html>
  <head>
    <title>Uso de jquery</title>
    <script src='jquery-3.3.1.min.js'></script>
    <script>
      $(document).ready(function(){
        var cantidad;
        var id_producto;
        $(".cantidad").change(function(){
          cantidad = $(this).parents("tr").find(".cantidad").val();
          id_producto = $(this).parents("tr").find(".cantidad").attr("name");
		      alert(cantidad+id_producto);
          console.log(cantidad);

	       });

       var totalDeuda=0;
       $(".costo_producto").each(function(){
       totalDeuda+=parseInt($(this).html());
       console.log(totalDeuda);
       });

      });


    </script>
  </head>
  <body>
    <table>
    <tr>
		    <td>Id producto</td>
		    <td>Descripción</td>
		    <td>Codigo Familia</td>
		<td>Existencia</td>
		<td>Precio Unitario</td>
		<td>Stock minimo</td>
		<td>Stock Maximo</td>
		<td>Unidad Medida</td>
		<td>Pedido</td>
		<td>Costo Total</td>
		<td colspan="2">Acciones</td>
	 </tr>

			<tr>
				<td>1</td>
				<td>leche</td>
				<td>LACT</td>
				<td>10.0000</td>
				<td class='precion_unitario'>20.0000</td>
				<td>8.0000</td>
				<td>15.0000</td>
				<td>litro</td>
				<td><input type="text" name="1" value="5" class='cantidad'></td>
				<td class='costo_producto'>100</td>
										<td><a href="http://localhost/almacen/Controllers/Controllers/producto_controller.php?action=udate&amp;id=1">Actualizar</a> </td>
				<td><a href="http://localhost/almacen/Controllers/Controllers/producto_controller.php?action=delete&amp;id=1">Eliminar</a> </td>
			</tr>


			<tr>
				<td>765</td>
				<td>Queso Manchego</td>
				<td>LACT</td>
				<td>5.0000</td>
				<td class='precion_unitario'>60.0000</td>
				<td>20.0000</td>
				<td>50.0000</td>
				<td>kg</td>
				<td><input type="text" name="765" value="45" class='cantidad'></td>
				<td class='costo_producto'>2700</td>
										<td><a href="http://localhost/almacen/Controllers/Controllers/producto_controller.php?action=udate&amp;id=765">Actualizar</a> </td>
				<td><a href="http://localhost/almacen/Controllers/Controllers/producto_controller.php?action=delete&amp;id=765">Eliminar</a> </td>
			</tr>

		 	<tr>
				<td colspan="10" id='costo_total'>Total de Compra = 2800</td>
			</tr>
    </table>

  </body>
</html>
