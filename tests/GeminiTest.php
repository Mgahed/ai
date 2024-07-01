<?php

namespace Mgahed\ai\Tests;

use Illuminate\Support\Facades\Exceptions;
use Mgahed\ai\Http\Helpers\GeminiModel;

class GeminiTest extends TestCase
{
	public function setUp(): void
	{
		parent::setUp();
	}

	/**
	 * @throws \Exception
	 */
	public function testProModel()
	{
		$text = 'What is release date of first version of php?';
		$expected = '1995';

		$response = GeminiModel::proModel($text);

		// assert the response includes the expected value
		$this->assertStringContainsString($expected, $response);
	}

	public function testOnePointFiveModel()
	{
		$text = 'What is the start date of php first version?';
		$expected = '1995';

		$response = GeminiModel::onePointFiveModel($text);

		// assert the response includes the expected value
		$this->assertStringContainsString($expected, $response);
	}

	public function testGeneralModel()
	{
		$model = 'gemini-pro';
		$text = 'What is the start date of php first version?';
		$expected = '1995';

		$response = GeminiModel::generalModel($text, $model);

		// assert the response includes the expected value
		$this->assertStringContainsString($expected, $response);
	}

	/**
	 * @throws \Exception
	 */
	public function testEmptyText()
	{
		$text = '';
		$expected = 'Text is required';

		$this->expectExceptionMessage($expected);
		GeminiModel::proModel($text);
	}

	/**
	 * @throws \Exception
	 */
	public function testRequiredKey()
	{
		$text = 'What is release date of first version of php?';
		$expected = 'Gemini API Key is required';
		config()->set('mgahed-ai.gemini.api_key', null);
		$this->expectExceptionMessage($expected);
		GeminiModel::proModel($text);
	}

	/**
	 * @throws \Exception
	 */
	public function testModelRequired()
	{
		$text = 'What is release date of first version of php?';
		$expected = 'Model is required';
		$this->expectExceptionMessage($expected);
		GeminiModel::GeneralModel($text, '');
	}
}
