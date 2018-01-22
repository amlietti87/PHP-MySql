	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Terapeutas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="fb-root"></div>
        <?php
        require_once 'Facebook/autoload.php';
        session_start();
        $fb = new Facebook\Facebook([
            'app_id' => '147732975794995',
            'app_secret' => 'ca2bb3b43ccb8d29fc5f7490372c7f68',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl('https://redes2-171719.appspot.com/FBAdmCallback.php', $permissions);
        ?>
        <div class="main">
            <div class="header_bg">
                <div class="header">
                </div>
                <div class="clr"></div>
            </div>
            <div class="header_text_bg2">
                <div class="header_text">

                    <h2>Intranet Panel de Administrativos</h2>

                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="clr"></div>
            <div class="body_resize">
                <div class="body">
                    <div class="body_big">
                        <h2>Bienvenido...</h2>
                        <p></p>

                        <form name="loginForm" action="ConAdmin.php" method="post" id="loginForm" enctype="multipart/form-data">
                            <ol>
                                <li>
                                    <label for="user">Documento<span class="red"></span></label>
                                    <input type="text" id="documento" name="documento" class="login" />
                                </li>
                                <li>
                                    <label for="pass">Contraseña<span class="red"></span></label>
                                    <input type="password" id="password" name="password" class="login" />
                                </li>
                                <li class="buttons">
                                    <input type="submit" name="ingresar" id="ingresar" value="ingresar" />
                                    <div class="clr"></div>  
                                </li>
                            </ol>
                        </form>
                    </div>
                    <?php
                    echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
                    ?>
                </div>

                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </div>
        </div>     
    </body>
</html>
