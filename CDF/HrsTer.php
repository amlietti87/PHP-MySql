<?php
require("Seguridad.php");


$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
if (!isset($dsn, $user) || false === $password) {
    throw new Exception('Set MYSQL_DSN, MYSQL_USER, and MYSQL_PASSWORD environment variables');
}

$db = new PDO($dsn, $user, $password);
$results = $db->query('SELECT * from cdf.pacientes WHERE id_pac = ' .$_GET['id']);

$resultado = $results->fetchAll();
foreach ($resultado as $row) {

    $_SESSION['Paciente'] = $row['nom_pac'] . " " . $row['ape_pac'];
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
        <p>Terapeuta <strong><?php echo $_SESSION['Useradmin']; ?></strong>
        <p>Paciente <strong><?php echo $_SESSION['Paciente']; ?></strong>

        <form name="form1" method="post" action="ConfirmHs.php">
            <input type="hidden" name="idpaciente" value="<?php $_SESSION['idpaciente']; ?>" >
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td align="left"><strong>Carga de Horas</strong></td>
                </tr>                
                <tr>
                    <td align="left">Tipo Hora
                    <td align="left">    
                        <select NAME = "TipoHora">
                            <option value="Integracion">Integracion</option>
                            <option value="Domicilio">Domicilio</option>
                            <option value="Terapia">Terapia</option>
                        </select>
                    </td>    
                </tr>
                <tr>
                    <td align="left">Seleccionar Mes</td>
                    <td align="left" >
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
                    </td>
                </tr>
                <tr>
                    <td align="left" >Cantidad de Horas</td>
                    <td align="left" ><input name="CantHoras" type="text" id="CantHoras"></td>
                </tr>
            </table>
            <input type="submit" name="Cargar" id="Cargar" value="Cargar Horas">
        </form>
        <form action="MainTer.php" method="POST">
            <input type="submit" name="Volver" id="Volver" value="Volver">
        </form>
        <p>&nbsp;</p>
    </body>
</html>