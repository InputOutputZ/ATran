<?php


namespace  ATran\Translate\Entities;

use ATran\Translate\Entities\Transliteration;

class Transliterations  {

	public $transliterations;

	public function __construct(Transliteration ...$transliterations){
			$this->transliterations = $transliterations;
	}


}