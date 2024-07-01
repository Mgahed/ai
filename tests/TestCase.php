<?php

namespace Mgahed\ai\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Laravel\Sanctum\SanctumServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Mgahed\ai\Providers\MgahedAiServiceProvider;

class TestCase extends Orchestra
{
	protected function setUp(): void
	{
		parent::setUp();
	}

	protected function getPackageProviders($app)
	{
		return [
			MgahedAiServiceProvider::class,
			SanctumServiceProvider::class
		];
	}

	public function getEnvironmentSetUp($app)
	{
		$app->useEnvironmentPath(__DIR__ . '/..');
		$app->bootstrapWith([LoadEnvironmentVariables::class]);
		parent::getEnvironmentSetUp($app);
		config()->set('database.default', 'testing');
		config()->set('mgahed-ai.gemini.api_key', env('GEMINI_API_KEY'));
	}
}
