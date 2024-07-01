<?php

namespace Mgahed\ai\Providers;

use Illuminate\Support\ServiceProvider;

class MgahedAiServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 */
	public function boot()
	{
		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'mgahed-ai');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'mgahed-ai');
		$this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

		$routesDir = __DIR__ . '/../Routes';
		$this->loadRoutesFromRoutesModules($routesDir);


		if ($this->app->runningInConsole()) {
			$this->publishes([
				__DIR__ . '/../../config/mgahed-ai.php' => config_path('mgahed-ai.php'),
			], 'mgahed-ai-config');

			// Publishing the views.
			$this->publishes([
				__DIR__ . '/../../resources/views' => resource_path('views/vendor/mgahed-ai'),
			], 'views');

			// Publishing assets.
			$this->publishes([
				__DIR__ . '/../../resources/assets' => public_path('assets'),
			], 'assets');

			// Publishing the translation files.
			/*$this->publishes([
				__DIR__.'/../../resources/lang' => resource_path('lang/vendor/mgahed-ai'),
			], 'lang');*/

			// Registering package commands.
			$this->commands([
			]);
		}
	}

	/**
	 * Register the application services.
	 */
	public function register()
	{
		// Automatically apply the package configuration
		$this->mergeConfigFrom(__DIR__ . '/../../config/mgahed-ai.php', 'mgahed.mgahed-ai');
	}

	public function loadRoutesFromRoutesModules($routesDir)
	{
		$routesDireFiles = scandir($routesDir);
		foreach ($routesDireFiles as $routesDireFile) {
			if (is_file($routesDir . '/' . $routesDireFile)) {
				$this->loadRoutesFrom($routesDir . '/' . $routesDireFile);
			}else{
				$routesSubDirFiles = scandir($routesDir . '/' . $routesDireFile);
				foreach ($routesSubDirFiles as $routesSubDirFile) {
					if (is_file($routesDir . '/' . $routesDireFile . '/' . $routesSubDirFile)) {
						$this->loadRoutesFrom($routesDir . '/' . $routesDireFile . '/' . $routesSubDirFile);
					}
				}
			}
		}
	}
}
