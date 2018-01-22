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

    //ELIMINAR UN USUARIO -----------------
    // tercero, redactar la consulta sql-----------------
    $results = $db->query('DELETE FROM cdf.pacientes WHERE id_pac=' . $_POST['idpaciente'] . '');

    if ($results) {
        $msj = "Hemos eliminado correctamente al Paciente!";
    }
}

$results = $db->query('SELECT id_pac, nom_pac, ape_pac FROM cdf.pacientes WHERE id_pac ='.$_GET['id']);
$resultado = $results->fetchAll();
foreach ($resultado as $row) {
    $row['id_pac'];
    $row['nom_pac'];
    $row['ape_pac'];
}

$db = null;
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
                    <td colspan="3" align="left"><strong>Eliminar Paciente:</strong></td>
                </tr>
                <?php if ($msj) { ?>
                    <tr>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $msj; ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>   
                        <td align="left" >Esta seguro que desea eliminar al Paciente: <?php echo "<strong>" . $row['nom_pac'] . " " . $row['ape_pac'] . "</strong>"; ?></td>
                    </tr>
                <?php }; ?>
            </table>
            <p><input type="submit" name="procesar" id="procesar" value="Eliminar"></p>
        </form>
        <form action="ABMPac.php" method="POST">
            <p><input type="submit" name="volver" id="volver" value="Volver"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>