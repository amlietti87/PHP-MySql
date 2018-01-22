<?php
require("Seguridad.php");

if (isset($_POST['procesar'])) {


    $dsn = getenv('MYSQL_DSN');
    $user = getenv('MYSQL_USER');
    $password = getenv('MYSQL_PASSWORD');
    if (!isset($dsn, $user) || false === $password) {
        throw new Exception('Set MYSQL_DSN, MYSQL_USER, and MYSQL_PASSWORD environment variables');
    }

    $db = new PDO($dsn, $user, $password);

    // SQL busqueda usuario --------------
    $results = $db->query('SELECT nom_pac, ape_pac FROM cdf.pacientes WHERE nom_pac ="' . $_POST['nom_pac'] . '" AND ape_pac = "' . $_POST['ape.pac'] . '"');
    $cantidad = $results->rowCount();
    $resultado = $results->fetchAll();


    if ($cantidad > 0) {
        // TERAOEUTA EXISTENTE --------------
        $msj = "Paciente ya registrado en la base de datos";
    } else {
        //ALTA TERAPEUTA -----------------
        $results = $db->query('INSERT INTO cdf.pacientes (nom_pac, ape_pac)
                            VALUES
                            ("' . $_POST['nombre'] . '","' . $_POST['apellido'] . '")');



        if ($results) {
            $msj = "El Paciente ha sido cargado correctamente!";
            unset($_POST);
        } else {
            $msj = "No se han podido cargar al Paciente";
        }
    }
}

$db = null;

if (isset($_POST['volver'])) {
    header("Location:ABMPac.php");
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
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td colspan="3" align="left"><strong>ALTA DE PACIENTE</strong></td>
                </tr>
                <?php if ($msj) { ?>
                    <tr>
                        <td align="left" bgcolor="">&nbsp;</td>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $msj; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td align="left" >Nombre</td>
                    <td align="left" ><input name="nombre" type="text" id="nombre" value="<?php echo $_POST['nombre']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Apellido</td>
                    <td align="left" ><input name="apellido" type="text" id="apellido" value="<?php echo $_POST['apellido']; ?>"></td>
            </table>
            <p><input type="submit" name="procesar" id="procesar" value="Agregar"></p>
        </form>
        <form action="ABMPac.php" method="POST">
            <p><input type="submit" name="volver" id="volver" value="Volver"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>