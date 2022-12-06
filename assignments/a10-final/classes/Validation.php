<?php

class Validation{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;

	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($input, $type)
	{
		switch($type){
			case "name": return $this->name($input); break;
			case "address": return $this->address($input); break;
         case "phone": return $this->phone($input); break;
         case "city": return $this->name($input); break;
         case "email": return $this->email($input); break;
         case "date": return $this->date($input); break;
			
		}
	}
		
	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($input){
      // alpha chars, hyphens, apostraphes, spaces only,
      // cannot be blank

      // match BAD CHARACTERS
		$match = !preg_match('/[^a-z\ ]|^\s*$/i', $input);
      // throw error if match exists
		return $this->setError($match);
	}

	private function phone($input){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $input);
		return $this->setError($match);
	}

	private function email($input){
		$match = preg_match('/^[\w\d_]+\@[\w\d_]+\.[\w\d_]+$/i', $input);
		return $this->setError($match);
	}

	private function date($input){
		$match = preg_match('/[0-3][1-9]\/[0-3][1-9]\/\d{4}/i', $input);
		return $this->setError($match);
	}

	private function address($input){
		$match = preg_match('/^\d+\ [\w\ \.\-]+/i', $input);
		return $this->setError($match);
	}
	
	private function setError($match){
      // error if no match
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}

	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors(){
		return $this->error;
	}
	
}
