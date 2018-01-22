<?php


	if(isset ($_POST['ingresar']))
	{

            $dsn = getenv('MYSQL_DSN');
            $user = getenv('MYSQL_USER');
            $password = getenv('MYSQL_PASSWORD');
            if (!isset($dsn, $user) || false === $password) {
                throw new Exception('Set MYSQL_DSN, MYSQL_USER, and MYSQL_PASSWORD environment variables');
            }

        $db = new PDO($dsn, $user, $password);

        
		// tercero, redactar la consulta sql-----------------
                $results = $db->query('SELECT * from cdf.administrativos WHERE doc_adm = "'.$_POST['documento'].'" AND pass_adm = "'.$_POST['password'].'"');
				
		$cantidad =$results ->rowCount();
                $resultado = $results ->fetchAll();


		if($cantidad > 0)
		{   
                    foreach ($resultado as $row){
			session_start(); // inicia o continua una sesion. En este caso la crea.
                        $_SESSION['Useradmin'] 	= $row['nom_adm']." ".$row['ape_adm'];
                        $_SESSION['id_Adm'] = $row['id_adm'];
			$_SESSION['Validado'] 	= 1;
			header("Location: MainAdm.php");
                    }
		}
			else
			{
				header("Location:LogAdm.php");
			}
	}
        
        $db = null;
		

?>
