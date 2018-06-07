<?php

namespace Globe;

use GuzzleHttp\Client;

class GlobeApi
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function send($number, $message, $passphrase, $app_id, $app_secret, $short_code)
	{
		$url = 'outbound/' . $short_code . '/requests/';
		
		$params = [
			'form_params' => [
				'address' => $number,
				'message' => $message,
				'passphrase' => $passphrase,
				'app_id' => $app_id,
				'app_secret' => $app_secret,
			]
		];

		$response = $this->client->post($url, $params);

		return $response->getBody();
	}
}
