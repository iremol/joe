<?php

namespace com\light\utility;
/**********************************************************************************/
// A class to generate a unique 20 characters id
class UniqueId {
	
	private $max_digit;
	private $id;
	private $rowid;
	
	private $query = "SELECT id FROM testing";
	
	public function generate() {
		// generates the unique id using md5 sum
		$this->id = md5(uniqid(rand(), true));
		$this->max_digit='12';
		$this->id = substr($this->id, $this->max_digit);
		return $this->id;
	}
       
	
	private function retrieveId() {
		
		
		if ( $result = mysqli_query($connectionInfo, $this->query) ) {
			$this->rowid = mysqli_fetch_array($result);
			return $this->rowid[0];
		}
	}
	
	private function checkId() {
		if ( $this->generate() == $this->retrieveId() )
			return false;
		else
			return true;
	}
		
	public function generateId() {
		do {
			$status = $this->checkId();
		}while ( $status == false );
		
		return $this->id;
		
	}
}

?>