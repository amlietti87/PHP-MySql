<?php


session_start();

if (isset($_SESSION["fb_access_token"])) {

    require_once "Facebook/autoload.php";

    $fb = new Facebook\Facebook([
        'app_id' => '147732975794995',
        'app_secret' => 'ca2bb3b43ccb8d29fc5f7490372c7f68',
        'default_graph_version' => 'v2.2',
    ]);

    $accessToken = $_SESSION['fb_access_token'];

    if (isset($accessToken)) {
        
        $fb->setDefaultAccessToken($accessToken);

        try {
            $response = $fb->get('/me');
            $userNode = $response->getGraphUser();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $_SESSION['Validado'] = 1;
        $_SESSION['id_Adm'] = 1;
        $_SESSION['Useradmin'] = $userNode->getName();
        echo 'Bienvenido ' . $userNode->getName();
        echo " <a href='MainAdm.php'>Continuar</a>";
    }
} else {
    header("Location: LogTer.php");
}
?>