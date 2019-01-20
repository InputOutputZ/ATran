<?php

namespace  AzureTran\Translate;

use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use Tebru\Gson\Gson;

use AzureTran\Translate\Entities\Detect;
use AzureTran\Translate\Entities\Transliterate;
use AzureTran\Translate\Entities\Translations;
use AzureTran\Translate\Entities\DetectedLanguage;
use AzureTran\Translate\Entities\Transliteration;
use AzureTran\Translate\Entities\AzureTranHelpers;

class AzureTran extends AzureTranHelpers{

	protected $key;
	protected $http;
	protected $host;
	protected $detectpath;
	protected $transliterpath;
	protected $languagepath;
	protected $transpath;

	public function __construct($key, $host, $detectpath, $transpath, $transliterpath, $languagepath){
		$this->key = $key;
		$this->detectpath = $detectpath;
		$this->transliterpath = $transliterpath;
		$this->transpath = $transpath;
		$this->languagepath = $languagepath;
		$this->host = $host;
		$this->http = $this->setupClient();
	}

	public function setupClient($contentLength = null, $clientTraceId = null){

		$headers = collect(['Content-Type' => 'application/json; charset=UTF-8',
							'Ocp-Apim-Subscription-Key' => $this->key,
							'Accept' => 'application/json',
							'charset' => 'utf-8',
							'X-ClientTraceId' => $clientTraceId]);
		if($contentLength){
			$headers->push(['Content-Length' => $contentLength]);
		}
		return new Client(['headers' => $headers->toArray(),'base_uri' => $this->host]);
	}

	public function detectTextInformation($text)
	{
		$body = [
	       'json' => array(['text' => iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text)])
		];	
		$this->http = $this->setupClient($this->getTextJsonBodyLength($text),$this->com_create_guid());
		$response = $this->http->post($this->detectpath, $body);

	    $responseBody = $response->getBody();
	    $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);
	    $encodedBodyJson = json_encode($decodedBodyJson[0], JSON_UNESCAPED_UNICODE);

		$gson = Gson::builder()->build();
	    $detectObject = $gson->fromJson($encodedBodyJson, Detect::class);
	    
	    return $detectObject;
	}

	public function transliterateTextInformation($text,$language,$fromscript,$toscript){

		$body = [
	       'json' => array(['text' => iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text)])
		];	

		$this->http = $this->setupClient($this->getTextJsonBodyLength($text),$this->com_create_guid());
		$tranliteratequeries = "&language=".$language."&fromScript=".$fromscript."&toScript=".$toscript;

		$response = $this->http->post($this->transliterpath.$tranliteratequeries, $body);

	    $responseBody = $response->getBody();
	    $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);
	    $encodedBodyJson = json_encode($decodedBodyJson[0], JSON_UNESCAPED_UNICODE);

		$gson = Gson::builder()->build();
	    $transliterateObject = $gson->fromJson($encodedBodyJson, Transliterate::class);
	    
	    return $transliterateObject;
	}

	public function translateText($text, $to){

		$body = [
	       'json' => array(['text' => iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text)])
		];	
		
		$this->http = $this->setupClient($this->getTextJsonBodyLength($text),$this->com_create_guid());
		$tos = explode(",",$to);
		$translatequeries = "";
		if(count($tos) > 1){
			foreach($tos as $to){
				$translatequeries .= "&to=".$to;
			}
		} else {
			$translatequeries = "&to=".$to;
		}

		$response = $this->http->post($this->transpath.$translatequeries, $body);

	    $responseBody = $response->getBody();
	    $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);
	    $encodedBodyJson = json_encode($decodedBodyJson[0], JSON_UNESCAPED_UNICODE);
		$gson = Gson::builder()->build();
	    $translateObject = $gson->fromJson($encodedBodyJson, Translations::class);
	    $translateObject->detectedLanguage = new DetectedLanguage($decodedBodyJson[0]['detectedLanguage']);

	    return $translateObject;
	}

	public function transliterationsAvailable($languagecode = null){
		
		$this->http = $this->setupClient(false,$this->com_create_guid());

		$scopequery = "&scope=transliteration";

		$response = $this->http->get($this->languagepath.$scopequery);

	    $responseBody = $response->getBody();

	    $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);

	    if(empty($languagecode)){
	    	return $decodedBodyJson['transliteration'];
	    } else {
	    	return $decodedBodyJson['transliteration'][$languagecode];
	    }
	    
	}

	public function translationsAvailable($languagecode = null){

		$this->http = $this->setupClient(false,$this->com_create_guid());

		$scopequery = "&scope=translation";

		$response = $this->http->get($this->languagepath.$scopequery);

	    $responseBody = $response->getBody();

	    $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);

	    if(empty($languagecode)){
	    	return $decodedBodyJson['translation'];
	    } else {
	    	return $decodedBodyJson['translation'][$languagecode];
	    }

	}

}