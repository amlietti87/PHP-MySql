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
    
    if ($_POST['pass_terOld'] == $_POST['passwd']) {
        $passwd = $_POST['pass_terOld'];
    } else {
        $passwd = md5($_POST['passwd']);
    }

    //MODIFICACION DE USUARIO -----------------
    $results = $db->query('UPDATE cdf.terapeutas SET nom_ter="' . $_POST['nombre'] . '", ape_ter="' . $_POST['apellido'] . '", doc_ter="' . $_POST['documento'] . '", pass_ter="' . $passwd  . '", prof_ter="' . $_POST['profesion'] . '", tel_ter="' . $_POST['telefono'] . '", mail_ter="' . $_POST['email'] . '" WHERE id_ter=' . $_POST['idterapeuta'] . '');
    
    if ($results) {
        $msj = "Hemos modificado correctamente al usuario!";
    } else {
        $msj = "No Hemos modificado correctamente al usuario!";
    }
}

$results = $db->query('SELECT * FROM cdf.terapeutas WHERE id_ter ='.$_GET['id']);
$resultado = $results->fetchAll();
foreach ($resultado as $row) {
    $row['nom_ter'];
    $row['ape_pac'];
    $row['doc_ter'];
    $row['pass_ter'];
    $row['prof_ter'];
    $row['tel_ter'];
    $row['mail_ter'];
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
            <input type="hidden" name="idterapeuta" value="<?php echo $row['id_ter']; ?>" >
            <input type="hidden" name="pass_terOld" value="<?php echo $row['pass_ter']; ?>" >
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td colspan="3" align="left"><strong>Modificación de datos del Terapeuta</strong></td>
                </tr>
                <?php if ($msj) { ?>
                    <tr>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $msj; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td align="left" >Nombre</td>
                    <td align="left" ><input name="nombre" type="text" id="nombre" value="<?php echo $row['nom_ter']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Apellido</td>
                    <td align="left" ><input name="apellido" type="text" id="apellido" value="<?php echo $row['ape_ter']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Documento</td>
                    <td align="left" ><input name="documento" type="text" id="documento" value="<?php echo $row['doc_ter']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Password</td>
                    <td align="left" ><input name="passwd" type="password" id="passwd"></td>
                </tr>
                <tr>
                    <td align="left" >Profesion</td>
                    <td align="left" ><input name="profesion" type="text" id="profesion" value="<?php echo $row['prof_ter']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Telefono</td>
                    <td align="left" ><input name="telefono" type="text" id="telefono" value="<?php echo $row['tel_ter']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Email</td>
                    <td align="left"><input name="email" type="text" id="mail" value="<?php echo $row['mail_ter']; ?>"></td>
                </tr>
            </table>
            <p><input type="submit" name="procesar" id="procesar" value="Modificar"></p>
        </form>
        <form action="ABMTer.php" method="POST">
            <p><input type="submit" name="volver" id="volver" value="Volver"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>