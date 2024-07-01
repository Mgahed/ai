<?php

namespace Mgahed\ai\Http\Helpers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class GeminiModel
{
	/**
	 * @throws Exception
	 */
	public static function proModel($text, $verify = true, $model = 'gemini-pro')
	{
		self::validations($text, $model, $verify);
		$apiKey = config('mgahed-ai.gemini.api_key');
		$client = new Client();
		$headers = [
			'Content-Type' => 'application/json'
		];
		$body = '{
				  "contents": [
					{
					  "role": "user",
					  "parts": [
						{
						  "text": "' . $text . '"
						}
					  ]
					}
				  ]
				}';
		$request = new Request('POST', "https://generativelanguage.googleapis.com/v1/models/$model:generateContent?key=$apiKey", $headers, $body);
		$res = $client->sendAsync($request, ['verify' => $verify])->wait();
		return json_decode($res->getBody()->getContents())->candidates[0]->content->parts[0]->text;
	}

	public static function onePointFiveModel($text, $verify = true, $model = 'gemini-1.5-flash-latest')
	{
		self::validations($text, $model, $verify);
		$apiKey = config('mgahed-ai.gemini.api_key');
		$client = new Client();
		$headers = [
			'Content-Type' => 'application/json'
		];
		$body = '{
				  "contents": [
					{
					  "role": "user",
					  "parts": [
						{
						  "text": "' . $text . '"
						}
					  ]
					}
				  ]
				}';
		$request = new Request('POST', "https://generativelanguage.googleapis.com/v1beta/models/$model:generateContent?key=$apiKey", $headers, $body);
		$res = $client->sendAsync($request, ['verify' => $verify])->wait();
		return json_decode($res->getBody()->getContents())->candidates[0]->content->parts[0]->text;
	}

	public static function GeneralModel($text, $model, $verify = true)
	{
		self::validations($text, $model, $verify);
		$apiKey = config('mgahed-ai.gemini.api_key');
		$client = new Client();
		$headers = [
			'Content-Type' => 'application/json'
		];
		$body = '{
				  "contents": [
					{
					  "role": "user",
					  "parts": [
						{
						  "text": "' . $text . '"
						}
					  ]
					}
				  ]
				}';
		$request = new Request('POST', "https://generativelanguage.googleapis.com/v1/models/$model:generateContent?key=$apiKey", $headers, $body);
		$res = $client->sendAsync($request, ['verify' => $verify])->wait();
		return json_decode($res->getBody()->getContents())->candidates[0]->content->parts[0]->text;
	}

	/**
	 * @throws Exception
	 */
	private static function validations($text, $model, $verify = true): void
	{
		if (empty($text)) {
			throw new Exception('Text is required');
		}
		if (empty($model)) {
			throw new Exception('Model is required');
		}
		if ($verify && !extension_loaded('openssl')) {
			// @codeCoverageIgnoreStart
			throw new Exception('OpenSSL is required');
			// @codeCoverageIgnoreEnd
		}
		if (config('mgahed-ai.gemini.api_key') == null) {
			throw new Exception('Gemini API Key is required');
		}
	}
}
