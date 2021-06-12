11

Abstract classes cannot be instantiated and must be extended to be used.  Abstract classes do not have to implement declared functions but concrete classes need to implmement all declared functions.

12

The user inserted values in a prepared statement are transmitted to the sql server after the prepared statment and are not run directly on the server which eliminates the possibility of sql inection.

13
$dbhost = 'localhost';

$dbname = 'AdvancedPHP';

$user = 'mainuser';

$pass = 'AdvPhp101';




$dbconn = new PDO("mysql:host=$dbhost;dbname=$dbname", $user, $pass);

14
public function __construct($name, $id) {
    $this->setName($name);
    $this->setID($id);

}

15

7   

$this->breed

22

extends Dog

25

$pet->showBreed();

26

$pet->action();

17
The display function is referencing the variables $name and $id which are only visiible to the current function.  To display the name and id variables in the object.  They should be changed to $this->name and $this->id.




class StudentClass {

    private $name="Christian Hur";
    private $id=12345;

    function display(){
        print "Name: " . $this->name . "<br>";
        print "ID: " . $this->id;
    }
}

$student = new StudentClass();
$student->display();


18

Polymorphism is an oop concept where an object can be many different sub objects through extending other objects.  Objects that have similiar properties should be part of the same object and any differences should be handled by extending the lower object to make a new object.




class Fruit {

    public $name;

    public $color;

    public function__construct($name, $color) {

        $this->name = $name;

        $this->color = $color;

    }

    public function info() {

        echo "This is " . $this->name . " it is " . $this->color;

    }

}




class Apple extends Fruit {

     public function dr() {

        echo "An apple a day keeps the dr away";

    }

}




$apple = new Apple("Bob", "red");

$apple->intro();

$apple->dr();

1 a
2 b
3 a
4 b
5 hidden form fields, databases , cookies, sessions
6 c
7 a
8 true
9 true
10 a
16 c
19 a
20 true