<?php


namespace  AzureTran\Translate\Entities;

use AzureTran\Translate\Entities\Transliteration;

class Transliterations  {

	public $transliterations;

	public function __construct(Transliteration ...$transliterations){
			$this->transliterations = $transliterations;
	}


}