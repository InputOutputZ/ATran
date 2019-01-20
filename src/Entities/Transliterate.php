<?php


namespace  AzureTran\Translate\Entities;

class Transliterate {

	public $text;
	public $script;

	public function __construct($text, $script){
		$this->text = $text;
		$this->script = $script;
	}

	public function __toString(): string
	{
		return "text: ".$this->text.", script: ".$this->script;
	}
}