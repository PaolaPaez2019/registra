$(function(){
  //var cantidad=0;
  var id_producto=0;
  var datos="";
  var existencia;
  var cantidad_aux;
  var exp;
  //console.log(datos);
  //Coloca en verde todos los input
  $(".existencia").each(function(){
    $(this).parents("tr").find(".existencia").css("background-color","#b8ff54");
  })
  $(".existencia").change(function(){
    existencia = $(this).parents("tr").find(".existencia").val();
    //console.log(existencia);
    codingre = $(this).parents("tr").find(".existencia").attr("name");
    //console.log(codingre);
    var existencia_sin_modificar = $(this).parents("tr").find(".existencia_sin_modificar").html();
	  var diferencia = existencia_sin_modificar-existencia;
	  $(this).parents("tr").find(".modifica").html(diferencia);
    var porcentaje = (existencia*100)/existencia_sin_modificar;
    $(this).parents("tr").find(".porcent").html(porcentaje)+"%";
  	console.log(existencia);
  	//console.log(existencia_sin_modificar);
  	console.log(diferencia);
    // console.log(id_pedido);
    // stock_min = $(this).parents("tr").find(".cantidad").attr("min");
    // stock_min = $(this).parents("tr").find(".stock_min").html();
    if(existencia.match(/^[0-9]+/) && !($(this).parents("tr").find(".existencia").val().length == 0)){
      //Ingresa el id y cantidas de productos a un string y si esta reempraza la cantidad
      // console.log(id_producto);
      exp = new RegExp(codingre+":[0-9]+","g");
       // console.log("Expresion"+exp);
      if (datos.match(exp)) {
        // console.log("Resultado: "+datos.match(exp));
        rem=datos.match(exp)
        datos=datos.replace(rem[0],codingre+":"+existencia);
      }
      else {
        datos=datos+codingre+":"+existencia+":"+diferencia;
      }
      console.log("Datos",datos);
      // console.log(typeof(datos));
      // $("#costo_total").html("Total de Compra = " + totalDeuda);
      //Pone los datos modificados en un value de un relacion_pedido_producto
      $("#array_modifica").val(datos);
    }else{
      $(this).parents("tr").find(".existencia");
      alert("Ingresa una cantidad valida");
	  if(existencia<0){
		$(this).parents("tr").find(".existencia").val();
		diferencia = 0;
		$(this).parents("tr").find(".modifica").html(diferencia);
      }else{
		  $(this).parents("tr").find(".existencia").val(cantidad_aux);
		  $(this).parents("tr").find(".existencia");
	   }
    }
    // console.log(existencia);
    // console.log(diferencia);
    // function ajaxVariables(existencia,diferencia){
    //   console.log(existencia + "-" + diferencia);
    //      $.ajax({
    //                 type: "POST",
    //                 url: "producto_controller.php",
    //                 data: {existencia:existencia,diferencia:diferencia},
    //                 //dataType:"html",
    //                 asycn:false,
    //                 success: function(){
    //                    console.log("Ha sido ejecutada la acción.");
    //                 }
    //         });
    // }

    });
    $('.existencia').click(function(){
       var existencia = $(this).parents("tr").find(".existencia").val();
      console.log(existencia);
      var data={"existencia":existencia};
                console.log(data);
      $.ajax({
                type: 'POST',
                url: 'registra/Views/Producto/pro.php',
                data: data,
                cache:"false",
                success: function (data) {
                    // console.log(response);
                    console.log("hola desde success");
                }
            });
    });

});

    function foor(){
      alert("Las existencias se han registrado correctamente");
      return true;
    }
