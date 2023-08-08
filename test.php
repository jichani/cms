<?php
class Car
{
  // 클래스 변수(static). 자동적으로 초기화 된 상태로 된다.
  public static $owner = "park";

  // 인스턴스 변수.
  public $color;
  public $name;
  public $age;
  public $wheel = "black";

  // private
  private $oil = "important";

  public function __construct($color, $name, $age)
  {
    $this->color = $color;
    $this->name = $name;
    $this->age = $age;
  }

  // get 방식. 가져오는 코드를 말하는 듯?
  public function getOil()
  {
    return $this->oil;
  }
  // set 방식. 변경하는 코드를 말하는 듯?
  public function setOil($data)
  {
    $this->oil = $data;
  }
};

// Car 객체에서 $morning 인스턴스 생성
$morning = new Car("red", "morning", "3");

// 인스턴스 변수 호출할 때
echo $morning->color;
echo "\n";
echo $morning->color = 'blue';
echo "\n";
// 클래스 변수 호출할 때
echo Car::$owner;
echo "\n";
// 인스턴스 변수 호출 연습.
echo $morning->wheel;
echo "\n";
// private로 지정한 거 가져올 때
echo $morning->getOil();
echo "\n";
echo $morning->setOil("hello");
echo $morning->getOil();
