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
$results = $db->query('SELECT cdf.terapeutas.nom_ter,cdf.terapeutas.ape_ter,cdf.terapeutas.doc_ter,cdf.horarios_ter.tipo_hora,cdf.horarios_ter.cantidad_horas FROM cdf.terapeutas,cdf.horarios_ter WHERE cdf.horarios_ter.id_ter = cdf.terapeutas.id_ter 
                        AND cdf.horarios_ter.id_pac =' . $_POST['idpaciente'] . ' AND cdf.horarios_ter.mes ="' . $_POST['Meses'] . '"');

if (!$results) {
    $msj = "No hay registros para el paciente en el mes";
}

$resultado = $results->fetchAll();

if (isset($_POST['volver'])) {
    header("Location:MainAdm.php");
}

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
            <table  border="1" cellspacing="0" cellpadding="2">
                <?php if ($msj) { ?>
                    <tr>
                        <td align="left" ><?php echo $msj; ?></td>
                    </tr>
                <?php } ?>   
                <tr>
                    <td align="left">Nombre Terapeuta</td>
                    <td align="left">Apellido Terapeuta</td>
                    <td align="left">Documento Terapeuta</td>
                    <td align="left">Tipo de Hora</td>
                    <td align="left">Cantidad de horas</td>

                </tr>
                <?php foreach ($resultado as $row) { ?>
                    <tr>
                        <td align="left"><?php echo $row['nom_ter']; ?></td>
                        <td align="left"><?php echo $row['ape_ter']; ?></td>
                        <td align="left"><?php echo $row['doc_ter']; ?></td>
                        <td align="left"><?php echo $row['tipo_hora']; ?></td>
                        <td align="left"><?php echo $row['cantidad_horas']; ?></td>
                    </tr>

                <?php } ?>
            </table>
        <form action="MainAdm.php" method="POST">
            <input type="submit" name="horas" id="volver" value="Volver">
        </form>
        <p>&nbsp;</p>
    </body>
</html>


