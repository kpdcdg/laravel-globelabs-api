<?php

namespace Globe;

use GuzzleHttp\Client;

class GlobeApi {
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function send($number, $message)
	{
		$params = [
			'form_params' => [
				'outboundSMSMessageRequest' => [
					'outboundSMSTextMessage' => $message,
					'address' => $number
				]
			]
		];

		$response = $this->client->post('', $params);

		return $response->getBody();
	}
}
