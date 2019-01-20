<?php

namespace  AzureTran\Translate\Entities;

class AzureTranHelpers {

	const MAX_LEVEL = 5;

	public function from_array($array)
	{
	     foreach(get_object_vars($this) as $attrName => $attrValue)
	        $this->{$attrName} = $array[$attrName];
	}

    public function com_create_guid() {
	    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	        mt_rand( 0, 0xffff ),
	        mt_rand( 0, 0x0fff ) | 0x4000,
	        mt_rand( 0, 0x3fff ) | 0x8000,
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	    );
  	}

public function arrayToObject($a, $level=0)
{

    if(!is_array($a)) {
        throw new InvalidArgumentException(sprintf('Type %s cannot be cast, array expected', gettype($a)));
    }

    if($level > self::MAX_LEVEL) {
        throw new OverflowException(sprintf('%s stack overflow: %d exceeds max recursion level', __METHOD__, $level));
    }

    $o = new \stdClass();
    foreach($a as $key => $value) {
        if(is_array($value)) { // convert value recursively
            $value = $this->arrayToObject($value, $level+1);
        }
        $o->{$key} = $value;
    }
    return $o;
}

  public function getTextJsonBodyLength($text){
    $body = json_encode(['json' => array(['text' => $text])],JSON_UNESCAPED_UNICODE);
    return mb_strlen($body,'UTF-8');
  }
	
}