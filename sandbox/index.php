<?php

class Account {

   private $_totalMoney;

   public function __construct($amount) {
      $this->_totalMoney = $amount;
      echo "You now have an account with $" . $this->_totalMoney . ".<br>";
   }

   public function deposit($amount) {
      $this->_totalMoney += $amount;
   }

   public function withdraw($amount) {
      if ($amount <= $this->_totalMoney) {
	 $this->_totalMoney -= $amount;
	 echo "You withdrew $" . $amount . ", which means...<br>";
	 self::viewMoney();
      } else {
	 echo "You're broke lmao" . "<br>";
      }
   }

   public function viewMoney() {
      echo "You have $" . $this->_totalMoney . ".<br>";
   }

}

echo "<pre>";
$myAccount = new Account(500);
$myAccount->deposit(500);
$myAccount->viewMoney();
$myAccount->withdraw(600);

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Garrett's Sandbox</title>
   </head>
   <body>
   </body>
</html>
