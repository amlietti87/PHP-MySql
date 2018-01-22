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
                $results = $db->query('SELECT * from cdf.terapeutas WHERE doc_ter = "'.$_POST['documento'].'" AND pass_ter = "'.md5($_POST['password']).'"');
				
		$cantidad =$results ->rowCount();
                $resultado = $results ->fetchAll();


		if($cantidad > 0)
		{   
                    foreach ($resultado as $row){
			session_start(); // inicia o continua una sesion. En este caso la crea.
                        $_SESSION['Useradmin'] 	= $row['nom_ter']." ".$row['ape_ter'];
                        $_SESSION['id_Ter'] = $row['id_ter'];
			$_SESSION['Validado'] 	= 1;
			header("Location: MainTer.php");
                    }
		}
			else
			{
				header("Location:LogTer.php");
			}
	}
        
        $db = null;
		

?>
