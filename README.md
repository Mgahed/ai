# Mgahed AI Package
<p align="center">
  <a href="https://mgahed.com"><img src="http://img.shields.io/badge/author-Mgahed-blue.svg" alt="Latest Version"></a>
  <a href="https://github.com/Mgahed/ai/blob/master/LICENSE"><img src="https://poser.pugx.org/mgahed/ai/license" alt="License"></a>
  <a href="https://packagist.org/packages/mgahed/ai"><img src="https://poser.pugx.org/mgahed/ai/v" alt="Latest Version"></a>
  <a href="https://packagist.org/packages/mgahed/ai/stats"><img src="https://poser.pugx.org/mgahed/ai/downloads" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/mgahed/ai"><img src="http://poser.pugx.org/mgahed/ai/require/php" alt="PHP Version Require"></a>
</p>

## Introduction

This package is simply use some AI models to help you get the best AI response for your text.

## Used models
* Gemini pro
* Gemini 1.5
* Any other models of gemini that is not in beta version

## Minimum Requirements

| Dependency | Version |
|------------|---------|
| PHP        | >= 8.1  |
| Laravel    | >= 10.0 |


## Installation
```
composer require mgahed/ai
```
```
php artisan vendor:publish --tag=mgahed-ai-config
```

## Configuration
See config file in `config/mgahed-ai.php`
```php
return [
	// gemini api key
	'gemini' => [
		'api_key' => env('GEMINI_API_KEY'),
	],
];
```
You can add your gemini api key in your `.env` file

## Usage
```php
use Mgahed\ai\Http\Helpers\GeminiModel;

## Gemini pro model
$aiResponse = GeminiModel::proModel('What is the release date of first version of php?');

## Gemini 1.5 model
$aiResponse = GeminiModel::onePointFiveModel('What is the release date of first version of php?');

## Gemini any other model
$aiResponse = GeminiModel::generalModel('What is the release date of first version of php?', 'gemini-pro');
```

## Supported Links
* [Get Gemini AI key](https://www.geminiforwork.com/setup-api-keys/create-geminiai-api-key/)
