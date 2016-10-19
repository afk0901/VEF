<?php
class bok{

protected $Titill;
protected $Verd;


function __construct($titill,$verd){
	$this->Titill = $titill;
	$this->Verd = $verd;

}

public function setPrice($price){
	$this->Verd = $price;
	
}

public function getPrice(){
   echo $this->Verd;
}

public function setTitle($titill){
  $this->Titill = $titill;
}

public function getTitle(){
 echo $this->Titill;
}

}




?>