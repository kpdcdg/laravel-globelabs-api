<?php

namespace Globe;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class GlobeServiceProvider extends ServiceProvider {
	protected $sender = config('globe.sender');
	protected $access_token = config('globe.access_token');

	public function register()
	{
		$this->app->singleton('globe', function() {
			$client = new Client([
				'base_uri' => 'https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/' . $sender . '/requests?access_token=' . $access_token
			]);

			return new GlobeApi($client);
		});
	}

	public function boot()
	{
		$this->publishes([
	        __DIR__.'/config/globe.php' => config_path('globe.php'),
	    ]);
	}
}