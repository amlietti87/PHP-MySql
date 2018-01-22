<?php
require("Seguridad.php");

$_SESSION['id_Ter'] = 1;
if (isset($_POST['procesar'])) {

    $dsn = getenv('MYSQL_DSN');
    $user = getenv('MYSQL_USER');
    $password = getenv('MYSQL_PASSWORD');
    if (!isset($dsn, $user) || false === $password) {
        throw new Exception('Set MYSQL_DSN, MYSQL_USER, and MYSQL_PASSWORD environment variables');
    }

    $db = new PDO($dsn, $user, $password);


    //ALTA HORAS -----------------
    $results = $db->query('INSERT INTO cdf.horarios_ter (id_ter, id_pac, tipo_hora, mes, cantidad_horas)
                            VALUES
                            (' . $_SESSION['id_Ter'] . ',' . $_SESSION['idpaciente'] . ', "' . $_POST['TipoHora'] . '","' . $_POST['Meses'] . '",' . $_POST['CantHoras'] . ')');



    if ($results) {
        $msj = "Se han cargado correctamente las horas!";
        unset($_POST);
    } else {
        $msj = "No se han podido cargar los datos";
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
        <p>Paciente: <strong><?php echo $_SESSION['Paciente']; ?></strong>
        <form name="form1" method="post" action="">
            <p align="center"><strong>CONFIRMACION DE CARGA</strong></p>
            <?php if ($msj) { ?>

                <p align="center" ><?php echo $msj; ?></p>

            <?php } ?>
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td align="left" >Tipo Hora:</td>
                    <td align="left" ><input name="TipoHora" type="text" id="TipoHora" value="<?php echo $_POST['TipoHora']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Mes:</td>
                    <td align="left" ><input name="Meses" type="text" id="Meses" value="<?php echo $_POST['Meses']; ?>"></td>
                </tr>
                <tr>
                    <td align="left" >Cantidad de Horas:</td>
                    <td align="left" ><input name="CantHoras" type="text" id="CantHoras" value="<?php echo $_POST['CantHoras']; ?>"></td>
                </tr> 
            </table>
            <input type="submit" name="procesar" id="procesar" value="Confirmar">
        </form>
        <form action="MainTer.php" method="POST">
            <input type="submit" name="volver" id="volver" value="Volver">
        </form>
        <p>&nbsp;</p>
    </body>
</html>