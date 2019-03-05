 <!DOCTYPE html>
 <html lang="en">

<head>
     <meta charset="UTF-8">
     <title>TITLE</title>
     <meta name="description" content="DESCRIPTION">
    <link rel="stylesheet" href="PATH">

     <!--[if lt IE 9]>
       <script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
     <![endif]-->
 </head>

 <body>
   <div class="container">
   <form method="post" action="../Controllers/usuario_controller.php">
    <input type="hidden" name="action" value="login">
    <input type="text" name="usuario" placeholder="USUARIO"><br>
    <input type="text" name="password" placeholder="CONTRASEÑA">
    <input type="submit" name="login">
  </form>
   </div>
 </body>

 </html>
