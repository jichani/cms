<?php
// consolelog : 자바스크립트 콘솔 출력 함수
class CommonMethod
{
    static function consolelog($notice)
    {
        echo '<script>';
        echo 'console.log("' . $notice . '")';
        echo '</script>';
    }

    // alert : 자바스크립트 알림창 출력 함수 
    static function alert($alert)
    {
        echo '<script>';
        echo 'alert("isMobile : ' . $alert . '");';
        echo '</script>';
    }
}
