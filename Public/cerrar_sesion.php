<?php
session_start();
unset($_SESSION["id_sesion"]);
session_destroy();
?>
< !DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Pagina 3</title>
</head>
<body>
<p>Has Cerrado Sesion</p>
<br /><a href="formulario.php">Iniciar Secion</a>
</body>
</html>
