<?php


namespace  ATran\Translate\Entities;

class Alternative {

	public $language;
	public $score;
	public $isTranslationSupported;
	public $isTransliterationSupported;

	public function __construct($language, $score, $isTranslationSupported, $isTransliterationSupported){
		$this->language = $language;
		$this->score = $score;
		$this->isTranslationSupported = $isTranslationSupported;
		$this->isTransliterationSupported = $isTransliterationSupported;
	}

}