<?php


namespace  AzureTran\Translate\Entities;

use AzureTran\Translate\Entities\ToScript;

class Script {

	protected $code;
	protected $name;
	protected $nativeName;
	protected $dir;
	protected $toScripts;

	public function __construct($code,$name,$nativeName,$dir, ToScript ...$toScripts){
		$this->code = $code;
		$this->name = $name;
		$this->nativeName = $nativeName;
		$this->dir = $dir;
		$this->toScripts = $toScripts;
	}

}