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


// tercero, redactar la consulta sql-----------------
$results = $db->query('SELECT cdf.pacientes.nom_pac,cdf.pacientes.ape_pac,cdf.horarios_ter.tipo_hora,cdf.horarios_ter.cantidad_horas FROM cdf.pacientes,cdf.horarios_ter WHERE cdf.horarios_ter.id_pac = cdf.pacientes.id_pac 
                        AND cdf.horarios_ter.id_ter =' . $_SESSION['id_Ter'] . ' AND cdf.horarios_ter.mes ="' . $_POST['Meses'] . '"');

if (!$results) {
    $msj = "No hay registros para el paciente en el mes";
}

$resultado = $results->fetchAll();

}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Documento sin título</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body>
        <form name="loginForm" action="" method="post">
            
                    <p align="left">Seleccionar Mes</p>

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
                  
            <table  border="1" cellspacing="0" cellpadding="2">
                <?php if ($msj) { ?>
                    <tr>
                        <td align="left" ><?php echo $msj; ?></td>
                    </tr>
                <?php } ?> 
                <?php if(!$msj) { ?>
                <tr>
                    <td align="left">Nombre Paciente</td>
                    <td align="left">Apellido Paciente</td>
                    <td align="left">Tipo de Hora</td>
                    <td align="left">Cantidad de horas</td>

                </tr>
                <?php } ?>
                <?php foreach ($resultado as $row) { ?>
                    <tr>
                        <td align="left"><?php echo $row['nom_pac']; ?></td>
                        <td align="left"><?php echo $row['ape_pac']; ?></td>
                        <td align="left"><?php echo $row['tipo_hora']; ?></td>
                        <td align="left"><?php echo $row['cantidad_horas']; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <input type="submit" name="procesar" id="procesar" value="Ver">
        </form>
        <form action="MainTer.php" method="POST">
            <input type="submit" name="Volver" id="Volver" value="Volver">
        </form>
        <p>&nbsp;</p>
    </body>
</html>


