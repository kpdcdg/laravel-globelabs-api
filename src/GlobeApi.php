<?php

namespace Globe;

use GuzzleHttp\Client;

class GlobeApi
{
	protected $shortcode, $client;

	public function __construct(Client $client)
	{
		$this->client = $client;

		$this->short_code = config('globe.short_code');
	}

	public function send($number, $message, $passphrase, $app_id, $app_secret)
	{
		$url = 'outbound/' . $this->short_code . '/requests/';
		
		$params = [
			'form_params' => [
				'address' => $number,
				'message' => $message,
				'passphrase' => $passphrase,
				'app_id' => $app_id
				'app_secret' => $app_secret,
			]
		];

		$response = $this->client->post($url, $params);

		return $response->getBody();
	}
}
