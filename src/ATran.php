<?php

namespace ATran\Translate;

use ATran\Translate\Entities\ATranHelpers;
use ATran\Translate\Entities\Detect;
use ATran\Translate\Entities\DetectedLanguage;
use ATran\Translate\Entities\Translations;
use ATran\Translate\Entities\Transliterate;
use GuzzleHttp\Client;
use Tebru\Gson\Gson;
use Throwable;

class ATran extends ATranHelpers
{

    protected $key;
    protected $http;
    protected $host;
    protected $detectpath;
    protected $transliterpath;
    protected $languagepath;
    protected $transpath;

    public function __construct($key, $host, $detectpath, $transpath, $transliterpath, $languagepath)
    {
        $this->key = $key;
        $this->detectpath = $detectpath;
        $this->transliterpath = $transliterpath;
        $this->transpath = $transpath;
        $this->languagepath = $languagepath;
        $this->host = $host;
        try {
            $this->http = $this->setupClient();
        } catch (Throwable $e) {

        }
    }

    public function setupClient($contentLength = null, $clientTraceId = null)
    {

        $headers = collect(['Content-Type' => 'application/json; charset=UTF-8',
            'Ocp-Apim-Subscription-Key' => $this->key,
            'Accept' => 'application/json',
            'charset' => 'utf-8',
            'X-ClientTraceId' => $clientTraceId]);
        if ($contentLength) {
            $headers->push(['Content-Length' => $contentLength]);
        }

        return new Client(['headers' => $headers->toArray(), 'base_uri' => $this->host]);
    }

    public function detectTextsInformation($texts)
    {
        try {
            $queries = collect();
            foreach($texts as $query) {
                $queries->push(['text' => iconv(mb_detect_encoding($query, mb_detect_order(), true), "UTF-8", $query)]);
            }

            $body = [
                'json' => $queries->toArray()
            ];

            $this->http = $this->setupClient($this->getTextJsonBodyLength($texts), $this->com_create_guid());
            $response = $this->http->post($this->detectpath, $body);

            $responseBody = $response->getBody();
            $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);

            return $decodedBodyJson;
        } catch (Throwable $e) {
            return ['fail' => true, 'exception' => $e];
        }
    }

    public function detectTextInformation($text)
    {
        $body = [
            'json' => array(['text' => iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text)])
        ];

        try {
            $this->http = $this->setupClient($this->getTextJsonBodyLength($text), $this->com_create_guid());
            $response = $this->http->post($this->detectpath, $body);

            $responseBody = $response->getBody();
            $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);
            $encodedBodyJson = json_encode($decodedBodyJson[0], JSON_UNESCAPED_UNICODE);
            $gson = Gson::builder()->build();
            $detectObject = $gson->fromJson($encodedBodyJson, Detect::class);
            $detectObject->isTranslationSupported = $decodedBodyJson[0]['isTranslationSupported'];
            $detectObject->isTransliterationSupported = $decodedBodyJson[0]['isTransliterationSupported'];

            return $detectObject;
        } catch (Throwable $e) {
            return ['fail' => true, 'exception' => $e];
        }

    }

    public function transliterateTextInformation($text, $language, $fromscript, $toscript)
    {

        $body = [
            'json' => array(['text' => iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text)])
        ];

        try {
            $this->http = $this->setupClient($this->getTextJsonBodyLength($text), $this->com_create_guid());
            $tranliteratequeries = "&language=" . $language . "&fromScript=" . $fromscript . "&toScript=" . $toscript;

            $response = $this->http->post($this->transliterpath . $tranliteratequeries, $body);

            $responseBody = $response->getBody();
            $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);
            $encodedBodyJson = json_encode($decodedBodyJson[0], JSON_UNESCAPED_UNICODE);

            $gson = Gson::builder()->build();
            $transliterateObject = $gson->fromJson($encodedBodyJson, Transliterate::class);

            return $transliterateObject;
        } catch (Throwable $e) {
            return ['fail' => true, 'exception' => $e];
        }
    }

    public function translateText($text, $to)
    {

        $body = [
            'json' => array(['text' => iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text)])
        ];

        try {
            $this->http = $this->setupClient($this->getTextJsonBodyLength($text), $this->com_create_guid());
            $tos = explode(",", $to);
            $translatequeries = "";
            if (count($tos) > 1) {
                foreach($tos as $to) {
                    $translatequeries .= "&to=" . $to;
                }
            } else {
                $translatequeries = "&to=" . $to;
            }

            $response = $this->http->post($this->transpath . $translatequeries, $body);

            $responseBody = $response->getBody();
            $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);
            $encodedBodyJson = json_encode($decodedBodyJson[0], JSON_UNESCAPED_UNICODE);
            $gson = Gson::builder()->build();
            $translationObject = $gson->fromJson($encodedBodyJson, Translations::class);
            $translationObject->detectedLanguage = new DetectedLanguage($decodedBodyJson[0]['detectedLanguage']);

            if (array_key_exists('translations', $translationObject) && sizeof($translationObject->translations) > 0 && array_key_exists('text', $translationObject->translations[0])) {
                return $translationObject->translations[0]['text'];
            } else {
                // failed translation
                return false;
            }
        } catch (Throwable $e) {
            return ['fail' => true, 'exception' => $e];
        }
    }

    public function transliterationsAvailable($languagecode = null)
    {

        try {
            $this->http = $this->setupClient(false, $this->com_create_guid());

            $scopequery = "&scope=transliteration";

            $response = $this->http->get($this->languagepath . $scopequery);

            $responseBody = $response->getBody();

            $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);

            if (empty($languagecode)) {
                return $decodedBodyJson['transliteration'];
            } else {
                return $decodedBodyJson['transliteration'][$languagecode];
            }
        } catch (Throwable $e) {
            return ['fail' => true, 'exception' => $e];
        }
    }

    public function translationsAvailable($languagecode = null)
    {

        try {
            $this->http = $this->setupClient(false, $this->com_create_guid());

            $scopequery = "&scope=translation";

            $response = $this->http->get($this->languagepath . $scopequery);

            $responseBody = $response->getBody();

            $decodedBodyJson = json_decode($responseBody, JSON_UNESCAPED_UNICODE);

            if (empty($languagecode)) {
                return $decodedBodyJson['translation'];
            } else {
                return $decodedBodyJson['translation'][$languagecode];
            }
        } catch (Throwable $e) {
            return ['fail' => true, 'exception' => $e];
        }
    }

}