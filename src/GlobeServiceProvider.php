<?php

namespace Globe;

use GuzzleHttp\Client;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class GlobeServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->singleton('globe', function(Container $app) {
			$config = $app->make('config')->get('globe');

			$short_code = $config['short_code'];
			
			$client = new Client([
				'base_uri' => 'https://devapi.globelabs.com.ph/smsmessaging/' .
					'v1/outbound/' . $short_code . '/'
			]);

			return new GlobeApi($client);
		});
	}

	public function boot()
	{
		$source = realpath($raw = __DIR__.'/../config/globe.php') ?: $raw;
		
		if ($this->app instanceof LaravelApplication && 
			$this->app->runningInConsole()) {
            $this->publishes([$source => config_path('globe.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('globe');
        }
	}
}
