<?php


namespace  ATran\Translate\Entities;

use ATran\Translate\Entities\Alternative;

class Detect {

	public $language;
	public $score;
	public $isTranslationSupported;
	public $isTransliterationSupported;
	public $alternatives;

	public function __construct($language, $score, $isTranslationSupported, $isTransliterationSupported, Alternative ...$alternatives){
		$this->language = $language;
		$this->score = $score;
		$this->isTranslationSupported = $isTranslationSupported;
		$this->isTransliterationSupported = $isTransliterationSupported;
		$this->alternatives = $alternatives;
	}

	public function __toString(): string
	{
		return "language: ".$this->language.", score: ".$this->score;
	}

}