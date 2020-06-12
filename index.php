<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error'])) {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Haal gebruikersprofielgegevens op van Google
        $data = $google_service->userinfo->get();

        //Below you can find Get profile data and store into $_SESSION variable
        if(!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if(!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if(!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
            }

        if(!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if(!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

//Dit is om te controleren of de gebruiker zich heeft aangemeld bij het systeem met behulp van een Google-account.
//Als de gebruiker zich niet aanmeldt bij het systeem, wordt het uitgevoerd als een codeblok en wordt code gemaakt voor het weergeven van de aanmeldingslink voor inloggen met een Google-account.


if(!isset($_SESSION['access_token'])) {
    //Create a URL to obtain user authorization
    $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.png" /></a>';
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project stam</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <nav class="bg-white px-8 pt-2 shadow-md">
        <div class="-mb-px flex justify-center">
            <a class="no-underline text-teal-dark border-b-2 border-teal-dark uppercase tracking-wide font-bold text-xs py-3 mr-8" href="#">
                Home pagina
            </a>
            <a class="no-underline text-grey-dark border-b-2 border-transparent uppercase tracking-wide font-bold text-xs py-3 mr-8" href="#">
                Registreren
            </a>
            <a class="no-underline text-grey-dark border-b-2 border-transparent uppercase tracking-wide font-bold text-xs py-3 mr-8" href="#">
                rooster
            </a>
            <a class="no-underline text-grey-dark border-b-2 border-transparent uppercase tracking-wide font-bold text-xs py-3" href="#">
                Chat
            </a>
        </div>
</header>
<body class="bg-gray-300">
    <div class="block md:flex">
        </div>
        <br><br><br>

        <div class="text-center mt-4">
            <div class="flex items-center justify-center">
               <svg fill="none" viewBox="0 0 24 24" class="w-12 h-12 text-blue-500" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
               </svg>
            </div>
            <h2 class="text-4xl tracking-tight">
               Log in met je google account
            </h2>
            <span class="text-sm">of <a href="#" class="text-blue-500"> 
               registreer een nieuw account
            </a>
         </span>
      </div>
      <div class="flex justify-center my-2 mx-4 md:mx-0">
         <form class="w-full max-w-xl bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-wrap -mx-3 mb-6">
               <div class="w-full md:w-full px-3 mb-6">
                 
               </div>
               <div class="w-full md:w-full px-3 mb-6">
               </div>
               <div class="w-full flex items-center justify-between px-3 mb-3 ">
                  <label for="remember" class="flex items-center w-1/2">
                     <input type="checkbox" name="" id="" class="mr-1 bg-white shadow">
                     <span class="text-sm text-gray-700 pt-1">onthoud mijn gegevens</span>
                  </label>
                  <div class="w-1/2 text-right">
                     <a href="#" class="text-blue-500 text-sm tracking-tight">Nog geen google account?</a>
                  </div>
               </div>
               <div class="container">
                        <div class="panel panel-default">
                            <?php
                            if($login_button == '') {
                                echo '<div class="panel-heading">Welkom gebruiker</div><div class="panel-body">';
                                echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
                                echo '<h3><b>Naam :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
                                echo '<h3><b>Email adres :</b> '.$_SESSION['user_email_address'].'</h3>';
                                echo '<h3><a href="logout.php">Log uit</h3></div>';
                            } else {
                                echo '<div>'.$login_button . '</div>';
                            }
                            
                            ?>
                        </div>
                    </div>
               
                        </svg>
                     </button>
                  </div>
               </div>
            </div>
         </form>
      </div>

       
</body>

</html>