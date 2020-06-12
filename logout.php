

<?php//logout.phpinclude('config.php');//Reset OAuth access token
// $google_client->revokeToken();//Destroy entire session data.
session_destroy();//redirect page to index.php
header('location:index.php');if (isset($_REQUEST['logout'])) {
    unset($_SESSION["auto"]);
    unset($_SESSION['token']);
    $gClient->revokeToken();
    header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}?>


