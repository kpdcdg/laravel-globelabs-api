<?php

namespace Globe;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class GlobeServiceProvider extends ServiceProvider {
	public function register()
	{
		$this->app->singleton('globe', function() {
			$client = new Client([
				// 'base_uri' => 'https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/' . $this->sender . '/requests?access_token=' . $this->access_token
				'base_uri' => 'https://devapi.globelabs.com.ph/smsmessaging/v1/'
			]);

			return new GlobeApi($client);
		});
	}

	public function boot()
	{
		$this->publishes([
	        __DIR__.'\config\globe.php' => config_path('globe.php'),
	    ]);
	}
}
