<?php
include_once dirname(__FILE__) . "/social_login_config.php";
include_once dirname(__FILE__) . "/common_method.php";

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

// DB에 이메일이 있는 지 검색
$sql = "select * from members where email='$profileModel->email'";

// sql 실행
$result = mysqli_query($con, $sql);
// 결과 값에 대한 카운트 수
$num_record = mysqli_num_rows($result);

// db에 데이터가 존재할 때
if ($num_record != 0) {
  $row = mysqli_fetch_array($result);

  // 가입된 계정과 플랫폼이 일치한다면
  if ($row['login_div'] == $state) {
    // 세션 저장
    session_start();
    $_SESSION["userid"] = $row['id'];
    $_SESSION["username"] = $row['name'];
    $_SESSION["userlevel"] = $row['lebel'];
    $_SESSION["userpoint"] = $row['point'];
    $_SESSION["state"] = $state;
    $_SESSION["accessToken"] = $state;

    // 홈 화면으로 이동
    echo ("
      <script>
      location.href = 'index.php'
      </script>
    ");

    // 플랫폼이 일치하지 않는다면
  } else {
    // 어떤 플랫폼에서 회원가입 했는 지
    $divValue = array("kakao" => "카카오", "naver" => "네이버", "google" => "구글");

    // alert창을 이용하여 어떤 플랫폼에서 회원가입 했었는 지 알려주기
    echo ("
      <script>
      alert('가입된 이메일이 존재합니다. (" . $divValue[$row['login_div']] . ")');
      location.href = 'index.php';
      </script>
    ");
  }

  // DB에 데이터가 없을 때 
} else {
  // DB 저장
  $regist_day = date("Y-m-d (H:i)");
  $sql = "insert into members(id, pass, name, email, regist_day, level, point,login_div)";
  $sql .= "values('$profileModel->email', '$profileModel->uid', '$profileModel->nickname', '$profileModel->email', '$regist_day', 9, 0,'$state')";

  mysqli_query($con, $sql);
  mysqli_close($con);

  // 세션 저장
  session_start();
  $_SESSION["userid"] = $profileModel->email;
  $_SESSION["username"] = $profileModel->nickname;
  $_SESSION["userlevel"] = "0";
  $_SESSION["userpoint"] = "9";
  $_SESSION["state"] = $state;
  $_SESSION["accessToken"] = $state;

  // 홈 화면으로 이동
  echo ("
    <script>
    location.href = 'index.php'
    </script>
  ");
}
