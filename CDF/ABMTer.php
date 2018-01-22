<?php
if (isset($_POST['Baja'])) {
    $id = $_POST['idterapeuta'];
    header("Location: BajaTer.php?id=$id");
}

if (isset($_POST['Alta'])) {
    
    header("Location: AltaTer.php");
}

if (isset($_POST['Edit'])) {
    $id = $_POST['idterapeuta'];
    header("Location: EditTer.php?id=$id");
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
$results = $db->query('SELECT * from cdf.terapeutas');

$resultado = $results->fetchAll();
foreach ($resultado as $row){
    
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
        <form name="loginForm" action="" method="post" id="loginForm" enctype="multipart/form-data">
            <table  border="1" cellspacing="0" cellpadding="2">
                <tr>
                    <td align="left"></td>
                    <td align="left">Nombre</td>
                    <td align="left">Apellido</td>
                    <td align="left">Documento</td>

                </tr>
                <?php foreach ($resultado as $row) { ?>
                    <tr>
                <td><input type="radio" name="idterapeuta" value="<?php echo $row['id_ter']; ?>"></td>
                        <td align="left"><?php echo $row['nom_ter']; ?></td>
                        <td align="left"><?php echo $row['ape_ter']; ?></td>
                        <td align="left"><?php echo $row['doc_ter']; ?></td>

                    </tr>

                <?php } ?>
            </table>
            <p><input type="submit" name="Baja" id="Baja" value="Baja Terapeuta">
               <input type="submit" name="Alta" id="Alta" value="Alta Terapeuta">
               <input type="submit" name="Edit" id="Edit" value="Editar Terapeuta">
               </p>
        </form>
        <form action="MainAdm.php" method="POST">
            <p><input type="submit" name="Volver" id="Volver" value="Volver"></p>
        </form>
        <p>&nbsp;</p>
    </body>
</html>
