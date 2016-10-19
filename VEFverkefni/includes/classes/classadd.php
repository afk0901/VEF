<?php


class publisher extends bok {

private $Publisher;

public function getPublisher(){
echo $this->Publisher;
}

public function setPublisher($publishername){
$this->Publisher = $publishername; 
}

public function display_bookinformation(){
	echo $this->Titill;
	echo $this->Verd;
}

}

?>