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
    $results = $db->query('SELECT * FROM cdf.terapeutas WHERE doc_ter =' . $_POST['documento'] . '');
    $cantidad = $results->rowCount();
    $resultado = $results->fetchAll();


    if ($cantidad > 0) {
        // TERAOEUTA EXISTENTE --------------
        $msj = "Terapeuta ya registrado en la base de datos";
    } else {
        //ALTA TERAPEUTA -----------------
        $results = $db->query('INSERT INTO cdf.terapeutas (nom_ter, ape_ter, doc_ter, pass_ter, prof_ter, tel_ter, mail_ter)
                            VALUES
                            ("' . $_POST['nombre'] . '","' . $_POST['apellido'] . '", ' . $_POST['documento'] . ',"' . md5($_POST['passwd']) . '","' . $_POST['profesion'] . '","' . $_POST['telefono'] . '","' . $_POST['email'] . '")');



        if ($results) {
            $msj = "El Terapeuta ha sido cargado correctamente!";
            unset($_POST);
        } else {
            $msj = "No se han podido cargar al Terapeuta";
        }
    }
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
                    <td colspan="3" align="left"><strong>ALTA DE TERAPEUTA</strong></td>
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
                </tr>
                <tr>
                    <td align="left" >Documento</td>
                    <td align="left" ><input name="documento" type="text" id="documento" value="<?php echo $_POST['documento']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Password</td>
                    <td align="left" ><input name="passwd" type="text" id="passwd"></td>
                </tr>
                <tr>
                    <td align="left" >Profesion</td>
                    <td align="left" ><input name="profesion" type="text" id="profesion" value="<?php echo $_POST['profesion']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Telefono</td>
                    <td align="left" ><input name="telefono" type="text" id="telefono" value="<?php echo $_POST['telefono']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Email</td>
                    <td align="left"><input name="email" type="text" id="email" value="<?php echo $_POST['email']; ?>"></td>
                </tr>
            </table>
            <p><input type="submit" name="procesar" id="procesar" value="Agregar"></p>
        </form>
        <form action="ABMTer.php" method="POST">
            <p><input type="submit" name="volver" id="volver" value="Volver"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>