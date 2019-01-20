# AzureTran
Making Microsoft translator API version 3 consumption easier in Laravel 5.7+.

### Through this integration you can do the following
- Detect text information such as language code and script. Refer to AzureTran@detectTextInformation.
- Get translation of text from one language to multiple languages. Refer to AzureTran@translateText.
- Produce transliteration of text from one language to another. Refer to AzureTran@transliterateTextInformation.
- Request available languages for translation including list of languages code. Refer to AzureTran@translationsAvailable.
- Request available languages for transliteration including list of available scripts. Refer to AzureTran@translationsAvailable.

## Laravel Microsoft Translator Integration

There are 3 files to have a look at so to understand how the integration works

- config/azure.php (Configuration of API endpoints & authorization key)
- routes.php (Configuring PlayWithAPIController routes)
- AzureTran\Translate\PlayWithAPIController (All Controller with onhand method plaing with the API endpoints)

# Required Packages

```php
        "guzzlehttp/guzzle": "^6.3",
        "tebru/gson-php": "^0.6.2"
```

# Installation for Laravel 5.7+

- 1- Go to your laravel project root directory and get the package locally:-

```php
composer require "azuretran/translate"
```

- 2- Install the service provider and load config as well as routes references:-

```php
php artisan vendor:publish
```
- 3- Choose "AzureTran\Translate\AzureTranServiceProvider" provider from the list via typing its index value.

- 4- Go to env file and include at the bottom:-

```php
AZURETRAN_KEY=Azure Cognitive Services API SUBSCRIPTION KEY
```

- 5- Well Done!

# Installation for Laravel 4

- 1- Go to your laravel project root directory and get the package locally:-
```php
composer require "azuretran/translate"
```

- 2- Add AzureTran service provider manually into config/app.php:-
```php
'providers' => [
    // ...
    AzureTran\Translate\\AzureTranServiceProvider::class,
]
```

- 3- Load config as well as routes references:-
```php
php artisan vendor:publish --force --provider="AzureTran\Translate\AzureTranServiceProvider"
```

- 4- Go to env file and include at the bottom:-

```php
AZURETRAN_KEY=Azure Cognitive Services API SUBSCRIPTION KEY
```

- 5- Well Done!

# Usage

### Import Use at the top in any of your laravel project controllers
```php
use AzureTran;
```

### Access functions through 

```php
AzureTran::detectTextInformation($text);
```

##Available functions

- detectTextInformation($text) (Returns Detect:Class object)
- transliterateTextInformation($text,$language,$fromscript,$toscript) (Returns Transliterate:Class object)
- translateText($text, $to) (Returns Translations:Class object)
- transliterationsAvailable($languagecode = null) (Returns array of transliteration available object)
- translationsAvailable($languagecode = null) (Returns array of translations available object)

## About

The AzureTran package was published under MIT licence. If you have any problems, please feel free to reach out on hello@princez.uk.

Goodbye.
