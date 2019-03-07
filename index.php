<?php

class Car
{
    public $id;
    public $name;
    public $color;
    public $maxSpeed;
    public $engineValue;

    public function __construct($id, $name, $color, $maxSpeed, $engineValue)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->maxSpeed = $maxSpeed;
        $this->engineValue = $engineValue;
    }

    public function getCar()
    {
        return $this->color . " " . $this->name . " (max-speed: " . $this->maxSpeed . "km/h)";
    }

    public function getHorn()
    {
        return "'beep-beep'" . "<br>";
    }
}

class OldCar extends Car
{
    public $foundationYear;

    public function __construct($id, $name, $color, $maxSpeed, $engineValue, $foundationYear)
    {
        parent::__construct($id, $name, $color, $maxSpeed, $engineValue);
        $this->foundationYear = $foundationYear;
    }

    public function getCar()
    {
        return $this->color . " " . $this->name . " (max-speed: " . $this->maxSpeed . "km/h)";
    }

    public function getHorn()
    {
        return "'Weeeeeeeengh'" . "<br>";
    }
}

class SpecialCar extends Car
{
    public $type;

    public function __construct($id, $name, $color, $maxSpeed, $engineValue, $type)
    {
        parent::__construct($id, $name, $color, $maxSpeed, $engineValue);
        $this->type = $type;
    }

    public function getCar(){
        return $this->type;
    }

    public function getHorn()
    {
        switch($this->type) {
            case 'police':
                return "'weow-weow-weow'" . "<br>";
                break;
            case 'ambulance':
                return "'weooooooow-crack-crack'" . "<br>";
                break;
        }
    }
}

$car1 = new Car(1, 'BMW', 'red', 220, 2);
echo $car1->getCar() . " do " . $car1->getHorn();
$car2 = new OldCar(2, 'Ford', 'black', 110, 1.2, 1910);
echo $car2->getCar() . " do " . $car2->getHorn();
$car3 = new SpecialCar(3, 'Mercedes', 'Blue', 240, 2.2, 'police');
echo $car3->getCar() . " do " . $car3->getHorn();
$car4 = new SpecialCar(3, 'Mercedes', 'White/Red', 150, 2, 'ambulance');
echo $car4->getCar() . " do " . $car4->getHorn();

// Задание 5
echo "<br>5:<br>";
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

echo " - потому что для каждого экземпляра класса функция foo() использует ссылку на одну и ту же переменную, следовательно неважно каким объектом класса будет вызвана функция.";

// Задание 6
echo "<br>6:<br>";
class C {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class D extends C {
}
$c1 = new C();
$d1 = new D();
$c1->foo();
$d1->foo();
$c1->foo();
$d1->foo();

echo " - для наследника класса переменная $x - своя, в отличии от оригинала (class C). вот каждый свою переменную и обрабатывает.";

// Задание 7
echo "<br>7:<br>";
class E {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class F extends E {
}
$e1 = new E;
$f1 = new F;
$e1->foo();
$f1->foo();
$e1->foo();
$f1->foo();

echo ' -тоже самое, что и в предыдущем задании, т.к. если объекту не передаются аргументы ("new E", например), то скобки можно опустить';