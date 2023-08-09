<?php
include_once dirname(__FILE__) . "/social_login_config.php";


$accessToken = $_SESSION['accessToken'];
$state = $_SESSION['state'];

if($state == 'kakao'){
  logout($accessToken);
}else if($state == 'naver'){
  naverLogout($accessToken);
}

  logout($accessToken);


  session_start();
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  unset($_SESSION["userlevel"]);
  unset($_SESSION["userpoint"]);
  unset($_SESSION["accessToken"]);
  unset($_SESSION["state"]);
  


  echo("
       <script>
          location.href = 'index.php';
         </script>
       ");
