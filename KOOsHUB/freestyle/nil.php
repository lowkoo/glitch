<?php 

#PHP - Interfaces vs. Abstract Classes
#Interface are similar to abstract classes. The difference between interfaces and abstract classes are:
#Interfaces cannot have properties, while abstract classes can
#All interface methods must be public, while abstract class methods is public or protected
#All methods in an interface are abstract, so they cannot be implemented in code and the abstract keyword is not necessary
#Classes can implement an interface while inheriting from another class at the same time

// Interface definition
interface Animal {
    public function makeSound();
  }
  
  // Class definitions
  class Cat implements Animal {
    public function makeSound() {
      echo " Meow ";
    }
  }
  
  class Dog implements Animal {
    public function makeSound() {
      echo " Bark ";
    }
  }
  
  class Mouse implements Animal {
    public function makeSound() {
      echo " Squeak ";
    }
  }
  
  // Create a list of animals
  $cat = new Cat();
  $dog = new Dog();
  $mouse = new Mouse();
  $animals = array($cat, $dog, $mouse);
  
  // Tell the animals to make a sound
  foreach($animals as $animal) {
    $animal->makeSound();
  }
  # ABSTRACT
// Abstract classes and methods are when the parent class has a named method, but need its child class(es) to fill out the tasks.
//An abstract class is a class that contains at least one abstract method. An abstract method is a method that is declared, but not implemented in the code.
  abstract class Car {
    public $name;
    public function __construct($name) {
      $this->name = $name;
    }
    abstract public function intro() : string;
  }
  
  // Child classes
  class Audi extends Car {
    public function intro() : string {
      return "Choose German quality! I'm an $this->name!";
    }
  }
  
  class Volvo extends Car {
    public function intro() : string {
      return "Proud to be Swedish! I'm a $this->name!";
    }
  }
  
  class Citroen extends Car {
    public function intro() : string {
      return "French extravagance! I'm a $this->name!";
    }
  }
  
  // Create objects from the child classes
  $audi = new audi("Audi");
  echo $audi->intro();
  echo "<br>";
  
  $volvo = new volvo("Volvo");
  echo $volvo->intro();
  echo "<br>";
  
  $citroen = new citroen("Citroen");
  echo $citroen->intro();
  ?>