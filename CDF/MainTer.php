<?php

if (isset($_POST['cargar'])) {
    $id = $_POST['idpaciente'];
    header("Location:HrsTer.php?id=$id");
}

if (isset($_POST['ver'])) {
    header("Location:ListHrsTer.php");
}

if (isset($_POST['salir'])) {
    
    header("Location:LogOut.php");
}
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

$db = null;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Documento sin título</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body>
        <p>Bienvenido <strong><?php echo $_SESSION['Useradmin']; ?></strong>

        <form name="loginForm" action="" method="post">
           
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td align="left" ></td>
                    <td align="left" >Nombre</td>
                    <td align="left" >Apellido</td>
                </tr>
                <?php foreach ($resultado as $row) { ?>
                    <tr>

                        <td><input type="radio" name="idpaciente" value="<?php echo $row['id_pac']; ?>"></td>
                        <td align="left"><?php echo $row['nom_pac']; ?></td>
                        <td align="left"><?php echo $row['ape_pac']; ?></td>

                    </tr>

                <?php } ?>
            </table>
            <p><input type="submit" name="cargar" id="cargar" value="Cargar Horas"></p>
            <p><input type="submit" name="ver" id="ver" value="Ver Hs del Mes"></p>
            <p><input type="submit" name="salir" id="salir" value="Salir"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>
