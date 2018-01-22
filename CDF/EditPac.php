<?php
require("Seguridad.php");



$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
if (!isset($dsn, $user) || false === $password) {
    throw new Exception('Set MYSQL_DSN, MYSQL_USER, and MYSQL_PASSWORD environment variables');
}

$db = new PDO($dsn, $user, $password);


if (isset($_POST['procesar'])) {
    
    //MODIFICACION DE USUARIO -----------------
    $results = $db->query('UPDATE cdf.pacientes SET nom_pac="' . $_POST['nombre'] . '", ape_pac="' . $_POST['apellido'] . '" WHERE id_pac=' . $_POST['idpaciente'] . '');
    
    if ($results) {
        $msj = "Hemos modificado correctamente al Paciente!";
    } else {
        $msj = "No hemos podido modificar correctamente al paciente";
    }
}

$results = $db->query('SELECT * FROM cdf.pacientes WHERE id_pac ='.$_GET['id']);
$resultado = $results->fetchAll();
foreach ($resultado as $row) {
    $row['id_pac'];
    $row['nom_pac'];
    $row['ape_pac'];
    
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Documento sin título</title>
        <link href="style.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body>
        <form name="form1" method="post" action="">
            <input type="hidden" name="idpaciente" value="<?php echo $row['id_pac']; ?>" >
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td colspan="3" align="left"><strong>Modificación de datos del Paciente</strong></td>
                </tr>
                <?php if ($msj) { ?>
                    <tr>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $msj; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td align="left" >Nombre</td>
                    <td align="left" ><input name="nombre" type="text" id="nombre" value="<?php echo $row['nom_pac']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Apellido</td>
                    <td align="left" ><input name="apellido" type="text" id="apellido" value="<?php echo $row['ape_pac']; ?>"></td>
                </tr>
            </table>
            <p><input type="submit" name="procesar" id="procesar" value="Modificar"></p>
        </form>
        <form action="ABMPac.php" method="POST">
            <p><input type="submit" name="volver" id="volver" value="Volver"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>