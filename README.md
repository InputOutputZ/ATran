# ATran
Making Microsoft translator API version 3 consumption easier in Laravel 5+.

### Through this integration you can do the following
- Detects text information such as language code and script. Refer to ATran@detectTextInformation.
- Detects list of text information such as language code and script. Refer to ATran@detectTextsInformation.
- Translates text from one language to one or multiple languages. Refer to ATran@translateText.
- Produces transliteration of text from one language to another. Refer to ATran@transliterateTextInformation.
- Request available languages for translation including list of languages code. Refer to ATran@translationsAvailable.
- Request available languages for transliteration including list of available scripts. Refer to ATran@transliterationAvailable.

## Laravel Microsoft Translator Integration

There are 3 files to have a look at so to understand how the integration works

- config/atran.php (Configuration of API endpoints & authorisation key)
- routes.php (Configuring PlayWithAPIController routes)
- ATran\Translate\PlayWithAPIController (A Controller with on hand methods playing with the API endpoints)

### Required Packages

```php
"guzzlehttp/guzzle": "^7.0.1",
"tebru/gson-php": "^0.7.3"
```

# Installation for Laravel 5+. Tested on 8.40.

- 1- Go to your laravel project root directory and install the package locally:-

```php
composer require "atran/translate"
```

- 2- Install the service provider and load config as well as routes references:-

```php
php artisan vendor:publish
```
- 3- Choose "ATran\Translate\ATranServiceProvider" provider from the list via typing its index value.

- 4- Go to env file and include at the bottom:-

```php
AZURETRAN_KEY=Azure Cognitive Services API SUBSCRIPTION KEY
```

- 5- Well Done!

# Installation for older Laravel 
### You may expect more debugging to get it working.


- 1- Go to your laravel project root directory and install the package locally:-
```php
composer require "atran/translate"
```

- 2- Add ATran service provider manually to the providers list in config/app.php:-
```php
'providers' => [
    // ...
    ATran\Translate\\ATranServiceProvider::class,
]
```

- 3- Load config as well as routes references:-
```php
php artisan vendor:publish --force --provider="ATran\Translate\ATranServiceProvider"
```

- 4- Go to env file and include at the bottom:-

```php
AZURETRAN_KEY=Azure Cognitive Services API SUBSCRIPTION KEY
```

- 5- Well Done!

# Demo with PlayWithAPIController and Postman

## Configuration

- Codebase Configuration

-1 Go To PlayWithAPIController

-2 Go to definition of detectTextInformation and transliterationsAvailable.

-3 Examine the functions

- detectTextInformation | Postman Configuration to route "http://yourwebsite.com/detecttext" and POST type.

-1 Include following headers:-

```php
Accept: application/json
```

2- Include following Body: form-data

```php
KEY     TEXT
text    Hello
```

3- Response

```php
{
    "language": "en",
    "score": 1,
    "isTranslationSupported": true,
    "isTransliterationSupported": false,
    "alternatives": [
        {
            "language": "de",
            "score": 1,
            "isTranslationSupported": true,
            "isTransliterationSupported": false
        },
        {
            "language": "fr",
            "score": 1,
            "isTranslationSupported": true,
            "isTransliterationSupported": false
        }
    ]
}
```

- transliterationsAvailable | Postman Configuration to route "http://yourwebsite.com/transliterationavailable" and POST type.

-1 Include following headers:-

```php
Accept: application/json
```

2- Response

```php
{
    "ar": {
        "name": "Arabic",
        "nativeName": "العربية",
        "scripts": [
            {
                "code": "Arab",
                "name": "Arabic",
                "nativeName": "العربية",
                "dir": "rtl",
                "toScripts": [
                    {
                        "code": "Latn",
                        "name": "Latin",
                        "nativeName": "اللاتينية",
                        "dir": "ltr"
                    }
                ]
            },
            {
                "code": "Latn",
                "name": "Latin",
                "nativeName": "اللاتينية",
                "dir": "ltr",
                "toScripts": [
                    {
                        "code": "Arab",
                        "name": "Arabic",
                        "nativeName": "العربية",
                        "dir": "rtl"
                    }
                ].............
```

# Usage

### Import Use at the top in any of your laravel project controllers
```php
use ATran;
```

### Access functions through 

```php
ATran::detectTextInformation($text);
```

## Available functions

- detectTextInformation($text)
- detectTextsInformation($texts)
- transliterateTextInformation($text,$language,$fromscript,$toscript)
- translateText($text, $to)
- transliterationsAvailable($languagecode = null)
- translationsAvailable($languagecode = null)

## About

The ATran package was published under The Unlicense licence. If you have any problems, please feel free to reach out at hi@zakaria.website.
