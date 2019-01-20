<?php


namespace  AzureTran\Translate\Entities;

class Translation {

	public $text;
	public $to;

	public function __construct($text, $score){
		$this->text = $text;
		$this->to = $to;
	}

}