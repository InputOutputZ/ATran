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
