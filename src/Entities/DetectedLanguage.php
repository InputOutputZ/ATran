<?php


namespace  AzureTran\Translate\Entities;

use AzureTran\Translate\Entities\AzureTranHelpers;

class DetectedLanguage extends AzureTranHelpers {

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