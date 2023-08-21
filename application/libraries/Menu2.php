
<?php

class Menu2 extends CI_Controller{
	public $menux;
	public $active;
	public function __construct($menux=array("#"=>"Ingrese algo al menu"), $act="", $formulario="transfer"){
		$this->active=$act;
		$this->formulario=$formulario;
		$this->menux=$menux;
	}

	public function set(){ 
		$te='';
		foreach ($this->menux as $key => $value) {
			if($value!=$this->active)
			$te=$te.'<button type="button" class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" onclick="sendform(\''.$this->formulario.'\',\''.$key.'\')" role="tab" aria-controls="nav-home" aria-selected="true">'.$value.'</button>'."\t\t\n";
			else 
			$te=$te.'<button type="button" class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" onclick="sendform(\''.$this->formulario.'\',\''.$key.'\')" role="tab" aria-controls="nav-profile" aria-selected="false">'.$value.'</button>'."\t\t\n";
		}
		return $te;
	}

	public function __toString(){
		return '<div class="nav nav-tabs" id="nav-tab" role="tablist">'."\t\t\n".$this->set()."</div>"."\t\t\n";

	}
}
?>
