<?php


namespace  ATran\Translate\Entities;

class ToScript {

	protected $code;
	protected $name;
	protected $nativeName;
	protected $dir;

	public function __construct($code,$name,$nativeName,$dir){
		$this->code = $code;
		$this->name = $name;
		$this->nativeName = $nativeName;
		$this->dir = $dir;
	}

}