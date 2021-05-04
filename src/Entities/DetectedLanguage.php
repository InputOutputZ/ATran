<?php


namespace  ATran\Translate\Entities;

use ATran\Translate\Entities\ATranHelpers;

class DetectedLanguage extends ATranHelpers {

	public $language;
	public $score;

	public function __construct($data){
		if (is_array($data)){
			$this->from_array($data);
		}else {
			$this->language = $language;
			$this->score = $score;
		}
	}

}