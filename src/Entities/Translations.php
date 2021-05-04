<?php


namespace  ATran\Translate\Entities;

use ATran\Translate\Entities\DetectedLanguage;
use ATran\Translate\Entities\Translation;

class Translations {

	public $detectedLanguage;
	public $translations;

	public function __construct(DetectedLanguage $detectedLanguage, Translation ...$translations){
		$this->detectedLanguage = $detectedLanguage;
		$this->translations = $translations;
	}

	public function __toString(): string
	{
		return "language: ".$this->detectedLanguage->language.", score:".$this->detectedLanguage->score;
	}

}