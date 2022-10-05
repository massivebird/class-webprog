<?php
class Calculator {

   // print formatted error 
   private function printError($message) {
      echo "Error: Calculator class: ".$message."<br>";
   }

   public function calc($operator=Null, $num1=Null, $num2=Null) {
      // verify correct number of arguments
      if (is_null($operator) || is_null($num1) || is_null($num2)) {
	 self::printError("you need a string and two numbers");
	 return;
      }
      // verify valid operator
      if (substr_count("+-/*", $operator) != 1) {
	 self::printError("Invalid operator");
	 return;
      }

      // calculations
      if ($operator == "+") {
	 echo "The sum of the numbers is ".($num1+$num2)."<br>";
      }
      else if ($operator == "-") {
	 echo "The difference of the numbers is ".($num1-$num2)."<br>";
      }
      else if ($operator == "*") {
	 echo "The product of the numbers is ".($num1*$num2)."<br>";
      }
      else if ($operator == "/") {
	 if ($num2 == 0) {
	    self::printError("Cannot divide by zero");
	    return;
	 }
	 echo "The division of the numbers is ".($num1/$num2)."<br>";
      } 
   }
}

?>
