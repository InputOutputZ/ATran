<?php


namespace  ATran\Translate\Entities;

use ATran\Translate\Entities\Script;

class Transliteration {

	protected $name;
	protected $nativeName;
	protected $scripts;

	public function __construct($name,$nativeName, Script ...$scripts){
		$this->name = $name;
		$this->nativeName = $nativeName;
		$this->scripts = $scripts;
	}

	public function loadPlain(){
		$instance = new self();
		return $instance;
	}

}