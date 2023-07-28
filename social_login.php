<?php
include_once dirname(__FILE__) . "/social_login_config.php";

//a태그에서 response code 받아오기
$code = $_GET['code'];
//소셜로그인 구분자 받아오기 ('kakao','naver','google'....)
$state = $_GET['state'];
//인가받은 code를 통해 accessToken과 refreshToken 모델(인스턴스) 받기
$model = getTokenModel($code, $state);

$accessToken = $model->getAccessToken();
$profileModel = getProfile($accessToken, $state);

//mysqli_connect("localhost", "user1", "12345", "sample")
$con = $mysqlConnect;

$regist_day = date("Y-m-d (H:i)");
$sql = "insert into members(id, pass, name, email, regist_day, level, point,login_div)";
$sql .= "values('$profileModel->email', '$profileModel->uid', '$profileModel->nickname', '$profileModel->email', '$regist_day', 9, 0,'$state')";

mysqli_query($con, $sql);
mysqli_close($con);

session_start();
$_SESSION["userid"] = $profileModel->email;
$_SESSION["username"] = $profileModel->nickname;
$_SESSION["userlevel"] = "9";
$_SESSION["userpoint"] = "0";
$_SESSION["state"] = $state;

echo ("
  <script>
  location.href = 'index.php'
  </script>
");
