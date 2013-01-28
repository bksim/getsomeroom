<?php 


require_once('AppInfo.php');

// Enforce https on production
if (substr(AppInfo::getUrl(), 0, 8) != 'https://' && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
  header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}

// This provides access to helper functions defined in 'utils.php'
require_once('utils.php');
require_once('sdk/src/facebook.php');

   $app_id = AppInfo::appID();
   $app_secret = AppInfo::appSecret();
   $my_url = "index.php";

   session_start();
   $token = $_SESSION["access_token"];



   if($token) {
     $graph_url = "https://graph.facebook.com/me/permissions?method=delete&access_token=" 
       . $token;

      $result = json_decode(file_get_contents($graph_url));
     if($result) {
        session_destroy();
        echo("User is now logged out.");
     }
   } else {
     echo("User already logged out.");
   }




?>