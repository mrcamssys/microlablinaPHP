
<?php

class Menu1 extends CI_Controller{
	public $menux;
	public $active;
	public function __construct($menux=array("#"=>"Ingrese algo al menu"), $active=""){
		$this->active=$active;
		$this->menux=$menux;
	}

	public function set(){ 
		$te='';
		foreach ($this->menux as $key => $value) {
			if($value!=$this->active)
			$te=$te.'<a href="'.$key.'" class="list-group-item">'.$value.'</a>';
			else 
			$te=$te.'<a href="'.$key.'" class="list-group-item active">'.$value.'</a>';
		}
		return $te;
	}

	public function __toString(){
		return '<div class="col-lg-3 mb-4">
		<div class="list-group">'.$this->set()."</div></div>";

	}
}
?>
