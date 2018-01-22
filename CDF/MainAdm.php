<?php
require("Seguridad.php");


$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
if (!isset($dsn, $user) || false === $password) {
    throw new Exception('Set MYSQL_DSN, MYSQL_USER, and MYSQL_PASSWORD environment variables');
}

$db = new PDO($dsn, $user, $password);


// tercero, redactar la consulta sql-----------------
$results = $db->query('SELECT * from cdf.pacientes');

$resultado = $results->fetchAll();

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Documento sin título</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body>
        <p><?php include ('MenuTop.php'); ?></p>
        <p>Bienvenido <strong><?php echo $_SESSION['Useradmin']; ?></strong>

        <form name="loginForm" action="ListHrsAdm.php" method="post">
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td align="left"></td>
                    <td align="left">Nombre</td>
                    <td align="left">Apellido</td>

                </tr>
                <?php foreach ($resultado as $row) { ?>
                    <tr>
                        <td><input type="radio" name="idpaciente" value="<?php echo $row['id_pac']; ?>"></td>
                        <td align="left"><?php echo $row['nom_pac']; ?></td>
                        <td align="left"><?php echo $row['ape_pac']; ?></td>

                    </tr>

                <?php } ?> 
            </table>
           
                    <p align="left">Seleccionar Mes
                        <select NAME = "Meses">
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>  
                        </select>
                    </p>    
                    <p><input type="submit" name="enviar" id="enviar" value="Ver Horas"></p>
        </form>
        <form action="LogOut.php" method="POST">
            <p><input type="submit" name="salir" id="salir" value="Salir"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>
